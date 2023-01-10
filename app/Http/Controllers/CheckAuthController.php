<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
class CheckAuthController extends Controller
{
	public function validate_admin(){
		if(Auth::user()->role_id !==3) { 
            Auth::logout();
            $msg = 'Only Admin Accounts are Allowed.';
            return view('/auth/login',['msg'=>$msg]);
        }
	}
    public function login_redirect()
    {
        return response()->json([
            'message'=>'You need to login to be able to access this page'
        ]);
    }
}
