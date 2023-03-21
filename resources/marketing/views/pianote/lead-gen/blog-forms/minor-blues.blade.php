@extends('pianote.lead-gen.blog-forms.blog-form-layout')

@section('title', 'The Minor Blues Made Easy')

@section('form')
@include("pianote._partials._sign-up-form", [
    "formName" => 'The Minor Blues Made Easy',
    "formId" => "Pianote - Engagement - Trigger - The Minor Blues Made Easy - Web Form",
    "buttonText" => "Master the Blues",
    "minimalForm" => true,
])
@endsection
