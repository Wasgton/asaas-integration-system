<?php

use App\Http\Controllers\PaymentController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::group(['prefix'=>'payment'], static function(){
    Route::post('/', [PaymentController::class,'makePayment'])->name('payment');
    Route::get('/confirmation', [PaymentController::class])->name('payment.confirmation');
});