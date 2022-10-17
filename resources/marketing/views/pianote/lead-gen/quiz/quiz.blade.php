@extends('pianote._partials.global-layout')

@section('global-head')
    <title>You're almost there | Pianote</title>
    <meta property="og:title" content="You're almost there | Pianote">

    <meta name="description" content="Please enter your email address to get your personality result. ">
    <meta property="og:description" content="Please enter your email address to get your personality result. ">

    <meta property="og:image" content="https://pianote.s3.amazonaws.com/lead-gen/quiz/bg.jpg" style="display: none;">
    <meta property="og:url" content="https://www.pianote.com/{{ Request::path() }}">

    <!-- Tailwind -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.19/tailwind.min.css">
    <link href="{{ asset('/marketing/parcel/pianote/tailwind-helpers.css') }}" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('/marketing/parcel/pianote/nav-footer.css') }}">
    <link href="/marketing/parcel/pianote/lead-gen-learn-songs.css" rel="stylesheet">
    <style>

    </style>
@stop

@section('global-body')
    @include('pianote.sales.nav', [
        "joinVersion" => true
    ])

    <section class="py-5 sm:py-12 bg-center bg-cover bg-no-repeat" style="background-color:#1c0203;background-image:url('https://cdn.musora.com/image/fetch/w_1500,q_auto:best/https://pianote.s3.amazonaws.com/lead-gen/quiz/bg.jpg')">
        <div class="container max-w-6xl mx-auto text-center text-white px-6 lg:px-0">
            <div class="typeform-widget" data-url="https://form.typeform.com/to/VgZGeh8j?typeform-medium=embed-snippet" style="width: 100%; height: 900px;"></div> <script> (function() { var qs,js,q,s,d=document, gi=d.getElementById, ce=d.createElement, gt=d.getElementsByTagName, id="typef_orm", b="https://embed.typeform.com/"; if(!gi.call(d,id)) { js=ce.call(d,"script"); js.id=id; js.src=b+"embed.js"; q=gt.call(d,"script")[0]; q.parentNode.insertBefore(js,q) } })() </script>
        </div>
    </section>

    @include('pianote.sales.footer')

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script type="text/javascript" src="/marketing/parcel/pianote/nav-footer.js"></script>
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/lazysizes/5.3.2/lazysizes.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/lazysizes/5.3.2/plugins/unveilhooks/ls.unveilhooks.min.js"></script>
@endsection

