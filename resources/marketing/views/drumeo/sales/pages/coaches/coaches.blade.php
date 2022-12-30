@php
    require_once(resource_path('marketing/views/drumeo/sales/pages/coaches/sliders.php'))
@endphp

@extends('drumeo.sales.pages.coaches-method-songs-layout')

@section('page-meta')
    <title>Drumeo | Study with the world’s best drummers.</title>
    <meta property="og:title" content="Drumeo | Study with the world’s best drummers.">
    <meta property="og:url" content="https://www.drumeo.com/coaches">
    <meta name="description" content="Amplify your skills with 200+ artist courses + access exclusive live events with drumming legends. ">
    <meta property="og:description" content="Amplify your skills with 200+ artist courses + access exclusive live events with drumming legends. ">
    <meta property="og:image" content="https://drumeo-assets.s3.amazonaws.com/sales/2023/method/share-image-coaches.jpg" style="display: none;">
@endsection

@section('header-img', 'https://drumeo-assets.s3.amazonaws.com/sales/2023/coaches-thumb.jpg')

@section('header', 'Study with the world’s best drummers.')

@section('desc', 'Amplify your skills with 200+ artist courses + access exclusive live events with drumming legends. ')

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
                <h4 class="font-extrabold mb-4">Legendary grooves</h4>
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
                        @foreach ($grooves as $slide)
                            <li class="splide__slide">
                                <div>
                                    <div class="relative mb-2" style="padding-bottom: 56.25%;">
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
                <a href="" class="mx-1 join blue smaller">Get started <i class="fas fa-arrow-right" aria-hidden="true"></i> </a>
            </div>
        </div>
    </section>

    {{--    @include('_partials.components.video-modal',[--}}
    {{--        'name' => 'trailer',--}}
    {{--        'video' => '772644658'--}}
    {{--    ])--}}
@stop

