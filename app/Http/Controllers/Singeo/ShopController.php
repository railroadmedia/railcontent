<?php

namespace App\Http\Controllers\Singeo;

use Illuminate\Http\Request;
use App\Http\Controllers\BaseController;
use App\Models\Product;

class ShopController extends BaseController
{
    public function shop()
    {
        $items = Product::whereHas('brand', fn($query) => $query->where('name', 'singeo'))->where('visible', '=', 1)->where('product_type_id', '!=', 6)->orderBy('display_order')->get();

        return view('singeo.shop.shop', [ 'items' => $items, 'brand' => 'singeo' ]);
    }

    public function product($root, $slug)
    {
        $product = Product::where('slug', 'Singeo-'.$slug)->firstOrFail();

        return view('singeo.shop.product-layout', [ 'product' => $product, 'brand' => 'singeo' ]);
    }
}
