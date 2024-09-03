@extends('pianote.lead-gen.lead-gen-layout-tw',[ 'appTailwind' => true, ])

@section('meta')
    @parent
    <title>Getting Started On The Piano | Pianote</title>
    <meta property="og:title" content="Getting Started On The Piano">

    <meta name="description" content="Start learning piano the easy and fun way.">
    <meta property="og:description" content="Start learning piano the easy and fun way.">

    <meta property="og:image" content="https://d21q7xesnoiieh.cloudfront.net/fit-in/1200x0/filters:quality(95)/marketing/pianote/lead-gen/getting-started/share-image.jpg" style="display: none;">
    <meta property="og:url" content="https://www.pianote.com/getting-started-on-the-piano">
@endsection

@section('head')
    @parent
    <style>
        .join.smaller {
            font-size:18px;
            padding:16px 25px;
        }
         .join.smaller.sticky-button {
            font-size:16px;
            padding:14px 25px;
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
        
        .poppins-font {
            font-family: 'Poppins', sans-serif;
        }
          @media (min-width: 768px) {
            .timeline-container .timeline:after {
                left: 50% !important;
            }
        }

        .translate-x-2 {
            transform: translateX(0.2rem);
        }

        .timeline-container::after {
            content: '';
            position: absolute;
            width: 2px;
            background-color: #F61A30;
            top: 0;
            bottom: 0;
            transform: translate(-50%, 0);
            z-index: 0;
            left: 0;
            visibility: hidden;
        }

        .timeline-container .timeline::after {
            content: '';
            position: absolute;
            width: 22px;
            height: 22px;
            transform: translate(-50%, 0);
            background-color: #F61A30;
            top: 0;
            border-radius: 50%;
            z-index: 1;
            left: -16px;
            visibility: hidden;
        }

        @media (min-width: 768px) {
            .timeline-container .timeline::after {
                left: 50%;
                visibility: visible;
            }
        }

        @media (min-width: 768px) {

            .timeline-container::after,
            .timeline::after {
                left: 50%;
                visibility: visible;
            }
        }
        /* column-oriented masonry layout */
        .masonry {
            column-count: 1;
            column-gap: 1.5rem; 
        }

        @media (min-width: 640px) {
            .masonry {
                column-count: 2;
            }
        }

        @media (min-width: 1024px) {
            .masonry {
                column-count: 3; 
            }
        }

        .masonry-item {
            break-inside: avoid; 
            margin-bottom: 1rem;
        }
    </style>
@endsection

<div class="px-2 sm:px-0 w-full z-[60] sticky top-[40px] md:top-[56px] py-2" style="background: rgba(2, 8, 21, 0.93);">
    <div class="sm:pr-10 md:pr-20 flex items-center justify-center md:justify-end">
        <a class="join smaller sticky-button w-11/12 sm:max-w-[200px] anchor-slide top-0" href="#course" style="background:transparent;">Course Outline</a>
        <a class="join smaller sticky-button w-11/12 sm:max-w-[240px] bg-pianote anchor-slide" href="#final">Get Started</a>
    </div>
</div>

@section('page-body')
    <header class="px-5 sm:px-6 pt-10 sm:pt-14 pb-20 md:pb-24 lg:py-20" style="background:#f1f7fe;">
        <div class="container max-w-5xl mx-auto">
            <div class="flex flex-wrap sm:flex-nowrap items-center">
                <div class="w-full sm:w-1/2 text-center lg:text-left">
                   @php
                        $content = [
                            'logo' => [
                                'src' => 'https://d21q7xesnoiieh.cloudfront.net/fit-in/500x0/filters:quality(95)/marketing/pianote/lead-gen/getting-started/logo.webp',
                                'alt' => 'logo',
                                'class' => 'h-14 sm:h-18 lg:h-24 mb-2 lg:mb-3'
                            ],
                            'heading' => 'Start Learning Piano <br><strong class="font-black">The Easy and Fun Way </strong>',
                            'description' => 'We don\'t do boring practice here.<br class="block lg:hidden"> <strong class="font-black">Sign up for 4 FREE lessons</strong> <br class="block"> and start playing the songs you love.',
                            'video' => [
                                'src' => 'https://d21q7xesnoiieh.cloudfront.net/fit-in/1000x0/filters:quality(95)/marketing/pianote/lead-gen/getting-started/header-image.webp',
                                'alt' => 'header image',
                                'class' => 'absolute inset-0',
                                'style' => 'padding-bottom: 87%;',
                                'containerClass' => 'my-3 rounded-xl overflow-hidden relative block sm:hidden bg-cover bg-top cursor-pointer autoplay-video',
                                'dataOpen' => 'trailer'
                            ],
                            'features' => [
                                'Quick lessons',
                                'Designed for absolute beginners',
                                'Play along with a REAL teacher',
                                'No theory - just pure musical joy'
                            ]
                        ];
                    @endphp

                    <div class="px-2 sm:px-4">
                        <img class="{{ $content['logo']['class'] }}" src="{{ $content['logo']['src'] }}" alt="{{ $content['logo']['alt'] }}" fetchpriority="high">
                        <h2 class="leading-none">{!! $content['heading'] !!}</h2>
                        <p class="pt-3">{!! $content['description'] !!}</p>

                        <div class="{{ $content['video']['containerClass'] }}" style="{{ $content['video']['style'] }}" data-open="{{ $content['video']['dataOpen'] }}">
                            <img class="{{ $content['video']['class'] }}" src="{{ $content['video']['src'] }}" alt="{{ $content['video']['alt'] }}" fetchpriority="high" />
                        </div>

                        <p class="hidden md:block text-sm flex flex-col items-center md:flex-row md:flex-wrap gap-2 py-4 leading-loose">
                            @foreach ($content['features'] as $feature)
                                <span class="inline-flex items-center pl-1">
                                    <i class="fas fa-check text-pianote pr-1"></i> {{ $feature }}
                                </span>
                            @endforeach
                        </p>

                        <div class="container flex justify-center mx-auto md:hidden mt-3">
                            <div class="flex flex-col items-center leading-loose">
                                @foreach ($content['features'] as $feature)
                                    <p class="w-full text-left flex items-center">
                                        <i class="fas fa-check-circle text-pianote mr-2 py-2"></i> {{ $feature }}
                                    </p>
                                @endforeach
                            </div>
                        </div>
                    </div>

                    <div class="mt-3">
                        @include('pianote._partials.sign-up-form', [
                            'recaptchaKey' => $recaptchaKey,
                            'formId' => 'Pianote - Engagement - Trigger - GSOTPV3 - Web Form',
                            'nameInput' => true,
                            'formName' => 'Getting Started On The Piano V3',
                            'buttonText' => 'Get started for free',
                            'stacked' => true,
                            'inputBorder' => '1px solid #7A8491',
                            'redirectURL' => '/getting-started-on-the-piano/thank-you/',
                            'minimalForm' => true,
                        ])
                    </div>
                    <div class="flex flex-row justify-center items-center text-black italic px-6">
                        <img class="h-7" src="https://d21q7xesnoiieh.cloudfront.net/fit-in/100x0/filters:quality(95)/marketing/pianote/products/30-day-blues/piano-players-trusted.png">
                        <div class="px-2 text-xs lg:text-base">Rated 4.8/5 (based on 7,074 student reviews)</div>
                    </div>
                </div>
                <div class="w-full sm:w-1/2 hidden sm:block">
                    <img
                        src="https://d21q7xesnoiieh.cloudfront.net/fit-in/1500x0/filters:quality(95)/marketing/pianote/lead-gen/getting-started/header-image.webp"
                        alt="header image" fetchpriority="high" />
                </div>
            </div>
        </div>
    </header>

    @php
        $section = [
            'backgroundImage' => 'https://d21q7xesnoiieh.cloudfront.net/fit-in/500x0/filters:quality(95)/marketing/pianote/lead-gen/getting-started/bg.webp',
            'header' => 'Is This You?',
            'items' => [
                'Love listening to music and dream of playing your favorite songs one day but <strong>don\'t know where to start?</strong>',
                'Find yourself searching for "private piano lessons near me," only to realize they\'re way <strong>too expensive.</strong>',
                '<strong>Struggle to fit lessons into your hectic schedule.</strong> It’s hard to find a time that works for both the instructor and yourself.',
                'FINALLY, you sign up for some private lessons, only to find them too <strong>rigid and boring,</strong> leaving you unmotivated.',
                '“Should I try another teacher? But that’s a <strong>big investment</strong> for a hobby I might not even enjoy... Maybe the piano just isn’t for me.”'
            ]
        ];
    @endphp

    <section class="relative text-center px-4 sm:px-6 md:pt-20 pb-16 lg:pt-36 lg:pb-24 bg-cover bg-center" style="background-image: url('{{ $section['backgroundImage'] }}');">
        <div class="pt-4 md:pt-0">
            <div class="container max-w-4xl mx-auto mb-20 -mt-20 md:-mt-40 lg:-mt-48 z-20 relative">
                <div class="px-5 lg:px-0">
                    @php
                        $items = [
                            [
                                'icon' => 'fa-light fa-user-group',
                                'text' => 'Trusted by',
                                'highlight' => '100,000+ <br class="hidden sm:block">active students'
                            ],
                            [
                                'icon' => 'fa-clock',
                                'text' => 'As little as',
                                'highlight' => '10 minutes a day'
                            ],
                            [
                                'icon' => 'fa-piano-keyboard',
                                'text' => 'Skill Level',
                                'highlight' => 'Beginner'
                            ],
                            [
                                'icon' => 'fa-trophy',
                                'text' => 'Result',
                                'highlight' => 'Play your first song'
                            ]
                        ];
                    @endphp

                    <div class="flex flex-wrap sm:flex-nowrap text-center shadow-xl rounded-xl relative" style="background:linear-gradient(to bottom, #fff, #F1F7FE);">
                        <div class="z-10 flex flex-wrap items-start justify-evenly w-full sm:w-auto sm:flex-grow py-4 sm:py-3 lg:py-6 lg:px-5 text-left sm:text-center">
                            @foreach ($items as $index => $item)
                                <div class="flex sm:block w-full sm:w-1/4 px-4 sm:px-0 mb-4 sm:mb-0 {{ $index < count($items) - 1 ? 'border-r border-gray-300' : '' }}">
                                    <i class="far fa-fw mr-3 sm:mr-0 {{ $item['icon'] }} text-pianote text-2xl"></i>
                                    <div class="flex flex-col items-left"> 
                                    <p class="leading-tight mx-0 pb-1">{{ $item['text'] }}</p>
                                    <p><strong class="text-xs lg:text-base font-black px-1 md:px-2">{!! $item['highlight'] !!}</strong></p>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container max-w-2xl mx-auto">
            <h2 class="mb-6"><strong>{{ $section['header'] }}</strong></h2>
            <ul class="text-left text-lg sm:text-xl lg:text-2xl space-y-4">
                @foreach ($section['items'] as $item)
                    <li class="flex items-start">
                    <i class="fas fa-check text-pianote pr-3"></i>
                       <p> {!! $item !!}</p>
                    </li>
                @endforeach
            </ul>
            <p class="pt-6 md:pt-10 text-pianote"><strong>Not sure what you’ve missed? <br>You need to get started on the piano, the easy and fun way!</strong></p>
        </div>
    </section>

    <section class="pt-10 sm:px-6 sm:py-16 lg:py-20">
        <div class="container mx-auto max-w-4xl">
            <div class="flex flex-wrap sm:flex-nowrap">
                <div class="flex justify-center items-center w-full md:w-1/2 sm:w-auto"> 
                    <picture class="w-full px-4 sm:w-auto h-auto sm:h-96 order-0 sm:order-none flex justify-center items-center">
                        <source media="(min-width: 768px)" srcset="https://d21q7xesnoiieh.cloudfront.net/fit-in/1200x0/filters:quality(95)/marketing/pianote/lead-gen/getting-started/designed.webp">
                        <img class="rounded-xl" src="https://d21q7xesnoiieh.cloudfront.net/700x700/filters:quality(95)/marketing/pianote/lead-gen/getting-started/designed.webp" alt="Person playing piano">                
                    </picture>
                </div>

                <div class="px-6 sm:pr-0 sm:pl-7 mb-7 sm:mb-0 w-full md:w-1/2 sm:order-1">
                    <h4 class="leading-tight my-4 tracking-tight"><strong>Designed for Absolute Beginners</strong></h4>
                    <p class="leading-normal pb-4 md:pb-6">
                        The hardest part of playing the piano is not reading complicated sheet music or playing as fast as you physically can.
                        <br><br>
                        It’s getting started.
                        <br><br>
                        Getting Started on the Piano is carefully structured as slow, 1-on-1 play-along sessions you can easily follow. We’ll show you EXACTLY what to do, helping you build confidence as you progress.
                    </p>
                    <a class="join smaller w-full sm:max-w-[350px] bg-pianote anchor-slide" href="#final">GET STARTED FOR FREE</a>
                </div>
            </div>
        </div>
    </section>

    <section class="px-6 py-20 bg-[#F6F5F4]">
        <div class="container mx-auto max-w-2xl">
            <div class="text-center flex flex-row">
                <img class="h-4 md:h-8 pr-4" src="https://d21q7xesnoiieh.cloudfront.net/700x0/filters:quality(95)/marketing/pianote/lead-gen/getting-started/quotation-icon.svg">
                <div class="text-left">
                    <h2 class="leading-snug">I sat down one day, and <strong>it just clicked. </strong> From then on, I’ve felt very encouraged to keep learning and practicing. It’s <strong>fulfilling and fun </strong>to see myself progress and achieve goals.</h2>
                    <p class="mt-4">
                        <strong>Jess Ripley</strong><br>
                        California, USA
                    </p>
                </div>
            </div>
        </div>
    </section>

    <section class="relative text-center px-4 sm:px-6 pt-16 sm:pt-20 pb-10 lg:pb-14 bg-cover bg-center" style="background:linear-gradient(to bottom, #EEECEA 20%, #fff 80%);">
        <div class="z-20 relative">
            <h3 class="leading-tight"><strong>Experience <br class="inline sm:hidden"> Your First Lesson</strong></h3>
           <p class="leading-normal my-2 sm:my-3">
                See how fun and simple it is to start.
            </p>
            <p class="leading-normal mb-4 md:mp-4">
                <span class="text-pianote"><strong>Try a snippet from your 1st lesson and <br class="hidden md:inline xl:hidden"> see if <br class="block md:hidden"> playing the piano is right for you.</strong></span>
            </p>
            <div class="relative cursor-pointer max-w-xl lg:max-w-2xl mx-auto autoplay-video" data-open="demoVid">
                <img class="inline-block sm:hidden w-full transition-all opacity-0" src="https://d21q7xesnoiieh.cloudfront.net/fit-in/1000x0/filters:quality(95)/marketing/pianote/lead-gen/getting-started/tablet.webp" alt="tablet piano" loading="lazy" onload="this.classList.remove('opacity-0')">
                <img class="hidden sm:inline-block w-full transition-all opacity-0" src="https://d21q7xesnoiieh.cloudfront.net/fit-in/1600x0/filters:quality(95)/marketing/pianote/lead-gen/getting-started/tablet.webp" alt="tablet piano" loading="lazy" onload="this.classList.remove('opacity-0')">
            </div>
        </div>  
        <div id="course"></div> 
    </section>

    <section class="text-center pb-4">
        <div class="container max-w-4xl mx-auto bg-white px-4">
            <h2 class="leading-tight">
                <strong>What you will learn</strong>
            </h2>
            @php
                $gettings = [
                    [
                        'img' => 'https://d21q7xesnoiieh.cloudfront.net/fit-in/900x0/filters:quality(95)/marketing/pianote/lead-gen/getting-started/thumb-01.webp',
                        'title' => 'Lesson 1',
                        'subtitle' => 'Get Comfortable on the Piano',
                        'desc' => 'Skip the boring theory! The best way to learn is by playing. In your first lesson, you\'ll explore the keyboard, get familiar with the notes, and discover where to place your fingers—all while playing along on a fun, beginner-friendly track. It\'s all about getting comfortable with your new musical friend!',
                    ],
                    [
                        'img' => 'https://d21q7xesnoiieh.cloudfront.net/fit-in/900x0/filters:quality(95)/marketing/pianote/lead-gen/getting-started/thumb-02.webp',
                        'title' => 'Lesson 2',
                        'subtitle' => 'Play Both Hands',
                        'desc' => 'Now that you\'re familiar with the keyboard, it\'s time to take it up a notch! Learn to play chords with your right hand while your left hand handles the bass notes. Develop hand coordination and build confidence as you bring your first melody to life.',
                    ],
                    [
                        'img' => 'https://d21q7xesnoiieh.cloudfront.net/fit-in/900x0/filters:quality(95)/marketing/pianote/lead-gen/getting-started/thumb-03.webp',
                        'title' => 'Lesson 3',
                        'subtitle' => 'Learn Your First Chord Progression',
                        'desc' => 'You\'re playing real music now! In this lesson, learn one of the most popular chord progressions in modern music. This beginner-friendly progression is your ticket to playing hundreds of beloved classics like "Can\'t Help Falling in Love" by Elvis Presley and "Let It Be" by The Beatles.',
                    ],
                    [
                        'img' => 'https://d21q7xesnoiieh.cloudfront.net/fit-in/900x0/filters:quality(95)/marketing/pianote/lead-gen/getting-started/thumb-04.webp',
                        'title' => 'Lesson 4',
                        'subtitle' => 'Put Everything Together',
                        'desc' => 'Ready to showcase what you’ve learned? In this final lesson, we’ll bring everything together. Follow along with Lisa as you play a full chord progression on a beautiful track. Feel the magic as you play, and walk away from this course feeling like a true pianist!',
                    ],
                ];
            @endphp
            <div class="timeline-container max-w-4xl mx-auto relative px-4 mt-6 lg:mt-14">
                @foreach ($gettings as $key => $getting)
                    <div class="timeline relative flex flex-col md:grid md:grid-cols-2 gap-4 md:gap-x-14 lg:gap-x-20 mb-16 md:mb-20">
                        <div class="relative group">
                            <a class="anchor-slide" href="#final">
                                <img class="rounded-lg transition-opacity opacity-0 group-hover:opacity-100" loading="lazy"
                                    onload="this.classList.remove('opacity-0')" src="{{ $getting['img'] }}"
                                    alt="{{ $getting['title'] }}" style="filter:brightness(0.8);" />
                                <div class="absolute flex items-center justify-center cursor-pointer" style="top:30%; left:45%">
                                    <i class="fa-solid fa-lock-keyhole text-white text-4xl shadow-lg"></i>
                                </div>
                            </a>
                        </div>
                        <div class="content relative text-left">
                            <p class="mb-1 mt-1 md:mt-0 text-pianote tracking-wide uppercase">{{ $getting['title'] }}</p>
                            @if (!empty($getting['subtitle']))
                                <h5 class="mb-2 md:mb-6 font-black">{{ $getting['subtitle'] }}</h5>
                            @endif
                            <p>{{ $getting['desc'] }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
        <a class="anchor-slide join smaller w-11/12 sm:max-w-[350px] bg-pianote" href="#final">GET STARTED FOR FREE</a>
    </section>

    <section class="px-5 sm:px-6 py-12 sm:py-16 lg:py-20 relative overflow-hidden">
        <div class="container max-w-4xl mx-auto relative z-20">
            <div class="flex flex-wrap sm:flex-nowrap items-start">
                <div class="w-full sm:w-auto flex-shrink mb-5 sm:mb-0">
                    <picture>
                        <source media="(min-width:1024px)" srcset="https://d21q7xesnoiieh.cloudfront.net/fit-in/2500x0/filters:quality(95)/marketing/pianote/lead-gen/getting-started/coach.webp">
                        <source media="(min-width:640px)" srcset="https://d21q7xesnoiieh.cloudfront.net/fit-in/1000x0/filters:quality(95)/marketing/pianote/lead-gen/getting-started/coach.webp">
                        <img class="border-8 border-white shadow-lg rounded-xl transition-opacity opacity-0"
                            src="https://d21q7xesnoiieh.cloudfront.net/fit-in/800x0/filters:quality(95)/marketing/pianote/lead-gen/getting-started/coach-m.webp"
                            alt="Lisa Witt"
                            loading="lazy"
                            onload="this.classList.remove('opacity-0')">
                    </picture>
                    <table class="w-full hidden sm:block pt-4 text-sm">
                        <tr>
                            <td class="uppercase pr-4 lg:pr-6 tracking-wide py-2">Favorite <br class="lg:hidden">Season</td>
                            <td><strong>Spring</strong></td>
                        </tr>
                        <tr>
                            <td class="uppercase pr-4 lg:pr-6 tracking-wide py-2">Favorite <br class="lg:hidden"> Song</td>
                            <td><strong>“Goodbye Yellow <br class="md:hidden"> Brick Road”</strong></td>
                        </tr>
                        <tr>
                            <td class="uppercase pr-4 lg:pr-6 tracking-wide py-2">Favorite <br class="lg:hidden"> Animal</td>
                            <td><strong>Her horse Molly</strong></td>
                        </tr>
                    </table>
                </div>
                <div class="w-full sm:w-7/12 flex-shrink-0 sm:pl-4 lg:pl-10">
                    <p class="uppercase text-pianote tracking-wider font-semibold">Meet Your Instructor</p>
                    <h1 class="pb-4 md:pb-6"><strong>Lisa Witt</strong></h1>
                    <p class="pb-2 md:pb-4">Get ready to learn from Lisa Witt, Pianote's lead instructor.</p>
                    <p class="pb-2 md:pb-4">With over 168 million views and 1.8 million subscribers on YouTube, Lisa is known for her unique approach of turning traditional piano lessons into fun, interactive, and easy-to-follow play-alongs - making her the go-to teacher for absolute beginners.</p>
                    <p class="pb-2 md:pb-4">Throughout her 20 years of teaching, Lisa has inspired millions of students to embrace the joy of playing beautiful music on the piano. Her vibrant energy and contagious passion for music shine through every lesson, making you eager to practice and return to the keys again and again. She believes anyone can play a song from their very first lesson, and she's here to guide you on your musical journey.</p>
                    <p class="pb-2 md:pb-4">Outside of music, Lisa enjoys spending time with her horse, Molly, and exploring the great outdoors.</p>
                    <div class="flex flex-wrap items-start justify-center mx-auto">
                        <div class="w-1/3 sm:px-2 mb-4 py-1 sm:py-4 lg:py-5 text-center">
                            <a href="https://www.youtube.com/pianolessonscom/" target="_blank" aria-label="youtube">
                                <i class="fab fa-youtube text-4xl sm:text-5xl text-[#ff0000]" aria-hidden="true"></i>
                            </a>
                            <h3 class="font-black leading-none my-1 sm:my-2 text-black">1.8M</h3>
                            <p class="uppercase sm:tracking-widest">Subscribers</p>
                        </div>
                        <div class="w-1/3 sm:px-2 mb-4 py-1 sm:py-4 lg:py-5 text-center">
                            <a href="https://facebook.com/pianoteofficial/" target="_blank" aria-label="facebook" style="color:#3771c8;">
                                <i class="fab fa-facebook-f text-4xl sm:text-5xl" aria-hidden="true"></i>
                            </a>
                            <h3 class="font-black leading-none my-1 sm:my-2 text-black">599K+</h3>
                            <p class="uppercase sm:tracking-widest">Likes</p>
                        </div>
                        <div class="w-1/3 sm:px-2 mb-4 py-1 sm:py-4 lg:py-5 instagram text-center">
                            <a href="https://instagram.com/pianoteofficial/" target="_blank" aria-label="instagram">
                                <i class="fab fa-instagram text-4xl sm:text-5xl" style="background: linear-gradient(30deg, #FFD521 17%, #F20008 50%, #B900B4 83%);-webkit-background-clip: text;-webkit-text-fill-color: transparent;" aria-hidden="true"></i>
                            </a>
                            <h3 class="font-black leading-none my-1 sm:my-2">302K+</h3>
                            <p class="uppercase sm:tracking-widest">Followers</p>
                        </div>
                    </div>
                </div>
            </div>
            <table class="w-full block sm:hidden">
                <tr>
                    <td class="uppercase pr-3 tracking-wide py-2">Favorite Season</td>
                    <td><strong>Spring</strong></td>
                </tr>
                <tr>
                    <td class="uppercase pr-3 tracking-wide py-2">Favorite Song</td>
                    <td><strong>“Goodbye Yellow Brick Road”</strong></td>
                </tr>
                <tr>
                    <td class="uppercase pr-3 tracking-wide py-2">Favorite Animal</td>
                    <td><strong>Her horse Molly</strong></td>
                </tr>
            </table>
        </div>
    </section>

    <section class="px-5 sm:px-6 py-12 sm:py-16 text-center bg-[#F6F5F4]">
        <div class="container max-w-5xl mx-auto">
            <h2 class="mb-8 md:mb-10"><strong>
                The easiest way</strong><br>to get started on the piano
            </h2>
            <div class="flex flex-wrap sm:flex-nowrap justify-center">
                @php
                    $features = [
                        [
                            'icon' => 'fa-regular fa-list-ol',
                            'title' => 'Guided Lessons',
                            'desc' => 'With step-by-step instructions, you’ll be shown EXACTLY what to play and practice to get the best start on the piano.',
                        ],
                        [
                            'icon' => 'fa-regular fa-computer-speaker',
                            'title' => 'Learn Anytime',
                            'desc' => 'Learn and progress at your own pace. Pause, rewind, or rewatch whenever you need.',
                        ],
                        [
                            'icon' => 'fa-regular fa-question',
                            'title' => 'Get Your Questions Answered',
                            'desc' => 'Have questions? Get personalized support from a real teacher. Email us to get the answers you need.',
                        ],
                    ];
                @endphp

                @foreach ($features as $feature)
                    <div class="w-full sm:w-1/3 px-2 mb-8 sm:mb-0 text-center flex flex-col items-center">
                        <div class="mb-4 rounded-full border-2 border-black w-16 h-16 flex items-center justify-center">
                            <i class="{{ $feature['icon'] }} text-3xl text-pianote"></i>
                        </div>
                        <h3 class="text-xl font-semibold mb-2">{{ $feature['title'] }}</h3>
                        <p class="text-gray-600 tracking-tight">{{ $feature['desc'] }}</p>
                    </div>
                @endforeach
            </div>
        </div>
    </section>


        @php
        $testimonials = [
            [
                'avatar' => 'https://d21q7xesnoiieh.cloudfront.net/fit-in/800x0/filters:quality(95)/marketing/pianote/lead-gen/getting-started/nico.webp',
                'name' => 'Nico Human',
                'location' => 'New Westminster, Canada',
                'title' => 'Learning the piano is easier than I thought it would be',
                'description' => 'Life is busy, and it’s tough to predict when you will have time to practice and learn. But learning the piano is easier than I thought it would be. The lessons are little units. It’s like how you eat an elephant: in biteable chunks!<br><br> I love that I can learn on my own schedule whenever I have an opportunity. It feels modern and progressive, and it can work for anyone.',
            ],
            [
                'avatar' => 'https://d21q7xesnoiieh.cloudfront.net/fit-in/800x0/filters:quality(95)/marketing/pianote/lead-gen/getting-started/erika.webp',
                'name' => 'Erika Espinosa',
                'location' => 'Washington, USA',
                'title' => 'Way less stressful than private lessons.',
                'description' => 'I work many hours, and I’m a mom of a teenager and a 5-year-old. I took private lessons for over a year, but it was hard for me to continue because of my busy schedule. <br><br>Pianote’s lessons are laid out so well, mimicking private lessons but allowing you to learn at your own pace. Plus, it’s way less stressful than private lessons.<br><br>I’m super happy and pleased with my decision to join Pianote!',
            ],
             [
                'avatar' => 'https://d21q7xesnoiieh.cloudfront.net/fit-in/800x0/filters:quality(95)/marketing/pianote/lead-gen/getting-started/steve.webp',
                'name' => 'Steve Wilson',
                'location' => 'Arizona, USA',
                'title' => 'I\'ve learned that it doesn\'t have to be such a huge time commitment to really start',
                'description' => 'I\'ve learned that it doesn\'t have to be such a huge time commitment to really start to learn it because I\'m doing this for me. I\'m not doing this as a course. I\'m not doing this because somebody else wants me to learn it. This is finally for me and something I want to do for myself. <br><br> I tried some piano books and I tried some of the courses, where you can plug a piano into an iPad and then try to play along with it. That didn\'t very work very well for me. But when I saw Lisa teaching basic chords and making music from that, that was very inspiring.',
            ],
           [
                'avatar' => 'https://d21q7xesnoiieh.cloudfront.net/fit-in/800x0/filters:quality(95)/marketing/pianote/lead-gen/getting-started/janet.webp',
                'name' => 'Janet Ketchen',
                'location' => 'Victoria, Canada',
                'title' => 'I’m 66 years old now, and I’m having a ball!',
                'description' => 'I first wanted to play the piano as a child. I also wanted to learn ballet. But we couldn’t afford both, so I said I would learn the piano sometime later in life. Well, I’m 66 years old now and I’m having a ball! Anyone should try this, and it is never too late to learn!',
            ],
             [
                'avatar' => 'https://d21q7xesnoiieh.cloudfront.net/fit-in/800x0/filters:quality(95)/marketing/pianote/lead-gen/getting-started/bernhard.webp',
                'name' => 'Bernhard Zainsinger',
                'location' => 'Chicago, USA',
                'title' => 'Lisa is the perfect teacher',
                'description' => 'Lisa is the perfect teacher. Her hands-on teaching approach is invaluable to my learning and helps me make progress more easily.',
            ],
           
            [
                'avatar' => 'https://d21q7xesnoiieh.cloudfront.net/fit-in/800x0/filters:quality(95)/marketing/pianote/lead-gen/getting-started/marcel.webp',
                'name' => 'Marcel Robichaud',
                'location' => 'Canada',
                'title' => 'Finally, the instrument really feels like an instrument where I can enjoy playing it',
                'description' => 'Hey, Lisa and Pianote and anyone watching this. This is Marce. <br><br> I just want to record a quick message to say Thank you for all your help.<br><br>It\'s been such a treat to be with the piano. Finally, the instrument really feels like an instrument that I can enjoy playing, rather than just being a pretty piece of furniture sitting in a corner, collecting dust in my living room (laughs).<br><br>So once again, I appreciate everything you guys do - all the support, everything. It\'s just been awesome. Thank you so much.',
            ],
        ];
        @endphp
    <section class="px-5 sm:px-6 py-12 sm:py-16 lg:py-20">
        <div class="container max-w-5xl mx-auto text-center">
        <h2 class="pb-10 md:pb-16">See why our students love us.<br>
        <strong>Real stories from real students.</strong></h2>
            <div class="masonry text-left">
                @foreach ($testimonials as $card)
                    <div class="masonry-item bg-[#F1F7FE] shadow-lg rounded-lg p-6 lg:px-6 mb-4 flex flex-col">
                        <div class="flex items-center mb-4">
                            <img class="w-16 h-16 rounded-full mr-4" src="{{ $card['avatar'] }}" alt="{{ $card['name'] }}">
                            <div>
                                <h5 class="text-lg font-semibold">{{ $card['name'] }}</h5>
                                <p class="text-gray-600 text-xs">{{ $card['location'] }}</p>
                            </div>
                        </div>
                        <div class="flex items-center mb-4">
                            <span>
                                @for ($i = 0; $i < 5; $i++)
                                    <i class="fas fa-star text-2xl text-[#FFC800]"></i>
                                @endfor
                            </span>
                        </div>
                        <h3 class="text-xl font-bold mb-2">"{{ $card['title'] }}"</h3>
                        <p class="text-gray-700 flex-grow">"{!! $card['description'] !!}"</p>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <div id="final" class="anchor"></div>
    <section class="text-center customize px-6 relative z-50 overflow-hidden py-10 sm:py-20" style="background:#EFF7FF;">
        <div class="max-w-5xl mx-auto flex flex-wrap flex-col md:flex-row md:items-center">
            <div class="max-w-lg mx-auto text-center md:text-left w-full md:w-1/2 sm:pl-5 lg:pl-0">
                @php
                        $content = [
                            'logo' => [
                                'src' => 'https://d21q7xesnoiieh.cloudfront.net/fit-in/500x0/filters:quality(95)/marketing/pianote/lead-gen/getting-started/logo.webp',
                                'alt' => 'logo',
                                'class' => 'h-14 sm:h-18 lg:h-24 mb-1 sm:mb-0 lg:mb-3'
                            ],
                            'heading' => 'Start Learning Piano <br><strong class="font-black">The Easy and Fun Way </strong>',
                            'description' => 'We don\'t do boring practice here.<br class="block lg:hidden"> <strong class="font-black">Sign up for 4 FREE lessons</strong> <br class="block"> and start playing the songs you love.',
                            'features' => [
                                'Quick lessons',
                                'Designed for absolute beginners',
                                'Play along with a REAL teacher',
                                'No theory - just pure musical joy'
                            ]
                        ];
                    @endphp

                    <div class="px-2 sm:px-4">
                        <img class="{{ $content['logo']['class'] }}" src="{{ $content['logo']['src'] }}" alt="{{ $content['logo']['alt'] }}" fetchpriority="high">
                        <h2 class="leading-none">{!! $content['heading'] !!}</h2>
                        <p class="pt-3">{!! $content['description'] !!}</p>

                        <p class="hidden md:block text-sm flex flex-col items-left md:flex-row md:flex-wrap gap-2 py-4 leading-loose">
                            @foreach ($content['features'] as $feature)
                                <span class="inline-flex items-center pl-1">
                                    <i class="fas fa-check text-pianote pr-1"></i> {{ $feature }}
                                </span>
                            @endforeach
                        </p>

                        <div class="container flex justify-center mx-auto md:hidden">
                            <div class="flex flex-col items-center leading-loose pt-2">
                                @foreach ($content['features'] as $feature)
                                    <p class="w-full text-left flex items-center">
                                        <i class="fas fa-check-circle text-pianote mr-2 py-2"></i> {{ $feature }}
                                    </p>
                                @endforeach
                            </div>
                        </div>
                    </div>

                    <div class="mt-3">
                        @include('pianote._partials.sign-up-form', [
                            'recaptchaKey' => $recaptchaKey,
                            'formId' => 'Pianote - Engagement - Trigger - GSOTPV3 - Web Form2',
                            'nameInput' => true,
                            'formName' => 'Getting Started On The Piano V3',
                            'buttonText' => 'Get started for free',
                            'stacked' => true,
                            'inputBorder' => '1px solid #7A8491',
                            'redirectURL' => '/getting-started-on-the-piano/thank-you/',
                            'minimalForm' => true,
                        ])
                    </div>
                    <div class="flex flex-row justify-center items-center text-black italic px-6">
                        <img class="h-7" src="https://d21q7xesnoiieh.cloudfront.net/fit-in/100x0/filters:quality(95)/marketing/pianote/products/30-day-blues/piano-players-trusted.png">
                        <div class="px-2 text-xs lg:text-base">Rated 4.8/5 (based on 7,074 student reviews)</div>
                    </div>
            </div>
            <div class="flex justify-center md:justify-start w-full md:w-1/2 sm:order-1 md:pl-6 mt-7 md:mt-0 relative">
                <img class="max-w-2xl lg:max-w-5xl opacity-0" 
                        loading="lazy" 
                        src="https://d21q7xesnoiieh.cloudfront.net/fit-in/1800x0/filters:quality(95)/marketing/pianote/lead-gen/getting-started/collage.webp" loading="lazy"
                        onload="this.classList.remove('opacity-0')" alt="collage">            
            </div>
        </div>
    </section>

    <section class="text-center px-5 sm:px-6 py-10 sm:py-14 lg:py-20">
        <div class="container mx-auto relative z-10 max-w-4xl">
            <h2 class="mb-4 sm:mb-6"><strong>Frequently Asked Questions</strong></h2>
            <div class="px-4">
                @php
                    $faqs = [
                        [
                            'title' => 'Who is this course for?',
                            'desc' => 'Whether you’re a complete beginner or someone who played piano long ago and wants a refresher, this course is designed for you!',
                        ],
                        [
                            'title' => 'Am I too old to learn the piano?',
                            'desc' => 'No! In fact, we think age is an advantage. Adults are often driven to learn music because that’s what they enjoy (and not because their parents want them to). As an adult, you’ve also had lifelong exposure to music. You understand rhythm, melody, and may even be able to figure out tunes by ear.',
                        ],
                        [
                            'title' => 'What will I learn in this course?',
                            'desc' => 'You will explore the keyboard, learn finger placement, and coordinate your left and right hands while playing along to beautiful, beginner-friendly tracks. Plus, you’ll learn a popular chord progression to play classic songs like "Can\'t Help Falling in Love" and "Let It Be."',
                        ],
                        [
                            'title' => 'Is it really free? ',
                            'desc' => 'Yes! It is 100% free. You don’t need to enter your credit card info or any payment method. Our dream is to inspire more musicians, and the best way to do it is to make getting started on the piano fun, easy, and absolutely free for everyone.',
                        ],
                        [
                            'title' => 'Why do you need my email? ',
                            'desc' => 'We need your email to send you the free lessons. Plus, we’re (secretly) hoping to build a relationship with you by sharing our awesome piano lessons, free resources, and any special offers we think you might be interested in.',
                        ],
                        [
                            'title' => 'Can I rewatch the lessons later?',
                            'desc' => 'Absolutely! You can revisit the lessons anytime by accessing them from the email we send you.',
                        ],
                        [
                            'title' => 'What piano do I need to start?',
                            'desc' => 'Any piano you can easily get your hands on would be a great start! If you want to invest in a new one, consider an 88-key keyboard (or at least 61 key) with touch-sensitive keys, so the sound varies depending on how hard you play.',
                        ],
                    ];
                @endphp

                @foreach ($faqs as $faq)
                    @include('_partials.components.question-dropdown', [
                        'num' => '?',
                        'title' => $faq['title'],
                        'desc' => $faq['desc'],
                    ])
                @endforeach
            </div>
        </div>
    </section>

    @include('drumeo.sales.partials._video-modal',[
        'modalId' => "demoVid",
        "video" => '//player.vimeo.com/video/1001267333?h=38472dc2c6&autoplay=1',
        "title" => 'demoVid'
    ])
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