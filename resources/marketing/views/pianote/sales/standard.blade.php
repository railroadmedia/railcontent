@extends('pianote.sales.standard-layout',[
    'bfButton' => true
])

@section('meta')
    <title>Learn the piano anytime with real teachers. | Pianote</title>
    <meta property="og:title" content="Pianote - Learn the piano anytime with real teachers.">
    <meta property="og:url" content="https://www.pianote.com/">

    {{ App\Analytics\Tracker::trackProductDetailsImpression('PIANOTE-MEMBERSHIP-1-MONTH') }}
    {{ App\Analytics\Tracker::trackProductDetailsImpression('PIANOTE-MEMBERSHIP-1-YEAR') }}
@endsection

@section('top-promo-bar')
    @include('_partials.layout.holiday.homepage-top-banner',[
        'text' => 'GET 15 FREE BONUSES WORTH $861'
    ])
@endsection

@section('promo-banner')
{{--    <section class="bg-center bg-cover bg-no-repeat pt-12 md:pt-20" style="background-image: url('https://pianote.s3.amazonaws.com/sales/promos/piano-month/practice_better_promo_bg.png');">--}}
{{--        <div class="container max-w-md md:max-w-3xl lg:max-w-4xl mx-auto text-white px-6 lg:px-0">--}}
{{--            <div class="md:flex md:items-center mb-10 text-center md:text-left">--}}
{{--                <div class="md:w-7/12 lg:flex-1 mb-6 md:mb-0">--}}
{{--                    <img class="h-16 md:h-20 mb-2" src="https://cdn.musora.com/image/fetch/w_350,q_auto:best/https://pianote.s3.amazonaws.com/sales/promos/piano-month/practice-better-logo.png" alt="practice better logo">--}}
{{--                    <p class="leading-tight mb-6 uppercase">--}}
{{--                        <b>JOIN PIANOTE + GET 6 FREE BONUSES WORTH $262</b>--}}
{{--                        <br>--}}
{{--                        <span class="text-coaches">--}}
{{--                        ONLY--}}
{{--                        <span class="tzcd-full hidden md:inline">a limited time</span>--}}
{{--                        <span class="tzcd-small md:hidden">a limited time</span>--}}
{{--                        LEFT!--}}
{{--                            </span>--}}
{{--                    </p>--}}
{{--                    <p>--}}
{{--                        Better practice makes a better piano player. <br><br>--}}
{{--                        It’s simple. But that doesn’t mean it’s easy. Because so many online apps and resources leave you on your own to figure out what to do.--}}
{{--                        We’re changing that. <br><br>--}}
{{--                        This month when you join Pianote you’ll get 6 great bonuses to help you practice better -- so you’ll play better. You’ll get a custom Practice Planner made exclusively for piano players. You’ll also get some great posters to hang in your practice space and LIFETIME access to 2 full-length courses.--}}
{{--                    </p>--}}
{{--                </div>--}}
{{--                <div class="w-2/3 md:w-5/12 lg:flex-1 md:pl-6 lg:pl-10 text-center mx-auto md:mx-0">--}}
{{--                    <img src="https://cdn.musora.com/image/fetch/w_650,q_auto:best/https://pianote.s3.amazonaws.com/sales/promos/piano-month/practice-better-collage.png" alt="practice better collage image">--}}
{{--                </div>--}}
{{--            </div>--}}
{{--            <div class="text-center">--}}
{{--                <a href="#customize-anchor" class="join smaller blue anchor-slide md:w-1/4 mx-auto">See the deal</a>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </section>--}}
@endsection

@section('sticky-bar')
    @include('_partials.layout.holiday.sticky-bar', [
        'text' => 'GET 15 FREE BONUSES <br> WORTH $861',
        'homepage' => true,
    ])

{{--   <div class="h-10 w-full block" style="background:linear-gradient(140deg, #fff, #fd5257);"></div>--}}
{{--   <a href="#customize-anchor" style="background:linear-gradient(140deg, #fff, #fd5257);"--}}
{{--       class="promo-banner anchor-slide block text-center w-full transition-opacity duration-300 overflow-hidden whitespace-nowrap--}}{{--text-white--}}{{----}}{{-- bg-cover bg-center shadow-md py-1 --}}{{----}}{{--hover:text-gray-100--}}{{--z-0 mx-auto -mt-10 text-xs py-2">--}}
{{--       <div class="container mx-auto relative">--}}
{{--           <div class="inline-block align-middle text-center">--}}
{{--               <img class="inline-block align-middle mr-2 h-8 filter saturate-0 brightness-0" src="https://cdn.musora.com/image/fetch/w_150,q_auto:best/https://pianote.s3.amazonaws.com/sales/promos/october/logo_black.png" alt="promo logo">--}}
{{--              --}}{{-- <h5 class="leading-none font-bebas inline-block align-middle mx-auto text-2xl mr-2 h-8 py-1.5 px-2 bg-black rounded-md">Try Pianote</h5> --}}
{{--               <p class="leading-none inline-block align-middle mx-auto text-xs text-left mt-1"><strong>PRACTICE BETTER. PLAYER BETTER.<br> 6 BONUSES WORTH $262</strong></p>--}}
{{--           </div>--}}
{{--       </div>--}}
{{--   </a>--}}
@endsection

@section('final')
{{--     @include('pianote.sales.partials._subscribe-cards')--}}
{{--    @include('pianote.sales.partials._subscribe-bonus-list')--}}
<div id="customize-anchor" class="anchor"></div>
     @include('_partials.layout.holiday.homepage-bottom-membership',[
         'logo' => 'https://pianote.s3.amazonaws.com/sales/promos/november/pianote-annual-card.jpg',
         'joinText' => '<strong>Join Pianote for just $' . round(\PianotePrices::$pianoteMembershipAnnualRegular / 12, 2) . '/month</strong> <br class="hidden sm:inline"><strong class="text-promo">PLUS</strong> get 15 free bonuses worth $861.',
         'annualLink' => '/ecommerce/add-to-cart?products[PIANOTE-MEMBERSHIP-1-YEAR]=1&products[piano-chords-and-scales-guide]=1&products[pianote-practice-planner]=1&products[christmas-song-book]=1&products[christmas-song-book-digital]=1&products[poster-chords]=1&products[poster-scales]=1&products[the-power-of-chords]=1&products[classical-piano]=1&products[jesus-molina-improvisation-and-musical-freedom-pack]=1&products[play-beautiful-piano]=1&products[piano-riffs-and-fills]=1&products[piano-technique-made-easy]=1&products[destupefy-your-left-hand]=1&products[worship-piano]=1&products[faster-fingers]=1&redirect=/order&locked=true',
         'bonusNum' => 15,
         'tileWidth' => 'w-1/2 md:w-1/4 lg:w-1/5',
         'bonuses' => [
                [
                    'image' => 'https://pianote.s3.amazonaws.com/sales/promos/november/bonuses/chords-scales.jpg',
                    'title' => '',
                    'description' => 'Master Every Chord. Every Scale. In Every Key. ',
                    'price' => PianotePrices::$chordsScalesBookFull,
                    'shipping' => true,
                ],
                [
                    'image' => 'https://pianote.s3.amazonaws.com/sales/promos/may/Pianote_Planner_Card.jpg',
                    'title' => '',
                    'description' => 'Always know exactly what to practice.',
                    'price' => PianotePrices::$practicePlannerFull,
                    'shipping' => true,
                ],
                [
                    'image' => 'https://pianote.s3.amazonaws.com/sales/promos/november/bonuses/christmas-book.jpg',
                    'title' => '',
                    'description' => '14 beautiful Christmas Carols hand-picked and arranged for solo piano.',
                    'price' => PianotePrices::$christmasBookFull,
                ],
                [
                    'image' => 'https://pianote.s3.amazonaws.com/sales/promos/november/bonuses/christmas-songbook-card.jpg',
                    'title' => '',
                    'description' => 'Play Your Favorite Christmas Songs on the Piano',
                    'price' => PianotePrices::$christmasBookDigital,
                ],
                [
                    'image' => 'https://pianote.s3.amazonaws.com/sales/promos/may/Piano_Chords_Card.jpg',
                    'title' => '',
                    'description' => 'Always know your chord shapes with this helpful poster.',
                    'price' => PianotePrices::$posterFull,
                    'shipping' => true,
                ],
                [
                    'image' => 'https://pianote.s3.amazonaws.com/sales/promos/may/Piano_Scales_Card.jpg',
                    'title' => '',
                    'description' => 'Never forget the notes of a scale with this easy-to-read poster.',
                    'price' => PianotePrices::$posterFull,
                    'shipping' => true,
                ],
                [
                    'image' => 'https://pianote.s3.amazonaws.com/sales/promos/october/power_of_chords_card.jpg',
                    'title' => '',
                    'description' => 'Play the music you love using the power of chords.',
                    'price' => PianotePrices::$powerOfChordsFull,
                ],
                [
                    'image' => 'https://pianote.s3.amazonaws.com/sales/promos/november/bonuses/TBGTCP.jpg',
                    'title' => '',
                    'description' => 'Pieces you can actually play, with lessons that are actually fun.',
                    'price' => PianotePrices::$classicalPianoFull,
                ],
                [
                    'image' => 'https://pianote.s3.amazonaws.com/sales/promos/november/bonuses/improv-musical-freedom.jpg',
                    'title' => '',
                    'description' => 'Learn to improvise from one of the best piano players in the world, Jesús Molina',
                    'price' => PianotePrices::$improvisationAndMusicalFreedomFull,
                ],
                [
                    'image' => 'https://pianote.s3.amazonaws.com/sales/promos/november/bonuses/TBGTPBP.jpg',
                    'title' => '',
                    'description' => 'Start playing beautiful music from your very 1st lesson',
                    'price' => PianotePrices::$playBeautifulPianoFull,
                ],
                [
                    'image' => 'https://pianote.s3.amazonaws.com/sales/promos/black-friday/unlimited/piano-riffs-and-fills.jpg',
                    'title' => 'Piano Riffs<br> & Fills',
                    'description' => 'Learn the secrets and tips to play fills that sound complicated and advanced, but are simple to learn.',
                    'price' => PianotePrices::$pianoRiffsAndFillsFull,
                ],
                [
                    'image' => 'https://pianote.s3.amazonaws.com/sales/promos/black-friday/unlimited/piano-technique-made-easy.jpg',
                    'title' => 'Piano Technique<br> Made Easy',
                    'description' => 'Your ultimate guide to learning the piano. Learn EVERY scale, chord, arpeggio, and key signature.',
                    'price' => PianotePrices::$PTMEFull,
                ],
                [
                    'image' => 'https://pianote.s3.amazonaws.com/sales/promos/black-friday/unlimited/de-stupefy-your-left-hand.jpg',
                    'title' => 'De-Stupefy Your<br> Left Hand',
                    'description' => 'Most piano players find their left-hand is weaker. Fix those weaknesses and “de-stupefy” that left hand.',
                    'price' => PianotePrices::$destupefyFull,
                ],
                [
                    'image' => 'https://pianote.s3.amazonaws.com/sales/promos/black-friday/unlimited/worship-piano.jpg',
                    'title' => 'Worship<br> Piano',
                    'description' => 'Learn hundreds of worship songs and get the skills to start playing in a worship band.',
                    'price' => PianotePrices::$worshipPianoFull,
                ],
                [
                    'image' => 'https://pianote.s3.amazonaws.com/sales/promos/black-friday/unlimited/faster-fingers.jpg',
                    'title' => 'Faster<br> Fingers',
                    'description' => 'Increase your finger speed, strength, and accuracy with this complete digital training pack.',
                    'price' => PianotePrices::$fasterFingersFull,
                ],
            ],
         'monthlyLink' => '/ecommerce/add-to-cart?products[PIANOTE-MEMBERSHIP-1-MONTH]=1&redirect=%2Forder'
     ])
@endsection
