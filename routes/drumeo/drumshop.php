<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Drumeo\DrumshopController;

Route::domain('{drumeoDomain}')->group(function () {

    Route::get('/jared-recommends', function () { return view('drumshop.jared-recommends'); });

    Route::group(['prefix' => 'drumshop'],
        function () {
            Route::get('/30-day-drummer', [DrumshopController::class, 'thirtyDayDrummer'] );
            Route::get('/30-day-drummer/deal', function () { return view('lead-gen.pages.30-day-drummer-deal'); });
            Route::get('/beginner-book', function () { return view('products.full-page-assets.beginner-book'); });
            Route::get('/better-drum-fills', function () { return view('products.full-page-assets.better-drum-fills'); });
            Route::get('/beyond-beginner-drumming/', function () { return view('products.full-page-assets.beyond-beginner-drumming'); });
            Route::get('/comfort-cover', function () { return view('products.full-page-assets.comfort-cover'); });
            Route::get('/drum-technique-made-easy', function () { return view('products.full-page-assets.drum-technique-made-easy'); });
            Route::get('/drumming-system-discount', function () { return view('products.full-page-assets.drumming-system-discount'); });
            Route::get('/drumsticks', function () { return view('products.full-page-assets.drumsticks'); });
            Route::get('/electrify-your-drumming', function () { return view('products.full-page-assets.electrify-your-drumming'); });
            Route::get('/eardrums', [DrumshopController::class, 'eardrums'] );
            Route::get('/festival-videos', function () { return view('products.full-page-assets.festival-videos'); });
            Route::get('/independence-made-easy', function () { return view('products.full-page-assets.independence-made-easy'); });
            Route::get('/learn-songs-faster', function () { return view('products.full-page-assets.learn-songs-faster'); });
            Route::get('/new-drummers/', function () { return view('products.full-page-assets.new-drummers'); });
            Route::get('/practice-pad-full', function () { return view('products.full-page-assets.practice-pad-full'); });
            Route::get('/quietpad', function () { return view('products.full-page-assets.quietpad'); });
            Route::get('/rock-drumming-masterclass', function () { return view('products.full-page-assets.rock-drumming-masterclass'); });
            Route::get('/successful-drumming-discount', function () { return view('products.full-page-assets.successful-drumming-discount'); });
            Route::get('/the-drummers-toolbox', function () { return view('products.full-page-assets.the-drummers-toolbox'); });
            Route::get('/quietkick', [DrumshopController::class, 'quietKick'] );
            Route::get('/tone-control-kit', [DrumshopController::class, 'toneControl'] );
            Route::get('/tony-royster-jr', function () { return view('products.full-page-assets.tony-royster-jr'); });
        }
    );
});
