<?php

namespace App\Http\Controllers\Guitareo;

use Illuminate\Http\Request;
use App\Http\Controllers\BaseController;
use App\Models\Product;

class ShopController extends BaseController
{
    public function shop()
    {
        $items = Product::whereHas('brand', fn($query) => $query->where('name', 'guitareo'))->where('visible', '=', 1)->where('product_type_id', '!=', 6)->orderBy('display_order')->get();

        return view('guitareo.shop.shop', [ 'items' => $items, 'brand' => 'guitareo' ]);
    }

    public function product($root, $slug)
    {
        $product = Product::where('slug', 'Guitareo-'.$slug)->firstOrFail();

        return view('guitareo.shop.product-layout', [ 'product' => $product, 'brand' => 'guitareo' ]);
    }
}
