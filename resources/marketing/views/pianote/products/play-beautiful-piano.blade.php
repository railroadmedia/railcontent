@extends('pianote._partials.global-layout')

@section('global-head')
    <title>The Beginner's Guide To Playing Beautiful Piano | Pianote</title>
    <meta property="og:title" content="The Beginner's Guide To Playing Beautiful Piano">

    <meta name="description" content="Start playing beautiful music from your very 1st lesson!">
    <meta property="og:description" content="Start playing beautiful music from your very 1st lesson!">

    <meta property="og:image" content="https://pianote.s3.amazonaws.com/products/play-beautiful-piano/share-image.jpg" style="display: none;">
    <meta property="og:url" content="https://www.pianote.com/{{ Request::path() }}">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.19/tailwind.min.css" />
    <link href="{{ asset('/marketing/parcel/pianote/nav-footer.css') }}" rel="stylesheet">
    <link href="{{ asset('/marketing/parcel/pianote/play-beautiful-piano.css') }}" rel="stylesheet">
    <link href="{{ asset('/marketing/css/pianote/tailwind-helpers.css') }}" rel="stylesheet">
    <link href="{{ asset('/marketing/css/animate.css') }}" rel="stylesheet">
    <style>
        body.modal-open {
            overflow-y:hidden;
        }

        .modal-bg {
            z-index:100;
        }

        .modal-bg.active {
            visibility:visible;
            opacity:1;
        }

        .modal-bg:after {
            font-family:"Font Awesome 5 Pro";
            font-weight:900;
            font-style:normal;
            font-variant:normal;
            text-rendering:auto;
            content:"\f00d";
            color:#fff;
            z-index:1;
            opacity:0.8;
            position:fixed;
            margin:0;
            line-height:1em;
            text-align:center;
            display:inline-block;
            outline:none;
            top:0;
            right:0;
            font-size:35px;
            width:35px;

        }


        .modal-content {
            z-index:98;
            width:85%;
            max-width:750px;
        }

        .modal-content.active {
            display:block;
            opacity:1;
        }

        .tab-content.active {
            opacity:1;
            visibility:visible;
            height:100%;
        }

        .tab-switcher.active {
            background:#fff;
            border-color:#fff;
            color:#000c18;
        }

        .tab-switcher .bottom-arrow {
            border-width:10px 8px 0 8px;
            bottom:-10px;
            border-color:#ffffff transparent transparent transparent;
        }

        .tab-switcher.active .bottom-arrow {
            bottom:-12px;
            opacity:1;
        }


        .book {
            width:240px;
        }

        .header-text {
            margin-top:260px;
        }

        .dropdown .description {
            height:0;
            max-height:0;
            visibility:hidden;
            opacity:0;
            overflow:hidden;
        }

        .dropdown.active .description {
            visibility:visible;
            opacity:1;
            height:auto;
            max-height:400px;
        }

        @media (min-width:640px) {
            .modal-content {
                width:90%;
            }

            .book {
                width:290px;
            }

            .header-text {
                margin-top:430px;
            }
        }


        @media (min-width:768px) {
            .book {
                width:450px;
            }
        }

        @media (min-width:1024px) {
            .modal-bg:after {
                right:15px;
                font-size:50px;
                width:50px;
            }

            .modal-content {
                width:98%;
            }

            .book {
                width:570px;
            }

            .header-text {
                margin-top:530px;
            }

            .see-inside {
                right:10%;
            }
        }
        @media (min-width:1280px) {
            .see-inside {
                right:18%;
            }

        }
        .big-promo-banner {
            margin-bottom:-118px;
        }
        @media (min-width:768px) {
            .big-promo-banner {
                margin-bottom:-63px;
            }
        }
        @media (min-width:1024px) {
            .big-promo-banner {
                margin-bottom:-78px;
            }
        }
    </style>
@stop

@section('global-body')
    @include('pianote._partials._nav', [
        "cartVersion" => true
    ])

    @include('pianote._partials._promo-banner-no-tw', [
        "name" => "Playing Beautiful Piano",
        "fullPrice" => PianotePrices::$playBeautifulPianoFull,
        "price" => PianotePrices::$playBeautifulPiano,
                    "noBreadcrumb" => true
    ])
    <header class="header overflow-hidden w-full text-white bg-black text-center fixed z-0">
        <video class="object-cover h-full w-full relative z-0" src="https://pianote.s3.amazonaws.com/products/play-beautiful-piano/header-2.mp4" type="video/mp4" autoplay="" loop="" playsinline="" muted></video>
        <div class="overlay absolute top-0 left-0 z-10 h-full w-full" style="background: linear-gradient(to bottom, rgba(50,86,102,0.7) 0%, rgba(42,20,40,0.85) 100%);"></div>
        <div class="container mx-auto">
            <div class="transform -translate-x-1/2 -translate-y-1/2 left-1/2 top-1/2 w-full absolute z-30 animated fadeIn">
                <img class="h-20 md:h-40 lg:h-52 mx-auto" src="https://cdn.musora.com/image/fetch/w_1600,q_auto:best/https://pianote.s3.amazonaws.com/products/play-beautiful-piano/logo-2.png">
                <h4 class="leading-normal mb-5 md:mb-8">Start playing beautiful music from<br class="inline md:hidden"> your very 1st lesson - for just <strong>${{ PianotePrices::$playBeautifulPiano }}</strong>.</h4>
                <a class="join vue-add-to-cart" data-product-json='{"play-beautiful-piano": 1}' href="{{ url()->route('shopping-cart.add-to-cart', ['products' => ['play-beautiful-piano' => 1], 'redirect' => '/order']) }}">Play Beautifully &raquo;</a>
            </div>
            <div class="bottom absolute bottom-0 left-0 right-0 z-30 pb-5 md:pb-8"><img class="h-14 md:h-16 lg:h-20 animated infinite pulse" src="https://cdn.musora.com/image/fetch/w_70,q_auto:best/https://pianote.s3.amazonaws.com/products/play-beautiful-piano/treble-clef.png"></div>
        </div>
    </header>

    <div class="relative w-full my-64 md:my-96 py-3 md:py-10" style="z-index: -1;"></div>

    <section class="content-section overflow-hidden relative text-white text-center lazyload" style="background-image:url(https://cdn.musora.com/image/fetch/w_2500,q_auto:best/https://pianote.s3.amazonaws.com/products/play-beautiful-piano/background-main-thumb.jpg); background-size: cover;box-shadow: 0 0 50px rgba(0, 0, 0, 0.4);">
        <div class="container mx-auto relative z-20">
            <h2 class="text-shadow-3">Don’t you want your playing<br class="inline md:hidden"> to sound.... <strong>better?</strong></h2>
            <i class="fas fa-play play-button autoplay-video my-40 md:my-64 lg:my-72" data-open="trailer"></i>
        </div>
        <div class="overlay absolute top-0 left-0 z-10 h-full w-full" style="background: linear-gradient(to bottom, rgba(0,10,30,0.7) 0%, transparent 25%, transparent 100%);"></div>
    </section>
    <div class="reveal large text-center" id="trailer" data-reveal data-reset-on-close="false">
        <div class="aspect-16:9 w-full relative">
            <iframe class="absolute w-full h-full reset-on-close" src="" data-lazy-load-url="//player.vimeo.com/video/578586512?autoplay=1" frameborder="0" allowfullscreen allow="autoplay"></iframe>
        </div>
    </div>
    <section class="content-section overflow-hidden relative text-white text-center lazyload" data-bg="https://cdn.musora.com/image/fetch/w_2000,q_auto:best/https://pianote.s3.amazonaws.com/products/play-beautiful-piano/background-waves.jpg">
        <div class="container mx-auto">
            <h2>You <strong>want</strong> to sound beautiful, but…</h2>
            <p class="text-left max-w-2xl leading-relaxed mx-auto my-10 px-5 md:px-4">...you just don’t.
                <br><br>
                Not yet, anyway.
                <br><br>
                You want your playing to sound like the stunning music that made you fall in love with the piano. Like a soaring wave of emotion that wraps itself around you when you touch the keys.
                <br><br>
                But right now it just sounds clunky. Disjointed. Less of a wave and more of a trickle. It sounds…
                <br><br>
                Not beautiful.
                <br><br>
                That can be frustrating, annoying. It can even make you want to quit. But you know what?
                <br><br>
                It’s not your fault.
                <br><br>
                If your playing doesn’t sound like it does in your dreams, it’s likely because you’ve never been shown HOW to play that way. And if you’ve never been shown how -- then it only makes sense that you can’t.
                <br><br>
                Not yet, anyway...</p>
            <img class="h-14 md:h-16 lg:h-20 animated infinite pulse lazyload" data-src="https://cdn.musora.com/image/fetch/w_70,q_auto:best/https://pianote.s3.amazonaws.com/products/play-beautiful-piano/treble-clef.png">
        </div>
    </section>
    <section class="content-section overflow-hidden relative text-white text-center">
        <div class="container mx-auto">
            <h2><em>Your step-by-step journey to...</em></h2>
            <img class="h-20 md:h-40 lg:h-52 mx-auto my-3 md:my-4 lg:my-5 lazyload" data-src="https://cdn.musora.com/image/fetch/w_1600,q_auto:best/https://pianote.s3.amazonaws.com/products/play-beautiful-piano/logo-2.png">
            <p class="text-pianote mb-5 md:mb-10"><em><i class="fal fa-angle-down"></i> &nbsp; CLICK A LESSON TO PREVIEW &nbsp; <i class="fal fa-angle-down"></i></em></p>
        </div>
        <div class="flex flex-wrap mx-auto bg-white" style="max-width:2000px;">
            <a data-open="lesson1" class="w-1/2 lg:w-1/3 bg-cover bg-center pt-32 md:pt-44 lg:pt-52 pb-5 md:pb-8 lg:pb-12 relative cursor-pointer hover:opacity-95 autoplay-video lazyload" data-bg="https://cdn.musora.com/image/fetch/w_900,q_auto:best/https://pianote.s3.amazonaws.com/products/play-beautiful-piano/thumb-video-1.jpg">
                <p class="py-0.5 md:py-2 px-2 md:px-3 leading-none inline-block mx-auto mb-2 md:mb-4 md:tracking-widest relative z-20" style="background-color:#d04b4c;">LESSON 1</p>
                <h3 class="font-roboto uppercase leading-none tracking-tighter md:tracking-normal relative z-20"><strong>You didn’t know you<br> could sound this good</strong></h3>
                <div class="overlay absolute top-0 left-0 z-10 h-full w-full transition-opacity duration-300 hover:opacity-0" style="background: linear-gradient(to bottom, transparent 33%, rgba(0,10,30,0.7) 100%);"></div>
            </a>
            <a data-open="lesson2" class="w-1/2 lg:w-1/3 bg-cover bg-center pt-32 md:pt-44 lg:pt-52 pb-5 md:pb-8 lg:pb-12 relative cursor-pointer hover:opacity-95 autoplay-video lazyload" data-bg="https://cdn.musora.com/image/fetch/w_900,q_auto:best/https://pianote.s3.amazonaws.com/products/play-beautiful-piano/thumb-video-2.jpg">
                <p class="py-0.5 md:py-2 px-2 md:px-3 leading-none inline-block mx-auto mb-2 md:mb-4 md:tracking-widest relative z-20" style="background-color:#22aa55;">LESSON 2</p>
                <h3 class="font-roboto uppercase leading-none tracking-tighter md:tracking-normal relative z-20"><strong>Why you sounded<br>  amazing just then</strong></h3>
                <div class="overlay absolute top-0 left-0 z-10 h-full w-full transition-opacity duration-300 hover:opacity-0" style="background: linear-gradient(to bottom, transparent 33%, rgba(0,10,30,0.7) 100%);"></div>
            </a>
            <a data-open="lesson3" class="w-1/2 lg:w-1/3 bg-cover bg-center pt-32 md:pt-44 lg:pt-52 pb-5 md:pb-8 lg:pb-12 relative cursor-pointer hover:opacity-95 autoplay-video lazyload" data-bg="https://cdn.musora.com/image/fetch/w_900,q_auto:best/https://pianote.s3.amazonaws.com/products/play-beautiful-piano/thumb-video-3.jpg">
                <p class="py-0.5 md:py-2 px-2 md:px-3 leading-none inline-block mx-auto mb-2 md:mb-4 md:tracking-widest relative z-20" style="background-color:#148cc9;">LESSON 3</p>
                <h3 class="font-roboto uppercase leading-none tracking-tighter md:tracking-normal relative z-20"><strong>Make your own<br>  beautiful music</strong></h3>
                <div class="overlay absolute top-0 left-0 z-10 h-full w-full transition-opacity duration-300 hover:opacity-0" style="background: linear-gradient(to bottom, transparent 33%, rgba(0,10,30,0.7) 100%);"></div>
            </a>
            <a data-open="lesson4" class="w-1/2 lg:w-1/3 bg-cover bg-center pt-32 md:pt-44 lg:pt-52 pb-5 md:pb-8 lg:pb-12 relative cursor-pointer hover:opacity-95 autoplay-video lazyload" data-bg="https://cdn.musora.com/image/fetch/w_900,q_auto:best/https://pianote.s3.amazonaws.com/products/play-beautiful-piano/thumb-video-4.jpg">
                <p class="py-0.5 md:py-2 px-2 md:px-3 leading-none inline-block mx-auto mb-2 md:mb-4 md:tracking-widest relative z-20" style="background-color:#ed8749;">LESSON 4</p>
                <h3 class="font-roboto uppercase leading-none tracking-tighter md:tracking-normal relative z-20"><strong>The secret sauce to<br>  spice up your playing</strong></h3>
                <div class="overlay absolute top-0 left-0 z-10 h-full w-full transition-opacity duration-300 hover:opacity-0" style="background: linear-gradient(to bottom, transparent 33%, rgba(0,10,30,0.7) 100%);"></div>
            </a>
            <a data-open="lesson5" class="w-1/2 lg:w-1/3 bg-cover bg-center pt-32 md:pt-44 lg:pt-52 pb-5 md:pb-8 lg:pb-12 relative cursor-pointer hover:opacity-95 autoplay-video lazyload" data-bg="https://cdn.musora.com/image/fetch/w_900,q_auto:best/https://pianote.s3.amazonaws.com/products/play-beautiful-piano/thumb-video-5.jpg">
                <p class="py-0.5 md:py-2 px-2 md:px-3 leading-none inline-block mx-auto mb-2 md:mb-4 md:tracking-widest relative z-20" style="background-color:#c942e4;">LESSON 5</p>
                <h3 class="font-roboto uppercase leading-none tracking-tighter md:tracking-normal relative z-20"><strong>You don’t have to <br> hit the keys</strong></h3>
                <div class="overlay absolute top-0 left-0 z-10 h-full w-full transition-opacity duration-300 hover:opacity-0" style="background: linear-gradient(to bottom, transparent 33%, rgba(0,10,30,0.7) 100%);"></div>
            </a>
            <a data-open="lesson6" class="w-1/2 lg:w-1/3 bg-cover bg-center pt-32 md:pt-44 lg:pt-52 pb-5 md:pb-8 lg:pb-12 relative cursor-pointer hover:opacity-95 autoplay-video lazyload" data-bg="https://cdn.musora.com/image/fetch/w_900,q_auto:best/https://pianote.s3.amazonaws.com/products/play-beautiful-piano/thumb-video-6.jpg">
                <p class="py-0.5 md:py-2 px-2 md:px-3 leading-none inline-block mx-auto mb-2 md:mb-4 md:tracking-widest relative z-20" style="background-color:#6700ff;">LESSON 6</p>
                <h3 class="font-roboto uppercase leading-none tracking-tighter md:tracking-normal relative z-20"><strong>C ya later. Exploring<br>  other key signatures</strong></h3>
                <div class="overlay absolute top-0 left-0 z-10 h-full w-full transition-opacity duration-300 hover:opacity-0" style="background: linear-gradient(to bottom, transparent 33%, rgba(0,10,30,0.7) 100%);"></div>
            </a>
        </div>
    </section>

    <div class="reveal lessons text-center" id="lesson1" data-reveal data-reset-on-close="false">
        <i class="next-prev fas fa-angle-left opacity-30"></i>
        <div class="aspect-16:9 w-full relative">
            <iframe class="absolute w-full h-full reset-on-close" src="" data-lazy-load-url="//player.vimeo.com/video/578599232?autoplay=1" frameborder="0" allowfullscreen allow="autoplay"></iframe>
        </div>
        <i class="next-prev autoplay-video fas fa-angle-right" data-open="lesson2"></i>
    </div>
    <div class="reveal lessons text-center" id="lesson2" data-reveal data-reset-on-close="false">
        <i class="next-prev autoplay-video fas fa-angle-left" data-open="lesson1"></i>
        <div class="aspect-16:9 w-full relative">
            <iframe class="absolute w-full h-full reset-on-close" src="" data-lazy-load-url="//player.vimeo.com/video/578598860?autoplay=1" frameborder="0" allowfullscreen allow="autoplay"></iframe>
        </div>
        <i class="next-prev autoplay-video fas fa-angle-right" data-open="lesson3"></i>
    </div>
    <div class="reveal lessons text-center" id="lesson3" data-reveal data-reset-on-close="false">
        <i class="next-prev autoplay-video fas fa-angle-left" data-open="lesson2"></i>
        <div class="aspect-16:9 w-full relative">
            <iframe class="absolute w-full h-full reset-on-close" src="" data-lazy-load-url="//player.vimeo.com/video/578597319?autoplay=1" frameborder="0" allowfullscreen allow="autoplay"></iframe>
        </div>
        <i class="next-prev autoplay-video fas fa-angle-right" data-open="lesson4"></i>
    </div>
    <div class="reveal lessons text-center" id="lesson4" data-reveal data-reset-on-close="false">
        <i class="next-prev autoplay-video fas fa-angle-left" data-open="lesson3"></i>
        <div class="aspect-16:9 w-full relative">
            <iframe class="absolute w-full h-full reset-on-close" src="" data-lazy-load-url="//player.vimeo.com/video/578595818?autoplay=1" frameborder="0" allowfullscreen allow="autoplay"></iframe>
        </div>
        <i class="next-prev autoplay-video fas fa-angle-right" data-open="lesson5"></i>
    </div>
    <div class="reveal lessons text-center" id="lesson5" data-reveal data-reset-on-close="false">
        <i class="next-prev autoplay-video fas fa-angle-left" data-open="lesson4"></i>
        <div class="aspect-16:9 w-full relative">
            <iframe class="absolute w-full h-full reset-on-close" src="" data-lazy-load-url="//player.vimeo.com/video/578593648?autoplay=1" frameborder="0" allowfullscreen allow="autoplay"></iframe>
        </div>
        <i class="next-prev autoplay-video fas fa-angle-right" data-open="lesson6"></i>
    </div>
    <div class="reveal lessons text-center" id="lesson6" data-reveal data-reset-on-close="false">
        <i class="next-prev autoplay-video fas fa-angle-left" data-open="lesson5"></i>
        <div class="aspect-16:9 w-full relative">
            <iframe class="absolute w-full h-full reset-on-close" src="" data-lazy-load-url="//player.vimeo.com/video/578592454?autoplay=1" frameborder="0" allowfullscreen allow="autoplay"></iframe>
        </div>
        <i class="next-prev fas fa-angle-right opacity-30"></i>
    </div>
    <section class="content-section overflow-hidden relative text-white text-center lazyload" data-bg="https://cdn.musora.com/image/fetch/w_2500,q_auto:best/https://pianote.s3.amazonaws.com/products/play-beautiful-piano/background-teacher-2.jpg">
        <div class="container mx-auto relative z-20">
            <h2 class="mb-60 md:mb-96 lg:pb-32 text-shadow-3">A message from<br class="inline md:hidden"> <strong>your teacher, Lisa Witt.</strong></h2>
            <p class="text-left max-w-xl leading-relaxed mx-auto px-5 md:px-0"><strong>You can do this.</strong>
                <br><br>
            If you can move your fingers, you can play beautiful music on the piano. I know you can -- because I’ve seen countless students discover for themselves just what’s hiding on those fingers of yours.
                <br><br>
            Even if you don’t believe me...
                <br><br>
            ...even if you don’t think you have an ounce of musical talent in you…
                <br><br>
            You can do this.
                <br><br>
            My name’s Lisa and I want to prove to you that YOU can play beautiful piano music. And if you’re reading this, I’m guessing that’s what you want.
                <br><br>
            But maybe you don’t know if you can do it.
                <br><br>
            In fact, the biggest thing that stops people from even trying to play beautiful piano music is belief. They don’t believe that they can do it. Sure, other people might be able to, but not them.
                <br><br>
            I’m here to tell you that’s wrong. And I can prove it.
                <br><br>
            Because you’ll play something beautiful on the piano in your very 1st lesson. I’m serious, and we have the money-back guarantee to back it up.
                <br><br>
            So…
                <br><br>
            Put me to the test, and get ready to change your belief about what you are able to do.
                <br><br>
                I’ll see you in lesson 1.<br>
                <img class="h-12 md:h-16 mt-5 md:mt-7 lazyload" data-src="https://d2vyvo0tyx8ig5.cloudfront.net/shop/products/piano-riffs-and-fills/lisa-witt-signature.png"></p>
        </div>
    </section>
    <section class="content-section overflow-hidden relative text-white text-center">
        <div class="container mx-auto">
            <div class="testimonials w-full flex items-start justify-center flex-wrap px-3">
                @php
                    $testimonials = [
                        [
                            "heading" => "You … make piano playing tons <br class='inline lg:hidden xl:inline'>of fun. The way it should be!",
                            "testimonial" => "I like that when I have questions there is always someone there to answer them.  And if I can’t find an answer right away there is usually a video you guys have that I can find the answer, or sometimes I’ll find it on the forum.<br><br>In a nutshell... you all make piano playing tons of fun. The way it should be!",
                            "name" => "Debbie Arroyo-Coleman",
                            "location" => "New York, USA",
                            "class" => "mb-5 md:mb-0"
                        ],
                        [
                            "heading" => "It’s no longer<br> difficult to practice.",
                            "testimonial" => "I took piano lessons 55 years ago. I wanted to be able to play pop music but my instructor told me if I learned classical I could play anything. I got frustrated and stopped.<br><br>With Pianote, it’s no longer difficult to practice. I can play whenever I want and I have a teacher on demand. One of my best decisions ever!",
                            "name" => "Lynda A. Hypnar",
                            "location" => "Michigan, USA"
                        ],
                        [
                            "heading" => "I took private lessons<br> for over a year, but…",
                            "testimonial" => "I work many hours and I’m a mom of a teenager and a 5-year-old. I took private lessons for over a year, but it was hard for me to continue because of my busy schedule.<br><br>Pianote’s lessons are laid out so well, mimicking private lessons but allowing you to learn at your own pace. I’m super happy and pleased with my decision to join Pianote!",
                            "name" => "Erika Espinosa",
                            "location" => "Washington, USA",
                            "class" => "hidden lg:flex"
                        ]
                    ]
                @endphp
                @foreach($testimonials as $testimonial)
                    <div class="w-full md:w-1/2 lg:w-1/3 px-3 md:px-4 text-center flex-wrap justify-center transition-all duration-200 ease-in-out @if(!empty($testimonial['class'])) {{ $testimonial['class'] }} @endif">
                        <img class="rounded-full border-4 bg-pianote border-pianote h-28 md:h-40 lg:h-44 lazyload" data-src="https://cdn.musora.com/image/fetch/w_300,q_auto:best/https://d2vyvo0tyx8ig5.cloudfront.net/sales/testimonials/{{ strtolower(str_replace(' ', '-', $testimonial['name'])) }}.jpg">
                        <h5 class="leading-tight my-4 w-full"><strong>"{!! $testimonial['heading'] !!}"</strong></h5>
                        <p class="leading-normal w-full">{!! $testimonial['testimonial'] !!}<br><br>
                            <strong class="text-pianote font-black">{{ $testimonial['name'] }}</strong><br>
                            {{ $testimonial['location'] }}</p>
                    </div>
                @endforeach

            </div>
        </div>
    </section>
    <section class="content-section overflow-hidden relative text-white text-left" style="background:linear-gradient(to bottom, #000217, #02082c);">
        <div class="container mx-auto">
            <div class="flex items-start flex-wrap md:flex-nowrap justify-center max-w-5xl mx-auto px-5 md:px-6 lg:px-8">
                <img class="w-36 md:w-60 lg:w-80 mb-5 md:mb-0 md:order-1 inline-block lazyload" data-src="https://cdn.musora.com/image/fetch/w_600,q_auto:best/https://d2vyvo0tyx8ig5.cloudfront.net/sales/guarantee-badge.png">
                <div class="md:pr-8 lg:pr-10">
                    <h2 class="mb-5 lg:mb-10 text-center md:text-left">The Best Results Guaranteed.<br>
                        <strong>With NO Risk.</strong></h2>
                    <p class="leading-normal text-left">You’ll be playing beautiful music from your very 1st lesson -- for just ${{ PianotePrices::$playBeautifulPiano }}. That's just ${{ number_format(PianotePrices::$playBeautifulPiano / 6, 2) }} per lesson.
                        <br><br>
                        And we’ll admit, there are some pretty big claims on this page. But you know what, we believe them. And we stand by them.
                        <br><br>
                        That’s why we offer the best guarantee you’ll find for online music lessons.
                        <br><br>
                        Some programs or courses offer 7, 14, or even 30-day guarantees.
                        <br><br>
                        But those aren’t good enough. Because it takes time to know if your lessons are working. You shouldn’t feel rushed to make a decision about whether it was worth it (and live with the regret if you make the wrong one).
                        <br><br>
                        That’s why you’ll have 90 days to put us to the test. You can try ALL the lessons. Play for your loved ones and see what they think.
                        <br><br>
                        Because if you’re not 100% satisfied and HAPPY with the results, then we haven’t done our job, and you shouldn’t have to pay.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <section class="header relative overflow-hidden text-white bg-black text-center z-20">
        <video class="object-cover h-full w-full relative z-0" src="https://pianote.s3.amazonaws.com/products/play-beautiful-piano/header-2.mp4" type="video/mp4" autoplay="" loop="" playsinline="" muted></video>
        <div class="overlay absolute top-0 left-0 z-10 h-full w-full" style="background: linear-gradient(to bottom, rgba(50,86,102,0.7) 0%, rgba(42,20,40,0.85) 100%);"></div>
        <div class="container mx-auto">
            <div class="transform -translate-x-1/2 -translate-y-1/2 left-1/2 top-1/2 w-full absolute z-30">
                <img class="h-20 md:h-40 lg:h-52 mx-auto lazyload" data-src="https://cdn.musora.com/image/fetch/w_1600,q_auto:best/https://pianote.s3.amazonaws.com/products/play-beautiful-piano/logo-2.png">
                <h4 class="mt-1 md:mt-4 leading-normal">Start playing beautiful music from<br class="inline md:hidden"> your very 1st lesson - for just <strong>${{ PianotePrices::$playBeautifulPiano }}</strong>.</h4>
                <a class="join my-5 md:my-7 vue-add-to-cart" data-product-json='{"play-beautiful-piano": 1}' href="{{ url()->route('shopping-cart.add-to-cart', ['products' => ['play-beautiful-piano' => 1], 'redirect' => '/order']) }}">Play Beautifully For Just ${{ PianotePrices::$playBeautifulPiano }} &raquo;</a>
                <a class="text-pianote" href="/"><h6><u>OR FREE WITH A PIANOTE MEMBERSHIP</u></h6></a>
                <h6 class="mt-2"><strong>** 90-DAY GUARANTEE **</strong></h6>
            </div>
        </div>
    </section>

    @include('pianote._partials._footer')

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script type="text/javascript" src="{{ asset('/marketing/js/modal.js') }}"></script>
    <script>
        $(function () {
            $(document).foundation();

            $(".example-video").on('play', function () {
                $(".example-video").not(this).trigger('pause');
                $('.thumb').removeClass('active');
                $(this).parents('.thumb').addClass('active');
            });
            $('.next-prev.autoplay-video').on('click', function (e) {
                if (e.target !== this) {
                    return;
                }
                $('.reset-on-close').attr('src', 'about:blank');
            });
        });
    </script>
    <script type="text/javascript" src="{{ asset('/marketing/parcel/drumeo/navigation-sales.js') }}"></script>
    <script type="text/javascript" src="{{ asset('/marketing/js/modal-autoplay.js') }}"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/lazysizes/5.3.2/lazysizes.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/lazysizes/5.3.2/plugins/unveilhooks/ls.unveilhooks.min.js"></script>

    {{-- Platform --}}
    <script src="{{ mix('/platform/js/manifest.js') }}"></script>
    <script src="{{ mix('/platform/js/vendor.js') }}"></script>
    <script src="{{ mix('/platform/js/app.js') }}"></script>

    @include('pianote._partials.inspectlet')
@stop
