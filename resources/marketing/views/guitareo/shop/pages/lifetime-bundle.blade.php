@extends('guitareo.shop.shop-page-layout')

@section('styles')
    @parent
    <title>The Lifetime Bundle</title>
    <meta name="description" content="Become a lifelong learner of music.">
    <meta property="og:description" content="Become a lifelong learner of music.">
    <meta property="og:image" content="https://guitareo.s3.amazonaws.com/sales/promos/black-friday/lifetime-shop.jpg" style="display: none;">
    <meta property="og:url" content="https://www.guitareo.com/{{ Request::path() }}">
    <style>
        .side-bar .side-slide .logo {max-height:130px;display:none;}
        @media (min-width: 64em) {  .side-bar .side-slide .logo {display:inline-block;}  }
        .text-gradient {
            display: inline-block;
            background: -webkit-linear-gradient(20deg, #03c8ac, #0976db, #9a01ee, #f61a30);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .text-gradient s {
            -webkit-text-fill-color: #888;
        }
    </style>
@stop()

@php
    $bonuses = [
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
            'img' => 'https://guitareo.s3.amazonaws.com/sales/lifetime/guitareo-lifetime.jpg',
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
            'img' => 'https://guitareo.s3.amazonaws.com/sales/lifetime/drumeo-lifetime.jpg',
        ],
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
            'included' => true,
            'img' => 'https://guitareo.s3.amazonaws.com/sales/lifetime/pianote-lifetime.jpg',
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
            'img' => 'https://guitareo.s3.amazonaws.com/sales/lifetime/singeo-lifetime.jpg',
        ],
        [
            'name' => '(NEW) The Guitarist’s Survival Kit',
            'price' => 'Normally $' . GuitareoPrices::$survivalKitFull,
            'priceColor' => 'black',
            'fullPrice' => GuitareoPrices::$survivalKitFull,
            'discountedPrice' => 0,
            'desc' => "Be prepared for any musical jam with the guitar gear essentials. Inside this kit, you'll discover every component your guitar needs to stay in tune, sound crisp and clean, and look refreshed. The kit also comes with the Survival Guide, so you can carry the essential chords, scales, and licks in your guitar case.",
            'freeBonus' => true,
            'lifetimeAccess' => false,
            'freeShipping' => false,
            'lineBreak' => true,
            'img' => 'https://guitareo.s3.amazonaws.com/sales/promos/november/survival-kit-shop.jpg',
        ],
        [
            'name' => 'GuitarQuest',
            'price' => 'Normally $' . GuitareoPrices::$guitarQuestFull,
            'priceColor' => 'black',
            'fullPrice' => 0,
            'discountedPrice' => 0,
            'desc' => 'Go on a guitar-playing mission to complete nine musical projects with YouTuber Rob Scallon. Each level builds on expanding your creativity and skills on the guitar -- such as shooting a music video, making a commercial jingle, and writing your own song.',
            'freeBonus' => true,
            'lifetimeAccess' => true,
            'freeShipping' => false,
            'lineBreak' => true,
            'img' => 'https://d1923uyy6spedc.cloudfront.net/398-product-thumb--1609436919.jpg',
        ],
        [
            'name' => 'The Guitar System',
            'price' => 'Normally $' . GuitareoPrices::$guitarSystemFull,
            'priceColor' => 'black',
            'fullPrice' => 0,
            'discountedPrice' => 0,
            'desc' => "Transform your guitar playing with the ultimate encyclopedia of guitar lessons. Inside, you'll find guided lessons on anything you want to learn on the guitar -- such as the fundamentals, gear and tone, playing styles for genres, and more.",
            'freeBonus' => true,
            'lifetimeAccess' => true,
            'freeShipping' => false,
            'lineBreak' => true,
            'img' => 'https://d122ay5chh2hr5.cloudfront.net/order-form/guitar-system.png',
        ],
        [
            'name' => 'Guitar Technique Made Easy',
            'price' => 'Normally $' . GuitareoPrices::$GTMEFull,
            'priceColor' => 'black',
            'fullPrice' => 0,
            'discountedPrice' => 0,
            'desc' => 'Take a crystal-clear path to gain total guitar confidence in playing the music you love. This 26-week plan provides a complete foundation for you to achieve guitar techniques, giving you the freedom to explore the guitar neck and improvise on the spot.',
            'freeBonus' => true,
            'lifetimeAccess' => true,
            'freeShipping' => false,
            'lineBreak' => true,
            'img' => 'https://d122ay5chh2hr5.cloudfront.net/order-form/guitar-technique-made-easy.png',
        ],
        [
            'name' => 'Acoustic Guitar Made Easy',
            'price' => 'Normally $' . GuitareoPrices::$AGMEFull,
            'priceColor' => 'black',
            'fullPrice' => 0,
            'discountedPrice' => 0,
            'desc' => "Master the five pillars of the acoustic guitar and build a rock-solid foundation to play the songs you love in this organized 26-week course. You'll have fun playing the guitar by applying everything you learn to real music.",
            'freeBonus' => true,
            'lifetimeAccess' => true,
            'freeShipping' => false,
            'lineBreak' => true,
            'img' => 'https://d122ay5chh2hr5.cloudfront.net/order-form/acoustic-guitar-made-easy.png',
        ],
        [
            'name' => 'Rhythm & Groove',
            'price' => 'Normally $' . GuitareoPrices::$rhythmAndGrooveFull,
            'priceColor' => 'black',
            'fullPrice' => 0,
            'discountedPrice' => 0,
            'desc' => "Start grooving to rhythms on the guitar that you can throw into any song. Your teacher Sami Ghawi will show you how to change the feel of your music and get an audience moving to the beat.",
            'freeBonus' => true,
            'lifetimeAccess' => true,
            'freeShipping' => false,
            'lineBreak' => true,
            'img' => 'https://guitareo.s3.amazonaws.com/sales/promos/black-friday/rhythm_groove_cart.jpg',
        ],
    ];
@endphp

@section('top')
    @include('guitareo.shop._partials.slider', [
        "headerText" => '<strong>Become a lifelong learner of music.</strong><br><h3 class="leading-tight text-gradient uppercase mb-2"><strong>ONLY <s class="opacity-60">100</s>  SPOTS</strong><br></h3>',
        "videoSrc" => "//player.vimeo.com/video/774475100",
        "videoThumb" => "https://guitareo.s3.amazonaws.com/sales/promos/black-friday/sound-better-thumb.jpg",
    ])

     @include('guitareo.shop._partials.sidebar', [
        "bundle" => true,
        "soldOut" => true,
        "logo" => "https://guitareo.s3.amazonaws.com/shop/bundles/lifetime_logo_black.png",
        "sku" => "products[GUITAREO-LIFETIME-MEMBERSHIP]=1&products[guitarists-survival-kit]=1&products[guitar-quest]=1&products[rhythm-and-groove]=1&products[GUITAR-SYSTEM]=1&products[AGME-JAN-2019-SEMESTER]=1&products[GTME-OCT-2018-SEMESTER]=1&redirect=/order&locked=true",
        "fullPrice" => 1200,
        "price" => 1200,
        'freeShipping' => false,
        'guaranteeBadge' => true
    ])
@endsection

@section('bottom')
    <div class="shop-accordion">
        <div class="accordion" id="instructorAccordion">
            <div class="accordion-content bundle">
        <div class="flex flex-wrap my-7 lg:my-0 lg:mb-7">
            <h4 class="font-extrabold text-center text-xl md:text-2xl w-full mb-4 mt-0">What's included:</h4>
            <img class="w-full" src="https://guitareo.s3.amazonaws.com/sales/promos/november/lifetime-bundle-spread.png" alt="bundle spread">
            <p>
                <i>“My goal is to be one with the music. I just dedicate my whole life to this art.” - Jimi Hendrix </i><br><br>

                Playing music is more than a hobby for a handful of people – it’s a part of their identity. If you can relate, you’re invited to commit yourself to learning and playing guitar with this special membership. <br><br>

                You’ll have the chance to make one final payment to your Guitareo membership and then enjoy unlimited guitar lessons, real support from teachers, and being part of a community of other guitarists like you. <br><br>

                PLUS, you’ll receive the Guitarist’s Survival Kit in the mail as a thank you – where you’ll get seven gear essentials to keep you sounding (and looking) good on the guitar. <br><br>

                The best thing about this membership is that you’ll get more than just guitar lessons. You’ll also have forever-access to online music lessons with Drumeo, Pianote, and Singeo, too. <br><br>

                You can become the musician you’ve always dreamed of – and have a lifetime to learn music without worrying about extra membership fees. <br><br>

                So I encourage you to keep growing your musicianship for years to come.<br><br>

                And a heads up: You can split this payment into 1, 2, or 5 installments at checkout to make this payment easier for you.<br><br>

                Scroll down to see all your goodies with your Lifetime Membership (including $924 worth of guitar bonuses) – and we hope to see you with your infinity badge on your profile very soon!
            </p>
        </div>

        @include('guitareo.shop._partials.bonuses')
            </div>
        </div>
    </div>
@endsection

