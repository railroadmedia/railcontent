@php
    require_once(resource_path('marketing/views/guitareo/sales/features/methods.php'));
    require_once(resource_path('marketing/views/guitareo/_partials/homepage-data.php'));
@endphp

@extends('guitareo.sales.features.features-layout')

@section('page-meta')
    <title>Guitareo | Your guitar goals start here.</title>
    <meta property="og:title" content="Guitareo | Your guitar goals start here.">
    <meta property="og:url" content="https://www.guitareo.com/method">
    <meta name="description" content="Always know exactly what to practice with an organized 10-level curriculum.">
    <meta property="og:description" content="Always know exactly what to practice with an organized 10-level curriculum.">
    <meta property="og:image" content="https://d122ay5chh2hr5.cloudfront.net/sales/2023/share-image-method.jpg" style="display: none;">
@endsection

@section('header-img', 'https://d122ay5chh2hr5.cloudfront.net/sales/2023/method-thumb.jpg')

@section('header', 'Your guitar goals start here.')

@section('desc')
    Have you always wanted to learn how to play guitar but don’t know where to start?<br>
    <strong>Get step-by-step lessons that will take you from your first strum to playing your favorite songs.</strong>
@endsection

@section('page-body')
    <section class="py-10 sm:py-14 lg:py-20 relative overflow-hidden text-center px-3 lg:px-5">
        <div class="container mx-auto max-w-5xl px-6">
            <h3 class="font-extrabold max-w-4xl mb-3 leading-snug">Your clear path, frustration-free guide to learning to play the guitar like you always imagined!</h3>
            <p class="max-w-2xl leading-tight mb-10">Our comprehensive 10-level curriculum is designed to transform you from a total beginner into a proficient guitarist. Each lesson guides you through essential skills, tips, and tricks that will help you play confidently and fall in love with the process.</p>
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
        $testimonials = $guitareo['testimonials'];
        $youtube = number_format(Prices::$guitareoYoutubeSubsc);
        $facebook = number_format(Prices::$guitareoFacebookLikes);
        $instagram = number_format(Prices::$guitareoInstagramFollowers);
    @endphp

    @include('musora.sales.components.testimonials-section', [
        'header' => 'guitarists',
        'youtubeLink' => 'https://www.youtube.com/guitarlessonscom/',
        'facebookLink' => 'https://facebook.com/guitareoofficial/',
        'instagramLink' => 'https://instagram.com/guitareoofficial/',
    ])
@stop
