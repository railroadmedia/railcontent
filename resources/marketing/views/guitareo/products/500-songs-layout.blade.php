@extends('guitareo._partials.global-vue-layout')

@section('meta')
    <title>500 Songs In 5 Days | Guitareo</title>
    <meta name="description" content="This training pack will give you the skills and knowledge to quickly learn and play 500 popular songs from a variety of eras and styles.">

    <meta property="og:image" content="https://d122ay5chh2hr5.cloudfront.net/500-songs/header.jpg" style="display: none;">
    <meta property="og:title" content="Learn To Play Guitar With 500 Songs In 5 Days">
    <meta property="og:description" content="This training pack will give you the skills and knowledge to quickly learn and play 500 popular songs from a variety of eras and styles.">
    <meta property="og:url" content="https://www.guitareo.com/500-songs">
@stop()

@section('styles')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/foundation/6.5.3/css/foundation-float.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('/marketing/parcel/guitareo/nav-footer.css') }}">
    @include('_partials.layout._tailwindcdn')
    <link rel="stylesheet" href="{{ asset('/marketing/css/tailwind-helpers.css') }}">
    <link rel="stylesheet" href="{{ asset('/marketing/parcel/guitareo/500-songs.css') }}">
    <style>

        .join.smaller {
            padding:8px 12px;
            font-size:13px;
        }

        @media only screen and (min-width:40em) {

            .join.smaller {
                font-size:14px;
                padding:13px 30px;
            }
        }
    </style>
@stop()

@section('scripts')
    <script src="{{ asset('/marketing/js/modal.js') }}"></script>
    <script src="{{ asset('/marketing/parcel/drumeo/navigation-sales.js') }}"></script>
    <script>
        $(document).ready(function () {
            $(document).foundation();

            $('#uncoverAll').on('click', function (e) {
                e.stopPropagation();
                e.preventDefault();
                $('.song-list').addClass('show-all');
                $(this).addClass('hide');
            });

            //modal video swapping
            $('.play-vimeo').on('click', function (ev) {
                $("#vimeo")[0].src += "?autoplay=1";
                ev.preventDefault();
            });
            $('body').on('click', '.reveal-overlay', function () {
                var newSource2 = $("#vimeo").attr('src').replace("?autoplay=1", "");
                $("#vimeo").attr('src', newSource2);
            });

            $('#icon-grid .toggle').on('click', function () {
                $('#icon-grid .lesson-descriptions').addClass('active');
                $(this).addClass('active');
            });
        });
    </script>
@stop()

@section('content')
    @include("guitareo.sales.partials._nav", [
        "cartVersion" => true
    ])

    @yield('topbar')

    <header class="header text-center">

        <div class="row">
            <img class="logo" src="https://d122ay5chh2hr5.cloudfront.net/500-songs/logo.svg" alt="500 songs logo">
            <br><i class="fas fa-play play-vimeo play-button" data-open="trailer"></i>
            <h2>Build The Knowledge & Skills To Play<br>
                <strong>500 Songs On The Guitar</strong> In 5 Days</h2>
            <a class="join" href="@yield('order-link')" @yield('product-json')>Get Started &raquo;</a>
            <p class="breakdown">
                @if(floatval($productPrices['500-songs-in-5-days-guitareo']->price) > $productPrice)
                    <s>NORMALLY ${{ floatval($productPrices['500-songs-in-5-days-guitareo']->price) }}.</s> &nbsp;<strong class="text-guitareo"><u>ONLY ${{ $productPrice }}</u></strong>&nbsp; (SAVE {{ round(100 - (100 * ($productPrice / floatval($productPrices['500-songs-in-5-days-guitareo']->price)))) }}%)
                @else
                    <strong class="text-guitareo"><u>ONLY ${{ $productPrice }}</u></strong>
                @endif

                <br>
                <strong class="yellow">** 90-DAY GUARANTEE **</strong></p>
        </div>
    </header>

    <div class="reveal large trailer" id="trailer" data-reveal data-reset-on-close="true">
        <div class="flex-video widescreen vimeo">
            <iframe id="vimeo" src="//player.vimeo.com/video/367374216" frameborder="0" allowfullscreen allow="autoplay"></iframe>
        </div>
    </div>


    @yield('banner')

    <section class="day-breakdown text-center">
        <div class="row">
            <h1>The Fastest Way To Playing Your<br class="show-for-medium"> Favorite Songs... <u class="text-guitareo">For Just ${{ $productPrice }}</u></h1>
            @if(floatval($productPrices['500-songs-in-5-days-guitareo']->price) > $productPrice)
                <h3><em><s>NORMALLY ${{ floatval($productPrices['500-songs-in-5-days-guitareo']->price) }}</s></em></h3>
            @else
                <h3>&nbsp;</h3>
            @endif
            <div class="day-slice">
                <div class="day-thumbnail">
                    <img src="https://d122ay5chh2hr5.cloudfront.net/500-songs/thumb1.jpg" alt="Day 1 thumbnail">
                    <div class="top-badge">DAY 1</div>
                </div>
                <p><strong>The Million Dollar Chord Progression</strong><br>
                    Learn the four basic chords used in hundreds of popular songs and how to instantly play dozens of songs in just a few minutes.
                </p>
            </div>
            <div class="day-slice">
                <div class="day-thumbnail">
                    <img src="https://d122ay5chh2hr5.cloudfront.net/500-songs/thumb2.jpg" alt="Day 2 thumbnail">
                    <div class="top-badge">DAY 2</div>
                </div>
                <p><strong>The Chord Chart</strong><br>
                    How to order and re-order chords in progressions that you KNOW will sound good. You’ll learn how this is done in popular music, and just how common it is.
                </p>
            </div>
            <div class="day-slice">
                <div class="day-thumbnail">
                    <img src="https://d122ay5chh2hr5.cloudfront.net/500-songs/thumb3.jpg" alt="Day 3 thumbnail">
                    <div class="top-badge">DAY 3</div>
                </div>
                <p><strong>Changing Keys with a Capo</strong><br>
                    Learn the easiest way to change keys but not chord shapes using a capo so you can play along with vocals in any range, and songs in any key.
                </p>
            </div>
            <div class="day-slice">
                <div class="day-thumbnail">
                    <img src="https://d122ay5chh2hr5.cloudfront.net/500-songs/thumb4.jpg" alt="Day 4 thumbnail">
                    <div class="top-badge">DAY 4</div>
                </div>
                <p><strong>The “Other” Chords</strong><br>
                    Master chord variations to really impact your playing. Gain a deeper understanding of inversions, slash, and suspended chords -- and even more importantly -- how to use them in songs.
                </p>
            </div>
            <div class="day-slice">
                <div class="day-thumbnail">
                    <img src="https://d122ay5chh2hr5.cloudfront.net/500-songs/thumb5.jpg" alt="Day 5 thumbnail">
                    <div class="top-badge">DAY 5</div>
                </div>
                <p><strong>Adding Style & Flair</strong><br>
                    Tips to make you instantly sound better - simply by adding strumming & fingerstyle technique to your playing. This includes walkdowns, palm mutes and a variety of strum patterns.
                </p>
            </div>
            <hr>
            <div class="day-slice bonus">
                <div class="day-thumbnail">
                    <img src="https://d122ay5chh2hr5.cloudfront.net/500-songs/thumb-bonus1.jpg" alt="Bonus 1 thumbnail">
                    <div class="top-badge">BONUS #1</div>
                </div>
                <p><strong>Even More Keys</strong><br>
                    Build on the knowledge gained in the first five lessons by learning the essential chords for more keys so you can level up your skills even further.
                </p>
            </div>
            <div class="day-slice bonus">
                <div class="day-thumbnail">
                    <img src="https://d122ay5chh2hr5.cloudfront.net/500-songs/thumb-bonus2.jpg" alt="Bonus 2 thumbnail">
                    <div class="top-badge">BONUS #2</div>
                </div>
                <p><strong>Raising the Bar</strong><br>
                    Learn the simple hack using bar chords for any major key so you can play along to your favorite songs all over the fretboard.
                </p>
            </div>
        </div>
    </section>

    <div id="songs" class="anchor"></div>
    <section class="more-songs">
        <div class="row">
            <img src="https://d122ay5chh2hr5.cloudfront.net/500-songs/more-songs-icons.png" alt="More songs icon">
            <h1>More Songs Than<br class="hide-for-medium"> You'll Ever Need</h1>
            <h4>This training pack was designed to give you the skills and knowledge to quickly learn and play 500 songs from a variety of eras and styles.
                <br><br>
                And it's NOT about memorizing 500 songs. Instead, you'll get the tips and tricks for playing almost any popular song by using chord charts.
                <br><br>
                But "play almost any song" just wasn't catchy enough ;) So we're giving you <strong>downloadable chord charts for 500 songs</strong> to PROVE that you'll be able to play so many of the songs you love.
                <br><br>
                Here's an example: <a target="_blank" href="https://d122ay5chh2hr5.cloudfront.net/500-songs/500-songs-let-it-be-the-beatles.pdf"><u>Open PDF &raquo;</u></a>
                <br><br>
                Here is every song that's included:
            </h4>
            <div class="song-list">
                @include('guitareo.products._songs')
            </div>
            <div class="text-center">
                <span id="uncoverAll" class="join outline white">Show All</span>
            </div>
        </div>
    </section>

    <section class="play-songs text-center">
        <div class="row">
            <h1>Your Clear Path To <br class="hide-for-large">
                Playing Songs You Love</h1>
            <h4>Get Nate & Chelsea’s personalized training pack that will teach you songs faster, and give you the <br class="show-for-large">
                skills to play 500 songs (and many more). You won’t be left alone either, as you will have direct <br class="show-for-large">
                access to Nate and other teachers to answer your questions and provide support when you need it.</h4>
            <div class="four-benefits">
                <div class="benefit-tile columns small-6">
                    <i class="fas fa-list-ol"></i>
                    <p><strong>GUIDED LESSONS</strong><br>
                        You’ll know exactly what to play and practice next with our carefully designed step-by-step lessons.
                    </p>
                </div>
                <div class="benefit-tile columns small-6">
                    <i class="fas fa-music"></i>
                    <p><strong>PLAY POPULAR SONGS</strong><br>
                        You’ll have the skills to play literally hundreds of songs, and an immediate library of songs to choose from.
                    </p>
                </div>
                <div class="benefit-tile columns small-6">
                    <i class="icon-chords-scales-guitareo"></i>
                    <p><strong>FRETBOARD FLUIDITY</strong><br>
                        The bonus lessons will elevate your playing by teaching you skills you can apply all over the fretboard.
                    </p>
                </div>
                <div class="benefit-tile columns small-6">
                    <i class="fas fa-question"></i>
                    <p><strong>YOUR BIGGEST QUESTIONS</strong><br>
                        Ask your biggest questions and get personalized feedback from teachers and connect with other students.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <section class="personal-teacher">
        <div class="background">
            <div class="row">
                <div class="columns medium-4 large-6 float-right text-left medium-text-center">
                    <img src="https://d122ay5chh2hr5.cloudfront.net/500-songs/teachers.png" alt="Nate and Chelsea">
                </div>
                <div class="columns end medium-8 large-6 text-wrap">
                    <h2><strong>Nate Savage & Chelsea Amber:<br class="show-for-large">
                            Your Personal Guitar Teachers</strong></h2>
                    <p><em>"Nate has a teaching style that puts you at ease with a warm and down to earth tone that makes him relatable and his lessons are enjoyable which makes you WANT to continue learning."</em></p>
                    <div class="avatar-name"><img src="https://s3.amazonaws.com/guitareo/sales/testimonials/emily-judd.jpg" alt="Nate and Chelsea"> <p><strong>EMILY KATE JUDD</strong><br><em>AUSTRALIA</em></p></div>
                </div>
            </div>
        </div>
    </section>

    <section class="teacher-bio">
        <div class="row">
            <p><span class="first-letter">N</span>ate Savage is trusted by guitarists around the world for his popular YouTube lessons and organized training programs including The Guitar System, Acoustic Guitar Made Easy, Guitar Technique Made Easy, and The Guitareo Membership.
                <br><br>
                And now, he's partnering with his talented wife, Chelsea Amber -- a touring singer and songwriter -- to help guitarists gain an advantage for learning and playing songs faster!
                <br><br>
                "Being able to learn and play songs quickly is vital," says Nate. "If you're just starting out, you need to learn songs faster to gain momentum and fall in love with this instrument. And if you're a more established guitarist, knowing how to learn songs quickly will help you land more gigs and play with more confidence anywhere you go."
                <br><br>
                Nate and Chelsea will be your dynamic duo as you learn everything you need to play 500 songs in less than a week. Together, they'll bring their passion for playing and teaching to give you the shortcuts, cheat codes, and proven tips for learning almost any song on the guitar. And to prove it, 500 Songs In 5 Days includes chord charts for the exact 500 songs you'll be able to play when you've completed your lessons.
                <br><br>
                "It's easy to get distracted by complicated theory and topics that make your brain hurt," Nate adds, "but we all picked up the guitar because we wanted to play music. That's what it's all about."
            </p>
        </div>
    </section>

    <div class="testimonials">
        <div class="row">
            <div class="testimonial medium-4 columns">
                <img src="https://d122ay5chh2hr5.cloudfront.net/500-songs/erick.jpg" alt="Erick Kahlenberg">
                <p><em>"Free lessons are great, but fumbling through in no particular order isn't the best way to learn new skills. Nate introduces new skills and combines them with practice of previously learned material that makes the learning stick. Nate presents everything clearly, and each lesson is just another small step on the path. None of the lessons are overwhelming or trying to provide too much at one time."</em><br>
                    <strong>ERICK KAHLENBERG</strong>
                    <em class="red">WISCONSIN</em></p>
            </div>
            <div class="testimonial medium-4 columns">
                <img src="https://d122ay5chh2hr5.cloudfront.net/500-songs/don.jpg" alt="Don Tatarelli">
                <p><em>"I wasn’t sure I would be able to learn with online instruction. I checked out YouTube videos of instructors and really liked Nate’s style the most. His lessons are organized and well planned. Others seem to bounce all over the place or are so impressed with themselves that they talk down to students."</em><br>
                    <strong>DON TATARELLI</strong>
                    <em class="red">NEVADA</em></p>
            </div>
            <div class="testimonial medium-4 columns">
                <img src="https://d122ay5chh2hr5.cloudfront.net/500-songs/james.jpg" alt="James Mcdowell">
                <p><em>"When I first started playing guitar, it was frustrating because of the lack of a path to follow. I felt like stopping altogether. It was when Nate broke down the song Brown Eyed Girl when I got it. I was finally able to get through the entire thing... quite a milestone for me!"</em><br>
                    <strong>JAMES MCDOWELL</strong>
                    <em class="red">WASHINGTON</em></p>
            </div>
        </div>
    </div>

    <section class="guarantee">
        <div class="row">
            <div class="large-4 medium-5 columns float-right guarantee-icon">
                <img src="https://d122ay5chh2hr5.cloudfront.net/sales/90-day.png" alt="90-Day Money-Back Guarantee">
            </div>
            <div class="large-8 medium-7 columns end guarantee-text">
                <h1>90-Day Money-Back Guarantee.</h1>
                <p>We love our students. More than anything, we want you to enjoy a super-positive experience playing guitar. And that means we only want you to pay if you actually LOVE your Guitareo experience! So join below to try it out totally risk-free. If it’s not for you, simply <a class="text-white" href="{{ get_musora_brand_base_url() }}/contact">contact us</a> within 90 days to request a full refund.</p>
            </div>
        </div>
    </section>

    <section class="final text-center">
        <div class="row">
            {{--<img class="logo edge" src="https://d122ay5chh2hr5.cloudfront.net/sales/promos/cyber-monday/logo.png"><br>--}}
            <img class="h-12 md:h-16 lg:h-20 mb-2 md:mb-4" src="https://d122ay5chh2hr5.cloudfront.net/500-songs/logo.svg" alt="500 songs logo">
            <h2>Build The Knowledge & Skills To Play<br>
                <strong>500 Songs On The Guitar</strong> In 5 Days</h2>

            <a href="@yield('order-link')" class="join tracking-normal my-2 md:my-4" @yield('product-json')>Get Started &raquo;</a>
            <p class="breakdown">
                @if(floatval($productPrices['500-songs-in-5-days-guitareo']->price) > $productPrice)
                    <s>NORMALLY ${{ floatval($productPrices['500-songs-in-5-days-guitareo']->price) }}.</s> &nbsp;<strong class="text-guitareo"><u>ONLY ${{ $productPrice }}</u></strong>&nbsp; (SAVE {{ round(100 - (100 * ($productPrice / floatval($productPrices['500-songs-in-5-days-guitareo']->price)))) }}%)
                @else
                    <strong class="text-guitareo"><u>ONLY ${{ $productPrice }}</u></strong>
                @endif
                <br>
                <strong class="yellow">** 90-DAY GUARANTEE **</strong></p>
            <div class="credit-cards columns">
                <i class="fab fa-cc-visa"></i>
                <i class="fab fa-cc-mastercard"></i>
                <i class="fab fa-cc-amex"></i>
                <i class="fab fa-cc-paypal"></i>
            </div>
            <div class="columns questions">
                <p><strong>Any questions?</strong><br class="hide-for-medium">
                    Call us toll-free at <a href="tel:+18004398921">1-800-439-8921</a> <br class="hide-for-medium">
                    or directly at <a href="tel:+16048557605">1-604-855-7605</a>.<br>
                    All prices listed in USD. </p>
            </div>
        </div>
    </section>


    @include("guitareo.sales.partials._footer")
@stop
