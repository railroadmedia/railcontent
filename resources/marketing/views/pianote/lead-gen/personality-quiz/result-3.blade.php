@extends('pianote._partials.global-layout')

@section('global-head')
    <title>You are the Explorer | Pianote</title>
    <meta property="og:title" content="You are the Explorer | Pianote">

    <meta name="description" content="Please enter your email address to get your personality result. ">
    <meta property="og:description" content="Please enter your email address to get your personality result. ">

    <meta property="og:image" content="https://pianote.s3.amazonaws.com/lead-gen/quiz/bg.jpg" style="display: none;">
    <meta property="og:url" content="https://www.pianote.com/{{ Request::path() }}">

    <!-- Tailwind -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.19/tailwind.min.css">
    <link href="{{ asset('/marketing/css/pianote/tailwind-helpers.css') }}" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('/marketing/parcel/pianote/nav-footer.css') }}">
    <link href="{{ asset('/marketing/parcel/pianote/lead-gen-learn-songs.css') }}" rel="stylesheet">
    <style>

    </style>
@stop

@section('global-body')
    @include('pianote._partials._nav', [
        "joinVersion" => true
    ])

    <section class="py-32 md:py-48 bg-center bg-cover bg-no-repeat" style="background-color:#1c0203;background-image:url('https://cdn.musora.com/image/fetch/w_1500,q_auto:best/https://pianote.s3.amazonaws.com/lead-gen/quiz/bg.jpg')">
        <div class="max-w-md md:max-w-4xl mx-auto text-center text-white px-6 lg:px-0">
            <img class="h-40 md:h-72 lg:h-80 mb-2" src="https://cdn.musora.com/image/fetch/w_550,q_auto:best/https://pianote.s3.amazonaws.com/lead-gen/quiz/Q-EXPLORER.png" alt="explorer">
            <h2 class="font-extrabold mt-2 mb-6">You are the Explorer!</h2>
            <p class="mb-4">
                To learn more about what this means and to get free lessons tailored to your<br class="hidden md:inline">
                personality type, please enter your email address. Don’t worry, we won’t <br class="hidden md:inline">
                share your email with anyone, and you can unsubscribe at any time.
            </p>
            @include('pianote._partials._sign-up-form', [
                "formName" => 'Personality Quiz Explorer',
                "formId" => "Pianote - Engagement - Trigger - Personality Quiz Explorer - Web Form",
                'buttonText' => 'Show my results',
                'redirect' => true,
                'redirectURL' => '/personality-quiz/explorer',
                'disclaimerColor' => '#D0E2E7'
            ])
        </div>
    </section>

    @include('pianote._partials._footer')

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script type="text/javascript" src="{{ asset('/marketing/parcel/pianote/nav-footer.js') }}"></script>
    <script src="{{ asset('marketing/js/app.js') }}"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/lazysizes/5.3.2/lazysizes.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/lazysizes/5.3.2/plugins/unveilhooks/ls.unveilhooks.min.js"></script>
@endsection

