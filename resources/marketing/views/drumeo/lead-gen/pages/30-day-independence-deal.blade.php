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

    <meta name="description" content="We put together an exclusive offer for 30-Day Independence students to get unlimited drum lessons for a year + some extra special bonuses.">
    <meta property="og:description" content="We put together an exclusive offer for 30-Day Independence students to get unlimited drum lessons for a year + some extra special bonuses.">

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

@section('body-data')
    x-data ='{
        lazyLoad: false,
        }'
@endsection


@section('global-body')
    @include("drumeo.sales.partials._nav")

    <section class="py-20 text-center" style="background:#F1F7FE;">
        <div class="mx-auto">
            <h2 class="leading-tight mb-2">
                <strong>Get unlimited drum lessons for a year!</strong><br>
                + Lifetime Access To 30-Day Independence.
            </h2>
            <div class="uppercase text-2xl text-musora"> <strong>
                <span x-cloak x-data="timer()" x-init="countdown()">
                <span>
                ONLY AVAILABLE FOR
                    <span x-cloak x-show="timeLeft > 0 && day > 0"><span x-text="day"></span><span x-text="dayText"></span></span>
                    <span x-cloak x-show="timeLeft > 0 && hour > 0"><span x-text="hour"></span><span x-text="hourText"></span></span>
                    <span x-cloak x-show="timeLeft > 0"><span x-text="minute"></span><span x-text="minuteText"></span></span>
                    <span x-cloak x-show="timeLeft > 0"><span x-text="second"></span><span x-text="secondText"></span></span>
                    <span x-cloak x-show="timeLeft < 0">A Limited Time</span>
                </span>
                </span>
            </strong>

            </div>
                <h5 class=" text-drumeo uppercase"></h5>
            <div class="w-full mx-auto my-8 px-3" style="max-width:920px;">
                <div class="aspect-16:9 w-full relative rounded-xl overflow-hidden">
                    <iframe class="absolute w-full h-full reset-on-close bg-black" src="//player.vimeo.com/video/952030247" frameborder="0" allowfullscreen allow="autoplay"></iframe>
                </div>
            </div>

            <p class="leading-relaxed px-3 my-5 text-left" style="width: 100%; max-width: 700px;">You’ve spent 30 days crushing it on the drums.
                <br><br>
                And we want to make it easy for you to keep going. So we put together an exclusive offer for 30-Day Independence students to get unlimited drum lessons for a year + lifetime access to 30-Day Chops–
                <br><br>
                And you only have to pay the difference.
                <br><br>
                <b>Join Drumeo today and you’ll get:</b>
            </p>
            <div class="mx-3 md:mx-0">
                <ul class="pl-4 mx-auto text-left rounded-xl text-white px-3 py-4 w-full" style="max-width: 700px; background-color:#0D1627;">
                <li class="flex items-start mb-1"><span class="mr-2"><i class="fas fa-check pt-1 mr-2 text-drumeo"></i></span> Step-by-step lessons building on what you learned in 30-Day Independence</li>
                <li class="flex items-start mb-1"><span class="mr-2"><i class="fas fa-check pt-1 mr-2 text-drumeo"></i></span> Access to 6000+ popular songs you can play with your new skills</li>
                <li class="flex items-start mb-1"><span class="mr-2"><i class="fas fa-check pt-1 mr-2 text-drumeo"></i></span> Personalized support for ALL your drumming questions</li>
                <li class="flex items-start mb-1"><span class="mr-2"><i class="fas fa-check pt-1 mr-2 text-drumeo"></i></span> An Advanced Independence follow-up course with El Estepario Siberiano (NEW)</li>
                <li class="flex items-start     "><span class="mr-2"><i class="fas fa-check pt-1 mr-2 text-drumeo"></i></span> Lifetime access to learn tasty linear chops on the drums with 30-Day Chops</li>
                </ul>
            </div>

            <p class="leading-relaxed px-3 my-5 text-left" style="width: 100%; max-width: 700px;">
                <strong class="text-drumeo">Plus,</strong> you’ll have FREE priority registration for any future 30-Day Independence events like this one (we’ll be doing more, promise).
                <br><br>
                You can join Drumeo for 1 year (with all that ^) for just $143.
                <br><br>
                <b>But heads up:</b> This offer is only available until June 5, 2024.
                <br><br>
                Click below to get started and keep crushing it on the drums for the next year!
            </p>
                        <div class="px-3 md:px-0">
                         <a class="join blue w-full sm:w-auto max-w-xs sm:max-w-full anchor-slide" href="#customize-section">SEE THE DEAL</a>
                            <!-- <a class="join sold-out w-full sm:w-auto max-w-xs sm:max-w-full">SOLD OUT</a> -->
                        </div>
        </div>
    </section>

    <section class="py-12 md:py-20 text-white" style="background:#01050F;">
        <div class="max-w-md md:max-w-4xl mx-auto px-4 lg:px-2">
            <p class="text-center text-yellow">30-DAY INDEPENDENCE EXCLUSIVE</p>
            <h3 class="font-extrabold text-center text-white my-6">
                Drumeo membership special <br class="sm:hidden">pricing <br class="hidden sm:inline">
                + FREE bonuses.
            </h3>
            <p class="text-center mb-6">You’ll have one year of unlimited drum lessons, including:</p>
            <div class="md:grid md:grid-cols-3 md:gap-4">
                <div class="relative rounded-xl overflow-hidden mb-3 md:mb-0" style="background-color:#071023;">
                    <div class="w-full aspect-16:9 bg-cover bg-center" style="background-image:url('https://www.musora.com/musora-cdn/image/width=700,quality=95/https://dpwjbsxqtam5n.cloudfront.net/sales/2022/thumb-method.jpg');"></div>
                    <div class=" px-3 lg:px-4 py-5 lg:py-7 text-center">
                        <i class="text-4xl align-middle icon-drumeo-method text-drumeo"></i>
                        <img class="h-5 ml-2 imgfilter-method" src="https://www.musora.com/musora-cdn/image/width=200,quality=95/https://dpwjbsxqtam5n.cloudfront.net/sales/2021/method-text.svg" alt="method-text">
                        <p class="mt-2">
                            Step-by-step lessons for the next stage of your drumming.
                        </p>
                    </div>
                </div>
                <div class="relative rounded-xl overflow-hidden mb-3 md:mb-0" style="background-color:#071023;">
                    <div class="w-full aspect-16:9 bg-cover bg-center" style="background-image:url('https://www.musora.com/musora-cdn/image/width=700,quality=95/https://dpwjbsxqtam5n.cloudfront.net/sales/2022/thumb-songs2.jpg');"></div>
                    <div class="px-3 lg:px-4 py-5 lg:py-7 text-center">
                        <i class="text-4xl align-middle icon-songs text-songs"></i>
                        <img class="h-5 ml-2 imgfilter-songs" src="https://www.musora.com/musora-cdn/image/width=150,quality=95/https://dpwjbsxqtam5n.cloudfront.net/sales/2021/songs-text.svg" alt="songs-text">
                        <p class="mt-2">
                            Easy access to 6000+ famous drum songs with play-along tools.
                        </p>
                    </div>
                </div>
                <div class="relative rounded-xl overflow-hidden" style="background-color:#071023;">
                    <div class="w-full aspect-16:9 bg-cover bg-center" style="background-image:url('https://www.musora.com/musora-cdn/image/width=700,quality=95/https://dpwjbsxqtam5n.cloudfront.net/sales/2022/thumb-coaches2.jpg');"></div>
                    <div class="px-3 lg:px-4 py-5 lg:py-7 text-center">
                        <img class="h-8 icon imgfilter-coaches" src="https://www.musora.com/musora-cdn/image/width=100,quality=95/https://dpwjbsxqtam5n.cloudfront.net/sales/2021/coaches-icon.svg" alt="coaches-icon">
                        <img class="h-5 ml-2 imgfilter-coaches" src="https://cdn.musora.com/image/fetch/q_auto:best/https://dpwjbsxqtam5n.cloudfront.net/sales/2021/coaches-text.svg" alt="coaches-text">
                        <p class="mt-2">
                            Personalized support for ALL your drumming questions.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="text-center px-5 sm:px-6 py-10 sm:py-14 lg:py-20">
        <div class="container max-w-5xl mx-auto">
            <h3 class="text-center leading-tight"><strong>Learn Drum Chops AND Take Your<br> Independence To The Next Level</strong></h3>
            <p class="leading-normal mt-2 sm:mt-3">You’ve untangled your limbs and are ready for the next steps.</p>
            <div class="flex flex-wrap text-left mx-auto my-6 sm:my-9 text-white">
                <div class="w-1/2 pr-2 sm:px-2">
                    <div class="rounded-xl overflow-hidden" style="background-color:#071023;">
                        <img class="transition-all" src="https://d21q7xesnoiieh.cloudfront.net/fit-in/690x0/filters:quality(95)/marketing/drumeo/products/30-day-independence/asc/thumb-30.png" alt="day1 thumb" loading="lazy" onload="this.classList.remove('opacity-0')">
                        <p class="p-2 sm:p-5 text-sm">
                            <strong>30-Day Chops</strong> | LIFETIME ACCESS<br><br>
                            Learn tasty linear chops by following daily guided workouts with ZackGrooves. By the end of the course, you’ll have the skills to explode creatively on the drums and start creating your own patterns.</p>
                    </div>
                </div>
                <div class="w-1/2 sm:px-2">
                    <div class="rounded-xl overflow-hidden" style="background-color:#071023;">
                        <img class="transition-all" src="https://d21q7xesnoiieh.cloudfront.net/fit-in/690x0/filters:quality(95)/marketing/drumeo/products/30-day-independence/asc/thumb-advanced.png" alt="day 30 thumb" loading="lazy" onload="this.classList.remove('opacity-0')">
                        <p class="p-2 sm:p-5 text-sm">
                            <strong>Advanced Independence with Estepario</strong><br><br>
                            The next frontier in 4-way coordination. In this advanced course, Estepario will push your 4-way limb independence to the next level with challenging patterns in short daily lessons.</p>
                    </div>
                </div>
            </div>
            <h6><em>These brand new follow-up packs are available now–</em><br><br>
                <strong class="text-drumeo">And they’re included FREE with your Drumeo membership.</strong></h6>
        </div>
    </section>

    <section class="pt-12 md:pt-20" style="background-color:#F1F7FE;">
        <h3 class="font-extrabold text-center mb-4">
            You’ve spent 30 days <br>
            crushing it on the drums.
        </h3>
        <p class="text-center">
            Join a thriving community of drummers of ALL skill-levels <br>learning the world’s greatest instrument.
        </p>
    </section>

    <section class="py-6 md:py-10" style="background-color:#F1F7FE;">
        <div class="mx-auto md:max-w-3xl lg:max-w-4xl grid grid-cols-1 sm:grid-cols-3 gap-6 px-4 lg:px-0">
            <div class="max-w-xs mx-auto">
                <img class="rounded-xl" src="https://www.musora.com/musora-cdn/image/width=450,quality=95/https://dpwjbsxqtam5n.cloudfront.net/sales/social-proof/John_Stamos.jpg" alt="John Stamos" style="filter: drop-shadow(0px 4px 4px rgba(0, 0, 0, 0.25));">
                <p class="mt-6 mb-4 sm:mb-10 sm:h-32 md:h-24 lg:h-20">
                    “Playing drums is my favorite thing I get to do and I learn so much from all of these super pros on Drumeo.”
                </p>
                <a class="italic border-b text-gray-500 border-gray-300 pb-1" target="_blank" style="font-size: 10px; " href="https://www.instagram.com/reel/CeTtxCLpo7m/?utm_source=ig_web_copy_link&utm_campaign=2022-06-05_Drumeo_Mainlist_Celebrity-Drummers&utm_medium=email&utm_source=customer.io">As shared on Instagram</a>
                <p class="font-inter mt-4 sm:mt-6">
                    <img class="h-10" src="https://www.musora.com/musora-cdn/image/width=220,quality=95/https://dpwjbsxqtam5n.cloudfront.net/sales/social-proof/John--Stamos.svg" alt="John Stamos"> <br>
                    <i class="text-sm">Actor, Musician, Singer</i>
                </p>
            </div>
            <div class="max-w-xs mx-auto">
                <img class="rounded-md" src="https://www.musora.com/musora-cdn/image/width=450,quality=95/https://dpwjbsxqtam5n.cloudfront.net/sales/social-proof/Ben_Stiller.jpg" alt="Ben Stiller" style="filter: drop-shadow(0px 4px 4px rgba(0, 0, 0, 0.25));">
                <p class="mt-6 mb-4 sm:mb-10 sm:h-32 md:h-24 lg:h-20">
                    “It’s an app that teaches you drums and has songs you can play along with, different teachers, and sheet music. It’s really good.”
                </p>
                <a class="italic border-b text-gray-500 border-gray-300 pb-1" target="_blank" style="font-size: 10px;" href="https://youtube.com/shorts/frOYuDmEO2s?feature=share">As shared on "The Howard Stern Show"</a>
                <p class="font-inter mt-4 sm:mt-6">
                    <img class="h-10" src="https://www.musora.com/musora-cdn/image/width=200,quality=95/https://dpwjbsxqtam5n.cloudfront.net/sales/social-proof/Ben--Stiller.svg" alt="Ben Stiller"> <br>
                    <i class="text-sm">Actor, Comedian, Producer</i>
                </p>
            </div>
            <div class="max-w-xs mx-auto">
                <img class="rounded-md" src="https://www.musora.com/musora-cdn/image/width=450,quality=95/https://dpwjbsxqtam5n.cloudfront.net/sales/social-proof/Petr_Cech.jpg" alt="Petr_Cech" style="filter: drop-shadow(0px 4px 4px rgba(0, 0, 0, 0.25));">
                <p class="mt-6 mb-4 sm:mb-10 sm:h-32 md:h-24 lg:h-20">
                    “Drumeo is the easiest way for me to learn the drums, because I can learn anything I want, whenever it works best for me!”
                </p>
                <a class="italic border-b text-gray-500 border-gray-300 pb-1" target="_blank" style="font-size: 10px; " href="https://www.drumeo.com/beat/petr-cech/">As shared on Drumeo.com</a>
                <p class="font-inter mt-4 sm:mt-6">
                    <img class="h-10" src="https://www.musora.com/musora-cdn/image/width=170,quality=95/https://dpwjbsxqtam5n.cloudfront.net/sales/social-proof/Petr--Cech.svg" alt="Petr Cech"> <br>
                    <i class="text-sm">Record-Setting Goalkeeper, Chelsea FC</i>
                </p>
            </div>
        </div>
    </section>

    @php
        $bonuses = [
                        [
                        'image' => 'marketing/drumeo/products/30-day-independence/asc/card-30.png',
                        'title' => "30-Day Chops",
                        'description' => 'For 30 days, play along with Zack Graybeal (aka “Zack Grooves”) and gain the skills to create your own patterns around the kit.',
                        'price' => floatval($productPrices['30-day-chops']->price),
                        ],
                        [
                        'image' => 'marketing/drumeo/products/30-day-independence/asc/card-advanced.png',
                        'title' => "Advanced Independence",
                        'description' => 'Estepario will push your 4-way limb independence to the next level with challenging patterns in short daily lessons.',
                        'customText' => 'NEW COURSE',
                        ],
        ]
    @endphp
    @include('musora.sales.components.order-section-bonuses', [
    'bgColor' => 'background:linear-gradient(to bottom, #01050F 66%, #07132C);',
    'subHeader' => '<strong><span class="text-musora">SAVE 40%</span> ON YOUR DRUMEO MEMBERSHIP</strong> <br class="hidden sm:inline">+ GET 2 FREE BONUSES.',
    'theme' => 'drumeo',
        'firstYearPrice' => '143',
        'CTA' => 'CLAIM YOUR OFFER',
    'topImage' => 'marketing/drumeo/membership/homepage/2024/drumeo-annual-2w-card.webp',
    'subDescription' => 'Save 17% + get 4 bonuses<br class="inline sm:hidden"> worth $603.95',
    'buttonLink' => '/ecommerce/add-to-cart?products[DLM-1-year]=1&products[30-day-chops]=1&locked=true&promo-code=ultimate-technique',
    'altButtonLink' => '/ecommerce/add-to-cart?products[DLM-1-month]=1&locked=true',
    ])

    <div id="customize-section" class="anchor"></div>


    @include("drumeo.sales.partials._footer", [
            "minimal" => true
        ])

    @include('_partials.components.countdown',[
        'countdownDate' => '2024-06-06 00:00:00',
        'promoVersion' => false
    ])
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/lazysizes/5.3.2/lazysizes.min.js"></script>
    <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/lazysizes/5.3.2/plugins/unveilhooks/ls.unveilhooks.min.js"></script>
    <script src="{{ asset('/marketing/parcel/drumeo/navigation-sales.js') }}"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.min.js"></script>

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
