@php
  $steps = [
      [
          'position' => 'left',
          'img' => 'https://pianote.s3.amazonaws.com/products/the-power-of-chords/thumb1.jpg',
          'title' => 'Why Chords Are Powerful',
          'desc' => 'All music is chords. You’ll learn why chords are one of the most important concepts in music, and how YOU can use chords to play your favorite songs, and even write your own music.'
      ],
      [
          'position' => 'right',
          'img' => 'https://pianote.s3.amazonaws.com/products/the-power-of-chords/thumb2.jpg',
          'title' => 'How Chords Are Made',
          'desc' => 'Chords are NOT a big mystery. They follow formulas and those formulas never change. Unlock the formulas behind the most common chords you’ll play in popular music.'
      ],
      [
          'position' => 'left',
          'img' => 'https://pianote.s3.amazonaws.com/products/the-power-of-chords/thumb3.jpg',
          'title' => 'Chord Inversions 101',
          'desc' => 'Inversions can be scary and a little confusing. But they open up the keyboard in an entirely new way. The concept behind them is simple. And the result -- is powerful. You’ll get tips to practice and master your chord inversions so they’ll become second nature.'
      ],
      [
          'position' => 'right',
          'img' => 'https://pianote.s3.amazonaws.com/products/the-power-of-chords/thumb4.jpg',
          'title' => '“Sus” Chords Explained',
          'desc' => '“Sus” chords are “suspended” chords that replace one of the notes to create a beautiful, open sound that leads wonderfully into a resolution. Knowing what they are is one thing. You’ll learn how and where to use them.'
      ],
      [
          'position' => 'left',
          'img' => 'https://pianote.s3.amazonaws.com/products/the-power-of-chords/thumb5.jpg',
          'title' => 'Slash Chords Explained',
          'desc' => 'No, we’re not talking about a famous guitarist. Slash chords can trip up beginner players, but a little bit of knowledge will add a new weapon to your chord arsenal. Slash chords add new bass notes to change the sound of the chords you’re playing.'
      ],
      [
          'position' => 'right',
          'img' => 'https://pianote.s3.amazonaws.com/products/the-power-of-chords/thumb6.jpg',
          'title' => 'How To Build 7th Chords',
          'desc' => 'Go beyond basic chords to start sounding more sophisticated and complex. You’ll be shown how to play all the different types of 7th chords and get a cheat sheet to learn some beautiful progressions using 7th chords.'
      ],
      [
          'position' => 'left',
          'img' => 'https://pianote.s3.amazonaws.com/products/the-power-of-chords/thumb8.jpg',
          'title' => 'Reading Chord Charts & Lead Sheets',
          'desc' => 'Why do you learn chords? To play songs! It’s time to take what you’ve learned and see how it will make playing your favorite songs so much easier. You’ll be able to approach any chord chart or lead sheet with confidence.'
      ],
      [
          'position' => 'right',
          'img' => 'https://pianote.s3.amazonaws.com/products/the-power-of-chords/thumb7.jpg',
          'title' => 'Finding Chords in Sheet Music',
          'desc' => 'What if the music doesn’t have chord names? No problem. You’ll learn how to find chords “hidden” in sheet music. Even classical music is based on chords (like Für Elise). And after this lesson, you’ll never look at sheet music the same way again.'
      ],
      [
          'position' => 'left',
          'img' => 'https://pianote.s3.amazonaws.com/products/the-power-of-chords/thumb9.jpg',
          'title' => 'Write Your Own Chord Progressions',
          'desc' => 'It’s time to take everything you’ve learned and write your own music. But you won’t be alone. We’ll help you start writing your own beautiful chord progressions and exploring melodies. Your relationship with music and the piano will change once you start creating and expressing yourself.'
      ],
  ];

  $modalImages = [
      "https://pianote.s3.amazonaws.com/products/chords-and-scales-book/2021-12-23-Pianote-Chords-Scales-106-Edit.jpg",
      "https://pianote.s3.amazonaws.com/products/chords-and-scales-book/2021-12-23-Pianote-Chords-Scales-107-Edit.jpg",
      "https://pianote.s3.amazonaws.com/products/chords-and-scales-book/2021-12-23-Pianote-Chords-Scales-108-Edit.jpg"
  ];
@endphp

@if(!empty($products['the-power-of-chords']->getPublicStockCount()))
    @php
        $students = $products['the-power-of-chords']->getPublicStockCount()
    @endphp
@endif

@extends('pianote._partials.global-layout')

@section('global-head')
    @parent
    <title>The Power of Chords | Pianote</title>
    <meta property="og:title" content="The Power of Chords | Pianote">
    <meta name="description" content="Play the music you love on piano.">
    <meta property="og:description" content="Play the music you love on piano.">
    <meta property="og:image" content="https://www.musora.com/musora-cdn/image/width=1200,quality=85/https://pianote.s3.amazonaws.com/products/the-power-of-chords/share-image.jpg">
    <meta property="og:url" content="https://www.pianote.com/{{ Request::path() }}">


    @include('_partials.layout._tailwindcdn')
    <link href="{{ asset('/marketing/parcel/pianote/nav-footer.css') }}" rel="stylesheet">
    <link href="{{ asset('/marketing/parcel/pianote/play-beautiful-piano.css') }}" rel="stylesheet">
    <link href="{{ asset('/marketing/css/tailwind-helpers.css') }}" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.min.css"/>
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick-theme.min.css"/>

    <style>
        body {
            counter-reset: timeline;
        }

        .header-thumb {
            max-height: 450px;
        }

        .join.small {
            font-size: 20px !important;
            padding: 9px 7%;
        }

        .music-sheet {
            max-height: 470px;
        }

        /* vertical line */
        .timeline-container::after {
            content: '';
            position: absolute;
            width: 3px;
            background-color: #EF4444;
            top: 0;
            bottom: 0;
            left: 4px;
            margin-left: -3px;
            z-index: 10;
        }

        /* circles in the middle */
        .timeline::after {
            counter-increment: timeline;
            content: counter(timeline);;
            position: absolute;
            width: 20px;
            height: 20px;
            font-size: 12px;
            left: -6px;
            background-color: #EF4444;
            top: 0;
            border-radius: 50%;
            z-index: 1;
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight:900;
            z-index: 20;
        }

        .timeline-number {
            display: none;
            width: 20px;
            height: 20px;
            font-size: 12px;
            background-color: #EF4444;
            border-radius: 50%;
            color: white;
            align-items: center;
            justify-content: center;
            font-weight:900;
            top: -2px;
        }

        .timeline-number.right {
            left: -32px;
        }

        .timeline-number.left {
            left: -36px;
        }

        .timeline-img {
            filter: drop-shadow(4px 4px 10px rgba(0, 0, 0, 0.25));
            border:1px solid #E4E4E4;
        }

        .image-modal-arrow-left, .image-modal-arrow-right {
            font-size: 0;
            position: absolute;
            transform: translate(0, -50%);
            background: #FFF;
            transition: opacity .3s;
            border-radius: 100px;
            height: auto;
            width: auto;
            z-index: 10;
            padding: 3px 10px;
            margin: 0;
            bottom: unset;
            top: 50%;
        }

        .image-modal-arrow-left {
            left: 0;
        }

        .image-modal-arrow-right {
            right: 0;
        }

        .image-modal-arrow-left::before, .image-modal-arrow-right::before {
            -webkit-font-smoothing: antialiased;
            display: inline-block;
            font-style: normal;
            font-variant: normal;
            text-rendering: auto;
            opacity: 1;
            line-height: 1;
            font-family: "Font Awesome 5 Pro";
            font-weight: 300;
            color: #f61a30;
            font-size: 28px;
        }

        .image-modal-arrow-left::before {
            content: "\f104";
        }

        .image-modal-arrow-right::before {
            content: "\f105";
        }

        .tooltip {
            position: relative;
        }
        .tooltip:after, .tooltip:before {
            position: absolute;
            transform: translate(-50%, 0);
            height: auto;
            max-height: 0;
            visibility: hidden;
            opacity: 0;
            transition: all 0.3s;
            overflow: hidden;
        }
        .tooltip:before {
            z-index: 100;
            content: "";
            bottom: 23px;
            left: 50%;
            border-right: 7px transparent solid;
            border-left: 7px transparent solid;
            border-top: 7px solid #fff;
        }
        .tooltip:after {
            padding: 5px 8px;
            content: attr(tip);
            font: 400 14px/1.4em 'Open Sans', sans-serif;
            text-align: left;
            color: #000;
            width: 220px;
            border-radius: 8px;
            background: #fff;
            box-shadow: 0 0 15px #000;
            bottom: 30px;
            left: -300%;
        }
        .tooltip:hover, .tooltip:active, .tooltip:focus {
            z-index: 100;
        }
        .tooltip:hover:after, .tooltip:active:after, .tooltip:focus:after, .tooltip:hover:before, .tooltip:active:before, .tooltip:focus:before {
            max-height: 1000px;
            visibility: visible;
            opacity: 1;
            display: block;
        }

        @media (min-width: 640px) {
            .timeline-number {
                width: 25px;
                height: 25px;
                font-size: 14px;
            }
        }

        @media (min-width: 768px) {
            .timeline-container::after {
                left: 50%;
                top: 36px;
                bottom: 220px;
            }

            .timeline::after {
                display: none;
            }

            .timeline-number {
                display: flex;
            }

            .timeline-number.right {
                top: -4px;
                left: unset;
                right: -35px;
            }

            .timeline-number.left {
                top: -4px;
                left: -46px;
            }
        }

        @media (min-width: 860px) {
            .timeline-container::after {
                top: 48px;
            }
        }

        @media (min-width: 1024px) {
            .image-modal-arrow-left {
                left: -10px;
            }

            .image-modal-arrow-right {
                right: -10px;
            }

            .timeline-container::after {
                top: 62px;
            }

            .timeline-number {
                width: 30px;
                height: 30px;
                font-size: 16px;
            }

            .timeline-number.right {
                right: -52px;
            }

            .timeline-number.left {
                left: -56px;
            }
        }
    </style>
@endsection

@section('global-body')
    @include('pianote.sales.partials._nav', [
        "cartVersion" => true
    ])

    @yield('topbar')

    <header class="py-10 md:py-14 relative">
        {{-- gradient div in tablet and desktop--}}
        <div class="hidden md:block absolute inset-0" style="background:radial-gradient(50.22% 125.94% at 0% 0%, rgba(253, 79, 85, 0.2) 0%, rgba(248, 235, 232, 0.2) 100%); transform: rotate(-180deg);"></div>
        {{-- gradient div in mobile --}}
        <div class="md:hidden absolute inset-0" style="background:linear-gradient(210deg, #fedcdd, #fff 75%);"></div>
        <div class="max-w-5xl mx-auto md:flex relative items-center px-4">
            <div class="flex-1 text-center lg:text-right">
                <div class="md:inline-block text-center md:text-left">
                    <img class="h-20 md:h-24 mb-6 lazyload" data-src="https://www.musora.com/musora-cdn/image/width=400,quality=85/https://pianote.s3.amazonaws.com/products/the-power-of-chords/Logo_left.png" alt="logo left">
                    <h1 class="font-extrabold mb-4">
                        Play the music <br>you love on piano.
                    </h1>
                    <h4 class="leading-normal mb-6 md:mb-10">
                        Simple steps to transform your <br>understanding of music.
                    </h4>
                    <div class="hidden md:flex">
                        <div class="flex-1 relative">
                            <a class="join small w-full text-base" href="@yield('order-link')">get started</a>
                            {{--<div class="text-pianote absolute -bottom-6 left-0 right-0 text-xs text-center">--}}
                                {{--LAUNCH SPECIAL - SAVE {{ round(100 - (100 * (floatval($productPrices['the-power-of-chords']->discounted_price) / floatval($productPrices['the-power-of-chords']->price)))) }}%--}}
                            {{--</div>--}}
                        </div>
                        <div class="flex-1 flex items-center pl-2">
                            <img class="h-6 mr-1 lazyload" data-src="https://www.musora.com/musora-cdn/image/width=80,quality=85/https://pianote.s3.amazonaws.com/products/the-power-of-chords/profiles.png" alt="profiles">
                            <div style="font-size: 10px;">
                                Join {{ $students }} pianists who<br> have already registered.
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="flex-1 text-center md:pl-6 lg:pl-0">
                <div class="inline-block relative max-w-lg">
                    <img class="hidden md:inline-block rounded-xl cursor-pointer header-thumb lazyload autoplay-video" data-src="https://www.musora.com/musora-cdn/image/width=760,quality=85/https://pianote.s3.amazonaws.com/products/the-power-of-chords/header_thumb.png" data-open="sample" alt="header thumb">
                    <img class="md:hidden rounded-xl mb-6 cursor-pointer lazyload autoplay-video" data-src="https://www.musora.com/musora-cdn/image/width=800,quality=85/https://pianote.s3.amazonaws.com/products/the-power-of-chords/header_thumb_m.png" data-open="sample" alt="mobile header thumb">
                    <div class="join smaller white absolute bottom-8 md:bottom-3 left-2 autoplay-video" data-open="sample">
                        <i class="fa-solid fa-play"></i>
                        watch a sample
                    </div>
                </div>
            </div>
            <div class="md:hidden max-w-xs mx-auto">
                <div class="relative mb-6">
                    <a class="join small w-full text-base" href="@yield('order-link')">get started</a>
                    {{--<div class="text-pianote text-xs text-center mt-2">--}}
                        {{--LAUNCH SPECIAL - SAVE {{ round(100 - (100 * (floatval($productPrices['the-power-of-chords']->discounted_price) / floatval($productPrices['the-power-of-chords']->price)))) }}%--}}
                    {{--</div>--}}
                </div>
                <div class="flex-1 flex items-center md:pl-2 justify-center">
                    <img class="h-6 mr-1 lazyload" data-src="https://www.musora.com/musora-cdn/image/width=80,quality=85/https://pianote.s3.amazonaws.com/products/the-power-of-chords/profiles.png" alt="profiles">
                    <div style="font-size: 10px;">
                        Join {{ $students }} pianists who<br class="hidden md:inline-block"> have already <br class="md:hidden">registered.
                    </div>
                </div>
            </div>
        </div>
    </header>

    <section class="py-10 md:py-20 relative px-4 lg:px-0">
        <div class="max-w-5xl mx-auto md:flex relative z-40">
            <div class="flex-1 text-right md:pr-4 lg:pr-10 mb-10 md:mb-0">
                <div class="max-w-md md:max-w-auto mx-auto md:inline-block">
                    <h2 class="font-extrabold text-left mb-6">
                        All music uses chords.
                    </h2>
                    <p class="text-left" style="color: #2A2F34; max-width: 406px; margin: 0;">
                        Even classical music that’s 100s of years old. <br><br>
                        Chords are the foundation of music. When you understand and can play chords -- you’ll be able to play the songs you love easier, with more confidence.
                        <br><br>
                        Beyond that -- chords allow you to start writing your own music and improvising on the piano.
                        <br><br>
                        It all comes down to chords.
                    </p>
                </div>
            </div>
            <div class="flex-1 md:pl-4 lg:pl-10 text-center">
                <img class="music-sheet -mb-16 lazyload" data-src="https://www.musora.com/musora-cdn/image/width=1050,quality=85/https://pianote.s3.amazonaws.com/products/the-power-of-chords/sheet_music.png" alt="sheet music">
            </div>
        </div>

        {{-- diagonal line --}}
        <div class="h-28 absolute bottom-0 left-0 right-0 z-10" style="background: linear-gradient(to top left, #F4F8FB calc(50% - 1px), #F4F8FB , #fff calc(50% + 1px));"></div>
    </section>

    <section class="pb-10 pt-20 md:py-28 px-4 sm:px-6" style="background: #F4F8FB;">
        <div class="max-w-5xl mx-auto">
            <h2 class="font-extrabold text-center mb-6 md:mb-20">
                Simple steps to<br class="inline sm:hidden"> transform your playing.
            </h2>
            <div class="timeline-container relative mx-auto -mb-16 md:-mb-16 lg:-mb-28">
                @foreach ($steps as $key => $step)
                    @if($step['position'] === 'right')
                        <div class="timeline relative flex flex-col-reverse md:grid md:grid-cols-2 {{--gap-2 md:gap-12 lg:gap-20--}} mb-16 md:mb-0 md:mb-16 lg:mb-28 pl-6 md:pl-0">
                            <div class="content relative flex items-center justify-center pr-1 md:pr-6 lg:pr-10">
                                <div class="relative w-full">
                                    <div class="md:max-w-xs lg:max-w-md w-full relative mx-auto">
                                        <h4 class="font-extrabold mb-4">{{ $step['title'] }}</h4>
                                        <p style="color:#6A6868;">
                                            {{ $step['desc'] }}
                                        </p>
                                    </div>
                                    <div class="absolute top-0 z-50 timeline-number right">{{ $key+1 }}</div>
                                </div>
                            </div>
                            <div class="pl-1 md:pl-9 lg:pl-10">
                                <img class="timeline-img rounded-xl lazyload mb-4 md:mb-0" data-src="https://www.musora.com/musora-cdn/image/width=800,quality=85/{{ $step['img'] }}" alt="step {{$key+1}}" />
                            </div>
                        </div>
                    @else
                        <div class="timeline relative flex flex-col md:grid md:grid-cols-2 {{--gap-2 md:gap-12 lg:gap-20--}} mb-16 md:mb-16 lg:mb-28 pl-6 md:pl-0">
                            <div class="pr-1 md:pr-9 lg:pr-10">
                                <img class="timeline-img rounded-xl lazyload mb-4 md:mb-0" data-src="https://www.musora.com/musora-cdn/image/width=800,quality=85/{{ $step['img'] }}" alt="step {{$key+1}}" />
                            </div>
                            <div class="content relative flex items-center justify-center pl-1 md:pl-8 lg:pl-10">
                                <div class="relative w-full">
                                    <div class="md:max-w-xs lg:max-w-md w-full mx-auto">
                                        <h4 class="font-extrabold mb-4">{{ $step['title'] }}</h4>
                                        <p style="color:#6A6868;">
                                            {{ $step['desc'] }}
                                        </p>
                                    </div>
                                    <div class="absolute top-0 z-50 timeline-number left">{{ $key+1 }}</div>
                                </div>
                            </div>
                        </div>
                    @endif

                @endforeach
            </div>
        </div>
    </section>

    <section class="pt-10 md:pt-20 pb-20 md:pb-40 relative">
        <div class="max-w-xl md:max-w-5xl mx-auto">
            <h2 class="font-extrabold text-center mb-10">
                Practice tools to<br class="inline sm:hidden"> guarantee success.
            </h2>
            <div class="md:flex gap-5 px-4">
                <div class="flex-1 mb-10 md:mb-0">
                    <video autoplay loop muted class="mb-4 rounded-xl shadow-md">
                        <source src="https://pianote.s3.amazonaws.com/products/the-power-of-chords/practice-alongs3.mp4" type="video/mp4">
                        Your browser does not support the video tag.
                    </video>
                    <h5 class="font-extrabold mb-2">
                        Practice-Along Exercises
                    </h5>
                    <p style="color:#2A2F34;">
                        Never feel lost. You’ll always know what to practice - when.
                    </p>
                </div>
                <div class="flex-1 mb-10 md:mb-0">
                    <div class="bg-cover bg-top w-full aspect-16:9 rounded-xl mb-4 lazyload shadow-md" data-bg="https://www.musora.com/musora-cdn/image/width=690,quality=85/https://pianote.s3.amazonaws.com/products/the-power-of-chords/downloadable.jpg"></div>
                    <h5 class="font-extrabold mb-2">
                        Downloadable Cheat Sheats
                    </h5>
                    <p style="color:#2A2F34;">
                        Print every exercise + chord formulas to see better results.
                    </p>
                </div>
                <div class="flex-1">
                    <div class="bg-cover bg-top w-full aspect-16:9 rounded-xl mb-4 lazyload shadow-md" data-bg="https://www.musora.com/musora-cdn/image/width=690,quality=85/https://pianote.s3.amazonaws.com/products/the-power-of-chords/personal_support.jpg"></div>
                    <h5 class="font-extrabold mb-2">
                        Personal Support
                    </h5>
                    <p style="color:#2A2F34;">
                        Get help and answers from  REAL teachers.
                    </p>
                </div>
            </div>
        </div>

        {{-- diagonal line --}}
        <div class="h-10 absolute left-0 right-0" style="background: linear-gradient(to top left, #00101D calc(50% - 1px), #00101D, #fff calc(50% + 1px)); bottom: -1px;"></div>
    </section>

    {{--<section class="py-10 md:py-20 relative" style="background: linear-gradient(180deg, #F61A30 0%, #910000 122.85%);">--}}
        {{--<div class="max-w-5xl mx-auto md:flex px-4 relative z-40">--}}
            {{--<div class="flex-1 text-white md:pr-4 lg:pr-0 mb-6 md:mb-0 max-w-md md:max-w-auto mx-auto">--}}
                {{--<h2 class="font-extrabold mb-4 text-center md:text-left">--}}
                    {{--Master every chord & <br>scale with this guide.--}}
                {{--</h2>--}}
                {{--<p>--}}
                    {{--<span class="font-extrabold">Every Chord. Every Scale. Every Key.</span> <br><br>--}}
                    {{--This essential resource will help you learn the most important chord shapes, chord variations, and scales in EVERY key. <br><br>--}}
                    {{--It’s yours FREE when you get The Power of Chords. (And we’ll cover the shipping.) <br><br>--}}
                {{--</p>--}}
            {{--</div>--}}
            {{--<div class="flex-1 relative sm:w-2/3 md:w-auto mx-auto text-center sm:pl-10">--}}
                {{--<div class="relative md:max-w-md mx-auto">--}}
                    {{--<img class="md:absolute md:w-full h-80 md:h-auto md:left-0 --}}{{---top-20--}}{{-- scales-book cursor-pointer lazyload" data-src="https://pianote.s3.amazonaws.com/products/the-power-of-chords/piano_scales_book.png" alt="scales book" data-open="seeInside1">--}}
                {{--</div>--}}
            {{--</div>--}}
        {{--</div>--}}

        {{--<div class="absolute md:hidden w-full h-40" style="background: #00101D; bottom: -1px;"></div>--}}
    {{--</section>--}}

    <section class="text-center px-5 sm:px-6 pb-20 pt-10 sm:py-16 lg:py-24" style="background-color:#00101D;">
        <div class="container max-w-5xl mx-auto">
            <div class="flex flex-wrap sm:flex-nowrap items-start justify-center sm:mt-12 mb-12">
                <div class="py-40 sm:py-48 lg:py-64 border-8 border-white rounded-3xl shadow-xl w-56 sm:w-72 lg:w-96 bg-center bg-cover relative -mb-8 sm:mb-0 sm:-mt-8 sm:-mr-8 z-10 flex-shrink-0 cursor-pointer lazyload autoplay-video" data-bg="https://www.musora.com/musora-cdn/image/width=550,quality=85/https://pianote.s3.amazonaws.com/products/the-power-of-chords/coach_profile-min.png" data-open="meetlisa">
                    <div class="join smaller white absolute bottom-2 md:bottom-3 left-2 autoplay-video" data-open="meetlisa">
                        <i class="fa-solid fa-play"></i>
                        meet lisa!
                    </div>
                </div>
                {{-- <img class="border-8 border-white rounded-3xl shadow-xl w-56 sm:w-72 lg:w-96 relative -mb-8 sm:mb-0 sm:-mt-8 sm:-mr-8 z-10 lazyload" data-src="https://www.musora.com/musora-cdn/image/width=550,quality=85/https://pianote.s3.amazonaws.com/products/the-power-of-chords/coach_profile-min.png"> --}}
                <div class="bg-white text-left rounded-xl pt-14 pb-8 sm:py-10 lg:py-12 px-6 sm:pr-10 sm:pl-14 lg:px-24 max-w-xl sm:mt-8 w-full sm:w-auto sm:flex-grow">
                    <h6 class="uppercase text-pianote leading-normal text-center sm:text-left">MEET YOUR COACH</h6>
                    <h2 class="text-center sm:text-left"><strong>Lisa Witt</strong></h2>
                    <h6 class="leading-normal mt-4 lg:mt-6">I know what it’s like to struggle on the piano. <br><br>
                        I have a short attention span, and learning to read music was like trying to understand a language that made no sense to me. <br><br>
                        But what I’ve realized is that the traditional approach to piano lessons is not the only way to learn. We’re all different. And as a teacher, I’ve made it my mission to take the fear out of learning the piano -- and prove that YOU can do this. <br><br>
                        Even if you don’t believe me. <br><br>
                        It’s why I’m so excited about this course - because it’s going to show you what’s possible. <br><br>
                        I hope you’ll give me a chance to do that.
                    </h6>
                    <img class="h-10 lg:h-16 mt-7 lg:mt-10 lazyload" data-src="https://pianote.s3.amazonaws.com/products/the-power-of-chords/signature.png" alt="signature">
                </div>
            </div>
        </div>
    </section>

    <section class="pt-20 sm:pt-28 pb-10 md:pb-20 relative">
        <div class="text-center absolute left-0 right-0 -top-16">
            <img class="h-28 md:h-32 lazyload" data-src="https://pianote.s3.amazonaws.com/sales/2022/piano-guarantee.png" alt="gurantee badge">
        </div>
        <div class="max-w-4xl mx-auto px-4">
            <h2 class="font-extrabold text-center mb-10">
                The guarantee that lasts <br>longer than the course.
            </h2>
            <p class="text-center mb-8">
                We get it. There are a lot of courses out there that sell you the dream without owning the result. We’re different. You’ll be protected for a full 90 days – even though the course only takes most students 30 days to complete. Take the lessons, see the results… and if you’re not totally satisfied – simply request a refund.
            </p>
            <div class="sm:flex gap-6">
                <div class="w-full sm:w-1/3 px-2 mb-3 sm:mb-0 text-center">
                    <h5 class="text-pianote border-pianote border-2 rounded-full inline-block py-2 px-3 mb-1">1</h5>
                    <h6 class="leading-normal">Start your<br> lessons today.</h6>
                </div>
                <div class="w-full sm:w-1/3 px-2 mb-3 sm:mb-0 text-center">
                    <h5 class="text-pianote border-pianote border-2 rounded-full inline-block py-2 px-3 mb-1">2</h5>
                    <h6 class="leading-normal">Enjoy them for 90<br> days, risk-free.</h6>
                </div>
                <div class="w-full sm:w-1/3 px-2 text-center">
                    <h5 class="text-pianote border-pianote border-2 rounded-full inline-block py-2 px-3 mb-1">3</h5>
                    <h6 class="leading-normal">Change your mind?<br> Get a refund. <div class="inline-block tooltip cursor-pointer" tip="If it’s not for you, simply cancel your membership within 90 days and contact us for a full refund. (If your membership includes any bonuses, your refund will deduct the value of hard goods that were shipped to you.)"><i class="fas fa-info-circle text-pianote"></i></div></h6>
                </div>
            </div>
        </div>
    </section>

    <div id="customize-anchor" class="anchor"></div>
    <section class="px-4 py-10 md:py-20" style="background: #EFF7FF;">
        <div class="max-w-sm md:max-w-2xl lg:max-w-3xl mx-auto text-center">
            <img class="h-20 sm:h-24 mb-8 lazyload" data-src="https://pianote.s3.amazonaws.com/products/the-power-of-chords/Logo_center.png" alt="centerd logo">
            <h2 class="font-extrabold">Play the music you love.</h2>
            <h6 class="mt-2 leading-normal">
                Simple steps to transform your <br class="md:hidden">understanding of music.
            </h6>
            {{--<div class="flex flex-wrap items-end justify-center 2-full my-7 sm:my-10">--}}
                {{--<div class="max-w-xs sm:max-w-full w-full md:w-1/2 px-2 md:px-3 relative">--}}
                    {{--<p  class="w-full px-4 pt-2 pb-4 -mb-3 bg-guitareo text-black rounded-t-2xl bg-pianote text-white">--}}
                            {{--<strong>LAUNCH SPECIAL</strong>--}}
                    {{--</p>--}}
                    {{--<a href="{{ url()->route('shopping-cart.add-to-cart', ['products' => ['the-power-of-chords' => 1, 'piano-chords-and-scales-guide' => 1], 'redirect' => '/order', 'locked' => 'true']) }}" class="text-black overflow-hidden rounded-2xl block mx-auto mb-4 md:mb-0 border border-gray-300 group">--}}
                        {{--<div class="bg-white px-3 pt-6 md:pt-8 pb-5 md:pb-8">--}}
                            {{--<h5 class="leading-none mb-3">Power Of Chords</h5>--}}
                            {{--<h1 class="inline-block leading-none text-4xl lg:text-5xl">--}}
                                {{--<s style="color:#BBBBBF;">${{ floatval($productPrices['the-power-of-chords']->price) }}</s>--}}
                                {{--<strong>${{ $productPrice }}</strong></h1>--}}
                            {{--<p class="text-sm my-4">--}}
                                {{--<em>Save {{ round(100 - (100 * (floatval($productPrices['the-power-of-chords']->discounted_price) / floatval($productPrices['the-power-of-chords']->price)))) }}% for a limited time.</em>--}}
                            {{--</p>--}}
                            {{--<div class="mt-4 join smaller w-full transition-opacity duration-300 group-hover:opacity-80"--}}
                                    {{--style="max-width: 230px;">Get Started--}}
                            {{--</div>--}}
                        {{--</div>--}}
                        {{--<div class="px-3 pt-5 md:pt-6 pb-9 md:pb-10"--}}
                             {{--style="background: #F8FBFF;">--}}
                            {{--<p class="mb-1"><strong class="font-extrabold">WHAT'S INCLUDED</strong></p>--}}
                            {{--<p class="mb-1">Lifetime access to The Power of Chords</p>--}}
                            {{--<p class="mb-1">Chords & Scales Book (FREE shipping)</p>--}}
                            {{--<p class="hidden md:block">&nbsp;</p>--}}
                            {{--<p class="hidden md:block">&nbsp;</p>--}}
                        {{--</div>--}}
                    {{--</a>--}}
                {{--</div>--}}
                {{--<div class="max-w-xs sm:max-w-full w-full md:w-1/2 px-2 md:px-3 relative">--}}
                    {{--<p  class="w-full px-4 pt-2 pb-4 -mb-3 bg-guitareo text-white rounded-t-2xl"--}}
                        {{--style="background: #FFAE00;">--}}
                            {{--<strong>LIMITED TIME PIANOTE DEAL</strong>--}}
                    {{--</p>--}}
                    {{--<a href="{{ url()->route('shopping-cart.add-to-cart', ['products' => ['PIANOTE-MEMBERSHIP-1-YEAR' => 1, 'the-power-of-chords' => 1, '500-songs-in-5-days' => 1, 'piano-chords-and-scales-guide' => 1,], 'redirect' => '/order', 'locked' => 'true']) }}" class="text-black overflow-hidden rounded-2xl block mx-auto mb-4 md:mb-0 border border-gray-300 group">--}}
                        {{--<div class="bg-white px-3 pt-6 md:pt-8 pb-5 md:pb-8">--}}
                            {{--<h5 class="leading-none mb-3">Power Of Chords + Pianote</h5>--}}
                            {{--<h1 class="inline-block leading-none text-4xl lg:text-5xl">--}}
                                {{--<strong>${{ Prices::$plusSubscriptionAnnual }}</strong>--}}
                            {{--</h1><p class="inline-block">/yr</p>--}}
                            {{--<p class="text-coaches text-sm my-4"><em>Annual Pianote Membership included.</em></p>--}}
                            {{--<div class="join smaller coaches w-full transition-opacity duration-300 group-hover:opacity-80"--}}
                                    {{--style="max-width: 230px; background: #FFAE00;">Get Started--}}
                            {{--</div>--}}
                        {{--</div>--}}
                        {{--<div class="px-3 pt-5 md:pt-6 pb-9 md:pb-10" style="background: #F8FBFF; ">--}}
                            {{--<p class="mb-1"><strong class="font-extrabold">WHAT'S INCLUDED</strong></p>--}}
                            {{--<p class="mb-1">Annual Pianote Membership</p>--}}
                            {{--<p class="mb-1">Lifetime access to The Power of Chords</p>--}}
                            {{--<p class="mb-1">Lifetime access to 500 Songs in 5 Days</p>--}}
                            {{--<p>Chords & Scales Book (FREE shipping)</p>--}}
                        {{--</div>--}}
                    {{--</a>--}}
                {{--</div>--}}
            {{--</div>--}}

            <a class="join w-full my-5 sm:my-7" href="@yield('order-link')" >Get Started</a>
            <h6 class="leading-tight text-center mb-1 md:mb-2">

                <strong>ONLY</strong>
                @if(floatval($productPrices['the-power-of-chords']->price) > $productPrice)
                    <s class="text-gray-400">${{ floatval($productPrices['the-power-of-chords']->price) }}</s>
                    <strong>${{ $productPrice }}</strong>
                    <em>({{ round(100 - (100 * ($productPrice / floatval($productPrices['the-power-of-chords']->price)))) }}% Off)</em>
                @else
                    <strong>${{ $productPrice }}</strong>
                @endif
                @yield('countdown')
            </h6>
            @if($productPrice !== 0)
                <p class="text-center text-gray-400">
                    <a class="text-pianote" href="/"> (OR FREE WITH A PIANOTE MEMBERSHIP)</a><br>
                    ** 90-DAY GUARANTEE **
                </p>
            @endif
        </div>
    </section>
    <section class="content-section text-center" style="background: #00101D;">
        <div class="container mx-auto relative z-50">
            <div class="inline-block w-full px-3 md:px-4 mb-5 text-light-navy">
                <p><strong>Any questions?</strong><br class="inline-block md:hidden"> Call us toll-free at
                    <a href="tel:+18004398921">1-800-439-8921</a> <br class="inline-block md:hidden"> or directly at
                    <a href="tel:+16048557605">1-604-855-7605</a>.<br> All prices listed in USD. </p>
            </div>
            <div class="inline-block w-full px-3 md:px-4 text-light-navy" style="margin-top: 0;">
                <i class="mx-0.5 text-3xl md:text-4xl fab fa-cc-visa"></i>
                <i class="mx-0.5 text-3xl md:text-4xl fab fa-cc-mastercard"></i>
                <i class="mx-0.5 text-3xl md:text-4xl fab fa-cc-amex"></i>
                <i class="mx-0.5 text-3xl md:text-4xl fab fa-cc-paypal"></i>
                <i class="mx-0.5 text-3xl md:text-4xl fab fa-cc-discover"></i>
            </div>
        </div>
    </section>

    @include('pianote.lead-gen.partials.video-player',[
        "name" => "sample",
        "vimeoId" => "681588973",
    ])
    @include('pianote.lead-gen.partials.video-player',[
        "name" => "meetlisa",
        "vimeoId" => "676401508",
    ])

    @foreach ($modalImages as $key => $img)
        @include('pianote.products.partials.image-modal',[
            'id' => "seeInside".$key,
            "image" => $img,
            "imageName" => "seeInside".$key,
        ])
    @endforeach

    @include('pianote.sales.partials._footer')

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script type="text/javascript" src="{{ asset('/marketing/js/modal.js') }}"></script>
    <script>
        $(document).ready(function(){
            $(document).foundation();

            let imgNum = 1;

            $('.image-modal-arrow-left').on('click', function(){
                if(imgNum === 0){
                    imgNum = 2;
                }
                else {
                    imgNum--;
                }

                $('#seeInside' + imgNum).find('img').each(function(){
                    const imgSrc = $(this);
                    $('#seeInside1').find('img').attr('src', imgSrc.data('src'))
                })
            })

            $('.image-modal-arrow-right').on('click', function(){
                if(imgNum === 2){
                    imgNum = 0;
                }
                else {
                    imgNum++;
                }

                $('#seeInside' + imgNum).find('img').each(function(){
                    const imgSrc = $(this);
                    $('#seeInside1').find('img').attr('src', imgSrc.data('src'))
                })
            })
        })
    </script>
    <script type="text/javascript" src="{{ asset('/marketing/js/modal-autoplay.js') }}"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.min.js"></script>
    <script type="text/javascript" src="{{ asset('/marketing/parcel/drumeo/navigation-sales.js') }}"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/lazysizes/5.3.2/lazysizes.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/lazysizes/5.3.2/plugins/unveilhooks/ls.unveilhooks.min.js"></script>

    {{-- Platform --}}
    <script src="{{ mix('/platform/js/manifest.js') }}"></script>
    <script src="{{ mix('/platform/js/vendor.js') }}"></script>
    <script src="{{ mix('/platform/js/app.js') }}"></script>


@endsection
