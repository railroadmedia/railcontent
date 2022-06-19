<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Musora\ProductPagesController;
use App\Modules\Brand\Enums\Brand;

Route::get('{brand}/shop', [ProductPagesController::class, 'products'])
    ->whereIn('brand', all_brands())
    ->name('marketing.products');

//custom product pages



Route::get('{brand}/shop/{product:slug}', [ProductPagesController::class, 'product'])
    ->whereIn('brand', all_brands())
    ->name('marketing.product');






