<?php

use App\Http\Controllers\Adopt\AdoptController;
use App\Http\Controllers\Donation\DonationController;
use App\Http\Controllers\Home\HomeController;
use App\Http\Controllers\Shop\ShopController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//Route::get('/', function () {
//    return Inertia::render('Welcome', [
//        'canLogin' => Route::has('login'),
//        'canRegister' => Route::has('register'),
//        'laravelVersion' => Application::VERSION,
//        'phpVersion' => PHP_VERSION,
//    ]);
//});

Route::get('/',[HomeController::class,'index'])->name("home");
Route::get('/shop',[ShopController::class,'index'])->name("shop.index");
Route::get('/shop/product/{id}',[ShopController::class,'show'])->name("shop.show");

Route::get('/adopt/pet/show/{id}', [AdoptController::class,'show'])->name('adopt.pet.show');
Route::get('/adopt', [AdoptController::class,'index'])->name('adopt.index');

Route::middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified',])->group(function () {


    Route::get('/dashboard',[HomeController::class,'dashboard'])->name("dashboard");

    Route::get('/payment/checkout', [ShopController::class,'checkout'])->name('payment.checkout');
    Route::get('/payment/success', [ShopController::class,'success'])->name('payment.success');
    Route::post('/payment/checkout', [ShopController::class,'pay'])->name('payment.checkout.pay');

    Route::post('/donation', [DonationController::class,'donate'])->name('donation.pay');
    Route::get('/donation/success', [DonationController::class,'success'])->name('donation.success');


    Route::get('/adopt/pet', [AdoptController::class,'create'])->name('adopt.create');

    Route::post('/adopt', [AdoptController::class,'store'])->name('adopt.store');


});
