<?php
namespace App\Http\Controllers\Api\V1\Auth;

use Hash;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Api\V1\MailsController;
class AuthController extends Controller
{
    public function signup(Request $request)
    {
        $validator =  Validator::make($request->all(), [
            'email' => 'required|string|email|max:100|unique:users|max:100',
            'password' => 'required|string|min:6',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'status_code' => 400,
                "validation_message" => $validator->getMessageBag()->toArray(),
            ], 200);
        }

        if (User::where('email', $request->email)
            ->first() != null) {
            return response()->json([
                'status_code' => 400,
                'message' => 'User already exists.',
                'user_id' => 0
            ], 200);
        }
        // return $request;
        $role = 1;
        $verification_code = rand(100000, 999999);
            $user = new User([
                'email' => $request->email,
                'password' => bcrypt($request->password),
                'verification_code' => $verification_code,
                'role_id' => 1,
                        ]);
                if($user->save()){
                    $mail_receiver = $user->email;
                    $verification_code = $user->verification_code;
                    $MailsController = new MailsController();
                    if ($MailsController->verify_mail($mail_receiver, $verification_code)) {
                       return response()->json([
                       'status_code' => 201,
                        'message' => 'Registration Successful. We have sent a verification link to your email addres. Click on the link to activate your account and login.',
                        'verification_code'=>$verification_code,
                        'user_id' => $user->id
                    ], 201);
                    }
                    else{
                        return response()->json([
                        'status_code' => 201,
                        'message' => 'Registration Successful. We were unable to send mail to your email address.',
                        'verification_code'=>$verification_code,
                        'user_id' => $user->id
                    ], 200);
                    }
                    
                }
                else{
                    return response()->json([
                        'status_code' => 400,
                        'message' => 'Sorry, we were unable to create your account. Please try again'
                    ],200);
                }
    }

    public function login_confirmation(Request $request)
    {
        $user = User::where('verification_code', $request->code)->first();
        if ($user != null) {
            $user->last_login = Carbon::now();
            $user->save();
            $tokenResult = $user->createToken('Personal Access Token');
            return $this->loginSuccess($tokenResult, $user);
        } else {
            return response()->json([
                'message' => 'Sorry, we could not verifiy you. Please try again'
            ]);
        }
    }

    public function login(Request $request)
    {
        $validator =  Validator::make($request->all(), [
            'email' => 'required|string|email',
            'password' => 'required|string',
            'remember_me' => 'boolean'
        ]);
        if ($validator->fails()) {
            return response()->json([
                'status_code' => 400,
                "validation_message" => $validator->getMessageBag()->toArray(),
            ]);
        }
        $user = User::where('email', $request->email)->first();
        if ($user != null) {
            if (Hash::check($request->password, $user->password)) {
                if ($user->email_verified_at == null || $user->is_verified == 0) {
                    return response()->json(['message' => 'Please verify your account', 'user' => null], 401);
                }
                
                    $tokenResult = $user->createToken('Personal Access Token');
                    return $this->loginSuccess($tokenResult, $user);
               

            } else {
                return response()->json(['result' => false, 'message' => 'Unauthorized', 'user' => null], 401);
            }
        } else {
            return response()->json(['result' => false, 'message' => 'User not found', 'user' => null], 401);
        }

    }

    public function logout(Request $request)
    {
        $request->user()->token()->revoke();
        return response()->json([
            'result' => true,
            'message' => 'Successfully logged out'
        ]);
    }

    protected function loginSuccess($tokenResult, $user)
    {
        $token = $tokenResult->token;
        $token->expires_at = Carbon::now()->addWeeks(100);
        $token->save();
        return response()->json([
            'result' => true,
            'message' => 'Successfully logged in',
            'access_token' => $tokenResult->accessToken,
            'token_type' => 'Bearer',
            'expires_at' => Carbon::parse(
                $tokenResult->token->expires_at
            )->toDateTimeString(),
            'user' => [
                'id' => $user->id,
                'first_name' => $user->first_name,
                'last_name' => $user->last_name,
                'email' => $user->email,
                'avatar' => $user->avatar,
                'phone' => $user->phone,
            ]
        ]);
    }

    public function resend(Request $request)
    {
        $user = User::where('email', $request->email)->first();
        if ($user->is_verified == 1) {
            return response()->json([
                'message' => 'Your is already verified!'
            ]);
        }
        else {
            $mail_receiver = $user->email;
            $verification_code = $user->verification_code;
            MailsController::verify_mail($mail_receiver, $verification_code);
            return response()->json([
                'result' => true,
                'message' => 'A verification code is sent to your mail inbox again',
                'user_id' => $user->id
            ], 201);

        }


    }

    public function verification_confirmation(Request $request)
    {
        $validator =  Validator::make($request->all(), [
            'user_id' => 'required|int',
            'verification_code' => 'required|string',
        ]);
        if ($validator->fails()) {
            return response()->json([
                "error" => 'validation_error',
                "message" => $validator->errors(),
            ], 501);
        }
        $user = User::where('verification_code', $request->verification_code)->where('id',$request->user_id)->first();
        if ($user != null) {
            $user->email_verified_at = Carbon::now();
            $user->is_verified = 1;
            $user->save();
            return response()->json([
                'message'=>'Your email has been verified successfully']
                );
        } else {
            return response()->json([
                'message'=> 'Sorry, we could not verifiy you. Please try again'
                ]);
        }

    }
    
    public function is_admin($user_id){
        $user = User::where('id', $user_id)
        ->where('is_verified',1)
        ->first();
        if($user != null) {
            if($user->role_id == 3)
            {
                return true;
            }
            else{
                return false;
            }
        }
        
    }
    
}
