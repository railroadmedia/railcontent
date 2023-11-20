@php
    require_once(resource_path('marketing/views/pianote/shop/bundles.php'))
@endphp

@extends('_partials.layout.global-shop-layout')

@section('meta')
    <title>Pianote Shop</title>
    <meta property="og:title" content="Pianote Shop">
    <meta name="description" content="Get Lessons, T-Shirts, & Much More!">
    <meta property="og:description" content="Get Lessons, T-Shirts, & Much More!">
{{--    @if(Carbon\Carbon::create(2023, 8, 1, 10, 0, 0, 'America/Vancouver') > Carbon\Carbon::now())--}}
{{--        <meta property="og:image" content="https://dpwjbsxqtam5n.cloudfront.net/promos/july/pianote-summer-share-image.jpg">--}}
{{--    @else--}}
        <meta property="og:image" content="https://d2vyvo0tyx8ig5.cloudfront.net/sales/2023/share-image-pianote2.jpg">
{{--    @endif--}}
    <meta property="og:url" content="https://www.pianote.com/{{ Request::path() }}">
@endsection

@section('x-data')
    filter: '{{ $category !== 'shop' ? $category : 'all' }}',
@endsection

@section('layout-header')
    @include('pianote.sales.partials._nav', [
        "cartVersion" => true
    ])
@endsection

@section('body')
    <header class="drum-shop-header">
        <picture>
            <source media="(min-width: 640px)" srcset="https://www.musora.com/musora-cdn/image/width=2000,quality=95/https://d2vyvo0tyx8ig5.cloudfront.net/shop/header-background.jpg">
            <img class="absolute w-full h-full top-0 left-0 object-center object-cover" src="https://www.musora.com/musora-cdn/image/width=500,quality=95/https://d2vyvo0tyx8ig5.cloudfront.net/shop/header-background.jpg" alt="header background image" fetchpriority="high" />
        </picture>
        <div class="container mx-auto relative z-10">
            <div class="px-2 md:px-3">
                <div class="float-left px-2 md:px-3 w-full">
                    <img class="h-12 sm:h-14 md:h-24 lg:h-28 mb-4" src="https://d2vyvo0tyx8ig5.cloudfront.net/shop/pianote-shop-logo.png" alt="pianote logo" fetchpriority="high">
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

    @include('drumeo.drumshop._partials._catalogue-filters')
    <div class="sm:px-4 lg:px-5 py-5 sm:py-8 lg:py-10">
        <div id="lessons" class="anchor"></div>
        <section class="grid-view category-section" data-category="lessons" x-show="filter === 'lessons' || filter === 'all'">
            <div class="container">
                <h5 class="leading-tight mb-4 md:mb-5"><strong><i class="fas fa-video text-{{ $brand }} mr-1"></i> Piano Lessons</strong></h5>
                <div class="fixed-cards grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-2 md:gap-4 text-left">
                    @include('musora.shop._shop-card-alt', [
                          "itemURL" => "/",
                          "sku" => null,
                          "thumbnail" => "https://d2vyvo0tyx8ig5.cloudfront.net/sales/promos/july/pianote-membership-shop.jpg",
                          "title" => "Pianote Membership",
                          "packAuthor" => "Lisa Witt",
                          "cardDescription" => "Perfectly structured step by step lessons, with teachers that are fun to watch, and unlimited support - 100% guaranteed. Learn piano online the easy way.",
                          "specialPrice" => "7-Day Free Trial",
                          "fullPrice" => 240,
                          "price" => 240,
                          "category" => "lessons",
                          "buttonText" => "Start For Free <i class='fas fa-arrow-right'></i>",
                          'soldOut' => false,
                     ])

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
                <div class="fixed-cards grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-2 md:gap-4 text-left">
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

        {{--   MISC     --}}
        <div id="misc" class="anchor"></div>
        <section class="grid-view category-section" data-category="misc" x-show="filter === 'clothing' || filter === 'all'">
            <div class="container">
                <h5 class="leading-tight mb-4 md:mb-5"><strong><i class="fas fa-shirt text-{{ $brand }} mr-1"></i> Misc</strong></h5>
                <div class="fixed-cards grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-2 md:gap-4 text-left">

                    @foreach($misc as $miscItem)
                    @include('musora.shop._shop-card-alt', [
                         "sku" => $miscItem->sku,
                         "itemURL" => '/shop/'.str_replace( array('Drumeo-', 'Pianote-', 'Guitareo-', 'Singeo-'), '', $miscItem->slug ),
                         "badgeText" => $miscItem->badge_text,
                         "thumbnail" => $miscItem->thumbnail,
                         "title" => $miscItem->name,
                         "cardDescription" => $miscItem->short_desc,
                         "fullPrice" => $miscItem->price,
                         "price" => $miscItem->discounted_price,
                         "sizes" => $miscItem->sizes,
                         "soldOut" => isset($products[$miscItem->sku]) ? $products[$miscItem->sku]->getStockAvailability() === 0 : $miscItem->sold_out,
                         "category" => strtolower($miscItem->productType->name),
                         "size_case_sensitive" => $miscItem->size_case_sensitive,
                    ])
                @endforeach

            </div>
            </div>
        </section>

        {{--   SHIRTS     --}}
        <div id="shirts" class="anchor"></div>
        <section class="grid-view category-section" data-category="shirts" x-show="filter === 'clothing' || filter === 'all'">
            <div class="container">
                <h5 class="leading-tight mb-4 md:mb-5"><strong><i class="fas fa-shirt text-{{ $brand }} mr-1"></i> Shirts</strong></h5>
                <div class="fixed-cards grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-2 md:gap-4 text-left">

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

        {{--   HOODIES     --}}
        <div id="hoodies" class="anchor"></div>
        <section class="grid-view category-section" data-category="shirts" x-show="filter === 'clothing' || filter === 'all'">
            <div class="container">
                <h5 class="leading-tight mb-4 md:mb-5"><strong><i class="fas fa-shirt text-{{ $brand }} mr-1"></i> Hoodies</strong></h5>
                <div class="fixed-cards grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-2 md:gap-4 text-left">

                    @foreach($hoodies as $hoodie)
                    @include('musora.shop._shop-card-alt', [
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
                        "soldOut" => isset($products[$hoodie->sku]) ? $products[$hoodie->sku]->getStockAvailability() === 0 :$hoodie->sold_out,
                        "size_case_sensitive" => $hoodie->size_case_sensitive,
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
