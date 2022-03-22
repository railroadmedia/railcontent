@php
    $bodyClass = ($bodyClass ?? '') . ' sidebar';
    $leftSidebar = true;
@endphp

@extends('members.layout')

@section('meta')
    <title>Support | Singeo</title>
@endsection

@section('content')
    @include('members.partials._content-sidebar')

    <header id="pageHeader" class="container fluid tw-py-20" style="background-image:url(https://singeo.s3.amazonaws.com/singeo-header-image.jpg);">
        <div class="container text-center">
            <h1 class="tw-text-white">
                <i class="fas fa-phone fa-flip-horizontal text-singeo"></i> 
                Support
            </h1>
        </div>
    </header>

    <div class="tw-max-w-3xl tw-mx-auto mv-3">
        @include('bladesora::members.partials._support', [
            "themeColor" => "singeo",
            "brand" => "singeo",
            "internationalNumber" => "1-604-855-7605",
            "tollFree" => "1-800-439-8921",
            "emailRecipient" => config('mail-recipients.members-area-support') ?? 'support@singeo.com',
            "emailSubject" => "Support Request from: " . current_user()->getDisplayName() . " (" . current_user()->getEmail() . ")",
            "emailType" => "support-contact",
            "emailInputLabel" => "Report your issue here..",
            "emailEndpoint" => '/mailora/secure/send',
            "emailLogo" => 'https://dmmior4id2ysr.cloudfront.net/logos/singeo-logo-purple.png',
            "emailSuccessMessage" => "Your email has been sent!",
            "emailAddress" => config('mail-recipients.members-area-support') ?? 'support@singeo.com'
        ])
    </div>
@endsection
