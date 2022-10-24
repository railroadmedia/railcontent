@extends('drumeo.products.misc-products-layout')


@section('meta')
    @parent
    <title>Four Weeks To Better Drum Fills</title>
    <meta name="description" content="The ultimate crash course to playing more creative & more musical drum fills your audience will love!">
    <meta property="og:image" content="https://dpwjbsxqtam5n.cloudfront.net/drum-shop/four-weeks-to-better-drum-fills/og-image.jpg" style="display: none;">
    <meta property="og:title" content="Four Weeks To Better Drum Fills">
    <meta property="og:description" content="The ultimate crash course to playing more creative & more musical drum fills your audience will love!">
    <meta property="og:url" content="https://www.drumeo.com/{{ Request::path() }}">
@stop()

@section('head')
    @parent
    <link href="{{ asset('/marketing/parcel/drumeo/better-drum-fills.css') }}" rel="stylesheet">

    <?php \App\Analytics\Tracker::trackProductImpression('better-drum-fills'); ?>
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
    <script src="{{ asset('/marketing/parcel/drumeo/modal-autoplay.js') }}"></script>
@stop()

@section('content')

    @include('drumeo.products.partials.promo-banner', [
                "name" => "Four Weeks To Better Drum Fills",
                "fullPrice" => Prices::$bdfFull,
                "price" => Prices::$bdfRegular,
                "noBreadcrumb" => true
            ])

    <header class="header text-center" style="background-image:url(https://dpwjbsxqtam5n.cloudfront.net/drum-shop/four-weeks-to-better-drum-fills/header.jpg);">
        <div class="row">
            <img class="logo" src="https://dpwjbsxqtam5n.cloudfront.net/drum-shop/four-weeks-to-better-drum-fills/four-weeks-to-better-drum-fills-logo.png">
            <br>
            <div class="watch-badge">
                <span>WATCH<br> PREVIEW</span>
                <img src="https://dpwjbsxqtam5n.cloudfront.net/sales/arrow-left-white.png">
            </div>
            <img data-open="previewModal" class="play-button autoplay-video" src="https://dpwjbsxqtam5n.cloudfront.net/sales/play-button.png">
            <h1>The ultimate crash course to playing <strong>more creative &<br class="show-for-medium"> more musical drum fills</strong> your audience will love!</h1>
            <a href="/laravel/public/shopping-cart/api/query?products[four-weeks-to-better-drum-fills]=1" class="join blue">Get Started &raquo;</a>
            <p>
                @if(Prices::$bdfFull > Prices::$bdfRegular)
                    <strong>ONLY <s>${{ Prices::$bdfFull }}</s>
                        @if(number_format(Prices::$bdfRegular, 2) == intval(Prices::$bdfRegular))
                            ${{  Prices::$bdfRegular  }}.
                        @else
                            ${{  number_format(Prices::$bdfRegular, 2)  }}.
                        @endif
                    </strong> (SAVE {{ round(100 - (100 * (Prices::$bdfRegular / Prices::$bdfFull))) }}%)
                @else
                    <strong>ONLY ${{ Prices::$bdfRegular }}.</strong>
                @endif
                90-DAY GUARANTEE <br><a href="/" class="text-blue smaller">(OR FREE WITH A DRUMEO MEMBERSHIP)</a>
            </p>
        </div>
    </header>

    <div class="reveal large text-center" id="previewModal" data-reveal data-reset-on-close="false">
        <div class="flex-video widescreen vimeo">
            <iframe class="reset-on-close" src="" data-lazy-load-url="//player.vimeo.com/video/424843063?autoplay=1" frameborder="0" allowfullscreen allow="autoplay"></iframe>
        </div>
        <a href="/laravel/public/shopping-cart/api/query?products[four-weeks-to-better-drum-fills]=1" class="join blue">Get Started &raquo;</a>
    </div>

    <section class="one-common text-center">
        <div class="row">
            <h2>The <strong>one thing</strong> all legendary <br class="hide-for-medium">
                drum fills have in common… </h2>
            <div class="flex-container">
                <img src="https://dpwjbsxqtam5n.cloudfront.net/drum-shop/four-weeks-to-better-drum-fills/mobile-album-spread.jpg">
                <p>I’m sure you’ve heard many of the most memorable drum fills before: air drumming before the words “I can feel it coming in the air tonight”, or getting pumped up during the opening of “Wipeout” by The Surfaris (the most popular surf song ever), or experiencing Jeff Porcaro’s perfectly designed hook in Toto’s “Africa”.
                    <br><br>
                    <strong>There’s one thing that ALL of these legendary drum fills have in common: the patterns and orchestrations perfectly compliment the song.</strong>
                    <br><br>
                    Unfortunately, most drummers play a handful of drum fills on autopilot - without giving much thought to the musical application. But there’s a big difference between drum fills that simply fill space while transitioning to another part of the song… and drum fills that amplify the music and leave a lasting impression.
                    <br><br>
                    And in just four weeks -- while following a carefully organized plan -- you can exchange your boring ol’ played-out fills with better drum fills your audience will LOVE!
                </p>
            </div>
        </div>
    </section>

    <section class="lesson-descriptions text-center">
        <div class="row">
            <h2>Go beyond <strong><em>filling space</em></strong><br class="hide-for-medium"> with your drum fills</h2>
            <div class="columns">
                @include('drumeo.products.partials.week-breakdown', [
                "weekNumber" => "1",
                "weekTitle" => "Drum Fill Foundations",
                "weekDescription" => "Every professional in any field will always focus on the foundational elements of their craft. Drumming is no different. Most drummers hit ceilings in their drumming due to a lack of foundation. The first week is all about establishing a solid foundation of theory, technique, and vocabulary to set yourself up for success in the following weeks of lessons. We’ll cover how to practice, the drumming motions, and note value tree. With each week of lessons, you’ll be given specific instructions on exactly what to practice. ",
                "defaultOpen" => true
                ])
                @include('drumeo.products.partials.week-breakdown', [
                "weekNumber" => "2",
                "weekTitle" => "Three Levels of Drum Fills",
                "weekDescription" => "Through the three levels of drum fills, I will help you take any accented pattern, over any period of time within the music, and turn it into something amazing. Level one starts with the basic accent patterns, level two you’ll focus on orchestrations, and for the final level you’ll be blazing around the kit fluidly with some epic sounding fills. And this isn’t 100s of pages of exercises. You will gain a blueprint that you can apply to ANY accented pattern over ANY period of time. This week will unlock an entirely new world for your drumming… buckle up."
                ])
                @include('drumeo.products.partials.week-breakdown', [
                "weekNumber" => "3",
                "weekTitle" => "Building Musical Tension",
                "weekDescription" => "Growing up, I was always mesmerized when I saw my favorite drummers blazing around the kit which seemed to be an incomprehensible group of rudiments and vocabulary at speeds which made it impossible for me to decipher. Years later, after studying with Benny Greb (one of my fav drummers) and many other instructors on Drumeo, I got obsessed with repeating odd-grouping phrases to come up with some crazy combinations around the kit… and you wanna know the best part? It’s much easier than you think. I break down this concept for you in great detail and will show you how to use groupings to come up with musical inspiring “off the cuff” drum fills. Like previous weeks, I am not going to give you the biggest drum fill fish, I am going to teach you how, with lots of practice, you can fill your boat of drum fill vocabulary so full you’ll be sinking in new ideas! "
                ])
                @include('drumeo.products.partials.week-breakdown', [
                "weekNumber" => "4",
                "weekTitle" => "Unlimited Drum Fill Ideas",
                "weekDescription" => "Linear drumming: a concept so simple, yet incredibly challenging. As within all weeks, there are lessons for beginners, intermediate, and advanced drummers. So if you’re just starting out, there is something to learn. Linear drumming means no two limbs are playing at the same time. Leveraging the foundational week’s lessons, you’ll explore note values and how they relate to linear drumming. I’ll show you how you can take one pattern that you’re comfortable with and play it in thousands of different ways. "
                ])
            </div>
        </div>
    </section>

    <section class="better-fills text-center">
        <div class="row">
            <h2><strong>Better Drum Fills</strong></h2>
            <h4><em>So what does a better drum fill <br class="hide-for-medium">even mean? It’s that moment when...</em></h4>
            <div class="columns medium-4 emoji-point">
                <img src="https://dpwjbsxqtam5n.cloudfront.net/drum-shop/four-weeks-to-better-drum-fills/emoji-love.png">
                <h3 class="text-grey"><strong>Impress Your Family</strong></h3>
                <p><em>...you show your spouse a new fill and they ask: “how do you know what drum to hit and when?”</em></p>
            </div>
            <div class="columns medium-4 emoji-point">
                <img src="https://dpwjbsxqtam5n.cloudfront.net/drum-shop/four-weeks-to-better-drum-fills/emoji-crowd.png">
                <h3 class="text-grey"><strong>Move The Crowd</strong></h3>
                <p><em>...the band breaks for two bars before the chorus and you insert the most perfectly executed drum fill that’s met with resounding cheers from the crowd.</em></p>
            </div>
            <div class="columns medium-4 emoji-point">
                <img src="https://dpwjbsxqtam5n.cloudfront.net/drum-shop/four-weeks-to-better-drum-fills/emoji-shock.png">
                <h3 class="text-grey"><strong>Shock Your Band</strong></h3>
                <p><em>...the bass player looks at you with amazement, wondering what you did differently this time.</em></p>
            </div>
        </div>
    </section>

    <section class="three-icon text-center">
        <div class="row">
            <h2><em>Stop</em> memorizing & <strong><em>start</em></strong> creating!</h2>
            <h4>Get four weekly lesson plans with hand-picked exercises so can go<br class="show-for-medium">
                beyond memorizing drum fills one at a time.</h4>
            <div class="memorize-create columns no-padding">
                <div class="columns medium-6">
                    <div class="colored-box">
                        <img src="https://dpwjbsxqtam5n.cloudfront.net/drum-shop/four-weeks-to-better-drum-fills/memorize.png">
                        <p>You can grab some sheet music of different drum fills and work your way through the patterns and orchestrations -- memorizing new drum fills as you continue to play. And that’s fine, most drummers do this for years and slowly add to their arsenal one pattern at a time.
                            <br><br>
                        <strong>This is NOT what’s covered in this training program.</strong></p>
                    </div>
                </div>
                <div class="columns medium-6">
                    <div class="colored-box blue">
                        <img src="https://dpwjbsxqtam5n.cloudfront.net/drum-shop/four-weeks-to-better-drum-fills/create.png">
                        <p>You can study the foundations of a drum fill: the purpose, the lengths, the motions, the combinations, and the vocabulary -- so you can create effective drum fills on the fly. You’ll gain the ability to adapt to the music, the audience, and the setting for a more impactful musical experience.
                            <br><br>
                        <strong>This is what we’ll cover through four weeks of lessons.</strong></p>
                    </div>
                </div>
            </div>
            <div class="circles-wrap columns no-padding">

                <div class="columns medium-6 large-4 circle-point">
                    <i class="fas fa-calendar-alt"></i>
                    <p><strong>WEEKLY LESSON PLANS</strong><br>
                        It’s easy to make progress when you know exactly what to do, and when to do it.</p>
                </div>
                <div class="columns medium-6 large-4 circle-point">
                    <i class="fas fa-signal-alt"></i>
                    <p><strong>ALL SKILL LEVELS</strong><br>
                        Each lesson includes tips for all skill levels - so any drummer can improve their drum fills.</p>
                </div>
                <div class="columns medium-6 large-4 circle-point">
                    <i class="fas fa-video"></i>
                    <p><strong>GUIDED VIDEO LESSONS</strong><br>
                        Your video lessons are accessible with any internet-ready computer, tablet, or phone.</p>
                </div>
                <div class="columns medium-6 large-4 circle-point">
                    <i class="fas fa-question"></i>
                    <p><strong>PERSONAL SUPPORT</strong><br>
                        Need help? Our teachers will always be available to answer your questions, big or small.</p>
                </div>
                <div class="columns medium-6 large-4 circle-point">
                    <i class="fas fa-infinity"></i>
                    <p><strong>LIFETIME ACCESS</strong><br>
                        Even though it’s a structured four-week course, you’ll have unlimited access for life.</p>
                </div>
                <div class="columns medium-6 large-4 circle-point">
                    <i class="fas fa-heart"></i>
                    <p><strong>HAPPINESS GUARANTEED</strong><br>
                        You’ll get a 90-day guarantee to make sure you love your lessons and improve your skills.</p>
                </div>
            </div>
        </div>
    </section>

    <section class="warning-section">
        <div class="row">
            <h1>FAIR WARNING:</h1>
            <img class="sticks" src="https://dzryyo1we6bm3.cloudfront.net/independence-made-easy/sales/fair-warning-x.png"><br>
            <p>Four Weeks To Better Drum Fills is not a magical pill that’ll turn you into a world-class drummer in four weeks, but you will get four simple weekly lesson plans that will give you almost-immediate improvements in your creativity and drum fill applications.
                <br><br>
                You will start a new journey -- one that will last a lifetime -- for understanding the purpose of a drum fill, the ideas behind constructing and orchestrating something that sounds great, and learning how to apply effective drum fills within real music.</p>
            <img class="bg-icon sign" src="https://dzryyo1we6bm3.cloudfront.net/independence-made-easy/sales/fair-warning-1.png">
            <img class="bg-icon cal" src="https://dzryyo1we6bm3.cloudfront.net/independence-made-easy/sales/fair-warning-2.png">
        </div>
    </section>

    <section class="meet-instructor" style="background-image:url(https://dpwjbsxqtam5n.cloudfront.net/drum-shop/four-weeks-to-better-drum-fills/jared-falk.jpg);">
        <div class="row">
            <h1><strong>Jared Falk</strong></h1>
            <h2>Your Personal<br class="hide-for-medium"> Drum Teacher</h2>
            <h6 class="show-for-medium" style="color: #7f878d;"><em>"The Drumeo standard is one of the highest quality and<br>
                    is THE place to go for the best in drum education!"</em></h6>
            <div class="columns no-padding steve-details show-for-medium">
                <img src="https://dpwjbsxqtam5n.cloudfront.net/drum-shop/four-weeks-to-better-drum-fills/drummer-david-garibaldi.jpg">
                <div class="columns end text">
                    <h6><strong>David Garibaldi</strong></h6>
                    <p class="text-blue"><em>Tower Of Power</em></p>
                </div>
            </div>
            <div class="bio columns no-padding">
                <p class="columns">
                    <span class="first-letter smaller"><img src="https://dpwjbsxqtam5n.cloudfront.net/tripwires/sd/bold-j.png"></span>ared Falk has been creating online drum lessons since before YouTube even existed!
                    <br><br>
                    Back in 2003, Jared partnered with one of his private drum students to create simple websites with drum articles, video tutorials, and community discussion forums. As online drum lessons transitioned to becoming a full-time job, Jared launched several step-by-step DVD packs including the One-Handed Drum Roll, Bass Drum Secrets, and The Rock Drumming System.
                    <br><br>
                    As video streaming started to improve and websites like YouTube gained traction, Jared launched FreeDrumLessons.com in 2007 and built a massive library of drum lessons on YouTube. And through these platforms, Jared has become the world’s most-watched drum teacher with his YouTube lessons alone reaching more than 50 million views -- including his “How To Play Drums” video that has helped more than 6 million drummers.
                    <br><br>
                    In 2012, Jared co-founded Drumeo.com as “The Ultimate Online Drum Lessons Experience”, giving drum students the opportunity to learn from the best drummers and teachers in the world through step-by-step courses, live video drum lessons, play-along songs, personalized lesson plans, and community support.
                    <br><br>
                    Drumeo has since been voted as “The Best Educational Website” by the readers of DRUM! Magazine for three consecutive years, “The Best Educational Product” by the readers of Modern Drummer magazine, and Jared was awarded “The Best Drum Educator” by Rhythm Magazine.
                    <br><br>
                    Four Weeks To Better Drum Fills isn’t something Jared’s created on his own. He’s had the opportunity to study with the world’s best drummers, hosting lessons with them, and picking their brains on how they approach their drumming -- and this course includes the takeaways he’s gained from these experiences, applied to his own drumming, and is now sharing with drummers to help you unlock the ability to play whatever fills you want.
                </p>
            </div>
        </div>
    </section>

    <section class="student-reviews">
        <div class="row">
            <div class="columns medium-4 testimonial-wrap">
                <img src="https://dpwjbsxqtam5n.cloudfront.net/drum-shop/four-weeks-to-better-drum-fills/drummer-anika-nilles.jpg">
                <p class="text-grey"><em>"Jared Falk has a comprehensive expert knowledge in providing and structuring lesson plans. He has a great human sense and knows how to handle, host and guide a lesson."</em></p>
                <h6><strong>Anika Nilles</strong></h6>
                <p class="credit text-blue"><em>Drummer & Composer</em></p>
            </div>
            <div class="columns medium-4 testimonial-wrap">
                <img src="https://dpwjbsxqtam5n.cloudfront.net/drum-shop/four-weeks-to-better-drum-fills/drummer-billy-cobham.jpg">
                <p class="text-grey"><em>"Jared Falk and his team have my confidence and support in what is done to promote music through the art of drumming and percussion."</em></p>
                <h6><strong>Billy Cobham</strong></h6>
                <p class="credit text-blue"><em>Legendary Jazz Fusion Drummer</em></p>
            </div>
            <div class="columns medium-4 testimonial-wrap">
                <img src="https://dpwjbsxqtam5n.cloudfront.net/drum-shop/four-weeks-to-better-drum-fills/drummer-casey-cooper.jpg">
                <p class="text-grey"><em>"After years of watching Jared's lessons on YouTube and Drumeo, and getting to work side by side with him, I can confidently say that he gives every bit of his effort and skill into every product or lesson he teaches."</em></p>
                <h6><strong>Casey Cooper</strong></h6>
                <p class="credit text-blue"><em>2.4M Subscribers On YouTube</em></p>
            </div>
        </div>
    </section>

    <section class="text-center guarantee">
        <div class="row">
            <img class="guarantee-badge hide-for-medium" src="https://dpwjbsxqtam5n.cloudfront.net/sales/guarantee-badge.png">
            <div class="flex-container">
                <img class="guarantee-badge show-for-medium" src="https://dpwjbsxqtam5n.cloudfront.net/sales/guarantee-badge.png">
                <div class="text-wrap text-left">
                    <h2><strong>90-Day Money-Back Guarantee</strong></h2>
                    <p><strong>OUR PROMISE TO YOU:</strong> More than anything, we want you to enjoy a super-positive experience on the drums. And that means we only want you to pay if you actually LOVE your Four Weeks To Better Drum Fills experience. So click any of the big buttons on this page to get started risk-free. If it’s not for you, simply <a class="text-white" href="/support">contact us</a> within 90 days for a full refund.</p>
                </div>
            </div>
        </div>
    </section>

    <section class="final" style="background-image:url(https://dpwjbsxqtam5n.cloudfront.net/drum-shop/four-weeks-to-better-drum-fills/order-section-background.jpg);">
        <div id="customize-anchor" class="anchor"></div>
        <div class="row">
            <div class="columns logo"><img src="https://dpwjbsxqtam5n.cloudfront.net/drum-shop/four-weeks-to-better-drum-fills/four-weeks-to-better-drum-fills-logo.png"></div>

            <h2 class="columns">The ultimate crash course to playing <strong>more creative &<br class="show-for-medium"> more musical drum fills</strong> your audience will love!</h2>

            <div class="columns"><a href="/laravel/public/shopping-cart/api/query?products[four-weeks-to-better-drum-fills]=1" class="join blue">Get Started &raquo;</a></div>

            <h4 class="columns uppercase">
                @if(Prices::$bdfFull > Prices::$bdfRegular)
                    <strong>ONLY <s>${{ Prices::$bdfFull }}</s>
                        @if(number_format(Prices::$bdfRegular, 2) == intval(Prices::$bdfRegular))
                            ${{  Prices::$bdfRegular  }}.
                        @else
                            ${{  number_format(Prices::$bdfRegular, 2)  }}.
                        @endif
                    </strong> (SAVE {{ round(100 - (100 * (Prices::$bdfRegular / Prices::$bdfFull))) }}%)
                @else
                    <strong>ONLY ${{ Prices::$bdfRegular }}.</strong>
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
