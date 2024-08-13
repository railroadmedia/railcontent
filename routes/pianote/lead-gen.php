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
        Route::get('/preferences', [LeadGenController::class, 'preferences']);
        Route::get('/weekly-email', [LeadGenController::class, 'weeklyemail']);
        Route::get('/weeklyemail', [LeadGenController::class, 'weeklyemail2']);
        Route::get('/minor-blues', [LeadGenController::class, 'minorBlues']);
        Route::get('/f-sharp-minor', [LeadGenController::class, 'fSharpMinor']);
        Route::get('/pentatonic-scale', [LeadGenController::class, 'pentatonicScale']);
        Route::get('/chord-inversions', [LeadGenController::class, 'chordInversions']);
        Route::get('/recitals', [LeadGenController::class, 'recitals']);
        Route::get('/classical-cohort-1', [LeadGenController::class, 'classicalcohort1']);
        Route::get('/classical-cohort-2', [LeadGenController::class, 'classicalcohort2']);
        Route::get('/classical-cohort-3', [LeadGenController::class, 'classicalcohort3']);
        Route::get('/classical-cohort-4', [LeadGenController::class, 'classicalcohort4']);
        Route::get('/one-million', [LeadGenController::class, 'onemillion']);
        Route::get('/lifetime-members-masterclass', [LeadGenController::class, 'lifetimeMasterclass']);
        Route::get('/song-secrets-webinar', [LeadGenController::class, 'songSecrets']);
        Route::get('/song-secrets-webinar/thank-you', [LeadGenController::class, 'songSecretsTY']);
        Route::get('/beautiful-christmas-classics', [LeadGenController::class, 'beautifulChristmasClassics']);
        Route::get('/digital-chords-scales-guide', [LeadGenController::class, 'digitalChordsAndScales']);
        Route::get('/casio-giveaway', [LeadGenController::class, 'giveaway']);
        Route::get('/awards', [LeadGenController::class, 'awards']);
        Route::get('/prima-resources', [LeadGenController::class, 'primaResources']);
        Route::get('/osmose-giveaway', [LeadGenController::class, 'osmoseGiveaway']);
        Route::get('/technique-essentials', [LeadGenController::class, 'techniqueEssentials']);

        Route::group(
            ['prefix' => 'piano-complete-beginners-bootcamp'],
            function () {
                Route::get('/{page?}', LeadGenController::class . '@beginnerBootcamp')
                    ->whereIn('page', [
                        null, 'zoom'
                    ]);
            }
        );
        Route::group(
            ['prefix' => 'perfect-practice-bootcamp'],
            function () {
                Route::get('/{page?}', LeadGenController::class . '@practiceBootcamp')
                    ->whereIn('page', [
                        null, 'zoom'
                    ]);
            }
        );
        Route::group(
            ['prefix' => 'chord-hacks'],
            function () {
                Route::get('/{page?}', LeadGenController::class . '@chordHacks')
                    ->whereIn('page', [
                        null, 'thank-you', 'ty-annual', 'ty-monthly'
                    ]);
            }
        );
        Route::group(
            ['prefix' => 'blues-piano-bootcamp'],
            function () {
                Route::get('/{page?}', LeadGenController::class . '@bluesPianoBootcamp')
                    ->whereIn('page', [
                        null, 'thank-you', 'ty-annual', 'ty-monthly'
                    ]);
            }
        );

        Route::group(
            ['prefix' => 'method'],
            function () {
                Route::get('/{page?}', LeadGenController::class . '@method')
                    ->whereIn('page', [
                        'why-people-fail', 'play-a-song', 'guarantee-success'
                    ]);
            }
        );
        Route::group(
            ['prefix' => 'getting-started'],
            function () {
                Route::get('/{page?}', LeadGenController::class . '@gstd')
                    ->whereIn('page', [
                        null, 'thank-you', 'ty-annual', 'ty-monthly'
                    ]);
            }
        );
        Route::get('/sight-reading-made-simple', [LeadGenController::class, 'sightReading']);
        Route::group(
            ['prefix' => 'learn-songs'],
            function () {
                Route::get('/{page?}', LeadGenController::class . '@learnSongs')
                    ->whereIn('page', [
                        null, 'thank-you',
                    ]);
            }
        );
        Route::get('/christmas-carols', [LeadGenController::class, 'carols']);
        Route::get('/classical-piano', [LeadGenController::class, 'classicalPiano']);
        Route::group(
            ['prefix' => '50-chord-charts'],
            function () {
                Route::get('/{page?}', LeadGenController::class . '@chordCharts')
                    ->whereIn('page', [
                        null, 'unlocked'
                    ]);
            }
        );
        Route::get('/piano-in-5-days', [LeadGenController::class, 'fiveDays']);
        Route::get('/start-here', [LeadGenController::class, 'startHere']);
        Route::get('/7-days-to-sight-reading', [LeadGenController::class, 'sevenDaysSightReading']);
        Route::group(
            ['prefix' => 'personality-quiz'],
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
