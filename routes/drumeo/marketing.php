<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Drumeo\HomePageController;
use App\Http\Controllers\Drumeo\MarketingController;

Route::domain('{drumeoDomain}')->group(function () {
    Route::get(
        '/referral-join',
        [
            'as' => 'referral.invite-a-friend-landing',
            'uses' => App\Http\Controllers\Profiles\ReferralController::class . '@join',
        ]
    );

    Route::get('/', \App\Http\Controllers\Drumeo\MarketingController::class . '@sales');
    Route::get('/songs', function () { return view('sales.pages.songs'); });
    Route::get('/student-only', \App\Http\Controllers\Drumeo\MarketingController::class . '@salesStudents');
    Route::get('/upgrade-offer', \App\Http\Controllers\Drumeo\MarketingController::class . '@salesUpgrade');
    Route::get('/lifetime', \App\Http\Controllers\Drumeo\MarketingController::class . '@salesUpgradeLifetime');
    Route::get('/anniversary-deal', \App\Http\Controllers\Drumeo\MarketingController::class . '@sales');
    Route::get('/better-sound/', \App\Http\Controllers\Drumeo\MarketingController::class . '@salesBetterSound');
    Route::get('/festival/', \App\Http\Controllers\Drumeo\MarketingController::class . '@Festival');
    Route::get('/festival/coastal-jazz-discount/', \App\Http\Controllers\Drumeo\MarketingController::class . '@festivalCoastal');
    Route::get('/festival/edge/', \App\Http\Controllers\Drumeo\MarketingController::class . '@festivalEdge');
    Route::get('/festival/modern-drummer/', \App\Http\Controllers\Drumeo\MarketingController::class . '@festivalMd');
    Route::post('/hlag-submit/', \App\Http\Controllers\Drumeo\MarketingController::class . '@hitLikeAGirlSubmission');
    Route::get('/kids/', \App\Http\Controllers\Drumeo\MarketingController::class . '@kids');
    Route::get('/mydrumset', \App\Http\Controllers\Drumeo\MarketingController::class . '@sales');
    Route::get('/impact', function () { return view('sales.pages.impact'); });

    Route::get('/lifetime-masterclass', function () { return view('sales.lifetime-masterclass'); });
    Route::get('/support', function () { return view('sales.pages.contact'); });
    Route::get('/courses/{slug}', function ($slug) {return view('lead-gen.courses.' . $slug);});
    Route::get('/about', function () { return view('sales.pages.about'); });
    Route::get('/privacy', function () { return view('sales.pages.privacy'); });
    Route::get('/shows/{slug}', function ($slug) {return view('lead-gen.shows.' . $slug);});
    Route::get('/terms', function () { return view('sales.pages.terms'); });
    Route::get('/cookie', function () { return view('sales.pages.cookie'); });
    Route::get('/beginner', function () { return view('sales.beginner'); });
    Route::get('/app', function () { return view('sales.apps.app'); });
    Route::get('/kids', function () { return view('sales.apps.drumeo-kids'); });
    Route::get('/trial', function () { return view('sales.trials.trial'); });

    Route::get('/aric', function () { return view('sales.trials.coaches.aric'); });
    Route::get('/domino', function () { return view('sales.trials.coaches.domino'); });
    Route::get('/dorothea', function () { return view('sales.trials.coaches.dorothea'); });
    Route::get('/jared', function () { return view('sales.trials.coaches.jared'); });
    Route::get('/john', function () { return view('sales.trials.coaches.john'); });
    Route::get('/kaz', function () { return view('sales.trials.coaches.kaz'); });
    Route::get('/larnell', function () { return view('sales.trials.coaches.larnell'); });
    Route::get('/matt', function () { return view('sales.trials.coaches.matt'); });
    Route::get('/sarah', function () { return view('sales.trials.coaches.sarah'); });
    Route::get('/schack', function () { return view('sales.trials.coaches.schack'); });
    Route::get('/sharon', function () { return view('sales.trials.coaches.sharon'); });
    Route::get('/todd', function () { return view('sales.trials.coaches.todd'); });

    Route::get('/estepario', function () { return view('sales.trials.affiliates.estepario'); });

    Route::group(['prefix' => 'a' ],
        function () {
            Route::get('/66samus', function () { return view('sales.trials.affiliates.66samus'); });
            Route::get('/adriendrums', function () { return view('sales.trials.affiliates.adriendrums'); });
            Route::get('/alejandrosifuentes', function () { return view('sales.trials.affiliates.alejandrosifuentes'); });
            Route::get('/brandonscott', function () { return view('sales.trials.affiliates.brandonscott'); });
            Route::get('/cooperdrummer', function () { return view('sales.trials.affiliates.cooperdrummer'); });
            Route::get('/davidcola', function () { return view('sales.trials.affiliates.davidcola'); });
            Route::get('/drumhelper', function () { return view('sales.trials.affiliates.drumhelper'); });
            Route::get('/joshcrawford', function () { return view('sales.trials.affiliates.joshcrawford'); });
            Route::get('/leviclay', function () { return view('sales.trials.affiliates.leviclay'); });
            Route::get('/linaanderberg', function () { return view('sales.trials.affiliates.linaanderberg'); });
            Route::get('/rdavidr', function () { return view('sales.trials.affiliates.rdavidr'); });
            Route::get('/robbrown', function () { return view('sales.trials.affiliates.robbrown'); });
            Route::get('/the8bitdrummer', function () { return view('sales.trials.affiliates.the8bitdrummer'); });
            Route::get('/worshipdrummer', function () { return view('sales.trials.affiliates.worshipdrummer'); });
            Route::get('/wyattstav', function () { return view('sales.trials.affiliates.wyattstav'); });
            Route::get('/zackgrooves', function () { return view('sales.trials.affiliates.zackgrooves'); });
        }
    );
    Route::group(['prefix' => 'affiliate' ],
        function () {
            Route::get('/andrewrooney', function () { return view('sales.trials.affiliates.andrewrooney'); });
            Route::get('/asobergirlsguide', function () { return view('sales.trials.affiliates.asobergirlsguide'); });
            Route::get('/bhcollective', function () { return view('sales.trials.affiliates.bhcollective'); });
            Route::get('/bryanforcedrums', function () { return view('sales.trials.affiliates.bryanforcedrums'); });
            Route::get('/drummingreview', function () { return view('sales.trials.affiliates.drummingreview'); });
            Route::get('/drumninja', function () { return view('sales.trials.affiliates.drumninja'); });
            Route::get('/electronicdrumadvisor', function () { return view('sales.trials.affiliates.electronicdrumadvisor'); });
            Route::get('/jessica-burdeaux', function () { return view('sales.trials.affiliates.jessica-burdeaux'); });
            Route::get('/kylemcgrail', function () { return view('sales.trials.affiliates.kylemcgrail'); });
            Route::get('/leyandrums', function () { return view('sales.trials.affiliates.leyandrums'); });
            Route::get('/lindseyward', function () { return view('sales.trials.affiliates.lindseyward'); });
            Route::get('/musicindustryhowto', function () { return view('sales.trials.affiliates.musicindustryhowto'); });
            Route::get('/rickyficarelli', function () { return view('sales.trials.affiliates.rickyficarelli'); });
            Route::get('/tobines', function () { return view('sales.trials.affiliates.tobines'); });
        }
    );

    Route::get('/coach-trial', function () { return view('sales.trials.trial-selection.coaches'); });
    Route::get('/choose-your-trial', function () { return view('sales.trials.trial-selection.week'); });
    Route::get('/earthworks', function () { return view('sales.trials.earthworks'); });
    Route::get('/earthworks-trial', function () { return view('sales.trials.trial-selection.earthworks'); });
    Route::get('/coaches-quiz', function () { return view('sales.trials.coaches-quiz'); });
    Route::get('/coaches-quiz-trial', function () { return view('sales.trials.trial-selection.coaches-quiz'); });
    Route::get('/30-day-trial', function () { return view('sales.trials.30-day-trial'); });
    Route::get('/choose-your-trial-month', function () { return view('sales.trials.trial-selection.month'); });
    Route::get('/melodics', function () { return view('sales.trials.melodics'); });
    Route::get('/melodics-trial', function () { return view('sales.trials.trial-selection.melodics'); });
    Route::get('/new-drummers-trial', function () { return view('sales.trials.new-drummers-trial'); });
    Route::get('/new-drummers-trial-month', function () { return view('sales.trials.trial-selection.new-drummers'); });

    Route::get('/affiliate-trial', function () { return view('sales.trials.trial-selection.affiliates'); });

    Route::get('/power-pack', function () { return view('sales.trials.power-pack'); });
    Route::get('/bestbook-trial', function () { return view('sales.trials.trial-book'); });
    Route::get('/toolbox-trial', function () { return view('sales.trials.trial-toolbox-book'); });
    Route::get('/vdrums', function () { return view('sales.trials.vdrums'); });
    Route::get('/beat-testing/', function () { return view('beat.beat-layout'); });
    Route::get('/birthday-gifts/', function () { return view('lead-gen.gift-guide.birthday-guide'); });
    Route::get('/christmas-gift-guide/', function () { return view('lead-gen.gift-guide.christmas-guide'); });
    Route::get('/click/', function () { return view('lead-gen.pages.click'); });
    Route::get('/druminar/coming-back-to-the-drums', function () { return view('lead-gen.webinar.coming-back-to-the-drums'); });
    Route::get('/druminar/coming-back-to-the-drums/june-12-live-event', function () { return view('lead-gen.webinar.event'); });
    Route::get('/fathers-day-gifts/', function () { return view('lead-gen.gift-guide.fathers-day-guide'); });
    Route::get('/for-teachers/teach-drums/', function () { return view('lead-gen.pages.teach-drums'); });
    Route::get('/free-drum-lessons/', function () { return view('lead-gen.pages.free-drum-lessons'); });
    Route::get('/free-gift/', function () { return view('lead-gen.free-gift.free-gift'); });
    Route::get('/gift-guide/', function () { return view('lead-gen.gift-guide.new-years-guide'); });
    Route::get('/new-years-gift-guide/', function () { return view('lead-gen.gift-guide.new-years-guide'); });
    Route::get('/pro/', function () { return view('products.full-page-assets.pro'); });
    Route::get('/quick-drummer-survey/', function () { return view('lead-gen.pages.quick-drummer-survey'); });
    Route::get('/song-demo/', function () { return view('sales.pages.song-demo'); });
    Route::get('/tom-sawyer/', function () { return view('sales.pages.tom-sawyer'); });
    Route::get('/sonor/', function () { return view('sales.trials.sonor'); });
    Route::get('/teach-a-beginner/', function () { return view('lead-gen.pages.teach-a-beginner'); });
    Route::get('/teach-a-beginner/lessons/', function () { return view('lead-gen.pages.teach-a-beginner-lessons'); });
    Route::get('/thankyou/', function () { return view('lead-gen.pages.thank-you'); });
    Route::get('/thank-you/', function () { return view('lead-gen.pages.thank-you-alt'); });
    Route::get('/30-day-drummer-unsubscribe/', function () { return view('lead-gen.pages.30-day-drummer-unsubscribe'); });
    Route::get('/30-day-drummer-subscribe/', function () { return view('lead-gen.pages.30-day-drummer-subscribe'); });
    Route::get('/confirming/', function () { return view('lead-gen.pages.confirming'); });
    Route::get('/lets-stay-together/', function () { return view('lead-gen.pages.lets-stay-together'); });
    Route::get('/upgrade-preview/', function () { return view('members.pages.upgrade'); });
    Route::get('/VIP/', function () { return view('products.vip.vip-layout'); });
    Route::get('/welcome-party/', function () { return view('lead-gen.pages.welcome-party'); });
    Route::get('/2-million/', function () { return view('lead-gen.pages.2-million'); });
    Route::get('/awards-giveaway/', function () { return view('lead-gen.pages.awards-giveaway'); });
    Route::get('/recitals/', function () { return view('lead-gen.pages.recitals'); });
    Route::get('/lifetime-members-masterclass/', function () { return view('lead-gen.pages.lifetime-members-masterclass'); });
    Route::get('/30-day-drummer-live/', function () { return view('lead-gen.pages.30-day-drummer-live'); });
    Route::get('/awards/', function () { return view('lead-gen.pages.awards'); });
    Route::get('/30-day-drummer-register-endpoint', MarketingController::class . '@registerFor30DayDrummer');
    Route::get('/drumfest', function () { return view('products.full-page-assets.quebec-drum-festival'); });
});
