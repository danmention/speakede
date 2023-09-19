<?php

namespace App\Http\Controllers\Home;

use App\Helpers\CommonHelpers;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Services\home\HomeService;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\App;
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
        /** SEO */
        $seo = CommonHelpers::seoTemplate("home");
        /** END OF SEO */
        $data = $this->homeService->getHomeService();

        if (App::environment('production')) {
            $data = array_merge($data,$seo);
        }

        return view('home.index', $data);
    }


    /**
     * @return Application|Factory|View
     */
    public function getLogin()
    {
        /** SEO */
        $seo = CommonHelpers::seoTemplate("login");
        /** END OF SEO */
        if (App::environment('production')) {
            $data = $seo;
        }
        return view('home.login', $data);
    }


    /**
     * @return Application|Factory|View
     */
    public function getRegister()
    {
        /** SEO */
        $seo = CommonHelpers::seoTemplate("register");
        /** END OF SEO */

        if (App::environment('production')) {
            $data = $seo;
        }
        return view('home.register', $data);
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
     * @param $id
     * @return Application|Factory|View
     */
    public function getTeacherProfile($id)
    {
        /** SEO */
        $seo = CommonHelpers::seoTemplate("home");
        /** END OF SEO */

        $data = $this->homeService->teacherProfile($id);

        if (App::environment('production')) {
            $data = array_merge($data,$seo);
        }

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
    public function findTutor(){
        /** SEO */
        $seo = CommonHelpers::seoTemplate("Find Tutor");
        /** END OF SEO */

        $teachers = $this->homeService->findTutor();
        $data = array(
            "teachers" =>$teachers
        );

        if (App::environment('production')) {
            $data = array_merge($data,$seo);
        }
        return view('home.teachers', $data);
    }


    /**
     * @return Application|Factory|View
     */
    public function getAllCourse(Request $request){

        /** SEO */
        $seo = CommonHelpers::seoTemplate("All Courses");
        /** END OF SEO */

        $data = $this->homeService->allCourse($request);

        if (App::environment('production')) {
            $data = array_merge($data,$seo);
        }

        return view('home.all-course', $data);
    }


    /**
     * @return Application|Factory|View
     */
    public function getGroupClasses(Request $request){

        /** SEO */
        $seo = CommonHelpers::seoTemplate("All Group Sessions");
        /** END OF SEO */
       $data = $this->homeService->groupClasses($request);

        if (App::environment('production')) {
            $data = array_merge($data,$seo);
        }
        return view('home.all-group-course', $data);
    }


    /**
     * @param $url
     * @return Application|Factory|View
     */
    public function getViewCourse($url){

        /** SEO */
        $seo = CommonHelpers::seoTemplate("home");
        /** END OF SEO */

        $data = $this->homeService->courseInformation($url);

        if (App::environment('production')) {
            $data = array_merge($data,$seo);
        }

        return view('home.course_details', $data);
    }


    /**
     * @param $url
     * @return Application|Factory|View
     */
    public function getViewGroupCourse($url){

        /** SEO */
        $seo = CommonHelpers::seoTemplate("home");
        /** END OF SEO */

        $data = $this->homeService->groupCourseInformation($url);

        if (App::environment('production')) {
            $data = array_merge($data,$seo);
        }
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
     * @return Application|Factory|View
     */
    public function getUseCasesByCourse(Request $request)
    {
        $data = $this->homeService->getUseCases($request);

        /** SEO */
        $seo = CommonHelpers::seoTemplate("Theme Courses");
        /** END OF SEO */

        if (App::environment('production')) {
            $data = array_merge($data,$seo);
        }

        return view('home.all-course', $data);
    }

    /**
     * @param Request $request
     * @return RedirectResponse
     */
    public function SubmitUserReviews(Request $request): RedirectResponse
    {
        return $this->homeService->saveUserReview($request);
    }

    /**
     * @return Application|Factory|View
     */
    public function getPrivacyPolicy()
    {
        /** SEO */
        $seo = CommonHelpers::seoTemplate("Privacy Policy");
        /** END OF SEO */

        if (App::environment('production')) {
            $data = $seo;
        }
        return view('home.privacy-policy', $data);
    }

    /**
     * @return Application|Factory|View
     */
    public function getPaymentPolicy()
    {
        /** SEO */
        $seo = CommonHelpers::seoTemplate("Payment Policy");
        /** END OF SEO */

        if (App::environment('production')) {
            $data = $seo;
        }
        return view('home.payment-policy', $data);
    }

    /**
     * @return Application|Factory|View
     */
    public function getCopyrightPolicy()
    {
        /** SEO */
        $seo = CommonHelpers::seoTemplate("Copyright Policy");
        /** END OF SEO */

        if (App::environment('production')) {
            $data = $seo;
        }
        return view('home.copyright-policy', $data);
    }

    /**
     * @return Application|Factory|View
     */
    public function getTutorPolicy()
    {
        /** SEO */
        $seo = CommonHelpers::seoTemplate("Tutor Policy");
        /** END OF SEO */

        if (App::environment('production')) {
            $data = $seo;
        }
        return view('home.tutor-policy', $data);
    }

    /**
     * @return Application|Factory|View
     */
    public function getTermsOfService()
    {
        /** SEO */
        $seo = CommonHelpers::seoTemplate("Terms Of Service");
        /** END OF SEO */

        if (App::environment('production')) {
            $data = $seo;
        }
        return view('home.terms-of-service', $data);
    }

    /**
     * @param Request $request
     * @return Application|RedirectResponse|Redirector
     */
    public function VerifyUserAccount(Request $request){

        $verify_code = $request->segment(3);

        $check = User::where('verify_code', $verify_code)->where('status',0)->get();
        if($check->count() > 0){
            $data = User::find($check[0]->id);
            $data->status = 1;
            $data->is_verified = 1;
            $data->update();
            return redirect('/login')->with('response','account verified');
        }else {
            return  redirect('/login')->with('response','Invalid code');
        }

    }


}
