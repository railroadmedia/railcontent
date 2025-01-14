@php
    require_once(resource_path('marketing/views/pianote/_partials/homepage-data.php'));
    require_once(resource_path('marketing/views/pianote/_partials/bonus-data.php'));
@endphp

@extends('pianote.sales.subscription', [
    "promoVersion" => true,
])
@section('body-data')
    x-data ='{
    demoVid : false,
    trailer : false,
    lazyLoad: false,
    videoLoaded: false,
    @foreach($pianote['packs'] as $modalData)
        {{ $modalData['name'] }}: false,
    @endforeach
    }'
@endsection

@section('final')
       <section
        class="px-4 lg:px-8 py-10 sm:py-16 lg:py-20 relative overflow-hidden text-white text-center customize relative overflow-hidden"
        style="background: linear-gradient(to bottom, #1D4689, #0f1d34);">
        <div class="container mx-auto max-w-5xl">
            <div x-data="{lazyLoad: false}">
                @php
                    $targetSkus = [
                        'best-beginner-piano-book',
                        'pianote-practice-planner',
                        'piano-chords-and-scales-guide',
                        'new-piano-players-start-here',
                        'easy-chords',
                        '30-day-blues-piano',
                        '30-days-to-better-technique',
                        'classical-piano-collection'
                    ];
                @endphp
                <div id="customize-anchor"></div>


                <h4 class="relative w-auto inline-block mb-4 lg:mb-6 font-black font-lexend leading-none uppercase">
                    NEW YEAR. <span class="text-pianote">NO EXCUSES.</span>
                </h4><br>
                <h1 class="relative w-auto inline-block text-3xl sm:text-5xl lg:text-6xl mb-7 sm:mb-10 font-black font-lexend leading-none sm:leading-none lg:leading-none uppercase">
                    EVERYTHING<br class="sm:hidden"> YOU NEED<br class="hidden sm:inline"> TO
                    <br class="sm:hidden">LEARN THE PIANO.
                </h1>

                @include('musora.sales.components.order-promo-cards-section', [
                // general
                'buttonText' => "GET STARTED",

                // first deal
                'firstDeal'=> "Pianote Only",
                'firstDealImage' => 'https://d21q7xesnoiieh.cloudfront.net/fit-in/420x0/filters:quality(95)/marketing/pianote/promos/march/order-membership.webp',
                'firstImageHeight' => 'h-24 lg:h-28',
                'firstDealPrice' => 180,
                'firstDealDiscount' => 240,
                'firstDealSub' => "Save 25% on your first year.<br> No physical bonuses",
                "firstDealLink" => "/ecommerce/add-to-cart?products[PIANOTE-MEMBERSHIP-1-YEAR]=1&products[new-piano-players-start-here]=1&products[easy-chords]=1&products[30-day-blues-piano]=1&products[30-days-to-better-technique]=1&products[classical-piano-collection]=1&promo-code=welcome-back,NYP25&locked=true",

                // second deal
                'topBadge' => "BEST DEAL",
                'secondDeal' => "New Year Bundle",
                'secondDealImage' => 'https://d21q7xesnoiieh.cloudfront.net/fit-in/710x0/filters:quality(95)/marketing/pianote/promos/january/ny-collage2.webp',
                'secondImageHeight' => 'h-24 lg:h-28',
                'secondDealSub' => "Save 20% on your first year +<br>  get 8 bonuses worth $726.",
                'secondDealPrice' => 192,
                'secondDealDiscount' => 1002,
                "secondDealLink" => "/ecommerce/add-to-cart?products[PIANOTE-MEMBERSHIP-1-YEAR]=1&products[pianote-new-years-bundle]=1&promo-code=NYPHP25,new-year,ny-member-shipping&locked=true",
                'secondExtraBonuses' => [
                    '<i class="fa-solid fa-check pr-1 text-pianote"></i> <strong class="text-pianote">BONUS</strong> Best Beginner Piano Book ($49 value)',
                    '<i class="fa-solid fa-check pr-1 text-pianote"></i> <strong class="text-pianote">BONUS</strong> Practice Planner ($39 value)',
                    '<i class="fa-solid fa-check pr-1 text-pianote"></i> <strong class="text-pianote">BONUS</strong> Chords & Scales Book ($39 value) ',
                    '<i class="fa-solid fa-check pr-1 text-pianote"></i> <strong class="text-pianote">BONUS</strong> New Piano Players Start Here ($127 value)',
                    '<i class="fa-solid fa-check pr-1 text-pianote"></i> <strong class="text-pianote">BONUS</strong> Easy Chords ($127 value)',
                    '<i class="fa-solid fa-check pr-1 text-pianote"></i> <strong class="text-pianote">BONUS</strong> 30-Day Blues Piano ($127 value)',
                    '<i class="fa-solid fa-check pr-1 text-pianote"></i> <strong class="text-pianote">BONUS</strong> 30 Days to Better Technique ($127 value)',
                    '<i class="fa-solid fa-check pr-1 text-pianote"></i> <strong class="text-pianote">BONUS</strong> Classical Piano Collection ($127 value)',
            ],
        ])
                <p class="text-sm mb-7">
                    <em>Need a piano?
                        <a class="underline" href="/shop/prima">Get the Keyboard Bundle</a>
                    </em>
                </p>
            </div>
        </div>
    </section>
@endsection
