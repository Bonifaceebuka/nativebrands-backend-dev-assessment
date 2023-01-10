<?php

namespace App\Http\Controllers\Api\V1;
use App\Models\State;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\StateCollection;
use App\Http\Controllers\Api\V1\AuthController;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;

class StateController extends Controller
{
    public function index($country_id)
    {
        $states = State::where('country_id',$country_id)
        ->where('status',1)
        ->orderBy('name','ASC')->get();
        return new StateCollection($states);
    }

    public function show(Request $request)
    {
        $AuthController = new AuthController();
        if($AuthController->is_user($request->user_id) !== false) {
            if($AuthController->is_admin($request->user_id) == true)
            {
                $state_details = State::where('id', $request->state_id)
                ->first();
                if ($state_details != null) {
                    return response()->json([
                        'name' => $state_details->name,
                        'code' => $state_details->code,
                        'status' => $state_details->status,
                        'country_id' => $state_details->country_id,
                   ]);
                }
                else {
                    return response()->json([
                        'message' => 'You cannot view an unregistered state',
                    ]);
                }
            }
            else{
                return response()->json([
                    'message' => 'Only users with administrative roles are allowed to perform this action',
                ]);
            }
        }
        else{
            return response()->json([
                'message' => 'No matching user found with ID: ' . $request->user_id,
            ]);
        }

    }
    public function store(Request $request)
    {
        $validator =  Validator::make($request->all(), [
            'name' => 'required|string|max:45',
            'code' => 'required|string',
            'status' => 'required|int',
            'country_id'=>'required|int'
        ]);
        if ($validator->fails()) {
            return response()->json([
                "error" => 'validation_error',
                "message" => $validator->errors(),
            ], 201);
        }
        else {
            $AuthController = new AuthController();
            if($AuthController->is_user($request->user_id) !== false) {
                if($AuthController->is_admin($request->user_id) == true)
                {
                    $state = new State([
                        'name' => $request->name,
                        'code' => $request->code,
                        'country_id' => $request->country_id,
                        'status' => $request->status,
                    ]);
                    $state->save();
                    return response()->json([
                        'message' => 'New state was successfully added',
                    ]);
                }
                else{
                    return response()->json([
                        'message' => 'Only users with administrative roles are allowed to perform this action',
                    ]);
                }
            }
            else{
                return response()->json([
                    'message' => 'No matching user found with ID: ' . $request->user_id,
                ]);
            }

        }

    }

    public function update(Request $request)
    {
        $validator =  Validator::make($request->all(), [
            'name' => 'required|string|max:45',
            'code' => 'required|string',
            'status' => 'required|int',
            'country_id'=>'required|int'
        ]);
        if ($validator->fails()) {
            return response()->json([
                "error" => 'validation_error',
                "message" => $validator->errors(),
            ], 201);
        }
        else{
            $state_id = $request->state_id;
            $user_id = $request->user_id;
            $AuthController = new AuthController();
            if($AuthController->is_user($user_id) !== false) {
                if($AuthController->is_admin($user_id) == true)
                {
                    $state_details = State::where('id', $state_id)->first();
                if ($state_details != null) {
                        $state_details->name = $request->name;
                        $state_details->code = $request->code;
                        $state_details->country_id = $request->country_id;
                        $state_details->status = $request->status;
                        $state_details->updated_at = Carbon::now();
                        $state_details->update();
                        return response()->json([
                            'message' => 'State Profile Updated Successfully',
                        ]);
                    
                }
                else {
                    return response()->json([
                        'message' => 'You cannot update an unregistered state',
                    ]);
                }
                
            }
            else{
                return response()->json([
                    'message' => 'Only users with administrative roles are allowed to perform this action',
                ]);
            }
        
        }
        else{
            return response()->json([
                'message' => 'No matching user found with ID: ' . $user_id,
            ]);
        }
    }
}

public function destroy(Request $request)
    {
        $validator =  Validator::make($request->all(), [
            'id' => 'required|int|min:1',
            'user_id' => 'required|int'
        ]);
        if ($validator->fails()) {
            return response()->json([
                "error" => 'validation_error',
                "message" => $validator->errors(),
            ], 280);
        } else {
            if(AuthController::is_user($request->user_id) !== false) {
                if(AuthController::is_admin($request->user_id) !== true)
                {
                    return response()->json([
                        'message' => 'Only users with administrative roles are allowed to perform this action',
                    ],280);
                }
            }
            else{
                return response()->json([
                    'message' => 'No matching user found with ID: ' . $request->user_id,
                ],280);
            }
            $state = State::where('id', $request->id)
                ->first();
            if ($state != null) {
                $state->delete();
                return response()->json([
                    'message' => 'Selected State is successfully removed',
                ],200);
            } else {
                return response()->json([
                    'message' => 'A State with ID: ' . $request->id . ' was not found',
                ], 280);
            }
        }
    }
////////////Admin Specific methods lies below
public function list(Request $request){
    $validator =  Validator::make($request->all(), [
        'user_id' => 'required|int',
    ]);
    if ($validator->fails()) {
        return response()->json([
            "error" => 'validation_error',
            "message" => $validator->errors(),
        ], 280);
    }
    $user_id = $request->user_id;
    $AuthController = new AuthController();
    if($AuthController->is_admin($user_id) == true)
    {
    $States = State::orderBy('name', 'ASC')->paginate(20);
    return new StateCollection($States);
}else{
    return response()->json([
        'message' => 'Only users with administrative roles are allowed to perform this action',
    ]);
}
}
}
