@extends('_partials.components.forms.blog-form-layout', [
    'brand' => 'drumeo',
])

@section('title', 'Sucherman Sound')

@section('form')
    @include("drumeo.lead-gen.partials.sign-up-form", [
                    "recaptchaKey" => $recaptchaKey,
        "formId" => "Drumeo - Engagement - Trigger - Sucherman Sound - WebForm",
        "buttonText" => "MAKE ME A ROCKSTAR",
        "minimalForm" => true,
    ])
@endsection
