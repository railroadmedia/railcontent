@php
    $steps = [
          [
              'position' => 'left',
              'img' => 'https://pianote.s3.amazonaws.com/lead-gen/magic-of-piano-chords/Step1alt2.jpg',
              'desc' => 'Enter your email address. It’s free. That’s right - 100% free!'
          ],
          [
              'position' => 'right',
              'img' => 'https://pianote.s3.amazonaws.com/lead-gen/magic-of-piano-chords/Step2.jpg',
              'desc' => 'You’ll be emailed the link for the LIVE Zoom session. Save it!'
          ],
          [
              'position' => 'left',
              'img' => 'https://pianote.s3.amazonaws.com/lead-gen/magic-of-piano-chords/Step3.jpg',
              'desc' => 'Log in for your LIVE lesson with Lisa.'
          ],
          [
              'position' => 'right',
              'img' => 'https://pianote.s3.amazonaws.com/lead-gen/magic-of-piano-chords/Step4.jpg',
              'desc' => 'Get your downloadable resources, practice tips, and connect with Lisa via email.'
          ],
          [
              'position' => 'left',
              'img' => 'https://pianote.s3.amazonaws.com/lead-gen/magic-of-piano-chords/Step5.jpg',
              'desc' => 'Post your progress (if you want - it’s totally up to you).'
          ],
          [
              'position' => 'right',
              'img' => 'https://pianote.s3.amazonaws.com/lead-gen/magic-of-piano-chords/Step6.jpg',
              'desc' => 'Start playing the piano!'
          ],
      ];
@endphp


@extends('pianote.lead-gen.lead-gen-layout-tw')

@section('meta')
    @parent
    <title>Perfect Piano Practice Live Bootcamp | Pianote</title>
    <meta property="og:title" content="Perfect Piano Practice Live Bootcamp | Pianote">
    <meta name="description" content="Accelerate your progress on the piano with a FREE 90-minute live lesson from Lisa Witt"/>
    <meta property="og:description" content="Accelerate your progress on the piano with a FREE 90-minute live lesson from Lisa Witt">
    <meta property="og:image" content="https://cdn.musora.com/image/fetch/w_1200,q_auto:best/https://pianote.s3.amazonaws.com/lead-gen/magic-of-piano-chords/header.jpg">
    <meta property="og:url" content="https://www.pianote.com/{{ Request::path() }}">

@endsection
@section('head')
    <style>

        h1 strong, h2 strong, h3 strong, h4 strong, h5 strong, h6 strong {
            font-weight:900
        }

        h1, h2, h3, h4, h5, h6, li, p {
            font-family:Open Sans, sans-serif;
            font-weight:400;
            line-height:1em;
            margin:0 auto
        }

        h1 sup, h2 sup, h3 sup, h4 sup, h5 sup, h6 sup, li sup, p sup {
            font-size:50%;
            top:-.75em
        }

        h1 {
            font-size:24px;
            line-height:1.2em
        }

        @media (min-width:768px) {
            h1 {
                font-size:36px
            }
        }

        @media (min-width:1024px) {
            h1 {
                font-size:48px
            }
        }

        h2 {
            font-size:20px;
            line-height:1.2em
        }

        @media (min-width:768px) {
            h2 {
                font-size:30px
            }
        }

        @media (min-width:1024px) {
            h2 {
                font-size:36px
            }
        }

        h3 {
            font-size:18px
        }

        @media (min-width:768px) {
            h3 {
                font-size:24px
            }
        }

        @media (min-width:1024px) {
            h3 {
                font-size:30px
            }
        }

        h4 {
            font-size:16px
        }

        @media (min-width:768px) {
            h4 {
                font-size:20px
            }
        }

        @media (min-width:1024px) {
            h4 {
                font-size:24px
            }
        }

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

        h6 {
            font-size:15px
        }

        @media (min-width:768px) {
            h6 {
                font-size:16px
            }
        }

        @media (min-width:1024px) {
            h6 {
                font-size:18px
            }
        }

        li, p {
            font-size:15px;
            line-height:1.6em
        }

        @media (min-width:1024px) {
            li, p {
                font-size:16px
            }
        }
        body {
            counter-reset: timeline;
        }

        .header {
            background-position: top;
            background-size: cover;
            background-image: url('https://cdn.musora.com/image/fetch/w_700,q_auto:best/https://pianote.s3.amazonaws.com/lead-gen/magic-of-piano-chords/header_m.jpg');
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
            background-color: #4d1823;
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
            background-color: #4d1823;
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
                background-image: url('https://cdn.musora.com/image/fetch/w_2000,q_auto:best/https://pianote.s3.amazonaws.com/lead-gen/magic-of-piano-chords/header.jpg');
                background-size: 1410px;
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
            .header {
                background-size: 1560px;
            }
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
@endsection
@section('page-body')
    <header class="header text-white text-center px-3 py-6 md:py-20 lg:py-28 relative bg-no-repeat" style="background-color:#350d0d;">
        <div class="mx-auto relative z-10 max-w-md md:max-w-5xl">
            <div class="flex flex-wrap items-center">
                <div class="w-full sm:w-5/12 lg:w-1/2 md:order-1 mt-56 sm:mt-80 md:mt-44 mb-3 md:mb-5 md:my-0">
                    {{--<i data-open="trailer" class=" fas fa-play play-button autoplay-video" aria-controls="trailer" aria-haspopup="true" tabindex="0"></i>--}}
                </div>
                <div class="w-full md:w-7/12 lg:w-1/2 md:text-left">
                    <div class="pl-2 sm:pl-3">
                        <h1 class="leading-none font-bebas uppercase" style="color:#fcffe3">Perfect Piano Practice</h1>
                        <h3 class="tracking-widest">LIVE BOOTCAMP</h3>
                        {{--<img class="h-12 sm:h-14 lg:h-16 lazyload" data-src="https://cdn.musora.com/image/fetch/w_840,q_auto:best/https://pianote.s3.amazonaws.com/lead-gen/magic-of-piano-chords/logo_left.png" alt="logo">--}}
                        <h5 class="mt-2 md:mt-5 sub-header mb-2 md:mb-8">
                            <strong class="font-extrabold">Free 90-minute LIVE piano<br class="md:hidden"> lesson with Lisa Witt</strong>
                        </h5>
                        <div class="flex justify-center items-center md:justify-start mb-2 md:mb-6">
                            <div class="align-middle bg-white text-center rounded-lg inline-block overflow-hidden w-11 mb-2 md:mb-0">
                                <p class="leading-none tracking-tighter text-xs py-0.5 text-white" style="background-color:#bb3744;"><strong>OCT</strong></p>
                                <p class="leading-none text-lg py-1 text-black"><strong class="font-black">17</strong></p>
                            </div>
                            <p class="leading-tight uppercase text-yellow ml-4">
                                <a target="_blank" href="https://www.google.com/search?q=9am+PDT" class="font-extrabold"><strong>Monday, October 17 @ 9am PDT</strong> <i class="fal fa-info-circle"></i></a>
                                <strong><br><span class="tzcd-full hidden md:inline">A LIMITED TIME</span> <span class="tzcd-small inline md:hidden">A LIMITED TIME</span></strong>
                            </p>
                        </div>
                        <p class="leading-tight mb-4" style="color:#fcffe3">
                            <em>
                                Accelerate your progress on the piano with<br class="hidden sm:inline">
                                a FREE 90-minute live lesson from Lisa Witt
                            </em>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <section class="text-white py-12 sm:py-20 px-4 sm:px-6" style="background:#000C17;">
        <div class="max-w-3xl lg:max-w-4xl mx-auto">
            <div class="md:grid md:grid-cols-2 sm:gap-6 md:gap-7 lg:gap-10 items-center justify-center flex flex-col mx-auto">
                <img class="sm:order-1 rounded-md sm:w-2/3 mb-7 md:mb-0 md:w-auto mx-auto lazyload" data-src="https://cdn.musora.com/image/fetch/w_810,q_auto:best/https://pianote.s3.amazonaws.com/lead-gen/magic-of-piano-chords/collage.png" alt="intro image">
                <div class="inline-flex flex-col">
                    <h3 class="font-extrabold mx-0 mb-4 sm:mb-6 leading-tight">
                        It’s the #1 challenge for piano players
                    </h3>
                    <p class="sm:leading-tight md:leading-normal sm:max-w-lg md:max-w-auto" style="color:#A4AFC7;">
                        What do you practice?
                        <br><br>
                        We all know practice is essential, but knowing what, when, and how long to practice can leave you feeling stuck and frustrated.
                        <br><br>
                        You don’t have to practice for hours to see amazing results on the piano.
                        <br><br>
                        Join Lisa Witt live via Zoom for 90 minutes and discover the best and most effective way to practice the piano.
                        <br><br>
                        You’ll leave knowing how to structure your practice times to reach your goals, and you’ll have a planned template to follow.
                        <br><br>
                        Best of all -- it’s 100% FREE.
                        <br><br>
                        Simply enter your email to save your spot.

                    </p>
                </div>

            </div>
        </div>
    </section>
    <div class="relative h-5 sm:h-7 -mb-5 sm:-mb-7" style="background: linear-gradient(to top left, transparent calc(50% - 1px), transparent, #000C17 calc(50% + 1px));"></div>

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
                                    <h3 class="font-extrabold uppercase lg:mb-2">step {{$key+1}}</h3>
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
                                    <h3 class="font-extrabold uppercase lg:mb-2">step {{$key+1}}</h3>
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
        <div class="max-w-md sm:max-w-3xl lg:max-w-6xl mx-auto">
            <div class="sm:grid sm:grid-cols-2 sm:gap-6 md:gap-12 lg:gap-20 items-center text-center">
                <img class="rounded-md h-72 sm:h-80 lg:h-96 mb-7 sm:mb-0 mx-auto lazyload" data-src="https://cdn.musora.com/image/fetch/w_660,q_auto:best/https://pianote.s3.amazonaws.com/lead-gen/magic-of-piano-chords/ui2.png" alt="intro image">
                <div class="inline-flex flex-col text-left">
                    <h3 class="font-extrabold mb-2 sm:mb-3 leading-tight text-left mx-0">
                        These aren’t <br>
                        YouTube lessons…
                    </h3>
                    <p class="leading-tight" style="color:#6A6868;">
                        This isn’t your regular push play and sit back.
                        <br><br>
                        You’ll be LIVE with Pianote’s lead instructor, Lisa Witt.
                        <br><br>
                        That means you can ask questions, get feedback and advice, and hear the difference in your playing. And you can do it all without having to pay for a private lesson.
                        <br><br>
                        Space is limited, so save your spot today!
                    </p>
                </div>
            </div>
        </div>
    </section>

    <div class="relative h-5 sm:h-7 -mb-5 sm:-mb-7" style="background: linear-gradient(to top left, transparent calc(50% - 1px), transparent, #fff calc(50% + 1px));"></div>
    <section class="px-4 py-14 sm:py-20 md:pb-32" style="background:#000C17;">
        <div class="max-w-3xl lg:max-w-4xl mx-auto text-white relative">
            <div class="w-3/4 sm:w-2/3 mx-auto relative md:static text-center mb-8">
                <img class="md:w-80 lg:w-96 md:absolute -bottom-10 right-2 md:border-8 rounded-3xl md:border-solid lazyload" data-src="https://cdn.musora.com/image/fetch/w_700,q_auto:best/https://pianote.s3.amazonaws.com/lead-gen/magic-of-piano-chords/profile_pic.png" alt="coach image" style="border-color: #000C17;">
            </div>

            <div class="mx-auto md:mx-0 max-w-md sm:max-w-lg md:max-w-full md:w-2/3 rounded-xl p-4 sm:p-10 md:py-10 md:pl-8 md:pr-24 lg:p-10 lg:pr-28" style="background:#4d1823;">
                <h3 class="leading-tight mb-2 sm:mb-3">
                    <strong>Meet your <br>
                        piano teacher</strong>
                </h3>
                <p class="text-sm sm:text-base sm:leading-tight md:leading-normal">
                    Lisa is the lead instructor at Pianote and a well-known face in the piano community, reaching millions of people around the world through her online lessons.
                    <br><br>
                    With 20 years of teaching experience and training through the Royal Conservatory of Music, Lisa is the perfect person to show you what’s possible. Because she believes…
                    <br><br>
                    Anyone can play the songs they love on the piano. Yes, even you!
                    <br><br>
                    Lisa’s contagious enthusiasm will have you excited every time you sit down to play and will make learning the piano a super fun and engaging experience.
                </p>
             </div>
        </div>
    </section>

    <section class="py-20 sm:py-28 bg-cover lazyload" style="background-color:#3d151a;background-position: 25% 50%;" data-bg="https://cdn.musora.com/image/fetch/w_1500,q_auto:best/https://pianote.s3.amazonaws.com/lead-gen/magic-of-piano-chords/footer.png">
        <div class="max-w-2xl lg:max-w-3xl mx-auto text-center text-white px-4">
            <h1 class="leading-none font-bebas uppercase" style="color:#fcffe3">Perfect Piano Practice</h1>
            <h3 class="tracking-widest">LIVE BOOTCAMP</h3>
            {{--<img class="mb-4 h-12 sm:h-16 lg:h-20 lazyload" data-src="https://cdn.musora.com/image/fetch/w_1040,q_auto:best/https://pianote.s3.amazonaws.com/lead-gen/magic-of-piano-chords/logo_centre.png" alt="logo">--}}
            <h5 class="my-2">
                <strong class="font-extrabold">Free 90-minute LIVE piano<br class="inline sm:hidden"> lesson</strong> with Lisa Witt
            </h5>
            <h5 class="uppercase text-yellow font-extrabold time-counter mb-8 leading-tight md:leading-tight">
                ONLY
                <span class="tzcd-full hidden sm:inline">A LIMITED TIME</span> <span class="tzcd-small inline sm:hidden">A LIMITED TIME</span>
                LEFT!
            </h5>
            <p class="mb-4">

                Accelerate your progress on the piano <br class="inline sm:hidden">
                with a FREE 90-minute live lesson from Lisa Witt
            </p>
        </div>
    </section>

    @include('pianote.lead-gen.partials.video-player',[
        "name" => "trailer",
        "vimeoId" => "649725858",
    ])
@endsection

@section('scripts')
    <script type="text/javascript" src="/marketing/js/jquery.countdown-2.min.js"></script>
    <script>
        $(document).ready(function () {
            $(document).foundation();
            $('.tzcd-full').countdown('2022/10/17')
                .on('update.countdown', function (event) {
                    var format = '%-M Minute%!M %-S Second%!S';
                    if (event.offset.totalHours > 0) {
                        format = '%-H Hour%!H ' + format;
                    }
                    if (event.offset.totalDays > 0) {
                        format = '%-D Day%!D ' + format;
                    }
                    $(this).html(event.strftime(format));
                })
                .on('finish.countdown', function (event) {
                    $(this).html('a limited time');
                });
            $('.tzcd-small').countdown('2022/10/17')
                .on('update.countdown', function (event) {
                    var format = '%-MM %-SS';
                    if (event.offset.totalHours > 0) {
                        format = '%-HH ' + format;
                    }
                    if (event.offset.totalDays > 0) {
                        format = '%-DD ' + format;
                    }
                    $(this).html(event.strftime(format));
                })
                .on('finish.countdown', function (event) {
                    $(this).html('a limited time');
                });
        });
    </script>
    <script type="text/javascript" src="/marketing/js/modal.js"></script>
    <script type="text/javascript" src="/marketing/js/modal-autoplay.js"></script>
@stop
