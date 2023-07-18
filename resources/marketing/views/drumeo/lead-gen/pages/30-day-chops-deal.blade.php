@extends('drumeo._partials.global-layout')

@php
    $studentReviews = [
        [
            "quote" => "Greatest drummers<br class='hidden sm:inline'> in the world",
            "review" => "Drumeo gives its members exposure to the greatest drummers in the world. The best of the best want to open up to help learning drummers. I started drums at 55 and I feel like my membership to <span>Drumeo cut my learning time in half…</span>",
            "name" => "Marc",
            "date" => "Nov, 2022",
            "link" => "https://www.shopperapproved.com/reviews/23562?reviewid=137155359",
        ],
        [
            "quote" => "Learn new<br class='hidden sm:inline'> drumming styles",
            "review" => "This site is incredible! The coaches are the best drummers on the planet. All modern drumming styles are covered. I have many years of jazz drumming experience but <span>learning about heavy metal drumming and other styles that I haven't been exposed to makes me a better drummer</span> and musician. Thank you Drumeo!",
            "name" => "Al T",
            "date" => "July, 2022",
            "link" => "https://www.shopperapproved.com/reviews/23562?reviewid=142261697",
        ],
        [
            "quote" => "Encouraging <br class='hidden sm:inline'> drum community",
            "review" => "Drumeo has surpassed my expectations! <span>All the videos, courses, songs with downloadable sheet music, forums, play-a-longs that I can loop or slow down tempo for the hard parts and much more has been essential for learning at home.</span> The environment and drum community on here has been nothing but encouraging. The site and apps work great. Thank y'all for everything.",
            "name" => "Joey H",
            "date" => "June, 2022",
            "link" => "https://www.shopperapproved.com/reviews/23562?reviewid=141870949",
        ],
        [
            "quote" => "Perfect for<br class='hidden sm:inline'> beginners",
            "review" => "I especially love the “method” as I started out as a beginner. I love the mini lessons (the coaches do a great job teaching the lesson) and then the practice under the videos. <span>Being able to play it over and over, slowing it down or speeding it up. It is absolutely priceless!</span> As my skill level gets better, my fun level also grows!!",
            "name" => "With22h",
            "date" => "July, 2022",
            "link" => "https://www.shopperapproved.com/reviews/23562?reviewid=142390130",
        ],
        [
            "quote" => "Realtime coaching <br class='hidden sm:inline'> from the best!",
            "review" => "A truly great resource. Also, the team are quick to respond if technical issues occur on the platform, a worry when buying this type of thing online. <span>Drumeo is a rare chance to watch and learn from some of the biggest names in modern music and if you catch a live lesson, to actually interact and learn from industry giants!</span> After playing for nearly 40 years it is some of the best learning material I've ever found without buying literally hundreds of books and they let you try it out for free!",
            "name" => "Rob H",
            "date" => "Aug, 2022",
            "link" => "https://www.shopperapproved.com/reviews/23562?reviewid=144423047",
        ],
        [
            "quote" => "Develop skills... <br class='hidden sm:inline'>fast!",
            "review" => "The content is never ending. The willingness of the staff to go above and beyond for their students, clarity of material and relationship they have built with the community is all incredible. I started with Drumeo more or less at ground Zero and <span>1 year and a half later I am rocking to songs I did not think I would have the ability to play</span> at this point. You will get out of Drumeo what you put in.",
            "name" => "Matt E",
            "date" => "June, 2022",
            "link" => "https://www.shopperapproved.com/reviews/23562?reviewid=141482665",
        ],
    ];
@endphp

@section('global-head')
    <title>30-Day Chops | Drumeo</title>
    <meta property="og:title" content="30-Day Chops | Drumeo">
    <meta name="description" content="Learn drum chops with daily guided workouts.">
    <meta property="og:description" content="Learn drum chops with daily guided workouts.">
    <meta property="og:image" content="https://www.musora.com/musora-cdn/image/width=1200,quality=95/https://dpwjbsxqtam5n.cloudfront.net/drum-shop/30-day-chops/share-image2.jpg" style="display: none;">
    <meta property="og:url" content="https://www.drumeo.com/{{ Request::path() }}">

    @include('_partials.layout._fonts')

    @include('_partials.layout._tailwindcdn')
    <link href="{{ asset('/marketing/css/tailwind-helpers.css') }}" rel="stylesheet">
    <link href="{{ asset('/marketing/parcel/drumeo/navigation-sales.css') }}" rel="stylesheet">
    <link href="{{ asset('/marketing/parcel/drumeo/sales-2020.css') }}" rel="stylesheet">

    <style>
        .text-yellow {
            color: #FFB500;
        }

        .slick-2 .slick-track {
            display: flex;
            align-items: center;
            flex-wrap: wrap;
        }

        .slick-2 .slick-arrow {
            background: none !important;
            border: 1px solid #000008;
            padding: 4px 7px;
            top: 50%;
            bottom: unset;
        }

        .slick-2 .slick-arrow.slick-prev {
            left: 0px;
        }

        .slick-2 .slick-arrow.slick-next {
            right: 0px;
        }

        .slick-2 .slick-arrow.slick-prev::before, .slick-2 .slick-arrow.slick-next::before {
            font-size: 12px;
        }

        .slick-2 .slick-arrow.slick-prev:hover, .slick-2 .slick-arrow.slick-next:hover {
            background: none;
        }

        .slick-2 .slick-arrow.slick-prev::before, .slick-2 .slick-arrow.slick-next::before {
            color: #000008;
        }

        @media (min-width: 640px) {
            .slick-2 .slick-arrow.slick-prev {
                left: -50px;
            }

            .slick-2 .slick-arrow.slick-next {
                right: -50px;
            }
        }

        @media (min-width: 768px) {
            .slick-2 .slick-arrow.slick-prev::before, .slick-2 .slick-arrow.slick-next::before {
                font-size: 16px;
            }

            .slick-2 .slick-arrow {
                padding: 7px 11px;
            }

            .slick-2 .slick-arrow.slick-prev {
                left: -80px;
            }

            .slick-2 .slick-arrow.slick-next {
                right: -80px;
            }
        }

        .flip-div,
        .flip-div .bg-image {
            padding-bottom: 120%;
        }
        @media (min-width: 768px) {
            .flip-div,
            .flip-div .bg-image {
                padding-bottom: 167%;
            }
        }
        .flip-div,
        .flip-div .bg-image {
            padding-bottom: 100%;
        }
        .flip-div.flipped .front,
        .flip-div.flipped .front {
            -ms-transform: rotateY(180deg);
            -webkit-transform: rotateY(180deg);
            transform: rotateY(180deg);
        }
        .flip-div.flipped .back,
        .flip-div.flipped .back {
            -ms-transform: rotateY(0deg);
            -webkit-transform: rotateY(0deg);
            transform: rotateY(0deg);
        }
        .flip-div .back,
        .flip-div .back {
            -ms-transform: rotateY(-180deg);
            -webkit-transform: rotateY(-180deg);
            transform: rotateY(-180deg);
        }
        .flip-div .front,
        .flip-div .back {
            -ms-transition: transform 0.8s;
            -webkit-transition: transform 0.8s;
            transition: transform 0.8s;
            -ms-backface-visibility: hidden;
            -webkit-backface-visibility: hidden;
            backface-visibility: hidden;
        }
    </style>
@stop

@section('global-body')
    @include("drumeo.sales.partials._nav")

    <section class="px-4 py-7 sm:py-12 text-center" style="background:#f1f7fe;">
        <div class="container mx-auto max-w-2xl">
            <h3 class="leading-tight mb-3">
                Congratulations!<br class="hidden sm:inline">
                <strong>You’ve improved your chops. Now what?</strong>
            </h3>
            <h6 class="uppercase text-drumeo"><strong>GET UNLIMITED DRUM LESSONS FOR A YEAR + 5 FREE BONUSES</strong><br class="hidden sm:inline">
                <span x-cloak x-data="timer()" x-init="countdown()">
                                                                     <span x-cloak x-show="timeLeft > 0 && day > 0"><span x-text="day"></span><span x-text="dayText"></span></span>
                                                                     <span x-cloak x-show="timeLeft > 0 && hour > 0"><span x-text="hour"></span><span x-text="hourText"></span></span>
                                                                     <span x-cloak x-show="timeLeft > 0 && day < 7"><span x-text="minute"></span><span x-text="minuteText"></span></span>
                                                                     <span x-cloak x-show="timeLeft > 0 && day < 7"><span x-text="second"></span><span x-text="secondText"></span></span>
                                                                     <span x-cloak x-show="timeLeft < 0">A Limited Time</span>
                                                                 </span>
                left!
            </h6>
            <div class="w-full mx-auto my-5 sm:my-10 px-3">
                <div class="aspect-16:9 w-full relative rounded-xl overflow-hidden">
                    <iframe class="absolute w-full h-full reset-on-close" src="//player.vimeo.com/video/840552968" frameborder="0" allowfullscreen allow="autoplay"></iframe>
                </div>
            </div>
            <p class="leading-relaxed px-3 my-5 text-left">
                <strong>You’ve pushed yourself the last 30 days.</strong>
                <br><br>
                It hasn’t been easy – but working through 30-Day Chops has introduced you to the world of explosive linear patterns around the drums. And you might be wondering where to go next – so we’ve got you covered.
                <br><br>
                We want to see you keep the momentum going.
                <br><br>
                Join Drumeo today and you’ll get:
            </p>
            <ul class="py-4 px-6 mx-auto text-left text-white rounded-xl" style="background-color:#0d1627;">
                <li class="flex items-start mb-1"><span class="mr-2"><i class="fas fa-check mr-1 text-drumeo"></i></span> Unlimited drum lessons building on what you learned in 30-Day Chops</li>
                <li class="flex items-start mb-1"><span class="mr-2"><i class="fas fa-check mr-1 text-drumeo"></i></span> Access to 5000+ popular songs you can play with your new skills</li>
                <li class="flex items-start mb-1"><span class="mr-2"><i class="fas fa-check mr-1 text-drumeo"></i></span> Personalized support for ALL your drumming questions</li>
                <li class="flex items-start mb-1"><span class="mr-2"><i class="fas fa-check mr-1 text-drumeo"></i></span> An exclusive Masterclass with Zack to help you apply your new chops &nbsp;<strong class="text-yellow">(BONUS)</strong></li>
                <li class="flex items-start mb-1"><span class="mr-2"><i class="fas fa-check mr-1 text-drumeo"></i></span> Professional in-ear monitors &nbsp;<strong class="text-yellow">(BONUS)</strong></li>
                <li class="flex items-start mb-1"><span class="mr-2"><i class="fas fa-check mr-1 text-drumeo"></i></span> The Ultimate Guide To 101 Drumming Styles &nbsp;<strong class="text-yellow">(BONUS)</strong></li>
                <li class="flex items-start mb-1"><span class="mr-2"><i class="fas fa-check mr-1 text-drumeo"></i></span> A fresh pair of 5A drumsticks &nbsp;<strong class="text-yellow">(BONUS)</strong></li>
                <li class="flex items-start"><span class="mr-2"><i class="fas fa-check mr-1 text-drumeo"></i></span> And Drumeo’s new rudiment poster &nbsp;<strong class="text-yellow">(BONUS)</strong></li>
            </ul>
            <p class="leading-relaxed px-3 my-5 text-left">
                Plus, you’ll have FREE priority registration for any future 30-Day classes events like this one (we’ll be doing more, promise).
                <br><br>
                And we’ll also knock $40 off your membership for being a dedicated 30-Day Chops student (because hey, why not?).
                <br><br>
                But heads up: This offer is only available until July 9 at midnight.
                <br><br>
                Click below to get started and keep crushing it on the drums for the next year!
            </p>
            <div class="px-3 md:px-0">
                <a class="join blue smaller w-full sm:w-auto max-w-xs sm:max-w-full anchor-slide" href="#customize-section">Claim Your Offer</a>
            </div>
        </div>
    </section>

    <section class="py-12 md:py-20">
        <div class="max-w-md md:max-w-4xl mx-auto px-4 lg:px-2">
            <p class="text-center text-drumeo">
                <img class="h-10 sm:h-16 align-bottom" src="https://www.musora.com/musora-cdn/image/width=440,quality=95/https://dpwjbsxqtam5n.cloudfront.net/drum-shop/30-day-chops/logo.svg" alt="logo" fetchpriority="high">
                <strong>EXCLUSIVE</strong></p>
            <h3 class="font-extrabold text-center my-6">
                Drumeo membership special <br class="sm:hidden">pricing <br class="hidden sm:inline">
                + FREE bonuses.
            </h3>
            <p class="text-center mb-6">You’ll have one year of unlimited<br class="inline sm:hidden"> drum lessons, including:</p>
            <div class="md:grid md:grid-cols-3 md:gap-4">
                <div class="relative rounded-xl overflow-hidden mb-3 md:mb-0" style="background-color:#F6F8FC;">
                    <div class="w-full aspect-16:9 bg-cover bg-center lazyloaded" data-bg="https://www.musora.com/musora-cdn/image/width=700,quality=95/https://dpwjbsxqtam5n.cloudfront.net/sales/2022/thumb-method.jpg" style="background-image: url(&quot;https://www.musora.com/musora-cdn/image/width=700,quality=95/https://dpwjbsxqtam5n.cloudfront.net/sales/2022/thumb-method.jpg&quot;);"></div>
                    <div class=" px-3 lg:px-4 py-5 lg:py-7 text-center">
                        <i class="text-4xl align-middle icon-drums2 text-drumeo"></i>
                        <img class="h-5 ml-2 imgfilter-method lazyloaded" data-src="https://www.musora.com/musora-cdn/image/width=200,quality=95/https://dpwjbsxqtam5n.cloudfront.net/sales/2021/method-text.svg" alt="method-text" src="https://www.musora.com/musora-cdn/image/width=200,quality=95/https://dpwjbsxqtam5n.cloudfront.net/sales/2021/method-text.svg">
                        <p class="mt-2">
                            Step-by-step lessons for the next stage of your drumming.
                        </p>
                    </div>
                </div>
                <div class="relative rounded-xl overflow-hidden mb-3 md:mb-0" style="background-color:#F6F8FC;">
                    <div class="w-full aspect-16:9 bg-cover bg-center lazyloaded" data-bg="https://www.musora.com/musora-cdn/image/width=700,quality=95/https://dpwjbsxqtam5n.cloudfront.net/promos/june/2023/drumeo-songs.jpg" style="background-image: url(&quot;https://www.musora.com/musora-cdn/image/width=700,quality=95/https://dpwjbsxqtam5n.cloudfront.net/promos/june/2023/drumeo-songs.jpg&quot;);"></div>
                    <div class="px-3 lg:px-4 py-5 lg:py-7 text-center">
                        <i class="text-4xl align-middle icon-songs text-songs"></i>
                        <img class="h-5 ml-2 imgfilter-songs lazyloaded" data-src="https://www.musora.com/musora-cdn/image/width=150,quality=95/https://dpwjbsxqtam5n.cloudfront.net/sales/2021/songs-text.svg" alt="songs-text" src="https://www.musora.com/musora-cdn/image/width=150,quality=95/https://dpwjbsxqtam5n.cloudfront.net/sales/2021/songs-text.svg">
                        <p class="mt-2">
                            Easy access to 5000+ famous drum songs with play-along tools.
                        </p>
                    </div>
                </div>
                <div class="relative rounded-xl overflow-hidden" style="background-color:#F6F8FC;">
                    <div class="w-full aspect-16:9 bg-cover bg-center lazyloaded" data-bg="https://www.musora.com/musora-cdn/image/width=700,quality=95/https://dpwjbsxqtam5n.cloudfront.net/promos/june/2023/drumeo-coaches.jpg" style="background-image: url(&quot;https://www.musora.com/musora-cdn/image/width=700,quality=95/https://dpwjbsxqtam5n.cloudfront.net/promos/june/2023/drumeo-coaches.jpg&quot;);"></div>
                    <div class="px-3 lg:px-4 py-5 lg:py-7 text-center">
                        <img class="h-8 icon imgfilter-coaches lazyloaded" data-src="https://www.musora.com/musora-cdn/image/width=100,quality=95/https://dpwjbsxqtam5n.cloudfront.net/sales/2021/coaches-icon.svg" alt="coaches-icon" src="https://www.musora.com/musora-cdn/image/width=100,quality=95/https://dpwjbsxqtam5n.cloudfront.net/sales/2021/coaches-icon.svg">
                        <img class="h-5 ml-2 imgfilter-coaches lazyloaded" data-src="https://cdn.musora.com/image/fetch/q_auto:best/https://dpwjbsxqtam5n.cloudfront.net/sales/2021/coaches-text.svg" alt="coaches-text" src="https://cdn.musora.com/image/fetch/q_auto:best/https://dpwjbsxqtam5n.cloudfront.net/sales/2021/coaches-text.svg">
                        <p class="mt-2">
                            Personalized support for ALL your drumming questions.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="pb-12 md:pb-20" style="background:linear-gradient(to bottom, #fff, #f1f7fe);">
        <div class="max-w-4xl mx-auto px-4 lg:px-0">
            <div class="flex items-center">
                <div class="md:w-7/12 text-center md:order-1">
                    <img class="h-80 mb-4 md:hidden lazyload" data-src="https://www.musora.com/musora-cdn/image/width=1500,quality=95/https://dpwjbsxqtam5n.cloudfront.net/drum-shop/30-day-chops/live-screen.png" alt="ui">

                    <h3 class="font-extrabold mb-3 md:mb-5 text-left">
                        Plus, get an exclusive Welcome  <br class="hidden md:inline">
                        Masterclass with Zack Grooves.
                    </h3>
                    <p class="text-left">
                        Zack will help you get settled into your Drumeo membership and show you how to:
                    </p>
                    <ul class="pl-4 my-4 text-left">
                        <li class="flex items-start"><span class="mr-2">•</span> Choose the right lessons for the next stage of your drumming</li>
                        <li class="flex items-start"><span class="mr-2">•</span> Play-along with famous songs using Drumeo’s Songs feature.</li>
                        <li class="flex items-start"><span class="mr-2">•</span> Set drumming goals to get the most out of your membership</li>
                    </ul>
                    <p class="text-left">
                        Plus, you’ll have an opportunity to ask your questions and hang with Zack.
                        <br><br>
                        This is an exclusive event for 30-Day Chops students so you can launch into the next phase of your drumming with enthusiasm.
                        <br><br>
{{--                        You can tune in LIVE when you join Zack: <br>--}}
{{--                        <strong>July __ @ __pm ET</strong><br>--}}
                        See you there!
                    </p>
                </div>
                <div class="md:w-5/12 pr-6 lg:pr-16 hidden md:block">
                    <img class="lazyload" data-src="https://www.musora.com/musora-cdn/image/width=1500,quality=95/https://dpwjbsxqtam5n.cloudfront.net/drum-shop/30-day-chops/live-screen.png" alt="ui">
                </div>
            </div>
        </div>
    </section>

    <section class="py-6 md:py-16">
        <h3 class="font-extrabold text-center mb-4">
            You’ve spent 30 days <br class="inline sm:hidden">
            crushing it on the drums.
        </h3>
        <p class="text-center mb-10">
            Join a thriving community of drummers of ALL <br class="inline sm:hidden">skill-levels learning the world’s greatest instrument.
        </p>
        <div class="mx-auto md:max-w-3xl lg:max-w-4xl grid grid-cols-1 sm:grid-cols-3 gap-6 px-4 lg:px-0">
            <div class="max-w-xs mx-auto">
                <img class="rounded-xl lazyload" data-src="https://www.musora.com/musora-cdn/image/width=450,quality=95/https://dpwjbsxqtam5n.cloudfront.net/sales/social-proof/John_Stamos.jpg" alt="John Stamos" style="filter: drop-shadow(0px 4px 4px rgba(0, 0, 0, 0.25));">
                <p class="mt-6 mb-4 sm:mb-10 sm:h-32 md:h-24 lg:h-20">
                    “Playing drums is my favorite thing I get to do and I learn so much from all of these super pros on Drumeo.”
                </p>
                <a class="italic border-b text-gray-500 border-gray-300 pb-1" target="_blank" style="font-size: 10px; " href="https://www.instagram.com/reel/CeTtxCLpo7m/?utm_source=ig_web_copy_link&utm_campaign=2022-06-05_Drumeo_Mainlist_Celebrity-Drummers&utm_medium=email&utm_source=customer.io">As shared on Instagram</a>
                <p class="font-inter mt-4 sm:mt-6">
                    <img class="h-10 lazyload" data-src="https://www.musora.com/musora-cdn/image/width=220,quality=95/https://dpwjbsxqtam5n.cloudfront.net/sales/social-proof/John--Stamos.svg" alt="John Stamos"> <br>
                    <i class="text-sm">Actor, Musician, Singer</i>
                </p>
            </div>
            <div class="max-w-xs mx-auto">
                <img class="rounded-md lazyload" data-src="https://www.musora.com/musora-cdn/image/width=450,quality=95/https://dpwjbsxqtam5n.cloudfront.net/sales/social-proof/Ben_Stiller.jpg" alt="Ben Stiller" style="filter: drop-shadow(0px 4px 4px rgba(0, 0, 0, 0.25));">
                <p class="mt-6 mb-4 sm:mb-10 sm:h-32 md:h-24 lg:h-20">
                    “It’s an app that teaches you drums and has songs you can play along with, different teachers, and sheet music. It’s really good.”
                </p>
                <a class="italic border-b text-gray-500 border-gray-300 pb-1" target="_blank" style="font-size: 10px;" href="https://youtube.com/shorts/frOYuDmEO2s?feature=share">As shared on "The Howard Stern Show"</a>
                <p class="font-inter mt-4 sm:mt-6">
                    <img class="h-10 lazyload" data-src="https://www.musora.com/musora-cdn/image/width=200,quality=95/https://dpwjbsxqtam5n.cloudfront.net/sales/social-proof/Ben--Stiller.svg" alt="Ben Stiller"> <br>
                    <i class="text-sm">Actor, Comedian, Producer</i>
                </p>
            </div>
            <div class="max-w-xs mx-auto">
                <img class="rounded-md lazyload" data-src="https://www.musora.com/musora-cdn/image/width=450,quality=95/https://dpwjbsxqtam5n.cloudfront.net/sales/social-proof/Petr_Cech.jpg" alt="Petr_Cech" style="filter: drop-shadow(0px 4px 4px rgba(0, 0, 0, 0.25));">
                <p class="mt-6 mb-4 sm:mb-10 sm:h-32 md:h-24 lg:h-20">
                    “Drumeo is the easiest way for me to learn the drums, because I can learn anything I want, whenever it works best for me!”
                </p>
                <a class="italic border-b text-gray-500 border-gray-300 pb-1" target="_blank" style="font-size: 10px; " href="https://www.drumeo.com/beat/petr-cech/">As shared on Drumeo.com</a>
                <p class="font-inter mt-4 sm:mt-6">
                    <img class="h-10 lazyload" data-src="https://www.musora.com/musora-cdn/image/width=170,quality=95/https://dpwjbsxqtam5n.cloudfront.net/sales/social-proof/Petr--Cech.svg" alt="Petr Cech"> <br>
                    <i class="text-sm">Record-Setting Goalkeeper, Chelsea FC</i>
                </p>
            </div>
        </div>
    </section>

    <section class="pb-6 md:pb-16">
        <div class="md:max-w-3xl lg:max-w-4xl mx-auto text-center px-4 lg:px-0">
            <a target="_blank" href="https://www.shopperapproved.com/reviews/Musora.com">
                <img class="mx-auto h-10 mb-6 lazyload" data-src="https://www.musora.com/musora-cdn/image/width=500,quality=95/https://dpwjbsxqtam5n.cloudfront.net/sales/2023/shopper-approved-icon.svg" alt="shopper approved logo">
            </a>
            <h4 class="font-extrabold leading-tight {{--mb-2 sm:mb-4--}} mb-14">
                Trusted by {{ number_format(Prices::$students) }} students<br class="inline sm:hidden"> from around the world.
            </h4>
            {{--<p class="mb-14 leading-tight">--}}
            {{--Sub-headline explaining what<br class="inline sm:hidden"> the reviews below are.--}}
            {{--</p>--}}
            <div class="grid sm:grid-cols-3 gap-6">
                @foreach ($studentReviews as $key => $review)
                    <div class="max-w-sm md:max-w-full mx-auto mb-10 @if($key > 3) hidden sm:block @endif">
                        <h5 class="font-bold mb-3 leading-tight">{!!  $review['quote']  !!}</h5>
                        <img class="h-4" src="https://www.musora.com/musora-cdn/image/width=250,quality=95/https://dpwjbsxqtam5n.cloudfront.net/sales/social-proof/stars.svg" alt="5starts">
                        <hr class="w-12 mx-auto my-5" style="border-color: #D9D9D9; border-width: 1px;">
                        <p>{!! $review['review'] !!}</p>
                        <p class="mt-4 text-drumeo text-sm"><a target="_blank" href="{!! $review['link'] !!}"><strong>{!! $review['name'] !!}</strong> - {{ $review['date'] }}</a></p>
                    </div>
                @endforeach
            </div>
            <div class="w-full text-center">
                <a href="https://www.shopperapproved.com/reviews/Musora.com" class="join smaller outline method mx-auto inline-block uppercase" target="_blank">See more student reviews</a>
            </div>
        </div>
    </section>

    <div id="customize-section" class="anchor"></div>

    @php
        $bonuses = [
        [
            'image' => 'https://cdn.musora.com/image/fetch/c_fill,w_300,q_auto:good/https://dpwjbsxqtam5n.cloudfront.net/promos/june/2023/30-day-chops-masterclass.jpg',
            'title' => 'Drumeo EarDrums',
            'description' => 'Drumeo EarDrums reduce external volume by up to -29dB. That means you can play hard while protecting your ears.',

],
        [
            'image' => 'https://cdn.musora.com/image/fetch/c_fill,w_300,q_auto:good/https://dpwjbsxqtam5n.cloudfront.net/promos/black-friday/bundles/vertical-bg/eardrums.jpg',
            'title' => 'Drumeo EarDrums',
            'description' => 'Drumeo EarDrums reduce external volume by up to -29dB. That means you can play hard while protecting your ears.',
            'price' => floatval($productPrices['drumeo-eardrums']->price),
            'online-ship' => "Free Shipping",
            'shipping' => "no-shipping"
        ],
            [
            'image' => 'https://dpwjbsxqtam5n.cloudfront.net/promos/black-friday/bundles/vertical-bg/drumsticks.jpg',
            'title' => 'Drumeo Drumsticks',
            'description' => 'Drumeo 5A Drumsticks by Vater -- made with hickory and extra moisture to last longer.',
            'price' => floatval($productPrices['Drumeo-VaterSticks']->price),
            'shipping' => true,
            ],
        [
            'image' => 'https://dpwjbsxqtam5n.cloudfront.net/promos/black-friday/bundles/vertical-bg/tdt.jpg',
            'title' => "The Drummer's Toolbox Book",
            'description' => '',
            'price' => floatval($productPrices['the-drummers-toolbox-book']->price),
            'shipping' => true,
        ],
        [
            'image' => 'https://dpwjbsxqtam5n.cloudfront.net/promos/black-friday/rudiments_poster.jpg',
            'title' => "40 Drum Rudiments",
            'description' => '',
            'price' => floatval($productPrices['rudiments-poster']->price),
            'shipping' => true,
        ],
        ]
    @endphp
    @include('musora.sales.components.order-section-bonuses', [
        'topImage' => 'https://dpwjbsxqtam5n.cloudfront.net/sales/2023/drumeo-annual-2w-card.png',
        'header' => 'Online drum lessons<br class="inline sm:hidden"> for all skill levels.',
        'subDescription' => 'Start your Drumeo membership today and get:',
        'bonusWidth' => 'w-1/2 md:w-1/3 lg:w-1/5',
        'buttonLink' => '/ecommerce/add-to-cart?products[DLM-1-year]=1&products[drumeo-eardrums]=1&products[Drumeo-VaterSticks]=1&products[the-drummers-toolbox-book]=1&products[rudiments-poster]=1&locked=true&promo-code=special',
    ])

    @include("drumeo.sales.partials._footer", [
            "minimal" => true
        ])

    @include('_partials.components.countdown',[
        'countdownDate' => '2023-04-01 00:00:00',
        'promoVersion' => false
    ])
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="{{ asset('/marketing/parcel/drumeo/navigation-sales.js') }}"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.min.js"></script>
    <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/lazysizes/5.3.2/lazysizes.min.js"></script>
    <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/lazysizes/5.3.2/plugins/unveilhooks/ls.unveilhooks.min.js"></script>

    <script>
        $(document).ready(function(){

            $('.flip-div').click(function (e) {
                $(this).toggleClass('flipped');
            });


            $('.testimonials-show-all').click(function () {
                $('.testimonials').addClass('show-all');
            });

            $('.slick-1').slick({
                slidesToShow: 1,
                slidesToScroll: 1,
                autoplay: true,
                autoplaySpeed: 4000,
                arrows: false,
                speed: 500,
                fade: true,
                cssEase: 'linear'
            });

            $('.slick-3').slick({
                centerMode: true,
                slidesToShow: 5,
                responsive: [
                    {
                        breakpoint: 1024,
                        settings: {
                            slidesToShow: 4
                        }
                    },
                    {
                        breakpoint: 900,
                        settings: {
                            slidesToShow: 3
                        }
                    },
                    {
                        breakpoint: 650,
                        settings: {
                            slidesToShow: 2
                        }
                    },
                    {
                        breakpoint: 420,
                        settings: {
                            slidesToShow: 1
                        }
                    }
                ]
            });
        })
    </script>
    @include('_partials.components.countdown',[
    'countdownDate' => '2023-07-10 00:00:00',
    'promoVersion' => false
    ])
@stop
