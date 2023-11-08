@extends('guitareo.lead-gen.starter-kit.partials._lesson-page-layout')

@section('styles')
    <link rel="stylesheet" href="{{ asset('/marketing/parcel/drumeo/lead-gen-lessons.css') }}">
@endsection

@section('lesson-total-number', 1)

@section('current-lesson-number', 1)

@section('subtitle')
    What's Next?
@endsection

@section('video', 'https://player.vimeo.com/video/253880980')


@section('lesson-description')
    <div class="container lg:mx-auto max-w-6xl mb-14 mt-10 flex flex-col lg:flex-row">
        <div class="px-3 md:px-4 w-full lg:w-1/2">
            <a href="/trial" target="_blank" class="download-button outline big">Learn More About Guitareo</a>
        </div>
        <div class="px-3 md:px-4 w-full lg:w-1/2">
            <a href="https://www.guitareo.com/ecommerce/add-to-cart?products[GUITAREO-7-DAY-TRIAL-ONE-TIME]=1&redirect=/order&locked=true" target="_blank" class="download-button big">
                Start A Free Guitareo Trial
            </a>
        </div>
    </div>
@endsection
