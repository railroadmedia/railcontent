@extends('singeo._partials.global-layout')

@section('global-head')
    <title>6 Reasons Why You’ll Learn To Sing Faster With Musora.</title>
    <meta property="og:title" content="6 Reasons Why You’ll Learn To Sing With Musora.">

    <meta name="description" content="Online vocal lessons have soared in popularity for a good reason: they work.">
    <meta property="og:description" content="Online vocal lessons have soared in popularity for a good reason: they work.">

    <meta property="og:url" content="https://www.singeo.com/{{ Request::path() }}">
    <meta property="og:image" content="https://dmmior4id2ysr.cloudfront.net/homepage/2023/share-image3.jpg" style="display: none;">

    @include('_partials.layout._tailwindcdn')
    <link href="{{ asset('/marketing/parcel/drumeo/nav-footer-singeo.css') }}" rel="stylesheet">

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
    @include("singeo.sales.partials._nav")


    @include('musora.pages._6-reasons', [
        "title" => '6 Reasons Why You’ll Learn To <br class="hidden sm:inline"> Sing Faster With Musora.',
        "header" => 'https://dmmior4id2ysr.cloudfront.net/sales/6-reasons/header-collage-singeo.png',
        "subHeader" => 'Imagine being able to sing ANY song you want. Leading the choir rather than following it. Or even just singing a lullaby for your kids and actually sounding good&nbsp; - all without having to spend $100s or having to go through hours of pointless practice.
<br><br>
Online singing lessons have soared in popularity for a good reason: <strong>they work.</strong>
<br><br>
By marrying TECHNOLOGY and TRADITION, Musora gives you step-by-step video lessons, handy practice tools, unlimited personal feedback, and a library of your favorite songs.
<br><br>
Starting your journey has never been easier. You’ll get everything you need in one single place, accessible anytime, anywhere. Plus, learning from the world’s best vocal coaches and finding support within our vibrant communities WILL keep you singing longer..
<br><br>
<strong>Here are six reasons you’ll love Musora\'s online singing lessons…</strong>',
        "points" => [
            [
            "image" => "https://dmmior4id2ysr.cloudfront.net/sales/6-reasons/singeo-01.jpg",
            "title" => "1. Learn & play on your schedule.",
            "description" => "<strong>Life is busy.</strong> Juggling work, personal commitments, and hobbies can be challenging. And <strong>traditional private singing lessons only add to this pressure</strong>, forcing you to fit into someone else’s schedule.
<br><br>
That's where Musora steps in.
<br><br>
Our on-demand step-by-step video lessons, practice tools, and song library <strong>adjust to your routine, not the other way around.</strong>&nbsp;
<br><br>
Forget about the stress of rushing home or squeezing in appointments. With Musora, you can learn, practice, and sing at your own pace, in the comfort of your home or on-the-go.&nbsp;
<br><br>
<strong>Music should serve you. </strong>And having singing lessons that work around your life will keep you motivated and playing for longer!",
            ],
            [
            "image" => "https://dmmior4id2ysr.cloudfront.net/sales/6-reasons/singeo-02.jpg",
            "title" => "2. Unlimited personal feedback.",
            "description" => "Learning to sing online can feel extremely daunting. Constantly asking yourself <em>“Am I actually getting better?”</em>
<br><br>
With Musora’s singing lessons, you’ll get the <strong>unlimited personal feedback </strong>and support you need to get results faster.
<br><br>
Get <strong>on-demand</strong> access to mentors, reviews &amp; live lessons with real vocal coaches to overcome the challenges unique to you and your voice.
<br><br>
The days of watching hours of video lessons and going around in circles are over!",
            ],
            [
            "image" => "https://dmmior4id2ysr.cloudfront.net/sales/6-reasons/singeo-03.jpg",
            "title" => "3. Singing is happiness… backed by science!",
            "description" => "In today's stress-filled world, finding time to care for your mental health is vital.
<br><br>
Singing is one of the most powerful and enjoyable ways to do just that.
<br><br>
According to The Independent, singing not only strengthens mental performance, memory, and coordination, but it also has a profoundly positive impact on mental health. <strong><em>“It can reduce feelings of depression</em></strong><em>, tension, and fatigue </em><strong><em>while</em></strong><em> </em><strong><em>boosting happiness,</em></strong><em> vigor, and excitement.”</em>
<br><br>
With Musora's online singing lessons, you can turn even a short commute into your personal mental health retreat. And because our lessons fit your schedule, you can tap into the therapeutic benefits of singing whenever it best suits you, letting you keep a balanced, harmonious life.",
            ],
            [
            "image" => "https://dmmior4id2ysr.cloudfront.net/sales/6-reasons/singeo-04.jpg",
            "title" => "4. The world’s best teachers.",
            "description" => "We've all been there – you sign up for a private vocal lesson, and the teacher is just… not good.
<br><br>
Maybe they're impatient, maybe you can only find group lessons, or they're just not a good fit for your learning style. And even if you do strike gold and find a great teacher, you're still seeing the world of vocal training through just one set of eyes.
<br><br>
At Musora, <strong>we’ve handpicked some of the best vocal coaches…</strong> just for you. Learn from pop stars, <strong>touring professionals</strong>, published authors, <strong>Grammy Award winners</strong>, and industry icons.
<br><br>
Whether you're starting from scratch or looking to dive deep into a specific technique or genre, <strong>you'll be in the best hands</strong>. Learning from people that eat, sleep, and breathe singing, day in and day out.",
            ],
            [
            "image" => "https://dmmior4id2ysr.cloudfront.net/sales/6-reasons/singeo-05.jpg",
            "title" => "5. Singing lessons that don’t break the bank.",
            "description" => "Let's do some quick math. Typical private lessons will cost about $30 each – and if you're going once a week, that adds up to $1560 each year (or $130 per month). Ouch.
<br><br>
A full year of Musora is only $240 – <strong>just $4.62/week, or $20/month.</strong>
<br><br>
You'll be saving $1320 per year compared to private lessons.
<br><br>
But it's not just about the cost. You'll also get unlimited access to our singing lessons – no caps, no limits.&nbsp;
<br><br>
Why? Because we don’t believe in restricting your learning. We want you to completely fall in love with singing. It's not about stuffing you with more content than you can handle, it's about making sure you get the lessons you need, whenever you want them. All that for less than a weekly cup of fancy coffee!",
            ],
            [
            "image" => "https://dmmior4id2ysr.cloudfront.net/sales/6-reasons/singeo-06.jpg",
            "title" => "6. Unlimited love & support.",
            "description" => "When you sign up for Musora, you're not just getting vocal lessons.
<br><br>
You're also joining <strong>THOUSANDS</strong> of singers all over the globe, PLUS you get a dedicated in-house team of teachers and mentors at your service.
<br><br>
This isn't just a platform – it's a community. And we’re all about people – real people who share your passion for music. Here, there's no question too small, no problem too big. Our live events and student reviews are designed to keep your learning on track and your motivation high.
<br><br>
With Musora, you're not just learning to sound better at karaoke – you're getting a support system that'll be with you every step of the way as you chase your goals, get to know your voice, and ultimately, live a life filled with the joy of music. It's time to hit the right note with your singing journey.",
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
    @include("singeo.sales.partials._footer", [
            "minimal" => true
        ])

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/lazysizes/5.3.2/lazysizes.min.js"></script>
    <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/lazysizes/5.3.2/plugins/unveilhooks/ls.unveilhooks.min.js"></script>
    <script src="{{ asset('/marketing/parcel/drumeo/navigation-sales.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/@splidejs/splide@4.0.7/dist/js/splide.min.js"></script>
@stop
