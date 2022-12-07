@extends('guitareo.lead-gen.free-acoustic-guitar-lessons.lesson-page-layout')

@section('subtitle')
    Strumming Basics
@stop

@section('video', '//player.vimeo.com/video/531010974')

@section('current-lesson-number', 3)

@section('previous', '/free-acoustic-guitar-lessons/lessons/2')

@section('next', '/free-acoustic-guitar-lessons/lessons/4')

@section('prev-thumb', 'https://guitareo.s3.amazonaws.com/lead-gen/free-acoustic-guitar-lessons/thumbs-acoustic-02.jpg')

@section('next-thumb', 'https://guitareo.s3.amazonaws.com/lead-gen/free-acoustic-guitar-lessons/thumbs-acoustic-04.jpg')

@section('lesson-description', 'Learn the correct motion of your wrist to strum the guitar. You’ll go over downstrokes, upstrokes, and a bonus strumming pattern if you’re feeling up for it. ')

@section('assignments')
    @include('guitareo.lead-gen.partials._assignment-resources', [
        "title" => "Practice downstrokes",
        "assignmentID" => "lesson_3_assignment_1"
    ])
    @include('guitareo.lead-gen.partials._assignment-resources', [
        "title" => "Practice upstrokes",
        "assignmentID" => "lesson_3_assignment_2"
    ])
@stop
@section('assets')
    @parent

    @include('guitareo.lead-gen.partials._assignment-resources', [
        "title" => "Chord Charts",
        "pdfURL" => "https://guitareo.s3.amazonaws.com/lead-gen/free-acoustic-guitar-lessons/strumming-basics.pdf"
    ])

@stop
