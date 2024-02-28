@extends('drumeo.sales.subscription', [
    "promoVersion" => true,
    "hideHeader" => true,
])

@section('promo-banner')
    <header class="text-center px-5 sm:px-6 py-10 sm:py-14 lg:py-16 relative overflow-hidden"
            style="background:linear-gradient(to right, #e0ecf9, #f6f8fc, #f6f8fc, #e0ecf9);"
    >
        <div class="container max-w-6xl mx-auto relative z-20">
            <img class="sm:hidden inline-block h-24 " src="https://d21q7xesnoiieh.cloudfront.net/fit-in/400x0/filters:quality(95)/marketing/drumeo/promos/march/12-anniversary-logo-black-m.webp" alt="30 day drummer logo" />
            <img class="hidden sm:inline-block sm:h-20 lg:h-24" src="https://d21q7xesnoiieh.cloudfront.net/fit-in/960x0/filters:quality(95)/marketing/drumeo/promos/march/12-anniversary-logo-black.webp" alt="30 day drummer logo" />
            <p class="leading-tight my-5 lg:my-7">Get first-year pricing <strong>OR</strong> 12 free bonuses with your membership <em class="text-drumeo">(worth $1199.93)</em></p>
            <img class="sm:hidden inline-block h-36 " src="https://d21q7xesnoiieh.cloudfront.net/fit-in/600x0/filters:quality(95)/marketing/drumeo/promos/march/bundle-header-m.webp" alt="30 day drummer logo" />
            <img class="hidden sm:inline-block sm:h-52 lg:h-64" src="https://d21q7xesnoiieh.cloudfront.net/fit-in/1420x0/filters:quality(95)/marketing/drumeo/promos/march/bundle-header.webp" alt="30 day drummer logo" />
            <div class="flex flex-wrap justify-center max-w-xs sm:max-w-full mx-auto px-5 sm:px-0 mt-5 lg:mt-7">
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
    <section class="text-center px-5 sm:px-6 py-10 sm:py-12 lg:py-14 text-white relative" style="background: #0C1524;">
        <div class="container max-w-5xl mx-auto">
            <div class="text-left flex flex-wrap sm:flex-nowrap justify-center items-start mb-5">
                <div class=" pr-5 lg:pr-8 mx-0 max-w-lg">
                    <h4 class="mb-4"><strong>Celebrate 12 years of Drumeo with <span class="text-drumeo">our biggest anniversary bundle ever.</span></strong></h4>
                    <p class="leading-normal">
                        You’ll get 12 FREE bonuses with your membership (including a FREE pair of professional in-ear headphones). 
                        <br><br>
                        OR you can wind back the clock and grab our original 2012 price on your first year. 
                        <br><br>
                        Scroll down to see everything included in the 12th Anniversary Bundle.
                        <br>
                        <a class="join drumeo smaller my-3 w-1/2 anchor-slide" href="#customize-anchor">See Details &raquo;</a>
                        <br>
                        <em>Free worldwide shipping!</em>
                    </p>

                </div>
                <img class="h-72 lg:h-96 hidden sm:inline transition-opacity opacity-0"
                    loading="lazy"
                    onload="this.classList.remove('opacity-0')"
                    src="https://d21q7xesnoiieh.cloudfront.net/fit-in/690x0/filters:quality(95)/marketing/drumeo/promos/march/drumeo-timeline.webp"

                    alt="learn playing image"
                >
            </div>
        </div>
    </section>

    <div class="sticky-trigger block"></div>
    <a href="#customize-anchor"
        class="promo-banner flex items-center justify-center -mt-12 py-0.5 px-2 sm:px-0 w-full z-[100] transition-none anchor-slide"style="background: #CFDDF9;">
        <img class="h-8 sm:h-10 mr-3" src="https://d21q7xesnoiieh.cloudfront.net/fit-in/300x0/filters:quality(95)/marketing/drumeo/promos/march/12-anniversary-sticky-logo.webp" alt="30 day drummer logo" />
        <p class="inline-block text-xs mx-0 leading-tight">
            Celebrate <strong>12 years of Drumeo </strong> with
            <br>12 FREE bonuses 🥳 <em>(worth $1199.93)</em>
        </p>
    </a>
    @php
        require_once(resource_path('marketing/views/drumeo/_partials/homepage-data.php'));
        $slides = $drumeo['slides'];
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

@section('final')
        @include('musora.sales.components.order-promo-cards-section', [
        // general
        'logoM' => "drumeo/promos/march/12-anniversary-logo-white-m.webp",
        'logo' => "drumeo/promos/march/12-anniversary-logo-white.webp",
        'promoText' => 'Grab first-year pricing <strong>OR</strong> 12 free bonuses with your membership <em class="text-drumeo">(worth $1199.93)</em>',
        'buttonText' => "GET STARTED",

        // first deal
        'firstDeal'=> "Legacy Pricing",
        'firstDealImage' => 'https://d21q7xesnoiieh.cloudfront.net/fit-in/800x0/filters:quality(95)/marketing/drumeo/promos/march/order-membership.webp',
        'firstImageHeight' => 'h-24',
        'firstDealPrice' => 197,
        'firstDealDiscount' => 240,
        'firstDealSub' => "Save 25% on your first year. No bonuses.",
        "firstDealLink" => "/ecommerce/add-to-cart?products[PIANOTE-MEMBERSHIP-1-YEAR]=1&promo-code=legacy&locked=true",
        'firstExtraBonuses' => [
            'Celebrate 12 years of Drumeo by getting our OG 2012 price on our annual membership:',
            '<strong class="text-drumeo"><i class="fa-solid fa-check pr-1"></i> Learn</strong>',
            '<strong class="text-drumeo"><i class="fa-solid fa-check pr-1"></i> Practice</strong>',
            '<strong class="text-drumeo"><i class="fa-solid fa-check pr-1"></i> Play</strong>',
    ],

        // second deal
        'topBadge' => "BEST DEAL",
        'secondDeal' => "Anniversary Bundle",
        'secondDealImage' => 'https://d21q7xesnoiieh.cloudfront.net/fit-in/800x0/filters:quality(95)/marketing/drumeo/promos/march/order-bundle.webp',
        'secondImageHeight' => 'h-24',
        'secondDealSub' => "12 bonuses worth $1199.93.",
        'secondDealPrice' => 240,
        'secondDealDiscount' => 1493.93,
        "secondDealLink" => "/ecommerce/add-to-cart?products[DLM-1-year]=1&products[drumeo-eardrums]=1&products[Drumeo-VaterSticks]=1&products[Drumeo-Key]=1&products[30dd]=1&products[30dc]=1&products[rock-drumming-masterclass-pack]=1&products[drum-technique-made-easy-pack]=1&products[independence-made-easy-pack]=1&products[four-weeks-to-better-drum-fills]=1&products[learn-songs-faster-pack]=1&products[GHFAL-DIGI]=1&products[CC-DIGI]=1&locked=true",
        'secondExtraBonuses' => [
            '<i class="fa-solid fa-check pr-1 text-drumeo"></i> <strong>Annual Membership </strong>',
            '<i class="fa-solid fa-check pr-1 text-drumeo"></i> EarDrums ($149 Value)',
            '<i class="fa-solid fa-check pr-1 text-drumeo"></i> 5A Drumsticks ($12.95 Value)',
            '<i class="fa-solid fa-check pr-1 text-drumeo"></i> Drum Key ($15 Value)',
            '<i class="fa-solid fa-check pr-1 text-drumeo"></i> 30-Day Drummer ($127 Value)',
            '<i class="fa-solid fa-check pr-1 text-drumeo"></i> 30-Day Chops ($127 Value)',
            '<i class="fa-solid fa-check pr-1 text-drumeo"></i> Rock Drumming Masterclass, Drum Technique Made Easy, Independence Made Easy ($591 Value)',
            '<i class="fa-solid fa-check pr-1 text-drumeo"></i> Better Drum Fills , Learn Songs Faster ($118 Value)',
            '<i class="fa-solid fa-check pr-1 text-drumeo"></i> Great Hands For A Lifetime, Creative Control ($59.98 Value)',
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
