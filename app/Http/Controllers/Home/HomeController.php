<?php

namespace App\Http\Controllers\Home;

use App\Helpers\CommonHelpers;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Course;
use App\Models\User;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class HomeController extends Controller
{
    public function getIndex(): Factory|View|Application
    {
        $lang = Category::query()->where('class_name','language')->get();
        $course = Course::all();
        return view('home.index', compact('lang','course'));
    }

    public function getLogin(): Factory|View|Application
    {
        return view('home.login');
    }

    public function getRegister(): Factory|View|Application
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

    public function getCategory(): Factory|View|Application
    {
        return view('home.category');
    }

    public function getGroupClass(): Factory|View|Application
    {
        return view('home.category');
    }

    public function getCommunity(): Factory|View|Application
    {
        return view('home.category');
    }

    public function getTeacherLang(): Factory|View|Application
    {
        return view('home.teacher-view');
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
}
