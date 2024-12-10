@extends('drumeo._partials.global-layout')

@section('global-head')
    <title>Keep your membership + get 9 free bonuses. | Drumeo</title>
    <meta property="og:title" content="Keep your membership + get 9 free bonuses.">
    <meta property="og:url" content="https://www.drumeo.com/{{ Request::path() }}">

    <meta name="description" content="You’ve spent 30 days crushing it with step-by-step drum lessons and we want to help you keep it going! ">
    <meta property="og:description" content="You’ve spent 30 days crushing it with step-by-step drum lessons and we want to help you keep it going! ">
        <meta property="og:image" content="https://dpwjbsxqtam5n.cloudfront.net/sales/2023/share-image-drumeo.jpg" style="display: none;">

    @include('_partials.layout._fonts')

    <link rel="stylesheet" href="{{ mix('marketing/css/app.css') }}">
    <link href="{{ asset('/marketing/parcel/drumeo/navigation-sales.css') }}" rel="stylesheet">
    <link href="{{ asset('/marketing/css/tailwind-helpers.css') }}" rel="stylesheet">
    <link href="{{ asset('/marketing/parcel/drumeo/sales-2020.css') }}" rel="stylesheet">
@stop

@section('body-data')
    x-data ='{
    lazyLoad: false,
    }'
@endsection

@section('global-body')
        @include("drumeo.sales.partials._nav", [
            "subscriptionVersion" => true,
            "scrollToJoin" => true
        ])
    <section class="content-section text-center" style="padding-bottom: 0;">
        <div class="container mx-auto">
            <img class="h-7 md:h-10 lg:h-12 mb-2 md:mb-4" src="https://www.musora.com/musora-cdn/image/quality=95,width=250,metadata=none/https://dpwjbsxqtam5n.cloudfront.net/logos/logo-blue.png">
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
                <img class="h-28 md:h-32" src="https://www.musora.com/musora-cdn/image/width=250,quality=95/https://dpwjbsxqtam5n.cloudfront.net/sales/2022/guarantee.png">

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
                        <h6 class="leading-normal relative">
                            Change your mind?<br> Get a refund.
                            <div class="ml-2 inline-block cursor-pointer group" aria-label="Refund Information">
                                <i class="fas fa-info-circle"></i>
                                <div class="absolute left-1/2 transform -translate-x-1/2 -translate-y-full hidden group-hover:block transition-all duration-300 opacity-0 group-hover:opacity-100 group-hover:max-h-[1000px] max-h-0"
                                    style="    top: 0;">
                                    <div class="absolute left-1/2 transform -translate-x-1/2 bottom-[-14px] border-[7px] border-transparent border-t-white"></div>
                                    <div class="p-2 text-xs text-black bg-white rounded-lg shadow-xl" style="    width: 200px;">
                                        If it’s not for you, simply cancel your membership within 90 days and contact us for a full refund. (If your membership includes any bonuses, your refund will deduct the value of hard goods that were shipped to you.)
                                    </div>
                                </div>
                            </div>
                        </h6>
                    </div>
                </div>
            </div>
        </section>
    <div id="customize-anchor" class="anchor anchor-slide"></div>
        <section class="py-14 sm:py-24 lg:py-32 relative overflow-hidden text-white text-center customize px-4 lg:px-6" style="background-color:#000;">
                <div class="container mx-auto">
                    <div class="mx-auto max-w-sm sm:max-w-md md:max-w-xl lg:max-w-5xl" style="font-size: 0;">
                        <h3 class="mb-10"><strong>CONTINUE YOUR MEMBERSHIP<br class="inline lg:hidden"> TODAY AND GET:</strong></h3>
                        @php
                            $bonuses = [
                                [
                                'image' => 'https://dpwjbsxqtam5n.cloudfront.net/promos/black-friday/bundles/vertical-bg/pad.jpg',
                                'title' => 'Drumeo QuietPad',
                                'description' => 'The portable, double-sided practice pad with one traditional side and one quiet side.',
                                'price' => floatval($productPrices['quietpad']->price),
                                'online-ship' => "Free Shipping",
                                'shipping' => "no-shipping"
                                ],
                                [
                                'image' => 'https://dpwjbsxqtam5n.cloudfront.net/promos/black-friday/bundles/vertical-bg/drumsticks.jpg',
                                'title' => 'Drumeo Drumsticks',
                                'description' => 'Drumeo 5A Drumsticks by Vater — made with hickory and extra moisture to last longer.',
                                'price' => floatval($productPrices['Drumeo-VaterSticks']->price),
                                'online-ship' => "Free Shipping",
                                'shipping' => "no-shipping"
                                ],
                                [
                                'image' => 'https://dpwjbsxqtam5n.cloudfront.net/promos/black-friday/bundles/vertical-bg/tdt.jpg',
                                'title' => "The Drummer's Toolbox",
                                'description' => 'Presenting drummers the most comprehensive introduction to 101 drumming styles.',
                                'price' => floatval($productPrices['the-drummers-toolbox-book']->price),
                                'online-ship' => "Free Shipping",
                                'shipping' => "no-shipping"
                                ],
                                [
                                'image' => 'https://dpwjbsxqtam5n.cloudfront.net/promos/black-friday/bundles/vertical-bg/rdm.jpg',
                                'title' => 'Rock Drumming Masterclass',
                                'description' => 'Todd Sucherman’s 26-week masterclass to help you improve your rock drumming.',
                                'price' => floatval($productPrices['rock-drumming-masterclass-pack']->price),
                                'online-ship' => "Instant Access"
                                ],
                                [
                                'image' => 'https://dpwjbsxqtam5n.cloudfront.net/promos/black-friday/bundles/vertical-bg/dtme.jpg',
                                'title' => 'Drum Technique Made Easy',
                                'description' => 'Bruce Becker’s 26-week masterclass to improve your hand & foot technique.',
                                'price' => floatval($productPrices['drum-technique-made-easy-pack']->price),
                                'online-ship' => "Instant Access"
                                ],
                                [
                                'image' => 'https://dpwjbsxqtam5n.cloudfront.net/promos/black-friday/bundles/vertical-bg/ime.jpg',
                                'title' => 'Independence Made Easy',
                                'description' => 'Jared Falk’s 26-week masterclass to unlock your musicality and freedom on the drums.',
                                'price' => floatval($productPrices['independence-made-easy-pack']->price),
                                'online-ship' => "Instant Access"
                                ],
                                [
                                'image' => 'https://dpwjbsxqtam5n.cloudfront.net/promos/black-friday/bundles/vertical-bg/sd.jpg',
                                'title' => 'Successful Drumming',
                                'description' => 'Jared Falk’s 18-hour video curriculum for building a solid foundation on the drums.',
                                'price' => floatval($productPrices['SD-DIGI']->price),
                                'online-ship' => "Instant Access"
                                ],
                                [
                                'image' => 'https://dpwjbsxqtam5n.cloudfront.net/promos/black-friday/bundles/vertical-bg/lsf.jpg',
                                'title' => 'Learn Songs Faster',
                                'description' => 'This masterclass will give you proven techniques for learning MORE songs in less time.',
                                'price' => floatval($productPrices['learn-songs-faster-pack']->price),
                                'online-ship' => "Instant Access"
                                ],
                                [
                                'image' => 'https://dpwjbsxqtam5n.cloudfront.net/promos/black-friday/bundles/vertical-bg/fwtbdf.jpg',
                                'title' => 'Better Drum Fills',
                                'description' => 'The ultimate four-week crash course to playing more creative & more musical drum fills.',
                                'price' => floatval($productPrices['four-weeks-to-better-drum-fills']->price),
                                'online-ship' => "Instant Access"
                                ],
                            ]
                        @endphp
                        @foreach($bonuses as $bonus)
                            <div
                                class="bonus-wrap relative inline-block align-top mx-auto mb-4 px-1 md:px-3 @if(!empty($bonusWidth)) {{ $bonusWidth }} @else w-1/2 md:w-1/4 lg:w-1/5 @endif"
                                x-data="{
                        flipped: false,
                    }"
                                x-on:click="
                        flipped = !flipped;
                        if(flipped){
                            $refs.front.classList.add('rotate-y-180');
                            $refs.back.classList.remove('-rotate-y-180');
                            $refs.back.classList.add('rotate-y-0');
                        }
                        else {
                            $refs.front.classList.remove('rotate-y-180');
                            $refs.back.classList.add('-rotate-y-180');
                            $refs.back.classList.remove('rotate-y-0');
                        }
                    "
                            >
                                <div class="flip-div inline-block relative w-full group" style="@if(empty($bonus['bigCard'])) padding-bottom: 133%; @else padding-bottom: 103%; @endif perspective: 1000px;">
                                    <div class="text-center w-full h-full absolute cursor-pointer" style="transform-style: preserve-3d;">
                                        <div
                                            x-ref="front"
                                            class="border-2 border-musora front absolute z-20 overflow-hidden rounded-xl w-full h-full transition-transform duration-700"
                                            style="@if(!empty($bonus['special'])) overflow: visible;border-color: #cda880; @endif backface-visibility: hidden;">
                                            @if(!empty($bonus['badge']))
                                                <h6 class="absolute text-white top-0 left-0 w-full py-0.5 bg-{{ $theme }} font-bebas uppercase">{{ $bonus['badge'] }}</h6>
                                            @endif
                                            <div class="overflow-hidden h-full w-full bg-black bg-top bg-cover"
                                                :class="{'opacity-0': !lazyLoad, 'opacity-100': lazyLoad}"
                                                x-intersect.once="lazyLoad = true">
                                                <picture class="absolute inset-0 w-full h-full object-cover">
                                                    <source srcset="{{ $bonus['image'] }}"
                                                        media="(min-width: 640px)">
                                                    <img src="{{ $bonus['image'] }}"
                                                        alt="Bonus Image"
                                                        class="w-full h-full object-cover opacity-0 transition-opacity"
                                                        loading="lazy"
                                                        onload="this.classList.remove('opacity-0')">
                                                </picture>
                                            </div>
                                            <div class="absolute z-40 text-center top-1/2 left-1/2 text-white transition-opacity duration-300 transform -translate-x-1/2 -translate-y-1/2 visible opacity-0 group-hover:opacity-100 text-shadow-2">
                                                <i class="fas fa-arrow-right text-4xl"></i><br>
                                                <p class="text-sm"><strong>DETAILS</strong></p>
                                            </div>
                                        </div>
                                        <div
                                            x-ref="back"
                                            class="back border-2 border-musora absolute z-40 overflow-hidden rounded-xl w-full h-full transition-transform duration-700 -rotate-y-180"
                                            style="backface-visibility: hidden;"
                                        >
                                            <div class="w-full h-full mx-auto text-center text-white flex flex-wrap justify-center items-center content-center p-2 md:p-3" style="background:linear-gradient(to bottom, #01050f, #021225);">
                                                <p class="leading-normal mx-auto text-sm">{!! $bonus['description'] !!}</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <p class="w-full leading-normal mt-2">
                                    @if(!empty($bonus['title']))
                                        <strong class="font-black leading-tight inline-block mb-1">{!!  $bonus['title']  !!}</strong><br>
                                    @endif
                                    <span style="text-transform:uppercase; display:inline-block;">
                            @if(!empty($bonus['price']))
                                            <s class="opacity-40">${{ $bonus['price'] }}</s>
                                        @endif
                            <strong class="text-musora">FREE</strong></span><br>
                                    <em>
                                        @if(!empty($bonus['shipping']))
                                            Free Bonus
                                        @else
                                            Online Access
                                        @endif
                                    </em>
                                </p>
                            </div>
                        @endforeach
                    </div>

                    <p class="px-2"><strong>Your annual membership will start at the end of your 30-day trial. <br class="hidden md:inline">
                            So you’ll still get the full value of your one dollar purchase.</strong></p>

                    <a class="join blue bigger my-4 md:my-5 w-full max-w-xs md:max-w-lg lg:max-w-3xl" style="padding: 20px 10px;" href="/ecommerce/add-to-cart?products[DLM-1-year]=1&products[quietpad]=1&products[Drumeo-VaterSticks]=1&products[the-drummers-toolbox-book]=1&products[SD-DIGI]=1&products[rock-drumming-masterclass-pack]=1&bonuses[drum-technique-made-easy-pack]=1&bonuses[independence-made-easy-pack]=1&bonuses[four-weeks-to-better-drum-fills]=1&bonuses[learn-songs-faster-pack]=1&locked=true&promo-code=full-time">Keep My Membership &raquo;</a>

                    <br><br class="inline-block md:hidden">
                    <a class="monthly-alt" href="/ecommerce/add-to-cart?products[DLM-1-month]=1&locked=true"><p><u><em>Or start a monthly membership for <br class="inline-block md:hidden">${{ Prices::$plusSubscriptionMonthly }}/month. (no bonuses)</em></u></p></a>
                </div>
        </section>
        <section class="content-section text-center" style="background: #0c1429;">
            <div class="container mx-auto relative z-50">
                <a class="inline-block" href="https://www.shopperapproved.com/reviews/Musora.com" target="_blank" onclick="window.open('https://www.shopperapproved.com/reviews/Musora.com', 'newwindow', 'width=750, height=550'); return false;">
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
@stop
