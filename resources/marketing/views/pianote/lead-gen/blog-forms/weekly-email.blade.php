@extends('_partials.components.forms.blog-form-layout', [
    'brand' => 'pianote',
    'darkBg' => true
])

@section('title', 'Weekly Email')

@section('subtitle')
    <h5 class="leading-normal mb-3 md:mb-4">
        Enjoying this article? Enter your email to get fresh lessons, <br class="hidden sm:inline">
        interviews, and content delivered to your inbox every week:</h5>
@endsection

@section('form')
    @include("pianote._partials.sign-up-form", [
                    "recaptchaKey" => $recaptchaKey,
        "formName" => 'Blog Signup',
        "formId" => "Pianote - Engagement - Trigger - Website Signup - Web Form",
        "buttonText" => "Send Me Free Content",
        "minimalForm" => true,
    ])
@endsection
