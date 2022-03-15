<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Singeo\HomePageController;

Route::domain('{subdomain}.singeo.com')->group(function () {
    Route::get('/', [HomePageController::class, 'show']);
});