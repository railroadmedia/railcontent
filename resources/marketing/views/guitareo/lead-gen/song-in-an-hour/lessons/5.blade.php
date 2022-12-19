@extends('guitareo.lead-gen.song-in-an-hour.lesson-page-layout')

@section('title')
    Your First Chord
@stop

@section('video', '488587457')

@section('lesson-number', 'Lesson 5 of 7')

@section('previous')
    /song-in-an-hour/your-challenge/4
@stop

@section('next')
    /song-in-an-hour/your-challenge/6
@stop

@section('prev-thumb', 'https://cdn.musora.com/image/fetch/w_800,q_60,q_auto:best/https://d1923uyy6spedc.cloudfront.net/Guitar-Quest-1-4.png')

@section('next-thumb', 'https://cdn.musora.com/image/fetch/w_800,q_60,q_auto:best/https://d1923uyy6spedc.cloudfront.net/Guitar-Quest-1-6.png')

@section('assignments')
    <p class="tw-mb-2 sm:tw-mb-3 bg-yellow tw-px-2 tw-inline-block tw-rounded-md">Interactive sheet music is optional. <br class="tw-hidden sm:tw-inline lg:tw-hidden"> To complete your challenge in one-hour, only practice-along with the video.</p>
    @include('guitareo.lead-gen.song-in-an-hour._assignment-resources', [
        "title" => "Become comfortable strumming a G Chord.",
        "subTitle" => "Practice strumming a G Chord using the top 4 strings cleanly.",
        "assignmentID" => "lesson_5_assignment_1",
        "soundslice" => "PBjfc",
        "pdfURL" => "https://guitareo.s3.amazonaws.com/lead-gen/song-in-an-hour/5.svg"
    ])
@stop
