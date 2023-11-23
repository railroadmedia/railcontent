@extends('_partials.components.forms.blog-form-layout', [
    'brand' => 'guitareo',
])

@section('title', 'Weekly Email')

@section('form')
    @include("drumeo.lead-gen.partials.sign-up-form", [
                    "recaptchaKey" => $recaptchaKey,
                            "formName" => 'Website Signup',
        "formId" => "Guitareo - Engagement - Trigger - Website Signup - WebForm",
        "buttonText" => "Send Me Free Content",
        "minimalForm" => true,
    ])
@endsection
