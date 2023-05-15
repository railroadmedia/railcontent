@php
    require_once(resource_path('marketing/views/musora/pages/method-data.php'))
@endphp

@extends('musora._partials._features-layout')

@section('head-includes')
    <title></title>
    <meta property="og:title" content="">

    <meta name="description" content="">
    <meta property="og:description" content="">

    <meta property="og:url" content="https://www.musora.com/method">
    <meta property="og:image" content="">

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

@section('header-img', 'https://musora-center.s3.amazonaws.com/method/header-image.jpg')

@section('header', 'Your musical goals start here.')

@section('desc', 'Always know exactly what to practice with structured video lessons and courses featuring many of the world’s best teachers.')

<!-- Main -->
@section('page-body')
    <section class="py-10 md:py-12">
        <h3 class="text-center leading-tight mb-5"><strong>Your clear, frustration-free way to <br>learn ANY instrument.</strong></h3>
        <p class="text-center max-w-2xl mx-auto">
            Whether you’re learning to play the piano, guitar, drums or to sing, you’ll never have to wonder where to go next. Our 10-level curriculum of step-by-step lessons is your clear, specific path to go from total beginner to playing all your favorite songs.
        </p>
        <div class="container max-w-6xl lg:ml-auto lg:mr-0 xl:mx-auto px-6 xl:px-0">
            <div class="mb-10">
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
                                            src="https://www.musora.com/musora-cdn/image/width=400,quality=85/{{$method['img']}}"
                                            alt="lesson{{$key+1}} img"
                                            fetchpriority="high"
                                        >
                                        <div class="absolute inset-0 rotate-180 rounded-b-xl" style="background:linear-gradient(180deg, #85001E 0%, rgba(0, 0, 0, 0.5) 100%);"></div>
                                        <div class="absolute inset-0 flex flex-col justify-center items-center text-white text-5xl font-extrabold">
                                            <div>
                                                <img class="h-4 -mr-2" src="https://musora-center.s3.amazonaws.com/logos/pianote-logo-white.png" alt="pianote logo" /> <img class="h-4" src="https://dpwjbsxqtam5n.cloudfront.net/sales/2021/method-text.svg" alt="method logo" style="filter:brightness(0) invert(1)" />
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
                                            src="https://www.musora.com/musora-cdn/image/width=400,quality=85/{{$method['img']}}"
                                            loading="lazy"
                                            onload="this.classList.remove('opacity-0')"
                                            alt="lesson{{$key+1}} img"
                                        >
                                        <div class="absolute inset-0 rotate-180 rounded-b-xl" style="background:linear-gradient(180deg, #05816F 0%, rgba(0, 0, 0, 0.5) 100%);"></div>
                                        <div class="absolute inset-0 flex flex-col justify-center items-center text-white text-5xl font-extrabold">
                                            <div>
                                                <img class="h-4 -mr-2" src="https://musora-center.s3.amazonaws.com/logos/guitareo-logo-white.png" alt="guitareo logo" /> <img class="h-4" src="https://dpwjbsxqtam5n.cloudfront.net/sales/2021/method-text.svg" alt="method logo" style="filter:brightness(0) invert(1)" />
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
                                            src="https://www.musora.com/musora-cdn/image/width=400,quality=85/{{$method['img']}}"
                                            loading="lazy"
                                            onload="this.classList.remove('opacity-0')"
                                            alt="lesson{{$key+1}} img"
                                        >
                                        <div class="absolute inset-0 rotate-180 rounded-b-xl" style="background:linear-gradient(180deg, #095399 0%, rgba(0, 0, 0, 0.5) 100%);"></div>
                                        <div class="absolute inset-0 flex flex-col justify-center items-center text-white text-5xl font-extrabold">
                                            <div>
                                                <img class="h-4 -mr-2" src="https://musora-center.s3.amazonaws.com/logos/drumeo-logo-white.png" alt="drumeo logo" /> <img class="h-4" src="https://dpwjbsxqtam5n.cloudfront.net/sales/2021/method-text.svg" alt="method logo" style="filter:brightness(0) invert(1)" />
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
                                            src="https://www.musora.com/musora-cdn/image/width=400,quality=85/{{$method['img']}}"
                                            loading="lazy"
                                            onload="this.classList.remove('opacity-0')"
                                            alt="lesson{{$key+1}} img"
                                        >
                                        <div class="absolute inset-0 rotate-180 rounded-b-xl" style="background:TODO"></div>
                                        <div class="absolute inset-0 flex flex-col justify-center items-center text-white text-5xl font-extrabold">
                                            <div>
                                                <img class="h-4 -mr-2" src="https://musora-center.s3.amazonaws.com/logos/singeo-logo-white.png" alt="singeo logo" /> <img class="h-4" src="https://dpwjbsxqtam5n.cloudfront.net/sales/2021/method-text.svg" alt="method logo" style="filter:brightness(0) invert(1)" />
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
        <div class="container max-w-6xl lg:ml-auto lg:mr-0 xl:mx-auto px-6 xl:px-0">
            <h3 class="text-center leading-tight mb-5"><strong>Learn every technique, style & pattern.</strong></h3>
            <div class="text-center">
                <span class="uppercase btn-primary btn-small mr-1 md:mr-2 px-5 sm:px-8 md:px-12" :class="category.includes('all') ? 'bg-black text-white' : 'text-black border-black'" @click="category = 'all'">all</span>
                <span class="uppercase btn-primary btn-small md:mr-2 mb-2 md:mb-0 px-8 md:px-12" :class="category.includes('drumeo') ? 'bg-black text-white' : 'text-black border-black'" @click="category = 'drumeo'">drums</span> <br class="md:hidden">
                <span class="uppercase btn-primary btn-small mr-1 md:mr-2 px-5 sm:px-8 md:px-12" :class="category.includes('pianote') ? 'bg-black text-white' : 'text-black border-black'" @click="category = 'pianote'">piano</span>
                <span class="uppercase btn-primary btn-small mr-1 md:mr-2 px-5 sm:px-8 md:px-12" :class="category.includes('guitareo') ? 'bg-black text-white' : 'text-black border-black'" @click="category = 'guitareo'">guitar</span>
                <span class="uppercase btn-primary btn-small px-5 sm:px-8 md:px-12" :class="category.includes('singeo') ? 'bg-black text-white' : 'text-black border-black'" @click="category = 'singeo'">singing</span>
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
                                                src="https://www.musora.com/musora-cdn/image/width=400,quality=85/{{$slide['img']}}"
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
                                                src="https://www.musora.com/musora-cdn/image/width=400,quality=85/{{$slide['img']}}"
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
                                                src="https://www.musora.com/musora-cdn/image/width=400,quality=85/{{$slide['img']}}"
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
                                                src="https://www.musora.com/musora-cdn/image/width=400,quality=85/{{$slide['img']}}"
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
                                                src="https://www.musora.com/musora-cdn/image/width=400,quality=85/{{$slide['img']}}"
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

    @include('musora.sales.components.guarantee-section', [
        'badge' => 'https://musora-center.s3.amazonaws.com/logos/guarantee.jpg',
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


