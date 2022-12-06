<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Pianote\ShopController;
use App\Http\Controllers\Pianote\SalesController;

Route::domain('{pianoteDomain}')
    ->middleware(['web_public'])
    ->group(function () {
    Route::get('/shop', [ShopController::class, 'shop']);

    Route::get('/shop/{productslug}', [ShopController::class, 'product']);

        Route::group(['prefix' => 'shop' ],
            function () {
                Route::get('/concer-headphones', [SalesController::class, 'concertHeadphones']);

            }
        );
});
