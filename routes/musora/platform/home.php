<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Platform\ContentPagesController;
use App\Models\Product;
use App\Models\Brand;

Route::domain('{musoraDomain}')
    ->middleware(['web_authenticated'])
    ->group(function () {
        Route::get('members', [
        	ContentPagesController::class,
            'show',
        ]);
    });

Route::get('products/{product:slug}', function ($slug){
    $product = Product::firstWhere('slug', $slug);

    return view('test.product',[
        'product' => $product
    ]);
});

Route::get('{brand}/products', function ($brand){
    $products = Product::whereHas('brand', fn($query) => $query->where('name', $brand))->get();

    return view('test.products',[
        'products' => $products
    ]);
});

