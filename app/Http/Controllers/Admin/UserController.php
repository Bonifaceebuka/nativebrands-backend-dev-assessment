<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use Carbon\Carbon;
use App\http\Resources\UserCollection;
use App\Http\Controllers\Api\V1\Auth\AuthController;
use Auth;
use Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
        public function index(Request $request){
            $user_id = Auth::user()->id;
            $AuthController = new AuthController();
            if($AuthController->is_admin($user_id) == true)
                {
                $Users = User::orderBy('id', 'ASC')->paginate(20);
                return new UserCollection($Users);
            }else{
                return response()->json([
                    'message' => 'Only users with administrative roles are allowed to perform this action',
                ]);
            }
        }
    function edit($id){
        $user_details = null;
        $user_id = Auth::user()->id;
        $AuthController = new AuthController();
        $user_details = User::where('id',$id)->first();
        if ($user_details !=null) {
            return view('admin.users.edit',['user'=>$user_details]);    
        }
        else {
            return response()->json([
                'message' => 'Inactive or no matching user found with ID: '.$id,
            ]);
        }
        
    }
    public function update(Request $request, $id){
        $validator =  Validator::make($request->all(), [
            'first_name' => 'required|string|max:45',
            'last_name' => 'required|string|max:45',
            'avatar' => 'image|mimes:jpeg,jpg,png|max:5120',
        ]);
        $avatar = $request->file('avatar');
        $user_id = Auth::user()->id;
        $AuthController = new AuthController();
        $avatar_pubID = NULL;
        if($AuthController->is_admin($user_id) == true){
            $user_id = $id;
            $user_details = User::find($user_id);
        }
        else{
            $user_id = Auth::user()->id;
            $user_details = User::where('id',$user_id)->where('is_verified',1)->first();
        }
        if (isset($avatar)) {
            if ($user_details->avatar !== 'default.png') {
               $avatar_destroyed = cloudinary()->destroy($user_details->avatar_pubID);
                if ($avatar_destroyed['result'] == 'ok') {
                    $avatar_name = strtolower($request->first_name.'-'.$request->last_name.'-'.time());
                    $avatar_file = $avatar->storeOnCloudinaryAs('tacc-app/images/user-images',$avatar_name);
                    $avatar = $avatar_file->getSecurePath();
                    $avatar_pubID = $avatar_file->getPublicId();
                }
                else{
                    $error = 'We were unable to remove the old banner image. Please try again';
                    return redirect()->back()->with('error-message',$error);
                }
            }
            else{
                $avatar_name = strtolower($request->first_name.'-'.$request->last_name.'-'.time());
                $avatar_file = $avatar->storeOnCloudinaryAs('tacc-app/images/user-images',$avatar_name);
                $avatar = $avatar_file->getSecurePath();
                $avatar_pubID = $avatar_file->getPublicId();
            }
            
        }
        else{
            $avatar = 'default.png';
        }
        if ($user_details !=null) {
                if(!isset($avatar) && $user_details->avatar !== 'default.png' && $user_details->avatar !== NULL){
                    $avatar = $user_details->avatar;
                }
                $user_details->first_name = $request->first_name;
                $user_details->last_name = $request->last_name;
                $user_details->gender = $request->gender;
                $user_details->avatar = $avatar;
                $user_details->phone = $request->phone;
                $user_details->avatar_pubID = $avatar_pubID;
                $user_details->updated_at = Carbon::now();
                if($user_details->update()){
                    $success = 'Profile Updated Successfully';
                    return redirect()->back()->with('success-message',$success);
                }
                else{
                    $error = 'Profile Update was not Successful';
                    return redirect()->back()->with('error-message',$error);
                }
 
            }
            else{
            $error = 'Inactive no matching user found with ID: ' . $user_id;
            return redirect()->back()->with('error-message',$error);
        }
    }
public function change_password(Request $request)
    {
        $validator =  Validator::make($request->all(), [
            'password' => 'required|string|max:255',
        ]);
        if ($validator->fails()) {
            return response()->json([
                "error" => 'validation_error',
                "message" => $validator->errors(),
            ], 501);
        }
            $user_id = Auth::user()->id;
            $user = User::where('id', $user_id)->where('is_verified',1)->first();
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
