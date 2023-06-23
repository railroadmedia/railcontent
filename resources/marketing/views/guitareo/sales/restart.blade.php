@extends('guitareo._partials.global-layout')

@section('global-head')
    <title>Save 50% On Your First Year</title>
    <meta property="og:title" content="Save 50% On Your First Year">
    <meta property="og:url" content="https://www.guitareo.com/">

    <meta name="description" content="We want you back – so you’ll get a 50% discount on your first year with Guitareo.">
    <meta property="og:description" content="We want you back – so you’ll get a 50% discount on your first year with Guitareo.">

    @hasSection('share-image')
        @yield('share-image')
    @else
        <meta property="og:image" content="https://d122ay5chh2hr5.cloudfront.net/sales/2023/share-image-guitareo.jpg"/>
    @endif

    @include('_partials.layout._fonts')

    <link rel="stylesheet" href="{{ mix('marketing/css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('/marketing/css/tailwind-helpers.css') }}">
    <link rel="stylesheet" href="{{ asset('/marketing/parcel/drumeo/nav-footer-guitareo.css') }}">
    <link rel="stylesheet" href="{{ asset('/marketing/parcel/drumeo/sales-page-guitareo.css') }}">
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
            fill: #00c9ac !important;
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


    .join.green {
                 background: #10D05F;

        }
        .join:hover,
        .join:focus {
             background: #13eb6d;
         }
    </style>
@stop

@section('global-body')
    @include("guitareo.sales.partials._nav", [
        "subscriptionVersion" => true,
        "scrollToJoin" => true,
        "hideMenu" => true,
    ])

        <header class="sm:px-6 pb-14 pt-6 sm:pt-14 sm:pb-28 lg:pt-20 lg:pb-36 text-white" style="background:linear-gradient(to left, #00C9AC, #005BAE);">
            <div class="container max-w-6xl mx-auto">
                <div class="flex flex-wrap sm:flex-nowrap items-center">
                    <div class="w-full text-center">
                        <div class="px-5 sm:px-0">
                            <img class="h-20 sm:h-36" src="https://d122ay5chh2hr5.cloudfront.net/sales/promos/june/header-collage.png">
                            <h1 class="rotater-text my-4 lg:my-5"><strong>Save 50% On <br class="inline sm:hidden"> Your First Year</strong></h1>
                            <h6 class="leading-normal mb-4 sm:mb-2">We want you back – so you’ll get a <strong>50% discount</strong> on your first year with Guitareo.<br>
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
                                    <i class="align-middle text-lg -ml-3 fas fa-star" style="text-shadow: -2px -1px 1px #0088ad;color: #ffac00;"></i>
                                    <i class="align-middle text-lg -ml-3 fas fa-star" style="text-shadow: -2px -1px 1px #0088ad;color: #ffac00;"></i>
                                    <i class="align-middle text-lg -ml-3 fas fa-star" style="text-shadow: -2px -1px 1px #0088ad;color: #ffac00;"></i>
                                    <i class="align-middle text-lg -ml-3 fas fa-star" style="text-shadow: -2px -1px 1px #0088ad;color: #ffac00;"></i>
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
                    'image' => 'https://d122ay5chh2hr5.cloudfront.net/sales/2023/guitar-lessons-icon.svg',
                    'title' => 'Guitar Lessons',
                    'desc' => 'Step-by-step video <br class="hidden sm:inline"> lessons on every topic.',
                ],
                [
                    'image' => 'https://d122ay5chh2hr5.cloudfront.net/sales/2023/artist-courses-icon.svg',
                    'title' => 'Artist Courses',
                    'desc' => 'Courses and live events<br class="hidden sm:inline"> with inspiring guitarists. ',
                ],
                [
                    'image' => 'https://d122ay5chh2hr5.cloudfront.net/sales/2023/songs-icon.svg',
                    'title' => '1000+ Songs',
                    'desc' => 'Play your favorite songs<br class="hidden sm:inline"> from every style & era.',
                ],
                [
                    'image' => 'https://d122ay5chh2hr5.cloudfront.net/sales/2023/support-icon.svg',
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
                <h3 class="font-extrabold text-center">Guitareo membership<br class="inline sm:hidden"> special pricing.</h3>
                <p class="text-center mt-3 mb-6">You’ll have one year of unlimited<br class="inline sm:hidden">  guitar lessons, including:</p>
                <div class="md:grid md:grid-cols-3 md:gap-4">
                    <div class="relative rounded-xl overflow-hidden mb-3 md:mb-0" style="background-color:#F6F8FC;">
                        <div class="w-full aspect-16:9 bg-cover bg-center lazyload" data-bg="https://www.musora.com/musora-cdn/image/width=700,quality=85/https://d122ay5chh2hr5.cloudfront.net/sales/promos/june/guitareo-method.jpg"></div>
                        <div class=" px-3 lg:px-4 py-5 lg:py-7 text-center">
                            <img class="h-5 lazyload" data-src="https://www.musora.com/musora-cdn/image/width=200,quality=85/https://d122ay5chh2hr5.cloudfront.net/sales/promos/june/guitareo-method-logo.svg" alt="method-text">
                            <p class="mt-2">
                                Step-by-step lessons for the next stage of your guitar playing.
                            </p>
                        </div>
                    </div>
                    <div class="relative rounded-xl overflow-hidden mb-3 md:mb-0" style="background-color:#F6F8FC;">
                        <div class="w-full aspect-16:9 bg-cover bg-center lazyload" data-bg="https://www.musora.com/musora-cdn/image/width=700,quality=85/https://d122ay5chh2hr5.cloudfront.net/sales/promos/june/guitareo-songs.jpg"></div>
                        <div class="px-3 lg:px-4 py-5 lg:py-7 text-center">
                            <img class="h-5 lazyload" data-src="https://www.musora.com/musora-cdn/image/width=150,quality=85/https://d122ay5chh2hr5.cloudfront.net/sales/promos/june/guitareo-songs-logo.svg" alt="songs-text">
                            <p class="mt-2">
                                Easy access to 1000+ famous songs with play-along tools.
                            </p>
                        </div>
                    </div>
                    <div class="relative rounded-xl overflow-hidden" style="background-color:#F6F8FC;">
                        <div class="w-full aspect-16:9 bg-cover bg-center lazyload" data-bg="https://www.musora.com/musora-cdn/image/width=700,quality=85/https://d122ay5chh2hr5.cloudfront.net/sales/promos/june/guitareo-coaches.jpg"></div>
                        <div class="px-3 lg:px-4 py-5 lg:py-7 text-center">
                            <img class="h-5 lazyload" data-src="https://cdn.musora.com/image/fetch/q_auto:best/https://d122ay5chh2hr5.cloudfront.net/sales/promos/june/guitareo-coaches-logo.svg" alt="coaches-text">
                            <p class="mt-2">
                                Personalize support for all of your guitar playing questions.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        @php
            $testimonials = [
                [
                'title' => "I’m lightyears ahead of where I was.",
                'description' => "I’ve come so far in such a short period of time. I’ve gone from not even knowing what palm muting was to noodling with the E & A string pentatonic shapes and creating melodies with it – and using it to work on my vibrato, slides, and bends. And I’ve gained priceless info like knowing where to place chords, start power chords, and scale shapes.<br><br>Having the breakthroughs I’ve had so far has brought me confidence and kept me sane while the world is seemingly not – and made me believe there is still a bright future ahead. As I progress, I feel supported towards achieving my goals of jamming with others and using my love for writing to start telling stories through music. All in due time.<br><br>I’m lightyears ahead of where I was at. And no matter where I go, or however tough things get, I’ll always have one of my guitars in the passenger seat and we’ll always be there for each other. The life long journey has begun!",
                'name' => 'Ërlik Sörensen',
                'image' => 'https://d122ay5chh2hr5.cloudfront.net/sales/2022/testimonials/erliksorensen.jpg',
                'location' => 'British Columbia, Canada',
                ],
                [
                'title' => "The frustration is over.",
                'description' => "I’m already playing things that were a nightmare to me before. Strumming patterns, smoothly changing chords, and improvisation of different scales. I’m even playing songs using my own chord progressions and pentatonic scales. I’m enjoying listening to myself play and proud of my progress!<br><br>The frustration is over. Guitareo has what a guitarist wants and it’s been a fun and easy learning experience.",
                'name' => 'Vetriselvi Senguttuvan',
                'image' => 'https://d122ay5chh2hr5.cloudfront.net/sales/2022/testimonials/vetriselvisenguttuvan.jpg',
                'location' => 'India',
                ],
                [
                'title' => "I’ve never felt so much JOY playing the guitar.",
                'description' => "When I finished the first lesson, I had a feeling of joy that I’ve never had before when playing guitar. I'm experimenting a lot more and improving my technique. The goal-based learning makes each set of lessons more entertaining and a feeling of accomplishment when completed.",
                'name' => 'Jamie K',
                'image' => 'https://d122ay5chh2hr5.cloudfront.net/guitarquest/assets/testimonials/jamie-nova-scotia.jpg',
                'location' => 'Nova Scotia, Canada',
                ],
                [
                'title' => "I finally feel like I’m able to learn the guitar.",
                'description' => "Guitareo focuses on smaller tasks and achievements along the way to make you feel like you’re improving. In level four of GuitarQuest, I played the G chord for the first time without any pain in my hands. I finally feel like I’ll really be able to learn the guitar and succeed! This course is SO much fun and keeps me motivated!",
                'name' => 'Patrizia K',
                'image' => 'https://d122ay5chh2hr5.cloudfront.net/guitarquest/assets/testimonials/patrizia-germany.jpg',
                'location' => 'Germany',
                ],
                [
                'title' => "I like the sincerity, knowledge, and positivity.",
                'description' => "The internet is a nice resource for ideas, methods, tips, and tricks, but there is no linear method. I have to create one on my own, and I don’t want to teach guitar. I want to play.<br><br>So I joined Guitareo because I like the sincerity, knowledge, and positivity. Nate introduced me to the Million Dollar Progression. And Ayla showed me how to solo using backing tracks. They got me started on my journey and gave me confidence. Now I’m excited to practice. My Fender Hellcat seems to fit into my hands and against my body like it didn’t before. And I can actually say “I’m a guitarist!” Well, how about that!",
                'name' => 'Jim McKenna',
                'image' => 'https://d122ay5chh2hr5.cloudfront.net/sales/2022/testimonials/jimmckenna.jpg',
                'location' => 'Illinois, USA',
                ],
                [
                'title' => "I’ve started making my own melodies.",
                'description' => "Guitareo has been fun and motivated me to try more. I like how we start making melodies quickly along with helpful background information on chords and notes. I love seeing other students post their melodies -- it’s so much fun to listen to others!",
                'name' => 'Jan M',
                'image' => 'https://d122ay5chh2hr5.cloudfront.net/guitarquest/assets/testimonials/jan-berlin-germany.jpg',
                'location' => 'Germany',
                ],
                [
                'title' => "I feel happy and more confident while playing. ",
                'description' => "I had classical guitar lessons 15 years ago and since then I’ve wanted to play acoustic and electric guitar. I’ve been trying to figure them out on my own and it was frustrating – trying to play pentatonics, or mute strings. And then I found out about Guitareo!<br><br>I feel happy and more confident while playing, even though it’s pretty early. I played my first song with mini barre chords and actually enjoyed it. I’ve never done that before! And I even sent a video playing a punk play-along song to a friend (and I normally never play guitar in front of friends). I would definitely recommend Guitareo. You have done really good work and I personally thank you for that!",
                'name' => 'Athina Katri',
                'image' => 'https://d122ay5chh2hr5.cloudfront.net/sales/2022/testimonials/athinakatri.jpg',
                'location' => 'Greece',
                ],
                [
                'title' => "I’m holding my own while still having fun!",
                'description' => "I was skeptical at first. I’ve seen online lesson sites that are really bad, so I started with a monthly subscription. After going through the beginner lessons, I saw that Guitareo was totally different from other sites. I’ve had a guitar for years and struggled to play anything more than G, C, and D – and I always had trouble learning new chords and progressions. Guitareo’s lessons helped me advance and have more fun playing the guitar.<br><br>I have broken through doors that were closed to me several times. Things that I’ve struggled with for years have been explained in ways that make sense – and the Guitareo instructors have helped me become more comfortable. Now I’m able to sit in with friends that are way better players than me and hold my own while still having fun!",
                'name' => 'WJ Williams',
                'image' => 'https://d122ay5chh2hr5.cloudfront.net/sales/2022/testimonials/williamwilliams.jpg',
                'location' => 'Georgia, USA',
                ],
            ]
        @endphp
        @include('musora.sales.components.testimonials-section', [
            'header' => 'Your friends would love to see<br class="hidden sm:inline-block">   you back in the comments.',
            'reviewText' => 'Rejoin a thriving community of guitar players of all skill-levels<br class="hidden sm:inline-block">  learning this amazing instrument.',
        ])

        @include('musora.sales.components.guarantee-section', [
        'badge' => 'https://d122ay5chh2hr5.cloudfront.net/sales/2022/guitareo-guarantee.png',
            'header' => '<strong>Happy “welcome back” guarantee.</strong><br>Test-drive your lessons for 90 days. Zero risk.',
            'desc' => 'More than anything, we want to make sure you have a POSITIVE experience developing new skills and gaining confidence when you rejoin Guitareo. Which is why you’ll have 90 days risk-free to try everything again and make sure you love it.',
        ])

        <div class="unstick-trigger block"></div>
        <div id="customize-anchor" class="anchor"></div>
        <div id="order" class="anchor"></div>
        <section class="py-14 sm:py-20 lg:py-24 relative overflow-hidden text-white text-center customize px-4 lg:px-6" style="background:linear-gradient(to left, #00C9AC, #005BAE);">
            <div class="container mx-auto max-w-6xl relative z-50">
                <div class="w-full">
                    <div class="bonus-wrap relative inline-block align-top mx-auto px-1 md:px-3 w-full max-w-xs">
                        <div class=" inline-block relative w-full group" style="padding-bottom: 62%;perspective: 1000px;">
                            <div class="text-center w-full h-full absolute" style="transform-style: preserve-3d;">
                                <div class="  front absolute z-20 overflow-hidden rounded-3xl w-full h-full transition-transform duration-700" style="backface-visibility: hidden;">
                                    <div class="h-full w-full bg-top bg-contain bg-no-repeat" style="background-image:url(https://www.musora.com/musora-cdn/image/width=850,quality=85/https://d122ay5chh2hr5.cloudfront.net/sales/promos/june/membership-badge.png);"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <br>
                    <h3 class="leading-tight mt-4 sm:mt-5"><strong>Restart your <span class="hidden sm:inline">Guitareo</span> Membership<br class="hidden sm:inline">  today and save 50%.</strong></h3>
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

    @include("guitareo.sales.partials._footer")
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
