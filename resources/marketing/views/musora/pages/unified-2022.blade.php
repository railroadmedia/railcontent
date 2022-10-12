@extends('musora._partials.layout')

@section('head-includes')
    <title>Musora | Drumeo, Pianote, Singeo, Guitareo</title>
    <meta property="og:title" content="Musora | Drumeo, Pianote, Singeo, Guitareo">

    <meta name="description" content="Learn the songs you love; now on drums, piano, guitar, or vocals.">
    <meta property="og:description" content="Learn the songs you love; now on drums, piano, guitar, or vocals.">

    <meta property="og:url" content="https://www.musora.com/unified-2022">
    <meta property="og:image" content="https://musora-center.s3.amazonaws.com/homepage/2021/share-image.jpg">
    <style>
        .reveal-overlay{position:fixed;top:0;right:0;bottom:0;left:0;z-index:2147483002;display:none;overflow-y:auto;background-color:rgba(0,0,0,0.8)}.reveal-overlay:after{-moz-osx-font-smoothing:grayscale;-webkit-font-smoothing:antialiased;font-family:"Font Awesome 5 Pro";font-weight:900;font-style:normal;font-variant:normal;text-rendering:auto;content:"\f00d";color:#fff;z-index:1;opacity:0.8;position:absolute;margin:0;line-height:1em;text-align:center;display:inline-block;outline:none;top:0;right:0;font-size:35px;width:35px}@media (min-width: 768px){.reveal-overlay:after{top:7px;right:7px;font-size:50px;width:50px}}.reveal-overlay .reveal{z-index:1006;-webkit-backface-visibility:hidden;backface-visibility:hidden;display:none;background-color:#fefefe;position:relative;top:100px;margin-right:auto;margin-left:auto;overflow-y:auto;width:90%;height:inherit;min-height:0;outline:none;padding:0;border:none;border-radius:7px}@media (min-width: 768px){.reveal-overlay .reveal{right:auto;left:auto;margin:0 auto}}
        .join.smaller {
            font-family:"Bebas Neue",sans-serif!important;
            font-weight: 400!important;
            font-size: 16px!important;
        }
        @media (min-width: 40em) {
            .join.smaller {
                font-size: 18px!important;
            }
        }
        .join.absolute {
            position:absolute!important;
        }
        .join.white {
            background:#fff!important;
            color:#000!important;
        }
        .join.drumeo {
            background:#0b76db;
        }
        .join.drumeo:hover {
            background:#0c84f5;
        }
        .join.pianote {
            background:#F61A30;
        }
        .join.pianote:hover {
            background:#ff3347;
        }
        .join.guitareo {
            background:#00C9AC;
        }
        .join.guitareo:hover {
            background:#00e3c1;
        }
        .join.singeo {
            background:#8300E9;
        }
        .join.singeo:hover {
            background:#9000ff;
        }
        .dropdown .bg-singeo {
            background: transparent!important;
            min-width: 32px;
        }
        @media (min-width: 40em) {
            .dropdown .bg-singeo {
                min-width: 83px;
            }
        }
        .dropdown .description {
            height: 0;
            max-height: 0;
            visibility: hidden;
            opacity: 0;
            overflow: hidden;
        }
        .dropdown.active .description {
            visibility: visible;
            opacity: 1;
            height: auto;
            max-height: 1000px;
        }
        .header-pic {
            background-image:url(https://cdn.musora.com/image/fetch/w_1200,q_auto:best/https://musora-web-platform.s3.amazonaws.com/musora/homepage/header_m.jpg);
        }
        @media (min-width: 64em) {
            .header-pic {
                background-image:url(https://cdn.musora.com/image/fetch/w_1200,q_auto:best/https://musora-web-platform.s3.amazonaws.com/musora/homepage/header.jpg);
            }

        }
        .flip-div .back,
        .flip-div .back {
            -ms-transform: rotateY(-180deg)!important;
            -webkit-transform: rotateY(-180deg)!important;
            transform: rotateY(-180deg)!important;
        }
        .flip-div .front,
        .flip-div .back {
            -ms-transition: transform 0.8s!important;
            -webkit-transition: transform 0.8s!important;
            transition: transform 0.8s!important;
            -ms-backface-visibility: hidden!important;
            -webkit-backface-visibility: hidden!important;
            backface-visibility: hidden!important;
        }
        .flip-div.flipped .front,
        .flip-div.flipped .front {
            -ms-transform: rotateY(180deg)!important;
            -webkit-transform: rotateY(180deg)!important;
            transform: rotateY(180deg)!important;
        }
        .flip-div.flipped .back,
        .flip-div.flipped .back {
            -ms-transform: rotateY(0deg)!important;
            -webkit-transform: rotateY(0deg)!important;
            transform: rotateY(0deg)!important;
        }

        .line-container::after {
            content:'';
            position:absolute;
            width:3px;
            background:linear-gradient(to bottom, #0976db, #f61a30 25%, #03c8ac 50%, #9a01ee 75%);
            top:0;
            bottom:0;
            left:4px;
            margin-left:-3px;
            z-index:10;
        }

        @media (min-width:768px) {
            .line-container::after {
                left:50%;
                top:20px;
            }
        }

        .timeline-number {
            display: none;
            width: 20px;
            height: 20px;
            font-size: 12px;
            border-radius: 50%;
            align-items: center;
            justify-content: center;
            top: 10px;
        }

        .timeline-number.right {
            left: -32px;
        }

        .timeline-number.left {
            left: -36px;
        }

        @media (min-width: 640px) {
            .timeline-number {
                width: 25px;
                height: 25px;
            }
        }

        @media (min-width: 768px) {

            .timeline-number {
                display: flex;
                width: 15px;
                height: 15px;
            }
            .timeline-number.right {
                left:unset;
                right: -6px;
            }

            .timeline-number.left {
                left: -9px;
            }
        }
    </style>
@endsection

@section('body-data')
    x-data = '{
    modal: false,
    trailer: false,
    }'
@endsection
<!-- Main -->
@section('layout-body')

    <header class="text-white px-5 sm:px-6 py-12 sm:py-16 lg:py-24" style="background-color:#020f1a;">
        <div class="container max-w-5xl mx-auto">
            <div class="flex flex-wrap items-center">
                <div class="header-pic sm:order-1 pb-64 sm:pb-80 mb-7 sm:mb-0 w-full sm:w-auto rounded-xl flex-grow relative bg-center bg-cover cursor-pointer autoplay-video" x-on:click="trailer = true; modal = true">
                    <div class="join white smaller absolute bottom-3 sm:bottom-7 right-3 sm:right-7"><i class="fas fa-play"></i>&nbsp; PLAY TRAILER</div>
                </div>
                <div class="w-full sm:w-5/12 sm:pr-4 text-center sm:text-left">
                    <img class="h-14 hidden sm:inline-block" src="https://cdn.musora.com/image/fetch/w_480,q_auto:best/https://musora-web-platform.s3.amazonaws.com/musora/homepage/musora_brands_logo.png">
                    <img class="h-10 inline-block sm:hidden" src="https://musora-web-platform.s3.amazonaws.com/musora/homepage/musora_brands_logo_m.png">
                    <h2 class="leading-tight mt-5 sm:mt-10 mb-2 sm:mb-5"><strong>Your membership just got a massive upgrade.</strong></h2>
                    <p>You now have an all-access pass to <br class="hidden md:inline-block">
                        learn drums, piano, vocals, and guitar.</p>
                </div>
            </div>
        </div>
    </header>

    <section class="text-center px-5 sm:px-6 py-10 sm:py-14 lg:py-20" style="background-color:#f9f9fb;">
        <div class="container max-w-4xl mx-auto">
            <h3 style="display:inline-block;background: -webkit-linear-gradient(20deg, #03c8ac, #0976db, #9a01ee, #f61a30);-webkit-background-clip: text;-webkit-text-fill-color: transparent;"><strong>The Ultimate Music Lessons Experience</strong></h3>
            <p class="leading-tight mt-3 mb-10 max-w-2xl mx-auto">You now have access to all of our lessons and practice tools for drums, piano, guitar, and singing – at no extra cost to you – PLUS the unified platform allows us to upgrade your experience easier with shared technology. Here are a few things you’ll notice:</p>

            <div class="flex flex-wrap items-start text-left">
                <div class="flex items-start w-full sm:w-1/2 p-4">
                    <img class="h-12" src="https://musora-web-platform.s3.amazonaws.com/musora/homepage/unified_icon.svg">
                    <p class="pl-5 mt-2"><strong class="font-black">Improved search capability</strong><br>
                        Find the lessons you want faster with our improved and predictive search capability!</p>
                </div>
                <div class="flex items-start w-full sm:w-1/2 p-4">
                    <img class="h-12" src="https://musora-web-platform.s3.amazonaws.com/musora/homepage/navigation_icon.svg">
                    <p class="pl-5 mt-2"><strong class="font-black">Updated navigation</strong><br>
                        Easily access account links (settings, schedule, notifications, and support) from a new drop-down menu.</p>
                </div>
                <div class="flex items-start w-full sm:w-1/2 p-4">
                    <img class="h-12" src="https://musora-web-platform.s3.amazonaws.com/musora/homepage/loading_icon.svg">
                    <p class="pl-5 mt-2"><strong class="font-black">Faster load times across the site</strong><br>
                        Attention spans are shorter than ever -- and our new site now loads faster to keep up!</p>
                </div>
                <div class="flex items-start w-full sm:w-1/2 p-4">
                    <img class="h-12" src="https://musora-web-platform.s3.amazonaws.com/musora/homepage/dark_icon.svg">
                    <p class="pl-5 mt-2"><strong class="font-black">Dark mode</strong><br>
                        Some find dark mode easier on the eyes - others just think it looks cool! Either way, it’s available now!</p>
                </div>
            </div>
        </div>
    </section>
    <div class="h-5 sm:h-10 -mt-5 sm:-mt-10" style="background: linear-gradient(to bottom right, transparent calc(50% - 1px), transparent, #fff calc(50% + 1px));"></div>
    <section class="text-center px-5 sm:px-6 py-10 sm:py-14 lg:py-20">
        <div class="container max-w-4xl mx-auto line-container relative">
            <div class="flex flex-wrap md:flex-nowrap items-center justify-center mb-14 sm:mb-20">
                <div class="w-full sm:w-1/2 pl-5 sm:pl-0 sm:pr-5">
                    <img
                        class="rounded-xl transition-opacity opacity-0"
                        src="https://cdn.musora.com/image/fetch/w_900,q_auto:best/https://musora-web-platform.s3.amazonaws.com/musora/homepage/drumeo_feature.jpg"
                        loading="lazy"
                        onload="this.classList.remove('opacity-0')"
                    >
                </div>
                <div class="w-full sm:w-1/2 relative mt-5 md:mt-0 px-6 md:pr-0 md:pl-10 lg:pl-12">
                    <img
                        class="h-7 md:h-10 transition-opacity opacity-0"
                        src="https://cdn.musora.com/image/fetch/w_350,q_auto:best/https://dpwjbsxqtam5n.cloudfront.net/logos/logo-blue.png"
                        loading="lazy"
                        onload="this.classList.remove('opacity-0')"
                    >
                    <h4 class="mt-3 leading-tight"><strong>The world’s largest<br class="inline md:hidden"> drum lessons community.</strong></h4>
                    <p class="my-3 sm:my-5 text-gray-500 leading-relaxed"><strong class="text-drumeo"><i class="fas fa-trophy"></i></strong> award-winning lessons.<br>
                        <strong class="text-drumeo">3.2M+</strong> lessons completed.<br>
                        <strong class="text-drumeo">100+</strong> legendary teachers.<br></p>
                    <a class="join drumeo smaller mb-4 sm:w-2/3" href="https://www.musora.com/drumeo">VISIT DRUMEO</a><br>
                    <a class="text-gray-400 border-gray-400 transition-colors duration-300 py-1.5 w-9 h-9 text-xl leading-none rounded-full inline-block text-center mx-0.5 border-2 social-button facebook" target="_blank" rel="noopener" href="https://www.facebook.com/drumeo/"><i class="fab fa-facebook-f"></i></a>
                    <a class="text-gray-400 border-gray-400 transition-colors duration-300 py-1.5 w-9 h-9 text-xl leading-none rounded-full inline-block text-center mx-0.5 border-2 social-button youtube" target="_blank" rel="noopener" href="https://www.youtube.com/freedrumlessons"><i class="fab fa-youtube"></i></a>
                    <a class="text-gray-400 border-gray-400 transition-colors duration-300 py-1.5 w-9 h-9 text-xl leading-none rounded-full inline-block text-center mx-0.5 border-2 social-button instagram" target="_blank" rel="noopener" href="https://www.instagram.com/drumeoofficial/"><i class="fab fa-instagram"></i></a>
                    <a class="text-gray-400 border-gray-400 transition-colors duration-300 py-1.5 w-9 h-9 text-xl leading-none rounded-full inline-block text-center mx-0.5 border-2 social-button blog" target="_blank" rel="noopener" href="https://www.drumeo.com/beat/"><i class="fas fa-blog"></i></a>
                    <a class="text-gray-400 border-gray-400 transition-colors duration-300 py-1.5 w-9 h-9 text-xl leading-none rounded-full inline-block text-center mx-0.5 border-2 social-button podcast" target="_blank" rel="noopener" href="https://open.spotify.com/show/1cN1jx7gLVvUYpEeQMwgn0"><i class="fas fa-podcast"></i></a>
                    <div class="absolute top-0 z-50 timeline-number left" style="background-color:#0976db;"></div>
                </div>
            </div>
            <div class="flex flex-wrap md:flex-nowrap items-center justify-center mb-14 sm:mb-20">
                <div class="sm:order-1 w-full sm:w-1/2 pl-5">
                    <img
                        class="rounded-xl transition-opacity opacity-0"
                        src="https://cdn.musora.com/image/fetch/w_900,q_auto:best/https://musora-web-platform.s3.amazonaws.com/musora/homepage/pianote_feature.jpg"
                        loading="lazy"
                        onload="this.classList.remove('opacity-0')"
                    >
                </div>
                <div class="w-full sm:w-1/2 relative mt-5 md:mt-0 px-6 md:pr-0 md:pr-10 lg:pr-12">
                    <img
                        class="h-7 md:h-10 transition-opacity opacity-0"
                        src="https://cdn.musora.com/image/fetch/w_350,q_auto:best/https://pianote.s3.amazonaws.com/logo/pianote-logo-red.png"
                        loading="lazy"
                        onload="this.classList.remove('opacity-0')"
                    >
                    <h4 class="mt-3 leading-tight"><strong>Learn the piano anytime<br class="inline md:hidden"> with real teachers.</strong></h4>
                    <p class="my-3 sm:my-5 text-gray-500 leading-relaxed"><strong class="text-pianote"><i class="fas fa-heart"></i></strong> technology meets tradition.<br>
                        <strong class="text-pianote">1.2M+</strong> lessons completed.<br>
                        <strong class="text-pianote">5+</strong> weekly live events.<br></p>
                    <a class="join pianote smaller mb-4 sm:w-2/3" href="https://www.musora.com/pianote">VISIT Pianote</a><br>
                    <a class="text-gray-400 border-gray-400 transition-colors duration-300 py-1.5 w-9 h-9 text-xl leading-none rounded-full inline-block text-center mx-0.5 border-2 social-button facebook" target="_blank" rel="noopener" href="https://www.facebook.com/pianoteofficial"><i class="fab fa-facebook-f"></i></a>
                    <a class="text-gray-400 border-gray-400 transition-colors duration-300 py-1.5 w-9 h-9 text-xl leading-none rounded-full inline-block text-center mx-0.5 border-2 social-button youtube" target="_blank" rel="noopener" href="https://www.youtube.com/user/pianolessonscom"><i class="fab fa-youtube"></i></a>
                    <a class="text-gray-400 border-gray-400 transition-colors duration-300 py-1.5 w-9 h-9 text-xl leading-none rounded-full inline-block text-center mx-0.5 border-2 social-button instagram" target="_blank" rel="noopener" href="https://www.instagram.com/pianoteofficial/"><i class="fab fa-instagram"></i></a>
                    <a class="text-gray-400 border-gray-400 transition-colors duration-300 py-1.5 w-9 h-9 text-xl leading-none rounded-full inline-block text-center mx-0.5 border-2 social-button blog" target="_blank" rel="noopener" href="https://www.pianote.com/blog/"><i class="fas fa-blog"></i></a>
                    <a class="text-gray-400 border-gray-400 transition-colors duration-300 py-1.5 w-9 h-9 text-xl leading-none rounded-full inline-block text-center mx-0.5 border-2 social-button podcast" target="_blank" rel="noopener" href="https://open.spotify.com/show/3A8KKvYYhanvHIVLxcycMf"><i class="fas fa-podcast"></i></a>
                    <div class="absolute top-0 z-50 timeline-number right" style="background-color:#f61a30;"></div>
                </div>
            </div>
            <div class="flex flex-wrap md:flex-nowrap items-center justify-center mb-14 sm:mb-20">
                <div class="w-full sm:w-1/2 pl-5 sm:pl-0 sm:pr-5">
                    <img
                        class="rounded-xl transition-opacity opacity-0"
                        src="https://cdn.musora.com/image/fetch/w_900,q_auto:best/https://musora-web-platform.s3.amazonaws.com/musora/homepage/guitareo_feature.jpg"
                        loading="lazy"
                        onload="this.classList.remove('opacity-0')"
                    >
                </div>
                <div class="w-full sm:w-1/2 relative mt-5 md:mt-0 px-6 md:pr-0 md:pl-10 lg:pl-12">
                    <img
                        class="h-7 md:h-10 transition-opacity opacity-0"
                        src="https://cdn.musora.com/image/fetch/w_350,q_auto:best/https://guitareo.s3.amazonaws.com/sales/guitareo-logo-green.png"
                        loading="lazy"
                        onload="this.classList.remove('opacity-0')"
                    >
                    <h4 class="mt-3 leading-tight"><strong>The ultimate online guitar<br class="inline md:hidden"> lessons experience.</strong></h4>
                    <p class="my-3 sm:my-5 text-gray-500 leading-relaxed"><strong class="text-guitareo"><i class="fas fa-guitar"></i></strong> released in 2017.<br>
                        <strong class="text-guitareo">Full 10-step</strong> curriculum.<br>
                        <strong class="text-guitareo">500+</strong> charts for popular songs.<br></p>
                    <a class="join guitareo smaller mb-4 sm:w-2/3" href="https://www.musora.com/guitareo/">VISIT GUITAREO</a><br>
                    <a class="text-gray-400 border-gray-400 transition-colors duration-300 py-1.5 w-9 h-9 text-xl leading-none rounded-full inline-block text-center mx-0.5 border-2 social-button facebook" target="_blank" rel="noopener" href="https://www.facebook.com/guitareoofficial"><i class="fab fa-facebook-f"></i></a>
                    <a class="text-gray-400 border-gray-400 transition-colors duration-300 py-1.5 w-9 h-9 text-xl leading-none rounded-full inline-block text-center mx-0.5 border-2 social-button youtube" target="_blank" rel="noopener" href="https://www.youtube.com/user/guitarlessonscom"><i class="fab fa-youtube"></i></a>
                    <a class="text-gray-400 border-gray-400 transition-colors duration-300 py-1.5 w-9 h-9 text-xl leading-none rounded-full inline-block text-center mx-0.5 border-2 social-button instagram" target="_blank" rel="noopener" href="https://www.instagram.com/guitareoofficial/"><i class="fab fa-instagram"></i></a>
                    <a class="text-gray-400 border-gray-400 transition-colors duration-300 py-1.5 w-9 h-9 text-xl leading-none rounded-full inline-block text-center mx-0.5 border-2 social-button blog" target="_blank" rel="noopener" href="https://www.guitareo.com/riff/"><i class="fas fa-blog"></i></a>
                    <div class="absolute top-0 z-50 timeline-number left" style="background-color:#03c8ac;"></div>
                </div>
            </div>
            <div class="flex flex-wrap md:flex-nowrap items-center justify-center">
                <div class="sm:order-1 w-full sm:w-1/2 pl-5">
                    <img
                        class="rounded-xl transition-opacity opacity-0"
                        src="https://cdn.musora.com/image/fetch/w_900,q_auto:best/https://musora-web-platform.s3.amazonaws.com/musora/homepage/singeo_feature.jpg"
                        loading="lazy"
                        onload="this.classList.remove('opacity-0')"
                    >
                </div>
                <div class="w-full sm:w-1/2 relative mt-5 md:mt-0 px-6 md:pr-0 md:pr-10 lg:pr-12">
                    <img
                        class="h-7 md:h-10 transition-opacity opacity-0"
                        src="https://cdn.musora.com/image/fetch/w_350,q_auto:best/https://singeo.s3.amazonaws.com/sales/2021/singeo-logo.png"
                        loading="lazy"
                        onload="this.classList.remove('opacity-0')"
                    >
                    <h4 class="mt-3 leading-tight"><strong>Your start-to-finish guide<br class="inline md:hidden"> to confident singing.</strong></h4>
                    <p class="my-3 sm:my-5 text-gray-500 leading-relaxed"><strong class="text-singeo"><i class="fas fa-microphone-stand"></i></strong> just released in 2021.<br>
                        <strong class="text-singeo">3+</strong> weekly live events.<br>
                        <strong class="text-singeo">100+</strong> songs with karaoke.<br></p>
                    <a class="join singeo smaller mb-4 sm:w-2/3" href="https://www.singeo.com/">VISIT SINGEO</a><br>
                    <a class="text-gray-400 border-gray-400 transition-colors duration-300 py-1.5 w-9 h-9 text-xl leading-none rounded-full inline-block text-center mx-0.5 border-2 social-button facebook" target="_blank" rel="noopener" href="https://www.facebook.com/singeoofficial/"><i class="fab fa-facebook-f"></i></a>
                    <a class="text-gray-400 border-gray-400 transition-colors duration-300 py-1.5 w-9 h-9 text-xl leading-none rounded-full inline-block text-center mx-0.5 border-2 social-button youtube" target="_blank" rel="noopener" href="https://www.youtube.com/c/singeoofficial"><i class="fab fa-youtube"></i></a>
                    <a class="text-gray-400 border-gray-400 transition-colors duration-300 py-1.5 w-9 h-9 text-xl leading-none rounded-full inline-block text-center mx-0.5 border-2 social-button instagram" target="_blank" rel="noopener" href="https://www.instagram.com/singeoofficial/"><i class="fab fa-instagram"></i></a>
                    <a class="text-gray-400 border-gray-400 transition-colors duration-300 py-1.5 w-9 h-9 text-xl leading-none rounded-full inline-block text-center mx-0.5 border-2 social-button blog" target="_blank" rel="noopener" href="https://www.singeo.com/chorus/"><i class="fas fa-blog"></i></a>
                    <div class="absolute top-0 z-50 timeline-number right" style="background-color:#9a01ee;"></div>
                </div>
            </div>
        </div>
    </section>
    <section class="text-center px-5 sm:px-6 py-10 sm:py-14 lg:py-20" style="background-color:#f9f9fb;">
        <div class="container max-w-4xl mx-auto">
            <img class="h-16" src="https://cdn.musora.com/image/fetch/w_480,q_auto:best/https://musora-web-platform.s3.amazonaws.com/musora/homepage/musora_mentors_logo.png">
            <p class="mt-1 tracking-wider"><strong>MUSICIANS HELPING MUSICIANS</strong></p>
            <p class="max-w-2xl my-5 mx-auto">Our music lesson communities have always valued relationships before technology.
                <br><br>
                So we're doubling down on the personal touch with Musora Mentors – where you’ll get direct access to a Mentor that aligns with your musical experience and goals.</p>
            <div class="flex flex-wrap items-center">
                <div class="w-1/2 flex-grow md:order-1 mb-5 sm:mb-0"><img src="https://cdn.musora.com/image/fetch/w_1000,q_auto:best/https://musora-web-platform.s3.amazonaws.com/musora/homepage/features.png"></div>
                <div class="w-full sm:w-5/12 text-left py-7 px-6 sm:px-9 sm:mr-5 rounded-xl bg-white border border-gray-300">
                    <p><strong>You’ll get personal guidance for a better music lessons experience, including:</strong></p>
                    <ul class="fa-ul mt-4 sm:mt-7 ml-6">
                        <li><i class="fa-li fas fa-check" style="background: -webkit-linear-gradient(20deg, #03c8ac, #0976db, #9a01ee, #f61a30);-webkit-background-clip: text;-webkit-text-fill-color: transparent;"></i> Finding the right lesson</li>
                        <li><i class="fa-li fas fa-check" style="background: -webkit-linear-gradient(20deg, #03c8ac, #0976db, #9a01ee, #f61a30);-webkit-background-clip: text;-webkit-text-fill-color: transparent;"></i> Troubleshooting the tech</li>
                        <li><i class="fa-li fas fa-check" style="background: -webkit-linear-gradient(20deg, #03c8ac, #0976db, #9a01ee, #f61a30);-webkit-background-clip: text;-webkit-text-fill-color: transparent;"></i> Choosing songs to play next</li>
                        <li><i class="fa-li fas fa-check" style="background: -webkit-linear-gradient(20deg, #03c8ac, #0976db, #9a01ee, #f61a30);-webkit-background-clip: text;-webkit-text-fill-color: transparent;"></i> Answering music-related questions</li>
                        <li><i class="fa-li fas fa-check" style="background: -webkit-linear-gradient(20deg, #03c8ac, #0976db, #9a01ee, #f61a30);-webkit-background-clip: text;-webkit-text-fill-color: transparent;"></i> Or… whatever else gets in the way.</li>
                    </ul>
                </div>
            </div>
            <p class="my-9 sm:my-14">Mentors understand the musical journey you’re on personally. We’ll be choosing a <br class="hidden md:inline-block">
                Mentor that suits you best soon – and they’ll be in touch to introduce themselves.</p>

            <div style="font-size: 0;">
                @php
                    $bonuses = [
                        [
                        'image' => 'https://musora-web-platform.s3.amazonaws.com/musora/homepage/jenn.jpg',
                        'first' => 'Jenn ',
                        'last' => 'vO',
                        'drumeo' => true,
                        'pianote' => true,
                        'description' => 'Jenn vO grew up in a musical family with piano playing in the background and songs sung around the dinner table. She took piano, trumpet, and guitar lessons, and sang in a concert choir for 8 years! When she’s not working, she adores hanging out with her husband and kids and cooking good food for friends. ',
                        ],
                        [
                        'image' => 'https://musora-web-platform.s3.amazonaws.com/musora/homepage/carlos.jpg',
                        'first' => 'Carlos ',
                        'last' => 'B',
                        'drumeo' => true,
                        'guitareo' => true,
                        'description' => 'Carlos began classical guitar studies through a conservatory in Venezuela. At 11, he learned to hold the drumsticks and play his first beat using Drumeo! Aside from spending time with friends and family, personal training, and traveling, Carlos will soon release his debut album: Inner Child, featuring drummer Matt Garstka. ',
                        ],
                        [
                        'image' => 'https://musora-web-platform.s3.amazonaws.com/musora/homepage/sara.jpg',
                        'first' => 'Sara ',
                        'last' => 'T',
                        'pianote' => true,
                        'singeo' => true,
                        'description' => 'When she’s not chatting with students, Sara spends her free time wandering the forests of the West Coast. You might find her practicing vocal exercises during her adventures (so she doesn’t encounter bears, of course. She’s a great singer - we promise!) Having spent most of her life singing, Sara credits her passion to the happiness and fulfillment of learning music. ',
                        ],
                        [
                        'image' => 'https://musora-web-platform.s3.amazonaws.com/musora/homepage/emily.jpg',
                        'first' => 'Emily ',
                        'last' => 'J',
                        'pianote' => true,
                        'singeo' => true,
                        'description' => 'Emily’s #1 passion in life is music! She’s toured across six countries with her all-female rock’n’roll band and has released three albums, with a fourth on the way! While her primary focus has always been songwriting, singing, and playing the guitar, she also has a passion for the drums, bass, ukulele & piano!',
                        ],
                        [
                        'image' => 'https://musora-web-platform.s3.amazonaws.com/musora/homepage/jorge.jpg',
                        'first' => 'Jorge ',
                        'last' => 'B',
                        'drumeo' => true,
                        'pianote' => true,
                        'description' => 'Jorge always dreamed of becoming a musician. At 16, he discovered Drumeo and began to learn the drums, even though he didn’t have a drum kit, practicing by air drumming and memorizing patterns. Jorge lives in Madrid, where he works with local artists as a session drummer. He is also a drum teacher, music producer, and soon-to-be audio engineer.',
                        ],
                        [
                        'image' => 'https://musora-web-platform.s3.amazonaws.com/musora/homepage/roni.jpg',
                        'first' => 'Roni ',
                        'last' => 'K',
                        'drumeo' => true,
                        'pianote' => true,
                        'description' => 'Roni grew up in a musical family playing “Name That Tune” and enjoying live music performances. She took every musical opportunity growing up including Concert and Jazz band, choir, guitar class, drumline, and even played for the Special Olympics opening ceremony. Roni can be found hanging with family and friends, being crafty, and playing her clarinet. ',
                        ],
                        [
                        'image' => 'https://musora-web-platform.s3.amazonaws.com/musora/homepage/kaitlyn.jpg',
                        'first' => 'Kaitlyn ',
                        'last' => 'C',
                        'drumeo' => true,
                        'pianote' => true,
                        'description' => 'Kaitlyn is a huge music lover and has been jamming along to all genres of music all her life! She is a beginner-level piano player (you may have seen some videos in Pianote!). Kaitlyn loves making people laugh, listening to and finding new music, hiking mountains, and spending time with her friends, family, and cat (Leo). ',
                        ],
                        [
                        'image' => 'https://musora-web-platform.s3.amazonaws.com/musora/homepage/hannah2.jpg',
                        'first' => 'Hannah ',
                        'last' => 'D',
                        'pianote' => true,
                        'guitareo' => true,
                        'description' => 'Hannah is a lifelong music lover who dabbles in piano, singing, guitar, and occasionally ukulele! She loves to see students realize the joy music can bring to their lives. In her free time, she loves finding new music to listen to, spending time with her partner and two devious cats, and pursuing various other artistic interests.',
                        ],
                        [
                        'image' => 'https://musora-web-platform.s3.amazonaws.com/musora/homepage/joy2.jpg',
                        'first' => 'Joy ',
                        'last' => 'B',
                        'drumeo' => true,
                        'pianote' => true,
                        'description' => 'Joy is passionate about everything music and loves helping people find their unique rhythm and style.  She plays drums, dabbles at the piano, and is learning bass. Sax was her first instrument, but the drums are what feed her soul. Joy has been a die-hard Raptors fan since Day 1, screaming her coaching advice at the TV! ',
                        ],
                        [
                        'image' => 'https://musora-web-platform.s3.amazonaws.com/musora/homepage/jenn_k.jpg',
                        'first' => 'Jenn ',
                        'last' => 'K',
                        'drumeo' => true,
                        'pianote' => true,
                        'description' => 'Jenn K is a die-hard music lover and has worked for Musora for 10+ years.  In her younger years, she played in a family band with her brothers and had one of her songs placed in a Kate Hudson movie! In her spare time, she enjoys spending time with her kids outside, playing piano, writing songs, and hanging with her dogs and farm critters.',
                        ],
                    ]
                @endphp
                @foreach($bonuses as $bonus)
                    <div class="bonus-wrap relative inline-block align-top mx-auto mb-3 px-3 md:px-1.5 w-full sm:w-1/3 lg:w-1/4" style="max-width:250px;">
                        <div class="flip-div inline-block relative w-full group" style="padding-bottom: 120%; perspective: 1000px;" onclick="this.classList.toggle('flipped')">
                            <div class="text-center w-full h-full absolute cursor-pointer" style="transform-style: preserve-3d;">
                                <div class="shadow-sm front absolute z-20 overflow-hidden rounded-xl w-full h-full transition-transform duration-700" style="@if(!empty($bonus['special'])) overflow: visible;border-color: #cda880; @endif backface-visibility: hidden;">
                                    <div class="pb-3 flex flex-wrap content-end justify-center absolute z-30 text-center inset-0 text-white visible text-shadow-2" style="background:linear-gradient(to bottom, transparent 70%, black);">
                                        <h4 class="w-full uppercase font-bebas leading-normal mx-auto"><strong>{!! $bonus['first'] !!}</strong> {!! $bonus['last'] !!}</h4>
                                        <img class="inline-block h-3 mr-1.5 @if(empty($bonus['drumeo'])) filter brightness-0 contrast-0 invert saturate-0 @endif" src="https://dpwjbsxqtam5n.cloudfront.net/logos/logo-blue.png">
                                        <img class="inline-block h-3 mr-1.5 @if(empty($bonus['pianote'])) filter brightness-0 contrast-0 invert saturate-0 @endif" src="https://pianote.s3.amazonaws.com/logo/pianote-logo-red.png">
                                        <img class="inline-block h-3 mr-1.5 @if(empty($bonus['guitareo'])) filter brightness-0 contrast-0 invert saturate-0 @endif" src="https://guitareo.s3.amazonaws.com/sales/guitareo-logo-green.png">
                                        <img class="inline-block h-3 @if(empty($bonus['singeo'])) filter brightness-0 contrast-0 invert saturate-0 @endif" src="https://singeo.s3.amazonaws.com/sales/2021/singeo-logo.png">
                                    </div>
                                    <div class="overflow-hidden rounded-xl h-full w-full bg-black bg-top bg-cover" style="background-image:url(https://cdn.musora.com/image/fetch/w_460,q_auto:best/{{ $bonus['image'] }})"></div>
                                    <div class="absolute z-40 text-center top-1/2 left-1/2 text-white transition-opacity duration-300 transform -translate-x-1/2 -translate-y-1/2 visible opacity-0 group-hover:opacity-100 text-shadow-2">
                                        <i class="fas fa-repeat text-4xl"></i><br>
                                        <p class="text-sm"><strong>LEARN MORE</strong></p>
                                    </div>
                                </div>
                                <div class="shadow-sm back absolute z-40 overflow-hidden rounded-xl w-full h-full transition-transform duration-700" style="backface-visibility: hidden;">
                                    <div class="w-full h-full mx-auto text-center text-white flex flex-wrap justify-center items-center content-center p-2 md:p-3" style="background:linear-gradient(to bottom, #01050f, #021225);">
                                        <p class="leading-normal mx-auto text-xs">{!! $bonus['description'] !!}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
    <div class="h-5 sm:h-10 -mb-5 sm:-mb-10 relative z-10" style="background: linear-gradient(to top left, transparent calc(50% - 1px), transparent, #f9f9fb calc(50% + 1px));"></div>
    <section class="text-center px-5 sm:px-6 py-10 sm:py-14 lg:py-20" style="background:linear-gradient(45deg, #e6fffb, #e6f2ff, #f6e6ff, #ffe6e8);">
        <div class="container max-w-2xl mx-auto">
            <div class="flex flex-wrap sm:flex-nowrap items-center justify-center">
                <img class="h-72 sm:h-96 mb-5 sm:mb-0" src="https://cdn.musora.com/image/fetch/w_500,q_auto:best/https://musora-web-platform.s3.amazonaws.com/musora/homepage/ui.png">
                <div class="flex-grow pl-8 sm:text-left">
                    <h3 class="leading-tight"><strong>The app for learning<br> the music you love.</strong></h3>
                    <p class="leading-tight my-5">Access the member’s area for Drumeo, Pianote, Singeo, and Guitareo all in one place. Our brand new Musora app has improved functionality and added features with full access to all four brands.</p>
                    <a class="inline-block" href="https://itunes.apple.com/us/app/musora/id1619053766?ls=1" target="_blank">
                        <img class="h-10 m-1" src="https://cdn.musora.com/image/fetch/w_260,q_auto:best/https://dpwjbsxqtam5n.cloudfront.net/app/download-on-app-store-button.png"></a>
                    <a class="inline-block" href="https://play.google.com/store/apps/details?id=com.musoraapp" target="_blank">
                        <img class="h-10 m-1" src="https://cdn.musora.com/image/fetch/w_260,q_auto:best/https://dpwjbsxqtam5n.cloudfront.net/app/google-play-button.png"></a>
                </div>
            </div>
        </div>
    </section>
    <section class="text-center px-5 sm:px-6 py-10 sm:py-14 lg:py-20">
        <div class="container max-w-4xl mx-auto">
            <h3 class="mb-4 sm:mb-10"><strong>Still have questions?</strong></h3>
            @include('musora._partials._dropdown', [
            "customClass" => "sm:rounded-full",
            "question" => true,
            "title" => "What happens to my progress inside the new platform?",
            "description" => "Any progress you’ve made so far within our learning platforms will be saved and migrated to Musora. Your current Method level, your XP, your account information, everything will follow you!",
            ])
            @include('musora._partials._dropdown', [
            "customClass" => "sm:rounded-full",
            "question" => true,
            "title" => "Which mobile app should I use?",
            "description" => "We’ve launched a brand new Musora mobile app with improved functionality and added features with access to all four brands. The Drumeo and Pianote mobile apps will remain accessible, but will not be updated with new content and features. Download the new app here:
            <a href='https://play.google.com/store/apps/details?id=com.musoraapp' target='_blank'>GOOGLE PLAY</a> / <a href='https://itunes.apple.com/us/app/musora/id1619053766?ls=1' target='_blank'>APPLE STORE</a>",
            ])
            @include('musora._partials._dropdown', [
            "customClass" => "sm:rounded-full",
            "question" => true,
            "title" => "What is the price for Musora?",
            "description" => "Good news! To thank you for supporting our business, we’re grandfathering in all existing membership prices. New students will pay a higher premium to become a part of Musora.",
            ])
            @include('musora._partials._dropdown', [
            "customClass" => "sm:rounded-full",
            "question" => true,
            "title" => "What if I currently pay for two memberships?",
            "description" => "Moving forward, you’ll only pay for the first membership you signed up for. For example, if you signed up for Pianote, then joined Singeo, your recurring annual membership will only be billed for Pianote, while giving you access to the three other platforms for free.",
            ])
            @include('musora._partials._dropdown', [
            "customClass" => "sm:rounded-full",
            "question" => true,
            "title" => "What changes have been made to this new platform to improve functionality?",
            "description" => "By combining our four member’s areas into one unified platform, we’re able to make changes and update features faster than ever. With this product update we’re launching the following features:
            A unified mobile app for easy brand switching;
            Updated navigation;
            Faster load times;
            Dark mode.",
            ])
            @include('musora._partials._dropdown', [
            "customClass" => "sm:rounded-full",
            "question" => true,
            "title" => "Do you have a multi-user plan that I can share with my family, friends, or bandmates?",
            "description" => "While we don’t have multi-user accounts built out (we’re working on it!), feel free to share your account with others! Our goal is to create more musicians around the world, and you can help us!",
            ])
        </div>
    </section>

    @include('musora._partials._modal',[
        'name' => 'modal',
        'additionalOnClose' => 'trailer = false;',
        'content' => '
            <div x-show="trailer" class="max-w-4xl mx-auto">
                <div class="w-full relative" style="padding-bottom:56.25%;">
                    <iframe class="absolute w-full h-full reset-on-close" src="//player.vimeo.com/video/759635284" frameborder="0" allowfullscreen allow="autoplay"></iframe>
                </div>
            </div>
        ',
    ])
@stop
