@php
    require_once(resource_path('marketing/views/singeo/sales/features/methods.php'))
@endphp

@extends('singeo.sales.features.features-layout')

@section('page-meta')
    <title>Singeo | Your singing goals start here. </title>
    <meta property="og:title" content="Singeo | Your singing goals start here. ">
    <meta property="og:url" content="https://www.singeo.com/method">
    <meta name="description" content="Step-by-step lessons to understand your voice, strengthen it, and sing with confidence!">
    <meta property="og:description" content="Step-by-step lessons to understand your voice, strengthen it, and sing with confidence!">
    <meta property="og:image" content="https://singeo.s3.amazonaws.com/sales/2023/share-image-method.jpg" style="display: none;">
@endsection

@section('header-img', 'https://singeo.s3.amazonaws.com/sales/2023/method-thumb.jpg')

@section('header', 'Your singing goals start here.')

@section('desc', 'Step-by-step lessons to understand your voice, strengthen it, and sing with confidence!')

@section('page-body')
    <section class="py-12 md:py-20">
        <div class="container mx-auto max-w-5xl px-6">
            <h3 class="font-extrabold text-center mb-10 leading-snug">Your clear path to <br>singing like you’ve always wanted.</h3>
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
