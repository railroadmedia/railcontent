@extends('guitareo._partials.layout')

@section('head-includes')
    @parent

    <meta name="robots" content="noindex">
    <title>@yield('title') | Getting Started On The Eletric Guitar</title>
    <meta property="og:title" content="@yield('title') | Getting Started On The Eletric Guitar">

    <meta name="description" content="Pick up your guitar and start playing today!"/>
    <meta property="og:description" content="Pick up your guitar and start playing today!">

    <meta property="og:image" content="https://guitareo.s3.amazonaws.com/lead-gen/free-electric-guitar-lessons/og-image.jpg">
    <meta property="og:url" content="https://www.guitareo.com/free-electric-guitar-lessons/">

    <link rel="stylesheet" href="/assets/marketing/song-in-an-hour.css">
@stop

@section('layout-scripts')
    @parent

    <script type="text/javascript">
        $(document).ready(function (e) {
            $(document).foundation();

            $('.assignment-row .fa-angle-down').click(function() {
                $(this).parent().parent().toggleClass('active');
            });
        });
    </script>
    <script src="/assets/js/modal-autoplay.js"></script>
@stop

@section('layout-body')
    @php
        $img = '<img class="mx-auto inline-block h-10 sm:h-20" src="https://cdn.musora.com/image/fetch/w_448,q_auto:best/https://guitareo.s3.amazonaws.com/lead-gen/free-electric-guitar-lessons/electric-logo.png">';
        
        $themeColor = 'yellow';

        $allLessons = '/free-electric-guitar-lessons/lessons';
    @endphp

    @include('guitareo.lead-gen.partials._lesson-page-layout2')
@stop