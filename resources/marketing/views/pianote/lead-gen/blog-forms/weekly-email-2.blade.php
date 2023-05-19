@extends('_partials.components.forms.blog-form-layout',[
    'brand' => 'pianote',
])

@section('title', 'Weekly Email')

@section('form')
    @include("pianote._partials._sign-up-form", [
        "formName" => 'Blog Signup',
        "formId" => "Pianote - Engagement - Trigger - Website Signup - Web Form",
        "buttonText" => "Send Me Free Content",
        "minimalForm" => true,
    ])
@endsection
