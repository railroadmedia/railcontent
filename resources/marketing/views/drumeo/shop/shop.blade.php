@extends('_partials.layout.global-shop-layout')

@section('meta')
    <title>Drumeo Drum Shop - Get Lessons, T-Shirts, Gear, & Much More!</title>
    <meta property="og:title" content="Drumeo Drum Shop - Get Lessons, T-Shirts, Gear, & Much More!">

    <meta name="description" content="Take your drumming to the next level with the largest collection of drum lessons in the world - or gear up for success with a selection of drum gear, t-shirts, sticks, and other cool drum swag.">
    <meta property="og:description" content="Take your drumming to the next level with the largest collection of drum lessons in the world - or gear up for success with a selection of drum gear, t-shirts, sticks, and other cool drum swag.">

    <meta property="og:image" content="https://dpwjbsxqtam5n.cloudfront.net/drum-shop/og-image.jpg">

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
    @include('_partials.components.shop.promo-shop-header',[
        'text' => 'GET LESSONS, MERCH, GEAR, & MUCH MORE',
        'bg' => 'https://dpwjbsxqtam5n.cloudfront.net/drum-shop/header-background.jpg',
        'logo' => 'https://d21q7xesnoiieh.cloudfront.net/fit-in/543x0/filters:quality(95)/marketing/drumeo/membership/homepage/2023/logo-blue.png',
        'logoStyles' => 'h-6 sm:h-8 mb-1',
    ])
{{--    'logoStyles' => 'h-12 sm:h-20 pb-3 sm:pb-4',--}}

    @include('_partials.components.shop.index-filters', [
        "all" => true
    ])

    <div class="sm:px-4 lg:px-5 py-5 sm:py-8 lg:py-10">
        @php
            $bundles = [
                [
                    'slug' => '/clothing',
                    'desc' => 'This month only - add Drumeo t-shirts<br> and hoodies to your cart for just $1.',
                    'full' => true,
                    'visible' => 1,
                    'buttonColor' => '#0A69D0',
                    'buttonText' => 'GET YOURS',
                    'logo' => "https://d21q7xesnoiieh.cloudfront.net/fit-in/530x0/filters:quality(95)/marketing/drumeo/promos/february/drumeo-dollar-logo.png",
                    'img' => 'https://d21q7xesnoiieh.cloudfront.net/fit-in/2000x0/filters:quality(95)/marketing/drumeo/promos/february/single-banner-drumeo.jpg',
                    'imgM' => 'https://d21q7xesnoiieh.cloudfront.net/fit-in/700x0/filters:quality(95)/marketing/drumeo/promos/february/drumeo-dollar-banner-m.jpg',
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
                                @foreach($featured as $key => $item)
                                    <li class="splide__slide px-1">
                                        @include('_partials.components.shop.product-card', [
                                            "badge" => $item->badge_text,
                                            "discounted_price" => $item->discounted_price,
                                            "href" => '/drumshop/'.str_replace( array('Drumeo-', 'Pianote-', 'Guitareo-', 'Singeo-'), '', $item->slug ),
                                            "instructor" => $item->instructor_name,
                                            "logo" => $item->thumbnail_logo,
                                            "price" => $item->price,
                                            "size_case_sensitive" => $item->size_case_sensitive,
                                            "sizes" => $item->sizes,
                                            "sku" => $item->sku,
                                            "soldOut" => isset($products[$item->sku]) ? $products[$item->sku]->getStockAvailability() === 0 : $item->sold_out,
                                            "thumbnail" => $item->thumbnail,
                                            "title" => $item->name,
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
                @include('_partials.components.shop.product-card', [
                     "discounted_price" => 240,
                     "href" => "/#customize-anchor",
                     "instructor" => "Award-Winning Membership",
                     "price" => 240,
                     "thumbnail" => "https://dpwjbsxqtam5n.cloudfront.net/promos/july/drumeo-membership-shop.jpg",
                     "title" => "Drumeo Membership",
                     'soldOut' => false,
                ])
                @foreach($lessons as $key => $item)
                    @include('_partials.components.shop.product-card', [
                        "badge" => $item->badge_text,
                        "discounted_price" => $item->discounted_price,
                        "href" => '/drumshop/'.str_replace( array('Drumeo-', 'Pianote-', 'Guitareo-', 'Singeo-'), '', $item->slug ),
                        "instructor" => $item->instructor_name,
                        "logo" => $item->thumbnail_logo,
                        "price" => $item->price,
                        "sku" => $item->sku === 'drumeo' || $item->sku === 'pianote' || $item->sku === 'singeo' || $item->sku === 'guitareo' ? null : $item->sku,
                        "soldOut" => $item->sold_out,
                        "thumbnail" => $item->thumbnail,
                        "title" => $item->name,
                        'fetch' => $key < 4 ? true : null,
                    ])
                @endforeach

                @include('_partials.components.shop.product-card', [
                    "discounted_price" => 29,
                    "href" => "https://www.musora.com/gift-card",
                    "instructor" => "Award-Winning Membership",
                    "price" =>29,
                    "thumbnail" => "https://d1923uyy6spedc.cloudfront.net/Drumeo-cart-2-1643147388.png",
                    "title" => "Gift Card",
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
                @foreach($accessories as $item)
                    @include('_partials.components.shop.product-card', [
                        "badge" => $item->badge_text,
                        "discounted_price" => $item->discounted_price,
                        "href" => '/drumshop/'.str_replace( array('Drumeo-', 'Pianote-', 'Guitareo-', 'Singeo-'), '', $item->slug ),
                        "price" => $item->price,
                        "size_case_sensitive" => $item->size_case_sensitive,
                        "sizes" => $item->sizes,
                        "sku" => (str_contains($item->sku, 'member') || str_contains($item->sku, 'products')) ? '' : $item->sku,
                        "soldOut" => isset($products[$item->sku]) ? $products[$item->sku]->getStockAvailability() === 0 : $item->sold_out,
                        "thumbnail" => $item->thumbnail,
                        "title" => $item->name,
                    ])
                @endforeach
                </div>
            </div>
        </section>


        {{--   one dollar     --}}
        <div id="oneDollar" class="anchor"></div>
        <section class="grid-view category-section" data-category="shirts" x-show="filter === 'clothing' || filter === 'all'">
            <div class="container">
                <h5 class="leading-tight mb-4 md:mb-5"><strong><i class="fas fa-shirt text-{{ $brand }} mr-1"></i> $1 Drum Merch</strong></h5>
                <div class="fixed-cards grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 2xl:grid-cols-5 gap-2 md:gap-4 text-left">
                    @foreach($sale1dollar as $key => $item)
                        @include('_partials.components.shop.product-card', [
                        "badge" => $item->badge_text,
                        "discounted_price" => $item->discounted_price,
                        "href" => '/drumshop/'.str_replace( array('Drumeo-', 'Pianote-', 'Guitareo-', 'Singeo-'), '', $item->slug ),
                        "price" => $item->price,
                        "size_case_sensitive" => $item->size_case_sensitive,
                        "sizes" => $item->sizes,
                        "sku" => $item->sku,
                        "soldOut" => isset($products[$item->sku]) ? $products[$item->sku]->getStockAvailability() === 0 : $item->sold_out,
                        "thumbnail" => $item->thumbnail,
                        "title" => $item->name,
                        ])
                    @endforeach
                </div>
            </div>
        </section>

        <div id="shirts" class="anchor"></div>
        <section class="grid-view category-section" data-category="shirts" x-show="filter === 'clothing' || filter === 'all'">
            <div class="container">
                <h5 class="leading-tight mb-4 md:mb-5"><strong><i class="fas fa-shirt text-{{ $brand }} mr-1"></i> Shirts</strong></h5>
                <div class="fixed-cards grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 2xl:grid-cols-5 gap-2 md:gap-4 text-left">

                @foreach($shirts as $item)
                    @include('_partials.components.shop.product-card', [
                        "badge" => $item->badge_text,
                        "discounted_price" => $item->discounted_price,
                        "href" => '/drumshop/'.str_replace( array('Drumeo-', 'Pianote-', 'Guitareo-', 'Singeo-'), '', $item->slug ),
                        "price" => $item->price,
                        "size_case_sensitive" => $item->size_case_sensitive,
                        "sizes" => $item->sizes,
                        "sku" => $item->sku,
                        "soldOut" => isset($products[$item->sku]) ? $products[$item->sku]->getStockAvailability() === 0 : $item->sold_out,
                        "thumbnail" => $item->thumbnail,
                        "title" => $item->name,
                    ])
                @endforeach
                @include('_partials.components.shop.product-card', [
                     "badge" => "SEE MORE ON TEESPRING",
                     "discounted_price" => 18,
                     "external" => true,
                     "href" => "https://teespring.com/stores/drumeo",
                     "price" => 18,
                     "thumbnail" => "https://dpwjbsxqtam5n.cloudfront.net/drum-shop/card-thumbs/teespring.jpg",
                     "title" => "Teespring Drumeo Store",
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

                @foreach($hoodies as $item)
                    @include('_partials.components.shop.product-card', [
                            "badge" => $item->badge_text,
                            "discounted_price" => $item->discounted_price,
                            "href" => '/drumshop/'.str_replace( array('Drumeo-', 'Pianote-', 'Guitareo-', 'Singeo-'), '', $item->slug ),
                            "price" => $item->price,
                            "size_case_sensitive" => $item->size_case_sensitive,
                            "sizes" => $item->sizes,
                            "sku" => $item->sku,
                            "soldOut" => isset($products[$item->sku]) ? $products[$item->sku]->getStockAvailability() === 0 : $item->sold_out,
                            "thumbnail" => $item->thumbnail,
                            "title" => $item->name,
                    ])
                @endforeach
                </div>
            </div>
        </section>

        {{--   MISC     --}}
        <div id="misc" class="anchor"></div>
        <section class="grid-view category-section" data-category="misc" x-show="filter === 'clothing' || filter === 'all'">
            <div class="container">
                <h5 class="leading-tight mb-4 md:mb-5"><strong><i class="fas fa-shirt text-{{ $brand }} mr-1"></i> Misc</strong></h5>
                <div class="fixed-cards grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 2xl:grid-cols-5 gap-2 md:gap-4 text-left">
                    @foreach($misc as $item)
                        @include('_partials.components.shop.product-card', [
                            "badge" => $item->badge_text,
                            "discounted_price" => $item->discounted_price,
                            "href" => '/drumshop/'.str_replace( array('Drumeo-', 'Pianote-', 'Guitareo-', 'Singeo-'), '', $item->slug ),
                            "price" => $item->price,
                            "size_case_sensitive" => $item->size_case_sensitive,
                            "sizes" => $item->sizes,
                            "sku" => $item->sku,
                            "soldOut" => isset($products[$item->sku]) ? $products[$item->sku]->getStockAvailability() === 0 : $item->sold_out,
                            "thumbnail" => $item->thumbnail,
                            "title" => $item->name,
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
                    @foreach($thirtyDD as $key => $item)
                        @include('_partials.components.shop.product-card', [
                            "badge" => $item->badge_text,
                            "discounted_price" => $item->discounted_price,
                            "href" => '/drumshop/'.str_replace( array('Drumeo-', 'Pianote-', 'Guitareo-', 'Singeo-'), '', $item->slug ),
                            "price" => $item->price,
                            "size_case_sensitive" => $item->size_case_sensitive,
                            "sizes" => $item->sizes,
                            "sku" => $item->sku,
                            "soldOut" => isset($products[$item->sku]) ? $products[$item->sku]->getStockAvailability() === 0 : $item->sold_out,
                            "thumbnail" => $item->thumbnail,
                            "title" => $item->name,
                        ])
                    @endforeach
                </div>
            </div>
        </section>

        {{--   limited     --}}
        <div id="limited" class="anchor"></div>
{{--        <section class="grid-view category-section" data-category="shirts" x-show="filter === 'clothing' || filter === 'all'">--}}
{{--            <div class="container">--}}
{{--                <h5 class="leading-tight mb-4 md:mb-5"><strong><i class="fas fa-shirt text-{{ $brand }} mr-1"></i> Limited Sizes</strong></h5>--}}
{{--                <div class="fixed-cards grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 2xl:grid-cols-5 gap-2 md:gap-4 text-left">--}}
{{--                    @foreach($lowStock as $key => $item)--}}
{{--                        @include('_partials.components.shop.product-card', [--}}
{{--                            "badge" => $item->badge_text,--}}
{{--                            "discounted_price" => $item->discounted_price,--}}
{{--                            "href" => '/drumshop/'.str_replace( array('Drumeo-', 'Pianote-', 'Guitareo-', 'Singeo-'), '', $item->slug ),--}}
{{--                            "price" => $item->price,--}}
{{--                            "size_case_sensitive" => $item->size_case_sensitive,--}}
{{--                            "sizes" => $item->sizes,--}}
{{--                            "sku" => $item->sku,--}}
{{--                            "soldOut" => isset($products[$item->sku]) ? $products[$item->sku]->getStockAvailability() === 0 : $item->sold_out,--}}
{{--                            "thumbnail" => $item->thumbnail,--}}
{{--                            "title" => $item->name,--}}
{{--                        ])--}}
{{--                    @endforeach--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </section>--}}
    </div>
@endsection

@section('layout-footer')
    @include("drumeo.sales.partials._footer")
@endsection

