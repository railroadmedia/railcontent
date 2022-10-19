@extends('drumeo.products.misc-products-layout')

@section('meta')
    <title>The Drummer’s Toolbox</title>
    <meta name="description" content="The Drummer’s Toolbox presents drummers of all skill levels with the most comprehensive introduction to 101 drumming styles from the past century.">

    <!-- Social Media -->
    <meta property="og:image" content="https://dpwjbsxqtam5n.cloudfront.net/books/drummers-toolbox/sales/og-image.jpg" style="display: none;">
    <meta property="og:title" content="The Drummer’s Toolbox">
    <meta property="og:description" content="The Drummer’s Toolbox presents drummers of all skill levels with the most comprehensive introduction to 101 drumming styles from the past century.">
    <meta property="og:url" content="https://www.drumeo.com/{{ Request::path() }}">
@stop

@section('head')
    <link href="https://fonts.googleapis.com/css?family=Oswald:500" rel="stylesheet">
    <link href="{{ asset('/assets/members-area/css/gulp/beginner-book.css') }}" rel="stylesheet">
@stop

@section('content')
    @if(strpos(url()->full(), 'thankyou'))
        <div class="thank-you-banner text-center">
            <p><strong>Thanks for contacting us!</strong><br>
                We'll respond to you soon! If you haven't heard back in the next week, please <a class="text-white" href="/support">contact us</a>.</p>
        </div>
    @endif
    @if(strpos(url()->full(), 'error'))
        <div class="thank-you-banner text-center">
            <p><strong>Oops!</strong><br>
                Please go back and make sure you check the security CAPTCHA box.<br>
                <a class="bulk-order anchor-slide" href="#bulk-order-anchor">click here</a></p>
        </div>
    @endif

    @include('drumeo.products.partials.promo-banner', [
                    "name" => "The Drummer's Toolbox",
                    "fullPrice" => Prices::$toolboxBookFull,
                    "price" => Prices::$toolboxBookRegular,
                "noBreadcrumb" => true
                ])
    <header class="book-header toolbox text-center">
        <div class="noise-wrap">
            <div class="row">
                <img class="logo" src="https://dpwjbsxqtam5n.cloudfront.net/books/drummers-toolbox/sales/logo.png">
                <p>The Ultimate Guide To Learning 100 <img class="plus-one" width="20px" src="https://dpwjbsxqtam5n.cloudfront.net/books/drummers-toolbox/sales/plus-one.svg"> Drumming Styles </p>
                <img class="sticky-book" src="https://dpwjbsxqtam5n.cloudfront.net/books/drummers-toolbox/sales/book-angled.png">
            </div>
        </div>
    </header>
    <section class="order-buttons text-center">
        <div class="row">
            @if( Prices::$toolboxBookFull > Prices::$toolboxBookRegular)
                <p><s>WAS ${{ Prices::$toolboxBookFull }}</s> &nbsp;<strong>NOW ${{ Prices::$toolboxBookRegular }}</strong>&nbsp; (SAVE ${{ (Prices::$toolboxBookFull - Prices::$toolboxBookRegular) }}).
                    {{--<br>SAVE ${{ (Prices::$toolboxBookFull - Prices::$toolboxBookRegular) }} UNTIL MAY 19TH<br>--}}
                    {{--<strong class="text-blue">ONLY <span class="tzcd-med">A LIMITED TIME</span> LEFT</strong>--}}
                </p>
            @else
                <p><strong>ONLY ${{ Prices::$toolboxBookRegular }}</strong></p>
            @endif
            <a class="join rounded" href="{{ URL::Route('shopping-cart.to-cart.api') }}?products[the-drummers-toolbox-book]=1">GET STARTED &raquo;</a>

            {{--<a class="join blue outline rounded" href="/">GET FREE WITH <img src="https://dpwjbsxqtam5n.cloudfront.net/logos/logo-blue.png"> &raquo;</a>--}}
                <p>OR BUY FROM YOUR FAVORITE ONLINE STORES:<br class="hide-for-medium"> <a class="text-blue" target="_blank" href="https://www.amazon.com/dp/1999151933">AMAZON</a> &nbsp;|&nbsp; <a class="text-blue" target="_blank" href="https://www.amazon.com/dp/B07ZTTHK82/">KINDLE</a> &nbsp;|&nbsp; <a class="text-blue" target="_blank" href="https://books.apple.com/ca/book/id1487097588">APPLE</a></p>
        </div>
    </section>

    <section class="genre-grid">
        <div class="row">
            <h1 class="blue-tab center-tab">101 DRUMMING STYLES</h1>
            <h3><strong>The Drummer’s Toolbox</strong> presents drummers of all skill levels with the most comprehensive introduction to 101 drumming styles from the past century.</h3>
        </div>
        <div class="bubbles">
            <div class="row">
                <div class="bubble-wrap">
                    <div class="bubble-web">
                        <div class="bubble-trigger">Rock <span class="pulse"><i class="fas fa-plus"></i></span></div>

                        <div class="sub-bubble">Pop Rock</div>
                        <div class="sub-bubble">Bo Diddley</div>
                        <div class="sub-bubble">Surf Rock</div>
                        <div class="sub-bubble">Latin Rock</div>
                        <div class="sub-bubble">Hard Rock</div>
                        <div class="sub-bubble">Prog. Rock</div>
                        <div class="sub-bubble">Rock Ballad</div>
                        <div class="sub-bubble">Punk Rock</div>
                        <div class="sub-bubble">Grunge Rock</div>
                        <div class="sub-bubble">Pop Punk</div>
                    </div>
                </div>
                <div class="bubble-wrap">
                    <div class="bubble-web">
                        <div class="bubble-trigger">Jazz <span class="pulse"><i class="fas fa-plus"></i></span></div>

                        <div class="sub-bubble">4/4 Swing</div>
                        <div class="sub-bubble">Up-Tempo Swing</div>
                        <div class="sub-bubble">Big Band</div>
                        <div class="sub-bubble">3/4 Waltz</div>
                        <div class="sub-bubble">Brushes</div>
                        <div class="sub-bubble">Jazz Shuffle</div>
                        <div class="sub-bubble">Odd-Time Swing</div>
                        <div class="sub-bubble">Jazz Fusion</div>
                        <div class="sub-bubble">ECM Feel</div>
                        <div class="sub-bubble">Contemporary Jazz</div>
                    </div>
                </div>
                <div class="bubble-wrap">
                    <div class="bubble-web">
                        <div class="bubble-trigger">Blues <span class="pulse"><i class="fas fa-plus"></i></span></div>

                        <div class="sub-bubble">Blues Shuffle</div>
                        <div class="sub-bubble">Straight 12/8 Shuffle</div>
                        <div class="sub-bubble">Swung 12/8 Shuffle</div>
                        <div class="sub-bubble">Memphis Blues</div>
                        <div class="sub-bubble">Texas Blues</div>
                        <div class="sub-bubble">Jump Blues</div>
                        <div class="sub-bubble">Chicago Blues</div>
                        <div class="sub-bubble">Flat Tire Shuffle</div>
                        <div class="sub-bubble">Blues Rock</div>
                        <div class="sub-bubble">Half-time Shuffle</div>
                    </div>
                </div>
                <div class="bubble-wrap">
                    <div class="bubble-web">
                        <div class="bubble-trigger">Country <span class="pulse"><i class="fas fa-plus"></i></span></div>

                        <div class="sub-bubble">Train Beat</div>
                        <div class="sub-bubble">Western Swing</div>
                        <div class="sub-bubble">Bluegrass</div>
                        <div class="sub-bubble">Country Waltz</div>
                        <div class="sub-bubble">Two Step</div>
                        <div class="sub-bubble">Rockabilly </div>
                        <div class="sub-bubble">Country Pop</div>
                        <div class="sub-bubble">Country 6/8</div>
                        <div class="sub-bubble">Country Shuffle</div>
                        <div class="sub-bubble">Country Rock</div>
                    </div>
                </div>
                <div class="bubble-wrap">
                    <div class="bubble-web">
                        <div class="bubble-trigger">Soul/Funk <span class="pulse"><i class="fas fa-plus"></i></span></div>

                        <div class="sub-bubble">Gospel</div>
                        <div class="sub-bubble">Motown</div>
                        <div class="sub-bubble">Boogaloo</div>
                        <div class="sub-bubble">Neo Soul</div>
                        <div class="sub-bubble">Second Line</div>
                        <div class="sub-bubble">Funk</div>
                        <div class="sub-bubble">New Orleans Funk</div>
                        <div class="sub-bubble">Latin Funk</div>
                        <div class="sub-bubble">Go Go</div>
                        <div class="sub-bubble">Disco</div>
                    </div>
                </div>
                <div class="bubble-wrap">
                    <div class="bubble-web">
                        <div class="bubble-trigger">Metal <span class="pulse"><i class="fas fa-plus"></i></span></div>

                        <div class="sub-bubble">Doom Metal</div>
                        <div class="sub-bubble">Speed Metal</div>
                        <div class="sub-bubble">Thrash Metal</div>
                        <div class="sub-bubble">Death Metal</div>
                        <div class="sub-bubble">Power Metal</div>
                        <div class="sub-bubble">Prog. Metal</div>
                        <div class="sub-bubble">Groove Metal</div>
                        <div class="sub-bubble">Nu Metal</div>
                        <div class="sub-bubble">Metalcore</div>
                        <div class="sub-bubble">Folk Metal</div>
                    </div>
                </div>
                <div class="bubble-wrap">
                    <div class="bubble-web">
                        <div class="bubble-trigger">Electronic <span class="pulse"><i class="fas fa-plus"></i></span></div>

                        <div class="sub-bubble">Hip Hop</div>
                        <div class="sub-bubble">Breakbeat</div>
                        <div class="sub-bubble">Electro</div>
                        <div class="sub-bubble">House</div>
                        <div class="sub-bubble">Techno</div>
                        <div class="sub-bubble">Trance</div>
                        <div class="sub-bubble">Jungle</div>
                        <div class="sub-bubble">Drum & Bass</div>
                        <div class="sub-bubble">Dubstep</div>
                        <div class="sub-bubble">Trap</div>
                    </div>
                </div>
                <div class="bubble-wrap">
                    <div class="bubble-web">
                        <div class="bubble-trigger">Afro-Cuban <span class="pulse"><i class="fas fa-plus"></i></span></div>

                        <div class="sub-bubble">Abakuá</div>
                        <div class="sub-bubble">Guajira</div>
                        <div class="sub-bubble">Bolero</div>
                        <div class="sub-bubble">Guaguancó</div>
                        <div class="sub-bubble">Conga</div>
                        <div class="sub-bubble">Mambo</div>
                        <div class="sub-bubble">Cha-cha-chá</div>
                        <div class="sub-bubble">Nanigo</div>
                        <div class="sub-bubble">Mozambique</div>
                        <div class="sub-bubble">Songo</div>
                    </div>
                </div>
                <div class="bubble-wrap">
                    <div class="bubble-web">
                        <div class="bubble-trigger">Afro-Brazilian <span class="pulse"><i class="fas fa-plus"></i></span></div>

                        <div class="sub-bubble">Afoxê</div>
                        <div class="sub-bubble">Samba</div>
                        <div class="sub-bubble">Maracatu</div>
                        <div class="sub-bubble">Choro</div>
                        <div class="sub-bubble">Marcha</div>
                        <div class="sub-bubble">Frevo</div>
                        <div class="sub-bubble">Partido Alto</div>
                        <div class="sub-bubble">Baião</div>
                        <div class="sub-bubble">Bossa Nova</div>
                        <div class="sub-bubble">Samba Reggae</div>
                    </div>
                </div>
                <div class="bubble-wrap">
                    <div class="bubble-web">
                        <div class="bubble-trigger">Afro-Caribbean <span class="pulse"><i class="fas fa-plus"></i></span></div>

                        <div class="sub-bubble">Calypso</div>
                        <div class="sub-bubble">Biguine </div>
                        <div class="sub-bubble">Merengue</div>
                        <div class="sub-bubble">Bachata</div>
                        <div class="sub-bubble">Ska</div>
                        <div class="sub-bubble">Reggae</div>
                        <div class="sub-bubble">Salsa</div>
                        <div class="sub-bubble">Soca</div>
                        <div class="sub-bubble">Dancehall</div>
                        <div class="sub-bubble">Zouk</div>
                    </div>
                </div>
                <svg class="hide" xmlns="http://www.w3.org/2000/svg" version="1.1"> <defs> <filter id="shadowed-goo"> <feGaussianBlur in="SourceGraphic" result="blur" stdDeviation="10"/> <feColorMatrix in="blur" mode="matrix" values="1 0 0 0 0 0 1 0 0 0 0 0 1 0 0 0 0 0 18 -7" result="goo"/> <feGaussianBlur in="goo" stdDeviation="3" result="shadow"/> <feColorMatrix in="shadow" mode="matrix" values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 1 -0.2" result="shadow"/> <feOffset in="shadow" dx="1" dy="1" result="shadow"/> <feComposite in2="shadow" in="goo" result="goo"/> <feComposite in2="goo" in="SourceGraphic" result="mix"/> </filter> <filter id="goo"> <feGaussianBlur in="SourceGraphic" result="blur" stdDeviation="10"/> <feColorMatrix in="blur" mode="matrix" values="1 0 0 0 0 0 1 0 0 0 0 0 1 0 0 0 0 0 18 -7" result="goo"/> <feComposite in2="goo" in="SourceGraphic" result="mix"/> </filter> </defs> </svg>
            </div>
        </div>
    </section>
    <section class="icons-grid text-center">
        <div class="row">
            <h3>Expand your musical vocabulary and <strong>become<br> more versatile</strong> behind the drum set.</h3>
            <img class="book" src="https://dpwjbsxqtam5n.cloudfront.net/books/drummers-toolbox/sales/book-open.png">

            <div class="medium-up-3 small-up-2 text-center">

                <div class="columns">
                    <i class="fas fa-books"></i>
                    <h5>Encyclopedia of Groove</h5>
                    <p>Your all-in-one reference guide for learning and playing any style of music on the drums.</p>
                </div>
                <div class="columns">
                    <i class="fas fa-calendar-alt"></i>
                    <h5>History & Origins</h5>
                    <p>Learn how each musical genre evolved and influenced the next with historical breakdowns for every style and sub-style.</p>
                </div>
                <div class="columns">
                    <i class="fas fa-music"></i>
                    <h5>1000 Song Recommendations</h5>
                    <p>Expertly curated listening recommendations featuring the most renowned drum performance from every genre.</p>
                </div>
                <div class="columns">
                    <i class="fas fa-copy"></i>
                    <h5>Detailed Transcriptions</h5>
                    <p>Visualize the patterns with precise notation and breakdowns of the most influential drum grooves of the past century.</p>
                </div>
                <div class="columns">
                    <i class="fas fa-drum"></i>
                    <h5>Drum Set Guide</h5>
                    <p>Choose the right gear with images of the most practical drum set configurations used in every style of music.</p>
                </div>
                <div class="columns">
                    <i class="fas fa-desktop"></i>
                    <h5>Digital Resources</h5>
                    <p>YouTube & Spotify playlists, drumless play-along tracks, and online resources to help you get the most out of The Drummer’s Toolbox.</p>
                </div>
            </div>
        </div>
    </section>

    <div class="sub-nav">
        <div class="row">
            <div class="sub-nav-link authors active">Author</div>
            <div class="sub-nav-link foreword">Foreword</div>
            <div class="sub-nav-link jareds-letter">Sample</div>
            <div class="sub-nav-link table-of-contents"><span class="show-for-large">Table Of </span>Contents</div>
        </div>
    </div>

    <section class="tab-switcher author active">
        <div class="row">
            <img src="https://dpwjbsxqtam5n.cloudfront.net/books/drummers-toolbox/sales/brandon.jpg">
            <div class="text-wrap">
            <h1 class="blue-tab">Brandon Toews</h1>
            <p>Brandon Toews is an author, educator, and performer based out of Vancouver, Canada. In 2018, he co-authored the instructional book The Best Beginner Drum Book with Drumeo co-founder Jared Falk. In addition to creating educational resources for drummers, he has acquired his Bachelor of Music degree in Jazz and Contemporary Popular Music from MacEwan University in Edmonton, Canada with a major in Music Performance. Having played drums for the past 15 years, Brandon has studied with many notable educators and performers including Jared Falk (Drumeo), Colin Stranahan (Jonathan Kreisberg; Kurt Rosenwinkel), and Brian Thurgood (Edmonton Symphony Orchestra; MacEwan University). Brandon is also the Product Director at Musora Media, Inc., home to the award-winning online music education platforms Drumeo, Pianote, and Guitareo.</p>
            </div>
        </div>
    </section>

    <section class="tab-switcher jare-letter">
        <div class="row">
            <div class="image-wrap">
                <img src="https://dpwjbsxqtam5n.cloudfront.net/books/drummers-toolbox/sales/jared.jpg">
                <h1>JARED FALK</h1>
                <p>PRESIDENT & CO-FOUDNER OF DRUMEO</p>
            </div>
            <div class="text-wrap">
                <h1 class="blue-tab">FOREWORD</h1>
                <p>Because Buddy Rich said so—that’s why.
                    <br><br>
                    Why you’re reading this book, that is.
                    <br><br>
                    Let me back up a bit and explain . . .
                    <br><br>
                    When I first started playing drums in 1996, long before the internet was mainstream, I fuelled my obsession to learn and grow as a drummer by watching VHS tapes, DVDs, and listening to audio recordings about drumming. One of the tapes I came across in my endless quest for more was an interview with Buddy Rich. I truly admired this legendary virtuoso on the kit, so I hung on to every word he said. 
                    <br><br>
                    In this recording, Buddy was talking about what it means to be a drummer. Although I never wrote down his ideas word for word, I remember how he insisted there’s no such a thing as a “rock drummer” or “jazz drummer”. He said we should all just be drummers: when you show up at the gig, be prepared to play any style and just be a “drummer”. 
                    <br><br>
                    Like all wide-eyed kids listening to their heroes, I took his advice to heart. It really stuck with me—to the point that as I studied with almost a dozen private teachers during the next two years that I played drums, I relentlessly pestered each of them to show me different styles. That’s how I learned about jazz, funk, Latin, rock, and many others. 
                    <br><br>
                    I never became a master at any of them, and I’m still not a master of any style to this day. But I got much more versatile as a drummer, and I definitely improved at playing rock, funk, and fusion—the genres I’ve always been best at. There’s no doubt about it: developing a basic working understanding of all the other genres has helped me become a better drummer. I’ll always be grateful to Buddy Rich for how his advice started me on a journey that’s been fun, rewarding, and most of all, effective. 
                    <br><br>
                    I’m 37 years old as I write this. I’ve been playing drums for 20 years and teaching for 15. I have been part of so many incredible things in the drumming community and am always grateful for the job I get to do. One of the best parts of my job is the opportunity to help aspiring drummers develop their potential. I’m often asked for advice on the best ways to do this.
                    <br><br>
                     I always start by explaining that it’s really hard for drummers to differentiate their art in the current music business landscape. That’s why my number one recommendation to drummers who want to play professionally is to specialize. Every drummer is unique. Each of you has your own sound, feel, and style that gives you personality on the instrument—and that’s what will get you noticed. So focus on making your strengths stronger, I always tell drummers. The stronger you make your strengths, the more of yourself you will become on the drums. 
                    <br><br>
                    Now, that may sound like it runs counter to Buddy’s advice. But I’m not saying you shouldn’t study other styles. You should! While there’s no way you can become a virtuoso in every style (unless you’re Vinnie, of course), you can become an amazing [insert the style you’re best at here] drummer. Believe it or not, the best pathway to get you there is developing a basic understanding of all the styles, and that’s where The Drummer’s Toolbox comes in. 
                    <br><br>
                    Because I’m certain that versatility is such a core component of becoming a more successful drummer, I long ago dreamed up the idea to publish a pocket-sized book on diverse drumming styles so that a drummer could easily pull out this toolbox and get the right tool for the jobs that present themselves at the gig or in the practice room. And after the success of The Best Beginner Drum Book, which I co-wrote with our Drumeo wunderkind, Brandon Toews, I knew he was the best man for this job.
                    <br><br>
                     What Brandon has created here is a bit more than “pocket-sized” (although if you’re using the e-book version it just might be!), but it’s everything I dreamed of—and more. I started teaching Brandon drums in 2013, and he is absolutely the best student I have ever taught. He is what I call “confidently coachable”, which means he believes he can do anything, but he also understands how important it is to take advice from others. 
                    <br><br>
                    That’s exactly the attitude a drummer needs to learn a variety of styles and become more versatile, so you can be confident you’re learning from the best here. This attitude is also the mindset you’ll want to take on as you navigate this mammoth tome. That, and a few energy drinks, maybe. Brandon left practically no stone unturned here in his obsession to help you learn and grow as a drummer. 
                    <br><br>
                    The Drummer’s Toolbox isn’t meant to be a book you “finish”. It’s kind of the opposite: it will only further reinforce that when it comes to drumming, the more you know, the more you realize you don’t know. That’s not a bad thing—although it can feel frustrating at times. Just remember, you’re on an epic journey, and you get to learn this amazing instrument! Before long, you’ll be having too much fun to be frustrated: you’ll just be grateful you can enjoy the process. 
                    <br><br>
                    But don’t thank me. Thank Buddy, and thank Brandon.
                    <br><br>
                    To your drumming success,<br>
                    <img class="signature" width="60px" src="https://dpwjbsxqtam5n.cloudfront.net/books/drummers-toolbox/sales/signature.png">
                </p>
            </div>
        </div>
    </section>

    <section class="tab-switcher sneak-peek">
        <div class="row">
            <h1 class="blue-tab">SEE INSIDE</h1>
            <div class="text-center">
                <div class="sample-wrap"><img class="modal-trigger" src="https://dpwjbsxqtam5n.cloudfront.net/books/drummers-toolbox/sales/sample-image-1.png"></div>
                <div class="sample-wrap"><img class="modal-trigger" src="https://dpwjbsxqtam5n.cloudfront.net/books/drummers-toolbox/sales/sample-image-2.png"></div>
                <div class="sample-wrap"><img class="modal-trigger" src="https://dpwjbsxqtam5n.cloudfront.net/books/drummers-toolbox/sales/sample-image-3.png"></div>
                <div class="sample-wrap"><img class="modal-trigger" src="https://dpwjbsxqtam5n.cloudfront.net/books/drummers-toolbox/sales/sample-image-4.png"></div>
                <div class="sample-wrap"><img class="modal-trigger" src="https://dpwjbsxqtam5n.cloudfront.net/books/drummers-toolbox/sales/sample-image-5.png"></div>
            </div>
        </div>
    </section>

    <div class="slider-lightbox">
        <div class="row">
            <div class="slide">
                <div class="image" style="background-image:url(https://dpwjbsxqtam5n.cloudfront.net/books/drummers-toolbox/sales/sample-image-1.png);"></div>
            </div>
            <div class="slide">
                <div class="image" style="background-image:url(https://dpwjbsxqtam5n.cloudfront.net/books/drummers-toolbox/sales/sample-image-2.png);"></div>
            </div>
            <div class="slide">
                <div class="image" style="background-image:url(https://dpwjbsxqtam5n.cloudfront.net/books/drummers-toolbox/sales/sample-image-3.png);"></div>
            </div>
            <div class="slide">
                <div class="image" style="background-image:url(https://dpwjbsxqtam5n.cloudfront.net/books/drummers-toolbox/sales/sample-image-4.png);"></div>
            </div>
            <div class="slide">
                <div class="image" style="background-image:url(https://dpwjbsxqtam5n.cloudfront.net/books/drummers-toolbox/sales/sample-image-5.png);"></div>
            </div>
        </div>
        <div class="arrow scroll-left"><i class="fas fa-chevron-left"></i></div>
        <div class="arrow scroll-right"><i class="fas fa-chevron-right"></i></div>
    </div>
    <div class="slider-overlay"></div>

    <section class="tab-switcher toc-list">
        <div class="row">
            <h1 class="blue-tab">TABLE OF CONTENTS</h1>
            <div class="lesson-descriptions columns">
                @include('drumeo.products.partials.week-breakdown', [
                "defaultOpen" => true,
                "chapter" => "1",
                "weekTitle" => "Rock <span class='page'>3</span>",
                "weekDescription" => "Pop Rock <span class='page'>4</span><br>Bo Diddley <span class='page'>7</span><br>Surf Rock <span class='page'>11</span><br>Latin Rock <span class='page'>14</span><br>Hard Rock <span class='page'>18</span><br>Progressive Rock <span class='page'>22</span><br>Rock Ballad <span class='page'>25</span><br>Punk Rock <span class='page'>29</span><br>Grunge <span class='page'>33</span><br>Pop Punk <span class='page'>37</span>",
                ])
                @include('drumeo.products.partials.week-breakdown', [
                "chapter" => "2",
                "weekTitle" => "Jazz <span class='page'>43</span>",
                "weekDescription" => "4/4 Swing <span class='page'>44</span><br>Up-Tempo Swing <span class='page'>48</span><br>Big Band <span class='page'>52</span><br>3/4 Waltz <span class='page'>56</span><br>Brushes <span class='page'>60</span><br>Jazz Shuffle <span class='page'>66</span><br>Odd Time Swing <span class='page'>70</span><br>Jazz Fusion <span class='page'>74</span><br>ECM Feel <span class='page'>78</span><br>Contemporary Jazz <span class='page'>82</span>",
                ])
                @include('drumeo.products.partials.week-breakdown', [
                "chapter" => "3",
                "weekTitle" => "Blues <span class='page'>89</span>",
                "weekDescription" => "Blues Shuffle <span class='page'>90</span><br>Straight 12/8 Blues <span class='page'>94</span><br>Swung 12/8 Blues <span class='page'>98</span><br>Memphis Blues <span class='page'>101</span><br>Texas Blues <span class='page'>105</span><br>Jump Blues <span class='page'>109</span><br>Chicago Blues <span class='page'>113</span><br>Flat Tire Shuffle <span class='page'>117</span><br>Blues Rock <span class='page'>121</span><br>Half-Time Shuffle <span class='page'>125</span>",
                ])
                @include('drumeo.products.partials.week-breakdown', [
                "chapter" => "4",
                "weekTitle" => "Country <span class='page'>131</span>",
                "weekDescription" => "Train Beat <span class='page'>132</span><br>Western Swing <span class='page'>136</span><br>Bluegrass <span class='page'>139</span><br>Country Waltz <span class='page'>142</span><br>Two-Step <span class='page'>145</span><br>Rockabilly <span class='page'>148</span><br>Country Pop <span class='page'>152</span><br>Country 6/8 <span class='page'>156</span><br>Country Shuffle <span class='page'>159</span><br>Country Rock <span class='page'>163</span>",
                ])
                @include('drumeo.products.partials.week-breakdown', [
                "chapter" => "5",
                "weekTitle" => "Soul & Funk <span class='page'>169</span>",
                "weekDescription" => "Gospel <span class='page'>171</span><br>Motown <span class='page'>175</span><br>Boogaloo <span class='page'>178</span><br>Neo-Soul <span class='page'>182</span><br>Second Line <span class='page'>186</span><br>Funk <span class='page'>189</span><br>New Orleans Funk <span class='page'>193</span><br>Latin Funk <span class='page'>197</span><br>Go-Go <span class='page'>201</span><br>Disco <span class='page'>205</span>",
                ])
                @include('drumeo.products.partials.week-breakdown', [
                "chapter" => "6",
                "weekTitle" => "Metal <span class='page'>211</span>",
                "weekDescription" => "Doom Metal <span class='page'>213</span><br>Speed Metal <span class='page'>216</span><br>Thrash Metal <span class='page'>220</span><br>Death Metal <span class='page'>223</span><br>Power Metal <span class='page'>227</span><br>Progressive Metal <span class='page'>231</span><br>Groove Metal <span class='page'>235</span><br>Nu Metal <span class='page'>239</span><br>Metalcore <span class='page'>243</span><br>Folk Metal <span class='page'>247</span>",
                ])
                @include('drumeo.products.partials.week-breakdown', [
                "chapter" => "7",
                "weekTitle" => "Electronic <span class='page'>253</span>",
                "weekDescription" => "Hip-Hop <span class='page'>255</span><br>Breakbeat <span class='page'>259</span><br>Electro <span class='page'>263</span><br>House <span class='page'>267</span><br>Techno <span class='page'>271</span><br>Trance <span class='page'>275</span><br>Jungle <span class='page'>278</span><br>Drum And Bass <span class='page'>282</span><br>Dubstep <span class='page'>285</span><br>Trap <span class='page'>288</span>",
                ])
                @include('drumeo.products.partials.week-breakdown', [
                "chapter" => "8",
                "weekTitle" => "Afro-Cuban <span class='page'>293</span>",
                "weekDescription" => "Abakuá <span class='page'>295</span><br>Guajira <span class='page'>299</span><br>Bolero <span class='page'>302</span><br>Guaguancó <span class='page'>306</span><br>Conga <span class='page'>311</span><br>Mambo <span class='page'>314</span><br>Cha-Cha-Chá <span class='page'>318</span><br>Nanigo <span class='page'>321</span><br>Mozambique <span class='page'>325</span><br>Songo <span class='page'>329</span>",
                ])
                @include('drumeo.products.partials.week-breakdown', [
                "chapter" => "9",
                "weekTitle" => "Afro-Brazilian <span class='page'>335</span>",
                "weekDescription" => "Afoxê <span class='page'>337</span><br>Samba <span class='page'>340</span><br>Maracatu <span class='page'>344</span><br>Choro <span class='page'>348</span><br>Marcha <span class='page'>351</span><br>Frevo <span class='page'>355</span><br>Partido Alto <span class='page'>359</span><br>Baião <span class='page'>362</span><br>Bossa Nova <span class='page'>366</span><br>Samba Reggae <span class='page'>370</span>",
                ])
                @include('drumeo.products.partials.week-breakdown', [
                "chapter" => "10",
                "weekTitle" => "Afro-Caribbean <span class='page'>375</span>",
                "weekDescription" => "Calypso <span class='page'>377</span><br>Biguine <span class='page'>380</span><br>Merengue <span class='page'>383</span><br>Bachata <span class='page'>387</span><br>Ska <span class='page'>390</span><br>Reggae <span class='page'>393</span><br>Salsa <span class='page'>397</span><br>Soca <span class='page'>400</span><br>Dancehall <span class='page'>404</span><br>Zouk <span class='page'>407</span>",
                ])
            </div>
        </div>
    </section>

    <section class="drummer-quotes text-center">
        <div class="row">
            <h1 class="blue-tab center-tab">SEE WHAT DRUMMERS<br class="hide-for-medium"> ARE SAYING...</h1>
            <div class="medium-up-2">
                <div class="columns">
                    <img class="avatar" src="https://dpwjbsxqtam5n.cloudfront.net/sales/instructors/drummer-toddsucherman.jpg">
                    <p>“A thoughtful and well-organized document of modern drumming with lineage going back decades.”</p>
                    <h5><strong>Todd Sucherman</strong><br> Drummer For Styx</h5>
                </div>
                <div class="columns">
                    <img class="avatar" src="https://dpwjbsxqtam5n.cloudfront.net/sales/instructors/drummer-michaelschack.jpg">
                    <p>“There are hundreds of outdated books on specific drumming genres and styles, but there’s only one that’s totally modern and covers one hundred.”</p>
                    <h5><strong>Michael Schack</strong><br> Drummer For Netsky</h5>
                </div>
                <div class="columns">
                    <img class="avatar" src="https://dpwjbsxqtam5n.cloudfront.net/sales/instructors/drummer-domfamularo.jpg">
                    <p>“The Drummer’s Toolbox has given us an endless amount of options to build creative ideas in so many drumming styles. Brandon has given all of us new ways of learning and different ways to think about how we can approach the drum-set. For that, I thank him very much.”</p>
                    <h5><strong>Dom Famularo</strong><br> Drumming’s Global Ambassador</h5>
                </div>
                <div class="columns">
                    <img class="avatar" src="https://dpwjbsxqtam5n.cloudfront.net/sales/instructors/drummer-stevelyman.jpg">
                    <p>“I am floored. The Drummer’s Toolbox is one of the most unique and comprehensive texts out there on drumming styles. It’s not simply a book of basic styles. Brandon has instead gone ‘to the streets’ if you will and really dug deep to get to the heart of each of these grooves and styles. The depth is reflected in the work. Highly recommend.”</p>
                    <h5><strong>Steve Lyman</strong><br> Jazz drummer, composer, educator</h5>
                </div>
            </div>
        </div>
    </section>

    <section class="jared-quote text-center">
        <div class="row">
            <h3><em>“Versatility is such a core component of becoming a more successful drummer -- and this book is the perfect reference for any drummer to learn about new styles, start playing new styles, and become well rounded musicians who’ll develop freedom across genres and develop their own voice on the drums.”</em></h3>
            <div class="pic-name">
                <img class="avatar" src="https://dpwjbsxqtam5n.cloudfront.net/books/drummers-toolbox/sales/jared.jpg">
                <div class="name">
                    <img class="signature" width="60px" src="https://dpwjbsxqtam5n.cloudfront.net/books/drummers-toolbox/sales/signature.png">
                    <h1>Jared Falk</h1>
                    <p>PRESIDENT & CO-FOUNDER OF DRUMEO</p>
                </div>
            </div>
        </div>
    </section>

    <div id="customize-anchor" class="anchor anchor-slide"></div>
    <section class="final-pitch toolbox">
        <div class="noise-wrap">
            <div class="row">
                <div class="columns medium-6 float-right">
                    <img src="https://dpwjbsxqtam5n.cloudfront.net/books/drummers-toolbox/sales/book.png" class="book">
                </div>
                <div class="columns medium-6 text-wrap">
                    <img src="https://dpwjbsxqtam5n.cloudfront.net/books/drummers-toolbox/sales/logo-stacked.png">
                    @if( Prices::$toolboxBookFull > Prices::$toolboxBookRegular)
                        <p><s>WAS ${{ Prices::$toolboxBookFull }}</s> <strong> NOW ${{ Prices::$toolboxBookRegular }}</strong>.
                            {{--<br><span class="show-for-large">ONLY</span> <strong class="tzcd-med">A LIMITED TIME</strong> LEFT--}}
                        </p>
                    @else
                        <p><strong>ONLY ${{ Prices::$toolboxBookRegular }}.</strong></p>
                    @endif
                    <a class="join rounded" href="{{ URL::Route('shopping-cart.to-cart.api') }}?products[the-drummers-toolbox-book]=1">CLICK HERE TO ORDER &raquo;</a>
                    {{--<a class="join white outline rounded" href="/">GET FREE WITH <img src="https://dpwjbsxqtam5n.cloudfront.net/logos/logo-blue.png"> &raquo;</a>--}}
                    <div class="button-centerer"><p style="max-width:100%">OR BUY FROM YOUR FAVORITE ONLINE STORES:<br class="hide-for-medium"> <a class="or-drumeo" target="_blank" href="https://www.amazon.com/dp/1999151933">AMAZON</a> &nbsp;|&nbsp; <a class="or-drumeo" target="_blank" href="https://www.amazon.com/dp/B07ZTTHK82/">KINDLE</a> &nbsp;|&nbsp; <a class="or-drumeo" target="_blank" href="https://books.apple.com/ca/book/id1487097588">APPLE</a></p></div>
                </div>
            </div>
        </div>
    </section>

    <div class="questions">
        <div class="row">
            <h1 class="columns">Still Have Questions?</h1>
            {{--@include('drumeo.products.partials.question-dropdown', [--}}
            {{--"question" => "Why isn’t the book available on Amazon?",--}}
            {{--"answer" => "Our inventory through Amazon sold out much quicker than expected. We have another shipment on the way to Amazon and we’ll add the link again soon."--}}
            {{--])--}}
            {{--@include('drumeo.products.partials.question-dropdown', [--}}
            {{--"question" => "How should I order in Canada/UK?",--}}
            {{--"answer" => "Canadian Drummers: <a target='_blank' href='https://www.amazon.ca/dp/B07G8N348K'>Click here to order through Amazon.ca</a>. <br>UK Drummers: <a target='_blank' href='https://www.amazon.co.uk/dp/B07G8N348K'>Click here to order through Amazon.co.uk</a>."--}}
            {{--])--}}
            @include('drumeo.products.partials.question-dropdown', [
            "question" => "How should I order in Canada?",
            "answer" => "Canadian Drummers: <a target='_blank' href='https://www.amazon.ca/dp/B07ZTTHK82'>Click here to order through Amazon.ca</a>."
            ])
            @include('drumeo.products.partials.question-dropdown', [
            "question" => "Can I get a discount when ordering the book in bulk?",
            "answer" => "Yes! We have bulk discounts available for ordering more than 100 copies, as well as shipping discounts. <a href='#bulkOrder' class='anchor-slide open-bulk'>Click here to fill in a short web form to get started.</a>"
            ])
            @include('drumeo.products.partials.question-dropdown', [
            "question" => "Should I order through Drumeo or Amazon?",
            "answer" => "It’s totally up to you! Amazon might be able to save you a couple dollars on shipping rates due to their bulk shipping discounts, but depending on where you live they might not be able to ship to your country."
            ])
            @include('drumeo.products.partials.question-dropdown', [
            "question" => "How much does shipping cost?",
            "answer" => "If you order through this website (rather than Amazon), the shipping rates for one book are:<br><br>- United States: $9<br>- Canada, United Kingdom, and Germany: $15<br>- Everywhere Else: $40<br><br>Unfortunately, international shipping is much higher than we’d like and there’s no quick way for us to lower the cost. We’ll be looking at finding local distribution centers in the future."
            ])
            {{--<br><strong>The book ships free worldwide when ordered in the Drumeo membership bundle here: <a href='/'>www.Drumeo.com/</a></strong>--}}
            @include('drumeo.products.partials.question-dropdown', [
            "question" => "How long will it take for the book to arrive?",
            "answer" => "If you order through this website (rather than Amazon), the shipping should take about this long, depending on your location:<br><br>- United States: 2-10 Business Days<br>- Everywhere Else: 7-20 Business Days"
            ])
            @include('drumeo.products.partials.question-dropdown', [
            "question" => "Do you have a digital version available? (e-book or audiobook)",
            "answer" => "Kindle Version: <a target='_blank' href='https://www.amazon.com/dp/B07ZTTHK82/'>Click here to order through Amazon</a>. <br>Apple Books Version: <a target='_blank' href='https://books.apple.com/ca/book/id1487097588'>Click here to order through Apple</a>."
            ])
            {{--@include('drumeo.products.partials.question-dropdown', [--}}
            {{--"question" => "It says there’s a free 30-day membership pass to Drumeo. What’s that?",--}}
            {{--"answer" => "Drumeo is our award-winning online drum lessons experience, where you’ll get step-by-step video lessons from the best drummers and teachers in the world: <a target='_blank' href='https://www.drumeo.com/'>www.Drumeo.com/</a>.<br><br>We’ve included a free 30-day membership redemption pass inside every copy of The Best Beginner Drum Book, so once your book arrives you’ll get an amazing book PLUS video drum lessons for 30 days ($29 value)."--}}
            {{--])--}}
        </div>
        <div class="row">
            <div id="bulk-order-anchor" class="anchor columns"></div>
            <div id="bulkOrder" class="text-center">
                <h4 class="columns half-padding"><strong>Get a better rate when ordering in bulk.</strong></h4>
                <br><br>
                <form id="ajaxForm" class="ajax-form" name="drumeo" method="post" action="/form-mail/toolbox-book.php">
                    <input type="hidden" name="subject" value="Bulk Order - The Drummers Toolbox"/>
                    <input type="hidden" name="redirect" value="/drumshop/the-drummers-toolbox/?thankyou"/>
                    <div class="medium-6 columns half-padding">
                        <input name="email" type="email" placeholder="Email Address" required/>
                    </div>
                    <div class="medium-6 columns half-padding">
                        <input name="company" type="text" placeholder="Company"/>
                    </div>
                    <div class="medium-6 columns half-padding">
                        <input name="country" type="text" placeholder="Country"/>
                    </div>
                    <div class="medium-6 columns half-padding"><input name="quantity" type="number" placeholder="Book Quantity"/>
                    </div>
                    <div class="columns half-padding">
                        <textarea name="message" placeholder="Optional Message"></textarea>
                    </div>
                    <div class="medium-6 columns half-padding">
                        <div class="g-recaptcha" data-sitekey="6LcBSxYUAAAAANEVgiFM3kmHOjzbcrkspWBtQd9n"></div>
                    </div>
                    <div class="medium-6 columns text-right half-padding">
                        <button class="button join" type="submit">
                            <span class="pre-add"><i class="fad fa-paper-plane"></i> Send</span>
                            <span class="pending hide"><i class="fad fa-spinner-third fa-spin"></i> Sending</span>
                            <span class="success hide"><i class="fad fa-thumbs-up"></i> Sent</span>
                            <span class="fail hide"><i class="fad fa-exclamation-triangle"></i> Oops</span>
                        </button>
                    </div>
                </form>

                <div class="disclaimer"></div>

                @include('drumeo.lead-gen.partials.thank-you-box', [
                    "headline" => "SENT",
                    "body" => "We'll respond to you soon! If you haven't heard back in the next week, please <a class='text-white' href='/support'>contact us</a>."
                ])
            </div>
        </div>
    </div>
@stop
@section('scripts')
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    <script src="{{ asset('/assets/js/sliding-anchor.js') }}"></script>
    <script>
        $(document).ready(function () {
            // book sticks to nav on scroll
            var stickyBook = $(".book-header .sticky-book");
            $(window).scroll(function () {
                if ($(window).width() > 1023) {
                    var logo = $(".book-header.toolbox p").offset().top + 40;

                } else if ($(window).width() > 639 && $(window).width() < 1024) {
                    var logo = $(".book-header.toolbox p").offset().top + 37;

                } else {
                    var logo = $(".book-header.toolbox p").offset().top + 30;
                }
                if ($(this).scrollTop() > (logo)) {
                    stickyBook.addClass('stick-to-top');
                } else {
                    stickyBook.removeClass('stick-to-top');
                }
            });

            // Tab Switcher
            $('.sub-nav-link').click(function () {
                $('.sub-nav-link').removeClass('active');
                $(this).addClass('active');
                var currentTab = $(this).index();

                $('.tab-switcher').removeClass('active');
                $('.tab-switcher').eq(currentTab).addClass('active');
            });

            // active class for bubbles
            $('.bubble-trigger').on('click', function () {
                if($(this).hasClass('active')) {
                    $('.bubble-trigger').removeClass('active');
                    $('.bubble-wrap').removeClass('opened');
                }
                else {
                    $('.bubble-trigger').removeClass('active');
                    $('.bubble-wrap').removeClass('opened');
                    $(this).closest('.bubble-wrap').addClass('opened');
                    $(this).addClass('active');
                }
            });

            // Dropdown for FAQ section
            $('.question-dropdown').on('click', questionDropdown);

            function questionDropdown() {
                $(this).toggleClass('active');
                $(this).find('.fa-chevron-down').toggleClass('rotated');
            }

            // Page Slider Modal
            var thumbnail = $('.modal-trigger');
            var sliderOverlay = $('.slider-overlay');
            var sliderLightbox = $('.slider-lightbox');

            thumbnail.click(function () {
                currentSlide = $(this).parent().index();
                sliderLightbox.addClass('active');
                sliderOverlay.addClass('active');

                giveSlidesClass();
            });

            sliderOverlay.click(function (e) {
                e.stopPropagation();

                closeSliderOverlay();
            });

            function closeSliderOverlay() {
                sliderOverlay.removeClass('active');
                sliderLightbox.removeClass('active');

                slidesElement.removeClass('current-slide prev-slide next-slide');
            }

            var currentSlide = 0;
            var nextSlide = currentSlide + 1;
            var prevSlide;
            var slidesElement = $('.slide');
            var totalSlides = slidesElement.length;
            var scrollLeftElement = $('.scroll-left');
            var scrollRightElement = $('.scroll-right');

            function showHideArrows() {
                if (currentSlide === 0) {
                    scrollLeftElement.hide();
                } else {
                    scrollLeftElement.show();
                }

                if (currentSlide === slidesElement.length - 1) {
                    scrollRightElement.hide();
                } else {
                    scrollRightElement.show();
                }
            }

            function giveSlidesClass() {
                prevSlide = currentSlide - 1;
                nextSlide = currentSlide + 1;

                slidesElement.removeClass('current-slide prev-slide next-slide');

                if (prevSlide < 0) {
                    prevSlide = undefined;
                }
                if (nextSlide > totalSlides - 1) {
                    nextSlide = undefined;
                }
                slidesElement.eq(currentSlide).addClass('current-slide');
                slidesElement.eq(prevSlide).addClass('prev-slide');
                slidesElement.eq(nextSlide).addClass('next-slide');
                showHideArrows();
            }

            giveSlidesClass();

            scrollLeftElement.click(function () {
                currentSlide = currentSlide - 1;
                giveSlidesClass();
            });

            scrollRightElement.click(function () {
                currentSlide = currentSlide + 1;
                giveSlidesClass();
            });

            //bulk order display
            $(".open-bulk").click(function (e) {
                e.preventDefault();
                $('#bulkOrder').addClass('active');
            });
        });
    </script>
    <script src="{{ _mix('js/manifest.js') }}"></script>
    <script src="{{ _mix('js/vendor.js') }}"></script>
    <script src="{{ _mix('js/cart-sidebar.js') }}"></script>
    <script src="{{ _mix('js/app.js') }}"></script>
@stop
