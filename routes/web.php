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

Auth::routes();
Route::get('/login', 'Auth\LoginController@showLoginForm')->name('login');

// Route::get('/login_redirect','CheckAuthController@login_redirect')->name('login');
Route::group(['prefix'=>'admin','namespace'=>'Admin','middleware'=>['admin'],'as'=>'admin.'], 
	function(){
		Route::get('/dashboard', 'DashboardController@index')->name('dashboard');
		Route::resource('/categories', 'CategoryController');
		Route::resource('/videos', 'VideoController');
		Route::resource('/plans', 'PlanController');
		Route::resource('/users', 'UserController');
		Route::resource('/subscriptions', 'SubscriptionController');
		Route::resource('/payments', 'PaymentController');
	});

Route::group(['namespace'=>'User','middleware'=>['auth'],'as'=>'user.'], 
	function(){
		Route::get('/', 'FeedController@index')->name('feed');
		Route::group(['prefix'=>'settings','as'=>'setting.'], 
		function(){
			Route::get('/', 'SettingController@index')->name('index');
			Route::post('/cover-image', 'SettingController@cover_image')->name('cover_image');
			Route::post('/profile-image', 'SettingController@profile_image')->name('profile_image');
			Route::post('/personal-settings', 'SettingController@personal')->name('personal_settings');
		});
	});