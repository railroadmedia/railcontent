@extends('drumeo._partials.global-layout')

@section('global-head')
    <title>Drumeo Festival</title>
    <meta property="og:title" content="Drumeo Festival">

    <meta name="description" content="The Drumeo Festival is designed to inspire you with legendary shows, surround you with a community of friends and family, and give you the chance to get closer than ever to many of your favorite drummers.">
    <meta property="og:description" content="The Drumeo Festival is designed to inspire you with legendary shows, surround you with a community of friends and family, and give you the chance to get closer than ever to many of your favorite drummers.">

    <meta property="og:image" content="https://dpwjbsxqtam5n.cloudfront.net/festival/2021-notification/header.jpg" style="display: none;">
    <meta property="og:url" content="https://www.drumeo.com/{{ Request::path() }}">

    @include('_partials.layout._fonts')

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/foundation/6.5.3/css/foundation-float.min.css"/>
    <link href="{{ asset('/marketing/parcel/drumeo/navigation-sales.css') }}" rel="stylesheet">
    <link href="{{ asset('/marketing/parcel/drumeo/festival.css') }}" rel="stylesheet">
@stop

@section('global-body')
    @include("drumeo.sales.partials._nav", [
        "cartVersion" => true
    ])

    <header class="hero-header text-center" style="background-image:url(https://dpwjbsxqtam5n.cloudfront.net/festival/2021-notification/header.jpg);">
        <div class="row">
            <img class="logo" src="https://dpwjbsxqtam5n.cloudfront.net/festival/2021-notification/festival-logo.png">
            {{--<h3 class="date"><span class="bigger">2022</span><br>Vancouver, Canada</h3>--}}
            {{--<div class="join outline smaller addeventatc" id="addeventatc1">--}}
                {{--Add to Calendar <i class="fas fa-caret-down"></i>--}}
                {{--<span class="hide start">08/14/2019 10:00 AM</span>--}}
                {{--<span class="hide end">08/15/2019 06:00 PM</span>--}}
                {{--<span class="hide timezone">America/Los_Angeles</span>--}}
                {{--<span class="hide title">Drumeo Festival 2021</span>--}}
                {{--<span class="hide description">The Drumeo Festival is designed to inspire you with legendary shows, surround you with a community of friends and family, and give you the chance to get closer than ever to many of your favorite drummers.</span>--}}
                {{--<span class="hide location">Vancouver, BC, Canada</span>--}}
                {{--<span class="hide organizer">Drumeo</span>--}}
                {{--<span class="hide organizer_email">support@drumeo.com</span>--}}
            {{--</div>--}}
            {{--<a class="join smaller anchor-slide" href="#notify">Notify Me &raquo;</a>--}}
        </div>
    </header>

    <section class="video-breakdown content-section text-center">
        <div class="row">
            <h2><strong>The Drumming Event Of The Year</strong></h2>
            <p>The Drumeo Festival is designed to inspire you with legendary shows, surround you with a community of friends and family, and give you the chance to get closer than ever to many of your favorite drummers. It’s your chance to join 650 fellow drummers for two magical days in one of the most beautiful cities in the world. </p>
            <div class="vid-container">
                <div class="flex-video widescreen vimeo">
                    <iframe src="//player.vimeo.com/video/446265230" frameborder="0" allowfullscreen allow="autoplay"></iframe>
                </div>
            </div>
            <h4><strong>2020 FESTIVAL HIGHLIGHTS</strong></h4>
        </div>
    </section>

    {{--<section class="signup content-section text-center">--}}
        {{--<div class="row">--}}
            {{--<div id="notify" class="anchor"></div>--}}
            {{--<div class="blue-background">--}}
                {{--<h2 class="text-blue"><strong>Be the first to know when<br>--}}
                        {{--tickets are available.</strong></h2>--}}
                {{--<p>Just enter your email address below to get priority notification for the 2022 Drumeo Festival.</p>--}}

            {{--</div>--}}
        {{--</div>--}}
    {{--</section>--}}

    <section class="testimonials content-section text-center">
        <div class="row">
            <h2><strong>What Drummers Are Saying</strong></h2>
            <div class="testimonial-box clearfix">
                <div class="avatar"><img class="show-for-medium"
                            src="https://dpwjbsxqtam5n.cloudfront.net/festival/2021-notification/cindy-blackman-santana.jpg">
                </div>
                <div class="quote-wrap">
                    <h4 class="text-blue">
                        <strong><em>"It was very inspiring."</em></strong></h4>
                    <p class="quote">This was the most organized and well put together drum festival I’ve played in to date! Everything was done with impeccable integrity, class, joy and love for the craft & art of drumming. The audience was beautifully enthusiastic and attentive. It was very inspiring.</p>
                    <img class="hide-for-medium"
                            src="https://dpwjbsxqtam5n.cloudfront.net/festival/2021-notification/cindy-blackman-santana.jpg">
                    <h4><strong>Cindy Blackman Santana</strong></h4>
                    <p><em>Drumeo Festival 2020 Performer</em></p>
                </div>
            </div>
            <div class="testimonial-box clearfix">
                <div class="avatar"><img class="show-for-medium"
                            src="https://dpwjbsxqtam5n.cloudfront.net/festival/2021-notification/tommy-igoe.jpg">
                </div>
                <div class="quote-wrap">
                    <h4 class="text-blue">
                        <strong><em>"Top-shelf talent and a global audience"</em></strong>
                    </h4>
                    <p class="quote">Every healthy community needs an “MGE” — Major Gathering Event. I went to the first Modern Drummer festival as a kid in 1986 and in 2002, I was on stage myself. That MGE faded away and it’s left a hole in our drum community. Fast forward to 2020 and the circle is complete; I just played onstage the first Drumeo Festival in Vancouver. And, BAM!, just like that, the three day “MGE” we desperately needed, bringing top-shelf talent and a global audience together, was born. And I’m so glad my friends at Drumeo were the ones to do it! Here’s to many more years of the Drumeo Festival!</p>
                    <img class="hide-for-medium"
                            src="https://dpwjbsxqtam5n.cloudfront.net/festival/2021-notification/tommy-igoe.jpg">
                    <h4><strong>Tommy Igoe</strong></h4>
                    <p><em>Drumeo Festival 2020 Performer</em></p>
                </div>
            </div>
            <div class="testimonial-box clearfix">
                <div class="avatar"><img class="show-for-medium"
                            src="https://dpwjbsxqtam5n.cloudfront.net/festival/2021-notification/jojo-mayer.jpg">
                </div>
                <div class="quote-wrap">
                    <h4 class="text-blue">
                        <strong><em>"Drumming's electronic pioneer & technique virtuoso dazzles with Nerve."</em></strong>
                    </h4>
                    <p class="quote">By stepping forward and presenting drummers in the natural habitat of their bands, the Drumeo Festival has raised the bar for other drumming events. Communication lies at the core of drumming, music and culture. And it's interaction with other musicians that drives the evolution of drumming as a living art-form. Congratulations!</p>
                    <img class="hide-for-medium"
                            src="https://dpwjbsxqtam5n.cloudfront.net/festival/2021-notification/jojo-mayer.jpg">
                    <h4><strong>Jojo Mayer</strong></h4>
                    <p><em>Drumeo Festival 2020 Performer</em></p>
                </div>
            </div>
            <div class="testimonial-box clearfix">
                <div class="avatar"><img class="show-for-medium"
                            src="https://dpwjbsxqtam5n.cloudfront.net/festival/2021-notification/dom-famularo.jpg">
                </div>
                <div class="quote-wrap">
                    <h4 class="text-blue">
                        <strong><em>"It was so HUGE!"</em></strong></h4>
                    <p class="quote">Drumeo set a new standard at their Festival in Vancouver! There was excitement, emotion, inspiration, education and all with a warm feeling of bringing drummers together! It was so HUGE! The 21st Century just got the boost it needed for drummers globally!</p>
                    <img class="hide-for-medium"
                            src="https://dpwjbsxqtam5n.cloudfront.net/festival/2021-notification/dom-famularo.jpg">
                    <h4><strong>Dom Famularo</strong></h4>
                    <p><em>Drumeo Festival 2020 Host & Performer</em></p>
                </div>
            </div>
            <div class="testimonial-box clearfix">
                <div class="avatar"><img class="show-for-medium"
                            src="https://dpwjbsxqtam5n.cloudfront.net/festival/2021-notification/horacio-hernandez.jpg">
                </div>
                <div class="quote-wrap">
                    <h4 class="text-blue">
                        <strong><em>"Nothing but pure joy."</em></strong>
                    </h4>
                    <p class="quote">It is not easy for me to find words enough to describe the amazing, great feeling at the first Drumeo Festival. From the organization to the hospitality, all the personnel involved, the theater, all the performers, technicians, sound, light....to the superb audience it was nothing but pure joy. A beautiful vibe of camaraderie and passion was all over!!</p>
                    <img class="hide-for-medium"
                            src="https://dpwjbsxqtam5n.cloudfront.net/festival/2021-notification/horacio-hernandez.jpg">
                    <h4><strong>Horacio “El Negro” Hernández</strong></h4>
                    <p><em>Drumeo Festival 2020 Performer</em></p>
                </div>
            </div>
            <div class="testimonial-box clearfix">
                <div class="avatar"><img class="show-for-medium"
                            src="https://dpwjbsxqtam5n.cloudfront.net/festival/2021-notification/benny-greb.jpg">
                </div>
                <div class="quote-wrap">
                    <h4 class="text-blue">
                        <strong><em>"The lineup was amazing"</em></strong>
                    </h4>
                    <p class="quote">It’s great when people get it right, it’s amazing when they get it right the first time. Drumeo put on a truly great event with the Festival. The lineup was amazing, the organization flawless and smooth. It was a great mix of solo and band performances, education, and interaction. I had a blast and I hope to be back soon.</p>
                    <img class="hide-for-medium"
                            src="https://dpwjbsxqtam5n.cloudfront.net/festival/2021-notification/benny-greb.jpg">
                    <h4><strong>Benny Greb</strong></h4>
                    <p><em>Drumeo Festival 2020 Performer</em></p>
                </div>
            </div>
            <div class="testimonial-box clearfix">
                <div class="avatar"><img class="show-for-medium"
                            src="https://dpwjbsxqtam5n.cloudfront.net/festival/2021-notification/chris-coleman.jpg">
                </div>
                <div class="quote-wrap">
                    <h4 class="text-blue">
                        <strong><em>"Top 3 of my entire career"</em></strong>
                    </h4>
                    <p class="quote">Drumeo ... The Festival! Top 3 of my entire career, hands down! I’m looking forward to supporting the growth & evolution for years to come. Thank you for making North America special again. We appreciate you all!</p>
                    <img class="hide-for-medium"
                            src="https://dpwjbsxqtam5n.cloudfront.net/festival/2021-notification/chris-coleman.jpg">
                    <h4><strong>Chris Coleman</strong></h4>
                    <p><em>Drumeo Festival 2020 Performer</em></p>
                </div>
            </div>
            <div class="testimonial-box clearfix">
                <div class="avatar"><img class="show-for-medium"
                            src="https://dpwjbsxqtam5n.cloudfront.net/festival/2021-notification/aquiles-priester.jpg">
                </div>
                <div class="quote-wrap">
                    <h4 class="text-blue">
                        <strong><em>"Just incredible"</em></strong>
                    </h4>
                    <p class="quote">I had the pleasure and privilege of playing at the first Drumeo Festival ever and that was just incredible. At the end of each performance, all the drummers received a standing ovation. It is incredible to have an event for drummers, where the drummer is the main attraction. Thank you very much Jared and Dave and the entire Drumeo team.</p>
                    <img class="hide-for-medium"
                            src="https://dpwjbsxqtam5n.cloudfront.net/festival/2021-notification/aquiles-priester.jpg">
                    <h4><strong>Aquiles Priester</strong></h4>
                    <p><em>Drumeo Festival 2020 Performer</em></p>
                </div>
            </div>
            <div class="testimonial-box clearfix">
                <div class="avatar"><img class="show-for-medium"
                            src="https://dpwjbsxqtam5n.cloudfront.net/festival/2021-notification/steve-smith.jpg">
                </div>
                <div class="quote-wrap">
                    <h4 class="text-blue">
                        <strong><em>"Extremely inspirational"</em></strong>
                    </h4>
                    <p class="quote">Performing at the Drumeo Festival with Vital Information was truly a joy. Playing for an appreciative audience is always a pleasure and the Drumeo audience in particular was extremely inspirational to play for! The Drumeo staff was very professional and oversaw every detail of our stay at the highest level. All the best with future Drumeo festivals.</p>
                    <img class="hide-for-medium"
                            src="https://dpwjbsxqtam5n.cloudfront.net/festival/2021-notification/steve-smith.jpg">
                    <h4><strong>Steve Smith</strong></h4>
                    <p><em>Drumeo Festival 2020 Performer</em></p>
                </div>
            </div>
        </div>
    </section>


    <section class="hero-header text-center bottom" style="background-image:url(https://dpwjbsxqtam5n.cloudfront.net/festival/2021-notification/footer.jpg);">
        <div class="row">
            <img class="logo" src="https://dpwjbsxqtam5n.cloudfront.net/festival/2021-notification/festival-logo.png">
            {{--<h1>SAVE THE DATE!</h1>--}}
            {{--<h3 class="date"><span class="bigger">2022</span><br>Vancouver, Canada</h3>--}}
            {{--<div class="join outline smaller addeventatc" id="addeventatc1">--}}
                {{--Add to Calendar <i class="fas fa-caret-down"></i>--}}
                {{--<span class="hide start">08/14/2019 10:00 AM</span>--}}
                {{--<span class="hide end">08/15/2019 06:00 PM</span>--}}
                {{--<span class="hide timezone">America/Los_Angeles</span>--}}
                {{--<span class="hide title">Drumeo Festival 2021</span>--}}
                {{--<span class="hide description">The Drumeo Festival is designed to inspire you with legendary shows, surround you with a community of friends and family, and give you the chance to get closer than ever to many of your favorite drummers.</span>--}}
                {{--<span class="hide location">Vancouver, BC, Canada</span>--}}
                {{--<span class="hide organizer">Drumeo</span>--}}
                {{--<span class="hide organizer_email">support@drumeo.com</span>--}}
            {{--</div>--}}
            {{--<a class="join smaller anchor-slide" href="#notify">Notify Me &raquo;</a>--}}
        </div>
    </section>


    @include("drumeo.sales.partials._footer")

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script type="text/javascript" src="{{ asset('/marketing/js/modal.js') }}"></script>
    <script src="{{ asset('/marketing/parcel/drumeo/navigation-sales.js') }}"></script>

    <script type="text/javascript" src="https://addevent.com/libs/atc/1.6.1/atc.min.js" async defer></script>
    <script>
        $(document).ready(function () {
            $(document).foundation();
        });
    </script>
    <script src="{{ asset('/marketing/js/modal-autoplay.js') }}"></script>
@stop
