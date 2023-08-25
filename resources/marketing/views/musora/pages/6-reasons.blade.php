@extends('musora._partials.layout')

@section('head-includes')
    <title>6 Reasons Online Music Lessons Will Help Your Learn Faster | Musora</title>
    <meta property="og:title" content="6 Reasons Online Music Lessons Will Help Your Learn Faster | Musora">

    <meta name="description" content="Online music lessons have grown in popularity because they work!">
    <meta property="og:description" content="Online music lessons have grown in popularity because they work!">

    <meta property="og:url" content="https://www.musora.com/{{ Request::path() }}">
    <meta property="og:image" content="https://dmmior4id2ysr.cloudfront.net/homepage/2023/share-image3.jpg">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@splidejs/splide@4.0.7/dist/css/splide.min.css">
    <style>
        .join {
            display:inline-block;
            font:500 22px/1em 'Bebas Neue', sans-serif;
            letter-spacing:0.1em;
            text-transform:uppercase;
            background:#0c1524;
            border-radius:50px;
            color:#fff;
            padding:17px 7%;
            outline:none;
            cursor:pointer;
            text-align:center;
            user-select:none;
            text-decoration:none;
            transition:background-color 0.3s, color 0.3s, opacity 0.3s;
            box-shadow:0 0 0 rgba(0, 0, 0, 0.35);
        }

        @media (min-width:768px) {
            .join {
                font-size:30px;
            }
        }

        .join:hover, .join:focus {
            color:#fff;
            background:#14233d;
            box-shadow:0 0 7px rgba(0, 0, 0, 0.35);
        }
        .join i {
            transition:all .3s;
            position:relative;
            right:0px;
        }
        .join:hover i {
            right:-3px;
        }

        .join.smaller {
            padding:8px 30px;
            font-size:16px;
        }

        @media (min-width:768px) {
            .join.smaller {
                font-size:18px;
                padding:11px 30px;
            }
        }

        .join.musora-gold {
            background-color:#FFAE00;
            color:#000;
        }

        .join.musora-gold:hover, .join.musora-gold:focus {
            background:#FFAE00;
            color:#000;
        }

        .text-musora-black {
            color:#0c1524;
        }

        .text-musora,
        .text-musora-gold {
            color:#FFAE00;
        }
        .splide__pagination__page.is-active {
            background:#01050F;
            transform:none !important;
        }

        .splide__pagination__page {
            margin:3px 10px !important;
            opacity:1 !important;
        }

        @media (min-width:768px) {
            .splide__pagination__page {
                margin:3px 6px !important;
            }
        }

        .splide__arrow svg {
            fill:#FFAE00 !important;
        }
        p strong {
            font-weight:900;
        }
    </style>
@endsection

@section('layout-scripts')
    <script src="https://cdn.jsdelivr.net/npm/@splidejs/splide@4.0.7/dist/js/splide.min.js"></script>
@endsection

<!-- Main -->
@section('layout-body')
    <section class="text-center relative overflow-hidden py-10 md:py-14 lg:py-16 px-6 sm:px-7">
        <div class="container mx-auto max-w-4xl">
            <h2 class="leading-tight"><strong>6 Reasons Online Music Lessons<br class="hidden sm:inline"> Will Help Your Learn Faster</strong></h2>

            <div class="flex flex-wrap items-center justify-center mt-3 sm:mt-5 mx-auto">
                <a aria-label="Review" class="inline-block sm:hidden" href="https://www.shopperapproved.com/reviews/Musora.com">
                    <i class="align-middle text-lg fas fa-star" style="color: #ffac00;" aria-hidden="true"></i>
                    <i class="align-middle text-lg fas fa-star" style="text-shadow: -2px -1px 1px #f6f8fc;color: #ffac00;" aria-hidden="true"></i>
                    <i class="align-middle text-lg fas fa-star" style="text-shadow: -2px -1px 1px #f6f8fc;color: #ffac00;" aria-hidden="true"></i>
                    <i class="align-middle text-lg fas fa-star" style="text-shadow: -2px -1px 1px #f6f8fc;color: #ffac00;" aria-hidden="true"></i>
                    <i class="align-middle text-lg fas fa-star" style="text-shadow: -2px -1px 1px #f6f8fc;color: #ffac00;" aria-hidden="true"></i>
                    <p class="inline-block leading-tight align-middle pl-1 m-0 font-bold"><u><em>{{ number_format(round(Prices::$reviews, -2)) }}+ Reviews</em></u></p>
                </a>
                <a aria-label="Review" class="hidden sm:inline-block" href="https://www.shopperapproved.com/reviews/Musora.com" target="_blank" onclick="window.open('https://www.shopperapproved.com/reviews/Musora.com', 'newwindow', 'width=750, height=550'); return false;">
                    <i class="align-middle text-lg fas fa-star" style="color: #ffac00;" aria-hidden="true"></i>
                    <i class="align-middle text-lg fas fa-star" style="text-shadow: -2px -1px 1px #f6f8fc;color: #ffac00;" aria-hidden="true"></i>
                    <i class="align-middle text-lg fas fa-star" style="text-shadow: -2px -1px 1px #f6f8fc;color: #ffac00;" aria-hidden="true"></i>
                    <i class="align-middle text-lg fas fa-star" style="text-shadow: -2px -1px 1px #f6f8fc;color: #ffac00;" aria-hidden="true"></i>
                    <i class="align-middle text-lg fas fa-star" style="text-shadow: -2px -1px 1px #f6f8fc;color: #ffac00;" aria-hidden="true"></i>
                    <p class="inline-block leading-tight align-middle pl-1 m-0 font-bold"><u><em>{{ number_format(round(Prices::$reviews, -2)) }}+ Reviews</em></u></p>
                </a>
            </div>
            <picture>
                <source media="(min-width:640px)" srcset="https://www.musora.com/musora-cdn/image/width=1800,quality=95/https://musora-center.s3.amazonaws.com/sales/6-reasons/header.png">
                <img
                    class="w-full my-6 lg:my-10 transition-opacity opacity-0"
                    src="https://www.musora.com/musora-cdn/image/width=600,quality=95/https://musora-center.s3.amazonaws.com/sales/6-reasons/header-m.png"
                    alt="header image"
                    loading="lazy"
                    onload="this.classList.remove('opacity-0')"
                >
            </picture>
            <p class="text-left mb-12 lg:mb-20">You <strong>can</strong> play music like you’ve always wanted – piano, guitar, drums, or singing – learning from scratch at any age, expressing yourself creatively, and playing the songs you love.
<br><br>
                Online music lessons have grown in popularity <strong>because they work</strong>– combining TECHNOLOGY and TRADITION with step-by-step video lessons, helpful practice tools, and all of your favorite songs.
                <br><br>
                It’s easier to get started. You’ll have everything you need in one place, accessible anytime and affordable. And you’ll <strong>keep playing longer</strong> with the world’s best teachers and communities to support your goals.
                <br><br>
                <strong>Here are six reasons you’ll love online music lessons…</strong>
            </p>

            <div class="flex flex-wrap sm:flex-nowrap items-start justify-center text-left mb-16 sm:mb-20">
                <picture class="w-full sm:w-56 flex-shrink-0">
                    <source media="(min-width:640px)" srcset="https://www.musora.com/musora-cdn/image/width=640,quality=95/https://musora-center.s3.amazonaws.com/sales/6-reasons/01-happiness.jpg">
                    <img class="w-full mb-5 sm:mb-0 rounded-xl transition-opacity opacity-0" alt="reason image" loading="lazy" onload="this.classList.remove('opacity-0')"
                        src="https://www.musora.com/musora-cdn/image/width=600,quality=95/https://musora-center.s3.amazonaws.com/sales/6-reasons/01-happiness.jpg"
                    >
                </picture>
                <div class="sm:pl-9 flex-shrink">
                    <h4 class="leading-tight mb-2"><strong>1. Happiness… backed by science!</strong></h4>
                    <p>Studies show that learning and playing an instrument are some of the healthiest activities you can perform for your brain – <strong>boosting happiness</strong>, intelligence, and overall well-being.
                        <br><br>
                        The Independent says learning a musical instrument “has such a <strong>profound influence on mood</strong> that it can increase vigor, excitement and happiness, while <strong>reducing depression</strong>, tension, fatigue, anger, and confusion” – also adding that playing an instrument helps improve mental performance, memory, motor skills, and coordination.
                        <br><br>
                    Online music lessons will help you experience these benefits faster & more often with a flexible schedule, anywhere and anytime it works for you!</p>
                </div>
            </div>
            <div class="flex flex-wrap sm:flex-nowrap items-start justify-center text-left mb-16 sm:mb-20">
                <picture class="w-full sm:w-56 flex-shrink-0">
                    <source media="(min-width:640px)" srcset="https://www.musora.com/musora-cdn/image/width=640,quality=95/https://musora-center.s3.amazonaws.com/sales/6-reasons/02-learn.jpg">
                    <img class="w-full mb-5 sm:mb-0 rounded-xl transition-opacity opacity-0" alt="reason image" loading="lazy" onload="this.classList.remove('opacity-0')"
                        src="https://www.musora.com/musora-cdn/image/width=600,quality=95/https://musora-center.s3.amazonaws.com/sales/6-reasons/02-learn.jpg"
                    >
                </picture>
                <div class="sm:pl-9 flex-shrink">
                    <h4 class="leading-tight mb-2"><strong>2. Learn & play whenever you want.</strong></h4>
                    <p>Traditional private lessons require appointments, sometimes travel, and make you fit your hobby into somebody else’s calendar – while paying more than $30 per 30 minutes.
                        <br><br>
                        You shouldn’t feel panicked trying to rush home, or stressed trying to afford it.
                        <br><br>
                        <strong>Music should serve you!</strong>
                        <br><br>
                        Online music lessons give you 24/7 on-demand access to lessons, songs, and practice tools. Learn when you want to learn. Practice with engaging, interactive tools. Or play your favorite music with 1000+ popular songs with note-for-note transcriptions, just a click away.
                        <br><br>
                        You can start <strong>right now</strong> for free!</p>
                </div>
            </div>
            <div class="flex flex-wrap sm:flex-nowrap items-start justify-center text-left mb-16 sm:mb-20">
                <picture class="w-full sm:w-56 flex-shrink-0">
                    <source media="(min-width:640px)" srcset="https://www.musora.com/musora-cdn/image/width=640,quality=95/https://musora-center.s3.amazonaws.com/sales/6-reasons/03-teachers.jpg">
                    <img class="w-full mb-5 sm:mb-0 rounded-xl transition-opacity opacity-0" alt="reason image" loading="lazy" onload="this.classList.remove('opacity-0')"
                        src="https://www.musora.com/musora-cdn/image/width=600,quality=95/https://musora-center.s3.amazonaws.com/sales/6-reasons/03-teachers.jpg"
                    >
                </picture>
                <div class="sm:pl-9 flex-shrink">
                    <h4 class="leading-tight mb-2"><strong>3. The world’s best teachers.</strong></h4>
                    <p>When you take private lessons, you’re rolling a dice on quality. There are great teachers – and there are also boring, impatient, inexperienced, and disinterested ones. And even when you find the right teacher, you’re limited to one perspective.
                        <br><br>
                        Musora gives you access to the world’s best teachers for piano, guitar, drums, and singing.
                        <br><br>
                        Learn from <strong>renowned clinicians</strong>, pop stars and rock stars, <strong>touring professionals</strong>, published authors, <strong>Grammy Award winners</strong>, and industry icons. Learn the foundations with teachers who’ve designed curriculums just for beginners – or study a specific technique or genre with teachers who live it, every day.
                        <br><br>
                        You’ll expand your musician horizons, stay inspired by the world’s best, and always push your musical abilities to new heights.</p>
                </div>
            </div>
            <div class="flex flex-wrap sm:flex-nowrap items-start justify-center text-left mb-16 sm:mb-20">
                <picture class="w-full sm:w-56 flex-shrink-0">
                    <source media="(min-width:640px)" srcset="https://www.musora.com/musora-cdn/image/width=640,quality=95/https://musora-center.s3.amazonaws.com/sales/6-reasons/04-songs2.jpg">
                    <img class="w-full mb-5 sm:mb-0 rounded-xl transition-opacity opacity-0" alt="reason image" loading="lazy" onload="this.classList.remove('opacity-0')"
                        src="https://www.musora.com/musora-cdn/image/width=600,quality=95/https://musora-center.s3.amazonaws.com/sales/6-reasons/04-songs2.jpg"
                    >
                </picture>
                <div class="sm:pl-9 flex-shrink">
                    <h4 class="leading-tight mb-2"><strong>4. Thousands of songs with note-for-note breakdowns.</strong></h4>
                    <p>The point of learning music is to <strong>PLAY</strong> music.
                        <br><br>
                        That’s why Musora gives you <strong>1000s of popular songs with note-for-note breakdowns</strong> and interactive practice tools like tempo control, section loops, a built-in metronome, and more… accessible on any device, or printable, so you can play your favorite songs anytime!
                        <br><br>
                        Normally sheet music costs you hundreds of dollars per year in addition to your lessons – or most online services are filled with errors, making your playing experience a frustrating one. The Musora song library only includes fully-licensed transcriptions PLUS they’re carefully reviewed by our team of professional transcribers.
                        <br><br>
                        Save some money and play more of your favorite songs when you join today!</p>
                </div>
            </div>
            <div class="flex flex-wrap sm:flex-nowrap items-start justify-center text-left mb-16 sm:mb-20">
                <picture class="w-full sm:w-56 flex-shrink-0">
                    <source media="(min-width:640px)" srcset="https://www.musora.com/musora-cdn/image/width=640,quality=95/https://musora-center.s3.amazonaws.com/sales/6-reasons/05-save.jpg">
                    <img class="w-full mb-5 sm:mb-0 rounded-xl transition-opacity opacity-0" alt="reason image" loading="lazy" onload="this.classList.remove('opacity-0')"
                        src="https://www.musora.com/musora-cdn/image/width=600,quality=95/https://musora-center.s3.amazonaws.com/sales/6-reasons/05-save.jpg"
                    >
                </picture>
                <div class="sm:pl-9 flex-shrink">
                    <h4 class="leading-tight mb-2"><strong>5. Save your hard-earned cash!</strong></h4>
                    <p>Most private music lessons are $30/week – and most learners do a lesson every week, bringing the total to $1560 every year (or $130 per month). A full year of Musora is only $240 – or just $4.62/week, or $20/month.
                        <br><br>
                        So you’ll save $1320 per year compared to private lessons.
                        <br><br>
                        PLUS you’ll have <strong>unlimited lessons</strong> – including the ability to learn <strong>any instrument</strong> at no additional cost. (Because we just want YOU to fall in love with playing music. It’s not about how much content you have access to, it’s about you getting the lessons you want anytime you want them!)</p>
                </div>
            </div>
            <div class="flex flex-wrap sm:flex-nowrap items-start justify-center text-left mb-16 sm:mb-20">
                <picture class="w-full sm:w-56 flex-shrink-0">
                    <source media="(min-width:640px)" srcset="https://www.musora.com/musora-cdn/image/width=640,quality=95/https://musora-center.s3.amazonaws.com/sales/6-reasons/06-love.jpg">
                    <img class="w-full mb-5 sm:mb-0 rounded-xl transition-opacity opacity-0" alt="reason image" loading="lazy" onload="this.classList.remove('opacity-0')"
                        src="https://www.musora.com/musora-cdn/image/width=600,quality=95/https://musora-center.s3.amazonaws.com/sales/6-reasons/06-love.jpg"
                    >
                </picture>
                <div class="sm:pl-9 flex-shrink">
                    <h4 class="leading-tight mb-2"><strong>6. Unlimited love & support.</strong></h4>
                    <p>One last thing :)
                        <br><br>
                        When you join Musora, you’ll join a community of 80,000+ music students from around the world PLUS our in-house team of teachers and mentors to <strong>help you reach your goals</strong>.
                        <br><br>
                        You’ll join a community powered by humans – where you’ll have every question answered, access to live events and personal reviews, and have the support you need to learn your instrument, reach your goals, and live a happier & healthier life with MUSIC.</p>
                </div>
            </div>
            <div class="flex flex-wrap sm:flex-nowrap items-start justify-center text-left mb-16 sm:mb-20">
                <picture class="w-36 sm:w-56 flex-shrink-0">
                    <source media="(min-width:640px)" srcset="https://www.musora.com/musora-cdn/image/width=640,quality=95/https://musora-center.s3.amazonaws.com/sales/6-reasons/guarantee.png">
                    <img class="w-full mb-5 sm:mb-0 rounded-xl transition-opacity opacity-0" alt="reason image" loading="lazy" onload="this.classList.remove('opacity-0')"
                        src="https://www.musora.com/musora-cdn/image/width=600,quality=95/https://musora-center.s3.amazonaws.com/sales/6-reasons/guarantee.png"
                    >
                </picture>
                <div class="sm:pl-9 flex-shrink">
                    <h4 class="leading-tight mb-2"><strong>90-Day Learn To Play Guarantee</strong></h4>
                    <p>As educators, it’s up to us to make sure you learn. Your time is valuable enough, so we really don’t want to waste your money.
                        <br><br>
                        So when you join Musora you’ll get a <strong>7-day free trial</strong> to make sure you love it <strong>PLUS a 90-day guarantee</strong> to give you enough time to see results. If you don’t love your music lessons experience, you’ll get your money back. No questions asked… except, maybe: how could we do better?
                        <br><br>
                        <strong>You’ll only pay if you actually LOVE your music lessons experience.</strong></p>
                </div>
            </div>

            <a class="join musora-gold mb-20 sm:mb-44 w-full" href="/choose-plan">START FOR FREE <i class="fas fa-arrow-right" style="line-height: 0;"></i></a>

            <h2><strong>The Best Music<br class="sm:hidden"> Lessons Ever!</strong></h2>
            <div class="flex flex-wrap my-5 sm:my-9">
                @php
                    $reviews = [
                        [
                        "title" => "The most positive student-focused place!",
                        "description" => "I could not be more THRILLED with Musora!!! This is the most positive, helpful, caring, innovative, knowledgeable, student-focused place on the planet!!! It has been a Godsend for me! <br><br><strong>Kristyn T.</strong>",
                        ],
                        [
                        "title" => "All the instruments for a great price. ",
                        "description" => "I love the fact that I have access to many instruments for a great price. I'm learning to play the piano, which was a passion that I hadn't fulfilled in the past but now I'm so happy for it.<br><br><strong>Juan C.</strong>",
                        ],
                        [
                        "title" => "My daughter danced to my playing!",
                        "description" => "The lightbulb moment happened when my 6 year old daughter started dancing as I played – you must be doing something right if somebody dances when you’re playing, right?<br><br><strong>John M.</strong>",
                        ],
                        [
                        "title" => "Helpful lessons and supportive community. ",
                        "description" => "The materials are in helpful bite-size chunks, the support materials are excellent, the tutors are cheerful, and the online community is very supportive.<br><br><strong>Devon F.</strong> ",
                        ],
                        [
                        "title" => "The best course I’ve ever taken",
                        "description" => "There's really no comparative substitute to learning music. Any way you can learn, I say go for it, but this is the best course I have ever taken.<br><br><strong>Russ W.</strong>",
                        ],
                        [
                        "title" => "Tremendous value. ",
                        "description" => "The value you get with Musora is tremendous. Whether you want to learn to sing, play guitar, play drums, or piano, this site has you covered.<br><br><strong>Dennis R.</strong>",
                        ],
                        [
                        "title" => "Awesome to learn from home!",
                        "description" => "It’s just so awesome to know that I can learn from home and accomplish one of my dreams.<br><br><strong>Jayde M.</strong>",
                        ],
                        [
                        "title" => "Wish I was taught this way earlier!",
                        "description" => "If I had been taught this way as a child, I probably never would have quit<br><br><strong>Serena D.</strong>",
                        ],
                    ]
                @endphp
            <div class="hidden sm:flex flex-wrap items-start text-left justify-center">
                @foreach($reviews as $review)
                    <div class="w-full sm:w-1/3 lg:w-1/4 px-2 lg:px-1 mb-4 lg:mb-2 ">
                        <div class="border-2 border-black rounded-xl px-5 py-9">
                            <div class="text-center">
                                <i class="align-middle text-lg fas fa-star" style="color: #ffac00;" aria-hidden="true"></i>
                                <i class="align-middle text-lg fas fa-star" style="text-shadow: -2px -1px 1px #f6f8fc;color: #ffac00;" aria-hidden="true"></i>
                                <i class="align-middle text-lg fas fa-star" style="text-shadow: -2px -1px 1px #f6f8fc;color: #ffac00;" aria-hidden="true"></i>
                                <i class="align-middle text-lg fas fa-star" style="text-shadow: -2px -1px 1px #f6f8fc;color: #ffac00;" aria-hidden="true"></i>
                                <i class="align-middle text-lg fas fa-star" style="text-shadow: -2px -1px 1px #f6f8fc;color: #ffac00;" aria-hidden="true"></i>
                                <h6 class="leading-tight mt-5 mb-4"><strong>{!! $review['title'] !!}</strong></h6>
                            </div>
                            <div>
                                <p class="leading-normal text-sm">{!! $review['description'] !!}</p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

                <div class="relative flex sm:hidden w-full"
                    x-data="{
            init() {
                new Splide(this.$refs.splide, {
                            classes: {
                                    arrow: 'splide__arrow bg-white opacity-100 top-[38%] shadow-lg h-11 w-11',
                                    prev: 'hidden',
                                    next: 'hidden',
                                    pagination: 'hidden',
                            },
                            perPage: 1.5,
                            drag   : 'free',
                            snap   : false,
                            perMove: 1,
                            type: 'loop',
                            focus: 0,
                            interval: 2000,
                }).mount()
            },
        }"
                >
                    <div x-ref="splide" class="w-full splide">
                        <div class="splide__track relative">
                            <ul class="splide__list">
                                @foreach($reviews as $review)
                                    <li class="splide__slide flex flex-col items-center justify-center">
                                        <div class="flex flex-wrap items-start w-full sm:w-1/3 px-2 lg:px-3 mb-4 lg:mb-6 text-left">
                                            <div class="border-2 border-black rounded-xl px-5 py-9">
                                                <div class="text-center">
                                                    <i class="align-middle text-lg fas fa-star" style="color: #ffac00;" aria-hidden="true"></i>
                                                    <i class="align-middle text-lg fas fa-star" style="text-shadow: -2px -1px 1px #f6f8fc;color: #ffac00;" aria-hidden="true"></i>
                                                    <i class="align-middle text-lg fas fa-star" style="text-shadow: -2px -1px 1px #f6f8fc;color: #ffac00;" aria-hidden="true"></i>
                                                    <i class="align-middle text-lg fas fa-star" style="text-shadow: -2px -1px 1px #f6f8fc;color: #ffac00;" aria-hidden="true"></i>
                                                    <i class="align-middle text-lg fas fa-star" style="text-shadow: -2px -1px 1px #f6f8fc;color: #ffac00;" aria-hidden="true"></i>
                                                    <h6 class="leading-tight mt-5 mb-4"><strong>{!! $review['title'] !!}</strong></h6>
                                                </div>
                                                <div>
                                                    <p class="leading-normal text-sm">{!! $review['description'] !!}</p>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            <a aria-label="Review" class="hidden sm:inline-block" href="https://www.shopperapproved.com/reviews/Musora.com" target="_blank" onclick="window.open('https://www.shopperapproved.com/reviews/Musora.com', 'newwindow', 'width=750, height=550'); return false;">
                <i class="align-middle text-lg fas fa-star" style="color: #ffac00;" aria-hidden="true"></i>
                <i class="align-middle text-lg fas fa-star" style="text-shadow: -2px -1px 1px #f6f8fc;color: #ffac00;" aria-hidden="true"></i>
                <i class="align-middle text-lg fas fa-star" style="text-shadow: -2px -1px 1px #f6f8fc;color: #ffac00;" aria-hidden="true"></i>
                <i class="align-middle text-lg fas fa-star" style="text-shadow: -2px -1px 1px #f6f8fc;color: #ffac00;" aria-hidden="true"></i>
                <i class="align-middle text-lg fas fa-star" style="text-shadow: -2px -1px 1px #f6f8fc;color: #ffac00;" aria-hidden="true"></i>
                <br>
                <p class="inline-block leading-tight align-middle pl-1 m-0 font-bold"><u><em>See {{ number_format(round(Prices::$reviews, -2)) }}+ More Student Reviews</em></u></p>
            </a>
            <a aria-label="Review" class="inline-block sm:hidden" href="https://www.shopperapproved.com/reviews/Musora.com">
                <i class="align-middle text-lg fas fa-star" style="color: #ffac00;" aria-hidden="true"></i>
                <i class="align-middle text-lg fas fa-star" style="text-shadow: -2px -1px 1px #f6f8fc;color: #ffac00;" aria-hidden="true"></i>
                <i class="align-middle text-lg fas fa-star" style="text-shadow: -2px -1px 1px #f6f8fc;color: #ffac00;" aria-hidden="true"></i>
                <i class="align-middle text-lg fas fa-star" style="text-shadow: -2px -1px 1px #f6f8fc;color: #ffac00;" aria-hidden="true"></i>
                <i class="align-middle text-lg fas fa-star" style="text-shadow: -2px -1px 1px #f6f8fc;color: #ffac00;" aria-hidden="true"></i>
                <br>
                <p class="inline-block leading-tight align-middle pl-1 m-0 font-bold"><u><em>See {{ number_format(round(Prices::$reviews, -2)) }}+ More Student Reviews</em></u></p>
            </a>
            <br>
            <a class="join musora-gold mt-12 w-full" href="/choose-plan">START FOR FREE <i class="fas fa-arrow-right" style="line-height: 0;"></i></a>
        </div>
    </section>
@stop
