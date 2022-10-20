@extends('pianote._partials.global-layout')

@section('global-head')
    <title>De-Stupefy Your Left Hand | Pianote</title>
    <meta name="description" content="It’s time to tame your left hand.">

    <meta property="og:image" content="https://d2vyvo0tyx8ig5.cloudfront.net/shop/products/destupefy-your-left-hand/og-image.jpg" style="display: none;">
    <meta property="og:title" content="De-Stupefy Your Left Hand">
    <meta property="og:description" content="It’s time to tame your left hand.">
    <meta property="og:url" content="https://www.pianote.com/destupefy-your-left-hand">

    <link href="https://fonts.googleapis.com/css?family=Permanent+Marker&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.4.1/css/bootstrap.min.css">
    <link href="{{ asset('/marketing/parcel/pianote/nav-footer.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="/marketing/parcel/pianote/destupefy.css">
@stop

@section('global-body')
    @include('pianote.sales.nav', [
        "cartVersion" => true
    ])
    @include('pianote._partials._promo-banner', [
                    "name" => "De-Stupefy Your Left Hand",
                    "fullPrice" => PianotePrices::$destupefyFull,
                    "price" => PianotePrices::$destupefyRegular,
                    "noBreadcrumb" => true
                ])
    <header class="header text-center" style="background-image:url(https://d2vyvo0tyx8ig5.cloudfront.net/shop/products/destupefy-your-left-hand/header.jpg);">
        <div class="container">
            <img class="logo"
                    src="https://d2vyvo0tyx8ig5.cloudfront.net/shop/products/destupefy-your-left-hand/de-stupefy-logo.png"><br>
            <i class="fas fa-play play-vimeo autoplay-video" data-toggle="modal" data-target="#trailer"></i>
            <h1><strong>It’s time to tame<br class="hidden-sm hidden-md hidden-lg"> your left hand.</strong></h1>
            <a class="join" href="{{ url()->route('shopping-cart.add-to-cart', ['products' => ['destupefy-your-left-hand' => 1], 'redirect' => '/order', 'locked' => 'false']) }}">Get Started &raquo;</a>

            <p class="breakdown">
                @if(PianotePrices::$destupefyFull > PianotePrices::$destupefyRegular)
                    <s>NORMALLY ${{ PianotePrices::$destupefyFull }}.</s> &nbsp;
                    <strong><u>ONLY ${{ PianotePrices::$destupefyRegular }}</u></strong>&nbsp; (SAVE {{ round(100 - (100 * (PianotePrices::$destupefyRegular / PianotePrices::$destupefyFull))) }}%)
                @else
                    <strong><u>ONLY ${{ PianotePrices::$destupefyRegular }}</u></strong>
                @endif
                <br><a href="/" class="red">(OR FREE WITH A PIANOTE MEMBERSHIP)</a><br>
                    <strong class="yellow">** 90-DAY GUARANTEE **</strong></p>
        </div>
    </header>
    <div class="modal fade text-center" id="trailer" tabindex="-1" role="dialog" aria-labelledby="trailerLabel">
        <i class="close stop-play fas fa-times" data-dismiss="modal" aria-label="Close"></i>
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="embed-responsive embed-responsive-16by9">
                    <iframe class="embed-responsive-item reset-on-close" src="" data-lazy-load-url="//player.vimeo.com/video/479108043?autoplay=1" frameborder="0" allowfullscreen allow="autoplay"></iframe>
                </div>
                <a href="{{ url()->route('shopping-cart.add-to-cart', ['products' => ['destupefy-your-left-hand' => 1], 'redirect' => '/order', 'locked' => 'false']) }}" class="join">Get Started</a>
            </div>
        </div>
    </div>
    <section class="feel-stuck">
        <div class="container">
            <img class="hidden-xs" src="https://d2vyvo0tyx8ig5.cloudfront.net/shop/products/destupefy-your-left-hand/quotes.png">
            <img class="hidden-sm hidden-md hidden-lg" src="https://d2vyvo0tyx8ig5.cloudfront.net/shop/products/destupefy-your-left-hand/quotes-mobile-1.png">
            <h2><strong>Your Left Hand Is Weaker...</strong></h2>
            <p>And you know it.
                <br><br>
                Because you know…
                <br><br>
                <strong>Something’s missing.</strong> You’ve heard it in the songs you want to play (but don’t know if you can yet).
                <br><br>
                I’m talking about those beautiful arpeggios and accompaniment patterns that make the piano sing, and draw in all those listening.
                <br><br>
                But up until now, nothing’s worked. Because every time you TRY something new, your left hand just goes back to its old tricks.
                <br><br>
                And you know what?
                <br><br>
                <em>That’s completely normal.</em> Think about it…
                <br><br>
                For your entire piano-playing journey, you’ve been working on chords and melodies with your right hand.
                <br><br>
                So what has your left hand been doing?
                <br><br>
                Lagging behind.<br>
                <strong class="text-red">So let’s bring it up to speed.</strong></p>
            <img class="hidden-sm hidden-md hidden-lg" src="https://d2vyvo0tyx8ig5.cloudfront.net/shop/products/destupefy-your-left-hand/quotes-mobile-2.png">
        </div>
    </section>
    <section class="thumb-grid text-center">
        <div class="noise-wrap">
            <div class="container">
                <h2><strong>Your 3-Step Path To <br class="hidden-sm hidden-md hidden-lg"> A Better Left Hand</strong></h2>
                <h4 class="text-red"><em>By the end of this training course, your left hand will feel stronger, you’ll feel more comfortable. And you’ll be playing beautiful patterns and accompaniments.</em></h4>
                <p>EVERY lesson is designed to build up the one before it. <br class="hidden-md hidden-lg">
                    It’s your detailed, step-by-step path to a better left hand.</p>
                <div class="outline-boxes col-xs-12 no-padding">
                    <div class="col-xs-12 col-sm-4 half-padding">
                        <a href="#step1" class="anchor-slide outlined-box">
                            <h4><strong><span class="text-red">STEP 1</span><br>
                                INCREASE<br class="hidden-xs hidden-md hidden-lg"> YOUR IQ</strong></h4>
                            <p>Get the skills to build<br class="hidden-xs">
                                a solid foundation.</p>
                        </a>
                    </div>
                    <div class="col-xs-12 col-sm-4 half-padding">
                        <a href="#step2" class="anchor-slide outlined-box">
                            <h4><strong><span class="text-red">STEP 2</span><br>
                                    SPEED. ACCURACY.<br class="hidden-xs hidden-md hidden-lg"> CONTROL.</strong></h4>
                            <p>Start developing your skills with exercises to make you better.</p>
                        </a>
                    </div>
                    <div class="col-xs-12 col-sm-4 half-padding">
                        <a href="#step3" class="anchor-slide outlined-box">
                            <h4><strong><span class="text-red">STEP 3</span><br>
                                    MAKE IT<br class="hidden-xs hidden-md hidden-lg"> BEAUTIFUL</strong></h4>
                            <p>Apply the skills you’ve learned to play beautiful patterns & music.</p>
                        </a>
                    </div>
                </div>
                <div class="step-wrap col-xs-12 no-padding">
                    <div id="step1" class="anchor"></div>
                    <h4 class="text-red"><strong>STEP 1</strong></h4>
                    <h2><strong>INCREASE YOUR IQ</strong></h2>
                    <p>Start from scratch and show your left-hand what to do. Because once it knows what it’s supposed to do, we can put it to work.  In this section, you’ll get the basic skills of keyboard familiarity and finger independence. So your fingers will move when YOU want them to -- not on their own.</p>
                    <div class="image-grid-item col-xs-12 col-sm-6 col-md-3">
                        <div class="thumbnail" style="background-image:url(https://d2vyvo0tyx8ig5.cloudfront.net/shop/products/destupefy-your-left-hand/lesson-1.jpg)"><div class="top-left-badge">LESSON 1</div></div>
                        <p><strong>Left-Hand Intervals</strong><br>
                            Get comfortable playing intervals on the piano, and having your fingers work on their own.</p>
                    </div>

                    <div class="image-grid-item col-xs-12 col-sm-6 col-md-3">
                        <div class="thumbnail" style="background-image:url(https://d2vyvo0tyx8ig5.cloudfront.net/shop/products/destupefy-your-left-hand/lesson-2.jpg)"><div class="top-left-badge">LESSON 2</div></div>
                        <p><strong>Intervals Test</strong><br>
                            Put your fingers to work - A timed drill to increase your finger speed and mental ability.</p>
                    </div>

                    <div class="image-grid-item col-xs-12 col-sm-6 col-md-3">
                        <div class="thumbnail" style="background-image:url(https://d2vyvo0tyx8ig5.cloudfront.net/shop/products/destupefy-your-left-hand/lesson-3.jpg)"><div class="top-left-badge">LESSON 3</div></div>
                        <p><strong>Rhythm</strong><br>
                            Learn the most common (and often confusing) left-hand rhythm patterns.</p>
                    </div>

                    <div class="image-grid-item col-xs-12 col-sm-6 col-md-3">
                        <div class="thumbnail" style="background-image:url(https://d2vyvo0tyx8ig5.cloudfront.net/shop/products/destupefy-your-left-hand/lesson-4.jpg)"><div class="top-left-badge">LESSON 4</div></div>
                        <p><strong>Coordinating Your Hands</strong><br>
                            You have 2 hands right? Learn how to connect both of them to make your playing sound better.</p>
                    </div>
                </div>
                <div class="step-wrap col-xs-12 no-padding">
                    <div id="step2" class="anchor"></div>
                    <h4 class="text-red"><strong>STEP 2</strong></h4>
                    <h2><strong>SPEED. ACCURACY. CONTROL.</strong></h2>
                    <p>Now your fingers are comfortable playing the notes, it’s time to put them to work. This section will show you short exercises that will make BIG differences in your playing. You’ll play faster, more accurately, and with more confidence.</p>
                    <div class="image-grid-item col-xs-12 col-sm-6 col-md-3">
                        <div class="thumbnail" style="background-image:url(https://d2vyvo0tyx8ig5.cloudfront.net/shop/products/destupefy-your-left-hand/lesson-5.jpg)"><div class="top-left-badge">LESSON 5</div></div>
                        <p><strong>Finger Number Exercises</strong><br>
                            Learn drills to improve your speed and dexterity. Learn note-by-note. Finger-by-finger.</p>
                    </div>

                    <div class="image-grid-item col-xs-12 col-sm-6 col-md-3">
                        <div class="thumbnail" style="background-image:url(https://d2vyvo0tyx8ig5.cloudfront.net/shop/products/destupefy-your-left-hand/lesson-6.jpg)"><div class="top-left-badge">LESSON 6</div></div>
                        <p><strong>Scales For Independence</strong><br>
                            Start playing independently. Use scales to get comfortable playing different parts with each hand.</p>
                    </div>

                    <div class="image-grid-item col-xs-12 col-sm-6 col-md-3">
                        <div class="thumbnail" style="background-image:url(https://d2vyvo0tyx8ig5.cloudfront.net/shop/products/destupefy-your-left-hand/lesson-7.jpg)"><div class="top-left-badge">LESSON 7</div></div>
                        <p><strong>Octave Scales For Accuracy</strong><br>
                            Play the RIGHT notes at the right time. Build your confidence on the keyboard so you feel more comfortable.</p>
                    </div>

                    <div class="image-grid-item col-xs-12 col-sm-6 col-md-3">
                        <div class="thumbnail" style="background-image:url(https://d2vyvo0tyx8ig5.cloudfront.net/shop/products/destupefy-your-left-hand/lesson-8.jpg)"><div class="top-left-badge">LESSON 8</div></div>
                        <p><strong>The Claw For Speed</strong><br>
                            Learn all the chords that sound good together in any key signature, all while making your left-hand faster and stronger.</p>
                    </div>
                </div>
                <div class="step-wrap col-xs-12 no-padding">
                    <div id="step3" class="anchor"></div>
                    <h4 class="text-red"><strong>STEP 3</strong></h4>
                    <h2><strong>MAKE IT BEAUTIFUL</strong></h2>
                    <p>You don’t learn the piano to play exercises. It’s all about beautiful music. In this step, you’ll take all the skills you’ve learned up until now and apply them to REAL musical patterns that are used in the most beautiful songs.</p>
                    <div class="image-grid-item col-xs-12 col-sm-6 col-md-3">
                        <div class="thumbnail" style="background-image:url(https://d2vyvo0tyx8ig5.cloudfront.net/shop/products/destupefy-your-left-hand/lesson-9.jpg)"><div class="top-left-badge">LESSON 9</div></div>
                        <p><strong>Chord Progression</strong><br>
                            All songs are just chord progressions. Use the skills you’ve learned in Steps 1 & 2 to start making beautiful music.</p>
                    </div>

                    <div class="image-grid-item col-xs-12 col-sm-6 col-md-3">
                        <div class="thumbnail" style="background-image:url(https://d2vyvo0tyx8ig5.cloudfront.net/shop/products/destupefy-your-left-hand/lesson-10.jpg)"><div class="top-left-badge">LESSON 10</div></div>
                        <p><strong>Broken Chord Patterns</strong><br>
                            The most common (and beautiful) left-hand chord patterns. Your fingers will really be working on their own by now.</p>
                    </div>

                    <div class="image-grid-item col-xs-12 col-sm-6 col-md-3">
                        <div class="thumbnail" style="background-image:url(https://d2vyvo0tyx8ig5.cloudfront.net/shop/products/destupefy-your-left-hand/lesson-11.jpg)"><div class="top-left-badge">LESSON 11</div></div>
                        <p><strong>The 5-2-1-2 Pattern</strong><br>
                            A super-beautiful arpeggio pattern that builds on skills from earlier lessons to make you sound like Einaudi.</p>
                    </div>

                    <div class="image-grid-item col-xs-12 col-sm-6 col-md-3">
                        <div class="thumbnail" style="background-image:url(https://d2vyvo0tyx8ig5.cloudfront.net/shop/products/destupefy-your-left-hand/lesson-12.jpg)"><div class="top-left-badge">LESSON 12</div></div>
                        <p><strong>The Spa Pattern</strong><br>
                            Another beautiful arpeggio pattern that will transform your playing into a relaxing zen-like experience.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="smarter-practice text-center lazy" data-src="https://d2vyvo0tyx8ig5.cloudfront.net/shop/products/piano-technique-made-easy/smarter-practice-background.jpg">
        <div class="container">
            <h2><strong>Perfect Practice. Every time.</strong></h2>
            <div class="flex text-left">
                <div class="song-demo-wrap lazy" data-src="https://d2vyvo0tyx8ig5.cloudfront.net/shop/products/destupefy-your-left-hand/preview-soundslice.jpg"
                        data-toggle="modal" data-target="#songSlice">
                    <div class="text-arrow">
                        <span>SEE HOW<br>IT WORKS</span><br> <img alt="" class="lazy arrow"
                                data-src="https://d2vyvo0tyx8ig5.cloudfront.net/sales/arrow-left-red.png">
                    </div>
                    <i class="fas fa-play"></i>
                </div>

                <p>You’re busy. You want results from the work you put in.
                    <br><br>
                    That’s why EVERY lesson comes with hand-picked (see what I did there) practice exercises for you to work on and complete before moving to the next lesson.
                    <br><br>
                    You can adjust the tempo, or highlight a passage you want to repeat and work on.
                    <br><br>
                    That means you get the MOST from your (valuable) time. It also means you see results faster.
                    <br><br>
                    Go on, give it a try.</p>

            </div>
        </div>
    </section>
    <div class="modal fade text-center songslice" id="songSlice" tabindex="-1" role="dialog" aria-labelledby="trailerLabel">
        <i class="close fas fa-times" data-dismiss="modal" aria-label="Close"></i>
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="embed-responsive embed-responsive-4by3">
                    <iframe class="embed-responsive-item" src="https://www.soundslice.com/scores/475623/embed/?api=1&amp;scroll_type=2&amp;branding=0" frameborder="0" allowfullscreen allow="autoplay"></iframe>
                </div>
            </div>
        </div>
    </div>
    <section class="benefits text-center">
        <div class="container">
            <h2><strong>Personal Support Means<br class="hidden-sm hidden-md hidden-lg"> You’ll Never Feel Lost</strong></h2>
            <h4 class="text-red"><em>You’ll have constant access to REAL teachers throughout the training course, as well as your fellow students. Never feel lost or overwhelmed. There will always be help when you need it.</em></h4>

            <div class="benefit-tile col-xs-12 col-sm-6">
                <i class="fal fa-stopwatch"></i>
                <p>
                    <strong>Short Lessons</strong><br> The longest lesson is only 10 minutes. That means you spend more time playing - and getting better!
                </p>
            </div>

            <div class="benefit-tile col-xs-12 col-sm-6">
                <i class="fal fa-signal-alt"></i>
                <p>
                    <strong>Perfect For All Levels</strong><br> Structured step-by-step lessons you can take at your own pace.
                </p>
            </div>

            <hr style="opacity: 0;margin:0;" class="col-xs-12 hidden-xs no-padding">
            <div class="benefit-tile col-xs-12 col-sm-6">
                <i class="fal fa-piano-keyboard"></i>
                <p>
                    <strong>Practice-along Exercises</strong><br> Play-along exercises will help you master the fundamentals and build the foundation needed for success.
                </p>
            </div>

            <div class="benefit-tile col-xs-12 col-sm-6">
                <i class="fal fa-question"></i>
                <p>
                    <strong>Your Questions Answered</strong><br> Got questions? You’ll always find answers. Real teachers will be available to help when you need it.
                </p>
            </div>

            <hr style="opacity: 0;margin:0;" class="col-xs-12 hidden-xs no-padding">
            <div class="benefit-tile col-xs-12 col-sm-6">
                <i class="fal fa-file-download"></i>
                <p>
                    <strong>Downloadable Resources</strong><br> EVERY lesson comes with downloadable exercises and resources. You’ll get over 21 pages of printable exercises.
                </p>
            </div>

            <div class="benefit-tile col-xs-12 col-sm-6">
                <i class="fal fa-infinity"></i>
                <p>
                    <strong>Yours Forever</strong><br> These lessons NEVER expire. Watch them again, and again, and again… (you get the point).
                </p>
            </div>
        </div>
    </section>
    <section class="personal-teacher text-center" style="background-image:url(https://d2vyvo0tyx8ig5.cloudfront.net/shop/products/destupefy-your-left-hand/lisa-witt.jpg);">
        <div class="container">
            <h1><strong>LISA WITT</strong></h1>
            <h4 class="text-red"><em>is your teacher.</em></h4>
            <p><strong>I was shocked.</strong>
                <br><br>
                My hands, they were so… <em>Uncoordinated!</em> It was like my left land was stuck in slow motion and no matter how hard I focused, how carefully I slowed down… My hands wouldn’t cooperate.
                <br><br>
                It was alarming. I felt like I had lost all the skills I had spent a lifetime developing.
                <br><br>
                I had taken a little hiatus from the piano and it had been a couple of years (yes years!) since I had properly practiced. And it showed.
                <br><br>
                So I took a breath, and made a commitment to completely focus on my left hand. I broke the exercises down to their most basic form, and practiced.
                <br><br>
                <em>And you know what happened?&nbsp;</em> <strong> I got better.</strong> After just a couple of weeks of focused left-hand practice, my playing drastically improved and I began to feel like my old piano self again.
                <br><br>
                Now what about you?  Do you struggle with your left hand? Does it always feel like it’s lagging behind when it comes to dexterity, coordination, and control?
                <br><br>
                If you’re like most piano players, chances are it does.
                <br><br>
                Through step-by-step lessons, I’ll show you how to break down exercises that are specifically designed to improve all aspects of your left-hand playing.
                <br><br>
                And I’ll show you how and what to focus on during your practice sessions, so your left hand won’t be lagging behind anymore.
                <br><br>
                Because I know if I can do it… <strong>So can you.</strong>
                <br><br>
                <img src="https://d2vyvo0tyx8ig5.cloudfront.net/shop/products/piano-riffs-and-fills/lisa-witt-signature.png">
            </p>
        </div>
    </section>

    <section class="student-testimonials text-center">
        <div class="container">
            <h2><strong>What students <br class="hidden-sm hidden-md hidden-lg"> are saying.</strong></h2>
            <div class="testimonials">
                @include('pianote.sales.partials._testimonial', [
                "heading" => "It was like I didn’t know how to play at all...",
                "testimonial" => "My left hand seemed to have a mind of its own, and I’d get confused with the left-hand notes.<br><br>I had been having difficulty playing a song with both hands. I could play either hand alone, but when I’d try to play them together it was like I didn’t know how to play at all.<br><br>I stopped practicing the song for a few days and just concentrated on the left-hand exercises in De-Stupefy Your Left Hand for about a week.  Then when I went back to my song, I could play it with both hands!<br><br>I was so pleased. It really helped me move forward.<br><br>Now, my playing is more fluid and natural. I found it really helped me progress and overcome a hurdle that was getting me discouraged with my learning.",
                "name" => "Joanne Dero",
                "location" => "Ontario, Canada",
                ])
                @include('pianote.sales.partials._testimonial', [
                "heading" => "I noticed it was working when my wife said, ‘Hey that sounds pretty good.",
                "testimonial" => "I had no variety in my left hand when trying to improvise. I just banged away on the chords. Also, I had very little confidence when sight-reading, constantly slowing down to get lefty in position.<br><br>De-Stupefy Your Left hand gave me (and is still giving me) specific exercises and drills that are fun to play at increasing tempos.<br><br>I noticed it was working when my wife said, “Hey that sounds pretty good.” She was right. I was running through the drills smoothly and with confidence.<br><br>I’d recommend this pack mainly because it’s fun. The lessons are short and well presented, and the exercises are designed so that you can feel yourself improving after just a few sessions. Another great addition to Pianote!",
                "name" => "Stu Kollar",
                "location" => "Ohio, USA",
                ])
                @include('pianote.sales.partials._testimonial', [
                "heading" => "(It) taught me things I would not have thought of on my own.",
                "testimonial" => "I was struggling with my left hand, making mistakes, and having issues with my rhythm and dexterity.<br><br>De-Stupefy Your Left Hand kept my left hand pretty busy and taught me things I would not have thought of on my own.<br><br>I noticed it was making a difference when I played my arpeggios in a song I’m working on and I didn’t fumble as much. My husband said, “Wow!”. That was a great feeling!<br><br>I am more excited about my playing and more confident now. If you want to play with ease and have more dexterity in your left hand try this pack. You won’t regret it.",
                "name" => "Linda Riddle",
                "location" => "Missouri, USA",
                ])
                @include('pianote.sales.partials._testimonial', [
                "heading" => "(It feels) as if it was designed especially for my own issues.",
                "testimonial" => "De-Stupefy Your Left Hand is really easy to follow, and being able to watch and follow along while someone else is playing makes it a lot easier.<br><br>When I started getting more control my left-hand playing became easier and lifted a load off my chest because this has always been a huge problem and frustration of mine.<br><br>De-Stupefy Your Left Hand is a really great presentation and makes a person feel as if it was designed especially for my own issues.<br><br>It was almost as if I was sitting right there!",
                "name" => "Sean Robert Swart",
                "location" => "South Africa",
                ])
            </div>
        </div>
    </section>
    <section class="guarantee">
        <div class="noise-wrap">
            <div class="container">
                <h2><strong>A Better Left Hand,<br class="hidden-sm hidden-md hidden-lg"> Guaranteed.</strong></h2>
                <img class="lazy" data-src="https://d2vyvo0tyx8ig5.cloudfront.net/sales/guarantee-badge.png"
                        alt="90-Day Money-Back Guarantee">
                <p>You shouldn’t have to pay for something you don’t get. That’s why if your left hand is not better, faster, and more independent, you won’t pay a cent.
                    <br><br>
                    And you’ll have 90 days to test it all. Many courses only offer a short guarantee -- some as little as 14 days.
                    <br><br>
                    But you know it takes more than that to tell if something is REALLY working. And we want you to be able to try EVERYTHING in this course before deciding whether it’s worth your money.
                    <br><br>
                    So try it for 3 months. If it’s not working, you’ll get a full refund. It’s our promise.
                </p>
            </div>
        </div>
    </section>
    <section class="final text-center lazy" data-src="https://d2vyvo0tyx8ig5.cloudfront.net/shop/products/destupefy-your-left-hand/order-background.jpg">
        <div class="container">
            <img class="logo lazy" data-src="https://d2vyvo0tyx8ig5.cloudfront.net/shop/products/destupefy-your-left-hand/de-stupefy-logo.png">
            <h1><strong>It’s time to tame<br class="hidden-sm hidden-md hidden-lg"> your left hand.</strong></h1>
            <a href="{{ url()->route('shopping-cart.add-to-cart', ['products' => ['destupefy-your-left-hand' => 1], 'redirect' => '/order', 'locked' => 'false']) }}" class="join">Get Started &raquo;</a>
            <p class="breakdown">
                @if(PianotePrices::$destupefyFull > PianotePrices::$destupefyRegular)
                    <s>NORMALLY ${{ PianotePrices::$destupefyFull }}.</s> &nbsp;
                    <strong><u>ONLY ${{ PianotePrices::$destupefyRegular }}</u></strong>&nbsp; (SAVE {{ round(100 - (100 * (PianotePrices::$destupefyRegular / PianotePrices::$destupefyFull))) }}%)
                @else
                    <strong><u>ONLY ${{ PianotePrices::$destupefyRegular }}</u></strong>
                @endif
                <br><a href="/" class="red">(OR FREE WITH A PIANOTE MEMBERSHIP)</a><br>
                    <strong class="yellow">** 90-DAY GUARANTEE **</strong></p>

            <div class="credit-cards col-xs-12">
                <i class="fab fa-cc-visa"></i>
                <i class="fab fa-cc-mastercard"></i>
                <i class="fab fa-cc-discover"></i>
                <i class="fab fa-cc-amex"></i>
                <i class="fab fa-cc-paypal"></i>
                <br><br>
            </div>
            <div class="col-xs-12 questions">
                <p><strong>Any questions?</strong><br class="hidden-lg hidden-md hidden-sm">
                    Call us toll-free at <a href="tel:+18004398921">1-800-439-8921</a> <br class="hidden-lg hidden-md hidden-sm">
                    or directly at <a href="tel:+16048557605">1-604-855-7605</a>.<br>
                    All prices listed in USD. </p>
            </div>
        </div>
    </section>

    <section class="faqs">
        <div class="container no-padding">
            <h2 class="col-xs-12"><strong>Still Have Questions?</strong></h2>
            <div class="col-xs-12">
                @include('pianote.sales.partials._week-breakdown', [
                "question" => true,
                "weekTitle" => "Is this course for beginners?",
                "weekDescription" => "Yes! This course is designed for beginners to show them the best way to start building a strong left-hand. But if you’re more advanced, that’s ok too. You can skip ahead in the course to the exercises that "
                ])
                @include('pianote.sales.partials._week-breakdown', [
                "question" => true,
                "weekTitle" => "How long until I see results?",
                "weekDescription" => "You might notice a change after your first lesson! If you commit to putting in the work and following the practice exercises, you’ll see real results in just a few days. With regular practice, it should take about a month to complete the entire course."
                ])
                @include('pianote.sales.partials._week-breakdown', [
                "question" => true,
                "weekTitle" => " Do I need a special keyboard or cables?",
                "weekDescription" => "No! The lessons and practice exercises work on any computer, smartphone, or tablet with an internet connection. And it works with ANY piano or keyboard. You don’t have to plug anything in."
                ])
                @include('pianote.sales.partials._week-breakdown', [
                "question" => true,
                "weekTitle" => " What about the right hand?",
                "weekDescription" => "EVERY exercise in this course for the left hand can also be applied to your right hand as well. Just switch up the fingering and you’ll be getting twice the value!"
                ])
            </div>
        </div>
    </section>

    @include('pianote.sales.footer')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/jquery.lazy/1.7.9/jquery.lazy.min.js"></script>
    <script type="text/javascript" src="/marketing/parcel/pianote/nav-footer.js"></script>
    <script type="text/javascript" src="/marketing/js/pianote/modal-autoplay.js"></script>
    <script>
        $(document).ready(function () {
            $('.lazy').Lazy({
                threshold: 600
            });

            //levels dropdowns
            $('.question-dropdown').on('click', questionDropdown);

            function questionDropdown() {
                $(this).toggleClass('active');
                $(this).find('.fa-chevron-down').toggleClass('rotated');
            }
        });
    </script>

    @include('pianote._partials._promo-countdown')
    {!! inspectlet_embed_script() !!}
@stop
