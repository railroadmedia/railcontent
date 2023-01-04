@extends('guitareo.products.guitar-quest.guitar-quest-layout')

@section('meta')
    @parent
    <title>GuitarQuest | Your Guitar Journey Starts Here</title>
    <meta name="description" content="Rob Scallon’s online guitar lessons for getting started on the guitar and making your favorite musical projects come to life."/>

    <meta property="og:url" content="https://www.guitareo.com/guitar-quest/testimonials"/>
    <meta property="og:title" content="GuitarQuest | Your Guitar Journey Starts Here"/>
    <meta property="og:description" content="Rob Scallon’s online guitar lessons for getting started on the guitar and making your favorite musical projects come to life."/>
    <meta property="og:image" content="https://musora.imgix.net/https%3A%2F%2Fd122ay5chh2hr5.cloudfront.net%2Fguitarquest%2Fassets%2Fshare-image.png?auto=format&ixlib=php-1.2.1&w=1500&s=4294b260a12b5d809a9b8182414e2312"/>
@stop()

@section('styles')
    @parent
    <link href="{{ asset('marketing/parcel/guitareo/nav-footer.css') }}" rel="stylesheet">
    <link href="{{ asset('marketing/parcel/guitareo/fonts.css') }}" rel="stylesheet">
    <link href="{{ asset('marketing/parcel/guitareo/guitar-quest.css') }}" rel="stylesheet">
    <style>
        h1 strong, h2 strong, h3 strong, h4 strong, h5 strong, h6 strong {
            font-weight: 900;
        }
        h1, h2, h3, h4, h5, h6, li, p {
            font-weight: 400;
            line-height: 1em;
            font-family: 'Open Sans', sans-serif;
            margin: 0 auto;
        }
        h1 sup, h2 sup, h3 sup, h4 sup, h5 sup, h6 sup, li sup, p sup {
            font-size: 50%;
            top: -0.75em;
        }
        h1 {
            line-height: 1.2em;
            font-size: 24px;
        }
        @media (min-width: 40em) {
            h1 {
                font-size: 36px;
            }
        }
        @media (min-width: 64em) {
            h1 {
                font-size: 48px;
            }
        }
        h4 {
            font-size: 16px;
        }
        @media (min-width: 40em) {
            h4 {
                font-size: 20px;
            }
        }
        @media (min-width: 64em) {
            h4 {
                font-size: 24px;
            }
        }
        p {
            margin-bottom:0;
            line-height: 1.6em;
            font-size: 15px;
        }
        @media (min-width: 64em) {
            p {
                font-size: 16px;
            }
        }
        img {
            display: inline-block;
        }
        .button {
            user-select: none;
            border-radius: 900px;
            background: #ffb100;
            color: #000718;
            border: 2px solid #ffb100;
            font: 700 15px/1em 'Roboto Condensed', sans-serif;
            transition-property: background-color, border-color, color, fill, stroke;
            transition-duration: 300ms;
            text-transform: uppercase;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
            padding: 11px 0;
        }
        .button:hover {
            background: #ffc133;
            border-color: #ffc133;
            color: #000718;
        }
        .button.outline {
            background: transparent;
            color: #ffb100;
        }
        .button.outline:hover {
            background: #ffc133;
            color: #000718;
        }
        .anchor {
            display: block;
            position: relative;
            visibility: hidden;
            top: -40px;
        }
        @media (min-width: 40em) {
            .anchor {
                top: -130px;
            }
        }

        .header {
            background:#000512 url(https://cdn.musora.com/image/fetch/w_750,q_60,q_auto:best/https://guitareo.s3.amazonaws.com/guitarquest/assets/testimonials/gq-testimonial-header-mobile.png) center center/cover;
            padding-bottom:120%;
        }

        @media (min-width:40em) {
            .header {
                background-image:url(https://cdn.musora.com/image/fetch/w_2500,q_60,q_auto:best/https://guitareo.s3.amazonaws.com/guitarquest/assets/testimonials/gq-testimonial-header.png);
                padding-bottom:41.667%;
            }
        }
        .topic-link-wrap-shim {
            height: 82px;
        }
        @media (min-width: 64em) {
            .topic-link-wrap-shim {
                height: 70px;
            }
        }
        @media (min-width: 40em) {
            .topic-link-wrap {
                margin-top: -82px;
            }
        }
        @media (min-width: 64em) {
            .topic-link-wrap {
                margin-top: -67px;
            }
        }
        @media (min-width: 40em) {
            .topic-link-wrap.stick-to-top {
                top: 56px;
                background: #222;
                box-shadow: 0 0 5px rgba(0, 0, 0, .1);
                position: fixed;
                left: 0;
                right: 0;
                margin-top: 0;
            }
        }
        @media (min-width: 40em) {
            .topic-link-wrap .button.active {
                background: #FFB500;
                color: #000;
                cursor: default;
            }
        }
        @media (min-width: 40em) {
            .quote-wrap {
                width: calc(100% - 128px);
            }
        }
        @media (min-width: 64em) {
            .quote-wrap {
                width: calc(100% - 176px);
            }
        }
    </style>
@stop()

@section('scripts')
    @parent
    <script src="{{ asset('marketing/parcel/drumeo/navigation-sales.js') }}"></script>
    <script type="text/javascript">
        $(document).ready(function () {
            //sub nav sticky function
            var navigation = $(".topic-link-wrap");
            var navigationLinks = $(".topic-link");

            $(window).scroll(function () {
                var header = $(".topic-link-wrap-shim").offset().top;
                var motivated = $('#motivated').offset().top - 50;
                var faster = $('#faster').offset().top - 150;
                var order = $('.tw-py-24.tw-bg-top.tw-bg-cover').offset().top - 150;

                if ($(this).scrollTop() > (header - 50) && $(this).scrollTop() < order) {
                    navigation.addClass('stick-to-top');
                    navigationLinks.removeClass('active');
                    $(".topic-link.motivated").addClass('active');
                } else {
                    navigationLinks.removeClass('active');
                    navigation.removeClass('stick-to-top');
                }

                if ($(this).scrollTop() > motivated && $(this).scrollTop() < faster) {
                    navigationLinks.removeClass('active');
                    $(".topic-link.motivated").addClass('active');
                }

                if ($(this).scrollTop() > faster && $(this).scrollTop() < order) {
                    navigationLinks.removeClass('active');
                    $(".topic-link.faster").addClass('active');
                }
            });

        });
    </script>
@stop()

@section('content')
    @include("guitareo.sales.partials._nav")
    @php
        $orderLink = '/ecommerce/add-to-cart?products[guitar-quest]=1&redirect=/order&payment-plan=1';
        $orderLinkAlt = '/ecommerce/add-to-cart?products[guitar-quest]=1&redirect=/order&payment-plan=5';
        $productPrice = floatval($productPrices['guitar-quest']->discounted_price)
    @endphp

    <header class="header">
        <div class="tw-container tw-mx-auto"></div>
    </header>

    <section class="tw-py-8 md:tw-py-12 lg:tw-py-14 tw-text-center tw-text-white" style="background-color:#000512;">
        <div class="tw-container tw-mx-auto" style="max-width: 870px;">
            <div class="tw-w-full tw-px-3 md:tw-px-4 ">
                <img class="tw-max-w-xs md:tw-max-w-sm lg:tw-max-w-md tw-mb-2 md:tw-mb-3" src="https://d122ay5chh2hr5.cloudfront.net/guitarquest/assets/guitar-quest-logo.png"><br>
                <h4 class="tw-mb-4 md:tw-mb-6"><em>What are new guitarists saying?</em></h4>
            </div>
            <div class="topic-link-wrap-shim tw-px-3 md:tw-px-4 tw-w-full tw-hidden md:tw-inline-block"></div>
            <div class="topic-link-wrap tw-w-full tw-z-50 tw-p-2 md:tw-p-3 tw-w-full clearfix">
                <div class="tw-mx-auto tw-flex" style="max-width:560px">
                    <div class="tw-px-2 tw-w-full md:tw-w-1/2">
                        <a class="button outline tw-mb-3 md:tw-mb-0 tw-w-full tw-block anchor-slide topic-link motivated" href="#motivated">Stay <br class="tw-hidden sm:tw-inline md:tw-hidden"> Motivated</a>
                    </div>
                    <div class="tw-px-2 tw-w-full md:tw-w-1/2">
                        <a class="button outline tw-mb-3 md:tw-mb-0 tw-w-full tw-block anchor-slide topic-link faster" href="#faster">Learn<br class="tw-hidden sm:tw-inline md:tw-hidden"> Faster</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="tw-text-center tw-px-4 md:tw-px-8 tw-text-white" style="background-color:#000512;">
        <div id="motivated" class="anchor"></div>
        <div class="tw-container tw-mx-auto" style="max-width: 850px;">
            <h1 class="font-bison-bold tw-leading-none tw-text-3xl md:tw-text-6xl lg:tw-text-7xl tw-mb-12 md:tw-mb-20 lg:tw-mb-28"><strong>STAY MOTIVATED <br class="tw-inline md:tw-hidden"> & HAVE FUN</strong></h1>
            <div class="tw-flex tw-flex-wrap">
                @php
                    $testimonials = [
                        [
                        "name" => "Patrizia",
                        "location" => "Germany",
                        "image" => "https://guitareo.s3.amazonaws.com/guitarquest/assets/testimonials/patrizia-germany.jpg",
                        "highlight" => "I finally feel like I’m able to learn the guitar.",
                        "testimonial" => "GuitarQuest focuses on smaller tasks and achievements along the way to make you feel like you’re improving. In level four, I played the G chord for the first time without any pain in my hands. I finally feel like I’ll really be able to learn the guitar and succeed! This course is SO much fun and keeps me motivated!",
                        ],
                        [
                        "name" => "Taw",
                        "location" => "Dundee, Scotland",
                        "image" => "https://guitareo.s3.amazonaws.com/guitarquest/assets/testimonials/taw-scotland.jpg",
                        "highlight" => "The game style of learning makes it more fun.",
                        "testimonial" => "Having the guitar lessons in a game style makes learning much more fun. When I learned the campfire chords, I could finally play along with other songs.",
                        ],
                        [
                        "name" => "Randy",
                        "location" => "Würzburg, Germany",
                        "image" => "https://guitareo.s3.amazonaws.com/guitarquest/assets/testimonials/randy-germany.jpg",
                        "highlight" => "I’m hooked! I’m practicing & playing guitar for hours now.",
                        "testimonial" => "GuitarQuest helped break down a wall between learning and fun that I didn’t think was possible. I jumped right into writing a song and jamming with people and playing for three hours instead of my normal one-hour practice. I’m hooked!",
                        ],
                        [
                        "name" => "Jan",
                        "location" => "Karlsruhe, Germany",
                        "image" => "https://guitareo.s3.amazonaws.com/guitarquest/assets/testimonials/jan-karlsruhe-germany.jpg",
                        "highlight" => "A lighthearted approach that’s fun and encouraging!",
                        "testimonial" => "GuitarQuest encouraged me to look at the guitar differently and think about creating my own melodies that “trick me into practicing.” It taught me to not cling to perfection when playing chords but have a “just do it and find out” attitude which is much less pressure when sitting down with the guitar. It has a lighthearted approach which makes it fun and encouraging!",
                        ],
                        [
                        "name" => "Jamie",
                        "location" => "Nova Scotia, Canada",
                        "image" => "https://guitareo.s3.amazonaws.com/guitarquest/assets/testimonials/jamie-nova-scotia.jpg",
                        "highlight" => "I’ve never felt so much JOY playing the guitar.",
                        "testimonial" => "When I finished the first lesson, I had a feeling of joy that I’ve never had before when playing guitar. I'm experimenting a lot more and improving my technique. The goal-based learning makes each set of lessons more entertaining and a feeling of accomplishment when completed.",
                        ],
                        [
                        "name" => "Nick",
                        "location" => "Oregon, USA",
                        "image" => "https://guitareo.s3.amazonaws.com/guitarquest/assets/testimonials/guitar-1.jpg",
                        "highlight" => "One of the most fun experiences I’ve had playing guitar.",
                        "testimonial" => "Playing the song with the full band so early on in the lessons was one of the most fun experiences I’ve had playing guitar. GuitarQuest removed the chore aspect of learning to play guitar and so far hasn’t been repetitive or boring!",
                        ],
                        [
                        "name" => "Sean",
                        "location" => "Seattle, USA",
                        "image" => "https://guitareo.s3.amazonaws.com/guitarquest/assets/testimonials/sean-seattle.jpg",
                        "highlight" => "Feels like a big brother teaching you how to bang out Nirvana songs!",
                        "testimonial" => "GuitarQuest is accessible with quick tips on simple, but powerful techniques. And thanks to Rob, it feels like a big brother teaching you how to bang out Nirvana songs. I’m playing with more awareness and understanding of the fretboard and find innovative ways to play. GuitarQuest lays out the next steps naturally instead of being intimidated by practice routines. More lessons like this, please!",
                        ],
                        [
                        "name" => "Ashton",
                        "location" => "Texas, USA",
                        "image" => "https://guitareo.s3.amazonaws.com/guitarquest/assets/testimonials/guitar-2.jpg",
                        "highlight" => "More interesting, engaging, and educational than other courses.",
                        "testimonial" => "My playing is experimental, so this course helped me explore more methods I've never tried before that I can apply to my playing. GuitarQuest puts a different spin on learning guitar that’s more interesting, engaging, and educational than any other course I’ve seen. It feels like being part of one of Rob’s YouTube videos, so it’s a lot of fun! GuitarQuest is just fun!",
                        ],
                        [
                        "name" => "Allan",
                        "location" => "California, USA",
                        "image" => "https://guitareo.s3.amazonaws.com/guitarquest/assets/testimonials/allan-california.jpg",
                        "highlight" => "The “silly” aspect of GuitarQuest makes the learning fun.",
                        "testimonial" => "I have already picked up a couple of ideas I’ve never thought of before in my guitar playing. GuitarQuest has a silly and experimental aspect that makes learning and playing fun. It isn’t too heavy and I'm approaching power chords which I’ve never tried before. I’m having fun and have a new experimentation direction to take my playing.",
                        ],
                        [
                        "name" => "Elliot",
                        "location" => "Groningen, Netherlands",
                        "image" => "https://guitareo.s3.amazonaws.com/guitarquest/assets/testimonials/elliot-netherlands.jpg",
                        "highlight" => "The humor definitely made it NOT boring.",
                        "testimonial" => "They weren’t kidding about making GuitarQuest the least boring guitar course out there. The roleplaying aspect kept me engaged and the humor made it way less intimidating. I didn’t expect to have so much creative energy flow and I was even singing along to the songs. I’m experimenting with the new techniques I learned and trying to write another song. Honestly, GuitarQuest is just fun!",
                        ],
                        [
                        "name" => "Lukas",
                        "location" => "Germany",
                        "image" => "https://guitareo.s3.amazonaws.com/guitarquest/assets/testimonials/guitar-3.jpg",
                        "highlight" => "The quests are fun and motivating.",
                        "testimonial" => "GuitarQuest has a defined structure and steps to take towards progression. Rob made the videos and quests more fun and motivating! I am better at strumming and improvising than I was before!",
                        ],
                    ]
                @endphp
                @foreach($testimonials as $testimonial)
                    <div class="tw-text-white tw-text-center tw-pb-12 md:tw-pb-24">
                        <img class="tw-float-left tw-rounded-full tw-overflow-hidden tw-hidden md:tw-inline-block md:tw-w-32 lg:tw-w-44" src="{{ $testimonial['image'] }}">
                        <div class="quote-wrap md:tw-pl-5 lg:tw-pl-10 tw-float-left tw-text-center md:tw-text-left">
                            <h4 class="tw-text-left tw-leading-none tw-mb-3 md:tw-mb-4 lg:tw-mb-5"><em>"{!! $testimonial['highlight'] !!}"</em></h4>
                            <p class="tw-text-left tw-leading-relaxed tw-mx-auto">{!! $testimonial['testimonial'] !!}</p>
                            <img class="tw-w-28 tw-rounded-full tw-inline md:tw-hidden tw-mt-4" src="{{ $testimonial['image'] }}">
                            <p class="text-goldenrod tw-leading-none tw-mx-auto tw-mt-4 lg:tw-mt-5"><strong>{{ $testimonial['name'] }}</strong><br class="tw-inline md:tw-hidden"><span class="tw-hidden md:tw-inline"> - </span><span>{{ $testimonial['location'] }}</span></p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <section class="tw-text-center tw-px-4 md:tw-px-8 tw-text-white" style="background-color:#000512;">
        <div id="faster" class="anchor"></div>
        <div class="tw-container tw-mx-auto" style="max-width: 850px;">
            <h1 class="font-bison-bold tw-leading-none tw-text-3xl md:tw-text-6xl lg:tw-text-7xl tw-pt-12 md:tw-pt-16 lg:tw-pt-18 tw-mb-12 md:tw-mb-20 lg:tw-mb-28"><strong>LEARN FASTER <br class="tw-inline md:tw-hidden"> & PLAY SONGS</strong></h1>
            <div class="tw-flex tw-flex-wrap">
                @php
                    $testimonials = [
                        [
                        "name" => "Mindy",
                        "location" => "Iowa, USA",
                        "image" => "https://guitareo.s3.amazonaws.com/guitarquest/assets/testimonials/mindy-iowa.jpg",
                        "highlight" => "I play guitar on a daily basis now.",
                        "testimonial" => "I really liked the jingle chapter because it hit on so many genres to learn and the punk show helped me work on my speed. Learning notes on the E string helped me connect the scales on the fretboard. The entertainment value in GuitarQuest is great and the chapters keep you motivated. I’m constantly playing on a daily basis!",
                        ],
                        [
                        "name" => "Kevin",
                        "location" => "Washington, USA",
                        "image" => "https://guitareo.s3.amazonaws.com/guitarquest/assets/testimonials/kevin-washington.jpg",
                        "highlight" => "It changed my view on what I can accomplish on the guitar.",
                        "testimonial" => "I needed guitar lessons that weren’t boring and kept me engaged and started seeing results. So when I found GuitarQuest, I had to try it! I looked forward to learning and continuously want to get better and improve on what the course has taught me so far. The best part is that it’s taught by one of my favorite musicians, Rob Scallon! I feel like I found what I’ve been looking for in a guitar course and I feel like I can accomplish what I want on the guitar.",
                        ],
                        [
                        "name" => "Norbert",
                        "location" => "Oradea, Romania",
                        "image" => "https://guitareo.s3.amazonaws.com/guitarquest/assets/testimonials/norbert-romania.jpg",
                        "highlight" => "Playing and changing chords isn’t painful for me anymore.",
                        "testimonial" => "GuitarQuest is a more structured and fun way of learning the guitar than when I tried to learn by myself. Rob makes the learning experience very entertaining! My favorite section of the course so far is where I learned arpeggios and how to add emotion to my playing. Playing and changing chords doesn’t hurt for me anymore!",
                        ],
                        [
                        "name" => "Mikkel",
                        "location" => "Denmark",
                        "image" => "https://guitareo.s3.amazonaws.com/guitarquest/assets/testimonials/guitar-4.jpg",
                        "highlight" => "Makes learning much less daunting.",
                        "testimonial" => "I'm enjoying the relaxed atmosphere of the course. I like how quickly I was tasked with writing my own song - that was fun! GuitarQuest gave me a few new tools and using them creatively right away is great for motivation and practicing just happens to be a big part of nailing down that melody in your head. It makes the aspect of learning the guitar less daunting and you get to apply what you learn right away. It's great!",
                        ],
                        [
                        "name" => "Miller",
                        "location" => "Virginia, USA",
                        "image" => "https://guitareo.s3.amazonaws.com/guitarquest/assets/testimonials/miller-viginia.jpg",
                        "highlight" => "Playing with a band was so much fun.",
                        "testimonial" => "GuitarQuest was a more interesting and practical way to learn guitar. I’m actually looking forward to practicing so I can keep on improving. Playing with a real band in this course was so much fun, especially since I’ve never played with anyone before. I’d love for an expansion on the course, I completed it and now want more!",
                        ],
                        [
                        "name" => "Romain",
                        "location" => "France",
                        "image" => "https://guitareo.s3.amazonaws.com/guitarquest/assets/testimonials/romain-france.jpg",
                        "highlight" => "An easy way to start writing my own music and jam.",
                        "testimonial" => "I thought I needed a lot of music theory knowledge to create my own music, but Rob gives an easy way to start writing your own music right away. I like how every lesson is a part of a song with the end result being hella cool! I have more fun jamming now!",
                        ],
                        [
                        "name" => "Brian",
                        "location" => "Saint Paul, USA",
                        "image" => "https://guitareo.s3.amazonaws.com/guitarquest/assets/testimonials/guitar-5.jpg",
                        "highlight" => "The benefits of private lessons but at your own pace.",
                        "testimonial" => "Rob Scallon does a great job of breaking down the guitar fundamentals. When I was able to write my first melody, it felt very fulfilling knowing I made something myself. GuitarQuest has almost all the benefits of private lessons but in your own home, at your own pace, and in a fun and relaxed format. I'm looking forward to future lessons in the course!",
                        ],
                        [
                        "name" => "Brandon",
                        "location" => "South Carolina, USA",
                        "image" => "https://guitareo.s3.amazonaws.com/guitarquest/assets/testimonials/brandon-south-carolina.jpg",
                        "highlight" => "I love the focus on writing your own music.",
                        "testimonial" => "Learning the guitar and having fun can be tough, but GuitarQuest nails it. I love the chords we learn in the lessons as I usually neglect learning chords in my own playing. The course is smooth, educational, and funny - it’s like watching a bunch of Rob Scallon videos but with a strong focus on learning and writing music. I love it so far! I think this is a special project that will teach so many people the beautiful art of guitar.",
                        ],
                        [
                        "name" => "Jan",
                        "location" => "Berlin, Germany",
                        "image" => "https://guitareo.s3.amazonaws.com/guitarquest/assets/testimonials/jan-berlin-germany.jpg",
                        "highlight" => "I’ve started making my own melodies.",
                        "testimonial" => "GuitarQuest has been fun and motivated me to try more. I like how we start making melodies quickly along with helpful background information on chords and notes. I love seeing other students post their melodies - it’s so much fun to listen to others!",
                        ],
                        [
                        "name" => "Tristan",
                        "location" => "Phoenix, USA",
                        "image" => "https://guitareo.s3.amazonaws.com/guitarquest/assets/testimonials/guitar-6.jpg",
                        "highlight" => "I’m able to create my own melodies and play them with a backing track.",
                        "testimonial" => "This is the quickest way to learn new techniques and songs. Creating my own melodies and playing them with the backing track skyrocketed my guitar playing. Now that I have the basics, learning is more enjoyable. GuitarQuest is user-friendly, well-paced, and introduces you to many styles.",
                        ],
                    ]
                @endphp
                @foreach($testimonials as $testimonial)
                    <div class="tw-text-white tw-text-center tw-pb-12 md:tw-pb-24">
                        <img class="tw-float-left tw-rounded-full tw-overflow-hidden tw-hidden md:tw-inline-block md:tw-w-32 lg:tw-w-44" src="{{ $testimonial['image'] }}">
                        <div class="quote-wrap md:tw-pl-5 lg:tw-pl-10 tw-float-left tw-text-center md:tw-text-left">
                            <h4 class="tw-text-left tw-leading-none tw-mb-3 md:tw-mb-4 lg:tw-mb-5"><em>"{!! $testimonial['highlight'] !!}"</em></h4>
                            <p class="tw-text-left tw-leading-relaxed tw-mx-auto">{!! $testimonial['testimonial'] !!}</p>
                            <img class="tw-w-28 tw-rounded-full tw-inline md:tw-hidden tw-mt-4" src="{{ $testimonial['image'] }}">
                            <p class="text-goldenrod tw-leading-none tw-mx-auto tw-mt-4 lg:tw-mt-5"><strong>{{ $testimonial['name'] }}</strong><br class="tw-inline md:tw-hidden"><span class="tw-hidden md:tw-inline"> - </span><span>{{ $testimonial['location'] }}</span></p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    @include("guitareo.products.guitar-quest.partials.sections._start-here")
    @include("guitareo.sales.partials._footer")
@stop
