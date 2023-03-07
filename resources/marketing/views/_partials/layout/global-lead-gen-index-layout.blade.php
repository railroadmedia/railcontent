@extends('_partials.layout.global-template')

@section('meta')
    <title>{{ $leadgen->title }}</title>
    <meta property="og:title" content="{{ $leadgen->title }}"/>
    <meta name="description" content="{{ $leadgen->meta_desc }}">
    <meta property="og:description" content="{{ $leadgen->meta_desc }}"/>
    <meta property="og:url" content="{{ get_legacy_brand_base_url($theme)}}/{{ Request::path() }}"/>
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
    @if($theme === 'drumeo' && !empty($leadgen->slug) && ($leadgen->slug === 'free-playalongs/songs' || $leadgen->slug === 'metal-playalongs/songs'))
        <a href="/choose-plan" class="edge-pitch block text-center w-full whitespace-nowrap py-2 sm:py-1 fixed mx-auto bg-black text-white z-[100]">
            <div class="container mx-auto">
                <div class="text-center sm:text-left inline-block align-middle hover:opacity-90 transition-opacity duration-300">
                    <img class="align-middle w-auto mr-2 h-6 hidden sm:inline-block" src="https://www.musora.com/musora-cdn/image/width=300,q_60,quality=85/https://dpwjbsxqtam5n.cloudfront.net/logos/logo-white.png">
                    <p class="inline-block align-middle mx-auto text-xs leading-tight">Get {{ Prices::$drumeoPlayAlongs }}+ more play-alongs + world-class drum  <br>
                        lessons inside Drumeo. Click for a FREE trial.</p>
                </div>
            </div>
        </a>
    @endif
    <div class="flex-1">
        <div class="relative py-12 md:py-24">
            <div class="absolute inset-0 z-10">
                <img
                    src="@if($theme === 'drumeo') https://d3fzm1tzeyr5n3.cloudfront.net/headers/drumeo-header.jpg @elseif($theme === 'pianote') https://d3fzm1tzeyr5n3.cloudfront.net/headers/pianote-header.jpg @elseif($theme === 'guitareo') https://d3fzm1tzeyr5n3.cloudfront.net/headers/guitareo-header.jpg @elseif($theme === 'singeo') https://d3fzm1tzeyr5n3.cloudfront.net/headers/singeo-header.jpg @endif"
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
            <div class="list-wrapper px-2 sm:px-4">
                <h3 class="font-black mb-4 md:mb-6 px-1">Course Lessons</h3>
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
