@php
    require_once(resource_path('marketing/views/drumeo/lead-gen/pages/awards-data.php'))
@endphp

@extends('pianote._partials.global-layout')

@section('global-head')
    <title>Prima Resources | Pianote</title>
    <meta property="og:title" content="Pianote Prima Resources">

    <meta name="description" content="">
    <meta property="og:description" content="">

    <meta property="og:url" content="https://www.pianote.com/{{ Request::path() }}">
    <meta property="og:image" content="https://d2vyvo0tyx8ig5.cloudfront.net/sales/2023/share-image-pianote2.jpg" style="display: none;">

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
    </style>
@stop

@section('global-body')
    @include('pianote.sales.partials._nav')
     <header class="text-white relative overflow-hidden z-10" style="height:700px;background-color:#000;">
        <div class="transform -translate-y-1/2 top-1/2 left-0 w-full absolute z-20 px-4 lg:px-6 text-center">
            <div class="container mx-auto max-w-5xl">
                <h1 class="leading-tight my-3 lg:my-6"><strong>Getting The Most From  <br/>Your Pianote Prima Piano</strong></h1>
                <h5 class="leading-normal tracking-wide my-3 lg:my-6 italic">How to start making beautiful music on your <strong>NEW </strong>Prima piano</h5>

               
            </div>
        </div>
       
        <img class="hidden sm:inline object-cover w-full h-full relative z-0" src="https://d21q7xesnoiieh.cloudfront.net/fit-in/1200x0/filters:quality(95)/marketing/pianote/products/headphones/header-bg.webp">
        <img class="sm:hidden object-cover w-full h-full relative z-0" src="https://d21q7xesnoiieh.cloudfront.net/fit-in/1200x0/filters:quality(95)/marketing/pianote/products/headphones/header-bg-m.webp">
       
    </header>

       @php
        $timelineItems = [
            [
                'number' => '01',
                'title' => "Let's get started",
                'subtitle' => 'Unboxing & Setup',
                'description' => 'This is the exciting part. Your new piano has arrived. Let\'s get it out of the box and ready to play. This video will show you all the parts and features of the Prima, and take you step by step through the setup process. It\'s super easy! Just click play and follow along.',
                'hasVideo' => true,
                'imageUrl' => 'https://d21q7xesnoiieh.cloudfront.net/fit-in/900x0/filters:quality(95)/marketing/pianote/products/30-day-jazz-piano/sale/features-04.webp'
            ],
            [
                'number' => '02',
                'title' => 'How to use your Prima piano',
                'subtitle' => 'Prima Quickstart Guide',
                'description' => 'You\'ve turned it on, now let\'s make some music! This video is your quickstart guide to playing your Pianote Prima. We\'ll cover the basic on setup, sound selection, and essential features you need to know.',
                'hasVideo' => true,
                'imageUrl' => 'https://d21q7xesnoiieh.cloudfront.net/fit-in/900x0/filters:quality(95)/marketing/pianote/products/30-day-jazz-piano/sale/features-04.webp'
            ],
            [
                'number' => '03',
                'title' => 'Getting the most from your Prima piano',
                'subtitle' => 'Prima Advanced Features',
                'description' => 'A deeper dive into the powerful features of your Prima piano. Your Prima piano can do some amazing things. We\'ll take you through all the bells and settings so you can unleash the full potential of this beautiful piano.',
                'hasVideo' => true,
                'imageUrl' => 'https://d21q7xesnoiieh.cloudfront.net/fit-in/900x0/filters:quality(95)/marketing/pianote/products/30-day-jazz-piano/sale/features-04.webp'
            ],
            [
                'number' => '04',
                'title' => 'Download the Pianote Prima user manual',
                'subtitle' => 'User Manual Download',
                'description' => 'Lost your physical copy? No worries! You can download the user manual here.',
                'hasVideo' => false,
                'imageUrl' => 'https://d21q7xesnoiieh.cloudfront.net/fit-in/900x0/filters:quality(95)/marketing/pianote/products/30-day-jazz-piano/sale/features-04.webp'
            ]
        ];
    @endphp

<div 
    x-data="timelineNav()"
    x-init="init()"
>
    <div class="sticky top-0 bg-white border-b z-50 px-5 sm:px-6 shadow">
        <div class="container max-w-4xl mx-auto">
            <nav class="flex space-x-8 overflow-x-auto py-4 scrollbar-hide justify-start md:justify-center items-center">
                @foreach ($timelineItems as $item)
                    <button 
                        @click="scrollToSection('{{ $item['number'] }}')"
                        class="flex-shrink-0 group relative pb-2 focus:outline-none"
                    >
                        <div class="flex flex-col items-start">
                            <h5 class="font-medium uppercase tracking-tight font-bebas">{{ $item['subtitle'] }}</h5>
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

    <section class="text-center px-5 sm:px-6 py-10 sm:py-14 lg:py-20 bg-white">
            <div class="container max-w-4xl mx-auto">
                <div x-data="{ activeStep: 1 }" class="relative">
                    <!--  Line -->
                    <div class="absolute left-1 md:left-1/2 top-0 bottom-0 border-l-2 border-dashed border-black transform md:-translate-x-1/2"></div>
                
                    <div class="relative">
                        @foreach ($timelineItems as $index => $item)
                            <div class="mb-16 md:mb-24 last:mb-0 relative" data-section="{{ $item['number'] }}">
                                <!-- Num -->
                                <div class="absolute left-0 md:left-1/2 w-10 h-10 lg:h-16 lg:w-16 bg-gradient-to-b from-[#A80011] to-[#310A58] rounded-lg flex items-center justify-center transform md:-translate-x-1/2 text-white font-bold text-sm lg:text-3xl z-10 shadow-2xl">
                                    {{ $item['number'] }}
                                </div>
                
                                <div class="relative ml-12 md:ml-0 mt-10">
                                    <div class="md:grid md:grid-cols-2 md:gap-8 items-center">
                                        <!-- Img -->
                                        <div class="mt-4 md:mt-0 order-1 md:order-{{ $index % 2 === 0 ? '2' : '1' }} md:mt-20">
                                            <div class="relative rounded-lg overflow-hidden lg:mt-20">
                                                <img 
                                                    src="{{ $item['imageUrl'] }}" 
                                                    alt="{{ $item['title'] }}" 
                                                    class="w-full h-full object-cover transition-opacity duration-300 opacity-0"
                                                    onload="this.classList.remove('opacity-0')"
                                                    loading="lazy"
                                                >
                                            </div>
                                        </div>
                
                                        <!-- Content -->
                                        <div class="md:pl-8 text-left order-2 md:order-{{ $index % 2 === 0 ? '1' : '2' }} md:mt-20">
                                            <div class="space-y-3">
                                                <h6 class="border-2 rounded-full border-pianote inline-flex items-center py-1 px-3 font-medium font-bebas mt-2 md:mt-0 leading-normal tracking-tight">
                                                    {{ $item['subtitle'] }}
                                                </h6>                                                
                                                <h3 class=""><strong>{{ $item['title'] }}</strong></h3>
                                                <p class="text-[#2A2F34]">{{ $item['description'] }}</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </section>
</div>
    @include('_partials.components.video-modal',[
        'name' => 'trailer',
        'video' => '1019964518',
        'vimeo' => true,
    ])

    @include('_partials.components.video-modal',[
        'name' => 'testimonial',
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
