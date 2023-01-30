<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Pianote\HomePageController;
use App\Http\Controllers\Pianote\LeadGenController;

Route::domain('{pianoteDomain}')
    ->middleware(['web_public'])
    ->group(function () {

    Route::get('/thank-you', [LeadGenController::class, 'thankyou']);
    Route::get('/thankyou', [LeadGenController::class, 'thankyoualt']);
    Route::get('/email-confirmation ', [LeadGenController::class, 'emailconfirmation']);
    Route::get('/confirming', [LeadGenController::class, 'confirming']);
    Route::get('/subscribed', [LeadGenController::class, 'subscribed']);
    Route::get('/weekly-email', [LeadGenController::class, 'weeklyemail']);
    Route::get('/weeklyemail', [LeadGenController::class, 'weeklyemail2']);
    Route::get('/minor-blues', [LeadGenController::class, 'minorBlues']);
    Route::get('/recitals', [LeadGenController::class, 'recitals']);
    Route::get('/classical-cohort-1', [LeadGenController::class, 'classicalcohort1']);
    Route::get('/classical-cohort-2', [LeadGenController::class, 'classicalcohort2']);
    Route::get('/classical-cohort-3', [LeadGenController::class, 'classicalcohort3']);
    Route::get('/classical-cohort-4', [LeadGenController::class, 'classicalcohort4']);
    Route::get('/one-million', [LeadGenController::class, 'onemillion']);
    Route::get('/lifetime-members-masterclass', [LeadGenController::class, 'lifetimeMasterclass']);

    Route::group(['prefix' => 'piano-complete-beginners-bootcamp'],
        function () {
            Route::get('/{page?}', LeadGenController::class . '@beginnerBootcamp')
                ->whereIn('page', [
                    null, 'zoom'
                ]);
        }
    );
    Route::group(['prefix' => 'perfect-practice-bootcamp'],
        function () {
            Route::get('/{page?}', LeadGenController::class . '@practiceBootcamp')
                ->whereIn('page', [
                    null, 'zoom'
                ]);
        }
    );
    Route::get('/chord-hacks', [LeadGenController::class, 'chordHacks']);
    Route::get('/riffs-and-fills', [LeadGenController::class, 'riffsAndFills']);
    Route::get('/shop/riffs-and-fills', [LeadGenController::class, 'riffsAndFills']);

    Route::group(['prefix' => 'method'],
        function () {
            Route::get('/{page?}', LeadGenController::class . '@method')
                ->whereIn('page', [
                    'why-people-fail', 'play-a-song', 'guarantee-success'
                ]);
        }
    );
    Route::group(['prefix' => 'getting-started'],
        function () {
            Route::get('/{page?}', LeadGenController::class . '@gstd')
                ->whereIn('page', [
                    null,'thank-you'
                ]);
        }
    );
    Route::group(['prefix' => 'sight-reading-made-simple'],
        function () {
            Route::get('/{page?}/{lesson?}', LeadGenController::class . '@sightReading')
                ->whereIn('page', [
                    null, 'lessons'
                ])
                ->whereIn('lesson', [
                    null, '1', '2', '3', '4'
                ]);
        }
    );
    Route::group(['prefix' => 'learn-songs'],
        function () {
            Route::get('/{page?}/{lesson?}', LeadGenController::class . '@learnSongs')
                ->whereIn('page', [
                    null, 'thank-you', 'lessons'
                ])
                ->whereIn('lesson', [
                    null, 'intro', 'someone-you-loved', 'hallelujah', 'love-story'
                ]);
        }
    );
    Route::group(['prefix' => 'christmas-carols'],
        function () {
            Route::get('/{page?}/{lesson?}', LeadGenController::class . '@carols')
                ->whereIn('page', [
                    null, 'songs'
                ])
                ->whereIn('lesson', [
                    null, 'deck-the-halls', 'joy-to-the-world', 'o-holy-night', 'silent-night', 'jingle-bells'
                ]);
        }
    );
    Route::group(['prefix' => 'classical-piano'],
        function () {
            Route::get('/{page?}/{lesson?}', LeadGenController::class . '@classicalPiano')
                ->whereIn('page', [
                    null, 'lessons'
                ])
                ->whereIn('lesson', [
                    null, '1', '2', '3', '4'
                ]);
        }
    );
    Route::group(['prefix' => '50-chord-charts'],
        function () {
            Route::get('/{page?}', LeadGenController::class . '@chordCharts')
                ->whereIn('page', [
                    null, 'unlocked'
                ]);
        }
    );
    Route::group(['prefix' => 'piano-in-5-days'],
        function () {
            Route::get('/{page?}/{lesson?}', LeadGenController::class . '@fiveDays')
                ->whereIn('page', [
                    null, 'lessons'
                ])
                ->whereIn('lesson', [
                    null, 'day-1-welcome-to-the-piano', 'day-1-practice-video-1', 'day-1-practice-video-2', 'day-2-you-can-play-a-melody', 'day-2-practice-video-1', 'day-3-you-can-use-both-hands', 'day-3-practice-video-1', 'day-3-practice-video-2', 'day-4-reading-music', 'day-4-practice-video-1', 'day-4-practice-video-2', 'day-4-practice-video-3', 'day-5-you-can-play-piano', 'day-5-practice-video-1', 'day-5-practice-video-2', 'day-5-practice-video-3', 'tips-for-success'
                ]);
        }
    );
    Route::get('/start-here', [LeadGenController::class, 'startHere'] );
    Route::group(['prefix' => '7-days-to-sight-reading'],
        function () {
            Route::get('/{page?}/{lesson?}', LeadGenController::class . '@sevenDaysSightReading')
                ->whereIn('page', [
                    null, 'lessons'
                ])
                ->whereIn('lesson', [
                    null, 'day-1', 'day-2', 'day-3', 'day-4', 'day-5', 'day-6', 'day-7'
                ]);
        }
    );
    Route::group(['prefix' => 'personality-quiz'],
        function () {
            Route::get('/{page?}', LeadGenController::class . '@personalityQuiz')
                ->whereIn('page', [
                    null, 'result-1', 'result-2', 'result-3', 'result-4', 'academic', 'entertainer', 'explorer', 'scientist'
                ]);
        }
    );

    Route::get('/{leadgenSlug?}', LeadGenController::class.'@leadgen')
        ->where('leadgenSlug', '(.*)');
});
