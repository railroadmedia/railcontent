@php
    require_once(resource_path('marketing/views/drumeo/sales/pages/method/lessons.php'))
@endphp

@extends('drumeo.sales.pages.coaches-method-songs-layout')

@section('page-meta')
    <title>Drumeo | Always know exactly what to practice.</title>
    <meta property="og:title" content="Drumeo | Always know exactly what to practice.">
    <meta property="og:url" content="https://www.drumeo.com/method">
    <meta name="description" content="10 perfectly organized levels with video lessons from the top authorities on every topic.">
    <meta property="og:description" content="10 perfectly organized levels with video lessons from the top authorities on every topic.">
    <meta property="og:image" content="https://drumeo-assets.s3.amazonaws.com/sales/2023/method/share-image-method.jpg" style="display: none;">
@endsection

@section('header-img', 'https://drumeo-assets.s3.amazonaws.com/sales/2023/method-header.jpg')

@section('header', 'Always know exactly what to practice.')

@section('desc', '10 perfectly organized levels with video lessons from the top authorities on every topic.')

@section('page-body')
    <section class="py-12 md:py-20">
        <div class="container mx-auto max-w-5xl px-6">
            <h3 class="font-extrabold text-center mb-10 leading-snug">Your clear path, frustration-free <br>guide to playing the drums.</h3>
            @foreach($lessons as $key => $lesson)
                @include('_partials.components.question-dropdown', [
                    'num' => $key+1,
                    "title" => $lesson['title'],
                    "desc" => $lesson['desc'],
                    'detail' => $lesson['detail'],
                    'lessonInfo' => $lesson['lessonInfo'],
                    'open' => $key === 0 ? true : false
                ])
            @endforeach
        </div>
    </section>
@stop
