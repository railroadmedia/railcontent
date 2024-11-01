@php
    require_once(resource_path('marketing/views/pianote/_partials/homepage-data.php'));
@endphp
@extends('pianote._partials.global-layout')

@section('global-head')
    @parent
    <title>30-Day Blues Piano | Pianote</title>
    <meta property="og:title" content="30-Day Blues Piano | Pianote">
    <meta name="description" content="30 days to better piano chords.">
    <meta property="og:description" content="30 days to better piano chords.">
    <meta property="og:image" content="https://d21q7xesnoiieh.cloudfront.net/fit-in/1200x0/filters:quality(95)/marketing/pianote/products/30-day-blues/share-image.jpg" style="display: none;">
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
        "name" => "30-Day Blues Piano",
        "fullPrice" => floatval($productPrices['30-day-blues-piano']->price),
        "price" => floatval($productPrices['30-day-blues-piano']->discounted_price),
        "noBreadcrumb" => true
    ])


        @php
            $price = floatval($productPrices['30-day-blues-piano']->price);
            $discountedPrice = floatval($productPrices['30-day-blues-piano']->discounted_price);
            $enrollmentLink = 'https://www.pianote.com/choose-plan';
            $brandTitle = 'Pianote';
            $buttonText = 'GET STARTED';
            $buttonLink = "/ecommerce/add-to-cart?products[30-day-blues-piano]=1";
            $studentProfilesImage = 'https://d21q7xesnoiieh.cloudfront.net/fit-in/100x0/filters:quality(95)/marketing/pianote/products/30-day-blues/piano-players-trusted.png';
            $numStudents =  number_format($nPackOwners ?? 0);
            $students = 'piano players';
        @endphp

<!-- Header Section -->
    @include('drumeo.products.partials.evergreen._header', [
    'logoHeader' => 'https://d21q7xesnoiieh.cloudfront.net/fit-in/770x0/marketing/pianote/products/30-day-jazz-piano/logo.webp',
    'logoAlt' => '30 day blues logo',
    'text' => 'Lean Jazz Piano',
    'subtitle' => 'in just 30 days',
    'checklist' => ['Learn By Doing', 'Play Every Day', 'Perfect For Beginners'],
    'bgImageRight' => 'https://d21q7xesnoiieh.cloudfront.net/fit-in/800x0/filters:quality(95)/marketing/pianote/products/30-day-blues/header-right-collage.png',
    'bgImageLeft' => 'https://d21q7xesnoiieh.cloudfront.net/fit-in/800x0/filters:quality(95)/marketing/pianote/products/30-day-blues/header-left-collage.png',
    'mediaSource' => 'https://d21q7xesnoiieh.cloudfront.net/fit-in/800x0/filters:quality(95)/marketing/pianote/products/30-day-blues/video-thumb-header.png',
    'extraClass' => 'h-20 sm:h-24 lg:h-32',
])


<section class="text-center px-5 sm:px-6 py-10 sm:py-14 lg:py-20" style="background-color:#FFFFFF;">
    <div class="container max-w-4xl mx-auto">
        <h2 class="leading-tight mb-7 sm:mb-12"><strong>Discover the beautiful, exciting <br> world of jazz piano.</strong></h2>
        @php
                $gettings = [
                    [
                        'position' => 'left',
                        'img' =>
                            'https://d21q7xesnoiieh.cloudfront.net/fit-in/900x0/filters:quality(95)/marketing/pianote/products/30-day-jazz-piano/know-exactly.webp',
                        'title' => 'Know what to learn, and when.',
                        'desc' =>
                            'Jazz, like life, is all about the journey. 30-Day Jazz Piano shows you the exact steps and skills to work on – in the perfect order for jazz beginners. All you have to do is play along!',
                    ],
                    [
                        'position' => 'right',
                        'img' =>
                            'https://d21q7xesnoiieh.cloudfront.net/fit-in/900x0/filters:quality(95)/marketing/pianote/products/30-day-jazz-piano/schedule.webp',
                        'title' => 'Fits any schedule.',
                        'desc' =>
                            'Can you really learn jazz piano in just 10 minutes a day? Yes, you can! 30-Day Jazz Piano is perfect for any schedule. And you’ll be playing REAL jazz right from Day 1.',
                    ],
                    [
                        'position' => 'left',
                        'img' =>
                            'https://d21q7xesnoiieh.cloudfront.net/fit-in/900x0/filters:quality(95)/marketing/pianote/products/30-day-jazz-piano/play.webp',
                        'title' => 'Build your skills.',
                        'desc' =>
                            'You’ll start off with jazz basics. Next, you’ll move on to comping and the walking bass line. Finally, you’ll put all your techniques together to play an original jazz standard written by Kevin Castro!',
                    ],
                    [
                        'position' => 'right',
                        'img' =>
                            'https://d21q7xesnoiieh.cloudfront.net/fit-in/900x0/filters:quality(95)/marketing/pianote/products/30-day-jazz-piano/play.webp',
                        'title' => 'Lifetime Access',
                        'desc' =>
                            '30-Day Jazz Piano is yours for LIFE. It’s designed to be completed in 30 days, but you can take your time and come back to it as often as you like. Your access will never expire.',
                    ],
                ];
        @endphp
        <div class="timeline-container pianote max-w-4xl lg:max-w-4xl mx-auto relative px-4 pt-7">
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
    <h1 class="leading-none sm:-mt-6 lg:-mt-7 hidden md:inline-block"><i class="fal fa-angle-down text-pianote"></i></h1>
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
                        <h5 class="leading-loose text-left">
                        <i class="fas fa-sharp fa-solid fa-circle-check text-{{ $brand }} mr-5" aria-hidden="true"></i>{{ $item }}</h5>
                    </li>
                @endforeach
            </ul>
        </div>
        {{-- <a href={{$buttonLink}} class="join blue medium w-full sm:w-1/2 md:w-1/3 lg:w-3/5 mt-6 sm:mt-12 mb-3 anchor-slide" role="button">{{$buttonText}}</a><br> --}}
        <div class="w-full flex flex-col items-center">
            <div class="w-full sm:w-1/2 md:w-1/3">
                @include('drumeo.products.partials.evergreen._button', [
                    'link' => $buttonLink,
                    'buttonClass' => 'text-white font-bebas tracking-widest',
                    'buttonText' => $buttonText,
                ])
            </div>
            {{-- <div class="flex flex-row items-center py-2">
                     @if ($numStudents > 500)
                    <img class="h-7 mr-2" alt="Joined Student Profiles" src={{ $studentProfilesImage }}>
                    <span class="inline-block align-middle leading-tight text-xs">Join
                        {{ $numStudents }} {{ $students }} who<br> have already registered.
                    </span>
                    @endif
                </div> --}}
        </div>
        @include('drumeo.products.partials.evergreen._price-link', [
            'enrollmentLink' => $enrollmentLink,
            'brandTitle' => $brandTitle,
        ])
    </div>
</section>

<section x-data="{ visible: false }"
         x-intersect.once="visible = true;"
         class="container-video pt-10">
    <div class="container max-w-4xl mx-auto flex flex-col items-center md:pt-10 text-center px-6">
        <div class="aspect-16:9 cursor-pointer rounded-xl autoplay-video overflow-hidden w-full relative"
            x-on:click="testimonial = true;" role="button">
            <i
                class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 fas fa-play play-button z-10"></i>


            <img class="absolute inset-0 rounded-xl overflow-hidden object-cover w-full h-full absolute z-0"
                src="https://d21q7xesnoiieh.cloudfront.net/fit-in/800x0/filters:quality(95)/marketing/pianote/products/30-day-blues/testimonial-video-thumb.png"
                alt="testimonial image" fetchpriority="high" />

        </div>
    </div>
</section>

<section class="text-center px-5 sm:px-6 py-10 sm:py-14 lg:py-20">
    <div class="container max-w-6xl mx-auto">
        <h2 class="mb-6 sm:mb-10 lg:mb-14"><img
                class="h-16 sm:h-24 -mb-2 sm:-mb-4 align-bottom transition-opacity opacity-0" loading="lazy"
                onload="this.classList.remove('opacity-0')"
                src="https://d21q7xesnoiieh.cloudfront.net/fit-in/770x0/filters:quality(95)/marketing/pianote/products/30-day-jazz-piano/logo.webp"
                alt="30-Day Jazz Logo"> <strong> is designed for:</strong></h2>

        @php
            $drummers = [
                [
                    'image' =>
                        'https://d21q7xesnoiieh.cloudfront.net/fit-in/900x0/filters:quality(95)//marketing/pianote/products/30-day-jazz-piano/intermediate.webp',
                    'title' => 'Intermediate Piano Players.',
                    'description' =>
                        'If you’re already comfortable on the keyboard and want to start exploring the world of jazz, this challenge is for you! In just 30 days, you’ll learn techniques that’ll help you sound like a jazz pianist.',
                ],
                [
                    'image' =>
                        'https://d21q7xesnoiieh.cloudfront.net/fit-in/900x0/filters:quality(95)/marketing/pianote/products/30-day-jazz-piano/beginner.webp',
                    'title' => 'Beginner Piano Players ',
                    'description' =>
                        'Just starting out on the piano? You can still swing! Some of the workouts in 30-Day Jazz Piano might feel a bit challenging, but Kevin shows you how to simplify them with a few modifications.',
                ],
                [
                    'image' =>
                        'https://d21q7xesnoiieh.cloudfront.net/fit-in/900x0/filters:quality(95)/marketing/pianote/products/30-day-jazz-piano/advanced.webp',
                    'title' => 'Advanced Piano Players ',
                    'description' =>
                        'You’ve got a bunch of classical pieces under your fingers. But you’re looking for something a little more… cool. In just 10 minutes a day, 30-Day Jazz Piano will help you play jazz with confidence.',
                ],
            ];
        @endphp

        <div class="flex flex-col sm:flex-row text-left justify-center">
            @foreach ($drummers as $drummer)
                <div class="w-full sm:w-1/3 px-2 mb-6 sm:mb-0 mx-auto sm:mx-0">
                    <div class="pb-44 sm:pb-36 lg:pb-52 text-center text-white bg-cover bg-center relative overflow-hidden rounded-xl"
                        style="background-image:url('{{ $drummer['image'] }}'); object-position: 60% 0">
                        <h6 class="leading-tight absolute bottom-1 w-full z-10"><strong>
                                <i class="fas fa-check-circle text-pianote text-3xl"></i><br>{!! $drummer['title']  !!}</strong></h6>
                        <div class="absolute inset-0 z-0"
                            style="background:linear-gradient(to bottom, transparent 40%, rgba(0,0,0,0.8));"></div>
                    </div>
                    <p class="leading-normal mt-3">{{ $drummer['description'] }}</p>
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
            'Litetime access to watch & re-watch.',
            '90-day money-back guarantee.'
        ]
@endphp

<section class="px-3 sm:px-0 text-center customize relative z-50 overflow-hidden" style="background: #eff7ff;">
    <div class="container max-w-6xl mx-auto relative z-50" style="background: #eff7ff;" data-bg="https://d21q7xesnoiieh.cloudfront.net/fit-in/2000x0/filters:quality(95)/marketing/pianote/products/30-day-blues/order-collage.png">
        <div class="flex flex-wrap items-center px-4 sm:px-6 pt-10 md:py-10 lg:py-20">
            <div class="text-center sm:text-left w-full sm:w-1/2 lg:w-5/12 sm:pl-5" style="background: #eff7ff;">
                <img class="h-20 sm:h-24 lg:h-26 -mb-3 sm:mb-0 lg:mb-3 opacity-0 transition duration-300 ease-in-out" 
                     src="https://d21q7xesnoiieh.cloudfront.net/fit-in/770x0/marketing/pianote/products/30-day-jazz-piano/logo.webp"  
                     loading="lazy" 
                     onload="this.classList.remove('opacity-0')" 
                     alt="logo">
                <h1 class="py-6 sm:py-4"><strong>Learn Jazz Piano  in Just 30 Days.</strong></h1>
                <div class="text-center sm:text-left sm:pb-5">
                    <ul>
                        @foreach ($points as $index => $point)
                            @if ($loop->last)
                                <li class="text-{{ $brand }}">
                                    <p class="pt-2"><i class="fas fa-sharp fa-solid fa-certificate pr-1"></i>
                                        <strong>{{ $point }}</strong></p>
                                </li>
                            @else
                                <li>
                                    <p class="pt-2"><i class="fas fa-check text-{{ $brand }} pr-1"></i>
                                        {{ $point }}</p>
                                </li>
                            @endif
                        @endforeach
                    </ul>
                    <div class="flex flex-wrap flex-col sm:flex-nowrap md:flex-row items-center mt-6 sm:mt-5 lg:mt-10">
                        <div class="w-full md:w-2/3 text-center sm:pr-2 my-1">
                            <div class="w-full">
                                @include('drumeo.products.partials.evergreen._button', [
                                    'link' => $buttonLink,
                                    'buttonClass' => 'text-white font-bebas tracking-widest',
                                    'buttonText' => $buttonText,
                                ])
                            </div>
                        </div>
                    </div>
                    @include('drumeo.products.partials.evergreen._price-link', [
                        'enrollmentLink' => $enrollmentLink,
                        'brandTitle' => $brandTitle,
                    ])
                </div>
            </div>
            <div class="flex w-full justify-center sm:justify-start sm:w-1/2 lg:w-7/12 sm:order-1 sm:pl-5 mt-7 sm:mt-0 hidden sm:block">
                <img class="max-w-lg sm:max-w-2xl lg:max-w-4xl pb-4 opacity-0 transition-opacity" 
                     src="https://d21q7xesnoiieh.cloudfront.net/fit-in/2000x0/filters:quality(95)/marketing/pianote/products/30-day-blues/order-collage.png" 
                     alt="collage" 
                     loading="lazy" 
                     onload="this.classList.remove('opacity-0')">
            </div>
        </div>
    </div>
    <div class="w-full sm:hidden text-center py-8">
        <img class="opacity-0 transition-opacity" src="https://d21q7xesnoiieh.cloudfront.net/fit-in/2000x0/filters:quality(95)/marketing/pianote/products/30-day-blues/order-collage.png" alt="collage" loading="lazy" onload="this.classList.remove('opacity-0')" >
    </div>
</section>


    @include('_partials.components.video-modal',[
        'name' => 'trailer',
        'video' => '879913986',
        'vimeo' => true,
    ])

    @include('_partials.components.video-modal',[
        'name' => 'testimonial',
        'video' => '884499141',
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
