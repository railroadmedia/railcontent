@extends('_partials.layout.global-template')

@section('meta')
    <title>{{ $leadgen->title }}</title>
    <meta property="og:title" content="{{ $leadgen->title }}"/>
    <meta name="description" content="{{ $leadgen->meta_desc }}">
    <meta property="og:description" content="{{ $leadgen->meta_desc }}"/>
    {{--    <meta property="og:url" content="https://www.drumeo.com/drum-fills/"/>--}}
    <meta property="og:image" content="{{ $leadgen->meta_img }}"/>
    <meta name="robots" content="noindex">
@stop

@section('layout-styles')
    <link href="{{ asset('/marketing/parcel/drumeo/navigation-sales.css') }}" rel="stylesheet">
    <link href="{{ asset('/marketing/parcel/drumeo/lead-gen-course.css') }}" rel="stylesheet">
    <link href="{{ asset('/marketing/css/global-styles.css') }}" rel="stylesheet">
@endsection

@section('layout-header')
    @include($theme.".sales.partials._nav")
@endsection

@section('layout-body')
    <div class="flex-1">
        <div class="lesson-catalogue max-w-5xl mx-auto py-7 md:py-12">
            <div class="list-wrapper px-4">
                <h3 class="font-bold mb-4 md:mb-6">Course Lessons</h3>
                @foreach($lessons as $key => $lesson)
                    @include('_partials.components.leadgen-lesson',[
                        'lessonURL' => $lesson->slug,
                        'lessonNumber' => $key + 1,
                        'lessonImg' => $lesson->thumbnail,
                        'lessonTitle' => $lesson->title,
                        'duration' => $lesson->duration
                    ])
                @endforeach
            </div>
        </div>
    </div>
@endsection

@section('layout-footer')
    @include($theme.".sales.partials._footer", [
            "minimal" => true
    ])
@endsection
