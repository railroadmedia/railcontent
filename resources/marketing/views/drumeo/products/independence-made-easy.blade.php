@extends('drumeo.products.misc-products-layout')


@section('meta')
    @parent
    <title>Independence Made Easy</title>
    <meta name="description" content="Jared Falk's 26-Week Online Course For Building Your Drumming Independence & Becoming A More Musical Drummer">

    <meta property="og:image" content="https://dzryyo1we6bm3.cloudfront.net/independence-made-easy/sales/thumbnail.jpg" style="display: none;">
    <meta property="og:description" content="Jared Falk's 26-Week Online Course For Building Your Drumming Independence & Becoming A More Musical Drummer">
    <meta property="og:url" content="https://www.drumeo.com/{{ Request::path() }}">

    <link rel="stylesheet" href="{{ mix('marketing/css/app.css') }}">
@stop()

@section('head')
    @parent
    <link href="{{ asset('/marketing/parcel/drumeo/drum-shop-ime.css') }}" rel="stylesheet">

    <?php \App\Analytics\Tracker::trackProductImpression('independence-made-easy'); ?>
@stop()

@section('scripts')
    @parent
    <script type="text/javascript">
        $(document).ready(function () {
            // Dropdown for FAQ section
            $(".question-dropdown").on("click", questionDropdown);

            function questionDropdown() {
                $(this).toggleClass("active");
                $(this).find(".fa-chevron-down").toggleClass("rotated");
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
        "name" => "Independence Made Easy",
        "fullPrice" => floatval($productPrices['independence-made-easy-pack']->price),
        "price" => floatval($productPrices['independence-made-easy-pack']->discounted_price),
        "noBreadcrumb" => true
    ])
    <header class="hero-header">
        <div class="row xlarge">
            <img class="logo" src="https://www.musora.com/musora-cdn/image/width=450,quality=85/https://dzryyo1we6bm3.cloudfront.net/independence-made-easy/sales/logo.png" alt="Independence made easy logo" fetchpriority="high">

            <br>
            <div class="watch-badge">
                <span>WATCH<br> PREVIEW</span>
                <img src="https://www.musora.com/musora-cdn/image/width=180,quality=85/https://dpwjbsxqtam5n.cloudfront.net/sales/arrow-left-white.png" alt="Arrow right" fetchpriority="high">
            </div>
            <img @click="trailer = true;" class="play-button autoplay-video" src="https://www.musora.com/musora-cdn/image/width=150,quality=85/https://dpwjbsxqtam5n.cloudfront.net/sales/play-button.png" alt="Play button" fetchpriority="high">

            {{--<img data-open="previewModal" class="play-button autoplay-video" src="https://dpwjbsxqtam5n.cloudfront.net/sales/play-button.png" aria-controls="previewModal" aria-haspopup="true" tabindex="0">--}}
            {{--<div class="columns video-container">--}}
                {{--<i class="fas fa-play play-icon autoplay-video" data-open="trailer"></i>--}}
            {{--</div>--}}

            <div class="columns text-container">
                <div class="course-logo">
                    <h2>FREEDOM <strong>STARTS HERE</strong></h2>
                </div>
                <p>Unlock your musicality & creativity on <br class="hide-for-medium">
                    the drums through 26 weekly lessons.</p>
                <a href="/ecommerce/add-to-cart?products[independence-made-easy-pack]=1" class="join">Get Started &raquo;</a>
                <p class="uppercase price-info">
                    @if(floatval($productPrices['independence-made-easy-pack']->price) > floatval($productPrices['independence-made-easy-pack']->discounted_price))
                        <s>Normally ${{ floatval($productPrices['independence-made-easy-pack']->price) }}</s> <strong>Only ${{ floatval($productPrices['independence-made-easy-pack']->discounted_price), 2 }}</strong> (Save {{ round(100 - (100 * (floatval($productPrices['independence-made-easy-pack']->discounted_price) / floatval($productPrices['independence-made-easy-pack']->price)))) }}%)
                    @else
                        <strong>Now ${{ floatval($productPrices['independence-made-easy-pack']->discounted_price) }}.</strong>
                    @endif
{{--                    <br>--}}
{{--                    <u class="text-green"><a href="/" style="color:inherit;">(Or get it free with Drumeo)</a></u>--}}
                    <br>
                    <strong class="text-yellow">** 90-Day Guarantee **</strong>
                </p>
            </div>
        </div>
    </header>

    @include('_partials.components.video-modal',[
        'name' => 'trailer',
        'video' => '401069316',
        'vimeo' => true,
    ])

    <div id="triple-benefit">
        <div class="row">
            <h1>Always know <strong>exactly what to practice</strong> <br class="show-for-medium">
                to rapidly improve your drumming.</h1>
            <div class="medium-4 columns half-padding">
                <div class="benefit">
                    <div class="image">
                        <p class="overlay">YOUR WEEKLY<br> LESSON PLAN</p>
                        <img src="https://www.musora.com/musora-cdn/image/width=550,quality=85/https://dzryyo1we6bm3.cloudfront.net/independence-made-easy/sales/jared1.jpg" alt="Jared 1">
                    </div>
                    <div class="text text-left">
                        <p>Jared Falk will be your personal drum coach for 26 weeks - as you’ll follow his step-by-step lesson plan for developing all four limbs on the drums. You’ll get the right exercises in the right order so you’ll rapidly improve your skills (just like when you started playing).</p>
                    </div>
                </div>
            </div>
            <div class="medium-4 columns half-padding">
                <div class="benefit">
                    <div class="image">
                        <p class="overlay">BETTER PRACTICE,<br> BETTER RESULTS</p>
                        <img src="https://www.musora.com/musora-cdn/image/width=550,quality=85/https://dzryyo1we6bm3.cloudfront.net/independence-made-easy/sales/jared2.jpg" alt="Jared 2">
                    </div>
                    <div class="text text-left">
                        <p>This is the ONLY drumming course that will actually get easier to complete as you go along - making it easier to stay motivated, easier to enjoy your practice time again, and easier to actually COMPLETE the full course and reach your personal goals!</p>
                    </div>
                </div>
            </div>
            <div class="medium-4 columns half-padding">
                <div class="benefit">
                    <div class="image">
                        <p class="overlay">PLAY ANYTHING <br> ON THE DRUMS</p>
                        <img src="https://www.musora.com/musora-cdn/image/width=550,quality=85/https://dzryyo1we6bm3.cloudfront.net/independence-made-easy/sales/jared3.jpg" alt="Jared 3">
                    </div>
                    <div class="text text-left">
                        <p>Reaching your goals is all about having a clear vision and a simplified plan to get there! Independence Made Easy is your path to playing more musical grooves, your guide for better sounding fills, and your opportunity to play whatever you want, whenever you want!</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <section id="icon-grid">
        <div class="row">
            <h1>IMPROVE YOUR<br class="hide-for-medium"> HANDS & FEET</h1>
            <p>Gain instant, lifetime access to Jared Falk’s step-by-step lessons, hand-picked exercises,<br class="show-for-medium">
                and detailed practice guides that have already helped more than 3500 happy students!</p>
            <div class="grid-wrap small-up-1 medium-up-3">
                <div class="columns no-padding grid-item">
                    <div class="columns medium-2 no-padding">
                        <i class="fas fa-calendar-alt"></i>
                    </div>
                    <div class="columns medium-10 text-center medium-text-left">
                        <h2>Weekly Lesson Plans</h2>
                        <p>It’s easy to make progress when you know exactly what to do, and when to do it.</p>
                    </div>
                </div>
                <div class="columns no-padding grid-item">
                    <div class="columns medium-2 no-padding">
                        <i class="fas fa-signal"></i>
                    </div>
                    <div class="columns medium-10 text-center medium-text-left">
                        <h2>All Skill Levels</h2>
                        <p>Each lesson will include tips for all levels - so any drummer can improve their results.</p>
                    </div>
                </div>
                <div class="columns no-padding grid-item">
                    <div class="columns medium-2 no-padding">
                        <i class="fas fa-video"></i>
                    </div>
                    <div class="columns medium-10 text-center medium-text-left">
                        <h2>Guided Video Lessons</h2>
                        <p>Learn at your own pace with Jared Falk’s easy-to-follow video lessons.</p>
                    </div>
                </div>
                <div class="columns no-padding grid-item">
                    <div class="columns medium-2 no-padding">
                        <i class="fas fa-cogs"></i>
                    </div>
                    <div class="columns medium-10 text-center medium-text-left">
                        <h2>More Effective Practice</h2>
                        <p>Don’t waste your practice time. Only work on the right exercises, at the right time.</p>
                    </div>
                </div>
                <div class="columns no-padding grid-item">
                    <div class="columns medium-2 no-padding">
                        <i class="fas fa-hands-helping"></i>
                    </div>
                    <div class="columns medium-10 text-center medium-text-left">
                        <h2>Personalized Support</h2>
                        <p>Need help? No problem! Get your biggest questions answered every step of the way.</p>
                    </div>
                </div>
                <div class="columns no-padding grid-item">
                    <div class="columns medium-2 no-padding">
                        <i class="fas fa-infinity"></i>
                    </div>
                    <div class="columns medium-10 text-center medium-text-left">
                        <h2>Lifetime Access</h2>
                        <p>Even though it’s a structured 26-week course, you’ll have unlimited access for life.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="personal-letter">
        <div class="row">
            <h1>Your Clear Path, Frustration-Free<br class="show-for-medium">
                <strong>Guide To Better Drumming!</strong></h1>
            <div class="letter-wrap">
                <div class="columns medium-4 float-right">
                    <img class="hide-for-medium bruce-jared-small" src="https://www.musora.com/musora-cdn/image/width=550,quality=85/https://dzryyo1we6bm3.cloudfront.net/independence-made-easy/sales/jared4.jpg" alt="Jared 4">
                    <div class="arrow-outline show-for-medium">
                        <img src="https://dzryyo1we6bm3.cloudfront.net/independence-made-easy/sales/jared4.jpg" alt="Jared 4">
                    </div>
                </div>
                <div class="columns medium-8 letter">
                    <h2>LETTER FROM JARED FALK:</h2>
                    <p>So often when drummers want to improve their independence, they’re willing to try anything to increase their skills and abilities: so they purchase books, videos, and practice for hours and hours with very little progress.
                        <br><br>
                        What doesn’t seem to work well is a 200-page book that’s loaded with exercises and patterns. Not only is it de-motivating, but you’ll too often find yourself confused about what to practice (and for how long, when to move on, and what to do next).
                        <br><br>
                        Independence Made Easy is different. It doesn’t start easy, but it’s a personally guided drumming course that I’ve designed to get easier and easier while helping you in three ways:
                    </p>
                </div>
                <div class="columns number-paths">
                    <div class="columns path-point no-padding">
                        <div class="icon">
                            <img src="https://www.musora.com/musora-cdn/image/width=250,quality=85/https://dzryyo1we6bm3.cloudfront.net/independence-made-easy/sales/path-1.png" alt="Path 1">
                        </div>
                        <div class="text">
                            <h3>ALWAYS KNOW EXACTLY WHAT TO PRACTICE</h3>
                            <p>...with weekly video lessons, tips, and exercises that are structured to give you a clear-path for making real improvements and achieving measurable results.</p>
                        </div>
                    </div>
                    <div class="columns path-point no-padding">
                        <div class="icon">
                            <img src="https://www.musora.com/musora-cdn/image/width=250,quality=85/https://dzryyo1we6bm3.cloudfront.net/independence-made-easy/sales/path-2.png" alt="Path 2">
                        </div>
                        <div class="text">
                            <h3>GET BETTER AT DRUMS EVERY DAY</h3>
                            <p>...with more enjoyable practice routines and exercises that are structured for rapid improvement. (Remember, just like when you first started playing drums!)</p>
                        </div>
                    </div>
                    <div class="columns path-point no-padding">
                        <div class="icon">
                            <img src="https://www.musora.com/musora-cdn/image/width=250,quality=85/https://dzryyo1we6bm3.cloudfront.net/independence-made-easy/sales/path-3.png" alt="Path 3">
                        </div>
                        <div class="text">
                            <h3>UNLOCK YOUR CREATIVITY</h3>
                            <p>...as you improve your hands and feet - so you’ll be able to play more musical drum grooves, better sounding fills, and putting it all together as a more confident drummer!</p>
                        </div>
                    </div>
                </div>
                <p class="columns">And as an Independence Made Easy student, you’ll never be alone! You’ll be able to connect with an incredible community of students from around the world who are working through the very same course as you, with a clear-path for improving your skills.
                    <br><br>
                    I hope you’ll join me to become the drummer you’ve always wanted to be,
                </p>
                <div class="columns no-padding">
                    <div class="columns signature">
                        <img src="https://www.musora.com/musora-cdn/image/width=450,quality=85/https://dzryyo1we6bm3.cloudfront.net/independence-made-easy/sales/signature.png" alt="Jared Signature">
                    </div>
                    <div class="columns">
                        <div class="sig-point">
                            <span class="icon"><img src="https://www.musora.com/musora-cdn/image/width=50,quality=85/https://dzryyo1we6bm3.cloudfront.net/independence-made-easy/sales/sig-icon-1.png" alt="Icon D"></span>
                            <p>Co-Founder of Drumeo.com</p>
                        </div>
                        <div class="sig-point">
                            <span class="icon"><img src="https://www.musora.com/musora-cdn/image/width=50,quality=85/https://dzryyo1we6bm3.cloudfront.net/independence-made-easy/sales/sig-icon-2.png" alt="Icon SD"></span>
                            <p>Author of Successful Drumming</p>
                        </div>
                        <div class="sig-point">
                            <span class="icon"><img src="https://www.musora.com/musora-cdn/image/width=50,quality=85/https://dzryyo1we6bm3.cloudfront.net/independence-made-easy/sales/sig-icon-3.png" alt="Icon Trophy"></span>
                            <p>Best Drum Educator, Rhythm Magazine</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <div id="social-proof">
        <div class="row">
            <h1><strong>What Drummers Are<br> Saying</strong> About Jared Falk</h1>
            <div class="columns no-padding medium-8">
                <div class="columns instructor-wrap horizontal medium-text-left">
                    <div class="white columns no-padding">
                        <div class="columns no-padding large-6 medium-3 image cobham"></div>
                        <div class="columns large-6 medium-9 text">
                            <h1><strong>Billy Cobham</strong></h1>
                            <h2>Legendary Jazz Fusion Drummer</h2>
                            <p><em>Drumeo is the real deal folks! Jared Falk and his team have my confidence and support in what is done to promote music through the art of drumming and percussion. It is absolutely imperative for the student of the art to SEE, HEAR and EMULATE every lesson that is presented by the instructor. This is accomplished when studying lessons at Drumeo - a good place to study and realize one’s dreams.</em></p>
                        </div>
                    </div>
                </div>
                <div class="columns instructor-wrap medium-6 vertical middle">
                    <div class="white columns no-padding">
                        <div class="columns no-padding image cooper"></div>
                        <div class="columns text">
                            <h1><strong>Casey Cooper</strong></h1>
                            <h2>Most Subscribed Drummer On YouTube</h2>
                            <p><em>After years of watching Jared's lessons on YouTube and Drumeo, and getting to work side by side with him, I can confidently say that he gives every bit of his effort and skill into every product or lesson he teaches. He cares about each and every drummer who will watch and learn from his work and wants nothing more than to change drumming education for the better each time he puts his name on something.</em></p>
                        </div>
                    </div>
                </div>
                <div class="columns instructor-wrap medium-6 vertical middle">
                    <div class="white columns no-padding">
                        <div class="columns no-padding image dornyei"></div>
                        <div class="columns text">
                            <h1><strong>Gabor Dornyei</strong></h1>
                            <h2>Educator, Clinician, & Session Drummer</h2>
                            <p><em>Working with Jared, Dave and the entire Drumeo team has been a life changing experience. These guys are not only the nicest people on Planet Earth, but the most focused and well prepared professionals, who work with infectious smiles on their faces and make you feel and sound the very BEST you can!</em></p>
                        </div>
                    </div>
                </div>
                <div class="columns instructor-wrap horizontal medium-text-left">
                    <div class="white columns no-padding">
                        <div class="columns no-padding large-6 medium-3 image nilles"></div>
                        <div class="columns large-6 medium-9 text">
                            <h1><strong>Anika Nilles</strong></h1>
                            <h2>Drummer & Composer</h2>
                            <p><em>Jared Falk has a comprehensive expert knowledge in providing and structuring lesson plans. He has a great human sense and knows how to handle, host and guide a lesson. It certainly didn’t come overnight. It’s more that he grew over the years to an expert and a professional instructor who really knows how to teach.</em></p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="columns no-padding medium-4">
                <div class="columns instructor-wrap vertical">
                    <div class="white columns no-padding">
                        <div class="columns no-padding image garibaldi"></div>
                        <div class="columns text">
                            <h1><strong>David Garibaldi</strong></h1>
                            <h2>Drummer for Tower Of Power</h2>
                            <p><em>The Drumeo standard is one of the highest quality and is THE place to go for the best in drum education!</em></p>
                        </div>
                    </div>
                </div>
                <div class="columns instructor-wrap vertical">
                    <div class="white columns no-padding">
                        <div class="columns no-padding image redmond"></div>
                        <div class="columns text">
                            <h1><strong>Rich Redmond</strong></h1>
                            <h2>Drummer for Jason Aldean</h2>
                            <p><em>I always look forward to working with Jared and his team. The Drumeo family has created a world class site for continuing education and insight into the world of drumming!</em></p>
                        </div>
                    </div>
                </div>
                <div class="columns instructor-wrap vertical">
                    <div class="white columns no-padding">
                        <div class="columns no-padding image browne"></div>
                        <div class="columns text">
                            <h1><strong>Sean Browne</strong></h1>
                            <h2>Product Manager, Yamaha Drums</h2>
                            <p><em>Drumeo does, through no shortage of sweat and passion for the instrument, elevate the online experience for novice and advanced drummers alike. On behalf of Yamaha Drums International, we congratulate Drumeo for the inspiration they evoke and the professionalism they present.</em></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <section class="compare-table">
        <div class="row">
            <h1>The More Affordable Way To <br>
                <strong>Achieve Your Drumming Goals</strong></h1>
            <table>
                <tbody>
                <tr>
                    <td></td>
                    <td>
                        <img src="https://www.musora.com/musora-cdn/image/width=450,quality=85/https://dzryyo1we6bm3.cloudfront.net/independence-made-easy/sales/laptop.png" class="macbook" alt="Macbook">
                        <img src="https://www.musora.com/musora-cdn/image/width=450,quality=85/https://dzryyo1we6bm3.cloudfront.net/independence-made-easy/sales/logo-b.png" class="blue-logo" alt="Independence made easy logo">
                    </td>
                    <td><i class="fas fa-user gray-logo"></i><br>Private Lessons</td>
                </tr>
                <tr>
                    <td>Weekly Drum Lesson</td>
                    <td><i class="fas fa-check"></i></td>
                    <td><i class="fas fa-check"></i></td>
                </tr>
                <tr>
                    <td>Guided 26-Week Course</td>
                    <td><i class="fas fa-check"></i></td>
                    <td><i class="fas fa-minus"></i></td>
                </tr>
                <tr>
                    <td>Award-Winning Instructor</td>
                    <td><i class="fas fa-check"></i></td>
                    <td><i class="fas fa-minus"></i></td>
                </tr>
                <tr>
                    <td>Learn From Home, Anytime</td>
                    <td><i class="fas fa-check"></i></td>
                    <td><i class="fas fa-minus"></i></td>
                </tr>
                <tr>
                    <td>Re-Watch The Lessons Anytime</td>
                    <td><i class="fas fa-check"></i></td>
                    <td><i class="fas fa-minus"></i></td>
                </tr>
                <tr>
                    <td>Designed To Get Easier</td>
                    <td><i class="fas fa-check"></i></td>
                    <td><i class="fas fa-minus"></i></td>
                </tr>
                <tr>
                    <td>Organized To Save Time</td>
                    <td><i class="fas fa-check"></i></td>
                    <td><i class="fas fa-minus"></i></td>
                </tr>
                <tr>
                    <td>Unlimited Access For Life</td>
                    <td><i class="fas fa-check"></i></td>
                    <td><i class="fas fa-minus"></i></td>
                </tr>
                <tr>
                    <td>Connect With Other Students</td>
                    <td><i class="fas fa-check"></i></td>
                    <td><i class="fas fa-minus"></i></td>
                </tr>
                <tr>
                    <td>World-Class Student Support</td>
                    <td><i class="fas fa-check"></i></td>
                    <td><i class="fas fa-minus"></i></td>
                </tr>
                <tr>
                    <td>Money-Back Guarantee</td>
                    <td><i class="fas fa-check"></i></td>
                    <td><i class="fas fa-minus"></i></td>
                </tr>
                <tr class="prices">
                    <td>Your Total Investment</td>
                    <td>
                        @if(floatval($productPrices['independence-made-easy-pack']->price) > floatval($productPrices['independence-made-easy-pack']->discounted_price))
                            <s>${{ floatval($productPrices['independence-made-easy-pack']->price) }}</s>
                        @endif
                            ${{ floatval($productPrices['independence-made-easy-pack']->discounted_price), 2 }}</td>
                    <td><strong>$50+</strong><br>FOR 1 LESSON</td>
                </tr>
                </tbody>
            </table>
            <p class="columns">
                <strong>You can unlock the full 26-week course today</strong> to get Jared Falk’s best advice for improving your independence on the drums — <u>all for just ${{ round(floatval($productPrices['independence-made-easy-pack']->discounted_price) / 26, 2) }} per week</u> (billed at ${{ floatval($productPrices['independence-made-easy-pack']->discounted_price), 2 }} for the entire course).
                <br><br>
                The entire course is yours for life with no recurring subscription or additional fees.

            </p>
        </div>
    </section>

    <section class="text-center guarantee">
        <div class="row">
            <img class="guarantee-badge hide-for-medium" style="filter: hue-rotate(305deg) brightness(1.13);" src="https://www.musora.com/musora-cdn/image/width=450,quality=85/https://dpwjbsxqtam5n.cloudfront.net/sales/guarantee-badge.png" alt="Guarantee Badge">
            <div class="flex-container">
                <img class="guarantee-badge show-for-medium" style="filter: hue-rotate(305deg) brightness(1.13);" src="https://www.musora.com/musora-cdn/image/width=450,quality=85/https://dpwjbsxqtam5n.cloudfront.net/sales/guarantee-badge.png" alt="Guarantee Badge">
                <div class="text-wrap text-left">
                    <h1>90-Day Money-Back Guarantee</h1>
                    <p><strong>OUR PROMISE TO YOU:</strong> More than anything, we want you to enjoy a super-positive experience on the drums. And that means we only want you to pay if you actually LOVE your Independence Made Easy experience. So click any of the big buttons on this page to get started risk-free. If it’s not for you, simply <a class="text-white" href="{{ get_musora_brand_base_url() }}/contact">contact us</a> within 90 days for a full refund.</p>
                </div>
            </div>
        </div>
    </section>


    <section class="final" style="background-image:url(https://dpwjbsxqtam5n.cloudfront.net/drum-technique-made-easy/customize-bg.jpg);">
        <div class="row">
            <div class="columns logo"><img src="https://www.musora.com/musora-cdn/image/width=950,quality=85/https://dzryyo1we6bm3.cloudfront.net/independence-made-easy/sales/logo.png" alt="Independence made easy logo"></div>

            <h1 class="columns">
                Jared Falk’s 26-Week Online <br class="hide-for-large">
                Course For Just ${{ round(floatval($productPrices['independence-made-easy-pack']->discounted_price) / 26, 2) }} Per Week</h1>

            <div class="columns"><a href="/ecommerce/add-to-cart?products[independence-made-easy-pack]=1" class="join">Get Started &raquo;</a></div>

            <h2 class="columns uppercase">
                @if(floatval($productPrices['independence-made-easy-pack']->price) > floatval($productPrices['independence-made-easy-pack']->discounted_price))
                    <s>Normally ${{ floatval($productPrices['independence-made-easy-pack']->price) }}</s> <strong>Only ${{ floatval($productPrices['independence-made-easy-pack']->discounted_price), 2 }}</strong> (Save {{ round(100 - (100 * (floatval($productPrices['independence-made-easy-pack']->discounted_price) / floatval($productPrices['independence-made-easy-pack']->price)))) }}%)
                @else
                    <strong>Now ${{ floatval($productPrices['independence-made-easy-pack']->discounted_price) }}.</strong>
                @endif
{{--                <br>--}}
{{--                <u class="text-green"><a href="/" style="color:inherit;">(Or get it free with Drumeo)</a></u>--}}
                <br>
                <strong class="text-yellow">** 90-Day Guarantee **</strong>
            </h2>

            <div class="columns cards">
                <i class="fab fa-cc-visa"></i> <i class="fab fa-cc-mastercard"></i> <i class="fab fa-cc-amex"></i>
                <i class="fab fa-cc-paypal"></i>
                <i class="fab fa-cc-discover"></i>
            </div>
            <p class="columns final-questions">
                <span><strong>Any questions?</strong></span> You can also call us or order by phone<br class="hide-for-large"> toll-free at
                <a href="tel:+18004398921">1-800-439-8921</a><br class="hide-for-medium"> or directly at
                <a href="tel:+16048557605">1-604-855-7605</a>.<br> All prices listed in USD.</p>
        </div>
    </section>

    <div class="questions">
        <div class="row">
            <h1>Still Have Questions?</h1>
            <div class="columns">
                @include('_partials.components.question-dropdown', [
                "num" => "?",
                "title" => "When does the course officially start?",
                "desc" => "You’ll get the entire 26-week course immediately, so you can start on your own schedule."
                ])
                @include('_partials.components.question-dropdown', [
                "num" => "?",
                "title" => "Will I still have full access to the course after 26 weeks?",
                "desc" => "Yes! Even though it’s designed as a 26-week course, you’ll have LIFETIME online access to everything inside Independence Made Easy, so you can review the materials or re-watch the lessons, anytime."
                ])
                @include('_partials.components.question-dropdown', [
                "num" => "?",
                "title" => "What if I can’t follow the lessons EVERY week?",
                "desc" => "You’ll get 26 weekly lessons and exercises. And while they’re intended to be completed week-after-week, we know that everybody’s schedules are different - so we’ve included progress-tracking so you never lose your spot. If you need to miss a week, that’s fine! You’ll have lifetime access to the entire course so you’ll never lose your spot — and you can continue whenever it’s most convenient for you."
                ])
                @include('_partials.components.question-dropdown', [
                "num" => "?",
                "title" => "Do these lessons work for electronic and acoustic drum-sets? ",
                "desc" => "Yes, the lessons will work on both electric and acoustic drum-sets. Since you'll be developing your drumming independence, you can actually practice on anything - even pots and pans if you want!"
                ])
                @include('_partials.components.question-dropdown', [
                "num" => "?",
                "title" => "How much time per week will this course require?",
                "desc" => "For time invested, obviously the more time you practice the faster you’ll get better. But we recommend investing at least 2-3 hours per week to truly benefit from this course."
                ])
            </div>
        </div>
    </div>
@stop
