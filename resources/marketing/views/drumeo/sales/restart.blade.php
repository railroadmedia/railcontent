@extends('drumeo._partials.global-layout')

@section('global-head')
    <title>Save 50% On Your First Year</title>
    <meta property="og:title" content="Save 50% On Your First Year">
    <meta property="og:url" content="https://www.drumeo.com/{{ Request::path() }}">

    <meta name="description" content="We want you back – so you’ll get a 50% discount on your first year with Drumeo.">
    <meta property="og:description" content="We want you back – so you’ll get a 50% discount on your first year with Drumeo.">

    @hasSection('share-image')
        @yield('share-image')
    @else
        <meta property="og:image" content="https://dpwjbsxqtam5n.cloudfront.net/sales/2023/share-image-drumeo.jpg" style="display: none;">
    @endif

    @include('_partials.layout._fonts')

    <link rel="stylesheet" href="{{ mix('marketing/css/app.css') }}">
    <link href="{{ asset('/marketing/parcel/drumeo/navigation-sales.css') }}" rel="stylesheet">
    <link href="{{ asset('/marketing/css/tailwind-helpers.css') }}" rel="stylesheet">
    <link href="{{ asset('/marketing/parcel/drumeo/sales-2020.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@splidejs/splide@4.0.7/dist/css/splide.min.css">

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

        .bubble:after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 50%;
            width: 0;
            height: 0;
            border: 5px solid transparent;
            border-top-color: black;
            border-bottom: 0;
            margin-left: -5px;
            margin-bottom: -5px;
        }

        @if(!empty($trialVersion))
            .option-buttons.active {
                border-color:#0b76db!important;
                background-color:#0c2949!important;
            }
            .option-buttons.active .radio-check {
                border-color:#0b76db!important;
                background-color:#0b76db!important;
            }
            .option-buttons.active .radio-check i {
                display:block!important;
            }
        @endif
    </style>
@stop

@section('global-body')
        @include("drumeo.sales.partials._nav", [
            "subscriptionVersion" => true,
            "scrollToJoin" => true,
            "hideMenu" => true,
            "logoUrl" => Request::path(),
        ])

        <header class="sm:px-6 pb-14 pt-6 sm:pt-14 sm:pb-28 lg:pt-20 lg:pb-36 text-white" style="background:linear-gradient(to left, #0B76DB, #6500B4);">
            <div class="container max-w-6xl mx-auto">
                <div class="flex flex-wrap sm:flex-nowrap items-center">
                    <div class="w-full text-center">
                        <div class="px-5 sm:px-0">
                            <img class="h-20 sm:h-36" src="https://dpwjbsxqtam5n.cloudfront.net/promos/june/2023/header-collage.png">
                            <h1 class="rotater-text my-4 lg:my-5"><strong>Save 50% On <br class="inline sm:hidden"> Your First Year</strong></h1>
                            <h6 class="leading-normal mb-4 sm:mb-2">We want you back – so you’ll get a <strong>50% discount</strong> on your first year with Drumeo.<br>
                                <strong class="text-musora"><em>Only available until June 30th.

                                                        <span x-cloak x-data="timer()" x-init="countdown()">
                                                                     <span x-cloak x-show="timeLeft > 0 && day > 0"><span x-text="day"></span><span x-text="dayText"></span></span>
                                                                     <span x-cloak x-show="timeLeft > 0 && hour > 0"><span x-text="hour"></span><span x-text="hourText"></span></span>
                                                                     <span x-cloak x-show="timeLeft > 0 && day < 7"><span x-text="minute"></span><span x-text="minuteText"></span></span>
                                                                     <span x-cloak x-show="timeLeft > 0 && day < 7"><span x-text="second"></span><span x-text="secondText"></span></span>
                                                                     <span x-cloak x-show="timeLeft < 0">A Limited Time</span>
                                                                 </span>
                                        left!</em></strong></h6>
                            <div class="flex flex-wrap items-center justify-center sm:justify-start mt-6 sm:mt-5 lg:mt-10 mx-auto sm:max-w-xs">
                                <a class="w-full join green smaller mb-2 anchor-slide" href="#customize-anchor">SEE YOUR DEAL &raquo;</a>
                                <a aria-label="Review" class="inline-block" href="https://www.shopperapproved.com/reviews/Musora.com" target="_blank" onclick="window.open('https://www.shopperapproved.com/reviews/Musora.com', 'newwindow', 'width=750, height=550'); return false;">
                                    <i class="align-middle text-lg fas fa-star" style="color: #ffac00;"></i>
                                    <i class="align-middle text-lg -ml-3 fas fa-star" style="text-shadow: -2px -1px 1px #383bc8;color: #ffac00;"></i>
                                    <i class="align-middle text-lg -ml-3 fas fa-star" style="text-shadow: -2px -1px 1px #383bc8;color: #ffac00;"></i>
                                    <i class="align-middle text-lg -ml-3 fas fa-star" style="text-shadow: -2px -1px 1px #383bc8;color: #ffac00;"></i>
                                    <i class="align-middle text-lg -ml-3 fas fa-star" style="text-shadow: -2px -1px 1px #383bc8;color: #ffac00;"></i>
                                </a>
                                <p class="inline-block leading-tight text-sm align-middle pl-2 m-0"><em>Trusted by {{ number_format(Prices::$students) }} active students.</em></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </header>

        @php
            $features = [
                [
                    'image' => 'https://dpwjbsxqtam5n.cloudfront.net/sales/2023/drum-lessons-icon.svg',
                    'title' => 'Drum Lessons',
                    'desc' => 'Step-by-step video<br class="hidden sm:inline"> lessons on every topic.',
                ],
                [
                    'image' => 'https://dpwjbsxqtam5n.cloudfront.net/sales/2023/artist-course-icon2.svg',
                    'title' => 'Artist Courses',
                    'desc' => 'Courses and live events<br class="hidden sm:inline"> with drumming heroes. ',
                ],
                [
                    'image' => 'https://dpwjbsxqtam5n.cloudfront.net/sales/2023/songs-icon.svg',
                    'title' => '5000+ Songs',
                    'desc' => 'Play your favorite songs<br class="hidden sm:inline"> from every style & era.',
                ],
                [
                    'image' => 'https://dpwjbsxqtam5n.cloudfront.net/sales/2023/support-icon.svg',
                    'title' => '24/7 Support',
                    'desc' => 'The largest community<br class="hidden sm:inline"> of students & teachers.',
                ],
            ];
        @endphp
        <div class="container max-w-4xl mx-auto -mt-10 sm:-mt-14 lg:-mt-20">
            <div class="px-5 sm:px-0">
                <div class="flex flex-wrap sm:flex-nowrap text-center border-2 rounded-xl border-{{ $theme }} bg-white relative">
                    <div class="z-10 flex flex-wrap sm:flex-nowrap items-start justify-evenly w-full sm:w-auto sm:flex-grow py-4 sm:py-3 lg:py-4 lg:px-5 text-left sm:text-center">
                        @foreach ($features as $key => $feature)
                            <div class="flex sm:block w-full sm:w-auto px-4 sm:px-3 my-2 sm:mb-0">
                                <img
                                    src="https://www.musora.com/musora-cdn/image/{{ $feature['image'] }}"
                                    class="h-5 sm:h-7 mb-2 mr-4 sm:mr-0 transition-opacity opacity-0"
                                    alt="feature image{{$key+1}}"
                                    loading="lazy"
                                    onload="this.classList.remove('opacity-0')"
                                >
                                <p class="leading-tight mx-0"><strong class="font-black">{{ $feature['title'] }}</strong><br>
                                    <span class="text-sm">{!!  $feature['desc']  !!}</span></p>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

        <section class="pt-12 md:pt-20">
            <div class="max-w-md md:max-w-4xl mx-auto px-4 lg:px-2">
                <h3 class="font-extrabold text-center">Drumeo membership<br class="inline sm:hidden"> special pricing.</h3>
                <p class="text-center mt-3 mb-6">You’ll have one year of unlimited<br class="inline sm:hidden">  drum lessons, including:</p>
                <div class="md:grid md:grid-cols-3 md:gap-4">
                    <div class="relative rounded-xl overflow-hidden mb-3 md:mb-0" style="background-color:#F6F8FC;">
                        <div class="w-full aspect-16:9 bg-cover bg-center lazyload" data-bg="https://www.musora.com/musora-cdn/image/width=700,quality=85/https://dpwjbsxqtam5n.cloudfront.net/sales/2022/thumb-method.jpg"></div>
                        <div class=" px-3 lg:px-4 py-5 lg:py-7 text-center">
                            <i class="text-4xl align-middle icon-drums2 text-drumeo"></i>
                            <img class="h-5 ml-2 imgfilter-method lazyload" data-src="https://www.musora.com/musora-cdn/image/width=200,quality=85/https://dpwjbsxqtam5n.cloudfront.net/sales/2021/method-text.svg" alt="method-text">
                            <p class="mt-2">
                                Step-by-step lessons for the next stage of your drumming.
                            </p>
                        </div>
                    </div>
                    <div class="relative rounded-xl overflow-hidden mb-3 md:mb-0" style="background-color:#F6F8FC;">
                        <div class="w-full aspect-16:9 bg-cover bg-center lazyload" data-bg="https://www.musora.com/musora-cdn/image/width=700,quality=85/https://dpwjbsxqtam5n.cloudfront.net/promos/june/2023/drumeo-songs.jpg"></div>
                        <div class="px-3 lg:px-4 py-5 lg:py-7 text-center">
                            <i class="text-4xl align-middle icon-songs text-songs"></i>
                            <img class="h-5 ml-2 imgfilter-songs lazyload" data-src="https://www.musora.com/musora-cdn/image/width=150,quality=85/https://dpwjbsxqtam5n.cloudfront.net/sales/2021/songs-text.svg" alt="songs-text">
                            <p class="mt-2">
                                Easy access to 5000+ famous drum songs with play-along tools.
                            </p>
                        </div>
                    </div>
                    <div class="relative rounded-xl overflow-hidden" style="background-color:#F6F8FC;">
                        <div class="w-full aspect-16:9 bg-cover bg-center lazyload" data-bg="https://www.musora.com/musora-cdn/image/width=700,quality=85/https://dpwjbsxqtam5n.cloudfront.net/promos/june/2023/drumeo-coaches.jpg"></div>
                        <div class="px-3 lg:px-4 py-5 lg:py-7 text-center">
                            <img class="h-8 icon imgfilter-coaches lazyload" data-src="https://www.musora.com/musora-cdn/image/width=100,quality=85/https://dpwjbsxqtam5n.cloudfront.net/sales/2021/coaches-icon.svg" alt="coaches-icon">
                            <img class="h-5 ml-2 imgfilter-coaches lazyload" data-src="https://cdn.musora.com/image/fetch/q_auto:best/https://dpwjbsxqtam5n.cloudfront.net/sales/2021/coaches-text.svg" alt="coaches-text">
                            <p class="mt-2">
                                Personalized support for ALL your drumming questions.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        @php
            $testimonials = [
                [
                'image' => 'https://dpwjbsxqtam5n.cloudfront.net/sales/testimonials/ed-koop.jpg',
                'name' => 'Ed Koop',
                'video' => '342059271',
                'title' => 'I’m loving music more than I ever did before!',
                'description' => 'After 20 years away from the drums, Ed says he’s loving music more than ever. He nailed his first audition and has now played at the venues of his dreams.',
                ],
                [
                'image' => 'https://dpwjbsxqtam5n.cloudfront.net/sales/testimonials/barry-lisle.jpg',
                'name' => 'Barry Lisle',
                'video' => '342066433',
                'title' => 'They walk you through, step-by-step, for any goal.',
                'description' => 'Barry wanted something to keep his mind busy, so he revisited the instrument he’d loved as a kid: the drums. Now he’s playing in bands and recording an album.',
                ],
                [
                'image' => 'https://dpwjbsxqtam5n.cloudfront.net/sales/testimonials/lisa-aragon.jpg',
                'name' => 'Lisa Aragon',
                'video' => '373252004',
                'title' => 'I was able to play drums on stage!',
                'description' => 'Lisa got interested in the drums by playing Rock Band. She had no idea she’d be performing with strangers in Nashville just a few years later.',
                ],
                [
                'image' => 'https://dpwjbsxqtam5n.cloudfront.net/sales/testimonials/guy-dobbins.jpg',
                'name' => 'Guy Dobbins',
                'video' => '373445704',
                'title' => 'Drummers from all around the world helping you out.',
                'description' => 'Guy had trouble figuring out a song, he reached out and an instructor walked him through it that same day - getting him through the gig that evening.',
                ],
                [
                'image' => 'https://i.vimeocdn.com/video/1143532818-61ead907372040ae51f23b9d5f05469c271aee744e9cb67e777ae4307f762b23-d_620.jpg',
                'name' => 'Omari Augustine',
                'video' => '553438851',
                'title' => 'Something you can’t get from having a drum teacher.',
                'description' => 'Omari had big shoes to fill. His father was already an accomplished drummer in Trinidad & Tobago when Omari decided to take his drumming to the next level.',
                ],
                [
                'image' => 'https://dpwjbsxqtam5n.cloudfront.net/sales/testimonials/marlene-rosen.jpg',
                'name' => 'Marlene Rosen',
                'video' => '373446024',
                'title' => 'I’m rediscovering music again.',
                'description' => 'Marlene, a cancer survivor, filled her recovery time with drumming and was able to progress at a pace that worked for her.',
                ],
                [
                'image' => 'https://dpwjbsxqtam5n.cloudfront.net/sales/testimonials/jay-damberg-2.jpg',
                'name' => 'Jay Damberg',
                'video' => '373445466',
                'title' => 'Anytime, day or night, I can access the lessons I need.',
                'description' => 'With a full-time job and a family, Jay often can’t practice drums until late at night, which is why he loves being able to access Drumeo whenever he wants.',
                ],
                [
                'image' => 'https://dpwjbsxqtam5n.cloudfront.net/sales/testimonials/ivy-elizondo-2.jpg',
                'name' => 'Ivy Elizondo',
                'video' => '373445819',
                'title' => 'Now we have a band and we’re recording an album!',
                'description' => 'When Ivy’s kids decided to stop playing drums, she jumped on the throne instead -- she’s used Drumeo to build a foundation and formed a band.',
                ],
            ]
        @endphp
        @include('musora.sales.components.testimonials-section', [
            'header' => 'Your friends would love to see<br class="hidden sm:inline-block">   you back in the comments.',
            'reviewText' => '
            Rejoin a thriving community of drummers of all skill-levels<br class="hidden sm:inline-block"> learning the world’s greatest instrument.',
        ])

        <section class="pb-12 md:pb-20">
            <div class="mx-auto md:max-w-3xl lg:max-w-4xl grid grid-cols-1 sm:grid-cols-3 gap-6 px-4 lg:px-0 mb-10">
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

        @include('musora.sales.components.guarantee-section', [
            'badge' => 'https://dpwjbsxqtam5n.cloudfront.net/sales/2022/guarantee.png',
            'header' => '<strong>Happy “welcome back” guarantee.</strong><br>Test-drive your lessons for 90 days. Zero risk.',
            'desc' => 'More than anything, we want to make sure you have a POSITIVE experience developing new skills and gaining confidence when you rejoin Drumeo. Which is why you’ll have 90 days risk-free to try everything again and make sure you love it.',
        ])

        <div class="unstick-trigger block"></div>
        <div id="customize-anchor" class="anchor"></div>
        <div id="order" class="anchor"></div>
        <section class="py-14 sm:py-20 lg:py-24 relative overflow-hidden text-white text-center customize px-4 lg:px-6" style="background:linear-gradient(to left, #0B76DB, #6500B4);">
            <div class="container mx-auto max-w-6xl relative z-50">
                <div class="w-full">
                    <div class="bonus-wrap relative inline-block align-top mx-auto px-1 md:px-3 w-full max-w-xs">
                        <div class=" inline-block relative w-full group" style="padding-bottom: 62%;perspective: 1000px;">
                            <div class="text-center w-full h-full absolute" style="transform-style: preserve-3d;">
                                <div class="  front absolute z-20 overflow-hidden rounded-3xl w-full h-full transition-transform duration-700" style="backface-visibility: hidden;">
                                    <div class="h-full w-full bg-top bg-contain bg-no-repeat" style="background-image:url(https://www.musora.com/musora-cdn/image/width=850,quality=85/https://dpwjbsxqtam5n.cloudfront.net/promos/june/2023/membership-badge.png);"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <br>
                    <h3 class="leading-tight mt-4 sm:mt-5"><strong>Restart your <span class="hidden sm:inline">Drumeo</span> Membership<br class="hidden sm:inline">  today and save 50%.</strong></h3>
                    <p class="leading-tight my-3 sm:my-4 text-musora font-black"><strong><em>Only available until June 30th.
                                <span x-cloak x-data="timer()" x-init="countdown()">
                                                                     <span x-cloak x-show="timeLeft > 0 && day > 0"><span x-text="day"></span><span x-text="dayText"></span></span>
                                                                     <span x-cloak x-show="timeLeft > 0 && hour > 0"><span x-text="hour"></span><span x-text="hourText"></span></span>
                                                                     <span x-cloak x-show="timeLeft > 0 && day < 7"><span x-text="minute"></span><span x-text="minuteText"></span></span>
                                                                     <span x-cloak x-show="timeLeft > 0 && day < 7"><span x-text="second"></span><span x-text="secondText"></span></span>
                                                                     <span x-cloak x-show="timeLeft < 0">A Limited Time</span>
                                                                 </span>
                                left!</em></strong></p>

                    <h3 class="leading-tight mb-1"><strong>Only</strong> <s class="opacity-50">$240</s> <strong>$120</strong></h3>
                    <p class="leading-tight text-sm mb-5"><em>Renews at $240 after your first year.</em></p>
                </div>
                <a class="join green" href="https://www.musora.com/ecommerce/add-to-cart?products[musora-access-1-year]=1&promo-code=win-back&locked=true">GET Started »</a>
            </div>
        </section>

        @include("drumeo.sales.partials._footer")
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script type="text/javascript" src="{{ asset('/marketing/parcel/drumeo/navigation-sales.js') }}"></script>

    <script src="https://cdn.jsdelivr.net/npm/@splidejs/splide@4.0.7/dist/js/splide.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/lazysizes/5.3.2/lazysizes.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/lazysizes/5.3.2/plugins/unveilhooks/ls.unveilhooks.min.js"></script>

        @include('_partials.components.countdown',[
        'countdownDate' => '2023-07-01 00:00:00',
        'promoVersion' => false
        ])
@stop
