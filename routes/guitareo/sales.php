<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Guitareo\SalesController;

Route::domain('{guitareoDomain}')
    ->middleware(['web_public'])
    ->group(function () {
        Route::get('/', [SalesController::class, 'home']);
        Route::get('/trial', [SalesController::class, 'trial']);
        Route::get('/trial-month', [SalesController::class, 'homeMonth']);
        Route::get('/lp', [SalesController::class, 'promo']);
        Route::get('/student-only', [SalesController::class, 'promo']);
        Route::get('/choose-plan', [SalesController::class, 'choosePlan']);
        Route::get('/choose-your-trial', [SalesController::class, 'choosePlan']);

        Route::get('/choose-your-trial-month', [SalesController::class, 'choosePlanMonth']);
        Route::get('/affiliate-trial', [SalesController::class, 'choosePlanMonth']);
        Route::get('/affiliate/asobergirlsguide', [SalesController::class, 'asobergirlsguide']);

        Route::get('/cookie', [SalesController::class, 'cookie']);
        Route::get('/terms', [SalesController::class, 'terms']);
        Route::get('/privacy', [SalesController::class, 'privacy']);

        Route::get('/songs', [SalesController::class, 'songs']);
        Route::get('/coaches', [SalesController::class, 'coaches']);
        Route::get('/method', [SalesController::class, 'method']);

        Route::get('/lifetime', [SalesController::class, 'salesLifetime']);
        Route::get('/lifetime-discounted', [SalesController::class, 'lifetimeDiscount']);
        Route::get('/survival-kit-instructions', [SalesController::class, 'survivalkitinstructions']);

        Route::get('/welcome', [SalesController::class, 'welcome']);
        Route::get('/welcome/2', [SalesController::class, 'welcome2']);
        Route::get('/welcome/3', [SalesController::class, 'welcome3']);
        Route::get('/ayla-recommends', [SalesController::class, 'aylarecommends']);

        Route::get('/shop/500-songs', [SalesController::class, 'songs500']);
        Route::get('/shop/acoustic-guitar-made-easy', [SalesController::class, 'acousticGuitarMadeEasy']);
        Route::get('/shop/guitar-quest', [SalesController::class, 'guitarQuest']);
        Route::get('/shop/guitar-quest-discount', [SalesController::class, 'guitarQuestDiscount']);
        Route::get('/shop/guitar-quest-discount-tricks', [SalesController::class, 'guitarQuestDiscountTricks']);
        Route::get('/shop/guitar-quest-testimonials', [SalesController::class, 'guitarQuestTestimonials']);
        Route::get('/shop/guitar-system', [SalesController::class, 'gs']);
        Route::get('/shop/guitar-technique-made-easy', [SalesController::class, 'guitarTechniqueMadeEasy']);
        Route::get('/shop/rhythm-and-groove', [SalesController::class, 'rhythmAndGroove']);
        Route::get('/{page?}', SalesController::class . '@products')
            ->whereIn('page', [
                'guitar-technique-made-easy-beginner', '500-songs-discount'
            ]);
    });
