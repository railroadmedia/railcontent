<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Guitareo\SalesController;

Route::domain('{guitareoDomain}')->group(function () {
    Route::get('/', [SalesController::class, 'show']);


});
