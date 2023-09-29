@extends('pianote._partials.global-layout')

@section('global-head')
    <title>6 Reasons Why You’ll Learn To Play The Piano Faster With Musora.</title>
    <meta property="og:title" content="6 Reasons Why You’ll Learn To Play The Piano Faster With Musora.">

    <meta name="description" content="Online piano lessons have soared in popularity for a good reason: they work.">
    <meta property="og:description" content="Online piano lessons have soared in popularity for a good reason: they work.">

    <meta property="og:url" content="https://www.pianote.com/{{ Request::path() }}">
    <meta property="og:image" content="https://dmmior4id2ysr.cloudfront.net/homepage/2023/share-image3.jpg" style="display: none;">

    @include('_partials.layout._tailwindcdn')
    <link href="{{ asset('/marketing/css/tailwind-helpers.css') }}" rel="stylesheet">
    <link href="{{ asset('/marketing/parcel/drumeo/lead-gen-learn-songs.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('/marketing/parcel/drumeo/sales-pianote.css') }}">
    <link rel="stylesheet" href="{{ asset('/marketing/parcel/drumeo/nav-footer-pianote.css') }}">
    <style>
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
@endsection

@section('global-body')
    @include('pianote.sales.partials._nav')

    @include('musora.pages._6-reasons', [
        "title" => '6 Reasons Why You’ll Learn To Play<br class="hidden sm:inline"> The Piano Faster With Musora.',
        "header" => 'https://dmmior4id2ysr.cloudfront.net/sales/6-reasons/header-collage-pianote.png',
        "subHeader" => 'Imagine playing the piano like you’ve always wanted, expressing yourself creatively, and mastering the songs you love - all without having to spend $100s or having to go through hours of pointless practice.
<br><br>
Online piano lessons have soared in popularity for a good reason: <strong>they work.</strong>
<br><br>
By marrying TECHNOLOGY and TRADITION, Musora gives you step-by-step video lessons, handy practice tools, and a library of your favorite songs.
<br><br>
Starting your journey has never been easier. You’ll get everything you need in one single place, accessible anytime, anywhere. Plus, learning from the world’s best piano teachers and finding support within our vibrant communities WILL keep you playing longer.
                    <br><br>
                    <strong>Here are six reasons you’ll love online music lessons…</strong>',
        "points" => [
            [
            "image" => "https://dmmior4id2ysr.cloudfront.net/sales/6-reasons/pianote-01.png",
            "title" => "1. Learn & play on your schedule.",
            "description" => "<strong>Life is busy.</strong> Juggling work, personal commitments, and hobbies can be challenging. And <strong>traditional private piano lessons only add to this pressure</strong>, forcing you to fit into someone else’s schedule.
<br><br>
That's where Musora steps in.
<br><br>
Our on-demand step-by-step video lessons, practice tools, and song library <strong>adjust to your routine, not the other way around.</strong>&nbsp;
<br><br>
Forget about the stress of rushing home or squeezing in appointments. With Musora, you can learn, practice, and play the piano at your own pace, in the comfort of your home or on-the-go.&nbsp;
<br><br>
<strong>Music should serve you. </strong>And having piano lessons that work around your life will keep you motivated and playing for longer!",
            ],
            [
            "image" => "https://dmmior4id2ysr.cloudfront.net/sales/6-reasons/pianote-02.png",
            "title" => "2. Piano is happiness… backed by science!",
            "description" => "In today's stress-filled world, finding time to care for your mental health is vital.
<br><br>
Playing the piano is one of the most powerful and enjoyable ways to do just that.
<br><br>
According to The Independent, playing piano not only strengthens mental performance, memory, and coordination, but it also has a profoundly positive impact on mental health. <strong><em>“It can reduce feelings of depression</em></strong><em>, tension, and fatigue </em><strong><em>while</em></strong><em> </em><strong><em>boosting happiness,</em></strong><em> vigor, and excitement.”</em>
<br><br>
With Musora's online piano lessons, you can turn any space into your personal mental health retreat. And because our lessons fit your schedule, you can tap into the therapeutic benefits of playing the piano whenever it best suits you, letting you keep a balanced, harmonious life.",
            ],
            [
            "image" => "https://dmmior4id2ysr.cloudfront.net/sales/6-reasons/pianote-03.png",
            "title" => "3. The world’s best teachers.",
            "description" => "We've all been there – you sign up for a private piano lesson, and the teacher is just… not good.
<br><br>
Maybe they're impatient, maybe they're boring, or they're just not a good fit for your learning style. And even if you do strike gold and find a great teacher, you're still seeing the world of piano through just one set of eyes.
<br><br>
At Musora, <strong>we’ve handpicked some of the best piano players in the world…</strong> just for you. Learn from pop stars and rock stars, <strong>touring professionals</strong>, published authors, <strong>Grammy Award winners</strong>, and industry icons.
<br><br>
Whether you're starting from scratch or looking to dive deep into a specific technique or genre, <strong>you'll be in the best hands</strong>. Learning from people that eat, sleep, and breathe piano, day in and day out.",
            ],
            [
            "image" => "https://dmmior4id2ysr.cloudfront.net/sales/6-reasons/pianote-04.png",
            "title" => "4. Thousands of songs with note-for-note breakdowns.",
            "description" => "The whole point of learning the piano is to actually PLAY the music you love.
<br><br>
With Musora, you’ll get <strong>1000s of popular songs with note-for-note breakdowns</strong> and interactive practice tools like tempo control, section loops, a built-in metronome, and more… accessible on any device, or printable, so you can play your favorite songs anytime!
<br><br>
Sheet music can cost you hundreds of dollars per year on top of your lessons – or most online services are filled with errors, making your playing experience a frustrating one. The Musora song library only includes fully-licensed transcriptions PLUS they’re carefully reviewed by our team of professional transcribers.&nbsp;
<br><br>
Whether you love pop, gospel, worship or classical music… you can save some money and start playing when you join today!",
            ],
            [
            "image" => "https://dmmior4id2ysr.cloudfront.net/sales/6-reasons/pianote-05.png",
            "title" => "5. Drum lessons that don’t break the bank.",
            "description" => "Let's do some quick math. Typical private piano lessons will cost about $30 each – and if you're going once a week, that adds up to $1,560 each year (or $130 per month). Ouch.
<br><br>
A full year of Musora is only $240 – <strong>just $4.62/week, or $20/month.</strong>
<br><br>
You'll save $1,320 per year compared to private lessons.
<br><br>
But it's not just about the cost. You'll also get unlimited access to our piano lessons – no caps, no limits.&nbsp;
<br><br>
Why? Because we don’t believe in restricting your learning. We want you to completely fall in love with playing the piano. It's not about stuffing you with more content than you can handle, it's about making sure you get the lessons you need, whenever you want them. All that for less than a weekly cup of fancy coffee!",
            ],
            [
            "image" => "https://dmmior4id2ysr.cloudfront.net/sales/6-reasons/pianote-06.png",
            "title" => "6. Unlimited love & support.",
            "description" => "When you sign up for Musora, you're not just getting piano lessons.
<br><br>
You're also joining <strong>THOUSANDS</strong> of piano lovers all over the globe, PLUS you get a dedicated in-house team of piano teachers and mentors at your service.
<br><br>
This isn't just a platform – it's a community. And we’re all about people – real people who share your passion for the piano. Here, there's no question too small, no problem too big. Our live events and student reviews are designed to keep your learning on track and your motivation high.
<br><br>
With Musora, you're not just learning to push keys – you're getting a support system that'll be with you every step of the way as you chase your goals, get to know your instrument, and ultimately, live a life filled with the joy of music. It's time to hit the right note with your piano journey.",
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

    @include("pianote.sales.partials._footer", [
            "minimal" => true
        ])

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script type="text/javascript" src="{{ asset('/marketing/parcel/drumeo/navigation-sales.js') }}"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/lazysizes/5.3.2/lazysizes.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/lazysizes/5.3.2/plugins/unveilhooks/ls.unveilhooks.min.js"></script>
@endsection

