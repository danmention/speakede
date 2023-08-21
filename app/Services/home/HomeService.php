<?php

namespace App\Services\home;

use App\Helpers\CommonHelpers;
use App\Models\Category;
use App\Models\Course;
use App\Models\CustomerRating;
use App\Models\GroupClass;
use App\Models\GroupClassEnrollment;
use App\Models\Lesson;
use App\Models\PreferredLanguage;
use App\Models\ScheduleEvent;
use App\Models\User;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
        $lang = Category::query()->where('class_name','language')->get();
        $lang_popular = Category::query()->where('class_name','language')->where('popular_status', 1)->get();
        $course = Course::query()->orderBy('id','desc')->get();
        (new CommonHelpers)->moreCourseInformation($course);
        $expert_teachers = User::query()->where('status', 1)
            ->where(function ($query) use ($user_id) {
                if (!empty($user_id)) {
                    $query->where("id", "!=", $user_id);
                }
                })->where('is_admin',0)->limit(4)->get();

        foreach ($expert_teachers as $row){
            $lang_ = PreferredLanguage::query()->where('user_id', $row->id)->limit(1)->orderBy('id','DESC')->value('id');
            $row["lang"] = Category::query()->where('id', $lang_)->value('title') ?? "English";
        }

        return array(
            "lang" => $lang,
            "lang_popular" => $lang_popular,
            "course" => $course,
            "expert_teachers" => $expert_teachers
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

        Session::flash('message', ' Your registration was successful, please login');
        return redirect()->back();
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
        $private_class = GroupClass::query()->where('status',1)->where('user_id', $profile[0]->id)->get();
        foreach ($private_class as $row){
            $paid_slot =  GroupClassEnrollment::query()->where('group_class_id', $row->id)->count();
            $slot = $row->slot;
            $available = $slot - $paid_slot;
            $row["available_slots"] = $available;
        }

        return array(
            'profile' => $profile,
            'preferred_lang' => $preferred_lang,
            'private_class' => $private_class,
            'identity' => $identity
        );

    }

    /**
     * @return LengthAwarePaginator
     */
    public function findTeacher(): LengthAwarePaginator
    {
        $teachers = User::query()->where('is_admin',0)->orderBy('id','DESC')->paginate(15);

        foreach ($teachers as $row){
            $row["preferred_lang"] = PreferredLanguage::join('categories', 'categories.id', '=', 'preferred_languages.language_id')
                ->where('preferred_languages.user_id', $row->id)->get(['categories.*']);
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
        $lang = PreferredLanguage::query()->where('language_id',$lang_id)->groupBy('user_id')->get();

        $lang_user_ids = [];
        foreach ($lang as $la){
            $lang_user_ids = array_merge($lang_user_ids, array($la->user_id));
        }

        $teacher = User::query()->where('is_admin',0)->whereIn('id',$lang_user_ids)->orderBy('id','DESC')->paginate(15);
        foreach ($teacher as $rw){
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

        if($request->type){
            $course = Course::query()->where('type', strtoupper($request->type))->orderBy('id','DESC')->paginate(15);
        } else {
            $course = Course::query()->orderBy('id','DESC')->paginate(15);
        }

        (new CommonHelpers)->moreCourseInformation($course);
        $instructors = User::query()->where(function ($query) use ($user_id) {
            if (!empty($user_id)) {
                $query->where("id", "!=", $user_id);
            }
        })->where('is_admin',0)->orderBy('id','DESC')->limit("5")->get();

        foreach ($instructors as $row){
            $row["number_of_course"] = Course::query()->where('user_id', $row->id)->count();
        }

        $free_course = Course::query()->where('type','FREE')->count();
        $paid_course = Course::query()->where('type','PAID')->count();
        return array(
            'course' => $course,
            'instructors' =>$instructors,
            'free_course' =>$free_course,
            'paid_course' => $paid_course
        );
    }


    /**
     * @param $url
     * @return array
     */
    public function courseInformation($url): array
    {
        $course = Course::query()->where('url', $url)->get();
        foreach ($course as $row){
            $row["instructor"] = User::query()->where('id', $row->user_id)->get();
            $row["lesson_total"] = Lesson::query()->where('course_id', $row->id)->count();
            $row['rating'] = CustomerRating::where('course_id', $row->id)->count();
        }
        (new CommonHelpers)->moreCourseInformation($course);
        $lessons = Lesson::query()->where('course_id', $course[0]['id'])->groupBy('group_id')->get();
        $profile = User::query()->where('id', $course[0]["user_id"])->get();
        $reviews = CustomerRating::where('course_id', $course[0]["id"])->get();
        foreach ($reviews as $row){
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
        foreach ($course as $row){
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
     * @return JsonResponse|null
     */
    public function teacherAvailability(Request $request): ?JsonResponse
    {
        $user_id = User::query()->where('identity',$request->instructor_user_id)->value('id');
        if ($request->ajax()) {
            $data = ScheduleEvent::where('user_id',$user_id)
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
        if($request->type) {
            $course = GroupClass::query()->where('type', strtoupper($request->type))->orderBy('id', 'DESC')->paginate(15);
        } else {
            $course = GroupClass::query()->orderBy('id', 'DESC')->paginate(15);
        }
        (new CommonHelpers)->moreGroupCourseInformation($course);
        $lang = Category::query()->where('class_name','language')->get();

        $free_course = GroupClass::query()->where('type','FREE')->count();
        $paid_course = GroupClass::query()->where('type','PAID')->count();
        return array(
            'course' => $course,
            'lang' => $lang,
            'free_course' =>$free_course,
            'paid_course' => $paid_course
        );
    }


    /**
     * @param Request $request
     * @return array
     */
    public function search(Request $request): array
    {

        if (!empty($request->type)) {

            switch ($request->type){
                case "teachers":
                    $course = User::select('*')->where('firstname','LIKE','%'.$request->keyword.'%')->orWhere('lastname','LIKE','%'.$request->keyword.'%')->where('status', 1)->paginate(40);
                    $type ="teachers";
                    break;
                case "group":
                    $course = GroupClass::select('*')->where('title','LIKE','%'.$request->keyword.'%')->where('status', 1)->paginate(40);
                    $type ="teachers";
                    break;
                default:
                    $course = Course::select('*')->where('title','LIKE','%'.$request->keyword.'%')->where('status', 1)->paginate(40);
                    $type ="course";
            }
        } else {
            $course = Course::select('*')->where('title','LIKE','%'.$request->keyword.'%')->where('status', 1)->paginate(40);
            $type ="course";
        }

        return array(
            'course' =>$course,
            'type' => $type
        );
    }

}
