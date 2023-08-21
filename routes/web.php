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



    Route::get('/payment/callback', ['uses' =>'User\PaymentController@handleGatewayCallback' ,'as' => 'user.payment.callback']);
    Route::post('/pay',  ['uses' =>'User\FlutterWaveController@initialize','as' => 'user.pay.rave']);
    Route::get('/rave/callback', ['uses' =>'User\FlutterWaveController@callback', 'as' => 'callback']);
    Route::get('auth/google', ['uses' => 'Home\GoogleController@signInWithGoogle', 'as' => 'auth.google']);
    Route::get('callback/google', ['uses' => 'Home\GoogleController@callbackToGoogle', 'as' => 'callback.google']);

    Route::any('/', ['uses' => 'Home\HomeController@getIndex', 'as' => 'index.home']);
    Route::any('all-course', ['uses' => 'Home\HomeController@getAllCourse', 'as' => 'index.all.course']);
    Route::any('group/online/class', ['uses' => 'Home\HomeController@getGroupClasses', 'as' => 'index.all.group.online.class']);
    Route::get('group/online/class/{url}', ['uses' => 'Home\HomeController@getViewGroupCourse', 'as' => 'index.view.group.course']);
    Route::any('login', ['uses' => 'Home\HomeController@getLogin', 'as' => 'index.login']);
    Route::any('register', ['uses' => 'Home\HomeController@getRegister', 'as' => 'index.register']);
    Route::any('register/save', ['uses' => 'Home\HomeController@saveUser', 'as' => 'index.register.save']);

    Route::get('community', ['uses' => 'Home\HomeController@getCommunity', 'as' => 'index.community']);
    Route::get('become-a-teacher', ['uses' => 'Home\HomeController@getBecomeATeacher', 'as' => 'index.teacher']);
    Route::get('teacher/find', ['uses' => 'Home\HomeController@findTeacher', 'as' => 'index.find.teacher']);

    Route::post('account/login/now', ['uses' => 'Auth\AuthController@postSignIn', 'as' =>'login.in.user']);
    Route::get('account/logout', ['uses' => 'Auth\AuthController@getLogOut', 'as' =>'account.logout']);
    Route::get('account/password/reset', ['uses' => 'Auth\AuthController@forgetPassword', 'as' =>'account.forget.pass']);
    Route::post('account/forget-password',  ['uses' => 'Auth\AuthController@verifyingEmailAccountReset', 'as' =>'forget.password.reset']);
    Route::get('password/verify', ['uses' => 'Auth\AuthController@VerifyUserAccountPasswordResetView','as' => 'password.verify']);
    Route::post('password/verify/save', ['uses' => 'Auth\AuthController@VerifyUserAccountPasswordReset', 'as' =>'password.verify.save']);


    Route::get('course/{url}', ['uses' => 'Home\HomeController@getViewCourse', 'as' => 'index.view.course']);
    Route::get('teacher/{identity}', ['uses' => 'Home\HomeController@getTeacherProfile', 'as' => 'teacher.profile']);
    Route::get('teacher/schedule/get-availability', [ 'uses' =>'Home\HomeController@getTeacherAvailability', 'as' => 'teacher.schedule.availability']);
    Route::get('booking/lesson', [ 'uses' =>'Home\HomeController@bookLesson', 'as' => 'lesson.book']);

    Route::post('user/review/save', ['uses' => 'Home\HomeController@SubmitReviews', 'as' => 'index.user.review.save']);
    Route::get('search-result', ['uses' => 'Home\HomeController@getSearchResult', 'as' =>'search.now']);

    /**
     * GENERAL ACTION ROUTES
     */
    Route::group(['prefix' => 'actions', 'middleware' => ['web','auth.users']], function ()
    {
        Route::post('delete', ['uses' => 'Admin\AdminController@deletingExe', 'as' => 'delete.exe']);
        Route::post('updating/user/status', ['uses' => 'Admin\AdminController@userStatusUpdate', 'as' => 'user.exe.status']);
        Route::post('profile/photo/save', ['uses' => 'Admin\AdminController@UpdateProfilePhoto', 'as' => 'profile.dp.save']);
        Route::any('/change/password/save', ['uses' => 'Admin\AdminController@ChangeUserPassword', 'as' => 'user.password.save']);
    });

    /**
     * ADMIN DASHBOARD ROUTES
     */
    Route::group(['prefix' => 'admin/secure', 'middleware' => ['web','auth.users']], function ()
    {
        Route::any('/', ['uses' => 'Admin\AdminController@getLogin', 'as' => 'admin.home']);
        Route::any('dashboard', ['uses' => 'Admin\AdminController@getDashboard', 'as' => 'admin.dashboard']);
        Route::any('group/history', ['uses' => 'Admin\AdminController@getDashboard', 'as' => 'admin.group.call.history']);
        Route::any('call/history', ['uses' => 'Admin\AdminController@getDashboard', 'as' => 'admin.call.history']);

        Route::get('/category/add', ['uses' => 'Admin\Categories\CategoryController@getIndex', 'as' => 'admin.add.cat']);
        Route::get('/category/edit/{id}', ['uses' => 'Admin\Categories\CategoryController@getIndex', 'as' => 'admin.edit.cat']);
        Route::get('/category/view', ['uses' => 'Admin\Categories\CategoryController@getCategory', 'as' => 'admin.view.cat']);
        Route::post('/category/add/save', ['uses' => 'Admin\Categories\CategoryController@storeCategory', 'as' => 'admin.add.cat.save']);
        Route::post('category/delete', ['uses' => 'Admin\Categories\CategoryController@deleteCategory', 'as' => 'delete.category']);
        Route::post('category/make-popular', ['uses' => 'Admin\Categories\CategoryController@makePopular', 'as' => 'make.popular.category']);

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
    Route::group(['prefix' => 'user', 'middleware' => ['web','auth.users']], function ()
    {
        Route::group(['prefix' => 'apply'], function ()
        {
            Route::get('step/final', ['uses' => 'User\UserController@addTeachersInfo', 'as' => 'user.apply.final']);
            Route::post('step/final/update', ['uses' => 'User\UserController@updateUserInfo', 'as' => 'user.apply.final.save']);
            Route::any('step/2', ['uses' => 'User\UserController@getBecomeATeacher', 'as' => 'user.apply.step.2']);

            Route::get('booking/lesson', ['uses' => 'User\UserController@processingVirtualBooking', 'as' => 'user.apply.booking.lesson']);
            Route::get('booking/lesson/pay', ['uses' => 'User\UserController@payVirtualBooking', 'as' => 'user.apply.booking.lesson.pay']);
            Route::get('booking/group/lesson/pay', ['uses' => 'User\UserController@payVirtualGroupBooking', 'as' => 'user.apply.group.booking.lesson.pay']);
        });
        Route::get('dashboard', ['uses' => 'User\UserController@getIndex', 'as' => 'user.dashboard']);
        Route::get('course', ['uses' => 'User\UserController@getCourse', 'as' => 'user.dashboard.course']);
        Route::post('course/add', ['uses' => 'User\UserController@saveCourse', 'as' => 'user.dashboard.course.add']);
        Route::get('course/all', ['uses' => 'User\UserController@allCourse', 'as' => 'user.dashboard.course.all']);
        Route::get('course/paid/all', ['uses' => 'User\UserController@allPaidCourse', 'as' => 'user.dashboard.course.all.paid']);
        Route::get('course/view/{url}', ['uses' => 'User\UserController@viewCourse', 'as' => 'user.dashboard.course.view']);
        Route::get('course/view/{course_url}/{lesson_url}', ['uses' => 'User\UserController@viewPaidCourse', 'as' => 'user.dashboard.course.view.paid']);
        Route::get('course/lesson/add/{id}', ['uses' => 'User\UserController@addLesson', 'as' => 'user.dashboard.course.add.lesson']);
        Route::get('course/buy/{course_id}', ['uses' => 'User\UserController@buyCourse', 'as' => 'user.dashboard.course.buy']);
        Route::post('course/buy/save', ['uses' => 'User\UserController@coursePaymentInit', 'as' => 'user.dashboard.course.buy.save']);
        Route::post('course/lesson/save', ['uses' => 'User\UserController@saveLesson', 'as' => 'user.dashboard.course.lesson.save']);
        Route::get('wallet/funding', ['uses' => 'User\UserController@buySpeakToken', 'as' => 'user.dashboard.wallet']);
        Route::post('pay', ['uses' =>'User\PaymentController@redirectToGateway' ,'as' => 'user.pay']);
        Route::get('/profile/photo/add', ['uses' => 'User\UserController@getProfilePhoto', 'as' => 'user.profile.photo']);
        Route::get('/change/password', ['uses' => 'User\UserController@changePassword', 'as' => 'user.password']);

        Route::get('schedule/get-availability', [ 'uses' =>'User\ScheduleCalendarController@getEvent', 'as' => 'user.schedule.availability']);
        Route::get('schedule/availability/view', [ 'uses' =>'User\ScheduleCalendarController@getAllSchedule', 'as' => 'user.schedule.availability.all']);
        Route::get('schedule/availability/create', [ 'uses' =>'User\ScheduleCalendarController@getCreateScheduleEvent', 'as' => 'user.schedule.availability.create']);
        Route::post('schedule/create-event',[ 'uses' =>'User\ScheduleCalendarController@store', 'as' => 'user.schedule.create']);
        Route::post('schedule/delete-event',[ 'uses' =>'User\ScheduleCalendarController@store', 'as' => 'user.schedule.delete']);
        Route::post('schedule/booking',[ 'uses' =>'User\ScheduleCalendarController@bookingSchedule', 'as' => 'user.schedule.booking']);
        Route::post('schedule/group/booking',[ 'uses' =>'User\ScheduleCalendarController@bookingGroupSchedule', 'as' => 'user.group.schedule.booking']);

        Route::get('meeting/private/all',[ 'uses' =>'User\ScheduleCalendarController@getScheduleRequest', 'as' => 'user.schedule.booking.request']);

        Route::get('group/class/create',[ 'uses' =>'User\UserController@createGroupClass', 'as' => 'user.group.class.create']);
        Route::get('group/class/all',[ 'uses' =>'User\UserController@getGroupClass', 'as' => 'user.group.class.all']);
        Route::get('group/class/paid',[ 'uses' =>'User\UserController@getGroupClassPaid', 'as' => 'user.group.class.all.paid']);
        Route::post('group/create/save',[ 'uses' =>'User\UserController@saveGroupClassMeeting', 'as' => 'user.group.class.save']);


    });


    Route::get('{teachers}/{language}', ['uses' => 'Home\HomeController@getTeacherByLang', 'as' => 'index.cat']);
    Route::get('{teacher}/{id}/{language}', ['uses' => 'Home\HomeController@getTeacherLang', 'as' => 'index.teacher.view']);
    Route::get('{category}/{user}/view', ['uses' => 'Home\HomeController@userStatusUpdate', 'as' => 'index.status']);
    Route::get('{group-class}/{language}', ['uses' => 'Home\HomeController@getGroupClass', 'as' => 'index.group.class']);


});
