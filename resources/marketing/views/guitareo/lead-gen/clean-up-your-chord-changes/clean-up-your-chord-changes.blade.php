@php
    $steps = [
        [
            'position' => 'left',
            'img' => 'https://guitareo.s3.amazonaws.com/lead-gen/clean-up-chords/Step1.jpg',
            'desc' => 'Enter your email address. It’s free. That’s right - 100% free!'
        ],
        [
            'position' => 'right',
            'img' => 'https://guitareo.s3.amazonaws.com/lead-gen/clean-up-chords/Step2.jpg',
            'desc' => 'Access your unique link for your LIVE lesson with Ayla and Kent.'
        ],
        [
            'position' => 'left',
            'img' => 'https://guitareo.s3.amazonaws.com/lead-gen/clean-up-chords/Step3.jpg',
            'desc' => 'Get your downloadable resources, and practice tips, and connect with Ayla and Kent.'
        ],
        [
            'position' => 'right',
            'img' => 'https://guitareo.s3.amazonaws.com/lead-gen/clean-up-chords/Step4.jpg',
            'desc' => 'Share your progress (if you want - it’s totally up to you).'
        ],
        [
            'position' => 'left',
            'img' => 'https://guitareo.s3.amazonaws.com/lead-gen/clean-up-chords/Step5.jpg',
            'desc' => 'Play guitar BETTER!'
        ],
      ];
@endphp

@extends('guitareo.lead-gen.lead-gen-layout-tw')

@section('meta')
    <title>Clean Up Your Chord Changes | Guitareo</title>
    <meta property="og:title" content="Clean Up Your Chord Changes | Guitareo">
    <meta name="description" content="Join this 60-minute LIVE guitar lesson with Ayla Tesler-Mabe and Kent Shores"/>
    <meta property="og:description" content="Join this 60-minute LIVE guitar lesson with Ayla Tesler-Mabe and Kent Shores">

    <meta property="og:image" content="https://guitareo.s3.amazonaws.com/lead-gen/clean-up-chords/share_image.jpg">
    <meta property="og:url" content="https://www.guitareo.com/clean-up-chords/">

    @parent

    @include('_partials.layout._tailwindcdn')
    <link rel="preload" href="{{ asset('/marketing/parcel/guitareo/song-in-an-hour.css') }}" as="style" onload="this.onload=null;this.rel='stylesheet'">
    <noscript><link rel="stylesheet" href="{{ asset('/marketing/parcel/guitareo/song-in-an-hour.css') }}"></noscript>
    <style>
        body {
            counter-reset: timeline;
        }

        .header {
            background-image: url('https://cdn.musora.com/image/fetch/w_700,q_auto:best/https://guitareo.s3.amazonaws.com/lead-gen/clean-up-chords/header_bg_m.png');
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
            background-image: url('https://cdn.musora.com/image/fetch/w_700,q_auto:best/https://guitareo.s3.amazonaws.com/lead-gen/clean-up-chords/footer-bg-m.png');
        }

        @media (min-width: 426px) {
            .header {
                background-size: 430px;
            }
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
                background-image: url('https://cdn.musora.com/image/fetch/w_2000,q_auto:best/https://guitareo.s3.amazonaws.com/lead-gen/clean-up-chords/header_bg.jpg');
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
                background-image: url('https://cdn.musora.com/image/fetch/w_1500,q_auto:best/https://guitareo.s3.amazonaws.com/lead-gen/clean-up-chords/Footer_bg.jpg');
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
                <div class="w-full md:w-8/12 lg:w-2/3 md:text-left">
                    <div class="mt-40 md:mt-0 sm:pl-3">
                        <img class="h-28 lg:h-36 mx-auto md:mx-0 lazyload" data-src="https://cdn.musora.com/image/fetch/w_350,q_auto:best/https://guitareo.s3.amazonaws.com/lead-gen/clean-up-chords/logo.png" alt="logo">
                        <p class="leading-tight mt-2 md:mt-5 mb-2 md:mb-4">
                            <strong class="font-bold">Free 60-minute beginner guitar lesson</strong> <br>with Ayla Tesler-Mabe and Kent Shores
                        </p>
                        <div class="flex justify-center items-center md:justify-start mb-2 md:mb-6">
                            <div class="align-middle bg-white text-center rounded-lg inline-block overflow-hidden w-11 mr-2">
                                <p class="leading-none tracking-tighter text-xs py-0.5 text-white" style="background-color:#bb3744;"><strong>OCT</strong></p>
                                <p class="leading-none text-lg py-1 text-black"><strong class="font-black">12</strong></p>
                            </div>
                            <p class="leading-tight mx-0 text-guitareo text-left inline-block">
                                <a target="_blank" href="https://www.google.com/search?q=11am+PDT" class="no-underline uppercase"><strong class="font-extrabold">Wednesday, Oct. 12 @ 11am PT</strong></a><br class="inline-block md:hidden">
                                <br>SIGN UP FOR NOTICE ON THE NEXT EVENT
                            </p>
                        </div>
{{--                        <p class="italic text-sm mb-2 md:mb-6">--}}
{{--                            Join this 60-minute LIVE guitar lesson with Ayla Tesler-Mabe <br class="hidden md:inline lg:hidden">and Kent Shores--}}
{{--                        </p>--}}
                    </div>
                    <div class="md:max-w-md lg:max-w-auto lg:w-2/3">
                        @include('guitareo.lead-gen.partials._sign-up-form-tw', [
                            "formId" => "Guitareo - Engagement - Trigger - Website Signup - Web Form",
                            "formName" => 'Blog Signup',
                            "buttonText" => "Notify Me!",
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
                <img class="md:order-1 rounded-md mb-7 md:mb-0 md:w-auto mx-auto lazyload" data-src="https://cdn.musora.com/image/fetch/w_500,q_auto:best/https://guitareo.s3.amazonaws.com/lead-gen/clean-up-chords/collage.png" alt="intro image">
                <div class="inline-flex flex-col">
                    <h3 class="font-extrabold mx-0 mb-4 sm:mb-6 leading-tight">
                        Struggling to switch between guitar chords?
                    </h3>
                    <p class="sm:leading-tight md:leading-normal sm:max-w-lg md:max-w-auto" style="color:#A4AFC7;">
                        When you’re preoccupied with placing fingers down on the fretboard, you might get awkward pauses in your strumming. And the songs you play can sound, well, broken. <br><br>
                        Join this lesson with Ayla Tesler-Mabe and Kent Shores to gain tips on how to transition seamlessly between chords – by paying special attention to both hands. You will start to hear the difference right away when playing music! <br><br>
                        Ultimately, you’ll learn how to smooth out any chord transition with this lesson.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <section class="pt-10 pb-20" style="background:#000C17;">
        <div class="max-w-sm sm:max-w-4xl mx-auto text-white px-2 sm:px-4 md:px-0">
            <h5 class="text-center font-extrabold leading-normal">
                This 60-minute LIVE lesson is designed to help you optimize <br class="hidden sm:inline-block">your guitar playing sessions – for today and beyond.
            </h5>
            <div class="flex flex-wrap items-start justify-center text-center mt-5 md:mt-7 sm:gap-16 mb-10">
                <div class="w-full sm:flex-1 mb-8 sm:mb-0">
                    <img class="h-12 mb-4 inline-block" src="https://guitareo.s3.amazonaws.com/lead-gen/clean-up-chords/guitar_icon.svg" alt="guitar icon">
                    <p class="leading-normal max-w-xs md:max-w-full">Master a few essential chords you’ll need for playing guitar</p>
                </div>
                <div class="w-full sm:flex-1 mb-8 sm:mb-0">
                    <img class="h-12 mb-4 inline-block" src="https://guitareo.s3.amazonaws.com/lead-gen/clean-up-chords/strum_icon.svg" alt="strum icon">
                    <p class="leading-normal max-w-xs md:max-w-full">Learn to transition between chords, seamlessly</p>
                </div>
                <div class="w-full sm:flex-1">
                    <img class="h-12 mb-4 inline-block" src="https://guitareo.s3.amazonaws.com/lead-gen/clean-up-chords/music_icon.svg" alt="music icon">
                    <p class="leading-normal max-w-xs md:max-w-full">Put it all together by playing a classic Bill Withers song</p>
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
            <h3 class="font-extrabold text-center mb-4 sm:mb-6 md:mb-10">
                How it works:
            </h3>
            <div class="timeline-container relative mx-auto -mb-16 md:-mb-16 lg:-mb-28">
                @foreach ($steps as $key => $step)
                    @if($step['position'] === 'right')
                        <div class="timeline relative flex flex-col-reverse md:grid md:grid-cols-2 gap-2 md:gap-12 lg:gap-20 mb-16 md:mb-0 md:mb-16 lg:mb-28 pl-6 md:pl-0">
                            <div class="content relative flex items-center justify-center">
                                <div class="md:max-w-xs lg:max-w-md w-full">
                                    <h4 class="font-extrabold uppercase mb-2">step {{$key+1}}</h4>
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
            <div class="sm:grid sm:grid-cols-2 items-center text-center gap-14">
                <div class="md:text-right">
                    <img class="inline-block rounded-md h-72 sm:h-80 lg:h-96 mb-7 sm:mb-0 mx-auto lazyload" data-src="https://cdn.musora.com/image/fetch/w_400,q_auto:best/https://guitareo.s3.amazonaws.com/lead-gen/clean-up-chords/ui.png" alt="intro image">
                </div>
                <div class="inline-flex flex-col text-left">
                    <h3 class="font-extrabold mb-2 sm:mb-3 leading-tight text-left mx-0">
                        These aren’t <br>
                        YouTube lessons…
                    </h3>
                    <p style="color:#6A6868;">
                        This isn’t your regular push play and sit back.
                        <br><br>
                        You’ll be LIVE with real guitar coaches, Ayla Tesler-Mabe and Kent Shores!
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
        <h3 class="text-white text-center font-extrabold">Meet your guitar teachers</h3>
        <div class="max-w-3xl lg:max-w-4xl mx-auto relative mt-6 md:mt-14">
            <div class="w-3/4 sm:w-2/3 mx-auto relative md:static text-center mb-2 md:mb-8">
                <picture>
                    <source media="(min-width: 768px)" srcset="https://cdn.musora.com/image/fetch/w_500,q_auto:best/https://guitareo.s3.amazonaws.com/lead-gen/clean-up-chords/Ayla.png">
                    <img class="md:w-80 lg:w-96 md:absolute md:top-20 lg:-top-2 -right-0 lg:-right-2 lg:border-8 md:rounded-3xl lg:border-solid lazyload" data-src="https://cdn.musora.com/image/fetch/w_500,q_auto:best/https://guitareo.s3.amazonaws.com/lead-gen/clean-up-chords/Ayla_m.png" alt="coach image" style="border-color: #000C17;">
                </picture>
            </div>

            <div class="mx-auto md:mx-0 max-w-md sm:max-w-lg md:max-w-full md:w-2/3 rounded-xl p-4 sm:p-10 md:py-10 md:pl-8 md:pr-24 lg:p-10 lg:pr-28 bg-guitareo">
                <p class="text-sm sm:text-base sm:leading-tight md:leading-normal">
                    Ayla Tesler-Mabe has made a splash in the music industry as a professional guitarist, vocalist, and songwriter – playing in popular bands including Ludic and formally Calpurnia. And while she’s actively creating new music and performing, Ayla’s also passionate about helping students with Guitareo every day! <br><br>
                    Ayla’s no stranger to answering questions candidly, lending advice, and starting conversations about all things guitar – and her teaching style makes students feel comfortable and encouraged so you’ll keep practicing and developing your skills.
                </p>
             </div>
        </div>

        <div class="max-w-3xl lg:max-w-4xl mx-auto relative mt-6 md:mt-40 md:text-right">
            <div class="w-3/4 sm:w-2/3 mx-auto relative md:static text-center mb-6 md:mb-8">
                <picture>
                    <source media="(min-width: 768px)" srcset="https://cdn.musora.com/image/fetch/w_500,q_auto:best/https://guitareo.s3.amazonaws.com/lead-gen/clean-up-chords/Kent.png">
                    <img class="md:w-80 lg:w-96 md:absolute -top-20 -left-0 lg:-left-2 md:rounded-3xl lazyload" data-src="https://cdn.musora.com/image/fetch/w_500,q_auto:best/https://guitareo.s3.amazonaws.com/lead-gen/clean-up-chords/Kent_m.png" alt="coach image" style="border-color: #000C17;">
                </picture>
            </div>

            <div class="mx-auto md:mx-0 max-w-md sm:max-w-lg md:max-w-full md:w-2/3 rounded-xl p-4 sm:p-10 md:py-10 md:pl-8 md:pr-24 lg:p-10 lg:pr-28 bg-guitareo inline-block text-left">
                <p class="text-sm sm:text-base sm:leading-tight md:leading-normal md:pl-20">
                    Kent holds a degree from the University of North Texas in Jazz Studies - Guitar Performance with a Minor in Music Theory and has performed across Canada, the United States, and India with various bands. <br><br>
                    As an educator, Kent has over 10 years of experience teaching lessons ranging from complete beginners to more advanced players. His teaching philosophy is all about bringing out the best in his students and fostering a love of music. <br><br>
                    He strives to make sure that music lessons are fun and enjoyable. He enjoys sharing music with his students and celebrating their achievements.
                </p>
             </div>
        </div>
    </section>

    <section class="py-20 sm:py-28 bg-cover lazyload footer" style="background-color:#3d151a;background-position: 25% 50%;">
        <div class="max-w-md md:max-w-2xl lg:max-w-3xl mx-auto text-center text-white px-4">
            <img class="lazyload h-32 mx-auto" data-src="https://cdn.musora.com/image/fetch/w_350,q_auto:best/https://guitareo.s3.amazonaws.com/lead-gen/clean-up-chords/logo.png" alt="logo">
            <h6 class="my-2 leading-normal">
                <strong class="font-bold">Free 60-minute beginner guitar lesson</strong> <br class="inline md:hidden"> with Ayla Tesler-Mabe and Kent Shores
                <br>
                 <strong class="text-yellow uppercase md:mt-2 mb-6">SIGN UP FOR NOTICE ON THE NEXT EVENT</strong>
            </h6>

            @include('guitareo.lead-gen.partials._sign-up-form-tw', [
                "formId" => "Guitareo - Engagement - Trigger - Website Signup - Web Form",
                            "formName" => 'Blog Signup',
                            "buttonText" => "Notify Me!",
                'buttonTextColor' => 'black',
                "oneLineLg" => true,
            ])
        </div>
    </section>
@endsection
