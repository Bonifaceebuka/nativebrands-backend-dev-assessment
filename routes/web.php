<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Auth::routes();
Route::get('/login', 'Auth\LoginController@showLoginForm')->name('login');

Route::group(['prefix'=>'admin','namespace'=>'Admin','middleware'=>['admin'],'as'=>'admin.'], 
	function(){
		Route::get('/dashboard', 'DashboardController@index')->name('dashboard');
	});

Route::group(['namespace'=>'User','middleware'=>['auth'],'as'=>'user.'], 
	function(){
		
	});