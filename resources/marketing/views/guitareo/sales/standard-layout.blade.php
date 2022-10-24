@extends('guitareo._partials.global-layout')

@section('meta')
    <meta name="description" content="Play guitar like you've always wanted with step-by-step video lessons, world-class teachers, and unlimited personal support. 90-Day Guarantee." />
    <meta property="og:description" content="Play guitar like you've always wanted with step-by-step video lessons, world-class teachers, and unlimited personal support. 90-Day Guarantee."/>

    @hasSection('share-image')
        @yield('share-image')
    @else
        <meta property="og:image" content="https://d122ay5chh2hr5.cloudfront.net/sales/2022/og-image.jpg"/>
    @endif

@endsection

@section('styles')
    <link rel="preload" href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.19/tailwind.min.css" as="style" onload="this.onload=null;this.rel='stylesheet'">
    <noscript><link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.19/tailwind.min.css"></noscript>
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.min.css"/>
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick-theme.min.css"/>
    <link href="{{ asset('/marketing/parcel/guitareo/tailwind-helpers.css') }}" rel="stylesheet">
    <link href="{{ asset('/marketing/parcel/guitareo/sales-page.css') }}" rel="stylesheet">
    <link href="{{ asset('/marketing/parcel/guitareo/nav-footer.css') }}" rel="stylesheet">
    {{--<link href="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.css" rel="stylesheet">--}}

    <style>
        .slick-3 .slick-track {
            display: flex;
        }

        .slick-3 .slick-slide {
            display: flex;
            float: none;
            height: auto;
        }

        .slick-3 .slick-slide > div {
            display: flex;
            flex: 1 1 auto;
        }

        .slick-3 .slick-next {
            right: 25%;
        }

        .slick-3 .slick-prev {
            left: 25%;
        }

        .header-image {
            background-image: url('https://cdn.musora.com/image/fetch/w_830,q_auto:best/https://guitareo.s3.amazonaws.com/sales/2022/header-bg2.jpg');
        }

        @media (min-width:768px) {
            .header-image {
                background-image: url('https://cdn.musora.com/image/fetch/w_1150,q_auto:best/https://guitareo.s3.amazonaws.com/sales/2022/header-bg2.jpg');
            }

            .slick-3 .slick-next {
                right: -15px;
            }

            .slick-3 .slick-prev {
                left: -15px;
            }
        }

        @media (min-width:1024px) {
            .header-image {
                background-image: url('https://cdn.musora.com/image/fetch/w_2200,q_auto:best/https://guitareo.s3.amazonaws.com/sales/2022/header-bg2.jpg');
            }
        }
    </style>
@endsection

@section('content')
    @include("guitareo.sales.partials._nav", [
        "homepageVersion" => true,
        "scrollToJoin" => true,
        "mcVersion" => true
    ])

    @yield('top-promo-bar')

    <header class="header text-white relative overflow-hidden" style="background-color:#032829;">
        <div class="transform -translate-y-1/2 top-3/4 md:top-1/2 left-0 w-full absolute z-20 px-4 lg:px-6 text-center md:text-left">
            <div class="container mx-auto max-w-6xl">
                <h1 class="leading-tight max-w-xs md:max-w-xl lg:max-w-2xl mx-auto md:mx-0 md:text-3xl lg:text-4xl"><strong>Online guitar lessons <br class="hidden md:inline">that care about you.</strong></h1>
                <h6 class="leading-normal text-light-navy text-shadow-4 mt-3 md:mt-5 mb-5 md:mb-7 max-w-sm md:max-w-none">Get lessons from world-class guitarists and GRAMMY <br class="hidden md:inline">winners to help you learn faster, get better, and have <br class="hidden md:inline">more fun on the guitar.</h6>
                <a
                    @hasSection('start-button')
                    href="@yield('start-button')" class="join blue smaller w-3/4 md:w-1/3 lg:w-1/4"
                    @else
                    href="#customize-anchor" class="join blue smaller anchor-slide w-3/4 md:w-1/3 lg:w-1/4 anchor-slide"
                    @endif
                >
                    @if(empty($trialVersion))
                        Get Started
                    @else
                        Start your free trial
                    @endif
                </a>
            </div>
        </div>

        <div class="header-image relative mx-auto w-full h-full relative z-0" style="max-width: 1536px;">
            <div class="top-0 left-0 absolute w-full h-full z-10 hidden xl:block" style="background: linear-gradient(to right, #032829, transparent 60%, transparent 85%, #032829);"></div>
            <div class="top-0 left-0 absolute w-full h-full z-10 hidden md:block xl:hidden" style="background: linear-gradient(to right, #032829, transparent 75%);"></div>
            <div class="top-0 left-0 absolute w-full h-full z-10 block md:hidden" style="background: linear-gradient(to bottom, transparent 35%, #032829);"></div>
        </div>
    </header>

    @yield('sticky-bar')

    <section class="px-2 lg:px-4 py-10 md:py-14 md:py-20 text-white text-center overflow-hidden" style="background:linear-gradient(to bottom, #01050f 60%, #021124);">
        <div class="container mx-auto max-w-6xl">
            <h3 class="leading-tight " data-aos-once="true" data-aos="fade-up" data-aos-offset="150" data-aos-delay="150"><strong>The Ultimate Online<br class="inline md:hidden"> Guitar Lessons Experience<sup>&trade;</sup></strong></h3>
            <p class="text-light-navy mt-2 md:mt-4 mb-8 md:mb-10">
                Online video lessons you can watch anytime along with<br class="hidden sm:inline lg:hidden">
                real teachers who'll support you every step of the way.</p>
            <div class="md:grid md:grid-cols-3 md:gap-4 max-w-xs md:max-w-full mx-auto">
                <div class="relative rounded-xl overflow-hidden mb-3 md:mb-0" style="background-color:#051124;">
                    <div class="w-full aspect-16:9 bg-cover bg-center lazyload" data-bg="https://cdn.musora.com/image/fetch/w_700,q_auto:best/https://guitareo.s3.amazonaws.com/sales/2022/method-thumbs.jpg"></div>
                    <div class=" px-4 lg:px-6 py-5 lg:py-7">
                        <i class="text-4xl align-middle fal fa-guitar text-guitareo"></i>
                        <img class="h-5 ml-2 imgfilter-method lazyload" data-src="https://cdn.musora.com/image/fetch/q_auto:best/https://dpwjbsxqtam5n.cloudfront.net/sales/2021/method-text.svg" alt="method-text">
                        <h4 class="leading-tight my-3"><strong>Always Know What <br class="hidden md:inline"> To Practice</strong></h4>
                        <p class="leading-normal text-light-navy mb-10 md:mb-14">This is your 10 level, step-by-step curriculum to becoming a complete guitarist and achieving your guitar goals. Never worry about where to look for the perfect next lesson, because the next lesson is always the perfect lesson. </p>
                        <a class="absolute bottom-4 lg:bottom-6 left-0 right-0 join smaller method outline anchor-slide w-2/3 md:w-5/6 lg:w-2/3 mx-auto" href="#method">Learn More</a>
                    </div>
                </div>
                <div class="relative rounded-xl overflow-hidden mb-3 md:mb-0" style="background-color:#051124;">
                    <div class="w-full aspect-16:9 bg-cover bg-center lazyload" data-bg="https://cdn.musora.com/image/fetch/w_700,q_auto:best/https://guitareo.s3.amazonaws.com/sales/2022/songs-thumbs.jpg"></div>
                    <div class="px-4 lg:px-6 py-5 lg:py-7">
                        <i class="text-4xl align-middle icon-songs text-songs"></i>
                        <img class="h-5 ml-2 imgfilter-songs lazyload" data-src="https://cdn.musora.com/image/fetch/q_auto:best/https://dpwjbsxqtam5n.cloudfront.net/sales/2021/songs-text.svg" alt="songs-text">
                        <h4 class="leading-tight my-3"><strong>Play Your <br class="hidden md:inline">  Favorite Songs</strong></h4>
                        <p class="leading-normal text-light-navy mb-10 md:mb-14">There’s nothing better than playing the songs you love! So you’ll get 500 chord charts for popular songs from all eras and styles – so you can play the ones you love, entertain your friends, and try different genres. </p>
                        <a class="absolute bottom-4 lg:bottom-6 left-0 right-0 join smaller songs outline anchor-slide w-2/3 md:w-5/6 lg:w-2/3 mx-auto" href="#songs">Learn More</a>
                    </div>
                </div>
                <div class="relative rounded-xl overflow-hidden" style="background-color:#051124;">
                    <div class="w-full aspect-16:9 bg-cover bg-center lazyload" data-bg="https://cdn.musora.com/image/fetch/w_700,q_auto:best/https://guitareo.s3.amazonaws.com/sales/2022/coaches_thumb1.jpg"></div>
                    <div class="px-4 lg:px-6 py-5 lg:py-7">
                        <img class="h-8 icon imgfilter-coaches" src="https://cdn.musora.com/image/fetch/w_800,q_auto:best/https://dpwjbsxqtam5n.cloudfront.net/sales/2021/coaches-icon.svg" alt="coaches-icon">
                        <img class="h-5 ml-2 imgfilter-coaches lazyload" data-src="https://cdn.musora.com/image/fetch/q_auto:best/https://dpwjbsxqtam5n.cloudfront.net/sales/2021/coaches-text.svg" alt="coaches-text">
                        <h4 class="leading-tight my-3"><strong>Motivation <br class="hidden md:inline"> & Support</strong></h4>
                        <p class="leading-normal text-light-navy mb-10 md:mb-14">Stay inspired, explore new styles, and get access to world-class guitarists as you hone your craft. With unlimited personal support from your Guitareo Coaches, you'll always get the answers you need to reach your guitar goals.</p>
                        <a class="absolute bottom-4 lg:bottom-6 left-0 right-0 join smaller coaches outline anchor-slide w-2/3 md:w-5/6 lg:w-2/3 mx-auto" href="#coaches">Learn More</a>
                    </div>
                </div>
            </div>

            <a
                    @hasSection('start-button')
                    href="@yield('start-button')" class="join smaller blue mt-12 mb-2 lg:w-1/3"
                    @else
                    href="#customize-anchor" class="join smaller blue anchor-slide mt-9 md:mt-12 mb-2 lg:w-1/3"
                    @endif
            >Get The Guitareo Advantage</a>

            <p class="text-light-navy text-sm">
                <em>
                        @if(empty($trialVersion))
                            Just ${{ number_format(GuitareoPrices::$guitareoMembershipAnnual / 12, 2) }} per month, 90-day guarantee.
                        @else
                            Try it for free now
                        @endif
                </em>
            </p>
        </div>
    </section>

    <div id="promo" class="anchor"></div>
    @yield('promo-banner')
    <div class="sticky-trigger block"></div>
    @php
        $coaches = [
            [
            'image' => 'https://guitareo.s3.amazonaws.com/sales/2022/coaches/dean-lamb2.jpg',
            'date' => 'Now Available',
            'name' => 'Dean <br> Lamb',
            'subtitle' => 'Shredding<br> Fundamentals',
            'smallInfo' => 'Death metal guitarist Dean Lamb will share the fundamentals of shredding, including rhythmic vibrato and performing perfect-pinch harmonics.',
            'info' => 'One of the most powerful tools any guitarist can have is the ability to shred. And 8-string guitarist of death metal band Archspire, Dean Lamb, will show you the techniques to harness your own power on the guitar.',
            'modal' => 'lamb',
            'prev' => false,
            'next' => 'ghawi',
            'trending' => true,
            'bigTile' => true,
            ],
            [
            'image' => 'https://guitareo.s3.amazonaws.com/sales/2022/coaches/sami-ghawi.jpg',
            'date' => 'Now Available',
            'name' => 'Sami <br> Ghawi',
            'subtitle' => 'Strumming<br> & Rhythm',
            'smallInfo' => 'Sami Ghawi will show you his best insights into strumming and rhythm – helping you breathe new life into every song you play.',
            'info' => 'Often the unsung hero of playing the guitar, rhythm and strumming play a big role in becoming a well-rounded guitarist. And with 20 years of teaching experience, Sami Ghawi will share his tools of the trade so you can lock in your timing and feel.',
            'modal' => 'ghawi',
            'prev' => 'lamb',
            'next' => 'shores',
            'trending' => true,
            'trailer' => true,
            ],
            [
            'image' => 'https://guitareo.s3.amazonaws.com/sales/2022/coaches/kent-shores.jpg',
            'date' => 'Now Available',
            'tileSubtitle' => 'Technique, Theory,<br> & Foundations',
            'name' => 'KENT <br> SHORES',
            'modal' => 'shores',
            'prev' => 'ghawi',
            'next' => 'scallon',
            'subtitle' => 'Your New Sounds For<br> Soloing Are Here',
            'info' => 'Kent holds a degree from the University of North Texas in Jazz Studies - Guitar Performance with a Minor in Music Theory and has performed across Canada, the United States, and India with various bands.<br><br>Ranging from complete beginners to more advanced players, his teaching philosophy is all about bringing out the best in his students and fostering a love of music. He strives to make sure that music lessons are fun and enjoyable. He finds great joy in sharing music with his students and celebrating their achievements.',
            'trailer' => true,
            ],
            [
            'image' => 'https://guitareo.s3.amazonaws.com/sales/2022/coaches/rob-scallon.jpg',
            'date' => 'Now Available',
            'name' => 'Rob <br> Scallon',
            'subtitle' => 'Songwriting<br> Cheat Codes',
            'smallInfo' => 'YouTube sensation & multi-instrumentalist Rob Scallon will share the 5 songwriting cheat codes to help you bring your own musical ideas to life. ',
            'info' => 'If you like songs and own a guitar, then you can be a songwriter. Famous guitar influencer, Rob Scallon will show 5 cheat codes to build entire songs from scratch. He’ll even uncover the mystery process of writing songs with the “spaghetti principle.”',
            'modal' => 'scallon',
            'prev' => 'shores',
            'next' => 'tesler',
            'trending' => true,
            'trailer' => true
            ],
            [
            'image' => 'https://guitareo.s3.amazonaws.com/sales/2022/coaches/ayla-tesler-mabe.jpg',
            'date' => 'Now Available',
            'tileSubtitle' => 'Musicality, Performance,<br> & Inspiration',
            'modal' => 'tesler',
            'prev' => 'scallon',
            'name' => 'AYLA<br> TESLER-MABE',
            'subtitle' => 'Musicality, Performance,<br> & Inspiration',
            'info' => 'Ayla Tesler-Mabe has made a splash in the music industry as a professional guitarist, vocalist, and songwriter -- playing in popular bands including Ludic and formally Calpurnia. And while she’s actively creating new music and performing, Ayla’s also passionate about helping students through Guitareo every day!<br><br>Ayla’s no stranger to answering questions candidly, lending advice, and starting conversations about all things guitar -- and her teaching style makes students feel comfortable and encouraged, so you’ll keep practicing and developing your skills.',
            'next' => 'young',
            ],
            [
            'image' => 'https://guitareo.s3.amazonaws.com/sales/2022/coaches/yvette-young.jpg',
            'date' => 'Coming Soon',
            'name' => 'Yvette <br> Young',
            'subtitle' => 'Creativity<br> & Expression',
            'smallInfo' => 'Math rock frontwoman Yvette Young of Covet shares her insights in developing your own unique approach to the guitar. ',
            'info' => 'Having the ability to express your creativity is a big part of being a guitarist. Whether it’s discovering her own style or fronting her own band, Yvette Young is the perfect coach to show you what you need to uncover your creative self. ',
            'modal' => 'young',
            'prev' => 'tesler',
            'next' => 'thorn',
            'trending' => true
            ],
            [
            'image' => 'https://guitareo.s3.amazonaws.com/sales/2022/coaches/pete-thorn2.jpg',
            'date' => 'Coming Soon',
            'name' => 'Pete <br> Thorn',
            'subtitle' => 'Expand Your<br> Musicality',
            'smallInfo' => "He's toured with Chris Cornell, Melissa Etheridge, and Tsuyoshi Nagabuch - now he'll teach YOU to improve your musicality.",
            'info' => 'Great tone can make all the difference in sounding good on the guitar. And self-proclaimed “guitar nerd” and pedal expert Pete Thorn will show you how to get the best sounds from everything you play.',
            'modal' => 'thorn',
            'prev' => 'young',
            'next' => 'weiner',
            'trending' => true
            ],
            [
            'image' => 'https://guitareo.s3.amazonaws.com/sales/2022/coaches/dave-weiner.jpg',
            'date' => 'Coming Soon',
            'name' => 'Dave <br> Weiner',
            'subtitle' => 'Adding<br> Power',
            'smallInfo' => 'Dave Weiner has toured with Steve Vai & established himself as a metal & rock guitar force. Get ready to play more powerfully!',
            'info' => 'Building a foundation is key if you want to learn the guitar. Dave Weiner (Steve Vai’s guitarist for 22 years) will share his foundational secrets so that you can get started the right way and progress faster with your skills.',
            'modal' => 'weiner',
            'prev' => 'young',
            'next' => 'lettieri',
            'trending' => true
            ],
            [
            'image' => 'https://guitareo.s3.amazonaws.com/sales/2022/coaches/mark-letteri.jpg',
            'date' => 'Coming Soon',
            'name' => 'Mark <br> Lettieri',
            'subtitle' => 'GRAMMY<br> Insights',
            'smallInfo' => 'This 4x Grammy winner has played with Snarky Puppy, The Jacksons, and David Crosby. Get ready to explore a multitude of styles!',
            'info' => "Having groove and feel is essential on the guitar. As the guitarist for Snarky Puppy – and recording with legends including David Crosby and The Jacksons – Mark Lettieri is one of the funkiest guitarists out there, and he'll show you all the tips and tricks to tighten up your grooves and improve your rhythm playing.",
            'modal' => 'lettieri',
            'prev' => 'weiner',
            'next' => 'martone',
            'trending' => true
            ],
            [
            'image' => 'https://guitareo.s3.amazonaws.com/sales/2022/coaches/dave-martone.jpg',
            'date' => 'Coming Soon',
            'name' => 'Dave <br> Martone',
            'subtitle' => 'Fretboard<br> Mastery',
            'smallInfo' => "Whether it's fingerstyle, Latin shred, or rock ‘n’ roll, Dave Martone never ceases to amaze with his talents. Now you'll get his fretboard secrets.",
            'info' => "Your potential on the fretboard is unlimited. And iconic shredder Dave Martone (Joe Satriani, Nickelback, 3 Doors Down) will show you how to unlock every bit of it so you can navigate every note, fret, and scale with ease.",
            'modal' => 'martone',
            'prev' => 'lettieri',
            'next' => false,
            'trending' => true
            ],
        ]
    @endphp

    {{-- <section class="content-section text-center px-4 lg:px-5" style="background:linear-gradient(to bottom, #01050f 60%, #021124);">
        <div class="container mx-auto max-w-6xl">
            <h3 class="" data-aos-once="true" data-aos="fade-up" data-aos-offset="150" data-aos-delay="150"><strong>Here’s What’s Hot Inside Guitareo</strong></h3>
            <p class="leading-normal text-light-navy mt-2 md:mt-4">Build your skills, learn from the pros, watch cool documentaries, join a community of <br class="hidden md:inline"> lifelong learners, and continuously stay inspired throughout your entire musical journey.</p>


            <div class="slick-2 mx-auto mb-12 mt-7 md:my-10 max-w-md md:max-w-3xl lg:max-w-full">
                @foreach($coaches as $coach)
                    @if(!empty($coach['trending']))
                        <div class="px-1 md:px-2 slick-slide">
                            <div class="mx-auto" style="max-width:215px">
                                <div class="flip-div inline-block relative w-full group" style="perspective: 1000px;">
                                    <div class="text-center w-full h-full absolute cursor-pointer" style="transform-style: preserve-3d;">
                                        <div class="front absolute z-20 overflow-hidden rounded-xl w-full h-full transition-transform duration-700" style="backface-visibility: hidden;">
                                            <div class="bg-image w-full bg-black bg-top bg-cover lazyload" data-bg="https://cdn.musora.com/image/fetch/w_1000,q_auto:best/{{ $coach['image'] }}"></div>
                                            <div class="absolute uppercase w-full bottom-3 lg:bottom-4 z-10 text-shadow-4">
                                                <h2 class="font-bebas text-3xl mb-0.5" style="line-height:0.85em">{!! $coach['name']  !!}</h2>
                                                <p class="text-coaches uppercase leading-tight mx-auto text-sm">{!! $coach['subtitle'] !!}</p>
                                            </div>
                                            <p class="leading-none font-bebas text-black bg-coaches rounded-md pt-1 px-2 absolute top-2 left-2">{!! $coach['date'] !!}</p>
                                            <div class="absolute inset-0 z-0" style="background:linear-gradient(to bottom, transparent 30%, #010510);"></div>
                                        </div>
                                        <div class="back absolute z-40 overflow-hidden rounded-xl w-full h-full transition-transform duration-700" style="backface-visibility: hidden;">
                                            <div class="w-full h-full mx-auto text-center text-white flex flex-wrap justify-center items-center content-center p-3" style="background:linear-gradient(to bottom, #01050f, #021225);">
                                                <p class="text-coaches uppercase leading-tight mx-auto mb-1">{!! $coach['subtitle'] !!}</p>
                                                <p class="leading-normal mx-auto text-sm">{!! $coach['smallInfo'] !!}</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                @endforeach
            </div>

            @php
                $altSlider = [
                    [
                    'image' => 'https://guitareo.s3.amazonaws.com/sales/promos/april/flippy_cards01.jpg',
                    'name' => 'Elevate Your <br>Rhythm Playing',
                    'subtitle' => 'With <br>Sami Ghawi',
                    'smallInfo' => "Quickly capture any audience's attention and master one of the most important elements of music.",
                    ],
                    [
                    'image' => 'https://guitareo.s3.amazonaws.com/sales/promos/march/kent-ayla.jpg',
                    'name' => 'Rhythm vs <br>Lead Guitar<br>"Thunderstruck"',
                    'subtitle' => 'Ayla Tesler-Mabe <br>& Kent Shores',
                    'smallInfo' => 'Ayla and Kent break down one of the most iconic guitar songs, Thunderstruck, by AC/DC and show you how the rhythm and lead parts fit together.',
                    ],
                    [
                    'image' => 'https://guitareo.s3.amazonaws.com/sales/2022/coach-cards/500-songs.jpg',
                    'name' => '500 Songs<br> In 5 Days',
                    'subtitle' => '+ Downloadable<br> Chord Charts',
                    'smallInfo' => 'Build the knowledge and skills to play 500 songs in 5 Days and play them anywhere on any device with the downloadable chord chart for each one.',
                    ],
                    [
                    'image' => 'https://guitareo.s3.amazonaws.com/sales/promos/april/flippy_cards04.jpg',
                    'name' => 'Let’s Get Rockin’<br> With Rhythm',
                    'subtitle' => 'With<br> Ayla Tesler-Mabe',
                    'smallInfo' => 'Rhythm is one of the most essential parts of playing the guitar. Add groove to your playing by understanding beat, timing, and tempo.',
                    ],
                    [
                    'image' => 'https://guitareo.s3.amazonaws.com/sales/promos/april/flippy_cards05.jpg',
                    'name' => 'Exploring Emotions<br> In Each Note',
                    'subtitle' => 'With<br> Ayla Tesler-Mabe',
                    'smallInfo' => 'Playing the guitar is so much more than just learning notes and chords. Infuse emotion and character into what you play with these expressive techniques.',
                    ],
                    [
                    'image' => 'https://guitareo.s3.amazonaws.com/sales/2022/coach-cards/writing-cheats.jpg',
                    'name' => '5 Song Writing<br> Cheat Codes ',
                    'subtitle' => 'With<br> Rob Scallon',
                    'smallInfo' => 'Make the process of writing songs easier with Rob Scallon’s 5 Songwriting Cheat Codes and start creating music right away!',
                    ],
                    [
                    'image' => 'https://guitareo.s3.amazonaws.com/sales/promos/march/kent.jpg',
                    'name' => 'Your New Sounds <br> For Soloing',
                    'subtitle' => 'With<br> Kent Shores',
                    'smallInfo' => 'Go beyond the pentatonic scale and learn Kent’s secrets to making impressive sounds in any key.',
                    ],
                    [
                    'image' => 'https://guitareo.s3.amazonaws.com/sales/2022/coach-cards/qna.jpg',
                    'name' => 'Weekly<br> Live Q&As',
                    'subtitle' => 'Every<br> Tuesday',
                    'smallInfo' => 'Get your biggest guitar questions answered by real teachers and always stay supported so you can reach your guitar goals faster.',
                    ],
                ]
            @endphp
            <div class="slick-2 mx-auto mb-12 mt-7 md:my-10 max-w-md md:max-w-3xl lg:max-w-full h-64 sm:h-80">
                @foreach($altSlider as $altSlide)
                    <div class="px-1 md:px-2 slick-slide">
                        <div class="mx-auto" style="max-width:215px">
                            <div class="flip-div inline-block relative w-full group" style="perspective: 1000px;">
                                <div class="text-center w-full h-full absolute cursor-pointer" style="transform-style: preserve-3d;">
                                    <div class="front absolute z-20 overflow-hidden rounded-xl w-full h-full transition-transform duration-700" style="backface-visibility: hidden;">
                                        <div class="bg-image w-full bg-black bg-top bg-cover lazyload" data-bg="https://cdn.musora.com/image/fetch/w_1000,q_auto:best/{{ $altSlide['image'] }}"></div>
                                        <div class="absolute uppercase w-full bottom-3 lg:bottom-4 z-10 text-shadow-4">
                                            <h2 class="font-bebas text-3xl mb-0.5" style="line-height:0.85em">{!! $altSlide['name']  !!}</h2>
                                            <p class="text-coaches uppercase leading-tight mx-auto text-sm">{!! $altSlide['subtitle'] !!}</p>
                                        </div>
                                        @if(!empty($altSlide['date']))
                                            <p class="leading-none font-bebas text-black bg-coaches rounded-md pt-1 px-2 absolute top-2 left-2">{!! $altSlide['date'] !!}</p>
                                        @endif
                                        <div class="absolute inset-0 z-0" style="background:linear-gradient(to bottom, transparent 30%, #010510);"></div>
                                    </div>
                                    <div class="back absolute z-40 overflow-hidden rounded-xl w-full h-full transition-transform duration-700" style="backface-visibility: hidden;">
                                        <div class="w-full h-full mx-auto text-center text-white flex flex-wrap justify-center items-center content-center p-2 md:p-3" style="background:linear-gradient(to bottom, #01050f, #021225);">
                                            <p class="text-coaches uppercase leading-tight mx-auto mb-1">{!!  str_replace('<br>', ' ', $altSlide['subtitle'])  !!}</p>
                                            <p class="leading-normal mx-auto text-sm">{!! $altSlide['smallInfo'] !!}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <a
                    @hasSection('start-button')
                    href="@yield('start-button')" class="join smaller blue md:mt-6 mb-2 md:w-1/3"
                    @else
                    href="#customize-anchor" class="join smaller blue anchor-slide md:mt-6 mb-2 md:w-1/3"
                    @endif
            >Get Started</a>
            <p class="text-light-navy text-sm"><em>It takes less than a minute to sign up.</em></p>
        </div>
    </section> --}}
    <section class="py-10 md:py-16 lg:py-20 px-3 lg:px-6 text-white text-center" style="background:linear-gradient(to bottom, #00c9ac, #00816e);">
        <div class="container mx-auto max-w-6xl">
            <h2 class="leading-tight max-w-3xl"><em>“... for people who want to learn how to play guitar, and fast.”</em></h2>
            <h6 class="mt-5 mb-10 md:mb-20"><em>- American Songwriter</em></h6>
            <div class="mx-auto w-full opacity-80">
                <p class="text-sm mb-3"><em>As seen in:</em></p>
                <img class="inline-block h-7 md:h-9 mr-3 md:mr-8 lazyload" data-src="https://cdn.musora.com/image/fetch/w_230,q_auto:best/https://guitareo.s3.amazonaws.com/sales/2021/partner-guitar-world.png" alt="guitar-world">
                <img class="inline-block h-14 md:h-16 lazyload" data-src="https://cdn.musora.com/image/fetch/w_130,q_auto:best/https://guitareo.s3.amazonaws.com/sales/2021/partner-guiness-world-records.png" alt="guitar-world-records">
                <img class="inline-block h-10 md:h-14 ml-3 md:ml-8 lazyload" data-src="https://cdn.musora.com/image/fetch/w_270,q_auto:best/https://guitareo.s3.amazonaws.com/sales/2021/partner-american-songwriter.png" alt="american-songwriter">
            </div>
        </div>
    </section>

    <div id="testimonials" class="anchor"></div>
    <section class="content-section text-center px-3 lg:px-5">
        <div class="container mx-auto max-w-6xl">
            <h3 class="leading-tight mb-8 md:mb-11 " data-aos-once="true" data-aos="fade-up" data-aos-offset="150" data-aos-delay="150"><strong>Trusted by guitar<br class="inline-block sm:hidden"> students  everywhere</strong></h3>
            <div class="flex flex-wrap items-start justify-center mx-auto">
                <div class="w-1/3 px-1 md:px-2 mb-2 md:mb-4">
                    <div class="py-4 md:py-5 lg:py-6 rounded-xl w-full" style="color:#cd201f;background: #051124;">
                        <a href="https://www.youtube.com/user/guitarlessonscom" target="_blank" aria-label="youtube"> <i class="fab fa-youtube text-3xl md:text-4xl"></i>
                        </a>
                        <h2 class="hidden sm:block count font-black leading-none my-2 md:my-3 text-white" id="youtube-count" data-total-count="965000">0</h2>
                        <h2 class="count block sm:hidden font-black leading-none my-2 md:my-3 text-white">965K</h2>
                        <p class="uppercase leading-none md:tracking-widest">Subs<span class="hidden sm:inline-block">cribers</span></p>
                    </div>
                </div>
                <div class="w-1/3 px-1 md:px-2 mb-2 md:mb-4">
                    <div class="py-4 md:py-5 lg:py-6 rounded-xl w-full" style="color:#3b5998;background: #051124;">
                        <a href="https://www.facebook.com/guitareoofficial" target="_blank" aria-label="facebook"> <i class="fab fa-facebook-f text-3xl md:text-4xl"></i> </a>
                        <h2 class="hidden sm:block count font-black leading-none my-2 md:my-3 text-white" id="likes-count" data-total-count="335000">0</h2>
                        <h2 class="count block sm:hidden font-black leading-none my-2 md:my-3 text-white">335K</h2>
                        <p class="uppercase leading-none md:tracking-widest">Likes</p>
                    </div>
                </div>
                <div class="w-1/3 px-1 md:px-2 mb-2 md:mb-4">
                    <div class="instagram py-4 md:py-5 lg:py-6 rounded-xl w-full" style="background: #051124;">
                        <a href="https://www.instagram.com/guitareoofficial/" target="_blank" aria-label="instagram"> <i class="fab fa-instagram text-3xl md:text-4xl" style="background: linear-gradient(30deg, #FFD521 17%, #F20008 50%, #B900B4 83%);-webkit-background-clip: text;-webkit-text-fill-color: transparent;"></i>
                        </a>
                        <h2 class="hidden sm:block count font-black leading-none my-2 md:my-3 text-white" id="follower-count" data-total-count="17000">0</h2>
                        <h2 class="count block sm:hidden font-black leading-none my-2 md:my-3 text-white">17K</h2>
                        <p class="uppercase leading-none md:tracking-widest" style="color:#E1306C">Followers</p>
                    </div>
                </div>
            </div>
            <div class="{{--testimonials--}} slick-3 flex flex-wrap justify-center mx-auto w-full {{--max-w-xs--}} md:max-w-full">
                @php
                    $testimonials = [
                        [
                        'title' => "I’m lightyears ahead of where I was.",
                        'description' => "I’ve come so far in such a short period of time. I’ve gone from not even knowing what palm muting was to noodling with the E & A string pentatonic shapes and creating melodies with it – and using it to work on my vibrato, slides, and bends. And I’ve gained priceless info like knowing where to place chords, start power chords, and scale shapes.<br><br>Having the breakthroughs I’ve had so far has brought me confidence and kept me sane while the world is seemingly not – and made me believe there is still a bright future ahead. As I progress, I feel supported towards achieving my goals of jamming with others and using my love for writing to start telling stories through music. All in due time.<br><br>I’m lightyears ahead of where I was at. And no matter where I go, or however tough things get, I’ll always have one of my guitars in the passenger seat and we’ll always be there for each other. The life long journey has begun!",
                        'name' => 'Ërlik Sörensen',
                        'location' => 'British Columbia, Canada',
                        'image' => 'https://guitareo.s3.amazonaws.com/sales/2022/testimonials/erliksorensen.jpg',
                        'prev' => false,
                        'next' => 'AthinaKatri',
                        ],
                        [
                        'title' => "The frustration is over.",
                        'description' => "I’m already playing things that were a nightmare to me before. Strumming patterns, smoothly changing chords, and improvisation of different scales. I’m even playing songs using my own chord progressions and pentatonic scales. I’m enjoying listening to myself play and proud of my progress!<br><br>The frustration is over. Guitareo has what a guitarist wants and it’s been a fun and easy learning experience.",
                        'name' => 'Vetriselvi Senguttuvan',
                        'location' => 'India',
                        'image' => 'https://guitareo.s3.amazonaws.com/sales/2022/testimonials/vetriselvisenguttuvan.jpg',
                        'prev' => 'PatriziaK',
                        'next' => 'JimMcKenna',
                        ],
                        [
                        'title' => "I’ve never felt so much JOY playing the guitar.",
                        'description' => "When I finished the first lesson, I had a feeling of joy that I’ve never had before when playing guitar. I'm experimenting a lot more and improving my technique. The goal-based learning makes each set of lessons more entertaining and a feeling of accomplishment when completed.",
                        'name' => 'Jamie K',
                        'location' => 'Nova Scotia, Canada',
                        'image' => 'https://guitareo.s3.amazonaws.com/guitarquest/assets/testimonials/jamie-nova-scotia.jpg',
                        'prev' => 'WJWilliams',
                        'next' => false,
                        ],
                        [
                        'title' => "I finally feel like I’m able to learn the guitar.",
                        'description' => "Guitareo focuses on smaller tasks and achievements along the way to make you feel like you’re improving. In level four of GuitarQuest, I played the G chord for the first time without any pain in my hands. I finally feel like I’ll really be able to learn the guitar and succeed! This course is SO much fun and keeps me motivated!",
                        'name' => 'Patrizia K',
                        'location' => 'Germany',
                        'image' => 'https://guitareo.s3.amazonaws.com/guitarquest/assets/testimonials/patrizia-germany.jpg',
                        'prev' => 'JanM',
                        'next' => 'VetriselviSenguttuvan',
                        ],
                        [
                        'title' => "I like the sincerity, knowledge, and positivity.",
                        'description' => "The internet is a nice resource for ideas, methods, tips, and tricks, but there is no linear method. I have to create one on my own, and I don’t want to teach guitar. I want to play.<br><br>So I joined Guitareo because I like the sincerity, knowledge, and positivity. Nate introduced me to the Million Dollar Progression. And Ayla showed me how to solo using backing tracks. They got me started on my journey and gave me confidence. Now I’m excited to practice. My Fender Hellcat seems to fit into my hands and against my body like it didn’t before. And I can actually say “I’m a guitarist!” Well, how about that!",
                        'name' => 'Jim McKenna',
                        'location' => 'Illinois, USA',
                        'image' => 'https://guitareo.s3.amazonaws.com/sales/2022/testimonials/jimmckenna.jpg',
                        'prev' => 'VetriselviSenguttuvan',
                        'next' => 'WJWilliams',
                        ],
                        [
                        'title' => "I’ve started making my own melodies.",
                        'description' => "Guitareo has been fun and motivated me to try more. I like how we start making melodies quickly along with helpful background information on chords and notes. I love seeing other students post their melodies -- it’s so much fun to listen to others!",
                        'name' => 'Jan M',
                        'location' => 'Germany',
                        'image' => 'https://guitareo.s3.amazonaws.com/guitarquest/assets/testimonials/jan-berlin-germany.jpg',
                        'prev' => 'AthinaKatri',
                        'next' => 'PatriziaK',
                        ],
                        [
                        'title' => "I normally never play guitar in front of friends.",
                        'description' => "I had classical guitar lessons 15 years ago and since then I’ve wanted to play acoustic and electric guitar. I’ve been trying to figure them out on my own and it was frustrating – trying to play pentatonics, or mute strings. And then I found out about Guitareo!<br><br>I feel happy and more confident while playing, even though it’s pretty early. I played my first song with mini barre chords and actually enjoyed it. I’ve never done that before! And I even sent a video playing a punk play-along song to a friend (and I normally never play guitar in front of friends). I would definitely recommend Guitareo. You have done really good work and I personally thank you for that!",
                        'name' => 'Athina Katri',
                        'location' => 'Greece',
                        'image' => 'https://guitareo.s3.amazonaws.com/sales/2022/testimonials/athinakatri.jpg',
                        'prev' => 'ËrlikSörensen',
                        'next' => 'JanM',
                        ],
                        [
                        'title' => "I’m holding my own while still having fun!",
                        'description' => "I was skeptical at first. I’ve seen online lesson sites that are really bad, so I started with a monthly subscription. After going through the beginner lessons, I saw that Guitareo was totally different from other sites. I’ve had a guitar for years and struggled to play anything more than G, C, and D – and I always had trouble learning new chords and progressions. Guitareo’s lessons helped me advance and have more fun playing the guitar.<br><br>I have broken through doors that were closed to me several times. Things that I’ve struggled with for years have been explained in ways that make sense – and the Guitareo instructors have helped me become more comfortable. Now I’m able to sit in with friends that are way better players than me and hold my own while still having fun!",
                        'name' => 'WJ Williams',
                        'location' => 'Georgia, USA',
                        'image' => 'https://guitareo.s3.amazonaws.com/sales/2022/testimonials/williamwilliams.jpg',
                        'prev' => 'JimMcKenna',
                        'next' => 'JamieK',
                        ],
                    ]
                @endphp
                @foreach($testimonials as $testimonial)
                    <div class="{{--testimonial--}} flex w-full md:w-1/3 lg:w-1/4 px-1 md:px-2 pb-2 md:pb-4">
                        <div class="h-full w-full rounded-xl overflow-hidden cursor-pointer" data-open="{!!  str_replace(' ', '', $testimonial['name'])  !!}" style="background: #051124;">
                            <div class="thumb relative bg-top bg-cover  lazyload" style="padding-bottom:75%" data-bg="https://cdn.musora.com/image/fetch/w_500,q_auto:best/{{ $testimonial['image'] }}">
                                @if(!empty($testimonial['trailer']))
                                    <i class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 fas fa-play play-button smaller"></i>
                                @endif
                            </div>
                            <div class="p-4">
                                <p class="leading-tight"><em>{!!  $testimonial['title'] !!}</em></p>
                                <h6 class="leading-tight mt-3 mb-1 uppercase font-bebas text-guitareo">{!!  $testimonial['name'] !!}</h6>
                                <p class="leading-normal text-light-navy text-sm"><em><u>Read more</u> &nbsp;<i class="fas fa-expand"></i></em></p>
                            </div>
                        </div>
                    </div>
                @endforeach
                {{-- <div class="w-full -mt-6 lg:mt-0 block lg:hidden">
                    <div class="curosr-pointer join smaller outline light-navy testimonials-show-all mx-auto">Show More</div>
                </div> --}}
            </div>
        </div>
    </section>

    <div id="method" class="anchor"></div>
    <section class="content-section text-center px-4 lg:px-6 lazyload" style="padding-bottom: 0;" data-bg="https://cdn.musora.com/image/fetch/w_2000,q_auto:best/https://guitareo.s3.amazonaws.com/sales/2022/method-bg.jpg">
        <div class="container mx-auto clearfix max-w-6xl">
            <i class="text-3xl md:text-5xl lg:text-6xl fal fa-guitar text-guitareo"></i><br>
            <img class="h-7 md:h-10 lg:h-11 mt-3 mb-4 md:mb-8 imgfilter-method lazyload" data-src="https://dpwjbsxqtam5n.cloudfront.net/sales/2021/method-text.svg" alt="method-text">
            <h3 class="leading-tight " data-aos-once="true" data-aos="fade-up" data-aos-offset="150" data-aos-delay="150"><strong>The all-in-one guide to <br class="inline md:hidden"> conquering your guitar goals.</strong></h3>
            <h6 class="leading-normal text-light-navy mt-3 md:mt-5 mb-64 md:mb-96 md:pb-8 lg:pb-20 text-shadow-4">10 perfectly organized levels with video <br class="inline md:hidden"> lessons & exercises <br class="hidden md:inline lg:hidden"> so you’ll always learn <br class="inline md:hidden"> the right thing at the right time.</h6>
            <h3 class="leading-tight mb-6 md:mb-10 " data-aos-once="true" data-aos="fade-up" data-aos-offset="150" data-aos-delay="150"><strong> Always know exactly <br class="inline lg:hidden"> what to practice.</strong></h3>

            @php
                $levels = [
                    [
                    "navyBorder" => true,
                    "defaultOpen" => true,
                    "level" => "1",
                    "title" => "Get To Know The Guitar.",
                    "description" => 'From tuning to striking the strings to learning what a note actually is, get to know your guitar and understand how it works.',
                    "meta" => "8 Lessons"
                    ],
                    [
                    "navyBorder" => true,
                    "level" => "2",
                    "title" => "9 Essential Guitar Chords to Play Thousands Of Songs.",
                    "description" => "Music is a language and a powerful communication tool. You'll learn to read and understand chord diagrams and play progressions used in thousands of songs. ",
                    "meta" => "8 Lessons"
                    ],
                    [
                    "navyBorder" => true,
                    "level" => "3",
                    "title" => "Let's Get Rockin' with Rhythm.",
                    "description" => 'Rhythm is an important part of learning the guitar. Add groove to your playing by understanding beat, timing, and tempo.',
                    "meta" => "8 Lessons"
                    ],
                    [
                    "navyBorder" => true,
                    "level" => "4",
                    "title" => "What Are These Tabs And Chord Charts You Speak Of?",
                    "description" => 'Learn how to read, understand and play along to tabs and chord charts and unlock your ability to play all of your favorite songs in no time!',
                    "meta" => "9 Lessons"
                    ],
                    [
                    "navyBorder" => true,
                    "level" => "5",
                    "title" => "Time To Get Fancy! Add Color To Your Chords!",
                    "description" => 'With a few simple shifts of your fingers, expanding your knowledge and palette of chords is easy. Impress your friends with these "fancy" chords.',
                    "meta" => "7 Lessons"
                    ],
                    [
                    "navyBorder" => true,
                    "level" => "6",
                    "title" => "You Can Start Soloing, Like Now!",
                    "description" => "Learn three easy scales, a powerful picking technique, and how to know what key you're in to make soloing feel like second nature.",
                    "meta" => "8 Lessons"
                    ],
                    [
                    "navyBorder" => true,
                    "level" => "7",
                    "title" => "Don't Be Afraid Of Barre Chords… Embrace Them.",
                    "description" => 'Unlock the freedom to easily play ANY major or minor chord and color chords in any key across the neck of the guitar.',
                    "meta" => "8 Lessons"
                    ],
                    [
                    "navyBorder" => true,
                    "level" => "8",
                    "title" => "Expressive Techniques: Exploring Emotions In Each Note.",
                    "description" => 'Playing the guitar is so much more than just learning notes and chords. Infuse emotion and character into what you play with these expressive techniques.',
                    "meta" => "9 Lessons"
                    ],
                    [
                    "navyBorder" => true,
                    "level" => "9",
                    "title" => "Tying It All Together: Add Dazzle To Your Playing.",
                    "description" => 'Take your playing to the next level by building your lick bank and throwing some recognizable punches into your solos with these 8 licks.',
                    "meta" => "9 Lessons"
                    ],
                    [
                    "navyBorder" => true,
                    "level" => "10",
                    "title" => "You Made It! Let's Push A Bit Further.",
                    "description" => "This isn't the end of your journey - it's just the beginning. Now that you've gotten everything you need to become a complete guitarist, it's time to build a great practice routine that will help you continuously improve your playing! ",
                    "meta" => "Coming soon!"
                    ]
                ]
            @endphp
            @foreach($levels as $level)
                <div class="dropdown text-center border-2 border-gray-500 rounded-md overflow-hidden flex cursor-pointer mb-3 select-none @if(!empty($level['defaultOpen'])) active @endif
                @if(!empty($level['navyBorder'])) border-navy-600 @endif">
                    <div class="bg-guitareo py-5 px-2 sm:px-3 ">
                        <h5 class="leading-tight whitespace-nowrap inline-flex items-center">
                            <span class="text-xs hidden md:inline mr-1"> LEVEL</span>
                            <strong>{{ $level['level'] }}</strong>
                        </h5>
                    </div>
                    <div class="py-5 px-3 md:px-4 text-left flex-grow">
                        <div class="flex items-center text-left flex-col sm:flex-row relative">
                            <h5 class="leading-tight flex-grow w-full sm:w-auto"><strong>{!! $level['title'] !!}</strong></h5>
                            @if(!empty($level['meta']))
                                <p class="inline-flex text-light-navy w-full sm:w-auto">
                                    <em><strong> {!!  $level['meta'] !!} </strong></em>
                                </p>
                            @endif
                        </div>
                        @if(!empty($level['description']))
                            <p class="description leading-normal transition-all duration-300 overflow-hidden opacity-0 h-0 max-h-0 invisible text-light-navy">
                                <br>
                                {!! nl2br( $level['description']) !!}
                            </p>
                        @endif
                    </div>
                    @if(!empty($level['description']))
                        <div class="py-5 px-2 sm:px-3 ml-auto">
                            <i class="text-sm sm:text-xl @if(!empty($level['navyBorder'])) text-light-navy @endif fas fa-chevron-down transform transition-all duration-300 @if(!empty($level['defaultOpen'])) rotate-180 @endif"></i>
                        </div>
                    @endif
                </div>
            @endforeach

        </div>
    </section>
    <section class="content-section text-center px-4 lg:px-5" style="padding-top: 0;background:linear-gradient(to bottom, #01050f 60%, #021225);">
        <div class="container mx-auto clearfix max-w-6xl">

            <h4 class="mb-6 md:mb-7 lg:mb-10 mt-8 md:mt-10 lg:mt-14 leading-normal">
                <strong class="inline-block mr-1 bg-guitareo px-1 md:px-3 md:py-1 rounded-md md:rounded-lg leading-none" style="color: #000a1e;">PLUS</strong>
                <em>On-demand access to <strong class="text-guitareo">{{ GuitareoPrices::$courses }}+<br class="inline md:hidden"> courses</strong> and<br class="hidden md:inline">
                    <strong class="text-guitareo">{{ GuitareoPrices::$lessons }}+ lessons</strong> to <br class="inline md:hidden">improve any skill, anytime.</em></h4>

            <div class="testimonials w-full flex flex-wrap justify-center md:mb-2 mx-auto md:max-w-full">


                @php
                    $topics = [
                        [
                        'logo' => 'https://d122ay5chh2hr5.cloudfront.net/guitarquest/assets/guitar-quest-logo.png',
                        'image' => 'https://guitareo.s3.amazonaws.com/sales/2022/guitarquest-card.jpg',
                        'title' => 'GuitarQuest',
                        'description' => 'An entertaining 9-level adventure for getting started on the guitar and writing your own songs.',
                        'artist' => 'ROB SCALLON',
                        'credit' => 'YouTuber & Multi-Instrumentalist',
                        ],
                        [
                        'image' => 'https://guitareo.s3.amazonaws.com/sales/2022/strumming-patterns-card.jpg',
                        'title' => 'Strumming<br> Patterns',
                        'description' => 'Strumming patterns make songs easier to learn and your progressions smoother to play',
                        'artist' => 'AYLA TESLER-MABE',
                        'credit' => 'Guitarist for Ludic',
                        ],
                        [
                        'image' => 'https://guitareo.s3.amazonaws.com/sales/2022/improv-card.jpg',
                        'title' => 'Improvisation',
                        'description' => "You'll start playing your own solos by learning just a few basic concepts.",
                        'artist' => 'Andrew Clarke',
                        'credit' => 'Guitarist & Songwriter',
                        ],
                        [
                        'image' => 'https://guitareo.s3.amazonaws.com/sales/2022/pentatonic-card.jpg',
                        'title' => 'Pentatonic<br> Scales',
                        'description' => 'Know the standard pentatonic scale “box”, and how to break out of it by moving up the fretboard.',
                        'artist' => 'AYLA TESLER-MABE',
                        'credit' => 'Guitarist for Ludic',
                        ],
                        [
                        'logo' => 'https://s3.amazonaws.com/guitareo/acoustic-guitar-made-easy/sales/AGME-logo-white.png',
                        'image' => 'https://guitareo.s3.amazonaws.com/sales/2022/agme-card.jpg',
                        'title' => 'Acoustic Guitar Made Easy',
                        'description' => 'Play everything you’ve wanted on the acoustic guitar with 26 weekly lessons & exercises.',
                        'artist' => 'NATE SAVAGE',
                        'credit' => 'Educator & Musician',
                        ],
                        [
                        'logo' => 'https://guitareo.s3.amazonaws.com/gtme/logo-white.png',
                        'image' => 'https://guitareo.s3.amazonaws.com/sales/2022/gtme-card.jpg',
                        'title' => 'Guitar Technique Made Easy',
                        'description' => '26 weekly lessons to learn the most important guitar techniques & unlock total guitar freedom.',
                        'artist' => 'NATE SAVAGE',
                        'credit' => 'Educator & Musician',
                        ],
                        [
                        'logo' => 'https://d1923uyy6spedc.cloudfront.net/206357-logo-image-1583865416.svg',
                        'image' => 'https://guitareo.s3.amazonaws.com/sales/2022/ultimate-card.jpg',
                        'title' => 'The Ultimate Guide To Recording Guitar',
                        'description' => 'Learn how to record your own high quality guitar tracks -- electric or acoustic, with any setup.',
                        'artist' => 'VICTOR GUIDERA',
                        'credit' => 'Musora’s Audio Guru',
                        ],
                        [
                        'image' => 'https://guitareo.s3.amazonaws.com/sales/2022/eg-card.jpg',
                        'title' => 'Electric<br> Guitar',
                        'description' => 'Everything you need to start on the electric guitar, including along to a song with a jam track!',
                        'artist' => 'AYLA TESLER-MABE',
                        'credit' => 'Guitarist for Ludic',
                        ],
                        [
                        'image' => 'https://guitareo.s3.amazonaws.com/sales/2022/ag-card.jpg',
                        'title' => 'Acoustic<br> Guitar',
                        'description' => 'Get started on the acoustic guitar and start playing music as fast as possible!',
                        'artist' => 'AYLA TESLER-MABE',
                        'credit' => 'Guitarist for Ludic',
                        ],
                        [
                        'image' => 'https://guitareo.s3.amazonaws.com/sales/2022/guitar-chords-card.jpg',
                        'title' => 'Guitar<br> Chords',
                        'description' => 'Expand your chord vocabulary, learn new chords, and increase your understanding of the guitar.',
                        'artist' => 'ASHER KURTZ',
                        'credit' => 'Educator & Composer',
                        ],
                        [
                        'image' => 'https://guitareo.s3.amazonaws.com/sales/2022/timing-feel-card.jpg',
                        'title' => 'Timing<br> & Feel',
                        'description' => 'Better your timing and feel as you add more rhythms to the songs you love.',
                        'artist' => 'DAVID BECKER',
                        'credit' => 'GRAMMY & Emmy Nominee',
                        ],
                        [
                        'image' => 'https://guitareo.s3.amazonaws.com/sales/2022/fingerstyle-thumb.jpg',
                        'title' => 'Fingerstyle',
                        'description' => 'Improve your fingerpicking and start exploring open and altered tunings',
                        'artist' => 'SAMI GHAWI',
                        'credit' => 'Educator & Musician',
                        ],
                        [
                        'image' => 'https://guitareo.s3.amazonaws.com/sales/2022/scales-thumb.jpg',
                        'title' => 'Guitar<br> Scales',
                        'description' => 'Focus on the many different scales used on the guitar and how to use them',
                        'artist' => 'KENT SHORES',
                        'credit' => 'Educator & Musician',
                        ],
                        [
                        'image' => 'https://guitareo.s3.amazonaws.com/sales/2022/songwriting-card.jpg',
                        'title' => 'Songwriting',
                        'description' => 'Step outside the 3 chord progression pattern and start writing your own songs',
                        'artist' => 'ROB SCALLON',
                        'credit' => 'YouTuber & Multi-Instrumentalist',
                        ],
                        [
                        'image' => 'https://guitareo.s3.amazonaws.com/sales/2022/eartraining-thumb.jpg',
                        'title' => 'Ear <br>Training',
                        'description' => 'Focus on training your ear to recognize chords, chord progressions, intervals, and melodies.',
                        'artist' => 'NATE SAVAGE',
                        'credit' => 'Educator & Musician',
                        ],
                        [
                        'image' => 'https://guitareo.s3.amazonaws.com/sales/2022/picking-card.jpg',
                        'title' => 'Picking',
                        'description' => 'Start your picking technique off right and develop your own personal technique.',
                        'artist' => 'NATE SAVAGE',
                        'credit' => 'Educator & Musician',
                        ],
                    ]
                @endphp
                @foreach($topics as $topic)

                    <div class="testimonial relative px-1 md:px-2 lg:px-1 w-full sm:w-1/3 lg:w-1/4 mx-auto mb-3 md:mb-5 lg:mb-1.5">
                        <div class="flip-div inline-block relative md:w-full group" style="perspective: 1000px;" data-aos-once="true" data-aos="fade-down" data-aos-offset="200" data-aos-duration="250" data-aos-delay="200">
                            <div class="text-center relative md:w-full md:h-full md:absolute cursor-pointer" style="transform-style: preserve-3d;">
                                <div class="front relative z-20 overflow-hidden rounded-xl md:w-full md:h-full md:absolute transition-transform duration-700" style="backface-visibility: hidden;">
                                    <div class="absolute z-40 text-center top-1/2 left-1/2 text-white transition-opacity duration-300 transform -translate-x-1/2 -translate-y-1/2 hidden md:visible opacity-0 group-hover:opacity-100 text-shadow-2">
                                        <i class="fas fa-arrow-right text-4xl"></i><br>
                                        <p class="text-sm"><strong>DETAILS</strong></p>
                                    </div>
                                    <div class="bg-image w-full bg-black bg-top bg-cover lazyload" data-bg="https://cdn.musora.com/image/fetch/w_550,q_auto:best/{{ $topic['image'] }}"></div>
                                    <div class="absolute uppercase w-full bottom-3 md:bottom-5 z-10 text-shadow-4">
                                        @if(!empty($topic['logo']))
                                            <div class="px-6">
                                                <img class="w-full h-12 md:h-16 object-contain lazyload" data-src="https://cdn.musora.com/image/fetch/w_460,q_auto:best/{{ $topic['logo'] }}" alt="{{ $topic['title'] }}">
                                            </div>
                                        @else
                                            <h3><strong> {!! $topic['title']  !!} </strong></h3>
                                        @endif
                                    </div>
                                    @if(!empty($topic['logo']))
                                        <div class="absolute inset-0 rounded-xl overflow-hidden z-0" style="background:linear-gradient(to bottom, rgba(0,0,0,0) 40%, #032d2e 100%);"></div>
                                    @else
                                        <div class="absolute inset-0 rounded-xl overflow-hidden z-0" style="background:linear-gradient(to bottom, rgba(0,0,0,0) 40%, #000 100%);"></div>
                                    @endif
                                </div>
                                <div class="back relative z-40 overflow-hidden rounded-xl md:w-full md:h-full md:absolute transition-transform duration-700" style="backface-visibility: hidden;">
                                    <div class="w-full h-full mx-auto text-center md:text-black md:bg-white flex flex-wrap justify-center items-center content-center pt-3 md:p-3">
                                        <h5 class="leading-none uppercase mx-auto mb-2 md:mb-3 hidden sm:inline-block"><strong>{!! $topic['title']  !!}</strong></h5>
                                        <p class="leading-normal mx-auto">{{ $topic['description'] }}</p>
                                        @if(!empty($topic['artist']))
                                            <h6 class="w-full leading-normal uppercase mt-2 md:mt-3 mx-auto text-guitareo hidden md:inline-block"><strong>{!! $topic['artist'] !!}</strong></h6>
                                        @endif
                                        @if(!empty($topic['credit']))
                                            <p class="w-full leading-tight text-guitareo hidden md:inline-block"><em>{{ $topic['credit'] }}</em></p>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
                {{--<div class="w-full -mt-6 lg:mt-0">--}}
                    {{--<div class="curosr-pointer join smaller outline light-navy testimonials-show-all mx-auto">Show More</div>--}}
                {{--</div>--}}
            </div>
            <br>
            {{-- <a
                    @hasSection('start-button')
                    href="@yield('start-button')" class="join blue smaller"
                    @else
                    href="#customize-anchor" class="join blue smaller anchor-slide"
                    @endif
            >GET STARTED</a> --}}
        </div>
    </section>

    <div id="songs" class="anchor"></div>
    <section class="content-section text-center relative" style="background:linear-gradient(to bottom, #01050f 80%, #021225);">
        <div class="song-wrap relative z-0 overflow-hidden">
            <div class="song-row absolute z-0 whitespace-nowrap">
                <img class="lazyload" data-src="https://cdn.musora.com/image/fetch/w_400,q_auto:best/https://d1923uyy6spedc.cloudfront.net/drumeo-songs-2021-jan/album-art/ABBA-Dancing%20Queen.jpg" alt="ABBA - Dancing Queen">
                <img class="lazyload" data-src="https://cdn.musora.com/image/fetch/w_400,q_auto:best/https://d1923uyy6spedc.cloudfront.net/drumeo-songs-2020-june/album-art/aerosmith-i-don_t-want-to-miss-a-thing.jpg" alt="AEROSMITH - I Don’t Want To Miss A Thing">
                <img class="lazyload" data-src="https://cdn.musora.com/image/fetch/w_400,q_auto:best/https://d1923uyy6spedc.cloudfront.net/drumeo-songs-2020-dec/album-art/bastille-pompeii.jpg" alt="BASTILLE - Pompeii">
                <img class="lazyload" data-src="https://cdn.musora.com/image/fetch/w_400,q_auto:best/https://d1923uyy6spedc.cloudfront.net/drumeo-songs-2020-june/album-art/the-beatles-come-together.jpg" alt="THE BEATLES - Come Together">
                <img class="lazyload" data-src="https://cdn.musora.com/image/fetch/w_400,q_auto:best/https://d1923uyy6spedc.cloudfront.net/291230-card-thumbnail-maxres-1613587436.jpg" alt="BILLIE EILISH - Bad Guy">
                <img class="lazyload" data-src="https://cdn.musora.com/image/fetch/w_400,q_auto:best/https://d1923uyy6spedc.cloudfront.net/drumeo-songs-2020-november/album-art/bob-dylan-knocking-on-heavens-door.jpg" alt="BOB DYLAN - Knockin’ On Heaven’s Door">
                <img class="lazyload" data-src="https://cdn.musora.com/image/fetch/w_400,q_auto:best/https://d1923uyy6spedc.cloudfront.net/drumeo-songs-2020-june/album-art/bon-jovi-livin-on-a-prayer.jpg" alt="BON JOVI - Livin’ On A Prayer">
                <img class="lazyload" data-src="https://cdn.musora.com/image/fetch/w_400,q_auto:best/https://d1923uyy6spedc.cloudfront.net/drumeo-songs-2020-september/album-art/bruce-springsteen-dancing-in-the-dark.jpg" alt="BRUCE SPRINGSTEEN - Dancing In The Dark">

                <img class="lazyload" data-src="https://cdn.musora.com/image/fetch/w_400,q_auto:best/https://d1923uyy6spedc.cloudfront.net/drumeo-songs-2021-jan/album-art/ABBA-Dancing%20Queen.jpg" alt="ABBA - Dancing Queen">
                <img class="lazyload" data-src="https://cdn.musora.com/image/fetch/w_400,q_auto:best/https://d1923uyy6spedc.cloudfront.net/drumeo-songs-2020-june/album-art/aerosmith-i-don_t-want-to-miss-a-thing.jpg" alt="AEROSMITH - I Don’t Want To Miss A Thing">
                <img class="lazyload" data-src="https://cdn.musora.com/image/fetch/w_400,q_auto:best/https://d1923uyy6spedc.cloudfront.net/drumeo-songs-2020-dec/album-art/bastille-pompeii.jpg" alt="BASTILLE - Pompeii">
                <img class="lazyload" data-src="https://cdn.musora.com/image/fetch/w_400,q_auto:best/https://d1923uyy6spedc.cloudfront.net/drumeo-songs-2020-june/album-art/the-beatles-come-together.jpg" alt="THE BEATLES - Come Together">
                <img class="lazyload" data-src="https://cdn.musora.com/image/fetch/w_400,q_auto:best/https://d1923uyy6spedc.cloudfront.net/291230-card-thumbnail-maxres-1613587436.jpg" alt="BILLIE EILISH - Bad Guy">
                <img class="lazyload" data-src="https://cdn.musora.com/image/fetch/w_400,q_auto:best/https://d1923uyy6spedc.cloudfront.net/drumeo-songs-2020-november/album-art/bob-dylan-knocking-on-heavens-door.jpg" alt="BOB DYLAN - Knockin’ On Heaven’s Door">
                <img class="lazyload" data-src="https://cdn.musora.com/image/fetch/w_400,q_auto:best/https://d1923uyy6spedc.cloudfront.net/drumeo-songs-2020-june/album-art/bon-jovi-livin-on-a-prayer.jpg" alt="BON JOVI - Livin’ On A Prayer">
                <img class="lazyload" data-src="https://cdn.musora.com/image/fetch/w_400,q_auto:best/https://d1923uyy6spedc.cloudfront.net/drumeo-songs-2020-september/album-art/bruce-springsteen-dancing-in-the-dark.jpg" alt="BRUCE SPRINGSTEEN - Dancing In The Dark">
            </div>
            <div class="song-row absolute z-0 whitespace-nowrap">
                <img class="lazyload" data-src="https://cdn.musora.com/image/fetch/w_400,q_auto:best/https://d1923uyy6spedc.cloudfront.net/drumeo-songs-2020-june/album-art/bryan-adams-summer-of-69.jpg" alt="BRYAN ADAMS - Summer of ‘69">
                <img class="lazyload" data-src="https://cdn.musora.com/image/fetch/w_400,q_auto:best/https://guitareo.s3.amazonaws.com/sales/2021/songs/camila-cabello-havana.jpg" alt="CAMILA CABELLO - Havana">
                <img class="lazyload" data-src="https://cdn.musora.com/image/fetch/w_400,q_auto:best/https://d1923uyy6spedc.cloudfront.net/drumeo-songs-2021-feb/album-art/The Chainsmokers-Paris.jpg" alt="THE CHAINSMOKERS - Paris">
                <img class="lazyload" data-src="https://cdn.musora.com/image/fetch/w_400,q_auto:best/https://d1923uyy6spedc.cloudfront.net/drumeo-songs-2020-dec/album-art/coldplay-speed-of-sound.jpg" alt="COLDPLAY - Speed Of Sound">
                <img class="lazyload" data-src="https://cdn.musora.com/image/fetch/w_400,q_auto:best/https://guitareo.s3.amazonaws.com/sales/2021/songs/christina-perri-jar-of-hearts.jpg" alt="CHRISTINA PERRI - Jar Of Hearts">
                <img class="lazyload" data-src="https://cdn.musora.com/image/fetch/w_400,q_auto:best/https://d1923uyy6spedc.cloudfront.net/drumeo-songs-2020-june/album-art/eagles-hotel-california.jpg" alt="EAGLES - Hotel California">
                <img class="lazyload" data-src="https://cdn.musora.com/image/fetch/w_400,q_auto:best/https://d1923uyy6spedc.cloudfront.net/drumeo-songs-2020-july/album-art/ed-sheeran-perfect.jpg" alt="ED SHEERAN - Perfect">
                <img class="lazyload" data-src="https://cdn.musora.com/image/fetch/w_400,q_auto:best/https://d1923uyy6spedc.cloudfront.net/drumeo-songs-2020-dec/album-art/willie-nelson-on-the-the-road-again.jpg" alt="WILLIE NELSON - On The Road Again">

                <img class="lazyload" data-src="https://cdn.musora.com/image/fetch/w_400,q_auto:best/https://d1923uyy6spedc.cloudfront.net/drumeo-songs-2020-june/album-art/bryan-adams-summer-of-69.jpg" alt="BRYAN ADAMS - Summer of ‘69">
                <img class="lazyload" data-src="https://cdn.musora.com/image/fetch/w_400,q_auto:best/https://guitareo.s3.amazonaws.com/sales/2021/songs/camila-cabello-havana.jpg" alt="CAMILA CABELLO - Havana">
                <img class="lazyload" data-src="https://cdn.musora.com/image/fetch/w_400,q_auto:best/https://d1923uyy6spedc.cloudfront.net/drumeo-songs-2021-feb/album-art/The Chainsmokers-Paris.jpg" alt="THE CHAINSMOKERS - Paris">
                <img class="lazyload" data-src="https://cdn.musora.com/image/fetch/w_400,q_auto:best/https://d1923uyy6spedc.cloudfront.net/drumeo-songs-2020-dec/album-art/coldplay-speed-of-sound.jpg" alt="COLDPLAY - Speed Of Sound">
                <img class="lazyload" data-src="https://cdn.musora.com/image/fetch/w_400,q_auto:best/https://guitareo.s3.amazonaws.com/sales/2021/songs/christina-perri-jar-of-hearts.jpg" alt="CHRISTINA PERRI - Jar Of Hearts">
                <img class="lazyload" data-src="https://cdn.musora.com/image/fetch/w_400,q_auto:best/https://d1923uyy6spedc.cloudfront.net/drumeo-songs-2020-june/album-art/eagles-hotel-california.jpg" alt="EAGLES - Hotel California">
                <img class="lazyload" data-src="https://cdn.musora.com/image/fetch/w_400,q_auto:best/https://d1923uyy6spedc.cloudfront.net/drumeo-songs-2020-july/album-art/ed-sheeran-perfect.jpg" alt="ED SHEERAN - Perfect">
                <img class="lazyload" data-src="https://cdn.musora.com/image/fetch/w_400,q_auto:best/https://d1923uyy6spedc.cloudfront.net/drumeo-songs-2020-dec/album-art/willie-nelson-on-the-the-road-again.jpg" alt="WILLIE NELSON - On The Road Again">
            </div>
            <div class="song-row absolute z-0 whitespace-nowrap">
                <img class="lazyload" data-src="https://cdn.musora.com/image/fetch/w_400,q_auto:best/https://d1923uyy6spedc.cloudfront.net/drumeo-songs-2020-july/album-art/elton-john-rocket-man.jpg" alt="ELTON JOHN - Rocket Man">
                <img class="lazyload" data-src="https://cdn.musora.com/image/fetch/w_400,q_auto:best/https://guitareo.s3.amazonaws.com/sales/2021/songs/foster-the-people-pumped-up-kicks.jpeg" alt="FOSTER THE PEOPLE - Pumped Up Kicks">
                <img class="lazyload" data-src="https://cdn.musora.com/image/fetch/w_400,q_auto:best/https://guitareo.s3.amazonaws.com/sales/2021/songs/goo-goo-dolls-iris.jpg" alt="GOO GOO DOLLS - Iris">
                <img class="lazyload" data-src="https://cdn.musora.com/image/fetch/w_400,q_auto:best/https://d1923uyy6spedc.cloudfront.net/drumeo-songs-2020-july/album-art/green-day-wake-me-up-when-september-ends.jpg" alt="GREEN DAY - Wake Me Up When September Ends">
                <img class="lazyload" data-src="https://cdn.musora.com/image/fetch/w_400,q_auto:best/https://d1923uyy6spedc.cloudfront.net/drumeo-songs-2020-november/album-art/imagine-dragons-Believer.jpg" alt="IMAGINE DRAGONS - Believer">
                <img class="lazyload" data-src="https://cdn.musora.com/image/fetch/w_400,q_auto:best/https://d1923uyy6spedc.cloudfront.net/drumeo-songs-2020-dec/album-art/jason-mraz-im-yours.jpg" alt="JASON MRAZ - I’m Yours">
                <img class="lazyload" data-src="https://cdn.musora.com/image/fetch/w_400,q_auto:best/https://guitareo.s3.amazonaws.com/sales/2021/songs/john-mellencamp-jack-_-diane.jpeg" alt="JOHN MELLENCAMP - Jack &amp; Diane">
                <img class="lazyload" data-src="https://cdn.musora.com/image/fetch/w_400,q_auto:best/https://guitareo.s3.amazonaws.com/sales/2021/songs/johnny-cash-hurt.jpeg" alt="JOHNNY CASH - Hurt">

                <img class="lazyload" data-src="https://cdn.musora.com/image/fetch/w_400,q_auto:best/https://d1923uyy6spedc.cloudfront.net/drumeo-songs-2020-july/album-art/elton-john-rocket-man.jpg" alt="ELTON JOHN - Rocket Man">
                <img class="lazyload" data-src="https://cdn.musora.com/image/fetch/w_400,q_auto:best/https://guitareo.s3.amazonaws.com/sales/2021/songs/foster-the-people-pumped-up-kicks.jpeg" alt="FOSTER THE PEOPLE - Pumped Up Kicks">
                <img class="lazyload" data-src="https://cdn.musora.com/image/fetch/w_400,q_auto:best/https://guitareo.s3.amazonaws.com/sales/2021/songs/goo-goo-dolls-iris.jpg" alt="GOO GOO DOLLS - Iris">
                <img class="lazyload" data-src="https://cdn.musora.com/image/fetch/w_400,q_auto:best/https://d1923uyy6spedc.cloudfront.net/drumeo-songs-2020-july/album-art/green-day-wake-me-up-when-september-ends.jpg" alt="GREEN DAY - Wake Me Up When September Ends">
                <img class="lazyload" data-src="https://cdn.musora.com/image/fetch/w_400,q_auto:best/https://d1923uyy6spedc.cloudfront.net/drumeo-songs-2020-november/album-art/imagine-dragons-Believer.jpg" alt="IMAGINE DRAGONS - Believer">
                <img class="lazyload" data-src="https://cdn.musora.com/image/fetch/w_400,q_auto:best/https://d1923uyy6spedc.cloudfront.net/drumeo-songs-2020-dec/album-art/jason-mraz-im-yours.jpg" alt="JASON MRAZ - I’m Yours">
                <img class="lazyload" data-src="https://cdn.musora.com/image/fetch/w_400,q_auto:best/https://guitareo.s3.amazonaws.com/sales/2021/songs/john-mellencamp-jack-_-diane.jpeg" alt="JOHN MELLENCAMP - Jack &amp; Diane">
                <img class="lazyload" data-src="https://cdn.musora.com/image/fetch/w_400,q_auto:best/https://guitareo.s3.amazonaws.com/sales/2021/songs/johnny-cash-hurt.jpeg" alt="JOHNNY CASH - Hurt">
            </div>
            <div class="song-row absolute z-0 whitespace-nowrap">
                <img class="lazyload" data-src="https://cdn.musora.com/image/fetch/w_400,q_auto:best/https://guitareo.s3.amazonaws.com/sales/2021/songs/kenny-rogers-the-gambler.jpeg" alt="KENNY ROGERS - The Gambler">
                <img class="lazyload" data-src="https://cdn.musora.com/image/fetch/w_400,q_auto:best/https://guitareo.s3.amazonaws.com/sales/2021/songs/lifehouse-you-and-me.jpeg" alt="LIFEHOUSE - You And Me">
                <img class="lazyload" data-src="https://cdn.musora.com/image/fetch/w_400,q_auto:best/https://guitareo.s3.amazonaws.com/sales/2021/songs/the-lumineers-ho-hey.jpeg" alt="THE LUMINEERS - Ho Hey">
                <img class="lazyload" data-src="https://cdn.musora.com/image/fetch/w_400,q_auto:best/https://d1923uyy6spedc.cloudfront.net/drumeo-songs-2020-june/album-art/maroon-5-this-love.jpg" alt="MAROON 5 - This Love">
                <img class="lazyload" data-src="https://cdn.musora.com/image/fetch/w_400,q_auto:best/https://d1923uyy6spedc.cloudfront.net/drumeo-songs-2020-june/album-art/metallica-nothing-else-matters.jpg" alt="METALLICA - Nothing Else Matters">
                <img class="lazyload" data-src="https://cdn.musora.com/image/fetch/w_400,q_auto:best/https://d1923uyy6spedc.cloudfront.net/drumeo-songs-2020-july/album-art/pharrell-williams-happy.jpg" alt="PHARRELL WILLIAMS - Happy">
                <img class="lazyload" data-src="https://cdn.musora.com/image/fetch/w_400,q_auto:best/https://guitareo.s3.amazonaws.com/sales/2021/songs/prince-little-red-corvette.jpeg" alt="PRINCE - Little Red Corvette">
                <img class="lazyload" data-src="https://cdn.musora.com/image/fetch/w_400,q_auto:best/https://guitareo.s3.amazonaws.com/sales/2021/songs/shania-twain-you_re-still-the-one.jpeg" alt="SHANIA TWAIN - You’re Still The One">

                <img class="lazyload" data-src="https://cdn.musora.com/image/fetch/w_400,q_auto:best/https://guitareo.s3.amazonaws.com/sales/2021/songs/kenny-rogers-the-gambler.jpeg" alt="KENNY ROGERS - The Gambler">
                <img class="lazyload" data-src="https://cdn.musora.com/image/fetch/w_400,q_auto:best/https://guitareo.s3.amazonaws.com/sales/2021/songs/lifehouse-you-and-me.jpeg" alt="LIFEHOUSE - You And Me">
                <img class="lazyload" data-src="https://cdn.musora.com/image/fetch/w_400,q_auto:best/https://guitareo.s3.amazonaws.com/sales/2021/songs/the-lumineers-ho-hey.jpeg" alt="THE LUMINEERS - Ho Hey">
                <img class="lazyload" data-src="https://cdn.musora.com/image/fetch/w_400,q_auto:best/https://d1923uyy6spedc.cloudfront.net/drumeo-songs-2020-june/album-art/maroon-5-this-love.jpg" alt="MAROON 5 - This Love">
                <img class="lazyload" data-src="https://cdn.musora.com/image/fetch/w_400,q_auto:best/https://d1923uyy6spedc.cloudfront.net/drumeo-songs-2020-june/album-art/metallica-nothing-else-matters.jpg" alt="METALLICA - Nothing Else Matters">
                <img class="lazyload" data-src="https://cdn.musora.com/image/fetch/w_400,q_auto:best/https://d1923uyy6spedc.cloudfront.net/drumeo-songs-2020-july/album-art/pharrell-williams-happy.jpg" alt="PHARRELL WILLIAMS - Happy">
                <img class="lazyload" data-src="https://cdn.musora.com/image/fetch/w_400,q_auto:best/https://guitareo.s3.amazonaws.com/sales/2021/songs/prince-little-red-corvette.jpeg" alt="PRINCE - Little Red Corvette">
                <img class="lazyload" data-src="https://cdn.musora.com/image/fetch/w_400,q_auto:best/https://guitareo.s3.amazonaws.com/sales/2021/songs/shania-twain-you_re-still-the-one.jpeg" alt="SHANIA TWAIN - You’re Still The One">
            </div>
            <div class="song-row absolute z-0 whitespace-nowrap">
                <img class="lazyload" data-src="https://cdn.musora.com/image/fetch/w_400,q_auto:best/https://d1923uyy6spedc.cloudfront.net/drumeo-songs-2021-feb/album-art/Shawn Mendes-In My Blood.jpg" alt="SHAWN MENDES - Stitches">
                <img class="lazyload" data-src="https://cdn.musora.com/image/fetch/w_400,q_auto:best/https://d1923uyy6spedc.cloudfront.net/drumeo-songs-2020-june/album-art/survivor-eye-of-the-tiger.jpg" alt="SURVIVOR - Eye Of The Tiger">
                <img class="lazyload" data-src="https://cdn.musora.com/image/fetch/w_400,q_auto:best/https://d1923uyy6spedc.cloudfront.net/drumeo-songs-2020-september/album-art/taylor-switft-shake-it-off.jpg" alt="TAYLOR SWIFT - Shake It Off">
                <img class="lazyload" data-src="https://cdn.musora.com/image/fetch/w_400,q_auto:best/https://d1923uyy6spedc.cloudfront.net/drumeo-songs-2020-july/album-art/tom-petty-free-fallin.jpg" alt="TOM PETTY - Free Fallin’">
                <img class="lazyload" data-src="https://cdn.musora.com/image/fetch/w_400,q_auto:best/https://guitareo.s3.amazonaws.com/sales/2021/songs/tracy-chapman-fast-car.jpeg" alt="TRACY CHAPMAN - Fast Car">
                <img class="lazyload" data-src="https://cdn.musora.com/image/fetch/w_400,q_auto:best/https://d1923uyy6spedc.cloudfront.net/291672-card-thumbnail-maxres-1613594848.jpg" alt="U2 - With Or Without You">
                <img class="lazyload" data-src="https://cdn.musora.com/image/fetch/w_400,q_auto:best/https://d1923uyy6spedc.cloudfront.net/drumeo-songs-2020-june/album-art/van-morrison-brown-eyed-girl.jpg" alt="VAN MORRISON - Brown Eyed Girl">
                <img class="lazyload" data-src="https://cdn.musora.com/image/fetch/w_400,q_auto:best/https://d1923uyy6spedc.cloudfront.net/drumeo-songs-2020-june/album-art/creedence-clearwater-revival-have-you-ever-seen-the-rain.jpg" alt="CREEDENCE CLEARWATER REVIVAL - Have You Ever Seen The Rain?">

                <img class="lazyload" data-src="https://cdn.musora.com/image/fetch/w_400,q_auto:best/https://d1923uyy6spedc.cloudfront.net/drumeo-songs-2021-feb/album-art/Shawn Mendes-In My Blood.jpg" alt="SHAWN MENDES - Stitches">
                <img class="lazyload" data-src="https://cdn.musora.com/image/fetch/w_400,q_auto:best/https://d1923uyy6spedc.cloudfront.net/drumeo-songs-2020-june/album-art/survivor-eye-of-the-tiger.jpg" alt="SURVIVOR - Eye Of The Tiger">
                <img class="lazyload" data-src="https://cdn.musora.com/image/fetch/w_400,q_auto:best/https://d1923uyy6spedc.cloudfront.net/drumeo-songs-2020-september/album-art/taylor-switft-shake-it-off.jpg" alt="TAYLOR SWIFT - Shake It Off">
                <img class="lazyload" data-src="https://cdn.musora.com/image/fetch/w_400,q_auto:best/https://d1923uyy6spedc.cloudfront.net/drumeo-songs-2020-july/album-art/tom-petty-free-fallin.jpg" alt="TOM PETTY - Free Fallin’">
                <img class="lazyload" data-src="https://cdn.musora.com/image/fetch/w_400,q_auto:best/https://guitareo.s3.amazonaws.com/sales/2021/songs/tracy-chapman-fast-car.jpeg" alt="TRACY CHAPMAN - Fast Car">
                <img class="lazyload" data-src="https://cdn.musora.com/image/fetch/w_400,q_auto:best/https://d1923uyy6spedc.cloudfront.net/291672-card-thumbnail-maxres-1613594848.jpg" alt="U2 - With Or Without You">
                <img class="lazyload" data-src="https://cdn.musora.com/image/fetch/w_400,q_auto:best/https://d1923uyy6spedc.cloudfront.net/drumeo-songs-2020-june/album-art/van-morrison-brown-eyed-girl.jpg" alt="VAN MORRISON - Brown Eyed Girl">
                <img class="lazyload" data-src="https://cdn.musora.com/image/fetch/w_400,q_auto:best/https://d1923uyy6spedc.cloudfront.net/drumeo-songs-2020-june/album-art/creedence-clearwater-revival-have-you-ever-seen-the-rain.jpg" alt="CREEDENCE CLEARWATER REVIVAL - Have You Ever Seen The Rain?">
            </div>
            <div class="absolute z-10 inset-0" style="background: linear-gradient(to bottom, #01050f, rgba(41,47,61,0.7), #01050f);"></div>
        </div>
        <div class="px-4 lg:px-6">
            <div class="container mx-auto relative z-10 max-w-6xl">
                <i class="text-3xl md:text-5xl lg:text-6xl icon-songs text-songs"></i><br>
                <img class="h-7 md:h-10 lg:h-11 mt-1 mb-4 md:mb-8 imgfilter-songs lazyload" data-src="https://cdn.musora.com/image/fetch/q_auto:best/https://dpwjbsxqtam5n.cloudfront.net/sales/2021/songs-text.svg" alt="songs-text">
                <h3 class="" data-aos-once="true" data-aos="fade-up" data-aos-offset="150" data-aos-delay="150"><strong>Play your favorite songs.</strong></h3>
                <h6 class="leading-normal max-w-2xl lg:max-w-4xl text-light-navy mt-3 md:mt-5 mb-64 md:mb-96 md:pb-20 text-shadow-4">Your guitar was designed to do one thing. Play songs. Whether it's playing songs by your favorite artists for your own enjoyment or entertaining an audience, you'll always be able to keep your setlist fresh and up to date, never having to search for that perfect tab or chord chart again.</h6>
                <h4 class="mb-6 md:mb-7 lg:mb-10 leading-normal"><strong class="inline-block mr-1 bg-songs px-3 py-1 rounded-md md:rounded-lg leading-none" style="color: #000a1e;">500 CHORD CHARTS <br class="inline sm:hidden"> AT YOUR FINGERTIPS</strong><br>
                    <em class="text-shadow-4">Play popular songs faster with access to chord<br class="hidden md:inline"> charts for every <strong class="text-songs">style</strong>, <strong class="text-songs">era</strong>, and <strong class="text-songs">skill level</strong>.</em></h4>
                <div class="feature-rotater w-full max-w-md md:max-w-full flex flex-wrap md:flex-nowrap items-center mx-auto mt-4 md:mt-14 lg:mt-20 mb-8 md:mb-10 px-2">
                    <div class="pic-wrap md:order-1 mx-auto my-5 md:my-0 pl-0 md:pl-5 lg:pl-10 flex-shrink-0">
                        <img class="lazyload side-pic songs w-full hidden" data-src="https://cdn.musora.com/image/fetch/w_800,q_auto:best/https://guitareo.s3.amazonaws.com/sales/2022/guitareo-site-screens-03.png" alt="site-screen-3">
                        <img class="lazyload side-pic songs w-full hidden" data-src="https://cdn.musora.com/image/fetch/w_800,q_auto:best/https://guitareo.s3.amazonaws.com/sales/2022/guitareo-site-screens-1.png" alt="site-screen-1">
                        <img class="lazyload side-pic songs w-full md:hidden" data-src="https://cdn.musora.com/image/fetch/w_800,q_auto:best/https://guitareo.s3.amazonaws.com/sales/2022/guitareo-site-screens-05.png" alt="site-screen-5">
                        <img class="lazyload side-pic songs w-full hidden" data-src="https://cdn.musora.com/image/fetch/w_800,q_auto:best/https://guitareo.s3.amazonaws.com/sales/2022/guitareo-site-screens-04.png" alt="site-screen-4">
                        <img class="lazyload side-pic songs w-full hidden" data-src="https://cdn.musora.com/image/fetch/w_800,q_auto:best/https://guitareo.s3.amazonaws.com/sales/2022/guitareo_site_screens-6.png" alt="site-screen-6">
                    </div>
                    <div class="text-left text-light-navy">
                        <div class="flex mx-auto mb-9 md:mb-7 lg:mb-8 md:cursor-pointer text-icon-wrap songs md:opacity-60 hover:opacity-90 active">
                            <i class="flex-shrink-0 w-8 md:w-10 lg:w-11 text-2xl md:text-3xl text-songs fal fa-guitars"></i>
                            <div class="pl-3">
                                <h4 class="mx-auto mb-2 md:mb-3"><strong>Your guide to playing anything.</strong></h4>
                                <p>You’ll get a five-day bootcamp teaching you the critical concepts for playing almost anything with chord charts.</p>
                            </div>
                        </div>
                        <div class="flex mx-auto mb-9 md:mb-7 lg:mb-8 md:cursor-pointer text-icon-wrap songs md:opacity-60 hover:opacity-90">
                            <i class="flex-shrink-0 w-8 md:w-10 lg:w-11 text-2xl md:text-3xl text-songs fal fa-list-music"></i>
                            <div class="pl-3">
                                <h4 class="mx-auto mb-2 md:mb-3"><strong>Pick the perfect song for you.</strong></h4>
                                <p>Choose songs from any era or style including country, electronic, folk, funk, hip-hop, jazz, latin, metal, pop, R&B, rock, soul, and more!</p>
                            </div>
                        </div>
                        <div class="flex mx-auto mb-9 md:mb-7 lg:mb-8 md:cursor-pointer text-icon-wrap songs md:opacity-60 hover:opacity-90">
                            <i class="flex-shrink-0 w-8 md:w-10 lg:w-11 text-2xl md:text-3xl text-songs fal fa-sliders-v"></i>
                            <div class="pl-3">
                                <h4 class="mx-auto mb-2 md:mb-3"><strong>Tuned for your convenience.</strong></h4>
                                <p>Every chord chart is provided in its original key PLUS available separately in the Key of G, so you can always pick what’s right for you.</p>
                            </div>
                        </div>
                        <div class="flex mx-auto mb-9 md:mb-7 lg:mb-8 md:cursor-pointer text-icon-wrap songs md:opacity-60 hover:opacity-90">
                            <i class="flex-shrink-0 w-8 md:w-10 lg:w-11 text-2xl md:text-3xl text-songs fal fa-arrow-to-bottom"></i>
                            <div class="pl-3">
                                <h4 class="mx-auto mb-2 md:mb-3"><strong>Take your charts anywhere.</strong></h4>
                                <p>Downloadable PDF files let you take your chord charts anywhere – at home, to your next band rehearsal, and then to the gig.</p>
                            </div>
                        </div>
                        <div class="flex mx-auto md:cursor-pointer text-icon-wrap songs md:opacity-60 hover:opacity-90">
                            <i class="flex-shrink-0 w-8 md:w-10 lg:w-11 text-2xl md:text-3xl text-songs fal fa-phone-laptop"></i>
                            <div class="pl-3">
                                <h4 class="mx-auto mb-2 md:mb-3"><strong>Available on all your devices.</strong></h4>
                                <p>Load every chord chart onto your phone during practice time, your laptop in the living room, or your tablet at the park – wherever the music takes you!</p>
                            </div>
                        </div>
                    </div>
                </div>
                <a
                        @hasSection('start-button')
                        href="@yield('start-button')" class="join blue smaller"
                        @else
                        href="#customize-anchor" class="join blue smaller anchor-slide"
                        @endif
                >
                    @if(empty($trialVersion))
                        Get Started
                    @else
                        Start your free trial
                    @endif
                </a>
            </div>
        </div>
    </section>

    <div id="coaches" class="anchor"></div>
    <section class="content-section text-center px-4 lg:px-6 lazyload" data-bg="https://cdn.musora.com/image/fetch/w_2000,q_auto:best/https://guitareo.s3.amazonaws.com/sales/2022/coaches-bg.jpg">
        <div class="container mx-auto max-w-6xl">
            <img class="inline h-10 md:h-14 lg:h-16 icon imgfilter-coaches" src="https://cdn.musora.com/image/fetch/w_800,q_auto:best/https://dpwjbsxqtam5n.cloudfront.net/sales/2021/coaches-icon.svg" alt="coaches-icon"><br>
            <img class="h-7 md:h-10 lg:h-11 mt-3 mb-4 md:mb-8 imgfilter-coaches lazyload" data-src="https://cdn.musora.com/image/fetch/q_auto:best/https://dpwjbsxqtam5n.cloudfront.net/sales/2021/coaches-text.svg" alt="coaches-text">
            <h3 class="leading-tight " data-aos-once="true" data-aos="fade-up" data-aos-offset="150" data-aos-delay="150"><strong>Stay motivated with <u>direct <br class="inline lg:hidden"> access</u> to real teachers.</strong></h3>
            <h6 class="leading-normal max-w-2xl lg:max-w-4xl text-light-navy mt-3 md:mt-5 mb-8 md:mb-10 text-shadow-4">Get unlimited personal support from our in-house team of professional guitarists through video reviews, live lessons, and Q&A sessions PLUS get access to NEW guest coaches where you’ll connect with guitar heroes and gain their best insights.</h6>
            {{--<div class="relative z-10 mx-auto mb-8 md:mb-16 flex flex-wrap justify-center max-w-md md:max-w-full">--}}
                {{--@foreach($coaches as $coach)--}}
                    {{--@if(empty($coach['trending']))--}}
                        {{--<div class="w-full md:w-1/2 px-1 md:px-2">--}}
                            {{--<div class="half-tile-bg overflow-hidden cursor-pointer relative mx-auto mb-3 rounded-3xl group @if(!empty($coach['trailer'])) autoplay-video @endif lazyload" data-bg="https://cdn.musora.com/image/fetch/w_1000,q_auto:best/{{ $coach['image'] }}"--}}
                                    {{--@if(!empty($coach['trailer'])) data-open="{{ $coach['modal'] }}Trailer" @else  data-open="{{ $coach['modal'] }}" @endif style="background-color:#00141d;padding-bottom: 52.65%;">--}}
                                {{--@if(!empty($coach['trailer']))--}}
                                    {{--<i class="absolute bottom-5 sm:bottom-auto sm:top-5 right-5 z-10 transition-opacity duration-300 text-xl md:text-2xl group-hover:opacity-100 fas fa-play play-button smaller" data-open="{{ $coach['modal'] }}Trailer"></i>--}}
                                {{--@else--}}
                                    {{--<i class="fas fa-expand absolute top-5 right-5 z-10 transition-opacity duration-300 text-xl md:text-2xl lg:opacity-50 group-hover:opacity-100"></i>--}}
                                {{--@endif--}}
                                {{--<div class="absolute text-left uppercase select-none z-10 left-4 bottom-4 lg:bottom-auto transform lg:-translate-y-1/2 lg:top-1/2 text-shadow-1">--}}
                                    {{--<h2 class="text-3xl md:text-4xl lg:text-5xl mx-auto mb-1 md:mb-2 font-bebas" style="line-height:0.85em;">{!! $coach['name'] !!}</h2>--}}
                                    {{--<h6 class="leading-tight text-coaches">{!! $coach['tileSubtitle'] !!}</h6>--}}
                                {{--</div>--}}
                                {{--<div class="z-0 absolute inset-0" style="background: linear-gradient(to right, #000a18, transparent 60%);"></div>--}}
                            {{--</div>--}}
                        {{--</div>--}}
                    {{--@endif--}}
                {{--@endforeach--}}
            {{--</div>--}}

            {{--<h4 class="mt-8 md:mt-12 mb-3 mb-6 md:mb-7 lg:mb-10 leading-normal"><strong class="inline-block mr-1 bg-coaches px-3 py-1 rounded md:rounded-lg leading-none" style="color: #000a1e;">PLUS GAIN ACCESS TO<br class="inline sm:hidden">  YOUR GUITAR HEROES.</strong><br>--}}
                {{--<em>You’ll also gain access to upcoming content-drops and<br class="hidden md:inline"> personalized events with some of the world’s best guitarists.</em></h4>--}}

            <div id="thisMonth" class="anchor"></div>
            @foreach($coaches as $coach)
                @if(!empty($coach['bigTile']))
                    <div class="px-1 md:px-2 mb-3 md:mb-4 mx-auto max-w-md md:max-w-3xl lg:max-w-full">
                        <div class="relative big-tile-bg bg-left-top rounded-xl overflow-hidden text-left px-3 md:px-10 lg:px-20 py-10 md:py-20 lg:py-36 cursor-pointer group @if(!empty($coach['trailer'])) autoplay-video @endif lazyload" data-bg="https://cdn.musora.com/image/fetch/w_2000,q_auto:best/{{ $coach['image'] }}" style="background-color:#010510"
                                @if(!empty($coach['trailer'])) data-open="{{ $coach['modal'] }}Trailer" @else  data-open="{{ $coach['modal'] }}" @endif >
                            @if(!empty($coach['trailer']))
                                <i class="absolute bottom-5 sm:bottom-auto sm:top-5 right-5 z-10 transition-opacity duration-300 text-xl md:text-2xl group-hover:opacity-100 fas fa-play play-button smaller" data-open="{{ $coach['modal'] }}Trailer"></i>
                            @else
                                <i class="fas fa-expand absolute top-5 right-5 z-10 transition-opacity duration-300 text-xl md:text-2xl lg:opacity-50 group-hover:opacity-100"></i>
                            @endif
                            <div class="relative z-10">
                                <h4 class="inline-block leading-none font-bebas bg-coaches text-black rounded-sm px-2 md:px-3 pt-1">{!! $coach['date'] !!}</h4><br>
                                <h1 class="inline-block font-bebas leading-none mt-3 md:mt-5 mb-1 md:mb-4 text-5xl md:text-7xl lg:text-8xl" style="line-height: 0.85em;">{!! $coach['name']  !!}</h1><br>
                                <h5 class="inline-block leading-tight text-coaches uppercase">{!! $coach['subtitle'] !!}</h5><br>
                            </div>
                            <div class="absolute inset-0 z-0" style="background:linear-gradient(to right, #010510, transparent 50%);"></div>
                        </div>
                    </div>
                @endif
            @endforeach
            <div class="flex flex-wrap items-center justify-center mx-auto max-w-md md:max-w-3xl lg:max-w-full">
                @foreach($coaches as $coach)
                    @if(empty($coach['bigTile']))
                        <div class="px-1 md:px-2 w-1/2 md:w-1/3 lg:w-1/5 mb-1 md:mb-2">
                            <div class="mx-auto" style="max-width:240px">
                                <div class="inline-block relative w-full group" style="padding-bottom: 148%; perspective: 1000px;" data-open="{{ $coach['modal'] }}">
                                    <div class="text-center w-full h-full absolute cursor-pointer">
                                        <div class="absolute z-20 overflow-hidden rounded-xl w-full h-full">
                                            <i class="fas fa-expand absolute top-2 right-2 z-10 transition-opacity duration-300 text-xl md:text-2xl lg:opacity-50 group-hover:opacity-100"></i>
                                            <div class="bg-image w-full bg-black bg-top bg-cover lazyload" style="padding-bottom: 145%;" data-bg="https://cdn.musora.com/image/fetch/w_1000,q_auto:best/{{ $coach['image'] }}"></div>
                                            <div class="absolute uppercase w-full bottom-3 lg:bottom-4 z-10 text-shadow-4">
                                                <h2 class="font-bebas text-3xl mb-0.5" style="line-height:0.85em">{!! $coach['name']  !!}</h2>
                                                <p class="text-coaches uppercase leading-tight mx-auto text-sm">{!! $coach['subtitle'] !!}</p>
                                            </div>
                                            <p class="leading-none font-bebas text-black bg-coaches rounded-md pt-1 px-2 absolute top-2 left-2">{!! $coach['date'] !!}</p>
                                            <div class="absolute inset-0 z-0" style="background:linear-gradient(to bottom, transparent 30%, #010510);"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                @endforeach
            </div>


            <h3 class="leading-tight mt-8 md:mt-16" data-aos-once="true" data-aos="fade-up" data-aos-offset="150" data-aos-delay="150"><strong>Real Teachers,<br class="inline sm:hidden">  Real Results. </strong></h3>
            <h6 class="leading-normal max-w-2xl lg:max-w-3xl text-light-navy mt-3 md:mt-5 mb-5 md:mb-20">You’ll never be left alone on your guitar journey. Your coaches are here to answer your biggest questions and keep you motivated every step of the way.</h6>
            <div class="feature-rotater w-full max-w-md md:max-w-full flex flex-wrap md:flex-nowrap items-center mx-auto mb-8 md:mb-10">
                <div class="pic-wrap md:order-0 mx-auto my-5 md:my-0 pr-0 md:pr-5 lg:pr-10 flex-shrink-0">
                    <img class="lazyload side-pic coaches w-full hidden" data-src="https://cdn.musora.com/image/fetch/w_800,q_auto:best/https://guitareo.s3.amazonaws.com/sales/2022/coaches-guitareo-ui-01.png" alt="coaches-ui-1">
                    <img class="lazyload side-pic coaches w-full md:hidden" data-src="https://cdn.musora.com/image/fetch/w_800,q_auto:best/https://guitareo.s3.amazonaws.com/sales/2022/coaches-guitareo-ui-02.png" alt="coaches-ui-2">
                    <img class="lazyload side-pic coaches w-full hidden" data-src="https://cdn.musora.com/image/fetch/w_800,q_auto:best/https://guitareo.s3.amazonaws.com/sales/2022/coaches-guitareo-ui-03.png" alt="coaches-ui-3">
                </div>
                <div class="text-left text-light-navy">
                    <div class="flex mx-auto mb-9 md:mb-7 lg:mb-10 md:cursor-pointer text-icon-wrap coaches md:opacity-60 hover:opacity-90 active">
                        <i class="flex-shrink-0 w-8 md:w-10 lg:w-11 text-2xl md:text-4xl text-coaches fal fa-lightbulb-on"></i>
                        <div class="pl-3">
                            <h3 class="mx-auto mb-2 md:mb-3"><strong>Inspiration</strong></h3>
                            <p>Share your practice space with the best in the world and get inspired to play like never before. Open the door to new possibilities with organized courses, live streams, and Q&A sessions.</p>
                        </div>
                    </div>
                    <div class="flex mx-auto mb-9 md:mb-7 lg:mb-10 md:cursor-pointer text-icon-wrap coaches md:opacity-60 hover:opacity-90">
                        <i class="flex-shrink-0 w-8 md:w-10 lg:w-11 text-2xl md:text-4xl text-coaches fal fa-users"></i>
                        <div class="pl-3">
                            <h3 class="mx-auto mb-2 md:mb-3"><strong>Connection</strong></h3>
                            <p>Every coach is in your corner. You’ll have opportunities to get feedback on your playing, ask your biggest questions, and enjoy ongoing support throughout your journey on the guitar. </p>
                        </div>
                    </div>
                    <div class="flex mx-auto md:cursor-pointer text-icon-wrap coaches md:opacity-60 hover:opacity-90">
                        <i class="flex-shrink-0 w-8 md:w-10 lg:w-11 text-2xl md:text-4xl text-coaches fal fa-signal-alt"></i>
                        <div class="pl-3">
                            <h3 class="mx-auto mb-2 md:mb-3"><strong>Results</strong></h3>
                            <p>You’ll gain new skills and knowledge on the guitar that you can start applying right away. You can play with confidence knowing you’re getting advice from your favorite guitar heroes.</p>
                        </div>
                    </div>
                </div>
            </div>
            <a
                    @hasSection('start-button')
                    href="@yield('start-button')" class="join blue smaller"
                    @else
                    href="#customize-anchor" class="join blue smaller anchor-slide"
                    @endif
            >
                @if(empty($trialVersion))
                    Get Started
                @else
                    Start your free trial
                @endif
            </a>
        </div>
    </section>

    <section class="content-section text-center">
        <div class="gradient-bg absolute top-0 left-0 right-0 z-0" style="background: linear-gradient(to bottom, #01050f 60%, #021225);"></div>
        <div class="container mx-auto relative z-10">
            <img class="h-32 md:h-48 lg:h-56 mb-14 lazyload" data-src="https://cdn.musora.com/image/fetch/w_800,q_auto:best/https://guitareo.s3.amazonaws.com/sales/2022/guitareo-method-coaches-songs.png" alt="method-coaches-songs">
            <h3 class="" data-aos-once="true" data-aos="fade-up" data-aos-offset="150" data-aos-delay="150"><strong>The guitar lessons experience you’ll LOVE.</strong></h3>
            <h6 class="text-light-navy mt-3 md:mt-5 mb-8 md:mb-12 ">Accessible on the devices you use every day, with real teachers just clicks away.</h6>
            <div class="device-spread relative w-full mx-auto mb-5 md:mb-0">
                <div class="z-10 text-arrow w-1/4 md:w-auto transform md:-translate-x-1/2 -translate-y-1/2 absolute uppercase text-xs md:text-sm lg:text-md desktop">
                    <em class="inline-block">STEP-BY-STEP<br>LESSONS</em><br class="hidden md:inline">
                    <img class="hidden md:inline mt-1 w-7 lg:w-10 lazyload" data-src="https://cdn.musora.com/image/fetch/q_auto:best/https://guitareo.s3.amazonaws.com/sales/2021/arrow-right-alt.png" alt="arrow-right">
                </div>
                <div class="z-10 text-arrow w-1/4 md:w-auto transform md:-translate-x-1/2 -translate-y-1/2 absolute uppercase text-xs md:text-sm lg:text-md macbook">
                    <em class="inline-block">Regular<br> Live<br> Lessons</em><br class="hidden md:inline">
                    <img class="hidden md:inline mt-1 w-7 lg:w-10 lazyload" data-src="https://cdn.musora.com/image/fetch/q_auto:best/https://guitareo.s3.amazonaws.com/sales/2021/arrow-right-alt.png" alt="arrow-right">
                </div>
                <div class="z-10 text-arrow w-1/4 md:w-auto transform md:-translate-x-1/2 -translate-y-1/2 absolute uppercase text-xs md:text-sm lg:text-md ipad">
                    <em class="inline-block">Play<br> Popular<br> Songs</em><br class="hidden md:inline">
                    <img class="hidden md:inline mt-1 h-7 lg:h-9 lazyload" data-src="https://cdn.musora.com/image/fetch/q_auto:best/https://guitareo.s3.amazonaws.com/sales/2021/arrow-left-down.png" alt="arrow-left">
                </div>
                <div class="z-10 text-arrow w-1/4 md:w-auto transform md:-translate-x-1/2 -translate-y-1/2 absolute uppercase text-xs md:text-sm lg:text-md iphone">
                    <em class="inline-block">A<br> Supportive<br> Community</em><br class="hidden md:inline">
                    <img class="hidden md:inline mt-1 w-7 lg:w-10 lazyload" data-src="https://cdn.musora.com/image/fetch/q_auto:best/https://guitareo.s3.amazonaws.com/sales/2021/arrow-left.png" alt="arrow-left">
                </div>
                <img class="w-full lazyload" data-src="https://cdn.musora.com/image/fetch/w_1500,q_auto:best/https://guitareo.s3.amazonaws.com/sales/2022/guitareo-device-spread.png" alt="device-spread">
                <video class="absolute rounded-md" style="width: 43.1%;height: 54%;left: 6.5%;top: 39.1%;" src="https://guitareo.s3.amazonaws.com/sales/2022/spread-vid.mp4" type="video/mp4" autoplay="" loop="" playsinline="" muted></video>
            </div>
        </div>
    </section>

    <section class="content-section text-center comparison px-1 lg:px-3">
        <div class="container mx-auto max-w-6xl">
            <h3 data-aos-once="true" data-aos="fade-up" data-aos-offset="150" data-aos-delay="150"><strong>Say hello to your unfair advantage.</strong></h3>
            <p class="text-light-navy mt-2 md:mt-4 mb-8 md:mb-10">Benefit from saving more time and money while learning guitar at home.</p>
            <table class="w-full mx-auto border-separate comparison">
                <tbody>
                <tr style="background-color:transparent!important;">
                    <td></td>
                    <td class="rounded-t-xl">
                        <img class="h-6 md:h-11 lazyload" data-src="https://cdn.musora.com/image/fetch/w_300,q_auto:best/https://guitareo.s3.amazonaws.com/sales/guitareo-logo.png" alt="guitareo-logo">
                    </td>
                    <td class="rounded-t-xl">Private Lessons</td>
                </tr>
                <tr>
                    <td>Step-By-Step Curriculum</td>
                    <td><i class="fas fa-check-circle"></i></td>
                    <td><i class="fas fa-check-circle"></i></td>
                </tr>
                <tr>
                    <td>Consistent & Qualified Advice</td>
                    <td><i class="fas fa-check-circle"></i></td>
                    <td><i class="fas fa-check-circle"></i></td>
                </tr>
                <tr>
                    <td>Progress-Tracking</td>
                    <td><i class="fas fa-check-circle"></i></td>
                    <td><i class="fas fa-check-circle"></i></td>
                </tr>
                <tr>
                    <td>Live Lessons & Questions</td>
                    <td><i class="fas fa-check-circle"></i></td>
                    <td><i class="fas fa-check-circle"></i></td>
                </tr>
                <tr>
                    <td>Personal Reviews & Feedback</td>
                    <td><i class="fas fa-check-circle"></i></td>
                    <td><i class="fas fa-check-circle"></i></td>
                </tr>
                <tr>
                    <td>LEARN TO PLAY POPULAR SONGS</td>
                    <td><i class="fas fa-check-circle"></i></td>
                    <td><i class="fas fa-minus"></i></td>
                </tr>
                <tr>
                    <td>Downloadable CHORD CHARTS</td>
                    <td><i class="fas fa-check-circle"></i></td>
                    <td><i class="fas fa-minus"></i></td>
                </tr>
                <tr>
                    <td>CONNECT WITH GUITAR LEGENDS</td>
                    <td><i class="fas fa-check-circle"></i></td>
                    <td><i class="fas fa-minus"></i></td>
                </tr>
                <tr>
                    <td>Re-Watch Any Lesson</td>
                    <td><i class="fas fa-check-circle"></i></td>
                    <td><i class="fas fa-minus"></i></td>
                </tr>
                <tr>
                    <td>Learn From Home, Anytime</td>
                    <td><i class="fas fa-check-circle"></i></td>
                    <td><i class="fas fa-minus"></i></td>
                </tr>
                <tr>
                    <td>Supportive Community</td>
                    <td><i class="fas fa-check-circle"></i></td>
                    <td><i class="fas fa-minus"></i></td>
                </tr>
                <tr>
                    <td>100% Money Back Guarantee</td>
                    <td><i class="fas fa-check-circle"></i></td>
                    <td><i class="fas fa-minus"></i></td>
                </tr>
                <tr style="background-color:transparent!important;">
                    <td></td>

                    @hasSection('comparison')
                        @yield('comparison')
                    @else
                        <td class="rounded-b-xl">
                            @if(empty($trialVersion))
                                <strong>${{ number_format(GuitareoPrices::$guitareoMembershipAnnual/ 12, 2) }}</strong>/mo<br>
                                <em>Billed annually</em><br><br>
                                Unlimited lessons & support.
                            @else
                                <div class="text-xs md:text-base lg:text-xl mb-2 md:mb-4"><b>Try it free for 7 days,</b> then</div>
                                <strong>${{ number_format(GuitareoPrices::$guitareoMembershipAnnual/ 12, 2) }}</strong>/mo<br>
                                <em>Billed annually</em><br><br>
                                Unlimited lessons & support.
                            @endif
                        </td>
                    @endif
                    <td class="rounded-b-xl">
                        <strong>$200</strong>/mo<br>
                        <em>Typically $50 per 30-minutes.</em><br><br>
                        For private lessons.
                    </td>
                </tr>
                </tbody>
            </table>
        </div>
    </section>
    <section class="content-section text-center px-6" style="background:linear-gradient(to bottom, #01050f, #021225);overflow:visible">
        <div class="container mx-auto max-w-4xl">
            <img class="h-28 md:h-32 lazyload" data-src="https://cdn.musora.com/image/fetch/w_250,q_auto:best/https://guitareo.s3.amazonaws.com/sales/2022/guitareo-guarantee.png" alt="guitareo-guarantee">

            <h3 class="leading-tight mt-5 md:mt-8 mb-4 md:mb-6 " data-aos-once="true" data-aos="fade-up" data-aos-offset="150" data-aos-delay="150"><strong>Happy student guarantee. </strong><br>
                Test-drive your lessons for 90 days. Zero risk. </h3>
            <p class="text-light-navy leading-normal md:leading-loose">Online lessons can be intimidating. Maybe you’re wondering if they work, or if you’ll use them enough – or if you’ll even enjoy the experience. So we’re removing the risk with our 90-day guarantee. More than anything, we want to make sure you have a POSITIVE experience developing new skills and gaining confidence on the guitar. </p>
            <div class="flex flex-wrap items-start justify-center mt-5 md:mt-7">
                <div class="w-full sm:w-1/3 px-2 mb-3 sm:mb-0">
                    <h5 class="text-guitareo border-guitareo border-2 rounded-full inline-block py-2 px-3 mb-1">1</h5>
                    <h6 class="leading-normal">Start your<br> lessons today.</h6>
                </div>
                <div class="w-full sm:w-1/3 px-2 mb-3 sm:mb-0">
                    <h5 class="text-guitareo border-guitareo border-2 rounded-full inline-block py-2 px-3 mb-1">2</h5>
                    <h6 class="leading-normal">Enjoy them for 90<br>  days, risk-free.</h6>
                </div>
                <div class="w-full sm:w-1/3 px-2">
                    <h5 class="text-guitareo border-guitareo border-2 rounded-full inline-block py-2 px-3 mb-1">3</h5>
                    <h6 class="leading-normal">Change your mind?<br> Get a refund. <div class="inline-block tooltip cursor-pointer" tip="If it’s not for you, simply cancel your membership within 90 days and contact us for a full refund. (If your membership includes any bonuses, your refund will deduct the value of hard goods that were shipped to you.)"><i class="fas fa-info-circle"></i></div></h6>
                </div>
            </div>
        </div>
    </section>

    <div class="unstick-trigger block"></div>
    <div id="customize-anchor" class="anchor"></div>
    @yield('final')


    @foreach($coaches as $coach)
        <div class="reveal relative large coach-wrap rounded-xl text-center overflow-visible select-none max-w-xs md:max-w-md" id="{{ $coach['modal'] }}" data-reveal data-reset-on-close="false">
            @if($coach['prev'] != false)
                <i class="absolute transform -translate-y-1/2 top-44 md:top-60 text-white cursor-pointer py-2.5 pr-2.5 md:pr-5 text-5xl md:text-6xl fas fa-angle-left -left-7 md:-left-10" data-close data-open="{{ $coach['prev'] }}"></i>
            @else
                <i class="absolute transform -translate-y-1/2 top-44 md:top-60 text-white cursor-pointer py-2.5 pr-2.5 md:pr-5 text-5xl md:text-6xl fas fa-angle-left -left-7 md:-left-10 opacity-50"></i>
            @endif
            <div class="relative rounded-t-lg pb-44 md:pb-60 bg-top bg-cover bg-black lazyload" data-bg="https://cdn.musora.com/image/fetch/w_800,q_auto:best/{{ $coach['image'] }}">
                @if(!empty($coach['trailer']))
                    <i class="absolute z-10 top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 fas fa-play play-button smaller autoplay-video" data-close data-open="{{ $coach['modal'] }}Trailer"></i>
                @endif
            </div>
            <div class="p-4 md:p-5">
                @if(!empty($coach['date']))
                    <h6 class="leading-none font-bebas uppercase text-coaches mx-auto mb-3 md:mb-2">{{ $coach['date'] }}</h6>
                @endif
                <h2 class="leading-none font-bebas">{!!  str_replace('<br>', ' ', $coach['name'])  !!}</h2>
                <p class="text-coaches uppercase mx-auto mb-3 md:mb-2">{!!  str_replace('<br>', ' ', $coach['subtitle'])  !!}</p>
                <p class="mx-auto text-left leading-normal md:leading-normal">{!! $coach['info'] !!}</p>
            </div>
            @if($coach['next'] != false)
                    <i class="absolute transform -translate-y-1/2 top-44 md:top-60 text-white cursor-pointer py-2.5 pl-2.5 md:pl-5 text-5xl md:text-6xl fas fa-angle-right -right-7 md:-right-10" data-close data-open="{{ $coach['next'] }}"></i>
                @else
                    <i class="absolute transform -translate-y-1/2 top-44 md:top-60 text-white cursor-pointer py-2.5 pl-2.5 md:pl-5 text-5xl md:text-6xl fas fa-angle-right -right-7 md:-right-10 opacity-50"></i>
                @endif
        </div>
    @endforeach

    @foreach($testimonials as $testimonial)
        <div class="reveal relative large coach-wrap rounded-xl text-center overflow-visible select-none max-w-xs md:max-w-md" id="{!!  str_replace(' ', '', $testimonial['name'])  !!}" data-reveal data-reset-on-close="false">
            @if($testimonial['prev'] != false)
                <i class="absolute transform -translate-y-1/2 top-44 md:top-60 text-white cursor-pointer py-2.5 pr-2.5 md:pr-5 text-5xl md:text-6xl fas fa-angle-left -left-7 md:-left-10" data-close data-open="{{ $testimonial['prev'] }}"></i>
            @else
                <i class="absolute transform -translate-y-1/2 top-44 md:top-60 text-white cursor-pointer py-2.5 pr-2.5 md:pr-5 text-5xl md:text-6xl fas fa-angle-left -left-7 md:-left-10 opacity-50"></i>
            @endif
            <div class="relative rounded-t-lg pb-60 md:pb-96 bg-top bg-cover bg-black lazyload" data-bg="https://cdn.musora.com/image/fetch/w_800,q_auto:best/{{ $testimonial['image'] }}">
                @if(!empty($testimonial['trailer']))
                    <i class="absolute z-10 top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 fas fa-play play-button smaller autoplay-video" data-close data-open="{!!  str_replace(' ', '', $testimonial['name'])  !!}Trailer"></i>
                @endif
            </div>
            <div class="p-4 md:p-5">
                <h2 class="leading-none font-bebas">{!!  str_replace('<br>', ' ', $testimonial['name'])  !!}</h2>
                <p class="text-coaches uppercase mx-auto mb-3 md:mb-2">{!!  $testimonial['location'] !!}</p>
                <p class="mx-auto mt-2 mb-3 md:mb-2 leading-tight"><strong>{!!  $testimonial['title'] !!}</strong></p>
                <p class="mx-auto text-left leading-normal md:leading-normal">{!! $testimonial['description'] !!}</p>
            </div>
            @if($testimonial['next'] != false)
                    <i class="absolute transform -translate-y-1/2 top-44 md:top-60 text-white cursor-pointer py-2.5 pl-2.5 md:pl-5 text-5xl md:text-6xl fas fa-angle-right -right-7 md:-right-10" data-close data-open="{{ $testimonial['next'] }}"></i>
                @else
                    <i class="absolute transform -translate-y-1/2 top-44 md:top-60 text-white cursor-pointer py-2.5 pl-2.5 md:pl-5 text-5xl md:text-6xl fas fa-angle-right -right-7 md:-right-10 opacity-50"></i>
                @endif
        </div>
    @endforeach

    @php
        $videoModals = [
            [
            'modal' => 'scallonTrailer',
            'vimeo' => '661483578',
            ],
            [
            'modal' => 'shoresTrailer',
            'vimeo' => '683508420',
            ],
            [
            'modal' => 'ghawiTrailer',
            'vimeo' => '702222064',
            ],
         ]
    @endphp
    @foreach($videoModals as $videoModal)
        <div class="reveal large" id="{{ $videoModal['modal'] }}" data-reveal data-reset-on-close="false">
            <div class="aspect-16:9 w-full relative">
                <iframe class="absolute w-full h-full reset-on-close" src="" data-lazy-load-url="//player.vimeo.com/video/{{ $videoModal['vimeo'] }}?autoplay=1" frameborder="0" allowfullscreen allow="autoplay"></iframe>
            </div>
        </div>
    @endforeach

    @include("guitareo.sales.partials._footer")
@endsection

@section('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script type="text/javascript" src="/marketing/parcel/guitareo/nav-footer.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/countup.js/1.9.3/countUp.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.js"></script>
    <script type="text/javascript" src="/marketing/parcel/guitareo/sales-page.js"></script>
    <script type="text/javascript" src="/marketing/parcel/guitareo/modal.js"></script>
    <script type="text/javascript" src="/marketing/parcel/guitareo/modal-autoplay.js"></script>
    <script type="text/javascript" src="/marketing/parcel/guitareo/jquery.countdown-2.min.js"></script>
    <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/lazysizes/5.3.2/lazysizes.min.js"></script>
    <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/lazysizes/5.3.2/plugins/unveilhooks/ls.unveilhooks.min.js"></script>
    <script>
        $(document).ready(function () {
            $('.tzcd-full').countdown('2022/10/31')
                .on('update.countdown', function (event) {
                    var format = '%-M Minute%!M %-S Second%!S';
                    if (event.offset.totalHours > 0) {
                        format = '%-H Hour%!H ' + format;
                    }
                    if (event.offset.totalDays > 0) {
                        format = '%-D Day%!D ' + format;
                    }

                    format = 'only ' + format + ' left!'
                    $(this).html(event.strftime(format));
                })
                .on('finish.countdown', function (event) {
                    $(this).html('a limited time');
                });
            $('.tzcd-days').countdown('2022/10/31')
                .on('update.countdown', function (event) {
                    var format = '';

                    if (event.offset.totalDays > 0) {
                        format = '%-D Day%!D ' + format;
                    } else if (event.offset.totalHours > 0) {
                        format = '%-H Hour%!H ' + format;
                    } else if (event.offset.totalHours <= 0) {
                        format = '%-M Minute%!M %-S Second%!S' + format;
                    }
                    $(this).html(event.strftime(format));
                })
                .on('finish.countdown', function (event) {
                    $(this).html('limited time');
                });
            $('.tzcd-small').countdown('2022/10/31')
                .on('update.countdown', function (event) {
                    var format = '%-MM %-SS';
                    if (event.offset.totalHours > 0) {
                        format = '%-HH ' + format;
                    }
                    if (event.offset.totalDays > 0) {
                        format = '%-DD ' + format;
                    }

                    format = 'only ' + format + ' left!'
                    $(this).html(event.strftime(format));
                })
                .on('finish.countdown', function (event) {
                    $(this).html('a limited time');
                });
            $('.tzcd-big').countdown('2022/10/31')
                .on('update.countdown', function (event) {
                    var format = '' + '<div><h1>%M</h1> <p>min%!M</p></div> ' + '<div><h1>%S</h1> <p>sec%!S</p></div>';
                    if (event.offset.totalHours > 0) {
                        format = '' + '<div><h1>%H</h1> <p>hr%!H</p></div> ' + format;
                    }
                    if (event.offset.totalDays > 0) {
                        format = '' + '<div><h1>%D</h1> <p>day%!D</p></div> ' + format;
                    }
                    $(this).html(event.strftime(format));
                })
                .on('finish.countdown', function (event) {
                    $(this).html('<div><h1>LIMITED</h1> <p>TIME LEFT</p></div>');
                });

                $('.slick-3').slick({
                    draggable: false,
                    slidesToShow: 4,
                    responsive: [
                        {
                            breakpoint: 768,
                            settings: {
                                slidesToShow: 2
                            }
                        }
                    ]
                });
        });
    </script>
@endsection
