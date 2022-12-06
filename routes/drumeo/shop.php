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
        }
    );
    Route::get('/drumshop/{productslug}', [ShopController::class, 'product']);
});
