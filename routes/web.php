<?php

use App\Http\Controllers\PipraPayController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/create-payment', [PipraPayController::class, 'createPayment'])->name('payment.create');
Route::get('/success', [PipraPayController::class, 'success'])->name('payment.success');
Route::get('/cancel', [PipraPayController::class, 'cancel'])->name('payment.cancel');
Route::post('/webhook', [PipraPayController::class, 'webhook'])->name('payment.webhook');
Route::post('/verify-payment', [PipraPayController::class, 'verify'])->name('payment.verify');
