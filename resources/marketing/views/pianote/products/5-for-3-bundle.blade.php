@php
    require_once(resource_path('marketing/views/pianote/_partials/homepage-data.php'));
@endphp

@extends('_partials.layout.global-template')

@section('meta')
    <title>Pianote 5 for 3 bundle</title>
    <meta property="og:title" content="Pianote 5 for 3 bundle">
    <meta property="description" content="Get 5 years of Pianote for the price of 3.">
    <meta property="og:description" content="Get 5 years of Pianote for the price of 3.">
    <meta property="og:url" content="{{ get_legacy_brand_base_url($theme)}}/{{ Request::path() }}"/>
    <meta property="og:image" content="https://d21q7xesnoiieh.cloudfront.net/fit-in/1200x0/filters:quality(95)/marketing/pianote/promos/summer-sale/pianote-5-for-3-share-image.jpg">

@endsection

@section('layout-styles')
    <link href="{{ asset('marketing/css/tailwind-helpers.css') }}" rel="stylesheet">
    <link rel="preload" href="{{ mix('marketing/css/app.css') }}" as="style" onload="this.onload=null;this.rel='stylesheet'">
    <link rel="stylesheet" href="{{ asset('/marketing/parcel/drumeo/nav-footer-pianote.css') }}">
    <link href="{{ asset('/marketing/parcel/drumeo/navigation-sales.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('/marketing/parcel/drumeo/sales-pianote.css') }}">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.min.css"/>

    <style>
        .text-promo {
            color: #FFD600!important;
        }
        .border-promo {
            border-color: #FFD600!important;
        }
        .join {
            background: #F61A30;
        }

        .join:hover {
            background: #F61A30;
        }
                .beg-adv-text p:nth-child(2) {
                    transform: translate(-50%, 0);
                    left: 60%;
                }
                .beg-adv-text p:nth-child(3) {
                    transform: translate(-50%, 0);
                    left: 90%;
                }
                @media (min-width:768px) {
                    .beg-adv-text p:nth-child(3) {
                        left: 96%;
                    }
                }
                .beg-adv-bar div:nth-child(1) {
                    width: 60%;
                }
            </style>
@endsection

@section('layout-header')
    @include('pianote.sales.partials._nav',[
         "cartVersion" => true,
         'shopToMusora' => false,
    ])
@endsection

@section('layout-body')

   @include('_partials.components.shop.promo-banner-3', [
        "name" => "Pianote Summer Sale",
        "noBreadcrumb" => true,
        'bg' => 'https://d21q7xesnoiieh.cloudfront.net/fit-in/2500x0/filters:quality(95)/marketing/pianote/promos/summer-sale/header-bg.webp',
    ])

@php
$originalPrice = 1200;
$discountedPrice = 720;
$promoLink = '/ecommerce/add-to-cart?products[pianote_access_5-years]=1&products[musora-gift-card-150]=1&promo-code=&locked=true';
@endphp

    @include('pianote.products.partials._summer-promo', [
        'backgroundImageUrl' => 'https://d21q7xesnoiieh.cloudfront.net/fit-in/1200x0/filters:quality(95)/marketing/pianote/promos/summer-sale/bg.webp',
        'logoUrl' => 'https://d21q7xesnoiieh.cloudfront.net/fit-in/800x0/filters:quality(95)//marketing/pianote/promos/summer-sale/pianote-5-for-3-logo-horizontal.webp',
        'offerTitle' => 'Get 5 years of Pianote for the price of 3.',
        'spotsAvailable' => $products['pianote_access_5-years']->getPublicStockCount(),
        'headerImageUrl' => 'https://d21q7xesnoiieh.cloudfront.net/fit-in/1200x0/filters:quality(95)/marketing/pianote/promos/summer-sale/pianote-5-for-3-bundle.webp',
        'originalPrice' => $originalPrice,
        'discountedPrice' => $discountedPrice,
        'discountPercentage' => round((($originalPrice - $discountedPrice) / $originalPrice) * 100),
        'ctaLink' => $promoLink,
        ])



    <section class="py-20">
        <div class="max-w-4xl px-3 sm:px-4 container mx-auto z-10 relative text-center">
            <h2><strong>The 5-Year Advantage</strong></h2>
            <h6 class="mt-2 mb-12 opacity-90 text-gray-800 leading-tight"><em>You’ll have 5 years of unlimited access to<br class="sm:hidden"> Pianote for the price of 3 ($720 total).</em></h6>
            <div class="relative w-full rounded-full mx-auto h-10 beg-adv-text">
                <p class="absolute top-0 leading-none text-sm uppercase whitespace-nowrap text-left px-2"><strong>TODAY</strong></p>
                <p class="absolute top-0 leading-none text-sm uppercase whitespace-nowrap"><strong>YEAR 3</strong></p>
                <p class="absolute top-0 leading-none text-sm uppercase whitespace-nowrap text-right"><strong>YEAR 5</strong></p>
            </div>
            <div class="relative w-full rounded-full h-16 mx-auto flex space-between items-center beg-adv-bar" style="background-color: #61043A;">
                <div class="h-full flex items-center flex-wrap relative rounded-l-full" style="background:linear-gradient(to right, #61043A, #F61A30);">
                    <h4 class="uppercase leading-none w-full"><img class="h-7 sm:h-8" src="https://www.musora.com/musora-cdn/image/quality=95,width=250,metadata=none/https://d2vyvo0tyx8ig5.cloudfront.net/logo/pianote-logo-white.png" alt="Drumeo logo"></h4>
                    <h2 class="absolute right-0 text-white rounded-full px-6 py-3.5 -mr-7 mt-1" style="background-color:#61043A;"><i class="fa-solid fa-dollar-sign text-4xl"></i></h2>
                </div>
                <p class="uppercase leading-none my-0 mx-auto text-white"><strong>2 YEARS</strong><br class="sm:hidden"> FOR FREE</p>
            </div>
        </div>

    </section>

    <section style="background: #111729;">
        <div class="container max-w-5xl mx-auto px-6 py-10 sm:my-16">
            <div class="flex flex-col-reverse sm:flex-row">
                <div class="sm:w-1/2 flex flex-col justify-center pb-2 text-white px-0 sm:px-2 lg:px-10">
                    <h2 class="m-0 pb-3 md:pb-6"><strong>Books? Tools? Swag? <br> Your choice!</strong></h2>
                    <p class="">With your 5-for-3 membership, you'll receive a $150 Digital Gift Card to select whatever products you like! Choose between the best lessons, tools, books, merch and more!</p>                </div>
                <div class="sm:w-1/2 px-4 sm:px-0 mb-4 sm:mb-0">
                    <img src="https://d21q7xesnoiieh.cloudfront.net/fit-in/1200x0/filters:quality(95)/marketing/pianote/promos/summer-sale/collage.webp" alt="Pianote Products" class="w-full h-auto">
                </div>
            </div>
        </div>
    </section>

    <div x-data="{lazyLoad: false}">
    @php
        $gridItems = $pianote['gridItems'];
    @endphp

    @include('musora.sales.components.reason-cards-section', [
        'header' => 'Your piano goals<br class="inline sm:hidden"> start here.',
        'desc' => 'Always know <em>exactly</em> what to practice with an organized 10-level <br class="hidden sm:inline">curriculum and direct access to real teachers. ',
    ])
    </div>

    @include('pianote.products.partials._summer-promo', [
        'backgroundImageUrl' => 'https://d21q7xesnoiieh.cloudfront.net/fit-in/1200x0/filters:quality(95)/marketing/pianote/promos/summer-sale/bg.webp',
        'logoUrl' => 'https://d21q7xesnoiieh.cloudfront.net/fit-in/800x0/filters:quality(95)/marketing/pianote/promos/summer-sale/pianote-5-for-3-logo-horizontal.webp',
        'offerTitle' => 'Get 5 years of Pianote for the price of 3.',
        'spotsAvailable' => $products['pianote_access_5-years']->getPublicStockCount(),
        'headerImageUrl' => 'https://d21q7xesnoiieh.cloudfront.net/fit-in/1200x0/filters:quality(95)/marketing/pianote/promos/summer-sale/pianote-5-for-3-bundle.webp',
        'originalPrice' => $originalPrice,
        'discountedPrice' => $discountedPrice,
        'discountPercentage' => round((($originalPrice - $discountedPrice) / $originalPrice) * 100),
        'ctaLink' => $promoLink,
    ])

@endsection

@section('layout-footer')
    @include('pianote.sales.partials._footer')
@endsection

@section('layout-scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.min.js"></script>
    <script type="text/javascript" src="{{ asset('/marketing/parcel/drumeo/navigation-sales.js') }}"></script>
    <script type="text/javascript" src="{{ asset('/marketing/parcel/drumeo/shop-product.js') }}"></script>
@endsection


