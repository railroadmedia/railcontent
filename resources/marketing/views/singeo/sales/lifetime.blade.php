@extends('singeo._partials.global-layout')

@section('global-head')
    <title>The Sing Forever Bundle | Singeo</title>
    <meta property="og:title" content="The Sing Forever Bundle">

    <meta name="description" content="With the LIFETIME bundle, you'll get everything you need to pursue and develop your skills on the guitar.">
    <meta property="og:description" content="With the LIFETIME bundle, you'll get everything you need to pursue and develop your skills on the guitar.">
    <meta property="og:image" content="https://singeo.s3.amazonaws.com/sales/promos/august/lifetime_bundle.jpg" style="display: none;">
    <meta property="og:url" content="https://www.singeo.com/{{ Request::path() }}">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.19/tailwind.min.css" />
    <link rel="stylesheet" href="{{ asset('/marketing/css/singeo/tailwind-helpers.css') }}">
    <link href="{{ asset('/marketing/parcel/singeo/sales-page.css') }}" rel="stylesheet">
    <link href="{{ asset('/marketing/parcel/singeo/nav-footer.css') }}" rel="stylesheet">
    <link href="{{ asset('/marketing/parcel/singeo/animate.css') }}" rel="stylesheet">

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
    {{--@include('shop.partials.promo-banner', [--}}
                {{--"name" => "The Love To Sing Bundle",--}}
                {{--"fullPrice" => SingeoPrices::$bundleLifetime,--}}
                {{--"price" => SingeoPrices::$bundleLifetime,--}}
                    {{--"noBreadcrumb" => true,--}}
                    {{--"specialText" => "<strong>EXTENDED FOR CYBER MONDAY</strong>",--}}
            {{--])--}}
    <section class="content-section relative overflow-hidden text-white grey text-center upgrade-video-header" style="padding-bottom:10px">
        <div class="container mx-auto">
            <h1><strong>Get a LIFETIME Singeo Membership<br> + ALL our Merch for FREE</strong></h1>
            <div class="w-full mx-auto my-10 px-3" style="max-width:920px;">
                <img class="w-full rounded-xl" src="https://cdn.musora.com/image/fetch/w_670,q_auto:best/https://singeo.s3.amazonaws.com/sales/promos/august/lifetime_banner.jpg">
                {{--<div class="aspect-16:9 w-full relative rounded-xl">--}}
                    {{--<iframe class="absolute w-full h-full reset-on-close" src="//player.vimeo.com/video/649113636" frameborder="0" allowfullscreen allow="autoplay"></iframe>--}}
                {{--</div>--}}
            </div>

            <h3 class="leading-tight">
                {{--<strong class="text-promo">Extended for Cyber Monday</strong><br>--}}
                Lifetime Membership For <s class="opacity-50">$379</s> ${{ SingeoPrices::$bundleLifetime }}
            </h3>
            <a href="#customize-anchor"
                    class="join promo anchor-slide methodcta my-4">BECOME A LIFETIME MEMBER &raquo;</a>
            {{--<a class="join sold-out methodcta my-4">SOLD OUT</a>--}}
            <p>(Or choose a payment plan on the next page.)</p>

            <h6 class="leading-relaxed px-3 mt-10 text-left" style="width: 100%;max-width: 600px;">
                <em>“I don’t sing because I’m happy. I’m happy because I sing” - William James</em>
                <br><br>
                For some, singing isn’t just a hobby - it’s a true passion. If you’re one of those people, we want to invite you to make a lifelong commitment to your singing.
                <br><br>
                <strong>For only a limited time, Singeo Lifetime Memberships are back!</strong>
                <br><br>
                This is your chance to make one final payment for your Singeo Membership and then enjoy unlimited singing lessons, personal feedback from real vocal coaches and access to a community of other singers like you…for years to come.
                <br><br>
                Singeo has helped THOUSANDS of students find the singing voice they’ve always wanted. And now, they all connect and share inside the best online singing community.
                <br><br>
                You’ll also get ALL our merch completely FREE. So you’ll be able to start your singing lessons already feeling and looking like a rockstar.
                <br><br>
                We’ll see you with your little infinity badge around your name very soon!
            </h6>
        </div>
    </section>

    <div id="customize-anchor" class="anchor anchor-slide"></div>
        <section class="content-section relative overflow-hidden text-white grey text-center customize" style="background: linear-gradient(#000318,#01082b 100%);">
                <div class="container mx-auto">
                    <div class="horizontal-bonuses mx-auto mb-4 max-w-xs md:max-w-xl lg:max-w-4xl">
                        <style>
                            .content-section.customize .horizontal-bonuses .bonus-wrap .flip-div.special {
                                max-width:280px;
                                padding-bottom: 51%;
                            }
                            @media (min-width: 768px) {
                                .content-section.customize .horizontal-bonuses .bonus-wrap .flip-div.special {
                                    max-width:290px;
                                    padding-bottom: 28%;
                                }
                            }
                            @media (min-width: 1024px) {
                                .content-section.customize .horizontal-bonuses .bonus-wrap .flip-div.special {
                                    max-width:330px;
                                    padding-bottom: 25%;
                                }
                            }
                        </style>
                        <div class="bonus-wrap relative inline-block align-top mx-auto mb-3 md:mb-4 px-2 md:px-3 lg:px-2 w-full">
                            <div class="flip-div special">
                                <div class="flip-inner">
                                    <div class="front">
                                        <div class="hover-icon"><i class="fas fa-arrow-right"></i><br>DETAILS</div>
                                        <div class="image-wrap" style="background-image:url(https://cdn.musora.com/image/fetch/w_670,q_auto:best/https://singeo.s3.amazonaws.com/sales/promos/august/lifetime_bundle.jpg);"></div>
                                    </div>
                                    <div class="back">
                                        <div class="text-wrap">
                                            <p class="text-xs"><strong class="font-black inline-block mb-1">Singeo Lifetime Membership</strong><br>Step-by-step singing lessons, warm-up routines, karaoke songs, and ongoing support from real teachers.</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <p class="uppercase">
                                <strong class="font-black leading-tight inline-block mt-2 mb-1">Singeo Lifetime Membership</strong><br>
                                <span class="text-promo" style="text-transform:uppercase; display:inline-block;"><strong>${{ SingeoPrices::$bundleLifetime }}</strong></span><br>
                                Instant Access
                            </p>
                        </div>

                        @php
                            $bonuses = [
                                [
                                'image' => 'https://singeo.s3.amazonaws.com/sales/promos/november/tumbler2.png',
                                'title' => 'Do-Re-Mi Tumbler',
                                'badge' => 'Do-Re-Mi Tumbler',
                                'description' => 'Stay hydrated while practicing your scales both at home or on the go with the Singeo insulated tumbler.',
                                'price' => SingeoPrices::$tumblerFull,
                                'online-ship' => "Free Shipping",
                                ],
                                [
                                'image' => 'https://singeo.s3.amazonaws.com/sales/promos/november/mug.jpg',
                                'title' => 'Rockstar Mug',
                                'badge' => 'Rockstar Mug',
                                'description' => 'Protect what’s most important to you as a singer! Sip your singer’s tea in style with this super rad mug!',
                                'price' => SingeoPrices::$mugFull,
                                'online-ship' => "Free Shipping",
                                ],
                                [
                                'image' => 'https://singeo.s3.amazonaws.com/sales/promos/november/poster2.png',
                                'title' => 'Vowel Practice Poster',
                                'badge' => 'Vowel Practice Poster',
                                'description' => 'Your new favorite practice tool - and your ticket hitting higher notes with ease and confidence.',
                                'price' => SingeoPrices::$posterFull,
                                'online-ship' => "Free Shipping",
                                ],
                                [
                                'image' => 'https://singeo.s3.amazonaws.com/products/retro-shirt.png',
                                'title' => 'Singeo Retro T-shirt',
                                'badge' => 'Singeo Retro T-shirt',
                                'description' => 'Sing with confidence AND style with this super slick Retro T-shirt.',
                                'price' => SingeoPrices::$shirtsFull,
                                'online-ship' => "Free Shipping",
                                ],
                            ]
                        @endphp
                        @foreach($bonuses as $bonus)
                            <div class="bonus-wrap relative inline-block align-top mx-auto mb-3 md:mb-4 px-2 md:px-3 lg:px-2 w-1/2 sm:w-1/3 lg:w-1/5">
                                <div class="flip-div @if(!empty($bonus['class'])) {{ $bonus['class'] }} @endif">
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
                                    <span class="text-promo" style="text-transform:uppercase; display:inline-block;"><s>${{ $bonus['price'] }}</s> <strong>FREE</strong></span><br>
                                    {{ $bonus['online-ship'] }}
                                </p>
                            </div>
                        @endforeach

                        <p style="max-width: 480px;color: #aaa;padding:0 15px;"><em>All digital bonuses are added to your account instantly with your membership to Singeo and they’re yours forever!</em></p>
                    </div>
                    <div class="arrow-wrap text-promo">
                        <i class="fal fa-chevron-down animated infinite pulse"></i>
                        <i class="fal fa-chevron-down animated delay-1s infinite pulse"></i>
                        <i class="fal fa-chevron-down animated delay-2s infinite pulse"></i>
                    </div>
                    {{--<a class="join sold-out methodcta my-4">SOLD OUT</a>--}}
                    <div class="w-full max-w-sm mx-auto">
                    <select class="bundle-pick uppercase border-2 border-solid rounded-full font-bold text-xl w-full h-auto py-2 pl-7 pr-5 mb-3 bg-white md:py-2 lg:py-4" title="Shirt Size" required="" style="border-color: #717D80; color: #717D80; font-family: Roboto Condensed, sans-serif;">
                        <option hidden="" value=""> Choose Shirt Size </option>
                        <option value="retro-shirt-s" data-price="29" data-product-json="{&quot;retro-shirt-s&quot;: 1}">Small</option>
                        <option value="retro-shirt-m" data-price="29" data-product-json="{&quot;retro-shirt-m&quot;: 1}">Medium</option>
                        <option value="retro-shirt-l" data-price="29" data-product-json="{&quot;retro-shirt-l&quot;: 1}">Large</option>
                        <option value="retro-shirt-xl" data-price="29" data-product-json="{&quot;retro-shirt-xl&quot;: 1}">X-Large</option>
                        <option value="retro-shirt-xxl" data-price="29" data-product-json="{&quot;retro-shirt-xxl&quot;: 1}">XX-Large</option>
                    </select>
                    <a class=" online-atc merch vue-add-to-cart selected-pack2" href="#" data-base-url="/ecommerce/add-to-cart?redirect=/order&products[singeo-lifetime-membership-access]=1&products[vowel-sounds-poster]=1&products[wallflower-tumbler]=1&products[mouth-mug]=1&locked=true">
                        <button class="tw-border-none join w-full">
                            <i class="fas fa-cart-plus" aria-hidden="true"></i> Order Now
                        </button>
                    </a>
                    </div>
                    {{--<a class="join promo methodcta"--}}
                            {{--href="/ecommerce/add-to-cart?products[singeo-lifetime-membership-access]=1&products[vowel-sounds-poster]=1&products[mouth-mug]=1&products[wallflower-tumbler]=1&products[singing-starter-kit]=1&redirect=/order&locked=true"--}}
                    {{-->Get Started &raquo;</a>--}}
                    <br><br>

                    <div class="inline-block w-full px-3 md:px-4 my-5 credit-cards text-navy">
                        <i class="fab fa-cc-visa"></i>
                        <i class="fab fa-cc-mastercard"></i>
                        <i class="fab fa-cc-amex"></i>
                        <i class="fab fa-cc-paypal"></i>
                        <i class="fab fa-cc-discover"></i>
                    </div>
                    <div class="inline-block w-full px-3 md:px-4 questions max-w-2xl">
                        <h4><strong>Still have questions?</strong></h4>
                        <p>If you need any further information about becoming a Lifetime Member, contact our amazing support team <a class="text-white" href="/support">here</a>
                            <br><br>
                            A friendly and knowledgeable support team member will get back to you right away.
                            <br> All prices listed in USD.</p>
                        {{--<p><strong>Any questions?</strong><br class="inline-block md:hidden"> Call us toll-free at--}}
                            {{--<a href="tel:+18004398921">1-800-439-8921</a> <br class="inline-block md:hidden"> or directly at--}}
                            {{--<a href="tel:+16048557605">1-604-855-7605</a>.<br> All prices listed in USD. </p>--}}
                    </div>

                </div>
        </section>

    <section class="content-section relative overflow-hidden text-white text-center">
        <div class="container mx-auto max-w-6xl">
            <div class="flex flex-wrap md:flex-nowrap justify-center items-start lg:items-center px-5 lg:px-14">
                <img alt="" class="md:order-1 h-32 md:h-48 lg:h-64 lazyload" data-src="https://cdn.musora.com/image/fetch/w_500,q_auto:best/https://singeo.s3.amazonaws.com/sales/2021/guarantee.png">
                <div class="text-wrap text-left sm:pr-6 lg:pr-12">
                    <h6 class="my-3 sm:mt-0 leading-relaxed">You love to sing, so sing!  We guarantee that you will hear and feel the results within your first few months at Singeo. We want your first 90 days with Singeo to show you how applying daily practice within a supportive community can provide incredible results!  Our program is ongoing, and consistently growing with new content and fun lessons to last a lifetime, so we are happy to offer a full 90-day money back guarantee.</h6>
                    <ul class="fa-ul mt-3">
                        <li class="mb-3"><i class="fa-li fas fa-check-circle text-singeo text-2xl leading-none mr-1"></i> <em>Learn and love your own, unique voice</em></li>
                        <li class="mb-3"><i class="fa-li fas fa-check-circle text-singeo text-2xl leading-none mr-1"></i> <em>Sing along (with confidence) with songs that you love! </em></li>
                        <li><i class="fa-li fas fa-check-circle text-singeo text-2xl leading-none mr-1"></i> <em>Get support from real teachers every step of the way.</em></li>
                    </ul>
                </div>
            </div>
        </div>
    </section>
    @include("singeo.sales.partials._footer")

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script type="text/javascript" src="/marketing/parcel/singeo/nav-footer.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/lazysizes/5.3.2/lazysizes.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/lazysizes/5.3.2/plugins/unveilhooks/ls.unveilhooks.min.js"></script>
    <script type="text/javascript" src="/marketing/js/jquery.countdown-2.min.js"></script>
    <script>
        $(document).ready(function () {
            $('.flip-div').click(function (e) {
                $(this).toggleClass('flipped');
            });

            // Countdown
            $('.tzcd-full').countdown('2021/11/30')
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
            $('.tzcd-small').countdown('2021/11/30')
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
            $('.tzcd-big').countdown('2021/11/30')
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

    <script>
        $(document).ready(function () {

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
