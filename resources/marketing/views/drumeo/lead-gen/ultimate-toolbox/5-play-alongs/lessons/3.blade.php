@extends('drumeo.lead-gen.ultimate-toolbox.5-play-alongs.lesson-page')

@section('title')
    Bossa Nova
@stop

@section('video', '//player.vimeo.com/video/90152319')

@section('lesson-number', '3')

@section('previous')
    /ultimate-toolbox/5pa/2
@stop

@section('next')
    /ultimate-toolbox/5pa/4
@stop

@section('prev-thumb', 'https://i.vimeocdn.com/video/460793418-c4cac00025167cd090a51782db07373164b0dd549ace26dd30e222d8f2a4fd7f-d_640')

@section('next-thumb', 'https://i.vimeocdn.com/video/460801706-c1b2d2bcbaa562b61c4920d519e77bb0377a18e5c63fa573b3067132304b968f-d_640')

@section('assets')
    @include('drumeo.lead-gen.partials._assignment-resources', [
        "title" => "PDF",
        "pdfURL" => "https://dzryyo1we6bm3.cloudfront.net/ultimate-toolbox/5pa/bossa-nova.pdf",
    ])

    @include('drumeo.lead-gen.partials._assignment-resources', [
        "title" => "MP3",
        "mp3URL" => "https://dzryyo1we6bm3.cloudfront.net/ultimate-toolbox/5pa/bossa-nova-no-click.mp3",
    ])

    @include('drumeo.lead-gen.partials._assignment-resources', [
        "title" => "MP3 with click",
        "mp3URL" => "https://dzryyo1we6bm3.cloudfront.net/ultimate-toolbox/5pa/bossa-nova-click.mp3",
    ])
@stop
