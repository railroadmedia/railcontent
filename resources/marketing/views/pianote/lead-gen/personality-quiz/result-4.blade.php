@extends('pianote._partials.global-layout')

@section('global-head')
    <title>You are the Scientist | Pianote</title>
    <meta property="og:title" content="You are the Scientist | Pianote">

    <meta name="description" content="Please enter your email address to get your personality result. ">
    <meta property="og:description" content="Please enter your email address to get your personality result. ">

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

    <section class="py-32 md:py-48 bg-center bg-cover bg-no-repeat" style="background-color:#1c0203;background-image:url('https://www.musora.com/musora-cdn/image/width=1500,quality=95/https://d2vyvo0tyx8ig5.cloudfront.net/lead-gen/quiz/bg.jpg')">
        <div class="max-w-md md:max-w-4xl mx-auto text-center text-white px-6 lg:px-0">
            <img class="h-40 md:h-72 lg:h-80 mb-2" src="https://www.musora.com/musora-cdn/image/width=550,quality=95/https://d2vyvo0tyx8ig5.cloudfront.net/lead-gen/quiz/Q-SCIENTIST.png" alt="scientist">
            <h2 class="font-extrabold mt-2 mb-6">You are the Scientist!</h2>
            <p class="mb-4">
                To learn more about what this means and to get free lessons tailored to your<br class="hidden md:inline">
                personality type, please enter your email address. Don’t worry, we won’t <br class="hidden md:inline">
                share your email with anyone, and you can unsubscribe at any time.
            </p>
            @include('pianote._partials.sign-up-form', [
                    "recaptchaKey" => $recaptchaKey,
                "formName" => 'Personality Quiz Scientist',
                "formId" => "Pianote - Engagement - Trigger - Personality Quiz Scientist - Web Form",
                'buttonText' => 'Show my results',
                'redirectURL' => '/personality-quiz/scientist',
                'disclaimerColor' => '#D0E2E7'
            ])
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

