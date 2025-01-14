@extends('musora._partials.layout')

@section('head-includes')
    <title>Musora | Drumeo, Pianote, Singeo, Guitareo</title>
    <meta property="og:title" content="Musora | Drumeo, Pianote, Singeo, Guitareo">

    <meta name="description" content="Learn the songs you love; now on drums, piano, guitar, or vocals.">
    <meta property="og:description" content="Learn the songs you love; now on drums, piano, guitar, or vocals.">

    <meta property="og:url" content="https://www.musora.com/{{ Request::path() }}">
    <meta property="og:image" content="https://dmmior4id2ysr.cloudfront.net/homepage/2023/share-image3.jpg">
@endsection

  <style>
    .join {
        display: inline-block;
        font: 500 22px/1em 'Bebas Neue', sans-serif;
        letter-spacing: 0.1em;
        text-transform: uppercase;
        background: #0c1524;
        border-radius: 50px;
        color: #000;
        padding: 17px 7%;
        outline: none;
        cursor: pointer;
        text-align: center;
        user-select: none;
        text-decoration: none;
        transition: background-color 0.3s, color 0.3s, opacity 0.3s;
        box-shadow: 0 0 0 rgba(0, 0, 0, 0.35);
    }

    @media (min-width: 768px) {
        .join {
            font-size: 30px;
        }
    }

    .join:hover, .join:focus {
        box-shadow: 0 0 7px rgba(0, 0, 0, 0.35);
        background: #000000;
        color: #ffffff;
    }

    .join.smaller {
        padding: 11px 30px;
        font-size: 16px;
        color: #000;
        font-weight: 500;
    }

    @media (min-width: 768px) {
        .join.smaller {
            font-size: 18px;
            padding: 11px 30px;
        }
    }

    .join.smaller:hover, .join.smaller:focus {
        background: #000000;
        color: #ffffff;
    }

    .join.outline {
        background: transparent;
        outline-style: none !important;
        border: 1px solid #fff;
        color: #fff;
        padding: 10px 24px;
        font-size: 14px;
        font-family: 'Bebas Neue', sans-serif;
        font-weight: 500;
    }

    @media (min-width: 768px) {
        .join.outline {
            border-width: 2px;
            padding: 11px 40px;
            font-size: 16px;
        }
    }

    .join.outline:hover, .join.outline:focus {
        background: #fff;
        color: #000;
    }

    .text-musician {
        color: #37465A;
    }
    p, li {
    line-height: 1.6em;
    font-size: 15px;
}

@media (min-width: 768px) {
    p, li {
        font-size: 16px;
    }
}
    
</style>

@section('body-data')
    x-data="{ trailer: false }"
@endsection


<!-- Main -->
@section('layout-body')

    <header class="px-5 pt-10 sm:pt-14 pb-20 md:pb-24 lg:py-20 lg:pb-32" style="background:#efedeb;">
        <div class="container max-w-5xl mx-auto pb-4">
            <div class="flex flex-wrap sm:flex-nowrap items-center">
                <div class="w-full sm:w-7/12 md:w-6/12 text-center md:text-left">
                    @php
                        $headerContent = [
                            'logo' => [
                                'src' => 'https://d21q7xesnoiieh.cloudfront.net/fit-in/500x0/filters:quality(95)/marketing/musora/lead-gen/everyday-musician/everyday-musician-M.webp',
                            ],
                            'heading' => 'Your Performance. Your Story.',
                            'subheading' => '<strong class="font-black">Be a Star On “Everyday Musician!”</strong>',
                            'description' => 'The application window for the second episode of <br class="hidden lg:block"> ‘Everyday Musician’ in May has closed,<strong> however, you may still submit an application through the form to be considered for future episodes.</strong>',
                        ];
                    @endphp
                    <div class="px-2">
                        <img class="h-10 md:h-14 lg:h-18 pb-1" src="{{ $headerContent['logo']['src'] }}" alt="Logo Everyday Musician" fetchpriority="high">
                        <h3 class="text-xl md:text-2xl lg:text-3xl pt-2">{!! $headerContent['heading'] !!}</h3>
                        <h2 class="pb-4 lg:pb-8 leading-none">{!! $headerContent['subheading'] !!}</h2>
                        <div class="w-full sm:hidden pb-4 px-6">
                            <div class="rounded-xl overflow-hidden relative bg-contain bg-center bg-no-repeat cursor-pointer autoplay-video"
                                style="padding-bottom: 100%; background-image:url('https://d21q7xesnoiieh.cloudfront.net/fit-in/850x0/filters:quality(95)/marketing/musora/lead-gen/everyday-musician/header-v2.webp');"
                                x-on:click="trailer = true;">
                                <div class="join outline smaller absolute bottom-1 bottom-2 left-1">Play Trailer</div>
                            </div>
                        </div>
                        <p class="pb-4 text-musician leading-relaxed lg:pr-8">{!! $headerContent['description'] !!}</p>
                        <a class="anchor-slide join smaller w-11/12 lg:w-full sm:max-w-[350px] bg-musora font-bebas" target="_blank" href="https://docs.google.com/forms/d/1vuL_0MxezoVm8eP-mfEM3etk2sFQ8REeeC6bSz3eamg/viewform?edit_requested=true">APPLY HERE</a>
                    </div>
                </div>
                <div class="sm:w-5/12 hidden sm:inline-block">
                    <div class="rounded-xl overflow-hidden relative bg-contain bg-center bg-no-repeat cursor-pointer autoplay-video"
                        style="padding-bottom: 100%; background-image:url('https://d21q7xesnoiieh.cloudfront.net/fit-in/850x0/filters:quality(95)/marketing/musora/lead-gen/everyday-musician/header-v2.webp');"
                        x-on:click="trailer = true;">
                        <div class="join outline smaller absolute bottom-1 bottom-2 left-1">Play Trailer</div>
                    </div>
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

    <section class="relative text-center px-4 sm:px-6 md:pt-20 pb-16 lg:pt-36 lg:pb-24 bg-white">
        <div class="pt-4 md:pt-0">
            <div class="container max-w-5xl mx-auto mb-20 -mt-20 md:-mt-40 lg:-mt-48 z-20 relative">
                <div class="px-5 lg:px-0">
                    @php
                        $items = [
                            [
                                'icon' => 'fa-sharp fa-solid fa-calendar-days',
                                'text' => 'When',
                                'highlight' => 'Date to be scheduled'
                            ],
                            [
                                'icon' => 'fa-sharp fa-solid fa-location-dot',
                                'text' => 'Where',
                                'highlight' => 'Musora Studios - Abbotsford, BC, Canada'
                            ],
                            [
                                'icon' => 'fa-sharp fa-solid fa-location-dot fa-dollar-sign',
                                'text' => 'How',
                                'highlight' => 'All expenses paid!'
                            ],
                        ];
                    @endphp
    
                    <div class="flex flex-wrap sm:flex-nowrap text-center shadow-md rounded-xl relative" style="background:linear-gradient(to bottom, #fff, #fbfbfb);">
                        <div class="z-10 flex flex-wrap items-start justify-evenly w-full sm:w-auto sm:flex-grow py-4 sm:py-3 lg:py-4 lg:px-3 text-left sm:text-center">
                            @foreach ($items as $index => $item)
                                <div class="flex sm:block w-full sm:w-1/4 px-4 sm:px-0 mb-4 sm:mb-0">
                                    <i class="far fa-fw mr-3 sm:mr-0 mb-2 {{ $item['icon'] }} text-musora text-3xl"></i>
                                    <div class="flex flex-col items-left">
                                        <p class="leading-tight mx-0 pb-1 text-musician font-black">{{ $item['text'] }}</p>
                                        <p class="text-xs md:text-sm px-1 md:px-2 text-musician">{!! $item['highlight'] !!}</p>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    
        <div class="flex flex-wrap md:flex-nowrap items-center container mx-auto max-w-4xl rounded-2xl" style="background: linear-gradient(to right, rgba(239, 239, 239, 0.95), rgba(239, 239, 239, 0.0)), url('https://d21q7xesnoiieh.cloudfront.net/fit-in/1500x0/filters:quality(95)/marketing/musora/lead-gen/everyday-musician/pattern.webp'); background-size: cover; background-position: center;">
            <div class="w-full sm:hidden">
                <img src="https://d21q7xesnoiieh.cloudfront.net/fit-in/1000x0/filters:quality(95)/marketing/musora/lead-gen/everyday-musician/holding-phone.webp" alt="Hand holding mobile phone" class="w-2/3 h-auto rounded-lg float-right">
            </div>
            <div class="w-full sm:w-1/2 md:w-2/3 p-4 md:p-10 text-left">
                <p class="text-black leading-normal"><strong>We're committed to not just showcasing your talent, but also ensuring your experience with us is seamless and rewarding. </strong>Musora will cover all travel and accommodation expenses, plus provide an additional $400 stipend for any incidental costs you may encounter.<br><br>All that's required from you is to join us at the Musora Studio’s on a scheduled date, ready to collaborate and create musical magic alongside fellow Musora students and our esteemed producer.</p>
            </div>
            <div class="hidden sm:block sm:w-1/2 md:w-1/3">
                <img src="https://d21q7xesnoiieh.cloudfront.net/fit-in/1000x0/filters:quality(95)/marketing/musora/lead-gen/everyday-musician/holding-phone.webp" alt="Hand holding mobile phone" class="w-full h-auto rounded-lg">
            </div>
        </div>
    </section>


    <section class="text-center px-5 sm:px-6 py-8 sm:py-16 lg:py-20 relative" style="background-color:#041627">
        <div class="container mx-auto z-10 relative max-w-4xl">
            <h2 class="leading-tight text-musora mb-3"><strong>What does film day look like?</strong></h2>
            <p class="px-4 md:px-20 text-white">At Musora, we believe in honoring the progress you've made on your musical path. This opportunity isn't just about showcasing your talents; it's an immersive experience designed to enrich your musical journey.</p>
            <div class="w-full">
                <img src="https://d21q7xesnoiieh.cloudfront.net/fit-in/1400x0/filters:quality(95)/marketing/musora/lead-gen/everyday-musician/students-1.webp" alt="Students" class="w-full h-auto rounded-lg">
            </div>
            <h5 class="italic py-10 text-musora">By participating, you will:</h5>
            @php
                $benefits = [
                    [
                        'img' => 'https://d21q7xesnoiieh.cloudfront.net/fit-in/1500x0/filters:quality(95)/marketing/musora/lead-gen/everyday-musician/icon-15.webp',
                        'icon' => '<strong><i class="fa-light fa-circle-1"></i></strong>',
                        'description' => 'Get complete access to lessons across every instrument on our platform.'
                    ],
                    [
                        'img' => 'https://d21q7xesnoiieh.cloudfront.net/fit-in/1500x0/filters:quality(95)/marketing/musora/lead-gen/everyday-musician/icon-16.webp',
                        'icon' => '<strong><i class="fa-light fa-circle-2"></i></strong>',
                        'description' => 'Boost any skill anytime with topic-based courses for any musical goal, or follow our 10-level curriculum to learn all the foundational skills in the right order.'
                    ],
                    [
                        'img' => 'https://d21q7xesnoiieh.cloudfront.net/fit-in/1500x0/filters:quality(95)/marketing/musora/lead-gen/everyday-musician/icon-20.webp',
                        'icon' => '<strong><i class="fa-light fa-circle-3"></i></strong>',
                        'description' => 'You can skip the boring and lonesome practice with our challenges and workouts. Simply choose what you want to learn and follow along with your instructor in real-time.'
                    ],
                ];
            @endphp
    
            @foreach ($benefits as $index => $benefit)
                <img class="my-4 w-full rounded-xl overflow-hidden inline sm:hidden transition-opacity opacity-0"
                    loading="lazy"
                    onload="this.classList.remove('opacity-0')"
                    src="{{ $benefit['img'] }}"
                    alt="{{ $benefit['icon'] }}">
                <div class="text-left flex flex-wrap sm:flex-nowrap justify-center items-center sm:py-10">
                    @if ($index % 2 != 0)
                        <img class="flex-shrink-0 w-full sm:w-6/12 rounded-xl overflow-hidden hidden sm:inline-block transition-opacity opacity-0"
                            loading="lazy"
                            onload="this.classList.remove('opacity-0')"
                            src="{{ $benefit['img'] }}"
                            alt="{{ $benefit['icon'] }}">
                        <div class="flex-grow-0 leading-normal max-w-xl sm:pl-5 lg:pl-10 mx-0">
                            <h5 class="text-musora text-3xl md:text-4xl pb-2 md:pb-4">{!! $benefit['icon'] !!}</h5>
                            <h5 class="text-white">{{ $benefit['description'] }}</h5>
                        </div>
                    @else
                        <div class="flex-grow-0 leading-normal max-w-xl sm:pr-5 lg:pr-10 mx-0">
                            <h5 class="text-musora text-3xl md:text-4xl pb-2 md:pb-4">{!! $benefit['icon'] !!}</h5>
                            <h5 class="text-white">{{ $benefit['description'] }}</h5>
                        </div>
                        <img class="flex-shrink-0 w-full sm:w-6/12 rounded-xl overflow-hidden hidden sm:inline-block transition-opacity opacity-0"
                            loading="lazy"
                            onload="this.classList.remove('opacity-0')"
                            src="{{ $benefit['img'] }}"
                            alt="{{ $benefit['icon'] }}">
                    @endif
                </div>
            @endforeach
        </div>
    </section>

<section class="text-center px-5 sm:px-6 py-10 sm:py-14 lg:py-20">
    <div class="container mx-auto relative z-10 max-w-4xl">
        <h2 class="mb-2"><strong>Frequently Asked Questions</strong></h2>
         <p class="mb-6">
            For inquiries, please feel free to contact us at <a href="mailto:everydaymusician@musora.com" class="text-musora underline">everydaymusician@musora.com</a>. We're here to help!
        </p>
        <div class="px-4">
            @php
                $faqs = [
                    [
                        'title' => 'I’m from outside the US/Canada - can I still apply?',
                        'desc' => 'Yes, we are accepting worldwide applications.',
                    ],
                    [
                        'title' => 'I play more than one instrument. What one do I choose?',
                        'desc' => 'You can choose one instrument or let us know you’re open to playing others.',
                    ],
                    [
                        'title' => 'I’m only a beginner. Does that matter?',
                        'desc' => 'This is perfect. We want students of all skill levels.',
                    ],
                    [
                        'title' => 'How will you pick students?',
                        'desc' => 'I will work closely with my team to select the final students. Selection criteria will be based on pairing students with a producer that we feel would benefit participants and viewers the most.',
                    ],
                    [
                        'title' => 'Will I know what song to learn ahead of time?',
                        'desc' => 'We will not be sharing the song ahead of time. However, we will send you some information on what you can practice broadly in preparation for taping.',
                    ],
                    [
                        'title' => 'How long will it take?',
                        'desc' => 'The entire experience will take three days, with one full day in the studio and two days of travel.',
                    ],
                    [
                        'title' => 'How soon after filming will I have the professionally recorded track?',
                        'desc' => 'We are unsure how fast we can edit and finalize the footage and music. I would estimate three months from start to finish.',
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


      @include('_partials.components.video-modal', [
            'name' => 'trailer',
            'video' => '913100599',
            'vimeo' => true,
        ])
@stop

