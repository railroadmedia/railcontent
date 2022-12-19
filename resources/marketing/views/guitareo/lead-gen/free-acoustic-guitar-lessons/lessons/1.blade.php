@extends('guitareo.lead-gen.free-acoustic-guitar-lessons.lesson-page-layout')

@section('subtitle')
    Becoming Familiar With Your Acoustic Guitar
@stop

@section('video', '//player.vimeo.com/video/531010732')

@section('current-lesson-number', 1)

@section('next', '/free-acoustic-guitar-lessons/lessons/2')

@section('next-thumb', 'https://guitareo.s3.amazonaws.com/lead-gen/free-acoustic-guitar-lessons/thumbs-acoustic-02.jpg')

@section('lesson-description', 'Ayla goes over each part of the guitar that’s important to know and what its purpose is. She’ll go over how to tune your guitar by using various different methods. Lastly, she explains the name of each string by using a fun trick to help you memorize their names. ')

@section('assignments')
    @include('guitareo.lead-gen.partials._assignment-resources', [
        "title" => "Hold your guitar comfortably",
        "assignmentID" => "lesson_1_assignment_1"
    ])
    @include('guitareo.lead-gen.partials._assignment-resources', [
        "title" => "Tune your guitar",
        "assignmentID" => "lesson_1_assignment_2"
    ])
    @include('guitareo.lead-gen.partials._assignment-resources', [
        "title" => "Memorize the strings",
        "assignmentID" => "lesson_1_assignment_3"
    ])
@stop
