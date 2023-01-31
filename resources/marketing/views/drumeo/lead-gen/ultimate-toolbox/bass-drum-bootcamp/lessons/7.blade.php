@extends('drumeo.lead-gen.ultimate-toolbox.bass-drum-bootcamp.lesson-page')

@section('title')
    Double Bass Drum Bootcamp
@stop

@section('video', '//player.vimeo.com/video/88231176')

@section('lesson-number', '7')

@section('previous')
    /ultimate-toolbox/bdbc/6
@stop

@section('prev-thumb', 'https://i.vimeocdn.com/video/460642069-7ec02f90f4f1aac27bfac4c189f22b6f7b677ae8a368e23477102b8016dc6526-d_640')

@section('assets')
    @include('drumeo.lead-gen.partials._assignment-resources', [
        "title" => "PDF",
        "pdfURL" => "https://dzryyo1we6bm3.cloudfront.net/ultimate-toolbox/bdbc/double-bass-drum-bootcamp.pdf",
    ])

    @include('drumeo.lead-gen.partials._assignment-resources', [
        "title" => "MP3s",
        "zipURL" => "https://dzryyo1we6bm3.cloudfront.net/ultimate-toolbox/bdbc/double-bass-drum-bootcamp.zip",
    ])

    @include('drumeo.lead-gen.partials._assignment-resources', [
        "title" => "80 BPM Play-Along",
        "mp3URL" => "https://dzryyo1we6bm3.cloudfront.net/ultimate-toolbox/bdbc/double-bass-drum-bootcamp-pa-80bpm.mp3",
    ])

    @include('drumeo.lead-gen.partials._assignment-resources', [
        "title" => "120 BPM Play-Along",
        "mp3URL" => "https://dzryyo1we6bm3.cloudfront.net/ultimate-toolbox/bdbc/double-bass-drum-bootcamp-pa-120bpm.mp3",
    ])

    @include('drumeo.lead-gen.partials._assignment-resources', [
        "title" => "160 BPM Play-Along",
        "mp3URL" => "https://dzryyo1we6bm3.cloudfront.net/ultimate-toolbox/bdbc/double-bass-drum-bootcamp-pa-160bpm.mp3",
    ])
@stop
