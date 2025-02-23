<?php

use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('index');
})->middleware(['auth', 'verified'])->name('index');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::group(['prefix'=>'payment'], static function(){
    Route::get('/', [PaymentController::class, 'index'])->name('payment.index');
    Route::post('/', [PaymentController::class,'makePayment'])->name('payment');
    Route::get('/get-qrcode/{asaasId}', [PaymentController::class,'getQrCode'])->name('payment.getQrCode');
});

require __DIR__.'/auth.php';