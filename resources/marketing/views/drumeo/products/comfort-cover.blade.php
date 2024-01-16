@extends('drumeo.products.misc-products-layout')

@section('meta')
    @parent
    <title>Drumeo Comfort Cover</title>
    <meta name="description" content="Upgrade any round drum throne in seconds.">
    <meta property="og:image" content="https://dpwjbsxqtam5n.cloudfront.net/drum-shop/comfort-cover/fb-share-image.jpg" style="display: none;">
    <meta property="og:title" content="Comfort Cover">
    <meta property="og:description" content="Upgrade any round drum throne in seconds.">
    <meta property="og:url" content="https://www.drumeo.com/{{ Request::path() }}">

    <link rel="stylesheet" href="{{ mix('marketing/css/app.css') }}">
@stop()

@section('head')
    @parent
    <link href="{{ asset('/marketing/parcel/drumeo/comfort-cover.css') }}" rel="stylesheet">

    <?php \App\Analytics\Tracker::trackProductImpression('comfort-cover'); ?>
@stop()

@section('scripts')
    @parent
    <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/lazysizes/5.3.2/lazysizes.min.js"></script>
    <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/lazysizes/5.3.2/plugins/unveilhooks/ls.unveilhooks.min.js"></script>
    <script>
        $(document).ready(function () {
            // featured post header slider
            var $thumbNav = $('.slide-button'),
                $imageSwap = $('.swapper-container .large-image');

            var current = 0;

            $thumbNav.first().addClass('active');

            var updateIndex = function (current) {
                $thumbNav.removeClass('active');
                $thumbNav.eq(current).addClass('active');

                $imageSwap.removeClass('active');
                $imageSwap.eq(current).addClass('active');
            };

            var autoplay = setInterval(function () {
                if(current < 2){
                    current++;
                    updateIndex(current);
                }
                else {
                    current = 0;
                    updateIndex(current);
                }
            }, 3000);

            $thumbNav.on('click', function (e) {
                e.stopPropagation();
                e.preventDefault();
                updateIndex($thumbNav.index($(this)));
                current = $thumbNav.index($(this));
                clearInterval(autoplay);
            });


            // Functions for slider
            var thumbnail = $('.img-modal');
            var sliderOverlay = $('.slider-overlay');
            var sliderLightbox = $('.slider-lightbox');

            thumbnail.click(function () {
                currentSlide = $(this).data('slide');
                sliderLightbox.addClass('active');
                sliderOverlay.addClass('active');

                giveSlidesClass();
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
                if (currentSlide === 0) {
                    scrollLeftElement.removeClass('active');
                } else {
                    scrollLeftElement.addClass('active');
                }

                if (currentSlide === slidesElement.length - 1) {
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


            // Dropdown for FAQ section
            $('.question-dropdown').on('click', questionDropdown);

            function questionDropdown() {
                $(this).toggleClass('active');
                $(this).find('.fa-chevron-down').toggleClass('rotated');
            }
        });
    </script>
    <script src="{{ asset('/marketing/js/modal-autoplay.js') }}"></script>
@stop()

@section('body-data')
    x-data="{ trailer: false }"
@endsection

@section('content')
    @include('_partials.components.shop.promo-banner', [
        "name" => "Comfort Cover",
        "fullPrice" => floatval($productPrices['comfort-cover']->price),
        "price" => floatval($productPrices['comfort-cover']->discounted_price),
        "noBreadcrumb" => true
    ])

    <header class="header text-center">
        <video poster="https://www.musora.com/musora-cdn/image/width=1000,quality=95/https://dpwjbsxqtam5n.cloudfront.net/drum-shop/comfort-cover/header-background.jpg" src="https://dpwjbsxqtam5n.cloudfront.net/drum-shop/comfort-cover/header.mp4" type="video/mp4" autoplay="" loop="" playsinline="" muted></video>
        <div class="overlay"></div>
        <div class="row">
            <img class="logo" src="https://www.musora.com/musora-cdn/image/width=740,quality=95/https://dpwjbsxqtam5n.cloudfront.net/drum-shop/comfort-cover/comfort-cover-logo-w-drumart.png" alt="Comfort cover logo"><br>
            <div class="watch-badge">
                WATCH<br> THE DEMO
                <img src="https://dpwjbsxqtam5n.cloudfront.net/sales/arrow-left-white.png" alt="Left arrow">
            </div>
            <i @click="trailer = true;" class="fas fa-play play-button autoplay-video"></i>
            <br>
            <h1><strong>Upgrade your drum<br class="hide-for-medium"> throne in seconds.</strong></h1>
            {{--            @if($products['comfort-cover']->getStockAvailability() > 0)--}}
{{--            <a class="join blue" href="/ecommerce/add-to-cart?products[comfort-cover]=1">Get Comfy &raquo;</a>--}}
            {{--@else--}}
            <a class="join blue sold-out">Sold Out</a>
            {{--@endif--}}
            <p>
                @if(floatval($productPrices['comfort-cover']->price) > floatval($productPrices['comfort-cover']->discounted_price))
                    <s style="opacity: 0.6;">NORMALLY ${{ floatval($productPrices['comfort-cover']->price) }}</s>
                    <strong class="text-yellow">
                        ONLY ${{ number_format(floatval($productPrices['comfort-cover']->discounted_price), 2) }}
                    </strong>
                @else
                    <strong class="text-yellow">ONLY ${{ number_format(floatval($productPrices['comfort-cover']->discounted_price), 2) }}.</strong>
                @endif
            </p>
        </div>
    </header>

    @component('_partials.components.video-modal',[
        'name' => 'trailer',
        'video' => '510872818',
        'vimeo' => true,
    ])
    @endcomponent

    <section class="content-section coaches-info text-center lazyload" data-bg="https://www.musora.com/musora-cdn/image/width=1500,quality=85/https://dpwjbsxqtam5n.cloudfront.net/drum-shop/comfort-cover/spread-background.jpg">
        <div class="container mx-auto relative z-10">
            <h2><strong>The best seat <br class="hide-for-medium"> in the house.</strong></h2>
            <div class="text-section text-center relative z-10">
                <img alt="Comfort cover spread" class="lazyload" data-src="https://www.musora.com/musora-cdn/image/width=1300,quality=95/https://dpwjbsxqtam5n.cloudfront.net/drum-shop/comfort-cover/comfort-cover-spread.png">
                <p class="text-left">As a drummer, you’re ALWAYS sitting.
                    <br><br>
                    Through every practice, rehearsal and gig, you’re constantly confined to your drum throne. Sometimes it’s great — you have a built in place to chill out. But other times, it’s NOT.
                    <br><br>
                    Like when you hop on the drums after a long day sitting at work or in traffic and you just want to do the thing you love without nagging back, hip, or butt pain.
                    <br><br>
                    That’s why the fine folks at Drum Art created the Drumeo Comfort Cover.
                    <br><br>
                    Designed specifically for drummers, the Comfort Cover absorbs shock, distributes your weight evenly, and improves your posture behind the drums — instantly giving you a comfier, healthier, better drumming experience.
                </p>
            </div>
        </div>
    </section>

    <section class="four-tones text-center">
        <div class="row">
            <h2><strong>One size fits any<br class="hide-for-medium"> round drum throne.</strong></h2>
            <p>From the flimsy seat that came with your e-kit, to that beefy upgraded throne the
                pros use, the Comfort Cover gives <em>any</em> round drum seat a much-needed boost.</p>

            <div class="swapper-container">
                <div class="large-image lazyload active" data-bg="https://www.musora.com/musora-cdn/image/width=2800,quality=95/https://dpwjbsxqtam5n.cloudfront.net/drum-shop/comfort-cover/compare-small.jpg"></div>
                <div class="large-image lazyload" data-bg="https://www.musora.com/musora-cdn/image/width=2800,quality=95/https://dpwjbsxqtam5n.cloudfront.net/drum-shop/comfort-cover/compare-medium.jpg"></div>
                <div class="large-image lazyload" data-bg="https://www.musora.com/musora-cdn/image/width=2800,quality=95/https://dpwjbsxqtam5n.cloudfront.net/drum-shop/comfort-cover/compare-large.jpg"></div>
            </div>
            <div class="swapper-nav">
                <div data-thumb="https://www.musora.com/musora-cdn/image/width=2800,quality=95/https://dpwjbsxqtam5n.cloudfront.net/drum-shop/comfort-cover/compare-small.jpg" class="slide-button active">Small</div>
                <div data-thumb="https://www.musora.com/musora-cdn/image/width=2800,quality=95/https://dpwjbsxqtam5n.cloudfront.net/drum-shop/comfort-cover/compare-medium.jpg" class="slide-button">Medium</div>
                <div data-thumb="https://www.musora.com/musora-cdn/image/width=2800,quality=95/https://dpwjbsxqtam5n.cloudfront.net/drum-shop/comfort-cover/compare-large.jpg" class="slide-button">Large</div>
            </div>
            <div class="three-point">
                <div class="columns medium-4">
                    {{--<i class="fas fa-hands-heart"></i>--}}
                    <img class="lazyload" data-src="https://www.musora.com/musora-cdn/image/width=160,quality=95/https://dpwjbsxqtam5n.cloudfront.net/drum-shop/comfort-cover/icon-hand-made.png" alt="Handmade icon">
                    <h4><strong>HAND-MADE QUALITY </strong></h4>
                    <p>
                        Every Comfort Cover is hand-made in Italy with a cool, breathable gel that conforms to your body for maximum comfort.
                    </p>
                </div>
                <div class="columns medium-4">
                    {{--<i class="fas fa-heartbeat"></i>--}}
                    <img class="lazyload" data-src="https://www.musora.com/musora-cdn/image/width=160,quality=95/https://dpwjbsxqtam5n.cloudfront.net/drum-shop/comfort-cover/icon-ergonomic.png" alt="Ergonomic icon">
                    <h4><strong>ERGONOMIC DESIGN </strong></h4>
                    <p>
                        Absorbs shock, distributes weight evenly, and improves your posture. Long playing sessions have never felt better!
                    </p>
                </div>
                <div class="columns medium-4">
                    {{--<i class="fas fa-stopwatch"></i>--}}
                    <img class="lazyload" data-src="https://www.musora.com/musora-cdn/image/width=160,quality=95/https://dpwjbsxqtam5n.cloudfront.net/drum-shop/comfort-cover/icon-10-second.png" alt="Time icon">
                    <h4><strong>10 SECOND SET UP </strong></h4>
                    <p>
                        The Comfort Cover easily folds up and can be taken to any of your gigs or rehearsals — making every drum throne feel like home.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <section class="text-center all-in-one">
        <div class="noise-wrap">
            <div class="row">
                <h2><strong>Save your butt.</strong></h2>
                <div class="pic-wrap">
                    <div class="pic-section">
                        <img class="img-modal lazyload" data-slide="0" data-src="https://www.musora.com/musora-cdn/image/width=1500,quality=95/https://dpwjbsxqtam5n.cloudfront.net/drum-shop/comfort-cover/cc-photo-front.jpg" alt="Front photo">
                        <img class="img-modal lazyload" data-slide="1" data-src="https://www.musora.com/musora-cdn/image/width=1500,quality=95/https://dpwjbsxqtam5n.cloudfront.net/drum-shop/comfort-cover/cc-photo-under.jpg" alt="Under photo">
                    </div>
                    <div class="pic-section bigger">
                        <img class="img-modal lazyload" data-slide="2" data-src="https://www.musora.com/musora-cdn/image/width=1500,quality=95/https://dpwjbsxqtam5n.cloudfront.net/drum-shop/comfort-cover/cc-photo-main-sit.jpg" alt="Main sit photo">
                    </div>
                    <div class="pic-section">
                        <img class="img-modal lazyload" data-slide="3" data-src="https://www.musora.com/musora-cdn/image/width=1500,quality=95/https://dpwjbsxqtam5n.cloudfront.net/drum-shop/comfort-cover/cc-photo-italy.jpg" alt="Italy photo">
                        <img class="img-modal lazyload" data-slide="4" data-src="https://www.musora.com/musora-cdn/image/width=1500,quality=95/https://dpwjbsxqtam5n.cloudfront.net/drum-shop/comfort-cover/cc-photo-top.jpg" alt="Top photo">
                    </div>
                </div>
                <div class="table-wrap">
                    <p>The Comfort Cover gives you a consistent foundation every time (and everywhere) you sit down to play the drums — so you can play longer, harder, and in total comfort.</p>
                    <table>
                        <tr>
                            <td>Portable</td>
                            <td><i class="fa-light fa-check"></i></td>
                        </tr>
                        <tr>
                            <td>Hand-stitched</td>
                            <td><i class="fa-light fa-check"></i></td>
                        </tr>
                        <tr>
                            <td>Made In Italy</td>
                            <td><i class="fa-light fa-check"></i></td>
                        </tr>
                        <tr>
                            <td>Cost</td>
                            <td> @if(floatval($productPrices['comfort-cover']->price) > floatval($productPrices['comfort-cover']->discounted_price))
                                    <s>${{ floatval($productPrices['comfort-cover']->price) }}</s><br>
                                @endif
                                ${{ number_format(floatval($productPrices['comfort-cover']->discounted_price), 2) }}</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </section>

    <div class="slider-overlay">
        <div class="slider-lightbox">
            <div class="row">
                <div class="review-slide">
                    <div class="image lazyload" data-bg="https://www.musora.com/musora-cdn/image/width=1500,quality=95/https://dpwjbsxqtam5n.cloudfront.net/drum-shop/comfort-cover/cc-photo-front.jpg"></div>
                </div>
                <div class="review-slide">
                    <div class="image lazyload" data-bg="https://www.musora.com/musora-cdn/image/width=1500,quality=95/https://dpwjbsxqtam5n.cloudfront.net/drum-shop/comfort-cover/cc-photo-under.jpg"></div>
                </div>
                <div class="review-slide">
                    <div class="image lazyload" data-bg="https://www.musora.com/musora-cdn/image/width=1500,quality=95/https://dpwjbsxqtam5n.cloudfront.net/drum-shop/comfort-cover/cc-photo-main-sit.jpg" style="padding-bottom: 69.5%;"></div>
                </div>
                <div class="review-slide">
                    <div class="image lazyload" data-bg="https://www.musora.com/musora-cdn/image/width=1500,quality=95/https://dpwjbsxqtam5n.cloudfront.net/drum-shop/comfort-cover/cc-photo-italy.jpg"></div>
                </div>
                <div class="review-slide">
                    <div class="image lazyload" data-bg="https://www.musora.com/musora-cdn/image/width=1500,quality=95/https://dpwjbsxqtam5n.cloudfront.net/drum-shop/comfort-cover/cc-photo-top.jpg"></div>
                </div>
                <div class="arrow scroll-left"><i class="fas fa-chevron-left"></i></div>
                <div class="arrow scroll-right"><i class="fas fa-chevron-right"></i></div>
            </div>
        </div>
    </div>

    <section class="final lazyload" data-bg="https://www.musora.com/musora-cdn/image/width=2000,quality=95/https://dpwjbsxqtam5n.cloudfront.net/drum-shop/comfort-cover/order-background.jpg">
        <div id="customize-anchor" class="anchor"></div>
        <div class="row">
            <img class="logo" src="https://www.musora.com/musora-cdn/image/width=740,quality=95/https://dpwjbsxqtam5n.cloudfront.net/drum-shop/comfort-cover/comfort-cover-logo-w-drumart.png" alt="Comfort cover logo"><br>
            <h1><strong>Upgrade your drum<br class="hide-for-medium"> throne in seconds.</strong></h1>
            {{--            @if($products['comfort-cover']->getStockAvailability() > 0)--}}
{{--            <a href="/ecommerce/add-to-cart?products[comfort-cover]=1" class="join blue">Get Comfy &raquo;</a>--}}
            {{--@else--}}
            <a class="join blue sold-out">Sold Out</a>
            {{--@endif--}}
            <p>@if(floatval($productPrices['comfort-cover']->price) > floatval($productPrices['comfort-cover']->discounted_price))
                    <s style="opacity: 0.6;">NORMALLY ${{ floatval($productPrices['comfort-cover']->price) }}</s>
                    <strong class="text-yellow">
                        ONLY ${{ number_format(floatval($productPrices['comfort-cover']->discounted_price), 2) }}
                    </strong>
                @else
                    <strong class="text-yellow">ONLY ${{ number_format(floatval($productPrices['comfort-cover']->discounted_price), 2) }}.</strong>
                @endif
            </p>

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

    <section class="py-8 md:py-15 lg:py-16 px-4 lg:px-0 text-center">
        <div class="noise-wrap">
            <div class="row">
                <h2 class="mb-10"><strong>Still have questions?</strong></h2>

                @include('_partials.components.question-dropdown', [
                "num" => "?",
                "title" => "Does the Comfort Cover fit a tractor style seat?",
                "desc" => "No. The Comfort Cover slides over any <strong>round</strong> drum throne, but unfortunately no other shapes at this time. ",
                ])
                @include('_partials.components.question-dropdown', [
                "num" => "?",
                "title" => "Can I get a Comfort Cover shipped to [ <em>insert country other than USA</em> ]?",
                "desc" => "Yes. The Comfort Cover is changing the world one cushier tushy at a time. International shipping is available with varying rates by region. You will see your total shipping charge listed upon checkout.",
                ])
                @include('_partials.components.question-dropdown', [
                "num" => "?",
                "title" => "Will the Comfort Cover replace my existing throne?",
                "desc" => "No! The Comfort Cover upgrades your existing round drum throne to a more comfortable drumming experience. Just slide it over top and start playing — you’re ready to go in seconds.",
                ])
            </div>
        </div>
    </section>
@stop
