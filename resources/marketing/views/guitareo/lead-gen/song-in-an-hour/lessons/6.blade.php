@extends('guitareo.lead-gen.song-in-an-hour.lesson-page-layout')

@section('title')
    Practicing For The Show
@stop

@section('video', '488587431')

@section('lesson-number', 'Lesson 6 of 7')

@section('previous')
    /song-in-an-hour/your-challenge/5
@stop

@section('next')
    /song-in-an-hour/your-challenge/7
@stop

@section('prev-thumb', 'https://cdn.musora.com/image/fetch/w_800,q_60,q_auto:best/https://d1923uyy6spedc.cloudfront.net/Guitar-Quest-1-5.png')

@section('next-thumb', 'https://cdn.musora.com/image/fetch/w_800,q_60,q_auto:best/https://d1923uyy6spedc.cloudfront.net/Guitar-Quest-1-7.png')

@section('assignments')
    <p class="tw-mb-2 sm:tw-mb-3 bg-yellow tw-px-2 tw-inline-block tw-rounded-md">Interactive sheet music is optional. <br class="tw-hidden sm:tw-inline lg:tw-hidden"> To complete your challenge in one-hour, only practice-along with the video.</p>
    @include('guitareo.lead-gen.song-in-an-hour._assignment-resources', [
        "title" => "Practice both chords.",
        "subTitle" => "Practice going back and forth between both chords, sounding clean, without hurting your fingers.",
        "assignmentID" => "lesson_6_assignment_1",
        "soundslice" => "jBjfc",
        "pdfURL" => "https://guitareo.s3.amazonaws.com/lead-gen/song-in-an-hour/6a.svg"
    ])
    @include('guitareo.lead-gen.song-in-an-hour._assignment-resources', [
        "title" => "Practice both chords in time with the jam track.",
        "subTitle" => "Practice going back and forth between both chords IN TIME along with the drum track.",
        "assignmentID" => "lesson_6_assignment_2",
        "soundslice" => "zWSfc",
        "pdfURL" => "https://guitareo.s3.amazonaws.com/lead-gen/song-in-an-hour/6b.svg"
    ])
@stop
@section('assets')
    @include('guitareo.lead-gen.song-in-an-hour._assignment-resources', [
        "title" => "Sheet Music",
        "pdfURL" => "https://cdn.musora.com/image/fetch/w_1760,q_60,q_auto:best/https://guitareo.s3.amazonaws.com/lead-gen/song-in-an-hour/6.png"
    ])
    @include('guitareo.lead-gen.song-in-an-hour._assignment-resources', [
        "title" => "Practice Both Chords In Time",
        "mp3URL" => "https://d1923uyy6spedc.cloudfront.net/Practice%20Both%20Chords%20In%20Time%20-%20Full.mp3"
    ])
@stop