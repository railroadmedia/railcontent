@extends('drumeo.products.misc-products-layout')

@section('meta')
    @parent
    <title>Tone Control Kit</title>
    <meta name="description" content="Better drum sounds in seconds.">
    <meta property="og:image" content="https://dpwjbsxqtam5n.cloudfront.net/drum-shop/tone-control-kit/og-image.jpg" style="display: none;">
    <meta property="og:title" content="Tone Control Kit">
    <meta property="og:description" content="Better drum sounds in seconds.">
    <meta property="og:url" content="https://www.drumeo.com/{{ Request::path() }}">
@stop()

@section('head')
    @parent
    <link href="{{ asset('/marketing/parcel/drumeo/tone-control-kit.css') }}" rel="stylesheet">

    <?php \App\Analytics\Tracker::trackProductImpression('tone-control-kit'); ?>
@stop()

@section('scripts')
    @parent
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.event.move/1.3.6/jquery.event.move.min.js"></script>
    <script>
        (function($){
            $.fn.twentytwenty = function(options) {
                var options = $.extend({
                    default_offset_pct: 0.5,
                    orientation: 'horizontal',
                    before_label: 'Before',
                    after_label: 'After',
                    no_overlay: true,
                    move_slider_on_hover: false,
                    move_with_handle_only: true,
                    click_to_move: false
                }, options);

                return this.each(function() {

                    var sliderPct = options.default_offset_pct;
                    var container = $(this);
                    var sliderOrientation = options.orientation;
                    var beforeDirection = (sliderOrientation === 'vertical') ? 'down' : 'left';
                    var afterDirection = (sliderOrientation === 'vertical') ? 'up' : 'right';


                    container.wrap("<div class='twentytwenty-wrapper twentytwenty-" + sliderOrientation + "'></div>");
                    if(!options.no_overlay) {
                        container.append("<div class='twentytwenty-overlay'></div>");
                        var overlay = container.find(".twentytwenty-overlay");
                        overlay.append("<div class='twentytwenty-before-label' data-content='"+options.before_label+"'></div>");
                        overlay.append("<div class='twentytwenty-after-label' data-content='"+options.after_label+"'></div>");
                    }
                    var beforeImg = container.find("img:first");
                    var afterImg = container.find("img:last");
                    container.append("<div class='twentytwenty-handle'></div>");
                    var slider = container.find(".twentytwenty-handle");
                    slider.append("<span class='twentytwenty-" + beforeDirection + "-arrow'></span>");
                    slider.append("<span class='twentytwenty-" + afterDirection + "-arrow'></span>");
                    container.addClass("twentytwenty-container");
                    beforeImg.addClass("twentytwenty-before");
                    afterImg.addClass("twentytwenty-after");

                    var calcOffset = function(dimensionPct) {
                        var w = beforeImg.width();
                        var h = beforeImg.height();
                        return {
                            w: w+"px",
                            h: h+"px",
                            cw: (dimensionPct*w)+"px",
                            ch: (dimensionPct*h)+"px"
                        };
                    };

                    var adjustContainer = function(offset) {
                        if (sliderOrientation === 'vertical') {
                            beforeImg.css("clip", "rect(0,"+offset.w+","+offset.ch+",0)");
                            afterImg.css("clip", "rect("+offset.ch+","+offset.w+","+offset.h+",0)");
                        }
                        else {
                            beforeImg.css("clip", "rect(0,"+offset.cw+","+offset.h+",0)");
                            afterImg.css("clip", "rect(0,"+offset.w+","+offset.h+","+offset.cw+")");
                        }
                        container.css("height", offset.h);
                    };

                    var adjustSlider = function(pct) {
                        var offset = calcOffset(pct);
                        slider.css((sliderOrientation==="vertical") ? "top" : "left", (sliderOrientation==="vertical") ? offset.ch : offset.cw);
                        adjustContainer(offset);
                    };

                    // Return the number specified or the min/max number if it outside the range given.
                    var minMaxNumber = function(num, min, max) {
                        return Math.max(min, Math.min(max, num));
                    };

                    // Calculate the slider percentage based on the position.
                    var getSliderPercentage = function(positionX, positionY) {
                        var sliderPercentage = (sliderOrientation === 'vertical') ?
                            (positionY-offsetY)/imgHeight :
                            (positionX-offsetX)/imgWidth;

                        return minMaxNumber(sliderPercentage, 0, 1);
                    };

                    $(window).on("resize.twentytwenty", function(e) {
                        adjustSlider(sliderPct);
                    });

                    var offsetX = 0;
                    var offsetY = 0;
                    var imgWidth = 0;
                    var imgHeight = 0;
                    var onMoveStart = function(e) {
                        if (((e.distX > e.distY && e.distX < -e.distY) || (e.distX < e.distY && e.distX > -e.distY)) && sliderOrientation !== 'vertical') {
                            e.preventDefault();
                        }
                        else if (((e.distX < e.distY && e.distX < -e.distY) || (e.distX > e.distY && e.distX > -e.distY)) && sliderOrientation === 'vertical') {
                            e.preventDefault();
                        }
                        container.addClass("active");
                        offsetX = container.offset().left;
                        offsetY = container.offset().top;
                        imgWidth = beforeImg.width();
                        imgHeight = beforeImg.height();
                    };
                    var onMove = function(e) {
                        if (container.hasClass("active")) {
                            sliderPct = getSliderPercentage(e.pageX, e.pageY);
                            adjustSlider(sliderPct);
                        }
                    };
                    var onMoveEnd = function() {
                        container.removeClass("active");
                    };

                    var moveTarget = options.move_with_handle_only ? slider : container;
                    moveTarget.on("movestart",onMoveStart);
                    moveTarget.on("move",onMove);
                    moveTarget.on("moveend",onMoveEnd);

                    if (options.move_slider_on_hover) {
                        container.on("mouseenter", onMoveStart);
                        container.on("mousemove", onMove);
                        container.on("mouseleave", onMoveEnd);
                    }

                    slider.on("touchmove", function(e) {
                        e.preventDefault();
                    });

                    container.find("img").on("mousedown", function(event) {
                        event.preventDefault();
                    });

                    if (options.click_to_move) {
                        container.on('click', function(e) {
                            offsetX = container.offset().left;
                            offsetY = container.offset().top;
                            imgWidth = beforeImg.width();
                            imgHeight = beforeImg.height();

                            sliderPct = getSliderPercentage(e.pageX, e.pageY);
                            adjustSlider(sliderPct);
                        });
                    }

                    $(window).trigger("resize.twentytwenty");
                });
            };

        })(jQuery);
    </script>
    <script>
        $(document).ready(function () {
            setTimeout(function() {
                $(".comparer").twentytwenty();
            }, 300);

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
                if(current < 3){
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
        });
    </script>
@stop()

@section('body-data')
    x-data="{ trailer: false }"
@endsection

@section('content')
    @include('_partials.components.shop.promo-banner-2', [
        "name" => "Tone Control Kit",
        "fullPrice" => floatval($productPrices['tone-control-kit']->price),
        "price" => floatval($productPrices['tone-control-kit']->discounted_price),
        "noBreadcrumb" => true
    ])

    <header class="header text-center">
        <video poster="https://dpwjbsxqtam5n.cloudfront.net/drum-shop/vater-sticks/header-thumbnail.jpg" src="https://dpwjbsxqtam5n.cloudfront.net/drum-shop/tone-control-kit/header.mp4" type="video/mp4" autoplay="" loop="" playsinline="" muted></video>
        <div class="overlay"></div>
        <div class="row">
            <img class="logo drumeo" src="https://www.musora.com/musora-cdn/image/quality=95,width=250,metadata=none/https://dpwjbsxqtam5n.cloudfront.net/logos/logo-blue.png" alt="Drumeo logo"><br>
            <img class="logo" src="https://dpwjbsxqtam5n.cloudfront.net/drum-shop/tone-control-kit/tone-control-kit-logo.png" alt="Tone control kit logo"><br>
            <div class="watch-badge">
                WATCH<br> THE DEMO
                <img src="https://dpwjbsxqtam5n.cloudfront.net/sales/arrow-left-white.png" alt="Left arrow">
            </div>
            <i @click="trailer = true;" class="fas fa-play play-button autoplay-video"></i>
            <br>
            <h1><strong>Better drum sounds<br class="hide-for-medium"> in seconds.</strong></h1>

            @if( $products['tone-control-kit']->getStockAvailability() > 1 && !empty($products['tone-control-kit']->getStockAvailability()))
                <a class="join blue" href="/ecommerce/add-to-cart?products[tone-control-kit]=1">Buy Now &raquo;</a>
            @else
                <a class="join sold-out">SOLD OUT</a>
            @endif

            <p>GET A 4-PACK FOR
                @if(floatval($productPrices['tone-control-kit']->price) > floatval($productPrices['tone-control-kit']->discounted_price))
                    ONLY <s style="opacity:0.6">${{ floatval($productPrices['tone-control-kit']->price) }}</s>
                    <strong class="text-yellow">
                        @if(number_format(floatval($productPrices['tone-control-kit']->discounted_price), 2) == intval(floatval($productPrices['tone-control-kit']->discounted_price)))
                            ${{  floatval($productPrices['tone-control-kit']->discounted_price)  }}
                        @else
                            ${{  number_format(floatval($productPrices['tone-control-kit']->discounted_price), 2)  }}
                        @endif
                    </strong> (SAVE {{ round(100 - (100 * (floatval($productPrices['tone-control-kit']->discounted_price) / floatval($productPrices['tone-control-kit']->price)))) }}%)
                @else
                    <strong class="text-yellow">ONLY ${{ floatval($productPrices['tone-control-kit']->discounted_price) }}.</strong>
                @endif
                {{--<br>LIMITED QUANTITIES--}}
            </p>
        </div>
    </header>

    @include('_partials.components.video-modal',[
        'name' => 'trailer',
        'video' => '475135304',
        'vimeo' => true,
    ])

    <section class="four-tones text-center">
        <div class="row">
            <h2><strong>Flexible drum tones<br class="hide-for-medium"> on the fly.</strong></h2>
            <p>You know the feeling. You’ve almost got your drums sounding <em>exactly</em> how you want, but there’s an uneven warble or obnoxious ring — these are called overtones. The Drumeo Tone Control Kit helps you <strong>balance overtones</strong> with four adjustable levels of dampening in one simple system.</p>

            <div class="swapper-container">
                <div class="large-image active" style="background-image:url(https://dpwjbsxqtam5n.cloudfront.net/drum-shop/tone-control-kit/level-studio.jpg);"></div>
                <div class="large-image" style="background-image:url(https://dpwjbsxqtam5n.cloudfront.net/drum-shop/tone-control-kit/level-home.jpg);"></div>
                <div class="large-image" style="background-image:url(https://dpwjbsxqtam5n.cloudfront.net/drum-shop/tone-control-kit/level-club.jpg);"></div>
                <div class="large-image" style="background-image:url(https://dpwjbsxqtam5n.cloudfront.net/drum-shop/tone-control-kit/level-arena.jpg);"></div>
            </div>
            <div class="swapper-nav">
                <div data-thumb="https://dpwjbsxqtam5n.cloudfront.net/drum-shop/tone-control-kit/level-studio.jpg" class="slide-button active">Studio</div>
                <div data-thumb="https://dpwjbsxqtam5n.cloudfront.net/drum-shop/tone-control-kit/level-home.jpg" class="slide-button">Home</div>
                <div data-thumb="https://dpwjbsxqtam5n.cloudfront.net/drum-shop/tone-control-kit/level-club.jpg" class="slide-button">Club</div>
                <div data-thumb="https://dpwjbsxqtam5n.cloudfront.net/drum-shop/tone-control-kit/level-arena.jpg" class="slide-button">Arena</div>
            </div>
        </div>
    </section>

    <section class="comparison-slider text-center">
        <div class="row">
            <h2><strong>Cleaner than Buddy’s<br class="hide-for-medium"> double strokes.</strong></h2>
            <p>The Drumeo Tone Control Kit is the cleanest solution to drum dampening— so your drum heads can be spared the oily residues and sticky messes from traditional dampening methods.</p>
        </div>
        <div class='comparer'>
            <img src="https://dpwjbsxqtam5n.cloudfront.net/drum-shop/tone-control-kit/compare-clean.jpg" alt="Clean drum">
            <img src="https://dpwjbsxqtam5n.cloudfront.net/drum-shop/tone-control-kit/compare-dirty.jpg" alt="Dirty drum">
        </div>
    </section>

    <section class="text-center three-point">
        <div class="row">
            <div class="benefit">
                <video type="video/mp4" autoplay="" loop="" playsinline="" muted src="https://dpwjbsxqtam5n.cloudfront.net/drum-shop/tone-control-kit/dreams-breathe.mp4"></video>
                <div class="text medium-text-left">
                    <h2><strong>Let your drums breathe.</strong></h2>
                    <p>Because the Tone Control Kit doesn't stick to the surface of your drumheads, the head gets a chance to <em>breathe</em> between strokes, retaining its natural pitch & feel.</p>
                </div>
            </div>
            <div class="benefit">
                <img src="https://dpwjbsxqtam5n.cloudfront.net/drum-shop/tone-control-kit/2-set-it-forget-it.jpg" alt="Drum set">
                <div class="text medium-text-left">
                    <h2><strong>Set it and forget it —<br> Drummer’s Edition.</strong></h2>
                    <p>Each Tone Control strip securely fastens to any metal hoop and can be left on during transport. No more worrying about that perfectly placed gel or tape falling off. </p>
                </div>
            </div>
            <div class="benefit">
                <img src="https://dpwjbsxqtam5n.cloudfront.net/drum-shop/tone-control-kit/3-maintenance.jpg" alt="Tone control kit">
                <div class="text medium-text-left">
                    <h2><strong>Zero maintenance.</strong></h2>
                    <p>The Tone Control Kit is made of durable leather & magnets that won’t wear out, get dirty, or get thrown out with your drum heads.</p>
                </div>
            </div>
        </div>
    </section>

    <section class="text-center all-in-one">
        <div class="noise-wrap">
            <div class="row">
                <h2><strong>The all-in-one kit.</strong></h2>
                <div class="pic-wrap">
                    <div class="pic-section">
                        <img class="img-modal" data-slide="0" src="https://dpwjbsxqtam5n.cloudfront.net/drum-shop/tone-control-kit/all-in-one-package.jpg" alt="tone control kit package">
                        <img class="img-modal" data-slide="1" src="https://dpwjbsxqtam5n.cloudfront.net/drum-shop/tone-control-kit/all-in-one-case.jpg" alt="All in one case">
                    </div>
                    <div class="pic-section bigger">
                        <img class="img-modal" data-slide="2" src="https://dpwjbsxqtam5n.cloudfront.net/drum-shop/tone-control-kit/all-in-one-family.jpg" alt="Family kit">
                    </div>
                    <div class="pic-section">
                        <img class="img-modal" data-slide="3" src="https://dpwjbsxqtam5n.cloudfront.net/drum-shop/tone-control-kit/all-in-one-toms.jpg" alt="Toms ki">
                        <img class="img-modal" data-slide="4" src="https://dpwjbsxqtam5n.cloudfront.net/drum-shop/tone-control-kit/all-in-one-snare.jpg" alt="Sharable kit">
                    </div>
                </div>
                <div class="table-wrap">
                    <p>The Drumeo Tone Control Kit includes a snare + three tom dampeners, and one handy canvas carrying case — everything you need to make your kit sing.</p>
                    <table>
                        <tr>
                            <td>Snare dampener</td>
                            <td>1</td>
                        </tr>
                        <tr>
                            <td>Tom dampeners</td>
                            <td>3</td>
                        </tr>
                        <tr>
                            <td>Carrying Case</td>
                            <td><i class="fa-light fa-check"></i></td>
                        </tr>
                        <tr>
                            <td>Cost</td>
                            <td>
                                @if(floatval($productPrices['tone-control-kit']->price) > floatval($productPrices['tone-control-kit']->discounted_price))
                                    <s>${{ floatval($productPrices['tone-control-kit']->price) }}</s><br>
                                @endif
                                ${{ floatval($productPrices['tone-control-kit']->discounted_price) }}</td>
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
                    <div class="image" style="background-image:url(https://dpwjbsxqtam5n.cloudfront.net/drum-shop/tone-control-kit/all-in-one-package.jpg);"></div>
                </div>
                <div class="review-slide">
                    <div class="image" style="background-image:url(https://dpwjbsxqtam5n.cloudfront.net/drum-shop/tone-control-kit/all-in-one-case.jpg);"></div>
                </div>
                <div class="review-slide">
                    <div class="image" style="background-image:url(https://dpwjbsxqtam5n.cloudfront.net/drum-shop/tone-control-kit/all-in-one-family.jpg);padding-bottom: 69.5%;"></div>
                </div>
                <div class="review-slide">
                    <div class="image" style="background-image:url(https://dpwjbsxqtam5n.cloudfront.net/drum-shop/tone-control-kit/all-in-one-toms.jpg);"></div>
                </div>
                <div class="review-slide">
                    <div class="image" style="background-image:url(https://dpwjbsxqtam5n.cloudfront.net/drum-shop/tone-control-kit/all-in-one-snare.jpg);"></div>
                </div>
                <div class="arrow scroll-left"><i class="fas fa-chevron-left"></i></div>
                <div class="arrow scroll-right"><i class="fas fa-chevron-right"></i></div>
            </div>
        </div>
    </div>

    <section class="final" style="background-image:url(https://dpwjbsxqtam5n.cloudfront.net/drum-shop/tone-control-kit/order-section-background.jpg);">
        <div id="customize-anchor" class="anchor"></div>
        <div class="row">
            <div class="columns">
                <img class="logo drumeo" src="https://www.musora.com/musora-cdn/image/quality=95,width=250,metadata=none/https://dpwjbsxqtam5n.cloudfront.net/logos/logo-blue.png" alt="Drume logo"><br>
                <img class="logo" src="https://dpwjbsxqtam5n.cloudfront.net/drum-shop/tone-control-kit/tone-control-kit-logo.png" alt="Tone control kit logo">

                <h2 class="uppercase">
                    GET A 4-PACK FOR
                    @if(floatval($productPrices['tone-control-kit']->price) > floatval($productPrices['tone-control-kit']->discounted_price))
                        ONLY <s style="opacity:0.6">${{ floatval($productPrices['tone-control-kit']->price) }}</s>
                        <strong class="text-yellow">
                            @if(number_format(floatval($productPrices['tone-control-kit']->discounted_price), 2) == intval(floatval($productPrices['tone-control-kit']->discounted_price)))
                                ${{  floatval($productPrices['tone-control-kit']->discounted_price)  }}
                            @else
                                ${{  number_format(floatval($productPrices['tone-control-kit']->discounted_price), 2)  }}
                            @endif
                        </strong> (SAVE {{ round(100 - (100 * (floatval($productPrices['tone-control-kit']->discounted_price) / floatval($productPrices['tone-control-kit']->price)))) }}%)
                    @else
                        <strong class="text-yellow">ONLY ${{ floatval($productPrices['tone-control-kit']->discounted_price) }}.</strong>
                    @endif
                    {{--<br>LIMITED QUANTITIES--}}
                </h2>
                <div class="columns">
                    @if( $products['tone-control-kit']->getStockAvailability() > 1 && !empty($products['tone-control-kit']->getStockAvailability()))
                        <a class="join blue" href="/ecommerce/add-to-cart?products[tone-control-kit]=1">Buy Now &raquo;</a>
                    @else
                        <a class="join sold-out">SOLD OUT</a>
                    @endif
                </div>

                <div class="credit-cards">
                    <i class="fab fa-cc-visa"></i>
                    <i class="fab fa-cc-mastercard"></i>
                    <i class="fab fa-cc-amex"></i>
                    <i class="fab fa-cc-paypal"></i>
                    <i class="fab fa-cc-discover"></i>
                </div>
                <div class="questions">
                    <p><strong>Any questions?</strong><br class="hide-for-medium"> Call us toll-free at
                        <a href="tel:+18004398921">1-800-439-8921</a> <br class="hide-for-medium"> or directly at
                        <a href="tel:+16048557605">1-604-855-7605</a>.<br> All prices listed in USD. </p>
                </div>
            </div>
        </div>
    </section>
@stop
