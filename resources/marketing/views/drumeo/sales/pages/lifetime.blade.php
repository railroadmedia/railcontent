@extends('drumeo._partials.global-layout')

@section('global-head')
    <title>Lifetime Membership | Drumeo</title>
    <meta property="og:title" content="Lifetime Membership | Drumeo">
    <meta property="og:url" content="https://www.drumeo.com/{{ Request::path() }}">

    <meta name="description" content="Unlimited drum lessons for life.">
    <meta property="og:description" content="Unlimited drum lessons for life.">
    <meta property="og:image" content="https://d21q7xesnoiieh.cloudfront.net/fit-in/1200x0/filters:quality(95)/marketing/drumeo/promos/november/2024/lifetime-share-image.jpg" style="display: none;">

    <link rel="stylesheet" href="{{ mix('marketing/css/app.css') }}">
    <link href="{{ asset('/marketing/parcel/drumeo/navigation-sales.css') }}" rel="stylesheet">
    <link href="{{ asset('/marketing/css/tailwind-helpers.css') }}" rel="stylesheet">
    <link href="{{ asset('/marketing/parcel/drumeo/sales-2020.css') }}" rel="stylesheet">

    <style>
    .join.smaller {
            padding:14px 30px;
            font-size:18px;
        }
    </style>
@stop

@section('body-data')
    x-data ='{
    trailer : false,
    lazyLoad: false,
    }'
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
    @include('_partials.components.shop.promo-banner-2', [
        "name" => "Lifetime",
        "fullPrice" => 1200,
        "price" => 1200,
        "noBreadcrumb" => true
    ])

    <section class="text-white relative overflow-hidden z-10 object-cover object-center py-10 md:py-20" style="background: url('https://d21q7xesnoiieh.cloudfront.net/fit-in/2000x0/filters:quality(95)/marketing/musora/promos/november/header-bg.webp') no-repeat center center; background-size: cover;">
        <div class="container mx-auto text-center px-4">
        <img alt="Bundle" class="h-10 sm:h-14" src="https://d21q7xesnoiieh.cloudfront.net/fit-in/700x0/filters:quality(95)/marketing/drumeo/promos/november/2024/lifetime-deal/lifetime-logo.svg"><br>
                <h2 class="leading-tight pt-3 lg:pt-6"><strong>Unlimited drum lessons for life.</strong></h2>
                <h5 class="leading-tight italic"> Your last chance to grab a Lifetime Membership at the old price.</h5>
            {{-- <h3 class="leading-tight mt-3 text-white uppercase">
                @if($stock > 0)

                    <!-- <span x-cloak x-data="timer()" x-init="countdown()">
                             <span x-cloak x-show="timeLeft > 0 && day > 0"><span x-text="day"></span><span x-text="dayText"></span></span>
                             <span x-cloak x-show="timeLeft > 0"><span x-text="hour"></span><span x-text="hourText"></span></span>
                             <span x-cloak x-show="timeLeft > 0"><span x-text="minute"></span><span x-text="minuteText"></span></span>
                             <span x-cloak x-show="timeLeft > 0 && day < 7"><span x-text="second"></span><span x-text="secondText"></span></span>
                             <span x-cloak x-show="timeLeft < 0">A Limited Time</span>
                         </span> -->

                    <strong>Only <s>100</s> <span class='text-musora'> {{ $products['DLM-Lifetime']->getPublicStockCount()}}  </span> left!</strong>
                @else
                    &nbsp;
                @endif
            </h3> --}}

            <div class="w-full mx-auto my-4 sm:my-8 " style="max-width:920px;">
                <div class="aspect-16:9 w-full relative rounded-xl overflow-hidden">
                    <iframe class="absolute w-full h-full reset-on-close" src="//player.vimeo.com/video/1032532760" frameborder="0" allowfullscreen allow="autoplay" title="Lifetime Video"></iframe> {{-- Todo: Update video ID --}}
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
                @if(!empty($upgradeVersion))
                    <a class="join musora mt-4 w-full text-black sm:max-w-[420px]" style="padding: 15px 10px;"
                        href="/ecommerce/add-to-cart?products[DLM-Lifetime]=1&products[LTM-songs-access-3-years]=1&promo-code=lifetime-existing&locked=true">GET THE DEAL <i class="fas fa-arrow-right"></i></a>
                    <a class="text-white underline" href="/ecommerce/add-to-cart?products[DLM-Lifetime-3-pay]=1&products[LTM-songs-access-3-years]=1&promo-code=lifetime-existing-3p&locked=true"><p class="leading-tight text-sm pt-4"><em>Prefer a payment plan? Click here to order with 3 monthly payments.</em></p></a>
                @else
                <a class="join musora mt-4 w-full text-black sm:max-w-[420px]" style="padding: 15px 10px;"
                    href="/ecommerce/add-to-cart?products[DLM-Lifetime]=1&products[LTM-songs-access-3-years]=1&promo-code=lifetime-3yr-songs&locked=true">GET THE DEAL <i class="fas fa-arrow-right"></i></a>
                <a class="text-white underline" href="/ecommerce/add-to-cart?products[DLM-Lifetime-3-pay]=1&products[LTM-songs-access-3-years]=1&promo-code=lifetime-3yr-songs&locked=true"><p class="leading-tight text-sm pt-4"><em>Prefer a payment plan? Click here to order with 3 monthly payments.</em></p></a>
                @endif
                   {{-- <p class="leading-tight text-sm pt-2"><em>Payment plans available.</em></p> --}}
               {{-- @else
                    <a class="join sold-out mt-4 w-full anchor-slide" href="#customize-anchor">SOLD OUT</a>
               @endif --}}
            </div>
        </div>
    </section>

    <section class="text-center px-3 sm:px-5 py-10 md:py-14 lg:py-20 px-2 md:px-4 relative overflow-hidden bg-black text-white">
            <div class="container mx-auto max-w-4xl z-10 relative">
                <img class="h-16 md:h-20 mb-4" src="https://d21q7xesnoiieh.cloudfront.net/fit-in/1500x0/filters:quality(95)/marketing/drumeo/promos/november/2024/lifetime-deal/lifetime-title.webp">
                <p class="leading-tight mb-5"><em>You’ll have a lifetime of unlimited drum lessons for <br class="block md:hidden">the  price of 5 years of access to Drumeo ($1200 total).</em></p>
                <img class="hidden sm:inline-block w-full max-w-3xl mb-10" src="https://d21q7xesnoiieh.cloudfront.net/fit-in/1500x0/filters:quality(95)/marketing/drumeo/promos/november/2024/lifetime-deal/timeline.webp">
                <img class="sm:hidden inline-block w-full max-w-3xl mb-10" src="https://d21q7xesnoiieh.cloudfront.net/fit-in/800x0/filters:quality(95)/marketing/drumeo/promos/november/2024/lifetime-deal/timeline-m.webp">
            </div>
        </section>
    <section class="py-8 px-6 sm:py-12 lg:py-24 lg:px-8" style="background-color:#f4f8fb;">
        <div class="container mx-auto max-w-6xl flex flex-col md:flex-row items-center gap-8 text-left sm:text-center md:text-left">
            <div class="w-full sm:w-10/12 md:w-5/12">
                <img
                    src="https://d21q7xesnoiieh.cloudfront.net/fit-in/1500x0/filters:quality(95)/marketing/drumeo/promos/november/2024/lifetime-deal/coach-collage.webp"
                    alt="Group of people"
                    class="w-full"
                />
            </div>

            <div class="w-full sm:w-10/12 md:w-7/12 lg:pl-10">
                <h3 class="mb-6">
                <strong>
                    The Times They Are A' Changin
                </strong>
                </h3>
                <p class="mb-2 md:mb-4">
                    All good things must come to an end.
                </p>
                <p class="mb-2 md:mb-4">
                    As your Drumeo Membership continues to expand with new courses, challenges, and instrument additions (and even more to come)...
                </p>
                <p class="mb-2 md:mb-4">
                    We can’t continue offering Lifetime Memberships for $1200.
                </p>
                <p class="mb-2 md:mb-8">
                    The price is going up next year. So this is your LAST CHANCE to lock in a lifetime of drum lessons (and singing, guitar, piano, and anything else added 😉) at the old price.
                </p>
            </div>
        </div>
    </section>
    <section class="py-8 px-6 sm:py-12 lg:py-24 lg:px-8">
        <div class="container mx-auto max-w-6xl flex flex-col md:flex-row items-start lg:items-center gap-4 lg:gap-8 text-left sm:text-center md:text-left">
            <div class="w-full sm:w-10/12 md:w-1/2 sm:order-1">
                <img
                    src="https://d21q7xesnoiieh.cloudfront.net/fit-in/1120x0/filters:quality(95)/marketing/drumeo/promos/november/2024/lifetime-deal/drumeo-lifetime-songs.webp"
                    alt="Group of people"
                    class="w-full"
                />
            </div>

            <div class="w-full sm:w-10/12 md:w-1/2 lg:pr-10">
                <h3 class="mb-6"><strong>Music Licensing Is Hard</strong></h3>
                <p class="leading-normal">
                    A Lifetime Membership gives you unlimited access to all Drumeo lessons, playalongs, live events, and in-house content – forever – plus all of our instrument channels (Pianote, Guitareo, Singeo). But a portion of your membership includes copyrighted material – with a growing library of famous songs with sheet music and playalong tools. 
                    <br><br>
                    <strong>You’ll get 3 years of Songs access with your lifetime membership.</strong> After that, because we need to pay a small fee to record labels, you’ll have the option to continue your Songs access for $40/year. This ensures you enjoy great music while supporting the artists who created it.
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
            <h3 class="leading-tight pt-2 md:pt-6"><strong>Your last chance to grab a Lifetime <br class="hidden md:block">Membership at the old price.</strong></h3>
            <div class="w-full pt-2 md:pt-6">
            <img class="max-w-sm bg-center bg-cover" src="https://d21q7xesnoiieh.cloudfront.net/fit-in/850x0/filters:quality(95)/marketing/drumeo/promos/november/2024/lifetime-deal/order.webp" alt="Lifetime Card Image">
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
                    </h2>
                @if(!empty($upgradeVersion))
                    <a class="join musora w-full sm:max-w-xs md:max-w-lg lg:max-w-xl" style="padding: 15px 10px;"
                        href="/ecommerce/add-to-cart?products[DLM-Lifetime]=1&products[LTM-songs-access-3-years]=1&promo-code=lifetime-existing&locked=true">GET THE DEAL <i class="fas fa-arrow-right"></i></a>
                    <a class="text-white underline" href="/ecommerce/add-to-cart?products[DLM-Lifetime-3-pay]=1&products[LTM-songs-access-3-years]=1&promo-code=lifetime-existing-3p&locked=true"><p class="leading-tight text-sm pt-4"><em>Prefer a payment plan? Click here to order with 3 monthly payments.</em></p></a>
                @else
                <a class="join musora w-full sm:max-w-xs md:max-w-lg lg:max-w-xl" style="padding: 15px 10px;"
                    href="/ecommerce/add-to-cart?products[DLM-Lifetime]=1&products[LTM-songs-access-3-years]=1&promo-code=lifetime-3yr-songs&locked=true">GET THE DEAL <i class="fas fa-arrow-right"></i></a>
                <a class="text-white underline" href="/ecommerce/add-to-cart?products[DLM-Lifetime-3-pay]=1&products[LTM-songs-access-3-years]=1&promo-code=lifetime-3yr-songs&locked=true"><p class="leading-tight text-sm pt-4"><em>Prefer a payment plan? Click here to order with 3 monthly payments.</em></p></a>
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

{{--  TODO:TRAILER--}}
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
@stop
