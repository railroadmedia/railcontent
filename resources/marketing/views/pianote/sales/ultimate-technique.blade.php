@php
    require_once(resource_path('marketing/views/pianote/_partials/homepage-data.php'));
@endphp
@extends('pianote._partials.global-layout')

@section('global-head')
    <title>Save 60% with the  Ultimate Technique Bundle. | Pianote</title>
    <meta property="og:title" content="Save 60% with the  Ultimate Technique Bundle">
    <meta property="og:url" content="https://www.pianote.com/song-secrets-bonus">

    <meta name="description" content="$177 for your first year!">
    <meta property="og:description" content="$177 for your first year!"> 

    <meta property="og:image" content="https://d21q7xesnoiieh.cloudfront.net/fit-in/1200x0/filters:quality(95)/marketing/pianote/promos/may/header.webp" style="display: none;">


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

        .timeline-container::after {
            content: '';
            position: absolute;
            width: 3px;
            background-color: #F61A30;
            top: 0;
            bottom: 0;
            transform: translate(-50%, 0);
            z-index: 0;
            left: 0;
        }
        .timeline-container .timeline::after {
            content: '';
            position: absolute;
            width: 20px;
            height: 20px;
            transform: translate(-50%, 0);
            background-color: #F61A30;
            top: 0;
            border-radius: 50%;
            z-index: 1;
            left: -16px;
        }
        @media (min-width: 768px) {
            .timeline-container .timeline::after {
                left: 50%;
            }
        }
        @media (min-width: 768px) {
            .timeline-container::after, .timeline::after {
                left: 50%;
            }
        }
    </style>
@stop

@section('body-data')
    x-data ='{
        soundslice : false,
        trailer : false,
        unbox : false,
        rolandTrailer : false,
        lazyLoad: false
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
        $buttonLink = '/ecommerce/add-to-cart?products[PIANOTE-MEMBERSHIP-1-YEAR]=1&products[music-theory-posters]=1&products[digital-chords-scales-guide]=1&products[piano-chords-and-scales-guide]=1&products[easy-chords]=1&products[new-piano-players-start-here]=1&products[piano-riffs-and-fills]=1&products[song-secrets-webinar]=1&redirect=/order&locked=true&promo-code=special-discount'
    @endphp

    <section class="py-8 sm:py-10 lg:py-12 relative overflow-hidden text-center customize px-4 lg:px-8 relative overflow-hidden" style="background: #f6f8fc;">
        <div class="container mx-auto max-w-4xl">
        <h2 class="w-auto leading-tight text-center"><strong class="text-pianote">Save 60% </strong>with the<br> <strong>Ultimate Technique Bundle</strong> </h2>
            <div class="flex flex-wrap sm:flex-nowrap items-center">
                <div class="flex w-full justify-center sm:justify-start sm:w-1/2 lg:w-auto sm:order-1 lg:pl-5">
                    <img class="hidden sm:inline-block h-56 sm:h-auto max-w-full sm:max-w-sm lg:max-w-full transition-opacity opacity-0"
                            loading="lazy"
                            onload="this.classList.remove('opacity-0')"
                            src="https://d21q7xesnoiieh.cloudfront.net/fit-in/1200x0/filters:quality(95)/marketing/pianote/promos/may/header.webp"
                            alt="{{$theme}} collage image"
                    >
                </div>
                <div class="text-center sm:text-left w-full sm:w-1/2 lg:w-auto flex-shrink-0">
                    <img class="inline-block sm:hidden mb-4 h-64 sm:h-auto max-w-full sm:max-w-xl lg:max-w-full transition-opacity opacity-0"
                            loading="lazy"
                            onload="this.classList.remove('opacity-0')"
                            src="https://d21q7xesnoiieh.cloudfront.net/fit-in/1200x0/filters:quality(95)/marketing/pianote/promos/may/header.webp"
                            alt="{{$theme}} collage image"
                    >
                    <div class="inline-block mx-auto">
                        <ul class="inline-block mx-auto fa-ul text-left pl-6 my-4 sm:my-5">
                            <li class="leading-tight mb-3"><i class="fa-li fas fa-check text-pianote"></i> Step-by-step lessons </li>
                            <li class="leading-tight mb-3"><i class="fa-li fas fa-check text-pianote"></i> World-class instructors</li>
                            <li class="leading-tight mb-3"><i class="fa-li fas fa-check text-pianote"></i> 1000+ Officially licensed songs</li>
                            <li class="leading-tight mb-3"><i class="fa-li fas fa-check text-pianote"></i> Detailed song tutorials</li>
                            <li class="leading-tight mb-3"><i class="fa-li fas fa-check text-pianote"></i> Live support</li>
                            <li class="leading-tight"><i class="fa-li fas fa-check text-pianote"></i> 3 FREE Bonuses</li>
                        </ul>
                    </div>
                    <div class="w-72 lg:w-96 mx-auto sm:mx-0">
                        <h2><s class="opacity-50">$611</s> <strong>$177</strong> <span class="text-sm">For your first year</span></h2>

                        <a class=" w-full sm:w-82 join smaller mt-4 @if($theme == 'musora') musora-gold @else bg-{{$theme}} @endif"
                                href="{{ $buttonLink }}"
                        >CLAIM YOUR OFFER</a>
                        <p class="text-sm mt-2"><em>Money-back 90-day guarantee.</em></p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="px-6 py-6 sm:py-8 text-white text-center bg-cover bg-center" style="background:linear-gradient(to bottom,#202F56, #060B2E);">
        <div class="container max-w-4xl mx-auto">
            <h6 class="leading-tight mb-4"><em><strong>PLUS</strong> get these special<br class="sm:hidden"> bonuses when you join today.</em></h6>
            <div style="font-size:0px">
                <div class="bonus-wrap relative inline-block align-top mx-auto mb-4  lg:mb-0 px-1 md:px-3  w-1/2 sm:w-1/6 ">
                    <div class="flip-div inline-block relative w-full group" style=" padding-bottom: 133%;  perspective: 1000px;">
                        <div class="text-center w-full h-full absolute" style="transform-style: preserve-3d;">
                            <div x-ref="front" class="border-2 border-musora front absolute z-20 overflow-hidden rounded-xl w-full h-full transition-transform duration-700" style=" backface-visibility: hidden;">
                                <div class="overflow-hidden rounded-xl h-full w-full bg-black bg-top bg-cover" style="background-image:url(https://www.musora.com/musora-cdn/image/width=460,quality=95/https://d2vyvo0tyx8ig5.cloudfront.net/sales/2022/bonus-chords-scales.jpg);"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="bonus-wrap relative inline-block align-top mx-auto mb-4  lg:mb-0 px-1 md:px-3  w-1/2 sm:w-1/6 ">
                    <div class="flip-div inline-block relative w-full group" style=" padding-bottom: 133%;  perspective: 1000px;">
                        <div class="text-center w-full h-full absolute" style="transform-style: preserve-3d;">
                            <div x-ref="front" class="border-2 border-musora front absolute z-20 overflow-hidden rounded-xl w-full h-full transition-transform duration-700" style=" backface-visibility: hidden;">
                                <div class="overflow-hidden rounded-xl h-full w-full bg-black bg-top bg-cover" style="background-image:url(https://www.musora.com/musora-cdn/image/width=460,quality=95/https://d2vyvo0tyx8ig5.cloudfront.net/sales/2022/bonus-chords-scales.jpg);"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="bonus-wrap relative inline-block align-top mx-auto mb-4  lg:mb-0 px-1 md:px-3  w-1/2 sm:w-1/6 ">
                    <div class="flip-div inline-block relative w-full group" style=" padding-bottom: 133%;  perspective: 1000px;">
                        <div class="text-center w-full h-full absolute" style="transform-style: preserve-3d;">
                            <div x-ref="front" class="border-2 border-musora front absolute z-20 overflow-hidden rounded-xl w-full h-full transition-transform duration-700" style=" backface-visibility: hidden;">
                                <div class="overflow-hidden rounded-xl h-full w-full bg-black bg-top bg-cover" style="background-image:url(https://www.musora.com/musora-cdn/image/width=460,quality=95/https://d2vyvo0tyx8ig5.cloudfront.net/sales/2022/bonus-chords-scales.jpg);"></div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>
    <section class="px-6 py-6 sm:py-8 text-center" style="background:#F6F8FC;">
        <div class="container max-w-4xl mx-auto">
            <h3><strong>You’ve done the hard part. </strong></h3>
            <p>
                Now let’s keep the momentum going.
                You did it.

                And 30 Days to Better Technique is yours for LIFE. You should be proud, because you made the commitment to improve your piano technique. And look where you are now.

                So the question is…

                Where will you go next?
            </p>
            @php
                $gettings = [
                    [
                        'position' => 'left',
                        'img' =>
                            'https://d21q7xesnoiieh.cloudfront.net/fit-in/900x0/filters:quality(95)/marketing/pianote/products/30-day-better-technique/timeline-01.webp',
                        'title' => 'Know exactly what to practice.',
                        'desc' =>
                            'Each day you’ll unlock a new lesson and play WITH Jordan. You don’t have to worry about what to do when you sit on the bench. Jordan’s got you covered.',
                    ],
                    [
                        'position' => 'right',
                        'img' =>
                            'https://d21q7xesnoiieh.cloudfront.net/fit-in/900x0/filters:quality(95)/marketing/pianote/products/30-day-better-technique/timeline-02.webp',
                        'title' => 'Fits any schedule.',
                        'desc' =>
                            'Building technique takes practice. But it doesn’t mean hours of scales every day. Each lesson is short and fun, so you can fit it around your busy schedule.',
                    ],
                    [
                        'position' => 'left',
                        'img' =>
                            'https://d21q7xesnoiieh.cloudfront.net/fit-in/900x0/marketing/pianote/products/30-day-better-technique/timeline-03.webp',
                        'title' => 'The four pillars of technique.',
                        'desc' =>
                            'Each week you’ll focus on a new element of piano technique. You’ll build your finger independence, hand coordination, speed, and musical expression.',
                    ],
                    [
                        'position' => 'right',
                        'img' =>
                            'https://d21q7xesnoiieh.cloudfront.net/fit-in/900x0/filters:quality(95)/marketing/pianote/products/30-day-better-technique/timeline-04.webp',
                        'title' => 'Support from REAL teachers.',
                        'desc' =>
                            'You’ll be supported every step of the way by Pianote’s team of expert instructors. Plus you’ll get to hang with Jordan in an exclusive LIVE Q&A.',
                    ],
                    [
                        'position' => 'left',
                        'img' =>
                            'https://d21q7xesnoiieh.cloudfront.net/fit-in/900x0/filters:quality(95)/marketing/pianote/products/30-day-better-technique/timeline-05.webp',
                        'title' => 'Lifetime Access',
                        'desc' => 'You can access ALL the lessons and downloads from 30 Days to Better Technique for life. That means you can return to your favorite workouts over and over – plus, it means you can work at your own pace.',
                    ],
                ];
            @endphp
            <div class="timeline-container max-w-4xl lg:max-w-4xl mx-auto relative px-4 py-7">
                @foreach ($gettings as $key => $getting)
                    @if ($getting['position'] === 'right')
                        <div
                            class="timeline relative flex flex-col-reverse md:grid md:grid-cols-2 gap-4 md:gap-14 lg:gap-20 mb-16 md:mb-20">
                            <div class="content relative text-left sm:pl-10 md:pl-0">
                                <h4 class="mb-2 md:mb-5 mt-1 md:mt-0"><strong>{{ $getting['title'] }}</strong></h4>
                                <p>{{ $getting['desc'] }}</p>
                            </div>
                            <img class="-mt-7 rounded-lg transition-opacity opacity-0" loading="lazy"
                                onload="this.classList.remove('opacity-0')" src="{{ $getting['img'] }}"
                                alt="{{ $getting['title'] }}" />
                        </div>
                    @else
                        <div
                            class="timeline relative flex flex-col md:grid md:grid-cols-2 gap-4 md:gap-14 lg:gap-20 @if ($key !== 4) mb-16 md:mb-20 @else md:mb-0 @endif">
                            @if (empty($getting['special']))
                                <img class="-mt-7 rounded-lg transition-opacity opacity-0" loading="lazy"
                                    onload="this.classList.remove('opacity-0')" src="{{ $getting['img'] }}"
                                    alt="{{ $getting['title'] }}" />
                            @else
                                <div class="-mt-7 rounded-lg bg-cover bg-center relative aspect-16:9"
                                    style="background-image:url('{{ $getting['img'] }}')"></div>
                            @endif
                            <div class="content relative text-left sm:pl-10 md:pl-0 md:mb-10">
                                <h4 class="mb-2 md:mb-5 mt-1 md:mt-0"><strong>{{ $getting['title'] }}</strong></h4>
                                <p>{{ $getting['desc'] }}</p>
                            </div>
                        </div>
                    @endif
                @endforeach
            </div>

            <h1 class="leading-none sm:-mt-8 sm:mb-8 text-5xl"><i class="fal fa-angle-down text-pianote"></i></h1>
            <h1 class="leading-none"><i class="fal fa-calendar text-pianote"></i></h1>
            <h4 class="text-pianote">But this offer is only available until June 10th.
                So click below and keep your progress going!</h4>
        </div>
    </section>


    @php
        $testimonials = [
            [
            'image' => 'https://d21q7xesnoiieh.cloudfront.net/fit-in/500x0/marketing/pianote/membership/homepage/2023/testimonials/iankershaw.jpg',
            'title' => "Such a fantastic and welcoming student community.",
            'description' => "When I signed up for Pianote, I knew I was going to get Lisa’s great energy, the Method, the courses, the bootcamps, and the student reviews.<br><br>But my breakthrough came when I realized that sitting behind all of this is such a fantastic and welcoming, supportive student community. It’s this community – as well as the teachers and the rest of the Pianote team – that really actively encourages you to share your progress and practice. And it doesn’t have to be perfect. And that really does encourage you to practice more. And it’s in that sharing and practice that the real breakthroughs come. Thank you!",
            'name' => 'Ian Kershaw',
            'video' => '660596700',
            'location' => 'United Kingdom',
            ],
            [
            'image' => 'https://d21q7xesnoiieh.cloudfront.net/fit-in/500x0/marketing/pianote/membership/homepage/2023/testimonials/jaydemcintosh.jpg',
            'title' => "I’ve had to give up on a lot of my dreams. Then I discovered Pianote.",
            'description' => "I’ve been chronically ill for the last six years, which means I’ve had to give up on a lot of my dreams and goals.<br><br>During my health journey, my interest in piano and my connection to music really arose – but it also seemed impossible. I had no prior music knowledge and couldn’t even get out of bed some days. This is when I discovered Pianote and they’ve been amazing.<br><br>I have to work at a very slow pace due to my health, but I’ve already learned so many basics. I can play some of my all-time favorite songs – and it’s just so awesome to know I can learn from home and accomplish one of my dreams. I’m so excited to keep learning and I recommend Pianote so much.",
            'name' => 'Jayde McIntosh',
            'video' => '660596722',
            'location' => 'Australia',
            ],
            [
            'image' => 'https://d21q7xesnoiieh.cloudfront.net/fit-in/500x0/marketing/pianote/membership/homepage/2023/testimonials/xitlalicaballero2.jpg',
            'title' => "I’m six years old. My biggest moment is when I play Für Elise.",
            'description' => "My name is Xitlali. I’m six years old. I started playing piano when I was five. A few weeks ago, I started using pianote. My biggest moment is when I play Für Elise.",
            'name' => 'Xitlali Caballero',
            'video' => '660596752',
            'location' => 'Florida, USA',
            ],
            [
            'image' => 'https://d21q7xesnoiieh.cloudfront.net/fit-in/500x0/marketing/pianote/membership/homepage/2023/testimonials/nabilabdelmoneim.jpg',
            'title' => "I’m a lot better at using both hands and it opened up more songs.",
            'description' => "You guys make learning way too fun.<br><br>I’ve had two breakthrough moments. There was this video that promised hand independence in five days. And what do you know? A few days later I’m a lot better at using both hands and it just opened up a bunch more songs for me. And my second breakthrough moment was finding this chord chart that made it so much easier to go through the chords and practice them. And I started realizing that these chords sounded a lot like the ones I play on guitar. So I managed to take the notes that were in the practice log and apply them to my guitar, and actually learned theory for both instruments at once. Thank you Lisa and happy playing!",
            'name' => 'Nabil Abd El Moneim',
            'video' => '660596735',
            'location' => 'British Columbia, Canada',
            ],
            [
            'image' => 'https://d21q7xesnoiieh.cloudfront.net/fit-in/500x0/marketing/pianote/membership/homepage/2023/testimonials/jessripley.jpg',
            'title' => "I’m blown away by the program you’ve created.",
            'description' => "Pianote is an insanely encouraging and supportive community run by an insanely encouraging and supportive team. Sincerely, I’m blown away by the program you’ve created.<br><br>I sat down one day and it just clicked. From then on, I’ve felt VERY encouraged to keep learning and practicing. It’s fulfilling and fun to see myself progress and achieve goals. Now I’m playing with both hands at the same time with confidence – and I’ve started playing along with more backing tracks and making up my own songs.",
            'name' => 'Jess Ripley',
            'location' => 'California, USA',
            ],
            [
            'image' => 'https://d21q7xesnoiieh.cloudfront.net/fit-in/500x0/marketing/pianote/membership/homepage/2023/testimonials/anselmdesouza.jpg',
            'title' => "Helped coordinate my left and right hands.",
            'description' => "I was using a piano app, but it wasn’t personal and I had to figure it out on my own most of the time. So I joined Pianote and went back to the basics.<br><br>Pianote helped coordinate my left and right hands. The explanations and instructions are very clear, easy to follow, and slowly I noticed I was improving by using skills from one lesson to the next. It’s structured to allow you to build the foundations, and the tips and tricks videos make your playing special. The lessons are fun and the instructors are engaging.",
            'name' => 'Anselm de Souza',
            'location' => 'Singapore',
            ],
            [
            'image' => 'https://d21q7xesnoiieh.cloudfront.net/fit-in/500x0/marketing/pianote/membership/homepage/2023/testimonials/johnmaclean.jpg',
            'title' => "My 6 year old daughter started dancing as I played.",
            'description' => "Before Pianote and The Method, I was completely lost in terms of knowing how to become a better musician. All I would do is try to play songs, but without any of the structure and practice that is required to actually improve. And with face to face lessons I wasn’t really progressing much between the lessons. But having access to the video tutorials online lets me go back as often as I need to.<br><br>My biggest breakthrough has been independent hand control – allowing me to hear rich music that I’m creating for the first time. And gaining that confidence has allowed me to start to improvise the pieces that I learn.<br><br>The lightbulb moment happened when my 6 year old daughter started dancing as I played! You must be doing something right if someone dances to music that you’re playing, right?",
            'name' => 'John Maclean',
            'location' => 'United Kingdom',
            ],
            [
            'image' => 'https://d21q7xesnoiieh.cloudfront.net/fit-in/500x0/marketing/pianote/membership/homepage/2023/testimonials/serenadorward.jpg',
            'title' => "If I was taught this way as a child, I would have never quit.",
            'description' => "I decided to sign up with Pianote not only to re-learn how to play the piano, but also because my mental health was really suffering and I needed something positive to focus on that was just for ME. I knew almost immediately that this was the answer I had been looking for. It felt like the heaviness on my shoulders got a bit lighter after every piano session.  And even though the lessons are virtual, it was like Lisa was right there beside me cheering me on.<br><br>I was blown away by how quickly I progressed with a few tutorials from Lisa. My overall confidence improved, especially with improvisation. Now I know all these little tricks (fills & riffs) and how to play inversions and practice chords in ways that sound so lovely.  If I had been taught this way as a child, I probably never would have quit.",
            'name' => 'Serena Dorward',
            'location' => 'Ontario, Canada',
            ],
];
        $youtube = convertNumber(Prices::$pianoteYoutubeSubsc);
        $facebook = convertNumber(Prices::$pianoteFacebookLikes);
        $instagram = convertNumber(Prices::$pianoteInstagramFollowers);
    @endphp
    @include('musora.sales.components.testimonials-section', [
        'header' => 'pianists',
        'youtubeLink' => 'https://www.youtube.com/pianolessonscom/',
        'facebookLink' => 'https://facebook.com/pianoteofficial/',
        'instagramLink' => 'https://instagram.com/pianoteofficial/',
    ])

    @php
        $logo =
            'https://d21q7xesnoiieh.cloudfront.net/fit-in/400x0/filters:quality(95)/marketing/pianote/products/30-day-better-technique/better-technique-guarantee.webp';
        $guaranteeText = "We’re so confident that you’ll LOVE the improvements to your piano technique after Jordan’s course, that we’re giving you THREE times as long to put it to the test.
                        <br><br>
                        <strong>The course is 30 days, but you’ll have 90 days to try it risk-free.</strong>
                        <br><br>
                        That means you’ll have enough time to go through every lesson and play with Jordan - THREE times. And if -- after you’ve put in the work -- you don’t see real improvements to your technique... 
                        <br><br>
                        If your fingers don’t feel stronger and your hands aren’t more coordinated…
                        <br><br>
                        If you don’t enjoy playing the piano more than you did before you started…
                        <br><br>
                        Contact support@pianote.com within those 90 days and get a refund.";
        $guaranteeHeader = "<strong>The 90-Day “Better <br class='inline sm:hidden'> Technique” Guarantee</strong>";
    @endphp

    <div class="h-5 sm:h-10 -mt-5 sm:-mt-10 relative z-10"
        style="background: linear-gradient(to bottom right, transparent calc(50% - 1px), transparent, #00101D calc(50% + 1px));">
    </div>
    <section class="text-center text-white px-5 sm:px-6 pb-10 sm:pb-14 lg:pb-20 py-10 sm:py-14 lg:pt-32 relative z-10"
        style="background-color:#00101D; border: 1px solid #00101D">
        <div class="container max-w-6xl mx-auto">
            @include('pianote._partials._guarantee-section', [
                'containerWidth' => 'max-w-6xl',
                'imageUrl' =>
                    'https://d21q7xesnoiieh.cloudfront.net/fit-in/770x0/filters:quality(95)/marketing/pianote/products/30-day-better-technique/guarantee-collage.webp',
            ])
        </div>
    </section>
    <div class="unstick-trigger block"></div>
    <div id="customize-anchor" class="anchor"></div>
    <div id="order" class="anchor"></div>
    <div style="background:linear-gradient(to bottom,#202F56, #060B2E);">
        <section class="py-14 sm:py-24 lg:py-32 relative overflow-hidden text-white text-center customize px-4 lg:px-6">
            <div class="container mx-auto relative z-50  max-w-6xl ">
                <div class="w-full">
                    <h2 class="leading-tight mb-4"><strong class="text-musora">Save 71% with your</strong><br>exclusive Webinar Bundle.</h2>
                    <div class="bonus-wrap relative inline-block align-top mx-auto px-1 md:px-3 w-full max-w-lg">
                        <div class=" inline-block relative w-full group" style="padding-bottom: 45%;perspective: 1000px;">
                            <div class="text-center w-full h-full absolute" style="transform-style: preserve-3d;">
                                <div class="  front absolute z-20 overflow-hidden rounded-3xl w-full h-full transition-transform duration-700" style="backface-visibility: hidden;">
                                    <div class="h-full w-full bg-top bg-cover" style="background-image:url('https://www.musora.com/musora-cdn/image/width=850,quality=95/https://d2vyvo0tyx8ig5.cloudfront.net/sales/2023/pianote-annual-2w-card.png');"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <br>
                    <h4 class="leading-tight mt-4 sm:mt-5 mb-2"><strong><span class="text-musora">SAVE 26%</span> ON YOUR PIANOTE MEMBERSHIP</strong> <br class="hidden sm:inline">+ GET 3 COURSES, 6 POSTERS &amp; THE CHORDS AND SCALES BOOK.</h4>
                    <a class="join   my-4 md:my-6 w-full max-w-xs md:max-w-lg lg:max-w-xl" style="padding: 20px 10px;" href="{{ $buttonLink }}">
                        CLAIM YOUR OFFER
                    </a>
                    <p class="leading-tight text-sm mb-6"><em>First year discount: <s class="opacity-40">$240</s>
                            <strong> $177 </strong>.
                            <br class="inline sm:hidden"> Cancel anytime. 90-day guarantee.</em></p>
                </div>
                <div style="font-size:0px">

                    @php
                        $bonuses = [
                            [
                                'image' => 'marketing/pianote/membership/homepage/2024/bonus-chords-scales.webp',
                                'title' => 'Chords & <br>Scales Book',
                                'description' => 'Your encyclopedia of piano chords & scales.',
                                'price' => floatval($productPrices['piano-chords-and-scales-guide']->price),
                                'shipping' => 'true'
                            ],
                            [
                            'image' => 'marketing/pianote/membership/homepage/2024/piano-technique-made-easy.webp',
                            'title' => 'Piano Technique<br> Made Easy',
                            'description' => 'Your ultimate guide to learning the piano. Learn EVERY scale, chord, arpeggio, and key signature.',
                            'price' => floatval($productPrices['piano-technique-made-easy']->price),
                            ],
                            [
                                'image' => 'https://d2vyvo0tyx8ig5.cloudfront.net/sales/promos/november/bonuses/improv-musical-freedom.jpg',
                                'title' => 'Improvisation & Musical Freedom',
                                'description' => 'Learn to improvise from one of the best piano players in the world, Jesús Molina',
                                'price' => floatval($productPrices['jesus-molina-improvisation-and-musical-freedom-pack']->price),
                            ],
                        ]
                    @endphp
                    @foreach($bonuses as $bonus)
                        <div
                            class="bonus-wrap relative inline-block align-top mx-auto mb-4 px-1 md:px-3 @if(!empty($bonusWidth)) {{ $bonusWidth }} @else w-1/2 md:w-1/4 lg:w-1/5 @endif"
                            x-data="{
                        flipped: false,
                    }"
                            x-on:click="
                        flipped = !flipped;
                        if(flipped){
                            $refs.front.classList.add('rotate-y-180');
                            $refs.back.classList.remove('-rotate-y-180');
                            $refs.back.classList.add('rotate-y-0');
                        }
                        else {
                            $refs.front.classList.remove('rotate-y-180');
                            $refs.back.classList.add('-rotate-y-180');
                            $refs.back.classList.remove('rotate-y-0');
                        }
                    "
                        >
                            <div class="flip-div inline-block relative w-full group" style="@if(empty($bonus['bigCard'])) padding-bottom: 133%; @else padding-bottom: 103%; @endif perspective: 1000px;">
                                <div class="text-center w-full h-full absolute cursor-pointer" style="transform-style: preserve-3d;">
                                    <div
                                        x-ref="front"
                                        class="border-2 border-musora front absolute z-20 overflow-hidden rounded-xl w-full h-full transition-transform duration-700"
                                        style="@if(!empty($bonus['special'])) overflow: visible;border-color: #cda880; @endif backface-visibility: hidden;">
                                        @if(!empty($bonus['badge']))
                                            <h6 class="absolute text-white top-0 left-0 w-full py-0.5 bg-{{ $theme }} font-bebas uppercase">{{ $bonus['badge'] }}</h6>
                                        @endif
                                        <div class="overflow-hidden h-full w-full bg-black bg-top bg-cover"
                                            :class="{'opacity-0': !lazyLoad, 'opacity-100': lazyLoad}"
                                            x-intersect.once="lazyLoad = true">
                                            <picture class="absolute inset-0 w-full h-full object-cover">
                                                <source srcset="https://d21q7xesnoiieh.cloudfront.net/fit-in/980x0/filters:quality(95)/{{ $bonus['image'] }}"
                                                    media="(min-width: 640px)">
                                                <img src="https://d21q7xesnoiieh.cloudfront.net/fit-in/420x0/filters:quality(95)/{{ $bonus['image'] }}"
                                                    alt="Bonus Image"
                                                    class="w-full h-full object-cover opacity-0 transition-opacity"
                                                    loading="lazy"
                                                    onload="this.classList.remove('opacity-0')">
                                            </picture>
                                        </div>
                                        <div class="absolute z-40 text-center top-1/2 left-1/2 text-white transition-opacity duration-300 transform -translate-x-1/2 -translate-y-1/2 visible opacity-0 group-hover:opacity-100 text-shadow-2">
                                            <i class="fas fa-arrow-right text-4xl"></i><br>
                                            <p class="text-sm"><strong>DETAILS</strong></p>
                                        </div>
                                    </div>
                                    <div
                                        x-ref="back"
                                        class="back border-2 border-musora absolute z-40 overflow-hidden rounded-xl w-full h-full transition-transform duration-700 -rotate-y-180"
                                        style="backface-visibility: hidden;"
                                    >
                                        <div class="w-full h-full mx-auto text-center text-white flex flex-wrap justify-center items-center content-center p-2 md:p-3" style="background:linear-gradient(to bottom, #01050f, #021225);">
                                            <p class="leading-normal mx-auto text-sm">{!! $bonus['description'] !!}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <p class="w-full leading-normal mt-2">
                                @if(!empty($bonus['title']))
                                    <strong class="font-black leading-tight inline-block mb-1">{!!  $bonus['title']  !!}</strong><br>
                                @endif
                                <span style="text-transform:uppercase; display:inline-block;">
                            @if(!empty($bonus['price']))
                                        <s class="opacity-40">${{ $bonus['price'] }}</s>
                                    @endif
                                    @if(!empty($bonus['customText']))
                                        <strong class="text-musora">{{ $bonus['customText'] }}</strong>
                                    @else
                                        <strong class="text-musora">FREE</strong>
                                    @endif
                                <br>
                                <em>
                                    @if(!empty($bonus['shipping']))
                                        Free Shipping
                                    @else
                                        Online Access
                                    @endif
                                </em>
                            </span>
                            </p>
                        </div>
                    @endforeach
                    <div class="flex flex-wrap sm:flex-nowrap justify-center items-start my-2 sm:my-4">
                        <div class="relative mb-3 sm:mb-0 mx-1 sm:mx-2 lg:mx-3">
                            <img alt="brand tile" class="hidden sm:inline-block sm:h-24 md:h-28 lg:h-36 rounded-xl" src="https://d21q7xesnoiieh.cloudfront.net/fit-in/600x0/marketing/assets/drumeo-bonus.jpg">
                            <img alt="brand tile" class="sm:hidden inline-block h-44 rounded-xl" src="https://d21q7xesnoiieh.cloudfront.net/fit-in/600x0/marketing/assets/drumeo-bonus-m.jpg">
                            <p class="absolute w-full text-sm lg:text-base uppercase font-bebas" style="bottom: 20%;">DRUM LESSONS INCLUDED</p>
                        </div>
                        <div class="relative mb-3 sm:mb-0 mx-1 sm:mx-2 lg:mx-3">
                            <img alt="brand tile" class="hidden sm:inline-block sm:h-24 md:h-28 lg:h-36 rounded-xl" src="https://d21q7xesnoiieh.cloudfront.net/fit-in/600x0/marketing/assets/guitareo-bonus.jpg">
                            <img alt="brand tile" class="sm:hidden inline-block h-44 rounded-xl" src="https://d21q7xesnoiieh.cloudfront.net/fit-in/600x0/marketing/assets/guitareo-bonus-m.jpg">
                            <p class="absolute w-full text-sm lg:text-base uppercase font-bebas" style="bottom: 20%;">GUITAR LESSONS INCLUDED</p>
                        </div>
                        <div class="relative mb-3 sm:mb-0 mx-1 sm:mx-2 lg:mx-3">
                            <img alt="brand tile" class="hidden sm:inline-block sm:h-24 md:h-28 lg:h-36 rounded-xl" src="https://d21q7xesnoiieh.cloudfront.net/fit-in/600x0/marketing/assets/singeo-bonus.jpg">
                            <img alt="brand tile" class="sm:hidden inline-block h-44 rounded-xl" src="https://dpwjbsxqtam5n.cloudfront.net/sales/2023/singeo-bonus-m.jpg">
                            <p class="absolute w-full text-sm lg:text-base uppercase font-bebas" style="bottom: 20%;">SINGING LESSONS INCLUDED</p>
                        </div>
                    </div>
                </div>
                <h3 class="leading-tight mt-6 mb-1">
                    <s class="opacity-50">$240</s>
                    <strong>$177</strong> <span class="text-musora">(Save 26%)</span>
                </h3>
                <p class="text-sm mb-4 sm:mb-6">For your first year, then $240/yr.</p>
                <a class="join   mb-4 md:mb-5 w-full max-w-xs md:max-w-lg lg:max-w-3xl" style="padding: 20px 10px;" href="{{ $buttonLink }}">
                    CLAIM YOUR OFFER
                </a>
                <br>
                <a class="inline-block opacity-70 mt-2" href="/ecommerce/add-to-cart?products[PIANOTE-MEMBERSHIP-1-MONTH]=1&amp;redirect=%2Forder"><p><u><em>Or start a monthly membership for <br class="inline-block md:hidden">$30/month. (no bonuses)</em></u></p></a>
            </div>
        </section>
    </div>

    @include('musora.sales.components.app-section', [
        'image' => 'marketing/pianote/membership/homepage/2023/devices.png',
        'appleUrl' => 'https://apps.apple.com/us/app/musora/id1619053766?ppid=afddd5f6-fbc3-46c9-b6e4-6c9e6a6936af',
        'googleUrl' => 'https://play.google.com/store/apps/details?id=com.musoraapp&listing=pianote_previews',
    ])

    @include('pianote._partials.faq')

    @include('_partials.components.video-modal',[
        'name' => 'soundslice',
        'video' => '4JGlc',
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

    <!-- <script>
        $(document).ready(function () {
            var stickyBar = $('.promo-banner');
            $(window).scroll(function () {
                var stickTrigger = $('.sticky-trigger').offset().top;
                var unstickTrigger = $('.unstick-trigger').offset().top;
                if ($(this).scrollTop() > (unstickTrigger - 115)) {
                    stickyBar.removeClass('fixed mt-0');
                }
                if ($(this).scrollTop() < stickTrigger - 115) {
                    stickyBar.removeClass('fixed mt-0');
                }
                if ($(this).scrollTop() < unstickTrigger - 115 && $(this).scrollTop() > stickTrigger - 115) {
                    stickyBar.addClass('fixed mt-0');
                }
            });
        });
    </script> -->
    <script src="https://cdn.jsdelivr.net/npm/@splidejs/splide@4.0.7/dist/js/splide.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/lazysizes/5.3.2/lazysizes.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/lazysizes/5.3.2/plugins/unveilhooks/ls.unveilhooks.min.js"></script>
    @include('_partials.components.countdown',[
        'countdownDate' => '2023-10-5 2:13:00',
        'promoVersion' => false
    ])
    @yield('scripts')
@stop
