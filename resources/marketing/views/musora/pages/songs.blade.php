@php
    require_once(resource_path('marketing/views/musora/pages/songs-data.php'))
@endphp

@extends('musora._partials._features-layout')

@section('head-includes')
    <title></title>
    <meta property="og:title" content="TODO">

    <meta name="description" content="TODO">
    <meta property="og:description" content="TODO">

    <meta property="og:url" content="https://www.musora.com/songs">
    <meta property="og:image" content="TODO">

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
            display: inline-block;
            letter-spacing: 0.1em;
            text-transform: uppercase;
            border-radius: 50px;
            color: #FFF;
            outline: none;
            cursor: pointer;
            text-align: center;
            user-select: none;
            text-decoration: none;
            transition: background-color .3s, color .3s, opacity .3s;
            box-shadow: 0 0 0 hsla(0, 0%, 0%, 0.35);
            font-weight: 500;
        }

        .join.smaller {
            padding: 10px 30px 6px;
            font-size: 16px;
            background-color: black;
        }
        @media (min-width: 768px) {
            .join.smaller {
                font-size: 18px;
                padding: 12px 30px 10px;
            }
        }

        .text-musora {
            color: black;
            -webkit-text-fill-color: black !important;
        }

        .bg-musora {
            background:black !important;
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
            <source media="(min-width: 500px)" srcset="https://www.musora.com/musora-cdn/image/width=900,quality=85/https://dmmior4id2ysr.cloudfront.net/songs/drumeo-thumb.jpg">
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
            <source media="(min-width: 500px)" srcset="https://www.musora.com/musora-cdn/image/width=900,quality=85/https://dmmior4id2ysr.cloudfront.net/songs/pianote-thumb.jpg">
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
            <source media="(min-width: 500px)" srcset="https://www.musora.com/musora-cdn/image/width=900,quality=85/https://dmmior4id2ysr.cloudfront.net/songs/guitareo-thumb.jpg">
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
            <source media="(min-width: 500px)" srcset="https://www.musora.com/musora-cdn/image/width=900,quality=85/https://dmmior4id2ysr.cloudfront.net/songs/singeo-thumb.jpg">
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
            src="https://www.musora.com/musora-cdn/image/width=900,quality=85/https://dmmior4id2ysr.cloudfront.net/songs/drumeo-thumb.jpg"
            alt="drumeo thumb"
            fetchpriority="high"
            @click="drumeoSoundslice = true"
        />
    </div>
    <div x-show="brand === 'pianote'">
        <img
            x-cloak
            class="md:hidden mb-2"
            src="https://www.musora.com/musora-cdn/image/width=900,quality=85/https://dmmior4id2ysr.cloudfront.net/songs/pianote-thumb.jpg"
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
            src="https://www.musora.com/musora-cdn/image/width=900,quality=85/https://dmmior4id2ysr.cloudfront.net/songs/guitareo-thumb.jpg"
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
            src="https://www.musora.com/musora-cdn/image/width=900,quality=85/https://dmmior4id2ysr.cloudfront.net/songs/singeo-thumb.jpg"
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
        'video' => 'TODO',
        'soundslice' => true,
    ])

    @include('_partials.components.video-modal',[
        'name' => 'pianoteSoundslice',
        'video' => 'TODO',
        'soundslice' => true,
    ])

    @include('_partials.components.video-modal',[
        'name' => 'guitareoSoundslice',
        'video' => 'TODO',
        'soundslice' => true,
    ])

    @include('_partials.components.video-modal',[
        'name' => 'singeoSoundslice',
        'video' => 'TODO',
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
                                        src="https://www.musora.com/musora-cdn/image/width=250,quality=85/{{$slide['img']}}"
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
                                        src="https://www.musora.com/musora-cdn/image/width=250,quality=85/{{$slide['img']}}"
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
                                        src="https://www.musora.com/musora-cdn/image/width=250,quality=85/{{$slide['img']}}"
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
                                        src="https://www.musora.com/musora-cdn/image/width=250,quality=85/{{$slide['img']}}"
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
                                        src="https://www.musora.com/musora-cdn/image/width=250,quality=85/{{$slide['img']}}"
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
                                        src="https://www.musora.com/musora-cdn/image/width=250,quality=85/{{$slide['img']}}"
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
                                        src="https://www.musora.com/musora-cdn/image/width=250,quality=85/{{$slide['img']}}"
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
{{--                                        src="https://www.musora.com/musora-cdn/image/width=250,quality=85/{{$slide['img']}}"--}}
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
{{--                                        src="https://www.musora.com/musora-cdn/image/width=250,quality=85/{{$slide['img']}}"--}}
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
                                        src="https://www.musora.com/musora-cdn/image/width=250,quality=85/{{$slide['img']}}"
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
            <a href="/TODO" class="mx-1 join blue smaller font-bebas">Get started <i class="fas fa-arrow-right" style="line-height: 0;"></i> </a>
        </div>
    </section>

    @include('musora.sales.components.guarantee-section', [
        'badge' => 'https://dmmior4id2ysr.cloudfront.net/logos/guarantee+1.png',
        'header' => '<strong>Happy student guarantee.</strong><br>Test-drive your lessons for 90 days. Zero risk.',
        'desc' => 'Online lessons can be intimidating. Maybe you’re wondering if they work, or if you’ll use them enough – or if you’ll even enjoy the experience. So we’re removing the risk with our 90-day guarantee. More than anything, we want to make sure you have a POSITIVE experience developing new skills and gaining confidence on the drums.',
    ])

    @include('musora.sales.components.card-selection-section', [
            "plusLogo" => "https://dpwjbsxqtam5n.cloudfront.net/sales/2023/drumeoplus_logo.svg",
            "logo" => "https://d38h3dn806jqj1.cloudfront.net/logos/musora-white.svg",
            "songs" => "5000",
            "firstPoint" => "The world’s best drum lessons.",
            "thirdPoint" => "Unlimited personal support.",
            "fifthPoint" => "Lesson access for piano, guitar, and singing.",
            "plusAnnualLink" => "/ecommerce/add-to-cart?products[DLM-Trial-Annual-7-Day]=1&locked=true",
            "plusMonthlyLink" => "/ecommerce/add-to-cart?products[DLM-Trial-1-month]=1&locked=true",
            "annualLink" => "/ecommerce/add-to-cart?products[drumeo-base-annual-recurring-7-day-trial-membership]=1&locked=true",
            "monthlyLink" => "/ecommerce/add-to-cart?products[drumeo-base-monthly-recurring-7-day-trial-membership]=1&locked=true",
        ])


    @include('musora.sales.components.app-section', [
        'image' => 'https://dpwjbsxqtam5n.cloudfront.net/sales/2023/devices.png',
        'appleUrl' => 'https://apps.apple.com/us/app/musora/id1619053766?platform=iphone&ppid=d63c2cf3-274f-4441-8444-a5f547b1b4b6',
        'googleUrl' => 'https://play.google.com/store/apps/details?id=com.musoraapp&listing=drumeo_previews',
    ])

    @php
        $faqs = [
            [
            "title" => "What is Drumeo?",
            "desc" => 'Drumeo is an online platform that offers an organized drum curriculum, artist courses on popular topics, 5000+ songs transcribed note-for-note, and a supportive global community of students and teachers. ',
            ],
            [
            "title" => "Is Drumeo good for beginners?",
            "desc" => 'Yes! You’ll always know what to practice with step-by-step video lessons – plus have fun applying your new skills to your favorite songs, sorted by skill level. And if you ever need help, you’ll have unlimited personal support through live Q&A sessions, student reviews, and a helpful community. ',
            ],
            [
            "title" => "Does Drumeo have anything for advanced drummers?",
            "desc" => 'Drumeo is the perfect companion for advanced drummers, giving you access to artist courses so you can gain insights and inspiration from the legends – with 200+ artist courses on a variety of topics. Plus, you’ll get note-for-note transcriptions for thousands of songs and practical playback tools, so you can take on any new challenge with confidence. ',
            ],
            [
            "title" => "Am I too old to learn the drums?",
            "desc" => 'You’re never too old to learn the drums. Drumeo has a community of students of all ages, from all around the world. Whether you’re 40, 50, 60, 70, or beyond – you’ll connect with drummers just like you who are learning and applying their skills to music. ',
            ],
            [
            "title" => "Do I need to be tech-savvy to learn through your app?",
            "desc" => 'Not at all! Technology is here to make your life easier, and Drumeo is designed to help you find lessons and songs easily. And if you ever get stuck, you can contact our Student Experience team by phone or email for prompt and helpful support. ',
            ],
        ]
    @endphp

    <section class="py-12 md:py-20">
        <div class="container mx-auto max-w-5xl px-6">
            <h2 class="font-extrabold mb-10 text-center">Frequently Asked Questions</h2>
            @foreach($faqs as $faq)
                @include('_partials.components.question-dropdown', [
                    'num' => '?',
                    "title" => $faq['title'],
                    "desc" => $faq['desc'],
                ])
            @endforeach
        </div>
    </section>

@endsection


