@extends('guitareo.lead-gen.lead-gen-layout')

@section('meta')
    <title>Acoustic Guitar Jump-Start | Guitareo</title>
    <meta name="description" content="Sign up on this page and you'll get a guided beginner guitar course with Nate Savage designed specifically for acoustic guitarists.">
    <meta property="og:image" content="https://s3.amazonaws.com/guitareo/acoustic-jump-start/6.jpg" style="display: none;">
    <meta property="og:title" content="Acoustic Guitar Jump-Start">
    <meta property="og:description" content="Sign up on this page and you'll get a guided beginner guitar course with Nate Savage designed specifically for acoustic guitarists.">
    <meta property="og:url" content="https://www.guitareo.com/
    acoustic-guitar-jumpstart/">

    <style>
        .final-pitch {
            background-image: url('https://s3.amazonaws.com/guitareo/acoustic-jump-start/final-bg.jpg');
        }
    </style>
    @parent
@stop

@section('scripts')
    @parent
    <script>
        $(document).ready(function () {
            $(document).foundation();

            //modal video swapping
            $('.play-vimeo').on('click', function (ev) {

                $("#vimeo")[0].src += "?autoplay=1";
                ev.preventDefault();
            });
            $('body').on('click', '.reveal-overlay', function (e) {
                if (e.target !== this)
                    return;

                var newSource = $("#vimeo").attr('src').replace("?autoplay=1", "");
                $("#vimeo").attr('src', newSource);
            });
        });
    </script>
@stop

@section('body')
    <header class="header acoustic py-7 md:py-12 lg:py-14" style="background: #161819;">
        <div class="row mx-auto md:max-w-2xl lg:max-w-4xl">
            <img class="mx-auto max-w-xs mb-5 md:max-w-xl md:mb-7 lg:max-w-4xl lg:mb-10" src="https://s3.amazonaws.com/guitareo/acoustic-jump-start/logo-white.png" alt="logo">
            <div class="flex flex-col sm:flex-row">
                <div class="text-center sm:w-5/12 relative">
                    <img class="absolute -top-3 w-24 sm:left-0 lg:w-28" style="left: 19%;" src="https://s3.amazonaws.com/guitareo/acoustic-jump-start/free-preview-text.png" alt="preview-text">
                    <div class="play-vimeo flex justify-center items-center absolute inset-0 cursor-pointer md:text-xl" data-open="getAccess"><i class="fas fa-play border-2 border-solid border-white rounded-full leading-4 p-3 md:p-4" style="background: #FF8C00;"></i></div>
                <img class="circle-nate" src="https://s3.amazonaws.com/guitareo/acoustic-jump-start/nate-savage.jpg" alt="nate-savage">
                </div>
                <div class="sm:w-7/12">
                    <h2>Enter your email below to get my
                        <br> free beginner acoustic guitar course!</h2>
                    @include("guitareo.lead-gen.partials._sign-up-form-tw", [
                        "stacked" => true,
                        "formId" => "Guitareo - Engagement - Trigger - AGJS - Web Form",
                        "formName" => 'Acoustic Guitar Jump Start',
                        "submitButtonColor" => "#ff8c00",
                ])
                </div>
            </div>
        </div>
    </header>

    @include('guitareo.lead-gen.partials._lesson5',[
        'headLine' => '<h1>Lessons</h1>',
        'lessons' => [
            [
                'locked' => true,
                'badgeText' => '<i class="fas fa-video"></i> Lesson #1',
                'badgeBgColor' => '#FF8C00',
                'details' => '4 Minutes',
                'imgUrl' => 'https://s3.amazonaws.com/guitareo/acoustic-jump-start/1.jpg',
                'title' => 'Intro',
            ],
            [
                'locked' => true,
                'badgeText' => '<i class="fas fa-video"></i> Lesson #2',
                'badgeBgColor' => '#FF8C00',
                'details' => '8 Minutes',
                'imgUrl' => 'https://s3.amazonaws.com/guitareo/acoustic-jump-start/2.jpg',
                'title' => 'Tuning',
            ],
            [
                'locked' => true,
                'badgeText' => '<i class="fas fa-video"></i> Lesson #3',
                'badgeBgColor' => '#FF8C00',
                'details' => '6 Minutes',
                'imgUrl' => 'https://s3.amazonaws.com/guitareo/acoustic-jump-start/3.jpg',
                'title' => 'Strumming',
            ],
            [
                'locked' => true,
                'badgeText' => '<i class="fas fa-video"></i> Lesson #4',
                'badgeBgColor' => '#FF8C00',
                'details' => '13 Minutes',
                'imgUrl' => 'https://s3.amazonaws.com/guitareo/acoustic-jump-start/4.jpg',
                'title' => 'Clean Chords',
            ],
            [
                'locked' => true,
                'badgeText' => '<i class="fas fa-video"></i> Lesson #5',
                'badgeBgColor' => '#FF8C00',
                'details' => '9 Minutes',
                'imgUrl' => 'https://s3.amazonaws.com/guitareo/acoustic-jump-start/5.jpg',
                'title' => 'Changing Chords Smoothly',
            ],
            [
                'locked' => true,
                'badgeText' => '<i class="fas fa-video"></i> Lesson #6',
                'badgeBgColor' => '#FF8C00',
                'details' => '9 Minute',
                'imgUrl' => 'https://s3.amazonaws.com/guitareo/acoustic-jump-start/6.jpg',
                'title' => "Learning Songs",
            ],
            [
                'locked' => true,
                'badgeText' => '<i class="fas fa-video"></i> Lesson #7',
                'badgeBgColor' => '#FF8C00',
                'details' => '8 Minute',
                'imgUrl' => 'https://s3.amazonaws.com/guitareo/acoustic-jump-start/7.jpg',
                'title' => "Music Theory",
            ],
            [
                'locked' => true,
                'badgeText' => '<i class="fas fa-video"></i> Lesson #8',
                'badgeBgColor' => '#FF8C00',
                'details' => '3 Minute',
                'imgUrl' => 'https://s3.amazonaws.com/guitareo/acoustic-jump-start/8.jpg',
                'title' => "What To Do Next",
            ],
        ]
    ])

    @include('guitareo.lead-gen.partials._lesson6',[
        'themeColor' => '#FF8C00',
        'headLine' => 'Jump-Start Your Guitar Playing!',
        'subHeadLine' => "Sign up on this page and you'll get a guided beginner guitar course<br class='hidden sm:inline'> with Nate Savage designed specifically for acoustic guitarists.",
        'lessons' => [
            [
                'icon' => '<i class="fas fa-video"></i>',
                'title' => '8 Video Lessons',
                'desc' => 'The best guide to getting started<br class="hidden lg:inline"> on the acoustic guitar.'
            ],
            [
                'icon' => '<i class="fas fa-desktop-alt"></i>',
                'title' => 'Instant Online Access',
                'desc' => "You'll get full access to all 60 minutes of<br class='hidden lg:inline'> instruction within minutes of signing up."
            ],
            [
                'icon' => '<i class="fas fa-infinity"></i>',
                'title' => 'UNLIMITED LIFETIME ACCESS',
                'desc' => 'By signing up, you’ll get access to<br class="hidden lg:inline"> all the videos and resources for life.'
            ],
        ]
    ])

    @include('guitareo.lead-gen.partials._quick-questions')

    @include('guitareo.lead-gen.partials._enter-email',[
        "bgColor" => "#1A1C1D",
        "img" => '<img class="h-14 mb-5 md:mb-7 lg:mb-10 sm:h-20 lg:h-36 mx-auto" src="https://s3.amazonaws.com/guitareo/acoustic-jump-start/logo-white.png" alt="logo">',
        "text" => '<p class="mb-4 px-3 text-sm md:px-4 md:text-xl">Enter your email below to get my<br class="hidden sm:inline lg:hidden"> free beginner acoustic guitar course!</p>',
        "formId" => "Guitareo - Engagement - Trigger - AGJS - Web Form",
        "formName" => 'Acoustic Guitar Jump Start',
        "submitButtonColor" => "#ff8c00",
    ])

    <div class="reveal acoustic text-center max-w-2xl" id="getAccess" data-reveal data-reset-on-close="false">

        <div class="flex-video widescreen vimeo">
            <iframe id="vimeo" src="//player.vimeo.com/video/299263691" frameborder="0" allowfullscreen allow="autoplay"></iframe>
        </div>
        <p>Enter your email below to get my free  <br class="hidden sm:inline lg:hidden">
            beginner acoustic guitar course!</p>
        @include("guitareo.lead-gen.partials._sign-up-form-tw", [
            "formId" => "Guitareo - Engagement - Trigger - AGJS - Web Form",
            "formName" => 'Acoustic Guitar Jump Start',
            "submitButtonColor" => "#ff8c00",
       ])
    </div>
@stop
