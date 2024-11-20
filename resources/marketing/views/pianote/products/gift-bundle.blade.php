@php
    require_once(resource_path('marketing/views/pianote/_partials/bonus-data-2024.php'));
    require_once(resource_path('marketing/views/pianote/_partials/homepage-data.php'));
    require_once(resource_path('marketing/views/pianote/_partials/bonus-data.php'));
@endphp

@extends('pianote._partials.global-layout')

@section('global-head')
    @parent
    <title>Gift Bundle | Pianote</title>
    <meta property="og:title" content="Gift Bundle | Pianote">
    <meta name="description" content="Give The Gift Of Music This Holiday Season.">
    <meta property="og:description" content="Give The Gift Of Music This Holiday Season.">
    <meta property="og:image"
        content="https://d21q7xesnoiieh.cloudfront.net/fit-in/1200x0/marketing/pianote/promos/black-friday/gift-bundle-share-image.jpg"
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
    {{-- @include('_partials.components.shop.promo-banner-3', [
        'name' => 'Classical Piano Pieces',
        'fullPrice' => floatval($productPrices['read-music-in-30-days-workbook']->price),
        'price' => floatval($productPrices['read-music-in-30-days-workbook']->discounted_price),
        'noBreadcrumb' => true,
    ]) --}}
     <header class="text-white relative overflow-hidden z-10 object-cover object-center h-[600px] lg:h-[800px]" style="background: url('https://d21q7xesnoiieh.cloudfront.net/fit-in/1200x0/filters:quality(95)/marketing/pianote/promos/black-friday/the-gift-bundle/header-bg.webp') no-repeat center center; background-size: cover;">
        <div class="transform -translate-y-1/2 top-1/2 left-0 w-full absolute z-20 px-4 lg:px-6 text-center">
            <div class="container mx-auto max-w-5xl lg:pt-10">
                <img alt="Bundle Logo" class="h-20 sm:h-24" src="https://d21q7xesnoiieh.cloudfront.net/fit-in/1200x0/filters:quality(95)/marketing/pianote/promos/black-friday/the-gift-bundle/gift-bundle-new.svg"><br>
                <h2 class="leading-tight my-3 lg:my-6"><strong>Give The Gift Of Music This Holiday Season.</strong></h2>
                <img class="hidden md:inline object-cover max-w-3xl lg:max-w-4xl mx-auto" src="https://d21q7xesnoiieh.cloudfront.net/fit-in/2000x0/filters:quality(95)/marketing/pianote/promos/black-friday/the-gift-bundle/header-collage.webp" alt="Bundle Collage">
                <img class="md:hidden object-cover w-full sm:max-w-2xl p-4" src="https://d21q7xesnoiieh.cloudfront.net/fit-in/800x0/filters:quality(95)/marketing/pianote/promos/black-friday/the-gift-bundle/header-collage.webp" alt="Collage Mobile">
               <div class="px-3 mx-auto w-full max-w-2xl">
                    <h2 class="leading-none my-1 md:my-4"><s class="opacity-50"> $349</s><strong> $240</strong> <span class="text-[#41F70F] text-3xl">(Save 31%)</span></h2>
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
     @include('pianote._partials.bf-header-bottom')


    @php
        $videoTargetSkus = ['1-year-membership', 'practice-kit', 'little-book-bundle', 'music-theory-posters'];
    @endphp

    <section class="pt-8 pb-16 sm:py-16 lg:pt-20 lg:pb-28 px-4 sm:px-6 bg-white">
        <div class="container mx-auto max-w-5xl">
         <h1 class="leading-tight text-center mb-3"><strong>Here’s what you’ll get <br> with this bundle. </strong></h1>
            <h5 class="leading-normal text-center mb-3 lg:pb-6 md:px-8">The perfect way to gift Pianote to a friend – you’ll get a physical one-year access pass to Pianote that can be redeemed anytime along with three additional gifts for a lucky pianist in your life. </h5>
                
            @include('drumeo._partials.bf-bonus-section', [
            'videoTargetSkus' => $videoTargetSkus,
            ])
        </div>
    </section>

    <div x-data="{lazyLoad: false}">
         @include('musora.sales.components.guarantee-section', [
        'badge' => 'marketing/pianote/membership/homepage/webp-format/piano-guarantee.webp',
        'header' => '<strong>Happy student guarantee.</strong><br>Test-drive your lessons for 90 days. Zero risk.',
        'desc' => 'Online lessons can be intimidating. Maybe you’re wondering if they work, or if you’ll use them enough – or if you’ll even enjoy the experience. So we’re removing the risk with our 90-day guarantee. More than anything, we want to make sure you have a POSITIVE experience developing new skills and gaining confidence on the piano.',
    ])
        @include('drumeo._partials.countdown-bundle-2024')

        @php
            $targetSkus = ['music-theory-posters', 'practice-kit', 'little-book-bundle',];
        @endphp
            <div id="customize-anchor"></div>   
            @include('drumeo._partials.bf-order-section-bonuses', [
            'bgColor' => 'background:linear-gradient(to bottom, #131633, #000);',
            'promoLogo' => 'https://d21q7xesnoiieh.cloudfront.net/fit-in/1200x0/filters:quality(95)/marketing/pianote/promos/black-friday/the-gift-bundle/gift-bundle-new.svg',
            'logoHeight' => 'h-16 sm:h-20 md:h-24',
            'topImage' => 'marketing/pianote/promos/black-friday/the-gift-bundle/bonus-AP.webp',
            'bonusWidth' => 'w-1/2 md:w-1/3 lg:w-1/5',
            'promoHeader' => '<h2 class="leading-tight mb-4 sm:mb-5"><strong>Give The Gift Of Music This Holiday Season.</h2>',            
            'buttonLink' => '/ecommerce/add-to-cart?products[the-gift-bundle-pianote]=1&promo-code=the-gift-bundle-pianote&locked=true', 
            'bundle'=> "gift",
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
