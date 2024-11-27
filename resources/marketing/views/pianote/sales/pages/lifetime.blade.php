@extends('pianote._partials.global-layout')

@section('global-head')
    <title>Lifetime Membership To Pianote | Pianote</title>
    <meta property="og:title" content="Lifetime Membership To Pianote">
    <meta property="og:url" content="https://www.pianote.com/{{ Request::path() }}">

    <meta name="description" content="Your Last Chance To Score A Lifetime Membership For This Price.">
    <meta property="og:description" content="Your Last Chance To Score A Lifetime Membership For This Price.">
    <meta property="og:image" content="https://d21q7xesnoiieh.cloudfront.net/fit-in/1200x0/filters:quality(95)/marketing/pianote/promos/black-friday/lifetime-deal-share-image.jpg" style="display: none;">

    <link rel="stylesheet" href="{{ mix('marketing/css/app.css') }}">
    <link href="{{ asset('/marketing/css/tailwind-helpers.css') }}" rel="stylesheet">
    <link href="{{ asset('/marketing/parcel/drumeo/nav-footer-pianote.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('/marketing/parcel/drumeo/sales-pianote.css') }}">
    <link href="{{ asset('/marketing/css/animate.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@splidejs/splide@4.0.7/dist/css/splide.min.css">

    <style>
    .join.smaller {
            padding:14px 30px;
            font-size:18px;
        }
    </style>
@stop

@section('global-body')
    @include('pianote.sales.partials._nav', [
        "cartVersion" => true
    ])
    {{--TODO:check--}}
    @php
        if(!empty($products['PIANOTE-MEMBERSHIP-LIFETIME']->getStockAvailability())) {
            $stock = $products['PIANOTE-MEMBERSHIP-LIFETIME']->getStockAvailability() - 16;
        }
        else {
            $stock = 0;
        }
    @endphp
    @include('_partials.components.shop.promo-banner-2', [
                "name" => "Lifetime",
                "fullPrice" => 1200,
                "price" => 1200,
                "noBreadcrumb" => true,
            ])
    <section class="text-white relative overflow-hidden z-10 object-cover object-center py-10 md:py-20" style="background: url('https://d21q7xesnoiieh.cloudfront.net/fit-in/2000x0/filters:quality(95)/marketing/musora/promos/november/header-bg.webp') no-repeat center center; background-size: cover;">
        <div class="container mx-auto text-center px-4">
        <img alt="Bundle" class="h-10 sm:h-14" src="https://d21q7xesnoiieh.cloudfront.net/fit-in/700x0/filters:quality(95)/marketing/drumeo/promos/november/2024/lifetime-deal/lifetime-logo.svg"><br>
                <h2 class="leading-tight pt-3 lg:pt-6"><strong>Your <span class="text-musora">Last Chance </span>To Score A <br class="hidden md:block">Lifetime Membership For This Price.</strong></h2>
{{--                <span x-cloak x-data="timer()" x-init="countdown()">--}}
{{--                    <span>--}}
{{--                        ENDS IN--}}
{{--                        <strong class="text-bold">--}}

{{--                            <span x-cloak x-show="timeLeft > 0 && day > 0"><span x-text="day"></span><span--}}
{{--                                    x-text="dayText"></span></span>--}}
{{--                            <span x-cloak x-show="timeLeft > 0"><span x-text="hour"></span><span--}}
{{--                                    x-text="hourText"></span></span>--}}
{{--                            <span x-cloak x-show="timeLeft > 0"><span x-text="minute"></span><span--}}
{{--                                    x-text="minuteText"></span></span>--}}
{{--                            <span x-cloak x-show="timeLeft > 0"><span x-text="second"></span><span--}}
{{--                                    x-text="secondText"></span></span>--}}
{{--                        </strong>--}}
{{--                    </span>--}}
{{--                </span>--}}

           <div class="w-full mx-auto my-4 sm:my-8 " style="max-width:900px;">
                <div class="aspect-16:9 w-full relative rounded-xl overflow-hidden">
                     <iframe class="absolute w-full h-full reset-on-close" src="//player.vimeo.com/video/1032522497" frameborder="0" allowfullscreen allow="autoplay" title="Lifetime Video"></iframe>
                    {{-- Todo: Update video ID --}}
{{--                    <img class="absolute inset-0 rounded-xl overflow-hidden object-cover w-full h-full absolute z-0" src="https://d21q7xesnoiieh.cloudfront.net/fit-in/1200x0/filters:quality(95)/marketing/pianote/promos/november/pianote-lifetime-thumb.webp" alt="Lifetime Video">--}}
                </div>
            </div>
            <div class="px-3 mx-auto w-full max-w-2xl">
                <h2 class="leading-none mb-1">
                    @if(!empty($upgradeVersion))
                        <s class="opacity-60">$1200</s> <strong>$960</strong>
                    @else
                        <strong>$1200</strong>
                    @endif
                    <span class="text-musora text-2xl"> (last chance)</span></h2>

               {{-- @if($stock > 0) --}}
                   <a class="join musora mt-4 w-full anchor-slide text-black sm:max-w-[420px]" href="#customize-anchor">GET THE DEAL</a>
                   <p class="leading-tight text-sm pt-2"><em>Payment plans available.</em></p>
               {{-- @else
                    <a class="join sold-out mt-4 w-full anchor-slide" href="#customize-anchor">SOLD OUT</a>
               @endif --}}
            </div>
        </div>
    </section>
    <section class="text-center px-3 sm:px-5 py-10 md:py-14 lg:py-16 px-2 md:px-4 relative overflow-hidden bg-black text-white">
        <div class="container mx-auto max-w-4xl z-10 relative">
            <img class="h-16 md:h-20 mb-4" src="https://d21q7xesnoiieh.cloudfront.net/fit-in/1500x0/filters:quality(95)/marketing/drumeo/promos/november/2024/lifetime-deal/lifetime-title.webp">
            <p class="leading-tight mb-4"><em>You’ll have unlimited piano lessons for <br class="hidden sm:inline lg:hidden"> the price of 5 years of access to Pianote ($1200 total).</em></p>
            <img class="hidden sm:inline-block w-full max-w-3xl mb-10" src="https://d21q7xesnoiieh.cloudfront.net/fit-in/1500x0/filters:quality(95)/marketing/pianote/promos/black-friday/lifetime-deal/timeline.webp">
            <img class="sm:hidden inline-block w-full max-w-3xl mb-10" src="https://d21q7xesnoiieh.cloudfront.net/fit-in/800x0/filters:quality(95)/marketing/pianote/promos/black-friday/lifetime-deal/timeline-m.webp">
                       <p class="text-left leading-relaxed mt-5">
                Playing the piano makes your life better. It’s proven to improve your mood, memory, and cognitive function.
                <br><br>
                <strong>This isn’t just a hobby – it’s a lifestyle.</strong>
                <br><br>
                That’s why we’re re-opening Lifetime Memberships for a limited time.
                <br><br>
                And your membership only gets more valuable over time. As Pianote grows, so do you.
                <br><br>
                It’s your chance to make one final payment (or split the payments into 3 installments) and enjoy unlimited lessons, courses, and live access to your favorite instructors inside Pianote.
                <br><br>
                But hurry, because it’s…
            </p>
        </div>
    </section>
    <section class="bg-gray-100 py-8 px-4 md:py-12 lg:py-24 lg:px-8">
        <div class="container mx-auto max-w-6xl flex flex-col md:flex-row items-center gap-8 text-left sm:text-center md:text-left">
            <div class="w-full sm:w-10/12 md:w-5/12">
                <img
                    src="https://d21q7xesnoiieh.cloudfront.net/fit-in/1500x0/filters:quality(95)/marketing/pianote/promos/black-friday/lifetime-deal/coach-collage.webp"
                    alt="Group of people"
                    class="w-full"
                />
            </div>

            <div class="w-full sm:w-10/12 md:w-1/2 lg:pl-10">
                <h3 class="mb-6">
                <strong>
                   Your LAST CHANCE to get a <br class="hidden sm:block">Lifetime Membership at this price.
                </strong>
                </h3>
                <p class="mb-2 md:mb-4">
                    All good things must come to an end.
                </p>
                <p class="mb-2 md:mb-4">
                   Our mission is to make music accessible to everyone. And as the Pianote membership continues to grow and expand, with new courses, Challenges, and instruments being added (and more to come)...
                </p>
                <p class="mb-2 md:mb-4">
                <strong>
                   We simply can’t keep offering Lifetime Memberships for $1200.
                </strong>
                </p>
                <p class="mb-2 md:mb-4">
                    The price will be going up next year.
                </p>
                 <p class="mb-2 md:mb-8">
                    So this is your LAST CHANCE to lock in a lifetime of piano lessons (and singing, guitar, drums, and… 😉).
                </p>
            </div>
        </div>
    </section>

    <div id="customize-anchor" class="anchor anchor-slide"></div>
    <section class="py-14 sm:py-20 lg:py-24 relative overflow-hidden text-white text-center customize px-4 lg:px-6"
        style="background:linear-gradient(to bottom, #131633, #000000);"
    >
        <div class="container mx-auto relative z-50 max-w-4xl">
            <img alt="Bundle" class="h-10 sm:h-12 md:h-14" src="https://d21q7xesnoiieh.cloudfront.net/fit-in/700x0/filters:quality(95)/marketing/drumeo/promos/november/2024/lifetime-deal/lifetime-logo.svg"><br>
            <h3 class="leading-tight pt-2 md:pt-6"><strong>Your Last Chance To Score A <br class="hidden sm:block">Lifetime Membership For This Price.</strong></h3>
            <div class="w-full pt-2 md:pt-6">
            <img class="max-w-sm bg-center bg-cover" src="https://d21q7xesnoiieh.cloudfront.net/fit-in/1250x0/filters:quality(95)/marketing/pianote/promos/black-friday/lifetime-deal/order.webp" alt="Lifetime Card Image">
                <br>
                {{-- <h2 class="leading-tight mt-4 sm:mt-6 mb-1">
                    @if(!empty($upgradeVersion))
                        <s class="opacity-60">$1200</s> <strong>$960</strong>
                    @else
                        <strong>$1200</strong>
                    @endif
                </h2> --}}
               {{-- @if($stock > 0) --}}
                    <h2 class="leading-none my-4 md:my-6">
                        @if(!empty($upgradeVersion))
                            <s class="opacity-60">$1200</s> <strong>$960</strong>
                        @else
                            <strong>$1200</strong>
                        @endif
                        <span class="text-musora text-2xl"> (last chance)</span></h2>
                        @if(!empty($upgradeVersion))
                            <a class="join musora w-full sm:max-w-xs md:max-w-lg lg:max-w-xl" style="padding: 15px 10px;"
                                href="/ecommerce/add-to-cart?products[PIANOTE-MEMBERSHIP-LIFETIME]=1&products[LTM-songs-access-3-years]=1&promo-code=lifetime-existing&locked=true">GET THE DEAL <i class="fas fa-arrow-right"></i></a>
                            <a class="text-white underline" href="/ecommerce/add-to-cart?products[PIANOTE-MEMBERSHIP-LIFETIME-3-pay]=1&products[LTM-songs-access-3-years]=1&promo-code=lifetime-existing-3p&locked=true"><p class="leading-tight text-sm pt-4"><em>Prefer a payment plan? Click here to order with 3 monthly payments.</em></p></a>
                        @else
                            <a class="join musora w-full sm:max-w-xs md:max-w-lg lg:max-w-xl" style="padding: 15px 10px;"
                                href="/ecommerce/add-to-cart?products[PIANOTE-MEMBERSHIP-LIFETIME]=1&products[LTM-songs-access-3-years]=1&promo-code=lifetime-3yr-songs&locked=true">GET THE DEAL <i class="fas fa-arrow-right"></i></a>
                            <a class="text-white underline" href="/ecommerce/add-to-cart?products[PIANOTE-MEMBERSHIP-LIFETIME-3-pay]=1&products[LTM-songs-access-3-years]=1&promo-code=lifetime-3yr-songs&locked=true"><p class="leading-tight text-sm pt-4"><em>Prefer a payment plan? Click here to order with 3 monthly payments.</em></p></a>
                @endif
               {{-- @else
                    <span class="join sold-out mt-4 md:mt-5 w-full max-w-xs md:max-w-lg lg:max-w-xl" style="padding: 15px 10px;">SOLD OUT</span>
               @endif --}}
            </div>

{{--            @if($stock > 0)--}}
{{--                <a class="join drumeo my-4 md:my-5 w-full max-w-xs md:max-w-lg lg:max-w-3xl" style="padding: 20px 10px;" href="{{ $buttonLink }}">GET Started &raquo;</a>--}}
{{--                <a class="inline-block leading-tight text-white" href="{{ $buttonLink2 }}"><em><u>Prefer a payment plan? Click here to order with 3 monthly payments.</u></em></a>--}}
{{--            @else--}}
                {{-- <a class="join sold-out my-4 md:my-5 w-full max-w-xs md:max-w-lg lg:max-w-3xl" style="padding: 20px 10px;">SOLD OUT</a> --}}
{{--            @endif--}}
        </div>
    </section>



    @include('pianote.sales.partials._footer')

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script type="text/javascript" src="{{ asset('/marketing/parcel/drumeo/navigation-sales.js') }}"></script>
    <script src="{{ mix('/platform/js/manifest.js') }}"></script>
    <script src="{{ mix('/platform/js/vendor.js') }}"></script>
    <script src="{{ mix('/platform/js/app.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/@splidejs/splide@4.0.7/dist/js/splide.min.js"></script>
@stop
