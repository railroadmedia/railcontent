@php
    require_once(resource_path('marketing/views/drumeo/sales/pages/method/lessons.php'))
@endphp

@extends('drumeo.sales.pages.coaches-method-songs-layout')

@section('page-meta')

@endsection
<title>Drumeo | Reach your drumming goals.</title>
<meta property="og:title" content="Drumeo | Reach your drumming goals.">
<meta property="og:url" content="https://www.drumeo.com/method">
<meta name="description" content="Learn the drums faster with organized video lessons, legendary teachers, and better practice tools. 90-Day Guarantee.">
<meta property="og:description" content="Learn the drums faster with organized video lessons, legendary teachers, and better practice tools. 90-Day Guarantee.">
<meta property="og:image" content="https://dpwjbsxqtam5n.cloudfront.net/sales/2022/og-image.jpg" style="display: none;">


@section('header-img', 'https://drumeo-assets.s3.amazonaws.com/sales/2023/method-header.jpg')

@section('header', 'Always know exactly what to practice.')

@section('desc', '10 perfectly organized levels with video lessons from the top authorities on every topic.')

@section('body-data')
    x-data ='{
    trailer : false
    }'
@endsection

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
                    'lessons' => $lesson['lessons']
                ])
            @endforeach
        </div>
    </section>

{{--    @include('_partials.components.video-modal',[--}}
{{--        'name' => 'trailer',--}}
{{--        'video' => '772644658'--}}
{{--    ])--}}
@stop
