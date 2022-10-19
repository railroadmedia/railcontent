@extends('drumeo.lead-gen.linear-drumming.lesson-page')

@section('title')
    Dance Pop Grooves​
@stop

@section('video', '//player.vimeo.com/video/158554566')

@section('lesson-number', '2')

@section('previous')
    /linear-drumming/1-about/
@endsection

@section('next')
    /linear-drumming/3-rock-tom/
@stop

@section('prev-thumb', 'https://i.vimeocdn.com/video/560726784-7f2c75c0dbb17e9ae0fceb339df0fd6b681c626b3401fd46d7c9b06dadae617d-d_640')

@section('next-thumb', 'https://i.vimeocdn.com/video/560727218-21ae1bae198ad6c555b15363f351ba618f2846e2efbdf98a2480cba5ed7648e7-d_640')

@section('assets')
    @include('drumeo.lead-gen.partials._assignment-resources', [
        "title" => "Dance Pop Grooves​",
        "pdfURL" => "https://dzryyo1we6bm3.cloudfront.net/cooperdrummer/02-dance-pop-grooves.pdf",
    ])
@stop
