<?php

namespace App\Http\Controllers\Home;

use App\Helpers\CommonHelpers;
use App\Http\Controllers\Controller;
use App\Services\home\HomeService;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{


    /**
     * @var HomeService
     */
    private $homeService;

    /**
     * @param HomeService $homeService
     */
    public function __construct(HomeService $homeService)
    {
        $this->homeService = $homeService;
    }

    /**
     * @return Application|Factory|View
     */
    public function getIndex()
    {
        $data = $this->homeService->getHomeService();
        return view('home.index', $data);
    }


    /**
     * @return Application|Factory|View
     */
    public function getLogin()
    {
        return view('home.login');
    }


    /**
     * @return Application|Factory|View
     */
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
       return $this->homeService->registerUser($request);
    }


    /**
     * @return Application|Factory|View
     */
    public function getTeacherByLang(Request $request)
    {
        $data = $this->homeService->findTeacherByLang($request);
        return view('home.teacher_by_lang', $data);
    }


    /**
     * @return Application|Factory|View
     */
    public function getGroupClass()
    {
        return view('home.category');
    }


    /**
     * @return Application|Factory|View
     */
    public function getCommunity()
    {
        return view('home.category');
    }


    /**
     * @return Application|Factory|View
     */
    public function getTeacherLang()
    {
        return view('home.teacher-view');
    }


    /**
     * @param $id
     * @return Application|Factory|View
     */
    public function getTeacherProfile($id)
    {
        $data = $this->homeService->teacherProfile($id);
        return view('home.teacher_profile',$data);
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


    /**
     * @return Application|Factory|View
     */
    public function findTeacher(){
        $teachers = $this->homeService->findTeacher();
        return view('home.teachers', compact('teachers'));
    }


    /**
     * @return Application|Factory|View
     */
    public function getAllCourse(Request $request){
        $data = $this->homeService->allCourse($request);
        return view('home.all-course', $data);
    }


    /**
     * @return Application|Factory|View
     */
    public function getGroupClasses(Request $request){
       $data = $this->homeService->groupClasses($request);
        return view('home.all-group-course', $data);
    }


    /**
     * @param $url
     * @return Application|Factory|View
     */
    public function getViewCourse($url){
        $data = $this->homeService->courseInformation($url);
        return view('home.course_details', $data);
    }


    /**
     * @param $url
     * @return Application|Factory|View
     */
    public function getViewGroupCourse($url){
        $data = $this->homeService->groupCourseInformation($url);
        return view('home.course_group_details',$data);
    }



    public function getTeacherAvailability(Request $request): ?JsonResponse
    {
      return  $this->homeService->teacherAvailability($request);
    }



    /**
     * @param Request $request
     * @return RedirectResponse
     */
    public function SubmitReviews(Request $request): RedirectResponse
    {
       return $this->homeService->saveReview($request);
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
        return (new CommonHelpers)->rating($user_id);
    }


    /**
     * @param Request $request
     * @return Application|Factory|View
     */
    public function getSearchResult(Request $request){
       $data = $this->homeService->search($request);
        return view('home.search', $data);
    }

}
