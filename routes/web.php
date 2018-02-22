<?php

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
Route::prefix('admin')->group(function() {
   Route::get('login', 'Auth\AdminController@loginForm')->name('admin.login-form');
});
Auth::routes();

Route::group(['middleware' => ['web', 'auth']], function() {
	Route::get('/', function() {
		return view('welcome');
	});

	Route::get('/home', function() {
		$users['users'] = \App\User::all();
		return view('home', $users);
	});

	Route::get('/home/information', function() {
		$userinfo['userinfo'] = \App\User_info::all();
		return view('information', $userinfo);
	});
});
