<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Pianote\ShopController;
use App\Http\Controllers\Pianote\SalesController;
use App\Http\Controllers\Pianote\LeadGenController;

Route::domain('{pianoteDomain}')
    ->middleware(['web_public'])
    ->group(function () {
        Route::group(['prefix' => 'shop' ],
            function () {
                Route::get('/500-songs', [SalesController::class, 'songs500'] );
                Route::get('/beginner-classical-piano', [SalesController::class, 'beginnerclassicalpiano'] );
                Route::get('/classical-piano-pieces', [SalesController::class, 'classicalPianoPieces'] );
                Route::get('/christmas-songbook', [SalesController::class, 'christmasSongbook'] );
                Route::get('/concert-headphones', [SalesController::class, 'concertHeadphones']);
                Route::get('/destupefy-your-left-hand', [SalesController::class, 'destupefyyourlefthand'] );
                Route::get('/easy-chords', [SalesController::class, 'easyChords'] );
                Route::get('/30-day-blues-piano', [SalesController::class, 'thirtyDayBluesPiano'] );
                Route::get('/30-day-blues-piano/deal', [SalesController::class, 'thirtyDayBluesPianoDeal'] );
                Route::get('/faster-fingers', [SalesController::class, 'fasterfingers'] );
                Route::get('/improvisation-with-jesus-molina', [SalesController::class, 'jesusMolina'] );
                Route::get('/new-piano-players', [SalesController::class, 'newPianoPlayers'] );
                Route::get('/piano-technique-made-easy', [SalesController::class, 'pianotechniquemadeeasy'] );
                Route::get('/play-beautiful-piano', [SalesController::class, 'playbeautifulpiano'] );
                Route::get('/riffs-and-fills', [LeadGenController::class, 'riffsAndFills']);
                Route::get('/the-power-of-chords', [SalesController::class, 'PowerOfChords'] );
                Route::get('/the-power-of-chords-giveaway', [SalesController::class, 'PowerOfChordsGiveaway'] );
                Route::get('/worship-piano', [SalesController::class, 'worshippiano'] );
                Route::get('/beautiful-beginner-bundle', [SalesController::class, 'beautifulBeginnerBundle'] );
                Route::get('/metronome', [SalesController::class, 'metronome'] );
                Route::get('/prestige-metronome', [SalesController::class, 'metronomePrestige'] );
            }
        );

        Route::get('/{page?}', SalesController::class . '@products')
            ->whereIn('page', [
                '500-songs-fb', '500-songs-discount', '500-songs-carols-discount', '500-songs-chord-discount', '500-songs-elton-john', '500-songs-alicia-keys', '500-songs-sam-smith', '500-songs-taylor-swift', '500-songs-the-beatles', '500-songs-free-lesson'
            ]);

        Route::get('/{category}', [ShopController::class, 'shop'])
            ->whereIn('category', ['shop', 'lessons', 'accessories', 'clothing']);;

        Route::get('/shop/{productslug}', [ShopController::class, 'product']);
});
