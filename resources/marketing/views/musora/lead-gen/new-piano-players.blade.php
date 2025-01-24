@extends('musora._partials.layout')

@section('head-includes')
    <title>New Piano Players Start Here | Musora</title>
    <meta property="og:title" content="New Piano Players Start Here | Musora">

    <meta name="description" content="Learn the piano. Play your favorite songs. Start sounding beautiful."/>
    <meta property="og:description" content="Learn the piano. Play your favorite songs. Start sounding beautiful.">

    <meta property="og:image" content="https://d21q7xesnoiieh.cloudfront.net/fit-in/1200x0/filters:quality(95)/marketing/pianote/products/new-piano-players/share-image.jpg">
    <meta property="og:url" content="https://www.musora.com/{{ Request::path() }}">

    @parent

    <link rel="stylesheet" href="{{ mix('marketing/css/app.css') }}">
    <link href="{{ asset('/marketing/css/tailwind-helpers.css') }}" rel="stylesheet">
    <link href="{{ asset('/marketing/parcel/drumeo/sales-2020.css') }}" rel="stylesheet">
    <link href="{{ asset('/marketing/parcel/drumeo/navigation-sales.css') }}" rel="stylesheet">
    <link href="{{ asset('/marketing/parcel/drumeo/lead-gen-learn-songs.css') }}" rel="stylesheet">

    <style>
        .join.outline.pianote {
            background:transparent;
            border:2px solid #F61A30;
            color:#F61A30;
        }
        .join.pianote {
            background:#F61A30;
            border:2px solid #F61A30;
            color:#fff;
        }

        .join.outline.pianote:hover,
        .join.outline.pianote:focus {
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
        
        .ajax-form input {
        display: block;
        width: 100%;
        padding: 0.5rem 1rem; 
        font-size: 1rem; 
        line-height: 1.5;
        color: #374151;
        background-color: #ffffff; 
        border: 1px solid #d1d5db; 
        border-radius: 2rem; 
        box-shadow: 0 1px 2px rgba(0, 0, 0, 0.05); 
        transition: border-color 0.2s, box-shadow 0.2s; 
        }

        .ajax-form input:focus {
        outline: none;
        border-color: #2563eb; 
        box-shadow: 0 0 0 2px rgba(37, 99, 235, 0.5); 
        }

        .ajax-form input::placeholder {
        color: #9ca3af; 
        opacity: 1;
        }

        .ajax-form button {
        color: #ffffff !important;
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
    @if(empty($unlocked))
{{--        TODO: signup modal goes here--}}
    @endif
    <section class="text-center px-4 md:px-6 py-8 md:py-12 lg:py-16">
        <div x-intersect.once="visible = true;">
            <div class="container max-w-5xl mx-auto">
                <img
                    alt="Logo"
                    class="h-20 sm:h-24 lg:h-28 mx-auto mb-2"
                    src="https://d21q7xesnoiieh.cloudfront.net/fit-in/800x0/filters:quality(95)/marketing/pianote/products/new-piano-players/new-piano-players-logo.png"
                >
                    @php
                        $benefits = [
                            'Learn By <br class="block sm:hidden">Doing',
                            'Play <br class="block sm:hidden">Every Day',
                            'No Theory <br class="block sm:hidden">Required'
                        ];
                    @endphp

                    <div class="text-center w-full mb-7 lg:mb-20">
                        @foreach ($benefits as $benefit)
                            <p class="hidden lg:inline p-2 leading-loose">
                                <i class="fas fa-check-circle text-pianote" aria-hidden="true"></i>
                                {!! $benefit !!}
                            </p>
                        @endforeach
                        <div class="flex inline lg:hidden my-3">
                            @foreach ($benefits as $benefit)
                                <p class="w-1/2 leading-tight">
                                    <i class="fas fa-check-circle text-pianote" aria-hidden="true"></i><br>
                                    {!! $benefit !!}
                                </p>
                            @endforeach
                        </div>
                    </div>
                   @php
                    $lessons = [
                    [
                        'thumb' => 'https://cdn.sanity.io/images/4032r8py/production/32836468d4eec2d19b5156a010cf303d8530994e-1920x1081.jpg',
                        'title' => 'Course Kick-Off',
                        'name' => 'course-kick-off',
                        'videoId' => '886627419',
                        'free' => true
                    ],
                    [
                        'thumb' => 'https://cdn.sanity.io/images/4032r8py/production/051b241d41cf990010a94858eb30635f65e561b5-1920x1080.jpg',
                        'title' => "Let's Get Started",
                        'name' => 'lets-get-started',
                        'videoId' => '797858281',
                        'free' => true
                    ],
                    [
                        'thumb' => 'https://cdn.sanity.io/images/4032r8py/production/caf485e118606f9e96d873c9912183cba968d5da-1920x1080.jpg',
                        'title' => 'Day 1 — Your First Chord Progression',
                        'name' => 'day1-first-chord-progression',
                        'videoId' => '802011057',
                        'free' => true
                    ],
                    [
                        'thumb' => 'https://cdn.sanity.io/images/4032r8py/production/6dc8c19c88880b3e36689dcab38dba53f55a24e4-1920x1080.jpg',
                        'title' => 'Day 2 — Make It Musical',
                        'name' => 'day2-make-it-musical',
                        'videoId' => '802011087',
                        'free' => true
                    ],
                    [
                        'thumb' => 'https://cdn.sanity.io/images/4032r8py/production/9c2e85d9a6854d9e7efbad50a376c7fe59de96b9-1920x1080.jpg',
                        'title' => 'Day 3 — Your First Left Hand Chords',
                        'name' => 'day3-first-left-hand-chords',
                        'videoId' => '802011113',
                        'free' => true
                    ],
                    [
                        'thumb' => 'https://cdn.sanity.io/images/4032r8py/production/6d0921b443a24bdc7ec8f9dabf53578479a7effd-1920x1080.jpg',
                        'title' => 'Day 4 — Playing With Both Hands',
                        'name' => 'day4-playing-both-hands',
                        'videoId' => '802011140',
                        'free' => true
                    ],
                    [
                        'thumb' => 'https://cdn.sanity.io/images/4032r8py/production/e501cfd5d6c9db0b34299ba01a69e188fb47c3d3-1920x1080.jpg',
                        'title' => 'Day 5 — Feeling Comfortable',
                        'name' => 'day5-feeling-comfortable',
                        'videoId' => '891176724',
                        'free' => true
                    ],
                    [
                        'thumb' => 'https://cdn.sanity.io/images/4032r8py/production/0955970b2722e4bf79aaeb1c1ca387e30581d32a-1920x1080.jpg',
                        'title' => 'Day 6 — Real Chords',
                        'name' => 'day6-real-chords',
                        'videoId' => null
                    ],
                    [
                        'thumb' => 'https://cdn.sanity.io/images/4032r8py/production/fe3bb0872d339af3c43ba5944a50059aebbbcc19-1920x1080.jpg',
                        'title' => 'Day 7 — Real Chords Hands Together',
                        'name' => 'day7-real-chords-hands-together',
                        'videoId' => null
                    ],
                    [
                        'thumb' => 'https://cdn.sanity.io/images/4032r8py/production/03f5de619b62a8635e6a9293ce56f00b0739627d-1920x1080.jpg',
                        'title' => 'Day 8 — A More Exciting Left Hand',
                        'name' => 'day8-exciting-left-hand',
                        'videoId' => null
                    ],
                    [
                        'thumb' => 'https://cdn.sanity.io/images/4032r8py/production/d09b7722d49dcf2fde72209a0fa8807b690d2224-1920x1080.jpg',
                        'title' => 'Day 9 — Feeling Confident',
                        'name' => 'day9-feeling-confident',
                        'videoId' => null
                    ],
                    [
                        'thumb' => 'https://cdn.sanity.io/images/4032r8py/production/852a318d7ed3541a7c5321d9b8d95130808870dc-1920x1080.jpg',
                        'title' => 'Day 10 — Start Sounding Better',
                        'name' => 'day10-start-sounding-better',
                        'videoId' => null
                    ],
                    [
                        'thumb' => 'https://cdn.sanity.io/images/4032r8py/production/e749d14024fb3f60a8a7a9be3e2753192de2ad37-1920x1080.jpg',
                        'title' => 'Day 11 — Quarter Notes',
                        'name' => 'day11-quarter-notes',
                        'videoId' => null
                    ],
                    [
                        'thumb' => 'https://cdn.sanity.io/images/4032r8py/production/0f739afe1a2f406f48c75acfba72a003d54fb1d0-1920x1080.jpg',
                        'title' => 'Day 12 — Half Notes',
                        'name' => 'day12-half-notes',
                        'videoId' => null
                    ],
                    [
                        'thumb' => 'https://cdn.sanity.io/images/4032r8py/production/b5ea780ab60a3cdffdc75ca381d7071d5dedf7cb-1920x1080.jpg',
                        'title' => 'Day 13 — Gaining Confidence With Rhythm',
                        'name' => 'day13-gaining-confidence-rhythm',
                        'videoId' => null
                    ],
                    [
                        'thumb' => 'https://cdn.sanity.io/images/4032r8py/production/801a728c56d89d0727f17b32b9c57a0823d2a1ba-1920x1080.jpg',
                        'title' => 'Day 14 — A Beautiful Pattern',
                        'name' => 'day14-beautiful-pattern',
                        'videoId' => null
                    ],
                    [
                        'thumb' => 'https://cdn.sanity.io/images/4032r8py/production/d54aa2adc394bc56aa554373945093d298c39025-1920x1080.jpg',
                        'title' => 'Day 15 — An Even More Beautiful Pattern',
                        'name' => 'day15-more-beautiful-pattern',
                        'videoId' => null
                    ],
                    [
                        'thumb' => 'https://cdn.sanity.io/images/4032r8py/production/dc21c05b003a51bb84675944f35661492b76cc63-1920x1080.jpg',
                        'title' => 'Day 16 — Making It Fancy',
                        'name' => 'day16-making-it-fancy',
                        'videoId' => null
                    ],
                    [
                        'thumb' => 'https://cdn.sanity.io/images/4032r8py/production/b81b5cbedf3c04418544c7a4cd5aaddbeaee99cf-1920x1080.jpg',
                        'title' => 'Day 17 — Adding Power',
                        'name' => 'day17-adding-power',
                        'videoId' => null
                    ],
                    [
                        'thumb' => 'https://cdn.sanity.io/images/4032r8py/production/8349f91ec09c89f23427ed26af48a567149f8c67-1920x1080.jpg',
                        'title' => 'Day 18 — A Beautiful Chord Secret',
                        'name' => 'day18-beautiful-chord-secret',
                        'videoId' => null
                    ],
                    [
                        'thumb' => 'https://cdn.sanity.io/images/4032r8py/production/86595d1d52230c2229c1605a6ff9d3db1af53977-1920x1080.jpg',
                        'title' => 'Day 19 — Preparing For Your Best Performance',
                        'name' => 'day19-preparing-best-performance',
                        'videoId' => null
                    ],
                    [
                        'thumb' => 'https://cdn.sanity.io/images/4032r8py/production/5b7b9a46917101e3bc1c89489b8887a16f09d155-1920x1080.jpg',
                        'title' => 'Day 20 — Your Best Performance',
                        'name' => 'day20-best-performance',
                        'videoId' => null
                    ]
                    ];
                @endphp
                @include('_partials.components.player-section', [
                    'title' => 'New Piano Players Start Here',
                    'slug' => 'new-piano-players-start-here',
                    'accessibleVideosCount' => !empty($unlocked) ? 7 : 0,
                    'description' => 'Piano lessons can be super intimidating. “So many keys! All that music theory! How do I even get my hands to play at the same time?!” New Piano Players Start Here is different. You just sit down, press play, and follow along as Lisa guides you through a daily 10-minute lesson.<br><br>Lisa focuses on the fun and gets you playing songs from day one. When you’re done, you’ll have a well-established piano-playing habit, some very important skills, and the confidence that YES…! You can play the piano. ',
                    'theme' => 'pianote',
                    'lightMode' => true,
                    'aside_dark' => '#FFF2F3',
                    'aside_light' => '#fff',
                    'cta' => 'Unlock The Full Course',
                    'link' => '#final',
                    'buttonClass'=> 'text-white',
                    'specs' => '<strong>Instructor:</strong> Lisa Witt<br>
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
                            'header' => 'Lifetime Access to New Piano Players <br class="hidden lg:block"/> Start Here',
                            'price' => '$127',
                            'badge_text' => 'COURSE ONLY',
                            'badge_class' => 'border-black',
                            'subheader' => 'One time payment.',
                            'button_text' => 'LEARN MORE',
                            'card_class' => 'bg-white',
                            'button_class' => 'join outline pianote smaller w-11/12 lg:w-full transition-opacity duration-300 hover:opacity-80  uppercase',
                            'border_class' => 'border-[#64646480] border-opacity-60',
                            'link' => 'https://www.pianote.com/shop/new-piano-players',
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
                            'badge_class' => 'border-pianote text-pianote',
                            'subheader' => 'For 7 Days',
                            'button_text' => 'LEARN MORE',
                            'button_class' => 'join smaller w-11/12 lg:w-full transition-opacity duration-300 hover:opacity-80 bg-pianote uppercase',
                            'border_class' => 'border-pianote bg-[#EFF7FF]',
                            'card_class' => 'bg-[#EFF7FF]',
                            'link' => '/',
                            'description' => [
                                'With the membership, you get:',
                                '<i class="fas fa-check text-pianote pt-3 pr-1"></i> Step-By-Step Lessons & Guided Workouts',
                                '<i class="fas fa-check text-pianote pr-1"></i> World-Class Teachers',
                                '<i class="fas fa-check text-pianote pr-1"></i> 300+ Songs, practice tools & more',
                                '<i class="fas fa-check text-pianote pr-1"></i> 90-day money-back guarantee',
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
