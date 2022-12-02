<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Pianote\ShopController;

Route::domain('{pianoteDomain}')
    ->middleware(['web_public'])
    ->group(function () {
    Route::get('/shop', [ShopController::class, 'shop']);

    Route::get('/shop/{productslug}', [ShopController::class, 'product']);
});
