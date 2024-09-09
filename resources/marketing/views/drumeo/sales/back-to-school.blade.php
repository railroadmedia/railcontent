@php
    require_once(resource_path('marketing/views/drumeo/_partials/homepage-data.php'));
@endphp
@extends('drumeo.sales.subscription', [
    "promoVersion" => true,
    "shopNav" => true,
    "hideHeader" => true,
])
@section('body-data')
    x-data ='{
    soundslice : false,
    waitlist: false,
    trailer : false,
    lazyLoad: false,
    videoLoaded: false,
    keyTrailer : false,
    }'
@endsection

@section('top-bar')
@php
    $originalPrice = 240;
    $discountedPrice = 200;
    $savePercentage = round((($originalPrice - $discountedPrice) / $originalPrice) * 100);
@endphp

    @php

       $bubbles =  [
            [
                'src' => $bubble1,
                'classes' => 'h-10 sm:h-14 lg:h-16 top-[53%] sm:top-[53%] left-[4%] sm:left-[4%]',
            ],
            [
                'src' => $bubble2,
                'classes' => 'h-24 sm:h-28 lg:h-44 top-[13%] sm:top-[21%] left-[8%] sm:left-[10%]',
            ],
            [
                'src' => $bubble3,
                'classes' => 'h-32 sm:h-40 lg:h-52 top-[84%] sm:top-[81%] left-[9%] sm:left-[18%]',
            ],
            [
                'src' => $bubble4,
                'classes' => 'h-10 sm:h-12 lg:h-16 top-[13%] sm:top-[13%] left-[31%] sm:left-[31%]',
            ],
            [
                'src' => $bubble5,
                'classes' => 'h-10 sm:h-12 lg:h-16 top-[8%] sm:top-[8%] left-[58%] sm:left-[58%]',
            ],
            [
                'src' => $bubble6,
                'classes' => 'h-28 sm:h-32 lg:h-48 top-[88%] sm:top-[88%] left-[90%] sm:left-[78%]',
            ],
            [
                'src' => $bubble7,
                'classes' => 'h-28 sm:h-36 lg:h-52 top-[13%] sm:top-[18%] left-[93%] sm:left-[87%]',
            ],
            [
                'src' => $bubble8,
                'classes' => 'h-12 sm:h-14 lg:h-16 top-[63%] sm:top-[63%] left-[99%] sm:left-[99%]',
            ]
        ];
           $slides = $drumeo['slides'];
    @endphp
    <header class="text-center px-5 sm:px-6 py-44 sm:py-52 lg:py-56 relative overflow-hidden"
        style="background:linear-gradient(to right, #e0ecf9, #f6f8fc, #f6f8fc, #e0ecf9);">
        <div class="container max-w-6xl mx-auto relative z-20">
            <img class="h-20 sm:h-32 mb-4 sm:mb-6" src="https://d21q7xesnoiieh.cloudfront.net/fit-in/700x0/filters:quality(95)/marketing/drumeo/promos/september/bts-logo-black.png">
            <br>
            <h1 class="relative w-auto inline-block mb-7 sm:mb-10 font-black leading-none">
                Get 1 year of unlimited <span class="hidden sm:inline">drum</span> lessons
                <br class="hidden sm:inline"> <span class="relative inline-block">+ $508 in FREE courses.<svg class="absolute left-0 right-0 bottom-0 w-full h-4 sm:h-7" xmlns="http://www.w3.org/2000/svg" width="100%" height="100%" viewBox="0 0 524 22" fill="none" style="transform: translate(0, 100%);"><path d="M1.99978 10.6328C84.053 4.08508 302.889 -3.20824 521.809 20" stroke="#0B76DB" stroke-width="3" stroke-linecap="round"></path><path d="M2.17373 15.0541C83.9528 7.29382 302.406 -3.51921 521.988 15.3111" stroke="#0B76DB" stroke-width="3" stroke-linecap="round"></path></svg></span>
            </h1>

            <p class="uppercase"><strong class="font-black">Lifetime Access to</strong></p>
            <p class="text-sm leading-normal sm:tracking-widest mb-5 lg:mb-7 uppercase">
                <i class="fas fa-check text-drumeo"></i> 30-Day Drummer<br class="sm:hidden">
                <i class="fas fa-check ml-3 sm:ml-5 text-drumeo"></i> 30-Day Chops
                <br class="lg:hidden">
                <i class="fas fa-check lg:ml-5 text-drumeo"></i> 30-Day Independence<br class="sm:hidden">
                <i class="fas fa-check ml-3 sm:ml-5 text-drumeo"></i> 30-Day Double Bass
            </p>

            <div class="flex flex-wrap justify-center max-w-xs sm:max-w-full mx-auto px-5 sm:px-0">
                <a class="sm:mx-0.5 w-full sm:w-56 join drumeo smaller sm:order-1 mb-2 sm:mb-0 anchor-slide"
                    href="#customize-anchor" aria-label="Customize anchor"
                >GET STARTED </a>
                <div class="sm:mx-0.5 w-full sm:w-56 join outline black smaller autoplay-video" x-on:click="trailer = true;">WATCH THE TRAILER</div>
            </div>

            <div class="flex flex-wrap items-center justify-center mt-2 sm:mt-3 mx-auto">
                <a aria-label="Review" class="inline-block" href="https://www.shopperapproved.com/reviews/Musora.com" target="_blank" rel="noopener noreferrer" onclick="window.open('https://www.shopperapproved.com/reviews/Musora.com', 'newwindow', 'width=750, height=550'); return false;">
                    <i class="align-middle text-lg fas fa-star" style="color: #ffac00;" aria-hidden="true"></i>
                    <i class="align-middle text-lg -ml-4 fas fa-star" style="text-shadow: -2px -1px 1px #FFF;color: #ffac00;" aria-hidden="true"></i>
                    <i class="align-middle text-lg -ml-4 fas fa-star" style="text-shadow: -2px -1px 1px #FFF;color: #ffac00;" aria-hidden="true"></i>
                    <i class="align-middle text-lg -ml-4 fas fa-star" style="text-shadow: -2px -1px 1px #FFF;color: #ffac00;" aria-hidden="true"></i>
                    <i class="align-middle text-lg -ml-4 fas fa-star" style="text-shadow: -2px -1px 1px #FFF;color: #ffac00;" aria-hidden="true"></i>
                </a>
                <p class="inline-block leading-tight text-xs align-middle pl-1 m-0"><em>Trusted by {{ number_format(Prices::$students) }} active students.</em></p>
            </div>
        </div>
        @foreach($bubbles as $bubble)
            <picture>
                <source media="(min-width:640px)" srcset="{{ $bubble['src'] }}">
                <img class="absolute z-10 transform -translate-x-1/2 -translate-y-1/2 {{ $bubble['classes'] }}"
                    src="{{ $bubble['src'] }}" alt="header circle image" fetchpriority="high">
            </picture>
        @endforeach
    </header>
    <section class="sm:px-6 py-4 sm:py-5 text-white relative z-10" style="background:#0c1524;">
        <div class="container max-w-5xl mx-auto">
            @component('_partials.components.carousel',[
                'xdata' => "
                    classes: {
                        arrow: 'splide__arrow bg-white opacity-100 shadow-lg h-11 w-11 header-slide-btn',
                        prev: 'splide__arrow--prev your-class-prev hidden sm:flex z-50',
                        next: 'splide__arrow--next your-class-next hidden sm:flex z-50',
                        pagination: 'hidden',
                    },
                    perPage: 1,
                    perMove: 1,
                    type: 'loop',
                    autoplay: true,
                    pauseOnHover: true,
                    pauseOnFocus: true,
                    interval: 3000,
                    lazyLoad: 'nearby',
                ",
            ])
                @slot('content')
                    @foreach ($slides as $slide)
                        <li class="splide__slide">
                            <div class="px-3 md:px-6 text-center">
                                <p class="leading-normal text-sm"><em>“{{ $slide['desc'] }}”</em></p>
                                <div class="flex flex-wrap md:flex-nowrap sm:text-left items-center justify-center mt-1.5">
                                    <img
                                        class="rounded-full object-cover object-right w-9 h-9"
                                        data-splide-lazy={{ $slide['thumb'] }}
                                alt="{{$slide['name']}}"
                                    ><br class="inline md:hidden">
                                    <p class="leading-tight w-full text-center md:w-auto text-sm text-light-navy ml-1 md:ml-2 mr-0 mt-0.5 md:mt-0"><em>{{ $slide['name'] }}, {{ $slide['credit'] }}</em></p>
                                </div>
                            </div>
                        </li>
                    @endforeach
                @endslot
            @endcomponent
        </div>
    </section>
@endsection

@section('final')
    <section class="py-14 sm:py-24 lg:py-32 relative overflow-hidden text-white text-center customize px-4 lg:px-6"
        style="background: linear-gradient(68deg, #07233E 0%, #0C1524 100%);">
        <div class="container mx-auto relative z-50  max-w-5xl ">
            <div class="w-full px-4 md:px-0 mb-6">
                <img class="h-24 sm:h-40" src="https://d21q7xesnoiieh.cloudfront.net/fit-in/2000x0/filters:quality(95)/marketing/drumeo/promos/september/bts-logo-white.svg">
                <br>
                <h3 class="leading-tight mt-4 sm:mt-5 mb-2"><strong>Get 1 year of unlimited drum lessons<br class="hidden sm:inline"> + lifetime access to all 30-day courses.</strong></h3>
            </div>

            @php
                $bonuses = [
                    [
                    'image' => 'https://d21q7xesnoiieh.cloudfront.net/fit-in/420x0/filters:quality(95)/marketing/drumeo/promos/may/card-annual.png',
                    'title' => 'Drumeo',
                    'description' => "Level up your skills with Drumeo - the world's best lessons, teachers, and practice tools trusted by thousands of active students.",
                    'price' => 240,
                    'customText' => '$200',
                    'customSubText' => 'true',
                    ],
                    [
                    'image' => 'https://d21q7xesnoiieh.cloudfront.net/fit-in/800x0/filters:quality(95)/marketing/drumeo/promos/summer-sale/30DD-card.webp',
                    'title' => '30-Day Drummer',
                    'description' => '30-Day Drummer gives you guided play-along workouts every day for thirty days.',
                    'price' => floatval($productPrices['30-day-drummer-4']->price),
                    ],
                    [
                    'image' => 'https://d21q7xesnoiieh.cloudfront.net/fit-in/800x0/filters:quality(95)/marketing/drumeo/promos/september/30di.png',
                    'title' => '30-Day Independence',
                    'description' => 'Improve your coordination with daily guided workouts.',
                    'price' => floatval($productPrices['30-day-independence']->price),
                    ],
                    [
                    'image' => 'https://d21q7xesnoiieh.cloudfront.net/fit-in/800x0/filters:quality(95)/marketing/drumeo/promos/summer-sale/30DC-card.webp',
                    'title' => '30-Day Chops',
                    'description' => '30-Day Chops is the first-ever course that teaches you tasty linear drum chops one note at a time.',
                    'price' => floatval($productPrices['30-day-chops']->price),
                    ],
                    [
                    'image' => 'https://d21q7xesnoiieh.cloudfront.net/fit-in/800x0/filters:quality(95)/marketing/drumeo/promos/september/30ddb.png',
                    'title' => '30-Day Double Bass',
                    'description' => 'Unlock your foot speed & control on the drums.',
                    'price' => floatval($productPrices['30-day-double-bass']->price),
                    ],
                ];
            @endphp
            <div style="font-size:0px">
                @foreach($bonuses as $bonus)
                    <div
                        class="bonus-wrap relative inline-block align-top mx-auto mb-4 px-1 md:px-2 @if(!empty($bonusWidth)) {{ $bonusWidth }} @else w-1/2 md:w-1/3 lg:w-1/5 @endif"
                        x-data="{
                        flipped: false,
                    }"
                        x-on:click="
                        flipped = !flipped;
                        if(flipped){
                            $refs.front.classList.add('rotate-y-180');
                            $refs.back.classList.remove('-rotate-y-180');
                            $refs.back.classList.add('rotate-y-0');
                        }
                        else {
                            $refs.front.classList.remove('rotate-y-180');
                            $refs.back.classList.add('-rotate-y-180');
                            $refs.back.classList.remove('rotate-y-0');
                        }
                    "
                    >
                        <div class="flip-div inline-block relative w-full group" style="@if(empty($bonus['bigCard'])) padding-bottom: 133%; @else padding-bottom: 103%; @endif perspective: 1000px;">
                            <div class="text-center w-full h-full absolute cursor-pointer" style="transform-style: preserve-3d;">
                                <div
                                    x-ref="front"
                                    class="border-2 border-drumeo front absolute z-20 overflow-hidden rounded-xl w-full h-full transition-transform duration-700"
                                    style="@if(!empty($bonus['special'])) overflow: visible;border-color: #cda880; @endif backface-visibility: hidden;">
                                    @if(!empty($bonus['badge']))
                                        <h6 class="absolute text-white top-0 left-0 w-full py-0.5 bg-{{ $theme }} font-bebas uppercase">{{ $bonus['badge'] }}</h6>
                                    @endif
                                    <div class="overflow-hidden h-full w-full bg-black bg-top bg-cover"
                                        :class="{'opacity-0': !lazyLoad, 'opacity-100': lazyLoad}"
                                        x-intersect.once="lazyLoad = true">
                                        <picture class="absolute inset-0 w-full h-full object-cover">
                                            <source srcset="{{ $bonus['image'] }}"
                                                media="(min-width: 640px)">
                                            <img src="{{ $bonus['image'] }}"
                                                alt="Bonus Image"
                                                class="w-full h-full object-cover opacity-0 transition-opacity"
                                                loading="lazy"
                                                onload="this.classList.remove('opacity-0')">
                                        </picture>
                                    </div>
                                    <div class="absolute z-40 text-center top-1/2 left-1/2 text-white transition-opacity duration-300 transform -translate-x-1/2 -translate-y-1/2 visible opacity-0 group-hover:opacity-100 text-shadow-2">
                                        <i class="fas fa-arrow-right text-4xl"></i><br>
                                        <p class="text-sm"><strong>DETAILS</strong></p>
                                    </div>
                                </div>
                                <div
                                    x-ref="back"
                                    class="back border-2 border-drumeo absolute z-40 overflow-hidden rounded-xl w-full h-full transition-transform duration-700 -rotate-y-180"
                                    style="backface-visibility: hidden;"
                                >
                                    <div class="w-full h-full mx-auto text-center text-white flex flex-wrap justify-center items-center content-center p-2 md:p-3" style="background:linear-gradient(to bottom, #01050f, #021225);">
                                        <p class="leading-normal mx-auto text-sm">{!! $bonus['description'] !!}</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <p class="w-full leading-normal mt-2">
                            <span style="text-transform:uppercase; display:inline-block;">
                            @if(!empty($bonus['price']))
                                    <s class="opacity-40">${{ $bonus['price'] }}</s>
                                @endif
                                @if(!empty($bonus['customText']))
                                    <strong class="text-musora">{{ $bonus['customText'] }}</strong>
                                @else
                                    <strong class="text-musora">FREE</strong>
                                @endif
                                <br>
                               <em>
                                    @if(!empty($bonus['shipping']))
                                        Free Bonus
                                    @elseif(!empty($bonus['customSubText']))
                                        Save {{$savePercentage}}%
                                    @else
                                        Lifetime Access
                                    @endif
                                </em>
                            </span>
                        </p>
                    </div>
                @endforeach
            </div>

            <h3 class="leading-tight mt-6 mb-1">
                <s class="opacity-50">$748</s>
                <strong>$200</strong>
            </h3>
            <p class="text-sm mb-4 sm:mb-6">For your first year, then ${{ 240 }}/yr.</p>
            <a role="link" aria-label=" Get Started" class="join {{ $theme }} mb-4 md:mb-5 w-full max-w-xs md:max-w-lg lg:max-w-3xl" style="padding: 20px 10px;"
                href="/ecommerce/add-to-cart?products[DLM-1-year]=1&products[30-day-drummer-4]=1&products[30-day-chops]=1&products[30-day-independence]=1&products[30-day-double-bass]=1&promo-code=special&locked=true">
                    CLICK HERE TO GET Started &raquo;
            </a>
        </div>
    </section>
@endsection



