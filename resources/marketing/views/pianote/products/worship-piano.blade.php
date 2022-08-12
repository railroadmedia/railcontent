@extends('pianote._partials.layout')

@section('head-includes')
    <title>Worship Piano - How To Play Piano In Church | Pianote</title>
    <meta name="description" content="Start playing piano or keyboard in your church.">

    <meta property="og:image" content="https://d2vyvo0tyx8ig5.cloudfront.net/products/worship-piano/og-image.jpg" style="display: none;">
    <meta property="og:title" content="Worship Piano - How To Play Piano In Church">
    <meta property="og:description" content="Start playing piano or keyboard in your church.">
    <meta property="og:url" content="https://www.pianote.com/worship-piano">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.4.1/css/bootstrap.min.css">
    <link href="{{ asset('/assets/marketing/nav-footer.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="/assets/marketing/worship-piano.css">
@stop

@section('layout-body')
    @include('sales.nav', [
        "cartVersion" => true
    ])
    @include('shop.partials._promo-banner', [
                    "name" => "Worship Piano",
                    "fullPrice" => App\Prices::$worshipPianoFull,
                    "price" => App\Prices::$worshipPianoRegular,
                    "noBreadcrumb" => true
                ])

    <header class="header text-center">
        <div class="container">
            <img class="logo" src="https://d2vyvo0tyx8ig5.cloudfront.net/products/worship-piano/logo-text-white.png"><br>
            <div class="video-wrap autoplay-video" data-toggle="modal" data-target="#trailer">
                <i class="fas fa-play"></i>
                <div class="embed-responsive embed-responsive-16by9">
                    <img src="https://d2vyvo0tyx8ig5.cloudfront.net/products/worship-piano/header-video.jpg">
                </div>
            </div>
            <h2>Start playing piano or <br class="hidden-sm hidden-md hidden-lg"> keyboard in your church.</h2>
            <a
                class="join vue-add-to-cart"
                href="{{ url()->route('shopping-cart.add-to-cart', ['products' => ['worship-piano' => 1], 'redirect' => '/order', 'locked' => 'false']) }}"
                data-product-json='{"worship-piano": 1}'
            >Get Started &raquo;</a>

            <p class="breakdown">
                @if(App\Prices::$worshipPianoFull > App\Prices::$worshipPianoRegular)
                    <s>NORMALLY ${{ App\Prices::$worshipPianoFull }}.</s> &nbsp;
                    <strong><u>ONLY ${{ App\Prices::$worshipPianoRegular }}</u></strong>&nbsp; (SAVE {{ round(100 - (100 * (App\Prices::$worshipPianoRegular / App\Prices::$worshipPianoFull))) }}%)
                @else
                    <strong><u>ONLY ${{ App\Prices::$worshipPianoRegular }}</u></strong>
                @endif
                <br><a href="/" class="red">(OR FREE WITH A PIANOTE MEMBERSHIP)</a><br> <strong
                        class="yellow">** 90-DAY GUARANTEE **</strong></p>
        </div>
    </header>
    <div class="modal fade text-center" id="trailer" tabindex="-1" role="dialog" aria-labelledby="lesson1">
        <i class="close stop-play fas fa-times" data-dismiss="modal" aria-label="Close"></i>
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="embed-responsive embed-responsive-16by9">
                    <iframe class="embed-responsive-item reset-on-close" src=""
                            data-lazy-load-url="//player.vimeo.com/video/443097037?autoplay=1"
                            frameborder="0"
                            allowfullscreen
                            allow="autoplay"></iframe>
                </div>
            </div>
        </div>
    </div>

    <section class="more-songs">
        <div class="container">
            <h2 class="text-center"><strong>Play modern worship songs and serve your church</strong></h2>
            <img src="https://d2vyvo0tyx8ig5.cloudfront.net/products/worship-piano/lisa-amberly-1.png">
            <p>The piano (and keyboard) is the glue that holds worship bands together. From song introductions and transitions to backing music during prayer and altar calls, the piano sets the tone and space inside church.
                <br><br> The needs of a church pianist are unique - there isn’t really any other environment like it. That means the skills are unique. This training pack has been specially designed for worship piano inside a church setting.
                <br><br> If you’ve been wanting to learn the piano to help serve your church but didn’t know how -- this training pack will equip you to start playing and serving in the shortest time possible.</p>
        </div>
    </section>

    <section class="thumb-grid text-center">
        <div class="container">
            <h2><strong>Equip yourself with this
                    <br class="hidden-sm hidden-md hidden-lg"> 10-lesson training pack</strong></h2>
            <p>Click a lesson to see a short preview!</p>

            <div class="image-grid-item col-xs-12 col-sm-6">
                <div class="section-thumbnail autoplay-video lazy" data-toggle="modal" data-target="#lesson1" data-src="https://d2vyvo0tyx8ig5.cloudfront.net/products/worship-piano/thumb-welcome-to-the-piano.jpg">
<i class="fas fa-play"></i>
                    <h2>Welcome To The Piano</h2>
                </div>
                <p><strong class="text-red">Your first piano lesson.</strong><br>
                This is for total beginners. Even if you’ve NEVER touched a piano before. You’ll learn the keys, note names, and how to feel comfortable at the piano. You don’t need any prior knowledge or experience.</p>
                <div class="modal fade text-center" id="lesson1" tabindex="-1" role="dialog" aria-labelledby="lesson1">
                    <i class="close stop-play fas fa-times" data-dismiss="modal" aria-label="Close"></i>
                    <div class="modal-dialog modal-lg" role="document">
                        <div class="modal-content">
                            <div class="embed-responsive embed-responsive-16by9">
                                <iframe class="embed-responsive-item reset-on-close" src=""
                                        data-lazy-load-url="//player.vimeo.com/video/442469006?autoplay=1"
                                        frameborder="0"
                                        allowfullscreen
                                        allow="autoplay"></iframe>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="image-grid-item col-xs-12 col-sm-6">
                <div class="section-thumbnail autoplay-video lazy" data-toggle="modal" data-target="#lesson2" data-src="https://d2vyvo0tyx8ig5.cloudfront.net/products/worship-piano/thumb-chording-101.jpg">
<i class="fas fa-play"></i>
                    <h2>Chording 101</h2>
                </div>
                <p><strong class="text-red">Everything you need to know to play chords.</strong><br>
                Learn how to play major and minor chords on any key of the piano. From this ONE lesson, you’ll have the basic skills to start playing worship songs PLUS you’ll get a downloadable cheat sheet of all the major and minor chords.</p>
                <div class="modal fade text-center" id="lesson2" tabindex="-1" role="dialog" aria-labelledby="lesson2">
                    <i class="close stop-play fas fa-times" data-dismiss="modal" aria-label="Close"></i>
                    <div class="modal-dialog modal-lg" role="document">
                        <div class="modal-content">
                            <div class="embed-responsive embed-responsive-16by9">
                                <iframe class="embed-responsive-item reset-on-close" src=""
                                        data-lazy-load-url="//player.vimeo.com/video/442468928?autoplay=1"
                                        frameborder="0"
                                        allowfullscreen
                                        allow="autoplay"></iframe>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

            <hr style="opacity: 0;margin:0;" class="col-xs-12 hidden-xs no-padding">
            <div class="image-grid-item col-xs-12 col-sm-6">
                <div class="section-thumbnail autoplay-video lazy" data-toggle="modal" data-target="#lesson3" data-src="https://d2vyvo0tyx8ig5.cloudfront.net/products/worship-piano/thumb-reading-chord-charts.jpg">
<i class="fas fa-play"></i>
                    <h2>How To Read<br>Worship Chord Charts</h2>
                </div>
                <p><strong class="text-red">So you can start playing today.</strong><br>
                Worship music uses chord charts (not sheet music). You’ll learn how to read worship charts that are used in church. Learn what all the symbols mean and how to match the chords to lyrics.</p>
                <div class="modal fade text-center" id="lesson3" tabindex="-1" role="dialog" aria-labelledby="lesson3">
                    <i class="close stop-play fas fa-times" data-dismiss="modal" aria-label="Close"></i>
                    <div class="modal-dialog modal-lg" role="document">
                        <div class="modal-content">
                            <div class="embed-responsive embed-responsive-16by9">
                                <iframe class="embed-responsive-item reset-on-close" src=""
                                        data-lazy-load-url="//player.vimeo.com/video/442468846?autoplay=1"
                                        frameborder="0"
                                        allowfullscreen
                                        allow="autoplay"></iframe>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

            <div class="image-grid-item col-xs-12 col-sm-6">
                <div class="section-thumbnail autoplay-video lazy" data-toggle="modal" data-target="#lesson4" data-src="https://d2vyvo0tyx8ig5.cloudfront.net/products/worship-piano/thumb-advanced-chords.jpg">
<i class="fas fa-play"></i>
                    <h2>Advanced Chords</h2>
                </div>
                <p><strong class="text-red">Start sounding better.</strong><br>
                    We’ll break down ALL the types of chords you’ll see in worship music in a way that’s simple and fun to understand, using real worship songs as examples. Learn the “cheats” and tips to make practicing (and performing) much easier.</p>
                <div class="modal fade text-center" id="lesson4" tabindex="-1" role="dialog" aria-labelledby="lesson4">
                    <i class="close stop-play fas fa-times" data-dismiss="modal" aria-label="Close"></i>
                    <div class="modal-dialog modal-lg" role="document">
                        <div class="modal-content">
                            <div class="embed-responsive embed-responsive-16by9">
                                <iframe class="embed-responsive-item reset-on-close" src=""
                                        data-lazy-load-url="//player.vimeo.com/video/442468966?autoplay=1"
                                        frameborder="0"
                                        allowfullscreen
                                        allow="autoplay"></iframe>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

            <hr style="opacity: 0;margin:0;" class="col-xs-12 hidden-xs no-padding">
            <div class="image-grid-item col-xs-12 col-sm-6">
                <div class="section-thumbnail autoplay-video lazy" data-toggle="modal" data-target="#lesson5" data-src="https://d2vyvo0tyx8ig5.cloudfront.net/products/worship-piano/thumb-inversions.jpg">
<i class="fas fa-play"></i>
                    <h2>Chord Inversions</h2>
                </div>
                <p><strong class="text-red">The secret to sounding professional.</strong><br>
                Basic chords are fine, but chord inversions will change the way you think about music (for the better!). You’ll sound more professional, play faster, and be more confident. Inversions will make the biggest difference in your playing.</p>
                <div class="modal fade text-center" id="lesson5" tabindex="-1" role="dialog" aria-labelledby="lesson5">
                    <i class="close stop-play fas fa-times" data-dismiss="modal" aria-label="Close"></i>
                    <div class="modal-dialog modal-lg" role="document">
                        <div class="modal-content">
                            <div class="embed-responsive embed-responsive-16by9">
                                <iframe class="embed-responsive-item reset-on-close" src=""
                                        data-lazy-load-url="//player.vimeo.com/video/442468895?autoplay=1"
                                        frameborder="0"
                                        allowfullscreen
                                        allow="autoplay"></iframe>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

            <div class="image-grid-item col-xs-12 col-sm-6">
                <div class="section-thumbnail autoplay-video lazy" data-toggle="modal" data-target="#lesson6" data-src="https://d2vyvo0tyx8ig5.cloudfront.net/products/worship-piano/thumb-riffs-fills.jpg">
<i class="fas fa-play"></i>
                    <h2>Riffs & Fills</h2>
                </div>
                <p><strong class="text-red">Fill space and add emotion.</strong><br>
                Adding little riffs and fills can take a simple chord progression and transform it into something emotional. It’s a chance for you to express your heart and creativity. Learn some of my favorite fills that are easy to play, but sound much more complicated.</p>
                <div class="modal fade text-center" id="lesson6" tabindex="-1" role="dialog" aria-labelledby="lesson6">
                    <i class="close stop-play fas fa-times" data-dismiss="modal" aria-label="Close"></i>
                    <div class="modal-dialog modal-lg" role="document">
                        <div class="modal-content">
                            <div class="embed-responsive embed-responsive-16by9">
                                <iframe class="embed-responsive-item reset-on-close" src=""
                                        data-lazy-load-url="//player.vimeo.com/video/442469046?autoplay=1"
                                        frameborder="0"
                                        allowfullscreen
                                        allow="autoplay"></iframe>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

            <hr style="opacity: 0;margin:0;" class="col-xs-12 hidden-xs no-padding">
            <div class="image-grid-item col-xs-12 col-sm-6">
                <div class="section-thumbnail autoplay-video lazy" data-toggle="modal" data-target="#lesson7" data-src="https://d2vyvo0tyx8ig5.cloudfront.net/products/worship-piano/thumb-not-alone.jpg">
<i class="fas fa-play"></i>
                    <h2>You’re Not Alone</h2>
                </div>
                <p><strong class="text-red">How to play with other musicians.</strong><br>
                A worship band is a dynamic thing, and it’s important to know how to fill your role. You’ll learn how to play in a band, including how to prepare and act during rehearsals. Most importantly, you’ll learn what NOT to play when there are other musicians on stage.</p>
                <div class="modal fade text-center" id="lesson7" tabindex="-1" role="dialog" aria-labelledby="lesson7">
                    <i class="close stop-play fas fa-times" data-dismiss="modal" aria-label="Close"></i>
                    <div class="modal-dialog modal-lg" role="document">
                        <div class="modal-content">
                            <div class="embed-responsive embed-responsive-16by9">
                                <iframe class="embed-responsive-item reset-on-close" src=""
                                        data-lazy-load-url="//player.vimeo.com/video/442469027?autoplay=1"
                                        frameborder="0"
                                        allowfullscreen
                                        allow="autoplay"></iframe>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

            <div class="image-grid-item col-xs-12 col-sm-6">
                <div class="section-thumbnail autoplay-video lazy" data-toggle="modal" data-target="#lesson8" data-src="https://d2vyvo0tyx8ig5.cloudfront.net/products/worship-piano/thumb-sound-design.jpg">
<i class="fas fa-play"></i>
                    <h2>Sound Design</h2>
                </div>
                <p><strong class="text-red">How to create that “worship piano sound”.</strong><br>
                How do you make your piano or keyboard sound beautiful? Whatever instrument you’re using, you’ll learn how to create that “worship piano sound” using piano and pads.</p>
                <div class="modal fade text-center" id="lesson8" tabindex="-1" role="dialog" aria-labelledby="lesson8">
                    <i class="close stop-play fas fa-times" data-dismiss="modal" aria-label="Close"></i>
                    <div class="modal-dialog modal-lg" role="document">
                        <div class="modal-content">
                            <div class="embed-responsive embed-responsive-16by9">
                                <iframe class="embed-responsive-item reset-on-close" src=""
                                        data-lazy-load-url="//player.vimeo.com/video/442469065?autoplay=1"
                                        frameborder="0"
                                        allowfullscreen
                                        allow="autoplay"></iframe>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

            <hr style="opacity: 0;margin:0;" class="col-xs-12 hidden-xs no-padding">
            <div class="image-grid-item col-xs-12 col-sm-6">
                <div class="section-thumbnail autoplay-video lazy" data-toggle="modal" data-target="#lesson9" data-src="https://d2vyvo0tyx8ig5.cloudfront.net/products/worship-piano/thumb-background-music.jpg">
<i class="fas fa-play"></i>
                    <h2>Background Music</h2>
                </div>
                <p><strong class="text-red">What to play under prayer and for an altar call.</strong><br>
                Learn chord progressions and patterns that sound beautiful in the still moments. Whether it’s during prayer or even an altar call, you’ll have the skills to adapt to the situation and create a beautiful, welcoming atmosphere.</p>
                <div class="modal fade text-center" id="lesson9" tabindex="-1" role="dialog" aria-labelledby="lesson9">
                    <i class="close stop-play fas fa-times" data-dismiss="modal" aria-label="Close"></i>
                    <div class="modal-dialog modal-lg" role="document">
                        <div class="modal-content">
                            <div class="embed-responsive embed-responsive-16by9">
                                <iframe class="embed-responsive-item reset-on-close" src=""
                                        data-lazy-load-url="//player.vimeo.com/video/442468816?autoplay=1"
                                        frameborder="0"
                                        allowfullscreen
                                        allow="autoplay"></iframe>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

            <div class="image-grid-item col-xs-12 col-sm-6">
                <div class="section-thumbnail autoplay-video lazy" data-toggle="modal" data-target="#lesson10" data-src="https://d2vyvo0tyx8ig5.cloudfront.net/products/worship-piano/thumb-seamless-transitions.jpg">
<i class="fas fa-play"></i>
                    <h2>Seamless Transitions</h2>
                </div>
                <p><strong class="text-red">How to play intros, outros, and shift between songs.</strong><br>
                The greatest advantage of the piano (or keyboard) is its ability to help transition between songs. You’ll learn the simple ways to start and end songs, plus how to change between different key signatures and even tempos.</p>
                <div class="modal fade text-center" id="lesson10" tabindex="-1" role="dialog" aria-labelledby="lesson10">
                    <i class="close stop-play fas fa-times" data-dismiss="modal" aria-label="Close"></i>
                    <div class="modal-dialog modal-lg" role="document">
                        <div class="modal-content">
                            <div class="embed-responsive embed-responsive-16by9">
                                <iframe class="embed-responsive-item reset-on-close" src=""
                                        data-lazy-load-url="//player.vimeo.com/video/442469164?autoplay=1"
                                        frameborder="0"
                                        allowfullscreen
                                        allow="autoplay"></iframe>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="two-video-example text-center lazy" data-src="https://d2vyvo0tyx8ig5.cloudfront.net/products/worship-piano/church-stage-background.jpg">
        <div class="container">
            <h2><strong>Know you’re good enough --<br>
                    BEFORE you ever step on stage</strong></h2>
            <p>Playing at church can be intimidating and scary. Even if you’ve played piano before.
                <br><br>Worship Piano takes the fear out of knowing if you’re good enough. That’s because you’ll be able to practice along with YOUR OWN worship band. Play along and get comfortable with other musicians, in your own home. Take a look:</p>
            <div class="thumb col-xs-12 col-sm-6">
                <div class="vid-wrap">
                    <video class="example-video" controls preload="none"
                            src="https://player.vimeo.com/external/442827900.sd.mp4?s=224c4bb67c8fa94554e878f72c7d495775a8b649&profile_id=164"
                            poster="https://i.vimeocdn.com/video/932006811-0be408e63c8872986adfdb1120a4e98a224442d5e7d31dede225098e950e4233-d_600">
                    </video>
                </div>
                <p><strong>Full Band Performance</strong><br>
                    Here’s a short sample of ONE of the backing songs that’s included with Worship Piano. This is the full band.</p>
            </div>

            <div class="thumb col-xs-12 col-sm-6 active">
                <div class="vid-wrap">
                    <video class="example-video" controls preload="none"
                            src="https://player.vimeo.com/external/442827899.sd.mp4?s=41ccce1ddea0d83357fd09ac676457b7b7039ca6&profile_id=164"
                            poster="https://i.vimeocdn.com/video/932005793-bece583a96871a47121763b0933690e04d4a3e46289db0798df2c858060c56c5-d_600">
                    </video>
                </div>
                <p><strong>Full Band Without Piano</strong><br>
                    Here’s the same song with the piano removed. This allows YOU to join the band and feel comfortable.</p>
            </div>

        </div>
    </section>

    <div id="songs" class="anchor"></div>
    <section class="chord-charts">
        <div class="container">
            <img class="yellow-red-icons lazy" data-src="https://d2vyvo0tyx8ig5.cloudfront.net/products/worship-piano/songs-icons.png">
            <h2><strong>100 modern worship chord charts to get you started</strong></h2>
            <p>This training pack is all about playing worship songs, so you’ll get 100 of the most popular worship chord charts that you can practice at home.
                <br><br>
                To see an example of a chord chart click here: <a style="display:inline-block;" target="_blank" href="https://pianote.s3.us-east-1.amazonaws.com/worship-piano/good-good-father.pdf"><u>Open PDF &raquo;</u></a>
                <br><br>
                Practicing is the best way to get better and feel more confident and comfortable.
                <br><br>
                And these charts will allow you to practice and perfect the songs you’ll be playing in church, so you’ll be ready and prepared to play in church sooner.
                <br><br>
                Want to take a look? Here’s the entire list:
            </p>
            @hasSection('albums-url')
                <img class="album-banner" src="@yield('albums-url')">
            @endif
            <div class="song-list">
                @include('products._worship-songs')
            </div>
            <div class="text-center">
                <a id="uncoverAll" class="join outline">Show All</a>
            </div>
        </div>
    </section>

    <section class="play-songs text-center">
        <div class="container">
            <h2><strong>Fast results -- so you can<br class="hidden-sm hidden-md hidden-lg"> start playing right away</strong></h2>
            <p>Modern worship music is not complicated. It’s not designed to be. After all, the goal is not “showing-off” or being flashy, it’s about helping people connect with God during times of worship.
                <br><br>
                Because of its beautiful simplicity, it’s easy to learn and start playing in church sooner. This won’t take you weeks or months to be ready. In fact, you might find yourself wanting to play within a few days of starting.</p>

            <div class="benefit-tile col-xs-12 col-sm-6">
                <i class="fal fa-piano-keyboard"></i>
                <p>
                    <strong>no guesswork</strong><br> You’ll never be left guessing because every lesson is structured to teach you the right skills at the right time.
                </p>
            </div>

            <div class="benefit-tile col-xs-12 col-sm-6">
                <i class="fal fa-check"></i>
                <p>
                    <strong>perfect for all levels</strong><br> Even if you’ve never touched a piano before, you’ll learn the skills to play in church.
                </p>
            </div>

            <hr style="opacity: 0;margin:0;" class="col-xs-12 hidden-xs no-padding">
            <div class="benefit-tile col-xs-12 col-sm-6">
                <i class="fal fa-music"></i>
                <p>
                    <strong>play real worship songs</strong><br> You’ll be learning with REAL modern worship songs that are currently used in church.
                </p>
            </div>

            <div class="benefit-tile col-xs-12 col-sm-6">
                <i class="fal fa-download"></i>
                <p>
                    <strong>downloadable resources</strong><br> Helpful guides to download, print, and keep by the piano. Never forget what you’ve learned.
                </p>
            </div>

            <hr style="opacity: 0;margin:0;" class="col-xs-12 hidden-xs no-padding">
            <div class="benefit-tile col-xs-12 col-sm-6">
                <i class="fal fa-guitars"></i>
                <p>
                    <strong>your own worship band</strong><br> Practice along to the backing tracks and BE part of a worship band before ever stepping on stage.
                </p>
            </div>

            <div class="benefit-tile col-xs-12 col-sm-6">
                <i class="fal fa-hands-helping"></i>
                <p>
                    <strong>support from real teachers</strong><br> Ask your biggest questions and get personalized feedback from teachers.
                </p>
            </div>

            <hr style="opacity: 0;margin:0;" class="col-xs-12 hidden-xs no-padding">
            <div class="benefit-tile col-xs-12 col-sm-6">
                <i class="fal fa-users"></i>
                <p>
                    <strong>the best online community</strong><br> Meet other church piano players, share your experiences, struggles, and successes with other students.
                </p>
            </div>

            <div class="benefit-tile col-xs-12 col-sm-6">
                <i class="fal fa-infinity"></i>
                <p>
                    <strong>yours forever</strong><br> These lessons NEVER expire. Watch them again, and again, and again… (you get the point).
                </p>
            </div>
        </div>
    </section>

    <section class="personal-teacher text-center lazy" data-src="https://d2vyvo0tyx8ig5.cloudfront.net/products/worship-piano/lisa-amberly-about.jpg">
        <div class="container">
            <h2><strong>Meet your teachers</strong></h2>
            <div class="col-xs-12 col-sm-6">
                <p><strong class="text-red">FROM AMBERLY:</strong>
                    <br><br>
                    I’ve been a Worship Pastor at my local church for the past 4 years, having previously been a finalist on Canadian Idol.
                    <br><br>
                    As a Worship Pastor, I’m passionate about equipping musicians and worshippers with the ability to feel confident and comfortable in a team setting, no matter their experience or skill level.
                    <br><br>
                    Imperfections are ok! We all have them, and we’re all on the same journey to become better together.
                    <br><br>
                    At the end of the day, playing music at church is about worshipping God and not our individual ability or talent (1 Cor 10:31).
                    <br><br>
                    The most important thing is to HAVE FUN!
                    <br><br>
                    I’m so excited to help you develop your passion and desire to serve your church.
                    <br><br>
                    <img class="avatar lazy" data-src="https://d2vyvo0tyx8ig5.cloudfront.net/products/worship-piano/amberly-martz.jpg">
                    <img class="lazy" data-src="https://d2vyvo0tyx8ig5.cloudfront.net/products/worship-piano/amberly-signature.png">
                </p>
            </div>
            <div class="col-xs-12 col-sm-6">
                <p><strong class="text-red">FROM LISA:</strong>
                    <br><br>
                    I was classically trained in piano from a young age.
                    <br><br>
                    It wasn’t until I was about 13 years old and my church started a youth band that I learned that you could play songs WITHOUT having to read every single note on a page.
                    <br><br>
                    It started when my youth leader pointed at me and said, “You can play the piano, so you’re going to be our piano player.”
                    <br><br>
                    I was like HUH?!
                    <br><br>
                    He handed me a chord chart and said, “When you see the chord, play the chord.”
                    <br><br>
                    And the rest is history! Now I’m going to give you a LOT more instruction than I got at that time, but the point I’m trying to make is that playing in a church setting, using chord charts is actually really really attainable both for trained piano players AND newbies.
                    <br><br>
                    It’s not something to fear, and it becomes a huge blessing for you and your church.
                    <br><br>
                    And I would be so excited and honored to be a part of that journey for you.
                    <br><br>
                    <img class="avatar lazy" data-src="https://d2vyvo0tyx8ig5.cloudfront.net/products/worship-piano/lisa-witt.jpg">
                    <img class="lazy" src="https://d2vyvo0tyx8ig5.cloudfront.net/shop/products/piano-riffs-and-fills/lisa-witt-signature.png">
                </p>
            </div>
        </div>
    </section>

    <section class="guarantee">
        <div class="container">
            <img class="lazy" data-src="https://d2vyvo0tyx8ig5.cloudfront.net/sales/guarantee-badge.png" alt="90-Day Money-Back Guarantee">
            <h2><strong>90-Day Money-Back Guarantee</strong></h2>
            <p>We love our students. More than anything, we want you to enjoy a super-positive experience playing piano and come away from this feeling happy, equipped, and ready to serve your church. And that means we only want you to pay if you actually LOVE your piano lessons! So join below to try it out totally risk-free. If it’s not for you, simply cancel your membership within 90 days and contact support for a full refund.</p>
        </div>
    </section>

    <section class="final text-center lazy" data-src="https://d2vyvo0tyx8ig5.cloudfront.net/products/worship-piano/order-section-background.jpg">
        <div class="container">
            <img class="logo lazy" data-src="https://d2vyvo0tyx8ig5.cloudfront.net/products/worship-piano/logo-text-white.png">
            <h2>Start playing piano or<br class="hidden-sm hidden-md hidden-lg"> keyboard in your church.</h2>
            <a
                href="{{ url()->route('shopping-cart.add-to-cart', ['products' => ['worship-piano' => 1], 'redirect' => '/order', 'locked' => 'false']) }}"
                class="join vue-add-to-cart"
                data-product-json='{"worship-piano": 1}'
            >Get Started &raquo;</a>
            <p class="breakdown">
                @if(App\Prices::$worshipPianoFull > App\Prices::$worshipPianoRegular)
                    <s>NORMALLY ${{ App\Prices::$worshipPianoFull }}.</s> &nbsp;
                    <strong><u>ONLY ${{ App\Prices::$worshipPianoRegular }}</u></strong>&nbsp; (SAVE {{ round(100 - (100 * (App\Prices::$worshipPianoRegular / App\Prices::$worshipPianoFull))) }}%)
                @else
                    <strong><u>ONLY ${{ App\Prices::$worshipPianoRegular }}</u></strong>
                @endif
                <br><a href="/" class="red">(OR FREE WITH A PIANOTE MEMBERSHIP)</a><br> <strong
                        class="yellow">** 90-DAY GUARANTEE **</strong></p>

            <div class="credit-cards col-xs-12">
                <i class="fab fa-cc-visa"></i>
                <i class="fab fa-cc-mastercard"></i>
                <i class="fab fa-cc-discover"></i>
                <i class="fab fa-cc-amex"></i>
                <i class="fab fa-cc-paypal"></i>
                <br>
                <br>
            </div>
            <div class="col-xs-12 questions">
                <p><strong>Any questions?</strong><br class="hidden-lg hidden-md hidden-sm"> Call us toll-free at <a
                            href="tel:+18004398921">1-800-439-8921</a> <br
                            class="hidden-lg hidden-md hidden-sm"> or directly at <a
                            href="tel:+16048557605">1-604-855-7605</a>.<br> All prices listed in USD. </p>
            </div>
        </div>
    </section>

    @include('sales.footer')

@stop

@section('layout-scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/jquery.lazy/1.7.9/jquery.lazy.min.js"></script>
    <script type="text/javascript" src="/assets/marketing/nav-footer.js"></script>
    <script type="text/javascript" src="/assets/js/modal-autoplay.js"></script>
    <script>
        $(document).ready(function () {
            $('.lazy').Lazy({
                threshold: 600
            });

            $('#uncoverAll').on('click', function (e) {
                e.stopPropagation();
                e.preventDefault();
                $('.song-list').addClass('show-all');
                $(this).addClass('hide');
            });

            $(".example-video").on('play', function () {
                $(".example-video").not(this).trigger('pause');
                $('.thumb').removeClass('active');
                $(this).parents('.thumb').addClass('active');
            });
        });
    </script>
    <script src="{{ mix('assets/members/js/manifest.js') }}"></script>
    <script src="{{ mix('assets/members/js/vendor.js') }}"></script>
    <script src="{{ mix('assets/members/js/cart-sidebar.js') }}"></script>
    <script src="{{ mix('assets/members/js/app.js') }}"></script>

    @include('shop.partials._promo-countdown')
    {!! inspectlet_embed_script() !!}
@stop
