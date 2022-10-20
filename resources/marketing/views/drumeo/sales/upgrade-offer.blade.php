@extends('drumeo._partials.layout-template')

@section('global-head')
    <title>Keep your membership + get 9 free bonuses. | Drumeo</title>
    <meta property="og:title" content="Keep your membership + get 9 free bonuses.">
    <meta property="og:url" content="https://www.drumeo.com/{{ Request::path() }}">

    <meta name="description" content="You’ve spent 30-days crushing it with step-by-step drum lessons and we want to help you keep it going! ">
    <meta property="og:description" content="You’ve spent 30-days crushing it with step-by-step drum lessons and we want to help you keep it going! ">
        <meta property="og:image" content="https://dpwjbsxqtam5n.cloudfront.net/sales/2022/og-image.jpg" style="display: none;">

    @include('drumeo._partials._fonts')

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.19/tailwind.min.css" />
    <link href="{{ asset('/marketing/css/drumeo/tailwind-helpers.css') }}" rel="stylesheet">
    <link href="{{ asset('/marketing/parcel/drumeo/sales-2020.css') }}" rel="stylesheet">
    <link href="{{ asset('/marketing/parcel/drumeo/navigation-sales.css') }}" rel="stylesheet">
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
        @include("drumeo.sales.partials._nav", [
            "edgeVersion" => true,
            "scrollToJoin" => true
        ])
    <section class="content-section text-center" style="padding-bottom: 0;">
        <div class="container mx-auto">
            <img class="h-7 md:h-10 lg:h-12 mb-2 md:mb-4" src="https://dpwjbsxqtam5n.cloudfront.net/logos/logo-blue.png">
            <h1><strong>Keep Your Membership +  <br class="inline lg:hidden">Get 9 Free Bonuses.</strong></h1>
            <div class="w-full mx-auto my-10 px-3" style="max-width:920px;">
                <div class="aspect-16:9 w-full relative">
                    <iframe class="absolute w-full h-full reset-on-close" src="//player.vimeo.com/video/514078315" frameborder="0" allowfullscreen allow="autoplay"></iframe>
                </div>
            </div>
            <h5 class="leading-relaxed px-3" style="width: 100%;max-width: 690px;">You’ve spent 30 days crushing it with step-by-step drum lessons, detailed song breakdowns, and inspiring coaching sessions with world-renowned drummers. And we want to help you keep it going.
                <br><br>
                Below this video, you’ll see a special bundle including 9 FREE bonuses + a discounted annual Drumeo membership. We’re hoping it’s everything you need to have your best year on the drums. Scroll down to check it out!
            </h5>
        </div>
    </section>

        <section class="content-section text-center px-6" style="background:linear-gradient(to bottom, #01050f, #021225);overflow:visible">
            <div class="container mx-auto max-w-4xl">
                <img class="h-28 md:h-32 lazyload" data-src="https://cdn.musora.com/image/fetch/w_250,q_auto:best/https://drumeo-assets.s3.amazonaws.com/sales/2022/guarantee.png">

                <h3 class="leading-tight mt-5 md:mt-8 mb-4 md:mb-6 " data-aos-once="true" data-aos="fade-up" data-aos-offset="150" data-aos-delay="150"><strong>Test-drive your lessons for 90 days.</strong><br>
                    Zero risk.</h3>
                <p class="text-light-navy leading-normal md:leading-loose">Online lessons can be intimidating. Maybe you’re wondering if they work, or if you’ll use them enough – or if you’ll even enjoy the experience. So we’re removing the risk with our 90-day guarantee. More than anything, we want to make sure you have a POSITIVE experience developing new skills and gaining confidence on the drums. </p>
                <div class="flex flex-wrap items-start justify-center mt-5 md:mt-7">
                    <div class="w-full sm:w-1/3 px-2 mb-3 sm:mb-0">
                        <h5 class="text-drumeo border-drumeo border-2 rounded-full inline-block py-2 px-3 mb-1">1</h5>
                        <h6 class="leading-normal">Start your<br> lessons today.</h6>
                    </div>
                    <div class="w-full sm:w-1/3 px-2 mb-3 sm:mb-0">
                        <h5 class="text-drumeo border-drumeo border-2 rounded-full inline-block py-2 px-3 mb-1">2</h5>
                        <h6 class="leading-normal">Enjoy them for 90<br>  days, risk-free.</h6>
                    </div>
                    <div class="w-full sm:w-1/3 px-2">
                        <h5 class="text-drumeo border-drumeo border-2 rounded-full inline-block py-2 px-3 mb-1">3</h5>
                        <h6 class="leading-normal">Change your mind?<br> Get a refund. <a class="tooltip cursor-pointer" tip="If it’s not for you, simply cancel your membership within 90 days and contact us for a full refund. (If your membership includes any bonuses, your refund will deduct the value of hard goods that were shipped to you.)"><i class="fas fa-info-circle"></i></a></h6>
                    </div>
                </div>
            </div>
        </section>
    <div id="customize-anchor" class="anchor anchor-slide"></div>
        <section class="content-section text-center customize" style="background:#000a1e;">
                <div class="container mx-auto">
                    <div class="mx-auto max-w-sm sm:max-w-md md:max-w-xl lg:max-w-5xl" style="font-size: 0;">
                        <h3 class="mb-10"><strong>CONTINUE YOUR MEMBERSHIP<br class="inline lg:hidden"> TODAY AND GET:</strong></h3>
                        @php
                            $bonuses = [
                                [
                                'image' => 'https://drumeo-assets.s3.amazonaws.com/promos/black-friday/bundles/vertical-bg/pad.jpg',
                                'title' => 'Drumeo QuietPad',
                                'description' => 'The portable, double-sided practice pad with one traditional side and one quiet side.',
                                'price' => Prices::$quietPadFull,
                                'online-ship' => "Free Shipping",
                                'shipping' => "no-shipping"
                                ],
                                [
                                'image' => 'https://dpwjbsxqtam5n.cloudfront.net/promos/black-friday/bundles/vertical-bg/drumsticks.jpg',
                                'title' => 'Drumeo Drumsticks',
                                'description' => 'Drumeo 5A Drumsticks by Vater -- made with hickory and extra moisture to last longer.',
                                'price' => Prices::$sticksFull,
                                'online-ship' => "Free Shipping",
                                'shipping' => "no-shipping"
                                ],
                                [
                                'image' => 'https://dpwjbsxqtam5n.cloudfront.net/promos/black-friday/bundles/vertical-bg/tdt.jpg',
                                'title' => "The Drummer's Toolbox",
                                'description' => 'Presenting drummers the most comprehensive introduction to 101 drumming styles.',
                                'price' => Prices::$toolboxBookFull,
                                'online-ship' => "Free Shipping",
                                'shipping' => "no-shipping"
                                ],
                                [
                                'image' => 'https://dpwjbsxqtam5n.cloudfront.net/promos/black-friday/bundles/vertical-bg/rdm.jpg',
                                'title' => 'Rock Drumming Masterclass',
                                'description' => 'Todd Sucherman’s 26-week masterclass to help you improve your rock drumming.',
                                'price' => Prices::$rdmFull,
                                'online-ship' => "Instant Access"
                                ],
                                [
                                'image' => 'https://dpwjbsxqtam5n.cloudfront.net/promos/black-friday/bundles/vertical-bg/dtme.jpg',
                                'title' => 'Drum Technique Made Easy',
                                'description' => 'Bruce Becker’s 26-week masterclass to improve your hand & foot technique.',
                                'price' => Prices::$dtmeFull,
                                'online-ship' => "Instant Access"
                                ],
                                [
                                'image' => 'https://dpwjbsxqtam5n.cloudfront.net/promos/black-friday/bundles/vertical-bg/ime.jpg',
                                'title' => 'Independence Made Easy',
                                'description' => 'Jared Falk’s 26-week masterclass to unlock your musicality and freedom on the drums.',
                                'price' => Prices::$imeFull,
                                'online-ship' => "Instant Access"
                                ],
                                [
                                'image' => 'https://dpwjbsxqtam5n.cloudfront.net/promos/black-friday/bundles/vertical-bg/sd.jpg',
                                'title' => 'Successful Drumming',
                                'description' => 'Jared Falk’s 18-hour video curriculum for building a solid foundation on the drums.',
                                'price' => Prices::$sdOnlineFull,
                                'online-ship' => "Instant Access"
                                ],
                                [
                                'image' => 'https://dpwjbsxqtam5n.cloudfront.net/promos/black-friday/bundles/vertical-bg/lsf.jpg',
                                'title' => 'Learn Songs Faster',
                                'description' => 'This masterclass will give you proven techniques for learning MORE songs in less time.',
                                'price' => Prices::$learnSongsFasterFull,
                                'online-ship' => "Instant Access"
                                ],
                                [
                                'image' => 'https://dpwjbsxqtam5n.cloudfront.net/promos/black-friday/bundles/vertical-bg/fwtbdf.jpg',
                                'title' => 'Better Drum Fills',
                                'description' => 'The ultimate four-week crash course to playing more creative & more musical drum fills.',
                                'price' => Prices::$bdfFull,
                                'online-ship' => "Instant Access"
                                ],
                            ]
                        @endphp
                        @foreach($bonuses as $bonus)
                            <div class="bonus-wrap relative inline-block align-top mx-auto mb-3 px-1 md:px-3 w-1/2 sm:w-1/3 lg:w-1/5">
                                <div class="flip-div inline-block relative w-full group" style="padding-bottom: 132%;perspective: 1000px;">
                                    <div class="text-center w-full h-full absolute cursor-pointer" style="transform-style: preserve-3d;">
                                        <div class="border-2 border-drumeo front absolute z-20 overflow-hidden rounded-xl w-full h-full transition-transform duration-700" style="backface-visibility: hidden;">
                                            @if(!empty($bonus['shipping']))
                                                <p class="absolute text-white top-0 left-0 w-full pb-0.5 text-sm bg-drumeo rounded-t-xl"><strong>Free Shipping</strong></p>
                                            @endif
                                            <div class="h-full w-full bg-black bg-top bg-cover lazyload" data-bg="https://cdn.musora.com/image/fetch/w_460,q_auto:best/{{ $bonus['image'] }}"></div>
                                            <div class="absolute z-40 text-center top-1/2 left-1/2 text-white transition-opacity duration-300 transform -translate-x-1/2 -translate-y-1/2 visible opacity-0 group-hover:opacity-100 text-shadow-2">
                                                <i class="fas fa-arrow-right text-4xl"></i><br>
                                                <p class="text-sm"><strong>DETAILS</strong></p>
                                            </div>
                                        </div>
                                        <div class="back border-2 border-drumeo absolute z-40 overflow-hidden rounded-xl w-full h-full transition-transform duration-700" style="backface-visibility: hidden;">
                                            <div class="w-full h-full mx-auto text-center text-white flex flex-wrap justify-center items-center content-center p-2 md:p-3" style="background:linear-gradient(to bottom, #01050f, #021225);">
                                                <p class="leading-normal mx-auto text-sm">{!! $bonus['description'] !!}</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <p class="uppercase w-full leading-normal">
                                    <strong class="font-black leading-tight inline-block mt-2 mb-1">{!!  $bonus['title']  !!}</strong><br>
                                    <span class="text-promo" style="text-transform:uppercase; display:inline-block;"><s>${{ $bonus['price'] }}</s> <strong>FREE</strong></span><br>
                                    @if(!empty($bonus['shipping']))
                                        Free Shipping
                                    @endif
                                </p>
                            </div>
                        @endforeach
                    </div>

                    <p class="px-2"><strong>Your annual membership will start at the end of your 30-day trial. <br class="hidden md:inline">
                            So you’ll still get the full value of your one dollar purchase.</strong></p>

                    <a class="join blue bigger my-4 md:my-5 w-full max-w-xs md:max-w-lg lg:max-w-3xl" style="padding: 20px 10px;" href="{{ URL::Route('shopping-cart.to-cart.api') }}?products[DLM]=1,year,1&products[quietpad]=1&products[Drumeo-VaterSticks]=1&products[the-drummers-toolbox-book]=1&products[SD-DIGI]=1&products[rock-drumming-masterclass-pack]=1&bonuses[drum-technique-made-easy-pack]=1&bonuses[independence-made-easy-pack]=1&bonuses[four-weeks-to-better-drum-fills]=1&bonuses[learn-songs-faster-pack]=1&locked=true&promo-code=full-time">Keep My Membership &raquo;</a>

                    <br><br class="inline-block md:hidden">
                    <a class="monthly-alt" href="{{ URL::Route('shopping-cart.to-cart.api') }}?products[DLM]=1,month,1&locked=true"><p><u><em>Or start a monthly membership for <br class="inline-block md:hidden">${{ Prices::$drumeoEdgeRegular }}/month. (no bonuses)</em></u></p></a>
                </div>
        </section>
        <section class="content-section text-center" style="background: #0c1429;">
            <div class="container mx-auto relative z-50">
                <a class="inline-block" href="https://www.shopperapproved.com/reviews/Musora.com/product/Drumeo+Membership/7918738" target="_blank" onclick="window.open('https://www.shopperapproved.com/reviews/Musora.com/product/Drumeo+Membership/7918738', 'newwindow', 'width=750, height=550'); return false;">
                    <img alt="" class="h-7 md:h-12 lg:h-14 mb-2 md:mb-0 mx-auto md:mr-2 opacity-70 lazyload" data-src="https://cdn.musora.com/image/fetch/w_320,q_auto:best/https://dpwjbsxqtam5n.cloudfront.net/sales/2021/shopper-approved-logo-white.png">
                    <i class="align-middle text-2xl md:text-4xl fas fa-star" style="color: #f68d2d;"></i>
                    <i class="align-middle text-2xl md:text-4xl fas fa-star" style="color: #f68d2d;"></i>
                    <i class="align-middle text-2xl md:text-4xl fas fa-star" style="color: #f68d2d;"></i>
                    <i class="align-middle text-2xl md:text-4xl fas fa-star" style="color: #f68d2d;"></i>
                    <i class="align-middle text-2xl md:text-4xl fas fa-star" style="color: #f68d2d;"></i>
                    <p class="mx-auto mt-2 md:mt-3 text-light-navy">Drumeo is rated 5-stars for price, satisfaction,<br class="inline sm:hidden"> and customer service. <u>See The Reviews »</u></p>
                </a>
                <div class="inline-block w-full px-3 md:px-4 my-5 text-light-navy">
                    <p><strong>Any questions?</strong><br class="inline-block md:hidden"> Call us toll-free at
                        <a href="tel:+18004398921">1-800-439-8921</a> <br class="inline-block md:hidden"> or directly at
                        <a href="tel:+16048557605">1-604-855-7605</a>.<br> All prices listed in USD. </p>
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

    @include("drumeo.sales.partials._footer")

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script type="text/javascript" src="{{ asset('/marketing/parcel/drumeo/navigation-sales.js') }}"></script>
    <script type="text/javascript" src="{{ asset('/assets/js/sliding-anchor.js') }}"></script>
    <script type="text/javascript" src="/marketing/js/drumeo/jquery.countdown-2.min.js"></script>
    <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/lazysizes/5.3.2/lazysizes.min.js"></script>
    <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/lazysizes/5.3.2/plugins/unveilhooks/ls.unveilhooks.min.js"></script>
    <script>
        $(document).ready(function () {
            $('.flip-div').click(function (e) {
                $(this).toggleClass('flipped');
            });

        });
    </script>
@stop
