<?php

namespace App\Http\Controllers\Donation;

use App\Http\Controllers\Controller;
use App\Models\Donation\Donation;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Inertia\Inertia;
use Stripe\Stripe;

class DonationController extends Controller
{

    public function success()
    {
        return Inertia::render('Donate/Success');
    }
    public function donate(Request $request)
    {
        try {

                    $product = [
                        'price_data'=>[
                            'currency'=>'eur',
                            'tax_behavior'=>'inclusive',
                            'product_data'=>[
                                'name' => 'Donation of 20 EUR',
                                'metadata'=>[
                                    'user_id' => auth()->id(),
                                    'type' => 'donation'
                                ],
                            ],
                            'unit_amount'=> 20000,
                        ],
                        'quantity'=> 1,
                    ];

                Stripe::setApiKey(config('app.strip_secret'));
                $donationNo = Str::random(8);

                $stripeCustomer = auth()->user()->createOrGetStripeCustomer();


                $session = \Stripe\Checkout\Session::create([
                    'success_url' => config('app.url').'/donation/success',
                    'cancel_url' => config('app.url').'/',
                    'customer'=>$stripeCustomer->id,
                    'line_items' => [
                        [
                            'price_data' => [
                                'currency'=>'eur',
                                'product_data'=>[
                                    'name' => 'Donation of 20 EUR',
                                    'metadata'=>[
                                        'user_id' => auth()->id(),
                                        'type' => 'donation'
                                    ],
                                ],
                                'unit_amount'=> 2000,
                            ],
                            'quantity'=> 1,
                        ]
                    ],
                    'metadata'=>[
                        'user_id' => auth()->id(),
                        'donation_no' => $donationNo,
                        'type' => 'donation'
                    ],
                    'automatic_tax' => [
                        'enabled' => true,
                    ],
                    'customer_update' => [
                        'address' => 'auto',
                        'shipping' => 'auto',
                    ],
                    'mode' => 'payment',
                    'payment_method_types' =>["card","giropay","sofort"],
                    'payment_intent_data' =>[
                        'receipt_email' => auth()->user()->email,
                        'statement_descriptor' => 'Lovely-Hearts',
                        'metadata' => [
                            'user_id' => auth()->id(),
                            'type' => 'donation',
                            'donation_no' => $donationNo
                        ]
                    ]
                ]);


                $donation = Donation::create([
                    'user_id' => auth()->id(),
                    'donation_no' => $donationNo,
                    'payment_status' => $session->payment_status,
                    'session_status' => $session->status,
                    'amount_subtotal' => $session->amount_subtotal,
                    'amount_total' => $session->amount_total,
                    'amount_tax' => $session->total_details->amount_tax,
                ]);



                return Inertia::location($session->url);

        }catch (\Exception $e){
            \Log::info($e);
            return redirect(route('home'));
        }
    }
}
