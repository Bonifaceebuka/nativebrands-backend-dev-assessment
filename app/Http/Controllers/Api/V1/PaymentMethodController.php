<?php

namespace App\Http\Controllers\Api\V1;
use App\Models\PaymentMethod;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\PaymentMethodCollection;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Api\V1\AuthController;
class PaymentMethodController extends Controller
{

    public function index()
    {
        $Payment_methods = PaymentMethod::orderBy('name', 'ASC')->get();
        return new PaymentMethodCollection($Payment_methods);
    }

    public function show(Request $request)
    {
        $AuthController = new AuthController();
        if($AuthController->is_user($request->user_id) !== false) {
            if($AuthController->is_admin($request->user_id) == true)
            {
                $Payment_method = PaymentMethod::where('id', $request->payment_method_id)->first();
                if ($Payment_method != null) {
                    return response()->json([
                        'name' => $Payment_method->name,
                        'status' => $Payment_method->status,
                        'description' => $Payment_method->description,
                   ]);
                }
                else {
                    return response()->json([
                        'message' => 'You cannot view an unregistered payment method',
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
            'status' => 'required|int',
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
                   if($this->already_exists($request->name) == false)
                   {
                    return response()->json([
                        'message' => 'Payment method already added',
                    ]);
                   }
                    $Payment_method = new PaymentMethod([
                        'name' => $request->name,
                        'description' => $request->description,
                        'status' => $request->status,
                    ]);
                    $Payment_method->save();
                    return response()->json([
                        'message' => 'New payment method was successfully added',
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
            'status' => 'required|int',
        ]);
        if ($validator->fails()) {
            return response()->json([
                "error" => 'validation_error',
                "message" => $validator->errors(),
            ], 201);
        }
        else{
            if($this->already_exists($request->name) == false)
                {
                return response()->json([
                    'message' => 'Payment method already added',
                ]);
                }
            $Payment_method_id = $request->payment_method_id;
            $user_id = $request->user_id;
            $AuthController = new AuthController();
            if($AuthController->is_user($user_id) !== false) {
                if($AuthController->is_admin($user_id) == true)
                {
                    $Payment_method = PaymentMethod::where('id', $Payment_method_id)->first();
                if ($Payment_method != null) {
                        $Payment_method->name = $request->name;
                        $Payment_method->description = $request->description;
                        $Payment_method->status = $request->status;
                        $Payment_method->updated_at = Carbon::now();
                        $Payment_method->update();
                        return response()->json([
                            'message' => 'Payment method Profile Updated Successfully',
                        ]);
                    
                }
                else {
                    return response()->json([
                        'message' => 'You cannot update an unregistered payment method',
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

public function already_exists($name){
    if(PaymentMethod::where('name',$name)->first() !=null){
        return false;
    }
    else{
        return true;
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
            $payPaymentMethod = PaymentMethod::where('id', $request->id)
                ->first();
            if ($payPaymentMethod != null) {
                $payPaymentMethod->delete();
                return response()->json([
                    'message' => 'Selected Payment Method is successfully removed',
                ],200);
            } else {
                return response()->json([
                    'message' => 'A Payment Method with ID: ' . $request->id . ' was not found',
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
    $PaymentMethods = PaymentMethod::orderBy('name', 'ASC')->paginate(20);
    return new PaymentMethodCollection($PaymentMethods);
}else{
    return response()->json([
        'message' => 'Only users with administrative roles are allowed to perform this action',
    ]);
}
}
}
