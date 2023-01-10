@extends('layouts.auth')
@section('title')
Create an account
@endsection
@section('content')
<div class="column is-6">
    <h2 class="form-title">Join other millions of students</h2>
    <h3 class="form-subtitle">Enter your credentials to sign up.</h3>
    <!--Form-->
    <form name="register" id="register" action="#" method="POST">
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
                    <div class="field">
                        <label>Confirm password</label>
                        <div class="control">
                            <input type="password" class="input" name="cpassword" placeholder="Enter your confirm password">
                        </div>
                    </div>
                    <div class="field is-flex">
                        <div class="switch-block">
                            <label class="f-switch">
                                <input type="checkbox" class="is-switch" name="is_agreed">
                                <i></i>
                                <div class="meta">
                                    <p>
                                        <a href="#">Agree to our terms & conditions?</a>
                                    </p>
                                </div>
                            </label>
                        </div>
                    </div>
                </div>
                <div class="buttons">
                    <button type="submit" id="register_btn" class="button is-solid primary-button is-fullwidth raised">Create an account</button>
                </div>

                <div class="account-link has-text-centered">
                    <a href="/login">I already have an account ? Signin</a>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection
@section('extra-js')
<script src="{{asset('/assets/js/jquery.validate.min.js')}}"></script>
<script src="{{asset('/assets/js/custom/register.js')}}"></script>
@endsection