<?php

namespace App\Http\Controllers\Api\V1;
use App\Models\Plan;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\PlanCollection;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Api\V1\Auth\AuthController;
use Auth;

class PlanController extends Controller
{

    public function index()
    {
        $Plans = Plan::orderBy('name', 'ASC')->get();
        return new PlanCollection($Plans);
    }

    public function show($plan_id)
    {
        $AuthController = new AuthController();
        $user_id = auth('api')->user()->id;
            if($AuthController->is_admin($user_id) == true)
            {
                $Plan = Plan::find($plan_id);
                if ($Plan != null) {
                    return response()->json([
                        'duration' => $Plan->duration,	
                        'name' => $Plan->name,
                        'price' => $Plan->price,
                        'description' => $Plan->description,
                   ]);
                }
                else {
                    return response()->json([
                        'message' => 'You cannot view an unregistered plan',
                    ]);
                }
            }
            else{
                return response()->json([
                    'message' => 'Only users with administrative roles are allowed to perform this action',
                ]);
            }
       

    }
    public function store(Request $request)
    {
        $validator =  Validator::make($request->all(), [
            'name' => 'required|string|max:45',
            'duration' => 'required|int',	
            'price' => 'required|int',
            'description' => 'required|string',
        ]);
        if ($validator->fails()) {
            return response()->json([
                "error" => 'validation_error',
                "message" => $validator->errors(),
            ], 201);
        }
        else {
            $user_id = auth('api')->user()->id;
            $AuthController = new AuthController();
                if($AuthController->is_admin($user_id) == true)
                {
                   if($this->already_exists($request->name) == false)
                   {
                    return response()->json([
                        'message' => 'Plan already added',
                    ]);
                   }
                   
                    $Plan = new Plan([
                        'name' => $request->name,
                        'description' => $request->description,
                        'price' => $request->price,	
                        'duration'=>$request->duration,
                    ]);
                    $Plan->save();
                    return response()->json([
                        'message' => 'New plan was successfully added',
                    ]);
                }
                else{
                    return response()->json([
                        'message' => 'Only users with administrative roles are allowed to perform this action',
                    ]);
                }
            }

    }

    public function update(Request $request, $plan_id)
    {
        $validator =  Validator::make($request->all(), [
            'name' => 'required|string|max:45',
            'duration' => 'required|string',    
            'price' => 'required|int',
            'description' => 'required|string',
        ]);
        if ($validator->fails()) {
            return response()->json([
                "error" => 'validation_error',
                "message" => $validator->errors(),
            ], 201);
        }
        else{
            $plan_id = $plan_id;
            $user_id = Auth('api')->user()->id;
            $AuthController = new AuthController();
                if($AuthController->is_admin($user_id) == true)
                {
                    $Plan = Plan::where('id', $plan_id)->first();
                if ($Plan != null) {
                        $Plan->name = $request->name;
                        $Plan->description = $request->description;
                        $Plan->price = $request->price;
                        $Plan->duration = $request->duration; 
                        $Plan->save();
                        return response()->json([
                            'message' => 'Plan Profile Updated Successfully',
                        ]);
                    
                }
                else {
                    return response()->json([
                        'message' => 'You cannot update an unregistered plan',
                    ]);
                }
                
            }
            else{
                return response()->json([
                    'message' => 'Only users with administrative roles are allowed to perform this action',
                ]);
            }
    }
}

public function destroy(Request $request, $plan_id)
    {
        
            $user_id = Auth('api')->user()->id;
             $AuthController = new AuthController();
            if($AuthController->is_admin($user_id) !== true)
            {
                return response()->json([
                    'message' => 'Only users with administrative roles are allowed to perform this action',
                ],280);
            }
            $Plan = Plan::find($plan_id);
            if ($Plan != null) {
                $Plan->delete();
                return response()->json([
                    'message' => 'Selected Plan is successfully removed',
                ],200);
            } else {
                return response()->json([
                    'message' => 'A  Plan with ID: ' . $request->id . ' was not found',
                ], 280);
            }
    }


public function already_exists($name){
    if(is_numeric($name)){
       $plan = Plan::find($name);
    }
    else{
        $plan = Plan::where('name',$name)->first();
    }
    if($plan !=null){
        return false;
    }
    else{
        return true;
    }
}
}
