@extends('drumeo.products.misc-products-layout')

@section('meta')
    @parent
    <title>The Vater Drumeo 5A Drumsticks</title>
    <meta name="description" content="Made with hickory wood and up to 2X the moisture content of most drumstick manufacturers.">
    <meta property="og:image" content="https://dpwjbsxqtam5n.cloudfront.net/drum-shop/vater-sticks/og-image.jpg" style="display: none;">
    <meta property="og:title" content="The Vater Drumeo 5A Drumsticks">
    <meta property="og:description" content="Made with hickory wood and up to 2X the moisture content of most drumstick manufacturers.">
    <meta property="og:url" content="https://www.drumeo.com/{{ Request::path() }}">
@stop()

@section('head')
    @parent
    <link href="{{ asset('/assets/members-area/css/gulp/vater-sticks.css') }}" rel="stylesheet">

    <?php \App\Analytics\Tracker::trackProductImpression('Drumeo-VaterSticks'); ?>
@stop()

@section('scripts')
    @parent
    <script>
        $(document).ready(function () {
            $(document).foundation();
            $('.instructors .instructor').click(function () {
                if($(this).hasClass('active')) {
                    $('.instructors .instructor').removeClass('active');
                }
                else {
                    $('.instructors .instructor').removeClass('active');
                    $(this).addClass('active');
                }
            });
        });
    </script>
    <script src="{{ asset('/assets/members-area/js/gulp/modal-autoplay.js') }}"></script>
@stop()

@section('content')

    @include('products.partials.promo-banner', [
                "name" => "Drumeo Drumsticks",
                "fullPrice" => Prices::$sticksFull,
                "price" => Prices::$sticksRegular,
                "noBreadcrumb" => true
            ])
    <header class="header text-center">
        <video poster="https://dpwjbsxqtam5n.cloudfront.net/drum-shop/vater-sticks/header-thumbnail.jpg" src="https://dpwjbsxqtam5n.cloudfront.net/drum-shop/vater-sticks/header-video-2.mp4" type="video/mp4" autoplay="" loop="" playsinline="" muted></video>
        <div class="overlay"></div>
        <div class="row">
            <img class="logo" src="https://dpwjbsxqtam5n.cloudfront.net/drum-shop/vater-sticks/drumeo-drumsticks-logo.png">
            <br>
            <div class="watch-badge">
                Watch The <br>
                10,000 Rimshot  <br>
                Challenge
                <img src="https://dpwjbsxqtam5n.cloudfront.net/sales/arrow-left-white.png">
            </div>
            <img data-open="previewModal" class="play-button autoplay-video" src="https://dpwjbsxqtam5n.cloudfront.net/sales/play-button.png">
            <br>
            <a class="join blue" href="{{ URL::Route('shopping-cart.to-cart.api') }}?products[Drumeo-VaterSticks]=1">Grab A Pair &raquo;</a>
            {{--<a class="join sold-out">Sold Out</a>--}}
            <p class="dense">
                @if(Prices::$sticksFull > Prices::$sticksRegular)
                    <s>${{ Prices::$sticksFull }}</s>
                    <strong>Only ${{ Prices::$sticksRegular, 2 }}</strong>
                    (Save {{ round(100 - (100 * (Prices::$sticksRegular / Prices::$sticksFull))) }}%)
                @else
                    <strong>Only ${{ Prices::$sticksRegular }}</strong>
                @endif
            </p>
        </div>
        <div class="reveal large text-center" id="previewModal" data-reveal data-reset-on-close="false">
            <div class="flex-video widescreen vimeo">
                <iframe class="reset-on-close" src="" data-lazy-load-url="//player.vimeo.com/video/436834726?autoplay=1"
                        frameborder="0" allowfullscreen allow="autoplay"></iframe>
            </div>
            <a class="join blue" href="{{ URL::Route('shopping-cart.to-cart.api') }}?products[Drumeo-VaterSticks]=1">Grab A Pair &raquo;</a>
        </div>
    </header>


    <section class="content-section text-center moisture"
            style="background-image:url(https://dpwjbsxqtam5n.cloudfront.net/drum-shop/vater-sticks/water-bg.jpg);">
        <div class="row">
            <h1><strong>Dry drumsticks <br class="hide-for-medium"> snap like twigs.</strong></h1>
            <h5>Drumeo 5A Drumsticks by Vater have up to <strong>double the moisture</strong> content of regular<br
                        class="show-for-medium"> drumsticks — giving you a longer-lasting stick you can count on.</h5>

            <div class="columns medium-4">
                <i class="fal fa-axe text-blue"></i>
                <h3>HICKORY WOOD </h3>
                <p>
                    <em class="text-blue">For strength and durability.</em><br>
                    Hickory holds the perfect balance of strength and durability while absorbing an amazing amount of shock. That’s why it’s found in all kinds of important striking tools such as axes, mallets, and hammers. High-quality hickory drumsticks allow you to play for long periods of time without fatiguing from negative vibrations.
                </p>
            </div>
            <div class="columns medium-4">
                <i class="fal fa-tint text-blue"></i>
                <h3>2X MOISTURE </h3>
                <p>
                    <em class="text-blue">For longer-lasting sticks.</em><br>
                    Vater drumsticks use a dowel moisture content specific to striking tools (10-12%), while other drumstick manufacturers use a moisture content known for furniture manufacturing (6-8%). The more water you extract, the weaker the wood. The more water moisture present (like ours), the stronger the wood - giving you more music out of each pair.
                </p>
            </div>
            <div class="columns medium-4">
                <i class="fal fa-hand-sparkles text-blue"></i>
                <h3>HAND ROLLED </h3>
                <p>
                    <em class="text-blue">For better sticks, every time. </em><br>
                    Alan Vater personally rolls every pair of sticks before they leave the Vater factory. The Vater stamp is reserved for only the finest, most evenly rolled sticks. You can play with confidence knowing your pair of Drumeo Drumsticks has been weighted, tone matched, and rolled to perfection by the master himself before reaching your hands.
                </p>
            </div>
        </div>
    </section>
    <section class="content-section text-center tools"
            style="background-image:url(https://dpwjbsxqtam5n.cloudfront.net/drum-shop/vater-sticks/your-tools-bg.jpg);">
        <div class="row">
            <h1><strong>Your tools matter.</strong></h1>


            <p>An artist’s brush, a carpenter’s hammer, a drummer’s drumstick. <br><br> Your tools matter.
                <br><br> So when Alan Vater offered to personally open up the shop anytime, day or night, to ensure Drumeo students would always have their sticks, I knew I found the perfect fit.
                <br><br> Drumeo has a bigger community than ever, with drummers all over the world playing in thousands of different situations. When I was thinking about our next drumstick, I didn’t want it to be just another drumstick with a Drumeo logo on it. I wanted a stick with the
                <strong>versatility</strong> to meet a wide range of needs and the
                <strong>durability</strong> to get your money's worth out of every pair.
                <br><br> Vater’s high standards for quality and their grassroots, family-owned style really resonate with me. Growing up on a farm, these are the same values my dad displayed every day to get the job done. In many ways, partnering with Vater on these new Drumeo Drumsticks feels like working with family -- and that's important to me.
                <br><br> Vater drumsticks have a rich history with Alan & Ron Vater’s grandfather, Jack Adams, starting out by making drumsticks for his jazz drummer friends in the Boston area --
                <strong>Buddy Rich, Elvin Jones, and Philly Joe Jones</strong>. That tradition of excellence continues today with Vater being used by drummers in the last nine Superbowl Halftime Shows!
                <br><br> Your drumsticks are an extension of your unique personality behind the kit. That's why I'm so excited to partner with Vater, a company that has been helping drummers achieve excellence for a long time. When you pick up a pair of Drumeo 5A Drumsticks by Vater, you're not just picking up another pair of hickory drumsticks. You're picking up a pair of history.
            </p>

            <img class="signature" src="https://dpwjbsxqtam5n.cloudfront.net/drum-shop/vater-sticks/signature.png"><br>
            <img class="avatar" src="https://dpwjbsxqtam5n.cloudfront.net/drum-shop/vater-sticks/jared-falk.jpg"><br>
            <h5><strong>JARED FALK</strong></h5>
            <p class="text-blue">CEO & CO-FOUNDER OF DRUMEO</p>

        </div>
    </section>
    <section class="content-section text-center company">

        <h1><strong>You’re in good company.</strong></h1>
        <h5>Vater sticks were originally made for the owner of Jack’s Drum Shop’s
            <br class="show-for-medium">
            jazz drummer friends — <strong>Buddy Rich, Elvin Jones, and Philly Joe Jones</strong>.
            <br><br>
            That tradition continues today with many of the world’s <br class="show-for-medium-only">
            most legendary drummers choosing Vater sticks.
        </h5>


        <div class="instructors large-up-6 medium-up-4 small-up-2">
            <div class="columns half-padding instructor-wrap">
                <div class="instructor"
                        style="background-image:url(https://dpwjbsxqtam5n.cloudfront.net/drum-shop/vater-sticks/stewart-copeland.jpg);">
                    <div class="text-wrap">
                        <p>Stewart <br> <strong>Copeland</strong></p>
                        <p class="text-blue credits">The Police</p>
                    </div>
                </div>
            </div>
            <div class="columns half-padding instructor-wrap">
                <div class="instructor"
                        style="background-image:url(https://dpwjbsxqtam5n.cloudfront.net/drum-shop/vater-sticks/sarah-jones.jpg);">
                    <div class="text-wrap">
                        <p>Sarah <br> <strong>Jones</strong></p>
                        <p class="text-blue credits">Harry Styles</p>
                    </div>
                </div>
            </div>
            <div class="columns half-padding instructor-wrap">
                <div class="instructor"
                        style="background-image:url(https://dpwjbsxqtam5n.cloudfront.net/drum-shop/vater-sticks/max-weinberg.jpg);">
                    <div class="text-wrap">
                        <p>Max <br> <strong>Weinberg</strong></p>
                        <p class="text-blue credits">Bruce Springsteen</p>
                    </div>
                </div>
            </div>
            <div class="columns half-padding instructor-wrap">
                <div class="instructor"
                        style="background-image:url(https://dpwjbsxqtam5n.cloudfront.net/drum-shop/vater-sticks/josh-devine.jpg);">
                    <div class="text-wrap">
                        <p>Josh<br> <strong>Devine</strong></p>
                        <p class="text-blue credits">One Direction</p>
                    </div>
                </div>
            </div>
            <div class="columns half-padding instructor-wrap">
                <div class="instructor"
                        style="background-image:url(https://dpwjbsxqtam5n.cloudfront.net/drum-shop/vater-sticks/brian-frasier-moore.jpg);">
                    <div class="text-wrap">
                        <p>Brian <br> <strong>Frasier-Moore</strong></p>
                        <p class="text-blue credits">Justin Timberlake</p>
                    </div>
                </div>
            </div>
            <div class="columns half-padding instructor-wrap">
                <div class="instructor"
                        style="background-image:url(https://dpwjbsxqtam5n.cloudfront.net/drum-shop/vater-sticks/didi-negron.jpg);">
                    <div class="text-wrap">
                        <p>Didi <br> <strong>Negron</strong></p>
                        <p class="text-blue credits">Cirque du Soleil </p>
                    </div>
                </div>
            </div>
            <div class="columns half-padding instructor-wrap">
                <div class="instructor"
                        style="background-image:url(https://dpwjbsxqtam5n.cloudfront.net/drum-shop/vater-sticks/matt-mcguire.jpg);">
                    <div class="text-wrap">
                        <p>Matt <br> <strong>McGuire</strong></p>
                        <p class="text-blue credits">Chainsmokers</p>
                    </div>
                </div>
            </div>
            <div class="columns half-padding instructor-wrap">
                <div class="instructor"
                        style="background-image:url(https://dpwjbsxqtam5n.cloudfront.net/drum-shop/vater-sticks/josh-freese.jpg);">
                    <div class="text-wrap">
                        <p>Josh <br> <strong>Freese</strong></p>
                        <p class="text-blue credits">Session Icon</p>
                    </div>
                </div>
            </div>
            <div class="columns half-padding instructor-wrap">
                <div class="instructor"
                        style="background-image:url(https://dpwjbsxqtam5n.cloudfront.net/drum-shop/vater-sticks/billy-cobham.jpg);">
                    <div class="text-wrap">
                        <p>Billy <br> <strong>Cobham</strong></p>
                        <p class="text-blue credits">Drumming Legend</p>
                    </div>
                </div>
            </div>
            <div class="columns half-padding instructor-wrap">
                <div class="instructor"
                        style="background-image:url(https://dpwjbsxqtam5n.cloudfront.net/drum-shop/vater-sticks/mike-mangini.jpg);">
                    <div class="text-wrap">
                        <p>Mike <br> <strong>Mangini</strong></p>
                        <p class="text-blue credits">Dream Theater</p>
                    </div>
                </div>
            </div>
            <div class="columns half-padding instructor-wrap">
                <div class="instructor"
                        style="background-image:url(https://dpwjbsxqtam5n.cloudfront.net/drum-shop/vater-sticks/venzella-joy.jpg);">
                    <div class="text-wrap">
                        <p>Venzella <br> <strong>Joy</strong></p>
                        <p class="text-blue credits">Beyonce</p>
                    </div>
                </div>
            </div>
            <div class="columns half-padding instructor-wrap">
                <div class="instructor"
                        style="background-image:url(https://dpwjbsxqtam5n.cloudfront.net/drum-shop/vater-sticks/virgil-donati.jpg);">
                    <div class="text-wrap">
                        <p>Virgil <br> <strong>Donati</strong></p>
                        <p class="text-blue credits">Drumming Legend </p>
                    </div>
                </div>
            </div>

        </div>
        <h5>& many more of the best drummers in the world.</h5>

    </section>
    <section class="content-section text-center final" style="background-image:url(https://dpwjbsxqtam5n.cloudfront.net/drum-shop/vater-sticks/order-background.jpg);">
        <div class="row">
            <img class="bubbles" src="https://dpwjbsxqtam5n.cloudfront.net/drum-shop/vater-sticks/bubbles-vater.png">
            <img class="logo" src="https://dpwjbsxqtam5n.cloudfront.net/drum-shop/vater-sticks/drumeo-drumsticks-logo.png">
            <br>
            <a class="join blue" href="{{ URL::Route('shopping-cart.to-cart.api') }}?products[Drumeo-VaterSticks]=1">Grab A Pair &raquo;</a>
            {{--<a class="join sold-out">Sold Out</a>--}}
            <p class="dense">
                @if(Prices::$sticksFull > Prices::$sticksRegular)
                    <s>${{ Prices::$sticksFull }}</s>
                    <strong>Only ${{ Prices::$sticksRegular, 2 }}</strong>
                    (Save {{ round(100 - (100 * (Prices::$sticksRegular / Prices::$sticksFull))) }}%)
                @else
                    <strong>Only ${{ Prices::$sticksRegular }}</strong>
                @endif
            </p>


            <div class="credit-cards columns">
                <i class="fab fa-cc-visa"></i> <i class="fab fa-cc-mastercard"></i> <i class="fab fa-cc-amex"></i> <i
                        class="fab fa-cc-paypal"></i>
                <i class="fab fa-cc-discover"></i>
            </div>
            <div class="columns questions">
                <p><strong>Any questions?</strong><br class="hide-for-medium"> Call us toll-free at <a
                            href="tel:+18004398921">1-800-439-8921</a> <br class="hide-for-medium"> or directly at <a
                            href="tel:+16048557605">1-604-855-7605</a>.<br> All prices listed in USD. </p>
            </div>
        </div>
    </section>

@stop


