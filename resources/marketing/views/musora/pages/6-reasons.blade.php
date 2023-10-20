@extends('musora._partials.layout', [
    'whiteNav' => true,
    'fullSubscriptionVersion' => true,
])

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
@section('layout-body')
    @if(!empty($version) && $version === 'drums'))
        @include('musora.pages._6-reasons', [
            "title" => '6 Reasons Why You’ll Learn To Play<br class="hidden sm:inline"> The Drums Faster With Musora.',
            "header" => 'https://dmmior4id2ysr.cloudfront.net/sales/6-reasons/header-collage-drumeo.png',
            "subHeader" => 'Imagine finally playing the drums like you’ve always wanted, expressing yourself creatively, and mastering those crazy solos that made you fall in love with music&nbsp; - all without having to spend $100s or having to go through hours of pointless practice.
    <br><br>
    Online drum lessons have soared in popularity for a good reason: <strong>they work.</strong>
    <br><br>
    By marrying TECHNOLOGY and TRADITION, Musora gives you step-by-step video lessons, handy practice tools, and a library of your favorite songs.
    <br><br>
    Starting your journey has never been easier. You’ll get everything you need in one single place, accessible anytime, anywhere. Plus, learning from the world’s best drum teachers and finding support within our vibrant communities WILL keep you playing longer.
                        <br><br>
                        <strong>Here are six reasons you’ll love online music lessons…</strong>',
            "points" => [
                [
                "image" => "https://dmmior4id2ysr.cloudfront.net/sales/6-reasons/drumeo-01.png",
                "title" => "1. Learn & play on your schedule.",
                "description" => "<strong>Life is busy.</strong> Juggling work, personal commitments, and hobbies can be challenging. And <strong>traditional private drum lessons only add to this pressure</strong>, forcing you to fit into someone else’s schedule.
    <br><br>
    That's where Musora steps in.
    <br><br>
    Our on-demand step-by-step video lessons, practice tools, and song library <strong>adjust to your routine, not the other way around.</strong>&nbsp;
    <br><br>
    Forget about the stress of rushing home or squeezing in appointments. With Musora, you can learn, practice, and play the drums at your own pace, in the comfort of your home or on-the-go.&nbsp;
    <br><br>
    <strong>Music should serve you. </strong>And having drum lessons that work around your life will keep you motivated and playing for longer!",
                ],
                [
                "image" => "https://dmmior4id2ysr.cloudfront.net/sales/6-reasons/drumeo-02.png",
                "title" => "2. Drumming is happiness… backed by science!",
                "description" => "In today's stress-filled world, finding time to care for your mental health is vital.
    <br><br>
    Playing the drums is one of the most powerful and enjoyable ways to do just that.
    <br><br>
    According to The Independent, playing the drums not only strengthens mental performance, memory, and coordination, but it also has a profoundly positive impact on mental health. <strong><em>“It can reduce feelings of depression</em></strong><em>, tension, and fatigue </em><strong><em>while</em></strong><em> </em><strong><em>boosting happiness,</em></strong><em> vigor, and excitement.”</em>
    <br><br>
    With Musora's online drum lessons, you can turn any space into your personal mental health retreat. And because our lessons fit your schedule, you can tap into the therapeutic benefits of drumming whenever it best suits you, letting you keep a balanced, harmonious life.",
                ],
                [
                "image" => "https://dmmior4id2ysr.cloudfront.net/sales/6-reasons/drumeo-03.png",
                "title" => "3. The world’s best teachers.",
                "description" => "We've all been there – you sign up for a private drum lesson, and the teacher is just… not good.
    <br><br>
    Maybe they're impatient, maybe they want you to focus on theory first, or they're just not a good fit for your learning style. And even if you do strike gold and find a great teacher, you're still seeing the world of drumming through just one set of eyes.
    <br><br>
    At Musora, <strong>we’ve handpicked some of the best drum players in the world…</strong> just for you. Learn from rock stars, <strong>touring professionals</strong>, published authors, <strong>Grammy Award winners</strong>, and industry icons.
    <br><br>
    Whether you're starting from scratch or looking to dive deep into a specific technique or genre, <strong>you'll be in the best hands</strong>. Learning from people that eat, sleep, and breathe drumming, day in and day out.",
                ],
                [
                "image" => "https://dmmior4id2ysr.cloudfront.net/sales/6-reasons/drumeo-04.png",
                "title" => "4. Thousands of songs with note-for-note breakdowns.",
                "description" => "The whole point of learning the drums is to actually PLAY the songs you love.
    <br><br>
    With Musora, you’ll get <strong>1000s of popular songs with note-for-note breakdowns</strong> and interactive practice tools like tempo control, section loops, a built-in metronome, drumless tracks and more… accessible on any device, or printable, so you can play your favorite songs anytime!
    <br><br>
    Sheet music can cost you hundreds of dollars per year on top of your lessons – or most online services are filled with errors, making your playing experience a frustrating one. The Musora song library only includes fully-licensed transcriptions PLUS they’re carefully reviewed by our team of professional transcribers.&nbsp;
    <br><br>
    Whether you love pop, rock, heavy metal or jazz… you can save some money and start playing when you join today!",
                ],
                [
                "image" => "https://dmmior4id2ysr.cloudfront.net/sales/6-reasons/drumeo-05.png",
                "title" => "5. Drum lessons that don’t break the bank.",
                "description" => "Let's do some quick math. Typical private drum lessons will cost about $30 each – and if you're going once a week, that adds up to $1560 each year (or $130 per month). Ouch.
    <br><br>
    A full year of Musora is only $240 – <strong>just $4.62/week, or $20/month.</strong>
    <br><br>
    You'll be saving $1320 per year compared to private lessons.
    <br><br>
    But it's not just about the cost. You'll also get unlimited access to our drum lessons – no caps, no limits.&nbsp;
    <br><br>
    Why? Because we don’t believe in restricting your learning. We want you to completely fall in love with playing the drums. It's not about stuffing you with more content than you can handle, it's about making sure you get the lessons you need, whenever you want them. All that for less than a weekly cup of fancy coffee!",
                ],
                [
                "image" => "https://dmmior4id2ysr.cloudfront.net/sales/6-reasons/drumeo-06.png",
                "title" => "6. Unlimited love & support.",
                "description" => "When you sign up for Musora, you're not just getting drum lessons.
    <br><br>
    You're also joining <strong>THOUSANDS</strong> of drum lovers all over the globe, PLUS you get a dedicated in-house team of teachers and mentors at your service.
    <br><br>
    This isn't just a platform – it's a community. And we’re all about people – real people who share your passion for drumming. Here, there's no question too small, no problem too big. Our live events and student reviews are designed to keep your learning on track and your motivation high.
    <br><br>
    With Musora, you're not just learning to hit drums with sticks – you're getting a support system that'll be with you every step of the way as you chase your goals, get to know your instrument, and ultimately, live a life filled with the joy of music. It's time to hit the right note with your drum journey.",
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
    @elseif(!empty($version) && $version === 'piano'))
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
    @elseif(!empty($version) && $version === 'guitar'))
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
    @elseif(!empty($version) && $version === 'singing'))
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
    @else
        @include('musora.pages._6-reasons', [
            "title" => '6 Reasons Online Music Lessons<br class="hidden sm:inline"> Will Help Your Learn Faster',
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
    @endif
@endsection
