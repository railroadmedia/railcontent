@extends('guitareo.lead-gen.starter-kit.partials._lesson-page-layout')

@section('lesson-total-number', 8)

@section('assets')
    @include('guitareo.lead-gen.partials._assignment-resources', [
        "title" => "Legato Hammer Ons &amp; Pull Offs Examples",
        "pdfURL" => "https://guitarlessons-com.s3.amazonaws.com/guitar-lessons-resources/pdfs/legato-technique-1-examples.pdf"
    ])
@endsection
