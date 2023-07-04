@extends('pianote.lead-gen.lead-gen-layout-tw')

@section('meta')
    @parent
    <title>Classical Piano Quick Start | Pianote</title>
    <meta property="og:title" content="Classical Piano Quick Start | Pianote">
    <meta name="description" content="Start playing beautiful classical piano with 4 easy lessons.">
    <meta property="og:description" content="Start playing beautiful classical piano with 4 easy lessons.">
    <meta property="og:image" content="https://d2vyvo0tyx8ig5.cloudfront.net/lead-gen/classical-piano/og-image2.jpg" style="display: none;">
    <meta property="og:url" content="https://www.pianote.com/classical-piano">

@endsection

@section('head')
    @parent
    <link href="https://fonts.googleapis.com/css2?family=Libre+Caslon+Text&display=swap" rel="stylesheet">
    <link href="{{ asset('/marketing/parcel/drumeo/lead-gen-learn-songs.css') }}" rel="stylesheet">
    <style>
        .font-caslon {
            font-family:"Libre Caslon Text";
        }

        .text-yellow-special {
            color:#f9d574;
        }
    </style>
    <style>
        .header-bg {
            background-size:1250px;
            background-image: url('https://www.musora.com/musora-cdn/image/width=1400,quality=85/https://d2vyvo0tyx8ig5.cloudfront.net/lead-gen/classical-piano/header2.jpg');
        }
        .teacher-gradient {
            background:linear-gradient(to top, #00101d 40%, transparent 75%);
        }
        .teacher-section {
            background: #00101d 30px top/530px no-repeat;
        }
        .enter-email {
            background-image:url('https://www.musora.com/musora-cdn/image/width=900,quality=85/https://d2vyvo0tyx8ig5.cloudfront.net/lead-gen/classical-piano/final-bg.jpg');
        }
        @media (min-width: 768px) {
            .header-bg {
                background-size:cover;
                background-image: url('https://www.musora.com/musora-cdn/image/width=1500,quality=85/https://d2vyvo0tyx8ig5.cloudfront.net/lead-gen/classical-piano/header2.jpg');
            }
            .teacher-gradient {
                background:linear-gradient(to left, #00101d, transparent 80%);
            }
            .teacher-section {
                background-size:700px;
                background-position:-70px 50%;
            }
            .enter-email {
                background-image:url('https://www.musora.com/musora-cdn/image/width=1200,quality=85/https://d2vyvo0tyx8ig5.cloudfront.net/lead-gen/classical-piano/final-bg.jpg');
            }
        }
        @media (min-width: 1024px) {
            .header-bg {
                background-image: url('https://www.musora.com/musora-cdn/image/width=2500,quality=85/https://d2vyvo0tyx8ig5.cloudfront.net/lead-gen/classical-piano/header2.jpg');
            }
            .teacher-gradient {
                background:linear-gradient(to left, #00101d, transparent 60%);
            }
            .teacher-section {
                background-size:850px;
                background-position:37% 50%;
            }
            .enter-email {
                background-image:url('https://www.musora.com/musora-cdn/image/width=1500,quality=85/https://d2vyvo0tyx8ig5.cloudfront.net/lead-gen/classical-piano/final-bg.jpg');
            }
        }
    </style>
@endsection

@php
    $features = [
        [
            "img" => "https://i.vimeocdn.com/video/1348484700-f1676cc5d71f95c91af4359c80dd48f31d8459d6d2e424ea221682a7da1e3624-d_350.jpg",
            "title" => "5 Classical Piano Tips",
        ],
        [
            "img" => "https://i.vimeocdn.com/video/1348485549-add695e75f60eedd07eec845c0e07a8e9468795b94d2400bcc4f3288db9bb0db-d_350.jpg",
            "title" => "Hand Positioning & Exercises",
        ],
        [
            "img" => "https://i.vimeocdn.com/video/1348486156-e5fd383daef14bde0507d3485eb4935b1457be075f4546b3debca6f2d5c80be5-d_350.jpg",
            "title" => "Playing Your First Classical Piece",
        ],
        [
            "img" => "https://i.vimeocdn.com/video/1348487138-78a002bff259c65a103bb4a45a97021e03eba1da366155a554ba74b3a38a6da2-d_350.jpg",
            "title" => "Playing With Expression",
        ],
    ];
@endphp

@section('page-body')
    @include('pianote.lead-gen.partials.header1',[
        "lowerImg" => '<img class="h-10 md:h-20 lg:h-24" src="https://www.musora.com/musora-cdn/image/width=1500,quality=85/https://d2vyvo0tyx8ig5.cloudfront.net/lead-gen/classical-piano/logo.png" alt="classical-piano-logo">',
        "text" => '<div class="mx-auto mt-2 md:mt-3 mb-4 md:mb-6 max-w-xs md:max-w-full px-4 md:px-0 lg:text-lg lg:leading-normal">Start playing beautiful classical piano with 4 easy lessons.<br class="hidden md:inline"> Enter your email below for your free lessons.</div>',
        "playButtonStyles" => 'mt-48 mb-6 md:mt-72 md:mb-16',
        "formId" => "Pianote - Engagement - Trigger - Classical Piano - Web Form",
        "formName" => "Classical Piano Quick Start",
    ])

    <section class="text-center text-white px-4 py-10 md:px-10 md:py-16 lg:py-24 lg:px-16 relative" style="background:#0b1618 url(https://www.musora.com/musora-cdn/image/width=1500,quality=85/https://d2vyvo0tyx8ig5.cloudfront.net/lead-gen/classical-piano/promo-bg.jpg) center center/cover;">
        <div class="px-5 py-6 md:p-10 lg:py-20 lg:px-14 rounded-3xl relative z-10" style="background:linear-gradient(to bottom, #01101d 50%, #131632);">
            <div class="container mx-auto">
                <h2 class="font-caslon text-yellow-special">Discover the world of<br class="inline lg:hidden"> classical piano today!</h2>
                <p class="text-left max-w-2xl mt-2 md:mt-4 mb-6 md:mb-10">Start learning how to play beautiful classical
                    music on the piano in just 4 lessons. You’ll learn the proper techniques and exercises to build your
                    piano foundation so you can play your first classical piece! And at the end of the course, you’ll
                    learn the secrets to playing with emotion and expression so you can sound amazing on the piano.</p>

                <div class="flex flex-wrap items-start justify-center mx-auto max-w-xs md:max-w-2xl lg:max-w-5xl" >
                    @foreach ($features as $feature)
                        <div class="px-1.5 lg:px-3 inline-block w-1/2 md:w-1/4 mb-2 md:mb-0">
                            <div class="border-4 rounded-xl w-full md:mb-1 overflow-hidden"><div class="aspect-16:9 bg-cover bg-black bg-center" style="background-image:url(https://www.musora.com/musora-cdn/image/width=350,quality=85/{{ $feature['img'] }});"></div></div>
                            <p class="leading-tight text-sm hidden md:inline-block"><strong>{{ $feature['title'] }}</strong></p>
                        </div>
                    @endforeach
                </div>
            </div>
            <img class="z-20 absolute transform top-0 left-0 h-14 md:h-20 lg:h-24" src="https://www.musora.com/musora-cdn/image/width=200,quality=85/https://d2vyvo0tyx8ig5.cloudfront.net/lead-gen/classical-piano/corner.png" alt="corner-decoration">
            <img class="z-20 absolute transform rotate-90 top-0 right-0 h-14 md:h-20 lg:h-24" src="https://www.musora.com/musora-cdn/image/width=200,quality=85/https://d2vyvo0tyx8ig5.cloudfront.net/lead-gen/classical-piano/corner.png" alt="corner-decoration">
            <img class="z-20 absolute transform -rotate-90 bottom-0 left-0 h-14 md:h-20 lg:h-24" src="https://www.musora.com/musora-cdn/image/width=200,quality=85/https://d2vyvo0tyx8ig5.cloudfront.net/lead-gen/classical-piano/corner.png" alt="corner-decoration">
            <img class="z-20 absolute transform rotate-180 bottom-0 right-0 h-14 md:h-20 lg:h-24" src="https://www.musora.com/musora-cdn/image/width=200,quality=85/https://d2vyvo0tyx8ig5.cloudfront.net/lead-gen/classical-piano/corner.png" alt="corner-decoration">
        </div>
    </section>
    <section class="text-center text-white relative pt-60 pb-8 md:py-20 lg:py-24 px-4 teacher-section lazyload" data-bg="https://www.musora.com/musora-cdn/image/width=1600,quality=85/https://d2vyvo0tyx8ig5.cloudfront.net/lead-gen/classical-piano/victoria-bg2.jpg">
        <div class="container mx-auto relative z-10">
            <div class="flex flex-wrap items-center justify-end mx-auto max-w-sm md:max-w-5xl md:px-3">
                <div class="w-full md:w-7/12 lg:w-1/2 z-20">
                    <h1 class="font-caslon text-yellow-special">Victoria Theodore</h1>
                    <div class="font-caslon uppercase lg:text-lg lg:leading-none">Is your teacher.</div>
                    <img class="my-3" src="https://d2vyvo0tyx8ig5.cloudfront.net/lead-gen/classical-piano/teacher-graphic.svg" alt="teacher-graphic">
                    <p class="leading-normal text-left max-w-md">Victoria is a classical piano guru with a classical education pedigree that can be traced back to Claude Debussy. She has multiple degrees in classical piano and it has translated into some serious success over her career.
                    <br><br>
                    As a performer, Victoria Theodore has shared the big stage with musical icons like Beyoncé, Stevie Wonder, Prince, Sting, B.B. King, Tony Bennett, and more.
                    <br><br>
                    She’ll be your guide as you take your first steps in playing beautiful classical piano.</p>
                </div>
            </div>
        </div>
        <div class="teacher-gradient z-0 absolute top-0 bottom-0 left-0 right-0"></div>
    </section>

    @include('pianote.lead-gen.partials.enter-email',[
        "content" => '
            <img class="h-10 md:h-20 lg:h-24" src="https://www.musora.com/musora-cdn/image/width=1500,quality=85/https://d2vyvo0tyx8ig5.cloudfront.net/lead-gen/classical-piano/logo.png" alt="classical-piano-logo">
            <div class="mt-2 md:mt-3 mb-4 md:mb-6 lg:text-lg lg:leading-normal">Start playing beautiful classical music on the piano with this beginner-focused course.<br class="hidden md:inline"> <strong>Enter your email below for your free course.</strong></div>
        ',
        "formId" => "Pianote - Engagement - Trigger - Classical Piano - Web Form",
        "formName" => "Classical Piano Quick Start",
    ])

    @include('pianote.lead-gen.partials.video-player',[
        "name" => "trailer",
        "vimeoId" => "660807156"
    ])

@endsection
@section('scripts')
    @parent
    <script>
        $(document).ready(function () {
            $(document).foundation();
        });
    </script>
    <script type="text/javascript" src="{{ asset('/marketing/js/modal.js') }}"></script>
    <script type="text/javascript" src="{{ asset('/marketing/js/modal-autoplay.js') }}"></script>
@endsection
