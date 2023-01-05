@extends('guitareo._partials.global-layout')

@section('meta')
    <meta name="robots" content="noindex">
    <title>The Beginner Guitar Starter Kit by Nate Savage</title>
    <meta property="og:url" content="https://www.guitareo.com/starter-kit"/>
    <meta property="og:title" content="The Beginner Guitar Starter Kit by Nate Savage"/>
    <meta property="og:description" content="Get instant-access to over 50 step-by-step guitar lessons covering nine essential topics.  These exclusive video lessons are provided by Nate Savage of Guitareo.com."/>
    <meta property="og:image" content="https://guitarlessons-com-public.s3.amazonaws.com/images/guitar-toolbox-og.jpg"/>
@endsection

@section('styles')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/foundation/6.5.3/css/foundation-float.min.css">
    @include('_partials.layout._tailwindcdn')
    <link rel="stylesheet" href="{{ asset('/marketing/parcel/guitareo/lead-gen-lessons.css') }}">
    <link rel="stylesheet" href="{{ asset('/marketing/parcel/guitareo/nav-footer.css') }}">
@endsection

@section('content')
    @include('guitareo.sales.partials._nav')

    @yield('body-content')

    @include("guitareo.sales.partials._footer")
@endsection

@section('scripts')
    <script src="{{ asset('/marketing/parcel/drumeo/navigation-sales.js') }}"></script>
@endsection
