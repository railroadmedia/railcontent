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
    </style>
@stop

@section('body-data')
    x-data ='{
        soundslice : false,
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
    <a href="#customize-anchor" class="flex text-white items-center justify-center py-1.5 px-2 sm:px-0 w-full z-[100] anchor-slide" style="background: linear-gradient(to bottom, #f41a30, #79080b);">
{{--        <img class="h-8 sm:h-10 mr-4" src="https://cdn.musora.com/image/fetch/w_300,q_auto:best/https://d2vyvo0tyx8ig5.cloudfront.net/products/30-day-blues-piano/30-day-blues-piano-logo-blue-glow.png" alt="30 day drummer logo" />--}}
        <h3 class="inline-block font-bebas text-musora mx-0 pr-3 uppercase whitespace-nowrap">* FREE <span class="hidden sm:inline">Chords & Scales</span> book *</h3>
        <p class="inline-block text-xs mx-0 leading-tight">
            Get <strong>a FREE Chords & Scales Book</strong> when you try
            <br class="hidden sm:inline">Pianote for 7 days. <em>Exclusive for Chord Hacks Students.</em>
        </p>
    </a>

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
                'thumb' => 'https://d21q7xesnoiieh.cloudfront.net/fit-in/0x0/filters:quality(95)/marketing/pianote/membership/homepage/webp-format/header-thumb2.webp',
                'promoThumb' => 'https://d21q7xesnoiieh.cloudfront.net/fit-in/0x0/filters:quality(95)/marketing/pianote/membership/homepage/webp-format/jan-thumb2.webp',
                'promoThumbM' => 'https://d21q7xesnoiieh.cloudfront.net/fit-in/0x0/filters:quality(95)/marketing/pianote/membership/homepage/webp-format/jan-thumb-m2.webp',
                'pointOne' => 'Perfect for Beginners',
                'pointTwo' => 'Super-Friendly Teachers',
                'pointThree' => 'Fun Lessons',
            ])
        @elseif(!empty($songsVersion))
            @include('musora.sales.components.header-section', [
                'header' => 'Learn piano from real teachers.<br> Play your favorite songs.',
                'desc' => ' Find and play the songs you love. Download, print, and<br class="hidden sm:inline">   play 1000+ songs. Plus get flexible, fun lessons and<br class="hidden sm:inline">  unlimited personal support from real teachers.',
               'thumb' => 'https://d21q7xesnoiieh.cloudfront.net/fit-in/0x0/filters:quality(95)/marketing/pianote/membership/homepage/webp-format/header-thumb2.webp',
                'promoThumb' => 'https://d21q7xesnoiieh.cloudfront.net/fit-in/0x0/filters:quality(95)/marketing/pianote/membership/homepage/webp-format/jan-thumb2.webp',
                'promoThumbM' => 'https://d21q7xesnoiieh.cloudfront.net/fit-in/0x0/filters:quality(95)/marketing/pianote/membership/homepage/webp-format/jan-thumb-m2.webp',
               'pointOne' => '1000+ popular songs',
                'pointTwo' => 'World-Class Teachers',
                'pointThree' => 'Learn anywhere, anytime',
            ])
        @else
            @include('musora.sales.components.header-section', [
                'header' => 'Online piano lessons<br> for all skill levels.',
                'underline' => true,
                'desc' => 'Learn the piano faster with step-by-step lessons,<br class="hidden sm:inline"> a thousand songs, and unlimited personal support. ',
                'thumb' => 'https://d21q7xesnoiieh.cloudfront.net/fit-in/0x0/filters:quality(95)/marketing/pianote/membership/homepage/webp-format/header-thumb2.webp',
                'promoThumb' => 'https://d21q7xesnoiieh.cloudfront.net/fit-in/0x0/filters:quality(95)/marketing/pianote/membership/homepage/webp-format/jan-thumb2.webp',
                'promoThumbM' => 'https://d21q7xesnoiieh.cloudfront.net/fit-in/0x0/filters:quality(95)/marketing/pianote/membership/homepage/webp-format/jan-thumb-m2.webp',
               'pointOne' => 'Improve Your Skills',
                'pointTwo' => 'World-Class Teachers',
                'pointThree' => 'Play More<br class="inline lg:hidden"> Songs',
            ])
        @endif
    @endif

    @hasSection('promo-banner')
        @yield('promo-banner')
    @endif

    <section class="text-center px-5 sm:px-6 py-12 sm:py-14 lg:py-20 text-white" style="background: linear-gradient(to bottom, #f41a30, #79080b);">
        <div class="container max-w-5xl mx-auto">
            <h2><strong>Unlimited piano lessons +<br> a FREE Chords & Scales book.</strong></h2>
            <p class="leading-tight text-musora mt-1 sm:mb-10"><strong>You’ll get a free Chords & Scales book ($39 value) when you try Pianote for 7 days</strong></p>
            <img class="my-5 h-40 inline sm:hidden"
                src="https://d21q7xesnoiieh.cloudfront.net/fit-in/620x0/filters:quality(95)/marketing/pianote/promos/september/chords-scales-promo-m.png"
                alt="learn playing image"
                fetchpriority="high"
            >
            <div class="text-left flex flex-wrap sm:flex-nowrap justify-center items-start mb-5">
                <p class="leading-normal max-w-xl pr-5 lg:pr-8 mx-0">Chords and Scales are the building blocks of ALL music. Sign up for a free 7-day trial of Pianote and we’ll ship you our best-selling Chords & Scales book FREE of charge. No matter where you live in the world.
                    <br><br>
                    Why?
                    <br><br>
                    Call it a bribe. Call it confidence. It’s our mission to get more people playing the piano, and we know you’ll LOVE Pianote if you give it a try.
                    <br><br>
                    So we’re making it easy to get started.
                    <br><br>
                    And hey, if you don’t love it…
                    <br><br>
                    At least you’ll get a free book!
                    <br>
                    <a class="join smaller musora my-3 w-1/2" href="/ecommerce/add-to-cart?products[PIANOTE-MEMBERSHIP-TRIAL-7-DAY-ANNUAL]=1&products[piano-chords-and-scales-guide]=1&promo-code=trial-book&redirect=/order&locked=true">GET Started &raquo;</a>
                    <br>
                    <em>Free worldwide shipping!</em>
                </p>
                <img class="h-80 lg:h-96 hidden sm:inline transition-opacity opacity-0"
                    loading="lazy"
                    onload="this.classList.remove('opacity-0')"
                    src="https://d21q7xesnoiieh.cloudfront.net/fit-in/690x0/filters:quality(95)/marketing/pianote/promos/september/chords-scales-promo.png"
                    alt="learn playing image"
                >
            </div>
        </div>
    </section>

    @php
        $gridItems = $pianote['gridItems'];
    @endphp

    @include('musora.sales.components.trailer-grid-section', [
        'header' => 'Your piano goals<br class="inline sm:hidden"> start here.',
        'desc' => 'Always know <em>exactly</em> what to practice with an organized 10-level <br class="hidden sm:inline lg:hidden">curriculum and direct access to real teachers. ',
    ])

    @include('musora.sales.components.trailer-grid-section', [
        'header' => 'Your piano goals<br class="inline sm:hidden"> start here.',
        'desc' => 'Always know <em>exactly</em> what to practice with an organized 10-level <br class="hidden sm:inline lg:hidden">curriculum and direct access to real teachers. ',
    ])

   @php
        $buttons = $pianote['buttons'];
        $courses = $pianote['courses'];
    @endphp

   @include('musora.sales.components.coaches-section', [
        'header' => 'Real Teachers,  <br class="sm:hidden">Real Results.',
        'desc' => 'Amplify your skills with exclusive artist <br class="hidden md:inline"> courses + live events with special guests.'
    ])

    @php
        $songItems = $pianote['songItems'];
    @endphp

    @include('musora.sales.components.songs-section', [
        'header' => 'Play your favorite songs.',
        'desc' => 'You’ll have <strong>all the tools you need</strong> to make sure you never miss a note.',
        'video' => 'https://d21q7xesnoiieh.cloudfront.net/fit-in/1300x0/filters:quality(95)/marketing/pianote/membership/homepage/webp-format/device.webp',
        'brandName' => 'Pianote',
        'bannerDesc' => 'Powered by Musora, Pianote includes full access to our communities for drums, guitar, and voice.',
    ])
    @include('musora.sales.components.learn-by-playing-section', [
        'header' => 'Learn the piano by<br class="inline sm:hidden"> <u>playing the piano</u>.',
        'desc' => 'With Pianote, you’ll play more, you’ll fall in love with your progress, <br class="hidden sm:inline lg:hidden"> and you’ll have personalized support every step of the way.',
                'vid' => 'https://player.vimeo.com/progressive_redirect/playback/785314572/rendition/540p/file.mp4?loc=external&signature=b8d6bc7c80a784c2cc9473ae9e1389b3f9e005fbbce2568d7bd6b7d548a4c19e',

    ])

{{--    @include('pianote.sales.headphones-section')--}}

    @php
        $testimonials = $pianote['testimonials'];
    @endphp
    @include('musora.sales.components.testimonials-section', [
        'header' => 'Trusted by pianists<br class="inline-block sm:hidden">  everywhere.',
        'reviewText' => 'Check out the reviews and meet some of our friendly students.',
        'youtubeLink' => 'https://www.youtube.com/pianolessonscom/',
        'youtube' => '1.5M',
        'facebookLink' => 'https://facebook.com/pianoteofficial/',
        'facebook' => '430K',
        'instagramLink' => 'https://instagram.com/pianoteofficial/',
        'instagram' => '240K',
    ])
    @if(empty($trialVersion))
    @include('musora.sales.components.guarantee-section', [
        'badge' => 'https://d21q7xesnoiieh.cloudfront.net/fit-in/250x0/filters:quality(95)/marketing/pianote/membership/homepage/webp-format/piano-guarantee.webp',
        'header' => '<strong>Happy student guarantee.</strong><br>Test-drive your lessons for 90 days. Zero risk.',
        'desc' => 'Online lessons can be intimidating. Maybe you’re wondering if they work, or if you’ll use them enough – or if you’ll even enjoy the experience. So we’re removing the risk with our 90-day guarantee. More than anything, we want to make sure you have a POSITIVE experience developing new skills and gaining confidence on the piano.',
    ])
    @endif
    <div class="unstick-trigger block"></div>
    <div id="customize-anchor" class="anchor"></div>
    <div id="order" class="anchor"></div>


    <section class="py-14 sm:py-20 lg:py-24 relative overflow-hidden text-white text-center customize px-4 lg:px-6"
            style="background: linear-gradient(to right, #08203a, #0c1524);">
            <div class="container mx-auto max-w-6xl relative z-50">
                <div class="w-full">
                    <div class="bonus-wrap relative inline-block align-top mx-auto px-1 md:px-3 w-full max-w-lg">
                        <div class=" inline-block relative w-full group" style="padding-bottom: 33%;perspective: 1000px;">
                            <div class="text-center w-full h-full absolute" style="transform-style: preserve-3d;">
                                <div class=" {{--border-2 border-promo--}} front absolute z-20  w-full h-full transition-transform duration-700" style="backface-visibility: hidden;">
                                    <div class="h-full w-full bg-top bg-contain bg-no-repeat" style="background-image:url('https://d21q7xesnoiieh.cloudfront.net/fit-in/850x0/filters:quality(95)/marketing/pianote/promos/september/cas-order-promo.png');"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <br>
                    <h2 class="leading-tight mb-2"><strong>Try Pianote for 7 days & get<br class="hidden sm:inline"> a FREE Chords & Scales book.</strong></h2>

                    <p class="leading-tight mt-4 sm:mt-5 mb-2"><span class="text-musora">Click below to start your free 7-day trial. Your annual membership will<br class="hidden sm:inline"> continue on {{ Carbon\Carbon::now()->addDays(7)->format('F jS') }} (after your free trial).</span></p>

                    <h3 class="leading-tight mt-4 sm:mt-5 mb-2"><strong>Free for 7 days</strong></h3>
                    <p class="leading-tight opacity-70 text-sm"><em>Then billed at $240 per year. Save 33%.</em></p>
                    <a class="join {{ $theme }} my-4 md:my-6 w-full max-w-xs md:max-w-lg lg:max-w-xl" style="padding: 20px 10px;" href="/ecommerce/add-to-cart?products[PIANOTE-MEMBERSHIP-TRIAL-7-DAY-ANNUAL]=1&products[piano-chords-and-scales-guide]=1&promo-code=trial-book&redirect=/order&locked=true">CLICK HERE TO GET STARTED</a>
                </div>
                    <a class="inline-block text-pianote mt-2" href="/ecommerce/add-to-cart?products[PIANOTE-MEMBERSHIP-TRIAL]=1&redirect=/order&locked=true"><p class="leading-tight"><strong><u>Or start a Monthly Plan for<br class="sm:hidden"> $30/month (no bonuses)</u></strong></p></a>
                    <p class="opacity-70 text-sm mt-2"><em>90-day money-back guarantee. Cancel anytime.</em></p>
            </div>
        </section>

    @include('musora.sales.components.trial-explanation', [
        'instrument' => 'piano',
    ])

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

    <script src="https://cdn.jsdelivr.net/npm/@splidejs/splide@4.0.7/dist/js/splide.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/lazysizes/5.3.2/lazysizes.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/lazysizes/5.3.2/plugins/unveilhooks/ls.unveilhooks.min.js"></script>
    @yield('scripts')
@stop
