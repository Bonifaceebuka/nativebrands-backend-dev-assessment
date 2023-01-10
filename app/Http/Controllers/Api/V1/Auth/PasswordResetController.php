<?php

namespace App\Http\Controllers\Api\V1\Auth;

use Illuminate\Http\Request;
use App\User;
use App\Http\Controllers\Controller;
use Hash;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Api\V1\MailsController;


class PasswordResetController extends Controller
{
    public function forgetRequest(Request $request)
    {
        $user = User::where('email', $request->email)->first();
        if (!$user) {
            return response()->json([
                'result' => false,
                'message' => 'User is not found'], 404);
        }

        if ($user) {
            $user->verification_code = rand(100000, 999999);
            $user->save();
            $mail_receiver = $user->email;
            $verification_code = $user->verification_code;
            MailsController::forgotten_password_mail($mail_receiver, $verification_code);
        }

        return response()->json([
            'result' => true,
            'message' => 'A verification code is sent to your mail inbox'
        ], 200);
    }

    public function confirmReset(Request $request)
    {
        $validator =  Validator::make($request->all(), [
            'email' => 'required|email',
            'verification_code' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json([
                "error" => 'validation_error',
                "message" => $validator->errors(),
            ], 301);
        } else {
                $user = User::where('verification_code', $request->verification_code)
                    ->where('email', $request->email)->first();
                if ($user != null) {
                    $user->verification_code = null;
                    $user->save();
                    return response()->json([
                        'result' => true,
                        'message' => 'Your code is verified successfully. You can now change your password',
                    ], 200);
                } else {
                    return response()->json([
                        'result' => false,
                        'message' => 'Invalid entries!',
                    ], 200);
                }
            }
    }

    public function ChangePassword(Request $request)
    {
        $validator =  Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|string',
        ]);
        if ($validator->fails()) {
            return response()->json([
                "error" => 'validation_error',
                "message" => $validator->errors(),
            ], 201);
        }
        else {
                $user = User::where('verification_code', 'null')
                ->where('email', $request->email)->first();
                if ($user != null) {
                    $user->password = Hash::make($request->password);
                    $user->save();
                    return response()->json([
                        'result' => true,
                        'message' => 'Your password is reset. You can now login',
                    ], 200);
                } else {
                    return response()->json([
                        'result' => false,
                        'message' => 'Invalid entries!',
                    ], 200);
                }
        }

    }

    public function resendCode(Request $request)
    {
         $validator =  Validator::make($request->all(), [
            'email' => 'required|email',
        ]);
        if ($validator->fails()) {
            return response()->json([
                "error" => 'validation_error',
                "message" => $validator->errors(),
            ], 201);
        }
         $user = User::where('email', $request->email)->first();

        if (!$user) {
            return response()->json([
                'result' => false,
                'message' => 'User is not found'], 404);
        }

        $user->verification_code = rand(100000, 999999);
        $user->save();
        $mail_receiver = $user->email;
        $verification_code = $user->verification_code;
        MailsController::forgotten_password_mail($mail_receiver, $verification_code);
        return response()->json([
            'result' => true,
            'message' => 'A code is sent to your mail inbox again',
        ], 200);
    }
}
