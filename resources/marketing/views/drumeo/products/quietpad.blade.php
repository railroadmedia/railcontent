@extends('drumeo.products.misc-products-layout', [
    'appTailwind' => true
])

@section('meta')
    <title>Drumeo QuietPad</title>
    <meta name="description" content="Practice anywhere with two full-size playing surfaces.">
    <meta property="og:image" content="https://dpwjbsxqtam5n.cloudfront.net/drum-shop/quietpad/og-image.jpg" style="display: none;">
    <meta property="og:title" content="Drumeo QuietPad">
    <meta property="og:description" content="Practice anywhere with two full-size playing surfaces.">
    <meta property="og:url" content="https://www.drumeo.com/{{ Request::path() }}">
@stop()

@section('head')
    @parent
    <link href="{{ asset('/marketing/parcel/drumeo/quietpad.css') }}" rel="stylesheet">

    <?php \App\Analytics\Tracker::trackProductImpression('quietpad'); ?>
@stop()

@section('scripts')
    <script>
        $(document).ready(function () {
            $('.pad-toggle').click(function (e) {
                e.stopPropagation();
                $('.pad-flipper').toggleClass('flipped');
                $('.pad-details').toggleClass('active');
            });

            // Functions for slider
            var thumbnail = $('.img-modal');
            var sliderClose = $('.close-modal');
            var sliderOverlay = $('.slider-overlay');
            var sliderLightbox = $('.slider-lightbox');

            thumbnail.click(function () {
                currentSlide = $(this).index();
                sliderLightbox.addClass('active');
                sliderOverlay.addClass('active');

                giveSlidesClass();
            });
            sliderClose.click(function () {
                closeSliderOverlay();
            });

            sliderOverlay.click(function (e) {
                e.stopPropagation();

                closeSliderOverlay();
            });

            function closeSliderOverlay() {
                sliderOverlay.removeClass('active');
                sliderLightbox.removeClass('active');

                slidesElement.removeClass('current-slide prev-slide next-slide');
            }

            var currentSlide = 0;
            var nextSlide = currentSlide + 1;
            var prevSlide;
            var slidesElement = $('.review-slide');
            var totalSlides = slidesElement.length;
            var scrollLeftElement = $('.scroll-left');
            var scrollRightElement = $('.scroll-right');

            function showHideArrows() {
                if (currentSlide == 0) {
                    scrollLeftElement.removeClass('active');
                } else {
                    scrollLeftElement.addClass('active');
                }

                if (currentSlide == slidesElement.length - 1) {
                    scrollRightElement.removeClass('active');
                } else {
                    scrollRightElement.addClass('active');
                }
            }

            function giveSlidesClass() {
                prevSlide = currentSlide - 1;
                nextSlide = currentSlide + 1;

                slidesElement.removeClass('current-slide prev-slide next-slide');

                if (prevSlide < 0) {
                    prevSlide = undefined;
                }
                if (nextSlide > totalSlides - 1) {
                    nextSlide = undefined;
                }
                slidesElement.eq(currentSlide).addClass('current-slide');
                slidesElement.eq(prevSlide).addClass('prev-slide');
                slidesElement.eq(nextSlide).addClass('next-slide');
                showHideArrows();
            }

            giveSlidesClass();

            slidesElement.click(function (e) {
                e.stopPropagation();
            });
            scrollLeftElement.click(function (e) {
                e.stopPropagation();
                currentSlide = currentSlide - 1;
                giveSlidesClass();
            });

            scrollRightElement.click(function (e) {
                e.stopPropagation();
                currentSlide = currentSlide + 1;
                giveSlidesClass();
            });
        });
    </script>
@stop()

@section('body-data')
    x-data="{ trailerOne: false, trailerTwo: false, }"
@endsection

@section('content')

    @include('_partials.components.shop.promo-banner-2', [
        "name" => "Drumeo QuietPad",
        "fullPrice" => floatval($productPrices['quietpad']->price),
        "price" => floatval($productPrices['quietpad']->discounted_price),
        "noBreadcrumb" => true
    ])

    <header class="header text-center">
        <div class="background-fade" style="background-image: url(https://dpwjbsxqtam5n.cloudfront.net/drum-shop/quietpad/header-snare-pad.jpg)"></div>
        <div class="background-fade" style="background-image: url(https://dpwjbsxqtam5n.cloudfront.net/drum-shop/quietpad/header-quiet-pad.jpg);"></div>
        <div class="row">
            <img class="logo show-for-medium" src="https://dpwjbsxqtam5n.cloudfront.net/drum-shop/quietpad/drumeo-quietpad.png" alt="Quietpad logo">
            <br class="show-for-medium">
            <div class="watch-badge">
                <span>WATCH<br> THE DEMO</span>
                <img src="https://dpwjbsxqtam5n.cloudfront.net/sales/arrow-left-white.png" alt="Left arrow">
            </div>
            <i @click="trailerOne = true;" class="fas fa-play play-button autoplay-video"></i>
            <br class="hide-for-medium">
            <img class="logo hide-for-medium" src="https://dpwjbsxqtam5n.cloudfront.net/drum-shop/quietpad/drumeo-quietpad.png" alt="Quietpad logo">
            <h2><strong style="font-weight: 900;">Practice anywhere</strong> with two<br class="hide-for-medium"> full-size playing surfaces.</h2>
            <a href="/ecommerce/add-to-cart?products[quietpad]=1" class="join blue max-w-xl">Get Yours &raquo;</a>
            <p class="dense" style="opacity: 0;"><strong class="text-yellow">LAUNCH SPECIAL</strong><br>
                <s>NORMALLY ${{ floatval($productPrices['quietpad']->price) }}.</s> <strong>ONLY ${{ floatval($productPrices['quietpad']->discounted_price) }}</strong> (SAVE {{ round(100 - (100 * (floatval($productPrices['quietpad']->discounted_price) / floatval($productPrices['quietpad']->price)))) }}%)</p>
        </div>
    </header>

    @component('_partials.components.video-modal',[
        'name' => 'trailerOne',
        'video' => '395000347',
        'vimeo' => true,
    ])
    @endcomponent

    <section class="content-section two-sides text-center" style="background:#fff!important;color:#000!important;">
        <div class="row">
            <h2><strong>One traditional side.<br class="hide-for-medium"> One quiet side.</strong></h2>
            <h5>The portable, double-sided practice pad<br class="hide-for-medium"> with different <br class="show-for-medium-only">volumes so you can<br class="hide-for-medium"> practice late into the night.</h5>
            <div class="pad-toggle">
                <div class="pad-details traditional active">
                    <img class="pad-icon" src="https://dpwjbsxqtam5n.cloudfront.net/drum-shop/quietpad/icon-sticks.png" alt="Stick icon">
                    <img class="mobile-pad hide-for-medium" src="https://dpwjbsxqtam5n.cloudfront.net/drum-shop/quietpad/flipper.png" alt="Quiet pad">
                    <h5><strong>Traditional Surface</strong></h5>
                    <p>Durable. Realistic. Portable. The blue side offers a 12” playing surface, snare-like rebound, and everything you’d expect for every day practice. (You’ll love the hand-assembled quality.)</p>
                    <img class="arrow active show-for-medium" style="transform: scaleX(-1);" src="https://dpwjbsxqtam5n.cloudfront.net/drum-shop/quietpad/left-arrow.png" alt="Left arrow">
                </div>
                <div class="pad-details quiet">
                    <img class="pad-icon" src="https://dpwjbsxqtam5n.cloudfront.net/drum-shop/quietpad/icon-moon.png" alt="Moon icon">
                    <img class="mobile-pad hide-for-medium" src="https://dpwjbsxqtam5n.cloudfront.net/drum-shop/quietpad/flipper-black.png" alt="Quietpad">
                    <h5><strong>Quiet Surface</strong></h5>
                    <p>Shhhhhh. Avoid the tap-tappidy-tap complaints with our quiet side, up to 50% quieter than traditional pads and ideal for developing strength, endurance, and control. (You’ll love the way it feels.)</p>
                    <img class="arrow active show-for-medium" src="https://dpwjbsxqtam5n.cloudfront.net/drum-shop/quietpad/left-arrow.png" alt="Left arrow">
                </div>
                <div class="pad-flipper flipped show-for-medium text-white">
                    <div style="background-image:url(https://dpwjbsxqtam5n.cloudfront.net/drum-shop/quietpad/flipper.png);"><i class="fad fa-repeat hover-icon"></i></div>
                    <div style="background-image:url(https://dpwjbsxqtam5n.cloudfront.net/drum-shop/quietpad/flipper-black.png);"><i class="fad fa-repeat hover-icon"></i></div>
                </div>
            </div>
        </div>
    </section>

    <section class="content-section together text-center">
        <div class="row">
            <h2><strong>Your two favorite<br class="hide-for-medium"> practice pads, together.</strong></h2>
            <img class="pad" src="https://dpwjbsxqtam5n.cloudfront.net/drum-shop/quietpad/side-pad.png" alt="Quietpad side">
            <div class="text-wrap">
                <p class="text-blue"><img src="https://dpwjbsxqtam5n.cloudfront.net/drum-shop/quietpad/blue-top-left-arrow.png" alt="Left arrow"> Designed to feel like<br class="hide-for-medium"> your snare drum.</p>
                <p class="text-grey"><img src="https://dpwjbsxqtam5n.cloudfront.net/drum-shop/quietpad/blue-bottom-left-arrow.png" alt="Left arrow"> For strength-building<br class="hide-for-medium"> or late-night practice.</p>
            </div>
        </div>
        <div class="modal-wrapper clearfix">
            <div class="thumb img-modal"><div style="background-image: url(https://dpwjbsxqtam5n.cloudfront.net/drum-shop/quietpad/pad-snare-jord-holding-outside.jpg);"></div></div>
            <div class="thumb img-modal"><div style="background-image: url(https://dpwjbsxqtam5n.cloudfront.net/drum-shop/quietpad/pad-snare-over-shoulder.jpg);"></div></div>
            <div class="thumb img-modal"><div style="background-image: url(https://dpwjbsxqtam5n.cloudfront.net/drum-shop/quietpad/pad-snare-closeup-playing.jpg);"></div></div>
            <div class="thumb img-modal"><div style="background-image: url(https://dpwjbsxqtam5n.cloudfront.net/drum-shop/quietpad/pad-quiet-floor.jpg);"></div></div>
            <div class="thumb img-modal"><div style="background-image: url(https://dpwjbsxqtam5n.cloudfront.net/drum-shop/quietpad/pad-quiet-closeup-playing.jpg);"></div></div>
            <div class="thumb img-modal"><div style="background-image: url(https://dpwjbsxqtam5n.cloudfront.net/drum-shop/quietpad/pad-quiet-jord-over-shoulder.jpg);"></div></div>
            <div class="thumb size-16-9 img-modal"><div style="background-image: url(https://dpwjbsxqtam5n.cloudfront.net/drum-shop/quietpad/pad-snare-jared-2.jpg);"></div></div>
            <div class="thumb size-16-9 img-modal float-right"><div style="background-image: url(https://dpwjbsxqtam5n.cloudfront.net/drum-shop/quietpad/pad-quiet-dub.jpg);"></div></div>
            <div class="video-pop autoplay-video" @click="trailerTwo = true;">
                <div class="watch-badge absolute top-1/3 left-2/3 sm:left-3/4 lg:left-2/3 transform -translate-x-1/2 -translate-y-1/2">
                    <span>WATCH<br> BLIND TEST</span>
                    <img class="block mt-2 w-8 sm:w-11" src="https://dpwjbsxqtam5n.cloudfront.net/sales/arrow-left-white.png" alt="Left arrow">
                </div>
                <i class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 fas fa-play play-button smaller z-20"></i>
                <img class="bg" src="https://dpwjbsxqtam5n.cloudfront.net/drum-shop/quietpad/blindfold-test-thumb.jpg" alt="Thumnail">
            </div>
        </div>
    </section>

    @component('_partials.components.video-modal',[
        'name' => 'trailerTwo',
        'video' => '394999066',
        'vimeo' => true,
    ])
    @endcomponent

    <div class="slider-overlay">
        <div class="slider-lightbox">
            <div class="row">
                <div class="review-slide">
                    <div class="image"
                        style="background-image:url(https://dpwjbsxqtam5n.cloudfront.net/drum-shop/quietpad/pad-snare-jord-holding-outside.jpg);"></div>
                </div>
                <div class="review-slide">
                    <div class="image"
                        style="background-image:url(https://dpwjbsxqtam5n.cloudfront.net/drum-shop/quietpad/pad-snare-over-shoulder.jpg);"></div>
                </div>
                <div class="review-slide">
                    <div class="image"
                        style="background-image:url(https://dpwjbsxqtam5n.cloudfront.net/drum-shop/quietpad/pad-snare-closeup-playing.jpg);"></div>
                </div>
                <div class="review-slide">
                    <div class="image"
                        style="background-image:url(https://dpwjbsxqtam5n.cloudfront.net/drum-shop/quietpad/pad-quiet-floor.jpg);"></div>
                </div>
                <div class="review-slide">
                    <div class="image"
                        style="background-image:url(https://dpwjbsxqtam5n.cloudfront.net/drum-shop/quietpad/pad-quiet-closeup-playing.jpg);"></div>
                </div>
                <div class="review-slide">
                    <div class="image"
                        style="background-image:url(https://dpwjbsxqtam5n.cloudfront.net/drum-shop/quietpad/pad-quiet-jord-over-shoulder.jpg);"></div>
                </div>
                <div class="review-slide show-for-medium">
                    <div class="image size-16-9"
                        style="background-image:url(https://dpwjbsxqtam5n.cloudfront.net/drum-shop/quietpad/pad-snare-jared-2.jpg);"></div>
                </div>
                <div class="review-slide show-for-medium">
                    <div class="image size-16-9"
                        style="background-image:url(https://dpwjbsxqtam5n.cloudfront.net/drum-shop/quietpad/pad-quiet-dub.jpg);"></div>
                </div>
                <i class="fas fa-times close-modal"></i>
                <div class="arrow scroll-left"><i class="fas fa-chevron-left"></i></div>
                <div class="arrow scroll-right"><i class="fas fa-chevron-right"></i></div>
            </div>
        </div>
    </div>

{{--    <section class="content-section text-center comparison" style="background-color: #f4f8fb; color:#000;">--}}
{{--        <div class="row">--}}
{{--            <h2><strong>The everyday practice<br class="hide-for-medium"> pad for drummers.</strong></h2>--}}
{{--            <table>--}}
{{--                <tbody>--}}
{{--                <tr>--}}
{{--                    <td></td>--}}
{{--                    <td><img class="logo" src="https://dpwjbsxqtam5n.cloudfront.net/drum-shop/quietpad/drumeo-quietpad-white.png" alt="Quietpad logo"></td>--}}
{{--                    <td>Evans RealFeel</td>--}}
{{--                    <td>Reflexx</td>--}}
{{--                    <td>Drumeo P4</td>--}}
{{--                </tr>--}}
{{--                <tr>--}}
{{--                    <td>Size</td>--}}
{{--                    <td>12”</td>--}}
{{--                    <td>12”</td>--}}
{{--                    <td>10”</td>--}}
{{--                    <td>12”</td>--}}
{{--                </tr>--}}
{{--                <tr>--}}
{{--                    <td>Playing Surfaces</td>--}}
{{--                    <td>2</td>--}}
{{--                    <td>1-2</td>--}}
{{--                    <td>2</td>--}}
{{--                    <td>4 (one side)</td>--}}
{{--                </tr>--}}
{{--                <tr>--}}
{{--                    <td>Snare-Like Size</td>--}}
{{--                    <td>12” x 12”</td>--}}
{{--                    <td></td>--}}
{{--                    <td></td>--}}
{{--                    <td>12” x 5”</td>--}}
{{--                </tr>--}}
{{--                <tr>--}}
{{--                    <td>Quiet Surface Size</td>--}}
{{--                    <td>12” x 12”</td>--}}
{{--                    <td></td>--}}
{{--                    <td></td>--}}
{{--                    <td>6” x 5”</td>--}}
{{--                </tr>--}}
{{--                <tr>--}}
{{--                    <td>Priorities</td>--}}
{{--                    <td>Quieter Practice<br>Realistic Feel<br>Portable</td>--}}
{{--                    <td>Durable<br>Portable<br>Affordable</td>--}}
{{--                    <td>Workout/Quiet<br>Portable<br>Portability</td>--}}
{{--                    <td>Practice Movement<br>Realistic Feel<br>Versatile</td>--}}
{{--                </tr>--}}
{{--                <tr>--}}
{{--                    <td>Hand Assembled</td>--}}
{{--                    <td><i class="fas fa-check-circle"></i></td>--}}
{{--                    <td></td>--}}
{{--                    <td></td>--}}
{{--                    <td><i class="fas fa-check-circle"></i></td>--}}
{{--                </tr>--}}
{{--                <tr>--}}
{{--                    <td>Worldwide Shipping</td>--}}
{{--                    <td><i class="fas fa-check-circle"></i></td>--}}
{{--                    <td></td>--}}
{{--                    <td></td>--}}
{{--                    <td><i class="fas fa-check-circle"></i></td>--}}
{{--                </tr>--}}
{{--                <tr>--}}
{{--                    <td></td>--}}
{{--                    <td>@if(floatval($productPrices['quietpad']->price) > floatval($productPrices['quietpad']->discounted_price))--}}
{{--                            <s>${{ floatval($productPrices['quietpad']->price) }}</s>@endif--}}
{{--                        <strong>${{ floatval($productPrices['quietpad']->discounted_price) }}</strong><br>+ SHIPPING</td>--}}
{{--                    <td><strong>$29</strong><br>+ SHIPPING</td>--}}
{{--                    <td><strong>$60</strong><br>+ SHIPPING</td>--}}
{{--                    <td><strong>$79</strong><br>+ SHIPPING</td>--}}
{{--                </tr>--}}
{{--                </tbody>--}}
{{--            </table>--}}
{{--        </div>--}}
{{--    </section>--}}

    <section class="content-section text-center customize px-4 lg:px-6" style="background:#173c59 url('https://d21q7xesnoiieh.cloudfront.net/fit-in/2000x0/filters:quality(95)/marketing/drumeo/shop/stickbag/order-bg.jpg') center center/cover;">
        <div class="container mx-auto">
            <img alt="quietkick logo" class="h-14 sm:h-24 mb-4" src="https://dpwjbsxqtam5n.cloudfront.net/drum-shop/quietpad/drumeo-quietpad.png"><br>

            @if( $products['quietpad']->getStockAvailability() > 1 && !empty($products['quietpad']->getStockAvailability()))

                <div class="flex flex-wrap items-start justify-center 2-full max-w-sm md:max-w-2xl mx-auto">
                    <div class="w-full md:w-1/2 px-2 md:px-3 relative">
                        <a href="/ecommerce/add-to-cart?locked=true&products[quietpad]=1" class="text-black overflow-hidden rounded-2xl block mx-auto mb-4 md:mb-0 group border-2 border-black">
                            <div class="bg-white px-3 py-5 md:py-7">
                                <h4 class="mb-2 sm:mb-3"><strong>QuietPad Only</strong></h4>
                                <img class="h-24 transition-opacity opacity-0"
                                    loading="lazy"
                                    onload="this.classList.remove('opacity-0')"
                                    src="https://dpwjbsxqtam5n.cloudfront.net/drum-shop/quietpad/flipper.png"
                                    alt="learn playing image"
                                >
                                <br>
                                <h4 class="inline-block leading-tight">
                                    @if(floatval($productPrices['quietpad']->price) > floatval($productPrices['quietpad']->discounted_price))
                                        <s>${{ floatval($productPrices['quietpad']->price) }}</s>
                                    @endif
                                    <strong>${{ floatval($productPrices['quietpad']->discounted_price) }}</strong></h4>
                                <p class="text-sm"><em>
                                        @if(floatval($productPrices['quietpad']->price) > floatval($productPrices['quietpad']->discounted_price))
                                            Save 34%.
                                        @endif
                                        One-time payment.</em></p>
                                <div class="join my-5 musora-black smaller w-full transition-opacity duration-300 group-hover:opacity-80 max-w-[230px]">Select</div>
                                <p class="text-sm">1 Drumeo QuietPad<sup>NEW</sup></p>
                            </div>
                        </a>
                    </div>
                </div>
            @else
                <a class="join sold-out mt-5 sm:mt-10">SOLD OUT</a>
            @endif
            <br>
            <a style="color: #00bc75;" class="inline-block cursor-pointer" href="/ecommerce/add-to-cart?products[DLM-1-year]=1&products[quietpad]=1&locked=true"><h6><strong><u>Or get it FREE when you join Drumeo.</u></strong></h6></a>
        </div>
    </section>

    <section class="text-center py-10 text-white" style="background: #00101D;">
        <div class="container mx-auto relative z-50">
            <div class="inline-block w-full px-3 md:px-4 mb-5 text-light-navy">
                <p>Call us toll-free at
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
@stop
