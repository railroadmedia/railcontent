@extends('singeo.lead-gen.improve-any-voice.lesson-page-layout')

@section('subtitle')
    Outro
@stop

@section('video', '//player.vimeo.com/video/543823720')

@section('current-lesson-number', 7)

@section('previous')
    /improve-any-voice/lessons/6
@stop

@section('prev-thumb', 'https://www.musora.com/musora-cdn/image/width=800,q_60,quality=85/https://singeo.s3.amazonaws.com/lead-gen/4-exercises/thumb-6.png')

@section('assignments')
    @include('singeo.lead-gen.partials._assignment-resources', [
        "title" => "Practice both chords.",
        "subTitle" => "Practice going back and forth between both chords, sounding clean, without hurting your fingers.",
        "assignmentID" => "lesson_6_assignment_1",
        "soundslice" => "jBjfc",
        "pdfURL" => "https://guitareo.s3.amazonaws.com/lead-gen/song-in-an-hour/6a.svg"
    ])
    @include('singeo.lead-gen.partials._assignment-resources', [
        "title" => "Practice both chords in time with the jam track.",
        "subTitle" => "Practice going back and forth between both chords IN TIME along with the drum track.",
        "assignmentID" => "lesson_6_assignment_2",
        "soundslice" => "zWSfc",
        "pdfURL" => "https://guitareo.s3.amazonaws.com/lead-gen/song-in-an-hour/6b.svg"
    ])
@stop
@section('assets')
    @parent

    @include('singeo.lead-gen.partials._assignment-resources', [
        "title" => "Sheet Music",
        "pdfURL" => "https://www.musora.com/musora-cdn/image/width=1760,q_60,quality=85/https://guitareo.s3.amazonaws.com/lead-gen/song-in-an-hour/6.png"
    ])
    @include('singeo.lead-gen.partials._assignment-resources', [
        "title" => "Practice Both Chords In Time",
        "mp3URL" => "https://d1923uyy6spedc.cloudfront.net/Practice%20Both%20Chords%20In%20Time%20-%20Full.mp3"
    ])
@stop
