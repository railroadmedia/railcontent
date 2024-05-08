<?php

use App\Http\Controllers\Musora\CodeRedemptionController;
use App\Http\Controllers\Musora\MarketingController;
use App\Http\Controllers\Musora\ReferralJoinController;

use App\Http\Controllers\Musora\SalesController;
use App\Http\Middleware\VerifyCsrfToken;
use Illuminate\Support\Facades\Route;

Route::domain('{musoraDomain}')
    ->middleware(['web_public'])
    ->group(function () {
        Route::get('/', [MarketingController::class, 'homepage']);
        Route::get('/trial', [MarketingController::class, 'trial']);
        Route::get('/app', [MarketingController::class, 'app']);
        Route::get('/spotify', [MarketingController::class, 'spotify']);
        Route::get('6-reasons', [MarketingController::class, 'sixReasons']);
        Route::get('6-reasons/drums', [MarketingController::class, 'sixReasonsDrums']);
        Route::get('6-reasons/piano', [MarketingController::class, 'sixReasonsPiano']);
        Route::get('6-reasons/guitar', [MarketingController::class, 'sixReasonsGuitar']);
        Route::get('6-reasons/singing', [MarketingController::class, 'sixReasonsSinging']);
        //        Route::get('/handbook', [MarketingController::class, 'handbook']);
        Route::get('about', [MarketingController::class, 'about']);
        Route::get('contact', [MarketingController::class, 'contact']);
        Route::get('terms', [MarketingController::class, 'terms']);
        Route::get('privacy', [MarketingController::class, 'privacy']);
        Route::get('preferences', [MarketingController::class, 'preferences']);
        Route::get('careers', [MarketingController::class, 'careers']);
        Route::get('careers-pinpoint', [MarketingController::class, 'careersPP']);
        Route::get('ambassador', [MarketingController::class, 'ambassador']);
        Route::get('brand', [MarketingController::class, 'brand']);
        Route::get('unified-2022', [MarketingController::class, 'unified2022']);
        Route::get('mentors', [MarketingController::class, 'mentors']);
        Route::get('moderators', [MarketingController::class, 'moderators']);
        Route::get('playlists', [MarketingController::class, 'playlists']);
        Route::get('referral-join', [ReferralJoinController::class, 'join']);
        Route::get('recitals', [MarketingController::class, 'recitals']);
        Route::get('playlists', [MarketingController::class, 'playlists']);
        Route::get('gift-card', [MarketingController::class, 'giftcard']);
        Route::get('method', [MarketingController::class, 'method']);
        Route::get('songs', [MarketingController::class, 'songs']);
        Route::get('community', [MarketingController::class, 'community']);
        Route::get('choose-plan', [MarketingController::class, 'choosePlan']);
        Route::get('choose-your-trial-month', [MarketingController::class, 'choosePlanMonth']);

        Route::get('/drum-faster', [MarketingController::class, 'faster']);

        Route::get('redeem', [CodeRedemptionController::class, 'renderNewAccountRedeemPage']);
        Route::get('friends', [CodeRedemptionController::class, 'friends']);
        Route::get('friends2', [CodeRedemptionController::class, 'friends2']);
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
        Route::get('redeem-spotify', [CodeRedemptionController::class, 'spotifyRedeemNewMusora']);
        Route::get('redeem-spotify/existing', [CodeRedemptionController::class, 'spotifyRedeemExistingMusora']);

        Route::post('/claim-spotify', [SalesController::class, 'claimSpotify'])
            ->withoutMiddleware([VerifyCsrfToken::class])
            ->name('claim-spotify');
    });
