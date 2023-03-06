@php
    $steps = [
          [
              'position' => 'left',
              'img' => 'https://singeo.s3.amazonaws.com/lead-gen/beginner-vocal-bootcamp/Step1alt.png',
              'desc' => 'Enter your email address. It’s free. That’s right - 100% free!'
          ],
          [
              'position' => 'right',
              'img' => 'https://singeo.s3.amazonaws.com/lead-gen/beginner-vocal-bootcamp/step2.jpg',
              'desc' => 'Join the Private Facebook Group. You’ll be emailed the invite.'
          ],
          [
              'position' => 'left',
              'img' => 'https://singeo.s3.amazonaws.com/lead-gen/beginner-vocal-bootcamp/step3.jpg',
              'desc' => 'Log in for your 90 minute LIVE Lesson with Lisa.'
          ],
          [
              'position' => 'right',
              'img' => 'https://singeo.s3.amazonaws.com/lead-gen/beginner-vocal-bootcamp/step4.jpg',
              'desc' => 'Get your downloadable resources, practice tips, and connect with Lisa.'
          ],
          [
              'position' => 'left',
              'img' => 'https://singeo.s3.amazonaws.com/lead-gen/beginner-vocal-bootcamp/step5.jpg',
              'desc' => 'Post your progress (if you want - it’s totally up to you).'
          ],
          [
              'position' => 'right',
              'img' => 'https://singeo.s3.amazonaws.com/lead-gen/beginner-vocal-bootcamp/step6.jpg',
              'desc' => 'Sing BETTER!'
          ],
      ];
@endphp


@extends('singeo.lead-gen.lead-gen-layout')

@section('styles')
    <title>Live Vocal Bootcamp | Singeo</title>
    <meta property="og:title" content="Live Vocal Bootcamp | Singeo">
    <meta name="description" content="Connect with your breath so you can reduce tension, improve vocal control and have a healthier, happier voice."/>
    <meta property="og:description" content="Connect with your breath so you can reduce tension, improve vocal control and have a healthier, happier voice.">
    <meta property="og:image" content="https://singeo.s3.amazonaws.com/lead-gen/beginner-vocal-bootcamp/share_image.jpg">
    <meta property="og:url" content="https://www.singeo.com/live-vocal-bootcamp/">

    <link rel="stylesheet" href="{{ asset('/marketing/parcel/singeo/lead-gen.css') }}">

    <style>
        body {
            counter-reset: timeline;
        }

        .header {
            background-position: top;
            background-size: cover;
            background-image: url('https://www.musora.com/musora-cdn/image/width=700,quality=85/https://singeo.s3.amazonaws.com/lead-gen/beginner-vocal-bootcamp/header_bg_mobile1.jpg');
        }

        .text-yellow {
            color: #FFAC00;
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
                background-image: url('https://www.musora.com/musora-cdn/image/width=2000,quality=85/https://singeo.s3.amazonaws.com/lead-gen/beginner-vocal-bootcamp/header_image_d.jpg');
                background-size: 1910px;
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
                <div class="w-full sm:w-5/12 lg:w-1/2 md:order-1">
                    <i data-open="trailer" class="mt-32 md:mt-64 mb-3 md:mb-0 fas fa-play play-button autoplay-video" aria-controls="trailer" aria-haspopup="true" tabindex="0"></i>
                </div>
                <div class="w-full sm:w-7/12 lg:w-1/2 md:text-left">
                    <img class="h-20 sm:h-24 lg:h-36 lazyload" data-src="https://www.musora.com/musora-cdn/image/width=840,quality=85/https://singeo.s3.amazonaws.com/lead-gen/beginner-vocal-bootcamp/logo2.png" alt="logo">
                    <h6 class="my-2 md:my-5">
                        <strong class="font-extrabold">Free 90-minute LIVE vocal training</strong> <br class="sm:hidden">with Lisa Witt
                    </h6>
                    <div class="flex justify-center items-center md:justify-start mb-2 sm:mb-5">
                        <div class="align-middle bg-white text-center rounded-lg inline-block overflow-hidden w-11 mb-2 md:mb-0">
                            <p class="leading-none tracking-tighter text-xs py-0.5 text-white" style="background-color:#bb3744;"><strong>SEPT</strong></p>
                            <p class="leading-none text-lg py-1 text-black"><strong class="font-black">19</strong></p>
                        </div>
                        <p class="leading-tight uppercase text-yellow ml-4">
                            <a target="_blank" href="https://www.google.com/search?q=9am+PDT" class="font-extrabold"><strong>Monday, Sept 19 @ 9am PDT</strong> <i class="fal fa-info-circle"></i></a>
                        </p>
                    </div>
                    <h6 class="leading-tight mb-4">
                        Connect with your breath so you can reduce tension, improve vocal control and have a healthier, happier voice.
                    </h6>
                    @include("singeo._partials._sign-up-form", [
                        "formId" => 'Singeo - Engagement - Trigger - Breath Bootcamp - Web Form',
                        "formName" => 'Breath Bootcamp',
                        "buttonText" => "Save my spot!",
                    ])
                </div>
            </div>
        </div>
    </header>

    <section class="text-white py-12 sm:py-20 px-4 sm:px-6 bg-musora-black">
        <div class="max-w-3xl lg:max-w-4xl mx-auto">
            <div class="md:grid md:grid-cols-2 sm:gap-6 md:gap-12 items-center justify-center flex flex-col mx-auto">
                <div class="mb-10 md:mb-0 inline-flex flex-col">
                    <h3 class="font-extrabold mb-4 sm:mb-6 leading-tight">
                        The key to unlocking the full potential of your voice.
                    </h3>
                    <p class="sm:leading-tight md:leading-normal sm:max-w-lg md:max-w-auto" style="color:#A4AFC7;">
                        Without breath, there is no sound. Breath is an extremely important part of the singing process but it is often misunderstood. Together we will debunk the common myths around breath, learn about the role breath plays in singing, and learn exercises that will help you to develop great breathing habits as a singer.  You can expect less tension, more control over your dynamics and range and a happier, healthier voice.
                    </p>
                </div>
                <img class="rounded-md sm:w-2/3 md:w-auto mx-auto lazyload" data-src="https://www.musora.com/musora-cdn/image/width=810,quality=85/https://singeo.s3.amazonaws.com/lead-gen/beginner-vocal-bootcamp/intro_image2.jpg" alt="intro image">
            </div>
        </div>
    </section>
    <div class="relative h-5 sm:h-7 -mb-5 sm:-mb-7" style="background: linear-gradient(to top left, transparent calc(50% - 1px), transparent, #000C17 calc(50% + 1px));"></div>
    <section class="py-12 sm:py-20 px-4 sm:px-6">
        <div class="max-w-3xl lg:max-w-4xl mx-auto">
            <div class="text-center mb-10 sm:mb-20 md:mb-24">
                <h5 class="leading-tight font-extrabold mb-10">
                    This 90-minute FREE Live Bootcamp has been designed to teach you the 3 things <br class="hidden lg:inline">
                    any beginner singer needs to know to have a stronger, healthier voice…
                </h5>
                <div class="flex flex-col md:flex-row md:gap-6 lg:gap-10">
                    <div class="md:w-1/3 mb-8 md:mb-0">
                        <img class="h-12 md:h-16" src="https://singeo.s3.amazonaws.com/lead-gen/beginner-vocal-bootcamp/myths_icon.svg" alt="ear icon">
                        <h5 class="text-singeo font-extrabold mb-1 md:mb-2 mt-5 md:mt-6 leading-tight">1. Debunk the Myths</h5>
                        <p class="max-w-md md:max-w-full">
                            ‘Singing from the diaphragm” is a myth. Unlearn unhealthy and unproductive habits that are stopping you from being a better singer.
                        </p>
                    </div>
                    <div class="md:w-1/3 mb-8 md:mb-0">
                        <img class="h-12 md:h-16" src="https://singeo.s3.amazonaws.com/lead-gen/beginner-vocal-bootcamp/right_icon.svg" alt="hurts icon">
                        <h5 class="text-singeo font-extrabold mb-1 md:mb-2 mt-5 md:mt-6 leading-tight">2. The RIGHT techniques</h5>
                        <p class="max-w-md md:max-w-full">
                            Learn exercises that will help you to develop great breathing habits as a singer.
                        </p>
                    </div>
                    <div class="md:w-1/3">
                        <img class="h-12 md:h-16" src="https://singeo.s3.amazonaws.com/lead-gen/beginner-vocal-bootcamp/power_icons.svg" alt="bad song icon">
                        <h5 class="text-singeo font-extrabold mb-1 md:mb-2 mt-5 md:mt-6 leading-tight">3. Sing with POWER </h5>
                        <p class="max-w-md md:max-w-full">
                            Improve efficiency, reduce strain, and increase power.
                        </p>
                    </div>
                </div>
            </div>

            <div class="flex flex-wrap sm:flex-nowrap items-center mx-auto">
                <img class="rounded-xl mx-auto w-72 lg:w-96 order-1 sm:order-0 lazyload" data-src="https://www.musora.com/musora-cdn/image/width=800,quality=85/https://singeo.s3.amazonaws.com/lead-gen/beginner-vocal-bootcamp/collage.png" alt="intro image">
                <div class="mb-5 md:mt-0 sm:pr-5 lg:pr-10">
                    <h5 class="font-extrabold mx-0 mb-4 leading-tight">
                        By the end of the lesson you will…
                    </h5>
                    <ol class="sm:leading-tight md:leading-normal ml-4 md:ml-6 mb-3 sm:mb-6 sm:mx-auto sm:max-w-md md:max-w-full" style="list-style: normal;">
                        <li class="mb-3">Understand what habits are stopping you from being a better singer and how to deal with them.</li>
                        <li class="mb-3">Have a ready-made exercise routine to get your voice stronger</li>
                        <li class="">Immediately hear and feel the difference. You’ll be singing songs better that you thought possible.</li>
                    </ol>
                    <h5 class="font-extrabold mx-0 mb-4 leading-tight">
                        Can’t make it to the lesson?
                    </h5>
                    <p>Once the Bootcamp is over, we’ll send you a recording of the lesson. Use it as a guide to continue making progress long after. But you will only get the recording if you register.</p>
                </div>
            </div>

        </div>
    </section>

    <section class="px-4 sm:px-6 py-12 sm:py-20" style="background:#fafafa;">
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
                            <img class="timeline-img rounded-lg lazyload mb-4 md:mb-0" data-src="https://www.musora.com/musora-cdn/image/width=800,quality=85/{{ $step['img'] }}" alt="step {{$key+1}}" />
                        </div>
                    @else
                        <div class="timeline relative flex flex-col md:grid md:grid-cols-2 gap-2 md:gap-12 lg:gap-20 mb-16 md:mb-16 lg:mb-28 pl-6 md:pl-0">
                            <img class="timeline-img rounded-lg lazyload mb-4 md:mb-0" data-src="https://www.musora.com/musora-cdn/image/width=800,quality=85/{{ $step['img'] }}" alt="step {{$key+1}}" />
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

    <section class="px-4 py-12 sm:py-20">
        <div class="max-w-md sm:max-w-3xl lg:max-w-5xl mx-auto">
            <div class="sm:grid sm:grid-cols-2 sm:gap-6 md:gap-12 lg:gap-20 items-center text-center">
                <img class="rounded-md h-72 sm:h-80 lg:h-96 mb-7 sm:mb-0 mx-auto lazyload" data-src="https://www.musora.com/musora-cdn/image/width=660,quality=85/https://singeo.s3.amazonaws.com/lead-gen/beginner-vocal-bootcamp/ui.png" alt="intro image">
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

    <div class="relative h-5 sm:h-7 -mb-5 sm:-mb-7" style="background: linear-gradient(to top left, transparent calc(50% - 1px), transparent, #fff calc(50% + 1px));"></div>
    <section class="px-4 py-14 sm:py-20 md:pb-32 bg-musora-black">
        <div class="max-w-3xl lg:max-w-4xl mx-auto text-white relative">
            <div class="w-3/4 sm:w-2/3 mx-auto relative md:static text-center mb-8">
                <img class="md:w-80 lg:w-96 md:absolute -bottom-10 right-2 md:border-8 rounded-xl md:border-solid border-musora-black lazyload" data-src="https://www.musora.com/musora-cdn/image/width=800,quality=85/https://singeo.s3.amazonaws.com/lead-gen/beginner-vocal-bootcamp/coach_image_d.jpg" alt="coach image">
                <img class="w-20 absolute bottom-0 md:-bottom-12 -right-3 md:right-0" src="https://singeo.s3.amazonaws.com/lead-gen/beginner-vocal-bootcamp/corner_piece_d.svg" alt="corner image">
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

    <section class="py-20 bg-cover lazyload" style="background-position: 25% 50%;" data-bg="https://www.musora.com/musora-cdn/image/width=1500,quality=85/https://singeo.s3.amazonaws.com/lead-gen/beginner-vocal-bootcamp/footer_bg_d.jpg">
        <div class="max-w-2xl lg:max-w-3xl mx-auto text-center text-white px-4">
            <img class="mb-4 h-20 sm:h-24 lg:h-36 lazyload" data-src="https://www.musora.com/musora-cdn/image/width=840,quality=85/https://singeo.s3.amazonaws.com/lead-gen/beginner-vocal-bootcamp/logo2.png" alt="logo">
            <h5 class="mb-2">
                <strong class="font-extrabold">Get free LIVE vocal training</strong> with Lisa Witt
            </h5>
            <p class="mb-4">
                Start singing the RIGHT way with a LIVE 90-minute singing lesson from a vocal coach.
            </p>
            @include("singeo._partials._sign-up-form", [
                "formId" => 'Singeo - Engagement - Trigger - Breath Bootcamp - Web Form',
                "formName" => 'Breath Bootcamp',
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
