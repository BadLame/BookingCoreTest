<?php

use App\Http\Controllers\GuidesController;
use App\Http\Controllers\HuntingBookingController;
use Illuminate\Support\Facades\Route;

Route::name('guides.')->prefix('guides/')->group(function () {
    Route::get('/', [GuidesController::class, 'list'])->name('list');
});

Route::name('bookings.')->prefix('bookings/')->group(function () {
    Route::post('/', [HuntingBookingController::class, 'book'])->name('book');
});
