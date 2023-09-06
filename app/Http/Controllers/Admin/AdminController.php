<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\PaymentTransaction;
use App\Models\User;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
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
        $users = User::query()->where('is_admin',0)->get();
        return view('admin.users',compact('users'));
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
     * @return JsonResponse
     */
    public function UpdateProfilePhoto(Request $request): JsonResponse
    {

        $id = Auth::user()->id;

        $image = $request->picture;
        $filename = time().".".$image->extension();
        // Create directory if it does not exist
        $path = public_path()."/profile/photo/". Auth::user()->id ."/";
        if(!File::isDirectory($path)) {
            File::makeDirectory(public_path().'/'.$path,0777,true);
        }
        $location = public_path('profile/photo/'. Auth::user()->id .'/');
        $image->move($location, $filename);

        // update account information
        $post = User::find($id);
        $post->profile_image = $filename;
        $post->save();
        return response()->json('Course added successfully');

    }

    public function getProfilePhoto()
    {
        return view('admin.user.add_dp');
    }


    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function ChangeUserPassword(Request $request): JsonResponse
    {
        $user = User::find(Auth::user()->id);

        if (!Hash::check($request->current_password, $user->password)) {
            return response()->json('The current password is incorrect',500);
        }

        $validator = Validator::make($request->all(), [
            'new_password' => ['nullable', 'string'],
            'confirm_new_password' => ['nullable', 'required_with:new_password', 'same:new_password']
        ]);

        if ($validator->fails()) {
            return response()->json('Password didn\'t match or your current password is wrong',500);
        }

        $password                   =   $request->new_password;
        $encrypt_pass               =   bcrypt($password);
        $Users                      =   User::find(Auth()->user()->id);
        $Users->password            =   $encrypt_pass;
        $Users->save();

        return response()->json('Password Updated Successfully');
    }

}
