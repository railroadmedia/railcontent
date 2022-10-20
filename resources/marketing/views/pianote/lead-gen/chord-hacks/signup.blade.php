@extends('pianote.lead-gen.chord-hacks.chord-hacks-layout')

@section('meta')
    @parent
    <title>Chord Hacks | Pianote</title>
@stop()

@section('page-body')
    @include('pianote.lead-gen.partials.header2',[
        "bg" => 'url("https://d2vyvo0tyx8ig5.cloudfront.net/chord-hacks/bg.jpg") center center/cover no-repeat',
        "imgSrc" => 'https://d2vyvo0tyx8ig5.cloudfront.net/chord-hacks/logo.png',
        "text" => '<div class="medium-body mt-4 mb-5"><em>The easier way to learn piano chords so you can play popular songs!</em></div>
        <p class="medium-body">Just enter your email below <br class="md:hidden "> for 6 free video lessons...</p>',
        "form" => true,
        "formId" => "Pianote - Engagement - Trigger - Chord Hacks - Web Form",
        "formName" => 'Chord Hacks',
    ])

    <div class="container jordan-message mx-auto lg:max-w-6xl flex flex-wrap items-center">
        <div class="w-full md:w-1/4 lg:w-1/5 text-center px-4">
            <img class="mx-auto" src="https://d2vyvo0tyx8ig5.cloudfront.net/chord-hacks/lisa.jpg" alt="lisa-witt">
        </div>
        <div class="w-full md:w-3/4 lg:w-4/5 px-4">
            <div class="medium-heading mt-4 mb-2 lg:mt-6">Learn to play piano quicker with chords!</div>
            <p class="small-body">Learning chords is a great way to improve your piano skills without any music theory. And Lisa Witt’s “Chord Hacks” series will show you how to play the most popular chords, so you can play many of your favorite songs on the piano!</p>
        </div>
    </div>

    @include('pianote.lead-gen.partials.series1',[
        "lessons" => [
            [
                "boxImage" => 'https://d2vyvo0tyx8ig5.cloudfront.net/chord-hacks/chord-hacking.jpg',
                "boxAlt" => "chord-hacking",
            ],
            [
                "boxImage" => 'https://d2vyvo0tyx8ig5.cloudfront.net/chord-hacks/inversions.jpg',
                "boxAlt" => "inversions",
            ],
            [
                "boxImage" => 'https://d2vyvo0tyx8ig5.cloudfront.net/chord-hacks/adding-rhythm.jpg',
                "boxAlt" => "adding-rhythm",
            ],
            [
                "boxImage" => 'https://d2vyvo0tyx8ig5.cloudfront.net/chord-hacks/two-hands.jpg',
                "boxAlt" => "two-hands",
            ],
            [
                "boxImage" => 'https://d2vyvo0tyx8ig5.cloudfront.net/chord-hacks/chord-progressions.jpg',
                "boxAlt" => "chord-progressions",
            ],
            [
                "boxImage" => 'https://d2vyvo0tyx8ig5.cloudfront.net/chord-hacks/popular-songs.jpg',
                "boxAlt" => "popular-songs",
            ],
        ],
    ])

    @include('pianote.lead-gen.partials.enter-email',[
        "content" => '<div class="medium-body mb-7">Just enter your email below for 6 beginner video lessons!</div>',
        "formId" => "Pianote - Engagement - Trigger - Chord Hacks - Web Form",
        "formName" => 'Chord Hacks',
        "buttonBorder" => 'white',
        "bgStyles" => 'background-color: #f61a30;',
    ])

    <div class="reveal text-center modal" id="signUpModal" data-reveal style="max-width:560px;background-color: rgb(243, 244, 246);">
        <div class="modal-content">
            <div class="w-full">
                <img class="inverted" src="https://d2vyvo0tyx8ig5.cloudfront.net/chord-hacks/logo.png" alt="getting-started-logo">

                <div class="medium-body text-center">
                    Enter your email below <br>  for your free piano lessons!
                </div>
                <br>
                @include('pianote.lead-gen._sign-up-form', [
                    "redirect" => true,
                    "stacked" => true,
                    "formId" => "Pianote - Engagement - Trigger - Chord Hacks - Web Form",
                    "formName" => 'Chord Hacks',
                ])
            </div>
        </div>
    </div>
@stop

@section('scripts')
    @parent

    <script>
        $(document).ready(function () {
            $(document).foundation();
        });
    </script>
    <script type="text/javascript" src="/marketing/js/pianote/modal.js"></script>
    <script type="text/javascript" src="/marketing/js/pianote/modal-autoplay-alt.js"></script>
@endsection
