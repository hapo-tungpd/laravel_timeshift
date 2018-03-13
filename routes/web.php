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

//manage user
Route::prefix('user')->group(function () {
    Route::get('login', 'Auth\LoginController@loginForm')->name('user.login-form');
    Route::post('login', 'Auth\LoginController@login')->name('user.login');
    Route::get('index', 'HomeController@index')->name('user.index');

    Route::middleware(['web.auth'])->group(function () {
        Route::post('logout', 'Auth\LoginController@logout')->name('user.logout');

        /**
         * update user
         */
        Route::resource('user', 'UpdateUserController');

        /**
         * change password user
         */
        Route::get('changePassword', 'HomeController@showChangePasswordForm')->name('user.changePassword');
        Route::post('changePassword', 'HomeController@changePassword')->name('changePassword');

        /**
         * User Report
         */
        Route::resource('report', 'User\UserReportController');
    });
});

Route::prefix('admin')->group(function () {
    //Admin Log in
    Route::get('login', 'Auth\AdminController@loginForm')->name('admin.login-form');
    Route::post('login', 'Auth\AdminController@login')->name('admin.login');
    Route::middleware(['admin.auth'])->group(function () {
        Route::post('logout', 'Auth\AdminController@logout')->name('admin.logout');
        Route::get('/', 'AdminController@index')->name('admin.index');

       /**
        * Manage user
        */
        Route::resource('user', 'ManageUserController', ['as' => 'admin']);
        Route::put('user/{id}/update-image', 'ManageUserController@updateImage')->name('admin.user.update.image');
        Route::put('user/{id}/update-image', 'UserProfileController@updateImage')->name('admin.user.update.image');

        /**
         * Manage report
         */
        Route::resource('absence', 'Admin\AbsenceController', ['as' => 'admin']);

        /**
         * Manage overtime
         */
        Route::get('overtime/search', 'Admin\OvertimeController@search')->name('admin.overtime.search');
        Route::get('overtime/statistic', 'Admin\OvertimeController@statistic')->name('admin.overtime.statistic');
        Route::resource('overtime', 'Admin\OvertimeController', ['as' => 'admin']);
    });
    /**
     * admin reset password
     */
    Route::post('/password/email', 'Auth\AdminForgotPasswordController@sendResetLinkEmail')
        ->name('admin.password.email');
    Route::get('/password/reset', 'Auth\AdminForgotPasswordController@formResetLinkEmail')
        ->name('admin.password.request');
    Route::post('/password/reset', 'Auth\AdminResetPasswordController@reset');
    Route::get('/password/reset/{token}', 'Auth\AdminResetPasswordController@showResetForm')
        ->name('admin.password.reset');
});
Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');
