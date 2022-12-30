<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Singeo\SalesController;
use App\Http\Controllers\Singeo\LeadGenController;

Route::domain('{singeoDomain}')
    ->middleware(['web_public'])
    ->group(function () {
    Route::get('/', [SalesController::class, 'home'] );
    Route::get('/new-year', [SalesController::class, 'promo'] );
    Route::get('/choose-plan', [SalesController::class, 'choosePlan'] );
    Route::get('/student-only', [SalesController::class, 'studentOnly']);
    Route::get('/privacy', [SalesController::class, 'privacy']);
    Route::get('/terms', [SalesController::class, 'terms']);
    Route::get('/trial', [SalesController::class, 'trial']);
    Route::get('/trial-month', [SalesController::class, 'trialMonth']);
    Route::get('/choose-your-trial', [SalesController::class, 'chooseYourTrial']);
    Route::get('/choose-your-trial-month', [SalesController::class, 'chooseYourTrialMonth']);
    Route::get('/cookie', [SalesController::class, 'cookie']);

    Route::get('/method', [SalesController::class, 'method']);
    Route::get('/coaches', [SalesController::class, 'coaches']);
    Route::get('/songs', [SalesController::class, 'songs']);

    Route::get('/affiliate/asobergirlsguide', [SalesController::class, 'asobergirlsguide']);
    Route::get('/affiliate-trial', [SalesController::class, 'affiliateTrial']);

    Route::get('/preferences/beginner', [SalesController::class, 'prefBeginner']);
    Route::get('/preferences/intermediate', [SalesController::class, 'prefIntermediate']);
    Route::get('/preferences/professionals', [SalesController::class, 'prefProfessionals']);

    Route::get('/thank-you', [SalesController::class, 'thankyou']);
    Route::get('/subscribed', [SalesController::class, 'subscribed']);
    Route::get('/lets-sing-a-song', [SalesController::class, 'letssingasong']);
    Route::get('/welcome-party', [SalesController::class, 'welcomeparty']);
    Route::get('/shop/singing-starter-kit', [SalesController::class, 'singingstarterkit']);
    Route::get('/singingstarterkit', [SalesController::class, 'singingstarterkitalt']);
    Route::get('/singing-starter-kit-discount', [SalesController::class, 'singingstarterkitdiscount']);
    Route::get('/singing-starter-kit-shyv-discount', [SalesController::class, 'singingstarterkitshyvdiscount']);
    Route::get('/recitals', [SalesController::class, 'recitals']);
    Route::get('/giveaway', [SalesController::class, 'giveaway']);
    Route::get('/ultimate-giveaway', [SalesController::class, 'ultimategiveaway']);
    Route::get('/beautiful-harmonies', [SalesController::class, 'beautifulharmonies']);

    Route::group(['prefix' => 'beginner-vocal-bootcamp'],
        function () {
            Route::get('/{page?}', LeadGenController::class . '@beginnerBootcamp')
                ->whereIn('page', [
                    null, 'zoom'
                ]);
        }
    );
    Route::group(['prefix' => 'holiday-karaoke'],
        function () {
            Route::get('/{page?}', LeadGenController::class . '@holidayKaraoke')
                ->whereIn('page', [
                    null, 'unlocked'
                ]);
        }
    );
    Route::group(['prefix' => 'improve-any-voice'],
        function () {
            Route::get('/{page?}/{lesson?}', LeadGenController::class . '@improveAnyVoice')
                ->whereIn('page', [
                    null, 'lessons'
                ])
                ->whereIn('lesson', [
                    null, '1', '2', '3', '4', '5', '6', '7'
                ]);
        }
    );
    Route::group(['prefix' => 'live-vocal-bootcamp'],
        function () {
            Route::get('/{page?}', LeadGenController::class . '@liveBootcamp')
                ->whereIn('page', [
                    null, 'zoom'
                ]);
        }
    );
    Route::group(['prefix' => 'stop-hating-your-voice'],
        function () {
            Route::get('/{page?}/{lesson?}', LeadGenController::class . '@stopHatingVoice')
                ->whereIn('page', [
                    null, 'lessons'
                ])
                ->whereIn('lesson', [
                    null, '1', '2', '3'
                ]);
        }
    );
});

