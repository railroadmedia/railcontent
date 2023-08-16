@extends('musora._partials.layout')

@section('head-includes')
    <title>About | Musora</title>
    <meta property="og:title" content="About | Musora">

    <meta name="description" content="We have two simple goals: create more musicians and keep them playing longer.">
    <meta property="og:description" content="We have two simple goals: create more musicians and keep them playing longer.">

    <meta property="og:url" content="https://www.musora.com/{{ Request::path() }}">
    <meta property="og:image" content="https://dmmior4id2ysr.cloudfront.net/homepage/2023/share-image3.jpg">
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
    </style>
@endsection

@section('body-data')
    x-data = '{
        modal: false,
    }'
@endsection

<!-- Main -->
@section('layout-body')
    <section class="text-center relative overflow-hidden py-10 md:py-16 lg:py-20 px-5 sm:px-6">
        <div class="container mx-auto max-w-3xl">
            <h2 class="leading-tight"><strong>6 Reasons Online Music Lessons<br class="hidden sm:inline"> Will Help Your Learn Faster</strong></h2>

            <div class="flex flex-wrap items-center justify-center mt-2 sm:mt-3 mx-auto">
                <a aria-label="Review" class="inline-block" href="https://www.shopperapproved.com/reviews/Musora.com" target="_blank" onclick="window.open('https://www.shopperapproved.com/reviews/Musora.com', 'newwindow', 'width=750, height=550'); return false;">
                    <i class="align-middle text-lg fas fa-star" style="color: #ffac00;" aria-hidden="true"></i>
                    <i class="align-middle text-lg fas fa-star" style="text-shadow: -2px -1px 1px #f6f8fc;color: #ffac00;" aria-hidden="true"></i>
                    <i class="align-middle text-lg fas fa-star" style="text-shadow: -2px -1px 1px #f6f8fc;color: #ffac00;" aria-hidden="true"></i>
                    <i class="align-middle text-lg fas fa-star" style="text-shadow: -2px -1px 1px #f6f8fc;color: #ffac00;" aria-hidden="true"></i>
                    <i class="align-middle text-lg fas fa-star" style="text-shadow: -2px -1px 1px #f6f8fc;color: #ffac00;" aria-hidden="true"></i>
                    <p class="inline-block leading-tight align-middle pl-1 m-0 font-bold"><u><em>{{ number_format(Prices::$reviews) }} Reviews</em></u></p>
                </a>
            </div>
            <picture>
                <source media="(min-width:640px)" srcset="https://www.musora.com/musora-cdn/image/width=1800,quality=95/https://musora-center.s3.amazonaws.com/sales/6-reasons/header.png">
                <img
                    class="h-64 sm:h-auto sm:w-full my-6 lg:my-10 transition-opacity opacity-0"
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

            <div class="flex flex-wrap sm:flex-nowrap items-start justify-center text-left mb-10 sm:mb-16">
                <picture class="w-48 sm:w-56 flex-shrink-0">
                    <source media="(min-width:640px)" srcset="https://www.musora.com/musora-cdn/image/width=640,quality=95/https://musora-center.s3.amazonaws.com/sales/6-reasons/01-happiness.jpg">
                    <img class="w-full mb-5 sm:mb-0 rounded-xl transition-opacity opacity-0" alt="reason image" loading="lazy" onload="this.classList.remove('opacity-0')"
                        src="https://www.musora.com/musora-cdn/image/width=600,quality=95/https://musora-center.s3.amazonaws.com/sales/6-reasons/01-happiness.jpg"
                    >
                </picture>
                <div class="sm:pl-8 flex-shrink">
                    <h4 class="leading-tight mb-2"><strong>1. Happiness… backed by science!</strong></h4>
                    <p>Studies show that learning and playing an instrument are some of the healthiest activities you can perform for your brain – boosting happiness, intelligence, and overall well-being.
                        <br><br>
                    The Independent says learning a musical instrument “has such a profound influence on mood that it can increase vigor, excitement and happiness, while reducing depression, tension, fatigue, anger, and confusion” – also adding that playing an instrument helps improve mental performance, memory, motor skills, and coordination.
                        <br><br>
                    Online music lessons will help you experience these benefits faster & more often with a flexible schedule, anywhere and anytime it works for you!</p>
                </div>
            </div>
            <div class="flex flex-wrap sm:flex-nowrap items-start justify-center text-left mb-10 sm:mb-16">
                <picture class="w-48 sm:w-56 flex-shrink-0">
                    <source media="(min-width:640px)" srcset="https://www.musora.com/musora-cdn/image/width=640,quality=95/https://musora-center.s3.amazonaws.com/sales/6-reasons/02-learn.jpg">
                    <img class="w-full mb-5 sm:mb-0 rounded-xl transition-opacity opacity-0" alt="reason image" loading="lazy" onload="this.classList.remove('opacity-0')"
                        src="https://www.musora.com/musora-cdn/image/width=600,quality=95/https://musora-center.s3.amazonaws.com/sales/6-reasons/02-learn.jpg"
                    >
                </picture>
                <div class="sm:pl-8 flex-shrink">
                    <h4 class="leading-tight mb-2"><strong>2. Learn & play whenever you want.</strong></h4>
                    <p>Traditional private lessons require appointments, sometimes travel, and make you fit your hobby into somebody else’s calendar – while paying more than $30 per 30 minutes.
                        <br><br>
                        You shouldn’t feel panicked trying to rush home, or stressed trying to afford it.
                        <br><br>
                        Music should serve you!
                        <br><br>
                        Online music lessons give you 24/7 on-demand access to lessons, songs, and practice tools. Learn when you want to learn. Practice with engaging, interactive tools. Or play your favorite music with 1000+ popular songs with note-for-note transcriptions, just a click away.
                        <br><br>
                        You can start right now for free!</p>
                </div>
            </div>
            <div class="flex flex-wrap sm:flex-nowrap items-start justify-center text-left mb-10 sm:mb-16">
                <picture class="w-48 sm:w-56 flex-shrink-0">
                    <source media="(min-width:640px)" srcset="https://www.musora.com/musora-cdn/image/width=640,quality=95/https://musora-center.s3.amazonaws.com/sales/6-reasons/03-teachers.jpg">
                    <img class="w-full mb-5 sm:mb-0 rounded-xl transition-opacity opacity-0" alt="reason image" loading="lazy" onload="this.classList.remove('opacity-0')"
                        src="https://www.musora.com/musora-cdn/image/width=600,quality=95/https://musora-center.s3.amazonaws.com/sales/6-reasons/03-teachers.jpg"
                    >
                </picture>
                <div class="sm:pl-8 flex-shrink">
                    <h4 class="leading-tight mb-2"><strong>3. The world’s best teachers.</strong></h4>
                    <p>When you take private lessons, you’re rolling a dice on quality. There are great teachers – and there are also boring, impatient, inexperienced, and disinterested ones. And even when you find the right teacher, you’re limited to one perspective.
                        <br><br>
                        Musora gives you access to the world’s best teachers for piano, guitar, drums, and singing.
                        <br><br>
                        Learn from renowned clinicians, pop stars and rock stars, touring professionals, published authors, Grammy Award winners, and industry icons. Learn the foundations with teachers who’ve designed curriculums just for beginners – or study a specific technique or genre with teachers who live it, every day.
                        <br><br>
                        You’ll expand your musician horizons, stay inspired by the world’s best, and always push your musical abilities to new heights.</p>
                </div>
            </div>
            <div class="flex flex-wrap sm:flex-nowrap items-start justify-center text-left mb-10 sm:mb-16">
                <picture class="w-48 sm:w-56 flex-shrink-0">
                    <source media="(min-width:640px)" srcset="https://www.musora.com/musora-cdn/image/width=640,quality=95/https://musora-center.s3.amazonaws.com/sales/6-reasons/04-songs.jpg">
                    <img class="w-full mb-5 sm:mb-0 rounded-xl transition-opacity opacity-0" alt="reason image" loading="lazy" onload="this.classList.remove('opacity-0')"
                        src="https://www.musora.com/musora-cdn/image/width=600,quality=95/https://musora-center.s3.amazonaws.com/sales/6-reasons/04-songs.jpg"
                    >
                </picture>
                <div class="sm:pl-8 flex-shrink">
                    <h4 class="leading-tight mb-2"><strong>4. Thousands of songs with note-for-note breakdowns.</strong></h4>
                    <p>The point of learning music is to PLAY music.
                        <br><br>
                        That’s why Musora gives you 1000s of popular songs with note-for-note breakdowns and interactive practice tools like tempo control, section loops, a built-in metronome, and more… accessible on any device, or printable, so you can play your favorite songs anytime!
                        <br><br>
                        Normally sheet music costs you hundreds of dollars per year in addition to your lessons – or most online services are filled with errors, making your playing experience a frustrating one. The Musora song library only includes fully-licensed transcriptions PLUS they’re carefully reviewed by our team of professional transcribers.
                        <br><br>
                        Save some money and play more of your favorite songs when you join today!</p>
                </div>
            </div>
            <div class="flex flex-wrap sm:flex-nowrap items-start justify-center text-left mb-10 sm:mb-16">
                <picture class="w-48 sm:w-56 flex-shrink-0">
                    <source media="(min-width:640px)" srcset="https://www.musora.com/musora-cdn/image/width=640,quality=95/https://musora-center.s3.amazonaws.com/sales/6-reasons/05-save.jpg">
                    <img class="w-full mb-5 sm:mb-0 rounded-xl transition-opacity opacity-0" alt="reason image" loading="lazy" onload="this.classList.remove('opacity-0')"
                        src="https://www.musora.com/musora-cdn/image/width=600,quality=95/https://musora-center.s3.amazonaws.com/sales/6-reasons/05-save.jpg"
                    >
                </picture>
                <div class="sm:pl-8 flex-shrink">
                    <h4 class="leading-tight mb-2"><strong>5. Save your hard-earned cash!</strong></h4>
                    <p>Most private music lessons are $30/week – and most learners do a lesson every week, bringing the total to $1560 every year (or $130 per month). A full year of Musora is only $240 – or just $4.62/week, or $20/month.
                        <br><br>
                        So you’ll save $1320 per year compared to private lessons.
                        <br><br>
                        PLUS you’ll have unlimited lessons – including the ability to learn any instrument at no additional cost. (Because we just want YOU to fall in love with playing music. It’s not about how much content you have access to, it’s about you getting the lessons you want anytime you want them!)</p>
                </div>
            </div>
            <div class="flex flex-wrap sm:flex-nowrap items-start justify-center text-left mb-10 sm:mb-16">
                <picture class="w-48 sm:w-56 flex-shrink-0">
                    <source media="(min-width:640px)" srcset="https://www.musora.com/musora-cdn/image/width=640,quality=95/https://musora-center.s3.amazonaws.com/sales/6-reasons/06-love.jpg">
                    <img class="w-full mb-5 sm:mb-0 rounded-xl transition-opacity opacity-0" alt="reason image" loading="lazy" onload="this.classList.remove('opacity-0')"
                        src="https://www.musora.com/musora-cdn/image/width=600,quality=95/https://musora-center.s3.amazonaws.com/sales/6-reasons/06-love.jpg"
                    >
                </picture>
                <div class="sm:pl-8 flex-shrink">
                    <h4 class="leading-tight mb-2"><strong>6. Unlimited love & support.</strong></h4>
                    <p>One last thing :)
                        <br><br>
                        When you join Musora, you’ll join a community of 80,000+ music students from around the world PLUS our in-house team of teachers and mentors to help you reach your goals.
                        <br><br>
                        You’ll join a community powered by humans – where you’ll have every question answered, access to live events and personal reviews, and have the support you need to learn your instrument, reach your goals, and live a happier & healthier life with MUSIC.</p>
                </div>
            </div>
            <div class="flex flex-wrap sm:flex-nowrap items-start justify-center text-left mb-10 sm:mb-16">
                <picture class="w-48 sm:w-56 flex-shrink-0">
                    <source media="(min-width:640px)" srcset="https://www.musora.com/musora-cdn/image/width=640,quality=95/https://musora-center.s3.amazonaws.com/sales/6-reasons/guarantee.png">
                    <img class="w-full mb-5 sm:mb-0 rounded-xl transition-opacity opacity-0" alt="reason image" loading="lazy" onload="this.classList.remove('opacity-0')"
                        src="https://www.musora.com/musora-cdn/image/width=600,quality=95/https://musora-center.s3.amazonaws.com/sales/6-reasons/guarantee.png"
                    >
                </picture>
                <div class="sm:pl-8 flex-shrink">
                    <h4 class="leading-tight mb-2"><strong>90-Day Learn To Play Guarantee</strong></h4>
                    <p>As educators, it’s up to us to make sure you learn. Your time is valuable enough, so we really don’t want to waste your money.
                        <br><br>
                        So when you join Musora you’ll get a 7-day free trial to make sure you love it PLUS a 90-day guarantee to give you enough time to see results. If you don’t love your music lessons experience, you’ll get your money back. No questions asked… except, maybe: how could we do better?
                        <br><br>
                        You’ll only pay if you actually LOVE your music lessons experience.</p>
                </div>
            </div>

            <a class="join musora-gold mb-16 sm:mb-24" href="/choose-plan">START FOR FREE <i class="fas fa-arrow-right" style="line-height: 0;"></i></a>

            <h2><strong>The Best Music<br class="sm:hidden"> Lessons Ever!</strong></h2>
            <div class="flex flex-wrap my-5 sm:my-8">
                @php
                    $reviews = [
                        [
                        "title" => "The most positive student-focused place!",
                        "description" => "I could not be more THRILLED with Musora!!! This is the most positive, helpful, caring, innovative, knowledgeable, student-focused place on the planet!!! It has been a Godsend for me! <br><strong>Kristyn T.</strong>",
                        ],
                        [
                        "title" => "All the instruments for a great price. ",
                        "description" => "I love the fact that I have access to many instruments for a great price. I'm learning to play the piano, which was a passion that I hadn't fulfilled in the past but now I'm so happy for it.
                        <br><strong>Juan C.</strong>",
                        ],
                        [
                        "title" => "Wish I was taught this way earlier!",
                        "description" => "If I had been taught this way as a child, I probably never would have quit
                        <br><strong>Serena D.</strong>",
                        ],
                        [
                        "title" => "Tremendous value. ",
                        "description" => "The value you get with Musora is tremendous. Whether you want to learn to sing, play guitar, play drums, or piano, this site has you covered.
                        <br><strong>Dennis R.</strong>",
                        ],
                        [
                        "title" => "My daughter danced to my playing!",
                        "description" => "The lightbulb moment happened when my 6 year old daughter started dancing as I played – you must be doing something right if somebody dances when you’re playing, right?
                        <br><strong>John M.</strong>",
                        ],
                        [
                        "title" => "Helpful lessons and supportive community. ",
                        "description" => "The materials are in helpful bite-size chunks, the support materials are excellent, the tutors are cheerful, and the online community is very supportive.
                        <br><strong>Devon F.</strong> ",
                        ],
                        [
                        "title" => "Awesome to learn from home!",
                        "description" => "It’s just so awesome to know that I can learn from home and accomplish one of my dreams.
                        <br><strong>Jayde M.</strong>",
                        ],
                        [
                        "title" => "The best course I’ve ever taken",
                        "description" => "There's really no comparative substitute to learning music. Any way you can learn, I say go for it, but this is the best course I have ever taken.
                        <br><strong>Russ W.</strong>",
                        ],
                    ]
                @endphp
                @foreach($reviews as $review)
                    <div class="flex flex-wrap items-start w-full sm:w-1/3 px-2 lg:px-3 mb-4 lg:mb-6 text-left">
                        <div class="border-2 border-black rounded-xl px-5 py-8">
                            <div class="text-center">
                                <i class="align-middle text-lg fas fa-star" style="color: #ffac00;" aria-hidden="true"></i>
                                <i class="align-middle text-lg fas fa-star" style="text-shadow: -2px -1px 1px #f6f8fc;color: #ffac00;" aria-hidden="true"></i>
                                <i class="align-middle text-lg fas fa-star" style="text-shadow: -2px -1px 1px #f6f8fc;color: #ffac00;" aria-hidden="true"></i>
                                <i class="align-middle text-lg fas fa-star" style="text-shadow: -2px -1px 1px #f6f8fc;color: #ffac00;" aria-hidden="true"></i>
                                <i class="align-middle text-lg fas fa-star" style="text-shadow: -2px -1px 1px #f6f8fc;color: #ffac00;" aria-hidden="true"></i>
                                <h6 class="leading-tight my-5"><strong>{!! $review['title'] !!}</strong></h6>
                            </div>
                            <div>
                                <p class="leading-normal text-sm">{!! $review['description'] !!}</p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <a aria-label="Review" class="inline-block" href="https://www.shopperapproved.com/reviews/Musora.com" target="_blank" onclick="window.open('https://www.shopperapproved.com/reviews/Musora.com', 'newwindow', 'width=750, height=550'); return false;">
                <i class="align-middle text-lg fas fa-star" style="color: #ffac00;" aria-hidden="true"></i>
                <i class="align-middle text-lg fas fa-star" style="text-shadow: -2px -1px 1px #f6f8fc;color: #ffac00;" aria-hidden="true"></i>
                <i class="align-middle text-lg fas fa-star" style="text-shadow: -2px -1px 1px #f6f8fc;color: #ffac00;" aria-hidden="true"></i>
                <i class="align-middle text-lg fas fa-star" style="text-shadow: -2px -1px 1px #f6f8fc;color: #ffac00;" aria-hidden="true"></i>
                <i class="align-middle text-lg fas fa-star" style="text-shadow: -2px -1px 1px #f6f8fc;color: #ffac00;" aria-hidden="true"></i>
                <br>
                <p class="inline-block leading-tight align-middle pl-1 m-0 font-bold"><u><em>See {{ number_format(Prices::$reviews) }} More Student Reviews</em></u></p>
            </a>
            <br>
            <a class="join musora-gold mt-12" href="/choose-plan">START FOR FREE <i class="fas fa-arrow-right" style="line-height: 0;"></i></a>
        </div>
    </section>
@stop
