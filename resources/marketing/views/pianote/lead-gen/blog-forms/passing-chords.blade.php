@extends('_partials.components.forms.blog-form-layout', [
    'brand' => 'pianote'
])

@section('title', 'Passing Chords')

@section('form')
    @include("pianote._partials.sign-up-form", [
                    "recaptchaKey" => $recaptchaKey,
        "formName" => 'Passing Chords',
        "formId" => "Pianote - Engagement - Trigger - Passing Chords - Web Form",
        "buttonText" => "Send It",
        "minimalForm" => true,
    ])
@endsection
