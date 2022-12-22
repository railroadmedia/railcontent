@extends('guitareo.sales.standard-layout', [
"openVersion" => true,
    "bfButton" => true
])

@section('meta')
    <title>Learn to play guitar anytime with real teachers. | Guitareo.com</title>
    <meta property="og:url" content="https://www.guitareo.com"/>
    <meta property="og:title" content="Guitareo.com: Learn to play guitar anytime with real teachers."/>
    <style>
        form.promo-section {
            position: relative;
            width: 100%;
            max-width: 100%;
            margin: 10px auto 0;
        }
        form.promo-section input,
        form.promo-section button {
            border: none;
            outline: none;
            font: 400 16px/45px 'Open Sans', sans-serif;
            height: 45px;
            background: #fff;
            color: #000;
            border-radius: 100px;
            width: 100%;
            text-align: left;
            padding: 7px 20px;
            margin: 0 auto 7px;
        }
        @media (min-width: 768px) {
            form.promo-section input,
            form.promo-section button {
                margin: 0 auto;
                font-size:18px;
            }
        }
        form.promo-section input[type="submit"],
        form.promo-section button[type="submit"],
        form.promo-section input button,
        form.promo-section button button {
            font-family: 'Bebas Neue', sans-serif;
            background: #00c9ac;
            text-transform: uppercase;
            display: inline-block;
            cursor: pointer;
            text-align: center;
            padding: 0;
            margin: 0;
            color: #fff;
            line-height: 31px;
        }
        form.promo-section input[type="submit"]:hover,
        form.promo-section button[type="submit"]:hover,
        form.promo-section input button:hover,
        form.promo-section button button:hover {
            background:#00e3c1;
        }
        .promo-section.thank-you-box {
            width: 100%;
            max-width: 960px;
            border-radius: 5px;
            height: auto;
            max-height: 0;
            visibility: hidden;
            opacity: 0;
            transition: all 0.4s ease-in;
            display: block;
            margin: 0 auto;
            text-align: center;
            overflow: hidden;
            background: transparent;
        }
        .promo-section.thank-you-box.active {
            max-height: 1000px;
            visibility: visible;
            opacity: 1;
            padding: 5px 0 0;
        }
        .promo-section.thank-you-box p {
            font: 400 16px/1.55em 'Open Sans', sans-serif;
            margin: 0 auto;
            color: #fff;
        }
        @media (min-width: 768px) {
            .promo-section.thank-you-box p {
                font-size: 15px;
            }
        }

    </style>
    @parent
@endsection

@section('top-promo-bar')
    @include('_partials.layout.holiday.homepage-top-banner',[
        'text' => 'GET 6 FREE BONUSES WORTH $924'
    ])
{{--    <section class="big-promo-banner bg-black text-white text-center relative z-10 overflow-hidden px-5 md:px-3 lg:px-5 md:px-8 py-5 md:py-14 bg-cover bg-center">--}}
{{--        <div class="container mx-auto relative z-30 max-w-lg">--}}
{{--            <a href="/shop"><img class="h-14 sm:h-16 lg:h-20 mx-auto" src="https://cdn.musora.com/image/fetch/w_400,q_auto:best/https://guitareo.s3.amazonaws.com/sales/promos/november/holiday-guitar.png" alt="guitareo black friday logo"></a>--}}
{{--            <p class="leading-tight my-3 uppercase"><strong class="">GET 6 FREE<br class="inline md:hidden"> BONUSES WORTH $924</strong></p>--}}
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
{{--                    --}}{{--                    <div class="absolute bottom-0 left-1/2 text-black rounded-full py-0.5 px-2 -my-2.5 -ml-10 select-none bg-promo"><p class="text-xs leading-none select-none"><strong>SAVE {{ round(100 - (100 * (GuitareoPrices::$guitareoMembershipAnnual / GuitareoPrices::$guitareoMembershipAnnualFull))) }}%</strong></p></div>--}}
{{--                    <a class="w-full join white smaller anchor-slide" href="#customize-anchor">JOIN GUITAREO &raquo;</a>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--        <div class="inset-0 absolute bg-center bg-cover z-0" style="background: #000 url(https://drumeo-assets.s3.amazonaws.com/promos/christmas/snow-dark.gif) center center/250px;box-shadow: 0 0 100px inset #000;"></div>--}}
{{--    </section>--}}


@endsection

@section('sticky-bar')
    @include('_partials.layout.holiday.sticky-bar', [
        'text' => 'GET 6 FREE BONUSES <br> WORTH $924',
    ])
    {{-- <div class="h-10 relative w-full block" style="background:#000 url(https://drumeo-assets.s3.amazonaws.com/promos/november/sticky-bg-cm.jpg) center center/cover;"></div> --}}
{{--    <a href="#customize-anchor" style="background: #000 url(https://drumeo-assets.s3.amazonaws.com/promos/christmas/snow-dark.gif) center center/250px;box-shadow: 0 0 10px inset #000;"--}}
{{--        class="anchor-slide promo-banner block text-center w-full transition-opacity duration-300 overflow-hidden whitespace-nowrap bg-cover bg-center shadow-md py-1 z-0 mx-auto -mt-10 text-xs">--}}
{{--        <div class="container mx-auto relative">--}}
{{--            <div class="inline-block align-middle text-center">--}}
{{--                <img class="inline-block align-middle mr-2 h-8"--}}
{{--                    src="https://cdn.musora.com/image/fetch/w_200,q_auto:best/https://guitareo.s3.amazonaws.com/sales/promos/november/holiday-guitar.png">--}}

{{--                <p class="inline-block align-middle mx-auto font-bebas text-white text-sm leading-none sm:text-lg sm:leading-none text-left">--}}
{{--                    <span class="uppercase">GET 6 FREE BONUSES <br> WORTH $924</span></p>--}}
                {{--                <div class="tzcd-smaller text-white align-middle inline-block">--}}
                {{--                    <div class="inline-block">--}}
                {{--                        <h2 class="font-extrabold leading-none text-lg">00</h2>--}}
                {{--                        <p class="leading-none uppercase font-extrabold text-xs text-promo">days</p>--}}
                {{--                    </div>--}}
                {{--                    <div class="inline-block mx-2">--}}
                {{--                        <h2 class="font-extrabold leading-none text-lg">00</h2>--}}
                {{--                        <p class="leading-none uppercase font-extrabold text-xs text-promo">hrs</p>--}}
                {{--                    </div>--}}
                {{--                    <div class="inline-block mr-2">--}}
                {{--                        <h2 class="font-extrabold leading-none text-lg">00</h2>--}}
                {{--                        <p class="leading-none uppercase font-extrabold text-xs text-promo">mins</p>--}}
                {{--                    </div>--}}
                {{--                    <div class="inline-block">--}}
                {{--                        <h2 class="font-extrabold leading-none text-lg">00</h2>--}}
                {{--                        <p class="leading-none uppercase font-extrabold text-xs text-promo">secs</p>--}}
                {{--                    </div>--}}
                {{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </a>--}}
@endsection

@section('final')
    <div id="customize-anchor" class="anchor anchor-slide"></div>
    @include('_partials.layout.holiday.homepage-bottom-membership',[
        'logo' => 'https://guitareo.s3.amazonaws.com/sales/promos/black-friday/bundles/ultimate/annual.jpg',
        'joinText' => '<strong>Join Guitareo for just $' . round(GuitareoPrices::$guitareoMembershipAnnual / 12, 2) . '/month</strong> <br class="hidden sm:inline"><strong class="text-promo">PLUS</strong> get 6 free bonuses worth $924.',
        'annualLink' => '/ecommerce/add-to-cart?products[GUITAREO-1-YEAR-MEMBERSHIP]=1&products[guitarists-survival-kit]=1&products[guitar-quest]=1&products[rhythm-and-groove]=1&products[GUITAR-SYSTEM]=1&products[AGME-JAN-2019-SEMESTER]=1&products[GTME-OCT-2018-SEMESTER]=1&redirect=/order&locked=true',
        'bonusNum' => 6,
        'tileWidth' => 'w-1/2 sm:w-1/3',
        'bonuses' => [
                        [
                            'image' => 'https://guitareo.s3.amazonaws.com/sales/promos/november/survival-kit-narrow-card-sale-site.jpg',
                            'title' => 'Survival Kit',
                            'description' => 'Electric Strings, Acoustic Strings, String Pro-Winder, 10 Assorted Picks, Tuner, Chord & Scales Book, and more!',
                            'price' => GuitareoPrices::$survivalKitFull,
                            'online-ship' => "Free Shipping"
                        ],
                        [
                            'image' => 'https://guitareo.s3.amazonaws.com/sales/promos/black-friday/bundles/ultimate/gq.jpg',
                            'title' => 'GuitarQuest',
                            'description' => 'Skip the boring stuff and start having fun! Your journey starts here.',
                            'price' => GuitareoPrices::$guitarQuestFull,
                            'online-ship' => "Lifetime Access"
                        ],
                        [
                            'image' => 'https://guitareo.s3.amazonaws.com/sales/promos/black-friday/bundles/ultimate/gs.jpg',
                            'title' => 'The Guitar System',
                            'description' => 'Transform your guitar playing with the ultimate encyclopedia of guitar lessons.',
                            'price' => GuitareoPrices::$guitarSystemFull,
                            'online-ship' => "Lifetime Access"
                        ],
                        [
                            'image' => 'https://guitareo.s3.amazonaws.com/sales/promos/black-friday/bundles/ultimate/gtme.jpg',
                            'title' => 'Guitar Technique Made Easy',
                            'description' => 'Learn the most important guitar techniques and reach total guitar freedom.',
                            'price' => GuitareoPrices::$GTMEFull,
                            'online-ship' => "Lifetime Access"
                        ],
                        [
                            'image' => 'https://guitareo.s3.amazonaws.com/sales/promos/black-friday/bundles/ultimate/agme.jpg',
                            'title' => 'Acoustic Guitar Made Easy',
                            'description' => 'Build a rock-solid foundation and get started on the acoustic guitar the right way.',
                            'price' => GuitareoPrices::$AGMEFull,
                            'online-ship' => "Lifetime Access"
                        ],
                        [
                            'image' => 'https://guitareo.s3.amazonaws.com/sales/promos/black-friday/rhythm_groove_cart.jpg',
                            'title' => 'Rhythm & Groove',
                            'description' => 'Go beyond simple strumming on the guitar.',
                            'price' => GuitareoPrices::$rhythmAndGrooveFull,
                            'online-ship' => "Lifetime Access"
                        ],
                    ],
        'monthlyLink' => '/ecommerce/add-to-cart?products[GUITAREO-1-MONTH-MEMBERSHIP]=1&redirect=/order&locked=true'
    ])
@endsection

{{--@section('start-button', '/choose-your-trial/')--}}
{{--@section('final')--}}
{{--     @include("guitareo.sales.partials._final-trial", [ "sevenDay" => true, "url" => "/choose-your-trial/" ])--}}
{{--@endsection--}}
