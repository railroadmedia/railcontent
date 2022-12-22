@php
    require_once(resource_path('marketing/views/pianote/sales/pages/coaches/sliders.php'))
@endphp

@extends('pianote.sales.pages.coaches-method-songs-layout')

@section('page-meta')

@endsection
<title>Pianote | </title>
<meta property="og:title" content="Pianote | ">
<meta property="og:url" content="https://www.pianote.com/method">
<meta name="description" content="">
<meta property="og:description" content="">
<meta property="og:image" content="" style="display: none;">


@section('header-img', 'https://pianote.s3.amazonaws.com/sales/2023/coaches-thumb.jpg')

@section('header', 'Study with the world’s best teachers.')

@section('desc', 'Amplify your skills with artist courses + exclusive live events with teachers, performers, and trending stars.')

@section('page-body')
    <section class="py-12 md:py-20">
        <div class="container max-w-6xl lg:ml-auto lg:mr-0 xl:mx-auto px-6 xl:px-0">
            <div class="mb-6">
                <h4 class="font-extrabold mb-4">Learn and Style</h4>
                @component('_partials.components.carousel',[
                    'xdata' => "
                        classes: {
                            arrow: 'hidden',
                            pagination: 'hidden',
                        },
                        perPage: 4,
                        perMove: 1,
                        gap: '0.5rem',
                        type: 'loop',
                        interval: 2000,
                        autoplay: true,
                        breakpoints: {
                            1160: {
                                perPage: 4,
                            },
                            900: {
                                perPage: 3,
                            },
                            700: {
                                perPage: 2,
                            },
                        },
                    ",
                ])
                    @slot('content')
                        @foreach ($learn as $slide)
                            <li class="splide__slide">
                                <div>
                                    <div class="relative mb-2 sm:mb-4" style="padding-bottom: 56.25%;">
                                        <img
                                            class="rounded-xl transition-opacity opacity-0 w-full absolute w-full h-full object-cover"
                                            src="https://cdn.musora.com/image/fetch/w_400,q_auto:best/{{$slide['img']}}"
                                            alt="{{$slide['title']}} img"
                                            loading="lazy"
                                            onload="this.classList.remove('opacity-0')"
                                            style="object-position: top;"
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
            <div class="mb-6">
                <h4 class="font-extrabold mb-4">Essential techniques</h4>
                @component('_partials.components.carousel',[
                    'xdata' => "
                        classes: {
                            arrow: 'hidden',
                            pagination: 'hidden',
                        },
                        perPage: 4,
                        perMove: 1,
                        gap: '0.5rem',
                        type: 'loop',
                        interval: 2000,
                        autoplay: true,
                        breakpoints: {
                            1160: {
                                perPage: 4,
                            },
                            900: {
                                perPage: 3,
                            },
                            700: {
                                perPage: 2,
                            },
                        },
                    ",
                ])
                    @slot('content')
                        @foreach ($techniques as $slide)
                            <li class="splide__slide">
                                <div>
                                    <div class="relative mb-2 sm:mb-4" style="padding-bottom: 56.25%;">
                                        <img
                                            class="rounded-xl transition-opacity opacity-0 w-full absolute w-full h-full object-cover"
                                            src="https://cdn.musora.com/image/fetch/w_400,q_auto:best/{{$slide['img']}}"
                                            alt="{{$slide['title']}} img"
                                            loading="lazy"
                                            onload="this.classList.remove('opacity-0')"
                                            style="object-position: top;"
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
            <div class="mb-6">
                <h4 class="font-extrabold mb-4">Play more creatively</h4>
                @component('_partials.components.carousel',[
                    'xdata' => "
                        classes: {
                            arrow: 'hidden',
                            pagination: 'hidden',
                        },
                        perPage: 4,
                        perMove: 1,
                        gap: '0.5rem',
                        type: 'loop',
                        interval: 2000,
                        autoplay: true,
                        breakpoints: {
                            1160: {
                                perPage: 4,
                            },
                            900: {
                                perPage: 3,
                            },
                            700: {
                                perPage: 2,
                            },
                        },
                    ",
                ])
                    @slot('content')
                        @foreach ($creativities as $slide)
                            <li class="splide__slide">
                                <div>
                                    <div class="relative mb-2 sm:mb-4" style="padding-bottom: 56.25%;">
                                        <img
                                            class="rounded-xl transition-opacity opacity-0 w-full absolute w-full h-full object-cover"
                                            src="https://cdn.musora.com/image/fetch/w_400,q_auto:best/{{$slide['img']}}"
                                            alt="{{$slide['title']}} img"
                                            loading="lazy"
                                            onload="this.classList.remove('opacity-0')"
                                            style="object-position: top;"
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
            <div class="mb-6">
                <h4 class="font-extrabold mb-4">The power of chords</h4>
                @component('_partials.components.carousel',[
                    'xdata' => "
                        classes: {
                            arrow: 'hidden',
                            pagination: 'hidden',
                        },
                        perPage: 4,
                        perMove: 1,
                        gap: '0.5rem',
                        type: 'loop',
                        interval: 2000,
                        autoplay: true,
                        breakpoints: {
                            1160: {
                                perPage: 4,
                            },
                            900: {
                                perPage: 3,
                            },
                            700: {
                                perPage: 2,
                            },
                        },
                    ",
                ])
                    @slot('content')
                        @foreach ($chords as $slide)
                            <li class="splide__slide">
                                <div>
                                    <div class="relative mb-2 sm:mb-4" style="padding-bottom: 56.25%;">
                                        <img
                                            class="rounded-xl transition-opacity opacity-0 w-full absolute w-full h-full object-cover"
                                            src="https://cdn.musora.com/image/fetch/w_400,q_auto:best/{{$slide['img']}}"
                                            alt="{{$slide['title']}} img"
                                            loading="lazy"
                                            onload="this.classList.remove('opacity-0')"
                                            style="object-position: top;"
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
            <div class="mb-6">
                <h4 class="font-extrabold mb-4">Or… anything else!</h4>
                @component('_partials.components.carousel',[
                    'xdata' => "
                        classes: {
                            arrow: 'hidden',
                            pagination: 'hidden',
                        },
                        perPage: 4,
                        perMove: 1,
                        gap: '0.5rem',
                        type: 'loop',
                        interval: 2000,
                        autoplay: true,
                        breakpoints: {
                            1160: {
                                perPage: 4,
                            },
                            900: {
                                perPage: 3,
                            },
                            700: {
                                perPage: 2,
                            },
                        },
                    ",
                ])
                    @slot('content')
                        @foreach ($anythingElse as $slide)
                            <li class="splide__slide">
                                <div>
                                    <div class="relative mb-2 sm:mb-4" style="padding-bottom: 56.25%;">
                                        <img
                                            class="rounded-xl transition-opacity opacity-0 w-full absolute w-full h-full object-cover"
                                            src="https://cdn.musora.com/image/fetch/w_400,q_auto:best/{{$slide['img']}}"
                                            alt="{{$slide['title']}} img"
                                            loading="lazy"
                                            onload="this.classList.remove('opacity-0')"
                                            style="object-position: top;"
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

        <div class="text-center">
            <h3 class="font-extrabold mb-6">More lessons & live events added every week.</h3>
            <a href="" class="mx-1 join bg-pianote smaller">Get started <i class="fas fa-arrow-right" aria-hidden="true"></i> </a>
        </div>
    </section>

    {{--    @include('_partials.components.video-modal',[--}}
    {{--        'name' => 'trailer',--}}
    {{--        'video' => '772644658'--}}
    {{--    ])--}}
@stop
