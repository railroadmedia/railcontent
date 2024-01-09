@php
    require_once(resource_path('marketing/views/musora/pages/method-data.php'))
@endphp

@extends('musora._partials._features-layout')

@section('head-includes')
    <title>Musora - Your musical goals start here.</title>
    <meta property="og:title" content="Musora - Your musical goals start here.">

    <meta name="description" content="Always know exactly what to practice with structured video lessons and courses featuring many of the world’s best teachers.">
    <meta property="og:description" content="Always know exactly what to practice with structured video lessons and courses featuring many of the world’s best teachers.">

    <meta property="og:url" content="https://www.musora.com/{{ Request::path() }}">
    <meta property="og:image" content="https://dmmior4id2ysr.cloudfront.net/method/header-image.jpg">

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

@section('header-img', 'https://dmmior4id2ysr.cloudfront.net/method/header-image.jpg')

@section('header')
    Your musical goals<br class="sm:hidden"> start here.
@endsection

@section('desc')
    Always know exactly what to practice with structured video lessons<br class="hidden sm:inline"> and courses featuring many of the world’s best teachers.
@endsection

<!-- Main -->
@section('page-body')
    <section class="py-10 md:py-12">
        <h3 class="text-center leading-tight mb-5"><strong>Your clear, frustration-free way to <br>learn ANY instrument.</strong></h3>
        <p class="text-center max-w-2xl mx-auto">
            Whether you’re learning to play the piano, guitar, drums or to sing, you’ll never have to wonder where to go next. Our 10-level curriculum of step-by-step lessons is your clear, specific path to go from total beginner to playing all your favorite songs.
        </p>
        <div class="container max-w-6xl lg:ml-auto lg:mr-0 xl:mx-auto px-6 xl:px-0">
            <div class="mb-10">
                <div id="courses" class="anchor"></div>
                <h4 class="font-extrabold mb-4">Piano</h4>
                @component('_partials.components.carousel',[
                    'xdata' => "
                        classes: {
                            arrow: 'splide__arrow bg-white opacity-100 shadow-lg h-11 w-11 top-[38%]',
                            prev: 'hidden',
                            next: 'splide__arrow--next your-class-next hidden sm:flex z-50 -right-1',
                            pagination: 'hidden',
                        },
                        perPage: 3.5,
                        perMove: 1,
                        type: 'loop',
                        gap: '0.5rem',
                        interval: 2000,
                        breakpoints: {
                            900: {
                                perPage: 2.5,
                            },
                            700: {
                                perPage: 1.5,
                                drag   : 'free',
                                snap   : false,
                            },
                        },
                    ",
                ])
                    @slot('content')
                        @foreach ($pianoteMethod as $key => $method)
                            <li class="splide__slide my-2 flex">
                                <div class="bg-[#F6F8FC] rounded-xl" style="box-shadow: 5px 5px 5px rgba(0, 0, 0, 0.1);">
                                    <div class="relative" style="padding-bottom: 56.25%;">
                                        <img
                                            class="rounded-t-xl w-full absolute w-full h-full object-cover object-top"
                                            src="https://www.musora.com/musora-cdn/image/width=400,quality=95/{{$method['img']}}"
                                            alt="lesson{{$key+1}} img"
                                            fetchpriority="high"
                                        >
                                        <div class="absolute inset-0 rotate-180 rounded-b-xl" style="background:linear-gradient(180deg, #85001E 0%, rgba(0, 0, 0, 0.5) 100%);"></div>
                                        <div class="absolute inset-0 flex flex-col justify-center items-center text-white text-5xl font-extrabold">
                                            <div>
                                                <img class="h-4 -mr-2" src="https://dmmior4id2ysr.cloudfront.net/logos/pianote-logo-white.png" alt="pianote logo" /> <img class="h-4" src="https://dpwjbsxqtam5n.cloudfront.net/sales/2021/method-text.svg" alt="method logo" style="filter:brightness(0) invert(1)" />
                                            </div>
                                            LEVEL {{ $key+1 }}
                                        </div>
                                    </div>
                                    <div class="p-5">
                                        <p class="text-[#838C98] tracking-widest text-sm mb-1">LEVEL {{ $key + 1 }} - {{ $method['lessonNum'] }} LESSONS</p>
                                        <p class="font-bold mb-3 leading-tight">{{$method['title']}}</p>
                                        <p class="leading-snug">{!! $method['desc'] !!}</p>
                                    </div>
                                </div>
                            </li>
                        @endforeach
                    @endslot
                @endcomponent
            </div>
            <div class="mb-10">
                <h4 class="font-extrabold mb-4">Guitar</h4>
                @component('_partials.components.carousel',[
                    'xdata' => "
                        classes: {
                            arrow: 'splide__arrow bg-white opacity-100 shadow-lg h-11 w-11 top-[38%]',
                            prev: 'hidden',
                            next: 'splide__arrow--next your-class-next hidden sm:flex z-50 -right-1',
                            pagination: 'hidden',
                        },
                        perPage: 3.5,
                        perMove: 1,
                        type: 'loop',
                        gap: '0.5rem',
                        interval: 2000,
                        breakpoints: {
                            900: {
                                perPage: 2.5,
                            },
                            700: {
                                perPage: 1.5,
                                drag   : 'free',
                                snap   : false,
                            },
                        },
                    ",
                ])
                    @slot('content')
                        @foreach ($guitareoMethod as $key => $method)
                            <li class="splide__slide my-2 flex">
                                <div class="bg-[#F6F8FC] rounded-xl" style="box-shadow: 5px 5px 5px rgba(0, 0, 0, 0.1);">
                                    <div class="relative" style="padding-bottom: 56.25%;">
                                        <img
                                            class="rounded-t-xl w-full absolute w-full h-full object-cover object-top transition-all opacity-0"
                                            src="https://www.musora.com/musora-cdn/image/width=400,quality=95/{{$method['img']}}"
                                            loading="lazy"
                                            onload="this.classList.remove('opacity-0')"
                                            alt="lesson{{$key+1}} img"
                                        >
                                        <div class="absolute inset-0 rotate-180 rounded-b-xl" style="background:linear-gradient(180deg, #05816F 0%, rgba(0, 0, 0, 0.5) 100%);"></div>
                                        <div class="absolute inset-0 flex flex-col justify-center items-center text-white text-5xl font-extrabold">
                                            <div>
                                                <img class="h-4 -mr-2" src="https://dmmior4id2ysr.cloudfront.net/logos/guitareo-logo-white.png" alt="guitareo logo" /> <img class="h-4" src="https://dpwjbsxqtam5n.cloudfront.net/sales/2021/method-text.svg" alt="method logo" style="filter:brightness(0) invert(1)" />
                                            </div>
                                            LEVEL {{ $key+1 }}
                                        </div>
                                    </div>
                                    <div class="p-5">
                                        <p class="text-[#838C98] tracking-widest text-sm mb-1">LEVEL {{ $key + 1 }} - {{ $method['lessonNum'] }} LESSONS</p>
                                        <p class="font-bold mb-3 leading-tight">{{$method['title']}}</p>
                                        <p class="leading-snug">{!! $method['desc'] !!}</p>
                                    </div>
                                </div>
                            </li>
                        @endforeach
                    @endslot
                @endcomponent
            </div>
            <div class="mb-10">
                <h4 class="font-extrabold mb-4">Drums</h4>
                @component('_partials.components.carousel',[
                    'xdata' => "
                        classes: {
                            arrow: 'splide__arrow bg-white opacity-100 shadow-lg h-11 w-11 top-[38%]',
                            prev: 'hidden',
                            next: 'splide__arrow--next your-class-next hidden sm:flex z-50 -right-1',
                            pagination: 'hidden',
                        },
                        perPage: 3.5,
                        perMove: 1,
                        type: 'loop',
                        gap: '0.5rem',
                        interval: 2000,
                        breakpoints: {
                            900: {
                                perPage: 2.5,
                            },
                            700: {
                                perPage: 1.5,
                                drag   : 'free',
                                snap   : false,
                            },
                        },
                    ",
                ])
                    @slot('content')
                        @foreach ($drumeoMethod as $key => $method)
                            <li class="splide__slide my-2 flex">
                                <div class="bg-[#F6F8FC] rounded-xl" style="box-shadow: 5px 5px 5px rgba(0, 0, 0, 0.1);">
                                    <div class="relative" style="padding-bottom: 56.25%;">
                                        <img
                                            class="rounded-t-xl w-full absolute w-full h-full object-cover object-top transition-all opacity-0"
                                            src="https://www.musora.com/musora-cdn/image/width=400,quality=95/{{$method['img']}}"
                                            loading="lazy"
                                            onload="this.classList.remove('opacity-0')"
                                            alt="lesson{{$key+1}} img"
                                        >
                                        <div class="absolute inset-0 rotate-180 rounded-b-xl" style="background:linear-gradient(180deg, #095399 0%, rgba(0, 0, 0, 0.5) 100%);"></div>
                                        <div class="absolute inset-0 flex flex-col justify-center items-center text-white text-5xl font-extrabold">
                                            <div>
                                                <img class="h-4 -mr-2" src="https://dmmior4id2ysr.cloudfront.net/logos/drumeo-logo-white.png" alt="drumeo logo" /> <img class="h-4" src="https://dpwjbsxqtam5n.cloudfront.net/sales/2021/method-text.svg" alt="method logo" style="filter:brightness(0) invert(1)" />
                                            </div>
                                            LEVEL {{ $key+1 }}
                                        </div>
                                    </div>
                                    <div class="p-5">
                                        <p class="text-[#838C98] tracking-widest text-sm mb-1">LEVEL {{ $key + 1 }} - {{ $method['lessonNum'] }} LESSONS</p>
                                        <p class="font-bold mb-3 leading-tight">{{$method['title']}}</p>
                                        <p class="leading-snug">{!! $method['desc'] !!}</p>
                                    </div>
                                </div>
                            </li>
                        @endforeach
                    @endslot
                @endcomponent
            </div>
            <div class="mb-10">
                <h4 class="font-extrabold mb-4">Singing</h4>
                @component('_partials.components.carousel',[
                    'xdata' => "
                        classes: {
                            arrow: 'splide__arrow bg-white opacity-100 shadow-lg h-11 w-11 top-[38%]',
                            prev: 'hidden',
                            next: 'splide__arrow--next your-class-next hidden sm:flex z-50 -right-1',
                            pagination: 'hidden',
                        },
                        perPage: 3.5,
                        perMove: 1,
                        type: 'loop',
                        gap: '0.5rem',
                        interval: 2000,
                        breakpoints: {
                            900: {
                                perPage: 2.5,
                            },
                            700: {
                                perPage: 1.5,
                                drag   : 'free',
                                snap   : false,
                            },
                        },
                    ",
                ])
                    @slot('content')
                        @foreach ($singeoMethod as $key => $method)
                            <li class="splide__slide my-2 flex">
                                <div class="bg-[#F6F8FC] rounded-xl" style="box-shadow: 5px 5px 5px rgba(0, 0, 0, 0.1);">
                                    <div class="relative" style="padding-bottom: 56.25%;">
                                        <img
                                            class="rounded-t-xl w-full absolute w-full h-full object-cover object-top transition-all opacity-0"
                                            src="https://www.musora.com/musora-cdn/image/width=400,quality=95/{{$method['img']}}"
                                            loading="lazy"
                                            onload="this.classList.remove('opacity-0')"
                                            alt="lesson{{$key+1}} img"
                                        >
                                        <div class="absolute inset-0 rotate-180 rounded-b-xl" style="background:linear-gradient(180deg, #703d99 0%, rgba(0, 0, 0, 0.5) 100%);"></div>
                                        <div class="absolute inset-0 flex flex-col justify-center items-center text-white text-5xl font-extrabold">
                                            <div>
                                                <img class="h-4 -mr-2" src="https://dmmior4id2ysr.cloudfront.net/logos/singeo-logo-white.png" alt="singeo logo" /> <img class="h-4" src="https://dpwjbsxqtam5n.cloudfront.net/sales/2021/method-text.svg" alt="method logo" style="filter:brightness(0) invert(1)" />
                                            </div>
                                            LEVEL {{ $key+1 }}
                                        </div>
                                    </div>
                                    <div class="p-5">
                                        <p class="text-[#838C98] tracking-widest text-sm mb-1">LEVEL {{ $key + 1 }} - {{ $method['lessonNum'] }} @if($key < 9) LESSONS @endif </p>
                                        <p class="font-bold mb-3 leading-tight">{{$method['title']}}</p>
                                        <p class="leading-snug">{!! $method['desc'] !!}</p>
                                    </div>
                                </div>
                            </li>
                        @endforeach
                    @endslot
                @endcomponent
            </div>
        </div>
    </section>
    <section class="py-10 sm:py-14 lg:py-20" x-data="{ category: 'all', }">
        <div class="container max-w-6xl lg:ml-auto lg:mr-0 xl:mx-auto px-4 sm:px-6 xl:px-0">
            <h3 class="text-center leading-tight mb-5"><strong>Learn every technique,<br class="sm:hidden"> style & pattern.</strong></h3>
            <div class="text-center mb-6">
                <span class="uppercase btn-primary btn-small mr-0.5 md:mr-2 px-4 sm:px-8 md:px-12" :class="category.includes('all') ? 'bg-black text-white' : 'text-black border-black'" @click="category = 'all'">all</span>
                <span class="uppercase btn-primary btn-small mr-0.5 md:mr-2 px-5 sm:px-8 md:px-12" :class="category.includes('drumeo') ? 'bg-drumeo text-white' : 'text-drumeo border-drumeo'" @click="category = 'drumeo'"><i class="fa-regular fa-drum"></i></span>
                <span class="uppercase btn-primary btn-small mr-0.5 md:mr-2 px-5 sm:px-8 md:px-12" :class="category.includes('pianote') ? 'bg-pianote text-white' : 'text-pianote border-pianote'" @click="category = 'pianote'"><i class="fa-regular fa-piano-keyboard"></i></span>
                <span class="uppercase btn-primary btn-small mr-0.5 md:mr-2 px-5 sm:px-8 md:px-12" :class="category.includes('guitareo') ? 'bg-guitareo text-white' : 'text-guitareo border-guitareo'" @click="category = 'guitareo'"><i class="fa-light fa-guitar"></i></span>
                <span class="uppercase btn-primary btn-small px-5 sm:px-8 md:px-12" :class="category.includes('singeo') ? 'bg-singeo text-white' : 'text-singeo border-singeo'" @click="category = 'singeo'"><i class="fa-light fa-microphone-stand"></i></span>
            </div>

            <div class="mb-6">
                <h4 class="font-extrabold mb-4">Learn any Style</h4>
                <div x-show="category === 'all'">
                    @component('_partials.components.carousel',[
                        'xdata' => "
                            classes: {
                                arrow: 'splide__arrow bg-white opacity-100 shadow-lg h-11 w-11 top-[38%]',
                                prev: 'hidden',
                                next: 'splide__arrow--next your-class-next hidden sm:flex z-50 -right-1',
                                pagination: 'hidden',
                            },
                            perPage: 4.5,
                            perMove: 1,
                            type: 'loop',
                            gap: '0.5rem',
                            interval: 2000,
                            breakpoints: {
                                900: {
                                    perPage: 3.5,
                                },
                                700: {
                                perPage: 1.5,
                                drag   : 'free',
                                snap   : false,
                            },
                            },
                        ",
                    ])
                        @slot('content')
                            @foreach ($learnAll as $slide)
                                <li class="splide__slide" >
                                    <div>
                                        <div class="relative mb-2" style="padding-bottom: 56.25%;">
                                            <img
                                                class="rounded-xl w-full absolute w-full h-full object-cover object-top"
                                                src="https://www.musora.com/musora-cdn/image/width=400,quality=95/{{$slide['img']}}"
                                                alt="{{$slide['title']}} img"
                                                fetchpriority="high"
                                            >
                                        </div>
                                        <p class="font-bold mb-1 leading-tight">{{$slide['title']}}</p>
                                        <p class="text-[#838C98] leading-tight">{{$slide['artist']}}</p>
                                    </div>
                                </li>
                            @endforeach
                        @endslot
                    @endcomponent
                </div>
                <div x-show="category === 'drumeo'">
                    @component('_partials.components.carousel',[
                        'xdata' => "
                            classes: {
                                arrow: 'splide__arrow bg-white opacity-100 shadow-lg h-11 w-11 top-[38%]',
                                prev: 'hidden',
                                next: 'splide__arrow--next your-class-next hidden sm:flex z-50 -right-1',
                                pagination: 'hidden',
                            },
                            perPage: 4.5,
                            perMove: 1,
                            type: 'loop',
                            gap: '0.5rem',
                            interval: 2000,
                            breakpoints: {
                                900: {
                                    perPage: 3.5,
                                },
                                700: {
                                perPage: 1.5,
                                drag   : 'free',
                                snap   : false,
                            },
                            },
                        ",
                    ])
                        @slot('content')
                            @foreach ($learnDrumeo as $slide)
                                <li class="splide__slide" >
                                    <div>
                                        <div class="relative mb-2" style="padding-bottom: 56.25%;">
                                            <img
                                                class="rounded-xl w-full absolute w-full h-full object-cover object-top"
                                                src="https://www.musora.com/musora-cdn/image/width=400,quality=95/{{$slide['img']}}"
                                                alt="{{$slide['title']}} img"
                                                fetchpriority="high"
                                            >
                                        </div>
                                        <p class="font-bold mb-1 leading-tight">{{$slide['title']}}</p>
                                        <p class="text-[#838C98] leading-tight">{{$slide['artist']}}</p>
                                    </div>
                                </li>
                            @endforeach
                        @endslot
                    @endcomponent
                </div>
                <div x-show="category === 'pianote'">
                    @component('_partials.components.carousel',[
                        'xdata' => "
                            classes: {
                                arrow: 'splide__arrow bg-white opacity-100 shadow-lg h-11 w-11 top-[38%]',
                                prev: 'hidden',
                                next: 'splide__arrow--next your-class-next hidden sm:flex z-50 -right-1',
                                pagination: 'hidden',
                            },
                            perPage: 4.5,
                            perMove: 1,
                            type: 'loop',
                            gap: '0.5rem',
                            interval: 2000,
                            breakpoints: {
                                900: {
                                    perPage: 3.5,
                                },
                                700: {
                                perPage: 1.5,
                                drag   : 'free',
                                snap   : false,
                            },
                            },
                        ",
                    ])
                        @slot('content')
                            @foreach ($learnPianote as $slide)
                                <li class="splide__slide" >
                                    <div>
                                        <div class="relative mb-2" style="padding-bottom: 56.25%;">
                                            <img
                                                class="rounded-xl w-full absolute w-full h-full object-cover object-top"
                                                src="https://www.musora.com/musora-cdn/image/width=400,quality=95/{{$slide['img']}}"
                                                alt="{{$slide['title']}} img"
                                                fetchpriority="high"
                                            >
                                        </div>
                                        <p class="font-bold mb-1 leading-tight">{{$slide['title']}}</p>
                                        <p class="text-[#838C98] leading-tight">{{$slide['artist']}}</p>
                                    </div>
                                </li>
                            @endforeach
                        @endslot
                    @endcomponent
                </div>
                <div x-show="category === 'guitareo'">
                    @component('_partials.components.carousel',[
                        'xdata' => "
                            classes: {
                                arrow: 'splide__arrow bg-white opacity-100 shadow-lg h-11 w-11 top-[38%]',
                                prev: 'hidden',
                                next: 'splide__arrow--next your-class-next hidden sm:flex z-50 -right-1',
                                pagination: 'hidden',
                            },
                            perPage: 4.5,
                            perMove: 1,
                            type: 'loop',
                            gap: '0.5rem',
                            interval: 2000,
                            breakpoints: {
                                900: {
                                    perPage: 3.5,
                                },
                                700: {
                                perPage: 1.5,
                                drag   : 'free',
                                snap   : false,
                            },
                            },
                        ",
                    ])
                        @slot('content')
                            @foreach ($learnGuitareo as $slide)
                                <li class="splide__slide" >
                                    <div>
                                        <div class="relative mb-2" style="padding-bottom: 56.25%;">
                                            <img
                                                class="rounded-xl w-full absolute w-full h-full object-cover object-top"
                                                src="https://www.musora.com/musora-cdn/image/width=400,quality=95/{{$slide['img']}}"
                                                alt="{{$slide['title']}} img"
                                                fetchpriority="high"
                                            >
                                        </div>
                                        <p class="font-bold mb-1 leading-tight">{{$slide['title']}}</p>
                                        <p class="text-[#838C98] leading-tight">{{$slide['artist']}}</p>
                                    </div>
                                </li>
                            @endforeach
                        @endslot
                    @endcomponent
                </div>
                <div x-show="category === 'singeo'">
                    @component('_partials.components.carousel',[
                        'xdata' => "
                            classes: {
                                arrow: 'splide__arrow bg-white opacity-100 shadow-lg h-11 w-11 top-[38%]',
                                prev: 'hidden',
                                next: 'splide__arrow--next your-class-next hidden sm:flex z-50 -right-1',
                                pagination: 'hidden',
                            },
                            perPage: 4.5,
                            perMove: 1,
                            type: 'loop',
                            gap: '0.5rem',
                            interval: 2000,
                            breakpoints: {
                                900: {
                                    perPage: 3.5,
                                },
                                700: {
                                perPage: 1.5,
                                drag   : 'free',
                                snap   : false,
                            },
                            },
                        ",
                    ])
                        @slot('content')
                            @foreach ($learnSingeo as $slide)
                                <li class="splide__slide" >
                                    <div>
                                        <div class="relative mb-2" style="padding-bottom: 56.25%;">
                                            <img
                                                class="rounded-xl w-full absolute w-full h-full object-cover object-top"
                                                src="https://www.musora.com/musora-cdn/image/width=400,quality=95/{{$slide['img']}}"
                                                alt="{{$slide['title']}} img"
                                                fetchpriority="high"
                                            >
                                        </div>
                                        <p class="font-bold mb-1 leading-tight">{{$slide['title']}}</p>
                                        <p class="text-[#838C98] leading-tight">{{$slide['artist']}}</p>
                                    </div>
                                </li>
                            @endforeach
                        @endslot
                    @endcomponent
                </div>
            </div>
            <div class="mb-6">
                <h4 class="font-extrabold mb-4">Essential Techniques</h4>
                <div x-show="category === 'all'">
                    @component('_partials.components.carousel',[
                        'xdata' => "
                            classes: {
                                arrow: 'splide__arrow bg-white opacity-100 shadow-lg h-11 w-11 top-[38%]',
                                prev: 'hidden',
                                next: 'splide__arrow--next your-class-next hidden sm:flex z-50 -right-1',
                                pagination: 'hidden',
                            },
                            perPage: 4.5,
                            perMove: 1,
                            type: 'loop',
                            gap: '0.5rem',
                            interval: 2000,
                            breakpoints: {
                                900: {
                                    perPage: 3.5,
                                },
                                700: {
                                perPage: 1.5,
                                drag   : 'free',
                                snap   : false,
                            },
                            },
                        ",
                    ])
                        @slot('content')
                            @foreach ($essentialAll as $slide)
                                <li class="splide__slide" >
                                    <div>
                                        <div class="relative mb-2" style="padding-bottom: 56.25%;">
                                            <img
                                                class="rounded-xl w-full absolute w-full h-full object-cover object-top"
                                                src="https://www.musora.com/musora-cdn/image/width=400,quality=95/{{$slide['img']}}"
                                                alt="{{$slide['title']}} img"
                                                fetchpriority="high"
                                            >
                                        </div>
                                        <p class="font-bold mb-1 leading-tight">{{$slide['title']}}</p>
                                        <p class="text-[#838C98] leading-tight">{{$slide['artist']}}</p>
                                    </div>
                                </li>
                            @endforeach
                        @endslot
                    @endcomponent
                </div>
                <div x-show="category === 'drumeo'">
                    @component('_partials.components.carousel',[
                        'xdata' => "
                            classes: {
                                arrow: 'splide__arrow bg-white opacity-100 shadow-lg h-11 w-11 top-[38%]',
                                prev: 'hidden',
                                next: 'splide__arrow--next your-class-next hidden sm:flex z-50 -right-1',
                                pagination: 'hidden',
                            },
                            perPage: 4.5,
                            perMove: 1,
                            type: 'loop',
                            gap: '0.5rem',
                            interval: 2000,
                            breakpoints: {
                                900: {
                                    perPage: 3.5,
                                },
                                700: {
                                perPage: 1.5,
                                drag   : 'free',
                                snap   : false,
                            },
                            },
                        ",
                    ])
                        @slot('content')
                            @foreach ($essentialDrumeo as $slide)
                                <li class="splide__slide" >
                                    <div>
                                        <div class="relative mb-2" style="padding-bottom: 56.25%;">
                                            <img
                                                class="rounded-xl w-full absolute w-full h-full object-cover object-top"
                                                src="https://www.musora.com/musora-cdn/image/width=400,quality=95/{{$slide['img']}}"
                                                alt="{{$slide['title']}} img"
                                                fetchpriority="high"
                                            >
                                        </div>
                                        <p class="font-bold mb-1 leading-tight">{{$slide['title']}}</p>
                                        <p class="text-[#838C98] leading-tight">{{$slide['artist']}}</p>
                                    </div>
                                </li>
                            @endforeach
                        @endslot
                    @endcomponent
                </div>
                <div x-show="category === 'pianote'">
                    @component('_partials.components.carousel',[
                        'xdata' => "
                            classes: {
                                arrow: 'splide__arrow bg-white opacity-100 shadow-lg h-11 w-11 top-[38%]',
                                prev: 'hidden',
                                next: 'splide__arrow--next your-class-next hidden sm:flex z-50 -right-1',
                                pagination: 'hidden',
                            },
                            perPage: 4.5,
                            perMove: 1,
                            type: 'loop',
                            gap: '0.5rem',
                            interval: 2000,
                            breakpoints: {
                                900: {
                                    perPage: 3.5,
                                },
                                700: {
                                perPage: 1.5,
                                drag   : 'free',
                                snap   : false,
                            },
                            },
                        ",
                    ])
                        @slot('content')
                            @foreach ($essentialPianote as $slide)
                                <li class="splide__slide" >
                                    <div>
                                        <div class="relative mb-2" style="padding-bottom: 56.25%;">
                                            <img
                                                class="rounded-xl w-full absolute w-full h-full object-cover object-top"
                                                src="https://www.musora.com/musora-cdn/image/width=400,quality=95/{{$slide['img']}}"
                                                alt="{{$slide['title']}} img"
                                                fetchpriority="high"
                                            >
                                        </div>
                                        <p class="font-bold mb-1 leading-tight">{{$slide['title']}}</p>
                                        <p class="text-[#838C98] leading-tight">{{$slide['artist']}}</p>
                                    </div>
                                </li>
                            @endforeach
                        @endslot
                    @endcomponent
                </div>
                <div x-show="category === 'guitareo'">
                    @component('_partials.components.carousel',[
                        'xdata' => "
                            classes: {
                                arrow: 'splide__arrow bg-white opacity-100 shadow-lg h-11 w-11 top-[38%]',
                                prev: 'hidden',
                                next: 'splide__arrow--next your-class-next hidden sm:flex z-50 -right-1',
                                pagination: 'hidden',
                            },
                            perPage: 4.5,
                            perMove: 1,
                            type: 'loop',
                            gap: '0.5rem',
                            interval: 2000,
                            breakpoints: {
                                900: {
                                    perPage: 3.5,
                                },
                                700: {
                                perPage: 1.5,
                                drag   : 'free',
                                snap   : false,
                            },
                            },
                        ",
                    ])
                        @slot('content')
                            @foreach ($essentialGuitareo as $slide)
                                <li class="splide__slide" >
                                    <div>
                                        <div class="relative mb-2" style="padding-bottom: 56.25%;">
                                            <img
                                                class="rounded-xl w-full absolute w-full h-full object-cover object-top"
                                                src="https://www.musora.com/musora-cdn/image/width=400,quality=95/{{$slide['img']}}"
                                                alt="{{$slide['title']}} img"
                                                fetchpriority="high"
                                            >
                                        </div>
                                        <p class="font-bold mb-1 leading-tight">{{$slide['title']}}</p>
                                        <p class="text-[#838C98] leading-tight">{{$slide['artist']}}</p>
                                    </div>
                                </li>
                            @endforeach
                        @endslot
                    @endcomponent
                </div>
                <div x-show="category === 'singeo'">
                    @component('_partials.components.carousel',[
                        'xdata' => "
                            classes: {
                                arrow: 'splide__arrow bg-white opacity-100 shadow-lg h-11 w-11 top-[38%]',
                                prev: 'hidden',
                                next: 'splide__arrow--next your-class-next hidden sm:flex z-50 -right-1',
                                pagination: 'hidden',
                            },
                            perPage: 4.5,
                            perMove: 1,
                            type: 'loop',
                            gap: '0.5rem',
                            interval: 2000,
                            breakpoints: {
                                900: {
                                    perPage: 3.5,
                                },
                                700: {
                                perPage: 1.5,
                                drag   : 'free',
                                snap   : false,
                            },
                            },
                        ",
                    ])
                        @slot('content')
                            @foreach ($essentialSingeo as $slide)
                                <li class="splide__slide" >
                                    <div>
                                        <div class="relative mb-2" style="padding-bottom: 56.25%;">
                                            <img
                                                class="rounded-xl w-full absolute w-full h-full object-cover object-top"
                                                src="https://www.musora.com/musora-cdn/image/width=400,quality=95/{{$slide['img']}}"
                                                alt="{{$slide['title']}} img"
                                                fetchpriority="high"
                                            >
                                        </div>
                                        <p class="font-bold mb-1 leading-tight">{{$slide['title']}}</p>
                                        <p class="text-[#838C98] leading-tight">{{$slide['artist']}}</p>
                                    </div>
                                </li>
                            @endforeach
                        @endslot
                    @endcomponent
                </div>
            </div>
            <div class="mb-6">
                <h4 class="font-extrabold mb-4">Play More Creatively</h4>
                <div x-show="category === 'all'">
                    @component('_partials.components.carousel',[
                        'xdata' => "
                            classes: {
                                arrow: 'splide__arrow bg-white opacity-100 shadow-lg h-11 w-11 top-[38%]',
                                prev: 'hidden',
                                next: 'splide__arrow--next your-class-next hidden sm:flex z-50 -right-1',
                                pagination: 'hidden',
                            },
                            perPage: 4.5,
                            perMove: 1,
                            type: 'loop',
                            gap: '0.5rem',
                            interval: 2000,
                            breakpoints: {
                                900: {
                                    perPage: 3.5,
                                },
                                700: {
                                perPage: 1.5,
                                drag   : 'free',
                                snap   : false,
                            },
                            },
                        ",
                    ])
                        @slot('content')
                            @foreach ($playAll as $slide)
                                <li class="splide__slide" >
                                    <div>
                                        <div class="relative mb-2" style="padding-bottom: 56.25%;">
                                            <img
                                                class="rounded-xl w-full absolute w-full h-full object-cover object-top"
                                                src="https://www.musora.com/musora-cdn/image/width=400,quality=95/{{$slide['img']}}"
                                                alt="{{$slide['title']}} img"
                                                fetchpriority="high"
                                            >
                                        </div>
                                        <p class="font-bold mb-1 leading-tight">{{$slide['title']}}</p>
                                        <p class="text-[#838C98] leading-tight">{{$slide['artist']}}</p>
                                    </div>
                                </li>
                            @endforeach
                        @endslot
                    @endcomponent
                </div>
                <div x-show="category === 'drumeo'">
                    @component('_partials.components.carousel',[
                        'xdata' => "
                            classes: {
                                arrow: 'splide__arrow bg-white opacity-100 shadow-lg h-11 w-11 top-[38%]',
                                prev: 'hidden',
                                next: 'splide__arrow--next your-class-next hidden sm:flex z-50 -right-1',
                                pagination: 'hidden',
                            },
                            perPage: 4.5,
                            perMove: 1,
                            type: 'loop',
                            gap: '0.5rem',
                            interval: 2000,
                            breakpoints: {
                                900: {
                                    perPage: 3.5,
                                },
                                700: {
                                perPage: 1.5,
                                drag   : 'free',
                                snap   : false,
                            },
                            },
                        ",
                    ])
                        @slot('content')
                            @foreach ($playDrumeo as $slide)
                                <li class="splide__slide" >
                                    <div>
                                        <div class="relative mb-2" style="padding-bottom: 56.25%;">
                                            <img
                                                class="rounded-xl w-full absolute w-full h-full object-cover object-top"
                                                src="https://www.musora.com/musora-cdn/image/width=400,quality=95/{{$slide['img']}}"
                                                alt="{{$slide['title']}} img"
                                                fetchpriority="high"
                                            >
                                        </div>
                                        <p class="font-bold mb-1 leading-tight">{{$slide['title']}}</p>
                                        <p class="text-[#838C98] leading-tight">{{$slide['artist']}}</p>
                                    </div>
                                </li>
                            @endforeach
                        @endslot
                    @endcomponent
                </div>
                <div x-show="category === 'pianote'">
                    @component('_partials.components.carousel',[
                        'xdata' => "
                            classes: {
                                arrow: 'splide__arrow bg-white opacity-100 shadow-lg h-11 w-11 top-[38%]',
                                prev: 'hidden',
                                next: 'splide__arrow--next your-class-next hidden sm:flex z-50 -right-1',
                                pagination: 'hidden',
                            },
                            perPage: 4.5,
                            perMove: 1,
                            type: 'loop',
                            gap: '0.5rem',
                            interval: 2000,
                            breakpoints: {
                                900: {
                                    perPage: 3.5,
                                },
                                700: {
                                perPage: 1.5,
                                drag   : 'free',
                                snap   : false,
                            },
                            },
                        ",
                    ])
                        @slot('content')
                            @foreach ($playPianote as $slide)
                                <li class="splide__slide" >
                                    <div>
                                        <div class="relative mb-2" style="padding-bottom: 56.25%;">
                                            <img
                                                class="rounded-xl w-full absolute w-full h-full object-cover object-top"
                                                src="https://www.musora.com/musora-cdn/image/width=400,quality=95/{{$slide['img']}}"
                                                alt="{{$slide['title']}} img"
                                                fetchpriority="high"
                                            >
                                        </div>
                                        <p class="font-bold mb-1 leading-tight">{{$slide['title']}}</p>
                                        <p class="text-[#838C98] leading-tight">{{$slide['artist']}}</p>
                                    </div>
                                </li>
                            @endforeach
                        @endslot
                    @endcomponent
                </div>
                <div x-show="category === 'guitareo'">
                    @component('_partials.components.carousel',[
                        'xdata' => "
                            classes: {
                                arrow: 'splide__arrow bg-white opacity-100 shadow-lg h-11 w-11 top-[38%]',
                                prev: 'hidden',
                                next: 'splide__arrow--next your-class-next hidden sm:flex z-50 -right-1',
                                pagination: 'hidden',
                            },
                            perPage: 4.5,
                            perMove: 1,
                            type: 'loop',
                            gap: '0.5rem',
                            interval: 2000,
                            breakpoints: {
                                900: {
                                    perPage: 3.5,
                                },
                                700: {
                                perPage: 1.5,
                                drag   : 'free',
                                snap   : false,
                            },
                            },
                        ",
                    ])
                        @slot('content')
                            @foreach ($playGuitareo as $slide)
                                <li class="splide__slide" >
                                    <div>
                                        <div class="relative mb-2" style="padding-bottom: 56.25%;">
                                            <img
                                                class="rounded-xl w-full absolute w-full h-full object-cover object-top"
                                                src="https://www.musora.com/musora-cdn/image/width=400,quality=95/{{$slide['img']}}"
                                                alt="{{$slide['title']}} img"
                                                fetchpriority="high"
                                            >
                                        </div>
                                        <p class="font-bold mb-1 leading-tight">{{$slide['title']}}</p>
                                        <p class="text-[#838C98] leading-tight">{{$slide['artist']}}</p>
                                    </div>
                                </li>
                            @endforeach
                        @endslot
                    @endcomponent
                </div>
                <div x-show="category === 'singeo'">
                    @component('_partials.components.carousel',[
                        'xdata' => "
                            classes: {
                                arrow: 'splide__arrow bg-white opacity-100 shadow-lg h-11 w-11 top-[38%]',
                                prev: 'hidden',
                                next: 'splide__arrow--next your-class-next hidden sm:flex z-50 -right-1',
                                pagination: 'hidden',
                            },
                            perPage: 4.5,
                            perMove: 1,
                            type: 'loop',
                            gap: '0.5rem',
                            interval: 2000,
                            breakpoints: {
                                900: {
                                    perPage: 3.5,
                                },
                                700: {
                                perPage: 1.5,
                                drag   : 'free',
                                snap   : false,
                            },
                            },
                        ",
                    ])
                        @slot('content')
                            @foreach ($playSingeo as $slide)
                                <li class="splide__slide" >
                                    <div>
                                        <div class="relative mb-2" style="padding-bottom: 56.25%;">
                                            <img
                                                class="rounded-xl w-full absolute w-full h-full object-cover object-top"
                                                src="https://www.musora.com/musora-cdn/image/width=400,quality=95/{{$slide['img']}}"
                                                alt="{{$slide['title']}} img"
                                                fetchpriority="high"
                                            >
                                        </div>
                                        <p class="font-bold mb-1 leading-tight">{{$slide['title']}}</p>
                                        <p class="text-[#838C98] leading-tight">{{$slide['artist']}}</p>
                                    </div>
                                </li>
                            @endforeach
                        @endslot
                    @endcomponent
                </div>
            </div>
            <div class="mb-6">
                <h4 class="font-extrabold mb-4">Or... Anything Else!</h4>
                <div x-show="category === 'all'">
                    @component('_partials.components.carousel',[
                        'xdata' => "
                            classes: {
                                arrow: 'splide__arrow bg-white opacity-100 shadow-lg h-11 w-11 top-[38%]',
                                prev: 'hidden',
                                next: 'splide__arrow--next your-class-next hidden sm:flex z-50 -right-1',
                                pagination: 'hidden',
                            },
                            perPage: 4.5,
                            perMove: 1,
                            type: 'loop',
                            gap: '0.5rem',
                            interval: 2000,
                            breakpoints: {
                                900: {
                                    perPage: 3.5,
                                },
                                700: {
                                perPage: 1.5,
                                drag   : 'free',
                                snap   : false,
                            },
                            },
                        ",
                    ])
                        @slot('content')
                            @foreach ($anythingAll as $slide)
                                <li class="splide__slide" >
                                    <div>
                                        <div class="relative mb-2" style="padding-bottom: 56.25%;">
                                            <img
                                                class="rounded-xl w-full absolute w-full h-full object-cover object-top"
                                                src="https://www.musora.com/musora-cdn/image/width=400,quality=95/{{$slide['img']}}"
                                                alt="{{$slide['title']}} img"
                                                fetchpriority="high"
                                            >
                                        </div>
                                        <p class="font-bold mb-1 leading-tight">{{$slide['title']}}</p>
                                        <p class="text-[#838C98] leading-tight">{{$slide['artist']}}</p>
                                    </div>
                                </li>
                            @endforeach
                        @endslot
                    @endcomponent
                </div>
                <div x-show="category === 'drumeo'">
                    @component('_partials.components.carousel',[
                        'xdata' => "
                            classes: {
                                arrow: 'splide__arrow bg-white opacity-100 shadow-lg h-11 w-11 top-[38%]',
                                prev: 'hidden',
                                next: 'splide__arrow--next your-class-next hidden sm:flex z-50 -right-1',
                                pagination: 'hidden',
                            },
                            perPage: 4.5,
                            perMove: 1,
                            type: 'loop',
                            gap: '0.5rem',
                            interval: 2000,
                            breakpoints: {
                                900: {
                                    perPage: 3.5,
                                },
                                700: {
                                perPage: 1.5,
                                drag   : 'free',
                                snap   : false,
                            },
                            },
                        ",
                    ])
                        @slot('content')
                            @foreach ($anythingDrumeo as $slide)
                                <li class="splide__slide" >
                                    <div>
                                        <div class="relative mb-2" style="padding-bottom: 56.25%;">
                                            <img
                                                class="rounded-xl w-full absolute w-full h-full object-cover object-top"
                                                src="https://www.musora.com/musora-cdn/image/width=400,quality=95/{{$slide['img']}}"
                                                alt="{{$slide['title']}} img"
                                                fetchpriority="high"
                                            >
                                        </div>
                                        <p class="font-bold mb-1 leading-tight">{{$slide['title']}}</p>
                                        <p class="text-[#838C98] leading-tight">{{$slide['artist']}}</p>
                                    </div>
                                </li>
                            @endforeach
                        @endslot
                    @endcomponent
                </div>
                <div x-show="category === 'pianote'">
                    @component('_partials.components.carousel',[
                        'xdata' => "
                            classes: {
                                arrow: 'splide__arrow bg-white opacity-100 shadow-lg h-11 w-11 top-[38%]',
                                prev: 'hidden',
                                next: 'splide__arrow--next your-class-next hidden sm:flex z-50 -right-1',
                                pagination: 'hidden',
                            },
                            perPage: 4.5,
                            perMove: 1,
                            type: 'loop',
                            gap: '0.5rem',
                            interval: 2000,
                            breakpoints: {
                                900: {
                                    perPage: 3.5,
                                },
                                700: {
                                perPage: 1.5,
                                drag   : 'free',
                                snap   : false,
                            },
                            },
                        ",
                    ])
                        @slot('content')
                            @foreach ($anythingPianote as $slide)
                                <li class="splide__slide" >
                                    <div>
                                        <div class="relative mb-2" style="padding-bottom: 56.25%;">
                                            <img
                                                class="rounded-xl w-full absolute w-full h-full object-cover object-top"
                                                src="https://www.musora.com/musora-cdn/image/width=400,quality=95/{{$slide['img']}}"
                                                alt="{{$slide['title']}} img"
                                                fetchpriority="high"
                                            >
                                        </div>
                                        <p class="font-bold mb-1 leading-tight">{{$slide['title']}}</p>
                                        <p class="text-[#838C98] leading-tight">{{$slide['artist']}}</p>
                                    </div>
                                </li>
                            @endforeach
                        @endslot
                    @endcomponent
                </div>
                <div x-show="category === 'guitareo'">
                    @component('_partials.components.carousel',[
                        'xdata' => "
                            classes: {
                                arrow: 'splide__arrow bg-white opacity-100 shadow-lg h-11 w-11 top-[38%]',
                                prev: 'hidden',
                                next: 'splide__arrow--next your-class-next hidden sm:flex z-50 -right-1',
                                pagination: 'hidden',
                            },
                            perPage: 4.5,
                            perMove: 1,
                            type: 'loop',
                            gap: '0.5rem',
                            interval: 2000,
                            breakpoints: {
                                900: {
                                    perPage: 3.5,
                                },
                                700: {
                                perPage: 1.5,
                                drag   : 'free',
                                snap   : false,
                            },
                            },
                        ",
                    ])
                        @slot('content')
                            @foreach ($anythingGuitareo as $slide)
                                <li class="splide__slide" >
                                    <div>
                                        <div class="relative mb-2" style="padding-bottom: 56.25%;">
                                            <img
                                                class="rounded-xl w-full absolute w-full h-full object-cover object-top"
                                                src="https://www.musora.com/musora-cdn/image/width=400,quality=95/{{$slide['img']}}"
                                                alt="{{$slide['title']}} img"
                                                fetchpriority="high"
                                            >
                                        </div>
                                        <p class="font-bold mb-1 leading-tight">{{$slide['title']}}</p>
                                        <p class="text-[#838C98] leading-tight">{{$slide['artist']}}</p>
                                    </div>
                                </li>
                            @endforeach
                        @endslot
                    @endcomponent
                </div>
                <div x-show="category === 'singeo'">
                    @component('_partials.components.carousel',[
                        'xdata' => "
                            classes: {
                                arrow: 'splide__arrow bg-white opacity-100 shadow-lg h-11 w-11 top-[38%]',
                                prev: 'hidden',
                                next: 'splide__arrow--next your-class-next hidden sm:flex z-50 -right-1',
                                pagination: 'hidden',
                            },
                            perPage: 4.5,
                            perMove: 1,
                            type: 'loop',
                            gap: '0.5rem',
                            interval: 2000,
                            breakpoints: {
                                900: {
                                    perPage: 3.5,
                                },
                                700: {
                                perPage: 1.5,
                                drag   : 'free',
                                snap   : false,
                            },
                            },
                        ",
                    ])
                        @slot('content')
                            @foreach ($anythingSingeo as $slide)
                                <li class="splide__slide" >
                                    <div>
                                        <div class="relative mb-2" style="padding-bottom: 56.25%;">
                                            <img
                                                class="rounded-xl w-full absolute w-full h-full object-cover object-top"
                                                src="https://www.musora.com/musora-cdn/image/width=400,quality=95/{{$slide['img']}}"
                                                alt="{{$slide['title']}} img"
                                                fetchpriority="high"
                                            >
                                        </div>
                                        <p class="font-bold mb-1 leading-tight">{{$slide['title']}}</p>
                                        <p class="text-[#838C98] leading-tight">{{$slide['artist']}}</p>
                                    </div>
                                </li>
                            @endforeach
                        @endslot
                    @endcomponent
                </div>
            </div>
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


