@extends('pianote._partials.global-layout')

@section('global-head')
    <title>The Beautiful Beginner Piano Bundle</title>
    <meta property="og:title" content="The Beautiful Beginner Piano Bundle">
    <meta property="og:url" content="https://www.pianote.com/{{ Request::path() }}">

    <meta name="description" content="Because starting out should sound this good.">
    <meta property="og:description" content="Because starting out should sound this good.">
    <meta property="og:image" content="https://www.musora.com/musora-cdn/image/width=1200,quality=85/https://pianote.s3.amazonaws.com/shop/products/beautiful-beginner-bundle/banner.jpg" style="display: none;">

    <link rel="stylesheet" href="{{ mix('marketing/css/app.css') }}">
    <link href="{{ asset('/marketing/css/tailwind-helpers.css') }}" rel="stylesheet">
    <link href="{{ asset('/marketing/parcel/pianote/nav-footer.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('/marketing/parcel/pianote/sales.css') }}">
    <link href="{{ asset('/marketing/css/animate.css') }}" rel="stylesheet">
    <style>
        .lazyload {
            opacity: 0;
        }

        .lazyloading {
            opacity: 1;
            transition: opacity 300ms;
        }

        .tooltip {
            position: absolute;
        }
        .tooltip:after, .tooltip:before {
            position: absolute;
            transform: translate(-50%, 0);
            height: auto;
            max-height: 0;
            visibility: hidden;
            opacity: 0;
            transition: all .3s;
            overflow: hidden;
            font-size: 14px;
        }
        .tooltip:before {
            z-index: 100;
            content: "";
            bottom: 23px;
            left: 50%;
            border-right: 7px transparent solid;
            border-left: 7px transparent solid;
            border-top: 7px solid #fff;
        }
        .tooltip:after {
            padding: 5px 8px;
            content: attr(tip);
            font-size: 14px;
            text-align: left;
            color: #000;
            width: 220px;
            border-radius: 8px;
            background: #fff;
            box-shadow: 0 0 15px #000;
            bottom: 30px;
            left: -300%;
        }
        .tooltip:hover, .tooltip:active, .tooltip:focus {
            z-index: 100;
        }
        .tooltip:hover:after, .tooltip:hover:before, .tooltip:active:after, .tooltip:active:before, .tooltip:focus:after, .tooltip:focus:before {
            max-height: 1000px;
            visibility: visible;
            opacity: 1;
            display: block;
        }

        .content-section.customize .horizontal-bonuses .bonus-wrap .flip-div.special {
            max-width:240px;
            padding-bottom: 51%;
        }
        @media (min-width: 768px) {
            .content-section.customize .horizontal-bonuses .bonus-wrap .flip-div.special {
                max-width:370px;
                padding-bottom: 35%;
            }
        }
        @media (min-width: 1024px) {
            .content-section.customize .horizontal-bonuses .bonus-wrap .flip-div.special {
                max-width:400px;
                padding-bottom: 30%;
            }
        }
    </style>
@stop

@section('global-body')
    @include('pianote.sales.partials._nav', [
        "subscriptionVersion" => true,
        "scrollToJoin" => true
    ])

    <section class="content-section text-center upgrade-video-header bg-white text-black">
        <div class="container mx-auto">
            <h1 class="font-bebas uppercase leading-none mb-1">The Beautiful Beginner<br class="inline sm:hidden"> <span class="text-coaches">Piano Bundle.</span></h1>
            <h6 class="uppercase leading-tight"><strong>Because starting out <br class="inline sm:hidden"> should sound this good.</strong></h6>
            <div class="w-full mx-auto mt-5 sm:mt-10 mb-10 sm:mb-20 px-4" style="max-width:920px;">
                <img
                    class="rounded-xl"
                    src="https://www.musora.com/musora-cdn/image/width=1300,quality=85/https://pianote.s3.amazonaws.com/shop/products/beautiful-beginner-bundle/banner.jpg"
                    alt="Video thumbnail"
                    loading="lazy"
                    onload="this.classList.remove('opacity-0')"
                />
            </div>

            <div class="max-w-md md:max-w-4xl mx-auto px-4 lg:px-0">

                <div class="horizontal-bonuses mx-auto max-w-xs sm:max-w-xl lg:max-w-2xl" style="font-size: 0;">
                    <h4 class="mb-4"><strong>Whats included:</strong></h4>
                    @php
                        $bonuses = [
                            [
                                'image' => 'https://d2vyvo0tyx8ig5.cloudfront.net/sales/promos/october/power_of_chords_card.jpg',
                                'title' => 'The Power of Chords',
                                'description' => 'Play the music you love using the power of chords.',
                                'price' => floatval($productPrices['the-power-of-chords']->price),
                            ],
                            [
                                'image' => 'https://d2vyvo0tyx8ig5.cloudfront.net/sales/promos/black-friday/unlimited/piano-riffs-and-fills.jpg',
                                'title' => 'Piano Riffs<br> & Fills',
                                'description' => 'Learn the secrets and tips to play fills that sound complicated and advanced, but are simple to learn.',
                                'price' => floatval($productPrices['piano-riffs-and-fills']->price),
                            ],
                            [
                                'image' => 'https://d2vyvo0tyx8ig5.cloudfront.net/sales/promos/november/bonuses/TBGTPBP.jpg',
                                'title' => 'Play Beautiful Piano',
                                'description' => 'Start playing beautiful music from your very 1st lesson.',
                                'price' => floatval($productPrices['play-beautiful-piano']->price),
                            ],
                            [
                                'image' => 'https://d2vyvo0tyx8ig5.cloudfront.net/sales/2022/bonus-chords-scales.jpg',
                                'title' => 'Chords & <br>Scales Book',
                                'description' => 'Your encyclopedia of piano chords & scales.',
                                'price' => 39,
                                'feature' => "Free Shipping",
                            ],
                            [
                                'image' => 'https://d2vyvo0tyx8ig5.cloudfront.net/shop/products/2021-merch/card-chords-poster.jpg',
                                'title' => 'Chords Poster',
                                'description' => 'Always know your chord shapes with this helpful poster.',
                                'price' => 9,
                                'feature' => "Free Shipping",
                            ],
                            [
                                'image' => 'https://d2vyvo0tyx8ig5.cloudfront.net/shop/products/2021-merch/card-scales-poster.jpg',
                                'title' => 'Scales Poster',
                                'description' => 'Never forget the notes of a scale with this easy-to-read poster.',
                                'price' => 9,
                                'feature' => "Free Shipping",
                            ],
                        ]
                    @endphp
                    @foreach($bonuses as $key => $bonus)
                        <div class="bonus-wrap relative inline-block align-top mx-auto mb-4 px-1 md:px-3 w-1/2 md:w-1/3">
                            <div class="flip-div inline-block relative w-full group" style="@if(empty($bonus['bigCard'])) padding-bottom: 133%; @else padding-bottom: 103%; @endif perspective: 1000px;">
                                <div class="text-center w-full h-full absolute" style="transform-style: preserve-3d;">
                                    <div class="front absolute z-20 overflow-hidden rounded-xl w-full h-full transition-transform duration-700" style="@if(!empty($bonus['special'])) overflow: visible;border-color: #cda880; @endif backface-visibility: hidden;">
                                        <div class="overflow-hidden rounded-xl h-full w-full bg-black bg-top bg-cover lazyload" data-bg="https://www.musora.com/musora-cdn/image/width=460,quality=85/{{ $bonus['image'] }}"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach

                    {{--<p style="max-width: 480px;color: #aaa;padding:0 15px;"><em>All digital bonuses are added to your account IMMEDIATELY  with your membership to Pianote, and they’re yours forever. </em></p>--}}
                </div>

                <div class="px-3 {{-- mb-10 md:mb-32--}}">
                    <h4 class="my-5 sm:my-10 leading-tight"><strong>Lesson for life WITHOUT the <br class="inline sm:hidden"> long-term commitment.</strong></h4>
                    <p class="text-left">
                        Let’s face it.
                        <br><br>
                        EVERYTHING is more expensive right now. And it doesn’t look like changing anytime soon. So what does that mean for your hobbies? You know -- what you do in your free time?
                        <br><br>
                        At Pianote, we believe your hobbies matter.
                        <br><br>
                        That’s why we’ve put together the Beautiful Beginner Piano Bundle.
                        <br><br>
                        For one single payment, you’ll get LIFETIME access to 3 courses that will show you how to play beautiful music on your piano. You’ll get step-by-step lessons and access to real teachers.
                        <br><br>
                        PLUS you’ll get our Chords & Scales Book and 2 handy posters you can hang up in your practice space to make learning easier and more fun. And don’t worry, we’ll cover the shipping no matter where you live.
                        <br><br>
                        Your hobbies matter.
                        <br><br>
                        Grab the Beautiful Beginner Piano Bundle, and start making beautiful music from your first lesson.
                    </p>
                </div>
                <div class="pack-details mx-auto px-3">
                    <hr class="my-8">
                    <h3 class="text-left mb-6 leading-tight"><strong>The Beautiful Beginner <br class="inline sm:hidden"> Piano Bundle.</strong></h3>
                    <div class="bonus-pic mb-7 md:flex md:items-start md:mb-10 lg:items-center text-left">
                        <div class="image-wrap w-32 lg:w-48 flex-shrink-0 relative overflow-hidden mb-4 md:mb-0 md:mr-5 mx-auto ">
                            <img class="w-full rounded-lg" src="https://www.musora.com/musora-cdn/image/width=300,quality=85/https://d2vyvo0tyx8ig5.cloudfront.net/sales/promos/november/bonuses/power-of-chords.jpg" alt="product thumbnail1">
                        </div>
                        <div>
                            <strong>The Power of Chords - <span>Normally $97</span>
                                <br>
                                <span class="text-pianote">LIFETIME ACCESS</span>
                            </strong><br>
                            Play the music you love on the piano with the awesome Power of Chords. This fun course will demystify chording and show you how chords are the foundation of ALL music (even classical). When you understand and can play chords -- you’ll be able to play the songs you love easier, with more confidence.
                            <br>
                        </div>
                    </div>
                    <div class="bonus-pic mb-7 md:flex md:items-start md:mb-10 lg:items-center text-left">
                        <div class="image-wrap w-32 lg:w-48 flex-shrink-0 relative overflow-hidden mb-4 md:mb-0 md:mr-5 mx-auto ">
                            <img class="w-full rounded-lg" src="https://www.musora.com/musora-cdn/image/width=300,quality=85/https://d2vyvo0tyx8ig5.cloudfront.net/sales/promos/black-friday/unlimited/piano-riffs-and-fills.jpg" alt="product thumbnail5">
                        </div>
                        <div>
                            <strong>Piano Riffs &amp; Fills - <span>Normally $99</span>
                                <br>
                                <span class="text-pianote">LIFETIME ACCESS</span>
                            </strong><br>
                            Anyone can play a chord -- but what happens in the spaces between the chords distinguishes the great players from the mediocre ones. Fill those spaces with piano riffs that will make you sound professional, polished ... and close to perfect. This course is broken down so even complete beginners can start sounding amazing. You’ll be shown exactly how to play the fills -- note for note.
                            <br>
                        </div>
                    </div>
                    <div class="bonus-pic mb-7 md:flex md:items-start md:mb-10 lg:items-center text-left">
                        <div class="image-wrap w-32 lg:w-48 flex-shrink-0 relative overflow-hidden mb-4 md:mb-0 md:mr-5 mx-auto ">
                            <img class="w-full rounded-lg" src="https://www.musora.com/musora-cdn/image/width=300,quality=85/https://d2vyvo0tyx8ig5.cloudfront.net/sales/promos/november/bonuses/TBGTPBP.jpg" alt="product thumbnail4">
                        </div>
                        <div>
                            <strong>Playing Beautiful Piano - <span>Normally $7</span>
                                <br>

                                <span class="text-pianote">LIFETIME ACCESS</span>
                            </strong><br>
                            Start playing beautiful piano music from the very first time you touch the keyboard. The Beginner’s Guide To Playing Beautiful Piano is your introduction to the world of stunning melodies and emotional music. Follow along and play beautiful sounds. But you won’t just be copying what you see… You’ll learn WHY certain chords and melodies sound beautiful. So after the course, you can create your own beautiful piano music.
                            <br>
                        </div>
                    </div>
                    <div class="bonus-pic mb-7 md:flex md:items-start md:mb-10 lg:items-center text-left">
                        <div class="image-wrap w-32 lg:w-48 flex-shrink-0 relative overflow-hidden mb-4 md:mb-0 md:mr-5 mx-auto ">
                            <img class="w-full rounded-lg" src="https://www.musora.com/musora-cdn/image/width=300,quality=85/https://pianote.s3.amazonaws.com/sales/2022/bonus-chords-scales.jpg" alt="product thumbnail4">
                        </div>
                        <div>
                            <strong>Piano Chords &amp; Scales - <span>Normally $39</span>
                                <br>

                                <span class="text-pianote">FREE SHIPPING</span>
                            </strong><br>
                            You need chords to play your favorite songs, but learning them all can be a real challenge. The Piano Chords &amp; Scales book is your go-to reference guide so you’ll never get stuck again. See a chord you don’t know? Simply flip to the relevant page in your book and you’ll see all the inversions and alterations you need to play beautifully and confidently. Don’t let scary-looking chords slow your progress.
                            <br>
                        </div>
                    </div>
                    <div class="bonus-pic mb-7 md:flex md:items-start md:mb-10 lg:items-center text-left">
                        <div class="image-wrap w-32 lg:w-48 flex-shrink-0 relative overflow-hidden mb-4 md:mb-0 md:mr-5 mx-auto ">
                            <img class="w-full rounded-lg" src="https://www.musora.com/musora-cdn/image/width=300,quality=85/https://pianote.s3.amazonaws.com/sales/promos/black-friday/unlimited/poster-chords.jpg" alt="product thumbnail5">
                        </div>
                        <div>
                            <strong>Chords Poster - <span>Normally $9</span>
                                <br>

                                <span class="text-pianote">FREE SHIPPING</span>
                            </strong><br>
                            Chord shapes can be hard to remember, especially when you’re starting out and learning how they work. Luckily we have the Pianote Chords Poster to help you with all those tricky shapes! Get this awesome poster for your practice space and start chording your way through all your favorite songs. If you ever forget your chord shapes, all you have to do is look up!
                            <br>
                        </div>
                    </div>
                    <div class="bonus-pic md:flex md:items-start lg:items-center text-left">
                        <div class="image-wrap w-32 lg:w-48 flex-shrink-0 relative overflow-hidden mb-4 md:mb-0 md:mr-5 mx-auto ">
                            <img class="w-full rounded-lg" src="https://www.musora.com/musora-cdn/image/width=300,quality=85/https://pianote.s3.amazonaws.com/sales/promos/black-friday/unlimited/poster-scales.jpg" alt="product thumbnail6">
                        </div>
                        <div>
                            <strong>Scales Poster - <span>Normally $9</span>
                                <br>

                                <span class="text-pianote">FREE SHIPPING</span>
                            </strong><br>
                            If you ever find yourself forgetting the notes in a scale (like most of us do), the Pianote Scales Poster is here to help! Remember your scales with this easy-to-read poster, designed to help you quickly recall the right notes at the right time, making your scales (or soloing) a piece of cake. With this up on your wall, you’ll never miss a note again.
                            <br>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="text-center relative z-50 overflow-hidden px-5 sm:px-6 py-10 sm:py-14 lg:py-20" style="background-color:#eff7ff;">
        <div class="container mx-auto relative z-50">
            <h2 class="leading-tight"><strong>The Beautiful Beginner Piano Bundle.</strong></h2>

            <h6 class="leading-normal mb-7 sm:mb-10">Because starting out should sound this good.</h6>
            <div class="flex flex-wrap items-center mb-7 sm:mb-10">
                <div class="flex flex-wrap sm:flex-nowrap items-center text-left w-full max-w-3xl mx-auto xl:w-7/12">
                    <a class="px-5 sm:px-7 lg:px-9 py-7 sm:py-11 mb-7 sm:mb-0 sm:-ml-5 z-10 relative rounded-xl bg-white shadow-lg w-full sm:w-1/2 sm:order-1"
                        href="/ecommerce/add-to-cart?product-array=the-power-of-chords:1,piano-riffs-and-fills:1,play-beautiful-piano:1,piano-chords-and-scales-guide:1,poster-chords:1,poster-scales:1&redirect=/order&locked=true"
                    >
                        <h4 class="mb-5"><strong>The Beautiful Beginner Piano Bundle </strong></h4>
                        <h2 class="inline-block"><strong class="text-4xl"><s class="opacity-50">$260</s> ${{ 127 }}</strong></h2> <p class="inline-block text-xs">Only</p><br>
                        <div class="join blue smaller my-4">Get Started</div>
                        <ul class="list-disc ml-7">
                            <li class="text-sm relaxed">The Power of Chords</li>
                            <li class="text-sm relaxed">Piano Riffs & Fills</li>
                            <li class="text-sm relaxed">Beginner’s Guide to Playing Beautiful Piano</li>
                            <li class="text-sm relaxed">Piano Chords & Scales Book</li>
                            <li class="text-sm relaxed">Piano Chords Poster</li>
                            <li class="text-sm relaxed">Piano Scales Poster</li>
                        </ul>
                        <hr class="w-full my-5 border-pianote">
                        <p class="leading-loose text-sm"><strong>Key Features</strong><br>
                            <i class="fas fa-check text-pianote mr-1"></i> Lifetime access to all 3 courses<br>
                            <i class="fas fa-check text-pianote mr-1"></i> Free worldwide shipping<br>
                            <i class="fas fa-check text-pianote mr-1"></i> 90-Day Guarantee</p>
                    </a>
                    <a class="px-5 sm:px-7 lg:px-9 py-7 sm:py-9 rounded-xl shadow-lg w-full sm:w-1/2" style="background-color:#d4eaff;"
                        href="/ecommerce/add-to-cart?product-array=the-power-of-chords:1,piano-riffs-and-fills:1,play-beautiful-piano:1&redirect=/order&locked=true"
                    >
                        <h4><strong>The Beautiful Beginner Piano Bundle </strong></h4>
                        <p class="text-sm mt-2 mb-5">(Digital-Only Verison)</p>
                        <h2 class="inline-block"><strong class="text-4xl"><s class="opacity-50">$203</s> ${{ 97 }}</strong></h2> <p class="inline-block text-xs">Only</p><br>
                        <div class="join blue smaller my-4">Get Started</div>
                        <ul class="list-disc ml-7">
                            <li class="text-sm relaxed">The Power of Chords</li>
                            <li class="text-sm relaxed">Piano Riffs & Fills</li>
                            <li class="text-sm relaxed">Beginner’s Guide to Playing Beautiful Piano</li>
                        </ul>
                        <hr class="w-full my-5 border-pianote">
                        <p class="leading-loose text-sm"><strong>Key Features</strong><br>
                            <i class="fas fa-check text-pianote mr-1"></i> Lifetime access to all 3 courses<br>
                            <i class="fas fa-check text-pianote mr-1"></i> 90-Day Guarantee</p>
                    </a>
                </div>
                <div class="flex w-full justify-center xl:justify-start xl:order-1 xl:w-5/12 xl:pl-4  mt-10 xl:mt-0">
                    <img class="max-w-lg sm:max-w-2xl lg:max-w-4xl lazyload" data-src="https://www.musora.com/musora-cdn/image/width=1800,quality=85/https://pianote.s3.amazonaws.com/shop/products/beautiful-beginner-bundle/bottom-collage.png" alt="order collage image">
                </div>
            </div>
            <div class="inline-block w-full px-3 md:px-4 my-3 sm:my-5" style="color:#2a2f34;">
                <p><strong>Any other questions?</strong><br class="inline-block md:hidden"> Call us toll-free at
                    <a href="tel:+18004398921">1-800-439-8921</a> <br class="inline-block md:hidden"> or directly at
                    <a href="tel:+16048557605">1-604-855-7605</a>.<br> All prices listed in USD. </p>
            </div>
            <div class="inline-block w-full px-3 md:px-4" style="color:#2a2f34;">
                <i class="mx-0.5 text-3xl md:text-4xl fab fa-cc-visa"></i>
                <i class="mx-0.5 text-3xl md:text-4xl fab fa-cc-mastercard"></i>
                <i class="mx-0.5 text-3xl md:text-4xl fab fa-cc-amex"></i>
                <i class="mx-0.5 text-3xl md:text-4xl fab fa-cc-paypal"></i>
                <i class="mx-0.5 text-3xl md:text-4xl fab fa-cc-discover"></i>
            </div>
            </div>

    </section>
    @include('pianote.sales.partials._footer')

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script type="text/javascript" src="{{ asset('/marketing/parcel/drumeo/navigation-sales.js') }}"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/lazysizes/5.3.2/lazysizes.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/lazysizes/5.3.2/plugins/unveilhooks/ls.unveilhooks.min.js"></script>
    <script type="text/javascript" src="{{ asset('/marketing/js/modal.js') }}"></script>
    <script>
        $(document).ready(function () {
            $(document).foundation();
        });
    </script>
    <script type="text/javascript" src="{{ asset('/marketing/js/modal-autoplay.js') }}"></script>
@stop
