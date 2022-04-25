<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Singeo\HomePageController;

Route::domain('{singeoDomain}')->group(function () {
    Route::get('/', [HomePageController::class, 'show']);
});
