@php
    require_once(resource_path('marketing/views/drumeo/drumshop/bundles.php'))
@endphp

@extends('_partials.layout.global-shop-layout')

@section('meta')
    <title>Drumeo Drum Shop - Get Lessons, T-Shirts, Gear, & Much More!</title>
    <meta name="description" content="Take your drumming to the next level with the largest collection of drum lessons in the world - or gear up for success with a selection of drum gear, t-shirts, sticks, and other cool drum swag.">

        <meta property="og:image" content="https://d21q7xesnoiieh.cloudfront.net/fit-in/1200x0/filters:quality(95)/marketing/drumeo/promos/november/xmas-drumeo-shop-share-image.jpg">
    <meta property="og:title" content="Drumeo Drum Shop - Get Lessons, T-Shirts, Gear, & Much More!">
    <meta property="og:description" content="Take your drumming to the next level with the largest collection of drum lessons in the world - or gear up for success with a selection of drum gear, t-shirts, sticks, and other cool drum swag.">
    <meta property="og:url" content="https://www.drumeo.com/drumshop/">
@endsection

@section('x-data')
    filter: '{{ $category !== 'drumshop' ? $category : 'all' }}',
@endsection

@section('layout-header')
    @include("drumeo.sales.partials._nav", [
        "cartVersion" => true
    ])
@endsection

@section('body')
    @include('_partials.components.shop.promo-top-banner',[
        'text' => '<span class="text-promo">Save up to 86%</span> on drum lessons,<br class="sm:hidden"> tools, & merch.',
        'bg' => 'https://dpwjbsxqtam5n.cloudfront.net/drum-shop/header-background.jpg',
    ])

    @if(Session::has('addedProducts'))
        <section class="added-to-cart-background clearfix">
            <div class="float-left w-full px-2 md:px-3 check">
                <h2><i class="fas fa-check"></i>Added to Cart</h2>
            </div>
            <div class="float-left w-full px-2 md:px-3 product-info">
                <div class="float-left w-full px-2 md:px-3 md:w-2/3 product">
                    @foreach(Session::get('addedProducts') as $addedProduct)
                        <div class="float-left w-full px-2 md:px-3" style="padding:0;margin-bottom:15px;">
                            <img src="{{ $addedProduct['thumbnail'] }}">
                            <h4>{{ $addedProduct['name'] }}</h4>
                            <p>{{ $addedProduct['description'] }}</p>
                        </div>
                    @endforeach
                </div>
                <div class="float-left w-full px-2 md:px-3 md:w-1/3 checkout">
                    <h5>
                        Cart Subtotal({{ Session::get('cartNumberOfItems') }}):
                        <strong>${{ number_format(Session::get('cartSubTotal'), 2, '.', ',') }}</strong>
                    </h5>
                    <a href="{{ get_musora_brand_base_url() }}/order/{{ $brand }}" class="join"><i class="fas fa-cart-plus"></i> Proceed to Checkout</a>
                </div>
            </div>
        </section>
    @endif

    @if(Session::has('success-message') ||
    Session::has('warning-message') ||
    Session::has('error-message'))
        <div class="container mx-auto clearfix">
            <div class="float-left w-full px-2 md:px-3 no-padding">
                @if(Session::has('success-message'))
                    <div class="alert alert-success">
                        <strong>Success: </strong> {{ Session::get('success-message') }}
                    </div>
                @endif

                @if(Session::has('warning-message'))
                    <div class="alert alert-warning">
                        <strong>Warning: </strong> {{ Session::get('warning-message') }}
                    </div>
                @endif

                @if(Session::has('error-message'))
                    <div class="alert alert-danger">
                        <strong>Error: </strong> {{ Session::get('error-message') }}
                    </div>
                @endif
            </div>
        </div>
    @endif

    @include('_partials.components.shop.index-filters', [
        "all" => true
    ])



    <div class="sm:px-4 lg:px-5 py-5 sm:py-8 lg:py-10">
        @php
                $bundles = [
                    [
                        'slug' => 'https://www.drumeo.com/drumshop/ultimate-lessons-bundle',
                        'desc' => '10 Free Bonuses <br class="sm:hidden"> Worth $1272',
                        'full' => true,
                        'visible' => 1,
                        'price' => 1512.94,
                        'discountedPrice' => 240,
                        'buttonColor' => '#0A69D0',
                        'logo' => 'https://d21q7xesnoiieh.cloudfront.net/fit-in/800x0/filters:quality(95)/marketing/drumeo/promos/november/bundles/ultimate-lessons-white.png',
                        'img' => 'https://d21q7xesnoiieh.cloudfront.net/fit-in/2000x0/filters:quality(95)/marketing/drumeo/promos/november/bundles/ultimate-lessons-card.jpg',
                        'imgM' => 'https://d21q7xesnoiieh.cloudfront.net/fit-in/700x0/filters:quality(95)/marketing/drumeo/promos/november/bundles/ultimate-lessons-card-m.jpg',
                    ],
                    [
                        'slug' => 'https://www.drumeo.com/drumshop/better-hands-bundle',
                        'desc' => 'Easy Rudiments Book + P4<br> + Drumsticks + PadStand',
                        'visible' => 1,
                        'price' => 200.94,
                        'discountedPrice' => 150.21,
                        'buttonColor' => '#01AB5A',
                        'logo' => 'https://d21q7xesnoiieh.cloudfront.net/fit-in/800x0/filters:quality(95)/marketing/drumeo/promos/november/bundles/better-hands-bundle-white.png',
                        'img' => 'https://d21q7xesnoiieh.cloudfront.net/fit-in/2000x0/filters:quality(95)/marketing/drumeo/promos/november/bundles/better-hands-card.jpg',
                        'imgM' => 'https://d21q7xesnoiieh.cloudfront.net/fit-in/2000x0/filters:quality(95)/marketing/drumeo/promos/november/bundles/better-hands-card.jpg',
                    ],
                    [
                        'slug' => 'https://www.drumeo.com/drumshop/perfect-gift-bundle',
                        'desc' => 'The perfect gift <br> for any drummer.',
                        'visible' => 1,
                        'price' => 331.95,
                        'discountedPrice' => 240,
                        'buttonColor' => '#f2192e',
                        'logo' => 'https://d21q7xesnoiieh.cloudfront.net/fit-in/800x0/filters:quality(95)/marketing/drumeo/promos/november/bundles/the-pefect-gift-bundle-white.png',
                        'img' => 'https://d21q7xesnoiieh.cloudfront.net/fit-in/2000x0/filters:quality(95)/marketing/drumeo/promos/november/bundles/perfect-gift-card.jpg',
                        'imgM' => 'https://d21q7xesnoiieh.cloudfront.net/fit-in/2000x0/filters:quality(95)/marketing/drumeo/promos/november/bundles/perfect-gift-card.jpg',
                    ],
                ];
        @endphp
        @include('_partials.layout.holiday.bundle-tiles', [
            "header" => 'Featured Deals',
        ])

        <section class="grid-view" data-category="featured" x-show="filter === 'featured' || filter === 'all'">
            <div class="container">
                <h5 class="leading-tight mb-4 md:mb-5"><strong><i class="fas fa-fire text-{{ $brand }} mr-1"></i> Trending Now</strong></h5>
                <div
                    x-data="{
                init() {
                    new Splide(this.$refs.splide, {
                        classes: {
                                arrow: 'splide__arrow bg-white opacity-100 top-[50%] shadow-lg h-11 w-11 text-[#0B76DB]',
                                prev: 'hidden',
                                next: 'splide__arrow--next hidden sm:flex mb-16',
                                pagination: 'hidden',
                        },
                        perPage: 3.5,
                        perMove: 1,
                        type: 'loop',
                        focus: 0,
                        interval: 2000,
                        breakpoints: {
                            1023: {
                                perPage: 2.5,
                            },
                            767: {
                                perPage: 1.5,
                                drag   : 'free',
                                snap   : false,
                            },
                        },
                    }).mount()
                },
            }"
                >
                    <div x-ref="splide" class="splide text-left">
                        <div class="splide__track pb-8">
                            <ul class="splide__list items-start">
                                @foreach($featured as $key => $feat)
                                    <li class="splide__slide px-1">
                                        @include('musora.shop._shop-card-alt', [
                                            "itemURL" => '/drumshop/'.str_replace( array('Drumeo-', 'Pianote-', 'Guitareo-', 'Singeo-'), '', $feat->slug ),
                                            "sku" => $feat->sku === 'drumeo' ? null : $feat->sku,
                                            "badgeText" => $feat->badge_text,
                                            "thumbnail" => $feat->thumbnail,
                                            "packLogo" => $feat->thumbnail_logo,
                                            "title" => $feat->name,
                                            "packAuthor" => $feat->instructor_name,
                                            "cardDescription" => $feat->short_desc,
                                            "fullPrice" => $feat->price,
                                            "price" => $feat->discounted_price,
                                            "category" => strtolower($feat->productType->name),
                                            "buttonText" => $feat->sku === 'drumeo' || $feat->sku === 'pianote' || $feat->sku === 'singeo' || $feat->sku === 'guitareo' ? 'see the deal' : null,
                                            "soldOut" => $feat->sold_out,
                                            "includedEdge" => $feat->included_edge,
                                            "sizes" => $feat->sizes,
                                            'FCP' => $key < 4 ? true : null,
                                            "size_case_sensitive" => $feat->size_case_sensitive,
                                        ])
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <div id="lessons" class="anchor"></div>
        <section class="grid-view category-section" data-category="lessons" x-show="filter === 'lessons' || filter === 'all'">
            <div class="container">
                <h5 class="leading-tight mb-4 md:mb-5"><strong><i class="fas fa-video text-{{ $brand }} mr-1"></i> Online Drum Lessons</strong></h5>
                <div class="fixed-cards grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 2xl:grid-cols-5 gap-2 md:gap-4 text-left">
                {{-- Drumeo annual membership --}}
{{--                @include('musora.shop._shop-card-alt', [--}}
{{--                     "itemURL" => "/",--}}
{{--                     "sku" => null,--}}
{{--                     "thumbnail" => "https://dpwjbsxqtam5n.cloudfront.net/promos/july/drumeo-membership-shop.jpg",--}}
{{--                     "title" => "Drumeo Membership",--}}
{{--                     "packAuthor" => "Award-Winning Membership",--}}
{{--                     "cardDescription" => "The Ultimate Online Drum Lessons Experience. You’ll get step-by-step drum lessons from the best drummers in the world (and much more).",--}}
{{--                     "specialPrice" => "7-Day Free Trial",--}}
{{--                     "fullPrice" => 240,--}}
{{--                     "price" => 240,--}}
{{--                     "category" => "lessons",--}}
{{--                     "buttonText" => "Start For Free <i class='fas fa-arrow-right'></i>",--}}
{{--                     'soldOut' => false,--}}
{{--                ])--}}
                <div x-cloak x-show="filter === 'lessons'">
                    @include('musora.shop._shop-card-alt', [
                         "itemURL" => "/drumshop/ultimate-lessons-bundle",
                         "sku" => null,
                         "thumbnail" => "https://d21q7xesnoiieh.cloudfront.net/fit-in/540x0/filters:quality(95)/marketing/drumeo/promos/november/bundles/drumeo-ultimate-shop-thumb2.jpg",
                         "title" => "Ultimate Lessons Bundle",
                         "fullPrice" => 240,
                         "price" => 240,
                         "category" => "lessons",
                         'soldOut' => false,
                    ])
                </div>
                <div x-cloak x-show="filter === 'lessons'">
                    @include('musora.shop._shop-card-alt', [
                         "itemURL" => "/drumshop/perfect-gift-bundle",
                         "sku" => null,
                         "thumbnail" => "https://d21q7xesnoiieh.cloudfront.net/fit-in/540x0/filters:quality(95)/marketing/drumeo/promos/november/bundles/drumeo-pg-shop-thumb2.jpg",
                         "title" => "The Perfect Gift Bundle",
                         "fullPrice" => 331.95,
                         "price" => 240,
                         "category" => "lessons",
                         'soldOut' => false,
                    ])
                </div>
                @foreach($lessons as $key => $lesson)
                    @include('musora.shop._shop-card-alt', [
                        "itemURL" => '/drumshop/'.str_replace( array('Drumeo-', 'Pianote-', 'Guitareo-', 'Singeo-'), '', $lesson->slug ),
                        "sku" => $lesson->sku === 'drumeo' ? null : $lesson->sku,
                        "badgeText" => $lesson->badge_text,
                        "thumbnail" => $lesson->thumbnail,
                        "packLogo" => $lesson->thumbnail_logo,
                        "title" => $lesson->name,
                        "packAuthor" => $lesson->instructor_name,
                        "cardDescription" => $lesson->short_desc,
                        "fullPrice" => $lesson->price,
                        "price" => $lesson->discounted_price,
                        "category" => strtolower($lesson->productType->name),
                        "buttonText" => $lesson->sku === 'drumeo' || $lesson->sku === 'pianote' || $lesson->sku === 'singeo' || $lesson->sku === 'guitareo' ? 'see the deal' : null,
                        "soldOut" => $lesson->sold_out,
                        "includedEdge" => $lesson->included_edge,
                        "sizes" => $lesson->sizes,
                        'FCP' => $key < 4 ? true : null,
                    ])
                @endforeach

                {{-- Drumeo gift card --}}
                @include('musora.shop._shop-card-alt', [
                    "itemURL" => "/drumshop/gift-card/",
                    "thumbnail" => "https://d1923uyy6spedc.cloudfront.net/Drumeo-cart-2-1643147388.png",
                    "title" => "Drumeo Gift Card",
                    "cardDescription" => "Give the gift of drum lessons with a gift card to Drumeo — with your choice between a one-month, 6-month, or 1-year membership pass.",
                    "fullPrice" =>29,
                    "price" => 29,
                    "category" => "card",
                    'soldOut' => false,
                ])
            </div>
            </div>
        </section>

        <div id="accessories" class="anchor"></div>
        <section class="grid-view category-section" data-category="accessories" x-show="filter === 'accessories' || filter === 'all'">
            <div class="container">
                <h5 class="leading-tight mb-4 md:mb-5"><strong><i class="fas fa-suitcase text-{{ $brand }} mr-1"></i> Accessories</strong></h5>
                <div class="fixed-cards grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 2xl:grid-cols-5 gap-2 md:gap-4 text-left">
                <div x-cloak x-show="filter === 'accessories'">
                    @include('musora.shop._shop-card-alt', [
                         "itemURL" => "/drumshop/better-hands-bundle",
                         "sku" => null,
                         "thumbnail" => "https://d21q7xesnoiieh.cloudfront.net/fit-in/540x0/filters:quality(95)/marketing/drumeo/promos/november/bundles/drumeo-bh-shop-thumb2.jpg",
                         "title" => "Better Hands Bundle",
                         "fullPrice" => 200.94,
                         "price" => 150.21,
                         "category" => "accessories",
                         'soldOut' => false,
                    ])
                </div>
                @foreach($accessories as $accessory)
                    @include('musora.shop._shop-card-alt', [
                        "sku" => $accessory->sku,
                        "itemURL" => '/drumshop/'.str_replace( array('Drumeo-', 'Pianote-', 'Guitareo-', 'Singeo-'), '', $accessory->slug ),
                        "badgeText" => $accessory->badge_text,
                        "thumbnail" => $accessory->thumbnail,
                        "title" => $accessory->name,
                        "cardDescription" => $accessory->short_desc,
                        "fullPrice" => $accessory->price,
                        "price" => $accessory->discounted_price,
                        "sizes" => $accessory->sizes,
                        "soldOut" => isset($products[$accessory->sku]) ? $products[$accessory->sku]->getStockAvailability() === 0 : $accessory->sold_out,
                        "category" => strtolower($accessory->productType->name),
                        "size_case_sensitive" => $accessory->size_case_sensitive,
                    ])
                @endforeach
                </div>
            </div>
        </section>

        {{--   XMAS     --}}
        <div id="xmas" class="anchor"></div>
        <section class="grid-view category-section" data-category="shirts" x-show="filter === 'clothing' || filter === 'all'">
            <div class="container">
                <h5 class="leading-tight mb-4 md:mb-5"><strong><i class="fas fa-tree-christmas text-{{ $brand }} mr-1"></i> Christmas Merch</strong></h5>
                <div class="fixed-cards grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 2xl:grid-cols-5 gap-2 md:gap-4 text-left">
                    @foreach($xmas as $key => $xmasItem)
                            @include('musora.shop._shop-card-alt', [
                                "itemURL" => '/drumshop/'.str_replace( array('Drumeo-', 'Pianote-', 'Guitareo-', 'Singeo-'), '', $xmasItem->slug ),
                                "sku" => $xmasItem->sku === 'drumeo' ? null : $xmasItem->sku,
                                "badgeText" => $xmasItem->badge_text,
                                "thumbnail" => $xmasItem->thumbnail,
                                "packLogo" => $xmasItem->thumbnail_logo,
                                "title" => $xmasItem->name,
                                "packAuthor" => $xmasItem->instructor_name,
                                "cardDescription" => $xmasItem->short_desc,
                                "fullPrice" => $xmasItem->price,
                                "price" => $xmasItem->discounted_price,
                                "category" => strtolower($xmasItem->productType->name),
                                "buttonText" => $xmasItem->sku === 'drumeo' || $xmasItem->sku === 'pianote' || $xmasItem->sku === 'singeo' || $xmasItem->sku === 'guitareo' ? 'see the deal' : null,
                                "soldOut" => $xmasItem->sold_out,
                                "includedEdge" => $xmasItem->included_edge,
                                "sizes" => $xmasItem->sizes,
                                'FCP' => $key < 4 ? true : null,
                                "size_case_sensitive" => $xmasItem->size_case_sensitive,
                            ])
                    @endforeach
                </div>
            </div>
        </section>
        {{--   MISC     --}}
{{--        <div id="misc" class="anchor"></div>--}}
{{--        <section class="grid-view category-section" data-category="misc" x-show="filter === 'clothing' || filter === 'all'">--}}
{{--            <div class="container">--}}
{{--                <h5 class="leading-tight mb-4 md:mb-5"><strong><i class="fas fa-shirt text-{{ $brand }} mr-1"></i> Misc</strong></h5>--}}
{{--                <div class="fixed-cards grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-2 md:gap-4 text-left">--}}

{{--                    @foreach($misc as $miscItem)--}}
{{--                        @include('musora.shop._shop-card-alt', [--}}
{{--                             "sku" => $miscItem->sku,--}}
{{--                             "itemURL" => '/drumshop/'.str_replace( array('Drumeo-', 'Pianote-', 'Guitareo-', 'Singeo-'), '', $miscItem->slug ),--}}
{{--                             "badgeText" => $miscItem->badge_text,--}}
{{--                             "thumbnail" => $miscItem->thumbnail,--}}
{{--                             "title" => $miscItem->name,--}}
{{--                             "cardDescription" => $miscItem->short_desc,--}}
{{--                             "fullPrice" => $miscItem->price,--}}
{{--                             "price" => $miscItem->discounted_price,--}}
{{--                             "sizes" => $miscItem->sizes,--}}
{{--                             "soldOut" => isset($products[$miscItem->sku]) ? $products[$miscItem->sku]->getStockAvailability() === 0 : $miscItem->sold_out,--}}
{{--                             "category" => strtolower($miscItem->productType->name),--}}
{{--                             "size_case_sensitive" => $miscItem->size_case_sensitive,--}}
{{--                        ])--}}
{{--                    @endforeach--}}

{{--                </div>--}}
{{--            </div>--}}
{{--        </section>--}}

        <div id="shirts" class="anchor"></div>
        <section class="grid-view category-section" data-category="shirts" x-show="filter === 'clothing' || filter === 'all'">
            <div class="container">
                <h5 class="leading-tight mb-4 md:mb-5"><strong><i class="fas fa-shirt text-{{ $brand }} mr-1"></i> Shirts</strong></h5>
                <div class="fixed-cards grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 2xl:grid-cols-5 gap-2 md:gap-4 text-left">

                @foreach($shirts as $shirt)
                    @include('musora.shop._shop-card-alt', [
                         "sku" => $shirt->sku,
                         "itemURL" => '/drumshop/'.str_replace( array('Drumeo-', 'Pianote-', 'Guitareo-', 'Singeo-'), '', $shirt->slug ),
                         "badgeText" => $shirt->badge_text,
                         "thumbnail" => $shirt->thumbnail,
                         "title" => $shirt->name,
                         "cardDescription" => $shirt->short_desc,
                         "fullPrice" => $shirt->price,
                         "price" => $shirt->discounted_price,
                         "sizes" => $shirt->sizes,
                         "soldOut" => isset($products[$shirt->sku]) ? $products[$shirt->sku]->getStockAvailability() === 0 : $shirt->sold_out,
                         "size_case_sensitive" => $shirt->size_case_sensitive,
                         "category" => strtolower($shirt->productType->name),
                    ])
                @endforeach
                @include('musora.shop._shop-card-alt', [
                     "badgeText" => "SEE MORE ON TEESPRING",
                     "itemURL" => "https://teespring.com/stores/drumeo",
                     "thumbnail" => "https://dpwjbsxqtam5n.cloudfront.net/drum-shop/card-thumbs/teespring.jpg",
                     "title" => "Teespring Drumeo Store",
                     "cardDescription" => "Check out our on-demand designs that are only available through Teespring.",
                     "specialPrice" => "Various Designs & Pricing",
                     "fullPrice" => 18,
                     "price" => 18,
                     "category" => "shirts",
                     "buttonText" => "VISIT TEESPRING <i class='fas fa-external-link'></i>",
                     "externalURL" => true,
                     'soldOut' => false,
                ])
                </div>
            </div>
        </section>

        {{--   HOODIES     --}}
        <div id="hoodies" class="anchor"></div>
        <section class="grid-view category-section" data-category="hoodies" x-show="filter === 'clothing' || filter === 'all'">
            <div class="container">
                <h5 class="leading-tight mb-4 md:mb-5"><strong><i class="fas fa-shirt-long-sleeve text-{{ $brand }} mr-1"></i> Hoodies</strong></h5>
                <div class="fixed-cards grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 2xl:grid-cols-5 gap-2 md:gap-4 text-left">

                @foreach($hoodies as $hoodie)
                    @include('musora.shop._shop-card-alt', [
                         "sku" => $hoodie->sku,
                         "itemURL" => '/drumshop/'.str_replace( array('Drumeo-', 'Pianote-', 'Guitareo-', 'Singeo-'), '', $hoodie->slug ),
                         "badgeText" => $hoodie->badge_text,
                         "thumbnail" => $hoodie->thumbnail,
                         "title" => $hoodie->name,
                         "cardDescription" => $hoodie->short_desc,
                         "fullPrice" => $hoodie->price,
                         "price" => $hoodie->discounted_price === '0.00' || empty($hoodie->discounted_price) ? $hoodie->price : $hoodie->discounted_price,
                         "sizes" => $hoodie->sizes,
                         "soldOut" => isset($products[$hoodie->sku]) ? $products[$hoodie->sku]->getStockAvailability() === 0 : $hoodie->sold_out,
                         "category" => strtolower($hoodie->productType->name),
                         "size_case_sensitive" => $hoodie->size_case_sensitive,
                    ])
                @endforeach
                </div>
            </div>
        </section>

        {{--   30DD     --}}
        <div id="30dd" class="anchor"></div>
        <section class="grid-view category-section" data-category="shirts" x-show="filter === 'clothing' || filter === 'all'">
            <div class="container">
                <h5 class="leading-tight mb-4 md:mb-5"><strong><i class="fas fa-shirt text-{{ $brand }} mr-1"></i> 30-Day Drummer Merch</strong></h5>
                <div class="fixed-cards grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 2xl:grid-cols-5 gap-2 md:gap-4 text-left">
                    @foreach($thirtyDD as $key => $thirtyDDItem)
                        @include('musora.shop._shop-card-alt', [
                            "itemURL" => '/drumshop/'.str_replace( array('Drumeo-', 'Pianote-', 'Guitareo-', 'Singeo-'), '', $thirtyDDItem->slug ),
                            "sku" => $thirtyDDItem->sku === 'drumeo' ? null : $thirtyDDItem->sku,
                            "badgeText" => $thirtyDDItem->badge_text,
                            "thumbnail" => $thirtyDDItem->thumbnail,
                            "packLogo" => $thirtyDDItem->thumbnail_logo,
                            "title" => $thirtyDDItem->name,
                            "packAuthor" => $thirtyDDItem->instructor_name,
                            "cardDescription" => $thirtyDDItem->short_desc,
                            "fullPrice" => $thirtyDDItem->price,
                            "price" => $thirtyDDItem->discounted_price,
                            "category" => strtolower($thirtyDDItem->productType->name),
                            "buttonText" => $thirtyDDItem->sku === 'drumeo' || $thirtyDDItem->sku === 'pianote' || $thirtyDDItem->sku === 'singeo' || $thirtyDDItem->sku === 'guitareo' ? 'see the deal' : null,
                            "soldOut" => $thirtyDDItem->sold_out,
                            "includedEdge" => $thirtyDDItem->included_edge,
                            "sizes" => $thirtyDDItem->sizes,
                            'FCP' => $key < 4 ? true : null,
                            "size_case_sensitive" => $thirtyDDItem->size_case_sensitive,
                        ])
                    @endforeach
                </div>
            </div>
        </section>
    </div>
@endsection

@section('layout-footer')
    @include("drumeo.sales.partials._footer")
@endsection

