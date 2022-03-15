@extends('musora._partials.layout')

<!-- Main -->
@section('layout-body')

    <!-- Hero Component -->
    @component('_partials.components.hero-section', [
        "backgroundImage" => "https://musora-web-platform.s3.amazonaws.com/musora/homepage/musora-hero.jpg",
    ])
        @slot('content')
            <div class="text-center text-white">
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
        @endslot
    @endcomponent

@stop
