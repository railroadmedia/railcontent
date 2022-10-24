@extends('pianote._partials.global-layout')

@section('global-head')
    <title>500 Songs In 5 Days | Pianote</title>
    <meta name="description" content="Develop The Skills To Play 500+ Songs On The Piano In 5 Days">

    <meta property="og:image" content="https://d2vyvo0tyx8ig5.cloudfront.net/500-songs/sales/og-image.jpg" style="display: none;">
    <meta property="og:title" content="500 Songs In 5 Days">
    <meta property="og:description" content="Develop The Skills To Play 500+ Songs On The Piano In 5 Days">
    <meta property="og:url" content="https://www.pianote.com/500-songs">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.4.1/css/bootstrap.min.css">
    <link href="{{ asset('/marketing/parcel/pianote/nav-footer.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="/marketing/parcel/pianote/500-songs.css">
    <link href="https://fonts.googleapis.com/css?family=Permanent+Marker&display=swap" rel="stylesheet">
@stop

@section('global-body')
    @include('pianote.sales.nav', [
        "cartVersion" => true
    ])

    {{--check blog sidebar--}}
    @hasSection('topbar')
        @yield('topbar')
    @endif

    <header class="header text-center">
        <div class="container">
            <img class="logo" src="https://d2vyvo0tyx8ig5.cloudfront.net/500-songs/sales/500-songs-logo.svg">

            <br>
            <i class="fas fa-play play-vimeo autoplay-video" data-toggle="modal" data-target="#trailer"></i>
            {{--<h2>Develop The Skills To Play--}}
                {{--@hasSection('name')--}}
                   {{--songs by<br class="hidden-sm hidden-md hidden-lg"> <strong>@yield('name')</strong>--}}
                {{--@else--}}
                    {{--<strong>500+<br class="hidden-sm hidden-md hidden-lg"> Songs On The Piano</strong>--}}
                {{--@endif--}}
                {{--<em>In 5 Days</em></h2>--}}
            <h2>
                @hasSection('header-text')
                    @yield('header-text')
                @else
                    Play <strong>real songs</strong> from your very first lesson.<br class="hidden-xs">
                    Achieve your goals with <strong>500 Songs in 5 Days</strong>.
                @endif
            </h2>
            <a @hasSection('product-json')
                    class="join vue-add-to-cart" @yield('product-json')
                @else
                    class="join"
                @endif href="@yield('order-link')">Get Started &raquo;</a>
            <p class="breakdown">
                @hasSection('badge')
                    @yield('badge')
                @endif
                @if(PianotePrices::$songs500Full > $productPrice)
                        <s>NORMALLY ${{ PianotePrices::$songs500Full }}.</s> &nbsp;<strong><u>ONLY ${{ $productPrice }}</u></strong>&nbsp; (SAVE {{ round(100 - (100 * ($productPrice / PianotePrices::$songs500Full))) }}%)
                @else
                    <strong><u>ONLY ${{ $productPrice }}</u></strong>
                @endif
                    <br><a href="/" class="red">(OR FREE WITH A PIANOTE MEMBERSHIP)</a><br>
                    <span style="text-transform:uppercase">ONLY <span class="tzcd-full"></span> LEFT!</span><br>
                <strong class="yellow">** 90-DAY GUARANTEE **</strong></p>
            @yield('badge-2')
        </div>
    </header>

    <div class="modal fade text-center" id="trailer" tabindex="-1" role="dialog" aria-labelledby="trailerLabel">
        <i class="close stop-play fas fa-times" data-dismiss="modal" aria-label="Close"></i>
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="embed-responsive embed-responsive-16by9">
                    @hasSection('video')
                        @yield('video')
                    @else
                        <iframe class="embed-responsive-item reset-on-close" src="" data-lazy-load-url="//player.vimeo.com/video/347561373?autoplay=1" frameborder="0" allowfullscreen allow="autoplay"></iframe>
                    @endif
                </div>
                <a @hasSection('product-json')
                    class="join stop-play vue-add-to-cart" @yield('product-json')
                @else
                    class="join stop-play"
                @endif href="@yield('order-link')" data-dismiss="modal" aria-label="Close">Get Started</a>
            </div>
        </div>
    </div>


    @hasSection('banner')
        @yield('banner')
    @endif


    <section class="day-breakdown text-center">
        <div class="container">
            <h1>
                @hasSection('name')
                    The Fastest Way To Learn How To <br class="hidden-xs">
                    Play Songs By @yield('name') -- And Tons <br class="hidden-xs">
                    Of Popular Artists -- <u>For Just ${{ $productPrice }}
                    </u>
                @else
                    The Fastest Way To Learn How<br class="hidden-xs"> To Play Songs -- <u>For Just ${{ $productPrice }}</u>
                @endif
            </h1>
            @if(PianotePrices::$songs500Full > $productPrice)
                <h3><em><s>NORMALLY ${{ PianotePrices::$songs500Full }}</s></em></h3>
                @else

                <h3>&nbsp;</h3>
            @endif
            <div class="day-slice">
                <div class="day-thumbnail @hasSection('lesson-watched') watched @endif">
                    <img src="https://d2vyvo0tyx8ig5.cloudfront.net/500-songs/sales/the-songs.jpg">
                    @hasSection('lesson-watched')
                        <div class="badge-watched">WATCHED</div>
                    @endif
                    <div class="top-badge">DAY 1</div>
                    <div class="bottom-badge hide">14:48</div>
                </div>
                <p><strong>The Song Chords</strong><br>
                    Learn the basic chords used in hundreds of popular songs and how to order them to instantly play dozens of songs in just a few minutes.
                </p>
            </div>
            <div class="day-slice">
                <div class="day-thumbnail">
                    <img src="https://d2vyvo0tyx8ig5.cloudfront.net/500-songs/sales/the-order.jpg">
                    <div class="top-badge">DAY 2</div>
                    <div class="bottom-badge hide">13:43</div>
                </div>
                <p><strong>The Order</strong><br>
                    How to order (and re-order) chords in progressions that you KNOW will sound good. You’ll learn how this is done in popular music, and just how common it is.
                </p>
            </div>
            <div class="day-slice">
                <div class="day-thumbnail">
                    <img src="https://d2vyvo0tyx8ig5.cloudfront.net/500-songs/sales/adding-style-flair.jpg">
                    <div class="top-badge">DAY 3</div>
                    <div class="bottom-badge hide">11:37</div>
                </div>
                <p><strong>Adding Style & Flair</strong><br>
                    Tips to make you instantly sound better - by adding complexity and fills to your chording. This includes walking basslines, chord fills, and a look at new rhythms.
                </p>
            </div>
            <div class="day-slice">
                <div class="day-thumbnail">
                    <img src="https://d2vyvo0tyx8ig5.cloudfront.net/500-songs/sales/inversions.jpg">
                    <div class="top-badge">DAY 4</div>
                    <div class="bottom-badge hide">15:09</div>
                </div>
                <p><strong>The Inversions</strong><br>
                    Learn big concepts that will have a HUGE impact on your playing. Get a deep understanding of inversions and how to build them. And more importantly how to use them in songs.
                </p>
            </div>
            <div class="day-slice">
                <div class="day-thumbnail">
                    <img src="https://d2vyvo0tyx8ig5.cloudfront.net/500-songs/sales/the-key.jpg">
                    <div class="top-badge">DAY 5</div>
                    <div class="bottom-badge hide">11:22</div>
                </div>
                <p><strong>The Keys</strong><br>
                    How to transpose and play chords in any key. How to know what notes are in each key, thanks to the Circle of 5ths.
                </p>
            </div>
            <hr>
            <div class="day-slice bonus">
                <div class="day-thumbnail">
                    <img src="https://d2vyvo0tyx8ig5.cloudfront.net/500-songs/sales/complex-chords.jpg">
                    <div class="top-badge">BONUS #1</div>
                    <div class="bottom-badge hide">15:13</div>
                </div>
                <p><strong>Complex Chords</strong><br>
                    How to build more complicated and bigger chords. How to also play any chords that are NOT in the original key. How to build a chord on ANY key of the piano.
                </p>
            </div>
            <div class="day-slice bonus">
                <div class="day-thumbnail">
                    <img src="https://d2vyvo0tyx8ig5.cloudfront.net/500-songs/sales/the-melody.jpg">
                    <div class="top-badge">BONUS #2</div>
                    <div class="bottom-badge hide">9:08</div>
                </div>
                <p><strong>The Melody</strong><br>
                    Find and play the melody to any song by basing it on the chord progression we are using. Develop ear training to improve your ability to ‘hear’ and then play melodies.
                </p>
            </div>
        </div>
    </section>

    <div id="moreSongs" class="anchor"></div>
    <section class="more-songs">
        <div class="container">
            <img class="yellow-red-icons" src="https://d2vyvo0tyx8ig5.cloudfront.net/500-songs/sales/more-songs-icons.png">
            <h1>More Songs Than<br class="hidden-sm hidden-md hidden-lg"> You'll Ever Need</h1>
            <h4>This training pack will teach you the skills to <em>play nearly any popular song on the piano</em> using chord charts. We won’t take up hours of your time to do this -- because we know you’d rather be playing songs than watching videos.
                <br><br>
                But here at Pianote, we do believe in over-delivering. So beyond the five lessons that will teach you how to play 500 songs AND the two bonus lessons, you’ll also get:
                <br><br>
                <strong>Downloadable chord charts for 500 SONGS that are yours to keep FOREVER!</strong>
                <br><br>
                Here's an example: <a target="_blank" href="https://d2vyvo0tyx8ig5.cloudfront.net/500-songs/sales/500-songs-let-it-be-the-beatles.pdf"><u>Open PDF &raquo;</u></a>
                <br><br>
                Don’t believe us? Here is every song that’s included:
            </h4>
            @hasSection('albums-url')
                <img class="album-banner" src="@yield('albums-url')">
            @endif
            <div class="song-list">
                @include('products._songs')
            </div>
            <div class="text-center">
                <a id="uncoverAll" class="join outline white">Show All</a>
            </div>
        </div>
    </section>

    <section class="play-songs text-center">
        <div class="container">
            <h1>Your Clear Path<br class="hidden-sm hidden-md hidden-lg"> To Playing Songs</h1>
            <h4>Get Lisa’s personalized training pack that will teach you songs faster, and give you the skills to<br class="hidden-xs">
                play 500 songs (and many more). You won’t be left alone either, as you will have direct access to<br class="hidden-xs">
                Lisa and other teachers to answer your questions and provide support when you need it.</h4>
            <div class="four-benefits">
                <div class="benefit-tile col-xs-12 col-sm-6">
                    <i class="fas fa-list-ol"></i>
                    <p><strong>GUIDED LESSONS</strong><br>
                        You’ll know exactly what to play and practice next with our carefully designed step-by-step lessons.
                    </p>
                </div>
                <div class="benefit-tile col-xs-12 col-sm-6">
                    <i class="fas fa-music"></i>
                    <p><strong>PLAY POPULAR SONGS</strong><br>
                        You’ll have the skills to play literally hundreds of songs, and an immediate library of songs to choose from.
                    </p>
                </div>
                <div class="benefit-tile col-xs-12 col-sm-6">
                    <i class="fas fa-piano-keyboard"></i>
                    <p><strong>KEYBOARD FLUIDITY</strong><br>
                        The bonus lessons will elevate your playing by teaching you fast runs and fancy fills.
                    </p>
                </div>
                <div class="benefit-tile col-xs-12 col-sm-6">
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
            <div class="container">
                <h1>Lisa Witt: Your Personal<br class="hidden-xs">
                Piano Teacher</h1>
                <p><em>"This was my first attempt at the piano and I learned songs on the first day. 500 Songs in 5 Days cut through to the fun parts early on. The lessons are concise with clear goals showing where I currently am and what it takes to be where I want to be, it provides small victories along the way that keep me interested - I have never seen lessons on any instrument as good as 500 Songs in 5 Days."</em></p>
                <div class="avatar-name"><img src="https://d2vyvo0tyx8ig5.cloudfront.net/500-songs/sales/connor.jpg"> <p><strong>CONNOR BECKETT</strong><br><em>UNITED KINGDOM</em></p></div>
            </div>
        </div>
    </section>

    <section class="teacher-bio">
        <div class="container">
            <p><span class="first-letter"><img src="https://d2vyvo0tyx8ig5.cloudfront.net/500-songs/sales/big-l.png"></span>isa Witt has been teaching the piano for 18 years and in that time has helped hundreds of students realize their musical dreams. Now she’s here to help you.
                <br><br>
                Lisa’s contagious enthusiasm will have you excited to practice and return to the keys for your next lesson. Her teaching style makes lessons fun and focused on you and your learning.
                <br><br>
                “I love witnessing the moments when the student catches on to a new concept. The confidence that comes from working hard for something and achieving it makes teaching the best job in the world,” she says.
                <br><br>
                She has now taken that teaching to Pianote, helping thousands of students all around the world. Her latest project is 500 Songs in 5 days. Five lessons that WILL have you playing hundreds of songs on the piano, even if you cannot read music.
                <br><br class="hidden-sm hidden-md hidden-lg">
                “New students often don’t realize that they can play the music they want to play within a short period of time,” she says.
                <br><br>
                “Yes it takes work and effort to learn but the payoffs begin way faster than you’d think!”
                <br><br>
                500 Songs in 5 days is Lisa’s personally designed, step-by-step curriculum to teach you the chords and concepts behind hundreds of popular songs. Aside from the five lessons, you’ll get two BONUS lessons that introduce more advanced concepts around transposition and melody.
                <br><br>
                If you want to play songs on the piano, there is no better way to learn them than 500 Songs in 5 Days.
                <br><br>
                “I can’t wait for you to realize just what’s possible for you on the piano.”
            </p>
        </div>
    </section>

    <div id="testimonials" class="anchor"></div>
    <section class="testimonial-vids text-center">
        <div class="container">
            <h1>Real Students. <br class="hidden-sm hidden-md hidden-lg"><strong>Real Success Stories.</strong></h1>
            <h4>See how 500 Songs in 5 Days has helped students discover new <br class="hidden-xs">
                passions, reach new goals, and in some cases, draw families closer.</h4>

            <div class="testimonial col-xs-12 col-sm-4">
                <div class="thumb hover-scale autoplay-video" style="background-image:url(https://i.vimeocdn.com/video/923770586-9e9947501c113bc7aa2cc198a9b11ef1bbbc46bedaa6d7d62fb0061cb3e513c4-d_320);" data-toggle="modal" data-target="#testimonial1">
                    <div class="text">JIMI'S<br>STORY</div>
                    <i class="fas fa-play"></i>
                </div>
                <p><strong>He’s learning songs in minutes, not months.</strong><br>
                    It used to take Jimi 6 months to learn a new song. With 500 Songs in 5 Days he’s playing songs on the first try, minutes after reading the chord chart. He’s also learned to improvise and express himself through music.</p>
            </div>
            <div class="testimonial col-xs-12 col-sm-4">
                <div class="thumb hover-scale autoplay-video" style="background-image:url(https://i.vimeocdn.com/video/923771461-a0666803c1cedd86442f49ef4e9b766325747dd3d65f93962e13d03e96c17f5a-d_320);" data-toggle="modal" data-target="#testimonial2">
                    <div class="text">KELLY'S<br>STORY</div>
                    <i class="fas fa-play"></i>
                </div>
                <p><strong>She’s connecting with her daughter through music.</strong><br>
                    When Kelly started 500 Songs in 5 Days, she didn’t realize it would bring her and her daughter closer together. Now, they’re playing and singing their favorite songs. Something she never thought would happen.</p>
            </div>
            <div class="testimonial col-xs-12 col-sm-4">
                <div class="thumb hover-scale autoplay-video" style="background-image:url(https://i.vimeocdn.com/video/923772154-3cc5d0d0a3dc45eb8d8f74b217001c1c0593549e21431f5bbb06faa6c101de4f-d_320);" data-toggle="modal" data-target="#testimonial3">
                    <div class="text">HEIDI'S<br>STORY</div>
                    <i class="fas fa-play"></i>
                </div>
                <p><strong>She’s achieving a life-long goal.</strong><br>
                    Heidi knew she always wanted to play the piano. But she didn’t know where to start. YouTube videos could show her songs, but she never understood what she was playing, or why. Now, she’s playing (and understanding) her favorite songs on the piano.</p>
            </div>
        </div>
    </section>

    <div class="modal fade text-center" id="testimonial1" tabindex="-1" role="dialog" aria-labelledby="trailerLabel">
        <i class="close stop-play fas fa-times" data-dismiss="modal" aria-label="Close"></i>
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="embed-responsive embed-responsive-16by9">
                    <iframe class="embed-responsive-item reset-on-close" src="" data-lazy-load-url="//player.vimeo.com/video/436936047?autoplay=1" frameborder="0" allowfullscreen allow="autoplay"></iframe>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade text-center" id="testimonial2" tabindex="-1" role="dialog" aria-labelledby="trailerLabel">
        <i class="close stop-play fas fa-times" data-dismiss="modal" aria-label="Close"></i>
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="embed-responsive embed-responsive-16by9">
                    <iframe class="embed-responsive-item reset-on-close" src="" data-lazy-load-url="//player.vimeo.com/video/436936072?autoplay=1" frameborder="0" allowfullscreen allow="autoplay"></iframe>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade text-center" id="testimonial3" tabindex="-1" role="dialog" aria-labelledby="trailerLabel">
        <i class="close stop-play fas fa-times" data-dismiss="modal" aria-label="Close"></i>
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="embed-responsive embed-responsive-16by9">
                    <iframe class="embed-responsive-item reset-on-close" src="" data-lazy-load-url="//player.vimeo.com/video/436936032?autoplay=1" frameborder="0" allowfullscreen allow="autoplay"></iframe>
                </div>
            </div>
        </div>
    </div>

    <section class="guarantee">
        <div class="container">
            <div class="col-md-4 col-sm-5 col-xs-12 pull-right guarantee-icon">
                <img src="https://d2vyvo0tyx8ig5.cloudfront.net/sales/90-day.png" alt="90-Day Money-Back Guarantee">
            </div>
            <div class="col-md-8 col-sm-7 col-xs-12 guarantee-text">
                <h1>90-Day Money-Back Guarantee.</h1>
                <p>We love our students. More than anything, we want you to enjoy a super-positive experience playing piano. And that means we only want you to pay if you actually LOVE your Pianote experience! So join below to try it out totally risk-free. If it’s not for you, simply cancel your membership within 90 days and contact support for a full refund.</p>
            </div>
        </div>
    </section>

    <section class="final text-center">
        <div class="container">
            <img class="logo" src="https://d2vyvo0tyx8ig5.cloudfront.net/500-songs/sales/500-songs-logo.svg">
            <h2>Develop the skills to play
                @hasSection('name')
                     songs by <br class="hidden-sm hidden-md hidden-lg"> <strong>@yield('name')</strong> for a one-time <br class="hidden-sm hidden-md hidden-lg">
                @else
                    500 songs <br> for a one-time
                @endif
                    payment of just

                @if(PianotePrices::$songs500Full > $productPrice)
                    <s>${{ PianotePrices::$songs500Full }}</s> <strong>${{ $productPrice }}</strong>
                @else
                    <strong>${{ $productPrice }}</strong>
                @endif
            </h2>
            <a @hasSection('product-json')
                class="join vue-add-to-cart" @yield('product-json')
            @else
                class="join"
            @endif href="@yield('order-link')" >LEARN 500 SONGS NOW &raquo;</a>
            <p class="breakdown">
                @hasSection('badge')
                    @yield('badge')
                @endif
                @if(PianotePrices::$songs500Full > $productPrice)
                    <s>NORMALLY ${{ PianotePrices::$songs500Full }}.</s> &nbsp;<strong><u>ONLY ${{ $productPrice }}</u></strong>&nbsp; (SAVE {{ round(100 - (100 * ($productPrice / PianotePrices::$songs500Full))) }}%)
                @else
                    <strong><u>ONLY ${{ $productPrice }}</u></strong>
                @endif
                <br><a href="/" class="red">(OR FREE WITH A PIANOTE MEMBERSHIP)</a><br>
                    <span style="text-transform:uppercase">ONLY <span class="tzcd-full"></span> LEFT!</span><br>
                <strong class="yellow">** 90-DAY GUARANTEE **</strong></p>

            <div class="credit-cards col-xs-12">
                <i class="fab fa-cc-visa"></i>
                <i class="fab fa-cc-mastercard"></i>
                <i class="fab fa-cc-discover"></i>
                <i class="fab fa-cc-amex"></i>
                <i class="fab fa-cc-paypal"></i>
            </div>
            <div class="col-xs-12 questions">
                <p><strong>Any questions?</strong><br class="hidden-lg hidden-md hidden-sm">
                    Call us toll-free at <a href="tel:+18004398921">1-800-439-8921</a> <br class="hidden-lg hidden-md hidden-sm">
                    or directly at <a href="tel:+16048557605">1-604-855-7605</a>.<br>
                    All prices listed in USD. </p>
            </div>
        </div>
    </section>

    @include('pianote.sales.footer')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <script>
        $(document).ready(function () {
            $('#uncoverAll').on('click', function (e) {
                e.stopPropagation();
                e.preventDefault();
                $('.song-list').addClass('show-all');
                $(this).addClass('hide');
            });
            //open jimi testimonial on url
            var showModal = location.search.substr(1).includes('jimi');
            if (showModal) {
                $("#testimonial1").modal();
                $("#testimonial1").find('[data-lazy-load-url]').each(function () {
                    var lazyLoadIframeElement = $(this);
                    $(this).attr('src', lazyLoadIframeElement.data('lazy-load-url'));
                });
            }
        });
    </script>
    <script type="text/javascript" src="/marketing/parcel/pianote/nav-footer.js"></script>
    <script type="text/javascript" src="/marketing/js/pianote/modal-autoplay.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/countup.js/1.9.3/countUp.min.js"></script>
    <script>
        $(function() {

            // sticky topbar before orderSection
            var stickyBar = $('.promo-banner');
            $(window).scroll(function () {
                var orderSection = $('.final').offset().top;
                var spreadSection = $('.day-breakdown').offset().top;
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

            $('.count').each(function () {
                var thisCountElement = $(this);
                var options = {
                    useEasing: true,
                    useGrouping: true,
                    separator: ','
                };
                var countup = new CountUp(
                    thisCountElement.attr('id'), 0, thisCountElement.data('total-count'), 0, 4, options
                );

                $(window).scroll(function () {
                    if ($(window).scrollTop() + $(window).height() > (thisCountElement.offset().top)) {
                        countup.start();
                    }
                });
            });

            $(window).trigger('scroll');
        });
    </script>
    <script src="{{ mix('marketing/js/pianote/manifest.js') }}"></script>
    <script src="{{ mix('marketing/js/pianote/vendor.js') }}"></script>
    <script src="{{ mix('marketing/js/pianote/cart-sidebar.js') }}"></script>
    <script src="{{ mix('marketing/js/pianote/app.js') }}"></script>

    @include('pianote._partials._promo-countdown')
    @yield('scripts')

    {!! inspectlet_embed_script() !!}
@stop
