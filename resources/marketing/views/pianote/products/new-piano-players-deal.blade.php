@extends('pianote._partials.global-layout')

@section('global-head')
    <title>Keep the momentum going!</title>
    <meta property="og:title" content="Keep the momentum going!">

    <meta name="description" content="We’ve put together an exclusive offer for New Piano Players Start Here students.">
    <meta property="og:description" content="We’ve put together an exclusive offer for New Piano Players Start Here students.">

    <meta property="og:url" content="https://www.pianote.com/{{ Request::path() }}">
    <meta property="og:image" content="https://d2vyvo0tyx8ig5.cloudfront.net/sales/2023/share-image-pianote2.jpg" style="display: none;">

    @include('_partials.layout._fonts')

    <link rel="stylesheet" href="{{ mix('marketing/css/app.css') }}">
    <link href="{{ asset('/marketing/css/tailwind-helpers.css') }}" rel="stylesheet">
    <link href="{{ asset('/marketing/parcel/pianote/nav-footer.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('/marketing/parcel/pianote/sales.css') }}">

    <style>
        .text-yellow {
            color: #FFB500;
        }

        .flip-div,
        .flip-div .bg-image {
            padding-bottom: 120%;
        }
        @media (min-width: 768px) {
            .flip-div,
            .flip-div .bg-image {
                padding-bottom: 167%;
            }
        }
        .flip-div,
        .flip-div .bg-image {
            padding-bottom: 100%;
        }
        .flip-div.flipped .front,
        .flip-div.flipped .front {
            -ms-transform: rotateY(180deg);
            -webkit-transform: rotateY(180deg);
            transform: rotateY(180deg);
        }
        .flip-div.flipped .back,
        .flip-div.flipped .back {
            -ms-transform: rotateY(0deg);
            -webkit-transform: rotateY(0deg);
            transform: rotateY(0deg);
        }
        .flip-div .back,
        .flip-div .back {
            -ms-transform: rotateY(-180deg);
            -webkit-transform: rotateY(-180deg);
            transform: rotateY(-180deg);
        }
        .flip-div .front,
        .flip-div .back {
            -ms-transition: transform 0.8s;
            -webkit-transition: transform 0.8s;
            transition: transform 0.8s;
            -ms-backface-visibility: hidden;
            -webkit-backface-visibility: hidden;
            backface-visibility: hidden;
        }
    </style>
@stop

@section('body-data')
    x-data ='{
        trailer : false,
    }'
@endsection

@section('global-body')
    @include("pianote.sales.partials._nav")

    <section class="py-20 text-center text-white" style="background:linear-gradient(180deg, #01050F 60.48%, #07132C 100%);">
        <div class="mx-auto">
            <h1 class="md:leading-none">
                You’ve done the hard part.<br>
                <b>Keep the momentum going!</b>
            </h1>
            <h4 class="text-yellow uppercase my-6">GET UNLIMITED PIANO LESSONS FOR A YEAR + 12 FREE BONUSES</h4>
            <div class="w-full mx-auto mb-10 px-3" style="max-width:920px;">
                <img
                    loading="lazy"
                    class="transition-opacity opacity-0 cursor-pointer"
                    onload="this.classList.remove('opacity-0')"
                    src="https://cdn.musora.com/image/fetch/w_1200,q_auto:best/https://d2vyvo0tyx8ig5.cloudfront.net/products/new-piano-players/ascension-thumb.jpg"
                    alt="Ascension thumbnail"
                    @click="trailer = true"
                />
            </div>
            <p class="leading-relaxed px-3 my-5 text-left" style="width: 100%; max-width: 700px;">
                The first step is always the hardest. <br><br>

                But you’ve done it. You’ve spent the last 30 days playing piano, building your foundation, and (hopefully) having FUN!<br><br>

                And now the hard part’s over, we want to make it easy for you to keep your momentum going.<br><br>

                So we’ve put together an exclusive offer for New Piano Players Start Here students. Join Pianote today and you’ll get:

            </p>
            <ul class="pl-4 mx-auto text-left" style="width: 100%; max-width: 700px;">
                <li class="flex items-start">
                    <span class="mr-2"><i class="fas fa-check pt-1 mr-2 text-pianote"></i></span>
                    Unlimited access to step-by-step lessons
                </li>
                <li class="flex items-start">
                    <span class="mr-2"><i class="fas fa-check pt-1 mr-2 text-pianote"></i></span>
                    Personal support from Lisa and all the teachers
                </li>
                <li class="flex items-start">
                    <span class="mr-2"><i class="fas fa-check pt-1 mr-2 text-pianote"></i></span>
                    Continued access to the community forums and Live events
                </li>
                <li class="flex items-start">
                    <span class="mr-2"><i class="fas fa-check pt-1 mr-2 text-pianote"></i></span>
                    A library of 1000 songs at your fingertips, complete with backing tracks
                </li>
                <li class="flex items-start">
                    <span class="mr-2"><i class="fas fa-check pt-1 mr-2 text-pianote"></i></span>
                    Professional over-ear headphones to help you sound better
                </li>
                <li class="flex items-start">
                    <span class="mr-2"><i class="fas fa-check pt-1 mr-2 text-pianote"></i></span>
                    The Practice Planner so you can keep this streak alive
                </li>
                <li class="flex items-start">
                    <span class="mr-2"><i class="fas fa-check pt-1 mr-2 text-pianote"></i></span>
                    A Chords Poster and Scales Poster to hang in your practice space for easy access
                </li>
                <li class="flex items-start">
                    <span class="mr-2"><i class="fas fa-check pt-1 mr-2 text-pianote"></i></span>
                    Lifetime access to 9 digital courses, including The Power of Chords - the perfect next step in your journey
                </li>
            </ul>
            <p class="leading-relaxed px-3 my-5 text-left" style="width: 100%; max-width: 700px;">
                Plus…
                <br><br>
                A special, LIVE Masterclass with Lisa where you’ll learn how to take all the skills you’ve learned in New PIano Players Start Here and apply it to other areas of music.
                <br><br>
                We’ll also discount your first year by $43 as a special thank you, and you’ll have 90 days to try it risk-free
                <br><br>
                But this offer is only available until the end of March.
                <br><br>
                So click below and keep your progress going!<br><br><br>
            </p>
            <div class="px-3 md:px-0">
                <a class="join pianote w-full sm:w-auto max-w-xs sm:max-w-full anchor-slide" href="#customize-section">Claim the offer</a>
            </div>
        </div>
    </section>



    <div id="customize-section" class="anchor"></div>
    <section class="py-12 md:py-20 px-4 sm:px-6" style="background:linear-gradient(180deg, #01050F 60.48%, #07132C 100%);">
        <div class="max-w-2xl lg:max-w-5xl mx-auto text-center text-white">
            <img class="h-12 mb-4" src="https://d2vyvo0tyx8ig5.cloudfront.net/logo/pianote-logo-red.png" alt="pianote logo">
            <h3 class="font-extrabold">Join Pianote today and get 12 free bonuses!</h3>
            <h5 class="uppercase my-8 text-yellow">Only
                    <span x-cloak x-data="timer()" x-init="countdown()">
                         <span x-cloak x-show="timeLeft > 0 && day !== '00'"><span x-text="day"></span><span x-text="dayText"></span></span>
                         <span x-cloak x-show="timeLeft > 0 && hour !== '00'"><span x-text="hour"></span><span x-text="hourText"></span></span>
                         <span x-cloak x-show="timeLeft > 0"><span x-text="minute"></span><span x-text="minuteText"></span></span>
                         <span x-cloak x-show="timeLeft > 0"><span x-text="second"></span><span x-text="secondText"></span></span>
                         <span x-cloak x-show="timeLeft < 0">A Limited Time</span>
                     </span>
                left!</h5>
            <div class="max-w-md mx-auto mb-10">
                <img
                    src="https://cdn.musora.com/image/fetch/w_800,q_auto:best/https://d2vyvo0tyx8ig5.cloudfront.net/sales/promos/november/pianote-annual-card.jpg"
                    alt="pianote annual membership"
                    loading="lazy"
                    class="transition-opacity opacity-0 cursor-pointer rounded-xl"
                    onload="this.classList.remove('opacity-0')"
                />
            </div>
            <div class="max-w-2xl mx-auto flex justify-center lg:mb-10 flex-wrap">
                @php
                    $bonuses = [
                        [
                            'image' => 'https://d2vyvo0tyx8ig5.cloudfront.net/shop/card-thumbs/headphones-cart.jpg',
                            'title' => 'Pianote Headphones',
                            'description' => 'Hear your piano the way it was meant to sound.',
                            'price' => floatval($productPrices['pianote-headphones']->price),
                            'shipping' => true,
                        ],
                        [
                            'image' => 'https://d2vyvo0tyx8ig5.cloudfront.net/sales/promos/may/Pianote_Planner_Card.jpg',
                            'title' => 'Practice Planner',
                            'description' => 'Always know exactly what to practice.',
                            'price' => floatval($productPrices['pianote-practice-planner']->price),
                            'shipping' => true,
                        ],
                        [
                            'image' => 'https://d2vyvo0tyx8ig5.cloudfront.net/sales/promos/may/Piano_Chords_Card.jpg',
                            'title' => 'Chords Poster',
                            'description' => 'Hang these piano chords in your practice space.',
                            'price' => floatval($productPrices['poster-chords']->price),
                            'shipping' => true,
                        ],
                        [
                            'image' => 'https://d2vyvo0tyx8ig5.cloudfront.net/sales/promos/may/Piano_Scales_Card.jpg',
                            'title' => 'Scales Poster',
                            'description' => 'All the major and minor piano scales in one poster.',
                            'price' => floatval($productPrices['poster-scales']->price),
                            'shipping' => true,
                        ],
                        [
                            'image' => 'https://d2vyvo0tyx8ig5.cloudfront.net/sales/promos/october/power_of_chords_card.jpg',
                            'title' => 'The Power of Chords',
                            'description' => 'Play the music you love using the power of chords.',
                            'price' => floatval($productPrices['the-power-of-chords']->price),
                        ],
                    ]
                @endphp
                @foreach($bonuses as $bonus)
                    <div class="bonus-wrap relative inline-block align-top mb-3 px-1 md:px-4 w-1/2 sm:w-1/3">
                        <div class="flip-div inline-block relative w-full group" style="@if(empty($bonus['bigCard'])) padding-bottom: 133%; @else padding-bottom: 103%; @endif perspective: 1000px;">
                            <div class="text-center w-full h-full absolute cursor-pointer" style="transform-style: preserve-3d;">
                                <div class="border-2 border-pianote front absolute z-20 overflow-hidden rounded-xl w-full h-full transition-transform duration-700" style="@if(!empty($bonus['special'])) overflow: visible;border-color: #cda880; @endif backface-visibility: hidden;">
                                    <div class="overflow-hidden rounded-xl h-full w-full bg-black bg-top bg-cover lazyload" data-bg="https://cdn.musora.com/image/fetch/w_460,q_auto:best/{{ $bonus['image'] }}"></div>
                                    <div class="absolute z-40 text-center top-1/2 left-1/2 text-white transition-opacity duration-300 transform -translate-x-1/2 -translate-y-1/2 visible opacity-0 group-hover:opacity-100 text-shadow-2">
                                        <i class="fas fa-arrow-right text-4xl"></i><br>
                                        <p class="text-sm"><strong>DETAILS</strong></p>
                                    </div>
                                </div>
                                <div class="back border-2 border-pianote absolute z-40 overflow-hidden rounded-xl w-full h-full transition-transform duration-700" style="backface-visibility: hidden;">
                                    <div class="w-full h-full mx-auto text-center text-white flex flex-wrap justify-center items-center content-center p-2 md:p-3" style="background:linear-gradient(to bottom, #01050f, #021225);">
                                        <p class="leading-normal mx-auto text-sm">{!! $bonus['description'] !!}</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <p class="uppercase w-full leading-normal mt-2">
                            <strong class="font-black leading-tight inline-block mb-1">{!!  $bonus['title']  !!}</strong><br>
                            <span style="text-transform:uppercase; display:inline-block;">

                        @if(!empty($bonus['price']))
                                    <s class="opacity-50">${{ $bonus['price'] }}</s>
                                @endif

                                @if(!empty($bonus['priceReal']))
                                    <strong class="text-promo">{{ $bonus['priceReal'] }}</strong>
                                @else
                                    <strong class="text-promo">FREE</strong>
                                @endif
                            </span><br>
                            <i>
                                @if(!empty($bonus['shipping']))
                                    Free Shipping
                                @else
                                    Online Access
                                @endif
                            </i>
                        </p>
                    </div>
                @endforeach
                <div class="bonus-wrap relative inline-block align-top mb-3 px-1 md:px-4 w-1/2 sm:w-1/3">
                    <div class="flip-div inline-block relative w-full group" style="@if(empty($bonus['bigCard'])) padding-bottom: 133%; @else padding-bottom: 103%; @endif perspective: 1000px;">
                        <div class="text-center w-full h-full absolute cursor-pointer" style="transform-style: preserve-3d;">
                            <div class="border-2 border-pianote front absolute z-20 overflow-hidden rounded-xl w-full h-full transition-transform duration-700" style="@if(!empty($bonus['special'])) overflow: visible;border-color: #cda880; @endif backface-visibility: hidden;">
                                <div class="overflow-hidden rounded-xl h-full w-full bg-black">
                                    <div class="flex flex-wrap justify-center">
                                        <img class="w-1/3" src="https://cdn.musora.com/image/fetch/w_120,q_auto:best/https://d2vyvo0tyx8ig5.cloudfront.net/sales/promos/november/bonuses/TBGTCP.jpg">
                                        <img class="w-1/3" src="https://cdn.musora.com/image/fetch/w_120,q_auto:best/https://d2vyvo0tyx8ig5.cloudfront.net/sales/promos/november/bonuses/improv-musical-freedom.jpg">
                                        <img class="w-1/3" src="https://cdn.musora.com/image/fetch/w_120,q_auto:best/https://d2vyvo0tyx8ig5.cloudfront.net/sales/promos/november/bonuses/TBGTPBP.jpg">
                                        <img class="w-1/3" src="https://cdn.musora.com/image/fetch/w_120,q_auto:best/https://d2vyvo0tyx8ig5.cloudfront.net/sales/promos/black-friday/unlimited/piano-riffs-and-fills.jpg">
                                        <img class="w-1/3" src="https://cdn.musora.com/image/fetch/w_120,q_auto:best/https://d2vyvo0tyx8ig5.cloudfront.net/sales/promos/black-friday/unlimited/piano-technique-made-easy.jpg">
                                        <img class="w-1/3" src="https://cdn.musora.com/image/fetch/w_120,q_auto:best/https://d2vyvo0tyx8ig5.cloudfront.net/sales/promos/black-friday/unlimited/de-stupefy-your-left-hand.jpg">
                                        <img class="w-1/3" src="https://cdn.musora.com/image/fetch/w_120,q_auto:best/https://d2vyvo0tyx8ig5.cloudfront.net/sales/promos/black-friday/unlimited/worship-piano.jpg">
                                        <img class="w-1/3" src="https://cdn.musora.com/image/fetch/w_120,q_auto:best/https://d2vyvo0tyx8ig5.cloudfront.net/sales/promos/black-friday/faster-fingers.jpg">
                                    </div>
                                </div>
                                <div class="absolute z-40 text-center top-1/2 left-1/2 text-white transition-opacity duration-300 transform -translate-x-1/2 -translate-y-1/2 visible opacity-0 group-hover:opacity-100 text-shadow-2">
                                    <i class="fas fa-arrow-right text-4xl"></i><br>
                                    <p class="text-sm"><strong>DETAILS</strong></p>
                                </div>
                            </div>
                            <div class="back border-2 border-pianote absolute z-40 overflow-hidden rounded-xl w-full h-full transition-transform duration-700" style="backface-visibility: hidden;">
                                <div class="w-full h-full mx-auto text-center text-white flex flex-wrap justify-center items-center content-center p-2 md:p-3" style="background:linear-gradient(to bottom, #01050f, #021225);">
                                    <p class="leading-normal mx-auto text-sm">Get 8 digital courses for life. Even if you cancel your membership. They’re yours forever.</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <p class="uppercase w-full leading-normal mt-2">
                        <strong class="font-black leading-tight inline-block mb-1">8 Digital Courses</strong><br>
                        <span style="text-transform:uppercase; display:inline-block;"><s class="opacity-50">$617</s> <strong class="text-promo">FREE</strong></span><br>
                        <i>Online Access</i>
                    </p>
                </div>

            </div>
            <h3 class="mb-8"><strong>ONLY <s class="opacity-60">${{ 240 }}</s> $197</strong></h3>
            <div class="w-2/3 mx-auto">
                <a
                    href="/ecommerce/add-to-cart?locked=true&redirect=/order&product-array=PIANOTE-MEMBERSHIP-1-YEAR:1,pianote-headphones:1,pianote-practice-planner:1,poster-chords:1,poster-scales:1,the-power-of-chords:1,classical-piano:1,jesus-molina-improvisation-and-musical-freedom-pack:1,play-beautiful-piano:1,piano-riffs-and-fills:1,piano-technique-made-easy:1,destupefy-your-left-hand:1,worship-piano:1,faster-fingers:1"
                    class="join pianote w-full">Claim your offer</a>
            </div>
            <p class="text-center my-8" style="color:#ABB5C2;">
                <b>Any questions?</b> Call us toll-free at 1-800-439-8921 or directly at 1-604-855-7605.
            </p>
            <div class="text-light-navy">
                <i class="mx-0.5 text-3xl md:text-4xl fab fa-cc-visa"></i>
                <i class="mx-0.5 text-3xl md:text-4xl fab fa-cc-mastercard"></i>
                <i class="mx-0.5 text-3xl md:text-4xl fab fa-cc-amex"></i>
                <i class="mx-0.5 text-3xl md:text-4xl fab fa-cc-paypal"></i>
                <i class="mx-0.5 text-3xl md:text-4xl fab fa-cc-discover"></i>
            </div>
        </div>
    </section>

    @include("pianote.sales.partials._footer", [
        "minimal" => true
    ])

    @include('_partials.components.video-modal',[
        'name' => 'trailer',
        'video' => '809895671',
        'vimeo' => true,
    ])

    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="{{ asset('/marketing/parcel/drumeo/navigation-sales.js') }}"></script>
    <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/lazysizes/5.3.2/lazysizes.min.js"></script>
    <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/lazysizes/5.3.2/plugins/unveilhooks/ls.unveilhooks.min.js"></script>

    <script>
        $(document).ready(function(){

            $('.flip-div').click(function (e) {
                $(this).toggleClass('flipped');
            });

        })
    </script>

    @include('_partials.components.countdown',[
        'countdownDate' => '2023-04-01 00:00:00',
        'promoVersion' => false
    ])
@stop
