@extends('_partials.components.forms.blog-form-layout', [
    'theme' => 'drumeo',
])

@section('title', 'Free Play-Alongs')

@section('form')
    @include("drumeo.lead-gen.partials.sign-up-form", [
                    "recaptchaKey" => $recaptchaKey,
                            "formName" => 'Free Play-Alongs',
        "formId" => "Drumeo - Engagement - Trigger - Free Play-Alongs - WebForm",
        "buttonText" => "HOOK ME UP",
        "minimalForm" => true,
    ])
@endsection
