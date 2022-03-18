@extends('guitareo.lead-gen.free-acoustic-guitar-lessons.lesson-page-layout')

@section('title')
    Sounding Good
@stop

@section('video', '//player.vimeo.com/video/531010850')

@section('lesson-number', 'Lesson 2 of 6')

@section('previous', '/free-acoustic-guitar-lessons/lessons/1')

@section('next', '/free-acoustic-guitar-lessons/lessons/3')

@section('prev-thumb', 'https://guitareo.s3.amazonaws.com/lead-gen/free-acoustic-guitar-lessons/thumbs-acoustic-01.jpg')

@section('next-thumb', 'https://guitareo.s3.amazonaws.com/lead-gen/free-acoustic-guitar-lessons/thumbs-acoustic-03.jpg')

@section('description', 'In this lesson, you’ll learn your first chord, the E minor chord, and play each string one by one to make sure it sounds clean and clear. You’ll learn how to apply the right amount of pressure to the string to prevent string-buzz  without straining your hand. Then you’ll move onto your next chord, the C major7 chord, and practice playing each string. ')

@section('assignments')
    @include('guitareo.lead-gen.free-acoustic-guitar-lessons._assignment-resources', [
        "title" => "Go through each chord string by string",
        "assignmentID" => "lesson_2_assignment_1"
    ])
    @include('guitareo.lead-gen.free-acoustic-guitar-lessons._assignment-resources', [
        "title" => "Play each chord back to back",
        "assignmentID" => "lesson_2_assignment_2"
    ])
@stop
@section('assets')
    @include('guitareo.lead-gen.free-acoustic-guitar-lessons._assignment-resources', [
        "title" => "Chord Charts",
        "zipURL" => "https://guitareo.s3.amazonaws.com/lead-gen/free-acoustic-guitar-lessons/strumming-basics.pdf"
    ])

@stop