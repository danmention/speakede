<?php

use Illuminate\Support\Facades\Artisan;
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


    Route::get('/clear-cache', function() {
        Artisan::call('optimize');
        return "done";
    });


    Route::get('/', ['uses' => 'Home\HomeController@getIndex', 'as' => 'index.home']);
    Route::get('all-course', ['uses' => 'Home\HomeController@getAllCourse', 'as' => 'index.all.course']);
    Route::get('online-sessions', ['uses' => 'Home\HomeController@getGroupClasses', 'as' => 'index.all.online.sessions']);
    Route::get('online-sessions/{url}', ['uses' => 'Home\HomeController@getViewGroupCourse', 'as' => 'index.view.group.course']);
    Route::get('login', ['uses' => 'Home\HomeController@getLogin', 'as' => 'index.login']);
    Route::get('register', ['uses' => 'Home\HomeController@getRegister', 'as' => 'index.register']);
    Route::post('register/save', ['uses' => 'Home\HomeController@saveUser', 'as' => 'index.register.save']);


    Route::get('/payment/callback', ['uses' =>'User\PaymentController@handleGatewayCallback' ,'as' => 'user.payment.callback']);
    Route::post('/pay',  ['uses' =>'User\FlutterWaveController@initialize','as' => 'user.pay.rave']);
    Route::get('/rave/callback', ['uses' =>'User\FlutterWaveController@callback', 'as' => 'callback']);
    Route::get('auth/google', ['uses' => 'Home\GoogleController@signInWithGoogle', 'as' => 'auth.google']);
    Route::get('callback/google', ['uses' => 'Home\GoogleController@callbackToGoogle', 'as' => 'callback.google']);


    Route::get('community', ['uses' => 'Home\HomeController@getCommunity', 'as' => 'index.community']);
    Route::get('become-a-teacher', ['uses' => 'Home\HomeController@getBecomeATeacher', 'as' => 'index.teacher']);
    Route::get('tutor/find', ['uses' => 'Home\HomeController@findTutor', 'as' => 'index.find.tutor']);

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

    Route::post('course/review/save', ['uses' => 'Home\HomeController@SubmitReviews', 'as' => 'index.course.review.save']);
    Route::post('user/review/save', ['uses' => 'Home\HomeController@SubmitUserReviews', 'as' => 'index.user.review.save']);
    Route::get('search-result', ['uses' => 'Home\SearchController@getSearchResult', 'as' =>'search.now']);

    /**
     * GENERAL ACTION ROUTES
     */
    Route::group(['prefix' => 'actions', 'middleware' => ['auth.users']], function ()
    {
        Route::post('delete', ['uses' => 'Admin\AdminController@deletingExe', 'as' => 'delete.exe']);
        Route::post('updating/user/status', ['uses' => 'Admin\AdminController@userStatusUpdate', 'as' => 'user.exe.status']);
        Route::post('profile/photo/save', ['uses' => 'Admin\AdminController@UpdateProfilePhoto', 'as' => 'profile.dp.save']);
        Route::post('/change/password/save', ['uses' => 'Admin\AdminController@ChangeUserPassword', 'as' => 'user.password.save']);
    });

    /**
     * ADMIN DASHBOARD ROUTES
     */
    Route::group(['prefix' => 'admin/secure', 'middleware' => ['auth.users']], function ()
    {
        Route::get('/', ['uses' => 'Admin\AdminController@getLogin', 'as' => 'admin.home']);
        Route::get('dashboard', ['uses' => 'Admin\AdminController@getDashboard', 'as' => 'admin.dashboard']);
        Route::get('group/history', ['uses' => 'Admin\AdminController@getDashboard', 'as' => 'admin.group.call.history']);
        Route::get('call/history', ['uses' => 'Admin\AdminController@getDashboard', 'as' => 'admin.call.history']);
        Route::get('/language/add', ['uses' => 'Admin\Categories\CategoryController@getIndex', 'as' => 'admin.add.cat']);
        Route::get('/language/tutor/add', ['uses' => 'Admin\Categories\CategoryController@getTutorIndex', 'as' => 'admin.add.tutor']);
        Route::get('/language/edit/{id}', ['uses' => 'Admin\Categories\CategoryController@getEditCategory', 'as' => 'admin.edit.cat']);
        Route::post('/language/update', ['uses' => 'Admin\Categories\CategoryController@updateLanguage', 'as' => 'admin.edit.lang.update']);
        Route::get('/category/view', ['uses' => 'Admin\Categories\CategoryController@getCategory', 'as' => 'admin.view.cat']);
        Route::post('/category/add/save', ['uses' => 'Admin\Categories\CategoryController@storeCategory', 'as' => 'admin.add.cat.save']);
        Route::post('category/delete', ['uses' => 'Admin\Categories\CategoryController@deleteCategory', 'as' => 'delete.category']);
        Route::get('theme/add', ['uses' => 'Admin\Categories\CategoryController@getUseCasesIndex', 'as' => 'admin.add.use.cases']);
        Route::get('theme/edit/{id}', ['uses' => 'Admin\Categories\CategoryController@getEditCategory', 'as' => 'admin.edit.use.cases']);
        Route::post('theme/add/save', ['uses' => 'Admin\Categories\CategoryController@storeUseCases', 'as' => 'admin.add.use.cases.save']);
        Route::post('theme/delete', ['uses' => 'Admin\Categories\CategoryController@deleteCategory', 'as' => 'delete.use.cases']);
        Route::post('category/make-popular', ['uses' => 'Admin\Categories\CategoryController@makePopular', 'as' => 'make.popular.category']);
        Route::get('all-users', ['uses' => 'Admin\AdminController@getAdminUsers', 'as' => 'admin.user.all']);
        Route::post('disable-users', ['uses' => 'Admin\AdminController@disableAndEnableUser', 'as' => 'admin.user.enable.disable']);

        Route::get('roles/{id}', ['uses' => 'Admin\AdminController@addUserRole', 'as' => 'admin.user.role']);
        Route::post('roles/add/save', ['uses' => 'Admin\AdminController@addRoles', 'as' => 'admin.add.user.roles.save']);
        Route::post('roles/remove', ['uses' => 'Admin\AdminController@removeRoles', 'as' => 'admin.add.user.roles.remove']);

        Route::group(['prefix' => 'transactions'], function ()
        {
            Route::get('wallet/funding', ['uses' => 'Admin\AdminController@getWalletFunding', 'as' => 'admin.transactions.funding']);
            Route::get('payment', ['uses' => 'Admin\AdminController@getPaymentTransactions', 'as' => 'admin.transactions.payment']);
        });

        Route::group(['prefix' => 'user'], function ()
        {
            Route::get('/', ['uses' => 'Admin\AdminController@getUsers', 'as' => 'admin.user.index']);
            Route::get('tutors', ['uses' => 'Admin\AdminController@getUsers', 'as' => 'admin.user.tutors']);
            Route::get('/withdraw-details/{id}', 'Admin\AdminController@viewWithdrawalDetails');
            Route::get('/dashboard', 'Shared\SharedController@getIndex');

            Route::get('/team/member', ['uses' => 'Admin\AdminController@AddTeamMembers', 'as' => 'admin.user.add']);
            Route::get('/user/account', ['uses' => 'Admin\AdminController@AddUserAccount', 'as' => 'admin.user.account.add']);
            Route::post('/save', ['uses' => 'Admin\AdminController@SaveUsers', 'as' => 'admin.user.save']);
            Route::get('/change/password', ['uses' => 'Admin\AdminController@changePassword', 'as' => 'admin.user.password']);
            Route::post('/action/enabling', ['uses' => 'Admin\AdminController@UpdateUserAccount', 'as' => 'admin.user.enabling']);
            Route::get('/profile/photo/add', ['uses' => 'Admin\AdminController@getProfilePhoto', 'as' => 'admin.profile.photo']);

        });

        Route::group(['prefix' => 'course'], function ()
        {
            Route::get('/', ['uses' => 'Admin\AdminController@getAllCourses', 'as' => 'admin.course.all']);
            Route::post('action/disable', ['uses' => 'Admin\AdminController@disableCourse', 'as' => 'admin.course.enable.disable']);
            Route::get('transactions/{id}', ['uses' => 'Admin\AdminController@getCourseTransactions', 'as' => 'admin.course.transactions']);
        });

        Route::group(['prefix' => 'group-sessions'], function ()
        {
            Route::get('/', ['uses' => 'Admin\AdminController@getAllGroupSessions', 'as' => 'admin.group.all']);
            Route::post('action/disable', ['uses' => 'Admin\AdminController@disableGroupSessions', 'as' => 'admin.session.enable.disable']);
            Route::get('transactions/{id}', ['uses' => 'Admin\AdminController@getGroupSessionTransactions', 'as' => 'admin.group.transactions']);
        });

        Route::group(['prefix' => 'private-sessions'], function ()
        {
            Route::get('/', ['uses' => 'Admin\AdminController@getAllPrivateSession', 'as' => 'admin.private.sessions.all']);
            Route::post('action/disable', ['uses' => 'Admin\AdminController@disablePrivateSessions', 'as' => 'admin.private.session.enable.disable']);
            Route::get('transactions/{id}', ['uses' => 'Admin\AdminController@getPrivateSessionTransactions', 'as' => 'admin.private.transactions']);
        });
    });

    /**
     * USER DASHBOARD ROUTES
     */
    Route::group(['prefix' => 'user', 'middleware' => ['auth.users']], function ()
    {
        Route::group(['prefix' => 'apply'], function ()
        {
            Route::get('step/final', ['uses' => 'User\UserController@addTeachersInfo', 'as' => 'user.apply.final']);
            Route::post('step/final/update', ['uses' => 'User\UserController@updateUserInfo', 'as' => 'user.apply.final.save']);
            Route::get('step/2', ['uses' => 'User\UserController@getBecomeATeacher', 'as' => 'user.apply.step.2']);

            Route::get('booking/lesson', ['uses' => 'User\UserController@processingVirtualBooking', 'as' => 'user.apply.booking.lesson']);
            Route::get('booking/lesson/pay', ['uses' => 'User\UserController@payVirtualBooking', 'as' => 'user.apply.booking.lesson.pay']);
            Route::get('booking/group/lesson/pay', ['uses' => 'User\UserController@payVirtualGroupBooking', 'as' => 'user.apply.group.booking.lesson.pay']);
        });

        Route::get('dashboard', ['uses' => 'Shared\SharedController@getIndex', 'as' => 'user.dashboard']);

        Route::group(['prefix' => 'course'], function ()
        {
            Route::get('/', ['uses' => 'User\UserController@getAddCourseView', 'as' => 'user.dashboard.course']);
            Route::post('add', ['uses' => 'User\UserController@saveCourse', 'as' => 'user.dashboard.course.add']);
            Route::get('all', ['uses' => 'Shared\SharedController@allCourse', 'as' => 'user.dashboard.course.all']);
            Route::get('paid/all', ['uses' => 'Shared\SharedController@allPaidCourse', 'as' => 'user.dashboard.course.all.paid']);
            Route::get('sold/all', ['uses' => 'Shared\SharedController@allSoldCourse', 'as' => 'user.dashboard.course.all.sold']);
            Route::get('view/{url}', ['uses' => 'Shared\SharedController@viewCourse', 'as' => 'user.dashboard.course.view']);
            Route::get('view/{course_url}/{lesson_url}', ['uses' => 'Shared\SharedController@viewPaidCourse', 'as' => 'user.dashboard.course.view.paid']);
            Route::get('lesson/add/{id}', ['uses' => 'User\UserController@addLesson', 'as' => 'user.dashboard.course.add.lesson']);
            Route::get('buy/{course_id}', ['uses' => 'User\UserController@buyCourse', 'as' => 'user.dashboard.course.buy']);
            Route::post('buy/save', ['uses' => 'User\UserController@coursePaymentInit', 'as' => 'user.dashboard.course.buy.save']);
            Route::post('lesson/save', ['uses' => 'User\UserController@saveLesson', 'as' => 'user.dashboard.course.lesson.save']);
            Route::get('type/free', ['uses' => 'Shared\SharedController@allCourseByAction', 'as' => 'user.dashboard.course.free']);
            Route::get('type/paid', ['uses' => 'Shared\SharedController@allCourseByAction', 'as' => 'user.dashboard.course.paid']);
            Route::get('theme', ['uses' => 'Shared\SharedController@allCourseByAction', 'as' => 'user.dashboard.course.use.cases']);

        });

        Route::group(['prefix' => 'discover'], function ()
        {
            Route::get('/', ['uses' => 'User\UserController@discoverCourses', 'as' => 'user.dashboard.discover.course.all']);
            Route::get('type/course', ['uses' => 'User\UserController@discoverCourses', 'as' => 'user.dashboard.discover.course']);
            Route::get('type/tutors', ['uses' => 'User\UserController@discoverTutor', 'as' => 'user.dashboard.discover.tutors']);
            Route::get('type/sessions', ['uses' => 'User\UserController@discoverSessions', 'as' => 'user.dashboard.discover.sessions']);
            Route::get('theme', ['uses' => 'User\UserController@discoverTheme', 'as' => 'user.dashboard.discover.theme']);
        });

        Route::group(['prefix' => 'courses'], function ()
        {
            Route::get('type/free', ['uses' => 'User\UserController@discoverAllCourseByAction', 'as' => 'user.dashboard.discover.course.free']);
            Route::get('type/paid', ['uses' => 'User\UserController@discoverAllCourseByAction', 'as' => 'user.dashboard.discover.course.paid']);
            Route::get('theme', ['uses' => 'User\UserController@discoverAllCourseByAction', 'as' => 'user.dashboard.discover.course.use.cases']);
        });

        Route::group(['prefix' => 'group-sessions'], function ()
        {
            Route::get('type/free', ['uses' => 'User\UserController@groupSessionByAction', 'as' => 'user.dashboard.group-sessions.free']);
            Route::get('type/paid', ['uses' => 'User\UserController@groupSessionByAction', 'as' => 'user.dashboard.group-sessions.paid']);
        });

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

        Route::get('meeting/private/paid',[ 'uses' =>'User\ScheduleCalendarController@getPaidPrivateMeeting', 'as' => 'user.private.meeting.paid']);
        Route::get('meeting/private/sold',[ 'uses' =>'User\ScheduleCalendarController@getSoldPrivateMeeting', 'as' => 'user.private.meeting.sold']);
        Route::get('meeting/private/edit/{id}',[ 'uses' =>'User\ScheduleCalendarController@getEditScheduleEvent', 'as' => 'user.private.meeting.edit']);
        Route::post('meeting/private/update',[ 'uses' =>'User\ScheduleCalendarController@updateSchedule', 'as' => 'user.schedule.update']);

        Route::get('group/class/create',[ 'uses' =>'User\UserController@createGroupClass', 'as' => 'user.group.class.create']);
        Route::get('group/class/all',[ 'uses' =>'Shared\SharedController@getGroupClass', 'as' => 'user.group.class.all']);
        Route::get('group/class/paid',[ 'uses' =>'Shared\SharedController@getGroupClassPaid', 'as' => 'user.group.class.all.paid']);
        Route::get('group/class/sold',[ 'uses' =>'Shared\SharedController@getGroupClassSold', 'as' => 'user.group.class.all.sold']);
        Route::post('group/create/save',[ 'uses' =>'User\UserController@saveGroupClassMeeting', 'as' => 'user.group.class.save']);

        Route::get('/add-withdrawal-details', ['uses' => 'User\UserController@addWithdrawalDetails', 'as' => 'user.withdrawal.details']);
        Route::post('/add-withdrawal-details/save', ['uses' => 'User\UserController@saveWithdrawalDetails', 'as' => 'user.withdrawal.details.save']);


    });


    Route::get('theme', ['uses' => 'Home\HomeController@getUseCasesByCourse', 'as' => 'index.use.cases']);
    Route::get('{teachers}/{language}', ['uses' => 'Home\HomeController@getTeacherByLang', 'as' => 'index.cat']);
    Route::get('{teacher}/{id}/{language}', ['uses' => 'Home\HomeController@getTeacherLang', 'as' => 'index.teacher.view']);
    Route::get('{category}/{user}/view', ['uses' => 'Home\HomeController@userStatusUpdate', 'as' => 'index.status']);
    Route::get('{group-class}/{language}', ['uses' => 'Home\HomeController@getGroupClass', 'as' => 'index.group.class']);


});
