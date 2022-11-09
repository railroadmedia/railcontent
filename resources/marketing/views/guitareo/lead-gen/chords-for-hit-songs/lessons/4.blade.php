@extends('lead-gen.chords-for-hit-songs.lesson-page-layout')

@section('subtitle')
    Switch between chords C and D
@stop

@section('video', '//player.vimeo.com/video/748994985')

@section('current-lesson-number', 4)

@section('previous', '/chords-for-hit-songs/lessons/3')

@section('prev-thumb', 'https://i.vimeocdn.com/video/1506332098-fd854496821e35a9d8be15a757df7ba8acda9180adb550b6fa35f8d299e88164-d?mw=1000&mh=563')

@section('next', '/chords-for-hit-songs/lessons/5')

@section('next-thumb', 'https://i.vimeocdn.com/video/1511650271-4937cec726d4692df296826f8c4de1480d9910ac9c3f2bab4048d4f10adad867-d?mw=1000&mh=563')

{{-- @section('lesson-description', 'Ayla goes over each part of the guitar that’s important to know and what its purpose is. She also goes over how to tune your guitar by using various different methods. Lastly, she explains the name of each string by using a fun trick to help you memorize their names.') --}}

@section('assignments')
    {{-- @include('lead-gen.partials._assignment-resources', [
        "title" => "Get comfortable with the guitar in your lap",
        "assignmentID" => "lesson_1_assignment_1"
    ]) --}}

@stop
