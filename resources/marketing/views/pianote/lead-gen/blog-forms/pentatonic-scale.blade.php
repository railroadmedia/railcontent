@extends('_partials.components.forms.blog-form-layout',[
    'brand' => 'pianote',
])

@section('title', 'Pentatonic Scale')

@section('form')
    @include("pianote._partials._sign-up-form", [
        "formName" => 'Pentatonic Scale',
        "formId" => "Pianote - Engagement - Trigger - Pentatonic Scale - Web Form",
        "buttonText" => "Send Me Free Content",
        "minimalForm" => true,
    ])
@endsection
