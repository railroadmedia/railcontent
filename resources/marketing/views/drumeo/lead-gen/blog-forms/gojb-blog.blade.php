@extends('_partials.components.forms.blog-form-layout', [
    'brand' => 'drumeo',
])

@section('title', 'Grooves Of John Bonham')

@section('form')
    @include("drumeo.lead-gen.partials.sign-up-form", [
                    "recaptchaKey" => $recaptchaKey,
                            "formName" => 'Grooves Of John Bonham',
        "formId" => "Drumeo - Engagement - Trigger - Grooves Of John Bonham - WebForm",
        "buttonText" => "HOOK ME UP",
        "minimalForm" => true,
    ])
@endsection
