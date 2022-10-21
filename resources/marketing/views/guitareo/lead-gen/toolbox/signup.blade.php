@extends('guitareo.lead-gen.lead-gen-layout')

@section('meta')
    <title>The Guitarist's Toolbox by Nate Savage</title>
    <meta name="description"
            content="Sign up and you'll get a collection of exclusive guitar courses with Nate Savage covering a wide range of essential topics."/>

    <meta property="og:image" content="https://guitareo.s3.amazonaws.com/toolbox/bottom-background.jpg" style="display: none;">
    <meta property="og:title" content="The Guitarist's Toolbox">
    <meta property="og:description"
            content="Sign up and you'll get a collection of exclusive guitar courses with Nate Savage covering a wide range of essential topics.">
    <meta property="og:url" content="https://www.guitareo.com/toolbox/">
    @parent
@stop

@section('scripts')
    @parent
    <script>
        $(document).ready(function () {
            $(document).foundation();
        });
    </script>
@stop

@section('body')
    <header class="header blue" style="background:#1a1c1d;">
        <div class="container clearfix mx-auto max-w-6xl flex flex-col">
            <picture>
                <source media="(min-width: 1024px)" srcset="https://cdn.musora.com/image/fetch/w_900,q_auto:best/https://guitareo.s3.amazonaws.com/toolbox/logo.svg">
                <source media="(min-width: 768px)" srcset="https://cdn.musora.com/image/fetch/w_550,q_auto:best/https://guitareo.s3.amazonaws.com/toolbox/logo.svg">
                <img class="logo" src="https://cdn.musora.com/image/fetch/w_350,q_auto:best/https://guitareo.s3.amazonaws.com/toolbox/logo.svg" alt="logo">
            </picture>
            <div class="flex flex-col sm:flex-row">
                <div class="text-center sm:w-5/12 preview-circle">
                    <picture>
                        <source media="(min-width: 1024px)" srcset="https://cdn.musora.com/image/fetch/w_500,q_auto:best/https://guitareo.s3.amazonaws.com/toolbox/nate-savage.jpg">
                        <source media="(min-width: 768px)" srcset="https://cdn.musora.com/image/fetch/w_300,q_auto:best/https://guitareo.s3.amazonaws.com/toolbox/nate-savage.jpg">
                        <img class="circle-nate" src="https://cdn.musora.com/image/fetch/w_270,q_auto:best/https://guitareo.s3.amazonaws.com/toolbox/nate-savage.jpg" alt="nate-savage">
                    </picture>
                </div>
                <div class="px-2 sm:px-8 sm:w-7/12">
                    <h2>Enter your email below to get my <br> free collection of guitar courses!</h2>
                    @include("guitareo.lead-gen.partials._sign-up-form-tw", [
                    "stacked" => true,
                        "formId" => "Guitareo - Engagement - Trigger - Toolbox - Web Form",
                        "formName" => 'The Guitarists Toolbox',
                        "submitButtonColor" => "#408beb",
                ])
                </div>
            </div>
        </div>
    </header>

    @include('guitareo.lead-gen.partials._lesson5',[
        'headLine' => "<h1>The Guitarist's Toolbox Lessons</h1>",
        'lessons' => [
            [
                'locked' => true,
                'title' => 'Playing Your First Song',
                'imgUrl' => 'https://guitareo.s3.amazonaws.com/starter-kit/thumbnails/playing-your-first-song.png',
            ],
            [
                'locked' => true,
                'title' => 'How To Tune A Guitar',
                'imgUrl' => 'https://guitareo.s3.amazonaws.com/starter-kit/thumbnails/how-to-tune-a-guitar.png',
            ],
            [
                'locked' => true,
                'title' => 'Making Chords Sound Clean',
                'imgUrl' => 'https://guitareo.s3.amazonaws.com/starter-kit/thumbnails/making-chords-sound-clean.png',
            ],
            [
                'locked' => true,
                'title' => 'Changing Chords Smoothly',
                'imgUrl' => 'https://guitareo.s3.amazonaws.com/starter-kit/thumbnails/changing-chords-smoothly.png',
            ],
            [
                'locked' => true,
                'title' => 'Sight Reading Essentials',
                'imgUrl' => 'https://guitareo.s3.amazonaws.com/starter-kit/thumbnails/sight-reading-essentials.png',
            ],
            [
                'locked' => true,
                'title' => 'Exploring Guitar Rhythms',
                'imgUrl' => 'https://guitareo.s3.amazonaws.com/starter-kit/thumbnails/exploring-guitar-rhythms.png',
            ],
            [
                'locked' => true,
                'title' => 'Playing Your First Guitar Solo',
                'imgUrl' => 'https://guitareo.s3.amazonaws.com/starter-kit/thumbnails/playing-your-first-guitar-solo.png',
            ],
            [
                'locked' => true,
                'title' => 'Legato Hammer Ons & Pull Offs',
                'imgUrl' => 'https://guitareo.s3.amazonaws.com/starter-kit/thumbnails/legato-hammer-ons-pull-offs.png',
            ],
            [
                'locked' => true,
                'title' => 'Soloing With Minor Pentatonic Scales',
                'imgUrl' => 'https://guitareo.s3.amazonaws.com/starter-kit/thumbnails/soloing-with-minor-pentatonic-scales.png',
            ],
        ],
    ])

    @include('guitareo.lead-gen.partials._lesson6',[
        'themeColor' => '#408beb',
        'headLine' => 'MASSIVELY EXPAND YOUR SKILLS!',
        'subHeadLine' => "Sign up on this page and you'll get 9 exclusive guitar courses with<br class='hidden sm:inline'> Nate Savage that are normally reserved for Guitareo members.",
        'lessons' => [
            [
                'icon' => '<i class="fas fa-infinity"></i>',
                'title' => 'UNLIMITED LIFETIME ACCESS',
                'desc' => 'By signing up, you’ll get access to<br class="hidden lg:inline"> all the videos and resources for life.'
            ],
            [
                'icon' => '<i class="fas fa-video"></i>',
                'title' => '9 Video Lessons',
                'desc' => 'Learn the most important guitar<br class="hidden lg:inline"> skills, techniques, and concepts.'
            ],
            [
                'icon' => '<i class="fas fa-desktop-alt"></i>',
                'title' => 'Instant Online Access',
                'desc' => "You’ll get full access to hours of instruction <br class='hidden lg:inline'> within minutes of signing up."
            ],

        ]
    ])

    @include('guitareo.lead-gen.partials._quick-questions')

    <section class="final blue"
            style="background-image:url(https://guitareo.s3.amazonaws.com/toolbox/bottom-background.jpg);">
        <div class="container clearfix mx-auto max-w-6xl">
            <div class="logo">
                <picture>
                    <source media="(min-width: 1024px)" srcset="https://cdn.musora.com/image/fetch/w_900,q_auto:best/https://guitareo.s3.amazonaws.com/toolbox/logo.svg">
                    <source media="(min-width: 768px)" srcset="https://cdn.musora.com/image/fetch/w_550,q_auto:best/https://guitareo.s3.amazonaws.com/toolbox/logo.svg">
                    <img src="https://cdn.musora.com/image/fetch/w_350,q_auto:best/https://guitareo.s3.amazonaws.com/toolbox/logo.svg" alt="logo">
                </picture>
            </div>
            <p>
                Enter your email below to get <br class="lg:hidden"> a free beginner guitar course!</p>

            @include("guitareo.lead-gen.partials._sign-up-form-tw", [
                "formId" => "Guitareo - Engagement - Trigger - Toolbox - Web Form",
                "formName" => 'The Guitarists Toolbox',
                "submitButtonColor" => "#408beb",
           ])
        </div>
    </section>

    <div class="reveal large blue" id="getAccess" data-reveal data-reset-on-close="true" style="background:#1a1c1d;">
        <p>Enter your email below to get a free beginner guitar <br
                    class="sm:hidden"> course and start learning music theory.</p>
        @include("guitareo.lead-gen.partials._sign-up-form-tw", [
           "stacked" => true,
            "formId" => "Guitareo - Engagement - Trigger - Toolbox - Web Form",
            "formName" => 'The Guitarists Toolbox',
            "submitButtonColor" => "#408beb",
       ])
    </div>
@stop
