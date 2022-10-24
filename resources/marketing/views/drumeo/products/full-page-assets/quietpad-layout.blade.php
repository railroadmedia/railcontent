@extends('drumeo.products.misc-products-layout')

@section('meta')
    <title>Drumeo QuietPad</title>
    <meta name="description" content="Practice anywhere with two full-size playing surfaces.">
    <meta property="og:image" content="https://dpwjbsxqtam5n.cloudfront.net/drum-shop/quietpad/og-image.jpg" style="display: none;">
    <meta property="og:title" content="Drumeo QuietPad">
    <meta property="og:description" content="Practice anywhere with two full-size playing surfaces.">
    <meta property="og:url" content="https://www.drumeo.com/drumshop/quietpad/">
@stop()

@section('head')
    @parent
    <link href="{{ asset('/marketing/parcel/drumeo/quietpad.css') }}" rel="stylesheet">

    <?php \App\Analytics\Tracker::trackProductImpression('quietpad'); ?>
@stop()

@section('scripts')
    <script>
        $(document).ready(function () {
            $(document).foundation();

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
    <script src="{{ asset('/marketing/parcel/drumeo/modal-autoplay.js') }}"></script>
@stop()

@section('content')

    @include('drumeo.products.partials.promo-banner', [
                "name" => "Drumeo QuietPad",
                "fullPrice" => Prices::$quietPadFull,
                "price" => Prices::$quietPadRegular,
                "noBreadcrumb" => true
            ])

    <header class="header text-center">
        <div class="background-fade" style="background-image: url(https://dpwjbsxqtam5n.cloudfront.net/drum-shop/quietpad/header-snare-pad.jpg)"></div>
        <div class="background-fade" style="background-image: url(https://dpwjbsxqtam5n.cloudfront.net/drum-shop/quietpad/header-quiet-pad.jpg);"></div>
        <div class="row">
            <img class="logo show-for-medium" src="https://dpwjbsxqtam5n.cloudfront.net/drum-shop/quietpad/drumeo-quietpad.png">
            <br class="show-for-medium">
            <div class="watch-badge">
                <span>WATCH<br> THE DEMO</span>
                <img src="https://dpwjbsxqtam5n.cloudfront.net/sales/arrow-left-white.png">
            </div>
            <img data-open="previewModal" class="play-button autoplay-video" src="https://dpwjbsxqtam5n.cloudfront.net/sales/play-button.png">
            <br class="hide-for-medium">
            <img class="logo hide-for-medium" src="https://dpwjbsxqtam5n.cloudfront.net/drum-shop/quietpad/drumeo-quietpad.png">
            <h2><strong style="font-weight: 900;">Practice anywhere</strong> with two<br class="hide-for-medium"> full-size playing surfaces.</h2>
            @yield('button')
            @yield('prelaunch-text')
        </div>
        <div class="reveal large text-center" id="previewModal" data-reveal data-reset-on-close="false">
            <div class="flex-video widescreen vimeo">
                <iframe class="reset-on-close" src="" data-lazy-load-url="//player.vimeo.com/video/395000347?autoplay=1" frameborder="0" allowfullscreen allow="autoplay"></iframe>
            </div>
            @yield('button')
        </div>
    </header>

    <section class="content-section two-sides text-center">
        <div class="row">
            <h2><strong>One traditional side.<br class="hide-for-medium"> One quiet side.</strong></h2>
            <h5>The portable, double-sided practice pad<br class="hide-for-medium"> with different <br class="show-for-medium-only">volumes so you can<br class="hide-for-medium"> practice late into the night.</h5>
            <div class="pad-toggle">
                <div class="pad-details traditional active">
                    <img class="pad-icon" src="https://dpwjbsxqtam5n.cloudfront.net/drum-shop/quietpad/icon-sticks.png">
                    <img class="mobile-pad hide-for-medium" src="https://dpwjbsxqtam5n.cloudfront.net/drum-shop/quietpad/quiet-pad-regular.png">
                    <h5><strong>Traditional Surface</strong></h5>
                    <p>Durable. Realistic. Portable. The blue side offers a 12” playing surface, snare-like rebound, and everything you’d expect for every day practice. (You’ll love the hand-assembled quality.)</p>
                    <img class="arrow active show-for-medium" style="transform: scaleX(-1);" src="https://dpwjbsxqtam5n.cloudfront.net/drum-shop/quietpad/left-arrow.png">
                </div>
                <div class="pad-details quiet">
                    <img class="pad-icon" src="https://dpwjbsxqtam5n.cloudfront.net/drum-shop/quietpad/icon-moon.png">
                    <img class="mobile-pad hide-for-medium" src="https://dpwjbsxqtam5n.cloudfront.net/drum-shop/quietpad/quiet-pad.png">
                    <h5><strong>Quiet Surface</strong></h5>
                    <p>Shhhhhh. Avoid the tap-tappidy-tap complaints with our quiet side, up to 50% quieter than traditional pads and ideal for developing strength, endurance, and control. (You’ll love the way it feels.)</p>
                    <img class="arrow active show-for-medium" src="https://dpwjbsxqtam5n.cloudfront.net/drum-shop/quietpad/left-arrow.png">
                </div>
                <div class="pad-flipper flipped show-for-medium">
                    <div style="background-image:url(https://dpwjbsxqtam5n.cloudfront.net/drum-shop/quietpad/quiet-pad-regular.png);"><i class="fad fa-repeat hover-icon"></i></div>
                    <div style="background-image:url(https://dpwjbsxqtam5n.cloudfront.net/drum-shop/quietpad/quiet-pad.png);"><i class="fad fa-repeat hover-icon"></i></div>
                </div>
            </div>
        </div>
    </section>

    <section class="content-section together text-center">
        <div class="row">
            <h2><strong>Your two favorite<br class="hide-for-medium"> practice pads, together.</strong></h2>
            <img class="pad" src="https://dpwjbsxqtam5n.cloudfront.net/drum-shop/quietpad/side-pad.png">
            <div class="text-wrap">
                <p class="text-blue"><img src="https://dpwjbsxqtam5n.cloudfront.net/drum-shop/quietpad/blue-top-left-arrow.png"> Designed to feel like<br class="hide-for-medium"> your snare drum.</p>
                <p class="text-grey"><img src="https://dpwjbsxqtam5n.cloudfront.net/drum-shop/quietpad/blue-bottom-left-arrow.png"> For strength-building<br class="hide-for-medium"> or late-night practice.</p>
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
            <div class="video-pop autoplay-video" data-open="blindModal">
                <div class="watch-badge">
                    <span>WATCH<br> BLIND TEST</span>
                    <img src="https://dpwjbsxqtam5n.cloudfront.net/sales/arrow-left-white.png">
                </div>
                <img class="play-button" src="https://dpwjbsxqtam5n.cloudfront.net/sales/play-button.png">
                <img class="bg" src="https://dpwjbsxqtam5n.cloudfront.net/drum-shop/quietpad/blindfold-test-thumb.jpg">
            </div>
        </div>
        <div class="reveal large text-center" id="blindModal" data-reveal data-reset-on-close="false">
            <div class="flex-video widescreen vimeo">
                <iframe class="reset-on-close" src="" data-lazy-load-url="//player.vimeo.com/video/394999066?autoplay=1" frameborder="0" allowfullscreen allow="autoplay"></iframe>
            </div>
            @yield('button')
        </div>
    </section>

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

    <section class="content-section text-center comparison">
        <div class="row">
            <h2><strong>The everyday practice<br class="hide-for-medium"> pad for drummers.</strong></h2>
            <table>
                <tbody>
                <tr>
                    <td></td>
                    <td><img class="logo" src="https://dpwjbsxqtam5n.cloudfront.net/drum-shop/quietpad/drumeo-quietpad-white.png"></td>
                    <td>Evans RealFeel</td>
                    <td>Reflexx</td>
                    <td><a target="_blank" href="/drumshop/practice-pad-full" style="color:inherit;">Drumeo P4 <i class="fas fa-external-link"></i></a></td>
                </tr>
                <tr>
                    <td>Size</td>
                    <td>12”</td>
                    <td>12”</td>
                    <td>10”</td>
                    <td>12”</td>
                </tr>
                <tr>
                    <td>Playing Surfaces</td>
                    <td>2</td>
                    <td>1-2</td>
                    <td>2</td>
                    <td>4 (one side)</td>
                </tr>
                <tr>
                    <td>Snare-Like Size</td>
                    <td>12” x 12”</td>
                    <td></td>
                    <td></td>
                    <td>12” x 5”</td>
                </tr>
                <tr>
                    <td>Quiet Surface Size</td>
                    <td>12” x 12”</td>
                    <td></td>
                    <td></td>
                    <td>6” x 5”</td>
                </tr>
                <tr>
                    <td>Priorities</td>
                    <td>Quieter Practice<br>Realistic Feel<br>Portable</td>
                    <td>Durable<br>Portable<br>Affordable</td>
                    <td>Workout/Quiet<br>Portable<br>Portability</td>
                    <td>Practice Movement<br>Realistic Feel<br>Versatile</td>
                </tr>
                <tr>
                    <td>Hand Assembled</td>
                    <td><i class="fas fa-check-circle"></i></td>
                    <td></td>
                    <td></td>
                    <td><i class="fas fa-check-circle"></i></td>
                </tr>
                <tr>
                    <td>Made In The USA <i class="fad fa-flag-usa" style="font-size: inherit;margin-left: 3px;"></i></td>
                    <td><i class="fas fa-check-circle"></i></td>
                    <td></td>
                    <td></td>
                    <td><i class="fas fa-check-circle"></i></td>
                </tr>
                <tr>
                    <td>Worldwide Shipping</td>
                    <td><i class="fas fa-check-circle"></i></td>
                    <td></td>
                    <td></td>
                    <td><i class="fas fa-check-circle"></i></td>
                </tr>
                <tr>
                    <td></td>
                    <td>@yield('chart-price')</td>
                    <td><strong>$29</strong><br>+ SHIPPING</td>
                    <td><strong>$60</strong><br>+ SHIPPING</td>
                    <td>@if(Prices::$padFull > Prices::$padRegular)
                            <s>${{ Prices::$padFull }}</s>
                            <strong>${{ Prices::$padRegular }}</strong><br>+ SHIPPING
                        @else
                            <strong>${{ Prices::$padRegular }}</strong><br>+ SHIPPING
                        @endif</td>
                </tr>
                </tbody>
            </table>
        </div>
    </section>

    <section class="content-section final text-center">
        <div class="row">
            <img class="bubbles hide-for-medium" src="https://dpwjbsxqtam5n.cloudfront.net/drum-shop/quietpad/order-image-mobile.png">
            <img class="bubbles show-for-medium" src="https://dpwjbsxqtam5n.cloudfront.net/drum-shop/quietpad/order-image.png">
            <br>
            <img class="logo" src="https://dpwjbsxqtam5n.cloudfront.net/drum-shop/quietpad/drumeo-quietpad.png">


            @yield('bottom-price')
            @yield('button')

            <div class="credit-cards columns">
                <i class="fab fa-cc-visa"></i>
                <i class="fab fa-cc-mastercard"></i>
                <i class="fab fa-cc-amex"></i>
                <i class="fab fa-cc-paypal"></i>
                <i class="fab fa-cc-discover"></i>
            </div>
            <div class="columns questions">
                <p><strong>Any questions?</strong><br class="hide-for-medium"> Call us toll-free at
                    <a href="tel:+18004398921">1-800-439-8921</a> <br class="hide-for-medium"> or directly at
                    <a href="tel:+16048557605">1-604-855-7605</a>.<br> All prices listed in USD. </p>
            </div>
        </div>
    </section>
@stop
