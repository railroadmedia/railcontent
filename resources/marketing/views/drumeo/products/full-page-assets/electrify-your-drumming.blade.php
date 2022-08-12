@extends('products.misc-products-layout')


@section('meta')
    @parent
    <title>Electrify Your Drumming</title>
    <meta name="description" content="The ultimate guide to playing electronic dance music on the drums.">
    <meta property="og:image" content="https://dpwjbsxqtam5n.cloudfront.net/drum-shop/electrify-your-drumming/og-image.jpg" style="display: none;">
    <meta property="og:title" content="Electrify Your Drumming">
    <meta property="og:description" content="The ultimate guide to playing electronic dance music on the drums.">
    <meta property="og:url" content="https://www.drumeo.com/{{ Request::path() }}">
@stop()

@section('head')
    @parent
    <link href="{{ asset('/assets/members-area/css/gulp/electrify-your-drumming.css') }}" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Permanent+Marker&display=swap" rel="stylesheet">

    <?php \App\Analytics\Tracker::trackProductImpression('electrify-your-drumming'); ?>
@stop()

@section('scripts')
    @parent
    <script>
        $(document).ready(function () {
            $(document).foundation();

            // Dropdown for FAQ section
            $('.question-dropdown').on('click', questionDropdown);

            function questionDropdown() {
                $(this).toggleClass('active');
                $(this).find('.fa-chevron-down').toggleClass('rotated');
            }

        });
    </script>
    <script src="{{ asset('/assets/members-area/js/gulp/modal-autoplay.js') }}"></script>
@stop()

@section('content')

    @include('products.partials.promo-banner', [
                "name" => "Electrify Your Drumming",
                "fullPrice" => Prices::$eydFull,
                "price" => Prices::$eydRegular,
                "noBreadcrumb" => true
            ])

    <header class="header text-center" style="background-image:url(https://dpwjbsxqtam5n.cloudfront.net/drum-shop/electrify-your-drumming/header.jpg);">
        <div class="row">
            <img class="logo" src="https://dpwjbsxqtam5n.cloudfront.net/drum-shop/electrify-your-drumming/logo.png">
            <br>
            <i data-open="previewModal" class="fas fa-play play-button autoplay-video"></i>
            <h1>The ultimate guide to playing<br>
                <strong>electronic dance music</strong> on the drums.</h1>
            <a href="{{ URL::Route('shopping-cart.to-cart.api') }}?products[electrify-your-drumming]=1" class="join blue">Get Started &raquo;</a>
            <p>@if(Prices::$eydFull > Prices::$eydRegular)
                    <strong>ONLY <s>${{ Prices::$eydFull }}</s>
                        @if(number_format(Prices::$eydRegular, 2) == intval(Prices::$eydRegular))
                            ${{  Prices::$eydRegular  }}.
                        @else
                            ${{  number_format(Prices::$eydRegular, 2)  }}.
                        @endif
                    </strong> (SAVE {{ round(100 - (100 * (Prices::$eydRegular / Prices::$eydFull))) }}%)
                @else
                    <strong>ONLY ${{ Prices::$eydRegular }}.</strong>
                @endif
                90-DAY GUARANTEE <br><a href="/" class="text-blue smaller">(OR FREE WITH A DRUMEO MEMBERSHIP)</a>
            </p>
        </div>
    </header>

    <div class="reveal large text-center" id="previewModal" data-reveal data-reset-on-close="false">
        <div class="flex-video widescreen vimeo">
            <iframe class="reset-on-close" src="" data-lazy-load-url="//player.vimeo.com/video/454835085?autoplay=1" frameborder="0" allowfullscreen allow="autoplay"></iframe>
        </div>
        <a href="{{ URL::Route('shopping-cart.to-cart.api') }}?products[electrify-your-drumming]=1" class="join blue">Get Started &raquo;</a>
    </div>

    <section class="power-outage text-center">
        <div class="triangle-bg" style="background-image:url(https://dpwjbsxqtam5n.cloudfront.net/drum-shop/electrify-your-drumming/power-outage-triangle.png);"></div>
        <div class="row">
            <h1 class="permanent"><span class="text-yellow">POWER</span><br>OUTAGE</h1>
            <div class="flex-container">
                <img src="https://dpwjbsxqtam5n.cloudfront.net/drum-shop/electrify-your-drumming/power-outage-scenario.png">
                <p>The band wants to play a song that originally had a fully produced drum beat. Now it’s up to you to recreate it on a drum set. But every time you try, it sounds like the power is out.
                    <br><br>
                    This is the problem drummers face more & more. And who’s to blame? Electronic Dance Music.
                    <br><br>
                    From the moment Darude’s <em>Sandstorm</em> dominated the airwaves, the thickly produced drum beats of Electronic Dance Music have become the new standard for drummers to live up to.
                    <br><br>
                    You can fight it, or you can embrace it.
                    <br><br>
                    Go behind enemy lines and befriend the genre that has revolutionized the role of drumming in popular music.</p>
            </div>
        </div>
    </section>

    <section class="amplify-songs text-center" style="background-image:url(https://dpwjbsxqtam5n.cloudfront.net/drum-shop/electrify-your-drumming/amplify-every-song.jpg);">
        <div class="row">
            <h1 class="permanent"><span class="text-yellow">AMPLIFY</span><br>EVERY SONG</h1>
<br>

            <div class="columns medium-4 emoji-point">
                <i class="fal fa-drum text-yellow"></i>
                <h3><strong>Energy-Building Fills</strong></h3>
                <p><strong>Drum fills are used by producers every day to build energy</strong> before the drop or chorus of the song. And while they get to program it, WE need to play it. You’ll learn how to create effective risers with simple drum fills that start softly, build, and crescendo -- creating a powerful experience for your audience.</p>
            </div>
            <div class="columns medium-4 emoji-point">
                <i class="fal fa-hands text-yellow"></i>
                <h3><strong>Hand-Clapping Beats</strong></h3>
                <p><strong>The feel of the kick & snare makes a drum beat feel complete.</strong> You’ll learn how to create an effective four-on-the-floor beat with your kick to make people move, add the hi-hat to make people clap, and bring in the snare to lead to the climax of the song.</p>
            </div>
            <div class="columns medium-4 emoji-point">
                <i class="fal fa-music text-yellow"></i>
                <h3><strong>Musical Grooves</strong></h3>
                <p><strong>Your hi-hat technique will determine the feel of your grooves</strong> -- and you’ll learn how to make effective adjustments between single strokes, ghost notes, and accents. PLUS you’ll get seven must-know hi-hat patterns to play on top of your kick & snare.</p>
            </div>
        </div>
    </section>

    <section class="lesson-descriptions text-center" style="background-image:url(https://dpwjbsxqtam5n.cloudfront.net/drum-shop/electrify-your-drumming/10-edm-styles.jpg);">
        <div class="row">
            <div class="content-wrap text-left">
                <div class="text">
                    <h1 class="permanent"><span class="text-yellow">10</span> EDM<br>STYLES</h1>
                    <h4>Unlock 10 Styles Of Electronic Music</h4>
                    <p>Electrify Your Drumming will teach you the tools and styles of electronic dance music -- so you can build energy with risers, lock-in with the vocals, add power to your beats and fills, create a climax in the music, and ultimately fuel any song with your playing -- giving you valuable skills that will apply to every style of music.</p>
                </div>
                <div class="columns no-padding question-dropdown text-left">
                    <div class=" small-11  columns drop-down-wrap">
                        <div class="question">
                            <h2>Down Tempo EDM</h2>

                            <p class="details show-for-medium">5 Lessons / 2 Play-Alongs</p></div>
                        <p><span class="hide-for-medium"> 5 Lessons / 2 Play-Alongs <br><br></span>
                            Lesson 1: What Is Down Tempo EDM?<br>
                            Lesson 2: Down Tempo Drumming Vibe<br>
                            Lesson 3: The Reggaeton Beat<br>
                            Lesson 4: Leaving Space For Low Frequencies<br>
                            Lesson 5: The Importance Of Sound Design<br>
                            Play-Along: DownOOHM<br>
                            Play-Along: Portu Café<br>
                            Play-Along: Sub &amp; Lower
                        </p>
                    </div>
                    <div class="small-1 columns text-right">
                        <i class="fas fa-chevron-down"></i>
                    </div>
                </div>
                <div class="columns no-padding question-dropdown text-left">
                    <div class=" small-11  columns drop-down-wrap">
                        <div class="question">
                            <h2>Techno</h2>

                            <p class="details show-for-medium">7 Lessons / 2 Play-Alongs</p></div>
                        <p>
                            <span class="hide-for-medium"> 7 Lessons / 2 Play-Alongs <br><br></span>
                            Lesson 1: What Is Techno & Hardcore Music?<br>
                            Lesson 2: Four On The Floor<br>
                            Lesson 3: Hi-Hat & Ride Control<br>
                            Lesson 4: Thinking Musically<br>
                            Lesson 5: The Clap Is The Backbeat<br>
                            Lesson 6: The Snare Machine<br>
                            Lesson 7: When To Solo<br>
                            Play-Along: GranPaNo<br>
                            Play-Along: Kick Core
                        </p>
                    </div>
                    <div class="small-1 columns text-right">
                        <i class="fas fa-chevron-down"></i>
                    </div>
                </div>
                <div class="columns no-padding question-dropdown text-left">
                    <div class=" small-11  columns drop-down-wrap">
                        <div class="question">
                            <h2>House</h2>

                            <p class="details show-for-medium">6 Lessons / 3 Play-Alongs</p></div>
                        <p>
                            <span class="hide-for-medium"> 6 Lessons / 3 Play-Alongs <br><br></span>
                            Lesson 1: What Is House Music?<br>
                            Lesson 2: Popular Ride & Hi-Hat Patterns<br>
                            Lesson 3: Hi-Hat & Backbeat Builds<br>
                            Lesson 4: That "Swingy" Feel<br>
                            Lesson 5: Locking The Hi-Hat With The Bass Line<br>
                            Lesson 6: The Endless House Loop Challenge<br>
                            Play-Along: Pop Drop<br>
                            Play-Along: 4 The Masses<br>
                            Play-Along: TFH
                        </p>
                    </div>
                    <div class="small-1 columns text-right">
                        <i class="fas fa-chevron-down"></i>
                    </div>
                </div>
                <div class="columns no-padding question-dropdown text-left">
                    <div class=" small-11  columns drop-down-wrap">
                        <div class="question">
                            <h2>Big Room</h2>

                            <p class="details show-for-medium">6 Lessons / 1 Play-Along</p></div>
                        <p>
                            <span class="hide-for-medium"> 6 Lessons / 1 Play-Along <br><br></span>
                            Lesson 1: What Is Big Room Music?<br>
                            Lesson 2: Kick Drum Sound<br>
                            Lesson 3: Snare Risers For Big Room<br>
                            Lesson 4: The Reggaeton Tom<br>
                            Lesson 5: The Backbeat Build<br>
                            Lesson 6: Conclusion<br>
                            Play-Along: This Sound Is
                        </p>
                    </div>
                    <div class="small-1 columns text-right">
                        <i class="fas fa-chevron-down"></i>
                    </div>
                </div>
                <div class="columns no-padding question-dropdown text-left">
                    <div class=" small-11  columns drop-down-wrap">
                        <div class="question">
                            <h2>Trance</h2>

                            <p class="details show-for-medium">4 Lessons / 1 Play-Along</p></div>
                        <p><span class="hide-for-medium"> 4 Lessons / 1 Play-Along <br><br></span>
                            Lesson 1: What Is Trance Music?<br>
                            Lesson 2: Kickin' On The Arpeggiator<br>
                            Lesson 3: Common Trance Hi-Hat Patterns<br>
                            Lesson 4: Conclusion<br>
                            Play-Along: Push Agio
                        </p>
                    </div>
                    <div class="small-1 columns text-right">
                        <i class="fas fa-chevron-down"></i>
                    </div>
                </div>
                <div class="columns no-padding question-dropdown text-left">
                    <div class=" small-11  columns drop-down-wrap">
                        <div class="question">
                            <h2>Hard Dance</h2>

                            <p class="details show-for-medium">6 Lessons / 2 Play-Alongs</p></div>
                        <p><span class="hide-for-medium"> 6 Lessons / 2 Play-Alongs <br><br></span>
                            Lesson 1: What Is Hard Dance Music?<br>
                            Lesson 2: The "Rock & Punk" Attitude<br>
                            Lesson 3: Sound Design For Hard Dance<br>
                            Lesson 4: The Drill Sergeant Approach<br>
                            Lesson 5: Risers & Layers<br>
                            Lesson 6: Conclusion<br>
                            Play-Along: Hackin'<br>
                            Play-Along: Hard Styler
                        </p>
                    </div>
                    <div class="small-1 columns text-right">
                        <i class="fas fa-chevron-down"></i>
                    </div>
                </div>
                <div class="columns no-padding question-dropdown text-left   ">
                    <div class=" small-11  columns drop-down-wrap">
                        <div class="question">
                            <h2>Hip Hop &amp; Trap</h2>

                            <p class="details show-for-medium">6 Lessons / 3 Play-Alongs</p></div>
                        <p>
                            <span class="hide-for-medium"> 6 Lessons / 3 Play-Alongs <br><br></span>
                            Lesson 1: What Is Hip-Hop & Trap Music?<br>
                            Lesson 2: Straight Vs. Swing Grooves<br>
                            Lesson 3: Slow Trappin' Bass & Hi-Hat<br>
                            Lesson 4: Locking In With The Vocals<br>
                            Lesson 5: Glitch The Funk Up<br>
                            Lesson 6: Conclusion<br>
                            Play-Along: Break It Down<br>
                            Play-Along: Slo' Trap Hop<br>
                            Play-Along: Rhyme Vibe
                        </p>
                    </div>
                    <div class="small-1 columns text-right">
                        <i class="fas fa-chevron-down"></i>
                    </div>
                </div>
                <div class="columns no-padding question-dropdown text-left">
                    <div class=" small-11  columns drop-down-wrap">
                        <div class="question">
                            <h2>Breaks &amp; Breakbeat</h2>

                            <p class="details show-for-medium">6 Lessons / 2 Play-Alongs</p></div>
                        <p>
                            <span class="hide-for-medium"> 6 Lessons / 2 Play-Alongs <br><br></span>
                            Lesson 1: What Is Breakbeat Music?<br>
                            Lesson 2: Breaks On The Snare<br>
                            Lesson 3: Adding Ghost Notes<br>
                            Lesson 4: Fast Tempo Breakbeats<br>
                            Lesson 5: Making Your Sound Bite<br>
                            Lesson 6: Conclusion<br>
                            Play-Along: Fake Break<br>
                            Play-Along: Cut!
                        </p>
                    </div>
                    <div class="small-1 columns text-right">
                        <i class="fas fa-chevron-down"></i>
                    </div>
                </div>
                <div class="columns no-padding question-dropdown text-left   ">
                    <div class=" small-11  columns drop-down-wrap">
                        <div class="question">
                            <h2>Dubstep</h2>

                            <p class="details show-for-medium">6 Lessons / 1 Play-Along</p></div>
                        <p><span class="hide-for-medium"> 6 Lessons / 1 Play-Along <br><br></span>
                            Lesson 1: What Is Dubstep?<br>
                            Lesson 2: From One Drop To Dubstep<br>
                            Lesson 3: The Half-Time Feel<br>
                            Lesson 4: Dubstep Vs. Half-Time Drum N' Bass<br>
                            Lesson 5: Dubstep Risers<br>
                            Lesson 6: Conclusion<br>
                            Play-Along: Gasoline
                        </p>
                    </div>
                    <div class="small-1 columns text-right">
                        <i class="fas fa-chevron-down"></i>
                    </div>
                </div>
                <div class="columns no-padding question-dropdown text-left">
                    <div class=" small-11  columns drop-down-wrap">
                        <div class="question">
                            <h2>Drum N Bass &amp; Jungle</h2>

                            <p class="details show-for-medium">8 Lessons / 4 Play-Alongs</p></div>
                        <p>
                            <span class="hide-for-medium"> 8 Lessons / 4 Play-Alongs <br><br></span>
                            Lesson 1: What Is Drum N' Bass & Jungle Music?<br>
                            Lesson 2: Basic Drum N' Bass Beat #1<br>
                            Lesson 3: Basic Drum N' Bass Beat #2<br>
                            Lesson 4: Breaking Up The Snare<br>
                            Lesson 5: Drum N' Bass Fills & Risers<br>
                            Lesson 6: Half-Time Drum N' Bass<br>
                            Lesson 7: The Amen Break Feeling<br>
                            Lesson 8: Conclusion<br>
                            Play-Along: Waver 303<br>
                            Play-Along: AmenLectric<br>
                            Play-Along: Half Tone Tune<br>
                            Play-Along: Speed Bank
                        </p>
                    </div>
                    <div class="small-1 columns text-right">
                        <i class="fas fa-chevron-down"></i>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="meet-instructor text-center" style="background-image:url(https://dpwjbsxqtam5n.cloudfront.net/drum-shop/electrify-your-drumming/michael-schack.jpg);">
        <div class="row">
            <h1 class="permanent">MICHAEL SCHACK</h1>
            <h2 class="permanent"><span class="text-yellow">THE MAD SCIENTIST<br class="hide-for-medium"> OF ENERGY</span></h2>
            <br>
            <i data-open="bioModal" class="fas fa-play play-button autoplay-video"></i>
            <div class="bio">
                <p>Michael Schack has done it all. He’s played massive festival stages, small clubs, and concert venues around the world. He’s crushed it online with jaw-dropping performances on YouTube and entertaining mashup mixes and singles on Spotify.
                <br><br>
                And more than a performer, he’s also a clinician and teacher who knows how to translate his insights to deliver practical results for students. He’s been nominated for several “Best Clinician/Demonstrator” awards as a touring clinician for Roland Drums -- and his instructional debut on Drumeo in 2013 went bonkers with 226,000 views. Since then, Michael’s become one of our most popular teachers -- creating more than 80 videos for Drumeo students on every topic you’d need to energize your performances.
                <br><br>
                And now, the ULTIMATE SCHACK PACK is here -- giving you direct access to the mad scientist of energy so your drumming will always make a lasting impression.</p>
            </div>
        </div>
    </section>
    <div class="reveal large text-center" id="bioModal" data-reveal data-reset-on-close="false">
        <div class="flex-video widescreen vimeo">
            <iframe class="reset-on-close" src="" data-lazy-load-url="//player.vimeo.com/video/455069256?autoplay=1" frameborder="0" allowfullscreen allow="autoplay"></iframe>
        </div>
    </div>

    <section class="icon-grid text-center">
        <div class="triangle-bg" style="background-image:url(https://dpwjbsxqtam5n.cloudfront.net/drum-shop/electrify-your-drumming/everything-you-need.png);"></div>
        <div class="row">
            <h1 class="permanent"><span class="text-yellow">EVERYTHING</span><br>YOU NEED</h1>
            <h2><strong>The Ultimate Guide To Playing Electronic Music</strong></h2>
            <p>Electrify Your Drumming is loaded with 84 videos and 11 hours of content -- the ultimate guide<br class="show-for-large">
                to electronic drums that’ll help you turn EVERY performance into an unforgettable show!</p>

            <div class="columns medium-6 large-4 circle-point">
                <i class="fas text-white border-yellow fa-video"></i>
                <p><strong class="text-yellow permanent">STEP BY STEP VIDEOS</strong><br>
                    You’ll always know what to watch & practice to see results, with specific assignments for every lesson.</p>
            </div>
            <div class="columns medium-6 large-4 circle-point">
                <i class="fas text-white border-yellow fa-music"></i>
                <p><strong class="text-yellow permanent">23 PLAY-ALONG SONGS</strong><br>
                    The best part about improving your skills is actually playing music - so we’ve included 23 play-alongs!</p>
            </div>
            <div class="columns medium-6 large-4 circle-point">
                <i class="fas text-white border-yellow fa-signal-alt"></i>
                <p><strong class="text-yellow permanent">PERFECT FOR ALL LEVELS</strong><br>
                    Whether you’re starting out or you’ve been playing for years, you’ll get step-by-step lessons that work.</p>
            </div>
            <div class="columns medium-6 large-4 circle-point">
                <i class="fas text-white border-yellow fa-infinity"></i>
                <p><strong class="text-yellow permanent">YOURS FOREVER</strong><br>
                    These lessons NEVER expire. Watch them again, and again, and again… (you get the point).</p>
            </div>
            <div class="columns medium-6 large-4 circle-point">
                <i class="fas text-white border-yellow fa-globe-americas"></i>
                <p><strong class="text-yellow permanent">WATCH ANYWHERE, ANYTIME</strong><br>
                    Start your first lesson today with 24/7 online access from any computer, tablet, or smartphone.</p>
            </div>
            <div class="columns medium-6 large-4 circle-point">
                <i class="fas text-white border-yellow fa-users"></i>
                <p><strong class="text-yellow permanent">PERSONAL SUPPORT</strong><br>
                    Join a community of students & teachers -- ask questions, share your successes, and have fun!</p>
            </div>
        </div>
    </section>

    <section class="text-center guarantee">
        <div class="row">
            <img class="guarantee-badge hide-for-medium" src="https://dpwjbsxqtam5n.cloudfront.net/sales/guarantee-badge.png">
            <div class="flex-container">
                <img class="guarantee-badge show-for-medium" src="https://dpwjbsxqtam5n.cloudfront.net/sales/guarantee-badge.png">
                <div class="text-wrap medium-text-left">
                    <h2><strong>90-Day Money-Back Guarantee</strong></h2>
                    <p><strong>We love our students.</strong> And we always want you to have an amazing experience on the drums. So to make sure you LOVE your drum lessons, Electrify Your Drumming is backed by a 100% money-back guarantee. If you don’t love the lessons, just contact us within 90-days and contact support for a full refund.</p>
                </div>
            </div>
        </div>
    </section>

    <section class="final" style="background-image:url(https://dpwjbsxqtam5n.cloudfront.net/drum-shop/electrify-your-drumming/order-section.jpg);">
        <div id="customize-anchor" class="anchor"></div>
        <div class="row">
            <div class="columns logo"><img src="https://dpwjbsxqtam5n.cloudfront.net/drum-shop/electrify-your-drumming/logo.png"></div>

            <h2 class="columns">The ultimate guide to playing<br>
                <strong>electronic dance music</strong> on the drums.</h2>

            <div class="columns"><a href="{{ URL::Route('shopping-cart.to-cart.api') }}?products[electrify-your-drumming]=1" class="join blue">Get Started &raquo;</a></div>

            <h4 class="columns uppercase">
                @if(Prices::$eydFull > Prices::$eydRegular)
                    <strong>ONLY <s>${{ Prices::$eydFull }}</s>
                        @if(number_format(Prices::$eydRegular, 2) == intval(Prices::$eydRegular))
                            ${{  Prices::$eydRegular  }}.
                        @else
                            ${{  number_format(Prices::$eydRegular, 2)  }}.
                        @endif
                    </strong> (SAVE {{ round(100 - (100 * (Prices::$eydRegular / Prices::$eydFull))) }}%)
                @else
                    <strong>ONLY ${{ Prices::$eydRegular }}.</strong>
                @endif
                90-DAY GUARANTEE <br><a href="/" class="text-blue smaller">(OR FREE WITH A DRUMEO MEMBERSHIP)</a>
            </h4>

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