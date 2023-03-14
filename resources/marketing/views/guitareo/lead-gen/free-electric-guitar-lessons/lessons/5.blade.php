@extends('guitareo.lead-gen.free-electric-guitar-lessons.lesson-page-layout')

@section('subtitle')
    Play a Song
@stop

@section('video', '//player.vimeo.com/video/531040914')

@section('current-lesson-number', 5)

@section('previous', '/free-electric-guitar-lessons/lessons/4')

@section('next', '/free-electric-guitar-lessons/lessons/6')

@section('prev-thumb', 'https://d122ay5chh2hr5.cloudfront.net/lead-gen/free-electric-guitar-lessons/thumbs-electric-04.jpg')

@section('next-thumb', 'https://d122ay5chh2hr5.cloudfront.net/lead-gen/free-electric-guitar-lessons/thumbs-electric-06.jpg')

@section('lesson-description', 'It’s the moment you’ve been waiting for! Put together everything you’ve learned to play “Aint No Sunshine.” You’ll be playing two chords for two bars each as well as an easy lead guitar line.')

@section('assignments')
    @include('guitareo.lead-gen.partials._assignment-resources', [
        "title" => "Download the track and play along",
        "assignmentID" => "lesson_1_assignment_1"
    ])
@stop
@section('assets')
    @parent

    @include('guitareo.lead-gen.partials._assignment-resources', [
        "title" => "Mp3",
        "mp3URL" => "https://d122ay5chh2hr5.cloudfront.net/lead-gen/free-electric-guitar-lessons/play-along-no-guitar.mp3"
    ])
    @include('guitareo.lead-gen.partials._assignment-resources', [
        "title" => "MP3",
        "mp3URL" => "https://d122ay5chh2hr5.cloudfront.net/lead-gen/free-electric-guitar-lessons/play-along-with-guitar.mp3"
    ])
@stop
