<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Pianote\HomePageController;

Route::domain('{pianoteDomain}')->group(function () {
    Route::get('/', [HomePageController::class, 'show']);
});
