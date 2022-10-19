@extends('drumeo.lead-gen.lead-gen-layout-tw')

@section('meta')
    <title>Hand Technique - The Motions Of Drumming | Drumeo</title>
    <meta name="description" content="">
    <!-- Social Media -->
    <meta property="og:image" content="" style="display: none;">
    <meta property="og:title" content="Hand Technique - The Motions Of Drumming">
    <meta property="og:description" content="">
    <meta property="og:url" content="https://www.drumeo.com/hand-technique/">
@stop

@section('styles')
    <style>
        .header form button[type="submit"] {
            background: #00bc75;
        }
        .header form button[type="submit"]:hover {
            background:#00d483;
        }
        .header form .form-arrow {
            color: #00bc75;
        }
    </style>
@stop

@section('content')
    <header class="header" style="background-image:url({{ cdn('lead-gen/dtme/bg.jpg') }});">
        <div class="container max-w-6xl mx-auto px-4">
            <div class="text-center">
                <img class="series-logo mx-auto" src="{{ cdn('lead-gen/dtme/logo.png') }}" alt="Hand Technique">
                <p>Enter your email address <br class="inline sm:hidden">
                    below to unlock your lessons...</p>

                @include("drumeo.lead-gen.partials.sign-up-form-tw", [
                    "submitArrows" => true,
                    "formId" => "Drumeo - Engagement - Trigger - Hand Technique - Web Form",
                    "formName" => 'Hand Technique',
                ])
            </div>
        </div>
    </header>


    <section class="lesson-grid">
        <div class="container max-w-6xl mx-auto px-4">
            <h1 class="text-center">See What's Inside</h1>
            <div class="thumbnail-wrap grid gap-6 grid-cols-2 md:grid-cols-3">
                <div class="w-full">
                    @include("drumeo.lead-gen.partials.thumbnail-signup", [
                        "image" => "https://i.vimeocdn.com/video/623662001-6670b0b644776c95b6ed1ce97c005c22b0fe568ee5225de3d83409d8f04e77b4-d_640",
                        "title" => "Introduction",
                        "modal" => "previewModal"
                    ])
                </div>
                <div class="w-full">
                    @include("drumeo.lead-gen.partials.thumbnail-signup", [
                        "image" => "https://i.vimeocdn.com/video/623668805-0397615e9c33e5e4ae1bb8f7896ec06f02fd171a584d980c9dbda70d6513bac7-d_640",
                        "title" => "The Motions In French Grip",
                        "locked" => true
                    ])
                </div>
                <div class="w-full">
                    @include("drumeo.lead-gen.partials.thumbnail-signup", [
                        "image" => "https://i.vimeocdn.com/video/623675350-f559455aae45948e23f25dc59495f86126ef1cc564e2a7208e1a157e50c58108-d_640",
                        "title" => "The Motions In German Grip",
                        "locked" => true
                    ])
                </div>
                <div class="w-full">
                    @include("drumeo.lead-gen.partials.thumbnail-signup", [
                        "image" => "https://i.vimeocdn.com/video/623682435-7d053de096d78221d9dbce6d036bfc2493a55fd0731408b65745901dd56387d6-d_640",
                        "title" => "The Motions In Traditional Grip",
                        "locked" => true
                    ])
                </div>
                <div class="w-full">
                    @include("drumeo.lead-gen.partials.thumbnail-signup", [
                        "image" => "https://i.vimeocdn.com/video/623694516-8be0d21532e9385c94a633f75f5211f44cd097a3c792108fd2d621fdb54ea8e2-d_640",
                        "title" => "How To Apply The Motions",
                        "locked" => true
                    ])
                </div>
                <div class="w-full">
                    @include("drumeo.lead-gen.partials.thumbnail-signup", [
                        "image" => "https://i.vimeocdn.com/video/625581492-1d00b9fd5975cc94f21c13baf2208d673b9c57a72f63ec30173fba6efe88ba96-d_640",
                        "title" => "Applying Motions To The Drumset",
                        "locked" => true
                    ])
                </div>
            </div>
        </div>
    </section>

    @include('drumeo.lead-gen.partials.enter-email1',[
        "headLine" => "Enter your email below to get started...",
        "formId" => "Drumeo - Engagement - Trigger - Hand Technique - Web Form",
        "formName" => 'Hand Technique',
    ])

    <div class="reveal medium" id="previewModal" data-reveal data-reset-on-close="false">
        <div class="flex-video vimeo widescreen aspect-16:9 w-full relative">
            <iframe class="fixed inset-0 h-full w-full absolute reset-on-close" src="" data-lazy-load-url="//player.vimeo.com/video/208363526?autoplay=1" frameborder="0" allowfullscreen title="intro-video" allow="autoplay"></iframe>
        </div>
    </div>

    <div class="reveal medium" id="signUpModal" data-reveal data-reset-on-close="false">
        <section class="header pop-up">
            <h1 class="text-center">
                Enter your email address <br class="hidden sm:inline">
                below to unlock your lessons...
            </h1>
            @include("drumeo.lead-gen.partials.sign-up-form-tw", [
                "stacked" => true,
                "formId" => "Drumeo - Engagement - Trigger - Hand Technique - Web Form",
                "formName" => 'Hand Technique',
            ])
        </section>
    </div>
@stop
