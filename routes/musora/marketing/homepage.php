<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Musora\HomePageBaseController;

Route::domain('{musoraDomain}')->group(function () {
    Route::get('/', [HomePageBaseController::class, 'show']);
});

