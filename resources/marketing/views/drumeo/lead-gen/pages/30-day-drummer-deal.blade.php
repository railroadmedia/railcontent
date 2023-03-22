@extends('drumeo._partials.global-layout')

@php
    $brandLogos = [
        [
            "logo" => "https://dpwjbsxqtam5n.cloudfront.net/sales/social-proof/Grammys_logo.svg",
            "large_styles" => "",
            "small_styles" => "",
            "link" => "https://www.grammy.com/news/music-education-teachers-musicians-innovation-challenges-impact-benefits",
        ],
        [
            "logo" => "https://dpwjbsxqtam5n.cloudfront.net/sales/social-proof/RollingStones_logo.svg",
            "large_styles" => "mt-2 sm:ml-2 md:ml-4",
            "small_styles" => "mt-2",
            "link" => "https://www.rollingstone.com/music/music-features/nandi-bushell-deden-noy-viral-drummers-to-watch-1200727/",
        ],
        [
            "logo" => "https://dpwjbsxqtam5n.cloudfront.net/sales/social-proof/NME_logo.svg",
            "large_styles" => "mt-2 md:-mr-2 h-6",
            "small_styles" => "",
            "link" => "https://www.nme.com/news/music/grandma-covers-blink-182-and-challenges-travis-barker-to-drum-battle-3140426",
        ],
        [
            "logo" => "https://dpwjbsxqtam5n.cloudfront.net/sales/social-proof/Billboard_logo.svg",
            "large_styles" => "mt-2",
            "small_styles" => "",
            "link" => "https://www.billboard.com/music/rock/neil-peart-tribute-drummer-175-rush-songs-1235017063/",
        ],
        [
            "logo" => "https://dpwjbsxqtam5n.cloudfront.net/sales/social-proof/CBC_logo.svg",
            "large_styles" => "",
            "small_styles" => "",
            "link" => "https://www.cbc.ca/news/canada/british-columbia/bc-rush-neil-peart-video-1.6311816",
        ],
        [
            "logo" => "https://dpwjbsxqtam5n.cloudfront.net/sales/social-proof/CTV_logo.svg",
            "large_styles" => "sm:-mr-6 md:-mr-10",
            "small_styles" => "",
            "link" => "https://bc.ctvnews.ca/video?clipId=1907026",
        ],
        [
            "logo" => "https://dpwjbsxqtam5n.cloudfront.net/sales/social-proof/Musicradar_logo.svg",
            "large_styles" => "sm:-mr-10 md:-mr-16",
            "small_styles" => "",
            "link" => "https://www.musicradar.com/news/dennis-chambers-plays-tool-schism-after-hearing-it-for-the-first-time",
        ],
        [
            "logo" => "https://dpwjbsxqtam5n.cloudfront.net/sales/social-proof/ETCanada_logo.svg",
            "large_styles" => "sm:-mr-6 md:-mr-10",
            "small_styles" => "",
            "link" => "https://etcanada.com/news/858576/the-godmother-of-drumming-challenges-travis-barker-after-grandmas-cover-of-whats-my-age-again/",
        ],
    ];

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
    <title>Get unlimited drum lessons for a year!</title>
    <meta property="og:title" content="Get unlimited drum lessons for a year!">

    <meta name="description" content="We put together an exclusive offer for 30-Day Drummer students to get unlimited drum lessons for a year + some extra special bonuses.">
    <meta property="og:description" content="We put together an exclusive offer for 30-Day Drummer students to get unlimited drum lessons for a year + some extra special bonuses.">

    <meta property="og:url" content="https://www.drumeo.com/{{ Request::path() }}">
    <meta property="og:image" content="https://dpwjbsxqtam5n.cloudfront.net/sales/2023/share-image-drumeo.jpg" style="display: none;">

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

    <section class="py-20 text-center text-white" style="background:#01050F;">
        <div class="mx-auto">
            <h1 class="font-bebas md:leading-none mb-1 text-4xl md:text-6xl">
                GET UNLIMITED DRUM LESSONS <br class="inline lg:hidden"><span class="text-yellow">FOR A YEAR</span>
            </h1>
            <h4 class="text-yellow uppercase">+ exclusive masterclass with Domino (and 3 more bonuses!)</h4>
            <div class="w-full mx-auto my-10 px-3" style="max-width:920px;">
                <div class="aspect-16:9 w-full relative rounded-xl overflow-hidden">
                    <iframe class="absolute w-full h-full reset-on-close" src="//player.vimeo.com/video/754886689" frameborder="0" allowfullscreen allow="autoplay"></iframe>
                </div>
            </div>
            <p class="leading-relaxed px-3 my-5 text-left" style="width: 100%; max-width: 700px;">
                You’ve spent 30 days crushing it on the drums. <br><br>
                And we want to make it easy for you to keep going. So we put together an exclusive offer for 30-Day Drummer students to get unlimited drum lessons for a year + some extra special bonuses. <br><br>
                <b>Join Drumeo today and you’ll get:</b>
            </p>
            <ul class="pl-4 mx-auto text-left" style="width: 100%; max-width: 700px;">
                <li class="flex items-start">
                    <span class="mr-2"><i class="fas fa-check pt-1 mr-2 text-drumeo"></i></span>
                    Step-by-step lessons building on what you learned in 30-Day Drummer
                </li>
                <li class="flex items-start">
                    <span class="mr-2"><i class="fas fa-check pt-1 mr-2 text-drumeo"></i></span>
                    Easy access to hundreds of popular songs you can play with your new skills
                </li>
                <li class="flex items-start">
                    <span class="mr-2"><i class="fas fa-check pt-1 mr-2 text-drumeo"></i></span>
                    Personalized support for ALL your drumming questions
                </li>
                <li class="flex items-start">
                    <span class="mr-2"><i class="fas fa-check pt-1 mr-2 text-drumeo"></i></span>
                    An exclusive Masterclass with Domino to help you plan your next steps (BONUS)
                </li>
                <li class="flex items-start">
                    <span class="mr-2"><i class="fas fa-check pt-1 mr-2 text-drumeo"></i></span>
                    Fresh drumsticks, the Best Beginner Drum Book, and a popular training pack (BONUS)
                </li>
            </ul>
            <p class="leading-relaxed px-3 my-5 text-left" style="width: 100%; max-width: 700px;">
                Plus, you’ll have FREE priority registration for any future 30-Day Drummer events like this one (we’ll be doing more, promise). <br><br>
                And we’ll also knock $40 off your membership for being a dedicated 30-Day Drummer student (because hey, why not?). <br><br>
                <b>But heads up:</b> This offer is only available until March 31, 2023. <br><br>
                Click below to get started and keep crushing it on the drums for the next year! <br><br>
            </p>
                        <div class="px-3 md:px-0">
                            <a class="join blue w-full sm:w-auto max-w-xs sm:max-w-full anchor-slide" href="#customize-section">SEE THE DEAL</a>
                        </div>
        </div>
    </section>

    <section class="py-12 md:py-20" style="background:linear-gradient(0deg, #063562 0%, #01050F 100%);">
        <div class="max-w-md md:max-w-4xl mx-auto px-4 lg:px-2">
            <p class="text-center text-yellow">30-DAY DRUMMER EXCLUSIVE</p>
            <h3 class="font-extrabold text-center text-white my-6">
                Drumeo membership special <br class="sm:hidden">pricing <br class="hidden sm:inline">
                + FREE bonuses.
            </h3>
            <p class="text-center text-light-navy mb-6">You’ll have one year of unlimited drum lessons, including:</p>
            <div class="md:grid md:grid-cols-3 md:gap-4">
                <div class="relative rounded-xl overflow-hidden mb-3 md:mb-0" style="background-color:#051124;">
                    <div class="w-full aspect-16:9 bg-cover bg-center lazyload" data-bg="https://www.musora.com/musora-cdn/image/width=700,quality=85/https://dpwjbsxqtam5n.cloudfront.net/sales/2022/thumb-method.jpg"></div>
                    <div class=" px-3 lg:px-4 py-5 lg:py-7 text-center">
                        <i class="text-4xl align-middle icon-drumeo-method text-drumeo"></i>
                        <img class="h-5 ml-2 imgfilter-method lazyload" data-src="https://www.musora.com/musora-cdn/image/width=200,quality=85/https://dpwjbsxqtam5n.cloudfront.net/sales/2021/method-text.svg" alt="method-text">
                        <p class="mt-2" style="color:#A3AEC6;">
                            Step-by-step lessons for the next stage of your drumming.
                        </p>
                    </div>
                </div>
                <div class="relative rounded-xl overflow-hidden mb-3 md:mb-0" style="background-color:#051124;">
                    <div class="w-full aspect-16:9 bg-cover bg-center lazyload" data-bg="https://www.musora.com/musora-cdn/image/width=700,quality=85/https://dpwjbsxqtam5n.cloudfront.net/sales/2022/thumb-songs2.jpg"></div>
                    <div class="px-3 lg:px-4 py-5 lg:py-7 text-center">
                        <i class="text-4xl align-middle icon-songs text-songs"></i>
                        <img class="h-5 ml-2 imgfilter-songs lazyload" data-src="https://www.musora.com/musora-cdn/image/width=150,quality=85/https://dpwjbsxqtam5n.cloudfront.net/sales/2021/songs-text.svg" alt="songs-text">
                        <p class="mt-2" style="color:#A3AEC6;">
                            Easy access to 3100+ famous drum songs with playalong tools.
                        </p>
                    </div>
                </div>
                <div class="relative rounded-xl overflow-hidden" style="background-color:#051124;">
                    <div class="w-full aspect-16:9 bg-cover bg-center lazyload" data-bg="https://www.musora.com/musora-cdn/image/width=700,quality=85/https://dpwjbsxqtam5n.cloudfront.net/sales/2022/thumb-coaches2.jpg"></div>
                    <div class="px-3 lg:px-4 py-5 lg:py-7 text-center">
                        <img class="h-8 icon imgfilter-coaches lazyload" data-src="https://www.musora.com/musora-cdn/image/width=100,quality=85/https://dpwjbsxqtam5n.cloudfront.net/sales/2021/coaches-icon.svg" alt="coaches-icon">
                        <img class="h-5 ml-2 imgfilter-coaches lazyload" data-src="https://cdn.musora.com/image/fetch/q_auto:best/https://dpwjbsxqtam5n.cloudfront.net/sales/2021/coaches-text.svg" alt="coaches-text">
                        <p class="mt-2" style="color:#A3AEC6;">
                            Personalized support for ALL your drumming questions.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="py-12 md:py-20" style="background:#F5F5F5;">
        <div class="max-w-4xl mx-auto px-4 lg:px-0">
            <h3 class="font-extrabold text-center mb-6 md:mb-10">
                Plus, get an exclusive Welcome <br class="hidden md:inline">
                Masterclass with Domino Santantonio.
            </h3>
            <div class="flex items-center">
                <div class="md:w-7/12 text-center">
                    <img class="h-80 mb-4 md:hidden lazyload" data-src="https://d2vyvo0tyx8ig5.cloudfront.net/giveaways/ui.png" alt="ui">
                    <p class="text-left">
                        Domino will help you get settled into your Drumeo membership and show you how to:
                    </p>
                    <ul class="pl-4 my-4 text-left">
                        <li class="flex items-start"><span class="mr-2">•</span> Choose the right lessons for the next stage of your drumming</li>
                        <li class="flex items-start"><span class="mr-2">•</span> Use Drumeo’s Songs feature to play along with famous songs</li>
                        <li class="flex items-start"><span class="mr-2">•</span> Set drumming goals to get the most out of your membership</li>
                    </ul>
                    <p class="text-left">
                        Plus, you’ll have an opportunity to ask your questions and hang with Domino. <br><br>
                        This is an exclusive event for 30-Day Drummer students so you can launch into the next phase of your drumming with enthusiasm. <br><br>
                        You can tune in LIVE when you join Drumeo: <br><br>
                        April 22 at 10am PT (1pm ET). <br><br>
                        See you there!
                    </p>
                </div>
                <div class="md:w-5/12 pl-6 lg:pl-16 hidden md:block">
                    <img class="lazyload" data-src="https://dpwjbsxqtam5n.cloudfront.net/drum-shop/30-day-drummer/ui.png" alt="ui">
                </div>
            </div>
        </div>
    </section>

    <section class="py-12 md:py-20 slick-2-l-container">
        <h3 class="font-extrabold text-center mb-4">
            You’ve spent 30 days <br>
            crushing it on the drums.
        </h3>
        <p class="text-center mb-10">
            Join a thriving community of drummers of ALL skill-levels <br>learning the world’s greatest instrument.
        </p>
        <h5 class="text-center relative max-w-xs mx-auto pb-3" style="color: #879097;">
            As Seen In:
            <div class="absolute left-0 right-0 bottom-0 text-center">
                <div class="inline-block border-t-2 border-solid w-10" style="border-color:#0B76DB;"></div>
            </div>
        </h5>
        <div class="mx-auto px-10 sm:px-0 max-w-lg md:max-w-xl lg:max-w-2xl flex items-center slick-2 relative slick-2-l">
            @foreach ($brandLogos as $key => $logo)
                <div class="flex-1 text-center">
                    <a target="_blank" href="{{ $logo['link'] }}"><img class="{{ $logo['large_styles'] }} lazyload" data-src="{{ $logo['logo'] }}" alt="logo{{$key+1}}" style="display: inline-block;"></a>
                </div>
            @endforeach
        </div>
    </section>

    <section class="py-2 slick-2-s-container">
        <h3 class="font-extrabold text-center mb-4">
            You’ve spent 30 days <br>
            crushing it on the drums.
        </h3>
        <p class="text-center mb-10">
            Join a thriving community of drummers of ALL skill-levels <br>learning the world’s greatest instrument.
        </p>
        <h5 class="text-center relative max-w-xs mx-auto pt-5" style="color: #879097;">
            As Seen In:
        </h5>
        <div class="mx-auto px-10 sm:px-0 max-w-lg md:max-w-xl lg:max-w-2xl flex items-center slick-2 relative slick-2-s">
            <div class="flex-1 text-center" style="display:none;">
                <div class="flex items-center flex-wrap">
                    @foreach (array_slice($brandLogos, 0, 4) as $key => $logo)
                        <div class="w-1/2 flex items-center justify-center p-4">
                            <a target="_blank" href="{{ $logo['link'] }}"><img class="{{ $logo['small_styles'] }}" src="{{ $logo['logo'] }}" alt="logo{{$key+1}}" style="display: inline-block;"></a>
                        </div>
                    @endforeach
                </div>
            </div>
            <div class="flex-1 text-center" style="display:none;">
                <div class="flex items-center flex-wrap">
                    @foreach (array_slice($brandLogos, 4, 8) as $key => $logo)
                        <div class="w-1/2 flex items-center justify-center p-4">
                            <a target="_blank" href="{{ $logo['link'] }}"><img class="{{ $logo['small_styles'] }}" src="{{ $logo['logo'] }}" alt="logo{{$key+1}}" style="display: inline-block;"></a>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>

    <section class="py-6 md:py-10">
        <div class="mx-auto md:max-w-3xl lg:max-w-4xl grid grid-cols-1 sm:grid-cols-3 gap-6 px-4 lg:px-0">
            <div class="max-w-xs mx-auto">
                <img class="rounded-xl lazyload" data-src="https://www.musora.com/musora-cdn/image/width=450,quality=85/https://dpwjbsxqtam5n.cloudfront.net/sales/social-proof/John_Stamos.jpg" alt="John Stamos" style="filter: drop-shadow(0px 4px 4px rgba(0, 0, 0, 0.25));">
                <p class="mt-6 mb-4 sm:mb-10 sm:h-32 md:h-24 lg:h-20">
                    “Playing drums is my favorite thing I get to do and I learn so much from all of these super pros on Drumeo.”
                </p>
                <a class="italic border-b text-gray-500 border-gray-300 pb-1" target="_blank" style="font-size: 10px; " href="https://www.instagram.com/reel/CeTtxCLpo7m/?utm_source=ig_web_copy_link&utm_campaign=2022-06-05_Drumeo_Mainlist_Celebrity-Drummers&utm_medium=email&utm_source=customer.io">As shared on Instagram</a>
                <p class="font-inter mt-4 sm:mt-6">
                    <img class="h-10 lazyload" data-src="https://www.musora.com/musora-cdn/image/width=220,quality=85/https://dpwjbsxqtam5n.cloudfront.net/sales/social-proof/John--Stamos.svg" alt="John Stamos"> <br>
                    <i class="text-sm">Actor, Musician, Singer</i>
                </p>
            </div>
            <div class="max-w-xs mx-auto">
                <img class="rounded-md lazyload" data-src="https://www.musora.com/musora-cdn/image/width=450,quality=85/https://dpwjbsxqtam5n.cloudfront.net/sales/social-proof/Ben_Stiller.jpg" alt="Ben Stiller" style="filter: drop-shadow(0px 4px 4px rgba(0, 0, 0, 0.25));">
                <p class="mt-6 mb-4 sm:mb-10 sm:h-32 md:h-24 lg:h-20">
                    “It’s an app that teaches you drums and has songs you can play along with, different teachers, and sheet music. It’s really good.”
                </p>
                <a class="italic border-b text-gray-500 border-gray-300 pb-1" target="_blank" style="font-size: 10px;" href="https://youtube.com/shorts/frOYuDmEO2s?feature=share">As shared on "The Howard Stern Show"</a>
                <p class="font-inter mt-4 sm:mt-6">
                    <img class="h-10 lazyload" data-src="https://www.musora.com/musora-cdn/image/width=200,quality=85/https://dpwjbsxqtam5n.cloudfront.net/sales/social-proof/Ben--Stiller.svg" alt="Ben Stiller"> <br>
                    <i class="text-sm">Actor, Comedian, Producer</i>
                </p>
            </div>
            <div class="max-w-xs mx-auto">
                <img class="rounded-md lazyload" data-src="https://www.musora.com/musora-cdn/image/width=450,quality=85/https://dpwjbsxqtam5n.cloudfront.net/sales/social-proof/Petr_Cech.jpg" alt="Petr_Cech" style="filter: drop-shadow(0px 4px 4px rgba(0, 0, 0, 0.25));">
                <p class="mt-6 mb-4 sm:mb-10 sm:h-32 md:h-24 lg:h-20">
                    “Drumeo is the easiest way for me to learn the drums, because I can learn anything I want, whenever it works best for me!”
                </p>
                <a class="italic border-b text-gray-500 border-gray-300 pb-1" target="_blank" style="font-size: 10px; " href="https://www.drumeo.com/beat/petr-cech/">As shared on Drumeo.com</a>
                <p class="font-inter mt-4 sm:mt-6">
                    <img class="h-10 lazyload" data-src="https://www.musora.com/musora-cdn/image/width=170,quality=85/https://dpwjbsxqtam5n.cloudfront.net/sales/social-proof/Petr--Cech.svg" alt="Petr Cech"> <br>
                    <i class="text-sm">Record-Setting Goalkeeper, Chelsea FC</i>
                </p>
            </div>
        </div>
    </section>

    <section class="py-6 md:py-10">
        <div class="md:max-w-3xl lg:max-w-4xl mx-auto text-center px-4 lg:px-0">
            <a target="_blank" href="https://www.shopperapproved.com/reviews/Musora.com/product/Drumeo+Membership/7918738">
                <img class="mx-auto h-10 mb-6 lazyload" data-src="https://www.musora.com/musora-cdn/image/width=500,quality=85/https://dpwjbsxqtam5n.cloudfront.net/sales/2023/shopper-approved-icon.svg" alt="shopper approved logo">
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
                        <img class="h-4" src="https://www.musora.com/musora-cdn/image/width=250,quality=85/https://dpwjbsxqtam5n.cloudfront.net/sales/social-proof/stars.svg" alt="5starts">
                        <hr class="w-12 mx-auto my-5" style="border-color: #D9D9D9; border-width: 1px;">
                        <p>{!! $review['review'] !!}</p>
                        <p class="mt-4 text-drumeo text-sm"><a target="_blank" href="{!! $review['link'] !!}"><strong>{!! $review['name'] !!}</strong> - {{ $review['date'] }}</a></p>
                    </div>
                @endforeach
            </div>
            <div class="w-full text-center">
                <a href="https://www.shopperapproved.com/reviews/Musora.com/product/Drumeo+Membership/7918738" class="join smaller outline method mx-auto inline-block uppercase" target="_blank">See more student reviews</a>
            </div>
        </div>
    </section>

    <div id="customize-section" class="anchor"></div>
    <section class="py-12 md:py-20 px-4 sm:px-6" style="background:linear-gradient(180deg, #01050F 60.48%, #07132C 100%);">
        <div class="max-w-2xl lg:max-w-5xl mx-auto text-center text-white">
            <img class="h-12 mb-4" src="https://www.musora.com/musora-cdn/image/quality=100,width=250,metadata=none/https://dpwjbsxqtam5n.cloudfront.net/logos/logo-blue.png" alt="drumeo logo">
            <h3 class="font-extrabold">Start your Drumeo membership <br class="md:hidden">today and get:</h3>
            <h5 class="uppercase my-8 text-yellow">Only
                <span x-cloak x-data="timer()" x-init="countdown()">
                         <span x-cloak x-show="timeLeft > 0 && day !== '00'"><span x-text="day"></span><span x-text="dayText"></span></span>
                         <span x-cloak x-show="timeLeft > 0 && hour !== '00'"><span x-text="hour"></span><span x-text="hourText"></span></span>
                         <span x-cloak x-show="timeLeft > 0"><span x-text="minute"></span><span x-text="minuteText"></span></span>
                         <span x-cloak x-show="timeLeft > 0"><span x-text="second"></span><span x-text="secondText"></span></span>
                         <span x-cloak x-show="timeLeft < 0">A Limited Time</span>
                     </span>
                left!</h5>



            <div class="flex justify-center lg:mb-10 flex-wrap">
                @php
                    $bonuses = [
                        [
                        'image' => 'https://cdn.musora.com/image/fetch/c_fill,w_500,q_auto:good/https://dpwjbsxqtam5n.cloudfront.net/promos/drumeo_annual.jpg',
                        'title' => 'Drumeo Annual Membership',
                        'description' => 'The Ultimate Online Drum Lessons Experience. You’ll get step-by-step drum lessons from the best drummers in the world (and much more).',
                        'price' => 240,
                        'priceReal' => "$197",
                        ],
                        [
                        'image' => 'https://dpwjbsxqtam5n.cloudfront.net/promos/black-friday/bundles/vertical-bg/30DD.jpg',
                        'title' => "Domino's Welcome Masterclass",
                        'description' => 'This is an exclusive event for 30-Day Drummer students so you can launch into the next phase of your drumming with enthusiasm.',
                        ],
                        [
                        'image' => 'https://dpwjbsxqtam5n.cloudfront.net/promos/black-friday/bundles/vertical-bg/drumsticks.jpg',
                        'title' => 'Drumeo Drumsticks',
                        'description' => 'Drumeo 5A Drumsticks by Vater -- made with hickory and extra moisture to last longer.',
                        'price' => 0,
                        'shipping' => "Free Shipping",
                        ],
                        [
                        'image' => 'https://dpwjbsxqtam5n.cloudfront.net/sales/2022/bonus-beginner-drum-book.jpg',
                        'title' => "Best Beginner<br> Drum Book",
                        'description' => 'The simplest guide for beginner drummers to get started on the drums and take their drumming to the next level.',
                        'price' => 0,
                        'shipping' => "Free Shipping",
                        ],
                        [
                        'image' => 'https://dpwjbsxqtam5n.cloudfront.net/promos/black-friday/bundles/vertical-bg/lsf.jpg',
                        'title' => 'Learn Songs Faster',
                        'description' => 'This masterclass will give you proven techniques for learning MORE songs in less time.',
                        'price' => 0,
                        ],
                    ]
                @endphp
                @foreach($bonuses as $bonus)
                    <div class="bonus-wrap relative inline-block align-top mx-auto mb-3 px-1 md:px-4 lg:px-1 w-1/2 sm:w-1/3 lg:w-1/5">
                        <div class="flip-div inline-block relative w-full group" style="@if(empty($bonus['bigCard'])) padding-bottom: 133%; @else padding-bottom: 103%; @endif perspective: 1000px;">
                            <div class="text-center w-full h-full absolute cursor-pointer" style="transform-style: preserve-3d;">
                                <div class="border-2 border-drumeo front absolute z-20 overflow-hidden rounded-xl w-full h-full transition-transform duration-700" style="@if(!empty($bonus['special'])) overflow: visible;border-color: #cda880; @endif backface-visibility: hidden;">
                                    @if(!empty($bonus['shipping']))
                                        <h6 class="absolute text-white top-0 left-0 w-full py-0.5 bg-drumeo rounded-t-xl font-bebas uppercase">{{ $bonus['shipping'] }}</h6>
                                    @endif
                                    <div class="overflow-hidden rounded-xl h-full w-full bg-black bg-top bg-cover lazyload" data-bg="https://www.musora.com/musora-cdn/image/width=460,quality=85/{{ $bonus['image'] }}"></div>
                                    <div class="absolute z-40 text-center top-1/2 left-1/2 text-white transition-opacity duration-300 transform -translate-x-1/2 -translate-y-1/2 visible opacity-0 group-hover:opacity-100 text-shadow-2">
                                        <i class="fas fa-arrow-right text-4xl"></i><br>
                                        <p class="text-sm"><strong>DETAILS</strong></p>
                                    </div>
                                </div>
                                <div class="back border-2 border-drumeo absolute z-40 overflow-hidden rounded-xl w-full h-full transition-transform duration-700" style="backface-visibility: hidden;">
                                    <div class="w-full h-full mx-auto text-center text-white flex flex-wrap justify-center items-center content-center p-2 md:p-3" style="background:linear-gradient(to bottom, #01050f, #021225);">
                                        <p class="leading-normal mx-auto text-sm">{!! $bonus['description'] !!}</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <p class="uppercase w-full leading-normal mt-2">
                            {{--<strong class="font-black leading-tight inline-block mb-1">{!!  $bonus['title']  !!}</strong><br>--}}
                            <span style="text-transform:uppercase; display:inline-block;">

                        @if(!empty($bonus['price']))
                                    <s class="opacity-50">${{ $bonus['price'] }}</s>
                                @endif

                                @if(!empty($bonus['priceReal']))
                                    <strong class="text-promo">{{ $bonus['priceReal'] }}</strong>
                                @else
                                    <strong class="text-promo">FREE</strong>
                                @endif
                            </span><br>
                            @if(!empty($bonus['shipping']))
                                Free Shipping
                            @else
                                Online Access
                            @endif
                        </p>
                    </div>
                @endforeach
            </div>
            <h3 class="text-coaches mb-8"><strong>ONLY <s class="opacity-60">${{ 240 }}</s> $197</strong></h3>
            <div class="w-2/3 mx-auto">
                <a href="/ecommerce/add-to-cart?products[DLM-1-year]=1&products[Drumeo-VaterSticks]=1&products[BeginnerBook]=1&products[learn-songs-faster-pack]=1&locked=true"
                    class="join blue w-full">Get The Deal</a>
            </div>
            <p class="text-center my-8" style="color:#ABB5C2;">
                <b>Any questions?</b> Call us toll-free at 1-800-439-8921 or directly at 1-604-855-7605.
            </p>
            <div class="text-light-navy">
                <i class="mx-0.5 text-3xl md:text-4xl fab fa-cc-visa"></i>
                <i class="mx-0.5 text-3xl md:text-4xl fab fa-cc-mastercard"></i>
                <i class="mx-0.5 text-3xl md:text-4xl fab fa-cc-amex"></i>
                <i class="mx-0.5 text-3xl md:text-4xl fab fa-cc-paypal"></i>
                <i class="mx-0.5 text-3xl md:text-4xl fab fa-cc-discover"></i>
            </div>
        </div>
    </section>

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

            const screenWidth = window.innerWidth;

            if(screenWidth > 639){
                $('.slick-2-l-container').removeClass('hidden');
                $('.slick-2-s-container').addClass('hidden');
            }
            else{
                $('.slick-2-s-container').removeClass('hidden');
                $('.slick-2-l-container').addClass('hidden');
            }

            $(window).resize(function(){
                const screenWidth = window.innerWidth;
                if(screenWidth > 639){
                    $('.slick-2-l-container').removeClass('hidden');
                    $('.slick-2-s-container').addClass('hidden');
                }
                else{
                    $('.slick-2-s-container').removeClass('hidden');
                    $('.slick-2-l-container').addClass('hidden');
                }
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

            $('.slick-2-l').slick({
                slidesToShow: 4,
                slidesToScroll: 4,
            });

            $('.slick-2-s').slick({
                slidesToShow: 1,
                slidesToScroll: 1,
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
@stop
