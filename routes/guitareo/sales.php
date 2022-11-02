<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Guitareo\SalesController;

Route::domain('{guitareoDomain}')
    ->middleware(['web_public'])
    ->group(function () {
    Route::get('/', [SalesController::class, 'home']);
    Route::get('/survival-kit-instructions', [SalesController::class, 'membership']);
    Route::get('/student-only', [SalesController::class, 'membershipStudents']);
    Route::get('/trial', [SalesController::class, 'trial']);
    Route::get('/trial-month', [SalesController::class, 'trial30']);
    Route::get('/choose-your-trial', function () { return view('guitareo.sales.trials.trial-selection.week'); });
    Route::get('/choose-your-trial-month', function () { return view('guitareo.sales.trials.trial-selection.month'); });

    Route::get('/support', function () { return view('guitareo.sales.pages.support'); });
    Route::get('/cookie', function () { return view('guitareo.sales.pages.cookie'); });
    Route::get('/terms', function () { return view('guitareo.sales.pages.terms'); });
    Route::get('/privacy', function () { return view('guitareo.sales.pages.privacy'); });


    Route::get('/daddario-string-session', function () { return view('guitareo.sales.trials.daddario-string-session'); });
    Route::get('/daddario-string-session-ga ', function () { return view('guitareo.sales.trials.daddario-string-session'); });

    Route::get('/affiliate/asobergirlsguide', function () { return view('guitareo.sales.trials.affiliates.asobergirlsguide'); });
    Route::get('/affiliate-trial', function () { return view('guitareo.sales.trials.trial-selection.affiliates'); });

    Route::get('/welcome', function () { return view('guitareo.sales.pages.welcome-1'); });
    Route::get('/welcome/2', function () { return view('guitareo.sales.pages.welcome-2'); });
    Route::get('/welcome/3', function () { return view('guitareo.sales.pages.welcome-3'); });
    Route::get('/ayla-recommends', function () { return view('guitareo.shop.ayla-recommends'); });

    Route::get('/shop/500-songs', [SalesController::class, 'songs500']);
    Route::get('/500-songs-discount', [SalesController::class, 'songs500Discount']);
    Route::get('/shop/acoustic-guitar-made-easy', [SalesController::class, 'acousticGuitarMadeEasy']);
    Route::get('/shop/guitar-quest', [SalesController::class, 'guitarQuest']);
    Route::get('/guitar-quest-discount', [SalesController::class, 'guitarQuestDiscount']);
    Route::get('/guitar-quest-discount-tricks', [SalesController::class, 'guitarQuestDiscountTricks']);
    Route::get('/guitar-quest/testimonials', [SalesController::class, 'guitarQuestTestimonials']);
    Route::get('/shop/guitar-system', [SalesController::class, 'gs']);
    Route::get('/shop/guitar-technique-made-easy', [SalesController::class, 'guitarTechniqueMadeEasy']);
    Route::get('/guitar-technique-made-easy-beginner', [SalesController::class, 'guitarTechniqueMadeEasyBeginner']);
    Route::get('/guitar-technique-made-easy-discount', [SalesController::class, 'guitarTechniqueMadeEasyDiscount']);
    Route::get('/guitar-technique-made-easy-gs', [SalesController::class, 'guitarTechniqueMadeEasyGSDiscount']);
    Route::get('/guitar-technique-made-easy-pack', [SalesController::class, 'guitarTechniqueMadeEasyPack']);
    Route::get('/shop/rhythm-and-groove', [SalesController::class, 'rhythmAndGroove']);
});
