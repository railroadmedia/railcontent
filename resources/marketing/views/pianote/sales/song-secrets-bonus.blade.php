@extends('pianote._partials.global-layout')

@section('global-head')
    <title>Learn the piano anytime with real teachers. | Pianote</title>
    <meta property="og:title" content="Pianote - Learn the piano anytime with real teachers.">
    <meta property="og:url" content="https://www.pianote.com/">

    <meta name="description" content="Learn the piano anytime with step-by-step video lessons, world-class teachers, and unlimited personal support. 90-Day Guarantee.">
    <meta property="og:description" content="Learn the piano anytime with step-by-step video lessons, world-class teachers, and unlimited personal support. 90-Day Guarantee.">

    @hasSection('share-image')
        @yield('share-image')
    @else
        <meta property="og:image" content="https://d2vyvo0tyx8ig5.cloudfront.net/sales/2023/share-image-pianote2.jpg" style="display: none;">
    @endif

    @include('_partials.layout._fonts')

    <link rel="stylesheet" href="{{ mix('marketing/css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('/marketing/css/tailwind-helpers.css') }}">
    <link rel="stylesheet" href="{{ asset('/marketing/parcel/drumeo/nav-footer-pianote.css') }}">
    <link rel="stylesheet" href="{{ asset('/marketing/parcel/drumeo/30dd.css') }}">
    <link rel="stylesheet" href="{{ asset('/marketing/parcel/drumeo/sales-pianote.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@splidejs/splide@4.0.7/dist/css/splide.min.css">

    <style>
        .tool:after, .tool:before {
            position: absolute;
            transform: translate(-50%, 0);
            height: auto;
            max-height: 0;
            visibility: hidden;
            opacity: 0;
            transition: all .3s;
            overflow: hidden;
            font-size: 14px;
        }
        .tool:before {
            z-index: 100;
            content: "";
            bottom: 23px;
            left: 50%;
            border-right: 7px transparent solid;
            border-left: 7px transparent solid;
            border-top: 7px solid #fff;
        }
        .tool:after {
            padding: 5px 8px;
            content: attr(tip);
            font-size: 14px;
            text-align: left;
            color: #000;
            width: 220px;
            border-radius: 8px;
            background: #fff;
            box-shadow: 0 0 15px #000;
            bottom: 30px;
            left: -300%;
        }
        .tool:hover, .tool:active, .tool:focus {
            z-index: 100;
        }
        .tool:hover:after, .tool:hover:before, .tool:active:after, .tool:active:before, .tool:focus:after, .tool:focus:before {
            max-height: 1000px;
            visibility: visible;
            opacity: 1;
            display: block;
        }
        .splide__pagination__page.is-active {
            background: #01050F;
            transform: none !important;
        }

        .splide__pagination__page {
            margin: 3px 10px !important;
            opacity: 1 !important;
        }

        @media (min-width: 768px) {
            .splide__pagination__page {
                margin: 3px 6px !important;
            }
        }

        .splide__arrow svg {
            fill: #f61a30 !important;
        }

        .bubble:after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 50%;
            width: 0;
            height: 0;
            border: 5px solid transparent;
            border-top-color: black;
            border-bottom: 0;
            margin-left: -5px;
            margin-bottom: -5px;
        }

        table.comparison tr td:nth-child(2) {
            background-color: #f61a30;
            text-shadow: 3px 3px #f61a30;
        }
        table.comparison tr:hover td:nth-child(2),
        table.comparison tr:nth-child(2n):hover td:nth-child(2) {
            background-color:#eb1a2f;

        }
    </style>
@stop

@section('body-data')
    x-data ='{
        soundslice : false,
        trailer : false,
        unbox : false,
        rolandTrailer : false
    }'
@endsection

@section('global-body')
    @if(!empty($promoVersion))
        @include("pianote.sales.partials._nav", [
            "subscriptionVersion" => true,
            "scrollToJoin" => true,
            "hideMenu" => true,
        ])
    @elseif(!empty($month))
        @include("pianote.sales.partials._nav", [
            "subscriptionVersion" => true,
            "fullSubscriptionVersion" => true,
            "trialVersion" => true,
            "joinUrl" => '/choose-your-trial-month',
        ])

    @else
        @include("pianote.sales.partials._nav", [
            "subscriptionVersion" => true,
            "fullSubscriptionVersion" => true,
            "trialVersion" => true,
            "joinUrl" => '/choose-plan',
        ])
    @endif

    @php
        $bubble1 = 'https://d2vyvo0tyx8ig5.cloudfront.net/sales/2023/bubbles/summer-swee-singh.png';
        $bubble2 = 'https://d2vyvo0tyx8ig5.cloudfront.net/sales/2023/bubbles/lisa-witt.png';
        $bubble3 = 'https://d2vyvo0tyx8ig5.cloudfront.net/sales/2023/bubbles/jesus-molina.png';
        $bubble4 = 'https://d2vyvo0tyx8ig5.cloudfront.net/sales/2023/bubbles/kevin-castro.png';
        $bubble5 = 'https://d2vyvo0tyx8ig5.cloudfront.net/sales/2023/bubbles/erskine-hawkins.png';
        $bubble6 = 'https://d2vyvo0tyx8ig5.cloudfront.net/sales/2023/bubbles/victoria-theodore.png';
        $bubble7 = 'https://d2vyvo0tyx8ig5.cloudfront.net/sales/2023/bubbles/sangah-noona.png';
        $bubble8 = 'https://d2vyvo0tyx8ig5.cloudfront.net/sales/2023/bubbles/cassi-falk.png';

        $features = [
            [
                'image' => 'https://d2vyvo0tyx8ig5.cloudfront.net/sales/2023/piano-lesson-icon.svg',
                'title' => 'Piano Lessons',
                'desc' => 'Step-by-step video <br class="hidden sm:inline"> lessons on every topic.',
            ],
            [
                'image' => 'https://d2vyvo0tyx8ig5.cloudfront.net/sales/2023/artist-course-icon.svg',
                'title' => 'Artist Courses',
                'desc' => 'Courses and live events<br class="hidden sm:inline"> with inspiring pianists. ',
            ],
            [
                'image' => 'https://d2vyvo0tyx8ig5.cloudfront.net/sales/2023/songs-icon.svg',
                'title' => '1000+ Songs',
                'desc' => 'Play your favorite songs<br class="hidden sm:inline"> from every style & era.',
            ],
            [
                'image' => 'https://d2vyvo0tyx8ig5.cloudfront.net/sales/2023/support-icon.svg',
                'title' => '24/7 Support',
                'desc' => 'The largest community<br class="hidden sm:inline"> of students & teachers.',
            ],
        ];
        $slides = [
            [
                'desc' => 'Pianote is a really fun resource for those wishing to pick up tips and tricks and gain perspective. ',
                'thumb' => 'https://d2vyvo0tyx8ig5.cloudfront.net/sales/2022/feature-testimonial-yvette.jpg',
                'name' => 'Yvette Young',
                'credit' => ' Multi-Instrumentalist',
            ],
            [
                'desc' => 'You should check out Pianote. If you’re a beginner or intermediate, this is ideal for you!',
                'thumb' => 'https://d2vyvo0tyx8ig5.cloudfront.net/sales/2022/feature-testimonial-ali.jpg',
                'name' => 'Ali Spagnola',
                'credit' => ' YouTube Entertainer',
            ],
            [
                'desc' => 'Whether you’re getting your head around “Chopsticks” or brushing up on your Shostakovich, there should be a lesson for you.',
                'thumb' => 'https://d2vyvo0tyx8ig5.cloudfront.net/sales/2022/feature-testimonial-musicradar.jpg',
                'name' => 'MusicRadar',
                'credit' => ' Website For Musicians',
            ],
        ];
    @endphp

            @include('musora.sales.components.header-section', [
                'header' => 'Online piano lessons<br> for all skill levels.',
                'underline' => true,
                'desc' => 'Learn the piano faster with step-by-step lessons,<br class="hidden sm:inline"> a thousand songs, and unlimited personal support. ',
                'thumb' => 'https://d2vyvo0tyx8ig5.cloudfront.net/sales/2023/header-thumb2.jpg',
                'promoThumb' => 'https://d2vyvo0tyx8ig5.cloudfront.net/sales/2023/jan-thumb2.png',
                'promoThumbM' => 'https://d2vyvo0tyx8ig5.cloudfront.net/sales/2023/jan-thumb-m2.jpg',
                'pointOne' => 'Improve Your Skills',
                'pointTwo' => 'World-Class Teachers',
                'pointThree' => 'Play More<br class="inline lg:hidden"> Songs',
            ])


    @php
        $testimonials = [
            [
            'image' => 'https://d2vyvo0tyx8ig5.cloudfront.net/sales/2022/testimonials/iankershaw.jpg',
            'title' => "Such a fantastic and welcoming student community.",
            'description' => "When I signed up for Pianote, I knew I was going to get Lisa’s great energy, the Method, the courses, the bootcamps, and the student reviews.<br><br>But my breakthrough came when I realized that sitting behind all of this is such a fantastic and welcoming, supportive student community. It’s this community – as well as the teachers and the rest of the Pianote team – that really actively encourages you to share your progress and practice. And it doesn’t have to be perfect. And that really does encourage you to practice more. And it’s in that sharing and practice that the real breakthroughs come. Thank you!",
            'name' => 'Ian Kershaw',
            'video' => '660596700',
            'location' => 'United Kingdom',
            ],
            [
            'image' => 'https://d2vyvo0tyx8ig5.cloudfront.net/sales/2022/testimonials/jaydemcintosh.jpg',
            'title' => "I’ve had to give up on a lot of my dreams. Then I discovered Pianote.",
            'description' => "I’ve been chronically ill for the last six years, which means I’ve had to give up on a lot of my dreams and goals.<br><br>During my health journey, my interest in piano and my connection to music really arose – but it also seemed impossible. I had no prior music knowledge and couldn’t even get out of bed some days. This is when I discovered Pianote and they’ve been amazing.<br><br>I have to work at a very slow pace due to my health, but I’ve already learned so many basics. I can play some of my all-time favorite songs – and it’s just so awesome to know I can learn from home and accomplish one of my dreams. I’m so excited to keep learning and I recommend Pianote so much.",
            'name' => 'Jayde McIntosh',
            'video' => '660596722',
            'location' => 'Australia',
            ],
            [
            'image' => 'https://d2vyvo0tyx8ig5.cloudfront.net/sales/2022/testimonials/xitlalicaballero2.jpg',
            'title' => "I’m six years old. My biggest moment is when I play Für Elise.",
            'description' => "My name is Xitlali. I’m six years old. I started playing piano when I was five. A few weeks ago, I started using pianote. My biggest moment is when I play Für Elise.",
            'name' => 'Xitlali Caballero',
            'video' => '660596752',
            'location' => 'Florida, USA',
            ],
            [
            'image' => 'https://d2vyvo0tyx8ig5.cloudfront.net/sales/2022/testimonials/nabilabdelmoneim.jpg',
            'title' => "I’m a lot better at using both hands and it opened up more songs.",
            'description' => "You guys make learning way too fun.<br><br>I’ve had two breakthrough moments. There was this video that promised hand independence in five days. And what do you know? A few days later I’m a lot better at using both hands and it just opened up a bunch more songs for me. And my second breakthrough moment was finding this chord chart that made it so much easier to go through the chords and practice them. And I started realizing that these chords sounded a lot like the ones I play on guitar. So I managed to take the notes that were in the practice log and apply them to my guitar, and actually learned theory for both instruments at once. Thank you Lisa and happy playing!",
            'name' => 'Nabil Abd El Moneim',
            'video' => '660596735',
            'location' => 'British Columbia, Canada',
            ],
            [
            'image' => 'https://d2vyvo0tyx8ig5.cloudfront.net/sales/2022/testimonials/jessripley.jpg',
            'title' => "I’m blown away by the program you’ve created.",
            'description' => "Pianote is an insanely encouraging and supportive community run by an insanely encouraging and supportive team. Sincerely, I’m blown away by the program you’ve created.<br><br>I sat down one day and it just clicked. From then on, I’ve felt VERY encouraged to keep learning and practicing. It’s fulfilling and fun to see myself progress and achieve goals. Now I’m playing with both hands at the same time with confidence – and I’ve started playing along with more backing tracks and making up my own songs.",
            'name' => 'Jess Ripley',
            'location' => 'California, USA',
            ],
            [
            'image' => 'https://d2vyvo0tyx8ig5.cloudfront.net/sales/2022/testimonials/anselmdesouza.jpg',
            'title' => "Helped coordinate my left and right hands.",
            'description' => "I was using a piano app, but it wasn’t personal and I had to figure it out on my own most of the time. So I joined Pianote and went back to the basics.<br><br>Pianote helped coordinate my left and right hands. The explanations and instructions are very clear, easy to follow, and slowly I noticed I was improving by using skills from one lesson to the next. It’s structured to allow you to build the foundations, and the tips and tricks videos make your playing special. The lessons are fun and the instructors are engaging.",
            'name' => 'Anselm de Souza',
            'location' => 'Singapore',
            ],
            [
            'image' => 'https://d2vyvo0tyx8ig5.cloudfront.net/sales/2022/testimonials/johnmaclean.jpg',
            'title' => "My 6 year old daughter started dancing as I played.",
            'description' => "Before Pianote and The Method, I was completely lost in terms of knowing how to become a better musician. All I would do is try to play songs, but without any of the structure and practice that is required to actually improve. And with face to face lessons I wasn’t really progressing much between the lessons. But having access to the video tutorials online lets me go back as often as I need to.<br><br>My biggest breakthrough has been independent hand control – allowing me to hear rich music that I’m creating for the first time. And gaining that confidence has allowed me to start to improvise the pieces that I learn.<br><br>The lightbulb moment happened when my 6 year old daughter started dancing as I played! You must be doing something right if someone dances to music that you’re playing, right?",
            'name' => 'John Maclean',
            'location' => 'United Kingdom',
            ],
            [
            'image' => 'https://d2vyvo0tyx8ig5.cloudfront.net/sales/2022/testimonials/serenadorward.jpg',
            'title' => "If I was taught this way as a child, I would have never quit.",
            'description' => "I decided to sign up with Pianote not only to re-learn how to play the piano, but also because my mental health was really suffering and I needed something positive to focus on that was just for ME. I knew almost immediately that this was the answer I had been looking for. It felt like the heaviness on my shoulders got a bit lighter after every piano session.  And even though the lessons are virtual, it was like Lisa was right there beside me cheering me on.<br><br>I was blown away by how quickly I progressed with a few tutorials from Lisa. My overall confidence improved, especially with improvisation. Now I know all these little tricks (fills & riffs) and how to play inversions and practice chords in ways that sound so lovely.  If I had been taught this way as a child, I probably never would have quit.",
            'name' => 'Serena Dorward',
            'location' => 'Ontario, Canada',
            ],
        ]
    @endphp
    @include('musora.sales.components.testimonials-section', [
        'header' => 'Trusted by pianists<br class="inline-block sm:hidden">  everywhere.',
        'reviewText' => 'Check out the reviews and meet some of our friendly students.',
        'youtubeLink' => 'https://www.youtube.com/pianolessonscom/',
        'youtube' => '1.3M',
        'facebookLink' => 'https://facebook.com/pianoteofficial/',
        'facebook' => '430K',
        'instagramLink' => 'https://instagram.com/pianoteofficial/',
        'instagram' => '200K',
    ])

    <section class="text-center px-5 sm:px-6 py-10 sm:py-14 lg:py-20">
        <div class="container max-w-6xl mx-auto">
            <div class="relative">
                <table class="w-full mx-auto comparison max-w-4xl mx-auto mb-10 private">
                    <tbody>
                    <tr style="background-color:transparent!important;">
                        <td></td>
                        <td class="rounded-t-xl"><img class="h-8 sm:h-14 transition-all opacity-0" src="https://www.musora.com/musora-cdn/image/width=220,quality=95/https://d2vyvo0tyx8ig5.cloudfront.net/products/30-day-blues-piano/30-day-blues-piano-logo-white.png" alt="logo" loading="lazy" onload="this.classList.remove('opacity-0')"></td>
                        <td class="cursor-pointer sm:cursor-default rounded-tr-xl"><strong>Piano<br> Books</strong></td>
                    </tr>
                    <tr>
                        <td>Style</td>
                        <td>20 Play-Along Lessons</td>
                        <td>In-Person</td>
                    </tr>
                    <tr>
                        <td>Investment</td>
                        <td class="rounded-b-xl"><strong>${{ floatval($productPrices['new-piano-players-start-here']->discounted_price) }}</strong><br>Single Payment</td>
                        <td class="rounded-br-xl"><strong>$19-$49</strong><br>&nbsp;</td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </section>
    @include('musora.sales.components.guarantee-section', [
        'badge' => 'https://d2vyvo0tyx8ig5.cloudfront.net/sales/2022/piano-guarantee.png',
        'header' => '<strong>But what if it doesn’t work for you?</strong>',
        'desc' => 'You’ll love your Pianote lessons and how quickly you’ll see progress. That’s our promise.<br>
But what if it doesn’t work?<br>
Then you won’t have to pay. We’re so confident you’ll love the results, that you’ll 90 days to put us to the test. It’s the longest guarantee out there. And it’s enough time to really know if this is for you.<br>
If you’re not happy (for any reason), simply let us know within 90 days for a refund.<br>
That’s the Play Better Guarantee™',
    ])
    <div class="unstick-trigger block"></div>
    <div id="customize-anchor" class="anchor"></div>
    <div id="order" class="anchor"></div>
        @php
            $bonuses = [
                [
                    'image' => 'https://d2vyvo0tyx8ig5.cloudfront.net/sales/2022/bonus-chords-scales.jpg',
                    'title' => 'Chords & <br>Scales Book',
                    'description' => 'Your encyclopedia of piano chords & scales.',
                    'price' => floatval($productPrices['piano-chords-and-scales-guide']->price),
                    'shipping' => 'true'
                ],
                [
                    'title' => 'Easy Chords',
                    'price' => 97,
                    'description' => 'Chords are the foundation of all music. But they can be tricky to understand, let alone practice. Easy Chords solves that problem. Over 30 days, you’ll play with a teacher and unlock the beauty and power of piano chord progressions. You’ll be able to play hundreds of songs after taking this course. And best of all? It only takes 10 minutes a day.',
                    'image' => 'https://d1fyshwdvi6fth.cloudfront.net/Pianote/Bundle-images/2bae4048-37d2-4fe4-a195-431de3f7f822-easy-chords-card.jpg',
                ],
                [
                    'title' => 'New Piano Players Start Here',
                    'price' => 97,
                    'description' => 'New to the piano? Start here! This play-along course is your first 30 days on the piano. You don’t need any previous experience or theory knowledge. Over 30 days, you’ll play along with your teacher for just 10 minutes a day! You’ll be amazing at what a little bit of consistent practice will do.',
                    'image' => 'https://d1fyshwdvi6fth.cloudfront.net/Pianote/Bundle-images/fb81d171-6ee7-46bb-bd5e-b29de32766c5-NPPSH-card.jpg',
                ],
                [
                    'image' => 'https://d2vyvo0tyx8ig5.cloudfront.net/sales/promos/black-friday/unlimited/piano-riffs-and-fills.jpg',
                    'title' => 'Piano Riffs<br> & Fills',
                    'description' => 'Learn the secrets and tips to play fills that sound complicated and advanced, but are simple to learn.',
                    'price' => floatval($productPrices['piano-riffs-and-fills']->price),
                ],
                [
                    'image' => 'https://d2vyvo0tyx8ig5.cloudfront.net/sales/promos/september/chords-poster.jpg',
                    'description' => 'Play every major and minor chord.',
                    'price' => floatval($productPrices['music-theory-posters']->price),
                    'shipping' => true,
                ],
                [
                    'image' => 'https://d2vyvo0tyx8ig5.cloudfront.net/sales/promos/september/chord-formulas-poster.jpg',
                    'description' => 'Play any chord. On any key. ',
                    'price' => floatval($productPrices['music-theory-posters']->price),
                    'shipping' => true,
                ],
                [
                    'image' => 'https://d2vyvo0tyx8ig5.cloudfront.net/sales/promos/september/circle-of-fifths-poster.jpg',
                    'description' => 'The essential piece of music theory.',
                    'price' => floatval($productPrices['music-theory-posters']->price),
                    'shipping' => true,
                ],
                [
                    'image' => 'https://d2vyvo0tyx8ig5.cloudfront.net/sales/promos/september/key-to-sight-reading-poster.jpg',
                    'description' => 'Link the notes on the page to your keys.',
                    'price' => floatval($productPrices['music-theory-posters']->price),
                    'shipping' => true,
                ],
                [
                    'image' => 'https://d2vyvo0tyx8ig5.cloudfront.net/sales/promos/september/dynamics-poster.jpg',
                    'description' => 'Don’t learn Italian. Just look at this poster.',
                    'price' => floatval($productPrices['music-theory-posters']->price),
                    'shipping' => true,
                ],
                [
                    'image' => 'https://d2vyvo0tyx8ig5.cloudfront.net/sales/promos/september/scales-poster.jpg',
                    'description' => 'All the major and minor scales on one place.',
                    'price' => floatval($productPrices['music-theory-posters']->price),
                    'shipping' => true,
                ],
            ]
        @endphp

    @include('musora.sales.components.order-section-bonuses', [
    'bgColor' => 'background:linear-gradient(to bottom, #860c9f, #da174b);',
        'firstYearPrice' => '177',
        'buttonColor' => 'white',
        'CTA' => 'CLAIM YOUR OFFER',
    'promoLogo' => 'https://d2vyvo0tyx8ig5.cloudfront.net/sales/promos/september/national-piano-month-logo.svg',
    'topImage' => 'https://d2vyvo0tyx8ig5.cloudfront.net/sales/2023/pianote-annual-2w-card.png',
    'subHeader' => '<strong><span class="text-musora">SAVE 20%</span> ON YOUR PIANOTE MEMBERSHIP</strong> <br class="hidden sm:inline">+ GET 3 COURSES, 6 POSTERS & THE CHORDS AND SCALES BOOK.',
    'subDescription' => 'Save 17% + get 4 bonuses<br class="inline sm:hidden"> worth $357',
    'buttonLink' => '/ecommerce/add-to-cart?products[PIANOTE-MEMBERSHIP-1-YEAR]=1&products[music-theory-posters]=1&products[piano-chords-and-scales-guide]=1&products[pianote-practice-planner]=1&redirect=/order&locked=true&promo-code=special',
    'altButtonLink' => '/ecommerce/add-to-cart?products[PIANOTE-MEMBERSHIP-1-MONTH]=1&redirect=%2Forder',
    ])

    @include('musora.sales.components.app-section', [
        'image' => 'https://d2vyvo0tyx8ig5.cloudfront.net/sales/2023/devices.png',
        'appleUrl' => 'https://apps.apple.com/us/app/musora/id1619053766?ppid=afddd5f6-fbc3-46c9-b6e4-6c9e6a6936af',
        'googleUrl' => 'https://play.google.com/store/apps/details?id=com.musoraapp&listing=pianote_previews',
    ])

    @include('pianote._partials.faq')

    @include('_partials.components.video-modal',[
        'name' => 'soundslice',
        'video' => '77f4c',
        'soundslice' => true,
    ])
    @include('_partials.components.video-modal',[
        'name' => 'trailer',
        'video' => '785314388',
        'vimeo' => true,
    ])
    @include('_partials.components.video-modal',[
        'name' => 'unbox',
        'video' => '774408046',
        'vimeo' => true,
    ])

    @if(!empty($promoVersion))
        @include("pianote.sales.partials._footer", [
            "minimal" => true
        ])
    @else
        @include("pianote.sales.partials._footer")
    @endif
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script type="text/javascript" src="{{ asset('/marketing/parcel/drumeo/navigation-sales.js') }}"></script>

    <script src="https://cdn.jsdelivr.net/npm/@splidejs/splide@4.0.7/dist/js/splide.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/lazysizes/5.3.2/lazysizes.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/lazysizes/5.3.2/plugins/unveilhooks/ls.unveilhooks.min.js"></script>
    @yield('scripts')
@stop
