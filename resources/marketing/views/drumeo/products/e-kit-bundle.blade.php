@php
    require_once(resource_path('marketing/views/drumeo/_partials/bonus-data-2024.php'));
    require_once(resource_path('marketing/views/drumeo/_partials/homepage-data.php'));
    require_once(resource_path('marketing/views/drumeo/_partials/bonus-data.php'));
@endphp
@extends('drumeo._partials.global-layout')

@section('global-head')
    <title>Alesis Nitro Max E-Kit | Drumeo Edition</title>
    <meta property="og:title" content="Alesis Nitro Max E-Kit | Drumeo Edition">

    <meta name="description" content="Everything you need to start playing the drums.">
    <meta property="og:description" content="Everything you need to start playing the drums.">

    <meta property="og:image" content="https://d21q7xesnoiieh.cloudfront.net/fit-in/1300x0/filters:quality(95)/marketing/drumeo/products/kit/share-image.jpg" style="display: none;">
    <meta property="og:url" content="https://www.drumeo.com/{{ Request::path() }}">

    @include('_partials.layout._fonts')

    <link rel="stylesheet" href="{{ mix('marketing/css/app.css') }}">
    <link href="{{ asset('/marketing/css/tailwind-helpers.css') }}" rel="stylesheet">
    <link href="{{ asset('/marketing/parcel/drumeo/navigation-sales.css') }}" rel="stylesheet">
    <link href="{{ asset('/marketing/parcel/drumeo/sales-2020.css') }}" rel="stylesheet">
    <style>
        .join.outline.blue {
            border-color:#0b76db;
            color:#0b76db;
        }
        .join.smaller.outline {
            padding:12px 7%;
        }

        .text-gold {
            color:#d8b66e;
        }
        .join.gold {
            background:linear-gradient(to bottom, #e2c584, #ad7c12);
        }
    </style>
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
        "name" => "Drumeo E-Kit",
        "specialText" => "Get <strong>$506.95</strong> in free bonuses with the E-Kit.",
        "fullPrice" => floatval($productPrices['alesis-ekit']->price),
        "price" => floatval($productPrices['alesis-ekit']->discounted_price),
        "noBreadcrumb" => true
    ])

    <header class="text-white relative overflow-hidden z-10 object-cover object-center" style="height:900px; background: url('https://d21q7xesnoiieh.cloudfront.net/fit-in/1200x0/filters:quality(95)/marketing/drumeo/promos/november/2024/e-kit-bundle/ekit-bundle-bg.webp') no-repeat center center; background-size: cover;">
        <div class="transform -translate-y-1/2 top-1/2 left-0 w-full absolute z-20 px-4 lg:px-6 text-center">
            <div class="container mx-auto max-w-5xl">
                <img alt="E-Kit Bundle" class="h-16 sm:h-18" src="https://d21q7xesnoiieh.cloudfront.net/fit-in/1200x0/filters:quality(95)/marketing/drumeo/promos/november/2024/e-kit-bundle/ekit-bundle-logo.svg"><br>
                <h1 class="leading-tight my-3 lg:my-6"><strong>Everything you need to play drums!</strong></h1>
                <div class="flex flex-wrap justify-center gap-2 md:gap-4 mb-6">
                    <span class="flex items-center">
                        <i class="fa-solid fa-check text-drumeo mr-2"></i>
                        ELECTRONIC DRUM SET
                    </span>
                    <span class="flex items-center">
                        <i class="fa-solid fa-check text-drumeo mr-2"></i>
                        1 YEAR OF DRUM LESSONS
                    </span>
                    <span class="flex items-center">
                        <i class="fa-solid fa-check text-drumeo mr-2"></i>
                        5 FREE LIFETIME BONUSES
                    </span>
                </div>
                <img class="hidden md:inline object-cover max-w-3xl mx-auto" src="https://d21q7xesnoiieh.cloudfront.net/fit-in/1600x0/filters:quality(95)/marketing/drumeo/promos/november/2024/e-kit-bundle/header-collage.webp" alt="E-Kit Bundle Collage">
                <img class="md:hidden object-cover w-full p-4" src="https://d21q7xesnoiieh.cloudfront.net/fit-in/800x0/filters:quality(95)/marketing/drumeo/promos/november/2024/e-kit-bundle/header-collage-m.webp" alt="E-Kit Bundle Collage Mobile">
                <h2 class="leading-tight mt-6">
                    @if(floatval($productPrices['alesis-ekit']->price) > floatval($productPrices['alesis-ekit']->discounted_price))
                        <s class="opacity-50 font-extralight">${{ floatval($productPrices['alesis-ekit']->price) }}</s>
                        <strong>${{ floatval($productPrices['alesis-ekit']->discounted_price) }}</strong>
                        <span class="text-sm text-drumeo ml-2">(Save 59%)</span>
                    @else
                        <strong>${{ floatval($productPrices['alesis-ekit']->discounted_price) }}</strong>
                    @endif
                </h2>
                <div class="mt-5 sm:mt-7 mb-2 w-full max-w-xl mx-auto">
                    @if($products['alesis-ekit']->getStockAvailability() > 1 && !empty($products['alesis-ekit']->getStockAvailability()))
                        <a class="w-full md:w-6/12 join drumeo smaller anchor-slide ml-2" href="#customize-anchor">GET THE DEAL</a>
                    @else
                        <a class="join smaller sold-out">SOLD OUT</a>
                    @endif
                    <p class="text-sm mt-3 text-musora italic">Only {{ $products['alesis-ekit']->getStockAvailability() }} available.</p>           
                </div>
            </div>
        </div>
    </header>

    @php
        $targetSkus = ['alesis-nitro-max-e-kit', 'DLM-1-year', '30-day-drummer-4', '30-day-double-bass', '30-day-jazz', '30-day-chops'];
    @endphp

    <section class="pt-8 pb-16 sm:py-16 lg:py-20 px-4 sm:px-6 bg-[#F4F8FB]">
        <div class="container mx-auto max-w-5xl">
                
            @include('drumeo._partials.bf-bonus-section', [
            'targetSkus' => $targetSkus,
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

            <div x-data="timer()" x-init="countdown()" class="bg-musora mx-auto text-center py-1 md:py-2">
                    <div class="inline-flex flex-wrap mx-auto justify-center items-center">
                        <p class="leading-none m-0 font-black "><strong>DEALS END IN:</strong></p>
                        <div class="h-12 mx-2 sm:mx-4 bg-black" style="width:2px;"></div>
                        <div class="flex">
                            <div class="mr-4 sm:mr-6" x-show="timeLeft > 0 && day > 0">
                                <div class="text-2xl sm:text-3xl font-extrabold" x-text="day">00</div>
                                <div class="text-xs font-semibold" x-text="dayText">DAYS</div>
                            </div>
                            <div class="mr-4 sm:mr-6" x-show="timeLeft > 0 && hour > 0">
                                <div class="text-2xl sm:text-3xl font-extrabold" x-text="hour">00</div>
                                <div class="text-xs font-semibold" x-text="hourText">HRS</div>
                            </div>
                            <div class="mr-4 sm:mr-6" x-show="timeLeft > 0">
                                <div class="text-2xl sm:text-3xl font-extrabold" x-text="minute">00</div>
                                <div class="text-xs font-semibold" x-text="minuteText">MIN</div>
                            </div>
                            <div x-show="timeLeft > 0">
                                <div class="text-2xl sm:text-3xl font-extrabold" x-text="second">00</div>
                                <div class="text-xs font-semibold" x-text="secondText">SEC</div>
                            </div>
                            <span x-cloak x-show="timeLeft < 0">A Limited Time Left!</span>
                        </div>
                    </div>
                </div>
    {{-- @php
        $bonuses = [
                    [
                        'imageFull' => true,
                        'image' => 'https://www.musora.com/musora-cdn/image/width=520,quality=95/https://d21q7xesnoiieh.cloudfront.net/fit-in/600x0/marketing/drumeo/promos/november/2024/bonus-30dd.webp',
                        'title' => '30-Day Drummer',
                        'description' => 'Learn the drums with daily guided workouts.',
                        'price' => floatval($productPrices['30-day-drummer-4']->price),
                    ],
                    [
                        'imageFull' => true,
                        'image' => 'https://www.musora.com/musora-cdn/image/width=520,quality=95/https://d21q7xesnoiieh.cloudfront.net/fit-in/600x0/marketing/drumeo/promos/november/2024/bonus-30di.webp',
                        'title' => '30-Day Independence',
                        'description' => 'Improve your coordination with daily guided workouts.',
                        'price' => floatval($productPrices['30-day-independence']->price),
                    ],
                    [
                        'imageFull' => true,
                        'image' => 'https://www.musora.com/musora-cdn/image/width=520,quality=95/https://d21q7xesnoiieh.cloudfront.net/fit-in/600x0/marketing/drumeo/promos/november/2024/bonus-30ddb.webp',
                        'title' => '30-Day Double Bass',
                        'description' => 'Unlock your foot speed & control on the drums.',
                        'price' => floatval($productPrices['30-day-double-bass']->price),
                    ],
                    [
                        'imageFull' => true,
                        'image' => 'https://www.musora.com/musora-cdn/image/width=520,quality=95/https://d21q7xesnoiieh.cloudfront.net/fit-in/600x0/marketing/drumeo/promos/november/2024/bonus-30dj.webp',
                        'title' => '30-Day Jazz',
                        'description' => 'Immerse yourself in jazz drumming for 30 days.',
                        'price' => floatval($productPrices['30-day-jazz']->price),
                    ],
                    [
                        'imageFull' => true,
                        'image' => 'https://www.musora.com/musora-cdn/image/width=520,quality=95/https://d21q7xesnoiieh.cloudfront.net/fit-in/600x0/marketing/drumeo/promos/november/2024/bonus-30dc.webp',
                        'title' => '30-Day Chops',
                        'description' => 'Boost your creativity in just 30 days',
                        'price' => floatval($productPrices['30-day-chops']->price),
                    ],
                ];


            @endphp --}}

        @php
            $targetSkus = ['30-day-drummer-4', '30-day-independence', '30-day-double-bass', '30-day-jazz', '30-day-chops'];

            $filteredBonuses = collect($bonuses)->filter(function ($bonus) use ($targetSkus) {
                return in_array($bonus['sku'], $targetSkus, true);
            })->values();        
        @endphp

            @include('drumeo._partials.bf-order-section-bonuses', [
            'bgColor' => 'background:linear-gradient(to bottom, #131633, #000);',
            'promoLogo' => 'https://d21q7xesnoiieh.cloudfront.net/fit-in/1200x0/filters:quality(95)/marketing/drumeo/promos/november/2024/e-kit-bundle/ekit-bundle-logo.svg',
            'logoHeight' => 'h-16 sm:h-18',
            'topImage' => 'marketing/drumeo/promos/november/2024/e-kit-bundle/bonus-am.webp',
            'secondImage' => 'marketing/drumeo/promos/november/2024/e-kit-bundle/bonus-ek.webp', 
            'bonusWidth' => 'w-1/2 md:w-1/3 lg:w-1/5',
            'promoHeader' => '<h2 class="leading-tight mb-4 sm:mb-5"><strong>Save $875 on an electronic drum kit + lessons.</strong></h2> 
                <div class="flex flex-wrap justify-center gap-2 md:gap-4 mb-6 md:mb-12">
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
                </div>',
            'buttonLink' => '/ecommerce/add-to-cart?products[DLM-1-year]=1&products[the-drumeo-deal]=1&promo-code=drumeo-deal-2024&locked=true',
            'bundle'=> "kit",
            ])
    </div>

     @php
        $videoBonuses = [];
        foreach ($bonusVideos as $bonusVideo) {
            if (!empty($bonusVideo['vimeoId']) && in_array($bonusVideo['sku'], $targetSkus)) {
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
