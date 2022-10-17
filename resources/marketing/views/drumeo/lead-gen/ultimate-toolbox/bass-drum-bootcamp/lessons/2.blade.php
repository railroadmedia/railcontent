@extends('drumeo.lead-gen.ultimate-toolbox.bass-drum-bootcamp.lesson-page')

@section('lesson-title')
    The Heel-Toe Technique
@stop

@section('video', '//player.vimeo.com/video/88432225')

@section('lesson-number', '2')

@section('previous')
    /ultimate-toolbox/bdbc/1
@stop

@section('next')
    /ultimate-toolbox/bdbc/3
@stop

@section('prev-thumb', 'https://i.vimeocdn.com/video/468224350-8ddf62e2d85fa0184fd2f9fbbb3bc934a3e391fa18a5081d7273d93a922c6083-d_640')

@section('next-thumb', 'https://i.vimeocdn.com/video/466686932-1de2b64a078a0c807f3423041290adb5bbed3b89f5dde67ef3a94b9080afbe21-d_640')

@section('assets')
    @include('lead-gen.partials._assignment-resources', [
        "title" => "PDF",
        "pdfURL" => "https://dzryyo1we6bm3.cloudfront.net/ultimate-toolbox/bdbc/the-heel-toe-technique.pdf",
    ])

    @include('lead-gen.partials._assignment-resources', [
        "title" => "MP3s",
        "zipURL" => "https://dzryyo1we6bm3.cloudfront.net/ultimate-toolbox/bdbc/the-heel-toe-technique.zip",
    ])
@stop
