<?php

use App\Http\Controllers\ShortLinkController;
use Illuminate\Support\Facades\Route;


Route::get('/', [ShortLinkController::class, 'index']);
Route::post('/shorten', [ShortLinkController::class, 'store'])->name('shorten');
Route::get('/{code}', [ShortLinkController::class, 'redirect'])->name('shortlink.redirect');
