@extends('_partials.components.forms.blog-form-layout', [
    'brand' => 'drumeo',
    'darkBg' => true
])

@section('title', 'Weekly Email')

@section('subtitle')
    <h5 class="leading-normal mb-3 md:mb-4">
        <strong>Drumming secrets you won't find<br class="sm:hidden"> anywhere else.</strong><br class="hidden sm:inline">
        Get insider tips, viral videos<br class="sm:hidden"> and Drumeo deals right to your inbox.</h5>
@endsection

@section('form')

    @include("drumeo.lead-gen.partials.sign-up-form", [
                    "recaptchaKey" => $recaptchaKey,
        "formId" => "Drumeo - Engagement - Trigger - Blog Signup - WebForm",
        "inputText" => "Enter Your Email",
        "buttonText" => "Join 400K+ Drummers",
        "minimalForm" => true,
    ])

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="{{ asset('/marketing/parcel/drumeo/navigation-sales.js') }}"></script>
    @include("drumeo.lead-gen.partials.impact-email-sign-up-tracker")
@endsection
