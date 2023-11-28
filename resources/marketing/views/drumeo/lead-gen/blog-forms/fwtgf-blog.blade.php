@extends('_partials.components.forms.blog-form-layout', [
    'brand' => 'drumeo',
])

@section('title', 'FWTGF')

@section('form')
    @include("drumeo.lead-gen.partials.sign-up-form", [
                    "recaptchaKey" => $recaptchaKey,
                            "formName" => 'FWTGF',
        "formId" => "Drumeo - Engagement - Trigger - FWTGF - WebForm",
        "buttonText" => "Get Faster &raquo;",
        "minimalForm" => true,
    ])
@endsection
