<?php

namespace App\Http\Controllers\Auth;

use App\Helpers\CommonHelpers;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{

    /**
     * @param Request $request
     * @return string|RedirectResponse
     */
    public function postSignIn(Request $request)
    {
        $options = $request->options;
        $check_instance = CommonHelpers::valid_email($options);
        $check_instance_phone = CommonHelpers::validate_phone_number($options);

        if($check_instance){
            $case = 0;
        } elseif($check_instance_phone) {
            $case = 1;
        } else{
            return redirect()->back()->with('response','invalid data');
        }

        switch($case) {
            case 0:
                if(auth::attempt([
                    'email'=>$request->input('options'),
                    'password'=>$request->input('password')
                ])){
                    if( Auth::user()){
                        if(Auth::user()->status  == 0  && Auth::user()->is_admin  == 2) {
                            Auth::logout();
                            return back()->withInput()->with('error', "Please verify your account.");
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
            case 1:
                if (auth::attempt([
                    'phone' => $request->input('options'),
                    'password' => $request->input('password'),
                ])) {
                    if( Auth::user()){
                        if(Auth::user()->is_admin  == 1) {
                            return redirect()->route('admin.dashboard');
                        }elseif(Auth::user()->is_admin  == 0) {
                            return redirect()->route('user.dashboard');
                        }
                        else {
                            return back()->withInput()->with('error', "you are not allowed here!");
                        }

                    }
                }
                return back()->withInput()->with('responses', 'Phone or password is wrong.');
            default:
                $this->redirectTo = '/';
                return $this->redirectTo;
        }
    }

    public function getLogOut()
    {
        Session::flush();
        Auth::logout();
        return redirect('/');
    }

    public function redirectDashboard()
    {
        $id = Auth::user()->id;
        $user_type = User::where('id', $id)->value('role');

        if ($user_type == 0) {
            return back()->withInput()->with('error', "Your account is currently under review and will be approved by admin within 24 hours.");
        } elseif ($user_type == "Admin") {
            return redirect()->route('admin.home');
        } elseif ($user_type == "Artisan") {
            return redirect()->route('user.home');
        } elseif ($user_type == "Employer") {
            return redirect()->route('employer.home');
        } else {
            return back()->withInput()->with('error', "you are not allowed here!");
        }


    }

    public function forgetPassword()
    {

        /** SEO */
        $seo = CommonHelpers::seoTemplate("Forget Password");
        /** END OF SEO */

        $listed = [];
        if (App::environment('production')) {
            $listed = array_merge($listed,$seo);
        }
        return view('home.forget-password',$listed);
    }

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

            Mail::to($request->email)->send(new ResetYourPassword($details));


            return back()->withInput()->with('responses','Verification link has been sent to your email');


        }else {
            return back()->withInput()->with('responses','Email address not found');
        }

    }

    public function VerifyUserAccountPasswordResetView(Request $request)
    {

        /** SEO */
        $seo = CommonHelpers::seoTemplate("Reset Password");
        /** END OF SEO */
        $listed = [];

        if (App::environment('production')) {
            $listed = array_merge($listed,$seo);
        }


        if(!empty($request->ref)){
            $check = User::where('identity', $request->ref)->get();
            if($check->count() > 0){

                return view('home.new-password', $listed);
            }
            else {
                return redirect('/account/login')->with('response','invalid code');
            }
        }else {
            return redirect('/account/login')->with('response','invalid');
        }

    }



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


            return redirect('/account/login')->with('response','Password Changed successfully');

        }else {
            return back()->withInput()->with('responses','Invalid code');
        }
    }


}
