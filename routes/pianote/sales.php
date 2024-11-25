<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Pianote\SalesController;

Route::domain('{pianoteDomain}')
    ->middleware(['web_public'])
    ->group(function () {
        Route::get('/', [SalesController::class, 'homeBF']);
        Route::get('/trial-month', [SalesController::class, 'homeMonth']);
        Route::get('/trial', [SalesController::class, 'trial']);
        Route::get('/posters-trial', [SalesController::class, 'trialPosters']);
        Route::get('/chords-trial', [SalesController::class, 'trial']);
        Route::get('/trial-songs', [SalesController::class, 'trialSongs']);
        Route::get('/trial-beginner', [SalesController::class, 'trialBeginner']);
        Route::get('/ultimate-practice', [SalesController::class, 'ultimatepractice']);
        Route::get('/promo/beautiful-beginner-bundle', [SalesController::class, 'beginner']);
        Route::get('/back-to-school', [SalesController::class, 'backToSchool']);
        Route::get('/monthly', [SalesController::class, 'monthly']);
        Route::get('/restart', [SalesController::class, 'restart']);
        Route::get('/song-secrets-bonus', [SalesController::class, 'promoSS']);
        Route::get('/ultimate-technique', [SalesController::class, 'promoUT']);
        Route::get('/anniversary', [SalesController::class, 'promoEG']);
        Route::get('/lp', [SalesController::class, 'promoEG']);
        Route::get('/trial/more-time', [SalesController::class, 'promoMT']);
        Route::get('/trial/one-dollar', [SalesController::class, 'promoOD']);
        Route::get('/welcome-offer', [SalesController::class, 'promoWO']);
        Route::get('/welcome-back-discount', [SalesController::class, 'welcomeBackDiscount']);
        Route::get('/student-only', [SalesController::class, 'promo']);
        Route::get('/choose-plan', [SalesController::class, 'choosePlan']);
        Route::get('/choose-your-trial', [SalesController::class, 'choosePlan']);
        Route::get('/choose-your-trial-month', [SalesController::class, 'choosePlanMonth']);
        Route::get('/affiliate-trial', [SalesController::class, 'choosePlanMonth']);
        Route::get('/a/davidbennett', [SalesController::class, 'davidbennett']);
        Route::group(
            ['prefix' => 'affiliate' ],
            function () {
                Route::get('/{page?}', SalesController::class . '@affiliates')
                    ->whereIn('page', [
                        'asobergirlsguide',
                        'ben-dunnill',
                        'gamazda',
                        'jemma-heigis',
                        'keyboardkraze',
                        'musician-wave',
                        'musicradar',
                        'noah-wonder',
                        'pianodreamers'
                    ]);
            }
        );
        Route::group(
            ['prefix' => 'a' ],
            function () {
                Route::get('/{page?}', SalesController::class . '@affiliates')
                    ->whereIn('page', [
                        'leviclay'
                    ]);
            }
        );

        Route::get('/about', [SalesController::class, 'about']);
        Route::get('/app', [SalesController::class, 'app']);
        Route::get('/coaches', [SalesController::class, 'coaches']);
        Route::get('/cookie', [SalesController::class, 'cookie']);
        Route::get('/lifetime', [SalesController::class, 'lifetime']);
        //        Route::get('/lifetime-discounted', [SalesController::class, 'lifetimeDiscount'] );
        Route::get('/lisa-recommends', [SalesController::class, 'lisarecommends']);
        Route::get('/method', [SalesController::class, 'method']);
        Route::get('/privacy', [SalesController::class, 'privacy']);
        Route::get('/roland', [SalesController::class, 'roland']);
        Route::get('/songs', [SalesController::class, 'songs']);
        Route::get('/terms', [SalesController::class, 'terms']);
        Route::get('/welcome-party', [SalesController::class, 'welcomeparty']);

        Route::post('/claim-roland-90-day-access', [SalesController::class, 'claimRoland90DaysAccess'])
            ->withoutMiddleware([\App\Http\Middleware\VerifyCsrfToken::class]);

        Route::get('/easy-chords-trial', [SalesController::class, 'easyChordsTrial']);
    });
