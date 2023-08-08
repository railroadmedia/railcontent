@extends('drumeo.products.misc-products-layout')


@section('meta')
    @parent
    <title>Drumeo Festival Video Pack</title>
    <meta name="description" content="What happens when you bring 10 of the world's best drummers together to perform in front of drummers from around the world? Magic!">
    <meta property="og:image" content="https://dpwjbsxqtam5n.cloudfront.net/festival/2020-pack/jojo-mayer-nerve.jpg" style="display: none;">
    <meta property="og:title" content="Drumeo Festival Video Pack">
    <meta property="og:description" content="What happens when you bring 10 of the world's best drummers together to perform in front of drummers from around the world? Magic!">
    <meta property="og:url" content="https://www.drumeo.com/{{ Request::path() }}">
@stop()

@section('head')
    @parent
    <link href="{{ asset('/marketing/parcel/drumeo/festival-2020.css') }}" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Permanent+Marker&display=swap" rel="stylesheet">

    <style>
        .permanent {
            font-family:'Permanent Marker';
        }
        .banner-image.right-position {
            background-position: 80% center;
        }
        @media (min-width: 64em) {
            .banner-image.right-position {
                background-position: 60% center;
            }
        }
        .banner-image.left-position {
            background-position: 20% center;
        }
        @media (min-width: 64em) {
            .banner-image.left-position {
                background-position: 40% center;
            }
        }
    </style>
@stop()

@section('content')
    <header class="header text-center">
        <video poster="" src="https://dpwjbsxqtam5n.cloudfront.net/festival/2020-pack/drumeo-festival-2020-banner.mp4" type="video/mp4" autoplay="" loop="" playsinline="" muted></video>
        <div class="overlay"></div>
        <div class="row">
            <img class="logo" src="https://dpwjbsxqtam5n.cloudfront.net/festival/2020-pack/festival-video-pack-logo.png">
            <h1><strong>10 Legendary Drum <br class="hide-for-large">Performances{{-- For Just $1--}}</strong></h1>
            <h3 style="margin: 0 auto;"><strong class="text-yellow">ONLY ${{ 1 }}.</strong> </h3>
            @if(auth()->check())
                <a href="{{ get_musora_brand_base_url() }}/drumeo/packs" class="join blue">View Pack &raquo;</a>
            @else
                <a class="join sold-out">NOT AVAILABLE</a>
                {{--<a href="/ecommerce/add-to-cart?products[festival-2020]=1&products[drumeo_edge_30_days_access]=1&locked=true" class="join blue">Order Now &raquo;</a>--}}
            @endif
            {{--<h6>FREE BONUS: 1 Month Drumeo Membership</h6>--}}
        </div>
    </header>

    <section class="content-section benefits text-center">
        <div class="row">
            <div class="columns medium-6">
                <i class="fa-light fa-music text-blue"></i>
                <h4><strong>10 Legendary Shows</strong></h4>
                <p><em class="text-blue">10 hours of drumming inspiration.</em><br>
                    You’ll get digital access to the full 10 hours of performances from the Drumeo Festival — including Jojo Mayer & Nerve, Tommy Igoe & WIM Trio, Steve Smith & Vital Information, Cindy Blackman Santana, Benny Greb & Moving Parts, Robert “Sput” Searight & Ghost-Note, Anika Nilles, Chris Coleman, Horacio "El Negro" Hernández, and Aquiles Priester.
                </p>
            </div>
            <div class="columns medium-6">
                <i class="fa-light fa-play text-blue"></i>
                <h4><strong>Lifetime Access</strong></h4>
                <p><em class="text-blue">Try risk-free for 90-days</em><br>
                    You’ll get lifetime access to all of the video performances from the Drumeo Festival — accessible inside your Drumeo.com account and accessible on any internet-ready device. Or if you’d rather take the performances with you on the road, you’ll be able to download your videos through the Drumeo App on Apple or Android phones and tablets.
                </p>
            </div>
        </div>
    </section>
    <section class="content-section detail-video text-center">
        <div class="row">
            <h1>“The Drumeo Festival has raised the<br class="show-for-large"> bar for other drumming events.”</h1>
            <h2 class="text-blue">- Jojo Mayer</h2>
            <div class="vid-container">
                <div class="flex-video widescreen vimeo">
                    <iframe src="//player.vimeo.com/video/445669548" frameborder="0" allowfullscreen allow="autoplay"></iframe>
                </div>
                <div class="watch-text permanent show-for-large">
                    WATCH THE<br>
                    RECAP<br>
                    <img src="https://dpwjbsxqtam5n.cloudfront.net/festival/2020-pack/yellow-arrow.png">
                </div>
            </div>
        </div>
    </section>

    <section class="content-section artist-wrappers text-center">
        <div class="banner-image"
                style="background-image:url(https://dpwjbsxqtam5n.cloudfront.net/festival/2020-pack/jojo-mayer-nerve.jpg);"></div>
        <h1 class="permanent">Jojo Mayer<br class="hide-for-medium"> & Nerve</h1>
        <h5 class="text-blue"><em>Drumming’s technique virtuoso dazzles with his live electronica group.</em></h5>


        <div class="banner-image right-position"
                style="background-image:url(https://dpwjbsxqtam5n.cloudfront.net/festival/2020-pack/tommy-igoe-wim-trio.jpg);"></div>
        <h1 class="permanent">Tommy Igoe<br class="hide-for-medium"> & WIM Trio</h1>
        <h5 class="text-blue"><em>The debut performance of 3x Grammy-winner Tommy Igoe’s new supergroup.</em></h5>

        <div class="banner-image"
                style="background-image:url(https://dpwjbsxqtam5n.cloudfront.net/festival/2020-pack/steve-smith-vital-information.jpg);"></div>
        <h1 class="permanent">Steve Smith<br class="hide-for-medium"> & Vital Information</h1>
        <h5 class="text-blue"><em>Steve pays homage to his traditional jazz roots with an all-star band.</em></h5>

        <div class="banner-image"
                style="background-image:url(https://dpwjbsxqtam5n.cloudfront.net/festival/2020-pack/cindy-blackman-santana.jpg);"></div>
        <h1 class="permanent">Cindy Blackman Santana</h1>
        <h5 class="text-blue"><em>Stunning improvised solos with insightful workshop-style Q&A.</em></h5>

        <div class="banner-image left-position"
                style="background-image:url(https://dpwjbsxqtam5n.cloudfront.net/festival/2020-pack/benny-greb-moving-parts.jpg);"></div>
        <h1 class="permanent">Benny Greb<br class="hide-for-medium"> & Moving Parts</h1>
        <h5 class="text-blue"><em>See one of drumming’s most dynamic players in his natural habitat.</em></h5>

        <div class="banner-image"
                style="background-image:url(https://dpwjbsxqtam5n.cloudfront.net/festival/2020-pack/robert-sput-searight-ghost-note.jpg);"></div>
        <h1 class="permanent">Robert “Sput” Searight<br class="hide-for-medium"> & Ghost-Note</h1>
        <h5 class="text-blue"><em>R&B, hip-hop, funk, jazz — Sput’s band bring’s ENERGY in this performance.</em></h5>

        <div class="banner-image"
                style="background-image:url(https://dpwjbsxqtam5n.cloudfront.net/festival/2020-pack/anika-nilles.jpg);"></div>
        <h1 class="permanent">Anika Nilles</h1>
        <h5 class="text-blue"><em>Get up close & personal with prog-rock’s most prolific composer/drummer.</em></h5>

        <div class="banner-image right-position"
                style="background-image:url(https://dpwjbsxqtam5n.cloudfront.net/festival/2020-pack/chris-coleman.jpg);"></div>
        <h1 class="permanent">Chris Coleman</h1>
        <h5 class="text-blue"><em>The power-house opening performance of the 2020 Drumeo Festival.</em></h5>

        <div class="banner-image"
                style="background-image:url(https://dpwjbsxqtam5n.cloudfront.net/festival/2020-pack/horacio-hernandez.jpg);"></div>
        <h1 class="permanent">Horacio "El Negro" Hernández</h1>
        <h5 class="text-blue"><em>A historic performance of latin clave based rhythms from the “Octopus” himself.</em></h5>

        <div class="banner-image"
                style="background-image:url(https://dpwjbsxqtam5n.cloudfront.net/festival/2020-pack/aquilies-priester.jpg);"></div>
        <h1 class="permanent">Aquiles Priester</h1>
        <h5 class="text-blue"><em>The Brazilian metal drumming sensation holds nothing back — and that kit!</em></h5>
    </section>

    <section class="content-section final text-center" style="background-image:url(https://dpwjbsxqtam5n.cloudfront.net/festival/2020-pack/order-section-background.jpg);">
        <div class="row">
            <img class="logo" src="https://dpwjbsxqtam5n.cloudfront.net/festival/2020-pack/festival-video-pack-logo.png">
            <h1><strong>10 Legendary Drum <br class="hide-for-large">Performances{{-- For Just $1--}}</strong></h1>
            {{--<h4><strong>+ Free 1-Month Access To Drumeo</strong></h4>--}}
            {{--<p><em>(Free Bonus, No Hidden Renewing Payments)</em></p>--}}
            <h3 style="margin: 0 auto;"><strong class="text-yellow">ONLY ${{ 1 }}.</strong> </h3>
            @if(auth()->check())
                <a href="{{ get_musora_brand_base_url() }}/drumeo/packs" class="join blue">View Pack &raquo;</a>
            @else
                <a class="join sold-out">NOT AVAILABLE</a>
                {{--<a href="/ecommerce/add-to-cart?products[festival-2020]=1&products[drumeo_edge_30_days_access]=1&locked=true" class="join blue">Order Now &raquo;</a>--}}
            @endif
            {{--<h6>FREE BONUS: 1 Month Drumeo Membership</h6>--}}
            <br><br>
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
