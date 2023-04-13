@extends('pianote.lead-gen.blog-forms.blog-form-layout')

@section('title', 'Practice Chord Inversions')

@section('form')
    @include("pianote._partials._sign-up-form", [
        "formName" => 'Practice Chord Inversions',
        "formId" => "Pianote - Engagement - Trigger - Practice Chord Inversions - Web Form",
        "buttonText" => "Get Backing Track",
        "minimalForm" => true,
    ])
@endsection
