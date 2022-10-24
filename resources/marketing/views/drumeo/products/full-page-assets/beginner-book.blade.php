@extends('drumeo.products.misc-products-layout')

@section('meta')
    <title>The Best Beginner Drum Book</title>
    <meta name="description" content="The simplest guide for beginner drummers to get started on the drums and take their drumming to the next level.">

    <!-- Social Media -->
    <meta property="og:image" content="https://dpwjbsxqtam5n.cloudfront.net/books/best-beginner-drum-book/sales/og-image.jpg" style="display: none;">
    <meta property="og:title" content="The Best Beginner Drum Book">
    <meta property="og:description" content="The simplest guide for beginner drummers to get started on the drums and take their drumming to the next level.">
    <meta property="og:url" content="https://www.drumeo.com/{{ Request::path() }}">
@stop

@section('head')
    <link href="{{ asset('/marketing/parcel/drumeo/beginner-book.css') }}" rel="stylesheet">
@stop

@section('content')
    @include('drumeo.products.partials.promo-banner', [
                    "name" => "The Best Beginner Drum Book",
                    "fullPrice" => Prices::$beginnerBookFull,
                    "price" => Prices::$beginnerBookRegular,
                "noBreadcrumb" => true
                ])

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


    <header class="book-header">
        <div class="clearfix mx-auto max-w-6xl relative">
            <div class="w-full sm:w-1/2 float-right text-center p-4">
                <img src="https://dpwjbsxqtam5n.cloudfront.net/books/best-beginner-drum-book/sales/see-inside.png" class="see-inside">
                <span style="position:relative;display: inline-block;">
                    <img src="https://dpwjbsxqtam5n.cloudfront.net/books/best-beginner-drum-book/sales/book-kindle-alt.png" data-open="seeInside" class="book">
                    <a target="_blank" href="https://www.amazon.com/dp/B07TB4SN3V"><img src="https://dpwjbsxqtam5n.cloudfront.net/books/best-beginner-drum-book/sales/kindle-badge.png" class="kindle-badge"></a>
                </span>
            </div>

            <div class="w-full sm:w-1/2 text-wrap p-4 ">
                <h1>The Best Beginner<br class="hidden sm:inline"> Drum Book</h1>
                <p>The simplest guide for beginner drummers to get started on the drums and take their drumming to the next level.
                    <br><br>
                    Get it today for just
                    @if(Prices::$beginnerBookFull > Prices::$beginnerBookRegular)
                        <s style="opacity: 0.6;">${{ Prices::$beginnerBookFull }}</s> ${{ Prices::$beginnerBookRegular }} USD
                    @else
                        ${{ Prices::$beginnerBookRegular }} USD
                    @endif
                </p>
                <a href="/laravel/public/shopping-cart/api/query?products[BeginnerBook]=1" class="join">Click Here To Order</a>
                <a target="_blank" href="https://www.amazon.com/dp/B07G8N348K" class="join orange">Get Your Copy On <img class="amazon inline-block" src="https://dpwjbsxqtam5n.cloudfront.net/books/best-beginner-drum-book/sales/amazon-logo.png"></a>
            </div>
        </div>
    </header>

    <section class="page-previews text-center">
        <div class="mx-auto clearfix">
            <div class="float-left px-2 lg:w-1/6 sm:w-1/3 w-1/2">
                <div class="background-wrap" style="background-image:url('https://dpwjbsxqtam5n.cloudfront.net/books/best-beginner-drum-book/sales/chapter2.jpg');">
                    <div class="magnify"><i class="far fa-search-plus"></i></div>
                </div>
            </div>
            <div class="float-left px-2 lg:w-1/6 sm:w-1/3 w-1/2">
                <div class="background-wrap" style="background-image:url('https://dpwjbsxqtam5n.cloudfront.net/books/best-beginner-drum-book/sales/other1.jpg');">
                    <div class="magnify"><i class="far fa-search-plus"></i></div>
                </div>
            </div>
            <div class="float-left px-2 lg:w-1/6 sm:w-1/3 w-1/2">
                <div class="background-wrap" style="background-image:url('https://dpwjbsxqtam5n.cloudfront.net/books/best-beginner-drum-book/sales/chapter8.jpg');">
                    <div class="magnify"><i class="far fa-search-plus"></i></div>
                </div>
            </div>
            <div class="float-left px-2 lg:w-1/6 sm:w-1/3 w-1/2">
                <div class="background-wrap" style="background-image:url('https://dpwjbsxqtam5n.cloudfront.net/books/best-beginner-drum-book/sales/other2.jpg');">
                    <div class="magnify"><i class="far fa-search-plus"></i></div>
                </div>
            </div>
            <div class="float-left px-2 lg:w-1/6 sm:w-1/3 w-1/2">
                <div class="background-wrap" style="background-image:url('https://dpwjbsxqtam5n.cloudfront.net/books/best-beginner-drum-book/sales/chapter6.jpg');">
                    <div class="magnify"><i class="far fa-search-plus"></i></div>
                </div>
            </div>
            <div class="float-left px-2 lg:w-1/6 sm:w-1/3 w-1/2">
                <div class="background-wrap" style="background-image:url('https://dpwjbsxqtam5n.cloudfront.net/books/best-beginner-drum-book/sales/other3.jpg');">
                    <div class="magnify"><i class="far fa-search-plus"></i></div>
                </div>
            </div>
        </div>
    </section>

    <div class="slider-lightbox">
        <div class="row">
            <div class="slide">
                <div class="image" style="background-image:url(https://dpwjbsxqtam5n.cloudfront.net/books/best-beginner-drum-book/sales/chapter2.jpg);"></div>
            </div>
            <div class="slide">
                <div class="image" style="background-image:url(https://dpwjbsxqtam5n.cloudfront.net/books/best-beginner-drum-book/sales/other1.jpg);"></div>
            </div>
            <div class="slide">
                <div class="image" style="background-image:url(https://dpwjbsxqtam5n.cloudfront.net/books/best-beginner-drum-book/sales/chapter8.jpg);"></div>
            </div>
            <div class="slide">
                <div class="image" style="background-image:url(https://dpwjbsxqtam5n.cloudfront.net/books/best-beginner-drum-book/sales/other2.jpg);"></div>
            </div>
            <div class="slide">
                <div class="image" style="background-image:url(https://dpwjbsxqtam5n.cloudfront.net/books/best-beginner-drum-book/sales/chapter6.jpg);"></div>
            </div>
            <div class="slide">
                <div class="image" style="background-image:url(https://dpwjbsxqtam5n.cloudfront.net/books/best-beginner-drum-book/sales/other3.jpg);"></div>
            </div>
        </div>
        <div class="arrow scroll-left"><i class="fas fa-chevron-left"></i></div>
        <div class="arrow scroll-right"><i class="fas fa-chevron-right"></i></div>
    </div>
    <div class="slider-overlay"></div>

    <section class="checkmark-grid">
        <div class="row">
            <div class="columns text-center">
                <h1>Getting started on the drums<br class="hide-for-large"> just became easier...</h1>
            </div>
            <div class="columns video-wrap">
                <div class="flex-video widescreen vimeo">
                    <iframe src="//player.vimeo.com/video/289151913" frameborder="0" allowfullscreen allow="autoplay"></iframe>
                </div>
            </div>
            <div class="columns medium-up-2 bullet-points">
                <div class="columns checkmark-wrap">
                    <i class="fas fa-check-circle"></i>
                    <p>
                        <strong>Setting up your drums...</strong><br> including choosing your kit, setting everything up, and proper posture and positioning.
                    </p>
                </div>
                <div class="columns checkmark-wrap">
                    <i class="fas fa-check-circle"></i>
                    <p>
                        <strong>Maximizing your practice time...</strong><br> by setting goals, developing your practice routine, optimizing your practice space, and more.
                    </p>
                </div>
                <div class="columns checkmark-wrap">
                    <i class="fas fa-check-circle"></i>
                    <p>
                        <strong>Hand technique tips...</strong><br> for holding your drumsticks correctly for every grip type plus advice for combining multiple grips.
                    </p>
                </div>
                <div class="columns checkmark-wrap">
                    <i class="fas fa-check-circle"></i>
                    <p>
                        <strong>Note values & drum notation...</strong><br> insights so you can read sheet music, have a deeper understanding of patterns, and learn the drums faster.
                    </p>
                </div>
                <div class="columns checkmark-wrap">
                    <i class="fas fa-check-circle"></i>
                    <p>
                        <strong>Essential drum rudiments...</strong><br> to increase your drumming vocabulary and internalize must-know patterns for your beats and fills.
                    </p>
                </div>
                <div class="columns checkmark-wrap">
                    <i class="fas fa-check-circle"></i>
                    <p>
                        <strong>Rock drum beats and fills...</strong><br> to develop your skills and get you playing-along to some of the most popular music out there.
                    </p>
                </div>
                <div class="columns checkmark-wrap">
                    <i class="fas fa-check-circle"></i>
                    <p>
                        <strong>Five must-know techniques...</strong><br> that every beginner drummer needs for playing more tastefully and musically.
                    </p>
                </div>
                <div class="columns checkmark-wrap">
                    <i class="fas fa-check-circle"></i>
                    <p>
                        <strong>Develop freedom on the drums...</strong><br> by learning how to use all four limbs both independently and simultaneously.
                    </p>
                </div>
                <div class="columns checkmark-wrap">
                    <i class="fas fa-check-circle"></i>
                    <p>
                        <strong>Learning ANY musical style...</strong><br> just got easier with The Stylistic Method, where you’ll build a variety of drum beats in 5 main styles.
                    </p>
                </div>
                <div class="columns checkmark-wrap">
                    <i class="fas fa-check-circle"></i>
                    <p>
                        <strong>10 play-along songs...</strong><br> for creating your own drum parts, applying them in a musical context, and having more fun in your practice sessions.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <div class="sub-nav">
        <div class="row">
            <div class="sub-nav-link authors active">Authors</div>
            <div class="sub-nav-link foreword">Foreword</div>
            <div class="sub-nav-link jareds-letter"><span class="show-for-medium">Jared’s </span>Letter</div>
            <div class="sub-nav-link table-of-contents"><span class="show-for-large">Table Of </span>Contents</div>
        </div>
    </div>

    <section class="authors tab-switcher active">
        <div class="jared-brandon">
            <div class="row">
                <div class="columns large-5 float-right text-wrap">
                    <div class="columns float-right medium-6 large-12">
                        <h1>Jared Falk</h1>
                        <p>Jared Falk is a co-founder of Drumeo and author of the best-seller instructional programs “Successful Drumming” and “Bass Drum Secrets”. With over 15 years of experience teaching drummers from all over the world, Jared is known for his simplified teaching methods and high level of enthusiasm for the drumming community.</p>
                    </div>
                    <div class="columns medium-6 large-12">
                        <h1>Brandon Toews</h1>
                        <p>Brandon Toews is an author, educator, and performer based out of Vancouver, Canada. Having played drums for more than ten years, Brandon has acquired a Bachelor of Music degree in Jazz and Contemporary Popular Music and studied privately under many notable educators including Jared Falk (Drumeo) and Brian Thurgood (Edmonton Symphony Orchestra, MacEwan University).</p>
                    </div>
                </div>
                <div class="columns large-7 text-center">
                    <img class="brandon-jared" src="https://dpwjbsxqtam5n.cloudfront.net/books/best-beginner-drum-book/sales/brandon-jared.jpg">
                </div>
            </div>
        </div>
        <div class="instructors">
            <div class="row">
                <div class="columns no-padding medium-8">
                    <div class="instructor-wrap columns no-padding horizontal">
                        <div class="instructor-pic columns medium-5">
                            <div class="bg-pic" style="background-image:url('https://dpwjbsxqtam5n.cloudfront.net/books/best-beginner-drum-book/sales/cobham.jpg');"></div>
                        </div>
                        <div class="columns medium-7 text">
                            <h1>Billy Cobham</h1>
                            <h2>Legendary Jazz Fusion Drummer</h2>
                            <p>Drumeo is the real deal folks! Jared Falk and his team have my confidence and support in what is done to promote music through the art of drumming and percussion. ...a good place to study and realize one’s dreams.</p>
                        </div>
                    </div>
                    <div class="instructor-wrap columns no-padding medium-6 vertical">
                        <div class="instructor-pic columns">
                            <div class="bg-pic" style="background-image:url('https://dpwjbsxqtam5n.cloudfront.net/books/best-beginner-drum-book/sales/nilles.jpg');"></div>
                        </div>
                        <div class="columns text text-left medium-text-center">
                            <h1>Anika Nilles</h1>
                            <h2>Drummer & Composer</h2>
                            <p>Jared Falk has a comprehensive expert knowledge in providing and structuring lesson plans. He has a great human sense and knows how to handle, host and guide a lesson. It certainly didn’t come overnight. It’s more that he grew over the years to an expert and a professional instructor who really knows how to teach.</p>
                        </div>
                    </div>
                    <div class="instructor-wrap columns no-padding medium-6 vertical">
                        <div class="instructor-pic columns">
                            <div class="bg-pic" style="background-image:url('https://dpwjbsxqtam5n.cloudfront.net/books/best-beginner-drum-book/sales/dornyei.jpg');"></div>
                        </div>
                        <div class="columns text text-left medium-text-center">
                            <h1>Gabor Dornyei</h1>
                            <h2>Educator, Clinician, and Session Drummer</h2>
                            <p>Working with Jared, Dave and the entire Drumeo team has been a life changing experience. These guys are not only the nicest people on Planet Earth, but the most focused and well prepared professionals, who work with infectious smiles on their faces and make you feel and sound the very BEST you can!</p>
                        </div>
                    </div>
                    <div class="instructor-wrap columns no-padding horizontal">
                        <div class="instructor-pic columns medium-5">
                            <div class="bg-pic" style="background-image:url('https://dpwjbsxqtam5n.cloudfront.net/books/best-beginner-drum-book/sales/garibaldi.jpg');"></div>
                        </div>
                        <div class="columns medium-7 text">
                            <h1>David Garibaldi</h1>
                            <h2>Drummer for Tower Of Power</h2>
                            <p>The Drumeo standard is one of the highest quality and is THE place to go for the best in drum education!</p>
                        </div>
                    </div>
                </div>
                <div class="columns no-padding medium-4">
                    <div class="instructor-wrap columns no-padding vertical">
                        <div class="instructor-pic columns">
                            <div class="bg-pic" style="background-image:url('https://dpwjbsxqtam5n.cloudfront.net/books/best-beginner-drum-book/sales/cooper.jpg');"></div>
                        </div>
                        <div class="columns text text-left medium-text-center">
                            <h1>Casey Cooper</h1>
                            <h2>The Most Subscribed Drummer On YouTube</h2>
                            <p>After years of watching Jared's lessons on YouTube and Drumeo, and getting to work side by side with him, I can confidently say that he gives every bit of his effort and skill into every product or lesson he teaches. He cares about each and every drummer who will watch and learn from his work and wants nothing more than to change drumming education for the better each time he puts his name on something.</p>
                        </div>
                    </div>
                    <div class="instructor-wrap columns no-padding vertical">
                        <div class="instructor-pic columns">
                            <div class="bg-pic" style="background-image:url('https://dpwjbsxqtam5n.cloudfront.net/books/best-beginner-drum-book/sales/browne.jpg');"></div>
                        </div>
                        <div class="columns text text-left medium-text-center">
                            <h1>Sean Browne</h1>
                            <h2>Int'l Product Manager, Yamaha Drums</h2>
                            <p>Drumeo does, through no shortage of sweat and passion for the instrument, elevate the online experience for novice and advanced drummers alike. On behalf of Yamaha Drums International, we congratulate Drumeo for the inspiration they evoke and the professionalism they present.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="foreword tab-switcher">
        <div class="row">
            <div class="columns text-center">
                <img src="https://dpwjbsxqtam5n.cloudfront.net/books/best-beginner-drum-book/sales/foreword.jpg">
            </div>
            <div class="columns">
                <p>I first saw Jared playing the drums on a Sunday evening in 1997, in a packed church full of over two thousand people. The music was great, but as a beginner drummer myself what brought me back each week was the sheer energy, creativity, and power of Jared’s drumming. It drew me in. Soon I connected with him to take lessons, and a friendship was born. Eventually we became business partners in the world’s largest online drum education company—Drumeo.
                    <br><br> Jared’s goal has long been to reach every drummer in the world. This book is the next step in his journey to do just that. He took the first step back in 2003, when he was an established private drum teacher who yearned to reach more drummers with the methods he believed in: Jared began filming videos of his drumming to share online in forums, and to sell on eBay. Back then the Internet was relatively new, but Jared was a visionary with his idea for sharing those videos online to reach even more drummers. Those initial videos immediately gathered a lot of attention, and in 2006, Jared released his first multi-disc instructional pack called the “Rock Drumming System”. It sold thousands of copies and paved the way for what became Drumeo.
                    <br><br> Jared’s philosophy has always been to “provide results” for students. With each lesson he published— regardless of the topic—his goal was to excite and motivate drummers enough to rush to their kits and practice. This approach worked so well that it eventually attracted the world’s best drummers and educators to Drumeo. Soon Jared was working alongside legendary drummers to create the most frequently-viewed drum lessons in the world. He was both teaching and producing lessons in ways that were consumable, motivational, and provided real progress for students. Working with such a diverse lineup of instructors, along with incorporating the ongoing feedback from real students, is what separates Jared from other teachers. It’s one of the many reasons Drumeo is so successful.
                    <br><br> As Drumeo continued to grow, Jared’s time was consumed by the business of online lessons. But his passion for teaching drummers never subsided, and he did not want to give up private teaching. He decided to take on just one student—as long as that student showed an intense passion for the drums and an equally unstoppable work ethic. The student was Brandon Toews—a young local drummer who admired what Jared had accomplished behind the kit. Brandon’s goal was (and is!) to become one of the best drummers in the world himself.
                    <br><br> It wasn’t long before Jared hired him to work as an intern at Drumeo, which eventually turned into a full-time position with the team. In 2015, Brandon enrolled at MacEwan University in Edmonton, Alberta to earn a Bachelor of Music degree in Jazz and Contemporary Popular Music. His extremely motivated work ethic catapulted him to a new level of drumming that impressed university faculty, his peers, and Jared. When Jared got the idea for
                    <em>The Best Beginner Drum Book</em>, he knew immediately that Brandon was the perfect drummer to co-write it.
                    <br><br> Together, Jared and Brandon focus simply on what you need to achieve your drumming goals. Their unique approach is to remove unnecessary and overly complex exercises. In my years of working with students and producing lessons at Drumeo, I have found that the best teachers are not those who tell you what you should practice, but rather the ones that tell you what not to practice. It might sound counterproductive, but removing excess noise from your routine is the best thing for a beginner. And as with anything in life, the best results come from a solid and simplified plan. Jared’s own success exemplifies this lesson, which Brandon (and I!) have taken to heart—and it’s clearly evident in this book. Inside is a simple guide to what beginner drummers need to know to take their drumming to new levels.
                    <br><br> This book is a culmination of more than twenty years of teaching, performing, recording, and working with best drummers in the industry. Its incomparable strength arises from being co-written by Jared’s protégé, a student who has tested these practices and ultimately used them to develop into a successful drummer and teacher himself.
                    <br><br> There has never been a drumming instruction book like this one. The title
                    <em>The Best Beginner Drum Book</em> is no exaggeration. <br><br> Cheers,<br>
                    <strong>Dave Atkinson</strong><br> <em>Content Director - Musora Media Inc.</em>
                </p>
            </div>
        </div>
    </section>

    <section class="jareds-letter tab-switcher">
        <div class="row">
            <div class="columns text-center">
                <img src="https://dpwjbsxqtam5n.cloudfront.net/books/best-beginner-drum-book/sales/jareds-letter.jpg">
            </div>
            <div class="columns">
                <p>Drums... I could never have guessed that I’d give and receive so much enjoyment from this primal instrument. But here I am: drums are my life.
                    <br><br> My parents didn’t have some grand plan that I should be a drummer. I was the one who requested a drum-set at fifteen, after watching a fellow student air drumming to a song in the high-school choir rehearsal. The theatrics and physicality of playing this instrument drew me in right away—and they still do.
                    <br><br> Playing hundreds of shows throughout high-school and taking private lessons from many different instructors really helped give me a broad perspective on various ways to learn and approach the drums. I learned even more after graduation by touring through the United States, Germany, Finland, Latvia, Estonia, and Canada. Now, with more than twenty years of drumming experience under my belt, I recognize countless benefits of drumming. The reasons I continue to practice and strive to improve have clarified over the years. But one suggestion I have for you before you delve into this book is to take some time to think about why you want to play drums.
                    <br><br> For me, it’s because I love making music and connecting with people. There are many ways to achieve that, but drums come the most naturally to me. For you, there could be many other reasons...
                    <br><br>
                    <strong>1. YOU WILL BE HEALTHIER!</strong> This is a hugely underrated aspect of playing the drums. You might occasionally see out of shape drummers, but more often than not someone playing drums often is doing a good job of keeping their cardio up. Studies have shown that rock drummers burn between 400-600 calories in an hour-long show
                    <br><br>
                    <strong>2. YOU WILL MAKE MORE FRIENDS!</strong> I work with musicians who play various instruments and I have to say, the drumming community is extra special. Drummers are normally at the back of the stage holding the entire band together: they are the foundation of the music. So when they get together as a community, they love to finally talk with people who share their appreciation for this amazing instrument. It’s hard to meet a drummer without becoming instant best buds!
                    <br><br>
                    <strong>3. YOU WILL FEEL LESS STRESSED!</strong> Growing up, I had three brothers and a sister. You can imagine that ours wasn’t a quiet household or one with much privacy. My older brother Joe loved to pester me, as I had a raging temper. He’d continue to push my buttons until everything in my path started flying across the room. But after finding the drums, I channeled much of that pent up energy and stress towards this forgiving instrument. It was such a huge stress reliever. I’m sure my parents loved it, since there weren’t so many holes in the walls after I started taking my anger out on the drums instead of the house!
                    <br><br>
                    <strong>4. YOU WILL GAIN A DEEPER APPRECIATION FOR MUSIC!</strong> Learning something new is always exciting, but one thing to remember is this: The more you know, the more you realize you don’t know. That is especially true with drumming and music. The more you know about music, the more you discover new things that you never heard before. To me, this is exciting because it offers endless scope for appreciation—even awe. To me, music is a perfect blend of science and art, so I become completely drawn in by the complexity and simplicity of how it all comes together.
                    <br><br>
                    <strong>5. YOU WILL BE SMARTER!</strong> Last but not least of these Top Five reasons to pick up your drumsticks is that you’ll get smarter. That’s not just something I’m making up: it’s a fact*. According to research, drummers have a rare ability to problem-solve and change those around them. Rock steady drummers can actually be smarter than their less rhythmically-focused bandmates! It could be you...
                    <br><br> * Jordan Taylor Sloan, “Science Shows How Drummers’ Brains Are Actually Different from Everybody Else’s.”
                    <em>Mic Network.</em> May 14, 2014.
                    <br><br> These are just five of the many reasons that you’ve made a great decision to start playing drums. As you begin to study and practice you’ll discover your own, as well as many of the hidden benefits I’ve seen and experienced over the past two decades.
                    <br><br> This book is your first step in learning the drums, and it offers a flexible foundation for building up your skills. Remember, when learning something new, everyone is different. What’s easy for one can be difficult for another. You’re not in competition with anyone but yourself. So take it easy on yourself: focus on learning just one new thing every time you sit down to practice. If you do that, then you’ll get better every day.
                    <br><br> I like to compare getting better at drums to watching grass grow (I know, I know, sounds boring, but hear me out). If you sit there and stare at the grass trying to “watch” it grow you won’t see anything. But if you water the grass, fertilize it, and then come back a few days later, you’ll notice it has grown a lot.
                    <br><br> Drumming is similar. You need to practice (develop skills) and study (gain knowledge). Instead of just sitting there waiting impatiently to become a rock star, do the work and enjoy the process of learning. You will become a better drummer.
                    <br><br> Now—it’s time to start drumming. <br><br> To your drumming success,<br>
                    <strong>Jared Falk</strong> <em>Drumeo Co-Founder & CEO</em>
                </p>
            </div>
        </div>
    </section>

    <section class="table-of-contents tab-switcher">
        <div class="row">
            <div class="columns">
                <h1>Table Of Contents</h1>
            </div>
            <div class="large-up-3 medium-up-2 chapter-grid">
                @include("drumeo.products.partials._beginner-book-popup", [
                "chapterNumber" => "1",
                "chapterSubTitle" => "Chapter 1 - Getting Started",
                "chapterTitle" => "The Drum Setup System"
                ])
                @include("drumeo.products.partials._beginner-book-popup", [
                "chapterNumber" => "2",
                "chapterSubTitle" => "Chapter 2 - Practicing",
                "chapterTitle" => "The Drum Efficiency Booster"
                ])
                @include("drumeo.products.partials._beginner-book-popup", [
                "chapterNumber" => "3",
                "chapterSubTitle" => "Chapter 3 - Learning Grips",
                "chapterTitle" => "Hand Technique Uncovered"
                ])
                @include("drumeo.products.partials._beginner-book-popup", [
                "chapterNumber" => "4",
                "chapterSubTitle" => "Chapter 4 - Learning Notation",
                "chapterTitle" => "Note Values Made Easy"
                ])
                @include("drumeo.products.partials._beginner-book-popup", [
                "chapterNumber" => "5",
                "chapterSubTitle" => "Chapter 5 - Learning Rudiments",
                "chapterTitle" => "The Rudimental Breakdown"
                ])
                @include("drumeo.products.partials._beginner-book-popup", [
                "chapterNumber" => "6",
                "chapterSubTitle" => "Chapter 6 - Learning Vocabulary",
                "chapterTitle" => "The Rock Drum Library"
                ])
                @include("drumeo.products.partials._beginner-book-popup", [
                "chapterNumber" => "7",
                "chapterSubTitle" => "Chapter 7 - Applying Techniques",
                "chapterTitle" => "The Technique Selector"
                ])
                @include("drumeo.products.partials._beginner-book-popup", [
                "chapterNumber" => "8",
                "chapterSubTitle" => "Chapter 8 - Developing Freedom",
                "chapterTitle" => "The Limb Independence Builder"
                ])
                @include("drumeo.products.partials._beginner-book-popup", [
                "chapterNumber" => "9",
                "chapterSubTitle" => "Chapter 9 - Learning Musical Styles",
                "chapterTitle" => "The Stylistic Method"
                ])
                @include("drumeo.products.partials._beginner-book-popup", [
                "chapterNumber" => "10",
                "chapterSubTitle" => "Chapter 10 - Playing To Music",
                "chapterTitle" => "The Musical Drummer"
                ])
                @include("drumeo.products.partials._beginner-book-popup", [
                "chapterNumber" => "11",
                "chapterSubTitle" => "Appendix - Investing",
                "chapterTitle" => "The Drummer's Buying Guide"
                ])
            </div>
        </div>
    </section>

    <div id="customize-anchor" class="anchor anchor-slide"></div>

    <div class="edge-banner text-center">
        <div class="row">
            <p><strong> ** Every Book Includes A Drumeo
                    <br class="hide-for-medium"> 30-Day Membership Pass ($29 Value) ** </strong></p>
        </div>
    </div>

    <section class="final-pitch">
        <div class="row">
            <div class="columns medium-6 float-right text-center">
                <img src="https://dpwjbsxqtam5n.cloudfront.net/books/best-beginner-drum-book/sales/book-pass-alt.png" class="book">
            </div>
            <div class="columns medium-6 text-wrap">
                <h1>The Best Beginner<br class="show-for-medium"> Drum Book</h1>
                <p>Get it today for just
                @if(Prices::$beginnerBookFull > Prices::$beginnerBookRegular)
                    <s>${{ Prices::$beginnerBookFull }}</s> ${{ Prices::$beginnerBookRegular }} USD
                @else
                    ${{ Prices::$beginnerBookRegular }} USD
                @endif
                </p>
                <a href="/laravel/public/shopping-cart/api/query?products[BeginnerBook]=1" class="join">Click Here To Order</a>
                <a target="_blank" href="https://www.amazon.com/dp/B07G8N348K" class="join orange">Get Your Copy On <img class="amazon inline-block" src="https://dpwjbsxqtam5n.cloudfront.net/books/best-beginner-drum-book/sales/amazon-logo.png"></a>
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
            @include('drumeo.products.partials.question-dropdown', [
            "question" => "How should I order in Canada/UK?",
            "answer" => "Canadian Drummers: <a target='_blank' href='https://www.amazon.ca/dp/B07G8N348K'>Click here to order through Amazon.ca</a>. <br>UK Drummers: <a target='_blank' href='https://www.amazon.co.uk/dp/B07G8N348K'>Click here to order through Amazon.co.uk</a>."
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
            @include('drumeo.products.partials.question-dropdown', [
            "question" => "How long will it take for the book to arrive?",
            "answer" => "If you order through this website (rather than Amazon), the shipping should take about this long, depending on your location:<br><br>- United States: 2-10 Business Days<br>- Everywhere Else: 7-20 Business Days"
            ])
            @include('drumeo.products.partials.question-dropdown', [
            "question" => "Do you have a digital version available? (e-book or audiobook)",
            "answer" => "Kindle Version: <a target='_blank' href='https://www.amazon.com/dp/B07TB4SN3V/'>Click here to order through Amazon.com</a>. <br>We'll be adding other digital versions in the future!"
            ])
            @include('drumeo.products.partials.question-dropdown', [
            "question" => "It says there’s a free 30-day membership pass to Drumeo. What’s that?",
            "answer" => "Drumeo is our award-winning online drum lessons experience, where you’ll get step-by-step video lessons from the best drummers and teachers in the world: <a target='_blank' href='https://www.drumeo.com/'>www.Drumeo.com/</a>.<br><br>We’ve included a free 30-day membership redemption pass inside every copy of The Best Beginner Drum Book, so once your book arrives you’ll get an amazing book PLUS video drum lessons for 30 days ($29 value)."
            ])
        </div>
        <div class="row">
            <div id="bulk-order-anchor" class="anchor columns"></div>
            <div id="bulkOrder" class="text-center">
                <h4 class="columns half-padding"><strong>Get a better rate when ordering in bulk.</strong></h4>
                <br><br>
                <form id="ajaxForm" class="ajax-form" name="drumeo" method="post" action="/form-mail/beginner-book.php">
                    <input type="hidden" name="subject" value="Bulk Order - Best Beginner Drum Book"/>
                    <input type="hidden" name="redirect" value="/drumshop/beginner-book/?thankyou"/>
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

    <div class="reveal large text-center" id="seeInside" data-reveal data-reset-on-close="true">
        <img src="https://dpwjbsxqtam5n.cloudfront.net/books/best-beginner-drum-book/sales/page-1-5.png">
        <img src="https://dpwjbsxqtam5n.cloudfront.net/books/best-beginner-drum-book/sales/page-6.png">
        <img src="https://dpwjbsxqtam5n.cloudfront.net/books/best-beginner-drum-book/sales/page-7.jpg">
        <img src="https://dpwjbsxqtam5n.cloudfront.net/books/best-beginner-drum-book/sales/page-8.jpg">
        <img src="https://dpwjbsxqtam5n.cloudfront.net/books/best-beginner-drum-book/sales/page-9.png">
        <img src="https://dpwjbsxqtam5n.cloudfront.net/books/best-beginner-drum-book/sales/page-10.png">
        <img src="https://dpwjbsxqtam5n.cloudfront.net/books/best-beginner-drum-book/sales/page-11.jpg">
        <img src="https://dpwjbsxqtam5n.cloudfront.net/books/best-beginner-drum-book/sales/page-12.jpg">
        <img src="https://dpwjbsxqtam5n.cloudfront.net/books/best-beginner-drum-book/sales/page-13.jpg">
        <div class="end-of-preview">
            <h1>The Book Preview Is Over.</h1>
            <p>Order Today To Get The <br class="hide-for-medium"> Full Book With 210 Pages</p>
        </div>
    </div>
@stop

@section('scripts')
    <script src="{{ asset('/marketing/js/sliding-anchor.js') }}"></script>
    <script>
        $(document).ready(function () {
            $(document).foundation();

            // Tab Switcher
            $('.sub-nav-link').click(function () {
                $('.sub-nav-link').removeClass('active');
                $(this).addClass('active');
                var currentTab = $(this).index();

                $('.tab-switcher').removeClass('active');
                $('.tab-switcher').eq(currentTab).addClass('active');
            });

            // Dropdown for FAQ section
            $('.question-dropdown').on('click', questionDropdown);

            function questionDropdown() {
                $(this).toggleClass('active');
                $(this).find('.fa-chevron-down').toggleClass('rotated');
            }

            //bulk order display
            $(".open-bulk").click(function (e) {
                e.preventDefault();
                $('#bulkOrder').addClass('active');
            });

            // Page Slider Modal
            var thumbnail = $('.background-wrap');
            var sliderOverlay = $('.slider-overlay');
            var sliderLightbox = $('.slider-lightbox');

            thumbnail.click(function () {
                currentSlide = $(this).parent().index();
                sliderLightbox.addClass('active');
                sliderOverlay.addClass('active');

                giveSlidesClass();
            });

            $('.close-modal').click(function () {
                closeSliderOverlay();
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
        });
    </script>
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>

    <script src="{{ asset('/marketing/js/drumeo/manifest.js') }}"></script>
    <script src="{{ asset('/marketing/js/drumeo/vendor.js') }}"></script>
    <script src="{{ asset('/marketing/js/drumeo/cart-sidebar.js') }}"></script>
    <script src="{{ asset('/marketing/js/drumeo/app.js') }}"></script>
@stop
