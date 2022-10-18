@extends('global-layout')

@section('global-head')
    <title>You're almost there | Pianote</title>
    <meta property="og:title" content="You're almost there | Pianote">

    <meta name="description" content="Please enter your email address to get your personality result. ">
    <meta property="og:description" content="Please enter your email address to get your personality result. ">

    <meta property="og:image" content="https://pianote.s3.amazonaws.com/lead-gen/quiz/bg.jpg" style="display: none;">
    <meta property="og:url" content="https://www.pianote.com/{{ Request::path() }}">

    <!-- Tailwind -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.19/tailwind.min.css">
    <link href="{{ asset('/assets/css/tailwind-helpers.css') }}" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('/assets/marketing/nav-footer.css') }}">
    <link href="/assets/marketing/lead-gen-learn-songs.css" rel="stylesheet">
    <style>

    </style>
@stop

@section('global-body')
    @include('sales.nav', [
        "joinVersion" => true
    ])

    <section class="py-32 md:py-48 bg-center bg-cover bg-no-repeat" style="background-color:#1c0203;background-image:url('https://cdn.musora.com/image/fetch/w_1500,q_auto:best/https://pianote.s3.amazonaws.com/lead-gen/quiz/bg.jpg')">
        <div class="max-w-md md:max-w-4xl mx-auto text-center text-white px-6 lg:px-0">
            <i class="fas fa-spinner fa-spin-pulse text-5xl sm:text-7xl text-pianote"></i>
            <h2 class="font-extrabold mt-2 mb-6">You're almost there!</h2>
            <p class="mb-4">
                Please enter your email address to get your personality result. We’ll also send you <br class="hidden md:inline">some free lessons related to your piano player personality! Don’t worry, we won’t <br class="hidden md:inline">share your email with anyone, and you can unsubscribe at any time.
            </p>
            @include('lead-gen._sign-up-form', [
                "formName" => 'Personality Quiz Academic',
                "formId" => "Pianote - Engagement - Trigger - Personality Quiz Academic - Web Form",
                'buttonText' => 'Show my results',
                'redirect' => true,
                'redirectURL' => '/personality-quiz/academic',
                'disclaimerColor' => '#D0E2E7'
            ])
        </div>
    </section>

    @include('sales.footer')

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script type="text/javascript" src="/assets/marketing/nav-footer.js"></script>
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/lazysizes/5.3.2/lazysizes.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/lazysizes/5.3.2/plugins/unveilhooks/ls.unveilhooks.min.js"></script>
@endsection

