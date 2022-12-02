<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Pianote\SalesController;

Route::domain('{pianoteDomain}')
    ->middleware(['web_public'])
    ->group(function () {
    Route::get('/', [SalesController::class, 'home']);

    Route::get('/about', function () { return view('pianote.sales.pages.about'); });
    Route::get('/app', function () { return view('pianote.sales.pages.app'); } );
    Route::get('/support', function () { return view('pianote.sales.pages.support'); } );
    Route::get('/cookie', function () { return view('pianote.sales.pages.cookie'); } );
    Route::get('/terms', function () { return view('pianote.sales.pages.terms'); } );
    Route::get('/privacy', function () {return view('pianote.sales.pages.privacy'); } );

    Route::get('/shop/improvisation-with-jesus-molina', [SalesController::class, 'jesusMolina'] );
    Route::get('/student-only', [SalesController::class, 'studentOnly'] );
    Route::get('/2', [SalesController::class, 'home'] );
    Route::get('/roland', [SalesController::class, 'roland'] );

    Route::get('/trial', [SalesController::class, 'trial'] );
    Route::get('/trial-month', [SalesController::class, 'trialMonth'] );
    Route::get('/choose-your-trial', function () { return view('pianote.sales.trials.trial-selection.week'); });
    Route::get('/choose-your-trial-month', function () { return view('pianote.sales.trials.trial-selection.month'); });

    Route::get('/a/davidbennett', function () { return view('pianote.sales.trials.affiliates.davidbennett'); });
    Route::get('/affiliate/asobergirlsguide', function () { return view('pianote.sales.trials.affiliates.asobergirlsguide'); });
    Route::get('/affiliate/keyboardkraze', function () { return view('pianote.sales.trials.affiliates.keyboardkraze'); });
    Route::get('/affiliate/leviclay', function () { return view('pianote.sales.trials.affiliates.leviclay'); });
    Route::get('/affiliate/pianodreamers', function () { return view('pianote.sales.trials.affiliates.pianodreamers'); });
    Route::get('/affiliate-trial', function () { return view('pianote.sales.trials.trial-selection.affiliates'); });

    Route::get('/shop/500-songs', [SalesController::class, 'songs500'] );
    Route::get('/the-power-of-chords', [SalesController::class, 'PowerOfChords'] );
    Route::get('/shop/the-power-of-chords', [SalesController::class, 'PowerOfChords'] );
    Route::get('/the-power-of-chords-bootcamp', [SalesController::class, 'PowerOfChordsBootcamp'] );
    Route::get('/the-power-of-chords-giveaway', [SalesController::class, 'PowerOfChordsGiveaway'] );

    Route::get('/giveaway', function () { return view('pianote.lead-gen.giveaway'); });

    Route::get('/500-songs-fb', function () { return view('pianote.products.500-songs-fb'); } );
    Route::get('/500-songs-discount', function () { return view('pianote.products.500-songs-discount'); } );
    Route::get('/500-songs-carols-discount', function () { return view('pianote.products.500-songs-carols-discount'); } );
    Route::get('/500-songs-chord-discount', function () { return view('pianote.products.500-songs-chord-discount'); } );
    Route::get('/500-songs-elton-john', function () { return view('pianote.products.500-songs-elton-john'); } );
    Route::get('/500-songs-alicia-keys', function () { return view('pianote.products.500-songs-alicia-keys'); } );
    Route::get('/500-songs-sam-smith', function () { return view('pianote.products.500-songs-sam-smith'); } );
    Route::get('/500-songs-taylor-swift', function () { return view('pianote.products.500-songs-taylor-swift'); } );
    Route::get('/500-songs-the-beatles', function () { return view('pianote.products.500-songs-the-beatles'); } );
    Route::get('/500-songs-free-lesson', function () { return view('pianote.lead-gen.500-songs-free-lesson'); } );
    Route::get('/shop/faster-fingers', function () { return view('pianote.products.faster-fingers'); } );
    Route::get('/shop/worship-piano', function () { return view('pianote.products.worship-piano'); } );
    Route::get('/shop/piano-technique-made-easy', function () { return view('pianote.products.piano-technique-made-easy'); } );
    Route::get('/shop/destupefy-your-left-hand', function () { return view('pianote.products.destupefy-your-left-hand'); } );
    Route::get('/shop/play-beautiful-piano', function () { return view('pianote.products.play-beautiful-piano'); } );
    Route::get('/beginner-classical-piano', function () { return view('pianote.products.beginner-classical-piano'); } );

    Route::get('/lifetime', function () { return view('pianote.shop.pages.lifetime', ['theme' => 'pianote']); } );
    Route::get('/keep-learning', function () { return view('pianote.shop.pages.keep-learning', ['theme' => 'pianote']); } );
    Route::get('/upgrade-offer', function () { return view('pianote.shop.pages.upgrade-offer', ['theme' => 'pianote']); } );

    Route::get('/lisa-recommends', function () { return view('pianote.shop.lisa-recommends'); } );

    // lead-gen ARTICLES AND VIDEOS
    Route::get('/welcome-party', function () { return view('pianote.lead-gen.welcome-party'); } );
});
