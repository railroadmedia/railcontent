<?php

use Illuminate\Support\Facades\Route;

Route::domain('{musoraDomain}')
    ->middleware(['web_public'])
    ->group(function () {
        Route::get('/order/{brand}', [\App\Http\Controllers\Ecommerce\OrderController::class, 'showOrderForm'])
            ->name('order-form');
    });


Route::middleware(['web_public'])
    ->group(function () {
        Route::get('/order', [\App\Http\Controllers\Ecommerce\OrderController::class, 'redirectToMusoraOrderForm'])
            ->name('brand-order-form-redirect-to-musora');
    });
