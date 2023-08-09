<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\PaymentTransaction;
use App\Models\User;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class AdminController
{

    public function getDashboard()
    {
        $users = User::query()->where('is_admin', 0)->count();
        $wallet = PaymentTransaction::query()->sum('amount');
        return view('admin.index', compact('users','wallet'));
    }


    public function getWalletFunding()
    {
        $payment = PaymentTransaction::all();
        foreach ($payment as $row){
            $row->user = User::query()->where('id' ,$row->user_id)->value('firstname');
        }
        return view('admin.wallet_funding', compact('payment'));
    }

    public function getPaymentTransactions()
    {
        return view('admin.payment_transactions');
    }

    public function getGroupHistory()
    {
        return view('admin.group_history');
    }


    public function getCallHistory()
    {
        return view('admin.call_history');
    }


    public function getLogin()
    {
        return view('admin.login');
    }


    /**
     * @return Factory|View|Application
     */
    public function getUsers()
    {
        $users = User::all();
        return view('admin.user.view-user',compact('users'));
    }


    /**
     * @return Factory|View|Application
     */
    public function AddUsers()
    {
        return view('admin.user.add-user');
    }


    /**
     * @param Request $request
     * @return RedirectResponse
     */
    public function SaveUsers(Request $request): RedirectResponse
    {

        $validator = Validator::make($request->all(), [
            'firstname' => 'required',
            'lastname' => 'required',
            'email' => 'required|',
        ]);

        if ($validator->fails()) {
            return redirect()->route('admin.user.add')->withErrors($validator)->withInput();
        }

        $post = new User;
        $post->firstname                      = $request->firstname;
        $post->lastname                       = $request->lastname;
        $post->email                          = $request->email;
        $post->phone                          = $request->phone;
        $post->user_level                     = $request->user_level;
        $post->password                       = bcrypt($request->password);
        $post->remember_token                 = bcrypt($request->password);
        $post->save();

        return back()->withInput()->with('success','User Created successfully');
    }


    /**
     * @param Request $request
     * @return RedirectResponse
     */
    public function UpdateUserAccount(Request $request): RedirectResponse
    {

        $data = User::find($request->id);
        $data->user_status =  $request->status;
        $data->update();

        return back()->withInput()->with('success','successfully');

    }


    /**
     * @param Request $request
     * @return RedirectResponse
     */
    public function UpdateProfilePhoto(Request $request): RedirectResponse
    {

        $id = Auth::user()->id;

        if ($request->home) {
            $image = $request->file('picture');
            $filename = time().".".$image->getClientOriginalExtension();
            // Create directory if it does not exist
            if(!is_dir("profile/photo/". Auth::user()->id ."/")) {
                $path = "profile/photo/". Auth::user()->id ."/";
                File::makeDirectory(public_path().'/'.$path,0777,true);
            }

            $location = public_path('profile/photo/'. Auth::user()->id .'/');
            $image->move($location, $filename);
        }else {
            return back()->withInput()->with('response','Please Attach a profile photo');
        }
        // update account information
        $post = User::find($id);
        $post->profile_image = $filename;
        $post->save();
        Session::flash('message', 'profile picture updated');
        return back()->withInput()->with('response','profile picture updated');


    }

    public function getProfilePhoto()
    {
        return view('admin.user.add_dp');
    }


    /**
     * @param Request $request
     * @return RedirectResponse
     */
    public function ChangeUserPassword(Request $request): RedirectResponse
    {
        $user = User::find(Auth::user()->id);

        if (!Hash::check($request->current_password, $user->password)) {
            return back()->withInput()->with('response', "The current password is incorrect");
        }

        $validator = Validator::make($request->all(), [
            'new_password' => ['nullable', 'string'],
            'confirm_new_password' => ['nullable', 'required_with:new_password', 'same:new_password']
        ]);

        if ($validator->fails()) {
            return back()->withInput()->with('response', "Password didn't match or your current password is wrong");
        }

        $password                   =   $request->new_password;
        $encrypt_pass               =   bcrypt($password);
        $Users                      =   User::find(Auth()->user()->id);
        $Users->password            =   $encrypt_pass;
        $Users->save();

        Session::flash('message', 'Password Updated Successfully');
        return back()->withInput()->with('response','Password Updated Successfully');
    }

}
