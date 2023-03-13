@extends('guitareo.lead-gen.song-in-an-hour.lesson-page-layout', [
    'bonus' => true
])

@section('title')
    Writing A Melody
@stop

@section('video', '488587514')

@section('lesson-number', 'Bonus Lesson')


@section('previous')
    /song-in-an-hour/your-challenge/7
@stop

@section('next')
    /song-in-an-hour/next-steps
@stop

@section('prev-thumb', 'https://www.musora.com/musora-cdn/image/width=800,q_60,quality=85/https://d1923uyy6spedc.cloudfront.net/Guitar-Quest-1-7.png')

@section('next-thumb', 'https://www.musora.com/musora-cdn/image/width=800,q_60,quality=85/https://d1923uyy6spedc.cloudfront.net/Guitar-Quest-1-9.png')

@section('assignments')
    @include('guitareo.lead-gen.song-in-an-hour._assignment-resources', [
        "title" => "Explore all the frets.",
        "subTitle" => "Explore the high E string and try this strum every fret on the high E. Be aware of how it sounds, are there any notes that are sour?",
        "assignmentID" => "lesson_9_assignment_1"
    ])
    @include('guitareo.lead-gen.song-in-an-hour._assignment-resources', [
        "title" => "Write your own melody.",
        "subTitle" => "Throw some spaghetti at the wall with combinations of these frets, and try to come up with a good sounding melody.",
        "assignmentID" => "lesson_9_assignment_2"
    ])
    @include('guitareo.lead-gen.song-in-an-hour._assignment-resources', [
        "title" => "Share your melody.",
        "subTitle" => "Record your melody and share the link!",
        "assignmentID" => "lesson_9_assignment_3"
    ])
@stop
