@extends('pianote._partials.global-layout')

@section('global-head')
    <title>Prima Resources | Pianote</title>
    <meta property="og:title" content="Pianote Prima Resources">

    <meta name="description" content="">
    <meta property="og:description" content="">

    <meta property="og:url" content="https://www.pianote.com/{{ Request::path() }}">
    <meta property="og:image" content="https://d21q7xesnoiieh.cloudfront.net/fit-in/1200x0/filters:quality(95)//marketing/pianote/lead-gen/prima-resources/share-image.jpg" style="display: none;">

    <link rel="stylesheet" href="{{ mix('marketing/css/app.css') }}">
    <link href="{{ asset('/marketing/parcel/drumeo/navigation-sales.css') }}" rel="stylesheet">
    <style>

        h1 strong, h2 strong, h3 strong, h4 strong, h5 strong, h6 strong, td strong {
            font-weight: 900;
        }
        h1, h2, h3, h4, h5, h6, li, p {
            font-weight: 400;
            line-height: 1em;
            font-family: 'Open Sans', sans-serif;
            margin: 0 auto;
        }
        h1 sup, h2 sup, h3 sup, h4 sup, h5 sup, h6 sup, li sup, p sup {
            font-size: 50%;
            top: -0.75em;
        }
        h1 {
            line-height: 1.2em;
            font-size: 30px;
        }
        @media (min-width: 768px) {
            h1 {
                font-size: 36px;
            }
        }
        @media (min-width: 1024px) {
            h1 {
                font-size: 48px;
            }
        }
        h2 {
            line-height: 1.2em;
            font-size: 24px;
        }
        @media (min-width: 768px) {
            h2 {
                font-size: 30px;
            }
        }
        @media (min-width: 1024px) {
            h2 {
                font-size: 36px;
            }
        }
        h3 {
            font-size: 20px;
        }
        @media (min-width: 768px) {
            h3 {
                font-size: 24px;
            }
        }
        @media (min-width: 1024px) {
            h3 {
                font-size: 30px;
            }
        }
        h4 {
            font-size: 18px;
        }
        @media (min-width: 768px) {
            h4 {
                font-size: 20px;
            }
        }
        @media (min-width: 1024px) {
            h4 {
                font-size: 24px;
            }
        }
        h5 {
            font-size: 16px;
        }
        @media (min-width: 768px) {
            h5 {
                font-size: 18px;
            }
        }
        @media (min-width: 1024px) {
            h5 {
                font-size: 20px;
            }
        }
        h6 {
            font-size: 15px;
        }
        @media (min-width: 768px) {
            h6 {
                font-size: 16px;
            }
        }
        @media (min-width: 1024px) {
            h6 {
                font-size: 18px;
            }
        }
        p, li {
            line-height: 1.6em;
            font-size: 15px;
        }
        @media (min-width: 1024px) {
            p, li {
                font-size: 16px;
            }
        }
        .shadow-custom {
            box-shadow: 0px 4px 4px 0px rgba(0, 0, 0, 0.25);
        }
    </style>
@stop

@section('body-data')
    x-data ='{
         modal01: false,
         modal02: false,
         modal03: false
    }'
@endsection


@section('global-body')
    @include('pianote.sales.partials._nav')


        <header class="text-white relative overflow-hidden z-10" style="background-color: #020B16;">
            <div class="transform -translate-y-1/2 top-1/2 left-0 w-full absolute z-20 px-4 lg:px-6 text-center">
                <div class="container mx-auto max-w-4xl text-center">
                    <div class="transform -translate-y-1/2 top-1/2 left-0 w-full absolute z-20 px-4 lg:px-6 text-center">
                        <div class="container mx-auto max-w-5xl">
                            <h1 class="my-3 lg:my-6">
                                <strong class="leading-tighter">Getting The Most From <br class="hidden sm:block"/>Your Pianote Prima Piano</strong>
                            </h1>
                            <h5 class="leading-normal tracking-wide my-3 lg:my-6 italic">
                                How to start making beautiful music <br class="block sm:hidden"/> on your <strong>NEW </strong>Prima piano
                            </h5>
                        </div>
                    </div>
                </div>
            </div>
            <div class="top-0 left-0 absolute w-full h-full z-10" style="background: rgba(0, 0, 0, 0.7)"></div>
            <video class="object-cover w-full relative z-0" style="height: 700px;" type="video/mp4" autoplay loop playsinline muted
                src="https://player.vimeo.com/progressive_redirect/playback/1028938916/rendition/1080p/file.mp4?loc=external&signature=c202155d97ff975ec8544dbe7d869330bae1779fd2190976d4bd3aa819bcc58e">
            </video>
        </header>

    @php
            $timelineItems = [
                [
                    'number' => '01',
                    'title' => "Let's get started",
                    'title_section' => 'Let’s get started.<br class="hidden md:block"> Setting up your new Prima piano.',
                    'subtitle' => 'Unboxing & Setup',
                    'description' => '<p class="pb-2">This is the exciting part. Your new piano has arrived. Let\'s get it out of the box and ready to play.</p>
                    <p>This video will show you all the parts and features of the Prima, and take you step by step through the setup process. It\'s super easy! Just click play and follow along.</p>',
                    'hasVideo' => true,
                    'imageUrl' => 'https://d21q7xesnoiieh.cloudfront.net/fit-in/900x0/filters:quality(95)/marketing/pianote/lead-gen/prima-resources/thumbs-01.webp'
                ],
                [
                    'number' => '02',
                    'title' => 'How to use your Prima piano',
                    'title_section' => 'How to use your Prima piano.',
                    'subtitle' => 'Prima Quickstart Guide',
                    'description' => '<p class="pb-2">You\'ve turned it on, now let\'s make some music!</p>
                    <p>This video is your quickstart guide to playing your Pianote Prima. We\'ll cover the basics on setup, sound selection, and essential features you need to know.</p>',
                    'hasVideo' => true,
                    'imageUrl' => 'https://d21q7xesnoiieh.cloudfront.net/fit-in/900x0/filters:quality(95)/marketing/pianote/lead-gen/prima-resources/thumbs-02.webp'
                ],
                [
                    'number' => '03',
                    'title' => 'Getting the most from your Prima piano',
                    'title_section' => 'Getting the most from <br class="hidden md:block">your Prima piano.',
                    'subtitle' => 'Prima Advanced Features',
                    'description' => '<p class="pb-2">A deeper dive into the powerful features of your Prima piano.</p>
                    <p>Your Prima piano can do some amazing things. We\'ll take you through all the bells and whistles so you can unleash the full potential of this beautiful piano.</p>',
                    'hasVideo' => true,
                    'imageUrl' => 'https://d21q7xesnoiieh.cloudfront.net/fit-in/900x0/filters:quality(95)/marketing/pianote/lead-gen/prima-resources/thumbs-03.webp'
                ],
                [
                    'number' => '04',
                    'title' => 'Download the Pianote Prima user manual',
                    'title_section' => 'Download the Pianote Prima <br class="hidden md:block">user manual.',
                    'subtitle' => 'User Manual Download',
                    'description' => 'Lost your physical copy? No worries! You can download the user manual here.',
                    'hasVideo' => false,
                    'imageUrl' => 'https://d21q7xesnoiieh.cloudfront.net/fit-in/900x0/filters:quality(95)/marketing/pianote/lead-gen/prima-resources/thumbs-04.webp'
                ]
            ];
        @endphp

    <div
        x-data="timelineNav()"
    >
        <div class="sticky top-0 bg-white border-b z-50 px-5 sm:px-6 shadow">
            <div class="container max-w-4xl mx-auto">
                <nav class="flex space-x-8 overflow-x-auto py-4 scrollbar-hide justify-start sm:justify-center items-center">
                    @foreach ($timelineItems as $item)
                        <button
                            @click="scrollToSection('{{ $item['number'] }}')"
                            class="flex-shrink-0 group relative pb-0.5 focus:outline-none"
                        >
                            <div class="flex flex-col items-start">
                                <h5 class="font-medium uppercase font-bebas tracking-normal">{{ $item['subtitle'] }}</h5>
                            </div>
                           <div
                            class="absolute bottom-0 left-0 w-full h-0.5 bg-pianote transform transition-transform duration-300"
                            :class="activeSection === '{{ $item['number'] }}' ? 'scale-x-100' : 'scale-x-0'"
                            x-cloak
                        ></div>
                        </button>
                    @endforeach
                </nav>
            </div>
        </div>

        <section class="text-center pl-2 pr-4 sm:px-8 pb-16 md:pb-0 bg-white">
                <div class="container max-w-5xl mx-auto">
                    <div x-data="{ activeStep: 1}" class="relative">
                        <!--  Line -->
                        <div class="absolute left-1 md:left-1/2 top-0 bottom-0 transform md:-translate-x-1/2">
                            <svg class="h-full" width="2" viewBox="0 0 2 100" preserveAspectRatio="none">
                                <line
                                    x1="1"
                                    y1="0"
                                    x2="1"
                                    y2="100"
                                    stroke="#3B3B3B"
                                    stroke-width="2"
                                    stroke-dasharray="0.5 0.7"
                                />
                            </svg>
                        </div>
                        <div class="relative">
                            @foreach ($timelineItems as $index => $item)
                                <div class="mb-16 md:mb-24 last:mb-0 relative" data-section="{{ $item['number'] }}">
                                    <div class="absolute left-0 md:left-1/2 w-10 h-10 lg:h-16 lg:w-16 bg-gradient-to-b from-[#A80011] to-[#310A58] rounded-lg flex items-center justify-center transform md:-translate-x-1/2 text-white font-bold text-sm lg:text-3xl z-10 shadow-custom">
                                        {{ $item['number'] }}
                                    </div>

                                    <div class="relative ml-12 md:ml-0 mt-10">
                                        <div class="md:grid md:grid-cols-2 sm:gap-20 lg:gap-32 items-center md:pt-20 {{ $loop->last ? 'md:pb-20' : '' }}">
                                            <div class="mt-4 md:mt-0 order-1 md:order-{{ $index % 2 === 0 ? '1' : '2' }}">
                                                <div class="relative rounded-lg overflow-hidden lg:mt-20">
                                                    @if (!$item['hasVideo'])
                                                        <a href="https://pianote.s3.amazonaws.com/products/Pianote-Prima/Prima-User-Manual.pdf" target="_blank" download>
                                                    @endif
                                                            <img
                                                                src="{{ $item['imageUrl'] }}"
                                                                alt="{{ $item['title'] }}"
                                                                class="w-full h-full object-cover transition-opacity duration-300 opacity-0 cursor-pointer"
                                                                onload="this.classList.remove('opacity-0')"
                                                                loading="lazy"
                                                                @click="modal{{ $item['number'] }} = true"
                                                            >
                                                    @if (!$item['hasVideo'])
                                                        </a>
                                                    @endif
                                                </div>
                                            </div>

                                            <div class="text-left order-2 md:order-{{ $index % 2 === 0 ? '2' : '1' }} lg:mt-20">
                                                <div class="space-y-3">
                                                    <h6 class="border-2 rounded-full border-pianote inline-flex items-center pt-0.5 px-3 font-medium font-bebas mt-2 md:mt-0 leading-normal tracking-wider">
                                                        {{ $item['subtitle'] }}
                                                    </h6>
                                                    <h4 class="leading-normal"><strong>{!! $item['title_section'] !!}</strong></h4>
                                                    <div class="leading-relaxed {{ $index === 2 ? 'md:pr-12' : '0' }}">{!! $item['description'] !!}</div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <i class="fa-regular fa-chevron-down -mt-6 hidden md:inline"></i>
                </div>
            </section>
    </div>

    <section class="pb-10 md:pb-28 px-4">
        <div class="bg-gradient-to-b from-[#A80011] to-[#310A58] rounded-3xl px-4 sm:px-8 py-8 sm:py-16 mx-auto max-w-5xl">
            <div class="text-center space-y-6 text-white">
                <div class="flex justify-center mb-4">
                <i class="fa-solid fa-party-horn text-[#FFAE00] text-5xl lg:text-7xl"></i>
                </div>

                <h4 class="leading-tight"><strong>You're ready to go! Let's play beautiful music.</strong></h4>

                <h5 class="italic leading-relaxed">
                    Your piano's on. You've chosen the perfect sound. Your fingers are ready to go... <br>
                    Log in to Pianote and find your perfect lesson today.
                </h5>

                <div class="mt-8">
                    <a href="https://www.musora.com/pianote" class="join bg-pianote smaller w-full md:max-w-[400px]">
                        LOGIN
                    </a>
                </div>
            </div>
        </div>
    </section>

    @include('_partials.components.video-modal',[
        'name' => 'modal01',
        'video' => '1032542803',
        'vimeo' => true,
    ])
     @include('_partials.components.video-modal',[
        'name' => 'modal02',
        'video' => '1019964518',
        'vimeo' => true,
    ])
     @include('_partials.components.video-modal',[
        'name' => 'modal03',
        'video' => '1019964518',
        'vimeo' => true,
    ])

    @include("pianote.sales.partials._footer")
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="{{ asset('/marketing/parcel/drumeo/navigation-sales.js') }}"></script>

    <script>
    document.addEventListener('alpine:init', () => {
        Alpine.data('timelineNav', () => ({
            activeSection: '01',
            init() {},
            updateActiveSection() {
                const sections = document.querySelectorAll('[data-section]');
                const scrollPosition = window.scrollY + (window.innerHeight / 3);

                sections.forEach((section) => {
                    const sectionTop = section.offsetTop;
                    const sectionBottom = sectionTop + section.offsetHeight;

                    if (scrollPosition >= sectionTop && scrollPosition < sectionBottom) {
                        this.activeSection = section.dataset.section;
                    }
                });
            },

            scrollToSection(number) {
                const section = document.querySelector(`[data-section="${number}"]`);
                if (section) {
                    const offset = 100;
                    const elementPosition = section.getBoundingClientRect().top;
                    const offsetPosition = elementPosition + window.pageYOffset - offset;

                    window.scrollTo({
                        top: offsetPosition,
                        behavior: 'smooth'
                    });

                    this.activeSection = number;
                }
            }
        }));
    });
    </script>
@stop
