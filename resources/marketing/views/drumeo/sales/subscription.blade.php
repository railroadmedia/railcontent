@php
    require_once(resource_path('marketing/views/drumeo/_partials/homepage-data.php'));
    require_once(resource_path('marketing/views/drumeo/_partials/bonus-data.php'));
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
        <meta property="twitter:image" content="https://musora-image-processing-cdn.s3.us-east-2.amazonaws.com/marketing/drumeo/membership/homepage/2024/twitter-image.webp">
        <meta property="og:image" content="https://d21q7xesnoiieh.cloudfront.net/fit-in/1200x0/filters:quality(95)/marketing/drumeo/membership/homepage/2024/share-image-drumeo.webp">
    @endif

    <link rel="stylesheet" href="{{ mix('marketing/css/app.css') }}">
    <link href="{{ asset('/marketing/parcel/drumeo/navigation-sales.css') }}" rel="stylesheet">
    <link href="{{ asset('/marketing/css/tailwind-helpers.css') }}" rel="stylesheet">
    <link href="{{ asset('/marketing/parcel/drumeo/sales-2020.css') }}" rel="stylesheet">
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
    </style>

@stop
@section('body-data')
    x-data ='{
        demoVid : false,
        trailer : false,
        lazyLoad: false,
        videoLoaded: false,
        @foreach($drumeo['packs'] as $modalData)
        {{ $modalData['name'] }}: false,
        @endforeach
    }'
@endsection

@section('global-body')
    @if(!empty($shopNav))
        @include("drumeo.sales.partials._nav", [
            "subscriptionVersion" => true,
            "scrollToJoin" => true,
            "cartVersion" => true
        ])
    @elseif(!empty($promoVersion))
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

    @hasSection('top-bar')
        @yield('top-bar')
    @endif

    @if(empty($hideHeader) || !$hideHeader)
    @if(!empty($beginnerVersion))
        @include('musora.sales.components.header-section', [
            'video' => 'https://musora-image-processing-cdn.s3.us-east-2.amazonaws.com/marketing/drumeo/membership/homepage/2025/header2.mp4',
            'videoM' => 'https://musora-image-processing-cdn.s3.us-east-2.amazonaws.com/marketing/drumeo/membership/homepage/2025/header-m.mp4',
            'header' => 'Learn beginner beats, fills<br> and songs on the drums.',
            'pointOne' => 'GREAT TEACHERS',
            'pointTwo' => 'VIDEO LESSONS',
            'pointThree' => 'FUN PRACTICE',
            'pointFour' => 'POPULAR SONGS',
            'featured' => [
                [
                    'url' => 'https://www.nytimes.com/2024/10/22/arts/music/amplifier-newsletter-music-social-media-accounts.html',
                    'src' => 'https://musora-image-processing-cdn.s3.us-east-2.amazonaws.com/marketing/drumeo/membership/homepage/2025/nyt.png',
                ],
                [
                    'url' => 'https://www.rollingstone.com/music/music-features/phil-collins-in-the-air-tonight-drum-fill-videos-1106780/',
                    'src' => 'https://musora-image-processing-cdn.s3.us-east-2.amazonaws.com/marketing/drumeo/membership/homepage/2025/rs.png',
                ],
                [
                    'url' => 'https://www.nme.com/news/music/dream-theater-mike-potnoy-play-pull-me-under-first-time-13-years-3563614',
                    'src' => 'https://musora-image-processing-cdn.s3.us-east-2.amazonaws.com/marketing/drumeo/membership/homepage/2025/nme.png',
                ],
            ],
        ])
    @elseif(!empty($promoPage))
        @include('musora.sales.components.header-section', [
            'video' => 'https://musora-image-processing-cdn.s3.us-east-2.amazonaws.com/marketing/drumeo/membership/homepage/2025/header.mp4',
            'header' => 'EVERYTHING<br class="sm:hidden"> YOU NEED<br class="hidden sm:inline"> TO<br class="sm:hidden"> <span class="relative inline-block">LEARN THE DRUMS<svg class="absolute left-0 right-0 bottom-0 w-full h-4 sm:h-7" xmlns="http://www.w3.org/2000/svg" width="100%" height="100%" viewBox="0 0 524 22" fill="none" style="transform: translate(0, 100%);"><path d="M1.99978 10.6328C84.053 4.08508 302.889 -3.20824 521.809 20" stroke=" #0b76db " stroke-width="3" stroke-linecap="round"></path><path d="M2.17373 15.0541C83.9528 7.29382 302.406 -3.51921 521.988 15.3111" stroke=" #0b76db " stroke-width="3" stroke-linecap="round"></path></svg></span>.',
            'featured' => [
                [
                    'url' => 'https://www.nytimes.com/2024/10/22/arts/music/amplifier-newsletter-music-social-media-accounts.html',
                    'src' => 'https://musora-image-processing-cdn.s3.us-east-2.amazonaws.com/marketing/drumeo/membership/homepage/2025/nyt.png',
                ],
                [
                    'url' => 'https://www.rollingstone.com/music/music-features/phil-collins-in-the-air-tonight-drum-fill-videos-1106780/',
                    'src' => 'https://musora-image-processing-cdn.s3.us-east-2.amazonaws.com/marketing/drumeo/membership/homepage/2025/rs.png',
                ],
                [
                    'url' => 'https://www.nme.com/news/music/dream-theater-mike-potnoy-play-pull-me-under-first-time-13-years-3563614',
                    'src' => 'https://musora-image-processing-cdn.s3.us-east-2.amazonaws.com/marketing/drumeo/membership/homepage/2025/nme.png',
                ],
            ],
        ])
    @elseif(!empty($keyPage))
        @include('musora.sales.components.header-section', [
            'video' => 'https://musora-image-processing-cdn.s3.us-east-2.amazonaws.com/marketing/drumeo/membership/homepage/2025/header.mp4',
            'header' => 'Unlimited<br> drum lessons +<br>  a <span class="relative inline-block">free drum key<svg class="absolute left-0 right-0 bottom-0 w-full h-4 sm:h-7" xmlns="http://www.w3.org/2000/svg" width="100%" height="100%" viewBox="0 0 524 22" fill="none" style="transform: translate(0, 100%);"><path d="M1.99978 10.6328C84.053 4.08508 302.889 -3.20824 521.809 20" stroke=" #0b76db " stroke-width="3" stroke-linecap="round"></path><path d="M2.17373 15.0541C83.9528 7.29382 302.406 -3.51921 521.988 15.3111" stroke=" #0b76db " stroke-width="3" stroke-linecap="round"></path></svg></span>.',
            'featured' => [
                [
                    'url' => 'https://www.nytimes.com/2024/10/22/arts/music/amplifier-newsletter-music-social-media-accounts.html',
                    'src' => 'https://musora-image-processing-cdn.s3.us-east-2.amazonaws.com/marketing/drumeo/membership/homepage/2025/nyt.png',
                ],
                [
                    'url' => 'https://www.rollingstone.com/music/music-features/phil-collins-in-the-air-tonight-drum-fill-videos-1106780/',
                    'src' => 'https://musora-image-processing-cdn.s3.us-east-2.amazonaws.com/marketing/drumeo/membership/homepage/2025/rs.png',
                ],
                [
                    'url' => 'https://www.nme.com/news/music/dream-theater-mike-potnoy-play-pull-me-under-first-time-13-years-3563614',
                    'src' => 'https://musora-image-processing-cdn.s3.us-east-2.amazonaws.com/marketing/drumeo/membership/homepage/2025/nme.png',
                ],
            ],
        ])
    @else
        @include('musora.sales.components.header-section', [
            'video' => 'https://musora-image-processing-cdn.s3.us-east-2.amazonaws.com/marketing/drumeo/membership/homepage/2025/header.mp4',
            'header' => 'EVERYTHING<br class="sm:hidden"> YOU NEED<br class="hidden sm:inline"> TO<br class="sm:hidden"> <span class="relative inline-block">LEARN THE DRUMS<svg class="absolute left-0 right-0 bottom-0 w-full h-4 sm:h-7" xmlns="http://www.w3.org/2000/svg" width="100%" height="100%" viewBox="0 0 524 22" fill="none" style="transform: translate(0, 100%);"><path d="M1.99978 10.6328C84.053 4.08508 302.889 -3.20824 521.809 20" stroke=" #0b76db " stroke-width="3" stroke-linecap="round"></path><path d="M2.17373 15.0541C83.9528 7.29382 302.406 -3.51921 521.988 15.3111" stroke=" #0b76db " stroke-width="3" stroke-linecap="round"></path></svg></span>.',
            'pointOne' => 'GREAT TEACHERS',
            'pointTwo' => 'VIDEO LESSONS',
            'pointThree' => 'FUN PRACTICE',
            'pointFour' => 'POPULAR SONGS',
            'featured' => [
                [
                    'url' => 'https://www.nytimes.com/2024/10/22/arts/music/amplifier-newsletter-music-social-media-accounts.html',
                    'src' => 'https://musora-image-processing-cdn.s3.us-east-2.amazonaws.com/marketing/drumeo/membership/homepage/2025/nyt.png',
                ],
                [
                    'url' => 'https://www.rollingstone.com/music/music-features/phil-collins-in-the-air-tonight-drum-fill-videos-1106780/',
                    'src' => 'https://musora-image-processing-cdn.s3.us-east-2.amazonaws.com/marketing/drumeo/membership/homepage/2025/rs.png',
                ],
                [
                    'url' => 'https://www.nme.com/news/music/dream-theater-mike-potnoy-play-pull-me-under-first-time-13-years-3563614',
                    'src' => 'https://musora-image-processing-cdn.s3.us-east-2.amazonaws.com/marketing/drumeo/membership/homepage/2025/nme.png',
                ],
            ],
        ])
    @endif
    @endif

    @hasSection('promo-banner')
        @yield('promo-banner')
    @endif

    @include('musora.sales.components.step-by-step-section', [
        'wall' => 'marketing/drumeo/membership/homepage/2025/course-wall.webp',
        'wallM' => 'marketing/drumeo/membership/homepage/2025/course-wall-m.webp',
        'stepOne' => 'You’ll enjoy guided courses from the world’s best drummers. Take a peek at a few favorites:',
        'packs' => $drumeo['packs'],
        'stepTwoBg' => 'https://d21q7xesnoiieh.cloudfront.net/fit-in/2000x0/filters:quality(95)/marketing/drumeo/membership/homepage/2025/pov-bg.webp',
        'stepTwo' => 'We’ve tailored each course to keep you motivated – so you<br class="hidden sm:inline-block"> keep returning to the kit & experience amazing results!',
        'povM' => 'marketing/drumeo/membership/homepage/2025/pov-m2.webp',
        'pov' => 'marketing/drumeo/membership/homepage/2025/pov2.webp',
        'stepThree' => 'If you love your lessons, you’re more likely to practice. And when you practice, <br class="hidden sm:inline-block"> you’ll hear the results way sooner – and so will everyone around you!',
        'tabletM' => 'marketing/drumeo/membership/homepage/2025/tablet-m4.png',
        'tablet' => 'marketing/drumeo/membership/homepage/2025/tablet5.png',
    ])

    @include('musora.sales.components.workouts-section', [
        'vid' => 'https://player.vimeo.com/progressive_redirect/playback/898668674/rendition/540p/file.mp4?loc=external&signature=d5f33375d3a16dc91641be1539d7d621d07ad049b030baa8a7f32c23e63e3ab4',
        'workoutsBG' => 'marketing/drumeo/membership/homepage/2024/workouts-card3.webp',
    ])

    @php
        $gridItems = $drumeo['gridItems'];
    @endphp
    @include('musora.sales.components.reason-cards-five-section', [
        'header' => 'Your drumming goals<br class="inline sm:hidden"> start here.',
        'desc' => 'Always know <em>exactly</em> what to practice with an organized 10-level <br class="hidden sm:inline">curriculum featuring many of the world’s best teachers. ',
        'full' => true,
    ])

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
    @hasSection('final')
        @yield('final')
    @elseif(!empty($trialVersion))
        @include('musora.sales.components.order-section-collage', [
        'orderUrl' => '/ecommerce/add-to-cart?products[DLM-Trial-Annual-7-Day]=1&locked=true',
        'logo' => 'marketing/drumeo/membership/homepage/2025/logo.webp',
        'header' => '<strong>Unlimited drum lessons.<br>The world’s best teachers.<br> 1500+ popular songs.</strong>',
        'list' => '<li class="leading-tight mb-3"><i class="fa-li fas fa-check text-drumeo"></i> Trusted by ' . number_format(Prices::$students) . ' students.</li>
                    <li class="leading-tight mb-3"><i class="fa-li fas fa-check text-drumeo"></i> Online drum lessons on every topic.</li>
        <li class="leading-tight mb-3"><i class="fa-li fas fa-check text-drumeo"></i> Personalized feedback from real teachers.</li>
        <li class="leading-tight text-coaches max-w-xs mx-0"><i class="fa-li fas fa-check"></i> <strong>PLUS</strong> piano, guitar, and singing lessons with full access to all Musora communities.</li>',
        'image' => 'marketing/drumeo/membership/homepage/2025/collage.webp',
        ])
        @include('musora.sales.components.trial-explanation', [
            'instrument' => 'drumming',
        ])

    @elseif(!empty($promoVersion))
        <section style="background:linear-gradient(30deg, #0a3761, #0c1526);">
            <div class="py-14 sm:py-24 lg:py-32 relative overflow-hidden text-white text-center customize px-4 lg:px-6"
                :style="`background:url('https://d21q7xesnoiieh.cloudfront.net/fit-in/600x0/marketing/pianote/membership/homepage/2024/order-bg-tile-2.webp') center center/160px;`">
                <div class="container mx-auto max-w-5xl">
                    <div x-data="{lazyLoad: false}">
                        @php
                            $targetSkus = [
                                '30-day-chops',
                                '30-day-drummer-4',
                            ];
                        @endphp
                        <div id="customize-anchor"></div>
                        @include('drumeo._partials.ny-order-section-bonuses', [
                            'topImage' => 'marketing/drumeo/membership/homepage/2024/drumeo-annual-2w-card.webp',
                            'bonusWidth' => 'w-1/2 md:w-1/3 lg:w-1/5',
                            'bundle' => 'holiday-drumeo',
                            'targetSkus' => $targetSkus,
                            'maxWidth' => 'max-w-5xl',
                            'ispromo' => "true",
                            'promoHeader' => 'Online drum lessons for all skill levels.',
                            'subDescription' => 'Save 17% + get 4 bonuses<br class="inline sm:hidden"> worth $603.95',
                            'buttonLink' => '/ecommerce/add-to-cart?products[DLM-1-year]=1&products[30-day-chops]=1&products[30-day-drummer-4]=1&locked=true&promo-code=special,WBD24',
                        ])
                    </div>
                </div>
            </div>
        <section>
    @else
        @include('musora.sales.components.order-section-collage', [
        'headerLight' => true,
        'logo' => 'marketing/drumeo/membership/homepage/2025/logo.webp',
        'header' => '<strong>Unlimited drum lessons.<br>The world’s best teachers.<br> 1500+ popular songs.</strong>',
        'list' => '<li class="leading-tight mb-3"><i class="fa-li fas fa-check text-drumeo"></i> Trusted by ' . number_format(Prices::$students) . ' students.</li>
                    <li class="leading-tight mb-3"><i class="fa-li fas fa-check text-drumeo"></i> Online drum lessons on every topic.</li>
        <li class="leading-tight mb-3"><i class="fa-li fas fa-check text-drumeo"></i> Personalized feedback from real teachers.</li>
        <li class="leading-tight text-coaches max-w-xs mx-0"><i class="fa-li fas fa-check"></i> <strong>PLUS</strong> piano, guitar, and singing lessons with full access to all Musora communities.</li>',
        'image' => 'marketing/drumeo/membership/homepage/2025/collage.webp',
        ])
    @endif

    @include('musora.sales.components.app-section', [
        'image' => 'marketing/drumeo/membership/homepage/2025/devices.webp',
        'appleUrl' => 'https://apps.apple.com/us/app/musora-the-music-lessons-app/id1460388277',
        'googleUrl' => 'https://play.google.com/store/apps/details?id=com.drumeo',
    ])

    @include('drumeo._partials.faq')

    @include('_partials.components.video-modal',[
        'name' => 'demoVid',
        'video' => '1017241160',
        'vimeo' => true,
    ])
    @include('_partials.components.video-modal',[
        'name' => 'trailer',
        'video' => '898623255',
        'vimeo' => true,
    ])
    @foreach ($drumeo['packs'] as $packModal)
        @include('_partials.components.video-modal', [
            'name' => $packModal['name'],
            'video' => $packModal['vimeoId'],
            'vimeo' => true,
        ])
    @endforeach

    @if(!empty($promoVersion))
        @include("drumeo.sales.partials._footer", [
            "minimal" => true
        ])
    @else
        @include("drumeo.sales.partials._footer")
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
