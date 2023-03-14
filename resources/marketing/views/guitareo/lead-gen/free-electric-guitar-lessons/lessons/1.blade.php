@extends('guitareo.lead-gen.free-electric-guitar-lessons.lesson-page-layout')

@section('subtitle')
    Electric 101
@stop

@section('video', '//player.vimeo.com/video/519278952')

@section('current-lesson-number', 1)

@section('next', '/free-electric-guitar-lessons/lessons/2')

@section('next-thumb', 'https://d122ay5chh2hr5.cloudfront.net/lead-gen/free-electric-guitar-lessons/thumbs-electric-02.jpg')

@section('lesson-description', 'Ayla goes over each part of the guitar that’s important to know and what its purpose is. She also goes over how to tune your guitar by using various different methods. Lastly, she explains the name of each string by using a fun trick to help you memorize their names.')

@section('assignments')
    @include('guitareo.lead-gen.partials._assignment-resources', [
        "title" => "Get comfortable with the guitar in your lap",
        "assignmentID" => "lesson_1_assignment_1"
    ])
    @include('guitareo.lead-gen.partials._assignment-resources', [
        "title" => "Tune your guitar",
        "assignmentID" => "lesson_1_assignment_2"
    ])
    @include('guitareo.lead-gen.partials._assignment-resources', [
        "title" => "Go through each string one by one and say their name out loud",
        "assignmentID" => "lesson_1_assignment_3"
    ])
@stop
