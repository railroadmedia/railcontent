@extends('drumeo.products.misc-products-layout')


@section('meta')
    @parent
    <title>Rock Drumming Masterclass | Drumeo</title>
    <meta name="description" content="Unlock your rock drumming potential in this exclusive 26-week masterclass with Todd Sucherman.">
    <meta property="og:image" content="https://dpwjbsxqtam5n.cloudfront.net/rock-drumming-masterclass/og-image.jpg" style="display: none;">
    <meta property="og:description" content="Unlock your rock drumming potential in this exclusive 26-week masterclass with Todd Sucherman.">
    <meta property="og:url" content="https://www.drumeo.com/{{ Request::path() }}">

    <link rel="stylesheet" href="{{ mix('marketing/css/app.css') }}">
@stop()

@section('head')
    @parent
    <link href="{{ asset('/marketing/parcel/drumeo/drum-shop-rdm.css') }}" rel="stylesheet">
    <?php \App\Analytics\Tracker::trackProductImpression('rock-drumming-masterclass'); ?>
@stop()

@section('scripts')
    @parent

    <script>
        $(function () {
            // Dropdown for FAQ section
            $('.question-dropdown').on('click', questionDropdown);

            function questionDropdown() {
                $(this).toggleClass('active');
                $(this).find('.fa-chevron-down').toggleClass('rotated');
            }

            $('#icon-grid .toggle').on('click', function () {
                $('#icon-grid .lesson-descriptions').addClass('active');
                $(this).addClass('active');
            });
        });
    </script>
    <script src="{{ asset('/marketing/js/modal-autoplay.js') }}"></script>
@stop()

@section('body-data')
    x-data="{ trailer: false }"
@endsection

@section('content')
    @include('drumeo.products.partials.promo-banner', [
        "name" => "Rock Drumming Masterclass",
        "fullPrice" => floatval($productPrices['rock-drumming-masterclass-pack']->price),
        "price" => floatval($productPrices['rock-drumming-masterclass-pack']->discounted_price),
        "noBreadcrumb" => true
    ])
    <header class="hero-header">
        <div class="row">
            <div class="columns video-wrap autoplay-video" @click="trailer = true;">
                <div class="play-icon"><i class="fas fa-play"></i></div>
                <div class="logo">
                    <p><em>Todd Sucherman's</em></p>
                        <img src="https://www.musora.com/musora-cdn/image/width=700,quality=85/https://dpwjbsxqtam5n.cloudfront.net/rock-drumming-masterclass/logo-white.png" alt="Rock Drummming Masterclass Logo" fetchpriority="high">
                </div>
            </div>
            <h3 class="columns">The Rock Drumming Masterclass is a
                <br class="show-for-medium-only">26-week online course with Todd Sucherman.</h3>

            <div class="columns"><a href="/ecommerce/add-to-cart?products[rock-drumming-masterclass-pack]=1" class="join blue">Get Started &raquo;</a></div>

            <p class="columns uppercase price">
                @if(floatval($productPrices['rock-drumming-masterclass-pack']->price) > floatval($productPrices['rock-drumming-masterclass-pack']->discounted_price))
                    <s>Normally ${{ floatval($productPrices['rock-drumming-masterclass-pack']->price) }}.</s> <strong>Only ${{ floatval($productPrices['rock-drumming-masterclass-pack']->discounted_price) }}.</strong> (Save {{ round(100 - (100 * (floatval($productPrices['rock-drumming-masterclass-pack']->discounted_price) / floatval($productPrices['rock-drumming-masterclass-pack']->price)))) }}%)
                @else
                    <strong>Now ${{ floatval($productPrices['rock-drumming-masterclass-pack']->discounted_price) }}.</strong>
                @endif

                <br>
                <u class="text-blue"><a href="/" style="color:inherit;">(Or get it free with Drumeo)</a></u>
                <br>
                <strong class="text-yellow">** 90-Day Guarantee **</strong>
            </p>
        </div>
    </header>

    <div id="lessons" class="anchor"></div>
    <section class="lesson-breakdown">
        <div class="row">
            <div class="columns">
                <h1>Rapidly Improve<br>
                    Your <strong> Rock Drumming</strong></h1>
            </div>
            <div class="columns tile-wrap small-up-1 medium-up-2 large-up-3">
                @include('drumeo.products.partials.lesson-tile', [
                "tileTitle" => "Must-Know Rock Beats",
                "tileDescription" => "Discover the straight rock beats that ALWAYS work -- and that everyone should know -- along with Todd’s advice for adding variations and texture within the grooves to make them your own. ",
                ])
                @include('drumeo.products.partials.lesson-tile', [
                "tileTitle" => "Effective Drum Fills",
                "tileDescription" => "The most effective rock drum fills are often much simpler than you’d think. Todd will share his toolkit of drum fills that EVERY rock drummer should be able to play like their life depended on it.",
                ])
                @include('drumeo.products.partials.lesson-tile', [
                "tileTitle" => "The Foundation Of Musicality",
                "tileDescription" => "Todd will share the “Rosetta Stone of 2 & 4” so you can decipher ALL there is to play in 4/4 backbeat time -- the foundation for becoming a musical drummer in a 20th century rock and roll context.",
                ])
                @include('drumeo.products.partials.lesson-tile', [
                "tileTitle" => "Bass Drum Combinations",
                "tileDescription" => "You’ll get extensive bass and double bass drum ideas that you can apply to a variety of musical situations, from more creative drum fills to creative hand/foot combinations and ending songs effectively.",
                ])
                @include('drumeo.products.partials.lesson-tile', [
                "tileTitle" => "Expressive Drum Solos",
                "tileDescription" => "Soloing gives you the opportunity to tell a story and make your own creative ideas come to life. Todd will give you the tools you need to orchestrate effective drum solos for a variety of musical situations.",
                ])
                @include('drumeo.products.partials.lesson-tile', [
                "tileTitle" => "Rhythmic Ear Training",
                "tileDescription" => "Rock drumming is more than a learned motion. This course will help you train your ears to hear the patterns within the patterns -- so you can explore your imagination for new rhythmic possibilities.",
                ])
                @include('drumeo.products.partials.lesson-tile', [
                "tileTitle" => "Better Hand Technique",
                "tileDescription" => "Get Todd’s best insights for improving your hand technique and natural motions for more speed, power, and longevity -- from holding your sticks to cymbal techniques for creating the sounds and patterns you want.",
                ])
                @include('drumeo.products.partials.lesson-tile', [
                "tileTitle" => "Utilizing Ghost Notes",
                "tileDescription" => "Add more flavor to your drumming by exploring the ghost note possibilities that Todd utilizes in his own performances, whether it’s a flurry of audible notes or soft comments between the accents.",
                ])
                @include('drumeo.products.partials.lesson-tile', [
                "tileTitle" => "Drum Rudiment Orchestrations",
                "tileDescription" => "Add the most effective rudiment orchestrations and variations to your arsenal, with exercises that will help you internalize the patterns and express them more effectively on the drum set. ",
                ])
                @include('drumeo.products.partials.lesson-tile', [
                "tileTitle" => "Shuffles And Variations",
                "tileDescription" => "Explore the most useful rock shuffles throughout history and the different ways you can play them predicated on the style, tempo, bass drum patterns, and hand patterns you choose. ",
                ])
                @include('drumeo.products.partials.lesson-tile', [
                "tileTitle" => "Linear Drumming Grooves",
                "tileDescription" => "Linear drumming is where no two sound sources play at the same time. You’ll dive into Gary Chaffee style linear drumming that uses a number system for creating your own ideas and figures. ",
                ])
                @include('drumeo.products.partials.lesson-tile', [
                "tileTitle" => "Exploring Your Creativity",
                "tileDescription" => "While you’ll explore the concepts that Todd uses in his own playing, you’ll be pushed to explore your own imagination and develop ideas that are uniquely YOURS (and have way more fun on the drums).",
                ])
            </div>
        </div>
    </section>

    <section id="icon-grid">
        <div class="row">
            <div class="title-text columns">
                <h1>THE EASIER WAY TO PRACTICE</h1>
                <p>Get 26 weekly lessons with hand-picked exercises so you always<br class="show-for-medium">
                    know exactly what to practice (and for exactly how long).</p>
            </div>
            <div class="columns small-up-1 medium-up-3">
                <div class="columns no-padding grid-item">
                    <div class="columns medium-2 icon-wrap">
                        <i class="fas fa-calendar-alt"></i>
                    </div>
                    <div class="columns medium-10 text-wrap">
                        <h2>Weekly Lesson Plans</h2>
                        <p>It’s easy to make progress when you know exactly what to do, and when to do it.</p>
                    </div>
                </div>
                <div class="columns no-padding grid-item">
                    <div class="columns medium-2 icon-wrap">
                        <i class="fas fa-signal-alt"></i>
                    </div>
                    <div class="columns medium-10 text-wrap">
                        <h2>All Skill Levels</h2>
                        <p>Each lesson will include tips for all levels - so any drummer can get practical results.</p>
                    </div>
                </div>
                <div class="columns no-padding grid-item">
                    <div class="columns medium-2 icon-wrap">
                        <i class="fas fa-video"></i>
                    </div>
                    <div class="columns medium-10 text-wrap">
                        <h2>Guided Video Lessons</h2>
                        <p>Learn at your own pace with Todd Sucherman’s easy-to-follow video lessons.</p>
                    </div>
                </div>
                <div class="columns no-padding grid-item">
                    <div class="columns medium-2 icon-wrap">
                        <i class="fas fa-cogs"></i>
                    </div>
                    <div class="columns medium-10 text-wrap">
                        <h2>More Effective Practice</h2>
                        <p>Don’t waste your practice time. Only work on the right exercises, at the right time.</p>
                    </div>
                </div>
                <div class="columns no-padding grid-item">
                    <div class="columns medium-2 icon-wrap">
                        <i class="fas fa-question"></i>
                    </div>
                    <div class="columns medium-10 text-wrap">
                        <h2>Personalized Support</h2>
                        <p>Need help? No problem! Get your biggest questions answered every step of the way.</p>
                    </div>
                </div>
                <div class="columns no-padding grid-item">
                    <div class="columns medium-2 icon-wrap">
                        <i class="fas fa-infinity"></i>
                    </div>
                    <div class="columns medium-10 text-wrap">
                        <h2>Lifetime Access</h2>
                        <p>Even though it’s a structured 26-week course, you’ll have lifetime access for life.</p>
                    </div>
                </div>
            </div>
            <div class="lesson-descriptions columns">
                @include('drumeo.products.partials.week-breakdown', [
                "weekNumber" => "1",
                "weekTitle" => "Introduction To Rock Drumming",
                "weekDate" => "Jul. 22",
                "weekDescription" => "Every drummer has their own heartbeat. You are the only YOU that exists. So you’ll get an introduction to rock drumming with some concepts that have been proven to work for most drummers, but you’ll also hear about some other ideas that might work better just for you!",
                "defaultOpen" => true
                ])
                @include('drumeo.products.partials.week-breakdown', [
                "weekNumber" => "2",
                "weekTitle" => "Rock Beats",
                "weekDate" => "Jul. 29",
                "weekDescription" => "We’re going to build your rock drumming from the bottom up by focusing on foundational beats, bass drum patterns, and how you express yourself within those parameters by HOW you hit the drums. The simplest grooves along with some tasteful variations can carry you a long way. "
                ])
                @include('drumeo.products.partials.week-breakdown', [
                "weekNumber" => "3",
                "weekTitle" => "Rock Fills",
                "weekDate" => "Aug. 5",
                "weekDescription" => "You don’t have to save the world with every drum fill you play. Simple fills work for a reason - they telegraph changes to other musicians and the listener. You’ll gain a series of simple fills that will always work in rock music and the guidance to play them with purpose and intent."
                ])
                @include('drumeo.products.partials.week-breakdown', [
                "weekNumber" => "4",
                "weekTitle" => "Song Forms",
                "weekDate" => "Aug. 12",
                "weekDescription" => "When you understand the form of a song you’re playing, you can get inside the music and sculpt the sections dynamically and emotionally. Todd will help you understand the foundations of songs and be able to map out songs -- the different sections and number of bars -- so you can feel the music and let it show you what it needs. "
                ])
                @include('drumeo.products.partials.week-breakdown', [
                "weekNumber" => "5",
                "weekTitle" => "The Motions of Drumming",
                "weekDate" => "Aug. 19",
                "weekDescription" => "Motion exercises are a great way to practice a few things at the same time -- including subdivisions, your timing, and your motions around the kit. You’ll become more comfortable with various sticking patterns and make practical improvements to your coordination. "
                ])
                @include('drumeo.products.partials.week-breakdown', [
                "weekNumber" => "6",
                "weekTitle" => "The Rosetta Stone - Part 1",
                "weekDate" => "Aug. 26",
                "weekDescription" => "You’ll get Todd’s “Rosetta Stone of 2 & 4”: the key to deciphering the ability to play WHATEVER you want in a 2&4 back beat 4/4 time context -- which is largely what drummers play in a late 20th century Rock & Roll context."
                ])
                @include('drumeo.products.partials.week-breakdown', [
                "weekNumber" => "7",
                "weekTitle" => "The Rosetta Stone - Part 2",
                "weekDate" => "Sep. 2",
                "weekDescription" => 'You will find new ways to go through "The Rosetta Stone of 2 & 4" to reinforce your back beats, add different variations, and improve your playing on so many levels. Your independence will grow by leaps and bounds.'
                ])
                @include('drumeo.products.partials.week-breakdown', [
                "weekNumber" => "8",
                "weekTitle" => "Ghost Notes - Part 1",
                "weekDate" => "Sep. 9",
                "weekDescription" => "Ghost Notes are the soft snare drum notes played in between the main back beat accent notes -- such as 2 & 4 or whatever accents you're playing - in any given time feel. You'll explore different possibilities for applying them in your drumming. "
                ])
                @include('drumeo.products.partials.week-breakdown', [
                "weekNumber" => "9",
                "weekTitle" => "Ghost Notes - Part 2",
                "weekDate" => "Sep. 16",
                "weekDescription" => "Ghost Notes add another voice and dimension to your time feels. In Part 2, you'll focus on the hands and take a look at the buzz roll, along with ideas for alternating accents to add more flavor to your grooves. "
                ])
                @include('drumeo.products.partials.week-breakdown', [
                "weekNumber" => "10",
                "weekTitle" => "Natural Motions",
                "weekDate" => "Sep. 23",
                "weekDescription" => "You'll dive into four of Todd's go-to techniques including shank tip hi-hat 16ths, the moeller method, flag-tip-snap ride cymbal technique (for swing and three note patterns), and hitting crashes with a glancing blow. "
                ])
                @include('drumeo.products.partials.week-breakdown', [
                "weekNumber" => "11",
                "weekTitle" => "Ear Training",
                "weekDate" => "Sep. 30",
                "weekDescription" => "It's vital to understand the relationship between the right and left hands in whatever you're playing. Anything you play on a drum is a two-note melody -- and Todd will help you understand the singular melody in each hand for when you're learning stickings or practicing rudiments. "
                ])
                @include('drumeo.products.partials.week-breakdown', [
                "weekNumber" => "12",
                "weekTitle" => "Six Stroke Rolls & Three Note Conjunctions",
                "weekDate" => "Oct. 7",
                "weekDescription" => "Todd will train you to think differently about three note triplet conjunctions (and the different ways to orchestrate the six stroke roll). You'll find all-new ideas come alive and take shape -- from a boring printed page and into the magical realm of music. "
                ])
                @include('drumeo.products.partials.week-breakdown', [
                "weekNumber" => "13",
                "weekTitle" => "What Does Music Mean?",
                "weekDate" => "Oct. 14",
                "weekDescription" => "Music encompasses the human experience: love, loss, joy, pain, happiness, fear, birth, death, surprise, elation. It can express every feeling and emotion that we experience -- and to become a great musician, and a great storyteller, you need to add emotion to your playing to convey ideas without words. "
                ])
                @include('drumeo.products.partials.week-breakdown', [
                "weekNumber" => "14",
                "weekTitle" => "Shuffles - Part 1",
                "weekDate" => "Oct. 21",
                "weekDescription" => "The shuffle feel emerged from the blues, and bluesy big band swing, through the birth of rock and roll. There are many kinds of shuffles and ways to play them predicated on the style, the tempo, bass drum patterns, and hand patterns you choose. We'll start with the Texas shuffle (or Chicago shuffle)."
                ])
                @include('drumeo.products.partials.week-breakdown', [
                "weekNumber" => "15",
                "weekTitle" => "Shuffles - Part 2",
                "weekDate" => "Oct. 28",
                "weekDescription" => "Todd will take you through some of the most popular shuffles including a Motown shuffle; some half-time shuffles made famous by Bernard Purdie, John Bonham, and Jeff Porcaro; Reggae time feels; and more -- and give you a handle on a variety of shuffle and swing time feels that will serve you well."
                ])
                @include('drumeo.products.partials.week-breakdown', [
                "weekNumber" => "16",
                "weekTitle" => "Hand To Foot Combinations - Part 1",
                "weekDate" => "Nov. 4",
                "weekDescription" => "It's time to work on some hand-foot combinations. Todd will introduce you to his Bass Drum Combination System -- along with a piece of music for applying your new found combinations to real music."
                ])
                @include('drumeo.products.partials.week-breakdown', [
                "weekNumber" => "17",
                "weekTitle" => "Hand To Foot Combinations - Part 2",
                "weekDate" => "Nov. 11",
                "weekDescription" => "Discover additional hand-foot combinations that you'll need to be effective in any rock setting. Todd will challenge you with more complex combination templates for a variety of musical situations -- and share the thought process behind the combinations so you can create your own series of numbers and orchestrations. "
                ])
                @include('drumeo.products.partials.week-breakdown', [
                "weekNumber" => "18",
                "weekTitle" => "Chaffee Style Linear Grooves - Part 1",
                "weekDate" => "Nov. 18",
                "weekDescription" => "It’s time to talk about linear drumming. Gary Chaffee came up with a number system for linear concepts that are incredibly deep -- and Todd will give you an introduction to these concepts and help you apply them in a truly fun and creatively useful way. "
                ])
                @include('drumeo.products.partials.week-breakdown', [
                "weekNumber" => "19",
                "weekTitle" => "Chaffee Style Linear Grooves - Part 2",
                "weekDate" => "Nov. 25",
                "weekDescription" => "You’ll dive deeper into the universe of linear drumming, exploring Gary Chaffee’s number system more intimately and finding new ways to apply linear patterns to various rock rhythms."
                ])
                @include('drumeo.products.partials.week-breakdown', [
                "weekNumber" => "20",
                "weekTitle" => "Creative Flow",
                "weekDate" => "Dec. 2",
                "weekDescription" => "It happens to the best of us: you’re trying to think up ideas to play, but they’re just not coming together. Todd will share a personal example of brainstorming different musical possibilities -- and the creative process he used when writing the groove for the song “Raven” from the Taylor Mills “Lullagoodbye” record."
                ])
                @include('drumeo.products.partials.week-breakdown', [
                "weekNumber" => "21",
                "weekTitle" => "Triplet Orchestrations",
                "weekDate" => "Dec. 9",
                "weekDescription" => "We'll dive into a series of triplet orchestrations around the drums - including ones made famous by drummers like John Bonham, Buddy Rich, and Steve Gadd. You'll see how the patterns can come together in a rock setting, orchestrated in different ways. "
                ])
                @include('drumeo.products.partials.week-breakdown', [
                "weekNumber" => "22",
                "weekTitle" => "Tuning & Rhythmic Bending",
                "weekDate" => "Dec. 16",
                "weekDescription" => "Rhythmic bending is basically stretching the time like a rubber band - blurring the line between triplets and some eighth and 16th note figures. Todd will share how these ideas can create musical tension and release in drum fill ideas."
                ])
                @include('drumeo.products.partials.week-breakdown', [
                "weekNumber" => "23",
                "weekTitle" => "Brushes in Rock",
                "weekDate" => "Dec. 23",
                "weekDescription" => "Every drummer, yes EVEN a rock drummer, should have a pair of brushes in their bag. Todd will share the many useful textures brushes can create in a pop-rock setting that goes beyond your regular jazz standards -- and then dive into some Styx licks so you can pull some ideas out for your own musical settings."
                ])
                @include('drumeo.products.partials.week-breakdown', [
                "weekNumber" => "24",
                "weekTitle" => " Solo Construction",
                "weekDate" => "Dec. 30",
                "weekDescription" => "The phrase &quot;music is a language&quot; isn't a cliche - it's the truth. There are many kinds of drum solos for many different musical situations. Todd will walk through some of the most common rock soloing ideas and share his creative tools for improvisation and saying something POWERFUL on the drums. "
                ])
                @include('drumeo.products.partials.week-breakdown', [
                "weekNumber" => "25",
                "weekTitle" => "Todd’s Drum Licks",
                "weekDate" => "Jan. 6",
                "weekDescription" => "Todd will share some of his favorite drum licks and challenge you to apply your toolbox of rock skills to the tracks (including &quot;Lunchroom Hoedown&quot; and a few grooves from Styx's &quot;The Mission&quot; album). "
                ])
                @include('drumeo.products.partials.week-breakdown', [
                "weekNumber" => "26",
                "weekTitle" => "Rock Drumming Philosophies",
                "weekDate" => "Jan. 13",
                "weekDescription" => "You're nearing the end of your 26-week journey with Todd -- and now you have an incredible foundation as a rock drummer for your own unique musical journey. Todd will share some parting thoughts to get your playing and career objectives in line so you can embark to the ports of your dreams. "
                ])
            </div>
            <span class="join outline toggle">Show All</span>
        </div>
    </section>

    <section class="meet-instructor">
        <div class="row">
            <div class="columns">
                <h1>Todd<br class="hide-for-medium"> Sucherman</h1>
                <p>Is Your Drum Teacher</p>
            </div>
            <div class="play-icon autoplay-video" data-open="trailer2"><i class="fas fa-play"></i></div>
        </div>
        <div class="reveal large trailer" id="trailer2" data-reveal data-reset-on-close="false">
            <div class="flex-video widescreen vimeo">
                <iframe class="reset-on-close" src="" data-lazy-load-url="//player.vimeo.com/video/307161724?autoplay=1" frameborder="0" allowfullscreen allow="autoplay"></iframe>
            </div>
        </div>
    </section>

    <section class="instructor-bio">
        <div class="row">
            <p class="columns">
                <span class="first-letter"><img class="transition-all opacity-0" src="https://dpwjbsxqtam5n.cloudfront.net/rock-drumming-masterclass/bold-t.png" alt="Alphabet T" onload="this.classList.remove('opacity-0')" loading="lazy"></span>odd Sucherman has played more than 2000 rock shows -- entertaining music fans around the world for more than 30 years. He’s been voted the “Best Rock Drummer” by the readers of Modern Drummer Magazine and hailed as the “Best Drum Clinician” by the readers of DRUM! Magazine -- releasing multiple award-winning educational DVDs and enjoying a 20+ year tenure with the legendary rock band Styx.
                <br><br>
                And for the next six months, Todd will be sharing his “keys to the kingdom” with students around the world through The Rock Drumming Masterclass -- a 26-week course that will give you the confidence you need to play ANY rock music you want.
                <br><br>
                “I’m going to give you one new lesson each week, for 26 weeks, so you always know exactly what to practice, for exactly how long, without any guesswork”, Todd explains. “And unlike other online masterclasses, you are going to be able to rack my brain -- asking me any question you have along the way and getting my personal feedback to help you overcome any obstacles and see real improvements in your playing.”
                <br><br>
                Students will receive weekly videos with unique exercises and assignments for each skill level -- so whether you’re a beginner, intermediate, or advanced player, you will be challenged in different ways to improve your skills and become the best rock drummer you can possibly be.
                <br><br>
                “I won’t just share my own style of playing rock,” Todd explains, “I’ll also show you how to express your own musical style and create your own identity on the drums. You will see results.”
                <br><br>
                The Rock Drumming Masterclass is delivered through the award-winning Drumeo platform, where you can access your weekly videos and assignments using any internet-ready computer, laptop, tablet, or smartphone. And while Todd will be personally supporting your journey for the entire 26-week masterclass, you’ll also have unlimited lifetime access to all of the videos and assignments.
                <br><br>
                Just click any of the big buttons on this page to take the first step towards making 2019 your best year ever on the drums.
            </p>
            <div class="columns timeline-pic">
                <img class="show-for-large transition-all opacity-0" src="https://www.musora.com/musora-cdn/image/width=1100,quality=85/https://dpwjbsxqtam5n.cloudfront.net/rock-drumming-masterclass/awards.png" alt="Awards Image" loading="lazy" onload="this.classList.remove('opacity-0')">
                <img class="hide-for-large transition-all opacity-0" src="https://dpwjbsxqtam5n.cloudfront.net/rock-drumming-masterclass/awards-m.png" alt="Awards Image" loading="lazy" onload="this.classList.remove('opacity-0')">
            </div>
        </div>
    </section>

    <section class="drummer-credits text-center">
        <div class="row">
            <h1>"Todd Sucherman is one of the<br class="show-for-medium">
                <strong>greatest rock drummers</strong> of our time."</h1>

            <div class="columns no-padding drummer-testimonial featured-testimonial">
                <div class="columns medium-5 large-4 picture">
                    <img class="drummer-pic transition-all opacity-0" src="https://www.musora.com/musora-cdn/image/width=500,quality=85/https://dpwjbsxqtam5n.cloudfront.net/rock-drumming-masterclass/testimonials/steve-smith.jpg" alt="Steve Smith" loading="lazy" onload="this.classList.remove('opacity-0')">
                </div>
                <div class="columns medium-7 large-8 text">
                    <h1>Steve Smith <span class="band">(Journey)</span></h1>
                    <h2>"Todd Sucherman is one of the premier drummers touring today..."</h2>
                    <p>There are times when his approach reminds me of the way I played with Journey in the late 70s and early 80s, except he’s much better than I was!  He perfected and honed the concept, infusing it with his deep musicianship and super chops. His musical development is inspiring and he continues to grow as a player.  We always have a great time hanging, trading ideas, and discussing music.  Carry on Todd!</p>
                </div>
            </div>

            <div class="columns no-padding drummer-testimonial">
                <div class="columns medium-4">
                    <img class="drummer-pic transition-all opacity-0" src="https://www.musora.com/musora-cdn/image/width=500,quality=85/https://dpwjbsxqtam5n.cloudfront.net/rock-drumming-masterclass/testimonials/will-calhoun.jpg" alt="Will CalHoun" loading="lazy" onload="this.classList.remove('opacity-0')">
                    <h1>Will Calhoun<br> <span class="band">(Living Colour)</span></h1>
                    <p>"Todd Sucherman is a great drummer. Although he’s most known for playing Rock-n-Roll, he possesses the facility and knowledge to play any style of music at a high level."</p>
                </div>
                <div class="columns medium-4">
                    <img class="drummer-pic transition-all opacity-0" src="https://www.musora.com/musora-cdn/image/width=500,quality=85/https://dpwjbsxqtam5n.cloudfront.net/rock-drumming-masterclass/testimonials/dave-dicenso.jpg" alt="Dave Discenso" loading="lazy" onload="this.classList.remove('opacity-0')">
                    <h1>Dave DiCenso<br> <span class="band">(Professor of Percussion at Berklee College of Music)</span></h1>
                    <p>"Todd Sucherman is one of the greatest rock drummers of our time. Brains, brawn, heart and soul - he has 'em all!"</p>
                </div>
                <div class="columns medium-4">
                    <img class="drummer-pic transition-all opacity-0" src="https://www.musora.com/musora-cdn/image/width=500,quality=85/https://dpwjbsxqtam5n.cloudfront.net/rock-drumming-masterclass/testimonials/simon-phillips.jpg" alt="Simon Phillips" loading="lazy" onload="this.classList.remove('opacity-0')">
                    <h1>Simon Phillips<br> <span class="band">(Toto, The Who, Judas Priest)</span></h1>
                    <p>"Whenever I get the opportunity to hear Todd play I am struck by his preciseness and musicality no matter what the musical setting might be."</p>
                </div>
            </div>

            <div class="columns no-padding drummer-testimonial featured-testimonial">
                <div class="columns medium-5 large-4 float-right picture">
                    <img class="drummer-pic transition-all opacity-0" src="https://www.musora.com/musora-cdn/image/width=500,quality=85/https://dpwjbsxqtam5n.cloudfront.net/rock-drumming-masterclass/testimonials/gavin-harrison.jpg" alt="Gavin Harrison" loading="lazy" onload="this.classList.remove('opacity-0')">
                </div>
                <div class="columns medium-7 large-8 text">
                    <h1>Gavin Harrison <span class="band">(Porcupine Tree)</span></h1>
                    <h2>"Todd is the most advanced drummer in the world right now… that has bought me a beer"</h2>
                    <p>&nbsp;</p>
                </div>
            </div>

            <div class="columns no-padding drummer-testimonial">
                <div class="columns medium-4">
                    <img class="drummer-pic transition-all opacity-0" src="https://www.musora.com/musora-cdn/image/width=500,quality=85/https://dpwjbsxqtam5n.cloudfront.net/rock-drumming-masterclass/testimonials/matt-garska.jpg" alt="Matt Garska" loading="lazy" onload="this.classList.remove('opacity-0')">
                    <h1>Matt Garstka<br> <span class="band">(Animals as Leaders)</span></h1>
                    <p>"Todd Sucherman is a legend. He is super clean, musical and really knows what he's doing. This polished playing only comes about after decades of touring and practice."</p>
                </div>
                <div class="columns medium-4">
                    <img class="drummer-pic transition-all opacity-0" src="https://www.musora.com/musora-cdn/image/width=500,quality=85/https://dpwjbsxqtam5n.cloudfront.net/rock-drumming-masterclass/testimonials/dave-mattacks.jpg" alt="Dave Dattacks" loading="lazy" onload="this.classList.remove('opacity-0')">
                    <h1>Dave Mattacks<br> <span class="band">(Fairport Convention)</span></h1>
                    <p>"I’m happy to endorse my chum Todd with this splendid Drumeo course.  Wherever you are along your drumming path, I can honestly say that “Todd hardly ever wrecks the music.”  Seriously though!  You’re in great hands here— double entendre intentional!"</p>
                </div>
                <div class="columns medium-4">
                    <img class="drummer-pic transition-all opacity-0" src="https://www.musora.com/musora-cdn/image/width=500,quality=85/https://dpwjbsxqtam5n.cloudfront.net/rock-drumming-masterclass/testimonials/gary-husband.jpg" alt="Gary Husband" loading="lazy" onload="this.classList.remove('opacity-0')">
                    <h1>Gary Husband<br> <span class="band">(Jazz & Rock drummer, pianist, and bandleader.)</span></h1>
                    <p>"It’s always just right-across-the-border drums excellence with Todd! Every time! No matter what the music. It’s the musician he is, primarily, also the warm spirit and how benevolent he is. The taste, the articulation, the feeling, his amazing sound ... all icing on an already delicious cake."</p>
                </div>
            </div>
        </div>
    </section>

    <section class="compare-table">
        <div class="row">
            <h1>UNLOCK YOUR UNFAIR ADVANTAGE</h1>
            <h3>while saving {{ round(100 - (100 * (round(floatval($productPrices['rock-drumming-masterclass-pack']->discounted_price) / 26, 2) / 30))) }}% or more <br class="hide-for-medium"> compared to private lessons.</h3>
            <table>
                <tbody>
                <tr>
                    <td></td>
                    <td>
                        <img src="https://www.musora.com/musora-cdn/image/width=400,quality=85/https://dpwjbsxqtam5n.cloudfront.net/rock-drumming-masterclass/laptop.png" class="macbook transition-all opacity-0" alt="Macbook Image" loading="lazy" onload="this.classList.remove('opacity-0')"><br>
                        <img src="https://www.musora.com/musora-cdn/image/width=400,quality=85/https://dpwjbsxqtam5n.cloudfront.net/rock-drumming-masterclass/logo.png" class="blue-logo transition-all opacity-0" alt="Masterclass Logo" loading="lazy" onload="this.classList.remove('opacity-0')">
                    </td>
                    <td><i class="fas fa-user gray-logo"></i><br>Private Lessons</td>
                </tr>
                <tr>
                    <td>Weekly Drum Lesson</td>
                    <td><i class="fas fa-check"></i></td>
                    <td><i class="fas fa-check"></i></td>
                </tr>
                <tr>
                    <td>Award-Winning Teacher</td>
                    <td><i class="fas fa-check"></i></td>
                    <td><i class="fas fa-minus"></i></td>
                </tr>
                <tr>
                    <td>Guided 26-Week Course</td>
                    <td><i class="fas fa-check"></i></td>
                    <td><i class="fas fa-minus"></i></td>
                </tr>
                <tr>
                    <td>100% Focused On Rock Drumming</td>
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
                    <td>Money Back Guarantee</td>
                    <td><i class="fas fa-check"></i></td>
                    <td><i class="fas fa-minus"></i></td>
                </tr>
                <tr class="prices">
                    <td>Your Total Investment</td>
                    <td>${{ round(floatval($productPrices['rock-drumming-masterclass-pack']->discounted_price) / 26, 2) }}/week</td>
                    <td>$30-50/week</td>
                </tr>
                </tbody>
            </table>
            <p class="columns">
                <strong>You can unlock the full 26-week course today</strong> to get Todd Sucherman’s masterclass for improving your skills -- <u>all for just ${{ round(floatval($productPrices['rock-drumming-masterclass-pack']->discounted_price) / 26, 2) }} per week</u> (billed at ${{ floatval($productPrices['rock-drumming-masterclass-pack']->discounted_price) }} for the entire course).
                <br><br>
                You can choose a one-time payment, a two-payment plan, or a five-payment plan -- and the entire course is yours for life with no recurring subscription or additional fees.
            </p>
        </div>
    </section>

    <section class="student-reviews">
        <div class="testimonial-section">
            <div class="row">
                <h1><strong>What past students are saying</strong> about<br class="show-for-medium"> Todd & the Rock Drumming Masterclass.</h1>
                @include('drumeo.products.partials._testimonial', [
                "avatarURL" => "https://dpwjbsxqtam5n.cloudfront.net/rock-drumming-masterclass/testimonials/students/Alan-Shaffer.jpg",
                "testimonialHighlight" => "If you’ve ever wondered “how do they do THAT?!”",
                "fullTestimonial" => "If you've seen a drummer live, or have heard fills or drum parts and wondered, &quot;How the hell does he do that?&quot;, well, it's explained in Rock Drumming Masterclass. You'll find out it's easier than you think. <br><br> Every week there's an &quot;ah-ha!&quot; moment to learn from. Todd shares 40 years of drumming expertise within a few months of lessons. There's nothing you can't practice or work on for the rest of your life. If there's a drum fill or phrase I need to work out and learn, I know where to go in the lessons. The information is there, word for word from Todd himself. <br><br> Todd will tell you point-blank what you've probably been doing wrong, and then show you how to correct it. There are several instances when he says, &quot;This is the only way to do it properly&quot;, and I wish someone had shown me these things years ago.",
                "name" => "Alan Shaffer",
                "location" => "Texas, USA"
                ])
                @include('drumeo.products.partials._testimonial', [
                "avatarURL" => "https://dpwjbsxqtam5n.cloudfront.net/rock-drumming-masterclass/testimonials/students/Pamm-Cobo.jpg",
                "testimonialHighlight" => "My drumming and musicianship is finally unlocked!",
                "fullTestimonial" => "It feels like life is now unlocked for all that it has to offer musically. It’s amazing to realize all the possibilities we have when playing the drums! Todd gave interesting tips that helped me understand how my body works, particularly when I learned that the moment we change the sticking, we change the melody. You will enjoy the ride with Todd. With his help, reaching your goals will be easier.",
                "name" => "Pamm Cobo",
                "location" => "Mexico"
                ])
                @include('drumeo.products.partials._testimonial', [
                "avatarURL" => "https://dpwjbsxqtam5n.cloudfront.net/rock-drumming-masterclass/testimonials/students/Rob-Scalici.jpg",
                "testimonialHighlight" => "I was skeptical about online instruction.",
                "fullTestimonial" => "I was skeptical about online instruction, but this has made me a believer. I’m now looking at drumming as a continuous learning journey as opposed to an ‘instant cure.’ Todd takes a no fluff, straight-to-the-point, no-magic-pill approach, which I really appreciate! I love the fact that you can continuously reference previous lessons, slow or speed up tempos, and see the instructor break it all down.",
                "name" => "Rob Scalici",
                "location" => "Michigan, USA"
                ])
                @include('drumeo.products.partials._testimonial', [
                "avatarURL" => "https://dpwjbsxqtam5n.cloudfront.net/rock-drumming-masterclass/testimonials/students/Shawn-Preston.jpg",
                "testimonialHighlight" => "I was squeezing my drum sticks too much.",
                "fullTestimonial" => "Rock Drumming Masterclass was a breath of fresh air. I was squeezing too much on the sticks before, and fixing that has made such a difference. After 25 years as a full time drumming professional, I’m already using the techniques learned here with my own students. The course is wonderfully conceived, well produced, and highly informative. It’s given me a new perspective!",
                "name" => "Shawn Preston",
                "location" => "Pennsylvania, USA"
                ])
                @include('drumeo.products.partials._testimonial', [
                "avatarURL" => "https://dpwjbsxqtam5n.cloudfront.net/rock-drumming-masterclass/testimonials/students/Michael-Malo.jpg",
                "testimonialHighlight" => "I can play just about anything on the fly!",
                "fullTestimonial" => "The really powerful thing about Rock Drumming Masterclass is that while each lesson focuses on very specific things, you’ll notice how they’re all connected as your playing evolves. Now when I start jamming along to a song, I can play just about any sticking or fills on the fly. My hands seem to know how to resolve patterns without thinking. This course proves that with the right material and some honest work and discipline, you can vastly improve your musicianship! <br><br> Dear future students: if you choose RDM, you will be given the keys to open some very important doors in your musical career. It will not only change how you play, but how you learn, too! I can’t think of another class that offers you as many crucial tools to become a seriously great drummer. Don’t pass up this chance!",
                "name" => "Michael Malo",
                "location" => "Quebec, Canada"
                ])
                @include('drumeo.products.partials._testimonial', [
                "avatarURL" => "https://dpwjbsxqtam5n.cloudfront.net/rock-drumming-masterclass/testimonials/students/Robert-Abraham.jpg",
                "testimonialHighlight" => "This is my road map for getting better.",
                "fullTestimonial" => "Step by step, Todd ‘peels the onion’. Step by step, each week builds on the prior week. He comes off as a relatable teacher who's been where we are and remembers that - not someone who’s looking down his nose at us. I now have a road map to follow to get better. That's the simple truth. Rock Drumming Masterclass is the gift that will keep on giving.",
                "name" => "Robert Abraham",
                "location" => "California, USA"
                ])
            </div>
        </div>
    </section>

    <section class="text-center guarantee">
        <div class="row">
            <img class="guarantee-badge hide-for-medium transition-all opacity-0" src="https://www.musora.com/musora-cdn/image/width=150,quality=85/https://dpwjbsxqtam5n.cloudfront.net/sales/guarantee-badge.png" loading="lazy" onload="this.classList.remove('opacity-0')" alt="Guarantee Badge">
            <div class="flex-container">
                <img class="guarantee-badge show-for-medium transition-all opacity-0" src="https://www.musora.com/musora-cdn/image/width=200,quality=85/https://dpwjbsxqtam5n.cloudfront.net/sales/guarantee-badge.png" alt="Guarantee Badge" loading="lazy" onload="this.classList.remove('opacity-0')">
                <div class="text-wrap text-left">
                    <h1>90-Day Money-Back Guarantee</h1>
                    <p><strong>OUR PROMISE TO YOU:</strong> More than anything, we want you to enjoy a super-positive experience on the drums. And that means we only want you to pay if you actually LOVE your Rock Drumming Masterclass experience. So click any of the big buttons on this page to get started risk-free. If it’s not for you, simply <a class="text-white" href="{{ get_musora_brand_base_url() }}/contact">contact us</a> within 90 days for a full refund.</p>
                </div>
            </div>
        </div>
    </section>

    <section class="final">
        <div id="customize-anchor" class="anchor"></div>
        <div class="row">
            <div class="columns logo"><img class="transition-all opacity-0" src="https://www.musora.com/musora-cdn/image/width=750,quality=85/https://dpwjbsxqtam5n.cloudfront.net/rock-drumming-masterclass/logo-white.png" alt="Rock Drumming Masterclass Logo" loading="lazy" onload="this.classList.remove('opacity-0')"></div>

            <h1 class="columns">
                Todd Sucherman’s 26-Week Online <br class="hide-for-large">
                Course For Just ${{ round(floatval($productPrices['rock-drumming-masterclass-pack']->discounted_price) / 26, 2) }} Per Week</h1>

            <div class="columns"><a href="/ecommerce/add-to-cart?products[rock-drumming-masterclass-pack]=1" class="join blue">Get Started &raquo;</a></div>

            <h2 class="columns uppercase">
                @if(floatval($productPrices['rock-drumming-masterclass-pack']->price) > floatval($productPrices['rock-drumming-masterclass-pack']->discounted_price))
                    <s>Normally ${{ floatval($productPrices['rock-drumming-masterclass-pack']->price) }}.</s> <strong>Only ${{ floatval($productPrices['rock-drumming-masterclass-pack']->discounted_price) }}.</strong> (Save {{ round(100 - (100 * (floatval($productPrices['rock-drumming-masterclass-pack']->discounted_price) / floatval($productPrices['rock-drumming-masterclass-pack']->price)))) }}%)
                @else
                    <strong>Now ${{ floatval($productPrices['rock-drumming-masterclass-pack']->discounted_price) }}.</strong>
                @endif
                <br>
                <u class="text-blue"><a href="/" style="color:inherit;">(Or get it free with Drumeo)</a></u>
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


    <section class="questions">
        <div class="row">
            <h1 class="columns upper">Still Have Questions?</h1>
            <div class="columns">
                @include('_partials.components.question-dropdown', [
                "num" => "?",
                "title" => "When does the course officially start?",
                "desc" => "You’ll get the entire 26-week course immediately, so you can start on your own schedule."
                ])
                @include('_partials.components.question-dropdown', [
                "num" => "?",
                "title" => "Do these lessons work for electronic and acoustic drum-sets?",
                "desc" => "Yes, the lessons will work on both electric and acoustic drum-sets. While you’ll even gain plenty of value with just a practice pad, it’s recommended that you have access to a drum set to get the most from this course."
                ])
                @include('_partials.components.question-dropdown', [
                "num" => "?",
                "title" => "How much time per week will this course require?",
                "desc" => "For time invested, obviously the more time you practice the faster you’ll get better. But we recommend investing at least 2-3 hours per week to truly benefit from this course."
                ])
                @include('_partials.components.question-dropdown', [
                "num" => "?",
                "title" => "Will I still have full access to the course after 26 weeks?",
                "desc" => "Yes! Even though it’s a week-by-week course, you’ll have LIFETIME online access to everything inside The Rock Drumming Masterclass, so you can review the materials or re-watch the lessons, anytime."
                ])
                @include('_partials.components.question-dropdown', [
                "num" => "?",
                "title" => "What if I can’t follow the lessons EVERY week?",
                "desc" => "You’ll get 26 weekly lessons and exercises. And while they’re intended to be completed week-after-week, we know that everybody’s schedules are different - so we’ve included progress-tracking so you never lose your spot. If you need to miss a week, that’s fine! You might need to review the previous lessons a bit before continuing again, but you’ll never lose your spot and once you’ve registered, you have unlimited access to the entire course for life."
                ])
            </div>
        </div>
    </section>

    @include('_partials.components.video-modal',[
        'name' => 'trailer',
        'video' => '400735162',
        'vimeo' => true,
    ])
@stop
