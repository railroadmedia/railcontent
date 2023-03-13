@extends('guitareo.lead-gen.free-electric-guitar-lessons.lesson-page-layout')

@section('subtitle')
    Sounding Good
@stop

@section('video', '//player.vimeo.com/video/519279105')

@section('current-lesson-number', 2)

@section('previous', '/free-electric-guitar-lessons/lessons/1')

@section('next', '/free-electric-guitar-lessons/lessons/3')

@section('prev-thumb', 'https://d122ay5chh2hr5.cloudfront.net/lead-gen/free-electric-guitar-lessons/thumbs-electric-01.jpg')

@section('next-thumb', 'https://d122ay5chh2hr5.cloudfront.net/lead-gen/free-electric-guitar-lessons/thumbs-electric-03.jpg')

@section('lesson-description', 'Plug in your guitar and start exploring the tone of your guitar through the different knobs and switches. Ayla explains how finding your tone can come from playing around with your guitar and amplifier settings to find what you like the most. You’ll also play your first chord, E Minor.')

@section('assignments')
    @include('guitareo.lead-gen.partials._assignment-resources', [
        "title" => "Spend time exploring your guitar",
        "assignmentID" => "lesson_2_assignment_1"
    ])
    @include('guitareo.lead-gen.partials._assignment-resources', [
        "title" => "Play the E minor chord cleanly",
        "assignmentID" => "lesson_2_assignment_2"
    ])
    @include('guitareo.lead-gen.partials._assignment-resources', [
        "title" => "Play the E minor chord one string at a time",
        "assignmentID" => "lesson_2_assignment_3"
    ])
@stop
