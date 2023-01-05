@php
    $steps = [
          [
              'position' => 'left',
              'img' => 'https://pianote.s3.amazonaws.com/lead-gen/7-days-to-sight-reading/Day1.jpg',
              'title' => 'The Basics',
              'desc' => 'Let’s start with the basics! You’ll play a super-simple melody in the key of C. Today is all about connecting some “landmark notes” on the piano to the page.'
          ],
          [
              'position' => 'right',
              'img' => 'https://pianote.s3.amazonaws.com/lead-gen/7-days-to-sight-reading/Day2.jpg',
              'title' => 'Musical Patterns',
              'desc' => 'You’ll dive deeper into some common musical patterns. By identifying patterns, you’ll be able to read music much faster (because you won’t have to read every single note).'
          ],
          [
              'position' => 'left',
              'img' => 'https://pianote.s3.amazonaws.com/lead-gen/7-days-to-sight-reading/Day3.jpg',
              'title' => 'Intervals',
              'desc' => 'Today is all about INTERVALS! Which is a fancy way of saying the space between two notes. All music is a combination of different intervals, and recognizing them is like finding a secret cheat code!'
          ],
          [
              'position' => 'right',
              'img' => 'https://pianote.s3.amazonaws.com/lead-gen/7-days-to-sight-reading/Day4.jpg',
              'title' => 'Play a Song',
              'desc' => 'It’s time to play a song! You’ll play a REAL song simply by reading the notes on the page. You won’t know until you play it, but you WILL be able to play it.'
          ],
          [
              'position' => 'left',
              'img' => 'https://pianote.s3.amazonaws.com/lead-gen/7-days-to-sight-reading/Day5.jpg',
              'title' => 'Chords & Arpeggios',
              'desc' => 'What makes music beautiful? Play beautiful broken chords and arpeggios written for the left and right hands and start playing chords.'
          ],
          [
              'position' => 'right',
              'img' => 'https://pianote.s3.amazonaws.com/lead-gen/7-days-to-sight-reading/Day6.jpg',
              'title' => 'Understanding Rhythm',
              'desc' => 'Music is more than just note names. It’s also rhythm. Today you’ll learn the basics of rhythm and how to recognize and play different rhythms written on a page.'
          ],
          [
              'position' => 'left',
              'img' => 'https://pianote.s3.amazonaws.com/lead-gen/7-days-to-sight-reading/Day7.jpg',
              'title' => 'Putting it All Together',
              'desc' => 'You made it! Time to celebrate by playing an ENTIRE piece of music. There are lots of notes on the page, but you’ll have ALL of the skills you need to do it!'
          ],
      ];
@endphp

@extends('pianote.lead-gen.lead-gen-layout-tw')

@section('meta')
    @parent
    <title>7 Days to Sight Reading | Pianote</title>
    <meta property="og:title" content="7 Days to Sight Reading | Pianote">
    <meta name="description" content="Learn to read music. Play your favorite songs. Have more fun."/>
    <meta property="og:description" content="Learn to read music. Play your favorite songs. Have more fun.">
    <meta property="og:image" content="https://cdn.musora.com/image/fetch/w_1200,q_auto:best/https://pianote.s3.amazonaws.com/lead-gen/7-days-to-sight-reading/share_image.jpg">
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

        .time-counter {
            font-size: 14px;
        }

        /* vertical line */
        .timeline-container::after {
            content: '';
            position: absolute;
            width: 3px;
            background-color: #F61A30;
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
            background-color: #F61A30;
            top: 0px;
            left: -8px;
            border-radius: 50%;
            z-index: 1;
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 900;
        }

        .timeline-img {
            filter: drop-shadow(4px 4px 10px rgba(0, 0, 0, 0.25));
            border:1px solid #E4E4E4;
        }

        .timeline-left::after {
            display:none;
        }

        .timeline-right::after {
            display:none;
        }

        @media (min-width: 640px) {
            .timeline::after {
                left: -8px;
            }
        }

        @media (min-width: 768px) {
            .time-counter {
                font-size: 16px;
            }

            .timeline-container::after {
                left: 50%;
                top: 40px;
            }

            .timeline::after {
                left: unset;
            }

            .timeline-left::after {
                left: -44px;
                display: flex;
            }

            .timeline-right::after {
                right: -41px;
                display: flex;
            }

            .timeline-div::after {
                display: none;
            }
        }

        @media (min-width: 1024px) {
            .timeline-container::after {
                top: 70px;
            }

            .time-counter {
                font-size: 17px;
            }

            .timeline-left::after {
                left: -52px;
            }

            .timeline-right::after {
                right: -49px;
            }
        }

        .dropdowns .dropdown .bg-pred {
            min-width: 32px;
        }

        .dropdown {
            border-color: black;
            border-width: 1px;
        }

        @media (min-width: 40em) {
            .dropdowns .dropdown .bg-pred {
                min-width: 83px;
            }
        }

        .dropdowns .dropdown .description {
            height: 0;
            max-height: 0;
            visibility: hidden;
            opacity: 0;
            overflow: hidden;
        }

        .dropdowns .dropdown.active .description {
            visibility: visible;
            opacity: 1;
            height: auto;
            max-height: 400px;
        }

        h6 strong {
            font-weight: 700;
        }
    </style>
@endsection

@section('page-body')
    <header class="py-12 md:py-16 lg:py-20 px-4 md:px-6" style="background: #00101D;">
        <div class="max-w-md md:max-w-4xl mx-auto text-white">
            <div class="md:flex md:items-center md:gap-4 lg:gap-8 mb-10">
                <div class="w-full md:w-7/12 lg:w-1/2 text-center md:text-left">
                    <img class="h-12 md:h-16 mb-2 md:mb-0 lazyload" data-src="https://cdn.musora.com/image/fetch/w_350,q_auto:best/https://pianote.s3.amazonaws.com/lead-gen/7-days-to-sight-reading/logo.png" alt="logo">
                    <h3 class="font-extrabold leading-tight my-2 text-xl md:text-2xl lg:text-3xl">
                        Learn to read music. <br>Play your favorite songs. <br>Have more fun.
                    </h3>
                    <img class="rounded-xl md:hidden mb-6 lazyload" data-src="https://cdn.musora.com/image/fetch/w_450,q_auto:best/https://pianote.s3.amazonaws.com/lead-gen/7-days-to-sight-reading/header_m.jpg" alt="lisa header image">
                    <p class="mb-8" style="color:#D0E2E7;">7 days of guided lessons and practices to help you learn the language of music.</p>
                    @include('pianote._partials._sign-up-form', [
                            "formId" => 'Pianote - Engagement - Trigger - 7 Days To Sight Reading - Web Form',
                            "formName" => '7 Days To Sight Reading',
                        "buttonText" => "Get it now",
                        "stacked" => true
                    ])
                </div>
                <div class="w-full md:w-5/12 lg:w-1/2 hidden md:block">
                    <img class="rounded-xl lazyload" data-src="https://cdn.musora.com/image/fetch/w_600,q_auto:best/https://pianote.s3.amazonaws.com/lead-gen/7-days-to-sight-reading/header.jpg" alt="lisa header image">
                </div>
            </div>
            <div class="md:mx-12 lg:mx-20 border rounded-xl p-6 md:py-6 md:px-10 md:flex md:text-center gap-10 lg:gap-16" style="border-color: #4B4B4B;">
                <div class="flex-1 mb-3 md:mb-0 flex items-center md:block">
                    <img class="h-8 mb-0 md:mb-2 mr-4 md:mr-0 lazyload" data-src="https://cdn.musora.com/image/fetch/w_60,q_auto:best/https://pianote.s3.amazonaws.com/lead-gen/7-days-to-sight-reading/lesson-time_icon.svg" alt="lesson time icon">
                    <p class="inline md:block mx-0 md:mx-auto">One short lesson a <br class="hidden md:inline">day for 7 days</p>
                </div>
                <div class="flex-1 mb-3 md:mb-0 flex items-center md:block">
                    <img class="h-8 mb-0 md:mb-2 mr-4 md:mr-0 lazyload" data-src="https://cdn.musora.com/image/fetch/w_60,q_auto:best/https://pianote.s3.amazonaws.com/lead-gen/7-days-to-sight-reading/follow-along_icon.svg" alt="follow along icon">
                    <p class="inline md:block mx-0 md:mx-auto">Follow-along for <br class="hidden md:inline">faster results</p>
                </div>
                <div class="flex-1 flex items-center md:block">
                    <img class="h-8 mb-0 md:mb-2 mr-4 md:mr-0 lazyload" data-src="https://cdn.musora.com/image/fetch/w_60,q_auto:best/https://pianote.s3.amazonaws.com/lead-gen/7-days-to-sight-reading/help_icon.svg" alt="help icon">
                    <p class="inline md:block mx-0 md:mx-auto">Help when you need <br class="hidden md:inline">it from real teachers</p>
                </div>
            </div>
        </div>
    </header>
    <section class="py-12 md:pt-20 md:pb-32 px-6 md:px-6" style="background:#F9F9F9;">
        <div class="max-w-md md:max-w-4xl mx-auto">
            <img
                class="md:hidden mb-6 lazyload" data-src="https://cdn.musora.com/image/fetch/w_400,q_auto:best/https://pianote.s3.amazonaws.com/lead-gen/7-days-to-sight-reading/intro_collage.png" alt="intro collage">
            <h3 class="md:text-center font-extrabold mb-4 md:mb-10">Learn to read music by playing music.</h3>
            <div class="md:flex md:items-center md:gap-8 lg:gap-14">
                <div class="flex-1 order-1 hidden md:block">
                    <img class="lazyload" data-src="https://cdn.musora.com/image/fetch/w_600,q_auto:best/https://pianote.s3.amazonaws.com/lead-gen/7-days-to-sight-reading/intro_collage.png" alt="intro collage">
                </div>
                <div class="flex-1">
                    <p style="color:#52525A;">
                        That’s what it’s all about. <br><br>
                        The only reason to read music is so you can PLAY music. So that’s what you’ll do. Join Lisa Witt every day for a week and unlock the mystery and beauty of sight-reading by playing REAL music on the piano. <br><br>
                        It’s not a boring theory lesson. <br><br>
                        You’ll be learning by doing. And because of that -- you’ll see results so much faster.  And have a ton of fun.
                    </p>
                </div>
            </div>
        </div>
    </section>
    <section class="py-12 md:py-20 px-6">
        <h3 class="font-extrabold text-center mb-6 leading-tight">Play real songs from sheet <br>music in JUST one week</h3>
        <p class="max-w-3xl mx-auto text-center mb-6 md:leading-loose" style="color:#52525A;">
            It only takes 15 minutes a day. Sit at your piano, press play, and practice along with Lisa as you build a deep connection between the notes on the page and keys under your fingertips. <br><br>
            Keep scrolling to see your week of sight-reading.
        </p>
        <div class="max-w-md md:max-w-3xl lg:max-w-4xl mx-auto">
            <div class="timeline-container relative mx-auto -mb-16 md:-mb-16 lg:-mb-28">
                @foreach ($steps as $key => $step)
                    @if($step['position'] === 'right')
                        <div class="timeline timeline-div relative flex flex-col-reverse md:grid md:grid-cols-2 gap-2 md:gap-12 lg:gap-20 mb-16 md:mb-0 md:mb-16 lg:mb-28 pl-6 md:pl-0">
                            <div class="content relative flex items-center justify-center">
                                <div class="md:max-w-xs lg:max-w-md w-full">
                                    <h4 class="timeline timeline-right relative font-extrabold mb-2 md:mb-4">Day {{$key+1}} - {{ $step['title'] }}</h4>
                                    <p style="color:#2A2F34;">
                                        {{ $step['desc'] }}
                                    </p>
                                </div>
                            </div>
                            <img class="timeline-img rounded-lg lazyload mb-4 md:mb-0" data-src="https://cdn.musora.com/image/fetch/w_1000,q_auto:best/{{ $step['img'] }}" alt="step {{$key+1}}" />
                        </div>
                    @else
                        <div class="timeline timeline-div relative flex flex-col md:grid md:grid-cols-2 gap-2 md:gap-12 lg:gap-20 mb-16 md:mb-16 lg:mb-28 pl-6 md:pl-0">
                            <img class="timeline-img rounded-lg lazyload mb-4 md:mb-0" data-src="https://cdn.musora.com/image/fetch/w_1000,q_auto:best/{{ $step['img'] }}" alt="step {{$key+1}}" />
                            <div class="content relative flex items-center justify-center">
                                <div class="md:max-w-xs lg:max-w-md w-full">
                                    <h4 class="timeline timeline-left relative font-extrabold mb-2 md:mb-4">Day {{$key+1}} - {{ $step['title'] }}</h4>
                                    <p style="color:#2A2F34;">
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

    <div class="relative h-5 sm:h-7 -mb-5 sm:-mb-7" style="background: linear-gradient(to top left, transparent calc(50% - 1px), transparent, white calc(50% + 1px));"></div>

    <section class="py-12 md:py-20 px-4 md:px-6" style="background:#F9F9F9;">
        <div class="max-w-md md:max-w-4xl mx-auto md:flex md:items-center gap-6 lg:gap-8">
            <div class="flex-1 order-1 mb-4 md:mb-0">
                <img data-open="soundSlice" class="lazyload autoplay-video cursor-pointer" data-src="https://cdn.musora.com/image/fetch/w_600,q_auto:best/https://pianote.s3.amazonaws.com/lead-gen/7-days-to-sight-reading/ui.png" alt="ui">
            </div>
            <div class="flex-1">
                <h3 class="font-extrabold leading-tight mb-2">Perfect practice for <br class="hidden md:inline">FASTER results</h3>
                <p style="color:#52525A;">
                    You’ll learn how to <b>read</b> music by <b>playing</b> music. But how do you know what to play?
                    We’ll show you. <br><br>
                    Every day comes with practice exercises you can play along to so you’ll know you’re ready to move on. Speed up, slow down, pause, rewind, even loop sections. <br><br>
                    You can do it all with our practice feature. <br><br>
                    Want to give it a try? Click the image to see what it’s like.
                </p>
            </div>
        </div>
    </section>

    <div class="relative h-5 sm:h-7 -mb-5 sm:-mb-7" style="background: linear-gradient(to top left, transparent calc(50% - 1px), transparent, #F9F9F9 calc(50% + 1px));"></div>

    <section class="pt-12 md:pb-20 md:pt-28 md:px-6" style="background:#00101D;">
        <div class="max-w-4xl mx-auto">
            <div class="flex flex-wrap sm:flex-nowrap items-start justify-center sm:mt-12 mb-12">
                <div class="py-40 sm:py-48 lg:py-64 border-8 border-white rounded-3xl shadow-xl w-56 sm:w-72 lg:w-96 bg-center bg-cover relative -mb-8 sm:mb-0 sm:-mt-8 sm:-mr-8 z-10 flex-shrink-0 cursor-pointer lazyload autoplay-video" data-bg="https://cdn.musora.com/image/fetch/w_550,q_auto:best/https://pianote.s3.amazonaws.com/lead-gen/7-days-to-sight-reading/7dtsr_coach.jpg">
                </div>
                {{-- <img class="border-8 border-white rounded-3xl shadow-xl w-56 sm:w-72 lg:w-96 relative -mb-8 sm:mb-0 sm:-mt-8 sm:-mr-8 z-10 lazyload" data-src="https://cdn.musora.com/image/fetch/w_550,q_auto:best/https://pianote.s3.amazonaws.com/products/the-power-of-chords/coach_profile-min.png"> --}}
                <div class="bg-white text-left md:rounded-xl pt-14 pb-8 sm:py-10 lg:py-12 px-6 sm:pr-10 sm:pl-14 lg:px-16 max-w-xl sm:mt-8 w-full sm:w-auto sm:flex-grow">
                    <h6 class="uppercase text-pianote leading-normal text-center sm:text-left tracking-widest">MEET YOUR COACH</h6>
                    <h2 class="text-center sm:text-left"><strong>Lisa Witt</strong></h2>
                    <p class="leading-snug mt-4 lg:mt-6" style="color:#52525A;">
                        I have a confession. <br><br>
                        I suck at reading sheet music! And I always have. I used to memorize pieces and learn them by ear to trick my teacher into thinking I was reading the notes on the page. And when they found out… <br><br>
                        They made me repeat entire levels. <br><br>
                        So why am I telling you this? <br><br>
                        Because, my friend, if someone like ME can learn how to read music, then you can too! <br><br>
                        And that’s why I’m so excited about these lessons. <br><br>
                        Because I’ve broken down the tips, tricks and thought processes that finally helped me crack the musical code, and I’ve put them into 7 super-fun lessons so you don’t have to struggle like I did. <br><br>
                        Learning to read music will open up new worlds for you. <br><br>
                        You’ll be able to pick up a piece of music and just play it. Without having to hear it a bunch of times or search for hours to find a video tutorial. <br><br>
                        I’m so excited for the journey you’re about to start. And I’ll see you in Lesson 1!
                    </p>
                    <img class="h-10 lg:h-16 mt-7 lg:mt-10 lazyload" data-src="https://cdn.musora.com/image/fetch/w_350,q_auto:best/https://pianote.s3.amazonaws.com/products/the-power-of-chords/signature.png" alt="signature">
                </div>
            </div>
        </div>
    </section>

    <section class="py-12 md:py-20 bg-cover bg-center lazyload" data-bg="https://cdn.musora.com/image/fetch/w_1500,q_auto:best/https://pianote.s3.amazonaws.com/lead-gen/7-days-to-sight-reading/footer_7dtsr.jpg">
        <div class="max-w-md md:max-w-4xl mx-auto text-center px-4 lg:px-0">
            <h3 class="text-white font-extrabold leading-snug">
                Learn to read music. <br class="hidden md:inline">
                Play your favorite songs. Have more fun.
            </h3>
            <p class="my-4" style="color:#D0E2E7;">
                7 days of guided lessons and practices to help you learn the language of music.
            </p>
            <div class="max-w-2xl mx-auto">
                @include('pianote._partials._sign-up-form', [
                    "formId" => '{{-- HERE --}}',
                    "formName" => '{{-- HERE --}}',
                    "buttonText" => "Get it now",
                    'disclaimerColor' => '#B3B3B9',
                ])
            </div>
        </div>
    </section>

    <section class="py-12 md:py-20" style="background:#F9F9F9;">
        <div class="max-w-4xl mx-auto px-4 lg:px-0">
            <h3 class="font-extrabold text-center mb-6">Still Have Questions?</h3>
            <div class="dropdowns">
                @include('pianote.products._week-breakdown-2', [
                    "question" => true,
                    "title" => "What happens if I miss a day?",
                    "description" => "That’s totally ok! Life happens. And while this is designed to be completed in a week, the lessons are yours for life. Simply pick up where you left off -- when it suits you."
                ])
                @include('pianote.products._week-breakdown-2', [
                    "question" => true,
                    "title" => "How long do I need to practice each day?",
                    "description" => "Just 15 minutes is all you’ll need to notice an improvement. Of course, you can practice a bit more if you like, but 15 minutes should be enough. And we all have 15 minutes, right?"
                ])
                @include('pianote.products._week-breakdown-2', [
                    "question" => true,
                    "title" => "Why do you need my email?",
                    "description" => 'We need to know where to send your lessons! Also, we’re (not so) secretly hoping to start a relationship with you. It’s our way of saying, “Hey, we make awesome piano lessons, and we’d love to show you”.'
                ])
            </div>
            <div class="text-center" style="color:#2A2F34;">
                <div class="inline-block w-full px-3 md:px-4 my-5">
                    <p>
                        <strong>Any questions?</strong><br class="inline-block md:hidden"> Call us toll-free at
                        <a href="tel:+18004398921">1-800-439-8921</a> <br class="inline-block md:hidden"> or directly at
                        <a href="tel:+16048557605">1-604-855-7605</a>.
                    </p>
                </div>
                <div class="inline-block w-full px-3 md:px-4 text-light-navy" style="margin-top: 0;">
                    <i class="mx-0.5 text-3xl md:text-4xl fab fa-cc-visa"></i>
                    <i class="mx-0.5 text-3xl md:text-4xl fab fa-cc-mastercard"></i>
                    <i class="mx-0.5 text-3xl md:text-4xl fab fa-cc-amex"></i>
                    <i class="mx-0.5 text-3xl md:text-4xl fab fa-cc-paypal"></i>
                    <i class="mx-0.5 text-3xl md:text-4xl fab fa-cc-discover"></i>
                </div>
            </div>
        </div>
    </section>

    <div class="reveal large text-center" id="soundSlice" data-reveal data-reset-on-close="false" style="background-color:transparent;">
        <div class="aspect-16:9 w-full relative">
            <iframe class="absolute w-full h-full reset-on-close" src="" data-lazy-load-url="https://www.soundslice.com/scores/955555/embed/?api=1&amp;scroll_type=2&amp;branding=0" frameborder="0" allowfullscreen allow="autoplay"></iframe>
        </div>
    </div>
@endsection

@section('scripts')
    @parent
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script type="text/javascript" src="{{ asset('/marketing/js/modal.js') }}"></script>
    <script>
        $(document).ready(function () {
            $(document).foundation();

            $('.dropdown').on('click', function(){
                $(this).toggleClass('active');
                $(this).find('i').toggleClass('rotate-180');
            });

            $('.flip-div').click(function (e) {
                $(this).toggleClass('flipped');
            });
        });
    </script>
    <script type="text/javascript" src="{{ asset('/marketing/js/modal-autoplay.js') }}"></script>
@endsection

