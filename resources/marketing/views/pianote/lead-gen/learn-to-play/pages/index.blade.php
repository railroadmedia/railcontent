@extends('pianote.lead-gen.learn-to-play.layout')


@section('meta')
    @parent
    <meta name="robots" content="noindex">
    <title>Learn to Play Piano</title>
@stop()

@section('page-body')
    <div class="promo-heading-background container-fluid no-padding" style="background: url(https://d2vyvo0tyx8ig5.cloudfront.net/backgrounds/background-1.jpg) 50%/cover no-repeat;">
        <div class="container promo-heading series mx-auto py-10 md:py-12 lg:max-w-6xl lg:py-16">
            <img class="learn-to-play-logo" src="https://d2vyvo0tyx8ig5.cloudfront.net/learn-piano/logo.png" alt="learn-to-play-logo">
        </div>
    </div>

    <div class="container series-boxes mx-auto lg:max-w-6xl">
        <div class="w-full text-center">
            <div class="large-body my-7"><strong>Click Any Lesson Below to Get Started</strong></div>
        </div>

        @include('pianote.lead-gen.partials.series1',[
            "lessons" => [
                [
                    "boxImage" => 'https://d2vyvo0tyx8ig5.cloudfront.net/quick-start/how-to-play-piano.png',
                    "boxAlt" => "how-to-play-piano",
                    "watchLink" => "/my-lessons/how-to-play-piano",
                ],
                [
                    "boxImage" => 'https://d2vyvo0tyx8ig5.cloudfront.net/quick-start/how-to-play-chords.png',
                    "boxAlt" => "how-to-play-chords",
                    "watchLink" => "/my-lessons/how-to-play-chords",
                ],
                [
                    "boxImage" => 'https://d2vyvo0tyx8ig5.cloudfront.net/quick-start/strengthening-your-hands.png',
                    "boxAlt" => "strengthening-your-hands",
                    "watchLink" => "/my-lessons/strengthening-your-hands",
                ],
                [
                    "boxImage" => 'https://d2vyvo0tyx8ig5.cloudfront.net/quick-start/play-g-major.png',
                    "boxAlt" => "play-g-major",
                    "watchLink" => "/my-lessons/play-g-major",
                ],
                [
                    "boxImage" => 'https://d2vyvo0tyx8ig5.cloudfront.net/quick-start/play-f-major.png',
                    "boxAlt" => "play-f-major",
                    "watchLink" => "/my-lessons/play-f-major",
                ],
                [
                    "boxImage" => 'https://d2vyvo0tyx8ig5.cloudfront.net/quick-start/minor-keys.png',
                    "boxAlt" => "minor-keys",
                    "watchLink" => "/my-lessons/minor-keys",
                ],
                [
                    "boxImage" => 'https://d2vyvo0tyx8ig5.cloudfront.net/quick-start/chord-inversions.png',
                    "boxAlt" => "chord-inversions",
                    "watchLink" => "/my-lessons/chord-inversions",
                ],
                [
                    "boxImage" => 'https://d2vyvo0tyx8ig5.cloudfront.net/quick-start/play-other-chords-in-the-major-keys.png',
                    "boxAlt" => "play-other-chords-in-the-major-keys",
                    "watchLink" => "/my-lessons/other-chords",
                ],
                [
                    "boxImage" => 'https://d2vyvo0tyx8ig5.cloudfront.net/quick-start/all-about-arpeggios.png',
                    "boxAlt" => "all-about-arpeggios",
                    "watchLink" => "/my-lessons/all-about-arpeggios",
                ],
            ],
        ])

        <div class="box w-full with-video px-4">
            <a href="/my-lessons/how-to-write-a-song">
                <i class="fas fa-play-circle"></i>
                <img class="md:hidden" src="https://d2vyvo0tyx8ig5.cloudfront.net/quick-start/how-to-write-a-song.png">
                <img class="hidden md:inline" src="https://d2vyvo0tyx8ig5.cloudfront.net/quick-start/how-to-write-a-song-wide.png">
            </a>
        </div>
    </div>

    @include('pianote.lead-gen.learn-to-play.elements.red-signup')
@stop
