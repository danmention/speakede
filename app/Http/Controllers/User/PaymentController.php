<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\PaymentTransaction;
use App\Models\User;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Unicodeveloper\Paystack\Exceptions\PaymentVerificationFailedException;
use Unicodeveloper\Paystack\Paystack;

class PaymentController extends Controller
{

    /**
     * @return Redirector|RedirectResponse|Application
     */
    public function redirectToGateway(): Redirector|RedirectResponse|Application
    {
        try{
            return (new Paystack)->getAuthorizationUrl()->redirectNow();
        }catch(\Exception $e) {
            return Redirect::back()->withMessage(['msg'=>'The paystack token has expired. Please refresh the page and try again.', 'type'=>'error']);
        }
    }


    /**
     * @param Request $request
     * @return RedirectResponse
     */
    public function redirectToPayment(Request $request): RedirectResponse
    {
        $data = new PaymentTransaction();
        $data->user_id = $request->user_id;
        $data->amount= $request->amount;
        $data->ref_no = $request->orderID;
        $data->description = "Speak Token Wallet Funding";
        $data->status = 1 ;
        $data->save();
        Session::flash('message', ' Payment added successful');
        return redirect()->back();

    }


    /**
     * @return RedirectResponse
     * @throws PaymentVerificationFailedException
     */
    public function handleGatewayCallback(): RedirectResponse
    {


        $paymentDetails = (new Paystack)->getPaymentData();
        $user_id = Auth::user()->id;
        $tournaments_id = User::where('id',$user_id)->value('tournaments_id');

        $status = $paymentDetails['data']['status']; // Getting the status of the transaction
        $amount = $paymentDetails['data']['amount']; //Getting the Amount
        $reference = $paymentDetails['data']['reference'];
        $gateway_response = $paymentDetails['data']['gateway_response'];
        $paid_at = $paymentDetails['data']['paid_at'];


        if($status === "success"){ //Checking to Ensure the transaction was succesful

            $data = new PaymentTransaction();
            $data->user_id = $user_id;
            $data->amount= $amount;
            $data->ref_no = $reference;
            $data->paid_at = $paid_at;
            $data->gateway_response = $gateway_response;
            $data->status = 1 ;

            $data->save();

        }else {
            return back()->with('response', 'error occurred');
        }

        return redirect()->route('user.dashboard');

    }
}
