<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Drumeo\HomePageController;

Route::domain('{subdomain}.drumeo.com')->group(function () {
    Route::get('/', [HomePageController::class, 'show']);
});