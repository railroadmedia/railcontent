@extends('lead-gen.chords-for-hit-songs.lesson-page-layout')

@section('subtitle')
    Meet your instructor Ayla
@stop

@section('video', '//player.vimeo.com/video/767472595')

@section('current-lesson-number', 1)

@section('next', '/chords-for-hit-songs/lessons/2')

@section('next-thumb', 'https://i.ytimg.com/vi_webp/loHMELy5o18/maxresdefault.webp')

{{-- @section('lesson-description', 'Ayla goes over each part of the guitar that’s important to know and what its purpose is. She also goes over how to tune your guitar by using various different methods. Lastly, she explains the name of each string by using a fun trick to help you memorize their names.') --}}

@section('assignments')
    {{-- @include('lead-gen.partials._assignment-resources', [
        "title" => "Get comfortable with the guitar in your lap",
        "assignmentID" => "lesson_1_assignment_1"
    ]) --}}

@stop
