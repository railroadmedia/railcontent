@php
    require_once(resource_path('marketing/views/drumeo/_partials/homepage-data.php'));
    require_once(resource_path('marketing/views/drumeo/_partials/bonus-data.php'));
@endphp

@extends('drumeo.sales.subscription', [
    "promoVersion" => true,
])
@section('body-data')
    x-data ='{
    demoVid : false,
    trailer : false,
    lazyLoad: false,
    videoLoaded: false,
    @foreach($drumeo['packs'] as $modalData)
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
                        'Drumeo-VaterSticks',
                        'practicepad',
                        '30-day-drummer-4',
                        '30-day-independence',
                        '30-day-double-bass',
                        '30-day-jazz',
                        '30-day-independence',
                        '30-day-chops'
                    ];
                @endphp
                <div id="customize-anchor"></div>
                <h4 class="relative w-auto inline-block mb-4 lg:mb-6 font-black font-lexend leading-none uppercase">
                    NEW YEAR. <span class="text-drumeo">NO EXCUSES.</span>
                </h4><br>
                <h1 class="relative w-auto inline-block text-3xl sm:text-5xl lg:text-6xl mb-7 sm:mb-10 font-black font-lexend leading-none sm:leading-none lg:leading-none uppercase">
                    EVERYTHING<br class="sm:hidden"> YOU NEED<br class="hidden sm:inline"> TO
                    <br class="sm:hidden">LEARN THE DRUMS.
                </h1>
                @include('musora.sales.components.order-promo-cards-section', [
                // general
                'buttonText' => "GET STARTED",

                // first deal
                'firstDeal'=> "Digital New Year Bundle",
                'firstDealImage' => 'https://d21q7xesnoiieh.cloudfront.net/fit-in/670x0/filters:quality(95)/marketing/drumeo/promos/january/ny-collage-digital.webp',
                'firstImageHeight' => 'h-24 sm:h-28',
                'firstDealPrice' => 180,
                'firstDealDiscount' => 875,
                'firstDealSub' => "Save 25% on your first year +<br>  get 5 digital bonuses.",
                "firstDealLink" => "/ecommerce/add-to-cart?products[DLM-1-year]=1&products[30-day-double-bass]=1&products[30-day-independence]=1&products[30-day-jazz]=1&products[30-day-chops]=1&products[30-day-drummer-4]=1&promo-code=welcome-back,NYD25&locked=true",
                'firstExtraBonuses' => [
                    '<i class="fa-solid fa-check pr-1 text-drumeo"></i> <strong class="text-drumeo">BONUS</strong> 30-Day Drummer ($127 value)',
                    '<i class="fa-solid fa-check pr-1 text-drumeo"></i> <strong class="text-drumeo">BONUS</strong> 30-Day Independence ($127 value)',
                    '<i class="fa-solid fa-check pr-1 text-drumeo"></i> <strong class="text-drumeo">BONUS</strong> 30-Day Double Bass ($127 value)',
                    '<i class="fa-solid fa-check pr-1 text-drumeo"></i> <strong class="text-drumeo">BONUS</strong> 30-Day Jazz ($127 value)',
                    '<i class="fa-solid fa-check pr-1 text-drumeo"></i> <strong class="text-drumeo">BONUS</strong> 30-Day Chops ($127 value)',
                    '<i class="fa-solid fa-check pr-1 text-drumeo"></i> No shipping, No VAT required',
                    '<i class="fa-solid fa-check pr-1 text-drumeo"></i> 90-Day Guarantee',
            ],

                // second deal
                'topBadge' => "BEST DEAL",
                'secondDeal' => "New Year Bundle",
                'secondDealImage' => 'https://d21q7xesnoiieh.cloudfront.net/fit-in/670x0/filters:quality(95)/marketing/drumeo/promos/january/ny-collage2.webp',
                'secondImageHeight' => 'h-24 sm:h-28',
                'secondDealSub' => "Save 20% on your first year +<br>  get 7 bonuses worth $726.95.",
                'secondDealPrice' => 192,
                'secondDealDiscount' => 966.95,
                "secondDealLink" => "/ecommerce/add-to-cart?products[DLM-1-year]=1&products[drumeo-new-years-bundle]=1&promo-code=NYPHD25,new-year,ny-member-shipping&locked=true",
                'secondExtraBonuses' => [
                    '<i class="fa-solid fa-check pr-1 text-drumeo"></i> <strong class="text-drumeo">BONUS</strong> 30-Day Drummer ($127 value)',
                    '<i class="fa-solid fa-check pr-1 text-drumeo"></i> <strong class="text-drumeo">BONUS</strong> 30-Day Independence ($127 value)',
                    '<i class="fa-solid fa-check pr-1 text-drumeo"></i> <strong class="text-drumeo">BONUS</strong> 30-Day Double Bass ($127 value)',
                    '<i class="fa-solid fa-check pr-1 text-drumeo"></i> <strong class="text-drumeo">BONUS</strong> 30-Day Jazz ($127 value)',
                    '<i class="fa-solid fa-check pr-1 text-drumeo"></i> <strong class="text-drumeo">BONUS</strong> 30-Day Chops ($127 value)',
                    '<i class="fa-solid fa-check pr-1 text-drumeo"></i> <strong class="text-drumeo">BONUS</strong> <span class="text-drumeo">P4 Practice Pad ($79 value)</span>',
                    '<i class="fa-solid fa-check pr-1 text-drumeo"></i> <strong class="text-drumeo">BONUS</strong> <span class="text-drumeo">Drumeo Vater Drumsticks ($12.95 value)</span>',
                    '<i class="fa-solid fa-check pr-1 text-drumeo"></i> Free shipping in the U.S. and Canada',
                    '<i class="fa-solid fa-check pr-1 text-drumeo"></i> 90-Day Guarantee',
            ],
        ])
                <p class="text-sm my-7">
                    <em>Need drums too?
                        <a class="underline" href="/drumshop/kit">
                            Click here to grab the<br class="sm:hidden"> Drumeo Nitro Max E-Kit + 1 year of lessons.
                        </a>
                    </em>
                </p>
            </div>
        </div>
    </section>
@endsection
