@extends('_partials.layout.public-layout')

@section('head-includes')
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Open+Sans:wght@400;600;700;800&display=swap" rel="stylesheet">
    <!-- Icons -->
    <script src="https://kit.fontawesome.com/cf2f4c6c71.js" crossorigin="anonymous"></script>
    <link href="https://d1prhhmg8i11jr.cloudfront.net/v1.0.3/dist/icons.css" rel="stylesheet">
@stop

<!-- Header -->
@section('layout-header')
    @include('_partials.layout.public-header', [
        "brand" => "musora",
        "logo" => "https://musora-ui.s3.amazonaws.com/logos/musora-white.svg"
    ])
@stop

<!-- Main -->
@section('layout-body')
    
    <!-- Components -->
    <section class="py-40 md:py-64 lg:py-72 text-white text-center bg-center bg-cover" 
             style="background-color:#1a1e58;background-image:url(https://musora-center.s3.amazonaws.com/homepage/2021/header.jpg);">
        <div class="container mx-auto relative z-0">
            <h1 class="text-3xl md:text-4xl lg:text-5xl"><strong>Musicians start here.</strong></h1>
            <p class="mt-4 mb-7">We make it easier to play the songs you love by combining great teachers, organized<br class="hidden md:inline">
                lessons, and practical technology with student-centered communities.</p>
            <div class="flex items-center justify-center">
                <a href="https://www.drumeo.com/" target="_blank"><img class="h-5 md:h-7 mx-1 md:mx-3 mb-2" data-cfsrc="https://cdn.musora.com/image/fetch/w_200,q_auto:best/https://dpwjbsxqtam5n.cloudfront.net/logos/logo-blue.png" src="https://cdn.musora.com/image/fetch/w_200,q_auto:best/https://dpwjbsxqtam5n.cloudfront.net/logos/logo-blue.png"></a>
                <a href="https://www.pianote.com/" target="_blank"><img class="h-5 md:h-7 mx-1 md:mx-3" data-cfsrc="https://cdn.musora.com/image/fetch/w_200,q_auto:best/https://pianote.s3.amazonaws.com/logo/pianote-logo-red.png" src="https://cdn.musora.com/image/fetch/w_200,q_auto:best/https://pianote.s3.amazonaws.com/logo/pianote-logo-red.png"></a>
                <a href="https://www.guitareo.com/" target="_blank"><img class="h-5 md:h-7 mx-1 md:mx-3" data-cfsrc="https://cdn.musora.com/image/fetch/w_200,q_auto:best/https://guitareo.s3.amazonaws.com/sales/guitareo-logo-green.png" src="https://cdn.musora.com/image/fetch/w_200,q_auto:best/https://guitareo.s3.amazonaws.com/sales/guitareo-logo-green.png"></a>
                <a href="https://www.singeo.com/" target="_blank"><img class="h-5 md:h-7 mx-1 md:mx-3" data-cfsrc="https://cdn.musora.com/image/fetch/w_200,q_auto:best/https://singeo.s3.amazonaws.com/sales/2021/singeo-logo.png" src="https://cdn.musora.com/image/fetch/w_200,q_auto:best/https://singeo.s3.amazonaws.com/sales/2021/singeo-logo.png"></a>
            </div>
        </div>
    </section>

@stop

<!-- Footer -->
@section('layout-footer')
    @include('_partials.layout.public-footer', [
        "brand" => "musora",
        "logo" => "https://musora-ui.s3.amazonaws.com/logos/musora-white.svg",
    ])
@stop