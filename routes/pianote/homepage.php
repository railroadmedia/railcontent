<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Pianote\HomePageController;

Route::domain('{subdomain}.pianote.com')->group(function () {
    Route::get('/', [HomePageController::class, 'show']);
});