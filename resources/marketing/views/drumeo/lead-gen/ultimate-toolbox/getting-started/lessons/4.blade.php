@extends('drumeo.lead-gen.ultimate-toolbox.getting-started.lesson-page')

@section('title')
    Reading Drum Notation
@stop

@section('video', '//player.vimeo.com/video/90056795')

@section('lesson-number', '4')

@section('previous')
    /ultimate-toolbox/gsotd/3
@stop

@section('next')
    /ultimate-toolbox/gsotd/5
@stop

@section('prev-thumb', 'https://i.vimeocdn.com/video/469051158-bcdcf0b70b3c56a5e418d027490b82f58ad935e92f87d6f1f76f204643783623-d_640')

@section('next-thumb', 'https://i.vimeocdn.com/video/470777467-95f29a8b2d8d254c258715092af748a95cc20e933239e63dd10280948d0c1807-d_640')

@section('assets')
    @include('lead-gen.partials._assignment-resources',[
        'title' => 'PDF',
        'pdfURL' => 'https://dzryyo1we6bm3.cloudfront.net/gsotd/4-reading-drum-notation.pdf',
    ])
@stop
