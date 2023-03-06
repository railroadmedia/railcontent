@extends('guitareo.lead-gen.song-in-an-hour.lesson-page-layout')

@section('title')
    Strumming Fundamentals
@stop

@section('video', '488587370')

@section('lesson-number', 'Lesson 4 of 7')

@section('previous')
    /song-in-an-hour/your-challenge/3
@stop

@section('next')
    /song-in-an-hour/your-challenge/5
@stop

@section('prev-thumb', 'https://www.musora.com/musora-cdn/image/width=800,q_60,quality=85/https://d1923uyy6spedc.cloudfront.net/Guitar-Quest-1-3.png')

@section('next-thumb', 'https://www.musora.com/musora-cdn/image/width=800,q_60,quality=85/https://d1923uyy6spedc.cloudfront.net/Guitar-Quest-1-5.png')

@section('assignments')
    <p class="mb-2 sm:mb-3 bg-yellow px-2 inline-block rounded-md">Interactive sheet music is optional. <br class="hidden sm:inline lg:hidden"> To complete your challenge in one-hour, only practice-along with the video.</p>
    @include('guitareo.lead-gen.song-in-an-hour._assignment-resources', [
        "title" => "Become comfortable strumming all the strings!",
        "subTitle" => "Practice strumming all strings without any snags.",
        "assignmentID" => "lesson_4_assignment_1",
        "soundslice" => "WBjfc",
        "pdfURL" => "https://guitareo.s3.amazonaws.com/lead-gen/song-in-an-hour/4a.svg"
    ])
    @include('guitareo.lead-gen.song-in-an-hour._assignment-resources', [
        "title" => "Strum all the strings in time with the jam track.",
        "subTitle" => "Practice your strumming along with Rob using the video, the provided jam track, or the interactive tab.",
        "assignmentID" => "lesson_4_assignment_2",
        "soundslice" => "BBjfc",
        "pdfURL" => "https://guitareo.s3.amazonaws.com/lead-gen/song-in-an-hour/4b.svg"
    ])
    @include('guitareo.lead-gen.song-in-an-hour._assignment-resources', [
        "title" => "Strum the top four strings in time with the jam track.",
        "subTitle" => "Practice your 4 string strumming along with Rob using the video, the provided jam track, or the interactive tab.",
        "assignmentID" => "lesson_4_assignment_3",
        "soundslice" => "ZBjfc",
        "pdfURL" => "https://guitareo.s3.amazonaws.com/lead-gen/song-in-an-hour/4c.svg"
    ])
@stop
@section('assets')
    @include('guitareo.lead-gen.song-in-an-hour._assignment-resources', [
        "title" => "Sheet Music",
        "pdfURL" => "https://www.musora.com/musora-cdn/image/width=1760,q_60,quality=85/https://guitareo.s3.amazonaws.com/lead-gen/song-in-an-hour/4.png"
    ])
    @include('guitareo.lead-gen.song-in-an-hour._assignment-resources', [
        "title" => "4 Top Strings Jam",
        "mp3URL" => "https://d1923uyy6spedc.cloudfront.net/4 top strings jam - Full.mp3"
    ])
    @include('guitareo.lead-gen.song-in-an-hour._assignment-resources', [
        "title" => "All Strings Jam",
        "mp3URL" => "https://d1923uyy6spedc.cloudfront.net/All strings jam - full.mp3"
    ])
@stop
