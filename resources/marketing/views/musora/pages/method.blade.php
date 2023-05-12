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
                            <li class="splide__slide my-2">
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
    </section>
@endsection


