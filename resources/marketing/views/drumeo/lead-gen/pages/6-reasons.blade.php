@extends('drumeo._partials.global-layout')

@section('global-head')
    <title>6 Reasons Why You’ll Learn To Play The Drums Faster With Musora.</title>
    <meta property="og:title" content="6 Reasons Why You’ll Learn To Play The Drums Faster With Musora.">

    <meta name="description" content="Online drum lessons have soared in popularity for a good reason: they work.">
    <meta property="og:description" content="Online drum lessons have soared in popularity for a good reason: they work.">

    <meta property="og:url" content="https://www.drumeo.com/{{ Request::path() }}">
    <meta property="og:image" content="https://dmmior4id2ysr.cloudfront.net/homepage/2023/share-image3.jpg" style="display: none;">

    @include('_partials.layout._fonts')

    @include('_partials.layout._tailwindcdn')
    <link href="{{ asset('/marketing/css/tailwind-helpers.css') }}" rel="stylesheet">
    <link href="{{ asset('/marketing/parcel/drumeo/navigation-sales.css') }}" rel="stylesheet">

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
        .join.musora-gold {
            background-color: #FFAE00;
            color: #000;

        }
        .join.musora-gold:hover,
        .join.musora-gold:focus {
            background:#ffb61a;
            color: #000;
        }

    </style>
@stop

@section('global-body')
    @include("drumeo.sales.partials._nav")

    @include('musora.pages._6-reasons', [
        "title" => '6 Reasons Why You’ll Learn To Play<br class="hidden sm:inline"> The Drums Faster With Musora.',
        "header" => 'https://dmmior4id2ysr.cloudfront.net/sales/6-reasons/header.png',
        "subHeader" => 'You <strong>can</strong> play music like you’ve always wanted – piano, guitar, drums, or singing – learning from scratch at any age, expressing yourself creatively, and playing the songs you love
                    <br><br>
                    Online music lessons have grown in popularity <strong>because they work</strong>– combining TECHNOLOGY and TRADITION with step-by-step video lessons, helpful practice tools, and all of your favorite songs.
                    <br><br>
                    It’s easier to get started. You’ll have everything you need in one place, accessible anytime and affordable. And you’ll <strong>keep playing longer</strong> with the world’s best teachers and communities to support your goals.
                    <br><br>
                    <strong>Here are six reasons you’ll love online music lessons…</strong>',
        "points" => [
            [
            "image" => "https://dmmior4id2ysr.cloudfront.net/sales/6-reasons/01-happiness.jpg",
            "title" => "1. Happiness… backed by science!",
            "description" => "Studies show that learning and playing an instrument are some of the healthiest activities you can perform for your brain – <strong>boosting happiness</strong>, intelligence, and overall well-being.
            <br><br>
            The Independent says learning a musical instrument “has such a <strong>profound influence on mood</strong> that it can increase vigor, excitement and happiness, while <strong>reducing depression</strong>, tension, fatigue, anger, and confusion” – also adding that playing an instrument helps improve mental performance, memory, motor skills, and coordination.
            <br><br>
            Online music lessons will help you experience these benefits faster &amp; more often with a flexible schedule, anywhere and anytime it works for you!",
            ],
            [
            "image" => "https://dmmior4id2ysr.cloudfront.net/sales/6-reasons/02-learn.jpg",
            "title" => "2. Learn & play whenever you want.",
            "description" => "Traditional private lessons require appointments, sometimes travel, and make you fit your hobby into somebody else’s calendar – while paying more than $30 per 30 minutes.
            <br><br>
            You shouldn’t feel panicked trying to rush home, or stressed trying to afford it.
            <br><br>
            <strong>Music should serve you!</strong>
            <br><br>
            Online music lessons give you 24/7 on-demand access to lessons, songs, and practice tools. Learn when you want to learn. Practice with engaging, interactive tools. Or play your favorite music with 1000+ popular songs with note-for-note transcriptions, just a click away.
            <br><br>
            You can start <strong>right now</strong> for free!",
            ],
            [
            "image" => "https://dmmior4id2ysr.cloudfront.net/sales/6-reasons/03-teachers.jpg",
            "title" => "3. The world’s best teachers.",
            "description" => "When you take private lessons, you’re rolling a dice on quality. There are great teachers – and there are also boring, impatient, inexperienced, and disinterested ones. And even when you find the right teacher, you’re limited to one perspective.
            <br><br>
            Musora gives you access to the world’s best teachers for piano, guitar, drums, and singing.
            <br><br>
            Learn from <strong>renowned clinicians</strong>, pop stars and rock stars, <strong>touring professionals</strong>, published authors, <strong>Grammy Award winners</strong>, and industry icons. Learn the foundations with teachers who’ve designed curriculums just for beginners – or study a specific technique or genre with teachers who live it, every day.
            <br><br>
            You’ll expand your musician horizons, stay inspired by the world’s best, and always push your musical abilities to new heights.",
            ],
            [
            "image" => "https://dmmior4id2ysr.cloudfront.net/sales/6-reasons/04-songs2.jpg",
            "title" => "4. Thousands of songs with note-for-note breakdowns.",
            "description" => "The point of learning music is to <strong>PLAY</strong> music.
            <br><br>
            That’s why Musora gives you <strong>1000s of popular songs with note-for-note breakdowns</strong> and interactive practice tools like tempo control, section loops, a built-in metronome, and more… accessible on any device, or printable, so you can play your favorite songs anytime!
            <br><br>
            Normally sheet music costs you hundreds of dollars per year in addition to your lessons – or most online services are filled with errors, making your playing experience a frustrating one. The Musora song library only includes fully-licensed transcriptions PLUS they’re carefully reviewed by our team of professional transcribers.
            <br><br>
            Save some money and play more of your favorite songs when you join today!",
            ],
            [
            "image" => "https://dmmior4id2ysr.cloudfront.net/sales/6-reasons/05-save.jpg",
            "title" => "5. Save your hard-earned cash!",
            "description" => "Most private music lessons are $30/week – and most learners do a lesson every week, bringing the total to $1560 every year (or $130 per month). A full year of Musora is only $240 – or just $4.62/week, or $20/month.
            <br><br>
            So you’ll save $1320 per year compared to private lessons.
            <br><br>
            PLUS you’ll have <strong>unlimited lessons</strong> – including the ability to learn <strong>any instrument</strong> at no additional cost. (Because we just want YOU to fall in love with playing music. It’s not about how much content you have access to, it’s about you getting the lessons you want anytime you want them!)",
            ],
            [
            "image" => "https://dmmior4id2ysr.cloudfront.net/sales/6-reasons/06-love.jpg",
            "title" => "6. Unlimited love & support.",
            "description" => "One last thing 🙂
            <br><br>
            When you join Musora, you’ll join a community of 80,000+ music students from around the world PLUS our in-house team of teachers and mentors to <strong>help you reach your goals</strong>.
            <br><br>
            You’ll join a community powered by humans – where you’ll have every question answered, access to live events and personal reviews, and have the support you need to learn your instrument, reach your goals, and live a happier & healthier life with MUSIC.",
            ],
            [
            "image" => "https://dmmior4id2ysr.cloudfront.net/sales/6-reasons/guarantee.png",
            "title" => "90-Day Learn To Play Guarantee",
            "description" => "As educators, it’s up to us to make sure you learn. Your time is valuable enough, so we really don’t want to waste your money.
            <br><br>
            So when you join Musora you’ll get a <strong>7-day free trial</strong> to make sure you love it <strong>PLUS a 90-day guarantee</strong> to give you enough time to see results. If you don’t love your music lessons experience, you’ll get your money back. No questions asked… except, maybe: how could we do better?
            <br><br>
            <strong>You’ll only pay if you actually LOVE your music lessons experience.</strong>",
            ],
        ]
    ])



    @include("drumeo.sales.partials._footer", [
            "minimal" => true
        ])
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/lazysizes/5.3.2/lazysizes.min.js"></script>
    <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/lazysizes/5.3.2/plugins/unveilhooks/ls.unveilhooks.min.js"></script>
    <script src="{{ asset('/marketing/parcel/drumeo/navigation-sales.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/@splidejs/splide@4.0.7/dist/js/splide.min.js"></script>
@stop


@php
    $title = '6 Reasons Online Music Lessons<br class="hidden sm:inline"> Will Help Your Learn Faster';
    $header = 'https://dmmior4id2ysr.cloudfront.net/sales/6-reasons/header.png';
    $subHeader = 'You <strong>can</strong> play music like you’ve always wanted – piano, guitar, drums, or singing – learning from scratch at any age, expressing yourself creatively, and playing the songs you love.
                <br><br>
                Online music lessons have grown in popularity <strong>because they work</strong>– combining TECHNOLOGY and TRADITION with step-by-step video lessons, helpful practice tools, and all of your favorite songs.
                <br><br>
                It’s easier to get started. You’ll have everything you need in one place, accessible anytime and affordable. And you’ll <strong>keep playing longer</strong> with the world’s best teachers and communities to support your goals.
                <br><br>
                <strong>Here are six reasons you’ll love online music lessons…</strong>';
    $points = [
        [
        "image" => "https://dmmior4id2ysr.cloudfront.net/sales/6-reasons/01-happiness.jpg",
        "title" => "1. Happiness… backed by science!",
        "description" => "Studies show that learning and playing an instrument are some of the healthiest activities you can perform for your brain – <strong>boosting happiness</strong>, intelligence, and overall well-being.
        <br><br>
        The Independent says learning a musical instrument “has such a <strong>profound influence on mood</strong> that it can increase vigor, excitement and happiness, while <strong>reducing depression</strong>, tension, fatigue, anger, and confusion” – also adding that playing an instrument helps improve mental performance, memory, motor skills, and coordination.
        <br><br>
        Online music lessons will help you experience these benefits faster &amp; more often with a flexible schedule, anywhere and anytime it works for you!",
        ],
        [
        "image" => "https://dmmior4id2ysr.cloudfront.net/sales/6-reasons/02-learn.jpg",
        "title" => "2. Learn & play whenever you want.",
        "description" => "Traditional private lessons require appointments, sometimes travel, and make you fit your hobby into somebody else’s calendar – while paying more than $30 per 30 minutes.
        <br><br>
        You shouldn’t feel panicked trying to rush home, or stressed trying to afford it.
        <br><br>
        <strong>Music should serve you!</strong>
        <br><br>
        Online music lessons give you 24/7 on-demand access to lessons, songs, and practice tools. Learn when you want to learn. Practice with engaging, interactive tools. Or play your favorite music with 1000+ popular songs with note-for-note transcriptions, just a click away.
        <br><br>
        You can start <strong>right now</strong> for free!",
        ],
        [
        "image" => "https://dmmior4id2ysr.cloudfront.net/sales/6-reasons/03-teachers.jpg",
        "title" => "3. The world’s best teachers.",
        "description" => "When you take private lessons, you’re rolling a dice on quality. There are great teachers – and there are also boring, impatient, inexperienced, and disinterested ones. And even when you find the right teacher, you’re limited to one perspective.
        <br><br>
        Musora gives you access to the world’s best teachers for piano, guitar, drums, and singing.
        <br><br>
        Learn from <strong>renowned clinicians</strong>, pop stars and rock stars, <strong>touring professionals</strong>, published authors, <strong>Grammy Award winners</strong>, and industry icons. Learn the foundations with teachers who’ve designed curriculums just for beginners – or study a specific technique or genre with teachers who live it, every day.
        <br><br>
        You’ll expand your musician horizons, stay inspired by the world’s best, and always push your musical abilities to new heights.",
        ],
        [
        "image" => "https://dmmior4id2ysr.cloudfront.net/sales/6-reasons/04-songs2.jpg",
        "title" => "4. Thousands of songs with note-for-note breakdowns.",
        "description" => "The point of learning music is to <strong>PLAY</strong> music.
        <br><br>
        That’s why Musora gives you <strong>1000s of popular songs with note-for-note breakdowns</strong> and interactive practice tools like tempo control, section loops, a built-in metronome, and more… accessible on any device, or printable, so you can play your favorite songs anytime!
        <br><br>
        Normally sheet music costs you hundreds of dollars per year in addition to your lessons – or most online services are filled with errors, making your playing experience a frustrating one. The Musora song library only includes fully-licensed transcriptions PLUS they’re carefully reviewed by our team of professional transcribers.
        <br><br>
        Save some money and play more of your favorite songs when you join today!",
        ],
        [
        "image" => "https://dmmior4id2ysr.cloudfront.net/sales/6-reasons/05-save.jpg",
        "title" => "5. Save your hard-earned cash!",
        "description" => "Most private music lessons are $30/week – and most learners do a lesson every week, bringing the total to $1560 every year (or $130 per month). A full year of Musora is only $240 – or just $4.62/week, or $20/month.
        <br><br>
        So you’ll save $1320 per year compared to private lessons.
        <br><br>
        PLUS you’ll have <strong>unlimited lessons</strong> – including the ability to learn <strong>any instrument</strong> at no additional cost. (Because we just want YOU to fall in love with playing music. It’s not about how much content you have access to, it’s about you getting the lessons you want anytime you want them!)",
        ],
        [
        "image" => "https://dmmior4id2ysr.cloudfront.net/sales/6-reasons/06-love.jpg",
        "title" => "6. Unlimited love & support.",
        "description" => "One last thing :)
        <br><br>
        When you join Musora, you’ll join a community of 80,000+ music students from around the world PLUS our in-house team of teachers and mentors to <strong>help you reach your goals</strong>.
        <br><br>
        You’ll join a community powered by humans – where you’ll have every question answered, access to live events and personal reviews, and have the support you need to learn your instrument, reach your goals, and live a happier & healthier life with MUSIC.",
        ],
        [
        "image" => "https://dmmior4id2ysr.cloudfront.net/sales/6-reasons/guarantee.png",
        "title" => "90-Day Learn To Play Guarantee",
        "description" => "As educators, it’s up to us to make sure you learn. Your time is valuable enough, so we really don’t want to waste your money.
        <br><br>
        So when you join Musora you’ll get a <strong>7-day free trial</strong> to make sure you love it <strong>PLUS a 90-day guarantee</strong> to give you enough time to see results. If you don’t love your music lessons experience, you’ll get your money back. No questions asked… except, maybe: how could we do better?
        <br><br>
        <strong>You’ll only pay if you actually LOVE your music lessons experience.</strong>",
        ],
    ]
@endphp
