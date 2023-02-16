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
        <div class="relative py-12 md:py-24">
            <div class="absolute inset-0 z-10">
                <img
                    src="@if($theme === 'drumeo') https://musora-web-platform.s3.amazonaws.com/headers/drumeo-header.jpg @elseif($theme === 'pianote') https://musora-web-platform.s3.amazonaws.com/headers/pianote-header.jpg @elseif($theme === 'guitareo') https://musora-web-platform.s3.amazonaws.com/headers/guitareo-header.jpg @elseif($theme === 'singeo') https://musora-web-platform.s3.amazonaws.com/headers/singeo-header.jpg @endif"
                    class="h-full w-full object-top object-cover transition-opacity opacity-0"
                    alt="{{ $theme }} background"
                    loading="lazy"
                    onload="this.classList.remove('opacity-0')"
                />
            </div>
            <div class="absolute inset-0 z-20" style="background: @if($theme === 'drumeo')linear-gradient(180deg,rgba(0,0,0,.05) 55%,rgba(9,92,170,.7)); @elseif($theme === 'pianote') linear-gradient(180deg,rgba(0,0,0,.05) 55%,rgba(213,8,29,.7)); @elseif($theme === 'guitareo') linear-gradient(180deg,rgba(0,0,0,.05) 55%,rgba(0,150,128,.7)); @elseif($theme === 'singeo') linear-gradient(180deg,rgba(0,0,0,.05) 55%,rgba(102,0,182,.7)); @endif">
            </div>
            <div class="text-center">
                @if(!empty($leadgen->logo))
                    <img
                        class="transition-opacity opacity-0 h-16 md:h-24 lg:h-40 z-30 relative"
                        src="{{$leadgen->logo}}"
                        alt="leadgen logo"
                        loading="lazy"
                        onload="this.classList.remove('opacity-0')"
                    />
                @else
                    <h1 class="text-white z-30 relative font-bold">
                        {{ $leadgen->title }}
                    </h1>
                @endif
            </div>
        </div>
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
