@extends('partials.layout')

@section('meta')
    <title>Support | Musora</title>
@endsection

@section('content')

    <div
        id="pageHeader"
        class="fluid tw-py-20 tw-relative tw-bg-cover tw-bg-top tw-bg-no-repeat tw-bg-black"
        dusk="profile-header"
        style="background-image:url({{ cf_img('https://musora-web-platform.s3.amazonaws.com/headers/unified_header.jpg', ["quality" => 80, "blur" => 40, "width" => 600, "fit" => "crop"]) }});"
        data-ix-bg="{{ 'https://musora-web-platform.s3.amazonaws.com/headers/unified_header.jpg' }}"
    >
        <div class="header-gradient-overlay absolute-fill"></div>

        <div class="tw-container tw-flex tw-flex-col tw-items-center tw-items-end tw-items-center tw-flex-row tw-mx-auto tw-px-4 md:tw-px-8 dark:tw-text-white tw-relative tw-z-10 ">
            <h1 class="tw-text-white">
                <i class="fas fa-phone fa-flip-horizontal tw-text-3xl"></i>
                <span class="tw-text-4xl tw-font-bold"> Support </span>
            </h1>
        </div>
    </div>

    <div class="tw-max-w-3xl tw-mx-auto mv-3">
        @include('partials.bladesora.members.partials._support', [
            "themeColor" => "{{ $brand }}",
            "brand" => "{{ $brand }}",
            "internationalNumber" => "1-604-855-7605",
            "tollFree" => "1-800-439-8921",
            "emailRecipient" => "{{ $emailRecipient }}",
            "emailSubject" => "Support Request from: " . user()->display_name . " (" . user()->email . ")",
            "emailType" => "support-contact",
            "emailInputLabel" => "Report your issue here..",
            "emailEndpoint" => '/mailora/secure/send',
            "emailLogo" => "{{ $logoLink  }}",
            "emailSuccessMessage" => "Your email has been sent!",
            "emailAddress" => "{{ $emailRecipient }}"
        ])
    </div>

@endsection
