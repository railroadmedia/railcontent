@extends('drumeo.lead-gen.lead-gen-layout-tw')

@section('meta')
    <title>Todd Sucherman - How To Become A  Good Sounding Drummer | Drumeo</title>
    <meta name="description" content="Sign up on this page and you’ll get 5 videos with Todd Sucherman that are normally reserved for Drumeo members.">
    <meta property="og:image" content="https://dpwjbsxqtam5n.cloudfront.net/lead-gen/sucherman-sound/bg.jpg" style="display: none;">
    <meta property="og:title" content="Todd Sucherman - How To Become A  Good Sounding Drummer">
    <meta property="og:description" content="Sign up on this page and you’ll get 5 videos with Todd Sucherman that are normally reserved for Drumeo members.">
    <meta property="og:url" content="https://www.drumeo.com/sucherman-sound/">
@stop

@section('styles')
    <link href="{{ asset('/marketing/parcel/drumeo/lead-gen-course.css') }}" rel="stylesheet">
    <style>
        .header.alt .row {
            background-position: center 30px;
            background-size: 770px;
        }
        .header.alt .row .course-logo {
            margin: 0 0 200px;
        }
        @media (min-width: 40em) {
            .header.alt .row {
                background-position: center -70px;
                background-size: 1300px;
            }
            .header.alt .row .course-logo {
                margin: 310px 0 15px;
            }
        }
        @media (min-width: 64em) {
            .header.alt .row {
                background-size: 1400px;
            }
        }
    </style>
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

    <header class="header alt">
        <div class="container mx-auto px-4 max-w-6xl" style="background-image: url(https://dpwjbsxqtam5n.cloudfront.net/lead-gen/sucherman-sound/bg.jpg);">
            <div class="text-center">
                <div class="course-logo anika">
                    <h4 class="text-yellow"><strong>Todd Sucherman's</strong></h4>
                    <h2>GOOD SOUNDING</h2>
                    <h3>DRUMMER</h3>
                </div>
                <p>Your free guide to playing the<br class="sm:hidden"> drums with precision & clarity.</p>
                @include("drumeo.lead-gen.partials.sign-up-form", [
                    "recaptchaKey" => $recaptchaKey,
                    "formId" => "Drumeo - Engagement - Trigger - Sucherman Sound - Web Form",
                    "formName" => 'Sucherman Sound',
                    "buttonText" => 'Send The Videos&nbsp;'
                ])
            </div>
        </div>
    </header>

    <div class="reveal large" id="previewModal" data-reveal data-reset-on-close="false">
        <div class="flex-video vimeo widescreen aspect-16:9 w-full relative">
            <iframe class="fixed inset-0 h-full w-full absolute reset-on-close" data-lazy-load-url="//player.vimeo.com/video/277504736?autoplay=1" frameborder="0" allowfullscreen allow="autoplay"></iframe>
        </div>
    </div>

    <section class="lesson-breakdown text-center">
        <div class="container mx-auto px-4 max-w-6xl">
            <h1 class="opensans"><strong>Improve your sound in <br class="sm:hidden">every playing situation.</strong></h1>
            <div class="left-right-thumbs">
                <div class="thumb-wrap">
                    <img src="https://i.vimeocdn.com/video/1040120650-4b9321fa37b38916cfe659b79374604ebe0eeff6b50d02f8c9ff4d4c38b468f3-d_1280" alt="sucherman-sound-thumb-1">
                    <div class="text">
                        <h4><strong>The importance of hats.</strong></h4>
                        <p>You’ll learn how to completely change the vibe of a song by harnessing the subtle sonic differences around the hi-hat. </p>
                    </div>
                </div>
                <div class="thumb-wrap">
                    <img src="https://i.vimeocdn.com/video/1040121560-ee27e9c3cbf6cf975c6445fa1963b3119d9786ff29ece084a06a9b2900d95906-d_1280" alt="sucherman-sound-thumb-2">
                    <div class="text">
                        <h4><strong>Fix your mix. </strong></h4>
                        <p>Todd shows you the volume to play each instrument to get that professionally mixed sound — in every style & playing situation!</p>
                    </div>
                </div>
                <div class="thumb-wrap">
                    <img src="https://i.vimeocdn.com/video/1040119731-c2dc6efa05d89750fb99f05772fef2a7a56b4e08846d392c0fb979c349206636-d_1280" alt="sucherman-sound-thumb-3">
                    <div class="text">
                        <h4><strong>Elevate your sound.</strong></h4>
                        <p>You don’t need to be a virtuoso to create amazing drum parts. These tips will make everything you play sound more musical & compelling!</p>
                    </div>
                </div>
            </div>
            <p style="margin: 30px auto 0;"><strong><em>You’ll get 5 FREE lessons in total.</em></strong></p>
        </div>
    </section>

    @include('drumeo.lead-gen.partials.quick-questions',[
        "bgColor" => "#eff0f0",
        "textColor" => "black",
    ])

    <section class="final">
        <div class="container mx-auto px-4 max-w-6xl">
            <div class="course-logo anika">
                <h4 class="text-yellow"><strong>Todd Sucherman's</strong></h4>
                <h2>GOOD SOUNDING</h2>
                <h3>DRUMMER</h3>
            </div>
            <p>Enter your email and receive<br class="sm:hidden"> the five video series, FREE.</p>
            <br><br class="hidden lg:inline">
            @include("drumeo.lead-gen.partials.sign-up-form", [
                    "recaptchaKey" => $recaptchaKey,
                "formId" => "Drumeo - Engagement - Trigger - Sucherman Sound - Web Form",
                "formName" => 'Sucherman Sound',
                "buttonText" => 'Send The Videos&nbsp;'
            ])
        </div>
    </section>


    <div class="reveal large" id="thankYouModal" data-reveal data-reset-on-close="true">
        <div class="gavin-sign-up">
            <h2>Success!</h2>
            <p>We're emailing you the link to Todd's free course.
                <br><br>
                <em>If you don't receive the email within 10 minutes, check your spam<br class="hidden sm:inline">
                    folder or refresh this page to re-enter your email address again.</em></p>

            <div class="social-links">
                <a href="https://www.youtube.com/freedrumlessons/" target="_blank" class="youtube"><i class="fab fa-youtube"></i></a>
                <a href="https://facebook.com/drumeo/" target="_blank" class="facebook"><i class="fab fa-facebook-f"></i></a>
                <a href="https://instagram.com/drumeoofficial/" target="_blank" class="instagram"><i class="fab fa-instagram"></i></a>
            </div>
        </div>
    </div>
@stop
