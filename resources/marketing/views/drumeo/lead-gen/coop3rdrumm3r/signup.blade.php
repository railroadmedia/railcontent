@extends('drumeo.lead-gen.lead-gen-layout-tw')

@section('meta')
    <title>How To Start Playing Drums | Drumeo</title>
    <meta name="description" content="Get 5 free video lessons with YouTube-star COOP3RDRUMM3R, covering everything you need to start learning the drums for the very first time!">

    <!-- Social Media -->
    <meta property="og:image" content="https://dpwjbsxqtam5n.cloudfront.net/sales/2023/share-image-drumeo.jpg" style="display: none;">
    <meta property="og:title" content="How To Start Playing Drums | Drumeo">
    <meta property="og:description" content="Get 5 free video lessons with YouTube-star COOP3RDRUMM3R, covering everything you need to start learning the drums for the very first time!">
    <meta property="og:url" content="https://www.drumeo.com/coop3rdrumm3r/">
@stop

@section('styles')
    <style>
        .header form button[type="submit"],
        .lesson-grid .lesson-grid-item .top-image .top-left-badge {
            background:#bb2025;
        }
        .header form button[type="submit"]:hover {
            background:#d4262c;
        }
        .reveal .gavin-sign-up h2 {
            color:#bb2025;
        }
    </style>
@stop

@section('content')
    <header class="header" style="background-image:url(https://dpwjbsxqtam5n.cloudfront.net/headers/9.jpg);">
        <div class="container max-w-6xl mx-auto px-4 flex flex-col sm:items-center sm:flex-row">
            <div class="w-full sm:mr-4 sm:w-7/12 lg:w-2/3">
                <div class="flex-video widescreen aspect-16:9 w-full relative">
                    <iframe class="fixed inset-0 h-full w-full absolute" src="//player.vimeo.com/video/149674624" frameborder="0" allowfullscreen title="intro-video"></iframe>
                </div>
            </div>
            <div class="w-full sm:w-5/12 lg:w-1/3">
                <img class="series-logo mx-auto" src="https://dpwjbsxqtam5n.cloudfront.net/lead-gen/coop3r/coop3r-logo2.png" alt="How To Start Playing Drums">
                <p>Enter your email below for 5 free <br class="hidden lg:inline">
                    video lessons for getting started.</p>
                @include("drumeo.lead-gen.partials.sign-up-form", [
                    "recaptchaKey" => $recaptchaKey,
                    "stacked" => true,
                    "formId" => "Drumeo - Engagement - Trigger - CC HTSPD - Web Form",
                    "formName" => 'COOP3RDRUMM3R - CC HTSPD - Lead Gen',
                ])
            </div>
        </div>
    </header>


    <section class="lesson-grid">
        <div class="container max-w-6xl mx-auto px-4">
            <h1>Want to play the drums like COOP3RDRUMM3R?</h1>
            <p>In this exclusive video series, you'll get his best tips for how YOU can start playing the drums right away!</p>
            <div class="thumbnail-wrap grid grid-cols-2 gap-4 sm:grid-cols-3">
                <div class="w-full">
                    @include("drumeo.lead-gen.partials.thumbnail-signup", [
                        "image" => "https://i.vimeocdn.com/video/551839388-a432e655008cce35ee73cec69639b3c801281023879f6a54a323f112782e7ef3-d_640",
                        "badge" => "Lesson #1",
                        "title" => "Understanding The Drum Set"
                    ])
                </div>
                <div class="w-full">
                    @include("drumeo.lead-gen.partials.thumbnail-signup", [
                        "image" => "https://i.vimeocdn.com/video/548962045-245c563e3dc6c0dfc39ffcd73ea0818c46579c70cf31b71c5f5ddf969b23580e-d_640",
                        "badge" => "Lesson #2",
                        "title" => "Drum Theory"
                    ])
                </div>
                <div class="w-full">
                    @include("drumeo.lead-gen.partials.thumbnail-signup", [
                        "image" => "https://i.vimeocdn.com/video/551839496-2316746236b066eb501ca6b120f2afb0e5d1a77dab1ee4902541021bbf2ebf79-d_640",
                        "badge" => "Lesson #3",
                        "title" => "How To Practice"
                    ])
                </div>
                <div class="w-full">
                    @include("drumeo.lead-gen.partials.thumbnail-signup", [
                        "image" => "https://i.vimeocdn.com/video/548963870-f2b45bc2cf148787602cd2dd0cd604ee6df16a75b28d4b303eb01ff3e5a77c53-d_640",
                        "badge" => "Lesson #4",
                        "title" => "Starter Grooves"
                    ])
                </div>
                <div class="w-full end">
                    @include("drumeo.lead-gen.partials.thumbnail-signup", [
                        "image" => "https://i.vimeocdn.com/video/551839554-da5d348f09ac3cc5864cc2a4d0651e216216127609a1e657d1e2ba932f673eff-d_640",
                        "badge" => "Lesson #5",
                        "title" => "Starter Fills"
                    ])
                </div>
            </div>
        </div>
    </section>

    @include('drumeo.lead-gen.partials.enter-email1',[
        "headLine" => "Enter your email below for 5 free video lessons for getting started.",
        "formId" => "Drumeo - Engagement - Trigger - CC HTSPD - Web Form2",
        "formName" => "COOP3RDRUMM3R - CC HTSPD - Lead Gen"
    ])
@stop
