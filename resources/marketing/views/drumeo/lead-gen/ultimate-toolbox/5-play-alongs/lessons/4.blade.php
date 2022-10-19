@extends('drumeo.lead-gen.ultimate-toolbox.5-play-alongs.lesson-page')

@section('title')
    Country Train
@stop

@section('video', '//player.vimeo.com/video/84087719')

@section('lesson-number', '4')

@section('previous')
    /ultimate-toolbox/5pa/3
@stop

@section('next')
    /ultimate-toolbox/5pa/5
@stop

@section('prev-thumb', 'https://i.vimeocdn.com/video/469179675-82ad83f9ecd4ae8b97645ea1c37c4034c30df5cda4bc4979350949f3d0a11258-d_640')

@section('next-thumb', 'https://i.vimeocdn.com/video/460792882-40214b37f07201e61b443e0497c0daecb067f0fcaa825fe17ffc9dd23f0a020d-d_640')

@section('assets')
    @include('drumeo.lead-gen.partials._assignment-resources', [
        "title" => "PDF",
        "pdfURL" => "https://dzryyo1we6bm3.cloudfront.net/ultimate-toolbox/5pa/country-train.pdf",
    ])

    @include('drumeo.lead-gen.partials._assignment-resources', [
        "title" => "MP3",
        "mp3URL" => "https://dzryyo1we6bm3.cloudfront.net/ultimate-toolbox/5pa/country-train-no-click.mp3",
    ])

    @include('drumeo.lead-gen.partials._assignment-resources', [
        "title" => "MP3 with click",
        "mp3URL" => "https://dzryyo1we6bm3.cloudfront.net/ultimate-toolbox/5pa/country-train-click.mp3",
    ])
@stop
