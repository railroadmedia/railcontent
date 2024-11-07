@extends('_partials.components.forms.blog-form-layout', [
    'theme' => 'drumeo',
])

@section('title', 'Sucherman Sound')

@section('form')
    @include("drumeo.lead-gen.partials.sign-up-form", [
                    "recaptchaKey" => $recaptchaKey,
                            "formName" => 'Sucherman Sound',
        "formId" => "Drumeo - Engagement - Trigger - Sucherman Sound - WebForm",
        "buttonText" => "MAKE ME A ROCKSTAR",
        "minimalForm" => true,
    ])
@endsection
