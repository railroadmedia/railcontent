@php
    require_once(resource_path('marketing/views/drumeo/_partials/homepage-data.php'));
    require_once(resource_path('marketing/views/drumeo/_partials/bonus-data-2024.php'));
@endphp

@extends('drumeo._partials.global-layout')

@section('global-head')
    <title>Lifetime Membership | Drumeo</title>
    <meta property="og:title" content="Lifetime Membership | Drumeo">
    <meta property="og:url" content="https://www.drumeo.com/{{ Request::path() }}">

    <meta name="description" content="Drum lessons for LIFE.">
    <meta property="og:description" content="Drum lessons for LIFE.">
    <meta property="og:image" content="https://dpwjbsxqtam5n.cloudfront.net/promos/november/lifetime-fb-share-image.jpg" style="display: none;">

    <link rel="stylesheet" href="{{ mix('marketing/css/app.css') }}">
    <link href="{{ asset('/marketing/parcel/drumeo/navigation-sales.css') }}" rel="stylesheet">
    <link href="{{ asset('/marketing/css/tailwind-helpers.css') }}" rel="stylesheet">
    <link href="{{ asset('/marketing/parcel/drumeo/sales-2020.css') }}" rel="stylesheet">
@stop

@section('body-data')
    x-data="{
    trailer : false,
    lazyLoad: false,
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
        if(!empty($products['DLM-Lifetime']->getPublicStockCount())) {
            $stock = $products['DLM-Lifetime']->getPublicStockCount();
        }
        else {
            $stock = 0;
        }
    @endphp
{{--    @include('_partials.components.shop.promo-banner', [--}}
{{--        "name" => "Lifetime",--}}
{{--        "fullPrice" => 1200,--}}
{{--        "price" => 1200,--}}
{{--        "specialText" => "<strong>Only <s class='opacity-60'>500</s> <span class='text-promo'>" . $stock . "</span> left!</strong>",--}}
{{--        "noBreadcrumb" => true,--}}
{{--                "noCountdown" => true--}}
{{--    ])--}}

    <section class="px-5 py-10 md:py-14 lg:py-16 text-white text-center" style="background:radial-gradient(#850938, #000)">
        <div class="container mx-auto">
            <h3 class="leading-none"><strong>Save $828.87 on most popular practice essentials + lessons. </strong></h3>

            <p class="text-sm leading-normal sm:tracking-widest mb-5 lg:mb-7">
                <i class="fas fa-check text-drumeo"></i> todo
                <i class="fas fa-check ml-3 sm:ml-5 text-drumeo"></i> todo
                <br class="lg:hidden">
                <i class="fas fa-check lg:ml-5 text-drumeo"></i> todo
                <i class="fas fa-check ml-3 sm:ml-5 text-drumeo"></i> todo
            </p>
            <div class="w-full mx-auto my-4 sm:my-8 " style="max-width:920px;">
                <img src="https://d21q7xesnoiieh.cloudfront.net/fit-in/1250x0/filters:quality(95)/marketing/drumeo/membership/homepage/webp-format/devices.webp">
            </div>
            <div class="px-3 mx-auto w-full max-w-2xl">
                <h2 class="leading-none mb-1"><strong>$1200</strong></h2>
                @if($stock > 0)
                    <a class="join drumeo mt-4 w-full anchor-slide" href="#customize-anchor">GET STARTED &raquo;</a>
                @else
                    <a class="join sold-out mt-4 w-full anchor-slide" href="#customize-anchor">SOLD OUT</a>
                @endif
                <p class="leading-tight text-sm text-musora"><em>Only 400 available.</em></p>
            </div>
        </div>
    </section>
    @php
        $targetSkus = ['30-day-drummer-4', '30-day-independence', '30-day-double-bass', '30-day-jazz', '30-day-chops'];

        $filteredBonuses = collect($bonusVideos)->filter(function ($bonus) use ($targetSkus) {
            return in_array($bonus['sku'], $targetSkus, true);
        })->values();
    @endphp

    <section class="pt-8 pb-16 sm:py-16 lg:py-20 px-4 sm:px-6 bg-[#F4F8FB]">
        <div class="container mx-auto max-w-5xl">
        <h3 class="leading-tight text-center mb-3"><strong>Here's what's you'll get with this bundle.</strong></h3>
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

    @include('_partials.components.video-modal',[
        'name' => 'trailer',
        'video' => '917719282',
        'vimeo' => true,
        'styles' => 'pb-[177%] sm:pb-[66vh] bg-white',
    ])

    @include("drumeo.sales.partials._footer")

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script type="text/javascript" src="{{ asset('/marketing/parcel/drumeo/navigation-sales.js') }}"></script>
    <script src="{{ mix('/platform/js/manifest.js') }}"></script>
    <script src="{{ mix('/platform/js/vendor.js') }}"></script>
    <script src="{{ mix('/platform/js/app.js') }}"></script>
    <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/lazysizes/5.3.2/lazysizes.min.js"></script>
    <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/lazysizes/5.3.2/plugins/unveilhooks/ls.unveilhooks.min.js"></script>
@stop
