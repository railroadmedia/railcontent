@extends('guitareo.lead-gen.song-in-an-hour.lesson-page-layout')

@section('title')
    How To Hold The Guitar
@stop

@section('video', '488587305')

@section('lesson-number', 'Lesson 2 of 7')

@section('previous')
    /song-in-an-hour/your-challenge/1
@stop

@section('next')
    /song-in-an-hour/your-challenge/3
@stop

@section('prev-thumb', 'https://www.musora.com/musora-cdn/image/width=800,q_60,quality=95/https://d1923uyy6spedc.cloudfront.net/Guitar-Quest-1-1.png')

@section('next-thumb', 'https://www.musora.com/musora-cdn/image/width=800,q_60,quality=95/https://d1923uyy6spedc.cloudfront.net/Guitar-Quest-1-3.png')

@section('assignments')
    @include('guitareo.lead-gen.song-in-an-hour._assignment-resources', [
        "title" => "Become comfortable holding the guitar.",
        "subTitle" => "Use the tips in the lesson to properly hold your guitar without any strain.",
        "assignmentID" => "lesson_2_assignment_1"
    ])
@stop
