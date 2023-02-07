<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Drumeo\SalesController;

Route::domain('{drumeoDomain}')
    ->middleware(['web_public'])
    ->group(function () {
    Route::get('/referral-join', [
        'as' => 'referral.invite-a-friend-landing',
        'uses' => \App\Http\Controllers\Musora\ReferralJoinController::class . '@join',
    ]);
    Route::get('/', [SalesController::class, 'home'] );
    Route::get('/new-year', [SalesController::class, 'promo'] );
    Route::get('/lp', [SalesController::class, 'promo'] );
        Route::get('/beginner', [SalesController::class, 'promo']);
    Route::get('/choose-plan', [SalesController::class, 'choosePlan'] );
    Route::get('/student-only', [SalesController::class, 'promo'] );
    Route::get('/upgrade-offer', [SalesController::class, 'salesUpgrade'] );
    Route::get('/lifetime', [SalesController::class, 'salesUpgradeLifetime'] );
    Route::get('/festival/', [SalesController::class, 'Festival'] );

    //    sales pages
    Route::get('/method', [SalesController::class, 'method'] );
    Route::get('/songs', [SalesController::class, 'songs'] );
    Route::get('/coaches', [SalesController::class, 'coaches'] );
    Route::get('/impact', [SalesController::class, 'impact']);
    Route::get('/about', [SalesController::class, 'about']);
    Route::get('/privacy', [SalesController::class, 'privacy']);
    Route::get('/terms', [SalesController::class, 'terms']);
    Route::get('/cookie', [SalesController::class, 'cookie']);
    Route::get('/app', [SalesController::class, 'app']);
    Route::get('/kids', [SalesController::class, 'kids']);
    Route::get('/song-demo/', [SalesController::class, 'songDemo']);
    Route::get('/tom-sawyer/', [SalesController::class, 'tomSawyer']);
    Route::get('/drumfest', [SalesController::class, 'drumFest']);
    Route::get('/awards/', [SalesController::class, 'awards']);
    Route::get('/sonor/', [SalesController::class, 'sonor']);

    Route::get('/trial', [SalesController::class, 'home']);
    Route::get('/30-day-trial', [SalesController::class, 'homeMonth']);
    Route::get('/choose-your-trial', [SalesController::class, 'choosePlan']);
    Route::get('/choose-your-trial-month', [SalesController::class, 'choosePlanMonth']);

    Route::get('/30-day-drummer', [SalesController::class, 'thirtyDayDrummer']);

    Route::get('/{pageT?}', SalesController::class . '@trialPages')
        ->whereIn('pageT', [
            'bestbook-trial', 'coaches-quiz', 'earthworks', 'melodics', 'new-drummers-trial', 'power-pack', 'toolbox-trial'
        ]);

    Route::get('/{pageC?}', SalesController::class . '@coachTrial')
        ->whereIn('pageC', [
            'aric', 'domino', 'dorothea', 'jared', 'john', 'kaz', 'larnell', 'matt', 'sarah', 'schack', 'sharon', 'todd'
        ]);


    Route::get('/estepario', [SalesController::class, 'estepario']);
    Route::group(['prefix' => 'a' ],
        function () {
            Route::get('/{page?}', SalesController::class . '@a')
                ->whereIn('page', [
                    '66samus', 'adriendrums', 'kristina-rybalchenko', 'alejandrosifuentes', 'brandonscott', 'cooperdrummer', 'davidcola', 'drumhelper', 'joshcrawford', 'leviclay', 'linaanderberg', 'rdavidr', 'robbrown', 'the8bitdrummer', 'worshipdrummer', 'wyattstav', 'zackgrooves'
                ]);
        }
    );
    Route::group(['prefix' => 'affiliate' ],
        function () {
            Route::get('/{page?}', SalesController::class . '@affiliates')
                ->whereIn('page', [
                    'andrewrooney', 'asobergirlsguide', 'bhcollective', 'bryanforcedrums', 'drummingreview', 'drumninja', 'electronicdrumadvisor', 'jessica-burdeaux', 'kylemcgrail', 'leyandrums', 'lindseyward', 'musicindustryhowto', 'rickyficarelli', 'tobines', '66samus', 'adriendrums', 'alejandrosifuentes', 'brandonscott', 'cooperdrummer', 'davidcola', 'drumhelper', 'joshcrawford', 'leviclay', 'linaanderberg', 'rdavidr', 'robbrown', 'the8bitdrummer', 'worshipdrummer', 'wyattstav', 'zackgrooves'
                ]);
        }
    );


    Route::get('/30-day-drummer-register-endpoint', [SalesController::class, 'registerFor30DayDrummer'] );
    Route::get('/pro/', [SalesController::class, 'pro']);
    Route::get('/jared-recommends', [SalesController::class, 'jaredRecommends']);
});
