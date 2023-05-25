@php
    $steps = [
          [
              'position' => 'left',
              'img' => 'https://www.musora.com/musora-cdn/image/width=1000,quality=85/https://d21xeg6s76swyd.cloudfront.net/lead-gen/harmony-bootcamp/step1.jpg',
              'desc' => 'Enter your email address. It’s free. <br class="hidden md:inline">That’s right - 100% free!'
          ],
          [
              'position' => 'right',
              'img' => 'https://www.musora.com/musora-cdn/image/width=1000,quality=85/https://d21xeg6s76swyd.cloudfront.net/lead-gen/harmony-bootcamp/step2.jpg',
              'desc' => 'Get your Email invitation to the livestream.'
          ],
          [
              'position' => 'left',
              'img' => 'https://www.musora.com/musora-cdn/image/width=1000,quality=85/https://d21xeg6s76swyd.cloudfront.net/lead-gen/beginner-vocal-bootcamp/step3.jpg',
              'desc' => 'Log in for your 60-minute LIVE lessons with Lisa.'
          ],
          [
              'position' => 'right',
              'img' => 'https://www.musora.com/musora-cdn/image/width=1000,quality=85/https://d21xeg6s76swyd.cloudfront.net/lead-gen/beginner-vocal-bootcamp/step4.jpg',
              'desc' => 'Get your downloadable resources, practice tips, and connect with Lisa.'
          ],
          [
              'position' => 'left',
              'img' => 'https://www.musora.com/musora-cdn/image/width=1000,quality=85/https://d21xeg6s76swyd.cloudfront.net/lead-gen/beginner-vocal-bootcamp/step5.jpg',
              'desc' => 'Post your progress <br class="hidden md:inline">(if you want - it’s totally up to you).'
          ],
          [
              'position' => 'right',
              'img' => 'https://www.musora.com/musora-cdn/image/width=1000,quality=85/https://d21xeg6s76swyd.cloudfront.net/lead-gen/harmony-bootcamp/step6.jpg',
              'desc' => 'Sing INCREDIBLE harmonies!'
          ],
      ];
@endphp


@extends('singeo.lead-gen.lead-gen-layout')

@section('styles')
    <title>Harmony Bootcamp | Singeo</title>
    <meta property="og:title" content="Harmony Bootcamp | Singeo">
    <meta name="description" content="Learn how to sing beautiful harmonies with this FREE singing lesson from a vocal coach."/>
    <meta property="og:description" content="Learn how to sing beautiful harmonies with this FREE singing lesson from a vocal coach.">
    <meta property="og:image" content="https://d21xeg6s76swyd.cloudfront.net/lead-gen/harmony-bootcamp/fb_share_image.jpg">
    <meta property="og:url" content="https://www.singeo.com/live-bootcamp/">

    <link rel="stylesheet" href="{{ asset('/marketing/parcel/drumeo/lead-gen-singeo.css') }}">

    <style>
        body {
            counter-reset: timeline;
        }

        .header {
            background-position: top;
            background-size: cover;
            background-image: url('https://www.musora.com/musora-cdn/image/width=700,quality=85/https://d21xeg6s76swyd.cloudfront.net/lead-gen/harmony-bootcamp/header_m.jpg');
        }

        .text-yellow {
            color: #FFAC00;
        }

        .header .sub-header {
            font-size: 18px;
        }

        .time-counter {
            font-size: 14px;
        }

        /* vertical line */
        .timeline-container::after {
            content: '';
            position: absolute;
            width: 3px;
            background-color: #7917E1;
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
            left: -6px;
            background-color: #7917E1;
            top: 0px;
            border-radius: 50%;
            z-index: 1;
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .timeline-img {
            filter: drop-shadow(4px 4px 10px rgba(0, 0, 0, 0.25));
            border:1px solid #E4E4E4;
        }

        @media (min-width: 640px) {

            .timeline::after {
                width: 25px;
                height: 25px;
                font-size: 14px;
                left: -10px;
            }
        }

        @media (min-width: 768px) {
            .header {
                background-image: url('https://www.musora.com/musora-cdn/image/width=2000,quality=85/https://d21xeg6s76swyd.cloudfront.net/lead-gen/harmony-bootcamp/header_bg.jpg');
                background-size: 1910px;
            }

            .header .sub-header {
                font-size: 17px;
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
        }

        @media (min-width: 1024px) {
            .time-counter {
                font-size: 17px;
            }

            .header .sub-header {
                font-size: 20px;
            }

            .timeline::after {
                left: 48.5%;
                width: 30px;
                height: 30px;
                font-size: 16px;
            }
        }
    </style>
    @parent
@endsection

@section('body')
    <header class="header text-white text-center px-5 sm:px-6 py-6 md:py-20 lg:py-28 relative bg-no-repeat" style="background-color:#33005c;">
        <div class="mx-auto relative z-10 max-w-md md:max-w-5xl">
            <div class="flex flex-wrap items-center">
                <div class="w-full md:w-2/3 lg:w-1/2 md:text-left mt-40 md:mt-0">
                    <img class="h-28 sm:h-36 lg:h-40 lazyload" data-src="https://www.musora.com/musora-cdn/image/width=840,quality=85/https://d21xeg6s76swyd.cloudfront.net/lead-gen/harmony-bootcamp/logo.png" alt="logo">
                    <h5 class="mt-2 md:mt-5 sub-header mb-5">
                        <strong class="font-extrabold">Free 60-minute LIVE vocal training</strong> <br class="sm:hidden">with Lisa Witt
                    </h5>
                    <div class="flex justify-center items-center md:justify-start mb-2 sm:mb-5">
                        <div class="align-middle bg-white text-center rounded-lg inline-block overflow-hidden w-11 mb-2 md:mb-0 mr-4">
                            <p class="leading-none tracking-tighter text-xs py-0.5 text-white" style="background-color:#bb3744;"><strong>OCT</strong></p>
                            <p class="leading-none text-lg py-1 text-black"><strong class="font-black">19</strong></p>
                        </div>
                        <p class="leading-tight uppercase text-yellow mx-0">
                            <a target="_blank" href="https://www.google.com/search?q=230pm+PDT" class="font-extrabold"><strong>October, Wednesday <br class="sm:hidden">the 19th.  2:30pm PDT</strong> <i class="fal fa-info-circle"></i></a>
                        </p>
                    </div>
                    <h6 class="leading-tight mb-4">
                        Learn how to sing beautiful harmonies with <br>this FREE singing lesson from a vocal coach.
                    </h6>
                    <div class="md:max-w-sm lg:max-w-full">
                        @include("singeo._partials._sign-up-form", [
                            "formId" => 'Singeo - Engagement - Trigger - Harmony Bootcamp - Web Form',
                            "formName" => 'Harmony Bootcamp',
                            "buttonText" => "Save my spot!",
                        ])
                    </div>
                </div>
            </div>
        </div>
    </header>

    <section class="text-white py-12 sm:py-20 px-4 sm:px-6 bg-musora-black">
        <div class="max-w-3xl lg:max-w-6xl mx-auto">
            <div class="md:grid md:grid-cols-2 sm:gap-6 md:gap-16 lg:gap-20 items-center justify-center flex flex-col mx-auto max-w-4xl">
                <div class="mb-10 md:mb-0 inline-flex flex-col">
                    <h3 class="font-extrabold mb-4 sm:mb-6 leading-tight mx-0">
                        Create the <br>extraordinary...
                    </h3>
                    <p class="sm:leading-tight md:leading-normal sm:max-w-lg md:max-w-auto" style="color:#A4AFC7;">
                        Solo melodies can be catchy, but something extraordinary happens when two voices sing in perfect harmony. It takes a song to a whole new level! <br><br>
                        But for many singers – and maybe this is true for you — Harmonies don’t come naturally. <br><br>
                        Most singers, no matter their level, struggle with them. <br><br>
                        But there’s good news! <br><br>
                        Like any other skill, with some time, training and practice… and the right guidance… ANYONE can learn to sing beautiful harmonies.
                    </p>
                </div>
                <img class="rounded-xl sm:w-2/3 md:w-auto mx-auto lazyload" data-src="https://www.musora.com/musora-cdn/image/width=810,quality=85/https://d21xeg6s76swyd.cloudfront.net/lead-gen/harmony-bootcamp/intro_image.jpg" alt="intro image">
            </div>
        </div>
    </section>

    <section class="py-12 sm:py-20">
        <div class="max-w-3xl lg:max-w-4xl mx-auto px-6 lg:px-0">
            <div class="text-center">
                <h4 class="text-xl lg:text-2xl font-extrabold mb-10">
                    Over this 60-minute Bootcamp, <br class="hidden sm:inline">
                    you’ll get the personal coaching you need to:
                </h4>
                <div class="flex flex-col md:flex-row md:gap-10 lg:gap-13 mb-10">
                    <div class="md:w-1/3 mb-8 md:mb-0">
                        <img class="h-12 md:h-16" src="https://d21xeg6s76swyd.cloudfront.net/lead-gen/harmony-bootcamp/mic_icon.svg" alt="ear icon">
                        <h4 class="font-extrabold mb-1 md:mb-2 mt-3 leading-tight">1. Sing your first <br>harmony</h4>
                        <p class="max-w-xs md:max-w-full lg:leading-loose" style="color:#6A6868;">
                            You’ll be singing your first harmony within the first 15 minutes of the lesson!
                        </p>
                    </div>
                    <div class="md:w-1/3 mb-8 md:mb-0">
                        <img class="h-12 md:h-16" src="https://d21xeg6s76swyd.cloudfront.net/lead-gen/harmony-bootcamp/choir_icon.svg" alt="hurts icon">
                        <h4 class="font-extrabold mb-1 md:mb-2 mt-3 leading-tight">2. Understand <br>harmonies work</h4>
                        <p class="max-w-xs md:max-w-full lg:leading-loose" style="color:#6A6868;">
                            Learn easy techniques to find the right notes in perfect harmony.
                        </p>
                    </div>
                    <div class="md:w-1/3">
                        <img class="h-12 md:h-16" src="https://d21xeg6s76swyd.cloudfront.net/lead-gen/harmony-bootcamp/music_icon.svg" alt="bad song icon">
                        <h4 class="font-extrabold mb-1 md:mb-2 mt-3 leading-tight">3. Harmonize with <br>any melody </h4>
                        <p class="max-w-xs md:max-w-full lg:leading-loose" style="color:#6A6868;">
                            Apply your new knowledge to any melody and create the extraordinary!
                        </p>
                    </div>
                </div>
                <div class="max-w-2xl mx-auto">
                    <p class="md:leading-relaxed">
                        By the end of this FREE lesson, you’ll know the trick to finding a good starting note <br class="hidden lg:inline">to your harmony and how not to get distracted by the melody. <br>
                        <b>Even if you’ve never sung a harmony before, you will by the end of this Bootcamp!</b>
                    </p>
                </div>
            </div>
        </div>
    </section>

    <section class="px-4 sm:px-6 py-12 sm:py-20" style="background:#fafafa;">
        <div class="max-w-3xl lg:max-w-6xl mx-auto">
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
                                        {!! $step['desc'] !!}
                                    </p>
                                </div>
                            </div>
                            <img class="timeline-img rounded-lg lazyload mb-4 md:mb-0" data-src="https://www.musora.com/musora-cdn/image/width=800,quality=85/{{ $step['img'] }}" alt="step {{$key+1}}" />
                        </div>
                    @else
                        <div class="timeline relative flex flex-col md:grid md:grid-cols-2 gap-2 md:gap-12 lg:gap-20 mb-16 md:mb-16 lg:mb-28 pl-6 md:pl-0">
                            <img class="timeline-img rounded-lg lazyload mb-4 md:mb-0" data-src="https://www.musora.com/musora-cdn/image/width=800,quality=85/{{ $step['img'] }}" alt="step {{$key+1}}" />
                            <div class="content relative flex items-center justify-center">
                                <div class="md:max-w-xs lg:max-w-md w-full">
                                    <h4 class="font-extrabold uppercase lg:mb-2">step {{$key+1}}</h4>
                                    <p class="lg:text-lg" style="color:#6A6868;">
                                        {!! $step['desc'] !!}
                                    </p>
                                </div>
                            </div>
                        </div>
                    @endif

                @endforeach
            </div>
        </div>
    </section>

    <section class="px-4 py-12 sm:py-20">
        <div class="max-w-md sm:max-w-3xl lg:max-w-6xl mx-auto">
            <div class="sm:grid sm:grid-cols-2 items-center text-center">
                <img class="rounded-md h-72 sm:h-80 lg:h-96 mb-7 sm:mb-0 mx-auto lazyload" data-src="https://www.musora.com/musora-cdn/image/width=660,quality=85/https://d21xeg6s76swyd.cloudfront.net/lead-gen/harmony-bootcamp/ui.png" alt="intro image">
                <div class="inline-flex flex-col text-left">
                    <h3 class="font-extrabold mb-4 sm:mb-6 leading-tight text-left mx-0">
                        These aren’t <br>
                        YouTube lessons…
                    </h3>
                    <p class="sm:leading-tight md:leading-normal" style="color:#6A6868;">
                        This isn’t your regular push play and sit back. <br><br>
                        You’ll be LIVE with a real, professional vocal coach, Lisa Witt.<br><br>
                        That means you can ask questions, get feedback and advice, and hear the difference in your voice as it’s happening. Without having to fork out hundreds of dollars a private lesson.<br><br>
                        You’ll also meet singers from all over the world who are going through the same journey.<br><br>
                        Hello, instant singing squad!

                    </p>
                </div>
            </div>
        </div>
    </section>

    <section class="px-4 py-14 sm:py-20 md:pb-32 bg-musora-black">
        <div class="max-w-3xl lg:max-w-4xl mx-auto text-white relative">
            <div class="w-3/4 sm:w-2/3 mx-auto relative md:static text-center mb-8">
                <img class="md:w-80 lg:w-96 md:absolute -bottom-10 right-2 md:border-8 rounded-3xl md:border-solid border-musora-black lazyload" data-src="https://www.musora.com/musora-cdn/image/width=800,quality=85/https://d21xeg6s76swyd.cloudfront.net/lead-gen/harmony-bootcamp/coach_image.png" alt="coach image">
            </div>

            <div class="mx-auto md:mx-0 max-w-md sm:max-w-lg md:max-w-full md:w-2/3 rounded-xl p-4 sm:p-10 md:py-10 md:pl-8 md:pr-24 lg:p-12 lg:pr-28" style="background:#8300E9;">
                <div class="font-extrabold mb-4 sm:mb-6 leading-tight text-xl sm:text-2xl lg:text-3xl">
                    Meet your <br>
                    singing teacher
                </div>
                <p class="text-sm sm:text-base sm:leading-tight md:leading-normal">
                    Lisa is the lead instructor at Singeo and arguably the happiest vocal coach on the planet!<br><br>
                    With a background in contemporary vocal training and a love for popular music, Lisa focuses on helping you find and fall in love with your unique voice.<br><br>
                    “So many new singers can see a difference in their very first lesson,” she says. “The trick is knowing the small changes that will make a big difference!”<br><br>
                    You’ll be inspired and smiling from the very first live lesson.
                </p>
            </div>
        </div>
    </section>

    <section class="py-20 bg-cover lazyload" style="background-position: 25% 50%;" data-bg="https://www.musora.com/musora-cdn/image/width=1500,quality=85/https://d21xeg6s76swyd.cloudfront.net/lead-gen/beginner-vocal-bootcamp/footer_bg_d.jpg">
        <div class="max-w-2xl lg:max-w-3xl mx-auto text-center text-white px-4">
            <img class="mb-4 h-28 md:h-36 lg:h-40 lazyload" data-src="https://www.musora.com/musora-cdn/image/width=840,quality=85/https://d21xeg6s76swyd.cloudfront.net/lead-gen/harmony-bootcamp/logo.png" alt="logo">
            <h5 class="mb-2">
                <strong class="font-extrabold">Get free LIVE vocal training</strong> with Lisa Witt
            </h5>
            @include("singeo._partials._sign-up-form", [
                "formId" => 'Singeo - Engagement - Trigger - Harmony Bootcamp - Web Form',
                "formName" => 'Harmony Bootcamp',
                "buttonText" => "Save my spot!",
                "oneLineLg" => true,
            ])
        </div>
    </section>

    @include('singeo.lead-gen.partials._video-player',[
        "id" => "trailer",
        "code" => "738333190"
    ])
@endsection

@section('scripts')

    <script type="text/javascript" src="{{ asset('/marketing/js/modal-autoplay.js') }}"></script>
@stop
