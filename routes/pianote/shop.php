<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Pianote\ShopController;
use App\Http\Controllers\Pianote\SalesController;

Route::domain('{pianoteDomain}')
    ->middleware(['web_public'])
    ->group(function () {
    Route::group(['prefix' => 'shop' ],
        function () {
            Route::get('/concert-headphones', [SalesController::class, 'concertHeadphones']);
        }
    );


    Route::get('/{category}', [ShopController::class, 'shop'])
        ->whereIn('category', ['shop', 'lessons', 'accessories', 'clothing']);;

    Route::get('/shop/{productslug}', [ShopController::class, 'product']);
});
