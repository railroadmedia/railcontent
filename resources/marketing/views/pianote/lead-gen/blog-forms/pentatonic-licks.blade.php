@extends('_partials.components.forms.blog-form-layout', [
    'theme' => 'pianote'
])

@section('title', '5 Pentatonic Licks')

@section('form')
    @include("pianote._partials.sign-up-form", [
        "recaptchaKey" => $recaptchaKey,
        "formName" => '5 Pentatonic Licks PDF',
        "formId" => "Pianote - Engagement - Trigger - 5 Pentatonic Licks PDF - Web Form",
        "buttonText" => "Send It",
        "minimalForm" => true,
    ])
@endsection
