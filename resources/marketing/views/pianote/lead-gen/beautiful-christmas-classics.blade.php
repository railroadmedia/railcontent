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
                        class="h-24 sm:h-28 lg:h-32 mb-1 transition-opacity opacity-0"
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
                    <h3 class="leading-tight mb-2 lg:mb-5">Play your favorite Christmas songs <strong>with guided lessons from real teachers</strong>.</h3>
                    <p class="mb-4">Enter your email below to grab your lessons.</p>
                </div>
                @include("pianote._partials.sign-up-form", [
                    "recaptchaKey" => $recaptchaKey,
                            "formName" => 'Beautiful Christmas Classics',
                            "formId" => "Pianote - Engagement - Trigger - Beautiful Christmas Classics - Web Form",
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

    <section class="py-12 sm:py-20 px-5 text-center">
        <div class="container max-w-4xl mx-auto">
           <h3 class="font-extrabold mb-4">
               4 beautiful Christmas <br class="hidden sm:inline">
               songs everyone will want to hear.</h3>
            <p class="mb-10">
                Your friends and family will love to hear these classics.
                <br><br>
                Each lesson features a step-by-step walkthrough of the entire song complete with <br class="hidden sm:inline">
                downloadable music. It’s like learning the song with the teacher sitting right next to you.
            </p>
            <div class="grid sm:grid-cols-2 gap-6 items-stretch">
                @php
                    $lessons = [
                        [
                            'img' => 'https://d21q7xesnoiieh.cloudfront.net/fit-in/1000x0/filters:quality(95)/marketing/pianote/lead-gen/beautiful-christmas-classics/away.jpg',
                            'title' => 'Away In A Manger',
                            'desc' => 'A beautiful, simple Christmas Carol that everybody knows and loves.',
                            'unlocked' => true,
                        ],
                        [
                            'img' => 'https://d21q7xesnoiieh.cloudfront.net/fit-in/1000x0/filters:quality(95)/marketing/pianote/lead-gen/beautiful-christmas-classics/child.jpg',
                            'title' => 'What Child Is This?',
                            'desc' => 'A traditional Carol dating back to the 19th century. But still as beautiful and popular today.',
                        ],
                        [
                            'img' => 'https://d21q7xesnoiieh.cloudfront.net/fit-in/1000x0/filters:quality(95)/marketing/pianote/lead-gen/beautiful-christmas-classics/jingle.jpg',
                            'title' => 'Jingle Bells',
                            'desc' => 'Bring the part this Christmas and play this favorite for your friends and family.',
                        ],
                        [
                            'img' => 'https://d21q7xesnoiieh.cloudfront.net/fit-in/1000x0/filters:quality(95)/marketing/pianote/lead-gen/beautiful-christmas-classics/auld.jpg',
                            'title' => 'Auld Lang Syne',
                            'desc' => 'Ready to ring in the new year? Now you can.',
                        ],
                    ];
                @endphp
                @foreach($lessons as $key => $lesson)
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
                                <i class="absolute top-1/2 left-1/2 fas fa-play text-white play-button" style="margin: -39px;" @click="sampleLesson = true;"></i>
                            @else
                                <div class="absolute inset-0 flex justify-center items-center">
                                    <i class="fa-solid fa-lock-keyhole text-white text-5xl"></i>
                                </div>
                            @endif
                        </div>
                        <div class="p-5 text-left">
                            <p class="mx-0 mb-1 leading-tight font-black">{{ $lesson['title'] }}</p>
                            <p class="leading-tight">{{ $lesson['desc'] }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
    <section class="text-center relative px-5 py-10 sm:py-14" style="background: #f6f8fc;">
        <div class="container max-w-4xl mx-auto">
            <div class="flex flex-wrap items-start">
                @php
                    $features = [
                        [
                        "icon" => "https://d21q7xesnoiieh.cloudfront.net/fit-in/1000x0/filters:quality(95)/marketing/pianote/lead-gen/beautiful-christmas-classics/full-walkthroughs-icon.svg",
                        "headLine" => "Full Walkthroughs",
                        "desc" => 'Learn to play the song step-by-step<br class="inline md:hidden lg:inline"> with guidance and help.',
                        ],
                        [
                        "icon" => "https://d21q7xesnoiieh.cloudfront.net/fit-in/1000x0/filters:quality(95)/marketing/pianote/lead-gen/beautiful-christmas-classics/downloadable-music-icon.svg",
                        "headLine" => "Downloadable Music",
                        "desc" => 'Save it, print it, play it. The<br class="inline md:hidden lg:inline">  music is yours forever.',
                        ],
                        [
                        "icon" => "https://d21q7xesnoiieh.cloudfront.net/fit-in/1000x0/filters:quality(95)/marketing/pianote/lead-gen/beautiful-christmas-classics/help-icon.svg",
                        "headLine" => "Help When You Need It",
                        "desc" => 'Got questions? You’ll be able to<br class="inline md:hidden lg:inline"> ask REAL teachers for help.',
                        ],
                    ];
                @endphp
                @foreach ($features as $feature)
                    <div class="w-full md:w-1/3 px-3 mb-8 md:mb-0">
                        <img class="h-7 sm:h-8" src="{{ $feature['icon'] }}" alt="help-icon">
                        <h6 class="my-3 leading-tight"><strong>{{ $feature['headLine'] }}</strong></h6>
                        <p>{!! $feature['desc'] !!}</p>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <section class="relative text-center px-3 sm:px-6 py-10 sm:py-16 lg:py-24 bg-cover bg-center" style="background-image:url('https://d21q7xesnoiieh.cloudfront.net/fit-in/1500x0/filters:quality(95)/marketing/pianote/lead-gen/beautiful-christmas-classics/coaches-bg.jpg');">
        <div class="container max-w-4xl mx-auto relative z-20">
            <div class="flex flex-wrap sm:flex-nowrap items-start justify-center mt-14">
                <div class="w-full sm:w-1/2 px-4 mb-20 sm:mb-0">
                    <div class="relative text-left z-10 rounded-xl py-8 sm:py-12 px-6 sm:px-10 w-full shadow-md" style="background-color:#fff;">
                        <img class="absolute top-0 left-1/2 transform -translate-x-1/2 -translate-y-1/2 w-32 lg:w-36 z-20 rounded-full border-4 border-white shadow-md transition-all opacity-0" alt="profile picture" loading="lazy" onload="this.classList.remove('opacity-0')"
                                src="https://d21q7xesnoiieh.cloudfront.net/fit-in/550x0/filters:quality(95)/marketing/pianote/lead-gen/beautiful-christmas-classics/lisa-profile.jpg">
                        <p class="leading-tight text-pianote mt-8">MEET YOUR TEACHER</p>
                        <h3 class="leading-tight mt-1 mb-2"><strong>Lisa Witt</strong></h3>
                        <p class="leading-normal">
                            Lisa is the lead instructor at Pianote and will show you how to play beautiful Christmas carols on the piano.
                            <br><br>
                            With over 20 years of experience teaching the piano, Lisa has helped thousands of students learn to play the songs they love.
                            <br><br>
                            Lisa’s contagious enthusiasm will have you excited to practice and return to the keys again and again.
                        </p>
                    </div>
                </div>
                <div class="w-full sm:w-1/2 px-4">
                    <div class="relative text-left z-10 rounded-xl py-8 sm:py-12 px-6 sm:px-10 w-full shadow-md" style="background-color:#fff;">
                        <img class="absolute top-0 left-1/2 transform -translate-x-1/2 -translate-y-1/2 w-32 lg:w-36 z-20 rounded-full border-4 border-white shadow-md transition-all opacity-0" alt="profile picture" loading="lazy" onload="this.classList.remove('opacity-0')"
                                src="https://d21q7xesnoiieh.cloudfront.net/fit-in/550x0/filters:quality(95)/marketing/pianote/lead-gen/beautiful-christmas-classics/kevin-profile.jpg">
                        <p class="leading-tight text-pianote mt-8">MEET YOUR TEACHER</p>
                        <h3 class="leading-tight mt-1 mb-2"><strong>Kevin Castro</strong></h3>
                        <p class="leading-normal">
                            Kevin is a professional touring pianist and teacher.
                            <br><br>
                            He’s worked with rising stars (JESSIA, Elijah Woods), played at TikTok Headquarters in New York and LA, and even recorded a demo for Jennifer Lopez.
                            <br><br>
                            His passion is helping people discover the joy of playing piano, and he’ll teach you two beautiful Christmas songs -- for free!
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    @include('pianote.lead-gen.partials.quick-questions', [
        'textColor' => 'black',
        'bgColor' => 'white'
    ])

    <section class="px-5 py-14 sm:py-20 text-center text-white bg-cover bg-center" style="background-image: url('https://d21q7xesnoiieh.cloudfront.net/fit-in/1500x0/filters:quality(95)/marketing/pianote/lead-gen/beautiful-christmas-classics/offer-bg.jpg');">
        <div class="max-w-3xl mx-auto">
        <img class="h-24 sm:h-32 lg:h-36" src="https://d21q7xesnoiieh.cloudfront.net/fit-in/400x0/filters:quality(95)/marketing/pianote/lead-gen/beautiful-christmas-classics/BPCC-logo.png" alt="FWTGF logo" />
            <h3 class="leading-tight">Play your favorite Christmas songs<br class="hidden sm:inline"> <strong>with guided lessons from real teachers</strong>.</h3>
            <h5 class="my-5 sm:my-7">Enter your email below to grab your lessons.</h5>
            @include("pianote._partials.sign-up-form", [
                            "formName" => 'Beautiful Christmas Classics',
                            "formId" => "Pianote - Engagement - Trigger - Beautiful Christmas Classics - Web Form2",
                "recaptchaKey" => $recaptchaKey,
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
