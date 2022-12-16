<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Singeo\SalesController;
use App\Http\Controllers\Singeo\LeadGenController;

Route::domain('{singeoDomain}')
    ->middleware(['web_public'])
    ->group(function () {
    Route::get('/', [SalesController::class, 'home']);
    Route::get('/support', function () { return view('singeo.sales.pages.support'); } );
    Route::get('/student-only', function () { return view('singeo.sales.student-only'); } );
    Route::get('/privacy', function () { return view('singeo.sales.pages.privacy'); } );
    Route::get('/terms', function () { return view('singeo.sales.pages.terms'); } );
    Route::get('/trial', function () { return view('singeo.sales.trials.trial'); } );
    Route::get('/trial-month', function () { return view('singeo.sales.trials.30-trial'); } );
    Route::get('/choose-your-trial', function () { return view('singeo.sales.trials.trial-selection.week'); } );
    Route::get('/choose-your-trial-month', function () { return view('singeo.sales.trials.trial-selection.month'); } );
    Route::get('/cookie', function () { return view('singeo.sales.pages.cookie'); } );

    Route::get('/affiliate/asobergirlsguide', function () { return view('singeo.sales.trials.affiliates.asobergirlsguide'); });
    Route::get('/affiliate-trial', function () { return view('singeo.sales.trials.trial-selection.affiliates'); });

    Route::group(['prefix' => 'preferences' ], function () {
        Route::get('/beginner', function () { return view('singeo.lead-gen.self-segmentaion.beginner'); });
        Route::get('/intermediate', function () { return view('singeo.lead-gen.self-segmentaion.intermediate'); });
        Route::get('/professionals', function () { return view('singeo.lead-gen.self-segmentaion.professional'); });
    });

    Route::get('/thank-you', function () { return view('singeo.lead-gen.thank-you'); });
    Route::get('/subscribed', function () { return view('singeo.lead-gen.subscribed'); });
    Route::get('/lets-sing-a-song', function () { return view('singeo.lead-gen.lets-sing-a-song'); });
    Route::get('/welcome-party', function () { return view('singeo.lead-gen.welcome-party'); });
    Route::get('/shop/singing-starter-kit', function () { return view('singeo.products.singing-starter-kit'); });
    Route::get('/singingstarterkit', function () { return view('singeo.products.singing-starter-kit-alt'); });
    Route::get('/singing-starter-kit-discount', function () { return view('singeo.products.singing-starter-kit-discount'); });
    Route::get('/singing-starter-kit-shyv-discount', function () { return view('singeo.products.singing-starter-kit-shyv-discount'); });
    Route::get('/recitals', function () { return view('singeo.lead-gen.recitals'); });
    Route::get('/giveaway', function () { return view('singeo.lead-gen.giveaway'); });
        Route::get('/ultimate-giveaway', function () { return view('lead-gen.ultimate-giveaway'); });


    // redirect pages
    Route::get('/beginner-bundle', function(){ return redirect('/shop/beginner-bundle'); });
    Route::get('/love-to-sing-bundle', function(){ return redirect('/shop/love-to-sing-bundle'); });

    Route::group(['prefix' => 'beginner-vocal-bootcamp'],
        function () {
            Route::get('/{page?}', LeadGenController::class . '@beginnerBootcamp')
                ->whereIn('page', [
                    null, 'zoom'
                ]);
        }
    );
    Route::group(['prefix' => 'holiday-karaoke'],
        function () {
            Route::get('/{page?}', LeadGenController::class . '@holidayKaraoke')
                ->whereIn('page', [
                    null, 'unlocked'
                ]);
        }
    );
    Route::group(['prefix' => 'improve-any-voice'],
        function () {
            Route::get('/{page?}/{lesson?}', LeadGenController::class . '@improveAnyVoice')
                ->whereIn('page', [
                    null, 'lessons'
                ])
                ->whereIn('lesson', [
                    null, '1', '2', '3', '4', '5', '6', '7'
                ]);
        }
    );
    Route::group(['prefix' => 'live-vocal-bootcamp'],
        function () {
            Route::get('/{page?}', LeadGenController::class . '@liveBootcamp')
                ->whereIn('page', [
                    null, 'zoom'
                ]);
        }
    );
    Route::group(['prefix' => 'stop-hating-your-voice'],
        function () {
            Route::get('/{page?}/{lesson?}', LeadGenController::class . '@stopHatingVoice')
                ->whereIn('page', [
                    null, 'lessons'
                ])
                ->whereIn('lesson', [
                    null, '1', '2', '3'
                ]);
        }
    );

    Route::get('/beautiful-harmonies', function () { return view('singeo.products.beautiful-harmonies'); } );
});

