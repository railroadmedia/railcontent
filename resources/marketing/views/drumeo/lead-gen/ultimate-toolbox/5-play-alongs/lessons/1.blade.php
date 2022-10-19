@extends('drumeo.lead-gen.ultimate-toolbox.5-play-alongs.lesson-page')

@section('title')
    Eighth Note Rock
@stop

@section('video', '//player.vimeo.com/video/84085314')

@section('lesson-number', '1')

@section('next')
    /ultimate-toolbox/5pa/2/
@stop

@section('next-thumb', 'https://i.vimeocdn.com/video/460793418-c4cac00025167cd090a51782db07373164b0dd549ace26dd30e222d8f2a4fd7f-d_640')

@section('assets')
    @include('drumeo.lead-gen.partials._assignment-resources', [
        "title" => "PDF",
        "pdfURL" => "https://dzryyo1we6bm3.cloudfront.net/ultimate-toolbox/5pa/eighth-note-rock.pdf",
    ])

    @include('drumeo.lead-gen.partials._assignment-resources', [
        "title" => "MP3",
        "mp3URL" => "https://dzryyo1we6bm3.cloudfront.net/ultimate-toolbox/5pa/eighth-note-rock-no-click.mp3",
    ])

    @include('drumeo.lead-gen.partials._assignment-resources', [
        "title" => "MP3 with click",
        "mp3URL" => "https://dzryyo1we6bm3.cloudfront.net/ultimate-toolbox/5pa/eighth-note-rock-click.mp3",
    ])
@stop
