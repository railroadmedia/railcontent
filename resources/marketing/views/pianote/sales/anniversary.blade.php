@extends('pianote.sales.subscription', [
    "promoVersion" => true,
    "hideHeader" => true,
])

@section('promo-banner')
    <header class="text-center px-5 sm:px-6 py-10 sm:py-14 lg:py-16 relative overflow-hidden"
            style="background:linear-gradient(to right, #e0ecf9, #f6f8fc, #f6f8fc, #e0ecf9);"
    >
        <div class="container max-w-6xl mx-auto relative z-20">
            <img class="sm:hidden inline-block h-24 " src="https://d21q7xesnoiieh.cloudfront.net/fit-in/400x0/filters:quality(95)/marketing/pianote/promos/march/8-anniversary-logo-black-m.webp" alt="30 day drummer logo" />
            <img class="hidden sm:inline-block sm:h-20 lg:h-24" src="https://d21q7xesnoiieh.cloudfront.net/fit-in/960x0/filters:quality(95)/marketing/pianote/promos/march/8-anniversary-logo-black.webp" alt="30 day drummer logo" />
            <p class="leading-tight my-5 lg:my-7">
                Get legacy pricing on your first year <strong>OR</strong> 8 free bonuses with your membership <em class="text-pianote">(worth $987)</em>
                @if(Carbon\Carbon::create(2024, 3, 22, 0, 0, 0, 'America/Vancouver') < Carbon\Carbon::now())
                    <br>
                    <em class="font-black uppercase inline-block mt-2 text-{{ $theme }}">
                        Only
                        <span x-cloak x-data="timer()" x-init="countdown()">
                             <span x-cloak x-show="timeLeft > 0 && day > 0"><span x-text="day"></span><span x-text="dayText"></span></span>
                             <span x-cloak x-show="timeLeft > 0 && hour > 0"><span x-text="hour"></span><span x-text="hourText"></span></span>
                             <span x-cloak x-show="timeLeft > 0"><span x-text="minute"></span><span x-text="minuteText"></span></span>
                             <span x-cloak x-show="timeLeft > 0 && day < 7"><span x-text="second"></span><span x-text="secondText"></span></span>
                             <span x-cloak x-show="timeLeft < 0">A Limited Time</span>
                         </span>
                        left
                    </em>
                @endif
            </p>
            <img class="sm:hidden inline-block h-52 " src="https://d21q7xesnoiieh.cloudfront.net/fit-in/690x0/filters:quality(95)/marketing/pianote/promos/march/bundle-header-m.webp" alt="30 day drummer logo" />
            <img class="hidden sm:inline-block sm:h-44 lg:h-64" src="https://d21q7xesnoiieh.cloudfront.net/fit-in/1810x0/filters:quality(95)/marketing/pianote/promos/march/bundle-header.webp" alt="30 day drummer logo" />
            <div class="flex flex-wrap justify-center max-w-xs sm:max-w-full mx-auto px-5 sm:px-0 mt-5 lg:mt-7">
                <a class="sm:mx-0.5 w-full sm:w-56 join {{ $theme }} smaller sm:order-1 mb-2 sm:mb-0 @if(!empty($promoVersion)) anchor-slide @endif"
                        href="#customize-anchor" aria-label="Customize anchor"
                >Get Started <i class="fas fa-arrow-right" style="line-height: 0;" aria-hidden="true"></i></a>
                @if(empty($noTrailer))
                    <div class="sm:mx-0.5 w-auto sm:w-56 join outline black smaller autoplay-video" x-on:click="trailer = true;">WATCH THE TRAILER</div>
                @endif
            </div>
            <div class="flex flex-wrap items-center justify-center mt-2 sm:mt-3 mx-auto">
                <a aria-label="Review" class="inline-block" href="https://www.shopperapproved.com/reviews/Musora.com" target="_blank" rel="noopener noreferrer" onclick="window.open('https://www.shopperapproved.com/reviews/Musora.com', 'newwindow', 'width=750, height=550'); return false;">
                    <i class="align-middle text-lg fas fa-star" style="color: #ffac00;" aria-hidden="true"></i>
                    <i class="align-middle text-lg -ml-4 fas fa-star" style="text-shadow: -2px -1px 1px #f6f8fc;color: #ffac00;" aria-hidden="true"></i>
                    <i class="align-middle text-lg -ml-4 fas fa-star" style="text-shadow: -2px -1px 1px #f6f8fc;color: #ffac00;" aria-hidden="true"></i>
                    <i class="align-middle text-lg -ml-4 fas fa-star" style="text-shadow: -2px -1px 1px #f6f8fc;color: #ffac00;" aria-hidden="true"></i>
                    <i class="align-middle text-lg -ml-4 fas fa-star" style="text-shadow: -2px -1px 1px #f6f8fc;color: #ffac00;" aria-hidden="true"></i>
                </a>
                <p class="inline-block leading-tight text-xs align-middle pl-1 m-0"><em>Trusted by {{ number_format(Prices::$students) }} active students.</em></p>
            </div>
        </div>
    </header>
    <section class="text-center px-5 sm:px-6 py-10 sm:py-12 lg:py-14 text-white relative" style="background: #0C1524;">
        <div class="container max-w-6xl mx-auto">
            <div class="text-left flex flex-wrap sm:flex-nowrap justify-center items-start">
                <img class="h-56 lg:h-80 sm:order-1 transition-opacity opacity-0"
                    loading="lazy"
                    onload="this.classList.remove('opacity-0')"
                    src="https://d21q7xesnoiieh.cloudfront.net/fit-in/920x0/filters:quality(95)/marketing/pianote/promos/march/timeline2.webp"

                    alt="learn playing image"
                >
                <div class="sm:pr-5 lg:pr-8 mx-0 mt-5 sm:mt-0">
                    <h3 class="mb-4"><strong>Time flies when you’re <span class="text-pianote">changing the world.</span></strong></h3>
                    <p class="leading-normal max-w-xl">
                        This month we’re celebrating 8 years since Pianote began its mission of spreading the joy of music across the globe. 
                        <br><br>
                        Join Pianote today and get 8 FREE bonuses (including our NEW Pianote BookBag).
                        <br><br>
                        Or save big with legacy pricing on your first year of lessons.
                        <br><br>
                        Scroll down to see everything that’s included -- and why Pianote is the best way to learn the piano online.
                        <br>
                        <a class="join smaller my-3 w-1/2 anchor-slide" href="#customize-anchor">See Details &raquo;</a>
                        <br>
                        <em>Free worldwide shipping!</em>
                    </p>

                </div>
            </div>
        </div>
    </section>

    <div class="sticky-trigger block"></div>
    <a href="#customize-anchor"
        class="promo-banner flex items-center justify-center -mt-12 py-0.5 px-2 sm:px-0 w-full z-[100] transition-none anchor-slide"style="background: #CFDDF9;">
        <img class="h-8 sm:h-10 mr-3" src="https://d21q7xesnoiieh.cloudfront.net/fit-in/210x0/filters:quality(95)/marketing/pianote/promos/march/8-anniversary-sticky-logo.webp" alt="30 day drummer logo" />
        <p class="inline-block text-xs mx-0 leading-tight">
            Celebrate <strong>8 years of Pianote </strong> with
            <br>8 FREE bonuses 🥳 <em>(worth $987)</em>
        </p>
    </a>
    @php
        require_once(resource_path('marketing/views/pianote/_partials/homepage-data.php'));
        $slides = $pianote['slides'];
    @endphp
    @if(!empty($slides))
        <section class="sm:px-6 py-4 sm:py-5 text-white" style="background:#0c1524;">
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
    @endif
@endsection
@section('promoDetails')
    <section class="text-center px-4 sm:px-6 py-8 sm:py-16 lg:py-20 relative" style="background-color:#F6F8FC;">
        <div class="container mx-auto z-10 relative max-w-5xl">
            <p class="leading-tight"><em>Introducing the <strong class="text-pianote font-black">NEW…</strong></em></p>
            <img alt="pianote logo block center" class="h-20 sm:h-24 md:h-26 lg:h-30 my-4" src="https://d21q7xesnoiieh.cloudfront.net/fit-in/440x0/filters:quality(95)/marketing/pianote/products/book-bag/pianote-bookbag-logo-black.svg">
            <p class="leading-tight mb-7">A handcrafted premium leather satchel for your music books, laptop, and life.</p>

            @php
                $gridItems = [
                    [
                        'img' => 'marketing/pianote/products/book-bag/tanned.webp',
                        'desc' => '<strong>Single leather handle</strong> provide easy carrying options and minimalistic styling.',
                    ],
                    [
                        'img' => 'marketing/pianote/products/book-bag/back-pockets.webp',
                        'desc' => '<strong>External side and back</strong> pockets <br/>for easy access and extra security.',
                    ],
                    [
                        'img' => 'marketing/pianote/products/book-bag/handle.webp',
                        'desc' => '<strong>Premium-grade, oil-tanned leather</strong> ensures a classic look that only gets better with age.',
                    ],
                    [
                        'img' => 'marketing/pianote/products/book-bag/sleeve.webp',
                        'desc' => '<strong>16-inch laptop sleeve </strong> <br/>keeps your computer safe.',
                    ],
                    [
                        'img' => 'marketing/pianote/products/book-bag/emobssed.webp',
                        'desc' => '<strong>Custom Pianote embossing</strong> provides a subtle yet distinctive look. This bag is for piano players.',
                    ],
                    [
                        'img' => 'marketing/pianote/products/book-bag/magnetic-clasps.webp',
                        'desc' => '<strong>Magnetic clasps</strong> give you modern access while keeping  a vintage buckle look.',
                    ],
                    [
                        'img' => 'marketing/pianote/products/book-bag/removable.webp',
                        'desc' => '<strong>Removable shoulder strap</strong> for convenience and comfort.',
                    ],
                ];
            @endphp
            <div class="hidden lg:block">
                <div class="flex flex-wrap items-center justify-around text-left">
                    <div class="w-auto max-w-xs">
                        <p class="leading-normal">{!! $gridItems[0]['desc'] !!}</p>
                    </div>
                    <div class="w-auto max-w-xs">
                        <p class="leading-normal">{!! $gridItems[1]['desc'] !!}</p>
                    </div>
                    <div class="w-full flex justify-center content-around py-3">
                        <div class="w-auto max-w-xs py-12 flex flex-wrap content-around">
                            <div class="">
                                <p class="leading-normal">{!! $gridItems[2]['desc'] !!}</p>
                            </div>
                            <div class="">
                                <p class="leading-normal">{!! $gridItems[3]['desc'] !!}</p>
                            </div>
                        </div>
                        <div class="w-7/12 flex-shrink-0">
                            <img src="https://d21q7xesnoiieh.cloudfront.net/fit-in/1500x0/filters:quality(95)/marketing/pianote/products/book-bag/bag-graph.webp">
                        </div>
                        <div class="w-auto max-w-xs flex flex-wrap content-around">
                            <div class="">
                                <p class="leading-normal">{!! $gridItems[4]['desc'] !!}</p>
                            </div>
                        </div>
                    </div>
                    <div class="w-auto max-w-xs">
                        <p class="leading-normal">{!! $gridItems[5]['desc'] !!}</p>
                    </div>
                    <div class="w-auto max-w-xs">
                        <p class="leading-normal">{!! $gridItems[6]['desc'] !!}</p>
                    </div>
                </div>
            </div>
            <div class="lg:hidden mb-5"
                x-data="{
            init() {
                new Splide(this.$refs.splide, {
                    classes: {
                        arrow: 'hidden',
                        prev: 'hidden',
                        next: 'hidden',
                        pagination: 'splide__pagination bottom-0',
                    },
                    perPage: 2.5,
                    perMove: 1,
                    type: 'loop',
                    focus: 0,
                    interval: 2000,
                    drag: 'free',
                    snap: false,
                    lazyLoad: 'nearby',
                    breakpoints: {
                        767: {
                            perPage: 1.5,
                        },
                    },
                }).mount()
            },
        }">
                <div x-ref="splide" class="splide text-left">
                    <div class="splide__track pb-8">
                        <ul class="splide__list items-start">

                            @foreach ($gridItems as $gridItem)
                                <li class="splide__slide px-1">
                                    <div class="rounded-xl overflow-hidden shadow-md" style="background-color:#F1EFED;">
                                        <div class="relative" style="padding-bottom:71%;">
                                            <img class="absolute object-cover h-full w-full transition-opacity opacity-1"
                                                loading="lazy" onload="this.classList.remove('opacity-0')" alt="Pianote BookBag Details"
                                                src="https://d21q7xesnoiieh.cloudfront.net/fit-in/1000x0/filters:quality(95)/{{ $gridItem['img'] }}">
                                        </div>
                                        <div class="flex items-start justify-start h-28">
                                            <p class="text-base leading-wide font-playfair m-0 px-6 py-4">
                                                {!! $gridItem['desc'] !!}</p>
                                        </div>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>

            <a class="sm:mx-0.5 w-full sm:w-56 join {{ $theme }} smaller sm:order-1 mt-7 mb-3 @if(!empty($promoVersion)) anchor-slide @endif"
                href="#customize-anchor" aria-label="Customize anchor"
            >Get Started <i class="fas fa-arrow-right" style="line-height: 0;" aria-hidden="true"></i></a>
            <p class="leading-tight"><em>Get yours FREE when you join Pianote.</em></p>
        </div>
    </section>

@endsection
@section('final')
        @include('musora.sales.components.order-promo-cards-section', [
        // general
        'logoM' => "pianote/promos/march/8-anniversary-logo-white-m.webp",
        'logo' => "pianote/promos/march/8-anniversary-logo-white.webp",
        'promoText' => 'Get legacy pricing on your first year <strong>OR</strong> 8 free bonuses with your membership <em class="text-pianote">(worth $987)</em>',
        'buttonText' => "GET STARTED",

        // first deal
        'firstDeal'=> "Legacy Pricing",
        'firstDealImage' => 'https://d21q7xesnoiieh.cloudfront.net/fit-in/550x0/filters:quality(95)/marketing/pianote/promos/march/order-membership.webp',
        'firstImageHeight' => 'h-20 sm:h-16 lg:h-24',
        'firstDealPrice' => 197,
        'firstDealDiscount' => 240,
        'firstDealSub' => "Save 18% on your first year. No bonuses.",
        "firstDealLink" => "/ecommerce/add-to-cart?products[PIANOTE-MEMBERSHIP-1-YEAR]=1&promo-code=legacy&locked=true",
        'firstExtraBonuses' => [
            'Celebrate 8 years of Pianote by rolling back the price of your first year.',
            '<strong class=""><i class="fa-solid fa-check pr-1"></i> Learn</strong>',
            '<strong class=""><i class="fa-solid fa-check pr-1"></i> Practice</strong>',
            '<strong class=""><i class="fa-solid fa-check pr-1"></i> Play</strong>',
    ],

        // second deal
        'topBadge' => "BEST DEAL",
        'secondDeal' => "Anniversary Bundle",
        'secondDealImage' => 'https://d21q7xesnoiieh.cloudfront.net/fit-in/550x0/filters:quality(95)/marketing/pianote/promos/march/anniversary-bundle-order.webp',
        'secondImageHeight' => 'h-20 sm:h-16 lg:h-24',
        'secondDealSub' => "Join Pianote + get 8 bonuses worth $987.",
        'secondDealPrice' => 240,
        'secondDealDiscount' => 1227,
        "secondDealLink" => "/ecommerce/add-to-cart?products[PIANOTE-MEMBERSHIP-1-YEAR]=1&products[pianote-book-bag]=1&products[piano-chords-and-scales-guide]=1&products[new-piano-players-start-here]=1&products[easy-chords]=1&products[30-day-blues-piano]=1&products[piano-riffs-and-fills]=1&products[worship-piano]=1&products[piano-technique-made-easy]=1&redirect=/order&locked=true",
        'secondExtraBonuses' => [
            '<i class="fa-solid fa-check pr-1 text-musora"></i> <strong>Annual Pianote Membership </strong>',
            '<i class="fa-solid fa-check pr-1 text-musora"></i> Pianote BookBag ($249 value)',
            '<i class="fa-solid fa-check pr-1 text-musora"></i> Chords & Scales Book ($39 value)',
            '<i class="fa-solid fa-check pr-1 text-musora"></i> New Piano Players Start Here ($127 value)',
            '<i class="fa-solid fa-check pr-1 text-musora"></i> Easy Chords ($127 value)',
            '<i class="fa-solid fa-check pr-1 text-musora"></i> 30-Day Blues ($127 value)',
            '<i class="fa-solid fa-check pr-1 text-musora"></i> Piano Riffs & Fills ($99 value)',
            '<i class="fa-solid fa-check pr-1 text-musora"></i> Worship Piano ($99 value)',
            '<i class="fa-solid fa-check pr-1 text-musora"></i> Piano Technique Made Easy ($120 value)',
    ],

        // third deal
        'thirdDeal' => "Lifetime Bundle",
        'thirdDealImage' => 'https://d21q7xesnoiieh.cloudfront.net/fit-in/550x0/filters:quality(95)/marketing/pianote/promos/march/lifetime-bundle-order.webp',
        'thirdImageHeight' => 'h-20 sm:h-16 lg:h-24',
        'thirdDealSub' => "Limited quantity. ",
        'thirdDealPrice' => 1200,
        "thirdDealLink" => "/ecommerce/add-to-cart?products[PIANOTE-MEMBERSHIP-LIFETIME]=1&products[maelzel-metronome]=1&products[pianote-book-bag]=1&products[pianote-practice-planner]=1&products[piano-chords-and-scales-guide]=1&redirect=/order&locked=true&promo-code=FREE-W-LIFETIME-849",
        'thirdExtraBonuses' => [
            '<i class="fa-solid fa-check pr-1"></i> <strong> Lifetime Membership </strong>',
            '<i class="fa-solid fa-check pr-1"></i> Pianote BookBag ($249 value)',
            '<i class="fa-solid fa-check pr-1"></i> Prestige Metronome ($299 value)',
            '<i class="fa-solid fa-check pr-1"></i> Chords & Scales Book ($39 value)',
            '<i class="fa-solid fa-check pr-1"></i> Practice Planner ($39 value)',
    ],
])
@endsection

@section('scripts')
    @include('_partials.components.countdown',[
        'countdownDate' => '2024-04-1 00:00:00',
        'promoVersion' => false
    ])
    <script type="application/javascript">
        document.addEventListener('DOMContentLoaded', function () {
            var stickyBar = document.querySelector('.promo-banner');
            window.addEventListener('scroll', function () {
                var stickTrigger = document.querySelector('.sticky-trigger').offsetTop;
                var unstickTrigger = document.querySelector('.unstick-trigger').offsetTop;
                if (window.scrollY > (unstickTrigger - 115)) {
                    stickyBar.classList.remove('fixed', 'mt-0');
                }
                if (window.scrollY < stickTrigger - 115) {
                    stickyBar.classList.remove('fixed', 'mt-0');
                }
                if (window.scrollY < unstickTrigger - 115 && window.scrollY > stickTrigger - 115) {
                    stickyBar.classList.add('fixed', 'mt-0');
                }
            });
        });
    </script>
@endsection
