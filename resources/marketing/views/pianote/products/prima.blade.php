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
            <h2 class="relative w-auto inline-block leading-tight">
                <strong><u style="text-decoration-color: #F61A30;">Everything you need</u></strong> to <br class="hidden sm:inline">
                start playing the piano.
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
         @if(!empty($ultimate))
            <div class="top-0 left-0 absolute w-full h-full z-10 opacity-60" style="background: linear-gradient(45deg, #A80011, #310A58 40%);"></div>
        @else
        <div class="top-0 left-0 absolute w-full h-full z-10" style="background: rgba(0, 0, 0, 0.8)"></div>
        @endif
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
            <img class="h-10 md:h-16 my-6" src="https://d21q7xesnoiieh.cloudfront.net/700x0/filters:quality(95)/marketing/pianote/products/prima/pianote-prima.svg">
            <img class="w-full max-w-5xl" src="">
        </div>
    </section>
    <section class="text-center px-5 sm:px-6 py-8 sm:py-16 lg:py-20 relative"
    @if(!empty($ultimate)) style="background: #1D1B1B; color:#fff" @endif style="background: #F1EFED;"
    >
        <div class="container mx-auto z-10 relative max-w-5xl">
            <h2 class="leading-tight mb-3"><strong>Premium Features. Beginner Price.</strong></h2>
            @php
                $items = [
                    [
                    'img' => 'https://d21q7xesnoiieh.cloudfront.net/fit-in/1500x0/filters:quality(95)/marketing/pianote/products/practice-kit/features-02.webp',
                    'title' => '88-Key Progressive Hammer Action',
                    'desc' => 'The fully weighted hammer-action keys mimic the feel of a real piano, providing a heavier touch in the lower registers and a lighter touch for the high notes<br><br>Whether you\'re playing simple scales or tackling more advanced pieces, the Prima’s keys offer a realistic feel that builds strength and dexterity, giving you the confidence to play on any piano.',
                    ],
                    [
                    'img' => 'https://d21q7xesnoiieh.cloudfront.net/fit-in/1500x0/filters:quality(95)/marketing/pianote/products/practice-kit/features-02.webp',
                    'title' => 'Seamless Connection to Your Lessons &  Music',
                    'desc' => 'With Bluetooth audio and MIDI, you can wirelessly connect the Prima to your tablet or phone for easy access to your Pianote lessons. Or stream music directly through the piano’s speakers.<br><br>Imagine streaming your favorite song directly through the piano’s speakers and playing along. With Prima, you can connect to lessons or jam sessions without any messy cables.',
                    ],
                    [
                    'img' => 'https://d21q7xesnoiieh.cloudfront.net/fit-in/1500x0/filters:quality(95)/marketing/pianote/products/practice-kit/features-02.webp',

                    'title' => 'A World of Sound at Your Fingertips',
                    'desc' => 'With 238 different tones, from classic grand pianos to strings, organs, and more, the Prima gives you endless options for creativity.<br><br>Switch between piano and strings, or experiment with jazz organ and orchestral sounds. The variety will keep you inspired and motivated to practice.',
                    ],
                    [
                    'img' => 'https://d21q7xesnoiieh.cloudfront.net/fit-in/1500x0/filters:quality(95)/marketing/pianote/products/practice-kit/features-02.webp',
                    'title' => 'Hear Every Note in Full, Rich Detail',
                    'desc' => 'The built-in stereo speakers are designed to fill your space with clear, balanced sound, while the stereo headphone jack ensures that you can practice privately without sacrificing sound quality.<br><br>Whether you’re practicing quietly late at night or performing for friends, the Prima delivers rich, concert-quality sound that brings your music to life.',
                    ],
                    [
                    'img' => 'https://d21q7xesnoiieh.cloudfront.net/fit-in/1500x0/filters:quality(95)/marketing/pianote/products/practice-kit/features-02.webp',
                    'title' => 'True Piano Sustain Pedal',
                    'desc' => 'Unlike the cheap plastic pedals that come with many beginner digital pianos, the Prima features a premium sustain pedal that feels just like a real acoustic piano pedal.<br><br>You’ll feel the difference immediately. It responds naturally to your touch, helping you develop the same techniques you would on a traditional acoustic piano.',
                    ],
                    [
                    'img' => 'https://d21q7xesnoiieh.cloudfront.net/fit-in/1500x0/filters:quality(95)/marketing/pianote/products/practice-kit/features-02.webp',
                    'title' => 'Lightweight and Portable',
                    'desc' => 'The Prima is easy to move around your home or take with you on the go. Whether you want to practice in different rooms, store it when not in use, or even take it to a friend\'s house or a class, you’ll have the flexibility to play wherever inspiration strikes.<br><br>At just [insert weight here], the Prima is easy to carry and set up anywhere, making it ideal for those with limited space or busy lives.',
                    ],
                    [
                    'img' => 'https://d21q7xesnoiieh.cloudfront.net/fit-in/1500x0/filters:quality(95)/marketing/pianote/products/practice-kit/features-02.webp',
                    'title' => 'Keep Perfect Time, Your Way',
                    'desc' => 'With four distinct metronome sounds, the Prima helps you develop a strong sense of rhythm, a critical skill for every pianist.<br><br>Choose from different metronome sounds to keep your practice engaging and help you stay on beat, no matter what style of music you’re playing.',
                    ],
                ];
            @endphp
            @foreach ($items as $index => $item)
                <div class="text-left flex flex-col sm:flex-row justify-center items-center md:py-10">
                    @if ($index % 2 == 0)
                        <img class="w-full sm:w-6/12 lg:w-1/2 rounded-xl overflow-hidden transition-opacity opacity-0 order-1 sm:order-1"
                            loading="lazy" onload="this.classList.remove('opacity-0')" src="{{ $item['img'] }}" alt="{{ $item['title'] }}">
                    @else
                        <img class="w-full sm:w-6/12 lg:w-1/2 rounded-xl overflow-hidden transition-opacity opacity-0 order-1 sm:order-2"
                            loading="lazy" onload="this.classList.remove('opacity-0')" src="{{ $item['img'] }}" alt="{{ $item['title'] }}">
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

    <section class="text-center px-5 sm:px-6 py-8 sm:py-16 lg:py-20 relative @if(!empty($lifetime)) hidden @endif"
        @if(!empty($ultimate)) style="background: #000; color:#fff;" @endif style="background: #F1EFED; color:#000;"
    >
        <div class="container mx-auto z-10 relative max-w-4xl">
            <h2 class="leading-tight"><strong>Your new Pianote Prima piano </strong></h2>
            <h3 class="leading-tight mt-1 mb-5 lg:mb-8">comes with unlimited piano lessons from <img src="https://d21q7xesnoiieh.cloudfront.net/700x0/filters:quality(95)/marketing/pianote/products/prima/pianote-logo.svg" alt="pianote logo" class="h-6 md:h-8"></h3>
            <div  @if(!empty($ultimate)) style="background: #F1EFED;" @endif style="background: #fff;" class="text-black text-left  rounded-xl border border-gray p-4 sm:p-6 mb-6 sm:mb-10">
                <h5 class="leading-tight"><strong>10-Level Curriculum</strong></h5>
                <h6 class="leading-normal mt-2 mb-5 lg:pr-10">The Pianote Method is your guided path to music freedom. Get expert step-by-step lessons from real piano teachers</h6>
                <div class="max-w-6xl mx-auto">
                    <div
                        x-data="{
                            init() {
                                new Splide(this.$refs.splide, {
                                    classes: {
                                            arrow: 'splide__arrow bg-white opacity-100 shadow-lg h-11 w-11',
                                            prev: 'hidden',
                                            next: 'splide__arrow--next prima-piano-next -right-1',
                                    },
                                    perPage: 4,
                                    perMove: 1,
                                    type: 'loop',
                                    focus: 0,
                                    interval: 2000,
                                    lazyLoad: 'nearby',
                                    pagination: false,
                                    breakpoints: {
                                        1020: {
                                        perPage: 3.5,
                                        },
                                        768: {
                                            perPage: 2.5,
                                            drag: 'free',
                                            snap: false,
                                        },
                                        620: {
                                            perPage: 1.5,
                                            arrows: false,
                                        },
                                    },
                                }).mount()
                            },
                        }"
                    >
                        <section x-ref="splide" class="splide mb-4 sm:mb-6">
                            <div class="splide__track">
                                <ul class="splide__list">
                                     @php
                                        $packs = [
                                            [
                                                "image" => "marketing/pianote/products/prima/method.jpg",
                                                "subheader" => "Getting Started On The Piano"
                                            ],
                                            [
                                                "image" => "marketing/pianote/products/prima/method.jpg",
                                                "subheader" => "Developing Dexterity And Keyboard Confidence"
                                            ],
                                            [
                                                "image" => "marketing/pianote/products/prima/method.jpg",
                                                "subheader" => "Chording"
                                            ],
                                            [
                                                "image" => "marketing/pianote/products/prima/method.jpg",
                                                "subheader" => "Playing Chords Like A Pro"
                                            ],
                                            [
                                                "image" => "marketing/musora/membership/homepage/2024/packs/Classical-Piano.webp",
                                                "subheader" => "Sight Reading"
                                            ],
                                            [
                                                "image" => "marketing/musora/membership/homepage/2024/packs/Creative-Songwriting.webp",
                                                "subheader" => "Developing Your Musicality"
                                            ],
                                            [
                                                "image" => "marketing/musora/membership/homepage/2024/packs/Gospel-Piano.webp",
                                                "subheader" => "Applying Technique & Solving Piano Player Problems"
                                            ],
                                            [
                                                "image" => "marketing/musora/membership/homepage/2024/packs/Improvisational-Jazz.webp",
                                                "subheader" => "Exploring Musical Styles"
                                            ],
                                            [
                                                "image" => "marketing/musora/membership/homepage/2024/packs/Latin-Piano-Essentials.webp",
                                                "subheader" => "Composition & Songwriting"
                                            ],
                                            [
                                                "image" => "marketing/musora/membership/homepage/2024/packs/Rhythmic-Playing.webp",
                                                "subheader" => "The Next Steps"
                                            ]
                                        ];
                                    @endphp
                                    
                                    @foreach ($packs as $index => $pack)
                                        <li class="splide__slide flex flex-col items-center justify-start px-1">
                                            <div class="relative w-full rounded-xl overflow-hidden" style="padding-bottom: 150%;">
                                                <picture>
                                                    <source media="(min-width:1024px)" data-srcset="https://d21q7xesnoiieh.cloudfront.net/fit-in/490x0/filters:quality(95)/{{$pack['image']}}">
                                                    <source media="(min-width:640px)" data-srcset="https://d21q7xesnoiieh.cloudfront.net/fit-in/320x0/filters:quality(95)/{{$pack['image']}}">
                                                    <img
                                                        class="absolute top-0 left-0 w-full h-full object-cover object-top transition-opacity opacity-0 duration-300"
                                                        data-splide-lazy="https://d21q7xesnoiieh.cloudfront.net/fit-in/490x0/filters:quality(95)/{{$pack['image']}}"
                                                        onload="this.classList.remove('opacity-0');"
                                                    />
                                                </picture>
                                                <div class="absolute bottom-1 left-0 w-full p-4 text-center text-white">
                                                    <div class="h-12 flex flex-col justify-between">
                                                         <h6 class="capitalized"><strong>Method Level {{ $index + 1 }}</strong></h6>
                                                        <p class="text-xs tracking-tight text-center">{{ $pack['subheader'] }}</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </section>
                    </div>
                </div>
            </div>
            <div  @if(!empty($ultimate)) style="background: #F1EFED;" @endif style="background: #fff;" class="text-black text-left  rounded-xl border border-gray p-4 sm:p-6 mb-6 sm:mb-10">
                <h5 class="leading-tight"><strong>Daily Practice Workouts</strong></h5>
                <h6 class="leading-normal mt-2 mb-5 lg:pr-10">Not sure what to practice?  Pick a 5, 10, or 15-minute routine and practice with a REAL teacher.<br> It’s like Peloton for your piano.</h6>
                <div class="max-w-6xl mx-auto">
                    <div x-data="{
                        init() {
                            new Splide(this.$refs.splide, {
                                classes: {
                                    arrow: 'splide__arrow bg-white opacity-100 shadow-lg h-11 w-11',
                                    prev: 'hidden',
                                    next: 'splide__arrow--next prima-piano-next -right-1',
                                },
                                perPage: 2.5,
                                perMove: 1,
                                type: 'loop',
                                focus: 0,
                                interval: 2000,
                                lazyLoad: 'nearby',
                                pagination: false,
                                breakpoints: {
                                    1020: {},
                                    768: {
                                        perPage: 2.5,
                                        drag: 'free',
                                        snap: false,
                                    },
                                    620: {
                                        perPage: 1.5,
                                        arrows: false,
                                    },
                                },
                            }).mount()
                        },
                    }">
                        <section x-ref="splide" class="splide mb-4 sm:mb-6">
                            <div class="splide__track">
                                <ul class="splide__list">
                                    @php
                                        $packs = [
                                            [
                                                "image" => "marketing/pianote/products/prima/Chord-Extensions-1715712021.jpg",
                                                "subtitle" => "Beautiful Pop Sounds"
                                            ],
                                            [
                                                "image" => "marketing/pianote/products/prima/Chord-Extensions-1715712021.jpg",
                                                "subtitle" => "Beginner Jazz Comping"
                                            ],
                                            [
                                                "image" => "marketing/pianote/products/prima/Chord-Extensions-1715712021.jpg",
                                                "subtitle" => "Advanced Chord Extensions"
                                            ],
                                            [
                                                "image" => "/marketing/pianote/products/prima/Chord-Extensions-1715712021.jpg",
                                                "subtitle" => "15-Minute Practice Routines"
                                            ],
                                        ]
                                    @endphp
                                    @foreach ($packs as $pack)
                                        <li class="splide__slide flex flex-col items-start justify-start px-1">
                                            <div class="relative w-full rounded-xl" style="padding-bottom: 58%;">
                                                <picture>
                                                    <source media="(min-width:1024px)" data-srcset="https://d21q7xesnoiieh.cloudfront.net/fit-in/490x0/filters:quality(95)/{{$pack['image']}}">
                                                    <source media="(min-width:640px)" data-srcset="https://d21q7xesnoiieh.cloudfront.net/fit-in/320x0/filters:quality(95)/{{$pack['image']}}">
                                                    <img
                                                        class="absolute top-0 left-0 w-full object-cover rounded-xl transition-opacity opacity-0 duration-300"
                                                        data-splide-lazy="https://d21q7xesnoiieh.cloudfront.net/fit-in/490x0/filters:quality(95)/{{$pack['image']}}"
                                                        onload="this.classList.remove('opacity-0');"
                                                    />
                                                </picture>
                                            </div>
                                            <p class="text-sm mt-2"><strong>{{ $pack['subtitle'] }}</strong></p>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </section>
                    </div>
                </div>
            </div>
            <div  @if(!empty($ultimate)) style="background: #F1EFED;" @endif style="background: #fff;" class="text-black text-left  rounded-xl border border-gray p-4 sm:p-6 mb-6 sm:mb-10">
                <h5 class="leading-tight"><strong>Your Favorite Songs</strong></h5>
                <h6 class="leading-normal mt-2 mb-5 lg:pr-10">You play piano to play songs! Learn and play your favorites from our massive library. Then make them sound beautiful on your new Prima piano.</h6>
                <div class="max-w-6xl mx-auto">
                    <div
                        x-data="{
                            init() {
                                new Splide(this.$refs.splide, {
                                    classes: {
                                            arrow: 'splide__arrow bg-white opacity-100 shadow-lg h-11 w-11',
                                            prev: 'hidden',
                                            next: 'splide__arrow--next prima-piano-next -right-1',
                                            pagination: 'splide__pagination flex -bottom-10',
                                    },
                                  
                                    perPage: 4,
                                    perMove: 1,
                                    type: 'loop',
                                    focus: 0,
                                    interval: 2000,
                                    lazyLoad: 'nearby',
                                    pagination: false,
                                    breakpoints: {
                                        1020: {
                                           
                                        },
                                        768: {
                                           
                                            perPage: 3,
                                            drag: 'free',
                                            snap: false,
                                        },
                                        620: {
                                           
                                            perPage: 2,
                                            arrows: false,
                                        },
                                    },
                                }).mount()
                            },
                        }"
                    >
                        <section x-ref="splide" class="splide mb-4 sm:mb-6">
                            <div class="splide__track">
                                <ul class="splide__list">
                                    @php
                                        $packs = [
                                                [
                                                    "image" => "marketing/pianote/products/classical-piano-collection/prelude-in-c.webp",
                                                ],
                                                [
                                                    "image" => "marketing/pianote/products/classical-piano-collection/fur-elise.webp",
                                                ],
                                                [
                                                    "image" => "marketing/pianote/products/classical-piano-collection/moonlight-sonata.webp",
                                                ],
                                                [
                                                    "image" => "marketing/pianote/products/classical-piano-collection/prelude-in-e-minor.webp",
                                                ],
                                                [
                                                    "image" => "marketing/pianote/products/classical-piano-collection/gymnopedie.webp",
                                                ]
                                        ]
                                    @endphp
                                    @foreach ($packs as $image)
                                        <li class="splide__slide flex flex-col items-center justify-start px-1">
                                            <div class="relative w-full rounded-xl overflow-hidden" style="padding-bottom: 150%;">
                                                <picture>
                                                    <source media="(min-width:1024px)" data-srcset="https://d21q7xesnoiieh.cloudfront.net/fit-in/490x0/filters:quality(95)/{{$image['image']}}">
                                                    <source media="(min-width:640px)" data-srcset="https://d21q7xesnoiieh.cloudfront.net/fit-in/320x0/filters:quality(95)/{{$image['image']}}">
                                                    <img
                                                        class="absolute top-0 left-0 w-full h-full object-cover object-top transition-opacity opacity-0 duration-300"
                                                        data-splide-lazy="https://d21q7xesnoiieh.cloudfront.net/fit-in/490x0/filters:quality(95)/{{$image['image']}}"
                                                        onload="this.classList.remove('opacity-0');"
                                                    />
                                                </picture>
                                            </div>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </section>
                    </div>
                </div>
            </div>
            <div  @if(!empty($ultimate)) style="background: #F1EFED;" @endif style="background: #fff;" class="text-black text-left  rounded-xl border border-gray p-4 sm:p-6">
                <h5 class="leading-tight"><strong>The World’s Best Piano Players</strong></h5>
                <p class="leading-tight mt-2 mb-5">Learn from legends and connect with real, friendly piano teachers who care about your goals. </p>
                <div class="max-w-6xl mx-auto">
                    <div
                        x-data="{
                            init() {
                                new Splide(this.$refs.splide, {
                                    classes: {
                                            arrow: 'splide__arrow bg-white opacity-100 shadow-lg h-11 w-11',
                                            prev: 'hidden',
                                            next: 'splide__arrow--next your-class-next -right-1',
                                            pagination: 'splide__pagination flex -bottom-10',
                                    },
                                    perPage: 4,
                                    perMove: 1,
                                    type: 'loop',
                                    focus: 0,
                                    interval: 2000,
                                    lazyLoad: 'nearby',
                                    pagination: false,
                                    breakpoints: {
                                        1020: {
                                        },
                                        768: {
                                            perPage: 3,
                                            drag: 'free',
                                            snap: false,
                                        },
                                        620: {
                                            perPage: 2,
                                            arrows: false,
                                        },
                                    },
                                }).mount()
                            },
                        }"
                    >
                        <section x-ref="splide" class="splide mb-4 sm:mb-6">
                            <div class="splide__track">
                                <ul class="splide__list">
                                    @php
                                        $packs = [
                                                [
                                                    "image" => "marketing/musora/membership/homepage/2024/packs/30TBT.webp",
                                                ],
                                                [
                                                    "image" => "marketing/musora/membership/homepage/2024/packs/NPPSH.webp",
                                                ],
                                                [
                                                    "image" => "marketing/musora/membership/homepage/2024/packs/EC.webp",
                                                ],
                                                [
                                                    "image" => "marketing/musora/membership/homepage/2024/packs/30DBP.webp",
                                                ],
                                                [
                                                    "image" => "marketing/musora/membership/homepage/2024/packs/Classical-Piano.webp",
                                                ],
                                                [
                                                    "image" => "marketing/musora/membership/homepage/2024/packs/Creative-Songwriting.webp",
                                                ],
                                                [
                                                    "image" => "marketing/musora/membership/homepage/2024/packs/Gospel-Piano.webp",
                                                ],
                                                [
                                                    "image" => "marketing/musora/membership/homepage/2024/packs/Improvisational-Jazz.webp",
                                                ],
                                                [
                                                    "image" => "marketing/musora/membership/homepage/2024/packs/Latin-Piano-Essentials.webp",
                                                ],
                                                [
                                                    "image" => "marketing/musora/membership/homepage/2024/packs/Rhythmic-Playing.webp",
                                                ],
                                                [
                                                    "image" => "marketing/musora/membership/homepage/2024/packs/Simple-Piano-Arpeggios.webp",
                                                ],
                                                [
                                                    "image" => "marketing/musora/membership/homepage/2024/packs/The-Perfect-Arrangement.webp",
                                                ],
                                        ]
                                    @endphp
                                    @foreach ($packs as $image)
                                        <li class="splide__slide flex flex-col items-center justify-start px-1">
                                            <div class="relative w-full rounded-xl overflow-hidden" style="padding-bottom: 150%;">
                                                <picture>
                                                    <source media="(min-width:1024px)" data-srcset="https://d21q7xesnoiieh.cloudfront.net/fit-in/490x0/filters:quality(95)/{{$image['image']}}">
                                                    <source media="(min-width:640px)" data-srcset="https://d21q7xesnoiieh.cloudfront.net/fit-in/320x0/filters:quality(95)/{{$image['image']}}">
                                                    <img
                                                        class="absolute top-0 left-0 w-full h-full object-cover object-top transition-opacity opacity-0 duration-300"
                                                        data-splide-lazy="https://d21q7xesnoiieh.cloudfront.net/fit-in/490x0/filters:quality(95)/{{$image['image']}}"
                                                        onload="this.classList.remove('opacity-0');"
                                                    />
                                                </picture>
                                            </div>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </section>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="text-center px-5 sm:px-6 py-8 sm:py-16 lg:py-20  relative @if(empty($lifetime) && empty($ultimate)) hidden @endif"
        @if(!empty($ultimate)) style="background: #1D1B1B; color:#fff" @endif>
        <div class="container mx-auto z-10 relative max-w-4xl">
            <h2 class="leading-tight"><strong>Complete the setup.</strong></h2>
            <p class="leading-tight my-5">Add the essential practice tools you need for the ultimate home practice space.</p>
            <img class="w-full max-w-5xl" src="">
            <div class="flex flex-wrap text-left">
                <div class="w-1/2 px-2">
                    <img class="rounded-xl">
                    <h6><strong>The Prima Keyboard Stand</strong></h6>
                    <p>This double braced "X" style keyboard stand is lightweight but very strong.<br><br>Adjusting this stand to the perfect height is easy, thanks to the trigger style latch- you can do it with a single finger!</p>
                </div>
                <div class="w-1/2 px-2">
                    <img class="rounded-xl">
                    <h6><strong>The Prima Bench</strong></h6>
                    <p>This compact heavy duty bench is comfortable, adjustable and portable.<br><br>It folds flat for storage or transport, and is height adjustable to help you find that perfect position for practice and performance!</p>
                </div>
            </div>
            <div class="flex flex-wrap text-left">
                <div class="w-1/2 px-2">
                    <img class="rounded-xl">
                    <h6><strong>The Pianote Metronome</strong></h6>
                    <p>Develop your rhythm, timing, and coordination with this beautiful compact metronome made in Germany by Wittner.<br><br>It’s the most important practice tool you’ll ever have. Work on your tempo, rhythm, and speed with a metronome you can trust.</p>
                </div>
                <div class="w-1/2 px-2">
                    <img class="rounded-xl">
                    <h6><strong>The Music Theory Poster Bundle</strong></h6>
                    <p>Connecting what you see on a page to the keys can feel like a giant leap.<br><br>That’s why we’ve made it easy with 6 beautiful full-color posters highlighting the essential theory you need to play the songs you love.</p>
                </div>
            </div>
        </div>
    </section>
    @php
        $packs = [
            [
                "image" => "marketing/pianote/products/prima/NPPH.jpg",
                "header" => "New Piano Players Start <br>Here",
                "subheader" => "Your first 30 days on the piano. Learn in just 10 minutes per day."
            ],
            [
                "image" => "marketing/pianote/products/prima/RM30D.jpg",
                "header" => "Read Music in <br>30 Days",
                "subheader" => "Learn the language of music. Play your favorite songs."
            ],
            [
                "image" => "marketing/pianote/products/prima/BP.jpg",
                "header" => "30-Day Blues<br> Piano",
                "subheader" => "Learn cool riffs, licks, and scales to play the Blues."
            ],
            [
                "image" => "marketing/pianote/products/prima/CPC.jpg",
                "header" => "The Classical Piano<br> Collection",
                "subheader" => "Learn 5 iconic pieces with note-for-note tutorials."
            ],
            [
                "image" => "marketing/pianote/products/prima/EC.jpg",
                "header" => "Easy Chords",
                "subheader" => "Improve your piano chord inversions in just 30 days."
            ],
        ];
    @endphp
    
    <section class="text-center px-5 sm:px-6 py-8 sm:py-16 lg:py-20 relative @if(!empty($lifetime)) hidden @endif"
        @if(!empty($ultimate)) style="background: #000; color:#fff" @endif>
        <div class="container mx-auto z-10 relative max-w-5xl">
            <h2 class="leading-tight"><strong>Lessons that are yours to keep -- for life.</strong></h2>
            <p class="leading-tight my-5">These 30-Day Courses are yours to keep forever, even if you choose not to renew your Pianote membership.</p>
            <div class="grid sm:grid-cols-3 lg:grid-cols-5 gap-4">
                @foreach ($packs as $pack)
                    <div class="px-1">
                        <img src="https://d21q7xesnoiieh.cloudfront.net/fit-in/320x0/filters:quality(95)/{{ $pack['image'] }}" class="rounded-xl w-full h-auto">
                        <p class="leading-normal tracking-tight my-1"><strong>{!! $pack['header'] !!}</strong></p>
                        <p class="leading-tight text-xs">{{ $pack['subheader'] }}</p>
                    </div>
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

            @else
                <picture>
                    <source media="(min-width:640px)" type="image/png" srcset="https://d21q7xesnoiieh.cloudfront.net/fit-in/1270x0/filters:quality(95)/marketing/drumeo/products/kit/guarantee.png">
                    <img class="transition-opacity opacity-0 h-16 sm:h-36" alt="icon" loading="lazy"
                        onload="this.classList.remove('opacity-0')"
                        src="https://d21q7xesnoiieh.cloudfront.net/fit-in/700x0/filters:quality(95)/marketing/drumeo/products/kit/guarantee.png">
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
                            'header' => 'Pianote Headphones',
                            'image' => 'https://d21q7xesnoiieh.cloudfront.net/fit-in/570x0/filters:quality(95)/marketing/pianote/products/headphones/order.webp',
                            'imageHeight' => 'h-28 lg:h-32',
                            'fullPrice' => "$" . floatval($productPrices['practice-kit']->price),
                            'price' => "$" . floatval($productPrices['practice-kit']->discounted_price),
                            'specialText' => 'One-time payment.',
                            'cta' => 'SELECT',
                            'link' => '/ecommerce/add-to-cart?products[pianote-headphones-2024]=1',
                            'bonuses' => [
                                '<strong>1 Pair of Pianote Headphones</strong>',
                                '1.8m cable',
                                '6.3mm stereo adapter',
                            ],
                        ])
                        @include('drumeo.products.partials._order-card', [
                           'firstOnMobile' => true,
                           'header' => 'Headphones + 1 Year<br>Pianote Membership',
                           'image' => 'https://d21q7xesnoiieh.cloudfront.net/fit-in/570x0/filters:quality(95)/marketing/pianote/products/headphones/order-bundle.webp',
                           'imageHeight' => 'h-28 lg:h-32',
                           'price' => '<span class="text-2xl md:text-3xl">Free Headphones</span>',
                           'specialText' => 'With Annual Membership of $240/yr',
                           'cta' => 'SELECT',
                           'link' => '/ecommerce/add-to-cart?products[PIANOTE-MEMBERSHIP-1-YEAR]=1&products[pianote-headphones-2024]=1&promo-code=headphones-annual&locked=true',
                           'bonuses' => [
                               '<strong>Everything included with the<br>Headphones PLUS:</strong>',
                               'Step-by-Step Lessons',
                               'Personalized Support',
                               'Song Tutorials',
                               'World-Class Instructors',
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
                                <source media="(min-width:1024px)" type="image/png" srcset="https://d21q7xesnoiieh.cloudfront.net/fit-in/1400x0/filters:quality(95)/marketing/drumeo/products/kit/ekit-lifetime.png">
                                <source media="(min-width:640px)" type="image/png" srcset="https://d21q7xesnoiieh.cloudfront.net/fit-in/780x0/filters:quality(95)/marketing/drumeo/products/kit/ekit-lifetime.png">
                                <img class="transition-opacity opacity-0 w-full" alt="icon" loading="lazy"
                                    onload="this.classList.remove('opacity-0')"
                                    src="https://d21q7xesnoiieh.cloudfront.net/fit-in/640x0/filters:quality(95)/marketing/drumeo/products/kit/ekit-lifetime.png">
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
                                <source media="(min-width:1024px)" type="image/png" srcset="https://d21q7xesnoiieh.cloudfront.net/fit-in/1400x0/filters:quality(95)/marketing/drumeo/products/kit/ekit-bundle2.webp">
                                <source media="(min-width:640px)" type="image/png" srcset="https://d21q7xesnoiieh.cloudfront.net/fit-in/780x0/filters:quality(95)/marketing/drumeo/products/kit/ekit-bundle2.webp">
                                <img class="transition-opacity opacity-0 w-full" alt="icon" loading="lazy"
                                    onload="this.classList.remove('opacity-0')"
                                    src="https://d21q7xesnoiieh.cloudfront.net/fit-in/640x0/filters:quality(95)/marketing/drumeo/products/kit/ekit-bundle2.webp">
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

    @include("pianote.sales.partials._footer")
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script type="text/javascript" src="{{ asset('/marketing/parcel/drumeo/navigation-sales.js') }}" defer></script>
    <script src="https://cdn.jsdelivr.net/npm/@splidejs/splide@4.0.7/dist/js/splide.min.js"></script>
@stop
