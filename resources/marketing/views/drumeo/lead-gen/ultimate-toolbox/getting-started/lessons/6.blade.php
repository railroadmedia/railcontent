@extends('drumeo.lead-gen.ultimate-toolbox.getting-started.lesson-page')

@section('title')
    Your First Drum Beats
@stop

@section('video', '//player.vimeo.com/video/90056797')

@section('lesson-number', '6')

@section('previous')
    /ultimate-toolbox/gsotd/5
@stop

@section('next')
    /ultimate-toolbox/gsotd/7
@stop

@section('prev-thumb', 'https://i.vimeocdn.com/video/470777467-95f29a8b2d8d254c258715092af748a95cc20e933239e63dd10280948d0c1807-d_640')

@section('next-thumb', 'https://i.vimeocdn.com/video/469067095-0284183a7b530d903528db71ba826503cddfe27567da138ac67ff1e29f9f8e21-d_640')

@section('assets')
    @include('drumeo.lead-gen.partials._assignment-resources',[
        'title' => 'Resources',
        'zipURL' => 'https://dzryyo1we6bm3.cloudfront.net/gsotd/6-playing-your-first-beat.zip',
    ])
@stop
