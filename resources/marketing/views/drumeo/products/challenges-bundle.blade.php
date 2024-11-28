@php
    require_once(resource_path('marketing/views/drumeo/_partials/bonus-data-2024.php'));
    require_once(resource_path('marketing/views/drumeo/_partials/homepage-data.php'));
    require_once(resource_path('marketing/views/drumeo/_partials/bonus-data.php'));
@endphp

@extends('drumeo._partials.global-layout')

@section('global-head')
    <title>Challenges Bundle | Drumeo </title>
    <meta property="og:title" content="Challenges Bundle | Drumeo">

    <meta name="description" content="3 Popular Course For The Price Of 1.">
    <meta property="og:description" content="3 Popular Course For The Price Of 1.">
    {{-- TODO: Add image--}}
    <meta property="og:image" content="https://d21q7xesnoiieh.cloudfront.net/fit-in/1300x0/filters:quality(95)/marketing/drumeo/promos/black-friday/bundles/cyber-monday/challenges-share-image-new.jpg" style="display: none;">
    <meta property="og:url" content="https://www.drumeo.com/{{ Request::path() }}">

    @include('_partials.layout._fonts')

    <link rel="stylesheet" href="{{ mix('marketing/css/app.css') }}">
    <link href="{{ asset('/marketing/css/tailwind-helpers.css') }}" rel="stylesheet">
    <link href="{{ asset('/marketing/parcel/drumeo/navigation-sales.css') }}" rel="stylesheet">
    <link href="{{ asset('/marketing/parcel/drumeo/sales-2020.css') }}" rel="stylesheet">
@stop

@section('body-data')
   x-data="{
        @foreach($bonusVideos as $bonusVideo)
            @if(!empty($bonusVideo['vimeoId']))
                modal{{ $bonusVideo['vimeoId'] }}: false,
            @endif
        @endforeach
    }"
@endsection

@section('global-body')
    @include("drumeo.sales.partials._nav", [
        "cartVersion" => true
    ])
     @include('_partials.components.shop.promo-banner-2', [
        "name" => "Challenges Bundle",
        "fullPrice" => 381,
        "price" => 127,
        "noBreadcrumb" => true
    ])

    @php
        if(!empty($products['alesis-ekit']->getPublicStockCount())) {
            $stock = $products['alesis-ekit']->getPublicStockCount();
        }
        else {
            $stock = 0;
        }
    @endphp

    <header class="text-white relative overflow-hidden z-10 object-cover object-center h-[740px] md:h-[800px] lg:h-[880px]" style="background: url('https://d21q7xesnoiieh.cloudfront.net/fit-in/1200x0/filters:quality(95)/marketing/drumeo/promos/november/2024/challenges-bundle/header-bg.webp') no-repeat center center; background-size: cover;">
        <div class="transform -translate-y-1/2 top-1/2 left-0 w-full absolute z-20 px-4 lg:px-6 text-center">
            <div class="container mx-auto max-w-5xl">
                <img alt="Bundle" class="h-16 sm:h-18" src="https://d21q7xesnoiieh.cloudfront.net/fit-in/1200x0/filters:quality(95)/marketing/drumeo/promos/november/2024/challenges-bundle/challenges-bundle-logo.svg"><br>
                <h1 class="leading-tight my-3 lg:my-4"><strong>3 Popular Courses For <br class="block sm:hidden">The Price Of 1</strong></h1>
                    <h4 class="italic items-center">Get the best online drum lessons with no recurring payments.</h4>
                <img class="hidden md:inline object-cover max-w-2xl mx-auto" src="https://d21q7xesnoiieh.cloudfront.net/fit-in/1600x0/filters:quality(95)/marketing/drumeo/promos/november/2024/challenges-bundle/header-collage.webp" alt="Bundle Collage">
                <img class="md:hidden object-cover w-full sm:max-w-2xl p-4" src="https://d21q7xesnoiieh.cloudfront.net/fit-in/800x0/filters:quality(95)/marketing/drumeo/promos/november/2024/challenges-bundle/header-collage.webp" alt="Bundle Collage Mobile">
               <div class="px-3 mx-auto w-full max-w-2xl">
                    <h2 class="leading-none my-1 md:my-4"><s class="opacity-50"> $381</s><strong> $127</strong> <span class="text-[#CF03DA] text-xl md:text-3xl">(Save 66%)</span></h2>
                    @if($stock > 0)
                        <a class="join drumeo mt-4 w-full anchor-slide uppercase" href="#customize-anchor">get the deal &raquo;</a>
                    @else
                        <a class="join sold-out mt-4 w-full anchor-slide" href="#customize-anchor">SOLD OUT</a>
                    @endif
                        <p class="leading-tight text-sm text-musora mt-3"><em>Only 300 available.</em></p>
                    </div>
                </div>
            </div>
        </div>
    </header>

    @php
        $videoTargetSkus = ['30-day-independence-challenge', '30-day-double-bass-challenge', '30-day-chops-challenge'];
    @endphp

    <section class="pt-8 pb-16 sm:py-16 lg:py-20 px-4 sm:px-6 bg-[#F4F8FB]">
        <div class="container mx-auto max-w-5xl">
            <h2 class="leading-tight text-center mb-3"><strong>Improve your independence. <br> Learn Double Bass. <br>Play tasty chops.</strong></h2>
            <p class="leading-normal text-center mb-3 lg:pb-6 md:px-8">Just press play. Your teacher plays every note with you – all you have to do is follow along.</p>

            @include('drumeo._partials.bf-bonus-section', [
            'videoTargetSkus' => $videoTargetSkus,
            'case' => 'challenges',
            ])

            <div class="bg-[#CFEBFF] px-4 py-4 md:py-8 md:px-16 rounded-lg my-10 md:my-16">
                <div class="flex items-start gap-3 max-w-4xl md:pr-8">
                    <div class="flex-shrink-0">
                        <i class="fa-solid fa-circle-exclamation text-xl"></i>
                    </div>
                    <div class="text-sm">
                        <span class="font-semibold">Disclaimer:</span>
                        This bundle is ONLY available as a full bundle. None of the discounted items can be purchased at that
                        discounted price, on their own, and any refunds must be processed with the full bundle refunded and returned at the same
                        time. (Ex. You cannot purchase this bundle and request a refund on just the membership.)
                    </div>
                </div>
            </div>
        </div>
    </section>

    <div x-data="{lazyLoad: false}">
        @include('musora.sales.components.guarantee-section', [
                'badge' => 'marketing/drumeo/membership/homepage/2024/guarantee.webp',
                'header' => '<strong>Happy student guarantee.</strong><br>Test-drive your lessons for 90 days. Zero risk.',
                'desc' => 'Online lessons can be intimidating. Maybe you’re wondering if they work, or if you’ll use them enough – or if you’ll even enjoy the experience. So we’re removing the risk with our 90-day guarantee. More than anything, we want to make sure you have a POSITIVE experience developing new skills and gaining confidence on the drums.',
            ])

            @php
                $targetSkus = ['30-day-independence', '30-day-double-bass', '30-day-chops'];
            @endphp
             <div id="customize-anchor"></div>
            @include('drumeo._partials.bf-order-section-bonuses-modal', [
            'bgColor' => 'background:linear-gradient(to bottom, #131633, #000);',
            'promoLogo' => 'https://d21q7xesnoiieh.cloudfront.net/fit-in/1200x0/filters:quality(95)/marketing/drumeo/promos/november/2024/challenges-bundle/challenges-bundle-logo.svg',
            'logoHeight' => 'h-16 sm:h-18',
            'bonusWidth' => 'w-1/2 md:w-1/3 lg:w-1/5',
            'promoHeader' => '<h2 class="leading-tight mb-4 sm:mb-2"><strong>3 Popular Courses For The Price Of 1</strong></h2>
                                <h5 class="italic items-center">Get the best online drum lessons with no recurring payments.</h5>',
            'buttonLink' => '/ecommerce/add-to-cart?products[the-challenges-bundle]=1&promo-code=challenges-bundle&locked=true',
            'bundle'=> "challenge",
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

    @include("drumeo.sales.partials._footer")
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script type="text/javascript" src="{{ asset('/marketing/parcel/drumeo/navigation-sales.js') }}" async defer></script>

@stop
