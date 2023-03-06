@extends('guitareo.lead-gen.lead-gen-layout')

@section('meta')
    <title>The Beginner Guitar Starter Kit by Nate Savage</title>
    <meta name="description" content="Sign up and you'll get an exclusive beginner guitar course with Nate Savage designed specifically for new guitarists."/>

    <meta property="og:image" content="https://guitareo.s3.amazonaws.com/music-theory/final-bg.jpg" style="display: none;">
    <meta property="og:title" content="The Beginner Guitar Starter Kit">
    <meta property="og:description" content="Sign up and you'll get an exclusive beginner guitar course with Nate Savage designed specifically for new guitarists.">
    <meta property="og:url" content="https://www.guitareo.com/starter-kit/">
    @parent
@stop

@section('scripts')
    @parent
    <script>
        $(document).ready(function () {
            $(document).foundation();

            var showModal = location.search.substr(1).includes('thankyou');

            if (showModal) {
                $('#thankYouModal').foundation('open');
            }
        });
    </script>
@stop

@section('body')
    <header class="header" style="background: url(https://guitareo.s3.amazonaws.com/starter-kit/bg-tile.jpg);">
        <div class="container clearfix mx-auto max-w-6xl flex flex-col">
            <div class="flex flex-col-reverse sm:flex-row">
                <div class="sm:w-3/4">
                    <picture>
                        <source media="(min-width: 1024px)" srcset="https://www.musora.com/musora-cdn/image/width=900,quality=85/https://guitareo.s3.amazonaws.com/starter-kit/logo-green.png">
                        <source media="(min-width: 768px)" srcset="https://www.musora.com/musora-cdn/image/width=550,quality=85/https://guitareo.s3.amazonaws.com/starter-kit/logo-green.png">
                        <img class="logo" src="https://www.musora.com/musora-cdn/image/width=350,quality=85/https://guitareo.s3.amazonaws.com/starter-kit/logo-green.png" alt="logo">
                    </picture>
                </div>
                <div class="text-center sm:w-1/4">
                    <img class="circle-nate" src="https://www.musora.com/musora-cdn/image/width=450,quality=85/https://guitareo.s3.amazonaws.com/gl-sales/nate-circle.png" alt="nate-circle">
                </div>
            </div>
            <div>
                <h2>Enter your email below to get <br class="sm:hidden"> a free beginner guitar course!</h2>

                @include("guitareo.lead-gen.partials._sign-up-form-tw", [
                    "formId" => "Guitareo - Engagement - Trigger - Starter Kit - Web Form",
                    "formName" => 'The Beginner Guitar Starter',
                ])
            </div>
        </div>
    </header>

    @include('guitareo.lead-gen.partials._lesson5',[
        'headLine' => '<h1 class="text-center">Beginner Guitar Lessons</h1>',
        'desc' => '<p class="text-center">
                    Getting started on the guitar shouldn’t be guesswork. With this free series of beginner courses, you’ll get <br class="hidden lg:inline">
                    everything you need to start playing, tune your guitar correctly, play open chords, start strumming, play your first  <br class="hidden lg:inline">
                    song, and have a clear plan for what’s next. Just sign up on this page to get started! (Did we mention it’s FREE?!)<br><br>
                   </p>',
        'lessons' => [
            [
                'locked' => true,
                'badgeText' => 'course #1',
                'details' => 'Beginner / 7 Videos / 21 Minutes',
                'imgUrl' => 'https://guitareo.s3.amazonaws.com/starter-kit/thumbnails/fundamentals.jpg',
                'title' => 'Guitar Fundamentals',
            ],
            [
                'locked' => true,
                'badgeText' => 'course #2',
                'details' => 'Beginner / 1 Video / 8 Minutes',
                'imgUrl' => 'https://guitareo.s3.amazonaws.com/starter-kit/thumbnails/tuner.jpg',
                'title' => 'Using An Electronic Tuner',
            ],
            [
                'locked' => true,
                'badgeText' => 'course #3',
                'details' => 'Beginner / 6 Videos / 38 Minutes',
                'imgUrl' => 'https://guitareo.s3.amazonaws.com/starter-kit/thumbnails/open-chords.jpg',
                'title' => 'Open Chords',
            ],
            [
                'locked' => true,
                'badgeText' => 'course #4',
                'details' => 'Beginner / 7 Videos / 27 Minutes',
                'imgUrl' => 'https://guitareo.s3.amazonaws.com/starter-kit/thumbnails/strumming.jpg',
                'title' => 'Strumming',
            ],
            [
                'locked' => true,
                'badgeText' => 'course #5',
                'details' => 'Beginner / 7 Videos / 18 Minutes',
                'imgUrl' => 'https://guitareo.s3.amazonaws.com/starter-kit/thumbnails/heartbreak.jpg',
                'title' => 'Heartbreak Avenue',
            ],
            [
                'locked' => true,
                'badgeText' => 'course #6',
                'details' => 'Beginner / 1 Videos / 5 Minutes',
                'imgUrl' => 'https://guitareo.s3.amazonaws.com/starter-kit/thumbnails/whats-next.jpg',
                'title' => 'What&apos;s Next?',
            ],
        ]
    ])

    @include('guitareo.lead-gen.partials._lesson6',[
        'themeColor' => '#00c9ac',
        'headLine' => 'GET STARTED ON THE <br class="lg:hidden">GUITAR THE RIGHT WAY!',
        'subHeadLine' => "Sign up on this page and you'll get a guided beginner guitar <br class='hidden sm:inline'>course with Nate Savage designed specifically for new players.",
        'lessons' => [
            [
                'icon' => '<i class="fas fa-infinity"></i>',
                'title' => 'UNLIMITED LIFETIME ACCESS',
                'desc' => 'By signing up, you’ll get access to<br class="hidde lg:inline"> all the videos and resources for life.'
            ],
            [
                'icon' => '<i class="fas fa-video"></i>',
                'title' => '6 Free Courses',
                'desc' => 'The best way to get started on the guitar<br class="hidden lg:inline"> so you can play the music you love.'
            ],
            [
                'icon' => '<i class="fas fa-desktop-alt"></i>',
                'title' => 'Instant Online Access',
                'desc' => "You’ll get full access to all 117 minutes of<br class='hidden lg:inline'> instruction within minutes of signing up."
            ],

        ]
    ])

    @include('guitareo.lead-gen.partials._quick-questions')

    <section class="final">
        <div class="container clearfix lg:mx-auto max-w-6xl">
            <div class="logo">
                <picture>
                    <source media="(min-width: 1024px)" srcset="https://www.musora.com/musora-cdn/image/width=900,quality=85/https://guitareo.s3.amazonaws.com/starter-kit/logo-green.png">
                    <source media="(min-width: 768px)" srcset="https://www.musora.com/musora-cdn/image/width=650,quality=85/https://guitareo.s3.amazonaws.com/starter-kit/logo-green.png">
                    <img src="https://www.musora.com/musora-cdn/image/width=330,quality=85/https://guitareo.s3.amazonaws.com/starter-kit/logo-green.png" alt="logo">
                </picture>
            </div>
            <p>
                Enter your email below to get <br class="lg:hidden">
                a free beginner guitar course!</p>
            @include("guitareo.lead-gen.partials._sign-up-form-tw", [
                "formId" => "Guitareo - Engagement - Trigger - Starter Kit - Web Form",
                "formName" => 'The Beginner Guitar Starter',
            ])
        </div>
    </section>


    <script>
        fbq('track', 'Lead');
    </script>
    <div class="reveal w-full text-center" id="getAccess" data-reveal data-reset-on-close="true">
        <p>Enter your email below to get a free beginner guitar <br class="hidden sm:inline">
            course and start learning music theory.</p>
        @include("guitareo.lead-gen.partials._sign-up-form-tw", [
            "stacked" => true,
            "outline" => true,
            "formId" => "Guitareo - Engagement - Trigger - Starter Kit - Web Form",
            "formName" => 'The Beginner Guitar Starter',
        ])
    </div>

    @if(strpos(url()->full(), 'thankyou'))
        <div class="reveal w-full text-center" id="thankYouModal" data-reveal data-reset-on-close="true">
            <p><strong>Check Your Email<br class="lg:hidden"> In 5 Minutes</strong></p>
            <div class="flex-video widescreen vimeo">
                <iframe class="embed-responsive-item" src="https://player.vimeo.com/video/248522993" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>
            </div>
        </div>
    @endif
@stop
