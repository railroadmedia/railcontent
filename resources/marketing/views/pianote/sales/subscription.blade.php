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
        <meta property="og:image" content="https://d21q7xesnoiieh.cloudfront.net/fit-in/1200x0/filters:quality(95)/marketing/pianote/membership/homepage/2023/share-image-pianote2.jpg">
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
        .splide__slide.is-active .active-bg {
            background-color:#f61a30!important;
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
        rolandTrailer : false
    }'
@endsection

@section('global-body')
    @if(!empty($promoVersion))
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
    @endif

    @php

        $bubbles = $pianote['bubbles'];
        $features = $pianote['features'];
        $slides = $pianote['slides'];
    @endphp

    @if(empty($hideHeader) || !$hideHeader)
        @if(!empty($beginnerVersion))
            @include('musora.sales.components.header-section', [
                'header' => 'Online piano lessons<br> tailored for beginners.',
                'desc' => 'Learn the piano faster with step-by-step lessons,<br class="hidden sm:inline"> friendly teachers, and songs perfect for your skill level.',
                'thumb' => 'https://d21q7xesnoiieh.cloudfront.net/fit-in/0x0/filters:quality(95)/marketing/pianote/membership/homepage/2023/header-thumb2.jpg',
                'promoThumb' => 'https://d21q7xesnoiieh.cloudfront.net/fit-in/0x0/filters:quality(95)/marketing/pianote/membership/homepage/2023/jan-thumb2.png',
                'promoThumbM' => 'https://d21q7xesnoiieh.cloudfront.net/fit-in/0x0/filters:quality(95)/marketing/pianote/membership/homepage/2023/jan-thumb-m2.jpg',
                'pointOne' => 'GREAT TEACHERS',
                'pointTwo' => 'VIDEO LESSONS',
                'pointThree' => 'FUN PRACTICE',
                'pointFour' => '1000+ SONGS',
            ])
        @elseif(!empty($songsVersion))
            @include('musora.sales.components.header-section', [
                'header' => 'Learn piano from real teachers.<br> Play your favorite songs.',
                'desc' => ' Find and play the songs you love. Download, print, and<br class="hidden sm:inline">   play 1000+ songs. Plus get flexible, fun lessons and<br class="hidden sm:inline">  unlimited personal support from real teachers.',
                'thumb' => 'https://d21q7xesnoiieh.cloudfront.net/fit-in/0x0/filters:quality(95)/marketing/pianote/membership/homepage/2023/header-thumb2.jpg',
                'promoThumb' => 'https://d21q7xesnoiieh.cloudfront.net/fit-in/0x0/filters:quality(95)/marketing/pianote/membership/homepage/2023/jan-thumb2.png',
                'promoThumbM' => 'https://d21q7xesnoiieh.cloudfront.net/fit-in/0x0/filters:quality(95)/marketing/pianote/membership/homepage/2023/jan-thumb-m2.jpg',
                'pointOne' => 'GREAT TEACHERS',
                'pointTwo' => 'VIDEO LESSONS',
                'pointThree' => 'FUN PRACTICE',
                'pointFour' => '1000+ SONGS',
            ])

        @elseif(!empty($promoPage))
            @include('musora.sales.components.header-section', [
                'boldText' => true,
                'promoHeader' => true,
                'header' => 'THE <span class="text-pianote">NEW WAY</span> TO<br> <span class="relative inline-block">LEARN PIANO<svg class="absolute left-0 right-0 bottom-0 w-full h-4 sm:h-7" xmlns="http://www.w3.org/2000/svg" width="" height="" viewBox="0 0 524 22" fill="none" style="transform: translate(0, 100%);"><path d="M1.99978 10.6328C84.053 4.08508 302.889 -3.20824 521.809 20" stroke="#f61a30" stroke-width="3" stroke-linecap="round"></path><path d="M2.17373 15.0541C83.9528 7.29382 302.406 -3.51921 521.988 15.3111" stroke="#f61a30" stroke-width="3" stroke-linecap="round"></path></svg></span>.',
                'desc' => 'Learn the piano faster with step-by-step lessons,<br class="hidden sm:inline"> a thousand songs, and unlimited personal support. ',
                'thumb' => 'https://d21q7xesnoiieh.cloudfront.net/fit-in/0x0/filters:quality(95)/marketing/pianote/membership/homepage/2023/header-thumb2.jpg',
                'promoThumb' => 'https://d21q7xesnoiieh.cloudfront.net/fit-in/0x0/filters:quality(95)/marketing/pianote/membership/homepage/2023/jan-thumb2.png',
                'promoThumbM' => 'https://d21q7xesnoiieh.cloudfront.net/fit-in/0x0/filters:quality(95)/marketing/pianote/membership/homepage/2023/jan-thumb-m2.jpg',
                'pointOne' => 'GREAT TEACHERS',
                'pointTwo' => 'VIDEO LESSONS',
                'pointThree' => 'FUN PRACTICE',
                'pointFour' => '1000+ SONGS',
            ])
        @else
            @include('musora.sales.components.header-section', [
                'header' => 'Piano lessons for<br> <span class="relative inline-block">all skill levels<svg class="absolute left-0 right-0 bottom-0 w-full h-4 sm:h-7" xmlns="http://www.w3.org/2000/svg" width="" height="" viewBox="0 0 524 22" fill="none" style="transform: translate(0, 100%);"><path d="M1.99978 10.6328C84.053 4.08508 302.889 -3.20824 521.809 20" stroke="#f61a30" stroke-width="3" stroke-linecap="round"></path><path d="M2.17373 15.0541C83.9528 7.29382 302.406 -3.51921 521.988 15.3111" stroke="#f61a30" stroke-width="3" stroke-linecap="round"></path></svg></span>.',
                'desc' => 'Learn the piano faster with step-by-step lessons,<br class="hidden sm:inline"> a thousand songs, and unlimited personal support. ',
                'thumb' => 'https://d21q7xesnoiieh.cloudfront.net/fit-in/0x0/filters:quality(95)/marketing/pianote/membership/homepage/2023/header-thumb2.jpg',
                'promoThumb' => 'https://d21q7xesnoiieh.cloudfront.net/fit-in/0x0/filters:quality(95)/marketing/pianote/membership/homepage/2023/jan-thumb2.png',
                'promoThumbM' => 'https://d21q7xesnoiieh.cloudfront.net/fit-in/0x0/filters:quality(95)/marketing/pianote/membership/homepage/2023/jan-thumb-m2.jpg',
                'pointOne' => 'GREAT TEACHERS',
                'pointTwo' => 'VIDEO LESSONS',
                'pointThree' => 'FUN PRACTICE',
                'pointFour' => '1000+ SONGS',
            ])
        @endif
    @endif

    @if(empty($trialVersion) && !empty($promoVersion))
        <section class="text-center px-5 lg:px-6 py-8 sm:py-0 text-white relative" style="background: linear-gradient(to bottom, #0B1C39, #0C1524);">
            <div class="container max-w-5xl mx-auto">
                    <h2 class="inline-block sm:hidden mb-4 sm:text-left"><strong>Imagine starting a<br class="inline sm:hidden"> resolution you <br class="inline sm:hidden"><span class="text-pianote">knew</span> would stick…</strong></h2>
                <div class="text-left flex flex-wrap sm:flex-nowrap justify-center items-start mb-5">
                    <div class="w-full sm:w-5/12 sm:order-1 bg-contain bg-top bg-no-repeat cursor-pointer autoplay-video" x-on:click="workoutVid = true;" style="    padding: 5% 9% 2% 0; background-image:url(https://d21q7xesnoiieh.cloudfront.net/fit-in/1200x0/marketing/pianote/membership/homepage/2024/pianote-promo-bundle.png);">
                        <video class="rounded-xl overflow-hidden w-full shadow-lg max-w-[210px] sm:max-w-full"
                            src="https://musora-image-processing-cdn.s3.us-east-2.amazonaws.com/marketing/pianote/membership/homepage/2024/pianote-video.mp4"
                            muted autoplay loop playsinline></video>
                    </div>
                    <div class="w-full sm:w-7/12 pr-5 lg:pr-8 mx-0 leading-normal sm:py-14 lg:py-20">
                        <div class="text-center relative">
                            <h2 class="hidden sm:inline-block py-4 sm:text-left"><strong>Imagine starting a resolution you <br class="inline sm:hidden"><span class="text-pianote">knew</span> would stick…</strong></h2>
                        </div>
                        <p class="pt-6 sm:pt-0">
                            Pianote is different from other online lessons. <br><br>
                            You won’t just watch a video and be left alone to do the hard work. Instead, you’ll get guided play-along lessons that bring the personal touch of a live class right into your living room. You’ll play alongside a REAL teacher so you’ll never have to guess what you should be doing. <br><br>
                            It will feel like they’re right there with you. <br><br>
                            <span class="text-pianote">And it works.</span> <br><br>
                            So this year, don’t just wish you could play the piano. Join Pianote and know you can. <br><br>
                            (And we’re so confident, you’ll have 90 days to try it risk-free.)<br><br>
                            Join today to save on your first year + get 8 FREE bonuses. <br><br>
                            You’ll love it.
                            <br><br>
                            <span class="flex justify-center md:justify-start">
                                <a class="join smaller pianote my-3 w-full sm:w-1/2 anchor-slide" href="#customize-anchor">GET Started <i class="fa-light fa-arrow-right"></i></a>
                            </span>
                        </p>
                    </div>

                </div>
            </div>
        </section>

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
        'workoutsBG' => 'https://d21q7xesnoiieh.cloudfront.net/fit-in/840x0/filters:quality(95)/marketing/pianote/membership/homepage/2024/workouts-card2.jpg',
    ])

    @php
        $songItems = $pianote['songItems'];
    @endphp

    @include('musora.sales.components.songs-section', [
        'header' => 'Play your favorite songs.',
        'desc' => 'You’ll have <strong>all the tools you need</strong> to make sure you never miss a note.',
        'video' => 'https://d21q7xesnoiieh.cloudfront.net/fit-in/1500x0/filters:quality(95)/marketing/pianote/membership/homepage/2023/device.png',
        'brandName' => 'Pianote',
        'bannerDesc' => 'Powered by Musora, Pianote includes full access to our communities for drums, guitar, and voice.',
    ])

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
        'badge' => 'https://d21q7xesnoiieh.cloudfront.net/fit-in/250x0/filters:quality(95)/marketing/pianote/membership/homepage/2023/piano-guarantee.png',
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
            "plusLogo" => "https://d21q7xesnoiieh.cloudfront.net/fit-in/0x0/filters:quality(95)/marketing/pianote/membership/homepage/2023/pianote-plus-logo-light.svg",
            "logo" => "https://d21q7xesnoiieh.cloudfront.net/fit-in/0x0/filters:quality(95)/marketing/pianote/membership/homepage/2023/pianote-logo-white.png",
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

    @include('musora.sales.components.order-promo-cards-section', [
        // General
        "songs" => "1000+ popular songs.",
        'buttonText' => 'GET STARTED',
        'header' => 'THE <span class="text-pianote">NEW WAY</span> TO<br> <span class="relative inline-block">LEARN PIANO<svg class="absolute left-0 right-0 bottom-0 w-full h-4 sm:h-7" xmlns="http://www.w3.org/2000/svg" width="" height="" viewBox="0 0 524 22" fill="none" style="transform: translate(0, 100%);"><path d="M1.99978 10.6328C84.053 4.08508 302.889 -3.20824 521.809 20" stroke="#f61a30" stroke-width="3" stroke-linecap="round"></path><path d="M2.17373 15.0541C83.9528 7.29382 302.406 -3.51921 521.988 15.3111" stroke="#f61a30" stroke-width="3" stroke-linecap="round"></path></svg></span>.',
        'pointOne' => 'GREAT TEACHERS',
        'pointTwo' => 'VIDEO LESSONS',
        'pointThree' => 'FUN PRACTICE',
        'pointFour' => '1000+ SONGS',
        'topBadge' => 'BEST DEAL',
        'badge' => 'https://d21q7xesnoiieh.cloudfront.net/fit-in/250x0/filters:quality(95)/marketing/pianote/membership/homepage/2024/pianote-free-shipping.png',

        // First deal
        'firstDeal'=> "Pianote Only",
        'firstDealImage' => 'https://d21q7xesnoiieh.cloudfront.net/fit-in/600x0/filters:quality(95)/marketing/pianote/membership/homepage/2024/pianote-only.jpg',
        'firstImageHeight'=> 'h-32',
        'firstDealPrice' => floatval($productPrices['pianote']->price),
        'firstDealSub' => "Save 25% on your first year. No bonuses.",
        "firstDealLink" => "/ecommerce/add-to-cart?products[pianote]=1",

        // Second deal
        'secondDeal' => "New Year’s Bundle",
        'secondDealImage' => 'https://d21q7xesnoiieh.cloudfront.net/fit-in/600x0/filters:quality(95)/marketing/pianote/membership/homepage/2024/new-year-bundle.png',
        'secondImageHeight'=> '',
        'secondDealSub' => "Join Pianote + get 8 bonuses worth $615.",
        'secondDealPrice' => floatval($productPrices['pianote-new-year']->discounted_price),
        'secondDealDiscount' => floatval($productPrices['pianote-new-year']->price),
        "secondDealLink" => "/ecommerce/add-to-cart?products[pianote-new-year]=1",
        'secondExtraBonuses' => [
            '<span class="text-pianote"><strong>BONUS</strong></span> Metronome <span class="italic">($79 value) <span class="text-pianote"><span class="line-through ">800 </span><strong>745</strong> left!</span></span>',
            '<span class="text-pianote"><strong>BONUS</strong></span> Little Book Bundle <span class="italic">($15 value)</span>',
            '<span class="text-pianote"><strong>BONUS</strong></span> Pianote Practice Planner <span class="italic">($39 value)</span>',
            '<span class="text-pianote"><strong>BONUS</strong></span> 100 Days of Practice Poster <span class="italic">($9 value)</span>',
            '<span class="text-pianote"><strong>BONUS</strong></span> New Piano Players Start Here <span class="italic">($127 value)</span>',
            '<span class="text-pianote"><strong>BONUS</strong></span> Easy Chords <span class="italic">($127 value)</span>',
            '<span class="text-pianote"><strong>BONUS</strong></span> Piano Technique Made Easy <span class="italic">($120 value)</span>',
            '<span class="text-pianote"><strong>BONUS</strong></span> Riffs & Fills <span class="italic">($99 value)</span>'
        ],
    ])

    @else
        @include('musora.sales.components.order-section-collage', [
        'logo' => 'https://d2vyvo0tyx8ig5.cloudfront.net/logo/pianote-logo-red.png',
        'header' => 'Unlimited piano lessons.<br> Direct access to real teachers.<br> 1000+ popular songs.',
        'list' => '<li class="leading-tight mb-3"><i class="fa-li fas fa-check text-pianote"></i> Trusted by ' . number_format(Prices::$students) . ' students.</li>
                    <li class="leading-tight mb-3"><i class="fa-li fas fa-check text-pianote"></i> Online piano lessons on every topic.</li>
        <li class="leading-tight mb-3"><i class="fa-li fas fa-check text-pianote"></i> Personalized feedback from real teachers.</li>
        <li class="leading-tight text-coaches max-w-xs mx-0"><i class="fa-li fas fa-check"></i> <strong>PLUS</strong> voice, guitar, and drums lessons with full access to all Musora communities.</li>',
        'image' => 'marketing/pianote/membership/homepage/2023/pianote-collage.png',
        ])

    @endif

    @include('musora.sales.components.app-section', [
        'image' => 'marketing/pianote/membership/homepage/2023/devices.png',
        'appleUrl' => 'https://apps.apple.com/us/app/musora/id1619053766?ppid=afddd5f6-fbc3-46c9-b6e4-6c9e6a6936af',
        'googleUrl' => 'https://play.google.com/store/apps/details?id=com.musoraapp&listing=pianote_previews',
    ])

    @include('pianote._partials.faq')

    @include('_partials.components.video-modal',[
        'name' => 'soundslice',
        'video' => '77f4c',
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
    <script src="https://cdn.jsdelivr.net/npm/@splidejs/splide@4.0.7/dist/js/splide.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/lazysizes/5.3.2/lazysizes.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/lazysizes/5.3.2/plugins/unveilhooks/ls.unveilhooks.min.js"></script>
    @yield('scripts')
@stop
