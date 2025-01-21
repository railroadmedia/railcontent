@php
    require_once(resource_path('marketing/views/pianote/_partials/bonus-data-2024.php'));
    require_once(resource_path('marketing/views/pianote/_partials/homepage-data.php'));
    require_once(resource_path('marketing/views/pianote/_partials/bonus-data.php'));
@endphp

@extends('pianote._partials.global-layout')

@section('global-head')
    @parent
    <title>Challenges Bundle | Pianote</title>
    <meta property="og:title" content="Challenges Bundle | Pianote">
    <meta name="description" content="Get 3 Popular Courses For The Price Of 1.">
    <meta property="og:description" content="Get 3 Popular Courses For The Price Of 1">
    <meta property="og:image"
        content="https://d21q7xesnoiieh.cloudfront.net/fit-in/1200x0/marketing/pianote/promos/black-friday/challenges-bundle/challenges-share-image.jpg"
        style="display: none;">
    <meta property="og:url" content="https://www.pianote.com/{{ Request::path() }}">
    <script defer src="https://cdn.jsdelivr.net/npm/@alpinejs/focus@3.x.x/dist/cdn.min.js"></script>


    @include('_partials.layout._fonts')
    <link rel="stylesheet" href="{{ mix('marketing/css/app.css') }}">
    <link href="{{ asset('/marketing/css/tailwind-helpers.css') }}" rel="stylesheet">
    <link href="{{ asset('/marketing/parcel/drumeo/nav-footer-pianote.css') }}" rel="stylesheet">
    <link href="{{ asset('/marketing/parcel/drumeo/30dd.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@splidejs/splide@4.1.4/dist/css/splide.min.css">
    <style>
    #guarantee-section{
        background-color: #F4F8FB !important;
    }
    #guarantee-block{
        background: linear-gradient(to bottom right, transparent calc(50% - 1px), transparent, #F4F8FB calc(50% + 1px)) !important;
    }
    </style>
@stop()

@section('body-data')
   x-data="{
        @foreach($bonusVideos as $bonusVideo)
            @if(!empty($bonusVideo['vimeoId']))
                modal{{ $bonusVideo['vimeoId'] }}: false,
            @endif
        @endforeach
    }"
@endsection
@php
    $stock = !empty($products['alesis-ekit']->getPublicStockCount())
        ? $products['alesis-ekit']->getPublicStockCount()
        : 0;
@endphp

@section('global-body')
    @include('pianote.sales.partials._nav', [
        'cartVersion' => true,
    ])
     @include('_partials.components.shop.promo-banner-2', [
        'name' => 'Challenges Bundle',
        'fullPrice' => 381,
        'price' => 127,
        'noBreadcrumb' => true,
    ])
     <header class="text-white relative overflow-hidden z-10 object-cover object-center h-[700px] lg:h-[840px]" style="background: url('https://d21q7xesnoiieh.cloudfront.net/fit-in/1200x0/filters:quality(95)/marketing/pianote/promos/black-friday/challenges-bundle/header-bg.webp') no-repeat center center; background-size: cover;">
        <div class="transform -translate-y-1/2 top-1/2 left-0 w-full absolute z-20 px-4 lg:px-6 text-center">
            <div class="container mx-auto max-w-5xl lg:pt-10">
                <img alt="Bundle Logo" class="h-12 sm:h-14" src="https://d21q7xesnoiieh.cloudfront.net/fit-in/1200x0/filters:quality(95)/marketing/pianote/promos/black-friday/challenges-bundle/challenges-bundle-logo.svg"><br>
                <h2 class="leading-tight mt-3 lg:my-6"><strong>Get 3 Popular Courses For The Price Of 1</strong></h2>
                <h4 class="italic capitalize pb-2 md:pb-6">no recurring payments - just results.</h4>
                <img class="hidden md:inline object-cover max-w-xl mx-auto" src="https://d21q7xesnoiieh.cloudfront.net/fit-in/1600x0/filters:quality(95)/marketing/pianote/promos/black-friday/challenges-bundle/header-collage.webp" alt="Bundle Collage">
                <img class="md:hidden object-cover w-full sm:max-w-xl p-4" src="https://d21q7xesnoiieh.cloudfront.net/fit-in/800x0/filters:quality(95)/marketing/pianote/promos/black-friday/challenges-bundle/header-collage.webp" alt="Bundle Collage Mobile">
               <div class="px-3 mx-auto w-full max-w-2xl">
                    <h2 class="leading-none my-1 md:my-4"><s class="opacity-50"> $381</s><strong> $127</strong> <span class="text-[#FA62FF] text-xl md:text-3xl">(Save 66%)</span></h2>
{{--                    @if($stock > 0)--}}
{{--                        <a class="join pianote mt-4 w-full uppercase" href="/ecommerce/add-to-cart?products[the-challenges-bundle-pianote]=1&promo-code=challenges-bundle-pianote&locked=true">get the deal</a>--}}
{{--                    @else--}}
                        <a class="join sold-out mt-4 w-full">SOLD OUT</a>
{{--                    @endif--}}
                    </div>
                </div>
            </div>
        </div>
    </header>


    @php
        $videoTargetSkus = ['30-day-blues-piano-challendge', '30-days-to-better-technique-challendge', 'easy-chords-challendge'];
    @endphp

    <section class="pt-8 pb-16 sm:py-16 lg:pt-20 lg:pb-28 px-4 sm:px-6 bg-white">
        <div class="container mx-auto max-w-6xl">
         <h2 class="leading-tight text-center mb-3"><strong>Improve your technique.<br>Master your chords.<br>Play the Blues.</strong></h2>
            <p class="leading-normal text-center mb-3 lg:mb-10 md:px-8">Just press play. Your teacher plays every note with you – all you have to do is follow along.</p>

            @include('drumeo._partials.bf-bonus-section', [
            'videoTargetSkus' => $videoTargetSkus,
            'case' => 'challenges',
            ])
        </div>
    </section>

    <div x-data="{lazyLoad: false}" class="pt-10">
         @include('musora.sales.components.guarantee-section', [
        'badge' => 'marketing/pianote/membership/homepage/webp-format/piano-guarantee.webp',
        'header' => '<strong>Happy student guarantee.</strong><br>Test-drive your lessons for 90 days. Zero risk.',
        'desc' => 'Online lessons can be intimidating. Maybe you’re wondering if they work, or if you’ll use them enough – or if you’ll even enjoy the experience. So we’re removing the risk with our 90-day guarantee. More than anything, we want to make sure you have a POSITIVE experience developing new skills and gaining confidence on the piano.',
    ])
        @php
            $targetSkus = ['30-day-blues-piano', '30-days-to-better-technique', 'easy-chords'];
        @endphp
            <div id="customize-anchor"></div>
            @include('drumeo._partials.bf-order-section-bonuses-modal', [
            'bgColor' => 'background:linear-gradient(to bottom, #131633, #000);',
            'promoLogo' => 'https://d21q7xesnoiieh.cloudfront.net/fit-in/1200x0/filters:quality(95)/marketing/pianote/promos/black-friday/challenges-bundle/challenges-bundle-logo.svg',
            'logoHeight' => 'h-16 sm:h-20',
            'bonusWidth' => 'w-1/2 md:w-1/3 lg:w-1/5',
            'promoHeader' => '<h2 class="leading-tight mb-2"><strong>Get 3 Popular Courses For The Price Of 1</h2></strong><h5 class="italic mb-2 lg:mb-6">no recurring payments - ever.</h5>',
            'buttonLink' => '/ecommerce/add-to-cart?products[the-challenges-bundle-pianote]=1&promo-code=challenges-bundle-pianote&locked=true',
            'bundle'=> "challenges-pianote",
            'soldOut'=> true,
            ])
    </div>

     @php
        $videoBonuses = [];
        foreach ($bonusVideos as $bonusVideo) {
            if (!empty($bonusVideo['vimeoId']) && in_array($bonusVideo['sku'], $videoTargetSkus)) {
                $videoBonuses[] = ['name' => 'modal' . $bonusVideo['vimeoId'], 'video' => $bonusVideo['vimeoId']];
            }
        }
    @endphp

    @foreach ($videoBonuses as $modal)
        @include('_partials.components.video-modal', [
            'name' => $modal['name'],
            'video' => $modal['video'],
            'vimeo' => true,
        ])
    @endforeach

    @include('pianote.sales.partials._footer')

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script type="text/javascript" src="{{ asset('/marketing/js/modal.js') }}"></script>
    <script type="text/javascript" src="{{ asset('/marketing/parcel/drumeo/navigation-sales.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/@splidejs/splide@4.1.4/dist/js/splide.min.js"></script>

@stop
