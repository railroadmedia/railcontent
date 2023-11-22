@extends('_partials.components.forms.blog-form-layout', [
    'brand' => 'guitareo',
    'darkBg' => true
])

@section('title', 'Weekly Email')

@section('subtitle')
    <h5 class="leading-normal mb-3 md:mb-4">Enjoying this article? Enter your email to get fresh lessons, <br class="hidden sm:inline">
        interviews, and content delivered to your inbox every week:</h5>
@endsection

@section('form')

    @include("singeo._partials.sign-up-form", [
                    "recaptchaKey" => $recaptchaKey,
                            "formName" => 'Website Signup',
        "formId" => "Guitareo - Engagement - Trigger - Website Signup - Web Form",
        "buttonText" => "Send Me Free Content",
        "minimalForm" => true,
    ])

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="{{ asset('/marketing/parcel/drumeo/navigation-sales.js') }}"></script>
    @include("guitareo.lead-gen.partials.impact-email-sign-up-tracker")
@endsection
