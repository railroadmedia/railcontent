<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Guitareo\HomePageBaseController;

Route::domain('{guitareoDomain}')->group(function () {
    Route::get('/', [HomePageBaseController::class, 'show']);
});
