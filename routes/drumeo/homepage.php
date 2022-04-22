<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Drumeo\HomePageBaseController;

Route::domain('{drumeoDomain}')->group(function () {
    Route::get('/', [HomePageBaseController::class, 'show']);
});
