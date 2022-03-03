<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Guitareo\HomePageController;

Route::domain('{subdomain}.guitareo.com')->group(function () {
    Route::get('/', [HomePageController::class, 'show']);
});