@extends('drumeo.lead-gen.partials.lesson-page-layout')

@section('meta')
    <meta name="robots" content="noindex">
    <title>@yield('title') | Drumeo</title>
    <meta name="description" content="The ultimate toolbox to jump start your drumming! Sign up for these free resources to expand your drumming education today.">

    <!-- Social Media -->
    <meta property="og:image" content="https://dpwjbsxqtam5n.cloudfront.net/lead-gen/tudt/og-image.jpg" style="display: none;">
    <meta property="og:title" content="The Ultimate Drumming Toolbox | Drumeo">
    <meta property="og:description" content="Sign up for these free resources to expand your drumming education today.">
    <meta property="og:url" content="https://www.drumeo.com/ultimate-toolbox">
@stop

@section('total-lesson', '10')

@section('lesson-index', '/ultimate-toolbox/catalogue')

@section('offers')
    @include('lead-gen.partials._free-trial-offer')
@endsection
