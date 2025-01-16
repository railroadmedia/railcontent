@extends('_partials.layout.global-shop-layout')

@section('meta')
    <title>Pianote Shop</title>
    <meta property="og:title" content="Pianote Shop">

    <meta name="description" content="Get Lessons, T-Shirts, & Much More!">
    <meta property="og:description" content="Get Lessons, T-Shirts, & Much More!">

    <meta property="og:image" content="https://d2vyvo0tyx8ig5.cloudfront.net/sales/2023/share-image-pianote2.jpg">
    <meta property="og:url" content="https://www.pianote.com/{{ Request::path() }}">

    <style>
        .splide__pagination__page.is-active {
            background:#ddd!important;
        }
        .splide .splide__arrow svg {
            fill:#F61A30 !important;
        }
    </style>
    <style>
        @media (min-width: 1536px) { /* Desktop */
            .product-wrap:nth-child(n+11) {
                display: none;
            }
        }

        @media (min-width: 767px) and (max-width: 1535px) { /* Tablet */
            .product-wrap:nth-child(n+9) {
                display: none;
            }
        }

        @media screen and (max-width: 768px) { /* Mobile */
            .product-wrap:nth-child(n+7) {
                display: none;
            }
        }

        /* Show all when 'show-all' class is added */
        .show-all .product-wrap {
            display: block !important;
        }

        .join.outline.black {
            background:transparent;
            border:2px solid #000;
            color:#000;
            outline:none!important;
        }

        .join.outline.black:hover,
        .join.outline.black:focus {
            background:#000;
            color:#fff;
        }
    </style>
@endsection

@section('x-data')
    filter: '{{ $category !== 'shop' ? $category : 'all' }}',
    isIndexPage: {{ $isIndexPage ?? 'true' }},
@endsection

@section('layout-header')
    @include('pianote.sales.partials._nav', [
        "cartVersion" => true
    ])
@endsection

@section('body')
    @include('_partials.components.shop.shop-header',[
        'text' => 'GET LESSONS, MERCH, <br class="inline md:hidden"> GEAR & MORE!',
        'logo' => 'https://d21q7xesnoiieh.cloudfront.net/fit-in/427x0/filters:quality(95)/marketing/pianote/membership/homepage/2023/pianote-logo-red.png',
        'logoStyles' => 'h-12 sm:h-20 pb-2 sm:pb-3',
        'bg' => 'https://d2vyvo0tyx8ig5.cloudfront.net/shop/header-background.jpg',
    ])

    @include('_partials.components.shop.index-filters')

    <div class="sm:px-4 lg:px-5 py-5 sm:py-8 lg:py-10">
        <section x-show="filter === 'all'">
            <div class="container mx-auto">
                <h5 class="leading-tight mb-4 md:mb-5"><strong><i class="fas fa-fire text-{{ $brand }} mr-1"></i> Featured</strong></h5>
                <div class="flex flex-wrap mb-5 sm:mb-10">
                    <a href="/new-year" class="w-full mx-auto p-1 sm:p-2 sm:w-1/2 transition-opacity duration-500 hover:opacity-90">
                        <div class="flex items-center w-full overflow-hidden relative text-white rounded-xl pb-[71%]" style="padding-bottom:71%;">
                            <div class="hidden sm:inline-block absolute inset-0 z-0 bg-cover bg-center" style="background-position:30% 0;background-image:url('https://d21q7xesnoiieh.cloudfront.net/fit-in/1500x0/filters:quality(95)/marketing/pianote/promos/january/new-year-bundle.webp');"></div>
                            <div class="inline-block sm:hidden absolute inset-0 z-0 bg-cover bg-top" style="background-image:url('https://d21q7xesnoiieh.cloudfront.net/fit-in/800x0/filters:quality(95)/marketing/pianote/promos/january/new-year-bundle-m.webp');"></div>
                        </div>
                    </a>
                    <a href="/shop/prima" class="w-full mx-auto p-1 sm:p-2 sm:w-1/2 transition-opacity duration-500 hover:opacity-90">
                        <div class="flex items-center w-full overflow-hidden relative text-white rounded-xl pb-[71%]" style="padding-bottom:71%;">
                            <div class="hidden sm:inline-block absolute inset-0 z-0 bg-cover bg-center" style="background-position:30% 0;background-image:url('https://d21q7xesnoiieh.cloudfront.net/fit-in/1500x0/filters:quality(95)/marketing/pianote/promos/january/keyboard-bundle.webp');"></div>
                            <div class="inline-block sm:hidden absolute inset-0 z-0 bg-cover bg-top" style="background-image:url('https://d21q7xesnoiieh.cloudfront.net/fit-in/800x0/filters:quality(95)/marketing/pianote/promos/january/keyboard-bundle-m.webp');"></div>
                        </div>
                    </a>
                </div>
            </div>
        </section>
        <div id="lessons" class="anchor"></div>
        <section class="grid-view category-section" data-category="lessons" x-show="filter === 'lessons' || filter === 'all'">
            <div class="container" x-data="{ showAll: false }">
                <h5 class="leading-tight mb-4 md:mb-5"><strong><i class="fas fa-globe-pointer text-{{ $brand }} mr-1"></i> Digital Lessons</strong></h5>
                <div class="fixed-cards grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 2xl:grid-cols-5 gap-2 md:gap-4 text-left"
                     :class="{ 'show-all': showAll || (!isIndexPage && filter !== 'all') || filter === 'lessons' }">
{{--                @include('_partials.components.shop.product-card', [--}}
{{--                    "badge" => "7-Day Free Trial",--}}
{{--                      "price" => 240,--}}
{{--                     "instructor" => "Unlimited Piano Lessons",--}}
{{--                      "discounted_price" => 240,--}}
{{--                      "thumbnail" => "https://d2vyvo0tyx8ig5.cloudfront.net/sales/promos/july/pianote-membership-shop.jpg",--}}
{{--                      "title" => "Pianote Membership",--}}
{{--                      'soldOut' => false,--}}
{{--                        "href" => "/",--}}
{{--                 ])--}}
                @foreach($lessons as $key => $lesson)
                    @include('_partials.components.shop.product-card', [
                        "badge" => $lesson->badge_text,
                        "price" => $lesson->price,
                        "href" => '/shop/'.str_replace( array('Drumeo-', 'Pianote-', 'Guitareo-', 'Singeo-'), '', $lesson->slug ),
                        "instructor" => $lesson->instructor_name,
                        "logo" => $lesson->thumbnail_logo,
                        "discounted_price" => $lesson->discounted_price,
                        "soldOut" => $lesson->sold_out,
                        "thumbnail" => $lesson->thumbnail,
                        "title" => $lesson->name,
                        'fetch' => $key < 4 ? true : null,
                        "sku" => $lesson->sku === 'drumeo' || $lesson->sku === 'pianote' || $lesson->sku === 'singeo' || $lesson->sku === 'guitareo' ? null : $lesson->sku,
                    ])
                @endforeach
{{--                    @include('_partials.components.shop.product-card', [--}}
{{--                        "discounted_price" => 90,--}}
{{--                        "href" => "https://www.musora.com/gift-card",--}}
{{--                        "instructor" => "Award-Winning Membership",--}}
{{--                        "price" =>  90,--}}
{{--                        "thumbnail" => "https://d21q7xesnoiieh.cloudfront.net/fit-in/380x0/filters:quality(95)/marketing/musora/membership/redeem/access-pass.jpg",--}}
{{--                        "title" => "Musora Gift Cards",--}}
{{--                        'soldOut' => false,--}}
{{--                    ])--}}
            </div>
                <div class="-mt-3 sm:-mt-5 lg:-mt-8 lg:mb-10 text-center" x-show="isIndexPage && filter === 'all'">
                    <span
                        @click="showAll = true"
                        x-show="!showAll"
                        class="join outline black smaller">
                        See More
                    </span>
                </div>
            </div>
        </section>

        <section class="grid-view category-section" data-category="gifts" x-show="filter === 'gifts' || filter === 'all'">
            <div class="container">
                <h5 class="leading-tight mb-4 md:mb-5"><strong><i class="fas fa-gift text-{{ $brand }} mr-1"></i> Gifts</strong></h5>
                <div class="fixed-cards grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 2xl:grid-cols-5 gap-2 md:gap-4 text-left">
                    @include('_partials.components.shop.product-card', [
                        "sku" => 'musora-gift-card-50',
                        "discounted_price" => 50,
                        "href" => "https://www.musora.com/electronic-gift-card?amount=50",
                        "price" =>  50,
                        "thumbnail" => "https://d21q7xesnoiieh.cloudfront.net/fit-in/590x0/filters:quality(95)/marketing/drumeo/promos/november/2024/gc-50.webp",
                        "title" => "$50 Digital Gift Card",
                        'soldOut' => false,
                    ])
                    @include('_partials.components.shop.product-card', [
                        "sku" => 'musora-gift-card-100',
                        "discounted_price" => 100,
                        "href" => "https://www.musora.com/electronic-gift-card?amount=100",
                        "price" =>  100,
                        "thumbnail" => "https://d21q7xesnoiieh.cloudfront.net/fit-in/590x0/filters:quality(95)/marketing/drumeo/promos/november/2024/gc-100.webp",
                        "title" => "$100 Digital Gift Card",
                        'soldOut' => false,
                    ])
                    @include('_partials.components.shop.product-card', [
                        "sku" => 'musora-gift-card-240',
                        "discounted_price" => 240,
                        "href" => "https://www.musora.com/electronic-gift-card?amount=240",
                        "price" =>  240,
                        "thumbnail" => "https://d21q7xesnoiieh.cloudfront.net/fit-in/590x0/filters:quality(95)/marketing/drumeo/promos/november/2024/gc-240.webp",
                        "title" => "$240 Digital Gift Card",
                        'soldOut' => false,
                    ])
                </div>
            </div>
        </section>

        {{--   ACCESSORIES     --}}
        <div id="accessories" class="anchor"></div>
        <section class="grid-view category-section" data-category="shirts" x-show="filter === 'accessories' || filter === 'all'">
            <div class="container" x-data="{ showAll: false }">
                <h5 class="leading-tight mb-4 md:mb-5"><strong><i class="fas fa-suitcase text-{{ $brand }} mr-1"></i> Physical Products</strong></h5>
                <div class="fixed-cards grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 2xl:grid-cols-5 gap-2 md:gap-4 text-left"
                    :class="{ 'show-all': showAll || (!isIndexPage && filter !== 'all') || filter === 'accessories' }">
                @include('_partials.components.shop.product-card', [
                    "href" => "/shop/prima",
                     "price" => 1474,
                     "discounted_price" => 599,
                     "title" => "The Keyboard Bundle",
                     "thumbnailFull" => "https://d21q7xesnoiieh.cloudfront.net/fit-in/520x0/filters:quality(95)/marketing/pianote/promos/black-friday/shop/keyboard-bundle.webp",
                     'soldOut' => false,
                ])

                @include('_partials.components.shop.product-card', [
                    "href" => "/shop/prima-ultimate",
                     "price" => 1642,
                     "discounted_price" => 799,
                     "title" => "The ULTIMATE Bundle",
                     "thumbnailFull" => "https://d21q7xesnoiieh.cloudfront.net/fit-in/520x0/filters:quality(95)/marketing/pianote/promos/black-friday/shop/ultimate-bundle.webp",
                     'soldOut' => false,
                ])
                @foreach($accessories as $accessory)
                    @include('_partials.components.shop.product-card', [
                        "badge" => $accessory->badge_text,
                        "price" => $accessory->price,
                        "href" => '/shop/'.str_replace( array('Drumeo-', 'Pianote-', 'Guitareo-', 'Singeo-'), '', $accessory->slug ),
                        "discounted_price" => $accessory->discounted_price,
                        "size_case_sensitive" => $accessory->size_case_sensitive,
                        "sizes" => $accessory->sizes,
                        "soldOut" => isset($products[$accessory->sku]) ? $products[$accessory->sku]->getStockAvailability() === 0 : $accessory->sold_out,
                        "thumbnail" => $accessory->thumbnail,
                        "title" => $accessory->name,
                        "sku" => (str_contains($accessory->sku, 'member') || str_contains($accessory->sku, 'products')) ? '' : $accessory->sku,
                    ])
                @endforeach
            </div>
                <div class="-mt-3 sm:-mt-5 lg:-mt-8 lg:mb-10 text-center" x-show="isIndexPage && filter === 'all'">
                    <span
                        @click="showAll = true"
                        x-show="!showAll"
                        class="join outline black smaller">
                        See More
                    </span>
                </div>
            </div>
        </section>

        {{--   SHIRTS     --}}
        <div id="shirts" class="anchor"></div>
        <section class="grid-view category-section" data-category="shirts" x-show="filter === 'clothing' || filter === 'all'">
            <div class="container">
                <h5 class="leading-tight mb-4 md:mb-5"><strong><i class="fas fa-shirt text-{{ $brand }} mr-1"></i> Merch</strong></h5>
                <div class="fixed-cards grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 2xl:grid-cols-5 gap-2 md:gap-4 text-left">
                    @foreach($shirts as $item)
                        @include('_partials.components.shop.product-card', [
                            "badge" => $item->badge_text,
                            "price" => $item->price,
                            "href" => '/shop/'.str_replace( array('Drumeo-', 'Pianote-', 'Guitareo-', 'Singeo-'), '', $item->slug ),
                            "discounted_price" => $item->discounted_price,
                            "size_case_sensitive" => $item->size_case_sensitive,
                            "sizes" => $item->sizes,
                            "soldOut" => isset($products[$item->sku]) ? $products[$item->sku]->getStockAvailability() === 0 : $item->sold_out,
                            "thumbnail" => $item->thumbnail,
                            "title" => $item->name,
                            "sku" => $item->sku,
                        ])
                    @endforeach
                    @foreach($hoodies as $hoodie)
                        @include('_partials.components.shop.product-card', [
                            "badge" => $hoodie->badge_text,
                            "price" => $hoodie->price,
                            "href" => '/shop/'.str_replace( array('Drumeo-', 'Pianote-', 'Guitareo-', 'Singeo-'), '', $hoodie->slug ),
                            "discounted_price" => $hoodie->discounted_price,
                            "size_case_sensitive" => $hoodie->size_case_sensitive,
                            "sizes" => $hoodie->sizes,
                            "soldOut" => isset($products[$hoodie->sku]) ? $products[$hoodie->sku]->getStockAvailability() === 0 : $hoodie->sold_out,
                            "thumbnail" => $hoodie->thumbnail,
                            "title" => $hoodie->name,
                            "sku" => $hoodie->sku,
                        ])
                    @endforeach

                        @foreach($misc as $miscItem)
                            @include('_partials.components.shop.product-card', [
                                 "sku" => $miscItem->sku,
                                 "href" => '/shop/'.str_replace( array('Drumeo-', 'Pianote-', 'Guitareo-', 'Singeo-'), '', $miscItem->slug ),
                                 "badge" => $miscItem->badge_text,
                                 "thumbnail" => $miscItem->thumbnail,
                                 "title" => $miscItem->name,
                                 "cardDescription" => $miscItem->short_desc,
                                 "price" => $miscItem->price,
                                 "discounted_price" => $miscItem->discounted_price,
                                 "sizes" => $miscItem->sizes,
                                 "soldOut" => isset($products[$miscItem->sku]) ? $products[$miscItem->sku]->getStockAvailability() === 0 : $miscItem->sold_out,
                                 "category" => strtolower($miscItem->productType->name),
                                 "size_case_sensitive" => $miscItem->size_case_sensitive,
                            ])
                        @endforeach
            </div>
            </div>
        </section>
    </div>
@endsection

@section('layout-footer')
    @include('pianote.sales.partials._footer')
@endsection
