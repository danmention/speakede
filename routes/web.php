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

Route::namespace('App\Http\Controllers')->group(function () {



    /**
     * GENERAL ACTION ROUTES
     */
    Route::group(['prefix' => 'actions'], function ()
    {
        Route::post('delete', ['uses' => 'Admin\AdminController@deletingExe', 'as' => 'delete.exe']);
        Route::post('updating/user/status', ['uses' => 'Admin\AdminController@userStatusUpdate', 'as' => 'user.exe.status']);
        Route::post('profile/photo/save', ['uses' => 'Admin\AdminController@UpdateProfilePhoto', 'as' => 'profile.dp.save']);
        Route::any('/change/password/save', ['uses' => 'Admin\AdminController@ChangeUserPassword', 'as' => 'user.password.save']);
    });



    /**
     * ADMIN DASHBOARD ROUTES
     */
    Route::group(['prefix' => 'admin/secure'], function ()
    {
        Route::any('/', ['uses' => 'Admin\AdminController@getLogin', 'as' => 'admin.home']);
        Route::any('dashboard', ['uses' => 'Admin\AdminController@getDashboard', 'as' => 'admin.dashboard']);
        Route::any('group/history', ['uses' => 'Admin\AdminController@getDashboard', 'as' => 'admin.group.call.history']);
        Route::any('call/history', ['uses' => 'Admin\AdminController@getDashboard', 'as' => 'admin.call.history']);

        Route::get('/category/add', ['uses' => 'Admin\Categories\CategoryController@getIndex', 'as' => 'admin.add.cat']);
        Route::get('/category/view', ['uses' => 'Admin\Categories\CategoryController@getCategory', 'as' => 'admin.view.cat']);
        Route::post('/category/add/save', ['uses' => 'Admin\Categories\CategoryController@storeCategory', 'as' => 'admin.add.cat.save']);
        Route::post('category/delete', ['uses' => 'Admin\Categories\CategoryController@deleteCategory', 'as' => 'delete.category']);

        Route::group(['prefix' => 'transactions'], function ()
        {
            Route::any('wallet/funding', ['uses' => 'Admin\AdminController@getWalletFunding', 'as' => 'admin.transactions.funding']);
            Route::any('payment', ['uses' => 'Admin\AdminController@getPaymentTransactions', 'as' => 'admin.transactions.payment']);
        });

        Route::group(['prefix' => 'student'], function ()
        {
            Route::any('/', ['uses' => 'Admin\AdminController@getUsers', 'as' => 'admin.student']);
        });

        Route::group(['prefix' => 'teachers'], function ()
        {
            Route::any('/', ['uses' => 'Admin\AdminController@getUsers', 'as' => 'admin.teachers']);
        });

        Route::group(['prefix' => 'user'], function ()
        {
            Route::any('/all', ['uses' => 'Admin\AdminController@getUsers', 'as' => 'admin.user.all']);
            Route::any('/add', ['uses' => 'Admin\AdminController@AddUsers', 'as' => 'admin.user.add']);
            Route::post('/save', ['uses' => 'Admin\AdminController@SaveUsers', 'as' => 'admin.user.save']);
            Route::any('/change/password', ['uses' => 'Admin\AdminController@changePassword', 'as' => 'admin.user.password']);
            Route::post('/action/enabling', ['uses' => 'Admin\AdminController@UpdateUserAccount', 'as' => 'admin.user.enabling']);
            Route::get('/profile/photo/add', ['uses' => 'Admin\AdminController@getProfilePhoto', 'as' => 'admin.profile.photo']);

        });
    });


    /**
     * USER DASHBOARD ROUTES
     */
    Route::group(['prefix' => 'user'], function ()
    {
        Route::group(['prefix' => 'apply'], function ()
        {
            Route::any('step/2', ['uses' => 'User\UserController@getBecomeATeacher', 'as' => 'user.apply.step.2']);
        });

        Route::get('dashboard', ['uses' => 'User\UserController@getIndex', 'as' => 'user.dashboard']);
        Route::get('course', ['uses' => 'User\UserController@getCourse', 'as' => 'user.dashboard.course']);
        Route::post('course/add', ['uses' => 'User\UserController@saveCourse', 'as' => 'user.dashboard.course.add']);
        Route::get('course/all', ['uses' => 'User\UserController@allCourse', 'as' => 'user.dashboard.course.all']);
        Route::get('course/view/{url}', ['uses' => 'User\UserController@viewCourse', 'as' => 'user.dashboard.course.view']);
        Route::get('course/lesson/add/{id}', ['uses' => 'User\UserController@addLesson', 'as' => 'user.dashboard.course.add.lesson']);
        Route::post('course/lesson/save', ['uses' => 'User\UserController@saveLesson', 'as' => 'user.dashboard.course.lesson.save']);

        Route::get('wallet/funding', ['uses' => 'User\UserController@buySpeakToken', 'as' => 'user.dashboard.wallet']);
        Route::post('pay', ['uses' =>'User\PaymentController@redirectToPayment' ,'as' => 'user.pay']);
        Route::get('/profile/photo/add', ['uses' => 'User\UserController@getProfilePhoto', 'as' => 'user.profile.photo']);
        Route::get('/change/password', ['uses' => 'User\UserController@changePassword', 'as' => 'user.password']);
    });

    Route::get('/payment/callback', ['uses' =>'User\PaymentController@handleGatewayCallback' ,'as' => 'user.payment.callback']);

    Route::get('auth/google', ['uses' => 'Home\GoogleController@signInWithGoogle', 'as' => 'auth.google']);
    Route::get('callback/google', ['uses' => 'Home\GoogleController@callbackToGoogle', 'as' => 'callback.google']);

    Route::any('/', ['uses' => 'Home\HomeController@getIndex', 'as' => 'index.home']);
    Route::any('login', ['uses' => 'Home\HomeController@getLogin', 'as' => 'index.login']);
    Route::any('register', ['uses' => 'Home\HomeController@getRegister', 'as' => 'index.register']);
    Route::any('register/save', ['uses' => 'Home\HomeController@saveUser', 'as' => 'index.register.save']);
    Route::get('{teachers}/{language}', ['uses' => 'Home\HomeController@getCategory', 'as' => 'index.cat']);
    Route::get('{teacher}/{id}/{language}', ['uses' => 'Home\HomeController@getTeacherLang', 'as' => 'index.teacher.view']);
    Route::get('{group-class}/{language}', ['uses' => 'Home\HomeController@getGroupClass', 'as' => 'index.group.class']);
    Route::get('community', ['uses' => 'Home\HomeController@getCommunity', 'as' => 'index.community']);
    Route::get('become-a-teacher', ['uses' => 'Home\HomeController@getBecomeATeacher', 'as' => 'index.teacher']);
    Route::get('{category}/{user}/view', ['uses' => 'Home\HomeController@userStatusUpdate', 'as' => 'index.status']);

    Route::post('account/login/now', ['uses' => 'Auth\AuthController@postSignIn', 'as' =>'login.in.user']);
    Route::get('account/logout', ['uses' => 'Auth\AuthController@getLogOut', 'as' =>'account.logout']);
    Route::get('account/password/reset', ['uses' => 'Auth\AuthController@forgetPassword', 'as' =>'account.forget.pass']);
    Route::post('account/forget-password',  ['uses' => 'Auth\AuthController@verifyingEmailAccountReset', 'as' =>'forget.password.reset']);
    Route::get('password/verify', ['uses' => 'Auth\AuthController@VerifyUserAccountPasswordResetView','as' => 'password.verify']);
    Route::post('password/verify/save', ['uses' => 'Auth\AuthController@VerifyUserAccountPasswordReset', 'as' =>'password.verify.save']);



});
