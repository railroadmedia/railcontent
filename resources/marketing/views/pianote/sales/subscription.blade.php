@php
    require_once(resource_path('marketing/views/pianote/_partials/homepage-data.php'));
@endphp

@extends('pianote._partials.global-layout')

@section('global-head')
    <title>Learn the piano anytime with real teachers. | Pianote</title>
    <meta property="og:title" content="Pianote - Learn the piano anytime with real teachers.">
    <meta property="og:url" content="https://www.pianote.com/">

    <meta name="description" content="Learn the piano anytime with step-by-step video lessons, world-class teachers, and unlimited personal support. 90-Day Guarantee.">
    <meta property="og:description" content="Learn the piano anytime with step-by-step video lessons, world-class teachers, and unlimited personal support. 90-Day Guarantee.">

    @hasSection('share-image')
        @yield('share-image')
    @else
        @if(request()->is('ultimate-lessons'))
            <meta property="og:image" content="https://d21q7xesnoiieh.cloudfront.net/fit-in/1200x0/filters:quality(95)/marketing/pianote/promos/summer-sale/the-ultimate-lessons-share-image-new.jpg ">
        @else
            <meta property="og:image" content="https://d21q7xesnoiieh.cloudfront.net/fit-in/1200x0/filters:quality(95)/marketing/pianote/membership/homepage/webp-format/share-image-pianote2.webp ">
        @endif
    @endif

    @include('_partials.layout._fonts')

    <link rel="stylesheet" href="{{ mix('marketing/css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('/marketing/css/tailwind-helpers.css') }}">
    <link rel="stylesheet" href="{{ asset('/marketing/parcel/drumeo/nav-footer-pianote.css') }}">
    <link rel="stylesheet" href="{{ asset('/marketing/parcel/drumeo/sales-pianote.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@splidejs/splide@4.1.4/dist/css/splide.min.css">
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
        .splide__slide.is-active .active-bg {
            background-color:#1B2434!important;
            color:#fff!important;
        }

        .timed-toggle .media-toggle.active {
            display:block!important;
        }
        .timed-toggle .active-toggle.active {
            border-color: #f61a30!important;
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
        workoutVid : false,
        trailer : false,
        unbox : false,
        rolandTrailer : false,
        lazyLoad: false,
        videoLoaded: false,
    }'
@endsection

@section('global-body')
    @if(!empty($shopNav))
        @include("pianote.sales.partials._nav", [
            "subscriptionVersion" => true,
            "scrollToJoin" => true,
            "cartVersion" => true
        ])
    @elseif(!empty($promoVersion))
        @include("pianote.sales.partials._nav", [
            "subscriptionVersion" => true,
            "scrollToJoin" => true,
            "hideMenu" => true,
        ])
    @elseif(!empty($month))
        @include("pianote.sales.partials._nav", [
            "subscriptionVersion" => true,
            "fullSubscriptionVersion" => true,
            "trialVersion" => true,
            "joinUrl" => '/choose-your-trial-month',
        ])
    @else
        @include("pianote.sales.partials._nav", [
            "subscriptionVersion" => true,
            "fullSubscriptionVersion" => true,
            "trialVersion" => true,
            "joinUrl" => '/choose-plan',
        ])

{{--        <section class="text-center px-5 sm:px-6 py-6 sm:py-8 lg:py-10 text-black relative" style="background-color:#f3efee;">--}}
{{--            <div class="container max-w-5xl mx-auto relative z-20">--}}
{{--                <img class="h-16 sm:h-20 lg:h-24" src="https://d21q7xesnoiieh.cloudfront.net/fit-in/720x0/filters:quality(95)/marketing/pianote/products/read-music-in-30-days/RMI30D-dark.webp">--}}
{{--                <h6 class="leading-tight mt-3 mb-1"><strong>Learn the language of music <br class="sm:hidden"> with daily guided workouts.</strong></h6>--}}
{{--                <p class="leading-tight mb-4">Save your seat in the first-ever<br class="sm:hidden"> class starting on July 1st!</p>--}}
{{--                <a href="/shop/read-music" class="join smaller">Learn More</a>--}}
{{--            </div>--}}
{{--            <picture>--}}
{{--                <source media="(min-width: 1024px)" srcset="https://d21q7xesnoiieh.cloudfront.net/fit-in/2500x0/filters:quality(95)/marketing/pianote/products/read-music-in-30-days/read-this-section-bg.webp" type="image/webp">--}}
{{--                <source media="(min-width: 768px)" srcset="https://d21q7xesnoiieh.cloudfront.net/fit-in/1500x0/filters:quality(95)/marketing/pianote/products/read-music-in-30-days/read-this-section-bg.webp" type="image/webp">--}}
{{--                <img class="absolute inset-0 w-full h-full object-cover z-10" src="https://d21q7xesnoiieh.cloudfront.net/fit-in/800x0/filters:quality(95)/marketing/pianote/products/read-music-in-30-days/read-this-section-bg.webp">--}}
{{--            </picture>--}}
{{--        </section>--}}
    @endif
    @if(!empty($bfVersion))
    @include('_partials.layout.holiday.homepage-top-banner',[
        'bg' => "url('https://d21q7xesnoiieh.cloudfront.net/fit-in/2500x0/filters:quality(95)/marketing/pianote/promos/summer-sale/header-bg.webp')",
        'text' => 'get lessons, accessories, and merch.<br> <strong class="text-[#FFD600]">SAVE UP TO 90% UNTIL JULY 31ST!</strong>',
        'text2' => '<span class="text-promo">Save 38%</span> on your Drumeo Membership<br> + get 10 free bonuses worth $1233.94.',
        'vimeo' => '885338636',
        'orderUrl' => '/ecommerce/add-to-cart?products[DLM-1-year]=1&products[quietpad]=1&products[Drumeo-VaterSticks]=1&products[drum-technique-made-easy-pack]=1&products[four-weeks-to-better-drum-fills]=1&products[GHFAL-DIGI]=1&products[SD-DIGI]=1&products[rock-drumming-masterclass-pack]=1&products[independence-made-easy-pack]=1&products[electrify-your-drumming]=1&products[learn-songs-faster-pack]=1&locked=true&promo-code=FREE-W-ANNUAL-6702',
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
          $features = $pianote['features'];
          $slides = $pianote['slides'];
    @endphp

    @if(empty($hideHeader) || !$hideHeader)
        @if(!empty($beginnerVersion))
            @include('musora.sales.components.header-section', [
                'header' => 'Online piano lessons<br> tailored for beginners.',
                'desc' => 'Learn the piano faster with step-by-step lessons,<br class="hidden sm:inline"> friendly teachers, and songs perfect for your skill level.',
                'thumb' => 'https://d21q7xesnoiieh.cloudfront.net/fit-in/800x0/filters:quality(95)/marketing/pianote/membership/homepage/webp-format/header-thumb2.webp',
                'promoThumb' => 'https://d21q7xesnoiieh.cloudfront.net/fit-in/800x0/filters:quality(95)/marketing/pianote/membership/homepage/webp-format/jan-thumb2.webp',
                'promoThumbM' => 'https://d21q7xesnoiieh.cloudfront.net/fit-in/800x0/filters:quality(95)/marketing/pianote/membership/homepage/webp-format/jan-thumb-m2.webp',
                'pointOne' => 'GREAT TEACHERS',
                'pointTwo' => 'VIDEO LESSONS',
                'pointThree' => 'FUN PRACTICE',
                'pointFour' => '1000+ SONGS',
            ])
        @elseif(!empty($songsVersion))
            @include('musora.sales.components.header-section', [
                'header' => 'Learn piano from real teachers.<br> Play your favorite songs.',
                'desc' => ' Find and play the songs you love. Download, print, and<br class="hidden sm:inline">   play 1000+ songs. Plus get flexible, fun lessons and<br class="hidden sm:inline">  unlimited personal support from real teachers.',
                'thumb' => 'https://d21q7xesnoiieh.cloudfront.net/fit-in/800x0/filters:quality(95)/marketing/pianote/membership/homepage/webp-format/header-thumb2.webp',
                'promoThumb' => 'https://d21q7xesnoiieh.cloudfront.net/fit-in/800x0/filters:quality(95)/marketing/pianote/membership/homepage/webp-format/jan-thumb2.webp',
                'promoThumbM' => 'https://d21q7xesnoiieh.cloudfront.net/fit-in/800x0/filters:quality(95)/marketing/pianote/membership/homepage/webp-format/jan-thumb-m2.webp',
                'pointOne' => 'GREAT TEACHERS',
                'pointTwo' => 'VIDEO LESSONS',
                'pointThree' => 'FUN PRACTICE',
                'pointFour' => '1000+ SONGS',
            ])

        @elseif(!empty($promoPage))
            @include('musora.sales.components.header-section', [
                'boldText' => true,
                'promoHeader' => true,
                'header' => 'THE <span class="text-pianote">NEW WAY</span> TO<br> <span class="relative inline-block">LEARN PIANO<svg class="absolute left-0 right-0 bottom-0 w-full h-4 sm:h-7" xmlns="http://www.w3.org/2000/svg" width="100%" height="100%" viewBox="0 0 524 22" fill="none" style="transform: translate(0, 100%);"><path d="M1.99978 10.6328C84.053 4.08508 302.889 -3.20824 521.809 20" stroke="#f61a30" stroke-width="3" stroke-linecap="round"></path><path d="M2.17373 15.0541C83.9528 7.29382 302.406 -3.51921 521.988 15.3111" stroke="#f61a30" stroke-width="3" stroke-linecap="round"></path></svg></span>.',
                'desc' => 'Learn the piano faster with step-by-step lessons,<br class="hidden sm:inline"> a thousand songs, and unlimited personal support. ',
                'thumb' => 'https://d21q7xesnoiieh.cloudfront.net/fit-in/800x0/filters:quality(95)/marketing/pianote/membership/homepage/webp-format/header-thumb2.webp',
                'promoThumb' => 'https://d21q7xesnoiieh.cloudfront.net/fit-in/800x0/filters:quality(95)/marketing/pianote/membership/homepage/webp-format/jan-thumb2.webp',
                'promoThumbM' => 'https://d21q7xesnoiieh.cloudfront.net/fit-in/800x0/filters:quality(95)/marketing/pianote/membership/homepage/webp-format/jan-thumb-m2.webp',
                'pointOne' => 'GREAT TEACHERS',
                'pointTwo' => 'VIDEO LESSONS',
                'pointThree' => 'FUN PRACTICE',
                'pointFour' => '1000+ SONGS',
            ])
        @else
            @include('musora.sales.components.header-section', [
                'header' => 'Piano lessons for<br> <span class="relative inline-block">all skill levels<svg class="absolute left-0 right-0 bottom-0 w-full h-4 sm:h-7" xmlns="http://www.w3.org/2000/svg" width="100%" height="100%" viewBox="0 0 524 22" fill="none" style="transform: translate(0, 100%);"><path d="M1.99978 10.6328C84.053 4.08508 302.889 -3.20824 521.809 20" stroke="#f61a30" stroke-width="3" stroke-linecap="round"></path><path d="M2.17373 15.0541C83.9528 7.29382 302.406 -3.51921 521.988 15.3111" stroke="#f61a30" stroke-width="3" stroke-linecap="round"></path></svg></span>.',
                'desc' => 'Learn the piano faster with step-by-step lessons,<br class="hidden sm:inline"> a thousand songs, and unlimited personal support. ',
                'thumb' => 'https://d21q7xesnoiieh.cloudfront.net/fit-in/800x0/filters:quality(95)/marketing/pianote/membership/homepage/webp-format/header-thumb2.webp',
                'promoThumb' => 'https://d21q7xesnoiieh.cloudfront.net/fit-in/800x0/filters:quality(95)/marketing/pianote/membership/homepage/webp-format/jan-thumb2.webp',
                'promoThumbM' => 'https://d21q7xesnoiieh.cloudfront.net/fit-in/800x0/filters:quality(95)/marketing/pianote/membership/homepage/webp-format/jan-thumb-m2.webp',
                'pointOne' => 'GREAT TEACHERS',
                'pointTwo' => 'VIDEO LESSONS',
                'pointThree' => 'FUN PRACTICE',
                'pointFour' => '1000+ SONGS',
            ])
        @endif
    @endif


    @hasSection('promo-banner')
        @yield('promo-banner')
    @endif

    @php
        $gridItems = $pianote['gridItems'];
    @endphp

    @include('musora.sales.components.reason-cards-section', [
        'header' => 'Your piano goals<br class="inline sm:hidden"> start here.',
        'desc' => 'Always know <em>exactly</em> what to practice with an organized 10-level <br class="hidden sm:inline">curriculum and direct access to real teachers. ',
    ])

   @php
        $buttons = $pianote['buttons'];
        $courses = $pianote['courses'];
    @endphp

   @include('musora.sales.components.coaches-section', [
        'header' => 'Real Teachers,  <br class="sm:hidden">Real Results.',
        'desc' => 'Amplify your skills with exclusive artist <br class="hidden md:inline lg:hidden"> courses + live events with special guests.'
    ])

    @include('musora.sales.components.workouts-section', [
        'vid' => 'https://player.vimeo.com/progressive_redirect/playback/785314572/rendition/540p/file.mp4?loc=external&signature=b8d6bc7c80a784c2cc9473ae9e1389b3f9e005fbbce2568d7bd6b7d548a4c19e',
        'workoutsBG' => 'marketing/pianote/membership/homepage/2024/workouts-card3.webp',
    ])

    @php
        $songItems = $pianote['songItems'];
    @endphp

    @include('musora.sales.components.songs-section', [
        'header' => 'Play your favorite songs.',
        'desc' => 'You’ll have <strong>all the tools you need</strong> to make sure you never miss a note.',
        'video' => 'https://d21q7xesnoiieh.cloudfront.net/fit-in/1500x0/filters:quality(95)/marketing/pianote/membership/homepage/webp-format/device.webp',
        'brandName' => 'Pianote',
        'bannerDesc' => 'Powered by Musora, Pianote includes full access to our communities for drums, guitar, and voice.',
    ])

    @hasSection('promoDetails')
        @yield('promoDetails')
    @endif
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
    @if(empty($trialVersion))
    @include('musora.sales.components.guarantee-section', [
        'badge' => 'marketing/pianote/membership/homepage/webp-format/piano-guarantee.webp',
        'header' => '<strong>Happy student guarantee.</strong><br>Test-drive your lessons for 90 days. Zero risk.',
        'desc' => 'Online lessons can be intimidating. Maybe you’re wondering if they work, or if you’ll use them enough – or if you’ll even enjoy the experience. So we’re removing the risk with our 90-day guarantee. More than anything, we want to make sure you have a POSITIVE experience developing new skills and gaining confidence on the piano.',
    ])
    @endif
    <div class="unstick-trigger block"></div>
    <div id="customize-anchor" class="anchor"></div>
    <div id="order" class="anchor"></div>
    @hasSection('final')
        @yield('final')
    @elseif(!empty($trialVersion))
       @include('musora.sales.components.card-selection-section', [
            "noSelector" => true,
            "plusLogo" => "https://d21q7xesnoiieh.cloudfront.net/filters:quality(95)/marketing/pianote/membership/homepage/2023/pianote-plus-logo-light.svg",
            "logo" => "https://d21q7xesnoiieh.cloudfront.net/filters:quality(95)/marketing/pianote/membership/homepage/2023/pianote-logo-white.png",
            "songs" => "1000+ popular songs.",
            "firstPoint" => "Unlimited piano lessons.",
            "thirdPoint" => "Direct access to real teachers.",
            "fifthPoint" => "Lesson access for singing, guitar, and drums.",
            "plusAnnualLink" => "/ecommerce/add-to-cart?products[PIANOTE-MEMBERSHIP-TRIAL-7-DAY-ANNUAL]=1&promo-code=annual-trial&redirect=/order&locked=true",
            "plusMonthlyLink" => "/ecommerce/add-to-cart?products[PIANOTE-MEMBERSHIP-TRIAL]=1&redirect=/order&locked=true",
            "annualLink" => "/ecommerce/add-to-cart?products[pianote-base-annual-recurring-7-day-trial-membership]=1&promo-code=annual-trial&redirect=/order&locked=true",
            "monthlyLink" => "/ecommerce/add-to-cart?products[pianote-base-monthly-recurring-7-day-trial-membership]=1&redirect=/order&locked=true",
        ])
        @include('musora.sales.components.trial-explanation', [
            'instrument' => 'piano',
        ])

    @elseif(!empty($promoVersion))
        @php
            $bonuses = [
                [
                    'image' => 'marketing/pianote/membership/homepage/2024/bonus-chords-scales.webp',
                    'title' => 'Chords & <br>Scales Book',
                    'description' => 'Your encyclopedia of piano chords & scales.',
                    'price' => floatval($productPrices['piano-chords-and-scales-guide']->price),
                    'shipping' => 'true'
                ],
                [
                'image' => 'marketing/pianote/membership/homepage/2024/piano-technique-made-easy.webp',
                'title' => 'Piano Technique<br> Made Easy',
                'description' => 'Your ultimate guide to learning the piano. Learn EVERY scale, chord, arpeggio, and key signature.',
                'price' => floatval($productPrices['piano-technique-made-easy']->price),
                ],
                [
                'image' => 'marketing/pianote/membership/homepage/2024/piano-riffs-and-fills.webp',
                'title' => 'Piano Riffs<br> & Fills',
                'description' => 'Learn the secrets and tips to play fills that sound complicated and advanced, but are simple to learn.',
                'price' => floatval($productPrices['piano-riffs-and-fills']->price),
                ],
                [
                    'image' => 'marketing/pianote/membership/homepage/2024/faster-fingers.webp',
                    'title' => '',
                    'description' => 'Boost your speed and confidence with this guided practice course.',
                    'price' => floatval($productPrices['faster-fingers']->price),
                ],
            ]
        @endphp
        @include('musora.sales.components.order-section-bonuses', [
        'topImage' => 'marketing/pianote/membership/homepage/webp-format/pianote-annual-2w-card.webp',
        'header' => 'Online piano lessons for all skill levels.',
        'subDescription' => 'Save 17% + get 4 bonuses<br class="inline sm:hidden"> worth $357',
        'buttonLink' => '/ecommerce/add-to-cart?products[PIANOTE-MEMBERSHIP-1-YEAR]=1&products[piano-chords-and-scales-guide]=1&products[piano-technique-made-easy]=1&products[piano-riffs-and-fills]=1&products[faster-fingers]=1&redirect=/order&locked=true&promo-code=special',
        'altButtonLink' => '/ecommerce/add-to-cart?products[PIANOTE-MEMBERSHIP-1-MONTH]=1&redirect=%2Forder',
        ])
    @else
        @include('musora.sales.components.order-section-collage', [
        'logo' => 'marketing/pianote/membership/homepage/2024/pianote-logo-red.webp',
        'header' => 'Unlimited piano lessons.<br> Direct access to real teachers.<br> 1000+ popular songs.',
        'list' => '<li class="leading-tight mb-3"><i class="fa-li fas fa-check text-pianote"></i> Trusted by ' . number_format(Prices::$students) . ' students.</li>
                    <li class="leading-tight mb-3"><i class="fa-li fas fa-check text-pianote"></i> Online piano lessons on every topic.</li>
        <li class="leading-tight mb-3"><i class="fa-li fas fa-check text-pianote"></i> Personalized feedback from real teachers.</li>
        <li class="leading-tight text-coaches max-w-xs mx-0"><i class="fa-li fas fa-check"></i> <strong>PLUS</strong> voice, guitar, and drums lessons with full access to all Musora communities.</li>',
        'image' => 'marketing/pianote/membership/homepage/2023/pianote-collage.png',
        ])

    @endif

    @include('musora.sales.components.app-section', [
        'image' => 'marketing/pianote/membership/homepage/webp-format/devices.webp',
        'appleUrl' => 'https://apps.apple.com/us/app/musora-the-music-lessons-app/id1460388277',
        'googleUrl' => 'https://play.google.com/store/apps/details?id=com.drumeo',
    ])

    @include('pianote._partials.faq')

    @include('_partials.components.video-modal',[
        'name' => 'soundslice',
        'video' => '4JGlc',
        'soundslice' => true,
    ])
    @include('_partials.components.video-modal',[
        'name' => 'workoutVid',
        'video' => '886960702',
        'vimeo' => true,
    ])
    @include('_partials.components.video-modal',[
        'name' => 'trailer',
        'video' => '785314388',
        'vimeo' => true,
    ])
    @include('_partials.components.video-modal',[
        'name' => 'unbox',
        'video' => '774408046',
        'vimeo' => true,
    ])

    @if(!empty($promoVersion))
        @include("pianote.sales.partials._footer", [
            "minimal" => true
        ])
    @else
        @include("pianote.sales.partials._footer")
    @endif

    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script type="text/javascript" src="{{ asset('/marketing/parcel/drumeo/navigation-sales.js') }}"></script>
    <script type="text/javascript" src="{{ asset('/marketing/parcel/drumeo/songs-toggler.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/@splidejs/splide@4.1.4/dist/js/splide.min.js"></script>
    @yield('scripts')
@stop
