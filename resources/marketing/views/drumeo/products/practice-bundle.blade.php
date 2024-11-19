@php
    require_once(resource_path('marketing/views/drumeo/_partials/homepage-data.php'));
    require_once(resource_path('marketing/views/drumeo/_partials/bonus-data.php'));
@endphp

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
    x-data="{
    trailer : false,
    lazyLoad: false,
    @foreach($bonusVideos as $bonusVideo)
        @if(!empty($bonusVideo['vimeoId']))
            modal{{ $bonusVideo['vimeoId'] }}: false,
        @endif
    @endforeach
    }"
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
    @php
        $targetSkus = ['alesis-nitro-max-e-kit', 'DLM-1-year', '30-day-drummer-4', '30-day-double-bass', '30-day-jazz', '30-day-chops'];
    @endphp

    <section class="pt-8 pb-16 sm:py-16 lg:py-20 px-4 sm:px-6 bg-[#F4F8FB]">
        <div class="container mx-auto max-w-5xl">

            @include('drumeo._partials.bf-bonus-section', [
            'targetSkus' => $targetSkus,
            ])

            <div class="bg-[#CFEBFF] px-4 py-4 md:py-8 md:px-16 rounded-lg my-10 md:my-16">
                <div class="flex items-start gap-3 max-w-4xl md:pr-8">
                    <div class="flex-shrink-0">
                        <i class="fa-solid fa-circle-exclamation text-xl"></i>
                    </div>
                    <div class="text-sm">
                        <span class="font-semibold">Disclaimer:</span>
                        This bundle is ONLY available as a full-bundle. None of the discounted items can be purchased at that
                        discounted price, on their own, and any refunds must be processed with the full bundle refunded and returned at the same
                        time. (Ex. You cannot purchase this bundle and request a refund on just the membership.)
                    </div>
                </div>
            </div>
        </div>
    </section>




    @include('musora.sales.components.guarantee-section', [
        'badge' => 'marketing/drumeo/membership/homepage/2024/guarantee.webp',
        'header' => '<strong>Happy student guarantee.</strong><br>Test-drive your lessons for 90 days. Zero risk.',
        'desc' => 'Online lessons can be intimidating. Maybe you’re wondering if they work, or if you’ll use them enough – or if you’ll even enjoy the experience. So we’re removing the risk with our 90-day guarantee. More than anything, we want to make sure you have a POSITIVE experience developing new skills and gaining confidence on the drums.',
    ])
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
                @php
                    $targetSkus = ['30-day-drummer-4', '30-day-independence', '30-day-double-bass', '30-day-jazz', '30-day-chops'];

                    $filteredBonuses = collect($bonuses)->filter(function ($bonus) use ($targetSkus) {
                        return in_array($bonus['sku'], $targetSkus, true);
                    })->values();
                @endphp
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
                                    Free Bonus
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
                "desc" => 'As a Drumeo Lifetime Member, you get access to all original Musora content for life and our entire library of drum transcriptions. That’s all our courses, the Method, Live lessons, Student Reviews, and Songs.<br><br>Some of our content is licensed by 3rd parties, which means we have to pay a fee for each member to use the material on a temporary basis. This includes song transcriptions for our other instruments (Piano, Guitar, Vocals).<br><br>If all you want to play is drums, then you have everything. But if you’re interested in learning songs for other instruments, there is a small fee for ongoing access because these songs are licensed. <br><br>We wish it wasn’t the case and have done our best to make the fee as small as possible. Currently, the fee is $40/year for Lifetime Members.<br><br>But again, this does NOT apply to drum transcriptions.',
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
