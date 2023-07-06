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
    <meta property="og:image" content="https://dpwjbsxqtam5n.cloudfront.net/drum-shop/5-for-3-bundle/drumeo-bundle.png">

@endsection

@section('layout-styles')
    <link href="{{ asset('marketing/css/tailwind-helpers.css') }}" rel="stylesheet">
    <link rel="preload" href="{{ mix('marketing/css/app.css') }}" as="style" onload="this.onload=null;this.rel='stylesheet'">
    <noscript><link rel="stylesheet" href="{{ mix('marketing/css/app.css') }}"></noscript>
    <link href="{{ asset('/marketing/parcel/drumeo/navigation-sales.css') }}" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.min.css"/>
    <link href="{{ asset('/marketing/parcel/drumeo/drum-shop-product.css') }}" rel="stylesheet">
@endsection

@section('layout-header')
    @include("drumeo.sales.partials._nav", [
        "cartVersion" => true,
        'shopToMusora' => false,
    ])
@endsection

@section('layout-body')
    <header class="py-20 text-center text-white px-4 md:px-0" style="background: linear-gradient(180deg, #04BBDB 0%, #0F3C81 100%);">
        <img class="sm:h-8 md:h-12 lg:h-14 mb-2" src="https://www.musora.com/musora-cdn/image/width=800,quality=85/https://dpwjbsxqtam5n.cloudfront.net/drum-shop/5-for-3-bundle/drumeo-5-for-3-logo.png" alt="5-for-3-logo" fetchpriority="high" />
        <h2 class="leading-tight mb-2"><strong>Get 5 years of Drumeo for the price of 3.</strong></h2>
        <p class="text-promo mb-10">ONLY
            @if(!empty($products['drumeo-eardrums']->getStockAvailability()))
            {{ $products['drumeo-eardrums']->getStockAvailability() }}
            @endif
            SPOTS AVAILABLE</p>
        <img class="md:h-96 lg:h-[460px]" src="https://www.musora.com/musora-cdn/image/width=1200,quality=85/https://dpwjbsxqtam5n.cloudfront.net/drum-shop/5-for-3-bundle/drumeo-bundle.png" alt="bundle image" fetchpriority="high" />
        <br>
        <h4><strong><s class="opacity-60">$1586.61</s> $720</strong></h4>
        <br>
        <a class="join bg-[#24CE7C] smaller w-full max-w-sm md:w-96" href="#order-section">
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

    <div id="order-section"></div>
    <section class="py-20" style="background: linear-gradient(180deg, #04BBDB 0%, #0F3C81 100%);">
        <div class="max-w-5xl mx-auto text-center text-white px-4 md:px-0">
            <img class="sm:h-8 md:h-12 lg:h-14 mb-2" src="https://www.musora.com/musora-cdn/image/width=800,quality=85/https://dpwjbsxqtam5n.cloudfront.net/drum-shop/5-for-3-bundle/drumeo-5-for-3-logo.png" alt="5-for-3-logo" />
            <h2 class="leading-tight mb-2"><strong>Get 5 years of Drumeo for the price of 3.</strong></h2>

            @include('pianote.shop.pages.5-for-3-bundle-order-section', [
                'topImage' => 'https://dpwjbsxqtam5n.cloudfront.net/drum-shop/5-for-3-bundle/drumeo-5-year-double-card.jpg',
                'availableSpots' => 'TODO',
                'saveText' => '<h4><strong><s class="opacity-60">$1586.61</s> $720</strong></h4>',
                'buttonLink' => '/ecommerce/add-to-cart?products[TODO]=1&products[drumeo-eardrums]=1&products[Drumeo-VaterSticks]=1&products[DSYS2-DIGI]=1&products[SD-DIGI]=1&products[rock-drumming-masterclass-pack]=1&products[drum-technique-made-easy-pack]=1&products[independence-made-easy-pack]=1&products[learn-songs-faster-pack]=1&products[MAM-DIGI]=1&products[TLOD-DIGI]=1&products[GHFAL-DIGI]=1&products[HGAF-DIGI]=1&products[ICM-DIGI]=1&products[CC-DIGI]=1&products[TG-DIGI]=1&products[BTC-DIGI]=1&products[AOADS-DIGI]=1&locked=true',
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


