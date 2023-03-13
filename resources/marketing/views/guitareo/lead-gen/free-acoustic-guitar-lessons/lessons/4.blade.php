@extends('guitareo.lead-gen.free-acoustic-guitar-lessons.lesson-page-layout')

@section('subtitle')
    Start Making Music
@stop

@section('video', '//player.vimeo.com/video/531011075')

@section('current-lesson-number', 4)

@section('previous', '/free-acoustic-guitar-lessons/lessons/3')

@section('next', '/free-acoustic-guitar-lessons/lessons/5')

@section('prev-thumb', 'https://d122ay5chh2hr5.cloudfront.net/lead-gen/free-acoustic-guitar-lessons/thumbs-acoustic-03.jpg')

@section('next-thumb', 'https://d122ay5chh2hr5.cloudfront.net/lead-gen/free-acoustic-guitar-lessons/thumbs-acoustic-05.jpg')

@section('lesson-description', 'Ayla teaches you how to play five more essential chords every guitar player should know. You’ll learn a simplified and full version of each chord. The chords are C major, Dsus2, D major, G major, full G major. Once you have these chords under your belt, you can play hundreds and hundreds of your favorite songs. ')

@section('assignments')
    @include('guitareo.lead-gen.partials._assignment-resources', [
        "title" => "Play each chord shape one at a time",
        "assignmentID" => "lesson_4_assignment_1"
    ])
    @include('guitareo.lead-gen.partials._assignment-resources', [
        "title" => "Get comfortable switching chords",
        "assignmentID" => "lesson_4_assignment_2"
    ])
    @include('guitareo.lead-gen.partials._assignment-resources', [
        "title" => "Learn the simplified chords then learn the full chords",
        "assignmentID" => "lesson_4_assignment_3"
    ])
@stop
@section('assets')
    @parent

    @include('guitareo.lead-gen.partials._assignment-resources', [
        "title" => "Chord Charts",
        "pdfURL" => "https://d122ay5chh2hr5.cloudfront.net/lead-gen/free-acoustic-guitar-lessons/strumming-basics.pdf"
    ])

@stop
