<?php

namespace App\Http\Controllers\Shop;

use App\Http\Controllers\Controller;
use App\Http\Resources\Site\ProductResource;
use App\Models\Shop\Payment;
use App\Models\Shop\PaymentItem;
use App\Models\Shop\Product;
use App\Models\User;
use App\Notifications\AdminNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Inertia\Inertia;
use Stripe\Stripe;

class ShopController extends Controller
{


    public function show($id)
    {
        $product = Product::where('status', Product::ACTIVE)->where('id',$id)->first();

        return Inertia::render('Shop/ShowProduct',[
            'product' =>$product ? new ProductResource($product) : null
        ]);

    }

    public function success()
    {
        return Inertia::render('Shop/Success');
    }

    public function index()
    {

        $products = Product::where('status', Product::ACTIVE)->orderBy('created_at','desc')->paginate(20);

        return Inertia::render('Shop/View', [
            'allProducts' => ProductResource::collection($products)
        ]);
    }

    public function checkout(Request $request)
    {

        $stripeCustomer = auth()->user()->createOrGetStripeCustomer();
        $address = null;
        $hasPaymentMethod = null;
        if(!is_null($stripeCustomer->address)){
            $address = $stripeCustomer->address;
        }

        if (auth()->user()->hasDefaultPaymentMethod()) {
           $hasPaymentMethod = 'yes';
        }

//        $url = $request->user()->billingPortalUrl(route('payment.checkout'));



        return Inertia::render('Shop/Checkout',[
            'customerAddress' => $address,
            'customerHasPaymentMethod' => $hasPaymentMethod,
            'billingPortal' => null
        ]);
    }

    public function pay(Request $request)
    {
        try {

            if(count($request->cart) > 0){
                $products = [];
                foreach ($request->cart as $item){
                    $product = [
                        'price_data'=>[
                            'currency'=>'eur',
                            'tax_behavior'=>'inclusive',
                            'product_data'=>[
                                'name' => $item['title'],
                                'images'=>[$item['image']],
                                'metadata'=>[
                                    'user_id' => auth()->id(),
                                    'type' => 'order'
                                ],
                            ],
                            'unit_amount'=> $item['price'],

                        ],
                        'quantity'=> 1,

                    ];
                   $products[] = $product;
                }


                Stripe::setApiKey(config('app.strip_secret'));

                $stripeCustomer = auth()->user()->createOrGetStripeCustomer();
                $paymentNo = Str::random(8);

                $session = \Stripe\Checkout\Session::create([
                    'success_url' => config('app.url').'/payment/success',
                    'cancel_url' => config('app.url').'/payment/checkout',
                    'customer'=>$stripeCustomer->id,
                    'line_items' => $products,
                    'client_reference_id' => $paymentNo,
                    'metadata'=>[
                        'user_id' => auth()->id(),
                        'payment_no' => $paymentNo,
                        'type' => 'order'
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
                            'payment_no' => $paymentNo,
                            'type' => 'order'
                        ]
                    ]
                ]);


                $payment = Payment::create([
                   'user_id' => auth()->id(),
                   'payment_no' => $paymentNo,
                   'payment_status' => $session->payment_status,
                   'session_status' => $session->status,
                    'amount_subtotal' => $session->amount_subtotal,
                    'amount_total' => $session->amount_total,
                    'amount_tax' => $session->total_details->amount_tax,
                ]);


                foreach ($request->cart as $item){
                    PaymentItem::create([
                       'user_id' => auth()->id(),
                       'payment_id' => $payment->id,
                       'product_id' => $item['id']
                    ]);
                }





                return Inertia::location($session->url);

            }else{
                return redirect(route('payment.checkout'));
            }

        }catch (\Exception $e){
            \Log::info($e);
            return redirect(route('payment.checkout'));
        }

    }


}
