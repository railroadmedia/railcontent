<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Musora\HomePageController;

Route::domain('{musoraDomain}')->group(function () {
    Route::get('/', [HomePageController::class, 'show']);
});

