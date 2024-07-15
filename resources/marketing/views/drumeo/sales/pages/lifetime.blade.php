@extends('drumeo._partials.global-layout')

@section('global-head')
    <title>Lifetime Membership | Drumeo</title>
    <meta property="og:title" content="Lifetime Membership | Drumeo">
    <meta property="og:url" content="https://www.drumeo.com/{{ Request::path() }}">

    <meta name="description" content="Drum lessons for LIFE.">
    <meta property="og:description" content="Drum lessons for LIFE.">
    <meta property="og:image" content="https://dpwjbsxqtam5n.cloudfront.net/promos/november/lifetime-fb-share-image.jpg" style="display: none;">

    <link rel="stylesheet" href="{{ mix('marketing/css/app.css') }}">
    <link href="{{ asset('/marketing/parcel/drumeo/navigation-sales.css') }}" rel="stylesheet">
    <link href="{{ asset('/marketing/css/tailwind-helpers.css') }}" rel="stylesheet">
    <link href="{{ asset('/marketing/parcel/drumeo/sales-2020.css') }}" rel="stylesheet">
@stop

@section('body-data')
    x-data ='{
    trailer : false,
    lazyLoad: false,
    }'
@endsection

@section('global-body')
    @include("drumeo.sales.partials._nav", [
    "cartVersion" => true
    ])

    @php
        if(!empty($products['DLM-Lifetime']->getPublicStockCount())) {
            $stock = $products['DLM-Lifetime']->getPublicStockCount();
        }
        else {
            $stock = 0;
        }
    @endphp
{{--    @include('_partials.components.shop.promo-banner', [--}}
{{--        "name" => "Lifetime",--}}
{{--        "fullPrice" => 1200,--}}
{{--        "price" => 1200,--}}
{{--        "specialText" => "<strong>Only <s class='opacity-60'>500</s> <span class='text-promo'>" . $stock . "</span> left!</strong>",--}}
{{--        "noBreadcrumb" => true,--}}
{{--                "noCountdown" => true--}}
{{--    ])--}}

    <section class="px-5 py-10 md:py-14 lg:py-16 text-white text-center" style="background:linear-gradient(to bottom, #094073 50%, #000C16);">
        <div class="container mx-auto">
            <h1 class="leading-none"><strong>Get drum lessons<br class="sm:hidden"> for <span class="text-musora">life.</span></strong></h1>
            <h3 class="leading-tight mt-3 text-white uppercase">
                @if($stock > 0)

                    <!-- <span x-cloak x-data="timer()" x-init="countdown()">
                             <span x-cloak x-show="timeLeft > 0 && day > 0"><span x-text="day"></span><span x-text="dayText"></span></span>
                             <span x-cloak x-show="timeLeft > 0 && hour > 0"><span x-text="hour"></span><span x-text="hourText"></span></span>
                             <span x-cloak x-show="timeLeft > 0"><span x-text="minute"></span><span x-text="minuteText"></span></span>
                             <span x-cloak x-show="timeLeft > 0 && day < 7"><span x-text="second"></span><span x-text="secondText"></span></span>
                             <span x-cloak x-show="timeLeft < 0">A Limited Time</span>
                         </span> -->

                    <strong>Only <s>100</s> <span class='text-musora'> {{ $products['DLM-Lifetime']->getPublicStockCount()}}  </span> left!</strong>

                @else
                    &nbsp;
                @endif
            </h3>
            <div class="w-full mx-auto my-4 sm:my-8 " style="max-width:920px;">
                <div class="aspect-16:9 w-full relative rounded-xl overflow-hidden">
                    <iframe class="absolute w-full h-full reset-on-close" src="//player.vimeo.com/video/918163289" frameborder="0" allowfullscreen allow="autoplay" title="Lifetime Video"></iframe>
                </div>
            </div>
            <div class="px-3 mx-auto w-full max-w-2xl">
                <h2 class="leading-none mb-1"><strong>$1200</strong></h2>
                <p class="leading-tight text-sm"><em>Payment plans available.</em></p>
{{--                @if($stock > 0)--}}
{{--                    <a class="join drumeo mt-4 w-full anchor-slide" href="#customize-anchor">GET STARTED &raquo;</a>--}}
{{--                @else--}}
                    <a class="join sold-out mt-4 w-full anchor-slide" href="#customize-anchor">SOLD OUT</a>
{{--                @endif--}}
            </div>
        </div>
    </section>

    <section class="text-center px-3 sm:px-5 py-10 md:py-14 lg:py-16 px-2 md:px-4 relative overflow-hidden">
        <div class="container mx-auto max-w-4xl z-10 relative">
            <h2 class="leading-tight mb-2"><strong>The Lifetime Advantage</strong></h2>
            <p class="leading-tight mb-5"><em>You’ll have a lifetime of unlimited drum lessons for the <br class="hidden sm:inline lg:hidden"> price of 5 years of access to Drumeo ($1200 total).</em></p>
            <img class="hidden sm:inline-block w-full max-w-3xl mb-10" src="https://d21q7xesnoiieh.cloudfront.net/fit-in/1500x0/filters:quality(95)/marketing/drumeo/promos/november/bundles/timeline.png">
            <img class="sm:hidden inline-block w-full max-w-3xl mb-10" src="https://d21q7xesnoiieh.cloudfront.net/fit-in/800x0/filters:quality(95)/marketing/drumeo/promos/november/bundles/timeline-m.png">
            <p class="text-left leading-relaxed">
                <em>“My soul is that of a drummer. I didn’t do it to become rich and famous. I did it because it was the love of my life.” – Ringo Starr</em>
                <br><br>
                If you feel like Ringo, we want to invite you to make a lifelong commitment to your drumming.
                <br><br>
                Lifetime Memberships are back to celebrate 12 years of Drumeo.
                <br><br>
                This is your chance to make one final payment for your Drumeo Membership and then enjoy unlimited drum lessons, song breakdowns, and LIVE events with your favorite drummers for years to come.
                <br><br>
                <strong class="bg-musora">And heads up: You can split the payment for 3 installments. (You’ll see that option at the bottom of the page.)</strong>
<br><br>
                You’ll also get a $300 credit to buy anything in the Musora Store (sticks, headphones, books… anything!).
<br><br>
                PLUS you’ll get an exclusive Lifetime Members ONLY Masterclass with Gregg Bissonette.
<br><br>
                Scroll down to see everything included with your Drumeo Lifetime Membership and we’ll see you with your little infinity badge around your name very soon!

            </p>
        </div>
    </section>
    <section class="text-white text-center px-4 sm:px-6 py-8 sm:py-0 px-2 sm:px-4 relative" style="background:linear-gradient(to bottom, #0B76DB, #083661);">
        <div class="container mx-auto max-w-5xl z-10 relative">
            <div class="flex flex-wrap sm:flex-nowrap justify-center items-center">
                <img class="w-52 sm:w-72 lg:w-96 mb-4 sm:-my-6 lg:-my-8 sm:order-1 transition-opacity cursor-pointer autoplay-video" x-on:click="trailer = true;"
                    loading="lazy" onload="this.classList.remove('opacity-0')"
                    src="https://d21q7xesnoiieh.cloudfront.net/fit-in/800x0/filters:quality(95)/marketing/drumeo/promos/march/lifetime/livestream-phone.webp" alt="screen">
                <div class="flex-grow sm:pr-7 text-center sm:text-left sm:py-8 lg:py-8">
                    <h2 class="leading-tight"><strong>Improve Your Tempo, Dynamics and Musicianship with Gregg Bissonette</strong></h2>
                    <h6 class="leading-relaxed my-4 sm:my-6">Join Gregg Bissonette in an exclusive Lifetime Masterclass to help you become the most musical and versatile drummer you can be.</h6>
                    <div class="align-middle">
                        <div class="inline-block align-middle bg-white text-center rounded-lg overflow-hidden w-11 mr-2">
                            <p class="leading-none tracking-tighter text-xs py-0.5 text-white bg-drumeo"><strong>APR</strong></p>
                            <p class="leading-none text-lg py-1 text-black"><strong class="font-black">6</strong></p>
                        </div>
                        <p class="inline-block align-middle"><strong>Your Masterclass will be held on April 6, 2024.<br> (Time TBD – you’ll receive an email with confirmation)</strong></p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="text-center px-3 sm:px-5 py-10 md:py-14 lg:py-16 px-2 md:px-4 relative" style="background:#f6f8fc;">
        <div class="container mx-auto max-w-4xl z-10 relative">
            <h6 class="text-left leading-tight"><em>
                <strong>A note from Gregg:</strong>
                <br><br>
                “Be a musical drummer!
                <br><br>
                Concentrate on keeping the tempo and the groove for the whole song, and play dynamically.
                <br><br>
                Learn to play big band, Latin, funk, Afro-Cuban, hip-hop, R&B, play with brushes, in small groups, large groups, small or large venues, all ages and all kinds of styles and approaches.
                <br><br>
                Remember, it’s not all about playing drum solos, it’s about making a joyful noise!”</em>
            </h6>
        </div>
    </section>

    @php
    if($stock == 123) {
        $bonuses = [
            [
                'image' => 'https://d21q7xesnoiieh.cloudfront.net/fit-in/850x0/filters:quality(95)/marketing/drumeo/promos/march/lifetime/gregg-bissonette-masterclass-card.webp',
                'description' => 'A Live Masterclass With Gregg Bissonette',
            ],
            [
                'image' => 'https://d21q7xesnoiieh.cloudfront.net/fit-in/850x0/filters:quality(95)/marketing/drumeo/promos/march/lifetime/drumsticks-card.webp',
                'description' => '12 Pairs Of Drumsticks',
                'price' => 155.40,
                'shipping' => true,
            ],
        ];
        $buttonLink = '/ecommerce/add-to-cart?products[DLM-Lifetime]=1&products[Drumeo-VaterSticks]=12&locked=true';
        $buttonLink2 = '/ecommerce/add-to-cart?products[DLM-Lifetime-3-pay]=1&products[Drumeo-VaterSticks]=12&locked=true';
    }
    else {
        $bonuses = [
            [
                'image' => 'https://d21q7xesnoiieh.cloudfront.net/fit-in/850x0/filters:quality(95)/marketing/drumeo/promos/march/lifetime/gregg-bissonette-masterclass-card.webp',
                'description' => 'A Live Masterclass With Gregg Bissonette',
            ],
            [
                'image' => 'https://d21q7xesnoiieh.cloudfront.net/fit-in/850x0/filters:quality(95)/marketing/drumeo/promos/march/lifetime/drumshop-credit-card.webp',
                'description' => '$300 Credit To The Drumeo DrumShop',
                'price' => 300,
            ],
        ];
        $buttonLink = '/ecommerce/add-to-cart?products[DLM-Lifetime]=1&products[drumeo-gift-card-300]=1&locked=true';
        $buttonLink2 = '/ecommerce/add-to-cart?products[DLM-Lifetime-3-pay]=1&products[drumeo-gift-card-300]=1&promo-code=lifetime-gift-card&locked=true';
    }
    @endphp

    <div id="customize-anchor" class="anchor anchor-slide"></div>
    <section class="py-14 sm:py-20 lg:py-24 relative overflow-hidden text-white text-center customize px-4 lg:px-6"
        style="background:linear-gradient(to bottom, #094073, #000C16);"
    >
        <div class="container mx-auto relative z-50 max-w-4xl">
            <h3 class="leading-tight" style="line-height: 1.4em;"><strong>Become a Lifetime Member<br class="sm:hidden"> today and get:</strong></h3>
            <h6 class="leading-tight mt-3 mb-5 md:mb-7 lg:mb-10 text-musora uppercase">
{{--                @if($stock > 0)--}}
{{--                    Only--}}
{{--                        <span x-cloak x-data="timer()" x-init="countdown()">--}}
{{--                             <span x-cloak x-show="timeLeft > 0 && day > 0"><span x-text="day"></span><span x-text="dayText"></span></span>--}}
{{--                             <span x-cloak x-show="timeLeft > 0 && hour > 0"><span x-text="hour"></span><span x-text="hourText"></span></span>--}}
{{--                             <span x-cloak x-show="timeLeft > 0"><span x-text="minute"></span><span x-text="minuteText"></span></span>--}}
{{--                             <span x-cloak x-show="timeLeft > 0 && day < 7"><span x-text="second"></span><span x-text="secondText"></span></span>--}}
{{--                             <span x-cloak x-show="timeLeft < 0">A Limited Time</span>--}}
{{--                         </span>--}}
{{--                    left--}}
{{--                @else--}}
{{--                    &nbsp;--}}
{{--                @endif--}}
            </h6>
            <div class="w-full">
                <div class="bonus-wrap relative inline-block align-top mx-auto px-1 md:px-3 w-full max-w-md">
                    <div class=" inline-block relative w-full group" style="padding-bottom: 56%;perspective: 1000px;">
                        <div class="text-center w-full h-full absolute" style="transform-style: preserve-3d;">
                            <div class=" {{--border-2 border-musora--}} front absolute z-20 overflow-hidden rounded-3xl w-full h-full transition-transform duration-700" style="backface-visibility: hidden;">
                                <div class="h-full w-full bg-center bg-cover" style="background-image:url('https://d21q7xesnoiieh.cloudfront.net/fit-in/850x0/filters:quality(95)/marketing/drumeo/promos/march/lifetime/lifetime-membership2.webp');"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <br>
                <h2 class="leading-tight mt-4 sm:mt-6 mb-1">
                    @if(!empty($upgradeVersion))
                        <s class="opacity-60">$1200</s> <strong>$960</strong>
                    @else
                        <strong>$1200</strong>
                    @endif
                </h2>
                <p class="leading-tight text-sm">Payment plans available</p>
{{--                @if($stock > 0)--}}
{{--                    <a class="join drumeo mt-4 md:mt-5 w-full max-w-xs md:max-w-lg lg:max-w-xl" style="padding: 15px 10px;" href="{{ $buttonLink }}">GET Started &raquo;</a>--}}
{{--                @else--}}
                    <span class="join sold-out mt-4 md:mt-5 w-full max-w-xs md:max-w-lg lg:max-w-xl" style="padding: 15px 10px;">SOLD OUT</span>
{{--                @endif--}}
                <h3 class="leading-tight mt-8 sm:mt-12 mb-5 sm:mb-9"><strong>+ get these FREE<br class="sm:hidden"> anniversary bonuses</strong></h3>
            </div>
            <div style="font-size:0px" class=" max-w-md mx-auto">
                @foreach($bonuses as $bonus)
                    <div
                        class="bonus-wrap relative inline-block align-top mx-auto mb-4 px-1 sm:px-3 w-1/2"
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
                                        <h6 class="absolute text-black top-0 left-0 w-full py-0.5 bg-musora font-bebas uppercase">{{ $bonus['badge'] }}</h6>
                                    @endif
                                    <div class="overflow-hidden h-full w-full bg-black bg-top bg-cover" style="background-image:url('https://www.musora.com/musora-cdn/image/width=460,quality=95/{{ $bonus['image'] }}');"></div>
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
                        <span style="text-transform:uppercase; display:inline-block;">
                            @if(!empty($bonus['price']))
                                <s class="opacity-40">${{ $bonus['price'] }}</s>
                            @endif
                            <strong class="text-musora">FREE</strong></span><br>
                            <em>
                                @if(!empty($bonus['shipping']))
                                    Free Shipping
                                @else
                                    Online Access
                                @endif
                                @if(!empty($bonus['delayshipping']))
                                    <br><u class="text-xs"> Shipping will be delayed</u>
                                @endif
                            </em>
                        </p>
                    </div>
                @endforeach
            </div>

{{--            @if($stock > 0)--}}
{{--                <a class="join drumeo my-4 md:my-5 w-full max-w-xs md:max-w-lg lg:max-w-3xl" style="padding: 20px 10px;" href="{{ $buttonLink }}">GET Started &raquo;</a>--}}
{{--                <a class="inline-block leading-tight text-white" href="{{ $buttonLink2 }}"><em><u>Prefer a payment plan? Click here to order with 3 monthly payments.</u></em></a>--}}
{{--            @else--}}
                <a class="join sold-out my-4 md:my-5 w-full max-w-xs md:max-w-lg lg:max-w-3xl" style="padding: 20px 10px;">SOLD OUT</a>
{{--            @endif--}}
        </div>
    </section>
    @php
        $faqs = [
            [
                "title" => "How long does my lifetime membership last?",
                "desc" => 'Simply, for life! Either yours or ours. Your Lifetime Membership is valid as long as Drumeo (Musora) remains in service and you stay alive.',
            ],
            [
                "title" => "What happens if Drumeo or Musora’s service ends?",
                "desc" => 'We’ll make every effort to provide Lifetime Members with all the original media content we have created available for download. That way, you can continue to enjoy everything we’ve done.<br><br>This will cover all available Musora original content (our entire curriculum and courses) but will not include and 3rd party content that we do not own rights to.',
            ],
            [
                "title" => "What content is included with my Lifetime Membership? Are songs included?",
                "desc" => 'As a Drumeo Lifetime Member, you get access to all original Musora content for life and our entire library of 6000+ drum transcriptions. That’s all our courses, the Method, Live lessons, Student Reviews, and Songs.<br><br>Some of our content is licensed by 3rd parties, which means we have to pay a fee for each member to use the material on a temporary basis. This includes song transcriptions for our other instruments (Piano, Guitar, Vocals).<br><br>If all you want to play is drums, then you have everything. But if you’re interested in learning songs for other instruments, there is a small fee for ongoing access because these songs are licensed. <br><br>We wish it wasn’t the case and have done our best to make the fee as small as possible. Currently, the fee is $40/year for Lifetime Members.<br><br>But again, this does NOT apply to drum transcriptions.',
            ],
        ]
    @endphp

    <section class="py-12 md:py-20" style="background-color:#01050f;">
        <div class="container mx-auto max-w-5xl px-6">
            <h2 class="font-extrabold mb-10 text-center text-white">Frequently Asked Questions</h2>
            @foreach($faqs as $faq)
                @include('_partials.components.question-dropdown', [
                    'num' => '?',
                    "title" => $faq['title'],
                    "desc" => $faq['desc'],
                ])
            @endforeach
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

    @include('_partials.components.video-modal',[
        'name' => 'trailer',
        'video' => '917719282',
        'vimeo' => true,
        'styles' => 'pb-[177%] sm:pb-[66vh] bg-white',
    ])

    @include("drumeo.sales.partials._footer")

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script type="text/javascript" src="{{ asset('/marketing/parcel/drumeo/navigation-sales.js') }}"></script>
    <script src="{{ mix('/platform/js/manifest.js') }}"></script>
    <script src="{{ mix('/platform/js/vendor.js') }}"></script>
    <script src="{{ mix('/platform/js/app.js') }}"></script>
    <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/lazysizes/5.3.2/lazysizes.min.js"></script>
    <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/lazysizes/5.3.2/plugins/unveilhooks/ls.unveilhooks.min.js"></script>
@stop
