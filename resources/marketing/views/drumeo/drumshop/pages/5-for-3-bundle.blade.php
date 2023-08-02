@php
    require_once(resource_path('marketing/views/drumeo/drumshop/pages/5-for-3-bundle-data.php'))
@endphp

@extends('_partials.layout.global-template')

@section('meta')
    <title>Drumeo 5 for 3 bundle</title>
    <meta property="og:title" content="Drumeo 5 for 3 bundle">
    <meta property="description" content="Get 5 years of Drumeo for the price of 3.">
    <meta property="og:description" content="Get 5 years of Drumeo for the price of 3.">
    <meta property="og:url" content="{{ get_legacy_brand_base_url($theme)}}/{{ Request::path() }}"/>
    <meta property="og:image" content="https://dpwjbsxqtam5n.cloudfront.net/drum-shop/5-for-3-bundle/drumeo-bundle3.png">

@endsection

@section('layout-styles')
    <link href="{{ asset('marketing/css/tailwind-helpers.css') }}" rel="stylesheet">
    <link rel="preload" href="{{ mix('marketing/css/app.css') }}" as="style" onload="this.onload=null;this.rel='stylesheet'">
    <noscript><link rel="stylesheet" href="{{ mix('marketing/css/app.css') }}"></noscript>
    <link href="{{ asset('/marketing/parcel/drumeo/navigation-sales.css') }}" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.min.css"/>
    <link href="{{ asset('/marketing/parcel/drumeo/drum-shop-product.css') }}" rel="stylesheet">
    <style>
        .text-promo {
            color: #FFD600!important;
        }
        .border-promo {
            border-color: #FFD600!important;
        }
    </style>
@endsection

@section('layout-header')
    @include("drumeo.sales.partials._nav", [
        "cartVersion" => true,
        'shopToMusora' => false,
    ])
@endsection

@section('layout-body')
    <header class="py-20 text-center text-white px-4 md:px-0" style="background: linear-gradient(180deg, #04BBDB 0%, #0F3C81 100%);">
        <img class="sm:h-8 md:h-12 lg:h-14 mb-2" src="https://www.musora.com/musora-cdn/image/width=1200,quality=95/https://dpwjbsxqtam5n.cloudfront.net/drum-shop/5-for-3-bundle/drumeo-5-for-3-logo.png" alt="5-for-3-logo" fetchpriority="high" />
        <h2 class="leading-tight mb-10"><strong>Get 5 years of Drumeo for the price of 3.</strong></h2>
        <img class="md:h-96 lg:h-[460px]" src="https://www.musora.com/musora-cdn/image/width=1800,quality=95/https://dpwjbsxqtam5n.cloudfront.net/promos/july/drumeo-bundle3.png" alt="bundle image" fetchpriority="high" />
        <br>
        <h4 class="text-promo"><strong>ONLY</strong> <s class="opacity-60">$2270</s> <strong>$720</strong> (Save 68%)</h4>
        <br>
{{--        <a class="join bg-[#24CE7C] smaller w-full max-w-sm md:w-96 mb-2" href="/ecommerce/add-to-cart?locked=true&product-array=drumeo_access_5-years:1,drumeo-eardrums:1,Drumeo-VaterSticks:6,SD-DIGI:1,rock-drumming-masterclass-pack:1,drum-technique-made-easy-pack:1,independence-made-easy-pack:1,learn-songs-faster-pack:1,electrify-your-drumming:1,MAM-DIGI:1,TLOD-DIGI:1,GHFAL-DIGI:1,HGAF-DIGI:1,ICM-DIGI:1,CC-DIGI:1,TG-DIGI:1,BTC-DIGI:1,AOADS-DIGI:1">--}}
{{--            get started &raquo;--}}
{{--        </a>--}}
        <a class="join sold-out smaller w-full max-w-sm md:w-96 mb-2">
            SOLD OUT
        </a>
        <br>
        <a aria-label="Review" class="inline-block" href="https://www.shopperapproved.com/reviews/Musora.com" target="_blank" onclick="window.open('https://www.shopperapproved.com/reviews/Musora.com', 'newwindow', 'width=750, height=550'); return false;">
            <i class="align-middle text-lg fas fa-star" style="color: #ffac00;"></i>
            <i class="align-middle text-lg -ml-3 fas fa-star" style="text-shadow: -2px -1px 1px #0f4789;color: #ffac00;"></i>
            <i class="align-middle text-lg -ml-3 fas fa-star" style="text-shadow: -2px -1px 1px #0f4789;color: #ffac00;"></i>
            <i class="align-middle text-lg -ml-3 fas fa-star" style="text-shadow: -2px -1px 1px #0f4789;color: #ffac00;"></i>
            <i class="align-middle text-lg -ml-3 fas fa-star" style="text-shadow: -2px -1px 1px #0f4789;color: #ffac00;"></i>
        </a>
        <p class="inline-block leading-tight text-sm align-middle pl-2 m-0"><em>Trusted by {{ number_format(Prices::$students) }} active students.</em></p>
    </header>

    <section class="py-20">
        <div class="max-w-4xl px-1 sm:px-4 container mx-auto z-10 relative text-center">
            <h2><strong>The 5-Year Advantage</strong></h2>
            <p class="mt-2 mb-12"><em>You’ll have 5 years of unlimited drum lessons for <br class="inline lg:hidden">the price of 3 years of access to Drumeo ($720 total).</em></p>

            <style>
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
            <div class="relative w-full rounded-full mx-auto h-10 beg-adv-text">
                <p class="absolute top-0 leading-none text-sm uppercase whitespace-nowrap text-left"><strong>TODAY</strong></p>
                <p class="absolute top-0 leading-none text-sm uppercase whitespace-nowrap"><strong>YEAR 3</strong></p>
                <p class="absolute top-0 leading-none text-sm uppercase whitespace-nowrap text-right"><strong>YEAR 5</strong></p>
            </div>
            <div class="relative w-full rounded-full h-16 mx-auto flex space-between items-center beg-adv-bar" style="background-color: #0F3F82;">
                <div class="h-full flex items-center flex-wrap relative rounded-l-full" style="background:linear-gradient(to right, #0F3C81, #04BBDB);">
                    <h4 class="uppercase leading-none w-full"><img class="h-7 sm:h-8" src="https://www.musora.com/musora-cdn/image/quality=95,width=250,metadata=none/https://dpwjbsxqtam5n.cloudfront.net/logos/logo-white.png" alt="Drumeo logo"></h4>
                    <h1 class="absolute right-0 text-white rounded-full px-6 py-4 -mr-7 mt-1" style="background-color:#0F3C81;">$</h1>
                </div>
                <p class="uppercase leading-none my-0 mx-auto text-white"><strong>2 YEARS</strong><br class="sm:hidden"> FOR FREE</p>
            </div>
        </div>
        <div class="max-w-4xl mx-auto pack-details px-4 lg:px-0">
            <hr class="my-8 border-[#C4C4C4] border" />
            <p class="mb-4">
                <strong>Say hello to your free bonuses:</strong><br>
                <em class="opacity-50">All digital bonuses are added to your account instantly with your membership to {{ ucfirst($theme) }}, and they’re yours forever.</em>
            </p>

            @include('_partials.components.shop.bonuses')
        </div>
    </section>

    <div id="order-section"></div>
    <section class="py-20" style="background: linear-gradient(180deg, #04BBDB 0%, #0F3C81 100%);">
        <div class="max-w-5xl mx-auto text-center text-white px-4 md:px-0">
            <img class="sm:h-8 md:h-12 lg:h-14 mb-2" src="https://www.musora.com/musora-cdn/image/width=1200,quality=95/https://dpwjbsxqtam5n.cloudfront.net/drum-shop/5-for-3-bundle/drumeo-5-for-3-logo.png" alt="5-for-3-logo" />
            <h2 class="leading-tight mb-7"><strong>Get 5 years of Drumeo for the price of 3.</strong></h2>

            @include('pianote.shop.pages.5-for-3-bundle-order-section', [
                'topImage' => 'https://dpwjbsxqtam5n.cloudfront.net/drum-shop/5-for-3-bundle/drumeo-5-year-double-card.jpg',
                'availableSpots' => $products['drumeo_access_5-years']->getPublicStockCount(),
                'saveText' => '<h4 class="text-promo"><strong>ONLY</strong> <s class="opacity-60">$2270</s> <strong>$720</strong> (Save 68%)</h4>',
                'buttonLink' => '/ecommerce/add-to-cart?locked=true&product-array=drumeo_access_5-years:1,drumeo-eardrums:1,Drumeo-VaterSticks:6,SD-DIGI:1,rock-drumming-masterclass-pack:1,drum-technique-made-easy-pack:1,independence-made-easy-pack:1,learn-songs-faster-pack:1,electrify-your-drumming:1,MAM-DIGI:1,TLOD-DIGI:1,GHFAL-DIGI:1,HGAF-DIGI:1,ICM-DIGI:1,CC-DIGI:1,TG-DIGI:1,BTC-DIGI:1,AOADS-DIGI:1',
            ])

        </div>
    </section>
@endsection

@section('layout-footer')
    @include("drumeo.sales.partials._footer")
@endsection

@section('layout-scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.min.js"></script>
    <script type="text/javascript" src="{{ asset('/marketing/parcel/drumeo/navigation-sales.js') }}"></script>
    <script type="text/javascript" src="{{ asset('/marketing/js/drumeo/ba-bbq.js') }}"></script>
    <script type="text/javascript" src="{{ asset('/marketing/parcel/drumeo/shop-product.js') }}"></script>

    {{-- Platform --}}
    <script src="{{ mix('/platform/js/manifest.js') }}"></script>
    <script src="{{ mix('/platform/js/vendor.js') }}"></script>
    <script src="{{ mix('/platform/js/app.js') }}"></script>
@endsection


