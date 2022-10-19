@extends('drumeo.lead-gen.ultimate-toolbox.5-play-alongs.lesson-page')

@section('title')
    Happy Hour
@stop

@section('video', '//player.vimeo.com/video/84082165')

@section('lesson-number', '2')

@section('previous')
    /ultimate-toolbox/5pa/1
@stop

@section('next')
    /ultimate-toolbox/5pa/3
@stop

@section('prev-thumb', 'https://i.vimeocdn.com/video/460798010-b37892e3ec70357cd0f9902725cdba330edd4c533f3ad4b0d4df10d68d14de1a-d_640')

@section('next-thumb', 'https://i.vimeocdn.com/video/469179675-82ad83f9ecd4ae8b97645ea1c37c4034c30df5cda4bc4979350949f3d0a11258-d_640')

@section('assets')
    @include('drumeo.lead-gen.partials._assignment-resources', [
        "title" => "PDF",
        "pdfURL" => "https://dzryyo1we6bm3.cloudfront.net/ultimate-toolbox/5pa/happy-hour.pdf",
    ])

    @include('drumeo.lead-gen.partials._assignment-resources', [
        "title" => "MP3",
        "mp3URL" => "https://dzryyo1we6bm3.cloudfront.net/ultimate-toolbox/5pa/happy-hour-no-click.mp3",
    ])

    @include('drumeo.lead-gen.partials._assignment-resources', [
        "title" => "MP3 with click",
        "mp3URL" => "https://dzryyo1we6bm3.cloudfront.net/ultimate-toolbox/5pa/happy-hour-click.mp3",
    ])
@stop
