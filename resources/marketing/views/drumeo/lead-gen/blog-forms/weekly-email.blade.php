@extends('_partials.components.forms.blog-form-layout', [
    'brand' => 'drumeo',
    'darkBg' => true
])

@section('title', 'Weekly Email')

@section('form')
    @include("drumeo.lead-gen.partials.sign-up-form-tw", [
        "formId" => "Drumeo - Engagement - Trigger - Blog Signup - WebForm",
        "buttonText" => "Join The Drum Club &raquo;",
        "minimalForm" => true,
    ])
@endsection
