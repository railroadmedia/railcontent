@extends('guitareo.lead-gen.song-in-an-hour.lesson-page-layout')

@section('title')
    Introduction
@stop

@section('video', '489918210')

@section('lesson-number', 'Lesson 1 of 7')

@section('next')
    /song-in-an-hour/your-challenge/2
@stop

@section('next-thumb', 'https://cdn.musora.com/image/fetch/w_800,q_60,q_auto:best/https://d1923uyy6spedc.cloudfront.net/Guitar-Quest-1-2.png')

@section('assignments')
    @include('guitareo.lead-gen.song-in-an-hour._assignment-resources', [
        "title" => "Mark as complete to start the Song In An Hour Challenge.",
        "assignmentID" => "lesson_1_assignment_1"
    ])
@stop
