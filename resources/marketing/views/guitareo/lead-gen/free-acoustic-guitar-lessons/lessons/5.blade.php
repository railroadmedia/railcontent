@extends('guitareo.lead-gen.free-acoustic-guitar-lessons.lesson-page-layout')

@section('subtitle')
    Play a Song
@stop

@section('video', '//player.vimeo.com/video/531040914')

@section('current-lesson-number', 5)

@section('previous', '/free-acoustic-guitar-lessons/lessons/4')

@section('next', '/free-acoustic-guitar-lessons/lessons/6')

@section('prev-thumb', 'https://d122ay5chh2hr5.cloudfront.net/lead-gen/free-acoustic-guitar-lessons/thumbs-acoustic-04.jpg')

@section('next-thumb', 'https://d122ay5chh2hr5.cloudfront.net/lead-gen/free-acoustic-guitar-lessons/thumbs-acoustic-06.jpg')

@section('lesson-description', 'Now that we know a handful of chords, what do we do with them? You’ll learn how to put the chords together in a progression to play a song. We’ll recap on what your strumming hand will be doing during the song and play in time to the right beat of the backing track. We’ll switch different strumming patterns to play along with the backing track. ')

@section('assignments')
    @include('guitareo.lead-gen.partials._assignment-resources', [
        "title" => "Play along to the track with the first strumming pattern",
        "assignmentID" => "lesson_5_assignment_1"
    ])
    @include('guitareo.lead-gen.partials._assignment-resources', [
        "title" => "Play along to the track with the second strumming pattern",
        "assignmentID" => "lesson_5_assignment_2"
    ])
    @include('guitareo.lead-gen.partials._assignment-resources', [
        "title" => "Play along to the track with the bonus strumming pattern (OPTIONAL)",
        "assignmentID" => "lesson_5_assignment_3"
    ])
@stop
@section('assets')
    @parent

    @include('guitareo.lead-gen.partials._assignment-resources', [
        "title" => "Chord Charts",
        "pdfURL" => "https://d122ay5chh2hr5.cloudfront.net/lead-gen/free-acoustic-guitar-lessons/play-a-song.pdf"
    ])
    @include('guitareo.lead-gen.partials._assignment-resources', [
        "title" => "MP3",
        "mp3URL" => "https://d122ay5chh2hr5.cloudfront.net/lead-gen/free-acoustic-guitar-lessons/play-a-song.mp3"
    ])
@stop
