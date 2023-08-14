@extends('drumeo._partials.global-layout')

@section('global-head')
    <title>Drumeo | Reach your drumming goals.</title>
    <meta property="og:title" content="Drumeo | Reach your drumming goals.">

    <meta name="description" content="Learn the drums faster with organized video lessons, legendary teachers, and better practice tools. 90-Day Guarantee.">
    <meta property="og:description" content="Learn the drums faster with organized video lessons, legendary teachers, and better practice tools. 90-Day Guarantee.">

    <meta property="og:image" content="https://dpwjbsxqtam5n.cloudfront.net/sales/2023/share-image-drumeo.jpg" style="display: none;">
    <meta property="og:url" content="https://www.drumeo.com/">

    @include('_partials.layout._fonts')

    @include('_partials.layout._tailwindcdn')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.css" />
    <link href="{{ asset('/marketing/css/tailwind-helpers.css') }}" rel="stylesheet">
    <link href="{{ asset('/marketing/parcel/drumeo/sales-2020.css') }}" rel="stylesheet">
    <link href="{{ asset('/marketing/parcel/drumeo/navigation-sales.css') }}" rel="stylesheet">
    <style>
        .slick-2 .flip-div,
        .slick-2 .flip-div .bg-image {
            padding-bottom: 120%;
        }
        @media (min-width: 768px) {
            .slick-2 .flip-div,
            .slick-2 .flip-div .bg-image {
                padding-bottom: 167%;
            }
        }
        .slick .flip-div,
        .slick .flip-div .bg-image {
            padding-bottom: 100%;
        }
        .slick .flip-div.flipped .front,
        .slick-2 .flip-div.flipped .front {
            -ms-transform: rotateY(180deg);
            -webkit-transform: rotateY(180deg);
            transform: rotateY(180deg);
        }
        .slick .flip-div.flipped .back,
        .slick-2 .flip-div.flipped .back {
            -ms-transform: rotateY(0deg);
            -webkit-transform: rotateY(0deg);
            transform: rotateY(0deg);
        }
        .slick .flip-div .back,
        .slick-2 .flip-div .back {
            -ms-transform: rotateY(-180deg);
            -webkit-transform: rotateY(-180deg);
            transform: rotateY(-180deg);
        }
        .slick-2 .flip-div .front,
        .slick-2 .flip-div .back,
        .slick .flip-div .front,
        .slick .flip-div .back {
            -ms-transition: transform 0.8s;
            -webkit-transition: transform 0.8s;
            transition: transform 0.8s;
            -ms-backface-visibility: hidden;
            -webkit-backface-visibility: hidden;
            backface-visibility: hidden;
        }

        .timeline-line:after {
            content:' ';
            left:50%;
            width:100%;
            height:7px;
            position:absolute;
            background:#0b76db;
            top:25px;
            z-index:1;
        }
        @media (min-width: 768px) {
            .timeline-line:after {
                top: 35px;
            }

        }

        .img-toggle.active {
            opacity:1;
        }
    </style>
@stop

@section('global-body')
    @include("drumeo.sales.partials._nav", [
        "subscriptionVersion" => true,
        "fullSubscriptionVersion" => true,
    ])

    <section class="text-white relative z-10 overflow-hidden px-4 md:px-8 py-8 md:py-40 lg:py-52 bg-cover bg-center lazyload" style="background-color:#163146;" data-bg="https://www.musora.com/musora-cdn/image/width=2000,quality=95/https://dpwjbsxqtam5n.cloudfront.net/sales/about/Header_BG.jpg">
        <div class="container mx-auto relative z-10 max-w-5xl">
            <p class="text-light-navy mb-1 mx-0 max-w-xs sm:max-w-sm lg:max-w-lg pr-6 sm:pr-0"><em>Marlene Rosen, Drumeo student</em></p>
            <h2><strong>"It’s like having a teacher<br> right in front of you"</strong></h2>
            <p class="text-light-navy my-2 sm:my-4 lg:my-7 mx-0 max-w-xs sm:max-w-sm lg:max-w-lg pr-6 sm:pr-0">Get online drum lessons, step-by-step video courses, and an awesome community you can access from anywhere, anytime.</p>
            <a class="join blue smaller mb-2 sm:mb-3 lg:mb-0" href="/">How It Works</a><br class="inline lg:hidden">
            <a class="join smaller outline mb-2 sm:mb-0" href="https://www.musora.com/careers">JOIN OUR TEAM</a><br class="inline sm:hidden">
            <a class="join smaller outline" href="{{ get_musora_brand_base_url() }}/contact">CONTACT US</a>
        </div>
    </section>
    <section class="text-white relative z-10 overflow-hidden px-4 md:px-8 py-8 md:py-14 bg-cover bg-center bg-musora-black">
        <div class="container mx-auto relative z-10 max-w-5xl">
            <div class="flex flex-wrap sm:flex-nowrap lg:items-center">
                <div class="coaches w-full sm:w-5/12 lg:w-1/2 mb-5 sm:mb-0 sm:pl-5 mx-auto sm:order-1 text-center">
                    <img class="h-64 sm:h-auto" src="https://www.musora.com/musora-cdn/image/width=1200,quality=95/https://dpwjbsxqtam5n.cloudfront.net/sales/about/Collage_1.png">
                </div>
                <div class="p-5 sm:p-8 rounded-xl w-full sm:w-7/12 lg:w-1/2" style="background:#1d232f;">
                    <h3 class="mb-3"><strong>Online Drum Lessons For Everyone.</strong></h3>
                    <p class="text-light-navy">Drumeo is the world’s biggest online drum education platform. You might know us from our world-class drum videos, our supportive community, or our awesome Drumeo Coaches.
                        <br><br>
                        We bring the world’s best drummers and teachers into our studio (located in beautiful British Columbia, Canada) to provide students with practical lesson videos, thoughtful courses, inspirational performances, personalized feedback, live Q&As, and the opportunity to be part of a global community.
                        <br><br>
                        On top of that, imagine thousands of tracks to play along to, exclusive song-learning tools, and dozens of Netflix-style drumming shows to educate and entertain. That’s Drumeo.</p>
                </div>
            </div>
            <div class="flex justify-center items-center my-12 sm:my-16 lg:my-20">
                <i class="text-3xl sm:text-5xl text-drumeo fa-light fa-calendar-clock"></i>
                <div class="pl-3 sm:pl-4 text-left">
                    <p class="leading-tight text-light-navy">Our friendly student experience team is available</p>
                    <h1 class="uppercase font-bebas leading-none my-1.5">8am-6pm PST, 7 days a week</h1>
                    <p class="leading-tight text-light-navy">to answer questions (whether you’re a student or not).</p>
                </div>
            </div>


            <div class="flex flex-wrap sm:flex-nowrap items-center">
                <div class="coaches w-full sm:w-1/2 sm:pr-5 mb-5 sm:mb-0 text-center">
                    <img class="h-52 sm:h-auto" src="https://www.musora.com/musora-cdn/image/width=1200,quality=95/https://dpwjbsxqtam5n.cloudfront.net/sales/about/Collage_2.png">
                </div>
                <div class="p-6 rounded-xl w-full sm:w-1/2" style="background:#1d232f;">
                    <h3><strong>This is the dream team.</strong></h3>
                    <p class="text-light-navy mt-3">We’re a people-centric company built by dozens of passionate musicians and music-lovers from around the world. It’s not just a creative and collaborative place to work - it’s a place where we can make a global impact.</p>
                </div>
            </div>
        </div>
    </section>


    <section class="text-white relative z-10 overflow-hidden px-4 md:px-8 py-8 sm:py-14 bg-cover bg-center" style="background:#010411;">
        <div class="container mx-auto relative z-10 max-w-5xl">
            <div class="flex flex-wrap sm:flex-nowrap">
                <div class="p-5 sm:p-0 w-full sm:w-5/12 lg:w-4/12">
                    <h3><strong>We’ve been doing this for a long time.</strong></h3>
                    <p class="text-light-navy mt-3">Drumeo started as a way to reach more students and create a community that wasn’t possible with traditional one-on-one lessons.
                        <br><br>
                        While we launched Drumeo in 2012, we’ve actually been helping drum students online for a lot longer.</p>
                </div>
                <div class="w-full sm:w-7/12 lg:w-8/12 sm:pl-5">
                    <div class="relative overflow-hidden mx-auto pb-12 md:pb-0 mt-7 md:mt-0 max-w-md md:max-w-3xl lg:max-w-full" style="max-height: 340px;">
                        <div class="inside-scroll-element mx-auto w-11/12">
                            <div class="timeline-line relative px-1.5 lg:px-2.5">
                                <div class="relative z-10 rounded-xl text-center py-3" style="background-color:#1d232f;">
                                    <h1 class="font-bebas leading-none">2003</h1>
                                    <img class="my-2.5" src="https://www.musora.com/musora-cdn/image/width=430,quality=95/https://dpwjbsxqtam5n.cloudfront.net/sales/about/BreakSticks.jpg" alt="timeline">
                                    <p class="text-left text-sm px-2 text-light-navy mx-auto leading-tight whitespace-pre-wrap">Drumeo’s founders launched their first online community at BreakSticks.com.</p>
                                </div>
                            </div>
                            <div class="timeline-line relative px-1.5 lg:px-2.5">
                                <div class="relative z-10 rounded-xl text-center py-3" style="background-color:#1d232f;">
                                    <h1 class="font-bebas leading-none">2005</h1>
                                    <img class="my-2.5" src="https://www.musora.com/musora-cdn/image/width=430,quality=95/https://dpwjbsxqtam5n.cloudfront.net/sales/about/RailRoad+Media.jpg" alt="timeline">
                                    <p class="text-left text-sm px-2 text-light-navy mx-auto leading-tight whitespace-pre-wrap">The company became ‘Railroad Media’, putting out drum lesson DVDs and continuing to support their online community.</p>
                                </div>
                            </div>
                            <div class="timeline-line relative px-1.5 lg:px-2.5">
                                <div class="relative z-10 rounded-xl text-center py-3" style="background-color:#1d232f;">
                                    <h1 class="font-bebas leading-none">2007</h1>
                                    <img class="my-2.5" src="https://www.musora.com/musora-cdn/image/width=430,quality=95/https://dpwjbsxqtam5n.cloudfront.net/sales/about/DrumLesson.jpg" alt="timeline">
                                    <p class="text-left text-sm px-2 text-light-navy mx-auto leading-tight whitespace-pre-wrap">The growing team launched FreeDrumLessons.com.</p>
                                </div>
                            </div>
                            <div class="timeline-line relative px-1.5 lg:px-2.5">
                                <div class="relative z-10 rounded-xl text-center py-3" style="background-color:#1d232f;">
                                    <h1 class="font-bebas leading-none">2012</h1>
                                    <img class="my-2.5" src="https://www.musora.com/musora-cdn/image/width=430,quality=95/https://dpwjbsxqtam5n.cloudfront.net/sales/about/Drumeo.jpg" alt="timeline">
                                    <p class="text-left text-sm px-2 text-light-navy mx-auto leading-tight whitespace-pre-wrap">Drumeo was born!</p>
                                </div>
                            </div>
                            <div class="relative px-1.5 lg:px-2.5">
                                <div class="relative z-10 rounded-xl text-center py-3" style="background-color:#1d232f;">
                                    <h1 class="font-bebas leading-none">2021</h1>
                                    <img class="my-2.5" src="https://www.musora.com/musora-cdn/image/width=430,quality=95/https://dpwjbsxqtam5n.cloudfront.net/sales/about/musora.png" alt="timeline">
                                    <p class="text-left text-sm px-2 text-light-navy mx-auto leading-tight whitespace-pre-wrap">We started offering similar platforms for other instruments under the Musora brand.</p>
                                </div>
                            </div>
                        </div>
                        <div class="absolute top-0 bottom-0 right-0 w-1/5" style="background:linear-gradient(to right, transparent, #010411);"></div>
                        <div class="absolute top-0 bottom-0 left-0 w-1/5" style="background:linear-gradient(to left, transparent, #010411);"></div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="text-white text-center relative z-10 overflow-hidden px-2 py-8 md:py-14 bg-cover bg-center bg-musora-black">
        <div class="container mx-auto max-w-6xl">
            <h3 class="" data-aos="fade-up"><strong>More than just drum lessons.</strong></h3>
            <p class="text-light-navy mt-1.5 mb-6">Drumeo is one brand under <a href="https://www.musora.com/"><u>Musora</u></a>: a group of organizations that help musicians<br class="hidden sm:inline"> develop their skills and connect with others. Let’s make music together!</p>
            <div class="flex flex-wrap sm:flex-nowrap">
                <div class="mb-4 sm:mb-0 w-full sm:w-1/3 px-3">
                    <a target="_blank" href="https://www.pianote.com/"><img class="h-8 lg:h-10 lazyload" data-src="https://d2vyvo0tyx8ig5.cloudfront.net/logo/pianote-logo-red.png"></a>
                    <p class="leading-tight text-light-navy my-3">An incredible resource<br class="hidden sm:inline lg:hidden"> for learning piano</p>
                    <img class="h-40 sm:h-auto lazyload" data-src="https://www.musora.com/musora-cdn/image/width=1100,quality=95/https://dmmior4id2ysr.cloudfront.net/homepage/2021/pianote-graphic.png">
                </div>
                <div class="mb-4 sm:mb-0 w-full sm:w-1/3 px-3">
                    <a target="_blank" href="https://www.guitareo.com/"><img class="h-8 lg:h-10 lazyload" data-src="https://d122ay5chh2hr5.cloudfront.net/sales/guitareo-logo-green.png"></a>
                    <p class="leading-tight text-light-navy my-3">Where guitar players<br class="hidden sm:inline lg:hidden"> can learn and grow</p>
                    <img class="h-40 sm:h-auto lazyload" data-src="https://www.musora.com/musora-cdn/image/width=1100,quality=95/https://dmmior4id2ysr.cloudfront.net/homepage/2021/guitareo-graphic.png">
                </div>
                <div class="w-full sm:w-1/3 px-3">
                    <a target="_blank" href="https://www.singeo.com/"><img class="h-8 lg:h-10 lazyload" data-src="https://d21xeg6s76swyd.cloudfront.net/sales/2021/singeo-logo.png"></a>
                    <p class="leading-tight text-light-navy my-3">A one-stop platform<br class="hidden sm:inline lg:hidden"> for vocalists</p>
                    <img class="h-40 sm:h-auto lazyload" data-src="https://www.musora.com/musora-cdn/image/width=1100,quality=95/https://dmmior4id2ysr.cloudfront.net/homepage/2021/singeo-graphic.png">
                </div>
            </div>
        </div>
    </section>
    <section class="text-white text-center relative z-10 overflow-hidden px-4 md:px-8 py-8 md:py-14 bg-cover bg-center" style="background:#010411;">
        <div class="container mx-auto max-w-6xl">
            <h3 data-aos="fade-up"><strong>Meet our in-house teachers.</strong></h3>
            <p class="text-light-navy mt-1.5 mb-6">(Tap for more information)</p>

            @php
                $altSlider = [
                    [
                    'image' => 'https://dpwjbsxqtam5n.cloudfront.net/sales/about/Aaron_A.jpg',
                    'image2' => 'https://dpwjbsxqtam5n.cloudfront.net/sales/about/Aaron_B2.jpg',
                    'name' => 'AARON<br> EDGAR',
                    'bio' => "Aaron Edgar is a long-time Drumeo instructor who specializes in advanced rhythms and progressive music.<br><br>He is the drummer for Third Ion, a Canadian prog metal supergroup with members of Devin Townsend Project, Mother Mother, Into Eternity and Annihilator.<br><br>His most recent book, Progressive Drumming Essentials is one of the most adventurous texts on advanced rhythm theory.",
                    ],
                    [
                    'image' => 'https://dpwjbsxqtam5n.cloudfront.net/sales/about/Brandon_A.jpg',
                    'image2' => 'https://dpwjbsxqtam5n.cloudfront.net/sales/about/Brandon_B.jpg',
                    'name' => 'BRANDON<br> TOEWS',
                    'bio' => "Brandon Toews is a drummer, author, educator, and content producer. He is the Drumeo Content Director, author of The Drummer's Toolbox, and co-author of The Best Beginner Drum Book.<br><br>He’s been creating and producing educational content for Drumeo since 2015—much of it in collaboration with the world’s top drummers, including Dennis Chambers, Steve Smith, Simon Phillips, Hannah Welton, and Larnell Lewis. Brandon’s videos have accumulated millions of views online and have been featured in digital publications of Billboard, Rolling Stone, and iHeartRadio. ",
                    ],
                    [
                    'image' => 'https://dpwjbsxqtam5n.cloudfront.net/sales/about/Dave_A.jpg',
                    'image2' => 'https://dpwjbsxqtam5n.cloudfront.net/sales/about/Dave_B.jpg',
                    'name' => 'DAVE<br> ATKINSON',
                    'bio' => "Dave Atkinson is a drummer and educator who has been teaching on Drumeo since its inception.<br><br>He has published multiple course packs, helped create the Drumeo Method, and has hosted many of the world's finest drummers from his desk in the Drumeo studio.",
                    ],
                    [
                    'image' => 'https://dpwjbsxqtam5n.cloudfront.net/sales/about/Jared_A.jpg',
                    'image2' => 'https://dpwjbsxqtam5n.cloudfront.net/sales/about/Jared_B.jpg',
                    'name' => 'JARED<br> FALK',
                    'bio' => 'Jared Falk has been a trusted source for online drum lessons for 15+ years.<br><br>As the face of Drumeo, Jared helps drummers around the world learn their first beats and beyond.<br><br>His passion, clear explanations, and approachable style have helped him become the most watched drum instructor online. And now you’ll have exclusive access to ask him all of your biggest questions, from getting started to finding your unique voice on the drums.',
                    ],
                    [
                    'image' => 'https://dpwjbsxqtam5n.cloudfront.net/sales/about/Kyle_A.jpg',
                    'image2' => 'https://dpwjbsxqtam5n.cloudfront.net/sales/about/Kyle_B.jpg',
                    'name' => 'KYLE<br> RADOMSKY',
                    'bio' => "Musora’s Community Manager, Kyle has been making music since the age of 5 - first as a piano player, then as a drummer.<br><br>Since picking up the sticks at age 15, there’s been no looking back. Thousands of shows in 15+ countries, playing everything from jazz to country to rock n’ roll on records, jingles, and TV shows - if it needs drums, he can do it!",
                    ],
                ]
            @endphp
            <div class="slick-2 mx-auto max-w-md md:max-w-3xl lg:max-w-full">
                @foreach($altSlider as $altSlide)

                    <div class="px-1 md:px-2 slick-slide">
                        <div class="flip-div teacher inline-block relative w-full group" style="perspective: 1000px;">
                            <div class="text-center w-full h-full absolute cursor-pointer" style="transform-style: preserve-3d;">
                                <div class="front absolute z-20 overflow-hidden rounded-xl w-full h-full transition-transform duration-700" style="backface-visibility: hidden;">
                                    <div class="bg-image w-full bg-black bg-top bg-cover absolute left-0 top-0 img-toggle opacity-0 transition-all duration-700 active lazyload" data-bg="https://www.musora.com/musora-cdn/image/width=1000,quality=95/{{ $altSlide['image'] }}"></div>
                                    <div class="bg-image w-full bg-black bg-top bg-cover absolute left-0 top-0 img-toggle opacity-0 transition-all duration-700 lazyload" data-bg="https://www.musora.com/musora-cdn/image/width=1000,quality=95/{{ $altSlide['image2'] }}"></div>
                                    <div class="absolute uppercase w-full bottom-3 lg:bottom-4 z-10 text-shadow-4">
                                        <h2 class="font-bebas text-3xl mb-0.5" style="line-height:0.85em">{!! $altSlide['name']  !!}</h2>
                                    </div>
                                    <div class="absolute inset-0 z-0" style="background:linear-gradient(to bottom, transparent 66.6%, #010510);"></div>
                                </div>
                                <div class="back absolute z-40 overflow-hidden rounded-xl w-full h-full transition-transform duration-700" style="backface-visibility: hidden;">
                                    <div class="w-full h-full mx-auto text-center text-white flex flex-wrap justify-center items-start content-start p-2" style="background:linear-gradient(to bottom, #01050f, #021225);">
                                        <p class="leading-normal mx-auto text-left text-xs">{!! $altSlide['bio'] !!}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
    <section class="text-white text-center relative z-10 overflow-hidden px-4 md:px-8 py-12 sm:py-20" style="background-color:#1d232f;">
        <div class="container mx-auto relative z-10">
            <h3 class="mb-7"><strong>Plus hundreds of<br class="inline sm:hidden"> world class drummers</strong></h3>

            @php
                $slider = [
                    [
                    'image' => 'https://dpwjbsxqtam5n.cloudfront.net/sales/about/instructors/Aaron.jpg',
                    'name' => 'Aaron Spears',
                    ],
                    [
                    'image' => 'https://dpwjbsxqtam5n.cloudfront.net/sales/about/instructors/Anika.jpg',
                    'name' => 'Anika Nilles',
                    ],
                    [
                    'image' => 'https://dpwjbsxqtam5n.cloudfront.net/sales/about/instructors/Antonio.jpg',
                    'name' => 'Antonio Sanchez',
                    ],
                    [
                    'image' => 'https://dpwjbsxqtam5n.cloudfront.net/sales/about/instructors/Benny.jpg',
                    'name' => 'Benny Greb',
                    ],
                    [
                    'image' => 'https://dpwjbsxqtam5n.cloudfront.net/sales/about/instructors/David.jpg',
                    'name' => 'David Garibaldi',
                    ],
                    [
                    'image' => 'https://dpwjbsxqtam5n.cloudfront.net/sales/about/instructors/Dennis.jpg',
                    'name' => 'Dennis Chambers',
                    ],
                    [
                    'image' => 'https://dpwjbsxqtam5n.cloudfront.net/sales/about/instructors/Dom.jpg',
                    'name' => 'Dom Famularo',
                    ],
                    [
                    'image' => 'https://dpwjbsxqtam5n.cloudfront.net/sales/about/instructors/Dorothea.jpg',
                    'name' => 'Dorothea Taylor',
                    ],
                    [
                    'image' => 'https://dpwjbsxqtam5n.cloudfront.net/sales/about/instructors/Emmanuelle.jpg',
                    'name' => 'Emmanuelle Caplette',
                    ],
                    [
                    'image' => 'https://dpwjbsxqtam5n.cloudfront.net/sales/about/instructors/Gavin.jpg',
                    'name' => 'Gavin Harrison',
                    ],
                    [
                    'image' => 'https://dpwjbsxqtam5n.cloudfront.net/sales/about/instructors/Gene.jpg',
                    'name' => 'Gene Hoglan',
                    ],
                    [
                    'image' => 'https://dpwjbsxqtam5n.cloudfront.net/sales/about/instructors/Glen.jpg',
                    'name' => 'Glen Sobel',
                    ],
                    [
                    'image' => 'https://dpwjbsxqtam5n.cloudfront.net/sales/about/instructors/Hannah.jpg',
                    'name' => 'Hannah Welton',
                    ],
                    [
                    'image' => 'https://dpwjbsxqtam5n.cloudfront.net/sales/about/instructors/Larnell.jpg',
                    'name' => 'Larnell Lewis',
                    ],
                    [
                    'image' => 'https://dpwjbsxqtam5n.cloudfront.net/sales/about/instructors/Mark.jpg',
                    'name' => 'Mark Guiliana',
                    ],
                    [
                    'image' => 'https://dpwjbsxqtam5n.cloudfront.net/sales/about/instructors/Matt.jpg',
                    'name' => 'Matt Garstka',
                    ],
                    [
                    'image' => 'https://dpwjbsxqtam5n.cloudfront.net/sales/about/instructors/Simon.jpg',
                    'name' => 'Simon Phillips',
                    ],
                    [
                    'image' => 'https://dpwjbsxqtam5n.cloudfront.net/sales/about/instructors/Steve.jpg',
                    'name' => 'Steve Smith',
                    ],
                    [
                    'image' => 'https://dpwjbsxqtam5n.cloudfront.net/sales/about/instructors/Todd.jpg',
                    'name' => 'Todd Sucherman',
                    ],
                    [
                    'image' => 'https://dpwjbsxqtam5n.cloudfront.net/sales/about/instructors/Tommy.jpg',
                    'name' => 'Tommy Igoe',
                    ],
                ]
            @endphp
            <div class="slick mx-auto h-48 sm:h-56">
                @foreach($slider as $slide)
                    <div class="px-1 slick-slide">
                        <div class="mx-auto" style="max-width:215px">
                            <div class="flip-div inline-block relative w-full group" style="perspective: 1000px;">
                                <div class="text-center w-full h-full absolute" style="transform-style: preserve-3d;">
                                    <div class="front absolute z-20 overflow-hidden rounded-xl w-full h-full transition-transform duration-700" style="backface-visibility: hidden;">
                                        <div class="bg-image w-full bg-black bg-top bg-cover lazyload" data-bg="https://www.musora.com/musora-cdn/image/width=600,quality=95/{{ $slide['image'] }}"></div>
                                        <div class="absolute uppercase w-full bottom-3 lg:bottom-4 z-10 text-shadow-4">
                                            <h2 class="font-bebas text-3xl" style="line-height:0.85em">
                                                {!! $slide['name']  !!}
                                                {{--&nbsp;--}}
                                            </h2>
                                        </div>
                                        <div class="absolute inset-0 z-0" style="background:linear-gradient(to bottom, transparent 66.6%, #010510);"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
    <section class="text-white text-center relative z-10 overflow-hidden px-4 md:px-8 py-8 md:py-14 bg-cover bg-center bg-musora-black">
        <div class="container mx-auto max-w-6xl">
            <h3 data-aos="fade-up"><strong>We’re everywhere.</strong></h3>
            <p class="text-light-navy mt-1.5 mb-5 lg:mb-7">Jaw-dropping video clips. Live drum lessons and interviews. Helpful tips and articles.
                <br>Find us on your favorite social media platform:</p>
            <a target="_blank" class="transition-opacity duration-300 py-3 w-14 h-14 text-3xl leading-none rounded-full inline-block text-center mx-1.5 hover:opacity-70 social-bubble youtube text-white" href="https://www.youtube.com/freedrumlessons/" style="background: #cd201f;"><i class="fab fa-youtube"></i></a>
            <a target="_blank" class="transition-opacity duration-300 py-3 w-14 h-14 text-3xl leading-none rounded-full inline-block text-center mx-1.5 hover:opacity-70 social-bubble facebook text-white" href="https://facebook.com/drumeo/" style="background: #3b5998;"><i class="fab fa-facebook-f"></i></a>
            <a target="_blank" class="transition-opacity duration-300 py-3 w-14 h-14 text-3xl leading-none rounded-full inline-block text-center mx-1.5 hover:opacity-70 social-bubble instagram text-white" href="https://instagram.com/drumeoofficial/" style="background: linear-gradient(30deg, #FFD521 17%, #F20008 50%, #B900B4 83%);"><i class="fab fa-instagram"></i></a>
            <a target="_blank" class="transition-opacity duration-300 py-3 w-14 h-14 text-3xl leading-none rounded-full inline-block text-center mx-1.5 hover:opacity-70 social-bubble tiktok text-white" href="https://www.tiktok.com/@drumeoofficial" style="background: #000;"><i class="fab fa-tiktok" style="filter: drop-shadow(2px 2px 0px #fe2b54) drop-shadow(-2px -2px 0px #25f4ee);"></i></a>
        </div>
    </section>
    <section class="text-white text-center relative z-10 overflow-hidden px-4 md:px-5 py-8 md:py-20 bg-cover bg-center lazyload" data-bg="https://www.musora.com/musora-cdn/image/width=2000,quality=95/https://dpwjbsxqtam5n.cloudfront.net/sales/about/Order_BG.jpg">
        <div class="container mx-auto relative z-10 max-w-4xl">
            <h2 class="mb-7"><strong>Join the party.</strong></h2>
            <div class="flex flex-wrap sm:flex-nowrap w-full">
                <div class="w-full sm:w-1/3 mb-3 sm:mb-0 px-2">
                    <p class="leading-tight mb-4">Ready to up your<br class="hidden sm:inline lg:hidden"> drumming game?</p>
                    <a class="w-full join blue smaller" href="/">How It Works</a>
                </div>
                <div class="w-full sm:w-1/3 mb-3 sm:mb-0 px-2">
                    <p class="leading-tight mb-4">Looking for an <br class="hidden sm:inline lg:hidden">incredible new role?</p>
                    <a class="w-full join smaller outline" href="https://www.musora.com/careers">JOIN OUR TEAM</a>
                </div>
                <div class="w-full sm:w-1/3 px-2">
                    <p class="leading-tight mb-4">Still have<br class="hidden sm:inline lg:hidden"> questions?</p>
                    <a class="w-full join smaller outline" href="{{ get_musora_brand_base_url() }}/contact">CONTACT US</a>
                </div>
            </div>
        </div>
    </section>

    @include("drumeo.sales.partials._footer")
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script type="text/javascript" src="{{ asset('/marketing/parcel/drumeo/navigation-sales.js') }}"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.min.js"></script>
    <script type="text/javascript" src="{{ asset('/marketing/js/modal.js') }}"></script>
    <script type="text/javascript" src="{{ asset('/marketing/js/modal-autoplay.js') }}"></script>

    <script async type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/lazysizes/5.3.2/lazysizes.min.js"></script>
    <script async type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/lazysizes/5.3.2/plugins/unveilhooks/ls.unveilhooks.min.js"></script>
    <script>
        $(document).ready(function () {
            $(document).foundation();

            $('.flip-div.teacher').click(function (e) {
                $(this).toggleClass('flipped');
            });

            $('.slick').slick({
                draggable: false,
                autoplay: true,
                slidesToShow: 5,
                slidesToScroll: 5,
                autoplaySpeed: 5000,
                responsive: [
                    {
                        breakpoint: 1024,
                        settings: {
                            slidesToShow: 3,
                            slidesToScroll: 3,
                            autoplaySpeed: 3000,
                        }
                    },
                    {
                        breakpoint: 768,
                        settings: {
                            slidesToShow: 2,
                            slidesToScroll: 2,
                            autoplaySpeed: 2000,
                        }
                    }
                ]
            });
            $('.slick-2').slick({
                draggable: false,
                slidesToShow: 5,
                responsive: [
                    {
                        breakpoint: 1024,
                        settings: {
                            slidesToShow: 3
                        }
                    },
                    {
                        breakpoint: 768,
                        settings: {
                            slidesToShow: 1
                        }
                    }
                ]
            });

            $('.inside-scroll-element').slick({
                infinite: false,
                arrows: true,
                centerMode: true,
                slidesToShow: 2,
                slidesToScroll: 2,
                initialSlide: 1,
                responsive: [
                    {
                        breakpoint: 1024,
                        settings: {
                            slidesToShow: 1,
                            slidesToScroll: 1,
                            initialSlide: 0,
                        }
                    }
                ]
            });
        });
        setInterval(function(){
            setTimeout(function(){
                for (var i = 0; i < document.querySelectorAll(".img-toggle").length; i++) {
                    document.querySelectorAll(".img-toggle")[i].classList.toggle('active');
                }
            },4000);
        },4000);
    </script>

    @yield('scripts')
@stop
