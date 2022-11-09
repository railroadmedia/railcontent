@extends('guitareo.lead-gen.chords-for-hit-songs.lesson-page-layout')

@section('subtitle')
    Play these four chords altogether
@stop

@section('video', '//player.vimeo.com/video/754484207')

@section('current-lesson-number', 6)

@section('previous', '/chords-for-hit-songs/lessons/5')

@section('prev-thumb', 'https://guitareo.s3.amazonaws.com/lead-gen/free-electric-guitar-lessons/thumbs-electric-01.jpg')

{{-- @section('lesson-description', 'Ayla goes over each part of the guitar that’s important to know and what its purpose is. She also goes over how to tune your guitar by using various different methods. Lastly, she explains the name of each string by using a fun trick to help you memorize their names.') --}}

@section('assignments')
    {{-- @include('guitareo.lead-gen.partials._assignment-resources', [
        "title" => "Get comfortable with the guitar in your lap",
        "assignmentID" => "lesson_1_assignment_1"
    ]) --}}

@stop
