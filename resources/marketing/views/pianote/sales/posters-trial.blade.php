@extends('pianote.sales.subscription', [
    "promoVersion" => true,
])

@section('global-head')
    <title>Learn Piano with Step by Step Online Lessons | Pianote</title>
    <meta property="og:title" content="Pianote - The Better Way To Learn Piano">
    <meta property="og:url" content="https://www.pianote.com/roland">
    <style>
        form input, form button {
            line-height:40px;
            height: 40px;
        }
        @media (min-width: 40em) {
            form input, form button {
                height: 52px;
                line-height: 52px;
            }
        }
        .thank-you-box.active {
            max-height:1000px;
            visibility:visible;
            opacity:1;
            padding:15px;
        }
        @media (min-width: 40em) {
            .thank-you-box.active {
                padding: 20px;
            }
        }
    </style>
    @parent
@endsection

@section('promo-banner')
    <section class="text-center px-5 sm:px-6 py-12 sm:py-14 lg:py-20 text-white relative" style="background: linear-gradient(to bottom, #f41a30, #79080b);">
        <div class="container max-w-5xl mx-auto">
            <h2><strong>Unlimited piano lessons + 2 FREE posters. </strong></h2>
            <p class="leading-tight text-musora mt-1 sm:mb-10"><strong>You’ll get free Chords & Scales Posters when you try Pianote for 7 days ($18 value)</strong></p>
            {{--            <h6 class="inline-block mx-auto rounded-md text-black bg-musora py-2 px-4 mt-4 sm:mb-10"><strong>ONLY <s class="opacity-50">2000</s> @if(!empty($products['poster-chords']->getPublicStockCount())) {{ $products['poster-chords']->getPublicStockCount() }} @endif LEFT</strong></h6>--}}
            <img class="my-5 h-40 inline sm:hidden"
                src="https://d21q7xesnoiieh.cloudfront.net/fit-in/620x0/filters:quality(95)/marketing/pianote/promos/september/pianote-trial-sept-promo-collage-m.png"
                alt="learn playing image"
                fetchpriority="high"
            >
            <div class="text-left flex flex-wrap sm:flex-nowrap justify-center items-start mb-5">
                <p class="leading-normal max-w-xl pr-5 lg:pr-8 mx-0">We’ll send you 2 FREE posters when you start a 7-day trial of Pianote.
                    <br><br>
                    Chords and Scales are the building blocks of ALL music. Sign up for a free 7-day trial of Pianote and we’ll ship you these two posters FREE of charge. No matter where you live in the world.
                    <br><br>
                    Why?
                    <br><br>
                    Because the world is better with more piano players. And we want to get as many people playing and loving the piano as possible. Hang these posters in your practice space and use them to help play your favorite songs this month.
                    <br><br>
                    Supplies are limited, so grab yours today.
                    <br>
                    <a class="join smaller musora my-3 w-1/2" href="/ecommerce/add-to-cart?products[PIANOTE-MEMBERSHIP-TRIAL-7-DAY-ANNUAL]=1&products[poster-chords]=1&products[poster-scales]=1&locked=true&promo-code=posters-trial">GET Started &raquo;</a>
                    <br>
                    <em>Free worldwide shipping!</em>
                </p>
                <img class="h-80 lg:h-96 hidden sm:inline transition-opacity opacity-0"
                    loading="lazy"
                    onload="this.classList.remove('opacity-0')"
                    src="https://d21q7xesnoiieh.cloudfront.net/fit-in/690x0/filters:quality(95)/marketing/pianote/promos/september/pianote-trial-sept-promo-collage.png"
                    alt="learn playing image"
                >
            </div>
        </div>
    </section>
    <div class="sticky-trigger block"></div>
    <a href="/ecommerce/add-to-cart?products[PIANOTE-MEMBERSHIP-TRIAL-7-DAY-ANNUAL]=1&products[poster-chords]=1&products[poster-scales]=1&promo-code=posters-trial&redirect=/order&locked=true"
        class="promo-banner flex text-white items-center justify-center -mt-10 py-1.5 px-2 sm:px-0 w-full z-[100] transition-none anchor-slide"style="background: linear-gradient(to bottom, #f41a30, #79080b);">
        {{--        <img class="h-8 sm:h-10 mr-4" src="https://cdn.musora.com/image/fetch/w_300,q_auto:best/https://d2vyvo0tyx8ig5.cloudfront.net/products/30-day-blues-piano/30-day-blues-piano-logo-blue-glow.png" alt="30 day drummer logo" />--}}
        <h3 class="inline-block font-bebas text-musora mx-0 pr-3">* FREE POSTERS *</h3>
        <p class="inline-block text-xs mx-0 leading-tight">
            Get <strong>2 free posters</strong> when you try
            <br> Pianote for 7 days. <em>While quantities last.</em>
        </p>
    </a>

@endsection
@section('final')

    <section class="py-14 sm:py-20 lg:py-24 relative overflow-hidden text-white text-center customize px-4 lg:px-6"
        style="background: linear-gradient(to right, #08203a, #0c1524);">
        <div class="container mx-auto max-w-6xl relative z-50">
            <div class="w-full">
                <div class="bonus-wrap relative inline-block align-top mx-auto px-1 md:px-3 w-full max-w-lg">
                    <div class=" inline-block relative w-full group" style="padding-bottom: 39.5%;perspective: 1000px;">
                        <div class="text-center w-full h-full absolute" style="transform-style: preserve-3d;">
                            <div class=" {{--border-2 border-promo--}} front absolute z-20  w-full h-full transition-transform duration-700" style="backface-visibility: hidden;">
                                <div class="h-full w-full bg-top bg-contain bg-no-repeat" style="background-image: url('https://d21q7xesnoiieh.cloudfront.net/fit-in/850x0/filters:quality(95)/marketing/pianote/promos/september/pianote-trial-sept-order-collage.png');"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <br>
                <h2 class="leading-tight mt-4 sm:mt-5 mb-2"><strong>Try Pianote for 7 days & get<br class="hidden sm:inline"> FREE Chords & Scales posters.</strong></h2>

                <p class="leading-tight mt-4 sm:mt-5 mb-2">
                        <span class="text-musora">Click below to start your free 7-day trial. Your annual membership<br class="hidden sm:inline">
                            will continue on {{ Carbon\Carbon::now()->addDays(7)->format('F jS') }} (after your free trial).</span>
                    {{--                        <em>Only <s class="opacity-50">2000</s> <strong> @if(!empty($products['poster-chords']->getPublicStockCount())) {{ $products['poster-chords']->getPublicStockCount() }} @endif </strong> posters left!</em>--}}
                </p>

                <h3 class="leading-tight mt-4 sm:mt-5 mb-2"><strong>Free for 7 days</strong></h3>
                <p class="leading-tight opacity-70 text-sm"><em>Then billed at $240 per year. Save 33%.</em></p>
                <a class="join {{ $theme }} my-4 md:my-6 w-full max-w-xs md:max-w-lg lg:max-w-xl" style="padding: 20px 10px;" href="/ecommerce/add-to-cart?products[PIANOTE-MEMBERSHIP-TRIAL-7-DAY-ANNUAL]=1&products[poster-chords]=1&products[poster-scales]=1&locked=true&promo-code=posters-trial">CLICK HERE TO GET STARTED</a>
            </div>
            <a class="inline-block opacity-70 mt-2" href="/ecommerce/add-to-cart?products[PIANOTE-MEMBERSHIP-TRIAL]=1&redirect=/order&locked=true"><p class="leading-tight"><u>Or start a monthly membership for<br class="sm:hidden"> $30/month (no bonuses)</u></p></a>
            <p class="opacity-70 text-sm mt-2"><em>90-day money-back guarantee. Cancel anytime.</em></p>
        </div>
    </section>
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
