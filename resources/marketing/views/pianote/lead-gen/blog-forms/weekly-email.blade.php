@extends('pianote.lead-gen.blog-forms.blog-form-layout', [
    'darkBg' => true
])

@section('title', 'Weekly Email')

@section('subtitle')
    <h5 class="leading-normal mb-3 md:mb-4">
        Enjoying this article? Enter your email to get fresh lessons, <br class="hidden sm:inline">
        interviews, and content delivered to your inbox every week:</h5>
@endsection

@section('form')
    @include("pianote._partials._sign-up-form", [
        "formName" => 'Blog Signup',
        "formId" => "Pianote - Engagement - Trigger - Website Signup - Web Form",
        "buttonText" => "Send Me Free Content",
        "minimalForm" => true,
    ])
@endsection
