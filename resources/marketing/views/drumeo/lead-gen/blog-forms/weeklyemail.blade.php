@extends('_partials.components.forms.blog-form-layout', [
    'theme' => 'drumeo',
    'darkBg' => true
])

@section('title', 'Weekly Email')

@section('subtitle')
    <h5 class="leading-normal mb-3 md:mb-4">Enjoying this article? Enter your email address to get free drum lessons, <br class="hidden sm:inline">
        interviews, and updates from around the drumming world:</h5>
@endsection

@section('form')
    @include("drumeo.lead-gen.partials.sign-up-form", [
        "recaptchaKey" => $recaptchaKey,
        "formName" => 'Blog Signup',
        "formId" => "Drumeo - Engagement - Trigger - Blog Signup - WebForm",
        "buttonText" => "Join The Drum Club",
        "minimalForm" => true,
        "redirectURL" => "/thankyou",
    ])

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="{{ asset('/marketing/parcel/drumeo/navigation-sales.js') }}"></script>
    @include("drumeo.lead-gen.partials.impact-email-sign-up-tracker")
@endsection
