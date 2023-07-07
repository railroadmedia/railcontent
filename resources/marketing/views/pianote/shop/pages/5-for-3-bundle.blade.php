@php
    require_once(resource_path('marketing/views/pianote/shop/pages/5-for-3-bundle-data.php'))
@endphp

@extends('_partials.layout.global-template')

@section('meta')
    <title>Pianote 5 for 3 bundle</title>
    <meta property="og:title" content="Pianote 5 for 3 bundle">
    <meta property="description" content="Get 5 years of Pianote for the price of 3.">
    <meta property="og:description" content="Get 5 years of Pianote for the price of 3.">
    <meta property="og:url" content="{{ get_legacy_brand_base_url($theme)}}/{{ Request::path() }}"/>
    <meta property="og:image" content="https://d2vyvo0tyx8ig5.cloudfront.net/shop/products/5-for-3-bundle/pianote-bundle.png">

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
    @include('pianote.sales.partials._nav',[
         "cartVersion" => true,
         'shopToMusora' => false,
    ])
@endsection

@section('layout-body')
    <header class="py-20 text-center text-white px-4 md:px-0" style="background: linear-gradient(180deg, #DC3848 0%, #5E0239 100%);">
        <img class="sm:h-8 md:h-12 lg:h-14 mb-2" src="https://www.musora.com/musora-cdn/image/width=800,quality=85/https://d2vyvo0tyx8ig5.cloudfront.net/shop/products/5-for-3-bundle/pianote-5-for-3-logo.png" alt="5-for-3-logo" fetchpriority="high" />
        <h2 class="leading-tight mb-2"><strong>Get 5 years of Pianote for the price of 3.</strong></h2>
        <p class="text-promo mb-10">ONLY
            @if(!empty($products['drumeo-eardrums']->getStockAvailability()))
                {{ $products['drumeo-eardrums']->getStockAvailability() }}
            @endif
            SPOTS AVAILABLE</p>
        <img class="md:h-96 lg:h-[460px]" src="https://www.musora.com/musora-cdn/image/width=1200,quality=85/https://d2vyvo0tyx8ig5.cloudfront.net/shop/products/5-for-3-bundle/pianote-bundle.png" alt="bundle image" fetchpriority="high" />
        <br>
        <h4><strong><s class="opacity-60">$1716</s> $720</strong> (SAVE 58%)</h4>
        <br>
        <a class="join bg-[#24CE7C] smaller w-full max-w-sm md:w-96" href="/choose-plan">
            get started &raquo;
        </a>
    </header>

    <section class="py-20">
        <div class="max-w-4xl mx-auto pack-details px-4 lg:px-0">
            <hr class="my-8 border-[#C4C4C4] border" />
            <p class="mb-4">
                <strong>Say hello to your free bonuses:</strong><br>
                <em class="opacity-50">All digital bonuses are added to your account instantly with your membership to {{ ucfirst($theme) }}, and they’re yours for as long as you remain a member.</em>
            </p>

            @include('_partials.components.shop.bonuses')
        </div>
    </section>

    <section class="py-20" style="background: linear-gradient(180deg, #DC3848 0%, #5E0239 100%);">
        <div class="max-w-5xl mx-auto text-center text-white px-4 md:px-0">
            <img class="sm:h-8 md:h-12 lg:h-14 mb-2" src="https://www.musora.com/musora-cdn/image/width=800,quality=85/https://d2vyvo0tyx8ig5.cloudfront.net/shop/products/5-for-3-bundle/pianote-5-for-3-logo.png" alt="5-for-3-logo" />
            <h2 class="leading-tight mb-2"><strong>Get 5 years of Pianote for the price of 3.</strong></h2>

            @include('pianote.shop.pages.5-for-3-bundle-order-section', [
                'topImage' => 'https://d2vyvo0tyx8ig5.cloudfront.net/shop/products/5-for-3-bundle/pianote-5-year-double-card.jpg',
                'availableSpots' => $products['drumeo-eardrums']->getStockAvailability(),
                'saveText' => '<h4><strong><s class="opacity-60">$1716</s> $720</strong> (SAVE 58%)</h4>',
                'buttonLink' => '/ecommerce/add-to-cart?locked=true&product-array=pianote_access_5-years:1,classical-book:1,piano-chords-and-scales-guide:1,poster-chords:1,poster-scales:1,pianote-practice-planner:1,new-piano-players-start-here:1,easy-chords:1,piano-technique-made-easy:1,the-power-of-chords:1,worship-piano:1,piano-riffs-and-fills:1,destupefy-your-left-hand:1,faster-fingers:1,jesus-molina-improvisation-and-musical-freedom-pack:1,play-beautiful-piano:1',
            ])

        </div>
    </section>
@endsection

@section('layout-footer')
    @include('pianote.sales.partials._footer')
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


