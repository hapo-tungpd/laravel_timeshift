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
Route::get('/', function () {
    return view('welcome');
});

Route::prefix('user')->group(function() {
    Route::get('login', 'Auth\LoginController@loginForm')->name('user.login-form');
    Route::post('login', 'Auth\LoginController@login')->name('user.login');
    Route::get('index', 'HomeController@index')->name('user.index');
    Route::middleware(['web.auth'])->group(function() {
        Route::post('logout', 'Auth\LoginController@logout')->name('user.logout');
        Route::get('/', 'HomeController@index')->name('user.index');
    });
});

Route::prefix('admin')->group(function() {
    Route::get('login', 'Auth\AdminController@loginForm')->name('admin.login-form');
    Route::post('login', 'Auth\AdminController@login')->name('admin.login');
    Route::middleware(['admin.auth'])->group(function() {
        Route::post('logout', 'Auth\AdminController@logout')->name('admin.logout');
        Route::get('/', 'AdminController@index')->name('admin.index');
    });
});

Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');