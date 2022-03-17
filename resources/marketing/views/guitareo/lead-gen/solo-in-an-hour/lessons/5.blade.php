@extends('guitareo.lead-gen.solo-in-an-hour.lesson-page-layout')

@php
    $title = 'Playing Your First Solo';
    $video = '//player.vimeo.com/video/551517718';
    $previous = '/solo-in-an-hour/lessons/4';
    $next = '/solo-in-an-hour/lessons/6';
    $resources = "
        It’s time to take the fragments of licks that you’ve learned and tie them all together to create your very first solo!
        <br><br>
        This is what we’ve been working towards, and here we are. All in less than an hour!
    ";
@endphp

@section('assignments')
    @include('guitareo.lead-gen.solo-in-an-hour._assignment-resources', [
        "title" => "Getting some inspiration",
        "subTitle" => "Take everything you learned so far and practice soloing over the jam track.",
        "assignmentID" => "jamTrack",
        "soundslice" => "zwTDc",
    ])
@stop

@section('assets')
    @include('guitareo.lead-gen.solo-in-an-hour._assignment-resources', [
        "title" => "Jam Track",
        "mp3URL" => "https://d1923uyy6spedc.cloudfront.net/303786-resource-1621453970.mp3"
    ])
@stop