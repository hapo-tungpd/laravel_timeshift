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
