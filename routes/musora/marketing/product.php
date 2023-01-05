<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Musora\ProductPagesController;
use App\Modules\Brand\Enums\Brand;

Route::middleware(['web_public'])
    ->group(function () {
        Route::get('{brand}/{category}', [ProductPagesController::class, 'products'])
            ->whereIn('brand', ['pianote', 'drumeo', 'singeo', 'guitareo'])
            ->whereIn('category', ['shop', 'lessons', 'accessories', 'clothing'])
            ->name('marketing.products');


        /*---- CUSTOM PRODUCT PAGE ----*/
//Drumeo
        Route::get('drumeo/shop/new-drummers', [ProductPagesController::class, 'newdrummers'] );
        Route::get('drumeo/shop/rock-drumming-masterclass', [ProductPagesController::class, 'rockdrummingmasterclass'] );
        Route::get('drumeo/shop/drum-technique-made-easy', [ProductPagesController::class, 'drumtechniquemadeeasy'] );
        Route::get('drumeo/shop/beyond-beginner-drumming', [ProductPagesController::class, 'beyondbeginnerdrumming'] );
        Route::get('drumeo/shop/independence-made-easy', [ProductPagesController::class, 'independencemadeeasy'] );
        Route::get('drumeo/shop/learn-songs-faster', [ProductPagesController::class, 'learnsongsfaster'] );
        Route::get('drumeo/shop/better-drum-fills', [ProductPagesController::class, 'betterdrumfills'] );
        Route::get('drumeo/shop/electrify-your-drumming', [ProductPagesController::class, 'electrifyyourdrumming'] );
        Route::get('drumeo/shop/successful-drumming-discount', [ProductPagesController::class, 'successfuldrummingdiscount'] );
        Route::get('drumeo/shop/drumming-system-discount', [ProductPagesController::class, 'drummingsystemdiscount'] );
        Route::get('drumeo/shop/quietkick', [ProductPagesController::class, 'quietkick'] );
        Route::get('drumeo/shop/eardrums', [ProductPagesController::class, 'eardrums'] );
        Route::get('drumeo/shop/tone-control-kit', [ProductPagesController::class, 'tonecontrolkit'] );
        Route::get('drumeo/shop/drumsticks', [ProductPagesController::class, 'drumsticks'] );
        Route::get('drumeo/shop/practice-pad-full', [ProductPagesController::class, 'practicepadfull'] );
        Route::get('drumeo/shop/quietpad', [ProductPagesController::class, 'quietpad'] );
        Route::get('drumeo/shop/the-drummers-toolbox', [ProductPagesController::class, 'thedrummerstoolbox'] );
        Route::get('drumeo/shop/beginner-book', [ProductPagesController::class, 'beginnerbook'] );
        Route::get('drumeo/shop/30-day-drummer', [ProductPagesController::class, 'thirtydaydrummer'] );

//Pianote
        Route::get('pianote/shop/play-beautiful-piano', [ProductPagesController::class, 'playbeautifulpiano'] );
        Route::get('pianote/shop/500-songs', [ProductPagesController::class, 'songs500'] );
        Route::get('pianote/shop/worship-piano', [ProductPagesController::class, 'worshippiano'] );
        Route::get('pianote/shop/piano-technique-made-easy', [ProductPagesController::class, 'pianotechniquemadeeasy'] );
        Route::get('pianote/shop/destupefy-your-left-hand', [ProductPagesController::class, 'destupefyyourlefthand'] );
        Route::get('pianote/shop/faster-fingers', [ProductPagesController::class, 'fasterfingers'] );
        Route::get('pianote/shop/riffs-and-fills', [ProductPagesController::class, 'riffsandfills'] );
        Route::get('pianote/shop/beginner-classical-piano', [ProductPagesController::class, 'beginnerclassicalpiano'] );
        Route::get('pianote/shop/the-power-of-chords', [ProductPagesController::class, 'thepowerofchords'] );
        Route::get('pianote/shop/the-power-of-chords-bootcamp', [ProductPagesController::class, 'thepowerofchordsbootcamp'] );

//Guitareo
        Route::get('guitareo/shop/rhythm-and-groove', [ProductPagesController::class, 'rhythmandgroove'] );
        Route::get('guitareo/shop/guitar-technique-made-easy', [ProductPagesController::class, 'guitartechniquemadeeasy'] );
        Route::get('guitareo/shop/acoustic-guitar-made-easy', [ProductPagesController::class, 'acousticguitarmadeeasy'] );
        Route::get('guitareo/shop/guitar-system', [ProductPagesController::class, 'guitarsystem'] );
        Route::get('guitareo/shop/guitar-quest', [ProductPagesController::class, 'guitarquest'] );
        Route::get('guitareo/shop/500-songs', [ProductPagesController::class, 'guitareosongs500'] );

//Singeo
        Route::get('singeo/shop/singing-starter-kit', [ProductPagesController::class, 'singingstarterkit'] );

        Route::get('{brand}/shop/{product:slug}', [ProductPagesController::class, 'product'])
            ->whereIn('brand', all_brands())
            ->name('marketing.product');
    });

