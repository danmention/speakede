<?php

namespace App\Services\home;

use App\Helpers\CommonHelpers;
use App\Mail\VerifyYourSpeakedeAccount;
use App\Models\Category;
use App\Models\Course;
use App\Models\CourseRating;
use App\Models\GroupClass;
use App\Models\GroupClassEnrollment;
use App\Models\LanguageISpeak;
use App\Models\Lesson;
use App\Models\PreferredLanguage;
use App\Models\RelatedCourses;
use App\Models\ScheduleEvent;
use App\Models\User;
use App\Models\UserRating;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class HomeService
{

    /**
     * @return array
     */
    public function getHomeService(): array
    {
        $user_id = Auth::user()->id ?? null;
        $lang = Category::query()->where('class_name', 'language')->get();
        $use_cases = Category::query()->where('class_name', 'use_cases')->get();
        $course = Course::query()->orderBy('id', 'desc')->get();
        (new CommonHelpers)->moreCourseInformation($course);

        $expert_teachers = User::join('preferred_languages', 'preferred_languages.user_id', '=', 'users.id')
            ->where('users.status', 1)->groupBy('preferred_languages.user_id')
            ->where(function ($query) use ($user_id) {
                if (!empty($user_id)) {
                    $query->where("users.id", "!=", $user_id);
                }
            })->where('users.is_admin', 0)->orderBy(DB::raw('RAND()'))->limit(4)->get(['users.*']);

        foreach ($expert_teachers as $row) {
            $lang_ = PreferredLanguage::query()->where('user_id', $row->id)->limit(1)->orderBy('id', 'DESC')->value('language_id');
            $row["lang"] = Category::query()->where('id', $lang_)->value('title') ?? "English";
        }

        $themes = [7,12,9,13,10];
        $use_cases_course = Category::query()->whereIn('id', $themes)->orderBy('id','desc')->take(5)->get();


        return array(
            "lang" => $lang,
            "use_cases" => $use_cases,
            "course" => $course,
            "expert_teachers" => $expert_teachers,
            "use_cases_course" => $use_cases_course
        );
    }

    /**
     * @param Request $request
     * @return RedirectResponse
     */
    public function registerUser(Request $request): RedirectResponse
    {

        $validator = Validator::make($request->all(), [
            'firstname' => 'required|string|max:25',
            'lastname' => 'required|string|max:25',
            'password' => 'required|string|min:6|confirmed',
        ]);

        $options = $request->options;
        $check_instance = CommonHelpers::valid_email($options);
        $check_instance_phone = CommonHelpers::validate_phone_number($options);

        if ($check_instance) {
            $case = 0;
        } elseif ($check_instance_phone) {
            $case = 1;
        } else {
            $validator->getMessageBag()->add('email/phone', 'invalid data supplied');
            return redirect()->back()->withErrors($validator)->withInput();
        }


        if ($case == 0) {
            $check = User::where('email', $options)->count();
            if ($check > 0) {
                $validator->getMessageBag()->add('email', 'Email Address already exist');
                return redirect()->back()->withErrors($validator)->withInput();
            }
        } else {
            $check = User::where('phone', $options)->count();
            if ($check > 0) {
                $validator->getMessageBag()->add('phone', 'Phone Number already exist');
                return redirect()->back()->withErrors($validator)->withInput();
            }
        }

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $post = new User();
        switch ($case) {
            case 0:
                $post->email = $options;
                break;
            default:
                $post->phone = $options;
                break;
        }

        $identity = CommonHelpers::generateCramp("user");
        $verify = CommonHelpers::code_ref(6);

        $post->role = $request->account_type;
        $post->firstname = $request->firstname;
        $post->lastname = $request->lastname;
        $post->password = bcrypt($request->password);
        $post->identity = $identity;
        $post->verify_code = $verify;
        $post->status = 0;
        $post->save();

        if ($request->admin){
            if (!empty($request->language_id)){
                foreach ($request->language_id as $row){
                    $lang = new PreferredLanguage();
                    $lang->user_id = $post->id;
                    $lang->language_id = $row;
                    $lang->save();
                }
            }

            foreach ($request->i_speak_language_id as $row){
                $lang = new LanguageISpeak();
                $lang->user_id = $post->id;
                $lang->language_id = $row;
                $lang->save();
            }

            $profile = User::find($post->id);
            $profile->about_me = $request->about_me;
            $profile->update();
        }

        $details    =   [
            'name'=>$request->firstname. ' '.$request->lastname,
            'code' => $verify,
            'email'=> $request->email,
            'link' => url('verify-account/'.$identity.'/'.$verify)
        ];

        Mail::to($request->email)->send(new VerifyYourSpeakedeAccount($details));

        if ($request->admin){
            return redirect()->back()->with('response', "Your registration was successful, please login");
        }
        return redirect()->route('index.login')->with('response', "Your registration was successful, please login");
    }


    /**
     * @param $id
     * @return array
     */
    public function teacherProfile($id): array
    {
        $identity = $id;
        $profile = User::query()->where('identity', $identity)->get();

        $preferred_lang = PreferredLanguage::join('categories', 'categories.id', '=', 'preferred_languages.language_id')
            ->where('preferred_languages.user_id', $profile[0]->id)->get(['categories.*']);

        $language_i_speak = LanguageISpeak::join('categories', 'categories.id', '=', 'language_i_speaks.language_id')
            ->where('language_i_speaks.user_id', $profile[0]->id)->get(['categories.*']);
        $private_class = GroupClass::query()->where('status', 1)->where('user_id', $profile[0]->id)->get();
        foreach ($private_class as $row) {
            $paid_slot = GroupClassEnrollment::query()->where('group_class_id', $row->id)->count();
            $slot = $row->slot;
            $available = $slot - $paid_slot;
            $row["available_slots"] = $available;
        }

        $reviews = UserRating::where('tutor_user_id', $profile[0]["id"])->get();
        foreach ($reviews as $row) {
            $user_profile = User::query()->where('id', $row->tutor_user_id)->get();
            $row["profile_image"] = $user_profile[0]->profile_image;
            $row["fullname"] = $user_profile[0]->firstname. ' '.$user_profile[0]->lastname;
        }

        return array(
            'profile' => $profile,
            'preferred_lang' => $preferred_lang,
            'language_i_speak' => $language_i_speak,
            'private_class' => $private_class,
            'identity' => $identity,
            'reviews' => $reviews
        );

    }

    /**
     * @return LengthAwarePaginator
     */
    public function findTutor(): LengthAwarePaginator
    {
        $user_id = Auth::user()->id ?? null;
        $teachers = User::join('preferred_languages', 'preferred_languages.user_id', '=', 'users.id')
            ->where('users.status', 1)->groupBy('preferred_languages.user_id')
            ->where(function ($query) use ($user_id) {
                if (!empty($user_id)) {
                    $query->where("users.id", "!=", $user_id);
                }
            })->where('users.is_admin', 0)->orderBy('users.id','desc')->select(['users.*'])->paginate(15);

        foreach ($teachers as $row) {
            $row["preferred_lang"] = PreferredLanguage::join('categories', 'categories.id', '=', 'preferred_languages.language_id')
                ->where('preferred_languages.user_id', $row->id)->get(['categories.*']);

            $row["language_i_speak"] = LanguageISpeak::join('categories', 'categories.id', '=', 'language_i_speaks.language_id')
                ->where('language_i_speaks.user_id', $row->id)->get(['categories.*']);

            $row["rating"] = CommonHelpers::ratingUser($row->id);
        }
        return $teachers;
    }


    /**
     * @param Request $request
     * @return array
     */
    public function findTeacherByLang(Request $request): array
    {
        $lang_id = Category::query()->where('url', $request->segment(2))->value('id');
        $lang = PreferredLanguage::query()->where('language_id', $lang_id)->groupBy('user_id')->get();

        $lang_user_ids = [];
        foreach ($lang as $la) {
            $lang_user_ids = array_merge($lang_user_ids, array($la->user_id));
        }

        $teacher = User::query()->where('is_admin', 0)->whereIn('id', $lang_user_ids)->orderBy('id', 'DESC')->paginate(15);
        foreach ($teacher as $rw) {
            $rw["preferred_lang"] = PreferredLanguage::join('categories', 'categories.id', '=', 'preferred_languages.language_id')
                ->where('preferred_languages.user_id', $rw->id)->get(['categories.*']);
        }

        $teachers = $teacher;
        return array('teachers' => $teachers);
    }


    /**
     * @param Request $request
     * @return array
     */
    public function allCourse(Request $request): array
    {
        $user_id = Auth::user()->id ?? null;

        if ($request->type) {
            $course = Course::query()->where('type', strtoupper($request->type))->orderBy('id', 'DESC')->paginate(15);
        } else {
            $course = Course::query()->orderBy('id', 'DESC')->paginate(15);
        }

        return $this->courseListInfo($course, $user_id);
    }


    /**
     * @param $url
     * @return array
     */
    public function courseInformation($url): array
    {
        $course = Course::query()->where('url', $url)->get();
        foreach ($course as $row) {
            $row["instructor"] = User::query()->where('id', $row->user_id)->get();
            $row["lesson_total"] = Lesson::query()->where('course_id', $row->id)->count();
            $row['rating'] = CourseRating::where('course_id', $row->id)->count();
        }
        (new CommonHelpers)->moreCourseInformation($course);
        $lessons = Lesson::query()->where('course_id', $course[0]['id'])->groupBy('group_id')->get();
        $profile = User::query()->where('id', $course[0]["user_id"])->get();
        $reviews = CourseRating::where('course_id', $course[0]["id"])->get();
        foreach ($reviews as $row) {
            $row["profile_image"] = User::query()->where('id', $row->user_id)->value("profile_image");
        }

        return array(
            'course' => $course,
            'lessons' => $lessons,
            'profile' => $profile,
            'reviews' => $reviews
        );
    }


    /**
     * @param $url
     * @return array
     */
    public function groupCourseInformation($url): array
    {
        $course = GroupClass::query()->where('url', $url)->get();
        foreach ($course as $row) {
            $row["instructor"] = User::query()->where('id', $row->user_id)->get();
        }
        (new CommonHelpers)->moreGroupCourseInformation($course);
        $profile = User::query()->where('id', $course[0]["user_id"])->get();

        return array(
            'course' => $course,
            'profile' => $profile
        );
    }


    /**
     * @param Request $request
     * @return RedirectResponse
     */
    public function saveReview(Request $request): RedirectResponse
    {
        if ($request->rating_pro):
            $data = CommonHelpers::StoreReviews($request);
            if ($data->id) {
                Session::flash('message', ' Review added successful');
                return redirect()->back();
            }
        endif;
        Session::flash('message', ' something went wrong');
        return redirect()->back();
    }

    public function saveUserReview(Request $request): RedirectResponse
    {
        if ($request->rating_pro):
            $data = CommonHelpers::StoreUserReviews($request);
            if ($data->id) {
                Session::flash('message', ' Review added successful');
                return redirect()->back();
            }
        endif;
        Session::flash('message', ' something went wrong');
        return redirect()->back();
    }


    /**
     * @param Request $request
     * @return JsonResponse|null
     */
    public function teacherAvailability(Request $request): ?JsonResponse
    {
        $user_id = User::query()->where('identity', $request->instructor_user_id)->value('id');
        if ($request->ajax()) {
            $data = ScheduleEvent::where('user_id', $user_id)
                ->get(['id', 'title', 'start', 'end']);
            return response()->json($data);
        }
        return response()->json([]);
    }

    /**
     * @param Request $request
     * @return array
     */
    public function groupClasses(Request $request): array
    {
        $user_id = Auth::user()->id ?? null;

        if ($request->type) {
            $course = GroupClass::query()->where('type', strtoupper($request->type))->orderBy('id', 'DESC')->paginate(15);
        } else {
            $course = GroupClass::query()->orderBy('id', 'DESC')->paginate(15);
        }
        (new CommonHelpers)->moreGroupCourseInformation($course);
        $lang = Category::query()->where('class_name', 'language')->get();

        $free_course = GroupClass::query()->where('type', 'FREE')->count();
        $paid_course = GroupClass::query()->where('type', 'PAID')->count();

        $instructors = User::query()->where(function ($query) use ($user_id) {
            if (!empty($user_id)) {
                $query->where("id", "!=", $user_id);
            }
        })->where('is_admin', 0)->orderBy('id', 'DESC')->limit("5")->get();

        foreach ($instructors as $row) {
            $row["number_of_course"] = Course::query()->where('user_id', $row->id)->count();
        }

        $all_theme = Category::query()->where('class_name', "use_cases")->orderBy('id','desc')->get();

        foreach ($all_theme as $row){
            $row['total'] = Course::join('related_courses', 'related_courses.course_id', '=', 'courses.id')
                ->where('related_courses.use_cases_id', $row->id)->Orwhere('courses.use_cases_id', $row->id)->count();
        }

        return array(
            'course' => $course,
            'lang' => $lang,
            'free_course' => $free_course,
            'paid_course' => $paid_course,
            'instructors' =>$instructors,
            'all_theme' =>$all_theme
        );
    }




    public function getUseCases(Request $request): array
    {
        $user_id = Auth::user()->id ?? null;
        $category = Category::query()->where('url', $request->link)->value('id');

        if ($request->type) {
            $course = Course::query()->where('type', strtoupper($request->type))->where('use_cases_id',$category)
                ->orderBy('id', 'DESC')->paginate(15);
        } else {
            $course = Course::query()->where('use_cases_id',$category)->orderBy('id', 'DESC')->paginate(15);
        }

        if($course->count() == 0){
            $course =  RelatedCourses::join('courses', 'courses.id', '=', 'related_courses.course_id')
                ->where('related_courses.use_cases_id', $category)->select('courses.*')->paginate(15);
        }

        return $this->courseListInfo($course, $user_id);
    }

    /**
     * @param LengthAwarePaginator $course
     * @param $user_id
     * @return array
     */
    private function courseListInfo(LengthAwarePaginator $course, $user_id): array
    {
        (new CommonHelpers)->moreCourseInformation($course);
        $instructors = User::query()->where(function ($query) use ($user_id) {
            if (!empty($user_id)) {
                $query->where("id", "!=", $user_id);
            }
        })->where('is_admin', 0)->orderBy('id', 'DESC')->limit("5")->get();

        foreach ($instructors as $row) {
            $row["number_of_course"] = Course::query()->where('user_id', $row->id)->count();
        }

        $free_course = Course::query()->where('type', 'FREE')->count();
        $paid_course = Course::query()->where('type', 'PAID')->count();
        $all_theme = Category::query()->where('class_name', "use_cases")->orderBy('id','desc')->get();
        foreach ($all_theme as $row){
            $row['total'] = Course::join('related_courses', 'related_courses.course_id', '=', 'courses.id')
                ->where('related_courses.use_cases_id', $row->id)->Orwhere('courses.use_cases_id', $row->id)->count();
        }
        return array(
            'course' => $course,
            'instructors' => $instructors,
            'free_course' => $free_course,
            'paid_course' => $paid_course,
            "all_theme" =>$all_theme
        );
    }

    public function getCourseByUseCases($use_cases_id){
        $course = Course::query()->where('use_cases_id',$use_cases_id)->orderBy('id', 'desc')->get();

        if($course->count() == 0){
            $course =  RelatedCourses::join('courses', 'courses.id', '=', 'related_courses.course_id')->where('related_courses.use_cases_id', $use_cases_id)->get('courses.*');
        }

        (new CommonHelpers)->moreCourseInformation($course);
        return $course;
    }

}
