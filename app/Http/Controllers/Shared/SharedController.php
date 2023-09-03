<?php

namespace App\Http\Controllers\Shared;

use App\Services\user\UserService;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SharedController
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
     * @return Application|Factory|View|RedirectResponse
     */
    public function getIndex(Request $request)
    {
        $data = $this->userService->getUserDashboard($request);
        if ($request->identity){
            return view('admin.user-dashboard', $data);
        } else {
            if (empty(Auth::user()->about_me)){
                return redirect()->route('user.apply.final');
            } else {
                return view('user.dashboard', $data);
            }
        }

    }



    /**
     * @return Application|Factory|View
     */
    public function allCourse(Request $request)
    {
        $data = $this->userService->allCourse();
        return view('user.course.all_course',$data);
    }


    /**
     * @return Application|Factory|View
     */
    public function allPaidCourse(Request $request)
    {
        $data = $this->userService->paidCourse();
        return view('user.course.all_course', $data);
    }

    /**
     * @return Application|Factory|View
     */
    public function allSoldCourse(Request $request){
        $data = $this->userService->soldCourse();
        return view('user.course.all_course',  $data);
    }



    /**
     * @return Application|Factory|View
     */
    public function allCourseByAction(Request $request)
    {
        $data = $this->userService->courseByActions($request);
        return view('user.course.all_course',  $data);
    }

    /**
     * @param $url
     * @return Factory|View|Application
     */
    public function viewCourse($url)
    {
        $data = $this->userService->viewCourse($url);
        return view('user.course.view_course', $data);
    }

    /**
     * @param Request $request
     * @return Factory|View|Application
     */
    public function viewPaidCourse(Request $request)
    {
        return $this->userService->viewPaidCourse($request);
    }


    /**
     * @return Application|Factory|View
     */
    public function getGroupClass(Request $request){
        $data = $this->userService->getGroupSessions();
        return view('user.all_group_class',$data );
    }


    /**
     * @return Application|Factory|View
     */
    public function getGroupClassPaid(Request $request){

        $data = $this->userService->getPaidGroupSessions();
        return view('user.all_group_class',$data );
    }


    /**
     * @return Application|Factory|View
     */
    public function getGroupClassSold(Request $request){
        $data = $this->userService->getSoldGroupSessions();
        return view('user.all_group_class', $data);
    }

}
