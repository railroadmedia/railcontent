@extends('pianote.lead-gen.lead-gen-layout-tw',[ 'appTailwind' => true, ])

@section('meta')
    @parent
    <title>Getting Started On The Piano | Pianote</title>
    <meta name="description" content="Go from absolute beginner to playing your first song in four easy lessons!">

    <meta property="og:image" content="https://d2vyvo0tyx8ig5.cloudfront.net/lead-gen/getting-started-2022/share-image.jpg" style="display: none;">
    <meta property="og:title" content="Getting Started On The Piano">
    <meta property="og:description" content="Go from absolute beginner to playing your first song in four easy lessons!">
    <meta property="og:url" content="https://www.pianote.com/getting-started">
@endsection

@section('head')
    @parent
    <style>
        .join.smaller {
            font-size:18px;
            padding:16px 25px;
        }

        input {
            color:#8D8D8D !important;
            font-size:16px !important;
        }

        @media (min-width:426px) {
            header {
                background-size:400px;
            }
        }

        @media (min-width:768px) {

            .join.smaller {
                padding:16px 30px;
            }
        }
    </style>
@endsection

@section('page-body')
    <header class="px-5 sm:px-6 py-10 sm:py-14 lg:py-20" style="background:#eff7ff;">
        <div class="container max-w-4xl mx-auto">
            <div class="flex flex-wrap sm:flex-nowrap items-center">
                <div class="w-full sm:w-7/12 text-center lg:text-left">
                    <img class="h-14 sm:h-18 lg:h-20 mb-1 sm:mb-0 lg:mb-3" src="https://www.musora.com/musora-cdn/image/width=440,quality=85/https://d2vyvo0tyx8ig5.cloudfront.net/lead-gen/getting-started/2023/GSOTP-red-dark.svg" alt="logo" fetchpriority="high">
                    <h2 class="leading-tight"><strong class="font-black">Start learning piano </strong><br>
                        the easy and fun way.</h2>

                    <h6 class="leading-tight mt-4 lg:mt-6 mb-4 sm:mb-2"><strong>Sign up for 5 FREE play-along lessons</strong></h6>

                    <div class="mt-6 mb-5 rounded-xl overflow-hidden relative block sm:hidden bg-cover bg-top cursor-hover autoplay-video" style="padding-bottom: 75%;" data-open="trailer">
                        <img class="absolute inset-0" src="https://www.musora.com/musora-cdn/image/width=850,quality=85/https://d2vyvo0tyx8ig5.cloudfront.net/lead-gen/getting-started/2023/header-thumb.png" alt="header image" fetchpriority="high" />
                    </div>

                    <p class="hidden lg:inline">
                        <i class="fas fa-check text-pianote"></i> Learn by doing
                        <i class="ml-2 fas fa-check text-pianote"></i> No theory required
                        <i class="ml-2 fas fa-check text-pianote"></i> Free lifetime access
                    </p>
                    <div class="flex inline lg:hidden">
                        <p class="w-1/3 leading-tight"><i class="fas fa-check-circle text-pianote"></i><br> Learn  <br> by doing</p>
                        <p class="w-1/3 leading-tight"><i class="fas fa-check-circle text-pianote"></i><br> No theory <br> required</p>
                        <p class="w-1/3 leading-tight"><i class="fas fa-check-circle text-pianote"></i><br> Free lifetime <br>access</p>
                    </div>

                    <div class="mt-6 sm:mt-5 lg:mt-10">
                            @include('pianote._partials.sign-up-form', [
                            "recaptchaKey" => $recaptchaKey,
                            "formId" => "Pianote - Engagement - Trigger - GSOTP - Web Form",
                            "formName" => 'Getting Started On The Piano',
                                "buttonText" => "Get started for free",
                                'stacked' => true,
                                'inputBorder' => '1px solid #7A8491',
                            "redirectURL" => "/getting-started/thank-you/",
                            "minimalForm" => true
                            ])
                    </div>
                </div>
                <div class="w-full sm:w-5/12 hidden sm:block">
                    <div class="rounded-xl aspect-1:1 overflow-hidden relative bg-cover bg-center cursor-hover autoplay-video" data-open="trailer">
                        <img class="absolute inset-0" src="https://www.musora.com/musora-cdn/image/width=850,quality=85/https://d2vyvo0tyx8ig5.cloudfront.net/lead-gen/getting-started/2023/header-thumb.png" alt="header image" fetchpriority="high" />
                    </div>
                </div>
            </div>
        </div>
    </header>
    <div style="background:#eff7ff;">

    <div class="container max-w-4xl mx-auto -mb-10 -mt-10">
        <div class="px-5 sm:px-0">
            <div class="flex flex-wrap sm:flex-nowrap text-center shadow-lg rounded-xl relative" style="background:linear-gradient(to bottom, #fff, #F1F7FE);">
                <div class="z-10 flex flex-wrap sm:flex-nowrap items-start justify-evenly w-full sm:w-auto sm:flex-grow py-4 sm:py-3 lg:py-6 lg:px-5 text-left sm:text-center">
                    <div class="flex sm:block w-full sm:w-auto px-4 sm:px-3 mb-4 sm:mb-0">
                        <i class="far fa-fw mr-3 sm:mr-0 fa-calendar-day text-pianote text-2xl"></i>
                        <p class="leading-tight mx-0"><strong class="font-black">Course Dates</strong><br>
                            <span class="text-sm">Start anytime!</span></p>
                    </div>
                    <div class="flex sm:block w-full sm:w-auto px-4 sm:px-3 mb-4 sm:mb-0">
                        <i class="far fa-fw mr-3 sm:mr-0 fa-clock text-pianote text-2xl"></i>
                        <p class="leading-tight mx-0"><strong class="font-black">Commitment</strong><br>
                            <span class="text-sm">10 minutes a day for just 5 days.</span></p>
                    </div>
                    <div class="flex sm:block w-full sm:w-auto px-4 sm:px-3 mb-4 sm:mb-0">
                        <i class="far fa-fw mr-3 sm:mr-0 fa-piano-keyboard text-pianote text-2xl"></i>
                        <p class="leading-tight mx-0"><strong class="font-black">Skill Level</strong><br>
                            <span class="text-sm">Beginner.</span></p>
                    </div>
                    <div class="flex sm:block w-full sm:w-auto px-4 sm:px-3">
                        <i class="far fa-fw mr-3 sm:mr-0 fa-trophy text-pianote text-2xl"></i>
                        <p class="leading-tight mx-0"><strong class="font-black">Result</strong><br>
                            <span class="text-sm">Play your first song.</span></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
    <section class="text-center pt-6 sm:pt-10 lg:pt-20 bg-cover bg-center" style="background:linear-gradient(to bottom, #EEECEA, #fff);">
        <h3 class="leading-tight px-4"><strong>Your first week of piano lessons - FREE</strong></h3>
        <p class="leading-normal mt-2 sm:mt-3 mb-5 sm:mb-7 px-4">
            Starting is the hardest part. And you should know the piano is right for you before paying for lessons.<br>
            <span class="text-pianote"><strong>Try a snippet from your 1st lesson and see if playing the piano is right for you.</strong></span>
        </p>
        <div class="relative cursor-pointer autoplay-video" data-open="demoVid">
            <img class="inline-block sm:hidden w-full transition-all opacity-0" src="https://www.musora.com/musora-cdn/image/width=1500,quality=85/https://d2vyvo0tyx8ig5.cloudfront.net/lead-gen/chord-hacks/2023/tablet-piano-m.png" alt="tablet piano" loading="lazy" onload="this.classList.remove('opacity-0')">
            <img class="hidden sm:inline-block w-full transition-all opacity-0" src="https://www.musora.com/musora-cdn/image/width=1500,quality=85/https://d2vyvo0tyx8ig5.cloudfront.net/lead-gen/chord-hacks/2023/tablet-piano.png" alt="tablet piano" loading="lazy" onload="this.classList.remove('opacity-0')">
        </div>

        <div class="container max-w-4xl mx-auto">
            <p class=" mb-5 sm:mb-8" style="color:#abb5c2">SEE MORE LESSONS</p>
            <div class="flex flex-wrap items-start justify-center text-left">
                <div class="flex flex-wrap items-start w-full sm:w-1/2 pb-4 sm:pb-0 sm:px-3 mb-4 sm:mb-8 border-b sm:border-b-0">
                    <picture class="w-1/3 sm:w-full">
                        <source media="(min-width:640px)" srcset="https://www.musora.com/musora-cdn/image/width=640,quality=85/https://d2vyvo0tyx8ig5.cloudfront.net/lead-gen/chord-hacks/2023/left-hand-thumb.jpg">
                        <img
                            class=" rounded-xl mb-3 transition-opacity opacity-0"
                            src="https://www.musora.com/musora-cdn/image/width=200,quality=85/https://d2vyvo0tyx8ig5.cloudfront.net/lead-gen/chord-hacks/2023/left-hand-thumb.jpg"
                            alt="grid"
                            loading="lazy"
                            onload="this.classList.remove('opacity-0')"
                        >
                    </picture>
                    <p class="w-2/3 sm:w-full pl-3 sm:pl-0 leading-normal">Now it’s time to work on that left hand. This can be a sticking point for a lot of piano players, but don’t worry - just do what Lisa does!</p>
                </div>
                <div class="flex flex-wrap items-start w-full sm:w-1/2 pb-4 sm:pb-0 sm:px-3 mb-4 sm:mb-8 border-b sm:border-b-0">
                    <picture class="w-1/3 sm:w-full">
                        <source media="(min-width:640px)" srcset="https://www.musora.com/musora-cdn/image/width=640,quality=85/https://d2vyvo0tyx8ig5.cloudfront.net/lead-gen/chord-hacks/2023/playing-hands-together-thumb.jpg">
                        <img
                            class=" rounded-xl mb-3 transition-opacity opacity-0"
                            src="https://www.musora.com/musora-cdn/image/width=200,quality=85/https://d2vyvo0tyx8ig5.cloudfront.net/lead-gen/chord-hacks/2023/playing-hands-together-thumb.jpg"
                            alt="grid"
                            loading="lazy"
                            onload="this.classList.remove('opacity-0')"
                        >
                    </picture>
                    <p class="w-2/3 sm:w-full pl-3 sm:pl-0 leading-normal">You have two hands. Use them! You’ll be playing beautiful music with both hands in this 10-minute lesson. Just hit play and follow along.</p>
                </div>
                <div class="flex flex-wrap items-start w-full sm:w-1/2 pb-4 sm:pb-0 sm:px-3 mb-4 sm:mb-8 border-b sm:border-b-0">
                    <picture class="w-1/3 sm:w-full">
                        <source media="(min-width:640px)" srcset="https://www.musora.com/musora-cdn/image/width=640,quality=85/https://d2vyvo0tyx8ig5.cloudfront.net/lead-gen/chord-hacks/2023/chord-fills-thumb.jpg">
                        <img
                            class=" rounded-xl mb-3 transition-opacity opacity-0"
                            src="https://www.musora.com/musora-cdn/image/width=200,quality=85/https://d2vyvo0tyx8ig5.cloudfront.net/lead-gen/chord-hacks/2023/chord-fills-thumb.jpg"
                            alt="grid"
                            loading="lazy"
                            onload="this.classList.remove('opacity-0')"
                        >
                    </picture>
                    <p class="w-2/3 sm:w-full pl-3 sm:pl-0 leading-normal">How do you make your chords sounds extra special? Add some fills! They sound complicated but are easy to do. You’ll learn Lisa’s favorite.</p>
                </div>
                <div class="flex flex-wrap items-start w-full sm:w-1/2 pb-4 sm:pb-0 sm:px-3 mb-4 sm:mb-8 border-b sm:border-b-0">
                    <picture class="w-1/3 sm:w-full">
                        <source media="(min-width:640px)" srcset="https://www.musora.com/musora-cdn/image/width=640,quality=85/https://d2vyvo0tyx8ig5.cloudfront.net/lead-gen/chord-hacks/2023/chord-inversions-thumb.jpg">
                        <img
                            class=" rounded-xl mb-3 transition-opacity opacity-0"
                            src="https://www.musora.com/musora-cdn/image/width=200,quality=85/https://d2vyvo0tyx8ig5.cloudfront.net/lead-gen/chord-hacks/2023/chord-inversions-thumb.jpg"
                            alt="grid"
                            loading="lazy"
                            onload="this.classList.remove('opacity-0')"
                        >
                    </picture>
                    <p class="w-2/3 sm:w-full pl-3 sm:pl-0 leading-normal">This might be the most important piano lesson you have. It will change how you think about and see piano chords. Are you ready?! (Of course you are!)</p>
                </div>
            </div>
        </div>
    </section>

    <section class="text-center px-5 sm:px-6 py-10 sm:py-14 lg:py-20" style="background-color:#EFEDEB;">
        <div class="container max-w-5xl mx-auto">
            <img class="h-56 inline sm:hidden transition-all opacity-0 mb-5" src="https://www.musora.com/musora-cdn/image/width=690,quality=85/https://d2vyvo0tyx8ig5.cloudfront.net/lead-gen/chord-hacks/2023/dont-practice-play.png" alt="collage intro" loading="lazy" onload="this.classList.remove('opacity-0')">
            <div class="text-left flex flex-wrap sm:flex-nowrap items-center">
                <div class=" max-w-lg sm:pr-7">
                    <h2 class="mb-3 sm:mb-7"><strong>Don’t practice -- PLAY!</strong></h2>
                    <p class="leading-normal">So you just had your first piano lesson. Congratulations! Now…
                        <br><br>
                        You’re on your own.<br><br>
                        That’s the problem with traditional lessons. You see a teacher once a week and then it’s up to YOU to practice the right things, for enough time. That’s a lot to ask for a beginner.<br><br>
                        <strong>So we fixed it.</strong><br><br>
                        With Getting Started On The Piano, you’ll never have to practice, because your lessons ARE the practice! Simply press play and follow along with Lisa as you learn to play this beautiful instrument.</p>
                </div>
                <img class="h-56 lg:h-80 hidden sm:inline transition-all opacity-0" src="https://www.musora.com/musora-cdn/image/width=690,quality=85/https://d2vyvo0tyx8ig5.cloudfront.net/lead-gen/chord-hacks/2023/dont-practice-play.png" alt="collage intro" loading="lazy" onload="this.classList.remove('opacity-0')">
            </div>
        </div>
    </section>
    <section class="py-8 md:py-16 lg:py-20 relative" style="background:linear-gradient(to bottom,#01050F, #02142a);">
        <div class="container mx-auto relative z-20">
            <div class="flex flex-wrap max-w-6xl mx-auto px-2 lg:px-3">
                <div class="px-3 md:px-4 w-full md:w-5/12 lg:w-5/12">
                    <h4 class="mb-3 text-white">
                        <strong>Is this really free?</strong>
                    </h4>
                    <p style="color:#ABB5C2;">
                        Yes! We love sharing videos to help piano players -- and deep down we hope you’ll see some of the value that we provide inside Pianote juuuuust in case you ever want to consider joining!
                    </p>
                </div>
                <div class="px-3 md:px-4 w-full md:w-7/12 lg:w-7/12">
                    <h4 class="mt-7 md:mt-0 mb-3 text-white">
                        <strong>Why do I need to give my email address?</strong>
                    </h4>
                    <p style="color:#ABB5C2;">
                        Secretly, we’re hoping to start a relationship with you. This is our way of saying “Hey we create awesome piano lessons, can we show you?” Don’t worry, we won’t send you spam or share your email address with anybody else. You’ll get exactly what’s promised on this page along with ongoing piano videos, free lessons, and some special offers. And if you don’t like our emails, you can unsubscribe at any time.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <div id="final" class="anchor"></div>
    <section class="text-center customize px-4 lg:px-6 relative z-50 overflow-hidden py-20" style="background:#EFF7FF;">
        <div class="max-w-5xl mx-auto flex flex-wrap flex-col md:flex-row md:items-center">
            <div class="max-w-lg mx-auto text-center sm:text-left w-full md:w-1/2 sm:pl-5">
                <picture>
                    <source media="(min-width:768px)" srcset="https://www.musora.com/musora-cdn/image/width=500,quality=85/https://d2vyvo0tyx8ig5.cloudfront.net/lead-gen/getting-started/2023/GSOTP-red-dark.svg">
                    <img class="h-16 lazyload" data-src="https://www.musora.com/musora-cdn/image/width=740,quality=85/https://d2vyvo0tyx8ig5.cloudfront.net/lead-gen/getting-started/2023/GSOTP-red-dark.svg" alt="logo">
                </picture>
                <h3 class="pt-4 md:pt-5 leading-7 md:leading-9 font-extrabold mb-6">
                    <strong>5 days of piano lessons</strong> to show you how easy and fun learning the piano can be.
                </h3>
                <p class="text-left mb-4 sm:mb-5 mx-auto inline-block sm:leading-loose">
                    <i class="fas fa-check sm:mr-2 text-xl" style="color:#FF0000;"></i> FREE Lifetime Access<br>
                    <i class="fas fa-check sm:mr-2 text-xl" style="color:#FF0000;"></i> Play-along with a REAL teacher<br>
                    <i class="fas fa-check sm:mr-2 text-xl" style="color:#FF0000;"></i> No music theory knowledge required<br>
                </p>
                <div class="max-w-md md:max-w-auto lg:w-96 mx-auto md:mx-0">
                    @include('pianote._partials.sign-up-form', [
                    "recaptchaKey" => $recaptchaKey,
                    "formId" => "Pianote - Engagement - Trigger - GSOTP - Web Form",
                    "formName" => 'Getting Started On The Piano',
                        "buttonText" => "Get started for free",
                        'stacked' => true,
                        'inputBorder' => '1px solid #7A8491',
                        'disclaimerColor' => 'rgba(208, 226, 231, 0.8)',
                    "redirectURL" => "/getting-started/thank-you/"
                    ])
                </div>
            </div>
            <div class="flex justify-center md:justify-start w-full md:w-1/2 sm:order-1 md:pl-6 mt-7 md:mt-0 relative">
                <img class="max-w-2xl md:max-w-md lg:max-w-2xl lazyload" data-src="https://www.musora.com/musora-cdn/image/width=800,quality=85/https://d2vyvo0tyx8ig5.cloudfront.net/lead-gen/getting-started/2023/collage.png" alt="collage">
            </div>
        </div>
    </section>
@stop

@section('scripts')
    @parent
    <script>
        $(document).ready(function () {
            $(document).foundation();
        });
    </script>
    <script type="text/javascript" src="{{ asset('/marketing/js/modal.js') }}"></script>
    <script type="text/javascript" src="{{ asset('/marketing/js/modal-autoplay.js') }}"></script>
@endsection
