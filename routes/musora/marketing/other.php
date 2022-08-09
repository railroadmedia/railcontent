<?php

use App\Http\Controllers\Musora\MarketingController;
use App\Http\Controllers\Musora\ReferralJoinController;
use Illuminate\Support\Facades\Route;

Route::domain('{musoraDomain}')
    ->middleware(['web_public'])
    ->group(function () {
        Route::get('about', [MarketingController::class, 'about']);
        Route::get('terms-of-service', [MarketingController::class, 'terms']);
        Route::get('privacy-policy', [MarketingController::class, 'privacy']);
        Route::get('careers', [MarketingController::class, 'careers']);
        Route::get('ambassador', [MarketingController::class, 'ambassador']);
        Route::get('brand', [MarketingController::class, 'brand']);
        Route::get('referral-join', [ReferralJoinController::class, 'join']);
    });
