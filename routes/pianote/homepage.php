<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Pianote\HomePageBaseController;

Route::domain('{pianoteDomain}')->group(function () {
    Route::get('/', [HomePageBaseController::class, 'show']);
});
