@extends('pianote._partials.global-layout')

@section('global-head')
    <title>Save 50% On Your First Year</title>
    <meta property="og:title" content="Save 50% On Your First Year">
    <meta property="og:url" content="https://www.pianote.com/">

    <meta name="description" content="We want you back – so you’ll get a 50% discount on your first year with Pianote.">
    <meta property="og:description" content="We want you back – so you’ll get a 50% discount on your first year with Pianote.">

    @hasSection('share-image')
        @yield('share-image')
    @else
        <meta property="og:image" content="https://d2vyvo0tyx8ig5.cloudfront.net/sales/2023/share-image-pianote2.jpg" style="display: none;">
    @endif

    @include('_partials.layout._fonts')

    <link rel="stylesheet" href="{{ mix('marketing/css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('/marketing/css/tailwind-helpers.css') }}">
    <link rel="stylesheet" href="{{ asset('/marketing/parcel/drumeo/nav-footer-pianote.css') }}">
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

        @if(!empty($trialVersion))
            .option-buttons.active {
            border-color:#f61a30!important;
            background-color:#4a0c12 !important;
        }
        .option-buttons.active .radio-check {
            border-color:#f61a30!important;
            background-color:#f61a30!important;
        }
        .option-buttons.active .radio-check i {
            display:block!important;
        }
        @endif


    .join.green {
                 background: #10D05F;

        }
        .join.green:hover,
        .join.green:focus {
             background: #13eb6d;
         }
    </style>
@stop

@section('global-body')
    @include("pianote.sales.partials._nav", [
        "subscriptionVersion" => true,
        "scrollToJoin" => true,
        "hideMenu" => true,
    ])

        <header class="sm:px-6 pb-14 pt-6 sm:pt-14 sm:pb-28 lg:pt-20 lg:pb-36 text-white" style="background:linear-gradient(to left, #F61A30, #900068);">
            <div class="container max-w-6xl mx-auto">
                <div class="flex flex-wrap sm:flex-nowrap items-center">
                    <div class="w-full text-center">
                        <div class="px-5 sm:px-0">
                            <img class="h-20 sm:h-36" src="https://d2vyvo0tyx8ig5.cloudfront.net/sales/promos/june/2023/header-collage.png">
                            <h1 class="rotater-text my-4 lg:my-5"><strong>Save 50% On <br class="inline sm:hidden"> Your First Year</strong></h1>
                            <h6 class="leading-normal mb-4 sm:mb-2">We want you back – so you’ll get a <strong>50% discount</strong> on your first year with Pianote.<br>
                                <strong class="text-musora"><em>Only available until June 30th.

                                                        <span x-cloak x-data="timer()" x-init="countdown()">
                                                                     <span x-cloak x-show="timeLeft > 0 && day > 0"><span x-text="day"></span><span x-text="dayText"></span></span>
                                                                     <span x-cloak x-show="timeLeft > 0 && hour > 0"><span x-text="hour"></span><span x-text="hourText"></span></span>
                                                                     <span x-cloak x-show="timeLeft > 0 && day < 7"><span x-text="minute"></span><span x-text="minuteText"></span></span>
                                                                     <span x-cloak x-show="timeLeft > 0 && day < 7"><span x-text="second"></span><span x-text="secondText"></span></span>
                                                                     <span x-cloak x-show="timeLeft < 0">A Limited Time</span>
                                                                 </span>
                                        left!</em></strong></h6>
                            <div class="flex flex-wrap items-center justify-center sm:justify-start mt-6 sm:mt-5 lg:mt-10 mx-auto sm:max-w-xs">
                                <a class="w-full join green smaller mb-2" href="/ecommerce/add-to-cart?products[PIANOTE-MEMBERSHIP-1-YEAR]=1&locked=true&promo-code=restart">SEE YOUR DEAL &raquo;</a>
                                <a aria-label="Review" class="inline-block" href="https://www.shopperapproved.com/reviews/Musora.com" target="_blank" onclick="window.open('https://www.shopperapproved.com/reviews/Musora.com', 'newwindow', 'width=750, height=550'); return false;">
                                    <i class="align-middle text-lg fas fa-star" style="color: #ffac00;"></i>
                                    <i class="align-middle text-lg -ml-3 fas fa-star" style="text-shadow: -2px -1px 1px #ba0b51;color: #ffac00;"></i>
                                    <i class="align-middle text-lg -ml-3 fas fa-star" style="text-shadow: -2px -1px 1px #ba0b51;color: #ffac00;"></i>
                                    <i class="align-middle text-lg -ml-3 fas fa-star" style="text-shadow: -2px -1px 1px #ba0b51;color: #ffac00;"></i>
                                    <i class="align-middle text-lg -ml-3 fas fa-star" style="text-shadow: -2px -1px 1px #ba0b51;color: #ffac00;"></i>
                                </a>
                                <p class="inline-block leading-tight text-sm align-middle pl-2 m-0"><em>Trusted by {{ number_format(Prices::$students) }} active students.</em></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </header>

        @php
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
        @endphp
        <div class="container max-w-4xl mx-auto -mt-10 sm:-mt-14 lg:-mt-20">
            <div class="px-5 sm:px-0">
                <div class="flex flex-wrap sm:flex-nowrap text-center border-2 rounded-xl border-{{ $theme }} bg-white relative">
                    <div class="z-10 flex flex-wrap sm:flex-nowrap items-start justify-evenly w-full sm:w-auto sm:flex-grow py-4 sm:py-3 lg:py-4 lg:px-5 text-left sm:text-center">
                        @foreach ($features as $key => $feature)
                            <div class="flex sm:block w-full sm:w-auto px-4 sm:px-3 my-2 sm:mb-0">
                                <img
                                    src="https://www.musora.com/musora-cdn/image/{{ $feature['image'] }}"
                                    class="h-5 sm:h-7 mb-2 mr-4 sm:mr-0 transition-opacity opacity-0"
                                    alt="feature image{{$key+1}}"
                                    loading="lazy"
                                    onload="this.classList.remove('opacity-0')"
                                >
                                <p class="leading-tight mx-0"><strong class="font-black">{{ $feature['title'] }}</strong><br>
                                    <span class="text-sm">{!!  $feature['desc']  !!}</span></p>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

        <section class="pt-12 md:pt-20">
            <div class="max-w-md md:max-w-4xl mx-auto px-4 lg:px-2">
                <h3 class="font-extrabold text-center">Pianote membership<br class="inline sm:hidden"> special pricing.</h3>
                <p class="text-center mt-3 mb-6">You’ll have one year of unlimited<br class="inline sm:hidden">  piano lessons, including:</p>
                <div class="md:grid md:grid-cols-3 md:gap-4">
                    <div class="relative rounded-xl overflow-hidden mb-3 md:mb-0" style="background-color:#F6F8FC;">
                        <div class="w-full aspect-16:9 bg-cover bg-center lazyload" data-bg="https://www.musora.com/musora-cdn/image/width=700,quality=95/https://d2vyvo0tyx8ig5.cloudfront.net/sales/promos/june/2023/pianote-method.jpg"></div>
                        <div class=" px-3 lg:px-4 py-5 lg:py-7 text-center">
                            <img class="h-5 lazyload" data-src="https://www.musora.com/musora-cdn/image/width=200,quality=95/https://d2vyvo0tyx8ig5.cloudfront.net/sales/promos/june/2023/pianote-method-logo.svg" alt="method-text">
                            <p class="mt-2">
                                Step-by-step lessons for the next stage of your piano playing.
                            </p>
                        </div>
                    </div>
                    <div class="relative rounded-xl overflow-hidden mb-3 md:mb-0" style="background-color:#F6F8FC;">
                        <div class="w-full aspect-16:9 bg-cover bg-center lazyload" data-bg="https://www.musora.com/musora-cdn/image/width=700,quality=95/https://d2vyvo0tyx8ig5.cloudfront.net/sales/promos/june/2023/pianote-songs.jpg"></div>
                        <div class="px-3 lg:px-4 py-5 lg:py-7 text-center">
                            <img class="h-5 lazyload" data-src="https://www.musora.com/musora-cdn/image/width=150,quality=95/https://d2vyvo0tyx8ig5.cloudfront.net/sales/promos/june/2023/pianote-songs-logo.svg" alt="songs-text">
                            <p class="mt-2">
                                Easy access to 1000+ famous songs with play-along tools.
                            </p>
                        </div>
                    </div>
                    <div class="relative rounded-xl overflow-hidden" style="background-color:#F6F8FC;">
                        <div class="w-full aspect-16:9 bg-cover bg-center lazyload" data-bg="https://www.musora.com/musora-cdn/image/width=700,quality=95/https://d2vyvo0tyx8ig5.cloudfront.net/sales/promos/june/2023/pianote-coaches.jpg"></div>
                        <div class="px-3 lg:px-4 py-5 lg:py-7 text-center">
                            <img class="h-5 lazyload" data-src="https://cdn.musora.com/image/fetch/q_auto:best/https://d2vyvo0tyx8ig5.cloudfront.net/sales/promos/june/2023/pianote-coaches-logo.svg" alt="coaches-text">
                            <p class="mt-2">
                                Personalize support for all of your piano playing questions.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

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
            'header' => 'Your friends would love to see<br class="hidden sm:inline-block">   you back in the comments.',
            'reviewText' => 'Rejoin a thriving community of piano players of all skill-levels<br class="hidden sm:inline-block"> learning this beautiful instrument.',
        ])

        @include('musora.sales.components.guarantee-section', [
        'badge' => 'https://d2vyvo0tyx8ig5.cloudfront.net/sales/2022/piano-guarantee.png',
            'header' => '<strong>Happy “welcome back” guarantee.</strong><br>Test-drive your lessons for 90 days. Zero risk.',
            'desc' => 'More than anything, we want to make sure you have a POSITIVE experience developing new skills and gaining confidence when you rejoin Pianote. Which is why you’ll have 90 days risk-free to try everything again and make sure you love it.',
        ])

        <div class="unstick-trigger block"></div>
        <div id="customize-anchor" class="anchor"></div>
        <div id="order" class="anchor"></div>
        <section class="py-14 sm:py-20 lg:py-24 relative overflow-hidden text-white text-center customize px-4 lg:px-6" style="background:linear-gradient(to left, #F61A30, #900068);">
            <div class="container mx-auto max-w-6xl relative z-50">
                <div class="w-full">
                    <div class="bonus-wrap relative inline-block align-top mx-auto px-1 md:px-3 w-full max-w-xs">
                        <div class=" inline-block relative w-full group" style="padding-bottom: 62%;perspective: 1000px;">
                            <div class="text-center w-full h-full absolute" style="transform-style: preserve-3d;">
                                <div class="  front absolute z-20 overflow-hidden rounded-3xl w-full h-full transition-transform duration-700" style="backface-visibility: hidden;">
                                    <div class="h-full w-full bg-top bg-contain bg-no-repeat" style="background-image:url(https://www.musora.com/musora-cdn/image/width=850,quality=95/https://d2vyvo0tyx8ig5.cloudfront.net/sales/promos/june/2023/membership-badge.png);"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <br>
                    <h3 class="leading-tight mt-4 sm:mt-5"><strong>Restart your <span class="hidden sm:inline">Pianote</span> Membership<br class="hidden sm:inline">  today and save 50%.</strong></h3>
                    <p class="leading-tight my-3 sm:my-4 text-musora font-black"><strong><em>Only available until June 30th.
                                <span x-cloak x-data="timer()" x-init="countdown()">
                                                                     <span x-cloak x-show="timeLeft > 0 && day > 0"><span x-text="day"></span><span x-text="dayText"></span></span>
                                                                     <span x-cloak x-show="timeLeft > 0 && hour > 0"><span x-text="hour"></span><span x-text="hourText"></span></span>
                                                                     <span x-cloak x-show="timeLeft > 0 && day < 7"><span x-text="minute"></span><span x-text="minuteText"></span></span>
                                                                     <span x-cloak x-show="timeLeft > 0 && day < 7"><span x-text="second"></span><span x-text="secondText"></span></span>
                                                                     <span x-cloak x-show="timeLeft < 0">A Limited Time</span>
                                                                 </span>
                                left!</em></strong></p>

                    <h3 class="leading-tight mb-1"><strong>Only</strong> <s class="opacity-50">$240</s> <strong>$120</strong></h3>
                    <p class="leading-tight text-sm mb-5"><em>Renews at $240 after your first year.</em></p>
                </div>
                <a class="join green" href="/ecommerce/add-to-cart?products[PIANOTE-MEMBERSHIP-1-YEAR]=1&locked=true&promo-code=restart">GET Started »</a>
            </div>
        </section>

    @include("pianote.sales.partials._footer")
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script type="text/javascript" src="{{ asset('/marketing/parcel/drumeo/navigation-sales.js') }}"></script>

    <script src="https://cdn.jsdelivr.net/npm/@splidejs/splide@4.0.7/dist/js/splide.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/lazysizes/5.3.2/lazysizes.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/lazysizes/5.3.2/plugins/unveilhooks/ls.unveilhooks.min.js"></script>

        @include('_partials.components.countdown',[
        'countdownDate' => '2023-07-01 00:00:00',
        'promoVersion' => false
        ])
@stop
