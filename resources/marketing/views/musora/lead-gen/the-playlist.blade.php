@extends('_partials.components.forms.blog-form-layout', [
    'brand' => 'musora',
    'darkBg' => true
])

@section('title', 'The Playlist')

@section('subtitle')
    <h5 class="leading-normal mb-3 md:mb-4">Artist-curated playlists & interviews delivered to your inbox each month.</h5>
@endsection

@section('form')
    @include("musora.lead-gen.partials.sign-up-form", [
        "recaptchaKey" => $recaptchaKey,
        "formName" => 'The Playlist - Musora Newsletter',
        "formId" => "Musora - Engagement - Trigger - The Playlist - Musora Newsletter - WebForm",
        "buttonText" => "Sign Up",
        "minimalForm" => true,
        "buttonColor" => "bg-musora text-black",
    ])
@endsection
