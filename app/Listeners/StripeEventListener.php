<?php

namespace App\Listeners;

use App\Models\Donation\Donation;
use App\Models\Shop\Payment;
use App\Models\User;
use App\Notifications\AdminNotification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Stripe\Stripe;

class StripeEventListener
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(object $event): void
    {
        if ($event->payload['type'] === 'checkout.session.completed') {
            $this->checkoutUpdate($event->payload);
        }

        if ($event->payload['type'] === 'checkout.session.async_payment_succeeded') {
            $this->checkoutUpdate($event->payload);
        }


        if ($event->payload['type'] === 'checkout.session.async_payment_failed') {
            $this->checkoutUpdate($event->payload);
        }



//        if ($event->payload['type'] === 'charge.succeeded' || $event->payload['type'] === 'charge.failed') {
//            $this->chargeUpdate($event->payload);
//        }



        if ($event->payload['type'] === 'payment_intent.succeeded' || $event->payload['type'] === 'payment_intent.payment_failed') {
            $this->paymentIntentStatus($event->payload);
        }
    }


    private function checkoutUpdate($res)
    {
        try{

            $p = $res['data']['object'];
            $meta = $p['metadata'];

            if($meta['type'] === 'order'){
                $payment = Payment::where('payment_no', $meta['payment_no'])->where('user_id', $meta['user_id'])->first();

                if($payment){

                    $payment->update([
                        'intent_id' => $p['payment_intent'],
                        'payment_status' => $p['payment_status'],
                        'session_status' => $p['status'],
                    ]);

                    $user = new User();
                    $admin = $user->getAdmin();
                    $admin->notify((new AdminNotification('Order Placed. Payment No: ' . $meta['payment_no'] )));

                }else{
                    $user = new User();
                    $admin = $user->getAdmin();
                    $admin->notify((new AdminNotification('Error, Payment received for Payment No: '. $meta['payment_no'] . ' but payment details not available on the database.' )));
                }
            }else{
                $donation = Donation::where('donation_no', $meta['donation_no'])->where('user_id', $meta['user_id'])->first();
                if($donation){
                    $donation->update([
                        'intent_id' => $p['payment_intent'],
                        'payment_status' => $p['payment_status'],
                        'session_status' => $p['status'],
                    ]);

                    $user = new User();
                    $admin = $user->getAdmin();
                    $admin->notify((new AdminNotification('New donation received.' )));
                }else{
                    $user = new User();
                    $admin = $user->getAdmin();
                    $admin->notify((new AdminNotification('Error, Donation received for Donation No: '. $meta['donation_no'] . ' but donation details not available on the database.' )));
                }
            }


        }catch (\Exception $e){
            $user = new User();
            $admin = $user->getAdmin();
            $admin->notify((new AdminNotification('Checkout error.' . $e->getMessage() . ' ' . $e->getLine() . ' ' . $e->getFile())));
        }

    }



    private function paymentIntentStatus($res)
    {
        try{

            $p = $res['data']['object'];
            $meta = $p['metadata'];

            if($meta['type'] === 'order'){
                $payment = Payment::where('payment_no', $meta['payment_no'])->where('user_id', $meta['user_id'])->first();

                if($payment){
                    Stripe::setApiKey(config('app.strip_secret'));

                    $charge = \Stripe\Charge::retrieve($p['latest_charge']);

                    $payment->update([
                        'receipt' => $charge['receipt_url'],
                    ]);

                }else{
                    $user = new User();
                    $admin = $user->getAdmin();
                    $admin->notify((new AdminNotification('Error, Payment received for Payment No: '. $meta['payment_no'] . ' but payment details not available on the database.' )));
                }
            }else{
                $donation = Donation::where('donation_no', $meta['donation_no'])->where('user_id', $meta['user_id'])->first();
                if($donation){
                    Stripe::setApiKey(config('app.strip_secret'));

                    $charge = \Stripe\Charge::retrieve($p['latest_charge']);

                    $donation->update([
                        'receipt' => $charge['receipt_url'],
                    ]);
                }else{
                    $user = new User();
                    $admin = $user->getAdmin();
                    $admin->notify((new AdminNotification('Error,Donation received for Donation No: '. $meta['donation_no'] . ' but donation details not available on the database.' )));
                }

            }


        }catch (\Exception $e){
            $user = new User();
            $admin = $user->getAdmin();
            $admin->notify((new AdminNotification('Checkout error.' . $e->getMessage() . ' ' . $e->getLine() . ' ' . $e->getFile())));
        }

    }




}
