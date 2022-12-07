@extends('guitareo.lead-gen.song-in-an-hour.lesson-page-layout')

@section('title')
    Play Your First Song
@stop

@section('video', '489918226')

@section('lesson-number', 'Lesson 7 of 7')

@section('previous')
    /song-in-an-hour/your-challenge/6
@stop

@section('next')
    /song-in-an-hour/success
@stop

@section('next-text', 'Finish Challenge')

@section('prev-thumb', 'https://cdn.musora.com/image/fetch/w_800,q_60,q_auto:best/https://d1923uyy6spedc.cloudfront.net/Guitar-Quest-1-6.png')

@section('next-thumb', 'https://cdn.musora.com/image/fetch/w_800,q_60,q_auto:best/https://d1923uyy6spedc.cloudfront.net/Guitar-Quest-1-8.png')

@section('assignments')
    @include('guitareo.lead-gen.song-in-an-hour._assignment-resources', [
        "title" => "Play the show",
        "subTitle" => "Play the full song in time along with the provided band track MP3.",
        "assignmentID" => "lesson_7_assignment_1"
    ])

@stop
@section('assets')
    @include('guitareo.lead-gen.song-in-an-hour._assignment-resources', [
        "title" => "Two Chords",
        "mp3URL" => "https://d1923uyy6spedc.cloudfront.net/Two%20Chords%20Full%20Mix.mp3"
    ])
@stop
