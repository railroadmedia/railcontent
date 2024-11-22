@extends('pianote._partials.global-layout')

@section('global-head')
    @parent
    <title>Easy Chords | Pianote</title>
    <meta property="og:title" content="Easy Chords | Pianote">
    <meta name="description" content="30 days to better piano chords.">
    <meta property="og:description" content="30 days to better piano chords.">
    <meta property="og:image" content="https://d21q7xesnoiieh.cloudfront.net/fit-in/1200x0/filters:quality(95)/marketing/pianote/products/easy-chords/share-image.jpg" style="display: none;">
    <meta property="og:url" content="https://www.pianote.com/{{ Request::path() }}">

    @include('_partials.layout._fonts')
    <link rel="stylesheet" href="{{ mix('marketing/css/app.css') }}">
    <link href="{{ asset('/marketing/css/tailwind-helpers.css') }}" rel="stylesheet">
    <link href="{{ asset('/marketing/parcel/drumeo/nav-footer-pianote.css') }}" rel="stylesheet">
    <link href="{{ asset('/marketing/parcel/drumeo/30dd.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('/marketing/css/animate.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@splidejs/splide@4.0.7/dist/css/splide.min.css">

    <style>

         /*  Carousel   */
        .splide__pagination__page.is-active {
            background: white;
            transform: none !important;
        }

        .splide__arrow svg{
            fill: #f61a30 !important;
        }

        .splide__arrow--next {
            right: -12px;
        }

        @media (min-width: 1140px) {
            .splide__arrow--next {
                right: -50px;
            }
        }
         @media (max-width: 638px) {
            .dropdown-box {
            background: linear-gradient(180deg, #00101D 0%, rgba(0, 16, 29, 0) 100%);
            }
        }

       #special .splide__pagination {
        bottom: 10px;
        display: flex;
        justify-content: center;
        gap: 12px;
        }
        #special .splide__pagination__page {
            background-color: #fff;
            border-radius: 50%;
            border: 1px solid #0C1524;
            transition: background-color 0.3s;
        }

        #special .splide__pagination__page.is-active {
            background-color: #0C1524;
        }

          .join.smaller {
            padding: 15px 30px;
            font-size: 1.2rem;
        }

    </style>
@stop()

@section('body-data')
    x-data="{
    trailer: false,
    }"
@endsection

@section('global-body')

    @include('pianote.sales.partials._nav', [
        "cartVersion" => true
    ])

    <header id="header-image" class="bg-no-repeat md:bg-cover md:bg-center pb-16 md:py-20" style="background-image: url('https://d21q7xesnoiieh.cloudfront.net/fit-in/2000x0/filters:quality(95)/marketing/pianote/products/easy-chords-trial/header-bg-new.jpg'); background-color: #F2F9FF">
       <img class="w-full bg-no-repeat bg-cover bg-center md:hidden" src="https://d21q7xesnoiieh.cloudfront.net/fit-in/600x0/filters:quality(95)/marketing/pianote/products/easy-chords-trial/header-m-2.png">
        <div class="container mx-auto max-w-4xl px-5">
            <div class="flex flex-col items-center sm:flex-nowrap">
                <div class="text-center md:text-left px-4 sm:px-0">
                    <div class="md:pr-48">
                        <h5 class="text-pianote uppercase tracking-widest font-bold py-2 md:py-4">Start Day 2 of</h5>
                        <img class="h-28 lg:h-32" src="https://d21q7xesnoiieh.cloudfront.net/fit-in/600x0/filters:quality(95)/marketing/pianote/products/easy-chords/easy-chords-logo.png" alt="logo">
                        <p class="mx-0 my-4 text-black" style="max-width: 450px;">
                            You’ve done the hard part – starting! Now keep the momentum going and try Easy Chords <strong>FREE.</strong>
                        </p>
                    </div>
                    <a class="join smaller w-11/12 sm:max-w-[350px] bg-pianote" href="/choose-plan">START FREE FOR 7 DAYS</a>
                </div>

            </div>
        </div>
    </header>

    @php
        $weeks = [
            [
                'img' => 'https://d21q7xesnoiieh.cloudfront.net/fit-in/1100x0/filters:quality(95)/marketing/pianote/products/easy-chords-trial/week-01.webp',
                'weekNum' => 'WEEK 1',
                'title' => 'Building on the basics. The magic of chord inversions.',
                'excerpt' => 'We’ll be working on the foundations you need to play beautiful chords. And by the end of the week, you’ll have a real “AHA” moment!',
                'details' => [
                    ['day' => 'DAY 2', 'desc' => 'Rhythm is Fun'],
                    ['day' => 'DAY 3', 'desc' => 'The Power of the 4th'],
                    ['day' => 'DAY 4', 'desc' => 'Your First 1st Inversion'],
                    ['day' => 'DAY 5', 'desc' => 'The “AHA!” Moment'],
                ],
            ],
            [
                'img' => 'https://d21q7xesnoiieh.cloudfront.net/fit-in/1100x0/filters:quality(95)/marketing/pianote/products/easy-chords-trial/week-02.webp',
                'weekNum' => 'WEEK 2',
                'title' => 'Getting comfortable and feeling good.',
                'excerpt' => 'In week 2, you’ll start feeling more comfortable and confident playing chord inversions around the piano. And trust us, it feels good.',
                'details' => [
                    ['day' => 'DAY 6', 'desc' => 'Wake-Up For Review'],
                    ['day' => 'DAY 7', 'desc' => 'Focusing on the Movements'],
                    ['day' => 'DAY 8', 'desc' => 'Putting the Pieces Together'],
                    ['day' => 'DAY 9', 'desc' => 'Time to Get Comfortable'],
                    ['day' => 'DAY 10', 'desc' => 'Feel Good Focus'],
                ],
            ],
            [
                'img' => 'https://d21q7xesnoiieh.cloudfront.net/fit-in/1100x0/filters:quality(95)/marketing/pianote/products/easy-chords-trial/week-03.webp',
                'weekNum' => 'WEEK 3',
                'title' => 'Move less. Sound better.',
                'excerpt' => 'The real magic of chord inversions is that they not only sound better, but they make playing easier. By minimizing your movement, you’ll make real progress.',
                'details' => [
                    ['day' => 'DAY 11', 'desc' => 'A New Chord Progression'],
                    ['day' => 'DAY 12', 'desc' => 'Dramatic Sounds'],
                    ['day' => 'DAY 13', 'desc' => 'Getting Used to the Shortcut Paths'],
                    ['day' => 'DAY 14', 'desc' => 'The Magic of Inversions'],
                    ['day' => 'DAY 15', 'desc' => 'Minimizing Movement'],
                ],
            ],
            [
                'img' => 'https://d21q7xesnoiieh.cloudfront.net/fit-in/1100x0/filters:quality(95)/marketing/pianote/products/easy-chords-trial/week-04.webp',
                'weekNum' => 'WEEK 4',
                'title' => 'Putting it all together.',
                'excerpt' => 'In the final week, you’ll reinforce what you’ve learned and get some final expert tips to play beautifully and sound more professional.',
                'details' => [
                    ['day' => 'DAY 16', 'desc' => 'Refreshing the Connections'],
                    ['day' => 'DAY 17', 'desc' => 'Confident Movements'],
                    ['day' => 'DAY 18', 'desc' => 'More Rhythmic Options'],
                    ['day' => 'DAY 19', 'desc' => 'A New Shortcut'],
                    ['day' => 'DAY 20', 'desc' => 'Putting it All Together'],
                ],
            ],
        ];
    @endphp

    <section class="text-center px-5 sm:px-6 py-10 sm:py-14 lg:py-20" style="background: #FFFFFF">
        <div class="container max-w-4xl mx-auto">
            <h2 class="leading-tight"><strong>Here’s what lies ahead…</strong></h2>
            <h5 class="leading-normal mt-5 mb-10 sm:mb-12 mx-auto" style="max-width:600px;">
                With Easy Chords, the journey is all mapped out for you. All you have to do is press play and follow along.
            </h5>

            @foreach ($weeks as $week)
                <div class="dropdown text-center rounded-xl mb-4 md:mb-8 select-none text-black border-2 border-[#EFF3F5] bg-[#F2F9FF]" x-data="{ open: false }">
                    <div class="flex">
                        <div class="hidden sm:block mr-auto py-3 sm:py-4 lg:py-6 pl-4 lg:pl-5 cursor-pointer flex-shrink-0" x-on:click="open = !open">
                            <img class="h-10 sm:h-16 lg:h-24 rounded-xl opacity-0 transition-opacity" src="{{ $week['img'] }}" alt="Collage showing pianists" loading="lazy" onload="this.classList.remove('opacity-0')">
                        </div>
                        <div class="py-3 sm:py-4 lg:py-6 px-4 cursor-pointer text-left" x-on:click="open = !open;">
                            <p class="text-pianote uppercase text-left text-sm">{!! $week['weekNum'] !!}</p>
                            <h5 class="leading-normal"><strong>{!! $week['title'] !!}</strong></h5>
                            <p x-bind:class="open && 'pb-2'" class="text-sm">{!! $week['excerpt'] !!} <span class="text-pianote inline-block" x-bind:class="open && 'hidden'">Read more…</span></p>
                            <div x-cloak class="transition-all duration-100 leading-relaxed sm:leading-relaxed overflow-hidden" x-bind:class="{ 'max-h-0': !open, 'max-h-[2000px]': open }">
                                <ul>
                                @foreach ($week['details'] as $detail)
                                    <li><strong>{{ $detail['day'] }}:</strong> {{ $detail['desc'] }}</li>
                                @endforeach
                            </ul>
                            </div>
                        </div>
                        <div class="ml-auto text-pianote py-3 sm:py-10 pr-4 sm:pr-5 cursor-pointer" x-on:click="open = !open">
                            <i class="fas fa-light fa-chevron-down transform transition-all duration-300 text-lg md:text-2xl lg:text-4xl" x-bind:class="{ 'rotate-180': open }" aria-hidden="true"></i>
                        </div>
                    </div>
                </div>
            @endforeach

            <a class="join smaller w-11/12 sm:max-w-[350px] bg-pianote" href="/choose-plan">START FREE FOR 7 DAYS</a>
        </div>
    </section>


    @php
        $logoHeader = 'https://d21q7xesnoiieh.cloudfront.net/fit-in/600x0/filters:quality(95)/marketing/pianote/products/easy-chords/easy-chords-logo.png';
        $logoAlt = 'Easy Chords Logo';
        $text = '30 days to';
        $subtitle = 'better piano chords.';
        $checklist = ['Learn By Doing', 'Play Every Day', 'No Theory Required'];
        $poster = 'https://i.vimeocdn.com/video/1748392205-0648e7b529f06d5afd156aa6a12e605efc2fe19c9fabcb971ea73338d6204658-d?mw=1500&mh=844&q=70';
        $mediaSource = 'https://d2vyvo0tyx8ig5.cloudfront.net/products/easy-chords/trailer.mp4';
        $alternateSrc = 'https://d2vyvo0tyx8ig5.cloudfront.net/products/easy-chords/trailer.mp4';
    @endphp

    <section class="px-5 sm:px-6 pt-6 md:pt-9 pb-12 md:pb-18 overflow-hidden"
        style="background: linear-gradient(rgba(239, 247, 255, 1) 50%, #ffffff 50%)"
        x-data="{
            loadAlternateSrc(src) {
                this.$refs.playToLearnVideo.src = src;
            },
            videoLoaded: false,
        }">
        <div class="container max-w-xl lg:max-w-3xl xl:max-w-4xl mx-auto text-center pb-2 md:pb-4">
            <div class="flex flex-col sm:flex-nowrap items-center">
                <div class="text-center w-full">
                    <img class="h-16 sm:h-20 -mb-3 sm:mb-0 lg:mb-3 py-1"
                        src="{{ $logoHeader }}" alt="{{ $logoAlt }}"
                        fetchpriority="high">
                    <h1 class="rotater-text overflow-hidden">
                        <strong>
                            <span>{{ $text }}</span>
                        </strong>
                    </h1>
                    <h2 class="-mt-3 sm:-mt-1 lg:mt-0 mb-4">{{ $subtitle }}</h2>
                    @foreach ($checklist as $item)
                        <h6 class="hidden lg:inline p-2 leading-loose">
                            <i class="fas fa-check-circle text-{{ $brand }}" aria-hidden="true"></i>
                            {{ $item }}
                        </h6>
                    @endforeach
                    <div class="flex inline lg:hidden my-3">
                        @foreach ($checklist as $item)
                            <p class="w-1/2 leading-tight">
                                <i class="fas fa-check-circle text-{{ $brand }}" aria-hidden="true"></i><br />
                                {{ $item }}
                            </p>
                        @endforeach
                    </div>
                </div>
            </div>

            <div class="py-5 sm:py-6 relative">
                <div class="aspect-16:9 cursor-pointer rounded-xl autoplay-video overflow-hidden w-full relative"
                    x-on:click="trailer = true;" role="button">
                    <i class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 fa fa-play play-button z-10"></i>

                    <div x-data="{ videoLoaded: false }">
                        <img src="{{ $poster }}" alt="Blurred Poster Image" class="rounded-xl overflow-hidden object-cover w-full h-full absolute z-0 blur-xl" x-show="!videoLoaded">

                        <video class="rounded-xl overflow-hidden object-cover w-full h-full absolute z-0"
                            x-ref="playToLearnVideo"
                            x-on:error="loadAlternateSrc('{{ $alternateSrc }}')"
                            x-intersect.once="videoLoaded = true; $refs.playToLearnVideo.src = $refs.playToLearnVideo.dataset.src;"
                            x-effect="if (videoLoaded) { $refs.playToLearnVideo.play(); }"
                            data-src="{{ $mediaSource }}"
                            type="video/mp4"
                            muted
                            loop
                            playsinline
                            preload="auto"
                            fetchpriority="high">
                            <source :src="$refs.playToLearnVideo.dataset.src" type="video/mp4">
                        </video>
                    </div>
                </div>
            </div>
            <a class="join smaller w-11/12 sm:max-w-[350px] bg-pianote mt-2 lg:mt-6" href="/choose-plan">START FREE FOR 7 DAYS</a>
        </div>
    </section>

 <section class="py-10 sm:py-14 lg:py-20 relative overflow-hidden text-center px-3 lg:px-5" style="background:#ffffff;">
 <div class="container max-w-6xl mx-auto px-4 md:px-20">
 <h1 class="font-lexend uppercase leading-none text-4xl pb-1 md:text-5xl"><strong>PLAY TO LEARN</strong></h1>
     <h5 class="text-center text-pianote font-semibold italic py-2 md:py-4">Improve your skills in just 10 minutes
         a day.</h5>
     <p class="text-center text-black leading-loose pb-10 max-w-xl md:max-w-5xl">It’s more than just Easy Chords. Start your FREE trial today
         and you’ll get unlimited access to ALL the Challenges inside Pianote.<br/>From sight-reading to Blues.
         Jazz to Improvisation. You’ll get guided lessons taught by the world’s best.<br/></p>
     <div x-data="{
         splideInitialized: false,
         splideInstance: null,
         initSplide() {
             if (this.splideInitialized) return;
             this.splideInstance = new Splide(this.$refs.splide, {
                 classes: {
                     arrow: 'splide__arrow bg-white opacity-100 bottom-0 transform -translate-y-1/2 shadow-lg h-11 w-11',
                     prev: 'splide__arrow--prev hidden',
                     next: 'splide__arrow--next hidden',
                     pagination: 'splide__pagination md:inline -bottom-10',
                 },
                 perPage: 4,
                 type: 'loop',
                 drag: false,
                 arrows: false,
                 gap: 20,
                 pagination: true,
                 perMove: 1,
                 focus: 0,
                 autoplay: false,
                 pauseOnHover: true,
                 pauseOnFocus: true,
                 interval: 5000,
                 lazyLoad: 'nearby',
                 breakpoints: {
                     1000: {
                         perPage: 3,
                         drag: 'free',
                         arrows: true,
                         gap: 10,
                         pagination: true,
                     },
                     800: {
                            perPage: 2,
                            arrows: true,
                            snap: false,
                        },
                        620: {
                            perPage: 1.5,
                            arrows: true,
                            snap: false,
                            pagination: false,
                        },
                    },
                }).mount();
                this.splideInitialized = true;
            },
            goNext() {
                if (this.splideInstance) {
                    this.splideInstance.go('+1');
                }
            }
        }" x-intersect="initSplide()">
            <div x-ref="splide" class="splide mb-28 md:mb-20" id="special">
                <div class="splide__track">
                    <ul class="splide__list">
                       @php
                            $packs = [
                                [
                                    "image" => "marketing/musora/membership/homepage/2024/packs/30TBT.webp",
                                ],
                                [
                                    "image" => "marketing/musora/membership/homepage/2024/packs/NPPSH.webp",
                                ],
                                [
                                    "image" => "marketing/musora/membership/homepage/2024/packs/30DBP.webp",
                                ],
                                [
                                    "image" => "marketing/musora/membership/homepage/2024/packs/Classical-Piano.webp",
                                ],
                                [
                                    "image" => "marketing/musora/membership/homepage/2024/packs/Creative-Songwriting.webp",
                                ],
                                [
                                    "image" => "marketing/musora/membership/homepage/2024/packs/Gospel-Piano.webp",
                                ],
                                [
                                    "image" => "marketing/musora/membership/homepage/2024/packs/Improvisational-Jazz.webp",
                                ],
                                [
                                    "image" => "marketing/musora/membership/homepage/2024/packs/Latin-Piano-Essentials.webp",
                                ],
                                [
                                    "image" => "marketing/musora/membership/homepage/2024/packs/Rhythmic-Playing.webp",
                                ],
                                [
                                    "image" => "marketing/musora/membership/homepage/2024/packs/Simple-Piano-Arpeggios.webp",
                                ],
                                [
                                    "image" => "marketing/musora/membership/homepage/2024/packs/The-Perfect-Arrangement.webp",
                                ],
                            ];
                        @endphp
                        @foreach ($packs as $image)
                            <li class="splide__slide flex flex-col items-center justify-start px-1">
                                <div class="relative w-full rounded-xl overflow-hidden" style="padding-bottom: 150%;">
                                    <picture>
                                        <source media="(min-width:1024px)" data-srcset="https://d21q7xesnoiieh.cloudfront.net/fit-in/490x0/filters:quality(95)/{{$image['image']}}">
                                        <source media="(min-width:640px)" data-srcset="https://d21q7xesnoiieh.cloudfront.net/fit-in/320x0/filters:quality(95)/{{$image['image']}}">
                                        <img
                                            class="absolute top-0 left-0 w-full h-full object-cover object-top transition-opacity opacity-0 duration-300"
                                            data-splide-lazy="https://d21q7xesnoiieh.cloudfront.net/fit-in/490x0/filters:quality(95)/{{$image['image']}}"
                                            onload="this.classList.remove('opacity-0');"
                                        />
                                    </picture>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                </div>
                <div class="absolute top-0 right-0 h-full w-1/4 bg-gradient-to-l from-white to-transparent pointer-events-none"></div>
                <button class="absolute top-1/2 right-0 transform -translate-y-1/2 z-10 w-10"
                    @click="goNext()">
                    <i class="fa-thin fa-chevron-right text-[#0C1524] text-7xl"></i>
                </button>
            </div>
        </div>
    </div>
    </section>

    @php
        $testimonials = [
            [
                'name' => 'Sergey',
                'subheader' => 'Pianote Student',
                'comment' => "I'm so happy I found you guys. I mean, probably nothing new, I've left plenty of comments throughout the course, but I can't help but say all of it again! My piano/keys skills skyrocketed with these fun lessons. And easy chords... THE BEST thing that ever happened to me!",
                'img' => 'https://d21q7xesnoiieh.cloudfront.net/fit-in/700x0/filters:quality(95)/marketing/pianote/products/easy-chords-trial/testimonials-01.webp',
            ],
            [
                'name' => 'Dofu',
                'subheader' => 'Pianote Student',
                'comment' => "This is the best online music school I have seen, and I've spent a lot of money on them so far. And this is far better than all the others and now that I have this I'm canceling all my other memberships. But just imagine how much good you guys are doing in the world.",
                'img' => 'https://d21q7xesnoiieh.cloudfront.net/fit-in/700x0/filters:quality(95)/marketing/pianote/products/easy-chords-trial/testimonials-02.webp',
            ],
            [
                'name' => 'Joni',
                'subheader' => 'Pianote Student',
                'comment' => 'Lisa, this has been a real breakthrough for me. I’ve been in & out of piano lessons (always song focussed) for a decade now so being able to play chords always eluded me or felt like a dull academic exercise. Finally I feel I have the understanding I’ve been yearning for to combine the learning of chords with something that actually feels & sounds lovely to play!! Can’t tell you how pleased I am. And yes I did every lesson. Looking forward to more packs like this! Thank you. 💖',
                'img' => 'https://d21q7xesnoiieh.cloudfront.net/fit-in/700x0/filters:quality(95)/marketing/pianote/products/easy-chords-trial/testimonials-03.webp',
            ],
        ];
    @endphp
    <section class="py-10 sm:pt-14 sm:pb-28 lg:pt-20 lg:pb-32" style="background: #0C1524">

    <div class="container mx-auto max-w-5xl">
    <h2 class="mb-4 text-center text-white">Easy Chords <strong> WORKS.</strong> Here’s proof.</h2>
        <p class="text-white mb-2 md:mb-6 px-1 sm:px-2 lg:px-4 lg:px-0 text-center">Read what other students are saying about Easy Chords.</p>
        <div class="max-w-6xl mx-auto px-5 sm:px-6 mb-10 sm:mb-0">
            <div
                x-data="{
                init() {
                    new Splide(this.$refs.splide, {
                        classes: {
                            arrow: 'splide__arrow bg-white opacity-100 top-[50%] shadow-lg h-11 w-11 text-[#0B76DB]',
                            prev: 'hidden',
                            next: 'splide__arrow--next hidden sm:flex mb-16',
                            pagination: 'splide__pagination -bottom-6 lg:-bottom-10',
                        },
                        perPage: 2.5,
                        perMove: 1,
                        type: 'loop',
                        lazyLoad: 'nearby',
                        focus: 0,
                        interval: 2000,
                        breakpoints: {
                            800: {
                                perPage: 2.5,
                            },
                            758: {
                                perPage: 2,
                                drag: 'free',
                                snap: false,
                            },
                            580: {
                                perPage: 1.5,
                            },
                            510: {
                                perPage: 1,
                            },
                        },
                    }).mount()
                },
            }"
            >
                <div x-ref="splide" class="splide mb-12 sm:mb-10 lg:mb-12 py-4">
                    <div class="splide__track">
                        <ul class="splide__list items-start" style="padding-top: 60px !important;">

                            @foreach ($testimonials as $testimonial)
                                <li class="splide__slide bg-[#F4F8FB] rounded-xl pb-6 px-4 lg:px-8 mr-4 text-center h-[420px] sm:h-[460px] lg:h-[440px]">
                                    <div class="mb-6" style="margin-top: -60px;">
                                        <img class="rounded-full w-[90px] h-[90px] object-cover"
                                            data-splide-lazy="{{ $testimonial['img'] }}" alt="{{ $testimonial['name'] }} avatar" />
                                    </div>
                                    <h6 class="mb-1 font-extrabold">{{ $testimonial['name'] }}</h6>
                                    <p class="pb-1 sm: pb-2 lg:pb-6"><i>{{ $testimonial['subheader'] }}</i></p>
                                    <p class="mb-6">{!! $testimonial['comment'] !!}</p>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
     </div>
    </section>

    <section class="py-20 px-4 lg:px-6" style="background:#F2F9FF;">
        <div class="container max-w-4xl mx-auto">
            <div class="flex flex-col justify-center items-center mx-auto text-center px-4 sm:px-0">
                <h5 class="text-pianote uppercase tracking-widest py-2 md:py-4 font-black">Are you ready? Start Day 2 of
                </h5>
                <img class="h-28 lg:h-32"
                    src="https://d21q7xesnoiieh.cloudfront.net/fit-in/600x0/filters:quality(95)/marketing/pianote/products/easy-chords/easy-chords-logo.png"
                    alt="logo">
                <p class="my-6 text-black text-xl">
                    You’ve done the hard part – starting! <br>
                    Now keep the momentum going and try <br class="md:hidden"> Easy Chords <strong>FREE.</strong>
                </p>
                <a class="join smaller w-11/12 sm:max-w-[350px] bg-pianote" href="/choose-plan">START FREE FOR 7 DAYS</a>
            </div>
        </div>
    </section>

    @include('_partials.components.video-modal',[
        'name' => 'trailer',
        'video' => '823788317',
        'vimeo' => true,
    ])
    @include("pianote.sales.partials._footer")

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script type="text/javascript" src="{{ asset('/marketing/js/modal.js') }}"></script>
    <script type="text/javascript" src="{{ asset('/marketing/parcel/drumeo/navigation-sales.js') }}" defer></script>
    <script src="https://cdn.jsdelivr.net/npm/@splidejs/splide@4.0.7/dist/js/splide.min.js"></script>

    <script src="{{ mix('/platform/js/manifest.js') }}"></script>
    <script src="{{ mix('/platform/js/vendor.js') }}"></script>
    <script src="{{ mix('/platform/js/app.js') }}"></script>

    <script type="text/javascript" src="{{ asset('/marketing/js/modal-autoplay.js') }}"></script>


@stop
