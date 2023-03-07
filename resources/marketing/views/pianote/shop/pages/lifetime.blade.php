@extends('pianote.shop.shop-page-layout')

@section('meta')
    @parent
    <title>The Lifetime Bundle</title>
    <meta name="description" content="Lock in a lifetime of piano lessons!">
    <meta property="og:description" content="Lock in a lifetime of piano lessons!">
    <meta property="og:image" content="https://d2vyvo0tyx8ig5.cloudfront.net/sales/promos/november/lifetime-fb-share-image-1.jpg" style="display: none;">
    <meta property="og:url" content="https://www.pianote.com/{{ Request::path() }}">
    @include('_partials.layout._tailwindcdn')
@stop()

@php
    $bonuses = [
        [
            'name' => 'Lifetime Pianote Membership',
            'price' => '$1200',
            'fullPrice' => '$1200',
            'priceColor' => 'black',
            'discountedPrice' => 0,
            'desc' => "Discover the best online piano lessons experience with Pianote. Your Pianote membership will give you hundreds of expertly designed, step-by-step lessons to guide you along the path to musical freedom. And you don’t need any special cables or software to get started; it works with EVERY piano or keyboard. And you’ll get access to REAL teachers who can answer any questions you have along the way.",
            'freeBonus' => false,
            'lifetimeAccess' => false,
            'freeShipping' => false,
            'lineBreak' => true,
            'img' => 'https://d122ay5chh2hr5.cloudfront.net/sales/lifetime/pianote-lifetime.jpg',
        ],
        [
            'name' => 'Lifetime Drumeo Membership',
            'price' => '$1200',
            'fullPrice' => '$1200',
            'priceColor' => 'black',
            'discountedPrice' => 0,
            'desc' => "Get better, faster with Drumeo’s award-winning online drum lessons taught by the world’s greatest drummers. You’ll always know what to practice with step-by-step lessons, 5000+ note-for-note song breakdowns, hundreds of drum-less playalongs, and ongoing support & motivation from pro drummers.",
            'freeBonus' => false,
            'lifetimeAccess' => false,
            'freeShipping' => false,
            'lineBreak' => true,
            'included' => true,
            'img' => 'https://d122ay5chh2hr5.cloudfront.net/sales/lifetime/drumeo-lifetime.jpg',
        ],
        [
            'name' => 'Lifetime Guitareo Membership',
            'price' => '$1200',
            'fullPrice' => '$1200',
            'priceColor' => 'black',
            'discountedPrice' => 0,
            'desc' => "Get the ultimate online guitar lessons experience with Guitareo. You'll get unlimited access to hundreds of curated step-by-step lessons, song breakdowns, and other students like you in an online community to help you reach your guitar goals. And gain support from a guitar mentor to help you grow in your musical journey.",
            'freeBonus' => false,
            'lifetimeAccess' => false,
            'freeShipping' => false,
            'lineBreak' => true,
            'included' => true,
            'img' => 'https://d122ay5chh2hr5.cloudfront.net/sales/lifetime/guitareo-lifetime.jpg',
        ],
        [
            'name' => 'Lifetime Singeo Membership',
            'price' => '$1200',
            'fullPrice' => '$1200',
            'priceColor' => 'black',
            'discountedPrice' => 0,
            'desc' => "Get access to step-by-step lessons to guide you along the way to the singing voice you've always wanted, personal feedback from REAL vocal coaches, on-demand practice and vocal exercise routines, exclusive access to featured courses taught by Grammy Award-winning singers and a forum with thousands of other students on the same journey as you.",
            'freeBonus' => false,
            'lifetimeAccess' => false,
            'freeShipping' => false,
            'lineBreak' => true,
            'included' => true,
            'img' => 'https://d122ay5chh2hr5.cloudfront.net/sales/lifetime/singeo-lifetime.jpg',
        ],
        [
            'name' => 'Pianote Headphones',
            'price' => 'Normally $189',
            'priceColor' => 'black',
            'fullPrice' => 0,
            'discountedPrice' => 0,
            'desc' => 'These beautiful hi-end headphones are by piano players for piano players. Lightweight with comfortable ear padding for extended playing sessions and unrivalled sound definitition and bass response. Your playing has never sounded so good.',
            'freeBonus' => true,
            'lifetimeAccess' => false,
            'freeShipping' => true,
            'lineBreak' => true,
            'img' => 'https://d2vyvo0tyx8ig5.cloudfront.net/shop/card-thumbs/headphones-cart.jpg',
        ],
        [
            'name' => 'Chords & Scales Book',
            'price' => 'Normally $39',
            'priceColor' => 'black',
            'fullPrice' => 0,
            'discountedPrice' => 0,
            'desc' => 'You need chords to play your favorite songs, but learning them all can be a real challenge. The Piano Chords & Scales book is your go-to reference guide so you’ll never get stuck again. See a chord you don’t know? Simply flip to the relevant page in your book and you’ll see all the inversions and alterations you need to play beautifully and confidently. Don’t let scary-looking chords slow your progress.',
            'freeBonus' => true,
            'lifetimeAccess' => false,
            'freeShipping' => true,
            'lineBreak' => true,
            'img' => 'https://d2vyvo0tyx8ig5.cloudfront.net/sales/promos/november/bonuses/chords-scales.jpg',
        ],
        [
            'name' => 'Pianote Practice Planner',
            'price' => 'Normally $39',
            'priceColor' => 'black',
            'fullPrice' => 0,
            'discountedPrice' => 0,
            'desc' => 'Practice is the key to getting better. But to really progress it’s so important to practice the right things. Knowing what, when, and how to practice will make the biggest difference in your playing. The Pianote Practice Planner is your written guide to making every practice perfect, so you get the results you deserve. This is Lisa Witt’s personal practice guide. Written by her, exclusively for piano players.',
            'freeBonus' => true,
            'lifetimeAccess' => false,
            'freeShipping' => true,
            'lineBreak' => true,
            'img' => 'https://d2vyvo0tyx8ig5.cloudfront.net/sales/promos/black-friday/unlimited/planner.png',
        ],
        [
            'name' => 'Pianote Christmas Songbook',
            'price' => 'Normally $39',
            'priceColor' => 'black',
            'fullPrice' => 0,
            'discountedPrice' => 0,
            'desc' => 'Play the most beautiful Christmas Carols with the Pianote Christmas Songbook. You’ll get 14 stunning songs hand-picked and arranged for solo piano. Spiral-bound so it lays perfectly flat on your piano, these songs will bring joy to anyone who plays them.',
            'freeBonus' => true,
            'lifetimeAccess' => false,
            'freeShipping' => true,
            'lineBreak' => true,
            'img' => 'https://d2vyvo0tyx8ig5.cloudfront.net/sales/promos/november/bonuses/christmas-book.jpg',
        ],
        [
            'name' => 'Pianote Christmas Songbook (Digital Version)',
            'price' => 'Normally $10',
            'priceColor' => 'black',
            'fullPrice' => 0,
            'discountedPrice' => 0,
            'desc' => 'Embrace the joy of the Holiday Season with this digital version of our Christmas Songbook. You’ll get 10 beautiful Christmas Carols arranged for solo piano that you can download, print, and play at home. Perfect for beginners and early intermediate players, these songs will make this Christmas season one to remember.',
            'freeBonus' => true,
            'lifetimeAccess' => true,
            'freeShipping' => false,
            'lineBreak' => true,
            'img' => 'https://d2vyvo0tyx8ig5.cloudfront.net/sales/promos/november/bonuses/christmas-songbook-card.jpg',
        ],
        [
            'name' => 'Pianote Chords Poster',
            'price' => 'Normally $9',
            'priceColor' => 'black',
            'fullPrice' => 0,
            'discountedPrice' => 0,
            'desc' => 'Chord shapes can be hard to remember, especially when you’re starting out and learning how they work. Luckily we have the Pianote Chords Poster to help you with all those tricky shapes! Get this awesome poster for your practice space and start chording your way through all your favorite songs. If you ever forget your chord shapes, all you have to do is look up!',
            'freeBonus' => true,
            'lifetimeAccess' => false,
            'freeShipping' => true,
            'lineBreak' => true,
            'img' => 'https://d2vyvo0tyx8ig5.cloudfront.net/sales/promos/black-friday/unlimited/poster-chords.jpg',
        ],
        [
            'name' => 'Pianote Scales Poster',
            'price' => 'Normally $9',
            'priceColor' => 'black',
            'fullPrice' => 0,
            'discountedPrice' => 0,
            'desc' => 'If you ever find yourself forgetting the notes in a scale (like most of us do), the Pianote Scales Poster is here to help! Remember your scales with this easy-to-read poster, designed to help you quickly recall the right notes at the right time, making your scales (or soloing) a piece of cake. With this up on your wall, you’ll never miss a note again.',
            'freeBonus' => true,
            'lifetimeAccess' => false,
            'freeShipping' => true,
            'lineBreak' => true,
            'img' => 'https://d2vyvo0tyx8ig5.cloudfront.net/sales/promos/black-friday/unlimited/poster-scales.jpg',
        ],
        [
            'name' => 'The Power of Chords',
            'price' => 'Normally $97',
            'priceColor' => 'black',
            'fullPrice' => 0,
            'discountedPrice' => 0,
            'desc' => 'Play the music you love on the piano with the awesome Power of Chords. This fun course will demystify chording and show you how chords are the foundation of ALL music (even classical). When you understand and can play chords -- you’ll be able to play the songs you love easier, with more confidence.',
            'freeBonus' => true,
            'lifetimeAccess' => true,
            'freeShipping' => false,
            'lineBreak' => true,
            'img' => 'https://d2vyvo0tyx8ig5.cloudfront.net/sales/promos/november/bonuses/power-of-chords.jpg',
        ],
        [
            'name' => 'The Beginner’s Guide to Classical Piano',
            'price' => 'Normally $47',
            'priceColor' => 'black',
            'fullPrice' => 0,
            'discountedPrice' => 0,
            'desc' => 'Discover the beautiful world of classical piano, without the stuffy reputation. Learn Chopin, Bach, and Beethoven from touring expert Victoria Theodore. This course is your step-by-step introduction to classical music that’s fun and inviting, so you can play beautiful pieces with ease.',
            'freeBonus' => true,
            'lifetimeAccess' => true,
            'freeShipping' => false,
            'lineBreak' => true,
            'img' => 'https://d2vyvo0tyx8ig5.cloudfront.net/sales/promos/november/bonuses/TBGTCP.jpg',
        ],
        [
            'name' => 'Improvisation and Musical Freedom',
            'price' => 'Normally $47',
            'priceColor' => 'black',
            'fullPrice' => 0,
            'discountedPrice' => 0,
            'desc' => 'How do you learn to improvise on the piano? Simple. You learn from the best in the world! Join Jesús Molina as he shows you how to approach improvising in a structured, step-by-step way that’s fun, inspiring, and 100% not scary. It’s rare to get access to teachers of this caliber. But the course is yours for life.',
            'freeBonus' => true,
            'lifetimeAccess' => true,
            'freeShipping' => false,
            'lineBreak' => true,
            'img' => 'https://d2vyvo0tyx8ig5.cloudfront.net/sales/promos/november/bonuses/improv-musical-freedom.jpg',
        ],
        [
            'name' => 'The Beginner’s Guide To Playing Beautiful Piano',
            'price' => 'Normally $9',
            'priceColor' => 'black',
            'fullPrice' => 0,
            'discountedPrice' => 0,
            'desc' => 'Start playing beautiful piano music from the very first time you touch the keyboard. The Beginner’s Guide To Playing Beautiful Piano is your introduction to the world of stunning melodies and emotional music. Follow along and play beautiful sounds. But you won’t just be copying what you see… You’ll learn WHY certain chords and melodies sound beautiful. So after the course, you can create your own beautiful piano music.',
            'freeBonus' => true,
            'lifetimeAccess' => true,
            'freeShipping' => false,
            'lineBreak' => true,
            'img' => 'https://d2vyvo0tyx8ig5.cloudfront.net/sales/promos/november/bonuses/TBGTPBP.jpg',
        ],
        [
            'name' => 'Piano Riffs & Fills',
            'price' => 'Normally $99',
            'priceColor' => 'black',
            'fullPrice' => 0,
            'discountedPrice' => 0,
            'desc' => 'Anyone can play a chord -- but what happens in the spaces between the chords distinguishes the great players from the mediocre ones. Fill those spaces with piano riffs that will make you sound professional, polished ... and close to perfect. This course is broken down so even complete beginners can start sounding amazing. You’ll be shown exactly how to play the fills -- note for note.',
            'freeBonus' => true,
            'lifetimeAccess' => true,
            'freeShipping' => false,
            'lineBreak' => true,
            'img' => 'https://d2vyvo0tyx8ig5.cloudfront.net/sales/promos/black-friday/unlimited/piano-riffs-and-fills.jpg',
        ],
        [
            'name' => 'Piano Technique Made Easy',
            'price' => 'Normally $120',
            'priceColor' => 'black',
            'fullPrice' => 0,
            'discountedPrice' => 0,
            'desc' => 'Piano Technique Made Easy is the comprehensive guide for learning and perfecting your technique. Every scale. Every key signature. Every chord. You’ll learn them all to build a strong piano foundation so you can play faster, learn songs quicker, and express yourself through your playing.',
            'freeBonus' => true,
            'lifetimeAccess' => true,
            'freeShipping' => false,
            'lineBreak' => true,
            'img' => 'https://d2vyvo0tyx8ig5.cloudfront.net/sales/promos/black-friday/unlimited/piano-technique-made-easy.jpg',
        ],
        [
            'name' => 'De-Stupefy Your Left Hand',
            'price' => 'Normally $99',
            'priceColor' => 'black',
            'fullPrice' => 0,
            'discountedPrice' => 0,
            'desc' => 'Your left hand is weaker. And that’s normal. Most piano players struggle with their left hand, and sadly, most just accept it. De-Stupefy Your Left Hand is your 3-step path to a better left hand. Yes, your left hand might be weaker… but it doesn’t have to be.',
            'freeBonus' => true,
            'lifetimeAccess' => true,
            'freeShipping' => false,
            'lineBreak' => true,
            'img' => 'https://d2vyvo0tyx8ig5.cloudfront.net/sales/promos/black-friday/unlimited/de-stupefy-your-left-hand.jpg',
        ],
        [
            'name' => 'Worship Piano',
            'price' => 'Normally $99',
            'priceColor' => 'black',
            'fullPrice' => 0,
            'discountedPrice' => 0,
            'desc' => 'Master the skills to play modern worship songs and learn how to be part of a band. You’ll learn how to read worship chord charts, create beautiful background music, and how to be part of a worship team. Plus, this pack comes with your own band as a backing track, so YOU can join the band and play piano with other musicians. No prior knowledge or experience necessary. We start from scratch with this one.',
            'freeBonus' => true,
            'lifetimeAccess' => true,
            'freeShipping' => false,
            'lineBreak' => true,
            'img' => 'https://d2vyvo0tyx8ig5.cloudfront.net/sales/promos/black-friday/unlimited/worship-piano.jpg',
        ],
        [
            'name' => 'Faster Fingers',
            'price' => 'Normally $99',
            'priceColor' => 'black',
            'fullPrice' => 0,
            'discountedPrice' => 0,
            'desc' => 'Increase your finger speed, strength, and accuracy with this complete digital training pack. Faster Fingers is your roadmap to success on the piano. You’ll be guided every step of the way with daily practice videos and encouragement, plus you’ll be able to play along with every exercise and record your speed. The metronome doesn’t lie -- you’ll be able to SEE how much faster you’re getting. As a beginner, some of the later exercises may be too difficult, to begin with, but you’ll find immense value in the early exercises, and it will help speed up your learning as well as your fingers.',
            'freeBonus' => true,
            'lifetimeAccess' => true,
            'freeShipping' => false,
            'lineBreak' => true,
            'img' => 'https://d2vyvo0tyx8ig5.cloudfront.net/sales/promos/black-friday/unlimited/faster-fingers.jpg',
        ],
    ];
@endphp

@section('nav')
    @include('pianote.shop._partials._shop-nav', [
        "name" => "The Lifetime Bundle",
    ])
@endsection

@section('top')
    @include('pianote.shop._partials._slider', [
        "headerText" => "<strong>Lock in a lifetime of piano lessons!</strong>",
        "videoSrc" => "//player.vimeo.com/video/774401520",
        "defaultCover" => "https://d2vyvo0tyx8ig5.cloudfront.net/sales/promos/november/unlimited-lessons-thumb.jpg",
        "noSlider" => true,
    ])

    @include('pianote.shop._partials._sidebar', [
            "bundle" => true,
            "logo" => "https://dpwjbsxqtam5n.cloudfront.net/promos/november/lifetime-bundle-white.png",
            "invert" => true,
            "sku" => "products[PIANOTE-MEMBERSHIP-LIFETIME]=1&products[pianote-headphones]=1&products[piano-chords-and-scales-guide]=1&products[pianote-practice-planner]=1&products[christmas-song-book]=1&products[christmas-song-book-digital]=1&products[poster-chords]=1&products[poster-scales]=1&products[the-power-of-chords]=1&products[classical-piano]=1&products[jesus-molina-improvisation-and-musical-freedom-pack]=1&products[play-beautiful-piano]=1&products[piano-riffs-and-fills]=1&products[piano-technique-made-easy]=1&products[destupefy-your-left-hand]=1&products[worship-piano]=1&products[faster-fingers]=1&redirect=/order&locked=true",
            "fullPrice" => 1200,
            "price" => 1200,
            "specialText" => "+$1050 in FREE Bonuses",
            "soldOut" => true,
    ])
@endsection


@section('bottom')
    <h3 class="text-center" style="margin-bottom: 15px;"><strong>What's included:</strong></h3>
{{--    <img src="https://d2vyvo0tyx8ig5.cloudfront.net/sales/promos/november/lifetime-bundle-spread.png">--}}
{{--    <br><br>--}}
    <p>Two, maybe three times per year you get the chance to become a Pianote Lifetime Member.
        <br><br>
        You’ll make one final payment for your membership, and then enjoy a lifetime of piano lessons (and more) from Pianote.
        <br><br>
        It’s not for everyone, but if you know the piano will be part of your life for the next 5 years (at least), then it makes so much sense. And when you get your Lifetime Membership, we’ll send you some amazing bonuses, including our <strong>NEW Pianote Concert Series over-ear headphones.</strong>
        <br><br>
        Payment plans are available, and you’ll have 90 days to try it risk-free.</p>
    <hr class="my-5">

    <p>
    <strong>Say hello to your free bonuses:</strong><br>
    <em style="opacity: 0.5;">All digital bonuses are added to your account instantly with your membership to Pianote and they’re yours forever!</em> </p>

    @include('pianote.shop._partials._bonuses')
    <a href="#order" class="anchor-slide join lg:hidden">Jump To Top <i class="fas fa-angle-up"></i></a>
@endsection
