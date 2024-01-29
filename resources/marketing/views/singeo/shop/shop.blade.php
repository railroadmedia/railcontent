@extends('_partials.layout.global-shop-layout')

@section('meta')
    <title>Singeo Shop</title>
    <meta property="og:title" content="Singeo Shop - Get Lessons, T-Shirts, & More!">
    <meta name="description" content="Singeo.com: Your start-to-finish guide to confident singing">
    <meta property="og:description" content="Singeo.com: Your start-to-finish guide to confident singing">

    <meta property="og:image" content="https://d21xeg6s76swyd.cloudfront.net/sales/2022/og-image.jpg">
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
    @include('_partials.components.shop.promo-shop-header',[
        'text' => 'GET LESSONS, MERCH, GEAR, & MUCH MORE',
        'bg' => 'https://d21xeg6s76swyd.cloudfront.net/products/shop-header.jpg',
    ])

    @include('_partials.components.shop.index-filters')

    <div class="sm:px-4 lg:px-5 py-5 sm:py-8 lg:py-10">

        <div id="lessons" class="anchor"></div>
        <section class="grid-view category-section" data-category="lessons" x-show="filter === 'lessons' || filter === 'all'">
            <div class="container">
                <h5 class="leading-tight mb-4 md:mb-5"><strong><i class="fas fa-video text-{{ $brand }} mr-1"></i> Singing Lessons</strong></h5>
                <div class="fixed-cards grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 2xl:grid-cols-5 gap-2 md:gap-4 text-left">
                    @include('_partials.components.shop.product-card', [
                        "fullPrice" => 240,
                        "packAuthor" => "7-Day Free Trial",
                        "price" => 240,
                        "thumbnail" => "https://d21xeg6s76swyd.cloudfront.net/sales/promos/july/singeo-membership-shop.jpg",
                        "title" => "Singeo Membership",
                        'soldOut' => false,
                        "itemURL" => "/",
                    ])

                    @foreach($lessons as $key => $lesson)
                        @include('_partials.components.shop.product-card', [
                            "badgeText" => $lesson->badge_text,
                            "fullPrice" => $lesson->price,
                            "itemURL" => '/shop/'.str_replace( array('Drumeo-', 'Pianote-', 'Guitareo-', 'Singeo-'), '', $lesson->slug ),
                            "packAuthor" => $lesson->instructor_name,
                            "packLogo" => $lesson->thumbnail_logo,
                            "price" => $lesson->discounted_price,
                            "soldOut" => $lesson->sold_out,
                            "thumbnail" => $lesson->thumbnail,
                            "title" => $lesson->name,
                            'FCP' => $key < 4 ? true : null,
                            "sku" => $lesson->sku === 'drumeo' || $lesson->sku === 'pianote' || $lesson->sku === 'singeo' || $lesson->sku === 'guitareo' ? null : $lesson->sku,
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
                        @include('_partials.components.shop.product-card', [
                            "badgeText" => $accessory->badge_text,
                            "fullPrice" => $accessory->price,
                            "itemURL" => '/shop/'.str_replace( array('Drumeo-', 'Pianote-', 'Guitareo-', 'Singeo-'), '', $accessory->slug ),
                            "price" => $accessory->discounted_price,
                            "size_case_sensitive" => $accessory->size_case_sensitive,
                            "sizes" => $accessory->sizes,
                            "soldOut" => isset($products[$accessory->sku]) ? $products[$accessory->sku]->getStockAvailability() === 0 : $accessory->sold_out,
                            "thumbnail" => $accessory->thumbnail,
                            "title" => $accessory->name,
                            "sku" => (str_contains($accessory->sku, 'member') || str_contains($accessory->sku, 'products')) ? '' : $accessory->sku,
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
                        @include('_partials.components.shop.product-card', [
                            "badgeText" => $shirt->badge_text,
                            "fullPrice" => $shirt->price,
                            "itemURL" => '/shop/'.str_replace( array('Drumeo-', 'Pianote-', 'Guitareo-', 'Singeo-'), '', $shirt->slug ),
                            "price" => $shirt->discounted_price,
                            "size_case_sensitive" => $shirt->size_case_sensitive,
                            "sizes" => $shirt->sizes,
                            "soldOut" => isset($products[$shirt->sku]) ? $products[$shirt->sku]->getStockAvailability() === 0 : $shirt->sold_out,
                            "thumbnail" => $shirt->thumbnail,
                            "title" => $shirt->name,
                            "sku" => $shirt->sku,
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
