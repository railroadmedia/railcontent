@extends('musora._partials.layout')

@section('head-includes')
    <title>Musora | Free Music Lessons For Life</title>
    <meta property="og:title" content="Musora | Free Music Lessons For Life">

    <meta name="description" content="Do you want to improve your instrument but don’t know where to start? Enter to win free music lessons for life!">
    <meta property="og:description" content="Do you want to improve your instrument but don’t know where to start? Enter to win free music lessons for life!">

    <meta property="og:url" content="https://www.musora.com/{{ Request::path() }}">
    <meta property="og:image" content="https://d21q7xesnoiieh.cloudfront.net/fit-in/1200x0/filters:quality(95)/marketing/musora/membership/homepage/2023/share-image3.jpg">

    <style>
        h5 {
            font-size:15px
        }

        @media (min-width:768px) {
            h5 {
                font-size:18px
            }
        }

        @media (min-width:1024px) {
            h5 {
                font-size:20px
            }
        }
        .thank-you-box.active {
            max-height:1000px;
            visibility:visible;
            opacity:1;
            padding:10px;
        }
        @media (min-width: 40em) {
            .thank-you-box.active {
                padding: 12px;
            }
        }
    </style>
    <style>
        .header-image {
            background-image: url('https://d21q7xesnoiieh.cloudfront.net/fit-in/800x0/filters:quality(95)/marketing/musora/lead-gen/free-music-lessons-for-life/free-lessons-mobile-bg.jpg');
        }
        @media (min-width: 640px) {
            .header-image {
                background-image: url('https://d21q7xesnoiieh.cloudfront.net/fit-in/1800x0/filters:quality(95)/marketing/musora/lead-gen/free-music-lessons-for-life/free-lessons-header.png');
            }
        }
    </style>
@endsection


<!-- Main -->
@section('layout-body')

  <header class="header-image px-5 sm:px-6 py-8 sm:py-16 bg-no-repeat text-white bg-cover bg-center" style="background-color:#00101D;">
        <div class="container mx-auto max-w-4xl">
            <div class="flex flex-wrap sm:flex-nowrap">
                <div class="text-center md:text-left sm:px-4 sm:px-0 w-full mx-auto md:mx-0 md:w-7/12">
                    <div class="sm:pl-3">
                        <h2 class="leading-none pb-80 sm:pb-0 tracking-tighter lg:tracking-tight"> <strong>Enter For A Chance To Win <br> Music Lessons For Life </strong></h2>
                        <p class="py-2 md:py-4 tracking-tight">
                           Do you want to improve your instrument but <br class="block lg:hidden"> don’t know <br class="hidden lg:block"> where to start? Enter to win free music lessons for life!
                        </p>
                        <p class="mt-3 mb-3 text-sm leading-wide">
                            <i class="fas fa-check-circle text-musora pb-3"></i> No purchase or payment info necessary<br>
                            <i class="fas fa-check-circle text-musora pb-3"></i> On-demand courses <br class="lg:hidden">
                            <i class="fas fa-check-circle text-musora pb-3"></i> $1200 Value
                        </p>
                    </div>
                    <div class="w-full sm:w-2/3 md:w-full mx-auto leading-relaxed">
                        @include("_partials.components.forms.sign-up-form-options", [
                            "recaptchaKey" => $recaptchaKey,
                            "formName" => 'Free Music Lessons For Life',
                            "formId" => "Musora - Engagement - Trigger - Free Music Lessons For Life - WebForm", 
                            "buttonText" => "ENTER NOW",
                            "nameInput" => "Your Name",
                            "stacked" => true,
                            "minimalForm" => true,
                            "buttonColor" => "bg-musora text-black",
                            "redirectURL" => "/thank-you",
                            "checkboxItems" => [
                                'Drums' => 'drums',
                                'Piano' => 'piano',
                                'Guitar' => 'guitar',
                                'Vocals' => 'vocals'
                            ]
                        ])
                    </div>
                    
                </div>
            </div>
        </div>
    </header>

    <section class="text-center px-5 sm:px-6 py-8 sm:py-16 lg:py-20 relative" style="background-color:#ededed">
        <div class="container mx-auto z-10 relative max-w-4xl">
            <h2 class="leading-tight font-playfair mb-3"><strong>What it includes:</strong></h2>

            @php
                $items = [
                    [
                        'img' => 'https://d21q7xesnoiieh.cloudfront.net/fit-in/1500x0/filters:quality(95)/marketing/musora/lead-gen/free-music-lessons-for-life/coaches-3.webp',
                        'desc' => '<strong>All-access pass to lessons for the Guitar, Drums, Piano, & Singing </strong>',
                        'sub'=> 'Get complete access to lessons across every instrument on our platform.'
                    ],
                    [
                        'img' => 'https://d21q7xesnoiieh.cloudfront.net/fit-in/1500x0/filters:quality(95)/marketing/musora/lead-gen/free-music-lessons-for-life/workouts.webp',
                        'desc' => '<strong>Step-by-step courses taught by the best teachers</strong>',
                        'sub'=> 'Boost any skill anytime with topic-based courses for any musical goal, or follow our 10-level curriculum to learn all the foundational skills in the right order.'
                    ],
                    [
                        'img' => 'https://d21q7xesnoiieh.cloudfront.net/fit-in/1500x0/filters:quality(95)/marketing/musora/lead-gen/free-music-lessons-for-life/10-level-curriculum-new.jpg',
                        'desc' => '<strong>Play-along workouts that make practicing easy </strong>',
                        'sub'=> 'You can skip the boring and lonesome practice with our challenges and workouts. Simply choose what you want to learn and follow along with your instructor in real-time.'
                    ],
                    [
                        'img' => 'https://d21q7xesnoiieh.cloudfront.net/fit-in/1500x0/filters:quality(95)/marketing/musora/lead-gen/free-music-lessons-for-life/practice-work-2.webp',
                        'desc' => '<strong>Handy Practice Tools & Transcribed Music So That You Can Learn Your Favorite Songs</strong>',
                        'sub'=> 'Gain access to thousands of songs professionally transcribed note for note. Use tools like speed control, looping, and more to get the tricky parts.'
                    ]
                ];
            @endphp

            @foreach ($items as $index => $item)
                <img class="my-4 w-full rounded-xl overflow-hidden inline sm:hidden transition-opacity opacity-0"
                    loading="lazy"
                    onload="this.classList.remove('opacity-0')"
                    src="{{ $item['img'] }}"
                    alt="{{ $item['desc'] }}">
                <div class="text-left flex flex-wrap sm:flex-nowrap justify-center items-center sm:py-10">
                    @if ($index % 2 == 0)
                        <img class="flex-shrink-0 w-full sm:w-6/12 rounded-xl overflow-hidden hidden sm:inline-block transition-opacity opacity-0"
                            loading="lazy"
                            onload="this.classList.remove('opacity-0')"
                            src="{{ $item['img'] }}"
                            alt="{{ $item['desc'] }}"
                        >
                        <div class="flex-grow-0 leading-normal max-w-xl sm:pl-5 lg:pl-10 mx-0">
                            <h5>{!! $item['desc'] !!}</h5>
                            <p>{{ $item['sub'] }}</p>
                        </div>
                    @else
                        <div class="flex-grow-0 leading-normal max-w-xl sm:pl-5 lg:pl-10 mx-0">
                            <h5 class="pr-5">{!! $item['desc'] !!}</h5>
                            <p class="pr-4">{{ $item['sub'] }}</p>
                        </div>
                        <img class="flex-shrink-0 w-full sm:w-6/12 rounded-xl overflow-hidden hidden sm:inline-block transition-opacity opacity-0"
                            loading="lazy"
                            onload="this.classList.remove('opacity-0')"
                            src="{{ $item['img'] }}"
                            alt="{{ $item['desc'] }}"
                        >
                    @endif
                </div>
            @endforeach
        </div>
    </section>
    
    <div class="relative h-5 sm:h-10 -mb-5 sm:-mb-10" style="background: linear-gradient(to top left, transparent calc(50% - 1px), transparent, #ededed calc(50% + 1px));"></div>
        @php
            $infoItems = [
                'No purchase necessary.',
                'One email entry per person.',
                'No age restrictions.',
                'No location restrictions.',
                'Song access is valid for 3 years.'
            ];
        @endphp
    
        <section class="px-5 md:px-6" style="background: black;">
        <div class="container max-w-md md:max-w-4xl mx-auto text-center">
            <svg class="inline-block h-20 md:h-28 relative z-10 mb-5 sm:mb-12" xmlns="http://www.w3.org/2000/svg" width="150" height="150" viewBox="0 0 150 150" fill="none">
                <path d="M41.1853 6.17994C45.1417 2.22302 50.5047 0 56.1023 0H93.9075C99.5051 0 104.868 2.22302 108.824 6.17994L143.816 41.1862C147.773 45.1425 150 50.5055 150 56.103V93.908C150 99.5055 147.773 104.868 143.816 108.825L108.824 143.816C104.868 147.773 99.5051 150 93.9075 150H56.1023C50.5047 150 45.1417 147.773 41.1853 143.816L6.17879 108.825C2.22301 104.868 0 99.5055 0 93.908V56.103C0 50.5055 2.22301 45.1425 6.17879 41.1862L41.1853 6.17994ZM67.9714 44.2633V77.0862C67.9714 81.2477 71.1071 84.1197 75.0049 84.1197C78.9026 84.1197 82.0384 81.2477 82.0384 77.0862V44.2633C82.0384 40.6294 78.9026 37.2298 75.0049 37.2298C71.1071 37.2298 67.9714 40.6294 67.9714 44.2633ZM75.0049 93.4977C69.8177 93.4977 65.6268 97.9522 65.6268 102.876C65.6268 108.327 69.8177 112.254 75.0049 112.254C80.1921 112.254 84.383 108.327 84.383 102.876C84.383 97.9522 80.1921 93.4977 75.0049 93.4977Z" fill="#FFAE00"/>
            </svg>
            <h3 class="text-white font-extrabold leading-normal">
                We don’t believe in fine print, so here’s <br class="hidden sm:inline">everything you need to know:
            </h3>
           <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 text-left my-8 md:my-12 text-white mx-auto md:px-10 lg:px-0">
            @foreach ($infoItems as $item)
                <div class="flex justify-center md:justify-start md:items-left">
                    <i class="fas fa-check pt-1 mr-2 text-musora"></i>
                    <span>{{ $item }}</span>
                </div>
            @endforeach
            </div>
                @php
                    $timeUnits = [
                        ['condition' => 'timeLeft > 0 && day > 0', 'value' => 'day'],
                        ['condition' => 'timeLeft > 0 && hour > 0', 'value' => 'hour'],
                        ['condition' => 'timeLeft > 0', 'value' => 'minute'],
                        ['condition' => 'timeLeft > 0', 'value' => 'second'],
                    ];
                @endphp
                <div class="inline-block py-4 sm:px-6">
                    <span x-cloak x-data="timer()" x-init="countdown()">
                        <p class="text-white capitalize pb-2 lg:pb-4" x-show="timeLeft >= 0">The winner will be announced on our socials in:</p>
                        <div class="uppercase text-3xl md:text-6xl font-bebas tracking-wide">
                            <span>
                                @foreach ($timeUnits as $index => $unit)
                                    <span x-cloak x-show="{{ $unit['condition'] }}">
                                        <div class="inline-block bg-musora text-black px-2 py-4 mx-1 rounded w-[40px] sm:w-[60px] md:w-[90px] text-center">
                                            <span x-text="{{ $unit['value'] }}"></span> 
                                        </div>
                                        @if ($index < count($timeUnits) - 1)
                                            <span class="inline-block mx-0.5 text-musora">:</span>
                                        @endif
                                    </span>
                                @endforeach
                                <span x-cloak x-show="timeLeft < 0">A Limited Time</span>
                            </span>
                        </div>
                        <p class="text-white italic pt-2 lg:pt-4 pb-20" x-show="timeLeft >= 0"> We will contact the winner by email.</p>
                    </span>
                </div>
        </div>
    </section>

  <section class="text-center px-5 sm:px-6 py-10 sm:py-14 lg:py-20" style="background-color:#ededed">
        <div class="container mx-auto relative z-10 max-w-4xl">
            <h2 class="mb-4 sm:mb-6"><strong>Frequently Asked Questions</strong></h2>
            <div class="px-4">
                @php
                    $faqs = [
                        [
                            'title' => 'How long does a lifetime membership last?',
                            'desc' => 'Simply for life! There isn’t an expiration date on your lifetime membership if you win.',
                        ],
                        [
                            'title' => 'How will I know if I won?',
                            'desc' => 'We will send an email directly to the winner. Be sure to check your email, as we will provide you with updates whether you won or not. (We might even have a special gift for the non-winners, too.)',
                        ],
                        [
                            'title' => 'What content is included with a Lifetime membership if I win?',
                            'desc' =>  'As a lifetime member winner, you will get access to all original content for life. That includes our courses, challenges, The Method, student reviews, and even forums. <br>
                            Some of our song\'s content and transcriptions are licensed by 3rd parties. You will get access to that content for 3 years, and a renewal will be required if you want to keep the feature after that. As for all our endless libraries of Musora content, you will never lose it.',
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
@stop

 @include('_partials.components.countdown',[
        'countdownDate' => '2024-10-10 00:00:00',
        'promoVersion' => false
    ]) 