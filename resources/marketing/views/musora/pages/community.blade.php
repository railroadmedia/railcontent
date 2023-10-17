@extends('musora._partials.layout', [
    'whiteNav' => true,
    'fullSubscriptionVersion' => true,
])

@section('head-includes')
    <title>Musora - Social Learning Communities For Musicians</title>
    <meta property="og:title" content="Musora - Social Learning Communities For Musicians">

    <meta name="description" content="Musora Media, Inc. is the technology that powers the most popular online social learning communities for musicians.  Learn music from the best teachers in the world at Drumeo, Guitareo, and Pianote. ">
    <meta property="og:description" content="Musora Media, Inc. is the technology that powers the most popular online social learning communities for musicians.  Learn music from the best teachers in the world at Drumeo, Guitareo, and Pianote.">

    <meta property="og:url" content="https://www.musora.com/{{ Request::path() }}">
    <meta property="og:image" content="https://dmmior4id2ysr.cloudfront.net/homepage/2023/share-image3.jpg">

    <link href="{{ asset('/marketing/css/tailwind-helpers.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@splidejs/splide@4.0.7/dist/css/splide.min.css">
<style>
    .join {
        display: inline-block;
        font: 500 22px/1em 'Bebas Neue', sans-serif;
        letter-spacing: 0.1em;
        text-transform: uppercase;
        background: #0c1524;
        border-radius: 50px;
        color: #fff;
        padding: 17px 7%;
        outline: none;
        cursor: pointer;
        text-align: center;
        user-select: none;
        text-decoration: none;
        transition: background-color 0.3s, color 0.3s, opacity 0.3s;
        box-shadow: 0 0 0 rgba(0, 0, 0, 0.35);
    }
    @media (min-width: 768px) {
        .join {
            font-size: 30px;
        }
    }
    .join:hover, .join:focus {
        color: #fff;
        background:#14233d;
        box-shadow: 0 0 7px rgba(0, 0, 0, 0.35);
    }
    .join.smaller {
        padding: 8px 30px;
        font-size: 16px;
    }
    @media (min-width: 768px) {
        .join.smaller {
            font-size: 18px;
            padding:11px 30px;
        }
    }
</style>
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

        .dot {
            left:-16px;
        }
        .full-line {
            left:0;
            bottom: 0;
        }
        @media (min-width:640px) {
            .dot,
            .full-line {
                left:50%;
            }
        }
    </style>
@stop

@section('body-data')
    x-data ='{
    soundslice : false,
    trailer : false,
    }'
@endsection

@section('layout-body')
    <section class="text-center px-5 sm:px-6 py-10 sm:py-14 lg:py-56 relative overflow-hidden">
        <div class="container max-w-6xl mx-auto relative z-20">
            <picture>
                <source media="(min-width: 1024px)" srcset="https://www.musora.com/musora-cdn/image/width=900,quality=95/https://dmmior4id2ysr.cloudfront.net/community/header-title1.png">
                <img class="h-40 md:h-56 lg:h-24" src="https://www.musora.com/musora-cdn/image/width=400,quality=95/https://dmmior4id2ysr.cloudfront.net/community/header-title-m1.png" alt="Welcome home" fetchpriority="high">
            </picture>

            <h6 class="leading-relaxed mt-4 mb-7">
                Get the personal touch you need to meet your musical goals <br class="hidden sm:inline">and join the best community of musicians and students online!
            </h6>
        </div>
        <img class="hidden lg:inline absolute z-10 h-40" style="top:60%;left: 4%;" src="https://www.musora.com/musora-cdn/image/width=300,quality=95/https://dmmior4id2ysr.cloudfront.net/community/header-student-pianote.png" alt="pianote student" fetchpriority="high">
        <img class="hidden lg:inline absolute z-10 h-52 left-[2%] 2xl:left-[12%]" style="top:18%;" src="https://www.musora.com/musora-cdn/image/width=300,quality=95/https://dmmior4id2ysr.cloudfront.net/community/header-coach-drumeo.png" alt="drumeo coach" fetchpriority="high">
        <img class="hidden lg:inline absolute z-10 h-28" style="top: 76%; left: 27%;" src="https://www.musora.com/musora-cdn/image/width=200,quality=95/https://dmmior4id2ysr.cloudfront.net/community/header-coach-singeo.png" alt="singeo coach" fetchpriority="high">
        <img class="hidden lg:inline absolute z-10 h-32" style="top: 5%; left: 26%;" src="https://www.musora.com/musora-cdn/image/width=300,quality=95/https://dmmior4id2ysr.cloudfront.net/community/header-student-singeo.png" alt="singeo student" fetchpriority="high">
        <img class="hidden lg:inline absolute z-10 h-24" style="top: 10%; left: 66%;" src="https://www.musora.com/musora-cdn/image/width=200,quality=95/https://dmmior4id2ysr.cloudfront.net/community/header-coach-guitareo.png" alt="guitareo coach" fetchpriority="high">
        <img class="hidden lg:inline absolute z-10 h-52" style="top: 55%; left: 80%;" src="https://www.musora.com/musora-cdn/image/width=350,quality=95/https://dmmior4id2ysr.cloudfront.net/community/header-coach-pianote.png" alt="pianote coach" fetchpriority="high">
        <img class="hidden lg:inline absolute z-10 h-48" style="top: 19%; left: 78%;" src="https://www.musora.com/musora-cdn/image/width=400,quality=95/https://dmmior4id2ysr.cloudfront.net/community/header-student-drumeo.png" alt="drumeo student" fetchpriority="high">
        <img class="hidden lg:inline absolute z-10 h-28" style="top: 76%; left: 62%;" src="https://www.musora.com/musora-cdn/image/width=300,quality=95/https://dmmior4id2ysr.cloudfront.net/community/header-student-guitareo.png" alt="guitareo student" fetchpriority="high">
        <div class="flex justify-center">
            <img class="lg:hidden max-w-2xl sm:max-w-3xl md:max-w-none" src="https://www.musora.com/musora-cdn/image/width=1200,quality=95/https://dmmior4id2ysr.cloudfront.net/community/header-collage-m.png" alt="header collage mobile" fetchpriority="high"/>
        </div>
    </section>

    <section class="text-center py-10 sm:py-14 lg:py-20 text-white" style="background:#0c1524;">
        <div class="container max-w-4xl mx-auto">
            <h3 class="leading-snug">
                <strong>
                    Personal support, coaching & <br class="hidden sm:inline">mentoring whenever you need it.
                </strong>
            </h3>
            <p class="text-center mt-5 mb-16 sm:mt-5 sm:mb-20 max-w-2xl mx-auto">
                Learning to play your favorite instrument comes with challenges completely unique to you. It takes more than chasing a bouncing ball on a screen. That’s why, as a Musora student, you’ll get personal feedback and mentoring to achieve all your musical goals.
            </p>

            @php
                $gettings = [

                    [
                    'position' => 'left',
                    'img' => 'https://dmmior4id2ysr.cloudfront.net/community/first-point.png',
                    'mobileImg' => 'https://dmmior4id2ysr.cloudfront.net/community/first-point-m.png',
                    'title' => 'Student Reviews:',
                    'desc' => 'Get yourself unstuck in your journey by submitting a video of yourself playing or singing for private, personal feedback from a real coach.',
                    ],
                    [
                    'position' => 'right',
                    'img' => 'https://dmmior4id2ysr.cloudfront.net/community/second-point.png',
                    'mobileImg' => 'https://dmmior4id2ysr.cloudfront.net/community/second-point-m.png',
                    'title' => 'Live Events:',
                    'desc' => 'You’ll never be left wondering what to do – with one-click progress tracking on every lesson and exercise so you know exactly where you left off and what to practice next.',
                    ],
                    [
                    'position' => 'left',
                    'img' => 'https://dmmior4id2ysr.cloudfront.net/community/third-point.png',
                    'mobileImg' => 'https://dmmior4id2ysr.cloudfront.net/community/third-point-m.png',
                    'title' => 'Personal Mentors:',
                    'desc' => 'Get support from a mentor that knows you and understands the musical journey that you\'re on personally. They\'ll help you overcome any challenge that gets in your way.',
                    ],
                                        [
                    'position' => 'right',
                    'img' => 'https://dmmior4id2ysr.cloudfront.net/community/fourth-point.png',
                    'mobileImg' => 'https://dmmior4id2ysr.cloudfront.net/community/fourth-point-m.png',
                    'title' => 'Community Forum:',
                    'desc' => 'Get instant access to the cool kids\' table. Give and receive feedback and become a part of a community of thousands of other students on the same journey you\'re on.',
                    ],
                ];
//            @endphp
            <div class="max-w-3xl lg:max-w-4xl mx-auto relative mt-7">
                @foreach ($gettings as $key => $getting)
                    @if($getting['position'] === 'right')
                        <div class="relative flex flex-col-reverse md:grid md:grid-cols-2 gap-4 md:gap-14 lg:gap-20 mb-16 md:mb-28">
                            <div class="content relative text-left px-4 md:px-0">
                                <h4 class="mb-2 md:mb-5 mt-1 md:mt-0"><strong>{{ $getting['title'] }}</strong></h4>
                                <p>{{ $getting['desc'] }}</p>
                            </div>
                            <div class="-mt-7 md:rounded-lg relative aspect-16:9 mb-6 md:mb-0">
                                <picture>
                                    <source media="(min-width: 768px)" srcset="https://www.musora.com/musora-cdn/image/width=800,quality=95/{{ $getting['img'] }}" alt="timeline image {{ $key + 1 }}">
                                    <img class="absolute inset-0 transition-all opacity-0" src="https://www.musora.com/musora-cdn/image/width=760,quality=95/{{ $getting['mobileImg'] }}" alt="timeline image {{ $key + 1 }}" loading="lazy" onload="this.classList.remove('opacity-0')" />
                                </picture>

                            </div>
                            <div class="dot absolute bg-white top-0 rounded-full z-10 transform -translate-x-1/2 -translate-y-1/2 hidden sm:block" style="width: 20px;height:20px"></div>
                        </div>
                    @else
                        <div class="relative flex flex-col md:grid md:grid-cols-2 gap-4 md:gap-14 lg:gap-20 mb-16 md:mb-28">
                            <div class="-mt-7 md:rounded-lg relative aspect-16:9 mb-6 md:mb-0">
                                <picture>
                                    <source media="(min-width: 768px)" srcset="https://www.musora.com/musora-cdn/image/width=800,quality=95/{{ $getting['img'] }}" alt="timeline image {{ $key + 1 }}">
                                    <img class="absolute inset-0 transition-all opacity-0" src="https://www.musora.com/musora-cdn/image/width=760,quality=95/{{ $getting['mobileImg'] }}" alt="timeline image {{ $key + 1 }}" loading="lazy" onload="this.classList.remove('opacity-0')" />
                                </picture>
                            </div>
                            <div class="content relative text-left px-4 md:px-0">
                                <h4 class="mb-2 md:mb-5 mt-1 md:mt-0"><strong>{{ $getting['title'] }}</strong></h4>
                                <p>{{ $getting['desc'] }}</p>
                            </div>
                            <div class="dot absolute bg-white top-0 rounded-full z-10 transform -translate-x-1/2 -translate-y-1/2 hidden md:block" style="width: 20px;height:20px"></div>
                        </div>
                    @endif
                @endforeach
                <div class="full-line absolute bg-white top-0 z-0 transform -translate-x-1/2 hidden md:block" style="width: 3px;"></div>
            </div>
        </div>
    </section>

    <section class="pt-16 md:pt-20 pb-32 md:pb-40 text-center">
        <h3 class="leading-snug">
            <strong>
                Don’t take our word for it… <br>
                Here’s what our students are saying.
            </strong>
        </h3>
        <p class="text-center mt-5 mb-16 sm:mt-5 sm:mb-20 max-w-2xl mx-auto mb-14 px-4">
            Musora is trusted by over {{ number_format(round (Prices::$students, -3)) }} students. And has been rated 5-stars for price, satisfaction, and customer service. Check out all the success storeis and reviews here.
        </p>
        <div class="max-w-4xl mx-auto">
            @component('_partials.components.carousel',[
                    'xdata' => "
                        classes: {
                            arrow: 'splide__arrow bg-white opacity-100 top-[100%] md:top-[50%] shadow-lg h-11 w-11 shadow-[0px_4px_4px_rgba(0,0,0,0.25)]',
                            prev: 'splide__arrow--prev your-class-next z-50 left-[35%] md:left-1',
                            next: 'splide__arrow--next your-class-next z-50 right-[35%] md:-right-1',
                            pagination: 'hidden',
                        },
                        perPage: 1,
                        perMove: 1,
                        type: 'loop',
                        interval: 2000,
                    ",
                ])
                @slot('content')
                    <li class="splide__slide px-1">
                        <div class="md:flex md:items-center">
                            <div class="relative md:-mr-10 z-40 sm:h-80 md:min-w-[290px] -mb-[108px] sm:-mb-[135px] md:mb-0">
                                <picture>
                                    <source media="(min-width: 768px)" srcset="https://dmmior4id2ysr.cloudfront.net/community/review-01.png">
                                    <img class="md:absolute md:inset-0 transition-all opacity-0 h-64 sm:h-80" src="https://dmmior4id2ysr.cloudfront.net/community/review-01-m.png" alt="review 1" loading="lazy" onload="this.classList.remove('opacity-0')" />
                                </picture>
                            </div>
                            <div class="bg-[#000C17] rounded-xl pb-10 pt-32 md:py-8 px-4 md:pl-20 md:pr-10 text-white text-left md:min-w-[600px]">
                                <p>
                                    Helped coordinate my left and right hands. <br><br>
                                    I was using a piano app, but it wasn’t personal and I had to figure it out on my own most of the time. So I joined and went back to the basics.The explanations and instructions are very clear, easy to follow, and slowly I noticed I was improving by using skills from one lesson to the next. It’s structured to allow you to build the foundations, and the tips and tricks videos make your playing special. The lessons are fun and the instructors are engaging. <br><br>
                                    <strong>Anselm de Souza </strong><span class="text-[#C0C0C0]">- Piano Player</span>
                                </p>
                            </div>
                        </div>
                    </li>
                    <li class="splide__slide px-1">
                        <div class="md:flex md:items-center">
                            <div class="relative md:-mr-10 z-40 sm:h-80 md:min-w-[290px] -mb-[108px] sm:-mb-[135px] md:mb-0">
                                <picture>
                                    <source media="(min-width: 768px)" srcset="https://dmmior4id2ysr.cloudfront.net/community/review-02.png">
                                    <img class="md:absolute md:inset-0 transition-all opacity-0 h-64 sm:h-80" src="https://dmmior4id2ysr.cloudfront.net/community/review-02-m.png" alt="review 2" loading="lazy" onload="this.classList.remove('opacity-0')" />
                                </picture>
                            </div>
                            <div class="bg-[#000C17] rounded-xl pb-10 pt-32 md:py-8 px-4 md:pl-20 md:pr-10 text-white text-left md:min-w-[600px]">
                                <p>
                                    “Anytime, day or night, I can access the lessons I need.” <br><br>
                                    <strong>Jay Damberg </strong><span class="text-[#C0C0C0]">- Drummer</span>
                                </p>
                            </div>
                        </div>
                    </li>
                    <li class="splide__slide px-1">
                        <div class="md:flex md:items-center">
                            <div class="relative md:-mr-10 z-40 sm:h-80 md:min-w-[290px] -mb-[108px] sm:-mb-[135px] md:mb-0">
                                <picture>
                                    <source media="(min-width: 768px)" srcset="https://dmmior4id2ysr.cloudfront.net/community/review-04.png">
                                    <img class="md:absolute md:inset-0 transition-all opacity-0 h-64 sm:h-80" src="https://dmmior4id2ysr.cloudfront.net/community/review-04-m.png" alt="review 3" loading="lazy" onload="this.classList.remove('opacity-0')" />
                                </picture>
                            </div>
                            <div class="bg-[#000C17] rounded-xl pb-10 pt-32 md:py-8 px-4 md:pl-20 md:pr-10 text-white text-left md:min-w-[600px]">
                                <p>
                                    The frustration is over.<br><br>
                                    I’m already playing things that were a nightmare to me before. Strumming patterns, smoothly changing chords, and improvisation of different scales. I’m even playing songs using my own chord progressions and pentatonic scales. I’m enjoying listening to myself play and proud of my progress!<br><br>
                                    The frustration is over. This is what a guitarist wants and it’s been a fun and easy learning experience.<br><br>
                                    <strong>Vetriselvi Senguttuvan </strong><span class="text-[#C0C0C0]">- Guitar player</span>
                                </p>
                            </div>
                        </div>
                    </li>
                    <li class="splide__slide px-1">
                        <div class="md:flex md:items-center">
                            <div class="relative md:-mr-10 z-40 sm:h-80 md:min-w-[290px] -mb-[108px] sm:-mb-[135px] md:mb-0">
                                <picture>
                                    <source media="(min-width: 768px)" srcset="https://dmmior4id2ysr.cloudfront.net/community/review-03.png">
                                        <img class="md:absolute md:inset-0 transition-all opacity-0 h-64 sm:h-80" src="https://dmmior4id2ysr.cloudfront.net/community/review-03-m.png" alt="review 4" loading="lazy" onload="this.classList.remove('opacity-0')" />
                                </picture>
                            </div>
                            <div class="bg-[#000C17] rounded-xl pb-10 pt-32 md:py-8 px-4 md:pl-20 md:pr-10 text-white text-left md:min-w-[600px]">
                                <p>
                                    For years I thought I wouldn’t be able to sing. I don’t feel like that anymore. I feel that I can and I now have my first solo gig lined up for January.<br><br>
                                    Essentially I realised that I needed to maintain a disciplined regimen. I needed to practice every day. I needed to do specific exercises that focussed on my weak spots. I also realised it wasn’t magic. Improvement is gradual and requires effort. It was a relief realising that if I put in the work, I would get there. If you put in the time you will see improvement.<br><br>
                                    <strong>John Stevenson </strong><span class="text-[#C0C0C0]">- Singer</span>
                                </p>
                            </div>
                        </div>
                    </li>
                @endslot
            @endcomponent

        </div>
    </section>

    @include('musora._partials.order-section-collage')


    @include('musora.sales.components.app-section', [
        'image' => 'marketing/musora/membership/homepage/2023/devices2.png',
        'appleUrl' => 'https://apps.apple.com/us/app/musora/id1619053766?platform=iphone',
        'googleUrl' => 'https://play.google.com/store/apps/details?id=com.musoraapp',
    ])

    @include('musora._partials._faq')

    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script type="text/javascript" src="{{ asset('/marketing/parcel/drumeo/navigation-sales.js') }}"></script>

    <script src="https://cdn.jsdelivr.net/npm/@splidejs/splide@4.0.7/dist/js/splide.min.js"></script>
    @yield('scripts')
@stop
