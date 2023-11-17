@extends('_partials.components.forms.blog-form-layout', [
    'brand' => 'drumeo',
])

@section('title', 'Weekly Email')

@section('form')
    @include("drumeo.lead-gen.partials.sign-up-form", [
                    "recaptchaKey" => $recaptchaKey,
                            "formName" => 'Blog Signup',
        "formId" => "Drumeo - Engagement - Trigger - Blog Signup - WebForm",
        "buttonText" => "Join The Drum Club &raquo;",
        "minimalForm" => true,
    ])
@endsection
