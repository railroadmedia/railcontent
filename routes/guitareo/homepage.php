<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Guitareo\HomePageController;

Route::domain('{guitareoDomain}')->group(function () {
    Route::get('/', [HomePageController::class, 'show']);
});
