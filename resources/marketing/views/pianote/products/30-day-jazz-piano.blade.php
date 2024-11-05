@php
    require_once(resource_path('marketing/views/pianote/_partials/homepage-data.php'));
@endphp
@extends('pianote._partials.global-layout')

@section('global-head')
    @parent
    <title>30-Day Jazz Piano | Pianote</title>
    <meta property="og:title" content="30 Day Jazz Piano | Pianote">
    <meta name="description" content="Discover the beautiful, exciting world of jazz piano.">
    <meta property="og:description" content="Discover the beautiful, exciting world of jazz piano.">
    <meta property="og:image" content="https://d21q7xesnoiieh.cloudfront.net/fit-in/1200x0/filters:quality(95)/marketing/pianote/products/30-day-jazz-piano/share-image.jpg" style="display: none;">
    <meta property="og:url" content="https://www.pianote.com/{{ Request::path() }}">

    @include('_partials.layout._fonts')
    <link rel="stylesheet" href="{{ mix('marketing/css/app.css') }}">
    <link href="{{ asset('/marketing/css/tailwind-helpers.css') }}" rel="stylesheet">
    <link href="{{ asset('/marketing/parcel/drumeo/nav-footer-pianote.css') }}" rel="stylesheet">
    <link href="{{ asset('/marketing/parcel/drumeo/30dd.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('/marketing/css/animate.css') }}">
    <style>

        [placeholder]:focus::-webkit-input-placeholder {
            color:transparent
        }
        .container-video {
        background: linear-gradient(0deg, white 50%, #EFF7FF 50%);
        }
        .timeline-container.pianote:after {
            background-color: #F61A30;
        }
        .timeline-container.pianote .timeline:after {
            background-color: #F61A30;
        }
    </style>
@stop()

@section('body-data')
    x-data ='{
        trailer : false,
        testimonial: false,
    }'
@endsection

@section('global-body')
    @include('pianote.sales.partials._nav', [
        "cartVersion" => true
    ])
    @include('_partials.components.shop.promo-banner-3', [
        "name" => "30-Day Jazz Piano",
        "fullPrice" => floatval($productPrices['30-day-jazz-piano']->price),
        "price" => floatval($productPrices['30-day-jazz-piano']->discounted_price),
        "noBreadcrumb" => true
    ])


        @php
            $price = floatval($productPrices['30-day-jazz-piano']->price);
            $discountedPrice = floatval($productPrices['30-day-jazz-piano']->discounted_price);
            $enrollmentLink = '/ecommerce/add-to-cart?products[30-day-jazz]=1';
            $brandTitle = 'Pianote';
            $buttonText = 'GET STARTED';
            $buttonLink = "/ecommerce/add-to-cart?products[30-day-jazz]=1";
            $studentProfilesImage = 'https://d21q7xesnoiieh.cloudfront.net/fit-in/100x0/filters:quality(95)/marketing/pianote/products/30-day-blues/piano-players-trusted.png';
            $numStudents =  number_format($nPackOwners ?? 0);
            $students = 'piano players';
        @endphp

<header 
    class="px-5 sm:px-6 pt-6 md:pt-9 pb-12 md:pb-18 overflow-hidden" 
    style="background: linear-gradient(rgba(239, 247, 255, 1) 50%, #ffffff 50%)"
    x-data="{
        loadAlternateSrc(src) {
            this.$refs.playToLearnVideo.src = src;
        },
        videoLoaded: false
    }">
    <div class="container max-w-xl lg:max-w-3xl xl:max-w-4xl mx-auto">
        <div class="flex flex-col items-center text-center">
            <img 
                class="h-16 sm:h-20 lg:h-24 -mb-3 sm:mb-0 py-1"
                src="https://d21q7xesnoiieh.cloudfront.net/fit-in/770x0/marketing/pianote/products/30-day-jazz-piano/logo.webp"
                alt="30 day Jazz logo"
                fetchpriority="high">

            <div class="w-full">
                <h1 class="rotater-text overflow-hidden">
                    <strong>
                        <span>Learn Jazz Piano</span>
                    </strong>
                </h1>
                <h2 class="-mt-3 sm:-mt-1 lg:mt-0 mb-4">in just 30 days.</h2>
            </div>

            @php
            $checklist = [
                'Learn By<br class="block md:hidden"> Doing',
                'Play Every<br class="block md:hidden"> Day',
                'Perfect For<br class="block md:hidden"> Beginners'
            ];
            @endphp
            <div class="w-full flex flex-row justify-evenly md:justify-center items-center gap-4 lg:gap-10 lg:py-2">
                @foreach($checklist as $item)
                    <div class="flex flex-col md:flex-row items-center text-center gap-2">
                        <i class="fas fa-check-circle text-pianote text-md"></i>
                        <p class="text-sm md:text-base">{!! $item !!}</p>
                    </div>
                @endforeach
            </div>
        </div>

        <div class="py-5 sm:py-6 relative">
            <div class="absolute top-1/2 left-0 transform -translate-x-full -translate-y-1/2 px-4 lg:px-8 hidden sm:block">
                <img src="https://d21q7xesnoiieh.cloudfront.net/fit-in/800x0/filters:quality(95)/marketing/pianote/products/30-day-jazz-piano/sale/header-left-collage.webp" 
                    alt="in just 30 days." 
                    class="h-56 lg:h-72" 
                    fetchpriority="high">
            </div>

            <div class="aspect-16:9 cursor-pointer rounded-xl autoplay-video overflow-hidden w-full relative"
                x-on:click="trailer = true;" 
                role="button">
                <i class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 fa fa-play play-button z-10"></i>

                <div x-data="{ videoLoaded: false }">
                    <img src="https://i.vimeocdn.com/video/1938445145-3e0a0393c34442f22141b7c97e37be6a0b0050458e1dd51e67104f3e6b829fd4-d?mw=80&q=85" 
                        alt="Blurred Poster Image" 
                        class="rounded-xl overflow-hidden object-cover w-full h-full absolute z-0 blur-xl" 
                        x-show="!videoLoaded">

                    <video class="rounded-xl overflow-hidden object-cover w-full h-full absolute z-0"
                        x-ref="playToLearnVideo"
                        x-on:error="loadAlternateSrc('https://player.vimeo.com/progressive_redirect/playback/884916532/rendition/540p/file.mp4?loc=external&signature=f1a2096ed4a6bdaa8ff4b8a69b7787e5cc14ae0bec918c278337772f2dea1edd')"
                        x-intersect.once="videoLoaded = true; $refs.playToLearnVideo.src = $refs.playToLearnVideo.dataset.src;"
                        x-effect="if (videoLoaded) { $refs.playToLearnVideo.play(); }"
                        data-src="https://player.vimeo.com/progressive_redirect/playback/1019964518/rendition/720p/file.mp4?loc=external&signature=8761cea606fb7cd3fc2ab56f243ec6a61fa103fe9217eee47d4d172417f94679"
                        type="video/mp4"
                        muted
                        loop
                        playsinline
                        preload="auto"
                        fetchpriority="high">
                        <source src="https://player.vimeo.com/progressive_redirect/playback/1019964518/rendition/720p/file.mp4?loc=external&signature=8761cea606fb7cd3fc2ab56f243ec6a61fa103fe9217eee47d4d172417f94679" type="video/mp4">
                    </video>
                </div>
            </div>

            <div class="absolute top-1/2 right-0 transform translate-x-full -translate-y-1/2 px-4 lg:px-8 hidden sm:block">
                <img src="https://d21q7xesnoiieh.cloudfront.net/fit-in/800x0/filters:quality(95)/marketing/pianote/products/30-day-jazz-piano/sale/header-right-collage.webp" 
                    alt="in just 30 days." 
                    class="h-56 lg:h-72" 
                    fetchpriority="high">
            </div>
        </div>

        <div class="flex w-full flex-col text-center items-center mt-6 sm:mt-5 lg:mt-10">
            <a href="{{$buttonLink}}" class="join pianote medium w-full max-w-[350px] mb-3" role="button">Get started</a>
            <h5 class="leading-tight text-center">
                <strong class="font-black">Only
                    @if($price > $discountedPrice)
                        <s class="opacity-60">${{ $price }}</s> ${{ $discountedPrice }} (SAVE {{ round(100 - (100 * ($discountedPrice / $price))) }}%)
                    @else
                        ${{ $discountedPrice }}
                    @endif
                </strong>
            </h5>
        </div>
    </div>
</header>

<section class="text-center px-5 sm:px-6 py-10 sm:py-14 lg:py-20" style="background-color:#FFFFFF;">
    <div class="container max-w-4xl mx-auto">
        <h2 class="leading-tight mb-12 lg:mb-16"><strong>Discover the beautiful, exciting <br> world of jazz piano.</strong></h2>
        @php
                $gettings = [
                    [
                        'position' => 'left',
                        'img' =>
                            'https://d21q7xesnoiieh.cloudfront.net/fit-in/900x0/filters:quality(95)/marketing/pianote/products/30-day-jazz-piano/sale/features-01.webp',
                        'title' => 'Know what to learn, and when.',
                        'desc' =>
                            'Jazz, like life, is all about the journey. 30-Day Jazz Piano shows you the exact steps and skills to work on – in the perfect order for jazz beginners. All you have to do is play along!',
                    ],
                    [
                        'position' => 'right',
                        'img' =>
                            'https://d21q7xesnoiieh.cloudfront.net/fit-in/900x0/filters:quality(95)/marketing/pianote/products/30-day-jazz-piano/sale/features-02.webp',
                        'title' => 'Fits any schedule.',
                        'desc' =>
                            'Can you really learn jazz piano in just 10 minutes a day? Yes, you can! 30-Day Jazz Piano is perfect for any schedule. And you’ll be playing REAL jazz right from Day 1.',
                    ],
                    [
                        'position' => 'left',
                        'img' =>
                            'https://d21q7xesnoiieh.cloudfront.net/fit-in/900x0/filters:quality(95)/marketing/pianote/products/30-day-jazz-piano/sale/features-03.webp',
                        'title' => 'Build your skills.',
                        'desc' =>
                            'You’ll start off with jazz basics. Next, you’ll move on to comping and the walking bass line. Finally, you’ll put all your techniques together to play an original jazz standard written by Kevin Castro!',
                    ],
                    [
                        'position' => 'right',
                        'img' =>
                            'https://d21q7xesnoiieh.cloudfront.net/fit-in/900x0/filters:quality(95)/marketing/pianote/products/30-day-jazz-piano/sale/features-04.webp',
                        'title' => 'Lifetime Access',
                        'desc' =>
                            '30-Day Jazz Piano is yours for LIFE. It’s designed to be completed in 30 days, but you can take your time and come back to it as often as you like. Your access will never expire.',
                    ],
                ];
        @endphp
        <div class="timeline-container pianote max-w-4xl lg:max-w-4xl mx-auto relative px-4">
            @foreach ($gettings as $key => $getting)
                @if ($getting['position'] === 'right')
                    <div
                        class="timeline relative flex flex-col-reverse md:grid md:grid-cols-2 gap-4 md:gap-14 lg:gap-20 mb-16 md:mb-20">
                        <div class="content relative text-left sm:pl-10 md:pl-0">
                            <h4 class="mb-2 md:mb-5 mt-1 md:mt-0"><strong>{{ $getting['title'] }}</strong></h4>
                            <p class="text-[#2A2F34]">{{ $getting['desc'] }}</p>
                        </div>
                        <img class="-mt-7 rounded-lg transition-opacity opacity-0" loading="lazy"
                            onload="this.classList.remove('opacity-0')" src="{{ $getting['img'] }}"
                            alt="{{ $getting['title'] }}" />
                    </div>
                @else
                    <div
                        class="timeline relative flex flex-col md:grid md:grid-cols-2 gap-4 md:gap-14 lg:gap-20 @if(!$loop->last) mb-16 md:mb-20 @else md:mb-0 @endif">
                        @if (empty($getting['special']))
                            <img class="-mt-7 rounded-lg transition-opacity opacity-0" loading="lazy"
                                onload="this.classList.remove('opacity-0')" src="{{ $getting['img'] }}"
                                alt="{{ $getting['title'] }}" />
                        @else
                            <div class="-mt-7 rounded-lg bg-cover bg-center relative aspect-16:9"
                                style="background-image:url('{{ $getting['img'] }}')"></div>
                        @endif
                        <div class="content relative text-left sm:pl-10 md:pl-0 md:mb-10">
                            <h4 class="mb-2 md:mb-5 mt-1 md:mt-0"><strong>{{ $getting['title'] }}</strong></h4>
                            <p class="text-[#2A2F34]">{{ $getting['desc'] }}</p>
                        </div>
                    </div>
                @endif
            @endforeach
        </div>
    </div>
</section>

@php
$items = [
            'Daily guided workouts',
            'Flexible schedule',
            '90-day money-back guarantee',
        ]
@endphp

<section class="text-center bg-blue-50">
    <div class="container max-w-4xl mx-auto px-6 pt-10 lg:pt-20">
        <div class="flex flex-wrap md:flex-nowrap items-center justify-center pb-4">
            <img class="h-32 md:h-60 py-4 p-2 opacity-0"
                src="https://d21q7xesnoiieh.cloudfront.net/fit-in/770x0/marketing/pianote/products/30-day-jazz-piano/logo.webp"
                loaf="lazy" onload="this.classList.remove('opacity-0')" alt="30 day jazz logo">
            <ul class="pl-6">
                @foreach ($items as $item)
                    <li>
                        <h5 class="leading-loose text-left py-1">
                        <i class="fas fa-sharp fa-solid fa-circle-check text-{{ $brand }} mr-5" aria-hidden="true"></i>{{ $item }}</h5>
                    </li>
                @endforeach
            </ul>
        </div>
        <a href="{{$buttonLink}}" class="join pianote medium w-full sm:w-1/2 md:w-1/3 max-w-[350px] mt-6 sm:mt-12 mb-3 anchor-slide" role="button">Enroll Now</a><br>
            {{-- <div class="flex flex-row items-center py-2">
                     @if ($numStudents > 500)
                    <img class="h-7 mr-2" alt="Joined Student Profiles" src={{ $studentProfilesImage }}>
                    <span class="inline-block align-middle leading-tight text-xs">Join
                        {{ $numStudents }} {{ $students }} who<br> have already registered.
                    </span>
                    @endif
                </div> --}}
        </div>
      <h5 class="leading-tight">
            <strong class="font-black">Only
            @if($price > $discountedPrice)
                    <s class="opacity-60">${{ $price }}</s> ${{ $discountedPrice }} (SAVE {{ round(100 - (100 * ($discountedPrice / $price))) }}%)
            @else
                ${{ $discountedPrice }}
            @endif
            </strong>
        </h5>
    </div>
</section>

<section x-data="{ visible: false }"
         x-intersect.once="visible = true;"
         class="container-video pt-10">
    <div class="container max-w-4xl mx-auto flex flex-col items-center md:pt-10 text-center px-6">
        <div class="aspect-16:9 cursor-pointer rounded-xl autoplay-video overflow-hidden w-full relative"
            x-on:click="testimonial = true;" role="button">
            {{-- <i
                class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 fas fa-play play-button z-10"></i> --}}
            <img class="absolute inset-0 rounded-xl overflow-hidden object-cover w-full h-full absolute z-0"
                src="https://d21q7xesnoiieh.cloudfront.net/fit-in/1200x0/filters:quality(95)/marketing/pianote/products/30-day-jazz-piano/sale/thumb.webp"
                alt="testimonial image" fetchpriority="high" />
           

        </div>
    </div>
</section>

<section class="text-center px-5 sm:px-6 py-10 sm:py-14 lg:py-20">
    <div class="container max-w-6xl mx-auto">
        <h2 class="mb-6 sm:mb-10 lg:mb-10">
            <img
                class="h-16 sm:h-24 align-bottom transition-opacity opacity-0 md:mr-1"
                loading="lazy"
                onload="this.classList.remove('opacity-0')"
                src="https://d21q7xesnoiieh.cloudfront.net/fit-in/770x0/filters:quality(95)/marketing/pianote/products/30-day-jazz-piano/logo.webp"
                alt="30-Day Jazz Logo"
            >
            <strong> is designed for:</strong>
        </h2>

        @php
            $pianoPlayers = [
                [
                    'image' => 'https://d21q7xesnoiieh.cloudfront.net/fit-in/900x0/filters:quality(95)/marketing/pianote/products/30-day-jazz-piano/sale/beginner.webp',
                    'title' => 'Beginner',
                    'description' => 'Just starting out on the piano? You can still swing! Some of the workouts in 30-Day Jazz Piano might feel a bit challenging, but Kevin shows you how to simplify them with a few modifications.',
                ],
                [
                    'image' => 'https://d21q7xesnoiieh.cloudfront.net/fit-in/900x0/filters:quality(95)/marketing/pianote/products/30-day-jazz-piano/sale/intermediate.webp',
                    'title' => 'Intermediate',
                    'description' => 'If you’re already comfortable on the keyboard and want to start exploring the world of jazz, this challenge is perfect! In just 30 days, you’ll learn techniques that’ll help you sound like a jazz pianist.',
                ],
                [
                    'image' => 'https://d21q7xesnoiieh.cloudfront.net/fit-in/900x0/filters:quality(95)/marketing/pianote/products/30-day-jazz-piano/sale/advanced.webp',
                    'title' => 'Advanced',
                    'description' => 'You’ve got a bunch of classical pieces under your fingers. But you’re looking to break away from sheet music and try something a little more… cool. In just 10 minutes a day, 30-Day Jazz Piano will help you play jazz with confidence.',
                ],
            ];
        @endphp

        <div class="grid grid-cols-1 sm:grid-cols-3 gap-3 lg:gap-5 text-left">
            @foreach ($pianoPlayers as $pianoPlayer)
                <div class="flex flex-col">
                    <div class="relative w-full rounded-xl overflow-hidden">
                        <div class="relative w-full pb-[56.25%]">
                            <div 
                                class="absolute inset-0 w-full h-full bg-cover bg-center"
                                style="background-image: url('{{ $pianoPlayer['image'] }}')"
                            >
                                <div class="absolute inset-0"></div>
                                <div class="absolute bottom-1 w-full text-center text-white z-10">
                                    <i class="fa-duotone fa-check-circle text-3xl sm:text-xl md:text-3xl" style="--fa-primary-color: #ffffff; --fa-secondary-color: #F61A30; --fa-secondary-opacity: 1;"></i>                                    
                                     <h6 class="text-2xl sm:text-xs lg:text-xl leading-normal">
                                        <strong class="block leading-tight">{!! $pianoPlayer['title'] !!}</strong>
                                        <strong class="block leading-tight">Piano Players</strong>
                                    </h6>
                                </div>
                            </div>
                        </div>
                    </div>
                    <p class="mt-3 leading-normal text-base sm:text-xs md:text-base">{{ $pianoPlayer['description'] }}</p>
                </div>
            @endforeach
        </div>
    </div>
</section>

<section class="text-center px-5 sm:px-6 py-10 sm:py-14 lg:py-20" style="background-color:#f4f8fb;">
    <div class="container max-w-5xl mx-auto mb-14 lg:mb-16">
        <div class="flex flex-wrap sm:flex-nowrap items-start justify-center sm:mt-8">
            <div class="w-52 sm:w-72 lg:w-80 relative -mb-8 sm:mb-0 sm:-mt-8 sm:-mr-8">
                <img class="inline-block sm:hidden w-full relative z-20 transition-opacity opacity-0" loading="lazy"
                    onload="this.classList.remove('opacity-0')"
                    src="https://d21q7xesnoiieh.cloudfront.net/fit-in/900x0/filters:quality(95)/marketing/pianote/products/30-day-jazz-piano/coach-image.webp">
                <img class="hidden sm:inline-block absolute top-0 left-0 w-full z-20 transition-all opacity-0"
                    src="https://d21q7xesnoiieh.cloudfront.net/fit-in/900x0/filters:quality(95)/marketing/pianote/products/30-day-jazz-piano/coach-image.webp"
                    loading="lazy" onload="this.classList.remove('opacity-0')">
                <img class="hidden sm:inline-block absolute top-0 left-1/2 max-w-none z-10 transition-all opacity-0"
                    style="width: 130%;transform: translate(-44%, -7%);"
                    src="https://www.musora.com/musora-cdn/image/width=550,quality=85/https://dpwjbsxqtam5n.cloudfront.net/drum-shop/30-day-chops/coach-brush-layer.png"
                    alt="profile picture" loading="lazy" onload="this.classList.remove('opacity-0')">
            </div>

            <div class="text-white text-left z-10 rounded-xl pt-14 pb-8 sm:py-10 lg:py-12 px-6 sm:pr-10 sm:pl-14 lg:px-24 max-w-lg lg:max-w-2xl sm:mt-8 w-full sm:w-auto sm:flex-grow"
                style="background-color:#00101d;">
                <h6 class="uppercase text-pianote leading-normal text-center sm:text-left">MEET YOUR TEACHER</h6>
                <h2 class="text-center sm:text-left"><strong>Kevin Castro</strong></h2>
                <h6 class="leading-normal my-4 lg:my-6">Kevin Castro holds a degree in Jazz and Contemporary Popular Music from the prestigious MacEwan University.
                    <br><br>
                    He’s also toured with rising stars and JUNO-Award winners (JESSIA, Elijah Woods), played at TikTok Headquarters in New York and LA, and even recorded a demo for Jennifer Lopez.
                    <br><br>
                    But Kevin’s real passion comes from sharing his experience and knowledge with students.
                    <br><br>
                    And he’ll be with you at every stage of your jazz journey.
                </h6>
            </div>
        </div>
    </div>
</section>


<div id="final" class="anchor"></div>
@php
$points = [
    'Daily guided workouts.',
    'Lifetime access to watch & re-watch.',
    '90-day money-back guarantee.'
];
@endphp

<section class="px-3 sm:px-0 text-center relative z-50 overflow-hidden" style="background: #ffffff;">
    <div class="container max-w-6xl mx-auto relative z-50" style="background: #ffffff;" data-bg="https://d21q7xesnoiieh.cloudfront.net/fit-in/2000x0/filters:quality(95)/marketing/pianote/products/30-day-jazz-piano/sale/order-collage.webp">
        <div class="flex flex-wrap items-center px-4 sm:px-6 pt-10 md:py-10 lg:py-20">
            <div class="text-center sm:text-left w-full sm:w-1/2 lg:w-5/12 sm:pl-5" style="background: #ffffff;">
                <img class="h-20 sm:h-24 lg:h-28 -mb-3 sm:mb-0 lg:mb-1 opacity-0 transition-opacity duration-300 ease-in-out" 
                     src="https://d21q7xesnoiieh.cloudfront.net/fit-in/770x0/marketing/pianote/products/30-day-jazz-piano/logo.webp"  
                     loading="lazy" 
                     onload="this.classList.remove('opacity-0')" 
                     alt="logo">
                <h2 class="text-4xl sm:text-3xl md:text-4xl pt-6 sm:pt-4 lg:pb-4 tracking-normal"><strong>Learn Jazz Piano <br/>in Just 30 Days.</strong></h2>
                <div class="text-center sm:text-left sm:pb-5">
                    <ul>
                        @foreach ($points as $index => $point)
                            @if ($loop->last)
                                <li class="text-{{ $brand }}">
                                    <p class="pt-2 lg:pt-3"><i class="fas fa-sharp fa-solid fa-certificate pr-1"></i>
                                        <strong>{{ $point }}</strong></p>
                                </li>
                            @else
                                <li>
                                    <p class="pt-2 lg:pt-3"><i class="fas fa-check text-{{ $brand }} pr-1"></i>
                                        {{ $point }}</p>
                                </li>
                            @endif
                        @endforeach
                    </ul>
                    <div class="flex flex-wrap flex-col sm:flex-nowrap md:flex-row items-center mt-6 sm:mt-12 lg:mt-8">
                        <a href="{{$buttonLink}}" class="join pianote medium w-full max-w-[300px] mb-3" role="button">Get started</a>
                    </div>
                      <h5 class="leading-tight text-center md:text-left">
                            <strong class="font-black">Only
                            @if($price > $discountedPrice)
                                    <s class="opacity-60">${{ $price }}</s> ${{ $discountedPrice }} (SAVE {{ round(100 - (100 * ($discountedPrice / $price))) }}%)
                            @else
                                ${{ $discountedPrice }}
                            @endif
                            </strong>
                        </h5>
                </div>
            </div>
            <div class="flex w-full justify-center sm:justify-start sm:w-1/2 lg:w-7/12 sm:order-1 sm:pl-5 mt-7 sm:mt-0 hidden sm:block">
                <img class="max-w-lg sm:max-w-2xl lg:max-w-4xl pb-4 opacity-0 transition-opacity" 
                     src="https://d21q7xesnoiieh.cloudfront.net/fit-in/2000x0/filters:quality(95)/marketing/pianote/products/30-day-jazz-piano/sale/order-collage.webp" 
                     alt="collage" 
                     loading="lazy" 
                     onload="this.classList.remove('opacity-0')">
            </div>
        </div>
    </div>
    <div class="w-full sm:hidden text-center py-8">
        <img class="opacity-0 transition-opacity" src="https://d21q7xesnoiieh.cloudfront.net/fit-in/2000x0/filters:quality(95)/marketing/pianote/products/30-day-jazz-piano/sale/order-collage.webp" alt="collage" loading="lazy" onload="this.classList.remove('opacity-0')">
    </div>
</section>

    @include('_partials.components.video-modal',[
        'name' => 'trailer',
        'video' => '1019964518',
        'vimeo' => true,
    ])

    @include('_partials.components.video-modal',[
        'name' => 'testimonial',
        'video' => '1019964518',
        'vimeo' => true,
    ])

    @include("pianote.sales.partials._footer")

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script type="text/javascript" src="{{ asset('/marketing/js/modal.js') }}"></script>
    <script type="text/javascript" src="{{ asset('/marketing/parcel/drumeo/navigation-sales.js') }}" defer></script>

    <script src="{{ mix('/platform/js/manifest.js') }}"></script>
    <script src="{{ mix('/platform/js/vendor.js') }}"></script>
    <script src="{{ mix('/platform/js/app.js') }}"></script>

@stop
