@extends('musora._partials.layout')

@section('head-includes')
    <title>Musora - Social Learning Communities For Musicians</title>
    <meta property="og:title" content="Musora - Social Learning Communities For Musicians">

    <meta name="description" content="Musora Media, Inc. is the technology that powers the most popular online social learning communities for musicians.  Learn music from the best teachers in the world at Drumeo, Guitareo, and Pianote. ">
    <meta property="og:description" content="Musora Media, Inc. is the technology that powers the most popular online social learning communities for musicians.  Learn music from the best teachers in the world at Drumeo, Guitareo, and Pianote.">

    <meta property="og:url" content="https://www.musora.com">
    <meta property="og:image" content="https://musora-center.s3.amazonaws.com/homepage/2021/share-image.jpg">
@endsection

<!-- Main -->
@section('layout-body')

    <!-- Hero Component -->
    @component('_partials.components.hero-section', [
        "backgroundImage" => "https://musora-web-platform.s3.amazonaws.com/musora/homepage/musora-hero.jpg",
    ])
        @slot('content')
            <div class="text-center text-white">
                <h1 class="text-3xl md:text-4xl lg:text-5xl"><strong>Musicians start here.</strong></h1>
                <p class="mt-4 mb-7">We make it easier to play the songs you love by combining great teachers, organized<br class="hidden md:inline">
                    lessons, and practical technology with student-centered communities.</p>
                <div class="flex items-center justify-center">
                    <a href="https://www.drumeo.com/" target="_blank"><img class="h-5 md:h-7 mx-1 md:mx-3 mb-2" data-cfsrc="https://cdn.musora.com/image/fetch/w_200,q_auto:best/https://dpwjbsxqtam5n.cloudfront.net/logos/logo-blue.png" src="https://cdn.musora.com/image/fetch/w_200,q_auto:best/https://dpwjbsxqtam5n.cloudfront.net/logos/logo-blue.png"></a>
                    <a href="https://www.pianote.com/" target="_blank"><img class="h-5 md:h-7 mx-1 md:mx-3" data-cfsrc="https://cdn.musora.com/image/fetch/w_200,q_auto:best/https://pianote.s3.amazonaws.com/logo/pianote-logo-red.png" src="https://cdn.musora.com/image/fetch/w_200,q_auto:best/https://pianote.s3.amazonaws.com/logo/pianote-logo-red.png"></a>
                    <a href="https://www.guitareo.com/" target="_blank"><img class="h-5 md:h-7 mx-1 md:mx-3" data-cfsrc="https://cdn.musora.com/image/fetch/w_200,q_auto:best/https://guitareo.s3.amazonaws.com/sales/guitareo-logo-green.png" src="https://cdn.musora.com/image/fetch/w_200,q_auto:best/https://guitareo.s3.amazonaws.com/sales/guitareo-logo-green.png"></a>
                    <a href="https://www.singeo.com/" target="_blank"><img class="h-5 md:h-7 mx-1 md:mx-3" data-cfsrc="https://cdn.musora.com/image/fetch/w_200,q_auto:best/https://singeo.s3.amazonaws.com/sales/2021/singeo-logo.png" src="https://cdn.musora.com/image/fetch/w_200,q_auto:best/https://singeo.s3.amazonaws.com/sales/2021/singeo-logo.png"></a>
                </div>
            </div>
            
        @endslot
    @endcomponent

    <section class="py-12 md:py-20 relative overflow-hidden text-white text-center" style="background:linear-gradient(to bottom, #000c17, #000f2e);">
        <div class="container mx-auto relative z-0">
            <h3 class="leading-tight"><strong>We’re helping 187,315 music <br>
                    students reach their goals.</strong></h3>
            {{--<div class="relative mx-auto my-9 w-full max-w-xs md:max-w-xl autoplay-video cursor-pointer hover:opacity-90 transition-opacity duration-300" data-open="trailer">--}}
                {{--<p class="absolute z-10 font-bebas leading-tight text-left" style="right:32%;top:22%;">--}}
                    {{--SEE<br>HOW<br><img class="h-6 filter brightness-0 invert lazyload" data-src="https://cdn.musora.com/image/fetch/q_auto:best/https://dpwjbsxqtam5n.cloudfront.net/sales/arrow-left-blue.png"><br>--}}
                {{--</p>--}}
                {{--<i class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 z-10 fas fa-play play-button"></i>--}}
                {{--<div class="aspect-16:9 w-full relative">--}}
                    {{--<div class="absolute w-full h-full rounded-xl bg-black bg-center bg-cover lazyload" data-bg="https://i.vimeocdn.com/video/1259554340-df92ad748c7bdf798f86a67f264a7f410489d3e69eb05cd3d_720"></div>--}}
                {{--</div>--}}
            {{--</div>--}}
            <div class="flex flex-wrap items-start max-w-6xl mx-auto mt-9">
                <div class="w-full px-4 md:px-2 lg:px-4 md:w-1/3 mb-5 md:mb-0">
                    <i class="icon-courses text-3xl md:text-5xl leading-none text-musora"></i><br>
                    <img 
                        class="filter invert h-4 md:h-6 transition-opacity opacity-0" 
                        src="https://cdn.musora.com/image/fetch/q_auto:best/https://dpwjbsxqtam5n.cloudfront.net/sales/2021/method-text.svg"
                        loading="lazy"
                        onload="this.classList.remove('opacity-0')"
                    >
                    <h4 class="leading-tight mt-3 md:mt-5 mb-1 md:mb-3"><strong>Step-By-Step<br class="hidden md:inline lg:hidden"> Curriculum</strong></h4>
                    <p class="text-navy leading-normal">We simplify your learning experience with step-by-step video lessons you can trust -- always taught by world-class teachers.<br><br>
                        <em class="text-method">
                            <i class="far fa-check text-musora"></i> 10-Level Method for better results.<br>
                            <i class="far fa-check text-musora"></i> On-demand courses from famous artists.<br>
                            <i class="far fa-check text-musora"></i> All skill levels, topics, and styles.</em>
                    </p>
                </div>
                <div class="w-full px-4 md:px-2 lg:px-4 md:w-1/3 mb-5 md:mb-0">
                    <i class="icon-songs text-3xl md:text-5xl leading-none text-musora"></i><br>
                    <img 
                        class="filter invert h-4 md:h-6 transition-opacity opacity-0" 
                        src="https://cdn.musora.com/image/fetch/q_auto:best/https://dpwjbsxqtam5n.cloudfront.net/sales/2021/songs-text.svg"
                        loading="lazy"
                        onload="this.classList.remove('opacity-0')"
                    >
                    <h4 class="leading-tight mt-3 md:mt-5 mb-1 md:mb-3"><strong>Play The Songs<br class="hidden md:inline lg:hidden"> You Love</strong></h4>
                    <p class="text-navy leading-normal">Nothing is better than playing real music. Students gain access to practice tools for playing popular songs from all eras and styles.<br><br>
                        <em class="text-songs">
                            <i class="far fa-check text-musora"></i> Play-alongs for popular music.<br>
                            <i class="far fa-check text-musora"></i> Transcriptions, charts, & practice tools.<br>
                            <i class="far fa-check text-musora"></i> Practice anytime on any device.</em>
                    </p>
                </div>
                <div class="w-full px-4 md:px-2 lg:px-4 md:w-1/3">
                    <img  
                        class="icon h-8 md:h-12 mb-1.5 text-musora transition-opacity opacity-0" 
                        src="https://musora-center.s3.amazonaws.com/homepage/2021/coaches.png"
                        loading="lazy"
                        onload="this.classList.remove('opacity-0')"
                    ><br>
                    <img 
                        class="filter invert h-4 md:h-6 transition-opacity opacity-0" 
                        src="https://cdn.musora.com/image/fetch/q_auto:best/https://dpwjbsxqtam5n.cloudfront.net/sales/2021/coaches-text.svg"
                        loading="lazy"
                        onload="this.classList.remove('opacity-0')"
                    >
                    <h4 class="leading-tight mt-3 md:mt-5 mb-1 md:mb-3"><strong>Motivation<br class="hidden md:inline lg:hidden"> &amp; Support</strong></h4>
                    <p class="text-navy leading-normal">Get direct access to reach teachers whenever you have a question -- along with friendly peers and engaging community events.<br><br>
                        <em class="text-coaches">
                            <i class="far fa-check text-musora"></i> Connect with your musical heroes.<br>
                            <i class="far fa-check text-musora"></i> Live events every week.<br>
                            <i class="far fa-check text-musora"></i> Personal feedback & video reviews.
                        </em>
                    </p>
                </div>
            </div>
        </div>
    </section>
    <section class="py-12 md:py-20 relative overflow-hidden text-white text-center">
        {{-- background --}}
        <img src="https://cdn.musora.com/image/fetch/w_1100,q_auto:best/https://musora-center.s3.amazonaws.com/homepage/2021/drumeo-background.jpg"
            class="absolute object-cover object-center transition-opacity opacity-0 inset-0 w-full h-full"
            loading="lazy"
            onload="this.classList.remove('opacity-0')"
        />
        <div class="container mx-auto relative z-0">
            <img 
                class="h-9 md:h-14 transition-opacity opacity-0" 
                src="https://dpwjbsxqtam5n.cloudfront.net/logos/logo-blue.png"
                loading="lazy"
                onload="this.classList.remove('opacity-0')"
            >
            <h3 class="mt-3 mb-7 md:mb-10 lg:mb-14 leading-tight"><strong>The world’s largest<br class="inline md:hidden"> drum lessons community.</strong></h3>
            <div class="flex flex-wrap md:flex-nowrap items-center justify-center">
                <img 
                    class="flex-shrink-0 h-40 md:h-60 lg:h-80 transition-opacity opacity-0" 
                    src="https://cdn.musora.com/image/fetch/w_1100,q_auto:best/https://musora-center.s3.amazonaws.com/homepage/2021/drumeo-graphic.png"
                    loading="lazy"
                    onload="this.classList.remove('opacity-0')"
                >
                <div class="w-full md:w-auto mt-5 md:mt-0 px-6 md:pr-0 md:pl-10 lg:pl-12">
                    <h6 class="leading-relaxed"><strong class="text-drumeo"><i class="fas fa-trophy"></i></strong> award-winning lessons.<br>
                    <strong class="text-drumeo">100+</strong> legendary teachers.<br>
                    <strong class="text-drumeo">3.2M+</strong> lessons completed.<br></h6>
                    <a class="w-auto md:w-full join drumeo smaller mt-4 md:mt-7 mb-4" href="https://www.drumeo.com/">VISIT DRUMEO</a><br>
                    <a class="transition-colors duration-300 py-1.5 w-9 h-9 text-xl leading-none rounded-full inline-block text-center mx-0.5 border-2 social-button facebook" target="_blank" rel="noopener" href="https://www.facebook.com/drumeo/"><i class="fab fa-facebook-f"></i></a>
                    <a class="transition-colors duration-300 py-1.5 w-9 h-9 text-xl leading-none rounded-full inline-block text-center mx-0.5 border-2 social-button youtube" target="_blank" rel="noopener" href="https://www.youtube.com/freedrumlessons"><i class="fab fa-youtube"></i></a>
                    <a class="transition-colors duration-300 py-1.5 w-9 h-9 text-xl leading-none rounded-full inline-block text-center mx-0.5 border-2 social-button instagram" target="_blank" rel="noopener" href="https://www.instagram.com/drumeoofficial/"><i class="fab fa-instagram"></i></a>
                    <a class="transition-colors duration-300 py-1.5 w-9 h-9 text-xl leading-none rounded-full inline-block text-center mx-0.5 border-2 social-button blog" target="_blank" rel="noopener" href="https://www.drumeo.com/beat/"><i class="fas fa-blog"></i></a>
                    <a class="transition-colors duration-300 py-1.5 w-9 h-9 text-xl leading-none rounded-full inline-block text-center mx-0.5 border-2 social-button podcast" target="_blank" rel="noopener" href="https://open.spotify.com/show/1cN1jx7gLVvUYpEeQMwgn0"><i class="fas fa-podcast"></i></a>
                </div>
            </div>
        </div>
    </section>
    <section class="py-12 md:py-20 relative overflow-hidden text-white text-center">
        {{-- background --}}
        <img src="https://cdn.musora.com/image/fetch/w_1100,q_auto:best/https://musora-center.s3.amazonaws.com/homepage/2021/pianote-background.jpg"
            class="absolute object-cover object-center transition-opacity opacity-0 inset-0 w-full h-full"
            loading="lazy"
            onload="this.classList.remove('opacity-0')"
        />
        <div class="container mx-auto relative z-0">
            <img 
            class="h-9 md:h-14 transition-opacity opacity-0" 
            src="https://pianote.s3.amazonaws.com/logo/pianote-logo-red.png"
            loading="lazy"
            onload="this.classList.remove('opacity-0')"
        >
            <h3 class="mt-3 mb-7 md:mb-10 lg:mb-14 leading-tight"><strong>Learn the piano anytime<br class="inline md:hidden"> with real teachers.</strong></h3>
            <div class="flex flex-wrap md:flex-nowrap items-center justify-center">
                <img 
                    class="flex-shrink-0 h-40 md:h-60 lg:h-80 transition-opacity opacity-0" 
                    src="https://cdn.musora.com/image/fetch/w_1100,q_auto:best/https://musora-center.s3.amazonaws.com/homepage/2021/pianote-graphic.png"
                    loading="lazy"
                    onload="this.classList.remove('opacity-0')"
                >
                <div class="w-full md:w-auto mt-5 md:mt-0 px-6 md:pr-0 md:pl-10 lg:pl-12">
                    <h6 class="leading-relaxed"><strong class="text-pianote"><i class="fas fa-heart"></i></strong> technology meets tradition.<br>
                    <strong class="text-pianote">5+</strong> weekly live events.<br>
                    <strong class="text-pianote">1.2M+</strong> lessons completed.<br></h6>
                    <a class="w-auto md:w-full join pianote smaller mt-4 md:mt-7 mb-4" href="https://www.pianote.com/">VISIT Pianote</a><br>
                    <a class="transition-colors duration-300 py-1.5 w-9 h-9 text-xl leading-none rounded-full inline-block text-center mx-0.5 border-2 social-button facebook" target="_blank" rel="noopener" href="https://www.facebook.com/pianoteofficial"><i class="fab fa-facebook-f"></i></a>
                    <a class="transition-colors duration-300 py-1.5 w-9 h-9 text-xl leading-none rounded-full inline-block text-center mx-0.5 border-2 social-button youtube" target="_blank" rel="noopener" href="https://www.youtube.com/user/pianolessonscom"><i class="fab fa-youtube"></i></a>
                    <a class="transition-colors duration-300 py-1.5 w-9 h-9 text-xl leading-none rounded-full inline-block text-center mx-0.5 border-2 social-button instagram" target="_blank" rel="noopener" href="https://www.instagram.com/pianoteofficial/"><i class="fab fa-instagram"></i></a>
                    <a class="transition-colors duration-300 py-1.5 w-9 h-9 text-xl leading-none rounded-full inline-block text-center mx-0.5 border-2 social-button blog" target="_blank" rel="noopener" href="https://www.pianote.com/blog/"><i class="fas fa-blog"></i></a>
                    <a class="transition-colors duration-300 py-1.5 w-9 h-9 text-xl leading-none rounded-full inline-block text-center mx-0.5 border-2 social-button podcast" target="_blank" rel="noopener" href="https://open.spotify.com/show/3A8KKvYYhanvHIVLxcycMf"><i class="fas fa-podcast"></i></a>
                </div>
            </div>
        </div>
    </section>
    <section class="py-12 md:py-20 relative overflow-hidden text-white text-center lazyload">
        {{-- background --}}
        <img 
            src="https://cdn.musora.com/image/fetch/w_1100,q_auto:best/https://musora-center.s3.amazonaws.com/homepage/2021/guitareo-background.jpg"
            class="absolute object-cover object-center transition-opacity opacity-0 inset-0 w-full h-full"
            loading="lazy"
            onload="this.classList.remove('opacity-0')"
        />
        <div class="container mx-auto relative z-0">
            <img 
                class="h-9 md:h-14 transition-opacity opacity-0" 
                src="https://guitareo.s3.amazonaws.com/sales/guitareo-logo-green.png"
                loading="lazy"
                onload="this.classList.remove('opacity-0')"
            >
            <h3 class="mt-3 mb-7 md:mb-10 lg:mb-14 leading-tight"><strong>The first guitar lessons designed<br class="inline md:hidden"> around real-world missions.</strong></h3>
            <div class="flex flex-wrap md:flex-nowrap items-center justify-center">
                <img 
                    class="flex-shrink-0 h-40 md:h-60 lg:h-80 transition-opacity opacity-0" 
                    src="https://cdn.musora.com/image/fetch/w_1100,q_auto:best/https://musora-center.s3.amazonaws.com/homepage/2021/guitareo-graphic.png"
                    loading="lazy"
                    onload="this.classList.remove('opacity-0')"
                >
                <div class="w-full md:w-auto mt-5 md:mt-0 px-6 md:pr-0 md:pl-10 lg:pl-12">
                    <h6 class="leading-relaxed"><strong class="text-guitareo"><i class="fas fa-guitar"></i></strong> just released in 2021.<br>
                    <strong class="text-guitareo">10</strong> goal-based adventures.<br>
                    <strong class="text-guitareo">500+</strong> charts for popular songs.<br></h6>
                    <a class="w-auto md:w-full join guitareo smaller mt-4 md:mt-7 mb-4" href="https://www.guitareo.com/">VISIT GUITAREO</a><br>
                    <a class="transition-colors duration-300 py-1.5 w-9 h-9 text-xl leading-none rounded-full inline-block text-center mx-0.5 border-2 social-button facebook" target="_blank" rel="noopener" href="https://www.facebook.com/guitareoofficial"><i class="fab fa-facebook-f"></i></a>
                    <a class="transition-colors duration-300 py-1.5 w-9 h-9 text-xl leading-none rounded-full inline-block text-center mx-0.5 border-2 social-button youtube" target="_blank" rel="noopener" href="https://www.youtube.com/user/guitarlessonscom"><i class="fab fa-youtube"></i></a>
                    <a class="transition-colors duration-300 py-1.5 w-9 h-9 text-xl leading-none rounded-full inline-block text-center mx-0.5 border-2 social-button instagram" target="_blank" rel="noopener" href="https://www.instagram.com/guitareoofficial/"><i class="fab fa-instagram"></i></a>
                    <a class="transition-colors duration-300 py-1.5 w-9 h-9 text-xl leading-none rounded-full inline-block text-center mx-0.5 border-2 social-button blog" target="_blank" rel="noopener" href="https://www.guitareo.com/riff/"><i class="fas fa-blog"></i></a>
                </div>
            </div>
        </div>
    </section>
    <section class="py-12 md:py-20 relative overflow-hidden text-white text-center lazyload">
            {{-- background --}}
            <img 
                src="https://cdn.musora.com/image/fetch/w_1100,q_auto:best/https://musora-center.s3.amazonaws.com/homepage/2021/singeo-background.jpg"
                class="absolute object-cover object-center transition-opacity opacity-0 inset-0 w-full h-full"
                loading="lazy"
                onload="this.classList.remove('opacity-0')"
            />
        <div class="container mx-auto relative z-0">
            <img 
                class="h-9 md:h-14 transition-opacity opacity-0" 
                src="https://singeo.s3.amazonaws.com/sales/2021/singeo-logo.png"
                loading="lazy"
                onload="this.classList.remove('opacity-0')"
            >
            <h3 class="mt-3 mb-7 md:mb-10 lg:mb-14 leading-tight"><strong>Your start-to-finish guide<br class="inline md:hidden"> to confident singing.</strong></h3>
            <div class="flex flex-wrap md:flex-nowrap items-center justify-center">
                <img 
                    class="flex-shrink-0 h-40 md:h-60 lg:h-80 transition-opacity opacity-0" 
                    src="https://cdn.musora.com/image/fetch/w_1100,q_auto:best/https://musora-center.s3.amazonaws.com/homepage/2021/singeo-graphic.png"
                    loading="lazy"
                    onload="this.classList.remove('opacity-0')"
                >
                <div class="w-full md:w-auto mt-5 md:mt-0 px-6 md:pr-0 md:pl-10 lg:pl-12">
                    <h6 class="leading-relaxed"><strong class="text-singeo"><i class="fas fa-microphone-stand"></i></strong> just released in 2021.<br>
                    <strong class="text-singeo">3+</strong> weekly live events.<br>
                    <strong class="text-singeo">100+</strong> songs with karaoke.<br></h6>
                    <a class="w-auto md:w-full join singeo smaller mt-4 md:mt-7 mb-4" href="https://www.singeo.com/">VISIT SINGEO</a><br>
                    <a class="transition-colors duration-300 py-1.5 w-9 h-9 text-xl leading-none rounded-full inline-block text-center mx-0.5 border-2 social-button facebook" target="_blank" rel="noopener" href="https://www.facebook.com/singeoofficial/"><i class="fab fa-facebook-f"></i></a>
                    <a class="transition-colors duration-300 py-1.5 w-9 h-9 text-xl leading-none rounded-full inline-block text-center mx-0.5 border-2 social-button youtube" target="_blank" rel="noopener" href="https://www.youtube.com/c/singeoofficial"><i class="fab fa-youtube"></i></a>
                    <a class="transition-colors duration-300 py-1.5 w-9 h-9 text-xl leading-none rounded-full inline-block text-center mx-0.5 border-2 social-button instagram" target="_blank" rel="noopener" href="https://www.instagram.com/singeoofficial/"><i class="fab fa-instagram"></i></a>
                    <a class="transition-colors duration-300 py-1.5 w-9 h-9 text-xl leading-none rounded-full inline-block text-center mx-0.5 border-2 social-button blog" target="_blank" rel="noopener" href="https://www.singeo.com/chorus/"><i class="fas fa-blog"></i></a>
                </div>
            </div>
        </div>
    </section>

    @include('musora._partials._lets-chat')
@stop
