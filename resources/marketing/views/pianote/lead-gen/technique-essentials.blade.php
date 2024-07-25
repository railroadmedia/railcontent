@extends('pianote.lead-gen.lead-gen-layout-tw', [
    'appTailwind' => true
])

@section('meta')
    @parent
    <title>Piano Technique Essentials with Jordan Rudess | Pianote</title>
    <meta property="og:title" content="Piano Technique Essentials with Jordan Rudess">

    <meta name="description" content="Three essential exercises to improve your piano technique.">
    <meta property="og:description" content="Three essential exercises to improve your piano technique.">
    <meta property="og:image" content="https://d21q7xesnoiieh.cloudfront.net/fit-in/1200x0/filters:quality(95)/marketing/pianote/lead-gen/technique-essentials/share-image.jpg" style="display: none;">
    <meta property="og:url" content="https://www.pianote.com/technique-essentials">
@endsection

@section('head')
    @parent
    <link href="{{ asset('/marketing/parcel/drumeo/lead-gen-learn-songs.css') }}" rel="stylesheet">
    <style>
        header .disclaimer {
            display: none;
            margin: 0 auto;
            opacity: 0.9;
            max-width: 500px;
        }
        .ajax-form input,
        .ajax-form button {
            height: 50px;
        }
        .ajax-form input {
           font-size: 18px;
        }
    </style>
@endsection

@section('body-data')
    x-data="{
    aliciaKeys: false,
    }"
@endsection

@section('page-body')
    <header class="px-5 sm:px-6 py-10 sm:py-14 lg:py-20 text-white" style="background:#000000;">
        <div class="container max-w-4xl mx-auto">
            <div class="flex flex-wrap sm:flex-nowrap items-center">
                <div class="w-full sm:w-7/12 text-center lg:text-left pr-0 sm:pr-6 md:pr-10">
                    <img class="h-20 lg:h-32 mb-4 sm:mb-2 lg:mb-3 md:pl-4" src="https://d21q7xesnoiieh.cloudfront.net/fit-in/1200x0/filters:quality(95)/marketing/pianote/lead-gen/technique-essentials/logo.webp" alt="logo" fetchpriority="high">

                    <div class="mb-5 rounded-xl overflow-hidden relative block sm:hidden bg-cover bg-top cursor-pointer autoplay-video" style="padding-bottom: 75%;">
                        <img class="absolute inset-0" src="https://d21q7xesnoiieh.cloudfront.net/fit-in/1200x0/filters:quality(95)/marketing/pianote/lead-gen/technique-essentials/header.webp" alt="Jordan Rudess" fetchpriority="high" />
                    </div>
                    <div class="md:pt-4 md:pl-4">
                        <p class="hidden lg:inline">
                        <i class="fas fa-check text-pianote"></i> Build stronger fingers <br>
                        <i class="fas fa-check text-pianote"></i> Improve your coordination<br>
                        <i class="fas fa-check text-pianote"></i> Play piano faster</p>
                    </div>


                    <div class="flex inline lg:hidden">
                        <p class="w-1/3 leading-tight"> <i class="fas fa-check text-pianote"></i><br> Build <br> stronger fingers</p>
                        <p class="w-1/3 leading-tight"> <i class="fas fa-check text-pianote"></i><br> Improve <br> your coordination</p>
                        <p class="w-1/3 leading-tight"> <i class="fas fa-check text-pianote"></i><br> Play <br> piano faster</p>
                    </div>

                    <div class="mt-6 sm:mt-5 lg:mt-10">
                        @include('pianote._partials.sign-up-form', [
                    "recaptchaKey" => $recaptchaKey,
                        "formId" => "Pianote - Engagement - Trigger - Essentials - Web Form",
                        "formName" => 'Essentials',
                        "nameInput" => true,
                            "buttonText" => "GET STARTED FOR FREE",
                            'stacked' => true,
                            'inputBorder' => '1px solid #747474',
                            'disclaimerColor' => 'rgba(208, 226, 231, 0.8)',
                    "redirectURL" => "/thank-you"
                        ])
                    </div>
                </div>
                <div class="w-full sm:w-6/12 hidden sm:block">
                    <div class="relative bg-contain bg-top cursor-pointer autoplay-video" style="padding-bottom: 102%;" data-open="trailer">
                        <img class="absolute inset-0" src="https://d21q7xesnoiieh.cloudfront.net/fit-in/1600x0/filters:quality(95)/marketing/pianote/lead-gen/technique-essentials/header.webp" alt="Jordan Rudess" fetchpriority="high" />
                    </div>
                </div>
            </div>
        </div>
    </header>

        <section class="py-12 sm:py-14 lg:py-20 px-4 text-center">
        <div class="container max-w-5xl mx-auto">
            <h2 class="font-extrabold mb-4">3 essential exercises to improve <br>  your piano technique</h2>
            <p class="mb-10">
               These are the exercises Jordan Rudess used to build his world-class piano technique. <br class="hidden sm:inline">
                He learned them from the best teachers at Juilliard, and now he’s sharing them with you!
            </p>
            <div class="flex flex-wrap justify-center mx-auto md:max-w-full text-left">
                @php
                    $lessons = [
                        [
                        "thumb" => "https://d21q7xesnoiieh.cloudfront.net/fit-in/1000x0/filters:quality(95)/marketing/pianote/lead-gen/technique-essentials/thumbs-01.webp",
                        "header" => "Finger Independence",
                        "desc" => "When your fingers have a “mini-mind” of their own, you can play anything you want on the piano. This is a crucial technique to develop as a pianist. Jordan will show you his best exercise to get started.",
                        ],
                        [
                        "thumb" => "https://d21q7xesnoiieh.cloudfront.net/fit-in/1000x0/filters:quality(95)/marketing/pianote/lead-gen/technique-essentials/thumbs-02.webp",
                        "header" => "Hand Coordination",
                        "desc" => "This will be a finger and brain exercise. You’ll learn how to separate your left and right hands so they can be truly independent. This is one of the biggest struggles piano players face. You’ll overcome it.",
                        ],
                        [
                        "thumb" => "https://d21q7xesnoiieh.cloudfront.net/fit-in/1000x0/filters:quality(95)/marketing/pianote/lead-gen/technique-essentials/thumbs-03.webp",
                        "header" => "Speed",
                        "desc" => "Jordan knows a thing or two about playing fast. And he wasn’t born with that ability. It’s something he learned from the best at Juilliard. Now he’s sharing their secrets of speed with you.",
                        ]
                    ];
                @endphp
                @foreach($lessons as $key => $lesson)
                    <div class="w-full sm:w-1/2 lg:w-1/3 px-2 sm:px-3 mb-6 sm:mb-8">
                        <img src="{{ $lesson['thumb'] }}" alt="video thumbnail" loading="lazy"
                            @if(!empty($lesson['trailer']))
                                class="w-full rounded-lg cursor-pointer hover:opacity-90 transition-opacity autoplay-video" x-on:click="trailer = true;"
                            @else
                                class="w-full rounded-lg"
                            @endif
                        >
                        <h5 class="mt-3"><strong>{{ $lesson['header'] }}</strong></h3>
                        <p class="mt-1">{!! $lesson['desc'] !!}</p>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <section class="text-center text-white pt-6 sm:pt-10 lg:pt-20 bg-cover bg-center" style="background-image:url('https://d21q7xesnoiieh.cloudfront.net/fit-in/1600x0/filters:quality(95)/marketing/pianote/lead-gen/technique-essentials/piano-bg.webp');">
        <div class="container mx-auto max-w-3xl">
            <h3 class="leading-tight px-4"><strong>Practice WITH Jordan Rudess</strong></h3>
            <p class="leading-normal mt-2 sm:mt-3 mb-5 sm:mb-7 px-4">
                You don’t get better by watching videos. That’s why each lesson is a “practice-along” lesson where you’ll play WITH Jordan.
                Play alongside him and do what he does as he guides you through the lesson. It’s the best way to stay motivated and see results. <br><br>
                And hey, you can say you’ve played with Dream Theater’s Jordan Rudess!

            </p>
        </div>

        <div class="relative">
            <img class="inline-block sm:hidden w-full transition-all opacity-0" src="https://d21q7xesnoiieh.cloudfront.net/fit-in/850x0/filters:quality(95)/marketing/pianote/lead-gen/technique-essentials/piano-m.webp" alt="tablet piano" loading="lazy" onload="this.classList.remove('opacity-0')">
            <img class="hidden sm:inline-block w-full transition-all opacity-0" src="https://d21q7xesnoiieh.cloudfront.net/fit-in/2800x0/filters:quality(95)/marketing/pianote/lead-gen/technique-essentials/piano.webp" alt="tablet piano" loading="lazy" onload="this.classList.remove('opacity-0')">
            <div class="cursor-pointer autoplay-video absolute top-0 left-1/2 w-[85%] sm:w-[44%] pb-[63%] sm:pb-[33%] transform -translate-x-1/2 sm:ml-1 lg:ml-2 mt-3 xl:mt-4">
                <video
                    src="https://musora-image-processing-cdn.s3.us-east-2.amazonaws.com/marketing/pianote/lead-gen/technique-essentials/demo2.mp4"
                    muted="" autoplay="" loop="" playsinline="" class="inset-0 absolute w-full h-full z-10 rounded-xl object-cover"></video>
            </div>
        </div>
        <div class="flex flex-col items-center justify-center py-3"
        style="background: #000000">
        <h5 class="uppercase text-white leading-wide pt-2">Learn from</h5>
        <h2 class="leading-tight uppercase text-center text-pianote">
            <strong>
                “The greatest <br class="inline md:hidden"> keyboardist of all time”
            </strong>
        </h2>
        <p class="italic text-xs pt-4 text-white">
            ~ MusicRadar Magazine
        </p>
    </div>

    </section>

<section class="bg-cover bg-center w-full" style="background-repeat: no-repeat; background-color: #EAE4DD; background-image:url('https://d21q7xesnoiieh.cloudfront.net/fit-in/3000x0/filters:quality(95)/marketing/pianote/lead-gen/technique-essentials/coach-bg.webp');">
    <div class="container mx-auto max-w-5xl flex flex-col justify-center items-center text-center px-4">
        <div class="max-w-xl mt-20">
            <h2 class="text-3xl md:text-5xl mb-4 font-bebas sm:tracking-widest pt-60">JORDAN RUDESS</h2>
            <p class="mb-4">Jordan Rudess is best known as the extraordinary keyboardist for the platinum-selling, GRAMMY Award-winning progressive rock band, Dream Theater.</p>
            <p class="mb-4">As a classical child prodigy, Jordan was admitted to the prestigious Juilliard School of Music when he was just 9 years old.</p>
            <p class="mb-4">His piano playing is renowned for its virtuosity, speed, and of course… <strong>technique.</strong></p>
            <p class="mb-4"><strong>He’s sharing those secrets with you.</strong></p>
            <p class="mb-4">Jordan honed his piano technique under the supervision of some of the greatest piano teachers at Juilliard. And now…</p>
            <p><strong>He’s sharing those secrets with you.</strong></p>

        </div>
    </div>
    <div class="container mx-auto max-w-2xl py-4 px-4 md:px-6 pb-10">
        <h6 class="uppercase text-gray-400 text-center mb-3 mt-3">See Jordan in action</h6>
        <div class="aspect-16:9 cursor-pointer rounded-xl autoplay-video overflow-hidden w-full relative" x-on:click="aliciaKeys = true;" role="button">
            <img class="absolute inset-0 rounded-xl overflow-hidden object-cover w-full h-full opacity-0 transition-opacity" loading="lazy" onload="this.classList.remove('opacity-0')" src="https://d21q7xesnoiieh.cloudfront.net/fit-in/1200x0/filters:quality(95)/marketing/pianote/lead-gen/technique-essentials/thumb.webp" alt="Thumbnail for video"/>
        </div>
    </div>
</section>



    <div id="final" class="anchor"></div>
    <section class="text-center customize px-4 lg:px-6 relative z-50 overflow-hidden py-10 sm:py-20" style="background:#000000">
        <div class="max-w-5xl mx-auto flex flex-wrap flex-col md:flex-row md:items-center">
            <div class="max-w-lg mx-auto text-center md:text-left w-full md:w-1/2 sm:pl-5">
                <img class="h-20 lg:h-32 mb-4 sm:mb-2 lg:mb-3 md:pl-4 opacity-0 transition-opacity" loading="lazy" onload="this.classList.remove('opacity-0')"
                src="https://d21q7xesnoiieh.cloudfront.net/fit-in/800x0/filters:quality(95)/marketing/pianote/lead-gen/technique-essentials/logo.webp" alt="logo">
                    <div class="md:pt-4 md:pl-4">
                        <p class="hidden md:inline text-white">
                        <i class="fas fa-check text-pianote"></i> Build stronger fingers <br>
                        <i class="fas fa-check text-pianote"></i> Improve your coordination<br>
                        <i class="fas fa-check text-pianote"></i> Play piano faster</p>
                    </div>


                    <div class="flex inline md:hidden text-white">
                        <p class="w-1/3 leading-tight"> <i class="fas fa-check text-pianote"></i><br> Build <br> stronger fingers</p>
                        <p class="w-1/3 leading-tight"> <i class="fas fa-check text-pianote"></i><br> Improve <br> your coordination</p>
                        <p class="w-1/3 leading-tight"> <i class="fas fa-check text-pianote"></i><br> Play <br> piano faster</p>
                    </div>
                <div class="max-w-md md:max-w-auto mx-auto md:mx-0 mt-6 sm:mt-5 lg:mt-10">
                    @include('pianote._partials.sign-up-form', [
                    "recaptchaKey" => $recaptchaKey,
                        "formId" => "Pianote - Engagement - Trigger - Essentials - Web Form2",
                        "formName" => 'Essentials',
                        "nameInput" => true,
                            "buttonText" => "GET STARTED FOR FREE",
                            'stacked' => true,
                            'inputBorder' => '1px solid #7A8491',
                            'disclaimerColor' => 'rgba(208, 226, 231, 0.8)',
                    "redirectURL" => "/thank-you"
                        ])
                </div>
            </div>
            <div class="flex justify-center md:justify-start w-full md:w-1/2 sm:order-1 md:pl-6 mt-7 md:mt-0 relative">
                <img class="max-w-2xl md:max-w-4xl lg:max-w-6xl opacity-0 transition-opacity" loading="lazy" onload="this.classList.remove('opacity-0')"
                src="https://d21q7xesnoiieh.cloudfront.net/fit-in/1800x0/filters:quality(95)/marketing/pianote/lead-gen/technique-essentials/bottom-collage.webp" alt="collage">
            </div>
        </div>
    </section>
    @include('drumeo.sales.partials._video-modal',[
        'modalId' => "demoVid",
        "video" => '//player.vimeo.com/video/830711083?h=701c01c83f&autoplay=1',
        "title" => 'demoVid'
    ])
     @include('_partials.components.video-modal', [
        'name' => 'aliciaKeys',
        'video' => 'aFdOW1Ql3L4',
        'youtubeEmbed' => true,
    ])
@stop

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
