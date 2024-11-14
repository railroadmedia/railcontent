@php
    require_once(resource_path('marketing/views/pianote/_partials/bonus-data-2024.php'));
@endphp

@extends('pianote._partials.global-layout')

@section('global-head')
    <title>Prima @if(!empty($ultimate)) Ultimate Bundle @elseif(!empty($lifetime)) Keyboard @else Bundle @endif | Pianote</title>
    <meta property="og:title" content="Prima | Pianote">

    <meta name="description" content="Everything you need to start playing the piano. ">
    <meta property="og:description" content="Everything you need to start playing the piano. ">

    <meta property="og:image" content="https://d21q7xesnoiieh.cloudfront.net/fit-in/1200x0/filters:quality(95)/marketing/pianote/products/prima/share-image.jpg">
    <meta property="og:url" content="https://www.pianote.com/{{ Request::path() }}">

    @include('_partials.layout._fonts')
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@800&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="{{ mix('marketing/css/app.css') }}">
    <link href="{{ asset('/marketing/css/tailwind-helpers.css') }}" rel="stylesheet">
    <link href="{{ asset('/marketing/parcel/drumeo/navigation-sales.css') }}" rel="stylesheet">
    <!-- <link href="{{ asset('/marketing/parcel/drumeo/sales-2020.css') }}" rel="stylesheet"> -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@splidejs/splide@4.0.7/dist/css/splide.min.css">
    <style>
        .join, .join:hover {
            background-color: #F61A30;
            border-color: #F61A30;
        }
        .join.musora, .join.musora:hover {
            background-color: #FFAE00;
            border-color: #FFAE00;
            color: #000;
        }
        .join.outline.red {
            border-color: #F61A30;
            color: #0b76db;
        }

        .join.smaller.outline {
            padding: 12px 7%;
            border-color: #F61A30;
            background-color: rgb(18, 18, 6, 0.3);
        }

        .join.smaller.outline:hover {
            background-color: #F61A30;
            color: #FFFFFF;
        }

        .join i {
            transition: all .3s;
            position: relative;
            right: 0;
        }

        .translate-x-2 {
            transform: translateX(0.2rem);
        }
        .prima-piano-next svg {
            fill: #F61A30; 
        }
    </style>
   
    @php
        if(!empty($membersVersion)) {
             $orderUrl = '/ecommerce/add-to-cart?products[pianote-book-bag]=1&promo-code=members&locked=true';
             $discountedPrice = 149;
        }
        else {
             $orderUrl = '/ecommerce/add-to-cart?products[pianote-book-bag]=1';
             $discountedPrice = number_format(floatval($productPrices['pianote-book-bag']->discounted_price), 2) == intval(floatval($productPrices['pianote-book-bag']->discounted_price))
                ? floatval($productPrices['pianote-book-bag']->discounted_price)
                : number_format(floatval($productPrices['pianote-book-bag']->discounted_price), 2);
                }
    @endphp
@stop

@section('body-data')
    x-data="{
    trailer: false,
    modal798501810: false,
    modal823788317: false,
    modal852795615: false,
    modal928599834: false,
    modal1008560089: false,
    }"
@endsection

@section('global-body')
    @include("pianote.sales.partials._nav", [
        "cartVersion" => true
    ])
    @include('_partials.components.shop.promo-banner-3', [
        "name" => "Pianote BookBag",
        "fullPrice" => floatval($productPrices['pianote-book-bag']->price),
        "price" => $discountedPrice,
        "noBreadcrumb" => true
    ])

    <header class="text-white relative overflow-hidden z-10" style="background-color: #020B16;">
        <div class="transform -translate-y-1/2 top-1/2 left-0 w-full absolute z-20 px-4 lg:px-6 text-center">
            <div class="container max-w-6xl mx-auto relative z-20">
                @if(!empty($ultimate))
                    <img class="h-6 md:h-11 my-2 md:my-4 block mx-auto" src="https://d21q7xesnoiieh.cloudfront.net/700x0/filters:quality(95)/marketing/pianote/products/prima/bundle/ultimate-bundle-logo.svg">
                    <h2 class="relative w-auto inline-block leading-tight">
                        <strong><u style="text-decoration-color: #F61A30;">Everything you need</u></strong> to <br class="block sm:hidden">
                        start <br class="hidden sm:inline">playing the piano.
                    </h2>
                    <h6 class="my-5 sm:my-6"><em>Get the best beginner digital piano kit PLUS</em></h6>
                    <p class="text-sm leading-normal mb-5 lg:mb-7">
                        <i class="fas fa-check text-pianote"></i> An Annual Pianote Membership
                        <br class="sm:hidden">
                        <i class="fas fa-check lg:ml-5 text-pianote"></i> Keyboard Stand + Bench
                        <br class="lg:hidden">
                        <i class="fas fa-check lg:ml-5 text-pianote"></i> Metronome
                        <br class="sm:hidden">
                        <i class="fas fa-check lg:ml-5 text-pianote"></i> Theory Posters + 5 Launch Bonuses
                    </p>
                    <h3 class="leading-tight mt-6 mb-4 sm:mb-6">
                        Only <s class="opacity-50">$1642</s> <strong>$799</strong>
                    </h3>
                @elseif(!empty($lifetime))
                    <img class="h-6 md:h-10 my-2 block mx-auto" src="https://d21q7xesnoiieh.cloudfront.net/700x0/filters:quality(95)/marketing/pianote/products/prima/Logo.webp">
                    <h2 class="relative w-auto inline-block leading-tight">
                        <strong><u style="text-decoration-color: #F61A30;">Everything you need</u></strong> to <br class="block sm:hidden">
                        start <br class="hidden sm:inline">playing the piano.
                    </h2>
                    <h3 class="leading-tight mt-6 mb-4 sm:mb-6">
                        Only <strong>$599</strong>
                    </h3>
                @else
                    <img class="h-6 md:h-10 my-2 md:my-4 block mx-auto" src="https://d21q7xesnoiieh.cloudfront.net/700x0/filters:quality(95)/marketing/pianote/products/prima/bundle/keyboard-bundle-logo.svg">
                    <h2 class="relative w-auto inline-block leading-tight">
                        <strong>The <u style="text-decoration-color: #F61A30;">Perfect Way</u> to Start</strong> <br class="hidden sm:inline">Playing the Piano.
                    </h2>
                    <h6 class="my-5 sm:my-6"><em>Get the best beginner digital piano PLUS an Annual Membership to Pianote. <br class="hidden sm:inline">+ 5 LAUNCH BONUSES</em></h6>

                    <h3 class="leading-tight mt-6 mb-4 sm:mb-6">
                         Only <s class="opacity-50">$1374</s><strong> $599</strong>
                    </h3>
                @endif
    
                <div class="w-full max-w-xl mx-auto">
                    <a class="w-full sm:w-5/12 join sold-out smaller text-white bg-pianote my-2 sm:m-2 hover:bg-red-500"
                        href="/ecommerce/add-to-cart?products[PIANOTE-MEMBERSHIP-1-YEAR]=1&products[classical-piano-collection]=1&products[taktell-piccolo-metronome]=1&products[classical-piano-pieces]=1&locked=true"
                    >START PLAYING</a>
                    <div class="sm:w-5/12 join smaller outline hidden sm:inline-block bg-transparent hover:bg-white hover:text-black"
                        @click="trailer = true;">
                        &nbsp;Watch The Trailer
                    </div>
                    <div class="w-full sm:w-5/12 join smaller outline sm:hidden inline-block bg-transparent hover:bg-white hover:text-black"
                        x-data="{ move: false }" @mouseover="move = true" @mouseout="move = false" @click="trailer = true;">
                        &nbsp;Watch The Trailer
                    </div>
                </div>
            </div>
        </div>
        <div class="top-0 left-0 absolute w-full h-full z-10" style="background: rgba(0, 0, 0, 0.8)"></div>
        <video class="object-cover w-full relative z-0" style="height: 700px;" type="video/mp4" autoplay loop playsinline muted
            src="https://player.vimeo.com/progressive_redirect/playback/1028938916/rendition/1080p/file.mp4?loc=external&signature=c202155d97ff975ec8544dbe7d869330bae1779fd2190976d4bd3aa819bcc58e"></video>
    </header>

    <section class="text-center px-5 sm:px-6 py-8 sm:py-16 lg:py-20 bg-black text-white relative">
        <div class="container mx-auto z-10 relative max-w-4xl">
            <h2 class="leading-tight"><strong>Choosing your first piano<br> can be <u style="text-decoration-color: #F61A30;">overwhelming</u>. </strong></h2>
            <h5 class="leading-tight my-5"><em>We’ve made it <strong>simple</strong>.</em></h5>
            <p class="leading-normal max-w-3xl mx-auto">It’s the most common question beginners have…
                <br><br>
                What piano should I buy?
                <br><br>
                A piano is an investment -- and it can be an expensive one. And when you’re a beginner you often don’t know what features you need -- and what extras you’re paying for unnecessarily.
                <br><br>
                So we partnered with an experienced piano manufacturer to create the BEST 88-key digital piano for beginners.
                <br><br>
                Introducing…
            </p>
        </div>
        <img class="w-full max-w-5xl -mt-10 lg:-mt-36 hidden md:block mx-auto" src="https://d21q7xesnoiieh.cloudfront.net/2000x0/filters:quality(95)/marketing/pianote/products/prima/piano-features.webp">
        <img class="w-full max-w-5xl -mt-10 lg:-mt-36 block md:hidden mx-auto" src="https://d21q7xesnoiieh.cloudfront.net/1000x0/filters:quality(95)/marketing/pianote/products/prima/piano-features-m.webp">
    </section>

    <section class="text-center px-5 sm:px-6 py-8 sm:py-16 lg:py-20 relative" style="background: #F1EFED;"
    >
        <div class="container mx-auto z-10 relative max-w-5xl">
            <h2 class="leading-tight mb-3"><strong>Premium Features. Beginner Price.</strong></h2>
            @php
                $items = [
                    [
                    'video' => 'https://musora-image-processing-cdn.s3.us-east-2.amazonaws.com/marketing/pianote/products/prima/video-features/feature-01.mp4',
                    'title' => '88-Key Progressive Hammer Action',
                    'desc' => 'The fully weighted hammer-action keys mimic the feel of a real piano, providing a heavier touch in the lower registers and a lighter touch for the high notes<br><br>Whether you\'re playing simple scales or tackling more advanced pieces, the Prima’s keys offer a realistic feel that builds strength and dexterity, giving you the confidence to play on any piano.',
                    ],
                    [
                    'video' => 'https://musora-image-processing-cdn.s3.us-east-2.amazonaws.com/marketing/pianote/products/prima/video-features/feature-02.mp4',
                    'title' => 'Seamless Connection to Your Lessons &  Music',
                    'desc' => 'With Bluetooth audio and MIDI, you can wirelessly connect the Prima to your tablet or phone for easy access to your Pianote lessons. Or stream music directly through the piano’s speakers.<br><br>Imagine streaming your favorite song directly through the piano’s speakers and playing along. With Prima, you can connect to lessons or jam sessions without any messy cables.',
                    ],
                    [
                    'video' => 'https://musora-image-processing-cdn.s3.us-east-2.amazonaws.com/marketing/pianote/products/prima/video-features/feature-03.mp4',

                    'title' => 'A World of Sound at Your Fingertips',
                    'desc' => 'With 238 different tones, from classic grand pianos to strings, organs, and more, the Prima gives you endless options for creativity.<br><br>Switch between piano and strings, or experiment with jazz organ and orchestral sounds. The variety will keep you inspired and motivated to practice.',
                    ],
                    [
                    'video' => 'https://musora-image-processing-cdn.s3.us-east-2.amazonaws.com/marketing/pianote/products/prima/video-features/feature-04.mp4',
                    'title' => 'Hear Every Note in Full, Rich Detail',
                    'desc' => 'The built-in stereo speakers are designed to fill your space with clear, balanced sound, while the stereo headphone jack ensures that you can practice privately without sacrificing sound quality.<br><br>Whether you’re practicing quietly late at night or performing for friends, the Prima delivers rich, concert-quality sound that brings your music to life.',
                    ],
                    [
                    'video' => 'https://musora-image-processing-cdn.s3.us-east-2.amazonaws.com/marketing/pianote/products/prima/video-features/feature-05.mp4',
                    'title' => 'True Piano Sustain Pedal',
                    'desc' => 'Unlike the cheap plastic pedals that come with many beginner digital pianos, the Prima features a premium sustain pedal that feels just like a real acoustic piano pedal.<br><br>You’ll feel the difference immediately. It responds naturally to your touch, helping you develop the same techniques you would on a traditional acoustic piano.',
                    ],
                    [
                    'video' => 'https://musora-image-processing-cdn.s3.us-east-2.amazonaws.com/marketing/pianote/products/prima/video-features/feature-06.mp4',
                    'title' => 'Keep Perfect Time, Your Way',
                    'desc' => 'With four distinct metronome sounds, the Prima helps you develop a strong sense of rhythm, a critical skill for every pianist.<br><br>Choose from different metronome sounds to keep your practice engaging and help you stay on beat, no matter what style of music you’re playing.',
                    ],
                ];
            @endphp
           @foreach ($items as $index => $item)
            <div class="text-left flex flex-col sm:flex-row justify-center items-center md:py-10">
                @if ($index % 2 == 0)
                    <video class="w-full sm:w-6/12 lg:w-1/2 rounded-xl order-1 sm:order-1" src="{{ $item['video'] }}" type="video/mp4" autoplay muted loop>
                    </video>
                @else
                    <video class="w-full sm:w-6/12 lg:w-1/2 rounded-xl order-1 sm:order-2" src="{{ $item['video'] }}" type="video/mp4" autoplay muted loop>
                    </video>
                @endif

                <div class="flex flex-row md:flex-col sm:flex-1 justify-center items-start py-4 {{ $index % 2 == 0 ? 'sm:pl-4 md:pl-10' : 'sm:pr-4 md:pr-10' }} order-2 sm:order-1">
                    <div>
                        <h6 class="leading-tight mx-0 my-2 sm:my-4"><strong>{{ $item['title'] }}</strong></h6>
                        <p class="leading-normal max-w-xl">{!! $item['desc'] !!}</p>
                    </div>
                </div>
            </div>
            @endforeach

        </div>
    </section>
    <section class="text-center px-6 py-10 sm:py-14 lg:py-20 @if(!empty($lifetime)) hidden @endif"
        @if(!empty($ultimate))
            style="background: linear-gradient(to bottom, #A80011, #310A58); color:#fff"
        @else
            style="background:#E8E4E1;"
        @endif
    >
        <div class="container max-w-2xl mx-auto relative z-10">

            <div x-data x-init="
                new Splide($refs.splide, {
                    type: 'loop',
                    autoplay: true,
                    interval: 6000,
                    arrows: false,
                    pagination: false,
                }).mount();
            ">
                <div class="splide" x-ref="splide">
                    <div class="splide__track">
                        <div class="splide__list">
                            @php
                                $testimonials = [
                                    [
                                        "image" => "https://d21q7xesnoiieh.cloudfront.net/1024x1024/filters:quality(95)/marketing/pianote/membership/homepage/2024/testimonials/Tonya-Hotz-thumb-m.webp",
                                        "avatar" => "https://d21q7xesnoiieh.cloudfront.net/fit-in/130x0/filters:quality(95)/marketing/pianote/membership/homepage/2024/testimonials/Tonya-Hotz-profile.webp",
                                        "name" => "Tonya Hotz",
                                        "location" => "Arizona, USA",
                                        "video" => "882979587",
                                        "title" => "There was a time when I felt I had missed my opportunity to really master an instrument. But here I am three years later and  <strong>making music is my favorite thing</strong>  to do.",
                                    ],
                                    [
                                        "image" => "https://d21q7xesnoiieh.cloudfront.net/1024x1024/filters:quality(95)/marketing/pianote/membership/homepage/2024/testimonials/Allison-Bond-thumb-m.webp",
                                        "avatar" => "https://d21q7xesnoiieh.cloudfront.net/fit-in/130x0/filters:quality(95)/marketing/pianote/membership/homepage/2024/testimonials/Allison-Bond-profile.webp",
                                        "name" => "Allison Bond",
                                        "location" => "Canada",
                                        "video" => "877591721",
                                        "title" => "Every time I have a question there’s something on Pianote for me. <strong>It’s a very positive place</strong> and I can play the piano with other people from around the world. ",
                                    ],
                                    [
                                        "image" => "https://d21q7xesnoiieh.cloudfront.net/1024x1024/filters:quality(95)/marketing/pianote/membership/homepage/2024/testimonials/Steve-Wilson-thumb-m.webp",
                                        "avatar" => "https://d21q7xesnoiieh.cloudfront.net/fit-in/130x0/filters:quality(95)/marketing/pianote/membership/homepage/2024/testimonials/Steve-Wilson-profile.webp",
                                        "name" => "Steve Wilson",
                                        "location" => "Arizona, USA",
                                        "video" => "877591944",
                                        "title" => "Pianote <strong> gave me the motivation I needed</strong> and to learn that it’s okay if I make a whole lot of mistakes. It’s really helpful and a lot of fun. ",
                                    ],
                                    [
                                        "image" => "https://d21q7xesnoiieh.cloudfront.net/1024x1024/filters:quality(95)/marketing/pianote/membership/homepage/2024/testimonials/Darli-Brazil-thumb-m.webp",
                                        "avatar" => "https://d21q7xesnoiieh.cloudfront.net/fit-in/130x0/filters:quality(95)/marketing/pianote/membership/homepage/2024/testimonials/Darli-Brazil-profile.webp",
                                        "name" => "Darli Brazil",
                                        "location" => "California, USA",
                                        "video" => "878027528",
                                        "title" => "The amount of songs you can learn is amazing. <strong>I am really enjoying this program.</strong> Everything about it is a positive experience.",
                                    ],
                                    [
                                        "image" => "https://d21q7xesnoiieh.cloudfront.net/1024x1024/filters:quality(95)/marketing/pianote/membership/homepage/2024/testimonials/Ian-Kershaw-thumb-m.webp",
                                        "avatar" => "https://d21q7xesnoiieh.cloudfront.net/fit-in/130x0/filters:quality(95)/marketing/pianote/membership/homepage/2024/testimonials/Ian-Kershaw-profile.webp",
                                        "name" => "Ian Kershaw",
                                        "location" => "United Kingdom",
                                        "video" => "660596700",
                                        "title" => "This is such a fantastic and welcoming, <strong> supportive student community.</strong> And it’s in that sharing and practice that the real breakthroughs come. Thank you!",
                                    ],
                                    [
                                        "image" => "https://d21q7xesnoiieh.cloudfront.net/1024x1024/filters:quality(95)/marketing/pianote/membership/homepage/2024/testimonials/Jayde-McIntosh-thumb-m.webp",
                                        "avatar" => "https://d21q7xesnoiieh.cloudfront.net/fit-in/130x0/filters:quality(95)/marketing/pianote/membership/homepage/2024/testimonials/Jayde-McIntosh-profile.webp",
                                        "name" => "Jayde McIntosh",
                                        "location" => "Australia",
                                        "video" => "660596722",
                                        "title" => "I can play some of my all-time favorite songs – and it’s just so awesome to know <strong>I can learn from home</strong> and accomplish one of my dreams. I’m so excited to keep learning! ",
                                    ],
                                ];
                            @endphp
                            @foreach ($testimonials as $testimonial)
                                <div class="splide__slide">
                                    <div class="text-center flex flex-row">
                                            <img class="h-4 md:h-8 pr-4"
                                                @if(!empty($ultimate))
                                                    style="filter:invert(1) hue-rotate(240deg) brightness(1.3);"
                                                @endif
                                                src="https://d21q7xesnoiieh.cloudfront.net/700x0/filters:quality(95)/marketing/pianote/lead-gen/getting-started/quotation-icon.svg">
                                        <div class="text-left">
                                            <h3 class="leading-snug">{!! $testimonial['title'] !!}</h3>
                                            <div class="flex items-center mt-4">
                                                <div class="ml-3">
                                                    @if (!empty($testimonial['name']))
                                                        <h6 class="leading-none pb-1"><strong>{{ $testimonial['name'] }}</strong></h6>
                                                    @endif
                                                    @if (!empty($testimonial['name']))
                                                        <p class="text-xs">{{ $testimonial['location'] }}</p>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="text-center px-5 sm:px-6 py-8 sm:py-16 lg:py-20 relative @if(!empty($lifetime)) hidden @endif"style="background: #F1EFED; color:#000;">
            <h2 class="leading-tight"><strong>Your new Pianote Prima piano </strong></h2>
            <h3 class="leading-tight mt-1 mb-5 lg:mb-8">comes with unlimited piano lessons from <img src="https://d21q7xesnoiieh.cloudfront.net/700x0/filters:quality(95)/marketing/pianote/products/prima/pianote-logo.svg" alt="pianote logo" class="h-6 md:h-8"></h3>
            <div class="container mx-auto z-10 relative max-w-3xl">
        
                @php
                    $sections = [
                        [
                            'image' => 'https://d21q7xesnoiieh.cloudfront.net/1000x0/filters:quality(95)/marketing/pianote/products/prima/bundle/10-level.webp',
                            'header' => '10-Level <br class="hidden md:block">Curriculum',
                            'subheader' => 'The Pianote Method is your guided path to music freedom. Get expert step-by-step lessons from real piano teachers.'
                        ],
                        [
                            'image' => 'https://d21q7xesnoiieh.cloudfront.net/1000x0/filters:quality(95)/marketing/pianote/products/prima/bundle/guided.webp',
                            'header' => 'Guided 30-Day <br class="hidden md:block">Challenges',
                            'subheader' => 'Practice and play WITH your teacher. Choose a 30-Day Challenge to work on a specific skill and see the results in just 30 days.'
                        ],
                        [
                            'image' => 'https://d21q7xesnoiieh.cloudfront.net/1000x0/filters:quality(95)/marketing/pianote/products/prima/bundle/daily.webp',
                            'header' => 'Daily Practice <br class="hidden md:block">Workouts',
                            'subheader' => 'Not sure what to practice? Pick a 5, 10, or 15-minute routine and practice with a REAL teacher. It’s like Peloton for your piano.'
                        ],
                        [
                            'image' => 'https://d21q7xesnoiieh.cloudfront.net/1000x0/filters:quality(95)/marketing/pianote/products/prima/bundle/favorite.webp',
                            'header' => 'Your Favorite <br class="hidden md:block">Songs',
                            'subheader' => 'You play piano to play songs! Learn and play your favorites from our massive library. Then make them sound beautiful on your new Prima piano.'
                        ],
                        [
                            'image' => 'https://d21q7xesnoiieh.cloudfront.net/1000x0/filters:quality(95)/marketing/pianote/products/prima/bundle/piano-players.webp',
                            'header' => 'The World’s Best <br class="hidden md:block"> Piano Players',
                            'subheader' => 'Learn from legends and connect with real, friendly piano teachers who care about your goals.'
                        ]
                    ];
                @endphp
        
                <div class="space-y-10">
                    @foreach ($sections as $index => $section)
                        <div class="bg-white shadow-md text-black rounded-xl p-6 lg:p-12 flex flex-col md:flex-row space-y-4 md:space-y-0 md:space-x-4 border-[#DAD4CC] border">
                            @if ($index % 2 !== 0)
                                <div class="order-2 md:order-1 md:w-1/2 py-4 sm:p-8 md:p-0">
                                    <img src="{{ $section['image'] }}" alt="" class="w-full rounded-lg object-cover">
                                </div>
                                <div class="order-1 md:order-2 flex flex-col justify-center md:w-1/2 text-left md:px-4">
                                    <h3 class="leading-none"><strong>{!! $section['header'] !!}</strong></h3>
                                    <hr class="border-[#DAD4CC] my-2 lg:my-4 border">
                                    <p class="leading-snug">{{ $section['subheader'] }}</p>
                                </div>
                            @else
                                <div class="order-1 md:order-1 flex flex-col justify-center md:w-1/2 text-left md:px-4">
                                    <h3 class="leading-none"><strong>{!! $section['header'] !!}</strong></h3>
                                    <hr class="border-[#DAD4CC] my-2 lg:my-4 border">
                                    <p class="leading-snug">{{ $section['subheader'] }}</p>
                                </div>
                                <div class="order-2 md:order-2 md:w-1/2 py-4 sm:p-8 md:p-0">
                                    <img src="{{ $section['image'] }}" alt="" class="w-full rounded-lg object-cover">
                                </div>
                            @endif
                        </div>
                    @endforeach
                </div>
            </div>
    </section>

    <section class="text-center px-5 sm:px-6 py-8 sm:py-16 lg:py-20  relative @if(empty($lifetime) && empty($ultimate)) hidden @endif">
            <div class="container mx-auto z-10 relative max-w-5xl">
                <h2 class="leading-tight"><strong>Complete the setup.</strong></h2>
                <p class="leading-tight my-5">Add the essential practice tools you need for the ultimate home practice space.</p>
                <img class="w-full max-w-5xl rounded-xl px-2" src="https://d21q7xesnoiieh.cloudfront.net/1200x0/filters:quality(95)/marketing/pianote/products/prima/setup-01.webp">
                <div class="flex flex-wrap text-left pt-4">
                    <div class="w-full sm:w-1/2 px-2">
                        <img class="rounded-xl" src="https://d21q7xesnoiieh.cloudfront.net/700x0/filters:quality(95)/marketing/pianote/products/prima/setup-02.webp">
                        <h6 class="pt-4"><strong>The Prima Keyboard Stand</strong></h6>
                        <p class="lg:pr-6">This double braced "X" style keyboard stand is lightweight but very strong.<br><br>Adjusting this stand to the perfect height is easy, thanks to the trigger style latch- you can do it with a single finger!</p>
                    </div>
                    <div class="w-full sm:w-1/2 px-2">
                        <img class="rounded-xl" src="https://d21q7xesnoiieh.cloudfront.net/700x0/filters:quality(95)/marketing/pianote/products/prima/setup-03.webp">
                        <h6 class="pt-4"><strong>The Prima Bench</strong></h6>
                        <p class="lg:pr-6">This compact heavy duty bench is comfortable, adjustable and portable.<br><br>It folds flat for storage or transport, and is height adjustable to help you find that perfect position for practice and performance!</p>
                    </div>
                </div>
                @if (!empty($ultimate))
                <div class="flex flex-wrap text-left pt-4">
                    <div class="w-full sm:w-1/2 px-2">
                        <img class="rounded-xl" src="https://d21q7xesnoiieh.cloudfront.net/700x0/filters:quality(95)/marketing/pianote/products/prima/bundle/setup-04.webp">
                        <h6 class="pt-4"><strong>The Pianote Metronome</strong></h6>
                        <p class="lg:pr-6">Develop your rhythm, timing, and coordination with this beautiful compact metronome made in Germany by Wittner.<br><br>It’s the most important practice tool you’ll ever have. Work on your tempo, rhythm, and speed with a metronome you can trust.</p>
                    </div>
                    <div class="w-full sm:w-1/2 px-2">
                        <img class="rounded-xl" src="https://d21q7xesnoiieh.cloudfront.net/700x0/filters:quality(95)/marketing/pianote/products/prima/bundle/setup-05.webp">
                        <h6 class="pt-4"><strong>The Music Theory Poster Bundle</strong></h6>
                        <p class="lg:pr-6">Connecting what you see on a page to the keys can feel like a giant leap.<br><br>That’s why we’ve made it easy with 6 beautiful full-color posters highlighting the essential theory you need to play the songs you love.</p>
                    </div>
                </div>
                @endif
            </div>
        </section>

    @php
        $targetSkus = ['new-piano-players-start-here', 'easy-chords', '30-day-blues-piano', '30-days-to-better-technique', 'classical-piano-collection'];
    @endphp

    <section class="@if(!empty($ultimate)) pb-8 sm:pb-16 lg:pb-20 px-4 sm:px-6 @else py-8 sm:py-16 lg:py-20 px-4 sm:px-6 @endif @if(!empty($lifetime)) hidden @endif">        
    <div class="container mx-auto max-w-5xl">
            <div class="space-y-4 md:space-y-8">
                @foreach($packs as $pack)
                    @if(in_array($pack['sku'], $targetSkus))
                        <div class="rounded-xl overflow-hidden">
                            <div class="flex flex-col md:flex-row h-full">
                                <div class="relative w-full md:w-5/12 lg:w-1/2 rounded-2xl">
                                    <div class="aspect-video relative cursor-pointer">
                                        <img 
                                            src="https://d21q7xesnoiieh.cloudfront.net/700x0/filters:quality(95)/{{ $pack['image'] }}"
                                            alt="{{ $pack['header'] }}"
                                            class="w-full h-full object-cover rounded-2xl"
                                            @if(!empty($pack['vimeoId'])) @click="modal{{ $pack['vimeoId'] }} = true" @endif
                                        />
                                    </div>
                                </div>

                                <div class="p-4 sm:px-4 sm:py-0 md:w-7/12 lg:w-1/2 flex flex-col justify-center lg:px-10">
                                    <h5 class="mb-2"><strong>{!! $pack['header'] !!}</strong>
                                    </h5>
                                    <div class="flex items-center space-x-2 mb-4">
                                        <span class="text-lg line-through opacity-30"><strong>${{ $pack['price'] }}</strong></span>
                                        <span class="px-2 py-1 bg-musora text-black text-base font-bold rounded">
                                            {{ $pack['badge'] }}
                                        </span>
                                    </div>
                                    <div>
                                        {!! $pack['description'] !!}
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                @endforeach
            </div>
        </div>
    </section>
    
    <section class="text-center px-4 sm:px-6 py-8 sm:py-16 lg:py-20 relative text-white"
    style="background:linear-gradient(to bottom, #F61A30, #900F1C);">
        <div class="container mx-auto z-10 relative max-w-4xl">
            <h2 class="leading-tight"><strong>Peace of mind - guaranteed.</strong></h2>
            <p class="leading-tight mt-2 mb-5 sm:mb-7">Your piano includes a 90-day lessons guarantee from Pianote + a 2-year parts warranty for your Prima.</p>
            @if(!empty($lifetime))
                <picture>
                    <source media="(min-width:640px)" type="image/png" srcset="https://d21q7xesnoiieh.cloudfront.net/fit-in/1270x0/filters:quality(95)/marketing/pianote/products/prima/warranty.webp">
                    <img class="transition-opacity opacity-0 h-20 sm:h-36" alt="icon" loading="lazy"
                        onload="this.classList.remove('opacity-0')"
                        src="https://d21q7xesnoiieh.cloudfront.net/fit-in/700x0/filters:quality(95)/marketing/pianote/products/prima/warranty.webp">
                </picture>
            @else
                <picture>
                    <source media="(min-width:640px)" type="image/png" srcset="https://d21q7xesnoiieh.cloudfront.net/fit-in/1270x0/filters:quality(95)/marketing/pianote/products/prima/bundle/warranty.webp">
                    <img class="transition-opacity opacity-0 h-16 sm:h-36" alt="icon" loading="lazy"
                        onload="this.classList.remove('opacity-0')"
                        src="https://d21q7xesnoiieh.cloudfront.net/fit-in/700x0/filters:quality(95)/marketing/pianote/products/prima/bundle/warranty.webp">
                </picture>
            @endif
        </div>
    </section>

    <div id="customize-anchor" class="anchor"></div>
    @if(!empty($lifetime))
        <section class="text-center px-5 sm:px-6 py-10 sm:py-14 lg:py-16" style="background-color:#F4F8FB;">
            <div class="container mx-auto relative z-10 max-w-3xl">
                <div class="flex flex-wrap items-start justify-center mx-auto my-5 sm:my-8">
                        @include('drumeo.products.partials._order-card', [
                            'header' => 'The Pianote PRIMA',
                            'image' => 'https://d21q7xesnoiieh.cloudfront.net/fit-in/570x0/filters:quality(95)/marketing/pianote/products/prima/order-01.webp',
                            'imageHeight' => 'h-24 lg:h-28 px-4',
                            'fullPrice' => "$" . floatval($productPrices['practice-kit']->price),
                            'price' => "$" . floatval($productPrices['practice-kit']->discounted_price),
                            'specialText' => 'Free Shipping in the USA<br>*Discounted rates elsewhere',
                            'cta' => 'BUY NOW',
                            'highlightBorder' => true,
                            'link' => '/ecommerce/add-to-cart?products[pianote-headphones-2024]=1',
                            'bonuses' => [
                                '<i class="fas fa-check text-pianote mr-1"></i> The Pianote Prima',
                                '<i class="fas fa-check text-pianote mr-1"></i> 88-key Progressive Lever Hammer Action',
                                '<i class="fas fa-check text-pianote mr-1"></i> Stereo Speakers',
                                '<i class="fas fa-check text-pianote mr-1"></i> Double Headphone Jack',
                                '<i class="fas fa-check text-pianote mr-1"></i> Bluetooth Connectivity',
                                '<i class="fas fa-check text-pianote mr-1"></i> 4 Built-in Metronomes',
                                '<i class="fas fa-check text-pianote mr-1"></i> 238 Built-in Sounds',
                                '<i class="fas fa-check text-pianote mr-1"></i> True Piano Sustain Pedal',
                                '<i class="fas fa-check text-pianote mr-1"></i> Music Stand Included',
                                '<i class="fas fa-check text-pianote mr-1"></i> USB MIDI and Audio In/Out',
                            ],
                        ])
                        @include('drumeo.products.partials._order-card', [
                           'firstOnMobile' => true,
                           'header' => 'Add a Bench & Stand',
                           'image' => 'https://d21q7xesnoiieh.cloudfront.net/fit-in/570x0/filters:quality(95)/marketing/pianote/products/prima/order-02.webp',
                           'imageHeight' => 'h-24 lg:h-28',
                           'price' => '$750',
                           'specialText' => 'Free Shipping in the USA *Discounted rates elsewhere',
                           'cta' => 'BUY NOW',
                           'highlightBorder' => true,
                           'link' => '/ecommerce/add-to-cart?products[PIANOTE-MEMBERSHIP-1-YEAR]=1&products[pianote-headphones-2024]=1&promo-code=headphones-annual&locked=true',
                            'bonuses' => [
                            '<i class="fas fa-check text-pianote mr-1"></i> The Pianote Prima',
                            '<i class="fas fa-check text-pianote mr-1"></i> Prima Keyboard Stand',
                            '<i class="fas fa-check text-pianote mr-1"></i> Prima Piano Bench',
                            '<i class="fas fa-check text-pianote mr-1"></i> 88-key Progressive Lever Hammer Action',
                            '<i class="fas fa-check text-pianote mr-1"></i> Stereo Speakers',
                            '<i class="fas fa-check text-pianote mr-1"></i> Double Headphone Jack',
                            '<i class="fas fa-check text-pianote mr-1"></i> Bluetooth Connectivity',
                            '<i class="fas fa-check text-pianote mr-1"></i> 4 Built-in Metronomes',
                            '<i class="fas fa-check text-pianote mr-1"></i> 238 Built-in Sounds',
                            '<i class="fas fa-check text-pianote mr-1"></i> True Piano Sustain Pedal',
                            '<i class="fas fa-check text-pianote mr-1"></i> Music Stand Included',
                            '<i class="fas fa-check text-pianote mr-1"></i> USB MIDI and Audio In/Out',
                        ],
                       ])
                    </div>
            </div>
        </section>
    @else
        <section class="px-3 sm:px-0 text-center relative z-50 overflow-hidden"
            @if(!empty($ultimate)) style="background: #000; color:#fff" @endif style="background: #F1EFED; color:#000;" >
            <div class="container max-w-6xl mx-auto relative z-50">
                <div class="flex flex-wrap sm:flex-nowrap items-center px-4 sm:px-6 py-10 md:py-16 lg:py-20">
                    <div class="text-center sm:text-left w-full sm:w-auto flex-shrink-0">

                        @if(!empty($ultimate))
                            <h2 class="pb-6 sm:pb-4 leading-tight"><strong>Everything you<br> need to start<br> playing the piano. </strong></h2>
                            <h6 class="leading-tight max-w-md">Get the PRIMA Ultimate bundle + 1 year of <br class="hidden md:block">unlimited piano lessons + 7 extra launch bonuses.</h6>

                        <h4 class="my-4"> ONLY
                            @if(floatval($productPrices['alesis-ekit']->price) > floatval($productPrices['alesis-ekit']->discounted_price))
                                <s class="opacity-50">${{ floatval($productPrices['alesis-ekit']->price) }}</s>
                                <strong>${{ floatval($productPrices['alesis-ekit']->discounted_price) }}</strong>
                                 (Save {{ round(100 - (100 * (floatval($productPrices['alesis-ekit']->discounted_price) / floatval($productPrices['alesis-ekit']->price)))) }}%)
                            @else
                                <strong>${{ floatval($productPrices['alesis-ekit']->discounted_price) }}</strong>
                            @endif
                        </h4>
                        <a class="join smaller w-full max-w-xs" href="{{ $orderUrl }}">Start Playing</a>
                    </div>
                    <div class="flex justify-center sm:justify-start w-full sm:w-auto flex-grow-1 sm:order-1 sm:pl-5 mt-5 sm:mt-0">
                            <picture>
                                <source media="(min-width:1024px)" type="image/png" srcset="https://d21q7xesnoiieh.cloudfront.net/fit-in/1400x0/filters:quality(95)/marketing/pianote/products/prima/bundle/order-ultimate.webp">
                                <source media="(min-width:640px)" type="image/png" srcset="https://d21q7xesnoiieh.cloudfront.net/fit-in/780x0/filters:quality(95)/marketing/pianote/products/prima/bundle/order-ultimate.webp">
                                <img class="transition-opacity opacity-0 w-full" alt="icon" loading="lazy"
                                    onload="this.classList.remove('opacity-0')"
                                    src="https://d21q7xesnoiieh.cloudfront.net/fit-in/640x0/filters:quality(95)/marketing/pianote/products/prima/bundle/order-ultimate.webp">
                            </picture>
                        @else
                            <h2 class="pb-6 sm:pb-4 leading-tight"><strong>The Perfect Way <br> to Start Playing<br> the Piano. </strong></h2>
                            <h6 class="leading-tight max-w-xs">Get the PRIMA bundle + 1 year of <br class="hidden md:block">unlimited piano lessons + 5 extra <br class="hidden md:block">launch bonuses.</h6>

                        <h4 class="my-4"> ONLY
                            @if(floatval($productPrices['alesis-ekit']->price) > floatval($productPrices['alesis-ekit']->discounted_price))
                                <s class="opacity-50">${{ floatval($productPrices['alesis-ekit']->price) }}</s>
                                <strong>${{ floatval($productPrices['alesis-ekit']->discounted_price) }}</strong>
                                 (Save {{ round(100 - (100 * (floatval($productPrices['alesis-ekit']->discounted_price) / floatval($productPrices['alesis-ekit']->price)))) }}%)
                            @else
                                <strong>${{ floatval($productPrices['alesis-ekit']->discounted_price) }}</strong>
                            @endif
                        </h4>
                        <a class="join smaller w-full max-w-xs" href="{{ $orderUrl }}">Start Playing</a>
                    </div>
                    <div class="flex justify-center sm:justify-start w-full sm:w-auto flex-grow-1 sm:order-1 sm:pl-5 mt-5 sm:mt-0">
                            <picture>
                                <source media="(min-width:1024px)" type="image/png" srcset="https://d21q7xesnoiieh.cloudfront.net/fit-in/1400x0/filters:quality(95)/marketing/pianote/products/prima/bundle/order.webp">
                                <source media="(min-width:640px)" type="image/png" srcset="https://d21q7xesnoiieh.cloudfront.net/fit-in/780x0/filters:quality(95)/marketing/pianote/products/prima/bundle/order.webp">
                                <img class="transition-opacity opacity-0 w-full" alt="icon" loading="lazy"
                                    onload="this.classList.remove('opacity-0')"
                                    src="https://d21q7xesnoiieh.cloudfront.net/fit-in/640x0/filters:quality(95)/marketing/pianote/products/prima/bundle/order.webp">
                            </picture>
                        @endif
                    </div>
                </div>
            </div>
        </section>
    @endif

    <section class="text-center px-4 sm:px-6 py-10"
        @if(!empty($ultimate))
            style="background: #1D1B1B; color:#fff"
        @else
            style="background:#EAE4DF;"
        @endif>
        <div class="container max-w-5xl mx-auto relative z-50">
            <p class="leading-normal" style="width: 100%"><strong>Free Shipping In The USA</strong>
                *Discounted rates elsewhere </p>
        </div>
    </section>


    <section class="text-center py-10" style="background: #00101D;">
        <div class="container mx-auto relative z-50">
            <div class="inline-block w-full px-3 md:px-4 mb-5 text-white">
                <p>Call us toll-free at
                    <a href="tel:+18004398921">1-800-439-8921</a> <br class="inline-block md:hidden"> or directly at
                    <a href="tel:+16048557605">1-604-855-7605</a>.<br> All prices listed in USD. </p>
            </div>
            <div class="inline-block w-full px-3 md:px-4 text-white" style="margin-top: 0;">
                <i class="mx-0.5 text-3xl md:text-4xl fab fa-cc-visa"></i>
                <i class="mx-0.5 text-3xl md:text-4xl fab fa-cc-mastercard"></i>
                <i class="mx-0.5 text-3xl md:text-4xl fab fa-cc-amex"></i>
                <i class="mx-0.5 text-3xl md:text-4xl fab fa-cc-paypal"></i>
                <i class="mx-0.5 text-3xl md:text-4xl fab fa-cc-discover"></i>
            </div>
        </div>
    </section>

    @include('_partials.components.video-modal',[
        'name' => 'trailer',
        'video' => '913081651',
        'vimeo' => true,
    ])

    @include('_partials.components.video-modal',[
        'name' => 'modal798501810',
        'video' => '798501810',
        'vimeo' => true,
    ])
     @include('_partials.components.video-modal',[
        'name' => 'modal823788317',
        'video' => '823788317',
        'vimeo' => true,
    ])
    @include('_partials.components.video-modal',[
        'name' => 'modal852795615',
        'video' => '852795615',
        'vimeo' => true,
    ])
    @include('_partials.components.video-modal',[
        'name' => 'modal928599834',
        'video' => '928599834',
        'vimeo' => true,
    ])
    @include('_partials.components.video-modal',[
        'name' => 'modal1008560089',
        'video' => '1008560089',
        'vimeo' => true,
    ])

    @include("pianote.sales.partials._footer")
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script type="text/javascript" src="{{ asset('/marketing/parcel/drumeo/navigation-sales.js') }}" defer></script>
    <script src="https://cdn.jsdelivr.net/npm/@splidejs/splide@4.0.7/dist/js/splide.min.js"></script>
@stop
