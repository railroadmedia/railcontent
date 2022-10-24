@extends('drumeo.lead-gen.lead-gen-layout-tw')

@section('meta')
    <title>Linear Drumming | Drumeo</title>
    <meta name="description" content="In this exclusive video series, you'll get his best tips on linear drumming and how to apply it to a range of fills, grooves, and styles of music!">

    <!-- Social Media -->
    <meta property="og:image" content="https://dpwjbsxqtam5n.cloudfront.net/sales/2022/og-image.jpg" style="display: none;">
    <meta property="og:title" content="Linear Drumming | Drumeo">
    <meta property="og:description" content="In this exclusive video series, you'll get his best tips on linear drumming and how to apply it to a range of fills, grooves, and styles of music!">
    <meta property="og:url" content="https://www.drumeo.com/linear-drumming/">
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
    <header class="header" style="background-image:url({{ cdn('headers/9.jpg') }});">
        <div class="container mx-auto px-4 max-w-6xl flex flex-col md:flex-row md:items-center">
            <div class="w-full md:mr-4 md:w-7/12 lg:w-2/3 lg:mr-10">
                <div class="flex-video widescreen aspect-16:9 w-full relative">
                    <iframe class="fixed inset-0 h-full w-full absolute" src="//player.vimeo.com/video/158554072" frameborder="0" allowfullscreen title="intro-video"></iframe>
                </div>
            </div>
            <div class="w-full md:w-5/12 lg:w-1/3">
                <img class="series-logo mx-auto" src="{{ cdn('lead-gen/coop3r/coop3r-logo2.png') }}" alt="Linear Drumming">
                <h1 class="hidden">Linear Drumming</h1>
                <p>Enter your email below for 5 free <br class="hidden lg:inline">
                    video lessons on linear drumming.</p>
                @include("drumeo.lead-gen.partials.sign-up-form-tw", [
                    "stacked" => true,
                    "formId" => "Drumeo - Engagement - Trigger - CC Linear - Web Form",
                    "formName" => 'Linear Drumming',
                ])
            </div>
        </div>
    </header>


    <section class="lesson-grid">
        <div class="container mx-auto px-4 max-w-6xl">
            <h1>What The Heck Is Linear Drumming?</h1>
            <p>In this exclusive video series, you'll get his best tips on linear drumming and how to apply it to a range of fills, grooves, and styles of music!</p>
            <div class="thumbnail-wrap grid gap-4 grid-cols-2 md:grid-cols-3">
                <div class="w-full">
                    @include("drumeo.lead-gen.partials.thumbnail-signup", [
                        "image" => "https://i.vimeocdn.com/video/560726784-7f2c75c0dbb17e9ae0fceb339df0fd6b681c626b3401fd46d7c9b06dadae617d-d_640",
                        "badge" => "Lesson #1",
                        "title" => "What Is Linear Drumming"
                    ])
                </div>
                <div class="w-full">
                    @include("drumeo.lead-gen.partials.thumbnail-signup", [
                        "image" => "https://i.vimeocdn.com/video/560726966-41e3db31ccbccda9d6a259160f07ed51c064dbbfb09a3e56a12e9065b9043655-d_640",
                        "badge" => "Lesson #2",
                        "title" => "​Dance Pop Grooves​"
                    ])
                </div>
                <div class="w-full">
                    @include("drumeo.lead-gen.partials.thumbnail-signup", [
                        "image" => "https://i.vimeocdn.com/video/560727218-21ae1bae198ad6c555b15363f351ba618f2846e2efbdf98a2480cba5ed7648e7-d_640",
                        "badge" => "Lesson #3",
                        "title" => "​Rock Tom Grooves​"
                    ])
                </div>
                <div class="w-full">
                    @include("drumeo.lead-gen.partials.thumbnail-signup", [
                        "image" => "https://i.vimeocdn.com/video/560727540-477b10caa006c5bd1c67b666ca5ff8408b56e302acfdeffc32513f649aa716bb-d_640",
                        "badge" => "Lesson #4",
                        "title" => "​Gospel Grooves​"
                    ])
                </div>
                <div class="w-full end">
                    @include("drumeo.lead-gen.partials.thumbnail-signup", [
                        "image" => "https://i.vimeocdn.com/video/560727679-c21a30b3084fcaf2a799dbd465d526ed48cdfba97e436f6a209f8bc332e30ca6-d_640",
                        "badge" => "Lesson #5",
                        "title" => "​Metal Fills​"
                    ])
                </div>
            </div>
        </div>
    </section>

    @include('drumeo.lead-gen.partials.enter-email1',[
        "headLine" => "Enter your email below for 5 free video lessons on linear drumming.",
        "formId" => "Drumeo - Engagement - Trigger - CC Linear - Web Form",
        "formName" => 'Linear Drumming',
    ])

    <div class="reveal medium" id="signUpModal" data-reveal>
        <section class="header pop-up">
            <h1 class="text-center">Enter your email below for 5 free <br class="show-for-medium">
                video lessons on linear drumming.</h1>

            @include("drumeo.lead-gen.partials.sign-up-form-tw", [
                "stacked" => true,
                "formId" => "Drumeo - Engagement - Trigger - CC Linear - Web Form",
                "formName" => 'Linear Drumming',
            ])
        </section>
    </div>
@stop
