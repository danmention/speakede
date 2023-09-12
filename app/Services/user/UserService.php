<?php

namespace App\Services\user;

use App\Helpers\CommonHelpers;
use App\Http\Controllers\User\PaymentController;
use App\Models\Category;
use App\Models\Course;
use App\Models\CoursePayment;
use App\Models\GroupClass;
use App\Models\LanguageISpeak;
use App\Models\Lesson;
use App\Models\PaymentTransaction;
use App\Models\PreferredLanguage;
use App\Models\RelatedCourses;
use App\Models\Schedule;
use App\Models\ScheduleEvent;
use App\Models\User;
use App\Services\zoom\ZoomServiceImpl;
use Carbon\Carbon;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Session;

class UserService
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
     * @param $request
     * @return array
     */
    public function getUserDashboard($request): array
    {
        if ($request->identity){
            $user_id = User::query()->where('identity',$request->identity)->value('id');
        } else {
            $user_id = Auth::user()->id;
        }

        $wallet = $this->accountBalance($user_id);
        $paid_course = CoursePayment::query()->where('user_id', $user_id)->count();
        $sold_course = CoursePayment::join('courses', 'courses.id', '=', 'course_payments.course_id')->where('courses.user_id', $user_id)->get(['courses.*'])->count();
        $paid_group_sessions = GroupClass::join('group_class_enrollments', 'group_class_enrollments.group_class_id', '=', 'group_classes.id')
            ->where('group_class_enrollments.user_id',$user_id)->get(['group_classes.*'])->count();

        $sold_group_sessions = GroupClass::join('group_class_enrollments', 'group_class_enrollments.group_class_id', '=', 'group_classes.id')
            ->where('group_classes.user_id',$user_id)->get(['group_classes.*'])->count();

        $paid_private_sessions = Schedule::query()->where('initiate_user_id',$user_id)->where('instructor_user_id', '!=', $user_id)
            ->where('status',1)->count();

        $created_group_sessions = GroupClass::join('categories', 'categories.id', '=', 'group_classes.language_id')
            ->where('group_classes.user_id',$user_id)->get(['group_classes.*'])->count();
        $created_private_sessions = ScheduleEvent::query()->where('user_id',$user_id)->orderBy('id','DESC')->count();
        $course = Course::query()->where('user_id', $user_id)->count();

        $sold_private_sessions =Schedule::query()->where('instructor_user_id',$user_id)->where('initiate_user_id', '!=', $user_id)->where('status',1)->count();


        return array(
            "total_created" => $created_group_sessions + $course + $created_private_sessions,
            "wallet" => $wallet,
            "course" => $course,
            "paid_course" => $paid_course,
            "sold_course" =>$sold_course,
            "created_group_sessions" =>$created_group_sessions,
            "paid_group_sessions" =>$paid_group_sessions,
            "sold_group_sessions" => $sold_group_sessions,
            "paid_private_sessions" => $paid_private_sessions,
            "created_private_sessions" =>$created_private_sessions,
            "sold_private_sessions" =>$sold_private_sessions


        );

    }


    /**
     * @param $user_id
     * @return int
     */
    private function accountBalance($user_id): int

    {
        $account_balance = PaymentTransaction::query()->where('user_id', $user_id)->where('type', 1)->sum('amount');

        $used_balance = PaymentTransaction::query()->where('user_id', $user_id)->where('type', 0)->sum('amount');

        if ($used_balance == 0) {
            $wallet = $account_balance;
        } else {
            $wallet = $account_balance - $used_balance;
        }
        return $wallet;
    }


    /**
     * @return array
     */
    public function getAddCourseInfo(): array
    {
        $preferred_lang = PreferredLanguage::join('categories', 'categories.id', '=', 'preferred_languages.language_id')
            ->where('preferred_languages.user_id',Auth::user()->id)->get(['categories.*','preferred_languages.price']);
        $use_cases = Category::query()->where('class_name','use_cases')->orderBy('id','desc')->get();

        return array(
            "use_cases" => $use_cases,
            "preferred_lang" => $preferred_lang
        );
    }


    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function saveCourse(Request $request): JsonResponse
    {
        $use_cases_ids  = json_decode($request->use_cases_id,true);
        $use_cases_id = $use_cases_ids[0];

        $data = new Course();
        $data->url = strtolower(CommonHelpers::create_unique_slug($request->title,"courses","url"));
        $data->title = $request->title;
        $data->price = $request->price ?? 0;
        $data->description = $request->desc;
        $data->youtube_link = $request->youtube_link ?? null;
        $data->language = $request->language;
        $data->type = $request->course_type;
        $data->use_cases_id = $use_cases_id;
        $data->user_id = Auth::user()->id;

        $image = $request->picture;
        $filename = time().".".$image->extension();
        // Create directory if it does not exist
        $path = public_path()."/course/photo/". Auth::user()->id ."/";
        if(!File::isDirectory($path)) {
            File::makeDirectory(public_path().'/'.$path,0777,true);
        }
        $location = public_path('course/photo/'. Auth::user()->id .'/');
        $image->move($location, $filename);

        $data->cover_image = $filename;
        $data->save();

        if (count($use_cases_ids) > 1){
            foreach ($use_cases_ids as $row){
                $new_course = new RelatedCourses();
                $new_course->user_id = Auth::user()->id;
                $new_course->use_cases_id = $row;
                $new_course->course_id = $data->id;
                $new_course->save();
            }
        }

        return response()->json('Course added successfully');
    }


    /**
     * @return array
     */
    public function discoverCourses(): array
    {
        $course = Course::query()->orderBy('id','DESC')->get();
        return array(
            "course" => $course,
        );
    }

    /**
     * @return array
     */
    public function allCourse(): array
    {

        $course = Course::query()->where('user_id', Auth::user()->id)->orderBy('id','DESC')->get();
        return array(
            "course" => $course,
        );
    }

    /**
     * @return array
     */
    public function paidCourse(): array
    {
        $course = CoursePayment::join('courses', 'courses.id', '=', 'course_payments.course_id')
            ->where('course_payments.user_id', Auth::user()->id)->select('course_payments.user_id as payed_user_id','courses.*' )->get(['courses.*']);
        return array(
            "course" => $course,
        );
    }

    /**
     * @return array
     */
    public function soldCourse(): array
    {

        $course = CoursePayment::join('courses', 'courses.id', '=', 'course_payments.course_id')->where('courses.user_id', Auth::user()->id)
            ->get(['courses.*']);
        return array(
            "course" => $course,
        );

    }

    /**
     * @param Request $request
     * @return array
     */
    public function courseByActions(Request $request): array
    {


        if($request->segment(3) ==="type"){
            $course = Course::query()->where('type', strtoupper($request->segment(4)))->where('user_id',  Auth::user()->id)
                ->orderBy('id','desc')->get();
        }elseif ($request->segment(3) ==="theme"){
            $course =  RelatedCourses::join('courses', 'courses.id', '=', 'related_courses.course_id')->select('courses.*') ->orderBy('courses.id','desc')->get();

        } else {
            $course = Course::query()->where('user_id',  Auth::user()->id)->orderBy('id','desc')->get();
        }
        return array(
            "course" => $course,
        );
    }


    /**
     * @param $url
     * @return array
     */
    public function viewCourse($url): array
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

        return array(
            'course' => $course,
            'lessons' => $lessons,
            'canWatch' =>$canWatch,
            'iAddedThisCourse' => $iAddedThisCourse
        );
    }


    /**
     * @param Request $request
     * @return Application|Factory|View
     */
    public function viewPaidCourse(Request  $request){

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
     * @return array
     */
    public function buyCourse($id): array
    {
        $wallet = $this->accountBalance(Auth::user()->id);
        $course = Course::query()->where('id', $id)->get();

        return array(
            'wallet' =>$wallet,
            'course' =>$course
        );
    }


    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function addLessons(Request $request): JsonResponse
    {
        $data                   = new Lesson();
        if(!empty($request->existing && !$request->existing == "undefined")){
            $lesson_name = Lesson::query()->where('group_id', $request->existing)->orderBy('id','desc')
                ->take(1)->value('lesson_name');
            $data->group_id         = $request->existing;
            $data->lesson_name      = $lesson_name;
        } else {
            $data->group_id         = CommonHelpers::code_ref(10);
            $data->lesson_name      = $request->lesson_name;
        }
        $data->url              = strtolower(CommonHelpers::create_unique_slug($request->title,"lessons","url"));
        $data->lesson_title     = $request->title;
        $data->description      = $request->desc;
        $data->youtube_link     = $request->youtube_link;
        $data->course_id        = $request->course_id;
        $data->start_time       = Carbon::now();
        $data->end_time         = Carbon::now();
        $data->save();

        return response()->json('Lesson added successfully');
    }


    /**
     * @param Request $request
     * @return RedirectResponse
     */
    public function handleCoursePay(Request $request): RedirectResponse
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
     * @param Request $request
     * @return RedirectResponse
     */
    public function updateProfileAfterRegistration(Request $request): RedirectResponse
    {

        if (!empty($request->language_id)){
            foreach ($request->language_id as $row){
                $lang = new PreferredLanguage();
                $lang->user_id = Auth::user()->id;
                $lang->language_id = $row;
                $lang->save();
            }
        }

        foreach ($request->i_speak_language_id as $row){
            $lang = new LanguageISpeak();
            $lang->user_id = Auth::user()->id;
            $lang->language_id = $row;
            $lang->save();
        }

        $profile = User::find(Auth::user()->id);
        $profile->about_me = $request->about_me;
        $profile->update();

        Session::flash('message', "profile updated");
        return redirect()->route('user.dashboard.discover.course.all');
    }

    /**
     * @param Request $request
     * @return array
     */
    public function virtualBookingInit(Request $request): array
    {
        $wallet = $this->accountBalance(Auth::user()->id);
        $teacher_id = $request->teacher_id;
        $id = $request->id;
        $lang = $request->language;
        $instructor = User::query()->where('identity', $teacher_id)->get();
        $schedule_info = ScheduleEvent::query()->where('id', $id)->get();

        $preferred_lang = PreferredLanguage::join('categories', 'categories.id', '=', 'preferred_languages.language_id')
            ->where('preferred_languages.id',$lang)->get(['categories.*','preferred_languages.price']);

        return array(
            'instructor' => $instructor,
            'wallet' => $wallet,
            'schedule_info' => $schedule_info,
            'teacher_id' => $teacher_id,
            'id' => $id,
            'preferred_lang' => $preferred_lang
        );
    }


    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function saveGroupSessions(Request  $request): JsonResponse
    {
        $zoom_response =  $this->zoomServiceImpl->bookMeeting($request);

        $image = $request->picture;
        $filename = time().".".$image->extension();
        // Create directory if it does not exist
        $path = public_path()."/group/class/photo/". Auth::user()->id ."/";
        if(!File::isDirectory($path)) {
            File::makeDirectory(public_path().'/'.$path,0777,true);
        }
        $location = public_path('group/class/photo/'. Auth::user()->id .'/');
        $image->move($location, $filename);


        $data = new GroupClass();
        $data->user_id = Auth::user()->id;
        $data->title = $request->title;
        $data->price = $request->price ?? 0;
        $data->description = $request->description;
        $data->language_id = $request->language;
        $data->slot = $request->slot;
        $data->start_date = $request->start_date;
        $data->duration_in_mins = $request->duration;
        $data->url = CommonHelpers::create_unique_slug($request->title,"group_classes","url");
        $data->zoom_response = json_encode($zoom_response);
        $data->cover_image = $filename;
        $data->type = $request->class_type;
        $data->save();

        return response()->json('Group Sessions created successfully');
    }


    /**
     * @return array
     */
    public function getGroupSessions(): array
    {
        $user_id = Auth::user()->id;
        $schedule = GroupClass::join('categories', 'categories.id', '=', 'group_classes.language_id')
            ->where('group_classes.user_id',$user_id)->get(['group_classes.*']);
        foreach ($schedule as $row){
            $row["zoom_response"] = json_decode($row->zoom_response, true);
        }
        return array(
            'schedule' => $schedule
        );
    }

    /**
     * @return array
     */
    public function getPaidGroupSessions(): array
    {
        $user_id = Auth::user()->id;
        $schedule = GroupClass::join('group_class_enrollments', 'group_class_enrollments.group_class_id', '=', 'group_classes.id')
            ->where('group_class_enrollments.user_id',$user_id)->get(['group_classes.*']);
        foreach ($schedule as $row){
            $row["zoom_response"] = json_decode($row->zoom_response, true);
        }
        return array(
            'schedule' => $schedule
        );
    }


    /**
     * @return array
     */
    public function getSoldGroupSessions(): array
    {
        $user_id = Auth::user()->id;
        $schedule = GroupClass::join('group_class_enrollments', 'group_class_enrollments.group_class_id', '=', 'group_classes.id')
            ->where('group_classes.user_id',$user_id)->get(['group_classes.*']);
        foreach ($schedule as $row){
            $row["zoom_response"] = json_decode($row->zoom_response, true);
        }
        return array(
            'schedule' => $schedule
        );
    }


    /**
     * @param Request $request
     * @return array|RedirectResponse
     */
    public function payingViewGroupSessions(Request $request){

        if(empty(Auth::user())){
            Session::flash('message', "Please login to access this area");
            return redirect()->route('index.login');
        }
        $wallet = $this->accountBalance(Auth::user()->id);
        $teacher_id = $request->teacher_id;
        $slot = $request->slot;
        $slot_id = $request->id;
        $instructor = User::query()->where('identity', $teacher_id)->get();
        $schedule_info =  GroupClass::join('categories', 'categories.id', '=', 'group_classes.language_id')
            ->where('group_classes.id',$slot_id)->get(['group_classes.*']);

        return array(
            'instructor' => $instructor,
            'wallet' => $wallet,
            'schedule_info' => $schedule_info,
            'teacher_id' => $teacher_id,
            'slot' => $slot,
            'slot_id' => $slot_id
        );
    }


    /**
     * @return array
     */
    public function getTutors(): array
    {
        $tutors = User::join('courses', 'courses.user_id', '=', 'users.id')->groupBy('users.id')->select(['users.*'])->orderBy('users.id', 'DESC')->paginate(15);
        foreach ($tutors as $row) {
            $row["preferred_lang"] = PreferredLanguage::join('categories', 'categories.id', '=', 'preferred_languages.language_id')
                ->where('preferred_languages.user_id', $row->id)->get(['categories.*']);
            $row["rating"] = CommonHelpers::ratingUser($row->id);
        }
        return array(
            'tutors' => $tutors
        );
    }

    /**
     * @param Request $request
     * @return array
     */
    public function discoverCourseByAction(Request $request): array
    {

        if($request->segment(3) ==="type"){
            $course = Course::query()->where('type', strtoupper($request->segment(4)))->orderBy('id','desc')->get();
        }elseif ($request->segment(3) ==="theme"){
            $course = Course::query()->where('use_cases_id', '!=',null)->orderBy('id','desc')->get();
        } else {
            $course = Course::query()->orderBy('id','desc')->get();
        }
        return array(
            'course' => $course
        );
    }


    /**
     * @param Request $request
     * @return array
     */
    public function sessionsByActions(Request $request): array
    {
        if($request->segment(3) ==="type"){
            $sessions = GroupClass::query()->where('type', strtoupper($request->segment(4)))->orderBy('id', 'DESC')->paginate(15);
        } elseif ($request->segment(3) ==="theme"){
            $sessions = GroupClass::query()->orderBy('id', 'DESC')->paginate(15);
        }else {
            $sessions = GroupClass::query()->orderBy('id', 'DESC')->paginate(15);
        }

        (new CommonHelpers)->moreGroupCourseInformation($sessions);

        return array(
            'sessions' => $sessions
        );
    }

    public function getUseCases(Request $request): array
    {
        $category = Category::query()->where('url', $request->link)->value('id');
        $course =  RelatedCourses::join('courses', 'courses.id', '=', 'related_courses.course_id')
                ->where('related_courses.use_cases_id', $category)->orWhere('courses.use_cases_id', $category)->select('courses.*')->paginate(15);
        (new CommonHelpers)->moreCourseInformation($course);

        return array(
            'course' => $course
        );
    }
}
