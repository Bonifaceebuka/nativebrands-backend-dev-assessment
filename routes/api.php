<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::prefix('v1/auth')->group(function () {
    Route::post('login', 'Api\V1\Auth\AuthController@login');
    Route::post('signup', 'Api\V1\Auth\AuthController@signup');
    Route::post('password/forgot', 'Api\V1\Auth\PasswordResetController@forgetRequest');
    Route::post('password/confirm_reset','Api\V1\Auth\PasswordResetController@confirmReset');
    Route::post('password/change_password', 'Api\V1\Auth\PasswordResetController@ChangePassword');
    Route::post('password/resend_code', 'Api\V1\Auth\PasswordResetController@resendCode');
    Route::middleware('auth:api')->group(function () {
        Route::post('logout', 'Api\V1\Auth\AuthController@logout');
        Route::get('user', 'Api\V1\Auth\AuthController@user');
    });
    Route::post('resend_code', 'Api\V1\Auth\AuthController@resendCode');
    Route::post('confirm_code', 'Api\V1\Auth\AuthController@confirmCode');

    Route::post('email/verification','Api\V1\Auth\AuthController@verification_confirmation');
    Route::post('email/resend_verification_code', 'Api\V1\Auth\AuthController@resend');
});
Route::prefix('v1')->group(function () {
    Route::post('check_username/{username}', 'Api\V1\UserController@check_username');
    
    Route::middleware('auth:api')->group(function () {
        Route::apiResource('user', 'Api\V1\UserController');
        Route::post('user/update/{id}', 'Api\V1\UserController@update');
        Route::post('user/change_password', 'Api\V1\UserController@change_password');
        Route::apiResource('categories','Api\V1\CategoryController');
        Route::post('categories/update/{id}','Api\V1\CategoryController@update');
        Route::apiResource('plan', 'Api\V1\PlanController');
        Route::post('plan/{plan_id}', 'Api\V1\PlanController@update');
        Route::apiResource('videos','Api\V1\VideoController');
        Route::post('videos/update/{id}','Api\V1\VideoController@update');
        Route::get('videos/category/{id}','Api\V1\VideoController@category');
        Route::post('comment/{video_id}','Api\V1\CommentController@store');

        Route::post('verify_paypal_payment/{plan_id}','Api\V1\PaymentController@pay');
        Route::post('verify_crypto_payment/{plan_id}','Api\V1\PaymentController@pay_with_crypto');
        Route::get('payments','Api\V1\PaymentController@payments');
        Route::get('subscriptions','Api\V1\PaymentController@subscriptions');
});
});