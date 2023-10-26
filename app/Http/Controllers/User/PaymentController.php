<?php

namespace App\Http\Controllers\User;

use App\Enums\PaymentType;
use App\Helpers\CommonHelpers;
use App\Http\Controllers\Controller;
use App\Models\PaymentTransaction;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Stripe\Exception\CardException;
use Stripe\Stripe;
use Stripe\StripeClient;
use Unicodeveloper\Paystack\Exceptions\PaymentVerificationFailedException;
use Unicodeveloper\Paystack\Paystack;

class PaymentController extends Controller
{

    private $stripe;
    public function __construct()
    {
        $this->stripe = new StripeClient(config('services.stripe.stripe_secret'));
    }

    public function redirectToGateway()
    {
//        \request()->amount =  \request()->amount ."00";
        try{
            return (new Paystack)->getAuthorizationUrl()->redirectNow();
        }catch(\Exception $e) {
            Session::flash('message', "The paystack token has expired. Please refresh the page and try again");
            return Redirect::back();
        }
    }


    /**
     * @return RedirectResponse
     * @throws PaymentVerificationFailedException
     */
    public function handleGatewayCallback(): RedirectResponse
    {
        $paymentDetails = (new Paystack)->getPaymentData();
        $status = $paymentDetails['data']['status']; // Getting the status of the transaction
        $amount = $paymentDetails['data']['amount']; //Getting the Amount
        $reference = $paymentDetails['data']['reference'];
        $gateway_response = $paymentDetails['data']['gateway_response'];

        if($status === "success"){ //Checking to Ensure the transaction was succesful

            $data = new PaymentTransaction();
            $data->user_id = Auth::user()->id;
            $data->amount =  $amount;
            $data->ref_no = $reference;
            $data->description = "Speak Token Wallet Funding with Paystack";
            $data->extra = json_encode($paymentDetails);
            $data->status = 1 ;
            $data->type = PaymentType::CREDIT;
            $data->save();
            Session::flash('message', "Payment Successful");

        } else {
            Session::flash('message', $gateway_response);
        }

        return redirect()->route('user.dashboard');
    }


    public static function handleCoursePayment(Request $request, $ref_no): void {
        $data = new PaymentTransaction();
        $data->user_id = Auth::user()->id;
        $data->amount =  $request->amount;
        $data->ref_no = $ref_no;
        $data->description = "Payment for ".$request->course_title;
        $data->extra = null;
        $data->type = PaymentType::DEBIT;
        $data->status = 1;
        $data->save();
    }



    public function getPaymentWithStripe(){
        return view('user/payment');

    }

    public function postPaymentStripe(Request $request): RedirectResponse
    {
        $amount =  $request->amount * 100;
        $reference = CommonHelpers::code_ref(10);

        \Stripe\Stripe::setApiKey(config('services.stripe.stripe_secret'));
        $session = \Stripe\Checkout\Session::create([
            'line_items'  => [
                [
                    'price_data' => [
                        'currency'     => 'USD',
                        'product_data' => [
                            "name" => "Speak Token Wallet Funding with Stripe",
                        ],
                        'unit_amount'  => $amount,
                    ],
                    'quantity'   => 1,
                ],

            ],
            'mode'        => 'payment',
            'success_url' => url('/user/payment/success')."?amount=".$amount."&reference=".$reference,
            'cancel_url'  => route('checkout'),
        ]);

        return redirect()->away($session->url);
    }




    public function success(Request $request): RedirectResponse
    {
        $data = new PaymentTransaction();
        $data->user_id = Auth::user()->id;
        $data->amount =  $request->amount /100;
        $data->ref_no = $request->reference;
        $data->description = "Speak Token Wallet Funding with Stripe";
        $data->extra = null;
        $data->status = 1 ;
        $data->type = PaymentType::CREDIT;
        $data->save();
        Session::flash('message', "Payment Successful");
        return redirect()->route('user.dashboard.wallet');

    }

    public function checkout(): RedirectResponse
    {
        return redirect()->route('admin.transactions.funding');
    }

}
