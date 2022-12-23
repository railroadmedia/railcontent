@extends('guitareo.lead-gen.toolbox.exploring-rhythms.lesson')

@section('subtitle')
    Musical Application
@endsection

@section('video', 'https://player.vimeo.com/video/179472228')

@section('current-lesson-number', 5)

@section('previous', '/toolbox/lessons/exploring-guitar-rhythms/4')

@section('prev-thumb', 'https://i.vimeocdn.com/video/587460114-787126431e0e99a3bc61d5818287119e9a12dc17f28ce98c8bdc291f38bb8731-d?mw=1100&mh=619')

@section('assets')
    @include('guitareo.lead-gen.partials._assignment-resources', [
        "title" => "Reading Rhythm Examples 1-10 - PNG",
        "imgURL" => "https://guitarlessons-com.s3.amazonaws.com/guitar-lessons-resources/graphics/reading-rhythms-1/reading-rhythms-1-10.png"
    ])

    @include('guitareo.lead-gen.partials._assignment-resources', [
        "title" => "Whole & Half Note Song No Click - MP3",
        "mp3URL" => "https://guitarlessons-com.s3.amazonaws.com/guitar-lessons-resources/mp3s/whole-and-half-note-song-no-click.mp3"
    ])

    @include('guitareo.lead-gen.partials._assignment-resources', [
        "title" => "Whole & Half Note Song Click - MP3",
        "mp3URL" => "https://guitarlessons-com.s3.amazonaws.com/guitar-lessons-resources/mp3s/whole-and-half-note-song-click.mp3"
    ])
@endsection
