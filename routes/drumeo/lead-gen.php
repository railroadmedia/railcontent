<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Drumeo\LeadGenController;

Route::domain('{drumeoDomain}')->middleware(['web_public'])->group(function () {
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
    Route::get('/fwtgf', [LeadGenController::class, 'fasterNeon']);
    Route::get('/gavins-grooves', [LeadGenController::class, 'gavinsGrooves']);
    Route::group(['prefix' => 'getting-started'],
        function () {
            Route::get('/{page?}', LeadGenController::class . '@gstd')
                ->whereIn('page', [
                    null, 'recap', 'thank-you', '10-practice'
                ]);
        }
    );
    Route::get('/getting-started-drums', [LeadGenController::class, 'gtsdAlt']);
    Route::get('/free-playalongs', [LeadGenController::class, 'freePlayalongs']);
    Route::get('/metal-playalongs', [LeadGenController::class, 'metalPlayalongs']);
    Route::get('/grooves-of-john-bonham', [LeadGenController::class, 'johnGrooves']);
    Route::get('/hand-technique', [LeadGenController::class, 'handTechnique']);
    Route::get('/linear-drumming', [LeadGenController::class, 'linearDrumming']);
    Route::get('/michael-jackson-grooves', [LeadGenController::class, 'jacksonGrooves']);
    Route::get('/must-know-grooves', [LeadGenController::class, 'mustKnowGrooves']);
    Route::get('/rock-drumming-masterclass/testimonials', [LeadGenController::class, 'rockDrumming']);
    Route::get('/subdivision-challenge', [LeadGenController::class, 'subdivision']);
    Route::get('/sucherman-sound', [LeadGenController::class, 'sucherman']);
    Route::group(['prefix' => '/ultimate-toolbox'],
        function () {
            Route::get('/{page?}', LeadGenController::class . '@toolbox')
                ->whereIn('page', [
                    null, 'catalogue'
                ]);
            Route::get('/{page1?}', LeadGenController::class . '@toolboxIndexs')
                ->whereIn('page1', [
                    'gsotd', '5pa', 'bdbc', 'fwtgf',
                ]);
            Route::get('/{page2?}', LeadGenController::class . '@toolboxRest')
                ->whereIn('page2', [
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
    Route::get('/birthday-gifts/', [LeadGenController::class, 'birthdayGifts']);
    Route::get('/christmas-gift-guide/', [LeadGenController::class, 'christmasGift']);
    Route::get('/{page?}', LeadGenController::class . '@pages')
        ->whereIn('page', [
            'lifetime-members-masterclass', 'click', 'free-drum-lessons', 'quick-drummer-survey', 'teach-a-beginner', 'thankyou', 'thank-you', '30-day-drummer-unsubscribe', '30-day-drummer-subscribe', 'subscribed', 'confirming', 'lets-stay-together', 'welcome-party', 'recitals', '30-day-drummer-live', 'awards', 'fwtgf-blog', '40s-blog', 'gsd-blog', 'gojb-blog', 'fpa-blog'
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
    Route::get('/{leadgenSlug?}', LeadGenController::class.'@leadgen')
    ->where('leadgenSlug', '(.*)');
});
