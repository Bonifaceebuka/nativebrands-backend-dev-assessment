<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Models\Payment;
use App\Models\Subscription;
use App\Http\Resources\PaymentCollection;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;

class PaymentController extends Controller
{
    public function pay(Request $request, $plan_id){
	     $validator =  Validator::make($request->all(), [
            'paypal_payment_id' => 'required|string',
        ]);
		if ($validator->fails()) {
            return response()->json([
                "error" => 'validation_error',
                "message" => $validator->errors(),
            ], 201);
        }
       
        ////validate the plan ID
        $PlanController = new PlanController();
        $plan = $PlanController->already_exists($plan_id);
        $method_used = 'Paypal';
        $user_id = Auth('api')->user()->id;
        if($plan == false){
            ////Plan Found!
            $paypal_payment_id = $request->paypal_payment_id;
            // $response = Http::withHeaders([
            //     'Content-Type'=>'application/json',
            //     'Authorization'=> 'Bearer '.env('PAYPAL_ACCESS_TOKEN')
            // ])->get(
            //     'https://api-m.sandbox.paypal.com/v1/payments/payment/'.$paypal_payment_id,
            // );
            
            // $response = json_decode($response, TRUE);
            
            // return $response;
            $payment = new Payment([
                'user_id'=>$user_id,
                'paypal_payment_id'=>$paypal_payment_id,
                'plan_id'=>$plan_id,
                'method_used'=>$method_used
            ]);
            if($payment->save()){
                $sub_exists = Subscription::join('payments', 'payments.id', '=', 'subscriptions.payment_id')
                ->where('payments.user_id',$user_id)
                ->where('subscriptions.status','active')
                ->first();
                if($sub_exists !== null){
                    return response()->json([
                        'message'=>'This user already has an active plan',
                    ],200);
                }
                $plan_days = $payment->plan->duration;
                $end_date = Carbon::now()->addDays($plan_days);
                $end_date = Carbon::createFromFormat('Y-m-d H:i:s', $end_date)->format('Y-m-d H:i:s');
                $subscription = new Subscription([
                    'end_date'=>$end_date,
                    'status'=>'active',
                    'payment_id'=>$payment->id,
                ]);
                if($subscription->save()){
                    return response()->json([
                        'message'=>'payment and subscription was successful'
                    ],200);
                }else{
                    return response()->json([
                        'message'=>'Use Account subscription was not successful'
                    ],280);
                }
            }
            else{
                return response()->json([
                    'message'=>'Use Payment was not successfully stored'
                ],280);
            }
        }
        else{
            ////Plan not found!
            return response()->json([
                'message'=>'Invalid Plan ID: '.$plan_id
            ]);
        }
    }

    public function pay_with_crypto(Request $request, $plan_id){
        $validator =  Validator::make($request->all(), [
            'screen_shot' => 'required|image|mimes:jpeg,jpg,png|max:5120',
        ]);
        if ($validator->fails()) {
            return response()->json([
                "error" => 'validation_error',
                "message" => $validator->errors(),
            ], 501);
        }
        $method_used = 'Cryptocurrency';
        $screen_shot = $request->file('screen_shot');
        $user_id = Auth('api')->user()->id;
        $first_name = Auth('api')->user()->first_name;
        $last_name = Auth('api')->user()->last_name;
        $screen_shot_name = strtolower($first_name.'-'.$last_name.'-'.time());
        $screen_shot_file = $screen_shot->storeOnCloudinaryAs('tacc-app/images/payment-receipts',$screen_shot_name);
        $screen_shot = $screen_shot_file->getSecurePath();
        $screen_shot_pubID = $screen_shot_file->getPublicId();

        $payment = new Payment([
            'user_id'=>$user_id,
            'plan_id'=>$plan_id,
            'method_used'=>$method_used,
            'screen_shot_pubID'=> $screen_shot_pubID,
            'screenshot'=>$screen_shot
        ]);
        if($payment->save()){
            return response()->json([
                'message'=>'Use Payment receipt was successfully sent'
            ],280);
        }
        else{
            return response()->json([
                'message'=>'Use Payment receipt was not successfully sent'
            ],280);
        }

    }

    public function payments(){
        $user_id = Auth('api')->user()->id;
        $payments = Payment::where('user_id',$user_id)
        ->with('plan')
        ->with('subscription')
        ->get();
        return new PaymentCollection($payments);
    }

    public function subscriptions(){
        $user_id = Auth('api')->user()->id;
        $subscriptions = Subscription::join('payments', 'payments.id', '=', 'subscriptions.payment_id')
        ->where('payments.user_id',$user_id)
        ->get(['subscriptions.*']);
        return new PaymentCollection($subscriptions);
    }
}
