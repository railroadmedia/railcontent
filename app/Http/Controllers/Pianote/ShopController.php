<?php

namespace App\Http\Controllers\Pianote;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\BaseController;
use App\Models\Product;

class ShopController extends BaseController
{
    public function shop(Request $request)
    {
        $products = Product::whereHas('brand', fn ($query) => $query->where('name', 'pianote'))->where([['shop_card_visible', 1], ['product_type_id', '!=', 6], ['is_seasonal', 0]])
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

        $lessons = $products->filter(function ($value, $key) {
            return $value->productType->name === 'Lessons';
        });

        $accessories = $products->filter(function ($value, $key) {
            return $value->productType->name === 'Accessories';
        });

        $misc = $products->filter(function ($value, $key) {
            return $value->productType->name === 'Misc';
        });

        $shirts = $products->filter(function ($value, $key) {
            return $value->productType->name === 'Shirts';
        });

        $hoodies = $products->filter(function ($value, $key) {
            return $value->productType->name === 'Hoodies' || $value->productType->name === 'Sweaters';
        });

        $featured = $products->whereIn('id', [208, 210, 197, 206]);

        return view('pianote.shop.shop', [
            'lessons' => $lessons,
            'accessories' => $accessories,
            'misc' => $misc,
            'shirts' => $shirts,
            'hoodies' => $hoodies,
            'theme' => 'pianote',
            'category' => $request->category,
            'featured' => $featured,
        ]);
    }

    public function product($root, $slug)
    {
        $product = Product::where('slug', 'Pianote-'.$slug)->where('sales_page_visible', 1)
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

        return view('pianote.shop.product-layout', [ 'product' => $product, 'theme' => 'pianote' ]);
    }
}
