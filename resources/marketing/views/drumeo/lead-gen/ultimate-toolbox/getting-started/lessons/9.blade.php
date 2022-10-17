@extends('drumeo.lead-gen.ultimate-toolbox.getting-started.lesson-page')

@section('title')
    Lesson 9: Playing Your First Song
@stop

@section('video', '//player.vimeo.com/video/90068633')

@section('lesson-number', '9')

@section('previous')
    /ultimate-toolbox/gsotd/8
@stop

@section('next')
    /ultimate-toolbox/gsotd/10
@stop

@section('prev-thumb', 'https://i.vimeocdn.com/video/469065379-b1df7a24a11a3150f8ecb85f6db3f8fdd5d582223be3121de116b464590aab2e-d_640')

@section('next-thumb', 'https://i.vimeocdn.com/video/469066472-bc5480a2b6ba3652fc1c3c8ebc87096ddbabbe423cf22670c5ea3ab3f1933c27-d_640')

@section('assets')
    @include('lead-gen.partials._assignment-resources',[
        'title' => 'Resources',
        'zipURL' => 'https://dzryyo1we6bm3.cloudfront.net/gsotd/7-playing-your-first-fill.zip',
    ])
@stop
