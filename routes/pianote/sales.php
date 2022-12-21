<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Pianote\SalesController;

Route::domain('{pianoteDomain}')
    ->middleware(['web_public'])
    ->group(function () {
    Route::get('/', [SalesController::class, 'home']);
    Route::get('/shop/improvisation-with-jesus-molina', [SalesController::class, 'jesusMolina'] );
    Route::get('/student-only', [SalesController::class, 'studentOnly'] );
    Route::get('/2', [SalesController::class, 'home'] );
    Route::get('/roland', [SalesController::class, 'roland'] );
    Route::get('/trial', [SalesController::class, 'trial'] );
    Route::get('/trial-month', [SalesController::class, 'trialMonth'] );
    Route::get('/shop/500-songs', [SalesController::class, 'songs500'] );
    Route::get('/the-power-of-chords', [SalesController::class, 'PowerOfChords'] );
    Route::get('/shop/the-power-of-chords', [SalesController::class, 'PowerOfChords'] );
    Route::get('/the-power-of-chords-bootcamp', [SalesController::class, 'PowerOfChordsBootcamp'] );
    Route::get('/the-power-of-chords-giveaway', [SalesController::class, 'PowerOfChordsGiveaway'] );
    Route::get('/foundations', [SalesController::class, 'foundations'] );

    Route::get('/about', [SalesController::class, 'about'] );
    Route::get('/app', [SalesController::class, 'app'] );
    Route::get('/cookie', [SalesController::class, 'cookie'] );
    Route::get('/terms', [SalesController::class, 'terms'] );
    Route::get('/privacy', [SalesController::class, 'privacy'] );
    Route::get('/choose-your-trial', [SalesController::class, 'chooseyourtrial'] );
    Route::get('/choose-your-trial-month', [SalesController::class, 'chooseyourtrialmonth'] );
    Route::get('/a/davidbennett', [SalesController::class, 'davidbennett'] );
    Route::group(['prefix' => 'affiliate' ],
        function () {
            Route::get('/{page?}', SalesController::class . '@affiliates')
                ->whereIn('page', [
                    'asobergirlsguide', 'keyboardkraze', 'leviclay', 'pianodreamers'
                ]);
        }
    );
    Route::get('/affiliate-trial', [SalesController::class, 'affiliatetrial'] );
    Route::get('/giveaway', [SalesController::class, 'giveaway'] );
    Route::get('/{page?}', SalesController::class . '@products')
        ->whereIn('page', [
            '500-songs-fb', '500-songs-discount', '500-songs-carols-discount', '500-songs-chord-discount', '500-songs-elton-john', '500-songs-alicia-keys', '500-songs-sam-smith', '500-songs-taylor-swift', '500-songs-the-beatles', '500-songs-free-lesson'
        ]);
    Route::get('/shop/faster-fingers', [SalesController::class, 'fasterfingers'] );
    Route::get('/shop/worship-piano', [SalesController::class, 'worshippiano'] );
    Route::get('/shop/piano-technique-made-easy', [SalesController::class, 'pianotechniquemadeeasy'] );
    Route::get('/shop/destupefy-your-left-hand', [SalesController::class, 'destupefyyourlefthand'] );
    Route::get('/shop/play-beautiful-piano', [SalesController::class, 'playbeautifulpiano'] );
    Route::get('/shop/beginner-classical-piano', [SalesController::class, 'beginnerclassicalpiano'] );
    Route::get('/lifetime', [SalesController::class, 'lifetime'] );
    Route::get('/keep-learning', [SalesController::class, 'keeplearning'] );
    Route::get('/upgrade-offer', [SalesController::class, 'upgradeoffer'] );
    Route::get('/lisa-recommends', [SalesController::class, 'lisarecommends'] );
    Route::get('/welcome-party', [SalesController::class, 'welcomeparty'] );
});
