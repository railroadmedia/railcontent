<?php

namespace App\Http\Controllers\Musora;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\BaseController;

class ProductPagesController extends BaseController
{
    public function products(Request $request)
    {
        $brand = $request->brand;
        $category = $request->category;

        $products = Product::whereHas('brand', fn($query) => $query->where('name', $brand))->where('visible', '=', 1)->where('product_type_id', '!=', 6)->orderBy('display_order')->get();

        if($brand === 'drumeo' || $brand === 'pianote'){
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

            return view('musora.product.products',[
                'lessons' => $lessons,
                'accessories' => $accessories,
                'hats' => $hats,
                'shirts' => $shirts,
                'hoodies' => $hoodies,
                'theme' => $brand,
                'category' => $category
            ]);
        }

        else {
            return view('musora.product.products',[
                'products' => $products,
                'theme' => $brand,
            ]);
        }
    }

    public function product($brand, $slug){
        $product = Product::where('slug', ucfirst($brand).'-'.$slug)->firstOrFail();

        return view('musora.product.product',[
            'product' => $product,
            'theme' => $brand,
        ]);
    }
}
