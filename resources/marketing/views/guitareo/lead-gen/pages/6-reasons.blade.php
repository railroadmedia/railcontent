@extends('guitareo._partials.global-layout')

@section('meta')
    <title>6 Reasons Why You’ll Learn To Play The Guitar Faster With Musora.</title>
    <meta property="og:title" content="6 Reasons Why You’ll Learn To Play The Guitar With Musora.">

    <meta name="description" content="Online guitar lessons have soared in popularity for a good reason: they work.">
    <meta property="og:description" content="Online guitar lessons have soared in popularity for a good reason: they work.">

    <meta property="og:url" content="https://www.guitareo.com/{{ Request::path() }}">
    <meta property="og:image" content="https://dmmior4id2ysr.cloudfront.net/homepage/2023/share-image3.jpg" style="display: none;">

    <link rel="stylesheet" href="{{ mix('marketing/css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('/marketing/css/tailwind-helpers.css') }}">
    <link rel="stylesheet" href="{{ asset('/marketing/parcel/drumeo/nav-footer-guitareo.css') }}">

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
@stop


@section('navigation')
    @include("guitareo.sales.partials._nav")
@stop

@section('content')


    @include('musora.pages._6-reasons', [
        "title" => '6 Reasons Why You’ll Learn To Play<br class="hidden sm:inline"> The Guitar Faster With Musora.',
        "header" => 'https://dmmior4id2ysr.cloudfront.net/sales/6-reasons/header-collage-guitareo.png',
        "subHeader" => 'Imagine playing the guitar like you’ve always wanted. Around a campfire with your friends, or on stage at your first show… expressing yourself creatively, and rocking to the songs you love
<br><br>
&nbsp;All without having to spend $100s or having to go through hours of pointless practice.
<br><br>
Online guitar lessons have soared in popularity for a good reason: <strong>they work.</strong>
<br><br>
By marrying TECHNOLOGY and TRADITION, Musora gives you step-by-step video lessons, handy practice tools, and a massive library of tabs for your favorite songs.
<br><br>
Starting your journey has never been easier. You’ll get everything you need in one single place, accessible anytime, anywhere. Plus, learning from the world’s best teachers and finding support within our vibrant communities WILL keep you playing longer.
                    <br><br>
                    <strong>Here are six reasons you’ll love online music lessons…</strong>',
        "points" => [
            [
            "image" => "https://dmmior4id2ysr.cloudfront.net/sales/6-reasons/guitareo-01.png",
            "title" => "1. Learn & play on your schedule.",
            "description" => "<strong>Life is busy.</strong> Juggling work, personal commitments, and hobbies can be challenging. And <strong>traditional private guitar lessons only add to this pressure</strong>, forcing you to fit into someone else’s schedule.
<br><br>
That's where Musora steps in.
<br><br>
Our on-demand step-by-step video lessons, practice tools, and song tab library <strong>adjust to your routine, not the other way around.</strong>&nbsp;
<br><br>
Forget about the stress of rushing home or squeezing in appointments. With Musora, you can learn, practice, and play the guitar at your own pace, in the comfort of your home or on-the-go.&nbsp;
<br><br>
<strong>Music should serve you. </strong>And having guitar lessons that work around your life will keep you motivated and playing for longer!",
            ],
            [
            "image" => "https://dmmior4id2ysr.cloudfront.net/sales/6-reasons/guitareo-02.png",
            "title" => "2. Music is happiness… backed by science!",
            "description" => "In today's stress-filled world, finding time to care for your mental health is vital.
<br><br>
Playing the guitar is one of the most powerful and enjoyable ways to do just that.
<br><br>
According to The Independent, playing the guitar not only strengthens mental performance, memory, and coordination, but it also has a profoundly positive impact on mental health. <strong><em>“It can reduce feelings of depression</em></strong><em>, tension, and fatigue </em><strong><em>while</em></strong><em> </em><strong><em>boosting happiness,</em></strong><em> vigor, and excitement.”</em>
<br><br>
With Musora's online guitar lessons, you can turn any space into your personal mental health retreat. And, because our lessons fit your schedule, you can tap into the therapeutic benefits of playing the guitar whenever it best suits you, letting you keep a balanced, harmonious life.",
            ],
            [
            "image" => "https://dmmior4id2ysr.cloudfront.net/sales/6-reasons/guitareo-03.png",
            "title" => "3. The world’s best teachers.",
            "description" => "We've all been there – you sign up for a private guitar lesson, and the teacher is just… not good.
<br><br>
Maybe they're impatient, maybe they're boring, or they're just not a good fit for your learning style. And even if you do strike gold and find a great teacher, you're still seeing the world of guitar-playing through just one set of eyes.
<br><br>
At Musora, <strong>we’ve handpicked some of the best guitar players in the world…</strong> just for you. Learn from <strong>touring professionals</strong>, published authors, <strong>Grammy Award winners</strong>, and industry icons.
<br><br>
Whether you're starting from scratch or looking to dive deep into a specific technique or genre, <strong>you'll be in the best hands</strong>. Learning from people that eat, sleep, and breathe guitar, day in and day out.",
            ],
            [
            "image" => "https://dmmior4id2ysr.cloudfront.net/sales/6-reasons/guitareo-04.png",
            "title" => "4. Thousands of songs with note-for-note breakdowns.",
            "description" => "The whole point of learning the guitar is to actually PLAY the songs you love.
<br><br>
With Musora, you’ll get<strong> note-for-note breakdowns of over 1,000+ of your favorite songs</strong>. Plus,interactive practice tools like tempo control, section loops, a built-in metronome, and more… accessible on any device, or printable, so you can play your favorite songs anytime!
<br><br>
Sheet music can cost you hundreds of dollars per year on top of your lessons – or most online services are filled with errors, making your playing experience a frustrating one. The Musora song library only includes fully-licensed transcriptions PLUS they’re carefully reviewed by our team of professional transcribers.&nbsp;
<br><br>
Whether you love pop, rock, jazz or country… you can save money and start playing when you join today!",
            ],
            [
            "image" => "https://dmmior4id2ysr.cloudfront.net/sales/6-reasons/guitareo-05.png",
            "title" => "5. Guitar lessons that don’t break the bank.",
            "description" => "Let's do some quick math. Typical private guitar lessons will cost about $30 each – and if you're going once a week, that adds up to $1,560 each year (or $130 per month). Ouch.
<br><br>
A full year of Musora is only $240 – <strong>just $4.62/week, or $20/month.</strong>
<br><br>
You'll save $1,320 per year compared to private lessons.
<br><br>
But it's not just about the cost. You'll also get unlimited access to our guitar lessons – no caps, no limits.&nbsp;
<br><br>
Why? Because we don’t believe in restricting your learning. We want you to completely fall in love with playing the guitar. It's not about stuffing you with more content than you can handle, it's about making sure you get the lessons you need, whenever you want them. All that for less than a weekly cup of fancy coffee!",
            ],
            [
            "image" => "https://dmmior4id2ysr.cloudfront.net/sales/6-reasons/guitareo-06.png",
            "title" => "6. Unlimited love & support.",
            "description" => "When you sign up for Musora, you're not just getting guitar lessons.
<br><br>
You're also joining <strong>THOUSANDS</strong> of music lovers all over the globe, PLUS you get a dedicated in-house team of guitar teachers and mentors at your service.
<br><br>
This isn't just a platform – it's a community. And we’re all about people – real people who share your passion for music. Here, there's no question too small, no problem too big. Our live events and student reviews are designed to keep your learning on track and your motivation high.
<br><br>
With Musora, you're not just learning to strum some strings&nbsp; – you're getting a support system that'll be with you every step of the way as you achieve your goals, get to know your instrument, and ultimately, live a life filled with the joy of music. It's time to hit the right note with your guitar journey.",
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


    @include("guitareo.sales.partials._footer", [
            "minimal" => true
        ])
@stop

@section('scripts')
    <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/lazysizes/5.3.2/lazysizes.min.js"></script>
    <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/lazysizes/5.3.2/plugins/unveilhooks/ls.unveilhooks.min.js"></script>
    <script src="{{ asset('/marketing/parcel/drumeo/navigation-sales.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/@splidejs/splide@4.0.7/dist/js/splide.min.js"></script>
@stop
