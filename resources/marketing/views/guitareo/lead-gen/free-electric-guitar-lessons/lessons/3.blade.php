@extends('guitareo.lead-gen.free-electric-guitar-lessons.lesson-page-layout')

@section('title')
    Strumming Basics
@stop

@section('video', '//player.vimeo.com/video/519279207')

@section('lesson-number', 'Lesson 3 of 6')

@section('previous', '/free-electric-guitar-lessons/lessons/2')

@section('next', '/free-electric-guitar-lessons/lessons/4')

@section('prev-thumb', 'https://guitareo.s3.amazonaws.com/lead-gen/free-electric-guitar-lessons/thumbs-electric-02.jpg')

@section('next-thumb', 'https://guitareo.s3.amazonaws.com/lead-gen/free-electric-guitar-lessons/thumbs-electric-04.jpg')

@section('description', 'Learn the correct motion of your wrist to strum the guitar. You’ll go over downstrokes in a whole note and quarter note pattern and then add in upstrokes. Play another new chord shape, the A Minor chord.')

@section('assignments')
    @include('guitareo.lead-gen.free-electric-guitar-lessons._assignment-resources', [
        "title" => "Practice downstrokes",
        "assignmentID" => "lesson_3_assignment_1"
    ])
    @include('guitareo.lead-gen.free-electric-guitar-lessons._assignment-resources', [
        "title" => "Practice upstrokes",
        "assignmentID" => "lesson_3_assignment_2"
    ])
@stop
@section('assets')
    @include('guitareo.lead-gen.free-electric-guitar-lessons._assignment-resources', [
        "title" => "MP3",
        "mp3URL" => "https://guitareo.s3.amazonaws.com/lead-gen/free-electric-guitar-lessons/strumming-basics.mp3"
    ])

@stop