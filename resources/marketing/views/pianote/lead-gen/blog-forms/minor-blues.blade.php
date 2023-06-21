@extends('_partials.components.forms.blog-form-layout',[
    'brand' => 'pianote',
])

@section('title', 'The Minor Blues Made Easy')

@section('form')
@include("pianote._partials.sign-up-form", [
                    "recaptchaKey" => $recaptchaKey,
    "formName" => 'The Minor Blues Made Easy',
    "formId" => "Pianote - Engagement - Trigger - The Minor Blues Made Easy - Web Form",
    "buttonText" => "Master the Blues",
    "minimalForm" => true,
])
@endsection
