@extends('singeo.sales.standard-layout', [
    "openVersion" => true,
    "bfButton" => true
])

@section('global-head')
    <title>Your complete guide to confident singing. | Singeo.com</title>
    <meta property="og:url" content="https://www.singeo.com"/>
    <meta property="og:title" content="Singeo.com: Your complete guide to confident singing."/>
    @parent
@endsection

@section('top-promo-bar')
    @include('_partials.layout.holiday.homepage-top-banner',[
        'text' => 'GET 5 FREE BONUSES WORTH $538'
    ])
{{--    <section class="big-promo-banner bg-black text-white text-center relative z-10 overflow-hidden px-5 md:px-3 lg:px-5 md:px-8 py-5 md:py-14 bg-cover bg-center">--}}
{{--        <div class="container mx-auto relative z-30 max-w-lg">--}}
{{--            <a href="/shop"><img class="h-14 sm:h-16 lg:h-20 mx-auto" src="https://singeo.s3.amazonaws.com/sales/promos/november/holiday-singeo.png" alt="singeo black friday logo"></a>--}}
{{--            <p class="leading-tight my-3 uppercase"><strong class="">GET 5 FREE<br class="inline md:hidden"> BONUSES WORTH $538</strong></p>--}}
            {{--            <div class="mt-6 mb-7 rounded-xl px-3 sm:px-6 py-1 inline-flex flex-wrap mx-auto justify-center items-center" style="background-color:#181515;">--}}
            {{--                <p class="leading-none m-0"><strong>DEALS END IN:</strong></p>--}}
            {{--                <div class="h-12 mx-3 sm:mx-5 bg-promo" style="width:2px;"></div>--}}
            {{--                <div class="tzcd-big">--}}
            {{--                    <div class="inline-block">--}}
            {{--                        <h2 class="font-extrabold leading-none text-2xl md:text-3xl lg:text-4xl">00</h2>--}}
            {{--                        <p class="leading-none uppercase font-extrabold text-xs text-promo">days</p>--}}
            {{--                    </div>--}}
            {{--                    <div class="inline-block mx-2">--}}
            {{--                        <h2 class="font-extrabold leading-none text-2xl md:text-3xl lg:text-4xl">00</h2>--}}
            {{--                        <p class="leading-none uppercase font-extrabold text-xs text-promo">hrs</p>--}}
            {{--                    </div>--}}
            {{--                    <div class="inline-block mr-2">--}}
            {{--                        <h2 class="font-extrabold leading-none text-2xl md:text-3xl lg:text-4xl">00</h2>--}}
            {{--                        <p class="leading-none uppercase font-extrabold text-xs text-promo">mins</p>--}}
            {{--                    </div>--}}
            {{--                    <div class="inline-block">--}}
            {{--                        <h2 class="font-extrabold leading-none text-2xl md:text-3xl lg:text-4xl">00</h2>--}}
            {{--                        <p class="leading-none uppercase font-extrabold text-xs text-promo">secs</p>--}}
            {{--                    </div>--}}
            {{--                </div>--}}
            {{--            </div>--}}
            {{-- This is for when a student is on the order form with an offer in their cart they are not eligible for.
                We redirect them back here and show them this error message. --}}
{{--            @if(session()->has('error'))--}}
{{--                <p class="leading-tight mt-1 mb-5 uppercase text-xl"><strong class="text-promo">{{ session()->get('error') }}</strong></p>--}}
{{--            @endif--}}
{{--            <div class="flex flex-wrap items-start justify-center mx-auto max-w-xs md:max-w-none">--}}
{{--                <a class="w-full md:w-1/2 join smaller outline md:order-2" href="/shop">SHOP ALL DEALS &raquo;</a>--}}

{{--                <div class="w-full md:w-1/2 md:pr-2 mt-3 md:mt-0 relative">--}}
{{--                    <a class="w-full join white smaller anchor-slide" href="#customize-anchor">JOIN SINGEO &raquo;</a>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--        <div class="inset-0 absolute bg-center bg-cover z-0" style="background: #000 url(https://drumeo-assets.s3.amazonaws.com/promos/christmas/snow-dark.gif) center center/250px;box-shadow: 0 0 100px inset #000;"></div>--}}
{{--    </section>--}}
@endsection

@section('sticky-bar')
    @include('_partials.layout.holiday.sticky-bar', [
        'text' => 'GET 5 FREE BONUSES <br> WORTH $538',
    ])
{{--    <a href="#customize-anchor" style="background: #000 url(https://drumeo-assets.s3.amazonaws.com/promos/christmas/snow-dark.gif) center center/250px;box-shadow: 0 0 10px inset #000;"--}}
{{--        class="anchor-slide promo-banner block text-center w-full transition-opacity duration-300 overflow-hidden whitespace-nowrap bg-cover bg-center shadow-md py-1 z-0 mx-auto -mt-10 text-xs">--}}
{{--        <div class="container mx-auto relative">--}}
{{--            <div class="inline-block align-middle text-center">--}}
{{--                <img class="inline-block align-middle mr-2 h-8"--}}
{{--                    src="https://cdn.musora.com/image/fetch/w_200,q_auto:best/https://singeo.s3.amazonaws.com/sales/promos/november/holiday-singeo.png">--}}
{{--                <p class="inline-block align-middle mx-auto font-bebas text-white text-sm leading-none sm:text-lg sm:leading-none text-left">--}}
{{--                    <span class="uppercase">GET 5 FREE BONUSES <br> WORTH $538</span></p>--}}
                {{--            <div class="tzcd-smaller text-white align-middle inline-block">--}}
                {{--                <div class="inline-block">--}}
                {{--                    <h2 class="font-extrabold leading-none text-lg">00</h2>--}}
                {{--                    <p class="leading-none uppercase font-extrabold text-xs text-promo">days</p>--}}
                {{--                </div>--}}
                {{--                <div class="inline-block mx-2">--}}
                {{--                    <h2 class="font-extrabold leading-none text-lg">00</h2>--}}
                {{--                    <p class="leading-none uppercase font-extrabold text-xs text-promo">hrs</p>--}}
                {{--                </div>--}}
                {{--                <div class="inline-block mr-2">--}}
                {{--                    <h2 class="font-extrabold leading-none text-lg">00</h2>--}}
                {{--                    <p class="leading-none uppercase font-extrabold text-xs text-promo">mins</p>--}}
                {{--                </div>--}}
                {{--                <div class="inline-block">--}}
                {{--                    <h2 class="font-extrabold leading-none text-lg">00</h2>--}}
                {{--                    <p class="leading-none uppercase font-extrabold text-xs text-promo">secs</p>--}}
                {{--                </div>--}}
                {{--            </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </a>--}}
@endsection

@section('final')
{{--     @include("singeo.sales.partials._subscribe-options")--}}
<div id="customize-anchor" class="anchor anchor-slide"></div>
    @include('_partials.layout.holiday.homepage-bottom-membership',[
        'logo' => 'https://singeo.s3.amazonaws.com/sales/promos/august/homepage_chart.png',
        'singeo' => true,
        'joinText' => '<strong>Join Singeo for just $'.round(SingeoPrices::$singeoMembershipAnnual / 12, 2).'/month</strong> <br class="hidden sm:inline"><strong class="text-promo">PLUS</strong> get 5 free bonuses worth $538.',
        'annualLink' => '/ecommerce/add-to-cart?products[singeo-annual-recurring-membership]=1&products[singing-starter-kit]=1&products[the-essential-guide-to-beautiful-harmonies]=1&products[vowel-sounds-poster]=1&bonuses[PIANOTE-MEMBERSHIP-1-YEAR]=1&bonuses[GUITAREO-1-YEAR-MEMBERSHIP]=1&locked=true&redirect=/order',
        'bonusNum' => 5,
        'tileWidth' => 'w-1/2 sm:w-1/3 lg:w-1/5',
        'bonuses' => [
                    [
                        'image' => 'https://singeo.s3.amazonaws.com/sales/promos/november/singing-starter-kit.jpg',
                        'title' => 'Singing<br> Starter Kit',
                        'description' => 'Get everything you need to start singing now. In just 7 hands-on lessons, you’ll overcome the challenges most beginner singers face and will instantly sound better.',
                        'price' => SingeoPrices::$singingStarterKitFull,
                        'online-ship' => "Lifetime Access"
                    ],
                    [
                        'image' => 'https://singeo.s3.amazonaws.com/sales/promos/october/Beautiful_harmonies_card.jpg',
                        'title' => 'Harmony',
                        'description' => 'In just 8, short, sing-a-long lessons, you’ll learn how to elevate any vocal performance with incredible harmonies. Even if you’re a total beginner, you’ll be singing your first harmony within the first 10 minutes of this course.',
                        'price' => SingeoPrices::$beautifulHarmoniesFull,
                        'online-ship' => "Lifetime Access"
                    ],
                    [
                        'image' => 'https://singeo.s3.amazonaws.com/sales/promos/november/poster2.png',
                        'title' => 'Vowel Practice<br> Poster',
                        'badge' => 'Vowel Practice Poster',
                        'description' => 'Your new favorite practice tool - and your ticket hitting higher notes with ease and confidence.',
                        'price' => SingeoPrices::$posterFull,
                        'online-ship' => "Free Shipping",
                        'br' => '<br class="hidden sm:inline">'
                    ],
                    [
                        'image' => 'https://singeo.s3.amazonaws.com/sales/lifetime/1-year-of-guitar-card.jpg',
                        'title' => '1 Year of Guitareo Lessons',
                        'badge' => '1 Year of Guitareo Lessons',
                        'description' => '1 year of online video-based guitar lessons and personal support.',
                        'price' => 240,
                        'online-ship' => "Online Access",
                    ],
                    [
                        'image' => 'https://singeo.s3.amazonaws.com/sales/lifetime/1-year-of-piano-card.jpg',
                        'title' => '1 Year of Pianote Lessons',
                        'badge' => '1 Year of Pianote Lessons',
                        'description' => '1 year of online video-based piano lessons and personal support.',
                        'price' => 240,
                        'online-ship' => "Online Access",
                    ],
                ],
        'monthlyLink' => '/ecommerce/add-to-cart?products[singeo-monthly-recurring-membership]=1&redirect=/order&locked=true'
    ])
@endsection
