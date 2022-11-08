<?php

use App\Http\Controllers\Musora\MarketingController;
use App\Http\Controllers\Musora\ReferralJoinController;
use Illuminate\Support\Facades\Route;

Route::domain('{musoraDomain}')
    ->middleware(['web_public'])
    ->group(function () {
        Route::get('about', [MarketingController::class, 'about']);
        Route::get('contact', [MarketingController::class, 'contact']);
        Route::get('terms-of-service', [MarketingController::class, 'terms']);
        Route::get('privacy-policy', [MarketingController::class, 'privacy']);
        Route::get('careers', [MarketingController::class, 'careers']);
        Route::get('ambassador', [MarketingController::class, 'ambassador']);
        Route::get('brand', [MarketingController::class, 'brand']);
        Route::get('unified-2022', [MarketingController::class, 'unified2022']);
        Route::get('referral-join', [ReferralJoinController::class, 'join']);
        Route::get('power-pack', [\App\Http\Controllers\Musora\CodeRedemptionController::class, 'powerPack']);
        Route::post('hlag-submit',
                    [\App\Http\Controllers\Musora\CodeRedemptionController::class, 'hitLikeAGirlSubmission']);
        Route::get('/redeem',
                   [\App\Http\Controllers\Musora\CodeRedemptionController::class, 'renderNewAccountRedeemPage']
    );
        Route::get(
            '/redeem/existing',
            [\App\Http\Controllers\Musora\CodeRedemptionController::class, 'renderExistingAccountRedeemPage']
        );
        Route::get('/roland',
                   [\App\Http\Controllers\Musora\CodeRedemptionController::class, 'roland']
        );
        Route::get('/sonor',
                   [\App\Http\Controllers\Musora\CodeRedemptionController::class, 'sonor']);
        Route::post(
            '/access-codes/redeem',
            Railroad\Ecommerce\Controllers\AccessCodeController::class . '@claim'
        )->name('access-codes.form-claim');
    });
