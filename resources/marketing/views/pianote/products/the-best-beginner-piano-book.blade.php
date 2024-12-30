@extends('pianote._partials.global-layout')

@section('global-head')
    @parent
    <title>The Best Beginner Piano Book | Pianote</title>
    <meta property="og:title" content="The Best Beginner Piano Book | Pianote">
    <meta name="description" content="The Best Beginner Piano Book is packed with useful information for your musical journey.">
    <meta property="og:description" content="The Best Beginner Piano Book is packed with useful information for your musical journey.">
    <meta property="og:image"
        content="https://d21q7xesnoiieh.cloudfront.net/fit-in/1200x0/marketing/pianote/products/pianote-practice-planner/share-image.jpg"
        style="display: none;">
    <meta property="og:url" content="https://www.pianote.com/{{ Request::path() }}">
    <script defer src="https://cdn.jsdelivr.net/npm/@alpinejs/focus@3.x.x/dist/cdn.min.js"></script>


    @include('_partials.layout._fonts')
    <link rel="stylesheet" href="{{ mix('marketing/css/app.css') }}">
    <link href="{{ asset('/marketing/css/tailwind-helpers.css') }}" rel="stylesheet">
    <link href="{{ asset('/marketing/parcel/drumeo/nav-footer-pianote.css') }}" rel="stylesheet">
    <link href="{{ asset('/marketing/parcel/drumeo/30dd.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@splidejs/splide@4.1.4/dist/css/splide.min.css">

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
        "fullPrice" => floatval($productPrices['pianote-practice-planner']->price),
        "price" => floatval($productPrices['pianote-practice-planner']->discounted_price),
        "noBreadcrumb" => true
    ])
    @php

    $discountedPrice =  $discountedPrice = number_format(floatval($productPrices['christmas-songbook']->discounted_price), 2) == intval(floatval($productPrices['christmas-songbook']->discounted_price))
        ? floatval($productPrices['christmas-songbook']->discounted_price)
        : number_format(floatval($productPrices['christmas-songbook']->discounted_price), 2);
    @endphp
    
    <header class="text-white px-5 sm:px-6 pt-96 pb-10 sm:py-20 lg:py-36 relative" style="background-color:#0f5e8a;">
        <div class="inset-0 absolute z-0 bg-top bg-cover block sm:hidden" style="background:url('https://d21q7xesnoiieh.cloudfront.net/fit-in/0x0/filters:quality(95)/marketing/pianote/products/christmas-songbook/header-m.png')"></div>
        <div class="inset-0 absolute z-0 bg-top bg-cover hidden sm:block" style="background:url('https://d21q7xesnoiieh.cloudfront.net/fit-in/0x0/filters:quality(95)/marketing/pianote/products/christmas-songbook/header.jpg')"></div>
        <div class="container max-w-4xl mx-auto relative z-10">
            <div class="flex flex-wrap sm:flex-nowrap items-center">
                <div class="w-full sm:w-5/12 text-center lg:text-left">
                    <img class="h-24 lg:h-36 lg:-ml-5 mx-0" alt="logo" fetchpriority="high"
                        src="https://d21q7xesnoiieh.cloudfront.net/fit-in/440x0/filters:quality(95)/marketing/pianote/products/christmas-songbook/christmas-songbook-logo-left.png">
                    <p class="leading-normal my-4 sm:my-6">Christmas classics to make your holiday season extra special.
                        Presented in original and simplified arrangements.
                    </p>
                    <h4 class="leading-tight mb-4 sm:mb-6">
                        @if(floatval($productPrices['christmas-songbook']->price) > $discountedPrice)
                            <strong>ONLY</strong> <s class="opacity-60">${{ floatval($productPrices['christmas-songbook']->price) }}</s>
                            <strong>${{ $discountedPrice }}</strong> (SAVE {{ round(100 - (100 * ($discountedPrice / floatval($productPrices['christmas-songbook']->price)))) }}%)
                        @else
                            <strong>ONLY ${{ $discountedPrice }}</strong>
                        @endif
{{--                        @if(!empty($membersVersion))--}}
{{--                            <br>+ a FREE digital songbook--}}
{{--                        @endif--}}
                    </h4>
                    <a href="" class="join medium w-full">GET YOUR COPY &raquo;</a>
                </div>
            </div>
        </div>
    </header>

    <section class="text-center px-5 sm:px-6 py-8 sm:py-16 lg:py-20 relative" style="background-color:#F2EFED">
        <div class="container mx-auto z-10 relative max-w-5xl">
            @php
                $item = [
                    'img' => 'https://d21q7xesnoiieh.cloudfront.net/fit-in/1500x0/filters:quality(95)/marketing/pianote/products/practice-planner/planner-piano.png',
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
                    'title' => 'The first step never felt so easy.',
                ];
            @endphp
            <h2 class="leading-tight mx-0 my-2 sm:my-4" style="font-family: 'Playfair Display', serif;">
                <strong>{!! $item['title'] !!}</strong>
            </h2>
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
    
    <section class="text-center text-white pt-10 sm:pt-14 lg:pt-20 bg-cover bg-center" style="background-color:#2a2f34; background-image:url('https://d21q7xesnoiieh.cloudfront.net/fit-in/1500x0/filters:quality(95)/marketing/pianote/lead-gen/digital-christmas-songbook/piano-bg.webp');">
        <h3 class="leading-tight"><strong>Take a look inside</strong></h3>
        <p class="leading-normal mt-1 sm:mt-2 mb-4 sm:mb-5">
            <i class="fa-light fa-arrow-turn-down fa-flip-horizontal mr-1 relative text-[#F61A30]" style="bottom:-7px"></i> 
            <em>Click to see a sample of how to use your practice planner.</em> 
            <i class="fa-light fa-arrow-turn-down ml-1 relative text-[#F61A30]" style="bottom:-7px"></i>
        </p>
        <a target="_blank" href="https://musora-image-processing-cdn.s3.us-east-2.amazonaws.com/marketing/pianote/lead-gen/digital-christmas-songbook/pianote-christmas-songbook-sample.pdf" class="relative">
            <img class="inline-block lg:hidden w-full transition-all opacity-0" src="https://d21q7xesnoiieh.cloudfront.net/fit-in/1500x0/filters:quality(95)/marketing/pianote/lead-gen/digital-christmas-songbook/piano-m.webp" alt="tablet piano" loading="lazy" onload="this.classList.remove('opacity-0')">
            <img class="hidden lg:inline-block w-full transition-all opacity-0" src="https://d21q7xesnoiieh.cloudfront.net/fit-in/2500x0/filters:quality(95)/marketing/pianote/lead-gen/digital-christmas-songbook/piano.webp" alt="tablet piano" loading="lazy" onload="this.classList.remove('opacity-0')">
        </a>
    </section>

    <section class="bg-white sm:py-20">
        <div class="py-8">
            <div class="max-w-6xl mx-auto px-4">
                <h2 class="text-center mb-2 text-2xl font-bold">
                    10 things this book will teach you.
                </h2>
                <p class="text-center mb-2 text-lg">
                    The Best Beginner Piano Book is packed with useful information for your musical journey.
                </p>
                <p class="text-center mb-6 text-lg">Here are just some of the things you'll learn:</p>

                @php
                $sections = [
                    [
                        'image' => [
                            'src' => 'https://d21q7xesnoiieh.cloudfront.net/fit-in/1500x0/filters:quality(95)/marketing/pianote/products/the-best-beginner-piano-book/book.png',
                            'alt' => 'The Best Beginner Piano Book',
                            'caption' => 'How to play songs when all you have are the lyrics<br>and chords (no sheet music).'
                        ],
                        'cards' => [
                            [
                                'icon' => 'fa-solid fa-bookmark',
                                'text' => 'The <strong>4 elements</strong> you need to consider when setting up your practice space.'
                            ],
                            [
                                'icon' => 'fa-solid fa-list',
                                'text' => '<strong>3 guidelines</strong> to follow when choosing the best piano for you (don\'t skip these).'
                            ],
                            [
                                'icon' => 'fa-solid fa-music',
                                'text' => 'How to use <strong>landmark notes</strong> to read music faster so you don\'t have to memorize every single note.'
                            ],
                            [
                                'icon' => 'fa-solid fa-list',
                                'text' => 'The <strong>important difference</strong> between a C-sharp and a D-flat (yes, there is one!).'
                            ]
                        ]
                    ],
                    [
                        'image' => [
                            'src' => 'https://d21q7xesnoiieh.cloudfront.net/fit-in/1500x0/filters:quality(95)/marketing/pianote/products/the-best-beginner-piano-book/book.png',
                            'alt' => 'Common Piano Mistakes',
                            'caption' => 'How to <strong>avoid (and overcome) these common mistakes</strong><br> beginners make that slow their progress.'
                        ],
                        'cards' => [
                            [
                                'icon' => 'fa-solid fa-magnifying-glass',
                                'text' => 'How to quickly identify and <strong>play any interval</strong> to make learning songs faster.'
                            ],
                            [
                                'icon' => 'fa-solid fa-list-check',
                                'text' => 'The 4-step "<strong>Pre-Trip Checklist</strong>" that guarantees you\'ll learn new songs faster.'
                            ],
                            [
                                'icon' => 'fa-solid fa-piano',
                                'text' => 'The relationship between <strong>major and minor</strong> scales and how to play both.'
                            ],
                            [
                                'icon' => 'fa-solid fa-question',
                                'text' => 'The difference between triads, 1st, and 2nd chord inversions (and <strong>when to use each one</strong>).'
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
                            <p class="text-white">
                                {!! $section['image']['caption'] !!}
                            </p>
                        </div>
                    </div>
                    <!-- Cards  -->
                    <div class="w-full md:w-1/2 grid sm:grid-cols-2 gap-4 order-2 md:order-{{ $index % 2 === 0 ? '2' : '1' }}">
                        @foreach ($section['cards'] as $card)
                        <div class="bg-[#F2EFED] rounded-lg p-4 shadow-md hover:shadow-lg transition-shadow duration-200">
                            <div class="icon-gradient w-8 h-8 flex items-center justify-center mb-3">
                                <i class="{{ $card['icon'] }} text-3xl"></i>
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

 <section class="relative text-center px-3 sm:px-6 pt-10 sm:pt-14 lg:pt-20" style="background:linear-gradient(to bottom, #f2efed, #FFF);">
        <div class="absolute z-10 top-0 left-0 right-0 bg-cover bg-no-repeat bg-top z-10 h-1/2 lg:h-full" style="background-image:url(https://www.musora.com/cdn-cgi/image/width=1500,quality=95/https://d2vyvo0tyx8ig5.cloudfront.net/products/classical-piano-pieces/author-bg.png);"></div>
        <div class="container max-w-5xl mx-auto relative z-20">
            <h3 class="text-center mb-24"><strong>About The Authors</strong></h3>

            <div class="flex flex-wrap sm:flex-nowrap items-start justify-center">
                <div class="w-full sm:w-1/2 px-4 mb-20 sm:mb-0">
                    <div class="relative text-left z-10 rounded-xl py-8 sm:py-12 px-6 sm:px-10 w-full shadow-md" style="background-color:#f2efed;">
                        <img class="absolute top-0 left-1/2 -translate-x-1/2 -translate-y-1/2 w-32 lg:w-36 z-20 rounded-full border-4 border-white shadow-md transition-all opacity-0" alt="profile picture" loading="lazy" onload="this.classList.remove('opacity-0')"
                            src="https://www.musora.com/cdn-cgi/image/width=550,quality=95/https://d2vyvo0tyx8ig5.cloudfront.net/products/classical-piano-pieces/lisa-profile.jpg">
                        <br>
                        <img class="h-5 mt-4 sm:mt-3 mb-3 lg:mb-4 transition-all opacity-0" alt="lisa signature" loading="lazy" onload="this.classList.remove('opacity-0')"
                            src="https://www.musora.com/cdn-cgi/image/width=550,quality=95/https://d2vyvo0tyx8ig5.cloudfront.net/products/classical-piano-pieces/Vector.svg">
                        <p class="leading-normal">
                            Lisa Witt is the lead instructor at Pianote and has inspired millions of students around the world with her infectious enthusiasm for this instrument.
                            <br><br>Lisa grew up learning classical piano through the Royal Conservatory of Music, but it wasn’t easy.
                            <br><br>“In fact, I mostly hated it,” she said.
                            <br><br>“But there were some songs that made it all worth it. The beautiful songs by the great composers.”
                            <br><br>Those songs are what drove Lisa to compile this book and share those beautiful pieces with you. She hand-picked each one to fill this book with 20 of the most beautiful classical piano pieces around.
                            <br><br>Lisa’s teaching style is all about FUN. If you’re not having fun playing the piano, then you won’t keep learning. The pieces in this book reflect that style. They are beautiful, but also fun to learn. So you’ll keep coming back to them.
                            <br><br>Lisa is also the author of “Piano Chords & Scales: The Ultimate Guide” and “The Pianote Practice Planner.”
                        </p>
                    </div>
                </div>
                <div class="w-full sm:w-1/2 px-4">
                    <div class="relative text-left z-10 rounded-xl py-8 sm:py-12 px-6 sm:px-10 w-full shadow-md" style="background-color:#f2efed;">
                        <img class="absolute top-0 left-1/2 -translate-x-1/2 -translate-y-1/2 w-32 lg:w-36 z-20 rounded-full border-4 border-white shadow-md transition-all opacity-0" alt="profile picture" loading="lazy" onload="this.classList.remove('opacity-0')"
                            src="https://www.musora.com/cdn-cgi/image/width=550,quality=95/https://d2vyvo0tyx8ig5.cloudfront.net/products/classical-piano-pieces/eleny-profile.jpg">
                        <br>
                        <img class="h-7 mt-4 sm:mt-3 mb-1.5 lg:mb-4 transition-all opacity-0" alt="lisa signature" loading="lazy" onload="this.classList.remove('opacity-0')"
                            src="https://www.musora.com/cdn-cgi/image/width=550,quality=95/https://d2vyvo0tyx8ig5.cloudfront.net/products/classical-piano-pieces/Vector-1.svg">
                        <p class="leading-normal">
                            Eleny Quapp is a skilled musician with over 20 years of experience. As a former student of the Royal Conservatory of Music, she has refined her skills at the piano and has since become an accomplished teacher, passing on her passion for music to her students.
                            <br><br>Eleny's love for music is reflected in her teaching, where she emphasizes the importance of practice and dedication, but also discovering the fun in learning. She firmly believes in the profound effects that music can have on a person's life and will always find ways to inspire those around her.
                            <br><br>With a particular affinity for classical music, Eleny enjoys sharing her passion for some of the world's most beautiful music with those around her.
                            <br><br>The Most Beautiful Piano Classical Pieces is a delightful collection of some of her favorite pieces.
                            <br><br>She has arranged all the simplified pieces to be accessible to students of all skill levels. Her arrangements reflect what she is most passionate about - sharing the joy and beauty of classical music.
                        </p>
                    </div>
                </div>
            </div>

        </div>
    </section>


    
    <section class="text-center px-5 sm:px-6 py-10 sm:py-14 lg:py-20 mb-20 sm:mb-24">
        <div class="container max-w-6xl mx-auto">
            <h3 class="leading-tight text-center mb-6 sm:mb-7"><strong>The Best Beginner<br class="inline sm:hidden"> Piano Book</strong></h3>

            @php
                $slides = [
                 [
                     'img' => 'marketing/pianote/products/classical-piano-pieces/collage-04a.jpg',
                 ],
                 [
                     'img' => 'marketing/pianote/products/classical-piano-pieces/collage-06a.jpg',
                 ],
                 [
                     'img' => 'marketing/pianote/products/classical-piano-pieces/collage-03a.jpg',
                 ],
                 [
                     'img' => 'marketing/pianote/products/classical-piano-pieces/collage-02a.jpg',
                 ],
                 [
                     'img' => 'marketing/pianote/products/classical-piano-pieces/collage-05a.jpg',
                 ],
                 [
                     'img' => 'marketing/pianote/products/classical-piano-pieces/collage-01a.jpg',
                 ],

             ];

             $scaleAnimation = 'cursor-pointer transform transition duration-500 ease-in-out hover:scale-105';
             $handleClick = 'handleClick';
            @endphp

            @component('drumeo._partials.modal-carousel', ['slides' => $slides, 'scaleAnimation' => $scaleAnimation, 'handleClick' => $handleClick])
                <div class="flex flex-wrap items-center">
                    <div class="w-1/2 md:w-1/4">
                        <div class="p-3 w-full">
                            <div @click="handleClick(1)"
                                class="h-36 sm:h-40 lg:h-48 w-full bg-center bg-cover rounded-xl cursor-pointer hover:opacity-90 {{ $scaleAnimation }}"
                                style="background-image:url('https://d21q7xesnoiieh.cloudfront.net/fit-in/480x0/filters:quality(95)/{{ $slides[1]['img'] }}')">
                            </div>
                        </div>
                        <div class="p-3 w-full">
                            <div @click="handleClick(3)"
                                class="h-36 sm:h-36 lg:h-44 w-full bg-center bg-cover rounded-xl cursor-pointer hover:opacity-90 {{ $scaleAnimation }}"
                                style="background-image:url('https://d21q7xesnoiieh.cloudfront.net/fit-in/480x0/filters:quality(95)/{{ $slides[3]['img'] }}')">
                            </div>
                        </div>
                    </div>
                    <div class="w-1/2 md:w-1/4">
                        <div class="p-3 w-full">
                            <div @click="handleClick(2)"
                                class="h-72 sm:h-80 lg:h-96 w-full bg-center bg-cover rounded-xl cursor-pointer hover:opacity-90 {{ $scaleAnimation }}"
                                style="background-image:url('https://d21q7xesnoiieh.cloudfront.net/fit-in/1000x0/filters:quality(95)/{{ $slides[2]['img'] }}')">
                            </div>
                        </div>
                    </div>
                    <div class="w-1/2 md:w-1/4">
                        <div class="p-3 w-full">
                            <div @click="handleClick(0)"
                                class="h-72 sm:h-80 lg:h-96 w-full bg-center bg-cover rounded-xl cursor-pointer hover:opacity-90 {{ $scaleAnimation }}"
                                style="background-image:url('https://d21q7xesnoiieh.cloudfront.net/fit-in/1000x0/filters:quality(95)/{{ $slides[0]['img'] }}')">
                            </div>
                        </div>
                    </div>
                    <div class="w-1/2 md:w-1/4">
                        <div class="p-3 w-full">
                            <div @click="handleClick(5)"
                                class="h-36 sm:h-36 lg:h-44 w-full bg-center bg-cover rounded-xl cursor-pointer hover:opacity-90 {{ $scaleAnimation }}"
                                style="background-image:url('https://d21q7xesnoiieh.cloudfront.net/fit-in/480x0/filters:quality(95)/{{ $slides[5]['img'] }}')">
                            </div>
                        </div>
                        <div class="p-3 w-full">
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
            'badge' => 'SAVE 20%',
            'color' => 'black',
            'title' => 'Book Only',
            'originalPrice' => 49,
            'currentPrice' => 39,
            'discount' => '20%',
            'link' => '/',
            'imageSrc' => 'https://d21q7xesnoiieh.cloudfront.net/fit-in/800x0/filters:quality(95)/marketing/pianote/products/book-bag/order-bag-01.webp',
            'buttonText' => 'GET YOUR COPY',
            'buttonClass' => 'bg-slate-900',
            'subtext' => 'One-time payment',
                'features' => [
                    '<i class="fa fa-check text-pianote"></i> 194 Pages',
                    '<i class="fa fa-check text-pianote"></i> Full-color diagrams and explanations',
                    '<i class="fa fa-check text-pianote"></i> Simple language with examples',
                    '<i class="fa fa-check text-pianote"></i> Free Shipping in the US & Canada'
                ]
        ],
        [
            'badge' => 'BEST DEAL',
            'color' => 'pianote',
            'title' => "New Year's Bundle",
            'originalPrice' => 88,
            'currentPrice' => 49,
            'discount' => '45%',
            'link' => '/',
            'imageSrc' => 'https://d21q7xesnoiieh.cloudfront.net/fit-in/800x0/filters:quality(95)/marketing/pianote/products/book-bag/order-bag-01.webp',
            'buttonText' => 'GET YOUR BOOKS',
            'buttonClass' => 'bg-red-500',
            'subtext' => 'Add the NEW Pianote Practice Planner for just $10',
                'features' => [
                    '<i class="fa fa-check text-pianote"></i> Best Beginner Piano Book',
                    '<i class="fa fa-check text-pianote"></i> <strong>NEW</strong> Pianote Practice Planner ($39 value)',
                    '<i class="fa fa-check text-pianote"></i> Free Shipping in the US & Canada'
                ]
        ]
    ];
    @endphp

    <section class="text-center px-4 py-10 sm:px-6 sm:pt-14 lg:pt-20 bg-[#F2EFED]">
        <div class="container mx-auto max-w-5xl">
            <img class="hidden sm:inline-block h-20 lg:h-28" src="/" alt="Logo" />
            
            <p class="text-lg leading-tight mt-4 mb-3 sm:mb-5 lg:mb-10">
                Stay on track and see better results from your practice sessions.<br>
                Make every practice perfect.
            </p>

            <div class="flex flex-wrap lg:flex-nowrap items-start justify-center w-full mb-5 sm:mb-10 mx-auto lg:space-x-8">
                @foreach($offers as $offer)
                    <div class="w-full md:w-1/2 lg:w-full max-w-sm lg:px-1 px-1 relative border-2 border-{{ $offer['color'] }} rounded-2xl shadow-md mb-4 lg:mb-0 bg-white">
                        @if($offer['badge'])
                            <p class="absolute top-0 left-1/2 transform -translate-x-1/2 -translate-y-1/2 mb-1 px-5 py-1 z-10 leading-tight text-sm rounded-full tracking-widest text-white bg-{{$offer['color']}}">
                                {{ $offer['badge'] }}
                            </p>
                        @endif

                        <div class="text-black overflow-hidden rounded-2xl block mx-auto mb-4 lg:mb-0 group border-2 border-white">
                            <div class="bg-white px-3 py-6 md:py-7">
                                <h3 class="leading-tight mb-2"><strong>{{ $offer['title'] }}</strong></h3>
                                
                                <img class="w-48 mx-auto rounded-md transition-opacity opacity-0"
                                    src="{{ $offer['imageSrc'] }}"
                                    loading="lazy"
                                    onload="this.classList.remove('opacity-0')"
                                    alt="{{ $offer['title'] }}"
                                >

                                <h3 class="leading-tight mt-2">
                                    <span class="line-through text-gray-400 mr-2">${{ $offer['originalPrice'] }}</span>
                                    <strong>${{ $offer['currentPrice'] }}</strong>
                                    <span class="text-red-500 ml-1 text-sm">(Save {{ $offer['discount'] }})</span>
                                </h3>

                                <p class="text-sm mb-5"><em>{{ $offer['subtext'] }}</em></p>

                                <button class="w-full transition-opacity join text-xl md:text-2xl max-w-[300px] py-3 px-6 rounded-full text-white bg-{{ $offer['color'] }}" href="{{ $offer['link'] }}">
                                    {{ $offer['buttonText'] }}
                                </button>
                            </div>

                            <div class="px-4 sm:px-4 lg:px-6 py-7">
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

    <section class="text-center py-10 text-[#505050]" style="background: #F2EFED;">
        <div class="container mx-auto relative z-50">
            <div class="inline-block w-full px-3 md:px-4 mb-5">
                <p>Call us toll-free at
                    <a href="tel:+18004398921">1-800-439-8921</a> <br class="inline-block md:hidden"> or directly at
                    <a href="tel:+16048557605">1-604-855-7605</a>.<br> All prices listed in USD. </p>
            </div>
            <div class="inline-block w-full px-3 md:px-4" style="margin-top: 0;">
                <i class="mx-0.5 text-3xl md:text-4xl fab fa-cc-visa"></i>
                <i class="mx-0.5 text-3xl md:text-4xl fab fa-cc-mastercard"></i>
                <i class="mx-0.5 text-3xl md:text-4xl fab fa-cc-amex"></i>
                <i class="mx-0.5 text-3xl md:text-4xl fab fa-cc-paypal"></i>
                <i class="mx-0.5 text-3xl md:text-4xl fab fa-cc-discover"></i>
            </div>
        </div>
    </section>


    @include('pianote.sales.partials._footer')

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script type="text/javascript" src="{{ asset('/marketing/parcel/drumeo/navigation-sales.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/@splidejs/splide@4.1.4/dist/js/splide.min.js"></script>

@stop