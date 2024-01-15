@php
    require_once(resource_path('marketing/views/drumeo/_partials/homepage-data.php'));
@endphp

@extends('drumeo._partials.global-layout')

@section('global-head')
    <title>Drumeo | Reach your drumming goals.</title>
    <meta property="og:title" content="Drumeo | Reach your drumming goals.">
    <meta property="og:url" content="https://www.drumeo.com/">

    <meta name="description" content="Learn the drums faster with organized video lessons, legendary teachers, and better practice tools. 90-Day Guarantee.">
    <meta property="og:description" content="Learn the drums faster with organized video lessons, legendary teachers, and better practice tools. 90-Day Guarantee.">

    @hasSection('share-image')
        @yield('share-image')
    @else
        <meta property="og:image" content="https://d21q7xesnoiieh.cloudfront.net/fit-in/1200x0/filters:quality(95)/marketing/drumeo/membership/homepage/2024/share-image-drumeo.webp">
    @endif

    <link rel="stylesheet" href="{{ mix('marketing/css/app.css') }}">
    <link href="{{ asset('/marketing/parcel/drumeo/navigation-sales.css') }}" rel="stylesheet">
    <link href="{{ asset('/marketing/css/tailwind-helpers.css') }}" rel="stylesheet">
    <link href="{{ asset('/marketing/parcel/drumeo/sales-2020.css') }}" rel="stylesheet">
    <link rel="preload" href="https://cdn.jsdelivr.net/npm/@splidejs/splide@4.1.4/dist/css/splide.min.css" as="style" onload="this.rel='stylesheet'">
    <noscript><link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@splidejs/splide@4.1.4/dist/css/splide.min.css"></noscript>
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
            fill: #0B76DB !important;
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
                border-color:#0b76db!important;
                background-color:#0c2949!important;
            }
            .option-buttons.active .radio-check {
                border-color:#0b76db!important;
                background-color:#0b76db!important;
            }
            .option-buttons.active .radio-check i {
                display:block!important;
            }
        @endif
        .splide__slide.is-active .active-bg {
            background-color:#1B2434!important;
            color:#fff!important;
        }

        .timed-toggle .media-toggle.active {
            display:block!important;
        }
        .timed-toggle .active-toggle.active {
            border-color: #0b76db!important;
            background-color:#151f31!important;
        }
        .timed-toggle .active-toggle.active .description {
            max-height:100px!important;
        }
    </style>
@stop

@section('body-data')
    x-data ='{
        soundslice : false,
        trailer : false,
        lazyLoad: false,
        videoLoaded: false,
    }'
@endsection

@section('global-body')
    @if(!empty($promoVersion))
        @include("drumeo.sales.partials._nav", [
            "subscriptionVersion" => true,
            "scrollToJoin" => true,
            "hideMenu" => true,
        ])
    @elseif(!empty($month))
        @include("drumeo.sales.partials._nav", [
            "subscriptionVersion" => true,
            "fullSubscriptionVersion" => true,
            "trialVersion" => true,
            "joinUrl" => '/choose-your-trial-month',
        ])

    @else
        @include("drumeo.sales.partials._nav", [
            "subscriptionVersion" => true,
            "fullSubscriptionVersion" => true,
            "trialVersion" => true,
            "joinUrl" => '/choose-plan',
        ])
    @endif

    @php
       $bubbles =  [
            [
                'src' => $bubble1,
                'classes' => 'h-10 sm:h-14 lg:h-16 top-[53%] sm:top-[53%] left-[4%] sm:left-[4%]',
            ],
            [
                'src' => $bubble2,
                'classes' => 'h-24 sm:h-28 lg:h-44 top-[13%] sm:top-[21%] left-[8%] sm:left-[10%]',
            ],
            [
                'src' => $bubble3,
                'classes' => 'h-32 sm:h-40 lg:h-52 top-[84%] sm:top-[81%] left-[9%] sm:left-[18%]',
            ],
            [
                'src' => $bubble4,
                'classes' => 'h-10 sm:h-12 lg:h-16 top-[13%] sm:top-[13%] left-[31%] sm:left-[31%]',
            ],
            [
                'src' => $bubble5,
                'classes' => 'h-10 sm:h-12 lg:h-16 top-[8%] sm:top-[8%] left-[58%] sm:left-[58%]',
            ],
            [
                'src' => $bubble6,
                'classes' => 'h-28 sm:h-32 lg:h-48 top-[88%] sm:top-[88%] left-[90%] sm:left-[78%]',
            ],
            [
                'src' => $bubble7,
                'classes' => 'h-28 sm:h-36 lg:h-52 top-[13%] sm:top-[18%] left-[93%] sm:left-[87%]',
            ],
            [
                'src' => $bubble8,
                'classes' => 'h-12 sm:h-14 lg:h-16 top-[63%] sm:top-[63%] left-[99%] sm:left-[99%]',
            ]
        ];
       $slides = $drumeo['slides'];
    @endphp

    @if(!empty($beginnerVersion))
        @include('musora.sales.components.header-section', [
            'header' => 'Learn beginner beats, fills<br> and songs on the drums.',
            'desc' => 'Try Drumeo’s award-winning online drum lessons for 7 days FREE:',
            'thumb' => 'https://d21q7xesnoiieh.cloudfront.net/filters:quality(95)/marketing/drumeo/membership/homepage/2024/jan-thumb-no-badge.webp',
            'promoThumb' => 'https://d21q7xesnoiieh.cloudfront.net/filters:quality(95)/marketing/drumeo/membership/homepage/2024/header-thumb-promo2.webp',
            'promoThumbM' => 'https://d21q7xesnoiieh.cloudfront.net/filters:quality(95)/marketing/drumeo/membership/homepage/2024/header-thumb-promo-m2.webp',
            'pointOne' => 'GREAT TEACHERS',
            'pointTwo' => 'VIDEO LESSONS',
            'pointThree' => 'FUN PRACTICE',
            'pointFour' => '6000+ SONGS',
        ])
    @elseif(!empty($promoPage))
        @include('musora.sales.components.header-section', [
            'noExcuse' => true,
            'promoHeader' => true,
            'noCheck' => true,
            'header' => 'EVERYTHING<br class="sm:hidden"> YOU NEED<br class="hidden sm:inline"> TO<br class="sm:hidden"> <span class="relative inline-block">LEARN THE DRUMS<svg class="absolute left-0 right-0 bottom-0 w-full h-4 sm:h-7" xmlns="http://www.w3.org/2000/svg" width="100%" height="100%" viewBox="0 0 524 22" fill="none" style="transform: translate(0, 100%);"><path d="M1.99978 10.6328C84.053 4.08508 302.889 -3.20824 521.809 20" stroke=" #0b76db " stroke-width="3" stroke-linecap="round"></path><path d="M2.17373 15.0541C83.9528 7.29382 302.406 -3.51921 521.988 15.3111" stroke=" #0b76db " stroke-width="3" stroke-linecap="round"></path></svg></span>.',
            'desc' => 'Learn the drums faster with step-by-step lessons,<br class="hidden sm:inline"> thousands of songs and unlimited personal support.',
            'thumb' => 'https://d21q7xesnoiieh.cloudfront.net/fit-in/filters:quality(95)/marketing/drumeo/membership/homepage/2024/jan-thumb-no-badge.webp',
            'promoThumb' => 'https://d21q7xesnoiieh.cloudfront.net/filters:quality(95)/marketing/drumeo/membership/homepage/2024/header-thumb-promo2.webp',
            'promoThumbM' => 'https://d21q7xesnoiieh.cloudfront.net/filters:quality(95)/marketing/drumeo/membership/homepage/2024/header-thumb-promo-m2.webp',
            'pointOne' => 'GREAT TEACHERS',
            'pointTwo' => 'VIDEO LESSONS',
            'pointThree' => 'FUN PRACTICE',
            'pointFour' => '6000+ SONGS',
        ])
    @else
        @include('musora.sales.components.header-section', [
            'noExcuse' => true,
            'promoHeader' => true,
            'header' => 'EVERYTHING<br class="sm:hidden"> YOU NEED<br class="hidden sm:inline"> TO<br class="sm:hidden"> <span class="relative inline-block">LEARN THE DRUMS<svg class="absolute left-0 right-0 bottom-0 w-full h-4 sm:h-7" xmlns="http://www.w3.org/2000/svg" width="100%" height="100%" viewBox="0 0 524 22" fill="none" style="transform: translate(0, 100%);"><path d="M1.99978 10.6328C84.053 4.08508 302.889 -3.20824 521.809 20" stroke=" #0b76db " stroke-width="3" stroke-linecap="round"></path><path d="M2.17373 15.0541C83.9528 7.29382 302.406 -3.51921 521.988 15.3111" stroke=" #0b76db " stroke-width="3" stroke-linecap="round"></path></svg></span>.',
            'desc' => 'Learn the drums faster with step-by-step lessons,<br class="hidden sm:inline"> thousands of songs and unlimited personal support.',
            'thumb' => 'https://d21q7xesnoiieh.cloudfront.net/filters:quality(95)/marketing/drumeo/membership/homepage/2024/jan-thumb-no-badge.webp',
            'promoThumb' => 'https://d21q7xesnoiieh.cloudfront.net/filters:quality(95)/marketing/drumeo/membership/homepage/2024/header-thumb-promo2.webp',
            'promoThumbM' => 'https://d21q7xesnoiieh.cloudfront.net/filters:quality(95)/marketing/drumeo/membership/homepage/2024/header-thumb-promo-m2.webp',
            'pointOne' => 'GREAT TEACHERS',
            'pointTwo' => 'VIDEO LESSONS',
            'pointThree' => 'FUN PRACTICE',
            'pointFour' => '6000+ SONGS',
        ])
    @endif

    @if(empty($trialVersion) && !empty($promoVersion))
       <section style="background: linear-gradient(to bottom, #0B1C39, #0C1524); position: relative;">
            <img class="w-full inline sm:hidden opacity-0 transition-opacity" loading="lazy" onload="this.classList.remove('opacity-0')"
                src="https://d21q7xesnoiieh.cloudfront.net/fit-in/800x0/filters:quality(95)/marketing/drumeo/membership/homepage/2024/promo-collage.webp"
                alt="drum kit image">

            <div class="text-center px-5 sm:px-6 py-4 sm:py-8 lg:py-14 text-white relative overflow-hidden">
                <div class="container max-w-5xl mx-auto lg:flex items-baseline">
                    <div class="text-left flex flex-wrap sm:flex-nowrap lg:justify-center items-start mb-5">
                        <div class="max-w-3xl sm:max-w-xl lg:max-w-2xl mx-0 z-10 sm:pr-20">
                            <div class="flex justify-around sm:justify-start mb-10">
                                <div class="flex items-center sm:pr-4">
                                    <img class="h-4 sm:h-10 mr-1 opacity-0 transition-opacity" loading="lazy" onload="this.classList.remove('opacity-0')"
                                        src="https://d21q7xesnoiieh.cloudfront.net/fit-in/300x0/filters:quality(95)/marketing/drumeo/membership/homepage/2024/checkmark.svg"
                                        alt="checkmark icon">
                                    <h3 class="uppercase"><strong>Lessons</strong></h3>
                                </div>
                                <div class="flex items-center sm:pr-4">
                                    <img class="h-4 sm:h-10 mr-1 opacity-0 transition-opacity" loading="lazy" onload="this.classList.remove('opacity-0')"
                                        src="https://d21q7xesnoiieh.cloudfront.net/fit-in/300x0/filters:quality(95)/marketing/drumeo/membership/homepage/2024/checkmark.svg"
                                        alt="checkmark icon">
                                    <h3 class="uppercase"><strong>Songs</strong></h3>
                                </div>
                                <div class="flex items-center sm:pr-4">
                                    <img class="h-4 sm:h-10 mr-1 opacity-0 transition-opacity" loading="lazy" onload="this.classList.remove('opacity-0')"
                                        src="https://d21q7xesnoiieh.cloudfront.net/fit-in/300x0/filters:quality(95)/marketing/drumeo/membership/homepage/2024/checkmark.svg"
                                        alt="checkmark icon">
                                    <h3 class="text-musora uppercase relative">
                                        <strong>Drums</strong>
                                        <img class="absolute h-4"
                                            style="margin: -15px 0 0 -20px;"
                                            src="https://d21q7xesnoiieh.cloudfront.net/fit-in/500x0/filters:quality(95)/marketing/drumeo/membership/homepage/2024/new.svg"
                                            alt="New sign icon">
                                    </h3>
                                </div>
                            </div>
                            <p class="leading-normal">
                                Start the year right with the NEW Drumeo.
                                <br><br>
                                For the first time ever, you can get one year of unlimited drum lessons plus your choice of an e-kit bundle OR practice kit bundle (drums or no drums):
                                <br><br>
                                <span class="text-musora"><strong>1. The Practice Anywhere Bundle</strong></span><br>
                                With unlimited drum lessons for a year + a portable practice rig for any room in your
                                house.<br><br>
                                <span class="text-musora"><strong>2. The NEW Drumeo E-Kit Bundle</strong></span><br>
                                The highest-rated entry-level e-kit combined with award-winning drum lessons.<br><br>
                                If you’ve always wanted to play the drums but don’t know <strong>WHAT</strong> to practice or don’t have a <strong>PLACE</strong>
                                to practice, this is it.<br><br>
                                It’s the first time EVER that you can get lessons and gear all in one tidy (and quiet!)
                                package.<br><br>
                                Scroll down to see everything waiting for you inside Drumeo – and we’ll see you on the drums in
                                2024.<br><br>
                                <span class="flex justify-center sm:justify-start">
                                    <a class="join smaller blue my-3 w-1/2 anchor-slide" href="#customize-anchor">GET Started <i class="fa-light fa-arrow-right"></i></a>
                                </span>
                            </p>
                        </div>
                        <img class="absolute top-0 right-0 h-auto hidden sm:inline transition-opacity opacity-0"
                            style="max-width: 50%; height: auto; max-height: 80vh;"
                            loading="lazy"
                            onload="this.classList.remove('opacity-0')"
                            src="https://d21q7xesnoiieh.cloudfront.net/fit-in/1500x0/filters:quality(95)/marketing/drumeo/membership/homepage/2024/promo-collage.webp"
                            alt="drum kit image">
                    </div>
                </div>
            </div>
        </section>
    @endif

    @hasSection('promo-banner')
        @yield('promo-banner')
    @endif

    @php
        $gridItems = $drumeo['gridItems'];
    @endphp

    @include('musora.sales.components.reason-cards-section', [
        'header' => 'Your drumming goals<br class="inline sm:hidden"> start here.',
        'desc' => 'Always know <em>exactly</em> what to practice with an organized 10-level <br class="hidden sm:inline">curriculum featuring many of the world’s best teachers. ',
    ])

    @php
        $buttons = $drumeo['buttons'];

        $courses = $drumeo['courses'];
    @endphp

    @include('musora.sales.components.coaches-section', [
        'header' => 'Study with the world’s <br class="md:hidden">best drummers.',
        'desc' => 'Amplify your skills with 200+ artist courses + <br class="hidden md:inline lg:hidden">access exclusive live events with drumming legends.'
    ])

    @include('musora.sales.components.workouts-section', [
        'vid' => 'https://player.vimeo.com/progressive_redirect/playback/898668674/rendition/540p/file.mp4?loc=external&signature=d5f33375d3a16dc91641be1539d7d621d07ad049b030baa8a7f32c23e63e3ab4',
        'workoutsBG' => 'marketing/drumeo/membership/homepage/2024/workouts-card2.webp',
    ])

    @php
        $songItems = $drumeo['songItems'];
    @endphp

    @include('musora.sales.components.songs-section')

    @php
        $testimonials = $drumeo['testimonials'];
        $youtube = convertNumber(Prices::$drumeoYoutubeSubsc);
        $facebook = convertNumber(Prices::$drumeoFacebookLikes);
        $instagram = convertNumber(Prices::$drumeoInstagramFollowers);
    @endphp

    @include('musora.sales.components.testimonials-section', [
        'header' => 'drummers',
        'youtubeLink' => 'https://www.youtube.com/freedrumlessons/',
        'facebookLink' => 'https://facebook.com/drumeo/',
        'instagramLink' => 'https://instagram.com/drumeoofficial/',
    ])
    @if(empty($trialVersion))
        @include('musora.sales.components.guarantee-section', [
            'badge' => 'marketing/drumeo/membership/homepage/2024/guarantee.webp',
            'header' => '<strong>Happy student guarantee.</strong><br>Test-drive your lessons for 90 days. Zero risk.',
            'desc' => 'Online lessons can be intimidating. Maybe you’re wondering if they work, or if you’ll use them enough – or if you’ll even enjoy the experience. So we’re removing the risk with our 90-day guarantee. More than anything, we want to make sure you have a POSITIVE experience developing new skills and gaining confidence on the drums.',
        ])
    @endif
    <div class="unstick-trigger block"></div>
    <div id="customize-anchor" class="anchor"></div>
    <div id="order" class="anchor"></div>
    @if(!empty($trialVersion))
        @include('musora.sales.components.card-selection-section', [
            "noSelector" => true,
            "plusLogo" => "https://d21q7xesnoiieh.cloudfront.net/filters:quality(95)/marketing/drumeo/membership/homepage/2023/drumeoplus_logo.svg",
            "logo" => "https://d21q7xesnoiieh.cloudfront.net/filters:quality(95)/marketing/drumeo/membership/homepage/2023/logo-white.webp",
            "songs" => "6000+ popular songs.",
            "firstPoint" => "The world’s best drum lessons.",
            "thirdPoint" => "Unlimited personal support.",
            "fifthPoint" => "Lesson access for piano, guitar, and singing.",
            "plusAnnualLink" => "/ecommerce/add-to-cart?products[DLM-Trial-Annual-7-Day]=1&locked=true",
            "plusMonthlyLink" => "/ecommerce/add-to-cart?products[DLM-Trial-1-month]=1&locked=true",
            "annualLink" => "/ecommerce/add-to-cart?products[drumeo-base-annual-recurring-7-day-trial-membership]=1&locked=true",
            "monthlyLink" => "/ecommerce/add-to-cart?products[drumeo-base-monthly-recurring-7-day-trial-membership]=1&locked=true",
        ])
        @include('musora.sales.components.trial-explanation', [
            'instrument' => 'drumming',
        ])

    @elseif(!empty($evergreenVersion))
        @php
            $bonuses = [
                [
                'image' => 'https://d21q7xesnoiieh.cloudfront.net/filters:quality(95)/marketing/drumeo/membership/homepage/2024/drumsticks.webp',
                'title' => 'Drumeo Drumsticks',
                'description' => 'Drumeo 5A Drumsticks by Vater — made with hickory and extra moisture to last longer.',
                'price' => floatval($productPrices['Drumeo-VaterSticks']->price),
                'shipping' => true,
                ],
                [
                'image' => 'https://d21q7xesnoiieh.cloudfront.net/filters:quality(95)/marketing/drumeo/membership/homepage/2024/rdm.webp',
                'title' => 'Rock Drumming Masterclass',
                'description' => 'Todd Sucherman’s 26-week masterclass to help you improve your rock drumming.',
                'price' => floatval($productPrices['rock-drumming-masterclass-pack']->price),
                ],
                [
                'image' => 'https://d21q7xesnoiieh.cloudfront.net/filters:quality(95)/marketing/drumeo/membership/homepage/2024/dtme.webp',
                'title' => 'Drum Technique Made Easy',
                'description' => 'Bruce Becker’s 26-week masterclass to improve your hand & foot technique.',
                'price' => floatval($productPrices['drum-technique-made-easy-pack']->price),
                ],
                [
                'image' => 'https://d21q7xesnoiieh.cloudfront.net/filters:quality(95)/marketing/drumeo/membership/homepage/2024/ime.webp',
                'title' => 'Independence Made Easy',
                'description' => 'Jared Falk’s 26-week masterclass to unlock your musicality and freedom on the drums.',
                'price' => floatval($productPrices['independence-made-easy-pack']->price),
                ],
            ];
        @endphp



        @include('musora.sales.components.order-section-bonuses', [
        'topImage' => 'https://d21q7xesnoiieh.cloudfront.net/fit-in/800x0/filters:quality(95)/marketing/drumeo/membership/homepage/2024/drumeo-annual-2w-card.webp',
        'header' => 'Online drum lessons for all skill levels.',
        'subDescription' => 'Save 17% + get 4 bonuses<br class="inline sm:hidden"> worth $603.95',
        'buttonLink' => '/ecommerce/add-to-cart?products[DLM-1-year]=1&products[Drumeo-VaterSticks]=1&products[drum-technique-made-easy-pack]=1&products[rock-drumming-masterclass-pack]=1&products[independence-made-easy-pack]=1&locked=true&promo-code=special',
        'altButtonLink' => '/ecommerce/add-to-cart?products[DLM-1-month]=1&locked=true',
        ])
    @elseif(!empty($promoVersion))
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

     <section class="px-4 sm:px-6 pt-10 pb-20">
         <div class="container max-w-5xl mx-auto relative z-50">
             <h2 class="leading-tight mb-5 w-full text-center"><strong>E-Kit Shipping Notice</strong></h2>
             <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 w-full mx-2">
                 <p class="leading-normal text-left p-2" style="width: 100%"><strong>Free shipping USA / Canada</strong><br>
                     Your Drumeo E-Kit will ship for free anywhere in the United States and Canada. </p>

                 <p class="leading-normal text-left p-2"><strong>Global Shipping</strong><br>
                     We’ve automatically applied a $100 shipping discount that you’ll see during the checkout process. You may also need to pay duty depending on your country’s regulations.
                     <br>Australia / New Zealand: <s>$280.50</s> $180.50 shipping.
                     <br>Rest of World: <s>$160.50</s> $60.50 shipping.
                 </p>
             </div>
         </div>
     </section>
    @else
        @include('musora.sales.components.order-section-collage', [
        'logo' => 'marketing/drumeo/membership/homepage/2024/logo-blue.webp',
        'header' => 'Unlimited drum lessons.<br> The world’s best teachers.<br> 6000+ popular songs.',
        'list' => '<li class="leading-tight mb-3"><i class="fa-li fas fa-check text-drumeo"></i> Trusted by ' . number_format(Prices::$students) . ' students.</li>
                    <li class="leading-tight mb-3"><i class="fa-li fas fa-check text-drumeo"></i> Online lessons on every topic.</li>
        <li class="leading-tight mb-3"><i class="fa-li fas fa-check text-drumeo"></i> Personalized feedback from real teachers.</li>
        <li class="leading-tight text-coaches max-w-xs mx-0"><i class="fa-li fas fa-check"></i> <strong>PLUS</strong> piano, guitar, and singing lessons with full access to all Musora communities.</li>',
        'image' => 'marketing/drumeo/membership/homepage/2024/drumeo-collage.png',
        ])
    @endif

    @include('musora.sales.components.app-section', [
        'image' => 'marketing/drumeo/membership/homepage/webp-format/devices.webp',
        'appleUrl' => 'https://apps.apple.com/us/app/musora/id1619053766?platform=iphone&ppid=d63c2cf3-274f-4441-8444-a5f547b1b4b6',
        'googleUrl' => 'https://play.google.com/store/apps/details?id=com.musoraapp&listing=drumeo_previews',
    ])

    @include('drumeo._partials.faq')

    @include('_partials.components.video-modal',[
        'name' => 'soundslice',
        'video' => '1D6Vc',
        'soundslice' => true,
    ])
    @include('_partials.components.video-modal',[
        'name' => 'trailer',
        'video' => '898623255',
        'vimeo' => true,
    ])

    @if(!empty($promoVersion))
        @include("drumeo.sales.partials._footer", [
            "minimal" => true
        ])
    @else
        @include("drumeo.sales.partials._footer")
    @endif

    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script type="text/javascript" src="{{ asset('/marketing/parcel/drumeo/navigation-sales.js') }}"></script>
    <script type="text/javascript" src="{{ asset('/marketing/parcel/drumeo/songs-toggler.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/@splidejs/splide@4.1.4/dist/js/splide.min.js"></script>   
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/lazysizes/5.3.2/lazysizes.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/lazysizes/5.3.2/plugins/unveilhooks/ls.unveilhooks.min.js"></script>
    @yield('scripts')
@stop
