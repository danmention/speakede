<?php

namespace App\Http\Controllers\User;

use App\Helpers\CommonHelpers;
use App\Models\Category;
use App\Models\Course;
use App\Models\CoursePayment;
use App\Models\GroupClass;
use App\Models\Lesson;
use App\Models\PaymentTransaction;
use App\Models\PreferredLanguage;
use App\Models\ScheduleEvent;
use App\Models\User;
use App\Services\zoom\ZoomServiceImpl;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class UserController
{

    private $zoomServiceImpl;

    /**
     * @param ZoomServiceImpl $zoomServiceImpl
     */
    public function __construct(ZoomServiceImpl $zoomServiceImpl)
    {
        $this->zoomServiceImpl = $zoomServiceImpl;
    }


    /**
     * @return Application|Factory|View|RedirectResponse
     */
    public function getIndex()
    {
        $user_id = Auth::user()->id;
        $wallet = $this->accountBalance();
        $course = Course::query()->where('user_id', $user_id)->count();
        $paidCourse = CoursePayment::query()->where('user_id', $user_id)->count();

        if (empty(Auth::user()->about_me)){
            return redirect()->route('user.apply.final');
        }
        return view('user.dashboard', compact('wallet', 'course','paidCourse'));
    }


    /**
     * @return Application|Factory|View|RedirectResponse
     */
    public function getCourse()
    {
        if (empty(Auth::user()->about_me)){
            return redirect()->route('user.apply.final');
        }
        $preferred_lang = PreferredLanguage::join('categories', 'categories.id', '=', 'preferred_languages.language_id')
            ->where('preferred_languages.user_id',Auth::user()->id)->get(['categories.*','preferred_languages.price']);
        return view('user.course.add-course', compact('preferred_lang'));
    }


    /**
     * @param Request $request
     * @return RedirectResponse
     */
    public function saveCourse(Request $request): RedirectResponse
    {
        $data = new Course();
        $data->url = strtolower(CommonHelpers::str_slug($request->title));
        $data->title = $request->title;
        $data->price = $request->price;
        $data->description = $request->desc;
        $data->youtube_link = $request->youtube_link;
        $data->language = $request->language;
        $data->user_id = Auth::user()->id;
        $data->save();

        Session::flash('message', ' Course added successful');
        return redirect()->back();
    }


    /**
     * @return Application|Factory|View|RedirectResponse
     */
    public function allCourse()
    {
        if (empty(Auth::user()->about_me)){
            return redirect()->route('user.apply.final');
        }
        $course = Course::query()->where('user_id', Auth::user()->id)->orderBy('id','DESC')->get();
        return view('user.course.all_course', compact('course'));
    }


    /**
     * @return Application|Factory|View|RedirectResponse
     */
    public function allPaidCourse()
    {
        if (empty(Auth::user()->about_me)){
            return redirect()->route('user.apply.final');
        }

        $course = CoursePayment::join('courses', 'courses.id', '=', 'course_payments.course_id')
            ->get(['courses.*']);

        return view('user.course.all_course', compact('course'));
    }


    /**
     * @param $url
     * @return Factory|View|Application
     */
    public function viewCourse($url)
    {
        $canWatch = false;
        $iAddedThisCourse = false;
        $course = Course::query()->where('url', $url)->get();
        $lessons = Lesson::query()->where('course_id', $course[0]->id)->groupBy('group_id')->get();

        foreach ($lessons as $rw){
            $course_duration = (new CommonHelpers)->getCourseTimeDuration($rw->start_time, $rw->end_time);
            $rw['course_duration'] = CommonHelpers::minsToHours($course_duration);
        }


        if((int)$course[0]->user_id == Auth::user()->id){
            $iAddedThisCourse =  true;
        }

        $coursePayment = CoursePayment::query()->where('user_id', Auth::user()->id)->where('course_id', $course[0]->id)->get()->count();
        if($iAddedThisCourse){
            $canWatch = true;
        } elseif ($coursePayment > 0) {
            $canWatch = true;
        }

        foreach ($course as $row){
            $user =  User::query()->where('id', $row->user_id)->get();
            $row["about_me"] = $user[0]->about_me;
            $row["fullname"] = $user[0]->firstname . ' '.$user[0]->lastname;
        }
        return view('user.course.view_course', compact('course','lessons','canWatch','iAddedThisCourse'));

    }

    /**
     * @param Request $request
     * @return Factory|View|Application
     */
    public function viewPaidCourse(Request $request)
    {
        $course_link = $request->segment(4);
        $lesson_link =  $request->segment(5);

        //validating payment for course
        $courseDetails = Course::query()->where('url', $course_link)->get();

        if( $courseDetails[0]->user_id ==  Auth::user()->id){
            $lessons = Lesson::query()->where('url', $lesson_link)->get();
            return view('user.course.view_lesson', compact('lessons'));
        } else {
            $coursePayment = CoursePayment::query()->where('user_id', Auth::user()->id)->where('course_id', $courseDetails[0]->id)->count();
            if($coursePayment > 0){
                $lessons = Lesson::query()->where('url', $lesson_link)->get();
                return view('user.course.view_lesson', compact('lessons'));
            } else {
                return view('user.course.504');
            }
        }
    }

    /**
     * @param $id
     * @return Factory|View|Application
     */
    public function addLesson($id)
    {
        $course = Course::query()->where('id', $id)->get();
        $lessons = Lesson::query()->where('course_id', $id)->count();
        return view('user.course.add-lesson', compact('course','lessons'));
    }


    /**
     * @param Request $request
     * @return RedirectResponse
     */
    public function saveLesson(Request $request): RedirectResponse
    {
        $data                   = new Lesson();

        if(!empty($request->existing)){
            $lesson_name = Lesson::query()->where('group_id', $request->existing)->orderBy('id','desc')
                ->take(1)->value('lesson_name');
            $data->group_id         = $request->existing;
            $data->lesson_name      = $lesson_name;
        } else {
            $data->group_id         = CommonHelpers::code_ref(10);
            $data->lesson_name      = $request->lesson_name;
        }
        $data->url              = strtolower(CommonHelpers::str_slug($request->title));
        $data->lesson_title     = $request->title;
        $data->description      = $request->desc;
        $data->youtube_link     = $request->youtube_link;
        $data->course_id        = $request->course_id;
        $data->start_time       = $request->start_time;
        $data->end_time         = $request->end_time;
        $data->save();

        Session::flash('message', ' Lesson added successful');
        return redirect()->back();
    }

    /**
     * @return Factory|View|Application
     */
    public function getBecomeATeacher()
    {
        return view('home.become_a_teacher');
    }

    public function buySpeakToken()
    {
        $payment = PaymentTransaction::query()->where('user_id', Auth::user()->id)
            ->orderBy('id','desc')->get();
        return view('user.wallet_funding', compact('payment'));
    }

    public function getProfilePhoto()
    {
        return view('user.add_dp');
    }

    public function changePassword(){
        return view('user.change-password');
    }

    public function addMyFreeSchedule(){
        return view('user.change-password');
    }

    /**
     * @return Application|Factory|View
     */
    public function buyCourse($id)
    {
        $wallet = $this->accountBalance();
        $course = Course::query()->where('id', $id)->get();
        return view('user.course.buy-course', compact('course','wallet'));
    }

    public function coursePaymentInit(Request $request): RedirectResponse
    {
        $ref = CommonHelpers::code_ref(10);
        //performing wallet debit
        try {
            PaymentController::handleCoursePayment($request,$ref);

            $data = new CoursePayment();
            $data->user_id = Auth::user()->id;
            $data->course_id =  $request->course_id;
            $data->reference_no = $ref;
            $data->is_active = "yes";
            $data->save();

            Session::flash('message', "payment successful, your course is available for viewing");
            return redirect()->route('user.dashboard');
        } catch (\Exception $e){
            Session::flash('message', "payment not successful");
            return redirect()->route('user.dashboard');
        }
    }

    /**
     * @return int
     */
    private function accountBalance(): int

    {
        $user_id = Auth::user()->id;
        $account_balance = PaymentTransaction::query()->where('user_id', $user_id)->where('type', 1)->sum('amount');

        $used_balance = PaymentTransaction::query()->where('user_id', $user_id)->where('type', 0)->sum('amount');

        if ($used_balance == 0) {
            $wallet = $account_balance;
        } else {
            $wallet = $account_balance - $used_balance;
        }
        return $wallet;
    }

    public function addTeachersInfo(){
        $lang = Category::query()->where('class_name', 'language')->get();
        return view('user.add-teacher-info', compact('lang'));
    }


    public function updateUserInfo(Request $request): RedirectResponse
    {

        foreach ($request->language_id as $row){
            $lang = new PreferredLanguage();
            $lang->user_id = Auth::user()->id;
            $lang->language_id = $row;
            $lang->save();
        }

        $profile = User::find(Auth::user()->id);
        $profile->about_me = $request->about_me;
        $profile->update();

        Session::flash('message', "profile updated");
        return redirect()->route('user.dashboard');
    }



    public function processingVirtualBooking(Request $request){

        $profile = User::query()->where('identity',$request->teacher_id)->get();
        $preferred_lang = PreferredLanguage::join('categories', 'categories.id', '=', 'preferred_languages.language_id')
            ->where('preferred_languages.user_id', $profile[0]->id)->get(['categories.*']);
        return view('user.select-virtual-meeting', compact('preferred_lang'));
    }

    /**
     * @return Application|Factory|View
     */
    public function payVirtualBooking(Request $request)
    {
        $wallet = $this->accountBalance();
        $teacher_id = $request->teacher_id;
        $id = $request->id;
        $lang = $request->language;
        $instructor = User::query()->where('identity', $teacher_id)->get();
        $schedule_info = ScheduleEvent::query()->where('id', $id)->get();

        $preferred_lang = PreferredLanguage::join('categories', 'categories.id', '=', 'preferred_languages.language_id')
            ->where('preferred_languages.id',$lang)->get(['categories.*','preferred_languages.price']);
        return view('user.pay-online-meeting', compact('instructor','wallet','schedule_info','teacher_id','id','preferred_lang'));
    }

    public function preferredLanguage(){

        $preferred_lang = $this->getPreferred_lang();
        return view('user.preferred-language', compact('preferred_lang'));
    }


    public function createGroupClass(){
        $preferred_lang = $this->getPreferred_lang();
        return view('user.create_group_class', compact('preferred_lang'));
    }

    public function saveGroupClassMeeting(Request $request): RedirectResponse
    {

        $zoom_response =  $this->zoomServiceImpl->bookMeeting($request);

        $data = new GroupClass();
        $data->user_id = Auth::user()->id;
        $data->title = $request->title;
        $data->price = $request->price;
        $data->description = $request->description;
        $data->language_id = $request->language;
        $data->slot = $request->slot;
        $data->start_date = $request->start_date;
        $data->duration_in_mins = $request->duration;
        $data->url = CommonHelpers::create_unique_slug($request->title,"group_classes","url");
        $data->zoom_response = json_encode($zoom_response);
        $data->save();

        Session::flash('message', "Group Class created");
        return redirect()->route('user.dashboard');
    }

    public function getGroupClass(){

        $user_id = Auth::user()->id;
        $schedule = GroupClass::join('categories', 'categories.id', '=', 'group_classes.language_id')
            ->where('group_classes.user_id',$user_id)->get(['group_classes.*']);
        foreach ($schedule as $row){
            $row["zoom_response"] = json_decode($row->zoom_response, true);
        }
        return view('user.all_group_class', compact('schedule'));
    }


    public function getGroupClassPaid(){

        $user_id = Auth::user()->id;
        $schedule = GroupClass::join('group_class_enrollments', 'group_class_enrollments.group_class_id', '=', 'group_classes.id')
            ->where('group_class_enrollments.user_id',$user_id)->get(['group_classes.*']);
        foreach ($schedule as $row){
            $row["zoom_response"] = json_decode($row->zoom_response, true);
        }
        return view('user.all_group_class', compact('schedule'));
    }


    /**
     * @return Application|Factory|View
     */
    public function payVirtualGroupBooking(Request $request)
    {
        $wallet = $this->accountBalance();
        $teacher_id = $request->teacher_id;
        $slot = $request->slot;
        $slot_id = $request->id;
        $instructor = User::query()->where('identity', $teacher_id)->get();
        $schedule_info =  GroupClass::join('categories', 'categories.id', '=', 'group_classes.language_id')
            ->where('group_classes.id',$slot_id)->get(['group_classes.*']);

        return view('user.pay-group-online-meeting', compact('instructor','wallet','schedule_info','teacher_id','slot','slot_id'));
    }

    /**
     * @return mixed
     */
    private function getPreferred_lang()
    {
        return PreferredLanguage::join('categories', 'categories.id', '=', 'preferred_languages.language_id')
            ->where('preferred_languages.user_id', Auth::user()->id)->get(['categories.*', 'preferred_languages.price']);
    }


}
