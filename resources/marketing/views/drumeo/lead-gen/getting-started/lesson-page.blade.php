@php
  require_once(resource_path('marketing/views/drumeo/lead-gen/getting-started/lessons.php'))
@endphp

@extends('drumeo.lead-gen.partials.lesson-page-layout')

@section('meta')
    <meta name="robots" content="noindex">
    <title>@yield('title') | Getting Started On The Drums</title>
    <meta name="description" content="Just starting out on the drums? Want to rebuild your foundation? Try Jared Falk's free video series!">
    <!-- Social Media -->
    <meta property="og:image" content="https://dpwjbsxqtam5n.cloudfront.net/lead-gen/gsotd/og-image.jpg" style="display: none;">
    <meta property="og:title" content="Getting Started On The Drums | Drumeo">
    <meta property="og:description" content="Just starting out on the drums? Want to rebuild your foundation? Try Jared Falk's free video series!">
    <meta property="og:url" content="https://www.drumeo.com/getting-started/">
@stop

@section('total-lesson', '10')

@section('lesson-index', '/getting-started/lessons/')

@section('lesson-tile-width', 'w-1/2 sm:w-1/3 lg:w-1/4')

@section('assets')
    @include('drumeo.lead-gen.partials._assignment-resources', [
        "title" => "All Course PDFs",
        "zipURL" => "https://dzryyo1we6bm3.cloudfront.net/gsotd/getting-started-resources.zip"
    ])
@endsection

@section('offers')
    @include('drumeo.lead-gen.partials._free-trial-offer')
@endsection

@section('modal')
    <input type="hidden" id="openModal" data-open="signUpModal">

    <div class="reveal medium" id="signUpModal" data-reveal data-reset-on-close="true">
        <section class="header pop-up text-center">
            <h6><i>Thank you for registering for access to...</i></h6>
            <h1 class="text-center">GETTING STARTED <br>ON THE DRUMS</h1>
            <p>We are emailing you links to all the video lessons now, but if you close this pop-up, you start right away with lesson 1!</p>
            <div class="join blue" data-close aria-label="Close modal">Start Lesson #1</div>
        </section>
    </div>
@endsection
