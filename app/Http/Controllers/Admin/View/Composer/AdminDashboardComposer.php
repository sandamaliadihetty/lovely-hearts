<?php

namespace App\Http\Controllers\Admin\View\Composer;

use App\Models\Adopt\Adopt;
use App\Models\Donation\Donation;
use App\Models\Shop\Payment;
use App\Models\Shop\Product;
use Illuminate\View\View;

class AdminDashboardComposer
{
    public function compose(View $view)
    {
            $df['active_products'] = Product::where('status',1)->count();
            $df['inactive_products'] = Product::where('status',0)->count();

            $df['paid_donations'] = Donation::where('payment_status','paid')->sum('amount_total');
            $df['paid_donations_count'] = Donation::where('payment_status','paid')->count();
            $df['unpaid_donations'] = Donation::where('payment_status','unpaid')->sum('amount_total');
            $df['unpaid_donations_count'] = Donation::where('payment_status','unpaid')->count();

            $df['paid_orders_count'] = Payment::where('payment_status','paid')->count();
            $df['paid_orders'] = Payment::where('payment_status','paid')->sum('amount_total');
            $df['unpaid_orders_count'] = Payment::where('payment_status','unpaid')->count();
            $df['unpaid_orders'] = Payment::where('payment_status','unpaid')->sum('amount_total');

            $df['active_adoptions'] = Adopt::where('status',1)->count();
            $df['inactive_adoptions'] = Adopt::where('status',0)->count();

            $view->with(['data'=>$df]);
    }
}
