@extends('pianote.lead-gen.blog-forms.blog-form-layout')

@section('title', 'Weekly Email')

@section('form')
    @include("pianote._partials._sign-up-form", [
        "formName" => 'Blog Signup',
        "formId" => "Pianote - Engagement - Trigger - Website Signup - Web Form",
        "buttonText" => "Send Me Free Content",
        "minimalForm" => true,
    ])
@endsection
