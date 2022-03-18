@extends('guitareo.lead-gen.solo-in-an-hour.lesson-page-layout')

@php
    $title = 'The Most Important Scale For Soloing';
    $video = '//player.vimeo.com/video/551517629';
    $previous = '/solo-in-an-hour/lessons/1';
    $next = '/solo-in-an-hour/lessons/3';
    $resources = "
        In this lesson, Ayla’s going to show you the most important scale for learning how to solo.
        <br><br>
        With even just a few of these notes, you’ll see how quickly it is to solo over all types of different music.
    ";
@endphp

@section('assignments')
    @include('guitareo.lead-gen.solo-in-an-hour._assignment-resources', [
        "title" => "Practice With A Jam Track",
        "subTitle" => "Use Soundslice to work on the exercises from this lesson in a musical setting.",
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