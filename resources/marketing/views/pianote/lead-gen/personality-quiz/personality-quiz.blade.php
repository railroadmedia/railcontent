@extends('pianote._partials.global-layout')

@section('global-head')
    <title>What's your piano personality? | Pianote</title>
    <meta property="og:title" content="What's your piano personality? | Pianote">

    <meta name="description" content="Pick the best answer to these 10 questions and discover which of our piano personalities fits you!">
    <meta property="og:description" content="Pick the best answer to these 10 questions and discover which of our piano personalities fits you!">

    <meta property="og:image" content="https://d2vyvo0tyx8ig5.cloudfront.net/lead-gen/quiz/bg.jpg" style="display: none;">
    <meta property="og:url" content="https://www.pianote.com/{{ Request::path() }}">

    <!-- Tailwind -->
    @include('_partials.layout._tailwindcdn')
    <link href="{{ asset('/marketing/css/tailwind-helpers.css') }}" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('/marketing/parcel/drumeo/nav-footer-pianote.css') }}">
    <link href="{{ asset('/marketing/parcel/drumeo/lead-gen-learn-songs.css') }}" rel="stylesheet">
    <style>

    </style>
@stop

@section('global-body')
    @include('pianote.sales.partials._nav')

    <section class="py-3 sm:py-5 bg-center bg-cover bg-no-repeat" style="background-color:#1c0203;background-image:url('https://www.musora.com/musora-cdn/image/width=1500,quality=95/https://d2vyvo0tyx8ig5.cloudfront.net/lead-gen/quiz/bg.jpg')">
        <div class="container mx-auto text-center text-white">
            <div class="typeform-widget" data-url="https://form.typeform.com/to/VgZGeh8j?typeform-medium=embed-snippet" style="width: 100%; height: 90vh;"></div> <script> (function() { var qs,js,q,s,d=document, gi=d.getElementById, ce=d.createElement, gt=d.getElementsByTagName, id="typef_orm", b="https://embed.typeform.com/"; if(!gi.call(d,id)) { js=ce.call(d,"script"); js.id=id; js.src=b+"embed.js"; q=gt.call(d,"script")[0]; q.parentNode.insertBefore(js,q) } })() </script>
        </div>
    </section>

    @include("pianote.sales.partials._footer", [
            "minimal" => true
        ])

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script type="text/javascript" src="{{ asset('/marketing/parcel/drumeo/navigation-sales.js') }}"></script>
    <script src="{{ asset('/marketing/js/app.js') }}"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/lazysizes/5.3.2/lazysizes.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/lazysizes/5.3.2/plugins/unveilhooks/ls.unveilhooks.min.js"></script>
@endsection

