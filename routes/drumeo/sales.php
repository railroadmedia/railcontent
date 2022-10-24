<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Drumeo\SalesController;

Route::domain('{drumeoDomain}')->group(function () {
    Route::get(
        '/referral-join',
        [
            'as' => 'referral.invite-a-friend-landing',
            'uses' => App\Http\Controllers\Profiles\ReferralController::class . '@join',
        ]
    );

    Route::get('/', [SalesController::class, 'sales'] );
    Route::get('/songs', function () { return view('drumeo.sales.pages.songs'); });
    Route::get('/student-only', [SalesController::class, 'salesStudents'] );
    Route::get('/upgrade-offer', [SalesController::class, 'salesUpgrade'] );
    Route::get('/lifetime', [SalesController::class, 'salesUpgradeLifetime'] );
    Route::get('/anniversary-deal', [SalesController::class, 'sales'] );
    Route::get('/festival/', [SalesController::class, 'Festival'] );
    Route::get('/festival/coastal-jazz-discount/', [SalesController::class, 'festivalCoastal'] );
    Route::get('/festival/edge/', [SalesController::class, 'festivalEdge'] );
    Route::get('/festival/modern-drummer/', [SalesController::class, 'festivalMd'] );
    Route::post('/hlag-submit/', [SalesController::class, 'hitLikeAGirlSubmission'] );
    Route::get('/kids/', [SalesController::class, 'kids'] );
    Route::get('/mydrumset', [SalesController::class, 'sales'] );
    Route::get('/impact', function () { return view('drumeo.sales.pages.impact'); });

    Route::get('/lifetime-masterclass', function () { return view('drumeo.sales.lifetime-masterclass'); });
    Route::get('/support', function () { return view('drumeo.sales.pages.contact'); });
    Route::get('/courses/{slug}', function ($slug) {return view('drumeo.lead-gen.courses.' . $slug);});
    Route::get('/about', function () { return view('drumeo.sales.pages.about'); });
    Route::get('/privacy', function () { return view('drumeo.sales.pages.privacy'); });
    Route::get('/shows/{slug}', function ($slug) {return view('drumeo.lead-gen.shows.' . $slug);});
    Route::get('/terms', function () { return view('drumeo.sales.pages.terms'); });
    Route::get('/cookie', function () { return view('drumeo.sales.pages.cookie'); });
    Route::get('/beginner', function () { return view('drumeo.sales.beginner'); });
    Route::get('/app', function () { return view('drumeo.sales.apps.app'); });
    Route::get('/kids', function () { return view('drumeo.sales.apps.drumeo-kids'); });
    Route::get('/trial', function () { return view('drumeo.sales.trials.trial'); });

    Route::get('/aric', function () { return view('drumeo.sales.trials.coaches.aric'); });
    Route::get('/domino', function () { return view('drumeo.sales.trials.coaches.domino'); });
    Route::get('/dorothea', function () { return view('drumeo.sales.trials.coaches.dorothea'); });
    Route::get('/jared', function () { return view('drumeo.sales.trials.coaches.jared'); });
    Route::get('/john', function () { return view('drumeo.sales.trials.coaches.john'); });
    Route::get('/kaz', function () { return view('drumeo.sales.trials.coaches.kaz'); });
    Route::get('/larnell', function () { return view('drumeo.sales.trials.coaches.larnell'); });
    Route::get('/matt', function () { return view('drumeo.sales.trials.coaches.matt'); });
    Route::get('/sarah', function () { return view('drumeo.sales.trials.coaches.sarah'); });
    Route::get('/schack', function () { return view('drumeo.sales.trials.coaches.schack'); });
    Route::get('/sharon', function () { return view('drumeo.sales.trials.coaches.sharon'); });
    Route::get('/todd', function () { return view('drumeo.sales.trials.coaches.todd'); });

    Route::get('/estepario', function () { return view('drumeo.sales.trials.affiliates.estepario'); });

    Route::group(['prefix' => 'a' ],
        function () {
            Route::get('/66samus', function () { return view('drumeo.sales.trials.affiliates.66samus'); });
            Route::get('/adriendrums', function () { return view('drumeo.sales.trials.affiliates.adriendrums'); });
            Route::get('/alejandrosifuentes', function () { return view('drumeo.sales.trials.affiliates.alejandrosifuentes'); });
            Route::get('/brandonscott', function () { return view('drumeo.sales.trials.affiliates.brandonscott'); });
            Route::get('/cooperdrummer', function () { return view('drumeo.sales.trials.affiliates.cooperdrummer'); });
            Route::get('/davidcola', function () { return view('drumeo.sales.trials.affiliates.davidcola'); });
            Route::get('/drumhelper', function () { return view('drumeo.sales.trials.affiliates.drumhelper'); });
            Route::get('/joshcrawford', function () { return view('drumeo.sales.trials.affiliates.joshcrawford'); });
            Route::get('/leviclay', function () { return view('drumeo.sales.trials.affiliates.leviclay'); });
            Route::get('/linaanderberg', function () { return view('drumeo.sales.trials.affiliates.linaanderberg'); });
            Route::get('/rdavidr', function () { return view('drumeo.sales.trials.affiliates.rdavidr'); });
            Route::get('/robbrown', function () { return view('drumeo.sales.trials.affiliates.robbrown'); });
            Route::get('/the8bitdrummer', function () { return view('drumeo.sales.trials.affiliates.the8bitdrummer'); });
            Route::get('/worshipdrummer', function () { return view('drumeo.sales.trials.affiliates.worshipdrummer'); });
            Route::get('/wyattstav', function () { return view('drumeo.sales.trials.affiliates.wyattstav'); });
            Route::get('/zackgrooves', function () { return view('drumeo.sales.trials.affiliates.zackgrooves'); });
        }
    );
    Route::group(['prefix' => 'affiliate' ],
        function () {
            Route::get('/andrewrooney', function () { return view('drumeo.sales.trials.affiliates.andrewrooney'); });
            Route::get('/asobergirlsguide', function () { return view('drumeo.sales.trials.affiliates.asobergirlsguide'); });
            Route::get('/bhcollective', function () { return view('drumeo.sales.trials.affiliates.bhcollective'); });
            Route::get('/bryanforcedrums', function () { return view('drumeo.sales.trials.affiliates.bryanforcedrums'); });
            Route::get('/drummingreview', function () { return view('drumeo.sales.trials.affiliates.drummingreview'); });
            Route::get('/drumninja', function () { return view('drumeo.sales.trials.affiliates.drumninja'); });
            Route::get('/electronicdrumadvisor', function () { return view('drumeo.sales.trials.affiliates.electronicdrumadvisor'); });
            Route::get('/jessica-burdeaux', function () { return view('drumeo.sales.trials.affiliates.jessica-burdeaux'); });
            Route::get('/kylemcgrail', function () { return view('drumeo.sales.trials.affiliates.kylemcgrail'); });
            Route::get('/leyandrums', function () { return view('drumeo.sales.trials.affiliates.leyandrums'); });
            Route::get('/lindseyward', function () { return view('drumeo.sales.trials.affiliates.lindseyward'); });
            Route::get('/musicindustryhowto', function () { return view('drumeo.sales.trials.affiliates.musicindustryhowto'); });
            Route::get('/rickyficarelli', function () { return view('drumeo.sales.trials.affiliates.rickyficarelli'); });
            Route::get('/tobines', function () { return view('drumeo.sales.trials.affiliates.tobines'); });
        }
    );

    Route::get('/coach-trial', function () { return view('drumeo.sales.trials.trial-selection.coaches'); });
    Route::get('/choose-your-trial', function () { return view('drumeo.sales.trials.trial-selection.week'); });
    Route::get('/earthworks', function () { return view('drumeo.sales.trials.earthworks'); });
    Route::get('/earthworks-trial', function () { return view('drumeo.sales.trials.trial-selection.earthworks'); });
    Route::get('/coaches-quiz', function () { return view('drumeo.sales.trials.coaches-quiz'); });
    Route::get('/coaches-quiz-trial', function () { return view('drumeo.sales.trials.trial-selection.coaches-quiz'); });
    Route::get('/30-day-trial', function () { return view('drumeo.sales.trials.30-day-trial'); });
    Route::get('/choose-your-trial-month', function () { return view('drumeo.sales.trials.trial-selection.month'); });
    Route::get('/melodics', function () { return view('drumeo.sales.trials.melodics'); });
    Route::get('/melodics-trial', function () { return view('drumeo.sales.trials.trial-selection.melodics'); });
    Route::get('/new-drummers-trial', function () { return view('drumeo.sales.trials.new-drummers-trial'); });
    Route::get('/new-drummers-trial-month', function () { return view('drumeo.sales.trials.trial-selection.new-drummers'); });

    Route::get('/affiliate-trial', function () { return view('drumeo.sales.trials.trial-selection.affiliates'); });

    Route::get('/power-pack', function () { return view('drumeo.sales.trials.power-pack'); });
    Route::get('/bestbook-trial', function () { return view('drumeo.sales.trials.trial-book'); });
    Route::get('/toolbox-trial', function () { return view('drumeo.sales.trials.trial-toolbox-book'); });
    Route::get('/vdrums', function () { return view('drumeo.sales.trials.vdrums'); });
    Route::get('/beat-testing/', function () { return view('beat.beat-layout'); });
    Route::get('/birthday-gifts/', function () { return view('drumeo.lead-gen.gift-guide.birthday-guide'); });
    Route::get('/christmas-gift-guide/', function () { return view('drumeo.lead-gen.gift-guide.christmas-guide'); });
    Route::get('/click/', function () { return view('drumeo.lead-gen.pages.click'); });
    Route::get('/druminar/coming-back-to-the-drums', function () { return view('drumeo.lead-gen.webinar.coming-back-to-the-drums'); });
    Route::get('/druminar/coming-back-to-the-drums/june-12-live-event', function () { return view('drumeo.lead-gen.webinar.event'); });
    Route::get('/fathers-day-gifts/', function () { return view('drumeo.lead-gen.gift-guide.fathers-day-guide'); });
    Route::get('/for-teachers/teach-drums/', function () { return view('drumeo.lead-gen.pages.teach-drums'); });
    Route::get('/free-drum-lessons/', function () { return view('drumeo.lead-gen.pages.free-drum-lessons'); });
    Route::get('/free-gift/', function () { return view('drumeo.lead-gen.free-gift.free-gift'); });
    Route::get('/gift-guide/', function () { return view('drumeo.lead-gen.gift-guide.new-years-guide'); });
    Route::get('/new-years-gift-guide/', function () { return view('drumeo.lead-gen.gift-guide.new-years-guide'); });
    Route::get('/pro/', function () { return view('drumeo.products.full-page-assets.pro'); });
    Route::get('/quick-drummer-survey/', function () { return view('drumeo.lead-gen.pages.quick-drummer-survey'); });
    Route::get('/song-demo/', function () { return view('drumeo.sales.pages.song-demo'); });
    Route::get('/tom-sawyer/', function () { return view('drumeo.sales.pages.tom-sawyer'); });
    Route::get('/sonor/', function () { return view('drumeo.sales.trials.sonor'); });
    Route::get('/teach-a-beginner/', function () { return view('drumeo.lead-gen.pages.teach-a-beginner'); });
    Route::get('/teach-a-beginner/lessons/', function () { return view('drumeo.lead-gen.pages.teach-a-beginner-lessons'); });
    Route::get('/thankyou/', function () { return view('drumeo.lead-gen.pages.thank-you'); });
    Route::get('/thank-you/', function () { return view('drumeo.lead-gen.pages.thank-you-alt'); });
    Route::get('/30-day-drummer-unsubscribe/', function () { return view('drumeo.lead-gen.pages.30-day-drummer-unsubscribe'); });
    Route::get('/30-day-drummer-subscribe/', function () { return view('drumeo.lead-gen.pages.30-day-drummer-subscribe'); });
    Route::get('/confirming/', function () { return view('drumeo.lead-gen.pages.confirming'); });
    Route::get('/lets-stay-together/', function () { return view('drumeo.lead-gen.pages.lets-stay-together'); });
    Route::get('/upgrade-preview/', function () { return view('members.pages.upgrade'); });
    Route::get('/VIP/', function () { return view('drumeo.products.vip.vip-layout'); });
    Route::get('/welcome-party/', function () { return view('drumeo.lead-gen.pages.welcome-party'); });
    Route::get('/2-million/', function () { return view('drumeo.lead-gen.pages.2-million'); });
    Route::get('/awards-giveaway/', function () { return view('drumeo.lead-gen.pages.awards-giveaway'); });
    Route::get('/recitals/', function () { return view('drumeo.lead-gen.pages.recitals'); });
    Route::get('/lifetime-members-masterclass/', function () { return view('drumeo.lead-gen.pages.lifetime-members-masterclass'); });
    Route::get('/30-day-drummer-live/', function () { return view('drumeo.lead-gen.pages.30-day-drummer-live'); });
    Route::get('/awards/', function () { return view('drumeo.lead-gen.pages.awards'); });
    Route::get('/30-day-drummer-register-endpoint', [SalesController::class, 'registerFor30DayDrummer'] );
    Route::get('/drumfest', function () { return view('drumeo.products.full-page-assets.quebec-drum-festival'); });


    Route::get('/jared-recommends', function () { return view('drumeo.drumshop.jared-recommends'); });

    Route::group(['prefix' => 'drumshop'],
        function () {
            Route::get('/30-day-drummer', [SalesController::class, 'thirtyDayDrummer'] );
            Route::get('/30-day-drummer/deal', function () { return view('drumeo.lead-gen.pages.30-day-drummer-deal'); });
            Route::get('/beginner-book', function () { return view('drumeo.products.full-page-assets.beginner-book'); });
            Route::get('/better-drum-fills', function () { return view('drumeo.products.full-page-assets.better-drum-fills'); });
            Route::get('/beyond-beginner-drumming/', function () { return view('drumeo.products.full-page-assets.beyond-beginner-drumming'); });
            Route::get('/comfort-cover', function () { return view('drumeo.products.full-page-assets.comfort-cover'); });
            Route::get('/drum-technique-made-easy', function () { return view('drumeo.products.full-page-assets.drum-technique-made-easy'); });
            Route::get('/drumming-system-discount', function () { return view('drumeo.products.full-page-assets.drumming-system-discount'); });
            Route::get('/drumsticks', function () { return view('drumeo.products.full-page-assets.drumsticks'); });
            Route::get('/electrify-your-drumming', function () { return view('drumeo.products.full-page-assets.electrify-your-drumming'); });
            Route::get('/eardrums', [SalesController::class, 'eardrums'] );
            Route::get('/festival-videos', function () { return view('drumeo.products.full-page-assets.festival-videos'); });
            Route::get('/independence-made-easy', function () { return view('drumeo.products.full-page-assets.independence-made-easy'); });
            Route::get('/learn-songs-faster', function () { return view('drumeo.products.full-page-assets.learn-songs-faster'); });
            Route::get('/new-drummers/', function () { return view('drumeo.products.full-page-assets.new-drummers'); });
            Route::get('/practice-pad-full', function () { return view('drumeo.products.full-page-assets.practice-pad-full'); });
            Route::get('/quietpad', function () { return view('drumeo.products.full-page-assets.quietpad'); });
            Route::get('/rock-drumming-masterclass', function () { return view('drumeo.products.full-page-assets.rock-drumming-masterclass'); });
            Route::get('/successful-drumming-discount', function () { return view('drumeo.products.full-page-assets.successful-drumming-discount'); });
            Route::get('/the-drummers-toolbox', function () { return view('drumeo.products.full-page-assets.the-drummers-toolbox'); });
            Route::get('/quietkick', [SalesController::class, 'quietKick'] );
            Route::get('/tone-control-kit', [SalesController::class, 'toneControl'] );
            Route::get('/tony-royster-jr', function () { return view('drumeo.products.full-page-assets.tony-royster-jr'); });
        }
    );
});
