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
        <meta property="og:image" content="https://d21q7xesnoiieh.cloudfront.net/fit-in/1200x0/filters:quality(95)/marketing/drumeo/membership/homepage/2023/share-image-drumeo.jpg">
    @endif

    @include('_partials.layout._fonts')

    <link rel="stylesheet" href="{{ mix('marketing/css/app.css') }}">
    <link href="{{ asset('/marketing/parcel/drumeo/navigation-sales.css') }}" rel="stylesheet">
    <link href="{{ asset('/marketing/css/tailwind-helpers.css') }}" rel="stylesheet">
    <link href="{{ asset('/marketing/parcel/drumeo/sales-2020.css') }}" rel="stylesheet">
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
    </style>
@stop

@section('body-data')
    x-data ='{
        soundslice : false,
        trailer : false,
    }'
@endsection

@section('global-body')
    @if(!empty($promoVersion))
        @include("drumeo.sales.partials._nav", [
            "subscriptionVersion" => true,
            "scrollToJoin" => true,
            "hideMenu" => true,
            "logoUrl" => Request::path(),
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
        $bubble1 = 'https://d21q7xesnoiieh.cloudfront.net/fit-in/100x0/filters:quality(95)/marketing/drumeo/membership/homepage/2023/bubbles/dorothea-taylor.png';
        $bubble2 = 'https://d21q7xesnoiieh.cloudfront.net/fit-in/350x0/filters:quality(95)/marketing/drumeo/membership/homepage/2023/bubbles/todd-sucherman.png';
        $bubble3 = 'https://d21q7xesnoiieh.cloudfront.net/fit-in/400x0/filters:quality(95)/marketing/drumeo/membership/homepage/2023/bubbles/jared-falk.png';
        $bubble4 = 'https://d21q7xesnoiieh.cloudfront.net/fit-in/100x0/filters:quality(95)/marketing/drumeo/membership/homepage/2023/bubbles/hannah-welton.png';
        $bubble5 = 'https://d21q7xesnoiieh.cloudfront.net/fit-in/100x0/filters:quality(95)/marketing/drumeo/membership/homepage/2023/bubbles/larnell-lewis.png';
        $bubble6 = 'https://d21q7xesnoiieh.cloudfront.net/fit-in/400x0/filters:quality(95)/marketing/drumeo/membership/homepage/2023/bubbles/zack-grooves.png';
        $bubble7 = 'https://d21q7xesnoiieh.cloudfront.net/fit-in/500x0/filters:quality(95)/marketing/drumeo/membership/homepage/2023/bubbles/domino-santatonio.png';
        $bubble8 = 'https://d21q7xesnoiieh.cloudfront.net/fit-in/100x0/filters:quality(95)/marketing/drumeo/membership/homepage/2023/bubbles/aaron-spears.png';

       $slides = $drumeo['slides'];
    @endphp

    @if(!empty($beginnerVersion))
        @include('musora.sales.components.header-section', [
            'header' => 'Learn beginner beats, fills<br> and songs on the drums.',
            'desc' => 'Try Drumeo’s award-winning online drum lessons for 7 days FREE:',
            'thumb' => 'https://d21q7xesnoiieh.cloudfront.net/fit-in/0x0/filters:quality(95)/marketing/drumeo/membership/homepage/2023/jan-thumb-no-badge.jpg',
            'promoThumb' => 'https://d21q7xesnoiieh.cloudfront.net/fit-in/0x0/filters:quality(95)/marketing/drumeo/membership/homepage/2023/header-thumb-promo2.png',
            'promoThumbM' => 'https://d21q7xesnoiieh.cloudfront.net/fit-in/0x0/filters:quality(95)/marketing/drumeo/membership/homepage/2023/header-thumb-promo-m2.jpg',
            'pointOne' => 'Learn New Skills',
            'pointTwo' => 'Study With Legends',
            'pointThree' => 'Play Real Songs',
        ])
    @else
        @include('musora.sales.components.header-section', [
            'header' => 'Online drum lessons<br> for all skill levels.',
            'underline' => true,
            'desc' => 'Learn the drums faster with step-by-step lessons,<br class="hidden sm:inline"> thousands of songs and unlimited personal support.',
            'thumb' => 'https://d21q7xesnoiieh.cloudfront.net/fit-in/0x0/filters:quality(95)/marketing/drumeo/membership/homepage/2023/jan-thumb-no-badge.jpg',
            'promoThumb' => 'https://d21q7xesnoiieh.cloudfront.net/fit-in/0x0/filters:quality(95)/marketing/drumeo/membership/homepage/2023/header-thumb-promo2.png',
            'promoThumbM' => 'https://d21q7xesnoiieh.cloudfront.net/fit-in/0x0/filters:quality(95)/marketing/drumeo/membership/homepage/2023/header-thumb-promo-m2.jpg',
            'pointOne' => 'Improve Your Skills',
            'pointTwo' => 'World-Class Teachers',
            'pointThree' => 'Play More<br class="inline lg:hidden"> Songs',
        ])
    @endif

    @hasSection('promo-banner')
        @yield('promo-banner')
    @endif

    @php
        $gridItems = $drumeo['gridItems'];
    @endphp

    @include('musora.sales.components.trailer-grid-section', [
        'header' => 'Your drumming goals<br class="inline sm:hidden"> start here.',
        'desc' => 'Always know <em>exactly</em> what to practice with an organized 10-level <br class="hidden sm:inline lg:hidden">curriculum featuring many of the world’s best teachers. ',
    ])

    @php
        $buttons = $drumeo['buttons'];

        $courses = $drumeo['courses'];
    @endphp

    @include('musora.sales.components.coaches-section', [
        'header' => 'Study with the world’s <br class="md:hidden">best drummers.',
        'desc' => 'Amplify your skills with 200+ artist courses + <br class="hidden md:inline">access exclusive live events with drumming legends.'
    ])


    @php
        $songItems = $drumeo['songItems'];
    @endphp

    @include('musora.sales.components.songs-section', [
        'header' => 'Play your favorite songs.',
        'desc' => 'You’ll have <strong>all the tools you need</strong> to make sure you never miss a beat.',
        'video' => 'https://d21q7xesnoiieh.cloudfront.net/fit-in/1500x0/filters:quality(95)/marketing/drumeo/membership/homepage/2023/device.png',
        'brandName' => 'Drumeo',
    ])

    @include('musora.sales.components.learn-by-playing-section', [
        'header' => 'Learn the drums by<br class="inline sm:hidden"> <u>playing the drums</u>.',
        'desc' => 'With Drumeo, you’ll play more, you’ll fall in love with your progress, <br class="hidden sm:inline lg:hidden"> and you’ll have personalized support every step of the way.',
        'vid' => 'https://player.vimeo.com/progressive_redirect/playback/785314560/rendition/540p/file.mp4?loc=external&signature=1549cce1dacabad80dd416b5a439f6639d3b7b30c7e4d70d46245bf70c6d5102',
    ])

    @php
        $testimonials = $drumeo['testimonials'];
    @endphp
    
    @include('musora.sales.components.testimonials-section', [
        'header' => 'Trusted by drummers<br class="inline-block sm:hidden">  everywhere.',
        'reviewText' => 'Check out the reviews and meet some of our friendly students.',
        'youtubeLink' => 'https://www.youtube.com/freedrumlessons/',
        'youtube' => '3M',
        'facebookLink' => 'https://facebook.com/drumeo/',
        'facebook' => '1.2M',
        'instagramLink' => 'https://instagram.com/drumeoofficial/',
        'instagram' => '1.3M',
    ])
    @if(empty($trialVersion))
        @include('musora.sales.components.guarantee-section', [
            'badge' => 'https://d21q7xesnoiieh.cloudfront.net/fit-in/250x0/filters:quality(95)/marketing/drumeo/membership/homepage/2023/guarantee.png',
            'header' => '<strong>Happy student guarantee.</strong><br>Test-drive your lessons for 90 days. Zero risk.',
            'desc' => 'Online lessons can be intimidating. Maybe you’re wondering if they work, or if you’ll use them enough – or if you’ll even enjoy the experience. So we’re removing the risk with our 90-day guarantee. More than anything, we want to make sure you have a POSITIVE experience developing new skills and gaining confidence on the drums.',
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
            "plusLogo" => "https://d21q7xesnoiieh.cloudfront.net/fit-in/0x0/filters:quality(95)/marketing/drumeo/membership/homepage/2023/drumeoplus_logo.svg",
            "logo" => "https://d21q7xesnoiieh.cloudfront.net/fit-in/0x0/filters:quality(95)/marketing/drumeo/membership/homepage/2023/logo-white.png",
            "songs" => "5000+ popular songs.",
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
    @elseif(!empty($promoVersion))
        @php
            $bonuses = [
                [
                'image' => 'https://d21q7xesnoiieh.cloudfront.net/fit-in/0x0/filters:quality(95)/marketing/drumeo/promos/black-friday/bundles/vertical-bg/drumsticks.jpg',
                'title' => 'Drumeo Drumsticks',
                'description' => 'Drumeo 5A Drumsticks by Vater — made with hickory and extra moisture to last longer.',
                'price' => floatval($productPrices['Drumeo-VaterSticks']->price),
                'shipping' => true,
                ],
                [
                'image' => 'https://d21q7xesnoiieh.cloudfront.net/fit-in/0x0/filters:quality(95)/marketing/drumeo/promos/black-friday/bundles/vertical-bg/rdm.jpg',
                'title' => 'Rock Drumming Masterclass',
                'description' => 'Todd Sucherman’s 26-week masterclass to help you improve your rock drumming.',
                'price' => floatval($productPrices['rock-drumming-masterclass-pack']->price),
                ],
                [
                'image' => 'https://d21q7xesnoiieh.cloudfront.net/fit-in/0x0/filters:quality(95)/marketing/drumeo/promos/black-friday/bundles/vertical-bg/dtme.jpg',
                'title' => 'Drum Technique Made Easy',
                'description' => 'Bruce Becker’s 26-week masterclass to improve your hand & foot technique.',
                'price' => floatval($productPrices['drum-technique-made-easy-pack']->price),
                ],
                [
                'image' => 'https://d21q7xesnoiieh.cloudfront.net/fit-in/0x0/filters:quality(95)/marketing/drumeo/promos/black-friday/bundles/vertical-bg/ime.jpg',
                'title' => 'Independence Made Easy',
                'description' => 'Jared Falk’s 26-week masterclass to unlock your musicality and freedom on the drums.',
                'price' => floatval($productPrices['independence-made-easy-pack']->price),
                ],
            ]
        @endphp
        @include('musora.sales.components.order-section-bonuses', [
        'topImage' => 'https://d21q7xesnoiieh.cloudfront.net/fit-in/1000x0/filters:quality(95)/marketing/drumeo/membership/homepage/2023/drumeo-annual-2w-card.png',
        'header' => 'Online drum lessons for all skill levels.',
        'subDescription' => 'Save 17% + get 4 bonuses<br class="inline sm:hidden"> worth $603.95',
        'buttonLink' => '/ecommerce/add-to-cart?products[DLM-1-year]=1&products[Drumeo-VaterSticks]=1&products[drum-technique-made-easy-pack]=1&products[rock-drumming-masterclass-pack]=1&products[independence-made-easy-pack]=1&locked=true&promo-code=special',
        'altButtonLink' => '/ecommerce/add-to-cart?products[DLM-1-month]=1&locked=true',
        ])
    @else
        @include('musora.sales.components.order-section-collage', [
        'logo' => 'https://d21q7xesnoiieh.cloudfront.net/fit-in/500x0/filters:quality(95)/marketing/drumeo/membership/homepage/2023/logo-blue.png',
        'header' => 'Unlimited drum lessons.<br> The world’s best teachers.<br> 5000+ popular songs.',
        'list' => '<li class="leading-tight mb-3"><i class="fa-li fas fa-check text-drumeo"></i> Trusted by ' . number_format(Prices::$students) . ' students.</li>
                    <li class="leading-tight mb-3"><i class="fa-li fas fa-check text-drumeo"></i> Online lessons on every topic.</li>
        <li class="leading-tight mb-3"><i class="fa-li fas fa-check text-drumeo"></i> Personalized feedback from real teachers.</li>
        <li class="leading-tight text-coaches max-w-xs mx-0"><i class="fa-li fas fa-check"></i> <strong>PLUS</strong> piano, guitar, and voice lessons with full access to all Musora communities.</li>',
        'image' => 'marketing/drumeo/membership/homepage/2023/drumeo-collage.png',
        ])
    @endif

    @include('musora.sales.components.app-section', [
        'image' => 'https://d21q7xesnoiieh.cloudfront.net/fit-in/1300x0/filters:quality(95)/marketing/drumeo/membership/homepage/2023/devices.png',
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
        'video' => '785314424',
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

    <script src="https://cdn.jsdelivr.net/npm/@splidejs/splide@4.0.7/dist/js/splide.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/lazysizes/5.3.2/lazysizes.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/lazysizes/5.3.2/plugins/unveilhooks/ls.unveilhooks.min.js"></script>
    @yield('scripts')
@stop
