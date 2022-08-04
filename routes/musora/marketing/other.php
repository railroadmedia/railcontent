<?php

use App\Http\Controllers\Musora\MarketingController;
use Illuminate\Support\Facades\Route;

Route::domain('{musoraDomain}')
    ->middleware(['web_public'])
    ->group(function () {
        Route::get('terms', [MarketingController::class, 'terms']);
        Route::get('privacy', [MarketingController::class, 'privacy']);
        Route::get('careers', [MarketingController::class, 'careers']);
        Route::get('ambassador', [MarketingController::class, 'ambassador']);

    });
