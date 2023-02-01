@extends('drumeo.lead-gen.ultimate-toolbox.bass-drum-bootcamp.lesson-page')

@section('title')
    The Constant-Release Technique
@stop

@section('video', '//player.vimeo.com/video/123788412')

@section('lesson-number', '4')

@section('previous')
    /ultimate-toolbox/bdbc/3
@stop

@section('next')
    /ultimate-toolbox/bdbc/5
@stop

@section('prev-thumb', 'https://i.vimeocdn.com/video/466686932-1de2b64a078a0c807f3423041290adb5bbed3b89f5dde67ef3a94b9080afbe21-d_640')

@section('next-thumb', 'https://i.vimeocdn.com/video/468377892-aa6914b6db45909c1b9d7376ee57730c611cb0667e3d1b716bfb7d1be4eea510-d_640')

@section('assets')
    @include('drumeo.lead-gen.partials._assignment-resources', [
        "title" => "PDF",
        "pdfURL" => "https://dzryyo1we6bm3.cloudfront.net/ultimate-toolbox/bdbc/the-constant-release-technique.pdf",
    ])

    @include('drumeo.lead-gen.partials._assignment-resources', [
        "title" => "MP3s",
        "zipURL" => "https://dzryyo1we6bm3.cloudfront.net/ultimate-toolbox/bdbc/the-constant-release-technique.zip",
    ])
@stop
