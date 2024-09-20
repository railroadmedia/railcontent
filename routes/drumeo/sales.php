<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Drumeo\SalesController;

Route::domain('{drumeoDomain}')
    ->middleware(['web_public'])
    ->group(function () {
        Route::get('/referral-join', \App\Http\Controllers\Musora\ReferralJoinController::class . '@join')->name('referral.invite-a-friend-landing');
        Route::get('/', [SalesController::class, 'homeBF']);
        Route::get('/ultimate-bundle', [SalesController::class, 'homeBF']);
        Route::get('/lp', [SalesController::class, 'promoEG']);
        Route::get('/beginner', [SalesController::class, 'promo']);
        Route::get('/student-only', [SalesController::class, 'promo']);
        Route::get('/choose-plan', [SalesController::class, 'choosePlan']);
        Route::get('/upgrade-offer', [SalesController::class, 'salesUpgrade']);
        Route::get('/lifetime', [SalesController::class, 'salesLifetime']);
        //    Route::get('/lifetime-discounted', [SalesController::class, 'lifetimeDiscount'] );
        Route::get('/anniversary', [SalesController::class, 'promoEG']);
        Route::get('/vdf', [SalesController::class, 'choosePlanVDF']);
        Route::get('/restart', [SalesController::class, 'restart']);

        //    sales pages
        Route::get('/method', [SalesController::class, 'method']);
        Route::get('/songs', [SalesController::class, 'songs']);
        Route::get('/coaches', [SalesController::class, 'coaches']);
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

        Route::get('/alesis', [SalesController::class, 'alesisNitro']);
        Route::get('/alesis/existing', [SalesController::class, 'alesisNitroExisting']);
        Route::get('/alesis-strata', [SalesController::class, 'alesisStrata']);
        Route::get('/alesis-strata/existing', [SalesController::class, 'alesisStrataExisting']);
        Route::get('/alesis-crimson-iii', [SalesController::class, 'alesisCrimson']);
        Route::get('/alesis-crimson-iii/existing', [SalesController::class, 'alesisCrimsonExisting']);
        Route::get('/alesis-strata-core', [SalesController::class, 'alesisStrataCore']);
        Route::get('/alesis-strata-core/existing', [SalesController::class, 'alesisStrataCoreExisting']);
        Route::get('/alesis-nitro-pro', [SalesController::class, 'alesisNitroPro']);
        Route::get('/alesis-nitro-pro/existing', [SalesController::class, 'alesisNitroProExisting']);

        Route::get('/june', [SalesController::class, 'trial']);
        Route::get('/trial-key', [SalesController::class, 'trialKey']);
        Route::get('/practice-anywhere', [SalesController::class, 'practiceAnywhere']);
        Route::get('/back-to-school', [SalesController::class, 'backToSchool']);
        Route::get('/guitarcenter', [SalesController::class, 'guitarcenter']);
        Route::get('/GuitarCenter', [SalesController::class, 'guitarcenter']);
        Route::get('/welcome-back-discount', [SalesController::class, 'welcomeBackDiscount']);
        Route::get('/trial', [SalesController::class, 'trial']);
        Route::get('/trial2', [SalesController::class, 'trial']);
        Route::get('/trial-beginner', [SalesController::class, 'trialBeginner']);
        Route::get('/30-day-trial', [SalesController::class, 'homeMonth']);
        Route::get('/choose-your-trial', [SalesController::class, 'choosePlan']);
        Route::get('/choose-your-trial-month', [SalesController::class, 'choosePlanMonth']);
        Route::get('/easy-rudiments-playlist', [SalesController::class, 'easyRudimentsPlaylist']);
        Route::get('/vote', [SalesController::class, 'vote']);

        Route::get('/{pageT?}', SalesController::class . '@trialPages')
            ->whereIn('pageT', [
                'bestbook-trial',
                'coaches-quiz',
                'earthworks',
                'melodics',
                'new-drummers-trial',
                'power-pack',
                'toolbox-trial'
            ]);

        Route::get('/{pageC?}', SalesController::class . '@coachTrial')
            ->whereIn('pageC', [
                'aric',
                'domino',
                'dorothea',
                'jared',
                'john',
                'kaz',
                'larnell',
                'matt',
                'sarah',
                'schack',
                'sharon',
                'todd'
            ]);


        Route::get('/estepario', [SalesController::class, 'estepario']);
        Route::prefix('a')->group(
            function () {
                Route::get('/{page?}', SalesController::class . '@a')
                    ->whereIn('page', [
                        '66samus',
                        'adriendrums',
                        'alejandrosifuentes',
                        'brandonscott',
                        'cooperdrummer',
                        'davidcola',
                        'drumhelper',
                        'joshcrawford',
                        'kristina-rybalchenko',
                        'leviclay',
                        'linaanderberg',
                        'rdavidr',
                        'robbrown',
                        'rocker-girl',
                        'the8bitdrummer',
                        'wojtek',
                        'worshipdrummer',
                        'wyattstav',
                        'zackgrooves'
                    ]);
            }
        );
        Route::prefix('ambassador')->group(
            function () {
                Route::get('/{page?}', SalesController::class . '@ambassador')
                    ->whereIn('page', [
                        'cobus'
                    ]);
            }
        );
        Route::prefix('affiliate')->group(
            function () {
                Route::get('/{page?}', SalesController::class . '@affiliates')
                    ->whereIn('page', [
                        '66samus',
                        'adriendrums',
                        'alejandrosifuentes',
                        'andrewrooney',
                        'asobergirlsguide',
                        'bhcollective',
                        'brandonscott',
                        'bryanforcedrums',
                        'cooperdrummer',
                        'davidcola',
                        'drumhelper',
                        'drummingreview',
                        'drumninja',
                        'electronicdrumadvisor',
                        'jessica-burdeaux',
                        'joshcrawford',
                        'kylemcgrail',
                        'leviclay',
                        'leyandrums',
                        'linaanderberg',
                        'lindseyward',
                        'musicindustryhowto',
                        'rdavidr',
                        'rickyficarelli',
                        'robbrown',
                        'the8bitdrummer',
                        'tobines',
                        'worshipdrummer',
                        'wyattstav',
                        'zackgrooves'
                    ]);
            }
        );

        Route::get('/pro/', [SalesController::class, 'pro']);
        Route::get('/jared-recommends', [SalesController::class, 'jaredRecommends']);
    });
