@php
    require_once(resource_path('marketing/views/drumeo/_partials/homepage-data.php'));
@endphp

@extends('drumeo._partials.global-layout')

@section('global-head')
    <title>Rejoin Drumeo and save on your membership.</title>
    <meta property="og:title" content="Rejoin Drumeo and save on your membership.">
    <meta property="og:url" content="https://www.drumeo.com/welcome-back-discount">

    <meta name="description" content="Save $60/year + 2 bonuses worth $254!">
    <meta property="og:description" content="Save $60/year + 2 bonuses worth $254!">

    <meta property="twitter:image" content="https://musora-image-processing-cdn.s3.us-east-2.amazonaws.com/marketing/drumeo/membership/homepage/2024/twitter-image.webp">
    <meta property="og:image" content="https://d21q7xesnoiieh.cloudfront.net/fit-in/1200x0/filters:quality(95)/marketing/drumeo/membership/homepage/2024/share-image-drumeo.webp">

    <link rel="stylesheet" href="{{ mix('marketing/css/app.css') }}">
    <link href="{{ asset('/marketing/parcel/drumeo/navigation-sales.css') }}" rel="stylesheet">
    <link href="{{ asset('/marketing/css/tailwind-helpers.css') }}" rel="stylesheet">
    <link href="{{ asset('/marketing/parcel/drumeo/sales-2020.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@splidejs/splide@4.1.4/dist/css/splide.min.css">
    <style>
        .tool:after, .tool:before {
            position: absolute;
            transform: translate(-50%, 0);
            height: auto;
            max-height: 0;
            visibility: hidden;
            opacity: 0;
            transition: all .3s;
            overflow: hidden;
            font-size: 14px;
        }
        .tool:before {
            z-index: 100;
            content: "";
            bottom: 23px;
            left: 50%;
            border-right: 7px transparent solid;
            border-left: 7px transparent solid;
            border-top: 7px solid #fff;
        }
        .tool:after {
            padding: 5px 8px;
            content: attr(tip);
            font-size: 14px;
            text-align: left;
            color: #000;
            width: 220px;
            border-radius: 8px;
            background: #fff;
            box-shadow: 0 0 15px #000;
            bottom: 30px;
            left: -300%;
        }
        .tool:hover, .tool:active, .tool:focus {
            z-index: 100;
        }
        .tool:hover:after, .tool:hover:before, .tool:active:after, .tool:active:before, .tool:focus:after, .tool:focus:before {
            max-height: 1000px;
            visibility: visible;
            opacity: 1;
            display: block;
        }
        .splide__pagination__page.is-active {
            background: #01050F;
            transform: none !important;
        }

        .splide__pagination__page {
            margin: 3px 10px !important;
            opacity: 1 !important;
        }

        @media (min-width: 768px) {
            .splide__pagination__page {
                margin: 3px 6px !important;
            }
        }

        .splide__arrow svg {
            fill: #0B76DB !important;
        }

        .splide__slide.is-active .active-bg {
            background-color:#1B2434!important;
            color:#fff!important;
        }
    </style>
@stop

@section('body-data')
    x-data ='{
    lazyLoad: false,
    }'
@endsection

@section('global-body')
    @include("drumeo.sales.partials._nav", [
        "subscriptionVersion" => true,
        "scrollToJoin" => true,
        "hideMenu" => true,
    ])
    <header class="text-center px-5 sm:px-6 py-16 sm:py-24 lg:py-32 relative overflow-hidden text-white bg-cover bg-center"
        style="background-image: url('https://d21q7xesnoiieh.cloudfront.net/fit-in/2500x0/filters:quality(95)/marketing/drumeo/membership/welcome-offer/header.webp');">
        <div class="container max-w-6xl mx-auto relative z-20">
            <h1 class="relative w-auto inline-block text-3xl sm:text-5xl lg:text-6xl leading-none sm:leading-none lg:leading-none uppercase">
                <strong class="relative inline-block">EVERYTHING
                    <svg class="absolute left-0 right-0 bottom-0 w-full h-4 sm:h-7" xmlns="http://www.w3.org/2000/svg" width="100%" height="100%" viewBox="0 0 524 22" fill="none" style="transform: translate(0, 70%);"><path d="M1.99978 10.6328C84.053 4.08508 302.889 -3.20824 521.809 20" stroke="#0b76db" stroke-width="3" stroke-linecap="round"></path><path d="M2.17373 15.0541C83.9528 7.29382 302.406 -3.51921 521.988 15.3111" stroke="#0b76db" stroke-width="3" stroke-linecap="round"></path></svg>
                </strong>
                YOU NEED <br class="hidden sm:inline">
                TO LEARN THE DRUMS.
            </h1>
            <h6 class="font-bold my-5 sm:my-6"><em>Reach your musical goals with Drumeo.</em></h6>
            <p class="text-sm leading-normal mb-5 lg:mb-7">
                <i class="fas fa-check text-{{ $theme }}"></i> Song Breakdowns
                <i class="fas fa-check lg:ml-5 text-{{ $theme }}"></i> Unlimited Drum Lessons
                <br class="sm:hidden">
                <i class="fas fa-check lg:ml-5 text-{{ $theme }}"></i> Legendary Instructors
                <i class="fas fa-check ml-3 sm:ml-5 text-{{ $theme }}"></i> 24/7 Support
            </p>

            <a class="join {{ $theme }} smaller sm:w-5/12 mb-2 sm:mb-0 anchor-slide" href="#customize-anchor" aria-label="Customize anchor">SEE YOUR DEAL</a>
            <div class="flex flex-wrap items-center justify-center mt-2 sm:mt-3 mx-auto">
                <a aria-label="Review" class="inline-block" href="https://www.shopperapproved.com/reviews/Musora.com" target="_blank" rel="noopener noreferrer" onclick="window.open('https://www.shopperapproved.com/reviews/Musora.com', 'newwindow', 'width=750, height=550'); return false;">
                    <i class="align-middle text-lg fas fa-star" style="color: #ffac00;" aria-hidden="true"></i>
                    <i class="align-middle text-lg -ml-4 fas fa-star" style="text-shadow: -2px -1px 1px #344146;color: #ffac00;" aria-hidden="true"></i>
                    <i class="align-middle text-lg -ml-4 fas fa-star" style="text-shadow: -2px -1px 1px #344146;color: #ffac00;" aria-hidden="true"></i>
                    <i class="align-middle text-lg -ml-4 fas fa-star" style="text-shadow: -2px -1px 1px #344146;color: #ffac00;" aria-hidden="true"></i>
                    <i class="align-middle text-lg -ml-4 fas fa-star" style="text-shadow: -2px -1px 1px #344146;color: #ffac00;" aria-hidden="true"></i>
                </a>
                <p class="inline-block leading-tight text-xs align-middle pl-1 m-0"><em>Trusted by {{ number_format(Prices::$students) }} active students.</em></p>
            </div>
        </div>
    </header>
    <section class="text-center px-5 sm:px-6 py-10 sm:py-14 lg:py-20">
        <div class="container max-w-5xl mx-auto">
            <h2 class="leading-tight mb-6 sm:mb-10"><strong><span class="border-2 border-{{$theme}} rounded-full px-3 sm:px-4 py-1 inline-block"> 5 </span> reasons to keep <br class="inline sm:hidden"> your membership.</strong></h2>
            <div class="flex flex-wrap text-left">
                <div class="flex flex-wrap items-start justify-center text-left mb-2 sm:mb-0 w-full sm:w-1/2">
                    <div class="flex flex-wrap items-start w-full sm:px-3 mb-5 sm:mb-8" x-data="{ open: false }">
                        <div class="pb-[70%] sm:pb-[60%] overflow-hidden text-white relative w-full rounded-xl opacity-100" :class="{'opacity-0': !lazyLoad, 'opacity-100': lazyLoad}" x-intersect.once="lazyLoad = true; $refs.image.src = $refs.image.dataset.src;">
                            <picture class="absolute inset-0 w-full h-full object-cover bg-center rounded-xl" style="background: linear-gradient(180deg, transparent, rgba(246, 248, 252, 0.9));">
                                <source srcset="https://d21q7xesnoiieh.cloudfront.net/fit-in/980x0/filters:quality(95)/marketing/drumeo/membership/welcome-offer/1.webp" media="(min-width: 640px)">
                                <img x-ref="image" data-src="https://d21q7xesnoiieh.cloudfront.net/fit-in/980x0/filters:quality(95)/marketing/drumeo/membership/welcome-offer/1.webp" alt="Handy Practice Tools" class="w-full h-full object-cover rounded-xl transition-opacity" onload="this.classList.remove('opacity-0')">
                            </picture>
                            <div class="absolute bottom-0 left-0 right-0 px-4 sm:px-3 lg:px-5 pb-4 lg:pb-7 pt-10 flex items-start">
                                <h5 class="rounded-full border-2 border-{{$theme}} inline-block w-9 h-9 leading-8 mx-0 text-center flex-grow-0 flex-shrink-0"><strong>1</strong></h5>
                                <div class="pl-3">
                                    <h5 class="leading-tight"><strong>Unlimited Access</strong></h5>
                                    <p class="leading-normal text-sm transition-all duration-300 overflow-hidden max-w-sm mx-0">Practice with thousands of songs, workouts, & courses.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="flex flex-wrap items-start w-full sm:px-3 mb-5 sm:mb-8" x-data="{ open: false }">
                        <div class="pb-[70%] sm:pb-[80%] overflow-hidden text-white relative w-full rounded-xl opacity-100" :class="{'opacity-0': !lazyLoad, 'opacity-100': lazyLoad}" x-intersect.once="lazyLoad = true; $refs.image.src = $refs.image.dataset.src;">
                            <picture class="absolute inset-0 w-full h-full object-cover bg-center rounded-xl" style="background: linear-gradient(180deg, transparent, rgba(246, 248, 252, 0.9));">
                                <source srcset="https://d21q7xesnoiieh.cloudfront.net/fit-in/980x0/filters:quality(95)/marketing/drumeo/membership/welcome-offer/3.webp" media="(min-width: 640px)">
                                <img x-ref="image" data-src="https://d21q7xesnoiieh.cloudfront.net/fit-in/980x0/filters:quality(95)/marketing/drumeo/membership/welcome-offer/3.webp" alt="Step-By-Step Clarity" class="w-full h-full object-cover rounded-xl transition-opacity" onload="this.classList.remove('opacity-0')">
                            </picture>
                            <div class="absolute bottom-0 left-0 right-0 px-4 sm:px-3 lg:px-5 pb-4 lg:pb-7 pt-10 flex items-start">
                                <h5 class="rounded-full border-2 border-{{$theme}} inline-block w-9 h-9 leading-8 mx-0 text-center flex-grow-0 flex-shrink-0"><strong>3</strong></h5>
                                <div class="pl-3">
                                    <h5 class="leading-tight"><strong>Be First To Know</strong></h5>
                                    <p class="leading-normal text-sm transition-all duration-300 overflow-hidden max-w-sm mx-0">Get free access to all our latest drum challenges.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="flex flex-wrap items-start justify-center text-left mb-2 sm:mb-0 w-full sm:w-1/2">
                    <div class="flex flex-wrap items-start w-full sm:px-3 mb-5 sm:mb-8" x-data="{ open: false }">
                        <div class="pb-[70%] sm:pb-[80%] overflow-hidden text-white relative w-full rounded-xl opacity-100" :class="{'opacity-0': !lazyLoad, 'opacity-100': lazyLoad}" x-intersect.once="lazyLoad = true; $refs.image.src = $refs.image.dataset.src;">
                            <picture class="absolute inset-0 w-full h-full object-cover bg-center rounded-xl" style="background: linear-gradient(180deg, transparent, rgba(246, 248, 252, 0.9));">
                                <source srcset="https://d21q7xesnoiieh.cloudfront.net/fit-in/980x0/filters:quality(95)/marketing/drumeo/membership/welcome-offer/2.webp" media="(min-width: 640px)">
                                <img x-ref="image" data-src="https://d21q7xesnoiieh.cloudfront.net/fit-in/980x0/filters:quality(95)/marketing/drumeo/membership/welcome-offer/2.webp" alt="World-Class Teachers" class="w-full h-full object-cover rounded-xl transition-opacity" loading="lazy" onload="this.classList.remove('opacity-0')">
                            </picture>
                            <div class="absolute bottom-0 left-0 right-0 px-4 sm:px-3 lg:px-5 pb-4 lg:pb-7 pt-10 flex items-start">
                                <h5 class="rounded-full border-2 border-{{$theme}} inline-block w-9 h-9 leading-8 mx-0 text-center flex-grow-0 flex-shrink-0"><strong>2</strong></h5>
                                <div class="pl-3">
                                    <h5 class="leading-tight"><strong>VIP Treatment</strong></h5>
                                    <p class="leading-normal text-sm transition-all duration-300 overflow-hidden max-w-sm mx-0">Enjoy exclusive member-only discounts & live streams.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="flex flex-wrap items-start w-full sm:px-3 mb-5 sm:mb-8" x-data="{ open: false }">
                        <div class="pb-[70%] sm:pb-[60%] overflow-hidden text-white relative w-full rounded-xl opacity-100" :class="{'opacity-0': !lazyLoad, 'opacity-100': lazyLoad}" x-intersect.once="lazyLoad = true; $refs.image.src = $refs.image.dataset.src;">
                            <picture class="absolute inset-0 w-full h-full object-cover bg-center rounded-xl" style="background: linear-gradient(180deg, transparent, rgba(246, 248, 252, 0.9));">
                                <source srcset="https://d21q7xesnoiieh.cloudfront.net/fit-in/980x0/filters:quality(95)/marketing/drumeo/membership/welcome-offer/4.webp" media="(min-width: 640px)">
                                <img x-ref="image" data-src="https://d21q7xesnoiieh.cloudfront.net/fit-in/980x0/filters:quality(95)/marketing/drumeo/membership/welcome-offer/4.webp" alt="Powered By Humans" class="w-full h-full object-cover rounded-xl transition-opacity" loading="lazy" onload="this.classList.remove('opacity-0')">
                            </picture>
                            <div class="absolute bottom-0 left-0 right-0 px-4 sm:px-3 lg:px-5 pb-4 lg:pb-7 pt-10 flex items-start">
                                <h5 class="rounded-full border-2 border-{{$theme}} inline-block w-9 h-9 leading-8 mx-0 text-center flex-grow-0 flex-shrink-0"><strong>4</strong></h5>
                                <div class="pl-3">
                                    <h5 class="leading-tight"><strong>24/7 Personal Support</strong></h5>
                                    <p class="leading-normal text-sm transition-all duration-300 overflow-hidden max-w-sm mx-0">Chat with our mentors & community for help on any topic.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="flex flex-wrap items-start w-full sm:px-3" x-data="{ open: false }">
                    <div class="pb-[70%] sm:pb-96 overflow-hidden text-white relative w-full rounded-xl opacity-100" :class="{'opacity-0': !lazyLoad, 'opacity-100': lazyLoad}" x-intersect.once="lazyLoad = true">
                        <picture>
                            <source media="(min-width: 1024px)" srcset="https://d21q7xesnoiieh.cloudfront.net/fit-in/2000x0/filters:quality(95)/marketing/drumeo/membership/welcome-offer/5.webp">
                            <source media="(min-width: 640px)" srcset="https://d21q7xesnoiieh.cloudfront.net/fit-in/0x770/filters:quality(95)/marketing/drumeo/membership/welcome-offer/5.webp">
                            <img src="https://d21q7xesnoiieh.cloudfront.net/fit-in/0x470/filters:quality(95)/marketing/drumeo/membership/welcome-offer/5.webp" alt="Any Instrument, Any Time" class="absolute inset-0 w-full h-full object-cover bg-center rounded-xl transition-opacity" style="object-position: 60% 0;" loading="lazy" onload="this.classList.remove('opacity-0')">
                        </picture>
                        <div class="absolute bottom-0 left-0 right-0 px-4 sm:px-5 pb-5 sm:pb-7 pt-10 flex items-start">
                            <h5 class="rounded-full border-2 border-{{$theme}} inline-block w-9 h-9 leading-8 mx-0 text-center flex-grow-0 flex-shrink-0"><strong>5</strong></h5>
                            <div class="pl-3">
                                <h5 class="leading-tight"><strong>Learn New Instruments</strong></h5>
                                <p class="leading-normal text-sm transition-all duration-300 overflow-hidden max-w-sm mx-0">Taking a break from drums? Try Piano, Guitar, or Singing lessons anytime.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="text-center px-5 sm:px-6 py-10 sm:py-14 lg:py-20" style="background-color:#F6F8FC;">
        <div class="container max-w-5xl mx-auto">
            <h2 class="leading-tight font-black">Drumeo Membership Special Pricing</h2>
            <p class="leading-tight mt-2 mb-6">Get one year of unlimited drum lessons, including:</p>

            <div class="grid grid-cols-1 sm:grid-cols-4 gap-3">
                <div class="">
                    <img src="https://d21q7xesnoiieh.cloudfront.net/fit-in/500x0/filters:quality(95)/marketing/drumeo/membership/welcome-offer/1guided.webp" alt="Guided Lessons" class="w-full rounded-xl mb-4">
                    <h4><i class="text-{{$theme}} fal fa-video mb-2"></i></h4>
                    <h5 class="font-black mb-2">Guided Lessons</h5>
                    <p class="leading-normal">Step-by-step lessons and practice alongs so you can play along with your teacher in real time.</p>
                </div>
                <div class="">
                    <img src="https://d21q7xesnoiieh.cloudfront.net/fit-in/500x0/filters:quality(95)/marketing/drumeo/membership/welcome-offer/2songs.webp" alt="Songs" class="w-full rounded-xl mb-4">
                    <h4><i class="text-{{$theme}} fal fa-music mb-2"></i></h4>
                    <h5 class="font-black mb-2">Songs</h5>
                    <p class="leading-normal">Note-for-note breakdowns with the ability to slow things down, loop sections, and use a metronome.</p>
                </div>
                <div class="">
                    <img src="https://d21q7xesnoiieh.cloudfront.net/fit-in/500x0/filters:quality(95)/marketing/drumeo/membership/welcome-offer/3real-teachers.webp" alt="Real Teachers" class="w-full rounded-xl mb-4">
                    <h4><i class="text-{{$theme}} fal fa-users mb-2"></i></h4>
                    <h5 class="font-black mb-2">Real Teachers</h5>
                    <p class="leading-normal">Your favorite drummers and teachers will share their tips, cheer you along, and help you learn by drumming!</p>
                </div>
                <div class="">
                    <img src="https://d21q7xesnoiieh.cloudfront.net/fit-in/500x0/filters:quality(95)/marketing/drumeo/membership/welcome-offer/4mentors.webp" alt="Supportive Mentors" class="w-full rounded-xl mb-4">
                    <h4><i class="text-{{$theme}} fal fa-handshake-angle mb-2"></i></h4>
                    <h5 class="font-black mb-2">Supportive Mentors</h5>
                    <p class="leading-normal">Ask your most pressing music questions, personalized practice plans & feedback on your playing!</p>
                </div>
            </div>
        </div>
    </section>
    @php
        $testimonials = $drumeo['testimonials'];
        $youtube = convertNumber(Prices::$drumeoYoutubeSubsc);
        $facebook = convertNumber(Prices::$drumeoFacebookLikes);
        $instagram = convertNumber(Prices::$drumeoInstagramFollowers);
    @endphp

    @include('musora.sales.components.testimonials-section', [
        'header' => 'drummers',
        'youtubeLink' => 'https://www.youtube.com/freedrumlessons/',
        'facebookLink' => 'https://facebook.com/drumeo/',
        'instagramLink' => 'https://instagram.com/drumeoofficial/',
    ])
    @include('musora.sales.components.guarantee-section', [
        'badge' => 'marketing/drumeo/membership/homepage/2024/guarantee.webp',
        'header' => '<strong>Happy “Welcome Back” Guarantee</strong><br>Test-drive your lessons for 90 days. Zero risk.',
        'desc' => 'More than anything we want to make sure you have a POSITIVE experience developing new skills and gaining confidence when you rejoin Drumeo. Which is why you’ll have 90 days risk-free to try everything again and make sure you love it. ',
    ])

    <section class="text-center px-5 sm:px-6 py-10 sm:py-14 lg:py-20" style="background-color:#F6F8FC;">
        <div class="container max-w-5xl mx-auto">
            <h2 class="leading-tight font-black">Drum lessons for all skill levels</h2>
            <p class="leading-tight mt-2 mb-6">Whatever your level, Drumeo will help you reach your goals.</p>

            <div class="grid grid-cols-1 sm:grid-cols-4 gap-3 text-left">
                <div class="">
                    <img src="https://d21q7xesnoiieh.cloudfront.net/fit-in/500x0/filters:quality(95)/marketing/drumeo/membership/welcome-offer/1aspiring.webp" alt="Aspiring Drummer" class="w-full rounded-xl mb-4">
                    <p class="leading-normal">
                        If you're an <strong>aspiring drummer with no experience</strong> but eager to learn the drums, we’ll start you off with the basics (even if you don’t own a drum set yet!).
                    </p>
                </div>
                <div class="">
                    <img src="https://d21q7xesnoiieh.cloudfront.net/fit-in/500x0/filters:quality(95)/marketing/drumeo/membership/welcome-offer/2beginner.webp" alt="Beginner Drummer" class="w-full rounded-xl mb-4">
                    <p class="leading-normal">
                        If you're a <strong>beginner drummer</strong> who wants to improve, our guided workouts, fun challenges, and step-by-step method will fast-track your playing.
                    </p>
                </div>
                <div class="">
                    <img src="https://d21q7xesnoiieh.cloudfront.net/fit-in/500x0/filters:quality(95)/marketing/drumeo/membership/welcome-offer/3intermediate.webp" alt="Intermediate Drummer" class="w-full rounded-xl mb-4">
                    <p class="leading-normal">
                        If you're an <strong>intermediate drummer</strong> who practices & performs regularly but needs something to fit your busy schedule, we have tons of challenging content that will test your skills.
                    </p>
                </div>
                <div class="">
                    <img src="https://d21q7xesnoiieh.cloudfront.net/fit-in/500x0/filters:quality(95)/marketing/drumeo/membership/welcome-offer/4expert.webp" alt="Expert Drummer" class="w-full rounded-xl mb-4">
                    <p class="leading-normal">
                        If you're an <strong>expert drummer</strong> who wants to learn from some of the best in the world, we’ll make you sweat with workouts from world-renowned drummers and a song library full of complex grooves.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <div class="unstick-trigger block"></div>
    <div id="customize-anchor" class="anchor"></div>
    <div id="order" class="anchor"></div>
    <section class="text-center  text-white  px-4 sm:px-6 py-10 sm:py-14 lg:py-20" style="background:#000;" x-data="{ plusMembershipSelected: true }">
        <div class="container max-w-6xl mx-auto">
            <h2 class="leading-tight mb-5"><strong>Rejoin Drumeo and save<br> on your membership.</strong></h2>
            <div id="plusOptions" class="flex flex-wrap items-start justify-center 2-full max-w-sm md:max-w-2xl lg:max-w-3xl mb-5 sm:mb-10 mx-auto" x-bind:class="{ 'hidden': !plusMembershipSelected }">
                <div class="w-full md:w-1/2 px-2 md:px-3 relative">
                    <a href="/ecommerce/add-to-cart?products[DLM-1-month]=1&locked=true&promo-code=welcomeMonth" class="text-black overflow-hidden rounded-2xl block mx-auto mb-4 md:mb-0 group border-2  border-white " aria-label="Monthly Plan">
                        <div class="bg-white px-3 py-5 md:py-7">
                            <h2 class="mb-1"><strong>Monthly</strong></h2>
                            <p class="leading-tight text-sm"><em>No bonuses.</em></p>
                            <img class="my-3 sm:my-4 h-28 lg:h-32 rounded-md transition-opacity" src="https://d21q7xesnoiieh.cloudfront.net/fit-in/570x0/filters:quality(95)/marketing/drumeo/membership/welcome-offer/monthly.webp" loading="lazy" onload="this.classList.remove('opacity-0')" alt="card image"><br>
                            <h3 class="inline-block leading-tight"><strong>$15</strong></h3><p class="inline-block leading-tight">/per month</p>
                            <p class="text-sm"><em>For your first 6 months, then $30/month.</em></p>
                            <div class="join my-5 musora-black smaller w-full transition-opacity duration-300 group-hover:opacity-80 max-w-[230px]" role="button" tabindex="0">GET STARTED  </div>
                        </div>
                    </a>
                </div>
                <div class="w-full md:w-1/2 px-2 md:px-3 relative">
                    <a href="/ecommerce/add-to-cart?products[DLM-1-year]=1&products[30-day-chops]=1&products[30-day-drummer-4]=1&locked=true&promo-code=welcome-back" class="text-black overflow-hidden rounded-2xl block mx-auto mb-4 md:mb-0 group border-2 border-drumeo" aria-label="Plan">
                        <div class="bg-white px-3 py-6 md:py-9">
                            <h2 class="mb-1"><strong>Annual</strong></h2>
                            <p class="leading-tight text-sm"><em>+ 2 Bonuses Worth $254</em></p>
                            <img class="my-3 sm:my-4 h-28 lg:h-32 rounded-md transition-opacity" src="https://d21q7xesnoiieh.cloudfront.net/fit-in/570x0/filters:quality(95)/marketing/drumeo/membership/welcome-offer/annual2.png" loading="lazy" onload="this.classList.remove('opacity-0')" alt="card image"><br>
                            <h3 class="inline-block leading-tight"><s class="opacity-50">$240</s> <strong>$180</strong></h3>
                            <p class="text-sm"><em>For your first year, then $240/yr.</em></p>
                            <div class="join my-5 musora-black smaller w-full transition-opacity duration-300 group-hover:opacity-80 max-w-[230px]" role="button" tabindex="0">GET STARTED  </div>
                            <p class="text-sm mb-1.5"><strong>FREE</strong> 30-Day Chops</p>
                            <p class="text-sm"><strong>FREE</strong> 30-Day Drummer</p>
                        </div>
                    </a>
                </div>
            </div>
            <p><em>All prices listed in USD.</em></p>
        </div>
    </section>

    @include("drumeo.sales.partials._footer")

    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script type="text/javascript" src="{{ asset('/marketing/parcel/drumeo/navigation-sales.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/@splidejs/splide@4.1.4/dist/js/splide.min.js"></script>
@endsection
