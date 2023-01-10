<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo;
    // = RouteServiceProvider::HOME;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
    protected function authenticated($request, $user)
    {
        if ($user->role_id == 1 && $user->is_verified == 1) {
            if($request->ajax()){
                return response()->json([
                    'status_code'=>200,
                    'login'=>true,
                    'user_type'=>'user'
                ]);
            }
            else
            {
                $this->redirectTo = route('user.feed');
            }
            
        }
    else{
        if($request->ajax()){
            return response()->json([
                'status_code'=>200,
                'login'=>false,
                'user_type'=>null
            ]);
        }
        else{
            $msg = 'Only Verified Admin Accounts are Allowed.';
            return view('/auth/login',['msg'=>$msg]);
        }
    }
}
}
