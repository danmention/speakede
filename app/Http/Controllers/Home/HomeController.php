<?php

namespace App\Http\Controllers\Home;

use App\Helpers\CommonHelpers;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Course;
use App\Models\CustomerRating;
use App\Models\GroupClass;
use App\Models\GroupClassEnrollment;
use App\Models\Lesson;
use App\Models\PreferredLanguage;
use App\Models\ScheduleEvent;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class HomeController extends Controller
{
    public function getIndex()
    {
        $lang = Category::query()->where('class_name','language')->get();
        $lang_popular = Category::query()->where('class_name','language')->where('popular_status', 1)->get();
        $course = Course::query()->orderBy('id','desc')->get();
        $this->moreCourseInformation($course);
        $expert_teachers = User::query()->where('status', 1)->where('is_admin',0)->limit(4)->get();

        foreach ($expert_teachers as $row){
           $lang_ = PreferredLanguage::query()->where('user_id', $row->id)->limit(1)->orderBy('id','DESC')->value('id');
           $row["lang"] = Category::query()->where('id', $lang_)->value('title') ?? "English";
        }
        return view('home.index', compact('lang','course','lang_popular','expert_teachers'));
    }


    public function getLogin()
    {
        return view('home.login');
    }

    public function getRegister()
    {
        return view('home.register');
    }


    /**
     * @param Request $request
     * @return RedirectResponse
     */
    public function saveUser(Request $request): RedirectResponse
    {
        $validator = Validator::make($request->all(), [
            'firstname' => 'required|string|max:25',
            'lastname' => 'required|string|max:25',
            'password' => 'required|string|min:6|confirmed',
        ]);

        $options = $request->options;
        $check_instance = CommonHelpers::valid_email($options);
        $check_instance_phone = CommonHelpers::validate_phone_number($options);

        if($check_instance){ $case = 0;
        } elseif($check_instance_phone) { $case = 1; } else{
            $validator->getMessageBag()->add('email/phone', 'invalid data supplied');
            return redirect()->back()->withErrors($validator)->withInput();
        }


        if($case == 0){
            $check = User::where('email', $options)->count();
            if($check > 0){
                $validator->getMessageBag()->add('email', 'Email Address already exist');
                return redirect()->back()->withErrors($validator)->withInput();
            }
        }else {
            $check = User::where('phone', $options)->count();
            if($check > 0){
                $validator->getMessageBag()->add('phone', 'Phone Number already exist');
                return redirect()->back()->withErrors($validator)->withInput();
            }
        }

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $post                   = new User();
        switch($case) {
            case 0:
                $post->email = $options;
                break;
            default:
                $post->phone = $options;
                break;
        }

        $identity               = CommonHelpers::generateCramp("user");
        $verify                 = CommonHelpers::code_ref(6);

        $post->role             = $request->account_type;
        $post->firstname        = $request->firstname;
        $post->lastname         = $request->lastname;
        $post->password         = bcrypt($request->password);
        $post->identity         = $identity;
        $post->verify_code      = $verify;

        $post->save();
        Session::flash('message', ' Your registration was successful, please login');
        return redirect()->back();
    }

    public function getCategory()
    {
        return view('home.category');
    }

    public function getGroupClass()
    {
        return view('home.category');
    }

    public function getCommunity()
    {
        return view('home.category');
    }

    public function getTeacherLang()
    {
        return view('home.teacher-view');
    }


    public function getTeacherProfile($id)
    {
        $identity = $id;
        $profile = User::query()->where('identity', $identity)->get();

        $preferred_lang = PreferredLanguage::join('categories', 'categories.id', '=', 'preferred_languages.language_id')
            ->where('preferred_languages.user_id', $profile[0]->id)->get(['categories.*']);
        $private_class = GroupClass::query()->where('status',1)->where('user_id', $profile[0]->id)->get();
        foreach ($private_class as $row){
            $paid_slot =  GroupClassEnrollment::query()->where('group_class_id', $row->id)->count();
            $slot = $row->slot;
            $available = $slot - $paid_slot;
            $row["available_slots"] = $available;
        }

        return view('home.teacher_profile', compact('profile','preferred_lang','private_class','identity'));
    }

    /**
     * @return RedirectResponse
     */
    public function getBecomeATeacher(): RedirectResponse
    {
        if(isset(Auth::user()->id) && Auth::user()->is_admin == 0){
           return redirect()->route('user.apply.step.2');
        } else {
           return redirect()->route('index.login');
        }
    }

    public function findTeacher(){
        $teachers = User::query()->where('is_admin',0)->orderBy('id','DESC')->paginate(15);

        foreach ($teachers as $row){
            $row["preferred_lang"] = PreferredLanguage::join('categories', 'categories.id', '=', 'preferred_languages.language_id')
                ->where('preferred_languages.user_id', $row->id)->get(['categories.*']);
        }
        return view('home.teachers', compact('teachers'));
    }

    public function getAllCourse(){
        $course = Course::query()->orderBy('id','DESC')->paginate(15);
        $this->moreCourseInformation($course);
        return view('home.all-course', compact('course'));
    }

    public function getGroupClasses(){
        $course = GroupClass::query()->orderBy('id','DESC')->paginate(15);
        $this->moreGroupCourseInformation($course);
        $lang = Category::query()->where('class_name','language')->get();
        return view('home.all-group-course', compact('course','lang'));
    }

    public function getViewCourse($url){
        $course = Course::query()->where('url', $url)->get();
        foreach ($course as $row){
            $row["instructor"] = User::query()->where('id', $row->user_id)->get();
            $row["lesson_total"] = Lesson::query()->where('course_id', $row->id)->count();
            $row['rating'] = CustomerRating::where('course_id', $row->id)->count();
        }
        $this->moreCourseInformation($course);
        $lessons = Lesson::query()->where('course_id', $course[0]['id'])->groupBy('group_id')->get();
        $profile = User::query()->where('id', $course[0]["user_id"])->get();
        $reviews = CustomerRating::where('course_id', $course[0]["id"])->get();
        foreach ($reviews as $row){
            $row["profile_image"] = User::query()->where('id', $row->user_id)->value("profile_image");
        }
        return view('home.course_details', compact('course','lessons','profile','reviews'));
    }


    public function getViewGroupCourse($url){
        $course = GroupClass::query()->where('url', $url)->get();
        foreach ($course as $row){
            $row["instructor"] = User::query()->where('id', $row->user_id)->get();
        }
        $this->moreGroupCourseInformation($course);
        $profile = User::query()->where('id', $course[0]["user_id"])->get();
        return view('home.course_group_details', compact('course','profile'));
    }

    public function getTeacherAvailability(Request $request){

        if ($request->ajax()) {
                $user_id = User::query()->where('identity',$request->instructor_user_id)->value('id');
                $data = ScheduleEvent::whereDate('start', '>=', $request->start)
                    ->whereDate('end',   '<=', $request->end)
//                    ->where('instructor_user_id', $user_id)
                    ->get(['id', 'title', 'start', 'end']);

            return response()->json($data);
        }
        return view('home.teacher_profile');
    }

    /**
     * @param $course
     * @return void
     */
    private function moreCourseInformation($course): void
    {
        foreach ($course as $row) {
            $user = User::query()->where('id', $row->user_id)->get();
            $row["firstname"] = $user[0]->firstname;
            $row["lastname"] = $user[0]->lastname;
            $row["identity"] = $user[0]->identity;

            $lesson = Lesson::query()->where('course_id', $row->id)->get();
            $course_duration = 0;
            foreach ($lesson as $rw) {
                $course_duration = +(new CommonHelpers)->getCourseTimeDuration($rw->start_time, $rw->end_time);
            }

            $row['course_duration'] = CommonHelpers::minsToHours($course_duration);
            $row['rating'] = CustomerRating::where('course_id', $row->id)->count();
        }
    }



    /**
     * @param $course
     * @return void
     */
    private function moreGroupCourseInformation($course): void
    {
        foreach ($course as $row) {
            $user = User::query()->where('id', $row->user_id)->get();
            $row["firstname"] = $user[0]->firstname;
            $row["lastname"] = $user[0]->lastname;
            $row["identity"] = $user[0]->identity;
            $row["profile_image"] = $user[0]->profile_image;
        }
    }

    /**
     * @param Request $request
     * @return RedirectResponse
     */
    public function SubmitReviews(Request $request): RedirectResponse
    {
        if($request->rating_pro):
            $data = CommonHelpers::StoreReviews($request);
            if($data->id){
                Session::flash('message', ' Review added successful');
                return redirect()->back();
            }
        endif;
        Session::flash('message', ' something went wrong');
        return redirect()->back();
    }


    /**
     * @param Request $request
     * @return RedirectResponse
     */
    public function bookLesson(Request $request): RedirectResponse
    {
        if (empty(Auth::user())){
            return redirect()->route('index.login');
        }
        return redirect()->to('user/apply/booking/lesson?teacher_id='.$request->teacher_id.'&id='.$request->id);
    }


    /**
     * @param $user_id
     * @return int
     */
    public function getRating($user_id):int {

        $numbers_of_rating =  CustomerRating::where('user_id',$user_id)->sum('rating');
        $number_of_people_rating = CustomerRating::where('user_id',$user_id)->count();

        if($number_of_people_rating == 0){
            $final_rating = 0;
        }else {
            $final_rating = $numbers_of_rating / $number_of_people_rating;
        }
       return $final_rating;
    }


    public function getSearchResult(Request $request){
        $course = Course::select('*')->where('title','LIKE','%'.$request->keyword.'%')->where('status', 1)->paginate(40);
        return view('home.search', compact('course'));
    }

}
