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

    <section class="px-4 py-7 sm:py-12 text-center" style="background:#f1f7fe;">
        <div class="container mx-auto max-w-2xl">
            <h3 class="leading-tight mb-3">
                You’ve done the hard part.<br class="hidden sm:inline">
                <strong>Keep the momentum going!</strong>
            </h3>
            <h6 class="uppercase text-pianote leading-tight"><strong>GET UNLIMITED PIANO LESSONS FOR A YEAR + 5 FREE BONUSES</strong><br class="hidden sm:inline">
                <span x-cloak x-data="timer()" x-init="countdown()">
                                                                     <span x-cloak x-show="timeLeft > 0 && day > 0"><span x-text="day"></span><span x-text="dayText"></span></span>
                                                                     <span x-cloak x-show="timeLeft > 0 && hour > 0"><span x-text="hour"></span><span x-text="hourText"></span></span>
                                                                     <span x-cloak x-show="timeLeft > 0 && day < 7"><span x-text="minute"></span><span x-text="minuteText"></span></span>
                                                                     <span x-cloak x-show="timeLeft > 0 && day < 7"><span x-text="second"></span><span x-text="secondText"></span></span>
                                                                     <span x-cloak x-show="timeLeft < 0">A Limited Time</span>
                                                                 </span>
                left!
            </h6>
            <div class="w-full mx-auto my-5 sm:my-10 px-3">
                <div class="aspect-16:9 w-full relative rounded-xl overflow-hidden">
                    <iframe class="absolute w-full h-full reset-on-close" src="//player.vimeo.com/video/840520303" frameborder="0" allowfullscreen allow="autoplay"></iframe>
                </div>
            </div>
            <p class="leading-relaxed px-3 my-5 text-left">
                <strong>Take a bow.</strong>
                <br><br>
                For the past 30 days, you’ve been building amazing habits, playing beautiful chords and having a ton of fun on the piano.
                <br><br>
                You should be proud.
                <br><br>
                And if you’re wondering what to do next, we’ve got you covered. Because we want to make your next steps just as fun (and easy) as the first ones.
                <br><br>
                So here’s your exclusive offer. Join Panote today and you’ll get:
            </p>
            <ul class="py-4 px-6 mx-auto text-left text-white rounded-xl" style="background-color:#0d1627;">
                <li class="flex items-start mb-1"><span class="mr-2"><i class="fas fa-check mr-1 text-pianote"></i></span> Unlimited access to step-by-step lessons</li>
                <li class="flex items-start mb-1"><span class="mr-2"><i class="fas fa-check mr-1 text-pianote"></i></span> Personal support from Lisa and all the teachers</li>
                <li class="flex items-start mb-1"><span class="mr-2"><i class="fas fa-check mr-1 text-pianote"></i></span> Continued access to the community forums and Live events</li>
                <li class="flex items-start mb-1"><span class="mr-2"><i class="fas fa-check mr-1 text-pianote"></i></span> A library of 1000 songs at your fingertips, complete with backing tracks</li>
                <li class="flex items-start mb-1"><span class="mr-2"><i class="fas fa-check mr-1 text-pianote"></i></span> Beautiful color posters of all the major and minor chords and scales</li>
                <li class="flex items-start mb-1"><span class="mr-2"><i class="fas fa-check mr-1 text-pianote"></i></span> The Pianote Practice Planner so you can keep this streak alive</li>
                <li class="flex items-start mb-1"><span class="mr-2"><i class="fas fa-check mr-1 text-pianote"></i></span> Lifetime access to 2 digital courses to continue your chording journey (Piano Riffs & Fills, The Power of Chords)</li>
                <li class="flex items-start"><span class="mr-2"><i class="fas fa-check mr-1 text-pianote"></i></span> Access to singing, guitar, or drum lessons included for as long as you remain a member (try them yourself or share with a friend)</li>
            </ul>
            <p class="leading-relaxed px-3 my-5 text-left">
                <strong class="text-pianote">Plus…</strong>
                <br><br>
                We’ll discount your first year by $40 as a special thank you, and you’ll have 90 days to try it risk-free.
                <br><br>
                But this offer is only available until midnight, July 9th.
                <br><br>
                So click below and keep your progress going!
            </p>
            <div class="px-3 md:px-0">
                <a class="join smaller w-full sm:w-auto max-w-xs sm:max-w-full anchor-slide" href="#customize-section">Claim Your Offer</a>
            </div>
        </div>
    </section>


    <div id="customize-section" class="anchor"></div>

    @php

        $bonuses = [
            [
        'image' => 'https://d2vyvo0tyx8ig5.cloudfront.net/sales/promos/may/Pianote_Planner_Card.jpg',
        'title' => 'Practice Planner',
        'description' => 'Always know exactly what to practice.',
        'price' => floatval($productPrices['pianote-practice-planner']->price),
        'shipping' => true,
    ],

    [
        'image' => 'https://d2vyvo0tyx8ig5.cloudfront.net/sales/promos/may/Piano_Chords_Card.jpg',
        'title' => 'Chords Poster',
        'description' => 'Hang these piano chords in your practice space.',
        'price' => floatval($productPrices['poster-chords']->price),
        'shipping' => true,
    ],
    [
        'image' => 'https://d2vyvo0tyx8ig5.cloudfront.net/sales/promos/may/Piano_Scales_Card.jpg',
        'title' => 'Scales Poster',
        'description' => 'All the major and minor piano scales in one poster.',
        'price' => floatval($productPrices['poster-scales']->price),
        'shipping' => true,
    ],
            [
            'image' => 'https://d2vyvo0tyx8ig5.cloudfront.net/sales/promos/black-friday/unlimited/piano-riffs-and-fills.jpg',
            'title' => 'Piano Riffs<br> & Fills',
            'description' => 'Learn the secrets and tips to play fills that sound complicated and advanced, but are simple to learn.',
            'price' => floatval($productPrices['piano-riffs-and-fills']->price),
            ],
    [
        'image' => 'https://d2vyvo0tyx8ig5.cloudfront.net/sales/promos/october/power_of_chords_card.jpg',
        'title' => 'The Power of Chords',
        'description' => 'Play the music you love using the power of chords.',
        'price' => floatval($productPrices['the-power-of-chords']->price),
    ],
        ]
    @endphp
    @include('musora.sales.components.order-section-bonuses', [
        'topImage' => 'https://d2vyvo0tyx8ig5.cloudfront.net/sales/2023/pianote-annual-2w-card.png',
        'header' => 'Online piano lessons<br class="inline sm:hidden"> for all skill levels.',
        'subDescription' => 'Join Pianote today and get 5 free bonuses!',
        'bonusWidth' => 'w-1/2 md:w-1/3 lg:w-1/5',
        'buttonLink' => '/ecommerce/add-to-cart?products[PIANOTE-MEMBERSHIP-1-YEAR]=1&products[piano-chords-and-scales-guide]=1&products[piano-technique-made-easy]=1&products[piano-riffs-and-fills]=1&products[faster-fingers]=1&redirect=/order&locked=true&promo-code=special',
    ])

    @include("pianote.sales.partials._footer", [
        "minimal" => true
    ])

    @include('_partials.components.countdown',[
        'countdownDate' => '2023-04-01 00:00:00',
        'promoVersion' => false
    ])
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="{{ asset('/marketing/parcel/drumeo/navigation-sales.js') }}"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.min.js"></script>
    <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/lazysizes/5.3.2/lazysizes.min.js"></script>
    <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/lazysizes/5.3.2/plugins/unveilhooks/ls.unveilhooks.min.js"></script>

    <script>
        $(document).ready(function(){

            $('.flip-div').click(function (e) {
                $(this).toggleClass('flipped');
            });
        })
    </script>
    @include('_partials.components.countdown',[
    'countdownDate' => '2023-07-10 00:00:00',
    'promoVersion' => false
    ])
@stop
