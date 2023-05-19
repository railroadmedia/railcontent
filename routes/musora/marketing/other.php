<?php

use App\Http\Controllers\Musora\CodeRedemptionController;
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
        Route::get('recitals', [MarketingController::class, 'recitals']);
        Route::get('gift-card', [MarketingController::class, 'giftcard']);
        Route::get('method', [MarketingController::class, 'method']);
        Route::get('songs', [MarketingController::class, 'songs']);

        Route::get('redeem', [CodeRedemptionController::class, 'renderNewAccountRedeemPage']);
        Route::get('friends', [CodeRedemptionController::class, 'friends']);
        Route::get('redeem/existing', [CodeRedemptionController::class, 'renderExistingAccountRedeemPage']);
        Route::get('redeem-thomann', [CodeRedemptionController::class, 'renderNewAccountThomannRedeemPage']);
        Route::get('pianote/redeem', [CodeRedemptionController::class, 'showPianoteRedeemPageForNewUsers']);
        Route::get('pianote/redeem/existing', [CodeRedemptionController::class, 'showPianoteRedeemPageForExistingUsers']);

        Route::get('drumeo/sweetwater', [CodeRedemptionController::class, 'sweetwaterRedeemNewDrumeo']);
        Route::get('drumeo/sweetwater/existing', [CodeRedemptionController::class, 'sweetwaterRedeemExistingDrumeo']);
        Route::get('pianote/sweetwater', [CodeRedemptionController::class, 'sweetwaterRedeemNewPianote']);
        Route::get('pianote/sweetwater/existing', [CodeRedemptionController::class, 'sweetwaterRedeemExistingPianote']);
        Route::get('guitareo/sweetwater', [CodeRedemptionController::class, 'sweetwaterRedeemNewGuitareo']);
        Route::get('guitareo/sweetwater/existing', [CodeRedemptionController::class, 'sweetwaterRedeemExistingGuitareo']);
        Route::get('singeo/sweetwater', [CodeRedemptionController::class, 'sweetwaterRedeemNewSingeo']);
        Route::get('singeo/sweetwater/existing', [CodeRedemptionController::class, 'sweetwaterRedeemExistingSingeo']);
        Route::get('sweetwater', [CodeRedemptionController::class, 'sweetwaterRedeemNewMusora']);
        Route::get('sweetwater/existing', [CodeRedemptionController::class, 'sweetwaterRedeemExistingMusora']);
    });
