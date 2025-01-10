@extends('musora._partials.layout')

@section('head-includes')
    <title>30-Day Drummer | Musora</title>
    <meta property="og:title" content="30-Day Drummer | Musora">

    <meta name="description" content="Learn the drums with daily guided workouts."/>
    <meta property="og:description" content="Learn the drums with daily guided workouts.">

    <meta property="og:image" content="https://d21q7xesnoiieh.cloudfront.net/fit-in/1200x0/marketing/drumeo/products/30-day-drummer/season-4/share-image.jpg">
    <meta property="og:url" content="https://www.musora.com/{{ Request::path() }}">

    @parent

    <link rel="stylesheet" href="{{ mix('marketing/css/app.css') }}">
    <link href="{{ asset('/marketing/css/tailwind-helpers.css') }}" rel="stylesheet">
    <link href="{{ asset('/marketing/parcel/drumeo/sales-2020.css') }}" rel="stylesheet">
    <link href="{{ asset('/marketing/parcel/drumeo/navigation-sales.css') }}" rel="stylesheet">
    <style>

        .join.outline {
            background:transparent;
            border:2px solid #fff;
            color:#fff;
        }

        .join.outline:hover,
        .join.outline:focus {
            background:#fff;
            color:#000;
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
    @if(empty($unlocked))
{{--        TODO: signup modal goes here--}}
    @endif
    <section class="text-center px-4 md:px-6 py-8 md:py-12 lg:py-16">
        <div x-intersect.once="visible = true;">
            <div class="container max-w-6xl mx-auto">
                <img
                    alt="Challenge Logo"
                    class="h-24 sm:h-28 lg:h-32 mx-auto mb-2"
                    src="https://d21q7xesnoiieh.cloudfront.net/fit-in/580x0/marketing/drumeo/products/30-day-drummer/30DayDrummerSeason3-Logo-10.png"
                >
                @php
                    $benefits = [
                        'Improve Your <br class="block sm:hidden">Skills',
                        'Drum <br class="block sm:hidden">Every Day',
                        'Learn By <br class="block sm:hidden">Doing'
                    ];
                @endphp

                <div class="text-center w-full mb-7 lg:mb-20">
                    @foreach ($benefits as $benefit)
                        <p class="hidden lg:inline p-2 leading-loose">
                            <i class="fas fa-check-circle text-drumeo" aria-hidden="true"></i>
                            {!! $benefit !!}
                        </p>
                    @endforeach
                    <div class="flex inline lg:hidden my-3">
                        @foreach ($benefits as $benefit)
                            <p class="w-1/2 leading-tight">
                                <i class="fas fa-check-circle text-drumeo" aria-hidden="true"></i><br>
                                {!! $benefit !!}
                            </p>
                        @endforeach
                    </div>
                </div>
               @php
                 $lessons = [
                      [
                        'thumb' => 'https://cdn.sanity.io/images/4032r8py/staging/590ae25f0258d3d5b627ba7161cb57406bb009ec-1920x1080.jpg',
                        'title' => 'Course Kick-Off',
                        'name' => 'coursekick-off',
                        'videoId' => '887785770',
                        'free' => true
                    ],
                    [
                        'thumb' => 'https://cdn.sanity.io/images/4032r8py/staging/5f6e4a44b57d4a72bea8f3befece1df97f552e91-1920x1080.jpg',
                        'title' => 'Day 1 – Your First Drum Beat – Lesson',
                        'name' => 'day1-yourfirstdrumbeat-lesson',
                        'videoId' => '887787268',
                        'free' => true
                    ],
                    [
                        'thumb' => 'https://cdn.sanity.io/images/4032r8py/staging/9afaf6258d5d687f1fe6cd8dd3b0761c1023dd8a-1920x1080.jpg',
                        'title' => 'Day 2 – Your First Drum Beat – Workout 1',
                        'name' => 'day2-yourfirstdrumbeat-workout1',
                        'videoId' => '887787391',
                        'free' => true
                    ],
                    [
                        'thumb' => 'https://cdn.sanity.io/images/4032r8py/staging/12d17c7a1f70551e987f3eff38694b162f7feb45-1920x1080.jpg',
                        'title' => 'Day 3 – Your First Drum Beat – Workout 2',
                        'name' => 'day3-yourfirstdrumbeat-workout2',
                        'videoId' => '887787490',
                        'free' => true
                    ],
                    [
                        'thumb' => 'https://cdn.sanity.io/images/4032r8py/staging/5f05758bfdd6e879666f125dddcf5ee59763a3eb-1920x1080.jpg',
                        'title' => 'Day 4 – Your First Drum Beat – Workout 3',
                        'name' => 'day4-yourfirstdrumbeat-workout3',
                        'videoId' => '887787563',
                        'free' => true
                    ],
                    [
                        'thumb' => 'https://cdn.sanity.io/images/4032r8py/staging/6f91509e648882056293acc4a211751e549bed84-1920x1080.jpg',
                        'title' => 'Day 5 – Your First Drum Beat – Workout 4',
                        'name' => 'day5-yourfirstdrumbeat-workout4',
                        'videoId' => '887787661',
                        'free' => true
                    ],
                    [
                        'thumb' => 'https://cdn.sanity.io/images/4032r8py/staging/ac3356e3bf6198e04ec4d65d52330564befb1341-1920x1080.jpg',
                        'title' => 'Day 6 – Doubling It Up – Lesson',
                        'name' => 'day6-doublingitup-lesson',
                        'videoId' => null
                    ],
                    [
                        'thumb' => 'https://cdn.sanity.io/images/4032r8py/staging/b50511f9017b4f0ace396901fa89b3f3211fbafa-1920x1080.jpg',
                        'title' => 'Day 7 – Doubling It Up – Workout 1',
                        'name' => 'day7-doublingitup-workout1',
                        'videoId' => null
                    ],
                    [
                        'thumb' => 'https://cdn.sanity.io/images/4032r8py/staging/f53cd343e2b246e9258b1a7ed5a4dd1c9cb233ca-1920x1080.jpg',
                        'title' => 'Day 8 – Doubling It Up – Workout 2',
                        'name' => 'day8-doublingitup-workout2',
                        'videoId' => null
                    ],
                    [
                        'thumb' => 'https://cdn.sanity.io/images/4032r8py/staging/cc50318e51b480b4999600b618fd32e30406ac44-1920x1080.jpg',
                        'title' => 'Day 9 – Doubling It Up – Workout 3',
                        'name' => 'day9-doublingitup-workout3',
                        'videoId' => null
                    ],
                    [
                        'thumb' => 'https://cdn.sanity.io/images/4032r8py/staging/f3a7803915d40aa1f171dd3f592a1c36244b86ca-1920x1080.jpg',
                        'title' => 'Day 10 – Doubling It Up – Workout 4',
                        'name' => 'day10-doublingitup-workout4',
                        'videoId' => null
                    ],
                    [
                        'thumb' => 'https://cdn.sanity.io/images/4032r8py/staging/abcd632bfeb1fab7c2847d44fbaa8d96649056d7-1920x1080.jpg',
                        'title' => 'Day 11 – Adding Fills & Crashes – Lesson',
                        'name' => 'day11-addingfills&crashes-lesson',
                        'videoId' => null
                    ],
                    [
                        'thumb' => 'https://cdn.sanity.io/images/4032r8py/staging/aa72f2fd805a324454cb92ac944645e4c45d0c18-1920x1080.jpg',
                        'title' => 'Day 12 – Adding Fills & Crashes – Workout 1',
                        'name' => 'day12-addingfills&crashes-workout1',
                        'videoId' => null
                    ],
                    [
                        'thumb' => 'https://cdn.sanity.io/images/4032r8py/staging/cc25ee7fdcc09f6d131faa80d3c2d7a6f61088bc-1920x1080.jpg',
                        'title' => 'Day 13 – Adding Fills & Crashes – Workout 2',
                        'name' => 'day13-addingfills&crashes-workout2',
                        'videoId' => null
                    ],
                    [
                        'thumb' => 'https://cdn.sanity.io/images/4032r8py/staging/1aab0dbd932331fe4b544ae8fae226ff1d45aacc-1920x1080.jpg',
                        'title' => 'Day 14 – Adding Fills & Crashes – Workout 3',
                        'name' => 'day14-addingfills&crashes-workout3',
                        'videoId' => null
                    ],
                    [
                        'thumb' => 'https://cdn.sanity.io/images/4032r8py/staging/5a83666de2b6125a40d7848bd47e86cafcb70afb-1920x1080.jpg',
                        'title' => 'Day 15 – Adding Fills & Crashes – Workout 4',
                        'name' => 'day15-addingfills&crashes-workout4',
                        'videoId' => null
                    ],
                    [
                        'thumb' => 'https://cdn.sanity.io/images/4032r8py/staging/6f9098cba40dd97d457b7d167db4023de03e5869-1920x1080.jpg',
                        'title' => 'Day 16 – Your First Song – Lesson',
                        'name' => 'day16-yourfirstsong-lesson',
                        'videoId' => null
                    ],
                    [
                        'thumb' => 'https://cdn.sanity.io/images/4032r8py/staging/13ed16b1dab21b59339bb449be1f11a653fd8279-1920x1080.jpg',
                        'title' => 'Day 17 – Your First Song – Workout 1',
                        'name' => 'day17-yourfirstsong-workout1',
                        'videoId' => null
                    ],
                    [
                        'thumb' => 'https://cdn.sanity.io/images/4032r8py/staging/71a3c1a62a4c1c8ffcd95f63d32349f4890e8e84-1920x1080.jpg',
                        'title' => 'Day 18 – Your First Song – Workout 2',
                        'name' => 'day18-yourfirstsong-workout2',
                        'videoId' => null
                    ],
                    [
                        'thumb' => 'https://cdn.sanity.io/images/4032r8py/staging/60c98136b3b6a32dc73784c3480507c751478aca-1920x1080.jpg',
                        'title' => 'Day 19 – Your First Song – Workout 3',
                        'name' => 'day19-yourfirstsong-workout3',
                        'videoId' => null
                    ],
                    [
                        'thumb' => 'https://cdn.sanity.io/images/4032r8py/staging/41674bd0ddb956715bb353be05064bb3b52fdd33-1920x1080.jpg',
                        'title' => 'Day 20 – Your First Song – Workout 4',
                        'name' => 'day20-yourfirstsong-workout4',
                        'videoId' => null
                    ]
                ];
                @endphp
            
                @include('_partials.components.player-section', [
                    'title' => '30-Day Drummer',
                    'slug' => '30-day-drummer',
                    'accessibleVideosCount' => !empty($unlocked) ? 6 : 0,
                    'description' => '30-Day Drummer is a NEW way to learn the drums – where you learn by actually playing the drums. By focusing on timing & coordination, you’ll build your skills over thirty days following daily guided workouts with your instructor, Domino Santantonio. And the best part is you only need 10 minutes per day.',
                    'theme' => 'drumeo',
                    'lightMode' => true,
                    'aside_dark' => '#EDF6FF',
                    'aside_light' => '#fff',
                    'cta' => 'Unlock The Full Course',
                    'link' => '#final',
                    'buttonClass'=> 'text-white',
                    'specs' => '<strong>Instructor:</strong> Domino Sanantonio<br>
                                <strong>Lesson Length:</strong> 30 days<br>
                                <strong>Course Contents:</strong> 20 Workouts, 4 Q&A’s',
                ])
            </div>
        </div>
    </section>
    <section class="text-center px-4 sm:px-6 py-10 sm:py-14 lg:py-20">
        <div id="final" class="anchor"></div>
        <div class="max-w-xs sm:max-w-3xl lg:max-w-4xl mx-auto">
            <h4 class="leading-tight mb-7"><strong>Unlock The Full Course</strong></h4>
            <div class="flex flex-col md:flex-row items-center md:items-start justify-center space-y-4 md:space-y-0 md:space-x-4 text-left">
                @php
                    $cards = [
                        [
                            'header' => 'Lifetime Access to 30-Day Drummer',
                            'price' => '$99',
                            'badge_text' => 'COURSE ONLY',
                            'badge_class' => 'border-black',
                            'subheader' => 'One time payment.',
                            'button_text' => 'LEARN MORE',
                            'card_class' => 'bg-white',
                            'button_class' => 'join outline drumeo smaller w-11/12 lg:w-full transition-opacity duration-300 hover:opacity-80  uppercase',
                            'border_class' => 'border-gray-300',
                            'link' => 'https://www.drumeo.com/drumshop/30-day-drummer',
                            'description' => [
                                'With the course only, you get:',
                                '<i class="fas fa-check pt-3 pr-1"></i> 20 guided play-along lessons',
                                '<i class="fas fa-check pr-1"></i> 4 recorded Q&A’s with Domino',
                                '<i class="fas fa-check pr-1"></i> 90-day money-back guarantee',
                            ]
                        ],
                        [
                            'header' => '<span class="font-semibold">Unlimited Access to ALL Lessons <br/> with a Musora Membership</span>',
                            'price' => 'Free',
                            'badge_text' => '1 Year of lessons',
                            'badge_class' => 'border-drumeo text-drumeo',
                            'subheader' => 'For 7 Days',
                            'button_text' => 'LEARN MORE',
                            'button_class' => 'join smaller w-11/12 lg:w-full transition-opacity duration-300 hover:opacity-80 bg-drumeo uppercase',
                            'border_class' => 'border-drumeo bg-[#EFF7FF]',
                            'card_class' => 'bg-[#EFF7FF]',
                            'link' => '/choose-plan',
                            'description' => [
                                'With the membership, you get:',
                                '<i class="fas fa-check text-drumeo pt-3 pr-1"></i> Step-By-Step Lessons & Guided Workouts',
                                '<i class="fas fa-check text-drumeo pr-1"></i> World-Class Teachers',
                                '<i class="fas fa-check text-drumeo pr-1"></i> 300+ Songs, practice tools & more',
                                '<i class="fas fa-check text-drumeo pr-1"></i> 90-day money-back guarantee',
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
