@extends('drumeo.lead-gen.linear-drumming.lesson-page')

@section('title')
    Gospel Grooves​
@stop

@section('video', '//player.vimeo.com/video/158554374')

@section('lesson-number', '4')

@section('previous')
    /linear-drumming/3-rock-tom/
@endsection

@section('next')
    /linear-drumming/5-metal/
@stop

@section('prev-thumb', 'https://i.vimeocdn.com/video/560727218-21ae1bae198ad6c555b15363f351ba618f2846e2efbdf98a2480cba5ed7648e7-d_640')

@section('next-thumb', 'https://i.vimeocdn.com/video/560727679-c21a30b3084fcaf2a799dbd465d526ed48cdfba97e436f6a209f8bc332e30ca6-d_640')

@section('assets')
    @include('drumeo.lead-gen.partials._assignment-resources', [
        "title" => "Gospel Grooves​​",
        "pdfURL" => "https://dzryyo1we6bm3.cloudfront.net/cooperdrummer/04-gospel-grooves.pdf",
    ])
@stop
