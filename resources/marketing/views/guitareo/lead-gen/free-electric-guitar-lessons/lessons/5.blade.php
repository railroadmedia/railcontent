@extends('guitareo.lead-gen.free-electric-guitar-lessons.lesson-page-layout')

@section('title')
    Play a Song
@stop

@section('video', '//player.vimeo.com/video/531040914')

@section('lesson-number', 'Lesson 5 of 6')

@section('previous', '/free-electric-guitar-lessons/lessons/4')

@section('next', '/free-electric-guitar-lessons/lessons/6')

@section('prev-thumb', 'https://guitareo.s3.amazonaws.com/lead-gen/free-electric-guitar-lessons/thumbs-electric-04.jpg')

@section('next-thumb', 'https://guitareo.s3.amazonaws.com/lead-gen/free-electric-guitar-lessons/thumbs-electric-06.jpg')

@section('description', 'It’s the moment you’ve been waiting for! Put together everything you’ve learned to play “Aint No Sunshine.” You’ll be playing two chords for two bars each as well as an easy lead guitar line.')

@section('assignments')
    @include('guitareo.lead-gen.free-electric-guitar-lessons._assignment-resources', [
        "title" => "Download the track and play along",
        "assignmentID" => "lesson_1_assignment_1"
    ])
@stop
@section('assets')
    @include('guitareo.lead-gen.free-electric-guitar-lessons._assignment-resources', [
        "title" => "Mp3",
        "mp3URL" => "https://guitareo.s3.amazonaws.com/lead-gen/free-electric-guitar-lessons/play-along-no-guitar.mp3"
    ])
    @include('guitareo.lead-gen.free-electric-guitar-lessons._assignment-resources', [
        "title" => "MP3",
        "mp3URL" => "https://guitareo.s3.amazonaws.com/lead-gen/free-electric-guitar-lessons/play-along-with-guitar.mp3"
    ])
@stop