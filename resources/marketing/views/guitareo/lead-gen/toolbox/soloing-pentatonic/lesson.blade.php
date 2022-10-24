@extends('guitareo.lead-gen.starter-kit.partials._lesson-page-layout')

@section('lesson-total-number', 8)

@section('assets')
    @include('guitareo.lead-gen.partials._assignment-resources', [
        "title" => "Soloing With Pentatonic Scales Examples",
        "pdfURL" => "https://guitarlessons-com.s3.amazonaws.com/guitar-lessons-resources/pdfs/minor-pentatonic-scales-1-examples.pdf"
    ])
@endsection
