<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Musora\ProductPagesController;
use App\Modules\Brand\Enums\Brand;

Route::get('{brand}/shop', [ProductPagesController::class, 'products'])
    ->whereIn('brand', all_brands())
    ->name('marketing.products');

/*---- CUSTOM PRODUCT PAGE ----*/
//drumeo
Route::get('drumeo/shop/new-drummers', function(){ return view('drumeo.products.full-page-assets.new-drummers'); });
Route::get('drumeo/shop/rock-drumming-masterclass', function(){ return view('drumeo.products.full-page-assets.rock-drumming-masterclass'); });
Route::get('drumeo/shop/drum-technique-made-easy', function(){ return view('drumeo.products.full-page-assets.drum-technique-made-easy'); });
Route::get('drumeo/shop/beyond-beginner-drumming', function(){ return view('drumeo.products.full-page-assets.beyond-beginner-drumming'); });
Route::get('drumeo/shop/independence-made-easy', function(){ return view('drumeo.products.full-page-assets.independence-made-easy'); });
Route::get('drumeo/shop/learn-songs-faster', function(){ return view('drumeo.products.full-page-assets.learn-songs-faster'); });
Route::get('drumeo/shop/better-drum-fills', function(){ return view('drumeo.products.full-page-assets.better-drum-fills'); });
Route::get('drumeo/shop/electrify-your-drumming', function(){ return view('drumeo.products.full-page-assets.electrify-your-drumming'); });
Route::get('drumeo/shop/successful-drumming-discount', function(){ return view('drumeo.products.full-page-assets.successful-drumming-discount'); });
Route::get('drumeo/shop/drumming-system-discount', function(){ return view('drumeo.products.full-page-assets.drumming-system-discount'); });
Route::get('drumeo/shop/quietkick', function(){ return view('drumeo.products.full-page-assets.quietkick'); });
Route::get('drumeo/shop/eardrums', function(){ return view('drumeo.products.full-page-assets.eardrums'); });
Route::get('drumeo/shop/tone-control-kit', function(){ return view('drumeo.products.full-page-assets.tone-control-kit'); });
Route::get('drumeo/shop/drumsticks', function(){ return view('drumeo.products.full-page-assets.drumsticks'); });
Route::get('drumeo/shop/practice-pad-full', function(){ return view('drumeo.products.full-page-assets.practice-pad-full'); });
Route::get('drumeo/shop/quietpad', function(){ return view('drumeo.products.full-page-assets.quietpad'); });
Route::get('drumeo/shop/the-drummers-toolbox', function(){ return view('drumeo.products.full-page-assets.the-drummers-toolbox'); });
Route::get('drumeo/shop/beginner-book', function(){ return view('drumeo.products.full-page-assets.beginner-book'); });

//pianote
Route::get('pianote/shop/play-beautiful-piano', function(){ return view('pianote.products.play-beautiful-piano'); });
Route::get('pianote/shop/pianote-500-songs', function(){ return view('pianote.products.500-songs'); });
Route::get('pianote/shop/worship-piano', function(){ return view('pianote.products.worship-piano'); });
Route::get('pianote/shop/piano-technique-made-easy', function(){ return view('pianote.products.piano-technique-made-easy'); });
Route::get('pianote/shop/destupefy-your-left-hand', function(){ return view('pianote.products.destupefy-your-left-hand'); });
Route::get('pianote/shop/faster-fingers', function(){ return view('pianote.products.faster-fingers'); });
Route::get('pianote/shop/riffs-and-fills', function(){ return view('pianote.products.riffs-and-fills'); });
Route::get('pianote/shop/beginner-classical-piano', function(){ return view('pianote.products.beginner-classical-piano.beginner-classical-piano'); });


Route::get('{brand}/shop/{product:slug}', [ProductPagesController::class, 'product'])
    ->whereIn('brand', all_brands())
    ->name('marketing.product');






