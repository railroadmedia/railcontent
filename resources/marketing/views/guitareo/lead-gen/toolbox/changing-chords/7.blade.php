@extends('guitareo.lead-gen.toolbox.changing-chords.lesson')

@section('subtitle')
    Musical Application
@endsection

@section('video', 'https://player.vimeo.com/video/167037188')

@section('current-lesson-number', 7)

@section('previous', '/toolbox/lessons/changing-chords-smoothly/6')

@section('prev-thumb', 'https://i.vimeocdn.com/video/571437697-d7fee13565686039492c607d16cc960019c795b46934079c42c5b10c6ac346e8-d?mw=1100&mh=619')

@section('assets')
    @include('guitareo.lead-gen.partials._assignment-resources', [
        "title" => "Changing Chords A To D No Click - MP3",
        "mp3URL" => "https://guitarlessons-com.s3.amazonaws.com/guitar-lessons-resources/mp3s/changing-chords-smoothly-a-d-no-click.mp3"
    ])

    @include('guitareo.lead-gen.partials._assignment-resources', [
        "title" => "Changing Chords A To D Click - MP3",
        "mp3URL" => "https://guitarlessons-com.s3.amazonaws.com/guitar-lessons-resources/mp3s/changing-chords-smoothly-a-d-click.mp3"
    ])

    @include('guitareo.lead-gen.partials._assignment-resources', [
        "title" => "Changing Chords G To C No Click - MP3",
        "mp3URL" => "https://guitarlessons-com.s3.amazonaws.com/guitar-lessons-resources/mp3s/changing-chords-smoothly-g-c-no-click.mp3"
    ])

    @include('guitareo.lead-gen.partials._assignment-resources', [
        "title" => "Changing Chords G To C Click - MP3",
        "mp3URL" => "https://guitarlessons-com.s3.amazonaws.com/guitar-lessons-resources/mp3s/changing-chords-smoothly-g-c-click.mp3"
    ])
@endsection
