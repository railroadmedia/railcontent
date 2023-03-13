@extends('drumeo.lead-gen.getting-started.lesson-page')

@section('title')
    Reading Drum Notation
@stop

@section('video', '//player.vimeo.com/video/90056795')

@section('lesson-number', '4')

@section('previous', '/getting-started/3-holding-your-drumsticks')

@section('next', '/getting-started/5-basic-counting')

@section('prev-thumb', 'https://i.vimeocdn.com/video/469051158-bcdcf0b70b3c56a5e418d027490b82f58ad935e92f87d6f1f76f204643783623-d?mw=1000&mh=563')

@section('next-thumb', 'https://i.vimeocdn.com/video/470777467-95f29a8b2d8d254c258715092af748a95cc20e933239e63dd10280948d0c1807-d?mw=1000&mh=563')

@section('assets')
    @parent

    @include('drumeo.lead-gen.partials._assignment-resources', [
        "title" => "Reading Drum Notation",
        "pdfURL" => "https://dpwjbsxqtam5n.cloudfront.net/lead-gen/getting-started/4-reading-drum-notation.jpg",
    ])
@stop
