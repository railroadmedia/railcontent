@php
    require_once(resource_path('marketing/views/drumeo/_partials/bonus-data-2024.php'));
    require_once(resource_path('marketing/views/drumeo/_partials/homepage-data.php'));
    require_once(resource_path('marketing/views/drumeo/_partials/bonus-data.php'));
@endphp

@extends('drumeo._partials.global-layout')

@section('global-head')
    <title>Drumeo Deal | Drumeo </title>
    <meta property="og:title" content="Drumeo Deal | Drumeo">

    <meta name="description" content="Save $100 + Get $635 In Free Courses For Life.">
    <meta property="og:description" content="Save $100 + Get $635 In Free Courses For Life.">

    <meta property="og:image" content="https://d21q7xesnoiieh.cloudfront.net/fit-in/1300x0/filters:quality(95)/marketing/drumeo/promos/november/2024/drumeo-deal-share-image.jpg" style="display: none;">
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
    {{-- @include('_partials.components.shop.promo-banner-2', [
        "name" => "Drumeo E-Kit",
        "specialText" => "Get <strong>$506.95</strong> in free bonuses with the E-Kit.",
        "fullPrice" => floatval($productPrices['alesis-ekit']->price),
        "price" => floatval($productPrices['alesis-ekit']->discounted_price),
        "noBreadcrumb" => true
    ]) --}}

    @php
        if(!empty($products['alesis-ekit']->getPublicStockCount())) {
            $stock = $products['alesis-ekit']->getPublicStockCount();
        }
        else {
            $stock = 0;
        }
    @endphp

    <header class="text-white relative overflow-hidden z-10 object-cover object-center h-[700px] lg:h-[880px]" style="background: url('https://d21q7xesnoiieh.cloudfront.net/fit-in/1200x0/filters:quality(95)/marketing/drumeo/promos/november/2024/drumeo-deal/drumeo-deal-bg.webp') no-repeat center center; background-size: cover;">
        <div class="transform -translate-y-1/2 top-1/2 left-0 w-full absolute z-20 px-4 lg:px-6 text-center">
            <div class="container mx-auto max-w-5xl">
                <img alt="Bundle" class="h-16 sm:h-18" src="https://d21q7xesnoiieh.cloudfront.net/fit-in/1200x0/filters:quality(95)/marketing/drumeo/promos/november/2024/drumeo-deal/drumeo-deal-logo.svg"><br>
                <h2 class="leading-tight my-3"><strong>Save $100 + Get $635 In Free Courses For Life.</strong></h2>
                <div class="flex flex-wrap justify-center gap-2 md:gap-4 mb-6">
                    <span class="flex items-center">
                        <i class="fa-solid fa-check text-drumeo mr-2"></i>
                       PLAY-ALONG LESSONS
                    </span>
                    <span class="flex items-center">
                        <i class="fa-solid fa-check text-drumeo mr-2"></i>
                       POPULAR SONGS
                    </span>
                    <span class="flex items-center">
                        <i class="fa-solid fa-check text-drumeo mr-2"></i>
                       WORLD-CLASS TEACHERS
                    </span>
                </div>
                <img class="hidden md:inline object-cover max-w-3xl lg:max-w-4xl mx-auto" src="https://d21q7xesnoiieh.cloudfront.net/fit-in/1600x0/filters:quality(95)/marketing/drumeo/promos/november/2024/drumeo-deal/header-collage.webp" alt="Bundle Collage">
                <img class="md:hidden object-cover w-full sm:max-w-2xl p-4" src="https://d21q7xesnoiieh.cloudfront.net/fit-in/800x0/filters:quality(95)/marketing/drumeo/promos/november/2024/drumeo-deal/header-collage.webp" alt="Bundle Collage Mobile">
               <div class="px-3 mx-auto w-full max-w-2xl">
                    <h2 class="leading-none my-1 md:my-4"><s class="opacity-50"> $240</s><strong> $140</strong> <span class="text-[#5EA7EB] text-3xl">(Save 41%)</span></h2>
                    @if($stock > 0)
                        <a class="join drumeo mt-4 w-full anchor-slide uppercase" href="#customize-anchor">get the deal</a>
                    @else
                        <a class="join sold-out mt-4 w-full anchor-slide" href="#customize-anchor">SOLD OUT</a>
                    @endif
                    </div>
                </div>
            </div>
        </div>
    </header>

    @php
        $videoTargetSkus = ['DLM-1-year-drumeo', '30-day-drummer-4', '30-day-double-bass', '30-day-jazz', '30-day-independence', '30-day-chops'];
    @endphp

    <section class="pt-8 pb-16 sm:py-16 lg:pt-20 lg:pb-28 px-4 sm:px-6 bg-[#F4F8FB]">
        <div class="container mx-auto max-w-5xl">
             <h2 class="leading-tight text-center mb-3 lg:pb-4">
                <strong>Here's what you'll get with <br class="hidden sm:block">this bundle.</strong>
            </h2>
            <p class="leading-normal text-center mb-3 lg:pb-6">You’ll save $100 on your first year of Drumeo PLUS you’ll get lifetime access to our most popular courses. Even if you don’t renew your membership. These lessons are yours forever.<br><br>
            Play your first beats, improve your chops, get started with jazz, and more. All with world-class instructors.</p>
            @include('drumeo._partials.bf-bonus-section', [
            'videoTargetSkus' => $videoTargetSkus,
            ])
        </div>
    </section>

    <div x-data="{lazyLoad: false}">
        @include('musora.sales.components.guarantee-section', [
                'badge' => 'marketing/drumeo/membership/homepage/2024/guarantee.webp',
                'header' => '<strong>Happy student guarantee.</strong><br>Test-drive your lessons for 90 days. Zero risk.',
                'desc' => 'Online lessons can be intimidating. Maybe you’re wondering if they work, or if you’ll use them enough – or if you’ll even enjoy the experience. So we’re removing the risk with our 90-day guarantee. More than anything, we want to make sure you have a POSITIVE experience developing new skills and gaining confidence on the drums.',
            ])

        @include('drumeo._partials.countdown-bundle-2024')

        @php
            $targetSkus = ['30-day-drummer-4', '30-day-independence', '30-day-double-bass', '30-day-jazz', '30-day-independence', '30-day-chops'];
        @endphp
            <div id="customize-anchor"></div>
            @include('drumeo._partials.bf-order-section-bonuses', [
            'bgColor' => 'background:linear-gradient(to bottom, #131633, #000);',
            'promoLogo' => 'https://d21q7xesnoiieh.cloudfront.net/fit-in/1200x0/filters:quality(95)/marketing/drumeo/promos/november/2024/drumeo-deal/drumeo-deal-logo.svg',
            'logoHeight' => 'h-16 sm:h-18 md:h-24',
            'bonusWidth' => 'w-1/2 md:w-1/3 lg:w-1/5',
            'promoHeader' => '<h2 class="leading-tight mb-4 sm:mb-2"><strong>Save $100 on your first year + $635 in lifetime bonuses!</strong></h2>',            
            'buttonLink' => '/ecommerce/add-to-cart?products[DLM-1-year]=1&products[the-drumeo-deal]=1&promo-code=drumeo-deal-2024&locked=true', 
            'bundle'=> "deal",
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
