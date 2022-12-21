@extends('drumeo.lead-gen.getting-started.lesson-page')

@section('title')
    Playing Your First Song
@stop

@section('video', '//player.vimeo.com/video/90068633')

@section('lesson-number', '9')

@section('previous', '/getting-started/8-using-a-metronome')

@section('next', '/getting-started/10-practice-routine')

@section('prev-thumb', 'https://i.vimeocdn.com/video/469065379-b1df7a24a11a3150f8ecb85f6db3f8fdd5d582223be3121de116b464590aab2e-d?mw=1000&mh=563')

@section('next-thumb', 'https://i.vimeocdn.com/video/469066472-bc5480a2b6ba3652fc1c3c8ebc87096ddbabbe423cf22670c5ea3ab3f1933c27-d?mw=1000&mh=563')

@section('assets')
    @parent

    @include('drumeo.lead-gen.partials._assignment-resources', [
        "title" => "Playing Your First Song",
        "zipURL" => "https://dzryyo1we6bm3.cloudfront.net/gsotd/9-playing-your-first-song.zip",
    ])
@stop
