<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Drumeo\LeadGenController;

Route::domain('{drumeoDomain}')->group(function () {
    Route::group(['prefix' => '100-songs'],
        function () {

            // if page is null, it's the root /
            Route::get('/{page?}', LeadGenController::class . '@oneHundredSongs')
                ->whereIn('page', [null, 'unlocked']);

        }
    );
    Route::group(['prefix' => 'coop3rdrumm3r'],
        function () {
            Route::get('/{page?}', LeadGenController::class . '@coop3rdrumm3r')
                ->whereIn('page', [
                    null,
                    'lessons',
                    '1-the-drum-set',
                    '2-drum-theory',
                    '3-practice',
                    '4-grooves',
                    '5-drum-fills',
                    'keep-getting-better',
                ]);
        }
    );
    Route::get('/destupefying-your-weak-hand', [LeadGenController::class, 'destupefy'] );
    Route::group(['prefix' => 'drum-fills'],
        function () {
            Route::get('/{page?}', LeadGenController::class . '@drumFills')
                ->whereIn('page', [
                    null, '1', '2', '3', '4', '5',
                ]);
        }
    );
    Route::group(['prefix' => 'drum-set-maintenance'],
        function () {
            Route::get('/{prefix?}/{page?}', LeadGenController::class . '@drumSetMaintenance')
                ->whereIn('prefix', [null, 'course-index'])
                ->whereIn('page', [
                    null, '1', '2', '3', '4', '5', '6', '7'
                ]);
        }
    );
    Route::group(['prefix' => 'drum-technique-made-easy'],
        function () {
            Route::get('/{page?}', LeadGenController::class . '@dtme')
                ->whereIn('page', [
                    '1-five-technique-myths', '2-massive-technique-fails', '3-the-most-important-technique', 'testimonials',
                ]);
        }
    );
    Route::group(['prefix' => 'faster'],
        function () {
            Route::get('/{page?}', LeadGenController::class . '@faster')
                ->whereIn('page', [
                    null, 'lessons', '1', '2', '3', '4', '5', '6', '7', '8', '9', '10'
                ]);
        }
    );
    Route::group(['prefix' => 'gavins-grooves'],
        function () {
            Route::get('/{prefix?}/{page?}', LeadGenController::class . '@gavinsGrooves')
                ->whereIn('prefix', [null, 'course-index'])
                ->whereIn('page', [
                    null, '1-intro', '2-mother-child-divided', '3-halo', '4-sound-of-muzak', '5-futile', '6-anesthetize', '7-life', '8-conclusion'
                ]);
        }
    );
    Route::get('/{page?}', [LeadGenController::class, 'getFaster'])->whereIn('page', [
        'get-faster', 'get-faster-drums'
    ]);
    Route::group(['prefix' => 'getting-started'],
        function () {
            Route::get('/{page?}', LeadGenController::class . '@gstd')
                ->whereIn('page', [
                    null, 'thank-you', 'lessons', 'checking-in', 'great-news', '1-setting-up-your-drums', '2-tuning-your-drums', '3-holding-your-drumsticks', '4-reading-drum-notation', '5-basic-counting', '6-your-first-beat', '7-your-first-fill', '8-using-a-metronome', '9-your-first-song', '10-practice-routine', '10-practice'
                ]);
        }
    );
    Route::get('/getting-started-drums', [LeadGenController::class, 'gtsdAlt'] );
    Route::group(['prefix' => 'free-playalongs'],
        function () {
            Route::get('/{prefix?}/{page?}', LeadGenController::class . '@freePlayalongs')
                ->whereIn('prefix', [null, 'songs'])
                ->whereIn('page', [
                    null, '1', '2', '3', '4', '5', '6', '7', '8', '9'
                ]);
        }
    );
    Route::group(['prefix' => 'metal-playalongs'],
        function () {
            Route::get('/{prefix?}/{page?}', LeadGenController::class . '@metalPlayalongs')
                ->whereIn('prefix', [null, 'songs'])
                ->whereIn('page', [
                    null, '1', '2', '3', '4', '5', '6', '7', '8', '9'
                ]);
        }
    );
    Route::group(['prefix' => 'grooves-of-john-bonham'],
        function () {
            Route::get('/{prefix?}/{page?}', LeadGenController::class . '@johnGrooves')
                ->whereIn('prefix', [null, 'lessons'])
                ->whereIn('page', [
                    null, '1', '2', '3', '4', '5', '6', '7', '8', '9', '10', '11'
                ]);
        }
    );
    Route::group(['prefix' => 'hand-technique'],
        function () {
            Route::get('/{prefix?}/{page?}', LeadGenController::class . '@handTechnique')
                ->whereIn('prefix', [null, 'lessons'])
                ->whereIn('page', [
                    null, '1', '2', '3', '4', '5', '6'
                ]);
        }
    );
    Route::group(['prefix' => 'linear-drumming'],
        function () {
            Route::get('/{page?}', LeadGenController::class . '@linearDrumming')
                ->whereIn('page', [
                    null, 'lessons', '1-about', '2-dance-pop', '3-rock-tom', '4-gospel', '5-metal', 'next-level'
                ]);
        }
    );
    Route::group(['prefix' => 'michael-jackson-grooves'],
        function () {
            Route::get('/{prefix?}/{page?}', LeadGenController::class . '@jacksonGrooves')
                ->whereIn('prefix', [null, 'course-index'])
                ->whereIn('page', [
                    null, '1-intro', '2-wannabestartin', '3-smoothcriminal', '4-billiejean', '5-humannature', '6-beatit', '7-threatened', '8-thriller', '9-workingdayandnight', '10-ontheroad'
                ]);
        }
    );
    Route::group(['prefix' => 'must-know-grooves'],
        function () {
            Route::get('/{prefix?}/{page?}', LeadGenController::class . '@mustKnowGrooves')
                ->whereIn('prefix', [null, 'course-index'])
                ->whereIn('page', [
                    null, '1-intro', '2-shuffle', '3-lindybeat', '4-motown', '5-latin', '6-vacationrhythms', '7-secondline', '8-socalpunk', '9-mozambiquesongo'
                ]);
        }
    );
    Route::group(['prefix' => 'rock-drumming-masterclass'],
        function () {
            Route::get('/{page?}', LeadGenController::class . '@rockDrumming')
                ->whereIn('page', [
                    'most-underrated-drummer', 'most-important-rock-drum-tips', 'epic-drum-video', 'testimonials'
                ]);
        }
    );
    Route::group(['prefix' => 'subdivision-challenge'],
        function () {
            Route::get('/{prefix?}/{page?}', LeadGenController::class . '@subdivision')
                ->whereIn('prefix', [null, 'course-index'])
                ->whereIn('page', [
                    null, '1', '2', '3', '4', '5'
                ]);
        }
    );
    Route::group(['prefix' => 'sucherman-sound'],
        function () {
            Route::get('/{prefix?}/{page?}', LeadGenController::class . '@sucherman')
                ->whereIn('prefix', [null, 'course-index'])
                ->whereIn('page', [
                    null, '1-good-sounding', '2-hi-hats', '3-bass-snare', '4-elevating-sound', '5-shift-focus'
                ]);
        }
    );
    Route::group(['prefix' => 'ultimate-toolbox'],
        function () {
            Route::get('/{page?}', LeadGenController::class . '@toolbox')
                ->whereIn('page', [
                    null, 'catalogue'
                ]);
            Route::get('/gsotd/{page?}', LeadGenController::class . '@toolboxGsotd')
                ->whereIn('page', [
                    null, '1', '2', '3', '4', '5', '6', '7', '8', '9', '10'
                ]);
            Route::get('/5pa/{page?}', LeadGenController::class . '@toolbox5pa')
                ->whereIn('page', [
                    null, '1', '2', '3', '4', '5'
                ]);
            Route::get('/bdbc/{page?}', LeadGenController::class . '@toolbox5pa')
                ->whereIn('page', [
                    null, '1', '2', '3', '4', '5', '6', '7'
                ]);
            Route::get('/fwtgf/{page?}', LeadGenController::class . '@toolboxFwtgf')
                ->whereIn('page', [
                    null, '1', '2', '3', '4', '5', '6', '7', '8', '9', '10', '11', '12', '13', '14', '15', '16', '17', '18', '19'
                ]);
            Route::get('/{page?}', LeadGenController::class . '@toolboxRest')
                ->whereIn('page', [
                    'mcsa', 'urfd', 'htls', 'dodt',
                ]);

        }
    );
    Route::group(['prefix' => 'shows' ],
        function () {
            Route::get('/{page?}', LeadGenController::class . '@shows')
                ->whereIn('page', [
                    'behind-the-scenes', 'in-rhythm', 'sonor', 'study-the-greats'
                ]);
        }
    );
    Route::group(['prefix' => 'shows' ],
        function () {
            Route::get('/{page?}', LeadGenController::class . '@shows')
                ->whereIn('page', [
                    'behind-the-scenes', 'in-rhythm', 'sonor', 'study-the-greats'
                ]);
        }
    );
    Route::get('/birthday-gifts/', [LeadGenController::class, 'birthdayGifts']);
    Route::get('/christmas-gift-guide/', [LeadGenController::class, 'christmasGift']);
    Route::get('/{page?}', LeadGenController::class . '@pages')
        ->whereIn('page', [
            'click', 'free-drum-lessons', 'quick-drummer-survey', 'teach-a-beginner', 'thankyou', '30-day-drummer-unsubscribe', '30-day-drummer-subscribe', 'subscribed', 'confirming', 'lets-stay-together', 'welcome-party', '2-million', 'awards-giveaway', 'recitals', 'lifetime-members-masterclass', '30-day-drummer-live', 'awards',
        ]);
    Route::get('/druminar/coming-back-to-the-drums', [LeadGenController::class, 'druminarCBTTD']);
    Route::get('/druminar/coming-back-to-the-drums/june-12-live-event', [LeadGenController::class, 'druminarEvent']);
    Route::get('/fathers-day-gifts/', [LeadGenController::class, 'fatherGift']);
    Route::get('/for-teachers/teach-drums/', [LeadGenController::class, 'teachDrums']);
    Route::get('/gift-guide/', [LeadGenController::class, 'giftGuide']);
    Route::get('/new-years-gift-guide/', [LeadGenController::class, 'newYearGift']);
    Route::get('/teach-a-beginner/lessons/', [LeadGenController::class, 'teachBeginner']);
    Route::get('/weeklyemail/', [LeadGenController::class, 'weeklyMail']);
    Route::get('/{page?}', LeadGenController::class . '@blogForms')
        ->whereIn('page', [
            'fwtgf-blog', '40s-blog', 'gsd-blog', 'gojb-blog', 'fpa-blog'
        ]);
});
