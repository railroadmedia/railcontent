@extends('drumeo.lead-gen.linear-drumming.lesson-page')

@section('title')
    Metal Fills​
@stop

@section('video', '//player.vimeo.com/video/158554402')

@section('lesson-number', '5')

@section('previous')
    /linear-drumming/4-gospel/
@endsection

@section('prev-thumb', 'https://i.vimeocdn.com/video/560727540-477b10caa006c5bd1c67b666ca5ff8408b56e302acfdeffc32513f649aa716bb-d_640')

@section('assets')
    @include('drumeo.lead-gen.partials._assignment-resources', [
        "title" => "Metal Fills​",
        "pdfURL" => "https://dzryyo1we6bm3.cloudfront.net/cooperdrummer/05-metal-fills.pdf",
    ])
@stop
