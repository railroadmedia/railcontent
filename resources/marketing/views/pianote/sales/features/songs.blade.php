@php
    require_once(resource_path('marketing/views/pianote/sales/features/songs.php'))
@endphp

@extends('pianote.sales.features.features-layout')

@section('page-meta')
    <title>Pianote | Play your favorite songs.</title>
    <meta property="og:title" content="Pianote | Play your favorite songs.">
    <meta property="og:url" content="https://www.pianote.com/songs">
    <meta name="description" content="1000+ note-for-note song breakdowns for every style, era, and skill level with handy play-along tools.">
    <meta property="og:description" content="1000+ note-for-note song breakdowns for every style, era, and skill level with handy play-along tools.">
    <meta property="og:image" content="https://pianote.s3.amazonaws.com/sales/2023/share-image-songs.jpg" style="display: none;">
@endsection

@section('body-data')
    x-data ='{
    soundslice : false
    }'
@endsection

@section('header-img', 'https://pianote.s3.amazonaws.com/sales/2023/songs-thumb2.jpg')

@section('header', 'Play your favorite songs.')

@section('desc', '1000+ note-for-note song breakdowns for every style, era, and skill level with handy play-along tools.')

@section('page-body')
    <section class="py-12 md:py-20">
        <div class="container max-w-6xl lg:ml-auto lg:mr-0 xl:mx-auto px-6 xl:px-0">
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
                        @foreach ($classics as $slide)
                            <li class="splide__slide px-1">
                                <div>
                                    <img
                                        class="rounded-xl mb-1 transition-opacity opacity-0"
                                        src="https://www.musora.com/musora-cdn/image/width=250,quality=85/{{$slide['img']}}"
                                        alt="{{$slide['title']}} img"
                                        loading="lazy"
                                        onload="this.classList.remove('opacity-0')"
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
                        @foreach ($modernPops as $slide)
                            <li class="splide__slide px-1">
                                <div>
                                    <img
                                        class="rounded-xl mb-1 transition-opacity opacity-0"
                                        src="https://www.musora.com/musora-cdn/image/width=250,quality=85/{{$slide['img']}}"
                                        alt="{{$slide['title']}} img"
                                        loading="lazy"
                                        onload="this.classList.remove('opacity-0')"
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
                <h4 class="font-extrabold mb-4">Classical</h4>
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
                        @foreach ($classicals as $slide)
                            <li class="splide__slide px-1">
                                <div>
                                    <img
                                        class="rounded-xl mb-1 transition-opacity opacity-0"
                                        src="https://www.musora.com/musora-cdn/image/width=250,quality=85/{{$slide['img']}}"
                                        alt="{{$slide['title']}} img"
                                        loading="lazy"
                                        onload="this.classList.remove('opacity-0')"
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
                                        class="rounded-xl mb-1 transition-opacity opacity-0"
                                        src="https://www.musora.com/musora-cdn/image/width=250,quality=85/{{$slide['img']}}"
                                        alt="{{$slide['title']}} img"
                                        loading="lazy"
                                        onload="this.classList.remove('opacity-0')"
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
{{--                        perPage: 6,--}}
{{--                        perMove: 1,--}}
{{--                        type: 'loop',--}}
{{--                        interval: 2000,--}}
{{--                        breakpoints: {--}}
{{--                            1024: {--}}
{{--                                perPage: 5,--}}
{{--                            },--}}
{{--                            768: {--}}
{{--                                perPage: 3,--}}
{{--                            },--}}
{{--                            640: {--}}
{{--                                perPage: 2,--}}
{{--                            },--}}
{{--                        },--}}
{{--                    ",--}}
{{--                ])--}}
{{--                    @slot('content')--}}
{{--                        @foreach ($musicals as $slide)--}}
{{--                            <li class="splide__slide px-1">--}}
{{--                                <div>--}}
{{--                                    <img--}}
{{--                                        class="rounded-xl mb-1 transition-opacity opacity-0"--}}
{{--                                        src="https://www.musora.com/musora-cdn/image/width=250,quality=85/{{$slide['img']}}"--}}
{{--                                        alt="{{$slide['title']}} img"--}}
{{--                                        loading="lazy"--}}
{{--                                        onload="this.classList.remove('opacity-0')"--}}
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
{{--                <h4 class="font-extrabold mb-4">Disney</h4>--}}
{{--                @component('_partials.components.carousel',[--}}
{{--                    'xdata' => "--}}
{{--                        classes: {--}}
{{--                            arrow: 'splide__arrow bg-white opacity-100 top-[38%] shadow-lg h-11 w-11',--}}
{{--                            prev: 'hidden',--}}
{{--                            next: 'splide__arrow--next your-class-next hidden sm:flex z-50 -right-1',--}}
{{--                            pagination: 'hidden',--}}
{{--                        },--}}
{{--                        perPage: 6,--}}
{{--                        perMove: 1,--}}
{{--                        type: 'loop',--}}
{{--                        interval: 2000,--}}
{{--                        breakpoints: {--}}
{{--                            1024: {--}}
{{--                                perPage: 5,--}}
{{--                            },--}}
{{--                            768: {--}}
{{--                                perPage: 3,--}}
{{--                            },--}}
{{--                            640: {--}}
{{--                                perPage: 2,--}}
{{--                            },--}}
{{--                        },--}}
{{--                    ",--}}
{{--                ])--}}
{{--                    @slot('content')--}}
{{--                        @foreach ($disney as $slide)--}}
{{--                            <li class="splide__slide px-1">--}}
{{--                                <div>--}}
{{--                                    <img--}}
{{--                                        class="rounded-xl mb-1 transition-opacity opacity-0"--}}
{{--                                        src="https://www.musora.com/musora-cdn/image/width=250,quality=85/{{$slide['img']}}"--}}
{{--                                        alt="{{$slide['title']}} img"--}}
{{--                                        loading="lazy"--}}
{{--                                        onload="this.classList.remove('opacity-0')"--}}
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
                <h4 class="font-extrabold mb-4">Rock Classics</h4>
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
                        @foreach ($rockClassics as $slide)
                            <li class="splide__slide px-1">
                                <div>
                                    <img
                                        class="rounded-xl mb-1 transition-opacity opacity-0"
                                        src="https://www.musora.com/musora-cdn/image/width=250,quality=85/{{$slide['img']}}"
                                        alt="{{$slide['title']}} img"
                                        loading="lazy"
                                        onload="this.classList.remove('opacity-0')"
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
                                        class="rounded-xl mb-1 transition-opacity opacity-0"
                                        src="https://www.musora.com/musora-cdn/image/width=250,quality=85/{{$slide['img']}}"
                                        alt="{{$slide['title']}} img"
                                        loading="lazy"
                                        onload="this.classList.remove('opacity-0')"
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
                                        class="rounded-xl mb-1 transition-opacity opacity-0"
                                        src="https://www.musora.com/musora-cdn/image/width=250,quality=85/{{$slide['img']}}"
                                        alt="{{$slide['title']}} img"
                                        loading="lazy"
                                        onload="this.classList.remove('opacity-0')"
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
                <h4 class="font-extrabold mb-4">R&B</h4>
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
                        @foreach ($rhythmandblues as $slide)
                            <li class="splide__slide px-1">
                                <div>
                                    <img
                                        class="rounded-xl mb-1 transition-opacity opacity-0"
                                        src="https://www.musora.com/musora-cdn/image/width=250,quality=85/{{$slide['img']}}"
                                        alt="{{$slide['title']}} img"
                                        loading="lazy"
                                        onload="this.classList.remove('opacity-0')"
                                    >
                                    <p class="font-bold mb-1 leading-tight">{{$slide['title']}}</p>
                                    <p class="text-[#838C98] leading-tight">{{$slide['artist']}}</p>
                                </div>
                            </li>
                        @endforeach
                    @endslot
                @endcomponent
            </div>
{{--            <div class="mb-10">--}}
{{--                <h4 class="font-extrabold mb-4">Worship</h4>--}}
{{--                @component('_partials.components.carousel',[--}}
{{--                    'xdata' => "--}}
{{--                        classes: {--}}
{{--                            arrow: 'splide__arrow bg-white opacity-100 top-[38%] shadow-lg h-11 w-11',--}}
{{--                            prev: 'hidden',--}}
{{--                            next: 'splide__arrow--next your-class-next hidden sm:flex z-50 -right-1',--}}
{{--                            pagination: 'hidden',--}}
{{--                        },--}}
{{--                        perPage: 6,--}}
{{--                        perMove: 1,--}}
{{--                        type: 'loop',--}}
{{--                        interval: 2000,--}}
{{--                        breakpoints: {--}}
{{--                            1024: {--}}
{{--                                perPage: 5,--}}
{{--                            },--}}
{{--                            768: {--}}
{{--                                perPage: 3,--}}
{{--                            },--}}
{{--                            640: {--}}
{{--                                perPage: 2,--}}
{{--                            },--}}
{{--                        },--}}
{{--                    ",--}}
{{--                ])--}}
{{--                    @slot('content')--}}
{{--                        @foreach ($worship as $slide)--}}
{{--                            <li class="splide__slide px-1">--}}
{{--                                <div>--}}
{{--                                    <img--}}
{{--                                        class="rounded-xl mb-1 transition-opacity opacity-0"--}}
{{--                                        src="https://www.musora.com/musora-cdn/image/width=250,quality=85/{{$slide['img']}}"--}}
{{--                                        alt="{{$slide['title']}} img"--}}
{{--                                        loading="lazy"--}}
{{--                                        onload="this.classList.remove('opacity-0')"--}}
{{--                                    >--}}
{{--                                    <p class="font-bold mb-1 leading-tight">{{$slide['title']}}</p>--}}
{{--                                    <p class="text-[#838C98] leading-tight">{{$slide['artist']}}</p>--}}
{{--                                </div>--}}
{{--                            </li>--}}
{{--                        @endforeach--}}
{{--                    @endslot--}}
{{--                @endcomponent--}}
{{--            </div>--}}
{{--        </div>--}}

            <div class="text-center">
                <h3 class="font-extrabold mb-6">Plus hundreds more popular songs.</h3>
                <a href="/choose-plan" class="mx-1 join bg-pianote smaller">Get started <i class="fas fa-arrow-right" aria-hidden="true"></i> </a>
            </div>
        </div>
    </section>

    @include('_partials.components.video-modal',[
        'name' => 'soundslice',
        'video' => '77f4c',
        'soundslice' => true,
    ])
@stop
