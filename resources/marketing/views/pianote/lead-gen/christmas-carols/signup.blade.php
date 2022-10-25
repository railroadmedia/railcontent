@extends('pianote.lead-gen.christmas-carols.christmas-carols-layout')
@section('head')
    @parent
    <style>
        .header-bg {
            background-size:800px;
            background-image: url('https://cdn.musora.com/image/fetch/w_900,q_auto:best/https://pianote.s3.amazonaws.com/lead-gen/christmas-carols/header-bg.jpg');
        }
        .teacher-gradient {
            background:linear-gradient(to top, #00101d 40%, transparent 75%);
        }
        .teacher-section {
            background: #00101d 50% top/530px no-repeat;
        }
        .enter-email {
            background-image:url('https://cdn.musora.com/image/fetch/w_900,q_auto:best/https://pianote.s3.amazonaws.com/lead-gen/christmas-carols/email-bg.jpg');
        }
        @media (min-width: 768px) {
            .header-bg {
                background-size:cover;
                background-image: url('https://cdn.musora.com/image/fetch/w_1500,q_auto:best/https://pianote.s3.amazonaws.com/lead-gen/christmas-carols/header-bg.jpg');
            }
            .teacher-gradient {
                background:linear-gradient(to right, #00101d, transparent 80%);
            }
            .teacher-section {
                background-size:700px;
                background-position:400% 50%;
            }
            .enter-email {
                background-image:url('https://cdn.musora.com/image/fetch/w_1200,q_auto:best/https://pianote.s3.amazonaws.com/lead-gen/christmas-carols/email-bg.jpg');
            }
        }
        @media (min-width: 1024px) {
            .header-bg {
                background-image: url('https://cdn.musora.com/image/fetch/w_2500,q_auto:best/https://pianote.s3.amazonaws.com/lead-gen/christmas-carols/header-bg.jpg');
            }
            .teacher-gradient {
                background:linear-gradient(to right, #00101d, transparent 60%);
            }
            .teacher-section {
                background-size:850px;
                background-position:110% 50%;
            }
            .enter-email {
                background-image:url('https://cdn.musora.com/image/fetch/w_1500,q_auto:best/https://pianote.s3.amazonaws.com/lead-gen/christmas-carols/email-bg.jpg');
            }
        }
    </style>
@endsection

@php
    $carols = [
        [
            "img" => "https://pianote.s3.amazonaws.com/lead-gen/christmas-carols/albumcover01.jpg",
            "title" => "Deck the Halls",
        ],
        [
            "img" => "https://pianote.s3.amazonaws.com/lead-gen/christmas-carols/albumcover02.jpg",
            "title" => "Joy To The World",
        ],
        [
            "img" => "https://pianote.s3.amazonaws.com/lead-gen/christmas-carols/albumcover03.jpg",
            "title" => "O Holy Night",
        ],
        [
            "img" => "https://pianote.s3.amazonaws.com/lead-gen/christmas-carols/albumcover04.jpg",
            "title" => "Silent Night",
        ],
        [
            "img" => "https://pianote.s3.amazonaws.com/lead-gen/christmas-carols/albumcover05.jpg",
            "title" => "Jingle Bells",
        ],
    ];

    $features = [
        [
            "icon" => "https://pianote.s3.amazonaws.com/lead-gen/christmas-carols/help-icon.svg",
            "headLine" => "FULL WALKTHROUGHS",
            "desc" => 'Learn to play the song step-by-step<br class="inline md:hidden lg:inline"> with guidance and help.',
        ],
        [
            "icon" => "https://pianote.s3.amazonaws.com/lead-gen/christmas-carols/download-icon.svg",
            "headLine" => "DOWNLOADABLE MUSIC",
            "desc" => 'Save it, print it, play it. The<br class="inline md:hidden lg:inline">  music is yours forever.',
        ],
        [
            "icon" => "https://pianote.s3.amazonaws.com/lead-gen/christmas-carols/q-a-icon.svg",
            "headLine" => "HELP WHEN YOU NEED IT",
            "desc" => 'Got questions? You’ll be able to<br class="inline md:hidden lg:inline"> ask REAL teachers for help.',
        ],
    ];
@endphp

@section('page-body')
    @include('pianote.lead-gen.partials.header1',[
        "lowerImg" => '<img class="h-10 md:h-20 lg:h-24" src="https://cdn.musora.com/image/fetch/w_1500,q_auto:best/https://pianote.s3.amazonaws.com/lead-gen/christmas-carols/logo.png" alt="christmas-carol-logo">',
        "text" => '<div class="mt-2 md:mt-3 mb-4 md:mb-6 lg:text-lg lg:leading-normal">Play these beautiful carols for your loved ones this holiday season.<br class="hidden md:inline"> Enter your email below for your free song tutorials.</div>',
        "playButtonStyles" => 'mt-20 mb-12 md:mt-72 md:mb-16',
        "formId" => "Pianote - Engagement - Trigger - Christmas Carols - Web Form",
        "formName" => "Beginner Piano Christmas Carols",
    ])

    <section class="text-center text-white px-4 py-8 md:p-12 relative" style="background:#0b1618 url(https://cdn.musora.com/image/fetch/w_1500,q_auto:best/https://pianote.s3.amazonaws.com/lead-gen/christmas-carols/songs-bg.png) center center/cover;">
        <div class="px-5 py-6 md:p-10 lg:p-16 rounded-3xl relative z-10" style="background:#692220 url(https://cdn.musora.com/image/fetch/w_350,q_auto:best/https://pianote.s3.amazonaws.com/lead-gen/christmas-carols/songs-bg-tile.jpg) center center/250px;">
            <div class="container mx-auto">
                <img class="h-9 md:h-12 lg:h-14 mb-0.5 md:mb-1.5" src="https://cdn.musora.com/image/fetch/w_800,q_auto:best/https://pianote.s3.amazonaws.com/lead-gen/christmas-carols/xmas-eve.png" alt="xmas-eve">
                <p class="color-pale-yellow">Your loved ones gather around the piano...</p>

                <p class="text-left max-w-2xl mt-2 md:mt-4 mb-6 md:mb-10">
                    As you sit down to play. From the first few notes, smiles stretch across their faces, as they recognize the carol you’re playing. One person starts singing, then another. Before long it’s a chorus of Christmas carols.
                    <br><br>
                    And they’re all singing to you.
                    <br><br>
                    Discover the joy of playing Christmas carols for your friends and family will these free tutorials. You’ll learn some of the most beloved carols plus you’ll get free music to download and keep forever.
                    <br><br>
                    Make this Christmas one to remember.
                </p>

                <div class="flex flex-wrap items-start justify-center mx-auto px-2 max-w-xs md:max-w-lg lg:max-w-5xl" >
                    @foreach ($carols as $carol)
                        <div class="px-1 md:px-3 inline-block w-1/2 md:w-1/3 lg:w-1/5 mb-2 md:mb-4 lg:mb-0">
                            <div class="border-4 rounded-xl w-full md:mb-1 overflow-hidden"><div class="aspect-1:1 bg-cover bg-black bg-center lazyload" data-bg="https://cdn.musora.com/image/fetch/w_350,q_auto:best/{{ $carol['img'] }}"></div></div>
                            <p class="hidden md:inline"><strong>{{ $carol['title'] }}</strong></p>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
        <img class="z-20 absolute top-0 left-0 h-20 md:h-48 lg:h-64" src="https://cdn.musora.com/image/fetch/w_500,q_auto:best/https://pianote.s3.amazonaws.com/lead-gen/christmas-carols/top-leaf.png" alt="top-leaf">
        <img class="z-20 absolute bottom-0 right-0 h-28 md:h-44 lg:h-52" src="https://cdn.musora.com/image/fetch/w_300,q_auto:best/https://pianote.s3.amazonaws.com/lead-gen/christmas-carols/bottom-leaf.png" alt="bottom-leaf">
    </section>
    <section class="text-center text-white relative py-16 md:py-20 lg:px-4" style="background: #00101d;">
        <div class="container mx-auto">
            <div class="flex flex-wrap items-start max-w-4xl mx-auto">
                @foreach ($features as $feature)
                    <div class="w-full md:w-1/3 px-3 mb-8 md:mb-0">
                        <img class="h-12 md:12 lazyload" data-src="https://cdn.musora.com/image/fetch/w_80,q_auto:best/{{ $feature['icon'] }}" alt="help-icon">
                        <div class="my-3 lg:text-lg lg:leading-none"><strong>{{ $feature['headLine'] }}</strong></div>
                        <p>{!! $feature['desc'] !!}</p>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
    <section class="text-center text-white relative pt-60 pb-8 md:py-20 lg:py-24 px-4 teacher-section lazyload" data-bg="https://cdn.musora.com/image/fetch/w_1600,q_auto:best/https://pianote.s3.amazonaws.com/lead-gen/christmas-carols/coach-bg.jpg">
        <div class="container mx-auto relative z-10">
            <div class="flex flex-wrap items-center mx-auto max-w-sm md:max-w-5xl md:px-3">
                <div class="w-full md:w-7/12 lg:w-1/2 z-20">
                    <img class="h-16 md:h-20 lg:h-28 py-1 mb-4 lg:mb-5 lazyload" data-src="https://cdn.musora.com/image/fetch/w_900,q_auto:best/https://pianote.s3.amazonaws.com/lead-gen/christmas-carols/coach-name.png" alt="coach-name">
                    <div class="leading-relaxed text-left max-w-md lg:text-lg lg:leading-relaxed">Lisa is the lead instructor at Pianote and will show you how to play beautiful Christmas carols on the piano. With {{ date('Y') - 2002}} years of experience teaching the piano, Lisa has helped thousands of students learn to play the songs they love. Lisa’s contagious enthusiasm will have you excited to practice and return to the keys again and again.</div>
                </div>
            </div>
        </div>
        <div class="teacher-gradient z-0 absolute top-0 bottom-0 left-0 right-0"></div>
    </section>

    @include('pianote.lead-gen.partials.enter-email',[
        "content" => '
            <img class="h-10 md:h-20 lg:h-24" src="https://cdn.musora.com/image/fetch/w_1500,q_auto:best/https://pianote.s3.amazonaws.com/lead-gen/christmas-carols/logo.png" alt="christmas-carol-logo" >
            <div class="mt-2 md:mt-3 mb-4 md:mb-6 lg:text-lg lg:leading-normal">Play these beautiful carols for your loved ones this holiday season.<br class="hidden md:inline"> Enter your email below for your free song tutorials.</div>
        ',
        "formId" => "Pianote - Engagement - Trigger - Christmas Carols - Web Form",
        "formName" => "Beginner Piano Christmas Carols",
    ])

    @include('pianote.lead-gen.partials.video-player',[
        "name" => "trailer",
        "vimeoId" => "649725858",
    ])

@endsection
@section('scripts')
    @parent
    <script>
        $(document).ready(function () {
            $(document).foundation();
        });
    </script>
    <script type="text/javascript" src="/marketing/js/modal.js"></script>
    <script type="text/javascript" src="/marketing/js/pianote/modal-autoplay-alt.js"></script>
@endsection
