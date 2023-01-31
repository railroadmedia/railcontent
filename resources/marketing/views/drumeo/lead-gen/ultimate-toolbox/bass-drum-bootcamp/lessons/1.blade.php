@extends('drumeo.lead-gen.ultimate-toolbox.bass-drum-bootcamp.lesson-page')

@section('title')
    The Slide Technique
@stop

@section('video', '//player.vimeo.com/video/89463440')

@section('lesson-number', '1')

@section('next')
    /ultimate-toolbox/bdbc/2/
@stop

@section('next-thumb', 'https://i.vimeocdn.com/video/466887795-041cbe3b0281e34f89d71e308ab681f62eacf14b61d16c63eedb7e544a282df0-d_640')

@section('assets')
    @include('drumeo.lead-gen.partials._assignment-resources', [
        "title" => "PDF",
        "pdfURL" => "https://dzryyo1we6bm3.cloudfront.net/ultimate-toolbox/bdbc/the-slide-technique.pdf",
    ])

    @include('drumeo.lead-gen.partials._assignment-resources', [
        "title" => "MP3s",
        "zipURL" => "https://dzryyo1we6bm3.cloudfront.net/ultimate-toolbox/bdbc/the-slide-technique.zip",
    ])
@stop
