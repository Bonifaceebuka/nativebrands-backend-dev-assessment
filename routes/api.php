<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::prefix('v1/auth')->group(function () {
    Route::post('login', 'Api\V1\Auth\AuthController@login');
    Route::post('signup', 'Api\V1\Auth\AuthController@signup');
    Route::middleware('auth:api')->group(function () {
        Route::post('logout', 'Api\V1\Auth\AuthController@logout');
        Route::get('user', 'Api\V1\Auth\AuthController@user');
    });
});
Route::prefix('v1')->group(function () {    
    Route::middleware('auth:api')->group(function () {
        Route::apiResource('user', 'Api\V1\UserController');
});
});