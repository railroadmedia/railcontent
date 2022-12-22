@php
    require_once(resource_path('marketing/views/pianote/sales/pages/method/methods.php'))
@endphp

@extends('pianote.sales.pages.coaches-method-songs-layout')

@section('page-meta')

@endsection
<title>Pianote | </title>
<meta property="og:title" content="Pianote | ">
<meta property="og:url" content="https://www.pianote.com/method">
<meta name="description" content="">
<meta property="og:description" content="">
<meta property="og:image" content="" style="display: none;">


@section('header-img', 'https://pianote.s3.amazonaws.com/sales/2023/method-thumb.jpg')

@section('header', 'Your piano goals start here.')

@section('desc', 'Always know exactly what to practice with an organized 10-level curriculum.')

@section('body-data')
    x-data ='{
        trailer : false
    }'
@endsection

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
                    'lessonInfo' => $method['lessonInfo']
                ])
            @endforeach
        </div>
    </section>

{{--    @include('_partials.components.video-modal',[--}}
{{--        'name' => 'trailer',--}}
{{--        'video' => '772644658'--}}
{{--    ])--}}
@stop
