@php
    require_once(resource_path('marketing/views/drumeo/_partials/bonus-data-2024.php'));
    require_once(resource_path('marketing/views/drumeo/_partials/homepage-data.php'));
    require_once(resource_path('marketing/views/drumeo/_partials/bonus-data.php'));
@endphp

@extends('drumeo._partials.global-layout')

@section('global-head')
    <title>Gift Bundle | Drumeo</title>
    <meta property="og:title" content="Gift Bundle | Drumeo">
    <meta property="og:url" content="https://www.drumeo.com/{{ Request::path() }}">

    <meta name="description" content="Give The Gift Of Music This Holiday Season.">
    <meta property="og:description" content="Give The Gift Of Music This Holiday Season.">
    <meta property="og:image" content="https://d21q7xesnoiieh.cloudfront.net/fit-in/1300x0/filters:quality(95)/marketing/drumeo/promos/november/2024/gift-bundle-share-image.jpg" style="display: none;">

    <link rel="stylesheet" href="{{ mix('marketing/css/app.css') }}">
    <link href="{{ asset('/marketing/parcel/drumeo/navigation-sales.css') }}" rel="stylesheet">
    <link href="{{ asset('/marketing/css/tailwind-helpers.css') }}" rel="stylesheet">
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

    @php
        if(!empty($products['alesis-ekit']->getPublicStockCount())) {
            $stock = $products['alesis-ekit']->getPublicStockCount();
        }
        else {
            $stock = 0;
        }
    @endphp
{{--    @include('_partials.components.shop.promo-banner-2', [--}}
{{--        "name" => "Lifetime",--}}
{{--        "fullPrice" => 1200,--}}
{{--        "price" => 1200,--}}
{{--        "specialText" => "<strong>Only <s class='opacity-60'>500</s> <span class='text-promo'>" . $stock . "</span> left!</strong>",--}}
{{--        "noBreadcrumb" => true,--}}
{{--                "noCountdown" => true--}}
{{--    ])--}}

    <header class="text-white relative overflow-hidden z-10 object-cover object-center h-[700px] md:h-[860px]" style="background: url('https://d21q7xesnoiieh.cloudfront.net/fit-in/2000x0/filters:quality(95)/marketing/drumeo/promos/november/2024/gift-bundle/gift-bundle-bg.webp') no-repeat center center; background-size: cover;">
        <div class="transform -translate-y-1/2 top-1/2 left-0 w-full absolute z-20 px-4 lg:px-6 text-center">
            <div class="container mx-auto max-w-5xl">
                <img alt="Bundle" class="h-16 sm:h-18" src="https://d21q7xesnoiieh.cloudfront.net/fit-in/700x0/filters:quality(95)/marketing/drumeo/promos/november/2024/gift-bundle/gift-bundle-logo.svg"><br>
                <h2 class="leading-tight my-3 lg:my-6"><strong>Give The Gift Of Music This Holiday Season.</strong></h2>
                <img class="hidden md:inline object-cover max-w-3xl lg:max-w-4xl mx-auto" src="https://d21q7xesnoiieh.cloudfront.net/fit-in/1600x0/filters:quality(95)/marketing/drumeo/promos/november/2024/gift-bundle/header-collage.webp" alt="Bundle Collage">
                <img class="max-w-2xl sm:max-w-xl md:hidden object-cover w-full p-4" src="https://d21q7xesnoiieh.cloudfront.net/fit-in/800x0/filters:quality(95)/marketing/drumeo/promos/november/2024/gift-bundle/header-collage.webp" alt="Bundle Collage Mobile">
               <div class="px-3 mx-auto w-full max-w-2xl">
                    <h2 class="leading-none my-1 md:my-4"><s class="opacity-50"> $322.94</s><strong> $240</strong> <span class="text-[#41F70F] text-xl md:text-3xl">(Save 31%)</span></h2>
                    @if($stock > 0)
                        <a class="join drumeo mt-4 w-full anchor-slide uppercase" href="#customize-anchor">get the deal &raquo;</a>
                    @else
                        <a class="join sold-out mt-4 w-full anchor-slide" href="#customize-anchor">SOLD OUT</a>
                    @endif
                    </div>
                </div>
            </div>
        </div>
    </header>

    @php
        $videoTargetSkus = ['drumeo-1-year', 'quietpad', 'easy-rudiments-book', 'Drumeo-VaterSticks'];
    @endphp

    <section class="pt-8 pb-16 sm:py-16 lg:py-20 px-4 sm:px-6 bg-[#F4F8FB]">
        <div class="container mx-auto max-w-5xl">
        <h2 class="leading-tight text-center pb-2"><strong>Here's what's you'll get with this bundle.</strong></h2>
        <p class="leading-normal text-center mb-3 lg:pb-6 md:px-12">The perfect way to gift Drumeo to a friend – you’ll get a physical one-year access pass to Drumeo that can be redeemed anytime along with three additional gifts for a lucky drummer in your life. </p>
            @include('drumeo._partials.bf-bonus-section', [
            'videoTargetSkus' => $videoTargetSkus,
            ])

            <div class="bg-[#CFEBFF] px-4 py-4 md:py-8 md:px-16 rounded-lg my-10 md:my-16">
                <div class="flex items-start gap-3 max-w-4xl md:pr-8">
                    <div class="flex-shrink-0">
                        <i class="fa-solid fa-circle-exclamation text-xl"></i>
                    </div>
                    <div class="text-sm">
                        <span class="font-semibold">Disclaimer:</span>
                        This bundle is ONLY available as a full-bundle. None of the discounted items can be purchased at that
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

        @include('drumeo._partials.countdown-bundle-2024')

        @php
            $targetSkus = ['quietpad', 'easy-rudiments-book', 'Drumeo-VaterSticks'];
        @endphp
        <div id="customize-anchor"></div>
        @include('drumeo._partials.bf-order-section-bonuses', [
        'bgColor' => 'background:linear-gradient(to bottom, #131633, #000);',
        'promoLogo' => 'https://d21q7xesnoiieh.cloudfront.net/fit-in/700x0/filters:quality(95)/marketing/drumeo/promos/november/2024/gift-bundle/gift-bundle-logo.svg',
        'logoHeight' => 'h-16 sm:h-18 md:h-24',
        'topImage' => 'marketing/drumeo/promos/november/2024/gift-bundle/bonus-01.webp',
        'bonusWidth' => 'w-1/2 md:w-1/3 lg:w-1/5',
        'promoHeader' => '<h2 class="leading-tight mb-4 sm:mb-5"><strong>Give The Gift Of Music This Holiday Season. </strong></h2>',
        'buttonLink' => '/ecommerce/add-to-cart?products[the-gift-bundle-drumeo]=1&promo-code=the-gift-bundle-drumeo&locked=true',
        'bundle'=> 'gift',
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

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script type="text/javascript" src="{{ asset('/marketing/parcel/drumeo/navigation-sales.js') }}"></script>
    {{-- <script src="{{ mix('/platform/js/manifest.js') }}"></script>
    <script src="{{ mix('/platform/js/vendor.js') }}"></script>
    <script src="{{ mix('/platform/js/app.js') }}"></script> --}}
@stop
