<?php

namespace App\Http\Controllers\Drumeo;

use Illuminate\Http\Request;
use App\Http\Controllers\BaseController;
use App\Models\Product;

class ShopController extends BaseController
{
    public function shop()
    {
        $products = Product::whereHas('brand', fn($query) => $query->where('name', 'drumeo'))->where('visible', '=', 1)->where('product_type_id', '!=', 6)->orderBy('display_order')->get();

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

        return view('drumeo.drumshop.shop', [
            'lessons' => $lessons,
            'accessories' => $accessories,
            'hats' => $hats,
            'shirts' => $shirts,
            'hoodies' => $hoodies,
            'theme' => 'drumeo',
        ]);
    }

    public function product($root, $slug)
    {
        $product = Product::where('slug', 'Drumeo-'.$slug)->firstOrFail();

        return view('drumeo.drumshop.product-layout', [ 'product' => $product, 'theme' => 'drumeo' ]);
    }
}
