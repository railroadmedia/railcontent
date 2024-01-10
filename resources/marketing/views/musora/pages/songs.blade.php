@php
    require_once(resource_path('marketing/views/musora/pages/songs-data.php'))
@endphp

@extends('musora._partials._features-layout')

@section('head-includes')
    <title>Musora | Musicians start here. </title>
    <meta property="og:title" content="Musora | Musicians start here. ">

    <meta name="description" content="Learn your favorite instruments with step-by-step lessons, thousands of songs, and unlimited personal support. ">
    <meta property="og:description" content="Learn your favorite instruments with step-by-step lessons, thousands of songs, and unlimited personal support. ">

    <meta property="og:url" content="https://www.musora.com/{{ Request::path() }}">
    <meta property="og:image" content="https://dmmior4id2ysr.cloudfront.net/homepage/2023/share-image3.jpg">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@splidejs/splide@4.0.7/dist/css/splide.min.css">
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

        .option-buttons.active {
            border-color:white!important;
            background:linear-gradient(74.88deg, rgba(0, 201, 172, 0.25) 1.72%, rgba(11, 118, 219, 0.25) 35.86%, rgba(131, 0, 233, 0.25) 69.01%, rgba(236, 3, 56, 0.25) 100%) !important;
        }
        .option-buttons.active .radio-check {
            border-color:white!important;
            background:linear-gradient(74.88deg, rgba(0, 201, 172, 0.25) 1.72%, rgba(11, 118, 219, 0.25) 35.86%, rgba(131, 0, 233, 0.25) 69.01%, rgba(236, 3, 56, 0.25) 100%) !important;
        }
        .option-buttons.active .radio-check i {
            display:block!important;
        }

        .join {
            display:inline-block;
            font:500 22px/1em 'Bebas Neue', sans-serif;
            letter-spacing:0.1em;
            text-transform:uppercase;
            background:#0c1524;
            border-radius:50px;
            color:#fff;
            padding:17px 7%;
            outline:none;
            cursor:pointer;
            text-align:center;
            user-select:none;
            text-decoration:none;
            transition:background-color 0.3s, color 0.3s, opacity 0.3s;
            box-shadow:0 0 0 rgba(0, 0, 0, 0.35);
        }

        @media (min-width:768px) {
            .join {
                font-size:30px;
            }
        }

        .join:hover, .join:focus {
            color:#fff;
            background:#14233d;
            box-shadow:0 0 7px rgba(0, 0, 0, 0.35);
        }
        .join i {
            transition:all .3s;
            position:relative;
            right:0px;
        }
        .join:hover i {
            right:-3px;
        }

        .join.white {
            background:#fff;
            color:#000;
        }

        .join.white:hover, .join.white:focus {
            background:#eee;
        }

        .join.smaller {
            padding:8px 30px;
            font-size:16px;
        }

        @media (min-width:768px) {
            .join.smaller {
                font-size:18px;
                padding:11px 30px;
            }
        }

        .join.smaller.outline {
            padding:8px 28px 6px;
            font-size:16px;
        }

        @media (min-width:768px) {
            .join.smaller.outline {
                font-size:18px;
                padding:10px 28px 8px;
            }
        }

        .join.musora-gold {
            background-color:#FFAE00;
            color:#000;
        }

        .join.musora-gold:hover, .join.musora-gold:focus {
            background:#FFAE00;
            color:#000;
        }

        .join.outline {
            background:transparent;
            outline-style:none !important;
            border:1px solid #fff;
            color:#fff;
            padding:6px 12px;
        }

        @media (min-width:768px) {
            .join.outline {
                border-width:2px;
                padding:11px 30px;
            }
        }

        .join.outline:hover, .join.outline:focus {
            background:#fff;
            color:#000;
        }

        .join.outline.black {
            border-color:#000;
            color:#000;
        }
        .join.outline.black:hover, .join.outline.black:focus {
            background:#000;
            color:#fff;
        }
        .join.outline.musora {
            border-color:#0c1524;
            color:#0c1524;
        }

        .join.outline.musora:hover, .join.outline.musora:focus {
            background:#0c1524;
            color:#fff;
        }

        .text-musora-black {
            color:#0c1524;
        }

        .text-musora,
        .text-musora-gold {
            color:#FFAE00;
        }
    </style>
@endsection

@section('header-img')
    <div class="hidden md:block">
        <div class="w-[620px] px-4 text-center mb-2 mx-auto">
            <div
                class="inline-block text-xl py-0.5 px-10 rounded-full cursor-pointer mr-1"
                :class="brand === 'drumeo' ? 'text-white bg-drumeo' : 'text-drumeo border-drumeo border'"
                @click="brand = 'drumeo'"
            >
                <i class="fa-regular fa-drum"></i>
            </div>
            <div
                class="inline-block text-xl py-0.5 px-10 rounded-full cursor-pointer mr-1"
                :class="brand === 'pianote' ? 'text-white bg-pianote' : 'text-pianote border-pianote border'"
                @click="brand = 'pianote'"
            >
                <i class="fa-regular fa-piano-keyboard"></i>
            </div>
            <div
                class="inline-block text-xl py-0.5 px-10 rounded-full cursor-pointer mr-1"
                :class="brand === 'guitareo' ? 'text-white bg-guitareo' : 'text-guitareo border-guitareo border'"
                @click="brand = 'guitareo'"
            >
                <i class="fa-light fa-guitar"></i>
            </div>
            <div
                class="inline-block text-xl py-0.5 px-10 rounded-full cursor-pointer"
                :class="brand === 'singeo' ? 'text-white bg-singeo' : 'text-singeo border-singeo border'"
                @click="brand = 'singeo'"
            >
                <i class="fa-light fa-microphone-stand"></i>
            </div>
        </div>
        <picture x-show="brand === 'drumeo'" x-cloak>
            <source media="(min-width: 500px)" srcset="https://www.musora.com/musora-cdn/image/width=900,quality=95/https://dmmior4id2ysr.cloudfront.net/songs/drumeo-thumb.jpg">
            <img
                class="rounded-t-xl md:h-72 lg:h-80 cursor-pointer"
                src="https://dmmior4id2ysr.cloudfront.net/songs/drumeo-thumb.jpg"
                alt="drumeo thumb"
                x-on:click="soundslice = true"
                fetchpriority="high"
                @click="drumeoSoundslice = true"
            />
        </picture>
        <picture x-show="brand === 'pianote'" x-cloak>
            <source media="(min-width: 500px)" srcset="https://www.musora.com/musora-cdn/image/width=900,quality=95/https://dmmior4id2ysr.cloudfront.net/songs/pianote-thumb.jpg">
            <img
                class="rounded-t-xl md:h-72 lg:h-80 cursor-pointer"
                src="https://dmmior4id2ysr.cloudfront.net/songs/pianote-thumb.jpg"
                alt="pianote thumb"
                x-on:click="soundslice = true"
                fetchpriority="high"
                @click="pianoteSoundslice = true"
            />
        </picture>
        <picture x-show="brand === 'guitareo'" x-cloak>
            <source media="(min-width: 500px)" srcset="https://www.musora.com/musora-cdn/image/width=900,quality=95/https://dmmior4id2ysr.cloudfront.net/songs/guitareo-thumb.jpg">
            <img
                class="rounded-t-xl md:h-72 lg:h-80 cursor-pointer"
                src="https://dmmior4id2ysr.cloudfront.net/songs/guitareo-thumb.jpg"
                alt="guitareo thumb"
                x-on:click="soundslice = true"
                fetchpriority="high"
                @click="guitareoSoundslice = true"
            />
        </picture>
        <picture x-show="brand === 'singeo'" x-cloak>
            <source media="(min-width: 500px)" srcset="https://www.musora.com/musora-cdn/image/width=900,quality=95/https://dmmior4id2ysr.cloudfront.net/songs/singeo-thumb.jpg">
            <img
                class="rounded-t-xl md:h-72 lg:h-80 cursor-pointer"
                src="https://dmmior4id2ysr.cloudfront.net/songs/singeo-thumb.jpg"
                alt="singeo thumb"
                x-on:click="soundslice = true"
                fetchpriority="high"
                @click="singeoSoundslice = true"
            />
        </picture>
    </div>
@endsection

@section('header-mobileImg')
    <div x-show="brand === 'drumeo'">
        <img
            x-cloak
            class="md:hidden mb-2"
            src="https://www.musora.com/musora-cdn/image/width=900,quality=95/https://dmmior4id2ysr.cloudfront.net/songs/drumeo-thumb.jpg"
            alt="drumeo thumb"
            fetchpriority="high"
            @click="drumeoSoundslice = true"
        />
    </div>
    <div x-show="brand === 'pianote'">
        <img
            x-cloak
            class="md:hidden mb-2"
            src="https://www.musora.com/musora-cdn/image/width=900,quality=95/https://dmmior4id2ysr.cloudfront.net/songs/pianote-thumb.jpg"
            alt="pianote thumb"
            fetchpriority="high"
            @click="pianoteSoundslice = true"
        />
    </div>
    <div x-show="brand === 'guitareo'">
        <img
            x-cloak
            x-show="brand === 'guitareo'"
            class="md:hidden mb-2"
            src="https://www.musora.com/musora-cdn/image/width=900,quality=95/https://dmmior4id2ysr.cloudfront.net/songs/guitareo-thumb.jpg"
            alt="guitareo thumb"
            fetchpriority="high"
            @click="guitareoSoundslice = true"
        />
    </div>
    <div x-show="brand === 'singeo'">
        <img
            x-cloak
            x-show="brand === 'singeo'"
            class="md:hidden mb-2"
            src="https://www.musora.com/musora-cdn/image/width=900,quality=95/https://dmmior4id2ysr.cloudfront.net/songs/singeo-thumb.jpg"
            alt="singeo thumb"
            fetchpriority="high"
            @click="singeoSoundslice = true"
        />
    </div>

    <div class="text-center mb-16 mx-auto md:hidden">
        <div
            class="inline-block text-lg py-0.5 px-6 sm:px-10 rounded-full cursor-pointer mr-0.5"
            :class="brand === 'drumeo' ? 'text-white bg-drumeo' : 'text-drumeo border-drumeo border'"
            @click="brand = 'drumeo'"
        >
            <i class="fa-regular fa-drum"></i>
        </div>
        <div
            class="inline-block text-lg py-0.5 px-6 sm:px-10 rounded-full cursor-pointer mr-0.5"
            :class="brand === 'pianote' ? 'text-white bg-pianote' : 'text-pianote border-pianote border'"
            @click="brand = 'pianote'"
        >
            <i class="fa-regular fa-piano-keyboard"></i>
        </div>
        <div
            class="inline-block text-lg py-0.5 px-6 sm:px-10 rounded-full cursor-pointer mr-0.5"
            :class="brand === 'guitareo' ? 'text-white bg-guitareo' : 'text-guitareo border-guitareo border'"
            @click="brand = 'guitareo'"
        >
            <i class="fa-light fa-guitar"></i>
        </div>
        <div
            class="inline-block text-lg py-0.5 px-6 sm:px-10 rounded-full cursor-pointer"
            :class="brand === 'singeo' ? 'text-white bg-singeo' : 'text-singeo border-singeo border'"
            @click="brand = 'singeo'"
        >
            <i class="fa-light fa-microphone-stand"></i>
        </div>
    </div>

    @include('_partials.components.video-modal',[
        'name' => 'drumeoSoundslice',
        'video' => '1D6Vc',
        'soundslice' => true,
    ])

    @include('_partials.components.video-modal',[
        'name' => 'pianoteSoundslice',
        'video' => '77f4c',
        'soundslice' => true,
    ])

    @include('_partials.components.video-modal',[
        'name' => 'guitareoSoundslice',
        'video' => 'Mnmkc',
        'soundslice' => true,
    ])

    @include('_partials.components.video-modal',[
        'name' => 'singeoSoundslice',
        'video' => 'ZsC4c',
        'soundslice' => true,
    ])
@endsection

@section('header', 'Play your favorite songs.')

@section('desc', 'Get 1000+ note-for-note song breakdowns for every style, era, and skill with handy play-along tools.')

<!-- Main -->
@section('page-body')
    <section class="pt-10 md:pt-12 pb-24 md:pb-32">
        <h3 class="text-center leading-tight mb-5"><strong>More than a bouncing ball.</strong></h3>
        <p class="text-center max-w-2xl mx-auto">
            Learn to actually play the songs and genres you love by looping the tricky parts, slowing down the tempo and isolating your instrument.
        </p>
        <div class="container max-w-6xl lg:ml-auto lg:mr-0 xl:mx-auto px-6 xl:px-0">
            <div class="mb-6">
                <h4 class="font-extrabold mb-4">Classic Rock</h4>
                @component('_partials.components.carousel',[
                    'xdata' => "
                        classes: {
                            arrow: 'splide__arrow bg-white opacity-100 top-[38%] shadow-lg h-11 w-11',
                            prev: 'hidden',
                            next: 'splide__arrow--next your-class-next hidden sm:flex z-50 -right-1',
                            pagination: 'hidden',
                        },
                        perPage: 6.5,
                        perMove: 1,
                        type: 'loop',
                        interval: 2000,
                        breakpoints: {
                            1160: {
                                perPage: 5.5,
                            },
                            900: {
                                perPage: 4.5,
                            },
                            760: {
                                perPage: 3.5,
                                drag   : 'free',
                                snap   : false,
                            },
                            590: {
                                perPage: 2.5,
                            },
                        },
                    ",
                ])
                    @slot('content')
                        @foreach ($classicRock as $slide)
                            <li class="splide__slide px-1">
                                <div>
                                    <img
                                        class="rounded-xl mb-1"
                                        src="https://www.musora.com/musora-cdn/image/width=340,quality=95/{{$slide['img']}}"
                                        alt="{{$slide['title']}} img"
                                        fetchpriority="high"
                                    >
                                    <p class="font-bold mb-1 leading-tight">{{$slide['title']}}</p>
                                    <p class="text-[#838C98] leading-tight">{{$slide['artist']}}</p>
                                </div>
                            </li>
                        @endforeach
                    @endslot
                @endcomponent
            </div>

            <div class="mb-6">
                <h4 class="font-extrabold mb-4">Pop Classics</h4>
                @component('_partials.components.carousel',[
                    'xdata' => "
                        classes: {
                            arrow: 'splide__arrow bg-white opacity-100 top-[38%] shadow-lg h-11 w-11',
                            prev: 'hidden',
                            next: 'splide__arrow--next your-class-next hidden sm:flex z-50 -right-1',
                            pagination: 'hidden',
                        },
                        perPage: 6.5,
                        perMove: 1,
                        type: 'loop',
                        interval: 2000,
                        breakpoints: {
                            1160: {
                                perPage: 5.5,
                            },
                            900: {
                                perPage: 4.5,
                            },
                            760: {
                                perPage: 3.5,
                                drag   : 'free',
                                snap   : false,
                            },
                            590: {
                                perPage: 2.5,
                            },
                        },
                    ",
                ])
                    @slot('content')
                        @foreach ($popClassics as $slide)
                            <li class="splide__slide px-1">
                                <div>
                                    <img
                                        class="rounded-xl mb-1"
                                        src="https://www.musora.com/musora-cdn/image/width=340,quality=95/{{$slide['img']}}"
                                        alt="{{$slide['title']}} img"
                                        fetchpriority="high"
                                    >
                                    <p class="font-bold mb-1 leading-tight">{{$slide['title']}}</p>
                                    <p class="text-[#838C98] leading-tight">{{$slide['artist']}}</p>
                                </div>
                            </li>
                        @endforeach
                    @endslot
                @endcomponent
            </div>
            <div class="mb-6">
                <h4 class="font-extrabold mb-4">Modern Rock</h4>
                @component('_partials.components.carousel',[
                    'xdata' => "
                        classes: {
                            arrow: 'splide__arrow bg-white opacity-100 top-[38%] shadow-lg h-11 w-11',
                            prev: 'hidden',
                            next: 'splide__arrow--next your-class-next hidden sm:flex z-50 -right-1',
                            pagination: 'hidden',
                        },
                        perPage: 6.5,
                        perMove: 1,
                        type: 'loop',
                        interval: 2000,
                        breakpoints: {
                            1160: {
                                perPage: 5.5,
                            },
                            900: {
                                perPage: 4.5,
                            },
                            760: {
                                perPage: 3.5,
                                drag   : 'free',
                                snap   : false,
                            },
                            590: {
                                perPage: 2.5,
                            },
                        },
                    ",
                ])
                    @slot('content')
                        @foreach ($modernRock as $slide)
                            <li class="splide__slide px-1">
                                <div>
                                    <img
                                        class="rounded-xl mb-1"
                                        src="https://www.musora.com/musora-cdn/image/width=340,quality=95/{{$slide['img']}}"
                                        alt="{{$slide['title']}} img"
                                        fetchpriority="high"
                                    >
                                    <p class="font-bold mb-1 leading-tight">{{$slide['title']}}</p>
                                    <p class="text-[#838C98] leading-tight">{{$slide['artist']}}</p>
                                </div>
                            </li>
                        @endforeach
                    @endslot
                @endcomponent
            </div>
            <div class="mb-6">
                <h4 class="font-extrabold mb-4">Jazz</h4>
                @component('_partials.components.carousel',[
                    'xdata' => "
                        classes: {
                            arrow: 'splide__arrow bg-white opacity-100 top-[38%] shadow-lg h-11 w-11',
                            prev: 'hidden',
                            next: 'splide__arrow--next your-class-next hidden sm:flex z-50 -right-1',
                            pagination: 'hidden',
                        },
                        perPage: 6.5,
                        perMove: 1,
                        type: 'loop',
                        interval: 2000,
                        breakpoints: {
                            1160: {
                                perPage: 5.5,
                            },
                            900: {
                                perPage: 4.5,
                            },
                            760: {
                                perPage: 3.5,
                                drag   : 'free',
                                snap   : false,
                            },
                            590: {
                                perPage: 2.5,
                            },
                        },
                    ",
                ])
                    @slot('content')
                        @foreach ($jazz as $slide)
                            <li class="splide__slide px-1">
                                <div>
                                    <img
                                        class="rounded-xl mb-1"
                                        src="https://www.musora.com/musora-cdn/image/width=340,quality=95/{{$slide['img']}}"
                                        alt="{{$slide['title']}} img"
                                        fetchpriority="high"
                                    >
                                    <p class="font-bold mb-1 leading-tight">{{$slide['title']}}</p>
                                    <p class="text-[#838C98] leading-tight">{{$slide['artist']}}</p>
                                </div>
                            </li>
                        @endforeach
                    @endslot
                @endcomponent
            </div>
            <div class="mb-6">
                <h4 class="font-extrabold mb-4">Metal</h4>
                @component('_partials.components.carousel',[
                    'xdata' => "
                        classes: {
                            arrow: 'splide__arrow bg-white opacity-100 top-[38%] shadow-lg h-11 w-11',
                            prev: 'hidden',
                            next: 'splide__arrow--next your-class-next hidden sm:flex z-50 -right-1',
                            pagination: 'hidden',
                        },
                        perPage: 6.5,
                        perMove: 1,
                        type: 'loop',
                        interval: 2000,
                        breakpoints: {
                            1160: {
                                perPage: 5.5,
                            },
                            900: {
                                perPage: 4.5,
                            },
                            760: {
                                perPage: 3.5,
                                drag   : 'free',
                                snap   : false,
                            },
                            590: {
                                perPage: 2.5,
                            },
                        },
                    ",
                ])
                    @slot('content')
                        @foreach ($metal as $slide)
                            <li class="splide__slide px-1">
                                <div>
                                    <img
                                        class="rounded-xl mb-1"
                                        src="https://www.musora.com/musora-cdn/image/width=340,quality=95/{{$slide['img']}}"
                                        alt="{{$slide['title']}} img"
                                        fetchpriority="high"
                                    >
                                    <p class="font-bold mb-1 leading-tight">{{$slide['title']}}</p>
                                    <p class="text-[#838C98] leading-tight">{{$slide['artist']}}</p>
                                </div>
                            </li>
                        @endforeach
                    @endslot
                @endcomponent
            </div>
            <div class="mb-6">
                <h4 class="font-extrabold mb-4">Modern Pop</h4>
                @component('_partials.components.carousel',[
                    'xdata' => "
                        classes: {
                            arrow: 'splide__arrow bg-white opacity-100 top-[38%] shadow-lg h-11 w-11',
                            prev: 'hidden',
                            next: 'splide__arrow--next your-class-next hidden sm:flex z-50 -right-1',
                            pagination: 'hidden',
                        },
                        perPage: 6.5,
                        perMove: 1,
                        type: 'loop',
                        interval: 2000,
                        breakpoints: {
                            1160: {
                                perPage: 5.5,
                            },
                            900: {
                                perPage: 4.5,
                            },
                            760: {
                                perPage: 3.5,
                                drag   : 'free',
                                snap   : false,
                            },
                            590: {
                                perPage: 2.5,
                            },
                        },
                    ",
                ])
                    @slot('content')
                        @foreach ($modernPop as $slide)
                            <li class="splide__slide px-1">
                                <div>
                                    <img
                                        class="rounded-xl mb-1"
                                        src="https://www.musora.com/musora-cdn/image/width=340,quality=95/{{$slide['img']}}"
                                        alt="{{$slide['title']}} img"
                                        fetchpriority="high"
                                    >
                                    <p class="font-bold mb-1 leading-tight">{{$slide['title']}}</p>
                                    <p class="text-[#838C98] leading-tight">{{$slide['artist']}}</p>
                                </div>
                            </li>
                        @endforeach
                    @endslot
                @endcomponent
            </div>
            <div class="mb-6">
                <h4 class="font-extrabold mb-4">Country</h4>
                @component('_partials.components.carousel',[
                    'xdata' => "
                        classes: {
                            arrow: 'splide__arrow bg-white opacity-100 top-[38%] shadow-lg h-11 w-11',
                            prev: 'hidden',
                            next: 'splide__arrow--next your-class-next hidden sm:flex z-50 -right-1',
                            pagination: 'hidden',
                        },
                        perPage: 6.5,
                        perMove: 1,
                        type: 'loop',
                        interval: 2000,
                        breakpoints: {
                            1160: {
                                perPage: 5.5,
                            },
                            900: {
                                perPage: 4.5,
                            },
                            760: {
                                perPage: 3.5,
                                drag   : 'free',
                                snap   : false,
                            },
                            590: {
                                perPage: 2.5,
                            },
                        },
                    ",
                ])
                    @slot('content')
                        @foreach ($country as $slide)
                            <li class="splide__slide px-1">
                                <div>
                                    <img
                                        class="rounded-xl mb-1"
                                        src="https://www.musora.com/musora-cdn/image/width=340,quality=95/{{$slide['img']}}"
                                        alt="{{$slide['title']}} img"
                                        fetchpriority="high"
                                    >
                                    <p class="font-bold mb-1 leading-tight">{{$slide['title']}}</p>
                                    <p class="text-[#838C98] leading-tight">{{$slide['artist']}}</p>
                                </div>
                            </li>
                        @endforeach
                    @endslot
                @endcomponent
            </div>
{{--            <div class="mb-6">--}}
{{--                <h4 class="font-extrabold mb-4">Musicals</h4>--}}
{{--                @component('_partials.components.carousel',[--}}
{{--                    'xdata' => "--}}
{{--                        classes: {--}}
{{--                            arrow: 'splide__arrow bg-white opacity-100 top-[38%] shadow-lg h-11 w-11',--}}
{{--                            prev: 'hidden',--}}
{{--                            next: 'splide__arrow--next your-class-next hidden sm:flex z-50 -right-1',--}}
{{--                            pagination: 'hidden',--}}
{{--                        },--}}
{{--                        perPage: 6.5,--}}
{{--                        perMove: 1,--}}
{{--                        type: 'loop',--}}
{{--                        interval: 2000,--}}
{{--                        breakpoints: {--}}
{{--                            1160: {--}}
{{--                                perPage: 5.5,--}}
{{--                            },--}}
{{--                            900: {--}}
{{--                                perPage: 4.5,--}}
{{--                            },--}}
{{--                            760: {--}}
{{--                                perPage: 3.5,--}}
{{--                            },--}}
{{--                            590: {--}}
{{--                                perPage: 2.5,--}}
{{--                            },--}}
{{--                        },--}}
{{--                    ",--}}
{{--                ])--}}
{{--                    @slot('content')--}}
{{--                        @foreach ($musicals as $slide)--}}
{{--                            <li class="splide__slide px-1">--}}
{{--                                <div>--}}
{{--                                    <img--}}
{{--                                        class="rounded-xl mb-1"--}}
{{--                                        src="https://www.musora.com/musora-cdn/image/width=250,quality=95/{{$slide['img']}}"--}}
{{--                                        alt="{{$slide['title']}} img"--}}
{{--                                        fetchpriority="high"--}}
{{--                                    >--}}
{{--                                    <p class="font-bold mb-1 leading-tight">{{$slide['title']}}</p>--}}
{{--                                    <p class="text-[#838C98] leading-tight">{{$slide['artist']}}</p>--}}
{{--                                </div>--}}
{{--                            </li>--}}
{{--                        @endforeach--}}
{{--                    @endslot--}}
{{--                @endcomponent--}}
{{--            </div>--}}
{{--            <div class="mb-6">--}}
{{--                <h4 class="font-extrabold mb-4">Worship</h4>--}}
{{--                @component('_partials.components.carousel',[--}}
{{--                    'xdata' => "--}}
{{--                        classes: {--}}
{{--                            arrow: 'splide__arrow bg-white opacity-100 top-[38%] shadow-lg h-11 w-11',--}}
{{--                            prev: 'hidden',--}}
{{--                            next: 'splide__arrow--next your-class-next hidden sm:flex z-50 -right-1',--}}
{{--                            pagination: 'hidden',--}}
{{--                        },--}}
{{--                        perPage: 6.5,--}}
{{--                        perMove: 1,--}}
{{--                        type: 'loop',--}}
{{--                        interval: 2000,--}}
{{--                        breakpoints: {--}}
{{--                            1160: {--}}
{{--                                perPage: 5.5,--}}
{{--                            },--}}
{{--                            900: {--}}
{{--                                perPage: 4.5,--}}
{{--                            },--}}
{{--                            760: {--}}
{{--                                perPage: 3.5,--}}
{{--                            },--}}
{{--                            590: {--}}
{{--                                perPage: 2.5,--}}
{{--                            },--}}
{{--                        },--}}
{{--                    ",--}}
{{--                ])--}}
{{--                    @slot('content')--}}
{{--                        @foreach ($worship as $slide)--}}
{{--                            <li class="splide__slide px-1">--}}
{{--                                <div>--}}
{{--                                    <img--}}
{{--                                        class="rounded-xl mb-1"--}}
{{--                                        src="https://www.musora.com/musora-cdn/image/width=250,quality=95/{{$slide['img']}}"--}}
{{--                                        alt="{{$slide['title']}} img"--}}
{{--                                        fetchpriority="high"--}}
{{--                                    >--}}
{{--                                    <p class="font-bold mb-1 leading-tight">{{$slide['title']}}</p>--}}
{{--                                    <p class="text-[#838C98] leading-tight">{{$slide['artist']}}</p>--}}
{{--                                </div>--}}
{{--                            </li>--}}
{{--                        @endforeach--}}
{{--                    @endslot--}}
{{--                @endcomponent--}}
{{--            </div>--}}
            <div class="mb-6">
                <h4 class="font-extrabold mb-4">Hip Hop & Rap</h4>
                @component('_partials.components.carousel',[
                    'xdata' => "
                        classes: {
                            arrow: 'splide__arrow bg-white opacity-100 top-[38%] shadow-lg h-11 w-11',
                            prev: 'hidden',
                            next: 'splide__arrow--next your-class-next hidden sm:flex z-50 -right-1',
                            pagination: 'hidden',
                        },
                        perPage: 6.5,
                        perMove: 1,
                        type: 'loop',
                        interval: 2000,
                        breakpoints: {
                            1160: {
                                perPage: 5.5,
                            },
                            900: {
                                perPage: 4.5,
                            },
                            760: {
                                perPage: 3.5,
                                drag   : 'free',
                                snap   : false,
                            },
                            590: {
                                perPage: 2.5,
                            },
                        },
                    ",
                ])
                    @slot('content')
                        @foreach ($hiphop as $slide)
                            <li class="splide__slide px-1">
                                <div>
                                    <img
                                        class="rounded-xl mb-1"
                                        src="https://www.musora.com/musora-cdn/image/width=340,quality=95/{{$slide['img']}}"
                                        alt="{{$slide['title']}} img"
                                        fetchpriority="high"
                                    >
                                    <p class="font-bold mb-1 leading-tight">{{$slide['title']}}</p>
                                    <p class="text-[#838C98] leading-tight">{{$slide['artist']}}</p>
                                </div>
                            </li>
                        @endforeach
                    @endslot
                @endcomponent
            </div>
        </div>

        <div class="text-center">
            <h3 class="font-extrabold mb-6">Plus thousands more popular songs.</h3>
            <a href="/choose-plan" class="mx-1 join blue smaller font-bebas">Get started <i class="fas fa-arrow-right" style="line-height: 0;"></i> </a>
        </div>
    </section>
    @include('musora.sales.components.order-section-collage', [
    'logo' => 'https://d21q7xesnoiieh.cloudfront.net/fit-in/210x0/filters:quality(95)/marketing/musora/membership/homepage/webp-format/musora_logo.webp',
    'header' => 'Unlimited music lessons.<br> The world’s best teachers.<br> Thousands of popular songs.',
    'list' => '<li class="leading-tight mb-3"><i class="fa-li fas fa-check text-musora"></i> Trusted by ' . number_format(Prices::$students) . ' students.</li>
    <li class="leading-tight mb-3"><i class="fa-li fas fa-check text-musora"></i> Personalized feedback from real teachers.</li>
    <li class="leading-tight text-musora max-w-xs mx-0"><i class="fa-li fas fa-check"></i> All-access for piano, guitar, drums, and singing.</li>',
    'image' => 'marketing/musora/membership/homepage/webp-format/musora-m-team2.webp',
    ])


    @include('musora.sales.components.app-section', [
        'image' => 'marketing/musora/membership/homepage/2023/devices2.png',
        'appleUrl' => 'https://apps.apple.com/us/app/musora/id1619053766?platform=iphone',
        'googleUrl' => 'https://play.google.com/store/apps/details?id=com.musoraapp',
    ])
    @include('musora._partials._faq')

@endsection


