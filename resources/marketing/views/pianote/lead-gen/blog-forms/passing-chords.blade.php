@extends('_partials.components.forms.blog-form-layout', [
    'brand' => 'pianote'
])

@section('title', 'Passing Chords')

@section('form')
    @include("pianote._partials.sign-up-form", [
                    "recaptchaKey" => $recaptchaKey,
        "formName" => 'Passing Chords PDF',
        "formId" => "Pianote - Engagement - Trigger - Passing Chords PDF - Web Form",
        "buttonText" => "Send It",
        "minimalForm" => true,
    ])
@endsection
