<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Auth;
use App\User;
class SettingController extends Controller
{
    public function index(){
        return view('user.settings');
    }

    public function cover_image(Request $request){
        $validator =  Validator::make($request->all(), [
            'upload-cover-picture' => 'required|image|mimes:jpeg,jpg,png,JPG,JPEG,PNG|max:5120',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'status_code' => 400,
                "validation_message" => $validator->getMessageBag()->toArray(),
            ], 200);
        }
        $BaseController = new \App\Http\Controllers\BaseController();
        $file = $request->file('upload-cover-picture');
        $type = 1;
        $category = 4;
        $folder = 'cover-image/';
        $user_id = Auth::user()->id;
        $upload_file = $BaseController->file_upload($file,$type,$category,$folder,$user_id);
        if(is_numeric($upload_file)){
            $user = User::find($user_id);
            if($user_id !==null){
                $user->cover_image_id = $upload_file;
                if($user->save()){
                    return true;
                }
                else{
                    return false;
                }
            }
            else{
                return 'Internal Server Error was encountered.';
            }
        }
        else{
            return 'Unable to successfully add the cover image';
        }
    }

    public function profile_image(Request $request){
        $validator =  Validator::make($request->all(), [
            'upload_profile_picture' => 'required|image|mimes:jpeg,jpg,png,JPG,JPEG,PNG|max:5120',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'status_code' => 400,
                "validation_message" => $validator->getMessageBag()->toArray(),
            ], 200);
        }
        $BaseController = new \App\Http\Controllers\BaseController();
        $file = $request->file('upload_profile_picture');
        $type = 1;
        $category = 1;
        $folder = 'profile-image/';
        $user_id = Auth::user()->id;
        $upload_file = $BaseController->file_upload($file,$type,$category,$folder,$user_id);
        if(is_numeric($upload_file)){
            $user = User::find($user_id);
            if($user_id !==null){
                $user->profile_image_id = $upload_file;
                if($user->save()){
                    return true;
                }
                else{
                    return false;
                }
            }
            else{
                return 'Internal Server Error was encountered.';
            }
        }
        else{
            return 'Unable to successfully add the profile image';
        }
    }

    public function personal(Request $request){
        $validator =  Validator::make($request->all(), [
            'fname' => 'required|max:255',
            'lname' => 'required|max:255',
            'gender' => 'required|max:255',
            'birthdate' => 'required|date|max:255',
            'username' => 'required|max:255',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'status_code' => 400,
                "validation_message" => $validator->getMessageBag()->toArray(),
            ]);
        }
        $UserController = new \App\Http\Controllers\Api\V1\UserController();
        $user_id = Auth::user()->id;
        if($UserController->check_username($request->username)== true){
            $BaseController = new \App\Http\Controllers\BaseController();
            $username = $BaseController->format_username($request->username);
        }
        else
        {
            return response()->json([
                'status_code'=>400,
                'message'=>'Username is already taken!'
            ]);
        }

        $user = User::find($user_id);
        if($user !== null){
            $user->firstname = $request->fname;
            $user->lastname = $request->lname;
            $user->gender = $request->gender;
            $user->birthdate = $request->birthdate;
            $user->username = $username;
            if($user->save()){
                return response()->json([
                    'status_code'=>200,
                    'message'=>'Changes were saved successfully'
                ]);
            }
            else{
                return response()->json([
                    'status_code'=>500,'Internal Server Error Was Encountered!'
                ]);
            }
        }
        else{
            return response()->json([
                'status_code'=>400,
                'message'=>'Invalid User!'
            ]);
        }
    }
}
