@extends('_partials.components.forms.blog-form-layout',[
    'theme' => 'pianote',
])

@section('title', 'Practice Chord Inversions')

@section('form')
    @include("pianote._partials.sign-up-form", [
                    "recaptchaKey" => $recaptchaKey,
        "formName" => 'Practice Chord Inversions',
        "formId" => "Pianote - Engagement - Trigger - Practice Chord Inversions - Web Form",
        "buttonText" => "Get Backing Track",
        "minimalForm" => true,
    ])
@endsection
