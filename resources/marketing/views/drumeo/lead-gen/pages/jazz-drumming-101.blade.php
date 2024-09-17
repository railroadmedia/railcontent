@extends('drumeo._partials.global-layout')

@section('global-head')
    <title>Jazz Drumming 101 | Drumeo</title>
    <meta property="og:title" content="Jazz Drumming 101 | Drumeo">

    <meta name="description" content="Get started playing jazz in this free series taught by Ulysses Owens Jr.">
    <meta property="og:description" content="Get started playing jazz in this free series taught by Ulysses Owens Jr.">

    <meta property="og:image" content="https://d21q7xesnoiieh.cloudfront.net/fit-in/1200x0/filters:quality(95)/marketing/drumeo/lead-gen/jazz-drumming-101/share-image.jpg" style="display: none;">
    <meta property="og:url" content="https://www.drumeo.com/{{ Request::path() }}">

    <link rel="stylesheet" href="{{ mix('marketing/css/app.css') }}">
    <link href="{{ asset('/marketing/css/tailwind-helpers.css') }}" rel="stylesheet">
    <link href="{{ asset('/marketing/parcel/drumeo/navigation-sales.css') }}" rel="stylesheet">
    <link href="{{ asset('/marketing/parcel/drumeo/lead-gen-tw.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@splidejs/splide@4.1.4/dist/css/splide.min.css">
@stop

@section('body-data')
    x-data="{
    trailer: false,
    }"
@endsection

@section('global-body')
    @include("drumeo.sales.partials._nav")

    <header class="py-12 sm:py-20 text-black relative overflow-hidden" style="background:#dddddd;">
        <img class="absolute top-0 left-0 w-full h-full transition-opacity opacity-0 object-cover" src="https://d21q7xesnoiieh.cloudfront.net/fit-in/2000x0/filters:quality(95)/marketing/drumeo/lead-gen/jazz-drumming-101/header-bg.webp" alt="Gray Background" loading="lazy" onload="this.classList.remove('opacity-0')" />
        <div class="max-w-5xl relative z-10 mx-auto sm:flex items-center container px-4 text-center sm:text-left">
            <div class="w-full sm:w-1/2 max-w-xl mx-auto sm:max-w-full">
                <div class="px-2 sm:pl-3 sm:pr-4 lg:pr-6 xl:pr-20">
                    <img
                        class="h-12 sm:h-16 lg:h-20 mb-1 md:mb-2"
                        src="https://d21q7xesnoiieh.cloudfront.net/fit-in/600x0/filters:quality(95)/marketing/drumeo/lead-gen/jazz-drumming-101/logo.svg"
                        alt="Jazz Drumming Logo"
                        fetchpriority="high"
                    />
                    <h3 class="leading-tight mb-3 sm:mb-5">Learn your first jazz <br> grooves <strong>and play along  <br> with REAL music.</strong></h3>
                    <div class="max-w-xs px-4 mx-auto sm:hidden mb-5">
                        <img
                            src="https://d21q7xesnoiieh.cloudfront.net/fit-in/600x0/filters:quality(95)/marketing/drumeo/lead-gen/jazz-drumming-101/header.webp"
                            alt="Photo of Ulysses Owens Jr."
                            fetchpriority="high"
                        />
                    </div>
                    <p class="mb-4">Enter your email below for your 6 free lessons:</p>
                </div>
                <div class="lg:pr-6 xl:pr-20">
                @include("drumeo.lead-gen.partials.sign-up-form", [
                    "formId" => "Drumeo - Engagement - Trigger - JD101 - Web Form",
                    "formName" => 'Jazz Drumming 101',
                    "buttonText" => "Get started for free",
                    'stacked' => true,
                    "redirectURL" => "/thankyou",
                    "recaptchaKey" => $recaptchaKey
                ])
                </div>
            </div>
            <div class="w-full sm:w-1/2 hidden sm:block">
                <img
                    class="transition-opacity opacity-0"
                    src="https://d21q7xesnoiieh.cloudfront.net/fit-in/1000x0/filters:quality(95)/marketing/drumeo/lead-gen/jazz-drumming-101/header.webp"
                    alt="Photo of Ulysses Owens Jr."
                    loading="lazy"
                    onload="this.classList.remove('opacity-0')"
                />
            </div>
        </div>
    </header>

    <section class="py-12 sm:py-14 lg:py-20 px-4 text-center">
        <div class="container max-w-5xl mx-auto">
            <h2 class="font-extrabold mb-4">6 Free Videos To Help You<br> Start Playing Jazz</h2>
            <p class="mb-10">
                Jazz 101 includes everything you need to learn your first beats, setup your kit, <br class="hidden sm:inline">
                and draw inspiration from iconic jazz cats:
            </p>
            <div class="flex flex-wrap justify-center mx-auto md:max-w-full text-left">
                @php
                    $lessons = [
                        [
                            "trailer" => true,
                            "thumb" => "https://d21q7xesnoiieh.cloudfront.net/fit-in/600x0/filters:quality(95)/marketing/drumeo/lead-gen/jazz-drumming-101/thumbs-01.webp",
                            "desc" => "<strong>The Swing Pattern.</strong> Learn the foundational ride cymbal pattern that opens you to the world of jazz drumming.",
                        ],
                        [
                            "thumb" => "https://d21q7xesnoiieh.cloudfront.net/fit-in/600x0/filters:quality(95)/marketing/drumeo/lead-gen/jazz-drumming-101/thumbs-02-new.webp",
                            "desc" => "<strong>The Jazz Sound: Acoustic.</strong> Choose the cymbals, drums and tuning that sets you up for success playing jazz.",
                        ],
                        [
                            "thumb" => "https://d21q7xesnoiieh.cloudfront.net/fit-in/600x0/filters:quality(95)/marketing/drumeo/lead-gen/jazz-drumming-101/thumbs-03-new.webp",
                            "desc" => "<strong>The Jazz Sound: Electronic.</strong> Ulysses shows you how to choose the best settings on your e-kit to play jazz.",
                        ],
                        [
                            "thumb" => "https://d21q7xesnoiieh.cloudfront.net/fit-in/600x0/filters:quality(95)/marketing/drumeo/lead-gen/jazz-drumming-101/thumbs-04-new.webp",
                            "desc" => "<strong>Beginner Jazz Beats.</strong> You’re ready to play along with Ulysses and learn your first jazz comping patterns.",
                        ],
                        [
                            "thumb" => "https://d21q7xesnoiieh.cloudfront.net/fit-in/600x0/filters:quality(95)/marketing/drumeo/lead-gen/jazz-drumming-101/thumbs-05-new.webp",
                            "desc" => "<strong>Brushes.</strong> Learn the motions, speeds and accents of playing brushes that lay the foundation for a jazz song.",
                        ],
                        [
                            "thumb" => "https://d21q7xesnoiieh.cloudfront.net/fit-in/600x0/filters:quality(95)/marketing/drumeo/lead-gen/jazz-drumming-101/thumbs-06-new.webp",
                            "desc" => "<strong>Jazz Hand & Foot Technique.</strong> Ulysses shows you the techniques you can use to get that light jazz touch.",
                        ],
                        [
                            "thumb" => "https://d21q7xesnoiieh.cloudfront.net/fit-in/600x0/filters:quality(95)/marketing/drumeo/lead-gen/jazz-drumming-101/thumbs-07-new.webp",
                            "desc" => "<strong>Jazz Drummers You Should Know.</strong> Listening recommendations of iconic drummers for endless inspiration.",
                        ]
                    ];
                @endphp
    
                @foreach($lessons as $key => $lesson)
                    <div class="relative hidden sm:block w-full sm:w-1/2 lg:w-1/3 px-2 mb-6 sm:mb-8">
                        <img src="{{ $lesson['thumb'] }}" alt="video thumbnail" loading="lazy"
                            class="w-full rounded-lg {{ $key === 0 && !empty($lesson['trailer']) ? 'cursor-pointer hover:opacity-90 transition-opacity autoplay-video' : '' }}"
                            @if($key === 0 && !empty($lesson['trailer']))
                                x-on:click="trailer = true;"
                            @endif
                        >
                        @if($key !== 0)
                            <div class="absolute flex items-center justify-center" style="top:30%; left:45%;">
                                <i class="fa-solid fa-lock-keyhole text-white text-4xl shadow-lg" aria-hidden="true"></i>
                            </div>
                        @endif
                        <p class="mt-3 leading-snug">{!! $lesson['desc'] !!}</p>
                    </div>
                @endforeach
            </div>
            <div class="block sm:hidden"
                x-data="{ 
                    initCarousel() { 
                        new Splide(this.$refs.carousel, { 
                            type: 'loop', 
                            perPage: 1.5, 
                            pagination: false, 
                            arrows: false, 
                            autoplay: false, 
                            gap: '1rem', 
                            drag: true, 
                            easing: 'ease',
                            speed: 600, 
                            flickPower: 500, 
                        }).mount(); 
                    } 
                }" 
                x-init="initCarousel">
                <div class="splide" x-ref="carousel">
                    <div class="splide__track">
                        <ul class="splide__list">
                            @foreach($lessons as $key => $lesson)
                                <li class="splide__slide">
                                    <img src="{{ $lesson['thumb'] }}" alt="video thumbnail" loading="lazy"
                                        class="w-full rounded-lg {{ $key === 0 && !empty($lesson['trailer']) ? 'cursor-pointer hover:opacity-90 transition-opacity autoplay-video' : '' }}"
                                        @if($key === 0 && !empty($lesson['trailer']))
                                            x-on:click="trailer = true;"
                                        @endif
                                    >
                                    @if($key !== 0)
                                        <div class="absolute flex items-center justify-center" style="top:30%; left:45%;">
                                            <i class="fa-solid fa-lock-keyhole text-white text-4xl shadow-lg" aria-hidden="true"></i>
                                        </div>
                                    @endif
                                    <p class="mt-3 leading-snug">{!! $lesson['desc'] !!}</p>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="py-12 sm:py-20" style="background: #F1F7FE;">
        <div class="flex flex-wrap sm:flex-nowrap items-start justify-center sm:mt-8 sm:px-4 lg:px-0">
            <div class="-mb-16 sm:mb-0 sm:mt-10 sm:-mr-8 relative">
                <picture>
                    <source media="(min-width: 1024px)" srcset="https://d21q7xesnoiieh.cloudfront.net/fit-in/770x0/filters:quality(95)/marketing/drumeo/lead-gen/jazz-drumming-101/coach-profile.webp">
                    <source media="(min-width: 640px)" srcset="https://d21q7xesnoiieh.cloudfront.net/fit-in/510x0/filters:quality(95)/marketing/drumeo/lead-gen/jazz-drumming-101/coach-profile.webp">
                    <img
                        class="w-52 sm:w-72 md:w-96 relative z-40 transition-opacity opacity-0"
                        src="https://d21q7xesnoiieh.cloudfront.net/fit-in/420x0/filters:quality(95)/marketing/drumeo/lead-gen/jazz-drumming-101/coach-profile.webp"
                        alt="Photo of Ulysses Owens Jr."
                        loading="lazy"
                        onload="this.classList.remove('opacity-0')"
                    >
                </picture>

                <picture class="w-80 sm:w-80 lg:w-96 -left-14 sm:left-0 sm:-top-6 md:top-0 absolute md:-top-7 lg:-top-10 md:-left-10">
                    <source media="(min-width: 640px)" srcset="https://dpwjbsxqtam5n.cloudfront.net/lead-gen/gsotd/updated/coach-splash.png">
                    <img class="transition-all opacity-0" src="https://dpwjbsxqtam5n.cloudfront.net/lead-gen/gsotd/updated/coach-splash-m.png" alt="splash" loading="lazy" onload="this.classList.remove('opacity-0')" />
                </picture>

            </div>
            <div class="mx-4 sm:mx-0 text-white text-left rounded-xl pt-20 pb-8 sm:py-10 lg:py-12 px-6 sm:pr-10 sm:pl-14 lg:pl-20 sm:mt-8 w-full sm:w-auto sm:flex-grow max-w-sm sm:max-w-md md:max-w-lg lg:max-w-xl z-30" style="background-color:#00101d;">
                <h6 class="uppercase text-drumeo leading-normal text-[#15C5FD]">MEET YOUR TEACHER</h6>
                <h2><strong>Ulysses Owens Jr.</strong></h2>
                <p class="leading-normal mt-4 lg:mt-6">
                    Ulysses Owens Jr. is a GRAMMY-winning jazz drummer, producer, and educator known for his innovative performances and contributions to jazz.
                    <br><br>
                    He has released eight albums, including "A New Beat," which topped jazz charts in 2024. Owens has authored several books on jazz drumming, developed music products, and created online educational courses.
                    <br><br>
                    He’s an educator at The Juilliard School and he’s here to help you get started playing jazz on the drums.
                </p>
                 <div class="flex flex-col space-y-6 mt-7 lg:mt-10">
                    <div class="flex items-center">
                        <img class="h-5 sm:h-7 transition-all opacity-0 mr-4" src="https://d21q7xesnoiieh.cloudfront.net/fit-in/770x0/filters:quality(95)/marketing/drumeo/lead-gen/jazz-drumming-101/cap.svg" alt="graduation cap icon" loading="lazy" onload="this.classList.remove('opacity-0')">
                        <div>
                         <p class="capitalize"><span class="opacity-70">Small Ensemble Director</span><strong> @ The <br class="block md:hidden">Juilliard School</strong></p>
                        </div>
                    </div>
                    <div class="flex items-center">
                       <img class="h-5 sm:h-7 transition-all opacity-0 mr-5" src="https://d21q7xesnoiieh.cloudfront.net/fit-in/770x0/filters:quality(95)/marketing/drumeo/lead-gen/jazz-drumming-101/book.svg" alt="graduation cap icon" loading="lazy" onload="this.classList.remove('opacity-0')">
                        <div>
                            <p class="capitalize"><strong class="text-white"> 2x </strong><span class="opacity-70">Published Author</span></p>
                        </div>
                    </div>
                     <div class="flex items-center">
                        <img class="h-5 sm:h-7 transition-all opacity-0 mr-4" src="https://www.musora.com/musora-cdn/image/width=100,quality=95/https://dpwjbsxqtam5n.cloudfront.net/drum-shop/30-day-drummer/Youtube_Icon.svg" alt="youtube icon" loading="lazy" onload="this.classList.remove('opacity-0')">
                        <div>
                            <p><strong>+6M views</strong><span class="opacity-70"> on viral jazz videos</span></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    @include('drumeo.lead-gen.partials.quick-questions', [
        'textColor' => 'white',
        'bgColor' => 'linear-gradient(to bottom, #01050F 0%, #02152a 100%);'
    ])

    <section class="py-8 sm:py-14 text-center relative text-black" style="background: #020f1b;">
        <img class="absolute top-0 left-0 w-full h-full transition-opacity opacity-0 object-cover" src="https://d21q7xesnoiieh.cloudfront.net/fit-in/2000x0/filters:quality(95)/marketing/drumeo/lead-gen/jazz-drumming-101/header-bg.webp" alt="Gray Background" loading="lazy" onload="this.classList.remove('opacity-0')" />
        <div class="max-w-3xl mx-auto z-50 relative">
            <img class="h-32 sm:h-56 transition-all opacity-0" src="https://d21q7xesnoiieh.cloudfront.net/fit-in/600x0/filters:quality(95)/marketing/drumeo/lead-gen/jazz-drumming-101/logo-bottom.webp" alt="GSTOD logo" loading="lazy" onload="this.classList.remove('opacity-0')" />
            <h5 class="my-5 sm:my-7 font-black">Enter your email to receive 6 free lessons.</h5>
            <div class="max-w-sm mx-auto sm:max-w-none px-4">
            @include("drumeo.lead-gen.partials.sign-up-form", [
                    "formId" => "Drumeo - Engagement - Trigger - JD101 - Web Form2",
                    "formName" => 'Jazz Drumming 101',
                    "buttonText" => "SEND VIDEOS",
                    "redirectURL" => "/thankyou",
                    "recaptchaKey" => $recaptchaKey
            ])
            </div>
        </div>
    </section>

    @include('_partials.components.video-modal',[
        'styles' => 'aspect-16:9',
        'name' => 'trailer',
        'video' => 'https://www.youtube.com/embed/M_j47-OvSyI?rel=0&showinfo=0',
    ])

    @include("drumeo.sales.partials._footer", [
            "minimal" => true
        ])

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script defer src="{{ asset('/marketing/parcel/drumeo/navigation-sales.js') }}"></script>
    <script defer src="{{ asset('/marketing/js/pre-form-submit-facebook-lead.js') }}"></script>
    <script defer src="{{ asset('/marketing/js/drumeo/form-tracking.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/@splidejs/splide@4.1.4/dist/js/splide.min.js"></script>
@stop
