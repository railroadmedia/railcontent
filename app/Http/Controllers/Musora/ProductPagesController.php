<?php

namespace App\Http\Controllers\Musora;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\BaseController;

class ProductPagesController extends BaseController
{


    public function shopAlt(Request $request)
    {
        $products = Product::where([['visible', 1], ['is_seasonal', 1]])->whereNotIn('product_type_id', [1, 6])->orderBy('display_order')->get();


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
            'hats' => $hats,
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

public function newdrummers()
    {
        return view('drumeo.products.new-drummers');
    }

public function rockdrummingmasterclass()
    {
        return view('drumeo.products.rock-drumming-masterclass');
    }

public function drumtechniquemadeeasy()
    {
        return view('drumeo.products.drum-technique-made-easy');
    }

public function beyondbeginnerdrumming()
    {
        return view('drumeo.products.beyond-beginner-drumming');
    }

public function independencemadeeasy()
    {
        return view('drumeo.products.independence-made-easy');
    }

public function learnsongsfaster()
    {
        return view('drumeo.products.learn-songs-faster');
    }

public function betterdrumfills()
    {
        return view('drumeo.products.better-drum-fills');
    }

public function electrifyyourdrumming()
    {
        return view('drumeo.products.electrify-your-drumming');
    }

public function successfuldrummingdiscount()
    {
        return view('drumeo.products.successful-drumming-discount');
    }

public function drummingsystemdiscount()
    {
        return view('drumeo.products.drumming-system-discount');
    }

public function quietkick()
    {
        return view('drumeo.products.quietkick');
    }

public function eardrums()
    {
        return view('drumeo.products.eardrums');
    }

public function tonecontrolkit()
    {
        return view('drumeo.products.tone-control-kit');
    }

public function drumsticks()
    {
        return view('drumeo.products.drumsticks');
    }

public function practicepadfull()
    {
        return view('drumeo.products.practice-pad-full');
    }

public function quietpad()
    {
        return view('drumeo.products.quietpad');
    }

public function thedrummerstoolbox()
    {
        return view('drumeo.products.the-drummers-toolbox');
    }

public function beginnerbook()
    {
        return view('drumeo.products.beginner-book');
    }

public function thirtydaydrummer()
    {
        return view('drumeo.products.30-day-drummer');
    }

public function playbeautifulpiano()
    {
        return view('pianote.products.play-beautiful-piano');
    }

public function songs500()
    {
        return view('pianote.products.500-songs');
    }

public function worshippiano()
    {
        return view('pianote.products.worship-piano');
    }

public function pianotechniquemadeeasy()
    {
        return view('pianote.products.piano-technique-made-easy');
    }

public function destupefyyourlefthand()
    {
        return view('pianote.products.destupefy-your-left-hand');
    }

public function fasterfingers()
    {
        return view('pianote.products.faster-fingers');
    }

public function riffsandfills()
    {
        return view('pianote.products.riffs-and-fills');
    }

public function beginnerclassicalpiano()
    {
        return view('pianote.products.beginner-classical-piano.beginner-classical-piano');
    }

public function thepowerofchords()
    {
        return view('pianote.products.the-power-of-chords');
    }

public function thepowerofchordsbootcamp()
    {
        return view('pianote.products.the-power-of-chords-bootcamp');
    }

public function rhythmandgroove()
    {
        return view('guitareo.products.rhythm-and-groove');
    }

public function guitartechniquemadeeasy()
    {
        return view('guitareo.products.guitar-technique-made-easy');
    }

public function acousticguitarmadeeasy()
    {
        return view('guitareo.products.acoustic-guitar-made-easy');
    }

public function guitarsystem()
    {
        return view('guitareo.products.guitar-system');
    }

public function guitarquest()
    {
        return view('guitareo.products.guitar-quest.guitar-quest');
    }

public function guitareosongs500()
    {
        return view('guitareo.products.500-songs');
    }

public function singingstarterkit()
    {
        return view('singeo.products.singing-starter-kit');
    }

}
