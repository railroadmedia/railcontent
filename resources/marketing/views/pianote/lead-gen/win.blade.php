@extends('pianote._partials.global-layout')

@section('global-head')
    <title>Pianote Prima Digital Pianos | Pianote</title>
    <meta property="og:title" content="Pianote Prima Digital Pianos | Pianote">

    <meta name="description" content="Win a digital piano, headphones, a metronome, BookBag, or piano lessons for life with Pianote.">
    <meta property="og:description" content="Win a digital piano, headphones, a metronome, BookBag, or piano lessons for life with Pianote.">

    <meta property="og:image" content="https://d21q7xesnoiieh.cloudfront.net/fit-in/1200x0/filters:quality(95)//marketing/pianote/lead-gen/win/share-image.jpg" style="display: none;">
    <meta property="og:url" content="https://www.pianote.com/{{ Request::path() }}">

    @include('_partials.layout._tailwindcdn')
    <link href="{{ asset('/marketing/css/tailwind-helpers.css') }}" rel="stylesheet">
    <link href="{{ asset('/marketing/parcel/drumeo/lead-gen-learn-songs.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('/marketing/parcel/drumeo/sales-pianote.css') }}">
    <link rel="stylesheet" href="{{ asset('/marketing/parcel/drumeo/nav-footer-pianote.css') }}">
       <style>
        .header-custom {
            background-image: url('https://d21q7xesnoiieh.cloudfront.net/fit-in/800x0/filters:quality(95)/marketing/pianote/lead-gen/win/bottom-bg-m.webp');
            background-size: cover;
        }
    
        @media (min-width: 768px) {
            .header-custom {
                background-image: url('https://d21q7xesnoiieh.cloudfront.net/fit-in/3000x0/filters:quality(95)/marketing/pianote/lead-gen/win/bottom-bg.webp');
            }
        }
    
        .ajax-form input, .ajax-form button {
            height: 50px;
            font-size: 1.25rem;
        }
    
        .decoration-red-500 {
            text-decoration-color: #f56565;
            text-decoration-thickness: 1px;
        }
    
        @media (min-width: 1024px) {
            .lg\:grid-template-columns-custom {
                grid-template-columns: 1.5fr 1fr 1fr 1fr;
            }
        }
    </style>
@endsection

@section('global-body')
    @include('pianote.sales.partials._nav')

    <header class="header-custom px-5 sm:px-6 py-10 lg:py-20 bg-no-repeat text-white bg-cover bg-center" style="background-color: #00101D;">
        <div class="container mx-auto max-w-4xl text-center">
            <div class="flex items-center justify-center">
                <div class="mx-auto sm:mx-0 text-center">
                    <img src="https://d21q7xesnoiieh.cloudfront.net/fit-in/1000x0/filters:quality(95)/marketing/pianote/lead-gen/win/border.svg" class="h-6 sm:h-7 md:h-10" alt="Win text">
                   <h1 class="flex items-center justify-center gap-x-1 py-2">
                        <strong class="flex flex-wrap items-center justify-center gap-x-1">
                            <span class="dev:border dev:border-red-500">Pianote</span>
                            <img 
                                src="https://d21q7xesnoiieh.cloudfront.net/fit-in/600x0/filters:quality(95)/marketing/pianote/lead-gen/win/prima.svg" 
                                alt="Prima Digital Piano" 
                                class="h-8 md:h-10 lg:h-14 w-auto object-contain -mb-2 px-2"
                            />
                            <br class="inline sm:hidden"/>
                            <span>Digital Pianos</span>
                        </strong>
                    </h1>
                    <h3 class="pt-2"><strong>Plus $3432 in additional prizes</strong></h3>
                    <p class="py-6 lg:py-10 leading-normal opacity-75">
                        Win a digital piano, headphones, a metronome, BookBag, or 
                        <br class="hidden sm:inline"/> piano lessons for life with Pianote.
                    </p>
                    <h6 class="mb-8"><strong>Entry is FREE.</strong></h6>
                    {{-- @if(Carbon\Carbon::now() < Carbon\Carbon::create(2024, 10, 4, 0, 0, 0, 'America/Vancouver')) --}}
                    {{-- <span class="join sold-out smaller w-full">Opens Oct. 4th</span> --}}
                    <div class="container mx-auto max-w-lg text-center">
                        @if(Carbon\Carbon::now() < Carbon\Carbon::create(2024, 11, 24, 8, 0, 0, 'America/Vancouver'))
                            @include('pianote._partials.sign-up-form', [
                                "recaptchaKey" => $recaptchaKey,
                                "stacked" => true,
                                "minimalForm" => true,
                                "nameInput" => true,
                                "formId" => "Pianote - Engagement - Trigger - Prima Giveaway - Web Form",
                                "formName" => 'Prima Giveaway',
                                "buttonText" => "ENTER GIVEAWAY",
                            ])
                        @else
                            <span class="join sold-out smaller w-full">This offer has now ended</span>
                        @endif
                    </div>
                </div>
            </div>
            <h6 class="anchor-slide cursor-pointer pt-10 underline font-bold" href="#customize-anchor">View Prizes</h6>
        </div>
    </header>

    <section class="px-4 md:px-6 py-12 md:py-20">
        <div class="max-w-md md:max-w-4xl mx-auto">
            <div class="md:flex md:flex-wrap">
                <div class="w-full mb-4 md:mb-8 text-center">
                    <h2 class="font-extrabold leading-normal mb-2">
                        <span class="underline decoration-red-500 decoration-1">Everything</span> you need to start playing piano
                    </h2>
                    <h6 class="leading-tight lg:mb-6"><strong><em>
                        Introducing the Pianote Prima -- the BEST beginner digital piano.</em></strong></h6>
                </div>
                <div class="md:w-7/12">
                    <img class="md:hidden rounded-xl mb-6 w-full h-full object-cover opacity-0" onload="this.classList.remove('opacity-0')" loading="lazy" src="https://d21q7xesnoiieh.cloudfront.net/fit-in/600x0/filters:quality(95)/marketing/pianote/lead-gen/win/collage-m.webp" alt="intro image">
                    <p class="pb-4 lg:pr-6">
                        <strong>It’s the most common question beginners have…</strong>
                        <br><br>
                        What piano should I buy?
                        <br><br>
                        We heard it so often, that we decided to create the answer:
                        <br><br>
                        <strong>The Pianote Prima.</strong>
                        <br><br>
                        The 88-key hammer action digital piano is packed with all the features a beginner needs, and none of the extra stuff they don’t.
                        <br><br>
                        And to celebrate the launch of the Pianote Prima, we’re GIVING 5 OF THEM AWAY!
                        <br><br>
                        Just enter your name and email address and you’ll be in the running to win.
                    </p>
                    <p class="bg-musora py-4 px-4 rounded-xl tracking-tight text-center">Winners will be announced during a <br class="inline md:hidden"/> livestream on <strong>November 25th!</strong></p>
                </div>
                <div class="md:w-5/12 justify-center pl-8 md:pl-16">
                    <img class="rounded-xl hidden md:inline-block w-full h-full object-cover opacity-0" onload="this.classList.remove('opacity-0')" src="https://d21q7xesnoiieh.cloudfront.net/fit-in/450x0/filters:quality(95)/marketing/pianote/lead-gen/win/collage.webp" alt="intro image" loading="lazy">
                </div>
            </div>
        </div>
    </section>
    
    <section class="py-12 sm:py-20 px-4 md:px-6" style="background:#F1EFED;">
        <div class="md:max-w-5xl mx-auto text-center lg:px-10">
            <h2 class="uppercase leading-normal mb-4 lg:mb-8">
                <strong>win one of <br/>these <span class="underline decoration-red-500 decoration-1">incredible prizes</span></strong>
            </h2>
            @php
                $products = [
                    [
                        'title' => 'One of 5 Pianote Prima Digital Pianos',
                        'image' => 'https://d21q7xesnoiieh.cloudfront.net/fit-in/1800x0/filters:quality(95)/marketing/pianote/lead-gen/win/prize-01.webp',
                        'price' => '839 Value Each',
                        'total_value' => '($4195 Total Value)',
                        'use_alternate_tags' => true,
                        'features' => [
                            '1-Year Pianote Membership',
                            'Stereo Speakers',
                            'Bluetooth Connectivity',
                            'Music Stand Included',
                            '88-key Progressive Lever Hammer Action',
                            'Double Headphone Jack',
                            'True Piano Sustain Pedal',
                            'USB MIDI and Audio In/Out'
                        ]
                    ],
                    [
                        'title' => 'One Lifetime Pianote Membership',
                        'image' => 'https://d21q7xesnoiieh.cloudfront.net/fit-in/1500x0/filters:quality(95)/marketing/pianote/lead-gen/win/prize-02.webp',
                        'price' => '1200 Value',
                        'total_value' => '',
                        'use_alternate_tags' => true,
                        'features' => [
                            'Unlimited Step-by-Step Lessons',
                            'Weekly Live Lessons',
                            'Huge Song Library',
                            'World-Class Instructors',
                            'Personalized Feedback',
                            'Lifetime Access'
                        ]
                    ],
                    [
                        'title' => 'One of 5 Annual Pianote Memberships',
                        'image' => 'https://d21q7xesnoiieh.cloudfront.net/fit-in/1200x0/filters:quality(95)/marketing/pianote/lead-gen/win/prize-3.webp',
                        'price' => '240 Value Each',
                        'total_value' => '($1200 Total Value)',
                        'features' => [
                            'Unlimited Step-by-Step Lessons',
                            'Weekly Live Lessons',
                            'Huge Song Library',
                            'World-Class Instructors',
                            'Personalized Feedback'
                        ]
                    ],
                    [
                        'title' => 'One of 2 Pianote BookBags',
                        'image' => 'https://d21q7xesnoiieh.cloudfront.net/fit-in/800x0/filters:quality(95)/marketing/pianote/lead-gen/win/prize-06.webp',
                        'price' => '249 Value Each',
                        'total_value' => '($498 Total Value)',
                        'features' => [
                            'Organize Your Piano Books',
                            'Handcrafted Premium Leather',
                            '16" Laptop Sleeve'
                        ]
                    ],
                    [
                        'title' => 'One of 3 Pianote Headphones',
                        'image' => 'https://d21q7xesnoiieh.cloudfront.net/fit-in/800x0/filters:quality(95)/marketing/pianote/lead-gen/win/prize-04.webp',
                        'price' => '99 Value Each',
                        'total_value' => '($297 Total Value)',
                        'features' => [
                            '45mm Driver',
                            'Closed-Back Design',
                            '1.8m Cable',
                            '6.3mm stereo adapter'
                        ]
                    ],
                    [
                        'title' => 'One of 3 Pianote Metronomes',
                        'image' => 'https://d21q7xesnoiieh.cloudfront.net/fit-in/1000x0/filters:quality(95)/marketing/pianote/lead-gen/win/prize-05.webp',
                        'price' => '99 Value Each',
                        'total_value' => '($297 Total Value)',
                        'features' => [
                            'Made in Germany by Wittner',
                            'Hand-wound & Battery-Free',
                            '40-208bpm Tempo Range',
                            'Lightweight & Compact'
                        ]
                    ]
                ];
            @endphp
    
            <div class="container mx-auto pb-6 lg:pb-10 text-left">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-x-6 gap-y-6 md:gap-y-10 lg:gap-y-20 lg:gap-x-6">
                    @foreach($products as $index => $product)
                        <div class="{{ $index < 2 ? 'col-span-1 md:col-span-2' : '' }}">
                            <div class="">
                                <div class="relative bg-white rounded-lg p-2">
                                    <img 
                                        src="{{ $product['image'] }}" 
                                        alt="{{ $product['title'] }}" 
                                        class="w-full h-full object-cover rounded-lg opacity-0 transition-opacity duration-500" 
                                        loading="lazy" 
                                        onload="this.classList.remove('opacity-0')"
                                    >
                                </div>
                                <div class="mt-4 lg:mt-6">
                                    @if(isset($product['use_alternate_tags']) && $product['use_alternate_tags'])
                                        <h4 class="text-base lg:text-2xl text-left"><strong>{{ $product['title'] }}</strong></h4>
                                        <div class="my-2 flex items-center space-x-2 text-left">
                                            <p class="text-white rounded-md bg-black px-2 py-1 m-0"><strong>${{ $product['price'] }}</strong></p>
                                            <p>{{ $product['total_value'] }}</p>
                                        </div>
                                    @else
                                        <h5 class="text-base lg:text-xl text-left"><strong>{{ $product['title'] }}</strong></h5>
                                        <div class="my-2 flex items-center space-x-2 text-left">
                                            <p class="text-white rounded-md bg-black px-2 py-1 m-0"><strong>${{ $product['price'] }}</strong></p>
                                            <p>{{ $product['total_value'] }}</p>
                                        </div>
                                    @endif
                                    @if($index == 0)
                                        <ul class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-2 lg:grid-template-columns-custom">
                                            @foreach($product['features'] as $feature)
                                                <li class="text-xs md:text-sm leading-loose m-0">
                                                    <i class="fas fa-check text-red-500 mr-1"></i>
                                                    <span>{{ $feature }}</span>
                                                </li>
                                            @endforeach
                                        </ul>
                                    @elseif($index == 1)
                                        <ul class="grid grid-cols-1 md:grid-cols-3 gap-2">
                                            @foreach($product['features'] as $feature)
                                                <li class="text-xs md:text-sm leading-loose m-0">
                                                    <i class="fas fa-check text-red-500 mr-1"></i>
                                                    <span>{{ $feature }}</span>
                                                </li>
                                            @endforeach
                                        </ul>
                                    @else
                                        <ul class="grid grid-cols-1 md:grid-row-2 lg:flex lg:flex-wrap lg:flex-row">                                           
                                             @foreach($product['features'] as $feature)
                                                <li class="text-xs sm:pr-2 leading-loose tracking-tight m-0 lg:pr-3">
                                                    <i class="fas fa-check text-red-500 mr-1"></i>
                                                    <span>{{ $feature }}</span>
                                                </li>
                                            @endforeach
                                        </ul>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
            <a class="anchor-slide join smaller w-11/12 md:w-1/2 lg:w-1/3 bg-pianote" href="#customize-anchor">ENTER NOW</a>
        </div>
    </section>

    @php
        $testimonials = [
            [
                'name' => 'Winner name',
                'location' => 'Location',
                'profileImage' => 'https://d21q7xesnoiieh.cloudfront.net/fit-in/600x0/filters:quality(95)/marketing/pianote/products/headphones/avatar-1.svg',  
                'text' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed ut purus eget sapien. Nullam nec purus nec purus.'
            ],
            [
                'name' => 'Winner name',
                'location' => 'Location',
                'profileImage' => 'https://d21q7xesnoiieh.cloudfront.net/fit-in/600x0/filters:quality(95)/marketing/pianote/products/headphones/avatar-1.svg',  
                'text' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed ut purus eget sapien. Nullam nec purus nec purus.'
            ]
        ];
    @endphp

    <section class="text-center px-4 sm:px-6 py-10 sm:py-14 lg:py-20" style="background: #FFF;">
        <div class="container max-w-4xl mx-auto pb-16">
            <h2 class="text-center leading-none pb-4"><strong>Yeah, it’s legit.</strong></h2>
            <h6 class="mb-24">This isn’t our first rodeo. Hear from previous winners of our piano giveaways!</h6>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-y-16 md:gap-10">
                @foreach ($testimonials as $testimonial)
                    <div class="relative text-center z-10 rounded-md pt-12 pb-10 px-10 shadow-md" style="background-color:#F1EFED;">
                        <div class="absolute top-0 left-1/2 w-24 h-24 mx-auto mb-4">
                            <div class="transform -translate-x-1/2 -translate-y-1/2 w-full h-full rounded-full overflow-hidden">
                                <img class="w-full h-full object-cover rounded-full transition-all opacity-0" alt="{{ $testimonial['name'] }} profile picture" loading="lazy" onload="this.classList.remove('opacity-0')"
                                    src="{{ $testimonial['profileImage'] }}">
                            </div>
                        </div>
                        <br>
                        <h6 class="pb-1 font-black">{{ $testimonial['name'] }}</h6>
                        <p class="italic">{{ $testimonial['location'] }}</p>
                        <p class="text-sm lg:text-base mt-4">
                            "{!! $testimonial['text'] !!}"
                        </p>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <div class="relative h-5 sm:h-10 -mb-5 sm:-mb-10" style="background: linear-gradient(to top left, transparent calc(50% - 1px), transparent, #FFFFFF calc(50% + 1px));"></div>
    <section class="pb-20 px-5 md:px-6" style="background:linear-gradient(180deg, #F61A30 0%, #590C13 100%);">
        <div class="max-w-md md:max-w-3xl mx-auto text-center">
            <svg class="inline-block h-28 relative z-10 mb-5 sm:mb-12" xmlns="http://www.w3.org/2000/svg" width="150" height="150" viewBox="0 0 150 150" fill="none">
                <path d="M41.1853 6.17994C45.1417 2.22302 50.5047 0 56.1023 0H93.9075C99.5051 0 104.868 2.22302 108.824 6.17994L143.816 41.1862C147.773 45.1425 150 50.5055 150 56.103V93.908C150 99.5055 147.773 104.868 143.816 108.825L108.824 143.816C104.868 147.773 99.5051 150 93.9075 150H56.1023C50.5047 150 45.1417 147.773 41.1853 143.816L6.17879 108.825C2.22301 104.868 0 99.5055 0 93.908V56.103C0 50.5055 2.22301 45.1425 6.17879 41.1862L41.1853 6.17994ZM67.9714 44.2633V77.0862C67.9714 81.2477 71.1071 84.1197 75.0049 84.1197C78.9026 84.1197 82.0384 81.2477 82.0384 77.0862V44.2633C82.0384 40.6294 78.9026 37.2298 75.0049 37.2298C71.1071 37.2298 67.9714 40.6294 67.9714 44.2633ZM75.0049 93.4977C69.8177 93.4977 65.6268 97.9522 65.6268 102.876C65.6268 108.327 69.8177 112.254 75.0049 112.254C80.1921 112.254 84.383 108.327 84.383 102.876C84.383 97.9522 80.1921 93.4977 75.0049 93.4977Z" fill="#FFAE00"/>
            </svg>
            <h3 class="text-white font-extrabold leading-normal">
                We don’t believe in fine print, so here’s <br class="hidden sm:inline">everything you need to know:
            </h3>
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 justify-center text-left my-8 md:my-12 text-white">
                <div class="flex">
                    <i class="fas fa-check pt-1 mr-2 text-musora"></i>
                   Enter your name and email address.
                </div>
                <div class="flex">
                    <i class="fas fa-check pt-1 mr-2 text-musora"></i>
                    No purchase necessary.
                </div>
                <div class="flex">
                    <i class="fas fa-check pt-1 mr-2 text-musora"></i>
                   One entry per person.
                </div>
                <div class="flex">
                    <i class="fas fa-check pt-1 mr-2 text-musora"></i>
                    No age restrictions.
                </div>
            </div>
            <div class="inline-block italic text-black py-4 px-6 bg-musora">
                Winners will be announced during a livestream <strong>on November 25th</strong>!
            </div>
        </div>
    </section>

    <div id="customize-anchor" class="anchor"></div>
    <section class="header-custom px-5 sm:px-6 py-10 md:py-20 bg-no-repeat text-white bg-cover bg-center" style="background-color: #00101D;">
         <div class="container mx-auto max-w-4xl text-center">
            <div class="flex items-center justify-center">
                <div class="mx-auto sm:mx-0 text-center">
                    <img src="https://d21q7xesnoiieh.cloudfront.net/fit-in/1000x0/filters:quality(95)/marketing/pianote/lead-gen/win/border.svg" class="h-6 md:h-10" alt="Win text">
                   <h1 class="flex items-center justify-center gap-x-1 py-2">
                        <strong class="flex flex-wrap items-center justify-center gap-x-1">
                            <span class="dev:border dev:border-red-500">Pianote</span>
                            <img 
                                src="https://d21q7xesnoiieh.cloudfront.net/fit-in/600x0/filters:quality(95)/marketing/pianote/lead-gen/win/prima.svg" 
                                alt="Prima Digital Piano" 
                                class="h-8 md:h-10 lg:h-14 w-auto object-contain -mb-2 px-2"
                            />
                            <br class="inline sm:hidden"/>
                            <span>Digital Pianos</span>
                        </strong>
                    </h1>
                   <h3><strong>Plus $3432 in additional prizes</strong></h3>
                    <p class="py-6 lg:py-10 leading-normal opacity-75">
                        Win a digital piano, headphones, a metronome, BookBag, or 
                        <br class="hidden sm:inline"/> piano lessons for life with Pianote.
                    </p>
                    <h6 class="mb-8"><strong>Entry is FREE.</strong></h6>
                    {{-- @if(Carbon\Carbon::now() < Carbon\Carbon::create(2024, 10, 4, 0, 0, 0, 'America/Vancouver')) --}}
                    {{-- <span class="join sold-out smaller w-full">Opens Oct. 4th</span> --}}
                    <div class="container mx-auto max-w-lg text-center">
                        @if(Carbon\Carbon::now() < Carbon\Carbon::create(2024, 11, 24, 8, 0, 0, 'America/Vancouver'))
                            @include('pianote._partials.sign-up-form', [
                                "recaptchaKey" => $recaptchaKey,
                                "stacked" => true,
                                "minimalForm" => true,
                                "nameInput" => true,
                                "formId" => "Pianote - Engagement - Trigger - Prima Giveaway - Web Form2",
                                "formName" => 'Prima Giveaway',
                                "buttonText" => "ENTER GIVEAWAY",
                            ])
                        @else
                            <span class="join sold-out smaller w-full">This offer has now ended</span>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>

    @include("pianote.sales.partials._footer", [
            "minimal" => true
        ])

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script type="text/javascript" src="{{ asset('/marketing/parcel/drumeo/navigation-sales.js') }}"></script>
@endsection

