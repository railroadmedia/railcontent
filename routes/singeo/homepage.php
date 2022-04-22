<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Singeo\HomePageBaseController;

Route::domain('{singeoDomain}')->group(function () {
    Route::get('/', [HomePageBaseController::class, 'show']);
});
