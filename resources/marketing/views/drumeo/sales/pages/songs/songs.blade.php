@php
    require_once(resource_path('marketing/views/drumeo/sales/pages/songs/sliders.php'))
@endphp

@extends('drumeo.sales.pages.coaches-method-songs-layout')

@section('page-meta')

@endsection
<title></title>
<meta property="og:title" content="">
<meta property="og:url" content="https://www.drumeo.com/">
<meta name="description" content="">
<meta property="og:description" content="">
<meta property="og:image" content="">

@section('body-data')
    x-data ='{
    trailer : false
    }'
@endsection

@section('header-img', 'https://drumeo-assets.s3.amazonaws.com/sales/2023/songs-thumb.jpg')

@section('header', 'Play your favorite songs.')

@section('desc', 'Get 5000+ note-for-note song breakdowns for every style, era, and skill with handy play-along tools')

@section('page-body')
    <section class="py-12 md:py-20">
        <div class="container max-w-6xl lg:ml-auto lg:mr-0 xl:mx-auto px-6 xl:px-0">
            <div class="mb-6">
                <h4 class="font-extrabold mb-4">90s Rock</h4>
                @component('_partials.components.carousel',[
                    'xdata' => "
                        classes: {
                            arrow: 'hidden',
                            pagination: 'hidden',
                        },
                        perPage: 6,
                        perMove: 1,
                        gap: '1rem',
                        type: 'loop',
                        interval: 2000,
                        autoplay: true,
                        breakpoints: {
                            1160: {
                                perPage: 5,
                            },
                            900: {
                                perPage: 4,
                            },
                            760: {
                                perPage: 3,
                            },
                            590: {
                                perPage: 2,
                            },
                        },
                    ",
                ])
                    @slot('content')
                        @foreach ($rock90s as $slide)
                            <li class="splide__slide">
                                <div>
                                    <img
                                        class="rounded-xl mb-1 transition-opacity opacity-0"
                                        src="https://cdn.musora.com/image/fetch/w_250,q_auto:best/{{$slide['img']}}"
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
                <h4 class="font-extrabold mb-4">Classic Rock</h4>
                @component('_partials.components.carousel',[
                    'xdata' => "
                        classes: {
                            arrow: 'hidden',
                            pagination: 'hidden',
                        },
                        perPage: 6,
                        perMove: 1,
                        gap: '1rem',
                        type: 'loop',
                        interval: 2000,
                        autoplay: true,
                        breakpoints: {
                            1160: {
                                perPage: 5,
                            },
                            900: {
                                perPage: 4,
                            },
                            760: {
                                perPage: 3,
                            },
                            590: {
                                perPage: 2,
                            },
                        },
                    ",
                ])
                    @slot('content')
                        @foreach ($rockClassic as $slide)
                            <li class="splide__slide">
                                <div>
                                    <img
                                        class="rounded-xl mb-1 transition-opacity opacity-0"
                                        src="https://cdn.musora.com/image/fetch/w_250,q_auto:best/{{$slide['img']}}"
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
                            arrow: 'hidden',
                            pagination: 'hidden',
                        },
                        perPage: 6,
                        perMove: 1,
                        gap: '1rem',
                        type: 'loop',
                        interval: 2000,
                        autoplay: true,
                        breakpoints: {
                            1160: {
                                perPage: 5,
                            },
                            900: {
                                perPage: 4,
                            },
                            760: {
                                perPage: 3,
                            },
                            590: {
                                perPage: 2,
                            },
                        },
                    ",
                ])
                    @slot('content')
                        @foreach ($rockModern as $slide)
                            <li class="splide__slide">
                                <div>
                                    <img
                                        class="rounded-xl mb-1 transition-opacity opacity-0"
                                        src="https://cdn.musora.com/image/fetch/w_250,q_auto:best/{{$slide['img']}}"
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
                <h4 class="font-extrabold mb-4">Metal</h4>
                @component('_partials.components.carousel',[
                    'xdata' => "
                        classes: {
                            arrow: 'hidden',
                            pagination: 'hidden',
                        },
                        perPage: 6,
                        perMove: 1,
                        gap: '1rem',
                        type: 'loop',
                        interval: 2000,
                        autoplay: true,
                        breakpoints: {
                            1160: {
                                perPage: 5,
                            },
                            900: {
                                perPage: 4,
                            },
                            760: {
                                perPage: 3,
                            },
                            590: {
                                perPage: 2,
                            },
                        },
                    ",
                ])
                    @slot('content')
                        @foreach ($metal as $slide)
                            <li class="splide__slide">
                                <div>
                                    <img
                                        class="rounded-xl mb-1 transition-opacity opacity-0"
                                        src="https://cdn.musora.com/image/fetch/w_250,q_auto:best/{{$slide['img']}}"
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
                <h4 class="font-extrabold mb-4">Pop</h4>
                @component('_partials.components.carousel',[
                    'xdata' => "
                        classes: {
                            arrow: 'hidden',
                            pagination: 'hidden',
                        },
                        perPage: 6,
                        perMove: 1,
                        gap: '1rem',
                        type: 'loop',
                        interval: 2000,
                        autoplay: true,
                        breakpoints: {
                            1160: {
                                perPage: 5,
                            },
                            900: {
                                perPage: 4,
                            },
                            760: {
                                perPage: 3,
                            },
                            590: {
                                perPage: 2,
                            },
                        },
                    ",
                ])
                    @slot('content')
                        @foreach ($pop as $slide)
                            <li class="splide__slide">
                                <div>
                                    <img
                                        class="rounded-xl mb-1 transition-opacity opacity-0"
                                        src="https://cdn.musora.com/image/fetch/w_250,q_auto:best/{{$slide['img']}}"
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
                            arrow: 'hidden',
                            pagination: 'hidden',
                        },
                        perPage: 6,
                        perMove: 1,
                        gap: '1rem',
                        type: 'loop',
                        interval: 2000,
                        autoplay: true,
                        breakpoints: {
                            1160: {
                                perPage: 5,
                            },
                            900: {
                                perPage: 4,
                            },
                            760: {
                                perPage: 3,
                            },
                            590: {
                                perPage: 2,
                            },
                        },
                    ",
                ])
                    @slot('content')
                        @foreach ($jazz as $slide)
                            <li class="splide__slide">
                                <div>
                                    <img
                                        class="rounded-xl mb-1 transition-opacity opacity-0"
                                        src="https://cdn.musora.com/image/fetch/w_250,q_auto:best/{{$slide['img']}}"
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
                <h4 class="font-extrabold mb-4">Blues</h4>
                @component('_partials.components.carousel',[
                    'xdata' => "
                        classes: {
                            arrow: 'hidden',
                            pagination: 'hidden',
                        },
                        perPage: 6,
                        perMove: 1,
                        gap: '1rem',
                        type: 'loop',
                        interval: 2000,
                        autoplay: true,
                        breakpoints: {
                            1160: {
                                perPage: 5,
                            },
                            900: {
                                perPage: 4,
                            },
                            760: {
                                perPage: 3,
                            },
                            590: {
                                perPage: 2,
                            },
                        },
                    ",
                ])
                    @slot('content')
                        @foreach ($blues as $slide)
                            <li class="splide__slide">
                                <div>
                                    <img
                                        class="rounded-xl mb-1 transition-opacity opacity-0"
                                        src="https://cdn.musora.com/image/fetch/w_250,q_auto:best/{{$slide['img']}}"
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
                            arrow: 'hidden',
                            pagination: 'hidden',
                        },
                        perPage: 6,
                        perMove: 1,
                        gap: '1rem',
                        type: 'loop',
                        interval: 2000,
                        autoplay: true,
                        breakpoints: {
                            1160: {
                                perPage: 5,
                            },
                            900: {
                                perPage: 4,
                            },
                            760: {
                                perPage: 3,
                            },
                            590: {
                                perPage: 2,
                            },
                        },
                    ",
                ])
                    @slot('content')
                        @foreach ($country as $slide)
                            <li class="splide__slide">
                                <div>
                                    <img
                                        class="rounded-xl mb-1 transition-opacity opacity-0"
                                        src="https://cdn.musora.com/image/fetch/w_250,q_auto:best/{{$slide['img']}}"
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
                <h4 class="font-extrabold mb-4">Hip Hop & Rap</h4>
                @component('_partials.components.carousel',[
                    'xdata' => "
                        classes: {
                            arrow: 'hidden',
                            pagination: 'hidden',
                        },
                        perPage: 6,
                        perMove: 1,
                        gap: '1rem',
                        type: 'loop',
                        interval: 2000,
                        autoplay: true,
                        breakpoints: {
                            1160: {
                                perPage: 5,
                            },
                            900: {
                                perPage: 4,
                            },
                            760: {
                                perPage: 3,
                            },
                            590: {
                                perPage: 2,
                            },
                        },
                    ",
                ])
                    @slot('content')
                        @foreach ($hiphop as $slide)
                            <li class="splide__slide">
                                <div>
                                    <img
                                        class="rounded-xl mb-1 transition-opacity opacity-0"
                                        src="https://cdn.musora.com/image/fetch/w_250,q_auto:best/{{$slide['img']}}"
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
                <h4 class="font-extrabold mb-4">Soul & Funk</h4>
                @component('_partials.components.carousel',[
                    'xdata' => "
                        classes: {
                            arrow: 'hidden',
                            pagination: 'hidden',
                        },
                        perPage: 6,
                        perMove: 1,
                        gap: '1rem',
                        type: 'loop',
                        interval: 2000,
                        autoplay: true,
                        breakpoints: {
                            1160: {
                                perPage: 5,
                            },
                            900: {
                                perPage: 4,
                            },
                            760: {
                                perPage: 3,
                            },
                            590: {
                                perPage: 2,
                            },
                        },
                    ",
                ])
                    @slot('content')
                        @foreach ($soul as $slide)
                            <li class="splide__slide">
                                <div>
                                    <img
                                        class="rounded-xl mb-1 transition-opacity opacity-0"
                                        src="https://cdn.musora.com/image/fetch/w_250,q_auto:best/{{$slide['img']}}"
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
            <div class="mb-10">
                <h4 class="font-extrabold mb-4">Worship</h4>
                @component('_partials.components.carousel',[
                    'xdata' => "
                        classes: {
                            arrow: 'hidden',
                            pagination: 'hidden',
                        },
                        perPage: 6,
                        perMove: 1,
                        gap: '1rem',
                        type: 'loop',
                        interval: 2000,
                        autoplay: true,
                        breakpoints: {
                            1160: {
                                perPage: 5,
                            },
                            900: {
                                perPage: 4,
                            },
                            760: {
                                perPage: 3,
                            },
                            590: {
                                perPage: 2,
                            },
                        },
                    ",
                ])
                    @slot('content')
                        @foreach ($worship as $slide)
                            <li class="splide__slide">
                                <div>
                                    <img
                                        class="rounded-xl mb-1 transition-opacity opacity-0"
                                        src="https://cdn.musora.com/image/fetch/w_250,q_auto:best/{{$slide['img']}}"
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
        </div>

        <div class="text-center">
            <h3 class="font-extrabold mb-6">Plus thousands more popular songs.</h3>
            <a href="" class="mx-1 join blue smaller">Get started <i class="fas fa-arrow-right" aria-hidden="true"></i> </a>
        </div>
    </section>

    {{--    @include('_partials.components.video-modal',[--}}
    {{--        'name' => 'trailer',--}}
    {{--        'video' => '772644658'--}}
    {{--    ])--}}
@stop
