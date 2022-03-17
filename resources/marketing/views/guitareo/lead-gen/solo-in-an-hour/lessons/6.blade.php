@extends('guitareo.lead-gen.solo-in-an-hour.lesson-page-layout')

@php
    $title = 'What About Soloing In Other Keys?';
    $video = '//player.vimeo.com/video/551517736';
    $previous = '/solo-in-an-hour/lessons/5';
    $next = '/solo-in-an-hour/lessons/7';
    $resources = "
        In case you haven’t realized... not all music is in the same key.
        <br><br>
        But once you know how to solo in one key, you’ll know how to solo in any key. Ayla will show you how.
    ";
@endphp

@section('assignments')
    @include('guitareo.lead-gen.solo-in-an-hour._assignment-resources', [
        "title" => "Soloing in different keys",
        "subTitle" => "Apply everything you learned so far about soloing to these new keys.",
        "assignmentID" => "jamTrack",
        "soundslice" => "1HTDc",
    ])
@stop

@section('assets')
    @include('guitareo.lead-gen.solo-in-an-hour._assignment-resources', [
        "title" => "Jam Track - Key of C",
        "mp3URL" => "https://d1923uyy6spedc.cloudfront.net/303786-resource-1621453970.mp3"
    ])
    @include('guitareo.lead-gen.solo-in-an-hour._assignment-resources', [
        "title" => "Jam Track - Key of E",
        "mp3URL" => "https://d1923uyy6spedc.cloudfront.net/303787-resource-1621453625.mp3"
    ])
@stop