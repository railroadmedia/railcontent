@extends('lead-gen.chords-for-hit-songs.lesson-page-layout')

@section('subtitle')
    Link Em and C chords together
@stop

@section('video', '//player.vimeo.com/video/747766620')

@section('current-lesson-number', 3)

@section('previous', '/chords-for-hit-songs/lessons/2')

@section('prev-thumb', 'https://i.ytimg.com/vi_webp/loHMELy5o18/maxresdefault.webp')

@section('next', '/chords-for-hit-songs/lessons/4')

@section('next-thumb', 'https://i.vimeocdn.com/video/1506332274-205ed5d0c3036afcd11585649df1339a79706fd1f590ec9a5573dede5119f0e7-d?mw=1000&mh=563')

{{-- @section('lesson-description', 'Ayla goes over each part of the guitar that’s important to know and what its purpose is. She also goes over how to tune your guitar by using various different methods. Lastly, she explains the name of each string by using a fun trick to help you memorize their names.') --}}

@section('assignments')
    {{-- @include('lead-gen.partials._assignment-resources', [
        "title" => "Get comfortable with the guitar in your lap",
        "assignmentID" => "lesson_1_assignment_1"
    ]) --}}

@stop
