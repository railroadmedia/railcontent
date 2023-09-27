@extends('_partials.components.forms.blog-form-layout', [
    'brand' => 'drumeo',
    'darkBg' => true
])

@section('title', 'Weekly Email')

@section('subtitle')
    <h5 class="leading-normal mb-3 md:mb-4">
        <strong>Drumming secrets<span class="hidden sm:inline"> you won't find anywhere else</span>.</strong> Join 400K+ drummers who get  <br class="hidden sm:inline">
        tips, viral videos, and insider deals on Drumeo products right to their inbox.</h5>
@endsection

@section('form')

    @include("drumeo.lead-gen.partials.sign-up-form", [
                    "recaptchaKey" => $recaptchaKey,
        "formId" => "Drumeo - Engagement - Trigger - Blog Signup - WebForm",
        "buttonText" => "Join The Drum Club &raquo;",
        "minimalForm" => true,
    ])

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="{{ asset('/marketing/parcel/drumeo/navigation-sales.js') }}"></script>
    @include("drumeo.lead-gen.partials.impact-email-sign-up-tracker")
@endsection
