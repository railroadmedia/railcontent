@extends('_partials.components.forms.blog-form-layout',[
    'brand' => 'pianote',
])

@section('title', 'F#m')

@section('form')
    @include("pianote._partials._sign-up-form", [
        "formName" => 'F Sharp Minor',
        "formId" => "Pianote - Engagement - Trigger - F Sharp Minor - Web Form",
        "buttonText" => "Get Backing Track",
        "minimalForm" => true,
    ])
@endsection
