@extends('musora._partials.layout')

@section('head-includes')
    <title>Musora | Drumeo, Pianote, Singeo, Guitareo</title>
    <meta property="og:title" content="Musora | Drumeo, Pianote, Singeo, Guitareo">

    <meta name="description" content="Learn the songs you love; now on drums, piano, guitar, or vocals.">
    <meta property="og:description" content="Learn the songs you love; now on drums, piano, guitar, or vocals.">

    <meta property="og:url" content="https://www.musora.com/{{ Request::path() }}">
    <meta property="og:image" content="https://dmmior4id2ysr.cloudfront.net/homepage/2023/share-image3.jpg">
    <style>
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
        .header-pic {
            background-image:url(https://www.musora.com/musora-cdn/image/width=1200,quality=95/https://d3fzm1tzeyr5n3.cloudfront.net/musora/homepage/header_m.jpg);
        }
        @media (min-width: 64em) {
            .header-pic {
                background-image:url(https://www.musora.com/musora-cdn/image/width=1200,quality=95/https://d3fzm1tzeyr5n3.cloudfront.net/musora/homepage/header.jpg);
            }

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
        trailer: false,
    }'
@endsection
<!-- Main -->
@section('layout-body')

    <header class="text-white px-5 sm:px-6 py-12 sm:py-16 lg:py-24" style="background-color:#020f1a;">
        <div class="container max-w-5xl mx-auto">
            <div class="flex flex-wrap items-center">
                <div class="header-pic sm:order-1 pb-64 sm:pb-80 mb-7 sm:mb-0 w-full sm:w-auto rounded-xl flex-grow relative bg-center bg-cover cursor-pointer autoplay-video" x-on:click="trailer = true;">
                    <div class="absolute bottom-3 sm:bottom-7 right-3 sm:right-7 w-full text-right"><div class="join white smaller whitespace-nowrap"><i class="fas fa-play"></i>&nbsp; PLAY TRAILER</div></div>
                </div>
                <div class="w-full sm:w-5/12 sm:pr-4 text-center sm:text-left">
                    <img class="h-14 hidden sm:inline-block" src="https://www.musora.com/musora-cdn/image/width=480,quality=95/https://d3fzm1tzeyr5n3.cloudfront.net/musora/homepage/musora_brands_logo.png">
                    <img class="h-10 inline-block sm:hidden" src="https://d3fzm1tzeyr5n3.cloudfront.net/musora/homepage/musora_brands_logo_m.png">
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
                    <img class="h-12" src="https://d3fzm1tzeyr5n3.cloudfront.net/musora/homepage/unified_icon.svg">
                    <p class="pl-5 mt-2"><strong class="font-black">Improved search capability</strong><br>
                        Find the lessons you want faster with our improved and predictive search capability!</p>
                </div>
                <div class="flex items-start w-full sm:w-1/2 p-4">
                    <img class="h-12" src="https://d3fzm1tzeyr5n3.cloudfront.net/musora/homepage/navigation_icon.svg">
                    <p class="pl-5 mt-2"><strong class="font-black">Updated navigation</strong><br>
                        Easily access account links (settings, schedule, notifications, and support) from a new drop-down menu.</p>
                </div>
                <div class="flex items-start w-full sm:w-1/2 p-4">
                    <img class="h-12" src="https://d3fzm1tzeyr5n3.cloudfront.net/musora/homepage/loading_icon.svg">
                    <p class="pl-5 mt-2"><strong class="font-black">Faster load times across the site</strong><br>
                        Attention spans are shorter than ever — and our new site now loads faster to keep up!</p>
                </div>
                <div class="flex items-start w-full sm:w-1/2 p-4">
                    <img class="h-12" src="https://d3fzm1tzeyr5n3.cloudfront.net/musora/homepage/dark_icon.svg">
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
                        src="https://www.musora.com/musora-cdn/image/width=900,quality=95/https://d3fzm1tzeyr5n3.cloudfront.net/musora/homepage/drumeo_feature.jpg"
                        loading="lazy"
                        onload="this.classList.remove('opacity-0')"
                    >
                </div>
                <div class="w-full sm:w-1/2 relative mt-5 md:mt-0 px-6 md:pr-0 md:pl-10 lg:pl-12">
                    <img
                        class="h-7 md:h-10 transition-opacity opacity-0"
                        src="https://www.musora.com/musora-cdn/image/width=350,quality=95/https://dpwjbsxqtam5n.cloudfront.net/logos/logo-blue.png"
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
                        src="https://www.musora.com/musora-cdn/image/width=900,quality=95/https://d3fzm1tzeyr5n3.cloudfront.net/musora/homepage/pianote_feature.jpg"
                        loading="lazy"
                        onload="this.classList.remove('opacity-0')"
                    >
                </div>
                <div class="w-full sm:w-1/2 relative mt-5 md:mt-0 px-6 md:pr-0 md:pr-10 lg:pr-12">
                    <img
                        class="h-7 md:h-10 transition-opacity opacity-0"
                        src="https://www.musora.com/musora-cdn/image/width=350,quality=95/https://d2vyvo0tyx8ig5.cloudfront.net/logo/pianote-logo-red.png"
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
                        src="https://www.musora.com/musora-cdn/image/width=900,quality=95/https://d3fzm1tzeyr5n3.cloudfront.net/musora/homepage/guitareo_feature.jpg"
                        loading="lazy"
                        onload="this.classList.remove('opacity-0')"
                    >
                </div>
                <div class="w-full sm:w-1/2 relative mt-5 md:mt-0 px-6 md:pr-0 md:pl-10 lg:pl-12">
                    <img
                        class="h-7 md:h-10 transition-opacity opacity-0"
                        src="https://www.musora.com/musora-cdn/image/width=350,quality=95/https://d122ay5chh2hr5.cloudfront.net/sales/guitareo-logo-green.png"
                        loading="lazy"
                        onload="this.classList.remove('opacity-0')"
                    >
                    <h4 class="mt-3 leading-tight"><strong>The ultimate online guitar<br class="inline md:hidden"> lessons experience.</strong></h4>
                    <p class="my-3 sm:my-5 text-gray-500 leading-relaxed"><strong class="text-guitareo"><i class="fas fa-guitar"></i></strong> released in 2017.<br>
                        <strong class="text-guitareo">Full 10-step</strong> curriculum.<br>
                        <strong class="text-guitareo">500+</strong> charts for popular songs.<br></p>
                    <a class="join guitareo smaller mb-4 sm:w-2/3" href="https://www.musora.com/guitareo">VISIT GUITAREO</a><br>
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
                        src="https://www.musora.com/musora-cdn/image/width=900,quality=95/https://d3fzm1tzeyr5n3.cloudfront.net/musora/homepage/singeo_feature.jpg"
                        loading="lazy"
                        onload="this.classList.remove('opacity-0')"
                    >
                </div>
                <div class="w-full sm:w-1/2 relative mt-5 md:mt-0 px-6 md:pr-0 md:pr-10 lg:pr-12">
                    <img
                        class="h-7 md:h-10 transition-opacity opacity-0"
                        src="https://www.musora.com/musora-cdn/image/width=350,quality=95/https://d21xeg6s76swyd.cloudfront.net/sales/2021/singeo-logo.png"
                        loading="lazy"
                        onload="this.classList.remove('opacity-0')"
                    >
                    <h4 class="mt-3 leading-tight"><strong>Your start-to-finish guide<br class="inline md:hidden"> to confident singing.</strong></h4>
                    <p class="my-3 sm:my-5 text-gray-500 leading-relaxed"><strong class="text-singeo"><i class="fas fa-microphone-stand"></i></strong> just released in 2021.<br>
                        <strong class="text-singeo">3+</strong> weekly live events.<br>
                        <strong class="text-singeo">100+</strong> songs with karaoke.<br></p>
                    <a class="join singeo smaller mb-4 sm:w-2/3" href="https://www.musora.com/singeo">VISIT SINGEO</a><br>
                    <a class="text-gray-400 border-gray-400 transition-colors duration-300 py-1.5 w-9 h-9 text-xl leading-none rounded-full inline-block text-center mx-0.5 border-2 social-button facebook" target="_blank" rel="noopener" href="https://www.facebook.com/singeoofficial/"><i class="fab fa-facebook-f"></i></a>
                    <a class="text-gray-400 border-gray-400 transition-colors duration-300 py-1.5 w-9 h-9 text-xl leading-none rounded-full inline-block text-center mx-0.5 border-2 social-button youtube" target="_blank" rel="noopener" href="https://www.youtube.com/c/singeoofficial"><i class="fab fa-youtube"></i></a>
                    <a class="text-gray-400 border-gray-400 transition-colors duration-300 py-1.5 w-9 h-9 text-xl leading-none rounded-full inline-block text-center mx-0.5 border-2 social-button instagram" target="_blank" rel="noopener" href="https://www.instagram.com/singeoofficial/"><i class="fab fa-instagram"></i></a>
                    <a class="text-gray-400 border-gray-400 transition-colors duration-300 py-1.5 w-9 h-9 text-xl leading-none rounded-full inline-block text-center mx-0.5 border-2 social-button blog" target="_blank" rel="noopener" href="https://www.singeo.com/chorus/"><i class="fas fa-blog"></i></a>
                    <div class="absolute top-0 z-50 timeline-number right" style="background-color:#9a01ee;"></div>
                </div>
            </div>
        </div>
    </section>
    <div id="musoraapp" class="anchor"></div>
    <div class="h-5 sm:h-10 -mb-5 sm:-mb-10 relative z-10" style="background: linear-gradient(to top left, transparent calc(50% - 1px), transparent, #fff calc(50% + 1px));"></div>
    <section class="text-center px-5 sm:px-6 py-10 sm:py-14 lg:py-20" style="background:linear-gradient(45deg, #e6fffb, #e6f2ff, #f6e6ff, #ffe6e8);">
        <div class="container max-w-2xl mx-auto">
            <div class="flex flex-wrap sm:flex-nowrap items-center justify-center">
                <img class="h-72 sm:h-96 mb-5 sm:mb-0" src="https://www.musora.com/musora-cdn/image/width=500,quality=95/https://d3fzm1tzeyr5n3.cloudfront.net/musora/homepage/ui.png">
                <div class="flex-grow pl-8 sm:text-left">
                    <h3 class="leading-tight"><strong>The app for learning<br> the music you love.</strong></h3>
                    <p class="leading-tight my-5">Access the member’s area for Drumeo, Pianote, Singeo, and Guitareo all in one place. Our brand new Musora app has improved functionality and added features with full access to all four brands.</p>
                    <a class="inline-block" href="https://apps.apple.com/us/app/musora-the-music-lessons-app/id1460388277?ls=1" target="_blank">
                        <img class="h-10 m-1" src="https://www.musora.com/musora-cdn/image/width=260,quality=95/https://dpwjbsxqtam5n.cloudfront.net/app/download-on-app-store-button.png"></a>
                    <a class="inline-block" href="https://play.google.com/store/apps/details?id=com.drumeo" target="_blank">
                        <img class="h-10 m-1" src="https://www.musora.com/musora-cdn/image/width=260,quality=95/https://dpwjbsxqtam5n.cloudfront.net/app/google-play-button.png"></a>
                </div>
            </div>
        </div>
    </section>
    <section class="text-center px-5 sm:px-6 py-10 sm:py-14 lg:py-20">
        <div class="container max-w-4xl mx-auto">
            <h3 class="mb-4 sm:mb-10"><strong>Still have questions?</strong></h3>
            @include('_partials.components.question-dropdown', [
            'num' => '?',
            "title" => "What happens to my progress inside the new platform?",
            "desc" => "Any progress you’ve made so far within our learning platforms will be saved and migrated to Musora. Your current Method level, your XP, your account information, everything will follow you!",
            ])
            @include('_partials.components.question-dropdown', [
            'num' => '?',
            "title" => "Which mobile app should I use?",
            "desc" => "We’ve launched a brand new Musora mobile app with improved functionality and added features with access to all four brands. The Drumeo and Pianote mobile apps will remain accessible, but will not be updated with new content and features. Download the new app here:
            <a href='https://play.google.com/store/apps/details?id=com.drumeo' target='_blank'><u>GOOGLE PLAY</u></a> / <a href='https://apps.apple.com/us/app/musora-the-music-lessons-app/id1460388277?ls=1' target='_blank'><u>APPLE STORE</u></a>",
            ])
            @include('_partials.components.question-dropdown', [
            'num' => '?',
            "title" => "What is the price for Musora?",
            "desc" => "Good news! To thank you for supporting our business, we’re grandfathering in all existing membership prices. New students will pay a higher premium to become a part of Musora.",
            ])
            @include('_partials.components.question-dropdown', [
            'num' => '?',
            "title" => "What if I currently pay for two memberships?",
            "desc" => "Moving forward, you’ll only pay for the first membership you signed up for. For example, if you signed up for Pianote, then joined Singeo, your recurring annual membership will only be billed for Pianote, while giving you access to the three other platforms for free.",
            ])
            @include('_partials.components.question-dropdown', [
            'num' => '?',
            "title" => "What changes have been made to this new platform to improve functionality?",
            "desc" => "By combining our four member’s areas into one unified platform, we’re able to make changes and update features faster than ever. With this product update we’re launching the following features:
            A unified mobile app for easy brand switching;
            Updated navigation;
            Faster load times;
            Dark mode.",
            ])
            @include('_partials.components.question-dropdown', [
            'num' => '?',
            "title" => "Do you have a multi-user plan that I can share with my family, friends, or bandmates?",
            "desc" => "While we don’t have multi-user accounts built out (we’re working on it!), feel free to share your account with others! Our goal is to create more musicians around the world, and you can help us!",
            ])
        </div>
    </section>

    @include('_partials.components.video-modal',[
        'name' => 'trailer',
        'video' => '759635284',
        'vimeo' => true,
    ])
@stop
