<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Musora\ProductPagesController;
use App\Modules\Brand\Enums\Brand;
use App\Http\Controllers\Drumeo\SalesController;

Route::domain('{musoraDomain}')
    ->middleware(['web_public'])
    ->group(function () {
//        Route::get('{brand}/{category}', [ProductPagesController::class, 'products'])
//            ->whereIn('brand', ['pianote', 'drumeo', 'singeo', 'guitareo'])
//            ->whereIn('category', ['shop', 'lessons', 'accessories', 'clothing'])
//            ->name('marketing.products');

        Route::get('/30-day-drummer', [SalesController::class, 'thirtyDayDrummer']);

        Route::get('/merch', [ProductPagesController::class, 'shopAlt']);
        Route::get('/shop/{slug}', [ProductPagesController::class, 'productAlt']);

    });

