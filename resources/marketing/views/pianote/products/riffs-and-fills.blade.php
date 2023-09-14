@extends('pianote._partials.global-layout')

@section('global-head')
    <title>Piano Riffs & Fills | Pianote</title>
    <meta name="description" content="The Shortcuts To Sounding Great On The Piano">

    <meta property="og:image" content="https://d2vyvo0tyx8ig5.cloudfront.net/shop/products/piano-riffs-and-fills/og-image.jpg" style="display: none;">
    <meta property="og:title" content="Piano Riffs & Fills">
    <meta property="og:description" content="The Shortcuts To Sounding Great On The Piano">
    <meta property="og:url" content="https://www.pianote.com/riffs-and-fills">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.4.1/css/bootstrap.min.css">
    @include('_partials.layout._tailwindcdn')
    <link href="{{ asset('/marketing/parcel/drumeo/nav-footer-pianote.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('/marketing/parcel/drumeo/riffs-and-fills.css') }}">
@stop

@section('global-body')
    @include('pianote.sales.partials._nav', [
        "cartVersion" => true
    ])

    @include('pianote._partials._promo-banner-no-tw', [
                    "name" => "Piano Riffs & Fills",
                    "fullPrice" => floatval($productPrices['piano-riffs-and-fills']->price),
                    "price" => floatval($productPrices['piano-riffs-and-fills']->discounted_price),
                    "noBreadcrumb" => true
                ])


    <header class="header text-center">
        <div class="container" style="background-image:url(https://d2vyvo0tyx8ig5.cloudfront.net/shop/products/piano-riffs-and-fills/header.jpg);">
            <img class="logo"
                    src="https://d2vyvo0tyx8ig5.cloudfront.net/shop/products/piano-riffs-and-fills/piano-riffs-fills-logo.png" alt="Riffs and fills logo"><br>
            <i class="fas fa-play play-vimeo autoplay-video" data-toggle="modal" data-target="#trailer"></i>
            <h2>The shortcuts to <br class="hidden-sm hidden-md hidden-lg"><strong>sounding great</strong> on the piano.</h2>
            <a
                class="join vue-add-to-cart"
                href="{{ url()->route('shopping-cart.add-to-cart', ['products' => ['piano-riffs-and-fills' => 1], 'redirect' => '/order', 'locked' => 'false']) }}"
                data-product-json='{"piano-riffs-and-fills": 1}'
            >Get Started &raquo;</a>

            <p class="breakdown">
                @if(floatval($productPrices['piano-riffs-and-fills']->price) > floatval($productPrices['piano-riffs-and-fills']->discounted_price))
                    <s>NORMALLY ${{ floatval($productPrices['piano-riffs-and-fills']->price) }}.</s> &nbsp;
                    <strong><u>ONLY ${{ floatval($productPrices['piano-riffs-and-fills']->discounted_price) }}</u></strong>&nbsp; (SAVE {{ round(100 - (100 * (floatval($productPrices['piano-riffs-and-fills']->discounted_price) / floatval($productPrices['piano-riffs-and-fills']->price)))) }}%)
                @else
                    <strong><u>ONLY ${{ floatval($productPrices['piano-riffs-and-fills']->discounted_price) }}</u></strong>
                @endif

                <br><a href="/" class="red">(OR FREE WITH A PIANOTE MEMBERSHIP)</a><br>
                    <strong class="yellow">** 90-DAY GUARANTEE **</strong></p>
        </div>
    </header>
    <div class="modal fade text-center" id="trailer" tabindex="-1" role="dialog" aria-labelledby="trailerLabel">
        <i class="close stop-play fas fa-times" data-dismiss="modal" aria-label="Close"></i>
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="embed-responsive embed-responsive-16by9">
                    <iframe class="embed-responsive-item reset-on-close" data-lazy-load-url="//player.vimeo.com/video/423703341?autoplay=1" frameborder="0" allowfullscreen allow="autoplay"></iframe>
                </div>
                <a href="{{ url()->route('shopping-cart.add-to-cart',
                ['products' => ['piano-riffs-and-fills' => 1], 'redirect' => '/order', 'locked' => 'false']) }}"
                        class="join stop-play" data-dismiss="modal" aria-label="Close">Get Started</a>
            </div>
        </div>
    </div>

    <section class="more-songs">
        <div class="container">
            <img src="https://d2vyvo0tyx8ig5.cloudfront.net/shop/products/piano-riffs-and-fills/piano-music-icons.png" alt="Note and piano icon">
            <p>Anyone can play a chord — but what happens in the spaces <strong>between</strong> the chords distinguishes the great players from the mediocre ones.
                <br><br>
                Fill those spaces with piano riffs that will make you sound professional, polished ... and close to perfect. Learn the secrets and tips to play fills that <strong>sound</strong> complicated and advanced, but are actually very <strong>simple</strong> to learn and start adding to your repertoire.
            </p>
        </div>
    </section>

    <div id="twoResults" class="anchor"></div>
    <section class="two-video-example text-center">
        <div class="container">
            <h1><strong>One song. Two completely<br class="hidden-sm hidden-md hidden-lg"> different results.</strong></h1>
            <p>Compare these two performances. It’s the same song both times, but the result is VERY different. That’s what happens when you add simple riffs to level-up your playing.</p>
            <div class="thumb col-xs-12 col-sm-6">
                <div class="vid-wrap">
                    <video class="example-video" controls
                            src="https://player.vimeo.com/external/424916734.sd.mp4?s=e1fa392592f09e0fb1200d64a4f13394fd76743c&profile_id=164"
                            poster="https://d2vyvo0tyx8ig5.cloudfront.net/shop/products/piano-riffs-and-fills/without-the-magic-thumb.jpg">
                    </video>
                </div>
                <p><strong>Without The Magic</strong><br>
                    The performance is the song using only the chords. There are no riffs
                    or fills of any kind. It sounds … nice. But there’s something missing,
                    isn’t there? Your ears just know it.</p>
            </div>

            <div class="thumb col-xs-12 col-sm-6 active">
                <div class="vid-wrap">
                    <video class="example-video" controls
                            src="https://player.vimeo.com/external/424916715.sd.mp4?s=d14abee48e9ec12729b52458c00108e83f7c7044&profile_id=164"
                            poster="https://d2vyvo0tyx8ig5.cloudfront.net/shop/products/piano-riffs-and-fills/with-the-magic-thumb.jpg">
                    </video>
                </div>
                <p><strong>With The Magic</strong><br>
                    Here’s the same song using only riffs and fills that you’ll learn in
                    <em>Piano Riffs & Fills</em>. Just the simple addition of these tips
                    completely changes the way the song (and the player) sounds.</p>
            </div>

        </div>
    </section>

    <section class="thumb-grid text-center">
        <div class="container">
            <h1><strong>It’s time to sound<br class="hidden-sm hidden-md hidden-lg"> like a professional.</strong></h1>
            <p>Each lesson is designed to build on the previous one, so you’ll be reinforcing what you’ve already learned while developing new skills. It WILL take practice — but it won’t take months. Most students can expect to complete these lessons in less than two weeks (including practice time).</p>
            <div class="image-grid-item col-xs-12 col-sm-4">
                <img src="https://d2vyvo0tyx8ig5.cloudfront.net/shop/products/piano-riffs-and-fills/lesson-thumb-1.jpg" alt="Lesson 1 thumbnail">
                <p><span class="text-red"><strong>Chords and Inversions</strong></span><br>
The building blocks of piano riffs. You’ll learn how to play chord inversions and start using them to make your songs sound better.</p>
            </div>

            <div class="image-grid-item col-xs-12 col-sm-4">
                <img src="https://d2vyvo0tyx8ig5.cloudfront.net/shop/products/piano-riffs-and-fills/lesson-thumb-2.jpg" alt="Lesson 2 thumbnail">
                <p><span class="text-red"><strong>How to Use Inversions to Create Fills</strong></span><br>
Start filling in the spaces with simple riffs that sound amazing. You’ll see how easy piano riffs can be.</p>
            </div>

            <div class="image-grid-item col-xs-12 col-sm-4">
                <img src="https://d2vyvo0tyx8ig5.cloudfront.net/shop/products/piano-riffs-and-fills/lesson-thumb-3.jpg" alt="Lesson 3 thumbnail">
                <p><span class="text-red"><strong>The “Sus-Trill”</strong></span><br>
Learn one of the most beautiful and versatile fills in piano music. Add sparkle to your playing with this fill — which sounds much more complicated than it is.</p>
            </div>

            <div class="image-grid-item col-xs-12 col-sm-4">
                <img src="https://d2vyvo0tyx8ig5.cloudfront.net/shop/products/piano-riffs-and-fills/lesson-thumb-4.jpg" alt="Lesson 4 thumbnail">
                <p><span class="text-red"><strong>Unlock The Secrets</strong></span><br>
Discover the magic behind Lisa’s favorite piano fills and how to actually USE them to in songs.</p>
            </div>

            <div class="image-grid-item col-xs-12 col-sm-4">
                <img src="https://d2vyvo0tyx8ig5.cloudfront.net/shop/products/piano-riffs-and-fills/lesson-thumb-5.jpg" alt="Lesson 5 thumbnail">
                <p><span class="text-red"><strong>Left-Hand Fills & Fancy Tricks</strong></span><br>
Because it’s not just the right hand. Find out how simple tricks can elevate your left-hand playing and fill out those songs.</p>
            </div>

            <div class="image-grid-item col-xs-12 col-sm-4">
                <img src="https://d2vyvo0tyx8ig5.cloudfront.net/shop/products/piano-riffs-and-fills/lesson-thumb-6.jpg" alt="Lesson 6 thumbnail">
                <p><span class="text-red"><strong>Advanced Riff & Fill Concepts</strong></span><br>
Connect every riff, fill and tip you’ve learned and see how to apply it to pretty much ANY song you’ll ever play. Warning - some practice required!</p>
            </div>
        </div>
    </section>

    <section class="play-songs text-center">
        <div class="container">
            <h1><strong>Play the sounds you<br class="hidden-sm hidden-md hidden-lg"> hear in your head.</strong></h1>
            <div class="benefit-tile col-xs-12 col-sm-6">
                <i class="fas fa-stopwatch"></i>
                <p>
                    <strong>Short Lessons</strong><br> Spend more time playing, not practicing. Each lesson is around 5 to 7 minutes long.
                </p>
            </div>
            <div class="benefit-tile col-xs-12 col-sm-6">
                <i class="fas fa-list-ol"></i>
                <p>
                    <strong>Perfect For All Levels</strong><br> Structured step-by-step lessons you can take at your own pace.
                </p>
            </div>
            <hr style="opacity: 0;margin:0;" class="col-xs-12 hidden-xs no-padding">
            <div class="benefit-tile col-xs-12 col-sm-6">
                <i class="fas fa-piano-keyboard"></i>
                <p>
                    <strong>Practice-along Exercises</strong><br> Play-along exercises will help you master the fundamentals and build the foundation needed for success.
                </p>
            </div>
            <div class="benefit-tile col-xs-12 col-sm-6">
                <i class="fas fa-music"></i>
                <p>
                    <strong>Apply It To Any Song</strong><br> Add these fills to your repertoire. Perfect for pretty much any popular song!
                </p>
            </div>
            <hr style="opacity: 0;margin:0;" class="col-xs-12 hidden-xs no-padding">
            <div class="benefit-tile col-xs-12 col-sm-6">
                <i class="fas fa-file-download"></i>
                <p>
                    <strong>Downloadable Resources</strong><br> Helpful guides to download, print, and keep by the piano. Never forget what you’ve learned.
                </p>
            </div>
            <div class="benefit-tile col-xs-12 col-sm-6">
                <i class="fas fa-infinity"></i>
                <p>
                    <strong>Yours Forever</strong><br> These lessons NEVER expire. Watch them again, and again, and again… (you get the point).
                </p>
            </div>
        </div>
    </section>

    <section class="personal-teacher text-center" style="background-image:url(https://d2vyvo0tyx8ig5.cloudfront.net/shop/products/piano-riffs-and-fills/lisa-witt-image.jpg);">
        <div class="container">
            <div class="name-wrap pull-right">
                <h1>LISA WITT</h1>
                <h3 class="text-red">Your Teacher & Practice Planner</h3>
            </div>
            <hr style="width:100%;opacity: 0;">
            <p>Hi, I’m Lisa Witt and I’m so excited to show you how to instantly improve your playing sound and style with Piano Riffs & Fills.
                <br><br>
                I’ve performed with and observed close up some world-class musicians and the biggest thing I learned from them is this…
                <br><br>
                Sounding amazing does NOT have to be complicated!
                <br><br>
                It’s incredible what a difference some basic riffs and fills can make.
                <br><br>
                These are the fills that are used on the world stage. It’s not rocket science, but it will take your playing to that next level.
                <br><br>
                I’ve also learned that being CONFIDENT with your playing and knowing HOW and WHEN to execute your skills is what will set you apart from other players.
                <br><br>
                That’s what this course is all about, and I can’t wait to help you.
                <br><br>
                <img src="https://d2vyvo0tyx8ig5.cloudfront.net/shop/products/piano-riffs-and-fills/lisa-witt-signature.png" alt="Lisa signature">
            </p>
        </div>
    </section>

    <section class="guarantee text-center">
        <div class="container">
            <img class="guarantee-badge hidden-sm hidden-md hidden-lg" src="https://d2vyvo0tyx8ig5.cloudfront.net/sales/guarantee-badge.png" alt="Guarantee Badge">
            <h1>Piano Riffs & Fills <br class="hidden-sm hidden-md hidden-lg">
                is  <strong>GUARANTEED</strong><br class="hidden-sm hidden-md hidden-lg">
                to help you...</h1>
            <div class="flex-container">
                <img class="guarantee-badge hidden-xs" src="https://d2vyvo0tyx8ig5.cloudfront.net/sales/guarantee-badge.png" alt="Guarantee badge">
                <div class="text-wrap text-left">
                    <h3><em>
                            <i class="text-red fa-light fa-check-circle"></i> Sound better and more professional<br>
                            <i class="text-red fa-light fa-check-circle"></i> Apply fancy-sounding fills to REAL songs<br>
                            <i class="text-red fa-light fa-check-circle"></i> Have way more FUN at the piano
                        </em></h3>

                    <h4>We only want you to pay if you actually LOVE your Pianote experience! So join below to try it out totally risk-free. If it’s not for you, simply cancel your membership within 90 days and contact support for a full refund.</h4>
                </div>
            </div>
        </div>
    </section>

    <section class="final text-center" style="background-image:url(https://d2vyvo0tyx8ig5.cloudfront.net/shop/products/piano-riffs-and-fills/order-background.jpg);">
        <div class="container">
            <img class="logo" src="https://d2vyvo0tyx8ig5.cloudfront.net/shop/products/piano-riffs-and-fills/piano-riffs-fills-logo.png" alt="Riffs and fills logo">
            <h2>The shortcuts to <strong>sounding great</strong> on the piano.</h2>
            <a
                href="{{ url()->route('shopping-cart.add-to-cart', ['products' => ['piano-riffs-and-fills' => 1], 'redirect' => '/order', 'locked' => 'false']) }}"
                class="join vue-add-to-cart"
                data-product-json='{"piano-riffs-and-fills": 1}'
            >Get Started &raquo;</a>
            <p class="breakdown">
                @if(floatval($productPrices['piano-riffs-and-fills']->price) > floatval($productPrices['piano-riffs-and-fills']->discounted_price))
                    <s>NORMALLY ${{ floatval($productPrices['piano-riffs-and-fills']->price) }}.</s> &nbsp;
                    <strong><u>ONLY ${{ floatval($productPrices['piano-riffs-and-fills']->discounted_price) }}</u></strong>&nbsp; (SAVE {{ round(100 - (100 * (floatval($productPrices['piano-riffs-and-fills']->discounted_price) / floatval($productPrices['piano-riffs-and-fills']->price)))) }}%)
                @else
                    <strong><u>ONLY ${{ floatval($productPrices['piano-riffs-and-fills']->discounted_price) }}</u></strong>
                @endif
                <br><a href="/" class="red">(OR FREE WITH A PIANOTE MEMBERSHIP)</a><br>
                    <strong class="yellow">** 90-DAY GUARANTEE **</strong></p>

            <div class="credit-cards col-xs-12">
                <i class="fab fa-cc-visa"></i>
                <i class="fab fa-cc-mastercard"></i>
                <i class="fab fa-cc-discover"></i>
                <i class="fab fa-cc-amex"></i>
                <i class="fab fa-cc-paypal"></i>
                <br>
                <br>
            </div>
            <div class="col-xs-12 questions">
                <p><strong>Any questions?</strong><br class="hidden-lg hidden-md hidden-sm"> Call us toll-free at <a
                            href="tel:+18004398921">1-800-439-8921</a> <br
                            class="hidden-lg hidden-md hidden-sm"> or directly at <a
                            href="tel:+16048557605">1-604-855-7605</a>.<br> All prices listed in USD. </p>
            </div>
        </div>
    </section>

    @include('pianote.sales.partials._footer')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="{{ asset('/marketing/parcel/drumeo/navigation-sales.js') }}"></script>
    <script>
        $(function() {
            // sticky topbar before orderSection
            var stickyBar = $('.promo-banner');
            $(window).scroll(function () {
                var orderSection = $('.final').offset().top;
                var spreadSection = $('.more-songs').offset().top;
                if ($(this).scrollTop() > (orderSection - 115)) {
                    stickyBar.removeClass('fixed');
                }
                if ($(this).scrollTop() < spreadSection - 115) {
                    stickyBar.removeClass('fixed');
                }
                if ($(this).scrollTop() < orderSection - 115 && $(this).scrollTop() > spreadSection - 115) {
                    stickyBar.addClass('fixed');
                }
            });
        });
    </script>

    <script>
        $(document).ready(function ($) {

            //modal video swapping
            $('.play-vimeo').on('click touchstart', function () {
                var idOfOpenDiv = $(this).data('target');

                $(idOfOpenDiv).find('[data-lazy-load-url]').each(function () {
                    var lazyLoadIframeElement = $(this);
                    $(this).attr('src', lazyLoadIframeElement.data('lazy-load-url'));
                });
            });
            $('body').on('click', '.modal, .modal .stop-play', function (e) {
                if (e.target !== this) {
                    return;
                }

                $('.reset-on-close').attr('src', 'about:blank');
            });

            $(".example-video").on('play', function () {
                $(".example-video").not(this).trigger('pause');
                $('.thumb').removeClass('active');
                $(this).parents('.thumb').addClass('active');
            });
        });
    </script>
    <script src="{{ asset('/marketing/js/pianote/manifest.js') }}"></script>
    <script src="{{ asset('/marketing/js/pianote/vendor.js') }}"></script>
    <script src="{{ asset('/marketing/js/pianote/cart-sidebar.js') }}"></script>
    <script src="{{ asset('/marketing/js/pianote/app.js') }}"></script>


@stop
