<?php

namespace App\Http\Controllers\Musora;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\BaseController;

class ProductPagesController extends BaseController
{
    public function products($brand)
    {
        $products = Product::whereHas('brand', fn($query) => $query->where('name', $brand))->where('visible', '=', 1)->get();

        return view('product.products',[
            'products' => $products
        ]);
    }

    public function product($slug){
        $product = Product::firstWhere('slug', $slug);

        return view('product.product',[
            'product' => $product
        ]);
    }
}
