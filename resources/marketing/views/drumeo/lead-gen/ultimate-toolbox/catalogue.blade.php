@extends('drumeo.lead-gen.lead-gen-layout-tw')

@section('meta')
    <meta name="robots" content="noindex">
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
            var foundationInstances = [
                new Foundation.Reveal($('#UnsubModal'))
            ];

            var showModal = location.search.substr(1).includes('noMoreEmails');

            if (showModal) {
                $('#UnsubModal').foundation('open');
            }
        });
    </script>
@stop

@section('content')
    <header class="header toolbox">
        <div class="container max-w-6xl mx-auto px-4">
            <div class="text-center">
                <img class="series-logo mx-auto" src="{{ cdn('lead-gen/tudt/tudt-logo.png') }}" alt="The Ultimate Drumming Toolbox">
            </div>
        </div>
    </header>


    <section class="lesson-grid toolbox">
        <div class="container max-w-6xl mx-auto px-4">
            <h1 class="text-center">Click on any of the tools below to get started!</h1>
            <div class="thumbnail-wrap grid gap-6 grid-cols-2 md:grid-cols-3">
                <div class="w-full">
                    @include("drumeo.lead-gen.partials.thumbnail-signup", [
                        "url" => "/ultimate-toolbox/gsotd/",
                        "image" => "https://dpwjbsxqtam5n.cloudfront.net/lead-gen/tudt/getting-started-on-the-drums.png",
                    ])
                </div>
                <div class="w-full">
                    @include("drumeo.lead-gen.partials.thumbnail-signup", [
                        "url" => "https://dzryyo1we6bm3.cloudfront.net/ultimate-toolbox/prg.pdf",
                        "image" => "https://dpwjbsxqtam5n.cloudfront.net/lead-gen/tudt/practice-routine-generator.png",
                    ])
                </div>
                <div class="w-full">
                    @include("drumeo.lead-gen.partials.thumbnail-signup", [
                        "url" => "/ultimate-toolbox/dodt/",
                        "image" => "https://dpwjbsxqtam5n.cloudfront.net/lead-gen/tudt/the-dictionary-of-drum-terms.png",
                    ])
                </div>
                <div class="w-full">
                    @include("drumeo.lead-gen.partials.thumbnail-signup", [
                        "url" => "/ultimate-toolbox/htls/",
                        "image" => "https://dpwjbsxqtam5n.cloudfront.net/lead-gen/tudt/how-to-learn-songs-quickly.png",
                    ])
                </div>
                <div class="w-full">
                    @include("drumeo.lead-gen.partials.thumbnail-signup", [
                        "url" => "/ultimate-toolbox/mcsa/",
                        "image" => "https://dpwjbsxqtam5n.cloudfront.net/lead-gen/tudt/how-to-make-your-cheap-kit-sound-amazing.png",
                    ])
                </div>
                <div class="w-full">
                    @include("drumeo.lead-gen.partials.thumbnail-signup", [
                        "url" => "/ultimate-toolbox/fwtgf/",
                        "image" => "https://dpwjbsxqtam5n.cloudfront.net/lead-gen/tudt/fastest-way-to-get-faster.png",
                    ])
                </div>
                <div class="w-full">
                    @include("drumeo.lead-gen.partials.thumbnail-signup", [
                        "url" => "/ultimate-toolbox/urfd/",
                        "image" => "https://dpwjbsxqtam5n.cloudfront.net/lead-gen/tudt/useful-rudiments-for-modern-drummers.png",
                    ])
                </div>
                <div class="w-full">
                    @include("drumeo.lead-gen.partials.thumbnail-signup", [
                        "url" => "/ultimate-toolbox/bdbc/",
                        "image" => "https://dpwjbsxqtam5n.cloudfront.net/lead-gen/tudt/bass-drum-bootcamp.png",
                    ])
                </div>
                <div class="w-full end">
                    @include("drumeo.lead-gen.partials.thumbnail-signup", [
                        "url" => "/ultimate-toolbox/5pa/",
                        "image" => "https://dpwjbsxqtam5n.cloudfront.net/lead-gen/tudt/5-drum-play-along-songs.png",
                    ])
                </div>
            </div>
        </div>
    </section>


    <input type="hidden" id="openModal" data-open="UnsubModal">

    <div class="reveal medium" id="UnsubModal" data-reveal data-reset-on-close="true">
        <section class="header pop-up text-center">
            <h1 class="text-center">Thank you!</h1>
            <p>We've received your request and won't send you any more email reminders for this free series.</p>
        </section>
    </div>
@stop
