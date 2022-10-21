@php
  require_once(resource_path('marketing/views/drumeo/lead-gen/getting-started/lessons.php'))
@endphp

@extends('drumeo.lead-gen.lead-gen-layout-tw')

@section('meta')
    <meta name="robots" content="noindex">
    <title>Getting Started On The Drums | Drumeo</title>
    <meta name="description" content="Just starting out on the drums? Want to rebuild your foundation? Try Jared Falk's free video series!">
    <!-- Social Media -->
    <meta property="og:image" content="https://dpwjbsxqtam5n.cloudfront.net/lead-gen/gsotd/og-image.jpg" style="display: none;">
    <meta property="og:title" content="Getting Started On The Drums | Drumeo">
    <meta property="og:description" content="Just starting out on the drums? Want to rebuild your foundation? Try Jared Falk's free video series!">
    <meta property="og:url" content="https://www.drumeo.com/getting-started/">

    <link rel="stylesheet" href="{{ asset('/marketing/parcel/drumeo/lead-gen-tw.css') }}">
@stop

@section('scripts')
    <script>
        $(document).ready(function () {
            $(document).foundation();

            if (location.search.substr(1).includes('noMoreEmails')) {
                $('#UnsubModal').foundation('open');
            }
        });
    </script>
@stop

@section('content')
    <header class="header" style="background-image: url(https://dpwjbsxqtam5n.cloudfront.net/lead-gen/gsotd/bg2.jpg);">
        <div class="container mx-auto text-center max-w-6xl">
            <img class="inline-block mx-auto w-3/4 sm:w-full max-w-xs md:max-w-lg lg:max-w-2xl" src="https://cdn.musora.com/image/fetch/w_1350,q_60,q_auto:best/https://dpwjbsxqtam5n.cloudfront.net/lead-gen/gsotd/logo2.png" alt="Getting Started On The Drums">
        </div>
    </header>

    <section class="text-center text-white relative py-8 md:py-10 lg:py-16 px-4" style="background-color:#010a2b;">
        <div class="container mx-auto">
            <div class="album-grid grid grid-cols-2 sm:grid-cols-3 max-w-2xl lg:max-w-5xl mx-auto">
                @foreach($lessons as $lesson)
                    <a href="{{ $lesson['url'] }}" class="px-2 md:px-3 mb-5 md:mb-7">
                        <div class="relative autoplay-video cursor-pointer overflow-hidden rounded-md border-2" style="border-color:#2d384e;">
                            <i class="absolute top-1/2 left-1/2 fas fa-play play-button" style="margin: -39px;"></i>
                            <div class="aspect-16:9 w-full bg-contain bg-center lazyload" data-bg="https://cdn.musora.com/image/fetch/w_550,q_auto:best/{{ $lesson['image'] }}"></div>
                        </div>
                        <h5 class="mt-3 mb-1"><strong>{{ $lesson['title'] }}</strong></h5>
                    </a>
                @endforeach
            </div>
        </div>
    </section>

    @include('drumeo.lead-gen.partials._free-trial-offer')

    <input type="hidden" id="openModal" data-open="UnsubModal">

    <div class="reveal medium" id="UnsubModal" data-reveal data-reset-on-close="true">
        <section class="header pop-up text-center">
            <h1 class="text-center">Thank you!</h1>
            <p>We've received your request and won't send you any more email reminders for this free series.</p>
        </section>
    </div>
@stop
