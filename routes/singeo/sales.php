<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Singeo\SalesController;

Route::domain('{singeoDomain}')
    ->middleware(['web_public'])
    ->group(function () {
    Route::get('/', [SalesController::class, 'home']);
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

    Route::get('/beginner-vocal-bootcamp', function () { return view('singeo.lead-gen.beginner-vocal-bootcamp.beginner-vocal-bootcamp'); } );
    Route::get('/beginner-vocal-bootcamp/zoom', function () { return view('singeo.lead-gen.beginner-vocal-bootcamp.zoom'); } );

    Route::get('/live-vocal-bootcamp', function () { return view('singeo.lead-gen.live-vocal-bootcamp.live-vocal-bootcamp'); } );
    Route::get('/live-vocal-bootcamp/zoom', function () { return view('singeo.lead-gen.live-vocal-bootcamp.zoom'); } );

    Route::get('/live-bootcamp', function () { return view('singeo.lead-gen.harmony-bootcamp.harmony-bootcamp'); } );
    Route::get('/live-bootcamp/zoom', function () { return view('singeo.lead-gen.harmony-bootcamp.zoom'); } );

    Route::get('/holiday-karaoke', function () { return view('singeo.lead-gen.holiday-karaoke.signup'); } );
    Route::get('/holiday-karaoke/unlocked', function () { return view('singeo.lead-gen.holiday-karaoke.unlocked'); } );

    Route::get('/beautiful-harmonies', function () { return view('singeo.products.beautiful-harmonies'); } );

    Route::group(['prefix' => 'improve-any-voice' ], function () {
        Route::get('/', function () { return view('singeo.lead-gen.improve-any-voice.signup'); });
        Route::group(['prefix' => 'lessons' ],
            function () {
                Route::get('/', function () { return view('singeo.lead-gen.improve-any-voice.lessons.1'); });
                Route::get('/1', function () { return view('singeo.lead-gen.improve-any-voice.lessons.1'); });
                Route::get('/2', function () { return view('singeo.lead-gen.improve-any-voice.lessons.2'); });
                Route::get('/3', function () { return view('singeo.lead-gen.improve-any-voice.lessons.3'); });
                Route::get('/4', function () { return view('singeo.lead-gen.improve-any-voice.lessons.4'); });
                Route::get('/5', function () { return view('singeo.lead-gen.improve-any-voice.lessons.5'); });
                Route::get('/6', function () { return view('singeo.lead-gen.improve-any-voice.lessons.6'); });
                Route::get('/7', function () { return view('singeo.lead-gen.improve-any-voice.lessons.7'); });
            });
    });

    Route::group(['prefix' => 'stop-hating-your-voice' ], function () {
        Route::get('/', function () { return view('singeo.lead-gen.stop-hating-your-voice.signup'); });
        Route::group(['prefix' => 'lessons' ],
            function () {
                Route::get('/', function () { return view('singeo.lead-gen.stop-hating-your-voice.lesson-index'); });
                Route::get('/1', function () { return view('singeo.lead-gen.stop-hating-your-voice.lessons.1'); });
                Route::get('/2', function () { return view('singeo.lead-gen.stop-hating-your-voice.lessons.2'); });
                Route::get('/3', function () { return view('singeo.lead-gen.stop-hating-your-voice.lessons.3'); });
            });
    });
});

