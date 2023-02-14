<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Singeo\SalesController;
use App\Http\Controllers\Singeo\LeadGenController;

Route::domain('{singeoDomain}')
    ->middleware(['web_public'])
    ->group(function () {
    Route::get('/', [SalesController::class, 'home'] );
    Route::get('/trial', [SalesController::class, 'home']);
    Route::get('/trial-month', [SalesController::class, 'homeMonth']);
    Route::get('/new-year', [SalesController::class, 'promo'] );
    Route::get('/lp', [SalesController::class, 'promo'] );
    Route::get('/student-only', [SalesController::class, 'promo']);
    Route::get('/choose-plan', [SalesController::class, 'choosePlan'] );
    Route::get('/choose-your-trial', [SalesController::class, 'choosePlan']);

    Route::get('/choose-your-trial-month', [SalesController::class, 'choosePlanMonth']);
    Route::get('/affiliate-trial', [SalesController::class, 'choosePlanMonth']);
    Route::get('/affiliate/asobergirlsguide', [SalesController::class, 'asobergirlsguide']);

    Route::get('/privacy', [SalesController::class, 'privacy']);
    Route::get('/terms', [SalesController::class, 'terms']);
    Route::get('/cookie', [SalesController::class, 'cookie']);

    Route::get('/method', [SalesController::class, 'method']);
    Route::get('/coaches', [SalesController::class, 'coaches']);
    Route::get('/songs', [SalesController::class, 'songs']);

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
    Route::get('/lifetime-members-masterclass', [SalesController::class, 'lifetimeMasterclass']);

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
    Route::get('/improve-any-voice', [LeadGenController::class, 'improveAnyVoice']);
    Route::group(['prefix' => 'live-vocal-bootcamp'],
        function () {
            Route::get('/{page?}', LeadGenController::class . '@liveBootcamp')
                ->whereIn('page', [
                    null, 'zoom'
                ]);
        }
    );
    Route::get('/stop-hating-your-voice', [LeadGenController::class, 'stopHatingVoice']);

    Route::get('/{leadgenSlug?}', LeadGenController::class.'@leadgen')
        ->where('leadgenSlug', '(.*)');
});

