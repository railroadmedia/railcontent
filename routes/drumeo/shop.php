<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Drumeo\ShopController;

Route::domain('{drumeoDomain}')
    ->middleware(['web_public'])
    ->group(function () {
    Route::get('{category}', [ShopController::class, 'shop'])
        ->whereIn('category', ['drumshop', 'lessons', 'accessories', 'clothing']);

    Route::group(['prefix' => 'drumshop' ],
        function () {
            Route::get('/drumming-system', function () { return view('drumeo.drumshop.pages.drumming-system', ['theme' => 'drumeo']); });
            Route::get('/gift-card', function () { return view('drumeo.drumshop.pages.gift-card', ['theme' => 'drumeo']); });
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
    Route::get('/drumshop/{productslug}', [ShopController::class, 'product']);
});
