@extends('pianote._partials.global-layout')

@section('global-head')
    <title>Lifetime Membership To Pianote | Pianote</title>
    <meta property="og:title" content="Lifetime Membership To Pianote">
    <meta property="og:url" content="https://www.pianote.com/{{ Request::path() }}">

    <meta name="description" content="Two, maybe three times per year you get the chance to become a Pianote Lifetime Member.">
    <meta property="og:description" content="Two, maybe three times per year you get the chance to become a Pianote Lifetime Member.">
        <meta property="og:image" content="https://pianote.s3.amazonaws.com/sales/promos/black-friday/lifetime/vid-thumb21-alt.jpg" style="display: none;">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.19/tailwind.min.css" />
    <link href="{{ asset('/marketing/css/pianote/tailwind-helpers.css') }}" rel="stylesheet">
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
    </style>
@stop

@section('global-body')
    @include('pianote.sales.nav', [
    "joinVersion" => true,
    ])
    {{--<style>--}}
    {{--.promo-banner-shim{display:block;width:100%;height:40px}--}}
    {{--.promo-banner{display:block;background:#000 50%/cover;text-align:center;color:#fff;width:100%;transition:opacity .5s;overflow:hidden;position:relative;font:400 13px/1em Roboto Condensed,sans-serif;box-shadow:0 0 10px rgba(0,0,0,.2);white-space:nowrap;z-index:1;margin:-40px auto 0}.promo-banner .noise-wrap{padding:6px 0}.promo-banner.fixed{top:40px;position:fixed;z-index:97;margin:0 auto}@media (min-width:768px){.promo-banner.fixed{top:56px}}.promo-banner:active,.promo-banner:focus,.promo-banner:hover{color:#ccc;text-decoration:none}.promo-banner .row{position:relative;padding:0}.promo-banner .logo{display:inline-block;vertical-align:middle;width:auto;margin-right:10px;height:19px}@media (min-width:768px){.promo-banner .logo{height:28px}}.promo-banner h1{font-family:Oswald,sans-serif;display:inline-block;vertical-align:middle;margin-right:7px;font-size:19px}@media (min-width:768px){.promo-banner h1{margin-right:10px;font-size:25px}}.promo-banner .text,.promo-banner p{display:inline-block;vertical-align:middle}.promo-banner p{font:400 13px/1.1em Open Sans,sans-serif;text-transform:uppercase;margin:0 auto}.promo-banner p strong{font-weight:900}.promo-banner p .permanent{line-height:1em;font-size:19px}@media (min-width:768px){.promo-banner p .permanent{font-size:21px}}.promo-banner .join{outline:none;padding:6px 15px;font-size:12px;margin:3px 0 0}@media (min-width:768px){.promo-banner .join{font-size:13px;margin:0 0 0 7px}}--}}
    {{--</style>--}}
    {{--<div class="promo-banner fixed"--}}
            {{--style="background: #000 center center/250px;">--}}
        {{--<div class="noise-wrap">--}}
            {{--<div class="container mx-auto">--}}
                {{--<div class="text text-left">--}}
                    {{--<img class="logo"--}}
                            {{--src="https://cdn.musora.com/image/fetch/w_200,q_auto:best/https://pianote.s3.amazonaws.com/sales/promos/march/logo.png">--}}
                    {{--<p>--}}
                        {{--@if(!empty(PianotePrices::$pianoteMembershipLifetime))--}}
                            {{--<strong>ONLY <s class='opacity-60'>50</s> {{ $products['PIANOTE-MEMBERSHIP-LIFETIME']->getPublicStockCount()}} SPOTS LEFT</strong>--}}
                        {{--@endif--}}
                    {{--</p>--}}
                {{--</div>--}}
            {{--</div>--}}
        {{--</div>--}}
    {{--</div>--}}
    <section class="content-section text-center upgrade-video-header" style="background:linear-gradient(to bottom, #01050f, #021225);">
        <div class="container mx-auto">
            <h1 class="font-bebas">LOCK IN PIANO LESSONS <span class="text-coaches">FOR LIFE!</span></h1>
            <h6 class="leading-tight"><strong>LAST CHANCE PRICING. CLOSES JUNE 30TH</strong>
                <br><span class="text-white text-coaches uppercase">ONLY <span class="tzcd-full">A LIMITED TIME</span> LEFT!</span></h6>
            <div class="w-full mx-auto my-10 px-3" style="max-width:920px;">
                <div class="aspect-16:9 w-full relative">
                    <iframe class="absolute w-full h-full reset-on-close" src="//player.vimeo.com/video/723086583" frameborder="0" allowfullscreen allow="autoplay"></iframe>
                </div>
            </div>

{{--            @if($products['PIANOTE-MEMBERSHIP-LIFETIME']->getPublicStockCount() > 0)--}}
                {{--<a href="/ecommerce/add-to-cart?products[PIANOTE-MEMBERSHIP-LIFETIME]=1&products[singeo-1-year-membership-access]=1&products[piano-chords-and-scales-guide]=1&products[pianote-practice-planner]=1&locked=true&redirect=/order"--}}
                        {{--class="join methodcta my-4">Lifetime Membership</a>--}}
            {{--@else--}}
                <a class="join sold-out methodcta my-4">Sold Out</a>
            {{--@endif--}}

            <p class="text-light-navy leading-relaxed px-3 mt-10 text-left" style="width: 100%;max-width: 600px;">Two, <em>maybe</em> three times per year you get the chance to become a Pianote Lifetime Member.
                <br><br>
                You’ll make one final payment for your membership, and then enjoy a lifetime of piano lessons, song tutorials, and support from Pianote (plus boast with that lifetime badge around your name)
                <br><br>
                And while you normally get a couple of opportunities to upgrade your membership there’s one thing that’s different this time:
                <br><br>
                <strong>This is your last chance to get a Lifetime Membership for $797.</strong> After this round, the price is going up.
                <br><br>
                So if you’re ready to make a lifelong commitment to your piano playing, now’s the time. But a lifetime of lessons isn’t all you’ll get…
                <br><br>
                Because as part of the deal, you’ll also receive some incredible bonuses shipped to your door, including our best-selling Chords & Scales book.
                <br><br>
                And that’s not all…
                <br><br>
                You’ll also get unlimited singing lessons for an entire year. So if you’ve always wanted to sing while playing the piano, now you can try it risk-free.
            </p>
        </div>
    </section>
    <section class="text-center text-white py-10 md:py-20 lg:py-24 px-4 md:px-6 relative overflow-hidden" style="background:#01050f;">
        <div class="container mx-auto z-10 relative max-w-4xl">
            <h3 class="mb-8 sm:mb-12"><strong>Chat (and play) LIVE with Lisa!</strong></h3>
            <div class="flex flex-wrap sm:flex-nowrap items-center justify-center">

                <p class="order-1 sm:order-0 text-left text-light-navy sm:pr-5 lg:pr-12">We’ve never done this before.
                    <br><br>
                    As an exclusive bonus for our Lifetime Members, you’ll be invited to join a special LIVE Zoom call with Lisa where you can talk and play!
                    <br><br>
                    More intimate than our regular live Q&As, you’ll be able to chat face-to-face (virtually) with a smaller group so you can ask questions, get feedback, and even jam along!
                    <br><br>
                    <strong>This live event will ONLY be available to you and your fellow Lifetime Members.</strong>
                    <br><br>
                    We’ll pick dates and times that hopefully suit all time zones, and the replay will be available on-demand anytime you want to watch again.
                    <br><br>
                    Exact dates and times TBD. You’ll be contacted with the schedule by June 30th.</p>
                <img class="mb-4 sm:mb-0 order-0 sm:order-1 w-36 sm:w-72 lg:w-80" src="https://cdn.musora.com/image/fetch/w_650,q_auto:best/https://pianote.s3.amazonaws.com/sales/promos/june/Live_Chat_Screen.png">
            </div>
        </div>
    </section>
    <section class="content-section text-center px-6" style="background:linear-gradient(to bottom, #01050f, #021225);overflow:visible">
        <div class="container mx-auto max-w-3xl">
            <img class="h-28 md:h-32 lazyload" data-src="https://cdn.musora.com/image/fetch/w_250,q_auto:best/https://pianote.s3.amazonaws.com/sales/2022/piano-guarantee.png" alt="guarantee-badge">

            <h3 class="leading-tight mt-5 md:mt-8 mb-4 md:mb-6 " data-aos-once="true" data-aos="fade-up" data-aos-offset="150" data-aos-delay="150"><strong>Test-drive your lessons for 90 days.</strong><br>
                A lifetime of lessons. No regrets.</h3>
            <p class="text-light-navy leading-normal md:leading-loose">A Lifetime Membership can be a lot to think about. Is it worth it (we think so!)? Will you use it enough (we hope so!)? We’re removing the risk with our 90-day guarantee. More than anything, we want to make sure you LOVE your Lifetime Membership with Pianote.</p>
            <div class="flex flex-wrap items-start justify-center mt-5 md:mt-7">
                <div class="w-full sm:w-1/3 px-2 mb-3 sm:mb-0">
                    <h5 class="text-pianote border-pianote border-2 rounded-full inline-block py-2 px-3 mb-1">1</h5>
                    <h6 class="leading-normal">Start your<br> lessons today.</h6>
                </div>
                <div class="w-full sm:w-1/3 px-2 mb-3 sm:mb-0">
                    <h5 class="text-pianote border-pianote border-2 rounded-full inline-block py-2 px-3 mb-1">2</h5>
                    <h6 class="leading-normal">Enjoy them for 90<br>  days, risk-free.</h6>
                </div>
                <div class="w-full sm:w-1/3 px-2">
                    <h5 class="text-pianote border-pianote border-2 rounded-full inline-block py-2 px-3 mb-1">3</h5>
                    <h6 class="leading-normal">Change your mind?<br> Get a refund. <div class="inline-block tooltip cursor-pointer" tip="If it’s not for you, simply cancel your membership within 90 days and contact us for a full refund. (If your membership includes any bonuses, your refund will deduct the value of hard goods that were shipped to you.)"><i class="fas fa-info-circle"></i></div></h6>
                </div>
            </div>
        </div>
    </section>

    <div id="customize-anchor" class="anchor anchor-slide"></div>
        <section class="content-section text-center customize" style="background: #000;">
                <div class="container mx-auto">
                    <h2 class="leading-tight mb-5 md:mb-7 lg:mb-10" style="line-height: 1.4em;"><strong>Become a Lifetime Member today<br> for <span class="text-pianote">${{ PianotePrices::$pianoteMembershipLifetime }}</span> and get:</strong></h2>
                    <div class="horizontal-bonuses mx-auto max-w-xs sm:max-w-md md:max-w-4xl" style="font-size: 0;">
                        <style>
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
                        <div class="bonus-wrap relative inline-block align-top mx-auto mb-3 md:mb-4 px-2 md:px-3 lg:px-2 w-full">
                            <div class="flip-div special">
                                <div class="flip-inner">
                                    <div class="front ">
                                        {{--<div class="absolute top-0 right-0 border-2 bg-black text-promo rounded-full py-4 px-3 -m-5" style="border-color:#de0031"><p style="line-height: 1em;">SAVE</p><br><h5 class="leading-none" style="margin-bottom: 0;"><strong>20%</strong></h5></div>--}}
                                        <div class="image-wrap" style="background-image:url(https://cdn.musora.com/image/fetch/w_650,q_auto:best/https://pianote.s3.amazonaws.com/sales/promos/black-friday/unlimited/pianote-lifetime.png);"></div>
                                    </div>
                                    <div class="back">
                                        <div class="text-wrap">
                                            <p>Piano lessons for the rest of your life</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <p><span style="text-transform:uppercase; display:inline-block;margin-top: 7px;"><strong class="text-promo">${{ PianotePrices::$pianoteMembershipLifetime }}</strong></span><br>
                                INSTANT ACCESS
                            </p>
                        </div>

                        @php
                            $bonuses = [
                                [
                                'image' => 'https://pianote.s3.amazonaws.com/sales/promos/april/sing-play-flippy-cards07.jpg',
                                'title' => '1-Year Access To Singeo',
                                'description' => 'Learn to sing with Lisa Witt',
                                'price' => 127,
                                'online-ship' => "Non-recurring",
                                'badge' => ''
                                ],
                                [
                                'image' => 'https://pianote.s3.amazonaws.com/sales/2022/bonus-chords-scales.jpg',
                                'title' => 'Chords & <br>Scales Book',
                                'description' => 'Master every single chord and scale with this comprehensive guide.',
                                'price' => PianotePrices::$chordsScalesBookFull,
                                'online-ship' => "Free Shipping",
                                'badge' => 'Chords & Scales Book'
                                ],
                                [
                                'image' => 'https://pianote.s3.amazonaws.com/sales/promos/black-friday/unlimited/planner.png',
                                'title' => 'Practice <br>Planner',
                                'description' => 'Always know exactly what to practice.',
                                'price' => PianotePrices::$practicePlannerFull,
                                'online-ship' => "Free Shipping",
                                'badge' => 'Practice Planner'
                                ],
                                [
                                'image' => 'https://pianote.s3.amazonaws.com/sales/promos/june/Lisa_Chat_Card.jpg',
                                'title' => 'Exclusive Live Chat With Lisa',
                                'description' => 'Talk with Lisa about staying motivated and achieving your goals',
                                'online-ship' => "LIVE EVENT",
                                ],
                            ]
                        @endphp
                        @foreach($bonuses as $bonus)
                            <div class="bonus-wrap relative inline-block align-top mx-auto mb-3 md:mb-4 px-2 md:px-3 lg:px-2 w-1/2 sm:w-1/4">
                                <div class="flip-div @if(!empty($bonus['class'])) {{ $bonus['class'] }} @endif" style="padding-bottom: 140%;">
                                    <div class="flip-inner">
                                        <div class="front @if(!empty($bonus['shipping'])) {{ $bonus['shipping'] }} @endif">
                                            <div class="hover-icon"><i class="fas fa-arrow-right"></i><br>DETAILS</div>
                                            <div class="image-wrap" style="background-image:url(https://cdn.musora.com/image/fetch/w_460,q_auto:best/{{ $bonus['image'] }});"></div>
                                        </div>
                                        <div class="back">
                                            <div class="text-wrap">
                                                <p class="text-xs">{!!  $bonus['description']  !!}</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <p class="uppercase">
                                    <strong class="font-black leading-tight inline-block mt-2 mb-1">{!!  $bonus['title']  !!}</strong><br>
                                    <span class="text-pianote" style="text-transform:uppercase; display:inline-block;">
                                        @if(!empty($bonus['price']))
                                        <s>${{ $bonus['price'] }}</s>
                                        @endif
                                        <strong>FREE</strong></span><br>
                                    {{ $bonus['online-ship'] }}
                                </p>
                            </div>
                        @endforeach

                        {{--<p style="max-width: 480px;color: #aaa;padding:0 15px;"><em>All digital bonuses are added to your account IMMEDIATELY  with your membership to Pianote, and they’re yours forever. </em></p>--}}
                    </div>

{{--                    @if($products['PIANOTE-MEMBERSHIP-LIFETIME']->getPublicStockCount() > 0)--}}
                        {{--<a href="/ecommerce/add-to-cart?products[PIANOTE-MEMBERSHIP-LIFETIME]=1&products[singeo-1-year-membership-access]=1&products[piano-chords-and-scales-guide]=1&products[pianote-practice-planner]=1&locked=true&redirect=/order"--}}
                                {{--class="join methodcta my-4">Become A lifetime Member &raquo;</a>--}}
                        {{--<p>(Or choose a payment plan on the next page.)</p>--}}
                    {{--@else--}}
                        <a class="join sold-out methodcta my-4">Sold Out</a>
                    {{--@endif--}}

                </div>
        </section>
        <section class="content-section text-center" style="background: #0c1429;">
            <div class="container mx-auto relative z-50 max-w-md">
                <div class="inline-block w-full px-3 md:px-4 mb-5 text-light-navy">
                    <h5 class="mb-2"><strong>Still have questions?</strong></h5>
                    <p>If you need any further information about becoming a Lifetime Member, <a href="/support"><u>contact our amazing support team!</u></a>
                        <br><br>
                        A friendly and knowledgeable support team member will get back to you right away.</p>
                </div>
                <div class="inline-block w-full px-3 md:px-4 text-light-navy" style="margin-top: 0;">
                    <i class="mx-0.5 text-3xl md:text-4xl fab fa-cc-visa"></i>
                    <i class="mx-0.5 text-3xl md:text-4xl fab fa-cc-mastercard"></i>
                    <i class="mx-0.5 text-3xl md:text-4xl fab fa-cc-amex"></i>
                    <i class="mx-0.5 text-3xl md:text-4xl fab fa-cc-paypal"></i>
                    <i class="mx-0.5 text-3xl md:text-4xl fab fa-cc-discover"></i>
                </div>
            </div>
        </section>

    @include('pianote.sales.footer')

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script type="text/javascript" src="/marketing/parcel/pianote/nav-footer.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/lazysizes/5.3.2/lazysizes.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/lazysizes/5.3.2/plugins/unveilhooks/ls.unveilhooks.min.js"></script>
    <script type="text/javascript" src="/marketing/js/jquery.countdown-2.min.js"></script>
    <script>
        $(document).ready(function () {
            $('.flip-div').click(function (e) {
                $(this).toggleClass('flipped');
            });

            // Countdown
            $('.tzcd-full').countdown('2022/07/01')
                .on('update.countdown', function (event) {
                    var format = '%-M Minute%!M %-S Second%!S';
                    if (event.offset.totalHours > 0) {
                        format = '%-H Hour%!H ' + format;
                    }
                    if (event.offset.totalDays > 0) {
                        format = '%-D Day%!D ' + format;
                    }
                    $(this).html(event.strftime(format));
                })
                .on('finish.countdown', function (event) {
                    $(this).html('a limited time');
                });
            $('.tzcd-small').countdown('2022/07/01')
                .on('update.countdown', function (event) {
                    var format = '%-MM %-SS';
                    if (event.offset.totalHours > 0) {
                        format = '%-HH ' + format;
                    }
                    if (event.offset.totalDays > 0) {
                        format = '%-DD ' + format;
                    }
                    $(this).html(event.strftime(format));
                })
                .on('finish.countdown', function (event) {
                    $(this).html('a limited time');
                });
            $('.tzcd-big').countdown('2022/07/01')
                .on('update.countdown', function (event) {
                    var format = '' + '<div><h1>%M</h1> <p>min%!M</p></div> ' + '<div><h1>%S</h1> <p>sec%!S</p></div>';
                    if (event.offset.totalHours > 0) {
                        format = '' + '<div><h1>%H</h1> <p>hr%!H</p></div> ' + format;
                    }
                    if (event.offset.totalDays > 0) {
                        format = '' + '<div><h1>%D</h1> <p>day%!D</p></div> ' + format;
                    }
                    $(this).html(event.strftime(format));
                })
                .on('finish.countdown', function (event) {
                    $(this).html('<div><h1>LIMITED</h1> <p>TIME LEFT</p></div>');
                });
        });
    </script>
@stop
