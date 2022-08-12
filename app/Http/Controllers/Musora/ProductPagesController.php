<?php

namespace App\Http\Controllers\Musora;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\BaseController;

class ProductPagesController extends BaseController
{
    public function products($brand)
    {
        $products = Product::whereHas('brand', fn($query) => $query->where('name', $brand))->where('visible', '=', 1)->orderBy('display_order')->get();

        $lessons = $products->filter(function($value, $key){
            return $value->productType->name === 'Lesson';
        });

        $accessories = $products->filter(function($value, $key){
            return $value->productType->name === 'Accessory';
        });

        $hats = $products->filter(function($value, $key){
            return $value->productType->name === 'Hat';
        });

        $shirts = $products->filter(function($value, $key){
            return $value->productType->name === 'Shirt';
        });

        $hoodies = $products->filter(function($value, $key){
            return $value->productType->name === 'Hoodie';
        });

        return view('musora.product.products',[
            'lessons' => $lessons,
            'accessories' => $accessories,
            'hats' => $hats,
            'shirts' => $shirts,
            'hoodies' => $hoodies,
            'theme' => $brand,
        ]);
    }

    public function product($brand, $slug){
        $product = Product::where('slug', ucfirst($brand).'-'.$slug)->firstOrFail();

        return view('musora.product.product',[
            'product' => $product,
            'theme' => $brand,
        ]);
    }
}
