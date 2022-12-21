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
    Route::get('/coach-trial', [SalesController::class, 'coachTrial']);
    Route::get('/choose-your-trial', [SalesController::class, 'chooseTrial']);
    Route::get('/earthworks-trial', [SalesController::class, 'earthWorksTrial']);
    Route::get('/coaches-quiz-trial', [SalesController::class, 'coachQuizTrial']);
    Route::get('/choose-your-trial-month', [SalesController::class, 'chooseTrialMonth']);
    Route::get('/melodics-trial', [SalesController::class, 'melodicTrial']);
    Route::get('/new-drummers-trial-month', [SalesController::class, 'newDrummerTrialMonth']);
    Route::get('/affiliate-trial', [SalesController::class, 'affiliateTrial']);

    Route::get('/aric', [SalesController::class, 'aric']);
    Route::get('/domino', [SalesController::class, 'domino']);
    Route::get('/dorothea', [SalesController::class, 'dorothea']);
    Route::get('/jared', [SalesController::class, 'jared']);
    Route::get('/john', [SalesController::class, 'jared']);
    Route::get('/kaz', [SalesController::class, 'kaz']);
    Route::get('/larnell', [SalesController::class, 'larnell']);
    Route::get('/matt', [SalesController::class, 'matt']);
    Route::get('/sarah', [SalesController::class, 'sarah']);
    Route::get('/schack', [SalesController::class, 'schack']);
    Route::get('/sharon', [SalesController::class, 'sharon']);
    Route::get('/todd', [SalesController::class, 'todd']);
    Route::get('/estepario', function () { return view('drumeo.sales.trials.affiliate.estepario'); });
    Route::group(['prefix' => 'a' ],
        function () {
            Route::get('/{page?}', SalesController::class . '@a')
                ->whereIn('page', [
                    '66samus', 'adriendrums', 'alejandrosifuentes', 'brandonscott', 'cooperdrummer', 'davidcola', 'drumhelper', 'joshcrawford', 'leviclay', 'linaanderberg', 'rdavidr', 'robbrown', 'the8bitdrummer', 'worshipdrummer', 'wyattstav', 'zackgrooves'
                ]);
        }
    );
    Route::group(['prefix' => 'affiliate' ],
        function () {
            Route::get('/{page?}', SalesController::class . '@affiliates')
                ->whereIn('page', [
                    'andrewrooney', 'asobergirlsguide', 'bhcollective', 'bryanforcedrums', 'drummingreview', 'drumninja', 'electronicdrumadvisor', 'jessica-burdeaux', 'kylemcgrail', 'leyandrums', 'lindseyward', 'musicindustryhowto', 'rickyficarelli', 'tobines'
                ]);
        }
    );

    Route::get('/30-day-drummer-register-endpoint', [SalesController::class, 'registerFor30DayDrummer'] );
    Route::get('/pro/', [SalesController::class, 'pro']);
    Route::get('/jared-recommends', [SalesController::class, 'jaredRecommends']);

    Route::group(['prefix' => 'drumshop'],
        function () {
            Route::get('/{page?}', SalesController::class . '@products')
                ->whereIn('page', [
                    'beginner-book', 'better-drum-fills', 'beyond-beginner-drumming', 'comfort-cover', 'drum-technique-made-easy', 'drumming-system-discount', 'drumsticks', 'electrify-your-drumming', 'festival-videos', 'independence-made-easy', 'learn-songs-faster', 'new-drummers', 'practice-pad-full', 'quietpad', 'rock-drumming-masterclass', 'successful-drumming-discount', 'the-drummers-toolbox', 'tony-royster-jr'
                ]);

            Route::get('/30-day-drummer', [SalesController::class, 'thirtyDayDrummer'] );
            Route::get('/eardrums', [SalesController::class, 'eardrums'] );
            Route::get('/quietkick', [SalesController::class, 'quietKick'] );
            Route::get('/tone-control-kit', [SalesController::class, 'toneControl'] );
        }
    );
});
