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
    Route::get('/coop3rdrumm3r', [LeadGenController::class, 'coop3rdrumm3r']);
    Route::get('/destupefying-your-weak-hand', [LeadGenController::class, 'destupefy'] );
    Route::get('/drum-set-maintenance', [LeadGenController::class, 'drumSetMaintenance']);
    Route::get('/drum-technique-made-easy/testimonials', [LeadGenController::class, 'dtmeTestimonials']);
    Route::get('/faster', [LeadGenController::class, 'faster']);
    Route::get('/gavins-grooves', [LeadGenController::class, 'gavinsGrooves']);
    Route::get('/get-faster', [LeadGenController::class, 'getFaster']);
    Route::get('/get-faster-drums', [LeadGenController::class, 'getFaster']);
    Route::group(['prefix' => 'getting-started'],
        function () {
            Route::get('/{page?}', LeadGenController::class . '@gstd')
                ->whereIn('page', [
                    null, 'thank-you', '10-practice'
                ]);
        }
    );
    Route::get('/getting-started-drums', [LeadGenController::class, 'gtsdAlt']);
    Route::get('/free-playalongs', [LeadGenController::class, 'freePlayalongs']);
    Route::get('/metal-playalongs', [LeadGenController::class, 'metalPlayalongs']);
    Route::get('/grooves-of-john-bonham', [LeadGenController::class, 'johnGrooves']);
    Route::get('/hand-technique', [LeadGenController::class, 'handTechnique']);
    Route::get('/linear-drumming', [LeadGenController::class, 'linearDrumming']);
    Route::get('michael-jackson-grooves', [LeadGenController::class, 'jacksonGrooves']);
    Route::get('must-know-grooves', [LeadGenController::class, 'mustKnowGrooves']);
    Route::get('rock-drumming-masterclass/testimonials', [LeadGenController::class, 'rockDrumming']);
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
            'lifetime-members-masterclass', 'click', 'free-drum-lessons', 'quick-drummer-survey', 'teach-a-beginner', 'thankyou', '30-day-drummer-unsubscribe', '30-day-drummer-subscribe', 'subscribed', 'confirming', 'lets-stay-together', 'welcome-party', 'awards-giveaway', 'recitals', '30-day-drummer-live', 'awards', 'fwtgf-blog', '40s-blog', 'gsd-blog', 'gojb-blog', 'fpa-blog'
        ]);
    Route::get('/druminar/coming-back-to-the-drums', [LeadGenController::class, 'druminarCBTTD']);
    Route::get('/druminar/coming-back-to-the-drums/june-12-live-event', [LeadGenController::class, 'druminarEvent']);
    Route::get('/fathers-day-gifts/', [LeadGenController::class, 'fatherGift']);
    Route::get('/for-teachers/teach-drums/', [LeadGenController::class, 'teachDrums']);
    Route::get('/gift-guide/', [LeadGenController::class, 'giftGuide']);
    Route::get('/new-years-gift-guide/', [LeadGenController::class, 'newYearGift']);
    Route::get('/teach-a-beginner/lessons/', [LeadGenController::class, 'teachBeginner']);
    Route::get('/weekly-email/', [LeadGenController::class, 'weeklyEmail']);
    Route::get('/weeklyemail/', [LeadGenController::class, 'weeklyMail']);
//    Route::get('/leadgen-lesson-test/{slug}', [LeadGenController::class, 'test']);
    Route::get('/{leadgenSlug?}', LeadGenController::class.'@test2')
    ->where('leadgenSlug', '(.*)');
});
