@extends('drumeo.lead-gen.lead-gen-layout-tw')

@section('meta')
    <title>The Ultimate Drumming Toolbox | Drumeo</title>
    <meta name="description" content="The ultimate toolbox to jump start your drumming! Sign up for these free resources to expand your drumming education today.">

    <!-- Social Media -->
    <meta property="og:image" content="https://dpwjbsxqtam5n.cloudfront.net/lead-gen/tudt/og-image.jpg" style="display: none;">
    <meta property="og:title" content="The Ultimate Drumming Toolbox | Drumeo">
    <meta property="og:description" content="Sign up for these free resources to expand your drumming education today.">
    <meta property="og:url" content="https://www.drumeo.com/ultimate-toolbox/">
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
    <header class="header toolbox">
        <div class="container max-w-6xl mx-auto px-4">
            <div class="text-center">
                <img class="series-logo mx-auto" src="https://dpwjbsxqtam5n.cloudfront.net/lead-gen/tudt/tudt-logo.png" alt="The Ultimate Drumming Toolbox">
                <h1 class="hidden">The Ultimate Drumming Toolbox</h1>
                <p>Enter your email below to open your toolbox...</p>
                @include("drumeo.lead-gen.partials.sign-up-form-tw", [
                           "submitArrows" => true,
                           "formId" => "Drumeo - Engagement - Trigger - Ultimate Toolbox - Web Form",
                           "formName" => 'The Ultimate Drumming Toolbox',
                       ])
            </div>
        </div>
    </header>


    <section class="lesson-grid toolbox">
        <div class="container max-w-6xl mx-auto px-4">
            <h1 class="text-center">See What's Inside</h1>
            <div class="thumbnail-wrap grid gap-6 grid-cols-2 md:grid-cols-3">
                <div class="w-full">
                    @include("drumeo.lead-gen.partials.thumbnail-signup", [
                        "image" => "https://dpwjbsxqtam5n.cloudfront.net/lead-gen/tudt/getting-started-on-the-drums.png",
                    ])
                </div>
                <div class="w-full">
                    @include("drumeo.lead-gen.partials.thumbnail-signup", [
                        "image" => "https://dpwjbsxqtam5n.cloudfront.net/lead-gen/tudt/practice-routine-generator.png",
                    ])
                </div>
                <div class="w-full">
                    @include("drumeo.lead-gen.partials.thumbnail-signup", [
                        "image" => "https://dpwjbsxqtam5n.cloudfront.net/lead-gen/tudt/the-dictionary-of-drum-terms.png",
                    ])
                </div>
                <div class="w-full">
                    @include("drumeo.lead-gen.partials.thumbnail-signup", [
                        "image" => "https://dpwjbsxqtam5n.cloudfront.net/lead-gen/tudt/how-to-learn-songs-quickly.png",
                    ])
                </div>
                <div class="w-full">
                    @include("drumeo.lead-gen.partials.thumbnail-signup", [
                        "image" => "https://dpwjbsxqtam5n.cloudfront.net/lead-gen/tudt/how-to-make-your-cheap-kit-sound-amazing.png",
                    ])
                </div>
                <div class="w-full">
                    @include("drumeo.lead-gen.partials.thumbnail-signup", [
                        "image" => "https://dpwjbsxqtam5n.cloudfront.net/lead-gen/tudt/fastest-way-to-get-faster.png",
                    ])
                </div>
                <div class="w-full">
                    @include("drumeo.lead-gen.partials.thumbnail-signup", [
                        "image" => "https://dpwjbsxqtam5n.cloudfront.net/lead-gen/tudt/useful-rudiments-for-modern-drummers.png",
                    ])
                </div>
                <div class="w-full">
                    @include("drumeo.lead-gen.partials.thumbnail-signup", [
                        "image" => "https://dpwjbsxqtam5n.cloudfront.net/lead-gen/tudt/bass-drum-bootcamp.png",
                    ])
                </div>
                <div class="w-full end">
                    @include("drumeo.lead-gen.partials.thumbnail-signup", [
                        "image" => "https://dpwjbsxqtam5n.cloudfront.net/lead-gen/tudt/5-drum-play-along-songs.png",
                    ])
                </div>
            </div>
        </div>
    </section>

    @include('drumeo.lead-gen.partials.enter-email1',[
        "headLine" => "Enter your email below to open your toolbox...",
        "formId" => "Drumeo - Engagement - Trigger - Ultimate Toolbox - Web Form",
        "formName" => 'The Ultimate Drumming Toolbox',
    ])

    <div class="reveal medium" id="signUpModal" data-reveal>
        <section class="header pop-up">
            <h1 class="text-center">Enter your email below to open your toolbox...</h1>
            @include("drumeo.lead-gen.partials.sign-up-form-tw", [
                "stacked" => true,
                "formId" => "Drumeo - Engagement - Trigger - Ultimate Toolbox - Web Form",
                "formName" => 'The Ultimate Drumming Toolbox',
            ])
        </section>
    </div>

    <div class="reveal large" id="thankYouModal" data-reveal data-reset-on-close="true">
        <div class="gavin-sign-up">
            <h2>Success!</h2>
            <p>
                We're emailing you the link to your lessons.
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
