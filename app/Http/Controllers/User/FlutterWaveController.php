<?php

namespace App\Http\Controllers\User;

use App\Enums\PaymentType;
use App\Http\Controllers\Controller;
use App\Models\PaymentTransaction;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use KingFlamez\Rave\Facades\Rave as Flutterwave;

class FlutterWaveController extends Controller
{


    /**
     * @return Application|RedirectResponse|Redirector
     */
    public function initialize()
    {
        //This generates a payment reference
        $reference = Flutterwave::generateReference();

        // Enter the details of the payment
        $data = [
            'payment_options' => 'card,banktransfer',
            'amount' => request()->amount,
            'email' => request()->email,
            'tx_ref' => $reference,
            'currency' => "NGN",
            'redirect_url' => route('callback'),
            'customer' => [
                'email' => request()->email,
                "phone_number" => request()->phone,
                "name" => request()->name
            ],

            "customizations" => [
                "title" => 'Speak Token',
                "description" => "Wallet Funding"
            ]
        ];

        $payment = Flutterwave::initializePayment($data);


        if ($payment['status'] !== 'success') {
            Session::flash('message', $payment['status']);
            return redirect()->route('user.dashboard');
        }

        return redirect($payment['data']['link']);
    }


    /**
     * @return RedirectResponse
     */
    public function callback(): RedirectResponse
    {

        $status = request()->status;

        //if payment is successful
        if ($status ==  'successful') {

            $transactionID = Flutterwave::getTransactionIDFromCallback();
            $payment_response = Flutterwave::verifyTransaction($transactionID);

            $data = new PaymentTransaction();
            $data->user_id = Auth::user()->id;
            $data->amount =  $payment_response["data"]["amount"];
            $data->ref_no = $payment_response["data"]["tx_ref"];
            $data->description = "Speak Token Wallet Funding with FlutterWave";
            $data->extra = json_encode($payment_response);
            $data->type = PaymentType::CREDIT;
            $data->status = 1 ;
            $data->save();

            Session::flash('message', "Payment Successful");
        }
        else{
            Session::flash('message', $status);
        }
        return redirect()->route('user.dashboard');

    }
}
