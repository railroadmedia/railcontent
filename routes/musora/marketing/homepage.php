<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Musora\HomePageController;

Route::domain('{subdomain}.musora.com')->group(function () {
    Route::get('/', [HomePageController::class, 'show']);
});

