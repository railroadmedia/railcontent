@extends('drumeo.lead-gen.ultimate-toolbox.bass-drum-bootcamp.lesson-page')

@section('lesson-title')
    Single Bass Drum Bootcamp
@stop

@section('video', '//player.vimeo.com/video/83974109')

@section('lesson-number', '6')

@section('previous')
    /ultimate-toolbox/bdbc/5
@stop

@section('next')
    /ultimate-toolbox/bdbc/7
@stop

@section('prev-thumb', 'https://i.vimeocdn.com/video/468377892-aa6914b6db45909c1b9d7376ee57730c611cb0667e3d1b716bfb7d1be4eea510-d_640')

@section('next-thumb', 'https://i.vimeocdn.com/video/466608062-1fc2a1569c4a22326ecb0bc22d19b6848a0450f1b48a339e8f46dbc891eaf7e0-d_640')

@section('assets')
    @include('drumeo.lead-gen.partials._assignment-resources', [
        "title" => "PDF",
        "pdfURL" => "https://dzryyo1we6bm3.cloudfront.net/ultimate-toolbox/bdbc/single-bass-drum-bootcamp.pdf",
    ])

    @include('drumeo.lead-gen.partials._assignment-resources', [
        "title" => "MP3s",
        "zipURL" => "https://dzryyo1we6bm3.cloudfront.net/ultimate-toolbox/bdbc/single-bass-drum-bootcamp.zip",
    ])

    @include('drumeo.lead-gen.partials._assignment-resources', [
        "title" => "80 BPM Play-Along",
        "mp3URL" => "https://dzryyo1we6bm3.cloudfront.net/ultimate-toolbox/bdbc/single-bass-drum-bootcamp-pa-80bpm.mp3",
    ])

    @include('drumeo.lead-gen.partials._assignment-resources', [
        "title" => "120 BPM Play-Along",
        "mp3URL" => "https://dzryyo1we6bm3.cloudfront.net/ultimate-toolbox/bdbc/single-bass-drum-bootcamp-pa-120bpm.mp3",
    ])

    @include('drumeo.lead-gen.partials._assignment-resources', [
        "title" => "160 BPM Play-Along",
        "mp3URL" => "https://dzryyo1we6bm3.cloudfront.net/ultimate-toolbox/bdbc/single-bass-drum-bootcamp-pa-160bpm.mp3",
    ])
@stop
