<?php

namespace App\Http\Controllers\Auth;

use App\Helpers\CommonHelpers;
use App\Http\Controllers\Controller;
use App\Mail\ResetYourSpeakedePassword;
use App\Models\User;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{

    /**
     * @param Request $request
     * @return RedirectResponse
     */
    public function postSignIn(Request $request): RedirectResponse
    {
        $options = $request->options;
        $check_instance = CommonHelpers::valid_email($options);

        if($check_instance){
                if(auth::attempt([
                    'email'=>$request->input('options'),
                    'password'=>$request->input('password')
                ])){
                    if( Auth::user()){
                        if(Auth::user()->status  == 0) {
                            Auth::logout();
                            return back()->withInput()->with('error', "Please verify your account. check your mail for verification code");
                        }
                        if(Auth::user()->is_admin  == 1) {
                            return redirect()->route('admin.dashboard');
                        }elseif(Auth::user()->is_admin  == 0) {
                            return redirect()->route('user.dashboard.discover.course');
                        }
                        else {
                            return back()->withInput()->with('error', "you are not allowed here!");
                        }

                    }
                    return back()->withInput()->with('error', "Email Or Password didn't match");
                }
                return back()->withInput()->with('error', "Email Or Password didn't match");
        } else {
            return back()->withInput()->with('error', "Invalid Email Address");
        }
    }

    /**
     * @return Application|RedirectResponse|Redirector
     */
    public function getLogOut()
    {
        Session::flush();
        Auth::logout();
        return redirect('/');
    }


    /**
     * @return Application|Factory|View
     */
    public function forgetPassword()
    {
        /** SEO */
        $seo = CommonHelpers::seoTemplate("Login");
        /** END OF SEO */

        if (App::environment('production')) {
            $data = $seo;
        }
        return view('home.forget-password', $data);
    }

    /**
     * @param Request $request
     * @return RedirectResponse
     */
    public function verifyingEmailAccountReset(Request $request): RedirectResponse
    {

        $email = $request->email;
        $check = User::where('email', $email)->get();
        if($check->count() >  0){

            $verifycode = CommonHelpers::code_ref(6);

            $post = User::find($check[0]->id);
            $post->verify_code                    = $verifycode;
            $post->update();

            $details    =   [
                'name'=>$check[0]->firstname. ' '.$check[0]->lastname,
                'code' => $verifycode,
                'email'=>$request->email,
                'link' => url('password/verify?ref='.$check[0]->identity)
            ];

            Mail::to($request->email)->send(new ResetYourSpeakedePassword($details));

            Session::flash('message', ' Reset password link has been sent to your email');
            return back();


        }else {
            Session::flash('message', 'Email address not found');
            return back();
        }

    }


    /**
     * @param Request $request
     * @return Application|Factory|View|RedirectResponse|Redirector
     */
    public function VerifyUserAccountPasswordResetView(Request $request)
    {


        if(!empty($request->ref)){
            /** SEO */
            $seo = CommonHelpers::seoTemplate("New Password");
            /** END OF SEO */

            if (App::environment('production')) {
                $data = $seo;
            }

            $check = User::where('identity', $request->ref)->get();
            if($check->count() > 0){
                return view('home.new-password', $data);
            }
            else {
                Session::flash('message', 'invalid code');
                return redirect('/login');
            }
        }else {
            Session::flash('message', 'invalid');
            return redirect('/login');
        }

    }


    /**
     * @param Request $request
     * @return Application|RedirectResponse|Redirector
     */
    public function VerifyUserAccountPasswordReset(Request $request){

        $check = User::where('verify_code', $request->verify_code)->get();
        if($check->count() > 0){

            $validator = Validator::make($request->all(), [
                'password' => 'required|string|min:6|confirmed',
            ]);

            if ($validator->fails()) {
                return redirect()->route('password.verify')->withErrors($validator)->withInput();
            }


            $data = User::find($check[0]->id);
            $data->password                       = bcrypt($request->password);
            $data->update();

            return redirect('/login')->with('response','Password Changed successfully');

        }else {
            return back()->withInput()->with('error', "Invalid code");
        }
    }


}
