@php
  require_once(resource_path('views/lead-gen/linear-drumming/lessons.php'))
@endphp

@extends('drumeo.lead-gen.partials.lesson-page-layout')

@section('meta')
    <meta name="robots" content="noindex">
    <title>@yield('title') | Linear Drumming | Drumeo</title>
    <meta name="description" content="In this exclusive video series, you'll get his best tips on linear drumming and how to apply it to a range of fills, grooves, and styles of music!">

    <!-- Social Media -->
    <meta property="og:image" content="https://dpwjbsxqtam5n.cloudfront.net/sales/2022/og-image.jpg" style="display: none;">
    <meta property="og:title" content="Linear Drumming | Drumeo">
    <meta property="og:description" content="In this exclusive video series, you'll get his best tips on linear drumming and how to apply it to a range of fills, grooves, and styles of music!">
    <meta property="og:url" content="https://www.drumeo.com/linear-drumming/">
@stop

@section('total-lesson', '5')

@section('lesson-index', '/linear-drumming/lessons')

@section('lesson-tile-width', 'w-1/2 sm:w-1/3')

@section('offers')
    @include('drumeo.lead-gen.partials._free-trial-offer')
@endsection


{{-- <input type="hidden" id="openModal" data-open="signUpModal"> --}}

{{-- <div class="reveal medium" id="signUpModal" data-reveal data-reset-on-close="true">
    <section class="header pop-up text-center">
        <h6><i>Thank you for registering for access to...</i></h6>
        <h1 class="text-center">Linear Drumming</h1>
        <p>We are emailing you links to all the video lessons now, but if you close this pop-up, you start right away with lesson 1!</p>
        <div class="join blue" data-close aria-label="Close modal">Start Lesson #1</div>
    </section>
</div> --}}
