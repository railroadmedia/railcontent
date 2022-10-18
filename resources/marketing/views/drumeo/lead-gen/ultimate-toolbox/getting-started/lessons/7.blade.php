@extends('drumeo.lead-gen.ultimate-toolbox.getting-started.lesson-page')

@section('title')
    Your First Drum Fills
@stop

@section('video', '//player.vimeo.com/video/90068631')

@section('lesson-number', '7')

@section('previous')
    /ultimate-toolbox/gsotd/6
@stop

@section('next')
    /ultimate-toolbox/gsotd/8
@stop

@section('prev-thumb', 'https://i.vimeocdn.com/video/469052552-33deecae0570b09577411a972fa6f80334c930dd68b498e57f1509505b3b3f4b-d_640')

@section('next-thumb', 'https://i.vimeocdn.com/video/469065379-b1df7a24a11a3150f8ecb85f6db3f8fdd5d582223be3121de116b464590aab2e-d_640')

@section('assets')
    @include('lead-gen.partials._assignment-resources',[
        'title' => 'Resources',
        'zipURL' => 'https://dzryyo1we6bm3.cloudfront.net/gsotd/7-playing-your-first-fill.zip',
    ])
@stop
