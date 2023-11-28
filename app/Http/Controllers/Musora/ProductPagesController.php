<?php

namespace App\Http\Controllers\Musora;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\BaseController;

class ProductPagesController extends BaseController
{
    public function shopAlt(Request $request)
    {
        $products = Product::where([['shop_card_visible', 1], ['product_type_id', '!=', 6], ['is_seasonal', 1]])->orderBy('display_order')->get();

        $accessories = $products->filter(function($value, $key){
            return $value->productType->name === 'Accessories';
        });

        $misc = $products->filter(function($value, $key){
            return $value->productType->name === 'Misc';
        });

        $shirts = $products->filter(function($value, $key){
            return $value->productType->name === 'Shirts';
        });

        $hoodies = $products->filter(function($value, $key){
            return $value->productType->name === 'Hoodies' || $value->productType->name === 'Sweaters';
        });

        $drumeo = $products->filter(function($value, $key){
            return $value->brand->name === 'Drumeo';
        });

        $pianote = $products->filter(function($value, $key){
            return $value->brand->name === 'Pianote';
        });

        $guitareo = $products->filter(function($value, $key){
            return $value->brand->name === 'Guitareo';
        });

        $singeo = $products->filter(function($value, $key){
            return $value->brand->name === 'Singeo';
        });

        $musora = $products->filter(function($value, $key){
            return $value->brand->name === 'Musora';
        });

        return view('musora.shop.shop', [
            'accessories' => $accessories,
            'misc' => $misc,
            'shirts' => $shirts,
            'hoodies' => $hoodies,
            'theme' => 'musora',
            'category' => $request->category,
            'drumeo' => $drumeo,
            'pianote' => $pianote,
            'guitareo' => $guitareo,
            'singeo' => $singeo,
            'musora' => $musora,
        ]);
    }

    public function productAlt(Request $request)
    {
        $product = Product::where('slug', 'Musora-'.$request->slug)->firstOrFail();

        return view('musora.shop.product-layout', [ 'product' => $product, 'theme' => 'musora' ]);
    }

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

            $misc = $products->filter(function($value, $key){
                return $value->productType->name === 'Misc';
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
                'misc' => $misc,
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
