<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Drumeo\SalesController;

Route::domain('{drumeoDomain}')
    ->middleware(['web_public'])
    ->group(function () {
    Route::get('/referral-join', [
        'as' => 'referral.invite-a-friend-landing',
        'uses' => App\Http\Controllers\Profiles\ReferralController::class . '@join',
    ]);
    Route::get('/', [SalesController::class, 'sales'] );
    Route::get('/anniversary-deal', [SalesController::class, 'sales'] );
    Route::get('/mydrumset', [SalesController::class, 'sales'] );
    Route::get('/student-only', [SalesController::class, 'salesStudents'] );
    Route::get('/upgrade-offer', [SalesController::class, 'salesUpgrade'] );
    Route::get('/lifetime', [SalesController::class, 'salesUpgradeLifetime'] );
    Route::get('/festival/', [SalesController::class, 'Festival'] );
    Route::post('/hlag-submit/', [SalesController::class, 'hitLikeAGirlSubmission'] );

    //    sales pages
    Route::get('/beginner', [SalesController::class, 'beginner']);
    Route::get('/songs', [SalesController::class, 'songs']);
    Route::get('/impact', [SalesController::class, 'impact']);
    Route::get('/about', [SalesController::class, 'about']);
    Route::get('/privacy', [SalesController::class, 'privacy']);
    Route::get('/terms', [SalesController::class, 'terms']);
    Route::get('/cookie', [SalesController::class, 'cookie']);
    Route::get('/app', [SalesController::class, 'app']);
    Route::get('/kids', [SalesController::class, 'kids']);
    Route::get('/song-demo/', [SalesController::class, 'songDemo']);
    Route::get('/tom-sawyer/', [SalesController::class, 'tomSawyer']);
    Route::get('/drumfest', [SalesController::class, 'drumFest']);

    Route::get('/trial', [SalesController::class, 'trial']);
    Route::get('/earthworks', [SalesController::class, 'earthWorks']);
    Route::get('/coaches-quiz', [SalesController::class, 'coachesQuiz']);
    Route::get('/30-day-trial', [SalesController::class, 'thirtyDayTrial']);
    Route::get('/melodics', [SalesController::class, 'melodics']);
    Route::get('/new-drummers-trial', [SalesController::class, 'newDrummerTrial']);
    Route::get('/power-pack', [SalesController::class, 'powerPack']);
    Route::get('/bestbook-trial', [SalesController::class, 'bestBookTrial']);
    Route::get('/toolbox-trial', [SalesController::class, 'toolBoxTrial']);
    Route::get('/vdrums', [SalesController::class, 'vDrums']);
    Route::get('/sonor/', [SalesController::class, 'sonor']);
    Route::get('/coach-trial', function () { return view('drumeo.sales.trials.trial-selection.coach-trial'); });
    Route::get('/choose-your-trial', function () { return view('drumeo.sales.trials.trial-selection.choose-your-trial'); });
    Route::get('/earthworks-trial', function () { return view('drumeo.sales.trials.trial-selection.earthworks-trial'); });
    Route::get('/coaches-quiz-trial', function () { return view('drumeo.sales.trials.trial-selection.coaches-quiz-trial'); });
    Route::get('/choose-your-trial-month', function () { return view('drumeo.sales.trials.trial-selection.choose-your-trial-month'); });
    Route::get('/melodics-trial', function () { return view('drumeo.sales.trials.trial-selection.melodics-trial'); });
    Route::get('/new-drummers-trial-month', function () { return view('drumeo.sales.trials.trial-selection.new-drummers-trial-month'); });
    Route::get('/affiliate-trial', function () { return view('drumeo.sales.trials.trial-selection.affiliate-trial'); });

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
    Route::get('/estepario', function () { return view('drumeo.sales.trials.affiliate.estepario'); });
    Route::group(['prefix' => 'a' ],
        function () {
            Route::get('/66samus', function () { return view('drumeo.sales.trials.affiliate.66samus'); });
            Route::get('/adriendrums', function () { return view('drumeo.sales.trials.affiliate.adriendrums'); });
            Route::get('/alejandrosifuentes', function () { return view('drumeo.sales.trials.affiliate.alejandrosifuentes'); });
            Route::get('/brandonscott', function () { return view('drumeo.sales.trials.affiliate.brandonscott'); });
            Route::get('/cooperdrummer', function () { return view('drumeo.sales.trials.affiliate.cooperdrummer'); });
            Route::get('/davidcola', function () { return view('drumeo.sales.trials.affiliate.davidcola'); });
            Route::get('/drumhelper', function () { return view('drumeo.sales.trials.affiliate.drumhelper'); });
            Route::get('/joshcrawford', function () { return view('drumeo.sales.trials.affiliate.joshcrawford'); });
            Route::get('/leviclay', function () { return view('drumeo.sales.trials.affiliate.leviclay'); });
            Route::get('/linaanderberg', function () { return view('drumeo.sales.trials.affiliate.linaanderberg'); });
            Route::get('/rdavidr', function () { return view('drumeo.sales.trials.affiliate.rdavidr'); });
            Route::get('/robbrown', function () { return view('drumeo.sales.trials.affiliate.robbrown'); });
            Route::get('/the8bitdrummer', function () { return view('drumeo.sales.trials.affiliate.the8bitdrummer'); });
            Route::get('/worshipdrummer', function () { return view('drumeo.sales.trials.affiliate.worshipdrummer'); });
            Route::get('/wyattstav', function () { return view('drumeo.sales.trials.affiliate.wyattstav'); });
            Route::get('/zackgrooves', function () { return view('drumeo.sales.trials.affiliate.zackgrooves'); });
        }
    );
    Route::group(['prefix' => 'affiliate' ],
        function () {
            Route::get('/andrewrooney', function () { return view('drumeo.sales.trials.affiliate.andrewrooney'); });
            Route::get('/asobergirlsguide', function () { return view('drumeo.sales.trials.affiliate.asobergirlsguide'); });
            Route::get('/bhcollective', function () { return view('drumeo.sales.trials.affiliate.bhcollective'); });
            Route::get('/bryanforcedrums', function () { return view('drumeo.sales.trials.affiliate.bryanforcedrums'); });
            Route::get('/drummingreview', function () { return view('drumeo.sales.trials.affiliate.drummingreview'); });
            Route::get('/drumninja', function () { return view('drumeo.sales.trials.affiliate.drumninja'); });
            Route::get('/electronicdrumadvisor', function () { return view('drumeo.sales.trials.affiliate.electronicdrumadvisor'); });
            Route::get('/jessica-burdeaux', function () { return view('drumeo.sales.trials.affiliate.jessica-burdeaux'); });
            Route::get('/kylemcgrail', function () { return view('drumeo.sales.trials.affiliate.kylemcgrail'); });
            Route::get('/leyandrums', function () { return view('drumeo.sales.trials.affiliate.leyandrums'); });
            Route::get('/lindseyward', function () { return view('drumeo.sales.trials.affiliate.lindseyward'); });
            Route::get('/musicindustryhowto', function () { return view('drumeo.sales.trials.affiliate.musicindustryhowto'); });
            Route::get('/rickyficarelli', function () { return view('drumeo.sales.trials.affiliate.rickyficarelli'); });
            Route::get('/tobines', function () { return view('drumeo.sales.trials.affiliate.tobines'); });
        }
    );

    Route::get('/30-day-drummer-register-endpoint', [SalesController::class, 'registerFor30DayDrummer'] );
    Route::get('/pro/', function () { return view('drumeo.products.pro'); });
    Route::get('/jared-recommends', function () { return view('drumeo.drumshop.jared-recommends'); });

    Route::group(['prefix' => 'drumshop'],
        function () {
            Route::get('/30-day-drummer', [SalesController::class, 'thirtyDayDrummer'] );
            Route::get('/eardrums', [SalesController::class, 'eardrums'] );
            Route::get('/quietkick', [SalesController::class, 'quietKick'] );
            Route::get('/tone-control-kit', [SalesController::class, 'toneControl'] );
            Route::get('/beginner-book', function () { return view('drumeo.products.beginner-book'); });
            Route::get('/better-drum-fills', function () { return view('drumeo.products.better-drum-fills'); });
            Route::get('/beyond-beginner-drumming/', function () { return view('drumeo.products.beyond-beginner-drumming'); });
            Route::get('/comfort-cover', function () { return view('drumeo.products.comfort-cover'); });
            Route::get('/drum-technique-made-easy', function () { return view('drumeo.products.drum-technique-made-easy'); });
            Route::get('/drumming-system-discount', function () { return view('drumeo.products.drumming-system-discount'); });
            Route::get('/drumsticks', function () { return view('drumeo.products.drumsticks'); });
            Route::get('/electrify-your-drumming', function () { return view('drumeo.products.electrify-your-drumming'); });
            Route::get('/festival-videos', function () { return view('drumeo.products.festival-videos'); });
            Route::get('/independence-made-easy', function () { return view('drumeo.products.independence-made-easy'); });
            Route::get('/learn-songs-faster', function () { return view('drumeo.products.learn-songs-faster'); });
            Route::get('/new-drummers/', function () { return view('drumeo.products.new-drummers'); });
            Route::get('/practice-pad-full', function () { return view('drumeo.products.practice-pad-full'); });
            Route::get('/quietpad', function () { return view('drumeo.products.quietpad'); });
            Route::get('/rock-drumming-masterclass', function () { return view('drumeo.products.rock-drumming-masterclass'); });
            Route::get('/successful-drumming-discount', function () { return view('drumeo.products.successful-drumming-discount'); });
            Route::get('/the-drummers-toolbox', function () { return view('drumeo.products.the-drummers-toolbox'); });
            Route::get('/tony-royster-jr', function () { return view('drumeo.products.tony-royster-jr'); });
        }
    );
});
