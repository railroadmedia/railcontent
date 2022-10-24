<?php

namespace App\Http\Controllers\Pianote;

use Illuminate\Http\Request;
use App\Http\Controllers\BaseController;
use App\Models\Product;

class ShopController extends BaseController
{
    public function shop()
    {
        $products = Product::whereHas('brand', fn($query) => $query->where('name', 'pianote'))->where('visible', '=', 1)->where('product_type_id', '!=', 6)->orderBy('display_order')->get();

        return view('pianote.shop.shop', [ 'products' => $products ]);
    }

    public function product($root, $slug)
    {
        $product = Product::where('slug', 'Pianote-'.$slug)->firstOrFail();

        return view('pianote.shop.product-layout', [ 'product' => $product, 'theme' => 'pianote' ]);
    }
}
