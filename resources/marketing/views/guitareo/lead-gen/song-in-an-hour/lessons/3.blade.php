@extends('guitareo.lead-gen.song-in-an-hour.lesson-page-layout')

@section('title')
    Setting Up Your Guitar
@stop

@section('video', '488587306')

@section('lesson-number', 'Lesson 3 of 7')

@section('previous')
    /song-in-an-hour/your-challenge/2
@stop

@section('next')
    /song-in-an-hour/your-challenge/4
@stop

@section('prev-thumb', 'https://cdn.musora.com/image/fetch/w_800,q_60,q_auto:best/https://d1923uyy6spedc.cloudfront.net/Guitar-Quest-1-2.png')

@section('next-thumb', 'https://cdn.musora.com/image/fetch/w_800,q_60,q_auto:best/https://d1923uyy6spedc.cloudfront.net/Guitar-Quest-1-4.png')

@section('assignments')
    @include('guitareo.lead-gen.song-in-an-hour._assignment-resources', [
        "title" => "Get your guitar in perfect tune.",
        "subTitle" => "Use a tuner, or the audio in the video, to tune your guitar. The notes for each string for standard tuning should be: EADGBE. The tuner Rob uses is called 'GuitarTuna' if you wanted to explore that tuning app.",
        "assignmentID" => "lesson_3_assignment_1"
    ])

@stop
