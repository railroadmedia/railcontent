@extends('guitareo.lead-gen.starter-kit.starter-kit-layout')

@section('head-includes')
    <title>What's Next?</title>
@endsection

@section('body-content')
    @include('guitareo.lead-gen.starter-kit.partials._header')

    @section('title')
        What's Next?
    @endsection

    @section('video')
        <iframe src="https://player.vimeo.com/video/253880980" frameborder="0" allowfullscreen></iframe>
    @endsection

    @include('guitareo.lead-gen.partials.lesson-page1')

    <div class="container lg:mx-auto max-w-6xl mb-14 -mt-10 flex flex-col lg:flex-row">
        <div class="px-3 md:px-4 w-full lg:w-1/2">
            <a href="/trial" target="_blank" class="download-button outline big">Learn More About Guitareo</a>
        </div>
        <div class="px-3 md:px-4 w-full lg:w-1/2">
            <a href="{{ url()->route('shopping-cart.add-to-cart', [
                'products' => ['GUITAREO-7-DAY-TRIAL-ONE-TIME' => 1],
                'redirect' => '/order', 'locked' => 'true'
            ]) }}" target="_blank" class="download-button big">
                Start A Free Guitareo Trial
            </a>
        </div>
    </div>
@endsection