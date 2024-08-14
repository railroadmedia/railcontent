@php
    require_once(resource_path('marketing/views/guitareo/sales/features/songs.php'))
@endphp

@extends('guitareo.sales.features.features-layout')

@section('page-meta')
    <title>Guitareo | Play your favorite songs.</title>
    <meta property="og:title" content="Guitareo | Play your favorite songs.">
    <meta property="og:url" content="https://www.guitareo.com/songs">
    <meta name="description" content="Note-for-note song breakdowns for every style, era, and skill level with handy play-along tools.">
    <meta property="og:description" content="Note-for-note song breakdowns for every style, era, and skill level with handy play-along tools.">
    <meta property="og:image" content="https://d122ay5chh2hr5.cloudfront.net/sales/2023/share-image-songs.jpg" style="display: none;">
@endsection

@section('body-data')
    x-data ='{
    soundslice : false
    }'
@endsection

@section('header-img', 'https://d122ay5chh2hr5.cloudfront.net/sales/2023/songs-thumb.jpg')

@section('header', 'Play your favorite songs.')

@section('desc', 'Note-for-note song breakdowns for every style, era, and skill level with handy play-along tools.')

@section('page-body')
    <section class="py-12 md:py-20">
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
                        @foreach ($classic as $slide)
                            <li class="splide__slide px-1">
                                <div>
                                    <img
                                        class="rounded-xl mb-1 transition-opacity opacity-0"
                                        src="https://www.musora.com/musora-cdn/image/width=250,quality=95/{{$slide['img']}}"
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
                <h4 class="font-extrabold mb-4">90s Rock</h4>
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
                        @foreach ($rock90s as $slide)
                            <li class="splide__slide px-1">
                                <div>
                                    <img
                                        class="rounded-xl mb-1 transition-opacity opacity-0"
                                        src="https://www.musora.com/musora-cdn/image/width=250,quality=95/{{$slide['img']}}"
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
                        @foreach ($modern as $slide)
                            <li class="splide__slide px-1">
                                <div>
                                    <img
                                        class="rounded-xl mb-1 transition-opacity opacity-0"
                                        src="https://www.musora.com/musora-cdn/image/width=250,quality=95/{{$slide['img']}}"
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
                <h4 class="font-extrabold mb-4">Acoustic</h4>
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
                        @foreach ($acoustic as $slide)
                            <li class="splide__slide px-1">
                                <div>
                                    <img
                                        class="rounded-xl mb-1 transition-opacity opacity-0"
                                        src="https://www.musora.com/musora-cdn/image/width=250,quality=95/{{$slide['img']}}"
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
                        @foreach ($blues as $slide)
                            <li class="splide__slide px-1">
                                <div>
                                    <img
                                        class="rounded-xl mb-1 transition-opacity opacity-0"
                                        src="https://www.musora.com/musora-cdn/image/width=250,quality=95/{{$slide['img']}}"
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
                <h4 class="font-extrabold mb-4">Folk</h4>
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
                        @foreach ($folk as $slide)
                            <li class="splide__slide px-1">
                                <div>
                                    <img
                                        class="rounded-xl mb-1 transition-opacity opacity-0"
                                        src="https://www.musora.com/musora-cdn/image/width=250,quality=95/{{$slide['img']}}"
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
                                        class="rounded-xl mb-1 transition-opacity opacity-0"
                                        src="https://www.musora.com/musora-cdn/image/width=250,quality=95/{{$slide['img']}}"
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
                                        class="rounded-xl mb-1 transition-opacity opacity-0"
                                        src="https://www.musora.com/musora-cdn/image/width=250,quality=95/{{$slide['img']}}"
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
                        @foreach ($pop as $slide)
                            <li class="splide__slide px-1">
                                <div>
                                    <img
                                        class="rounded-xl mb-1 transition-opacity opacity-0"
                                        src="https://www.musora.com/musora-cdn/image/width=250,quality=95/{{$slide['img']}}"
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
                <h4 class="font-extrabold mb-4">R&B/Soul</h4>
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
                        @foreach ($soul as $slide)
                            <li class="splide__slide px-1">
                                <div>
                                    <img
                                        class="rounded-xl mb-1 transition-opacity opacity-0"
                                        src="https://www.musora.com/musora-cdn/image/width=250,quality=95/{{$slide['img']}}"
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
                <h4 class="font-extrabold mb-4">Electronic</h4>
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
                        @foreach ($electronic as $slide)
                            <li class="splide__slide px-1">
                                <div>
                                    <img
                                        class="rounded-xl mb-1 transition-opacity opacity-0"
                                        src="https://www.musora.com/musora-cdn/image/width=250,quality=95/{{$slide['img']}}"
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
            <h3 class="font-extrabold mb-6">Plus hundreds more popular songs.</h3>
            <a href="/choose-plan" class="mx-1 join bg-guitareo smaller">Get started <i class="fas fa-arrow-right" aria-hidden="true"></i> </a>
        </div>
    </section>

    @include('_partials.components.video-modal',[
        'name' => 'soundslice',
        'video' => 'NXGlc',
        'soundslice' => true,
    ])
@stop
