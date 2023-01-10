<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Upload;
use Auth;
class BaseController extends Controller
{
    public function file_upload($file,$type,$category,$folder,$user_id){
        if(isset($file) && $file !== null){
            $folder = 'uploads/'.$folder;
            $filename = 'u-'.$user_id.'-'.time().'.'.$file->getClientOriginalExtension();
            if(!Storage::disk('public')->exists($folder)){
                Storage::disk('public')->makeDirectory($folder);
            }
            $file->storeAs($folder, $filename, 'public');
            $filename = $filename;
        }
        else{
            return false;
        }
        $upload = new Upload([
            'file_name' => $filename,
            'user_id' => $user_id,
            'upload_type_id'=>$type,
            'upload_category_id'=>$category
        ]);
        if($upload->save()) 
        {
           return $upload->id;
        } 
        else{
            return false;
        }
    }

    public function format_username($username){
        $username = trim(preg_replace('/ +/', ' ', preg_replace("/[^A-Za-z0-9]/", ' ', urldecode(html_entity_decode(strip_tags($username))))));
        $username = str_replace(" ","-",$username);
        return $username;
    }

    public function find_image($type,$user_id){
        if($type == 'profile_image'){
            if(Storage::disk('public')->exists('uploads/profile-image/'.Auth::user()->profile_image->file_name))
            {
                return Storage::url('uploads/profile-image/'.Auth::user()->profile_image->file_name);
            }
            else
            {
                return asset('assets/img/default/avatar.jpg');
            }
        }
        else if($type == 'cover_image'){
            if(Storage::disk('public')->exists('uploads/cover-image/'.Auth::user()->cover_image->file_name))
            {
                return Storage::url('uploads/cover-image/'.Auth::user()->cover_image->file_name);
            }
            else
            {
                return asset('assets/img/demo/bg/4.png');
            }
        }
    }

    public function full_name($user_id){
        return Auth::user()->firstname.' '.Auth::user()->lastname;
    }
}
