@extends('guitareo.lead-gen.free-electric-guitar-lessons.lesson-page-layout')

@section('subtitle')
    Start Making Music
@stop

@section('video', '//player.vimeo.com/video/519279301')

@section('current-lesson-number', 4)

@section('previous', '/free-electric-guitar-lessons/lessons/3')

@section('next', '/free-electric-guitar-lessons/lessons/5')

@section('prev-thumb', 'https://guitareo.s3.amazonaws.com/lead-gen/free-electric-guitar-lessons/thumbs-electric-03.jpg')

@section('next-thumb', 'https://guitareo.s3.amazonaws.com/lead-gen/free-electric-guitar-lessons/thumbs-electric-05.jpg')

@section('lesson-description', 'Now it’s time to learn four new chords: the G Major special chord, C Major special, D Major chord, and G power chord. You’ll learn how the chords can be played together in a chord progression and how to create your own chord progression with these chords.')

@section('assignments')
    @include('guitareo.lead-gen.partials._assignment-resources', [
        "title" => "Play through each chord comfortably",
        "assignmentID" => "lesson_1_assignment_1"
    ])
    @include('guitareo.lead-gen.partials._assignment-resources', [
        "title" => "Use these chords to play a chord progression",
        "assignmentID" => "lesson_1_assignment_2"
    ])
    @include('guitareo.lead-gen.partials._assignment-resources', [
        "title" => "Create your OWN progression",
        "assignmentID" => "lesson_1_assignment_3"
    ])
@stop
