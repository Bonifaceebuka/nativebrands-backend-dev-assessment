<?php

namespace App\Http\Controllers\Admin;
use App\Models\Plan;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Api\V1\Auth\AuthController;
use Auth;

class PlanController extends Controller
{

    public function index()
    {
        $Plans = Plan::orderBy('name', 'ASC')->get();
        return view('admin.plans.index',['plans'=>$Plans]);
    }

    public function show($plan_id)
    {
        
    }
    public function create(Request $request){
        return view('admin.plans.create');
    }
    public function edit($id){
        $plan = Plan::find($id);
        if($plan !== null){
            return view('admin.plans.edit',['plan'=>$plan]);
        }else{
            $error = 'Invalid Plan ID';
            return redirect()->back()->with('error-message',$error);
        }
    }
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:45',
            'duration' => 'required|int',	
            'price' => 'required|int',
            'description' => 'required|string',
        ]);
        $user_id = Auth::user()->id;
        $AuthController = new AuthController();
            if($AuthController->is_admin($user_id) == true)
            {
               if($this->already_exists($request->name) == false)
               {
                $error = 'Plan already added';
                return redirect()->back()->with('error-message',$error);
               }
               
                $Plan = new Plan([
                    'name' => $request->name,
                    'description' => $request->description,
                    'price' => $request->price,	
                    'duration'=>$request->duration,
                ]);
                if($Plan->save()){
                    $success = 'New plan was successfully added';
                return redirect()->back()->with('success-message',$success);
                }else{
                    $error = 'New plan was not successfully added';
                    return redirect()->back()->with('error-message',$error);
                }
            }
            else{
                $error = 'Only users with administrative roles are allowed to perform this action';
                return redirect()->back()->with('error-message',$error);
            }

    }

    public function update(Request $request, $plan_id)
    {
        $request->validate([
            'name' => 'required|string|max:45',
            'duration' => 'required|string',    
            'price' => 'required|int',
            'description' => 'required|string',
        ]);
       
        $plan_id = $plan_id;
        $user_id = Auth::user()->id;
        $AuthController = new AuthController();
            if($AuthController->is_admin($user_id) == true)
            {
                $Plan = Plan::where('id', $plan_id)->first();
            if ($Plan != null) {
                    $Plan->name = $request->name;
                    $Plan->description = $request->description;
                    $Plan->price = $request->price;
                    $Plan->duration = $request->duration; 
                    if($Plan->save()){
                        $success = 'Plan Profile Updated Successfully';
                        return redirect()->back()->with('success-message',$success);
                    }else{
                        $error = 'Plan Profile Was Not Updated Successfully';
                        return redirect()->back()->with('error-message',$error);
                    }
                   
                
            }
            else {
                $error = 'You cannot update an unregistered plan';
                return redirect()->back()->with('error-message',$error);
            }
            
        }
        else{
            $error = 'Only users with administrative roles are allowed to perform this action';
            return redirect()->back()->with('error-message',$error);
        }
}

public function destroy(Request $request, $plan_id)
    {
        
            $user_id = Auth::user()->id;
             $AuthController = new AuthController();
            if($AuthController->is_admin($user_id) !== true)
            {
                $error = 'Only users with administrative roles are allowed to perform this action';
                return redirect()->back()->with('error-message',$error);
            }
            $Plan = Plan::find($plan_id);
            if ($Plan != null) {
                if($Plan->delete()){
                    $success = 'Selected Plan is successfully removed';
                    return redirect()->back()->with('success-message',$success);
                }
                else{
                    $error = 'Selected Plan was not successfully removed';
                    return redirect()->back()->with('error-message',$error);
                }
            } else {
                $error = 'A  Plan with ID: ' . $request->id . ' was not found';
                return redirect()->back()->with('error-message',$error);
            }
    }


public function already_exists($name){
    if(Plan::where('name',$name)->first() !=null){
        return false;
    }
    else{
        return true;
    }
}
}
