@extends('_partials.components.forms.blog-form-layout',[
    'brand' => 'pianote',
])

@section('title', 'Digital Chords And Scales')

@section('form')
    @include("pianote._partials.sign-up-form", [
                    "recaptchaKey" => $recaptchaKey,
        "formName" => 'Digital Chords And Scales',
        "formId" => "Pianote - Engagement - Trigger - Digital Chords And Scales - Web Form",
        "buttonText" => "GET MY BOOK",
        "minimalForm" => true,
    ])
@endsection
