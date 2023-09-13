<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\AccountDetails;
use App\Models\Category;
use App\Models\Course;
use App\Models\CoursePayment;
use App\Models\GroupClass;
use App\Models\GroupClassEnrollment;
use App\Models\Lesson;
use App\Models\PaymentTransaction;
use App\Models\PreferredLanguage;
use App\Models\Roles;
use App\Models\Schedule;
use App\Models\ScheduleEvent;
use App\Models\User;
use App\Models\UserRoles;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class AdminController
{

    public function getDashboard()
    {
        $users = User::query()->where('is_admin', 0)->count();
        $wallet = PaymentTransaction::query()->sum('amount');
        return view('admin.index', compact('users','wallet'));
    }


    public function getWalletFunding()
    {
        $payment = PaymentTransaction::all();
        foreach ($payment as $row){
            $row->user = User::query()->where('id' ,$row->user_id)->value('firstname');
        }

        $total_transaction = $payment->count();
        return view('admin.wallet_funding', compact('payment','total_transaction'));
    }

    public function getPaymentTransactions()
    {
        return view('admin.payment_transactions');
    }

    public function getGroupHistory()
    {
        return view('admin.group_history');
    }


    public function getCallHistory()
    {
        return view('admin.call_history');
    }


    public function getLogin()
    {
        return view('admin.login');
    }


    /**
     * @return Factory|View|Application
     */
    public function getUsers()
    {
        if (request()->segment(3) ==="user" && (empty(request()->segment(4)))){

            $users = User::query()->where('is_admin',0)->get();
            foreach ($users as $key => $item){
                if (PreferredLanguage::query()->where('user_id', $item->id)->count() > 0){
                    unset($users[$key]);
                }
            }
        } else {
            $users = User::join('preferred_languages', 'preferred_languages.user_id', '=', 'users.id')
                ->where('users.status', 1)->groupBy('preferred_languages.user_id')->where('users.is_admin', 0)->orderBy('users.id','desc')->get(['users.*']);
        }

        return view('admin.user.view-user',compact('users'));
    }


    /**
     * @return Factory|View|Application
     */
    public function getAdminUsers()
    {
        $users = User::query()->where('is_admin',1)->get();
        return view('admin.users',compact('users'));
    }


    /**
     * @return Factory|View|Application
     */
    public function AddTeamMembers()
    {
        return view('admin.user.add-user');
    }

    /**
     * @return Factory|View|Application
     */
    public function AddUserAccount()
    {
        $tutor_lang =  Category::query()->where('class_name', 'tutor')->get();
        $lang = Category::query()->where('class_name', 'language')->get();
        return view('admin.user.add-user-account', compact('tutor_lang','lang'));
    }


    /**
     * @param Request $request
     * @return RedirectResponse
     */
    public function SaveUsers(Request $request): RedirectResponse
    {
        $validator = Validator::make($request->all(), [
            'firstname' => 'required',
            'lastname' => 'required',
            'email' => 'required|email|unique:users,email'
        ]);

        if ($validator->fails()) {
            Session::flash('error', $validator->getMessageBag());
            return redirect()->route('admin.user.add')->withErrors($validator)->withInput();
        }

        $post = new User;
        $post->firstname                      = $request->firstname;
        $post->lastname                       = $request->lastname;
        $post->email                          = $request->email;
        $post->phone                          = $request->phone;
        $post->user_level                     = $request->user_level;
        $post->is_admin                       = 1;
        $post->password                       = bcrypt($request->password);
        $post->save();

        if ($request->user_level == 1){

            $roles = Roles::all();
            foreach ($roles as $rows){
                $data = new UserRoles();
                $data->user_id = $post->id;
                $data->role_id = $rows->id;
                $data->status = 1;
                $data->save();
            }
        }


        Session::flash('message', "User Created successfully");
        return back();
    }


    /**
     * @param Request $request
     * @return RedirectResponse
     */
    public function UpdateUserAccount(Request $request): RedirectResponse
    {

        $data = User::find($request->id);
        $data->user_status =  $request->status;
        $data->update();

        return back()->withInput()->with('success','successfully');

    }


    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function UpdateProfilePhoto(Request $request): JsonResponse
    {

        $validator = Validator::make($request->all(), [
            'picture' => 'required|file|max:500',
        ]);

        if ($validator->fails()) {
            return response()->json('Image is more than 500kb',500);
        }

        $id = Auth::user()->id;

        $image = $request->picture;
        $filename = time().".".$image->extension();
        // Create directory if it does not exist
        $path = public_path()."/profile/photo/". Auth::user()->id ."/";
        if(!File::isDirectory($path)) {
            File::makeDirectory(public_path().'/'.$path,0777,true);
        }
        $location = public_path('profile/photo/'. Auth::user()->id .'/');
        $image->move($location, $filename);

        // update account information
        $post = User::find($id);
        $post->profile_image = $filename;
        $post->save();
        return response()->json('profile photo added successfully');

    }

    public function getProfilePhoto()
    {
        return view('admin.user.add_dp');
    }


    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function ChangeUserPassword(Request $request): JsonResponse
    {
        $user = User::find(Auth::user()->id);

        if (!Hash::check($request->current_password, $user->password)) {
            return response()->json('The current password is incorrect',500);
        }

        $validator = Validator::make($request->all(), [
            'new_password' => ['nullable', 'string'],
            'confirm_new_password' => ['nullable', 'required_with:new_password', 'same:new_password']
        ]);

        if ($validator->fails()) {
            return response()->json('Password didn\'t match or your current password is wrong',500);
        }

        $password                   =   $request->new_password;
        $encrypt_pass               =   bcrypt($password);
        $Users                      =   User::find(Auth()->user()->id);
        $Users->password            =   $encrypt_pass;
        $Users->save();

        return response()->json('Password Updated Successfully');
    }


    /**
     * @return Application|Factory|View
     */
    public function getAllCourses(){

        $course = Course::join('users', 'users.id', '=', 'courses.user_id')->select('courses.*', 'users.firstname','users.lastname')->orderBy('courses.id','DESC')->get('courses.*');
        foreach ($course as $row){
            $row["number_of_lessons"] = Lesson::query()->where('course_id', $row->id)->count();
        }
        return view('admin.all_course', compact('course'));
    }


    /**
     * @return Application|Factory|View
     */
    public function getAllGroupSessions()
    {
        $schedule = GroupClass::query()->orderBy('id','DESC')->get();
        foreach ($schedule as $row){
            $row["zoom_response"] = json_decode($row->zoom_response, true);
        }
        return view('admin.all_group_sessions', compact('schedule'));
    }


    /**
     * @return Application|Factory|View
     */
    public function getAllPrivateSession(){
        $private_sessions = ScheduleEvent::query()->orderBy('id','DESC')->get();
        return view('admin.all_private_sessions', compact('private_sessions'));
    }

    public function addUserRole($id){
        $user = User::query()->where('id', $id)->get();
        $roles = Roles::all();

        foreach ($roles as $rw){
            if (UserRoles::query()->where('user_id', $id)->where('role_id', $rw->id)->count() > 0){
                unset($rw->id);
            }
        }

        $user_roles = UserRoles::query()->where('user_id', $id)->get();
        foreach ($user_roles as $row){
            $row['title'] = Roles::query()->where('id', $row->role_id)->value('title');
        }
        return view('admin.add_user_roles', compact('user','roles','user_roles'));

    }


    /**
     * @param Request $request
     * @return RedirectResponse
     */
    public function addRoles(Request $request): RedirectResponse
    {
        foreach ($request->roles as $rw){
            $data = new UserRoles();
            $data->user_id = $request->user_id;
            $data->role_id = $rw;
            $data->save();
        }

        Session::flash('message', "Roles updated for user");
        return redirect()->back();

    }


    /**
     * @param Request $request
     * @return RedirectResponse
     */
    public function removeRoles(Request $request): RedirectResponse
    {
        $data = UserRoles::find($request->id);
        $data->delete();
        Session::flash('message', "Roles deleted for user");
        return redirect()->back();
    }

    /**
     * @param Request $request
     * @return RedirectResponse
     */
    public  function disableAndEnableUser(Request $request): RedirectResponse
    {
        $data = User::find($request->id);
        $data->status = $request->status;
        $data->update();

        Session::flash('message', "User Account Updated");
        return redirect()->back();
    }


    /**
     * @param Request $request
     * @return RedirectResponse
     */
    public function disableCourse(Request $request): RedirectResponse
    {
        $data = Course::find($request->id);
        $data->status = $request->status;
        $data->update();

        Session::flash('message', "User Account Updated");
        return redirect()->back();
    }

    /**
     * @param Request $request
     * @return RedirectResponse
     */
    public function disableGroupSessions(Request $request): RedirectResponse
    {
        $data = GroupClass::find($request->id);
        $data->status = $request->status;
        $data->update();

        Session::flash('message', "User Account Updated");
        return redirect()->back();
    }

    /**
     * @param Request $request
     * @return RedirectResponse
     */
    public function disablePrivateSessions(Request $request): RedirectResponse
    {
        $data = ScheduleEvent::find($request->id);
        $data->status = $request->status;
        $data->update();

        Session::flash('message', "User Account Updated");
        return redirect()->back();
    }

    public static function getAccessControl($user_id){
        return UserRoles::join('roles', 'roles.id', '=', 'user_roles.role_id')
            ->select('roles.*')->where('user_roles.user_id',$user_id)->get();
    }


    /**
     * @param $id
     * @return Application|Factory|View
     */
    public function getCourseTransactions($id){

        $transactions = CoursePayment::join('courses', 'courses.id', '=', 'course_payments.course_id')
            ->where('course_payments.course_id', $id)
            ->select('course_payments.*','courses.*','course_payments.user_id as payer_user_id')->orderBy('course_payments.id','DESC')->get('course_payments.*');

        $this->TransactionHistoryUserInfo($transactions);
        return view('admin.course_payment_history', compact('transactions'));

    }

    /**
     * @param $id
     * @return Application|Factory|View
     */
    public function getGroupSessionTransactions($id){

        $transactions = GroupClassEnrollment::join('group_classes', 'group_classes.id', '=', 'group_class_enrollments.group_class_id')
            ->where('group_classes.id', $id)
            ->select('group_class_enrollments.*','group_classes.*','group_class_enrollments.user_id as payer_user_id')->orderBy('group_class_enrollments.id','DESC')->get('group_class_enrollments.*');

        $this->TransactionHistoryUserInfo($transactions);

        return view('admin.group_session_payment_history', compact('transactions'));

    }

    public function getPrivateSessionTransactions($id){


        $transactions = Schedule::join('schedule_events', 'schedule_events.id', '=', 'schedules.schedule_events_id')
            ->where('schedule_events.id', $id)
            ->select('schedule_events.*','schedules.*','schedules.initiate_user_id as payer_user_id')->orderBy('schedules.id','DESC')->get('schedules.*');

        $this->TransactionHistoryUserInfo($transactions);
        return view('admin.private_session_payment_history', compact('transactions'));

    }

    /**
     * @return Factory|View|Application
     */
    public function viewWithdrawalDetails($id)
    {
        $bank_accounts = AccountDetails::query()->where('user_id', $id)->orderBy('id', 'desc')->get();
        return view('admin.bank-accounts', compact('bank_accounts'));
    }

    /**
     * @param $transactions
     * @return void
     */
    private function TransactionHistoryUserInfo($transactions): void
    {
        foreach ($transactions as $row) {
            $student = User::query()->where('id', $row->payer_user_id)->get();
            $tutor = User::query()->where('id', $row->user_id)->get();
            $row["student"] = $student[0]->firstname . ' ' . $student[0]->lastname;
            $row["tutor"] = $tutor[0]->firstname . ' ' . $tutor[0]->lastname;

        }
    }


}
