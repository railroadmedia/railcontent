@extends('guitareo.lead-gen.lead-gen-layout')

@section('meta')
    @parent

    <title>2 Simple Guitar Tricks | Guitareo</title>
    <meta name="description" content="How to use vibrato & palm muting to unlock new possibilities on the guitar."/>

    <meta property="og:image" content="https://guitareo.s3.amazonaws.com/lead-gen/guitar-tricks/og-image.jpg">
    <meta property="og:title" content="2 Simple Guitar Tricks">
    <meta property="og:description" content="How to use vibrato & palm muting to unlock new possibilities on the guitar.">
    <meta property="og:url" content="https://www.guitareo.com/guitar-tricks/">

    <link rel="preload" href="/marketing/parcel/guitareo/guitar-tricks.css" as="style" onload="this.onload=null;this.rel='stylesheet'">
    <noscript><link rel="stylesheet" href="/marketing/parcel/guitareo/guitar-tricks.css"></noscript>

    <style>
        .header-bg {
            background-image:url('https://cdn.musora.com/image/fetch/w_800,q_auto:best/https://guitareo.s3.amazonaws.com/lead-gen/guitar-tricks/header.jpg');
            background-position-y: top;
            background-position-x: center;
        }

        @media (min-width:768px) {
            .header-bg {
                background-image:url('https://cdn.musora.com/image/fetch/w_1200,q_auto:best/https://guitareo.s3.amazonaws.com/lead-gen/guitar-tricks/header.jpg');
                background-position: center;
            }
        }

        @media (min-width:1024px) {
            .header-bg {
                background-image:url('https://cdn.musora.com/image/fetch/w_2000,q_auto:best/https://guitareo.s3.amazonaws.com/lead-gen/guitar-tricks/header.jpg');
            }
        }
    </style>
@stop

@section('scripts')
    @parent
    <script>
        $(document).ready(function () {
            $(document).foundation();
        });
    </script>
    <script src="/marketing/js/modal-autoplay.js"></script>
@stop

@section('body')
    @include('guitareo.lead-gen.partials._header1', [
        "bgColor" => "black",
        "imgs" => [
            '<img class="md:max-w-sm lg:max-w-md" style="max-width:220px;" src="https://guitareo.s3.amazonaws.com/lead-gen/guitar-tricks/logo-with.png">',
        ],
        "playButton" => "down",
        "headLine" => '<h2 class="mb-4 md:mb-5">How to use <strong>vibrato</strong> & <strong>palm muting</strong> to <br class="hidden sm:inline">unlock new possibilities on the guitar.</h2>',
        "formId" => "Guitareo - Engagement - Trigger - Guitar Tricks - Web Form",
        "formName" => 'Guitar Tricks',
        "buttonText" => 'Start Now',
        "submitButtonColor" => 'linear-gradient(180deg,#ffd500,#ffb600)',
    ])

    @php
        $steps = [
            [
                'img' => 'https://guitareo.s3.amazonaws.com/lead-gen/guitar-tricks/1-intro.png',
                'title' => 'Introduction',
                'exclusive' => false,
                'commercial' => false,
            ],
            [
                'img' => 'https://guitareo.s3.amazonaws.com/lead-gen/guitar-tricks/2-vibrato-magic.png',
                'title' => 'Skill #1:<br> Vibrato',
                'exclusive' => false,
                'commercial' => false,
            ],
            [
                'img' => 'https://guitareo.s3.amazonaws.com/lead-gen/guitar-tricks/3-shampoo-song.png',
                'title' => 'The Shampoo<br> Jingle',
                'exclusive' => true,
                'commercial' => true,
            ],
            [
                'img' => 'https://guitareo.s3.amazonaws.com/lead-gen/guitar-tricks/4-palm-muting-madness.png',
                'title' => 'Skill #2:<br> Palm Muting',
                'exclusive' => false,
                'commercial' => false,
            ],
            [
                'img' => 'https://guitareo.s3.amazonaws.com/lead-gen/guitar-tricks/5-truck-song.png',
                'title' => 'The Truck<br> Jingle',
                'exclusive' => true,
                'commercial' => true,
            ],
            [
                'img' => 'https://guitareo.s3.amazonaws.com/lead-gen/guitar-tricks/6-your-future-awaits.png',
                'title' => 'Your Future<br> Awaits',
                'exclusive' => false,
                'commercial' => false,
                'last' => true,
            ],
        ]
    @endphp

    <section class="your-mission text-center text-white py-10 px-4 md:py-12 md:px-0 lg:py-16" style="background-image:url(https://guitareo.s3.amazonaws.com/lead-gen/guitar-tricks/map-background.jpg); background: #000314 center/cover no-repeat;">
        <div class="container lg:mx-auto max-w-6xl">
            <h2>Your mission starts <strong class="text-yellow">HERE</strong>.</h2>
            <h4 class="leading-7 mt-2 mx-auto mb-5 max-w-xl md:mt-4 md:mb-9 lg:max-w-3xl lg:mt-4 l:mb-12">Most guitar lessons are boring because the end-result is <strong>so far away</strong>. This is different. Rob Scallon is
                taking you on a <u>free 6-video mission</u> where you’ll learn how to play those super catchy but slightly
                annoying COMMERCIAL JINGLES on the guitar-- and to complete your mission you’ll need to pick up two
                vital guitar skills that will last a lifetime. <em>Are you up for the challenge?</em></h4>
            <div class="flex flex-wrap">
                @foreach ($steps as $step)
                    <div class="w-full step @if(empty($lesson['last'])) mb-10 @endif sm:w-1/2 lg:w-1/3 lg:mb-12">
                        <div class="pic-wrap relative mx-auto">
                            <img src="https://cdn.musora.com/image/fetch/w_1300,q_auto:best/{{ $step['img'] }}">
                            @if ($step['exclusive'])
                                <p class="absolute font-bold text-xs leading-none uppercase -top-2 -right-7 md:text-sm md:-top-3 md:-right-9" style="font-family: Permanent Marker, sans-serif; transform: rotate(35deg);">Exclusive<br>
                                    @if ($step['commercial'])
                                        <span class="text-yellow">Commercial</span>
                                    @endif
                                </p>
                            @endif
                        </div>
                        <h3 class="text-yellow font-black uppercase"><strong>{!! $step['title'] !!}</strong></h3>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    @include('guitareo.lead-gen.partials._meet-your-teacher1', [
        "font" => "font-bison-bold",
        "bgColor" => "black",
        "meetYourTeacher" => '<h2>Meet your teacher...</h2>',
        "name" => '<img class="w-full mb-80 md:my-7 md:max-w-md" src="https://guitareo.s3.amazonaws.com/lead-gen/guitar-tricks/rob-scallon.png" style="max-width:210px;">',
        "desc" => "Rob Scallon plays guitar for the internet -- with 2M Subscribers on YouTube and counting -- and now he’s sharing his best tips to help YOU get more out of this amazing instrument.",
        "asSeenColor" => "text-yellow",
        "thumbnails" => [
            [
                "src" => "https://img.youtube.com/vi/wC9QTHv2eQ4/mqdefault.jpg",
                "desc" => "Slap Guitar 101",
                "views" => '<em class="text-yellow">2.8m views</em>',
                "dataOpen" => "slap",
            ],
            [
                "src" => "https://img.youtube.com/vi/MNzBFgwkU0A/mqdefault.jpg",
                "desc" => "Getting Delay<br> w/o Effects</strong>",
                "views" => '<em class="text-yellow">6.4m views</em>',
                "dataOpen" => "delay",
            ],
            [
                "src" => "https://img.youtube.com/vi/EjHDp_bDjeU/mqdefault.jpg",
                "desc" => "One Fret Song",
                "views" => '<em class="text-yellow">4.8m views</em>',
                "dataOpen" => "fret",
            ],
        ]
    ])


    @include('guitareo.lead-gen.partials._trailer',[
        "trailer" => "//player.vimeo.com/video/476482512?autoplay=1",
        "slap" => "https://www.youtube.com/embed/wC9QTHv2eQ4?autoplay=1",
        "delay" => "https://www.youtube.com/embed/MNzBFgwkU0A?autoplay=1",
        "fret" => "https://www.youtube.com/embed/EjHDp_bDjeU?autoplay=1",
    ])

    @include('guitareo.lead-gen.partials._enter-email', [
        "bgImg" => "https://guitareo.s3.amazonaws.com/lead-gen/guitar-tricks/order-background.jpg",
        "img" => '<img class="w-full max-w-md" src="https://guitareo.s3.amazonaws.com/lead-gen/guitar-tricks/logo-with.png">',
        "text" => '<h2 class="my-10">Enter your email below<br class="sm:hidden"> to get started!</h2>',
        "formId" => "Guitareo - Engagement - Trigger - Guitar Tricks - Web Form",
        "formName" => 'Guitar Tricks',
        "submitButtonColor" => 'orange',
    ])
@stop
