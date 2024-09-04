@php
    require_once(resource_path('marketing/views/pianote/_partials/homepage-data.php'));
@endphp

@extends('pianote._partials.global-layout')

@section('global-head')
    <title>The Classical Piano Collection | Pianote</title>
    <meta property="og:title" content="Pianote - Learn the piano anytime with real teachers.">
    <meta property="og:url" content="https://www.pianote.com/">

    <meta name="description" content="Play The Most Beautiful Piano Music In The World With Step-By-Step Tutorials">
    <meta property="og:description" content="Play The Most Beautiful Piano Music In The World With Step-By-Step Tutorials">

    @hasSection('share-image')
        @yield('share-image')
    @else
        <meta property="og:image" content="https://d21q7xesnoiieh.cloudfront.net/fit-in/1200x0/filters:quality(95)/marketing/pianote/products/classical-piano-collection/share-image.jpg">
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

        .join {
            font-size: 1.4rem;
            padding:18px 5%;
        }
    
        @if(!empty($trialVersion))
            .option-buttons.active {
                border-color: #f61a30 !important;
                background-color: #4a0c12 !important;
            }
            .option-buttons.active .radio-check {
                border-color: #f61a30 !important;
                background-color: #f61a30 !important;
            }
            .option-buttons.active .radio-check i {
                display: block !important;
            }
        @endif
    
        .splide__slide.is-active .active-bg {
            background-color: #1B2434 !important;
            color: #fff !important;
        }
    </style>
@stop

@section('body-data')
    x-data ='{
    demoVid : false,
    trailer : false,
    stepTwo : false,
    lazyLoad: false,
    videoLoaded: false,
    }'
@endsection

@section('global-body')
    @php
        $originalPrice = 495;
        $discountedPrice = 240;
        $buttonLink = '/ecommerce/add-to-cart?products[PIANOTE-MEMBERSHIP-1-YEAR]=1&products[classical-piano-collection]=1&products[taktell-piccolo-metronome]=1&products[classical-piano-pieces]=1&locked=true';
        $buttonLink2 = '/ecommerce/add-to-cart?products[PIANOTE-MEMBERSHIP-1-YEAR]=1&products[classical-piano-collection]=1&locked=true';
    @endphp

    @include("pianote.sales.partials._nav", [
        "subscriptionVersion" => true,
        "scrollToJoin" => true,
        "hideMenu" => true,
    ])
    <header class="text-center px-5 sm:px-6 py-16 sm:py-20 lg:py-32 relative overflow-hidden text-white bg-cover bg-center"
        style="background-image: url('https://d21q7xesnoiieh.cloudfront.net/fit-in/2500x0/filters:quality(95)/marketing/pianote/products/classical-piano-collection/membership/header-bg.webp');">
        <div class="container max-w-6xl mx-auto relative z-20">
            <img class="h-8 sm:h-10 mb-3 sm:mb-4" src="https://d21q7xesnoiieh.cloudfront.net/fit-in/250x0/filters:quality(95)/marketing/pianote/membership/homepage/2023/pianote-logo-red.png">
            <br>
            <h1 class="relative w-auto inline-block text-3xl sm:text-5xl lg:text-6xl mb-7 sm:mb-10 leading-none sm:leading-none lg:leading-none uppercase">
               START PLAYING BEAUTIFUL<br>
               PIANO <strong class="relative inline-block"> IN JUST 10 MINUTES  </strong><br class="hidden sm:inline">
                <svg class="absolute left-0 right-0 bottom-0 w-full h-4 sm:h-5" xmlns="http://www.w3.org/2000/svg" width="100%" height="100%" viewBox="0 0 524 22" fill="none" style="transform: translate(0, 70%);"><path d="M1.99978 10.6328C84.053 4.08508 302.889 -3.20824 521.809 20" stroke="#F61A30" stroke-width="3" stroke-linecap="round"></path><path d="M2.17373 15.0541C83.9528 7.29382 302.406 -3.51921 521.988 15.3111" stroke="#F61A30" stroke-width="3" stroke-linecap="round"></path></svg>
            </h1>
            <p class="text-sm leading-normal mb-5 lg:mb-7">
                <i class="fas fa-check text-pianote"></i>  Step-by-step lessons
                <i class="fas fa-check lg:ml-5 text-pianote"></i>Practice with <strong>real</strong> teachers
                <br class="sm:hidden">
                <i class="fas fa-check lg:ml-5 text-pianote"></i> Personal support
                <i class="fas fa-check ml-3 sm:ml-5 text-pianote"></i> Popular songs
            </p>

           <div class="mt-5 sm:mt-7 mb-2 w-full max-w-xl mx-auto">
                    
                    <a class="w-full sm:w-5/12 join sold-out smaller text-white bg-pianote my-2 sm:m-2 hover:bg-red-500" href="/ecommerce/add-to-cart?products[PIANOTE-MEMBERSHIP-1-YEAR]=1&products[classical-piano-collection]=1&products[taktell-piccolo-metronome]=1&products[classical-piano-pieces]=1&locked=true">GET STARTED</a>
                <div class="sm:w-5/12 join smaller outline hidden sm:inline-block bg-transparent hover:bg-white hover:text-black"
                        @click="trailer = true;">
                        &nbsp;Watch Trailer
                    </div>
                    <div class="w-full sm:w-5/12 join smaller outline sm:hidden inline-block bg-transparent hover:bg-white hover:text-black"
                        x-data="{ move: false }" @mouseover="move = true" @mouseout="move = false" @click="trailer = true;">
                        &nbsp;Watch Trailer
                    </div>
            </div>
            
        </div>
    </header>

    <section class="px-4 sm:px-6 py-12 sm:py-20 text-center bg-[#FFFFFF]">
        <div class="container max-w-4xl mx-auto">
        <div class="container mx-auto max-w-3xl">
         <h2 class="pb-4">Learn classical piano… <br class="block md:hidden"><strong>and so much more.</strong></h2>
            <p class="mb-8 md:mb-10">With a Pianote Membership, you’ll get LIFETIME access to The Classical Piano Collection. But you’ll also get access to EVERYTHING else.</p>
        </div>
           
            <div class="flex flex-wrap sm:flex-nowrap justify-center">
                @php
                    $features = [
                        [
                            'img' => 'https://d21q7xesnoiieh.cloudfront.net/fit-in/900x0/filters:quality(95)/marketing/pianote/products/classical-piano-collection/membership/classical-method.webp',
                            'title' => 'The Classical Method',
                            'desc' => 'Go beyond individual pieces. <br> The Classical Method is a 5-level curriculum taught by professional pianist Victoria Theodore (Beyoncé, Stevie Wonder).',
                        ],
                        [
                            'img' => 'https://d21q7xesnoiieh.cloudfront.net/fit-in/900x0/filters:quality(95)/marketing/pianote/products/classical-piano-collection/membership/30-day-challenges.webp',
                            'title' => '30-Day Challenges',
                            'desc' => 'Play beautiful piano in 10 minutes.<br> Try any one of our 30-day challenges and practice WITH a real teacher.',
                        ],
                        [
                            'img' => 'https://d21q7xesnoiieh.cloudfront.net/fit-in/900x0/filters:quality(95)/marketing/pianote/products/classical-piano-collection/membership/favorite-songs.webp',
                            'title' => 'Your Favorite Songs',
                            'desc' => 'Why do you learn the piano? </br>To play songs!<br> Explore our library of popular songs and learn your favorite today.',
                        ],
                    ];
                @endphp
    
                @foreach ($features as $feature)
                    <div class="w-full sm:w-1/3 px-4 mb-8 sm:mb-0 text-center flex flex-col items-center">
                        <div class="mb-4 w-full flex items-center justify-center">
                            <img src="{{ $feature['img'] }}" alt="{{ $feature['title'] }}" class="w-full h-full object-contain rounded-xl">
                        </div>
                        <h3 class="text-xl font-semibold">{{ $feature['title'] }}</h3>
                        <p class="text-xs tracking-tight leading-loose">{!! $feature['desc'] !!}</p>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <section class="text-center px-5 sm:px-6 py-12 sm:py-16 lg:py-20 relative overflow-hidden " style="background: linear-gradient(180deg, #f4f0eb, #fff);">
        <div class="container max-w-3xl mx-auto relative z-20">
            <h2 class="leading-tight mb-4">Play <strong>beautiful piano in <br> just 10 minutes.</strong></h2>

            <div class="bg-white rounded-xl border border-gray p-4 sm:p-5">
                <h5 class="uppercase text-pianote"><strong>Step 1</strong></h5>
                <p class="py-5 tracking-tight leading-normal"><strong>Choose your course.</strong> You’ll find courses on pop music, chording, Blues, even improvisation.<br class="hidden md:block"> Choose the one you want to learn. For beginners, we recommend New Piano Players Start Here.</p>
                <div class="max-w-6xl mx-auto">
                    <div
                        x-data="{
                            init() {
                                new Splide(this.$refs.splide, {
                                    classes: {
                                        arrow: 'splide__arrow bg-white opacity-100 shadow-lg h-11 w-11',
                                        prev: 'splide__arrow--prev your-class-prev hidden',
                                        next: 'splide__arrow--next your-class-next -right-1',
                                        pagination: 'splide__pagination flex -bottom-10',
                                    },
                                    padding: '3rem',
                                    perPage: 4,
                                    perMove: 1,
                                    type: 'slide',
                                    start: 0,
                                    focus: 0,
                                    interval: 2000,
                                    lazyLoad: 'nearby',
                                    breakpoints: {
                                        1020: {
                                            padding: '2rem',
                                        },
                                        768: {
                                            padding: '3rem',
                                            perPage: 3,
                                            drag: 'free',
                                            snap: false,
                                        },
                                        620: {
                                            padding: '1rem',
                                            perPage: 2,
                                            arrows: false,
                                        },
                                    },
                                }).mount()
                            },
                        }"
                    >
                        <div x-ref="splide" class="splide mb-20 sm:mb-10">
                            <div class="splide__track">
                                <ul class="splide__list">
                                    @php
                                        $packs = [
                                            [
                                                "image" => "marketing/pianote/products/classical-piano-collection/pack-section/cpc.jpg",
                                                "logo" => "marketing/pianote/products/classical-piano-collection/pack-section/cpc-logo.png",
                                                "h" => "11",
                                                "name" => "Lisa Witt",
                                            ],
                                            [
                                                "image" => "marketing/pianote/products/classical-piano-collection/pack-section/NPPSH.webp",
                                                "logo" => "marketing/pianote/products/classical-piano-collection/pack-section/NPPSH-logo.webp",
                                                "h" => "12",
                                                "name" => "Lisa Witt",
                                            ],
                                            [
                                                "image" => "marketing/pianote/products/classical-piano-collection/pack-section/EC.webp",
                                                "logo" => "marketing/pianote/products/classical-piano-collection/pack-section/EC-logo.webp",
                                                "h" => "12",
                                                "name" => "Lisa Witt",
                                            ],
                                            [
                                                "image" => "marketing/pianote/products/classical-piano-collection/pack-section/RMI30D.webp",
                                                "logo" => "marketing/pianote/products/classical-piano-collection/pack-section/RMI30D-logo.webp",
                                                "h" => "12",
                                                "name" => "Lisa Witt",
                                            ],
                                            [
                                                "image" => "marketing/pianote/products/classical-piano-collection/pack-section/LHA101.webp",
                                                "logo" => "marketing/pianote/products/classical-piano-collection/pack-section/LHA101-logo.webp",
                                                "h" => "12",
                                                "name" => "Lisa Witt",
                                            ],
                                            [
                                                "image" => "marketing/pianote/products/classical-piano-collection/pack-section/30DBP.webp",
                                                "logo" => "marketing/pianote/products/classical-piano-collection/pack-section/30DBP-logo.webp",
                                                "h" => "16",
                                                "name" => "Kevin Castro",
                                            ],
                                            [
                                                "image" => "marketing/pianote/products/classical-piano-collection/pack-section/30DTBT.webp",
                                                "logo" => "marketing/pianote/products/classical-piano-collection/pack-section/30DTBT-logo.webp",
                                                "h" => "16",
                                                "name" => "Jordan Rudess",
                                            ],
                                            [
                                                "image" => "marketing/pianote/products/classical-piano-collection/pack-section/5LPS.webp",
                                                "logo" => "marketing/pianote/products/classical-piano-collection/pack-section/5LPS-logo.webp",
                                                "h" => "16",
                                                "name" => "Jemma Heigis",
                                            ],
                                            [
                                                "image" => "marketing/pianote/products/classical-piano-collection/pack-section/5L251.webp",
                                                "logo" => "marketing/pianote/products/classical-piano-collection/pack-section/5L251-logo.webp",
                                                "h" => "16",
                                                "name" => "Kevin Castro",
                                            ],
                                            [
                                                "image" => "marketing/pianote/products/classical-piano-collection/pack-section/5LOI.webp",
                                                "logo" => "marketing/pianote/products/classical-piano-collection/pack-section/5LI-logo.webp",
                                                "h" => "16",
                                                "name" => "Justin Stanton",
                                            ],
                                            [
                                                "image" => "marketing/pianote/products/classical-piano-collection/pack-section/5L1564.webp",
                                                "logo" => "marketing/pianote/products/classical-piano-collection/pack-section/5L1564-logo.webp",
                                                "h" => "16",
                                                "name" => "Devid Bennett",
                                            ],
                                            [
                                                "image" => "marketing/pianote/products/classical-piano-collection/pack-section/5LRT.webp",
                                                "logo" => "marketing/pianote/products/classical-piano-collection/pack-section/5LRT-logo.webp",
                                                "h" => "16",
                                                "name" => "Ben Dunnill",
                                            ],
                                        ];
                                    @endphp
                                    @foreach ($packs as $pack)
                                        <li class="splide__slide flex flex-col items-center justify-start px-1">
                                            <div class="relative w-full rounded-xl overflow-hidden" style="padding-bottom: 150%;">
                                                <picture>
                                                    <source media="(min-width:1024px)" data-srcset="https://d21q7xesnoiieh.cloudfront.net/fit-in/490x0/filters:quality(95)/{{$pack['image']}}">
                                                    <source media="(min-width:640px)" data-srcset="https://d21q7xesnoiieh.cloudfront.net/fit-in/320x0/filters:quality(95)/{{$pack['image']}}">
                                                    <img
                                                        class="absolute top-0 left-0 w-full h-full object-cover object-top transition-opacity opacity-0 duration-300"
                                                        data-splide-lazy="https://d21q7xesnoiieh.cloudfront.net/fit-in/490x0/filters:quality(95)/{{$pack['image']}}"
                                                        onload="this.classList.remove('opacity-0');"
                                                    />
                                                </picture>
                                                <div class="absolute bottom-0 left-0 w-full text-white p-2 flex flex-col items-center">
                                                    @if (!empty($pack['logo']))
                                                        <img src="https://d21q7xesnoiieh.cloudfront.net/fit-in/600x0/filters:quality(95)/{{ $pack['logo'] }}" @if (!empty($pack['name'])) alt="{{ $pack['name'] }} @endif" class="h-{{ $pack['h'] }} mb-1">
                                                    @endif
                                                    @if (!empty($pack['name']))
                                                        <span class="text-xs py-1">{{ $pack['name'] }}</span>
                                                    @endif
                                                </div>
                                            </div>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <h4 class="leading-tight text-pianote my-4">
                <i class="fas fa-arrow-down"></i>
            </h4>
            
            <div class="bg-white rounded-xl border border-gray p-4 sm:p-5">
                <h5 class="uppercase text-pianote">
                    <strong>Step 2</strong>
                </h5>
                <p class="py-5 tracking-tight leading-normal">
                    <strong>Press play and follow along.</strong> It’s that easy. You’ll learn by playing WITH a real teacher. The sessions are short, focused, and most of all -- fun! Each day you’ll unlock a new lesson. Give it a try!
                </p>
                <div class="aspect-16:9 cursor-pointer rounded-xl autoplay-video overflow-hidden w-full relative" x-on:click="stepTwo = true;">
                    <video class="rounded-xl overflow-hidden object-cover w-full h-full absolute z-0"
                           x-ref="playToLearnVideo"
                           x-intersect.once="videoLoaded = true; $refs.playToLearnVideo.src = $refs.playToLearnVideo.dataset.src;"
                           x-effect="if (videoLoaded) { $refs.playToLearnVideo.play(); }"
                           data-src="https://musora-image-processing-cdn.s3.us-east-2.amazonaws.com/marketing/pianote/promos/august/step2.mp4"
                           type="video/mp4"
                           autoplay
                           muted
                           loop
                           playsinline>
                    </video>
                </div>
            </div>
            
            <h4 class="leading-tight text-pianote my-4">
                <i class="fas fa-arrow-down"></i>
            </h4>
            
            <h5 class="uppercase text-pianote">
                <strong>Step 3</strong>
            </h5>
            <p class="py-5 tracking-tight leading-normal px-6">
                <strong>Hear the result.</strong> The most important part of learning piano is building a daily habit. By practicing just a little bit each day, you’ll hear the results sooner (so will everyone else!).
            </p>
            
            <div class="container max-w-5xl mx-auto pb-4">
                <img class="w-full" src="https://d21q7xesnoiieh.cloudfront.net/fit-in/2050x0/filters:quality(95)/marketing/pianote/promos/august/step3.png">
            </div>
            
            <a class="anchor-slide join w-11/12 sm:max-w-[440px] bg-pianote" href="#final">GET STARTED</a>
    </section>

    @php
        $gettings = [
            [
                'position' => 'left',
                'img' => 'https://d21q7xesnoiieh.cloudfront.net/fit-in/900x0/filters:quality(95)/marketing/pianote/products/classical-piano-collection/membership/classical-piano-collection.webp',
                'title' => 'The Classical Piano Collection',
                'value' => '<br>($127 Value)',
                'desc' => 'You’ll get LIFETIME access to the Classical Piano Collection.<br class="block md:hidden">Play beautiful masterpieces and participate in the world of classical piano.<br class="block md:hidden"> Even if you choose not to renew your Pianote membership, it’s yours to keep forever.',
            ],
            [
                'position' => 'right',
                'img' => 'https://d21q7xesnoiieh.cloudfront.net/fit-in/900x0/filters:quality(95)/marketing/pianote/products/classical-piano-collection/membership/metronome.webp',
                'title' => 'The Pianote Metronome ',
                 'value' => '<br>($79 Value)',
                'desc' => 'A metronome is the essential practice tool, especially for classical piano. <br class="block md:hidden"> Improve your timing, rhythm, and feel with this beautiful handmade metronome by Wittner. <br class="block md:hidden">Lightweight and compact, this metronome ranges from 40-208bpm with precision timing so it always stays on beat.',
            ],
            [
                'position' => 'left',
                'img' => 'https://d21q7xesnoiieh.cloudfront.net/fit-in/900x0/filters:quality(95)/marketing/pianote/products/classical-piano-collection/membership/classical-piano-pieces.webp',
                'title' => 'The Most Beautiful Classical <br> Piano Pieces',
                 'value' => '($49 Value)',
                'desc' => 'This book contains timeless classics you’ll want to play over and over again.<br class="block md:hidden"> Pieces from Bach, Beethoven, Chopin, and Debussy.<br class="block md:hidden"> And each piece is presented in original and simplified arrangements, so it’s perfect for beginners as well as experienced pianists.',
            ]
        ];
    @endphp
    <section class="text-center px-x py-10 sm:pt-16 bg-white">
        <div class="container max-w-4xl mx-auto hidden md:block">
            <div class="max-w-2xl mx-auto text-center mb-4"> 
                <h2 class="playfair text-3xl">Free bonuses to <br class="inline sm:hidden"><strong> help you play better. </strong></h2>
                <p class="leading-normal my-2 sm:mb-8">Improve your timing and expand your repertoire with these FREE gifts. <br><br>
                    It doesn’t take months or years of lessons before you can play beautiful pieces like these.  <br class="inline sm:hidden">We’ve taken the fear and formality out of learning classical music.
                </p>
            </div>
            <div class="max-w-4xl mx-auto px-4 pt-7">
                @foreach ($gettings as $key => $getting)
                    @if ($getting['position'] === 'right')
                        <div class="timeline relative flex flex-col-reverse md:grid md:grid-cols-2 gap-4 md:gap-14 lg:gap-20 mb-16 md:mb-20">
                            <div class="content relative text-left md:pl-6">
                                <h5 class="mb-2 mt-1 md:mt-0"><strong>{!! $getting['title'] !!}</strong></h5>
                                <p>{!! $getting['desc'] !!}</p>
                            </div>
                            @if (!empty($getting['special']))
                                <video class="-mt-7 rounded-lg" src="{{ $getting['special'] }}" type="video/mp4" autoplay muted loop>
                                </video>
                            @else
                                <img class="-mt-7 rounded-lg transition-opacity opacity-0" loading="lazy" onload="this.classList.remove('opacity-0')" src="{{ $getting['img'] }}" alt="{{ $getting['title'] }}" />
                            @endif
                        </div>
                    @else
                        <div class="timeline relative flex flex-col md:grid md:grid-cols-2 gap-4 md:gap-14 lg:gap-20 @if ($key !== 4) mb-16 md:mb-20 @else md:mb-0 @endif">
                            @if (!empty($getting['special']))
                                <video class="-mt-7 rounded-lg" src="{{ $getting['special'] }}" type="video/mp4" autoplay muted loop>
                                </video>
                            @else
                                <img class="-mt-7 rounded-lg transition-opacity opacity-0" loading="lazy" onload="this.classList.remove('opacity-0')" src="{{ $getting['img'] }}" alt="{{ $getting['title'] }}" />
                            @endif
                            <div class="content relative text-left md:mb-10">
                                <h5 class="mb-2 mt-1 md:mt-0"><strong>{!! $getting['title'] !!}</strong></h5>
                                <p>{!! $getting['desc'] !!}</p>
                            </div>
                        </div>
                    @endif
                @endforeach
            </div>
          
            </div>
        </div>
                <div class="container max-w-4xl px-4 mx-auto text-left md:hidden pb-10">
            @foreach ($gettings as $key => $getting)
                <div class="mb-4" x-data="{ open: {{ $key === 0 ? 'true' : 'false' }} }" @click="open = !open">
                    <div class="w-full text-left flex justify-between items-center p-4 bg-gradient-to-b from-[#F4F0EB] to-white rounded-xl">
                        <strong><span x-show="!open" class="text-2xl py-2">{!! $getting['title'] !!} {!! $getting['value'] !!}</strong>
                        <span x-show="!open" x-text="open ? '-' : '+'" class="text-2xl"></span></span>
                    </div>
                    <div x-show="open" class="p-4 bg-white">
                        <img class="rounded-lg mb-4" loading="lazy" src="{{ $getting['img'] }}" alt="{{ $getting['title'] }}" />
                        <span x-show="open" class="text-2xl"><strong>{!! $getting['title'] !!} {!! $getting['value'] !!}</strong></span>
                        <p class="leading-loose pt-2">{!! $getting['desc'] !!}</p>
                    </div>
                </div>
            @endforeach
        </div>
          <a class="anchor-slide join w-11/12 sm:max-w-[440px] bg-pianote" href="#final">claim your bonuses</a>
            <div class="container px-4 sm:mx-auto max-w-xl text-black opacity-50 pt-4 lg:pt-6 leading-none">
             <p class="text-xs">If VAT or Customs is an issue, you can choose not to receive any physical bonuses.</p>
            <a class="underline cursor-pointer text-xs" href="">Click here to choose that option.</a>
    </section>

    <section class="px-5 sm:px-6 pt-10 md::pt-16 lg:pt-20 relative text-white" style="background-color:#F4F0EB;">
        <div class="container max-w-6xl mx-auto">
            <div class="flex flex-col md:flex-row gap-8">
                <div class="flex flex-col justify-center text-black pb-4 md:pb-10 lg:pb-16 w-full md:w-5/12 text-left sm:text-center md:text-left">
                    <div class="text-2xl font-bold md:text-3xl">
                        <strong>
                            And we’re <br class="block sm:hidden">
                            <div class="inline-block bg-pianote uppercase text-white px-2 rounded">LIVE</div> <br class="hidden md:block lg:hidden"> in 3, 2, 1…
                        </strong>
                    </div>
                    <p class="italic font-black py-2"></p>
                    <p class="mb-6 md:leading-tight lg:leading-normal">
                        <strong><em>Weekly live lessons with REAL teachers to become a better piano player.</em><br><br>
                        It’s what makes Pianote different.</strong><br><br> 
                        At Pianote, we know the value of having access to a REAL piano teacher. <br><br>
                        That’s why you’ll get weekly live lessons as a Pianote member. <br><br>
                        Improve your technique, boost your theory knowledge, or just get an answer to that burning question. <br><br>
                        There’s no limit. You can attend as many as you like.
                    </p>
                    <a class="anchor-slide join w-full sm:max-w-[440px] bg-pianote mx-auto md:mx-0" href="#final">GET STARTED</a>
                </div>
                <div class="w-full sm:w-1/2 md:w-7/12 flex items-end mx-auto">
                    <img src="https://d21q7xesnoiieh.cloudfront.net/fit-in/900x0/filters:quality(95)/marketing/pianote/products/classical-piano-collection/kevin-lisa-live.png" alt="Kevin and Lisa" class="object-cover">
                </div>
            </div>
        </div>
    </section>

    @php
        $testimonials = $pianote['testimonials'];
        $youtube = number_format(Prices::$pianoteYoutubeSubsc);
        $facebook = number_format(Prices::$pianoteFacebookLikes);
        $instagram = number_format(Prices::$pianoteInstagramFollowers);
    @endphp
    @include('musora.sales.components.testimonials-section-members', [
        'header' => 'Join The Best Online Piano Community',
        'bgSplide' => '#f61a30',
        'bgColor' => 'linear-gradient(to bottom, #FFFFFF 20%, #F4F0EB 80%);',
        'youtubeLink' => 'https://www.youtube.com/pianolessonscom/',
        'facebookLink' => 'https://facebook.com/pianoteofficial/',
        'instagramLink' => 'https://instagram.com/pianoteofficial/',
    ])
    @include('musora.sales.components.guarantee-section', [
        'badge' => 'marketing/pianote/membership/homepage/webp-format/piano-guarantee.webp',
        'header' => '<strong>Test-drive your lessons for 90 days.</strong><br> Zero risk.',
        'desc' => 'Online lessons can be intimidating. Maybe you’re wondering if they work, or if you’ll use them enough – or if you’ll even enjoy the experience. So we’re removing the risk with our 90-day guarantee. More than anything, we want to make sure you have a POSITIVE experience developing new skills and gaining confidence on the piano.',
    ])
  
  

    @php
    
        $bonuses = [
            [
                'image' => 'https://d21q7xesnoiieh.cloudfront.net/fit-in/1000x0/filters:quality(95)/marketing/pianote/promos/may/annual.png',
                'description' => "Level up your skills with Pianote - the world's best lessons, teachers, and practice tools trusted by thousands of active students.",
                'customText' => '$240',
            ],
            [
                'image' => 'https://d21q7xesnoiieh.cloudfront.net/fit-in/1000x0/filters:quality(95)//marketing/pianote/products/classical-piano-collection/membership/classical-piano-collection-card.webp',
                'description' => 'Play The Most Beautiful Piano Music In The World With Step-By-Step Tutorials.',
                'price' => floatval($productPrices['classical-piano-collection']->price),
                'shipping' => true,
            ],
            [
                'image' => 'https://d21q7xesnoiieh.cloudfront.net/fit-in/1000x0/filters:quality(95)/marketing/pianote/products/classical-piano-collection/metronome-card.jpg',
                'description' => 'The Pianote Metronome will help you keep perfect time -- every time.',
                'price' => floatval($productPrices['taktell-piccolo-metronome']->price),
                'shipping' => true,
            ],
            [
                'image' => 'https://d21q7xesnoiieh.cloudfront.net/fit-in/1000x0/filters:quality(95)/marketing/pianote/products/classical-piano-collection/membership/classical-piano-pieces-card.webp',
                'description' => 'In this book, you’ll find 20 of the most beautiful classical piano pieces ever written.',
                'price' => floatval($productPrices['classical-piano-pieces']->price),
                'shipping' => true,
            ]
        ];
    @endphp

<div style="background: linear-gradient(0deg, #FFF, #F4F0EB);">
    <section class="py-14 sm:py-24 lg:py-32 relative overflow-hidden text-center customize px-4 lg:px-6" id="final">
        <div class="container mx-auto relative z-50 max-w-4xl">
            <img class="h-8 sm:h-10 mb-3 sm:mb-4" src="https://d21q7xesnoiieh.cloudfront.net/fit-in/250x0/filters:quality(95)/marketing/pianote/membership/homepage/2023/pianote-logo-red.png">
            <br>
            <h1 class="relative w-auto inline-block text-3xl sm:text-5xl lg:text-6xl mb-7 sm:mb-4 leading-none sm:leading-none lg:leading-none uppercase">
                START PLAYING BEAUTIFUL<br>
                PIANO <strong class="relative inline-block">IN JUST 10 MINUTES</strong>
                <svg class="absolute left-10 md:left-24 right-0 bottom-0 w-full h-3 sm:h-4 md:h-5 lg:h-6" xmlns="http://www.w3.org/2000/svg" width="100%" height="100%" viewBox="0 0 524 22" fill="none" style="transform: translate(0, 70%);">
                    <path d="M1.99978 10.6328C84.053 4.08508 302.889 -3.20824 521.809 20" stroke="#F61A30" stroke-width="3" stroke-linecap="round"></path>
                    <path d="M2.17373 15.0541C83.9528 7.29382 302.406 -3.51921 521.988 15.3111" stroke="#F61A30" stroke-width="3" stroke-linecap="round"></path>
                </svg>
            </h1>
            <h4 class="mb-8 mt-2 md:mt-4 tracking-normal leading-normal hidden md:block">Join Pianote and get unlimited lessons, personal support, and 3 FREE bonuses.</h4>
            <p class="text-sm leading-normal sm:tracking-widest mb-5 lg:mb-7">
                <i class="fas fa-check text-pianote"></i> Step-by-step lessons
                <i class="fas fa-check lg:ml-5 text-pianote"></i> Practice with <strong>real</strong> teachers
                <br class="sm:hidden">
                <i class="fas fa-check lg:ml-5 text-pianote"></i> Personal support 
                <i class="fas fa-check ml-3 sm:ml-5 text-pianote"></i> Popular Songs
            </p>

            <div style="font-size:0px">
                @foreach($bonuses as $bonus)
                    <div class="bonus-wrap relative inline-block align-top mx-auto mb-4 px-1 md:px-3 @if(!empty($bonusWidth)) {{ $bonusWidth }} @else w-1/2 md:w-1/4 @endif" x-data="{ flipped: false }" x-on:click="flipped = !flipped; if(flipped){ $refs.front.classList.add('rotate-y-180'); $refs.back.classList.remove('-rotate-y-180'); $refs.back.classList.add('rotate-y-0'); } else { $refs.front.classList.remove('rotate-y-180'); $refs.back.classList.add('-rotate-y-180'); $refs.back.classList.remove('rotate-y-0'); }">
                        <div class="flip-div inline-block relative w-full group" style="@if(empty($bonus['bigCard'])) padding-bottom: 133%; @else padding-bottom: 103%; @endif perspective: 1000px;">
                            <div class="text-center w-full h-full absolute cursor-pointer" style="transform-style: preserve-3d;">
                                <div x-ref="front" class="border-2 border-pianote front absolute z-20 overflow-hidden rounded-xl w-full h-full transition-transform duration-700" style="@if(!empty($bonus['special'])) overflow: visible;border-color: #cda880; @endif backface-visibility: hidden;">
                                    @if(!empty($bonus['badge']))
                                        <h6 class="absolute text-white top-0 left-0 w-full py-0.5 bg-{{ $theme }} font-bebas uppercase">{{ $bonus['badge'] }}</h6>
                                    @endif
                                    <div class="overflow-hidden h-full w-full bg-black bg-top bg-cover" :class="{'opacity-0': !lazyLoad, 'opacity-100': lazyLoad}" x-intersect.once="lazyLoad = true">
                                        <picture class="absolute inset-0 w-full h-full object-cover">
                                            <img src="{{ $bonus['image'] }}" alt="Bonus Image" class="w-full h-full object-cover opacity-0 transition-opacity" loading="lazy" onload="this.classList.remove('opacity-0')">
                                        </picture>
                                    </div>
                                    <div class="absolute z-40 text-center top-1/2 left-1/2 text-white transition-opacity duration-300 transform -translate-x-1/2 -translate-y-1/2 visible opacity-0 group-hover:opacity-100 text-shadow-2">
                                        <i class="fas fa-arrow-right text-4xl"></i><br>
                                        <p class="text-sm"><strong>DETAILS</strong></p>
                                    </div>
                                </div>
                                <div x-ref="back" class="back border-2 border-pianote absolute z-40 overflow-hidden rounded-xl w-full h-full transition-transform duration-700 -rotate-y-180" style="backface-visibility: hidden;">
                                    <div class="w-full h-full mx-auto text-center text-white flex flex-wrap justify-center items-center content-center p-2 md:p-3" style="background:linear-gradient(to bottom, #01050f, #021225);">
                                        <p class="leading-normal mx-auto text-sm">{!! $bonus['description'] !!}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <p class="w-full leading-normal mt-2">
                            <span style="display:inline-block;">
                                @if(!empty($bonus['price']))
                                    <s class="opacity-40">${{ $bonus['price'] }}</s>
                                @endif
                                @if(!empty($bonus['customText']))
                                    <strong class="text-pianote">{{ $bonus['customText'] }}</strong>
                                @else
                                    <strong class="text-pianote">FREE</strong>
                                @endif
                            </span>
                        </p>
                    </div>
                @endforeach
            </div>

            <h3 class="text-3xl w-full leading-normal mt-10 mb-4"><strong>
                <s class="text-black opacity-40">${{ (floatval($originalPrice)) }}</s>
                <span class="text-black">${{ (floatval($discountedPrice)) }}</strong>/yr</span>
            </h3>
            <a class="anchor-slide join w-11/12 sm:max-w-[440px] bg-pianote" href="{{ $buttonLink }}">GET STARTED</a>
            <br>

            <div class="container mx-auto max-w-xl text-black opacity-50 pt-4 lg:pt-6 leading-none">
                <p class="text-xs">If VAT or Customs is an issue, you can choose not to receive any physical bonuses.</p>
                <a class="underline cursor-pointer text-xs" href="{{ $buttonLink2 }}">Click here to choose that option.</a>
            </div>
        </div>
    </section>
</div>

    @include('_partials.components.video-modal',[
        'name' => 'demoVid',
        'video' => '998782491',
        'vimeo' => true,
    ])
    @include('_partials.components.video-modal',[
        'name' => 'stepTwo',
        'video' => '802011057',
        'vimeo' => true,
    ])
     @include('_partials.components.video-modal', [
        'name' => 'trailer',
        'video' => '928599834',
        'vimeo' => true,
    ])

        @include("pianote.sales.partials._footer")

    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script type="text/javascript" src="{{ asset('/marketing/parcel/drumeo/navigation-sales.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/@splidejs/splide@4.1.4/dist/js/splide.min.js"></script>
@endsection
