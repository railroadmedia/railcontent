@extends('_partials.layout.global-shop-layout')

@section('meta')
    <title>Pianote Shop</title>
    <meta property="og:title" content="Pianote Shop">
    <meta name="description" content="Get Lessons, T-Shirts, & Much More!">
    <meta property="og:description" content="Get Lessons, T-Shirts, & Much More!">
    <meta property="og:image" content="https://pianote.s3.amazonaws.com/sales/2023/share-image-pianote2.jpg">
    <meta property="og:url" content="https://www.pianote.com/{{ Request::path() }}">
@endsection

@section('x-data')
    filter: '{{ $category !== 'shop' ? $category : 'all' }}',
@endsection

@section('layout-header')
    @include('pianote._partials._nav', [
        "cartVersion" => true
    ])
@endsection

@section('body')
    <header class="drum-shop-header" style="background-image:url(https://cdn.musora.com/image/fetch/w_2000,q_auto:best/https://pianote.s3.amazonaws.com/shop/header-background.jpg);">
        <div class="container mx-auto relative z-10">
            <div class="px-2 md:px-3">
                <div class="float-left px-2 md:px-3 w-full">
                    <img class="h-12 sm:h-14 md:h-24 lg:h-28 mb-4" src="https://pianote.s3.amazonaws.com/shop/pianote-shop-logo.png" alt="pianote logo">
                    <h3>GET LESSONS, MERCH, <br class="inline md:hidden"> GEAR & MORE!</h3>
                </div>
            </div>
        </div>
    </header>

    @if(Session::has('addedProducts'))
        <section class="added-to-cart-background clearfix">
            <div class="float-left px-2 md:px-3 w-full check">
                <h2><i class="fas fa-check"></i>Added to Cart</h2>
            </div>
            <div class="float-left px-2 md:px-3 w-full product-info">
                <div class="float-left px-2 md:px-3 w-full md:w-8/12 product">
                    @foreach(Session::get('addedProducts') as $addedProduct)
                        <div class="float-left px-2 md:px-3 w-full" style="padding:0;margin-bottom:15px;">
                            <img src="{{ $addedProduct['thumbnail'] }}">
                            <h4>{{ $addedProduct['name'] }}</h4>
                            <p>{{ $addedProduct['description'] }}</p>
                        </div>
                    @endforeach
                </div>
                <div class="float-left px-2 md:px-3 w-full md:w-4/12 checkout">
                    <h5>
                        Cart Subtotal({{ Session::get('cartNumberOfItems') }}):
                        <strong>${{ Session::get('cartSubTotal') }}</strong>
                    </h5>
                    <a href="{{ get_musora_brand_base_url() }}/order/{{ $brand }}" class="checkout-button"><i class="fas fa-cart-plus"></i> Checkout</a>
                </div>
            </div>
        </section>
    @endif

    @include('pianote.shop._partials._catalogue-filters', [
        "all" => true
    ])
    <div class="white-box">
        {{--        @include('_partials.layout.holiday.bundle-cards')--}}

        {{--        <section class="bundles">--}}
        {{--            <div class="container mx-auto">--}}
        {{--                <div class="w-full card-wrap mb-5">--}}
        {{--                    <a href="/shop/book-bundle/" class="w-full --}}{{--py-20 sm:py-28 lg:py-40--}}{{-- py-5 lg:py-8 px-4 sm:px-6 lg:px-20 banner-product overflow-hidden bg-cover bg-center sm:bg-right" style="background-color:#ca1176;background-image:url(https://cdn.musora.com/image/fetch/w_2500,q_auto:best/https://pianote.s3.amazonaws.com/sales/promos/november/just-the-books-shop-no-classic.jpg);">--}}
        {{--                        <span class="top-left-badge text-white bg-promo z-10"><i class="fas fa-star"></i> SAVE {{ round(100 - (100 * (59 / 145))) }}%</span>--}}
        {{--                        <div class="text-wrap relative z-10">--}}
        {{--                            <img class="h-24 lg:h-32 relative z-10" src="https://cdn.musora.com/image/fetch/w_1600,q_auto:best/https://pianote.s3.amazonaws.com/sales/promos/november/just-the-books-bundle-white.png">--}}
        {{--                            <p class="my-2">--}}
        {{--                                Chords & Scales Book + Practice Planner + Christmas<br class="hidden sm:inline">--}}
        {{--                                Songbook + Chords Poster + Scales Poster</p>--}}
        {{--                            <h4 class="inline-block leading-none"><strong>--}}
        {{--                                    <s class="opacity-60">$145</s>&nbsp; ${{  }}</strong></h4><br>--}}
        {{--                            <span class="join smaller mt-2 lg:mt-3" style="background-color:#000;">See The Deal &raquo;</span>--}}
        {{--                        </div>--}}
        {{--                        --}}{{--                <div class="absolute top-0 left-0 right-0 bottom-0 z-0 hidden md:block" style="background:linear-gradient(to right, rgba(18,139,165,0.4) 25%, #003643);"></div>--}}
        {{--                        <div class="absolute top-0 left-0 right-0 bottom-0 z-0 block md:hidden" style="background:linear-gradient(to bottom, rgba(203,19,117,0.5), #7100a1);"></div>--}}
        {{--                    </a>--}}
        {{--                </div>--}}
        {{--            </div>--}}
        {{--        </section>--}}

        {{--    LESSONS    --}}
        <section class="grid-view category-section" data-category="lessons" x-show="filter === 'lessons' || filter === 'all'">
            <ul class="container mx-auto fixed-cards text-center lg:text-left">
                <li>
                    <h1 class="float-left px-2 md:px-3 w-full">
                        <div class="heading-icon text-pianote"><i class="fas fa-video"></i></div>
                        Piano Lessons
                    </h1>
                </li>

                @foreach($lessons as $lesson){
                @include('drumeo.drumshop._partials._drum-shop-card', [
                        "sku" => $lesson->sku === 'drumeo' || $lesson->sku === 'pianote' || $lesson->sku === 'singeo' || $lesson->sku === 'guitareo' ? null : $lesson->sku,
                        "itemURL" => '/shop/'.str_replace( array('Drumeo-', 'Pianote-', 'Guitareo-', 'Singeo-'), '', $lesson->slug ),
                        "thumbnail" => $lesson->thumbnail,
                        "packLogo" => $lesson->thumbnail_logo,
                        "title" => $lesson->name,
                        "packAuthor" => $lesson->instructor_name,
                        "cardDescription" => $lesson->short_desc,
                        "fullPrice" => $lesson->price,
                        "price" => $lesson->discounted_price,
                        "category" => strtolower($lesson->productType->name),
                        "soldOut" => $lesson->sold_out,
                        "includedMembership" => $lesson->included_edge,
                        "badgeText" => $lesson->badge_text,
                ])
                }
                @endforeach
            </ul>
        </section>

        {{--   ACCESSORIES     --}}
        <section class="grid-view category-section" data-category="shirts" x-show="filter === 'accessories' || filter === 'all'">
            <ul class="container mx-auto fixed-cards">
                <li>
                    <h1 class="float-left px-2 md:px-3 w-full">
                        <div class="heading-icon text-pianote"><i class="fas fa-mug-hot"></i></div>
                        Accessories
                    </h1>
                </li>
                @foreach($accessories as $accessory){
                @include('drumeo.drumshop._partials._drum-shop-card', [
                        "sku" => (str_contains($accessory->sku, 'member') || str_contains($accessory->sku, 'products')) ? '' : $accessory->sku,
                        "itemURL" => '/shop/'.str_replace( array('Drumeo-', 'Pianote-', 'Guitareo-', 'Singeo-'), '', $accessory->slug ),
                        "thumbnail" => $accessory->thumbnail,
                        "badgeText" => $accessory->badge_text,
                        "title" => $accessory->name,
                        "cardDescription" => $accessory->short_desc,
                        "fullPrice" => $accessory->price,
                        "sizes" => $accessory->sizes,
                        "price" => $accessory->discounted_price,
                        "category" => strtolower($accessory->productType->name),
                        "soldOut" => !empty($products[$accessory->sku]) ? $products[$accessory->sku]->getStockAvailability() === 0 : $accessory->sold_out,
                        "size_case_sensitive" => $accessory->size_case_sensitive,
                ])
                }
                @endforeach
            </ul>
        </section>

        {{--   HATS     --}}
        <section class="grid-view category-section" data-category="hats" x-show="filter === 'clothing' || filter === 'all'">
            <ul class="container mx-auto fixed-cards">
                <li>
                    <h1 class="px-2 md:px-3">
                        <div class="heading-icon"><img src="https://dpwjbsxqtam5n.cloudfront.net/drum-shop/hat.svg" alt="hat icon" style="filter: invert()sepia()brightness(.5)hue-rotate(-70deg)saturate(37);"></div>
                        Hats
                    </h1>
                </li>

                @foreach($hats as $hat){
                @include('drumeo.drumshop._partials._drum-shop-card', [
                     "sku" => $hat->sku,
                     "itemURL" => '/shop/'.str_replace( array('Drumeo-', 'Pianote-', 'Guitareo-', 'Singeo-'), '', $hat->slug ),
                     "badgeText" => $hat->badge_text,
                     "thumbnail" => $hat->thumbnail,
                     "title" => $hat->name,
                     "cardDescription" => $hat->short_desc,
                     "fullPrice" => $hat->price,
                     "price" => $hat->discounted_price,
                     "sizes" => $hat->sizes,
                     "soldOut" => !empty($products[$hat->sku]) ? $products[$hat->sku]->getStockAvailability() === 0 : $hat->sold_out,
                     "category" => strtolower($hat->productType->name),
                     "size_case_sensitive" => $hat->size_case_sensitive,
                ])
                }
                @endforeach

            </ul>
        </section>

        {{--   SHIRTS     --}}
        <section class="grid-view category-section" data-category="shirts" x-show="filter === 'clothing' || filter === 'all'">
            <ul class="container mx-auto fixed-cards">
                <li>
                    <h1 class="float-left px-2 md:px-3 w-full">
                        <div class="heading-icon text-pianote"><i class="fas fa-tshirt"></i></div>
                        Shirts
                    </h1>
                </li>
                @foreach($shirts as $shirt){
                @include('drumeo.drumshop._partials._drum-shop-card', [
                    "sku" => $shirt->sku,
                    "itemURL" => '/shop/'.str_replace( array('Drumeo-', 'Pianote-', 'Guitareo-', 'Singeo-'), '', $shirt->slug ),
                    "thumbnail" => $shirt->thumbnail,
                    "badgeText" => $shirt->badge_text,
                    "title" => $shirt->name,
                    "cardDescription" => $shirt->short_desc,
                    "fullPrice" => $shirt->price,
                    "price" => $shirt->discounted_price,
                    "category" => strtolower($shirt->productType->name),
                    "sizes" => $shirt->sizes,
                    "soldOut" => !empty($products[$shirt->sku]) ? $products[$shirt->sku]->getStockAvailability() === 0 : $shirt->sold_out,
                    "size_case_sensitive" => $shirt->size_case_sensitive,
                ])
                }
                @endforeach
            </ul>
        </section>

        {{--   HOODIES     --}}
        <section class="grid-view category-section" data-category="shirts" x-show="filter === 'clothing' || filter === 'all'">
            <ul class="container mx-auto fixed-cards">
                <li>
                    <h1 class="float-left px-2 md:px-3 w-full">
                        <div class="heading-icon"><img src="https://dpwjbsxqtam5n.cloudfront.net/drum-shop/hoodie.svg" alt="hoodie icon" style="filter: invert()sepia()brightness(.5)hue-rotate(-70deg)saturate(37);"></div>
                        Hoodies
                    </h1>
                </li>
                @foreach($hoodies as $hoodie){
                @include('drumeo.drumshop._partials._drum-shop-card', [
                    "sku" => $hoodie->sku,
                    "itemURL" => '/shop/'.str_replace( array('Drumeo-', 'Pianote-', 'Guitareo-', 'Singeo-'), '', $hoodie->slug ),
                    "thumbnail" => $hoodie->thumbnail,
                    "badgeText" => $hoodie->badge_text,
                    "title" => $hoodie->name,
                    "cardDescription" => $hoodie->short_desc,
                    "fullPrice" => $hoodie->price,
                    "price" => $hoodie->discounted_price,
                    "category" => strtolower($hoodie->productType->name),
                    "sizes" => $hoodie->sizes,
                    "soldOut" => !empty($products[$hoodie->sku]) ? $products[$hoodie->sku]->getStockAvailability() === 0 :$hoodie->sold_out,
                    "size_case_sensitive" => $hoodie->size_case_sensitive,
                ])
                }
                @endforeach

            </ul>
        </section>
    </div>
@endsection

@section('layout-footer')
    @include('pianote._partials._footer')
@endsection

