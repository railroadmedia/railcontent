@php
    require_once(resource_path('marketing/views/pianote/sales/features/coaches.php'))
@endphp

@extends('pianote.sales.features.features-layout')

@section('page-meta')
    <title>Pianote | Study with the world’s best teachers.</title>
    <meta property="og:title" content="Pianote | Study with the world’s best teachers.">
    <meta property="og:url" content="https://www.pianote.com/coaches">
    <meta name="description" content="Amplify your skills with artist courses + exclusive live events with teachers, performers, and trending stars.">
    <meta property="og:description" content="Amplify your skills with artist courses + exclusive live events with teachers, performers, and trending stars.">
    <meta property="og:image" content="https://pianote.s3.amazonaws.com/sales/2023/share-image-coaches.jpg" style="display: none;">
@endsection

@section('header-img', 'https://pianote.s3.amazonaws.com/sales/2023/coaches-thumb.jpg')

@section('header', 'Study with the world’s best teachers.')

@section('desc', 'Amplify your skills with artist courses + exclusive live events with teachers, performers, and trending stars.')

@section('page-body')
    <section class="py-12 md:py-20">
        <div class="container max-w-6xl lg:ml-auto lg:mr-0 xl:mx-auto px-6 xl:px-0">
            <div class="mb-6">
                <h4 class="font-extrabold mb-4">Learn any Style</h4>
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
                        @foreach ($learn as $slide)
                            <li class="splide__slide">
                                <div>
                                    <div class="relative mb-2" style="padding-bottom: 56.25%;">
                                        <img
                                            class="rounded-xl transition-opacity opacity-0 w-full absolute w-full h-full object-cover"
                                            src="https://www.musora.com/musora-cdn/image/width=400,quality=85/{{$slide['img']}}"
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
                        @foreach ($techniques as $slide)
                            <li class="splide__slide">
                                <div>
                                    <div class="relative mb-2" style="padding-bottom: 56.25%;">
                                        <img
                                            class="rounded-xl transition-opacity opacity-0 w-full absolute w-full h-full object-cover"
                                            src="https://www.musora.com/musora-cdn/image/width=400,quality=85/{{$slide['img']}}"
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
                        @foreach ($creativities as $slide)
                            <li class="splide__slide">
                                <div>
                                    <div class="relative mb-2" style="padding-bottom: 56.25%;">
                                        <img
                                            class="rounded-xl transition-opacity opacity-0 w-full absolute w-full h-full object-cover"
                                            src="https://www.musora.com/musora-cdn/image/width=400,quality=85/{{$slide['img']}}"
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
                        @foreach ($chords as $slide)
                            <li class="splide__slide">
                                <div>
                                    <div class="relative mb-2" style="padding-bottom: 56.25%;">
                                        <img
                                            class="rounded-xl transition-opacity opacity-0 w-full absolute w-full h-full object-cover"
                                            src="https://www.musora.com/musora-cdn/image/width=400,quality=85/{{$slide['img']}}"
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
                        @foreach ($anythingElse as $slide)
                            <li class="splide__slide">
                                <div>
                                    <div class="relative mb-2" style="padding-bottom: 56.25%;">
                                        <img
                                            class="rounded-xl transition-opacity opacity-0 w-full absolute w-full h-full object-cover"
                                            src="https://www.musora.com/musora-cdn/image/width=400,quality=85/{{$slide['img']}}"
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
                <a href="/choose-plan" class="mx-1 join bg-pianote smaller">Get started <i class="fas fa-arrow-right" aria-hidden="true"></i> </a>
            </div>
        </div>
    </section>
@stop
