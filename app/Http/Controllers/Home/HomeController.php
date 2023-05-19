<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use App\Http\Resources\Adopt\PetResource;
use App\Http\Resources\Donation\DonationResource;
use App\Http\Resources\Site\PaymentResource;
use App\Models\Adopt\Adopt;
use App\Models\Donation\Donation;
use App\Models\Shop\Payment;
use Illuminate\Http\Request;
use Inertia\Inertia;

class HomeController extends Controller
{
    public function index()
    {
        return Inertia::render('Home/HomePage');
    }

    public function dashboard()
    {

        $orders = Payment::where('user_id',auth()->id())->orderBy('payment_status','asc')->orderBy('created_at','desc')->get(); //TODO: paginate
        $pets = Adopt::where('user_id',auth()->id())->orderBy('status','desc')->orderBy('created_at','desc')->get(); //TODO: paginate
        $donations = Donation::where('user_id',auth()->id())->orderBy('payment_status','asc')->orderBy('created_at','desc')->get(); //TODO: paginate

        return Inertia::render('Home/DashboardPage',[
            'orders' => PaymentResource::collection($orders),
            'pets' => PetResource::collection($pets),
            'donations' => DonationResource::collection($donations)
        ]);
    }
}
