<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Drumeo\ShopController;
use App\Http\Controllers\Drumeo\SalesController;

Route::domain('{drumeoDomain}')
    ->middleware(['web_public'])
    ->group(function () {
    Route::get('{category}', [ShopController::class, 'shop'])
        ->whereIn('category', ['drumshop', 'lessons', 'accessories', 'clothing']);

    Route::group(['prefix' => 'drumshop' ],
        function () {
            Route::get('/drumming-system', [SalesController::class, 'drummingSystem']);
            Route::get('/gift-card', [SalesController::class, 'giftCard']);
            Route::get('/{page?}', ShopController::class . '@products')
                ->whereIn('page', [
                    'beginner-book', 'better-drum-fills', 'better-drum-fills-giveaway', 'beyond-beginner-drumming', 'comfort-cover', 'drum-technique-made-easy', 'drumsticks', 'easy-rudiments', 'electrify-your-drumming', 'festival-videos', 'independence-made-easy', 'learn-songs-faster', 'new-drummers', 'padstand', 'practice-pad-full', 'quietpad', 'rock-drumming-masterclass', 'successful-drumming', 'stickbag', 'stickbag-members', 'stickbag-ltd', 'the-drummers-toolbox', 'tony-royster-jr'
                ]);

            Route::get('/30-day-drummer', [SalesController::class, 'thirtyDayDrummer'] );
            Route::get('/30-day-drummer/deal', [SalesController::class, 'thirtyDayDrummerDeal'] );
            Route::get('/30-day-chops', [SalesController::class, 'thirtyDayChops'] );
            Route::get('/30-day-chops/deal', [SalesController::class, 'thirtyDayChopsDeal'] );
            Route::get('/eardrums', [SalesController::class, 'eardrums'] );
            Route::get('/quietkick', [SalesController::class, 'quietKick'] );
            Route::get('/tone-control-kit', [SalesController::class, 'toneControl'] );
            Route::get('/{productslug}', [ShopController::class, 'product']);
        }
    );

});
