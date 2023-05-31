<?php

namespace App\Http\Controllers\Singeo;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\BaseController;
use App\Models\Product;

class ShopController extends BaseController
{
    public function shop()
    {
        $items = Product::whereHas('brand', fn($query) => $query->where('name', 'singeo'))->where([['shop_card_visible', 1], ['product_type_id', '!=', 6], ['is_seasonal', 0]])
            ->where(function ($query) {
                return $query
                    ->whereNull('products.shop_card_start_date')
                    ->orWhere('products.shop_card_start_date', '<=', Carbon::now('PST')->toDateTimeString());
            })
            ->where(function ($query) {
                return $query
                    ->whereNull('products.shop_card_end_date')
                    ->orWhere('products.shop_card_end_date', '>', Carbon::now('PST')->toDateTimeString());
            })
            ->orderBy('display_order')->get();

        return view('singeo.shop.shop', [ 'items' => $items, 'theme' => 'singeo' ]);
    }

    public function product($root, $slug)
    {
        $product = Product::where('slug', 'Singeo-'.$slug)->where('sales_page_visible', 1)
            ->where(function ($query) {
                return $query
                    ->whereNull('products.sales_page_start_date')
                    ->orWhere('products.sales_page_start_date', '<=', Carbon::now('PST')->toDateTimeString());
            })
            ->where(function ($query) {
                return $query
                    ->whereNull('products.sales_page_end_date')
                    ->orWhere('products.sales_page_end_date', '>', Carbon::now('PST')->toDateTimeString());
            })
            ->firstOrFail();

        return view('singeo.shop.product-layout', [ 'product' => $product, 'theme' => 'singeo' ]);
    }
}
