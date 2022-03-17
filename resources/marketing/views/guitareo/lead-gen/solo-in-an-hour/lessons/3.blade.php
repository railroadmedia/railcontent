@extends('guitareo.lead-gen.solo-in-an-hour.lesson-page-layout')

@php
    $title = 'What Makes A Good Solo?';
    $video = '//player.vimeo.com/video/551517661';
    $previous = '/solo-in-an-hour/lessons/2';
    $next = '/solo-in-an-hour/lessons/4';
    $resources = "
        Now that you’ve got the most important scale for soloing in your back pocket, it’s time to ask the serious question - what makes a good solo?
        <br><br>
        In this lesson, we’re going to dive into some classic guitar solos and uncover the secrets of what makes them so great.
    ";
@endphp

@section('assignments')
    @include('guitareo.lead-gen.solo-in-an-hour._assignment-resources', [
        "title" => "Explore with the minor pentatonic",
        "subTitle" => "Play the minor pentatonic scale over the jam track and see what happens when you try to play different melodies over it.",
        "assignmentID" => "exercise1",
        "soundslice" => "zwTDc",
    ])
@stop

@section('assets')
    @include('guitareo.lead-gen.solo-in-an-hour._assignment-resources', [
        "title" => "Jam Track",
        "mp3URL" => "https://d1923uyy6spedc.cloudfront.net/303786-resource-1621453970.mp3"
    ])
@stop