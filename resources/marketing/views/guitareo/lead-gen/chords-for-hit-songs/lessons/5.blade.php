@extends('guitareo.lead-gen.chords-for-hit-songs.lesson-page-layout')

@section('subtitle')
    Nail down the D and G chord transition
@stop

@section('video', '//player.vimeo.com/video/751835669')

@section('current-lesson-number', 5)

@section('previous', '/chords-for-hit-songs/lessons/4')

@section('prev-thumb', 'https://i.vimeocdn.com/video/1506332274-205ed5d0c3036afcd11585649df1339a79706fd1f590ec9a5573dede5119f0e7-d?mw=1000&mh=563')

@section('next', '/chords-for-hit-songs/lessons/6')

@section('next-thumb', 'https://i.vimeocdn.com/video/1516159925-b4d1b05c63f5463ea705031b8881abe2ffd3c88aac94274096f325678d7f2ae2-d?mw=1000&mh=563')

{{-- @section('lesson-description', 'Ayla goes over each part of the guitar that’s important to know and what its purpose is. She also goes over how to tune your guitar by using various different methods. Lastly, she explains the name of each string by using a fun trick to help you memorize their names.') --}}

@section('assignments')
    {{-- @include('guitareo.lead-gen.partials._assignment-resources', [
        "title" => "Get comfortable with the guitar in your lap",
        "assignmentID" => "lesson_1_assignment_1"
    ]) --}}

@stop
