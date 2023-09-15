@extends('pianote._partials.global-layout')

@section('global-head')
    @parent

    <title>Pianote Music Theory Poster Bundle | Pianote</title>
    <meta property="og:title" content="Pianote Music Theory Poster Bundle | Pianote">

    <meta property="description" content="6 beautiful full-color posters highlighting the essential theory you need to play the songs you love. You’ll understand the Circle of 5ths, be able to read notes, and play every major and minor chord and scale with the Music Theory Poster Bundle.">
    <meta property="og:description" content="6 beautiful full-color posters highlighting the essential theory you need to play the songs you love. You’ll understand the Circle of 5ths, be able to read notes, and play every major and minor chord and scale with the Music Theory Poster Bundle.">

    <meta property="og:url" content="https://www.pianote.com/shop/theory-poster-bundle" />
    <meta property="og:image" content="https://d1fyshwdvi6fth.cloudfront.net/Pianote/Meta-images/c8053b11-c400-4618-9322-3d0965d74759-Pianote-Poster-Bundle-01.jpg">

    @include('_partials.layout._fonts')
    <link rel="stylesheet" href="{{ mix('marketing/css/app.css') }}">
    <link href="{{ asset('/marketing/css/tailwind-helpers.css') }}" rel="stylesheet">
    <link href="{{ asset('/marketing/parcel/drumeo/nav-footer-pianote.css') }}" rel="stylesheet">
    <link href="{{ asset('/marketing/parcel/drumeo/30dd.css') }}" rel="stylesheet">

    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.min.css" />
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick-theme.min.css" />
    <link href="{{ asset('/marketing/parcel/drumeo/drum-shop-product.css') }}" rel="stylesheet">
    <style>
        .pack-details .slider-container .slider-nav .slick-slide.slick-current img {
            border-color: #f61a30                          !important;
        }
    </style>
@stop()

@section('global-body')
    @include('pianote.sales.partials._nav', [
         "cartVersion" => true,
         'shopToMusora' => false,
    ])

    <main class="flex flex-col w-full ">
        <div class="clearfix container mx-auto max-w-6xl">
            <div class="lg:flex">
                <div class="product-wrap lg:w-2/3 px-3 md:px-4">
                    <div class="pack-details slider-wrap w-full pt-5 mx-auto mb-1 md:pt-9 md:mt-2 lg:pt-11 lg:mt-5">
                        <div class="text-center pb-5 sm:pb-6 lg:pb-7">
                            <div class="clearfix">
                                <div class="w-full">
                                    <div class="text-xl md:text-3xl lg:text-4xl leading-none font-bold">Piano Practice Just Got Easier</div>
                                </div>
                            </div>
                        </div>
                        <div class="slider-container overflow-hidden w-full mb-5 md:mb-7" style="font-size: 0;">
                            <div class="slider-for overflow-hidden  rounded ">
                                <div style="display: none;">
                                    <img class="w-full" src="https://www.musora.com/musora-cdn/image/width=1400,quality=95/https://d1fyshwdvi6fth.cloudfront.net/Pianote/Meta-images/c8053b11-c400-4618-9322-3d0965d74759-Pianote-Poster-Bundle-01.jpg" alt="slide image 1">
                                </div>
                                <div style="display: none;">
                                    <img class="w-full" src="https://www.musora.com/musora-cdn/image/width=1400,quality=95/https://pianote.s3.amazonaws.com/products/chords-and-scales-book/2021-12-23-Pianote-Chords-Scales-111.jpg" alt="slide image 7">
                                </div>
                                <div style="display: none;">
                                    <img class="w-full" src="https://www.musora.com/musora-cdn/image/width=1400,quality=95/https://d2vyvo0tyx8ig5.cloudfront.net/shop/products/practice-planner/pp-front-cover.jpg" alt="slide image 2">
                                </div>
                                <div style="display: none;">
                                    <img class="w-full" src="https://www.musora.com/musora-cdn/image/width=1400,quality=95/https://d1fyshwdvi6fth.cloudfront.net/ImageSlides/dfee81ef-ecae-4bf4-ab83-893114a7a1b7-Pianote-Poster-Bundle-03.jpg" alt="slide image 2">
                                </div>
                                <div style="display: none;">
                                    <img class="w-full" src="https://www.musora.com/musora-cdn/image/width=1400,quality=95/https://d1fyshwdvi6fth.cloudfront.net/ImageSlides/dfee81ef-ecae-4bf4-ab83-893114a7a1b7-Pianote-Poster-Bundle-04.jpg" alt="slide image 3">
                                </div>
                                <div style="display: none;">
                                    <img class="w-full" src="https://www.musora.com/musora-cdn/image/width=1400,quality=95/https://d1fyshwdvi6fth.cloudfront.net/ImageSlides/dfee81ef-ecae-4bf4-ab83-893114a7a1b7-Pianote-Poster-Bundle-05.jpg" alt="slide image 4">
                                </div>
                                <div style="display: none;">
                                    <img class="w-full" src="https://www.musora.com/musora-cdn/image/width=1400,quality=95/https://d1fyshwdvi6fth.cloudfront.net/ImageSlides/dfee81ef-ecae-4bf4-ab83-893114a7a1b7-Pianote-Poster-Bundle-06.jpg" alt="slide image 5">
                                </div>
                                <div style="display: none;">
                                    <img class="w-full" src="https://www.musora.com/musora-cdn/image/width=1400,quality=95/https://d1fyshwdvi6fth.cloudfront.net/ImageSlides/dfee81ef-ecae-4bf4-ab83-893114a7a1b7-Pianote-Poster-Bundle-07.jpg" alt="slide image 6">
                                </div>
                                <div style="display: none;">
                                    <img class="w-full" src="https://www.musora.com/musora-cdn/image/width=1400,quality=95/https://d1fyshwdvi6fth.cloudfront.net/ImageSlides/dfee81ef-ecae-4bf4-ab83-893114a7a1b7-Pianote-Poster-Bundle-08.jpg" alt="slide image 7">
                                </div>
                            </div>
                            <div class="slider-nav mx-auto w-full ">
                                <div style="display: none;"><img class="w-full rounded border-4 border-solid w-full" style="border-color: #FFF;" src="https://www.musora.com/musora-cdn/image/width=1400,quality=95/https://d1fyshwdvi6fth.cloudfront.net/Pianote/Meta-images/c8053b11-c400-4618-9322-3d0965d74759-Pianote-Poster-Bundle-01.jpg" alt="slide image 7"></div>
                                <div style="display: none;"><img class="w-full rounded border-4 border-solid w-full" style="border-color: #FFF;" src="https://www.musora.com/musora-cdn/image/width=1400,quality=95/https://pianote.s3.amazonaws.com/products/chords-and-scales-book/2021-12-23-Pianote-Chords-Scales-111.jpg" alt="slide image 7"></div>
                                <div style="display: none;"><img class="w-full rounded border-4 border-solid w-full" style="border-color: #FFF;" src="https://www.musora.com/musora-cdn/image/width=1400,quality=95/https://d2vyvo0tyx8ig5.cloudfront.net/shop/products/practice-planner/pp-front-cover.jpg" alt="slide image 10"></div>
                                <div style="display: none;"><img class="w-full rounded border-4 border-solid w-full" style="border-color: #FFF;" src="https://www.musora.com/musora-cdn/image/width=1400,quality=95/https://d1fyshwdvi6fth.cloudfront.net/ImageSlides/dfee81ef-ecae-4bf4-ab83-893114a7a1b7-Pianote-Poster-Bundle-03.jpg" alt="slide image 7"></div>
                                <div style="display: none;"><img class="w-full rounded border-4 border-solid w-full" style="border-color: #FFF;" src="https://www.musora.com/musora-cdn/image/width=1400,quality=95/https://d1fyshwdvi6fth.cloudfront.net/ImageSlides/dfee81ef-ecae-4bf4-ab83-893114a7a1b7-Pianote-Poster-Bundle-04.jpg" alt="slide image 7"></div>
                                <div style="display: none;"><img class="w-full rounded border-4 border-solid w-full" style="border-color: #FFF;" src="https://www.musora.com/musora-cdn/image/width=1400,quality=95/https://d1fyshwdvi6fth.cloudfront.net/ImageSlides/dfee81ef-ecae-4bf4-ab83-893114a7a1b7-Pianote-Poster-Bundle-05.jpg" alt="slide image 7"></div>
                                <div style="display: none;"><img class="w-full rounded border-4 border-solid w-full" style="border-color: #FFF;" src="https://www.musora.com/musora-cdn/image/width=1400,quality=95/https://d1fyshwdvi6fth.cloudfront.net/ImageSlides/dfee81ef-ecae-4bf4-ab83-893114a7a1b7-Pianote-Poster-Bundle-06.jpg" alt="slide image 7"></div>
                                <div style="display: none;"><img class="w-full rounded border-4 border-solid w-full" style="border-color: #FFF;" src="https://www.musora.com/musora-cdn/image/width=1400,quality=95/https://d1fyshwdvi6fth.cloudfront.net/ImageSlides/dfee81ef-ecae-4bf4-ab83-893114a7a1b7-Pianote-Poster-Bundle-07.jpg" alt="slide image 7"></div>
                                <div style="display: none;"><img class="w-full rounded border-4 border-solid w-full" style="border-color: #FFF;" src="https://www.musora.com/musora-cdn/image/width=1400,quality=95/https://d1fyshwdvi6fth.cloudfront.net/ImageSlides/dfee81ef-ecae-4bf4-ab83-893114a7a1b7-Pianote-Poster-Bundle-08.jpg" alt="slide image 7"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="side-bar sliding-function lg:px-4 lg:w-1/3 px-3 md:px-4 mt-2 mb-4 lg:mb-0">
                    <div class="lg:h-0">
                        <div id="order" class="anchor"></div>
                        <div class="side-slide overflow-hidden rounded border border-solid" style="border-color: #CCD3D3;">
                            <div class="buy-section active px-5 pt-2 pb-6 text-center lg:py-6">
                                <p class="text-center mx-auto mb-1 font-bold text-sm md:text-base" style="color:#10D05F">Save 33%</p>
                                <h1 class="text-center text-3xl uppercase md:text-4xl" style="color:#F71B26;"><s class="opacity-40 text-2xl">$117</s>
                                    <strong class="font-black text-pianote">$<span class="chosen-variant-price-float">79</span></strong>
                                </h1>
                                <a class="online-atc" href="/ecommerce/add-to-cart?products[music-theory-posters]=1&products[piano-chords-and-scales-guide]=1&products[pianote-practice-planner]=1&redirect=/order&locked=true&promo-code=special">
                                    <button class="join border-none bg-pianote"><i class="fas fa-cart-plus text-2xl mr-1"></i> Add To Cart</button>
                                </a>
                                <a href="/ecommerce/add-to-cart?products[music-theory-posters]=1&redirect=/order"><p class="text-sm text-pianote mb-2"><em><u><strong>Or get the posters only for $29</strong></u></em></p></a>
                                <p class="italic text-center mx-auto my-0 text-xs" style="color:#858c93;">
                                    You can also order by phone toll-free at<br class="hidden sm:inline">
                                    <a href="tel:+18004398921" class="text-pianote">1-800-439-8921</a> or directly at
                                    <a href="tel:+16048557605" class="text-pianote">1-604-855-7605</a>. </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="product-wrap lg:w-2/3 px-3 md:px-4">
                <div class="pack-details mx-auto mb-7 pb-5 sm:pb-9 lg:pb-11">
                    <div class="drumshop-accordion">
                        <p><div><p>Music theory can be… tricky.
                                <br/><br/>
                                Connecting what you see on a page to the keys can feel like a giant leap. That’s why we’ve made it easy with 6 beautiful full-color posters highlighting the essential theory you need to play the songs you love.
                                <br/><br/>
                                You’ll understand the Circle of 5ths, be able to read notes, and play every major and minor chord and scale with the Music Theory Poster Bundle.
                                <br/><br/>
                                <strong class="text-pianote">PLUS…</strong>
                                <br/><br/>
                                You can bundle them with our two most popular piano books to maximize your time at the piano.
                                <br/><br/>
                                <strong>- The Chords & Scales Book</strong> will be your ultimate guide to mastering the building blocks of music on the piano. Learn every chord shape, chord variation, and scale in EVERY key.
                                <br/><br/>
                                <strong>- The Practice Planner</strong> will be your best friend every time you sit down at the keys. This is your written guide to making every practice perfect, so you get the results you deserve.</p>
                        </div>
                        </p>
                    </div>
                    <div class="drumshop-accordion mt-10">
                        <div class="spec-wrap">
                            <h4 class="font-bold text-lg uppercase mb-6 md:text-xl lg:text-2xl">Technical Specs</h4>
                            <table class="text-sm w-full md:text-base">
                                <tr>
                                    <td class="font-bold uppercase block md:tb1 md:table-cell md:w-52 md:pb-4">
                                        <i class="text-center w-6 inline-block md:text-lg md:w-7 fas fa-image"></i>
                                        Poster:
                                    </td>
                                    <td class="item-info block md:table-cell pl-4 md:pl-0 pb-4">6 in the set</td>
                                </tr>
                                <tr>
                                    <td class="font-bold uppercase block md:tb1 md:table-cell md:w-52 md:pb-4">
                                        <i class="text-center w-6 inline-block md:text-lg md:w-7 fas fa-arrows"></i>
                                        Size:
                                    </td>
                                    <td class="item-info block md:table-cell pl-4 md:pl-0 pb-4">12" x 17.5"</td>
                                </tr>
                                <tr>
                                    <td class="font-bold uppercase block md:tb1 md:table-cell md:w-52 md:pb-4">
                                        <i class="text-center w-6 inline-block md:text-lg md:w-7 fas fa-vector-square"></i>
                                        Frame:
                                    </td>
                                    <td class="item-info block md:table-cell pl-4 md:pl-0 pb-4">Not included</td>
                                </tr>
                                <tr>
                                    <td class="font-bold uppercase block md:tb1 md:table-cell md:w-52 md:pb-4">
                                        <i class="text-center w-6 inline-block md:text-lg md:w-7 fas fa-book"></i>
                                        Paper Stock:
                                    </td>
                                    <td class="item-info block md:table-cell pl-4 md:pl-0 pb-4">100# Silk Text</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <section class="text-center  text-white  px-4 sm:px-6 py-10 sm:py-14 lg:py-20" style="background:linear-gradient(to bottom, #030916, #08142e);" x-data="{ plusMembershipSelected: true }">
        <div class="container max-w-6xl mx-auto">
            <h2 class="leading-tight mb-5"><strong>Grab your perfect practice <br class="inline sm:hidden">bundle below:</strong></h2>
            <div class="flex flex-wrap items-start justify-center 2-full max-w-sm md:max-w-2xl mx-auto">
                <div class="w-full md:w-1/2 px-2 md:px-3 relative">
                    <p class="inline-block relative -bottom-1 mb-1 px-5 py-1 z-10 leading-tight text-xs rounded-full  uppercase" >&nbsp;</p>
                    <a href="/ecommerce/add-to-cart?products[music-theory-posters]=1&redirect=/order" class="text-black overflow-hidden rounded-2xl block mx-auto mb-4 md:mb-0 group">
                        <div class="bg-white px-4 py-5 md:py-7">
                            <h4 class="mb-2 sm:mb-3"><strong>Music Theory Poster Bundle</strong></h4>
                            <img class="h-24 transition-opacity opacity-0"
                                    loading="lazy"
                                    onload="this.classList.remove('opacity-0')"
                                    src="https://www.musora.com/musora-cdn/image/width=500,quality=95/https://pianote.s3.amazonaws.com/sales/promos/september/poster-bundle.png"
                                    alt="learn playing image"
                            >
                            <br>
                            <h4 class="inline-block leading-tight"><s>$39</s> <strong>$29</strong></h4>
                            <p class="text-sm"><em>Save 26%.</em></p>
                            <div class="join my-5 musora-black smaller w-full transition-opacity duration-300 group-hover:opacity-80 max-w-[230px]">Add To Cart</div>
                            <p class="text-sm mb-1.5"><strong>6 beautiful full-color posters highlight the essential theory you need to play the songs you love.</strong></p>
                            <p class="text-sm mb-1.5">How to read notes</p>
                            <p class="text-sm mb-1.5">Understand the circle of 5ths</p>
                            <p class="text-sm">Play major & minor chords and scales</p>
                        </div>
                    </a>
                </div>
                <div class="w-full md:w-1/2 px-2 md:px-3 relative">
                    <p class="inline-block relative -bottom-1 mb-1 px-5 py-1 z-10 leading-tight text-xs rounded-full bg-pianote uppercase" >Best Deal</p>
                    <a href="/ecommerce/add-to-cart?products[music-theory-posters]=1&products[piano-chords-and-scales-guide]=1&products[pianote-practice-planner]=1&redirect=/order&locked=true&promo-code=special"
                            class="text-black overflow-hidden rounded-2xl block mx-auto mb-4 md:mb-0 group border-2 border-pianote">
                        <div class="bg-white px-4 py-6 md:py-9">
                            <h4 class="mb-2 sm:mb-3"><strong>Ultimate Practice Bundle</strong></h4>
                            <img class="h-24 transition-opacity opacity-0"
                                    loading="lazy"
                                    onload="this.classList.remove('opacity-0')"
                                    src="https://www.musora.com/musora-cdn/image/width=500,quality=95/https://pianote.s3.amazonaws.com/sales/promos/september/ultimate-poster-bundle.png"
                                    alt="learn playing image"
                            >
                            <br>
                            <h4 class="inline-block leading-tight"><s>$117</s> <strong>$79</strong></h4>
                            <p class="text-sm"><em>Save 33%</em></p>
                            <div class="join my-5 pianote smaller w-full transition-opacity duration-300 group-hover:opacity-80 max-w-[230px]">
                                Add to cart
                            </div>
                            <p class="text-sm mb-1.5 text-pianote"><strong>Includes everything in the Music Theory Poster Bundle PLUS:</strong></p>
                            <p class="text-sm mb-1.5"><strong>The Chords & Scales Book</strong> to learn every chord shape, chord variation, and scale in EVERY key.</p>
                            <p class="text-sm"><strong>The Pianote Practice Planner</strong> so you always know what to practice next.</p>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </section>

    <section class="text-center py-10 text-white" style="background: #08142e;">
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

    @include("pianote.sales.partials._footer")

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.min.js"></script>
    <script type="text/javascript" src="{{ asset('/marketing/js/drumeo/ba-bbq.js') }}"></script>
    <script type="text/javascript">
        $(document).ready(function () {
            $('.slider-for').slick({
                slidesToShow: 1,
                slidesToScroll: 1,
                arrows: false,
                fade: true,
                asNavFor: '.slider-nav',
            });
            $('.slider-nav').slick({
                slidesToShow: 3,
                slidesToScroll: 1,
                asNavFor: '.slider-for',
                dots: true,
                centerMode: true,
                focusOnSelect: true,
            });


            if($('#videoPlayer').length) {
                $('.slider-for').on('afterChange', function (event, slick, currentSlide, nextSlide) {
                    var iframe = $('#videoPlayer')
                    var src = $('#videoSrc').get(0).innerText
                    if(iframe.attr('src')){
                        iframe.attr('src', '')
                    }
                    if(currentSlide === 0){
                        iframe.attr('src', src)
                    }
                });
            }

            //customize section pack picker
            var originalLink = '/ecommerce/add-to-cart?go-back-to-shop=true';

            $('select').prop('selectedIndex', 0);
            $('.pack-pick').change(function () {
                var orderButton = $(this).parent().find('.selected-pack');
                var selectedOption = $(this).find('option:selected');
                var selectedPrice = $(selectedOption).data('price');
                var variantPriceSpanElement = $(this).parent().find('.chosen-variant-price-float');

                variantPriceSpanElement.html(selectedPrice);

                $(this).removeClass('error');
                orderButton.addClass('active');
                orderButton.attr('href', originalLink);
                orderButton.attr('href', orderButton.attr('href') + '&products[' + selectedOption.val() + ']=1');
                orderButton.attr('data-product-json', selectedOption.attr('data-product-json'));
            });

            $('.selected-pack').on('click', function (ev) {
                if (!$(this).hasClass('active')) {
                    ev.preventDefault();
                    ev.stopPropagation();
                    var selecter = $(this).parent().find('.pack-pick');
                    selecter.addClass('error');
                }
            });

            // sliding scrollbar function
            function isScrollPast(distanceFromTop) {
                return $(window).scrollTop() > distanceFromTop;
            }

            function getDistanceFromTop(elementToCalculate) {
                if ($(elementToCalculate).is(':visible')) {
                    return $(elementToCalculate).parent().offset().top;
                }

                return false;
            }

            var bodyWidth = window.innerWidth;
            var slidingElm = $('.sliding-function .side-slide');
            var menuHeight = $('.top-bar').height();
            var topFixedSidebarBuffer = 15;

            $(window).resize(function () {
                bodyWidth = window.innerWidth;
                $(slidingElm).removeClass('fixedSlider');
            });

            var originalDistanceFromTop = getDistanceFromTop(slidingElm);
            $(window).scroll(function () {
                if (bodyWidth > 1023) {
                    var footerOffsetTop = $('.text-center.text-white.px-4.py-10').offset().top;

                    if (originalDistanceFromTop === false) {
                        return;
                    }

                    if (isScrollPast(originalDistanceFromTop - menuHeight - topFixedSidebarBuffer)) {
                        if (!$(slidingElm).hasClass('fixedSlider')) {
                            $(slidingElm).addClass('fixedSlider');
                        }

                        if (isScrollPast(footerOffsetTop - slidingElm.height() - menuHeight - (topFixedSidebarBuffer * 2))) {
                            slidingElm.css('top', (footerOffsetTop - slidingElm.height() - $(window).scrollTop() - (topFixedSidebarBuffer)));
                        } else {
                            slidingElm.css('top', '');
                        }
                    } else {
                        if ($(slidingElm).hasClass('fixedSlider')) {
                            $(slidingElm).removeClass('fixedSlider');
                        }
                    }
                }
            });
            $(slidingElm).css('width', $(slidingElm).parent().width());
            $(window).resize(function () {
                if (typeof slidingElm !== 'undefined') {
                    originalDistanceFromTop = getDistanceFromTop(slidingElm);
                    $(slidingElm).css('width', $(slidingElm).parent().width());
                    $(window).trigger('scroll');
                }
            });
        });

    </script>
    <script type="text/javascript" src="{{ asset('/marketing/js/modal.js') }}"></script>
    <script type="text/javascript" src="{{ asset('/marketing/parcel/drumeo/navigation-sales.js') }}"></script>

        <script src="{{ asset('/marketing/js/drumeo/manifest.js') }}"></script>
        <script src="{{ asset('/marketing/js/drumeo/vendor.js') }}"></script>
        <script src="{{ asset('/marketing/js/drumeo/cart-sidebar.js') }}"></script>
        <script src="{{ asset('/marketing/js/drumeo/app.js') }}"></script>


    <script>
        $(document).ready(function () {
            $(document).foundation();
        })
    </script>
    <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/lazysizes/5.3.2/lazysizes.min.js"></script>
    <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/lazysizes/5.3.2/plugins/unveilhooks/ls.unveilhooks.min.js"></script>

@stop
