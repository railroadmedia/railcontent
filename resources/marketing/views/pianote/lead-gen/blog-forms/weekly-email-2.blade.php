@extends('_partials.components.forms.blog-form-layout',[
    'brand' => 'pianote',
])

@section('title', 'Weekly Email')

@section('form')
    @include("pianote._partials.sign-up-form", [
                    "recaptchaKey" => $recaptchaKey,
        "formName" => 'Blog Signup',
        "formId" => "Pianote - Engagement - Trigger - Website Signup - Web Form",
        "buttonText" => "Send Me Free Content",
        "minimalForm" => true,
    ])
@endsection
