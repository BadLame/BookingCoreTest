<?php

use App\Http\Controllers\GuidesController;
use Illuminate\Support\Facades\Route;

Route::name('guides.')->prefix('guides/')->group(function () {
    Route::get('/', [GuidesController::class, 'list'])->name('list');
});
