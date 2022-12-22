@extends('guitareo.lead-gen.toolbox.clean-chords.lesson')

@section('subtitle')
    Musical Application
@endsection

@section('video', 'https://player.vimeo.com/video/167285843')

@section('current-lesson-number', 2)

@section('previous', '/toolbox/lessons/making-chords-sound-clean/4')

@section('prev-thumb', 'https://i.vimeocdn.com/video/571585436-7f56a0936ae732e6997b639e7a453360dad62d8c5f795221863d689f04e7142e-d?mw=1100&mh=619')

@section('assets')
    @include('guitareo.lead-gen.partials._assignment-resources', [
        "title" => "Making Chords Sound Clean No Click - MP3",
        "mp3URL" => "https://guitarlessons-com.s3.amazonaws.com/guitar-lessons-resources/mp3s/making-chords-sound-clean-no-click.mp3"
    ])

    @include('guitareo.lead-gen.partials._assignment-resources', [
        "title" => "Making Chords Sound Clean Click - MP3",
        "mp3URL" => "https://guitarlessons-com.s3.amazonaws.com/guitar-lessons-resources/mp3s/making-chords-sound-clean-click.mp3"
    ])
@endsection
