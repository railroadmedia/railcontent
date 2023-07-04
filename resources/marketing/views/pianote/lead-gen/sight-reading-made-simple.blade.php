@extends('pianote.lead-gen.lead-gen-layout-tw')

@section('meta')
    @parent
    <title>Sight-Reading Made Simple | Pianote</title>
    <meta name="description" content="If you’ve ever struggled through a music class or felt daunted by the notes on the page -- let us show you how easy reading music can be.">

    <meta property="og:image" content="https://d2vyvo0tyx8ig5.cloudfront.net/sight-reading-made-simple/og-image.jpg" style="display: none;">
    <meta property="og:title" content="Sight-Reading Made Simple">
    <meta property="og:description" content="If you’ve ever struggled through a music class or felt daunted by the notes on the page -- let us show you how easy reading music can be.">
    <meta property="og:url" content="https://www.pianote.com/sight-reading-made-simple">

@endsection

@section('head')
    <link href="{{ asset('/marketing/parcel/drumeo/lead-gen-learn-songs.css') }}" rel="stylesheet">

    <style>

        .join.smaller {
            padding:8px 20px;
            font-size:14px;
        }

        @media only screen and (min-width:40em) {
            .join.smaller {
                font-size:16px;
                padding:13px 30px;
            }
        }
    </style>
    <style>
        .header-bg {
            background: linear-gradient(180deg, rgba(20, 20, 22, 0) 30%, #141416 55%), url("https://d2vyvo0tyx8ig5.cloudfront.net/sight-reading-made-simple/header.jpg") 60% 0/800px no-repeat;
        }

        .teacher-section {
            background: linear-gradient(90deg,#000 0,transparent 70%),url(https://d2vyvo0tyx8ig5.cloudfront.net/sight-reading-made-simple/meet-lisa.jpg) 58% 50%/cover no-repeat;
        }

        .final {
            background: #171717 url(https://d2vyvo0tyx8ig5.cloudfront.net/sales/customize-bg.jpg) 50%/cover;
        }

        .first-letter {
            margin-right: 7px;
            border-radius: 5px;
            width: 44px;
            line-height: 44px;
        }

        @media (min-width: 768px) {
           .header-bg {
                background: linear-gradient(to top, #141416 0, rgba(20, 20, 22, 0) 70%), url("https://d2vyvo0tyx8ig5.cloudfront.net/sight-reading-made-simple/header.jpg") 65% 0/cover no-repeat;
           }

           .teacher-section {
                background: #000 url(https://d2vyvo0tyx8ig5.cloudfront.net/sight-reading-made-simple/meet-lisa.jpg) 50%/cover no-repeat;
            }
        }

        @media (min-width: 1024px) {
            .header-bg {
                background-position: 50% 0;
            }

            .first-letter {
                width: 50px;
                font-size: 35px;
                line-height: 50px;
            }
        }


    </style>
@endsection

@php
    $learnings = [
        [
            "imgSrc" => "https://d2vyvo0tyx8ig5.cloudfront.net/sight-reading-made-simple/thumb1.jpg",
            "title" => "Notes & Rhythm",
            "desc" => "Learn the different types of notes used in music -- and what they mean. How to count rhythm and understand time signatures.",
        ],
        [
            "imgSrc" => "https://d2vyvo0tyx8ig5.cloudfront.net/sight-reading-made-simple/thumb2.jpg",
            "title" => "The Treble Clef",
            "desc" => "How the notes on the keyboard translate to the page. Learn the notes of the Treble Clef AND how to remember them.",
        ],
        [
            "imgSrc" => "https://d2vyvo0tyx8ig5.cloudfront.net/sight-reading-made-simple/thumb3.jpg",
            "title" => "The Bass Clef",
            "desc" => "Learn the names of all the notes in the Bass Clef for your left hand. Warning -- they’re not the same as the Treble Clef!",
        ],
        [
            "imgSrc" => "https://d2vyvo0tyx8ig5.cloudfront.net/sight-reading-made-simple/thumb4.jpg",
            "title" => "The Grand Staff",
            "desc" => "Learn WHY the Treble and Bass Clef are different, and how they all tie together in the Grand Staff. You’ll play a song hands together by reading the notes on the page.",
        ],
        [
            "imgSrc" => "https://d2vyvo0tyx8ig5.cloudfront.net/sight-reading-made-simple/thumb5.png",
            "title" => "Symbol Glossary",
            "desc" => "A downloadable chart of many of the strange symbols you can expect to see on sheet music. Print it out and keep it at the piano so you never forget a thing!",
            "bonus" => true,
        ],
    ];

    $features = [
        [
            "icon" => "fa-list-ol",
            "title" => "GUIDED LESSONS",
            "desc" => "You’ll learn how to read at the right pace with carefully designed step-by-step lessons.",
        ],
        [
            "icon" => "fa-music",
            "title" => "READ MUSIC ON THE FLY",
            "desc" => "Connect the notes on the page to the keys on the piano. We simplify sheet music to show you WHY music is arranged<br class='md:hidden'> the way it is.",
        ],
        [
            "icon" => "fa-piano-keyboard",
            "title" => "UNLOCK THE KEYBOARD",
            "desc" => "Play music more easily with our tips and tricks that will allow you to read music FASTER.",
        ],
        [
            "icon" => "fa-question",
            "title" => "YOUR BIGGEST QUESTIONS",
            "desc" => "Ask ANY question and get personalized feedback and support from real teachers. Connect with other students for advice and encouragement in our forums.",
        ],
    ];

    $testimonials = [
        [
            "imgSrc" => "https://d2vyvo0tyx8ig5.cloudfront.net/sales/testimonials/lynda-burton.jpg",
            "comment" => "I’ve taken piano lessons in the past, but not recently. I thought I’d give Pianote a try, and I’m glad I decided to.<br><br>
            I’m learning to read sheet music quicker than I ever did while taking private piano lessons.",
            "name" => "LYNDA BURTON",
            "country" => "WYOMING",
        ],
        [
            "imgSrc" => "https://d2vyvo0tyx8ig5.cloudfront.net/500-songs/sales/marcel.jpg",
            "comment" => "From the first couple of days of joining Lisa has been there to keep me on my game. I really can’t ask for a better piano teacher, she is simply extraordinary! Every single time I ask a question I get an answer. Lisa may not know it, but she is truly a natural at delivering and teaching the material.",
            "name" => "MARCEL ROBICHAUD",
            "country" => "CANADA",
        ],
        [
            "imgSrc" => "https://d2vyvo0tyx8ig5.cloudfront.net/500-songs/sales/wastmacott.jpg",
            "comment" => "This was my first try reading music, and Lisa made it really simple. It was just the right learning process for me, and it’s changed my playing a lot.<br><br>I would encourage others to enroll with Pianote. It’s worth the time and money",
            "name" => "GRACE MESTMACOTT",
            "country" => "NEW ZEALAND",
        ],
    ];
@endphp

@section('page-body')
    @include('pianote.lead-gen.partials.header1',[
        "upperImg" => '<img class="h-12 md:h-20 lg:h-24 block mx-auto" src="https://d2vyvo0tyx8ig5.cloudfront.net/sight-reading-made-simple/logo.png" alt="sight-reading-made-simple">',
        "text" => '
            <div class="text-lg md:text-2xl lg:text-3xl">
                Start <strong>Reading Music On<br class="md:hidden"> The Piano</strong> <em>In Minutes!</em>
            </div>
            <p class="mb-4 md:mb-7 md:text-lg">
                Reading music does not have to be daunting. Learn today with Lisa Witt’s 4-video course <br class="hidden md:inline">
                on “Sight-Reading Made Simple”.  If you’ve ever struggled through a music class or felt  <br class="hidden md:inline">
                daunted by the notes on the page -- let us show you how easy reading music can be.
            </p>
        ',
        "playButtonStyles" => "my-20 md:my-44 lg:my-48",
        "formId" => "Pianote - Engagement - Trigger - Sight Reading - Web Form",
        "formName" => 'Sight Reading Made Simple',
    ])

    {{-- <div class="modal fade text-center" id="trailer" tabindex="-1" role="dialog" aria-labelledby="trailerLabel">
        <i class="close stop-play fas fa-times" data-dismiss="modal" aria-label="Close"></i>
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="embed-responsive embed-responsive-16by9">
                    <iframe class="embed-responsive-item reset-on-close" src="" data-lazy-load-url="//player.vimeo.com/video/366845102?autoplay=1" frameborder="0" allowfullscreen allow="autoplay"></iframe>
                </div>
            </div>
        </div>
    </div> --}}

    <section class="day-breakdown text-center container mx-auto py-12 px-4 md:py-14 lg:max-w-5xl">
        <div class="font-bold text-2xl mb-12 md:text-3xl lg:text-4xl">
            Learning To Read Music Doesn’t<br class="hidden md:inline"> Have To Be Hard -- <s style="opacity:0.4">Only $19</s> <u>FREE!</u>
        </div>

        @foreach ($learnings as $learning)
            <div class="flex items-center mb-5 px-4 flex-col w-72 mx-auto md:flex-row md:w-full">
                <img class="rounded-2xl border-solid border-4 mb-2 md:mb-0 md:w-1/3" src="{{ $learning['imgSrc'] }}" alt="{{ $learning['title'] }}" style="border-color: @if(!empty($learning['bonus'])) #f6bd52 @else #f61a30 @endif;">

                <p class="text-left text-sm md:pl-4 md:pr-6 md:w-2/3">
                    <strong class="text-base md:text-lg">{{ $learning['title'] }}</strong><br>
                    {{ $learning['desc'] }}
                </p>
            </div>
        @endforeach
    </section>

    <section class="text-center py-12 md:py14" style="background: #e9edf0;">
        <div class="container mx-auto px-4 lg:max-w-5xl">
            <h1 class="font-bold text-2xl mb-12 md:text-3xl lg:text-4xl">Your Clear Path<br class="md:hidden"> To Reading Music</h1>
            <div class="md:text-lg md:mt-3 md:mb-12">
                Learning to read music is much easier with a teacher to show you how. Lisa will guide you step-by-step through the learning process, so you can be sure you’re learning the right concepts at the right time. You won’t feel overwhelmed as she presents new ideas in a clear and fun way.
                <br><br>
                And you’ll have direct access to Lisa and other teachers to answer any questions you might have along the way.
            </div>
            <div class="flex flex-wrap flex-col items-center md:flex-row">
                @foreach ($features as $feature)
                    <div class="flex w-1/2 px-4 flex-col items-center mb-4 md:mb-12 lg:flex-row">
                        <i class="fas {{ $feature['icon'] }} flex-grow-0 flex-shrink-0 items-center justify-center border-solid border-2 rounded-full w-16 h-16 md:w-20 md:h-20 text-4xl mb-4 lg:mb-0" style="border-color:#f61a30; color:#f61a30; display: flex;"></i>
                        <p class="lg:text-left lg:pl-5" style="font-size: 13px;">
                            <strong class="text-pianote text-xl">{{ $feature['title'] }}</strong><br>
                            {!! $feature['desc'] !!}
                        </p>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <section class="teacher-section">
        <div class="background py-5 px-1 md:py-32 md:px-4">
            <div class="container mx-auto px-4 lg:max-w-5xl text-white">
                <div class="font-bold text-lg md:text-2xl md:mb-10 lg:text-4xl">Meet Your Teacher<br> - Lisa Witt</div>
                <p class="w-1/2 mx-0">
                    <em>
                        "Lisa is the perfect teacher. Her hands-on teaching approach is invaluable to my learning and helps me make progress more easily."
                    </em>
                </p>
                <div class="avatar-name flex items-center font-roboto">
                    <img class="rounded-full border-solid border-white border-2 w-12 mr-4" src="https://d2vyvo0tyx8ig5.cloudfront.net/500-songs/sales/bernhard.jpg" alt="bernhard">
                    <p class="mx-0 text-sm leading-none">
                        <strong>BERNHARD ZAINSINGER</strong><br><em class="text-pianote">SWITZERLAND</em>
                    </p>
                </div>
            </div>
        </div>
    </section>

    <section class="pt-7 px-3 md:pt-10 md:px-4">
        <div class="container mx-auto lg:max-w-5xl">
            <p style="column-count: 2">
                <span class="inline-block float-left text-center first-letter bg-pianote text-white font-black">R</span>eading notes and music on a page can be really confusing. But it doesn’t have to be!
                <br><br>
                Lisa Witt has been teaching the piano for 18 years and has seen countless students struggle to grasp the concept of musical notation.
                <br><br>
                “Looking at musical notation can be really daunting, especially if you’re trying to learn on your own,” she says.
                <br><br>
                “With this training pack, you'll learn the concepts in simple terms, so you can approach music with confidence.”
                <br><br>
                Lisa has designed Sight-Reading Made Simple to teach you how to read notes on a musical staff, as well as give you tips on how to sight-read quickly, so you can start playing songs.
                <br><br>
                “You won’t have to sit through hours of lessons. In just a few minutes, you’ll be on your way to reading notes on a musical score,” she says.
                <br><br>
                “But more importantly, you’ll understand WHY the notes are arranged the way they are.”
                <br><br>
                That’s the key to unlocking your potential with sight-reading. Understanding how the keys on the piano translate to the page will open up a whole new world of song-learning (and writing) possibilities.
                <br><br>
                “It’s like learning the best language in the world!”
            </p>
        </div>
    </section>

    <div class="testimonials mt-7 pt-7 pb-10 md:mt-9 md:pt-9 md:pb-16" style="border-top: 1px solid #eee;">
        <div class="container mx-auto lg:max-w-5xl flex flex-wrap">
            @foreach ($testimonials as $testimonial)
                <div class="testimonial px-4 w-full text-center md:w-1/3">
                    <img class="w-24 rounded-full border-white border-solid border-4 mb-4" src="{{ $testimonial['imgSrc'] }}" style="box-shadow: 0 0 7px rgb(0 0 0 / 20%);" alt="{{ $testimonial['name'] }}">
                    <p class="text-sm leading-6">
                        <em>
                            "{!! $testimonial['comment'] !!}"
                        </em>
                        <br>
                        <strong class="font-roboto block leading-none mt-5">{{ $testimonial['name'] }}</strong>
                        <em class="font-roboto block text-pianote leading-none">{{ $testimonial['country'] }}</em>
                    </p>
                </div>
            @endforeach
        </div>
    </div>

    <section class="py-12 md:py-14" style="background: #e9edf0;">
        <div class="container mx-auto lg:max-w-5xl flex">
            <div class="w-full md:w-1/3 px-4">
                <div class="font-bold mb-4 md:mb-6 md:tex-lg lg:text-2xl">Is this really free?</div>
                <p class="text-sm lg:text-base">
                    Yes! This 4-video training pack sold for $19 but we’re now making it free. We love sharing lessons and videos to help piano players, and reading music is a great skill to develop. We hope you’ll see some of the value we provide inside Pianote juuuust in case you ever want to consider joining!
                </p>
            </div>
            <div class="w-full md:w-2/3 px-4">
                <div class="font-bold mb-4 md:mb-6 md:tex-lg lg:text-2xl">Why do I need to give my email address?</div>
                <p class="text-sm lg:text-base">
                    Well, we want to get to know you! We think of this like a “first date”, and hopefully the start of a beautiful relationship. We create a lot of great piano-related content, and we’ve love to show you. Don’t worry, we won’t send you spam or share your email address with anyone else. You’ll get all these lessons along with ongoing free lessons and some special offers. If you don’t like what we send you, you can unsubscribe at any time. But we promise to only send emails that WE would want to read ourselves.
                </p>
            </div>
        </div>
    </section>

    <section class="final text-center text-white py-14 md:py-20">
        <div class="container mx-auto lg:max-w-5xl">
            <img class="h-16 md:h-24 lg:h-32" src="https://d2vyvo0tyx8ig5.cloudfront.net/sight-reading-made-simple/logo.png" alt="sight-reading-made-simple-logo">
            <div class="my-6 md:my-9 md:text-lg lg:text-xl">
                Enter your email address to get the ENTIRE <br class="hidden md:inline">
                4-video course on Sight-Reading Made Simple. <br class="hidden md:inline">
                We’ll email you the access link within 5 minutes.
            </div>
            <div class="max-w-lg px-4 mx-auto">
                @include('pianote._partials.sign-up-form', [
                    "recaptchaKey" => $recaptchaKey,
                    "stacked" => true,
                    "formId" => "Pianote - Engagement - Trigger - Sight Reading - Web Form",
                    "formName" => 'Sight Reading Made Simple',
                ])
            </div>
        </div>
    </section>

    @include("pianote.sales.partials._footer", [
            "minimal" => true
        ])

    @include('pianote.lead-gen.partials.video-player',[
        "name" => "trailer",
        "vimeoId" => "366845102",
    ])


@stop

@section('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="{{ asset('/marketing/js/modal-autoplay-bootstrap.js') }}"></script>
    <script type="text/javascript" src="{{ asset('/marketing/js/modal-autoplay.js') }}"></script>
    <script type="text/javascript" src="{{ asset('/marketing/js/modal.js') }}"></script>
    <script>
        $(document).ready(function(){
            $(document).foundation();
        });
    </script>

@stop
