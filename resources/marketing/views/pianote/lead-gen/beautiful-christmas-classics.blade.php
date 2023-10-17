@php
    $lessons = [
        [
            'img' => 'https://d21q7xesnoiieh.cloudfront.net/fit-in/720x0/filters:quality(95)/marketing/drumeo/lead-gen/faster/the-tinder.jpg',
            'title' => 'Away In A Manger',
            'desc' => 'A beautiful, simple Christmas Carol that everybody knows and loves.',
            'unlocked' => true,
        ],
        [
            'img' => 'https://d21q7xesnoiieh.cloudfront.net/fit-in/720x0/filters:quality(95)/marketing/drumeo/lead-gen/faster/the-swiss-cheese.jpg',
            'title' => 'What Child Is This?',
            'desc' => 'A traditional Carol dating back to the 19th century. But still as beautiful and popular today.',
        ],
        [
            'img' => 'https://d21q7xesnoiieh.cloudfront.net/fit-in/720x0/filters:quality(95)/marketing/drumeo/lead-gen/faster/double-trouble.jpg',
            'title' => 'Jingle Bells',
            'desc' => 'Bring the part this Christmas and play this favorite for your friends and family.',
        ],
        [
            'img' => 'https://d21q7xesnoiieh.cloudfront.net/fit-in/720x0/filters:quality(95)/marketing/drumeo/lead-gen/faster/clavediddle.jpg',
            'title' => 'Auld Lang Syne',
            'desc' => 'Ready to ring in the new year? Now you can.',
        ],
    ];
@endphp

@extends('pianote.lead-gen.lead-gen-layout-tw')

@section('meta')
    @parent
    <title>Beautiful Christmas Classics | Pianote</title>
    <meta property="og:title" content="Beautiful Christmas Classics">

    <meta name="description" content="Play your favorite Christmas songs with guided lessons from real teachers.">
    <meta property="og:description" content="Play your favorite Christmas songs with guided lessons from real teachers.">
    <meta property="og:image" content="https://d21q7xesnoiieh.cloudfront.net/fit-in/1200x0/filters:quality(95)/marketing/pianote/lead-gen/beautiful-christmas-classics/share-image.jpg" style="display: none;">
    <meta property="og:url" content="https://www.pianote.com/beautiful-christmas-classics">
@endsection

@section('head')
    @parent
    <link href="{{ asset('/marketing/parcel/drumeo/lead-gen-learn-songs.css') }}" rel="stylesheet">
    <style>
        .infusion-form button {
            background:linear-gradient(to bottom, #01c474, #008e54)!important;
        }
        .infusion-form button:hover {
            background:linear-gradient(to bottom, #02de82, #00a862)!important;
        }
        header .disclaimer {
            display: none;
            margin: 0 auto;
            opacity: 0.9;
            max-width: 500px;
        }
    </style>
@endsection

@section('body-data')
    x-data="{
        sampleLesson: false,
    }"
@endsection

@section('page-body')
    <header class="py-10 sm:py-14 bg-cover bg-center" style="background-image: url('https://d21q7xesnoiieh.cloudfront.net/fit-in/1200x0/filters:quality(95)/marketing/pianote/lead-gen/beautiful-christmas-classics/header-bg.jpg');">
        <div class="max-w-5xl mx-auto sm:flex items-center container px-4 text-center sm:text-left">
            <div class="w-full sm:w-7/12 lg:w-1/2 text-white max-w-xl mx-auto sm:max-w-full">
                <div class="px-2 sm:px-3">
                    <img
                        class="h-12 sm:h-14 lg:h-32 mb-1 transition-opacity opacity-0"
                        src="https://d21q7xesnoiieh.cloudfront.net/fit-in/430x0/filters:quality(95)/marketing/pianote/lead-gen/beautiful-christmas-classics/BPCC-logo.png"
                        alt="FWTGF logo"
                        loading="lazy"
                        onload="this.classList.remove('opacity-0')"
                    />
                    <img
                        class="rounded-xl sm:hidden mb-5 transition-opacity opacity-0"
                        src="https://d21q7xesnoiieh.cloudfront.net/fit-in/700x0/filters:quality(95)/marketing/pianote/lead-gen/beautiful-christmas-classics/header-image-m.png"
                        alt="header hero image mobile"
                        loading="lazy"
                        onload="this.classList.remove('opacity-0')"
                    />
                    <h3 class="leading-tight mb-5">Play your favorite Christmas songs <strong>with guided lessons from real teachers</strong>.</h3>
                    <p class="mb-4">Enter your email below to grab your lessons.</p>
                </div>
                @include("pianote._partials.sign-up-form", [
                    "recaptchaKey" => $recaptchaKey,
                    "formId" => "Drumeo - Engagement - Trigger - FWTGF - Web Form",
                    "formName" => "Fastest Way To Get Faster",
                    "buttonText" => "Get started for free",
                    "stacked" => true,
                ])
            </div>
            <div class="w-full sm:w-5/12 lg:w-1/2 sm:pl-5 lg:pl-7 hidden sm:block">
                <img
                    class="transition-opacity opacity-0"
                    src="https://d21q7xesnoiieh.cloudfront.net/fit-in/1000x0/filters:quality(95)/marketing/pianote/lead-gen/beautiful-christmas-classics/header-image.png"
                    alt="header hero image"
                    loading="lazy"
                    onload="this.classList.remove('opacity-0')"
                />
            </div>
        </div>
    </header>

    <section class="py-12 sm:py-20 px-4 text-center">
        <div class="container max-w-5xl mx-auto">
           <h3 class="font-extrabold mb-4">
               4 beautiful Christmas <br class="hidden sm:inline">
               songs everyone will want to hear.</h3>
            <p class="mb-10">
                Your friends and family will love to hear these classics.
                <br><br>
                Each lesson features a step-by-step walkthrough of the entire song complete with <br class="hidden sm:inline">
                downloadable music. It’s like learning the song with the teacher sitting right next to you.
            </p>
            <div class="flex flex-wrap justify-center max-w-xs mx-auto sm:max-w-full">
                @foreach($lessons as $key => $lesson)
                    <div class="w-full sm:w-1/2 px-2 lg:px-3 mb-4 lg:mb-6">
                        <div class="rounded-xl overflow-hidden" style="background: #F6F8FC; box-shadow: 5px 5px 5px rgba(0, 0, 0, 0.1);">
                            <div class="relative">
                                <img
                                    class="transition-opacity opacity-0"
                                    src="{{ $lesson['img'] }}"
                                    alt="lesson thumbnail {{ $key+1 }}"
                                    loading="lazy"
                                    onload="this.classList.remove('opacity-0')"
                                />
                                @if(!empty($lesson['unlocked']))
                                    <i class="absolute top-1/2 left-1/2 fas fa-play play-button" style="margin: -39px;" @click="sampleLesson = true;"></i>
                                @else
                                    <div class="absolute inset-0 flex justify-center items-center">
                                        <i class="fa-solid fa-lock-keyhole text-white text-5xl"></i>
                                    </div>
                                @endif
                            </div>
                            <div class="p-4 text-left">
                                <h6 class="mx-0 mb-2 font-black">{{ $lesson['title'] }}</h6>
                                <p>{{ $lesson['desc'] }}</p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
    <section class="text-center text-white relative py-16 md:py-20 lg:px-4" style="background: #00101d;">
        <div class="container mx-auto">
            <div class="flex flex-wrap items-start max-w-4xl mx-auto">
                @php
                    $features = [
                        [
                        "icon" => "https://d2vyvo0tyx8ig5.cloudfront.net/lead-gen/christmas-carols/help-icon.svg",
                        "headLine" => "FULL WALKTHROUGHS",
                        "desc" => 'Learn to play the song step-by-step<br class="inline md:hidden lg:inline"> with guidance and help.',
                        ],
                        [
                        "icon" => "https://d2vyvo0tyx8ig5.cloudfront.net/lead-gen/christmas-carols/download-icon.svg",
                        "headLine" => "DOWNLOADABLE MUSIC",
                        "desc" => 'Save it, print it, play it. The<br class="inline md:hidden lg:inline">  music is yours forever.',
                        ],
                        [
                        "icon" => "https://d2vyvo0tyx8ig5.cloudfront.net/lead-gen/christmas-carols/q-a-icon.svg",
                        "headLine" => "HELP WHEN YOU NEED IT",
                        "desc" => 'Got questions? You’ll be able to<br class="inline md:hidden lg:inline"> ask REAL teachers for help.',
                        ],
                    ];
                @endphp
                @foreach ($features as $feature)
                    <div class="w-full md:w-1/3 px-3 mb-8 md:mb-0">
                        <img class="h-12 md:12 lazyload" data-src="https://www.musora.com/musora-cdn/image/width=80,quality=95/{{ $feature['icon'] }}" alt="help-icon">
                        <div class="my-3 lg:text-lg lg:leading-none"><strong>{{ $feature['headLine'] }}</strong></div>
                        <p>{!! $feature['desc'] !!}</p>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <section class="py-12 sm:py-20" style="background: linear-gradient(45deg, #2a2a72, #009ffd);">
        <div class="flex flex-wrap sm:flex-nowrap items-start justify-center sm:mt-8 sm:px-4 lg:px-0">
            <img
                class="border-8 border-white rounded-3xl shadow-xl w-52 sm:w-72 lg:w-96 relative -mb-16 sm:mb-0 sm:-mt-8 sm:-mr-8 z-10 transition-opacity opacity-0"
                src="https://dpwjbsxqtam5n.cloudfront.net/lead-gen/fwtgf/coach.jpg"
                alt="profile picture"
                loading="lazy"
                onload="this.classList.remove('opacity-0')"
            >
            <div class="h-10 w-full sm:hidden" style="background: linear-gradient(to left top, #00101d calc(50% - 1px), transparent, transparent calc(50% + 1px));"></div>
            <div class="text-white text-left rounded-none sm:rounded-xl pt-14 pb-8 sm:py-10 lg:py-12 px-6 sm:pr-10 sm:pl-14 lg:px-14 sm:mt-8 w-full sm:w-auto sm:flex-grow lg:max-w-xl" style="background-color:#00101d;">
                <h6 class="uppercase leading-normal" style="color:#fd5470;">MEET YOUR TEACHER</h6>
                <h2><strong>El Estepario Siberiano</strong></h2>
                <h6 class="leading-normal mt-4 lg:mt-6">
                    Estepario Siberiano has pushed the boundaries of drumming.<br><br>

                    He’s inspired millions of people with his dedication, talent, and innovation – playing at speeds (with one AND two hands) that were thought to be impossible. And always applying these skills in a musical context – not just playing fast for the sake of playing fast.<br><br>

                    He’s developed key exercises that have helped him play at these speeds – and now he’s here to teach you!
                </h6>
                <div class="flex justify-between text-center mt-7 lg:mt-10">
                    <div class="">
                        <img class="h-6 sm:h-8 lazyload" data-src="https://www.musora.com/musora-cdn/image/width=100,quality=95/https://dpwjbsxqtam5n.cloudfront.net/drum-shop/30-day-drummer/TikTok_Icon.svg" alt="tiktok icon">
                        <h3 class="mt-2"><strong>3.7M</strong></h3>
                        <p class="uppercase opacity-70 text-sm">Followers</p>
                    </div>
                    <div class="">
                        <img class="h-6 sm:h-8 lazyload" data-src="https://www.musora.com/musora-cdn/image/width=100,quality=95/https://dpwjbsxqtam5n.cloudfront.net/drum-shop/30-day-drummer/Insta_Icon.svg" alt="insta icon">
                        <h3 class="mt-2"><strong>2.8M</strong></h3>
                        <p class="uppercase opacity-70 text-sm">followers</p>
                    </div>
                    <div class="">
                        <img class="h-6 sm:h-8 lazyload" data-src="https://www.musora.com/musora-cdn/image/width=100,quality=95/https://dpwjbsxqtam5n.cloudfront.net/drum-shop/30-day-drummer/Youtube_Icon.svg" alt="youtube icon">
                        <h3 class="mt-2"><strong>577M</strong></h3>
                        <p class="uppercase opacity-70 text-sm">views</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    @include('pianote.lead-gen.partials.quick-questions', [
        'textColor' => 'black',
        'bgColor' => 'white'
    ])

    <section class="py-14 sm:py-28 text-center text-white bg-cover bg-center" style="background: url('https://d21q7xesnoiieh.cloudfront.net/fit-in/1500x0/filters:quality(95)/marketing/drumeo/lead-gen/faster/order-bg.jpg');">
        <div class="max-w-3xl mx-auto">
        <img class="h-16 lg:h-24" src="https://d21q7xesnoiieh.cloudfront.net/fit-in/400x0/filters:quality(95)/marketing/pianote/lead-gen/beautiful-christmas-classics/BPCC-logo.png" alt="FWTGF logo" />
            <h2 class="leading-tight mb-5">Play your favorite Christmas songs <strong>with guided lessons from real teachers</strong>.</h2>
            <h5 class="my-5 sm:my-7">Enter your email below to grab your lessons.</h5>
            @include("pianote._partials.sign-up-form", [
                "recaptchaKey" => $recaptchaKey,
                "formId" => "Drumeo - Engagement - Trigger - FWTGF - Web Form" . '2',
                "formName" => "Fastest Way To Get Faster",
                    "buttonText" => "Get started for free",
            ])
        </div>
    </section>


    @include('_partials.components.video-modal',[
        'name' => 'sampleLesson',
        'video' => '806957290',
        'vimeo' => true,
    ])
@stop
