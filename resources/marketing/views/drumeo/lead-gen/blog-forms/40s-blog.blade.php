@extends('_partials.components.forms.blog-form-layout', [
    'brand' => 'drumeo',
])

@section('title', '40 Songs')

@section('form')
    @include("drumeo.lead-gen.partials.sign-up-form", [
                    "recaptchaKey" => $recaptchaKey,
        "formId" => "Drumeo - Engagement - Trigger - 40S - WebForm",
                            "formName" => '40 Songs',
        "buttonText" => "SEND ME THE SONGS!",
        "minimalForm" => true,
    ])
@endsection
