@extends('pianote.lead-gen.piano-in-5-days.piano-in-5-days-layout')

@section('extra-style')
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.min.css"/>
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick-theme.min.css"/>
    <link rel="stylesheet" href="{{ asset('/marketing/parcel/pianote/lead-gen-piano-in-5-days.css') }}">
@endsection

@section('page-body')
    <header class="header text-center text-white pt-12 pb-8 sm:py-9 md:py-10 px-4 bg-top bg-no-repeat bg-cover relative" style="background-color:#010519; background-image:url(https://cdn.musora.com/image/fetch/w_2500,q_auto:best/https://pianote.s3.amazonaws.com/lead-gen/piano-in-5-days/header_bg.jpg);">
        <div class="container mx-auto relative z-10 max-w-sm md:max-w-3xl">
            <div class="w-full flex flex-wrap flex-col-reverse justify-center md:flex-row items-center lg:py-20">
                <div class="container w-full md:w-3/5">
                    <img class="h-28 sm:h-40 lg:h-52" src="https://cdn.musora.com/image/fetch/w_900,q_auto:best/https://pianote.s3.amazonaws.com/lead-gen/piano-in-5-days/logo.png">
                    <h4 class="my-3 sm:my-5 leading-normal">Start learning how to play the piano <br><strong>in just 5 days!</strong></h4>
                    <h5 class="leading-normal text-navy" style="color: #A4AFC7"> Step by step lessons will build your basic skills and even teach you your very first song.</h5>
                    <p class="mt-4 sm:mt-5 lg:mt-10 mb-2">Enter your email below for your free lessons.</p>
                    @include('pianote._partials._sign-up-form', [
                        "redirect" => true,
                        "formId" => "Pianote - Engagement - Trigger - Piano In 5 Days - Web Form",
                        "formName" => 'Piano In 5 Days',
                        "stacked" => true
                    ])
                </div>
                <div class="w-full mb-5 md:mb-0 md:w-2/5">
                    <i class="fas fa-play play-button autoplay-video" data-open="trailer"></i>
                </div>
            </div>
        </div>
        <div class="absolute bottom-0 left-0 right-0 h-96 md:h-10 lg:h-20 z-0" style="background:linear-gradient(to bottom, transparent, #021124 80%);"></div>
    </header>

    <div class="reveal large text-center" id="trailer" data-reveal data-reset-on-close="false">
        <div class="aspect-16:9 w-full relative">
            <iframe class="absolute w-full h-full reset-on-close" src="" data-lazy-load-url="//player.vimeo.com/video/669994283?autoplay=1" frameborder="0" allowfullscreen allow="autoplay"></iframe>
        </div>
    </div>

    <section class="content-section text-white overflow-hidden py-10 sm:py-16 text-center px-4 lg:px-5" style="background:linear-gradient(to bottom, #021124, #01050f 60%);">
        <div class="container mx-auto max-w-5xl">
            <p class="leading-normal text-light-navy mt-2 md:mt-4">Your piano journey starts here! 5 days of perfectly structured lessons will<br class="hidden sm:inline"> help you feel confident that you can accomplish anything on the piano.</p>

            @php
                $altSlider = [
                    [
                    'image' => 'https://pianote.s3.amazonaws.com/lead-gen/piano-in-5-days/day1_cards.jpg',
                    'day' => 1,
                    'title' => 'WELCOME TO<br> THE PIANO ',
                    'smallInfo' => 'Day one starts off with the basics!  You’ll learn the layout of the keyboard, the musical alphabet, your first scale, and the super easy and fun concept of power chords.',
                    ],
                    [
                    'image' => 'https://pianote.s3.amazonaws.com/lead-gen/piano-in-5-days/day2_cards.jpg',
                    'day' => 2,
                    'title' => 'YOU CAN PLAY<br> A MELODY',
                    'smallInfo' => 'Time to learn a melody! You’ll use your new skills and musical knowledge from day one to start playing a beautiful melody by ear.',
                    ],
                    [
                    'image' => 'https://pianote.s3.amazonaws.com/lead-gen/piano-in-5-days/day3_cards.jpg',
                    'day' => 3,
                    'title' => 'USING<br> BOTH HANDS',
                    'smallInfo' => 'These lessons focus on one of the most important skills when learning the piano – playing with both hands. You’ll add to the melody you learned on day 2 to play something amazing!',
                    ],
                    [
                    'image' => 'https://pianote.s3.amazonaws.com/lead-gen/piano-in-5-days/day4_cards.jpg',
                    'day' => 4,
                    'title' => 'READING<br> MUSIC',
                    'smallInfo' => 'Reading music allows you to play more songs on the piano! This introduction to reading music will show you how to read and identify the notes on the piano that you’ve already been playing.',
                    ],
                    [
                    'image' => 'https://pianote.s3.amazonaws.com/lead-gen/piano-in-5-days/day5_cards.jpg',
                    'day' => 5,
                    'title' => 'YOU CAN<br> PLAY PIANO',
                    'smallInfo' => 'Time to play a REAL song using everything you’ve learned so far! You’ll also get some new ideas to take away and practice, and ways to keep exploring the piano.',
                    ],
                ]
            @endphp
            <div class="slick-2 mx-auto mb-12 mt-7 md:my-10 max-w-md md:max-w-3xl lg:max-w-full h-64 sm:h-80">
                @foreach($altSlider as $altSlide)
                    <div class="slick-slide px-1">
                        <div class="mx-auto" style="max-width:215px">
                            <div class="flip-div inline-block relative w-full group" style="perspective: 1000px;">
                                <div class="text-center w-full h-full absolute cursor-pointer" style="transform-style: preserve-3d;">
                                    <div class="front absolute z-20 overflow-hidden rounded-xl w-full h-full transition-transform duration-700" style="backface-visibility: hidden;">
                                        <div class="bg-image w-full bg-black bg-top bg-cover lazyload" data-bg="https://cdn.musora.com/image/fetch/w_1000,q_auto:best/{{ $altSlide['image'] }}"></div>
                                        <div class="font-bebas absolute uppercase w-full bottom-3 px-3 text-center lg:bottom-5 z-10">
                                            <div class="bg-pianote inline-block px-4 text-2xl mb-3">DAY {{ $altSlide['day']}}</div>
                                            <h2 class="font-bebas text-3xl mb-0.5" style="line-height:0.85em">{!! $altSlide['title']  !!}</h2>
                                        </div>
                                        <div class="absolute inset-0 z-0" style="background:linear-gradient(to bottom, transparent 30%, #010510);"></div>
                                    </div>
                                    <div class="back absolute z-40 overflow-hidden rounded-xl w-full h-full transition-transform duration-700" style="backface-visibility: hidden;">
                                        <div class="w-full h-full mx-auto text-center text-white flex {{--flex-col--}} flex-wrap justify-center items-center content-center p-1 md:p-3" style="background:linear-gradient(180deg, #01101D 0%, rgba(1, 16, 29, 0) 100%);">
                                            {{--<h4 class="font-bebas text-navy">DAY {{ $altSlide['day'] }}</h4>--}}
                                            <h4 class="font-bebas mb-1">{!!  str_replace('<br>', ' ', $altSlide['title'])  !!}</h4>
                                            <p class="leading-tight mx-auto text-sm">{!! $altSlide['smallInfo'] !!}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <section class="overflow-hidden relative text-white text-center pt-10 pb-16 sm:pb-10" style="background-color:#01030f;">
        <div class="container mx-auto max-w-4xl">
            <h4 class="mb-10 md:mb-12 font-bold">Your Clear Path <br class="sm:hidden">To Playing Piano</h4>
            <div class="flex flex-wrap justify-center px-4 lg:px-0">
                @php
                    $topics = [
                        [
                        'image' => 'https://pianote.s3.amazonaws.com/products/classical-piano/guided-icon.svg',
                        'title' => 'GUIDED LESSONS',
                        'description' => 'You’ll know exactly what to play and practice with our carefully designed step-by-step lessons.',
                        ],
                        [
                        'image' => 'https://pianote.s3.amazonaws.com/products/classical-piano/sheetmusic-icon.svg',
                        'title' => 'FREE SHEET MUSIC',
                        'description' => 'Get downloadable sheet music for the 4 main pieces in this course along with 4 bonus pieces.',
                        ],
                        [
                        'image' => 'https://pianote.s3.amazonaws.com/products/classical-piano/learnanytime-icon.svg',
                        'title' => 'LEARN ANYTIME',
                        'description' => 'Pianote’s online structure allows you to learn and progress at your own pace.',
                        ],
                        [
                        'image' => 'https://pianote.s3.amazonaws.com/products/classical-piano/question-icon.svg',
                        'title' => 'PERSONAL SUPPORT',
                        'description' => 'Ask your biggest questions and get personalized feedback from teachers and connect with other students.',
                        'lastOne' => true,
                        ],
                    ]
                @endphp
                @foreach($topics as $topic)
                    <div class="w-full sm:w-1/2 flex items-center text-left @if(empty($topic['lastOne'])) mb-8 @else sm:mb-8 @endif px-3">
                        <img class="w-12 md:w-16 mr-4" src="{{ $topic['image'] }}">
                        <div>
                            <h5 class="font-bebas leading-none mb-2">{{ $topic['title'] }}</h5>
                            <p class="leading-normal text-navy">{{ $topic['description'] }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <section class="text-white relative py-12 px-5 lazyload" style="background: #781d32">
        <img class="h-60 absolute left-0 top-0 bottom-0 my-auto sm:h-full z-10" src="https://cdn.musora.com/image/fetch/w_300,q_auto:best/https://pianote.s3.amazonaws.com/lead-gen/piano-in-5-days/piano_icon.png" alt="piano"/>
        <img class="h-60 absolute right-0 top-0 bottom-0 my-auto sm:h-full z-10" src="https://cdn.musora.com/image/fetch/w_300,q_auto:best/https://pianote.s3.amazonaws.com/lead-gen/piano-in-5-days/calendar_icon.png" alt="piano"/>
        <div class="relative text-center z-30">
            <h3 class="font-extrabold mb-3 leading-normal">But Can You Really Learn<br class="sm:hidden"> The Piano In 5 Days?</h3>
            <p>
                Well, not exactly. You can’t just practice for 5 days and become an expert on the piano. But<br class="hidden md:inline">you can start! And you'd be amazed at just how much you can accomplish in 5 short days.<br><br>

                This course is not going to teach you Moonlight Sonata, but it will prove that you (yes even<br class="hidden md:inline">you!) can play the piano and sound great doing it.<br><br>

                This is your doorway into a whole new world of music. All you have to do is open it.
            </p>
        </div>
    </section>

    <section class="text-center text-white relative pt-52 pb-8 md:py-12 lg:py-23 px-4 teacher-section bg-no-repeat bg-center lazyload" data-bg="https://cdn.musora.com/image/fetch/w_1600,q_auto:best/https://pianote.s3.amazonaws.com/lead-gen/piano-in-5-days/teacher_bg.jpg">
        <div class="container mx-auto relative z-10">
            <div class="flex flex-wrap items-center justify-end mx-auto max-w-sm md:ml md:max-w-6xl md:px-3">
                <div class="w-full md:w-7/12 lg:w-1/2 z-20">
                    <h1 class="font-extrabold text-5xl lg:text-7xl">LISA WITT</h1>
                    <h6 class="font-bold lg:text-2xl">Your Personal Piano Teacher</h6>
                    <img class="my-3" src="https://pianote.s3.amazonaws.com/lead-gen/piano-in-5-days/teacher-graphic.png">
                    <p class="leading-normal text-left max-w-md" style="color:#ABB5C2;">
                        Lisa Witt has reached millions of people around the world through her online lessons, and now you can learn to play the piano from her in just 5 days! 20 years of teaching experience, training through the Royal Conservatory of Music, and embracing all styles of playing has equipped her to teach you just about anything you’d ever want to learn on the piano. Lisa’s contagious enthusiasm will have you excited every time you sit down to play and will make learning the piano a super fun and engaging experience.
                    </p>
                </div>
            </div>
        </div>
        <div class="teacher-gradient z-0 absolute top-0 bottom-0 left-0 right-0"></div>
    </section>

    @php
        $testimonials = [
            [
            'image' => 'https://pianote.s3.amazonaws.com/sales/2022/testimonials/dhivyasubramanian.jpg',
            'title' => "I love the energy Lisa brings to every lesson.",
            'description' => "I love the energy Lisa brings to every lesson and how she makes everything look fun and easy enough to try.<br><br>I wasn’t sure if video lessons would be engaging enough and if it would be easy to learn virtually. But I enjoy learning at my own pace and having the freedom to choose what I want to learn – playing some of my favorite songs and gaining the tools to explore and play with confidence in front of people. I would highly recommend Pianote.",
            'name' => 'Dhivya Subramanian',
            'location' => 'Singapore',
            'next' => 'EdKirk',
            'prev' => false,
            ],
            [
            'image' => 'https://pianote.s3.amazonaws.com/sales/2022/testimonials/edkirk.jpg',
            'title' => "I like that I can take a lesson any time of day or night.",
            'description' => "I played organ 45 years ago but had not touched any keyboard in 30 years. Essentially I was starting over from scratch.<br><br>It must have been my second or third lesson when I knew I had found the right place. I like Lisa’s style of teaching – and I found I actually LIKE doing the work and won’t mark a lesson complete until I have thoroughly mastered it. And I like that I can take a lesson any time of day or night.<br><br>I can’t imagine there is any better way to learn. I can go back and review the details of any lesson over and over if needed. Could never do that with live lessons.",
            'name' => 'Ed Kirk',
            'location' => 'Florida, USA',
            'next' => 'DebbieReed',
            'prev' => 'DhivyaSubramanian',
            ],
            [
            'image' => 'https://pianote.s3.amazonaws.com/sales/2022/testimonials/debbiereed.jpg',
            'title' => "The support you receive will keep you wanting to learn.",
            'description' => "I tried to learn on my own. This turned out to be very frustrating. I needed some guidance, more structure, and more support.<br><br>With Pianote, I was inspired from the very first video I watched. I am able to spend time learning each lesson before moving on – and having questions answered helps so much. Because piano is new to me, doubt would creep in. I felt I would never be able to play well. But practice and awareness of the keyboard has been what I needed. The support you receive will keep you wanting to learn, and having fun with the love of piano.",
            'name' => 'Debbie Reed',
            'location' => 'North Carolina, USA',
            'next' => false,
            'prev' => 'EdKirk',
            ],
        ];
    @endphp

    <section class="text-center text-white py-10 sm:py-20 lg:py-28 px-4" style="background: #01101D;">
        <div class="container max-w-4xl mx-auto">
            <h4 class="mb-6 sm:mb-10"><strong>Real Students. Real Success Stories.</strong></h4>
            <div class="flex flex-auto flex-col md:flex-row justify-between md:px-4 lg:px-0">
                @foreach($testimonials as $testimonial)
                    <div class="flex flex-auto md:flex-row testimonial w-full px-2 md:w-1/3 pb-2 md:pb-4">
                        <div class="w-full rounded-xl overflow-hidden" style="background: #051124;" @if(empty($testimonial['trailer'])) data-open="{!!  str_replace(' ', '', $testimonial['name'])  !!}" @endif >
                            <div class="thumb relative bg-top bg-cover cursor-pointer autoplay-video lazyload" style="padding-bottom:75%" data-bg="https://cdn.musora.com/image/fetch/w_500,q_auto:best/{{ $testimonial['image'] }}" @if(!empty($testimonial['trailer'])) data-open="{!!  str_replace(' ', '', $testimonial['name'])  !!}Trailer" @endif>
                                @if(!empty($testimonial['trailer']))
                                    <i class="absolute z-10 top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 fas fa-play play-button smaller"></i>
                                @endif
                            </div>
                            <div class="p-4 cursor-pointer" @if(!empty($testimonial['trailer'])) data-open="{!!  str_replace(' ', '', $testimonial['name'])  !!}" @endif>
                                <p class="leading-tight"><em>{!!  $testimonial['title'] !!}</em></p>
                                <h6 class="leading-tight mt-3 mb-1 uppercase font-bebas text-pianote">{!!  $testimonial['name'] !!}</h6>
                                <p class="leading-normal text-light-navy text-sm"><em><u>Read more</u> &nbsp;<i class="fas fa-expand"></i></em></p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    @foreach($testimonials as $testimonial)
        <div class="reveal large relative coach-wrap rounded-xl text-center overflow-visible select-none max-w-xs md:max-w-md" id="{!!  str_replace(' ', '', $testimonial['name'])  !!}" data-reveal data-reset-on-close="false">
            @if($testimonial['prev'] != false)
                <i class="absolute transform -translate-y-1/2 top-44 md:top-60 text-white cursor-pointer py-2.5 pr-2.5 md:pr-5 text-5xl md:text-6xl fas fa-angle-left -left-7 md:-left-10" data-close data-open="{{ $testimonial['prev'] }}"></i>
            @else
                <i class="absolute transform -translate-y-1/2 top-44 md:top-60 text-white cursor-pointer py-2.5 pr-2.5 md:pr-5 text-5xl md:text-6xl fas fa-angle-left -left-7 md:-left-10 opacity-50"></i>
            @endif
            <div class="relative rounded-t-lg pb-60 md:pb-96 bg-top bg-cover bg-black lazyload" data-bg="https://cdn.musora.com/image/fetch/w_800,q_auto:best/{{ $testimonial['image'] }}"></div>
            <div class="p-4 md:p-5">
                <h2 class="leading-none font-bebas">{!!  str_replace('<br>', ' ', $testimonial['name'])  !!}</h2>
                <p class="text-coaches uppercase mx-auto mb-3 md:mb-2">{!!  $testimonial['location'] !!}</p>
                <p class="mx-auto mt-2 mb-3 md:mb-2 leading-tight"><strong>{!!  $testimonial['title'] !!}</strong></p>
                <p class="mx-auto text-left leading-normal md:leading-normal">{!! $testimonial['description'] !!}</p>
            </div>
            @if($testimonial['next'] != false)
                    <i class="absolute transform -translate-y-1/2 top-44 md:top-60 text-white cursor-pointer py-2.5 pl-2.5 md:pl-5 text-5xl md:text-6xl fas fa-angle-right -right-7 md:-right-10" data-close data-open="{{ $testimonial['next'] }}"></i>
                @else
                    <i class="absolute transform -translate-y-1/2 top-44 md:top-60 text-white cursor-pointer py-2.5 pl-2.5 md:pl-5 text-5xl md:text-6xl fas fa-angle-right -right-7 md:-right-10 opacity-50"></i>
                @endif
        </div>
    @endforeach

    <section class="text-center py-14 md:py-20 lg:py-24 text-white bg-black bg-center bg-cover lazyload" style="background-color:#000417;" data-bg="https://cdn.musora.com/image/fetch/w_1500,q_auto:best/https://pianote.s3.amazonaws.com/lead-gen/piano-in-5-days/bottom_bg.jpg">
        <div class="container mx-auto">
            <div class="w-full px-2 md:px-3 text-center">
                <img class="mx-auto h-28 sm:h-40 lg:h-52 lazyload" data-src="https://cdn.musora.com/image/fetch/w_900,q_auto:best/https://pianote.s3.amazonaws.com/lead-gen/piano-in-5-days/logo.png">
                <h5 class="mt-5 lg:mt-4 mb-6 lg:mb-8 leading-normal" style="color:#D0E2E7;">Start your piano journey today.<br>
                <strong>Enter your email below for your free course.</strong></h5>
                <div class="mx-auto" style="max-width:700px">
                    @include('pianote._partials._sign-up-form', [
                        "redirect" => true,
                        "formId" => "Pianote - Engagement - Trigger - Piano In 5 Days - Web Form",
                        "formName" => 'Piano In 5 Days',
                    ])
                </div>
            </div>
        </div>
    </section>

@endsection

@section('scripts')
    @parent
    <script>
        $(document).ready(function () {
            $(document).foundation();

            $('.slick-2').slick({
                slidesToShow: 5,
                slidesToScroll: 1,
                responsive: [
                    {
                        breakpoint: 1024,
                        settings: {
                            slidesToShow: 3
                        }
                    },
                    {
                        breakpoint: 768,
                        settings: {
                            slidesToShow: 2
                        }
                    }
                ]
            });

            $('.flip-div').click(function (e) {
                $(this).toggleClass('flipped');
            });
        });
    </script>
    <script type="text/javascript" src="{{ asset('/marketing/js/modal.js') }}"></script>
    <script type="text/javascript" src="{{ asset('/marketing/js/modal-autoplay.js') }}"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.min.js"></script>
@endsection
