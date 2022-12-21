@extends('guitareo.lead-gen.starter-kit.heartbreak.lesson')

@section('subtitle')
    Series Overview
@endsection

@section('video', 'https://player.vimeo.com/video/173407382')

@section('current-lesson-number', 1)

@section('next', '/starter-kit/lessons/heartbreak-avenue/2')

@section('next-thumb', 'https://i.vimeocdn.com/video/579726452-3957b8d94ea37643c56fd5306813c081d39ea1ce489a3da42fa62485d20d5296-d_1280x720?r=pad')

@section('assets')
    @parent

    @include('guitareo.lead-gen.partials._assignment-resources', [
        "title" => "Full Band Jam Track",
        "mp3URL" => "https://guitarskillaccelerator-com.s3.amazonaws.com/media/mp3/heartbreak-avenue-full-band.mp3"
    ])

    @include('guitareo.lead-gen.partials._assignment-resources', [
        "title" => "Tabs & Sheet Music",
        "pdfURL" => "https://guitarskillaccelerator-com.s3.amazonaws.com/media/pdf/heartbreak-avenue.pdf"
    ])
@endsection
