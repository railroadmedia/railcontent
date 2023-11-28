@extends('_partials.layout.global-shop-layout')

@section('meta')
    <title>Singeo Shop</title>
    <meta property="og:title" content="Singeo Shop - Get Lessons, T-Shirts, & More!">
    <meta name="description" content="Singeo.com: Your start-to-finish guide to confident singing">
    <meta property="og:description" content="Singeo.com: Your start-to-finish guide to confident singing">

    @if(Carbon\Carbon::create(2023, 11, 28, 8, 0, 0, 'America/Vancouver') > Carbon\Carbon::now())
        <meta property="og:image" content="https://d21q7xesnoiieh.cloudfront.net/fit-in/1200x0/filters:quality(95)/marketing/singeo/promos/november/cm-singeo-shop-share-image.jpg">
    @else
        <meta property="og:image" content="https://d21q7xesnoiieh.cloudfront.net/fit-in/1200x0/filters:quality(95)/marketing/singeo/promos/november/xmas-singeo-shop-share-image.jpg">
    @endif
    <meta property="og:url" content="https://www.singeo.com/shop/">
@endsection

@section('x-data')
    filter: '{{ $category !== 'shop' ? $category : 'all' }}',
@endsection

@section('layout-header')
    @include("singeo.sales.partials._nav", [
        "cartVersion" => true,
    ])
@endsection

@section('body')
    @include('_partials.components.shop.promo-top-banner',[
        'text' => '<span class="text-promo">Save up to 67%</span> on singing lessons,<br class="sm:hidden"> merch, & more.',
    ])

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

    @include('drumeo.drumshop._partials._catalogue-filters')
    <div class="sm:px-4 lg:px-5 py-5 sm:py-8 lg:py-10">

        @php
            $bundles = [
                [
                    'slug' => 'https://www.singeo.com/shop/ultimate-lessons-bundle',
                    'desc' => '3 Free Bonuses',
                    'visible' => 1,
                    'full' => true,
                    'price' => 298,
                    'discountedPrice' => 240,
                    'buttonColor' => '#8300E9',
                    'logo' => 'https://d21q7xesnoiieh.cloudfront.net/fit-in/800x0/filters:quality(95)/marketing/drumeo/promos/november/bundles/ultimate-lessons-white.png',
                    'img' => 'https://d21q7xesnoiieh.cloudfront.net/fit-in/2000x0/filters:quality(95)/marketing/singeo/promos/november/bundles/singeo-ultimate-lessons-card.jpg',
                    'imgM' => 'https://d21q7xesnoiieh.cloudfront.net/fit-in/700x0/filters:quality(95)/marketing/singeo/promos/november/bundles/singeo-ultimate-lessons-card-m.jpg',
                ],
            ];
        @endphp
        @include('_partials.layout.holiday.bundle-tiles', [
            "header" => 'Featured Deals',
        ])

        <div id="lessons" class="anchor"></div>
        <section class="grid-view category-section" data-category="lessons" x-show="filter === 'lessons' || filter === 'all'">
            <div class="container">
                <h5 class="leading-tight mb-4 md:mb-5"><strong><i class="fas fa-video text-{{ $brand }} mr-1"></i> Singing Lessons</strong></h5>
                <div class="fixed-cards grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 2xl:grid-cols-5 gap-2 md:gap-4 text-left">

{{--                    @include('musora.shop._shop-card-alt', [--}}
{{--                         "itemURL" => "/",--}}
{{--                         "sku" => null,--}}
{{--                         "thumbnail" => "https://d21xeg6s76swyd.cloudfront.net/sales/promos/july/singeo-membership-shop.jpg",--}}
{{--                         "title" => "Singeo Membership",--}}
{{--                         "packAuthor" => "Lisa Witt",--}}
{{--                         "cardDescription" => "Improve your vocal range, strength, and control with step-by-step lessons and unlimited personal support.",--}}
{{--                         "specialPrice" => "7-Day Free Trial",--}}
{{--                         "fullPrice" => 240,--}}
{{--                         "price" => 150,--}}
{{--                         "category" => "lessons",--}}
{{--                         "buttonText" => "Start For Free <i class='fas fa-arrow-right'></i>",--}}
{{--                         'soldOut' => false,--}}
{{--                    ])--}}

                    <div x-cloak x-show="filter === 'lessons'">
                        @include('musora.shop._shop-card-alt', [
                             "itemURL" => "/shop/ultimate-lessons-bundle",
                             "sku" => null,
                             "thumbnail" => "https://d21q7xesnoiieh.cloudfront.net/fit-in/540x0/filters:quality(95)/marketing/singeo/promos/november/bundles/singeo-ultimate-shop-thumb.jpg",
                             "title" => "Ultimate Lessons Bundle",
                             "fullPrice" => 240,
                             "price" => 240,
                             "category" => "lessons",
                             'soldOut' => false,
                        ])
                    </div>
                    @foreach($lessons as $key => $lesson)
                        @include('musora.shop._shop-card-alt', [
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
                                'FCP' => $key < 4 ? true : null,
                        ])
                    @endforeach
                </div>
            </div>
        </section>

        {{--   ACCESSORIES     --}}
        <div id="accessories" class="anchor"></div>
        <section class="grid-view category-section" data-category="shirts" x-show="filter === 'accessories' || filter === 'all'">
            <div class="container">
                <h5 class="leading-tight mb-4 md:mb-5"><strong><i class="fas fa-suitcase text-{{ $brand }} mr-1"></i> Accessories</strong></h5>
                <div class="fixed-cards grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 2xl:grid-cols-5 gap-2 md:gap-4 text-left">
                    @foreach($accessories as $accessory)
                        @include('musora.shop._shop-card-alt', [
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
                                "soldOut" => isset($products[$accessory->sku]) ? $products[$accessory->sku]->getStockAvailability() === 0 : $accessory->sold_out,
                                "size_case_sensitive" => $accessory->size_case_sensitive,
                        ])
                    @endforeach
                </div>
            </div>
        </section>

        {{--   SHIRTS     --}}
        <div id="shirts" class="anchor"></div>
        <section class="grid-view category-section" data-category="shirts" x-show="filter === 'clothing' || filter === 'all'">
            <div class="container">
                <h5 class="leading-tight mb-4 md:mb-5"><strong><i class="fas fa-shirt text-{{ $brand }} mr-1"></i> Clothing</strong></h5>
                <div class="fixed-cards grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 2xl:grid-cols-5 gap-2 md:gap-4 text-left">

                    @foreach($shirts as $shirt)
                        @include('musora.shop._shop-card-alt', [
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
                            "soldOut" => isset($products[$shirt->sku]) ? $products[$shirt->sku]->getStockAvailability() === 0 : $shirt->sold_out,
                            "size_case_sensitive" => $shirt->size_case_sensitive,
                        ])
                    @endforeach
                </div>
            </div>
        </section>
    </div>
@endsection

@section('layout-footer')
    @include("singeo.sales.partials._footer")
@endsection
