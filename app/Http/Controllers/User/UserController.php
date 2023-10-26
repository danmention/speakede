<?php

namespace App\Http\Controllers\User;

use App\Helpers\CommonHelpers;
use App\Models\AccountDetails;
use App\Models\Category;
use App\Models\Course;
use App\Models\GroupClass;

use App\Models\Lesson;
use App\Models\PaymentTransaction;
use App\Models\PreferredLanguage;
use App\Models\ScheduleEvent;
use App\Models\User;
use App\Services\user\UserService;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Stevebauman\Location\Facades\Location;

class UserController
{

    private $userService;

    /**
     * @param UserService $userService
     */
    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }


    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function saveCourse(Request $request): JsonResponse
    {
       return $this->userService->saveCourse($request);
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
     * @return JsonResponse
     */
    public function saveLesson(Request $request): JsonResponse
    {
        return $this->userService->addLessons($request);
    }


    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function updateLesson(Request $request): JsonResponse
    {
        return $this->userService->updateLessons($request);
    }

    /**
     * @return Factory|View|Application
     */
    public function getBecomeATeacher()
    {
        return view('home.become_a_teacher');
    }


    /**
     * @return Application|Factory|View
     */
    public function buySpeakToken()
    {
        $ip= request()->ip();
        $position = Location::get($ip);
        $payment = PaymentTransaction::query()->where('user_id', Auth::user()->id)->orderBy('id','desc')->get();
        if (!$position){
            return view('user.wallet_funding_ng', compact('payment'));
        }
        if ($position->countryCode === "NG"){
            return view('user.wallet_funding_ng', compact('payment'));
        } else {
            return view('user.wallet_funding', compact('payment'));
        }

    }


    /**
     * @return Application|Factory|View
     */
    public function getProfilePhoto()
    {
        return view('user.add_dp');
    }


    /**
     * @return Application|Factory|View
     */
    public function changePassword(){
        return view('user.change-password');
    }


    /**
     * @return Application|Factory|View
     */
    public function addMyFreeSchedule(){
        return view('user.change-password');
    }

    /**
     * @return Application|Factory|View
     */
    public function buyCourse($id)
    {
       $data = $this->userService->buyCourse($id);
        return view('user.course.buy-course', $data);
    }

    /**
     * @return Application|Factory|View
     */
    public function getAddCourseView(Request $request)
    {
        $data = $this->userService->getAddCourseInfo();
        return view('user.course.add-course',$data);
    }



    /**
     * @param Request $request
     * @return RedirectResponse
     */
    public function coursePaymentInit(Request $request): RedirectResponse
    {
       return $this->userService->handleCoursePay($request);
    }


    /**
     * @return Application|Factory|View
     */
    public function addTeachersInfo(){
        $tutor_lang =  Category::query()->where('class_name', 'tutor')->get();
        $lang = Category::query()->where('class_name', 'language')->get();
        return view('user.add-teacher-info', compact('lang', 'tutor_lang'));
    }


    /**
     * @param Request $request
     * @return RedirectResponse
     */
    public function updateUserInfo(Request $request): RedirectResponse
    {
       return $this->userService->updateProfileAfterRegistration($request);
    }


    /**
     * @param Request $request
     * @return Application|Factory|View
     */
    public function processingVirtualBooking(Request $request){

        $lang = ScheduleEvent::query()->where('id', $request->id)->value('language_id');
        $preferred_lang = Category::query()->where('id', $lang)->get();
        return view('user.select-virtual-meeting', compact('preferred_lang'));
    }

    /**
     * @return Application|Factory|View
     */
    public function payVirtualBooking(Request $request)
    {
        $data = $this->userService->virtualBookingInit($request);
        return view('user.pay-online-meeting', $data);
    }


    /**
     * @return Application|Factory|View
     */
    public function createGroupClass(){
        $preferred_lang = Category::query()->where('class_name','tutor')->get();
        return view('user.create_group_class', compact('preferred_lang'));
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function saveGroupClassMeeting(Request $request): JsonResponse
    {
        return $this->userService->saveGroupSessions($request);
    }



    /**
     * @param Request $request
     * @return Application|Factory|View
     */
    public function payVirtualGroupBooking(Request $request)
    {
        $data = $this->userService->payingViewGroupSessions($request);
        return view('user.pay-group-online-meeting', $data);
    }

    /**
     * @return mixed
     */
    private function getPreferred_lang()
    {
        return PreferredLanguage::join('categories', 'categories.id', '=', 'preferred_languages.language_id')
            ->where('preferred_languages.user_id', Auth::user()->id)->get(['categories.*', 'preferred_languages.price']);
    }


    /**
     * @return Application|Factory|View|RedirectResponse
     */
    public function discoverCourses()
    {
        if (empty(Auth::user()->about_me)){
            return redirect()->route('user.apply.final');
        } else {
            $data = $this->userService->discoverCourses();
            return view('user.course.all_course', $data);
        }
    }


    /**
     * @return Application|Factory|View
     */
    public function discoverTutor()
    {
       $data = $this->userService->getTutors();
       return view('user.discover.tutors', $data);
    }


    /**
     * @return Application|Factory|View
     */
    public function discoverSessions()
    {
        $sessions = GroupClass::query()->orderBy('id', 'DESC')->paginate(15);
        (new CommonHelpers)->moreGroupCourseInformation($sessions);
        return view('user.discover.sessions', compact('sessions'));

    }


    /**
     * @return Application|Factory|View
     */
    public function discoverTheme(Request $request)
    {
       $data = $this->userService->getUseCases($request);
        return view('user.course.all_course', $data);

    }



    /**
     * @return Application|Factory|View
     */
    public function discoverAllCourseByAction(Request $request)
    {
       $data = $this->userService->discoverCourseByAction($request);
        return view('user.course.all_course', $data);
    }

    /**
     * @return Application|Factory|View
     */
    public function groupSessionByAction(Request $request)
    {
        $data = $this->userService->sessionsByActions($request);
        return view('user.discover.sessions', $data);
    }


    /**
     * @return Factory|View|Application
     */
    public function addWithdrawalDetails()
    {
        $bank_accounts = AccountDetails::query()->where('user_id', Auth::user()->id)->orderBy('id', 'desc')->get();
        return view('user.bank-accounts', compact('bank_accounts'));
    }

    /**
     * @param Request $request
     * @return RedirectResponse
     */
    public function saveWithdrawalDetails(Request $request): RedirectResponse
    {
        $data = new AccountDetails();
        $data->bank_name = $request->bank_name;
        $data->account_number = $request->account_number;
        $data->account_name = $request->account_name;
        $data->user_id = Auth::user()->id;
        $data->save();
        Session::flash('message', 'Account Number created successfully');
        return back();
    }


    /**
     * @return Factory|View|Application
     */
    public function updateProfile()
    {
        $user = User::query()->where('id', Auth::user()->id)->get();
        return view('user.edit-profile', compact('user'));
    }

    public function saveProfileInfo(Request $request): RedirectResponse
    {
        $user = User::find(Auth::user()->id);
        $user->firstname = $request->firstname;
        $user->lastname = $request->lastname;
        $user->date_of_birth = $request->dob;
        $user->phone = $request->phone;
        $user->gender = $request->gender;
        $user->about_me = $request->about_me;
        $user->update();

        Session::flash('message', 'Profile Updated successfully');
        return back();
    }



    public function deleteLesson(Request $request): RedirectResponse
    {
        $lesson = Lesson::find($request->lesson_id);
        $lesson->delete();
        Session::flash('message', 'Lesson Deleted successfully');
        return back();
    }

    public function deleteCourse(Request $request): RedirectResponse
    {
        $lesson = Course::find($request->course_id);
        $lesson->delete();

        Lesson::where('course_id',$request->course_id)->delete();
        Session::flash('message', 'Course Deleted successfully');
        return back();
    }


    public function editLesson(Request $request){
        $lessons = Lesson::query()->where('url', $request->url)->get();
        return view('user.course.edit-lesson', compact('lessons'));
    }



}
