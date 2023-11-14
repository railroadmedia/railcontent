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

    @include('_partials.layout.holiday.homepage-top-banner',[
        'text' => '<span class="text-promo">Save 38%</span> + get 10 free<br class="sm:hidden"> bonuses worth $1234'
    ])

    <div class="sticky-trigger block"></div>
    @include('_partials.layout.holiday.sticky-bar', [
        'text' => 'GET 10 FREE BONUSES <br> WORTH $1228.94',
    ])

    @php
        $bubble1 = 'https://d21q7xesnoiieh.cloudfront.net/fit-in/100x0/filters:quality(95)/marketing/pianote/membership/homepage/2023/bubbles/summer-swee-singh.png';
        $bubble2 = 'https://d21q7xesnoiieh.cloudfront.net/fit-in/350x0/filters:quality(95)/marketing/pianote/membership/homepage/2023/bubbles/lisa-witt.png';
        $bubble3 = 'https://d21q7xesnoiieh.cloudfront.net/fit-in/400x0/filters:quality(95)/marketing/pianote/membership/homepage/2023/bubbles/jesus-molina.png';
        $bubble4 = 'https://d21q7xesnoiieh.cloudfront.net/fit-in/100x0/filters:quality(95)/marketing/pianote/membership/homepage/2023/bubbles/kevin-castro.png';
        $bubble5 = 'https://d21q7xesnoiieh.cloudfront.net/fit-in/100x0/filters:quality(95)/marketing/pianote/membership/homepage/2023/bubbles/erskine-hawkins.png';
        $bubble6 = 'https://d21q7xesnoiieh.cloudfront.net/fit-in/400x0/filters:quality(95)/marketing/pianote/membership/homepage/2023/bubbles/victoria-theodore.png';
        $bubble7 = 'https://d21q7xesnoiieh.cloudfront.net/fit-in/500x0/filters:quality(95)/marketing/pianote/membership/homepage/2023/bubbles/sangah-noona.png';
        $bubble8 = 'https://d21q7xesnoiieh.cloudfront.net/fit-in/100x0/filters:quality(95)/marketing/pianote/membership/homepage/2023/bubbles/cassi-falk.png';

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
                'pointOne' => 'Perfect for Beginners',
                'pointTwo' => 'Super-Friendly Teachers',
                'pointThree' => 'Fun Lessons',
            ])
        @elseif(!empty($songsVersion))
            @include('musora.sales.components.header-section', [
                'header' => 'Learn piano from real teachers.<br> Play your favorite songs.',
                'desc' => ' Find and play the songs you love. Download, print, and<br class="hidden sm:inline">   play 1000+ songs. Plus get flexible, fun lessons and<br class="hidden sm:inline">  unlimited personal support from real teachers.',
                'thumb' => 'https://d21q7xesnoiieh.cloudfront.net/fit-in/0x0/filters:quality(95)/marketing/pianote/membership/homepage/2023/header-thumb2.jpg',
                'promoThumb' => 'https://d21q7xesnoiieh.cloudfront.net/fit-in/0x0/filters:quality(95)/marketing/pianote/membership/homepage/2023/jan-thumb2.png',
                'promoThumbM' => 'https://d21q7xesnoiieh.cloudfront.net/fit-in/0x0/filters:quality(95)/marketing/pianote/membership/homepage/2023/jan-thumb-m2.jpg',
                'pointOne' => '1000+ popular songs',
                'pointTwo' => 'World-Class Teachers',
                'pointThree' => 'Learn anywhere, anytime',
            ])
        @else
            @include('musora.sales.components.header-section', [
                'header' => 'Online piano lessons<br> for all skill levels.',
                'underline' => true,
                'desc' => 'Learn the piano faster with step-by-step lessons,<br class="hidden sm:inline"> a thousand songs, and unlimited personal support. ',
                'thumb' => 'https://d21q7xesnoiieh.cloudfront.net/fit-in/0x0/filters:quality(95)/marketing/pianote/membership/homepage/2023/header-thumb2.jpg',
                'promoThumb' => 'https://d21q7xesnoiieh.cloudfront.net/fit-in/0x0/filters:quality(95)/marketing/pianote/membership/homepage/2023/jan-thumb2.png',
                'promoThumbM' => 'https://d21q7xesnoiieh.cloudfront.net/fit-in/0x0/filters:quality(95)/marketing/pianote/membership/homepage/2023/jan-thumb-m2.jpg',
                'pointOne' => 'Improve Your Skills',
                'pointTwo' => 'World-Class Teachers',
                'pointThree' => 'Play More<br class="inline lg:hidden"> Songs',
            ])
        @endif
    @endif

    @hasSection('promo-banner')
        @yield('promo-banner')
    @endif

    @php
        $gridItems = $pianote['gridItems'];
    @endphp

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
        'video' => 'https://d21q7xesnoiieh.cloudfront.net/fit-in/1500x0/filters:quality(95)/marketing/pianote/membership/homepage/2023/device.png',
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
        'youtube' => '1.4M',
        'facebookLink' => 'https://facebook.com/pianoteofficial/',
        'facebook' => '430K',
        'instagramLink' => 'https://instagram.com/pianoteofficial/',
        'instagram' => '230K',
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
        @php
            $bonuses = [
                [
        'image' => 'https://d1fyshwdvi6fth.cloudfront.net/Pianote/Bundle-images/fb81d171-6ee7-46bb-bd5e-b29de32766c5-NPPSH-card.jpg',
        'title' => 'New Piano Players Start Here',
        'description' => 'New to the piano? Start here! This play-along course is your first 30 days on the piano. You don’t need any previous experience or theory knowledge. Over 30 days, you’ll play along with your teacher for just 10 minutes a day! You’ll be amazing at what a little bit of consistent practice will do.',
        'price' => 97,
    ],
    [
        'image' => 'https://d1fyshwdvi6fth.cloudfront.net/Pianote/Bundle-images/2bae4048-37d2-4fe4-a195-431de3f7f822-easy-chords-card.jpg',
        'title' => 'Easy Chords',
        'description' => 'Chords are the foundation of all music. But they can be tricky to understand, let alone practice. Easy Chords solves that problem. Over 30 days, you’ll play with a teacher and unlock the beauty and power of piano chord progressions. You’ll be able to play hundreds of songs after taking this course. And best of all? It only takes 10 minutes a day.',
        'price' => 97,
    ],
    [
        'image' => 'https://d2vyvo0tyx8ig5.cloudfront.net/shop/card-thumbs/headphones-cart.jpg',
        'title' => 'Pianote Headphones',
        'description' => 'Hear your piano the way it was meant to sound.',
        'price' => floatval($productPrices['pianote-headphones']->price),
        'shipping' => true,
    ],
    [
        'image' => 'https://d2vyvo0tyx8ig5.cloudfront.net/sales/promos/may/Pianote_Planner_Card.jpg',
        'title' => 'Practice Planner',
        'description' => 'Always know exactly what to practice.',
        'price' => floatval($productPrices['pianote-practice-planner']->price),
        'shipping' => true,
    ],
    [
        'image' => 'https://d2vyvo0tyx8ig5.cloudfront.net/sales/2022/bonus-chords-scales.jpg',
        'title' => 'Chords & <br>Scales Book',
        'description' => 'Your encyclopedia of piano chords & scales.',
        'price' => floatval($productPrices['piano-chords-and-scales-guide']->price),
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
        'image' => 'https://d2vyvo0tyx8ig5.cloudfront.net/sales/promos/september/chords-poster.jpg',
        'title' => 'Chords Poster',
        'description' => 'Play every major and minor chord.',
        'price' => floatval(($productPrices['music-theory-posters']->price / 6)),
        'shipping' => true,
    ],
    [
        'image' => 'https://d2vyvo0tyx8ig5.cloudfront.net/sales/promos/september/chord-formulas-poster.jpg',
        'title' => 'Chord Formulas Poster',
        'description' => 'Play any chord. On any key. ',
        'price' => floatval(($productPrices['music-theory-posters']->price / 6)),
        'shipping' => true,
    ],
    [
        'image' => 'https://d2vyvo0tyx8ig5.cloudfront.net/sales/promos/september/circle-of-fifths-poster.jpg',
        'title' => 'Circle Of 5ths Poster',
        'description' => 'The essential piece of music theory.',
        'price' => floatval(($productPrices['music-theory-posters']->price / 6)),
        'shipping' => true,
    ],
    [
        'image' => 'https://d2vyvo0tyx8ig5.cloudfront.net/sales/promos/september/key-to-sight-reading-poster.jpg',
        'title' => 'Keys To Sight Reading Poster',
        'description' => 'Link the notes on the page to your keys.',
        'price' => floatval(($productPrices['music-theory-posters']->price / 6)),
        'shipping' => true,
    ],
    [
        'image' => 'https://d2vyvo0tyx8ig5.cloudfront.net/sales/promos/september/dynamics-poster.jpg',
        'title' => 'Dynamics Poster',
        'description' => 'Don’t learn Italian. Just look at this poster.',
        'price' => floatval(($productPrices['music-theory-posters']->price / 6)),
        'shipping' => true,
    ],
    [
        'image' => 'https://d2vyvo0tyx8ig5.cloudfront.net/sales/promos/september/scales-poster.jpg',
        'title' => 'Scales Poster',
        'description' => 'All the major and minor scales in one place.',
        'price' => floatval(($productPrices['music-theory-posters']->price / 6)),
        'shipping' => true,
    ],
    [
        'image' => 'https://d2vyvo0tyx8ig5.cloudfront.net/sales/promos/november/bonuses/christmas-book.jpg',
        'title' => 'Christmas Songbook',
        'description' => '14 beautiful Christmas Carols hand-picked and arranged for solo piano.',
        'price' => floatval($productPrices['christmas-song-book']->price),
        'shipping' => true,
    ],
    [
        'image' => 'https://d2vyvo0tyx8ig5.cloudfront.net/sales/promos/november/bonuses/christmas-songbook-card.jpg',
        'title' => 'Christmas Songbook Digital',
        'description' => 'Play Your Favorite Christmas Songs on the Piano.',
        'price' => floatval($productPrices['christmas-song-book-digital']->price),
        'shipping' => true,
    ],
    [
        'image' => 'https://d2vyvo0tyx8ig5.cloudfront.net/sales/promos/october/power_of_chords_card.jpg',
        'title' => 'The Power of Chords',
        'description' => 'Play the music you love using the power of chords.',
        'price' => floatval($productPrices['the-power-of-chords']->price),
    ],
    [
        'image' => 'https://d2vyvo0tyx8ig5.cloudfront.net/sales/promos/november/bonuses/TBGTCP.jpg',
        'title' => 'Classical Piano',
        'description' => 'Pieces you can actually play, with lessons that are actually fun.',
        'price' => floatval($productPrices['classical-piano']->price),
    ],
    [
        'image' => 'https://d2vyvo0tyx8ig5.cloudfront.net/sales/promos/black-friday/unlimited/piano-technique-made-easy.jpg',
        'title' => 'Piano Technique<br> Made Easy',
        'description' => 'Your ultimate guide to learning the piano. Learn EVERY scale, chord, arpeggio, and key signature.',
        'price' => floatval($productPrices['piano-technique-made-easy']->price),
    ],
    [
        'image' => 'https://d2vyvo0tyx8ig5.cloudfront.net/sales/promos/black-friday/unlimited/piano-riffs-and-fills.jpg',
        'title' => 'Piano Riffs<br> & Fills',
        'description' => 'Learn the secrets and tips to play fills that sound complicated and advanced, but are simple to learn.',
        'price' => floatval($productPrices['piano-riffs-and-fills']->price),
    ],
    [
        'image' => 'https://d2vyvo0tyx8ig5.cloudfront.net/sales/promos/black-friday/unlimited/de-stupefy-your-left-hand.jpg',
        'title' => 'De-Stupefy Your<br> Left Hand',
        'description' => 'Most piano players find their left-hand is weaker. Fix those weaknesses and “de-stupefy” that left hand.',
        'price' => floatval($productPrices['destupefy-your-left-hand']->price),
    ],
    [
        'image' => 'https://d2vyvo0tyx8ig5.cloudfront.net/sales/promos/black-friday/unlimited/worship-piano.jpg',
        'title' => 'Worship Piano',
        'description' => 'Learn hundreds of worship songs and get the skills to start playing in a worship band.',
        'price' => floatval($productPrices['worship-piano']->price),
    ],
    [
        'image' => 'https://d2vyvo0tyx8ig5.cloudfront.net/sales/promos/black-friday/faster-fingers.jpg',
        'title' => 'Faster Fingers',
        'description' => 'Boost your speed and confidence with this guided practice course.',
        'price' => floatval($productPrices['faster-fingers']->price),
    ],
    [
        'image' => 'https://d2vyvo0tyx8ig5.cloudfront.net/sales/promos/november/bonuses/TBGTPBP.jpg',
        'title' => 'Play Beautiful Piano',
        'description' => 'Start playing beautiful music from your very 1st lesson.',
        'price' => floatval($productPrices['play-beautiful-piano']->price),
    ],
    [
        'image' => 'https://d2vyvo0tyx8ig5.cloudfront.net/sales/promos/november/bonuses/improv-musical-freedom.jpg',
        'title' => 'Improvisation & Musical Freedom',
        'description' => 'Learn to improvise from one of the best piano players in the world, Jesús Molina',
        'price' => floatval($productPrices['jesus-molina-improvisation-and-musical-freedom-pack']->price),
    ],
    [
        'image' => 'https://d2vyvo0tyx8ig5.cloudfront.net/sales/promos/november/bonuses/classical-piano-book.jpg',
        'title' => 'Classical <br>Book',
        'description' => '92 pages full of beautiful pieces by famous classical composers that you can actually play!',
        'price' => floatval($productPrices['classical-book']->price),
    ],
            ]
        @endphp
        @include('musora.sales.components.order-section-bf', [
        'topImage' => 'https://d21q7xesnoiieh.cloudfront.net/fit-in/0x0/filters:quality(95)/marketing/pianote/membership/homepage/2023/pianote-annual-2w-card.png',
        'promoLogo' => 'https://d21q7xesnoiieh.cloudfront.net/fit-in/800x0/filters:quality(95)/marketing/drumeo/promos/november/BF-drummers-logo-web.png',
        'bonusSum' => '1234',
        'buttonLink' => '/ecommerce/add-to-cart?products[PIANOTE-MEMBERSHIP-1-YEAR]=1&products[piano-chords-and-scales-guide]=1&products[piano-technique-made-easy]=1&products[piano-riffs-and-fills]=1&products[faster-fingers]=1&redirect=/order&locked=true&promo-code=special',
        'altButtonLink' => '/ecommerce/add-to-cart?products[PIANOTE-MEMBERSHIP-1-MONTH]=1&redirect=%2Forder',
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
        @include('musora.sales.components.trial-explanation', [
            'instrument' => 'piano',
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

    @if(empty($promoVersion))
    <script>
        $(document).ready(function () {
            var stickyBar = $('.promo-banner');
            $(window).scroll(function () {
                var stickTrigger = $('.sticky-trigger').offset().top;
                var unstickTrigger = $('.unstick-trigger').offset().top;
                if ($(this).scrollTop() > (unstickTrigger - 115)) {
                    stickyBar.removeClass('fixed mt-0');
                }
                if ($(this).scrollTop() < stickTrigger - 115) {
                    stickyBar.removeClass('fixed mt-0');
                }
                if ($(this).scrollTop() < unstickTrigger - 115 && $(this).scrollTop() > stickTrigger - 115) {
                    stickyBar.addClass('fixed mt-0');
                }
            });
        });
    </script>
    @endif
    <script src="https://cdn.jsdelivr.net/npm/@splidejs/splide@4.0.7/dist/js/splide.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/lazysizes/5.3.2/lazysizes.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/lazysizes/5.3.2/plugins/unveilhooks/ls.unveilhooks.min.js"></script>
    @yield('scripts')
@stop
