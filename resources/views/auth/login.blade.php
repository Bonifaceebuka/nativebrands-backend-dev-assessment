@extends('layouts.auth')
@section('title')
Login
@endsection
@section('content')
<div class="column is-6">
    <h2 class="form-title">Welcome Back</h2>
    <h3 class="form-subtitle">Enter your credentials to sign in.</h3>
    <!--Form-->
       <form name="login" id="login" action="#" method="POST">
        @csrf
        <div class="login-form">
            <div class="form-panel">
            <div class="alert text-center msg"></div>
                <div class="field">
                    <label>Email</label>
                    <div class="control">
                        <input type="text" class="input" name="email" 
                        placeholder="Enter a valid email address" value="{{ old('email') }}">
                    </div>
                </div>
                <div class="field">
                    <label>Password</label>
                    <div class="control">
                        <div class="control">
                            <input type="password" class="input" id="password" name="password" 
                            placeholder="Enter your password">
                        </div>
                    </div>
                    <div class="field is-flex">
                            <div class="switch-block">
                                <label class="f-switch">
                                    <input type="checkbox" class="is-switch"
                                    id="remember" class="chk-remember"
                                    name="remember" {{ old('remember') ? 'checked' : '' }}>
                                    <i></i>
                                </label>
                                <div class="meta">
                                    <p>Remember me?</p>
                                </div>
                            </div>
                            <a>Forgot Password?</a>
                        </div>
                </div>
                <div class="buttons">
                    <button type="submit" id="login_btn" 
                    class="button is-solid primary-button is-fullwidth raised">Login now</button>
                </div>

                <div class="account-link has-text-centered">
                    <a href="/register">I already have an account ? Signup</a>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection
@section('extra-js')
<script src="{{asset('/assets/js/jquery.validate.min.js')}}"></script>
<script src="{{asset('/assets/js/custom/login.js')}}"></script>
@endsection