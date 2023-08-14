<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Http\Controllers\Guitareo\LeadGenController;

Route::domain('{guitareoDomain}')
    ->middleware(['web_public'])
    ->group(function () {

    Route::get('/thank-you', [LeadGenController::class, 'thankyou']);
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
    Route::get('/free-acoustic-guitar-lessons', [LeadGenController::class, 'fagl']);
    Route::get('/free-electric-guitar-lessons', [LeadGenController::class, 'fegl']);
    Route::group(['prefix' => 'chords-for-hit-songs'],
        function () {
            Route::get('/{page?}/', LeadGenController::class . '@hitSongs')
                ->whereIn('page', [
                    null, 'thank-you',
                ]);
        }
    );
    Route::get('/guitar-tricks', [LeadGenController::class, 'tricks']);
    Route::get('/solo-in-an-hour', [LeadGenController::class, 'soloInAnHour']);
    Route::get('/acoustic-guitar-jumpstart', [LeadGenController::class, 'jumpstart']);
    Route::group(['prefix' => 'starter-kit'],
        function () {
            Route::get('/{page?}/{lesson?}', LeadGenController::class . '@starterKit')
                ->whereIn('page', [null, 'lessons'])
                ->whereIn('lesson', [null, 'using-a-tuner', 'whats-next']);
            Route::get('/lessons/{page?}', LeadGenController::class . '@starterKitPages')
                ->whereIn('page', [
                    'fundamentals', 'open-chords', 'heartbreak-avenue', 'strumming'
                ]);
        }
    );

    Route::group(['prefix' => 'toolbox'],
        function () {
            Route::get('/{page?}', LeadGenController::class . '@toolbox')
                ->whereIn('page', [null, 'lessons']);
            Route::get('/lessons/{page?}', LeadGenController::class . '@toolboxPages')
                ->whereIn('page', [
                    'changing-chords-smoothly', 'exploring-guitar-rhythms', 'how-to-tune-a-guitar', 'legato-hammer-ons-pull-offs', 'making-chords-sound-clean', 'playing-your-first-guitar-solo', 'playing-your-first-song', 'sight-reading-essentials', 'soloing-with-minor-pentatonic-scales',
                ]);
        }
    );

    Route::get('/{leadgenSlug?}', LeadGenController::class.'@leadgen')
        ->where('leadgenSlug', '(.*)');
});
