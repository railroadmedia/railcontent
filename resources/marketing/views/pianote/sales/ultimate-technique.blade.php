@php
    require_once resource_path('marketing/views/pianote/_partials/homepage-data.php');
@endphp
@extends('pianote._partials.global-layout')

@section('global-head')
    <title>Save 60% with the  Ultimate Technique Bundle. | Pianote</title>
    <meta property="og:title" content="Save 60% with the  Ultimate Technique Bundle">
    <meta property="og:url" content="https://www.pianote.com/song-secrets-bonus">

    <meta name="description" content="$177 for your first year!">
    <meta property="og:description" content="$177 for your first year!">

    <meta property="og:image"
        content="https://d21q7xesnoiieh.cloudfront.net/fit-in/1200x0/filters:quality(95)/marketing/pianote/promos/may/share-image-technique-bundle.jpg"
        style="display: none;">


    @include('_partials.layout._fonts')

    <link rel="stylesheet" href="{{ mix('marketing/css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('/marketing/css/tailwind-helpers.css') }}">
    <link rel="stylesheet" href="{{ asset('/marketing/parcel/drumeo/nav-footer-pianote.css') }}">
    <link rel="stylesheet" href="{{ asset('/marketing/parcel/drumeo/30dd.css') }}">
    <link rel="stylesheet" href="{{ asset('/marketing/parcel/drumeo/sales-pianote.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/@splidejs/splide@4.1.4/dist/css/splide.min.css" rel="stylesheet">
    <style>
        .tool:after,
        .tool:before {
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

        .tool:hover,
        .tool:active,
        .tool:focus {
            z-index: 100;
        }

        .tool:hover:after,
        .tool:hover:before,
        .tool:active:after,
        .tool:active:before,
        .tool:focus:after,
        .tool:focus:before {
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

        table.comparison tr td:nth-child(2) {
            background-color: #f61a30;
            text-shadow: 3px 3px #f61a30;
        }

        table.comparison tr:hover td:nth-child(2),
        table.comparison tr:nth-child(2n):hover td:nth-child(2) {
            background-color: #eb1a2f;

        }

        .timeline-container::after {
            content: '';
            position: absolute;
            width: 3px;
            background-color: #F61A30;
            top: 0;
            bottom: 0;
            transform: translate(-50%, 0);
            z-index: 0;
            left: 0;
            visibility: hidden;
        }

        .timeline-container .timeline::after {
            content: '';
            position: absolute;
            width: 20px;
            height: 20px;
            transform: translate(-50%, 0);
            background-color: #F61A30;
            top: 0;
            border-radius: 50%;
            z-index: 1;
            left: -16px;
            visibility: hidden;
        }

        @media (min-width: 768px) {
            .timeline-container .timeline::after {
                left: 50%;
                visibility: visible;
            }
        }

        @media (min-width: 768px) {

            .timeline-container::after,
            .timeline::after {
                left: 50%;
                visibility: visible;
            }
        }

        .timeline-container ul li {
            list-style-type: disc;
        }

        .timeline-container ul {
            padding-left: 20px;
        }
    </style>
@stop

@section('body-data')
    x-data ='{
        soundslice : false,
        trailer : false,
        unbox : false,
        rolandTrailer : false,
        lazyLoad: false
    }'
@endsection

@section('global-body')
    @if (!empty($promoVersion))
        @include('pianote.sales.partials._nav', [
            'subscriptionVersion' => true,
            'scrollToJoin' => true,
            'hideMenu' => true,
        ])
    @elseif(!empty($month))
        @include('pianote.sales.partials._nav', [
            'subscriptionVersion' => true,
            'fullSubscriptionVersion' => true,
            'trialVersion' => true,
            'joinUrl' => '/choose-your-trial-month',
        ])
    @else
        @include('pianote.sales.partials._nav', [
            'subscriptionVersion' => true,
            'fullSubscriptionVersion' => true,
            'trialVersion' => true,
            'joinUrl' => '/choose-plan',
        ])
    @endif

    @php
        $buttonLink =
            '/ecommerce/add-to-cart?products[PIANOTE-MEMBERSHIP-1-YEAR]=1&products[digital-chords-scales-guide]=1&products[piano-technique-made-easy]=1&products[jesus-molina-improvisation-and-musical-freedom-pack]=1&redirect=/order&locked=true&promo-code=special-discount';
    @endphp

    <section
        class="py-8 sm:py-10 lg:py-12 relative overflow-hidden text-center customize px-4 lg:px-8 relative overflow-hidden"
        style="background: #f6f8fc;">
        <div class="container mx-auto max-w-4xl">
            <h2 class="w-auto leading-tight text-center"><strong class="text-pianote">Save 60% </strong>with the<br>
                <strong>Ultimate Technique Bundle</strong>
            </h2>

            <h6 class="text-pianote uppercase py-2">
                <strong><em>
                        <span x-cloak x-data="timer()" x-init="countdown()">
                            <span x-cloak x-show="timeLeft > 0"> Only </span>
                            <span x-cloak x-show="timeLeft > 0 && day > 0"><span x-text="day"></span><span
                                    x-text="dayText"></span></span>
                            <span x-cloak x-show="timeLeft > 0 && hour > 0"><span x-text="hour"></span><span
                                    x-text="hourText"></span></span>
                            <span x-cloak x-show="timeLeft > 0"><span x-text="minute"></span><span
                                    x-text="minuteText"></span></span>
                            <span x-cloak x-show="timeLeft > 0"><span x-text="second"></span><span
                                    x-text="secondText"></span></span>
                            <span x-cloak x-show="timeLeft < 0">A Limited Time</span>
                            <span x-cloak x-show="timeLeft > 0"> Left </span>
                        </span>
                        </span>
                    </em></strong>
            </h6>

            <div class="flex flex-wrap sm:flex-nowrap items-center">
                <div class="flex w-full p-6 sm:p-0 justify-center sm:justify-start sm:w-1/2 lg:w-auto sm:order-1 lg:pl-5">
                    <img class="sm:h-auto max-w-full sm:max-w-sm lg:max-w-full transition-opacity opacity-0" loading="lazy"
                        onload="this.classList.remove('opacity-0')"
                        src="https://d21q7xesnoiieh.cloudfront.net/fit-in/1200x0/filters:quality(95)/marketing/pianote/promos/may/header.webp"
                        alt="{{ $theme }} collage image">
                </div>
                <div class="text-center sm:text-left w-full sm:w-1/2 lg:w-auto flex-shrink-0">
                    <div class="inline-block mx-auto">
                        <ul class="inline-block mx-auto fa-ul text-left pl-6 my-4 sm:my-5">
                            <li class="leading-tight mb-3"><i class="fa-li fas fa-check text-pianote"></i> Step-by-step
                                lessons </li>
                            <li class="leading-tight mb-3"><i class="fa-li fas fa-check text-pianote"></i> World-class
                                instructors</li>
                            <li class="leading-tight mb-3"><i class="fa-li fas fa-check text-pianote"></i> 1000+ Officially
                                licensed songs</li>
                            <li class="leading-tight mb-3"><i class="fa-li fas fa-check text-pianote"></i> Detailed song
                                tutorials</li>
                            <li class="leading-tight mb-3"><i class="fa-li fas fa-check text-pianote"></i> Live support</li>
                            <li class="leading-tight"><i class="fa-li fas fa-check text-pianote"></i> 3 FREE Bonuses</li>
                        </ul>
                    </div>
                    <div class="w-72 lg:w-96 mx-auto sm:mx-0">
                        <h2><s class="opacity-50">$446</s> <strong>$177</strong> <br>
                            <span class="text-sm italic">For your first year then $240/yr.</span>
                        </h2>
                       
                    </div>
                    <a class="join my-4 md:my-5 w-full md:w-10/12 lg:w-11/12 md:max-w-lg" style="padding: 18px 10px;"
                            href="{{ $buttonLink }}">
                            CLAIM YOUR OFFER
                        </a>
                        <p class="text-sm"><em>Money-back 90-day guarantee.</em></p>
                </div>
            </div>
        </div>
    </section>

    <section class="px-6 py-6 sm:py-8 text-white text-center bg-cover bg-center"
        style="background:linear-gradient(to bottom,#202F56, #060B2E);">
        <div class="container max-w-4xl mx-auto">
            <h6 class="leading-tight mb-4"><em><strong>PLUS</strong> get these special<br class="sm:hidden"> bonuses when
                    you join today.</em></h6>

            @php
                $images = [
                    'https://www.musora.com/musora-cdn/image/width=460,quality=95/https://d2vyvo0tyx8ig5.cloudfront.net/sales/2022/bonus-chords-scales.jpg',
                    'https://d21q7xesnoiieh.cloudfront.net/fit-in/460x0/filters:quality(95)/marketing/pianote/membership/homepage/2024/piano-technique-made-easy.webp',
                    'https://d21q7xesnoiieh.cloudfront.net/fit-in/460x0/filters:quality(95)/marketing/pianote/promos/may/improv-musical-freedom.jpg',
                ];
            @endphp

            <div class="inline sm:hidden">
                <div id="image-slider-mobile" class="splide" x-data="{}" x-init="new Splide('#image-slider-mobile', {
                    type: 'loop',
                    perPage: 2.5,
                    perMove: 1,
                    gap: '1rem',
                    arrows: false,
                    pagination: false,
                    drag: true,
                }).mount()">
                    <div class="splide__track">
                        <div class="splide__list">
                            @foreach ($images as $image)
                                <div class="splide__slide">
                                    <div class="w-3/4">
                                        <div class="flip-div inline-block relative w-full group"
                                            style="padding-bottom: 133%; perspective: 1000px;">
                                            <div class="text-center w-full h-full absolute"
                                                style="transform-style: preserve-3d;">
                                                <div x-ref="front"
                                                    class="border-2 border-musora front absolute z-20 overflow-hidden rounded-xl w-full h-full transition-transform duration-700"
                                                    style="backface-visibility: hidden;">
                                                    <div class="overflow-hidden rounded-xl h-full w-full bg-black bg-top bg-cover"
                                                        style="background-image:url('{{ $image }}');">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>

            <div class="font-size:0px hidden sm:inline">
                @foreach ($images as $image)
                    <div
                        class="bonus-wrap relative inline-block align-top mx-auto mb-4 lg:mb-0 px-1 md:px-3 w-1/2 sm:w-1/6">
                        <div class="flip-div inline-block relative w-full group"
                            style="padding-bottom: 133%; perspective: 1000px;">
                            <div class="text-center w-full h-full absolute" style="transform-style: preserve-3d;">
                                <div x-ref="front"
                                    class="border-2 border-musora front absolute z-20 overflow-hidden rounded-xl w-full h-full transition-transform duration-700"
                                    style="backface-visibility: hidden;">
                                    <div class="overflow-hidden rounded-xl h-full w-full bg-black bg-top bg-cover"
                                        style="background-image:url('{{ $image }}');">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

        </div>
    </section>

    <section class="px-6 py-6 sm:py-8 text-center" style="background:#FFFFFF;">
        <div class="container max-w-4xl mx-auto">
            <h3 class="pt-4"><strong>You’ve done the hard part. </strong></h3>
            <h5 class="text-pianote italic py-4">Now let’s keep the momentum going.</h5>
            <p>
                You did it.
                <br><br>
                And 30 Days to Better Technique is yours for LIFE. You should be proud, because you made the commitment to
                improve your piano technique. And look where you are now.
            </p><br>
            <p>So the question is…</p>
            <p class="py-4"><strong>Where will you go next?</strong></p>
            @php
                $gettings = [
                    [
                        'position' => 'left',
                        'img' =>
                            'https://d21q7xesnoiieh.cloudfront.net/fit-in/900x0/filters:quality(95)/marketing/pianote/promos/may/feature-02.webp',
                        'title' => '',
                        'desc' =>
                            'Technique is the bedrock for everything you do on the piano, so let’s put those new skills into practice with The Ultimate Technique Bundle. <br><br> You’ll get an exclusive discount for a year of unlimited access to Pianote PLUS some great bonus to help you solidify and build on what you’ve already learned.',
                    ],
                    [
                        'position' => 'right',
                        'img' =>
                            'https://d21q7xesnoiieh.cloudfront.net/fit-in/900x0/filters:quality(95)/marketing/pianote/promos/may/feature-03.webp',
                        'title' => 'So it’s time to have some fun.',
                        'desc' =>
                            'Keep access to the massive library of 1000+ songs and make the next 12 months the best of your piano-playing life. Put your new fingers to use by playing songs better than you thought possible.',
                    ],
                    [
                        'position' => 'left',
                        'img' =>
                            'https://d21q7xesnoiieh.cloudfront.net/fit-in/900x0/marketing/pianote/promos/may/feature-01.webp',
                        'title' => '',
                        'desc' => "And keep learning from the world’s best teachers, with courses from:<br>
                            <ul>
                                <li>Jesus Molina (improvisation legend)</li>
                                <li>Erskine Hawkins (Alicia Keys)</li>
                                <li>Victoria Theodore (Stevie Wonder, Beyoncé)</li>
                            </ul>
                            And more.",
                    ],
                ];
            @endphp
            <div class="timeline-container max-w-4xl lg:max-w-4xl mx-auto relative px-4 py-7">
                @foreach ($gettings as $key => $getting)
                    @if ($getting['position'] === 'right')
                        <div
                            class="timeline relative flex flex-col-reverse md:grid md:grid-cols-2 gap-4 md:gap-14 lg:gap-20 mb-16 md:mb-20">
                            <div class="content relative text-left md:pl-10 md:pl-0">
                                <h5 class="mb-2 md:mb-5 mt-1 md:mt-0"><strong>{{ $getting['title'] }}</strong></h5>
                                <div>{!! $getting['desc'] !!}</div>
                            </div>
                            <img class="-mt-7 rounded-lg transition-opacity opacity-0" loading="lazy"
                                onload="this.classList.remove('opacity-0')" src="{{ $getting['img'] }}"
                                alt="{{ $getting['title'] }}" />
                        </div>
                    @else
                        <div
                            class="timeline relative flex flex-col md:grid md:grid-cols-2 gap-4 md:gap-14 lg:gap-20 @if ($key !== 4) mb-16 md:mb-20 @else md:mb-0 @endif">
                            @if (empty($getting['special']))
                                <img class="-mt-7 rounded-lg transition-opacity opacity-0" loading="lazy"
                                    onload="this.classList.remove('opacity-0')" src="{{ $getting['img'] }}"
                                    alt="{{ $getting['title'] }}" />
                            @else
                                <div class="-mt-7 rounded-lg bg-cover bg-center relative aspect-16:9"
                                    style="background-image:url('{{ $getting['img'] }}')"></div>
                            @endif
                            <div class="content relative text-left md:pl-10 md:pl-0 md:mb-10">
                                <h5 class="mb-2 md:mb-5 mt-1 md:mt-0"><strong>{{ $getting['title'] }}</strong></h5>
                                <div>{!! $getting['desc'] !!}</div>
                            </div>
                        </div>
                    @endif
                @endforeach
            </div>

            <div class="hidden md:block">
                <h1 class="leading-none sm:-mt-8 sm:mb-6 text-5xl"><i class="fal fa-angle-down text-pianote"></i></h1>
            </div>

            <div class="pb-2 -mt-14 md:m-0 leading-none">
                <img class="w-20 md:w-16"
                    src="https://d21q7xesnoiieh.cloudfront.net/fit-in/900x0/filters:quality(95)/marketing/pianote/promos/may/date.svg"
                    alt="Calendar">
            </div>

            <h4 class="text-pianote italic py-2"><strong>But this offer is only available until June 10th. </strong><br>
            So click below and keep your progress going!</h4>
            <a class="join my-4 md:my-5 w-full sm:max-w-xs md:w-1/2 md:max-w-lg lg:max-w-3xl" style="padding: 16px 10px;"
                    href="{{ $buttonLink }}">
                    CLAIM YOUR OFFER
                </a>
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
        'bgSplide' => '#f61a30',
        'bgColor' => '#F6F8FC',
        'youtubeLink' => 'https://www.youtube.com/pianolessonscom/',
        'facebookLink' => 'https://facebook.com/pianoteofficial/',
        'instagramLink' => 'https://instagram.com/pianoteofficial/',
    ])

    @php
        $logo =
            'https://d21q7xesnoiieh.cloudfront.net/fit-in/400x0/filters:quality(95)/marketing/pianote/products/30-day-better-technique/better-technique-guarantee.webp';
        $guaranteeText = "We’re so confident that you’ll LOVE the improvements to your piano technique after Jordan’s course, that we’re giving you THREE times as long to put it to the test.
                        <br><br>
                        <strong>The course is 30 days, but you’ll have 90 days to try it risk-free.</strong>
                        <br><br>
                        That means you’ll have enough time to go through every lesson and play with Jordan - THREE times. And if -- after you’ve put in the work -- you don’t see real improvements to your technique... 
                        <br><br>
                        If your fingers don’t feel stronger and your hands aren’t more coordinated…
                        <br><br>
                        If you don’t enjoy playing the piano more than you did before you started…
                        <br><br>
                        Contact <u id='email'>support@pianote.com</u> within those 90 days and get a refund.";
        $guaranteeHeader = "<strong>The 90-Day “Better <br class='inline sm:hidden'> Technique” Guarantee</strong>";
    @endphp

    <div class="h-5 sm:h-10 -mt-5 sm:-mt-10 relative z-10"
        style="background: linear-gradient(to bottom right, transparent calc(50% - 1px), transparent, #00101D calc(50% + 1px));">
    </div>
    <section class="text-center text-white px-5 sm:px-6 pb-10 sm:pb-14 lg:pb-20 py-10 sm:py-14 lg:pt-32 relative z-10"
        style="background-color:#00101D; border: 1px solid #00101D">
        <div class="container max-w-6xl mx-auto">
            @include('pianote._partials._guarantee-section', [
                'containerWidth' => 'max-w-6xl',
                'imageUrl' =>
                    'https://d21q7xesnoiieh.cloudfront.net/fit-in/770x0/filters:quality(95)/marketing/pianote/products/30-day-better-technique/guarantee-collage.webp',
            ])
        </div>
    </section>
    <div class="unstick-trigger block"></div>
    <div id="customize-anchor" class="anchor"></div>
    <div id="order" class="anchor"></div>
    <div style="background:linear-gradient(to bottom,#202F56, #060B2E);">
        <section class="py-14 sm:py-24 lg:py-32 relative overflow-hidden text-white text-center customize px-4 lg:px-6">
            <div class="container mx-auto relative z-50  max-w-6xl ">
                <div class="w-full">
                    <h2 class="leading-tight mb-4"><strong class="text-pianote">Save 60% </strong>with <br>the Ultimate
                        Technique Bundle.</h2>
                    <p class="text-musora uppercase pb-4 md:pb-8">
                        <strong><em>
                                <span x-cloak x-data="timer()" x-init="countdown()">
                                    <span x-cloak x-show="timeLeft > 0"> Only </span>
                                    <span x-cloak x-show="timeLeft > 0 && day > 0"><span x-text="day"></span><span
                                            x-text="dayText"></span></span>
                                    <span x-cloak x-show="timeLeft > 0 && hour > 0"><span x-text="hour"></span><span
                                            x-text="hourText"></span></span>
                                    <span x-cloak x-show="timeLeft > 0"><span x-text="minute"></span><span
                                            x-text="minuteText"></span></span>
                                    <span x-cloak x-show="timeLeft > 0"><span x-text="second"></span><span
                                            x-text="secondText"></span></span>
                                    <span x-cloak x-show="timeLeft < 0">A Limited Time</span>
                                    <span x-cloak x-show="timeLeft > 0"> Left </span>
                                </span>
                                </span>
                            </em></strong>
                    </p>
                    <div class="bonus-wrap relative inline-block align-top mx-auto px-1 md:px-3 w-full max-w-lg">
                        <div class=" inline-block relative w-full group" style="padding-bottom: 45%;perspective: 1000px;">
                            <div class="text-center w-full h-full absolute" style="transform-style: preserve-3d;">
                                <div class="  front absolute z-20 overflow-hidden rounded-3xl w-full h-full transition-transform duration-700"
                                    style="backface-visibility: hidden;">
                                    <div class="h-full w-full bg-top bg-cover"
                                        style="background-image:url('https://www.musora.com/musora-cdn/image/width=850,quality=95/https://d2vyvo0tyx8ig5.cloudfront.net/sales/2023/pianote-annual-2w-card.png');">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <br>
                    @php
                        $items = [
                            '90-Day Guarantee',
                            'Step-by-step lessons',
                            '1000+ officially licensed songs',
                            'World-class instructors',
                            'Detailed song tutorials',
                            'Live support',
                        ];
                    @endphp

                    <section class="text-white p-4 md:px-30">
                        <div class="container max-w-3xl mx-auto flex flex-col md:flex-row md:flex-wrap justify-center">
                            @foreach ($items as $index => $item)
                                <div class="flex p-2">
                                    <p class="md:mb-2"><i class="fa fa-check text-musora"></i> {!! $item !!}</p>
                                </div>
                            @endforeach
                        </div>
                    </section>

                    <a class="join mb-6 md:mb-8 w-full sm:max-w-xs md:max-w-lg lg:max-w-xl" style="padding: 16px 10px;"
                        href="{{ $buttonLink }}">
                        CLAIM YOUR OFFER
                    </a>
                    <h5 class="text-musora mb-6 md:mb-8"><em><strong>PLUS get these special bonuses when you join today.</strong></em></h5>
                </div>
                <div style="font-size:0px">

                    @php
                        $bonuses = [
                            [
                                'image' => 'marketing/pianote/membership/homepage/2024/bonus-chords-scales.webp',
                                'title' => 'Chords & <br>Scales Book',
                                'description' => 'Your encyclopedia of piano chords & scales.',
                                'price' => floatval($productPrices['piano-chords-and-scales-guide']->price),
                                'shipping' => 'true',
                            ],
                            [
                                'image' => 'marketing/pianote/membership/homepage/2024/piano-technique-made-easy.webp',
                                'title' => 'Piano Technique<br> Made Easy',
                                'description' =>
                                    'Your ultimate guide to learning the piano. Learn EVERY scale, chord, arpeggio, and key signature.',
                                'price' => floatval($productPrices['piano-technique-made-easy']->price),
                            ],
                            [
                                'image' => 'marketing/pianote/promos/may/improv-musical-freedom.jpg',
                                'title' => 'Improvisation & Musical Freedom',
                                'description' =>
                                    'Learn to improvise from one of the best piano players in the world, Jesús Molina',
                                'price' => floatval(
                                    $productPrices['jesus-molina-improvisation-and-musical-freedom-pack']->price,
                                ),
                            ],
                        ];
                    @endphp
                    @foreach ($bonuses as $bonus)
                        <div class="bonus-wrap relative inline-block align-top mx-auto mb-4 px-1 md:px-3 @if (!empty($bonusWidth)) {{ $bonusWidth }} @else w-1/2 md:w-1/4 lg:w-1/5 @endif"
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
                    ">
                            <div class="flip-div inline-block relative w-full group"
                                style="@if (empty($bonus['bigCard'])) padding-bottom: 133%; @else padding-bottom: 103%; @endif perspective: 1000px;">
                                <div class="text-center w-full h-full absolute cursor-pointer"
                                    style="transform-style: preserve-3d;">
                                    <div x-ref="front"
                                        class="border-2 border-musora front absolute z-20 overflow-hidden rounded-xl w-full h-full transition-transform duration-700"
                                        style="@if (!empty($bonus['special'])) overflow: visible;border-color: #cda880; @endif backface-visibility: hidden;">
                                        @if (!empty($bonus['badge']))
                                            <h6
                                                class="absolute text-white top-0 left-0 w-full py-0.5 bg-{{ $theme }} font-bebas uppercase">
                                                {{ $bonus['badge'] }}</h6>
                                        @endif
                                        <div class="overflow-hidden h-full w-full bg-black bg-top bg-cover"
                                            :class="{ 'opacity-0': !lazyLoad, 'opacity-100': lazyLoad }"
                                            x-intersect.once="lazyLoad = true">
                                            <picture class="absolute inset-0 w-full h-full object-cover">
                                                <source
                                                    srcset="https://d21q7xesnoiieh.cloudfront.net/fit-in/980x0/filters:quality(95)/{{ $bonus['image'] }}"
                                                    media="(min-width: 640px)">
                                                <img src="https://d21q7xesnoiieh.cloudfront.net/fit-in/420x0/filters:quality(95)/{{ $bonus['image'] }}"
                                                    alt="Bonus Image"
                                                    class="w-full h-full object-cover opacity-0 transition-opacity"
                                                    loading="lazy" onload="this.classList.remove('opacity-0')">
                                            </picture>
                                        </div>
                                        <div
                                            class="absolute z-40 text-center top-1/2 left-1/2 text-white transition-opacity duration-300 transform -translate-x-1/2 -translate-y-1/2 visible opacity-0 group-hover:opacity-100 text-shadow-2">
                                            <i class="fas fa-arrow-right text-4xl"></i><br>
                                            <p class="text-sm"><strong>DETAILS</strong></p>
                                        </div>
                                    </div>
                                    <div x-ref="back"
                                        class="back border-2 border-musora absolute z-40 overflow-hidden rounded-xl w-full h-full transition-transform duration-700 -rotate-y-180"
                                        style="backface-visibility: hidden;">
                                        <div class="w-full h-full mx-auto text-center text-white flex flex-wrap justify-center items-center content-center p-2 md:p-3"
                                            style="background:linear-gradient(to bottom, #01050f, #021225);">
                                            <p class="leading-normal mx-auto text-sm">{!! $bonus['description'] !!}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <p class="w-full leading-normal mt-2">
                                <span style="display:inline-block;">
                                    @if (!empty($bonus['price']))
                                        <s class="opacity-40">${{ $bonus['price'] }}</s>
                                    @endif
                                    @if (!empty($bonus['customText']))
                                        <strong class="text-musora">{{ $bonus['customText'] }}</strong>
                                    @else
                                        <strong class="text-musora">FREE</strong>
                                    @endif
                                    <br>
                                    <em>
                                        @if (!empty($bonus['shipping']))
                                            Free Worldwide Shipping
                                        @else
                                            Free Online Access
                                        @endif
                                    </em>
                                </span>
                            </p>
                        </div>
                    @endforeach
                    <div class="flex flex-wrap sm:flex-nowrap justify-center items-start my-2 sm:my-4">
                        <div class="relative mb-3 sm:mb-0 mx-1 sm:mx-2 lg:mx-3">
                            <img alt="brand tile" class="hidden sm:inline-block sm:h-24 md:h-28 lg:h-36 rounded-xl"
                                src="https://d21q7xesnoiieh.cloudfront.net/fit-in/600x0/marketing/assets/drumeo-bonus.jpg">
                            <img alt="brand tile" class="sm:hidden inline-block h-44 rounded-xl"
                                src="https://d21q7xesnoiieh.cloudfront.net/fit-in/600x0/marketing/assets/drumeo-bonus-m.jpg">
                            <p class="absolute w-full text-sm lg:text-base uppercase font-bebas" style="bottom: 20%;">DRUM
                                LESSONS INCLUDED</p>
                        </div>
                        <div class="relative mb-3 sm:mb-0 mx-1 sm:mx-2 lg:mx-3">
                            <img alt="brand tile" class="hidden sm:inline-block sm:h-24 md:h-28 lg:h-36 rounded-xl"
                                src="https://d21q7xesnoiieh.cloudfront.net/fit-in/600x0/marketing/assets/guitareo-bonus.jpg">
                            <img alt="brand tile" class="sm:hidden inline-block h-44 rounded-xl"
                                src="https://d21q7xesnoiieh.cloudfront.net/fit-in/600x0/marketing/assets/guitareo-bonus-m.jpg">
                            <p class="absolute w-full text-sm lg:text-base uppercase font-bebas" style="bottom: 20%;">
                                GUITAR LESSONS INCLUDED</p>
                        </div>
                        <div class="relative mb-3 sm:mb-0 mx-1 sm:mx-2 lg:mx-3">
                            <img alt="brand tile" class="hidden sm:inline-block sm:h-24 md:h-28 lg:h-36 rounded-xl"
                                src="https://d21q7xesnoiieh.cloudfront.net/fit-in/600x0/marketing/assets/singeo-bonus.jpg">
                            <img alt="brand tile" class="sm:hidden inline-block h-44 rounded-xl"
                                src="https://dpwjbsxqtam5n.cloudfront.net/sales/2023/singeo-bonus-m.jpg">
                            <p class="absolute w-full text-sm lg:text-base uppercase font-bebas" style="bottom: 20%;">
                                SINGING LESSONS INCLUDED</p>
                        </div>
                    </div>
                </div>
                <h3 class="leading-tight mt-6 mb-1">
                    <s class="opacity-50">$446</s>
                    <strong>$177</strong> <span class="text-musora">(Save 60%)</span>
                </h3>
                <p class="text-sm mb-4 sm:mb-6">For your first year, then $240/yr.</p>
                <a class="join mb-2 w-full sm:max-w-xs md:max-w-lg" style="padding: 16px 10px;"
                    href="{{ $buttonLink }}">
                    CLAIM YOUR OFFER
                </a>
                <br>
                <a class="inline-block opacity-70 mt-1"
                    href="/ecommerce/add-to-cart?products[PIANOTE-MEMBERSHIP-1-MONTH]=1&amp;redirect=%2Forder">
                    <p><u><em>Or click here to start a monthly membership for <br class="inline-block md:hidden">$30/month.
                                (no free bonuses)</em></u></p>
                </a>
            </div>
        </section>
    </div>


    @if (!empty($promoVersion))
        @include('pianote.sales.partials._footer', [
            'minimal' => true,
        ])
    @else
        @include('pianote.sales.partials._footer')
    @endif
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script type="text/javascript" src="{{ asset('/marketing/parcel/drumeo/navigation-sales.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/@splidejs/splide@4.1.4/dist/js/splide.min.js"></script>
    <script>
    document.getElementById('email').addEventListener('click', function() {
        window.location.href = 'mailto:support@pianote.com';
    });
    </script>

    @include('_partials.components.countdown', [
        'countdownDate' => '2024-06-11 0:00:00',
        'promoVersion' => false,
    ])
    @yield('scripts')
@stop
