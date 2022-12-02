@extends('guitareo.lead-gen.starter-kit.heartbreak.lesson')

@section('subtitle')
    Strumming Patterns
@endsection

@section('video', 'https://player.vimeo.com/video/173407384')

@section('current-lesson-number', 3)

@section('previous', '/starter-kit/lessons/heartbreak-avenue/2')

@section('next', '/starter-kit/lessons/heartbreak-avenue/4')

@section('prev-thumb', 'https://i.vimeocdn.com/video/579726452-3957b8d94ea37643c56fd5306813c081d39ea1ce489a3da42fa62485d20d5296-d_1280x720?r=pad')

@section('next-thumb', 'https://i.vimeocdn.com/video/579718599-099c8d821bbd6f38cb7aa55f7b3c50ea2e990489f903a6821a2e7653f6049f1d-d?mw=1100&mh=619')

@section('assets')
    @parent

    @include('guitareo.lead-gen.partials._assignment-resources', [
        "title" => "The Chords PNG",
        "imgURL" => "https://guitarskillaccelerator-com.s3.amazonaws.com/media/images/heartbreak-chords.png"
    ])
@endsection
