@extends('pianote._partials.global-layout')

@section('global-head')
    <title>The Classical Piano Collection | Pianote</title>
    <meta property="og:title" content="The Classical Piano Collection | Pianote">

    <meta name="description" content="Play The Most Beautiful Piano Music In The World With Step-By-Step Tutorials">
    <meta property="og:description" content="Play The Most Beautiful Piano Music In The World With Step-By-Step Tutorials">
    <meta property="og:image" content="https://d21q7xesnoiieh.cloudfront.net/fit-in/1200x0/filters:quality(95)/marketing/pianote/products/classical-piano-collection/share-image.jpg">
    <meta property="og:url" content="https://www.pianote.com/{{ Request::path() }}">

    @include('_partials.layout._fonts')
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ mix('marketing/css/app.css') }}">
    <link href="{{ asset('/marketing/css/tailwind-helpers.css') }}" rel="stylesheet">
    <link href="{{ asset('/marketing/parcel/drumeo/navigation-sales.css') }}" rel="stylesheet">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@splidejs/splide@4.1.4/dist/css/splide.min.css">
    <style>
        .join,
        .join:hover {
            background: #F61A30;
            border-color: #F61A30;
        }

        .join.outline.red {
            border-color: #F61A30;
            color: #0b76db;
        }

        .join.smaller.outline {
            padding: 12px 7%;
            border-color: #F61A30;
            background-color: rgb(18, 18, 6, 0.3);
        }

        .join.smaller.outline.red:hover {
            background:#f53347;
        }

        .join.smaller:focus {
            background: #f53347;
        }

        .join i {
            transition: all .3s;
            position: relative;
            right: 0;
        }

        .translate-x-2 {
            transform: translateX(0.2rem);
        }
        .playfair {
            font-family: 'Playfair Display', serif;
        }
        .splide__arrow svg {
        fill: #F61A30;
        font-size: 0.9rem;
        }
        .splide__arrow--prev {
            left: 2em;
        }
        .splide__arrow--next {
            right: 2em;
        }
         .play-button {
            display: inline-block;
            cursor: pointer;
            outline: none;
            transition: opacity 0.3s;
            color: #fff;
            background: rgba(0, 0, 0, 0.6);
            border: 2px solid #fff;
            border-radius: 200px;
            line-height: 1em;
            font-size: 29px;
            padding: 18px 22px;
        }
        @media (min-width: 768px) {
            .play-button {
                font-size: 35px;
                padding: 22px 27px;
                border-width: 4px;
            }
        }
        @media (min-width: 1024px) {
            .play-button {
                font-size: 39px;
                padding: 25px 30px;
            }
        }
        .play-button:hover {
            opacity: 0.8;
        }
       .teacher-section {
        background: url('https://d21q7xesnoiieh.cloudfront.net/fit-in/2500x0/filters:quality(95)/marketing/pianote/products/classical-piano-collection/demo-bg-new.webp') no-repeat center;
        background-size: cover;
        }

        @media (max-width: 743px) {
            .teacher-section {
                background: url('https://d21q7xesnoiieh.cloudfront.net/fit-in/2500x0/filters:quality(95)/marketing/pianote/products/classical-piano-collection/demo-bg-m-cut.png') no-repeat center;
                background-size: cover;
            }
        }
    </style>
@stop

@section('body-data')
    x-data="{
    Bach: false,
    BeethovenElise: false,
    BeethovenSonata: false,
    Chopin: false,
    Satie: false,
    trailer: false,
    demo: false,
    }"
@endsection

@section('global-body')
    @include('pianote.sales.partials._nav', [
        'cartVersion' => true,
    ])

    <header class="text-white relative overflow-hidden z-10" style="background-color: #020B16;">
        <div class="transform -translate-y-1/2 top-1/2 left-0 w-full absolute z-20 px-4 lg:px-6 text-center">
            <div class="container mx-auto max-w-5xl">
                <h3 class="tracking-wide leading-none">The</h3>
                <h1 class="italic playfair text-5xl md:text-6xl leading-none">Classical Piano</h1>
                <h4 class="tracking-widest uppercase">Collection</h4>
                <h6 class="italic pt-2">Play The Most Beautiful Piano Music In The <br class="block md:hidden"> World With Step-By-Step Tutorials</h6>
                <div class="mt-5 sm:mt-7 mb-2 w-full max-w-xl mx-auto">
                    <a class="anchor-slide w-full sm:w-5/12 join sold-out smaller text-white bg-pianote my-2 sm:m-2 hover:bg-red-500 anchor-slide" href="#final">GET STARTED</a>
                     <div class="sm:w-5/12 join smaller outline hidden sm:inline-block bg-transparent hover:bg-white hover:text-black"
                        @click="trailer = true;">
                        &nbsp;Watch The Trailer
                    </div>
                    <div class="w-full sm:w-5/12 join smaller outline sm:hidden inline-block bg-transparent hover:bg-white hover:text-black"
                        x-data="{ move: false }" @mouseover="move = true" @mouseout="move = false" @click="trailer = true;">
                        &nbsp;Watch The Trailer
                    </div>
                </div>
            </div>
        </div>
        <div class="top-0 left-0 absolute w-full h-full z-10" style="background: rgba(2, 11, 22, 0.6)"></div>
        <video class="object-cover w-full relative z-0" style="height: 700px;" type="video/mp4" autoplay loop playsinline muted
            src="https://player.vimeo.com/progressive_redirect/playback/932207347/rendition/1080p/file.mp4?loc=external&signature=5f7623116aebc377256b8e977f9f8cd5d89a073cbbe72da98636654c0508e44c"></video>
    </header>

    @php
        $items = [
            '5 FULL-LENGTH <br class="hidden md:block lg:hidden">TUTORIALS',
            'PRACTICE WITH <br class="hidden md:block lg:hidden">REAL TEACHERS',
            'PERFECT FOR <br class="hidden md:block lg:hidden">BEGINNERS',
            'LIFETIME <br class="hidden md:block lg:hidden">ACCESS'
        ];
    @endphp
    <section class="bg-black text-white px-2 md:py-2 md:px-10">
        <div class="container max-w-4xl mx-auto flex flex-wrap sm:flex-nowrap sm:justify-between py-4 md:py-0">
            @foreach ($items as $item)
                <div class="w-full sm:w-auto flex flex-col items-left justify-center uppercase text-center py-2 lg:py-5">
                    <p class="text-sm flex items-center justify-center">
                        <i class="fa fa-check text-pianote mr-2"></i> {!! $item !!}
                    </p>
                </div>
            @endforeach
        </div>
    </section>


   @php
        $autors = [
        [
            'id' => 'Bach',
            'src' => 'https://d21q7xesnoiieh.cloudfront.net/fit-in/900x0/filters:quality(95)//marketing/pianote/products/classical-piano-collection/prelude-in-c.webp',
            'alt' => 'Bach'
        ],
        [
            'id' => 'BeethovenElise',
            'src' => 'https://d21q7xesnoiieh.cloudfront.net/fit-in/900x0/filters:quality(95)/marketing/pianote/products/classical-piano-collection/fur-elise.webp',
            'alt' => 'BeethovenElise'
        ],
        [
            'id' => 'BeethovenSonata',
            'src' => 'https://d21q7xesnoiieh.cloudfront.net/fit-in/900x0/filters:quality(95)/marketing/pianote/products/classical-piano-collection/moonlight-sonata.webp',
            'alt' => 'BeethovenSonata'
        ],
        [
            'id' => 'Chopin',
            'src' => 'https://d21q7xesnoiieh.cloudfront.net/fit-in/900x0/filters:quality(95)/marketing/pianote/products/classical-piano-collection/prelude-in-e-minor.webp',
            'alt' => 'Chopin'
        ],
        [
            'id' => 'Satie',
            'src' => 'https://d21q7xesnoiieh.cloudfront.net/fit-in/900x0/filters:quality(95)/marketing/pianote/products/classical-piano-collection/gymnopedie.webp',
            'alt' => 'Satie'
        ]
        ];
    @endphp
    <section class="px-4 py-10 sm:py-14 lg:py-20 text-black bg-white">
        <div class="max-w-2xl mx-auto text-center">
            <h2 class="mb-7 playfair leading-none">Do you wish you could <br><strong>play these beautiful pieces?</strong></h2>
            <p class="mb-4 sm:mb-10">From Chopin to Beethoven, these five classical piano pieces are timeless. Just imagine what it would <strong><em>feel like</em></strong> to play them -- rather than just listen to them.</p>
        </div>

        <div class="max-w-5xl mx-auto text-center">
            <div
                x-data="{
                    init() {
                        new Splide(this.$refs.splide, {
                            classes: {
                                arrow: 'splide__arrow bg-white opacity-100 top-[50%] shadow-xl h-12 w-12',
                                prev: 'splide__arrow--prev hidden sm:flex mb-16',
                                next: 'splide__arrow--next hidden sm:flex mb-16',
                                pagination: 'splide__pagination -bottom-10',
                            },
                            perPage: 4,
                            perMove: 1,
                            type: 'loop',
                            focus: 0,
                            pagination: false,
                            interval: 2000,
                            breakpoints: {
                                860: {
                                    perPage: 2.5,
                                },
                                560: {
                                    perPage: 1.5,
                                    focus: 2,
                                },
                                 420: {
                                    perPage: 1,
                                },
                            },
                        }).mount()
                    },
                }"
            >
                <div x-ref="splide" class="splide mb-10 sm:px-16">
                    <div class="splide__track">
                        <ul class="splide__list items-start">
                            @foreach ($autors as $autor)
                                <li class="splide__slide px-2">
                                    <a class="hover:opacity-70 transition-opacity hover:scale-105 transform relative" @click="{{ $autor['id'] }} = true;">
                                        <img class="rounded-xl transition-opacity opacity-0 object-cover bg-center" loading="lazy" onload="this.classList.remove('opacity-0')" src="{{ $autor['src'] }}" alt="{{ $autor['alt'] }}" />
                                        <i class="fas fa-play absolute bottom-0 right-0 m-3 text-white text-xl px-3 py-1.5  bg-pianote rounded-full" style="text-indent: 2px;"></i>
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
            <a class="anchor-slide join smaller w-11/12 sm:max-w-[300px] bg-pianote" href="#final">GET STARTED</a>
        </div>
    </section>

    @php
        $gettings = [
            [
                'position' => 'right',
                'special' => 'https://musora-image-processing-cdn.s3.us-east-2.amazonaws.com/marketing/pianote/products/classical-piano-collection/note-by-note.mp4',
                'title' => 'Note-by-Note Tutorials',
                'desc' => 'You’ll be guided through each piece note-by-note. Nothing is left out and you can choose your tempo to start slow and see progress.',
            ],
            [
                'position' => 'left',
                'img' => 'https://d21q7xesnoiieh.cloudfront.net/fit-in/900x0/filters:quality(95)/marketing/pianote/products/classical-piano-collection/teachers.webp',
                'title' => 'Friendly, REAL Teachers',
                'desc' => 'This isn’t an app. It’s not a video game. These are detailed, step-by-step tutorials from REAL professional piano teachers. And they’re friendly! If you have any questions, you’ll get help from a real person.',
            ],
            [
                'position' => 'right',
                'img' => 'https://d21q7xesnoiieh.cloudfront.net/fit-in/900x0/filters:quality(95)/marketing/pianote/products/classical-piano-collection/simplified.webp',
                'title' => 'Original & Simplified Arrangements',
                'desc' => 'Worried you’re not good enough? We’ve got you. We’ve created simplified arrangements for some pieces so anyone can play them. Because we believe classical piano should be accessible, not exclusive.',
            ],
            [
                'position' => 'left',
                'special' => 'https://musora-image-processing-cdn.s3.us-east-2.amazonaws.com/marketing/pianote/products/classical-piano-collection/play-along.mp4',
                'title' => 'Play-Along Practice Sessions',
                'desc' => 'The hardest part about learning a new song is knowing how to practice it. But we’ve solved that because every lesson IS a practice session. You’ll follow your teacher, playing (and practicing) what they play.',
            ],
        ];
    @endphp
        <section class="text-center px-x py-10 sm:py-16" style="background-image: url('https://d21q7xesnoiieh.cloudfront.net/fit-in/1800x0/filters:quality(95)/marketing/pianote/products/classical-piano-collection/bg.webp'); background-size: cover; background-position: center;">
        <div class="container max-w-4xl mx-auto">
            <div class="max-w-2xl mx-auto text-center mb-4">
                <h2 class="playfair text-3xl">We’re making Classical <br class="inline sm:hidden"> — <strong> Accessible </strong></h2>
                <p class="leading-normal my-2 sm:mb-8">
                    Classical piano has a reputation. It can seem snobby, even elitist. The Classical Piano Collection takes away the pretense and makes classical piano accessible. <br><br>
                    It doesn’t take months or years of lessons before you can play beautiful pieces like these. We’ve taken the fear and formality out of learning classical music.
                </p>
            </div>
            <div class="max-w-4xl mx-auto px-4 pt-7 pb-6 md:pb-0">
                @foreach ($gettings as $key => $getting)
                    @if ($getting['position'] === 'right')
                        <div class="timeline relative flex flex-col-reverse md:grid md:grid-cols-2 gap-4 md:gap-14 lg:gap-20 mb-16 md:mb-20">
                            <div class="content relative text-left md:pl-6">
                                <h5 class="mb-2 mt-1 md:mt-0"><strong>{{ $getting['title'] }}</strong></h5>
                                <p>{{ $getting['desc'] }}</p>
                            </div>
                            @if (!empty($getting['special']))
                                <video class="-mt-7 rounded-lg" src="{{ $getting['special'] }}" type="video/mp4" autoplay muted loop>
                                </video>
                            @else
                                <img class="-mt-7 rounded-lg transition-opacity opacity-0" loading="lazy" onload="this.classList.remove('opacity-0')" src="{{ $getting['img'] }}" alt="{{ $getting['title'] }}" />
                            @endif
                        </div>
                    @else
                        <div class="timeline relative flex flex-col md:grid md:grid-cols-2 gap-4 md:gap-14 lg:gap-20 @if ($key !== count($gettings) - 1) mb-16 md:mb-20 @else md:mb-10 @endif">
                            @if (!empty($getting['special']))
                                <video class="-mt-7 rounded-lg" src="{{ $getting['special'] }}" type="video/mp4" autoplay muted loop>
                                </video>
                            @else
                                <img class="-mt-7 rounded-lg transition-opacity opacity-0" loading="lazy" onload="this.classList.remove('opacity-0')" src="{{ $getting['img'] }}" alt="{{ $getting['title'] }}" />
                            @endif
                            <div class="content relative text-left md:mb-10">
                                <h5 class="mb-2 mt-1 md:mt-0"><strong>{{ $getting['title'] }}</strong></h5>
                                <p>{{ $getting['desc'] }}</p>
                            </div>
                        </div>
                    @endif
                @endforeach
            </div>
            <a class="anchor-slide join smaller w-11/12 sm:max-w-[300px] bg-pianote" href="#final">GET STARTED</a>
        </div>
    </section>


    <section class="teacher-section px-4 lg:pt-10 overflow-hidden relative text-white text-center cursor-pointer" @click="demo=true">
        <h1 class="text-white text-center pb-80 sm:pb-96 playfair leading-snug font-normal md:px-4 pt-4 md:pt-10 md:mb-10">Like having a <br><strong>private teacher on call — 24/7</strong></h1>

        <div class="container mx-auto max-w-5xl relative text-left pt-[16rem] md:pt-84 lg:pt-80 md:px-10">
            <div class="pb-10 sm:pb-24 md:pb-12 grid grid-cols-1 md:grid-cols-2 gap-3 md:gap-12 leading-relaxed text-sm sm:text-base">
                <div class="md:px-4 sm:px-0">
                    <p class="mb-4">
                        You know the drill.
                    </p>
                    <p class="mb-4">
                       When you take private piano lessons, you need to schedule a weekly time with your teacher (assuming you can find one), drive to your lesson, sit with them for an hour, and then drive home.
                    </p>
                    <p class="mb-4">
                       For the remaining 168 hours in the week, you’re on your own.
                    </p>
                    <p class="mb-4">
                       Imagine how much faster you would improve if your teacher was sitting next to you while you practiced.
                    </p>
                </div>
                <div class="md:px-4 sm:px-0">
                    <p class="mb-4">
                       <strong>That’s what you’ll get with the Classical Piano Collection.</strong>
                    </p>
                    <p class="mb-4">
                        Every practice is a play-along video with a REAL teacher. They’ll share their tips, and you can pause, rewind, and replay as often as you need.
                    </p>
                    <p class="mb-4">
                      It’s more convenient (and cheaper) than any private piano teacher.
                    </p>
                </div>
            </div>
        </div>
    </section>


    @php
        $teachers = [
            [
                'name' => 'Lisa Witt',
                'profileImage' => 'https://d21q7xesnoiieh.cloudfront.net/fit-in/800x0/filters:quality(95)/marketing/pianote/products/classical-piano-collection/lisa.webp',
                'description' => 'Meet the friendliest piano teacher on the internet.
                                <br><br>Lisa Witt has inspired millions (yes millions) of piano players across the globe. With her friendly, non-judgmental approach to learning, she’ll bring out the joy of playing piano.
                                <br><br>One lesson with Lisa and you’ll realize…
                                <br><br>YES! You can do this.'
            ],
            [
                'name' => 'Clinton Giovanni Denoni',
                'profileImage' => 'https://d21q7xesnoiieh.cloudfront.net/fit-in/800x0/filters:quality(95)/marketing/pianote/products/classical-piano-collection/clinton.webp',
                'description' => 'Clinton has a Masters of Music in Piano Performance and has represented Canada in several international piano competitions.
                                <br><br>But he’s not just a performer. He’s a teacher.
                                <br><br>And his students have played on stages like Carnegie Hall.
                                <br><br>You’ll love Clinton’s passion and enthusiasm for classical piano.'
            ],
            [
                'name' => 'Kathleen Feenstra',
                'profileImage' => 'https://d21q7xesnoiieh.cloudfront.net/fit-in/800x0/filters:quality(95)/marketing/pianote/products/classical-piano-collection/kathleen.webp',
                'description' => 'Kathleen is an award-winning piano teacher accredited by the Royal Conservatory of Music.
                                <br><br>She has 23 years of teaching experience and has published five books on piano repertoire for various skill levels.
                                <br><br>Kathleen is passionate about seeing her students succeed.
                                <br><br>And that includes you!'
            ]
        ];
    @endphp

    <section class="text-center px-4 sm:px-6 py-10 sm:py-14 lg:py-20" style="background:linear-gradient(to bottom, #f2efed, #FFF);">
        <div class="container max-w-6xl mx-auto pb-16">
            <div class="container max-w-2xl mx-auto">
                <h2 class="text-center playfair leading-none pb-4">Meet your <br> <strong>friendly piano teachers.</strong></h2>
                <p class="mb-24">With decades of experience teaching classical piano, you’ll know you’re in safe hands.</p>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-20 sm:gap-x-10 lg:gap-8">
                @foreach ($teachers as $index => $teacher)
                    <div class="relative text-left z-10 rounded-2xl pt-12 pb-16 md:pb-10 px-10 md:px-6 {{ $index === 2 ? 'w-full sm:w-1/2 lg:w-full' : 'w-full' }} w-full shadow-xl {{ $index === 2 ? 'sm:col-span-2 sm:mx-auto lg:col-span-1 lg:mx-0' : '' }}" style="background-color:#ffffff;">
                        <div class="absolute top-0 left-1/2 w-28 h-28 mx-auto mb-4">
                            <div class="transform -translate-x-1/2 -translate-y-1/2 w-full h-full rounded-full border-4 border-white shadow-md overflow-hidden">
                                <img class="w-full h-full object-cover rounded-full transition-all opacity-0" alt="profile picture" loading="lazy" onload="this.classList.remove('opacity-0')"
                                    src="{{ $teacher['profileImage'] }}">
                            </div>
                        </div>
                        <br>
                        <h5 class="playfair pb-2"><strong> {!! $teacher['name'] !!}</strong></h5>
                        <p class="text-sm lg:text-base">
                            {!! $teacher['description'] !!}
                        </p>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    @php
        $logo = 'https://d21q7xesnoiieh.cloudfront.net/fit-in/800x0/filters:quality(95)/marketing/pianote/products/classical-piano-collection/guarantee.svg';
        $guaranteeText = "You want to play beautiful classical piano. And if that doesn’t happen…
        <br><br>You shouldn’t have to pay.
        <br><br> We’re committed to giving you the best lessons and support to play these beautiful songs.<br> But we know it takes time. That’s why you’ll have 90 days to try the lessons risk-free.
        <br><br>If you’re not playing “Moonlight Sonata” or “Für Elise” (or at least making progress), email <u> support@pianote.com</u> within 90 days for a FULL refund.";
        $guaranteeHeader = "<strong>The Play Beautiful <br class='inline sm:hidden'> Guarantee</strong>";
    @endphp

    <div class="h-5 sm:h-10 -mt-5 sm:-mt-10" style="background: linear-gradient(to bottom right, transparent calc(50% - 1px), transparent, #111729 calc(50% + 1px));"></div>

    <section class="text-center text-white px-5 sm:px-6 pb-10 sm:pb-14 lg:pb-20 py-10 sm:py-14 lg:pt-32" style="background-color: #111729; border: 1px solid #111729;">
        <div class="container max-w-5xl mx-auto">
            <img class="h-28 sm:h-40 lg:h-52 block mx-auto -mt-24 sm:-mt-36 lg:-mt-48 transition-all opacity-0"
                src="{{ $logo }}" alt="guarantee badge" loading="lazy" onload="this.classList.remove('opacity-0')">
            <div class="max-w-3xl mx-auto mt-6">
                <h3 class="my-4 sm:my-6 lg:my-8">{!! $guaranteeHeader !!}</h3>
                <p class="leading-normal">{!! $guaranteeText !!}</p>
            </div>
        </div>
    </section>


    @php
        $courseDetails = [
            'title' => '32 Guided Play-Along Lessons.<br>Original & Simplified Arrangements.<br>Practice With Real Teachers.<br>Lifetime Access.',
            'features' => [
                'Play 5 beautiful piano masterpieces.',
                'Downloadable sheet music for each arrangement.',
                'Join ' . number_format($nPackOwners ?? 0) . ' piano players who have already registered.',
                'Choose your best option to get started.',
            ],
            'courseOnly' => [
                'title' => 'The Classical Piano Collection',
                'description' => 'Play the most beautiful piano music in the world with step-by-step tutorials.',
                'price' => 95,
                'discountedPrice' => 127,
                'keyFeatures' => [
                    'Lifetime Access',
                    '90-Day Guarantee'
                ]
            ],
            'membershipSpecial' => [
                'title' => 'Join Pianote + Get <br class="hidden sm:inline"> The Classical Piano Collection FREE',
                'description' => 'The Ultimate Online Lessons Experience.',
                'price' => 240,
                'discountedPrice' => 240,
                'keyFeatures' => [
                    'Annual Pianote Membership ($240 value)',
                    '<span class="text-pianote">BONUS</span> Classical Piano Collection ($127 value)',
                    '<span class="text-pianote">BONUS</span> Pianote Metronome ($79 value)',
                    '<span class="text-pianote">BONUS</span> Most Beautiful Classical Piano Pieces ($49 value)',
                    '90-Day Guarantee'
                ]
            ]
        ];
    @endphp
    <section class="text-center relative z-50 overflow-hidden px-5 sm:px-6 py-10 sm:py-14 lg:py-20 text-black" style="background-color:#F6F5F4;" id="final">
        <div class="container max-w-6xl mx-auto relative z-50">
            <div class="flex flex-wrap items-center">
                <div class="text-center lg:text-left w-full lg:w-1/3 mb-7 lg:mb-0 relative">
                    <h3 class="tracking-wide"> The </h3>
                    <h3 class="italic playfair text-6xl">Classical Piano</h3>
                    <h4 class="tracking-widest uppercase">Collection</h4>
                    <h4 class="leading-tight mt-2 mb-4 sm:my-4 lg:my-5 text-black"><strong>{!! $courseDetails['title'] !!}</strong></h4>
                    <div class="w-full mx-auto sm:mx-0">
                        @foreach ($courseDetails['features'] as $feature)
                            <p class="mb-2 sm:mb-3 text-black"><i class="fas fa-check text-xl text-{{$theme}} mr-1"></i> {{ $feature }}</p>
                        @endforeach
                    </div>
                </div>

                <div class="flex flex-wrap sm:flex-nowrap max-w-xs sm:max-w-full items-center text-left w-full mx-auto lg:w-2/3 lg:pl-5 xl:pl-10">
                    <a href="/ecommerce/add-to-cart?products[classical-piano-collection]=1&locked=true"
                       class="z-10 relative px-5 sm:px-6 py-7 sm:py-9 mb-7 sm:mb-0 bg-white rounded-xl shadow-xl w-full sm:w-5/12" style="text-decoration:none">
                        <p class="border border-{{$theme}} text-{{$theme}} inline-block rounded-xl text-sm mb-2 px-4 tracking-wider text-black">COURSE ONLY</p>
                        <h3 class="text-black leading-tight"><strong>{{ $courseDetails['courseOnly']['title'] }}</strong></h3>
                        <p class="text-sm mb-5 text-black">{{ $courseDetails['courseOnly']['description'] }}</p>
                        @if ($courseDetails['courseOnly']['price'] == $courseDetails['courseOnly']['discountedPrice'])
                            <h2 class="inline-block text-black"><strong class="text-4xl">${{ $courseDetails['courseOnly']['price'] }}</strong></h2>
                        @else
                            <h2 class="inline-block text-black opacity-40 font-light text-4xl line-through">${{ $courseDetails['courseOnly']['discountedPrice'] }}</h2>
                            <h2 class="inline-block text-black"><strong class="text-4xl">${{ $courseDetails['courseOnly']['price'] }}</strong></h2>
                        @endif
                        <p class="inline-block text-sm text-black">One time payment.</p><br>
                        <div class="join bg-{{$theme}} smaller my-4 w-full max-w-[260px] text-white uppercase">get started</div>

                        <div class="text-sm text-pianote">
                            <span x-cloak x-data="timer()" x-init="countdown()">
                                <strong>Discount ends in:</strong>
                                <br>
                                <span class="uppercase text-black font-thin">
                                    <span x-cloak x-show="timeLeft > 0 && day > 0"><span x-text="day"></span><span x-text="dayText"></span></span>
                                    <span x-cloak x-show="timeLeft > 0 && hour > 0"><span x-text="hour"></span><span x-text="hourText"></span></span>
                                    <span x-cloak x-show="timeLeft > 0"><span x-text="minute"></span><span x-text="minuteText"></span></span>
                                    <span x-cloak x-show="timeLeft < 0">A Limited Time</span>
                                </span>
                            </span>
                        </div>
                        <hr class="w-full my-5" style="border-color:#b2cae1">
                        <p class="leading-loose text-sm text-black"><strong>Key Features</strong><br>
                            @foreach ($courseDetails['courseOnly']['keyFeatures'] as $keyFeature)
                                <i class="fas fa-check text-{{$theme}} mr-1"></i> {!! $keyFeature !!}<br>
                            @endforeach
                        </p>
                    </a>
                    <a href="/shop/classical-piano-collection-membership"
                       class="px-5 sm:px-9 py-5 sm:py-7 sm:-ml-5 rounded-xl shadow-xl w-full sm:w-6/12 lg:w-7/12 bg-white" style="text-decoration:none; background: #FFFBF7;">
                        <p class="border border-{{$theme}} text-{{$theme}} inline-block rounded-xl text-sm mb-2 px-4 tracking-wider text-black">LAUNCH MEMBERSHIP SPECIAL</p>
                        <h3 class="text-black leading-tight"><strong>{!! $courseDetails['membershipSpecial']['title'] !!}</strong></h3>
                        <p class="text-sm mb-5 text-black">{{ $courseDetails['membershipSpecial']['description'] }}</p>
                        @if ($courseDetails['membershipSpecial']['price'] == $courseDetails['membershipSpecial']['discountedPrice'])
                            <h2 class="inline-block text-black"><strong class="text-4xl">${{ $courseDetails['membershipSpecial']['price'] }}</strong></h2>
                        @else
                            <h2 class="inline-block text-black opacity-40 font-light text-4xl line-through">${{ $courseDetails['membershipSpecial']['discountedPrice'] }}</h2>
                            <h2 class="inline-block text-black"><strong class="text-4xl">${{ $courseDetails['membershipSpecial']['price'] }}</strong></h2>
                        @endif
                        <p class="inline-block text-sm text-black">(Includes $255 in free bonuses)</p><br>
                        <div class="join bg-{{$theme}} smaller my-4 w-full max-w-[260px] text-white uppercase">learn more</div>
                        <ul class="list-disc ml-6 text-black">
                            @if (!empty($courseDetails['membershipSpecial']['bonusItems']))
                                @foreach ($courseDetails['membershipSpecial']['bonusItems'] as $bonusItem)
                                    <li class="text-sm leading-relaxed text-black"><span class="text-{{$theme}}"></span> {!! $bonusItem !!}</li>
                                @endforeach
                            @endif
                        </ul>
                        <div class="text-sm text-pianote">
                            <span x-cloak x-data="timer()" x-init="countdown()">
                                <strong>Offer ends in:</strong>
                                <br>
                                <span class="uppercase text-black font-thin">
                                    <span x-cloak x-show="timeLeft > 0 && day > 0"><span x-text="day"></span><span x-text="dayText"></span></span>
                                    <span x-cloak x-show="timeLeft > 0 && hour > 0"><span x-text="hour"></span><span x-text="hourText"></span></span>
                                    <span x-cloak x-show="timeLeft > 0"><span x-text="minute"></span><span x-text="minuteText"></span></span>
                                    <span x-cloak x-show="timeLeft < 0">A Limited Time</span>
                                </span>
                            </span>
                        </div>
                        <hr class="w-full my-5" style="border-color:#b2cae1">
                        <p class="leading-loose text-sm text-black"><strong>Key Features</strong><br>
                            @foreach ($courseDetails['membershipSpecial']['keyFeatures'] as $keyFeature)
                                <i class="fas fa-check text-{{$theme}} mr-1"></i> {!! $keyFeature !!}<br>
                            @endforeach
                        </p>
                    </a>
                </div>
            </div>
        </div>
    </section>

    @include('_partials.components.video-modal', [
        'name' => 'Bach',
        'video' => '1007115728',
        'vimeo' => true,
    ])
    @include('_partials.components.video-modal', [
        'name' => 'BeethovenElise',
        'video' => '1007115798',
        'vimeo' => true,
    ])
    @include('_partials.components.video-modal', [
        'name' => 'BeethovenSonata',
        'video' => '1007115405',
        'vimeo' => true,
    ])
    @include('_partials.components.video-modal', [
        'name' => 'Chopin',
        'video' => '1007115186',
        'vimeo' => true,
    ])
    @include('_partials.components.video-modal', [
        'name' => 'Satie',
        'video' => '1007115855',
        'vimeo' => true,
    ])
    @include('_partials.components.video-modal', [
        'name' => 'trailer',
        'video' => '785314388',
        'vimeo' => true,
    ])
    @include('_partials.components.video-modal', [
        'name' => 'demo',
        'video' => '1007790486',
        'vimeo' => true,
    ])

       <!-- TODO:Add correct date -->
    @include('_partials.components.countdown', [
        'countdownDate' => '2024-09-30 00:00:00',
        'promoVersion' => false
    ])

    @include('pianote.sales.partials._footer')
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script type="text/javascript" src="{{ asset('/marketing/parcel/drumeo/navigation-sales.js') }}" defer></script>
    <script src="https://cdn.jsdelivr.net/npm/@splidejs/splide@4.1.4/dist/js/splide.min.js"></script>

    <script src="{{ mix('/platform/js/manifest.js') }}"></script>
    <script src="{{ mix('/platform/js/vendor.js') }}"></script>
    <script src="{{ mix('/platform/js/app.js') }}"></script>
@stop
