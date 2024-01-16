@extends('drumeo._partials.global-layout')

@section('global-head')
    <title>Lifetime Membership | Drumeo</title>
    <meta property="og:title" content="Lifetime Membership | Drumeo">
    <meta property="og:url" content="https://www.drumeo.com/{{ Request::path() }}">

    <meta name="description" content="Drum lessons for LIFE. (+20 FREE bonuses)">
    <meta property="og:description" content="Drum lessons for LIFE. (+20 FREE bonuses)">
    <meta property="og:image" content="https://dpwjbsxqtam5n.cloudfront.net/promos/november/lifetime-fb-share-image.jpg" style="display: none;">

    <link rel="stylesheet" href="{{ mix('marketing/css/app.css') }}">
    <link href="{{ asset('/marketing/parcel/drumeo/navigation-sales.css') }}" rel="stylesheet">
    <link href="{{ asset('/marketing/parcel/drumeo/sales-2020.css') }}" rel="stylesheet">
@stop

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
            <h1 class="leading-none"><strong>A <span class="text-musora">Lifetime</span> Of Drum Lessons </strong></h1>
            <h4 class="leading-tight">(plus your choice of sticks, in-ears, or a stick bag!)</h4>
            <div class="w-full mx-auto my-4 sm:my-8 " style="max-width:920px;">
                <div class="aspect-16:9 w-full relative rounded-xl overflow-hidden">
                    <iframe class="absolute w-full h-full reset-on-close" src="//player.vimeo.com/video/885338480" frameborder="0" allowfullscreen allow="autoplay" title="Lifetime Video"></iframe>
                </div>
            </div>
            <div class="px-3 mx-auto w-full max-w-2xl">
                <h2 class="leading-none mb-1">
                    @if(!empty($upgradeVersion))
                        <s class="opacity-60">$1200</s> <strong>$960</strong>
                    @else
                        <strong>$1200</strong>
                    @endif
                </h2>
                <p class="leading-tight text-sm"><em>One time payment or choose a <br class="sm:hidden">
                        payment plan below.</em></p>
{{--                <a class="join drumeo mt-4 w-full anchor-slide" href="#customize-anchor">GET STARTED &raquo;</a>--}}
                <a class="join sold-out mt-4 w-full anchor-slide" href="#customize-anchor">SOLD OUT</a>
{{--                <p class="mt-4 leading-tight text-musora font-black">ONLY <s class='opacity-60'>500</s>  {{ $stock }} SPOTS AVAILABLE</p>--}}
            </div>
        </div>
    </section>

    <section class="text-center px-3 sm:px-5 py-10 md:py-14 lg:py-16 px-2 md:px-4 relative overflow-hidden">
        <div class="container mx-auto max-w-5xl z-10 relative">
            <h2 class="leading-tight mb-2"><strong>The Lifetime Advantage</strong></h2>
            <p class="leading-tight mb-5"><em>You’ll have a lifetime of unlimited drum lessons for the <br class="hidden sm:inline lg:hidden"> price of 5 years of access to Drumeo ($1200 total).</em></p>
            <img class="hidden sm:inline-block w-full max-w-3xl mb-10" src="https://d21q7xesnoiieh.cloudfront.net/fit-in/1500x0/filters:quality(95)/marketing/drumeo/promos/november/bundles/timeline.png">
            <img class="sm:hidden inline-block w-full max-w-3xl mb-10" src="https://d21q7xesnoiieh.cloudfront.net/fit-in/800x0/filters:quality(95)/marketing/drumeo/promos/november/bundles/timeline-m.png">
            <div class="flex flex-wrap sm:flex-nowrap items-start justify-center">
                <div class="order-1 sm:order-0 text-left sm:pr-5 lg:pr-7">
                    <p class="leading-relaxed">
                        <em>“My soul is that of a drummer. I didn’t do it to become rich and famous. I did it because it was the love of my life.” – Ringo Starr</em>
                        <br><br>
                        If you feel like Ringo, we want to invite you to make a lifelong commitment to your drumming.
                        <br><br>
                        Drumeo Lifetime Memberships are back – for Black Friday ONLY!
                        <br><br>
                        This is your chance to make one final payment for your Drumeo Membership and then enjoy unlimited drum lessons, song breakdowns, and LIVE events with your favorite drummers for years to come.
                        <br><br>
                        <span class="bg-musora"><strong>And heads up:</strong> You can split the payment for 3 installments. (You’ll see that option at the bottom of the page.)</span>
                        <br><br>
                        You’ll also get to a free bonus of your choice: A brick of drumsticks, Drumeo EarDrums, OR the all new Drumeo StickBag.
                        <br><br>
                        Scroll down to see everything included with your Drumeo Lifetime Membership and we’ll see you with your little infinity badge around your name very soon!
                    </p>
                </div>
                <img
                    class="mb-4 sm:mb-0 order-0 sm:order-1 h-56 lg:h-72 rounded-xl transition-opacity opacity-0"
                    src="https://d21q7xesnoiieh.cloudfront.net/fit-in/800x0/filters:quality(95)/marketing/drumeo/promos/november/bundles/lifetime-bundle-spread2.png"
                    alt="Anika"
                    loading="lazy"
                    onload="this.classList.remove('opacity-0')"
                >
            </div>
        </div>
    </section>
    <div id="customize-anchor" class="anchor anchor-slide"></div>
    <section class="py-10 md:py-14 lg:py-16 text-white text-center text-center relative z-50"
        style="background:linear-gradient(to bottom, #094073 50%, #000C16);"
        x-data="{
            bonus: 0,
            query: '',
        }"
    >
        <div class="container mx-auto relative z-50">
            <div class="mx-auto max-w-xs sm:max-w-md md:max-w-2xl lg:max-w-3xl mb-4" style="font-size: 0;">
                <h3 class="mb-3" style="line-height: 1.4em;"><strong>Become a Lifetime Member<br class="inline sm:hidden"> today and get:</strong></h3>
                <div class="text-center mb-7"><p class="inline-block uppercase text-black bg-[#FFA800] py-1 px-4 font-black rounded-lg">Your choice of any bonus item:</p></div>

                <hr class="opacity-0">
                @php
                    $bonuses = [
                        [
                            'image' => 'https://d1fyshwdvi6fth.cloudfront.net/Drumeo/Thumbnails/508daf15-2a10-4dfa-a11f-1ebdfb614cfb-2023-02-15-Drumeo-EarDrums-Updated-100-Square+(1).jpg',
                            'sku' => '&products[drumeo-eardrums]=1',
                        ],
                        [
                            'image' => 'https://d1fyshwdvi6fth.cloudfront.net/Drumeo/Thumbnails/e36ad306-8ba6-4db5-99bc-bd955080a57a-2023-06-21-Vater-Sticks-101-White-Backdrop+(1).jpg',
                            'badge' => '12 Pairs',
                            'sku' => '&products[Drumeo-VaterSticks]=12',
                        ],
                        [
                            'image' => 'https://drumeo-assets.s3.amazonaws.com/drum-shop/stickbag/stickbag-cart-image.jpg',
                            'sku' => '&products[stickbag]=1',
                        ],
                    ]
                @endphp
                @foreach($bonuses as $bonus)
                    <div
                        class="bonus-wrap relative inline-block align-top mx-auto mb-4 px-1 md:px-3 w-1/2 md:w-1/4"
                        x-data="{
                            selected: false,
                        }"
                        x-on:click="
                            if(bonus <= 1 && selected){
                                selected = !selected;
                                query = query.replace('{{ $bonus['sku'] }}', '');
                                bonus--;
                            } else if(bonus < 1 && !selected) {
                                selected = !selected;
                                bonus++;
                                query = query + '{{ $bonus['sku'] }}';
                            }
                        "
                    >
                        <div class="flip-div inline-block relative w-full group" style="@if(empty($bonus['bigCard'])) padding-bottom: 115%; @else padding-bottom: 103%; @endif perspective: 1000px;">
                            <div class="text-center w-full h-full absolute cursor-pointer" style="transform-style: preserve-3d;">
                                <div
                                    x-ref="front"
                                    class="border-musora front absolute rounded-xl overflow-hidden w-full h-full transition-transform duration-700"
                                    :class="selected ? 'border-4' : !selected && bonus !== 1 && 'hover:border-2'"
                                    style="@if(!empty($bonus['special'])) overflow: visible;border-color: #cda880; @endif backface-visibility: hidden;">
                                    <h6 class="absolute bg-black text-white top-0 right-0 px-1.5 py-1 my-0.5 mx-0.5 bg-black rounded-full opacity-0 border-2 border-white z-30"
                                        :class="selected && bonus === 1 && 'opacity-100'"
                                    ><i class="fas fa-times"></i></h6>
                                @if(!empty($bonus['badge']))
                                        <h6 class="absolute text-white top-0 left-0 w-full pt-1 bg-{{ $theme }} font-bebas uppercase z-20"
                                            :class="!selected && bonus === 1 && 'grayscale'"
                                        >{{ $bonus['badge'] }}</h6>
                                    @endif
                                    <div
                                        class="h-full w-full bg-black bg-bottom bg-cover z-10"
                                        style="background-image:url('https://www.musora.com/musora-cdn/image/width=460,quality=95/{{ $bonus['image'] }}');"
                                        :class="!selected && bonus === 1 && 'grayscale'"
                                    ></div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <h2 class="leading-none mb-1">
                @if(!empty($upgradeVersion))
                    <s class="opacity-60">$1200</s> <strong>$960</strong>
                @else
                    <strong>$1200</strong>
                @endif
            </h2>
            <p class="leading-tight text-sm"><em>One time payment.</em></p>
            <a class="join sold-out bigger mt-5 w-full max-w-xs md:max-w-lg lg:max-w-3xl" style="padding: 20px 10px;">SOLD OUT</a>
{{--            @if(!empty($upgradeVersion))--}}
{{--                <a--}}
{{--                    class="join blue bigger mt-5 w-full max-w-xs md:max-w-lg lg:max-w-3xl" style="padding: 20px 10px;"--}}
{{--                    :class="bonus !== 1 && 'sold-out'"--}}
{{--                    :href="bonus === 1 ? '/ecommerce/add-to-cart?products[DLM-Lifetime]=1&products[musora-access-1-year]=1'+query+'&promo-code=FREE-W-LIFETIME-849,lifetime-existing&locked=true' : '/ecommerce/add-to-cart?products[DLM-Lifetime]=1&products[musora-access-1-year]=1&products[drumeo-eardrums]=1&promo-code=FREE-W-LIFETIME-849,lifetime-existing&locked=true'"--}}
{{--                    x-text="bonus === 1 ? 'GET STARTED &raquo;' : 'Choose a bonus above'"></a>--}}
{{--                <br>--}}
{{--                <a class="inline-block text-white leading-tight mt-3"--}}
{{--                    :class="bonus !== 1 && 'opacity-50'"--}}
{{--                    :href="bonus === 1 ? '/ecommerce/add-to-cart?products[DLM-Lifetime-3-pay]=1&products[musora-access-1-year]=1'+query+'&promo-code=FREE-W-LIFETIME-849,lifetime-existing&locked=true' : '/ecommerce/add-to-cart?products[DLM-Lifetime-3-pay]=1&products[musora-access-1-year]=1&products[drumeo-eardrums]=1&promo-code=FREE-W-LIFETIME-849,lifetime-existing&locked=true'"--}}
{{--                ><em><u>Prefer a payment plan? Click here to order with 3 monthly payments.</u></em></a>--}}
{{--            @else--}}
{{--                <a--}}
{{--                    class="join blue bigger mt-5 w-full max-w-xs md:max-w-lg lg:max-w-3xl" style="padding: 20px 10px;"--}}
{{--                    :class="bonus !== 1 && 'sold-out'"--}}
{{--                    :href="bonus === 1 ? '/ecommerce/add-to-cart?products[DLM-Lifetime]=1&products[musora-access-1-year]=1'+query+'&promo-code=FREE-W-LIFETIME-849&locked=true' : '/ecommerce/add-to-cart?products[DLM-Lifetime]=1&products[musora-access-1-year]=1&products[drumeo-eardrums]=1&promo-code=FREE-W-LIFETIME-849&locked=true'"--}}
{{--                    x-text="bonus === 1 ? 'GET STARTED &raquo;' : 'Choose a bonus above'"></a>--}}
{{--                <br>--}}
{{--                <a class="inline-block text-white leading-tight mt-3"--}}
{{--                    :class="bonus !== 1 && 'opacity-50'"--}}
{{--                    :href="bonus === 1 ? '/ecommerce/add-to-cart?products[DLM-Lifetime-3-pay]=1&products[musora-access-1-year]=1'+query+'&promo-code=FREE-W-LIFETIME-849&locked=true' : '/ecommerce/add-to-cart?products[DLM-Lifetime-3-pay]=1&products[musora-access-1-year]=1&products[drumeo-eardrums]=1&promo-code=FREE-W-LIFETIME-849&locked=true'"--}}
{{--                ><em><u>Prefer a payment plan? Click here to order with 3 monthly payments.</u></em></a>--}}
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
                <img alt="" class="h-7 md:h-12 lg:h-14 mb-2 md:mb-0 mx-auto md:mr-2 opacity-70" src="https://www.musora.com/musora-cdn/image/width=320,quality=95/https://dpwjbsxqtam5n.cloudfront.net/sales/2021/shopper-approved-logo-white.png">
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
    <script src="{{ mix('/platform/js/manifest.js') }}"></script>
    <script src="{{ mix('/platform/js/vendor.js') }}"></script>
    <script src="{{ mix('/platform/js/app.js') }}"></script>
@stop
