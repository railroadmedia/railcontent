@php
    $steps = [
        [
            'position' => 'left',
            'img' => 'https://guitareo.s3.amazonaws.com/lead-gen/back-to-basics/Step1.jpg',
            'desc' => 'Enter your email address. It’s free. That’s right - 100% free!'
        ],
        [
            'position' => 'right',
            'img' => 'https://guitareo.s3.amazonaws.com/lead-gen/back-to-basics/Step2.jpg',
            'desc' => 'Join the Facebook Event. You’ll be emailed the invite.'
        ],
        [
            'position' => 'left',
            'img' => 'https://guitareo.s3.amazonaws.com/lead-gen/back-to-basics/Step3.jpg',
            'desc' => 'Access your special link for your LIVE lesson with Ayla.'
        ],
        [
            'position' => 'right',
            'img' => 'https://guitareo.s3.amazonaws.com/lead-gen/back-to-basics/Step4.jpg',
            'desc' => 'Get your downloadable resources and practice tips, and connect with Ayla.'
        ],
        [
            'position' => 'left',
            'img' => 'https://guitareo.s3.amazonaws.com/lead-gen/back-to-basics/Step5.jpg',
            'desc' => 'Post your progress (if you want - it’s totally up to you).'
        ],
        [
            'position' => 'right',
            'img' => 'https://guitareo.s3.amazonaws.com/lead-gen/back-to-basics/Step6.jpg',
            'desc' => 'Play guitar BETTER!'
        ],
      ];
@endphp

@extends('guitareo.lead-gen.lead-gen-layout-tw')

@section('meta')
    <title>Live Bootcamp | Guitareo</title>
    <meta property="og:title" content="Live Bootcamp | Guitareo">
    <meta name="description" content="Join any of these 60-minute LIVE guitar lessons with Ayla Tesler-Mabe"/>
    <meta property="og:description" content="Join any of these 60-minute LIVE guitar lessons with Ayla Tesler-Mabe">

    <meta property="og:image" content="https://guitareo.s3.amazonaws.com/lead-gen/back-to-basics/share_image.jpg">
    <meta property="og:url" content="https://www.guitareo.com/back-to-basics/">

    @parent

    <link href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.19/tailwind.min.css" rel="stylesheet">
    <link rel="preload" href="/marketing/parcel/guitareo/song-in-an-hour.css" as="style" onload="this.onload=null;this.rel='stylesheet'">
    <noscript><link rel="stylesheet" href="/marketing/parcel/guitareo/song-in-an-hour.css"></noscript>
    <style>
        body {
            counter-reset: timeline;
        }

        .header {
            background-image: url('https://cdn.musora.com/image/fetch/w_700,q_auto:best/https://guitareo.s3.amazonaws.com/lead-gen/back-to-basics/bg_header_m.jpg');
            background-size: cover;
        }

        .border-guitareo {
            border-color: #00c9ac;
        }

        a:visited {
            color: inherit;
        }

        .time-counter {
            font-size: 14px;
        }

         /* vertical line */
         .timeline-container::after {
            content: '';
            position: absolute;
            width: 3px;
            background-color: #00C9AC;
            top: 0;
            bottom: 0;
            left: 4px;
            margin-left: -3px;
        }

        /* circles in the middle */
        .timeline::after {
            counter-increment: timeline;
            content: counter(timeline);;
            position: absolute;
            width: 20px;
            height: 20px;
            font-size: 12px;
            font-weight: 700;
            left: -6px;
            background-color: #00C9AC;
            top: 0px;
            border-radius: 50%;
            z-index: 1;
            color: black;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .timeline-img {
            filter: drop-shadow(4px 4px 10px rgba(0, 0, 0, 0.25));
            border:1px solid #E4E4E4;
        }

        .footer {
            background-image: url('https://cdn.musora.com/image/fetch/w_700,q_auto:best/https://guitareo.s3.amazonaws.com/lead-gen/back-to-basics/footer_bg_m.jpg');
        }

        @media (min-width: 640px) {
            .timeline::after {
                width: 25px;
                height: 25px;
                font-size: 14px;
                left: -10px;
            }
        }


        @media (min-width:768px) {

            .header {
                background-image: url('https://cdn.musora.com/image/fetch/w_2000,q_auto:best/https://guitareo.s3.amazonaws.com/lead-gen/back-to-basics/bg_header.jpg');
                background-size: 1600px;
            }

            .time-counter {
                font-size: 16px;
            }

            .timeline-container::after {
                left: 50%;
            }

            .timeline::after {
                left: 48%;
            }

            .footer {
                background-image: url('https://cdn.musora.com/image/fetch/w_1500,q_auto:best/https://guitareo.s3.amazonaws.com/lead-gen/back-to-basics/footer_bg.jpg');
            }
        }

        @media (min-width:1024px) {

            .time-counter {
                font-size: 17px;
            }

            .timeline::after {
                left: 48.5%;
                width: 30px;
                height: 30px;
                font-size: 16px;
            }
        }
    </style>
@endsection

@section('body')
    <header class="header text-white text-center px-3 py-6 md:py-16 relative bg-no-repeat bg-top" style="background-color:#000C17;">
        <div class="mx-auto relative z-10 max-w-md md:max-w-5xl">
            <div class="flex flex-wrap items-center">
                <div class="w-full md:w-7/12 lg:w-2/3 md:text-left">
                    <div class="mt-56 md:mt-0 sm:pl-3">
                        <img class="h-28 lg:h-36 mx-auto md:mx-0 lazyload" data-src="https://cdn.musora.com/image/fetch/w_350,q_auto:best/https://guitareo.s3.amazonaws.com/lead-gen/back-to-basics/logo.png" alt="logo">
                        <p class="leading-tight mt-2 md:mt-5 mb-2 md:mb-8">
                            <strong class="font-extrabold">Free 60-minute beginner guitar lesson</strong> <br class="lg:hidden">with Ayla Tesler-Mabe
                            <br><strong class="text-yellow uppercase md:mt-2 mb-6">SIGN UP FOR NOTICE ON THE NEXT EVENT</strong>
                            {{--<strong class="text-yellow uppercase hidden md:block md:mt-2">ONLY <span class="tzcd-full">A LIMITED TIME</span> LEFT!</strong>--}}
                            {{--<strong class="text-yellow uppercase block md:hidden mt-2">ONLY <span class="tzcd-small">A LIMITED TIME</span> LEFT!</strong>--}}
                        </p>
                        {{--<div class="flex justify-center items-center md:justify-start mb-2 md:mb-6">--}}
                            {{--<div class="align-middle bg-white text-center rounded-lg inline-block overflow-hidden w-11">--}}
                                {{--<p class="leading-none tracking-tighter text-xs py-0.5 text-white" style="background-color:#bb3744;"><strong>SEPT</strong></p>--}}
                                {{--<p class="leading-none text-lg py-1 text-black"><strong class="font-black">23</strong></p>--}}
                            {{--</div>--}}
                            {{--<p class="leading-tight uppercase ml-2 sm:ml-4 text-white">--}}
                                {{--<a target="_blank" href="https://www.google.com/search?q=10am+PDT" class="text-white no-underline">Morning session <strong class="font-extrabold">10 am PT // 1 pm ET</strong></a><br>--}}
                                {{--<a target="_blank" href="https://www.google.com/search?q=2pm+PDT" class="text-white no-underline">Afternoon session <strong class="font-extrabold">2 pm PT // 5 pm ET</strong></a>--}}
                            {{--</p>--}}
                        {{--</div>--}}
                    </div>
                    <div class="md:max-w-md lg:max-w-auto lg:w-2/3">
                        @include('guitareo.lead-gen.partials._sign-up-form-tw', [
                            "formId" => "Guitareo - Engagement - Trigger - Website Signup - Web Form",
                            "formName" => 'Blog Signup',
                            "buttonText" => "Notify Me",
                            'buttonTextColor' => 'black',
                            "stacked" => true
                        ])
                    </div>
                </div>
            </div>
        </div>
    </header>

    <section class="text-white py-12 sm:py-20 px-4 sm:px-6" style="background:#000C17;">
        <div class="max-w-sm md:max-w-3xl lg:max-w-4xl mx-auto">
            <div class="md:grid md:grid-cols-2 sm:gap-6 md:gap-10 items-center justify-center flex flex-col mx-auto">
                <img class="md:order-1 rounded-md mb-7 md:mb-0 md:w-auto mx-auto lazyload" data-src="https://cdn.musora.com/image/fetch/w_500,q_auto:best/https://guitareo.s3.amazonaws.com/lead-gen/back-to-basics/collage.png" alt="intro image">
                <div class="inline-flex flex-col">
                    <h3 class="font-extrabold mx-0 mb-4 sm:mb-6 leading-tight">
                        Get motivated with <br>pain-free & fun guitar playing.
                    </h3>
                    <p class="sm:leading-tight md:leading-normal sm:max-w-lg md:max-w-auto" style="color:#A4AFC7;">
                        Let’s face it – getting started (or restarting) on the guitar can be tough. Your fingertips hurt from holding those strings down and your chords don’t sound good. Not seeing any quick results and feeling uncomfortable while playing guitar can lead you to quit soon after.
                        <br><br>
                        So join any of these lessons with Ayla Tesler-Mabe and learn tips on feeling comfortable from the get-go – so you can keep up with your practice sessions, pain-free. You'll have more fun playing guitar and ultimately improve quicker on the guitar!
                    </p>
                </div>
            </div>
        </div>
    </section>

    <section class="pt-10 pb-20" style="background:#000C17;">
        <div class="max-w-sm sm:max-w-4xl mx-auto text-white px-2 sm:px-4 md:px-0">
            <h5 class="text-center font-extrabold leading-normal">
                These 60-minute LIVE lessons have been designed to help you optimize <br class="hidden sm:inline-block">your guitar playing sessions – for today and beyond.
            </h5>
            <div class="flex flex-wrap items-start justify-center text-center mt-5 md:mt-7 sm:gap-16 mb-8 sm:mb-10">
                <div class="w-full sm:flex-1 mb-8 sm:mb-0">
                    <h5 class="text-guitareo border-guitareo border border-solid rounded-full inline-block py-2.5 px-3 mb-1">1.</h5>
                    <p class="leading-normal">Learn how to create the optimal environment and body posture for playing guitar.</p>
                </div>
                <div class="w-full sm:flex-1 mb-8 sm:mb-0">
                    <h5 class="text-guitareo border-guitareo border border-solid rounded-full inline-block py-2.5 px-3 mb-1">2.</h5>
                    <p class="leading-normal">Try new warm-up exercises to help your fingertips become nimbler and tougher.
                    </p>
                </div>
                <div class="w-full sm:flex-1">
                    <h5 class="text-guitareo border-guitareo border border-solid rounded-full inline-block py-2.5 px-3 mb-1">3.</h5>
                    <p class="leading-normal">Play a cool riff from an iconic song using the pentatonic scale at the very end!</p>
                </div>
            </div>
            <p class="text-center">
                By the end of this fun lesson, you’ll walk away feeling good and wanting to play more guitar!
            </p>
        </div>
    </section>

    {{-- diagonal line --}}
    <div class="relative h-5 sm:h-7 -mb-5 sm:-mb-7" style="background: linear-gradient(to top left, #FAFAFA calc(50% - 1px), transparent, #000C17 calc(50% + 1px));"></div>
    <section class="px-4 sm:px-6 py-12 sm:py-20" style="background-color: #FAFAFA;">
        <div class="max-w-3xl lg:max-w-4xl mx-auto">
            <h2 class="font-extrabold text-center mb-4 sm:mb-6 md:mb-10">
                How it works:
            </h2>
            <div class="timeline-container relative mx-auto -mb-16 md:-mb-16 lg:-mb-28">
                @foreach ($steps as $key => $step)
                    @if($step['position'] === 'right')
                        <div class="timeline relative flex flex-col-reverse md:grid md:grid-cols-2 gap-2 md:gap-12 lg:gap-20 mb-16 md:mb-0 md:mb-16 lg:mb-28 pl-6 md:pl-0">
                            <div class="content relative flex items-center justify-center">
                                <div class="md:max-w-xs lg:max-w-md w-full">
                                    <h4 class="font-extrabold uppercase lg:mb-2">step {{$key+1}}</h4>
                                    <p class="lg:text-lg" style="color:#6A6868;">
                                        {{ $step['desc'] }}
                                    </p>
                                </div>
                            </div>
                            <img class="timeline-img rounded-lg lazyload mb-4 md:mb-0" data-src="https://cdn.musora.com/image/fetch/w_1000,q_auto:best/{{ $step['img'] }}" alt="step {{$key+1}}" />
                        </div>
                    @else
                        <div class="timeline relative flex flex-col md:grid md:grid-cols-2 gap-2 md:gap-12 lg:gap-20 mb-16 md:mb-16 lg:mb-28 pl-6 md:pl-0">
                            <img class="timeline-img rounded-lg lazyload mb-4 md:mb-0" data-src="https://cdn.musora.com/image/fetch/w_1000,q_auto:best/{{ $step['img'] }}" alt="step {{$key+1}}" />
                            <div class="content relative flex items-center justify-center">
                                <div class="md:max-w-xs lg:max-w-md w-full">
                                    <h4 class="font-extrabold uppercase lg:mb-2">step {{$key+1}}</h4>
                                    <p class="lg:text-lg" style="color:#6A6868;">
                                        {{ $step['desc'] }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    @endif

                @endforeach
            </div>
        </div>
    </section>

    <section class="px-4 py-12 sm:py-20" style="background-color: #FAFAFA;">
        <div class="max-w-md sm:max-w-3xl lg:max-w-6xl mx-auto">
            <div class="sm:grid sm:grid-cols-2 sm:gap-6 md:gap-12 lg:gap-20 items-center text-center">
                <img class="rounded-md h-72 sm:h-80 lg:h-96 mb-7 sm:mb-0 mx-auto lazyload" data-src="https://cdn.musora.com/image/fetch/w_400,q_auto:best/https://guitareo.s3.amazonaws.com/lead-gen/back-to-basics/ui.png" alt="intro image">
                <div class="inline-flex flex-col text-left">
                    <h3 class="font-extrabold mb-2 sm:mb-3 leading-tight text-left mx-0">
                        These aren’t <br>
                        YouTube lessons…
                    </h3>
                    <p class="leading-tight" style="color:#6A6868;">
                        This isn’t your regular push play and sit back.
                        <br><br>
                        You’ll be LIVE with a real guitar coach, Ayla Tesler-Mabe!
                        <br><br>
                        That means you can ask questions, get feedback and advice, and hear the difference in your guitar playing as it’s happening. Without having to fork out hundreds of dollars for a private lesson.
                        <br><br>
                        You’ll also meet guitarists from all over the world who are going through the same journey.
                    </p>
                </div>
            </div>
        </div>
    </section>

    {{-- diagonal line --}}
    <div class="relative h-5 sm:h-7 -mb-5 sm:-mb-7" style="background: linear-gradient(to top left, transparent calc(50% - 1px), transparent, #fafafa calc(50% + 1px));"></div>
    <section class="px-4 py-14 sm:py-20 md:pb-32" style="background:#000C17;">
        <div class="max-w-3xl lg:max-w-4xl mx-auto relative">
            <div class="w-3/4 sm:w-2/3 mx-auto relative md:static text-center mb-8">
                <picture>
                    <source media="(min-width: 768px)" srcset="https://cdn.musora.com/image/fetch/w_500,q_auto:best/https://guitareo.s3.amazonaws.com/lead-gen/back-to-basics/coach_profile.png">
                    <img class="md:w-80 lg:w-96 md:absolute -bottom-10 -right-0 lg:-right-2 md:border-8 rounded-3xl md:border-solid lazyload" data-src="https://cdn.musora.com/image/fetch/w_500,q_auto:best/https://guitareo.s3.amazonaws.com/lead-gen/back-to-basics/coach_profile_m.png" alt="coach image" style="border-color: #000C17;">
                </picture>
            </div>

            <div class="mx-auto md:mx-0 max-w-md sm:max-w-lg md:max-w-full md:w-2/3 rounded-xl p-4 sm:p-10 md:py-10 md:pl-8 md:pr-24 lg:p-10 lg:pr-28 bg-guitareo  ">
                <h3 class="leading-tight mb-2 sm:mb-3">
                    <strong>Meet your guitar teacher.</strong>
                </h3>
                <p class="text-sm sm:text-base sm:leading-tight md:leading-normal">
                    Ayla Tesler-Mabe has made a splash in the music industry as a professional guitarist, vocalist, and songwriter – playing in popular bands including Ludic and formally Calpurnia. And while she’s actively creating new music and performing, Ayla’s also passionate about helping students with Guitareo every day!
                    <br><br>
                    Ayla’s no stranger to answering questions candidly, lending advice, and starting conversations about all things guitar – and her teaching style makes students feel comfortable and encouraged so you’ll keep practicing and developing your skills.
                    <br><br>
                    Join any of these free lessons – and you’ll be inspired and smiling from the first LIVE lesson.
                </p>
             </div>
        </div>
    </section>

    <section class="py-20 sm:py-28 bg-cover lazyload footer" style="background-color:#3d151a;background-position: 25% 50%;">
        <div class="max-w-md md:max-w-2xl lg:max-w-3xl mx-auto text-center text-white px-4">
            <img class="lazyload h-32 mx-auto" data-src="https://cdn.musora.com/image/fetch/w_350,q_auto:best/https://guitareo.s3.amazonaws.com/lead-gen/back-to-basics/logo.png" alt="logo">
            <h6 class="my-2 leading-normal">
                <strong class="font-extrabold">Free 60-minute beginner guitar lesson</strong> <br class="inline md:hidden"> with Ayla Tesler-Mabe
                <br><strong class="text-yellow uppercase md:mt-2 mb-6">SIGN UP FOR NOTICE ON THE NEXT EVENT</strong>
                {{--<strong class="text-yellow uppercase hidden md:block md:mt-2 mb-6">ONLY <span class="tzcd-full">A LIMITED TIME</span> LEFT!</strong>--}}
                {{--<strong class="text-yellow uppercase block md:hidden mt-2 mb-6">ONLY <span class="tzcd-small">A LIMITED TIME</span> LEFT!</strong>--}}
            </h6>

            @include('guitareo.lead-gen.partials._sign-up-form-tw', [
                "formId" => "Guitareo - Engagement - Trigger - Website Signup - Web Form",
                "formName" => 'Blog Signup',
                "buttonText" => "Notify Me",
                'buttonTextColor' => 'black',
                "oneLineLg" => true,
            ])
        </div>
    </section>
@endsection
