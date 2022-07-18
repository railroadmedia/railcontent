<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Musora\ProductPagesController;
use App\Modules\Brand\Enums\Brand;

Route::get('{brand}/shop', [ProductPagesController::class, 'products'])
    ->whereIn('brand', all_brands())
    ->name('marketing.products');

//custom product pages
Route::get('drumeo/shop/new-drummers', function(){ return view('drumeo.products.full-page-assets.new-drummers'); });
Route::get('drumeo/shop/rock-drumming-masterclass', function(){ return view('drumeo.products.full-page-assets.rock-drumming-masterclass'); });
Route::get('drumeo/shop/drum-technique-made-easy', function(){ return view('drumeo.products.full-page-assets.drum-technique-made-easy'); });

Route::get('{brand}/shop/{product:slug}', [ProductPagesController::class, 'product'])
    ->whereIn('brand', all_brands())
    ->name('marketing.product');






