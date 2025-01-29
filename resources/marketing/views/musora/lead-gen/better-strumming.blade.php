@extends('musora._partials.layout')

@section('head-includes')
    <title>30 Days To Better Strumming | Musora</title>
    <meta property="og:title" content="30 Days To Better Strumming | Musora">

    <meta name="description" content="Strum With Confidence In Just 30 Days."/>
    <meta property="og:description" content="Strum With Confidence In Just 30 Days.">

    <meta property="og:image" content="https://d21q7xesnoiieh.cloudfront.net/fit-in/1200x0/filters:quality(95)/marketing/guitareo/products/30-days-to-better-strumming/share-image.jpg">
    <meta property="og:url" content="https://www.musora.com/{{ Request::path() }}">

    @parent

    <link rel="stylesheet" href="{{ mix('marketing/css/app.css') }}">
    <link href="{{ asset('/marketing/css/tailwind-helpers.css') }}" rel="stylesheet">
    <link href="{{ asset('/marketing/parcel/drumeo/sales-2020.css') }}" rel="stylesheet">
    <link href="{{ asset('/marketing/parcel/drumeo/navigation-sales.css') }}" rel="stylesheet">

    <script type="text/javascript" id="inspectletjs">
        window.__insp = window.__insp || [];
        __insp.push(['wid', 1103167167]);
        (function() {
            function ldinsp(){
                if(typeof window.__inspld != 'undefined') return;
                window.__inspld = 1;
                var insp = document.createElement('script');
                insp.type = 'text/javascript';
                insp.async = true;
                insp.id = 'inspsync';
                insp.src = ('https:' == document.location.protocol ? 'https' : 'http') + '://cdn.inspectlet.com/inspectlet.js';
                var x = document.getElementsByTagName('script')[0]; x.parentNode.insertBefore(insp, x); };
            setTimeout(ldinsp, 500); document.readyState != 'complete' ? (window.attachEvent ? window.attachEvent('onload', ldinsp) : window.addEventListener('load', ldinsp, false)) : ldinsp();
        })();

        @if(!is_null(user()))
        __insp.push(['identify', '{{user()->getEmail()}}']);
        __insp.push(['tagSession', {email: '{{user()->getEmail()}}', userid: '{{user()->getId()}}'}])
        @endif
    </script>
    <style>
        .join.outline.guitareo {
            background:transparent;
            border:2px solid #00C9AC;
            color:#00C9AC;
        }
        .join.guitareo {
            background:#00C9AC;
            border:2px solid #00C9AC;
            color:#fff;
        }

        .join.outline.guitareo:hover,
        .join.outline.guitareo:focus {
            background:#fff;
            color:#000;
            border:2px solid black;
        }
        .lessons-list::-webkit-scrollbar {
            width: 6px;
        }

        /* The track (background) of the scrollbar */
        .lessons-list::-webkit-scrollbar-track {
            background-color: #ddd; /* Background color of the track */
            border-radius: 8px; /* Rounded corners for the track */
        }

        /* The thumb (the draggable part of the scrollbar) */
        .lessons-list::-webkit-scrollbar-thumb {
            background-color: #aaa; /* Color of the scrollbar thumb */
            border-radius: 8px; /* Rounded corners for the thumb */
        }

        /* The thumb when hovered */
        .lessons-list::-webkit-scrollbar-thumb:hover {
            background-color: #bbb; /* Slightly lighter color on hover */
        }
    </style>
@endsection

@section('body-data')
    x-data="{
    kickOff: false,
    unlock: false,
    lazyLoad: false,
    }"
@endsection


<!-- Main -->
@section('layout-body')
    <section class="text-center px-4 md:px-6 py-8 md:py-12 lg:py-16">
        <div x-intersect.once="visible = true;">
            <div class="container max-w-5xl mx-auto">
                <img
                    alt="Logo"
                    class="h-20 sm:h-28 lg:h-32 mx-auto mb-3 sm:mb-5"
                    src="https://d21q7xesnoiieh.cloudfront.net/fit-in/580x0/filters:quality(95)/marketing/guitareo/products/30-days-to-better-strumming/logo-black.png"
                >
                    @php
                        $benefits = [
                            'Daily <br class="block sm:hidden">Guided Lessons',
                            'Learn By <br class="block sm:hidden">Playing Along',
                            'Guaranteed <br class="block sm:hidden">Results'
                        ];
                    @endphp

                    <div class="text-center w-full mb-7 lg:mb-20">
                        @foreach ($benefits as $benefit)
                            <p class="hidden lg:inline p-2 leading-loose">
                                <i class="fas fa-check-circle text-guitareo" aria-hidden="true"></i>
                                {!! $benefit !!}
                            </p>
                        @endforeach
                        <div class="flex inline lg:hidden my-3">
                            @foreach ($benefits as $benefit)
                                <p class="w-1/2 leading-tight">
                                    <i class="fas fa-check-circle text-guitareo" aria-hidden="true"></i><br>
                                    {!! $benefit !!}
                                </p>
                            @endforeach
                        </div>
                    </div>
                    @php
                        $lessons = [
                    [
                        'thumb' => 'https://cdn.sanity.io/images/4032r8py/production/eb806e481f29e1ced1011e427f74860454a67373-1920x1080.jpg',
                        'title' => 'Course Kick-Off',
                        'name' => 'course-kick-off',
                        'videoId' => '944222905',
                        'free' => true
                    ],
                    [
                        'thumb' => 'https://cdn.sanity.io/images/4032r8py/production/82f78fe3d738610f02b183424d41f0634d2704f3-1920x1080.jpg',
                        'title' => 'Gear Tips',
                        'name' => 'gear-tips',
                        'videoId' => '944223382',
                        'free' => true
                    ],
                    [
                        'thumb' => 'https://cdn.sanity.io/images/4032r8py/production/03ff53f012fe9c137bd25e6e4a818bf47c54c316-1920x1080.jpg',
                        'title' => 'Chord Shapes For The Challenge',
                        'name' => 'chord-shapes-challenge',
                        'videoId' => '944223156',
                        'free' => true
                    ],
                    [
                        'thumb' => 'https://cdn.sanity.io/images/4032r8py/production/5a1a9ce37b26df9bd8e6c9b22dbd13f908b752c5-1920x1080.jpg',
                        'title' => 'Day 1 — Get Into The Groove',
                        'name' => 'day1-get-into-groove',
                        'videoId' => '944945269',
                        'free' => true
                    ],
                    [
                        'thumb' => 'https://cdn.sanity.io/images/4032r8py/production/4e7a0db0e163cb79ebed05ec8be78bac503d1626-1920x1080.jpg',
                        'title' => 'Day 2 — Learning To Miss',
                        'name' => 'day2-learning-to-miss',
                        'videoId' => '944235965',
                        'free' => true
                    ],
                    [
                        'thumb' => 'https://cdn.sanity.io/images/4032r8py/production/fc3b3bb51c93b10b1020cf11c31554702c47fbb4-1920x1080.jpg',
                        'title' => 'Day 3 — Add In The Bridge',
                        'name' => 'day3-add-bridge',
                        'videoId' => '944236131',
                        'free' => true
                    ],
                    [
                        'thumb' => 'https://cdn.sanity.io/images/4032r8py/production/84555cfa794ec5e7b94ceec46e1b27151215c5da-1920x1080.jpg',
                        'title' => 'Day 4 — The Campfire Strum Pattern',
                        'name' => 'day4-campfire-strum',
                        'videoId' => '944236343',
                        'free' => true
                    ],
                    [
                        'thumb' => 'https://cdn.sanity.io/images/4032r8py/production/6729ef2d94ebc3aa300d098f38ba7eba017d9305-1920x1080.jpg',
                        'title' => 'Day 5 — Add In A Variation',
                        'name' => 'day5-add-variation',
                        'videoId' => '944236478',
                        'free' => true
                    ],
                    [
                        'thumb' => 'https://cdn.sanity.io/images/4032r8py/production/aea0869e6e8db7396ceb4cd84f5f324ef4da20a3-1920x1080.jpg',
                        'title' => 'Day 6 — The Reggae Strum Pattern',
                        'name' => 'day6-reggae-strum',
                        'videoId' => null
                    ],
                    [
                        'thumb' => 'https://cdn.sanity.io/images/4032r8py/production/5711817b2b1bc8fc2eedf2eb490674017bf3ab18-1920x1080.jpg',
                        'title' => 'Day 7 — Learn To Push Your Chords',
                        'name' => 'day7-push-chords',
                        'videoId' => null
                    ],
                    [
                        'thumb' => 'https://cdn.sanity.io/images/4032r8py/production/cb4b4c2879a046c6b3cce69d9facd9827ac834b7-1920x1080.jpg',
                        'title' => "Day 8 — The Rock 'N' Roll Strum Pattern",
                        'name' => 'day8-rock-roll-strum',
                        'videoId' => null
                    ],
                    [
                        'thumb' => 'https://cdn.sanity.io/images/4032r8py/production/0600a9301d880539f710a128643d086c55bb3b63-1920x1080.jpg',
                        'title' => 'Day 9 — The Too-Many-Ands Strum Pattern',
                        'name' => 'day9-too-many-ands-strum',
                        'videoId' => null
                    ],
                    [
                        'thumb' => 'https://cdn.sanity.io/images/4032r8py/production/978103610f9e5fb75f940469a878f8c75b89ea62-1920x1080.jpg',
                        'title' => 'Day 10 — Coming Up With Your Own Strum Patterns',
                        'name' => 'day10-own-strum-patterns',
                        'videoId' => null
                    ],
                    [
                        'thumb' => 'https://cdn.sanity.io/images/4032r8py/production/a3b672e0d3a087fd4b0bd586a1acdd33f7dc6c43-1920x1080.jpg',
                        'title' => 'Day 11 — Add Variations To Your Strums',
                        'name' => 'day11-strum-variations',
                        'videoId' => null
                    ],
                    [
                        'thumb' => 'https://cdn.sanity.io/images/4032r8py/production/30565737c95d75a91d12ec5bc53860f6f65cfa68-1920x1080.jpg',
                        'title' => 'Day 12 — Adding Accents',
                        'name' => 'day12-adding-accents',
                        'videoId' => null
                    ],
                    [
                        'thumb' => 'https://cdn.sanity.io/images/4032r8py/production/557473e90329029434ec47ea9b986055dc13a8a8-1920x1080.jpg',
                        'title' => 'Day 13 — The 3-3-2 Strum Pattern',
                        'name' => 'day13-332-strum',
                        'videoId' => null
                    ],
                    [
                        'thumb' => 'https://cdn.sanity.io/images/4032r8py/production/265fefe296030073175ab6d30a23b787598bf0b8-1920x1080.jpg',
                        'title' => 'Day 14 — Add Palm Mutes',
                        'name' => 'day14-palm-mutes',
                        'videoId' => null
                    ],
                    [
                        'thumb' => 'https://cdn.sanity.io/images/4032r8py/production/a2fae9d29be5d2ade1258d9484aa055421cb4fd3-1920x1080.jpg',
                        'title' => 'Day 15 — Thinking About Dynamics',
                        'name' => 'day15-dynamics',
                        'videoId' => null
                    ],
                    [
                        'thumb' => 'https://cdn.sanity.io/images/4032r8py/production/5c00bf1ea90312f47dd4229a6328a00089fa9506-1920x1080.jpg',
                        'title' => "Day 16 — Let's Gallop",
                        'name' => 'day16-gallop',
                        'videoId' => null
                    ],
                    [
                        'thumb' => 'https://cdn.sanity.io/images/4032r8py/production/97010e6e1d0d1e6a82b836644074a30da1e519fe-1920x1080.jpg',
                        'title' => 'Day 17 — Give It A Smack',
                        'name' => 'day17-give-smack',
                        'videoId' => null
                    ],
                    [
                        'thumb' => 'https://cdn.sanity.io/images/4032r8py/production/d32628668491939b7812f786900285af075f77ff-1920x1080.jpg',
                        'title' => 'Day 18 — Double It Up',
                        'name' => 'day18-double-it-up',
                        'videoId' => null
                    ],
                    [
                        'thumb' => 'https://cdn.sanity.io/images/4032r8py/production/69dc27c705f939fc679d2add0982cd8aed5f62db-1920x1080.jpg',
                        'title' => 'Day 19 — Put It All Together',
                        'name' => 'day19-put-together',
                        'videoId' => null
                    ],
                    [
                        'thumb' => 'https://cdn.sanity.io/images/4032r8py/production/17b34eaf9a89a4bffaca5b55335e7b242b8b4e95-1920x1080.jpg',
                        'title' => 'Day 20 — Final Performance',
                        'name' => 'day20-final-performance',
                        'videoId' => null
                    ]
                ];
                @endphp
                @include('_partials.components.player-section', [
                    'title' => '30 Days To Better Strumming',
                    'slug' => '30-days-to-better-strumming',
                    'accessibleVideosCount' => !empty($unlocked) ? 8 : 0,
                    'description' => '30 Days To Better Strumming is the perfect course for beginner & intermediate guitarists who have ever felt stuck in their rhythm playing. Get step-by-step guidance to break through barriers and learn techniques that will stick with you for years.',
                    'theme' => 'guitareo',
                    'lightMode' => true,
                    'aside_dark' => '#EFFFFD',
                    'aside_light' => '#fff',
                    'cta' => 'Unlock The Full Course',
                    'link' => '#final',
                    'buttonClass'=> 'text-white',
                    'specs' => '<strong>Instructor:</strong> Kent Shores<br>
                                <strong>Lesson Length:</strong> 30 days<br>
                                <strong>Course Contents:</strong> 20 Workouts',
                ])
            </div>
        </div>
    </section>
    <section class="text-center px-4 sm:px-6 py-10 sm:py-14 lg:py-16">
        <div id="final" class="anchor"></div>
        <div class="max-w-xs sm:max-w-3xl lg:max-w-4xl mx-auto">
            <h4 class="leading-tight mb-7 text-[#3B3B3B]"><strong>Unlock The Full Course</strong></h4>
            <div class="flex flex-col md:flex-row items-center md:items-start justify-center space-y-4 md:space-y-0 md:space-x-4 text-left">
                @php
                    $cards = [
                        [
                            'header' => 'Lifetime Access to 30 Days To <br class="hidden lg:block"/> Better Strumming ',
                            'price' => '$97',
                            'badge_text' => 'COURSE ONLY',
                            'badge_class' => 'border-black',
                            'subheader' => 'One time payment.',
                            'button_text' => 'LEARN MORE',
                            'card_class' => 'bg-white',
                            'button_class' => 'join outline guitareo smaller w-11/12 lg:w-full transition-opacity duration-300 hover:opacity-80  uppercase',
                            'border_class' => 'border-[#64646480] border-opacity-60',
                            'link' => 'https://www.guitareo.com/shop/30-days-to-better-strumming',
                            'description' => [
                                'With the course only, you get:',
                                '<i class="fas fa-check pt-3 pr-1"></i> 20 guided play-along lessons',
                                '<i class="fas fa-check pr-1"></i> 90-day money-back guarantee',
                            ]
                        ],
                        [
                            'header' => '<span class="font-semibold">Unlimited Access to ALL Lessons <br hidden lg:block/> with a Musora Membership</span>',
                            'price' => 'Free',
                            'badge_text' => '1 Year of lessons',
                            'badge_class' => 'border-guitareo text-guitareo',
                            'subheader' => 'For 7 Days',
                            'button_text' => 'LEARN MORE',
                            'button_class' => 'join smaller w-11/12 lg:w-full transition-opacity duration-300 hover:opacity-80 bg-guitareo uppercase',
                            'border_class' => 'border-guitareo bg-[#EFF7FF]',
                            'card_class' => 'bg-[#EFF7FF]',
                            'link' => '/',
                            'description' => [
                                'With the membership, you get:',
                                '<i class="fas fa-check text-guitareo pt-3 pr-1"></i> Step-By-Step Lessons & Guided Workouts',
                                '<i class="fas fa-check text-guitareo pr-1"></i> World-Class Teachers',
                                '<i class="fas fa-check text-guitareo pr-1"></i> 300+ Songs, practice tools & more',
                                '<i class="fas fa-check text-guitareo pr-1"></i> 90-day money-back guarantee',
                            ]
                        ]
                    ];
                @endphp

                @foreach($cards as $index => $card)
                    <div class="w-full sm:w-2/3 md:w-1/2 px-1 relative">
                        <div class="{{$card['card_class']}} text-black overflow-hidden rounded-2xl block mx-auto mb-4 md:mb-0 group border-2 p-4 md:p-9 px-4 {{ $card['border_class'] }}">
                            <div class="inline-block px-2 border rounded-xl {{ $card['badge_class'] }} text-center my-2 lg:my-3">
                                <p class="text-xs px-3 py-1 uppercase"> {!! $card['badge_text'] !!}</p>
                            </div>
                            <h5 class="leading-tight pb-2" id="final2">{!! $card['header'] !!}</h5>

                            <h3 class="my-4 lg:my-6 inline-block"><strong>{{ $card['price'] }}</strong></h3> <p class="leading-tight text-sm my-2 inline-block">{!! $card['subheader'] !!}</p>
                            <a href="{{ $card['link'] }}" class="{{ $card['button_class'] }}">{{ $card['button_text'] }}</a>
                            <div class="text-left mt-3 md:mt-5 inline-block mx-auto">
                                @foreach($card['description'] as $desc)
                                    <p class="text-sm leading-tight py-1">{!! $desc !!}</p>
                                @endforeach
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
@stop
