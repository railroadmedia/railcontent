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
    $product = Product::where('slug', $slug)->first();

    return view('product',[
        'product' => $product
    ]);
});

Route::get('{brand}/products', function ($brand){
//    $products = Product::where("brands.name", "=", $brand)->get();
    $products = Product::join("brands", "brands.id", "=", "products.brand_id")->join("product_types", "product_types.id", "=", "products.product_type_id")->where("brands.name", "=", $brand)->get(["products.name", "product_types.name as product_type",]);

    dd($products);

    return view('products',[
        'products' => $products
    ]);
});

