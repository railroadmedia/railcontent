@php
    require_once(resource_path('marketing/views/pianote/_partials/homepage-data.php'));
    require_once(resource_path('marketing/views/pianote/_partials/bonus-data.php'));
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
        <meta property="og:image" content="https://d21q7xesnoiieh.cloudfront.net/fit-in/1200x0/filters:quality(95)/marketing/pianote/membership/homepage/webp-format/share-image-pianote2.webp ">
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
    </style>
@stop

@section('body-data')
    x-data ='{
        demoVid : false,
        trailer : false,
        rolandTrailer : false,
        lazyLoad: false,
        videoLoaded: false,
        @foreach($pianote['packs'] as $modalData)
        {{ $modalData['name'] }}: false,
        @endforeach
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
    @endif

    @hasSection('top-bar')
        @yield('top-bar')
    @endif

    @if(empty($hideHeader) || !$hideHeader)
        @if(!empty($beginnerVersion))
            @include('musora.sales.components.header-section', [
                'video' => 'https://musora-image-processing-cdn.s3.us-east-2.amazonaws.com/marketing/pianote/membership/homepage/2025/header2.mp4',
                'videoM' => 'https://musora-image-processing-cdn.s3.us-east-2.amazonaws.com/marketing/pianote/membership/homepage/2025/header-m.mp4',
                'header' => 'Online piano lessons<br> tailored for beginners.',
                'pointOne' => 'GREAT TEACHERS',
                'pointTwo' => 'VIDEO LESSONS',
                'pointThree' => 'FUN PRACTICE',
                'pointFour' => 'POPULAR SONGS',
                'featured' => [
                    [
                        'url' => 'https://www.musicradar.com/reviews/pianote-review',
                        'src' => 'https://musora-image-processing-cdn.s3.us-east-2.amazonaws.com/marketing/pianote/membership/homepage/2025/musicradar.svg',
                    ],
                    [
                        'url' => 'https://www.nytimes.com/2023/12/07/arts/music/colette-maze-dead.html',
                        'src' => 'https://musora-image-processing-cdn.s3.us-east-2.amazonaws.com/marketing/pianote/membership/homepage/2025/nyt.svg',
                    ],
                    [
                        'url' => 'https://www.pianistmagazine.com/blogs/a-closer-look-at-pianote/',
                        'src' => 'https://musora-image-processing-cdn.s3.us-east-2.amazonaws.com/marketing/pianote/membership/homepage/2025/pianist.svg',
                    ],
                    [
                        'url' => 'https://americansongwriter.com/why-every-guitarist-needs-to-learn-piano/',
                        'src' => 'https://musora-image-processing-cdn.s3.us-east-2.amazonaws.com/marketing/pianote/membership/homepage/2025/as.webp',
                    ],
                ],
            ])
        @elseif(!empty($songsVersion))
            @include('musora.sales.components.header-section', [
                'video' => 'https://musora-image-processing-cdn.s3.us-east-2.amazonaws.com/marketing/pianote/membership/homepage/2025/header.mp4',
                'header' => 'Learn piano from real teachers.<br> Play your favorite songs.',
                'pointOne' => 'GREAT TEACHERS',
                'pointTwo' => 'VIDEO LESSONS',
                'pointThree' => 'FUN PRACTICE',
                'pointFour' => 'POPULAR SONGS',
                'featured' => [
                    [
                        'url' => 'https://www.musicradar.com/reviews/pianote-review',
                        'src' => 'https://musora-image-processing-cdn.s3.us-east-2.amazonaws.com/marketing/pianote/membership/homepage/2025/musicradar.svg',
                    ],
                    [
                        'url' => 'https://www.nytimes.com/2023/12/07/arts/music/colette-maze-dead.html',
                        'src' => 'https://musora-image-processing-cdn.s3.us-east-2.amazonaws.com/marketing/pianote/membership/homepage/2025/nyt.svg',
                    ],
                    [
                        'url' => 'https://www.pianistmagazine.com/blogs/a-closer-look-at-pianote/',
                        'src' => 'https://musora-image-processing-cdn.s3.us-east-2.amazonaws.com/marketing/pianote/membership/homepage/2025/pianist.svg',
                    ],
                    [
                        'url' => 'https://americansongwriter.com/best-online-piano-lessons/',
                        'src' => 'https://musora-image-processing-cdn.s3.us-east-2.amazonaws.com/marketing/pianote/membership/homepage/2025/as.webp',
                    ],
                ],
            ])

        @elseif(!empty($promoPage))
            @include('musora.sales.components.header-section', [
                'video' => 'https://musora-image-processing-cdn.s3.us-east-2.amazonaws.com/marketing/pianote/membership/homepage/2025/header.mp4',
                'header' => 'THE <span class="text-pianote">NEW WAY</span> TO<br> <span class="relative inline-block">LEARN PIANO<svg class="absolute left-0 right-0 bottom-0 w-full h-4 sm:h-7" xmlns="http://www.w3.org/2000/svg" width="100%" height="100%" viewBox="0 0 524 22" fill="none" style="transform: translate(0, 100%);"><path d="M1.99978 10.6328C84.053 4.08508 302.889 -3.20824 521.809 20" stroke="#f61a30" stroke-width="3" stroke-linecap="round"></path><path d="M2.17373 15.0541C83.9528 7.29382 302.406 -3.51921 521.988 15.3111" stroke="#f61a30" stroke-width="3" stroke-linecap="round"></path></svg></span>.',
                'featured' => [
                    [
                        'url' => 'https://www.musicradar.com/reviews/pianote-review',
                        'src' => 'https://musora-image-processing-cdn.s3.us-east-2.amazonaws.com/marketing/pianote/membership/homepage/2025/musicradar.svg',
                    ],
                    [
                        'url' => 'https://www.nytimes.com/2023/12/07/arts/music/colette-maze-dead.html',
                        'src' => 'https://musora-image-processing-cdn.s3.us-east-2.amazonaws.com/marketing/pianote/membership/homepage/2025/nyt.svg',
                    ],
                    [
                        'url' => 'https://www.pianistmagazine.com/blogs/a-closer-look-at-pianote/',
                        'src' => 'https://musora-image-processing-cdn.s3.us-east-2.amazonaws.com/marketing/pianote/membership/homepage/2025/pianist.svg',
                    ],
                    [
                        'url' => 'https://americansongwriter.com/best-online-piano-lessons/',
                        'src' => 'https://musora-image-processing-cdn.s3.us-east-2.amazonaws.com/marketing/pianote/membership/homepage/2025/as.webp',
                    ],
                ],
            ])
        @else
            @include('musora.sales.components.header-section', [
                'video' => 'https://musora-image-processing-cdn.s3.us-east-2.amazonaws.com/marketing/pianote/membership/homepage/2025/header.mp4',
                'header' => 'EVERYTHING<br class="sm:hidden"> YOU NEED<br class="hidden sm:inline"> TO<br class="sm:hidden"> <span class="relative inline-block">LEARN THE PIANO<svg class="absolute left-0 right-0 bottom-0 w-full h-4 sm:h-7" xmlns="http://www.w3.org/2000/svg" width="100%" height="100%" viewBox="0 0 524 22" fill="none" style="transform: translate(0, 100%);"><path d="M1.99978 10.6328C84.053 4.08508 302.889 -3.20824 521.809 20" stroke=" #f61a30 " stroke-width="3" stroke-linecap="round"></path><path d="M2.17373 15.0541C83.9528 7.29382 302.406 -3.51921 521.988 15.3111" stroke=" #f61a30 " stroke-width="3" stroke-linecap="round"></path></svg></span>.',
                'pointOne' => 'GREAT TEACHERS',
                'pointTwo' => 'VIDEO LESSONS',
                'pointThree' => 'FUN PRACTICE',
                'pointFour' => 'POPULAR SONGS',
                'featured' => [
                    [
                        'url' => 'https://www.musicradar.com/reviews/pianote-review',
                        'src' => 'https://musora-image-processing-cdn.s3.us-east-2.amazonaws.com/marketing/pianote/membership/homepage/2025/musicradar.svg',
                    ],
                    [
                        'url' => 'https://www.nytimes.com/2023/12/07/arts/music/colette-maze-dead.html',
                        'src' => 'https://musora-image-processing-cdn.s3.us-east-2.amazonaws.com/marketing/pianote/membership/homepage/2025/nyt.svg',
                    ],
                    [
                        'url' => 'https://www.pianistmagazine.com/blogs/a-closer-look-at-pianote/',
                        'src' => 'https://musora-image-processing-cdn.s3.us-east-2.amazonaws.com/marketing/pianote/membership/homepage/2025/pianist.svg',
                    ],
                    [
                        'url' => 'https://americansongwriter.com/best-online-piano-lessons/',
                        'src' => 'https://musora-image-processing-cdn.s3.us-east-2.amazonaws.com/marketing/pianote/membership/homepage/2025/as.webp',
                    ],
                ],
            ])
        @endif
    @endif

    @hasSection('promo-banner')
        @yield('promo-banner')
    @endif

    @include('musora.sales.components.step-by-step-section', [
        'wall' => 'marketing/pianote/membership/homepage/2025/course-wall.webp',
        'wallM' => 'marketing/pianote/membership/homepage/2025/course-wall-m.webp',
        'stepOne' => 'Chords. Technique. Blues. Or just getting started the right way.<br class="hidden sm:inline"> Choose the lessons that are right for you. Here are a few favorites:',
        'packs' => $pianote['packs'],
        'stepTwoBg' => 'https://d21q7xesnoiieh.cloudfront.net/fit-in/2000x0/filters:quality(95)/marketing/pianote/membership/homepage/2025/pov-bg2.jpg',
        'stepTwo' => 'It’s easy. Simply choose your course, press play, and play along with your instructor.<br class="hidden sm:inline-block"> It’s the best way to stay motivated, keep coming back to the keys, and get amazing results.',
        'povM' => 'marketing/pianote/membership/homepage/2025/pov-m2.webp',
        'pov' => 'marketing/pianote/membership/homepage/2025/pov2.webp',
        'stepThree' => 'The most important part of learning piano is building a daily habit. Practice a little<br class="hidden sm:inline-block"> each day, and you’ll hear the results way sooner (and so will everyone around you!).',
        'tabletM' => 'marketing/pianote/membership/homepage/2025/tablet-m2.png',
        'tablet' => 'marketing/pianote/membership/homepage/2025/tablet2.png',
    ])

    @include('musora.sales.components.workouts-section', [
        'vid' => 'https://player.vimeo.com/progressive_redirect/playback/785314572/rendition/540p/file.mp4?loc=external&signature=b8d6bc7c80a784c2cc9473ae9e1389b3f9e005fbbce2568d7bd6b7d548a4c19e',
        'workoutsBG' => 'marketing/pianote/membership/homepage/2024/workouts-card3.webp',
    ])

    @php
        $gridItems = $pianote['gridItems'];
    @endphp
    @include('musora.sales.components.reason-cards-five-section', [
        'subHeader' => true,
        'full' => true,
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
        @include('musora.sales.components.order-section-collage', [
            "orderUrl" => "/ecommerce/add-to-cart?products[PIANOTE-MEMBERSHIP-TRIAL-7-DAY-ANNUAL]=1&promo-code=annual-trial&redirect=/order&locked=true",
        'logo' => 'marketing/pianote/membership/homepage/2025/logo.webp',
        'header' => '<strong>Unlimited piano lessons.<br>The world’s best teachers.  <br> 500+ popular songs.</strong>',
        'list' => '<li class="leading-tight mb-3"><i class="fa-li fas fa-check text-pianote"></i> Trusted by ' . number_format(Prices::$students) . ' students.</li>
                    <li class="leading-tight mb-3"><i class="fa-li fas fa-check text-pianote"></i> Online piano lessons on every topic.</li>
        <li class="leading-tight mb-3"><i class="fa-li fas fa-check text-pianote"></i> Personalized feedback from real teachers.</li>
        <li class="leading-tight text-coaches max-w-xs mx-0"><i class="fa-li fas fa-check"></i> <strong>PLUS</strong> voice, guitar, and drums lessons with full access to all Musora communities.</li>',
        'image' => 'marketing/pianote/membership/homepage/2025/collage.webp',
        ])
        @include('musora.sales.components.trial-explanation', [
            'instrument' => 'piano',
        ])

    @elseif(!empty($promoVersion))
        <section style="background:linear-gradient(30deg, #0a3761, #0c1526);">
        <div class="px-4 lg:px-8 py-10 sm:py-16 lg:py-20 relative overflow-hidden text-white text-center customize relative overflow-hidden"
                :style="`background:url('https://d21q7xesnoiieh.cloudfront.net/fit-in/600x0/marketing/pianote/membership/homepage/2024/order-bg-tile-2.webp') center center/160px;`""
                <div class="container mx-auto max-w-5xl">
                    <div x-data="{lazyLoad: false}">
                        @php
                            $targetSkus = [
                                'easy-chords',
                                '30-day-blues-piano',
                            ];
                        @endphp
                        <div id="customize-anchor"></div>
                        @include('drumeo._partials.ny-order-section-bonuses', [
                            'topImage' => 'marketing/pianote/membership/homepage/webp-format/pianote-annual-2w-card.webp',
                            'bonusWidth' => 'w-1/2 md:w-1/3 lg:w-1/5',
                            'bundle' => 'holiday-pianote',
                            'targetSkus' => $targetSkus,
                            'maxWidth' => 'max-w-5xl',
                            'ispromo' => "true",
                            'promoHeader' => 'Online piano lessons for all skill levels.',
                            'subDescription' => 'Save 17% + get 4 bonuses<br class="inline sm:hidden"> worth $357',
                            'buttonLink' => '/ecommerce/add-to-cart?products[PIANOTE-MEMBERSHIP-1-YEAR]=1&products[easy-chords]=1&products[30-day-blues-piano]=1&redirect=/order&locked=true&promo-code=special,WBP24',
                        ])
                    </div>
                </div>
            </div>
        <section>
    @else
        @include('musora.sales.components.order-section-collage', [
        'headerLight' => true,
        'logo' => 'marketing/pianote/membership/homepage/2025/logo.webp',
        'header' => '<strong>Unlimited piano lessons.<br>The world’s best teachers.  <br> 500+ popular songs.</strong>',
        'list' => '<li class="leading-tight mb-3"><i class="fa-li fas fa-check text-pianote"></i> Trusted by ' . number_format(Prices::$students) . ' students.</li>
                    <li class="leading-tight mb-3"><i class="fa-li fas fa-check text-pianote"></i> Online piano lessons on every topic.</li>
        <li class="leading-tight mb-3"><i class="fa-li fas fa-check text-pianote"></i> Personalized feedback from real teachers.</li>
        <li class="leading-tight text-coaches max-w-xs mx-0"><i class="fa-li fas fa-check"></i> <strong>PLUS</strong> voice, guitar, and drums lessons with full access to all Musora communities.</li>',
        'image' => 'marketing/pianote/membership/homepage/2025/collage.webp',
        ])

    @endif

    @include('musora.sales.components.app-section', [
        'image' => 'marketing/pianote/membership/homepage/2025/devices.webp',
        'appleUrl' => 'https://apps.apple.com/us/app/musora-the-music-lessons-app/id1460388277',
        'googleUrl' => 'https://play.google.com/store/apps/details?id=com.drumeo',
    ])

    @include('pianote._partials.faq')

    @include('_partials.components.video-modal',[
        'name' => 'demoVid',
        'video' => '802011057',
        'vimeo' => true,
    ])
    @include('_partials.components.video-modal',[
        'name' => 'trailer',
        'video' => '785314388',
        'vimeo' => true,
    ])
    @foreach ($pianote['packs'] as $packModal)
        @include('_partials.components.video-modal', [
            'name' => $packModal['name'],
            'video' => $packModal['vimeoId'],
            'vimeo' => true,
        ])
    @endforeach

    @if(!empty($promoVersion))
        @include("pianote.sales.partials._footer", [
            "minimal" => true
        ])
    @else
        @include("pianote.sales.partials._footer")
    @endif

    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script type="text/javascript" src="{{ asset('/marketing/parcel/drumeo/navigation-sales.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/@splidejs/splide@4.1.4/dist/js/splide.min.js"></script>
    @yield('scripts')
    <script type="application/javascript">
        document.addEventListener('DOMContentLoaded', function () {
            var stickyBar = document.querySelector('.promo-banner');
            if (!stickyBar) return;

            window.addEventListener('scroll', function () {
                var stickTrigger = document.querySelector('.sticky-trigger').offsetTop;
                var unstickTrigger = document.querySelector('.unstick-trigger').offsetTop;
                if (window.scrollY > (unstickTrigger - 115)) {
                    stickyBar.classList.remove('fixed', 'mt-0');
                }
                if (window.scrollY < stickTrigger - 115) {
                    stickyBar.classList.remove('fixed', 'mt-0');
                }
                if (window.scrollY < unstickTrigger - 115 && window.scrollY > stickTrigger - 115) {
                    stickyBar.classList.add('fixed', 'mt-0');
                }
            });
        });
    </script>
@stop
