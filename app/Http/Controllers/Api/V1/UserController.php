<?php

namespace App\Http\Controllers\Api\V1;

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
            $user_id = auth('api')->user()->id;
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
    function show($id){
        $user_details = null;
        $user_id = auth('api')->user()->id;
        $AuthController = new AuthController();
        if($AuthController->is_admin($user_id) == true){
            $user_details = User::where('id',$id)->first();
        }
        else{
            $id = auth('api')->user()->id;
            $user_details = User::where('id',$id)->where('is_verified',1)->first();
        }
        if ($user_details !=null) {
                    return response()->json([
                        'id'=>$user_details->id,
                        'email'=>$user_details->email,
                        'first_name'=>$user_details->first_name,
                        'last_name' => $user_details->last_name,
                        'gender' => $user_details->gender,
                        'last_name' => $user_details->last_name,
                        'avatar' => $user_details->avatar,
                        'is_verified' => $user_details->is_verified,
                        'joined' => $user_details->created_at,
                        'phone' => $user_details->phone,
                      ]);  
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
        if ($validator->fails()) {
            return response()->json([
                "error" => 'validation_error',
                "message" => $validator->errors(),
            ], 501);
        }
        $avatar = $request->file('avatar');
        $user_id = auth('api')->user()->id;
        $AuthController = new AuthController();
        if($AuthController->is_admin($user_id) == true){
            $user_id = $id;
            $user_details = User::find($user_id);
        }
        else{
            $user_id = auth('api')->user()->id;
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
                    return response()->json([
                                'message'=>'We were unable to remove the old banner image. Please try again',
                                ],501);
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
                $user_details->first_name = $request->first_name;
                $user_details->last_name = $request->last_name;
                $user_details->gender = $request->gender;
                $user_details->avatar = $avatar;
                $user_details->phone = $request->phone;
                $user_details->avatar_pubID = $avatar_pubID;
                $user_details->updated_at = Carbon::now();
                if($user_details->update()){
                        return response()->json([
                        'message' => 'Profile Updated Successfully',
                    ]);
                }
                else{
                    return response()->json([
                        'message' => 'Profile Update was not Successful',
                    ]);
                }
 
            }
            else{
            return response()->json([
                'message' => 'Inactive no matching user found with ID: ' . $user_id,
            ]);
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
            $user_id = auth('api')->user()->id;
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

    public function check_username($username){
        $username = trim(preg_replace('/ +/', ' ', preg_replace("/[^A-Za-z0-9]/", ' ', urldecode(html_entity_decode(strip_tags($username))))));
        $username = str_replace(" ","-",$username);
        $user = User::where('username',$username)->first();
        if($user == null){
            return true; ///Valid Username
        }
        else{
            return false; ///Invalid Username
        }
    }
    
}
