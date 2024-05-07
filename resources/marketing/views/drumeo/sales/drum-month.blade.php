@php
    require_once(resource_path('marketing/views/drumeo/_partials/homepage-data.php'));
@endphp
@extends('drumeo.sales.subscription', [
    "promoVersion" => true,
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
        $bubbles =  [
             [
                 'src' => 'https://d21q7xesnoiieh.cloudfront.net/fit-in/130x0/filters:quality(95)/marketing/drumeo/promos/may/todd.webp',
                 'classes' => 'h-10 sm:h-14 lg:h-16 top-[53%] sm:top-[53%] left-[4%] sm:left-[4%]',
             ],
             [
                 'src' => 'https://d21q7xesnoiieh.cloudfront.net/fit-in/350x0/filters:quality(95)/marketing/drumeo/promos/may/easy-rudiments.webp',
                 'classes' => 'h-24 sm:h-28 lg:h-44 top-[13%] sm:top-[21%] left-[8%] sm:left-[10%]',
             ],
             [
                 'src' => 'https://d21q7xesnoiieh.cloudfront.net/fit-in/380x0/filters:quality(95)/marketing/drumeo/promos/may/stick-bag.webp',
                 'classes' => 'h-32 sm:h-40 lg:h-52 top-[84%] sm:top-[81%] left-[9%] sm:left-[18%]',
             ],
             [
                 'src' => 'https://d21q7xesnoiieh.cloudfront.net/fit-in/130x0/filters:quality(95)/marketing/drumeo/promos/may/bruce.webp',
                 'classes' => 'h-10 sm:h-12 lg:h-16 top-[13%] sm:top-[13%] left-[31%] sm:left-[31%]',
             ],
             [
                 'src' => 'https://d21q7xesnoiieh.cloudfront.net/fit-in/130x0/filters:quality(95)/marketing/drumeo/promos/may/jared.webp',
                 'classes' => 'h-10 sm:h-12 lg:h-16 top-[8%] sm:top-[8%] left-[58%] sm:left-[58%]',
             ],
             [
                 'src' => 'https://d21q7xesnoiieh.cloudfront.net/fit-in/340x0/filters:quality(95)/marketing/drumeo/promos/may/drum-key.webp',
                 'classes' => 'h-28 sm:h-32 lg:h-48 top-[88%] sm:top-[88%] left-[90%] sm:left-[78%]',
             ],
             [
                 'src' => 'https://d21q7xesnoiieh.cloudfront.net/fit-in/370x0/filters:quality(95)/marketing/drumeo/promos/may/free-shipping.webp',
                 'classes' => 'h-28 sm:h-36 lg:h-52 top-[13%] sm:top-[18%] left-[93%] sm:left-[87%]',
             ],
             [
                 'src' => 'https://d21q7xesnoiieh.cloudfront.net/fit-in/130x0/filters:quality(95)/marketing/drumeo/promos/may/sticks.webp',
                 'classes' => 'h-12 sm:h-14 lg:h-16 top-[63%] sm:top-[63%] left-[99%] sm:left-[99%]',
             ]
         ];
        $slides = $drumeo['slides'];
    @endphp
    <header class="text-center px-5 sm:px-6 py-44 sm:py-52 lg:py-56 relative overflow-hidden text-white"
        style="background:linear-gradient(45deg, #6403b5, #0c74da);">
        <div class="container max-w-6xl mx-auto relative z-20">
            <img class="h-28 mb-3 sm:mb-4" src="https://d21q7xesnoiieh.cloudfront.net/fit-in/510x0/filters:quality(95)/marketing/drumeo/promos/may/logo.webp">
            <br>
            <h1 class="relative w-auto inline-block mb-7 sm:mb-10">
                Get 1 year of unlimited drum lessons<br>
                <strong class="text-[#0BDBB6]">+ $794.95 in FREE bonuses.</strong></h1>

            <p class="text-sm leading-normal sm:tracking-widest mb-5 lg:mb-7">
                <i class="fas fa-check text-[#0BDBB6]"></i> STICKBAG
                <i class="fas fa-check ml-3 sm:ml-5 text-[#0BDBB6]"></i> DRUMSTICKS
                <br class="lg:hidden">
                <i class="fas fa-check lg:ml-5 text-[#0BDBB6]"></i> DRUM KEY
                <i class="fas fa-check ml-3 sm:ml-5 text-[#0BDBB6]"></i> RUDIMENTS BOOK
            </p>
            <div class="flex flex-wrap justify-center max-w-xs sm:max-w-full mx-auto px-5 sm:px-0">
                <a class="sm:mx-0.5 w-full sm:w-56 join text-black smaller sm:order-1 mb-2 sm:mb-0 anchor-slide"
                    href="#customize-anchor" aria-label="Customize anchor" style="background-color:#0BDBB6;"
                >SEE YOUR DEAL <i class="fas fa-arrow-right" style="line-height: 0;" aria-hidden="true"></i></a>
                <div class="sm:mx-0.5 w-full sm:w-56 join outline white smaller autoplay-video" x-on:click="trailer = true;">WATCH THE TRAILER</div>
            </div>
            <div class="flex flex-wrap items-center justify-center mt-2 sm:mt-3 mx-auto">
                <a aria-label="Review" class="inline-block" href="https://www.shopperapproved.com/reviews/Musora.com" target="_blank" rel="noopener noreferrer" onclick="window.open('https://www.shopperapproved.com/reviews/Musora.com', 'newwindow', 'width=750, height=550'); return false;">
                    <i class="align-middle text-lg fas fa-star" style="color: #ffac00;" aria-hidden="true"></i>
                    <i class="align-middle text-lg -ml-4 fas fa-star" style="text-shadow: -2px -1px 1px #432cc2;color: #ffac00;" aria-hidden="true"></i>
                    <i class="align-middle text-lg -ml-4 fas fa-star" style="text-shadow: -2px -1px 1px #432cc2;color: #ffac00;" aria-hidden="true"></i>
                    <i class="align-middle text-lg -ml-4 fas fa-star" style="text-shadow: -2px -1px 1px #432cc2;color: #ffac00;" aria-hidden="true"></i>
                    <i class="align-middle text-lg -ml-4 fas fa-star" style="text-shadow: -2px -1px 1px #432cc2;color: #ffac00;" aria-hidden="true"></i>
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
        style="background:linear-gradient(to right, #6403b5, #0c74da);">
        <div class="container mx-auto relative z-50  max-w-4xl ">
            <div class="w-full">
                <div class="bonus-wrap relative inline-block align-top mx-auto px-1 md:px-3 w-full max-w-lg">
                    <div class=" inline-block relative w-full group" style="padding-bottom: 45%;perspective: 1000px;">
                        <div class="text-center w-full h-full absolute" style="transform-style: preserve-3d;">
                            <div class=" front absolute z-20 overflow-hidden rounded-3xl w-full h-full transition-transform duration-700" style="backface-visibility: hidden;">
                                <picture class="h-full w-full bg-top bg-cover opacity-100" :class="{'opacity-0': !lazyLoad, 'opacity-100': lazyLoad}" x-intersect.once="lazyLoad = true">
                                    <source srcset="https://d21q7xesnoiieh.cloudfront.net/fit-in/980x0/filters:quality(95)/marketing/drumeo/membership/homepage/2024/drumeo-annual-2w-card.webp" media="(min-width: 640px)">
                                    <img src="https://d21q7xesnoiieh.cloudfront.net/fit-in/600x0/filters:quality(95)/marketing/drumeo/membership/homepage/2024/drumeo-annual-2w-card.webp" alt="Top Image" class="w-full h-full object-cover transition-opacity" loading="lazy" onload="this.classList.remove('opacity-0')">
                                </picture>
                            </div>
                        </div>
                    </div>
                </div>
                <br>
                <h3 class="leading-tight mt-4 sm:mt-5 mb-2">Get 1 year of unlimited drum lessons<br>
                    <span class="text-[#0BDBB6]">+ a loaded StickBag, lesson packs, and more!</span></h3>
                <a class="join  text-black my-4 md:my-6 w-full max-w-xs md:max-w-lg lg:max-w-xl" style="background-color:#0BDBB6; padding: 20px 10px;" href="/ecommerce/add-to-cart?products[DLM-1-year]=1&products[stickbag]=1&products[Drumeo-VaterSticks]=1&products[Drumeo-Key]=1&products[easy-rudiments-book]=1&products[drum-technique-made-easy-pack]=1&products[rock-drumming-masterclass-pack]=1&products[independence-made-easy-pack]=1&locked=true&promo-code=special" aria-label="Get Started">
                    GET Started »
                </a>
                <p class="leading-tight text-sm mb-6"><em>First year discount: <s class="opacity-40">$240</s>
                        <strong> $200</strong>.
                        <br class="inline sm:hidden"> Cancel anytime. 90-day guarantee.</em></p>
            </div>

            @php
                $bonuses = [
                    [
                    'image' => 'todo',
                    'title' => 'Drumeo StickBag',
                    'description' => 'A StickBag you’ll want to show your friends.',
                    'price' => floatval($productPrices['stickbag']->price),
                    'shipping' => true,
                    ],
                    [
                    'image' => 'marketing/drumeo/membership/homepage/2024/drumsticks.webp',
                    'title' => 'Drumeo Drumsticks',
                    'description' => 'Drumeo 5A Drumsticks by Vater — made with hickory and extra moisture to last longer.',
                    'price' => floatval($productPrices['Drumeo-VaterSticks']->price),
                    'shipping' => true,
                    ],
                    [
                    'image' => 'todo',
                    'title' => 'Drumeo Drum Key',
                    'description' => 'The Drumeo DrumKey sits perfectly in your hand with an ergonomic design and flared handle to help you tighten the most stubborn lugs.',
                    'price' => floatval($productPrices['Drumeo-Key']->price),
                    'shipping' => true,
                    ],
                    [
                    'image' => 'todo',
                    'title' => 'Easy Rudiments Book',
                    'description' => 'The 15 Rudiments You Actually Need To Know (And How To Learn Them Quickly)',
                    'price' => floatval($productPrices['easy-rudiments-book']->price),
                    'shipping' => true,
                    ],
                    [
                    'image' => 'marketing/drumeo/membership/homepage/2024/rdm.webp',
                    'title' => 'Rock Drumming Masterclass',
                    'description' => 'Todd Sucherman’s 26-week masterclass to help you improve your rock drumming.',
                    'price' => floatval($productPrices['rock-drumming-masterclass-pack']->price),
                    ],
                    [
                    'image' => 'marketing/drumeo/membership/homepage/2024/dtme.webp',
                    'title' => 'Drum Technique Made Easy',
                    'description' => 'Bruce Becker’s 26-week masterclass to improve your hand & foot technique.',
                    'price' => floatval($productPrices['drum-technique-made-easy-pack']->price),
                    ],
                    [
                    'image' => 'marketing/drumeo/membership/homepage/2024/ime.webp',
                    'title' => 'Independence Made Easy',
                    'description' => 'Jared Falk’s 26-week masterclass to unlock your musicality and freedom on the drums.',
                    'price' => floatval($productPrices['independence-made-easy-pack']->price),
                    ],
                ];
            @endphp
            <div style="font-size:0px">
                @foreach($bonuses as $bonus)
                    <div
                        class="bonus-wrap relative inline-block align-top mx-auto mb-4 px-1 md:px-3 @if(!empty($bonusWidth)) {{ $bonusWidth }} @else w-1/2 md:w-1/4 @endif"
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
                                    class="border-2 border-[#0BDBB6] front absolute z-20 overflow-hidden rounded-xl w-full h-full transition-transform duration-700"
                                    style="@if(!empty($bonus['special'])) overflow: visible;border-color: #cda880; @endif backface-visibility: hidden;">
                                    @if(!empty($bonus['badge']))
                                        <h6 class="absolute text-white top-0 left-0 w-full py-0.5 bg-{{ $theme }} font-bebas uppercase">{{ $bonus['badge'] }}</h6>
                                    @endif
                                    <div class="overflow-hidden h-full w-full bg-black bg-top bg-cover"
                                        :class="{'opacity-0': !lazyLoad, 'opacity-100': lazyLoad}"
                                        x-intersect.once="lazyLoad = true">
                                        <picture class="absolute inset-0 w-full h-full object-cover">
                                            <source srcset="https://d21q7xesnoiieh.cloudfront.net/fit-in/980x0/filters:quality(95)/{{ $bonus['image'] }}"
                                                media="(min-width: 640px)">
                                            <img src="https://d21q7xesnoiieh.cloudfront.net/fit-in/420x0/filters:quality(95)/{{ $bonus['image'] }}"
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
                                    class="back border-2 border-[#0BDBB6] absolute z-40 overflow-hidden rounded-xl w-full h-full transition-transform duration-700 -rotate-y-180"
                                    style="backface-visibility: hidden;"
                                >
                                    <div class="w-full h-full mx-auto text-center text-white flex flex-wrap justify-center items-center content-center p-2 md:p-3" style="background:linear-gradient(to bottom, #01050f, #021225);">
                                        <p class="leading-normal mx-auto text-sm">{!! $bonus['description'] !!}</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <p class="w-full leading-normal mt-2">
                            @if(!empty($bonus['title']))
                                <strong class="font-black leading-tight inline-block mb-1">{!!  $bonus['title']  !!}</strong><br>
                            @endif
                            <span style="text-transform:uppercase; display:inline-block;">
                            @if(!empty($bonus['price']))
                                    <s class="opacity-40">${{ $bonus['price'] }}</s>
                                @endif
                                @if(!empty($bonus['customText']))
                                    <strong class="text-[#0BDBB6]">{{ $bonus['customText'] }}</strong>
                                @else
                                    <strong class="text-[#0BDBB6]">FREE</strong>
                                @endif
                                <br>
                                <em>
                                    @if(!empty($bonus['shipping']))
                                        Free Shipping
                                    @else
                                        Online Access
                                    @endif
                                </em>
                            </span>
                        </p>
                    </div>
                @endforeach
            </div>
            <h3 class="leading-tight mt-6 mb-1">
                <s class="opacity-50">$240</s>
                <strong>$200</strong> <span class="text-[#0BDBB6]">(Save 20%)</span>
            </h3>
            <p class="text-sm mb-4 sm:mb-6">For your first year, then $240/yr.</p>
            <a role="link" aria-label=" Get Started" class="join  text-black  mb-4 md:mb-5 w-full max-w-xs md:max-w-lg lg:max-w-3xl" style="background-color:#0BDBB6;padding: 20px 10px;" href="/ecommerce/add-to-cart?products[DLM-1-year]=1&products[stickbag]=1&products[Drumeo-VaterSticks]=1&products[Drumeo-Key]=1&products[easy-rudiments-book]=1&products[drum-technique-made-easy-pack]=1&products[rock-drumming-masterclass-pack]=1&products[independence-made-easy-pack]=1&locked=true&promo-code=special">
                GET Started »
            </a>
            <br>
            <a role="link" class="inline-block mt-2" aria-label="Start a monthly membership" href="/ecommerce/add-to-cart?products[DLM-1-year]=1&products[drum-technique-made-easy-pack]=1&products[rock-drumming-masterclass-pack]=1&products[independence-made-easy-pack]=1&locked=true&promo-code=special">
                <p><u><em>Trying to avoid VAT fees on physical items? Click here to just grab<br>  your discounted membership + 3 free digital lesson packs.</em></u></p></a>
        </div>
    </section>
@endsection



