@extends('drumeo.lead-gen.ultimate-toolbox.getting-started.lesson-page')

@section('title')
    Basic Counting
@stop

@section('video', '//player.vimeo.com/video/91367890')

@section('lesson-number', '5')

@section('previous')
    /ultimate-toolbox/gsotd/4
@stop

@section('next')
    /ultimate-toolbox/gsotd/6
@stop

@section('prev-thumb', 'https://i.vimeocdn.com/video/469050062-930904bdcfd1f34a6b5d2a0264cfe3a81b7deac917bcf6b785e5dfe66460532a-d_640')

@section('next-thumb', 'https://i.vimeocdn.com/video/469052552-33deecae0570b09577411a972fa6f80334c930dd68b498e57f1509505b3b3f4b-d_640')

@section('assets')
    @include('drumeo.lead-gen.partials._assignment-resources',[
        'title' => 'PDF',
        'pdfURL' => 'https://dzryyo1we6bm3.cloudfront.net/gsotd/5-basic-counting.pdf',
    ])
@stop
