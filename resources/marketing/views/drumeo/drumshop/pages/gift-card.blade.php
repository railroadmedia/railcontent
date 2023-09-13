@extends('drumeo.drumshop.shop-page-layout')

@section('meta')
    @parent
    <title>Drumeo Gift Card</title>
    <meta name="description" content="Give the gift of drum lessons with a gift card to Drumeo — with your choice between a one-month, 6-month, or 1-year membership pass.">
    <meta property="og:image" content="https://s3.amazonaws.com/drumeo-packs/Merch/pass.jpg" style="display: none;">
    <meta property="og:description" content="Give the gift of drum lessons with a gift card to Drumeo — with your choice between a one-month, 6-month, or 1-year membership pass.">
    <meta property="og:url" content="https://www.drumeo.com/{{ Request::path() }}">
@stop()

@section('head')
    @parent
    <?php
    \App\Analytics\Tracker::trackProductImpression('PASS-1');
    \App\Analytics\Tracker::trackProductImpression('PASS-6');
    \App\Analytics\Tracker::trackProductImpression('PASS-12');
    ?>
@stop()

@section('top')
    @include('_partials.components.shop.slider', [
        "headerText" => "<strong>The perfect gift for ANY drummer!</strong>",
        "videoSrc" => "//player.vimeo.com/video/495414119",
        "videoThumb" => "https://s3.amazonaws.com/drumeo-packs/Merch/pass.jpg",
    ])

    <div class="side-bar sliding-function lg:px-4 lg:w-1/3 px-3 md:px-4 mt-2 mb-4 lg:mb-0">
        <div class="lg:h-0">
            <div id="order" class="anchor"></div>
            <div class="side-slide overflow-hidden rounded border border-solid fixedSlider" style="border-color: rgb(204, 211, 211); width: 352px;">
                <div class="buy-section active px-5 pt-2 pb-6 text-center lg:py-6">

                    <h1 class="text-center text-3xl uppercase md:text-4xl"><strong class="font-black text-drumeo">$<span class="chosen-variant-price-float">29</span></strong></h1>



                    <select class="pack-pick mx-auto mt-4 border-2 rounded-full font-bold text-xl uppercase w-full h-auto py-2 pr-7 pl-5 bg-white md:py-2 lg:py-4" style="border-color: #717D80; color:#717D80; font-family: Roboto Condensed, sans-serif" title="Shirt Size" required="">
                        <option hidden="" value=""> Pick Duration </option>
                        <option class="bg-white text-black" value="PASS-1" data-price="29" data-product-json="{&quot;PASS-1&quot;: 1}">30 Days</option>
                        <option class="bg-white text-black" value="PASS-6" data-price="127" data-product-json="{&quot;PASS-6&quot;: 1}">6 Months</option>
                        <option class="bg-white text-black" value="PASS-12" data-price="240" data-product-json="{&quot;PASS-12&quot;: 1}">1 Year</option>
                    </select>

                    <a class="online-atc merch vue-add-to-cart selected-pack" href="#" data-base-url="/ecommerce/add-to-cart?go-back-to-shop=true">
                        <button class="join border-none">
                            <i class="fas fa-cart-plus text-2xl mr-1" aria-hidden="true"></i> Add To Cart
                        </button>
                    </a>

                    <p class="italic text-center mx-auto my-0 text-xs" style="color:#858c93;">
                        You can also order by phone toll-free at<br class="hidden sm:inline">
                        <a href="tel:1-800-439-8921" class="text-drumeo">1-800-439-8921</a> or directly at
                        <a href="tel:1-604-855-7605" class="text-drumeo">1-604-855-7605</a>. </p>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('bottom')
    <p>The Drumeo Gift Card is a physical access pass that you can use for yourself, or to send as a gift to another drummer.
        Simply choose a membership card with 1, 6, or 12 months of access.
        We’ll ship it to you, and once it arrives it can be <a href="https://musora.com/redeem" target="_blank">redeemed by anybody, anytime</a>.
        <br><br>
        <strong>Drumeo offers ongoing access to:</strong></p>
    <ul>
        <li><strong>The Drumeo Method:</strong> Our 10-level step-by-step curriculum so you always know exactly what to practice next.</li>
        <li><strong>Artist Courses:</strong> {{ Prices::$drumeoCourses }}+ mini-courses by the best drummers and teachers in the world, always teaching the specific topics that made them famous!</li>
        <li><strong>Famous Songs:</strong> {{ Prices::$drumeoSongs }}+ play-along songs featuring our on-screen practice tools so you can play with or without the metronome, create loops, and learn your favorite songs faster.</li>
        <li><strong>Entertaining Shows:</strong> We’ll take you beyond the classroom with entertaining shows for drummers including DIY Drum Experiments, Exploring Beats, In Rhythm, and Study The Greats.</li>
        <li><strong>Personal Support:</strong> You’ll have unlimited access to our community forums, student plans, weekly live streams, video reviews, and more!</li>
    </ul>
@endsection
