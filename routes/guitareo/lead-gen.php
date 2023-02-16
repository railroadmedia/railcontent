<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Http\Controllers\Guitareo\LeadGenController;

Route::domain('{guitareoDomain}')
    ->middleware(['web_public'])
    ->group(function () {

    Route::get('/thank-you-white', [LeadGenController::class, 'thankyouwhite']);
    Route::get('/welcome-party', [LeadGenController::class, 'welcomeparty']);
    Route::get('/welcome-party-carlos', [LeadGenController::class, 'welcomepartycarlos']);
    Route::get('/confirming', [LeadGenController::class, 'confirming']);
    Route::get('/subscribed', [LeadGenController::class, 'subscribed']);
    Route::get('/weekly-email', [LeadGenController::class, 'weeklyemail']);
    Route::get('/weeklyemail', [LeadGenController::class, 'weeklyemail2']);
    Route::get('/recitals', [LeadGenController::class, 'recitals']);
    Route::get('/fretboard-cheatsheet', [LeadGenController::class, 'fretboardcheatsheet']);

    Route::group(['prefix' => 'back-to-basics'],
        function () {
            Route::get('/{page?}', LeadGenController::class . '@backToBasics')
                ->whereIn('page', [
                    null, 'zoom'
                ]);
        }
    );
    Route::group(['prefix' => 'clean-up-chords'],
        function () {
            Route::get('/{page?}', LeadGenController::class . '@cleanUpChords')
                ->whereIn('page', [
                    null, 'zoom'
                ]);
        }
    );
    Route::group(['prefix' => 'song-in-an-hour'],
        function () {
            Route::get('/{page?}', LeadGenController::class . '@songInAnHour')
                ->whereIn('page', [
                    null, 'thank-you', 'success', ' writing-a-melody', 'next-steps'
                ]);
            Route::get('/{page?}/{lesson?}', LeadGenController::class . '@songInAnHour')
                ->whereIn('page', [
                    'your-challenge'
                ])
                ->whereIn('lesson', [
                    '1', '2', '3', '4', '5', '6', '7'
                ]);
        }
    );
    Route::group(['prefix' => 'free-acoustic-guitar-lessons'],
        function () {
            Route::get('/{page?}/{lesson?}', LeadGenController::class . '@fagl')
                ->whereIn('page', [
                    null, 'lessons'
                ])
                ->whereIn('lesson', [
                    null, '1', '2', '3', '4', '5', '6'
                ]);
        }
    );
    Route::group(['prefix' => 'free-electric-guitar-lessons'],
        function () {
            Route::get('/{page?}/{lesson?}', LeadGenController::class . '@fegl')
                ->whereIn('page', [
                    null, 'lessons'
                ])
                ->whereIn('lesson', [
                    null, '1', '2', '3', '4', '5', '6'
                ]);
        }
    );
    Route::group(['prefix' => 'chords-for-hit-songs'],
        function () {
            Route::get('/{page?}/{lesson?}', LeadGenController::class . '@hitSongs')
                ->whereIn('page', [
                    null, 'thank-you', 'lessons'
                ])
                ->whereIn('lesson', [
                    null, '1', '2', '3', '4', '5', '6'
                ]);
        }
    );
    Route::group(['prefix' => 'guitar-tricks'],
        function () {
            Route::get('/{page?}/{lesson?}', LeadGenController::class . '@tricks')
                ->whereIn('page', [
                    null, 'your-videos'
                ])
                ->whereIn('lesson', [
                    null, '1-intro', '2-vibrato', '3-shampoo', '4-palm-muting', '5-truck', '6-whats-next'
                ]);
        }
    );
    Route::group(['prefix' => 'solo-in-an-hour'],
        function () {
            Route::get('/{page?}/{lesson?}', LeadGenController::class . '@soloInAnHour')
                ->whereIn('page', [
                    null, 'lessons'
                ])
                ->whereIn('lesson', [
                    null, '1', '2', '3', '4', '5', '6', '7'
                ]);
        }
    );
    Route::group(['prefix' => 'acoustic-guitar-jumpstart'],
        function () {
            Route::get('/{page?}/{lesson?}', LeadGenController::class . '@jumpstart')
                ->whereIn('page', [
                    null, 'course-index'
                ])
                ->whereIn('lesson', [
                    null, '1', '2', '3', '4', '5', '6', '7', '8'
                ]);
        }
    );
    Route::group(['prefix' => 'starter-kit'],
        function () {
            Route::get('/{page?}/{lesson?}', LeadGenController::class . '@starterKit')
                ->whereIn('page', [null, 'lessons'])
                ->whereIn('lesson', [null, 'using-a-tuner', 'whats-next']);
            Route::get('/lessons/open-chords/{num?}', LeadGenController::class . '@openChords')
                ->whereIn('num', ['1', '2', '3', '4', '5', '6']);
            Route::get('/lessons/fundamentals/{num?}', LeadGenController::class . '@fundamentals')
                ->whereIn('num', [
                    null, '1', '2', '3', '4', '5', '6', '7'
                ]);
            Route::get('/lessons/heartbreak-avenue/{num?}', LeadGenController::class . '@heartbreak')
                ->whereIn('num', [
                    null, '1', '2', '3', '4', '5', '6', '7'
                ]);
            Route::get('/lessons/strumming/{num?}', LeadGenController::class . '@strumming')
                ->whereIn('num', [
                    null, '1', '2', '3', '4', '5', '6', '7'
                ]);
        }
    );

    Route::group(['prefix' => 'toolbox'],
        function () {
            Route::get('/{page?}', LeadGenController::class . '@toolbox')
                ->whereIn('page', [null, 'lessons']);
            Route::get('/lessons/changing-chords-smoothly/{num?}', LeadGenController::class . '@changingChords')
                ->whereIn('num', ['1', '2', '3', '4', '5', '6', '7']);
            Route::get('/lessons/exploring-guitar-rhythms/{num?}', LeadGenController::class . '@exploreRhythms')
                ->whereIn('num', [
                    null, '1', '2', '3', '4', '5', '6', '7'
                ]);
            Route::get('/lessons/how-to-tune-a-guitar/{num?}', LeadGenController::class . '@tuneGuitar')
                ->whereIn('num', [
                    null, '1', '2', '3', '4', '5', '6', '7'
                ]);
            Route::get('/lessons/legato-hammer-ons-pull-offs/{num?}', LeadGenController::class . '@legato')
                ->whereIn('num', [
                    null, '1', '2', '3', '4', '5', '6', '7', '8'
                ]);
            Route::get('/lessons/making-chords-sound-clean/{num?}', LeadGenController::class . '@cleanChords')
                ->whereIn('num', [
                    null, '1', '2', '3', '4', '5'
                ]);
            Route::get('/lessons/playing-your-first-guitar-solo/{num?}', LeadGenController::class . '@firstSolo')
                ->whereIn('num', [
                    null, '1', '2', '3', '4', '5', '6', '7', '8'
                ]);
            Route::get('/lessons/playing-your-first-song/{num?}', LeadGenController::class . '@firstSong')
                ->whereIn('num', [
                    null, '1', '2', '3', '4', '5', '6', '7', '8', '9'
                ]);
            Route::get('/lessons/sight-reading-essentials/{num?}', LeadGenController::class . '@sightReading')
                ->whereIn('num', [
                    null, '1', '2', '3', '4', '5', '6'
                ]);
            Route::get('/lessons/soloing-with-minor-pentatonic-scales/{num?}', LeadGenController::class . '@soloingPentatonic')
                ->whereIn('num', [
                    null, '1', '2', '3', '4', '5', '6', '7', '8'
                ]);
        }
    );
});
