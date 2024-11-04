@extends('_partials.components.forms.blog-form-layout', [
    'theme' => 'drumeo',
])

@section('title', 'Weekly Email')

@section('form')
    @include("drumeo.lead-gen.partials.sign-up-form", [
        "recaptchaKey" => $recaptchaKey,
        "formName" => 'Blog Signup',
        "formId" => "Drumeo - Engagement - Trigger - Blog Signup - WebForm",
        "buttonText" => "Join The Drum Club &raquo;",
        "minimalForm" => true,
    ])

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="{{ asset('/marketing/parcel/drumeo/navigation-sales.js') }}"></script>
    @include("drumeo.lead-gen.partials.impact-email-sign-up-tracker")
@endsection
