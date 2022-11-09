@extends('guitareo.lead-gen.chords-for-hit-songs.lesson-page-layout')

@section('subtitle')
    Master G and Em guitar chords
@stop

@section('video', '//player.vimeo.com/video/768670165')

@section('current-lesson-number', 2)

@section('previous', '/chords-for-hit-songs/lessons/1')

@section('prev-thumb', 'https://i.vimeocdn.com/video/1540842009-552c59e720c8073bc3ebd61b5b314a1c2540ae1eb8e700eb69e308a85fff1a49-d?mw=1000&mh=563')

@section('next', '/chords-for-hit-songs/lessons/3')

@section('next-thumb', 'https://i.vimeocdn.com/video/1506332098-fd854496821e35a9d8be15a757df7ba8acda9180adb550b6fa35f8d299e88164-d?mw=1000&mh=563')

{{-- @section('lesson-description', 'Ayla goes over each part of the guitar that’s important to know and what its purpose is. She also goes over how to tune your guitar by using various different methods. Lastly, she explains the name of each string by using a fun trick to help you memorize their names.') --}}

@section('assignments')
    {{-- @include('guitareo.lead-gen.partials._assignment-resources', [
        "title" => "Get comfortable with the guitar in your lap",
        "assignmentID" => "lesson_1_assignment_1"
    ]) --}}

@stop
