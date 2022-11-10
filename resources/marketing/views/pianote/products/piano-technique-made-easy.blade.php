@extends('pianote._partials.global-layout')

@section('global-head')
    <title>Piano Technique Made Easy | Pianote</title>
    <meta name="description" content="Master the fundamentals -- so you can play anything you want on the piano.">

    <meta property="og:image" content="https://d2vyvo0tyx8ig5.cloudfront.net/shop/products/piano-technique-made-easy/og-image.jpg" style="display: none;">
    <meta property="og:title" content="Piano Technique Made Easy">
    <meta property="og:description" content="Master the fundamentals -- so you can play anything you want on the piano.">
    <meta property="og:url" content="https://www.pianote.com/piano-technique-made-easy">

    <link href="https://fonts.googleapis.com/css?family=Permanent+Marker&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.4.1/css/bootstrap.min.css">
    <link href="{{ asset('/marketing/parcel/pianote/nav-footer.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="/marketing/parcel/pianote/ptme.css">
@stop

@section('global-body')
    @include('pianote._partials._nav', [
        "cartVersion" => true
    ])
    @include('pianote._partials._promo-banner', [
                    "name" => "Piano Technique Made Easy",
                    "fullPrice" => PianotePrices::$PTMEFull,
                    "price" => PianotePrices::$PTMERegular,
                    "noBreadcrumb" => true
                ])
    <header class="header text-center" style="background-image:url(https://d2vyvo0tyx8ig5.cloudfront.net/shop/products/piano-technique-made-easy/header.jpg);">
        <div class="container">
            <img class="logo"
                    src="https://d2vyvo0tyx8ig5.cloudfront.net/shop/products/piano-technique-made-easy/logo.png"><br>
            <i class="fas fa-play play-vimeo autoplay-video" data-toggle="modal" data-target="#trailer"></i>
            <h2>Master the fundamentals -- so you can <br> <strong>play anything you want on the piano.</strong></h2>
            {{--<a class="join" href="/piano-technique-made-easy/notify">Notify Me &raquo;</a>--}}
            <a
                class="join vue-add-to-cart"
                href="{{ url()->route('shopping-cart.add-to-cart', ['products' => ['piano-technique-made-easy' => 1], 'redirect' => '/order', 'locked' => 'false']) }}"
                data-product-json='{"piano-technique-made-easy": 1}'
            >Get Started &raquo;</a>

            <p class="breakdown">
                @if(PianotePrices::$PTMEFull > PianotePrices::$PTMERegular)
                    <s>NORMALLY ${{ PianotePrices::$PTMEFull }}.</s> &nbsp;
                    <strong><u>ONLY ${{ PianotePrices::$PTMERegular }}</u></strong>&nbsp; (SAVE {{ round(100 - (100 * (PianotePrices::$PTMERegular / PianotePrices::$PTMEFull))) }}%)
                @else
                    <strong><u>ONLY ${{ PianotePrices::$PTMERegular }}</u></strong>
                @endif
                <br><a href="/" class="red">(OR FREE WITH A PIANOTE MEMBERSHIP)</a><br> <strong
                        class="yellow">** 90-DAY GUARANTEE **</strong></p>
        </div>
    </header>
    <div class="modal fade text-center" id="trailer" tabindex="-1" role="dialog" aria-labelledby="trailerLabel">
        <i class="close stop-play fas fa-times" data-dismiss="modal" aria-label="Close"></i>
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="embed-responsive embed-responsive-16by9">
                    <iframe class="embed-responsive-item reset-on-close" src="" data-lazy-load-url="//player.vimeo.com/video/466355774?autoplay=1" frameborder="0" allowfullscreen allow="autoplay"></iframe>
                </div>
                {{--<a class="join" href="/piano-technique-made-easy/notify">Notify Me &raquo;</a>--}}
                <a href="{{ url()->route('shopping-cart.add-to-cart',
                ['products' => ['piano-technique-made-easy' => 1], 'redirect' => '/order', 'locked' => 'false']) }}" class="join">Get Started</a>
            </div>
        </div>
    </div>
    <section class="feel-stuck">
        <div class="container">
            <img class="hidden-xs" src="https://d2vyvo0tyx8ig5.cloudfront.net/shop/products/piano-technique-made-easy/struggle-graphic.png">
            <img class="hidden-sm hidden-md hidden-lg" src="https://d2vyvo0tyx8ig5.cloudfront.net/shop/products/piano-technique-made-easy/struggle-graphic-mobile.png">
            <p>Feeling stuck on the keys? Like you’ve hit a wall you just can’t break through?
                <br><br>
                We all have that one song -- you know, the one you WANT to play but wonder if you’ll ever be good enough to make it happen.
                <br><br>
                Because up until now -- it hasn’t.
                <br><br>
                Chances are your technique is holding you back.
                <br><br>
                Here’s the thing about technique…<br>
                <strong>It’s the FOUNDATION of your piano playing.</strong>
                <br><br>
                And without a good foundation -- you’ll never reach the heights you dream of. You’ll get stuck at the same level.
                <br><br>
                Forever frustrated that you’re not seeing the results you know you deserve.
                <br><br>
                But when you HAVE good technique… <strong>Everything gets easier.</strong>
                <br><br>
                You’ll be <strong>playing faster</strong> because your fingers are moving the correct way.
                <br><br>
                You’re <strong>learning songs quicker</strong> because your muscle memory has been finely honed.
                <br><br>
                And you’re <strong>expressing yourself</strong> through music because now...
                <br><br>
                <strong>You have the skillset</strong> to do so.
                <br><br>
                So if your technique is stopping you from breaking through that wall...
                <br><br>
                <strong class="text-red">Let’s smash it.</strong></p>
        </div>
    </section>
    <span class="sticky-trigger"></span>
    <section class="five-skills text-center">
        <img class="sticky-pic" src="https://d2vyvo0tyx8ig5.cloudfront.net/shop/products/piano-technique-made-easy/skill-section-background.jpg">
        <div class="container">
            <h2><strong>Jump To The Skill You’d <br class="hidden-sm hidden-md hidden-lg">Like To Improve The Most:</strong></h2>
            <div class="subnav-shim hidden-xs"></div>
            <div class="subnav clearfix">
                <div class="col-xs-12"><a href="#knowledge" class="topic-link knowledge anchor-slide"><span class="hidden-xs hidden-sm hidden-md">Keyboard </span>Knowledge</a></div>
                <div class="col-xs-12"><a href="#scales" class="topic-link scales anchor-slide">Scales</a></div>
                <div class="col-xs-12"><a href="#chords" class="topic-link chords anchor-slide">Chords</a></div>
                <div class="col-xs-12"><a href="#arpeggios" class="topic-link arpeggios anchor-slide">Arpeggios</a></div>
                <div class="col-xs-12"><a href="#songs" class="topic-link songs anchor-slide"><span class="hidden-xs">Playing </span>Songs</a></div>
            </div>
            <div class="text-wrap">
                <div id="knowledge" class="anchor"></div>
                <h2><strong>Keyboard Knowledge</strong></h2>

                <p>Wouldn’t playing the piano be so much easier if you just KNEW where everything was on the keyboard?
                    <br><br> If those sharps and flats weren’t so intimidating or confusing?
                    <br><br> Because let’s be honest... <br><br> You’re avoiding parts of it.
                    <br><br> We all have our comfort zones, those places on the piano we rarely stray from.
                    <br><br> Keyboard knowledge means sitting at the piano and feeling like you belong there. Like you KNOW this instrument.
                    <br><br> Piano Technique Made Easy will unlock the keyboard gradually, when you’re ready.
                    <br><br> So you’ll learn the entire thing without feeling overwhelmed or lost.</p>
            </div>

            <div class="clearfix check-container text-center">
                <div class="col-xs-4 no-padding">
                    <i class="fal fa-check text-red"></i>
                    <h4 class="permanent">FEEL LIKE<br>YOU BELONG</h4>
                </div>
                <div class="col-xs-4 no-padding">
                    <i class="fal fa-check text-red"></i>
                    <h4 class="permanent">NEVER BE<br>OVERWHELMED</h4>
                </div>
                <div class="col-xs-4 no-padding">
                    <i class="fal fa-check text-red"></i>
                    <h4 class="permanent">KNOW YOUR<br>INSTRUMENT</h4>
                </div>
            </div>

            <div class="text-wrap">
                <div id="scales" class="anchor"></div>
                <h2><strong>Scales</strong></h2>

                <p>We all have our favorite scales that we come back to time and time again. They’re comfortable, they’re home.
                    <br><br> But they’re not making you a better piano player.
                    <br><br> Piano Technique Made Easy will teach you EVERY major and minor scale on EVERY key on the piano.
                    <br><br> So you don’t have to keep feeling trapped in the key of C.
                    <br><br> Because when you know how to play different scales, learning the songs written in those keys becomes easy.
                    <br><br> So think of that scale you’ve been avoiding.
                    <br><br> Now thing of how amazing it will feel to play it, smoothly and comfortably.</p>
            </div>

            <div class="clearfix check-container text-center">
                <div class="col-xs-4 no-padding">
                    <i class="fal fa-check text-red"></i>
                    <h4 class="permanent">EVERY MAJOR &<br> MINOR SCALE</h4>
                </div>
                <div class="col-xs-4 no-padding">
                    <i class="fal fa-check text-red"></i>
                    <h4 class="permanent">NEVER FEEL <br>TRAPPED</h4>
                </div>
                <div class="col-xs-4 no-padding">
                    <i class="fal fa-check text-red"></i>
                    <h4 class="permanent">SONGS BECOME <br>EASIER</h4>
                </div>
            </div>

            <div class="text-wrap">
                <div id="chords" class="anchor"></div>
                <h2><strong>Chords</strong></h2>

                <p>Chords make songs. It’s as simple as that.
                    <br><br> Knowing how to play all the major and minor chords on the piano will help you play any song that you might want to learn.
                    <br><br> And you won’t get stuck when you see a chord you don’t know… because there won’t BE a chord you don’t know.
                    <br><br> Piano Technique Made Easy will show you every major and minor chord in every key signature.
                    <br><br> And with step-by-step practice exercises and play-alongs, you’ll start to FEEL the chords instead of having to think about them.
                    <br><br> That’s musical freedom.</p>
            </div>

            <div class="clearfix check-container text-center">
                <div class="col-xs-4 no-padding">
                    <i class="fal fa-check text-red"></i>
                    <h4 class="permanent">EVERY CHORD ON<br> EVERY KEY</h4>
                </div>
                <div class="col-xs-4 no-padding">
                    <i class="fal fa-check text-red"></i>
                    <h4 class="permanent">UNLOCK  <br>NEW SONGS</h4>
                </div>
                <div class="col-xs-4 no-padding">
                    <i class="fal fa-check text-red"></i>
                    <h4 class="permanent">CHANGE CHORDS  <br>FASTER</h4>
                </div>
            </div>

            <div class="text-wrap">
                <div id="arpeggios" class="anchor"></div>
                <h2><strong>Arpeggios</strong></h2>

                <p>So you want to play like Einaudi? Or Yiruma?
                    <br><br> Arpeggios take simple concepts and make them truly special and beautiful.
                    <br><br> Piano Technique Made Easy will show you how to play arpeggios on every note with both hands, so you can add that sense of wonder and beautify to your own piano playing.
                    <br><br> And you won’t have to guess about how to play them.
                    <br><br> You’ll be shown every note AND the correct fingering to make it as easy as possible to play them like a pro.
                </p>
            </div>

            <div class="clearfix check-container text-center">
                <div class="col-xs-4 no-padding">
                    <i class="fal fa-check text-red"></i>
                    <h4 class="permanent">SOUND LIKE <br> EINAUDI</h4>
                </div>
                <div class="col-xs-4 no-padding">
                    <i class="fal fa-check text-red"></i>
                    <h4 class="permanent">ADD BEAUTY TO <br>YOUR PLAYING</h4>
                </div>
                <div class="col-xs-4 no-padding">
                    <i class="fal fa-check text-red"></i>
                    <h4 class="permanent">STEP-BY-STEP <br>INSTRUCTIONS</h4>
                </div>
            </div>

            <div class="text-wrap">
                <div id="songs" class="anchor"></div>
                <h2><strong>Playing Songs</strong></h2>

                <p>What’s the point of learning technique if you don’t use it?
                    <br><br> At the end of every level you’ll be able to play the most popular chord progressions used in your favorite songs.
                    <br><br> This makes learning pop songs a breeze because you’ll have already mastered the progressions that are used in EVERY key.
                    <br><br> So you’ll NEVER have to be intimidated by different key signatures or chord progressions.
                    <br><br> And that song you’ve been dreaming of -- won’t seem so hard anymore.</p>
            </div>

            <div class="clearfix check-container text-center">
                <div class="col-xs-4 no-padding">
                    <i class="fal fa-check text-red"></i>
                    <h4 class="permanent">MASTER CHORD <br> PROGRESSIONS</h4>
                </div>
                <div class="col-xs-4 no-padding">
                    <i class="fal fa-check text-red"></i>
                    <h4 class="permanent">PLAY SONGS   <br>MORE EASILY</h4>
                </div>
                <div class="col-xs-4 no-padding">
                    <i class="fal fa-check text-red"></i>
                    <h4 class="permanent">
                        <span class="hidden-sm hidden-md hidden-lg">USE YOUR <br>TECHNIQUE</span>
                        <span class="hidden-xs">PUT YOUR <br>TECHNIQUE TO USE</span>
                    </h4>
                </div>
            </div>
        </div>
        <span class="unstick-trigger"></span>
    </section>
    <section class="every-scale text-center">
        <div class="container">
            <h2><strong>Every Scale. Every Chord. <br class="hidden-sm hidden-md hidden-lg"> Every Key.</strong></h2>
            <div class="clearfix">
                <div class="image-grid-item half-padding col-xs-6 col-sm-4 col-md-3">
                    <img class="lazy" src=""
                            data-src="https://d2vyvo0tyx8ig5.cloudfront.net/shop/products/piano-technique-made-easy/level-1.jpg">
                </div>

                <div class="image-grid-item half-padding col-xs-6 col-sm-4 col-md-3">
                    <img class="lazy" src=""
                            data-src="https://d2vyvo0tyx8ig5.cloudfront.net/shop/products/piano-technique-made-easy/level-2.jpg">
                </div>


                <div class="image-grid-item half-padding col-xs-6 col-sm-4 col-md-3">
                    <img class="lazy" src=""
                            data-src="https://d2vyvo0tyx8ig5.cloudfront.net/shop/products/piano-technique-made-easy/level-3.jpg">
                </div>

                <div class="image-grid-item half-padding col-xs-6 col-sm-4 col-md-3">
                    <img class="lazy" src=""
                            data-src="https://d2vyvo0tyx8ig5.cloudfront.net/shop/products/piano-technique-made-easy/level-4.jpg">
                </div>


                <div class="image-grid-item half-padding col-xs-6 col-sm-4 col-md-3">
                    <img class="lazy" src=""
                            data-src="https://d2vyvo0tyx8ig5.cloudfront.net/shop/products/piano-technique-made-easy/level-5.jpg">
                </div>

                <div class="image-grid-item half-padding col-xs-6 col-sm-4 col-md-3">
                    <img class="lazy" src=""
                            data-src="https://d2vyvo0tyx8ig5.cloudfront.net/shop/products/piano-technique-made-easy/level-6.jpg">
                </div>


                <div class="image-grid-item half-padding col-xs-6 col-sm-4 col-md-3">
                    <img class="lazy" src=""
                            data-src="https://d2vyvo0tyx8ig5.cloudfront.net/shop/products/piano-technique-made-easy/level-7.jpg">
                </div>

                <div class="image-grid-item half-padding col-xs-6 col-sm-4 col-md-3">
                    <img class="lazy" src=""
                            data-src="https://d2vyvo0tyx8ig5.cloudfront.net/shop/products/piano-technique-made-easy/level-8.jpg">
                </div>


                <div class="image-grid-item half-padding col-xs-6 col-sm-4 col-md-3">
                    <img class="lazy" src=""
                            data-src="https://d2vyvo0tyx8ig5.cloudfront.net/shop/products/piano-technique-made-easy/level-9.jpg">
                </div>


                <div class="image-grid-item half-padding col-xs-6 col-sm-4 col-md-3">
                    <img class="lazy" src=""
                            data-src="https://d2vyvo0tyx8ig5.cloudfront.net/shop/products/piano-technique-made-easy/level-10.jpg">
                </div>

                <div class="image-grid-item half-padding col-xs-6 col-sm-4 col-md-3">
                    <img class="lazy" src=""
                            data-src="https://d2vyvo0tyx8ig5.cloudfront.net/shop/products/piano-technique-made-easy/level-11.jpg">
                </div>


                <div class="image-grid-item half-padding col-xs-6 col-sm-4 col-md-3">
                    <img class="lazy" src=""
                            data-src="https://d2vyvo0tyx8ig5.cloudfront.net/shop/products/piano-technique-made-easy/level-12.jpg">
                </div>
            </div>
            <p>There are 88 keys on a piano.
                <br><br>
                But only 12 unique notes.
                <br><br>
                That’s why Piano Technique Made Easy is broken down into 12 Levels.  One for each unique note on the piano.
                <br><br>
                These small, bite-sized lessons will teach you EVERY major and minor scale, chord, and arpeggio … in the way that makes the most sense.
                <br><br>
                By the end, you’ll be playing comfortable in ANY key on the piano. That means any song, key signature or chord won’t be intimidating or challenging.
                <br><br>
                You’ll know them all.</p>

            {{--<a href="{{ url()->route('shopping-cart.add-to-cart',--}}
    {{--['products' => ['piano-technique-made-easy' => 1], 'redirect' => '/order', 'locked' => 'false']) }}"--}}
                    {{--class="join smaller">Get Started &raquo;</a>--}}

        </div>
    </section>

    <section class="meet-teacher text-center lazy" data-src="https://d2vyvo0tyx8ig5.cloudfront.net/shop/products/piano-technique-made-easy/meet-your-teacher.jpg">
        <div class="container">
            <div class="text-wrap">
                <h2 class="text-red">Meet Your Teacher</h2>
                <h1><strong>Cassi Falk</strong></h1>
            </div>
            <hr class="col-xs-12 no-padding" style="opacity:0;margin:0;">
            <div class="col-xs-12 col-sm-6 text-left blue-bg">
                <h4><strong>Cassi Falk Is My Technique Guru.</strong></h4>
                <p><em class="text-red">A message from Lisa Witt</em><br><br>
                    Cassi is my go to technique person!
                    <br><br>
                    When I’m not quite sure about the best fingering for a scale or arpeggio, or I just need new ways to approach practicing certain elements of technique, I call on Cassi.
                    <br><br>
                    She understands the role technique plays in achieving true musical freedom.
                    <br><br>
                    And if she’s my technique guru. Then she should be yours as well.
                    <br><br>
                    Cassi has the best ideas and exercises to help you understand and integrate concepts you’re working on. And she’ll show you WHY these are important, so you won’t be wasting time practicing without a purpose.
                    <br><br>
                    She is the obvious choice for our most comprehensive technique resource.
                    <br><br>
                    Because if you’re going to spend the time learning scales, triads, and arpeggios, then you want to learn them from someone who loves them more than anyone I’ve ever met.
                    <br><br>
                    When you say the word technique, her face lights up.
                    <br><br>
                    She’s passionate, and has the skills and ability to share that passion and excitement with you.
                    <br><br>
                    <img class="avatar lazy" data-src="https://d2vyvo0tyx8ig5.cloudfront.net/products/worship-piano/lisa-witt.jpg">
                    <img class="lazy no-color" data-src="https://d2vyvo0tyx8ig5.cloudfront.net/shop/products/piano-riffs-and-fills/lisa-witt-signature.png">
                </p>
            </div>
            <div class="col-xs-12 col-sm-6 text-left blue-bg">
                <h4><strong>Hello Piano Lovers!</strong></h4>
                <p><em class="text-red">A message from Cassi Falk</em><br><br>
                    My name is Cassi and I am so pumped to share my love for the piano with you.
                    <br><br>
                    I have been playing since 1997 and teaching since 2005.  My love for the piano began when I was very young, just tinkering on my grandparent’s piano at their house after Sunday lunches.
                    <br><br>
                    They enrolled me in my first lessons, probably not expecting it to one day be my career, and now here we are!
                    <br><br>
                    I’m certified through the Royal Conservatory as an Intermediate Specialist, and I love piano technique.
                    <br><br>
                    Now, you probably think I’m crazy, after all, who loves scales?!
                    <br><br>
                    And honestly, it has not always been the case. I’ve thrown my fair share of metronomes in anger, hammered my fists on the keys in frustration, and raced through practice without even glimpsing a scale or arpeggio because I thought it was a waste of time.
                    <br><br>
                    I've heard it all, I've seen it all, and that's why I am so excited to share how even I learned to love technique!
                    <br><br>
                    I learned to put on my big girl pants and get over those first few hurdles, because like anything, technique takes practice!
                    <br><br>
                    And I’m here to tell you that if you’re willing to put in the work and stick with it like I did, you'll see how suddenly learning everything else will be a whole lot simpler!
                    <br><br>
                    I really mean that. Having a solid technique foundation will transform your piano playing.
                    <br><br>
                    And I’m here to help guide you through every step of the journey.
                    <br><br>
                    So let’s get started!


                    <br><br>
                    <img class="avatar lazy" data-src="https://d2vyvo0tyx8ig5.cloudfront.net/shop/products/piano-technique-made-easy/cassi-falk.jpg">
                    <img class="lazy no-color" data-src="https://d2vyvo0tyx8ig5.cloudfront.net/shop/products/piano-technique-made-easy/cassi-sig.png">
                </p>
            </div>
        </div>
    </section>
    <section class="any-device text-center">
        <div class="container">
            <h2><strong>Lessons that go where you do.</strong></h2>
            <h4>Whatever you use. Wherever you are.</h4>

            <div class="device-spread">
                <div class="text-arrow desktop">
                    <span>Better<br>practice<br>tools</span><br>
                    <img class="lazy arrow" data-src="https://d2vyvo0tyx8ig5.cloudfront.net/sales/arrow-right-red.png">
                </div>
                <div class="text-arrow macbook">
                    <span>Play<br>music</span><br>
                    <img class="lazy arrow" data-src="https://d2vyvo0tyx8ig5.cloudfront.net/sales/arrow-right-alt-red.png">
                </div>
                <div class="text-arrow ipad">
                    <span>Live<br>lessons</span><br>
                    <img class="lazy arrow vertical" data-src="https://d2vyvo0tyx8ig5.cloudfront.net/sales/arrow-left-down-red.png">
                </div>
                <div class="text-arrow iphone">
                    <span>Student<br>Forums</span><br>
                    <img class="lazy arrow" data-src="https://d2vyvo0tyx8ig5.cloudfront.net/sales/arrow-left-red.png">
                </div>
                <img class="lazy spread" data-src="https://d2vyvo0tyx8ig5.cloudfront.net/shop/products/piano-technique-made-easy/prouduct-spread.png">
            </div>
            <p>Start today and get INSTANT access to high-definition lessons that you can take anywhere, anytime, on any device you’re already using.
                <br><br>
                And if you don’t want to stare at a screen...
                <br><br>
                You can download and print EVERY exercise in this course. That’s over 72 pages of exercises and notes that are yours.
                <br><br>
                Print them, play them, master them.</p>
        </div>
    </section>
    <section class="smarter-practice text-center lazy" data-src="https://d2vyvo0tyx8ig5.cloudfront.net/shop/products/piano-technique-made-easy/smarter-practice-background.jpg">
        <div class="container">
            <h2><strong>Smarter Practice. Faster Results.</strong></h2>
            <div class="flex text-left">
                <div class="song-demo-wrap autoplay-video lazy" data-src="https://d2vyvo0tyx8ig5.cloudfront.net/shop/products/piano-technique-made-easy/soundslice-demo-image.jpg"
                        data-toggle="modal" data-target="#songSlice">
                    <div class="text-arrow">
                        <span>SEE HOW<br>IT WORKS</span><br> <img alt="" class="lazy arrow"
                                data-src="https://d2vyvo0tyx8ig5.cloudfront.net/sales/arrow-left-red.png">
                    </div>
                    <i class="fas fa-play"></i>
                </div>

                <p>Part of the reason technique is seen as such a difficult thing to practice is that it’s hard to know HOW to practice.
                    <br><br> Maybe you play a couple of scales at the start of your practice and think:
                    <br><br> “That’s my technique practice done.”
                    <br><br> And then you wonder why you’re not seeing better results from your practice.
                    <br><br> Piano Technique Made Easy will show you EXACTLY what to practice after every lesson.
                    <br><br> See for yourself.
                    <br><br> Try this exercise from Level 2. Adjust the tempo, work on your fingering, and follow along so you practice the RIGHT way.
                    <br><br> Because when you do that, the results will speak for themselves.</p>

            </div>
        </div>
    </section>
    <div class="modal fade text-center songslice" id="songSlice" tabindex="-1" role="dialog" aria-labelledby="trailerLabel">
        <i class="close fas fa-times" data-dismiss="modal" aria-label="Close"></i>
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="embed-responsive embed-responsive-4by3">
                    <iframe class="embed-responsive-item reset-on-close" src="" data-lazy-load-url="https://www.soundslice.com/scores/404032/embed/?api=1&amp;scroll_type=2&amp;branding=0" frameborder="0" allowfullscreen allow="autoplay"></iframe>
                </div>
            </div>
        </div>
    </div>
    <section class="benefits text-center">
        <div class="container">
            <h2><strong>Your hands <br class="hidden-sm hidden-md hidden-lg"> will thank you.</strong></h2>

            <div class="benefit-tile col-xs-12 col-sm-6">
                <i class="fal fa-piano-keyboard"></i>
                <p>
                    <strong>Step-By-Step Lessons</strong><br> Every lesson is presented in order, starting at the easiest level. You’ll only progress when you’re ready.
                </p>
            </div>

            <div class="benefit-tile col-xs-12 col-sm-6">
                <i class="fal fa-signal-alt"></i>
                <p>
                    <strong>All Skill Levels</strong><br> These lessons are perfect for all levels, from beginners wanting to master new keys to experienced players who need a refresher.
                </p>
            </div>

            <hr style="opacity: 0;margin:0;" class="col-xs-12 hidden-xs no-padding">
            <div class="benefit-tile col-xs-12 col-sm-6">
                <i class="fal fa-video"></i>
                <p>
                    <strong>Guided Video Lessons</strong><br> Learn at your own pace, whenever it suits you. Watch a lesson as many times as you need from your own home.
                </p>
            </div>

            <div class="benefit-tile col-xs-12 col-sm-6">
                <i class="fal fa-tachometer-alt"></i>
                <p>
                    <strong>More Effective Practice</strong><br> Don’t waste your practice time. Only work on the right exercises, at the right time. That guarantees the fastest results.
                </p>
            </div>

            <hr style="opacity: 0;margin:0;" class="col-xs-12 hidden-xs no-padding">
            <div class="benefit-tile col-xs-12 col-sm-6">
                <i class="fal fa-hands-helping"></i>
                <p>
                    <strong>Personalized Support</strong><br> Need help? No problem! Get all your questions answered by REAL teachers who are here to help you every step of the way.
                </p>
            </div>

            <div class="benefit-tile col-xs-12 col-sm-6">
                <i class="fal fa-infinity"></i>
                <p>
                    <strong>Lifetime Access</strong><br> The lessons are yours for life. They never expire and you can come back to them any time, as often as you like.
                </p>
            </div>
        </div>
    </section>
    <section class="student-testimonials text-center">
        <div class="container">
            <h2><strong>What students <br class="hidden-sm hidden-md hidden-lg"> are saying.</strong></h2>
            <div class="testimonials">
                @include('pianote.sales.partials._testimonial', [
                "heading" => "I could learn songs … much easier",
                "testimonial" => "I was unfamiliar with my scales and wanted to improve.<br><br>Piano Technique Made Easy was well laid out and thoughtful. I just needed to put in the work.<br><br>After starting, I noticed that I could learn songs in the keys I’ve practiced much easier, and it wasn’t tedious like before. It also helped me to doodle in case I forgot a few notes.<br><br>I’d recommend Piano Technique Made Easy because it will increase your familiarity with the piano and help you learn songs much faster.",
                "name" => "Wasif Farhan",
                "location" => "Dhaka, BANGLADESH",
                ])
                @include('pianote.sales.partials._testimonial', [
                "heading" => "I got the feeling I was actually improving…",
                "testimonial" => "Piano Technique Made Easy has taught me the fundamentals and helped me get to playing some of my original songs.<br><br>Soon after starting, I got the feeling that I was actually improving and accomplishing what I set out to do.<br><br>If anyone is motivated to learn the piano, Pano Technique Made Easy is probably the best way to do it.",
                "name" => "Dennis Inman",
                "location" => "Washington, USA",
                ])
                @include('pianote.sales.partials._testimonial', [
                "heading" => "I had a hard time trying to remember scales…",
                "testimonial" => "I had a hard time trying to remember scales. It is so much easier following the techniques on video, and it’s an excellent way of reinforcing memory.<br><br>Piano Technique Made Easy has helped to concentrate my learning. I enjoy a video demonstration that I can return to and find visual demo a good way to learn.<br><br>I REALLY enjoy the presentation of videos. They have a warm and encouraging teaching style. Well done!",
                "name" => "Chris Fay",
                "location" => "Southport, UNITED KINGDOM",
                ])
            </div>
        </div>
    </section>
    <section class="guarantee">
        <div class="container">
            <img class="lazy" data-src="https://d2vyvo0tyx8ig5.cloudfront.net/sales/guarantee-badge.png"
                    alt="90-Day Money-Back Guarantee">
            <h2><strong>The Best Results Guaranteed. <br> <span class="text-red">With NO Risk.</span></strong></h2>
            <p>Many courses offer a short guarantee - some only offer 14 days.
                <br><br> But you know it takes longer than that to figure out if something’s working. And a short guarantee only guarantees that you won’t be able to try EVERYTHING before deciding if it’s worth your hard-earned money.
                <br><br> That’s why you’ll have 90 days to try Piano Technique Made Easy.
                <br><br> That’s 3 full months to test the course, put in the work, and see the results. Then, and only then, do you have to decide if it’s worth it.
            </p>
        </div>
    </section>
    <section class="final text-center lazy" data-src="https://d2vyvo0tyx8ig5.cloudfront.net/shop/products/piano-technique-made-easy/order-background.jpg">
        <div class="container">
            <img class="logo lazy"
                    data-src="https://d2vyvo0tyx8ig5.cloudfront.net/shop/products/piano-technique-made-easy/logo.png">
            <h2>Master the fundamentals -- so you can <br> <strong>play anything you want on the piano.</strong></h2>
            {{--<a class="join" href="/piano-technique-made-easy/notify">Notify Me &raquo;</a>--}}
            <a
                href="{{ url()->route('shopping-cart.add-to-cart', ['products' => ['piano-technique-made-easy' => 1], 'redirect' => '/order', 'locked' => 'false']) }}"
                class="join vue-add-to-cart"
                data-product-json='{"piano-technique-made-easy": 1}'
            >Get Started &raquo;</a>
            <p class="breakdown">
                @if(PianotePrices::$PTMEFull > PianotePrices::$PTMERegular)
                    <s>NORMALLY ${{ PianotePrices::$PTMEFull }}.</s> &nbsp;
                    <strong><u>ONLY ${{ PianotePrices::$PTMERegular }}</u></strong>&nbsp; (SAVE {{ round(100 - (100 * (PianotePrices::$PTMERegular / PianotePrices::$PTMEFull))) }}%)
                @else
                    <strong><u>ONLY ${{ PianotePrices::$PTMERegular }}</u></strong>
                @endif
                <br><a href="/" class="red">(OR FREE WITH A PIANOTE MEMBERSHIP)</a><br> <strong
                        class="yellow">** 90-DAY GUARANTEE **</strong></p>

            <div class="credit-cards col-xs-12">
                <i class="fab fa-cc-visa"></i>
                <i class="fab fa-cc-mastercard"></i>
                <i class="fab fa-cc-discover"></i>
                <i class="fab fa-cc-amex"></i>
                <i class="fab fa-cc-paypal"></i>
                <br> <br>
            </div>
            <div class="col-xs-12 questions">
                <p><strong>Any questions?</strong><br class="hidden-lg hidden-md hidden-sm"> Call us toll-free at <a
                            href="tel:+18004398921">1-800-439-8921</a> <br
                            class="hidden-lg hidden-md hidden-sm"> or directly at <a
                            href="tel:+16048557605">1-604-855-7605</a>.<br> All prices listed in USD. </p>
            </div>
        </div>
    </section>

    @include('pianote._partials._footer')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/jquery.lazy/1.7.9/jquery.lazy.min.js"></script>
    <script type="text/javascript" src="/marketing/parcel/pianote/nav-footer.js"></script>
    <script type="text/javascript" src="/marketing/js/modal-autoplay-bootstrap.js"></script>
    <script>
        $(document).ready(function () {
            $('.lazy').Lazy({
                threshold: 600
            });

            var stickyBook = $(".five-skills .sticky-pic");
            $(window).scroll(function () {
                var stickToTop = $(".sticky-trigger").offset().top - 60;
                var unstick = $(".unstick-trigger").offset().top;
                if ($(this).scrollTop() > (stickToTop) && $(this).scrollTop() < (unstick)) {
                    stickyBook.addClass('active');
                } else {
                    stickyBook.removeClass('active');
                }
            });

            //sub nav sticky function
            var navigation = $(".subnav");
            var navigationLinks = $(".topic-link");

            $(window).scroll(function () {
                var header = $(".subnav-shim").offset().top;
                var knowledge = $('#knowledge').offset().top - 50;
                var scales = $('#scales').offset().top - 150;
                var chords = $('#chords').offset().top - 150;
                var arpeggios = $('#arpeggios').offset().top - 150;
                var songs = $('#songs').offset().top - 150;
                var scaleThumbs = $('.every-scale').offset().top - 150;

                if ($(this).scrollTop() > (header - 50)) {
                    navigation.addClass('stick-to-top');
                    navigationLinks.removeClass('active');
                    $(".topic-link.features").addClass('active');
                } else {
                    navigationLinks.removeClass('active');
                    navigation.removeClass('stick-to-top');
                }

                if ($(this).scrollTop() > knowledge && $(this).scrollTop() < scales) {
                    navigationLinks.removeClass('active');
                    $(".topic-link.knowledge").addClass('active');
                }

                if ($(this).scrollTop() > scales && $(this).scrollTop() < chords) {
                    navigationLinks.removeClass('active');
                    $(".topic-link.scales").addClass('active');
                }

                if ($(this).scrollTop() > chords && $(this).scrollTop() < arpeggios) {
                    navigationLinks.removeClass('active');
                    $(".topic-link.chords").addClass('active');
                }

                if ($(this).scrollTop() > arpeggios && $(this).scrollTop() < songs) {
                    navigationLinks.removeClass('active');
                    $(".topic-link.arpeggios").addClass('active');
                }

                if ($(this).scrollTop() > songs && $(this).scrollTop() < scaleThumbs) {
                    navigationLinks.removeClass('active');
                    $(".topic-link.songs").addClass('active');
                }

                if ($(this).scrollTop() > scaleThumbs) {
                    navigationLinks.removeClass('active');
                    navigation.removeClass('stick-to-top');
                }
            });

        });
    </script>
    <script src="{{ asset('marketing/js/pianote/manifest.js') }}"></script>
    <script src="{{ asset('marketing/js/pianote/vendor.js') }}"></script>
    <script src="{{ asset('marketing/js/pianote/cart-sidebar.js') }}"></script>
    <script src="{{ asset('marketing/js/pianote/app.js') }}"></script>

    @include('pianote._partials._promo-countdown')
    @include('pianote._partials.inspectlet')
@stop
