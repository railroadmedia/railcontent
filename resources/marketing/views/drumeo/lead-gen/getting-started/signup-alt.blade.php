@extends('drumeo._partials.global-layout')

@section('global-head')
    <title>Getting Started On The Drums | Drumeo</title>
    <meta property="og:title" content="Getting Started On The Drums | Drumeo">

    <meta name="description" content="Just starting out on the drums? Want to rebuild your foundation? Try Jared Falk's free video series!">
    <meta property="og:description" content="Just starting out on the drums? Want to rebuild your foundation? Try Jared Falk's free video series!">

    <meta property="og:image" content="https://dpwjbsxqtam5n.cloudfront.net/lead-gen/gsotd/og-image.jpg" style="display: none;">
    <meta property="og:url" content="https://www.drumeo.com/getting-started/">

    @include('_partials.layout._fonts')

    @include('_partials.layout._tailwindcdn')
    <link href="{{ asset('/marketing/css/tailwind-helpers.css') }}" rel="stylesheet">
    <link href="{{ asset('/marketing/parcel/drumeo/navigation-sales.css') }}" rel="stylesheet">
    <link href="{{ asset('/marketing/parcel/drumeo/lead-gen-tw.css') }}" rel="stylesheet">

    <style>
        header {
            background-image: url('https://www.musora.com/musora-cdn/image/width=800,quality=85/https://dpwjbsxqtam5n.cloudfront.net/lead-gen/getting-started/header_bg_m.jpg');
            background-size: cover;
        }

        header h2 {
            margin-top: 330px;
        }

        h3 {
            font-size: 21px;
        }

        .join.smaller {
            font-size: 18px;
            padding: 16px 25px;
        }

        input {
            color: #8D8D8D !important;
            font-size: 16px !important;
        }

        button {
            letter-spacing: 1.5px !important;
        }

        @media (min-width: 426px){
            header {
                background-size: 400px;
            }
        }

        @media (min-width: 768px){
            header {
                background-image: url('https://www.musora.com/musora-cdn/image/width=2500,quality=85/https://dpwjbsxqtam5n.cloudfront.net/lead-gen/getting-started/header.jpg');
                background-size: cover;
            }

            header h2 {
                margin-top: 0px;
            }

            h3 {
                font-size:24px;
            }

            .join.smaller {
                padding: 16px 30px;
            }

            input {
                font-size: 18px !important;
            }
        }

        @media (min-width: 1024px) {
            h3 {
                font-size: 30px;
            }

            input {
                font-size: 20px !important;
            }
        }
    </style>
@stop


@section('global-body')
    @include("drumeo.sales.partials._nav")
    <header class="py-6 md:py-24 bg-center md:bg-top bg-no-repeat" style="background-color:#021536;">
        <div class="max-w-4xl mx-auto px-2 md:px-4 lg:px-0">
            <div class="max-w-lg mx-auto md:mx-0 text-center md:text-left">
                <div class="px-1">
                    <picture>
                        <source media="(min-width:768px)" srcset="https://www.musora.com/musora-cdn/image/width=740,quality=85/https://dpwjbsxqtam5n.cloudfront.net/lead-gen/getting-started/logo_left_white.png">
                        <img class="h-14 mb-2 md:mb-6 lazyload" data-src="https://www.musora.com/musora-cdn/image/width=740,quality=85/https://dpwjbsxqtam5n.cloudfront.net/lead-gen/getting-started/logo_centre_white.png" alt="logo white">
                    </picture>
                    <h2 class="font-extrabold leading-tight text-white">
                        Go from a total beginner to playing your first drum beats in this FREE series.
                    </h2>
                    <h6 class="my-4" style="color: rgba(208, 226, 231, 0.8);">
                        Enter your email below for your 10 free lessons.
                    </h6>
                </div>
                <div class="md:pr-20">
                    @include("drumeo.lead-gen.partials.sign-up-form-tw", [
                        "formId" => "Drumeo - Engagement - Trigger - GSOTD - Web Form",
                        "formName" => 'Getting Started On The Drums',
                        "buttonText" => "Get started",
                        'stacked' => true,
                        'inputBorder' => '1px solid #7A8491',
                        'disclaimerColor' => 'rgba(208, 226, 231, 0.8)',
                    "redirectURL" => "/getting-started/thank-you/"
                    ])
                </div>
            </div>
        </div>
    </header>

    <section class="px-4 sm:px-6 lg:px-6 py-10 lg:py-20 relative overflow-hidden">
        <div class="max-w-5xl mx-auto">
                <div class="flex flex-wrap flex-col md:flex-row md:items-center">
                    <div class="md:w-1/2 max-w-lg mx-auto md:max-w-auto">
                        <h3 class="font-extrabold md:mt-10 leading-tight">
                            Set yourself up for <br class="md:hidden">success <br class="hidden md:inline-block">behind the kit.
                        </h3>
                        <p class="uppercase my-4 lg:my-6 text-xs tracking-widest" style="color: #ABB5C2;">
                            course overview
                        </p>
                        <p class="mb-8 lg:mb-10">
                            Getting started on the drums doesn’t need to be scary. In this free series, you’ll get everything you need to set up your kit perfectly for YOU, understand basic drum notation so you can read exercises, and start playing your first beats & fills.
                        </p>
                        <div class="flex flex-wrap mb-10 text-left">
                            <div class="w-1/2 mb-6 pl-2 md:pl-4" style="border-left:3px solid #3474D4;">
                                <p class="uppercase text-xs tracking-widest" style="color: #ABB5C2;">date</p>
                                    <span class="md:text-sm lg:text-base">Start anytime.</span>
                            </div>
                            <div class="w-1/2 pl-4">
                                <div class="mb-6 pl-2 md:pl-4" style="border-left:3px solid #3474D4;">
                                    <p class="uppercase text-xs tracking-widest" style="color: #ABB5C2;">skill level</p>
                                    <span class="md:text-sm lg:text-base">For beginners.</span>
                                </div>
                            </div>
                            <div class="w-1/2 pl-2 md:pl-4 mb-6 md:mb-0" style="border-left:3px solid #3474D4;">
                                <p class="uppercase text-xs tracking-widest" style="color: #ABB5C2;">cost</p>
                                <span class="md:text-sm lg:text-base">Lifetime access for free!</span>
                            </div>
                            <div class="w-1/2 pl-4">
                                <div class="pl-2 md:pl-4" style="border-left:3px solid #3474D4;">
                                    <p class="uppercase text-xs tracking-widest" style="color: #ABB5C2;">result</p>
                                    <span class="md:text-sm lg:text-base">Play your first song.</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="flex justify-center md:justify-start w-full md:w-1/2 sm:order-1 md:pl-6 mt-7 sm:mt-0 relative">
                        <img class="max-w-2xl md:max-w-md lg:max-w-2xl lazyload" data-src="https://www.musora.com/musora-cdn/image/width=1300,quality=85/https://dpwjbsxqtam5n.cloudfront.net/lead-gen/getting-started/collage.png" alt="collage">
                    </div>
                </div>
            </div>
    </section>

    <section class="py-10 lg:py-20 px-2">
        <div class="max-w-lg sm:max-w-4xl lg:max-w-6xl mx-auto">
            <p class="text-center uppercase mb-4 text-xs tracking-widest" style="color: #ABB5C2;">
                What you'll get
            </p>
            <h3 class="text-center leading-tight font-extrabold mb-10 px-2 sm:px-4 lg:px-0">
                10 videos so you can learn proper drum set technique, <br class="hidden sm:inline">how to read music, and more in this FREE series.
            </h3>
            <div class="flex flex-wrap mb-14">
                <div class="w-full sm:w-1/2 lg:w-1/3 px-4 sm:px-2 mb-6">
                    <div class="relative mb-2 cursor-pointer hover:opacity-90 transition-opacity" data-open="signUpModal">
                        <img class="relative z-0 rounded-lg lazyload" data-src="https://www.musora.com/musora-cdn/image/width=740,quality=85/https://dpwjbsxqtam5n.cloudfront.net/lead-gen/getting-started/lesson1_thumb.jpg" alt="thumb1">
                        <i class="absolute top-1/2 left-1/2 fas fa-play play-button text-white" style="margin: -39px;"></i>
                    </div>
                    <p>
                        Positioning your drums in the right places is super important. Jared shows you where to place every drum for maximum efficiency in this first video.
                    </p>
                </div>
                <div class="w-full sm:w-1/2 lg:w-1/3 px-4 sm:px-2 mb-6">
                    <img class="rounded-lg mb-2 lazyload" data-src="https://www.musora.com/musora-cdn/image/width=740,quality=85/https://dpwjbsxqtam5n.cloudfront.net/lead-gen/getting-started/lesson2_thumb.jpg" alt="thumb2">
                    <p>
                        Tuning your drums doesn’t need to be frustrating. Follow Jared’s simple guide to getting great sounds out of your kit with the turn of a key.
                    </p>
                </div>
                <div class="w-full sm:w-1/2 lg:w-1/3 px-4 sm:px-2 mb-6">
                    <img class="rounded-lg mb-2 lazyload" data-src="https://www.musora.com/musora-cdn/image/width=740,quality=85/https://dpwjbsxqtam5n.cloudfront.net/lead-gen/getting-started/lesson3_thumb.jpg" alt="thumb3">
                    <p>
                        Yep, there’s a right and wrong way. Jared covers the 3 main grips in drumming and how you can get the most out of every stroke without risking injuries.
                    </p>
                </div>
                <div class="w-full sm:w-1/2 lg:w-1/3 px-4 sm:px-2 mb-6 sm:mb-0">
                    <img class="rounded-lg mb-2 lazyload" data-src="https://www.musora.com/musora-cdn/image/width=740,quality=85/https://dpwjbsxqtam5n.cloudfront.net/lead-gen/getting-started/lesson4_thumb.jpg" alt="thumb4">
                    <p>
                        Reading drum music is surprisingly simple. Jared shows you this vital skill so you can take your drumming ANYWHERE.
                    </p>
                </div>
                <div class="w-full sm:w-1/2 lg:w-1/3 px-4 sm:px-2 mb-6 sm:mb-0">
                    <img class="rounded-lg mb-2 lazyload" data-src="https://www.musora.com/musora-cdn/image/width=740,quality=85/https://dpwjbsxqtam5n.cloudfront.net/lead-gen/getting-started/lesson6_thumb.jpg" alt="thumb6">
                    <p>
                        And just like that, you’re playing full beats. Jared shows you some of the most popular drum beats -- you’re almost ready to play along with real music!
                    </p>
                </div>
                <div class="w-full sm:w-1/2 lg:w-1/3 px-4 sm:px-2 mb-6 sm:mb-0">
                    <img class="rounded-lg mb-2 lazyload" data-src="https://www.musora.com/musora-cdn/image/width=740,quality=85/https://dpwjbsxqtam5n.cloudfront.net/lead-gen/getting-started/lesson7_thumb.jpg" alt="thumb7">
                    <p>
                        Drum fills are your moment to shine. You’ll learn how to move around the kit musically with these fun & effective transitions.
                    </p>
                </div>
            </div>
            <h5 class="font-extrabold text-center italic">
                You’ll get 10 FREE lessons in total.
            </h5>
        </div>
    </section>

    <section class="pt-32 pb-20 relative" style="background: #F2F8FB;">
        <div class="h-10 absolute left-0 right-0" style="background: linear-gradient(to top left, #F2F8FB calc(50% - 1px), #F2F8FB, #fff calc(50% + 1px)); top: -1px;"></div>
        <div class="px-10 text-center">
            <h3 class="font-extrabold text-center mb-10">
                The easiest way to get started on the drums.
            </h3>
            <div class="max-w-sm md:max-w-5xl mx-auto flex flex-col md:flex-row md:gap-8 mb-8">
                <div class="text-center flex-1 mb-8">
                    <img class="h-16 lazyload" data-src="https://dpwjbsxqtam5n.cloudfront.net/lead-gen/getting-started/guided_icon.svg" alt="guided icon">
                    <h5 class="font-extrabold my-4">
                        Guided Lessons
                    </h5>
                    <p>
                        You’ll know exactly what to play and practice to get the best start on the drums.
                    </p>
                </div>
                <div class="text-center flex-1 mb-8">
                    <img class="h-16 lazyload" data-src="https://dpwjbsxqtam5n.cloudfront.net/lead-gen/getting-started/learn_icon.svg" alt="learn icon">
                    <h5 class="font-extrabold my-4">
                        Free Sheet Music
                    </h5>
                    <p>
                        Get downloadable sheet music & resources for all of the lessons.
                    </p>
                </div>
                <div class="text-center flex-1">
                    <img class="h-16 lazyload" data-src="https://dpwjbsxqtam5n.cloudfront.net/lead-gen/getting-started/sheet_icon.svg" alt="sheet icon">
                    <h5 class="font-extrabold my-4">
                        Learn Anytime
                    </h5>
                    <p>
                        The online structure allows you to learn and progress at your own pace.
                    </p>
                </div>
            </div>
            <a class="join blue smaller anchor-slide" href="#final">I’m READY TO START MY DRUMMING JOURNEY!</a>
        </div>
    </section>

    <section class="py-20" style="background:#01050F;">
        <div class="max-w-sm md:max-w-4xl mx-auto px-4 sm:px-0 text-white lg:gap-10 relative flex flex-col md:flex-row lg:block items-center justify-center text-right">
            <picture>
                <source media="(min-width:768px)" srcset="https://www.musora.com/musora-cdn/image/width=740,quality=85/https://dpwjbsxqtam5n.cloudfront.net/lead-gen/getting-started/profile_pic.jpg">
                <img class="rounded-lg lg:absolute lg:left-10 lg:top-0 h-72 md:h-96 lg:h-full mb-10 md:mb-0 lazyload" data-src="https://www.musora.com/musora-cdn/image/width=300,quality=85/https://dpwjbsxqtam5n.cloudfront.net/lead-gen/getting-started/profile_pic_square.jpg" alt="jared profile">
            </picture>

            <div class="max-w-md inline-block text-left md:pl-8 lg:pl-0">
                <p class="uppercase mb-2 tracking-widest" style="color: #ABB5C2;">
                    Meet your teacher
                </p>
                <h1 class="font-extrabold mb-6">
                    Jared Falk
                </h1>
                <div class="font-bold text-white mb-8">
                    <img class="h-6 mr-2 lazyload" data-src="https://dpwjbsxqtam5n.cloudfront.net/lead-gen/getting-started/youtube_icon.svg" alt="youtube icon">
                    2M Subscribers
                    <img class="h-6 ml-6 mr-2 lazyload" data-src="https://dpwjbsxqtam5n.cloudfront.net/lead-gen/getting-started/youtube_icon.svg" alt="youtube icon">
                    24M Views
                </div>
                <p>
                    Jared Falk has been a trusted source for online drum lessons for 15+ years.<br><br>

                    As the face of Drumeo, Jared is a pioneer of online drum instruction -- helping prospective drummers around the world learn their first beats and beyond.<br><br>

                    His passion, grit, and approachable style have helped him become the most-watched drum instructor online… ever! And now you can take in his first-ever full curriculum for beginner drummers anytime and anywhere it fits your schedule.<br><br>
                </p>
            </div>
        </div>
    </section>

    <section class="pb-20" style="background:#01050F;">
        <div class="max-w-5xl mx-auto text-center text-white px-4">
            <p class="uppercase tracking-widest" style="color: #ABB5C2;">
                Jared has helped thousands of students reach their goals
            </p>
            <h3 class="font-extrabold leading-7 md:leading-9 my-6">
                Read what drummers are saying about Drumeo, <br class="hidden md:inline-block">Jared & his approach to drumming education.
            </h3>
            <div class="flex flex-wrap max-w-md mx-auto sm:max-w-full">
                <div class="w-full sm:w-1/2 lg:w-1/4 flex flex-auto px-2 mb-8 md:mb-4 lg:mb-0">
                    <div class="rounded-xl overflow-hidden w-full" style="background: #051124;">
                        <div class="aspect-16:9 relative bg-center bg-cover py-10 lazyload" data-bg="https://www.musora.com/musora-cdn/image/width=740,quality=85/https://dpwjbsxqtam5n.cloudfront.net/lead-gen/getting-started/billy.jpg">
                        </div>
                        <div class="p-4">
                            <p class="italic mb-4">
                                “...a good place to study and realize one’s dreams.”
                            </p>
                            <p class="uppercase font-bebas tracking-wider leading-5 mb-4">
                                <span class="text-drumeo">Billy Cobham</span><br>
                                <span class="text-sm" style="color:#ABB5C2;">Legendary Jazz Fusion Drummer</span>
                            </p>
                            <p class="italic underline text-xs cursor-pointer" style="color:#ABB5C2;" data-open="BillyCobham">
                                Read more
                            </p>
                        </div>
                    </div>
                </div>
                <div class="w-full sm:w-1/2 lg:w-1/4 flex flex-auto px-2 mb-8 md:mb-4 lg:mb-0">
                    <div class="rounded-xl overflow-hidden w-full" style="background: #051124;">
                        <div class="aspect-16:9 relative bg-center bg-cover py-10 lazyload" data-bg="https://www.musora.com/musora-cdn/image/width=740,quality=85/https://dpwjbsxqtam5n.cloudfront.net/lead-gen/getting-started/david.jpg" >
                        </div>
                        <div class="p-4">
                            <p class="italic mb-4">
                                “THE place to go for the best in drum education.”
                            </p>
                            <p class="uppercase font-bebas tracking-wider leading-5 mb-4">
                                <span class="text-drumeo">David Garibaldi</span><br>
                                <span class="text-sm" style="color:#ABB5C2;">Drummer for tower of power</span>
                            </p>
                            <p class="italic underline text-xs cursor-pointer" style="color:#ABB5C2;" data-open="DavidGaribaldi">
                                Read more
                            </p>
                        </div>
                    </div>
                </div>
                <div class="w-full sm:w-1/2 lg:w-1/4 flex flex-auto px-2 mb-8 sm:mb-0">
                    <div class="rounded-xl overflow-hidden w-full" style="background: #051124;">
                        <div class="aspect-16:9 relative bg-center bg-cover py-10 lazyload" data-bg="https://www.musora.com/musora-cdn/image/width=740,quality=85/https://dpwjbsxqtam5n.cloudfront.net/lead-gen/getting-started/anika.jpg">
                        </div>
                        <div class="p-4">
                            <p class="italic mb-4">
                                “...a professional instructor who really knows how to teach.”
                            </p>
                            <p class="uppercase font-bebas tracking-wider leading-5 mb-4">
                                <span class="text-drumeo">Anika Nilles</span><br>
                                <span class="text-sm" style="color:#ABB5C2;">Drummer & Composer</span>
                            </p>
                            <p class="italic underline text-xs cursor-pointer" style="color:#ABB5C2;" data-open="AnikaNilles">
                                Read more
                            </p>
                        </div>
                    </div>
                </div>
                <div class="w-full sm:w-1/2 lg:w-1/4 flex flex-auto px-2">
                    <div class="rounded-xl overflow-hidden w-full" style="background: #051124;">
                        <div class="aspect-16:9 relative bg-center bg-cover py-10 lazyload" data-bg="https://www.musora.com/musora-cdn/image/width=740,quality=85/https://dpwjbsxqtam5n.cloudfront.net/lead-gen/getting-started/casey.jpg">
                        </div>
                        <div class="p-4">
                            <p class="italic mb-4">
                                “He cares about each and every drummer who will watch & learn from him.”
                            </p>
                            <p class="uppercase font-bebas tracking-wider leading-5 mb-4">
                                <span class="text-drumeo">Casey Cooper</span><br>
                                <span class="text-sm" style="color:#ABB5C2;">Youtube Drummer</span>
                            </p>
                            <p class="italic underline text-xs cursor-pointer" style="color:#ABB5C2;" data-open="CaseyCooper">
                                Read more
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="py-8 md:py-14 relative" style="background:#01050F;">
        <div class="container mx-auto relative z-20">
            <p class="text-center uppercase tracking-wide mb-14" style="color:#ABB5C2;">
                Frequently asked questions
            </p>
            <div class="flex flex-wrap max-w-6xl mx-auto px-2 lg:px-3">
                <div class="px-3 md:px-4 w-full md:w-5/12 lg:w-5/12">
                    <div class="mb-3 md:text-xl lg:text-2xl text-white">
                        <strong>Is this really free?</strong>
                    </div>
                    <p style="color:#ABB5C2;">
                        Yes! We love sharing videos to help drummers -- and deep down we hope you’ll see some of the value that we provide inside Drumeo juuuuust in case you ever want to consider joining!
                    </p>
                </div>
                <div class="px-3 md:px-4 w-full md:w-7/12 lg:w-7/12">
                    <div class="mt-7 md:mt-0 mb-3 md:text-xl lg:text-2xl text-white">
                        <strong>Why do I need to give my email address?</strong>
                    </div>
                    <p style="color:#ABB5C2;">
                        Secretly, we’re hoping to start a relationship with you. This is our way of saying “Hey we create awesome drum lessons, can we show you?” Don’t worry, we won’t send you spam or share your email address with anybody else. You’ll get exactly what’s promised on this page along with ongoing drum videos, free lessons, and some special offers. And if you don’t like our emails, you can unsubscribe at any time.
                    </p>
                </div>
            </div>
        </div>

        {{-- gradient --}}
        <div class="absolute bottom-0 -top-10 w-full z-10" style="background: linear-gradient(180deg, rgba(1, 5, 15, 0.5) 0%, rgba(3, 37, 70, 0.5) 100%);">

        </div>
    </section>
    <div id="final" class="anchor"></div>
    <section class="text-center customize px-4 lg:px-6 relative z-50 overflow-hidden text-white py-20" style="background:#01050F;">
        <div class="max-w-5xl mx-auto flex flex-wrap flex-col md:flex-row md:items-center">
            <div class="max-w-lg mx-auto text-center sm:text-left w-full md:w-1/2 sm:pl-5">
                <picture>
                    <source media="(min-width:768px)" srcset="https://www.musora.com/musora-cdn/image/width=500,quality=85/https://dpwjbsxqtam5n.cloudfront.net/lead-gen/getting-started/logo_left_white.png">
                    <img class="h-16 lazyload" data-src="https://www.musora.com/musora-cdn/image/width=740,quality=85/https://dpwjbsxqtam5n.cloudfront.net/lead-gen/getting-started/logo_centre_white.png" alt="">
                </picture>
                <h3 class="pt-4 md:pt-5 leading-7 md:leading-9 font-extrabold mb-6" data-open="test">
                    10 beginner drum lessons. Learn your first drum beats  & fills at your own pace.
                </h3>
                <p class="text-left mb-4 sm:mb-5 mx-auto inline-block sm:leading-loose">
                    <i class="text-drumeo fas fa-check sm:mr-2 text-xl"></i> Learn how to set up your drum kit.<br>
                    <i class="text-drumeo fas fa-check sm:mr-2 text-xl"></i> See how simple drum notation can be.<br>
                    <i class="text-drumeo fas fa-check sm:mr-2 text-xl"></i> Play your first song on the drums!<br>
                    <i class="text-drumeo fas fa-check sm:mr-2 text-xl"></i> 100% free -- lifetime access!
                </p>
                <div class="max-w-md md:max-w-auto lg:w-96 mx-auto md:mx-0">
                    @include("drumeo.lead-gen.partials.sign-up-form-tw", [
                        "formId" => "Drumeo - Engagement - Trigger - GSOTD - Web Form",
                    "formName" => 'Getting Started On The Drums',
                        "buttonText" => "Get started ",
                        'stacked' => true,
                        'inputBorder' => '1px solid #7A8491',
                        'disclaimerColor' => 'rgba(208, 226, 231, 0.8)',
                    "redirectURL" => "/getting-started/thank-you/"
                    ])
                </div>
            </div>
            <div class="flex justify-center md:justify-start w-full md:w-1/2 sm:order-1 md:pl-6 mt-7 md:mt-0 relative">
                <img class="max-w-2xl md:max-w-md lg:max-w-2xl lazyload" data-src="https://dpwjbsxqtam5n.cloudfront.net/lead-gen/getting-started/collage.png" alt="collage">
            </div>
        </div>
    </section>

    @php
        $modals = [
            [
                'img' => 'https://www.musora.com/musora-cdn/image/width=740,quality=85/https://dpwjbsxqtam5n.cloudfront.net/lead-gen/getting-started/billy.jpg',
                'testimonial' => 'Drumeo is the real deal folks! Jared Falk and his team have my confidence and support in what is done to promote music through the art of drumming and percussion. It is absolutely imperative for the student of the art to SEE, HEAR and EMULATE every lesson that is presented by the instructor. This is accomplished when studying lessons at Drumeo - a good place to study and realize one’s dreams.',
                'name' => 'Billy Cobham',
                'position' => 'Legendary Jazz Fusion Drummer',
            ],
            [
                'img' => 'https://www.musora.com/musora-cdn/image/width=740,quality=85/https://dpwjbsxqtam5n.cloudfront.net/lead-gen/getting-started/david.jpg',
                'testimonial' => 'The Drumeo standard is one of the highest quality and is THE place to go for the best in drum education!',
                'name' => 'David Garibaldi',
                'position' => 'Drummer for tower of power',
            ],
            [
                'img' => 'https://www.musora.com/musora-cdn/image/width=740,quality=85/https://dpwjbsxqtam5n.cloudfront.net/lead-gen/getting-started/anika.jpg',
                'testimonial' => 'Jared Falk has a comprehensive expert knowledge in providing and structuring lesson plans. He has a great human sense and knows how to handle, host and guide a lesson. It certainly didn’t come overnight. It’s more that he grew over the years to an expert and a professional instructor who really knows how to teach.',
                'name' => 'Anika Nilles',
                'position' => 'Drummer & Composer',
            ],
            [
                'img' => 'https://www.musora.com/musora-cdn/image/width=740,quality=85/https://dpwjbsxqtam5n.cloudfront.net/lead-gen/getting-started/casey.jpg',
                'testimonial' => "After years of watching Jared's lessons on YouTube and Drumeo, and getting to work side by side with him, I can confidently say that he gives every bit of his effort and skill into every product or lesson he teaches. He cares about each and every drummer who will watch and learn from his work and wants nothing more than to change drumming education for the better each time he puts his name on something.",
                'name' => 'Casey Cooper',
                'position' => 'Youtube Drummer',
            ],
        ];
    @endphp

    @foreach ($modals as $modal)
        <div class="reveal large relative max-w-xl" style="background: transparent;" id="{{ str_replace(' ', '', $modal['name']) }}" data-reveal data-reset-on-close="false">
            <div class="px-10 sm:px-20 relative" style="background: transparent;">
                <div class="max-w-xl mx-auto rounded-lg overflow-hidden" style="background: #051124;">
                    <img src="{{ $modal['img'] }}" alt="{{ $modal['name'] }}">
                    <p class="italic p-4 text-white">
                        “{{ $modal['testimonial'] }}”
                    </p>
                    <p class="uppercase font-bebas tracking-wider leading-5 mb-4 text-center">
                        <span class="text-drumeo">{{ $modal['name'] }}</span><br>
                        <span class="text-sm" style="color:#ABB5C2;">{{ $modal['position'] }}</span>
                    </p>
                </div>
            </div>
        </div>
    @endforeach

    <div class="reveal max-w-xl text-center" id="signUpModal" data-reveal data-reset-on-close="false">
        <div class="p-4">
            <h2 class="mb-2"><strong>Enter your email address<br class="inline sm:hidden"> below to get started:</strong></h2>
            @include("drumeo.lead-gen.partials.sign-up-form-tw", [
                "stacked" => true,
                "formId" => "Drumeo - Engagement - Trigger - GSOTD - Web Form",
                "formName" => 'Getting Started On The Drums',
                    "redirectURL" => "/getting-started/thank-you/"
            ])
        </div>
    </div>

    @include("drumeo.sales.partials._footer", [
            "minimal" => true
        ])
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/lazysizes/5.3.2/lazysizes.min.js"></script>
    <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/lazysizes/5.3.2/plugins/unveilhooks/ls.unveilhooks.min.js"></script>
    <script type="text/javascript" src="{{ asset('/marketing/js/modal.js') }}"></script>
    <script>
        $(document).ready(function () {
            $(document).foundation();
        });
    </script>

    <script src="{{ asset('/marketing/parcel/drumeo/navigation-sales.js') }}"></script>
    <script src="{{ asset('/marketing/js/pre-form-submit-facebook-lead.js') }}"></script>
    <script src="{{ asset('/marketing/js/drumeo/infusionsoft-tracking.js') }}"></script>
@stop
