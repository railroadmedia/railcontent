@extends('musora._partials.layout')

@section('head-includes')
    <title>Everyday Improv | Musora</title>
    <meta property="og:title" content="Everyday Improv | Musora">

    <meta name="description" content="Sing Freely With The Power Of Vocal Improvisation."/>
    <meta property="og:description" content="Sing Freely With The Power Of Vocal Improvisation.">

    <meta property="og:image" content="https://d21q7xesnoiieh.cloudfront.net/fit-in/1200x0/filters:quality(95)/marketing/singeo/products/everyday-improv/timeline-05.webp">
    <meta property="og:url" content="https://www.musora.com/{{ Request::path() }}">

    @parent

    <link rel="stylesheet" href="{{ mix('marketing/css/app.css') }}">
    <link href="{{ asset('/marketing/css/tailwind-helpers.css') }}" rel="stylesheet">
    <link href="{{ asset('/marketing/parcel/drumeo/sales-2020.css') }}" rel="stylesheet">
    <link href="{{ asset('/marketing/parcel/drumeo/navigation-sales.css') }}" rel="stylesheet">
    <style>
        .join.outline.singeo {
            background:transparent;
            border:2px solid #8300e9;
            color:#8300e9;
        }
        .join.singeo {
            background:#8300e9;
            border:2px solid #8300e9;
            color:#fff;
        }

        .join.outline.singeo:hover,
        .join.outline.singeo:focus {
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
                    src="https://d21q7xesnoiieh.cloudfront.net/fit-in/770x0/marketing/singeo/products/everyday-improv/enrollment/logo.webp"
                >
                    @php
                        $benefits = [
                            'Improve <br class="block sm:hidden">Your Skills',
                            'Practice <br class="block sm:hidden">Every Day',
                            'Learn By <br class="block sm:hidden">Doing'
                        ];
                    @endphp

                    <div class="text-center w-full mb-7 lg:mb-20">
                        @foreach ($benefits as $benefit)
                            <p class="hidden lg:inline p-2 leading-loose">
                                <i class="fas fa-check-circle text-singeo" aria-hidden="true"></i>
                                {!! $benefit !!}
                            </p>
                        @endforeach
                        <div class="flex inline lg:hidden my-3">
                            @foreach ($benefits as $benefit)
                                <p class="w-1/2 leading-tight">
                                    <i class="fas fa-check-circle text-singeo" aria-hidden="true"></i><br>
                                    {!! $benefit !!}
                                </p>
                            @endforeach
                        </div>
                    </div>

                @php
                $lessons = [
                [
                    'thumb' => 'https://cdn.sanity.io/images/4032r8py/production/157c1509050a0cf2ebfe6001da8dfd895707c435-1920x1080.jpg',
                    'title' => 'Course Kick-Off',
                    'name' => 'course-kick-off',
                    'videoId' => '1018701908',
                    'free' => true
                ],
                [
                    'thumb' => 'https://cdn.sanity.io/images/4032r8py/production/92fae38ae07658bf168a36cf7d42057d5826b800-1920x1080.jpg',
                    'title' => 'Day 1 — What Is Improvisation',
                    'name' => 'day1-what-is-improvisation',
                    'videoId' => '1022968627',
                    'free' => true
                ],
                [
                    'thumb' => 'https://cdn.sanity.io/images/4032r8py/production/09e66711456f793db0c1a95dcf2b6e01d6068187-1920x1080.jpg',
                    'title' => 'Day 2 — Warm-Up',
                    'name' => 'day2-warm-up',
                    'videoId' => '1022969054',
                    'free' => true
                ],
                [
                    'thumb' => 'https://cdn.sanity.io/images/4032r8py/production/2b043ae573b82db3536737c18378689b79c5ab01-1920x1080.jpg',
                    'title' => 'Day 3 — Find Your Range',
                    'name' => 'day3-find-your-range',
                    'videoId' => '1022969286',
                    'free' => true
                ],
                [
                    'thumb' => 'https://cdn.sanity.io/images/4032r8py/production/048466e968f830e74b8779ac8a080dac07a2ce3a-1920x1080.jpg',
                    'title' => 'Day 4 — Pitch Matching',
                    'name' => 'day4-pitch-matching',
                    'videoId' => '1033615467',
                    'free' => true
                ],
                [
                    'thumb' => 'https://cdn.sanity.io/images/4032r8py/production/44a0201e3aba6cf59f78089ea695e748783c9b2b-1920x1080.jpg',
                    'title' => 'Day 5 — How To Make The Wrong Note Right',
                    'name' => 'day5-wrong-note-right',
                    'videoId' => '1033615674',
                    'free' => true
                ],
                [
                    'thumb' => 'https://cdn.sanity.io/images/4032r8py/production/fbd34bbc2716efa617f6b6d56582a4e718c5aade-1920x1080.jpg',
                    'title' => 'Day 6 — Guided Practice With Emma',
                    'name' => 'day6-guided-practice',
                    'videoId' => null
                ],
                [
                    'thumb' => 'https://cdn.sanity.io/images/4032r8py/production/43b2d9f6b2bac64797f5564b75ce134b10e08523-1920x1080.jpg',
                    'title' => 'Day 7 — Rest & Reflect',
                    'name' => 'day7-rest-reflect',
                    'videoId' => null
                ],
                [
                    'thumb' => 'https://cdn.sanity.io/images/4032r8py/production/11bcd96b876dfbc5ae6b9dde66b412815b144793-1920x1080.jpg',
                    'title' => 'Day 7 — Syllables',
                    'name' => 'day7-syllables',
                    'videoId' => null
                ],
                [
                    'thumb' => 'https://cdn.sanity.io/images/4032r8py/production/a287cce79b0454a5825b38b832cc105b6ffe5f77-1920x1080.jpg',
                    'title' => 'Day 8 — Rhythm',
                    'name' => 'day8-rhythm',
                    'videoId' => null
                ],
                [
                    'thumb' => 'https://cdn.sanity.io/images/4032r8py/production/529647ef940300d84a6e8c51e598ece3e4c97f2b-1920x1080.jpg',
                    'title' => 'Day 9 — Dynamics',
                    'name' => 'day9-dynamics',
                    'videoId' => null
                ],
                [
                    'thumb' => 'https://cdn.sanity.io/images/4032r8py/production/bcc136386a6876e9c6b7bcef1def6d921820de73-1920x1080.jpg',
                    'title' => 'Day 10 — Melody',
                    'name' => 'day10-melody',
                    'videoId' => null
                ],
                [
                    'thumb' => 'https://cdn.sanity.io/images/4032r8py/production/e4b730b04f949d8bfe74192faaaa8a3d1f3491ec-1920x1080.jpg',
                    'title' => 'Day 11 — The Scat Improv',
                    'name' => 'day11-scat-improv',
                    'videoId' => null
                ],
                [
                    'thumb' => 'https://cdn.sanity.io/images/4032r8py/production/fab5fd6efbf76c334c0f04b56be53bc4ccc1e9eb-1920x1080.jpg',
                    'title' => 'Day 12 — Guided Practice With Emma',
                    'name' => 'day12-guided-practice',
                    'videoId' => null
                ],
                [
                    'thumb' => 'https://cdn.sanity.io/images/4032r8py/production/409558e4a2498ba534eb9fa8391c3fe09ee0d879-1920x1080.jpg',
                    'title' => 'Day 13 — A New Way Of Thinking',
                    'name' => 'day13-new-way-thinking',
                    'videoId' => null
                ],
                [
                    'thumb' => 'https://cdn.sanity.io/images/4032r8py/production/7195012977b9adf56eefe09277b62f6024b62c15-1920x1080.jpg',
                    'title' => 'Day 14 — Rest & Reflect',
                    'name' => 'day14-rest-reflect',
                    'videoId' => null
                ],
                [
                    'thumb' => 'https://cdn.sanity.io/images/4032r8py/production/74f838aff72eda01d22574c66403e0229c981d55-1920x1080.jpg',
                    'title' => 'Day 14 — Singing Is Instrumental',
                    'name' => 'day14-singing-instrumental',
                    'videoId' => null
                ],
                [
                    'thumb' => 'https://cdn.sanity.io/images/4032r8py/production/8f29d8c46cee4f6e8e660d6b95fe51b6a071aa47-1920x1080.jpg',
                    'title' => 'Day 15 — Call & Response',
                    'name' => 'day15-call-response',
                    'videoId' => null
                ],
                [
                    'thumb' => 'https://cdn.sanity.io/images/4032r8py/production/12f4ab7f2a7d8aa808be93959843708f3fac4f9d-1920x1080.jpg',
                    'title' => 'Day 16 — Fishbowl Fundamentals',
                    'name' => 'day16-fishbowl-fundamentals',
                    'videoId' => null
                ],
                [
                    'thumb' => 'https://cdn.sanity.io/images/4032r8py/production/b8eb66e9d16a6870df2f35ba0d3a1bbb93072173-1920x1080.jpg',
                    'title' => 'Day 17 — Being Comfortable With Being Uncomfortable',
                    'name' => 'day17-being-comfortable',
                    'videoId' => null
                ],
                [
                    'thumb' => 'https://cdn.sanity.io/images/4032r8py/production/6746a57386c0ba2f280234c500c5557b39468736-1920x1080.jpg',
                    'title' => 'Day 18 — Guided Practice With Emma',
                    'name' => 'day18-guided-practice',
                    'videoId' => null
                ],
                [
                    'thumb' => 'https://cdn.sanity.io/images/4032r8py/production/5446e6b7b408b43e395ec2d8795df196a963a23f-1920x1080.jpg',
                    'title' => 'Day 19 — Vocal Run: Level 1',
                    'name' => 'day19-vocal-run-1',
                    'videoId' => null
                ],
                [
                    'thumb' => 'https://cdn.sanity.io/images/4032r8py/production/a1cedf7ccd4c7ad89d756f015020b91331d38de4-1920x1080.jpg',
                    'title' => 'Day 20 — Vocal Run: Level 2',
                    'name' => 'day20-vocal-run-2',
                    'videoId' => null
                ],
                [
                    'thumb' => 'https://cdn.sanity.io/images/4032r8py/production/11cadb986a5a82112e2b73f7f96655514d0f39f9-1920x1080.jpg',
                    'title' => 'Day 21 — Vocal Run: Level 3',
                    'name' => 'day21-vocal-run-3',
                    'videoId' => null
                ],
                [
                    'thumb' => 'https://cdn.sanity.io/images/4032r8py/production/acdef03f47d5f7fec85a01141ea2b15b09b28c86-1920x1080.jpg',
                    'title' => 'Day 21 — Rest & Reflect',
                    'name' => 'day21-rest-reflect',
                    'videoId' => null
                ],
                [
                    'thumb' => 'https://cdn.sanity.io/images/4032r8py/production/365d47388980ba9971f36a3b41f1f300d670dc29-1920x1080.jpg',
                    'title' => 'Day 22 — Course Review: Part 1',
                    'name' => 'day22-course-review-1',
                    'videoId' => null
                ],
                [
                    'thumb' => 'https://cdn.sanity.io/images/4032r8py/production/aaf207d906cd1ae2fec547fc3699a96f077a0f43-1920x1080.jpg',
                    'title' => 'Day 23 — Course Review: Part 2',
                    'name' => 'day23-course-review-2',
                    'videoId' => null
                ],
                [
                    'thumb' => 'https://cdn.sanity.io/images/4032r8py/production/0736ea71ef0c11eff453966be2a9d6b376317c3e-1920x1080.jpg',
                    'title' => 'Day 24 — Guided Practice With Emma',
                    'name' => 'day24-guided-practice',
                    'videoId' => null
                ],
                 [
                    'thumb' => 'https://cdn.sanity.io/images/4032r8py/production/365b420f39cdc280a20505f3b81030b1d92860be-1920x1080.jpg',
                    'title' => 'Day 25 — Congratulations/Next Steps',
                    'name' => 'day25-congratulations',
                    'videoId' => null
                ],
                [
                    'thumb' => 'https://cdn.sanity.io/images/4032r8py/production/3f246219fa3365bf8fc0b57a50820c772137adcb-1920x1080.jpg',
                    'title' => 'Day 28 — Rest & Reflect',
                    'name' => 'day28-rest-reflect',
                    'videoId' => null
                ],
            ];

                @endphp
                @include('_partials.components.player-section', [
                    'title' => 'Everyday Improv',
                    'slug' => 'everyday-improv',
                    'accessibleVideosCount' => !empty($unlocked) ? 6 : 0,
                    'description' => "Most singers love to sing along with their favorite songs. But what happens when you're asked to sing without a guide? Many singers struggle to find the right notes or create melodies on the spot. Everyday Improv is the perfect course to develop your intuition as a singer. Learn to find melodies on the spot, make the \"wrong\" notes sound right, match pitches over chords, and more.",                    'theme' => 'singeo',
                    'lightMode' => true,
                    'aside_dark' => '#F8F2FF',
                    'aside_light' => '#fff',
                    'cta' => 'Unlock The Full Course',
                    'link' => '#final',
                    'buttonClass'=> 'text-white',
                    'specs' => '<strong>Instructor:</strong> Emma Nissen<br>
                                <strong>Lesson Length:</strong> 30 days<br>
                                <strong>Course Contents:</strong> 20 Workouts, 4 Rest & Reflect Sessions',
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
                            'header' => 'Lifetime Access to Everyday Improv',
                            'price' => '$97',
                            'badge_text' => 'COURSE ONLY',
                            'badge_class' => 'border-black',
                            'subheader' => 'One time payment.',
                            'button_text' => 'LEARN MORE',
                            'card_class' => 'bg-white',
                            'button_class' => 'join outline singeo smaller w-11/12 lg:w-full transition-opacity duration-300 hover:opacity-80  uppercase',
                            'border_class' => 'border-[#64646480] border-opacity-60',
                            'link' => 'https://singeo.com/shop/everyday-improv',
                            'description' => [
                                'With the course only, you get:',
                                '<i class="fas fa-check pt-3 pr-1"></i> 20 guided play-along lessons',
                                '<i class="fas fa-check pr-1"></i> 4 Rest & Reflect Sessions',
                                '<i class="fas fa-check pr-1"></i> 90-day money-back guarantee',
                            ]
                        ],
                        [
                            'header' => '<span class="font-semibold">Unlimited Access to ALL Lessons <br hidden lg:block/> with a Musora Membership</span>',
                            'price' => 'Free',
                            'badge_text' => '1 Year of lessons',
                            'badge_class' => 'border-singeo text-singeo',
                            'subheader' => 'For 7 Days',
                            'button_text' => 'LEARN MORE',
                            'button_class' => 'join smaller w-11/12 lg:w-full transition-opacity duration-300 hover:opacity-80 bg-singeo uppercase',
                            'border_class' => 'border-singeo bg-[#EFF7FF]',
                            'card_class' => 'bg-[#EFF7FF]',
                            'link' => '/',
                            'description' => [
                                'With the membership, you get:',
                                '<i class="fas fa-check text-singeo pt-3 pr-1"></i> Step-By-Step Lessons & Guided Workouts',
                                '<i class="fas fa-check text-singeo pr-1"></i> World-Class Teachers',
                                '<i class="fas fa-check text-singeo pr-1"></i> 300+ Songs, practice tools & more',
                                '<i class="fas fa-check text-singeo pr-1"></i> 90-day money-back guarantee',
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
