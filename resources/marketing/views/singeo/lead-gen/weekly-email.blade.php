@extends('_partials.components.forms.blog-form-layout', [
    'theme' => 'singeo',
    'darkBg' => true
])

@section('title', 'Weekly Email')

@section('subtitle')
    <h5 class="leading-normal mb-3 md:mb-4"><strong>Enjoying the lesson?</strong><br class="hidden sm:inline">
        Enter your email address below to get more free singing lessons.</h5>
@endsection

@section('form')

    @include("singeo._partials.sign-up-form", [
                    "recaptchaKey" => $recaptchaKey,
                            "formName" => 'Website Signup',
        "formId" => "Singeo - Engagement - Trigger - Website Signup - WebForm",
        "buttonText" => "Send Me Free Content",
        "minimalForm" => true,
    ])

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="{{ asset('/marketing/parcel/drumeo/navigation-sales.js') }}"></script>
    @include("singeo.lead-gen.partials.impact-email-sign-up-tracker")
@endsection
