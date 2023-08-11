@extends('singeo._partials.global-layout')

@section('global-head')
    <title>The Lifetime Bundle | Singeo</title>
    <meta property="og:title" content="The Lifetime Bundle">

    <meta name="description" content="With the LIFETIME bundle, you'll get everything you need to pursue and develop your skills on the guitar.">
    <meta property="og:description" content="With the LIFETIME bundle, you'll get everything you need to pursue and develop your skills on the guitar.">
    <meta property="og:image" content="https://d21xeg6s76swyd.cloudfront.net/sales/promos/august/lifetime_bundle.jpg" style="display: none;">
    <meta property="og:url" content="https://www.singeo.com/{{ Request::path() }}">

    @include('_partials.layout._tailwindcdn')
    <link rel="stylesheet" href="{{ asset('/marketing/css/tailwind-helpers.css') }}">
    <link href="{{ asset('/marketing/parcel/drumeo/sales-page-singeo.css') }}" rel="stylesheet">
    <link href="{{ asset('/marketing/parcel/drumeo/nav-footer-singeo.css') }}" rel="stylesheet">
    <link href="{{ asset('/marketing/css/animate.css') }}" rel="stylesheet">

    <style>
        .lazyload {
            opacity: 0;
        }

        .lazyloading {
            opacity: 1;
            transition: opacity 300ms;
        }
        .online-atc.merch .join {
            background: #777;
        }
        .online-atc.merch.active .join {
            background: #8300e9;
        }
        .online-atc.merch.active .join:hover {
            background: #9c1dff;
        }
    </style>
@stop

@section('global-body')
    @include("singeo.sales.partials._nav", [
        "joinVersion" => true,
    ])

    <section class="content-section relative overflow-hidden text-white grey text-center upgrade-video-header">
        <div class="container mx-auto">
            <h1 class="uppercase font-bebas">Get a <span style="color:#FFAE00;">LIFETIME Singeo Membership</span></h1>
            <p class="font-extrabold">& GET EXCLUSIVE PRODUCTS, A PRIVATE MASTERCLASS… FOR FREE</p>
            <p class="uppercase" style="color:#FFAE00;">ONLY <s>100</s> {{ $products['singeo-lifetime-membership-access']->getStockAvailability() }} spots available</p>
            <div class="w-full mx-auto my-10 px-3" style="max-width:920px;">
                <div class="overflow-hidden relative w-full" style="padding-bottom: 56.25%;">
                    <iframe class="absolute w-full h-full inset-0" src="//player.vimeo.com/video/774399848" frameborder="0" allowfullscreen id="videoPlayer"></iframe>
                </div>
            </div>

            <p class="leading-relaxed px-3 mt-10 text-left" style="width: 100%;max-width: 700px;color:#A4AFC7;">
                <em>“I don’t sing because I’m happy. I’m happy because I sing” - William James</em>

                For some, singing isn’t just a hobby - it’s a true passion. If you’re one of those people, we want to invite you to make a lifelong commitment to your singing. <br><br>

                For only a limited time, Singeo Lifetime Memberships are back!<br><br>

                Twice, MAYBE, three times a year will you get an opportunity to become a Singeo Lifetime Member.<br><br>

                This is your chance to make one final payment for your Singeo Membership and then enjoy unlimited singing lessons, personal feedback from real vocal coaches and access to a community of other singers like you…for years to come.<br><br>

                Singeo has helped THOUSANDS of students find the singing voice they’ve always wanted. And now, they all connect and share inside the best online singing community.

            </p>
        </div>
    </section>

    <div class="h-5 sm:h-9 lg:h-10" style="background: linear-gradient(to left top, transparent calc(50% - 1px), transparent, #01050f calc(50% + 1px));"></div>
    <section class="py-12 md:py-20 text-center">
        <h4 class="font-extrabold leading-normal">Improve your singing and <br>actually HEAR the difference.</h4>
        <p class="leading-relaxed px-3 mt-6 text-left mb-10" style="width: 100%;max-width: 700px;">
            Do NOT record yourself singing on your phone!<br><br>

            So many students reach out, discouraged by never hearing an actual improvement in their voice. They do the right exercises and get the support, but when they record themselves and listen back to it, it sounds just… bad. <br><br>

            Turns out the majority of them used their phone to record themselves. <br><br>

            Phones are far from the optimal vocal improvement tool. They pick up the ambience, static, cars driving by your house, the neighbor’s kids playing in the background. Basically, everything but the nuances in your voice.<br><br>

            We want you to have ALL the tools you need to continue making vocal improvements and finally take your singing skills to the next level.<br><br>

            So you’ll be getting a complete professional home recording studio kit with your lifetime membership… <b>for FREE.</b><br><br>

            This Vocal Studio Kit includes every bit of gear you need to dive into home recording and live streaming with professional studio quality.<br><br>

            In fact, not only will you get this $399 professional kit for free with your lifetime membership, but it’s exclusive for you. This product is not available on our store, so only you and a few others will have a chance to get it.
        </p>
        <div class="max-w-5xl mx-auto grid grid-cols-1 md:grid-cols-4 gap-6 mb-6 px-4">
            <div class="overflow-hidden rounded-xl">
                <div class="text-white font-bold flex items-center justify-center h-16" style="font-size:13px; background:#170426;">Condenser studio microphone with USB interface</div>
                <img src="https://d21xeg6s76swyd.cloudfront.net/sales/lifetime/mic_giveaway.jpg" alt="giveaway 1">
            </div>
            <div class="overflow-hidden rounded-xl">
                <div class="text-white font-bold flex items-center justify-center h-16" style="font-size:13px; background:#170426;">Desktop microphone stand</div>
                <img src="https://d21xeg6s76swyd.cloudfront.net/sales/lifetime/stand_giveaway.jpg" alt="giveaway 2">
            </div>
            <div class="overflow-hidden rounded-xl">
                <div class="text-white font-bold flex items-center justify-center h-16" style="font-size:13px; background:#170426;">Nylon screen professional <br>pop filter</div>
                <img src="https://d21xeg6s76swyd.cloudfront.net/sales/lifetime/filter_giveaway.jpg" alt="giveaway 3">
            </div>
            <div class="overflow-hidden rounded-xl">
                <div class="text-white font-bold flex items-center justify-center h-16" style="font-size:13px; background:#170426;">Professional Hi-End stereo headphones</div>
                <img src="https://d21xeg6s76swyd.cloudfront.net/sales/lifetime/headphones_giveaway.jpg" alt="giveaway 4">
            </div>
        </div>
        <span class="uppercase join smaller w-40" data-open="specs">See specs</span>
    </section>

    <div class="h-5 sm:h-9 lg:h-10" style="background: linear-gradient(to left top, #040C1B calc(50% - 1px), transparent, transparent calc(50% + 1px));"></div>
    <section class="py-12 md:py-20" style="background:#040C1B;">
        <h4 class="text-white text-center font-extrabold mb-16">Chat and sing with Lisa… LIVE!</h4>
        <div class="md:flex items-center max-w-4xl mx-auto px-4">
            <div class="order-1 md:w-2/5 md:pl-10 mb-6 md:mb-0">
                <img class="w-full rounded-xl" src="https://d21xeg6s76swyd.cloudfront.net/sales/lifetime/lifetime-ui.jpg" alt="ui image">
            </div>
            <p class="md:w-3/5" style="color:#A4AFC7;">
                We’ve never done this before. <br><br>

                As an exclusive bonus for Lifetime Members, you’ll be invited to join a special LIVE call with Lisa Witt, your personal vocal coach. You’ll hang out with her, sing, and ask her all the burning questions you can think of in real time.<br><br>

                More intimate than ANY of our Bootcamps, Live Q&As or Livestreams. You’ll be able to chat face-to-face (virtually) with a small, select group.<br><br>

                This live event will ONLY be available to you and you fellow Lifetime Members.<br><br>

                We’ll pick dates and times that will accommodate almost all timezones, and the replay will be available on-demand anytime you want to watch it again.<br><br>

                We’ll announce the dates and time on January 6th.
            </p>
        </div>
    </section>

    <div id="customize-anchor" class="anchor anchor-slide"></div>
    <section class="content-section relative overflow-hidden text-white grey text-center customize" style="background: black;">
        <div class="container mx-auto">
            <h4 class="text-white font-extrabold mb-10 leading-normal">Become a Lifetime Member Today <br class="md:hidden">for $1,200 and get:</h4>
            <div class="horizontal-bonuses mx-auto mb-4 max-w-xs md:max-w-xl lg:max-w-4xl">
                <style>
                    .content-section.customize .horizontal-bonuses .bonus-wrap .flip-div.special {
                        padding-bottom: 51%;
                    }
                    @media (min-width: 768px) {
                        .content-section.customize .horizontal-bonuses .bonus-wrap .flip-div.special {
                            padding-bottom: 65%;
                        }
                    }
                </style>
                <div class="flex flex-wrap">
                    <div class="w-full">
                        <img class="px-2 md:px-3 lg:px-2 mb-6" src="https://d21xeg6s76swyd.cloudfront.net/sales/lifetime/lifetime-singeo-membership.png" alt="lifetime membership">
                    </div>
                    <div class="bonus-wrap relative inline-block align-top mx-auto mb-3 md:mb-4 px-2 md:px-3 lg:px-2 w-full md:w-1/2">
                        <div class="flip-div special">
                            <div class="flip-inner">
                                <div class="front">
                                    <div class="hover-icon"><i class="fas fa-arrow-right"></i><br>DETAILS</div>
                                    <div class="image-wrap" style="background-image:url(https://www.musora.com/musora-cdn/image/width=670,quality=95/https://d21xeg6s76swyd.cloudfront.net/sales/promos/november/lifetime-bundle-mic-card.jpg);"></div>
                                </div>
                                <div class="back">
                                    <div class="text-wrap">
                                        <p class="text-xs">CM14USB microphone, Condenser, Hi-End Stereo Headphones, Desktop Mic Stand, and Pop Filter.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <p class="uppercase" style="max-width:100%;">
                            <strong class="font-black leading-tight inline-block mb-1">EIKON STUDIO BOX THREE</strong>
                            <span class="text-promo inline-block"><s class="font-bold" style="color:#5F5F5F;">$399</s> <strong>FREE</strong></span><br>
                            Unavailable to the public
                        </p>
                    </div>
                    <div class="bonus-wrap relative inline-block align-top mx-auto mb-3 md:mb-4 px-2 md:px-3 lg:px-2 w-full md:w-1/2">
                        <div class="flip-div special">
                            <div class="flip-inner">
                                <div class="front">
                                    <div class="hover-icon"><i class="fas fa-arrow-right"></i><br>DETAILS</div>
                                    <div class="image-wrap" style="background-image:url(https://www.musora.com/musora-cdn/image/width=670,quality=95/https://d21xeg6s76swyd.cloudfront.net/sales/lifetime/lisa-witt-exclusive-card.jpg);"></div>
                                </div>
                                <div class="back">
                                    <div class="text-wrap">
                                        <p class="text-xs">You’ll be invited to join a special LIVE call with Lisa Witt, your personal vocal coach.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <p class="uppercase" style="max-width:100%;">
                            <strong class="font-black leading-tight inline-block mb-1">LISA WITT'S EXCLUSIVE MASTERCLASS</strong>
                            <span class="text-promo inline-block"><strong>FREE live event</strong></span><br>
                            Unavailable to the public
                        </p>
                    </div>
                </div>

                @php
                    $bonuses = [
                        [
                            'image' => 'https://d21xeg6s76swyd.cloudfront.net/sales/promos/november/poster2.png',
                            'title' => 'Vowel Practice Poster',
                            'badge' => 'Vowel Practice Poster',
                            'description' => 'Your new favorite practice tool - and your ticket hitting higher notes with ease and confidence.',
                            'price' => floatval($productPrices['vowel-sounds-poster']->price),
                            'online-ship' => "Free Shipping",
                        ],
                        [
                            'image' => 'https://d122ay5chh2hr5.cloudfront.net/sales/lifetime/drumeo-lifetime.jpg',
                            'title' => 'Drumeo Membership',
                            'description' => 'Get drumming lessons for LIFE with a Drumeo Lifetime Membership.',
                            'price' => 0,
                            'online-ship' => 'Lifetime access'
                        ],
                        [
                            'image' => 'https://d122ay5chh2hr5.cloudfront.net/sales/lifetime/pianote-lifetime.jpg',
                            'title' => 'Pianote Membership',
                            'description' => 'Get piano lessons for LIFE with a Pianote Lifetime Membership',
                            'price' => 0,
                            'online-ship' => 'Lifetime access'
                        ],
                        [
                            'image' => 'https://d122ay5chh2hr5.cloudfront.net/sales/lifetime/guitareo-lifetime.jpg',
                            'title' => 'Guitareo Membership',
                            'description' => 'Get guitar lessons for LIFE with a Guitareo Lifetime Membership',
                            'price' => 0,
                            'online-ship' => 'Lifetime access'
                        ],
                    ]
                @endphp
                <div class="flex flex-wrap">
                    @foreach($bonuses as $bonus)
                        <div class="bonus-wrap relative inline-block align-top mx-auto mb-3 md:mb-4 px-2 md:px-3 lg:px-2 w-1/2 md:w-1/4">
                            <div class="flip-div @if(!empty($bonus['class'])) {{ $bonus['class'] }} @endif">
                                <div class="flip-inner">
                                    <div class="front border-singeo relative overflow-hidden @if(!empty($bonus['shipping'])) {{ $bonus['shipping'] }} @endif">
                                        @if(!empty($bonus['new']))<div class="bg-promo text-white font-bebas absolute flex justify-center items-center h-6 w-full">NEW</div>@endif
                                        <div class="hover-icon"><i class="fas fa-arrow-right"></i><br>DETAILS</div>
                                        <div class="image-wrap" style="background-image:url(https://www.musora.com/musora-cdn/image/width=460,quality=95/{{ $bonus['image'] }});"></div>
                                    </div>
                                    <div class="back">
                                        <div class="text-wrap">
                                            <p class="text-xs">{!!  $bonus['description']  !!}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <p class="uppercase">
                                <strong class="font-black leading-tight inline-block mb-1">{!!  $bonus['title']  !!}</strong><br>
                                <span class="text-promo inline-block"><strong>@if($bonus['price'] > 0)<s style="color:#5F5F5F;">${{ $bonus['price'] }}</s>@endif FREE </strong></span>
                                @if(!empty($bonus['online-ship']))<br>{{ $bonus['online-ship'] }}@endif
                            </p>
                        </div>
                    @endforeach
                </div>

                {{-- <p style="max-width: 480px;color: #aaa;padding:0 15px;"><em>All digital bonuses are added to your account instantly with your membership to Singeo and they’re yours forever!</em></p> --}}
            </div>
            {{-- <div class="arrow-wrap text-promo">
                <i class="fa-light fa-chevron-down animated infinite pulse"></i>
                <i class="fa-light fa-chevron-down animated delay-1s infinite pulse"></i>
                <i class="fa-light fa-chevron-down animated delay-2s infinite pulse"></i>
            </div> --}}
            {{-- <a class="join sold-out methodcta my-4">SOLD OUT</a> --}}
            {{--                    <div class="w-full max-w-sm mx-auto">--}}
            {{--                    <select class="bundle-pick uppercase border-2 border-solid rounded-full font-bold text-xl w-full h-auto py-2 pl-7 pr-5 mb-3 bg-white md:py-2 lg:py-4" title="Shirt Size" required="" style="border-color: #717D80; color: #717D80; font-family: Roboto Condensed, sans-serif;">--}}
            {{--                        <option hidden="" value=""> Choose Shirt Size </option>--}}
            {{--                        <option value="retro-shirt-s" data-price="29" data-product-json="{&quot;retro-shirt-s&quot;: 1}">Small</option>--}}
            {{--                        <option value="retro-shirt-m" data-price="29" data-product-json="{&quot;retro-shirt-m&quot;: 1}">Medium</option>--}}
            {{--                        <option value="retro-shirt-l" data-price="29" data-product-json="{&quot;retro-shirt-l&quot;: 1}">Large</option>--}}
            {{--                        <option value="retro-shirt-xl" data-price="29" data-product-json="{&quot;retro-shirt-xl&quot;: 1}">X-Large</option>--}}
            {{--                        <option value="retro-shirt-xxl" data-price="29" data-product-json="{&quot;retro-shirt-xxl&quot;: 1}">XX-Large</option>--}}
            {{--                    </select>--}}
            {{--                    <a class=" online-atc merch vue-add-to-cart selected-pack2" href="#" data-base-url="/ecommerce/add-to-cart?redirect=/order&products[singeo-lifetime-membership-access]=1&products[vowel-sounds-poster]=1&products[wallflower-tumbler]=1&products[mouth-mug]=1&locked=true">--}}
            {{--                        <button class="tw-border-none join w-full">--}}
            {{--                            <i class="fas fa-cart-plus" aria-hidden="true"></i> Order Now--}}
            {{--                        </button>--}}
            {{--                    </a>--}}
            {{--                    </div>--}}
            {{--                    <a  class="join methodcta"--}}
            {{--                        href="/ecommerce/add-to-cart?products[singeo-lifetime-membership-access]=1&products[studio-box]=1&products[vowel-sounds-poster]=1&locked=true&redirect=/order"--}}
            {{--                    >--}}
            {{--                        Become a lifetime member--}}
            {{--                    </a>--}}
            <br><br>

            <div class="inline-block w-full px-3 md:px-4 my-5 credit-cards text-navy text-4xl" style="color:#A4AFC7;">
                <i class="fab fa-cc-visa"></i>
                <i class="fab fa-cc-mastercard"></i>
                <i class="fab fa-cc-amex"></i>
                <i class="fab fa-cc-paypal"></i>
                <i class="fab fa-cc-discover"></i>
            </div>
            {{-- <div class="inline-block w-full px-3 md:px-4 questions max-w-2xl"> --}}
            {{-- <h4><strong>Still have questions?</strong></h4> --}}
            {{-- <p>If you need any further information about becoming a Lifetime Member, contact our amazing support team <a class="text-white" href="{{ get_musora_brand_base_url() }}/contact">here</a> --}}
            {{-- <br><br> --}}
            {{-- A friendly and knowledgeable support team member will get back to you right away. --}}
            {{-- <br> All prices listed in USD.</p> --}}
            {{--<p><strong>Any questions?</strong><br class="inline-block md:hidden"> Call us toll-free at--}}
            {{--<a href="tel:+18004398921">1-800-439-8921</a> <br class="inline-block md:hidden"> or directly at--}}
            {{--<a href="tel:+16048557605">1-604-855-7605</a>.<br> All prices listed in USD. </p>--}}
            {{-- </div> --}}
        </div>
    </section>

    <div class="reveal coach-wrap relative rounded-xl text-center overflow-visible select-none max-w-xs md:max-w-lg" id="specs" data-reveal data-reset-on-close="false">
        <div class="p-4 md:p-5">
            <h4 class="font-bold">EIKON STUDIO BOX THREE</h4>
            <p class="mb-4">Retail Price: $399</p>
            <ul class="text-left pl-6 mb-6" style="list-style-type: disc;">
                <li>CM14USB microphone equipped with a 96 Khz 24 bit USB audio interface for plug-and-play simplicity.</li>
                <li>Small-diaphragm condenser capsule captures lifelike vocals</li>
                <li>Direct Monitoring control with independent Volume available on the microphone</li>
                <li>H1000 Professional Hi-End Stereo Headphones</li>
                <li>DST60TL Desktop Microphone Stand</li>
                <li>APOP65 Nylon screen professional pop filter for studio-quality recordings</li>
            </ul>
            <p class="text-left">
                Finally, hear your voice how it actually sounds in your head. And have the tools you need to have the singing skills you’ve always wanted.
            </p>
        </div>
    </div>

    @include("singeo.sales.partials._footer")

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script type="text/javascript" src="{{ asset('/marketing/parcel/drumeo/navigation-sales.js') }}"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/lazysizes/5.3.2/lazysizes.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/lazysizes/5.3.2/plugins/unveilhooks/ls.unveilhooks.min.js"></script>
    <script type="text/javascript" src="{{ asset('/marketing/js/modal.js') }}"></script>
    <script type="text/javascript" src="{{ asset('/marketing/js/modal-autoplay.js') }}"></script>
    <script>
        $(document).ready(function () {
            $('.flip-div').click(function (e) {
                $(this).toggleClass('flipped');
            });
        });
    </script>

    <script>
        $(document).ready(function () {
            $(document).foundation();

            //customize section pack picker
            var originalLink2 = '/ecommerce/add-to-cart?redirect=/order&products[singeo-lifetime-membership-access]=1&products[vowel-sounds-poster]=1&products[wallflower-tumbler]=1&products[mouth-mug]=1&locked=true';

            $('select').prop('selectedIndex', 0);
            $('.bundle-pick').change(function () {
                var orderButton2 = $(this).parent().find('.selected-pack2');
                var selectedOption2 = $(this).find('option:selected');
                $(this).removeClass('error');
                orderButton2.addClass('active');
                orderButton2.attr('href', originalLink2);
                orderButton2.attr('href', orderButton2.attr('href') + '&products[' + selectedOption2.val() + ']=1');
                orderButton2.attr('data-product-json', selectedOption2.attr('data-product-json'));
            });

            $('.selected-pack2').on('click', function (ev) {
                if (!$(this).hasClass('active')) {
                    ev.preventDefault();
                    ev.stopPropagation();
                    var selecter2 = $(this).parent().find('.bundle-pick');
                    selecter2.addClass('error');
                }
            });

        });
    </script>
@stop
