@extends('guitareo.lead-gen.song-in-an-hour.lesson-page-layout', [
    'bonus' => true
])

@section('title')
    Next Steps
@stop

@section('video', '488587484')

@section('lesson-number', 'Bonus Lesson')

@section('previous')
    /song-in-an-hour/writing-a-melody
@stop

@section('next')
    /guitar-quest-discount
@stop

@section('next-text', 'GuitarQuest')

@section('prev-thumb', 'https://www.musora.com/musora-cdn/image/width=800,q_60,quality=85/https://d1923uyy6spedc.cloudfront.net/Guitar-Quest-1-8.png')

@section('assignments')
    @include('guitareo.lead-gen.song-in-an-hour._assignment-resources', [
        "title" => "Become comfortable with everything you learned in this challenge. ",
        "assignmentID" => "lesson_8_assignment_1"
    ])
    @include('guitareo.lead-gen.song-in-an-hour._assignment-resources', [
        "title" => "Join GuitarQuest (<a class='text-blue-500' href='/guitar-quest-discount'>Save 40% when you click this link.</a>)",
        "assignmentID" => "lesson_8_assignment_2"
    ])
@stop
