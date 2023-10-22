<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Pianote\SalesController;

Route::domain('{pianoteDomain}')
    ->middleware(['web_public'])
    ->group(function () {
        Route::get('/', [SalesController::class, 'home'] );
        Route::get('/trial', [SalesController::class, 'trialPosters'] );
        Route::get('/posters-trial', [SalesController::class, 'trialPosters'] );
        Route::get('/chords-trial', [SalesController::class, 'trialChords'] );
        Route::get('/trial-songs', [SalesController::class, 'trialSongs'] );
        Route::get('/trial-beginner', [SalesController::class, 'trialBeginner'] );
        Route::get('/trial-month', [SalesController::class, 'homeMonth'] );
        Route::get('/lp', [SalesController::class, 'promo'] );
        Route::get('/song-secrets-bonus', [SalesController::class, 'promoSS'] );
        Route::get('/piano-month', [SalesController::class, 'pianoMonth'] );
        Route::get('/student-only', [SalesController::class, 'promo'] );
        Route::get('/restart', [SalesController::class, 'restart'] );
        Route::get('/choose-plan', [SalesController::class, 'choosePlan'] );
        Route::get('/choose-your-trial', [SalesController::class, 'choosePlan'] );
        Route::get('/choose-your-trial-month', [SalesController::class, 'choosePlanMonth'] );
        Route::get('/affiliate-trial', [SalesController::class, 'choosePlanMonth'] );
        Route::get('/a/davidbennett', [SalesController::class, 'davidbennett'] );
        Route::group(['prefix' => 'affiliate' ],
            function () {
                Route::get('/{page?}', SalesController::class . '@affiliates')
                    ->whereIn('page', [
                        'asobergirlsguide', 'keyboardkraze', 'pianodreamers'
                    ]);
            }
        );
        Route::group(['prefix' => 'a' ],
            function () {
                Route::get('/{page?}', SalesController::class . '@affiliates')
                    ->whereIn('page', [
                        'leviclay'
                    ]);
            }
        );

        Route::get('/about', [SalesController::class, 'about'] );
        Route::get('/app', [SalesController::class, 'app'] );
        Route::get('/coaches', [SalesController::class, 'coaches'] );
        Route::get('/cookie', [SalesController::class, 'cookie'] );
        Route::get('/lifetime', [SalesController::class, 'lifetime'] );
        Route::get('/lifetime-members', [SalesController::class, 'lifetimeMembers'] );
        Route::get('/lisa-recommends', [SalesController::class, 'lisarecommends'] );
        Route::get('/method', [SalesController::class, 'method'] );
        Route::get('/privacy', [SalesController::class, 'privacy'] );
        Route::get('/roland', [SalesController::class, 'roland'] );
        Route::get('/songs', [SalesController::class, 'songs'] );
        Route::get('/terms', [SalesController::class, 'terms'] );
        Route::get('/welcome-party', [SalesController::class, 'welcomeparty'] );

        Route::post('/claim-roland-90-day-access', [SalesController::class, 'claimRoland90DaysAccess'] );
});
