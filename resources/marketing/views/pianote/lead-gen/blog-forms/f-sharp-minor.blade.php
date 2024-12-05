@extends('_partials.components.forms.blog-form-layout',[
    'theme' => 'pianote',
])

@section('title', 'F#m')

@section('form')
    @include("pianote._partials.sign-up-form", [
                    "recaptchaKey" => $recaptchaKey,
        "formName" => 'F Sharp Minor',
        "formId" => "Pianote - Engagement - Trigger - F Sharp Minor - Web Form",
        "buttonText" => "Get Backing Track",
        "minimalForm" => true,
    ])
@endsection
