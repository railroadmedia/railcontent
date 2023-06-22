@extends('_partials.components.forms.blog-form-layout', [
    'brand' => 'drumeo',
])

@section('title', 'Free Play-Alongs')

@section('form')
    @include("drumeo.lead-gen.partials.sign-up-form", [
                    "recaptchaKey" => $recaptchaKey,
        "formId" => "Drumeo - Engagement - Trigger - Free Play-Alongs - WebForm",
        "buttonText" => "HOOK ME UP",
        "minimalForm" => true,
    ])
@endsection
