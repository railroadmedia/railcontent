@php
    require_once(resource_path('marketing/views/pianote/sales/pages/method/methods.php'))
@endphp

@extends('pianote.sales.pages.coaches-method-songs-layout')

@section('page-meta')
    <title>Pianote | Your piano goals start here.</title>
    <meta property="og:title" content="Pianote | Your piano goals start here.">
    <meta property="og:url" content="https://www.pianote.com/method">
    <meta name="description" content="Always know exactly what to practice with an organized 10-level curriculum.">
    <meta property="og:description" content="Always know exactly what to practice with an organized 10-level curriculum.">
    <meta property="og:image" content="https://pianote.s3.amazonaws.com/sales/2023/share-image-method.jpg" style="display: none;">
@endsection

@section('header-img', 'https://pianote.s3.amazonaws.com/sales/2023/method-thumb.jpg')

@section('header', 'Your piano goals start here.')

@section('desc', 'Always know exactly what to practice with an organized 10-level curriculum.')

@section('page-body')
    <section class="py-12 md:py-20">
        <div class="container mx-auto max-w-5xl px-6">
            <h3 class="font-extrabold text-center mb-10 leading-snug">Your clear path, frustration-free <br>guide to playing the piano.</h3>
            @foreach($methods as $key => $method)
                @include('_partials.components.question-dropdown', [
                    'num' => $key+1,
                    "title" => $method['title'],
                    "desc" => $method['desc'],
                    'detail' => $method['detail'],
                    'lessonInfo' => $method['lessonInfo'],
                    'open' => $key === 0 ? true : false
                ])
            @endforeach
        </div>
    </section>
@stop
