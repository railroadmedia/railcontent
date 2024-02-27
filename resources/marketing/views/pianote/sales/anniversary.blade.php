@extends('pianote.sales.subscription', [
    "promoVersion" => true,
    "hideHeader" => true,
])

@section('promo-banner')
    <header class="text-center px-5 sm:px-6 py-44 sm:py-52 lg:py-56 relative overflow-hidden"
            style="background:linear-gradient(to right, #e0ecf9, #f6f8fc, #f6f8fc, #e0ecf9);"
    >
        <div class="container max-w-6xl mx-auto relative z-20">

            <h5 class="leading-tight uppercase mb-5 lg:mb-7 tracking-wide">Get legacy pricing on your first year OR 8 free bonuses with your membership (worth $987).</h5>
            <div class="flex flex-wrap justify-center max-w-xs sm:max-w-full mx-auto px-5 sm:px-0">
                <a class="sm:mx-0.5 w-full sm:w-56 join {{ $theme }} smaller sm:order-1 mb-2 sm:mb-0 @if(!empty($promoVersion)) anchor-slide @endif"
                        href="#customize-anchor" aria-label="Customize anchor"
                >Get Started <i class="fas fa-arrow-right" style="line-height: 0;" aria-hidden="true"></i></a>
                @if(empty($noTrailer))
                    <div class="sm:mx-0.5 w-full sm:w-56 join outline black smaller autoplay-video" x-on:click="trailer = true;">WATCH THE TRAILER</div>
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

    <section class="text-center px-5 sm:px-6 py-10 sm:py-12 lg:py-14 text-white relative" style="background: #0C1524;">
        <div class="container max-w-6xl mx-auto">
            <div class="text-left flex flex-wrap sm:flex-nowrap justify-center items-start mb-5">
                <div class=" pr-5 lg:pr-8 mx-0">
                    <h4 class="mb-4"><strong>Time flies when you’re <span class="text-pianote">changing the world.</span></strong></h4>
                    <p class="leading-normal max-w-xl">
                        This month we’re celebrating 8 years since Pianote began its mission of spreading the joy of music across the globe. 
                        <br><br>
                        Join Pianote today and get 8 FREE bonuses (including our NEW Pianote Book Bag).
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
                <img class="h-72 lg:h-80 hidden sm:inline transition-opacity opacity-0"
                    loading="lazy"
                    onload="this.classList.remove('opacity-0')"
                    src="https://d21q7xesnoiieh.cloudfront.net/fit-in/690x0/filters:quality(95)/marketing/pianote/promos/march/timeline.webp"

                    alt="learn playing image"
                >
            </div>
        </div>
    </section>
    <div class="sticky-trigger block"></div>
    <a href="#customize-anchor"
        class="promo-banner flex items-center justify-center -mt-12 py-0.5 px-2 sm:px-0 w-full z-[100] transition-none anchor-slide"style="background: #CFDDF9;">
                <img class="h-8 sm:h-10 mr-3" src="https://d21q7xesnoiieh.cloudfront.net/fit-in/300x0/filters:quality(95)/marketing/pianote/promos/march/8-anniversary-sticky-logo.webp" alt="30 day drummer logo" />
        <p class="inline-block text-xs mx-0 leading-tight">
            Celebrate <strong>8 years of Pianote </strong> with
            <br>8 FREE bonuses 🥳 <em>(worth $987)</em>
        </p>
    </a>

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
                        'desc' => '<strong>External side and back</strong> pockets <br/>for easy access and extra security',
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
                                                loading="lazy" onload="this.classList.remove('opacity-0')" alt="Pianote Book Bag Details"
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
        </div>
    </section>

@endsection
@section('final')
    @php
        $originalPrice = 240;
        $discountedPrice = 200;
        $discountPercentage = 17;
        if(!empty($products['alesis-ekit'])) {
            $stock = $products['alesis-ekit']->getPublicStockCount();
        }
        else {
            $stock = 'A LIMITED AMOUNT';
        }
    @endphp

        @include('musora.sales.components.order-promo-cards-section', [
        // general
        "songs" => "6000+ popular songs.",
        'buttonText' => "ORDER NOW",
        'header' => '<span class="text-drumeo">EVERYTHING</span><br class="sm:hidden"> YOU NEED<br class="hidden sm:inline"> TO<br class="sm:hidden"> <span class="relative inline-block">LEARN THE DRUMS<svg class="absolute left-0 right-0 bottom-0 w-full h-4 sm:h-7" xmlns="http://www.w3.org/2000/svg" width="" height="" viewBox="0 0 524 22" fill="none" style="transform: translate(0, 100%);"><path d="M1.99978 10.6328C84.053 4.08508 302.889 -3.20824 521.809 20" stroke=" #0b76db " stroke-width="3" stroke-linecap="round"></path><path d="M2.17373 15.0541C83.9528 7.29382 302.406 -3.51921 521.988 15.3111" stroke=" #0b76db " stroke-width="3" stroke-linecap="round"></path></svg></span>.',
        'pointOne' => 'GREAT TEACHERS',
        'pointTwo' => 'VIDEO LESSONS',
        'pointThree' => 'FUN PRACTICE',
        'pointFour' => '6000+ SONGS',
        'badge' => 'https://d21q7xesnoiieh.cloudfront.net/filters:quality(95)/marketing/drumeo/membership/homepage/2024/drumeo-free-shipping.svg',

        // first deal
        'firstDeal'=> "Practice Anywhere",
        'firstDealImage' => 'https://d21q7xesnoiieh.cloudfront.net/fit-in/800x0/filters:quality(95)/marketing/drumeo/membership/homepage/2024/practice-anywhere-bundle.webp',
        'firstImageHeight' => 'h-44',
        'firstDealPrice' => $discountedPrice,
        'firstDealDiscount' => $originalPrice,
        'firstDealSub' => "Save " . round($discountPercentage) . "% on your first year.",
        "firstDealLink" => "/ecommerce/add-to-cart?products[DLM-1-year]=1&products[practicepad]=1&products[padstand]=1&products[Drumeo-VaterSticks]=1&products[30-day-drummer-3]=1&products[30-day-chops]=1&promo-code=special&locked=true",
        'firstExtraBonuses' => [
            '<i class="fa-solid fa-check pr-1 text-drumeo"></i> <strong>Annual Drumeo Membership </strong><span class="italic">($240 Value)',
            '<i class="fa-solid fa-check pr-1 text-drumeo"></i> P4 Practice Pad <span class="italic">($79 Value)</span>',
            '<i class="fa-solid fa-check pr-1 text-drumeo"></i> Drumeo PadStand <span class="italic">($79 Value)</span>',
            '<i class="fa-solid fa-check pr-1 text-drumeo"></i> 1 Pair of Drumeo Drumsticks <span class="italic">($12.95 Value)</span>',
            '<i class="fa-solid fa-check pr-1 text-drumeo"></i> 30-Day Drummer<span class="italic">($127 Value)</span>',
            '<i class="fa-solid fa-check pr-1 text-drumeo"></i> 30-Day Chops <span class="italic">($127 Value)</span>',
    ],

        // second deal
        'secondDeal' => "E-Kit + Lessons",
        'secondDealImage' => 'https://d21q7xesnoiieh.cloudfront.net/fit-in/800x0/filters:quality(95)/marketing/drumeo/membership/homepage/2024/ekit-bundle.webp',
        'secondImageHeight' => 'h-44',
        'secondDealSub' => "Everything you need to start playing the drums.",
        'secondDealPrice' => 499,
        'secondDealDiscount' => 1005.95,
        'secondTwoButtons' => 'see the kit',
        "secondDealLink" => "/ecommerce/add-to-cart?products[alesis-ekit]=1&products[drumeo_edge_1_year_access]=1&products[Drumeo-VaterSticks]=1&products[30-day-drummer-3]=1&products[30-day-chops]=1&locked=true",
        'secondExtraBonuses' => [
            '<i class="fa-solid fa-check pr-1 text-drumeo"></i> <strong>Alesis Nitro Max E-Kit</strong> <span class="italic">($499 Value)</span>',
            '<i class="fa-solid fa-check pr-1 text-drumeo"></i> <strong> 1-Year Drumeo Membership </strong><span class="italic">($240 Value)</span>',
            '<i class="fa-solid fa-check pr-1 text-drumeo"></i> 30-Day Drummer <span class="italic">($127 Value)</span>',
            '<i class="fa-solid fa-check pr-1 text-drumeo"></i> 30-Day Chops <span class="italic">($127 Value)</span>',
            '<i class="fa-solid fa-check pr-1 text-drumeo"></i> 5A Drumsticks <span class="italic">($12.95 Value)</span>',
    ],
])
@endsection
@section('scripts')
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
