<?php

namespace App\Http\Controllers\Home;
use App\Helpers\CommonHelpers;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use Exception;
use App\Models\User;
use Symfony\Component\HttpFoundation\RedirectResponse;

class GoogleController extends Controller
{
    public function signInWithGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    public function callbackToGoogle()
    {
        try {

            $user = Socialite::driver('google')->user();
            $finduser = User::where('gauth_id', $user->id)->first();

            if($finduser){
                Auth::login($finduser);
            }else{
                $identity = CommonHelpers::generateCramp("user");
                $verify = CommonHelpers::code_ref(6);
                $newUser = User::create([
                    'firstname' => $user->name,
                    'email' => $user->email,
                    'gauth_id'=> $user->id,
                    'gauth_type'=> 'google',
                    'status' =>1,
                    'identity' => $identity,
                    'verify_code' => $verify,
                    'password' => encrypt('123456')
                ]);

                Auth::login($newUser);

            }
            return redirect('user/dashboard/discover');

        } catch (Exception $e) {
            dd($e->getMessage());
        }
    }
}
