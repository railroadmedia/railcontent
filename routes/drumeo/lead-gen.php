<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Drumeo\LeadGenController;

Route::domain('{drumeoDomain}')->middleware(['web_public'])->group(function () {
    Route::group(['prefix' => '100-songs'], function () {
        Route::get('/{page?}', LeadGenController::class . '@oneHundredSongs')->whereIn('page', [
            null, 'unlocked', 'thank-you', 'ty-annual', 'ty-monthly'
        ]);
    });
    Route::group(['prefix' => 'kristinas-top-25'], function () {
        Route::get('/{page?}', LeadGenController::class . '@kristinasTop25')->whereIn('page', [
            null, 'unlocked'
        ]);
    });
    Route::get('/coop3rdrumm3r', [LeadGenController::class, 'coop3rdrumm3r']);
    Route::get('/destupefying-your-weak-hand', [LeadGenController::class, 'destupefy']);
    Route::get('/drum-set-maintenance', [LeadGenController::class, 'drumSetMaintenance']);
    Route::get('/drum-technique-made-easy/testimonials', [LeadGenController::class, 'dtmeTestimonials']);
    Route::get('/fwtgf', [LeadGenController::class, 'faster']);
    Route::group(['prefix' => 'faster'], function () {
        Route::get('/{page?}', LeadGenController::class . '@faster')->whereIn('page', [
            null, 'thank-you', 'ty-annual', 'ty-monthly'
        ]);
    });
    Route::get('/gavins-grooves', [LeadGenController::class, 'gavinsGrooves']);
    Route::group(['prefix' => 'getting-started'], function () {
        Route::get('/{page?}', LeadGenController::class . '@gstd')->whereIn('page', [
            null, 'thank-you', '10-practice', 'ty-annual', 'ty-monthly'
        ]);
    });
    Route::get('/double-bass-101', [LeadGenController::class, 'doubleBass101']);
    Route::get('/blue-man', [LeadGenController::class, 'blueMan']);
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
    Route::group(['prefix' => '/ultimate-toolbox'], function () {
        Route::get('/{page?}', LeadGenController::class . '@toolbox')->whereIn('page', [
            null, 'catalogue'
        ]);
        Route::get('/{page1?}', LeadGenController::class . '@toolboxIndexs')->whereIn('page1', [
            'gsotd', '5pa', 'bdbc', 'fwtgf',
        ]);
        Route::get('/{page2?}', LeadGenController::class . '@toolboxRest')->whereIn('page2', [
            'mcsa', 'urfd', 'htls', 'dodt',
        ]);
    });
    Route::group(['prefix' => 'shows' ], function () {
        Route::get('/{page?}', LeadGenController::class . '@shows')->whereIn('page', [
            'behind-the-scenes', 'in-rhythm', 'sonor', 'study-the-greats'
        ]);
    });
    Route::get('/{page?}', LeadGenController::class . '@pages')->whereIn('page', [
        '30-day-drummer-live',
        '30-day-drummer-subscribe',
        '30-day-drummer-unsubscribe',
        '40s-blog',
        'awards',
        'click',
        'confirming',
        'fpa-blog',
        'free-drum-lessons',
        'fwtgf-blog',
        'gojb-blog',
        'gsd-blog',
        'lets-stay-together',
        'lifetime-members-masterclass',
        'preferences',
        'ugwpreferences',
        'quick-drummer-survey',
        'recitals',
        'sm101preferences',
        'subscribed',
        'teach-a-beginner',
        'thank-you',
        'thankyou',
        'welcome-party'
    ]);
    Route::get('/druminar/coming-back-to-the-drums', [LeadGenController::class, 'druminarCBTTD']);
    Route::get('/druminar/coming-back-to-the-drums/june-12-live-event', [LeadGenController::class, 'druminarEvent']);
    Route::get('/for-teachers/teach-drums/', [LeadGenController::class, 'teachDrums']);
    Route::get('/teach-a-beginner/lessons/', [LeadGenController::class, 'teachBeginner']);
    Route::get('/win/', [LeadGenController::class, 'win']);
    Route::get('/weekly-email/', [LeadGenController::class, 'weeklyEmail']);
    Route::get('/weeklyemail/', [LeadGenController::class, 'weeklyMail']);
    Route::get('/the-playlist', [LeadGenController::class, 'thePlaylist']);
    Route::get('/{leadgenSlug?}', LeadGenController::class.'@leadgen')->where('leadgenSlug', '(.*)');
});
