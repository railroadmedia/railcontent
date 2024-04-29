@php
    require_once(resource_path('marketing/views/singeo/sales/features/methods.php'));
    require_once(resource_path('marketing/views/singeo/_partials/homepage-data.php'));
@endphp

@extends('singeo.sales.features.features-layout')

@section('page-meta')
    <title>Singeo | Your singing goals start here. </title>
    <meta property="og:title" content="Singeo | Your singing goals start here. ">
    <meta property="og:url" content="https://www.singeo.com/method">
    <meta name="description" content="Step-by-step lessons to understand your voice, strengthen it, and sing with confidence!">
    <meta property="og:description" content="Step-by-step lessons to understand your voice, strengthen it, and sing with confidence!">
    <meta property="og:image" content="https://d21xeg6s76swyd.cloudfront.net/sales/2023/share-image-method.jpg" style="display: none;">
@endsection

@section('header-img', 'https://d21xeg6s76swyd.cloudfront.net/sales/2023/method-thumb.jpg')

@section('header', 'Your singing goals start here.')

@section('desc')
    Have you always wanted to learn how to sing but don’t know where to start?<br>
    <strong>Get step-by-step lessons that will take you from shower singer to star performer.</strong>
@endsection

@section('page-body')
    <section class="py-10 sm:py-14 lg:py-20 relative overflow-hidden text-center px-3 lg:px-5">
        <div class="container mx-auto max-w-5xl px-6">
            <h3 class="font-extrabold max-w-2xl mb-3 leading-snug">Your clear path, frustration-free guide to learning to sing like you always imagined!</h3>
            <p class="max-w-2xl leading-tight mb-10">Our 10-level curriculum is designed to elevate you from a total beginner to a performer. Each lesson is crafted to build your confidence, improve your range, find your true natural voice, and teach you to sing like you’ve always wanted to.</p>
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

    @php
        $testimonials = $singeo['testimonials'];
        $youtube = convertNumber(Prices::$singeoYoutubeSubsc);
        $facebook = convertNumber(Prices::$singeoFacebookLikes);
        $instagram = convertNumber(Prices::$singeoInstagramFollowers);
    @endphp
    @include('musora.sales.components.testimonials-section', [
        'header' => 'singers',
        'youtubeLink' => 'https://www.youtube.com/singeoofficial/',
        'facebookLink' => 'https://facebook.com/singeoofficial/',
        'instagramLink' => 'https://instagram.com/singeoofficial/',
    ])
@stop
