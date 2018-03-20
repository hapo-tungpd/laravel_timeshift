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
Route::get('/home', 'HomeController@index')->name('home');

//manage user
Route::prefix('user')->group(function () {
    Route::get('login', 'Auth\LoginController@loginForm')->name('user.login-form');
    Route::post('login', 'Auth\LoginController@login')->name('user.login');

    Route::middleware(['web.auth'])->group(function () {
        Route::post('logout', 'Auth\LoginController@logout')->name('user.logout');

        /**
         * update user
         */
        Route::resource('/profile', 'UpdateUserController');

        /**
         * change password user
         */
        Route::get('changePassword', 'HomeController@showChangePasswordForm')->name('user.changePassword');
        Route::post('changePassword', 'HomeController@changePassword')->name('changePassword');

        /**
         * User Absence
         */
        Route::resource('absence', 'User\UserAbsenceController');

        /**
         * User Report
         */
        Route::resource('report', 'User\UserReportController');

        /**
         * User Roll Call
         */
        Route::post('roll-call/select_statistic', 'User\UserRollCallController@selectStatistic')
            ->name('roll_call.select_statistic');
        Route::get('roll-call/show_all_roll_call', 'User\UserRollCallController@showAllRollCall')
            ->name('roll_call.show_all_roll_call');
        Route::get('roll-call/search', 'User\UserRollCallController@search')->name('roll_call.search');
        Route::get('roll-call/statistic', 'User\UserRollCallController@statistic')->name('roll_call.statistic');
        Route::resource('roll-call', 'User\UserRollCallController');

        /**
         * User Overtime
         */
        Route::post('overtime/selectStatistic', 'User\UserOvertimeController@selectStatistic')
            ->name('overtime.selectStatistic');
        Route::get('overtime/search', 'User\UserOvertimeController@search')->name('overtime.search');
        Route::get('overtime/statistic', 'User\UserOvertimeController@statistic')->name('overtime.statistic');
        Route::resource('overtime', 'User\UserOvertimeController');
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
         * change password admin
         */
        Route::resource('changepassword', 'Admin\ChangePassword', ['as' => 'admin']);

        /**
         * Manage absence
         */
        Route::resource('absence', 'Admin\AbsenceController', ['as' => 'admin']);

        /**
         * Manage report
         */
        Route::resource('report', 'Admin\ManageReportController', ['as' => 'admin']);

        /**
         * Manage overtime
         */
        Route::post('overtime/selectStatistic', 'Admin\OvertimeController@selectStatistic')
            ->name('admin.overtime.selectStatistic');
        Route::get('overtime/showOvertime/{user_id}', 'Admin\OvertimeController@showOvertime')
            ->name('admin.overtime.showOvertime');
        Route::get('overtime/search', 'Admin\OvertimeController@search')->name('admin.overtime.search');
        Route::get('overtime/statistic', 'Admin\OvertimeController@statistic')->name('admin.overtime.statistic');
        Route::resource('overtime', 'Admin\OvertimeController', ['as' => 'admin']);
    });
    /**
     * admin reset password
     */
    Route::post('/password/email', 'Auth\AdminForgotPasswordController@sendResetLinkEmail')
        ->name('admin.password.email');
    Route::get('/password/reset', 'Auth\AdminForgotPasswordController@showLinkRequestForm')
        ->name('admin.password.request');
    Route::post('/password/reset', 'Auth\AdminResetPasswordController@reset');
    Route::get('/password/reset/{token}', 'Auth\AdminResetPasswordController@showResetForm')
        ->name('admin.password.reset');
});
Auth::routes();
