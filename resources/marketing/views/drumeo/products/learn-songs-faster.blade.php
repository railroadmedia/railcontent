@extends('drumeo.products.misc-products-layout')


@section('meta')
    @parent
    <title>Learn Songs Faster</title>
    <meta name="description" content="Your guide to learning MORE songs in less time with Jared Falk & Dave Atkinson.">
    <meta property="og:image" content="https://dpwjbsxqtam5n.cloudfront.net/drum-shop/learn-songs-faster/header.jpg" style="display: none;">
    <meta property="og:title" content="Learn Songs Faster">
    <meta property="og:description" content="Your guide to learning MORE songs in less time with Jared Falk & Dave Atkinson.">
    <meta property="og:url" content="https://www.drumeo.com/{{ Request::path() }}">
@stop()

@section('head')
    @parent
    <link href="{{ asset('/marketing/parcel/drumeo/learn-songs-faster.css') }}" rel="stylesheet">
@stop()

@section('body-data')
    x-data="{ trailer: false }"
@endsection

@section('content')
    @include('_partials.components.shop.promo-banner', [
        "name" => "Learn Songs Faster",
        "fullPrice" => floatval($productPrices['learn-songs-faster-pack']->price),
        "price" => floatval($productPrices['learn-songs-faster-pack']->discounted_price),
        "noBreadcrumb" => true
    ])

    <header class="header text-center">
        <div class="row">
            <img class="logo" src="https://www.musora.com/musora-cdn/image/width=750,quality=95/https://dpwjbsxqtam5n.cloudfront.net/drum-shop/learn-songs-faster/learn-songs-faster-logo.png" alt="Learn Songs Faster Logo" fetchpriority="high"><br>
            <img @click="trailer = true;" class="play-button autoplay-video" src="https://www.musora.com/musora-cdn/image/width=400,quality=95/https://dpwjbsxqtam5n.cloudfront.net/sales/play-button.png" alt="Play Button" fetchpriority="high">
            <h1><strong>Your guide to learning MORE songs in  <br class="show-for-medium">
                    less time with Jared Falk & Dave Atkinson.</strong></h1>
            <h3 class="dense"><strong>
                    @if(floatval($productPrices['learn-songs-faster-pack']->price) > floatval($productPrices['learn-songs-faster-pack']->discounted_price))
                        <strong class="text-yellow">ONLY <s style="opacity:0.6">${{ floatval($productPrices['learn-songs-faster-pack']->price) }}</s>
                            @if(number_format(floatval($productPrices['learn-songs-faster-pack']->discounted_price), 2) == intval(floatval($productPrices['learn-songs-faster-pack']->discounted_price)))
                                ${{  floatval($productPrices['learn-songs-faster-pack']->discounted_price)  }}
                            @else
                                ${{  number_format(floatval($productPrices['learn-songs-faster-pack']->discounted_price), 2)  }}
                            @endif
                        </strong> (SAVE {{ round(100 - (100 * (floatval($productPrices['learn-songs-faster-pack']->discounted_price) / floatval($productPrices['learn-songs-faster-pack']->price)))) }}%)
                    @else
                        <strong class="text-yellow">ONLY ${{ floatval($productPrices['learn-songs-faster-pack']->discounted_price) }}.</strong>
                    @endif
                </strong></h3>
            @if(auth()->check())
                <a href="{{ get_musora_brand_base_url() }}/drumeo/packs" class="join blue">View Masterclass &raquo;</a>
            @else
                <a href="/ecommerce/add-to-cart?products[learn-songs-faster-pack]=1" class="join blue">GET STARTED &raquo;</a>
            @endif
            <a href="/" style="color:inherit;"><h6>OR click here to get this pack FREE<br class="hide-for-medium"> with a Drumeo membership.</h6></a>
        </div>
    </header>

    @include('_partials.components.video-modal',[
        'name' => 'trailer',
        'video' => '422880447',
        'vimeo' => true,
    ])

    <section class="content-section benefits text-center">
        <div class="row">
            <div class="columns medium-6">
                <i class="far fa-video text-blue"></i>
                <h3 class="dense"><strong>PLAY MORE SONGS</strong></h3>
                <p><em class="text-blue">With A 75-Minute Video Masterclass.</em><br>
                    You’ll get access to a 75-minute video masterclass with Jared Falk & Dave Atkinson where they’ll give you their best advice for learning to play songs on the drums — from active listening that’ll help you hear phrasing and understand song structure, to building effective grooves and fills, and keeping time so your playing always sounds ‘right’.
                </p>
            </div>
            <div class="columns medium-6">
                <i class="far fa-shield-check text-blue"></i>
                <h3 class="dense"><strong>100% GUARANTEED</strong></h3>
                <p><em class="text-blue">Try Risk-Free For 90-Days</em><br>
                    The ability to quickly & accurately learn songs is one of the most valuable skills for drummers — for playing alone or in a band. It's also a very learnable skill that you can acquire through the techniques in this course. We're so confident you'll love these lessons, and the impact on your playing, that you'll get a 90-day money-back guarantee.
                </p>
            </div>
        </div>
    </section>
    <section class="content-section teachers text-center">
        <div class="row">
            <h2><strong>Meet your teachers.</strong></h2>
            <div class="columns medium-6">
                <img src="https://www.musora.com/musora-cdn/image/width=400,quality=95/https://dpwjbsxqtam5n.cloudfront.net/drum-shop/learn-songs-faster/jared-falk.jpg" alt="Jared Falk">
                <h3 class="dense"><strong>Jared Falk</strong></h3>
                <p><em class="text-grey">TEACHING FOR {{ date('Y') - 1998 }} YEARS</em><br>
                    Jared Falk is the Founder of Drumeo. As a drum teacher, his DVD-based curriculum “Successful Drumming” has helped more than 20,000 students, his YouTube videos have been seen by millions of drummers around the world, and he’s been voted “Best Drum Educator” by the readers of Rhythm Magazine. Jared’s goal is to create more drummers and keep them playing longer by helping them have more fun learning and playing drums.
                </p>
            </div>
            <div class="columns medium-6">
                <img src="https://www.musora.com/musora-cdn/image/width=500,quality=95/https://dpwjbsxqtam5n.cloudfront.net/drum-shop/learn-songs-faster/dave-atkinson.jpg" alt="Dave Atkinson">
                <h3 class="dense"><strong>Dave Atkinson</strong></h3>
                <p><em class="text-grey">TEACHING FOR {{ date('Y') - 2006 }} YEARS</em><br>
                    Dave Atkinson has been working with students and teachers at FreeDrumLessons.com and Drumeo.com since 2006 — teaching video lessons, hosting online events, and working alongside many of the world’s best drummers. Dave is one of the rare teachers in the world who has been directly responding to students every single day for the past 14 years — making him uniquely qualified on the problems that drummers face and the best ways to overcome them.
                </p>
            </div>
        </div>
    </section>

    <section class="content-section topics text-center">
        <div class="row">
            <h2><strong>Just a few topics we'll cover...</strong></h2>
            <h5 class="text-yellow dense">(This masterclass will be geared towards beginner & intermediate drummers.)</h5>
            <div class="topic-wrap large-up-4 medium-up-3 max-w-sm sm:max-w-none">
                <div class="columns half-padding">
                    <div class="thumb relative">
                        <img class="absolute inset-0 object-cover transition-all opacity-0" src="https://www.musora.com/musora-cdn/image/width=500,quality=95/https://dpwjbsxqtam5n.cloudfront.net/drum-shop/learn-songs-faster/topic-ear-training.jpg" alt="ear training" loading="lazy" onload="this.classList.remove('opacity-0')" />
                        <h1>EAR TRAINING</h1>
                    </div>
                    <p>
                        Before you tackle any song, you need to listen closely. Here, you’ll get tips for understanding the structure of the tune, finding your place in the song, and choosing how you’ll address the music with your playing.
                    </p>
                </div>
                <div class="columns half-padding">
                    <div class="thumb">
                        <img class="absolute inset-0 object-cover transition-all opacity-0" src="https://www.musora.com/musora-cdn/image/width=500,quality=95/https://dpwjbsxqtam5n.cloudfront.net/drum-shop/learn-songs-faster/topic-timing-tempo.jpg" alt="timing and tempo" loading="lazy" onload="this.classList.remove('opacity-0')" />
                        <h1>TIMING & TEMPO</h1>
                    </div>
                    <p>
                        Whatever you choose to play MUST be in time with the other instruments. Here, you’ll learn about individual note spacing and overall timing so you can make effective musical choices on the drums.
                    </p>
                </div>
                <div class="columns half-padding">
                    <div class="thumb">
                        <img class="absolute inset-0 object-cover transition-all opacity-0" src="https://www.musora.com/musora-cdn/image/width=500,quality=95/https://dpwjbsxqtam5n.cloudfront.net/drum-shop/learn-songs-faster/topic-backbeat.jpg" alt="the backbeat" loading="lazy" onload="this.classList.remove('opacity-0')" />
                        <h1>THE BACKBEAT</h1>
                    </div>
                    <p>
                        The backbeat is the life force of the song. It’s what drives the music! Here you’ll gain tips for creating an effective backbeat for a variety of musical styles including rock, country, and pop.
                    </p>
                </div>
                <div class="columns half-padding">
                    <div class="thumb">
                        <img class="absolute inset-0 object-cover transition-all opacity-0" src="https://www.musora.com/musora-cdn/image/width=500,quality=95/https://dpwjbsxqtam5n.cloudfront.net/drum-shop/learn-songs-faster/topic-downbeat.jpg" alt="the downbeat" loading="lazy" onload="this.classList.remove('opacity-0')" />
                        <h1>THE DOWNBEAT</h1>
                    </div>
                    <p>
                        The downbeat is usually known as the “1” count to each bar in the song. It sets up and finishes phrases. Here, you’ll learn how to create a solid downbeat — and paired with a backbeat, you’ll be able to play almost any tune!
                    </p>
                </div>
                <div class="columns half-padding">
                    <div class="thumb">
                        <img class="absolute inset-0 object-cover transition-all opacity-0" src="https://www.musora.com/musora-cdn/image/width=500,quality=95/https://dpwjbsxqtam5n.cloudfront.net/drum-shop/learn-songs-faster/topic-better-feel.jpg" alt="better feel" loading="lazy" onload="this.classList.remove('opacity-0')" />
                        <h1>BETTER FEEL</h1>
                    </div>
                    <p>
                        You don’t need to play songs note-for-note. A song is organic: it lives and breathes. Here, you’ll learn why understanding the feel is more important than the exact beats that are being played — and how to lock in with the music.
                    </p>
                </div>
                <div class="columns half-padding">
                    <div class="thumb">
                        <img class="absolute inset-0 object-cover transition-all opacity-0" src="https://www.musora.com/musora-cdn/image/width=500,quality=95/https://dpwjbsxqtam5n.cloudfront.net/drum-shop/learn-songs-faster/topic-effective-fills.jpg" alt="effective fills" loading="lazy" onload="this.classList.remove('opacity-0')" />
                        <h1>EFFECTIVE FILLS</h1>
                    </div>
                    <p>
                        Once you know the tempo and structure, and can play a solid beat, you can start working on the transitions, or drum fills, to make the music shine. You’ll learn how to choose effective drum fills for a variety of situations.
                    </p>
                </div>
                <div class="columns half-padding">
                    <div class="thumb">
                        <img class="absolute inset-0 object-cover transition-all opacity-0" src="https://www.musora.com/musora-cdn/image/width=500,quality=95/https://dpwjbsxqtam5n.cloudfront.net/drum-shop/learn-songs-faster/topic-improv.jpg" alt="improvisation" loading="lazy" onload="this.classList.remove('opacity-0')" />
                        <h1>IMPROVISATION</h1>
                    </div>
                    <p>
                        Foundational beats and fills are great, but sometimes you need to be ready for whatever the song throws at you. You’ll gain Jared and Dave’s best advice for anticipating and reacting to the music as it happens.
                    </p>
                </div>
                <div class="columns half-padding">
                    <div class="thumb">
                        <img class="absolute inset-0 object-cover transition-all opacity-0" src="https://www.musora.com/musora-cdn/image/width=500,quality=95/https://dpwjbsxqtam5n.cloudfront.net/drum-shop/learn-songs-faster/topic-fine-tuning.jpg" alt="fine tuning" loading="lazy" onload="this.classList.remove('opacity-0')" />
                        <h1>FINE TUNING</h1>
                    </div>
                    <p>
                        Once you can play the entire song at a basic level, it’s time to put the final touches on your grooves and fills. You’ll learn how to listen to key patterns and replicate them — adding the right ghost notes and bass patterns.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <section class="content-section text-center question-answered">
        <div class="row">
            <img src="https://www.musora.com/musora-cdn/image/width=700,quality=95/https://dpwjbsxqtam5n.cloudfront.net/drum-shop/learn-songs-faster/question-answer.png" alt="Question Answer Image">
            <div class="text medium-text-left">
                <h2><strong>Your questions answered...</strong></h2>
                <p>Inside this course, you’ll have opportunities to ask your biggest questions and get personalized feedback & support from real-live teachers and Drumeo students.</p>
            </div>
        </div>
    </section>


    <section class="content-section final text-center">
        <div class="row">
            <img class="logo" src="https://www.musora.com/musora-cdn/image/width=900,quality=95/https://dpwjbsxqtam5n.cloudfront.net/drum-shop/learn-songs-faster/learn-songs-faster-logo.png" alt="Learn Songs Faster Logo">
            <h2><strong>Your guide to learning MORE songs in  <br class="show-for-medium">
                    less time with Jared Falk & Dave Atkinson</strong></h2>

            <h2 class="dense"><strong>
                    @if(floatval($productPrices['learn-songs-faster-pack']->price) > floatval($productPrices['learn-songs-faster-pack']->discounted_price))
                        <strong class="text-yellow">ONLY <s style="opacity:0.6">${{ floatval($productPrices['learn-songs-faster-pack']->price) }}</s>
                            @if(number_format(floatval($productPrices['learn-songs-faster-pack']->discounted_price), 2) == intval(floatval($productPrices['learn-songs-faster-pack']->discounted_price)))
                                ${{  floatval($productPrices['learn-songs-faster-pack']->discounted_price)  }}
                            @else
                                ${{  number_format(floatval($productPrices['learn-songs-faster-pack']->discounted_price), 2)  }}
                            @endif
                        </strong> (SAVE {{ round(100 - (100 * (floatval($productPrices['learn-songs-faster-pack']->discounted_price) / floatval($productPrices['learn-songs-faster-pack']->price)))) }}%)
                    @else
                        <strong class="text-yellow">ONLY ${{ floatval($productPrices['learn-songs-faster-pack']->discounted_price) }}.</strong>
                    @endif
                </strong></h2>
            @if(auth()->check())
                <a href="{{ get_musora_brand_base_url()}}/drumeo/packs" class="join blue">View Masterclass &raquo;</a>
            @else
                <a href="/ecommerce/add-to-cart?products[learn-songs-faster-pack]=1" class="join blue">GET STARTED &raquo;</a>
            @endif
            <a href="/" style="color:inherit;"><h6>OR click here to get this pack FREE<br class="hide-for-medium"> with a Drumeo membership.</h6></a>

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
