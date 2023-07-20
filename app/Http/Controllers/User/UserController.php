<?php

namespace App\Http\Controllers\User;

use App\Helpers\CommonHelpers;
use App\Models\Course;
use App\Models\Lesson;
use App\Models\PaymentTransaction;
use App\Models\WalletFunding;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class UserController
{

    public function getIndex(): Factory|View|Application
    {

        $user_id = Auth::user()->id;
        $account_balance = PaymentTransaction::query()->where('user_id', $user_id)
            ->where('status',1)->sum('amount');


        $used_balance =  PaymentTransaction::query()->where('user_id', $user_id)
            ->where('status',0)->sum('amount');

        if($used_balance == 0){
            $wallet = $account_balance;
        } else {
            $wallet = $account_balance - $used_balance;
        }

        $course = Course::query()->where('user_id', $user_id)->count();
        return view('user.dashboard', compact('wallet', 'course'));
    }

    public function getCourse(): Factory|View|Application
    {
        return view('user.course.add-course');
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
        $data->user_id = Auth::user()->id;
        $data->save();

        Session::flash('message', ' Course added successful');
        return redirect()->back();
    }


    /**
     * @return Application|Factory|View
     */
    public function allCourse(): View|Factory|Application
    {
        $course = Course::query()->where('user_id', Auth::user()->id)->get();
        return view('user.course.all_course', compact('course'));
    }


    /**
     * @param $url
     * @return Factory|View|Application
     */
    public function viewCourse($url): Factory|View|Application
    {
        $course = Course::query()->where('url', $url)->get();
        $lessons = Lesson::query()->where('course_id', $course[0]->id)->groupBy('group_id')->get();
        return view('user.course.view_course', compact('course','lessons'));

    }

    /**
     * @param $id
     * @return Factory|View|Application
     */
    public function addLesson($id): Factory|View|Application
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
    public function getBecomeATeacher(): Factory|View|Application
    {
        return view('home.become_a_teacher');
    }

    public function buySpeakToken(): Factory|View|Application
    {
        $payment = PaymentTransaction::query()->where('user_id', Auth::user()->id)->get();
        return view('user.wallet_funding', compact('payment'));
    }

    public function getProfilePhoto(): Factory|View|Application
    {
        return view('user.add_dp');
    }

    public function changePassword(){
        return view('user.change-password');
    }
}
