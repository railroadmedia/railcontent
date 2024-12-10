@php
    require_once(resource_path('marketing/views/pianote/_partials/homepage-data.php'));
@endphp

@extends('pianote._partials.global-layout')

@section('global-head')
    <title>Save 50% On Your First Year</title>
    <meta property="og:title" content="Save 50% On Your First Year">
    <meta property="og:url" content="https://www.pianote.com/">

    <meta name="description" content="We want you back – so you’ll get a 50% discount on your first year with Pianote.">
    <meta property="og:description" content="We want you back – so you’ll get a 50% discount on your first year with Pianote.">

    @hasSection('share-image')
        @yield('share-image')
    @else
        <meta property="og:image" content="https://d2vyvo0tyx8ig5.cloudfront.net/sales/2023/share-image-pianote2.jpg" style="display: none;">
    @endif

    @include('_partials.layout._fonts')

    <link rel="stylesheet" href="{{ mix('marketing/css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('/marketing/css/tailwind-helpers.css') }}">
    <link rel="stylesheet" href="{{ asset('/marketing/parcel/drumeo/nav-footer-pianote.css') }}">
    <link rel="stylesheet" href="{{ asset('/marketing/parcel/drumeo/sales-pianote.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@splidejs/splide@4.0.7/dist/css/splide.min.css">

    <style>
        .tool:after, .tool:before {
            position: absolute;
            transform: translate(-50%, 0);
            height: auto;
            max-height: 0;
            visibility: hidden;
            opacity: 0;
            transition: all .3s;
            overflow: hidden;
            font-size: 14px;
        }
        .tool:before {
            z-index: 100;
            content: "";
            bottom: 23px;
            left: 50%;
            border-right: 7px transparent solid;
            border-left: 7px transparent solid;
            border-top: 7px solid #fff;
        }
        .tool:after {
            padding: 5px 8px;
            content: attr(tip);
            font-size: 14px;
            text-align: left;
            color: #000;
            width: 220px;
            border-radius: 8px;
            background: #fff;
            box-shadow: 0 0 15px #000;
            bottom: 30px;
            left: -300%;
        }
        .tool:hover, .tool:active, .tool:focus {
            z-index: 100;
        }
        .tool:hover:after, .tool:hover:before, .tool:active:after, .tool:active:before, .tool:focus:after, .tool:focus:before {
            max-height: 1000px;
            visibility: visible;
            opacity: 1;
            display: block;
        }
        .splide__pagination__page.is-active {
            background: #01050F;
            transform: none !important;
        }

        .splide__pagination__page {
            margin: 3px 10px !important;
            opacity: 1 !important;
        }

        @media (min-width: 768px) {
            .splide__pagination__page {
                margin: 3px 6px !important;
            }
        }

        .splide__arrow svg {
            fill: #f61a30 !important;
        }

        .bubble:after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 50%;
            width: 0;
            height: 0;
            border: 5px solid transparent;
            border-top-color: black;
            border-bottom: 0;
            margin-left: -5px;
            margin-bottom: -5px;
        }

        @if(!empty($trialVersion))
            .option-buttons.active {
            border-color:#f61a30!important;
            background-color:#4a0c12 !important;
        }
        .option-buttons.active .radio-check {
            border-color:#f61a30!important;
            background-color:#f61a30!important;
        }
        .option-buttons.active .radio-check i {
            display:block!important;
        }
        @endif


    .join.green {
            background: #10D05F;

        }
        .join.green:hover,
        .join.green:focus {
            background: #13eb6d;
        }
    </style>
@stop

@section('global-body')
    @include("pianote.sales.partials._nav", [
        "subscriptionVersion" => true,
        "scrollToJoin" => true,
        "hideMenu" => true,
    ])

    <header class="sm:px-6 pb-14 pt-6 sm:pt-14 sm:pb-28 lg:pt-20 lg:pb-36 text-white" style="background:linear-gradient(to left, #F61A30, #900068);">
        <div class="container max-w-6xl mx-auto">
            <div class="flex flex-wrap sm:flex-nowrap items-center">
                <div class="w-full text-center">
                    <div class="px-5 sm:px-0">
                        <img class="h-24 sm:h-36 lg:h-48" src="https://d21q7xesnoiieh.cloudfront.net/fit-in/1360x0/filters:quality(95)/marketing/pianote/promos/may/winback-header.webp">
                        <h1 class="rotater-text my-4 lg:my-5"><strong>Save 50% On <br class="inline sm:hidden"> Your First Year</strong></h1>
                        <h6 class="leading-normal">We want you back – so you’ll get a <strong>50% discount</strong> on your first year with Pianote.
                            @if(Carbon\Carbon::now() < Carbon\Carbon::create(2024, 10, 1, 0, 0, 0, 'America/Vancouver'))
                                <br><strong class="text-musora"><em>Only available until September 30th.<br>
                                        <span x-cloak x-data="timer()" x-init="countdown()">
                                             <span x-cloak x-show="timeLeft > 0 && day > 0"><span x-text="day"></span><span x-text="dayText"></span></span>
                                             <span x-cloak x-show="timeLeft > 0"><span x-text="hour"></span><span x-text="hourText"></span></span>
                                             <span x-cloak x-show="timeLeft > 0 && day < 7"><span x-text="minute"></span><span x-text="minuteText"></span></span>
                                             <span x-cloak x-show="timeLeft > 0 && day < 7"><span x-text="second"></span><span x-text="secondText"></span></span>
                                             <span x-cloak x-show="timeLeft < 0">A Limited Time</span>
                                         </span>
                                        left!</em></strong>
                            @elseif(Carbon\Carbon::now() < Carbon\Carbon::create(2024, 10, 4, 8, 0, 0, 'America/Vancouver'))
                                <br><strong class="text-musora"><em>Only available until October 4th.<br>
                                        <span x-cloak x-data="timer()" x-init="countdown()">
                                             <span x-cloak x-show="timeLeft > 0 && day > 0"><span x-text="day"></span><span x-text="dayText"></span></span>
                                             <span x-cloak x-show="timeLeft > 0"><span x-text="hour"></span><span x-text="hourText"></span></span>
                                             <span x-cloak x-show="timeLeft > 0 && day < 7"><span x-text="minute"></span><span x-text="minuteText"></span></span>
                                             <span x-cloak x-show="timeLeft > 0 && day < 7"><span x-text="second"></span><span x-text="secondText"></span></span>
                                             <span x-cloak x-show="timeLeft < 0">A Limited Time</span>
                                         </span>
                                        left!</em></strong>
                            @else

                            @endif
                        </h6>
                        <div class="flex flex-wrap items-center justify-center sm:justify-start mt-6 sm:mt-5 mx-auto sm:max-w-xs">

{{--                            @if(Carbon\Carbon::now() < Carbon\Carbon::create(2024, 9, 12, 0, 0, 0, 'America/Vancouver'))--}}
{{--                                <span class="w-full join smaller sold-out mb-2">Opens September 12th</span>--}}
{{--                            @elseif(Carbon\Carbon::now() < Carbon\Carbon::create(2024, 10, 4, 8, 0, 0, 'America/Vancouver'))--}}
{{--                                <a class="w-full join green smaller mb-2" href="/ecommerce/add-to-cart?products[PIANOTE-MEMBERSHIP-1-YEAR]=1&locked=true&promo-code=restart">SEE YOUR DEAL &raquo;</a>--}}
{{--                            @else--}}
{{--                                <span class="w-full join smaller sold-out mb-2">this offer has now ended</span>--}}
{{--                            @endif--}}

                            <a aria-label="Review" class="inline-block" href="https://www.shopperapproved.com/reviews/Musora.com" target="_blank" onclick="window.open('https://www.shopperapproved.com/reviews/Musora.com', 'newwindow', 'width=750, height=550'); return false;">
                                <i class="align-middle text-lg fas fa-star" style="color: #ffac00;"></i>
                                <i class="align-middle text-lg -ml-3 fas fa-star" style="text-shadow: -2px -1px 1px #ba0b51;color: #ffac00;"></i>
                                <i class="align-middle text-lg -ml-3 fas fa-star" style="text-shadow: -2px -1px 1px #ba0b51;color: #ffac00;"></i>
                                <i class="align-middle text-lg -ml-3 fas fa-star" style="text-shadow: -2px -1px 1px #ba0b51;color: #ffac00;"></i>
                                <i class="align-middle text-lg -ml-3 fas fa-star" style="text-shadow: -2px -1px 1px #ba0b51;color: #ffac00;"></i>
                            </a>
                            <p class="inline-block leading-tight text-sm align-middle pl-2 m-0"><em>Trusted by {{ number_format(Prices::$students) }} active students.</em></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>

    @php
        $features = [
            [
                'image' => 'https://d2vyvo0tyx8ig5.cloudfront.net/sales/2023/piano-lesson-icon.svg',
                'title' => 'Piano Lessons',
                'desc' => 'Step-by-step video <br class="hidden sm:inline"> lessons on every topic.',
            ],
            [
                'image' => 'https://d2vyvo0tyx8ig5.cloudfront.net/sales/2023/artist-course-icon.svg',
                'title' => 'Artist Courses',
                'desc' => 'Courses and live events<br class="hidden sm:inline"> with inspiring pianists. ',
            ],
            [
                'image' => 'https://d2vyvo0tyx8ig5.cloudfront.net/sales/2023/songs-icon.svg',
                'title' => 'Popular Songs',
                'desc' => 'Play your favorite songs<br class="hidden sm:inline"> from every style & era.',
            ],
            [
                'image' => 'https://d2vyvo0tyx8ig5.cloudfront.net/sales/2023/support-icon.svg',
                'title' => '24/7 Support',
                'desc' => 'The largest community<br class="hidden sm:inline"> of students & teachers.',
            ],
        ];
    @endphp
    <div class="container max-w-4xl mx-auto -mt-10 sm:-mt-14 lg:-mt-20">
        <div class="px-5 sm:px-0">
            <div class="flex flex-wrap sm:flex-nowrap text-center border-2 rounded-xl border-{{ $theme }} bg-white relative">
                <div class="z-10 flex flex-wrap sm:flex-nowrap items-start justify-evenly w-full sm:w-auto sm:flex-grow py-4 sm:py-3 lg:py-4 lg:px-5 text-left sm:text-center">
                    @foreach ($features as $key => $feature)
                        <div class="flex sm:block w-full sm:w-auto px-4 sm:px-3 my-2 sm:mb-0">
                            <img
                                src="https://www.musora.com/musora-cdn/image/{{ $feature['image'] }}"
                                class="h-5 sm:h-7 mb-2 mr-4 sm:mr-0 transition-opacity opacity-0"
                                alt="feature image{{$key+1}}"
                                loading="lazy"
                                onload="this.classList.remove('opacity-0')"
                            >
                            <p class="leading-tight mx-0"><strong class="font-black">{{ $feature['title'] }}</strong><br>
                                <span class="text-sm">{!!  $feature['desc']  !!}</span></p>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    <section class="pt-12 md:pt-20">
        <div class="max-w-5xl mx-auto px-4 lg:px-2">
            <h3 class="font-extrabold text-center">Pianote membership<br class="inline sm:hidden"> special pricing.</h3>
            <p class="text-center mt-3 mb-6">You’ll have one year of unlimited<br class="inline sm:hidden">  piano lessons, including:</p>
            <div class="md:grid md:grid-cols-3 md:gap-4">
                <div class="relative rounded-xl overflow-hidden mb-3 md:mb-0" style="background-color:#F6F8FC;">
                    <div class="w-full aspect-16:9 bg-cover bg-center" style="background-image:url('https://d21q7xesnoiieh.cloudfront.net/fit-in/700x0/filters:quality(95)/marketing/pianote/promos/may/guided-lessons.webp')"></div>
                    <div class=" px-3 lg:px-4 py-5 lg:py-7 text-center">
                        <h4 class="leading-tight mb-3"><i class="fal fa-video text-pianote inline-block mb-1"></i><br><strong>Guided Lessons</strong></h4>
                        <p class="leading-normal">
                            Step-by-step lessons and practice alongs so you can play along with your teacher in real time.
                        </p>
                    </div>
                </div>
                <div class="relative rounded-xl overflow-hidden mb-3 md:mb-0" style="background-color:#F6F8FC;">
                    <div class="w-full aspect-16:9 bg-cover bg-center" style="background-image:url('https://d21q7xesnoiieh.cloudfront.net/fit-in/700x0/filters:quality(95)/marketing/pianote/promos/may/songs.webp')"></div>
                    <div class="px-3 lg:px-4 py-5 lg:py-7 text-center">
                        <h4 class="leading-tight mb-3"><i class="fal fa-music text-pianote inline-block mb-1"></i><br><strong>Popular Songs</strong></h4>
                        <p class="leading-normal">
                            Note-for-note breakdowns with the ability to slow things down, loop sections and use a metronome.
                        </p>
                    </div>
                </div>
                <div class="relative rounded-xl overflow-hidden" style="background-color:#F6F8FC;">
                    <div class="w-full aspect-16:9 bg-cover bg-center" style="background-image:url('https://d21q7xesnoiieh.cloudfront.net/fit-in/700x0/filters:quality(95)/marketing/pianote/promos/may/teachers.webp')"></div>
                    <div class="px-3 lg:px-4 py-5 lg:py-7 text-center">
                        <h4 class="leading-tight mb-3"><i class="fal fa-users text-pianote inline-block mb-1"></i><br><strong>Real Teachers</strong></h4>
                        <p class="leading-normal">
                            Your favorite pianists and teachers will share their tips, cheer you along, and help you learn by playing!.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    @php
        $testimonials = $pianote['testimonials'];
        $youtube = convertNumber(Prices::$pianoteYoutubeSubsc);
        $facebook = convertNumber(Prices::$pianoteFacebookLikes);
        $instagram = convertNumber(Prices::$pianoteInstagramFollowers);
    @endphp
    @include('musora.sales.components.testimonials-section', [
        'header' => 'pianists',
        'youtubeLink' => 'https://www.youtube.com/pianolessonscom/',
        'facebookLink' => 'https://facebook.com/pianoteofficial/',
        'instagramLink' => 'https://instagram.com/pianoteofficial/',
    ])

    @include('musora.sales.components.guarantee-section', [
        'badge' => 'marketing/pianote/membership/homepage/webp-format/piano-guarantee.webp',
        'header' => '<strong>Happy “welcome back” guarantee.</strong><br>Test-drive your lessons for 90 days. Zero risk.',
        'desc' => 'More than anything, we want to make sure you have a POSITIVE experience developing new skills and gaining confidence when you rejoin Pianote. Which is why you’ll have 90 days risk-free to try everything again and make sure you love it.',
    ])

    <div class="unstick-trigger block"></div>
    <div id="customize-anchor" class="anchor"></div>
    <div id="order" class="anchor"></div>
    <section class="py-14 sm:py-20 lg:py-24 relative overflow-hidden text-white text-center customize px-4 lg:px-6" style="background:linear-gradient(to left, #F61A30, #900068);">
        <div class="container mx-auto max-w-6xl relative z-50">
            <div class="w-full">
                <div class="bonus-wrap relative inline-block align-top mx-auto px-1 md:px-3 w-full max-w-xs">
                    <div class=" inline-block relative w-full group" style="padding-bottom: 62%;perspective: 1000px;">
                        <div class="text-center w-full h-full absolute" style="transform-style: preserve-3d;">
                            <div class="  front absolute z-20 overflow-hidden rounded-3xl w-full h-full transition-transform duration-700" style="backface-visibility: hidden;">
                                <div class="h-full w-full bg-top bg-contain bg-no-repeat" style="background-image:url(https://www.musora.com/musora-cdn/image/width=850,quality=95/https://d2vyvo0tyx8ig5.cloudfront.net/sales/promos/june/2023/membership-badge.png);"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <br>
                <h3 class="leading-tight mt-4 sm:mt-5"><strong>Restart your <span class="hidden sm:inline">Pianote</span> Membership<br class="hidden sm:inline">  today and save 50%.</strong></h3>
                <p class="leading-tight my-3 sm:my-4 text-musora font-black">
                    @if(Carbon\Carbon::now() < Carbon\Carbon::create(2024, 10, 1, 0, 0, 0, 'America/Vancouver'))
                        <strong><em>Only available until September 30th.<br>
                                <span x-cloak x-data="timer()" x-init="countdown()">
                                             <span x-cloak x-show="timeLeft > 0 && day > 0"><span x-text="day"></span><span x-text="dayText"></span></span>
                                             <span x-cloak x-show="timeLeft > 0"><span x-text="hour"></span><span x-text="hourText"></span></span>
                                             <span x-cloak x-show="timeLeft > 0 && day < 7"><span x-text="minute"></span><span x-text="minuteText"></span></span>
                                             <span x-cloak x-show="timeLeft > 0 && day < 7"><span x-text="second"></span><span x-text="secondText"></span></span>
                                             <span x-cloak x-show="timeLeft < 0">A Limited Time</span>
                                         </span>
                                left!</em></strong>
                    @elseif(Carbon\Carbon::now() < Carbon\Carbon::create(2024, 10, 4, 8, 0, 0, 'America/Vancouver'))
                        <strong><em>Only available until October 4th.<br>
                                <span x-cloak x-data="timer()" x-init="countdown()">
                                             <span x-cloak x-show="timeLeft > 0 && day > 0"><span x-text="day"></span><span x-text="dayText"></span></span>
                                             <span x-cloak x-show="timeLeft > 0"><span x-text="hour"></span><span x-text="hourText"></span></span>
                                             <span x-cloak x-show="timeLeft > 0 && day < 7"><span x-text="minute"></span><span x-text="minuteText"></span></span>
                                             <span x-cloak x-show="timeLeft > 0 && day < 7"><span x-text="second"></span><span x-text="secondText"></span></span>
                                             <span x-cloak x-show="timeLeft < 0">A Limited Time</span>
                                         </span>
                                left!</em></strong>
                    @else

                    @endif
                </p>

                <h3 class="leading-tight mb-1"><strong>Only</strong> <s class="opacity-50">$240</s> <strong>$120</strong></h3>
                <p class="leading-tight text-sm mb-5"><em>Renews at $240 after your first year.</em></p>
            </div>
{{--            @if(Carbon\Carbon::now() < Carbon\Carbon::create(2024, 9, 12, 0, 0, 0, 'America/Vancouver'))--}}
{{--                <span class="join sold-out">Opens September 12th</span>--}}
{{--            @elseif(Carbon\Carbon::now() < Carbon\Carbon::create(2024, 10, 4, 8, 0, 0, 'America/Vancouver'))--}}
{{--                <a class="join green" href="/ecommerce/add-to-cart?products[PIANOTE-MEMBERSHIP-1-YEAR]=1&locked=true&promo-code=restart">GET Started »</a>--}}
{{--            @else--}}
{{--                <span class="join sold-out">this offer has now ended</span>--}}
{{--            @endif--}}
        </div>
    </section>

    @include("pianote.sales.partials._footer")
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script type="text/javascript" src="{{ asset('/marketing/parcel/drumeo/navigation-sales.js') }}"></script>

    <script src="https://cdn.jsdelivr.net/npm/@splidejs/splide@4.0.7/dist/js/splide.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/lazysizes/5.3.2/lazysizes.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/lazysizes/5.3.2/plugins/unveilhooks/ls.unveilhooks.min.js"></script>
    @if(Carbon\Carbon::now() < Carbon\Carbon::create(2024, 10, 1, 0, 0, 0, 'America/Vancouver'))
        @include('_partials.components.countdown',[
        'countdownDate' => '2024-10-01 00:00:00',
        'promoVersion' => false
        ])
    @else
        @include('_partials.components.countdown',[
        'countdownDate' => '2024-10-04 00:00:00',
        'promoVersion' => false
        ])
    @endif
@stop
