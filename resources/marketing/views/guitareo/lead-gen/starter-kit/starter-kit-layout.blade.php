@extends('guitareo._partials.layout')

@section('head-includes')
    <meta name="robots" content="noindex">
    <title>The Beginner Guitar Starter Kit by Nate Savage</title>
    <meta property="og:url" content="https://www.guitareo.com/starter-kit"/>
    <meta property="og:title" content="The Beginner Guitar Starter Kit by Nate Savage"/>
    <meta property="og:description" content="Get instant-access to over 50 step-by-step guitar lessons covering nine essential topics.  These exclusive video lessons are provided by Nate Savage of Guitareo.com."/>
    <meta property="og:image" content="https://guitarlessons-com-public.s3.amazonaws.com/images/guitar-toolbox-og.jpg"/>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/foundation/6.5.3/css/foundation-float.min.css">
    <link href="{{ asset('/tailwindcss/tailwind.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="/assets/marketing/lead-gen-lessons.css">
    <link rel="stylesheet" href="{{ asset('/assets/marketing/nav-footer.css') }}">
@endsection

@section('layout-body')
    @include('guitareo.sales.partials._nav')

    @yield('body-content')

    @include("guitareo.sales.partials._footer")
@endsection

@section('layout-scripts')
    <script src="/assets/marketing/nav-footer.js"></script>
@endsection