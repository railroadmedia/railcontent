<?php

namespace App\Http\Controllers\Pianote;

use Illuminate\Http\Request;
use App\Http\Controllers\BaseController;
use App\Models\Product;

class ShopController extends BaseController
{
    public function shop(Request $request)
    {
        $products = Product::whereHas('brand', fn($query) => $query->where('name', 'pianote'))->where('visible', '=', 1)->where('product_type_id', '!=', 6)->orderBy('display_order')->get();

        $lessons = $products->filter(function($value, $key){
            return $value->productType->name === 'Lessons';
        });

        $accessories = $products->filter(function($value, $key){
            return $value->productType->name === 'Accessories';
        });

        $hats = $products->filter(function($value, $key){
            return $value->productType->name === 'Hats';
        });

        $shirts = $products->filter(function($value, $key){
            return $value->productType->name === 'Shirts';
        });

        $hoodies = $products->filter(function($value, $key){
            return $value->productType->name === 'Hoodies';
        });

        return view('pianote.shop.shop', [
            'lessons' => $lessons,
            'accessories' => $accessories,
            'hats' => $hats,
            'shirts' => $shirts,
            'hoodies' => $hoodies,
            'theme' => 'pianote',
            'category' => $request->category
        ]);
    }

    public function product($root, $slug)
    {
        $product = Product::where('slug', 'Pianote-'.$slug)->firstOrFail();

        return view('pianote.shop.product-layout', [ 'product' => $product, 'theme' => 'pianote' ]);
    }
}
