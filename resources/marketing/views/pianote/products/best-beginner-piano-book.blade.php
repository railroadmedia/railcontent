@extends('pianote._partials.global-layout')

@section('global-head')
    @parent
    <title>The Best Beginner Piano Book | Pianote</title>
    <meta property="og:title" content="The Best Beginner Piano Book | Pianote">
    <meta name="description" content="The Best Beginner Piano Book is packed with useful information for your musical journey.">
    <meta property="og:description" content="The Best Beginner Piano Book is packed with useful information for your musical journey.">
    <meta property="og:image"
        content="https://d21q7xesnoiieh.cloudfront.net/fit-in/1200x0/marketing/pianote/products/the-best-beginner-piano-book/share-image.jpg"
        style="display: none;">
    <meta property="og:url" content="https://www.pianote.com/{{ Request::path() }}">
    <script defer src="https://cdn.jsdelivr.net/npm/@alpinejs/focus@3.x.x/dist/cdn.min.js"></script>


    @include('_partials.layout._fonts')
    <link rel="stylesheet" href="{{ mix('marketing/css/app.css') }}">
    <link href="{{ asset('/marketing/css/tailwind-helpers.css') }}" rel="stylesheet">
    <link href="{{ asset('/marketing/parcel/drumeo/nav-footer-pianote.css') }}" rel="stylesheet">
    <link href="{{ asset('/marketing/parcel/drumeo/30dd.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@splidejs/splide@4.1.4/dist/css/splide.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;700&display=swap" rel="stylesheet">

    <style>

        header {
            background-image: url('https://d21q7xesnoiieh.cloudfront.net/fit-in/850x0/filters:quality(95)/marketing/pianote/products/pianote-practice-planner/header-bg-m.webp');
            background-size: cover;
        }

        @media (min-width: 639px) {
            header {
                background-image: url('https://d21q7xesnoiieh.cloudfront.net/fit-in/2500x0/filters:quality(95)/marketing/pianote/products/pianote-practice-planner/header-bg.webp');
                background-size: cover;
            }
        }

        .icon-gradient {
            background: linear-gradient(180deg, #F61A30, #C70017);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }
    </style>
@stop()

@section('global-body')
    @include('pianote.sales.partials._nav', [
        'cartVersion' => true,
    ])

    @include('_partials.components.shop.promo-banner-2', [
        "name" => "Practice Kit",
        "fullPrice" => floatval($productPrices['best-beginner-piano-book']->price),
        "price" => floatval($productPrices['best-beginner-piano-book']->discounted_price),
        "noBreadcrumb" => true
    ])
    @php

    $discountedPrice =  $discountedPrice = number_format(floatval($productPrices['best-beginner-piano-book']->discounted_price), 2) == intval(floatval($productPrices['best-beginner-piano-book']->discounted_price))
        ? floatval($productPrices['best-beginner-piano-book']->discounted_price)
        : number_format(floatval($productPrices['best-beginner-piano-book']->discounted_price), 2);
    @endphp

    <header class="text-white px-5 sm:px-6 pt-96 pb-10 sm:py-20 lg:py-36 relative" style="background-color:#111729;">
        <div class="inset-0 absolute z-0 bg-top bg-cover block sm:hidden" style="background:url('https://d21q7xesnoiieh.cloudfront.net/fit-in/0x0/filters:quality(95)/marketing/pianote/products/the-best-beginner-piano-book/header-bg-m.webp')"></div>
        <div class="inset-0 absolute z-0 bg-top bg-cover hidden sm:block" style="background:url('https://d21q7xesnoiieh.cloudfront.net/fit-in/0x0/filters:quality(95)/marketing/pianote/products/the-best-beginner-piano-book/header.webp')"></div>
        <div class="container max-w-4xl mx-auto relative z-10">
            <div class="flex flex-wrap sm:flex-nowrap items-center">
                <div class="w-full sm:w-5/12 text-center lg:text-left">
                    <img class="h-28 lg:h-40 mx-0" alt="logo" fetchpriority="high"
                        src="https://d21q7xesnoiieh.cloudfront.net/fit-in/440x0/filters:quality(95)/marketing/pianote/products/the-best-beginner-piano-book/header-logo.svg">
                    <p class="leading-normal my-4 sm:my-6">The simplest guide for beginners to <br class="block md:hidden"> get started on the piano.</p>
                    <h2 class="leading-tight mb-4 sm:mb-6">
                        @if(floatval($productPrices['best-beginner-piano-book']->price) > $discountedPrice)
                            <strong> <s class="opacity-60">${{ floatval($productPrices['best-beginner-piano-book']->price) }}</s></strong>
                            <strong>${{ $discountedPrice }}</strong> <span class="text-pianote text-base">(SAVE {{ round(100 - (100 * ($discountedPrice / floatval($productPrices['best-beginner-piano-book']->price)))) }}%)</span>
                        @else
                            <strong>${{ $discountedPrice }}</strong>
                        @endif
{{--                        @if(!empty($membersVersion))--}}
{{--                            <br>+ a FREE digital songbook--}}
{{--                        @endif--}}
                    </h2>
                    <a href="#final" class="join medium w-full anchor-slide">GET YOUR COPY &raquo;</a>
                </div>
            </div>
        </div>
    </header>

    <section class="text-center px-5 sm:px-6 py-8 sm:py-16 lg:py-20 relative" style="background-color:#F2EFED">
        <div class="container mx-auto z-10 relative max-w-5xl">
            @php
                $item = [
                    'img' => 'https://d21q7xesnoiieh.cloudfront.net/fit-in/1500x0/filters:quality(95)/marketing/pianote/products/the-best-beginner-piano-book/intro-image.webp',
                    'desc' => [
                        'The first step is always the hardest.',
                        'But your first step to learning the piano will be easy (and fun) with the Best Beginner Piano Book. This book distills the essential information you need to have success on the piano.',
                        'Here’s the sad truth…',
                        'Most beginners quit.',
                        'But with the Best Beginner Piano Book, you’ll follow a proven strategy to understand the keys, music theory, chords, and how to start reading sheet music.',
                        'Every step is mapped out in full color with descriptions and diagrams to help you visualize and understand the important concepts in music.',
                        'And that’s the goal.',
                        'Because when you understand it…',
                        'You can apply it.'
                    ],
                    'alt' => 'Piano Key Overlay',
                    'title' => 'The first step never <br class="block md:hidden"> felt so easy.',
                ];
            @endphp
            <h1 class="leading-tight mx-0 my-2" style="font-family: 'Playfair Display', serif;">
                <strong>{!! $item['title'] !!}</strong>
            </h1>
            <div class="text-left flex flex-col sm:flex-row justify-center items-center md:py-10">
                <div class="w-full sm:w-6/12 rounded-2xl order-1 sm:order-2"
                     loading="lazy"
                     onload="this.classList.remove('opacity-0')">
                    <img class="object-cover w-full h-full rounded-2xl"
                         src="{{ $item['img'] }}"
                         alt="{{ $item['alt'] }}">
                </div>

                <div class="flex flex-row md:flex-col sm:flex-1 justify-center items-start py-4 sm:pr-4 md:px-10 order-2 sm:order-1">
                    <div>
                        @foreach ($item['desc'] as $desc)
                            <p class="pb-2">{!! $desc !!}</p>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="text-center text-white pt-10 sm:pt-14 lg:pt-20 bg-cover bg-center" style="background-color:#2a2f34; background-image:url('https://d21q7xesnoiieh.cloudfront.net/fit-in/1500x0/filters:quality(95)/marketing/pianote/products/the-best-beginner-piano-book/piano-bg.webp');">
        <h3 class="leading-tight"><strong>Take a look inside</strong></h3>
        <p class="leading-normal mt-1 sm:mt-2 mb-4 sm:mb-5 text-xs sm:text-base">
            <i class="fa-light fa-arrow-turn-down fa-flip-horizontal mr-1 relative text-[#F61A30]" style="bottom:-7px"></i>
            <em>Click to see inside the Best Beginner Piano Book.</em>
            <i class="fa-light fa-arrow-turn-down ml-1 relative text-[#F61A30]" style="bottom:-7px"></i>
        </p>
        <a target="_blank" href="https://musora-image-processing-cdn.s3.us-east-2.amazonaws.com/marketing/pianote/products/the-best-beginner-piano-book/bbpb-sample.pdf" class="relative">
            <img class="inline-block lg:hidden w-full transition-all opacity-0" src="https://d21q7xesnoiieh.cloudfront.net/fit-in/1500x0/filters:quality(95)/marketing/pianote/products/the-best-beginner-piano-book/piano-m.webp" alt="tablet piano" loading="lazy" onload="this.classList.remove('opacity-0')">
            <img class="hidden lg:inline-block w-full transition-all opacity-0" src="https://d21q7xesnoiieh.cloudfront.net/fit-in/2500x0/filters:quality(95)/marketing/pianote/products/the-best-beginner-piano-book/piano.webp" alt="tablet piano" loading="lazy" onload="this.classList.remove('opacity-0')">
        </a>
    </section>

    <section class="bg-white sm:py-20">
        <div class="py-8">
            <div class="max-w-6xl mx-auto px-4">
                <h3 class="text-center mb-2 lg:mb-4">
                    <strong>
                    10 things this book <br class="block md:hidden"> will teach you.
                    </strong>
                </h3>
                <p class="text-center mb-2 lg:mb-4">
                    The Best Beginner Piano Book is packed with useful information for your musical journey.
                </p>
                <p class="text-center mb-6"><strong>Here are just some of the things you'll learn:</strong></p>

                @php
                $sections = [
                    [
                        'image' => [
                            'src' => 'https://d21q7xesnoiieh.cloudfront.net/fit-in/1000x0/filters:quality(95)/marketing/pianote/products/the-best-beginner-piano-book/10-things-01.webp',
                            'alt' => 'The Best Beginner Piano Book',
                            'caption' => '<strong>How to play songs</strong> when all you have are the lyrics<br class="hidden sm:block md:hidden lg:block"> and chords (no sheet music).'
                        ],
                        'cards' => [
                            [
                                'icon' => 'icons-02.svg',
                                'text' => 'The <strong>4 elements</strong> you need to consider when setting up your practice space.'
                            ],
                            [
                                'icon' => 'icons-05.svg',
                                'text' => '<strong>3 guidelines</strong> to follow when choosing the best piano for you (don\'t skip these).'
                            ],
                            [
                                'icon' => 'icons-08.svg',
                                'text' => 'How to use <strong>landmark notes</strong> to read music faster so you don\'t have to memorize every single note.'
                            ],
                            [
                                'icon' => 'icons-04.svg',
                                'text' => 'The <strong>important difference</strong> between a C-sharp and a D-flat (yes, there is one!).'
                            ]
                        ]
                    ],
                    [
                        'image' => [
                            'src' => 'https://d21q7xesnoiieh.cloudfront.net/fit-in/1000x0/filters:quality(95)/marketing/pianote/products/the-best-beginner-piano-book/10-things-02.webp',
                            'alt' => 'Common Piano Mistakes',
                            'caption' => 'How to <strong>avoid (and overcome) these common mistakes</strong><br class="hidden sm:block md:hidden lg:block"> beginners make that slow their progress.'
                        ],
                        'cards' => [
                            [
                                'icon' => 'icons-07.svg',
                                'text' => 'How to quickly identify and <strong>play any interval</strong> to make learning songs faster.'
                            ],
                            [
                                'icon' => 'icons-06.svg',
                                'text' => 'The 4-step "<strong>Pre-Trip Checklist</strong>" that guarantees you\'ll learn new songs faster.'
                            ],
                            [
                                'icon' => 'icons-03.svg',
                                'text' => 'The relationship between <strong>major and minor</strong> scales and how to play both.'
                            ],
                            [
                                'icon' => 'icons-01.svg',
                                'text' => 'The <strong>3 steps to take</strong> when you\'re stuck to get through any hurdle.'
                            ]
                        ]
                    ]
                ];
                @endphp

                @foreach ($sections as $index => $section)
                <div class="flex flex-col md:flex-row gap-4 {{ !$loop->last ? 'mb-4' : '' }}">
                    <!-- Image -->
                    <div class="w-full md:w-1/2 rounded-lg overflow-hidden relative aspect-[4/3] order-1 md:order-{{ $index % 2 === 0 ? '1' : '2' }}">
                        <img
                            src="{{ $section['image']['src'] }}"
                            alt="{{ $section['image']['alt'] }}"
                            class="w-full h-full object-cover"
                            loading="lazy"
                        >
                        <div class="absolute bottom-0 left-0 right-0 bg-gradient-to-t from-black to-transparent pt-16 pb-4 px-4">
                            <p class="text-white md:pl-4 pb-4">
                                {!! $section['image']['caption'] !!}
                            </p>
                        </div>
                    </div>
                    <!-- Cards  -->
                    <div class="w-full md:w-1/2 grid sm:grid-cols-2 gap-4 order-2 md:order-{{ $index % 2 === 0 ? '2' : '1' }}">
                        @foreach ($section['cards'] as $card)
                        <div class="bg-[#F2EFED] rounded-lg p-4 transition-shadow duration-200 flex flex-row md:flex-col" style="box-shadow: 0px 4px 4px 0px rgba(0, 0, 0, 0.25);">
                            <div class="icon-gradient w-12 h-12 flex items-center justify-center mb-4 md:mb-6 md:mr-0 mr-4">
                                <img src="https://d21q7xesnoiieh.cloudfront.net/fit-in/2500x0/filters:quality(95)/marketing/pianote/products/the-best-beginner-piano-book/{{ $card['icon'] }}" alt="Icon {{ $index + 1 }}" class="w-9 h-9 md:w-11 md:h-11 object-contain">
                            </div>
                            <p class="leading-snug lg:pt-10">{!! $card['text'] !!}</p>
                        </div>
                        @endforeach
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>

<section class="relative text-center px-3 sm:px-6 py-10 sm:py-14 lg:py-24" style="background: linear-gradient(180deg, #F2EFED 46.59%, rgba(242, 239, 237, 0) 100%);">
 <div class="absolute z-10 top-0 left-0 right-0 bg-cover bg-no-repeat bg-top z-10 h-1/2 lg:h-full" style="background-image:url('https://d21q7xesnoiieh.cloudfront.net/fit-in/1500x0/filters:quality(95)/marketing/pianote/products/the-best-beginner-piano-book/author-bg.webp');"></div>
        <div class="container max-w-5xl mx-auto relative z-20">
            <h3 class="text-center mb-24"><strong>About The Authors</strong></h3>

            <div class="flex flex-wrap sm:flex-nowrap items-start justify-center">
                <div class="w-full sm:w-1/2 px-4 mb-20 sm:mb-0">
                    <div class="relative text-left z-10 rounded-xl py-8 sm:py-12 px-6 sm:px-10 w-full shadow-lg" style="background-color:#f2efed;">
                        <img class="absolute top-0 left-1/2 -translate-x-1/2 -translate-y-1/2 w-32 lg:w-36 z-20 rounded-full border-4 border-white shadow-md transition-all opacity-0" alt="profile picture" loading="lazy" onload="this.classList.remove('opacity-0')"
                            src="https://www.musora.com/cdn-cgi/image/width=550,quality=95/https://d2vyvo0tyx8ig5.cloudfront.net/products/classical-piano-pieces/lisa-profile.jpg">
                        <br>
                        <img class="h-5 mt-4 sm:mt-3 mb-3 lg:mb-4 transition-all opacity-0" alt="lisa signature" loading="lazy" onload="this.classList.remove('opacity-0')"
                            src="https://www.musora.com/cdn-cgi/image/width=550,quality=95/https://d2vyvo0tyx8ig5.cloudfront.net/products/classical-piano-pieces/Vector.svg">
                        <p class="leading-normal">
                            Lisa Witt is the lead instructor at Pianote and head of Education at Musora (Drumeo, Singeo, Guirtareo). She has inspired millions of students around the world with her infectious enthusiasm for this instrument.
                            <br><br>Her passion is helping people realize that it doesn’t take some special talent to play the piano.
                            <br><br>All you need is the right information and a good teacher.
                            <br><br>And good information can be hard to find.
                            <br><br>“It can be really hard to know what piano book you should learn with as an adult,” says Lisa.
                            <br><br>“You go into a music store and it's been the same exact books for as long as I've been a human.”
                            <br><br>This book gives you both.
                            <br><br>“We wanted to create something that would have everything a new piano student would need to understand how the instrument works, begin playing, and of course, have some fun.”
                            <br><br>Lisa is also the author of “Piano Chords & Scales: The Ultimate Guide” and “The Pianote Practice Planner.”
                        </p>
                    </div>
                </div>
                <div class="w-full sm:w-1/2 px-4">
                    <div class="relative text-left z-10 rounded-xl py-8 sm:py-12 px-6 sm:px-10 w-full shadow-lg" style="background-color:#f2efed;">
                        <img class="absolute top-0 left-1/2 -translate-x-1/2 -translate-y-1/2 w-32 lg:w-36 z-20 rounded-full border-4 border-white shadow-md transition-all opacity-0" alt="profile picture" loading="lazy" onload="this.classList.remove('opacity-0')"
                            src="https://www.musora.com/cdn-cgi/image/width=550,quality=95/https://d2vyvo0tyx8ig5.cloudfront.net/products/classical-piano-pieces/eleny-profile.jpg">
                        <br>
                        <img class="h-7 mt-4 sm:mt-3 mb-1.5 lg:mb-4 transition-all opacity-0" alt="lisa signature" loading="lazy" onload="this.classList.remove('opacity-0')"
                            src="https://www.musora.com/cdn-cgi/image/width=550,quality=95/https://d2vyvo0tyx8ig5.cloudfront.net/products/classical-piano-pieces/Vector-1.svg">
                        <p class="leading-normal">
                            Eleny Quapp is a skilled musician with over 20 years of experience. As a former student of the Royal Conservatory of Music, she has refined her skills at the piano and has since become an accomplished teacher, passing on her passion for music to her students.
                            <br><br>And that skill shines through in this book. Eleny’s attention to detail and keen understanding of the student journey are beautifully reflected in the color diagrams and explanations found inside.
                            <br><br>“Making music is a beautiful experience, and we wanted it to be accessible to everyone—without the pressure of fitting into a traditional mold,” says Eleny.
                            <br><br>“Our hope is that learning to play the piano becomes a joyful adventure, and that's exactly why I love this book.”
                            <br><br>“It blends the pure joy of music with a learning approach that feels free and fun and not confined by all the lines.”
                            <br><br>All the musical examples were arranged by Eleny to be approachable and sound good while instilling the core concepts of each lesson.
                            <br><br>Eleny is also the author of “The Most Beautiful Piano Classical Pieces.”
                        </p>
                    </div>
                </div>
            </div>

        </div>
    </section>
    <section class="text-center px-4 sm:px-6 pb-10 sm:pb-14 lg:pb-20 mb-20 sm:mb-24">
        <div class="container max-w-6xl mx-auto">
            <h3 class="leading-tight text-center mb-6 sm:mb-7"><strong>The Best Beginner<br class="inline sm:hidden"> Piano Book</strong></h3>

            @php
                $slides = [
                 [
                     'img' => 'marketing/pianote/products/the-best-beginner-piano-book/collage-02a.png',
                 ],
                 [
                     'img' => 'marketing/pianote/products/the-best-beginner-piano-book/collage-04.webp',
                 ],
                 [
                     'img' => 'marketing/pianote/products/the-best-beginner-piano-book/collage-01c.png',
                 ],
                 [
                     'img' => 'marketing/pianote/products/the-best-beginner-piano-book/collage-06.webp',
                 ],
                 [
                     'img' => 'marketing/pianote/products/the-best-beginner-piano-book/collage-05.webp',
                 ],
                 [
                     'img' => 'marketing/pianote/products/the-best-beginner-piano-book/collage-03.webp',
                 ],

             ];

             $scaleAnimation = 'cursor-pointer transform transition duration-500 ease-in-out hover:scale-105';
             $handleClick = 'handleClick';
            @endphp

            @component('drumeo._partials.modal-carousel', ['slides' => $slides, 'scaleAnimation' => $scaleAnimation, 'handleClick' => $handleClick])
                <div class="flex flex-wrap items-center">
                    <div class="w-1/2 lg:w-1/4">
                        <div class="p-1 md:p-2 lg:p-3 w-full">
                            <div @click="handleClick(1)"
                                class="h-36 sm:h-40 lg:h-48 w-full bg-center bg-cover rounded-xl cursor-pointer hover:opacity-90 {{ $scaleAnimation }}"
                                style="background-image:url('https://d21q7xesnoiieh.cloudfront.net/fit-in/480x0/filters:quality(95)/{{ $slides[1]['img'] }}')">
                            </div>
                        </div>
                        <div class="p-1 md:p-2 lg:p-3 w-full">
                            <div @click="handleClick(3)"
                                class="h-36 sm:h-36 lg:h-44 w-full bg-center bg-cover rounded-xl cursor-pointer hover:opacity-90 {{ $scaleAnimation }}"
                                style="background-image:url('https://d21q7xesnoiieh.cloudfront.net/fit-in/480x0/filters:quality(95)/{{ $slides[3]['img'] }}')">
                            </div>
                        </div>
                    </div>
                    <div class="w-1/2 lg:w-1/4">
                        <div class="p-1 md:p-2 lg:p-3 w-full">
                            <div @click="handleClick(2)"
                                class="h-72 sm:h-80 lg:h-96 w-full bg-center bg-cover rounded-xl cursor-pointer hover:opacity-90 {{ $scaleAnimation }}"
                                style="background-image:url('https://d21q7xesnoiieh.cloudfront.net/fit-in/1000x0/filters:quality(95)/{{ $slides[2]['img'] }}')">
                            </div>
                        </div>
                    </div>
                    <div class="w-1/2 lg:w-1/4">
                        <div class="p-1 md:p-2 lg:p-3 w-full">
                            <div @click="handleClick(0)"
                                class="h-72 sm:h-80 lg:h-96 w-full bg-center bg-cover rounded-xl cursor-pointer hover:opacity-90 {{ $scaleAnimation }}"
                                style="background-image:url('https://d21q7xesnoiieh.cloudfront.net/fit-in/1000x0/filters:quality(95)/{{ $slides[0]['img'] }}')">
                            </div>
                        </div>
                    </div>
                    <div class="w-1/2 lg:w-1/4">
                        <div class="p-1 md:p-3 w-full">
                            <div @click="handleClick(5)"
                                class="h-36 sm:h-36 lg:h-44 w-full bg-center bg-cover rounded-xl cursor-pointer hover:opacity-90 {{ $scaleAnimation }}"
                                style="background-image:url('https://d21q7xesnoiieh.cloudfront.net/fit-in/480x0/filters:quality(95)/{{ $slides[5]['img'] }}')">
                            </div>
                        </div>
                        <div class="p-1 md:p-2 lg:p-3 w-full">
                            <div  @click="handleClick(4)"
                                class="h-36 sm:h-40 lg:h-48 w-full bg-center bg-cover rounded-xl cursor-pointer hover:opacity-90 {{ $scaleAnimation }}"
                                style="background-image:url('https://d21q7xesnoiieh.cloudfront.net/fit-in/480x0/filters:quality(95)/{{ $slides[4]['img'] }}')">
                            </div>
                        </div>
                    </div>
                </div>
            @endcomponent
     </div>

    </section>
    <div id="final" class="anchor"></div>

   @php
    $offers = [
        [
            'color' => 'black',
            'title' => ' ',
            'originalPrice' => $productPrices['best-beginner-piano-book']->price,
            'currentPrice' => $discountedPrice,
            'link' => '/ecommerce/add-to-cart?products[best-beginner-piano-book]=1',
            'imageSrc' => 'https://d21q7xesnoiieh.cloudfront.net/fit-in/800x0/filters:quality(95)/marketing/pianote/products/the-best-beginner-piano-book/bundle-01.webp',
            'imageClass' => 'h-48 opacity-0',
            'buttonText' => 'GET YOUR COPY',
            'buttonClass' => 'musora',
            'subtext' => 'One-time payment',
                'features' => [
                    '<i class="fa fa-check text-pianote"></i> 194 Pages',
                    '<i class="fa fa-check text-pianote"></i> Full-color diagrams and explanations',
                    '<i class="fa fa-check text-pianote"></i> Simple language with examples',
                ]
        ]
    ];
    @endphp

         <section class="text-center px-4 py-10 sm:px-6 sm:pt-14 lg:pt-20 bg-[#F2EFED]">
        <div class="container mx-auto max-w-5xl">
            <img class="h-16 sm:h-20 lg:h-44" src="https://d21q7xesnoiieh.cloudfront.net/fit-in/1100x0/filters:quality(95)/marketing/pianote/products/the-best-beginner-piano-book/order-logo.svg" alt="Logo" />

            <p class="mb-6 lg:mb-10 mt-2 lg:mt-4">
                Stay on track and see better <br class="block sm:hidden"> results from your practice sessions.<br>
                Make every practice perfect.
            </p>

            <div class="flex flex-wrap lg:flex-nowrap items-stretch justify-center w-full mb-5 sm:mb-10 mx-auto space-y-4 md:space-y-0 md:space-x-4 lg:space-x-8">
                @foreach($offers as $offer)
                    <div class="w-full md:w-1/2 lg:w-1/2 max-w-sm lg:px-1 px-1 relative border-2 border-{{ $offer['color'] }} rounded-2xl shadow-md mb-4 lg:mb-0 bg-white flex flex-col">
                        @if(!empty($offer['badge']))
                            <p class="absolute top-0 left-1/2 transform -translate-x-1/2 -translate-y-1/2 mb-1 px-5 py-1 z-10 leading-tight text-sm rounded-full tracking-widest text-white bg-{{$offer['color']}}">
                                {{ $offer['badge'] }}
                            </p>
                        @endif

                        <div class="text-black overflow-hidden rounded-2xl block mx-auto mb-4 lg:mb-0 group border-2 border-white flex-grow flex flex-col">
                            <div class="bg-white px-3 py-6 md:py-7 flex-grow">
                                <h3 class="leading-tight mb-2"><strong>{{ $offer['title'] }}</strong></h3>

                                <img class="{{ $offer['imageClass'] }}"
                                    src="{{ $offer['imageSrc'] }}"
                                    loading="lazy"
                                    onload="this.classList.remove('opacity-0')"
                                    alt="{{ $offer['title'] }}"
                                >

                                <h3 class="leading-tight mt-2">
                                    <span class="line-through text-gray-400">${{ $offer['originalPrice'] }}</span>
                                    <strong>${{ $offer['currentPrice'] }}</strong>
                                    @if(!empty($offer['discount']))
                                        <span class="text-pianote ml-1 text-sm lg:text-base">(Save {{ $offer['discount'] }})</span>
                                    @endif
                                </h3>

                                <p class="text-sm mb-5"><em>{!! $offer['subtext'] !!}</em></p>

                                <a class="w-full transition-opacity join text-xl md:text-2xl max-w-[300px] py-3 px-6 hover:opacity-80 rounded-full text-white bg-{{ $offer['color'] }}" href="{{ $offer['link'] }}">
                                    {{ $offer['buttonText'] }}
                                </a>
                            </div>

                            <div class="px-4 sm:px-4 md:px-10 pb-7">
                                @foreach($offer['features'] as $feature)
                                    <div class="flex items-start text-left text-sm mb-1.5">
                                        <span>{!! $feature !!}</span>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <section class="text-center pb-10 text-[#505050]" style="background: #F2EFED;">
        <div class="container mx-auto relative z-50">
         <div class="inline-block w-full px-3 md:px-4" style="margin-top: 0;">
                <i class="mx-0.5 text-3xl md:text-4xl fab fa-cc-visa"></i>
                <i class="mx-0.5 text-3xl md:text-4xl fab fa-cc-mastercard"></i>
                <i class="mx-0.5 text-3xl md:text-4xl fab fa-cc-amex"></i>
                <i class="mx-0.5 text-3xl md:text-4xl fab fa-cc-paypal"></i>
                <i class="mx-0.5 text-3xl md:text-4xl fab fa-cc-discover"></i>
            </div>
            <div class="inline-block w-full px-3 md:px-4 mb-5">
                <p>Call us toll-free at
                    <a href="tel:+18004398921">1-800-439-8921</a> <br class="inline-block md:hidden"> or directly at
                    <a href="tel:+16048557605">1-604-855-7605</a>.<br> All prices listed in USD. </p>
            </div>

        </div>
    </section>


    @include('pianote.sales.partials._footer')

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script type="text/javascript" src="{{ asset('/marketing/parcel/drumeo/navigation-sales.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/@splidejs/splide@4.1.4/dist/js/splide.min.js"></script>

@stop
