<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Drumeo\ShopController;
use App\Http\Controllers\Drumeo\SalesController;

Route::domain('{drumeoDomain}')->middleware(['web_public'])->group(function () {
    Route::get('{category}', [ShopController::class, 'shop'])->whereIn('category', [
        'drumshop', 'lessons', 'accessories', 'clothing', 'gifts'
    ]);

    Route::group(['prefix' => 'drumshop' ], function () {
        Route::get('/gift-card', [SalesController::class, 'giftCard']);
        Route::get('/{page?}', ShopController::class . '@products')->whereIn('page', [
            '100-grooves',
            'beginner-book',
            'better-drum-fills',
            'better-drum-fills-giveaway',
            'beyond-beginner-drumming',
            'challenges-bundle',
            'comfort-cover',
            'drum-technique-made-easy',
            'drumeo-deal',
            'drumsticks',
            'easy-rudiments',
            'electrify-your-drumming',
            'festival-videos',
            'gift-bundle',
            'independence-made-easy',
            'learn-songs-faster',
            'new-drummers',
            'padstand',
            'practice-bundle',
            'practice-pad-full',
            'quietkick',
            'quietpad',
            'rock-drumming-masterclass',
            'stickbag',
            'stickbag-ltd',
            'stickbag-members',
            'successful-drumming',
            'the-drummers-toolbox',
            'tone-control-kit',
            'tony-royster-jr',
            'ultimate-bundle',
        ]);
        Route::get('/eardrums', [SalesController::class, 'eardrums']);
        Route::get('/kit', [SalesController::class, 'kit']);
        Route::get('/kit-lifetime', [SalesController::class, 'kitLifetime']);
        Route::get('/30-day-drummer', [SalesController::class, 'thirtyDayDrummerEG']);
        Route::get('/30-day-drummer/deal', [SalesController::class, 'thirtyDayDrummerDeal']);
        Route::get('/30-day-chops', [SalesController::class, 'thirtyDayChops']);
        Route::get('/30-day-chops/deal', [SalesController::class, 'thirtyDayChopsDeal']);
        Route::get('/30-day-independence', [SalesController::class, 'thirtyDayIndependence']);
        Route::get('/30-day-double-bass', [SalesController::class, 'thirtyDayDoubleBass']);
        Route::get('/30-day-jazz', [SalesController::class, 'thirtyDayJazz']);
        Route::get('/30-day-independence/deal', [SalesController::class, 'thirtyDayIndependenceDeal']);
        Route::get('/5-for-3-bundle', [SalesController::class, 'fiveforthreeBundle']);
        Route::get('/headphones', [SalesController::class, 'headphones']);
        Route::get('/{productslug}', [ShopController::class, 'product']);
    });
});
