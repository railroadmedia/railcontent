@extends('drumeo.lead-gen.lead-gen-layout-tw')

@section('meta')
    <title>Gavin Harrison - The Grooves Of Porcupine Tree | Drumeo</title>
    <meta name="description" content="Sign up on this page and you’ll get 8 videos with Gavin Harrison that are normally reserved for Drumeo members.">
    <meta property="og:image" content="https://dpwjbsxqtam5n.cloudfront.net/lead-gen/gavins-grooves/og-image.jpg" style="display: none;">
    <meta property="og:title" content="Gavin Harrison - The Grooves Of Porcupine Tree">
    <meta property="og:description" content="Sign up on this page and you’ll get 8 videos with Gavin Harrison that are normally reserved for Drumeo members.">
    <meta property="og:url" content="https://www.drumeo.com/gavins-grooves/">
@stop

@section('styles')
    <link href="{{ asset('/marketing/parcel/drumeo/lead-gen-course.css') }}" rel="stylesheet">
@stop

@section('scripts')
    <script>
        $(document).ready(function () {
            var showModal = location.search.substr(1).includes('thankyou');

            if (showModal) {
                $('#thankYouModal').foundation('open');
            }
        });
    </script>
@stop

@section('content')
    <header class="header">
        <div class="container px-4 mx-auto max-w-6xl" style="background-image:url(https://dpwjbsxqtam5n.cloudfront.net/lead-gen/gavins-grooves/gavin-bg.jpg);">
            <br><br><br>
            <img class="autoplay-video" src="https://dpwjbsxqtam5n.cloudfront.net/sales/play-button.png" data-open="previewModal">
                <div class="course-logo">
                    <h2>Gavin Harrison</h2>
                    <h3>The Grooves Of Porcupine Tree</h3>
                </div>
                <p>
                    Click the button below for free <br class="inline sm:hidden">
                    lifetime access to this online course.
                </p>
            @include("drumeo.lead-gen.partials.sign-up-form-rc", [
                    "recaptchaKey" => $recaptchaKey,
                "formId" => "Drumeo - Engagement - Trigger - Gavins Grooves - Web Form",
                "formName" => 'Gavins Grooves',
                "buttonText" => 'Send The Videos&nbsp;'
            ])
        </div>
        <div class="reveal large" id="previewModal" data-reveal data-reset-on-close="false">
            <div class="aspect-16:9 w-full relative">
                <iframe class="absolute w-full h-full reset-on-close" src="" data-lazy-load-url="//player.vimeo.com/video/254549227?autoplay=1" frameborder="0" allowfullscreen allow="autoplay" title="10year-video"></iframe>
            </div>
        </div>
    </header>

    @include('drumeo.lead-gen.courses.full.partials.instructor',[
        "img" => "https://dpwjbsxqtam5n.cloudfront.net/lead-gen/gavins-grooves/gavin.jpg",
        "title" => '
            Gavin Harrison Is <br class="hidden sm:inline">
            Your Drum Teacher
        ',
        "desc" => 'Gavin Harrison is best known for his playing with progressive rock bands Porcupine Tree and King Crimson. He began working professionally in 1979 and has since appeared on over 140 recordings. He\'s performed and/or recorded with a wide variety of artists including Incognito, Lisa Stansfield, Lewis Taylor, Paul Young, Iggy Pop, OSI, Shooter, The King Of Oblivion, Sam Brown, Tom Robinson, Go West, and many others.
        <br><br>
        He won the Modern Drummer magazine readers\' poll for "best progressive rock drummer of the year" from 2007 to 2010 (and again in 2016), as well as "Best Prog Drummer" from DRUM USA magazine in 2011. In 2014, Modern Drummer placed Gavin in the Top 50 Greatest Drummers of all Time.'
    ])

    <section class="three-icon">
        <div class="container px-4 mx-auto max-w-6xl">
            <h1>Gavin’s Go-To Grooves, Yours For Life!</h1>
            <h3>
                Sign up on this page and you’ll get 8 videos with Gavin Harrison <br class="hidden sm:inline">
                that are normally reserved for Drumeo members.
            </h3>
            <div class="flex flex-wrap">
                <div class="w-full sm:w-1/3">
                    <div class="point-icon"><i class="fas fa-music"></i></div>
                    <p>
                        <strong>5 Porcupine Tree Grooves</strong><br>
                        You’ve heard the grooves, now you <br class="hidden lg:inline">
                        can learn them from Gavin himself!
                    </p>
                </div>
                <div class="w-full sm:w-1/3">
                    <div class="point-icon"><i class="icon-songs"></i></div>
                    <p>
                        <strong>1 PLAY-ALONG SONG</strong><br>
                        Get a full play-along song that Gavin put<br class="hidden lg:inline">
                        together with multi-instrumentalist 05Ric.
                    </p>
                </div>
                <div class="w-full sm:w-1/3">
                    <div class="point-icon"><i class="fas fa-infinity"></i></div>
                    <p>
                        <strong>UNLIMITED LIFETIME ACCESS</strong><br>
                        Simply sign up free on this page to<br class="hidden lg:inline">
                        get online access to the entire course.
                    </p>
                </div>
            </div>
        </div>
    </section>

    @include('drumeo.lead-gen.partials.quick-questions',[
        "bgColor" => "white",
        "textColor" => "black",
    ])

    <section class="final">
        <div class="container px-4 mx-auto max-w-5xl">
            <div class="course-logo">
                <h2>Gavin Harrison</h2>
                <h3>The Grooves Of Porcupine Tree</h3>
            </div>
            <p>
                Click the button below for free <br class="sm:hidden">
                lifetime access to this online course.
            </p>
            <br><br>
            @include("drumeo.lead-gen.partials.sign-up-form-rc", [
                    "recaptchaKey" => $recaptchaKey,
                "formId" => "Drumeo - Engagement - Trigger - Gavins Grooves - Web Form",
                "formName" => 'Gavins Grooves',
                "buttonText" => 'Send The Videos&nbsp;'
            ])
        </div>
    </section>

    <div class="reveal large max-w-2xl" id="thankYouModal" data-reveal data-open="true">
        <div class="gavin-sign-up">
            <h2>Success!</h2>
            <p>
                We're emailing you the link to Gavin's free course.
                <br><br>
                <em>If you don't receive the email within 10 minutes, check your spam<br class="hidden sm:inline">
                folder or refresh this page to re-enter your email address again.</em>
            </p>

            <div class="social-links">
                <a href="https://www.youtube.com/freedrumlessons/" target="_blank" class="youtube"><i class="fab fa-youtube"></i></a>
                <a href="https://facebook.com/drumeo/" target="_blank" class="facebook"><i class="fab fa-facebook-f"></i></a>
                <a href="https://instagram.com/drumeoofficial/" target="_blank" class="instagram"><i class="fab fa-instagram"></i></a>
            </div>
        </div>
    </div>
@stop
