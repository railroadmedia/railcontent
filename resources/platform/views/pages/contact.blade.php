@extends('partials.login-layout')

@section('meta')
    <title>Contact | Musora</title>
@endsection

@section('content')

    <div
        id="pageHeader"
        class="fluid tw-py-20 tw-relative tw-bg-cover tw-bg-top tw-bg-no-repeat tw-bg-black"
        dusk="profile-header"
    >
        {{-- Background Image --}}
        <div class="tw-bg-cover tw-absolute tw-w-full tw-h-full tw-top-0 tw-left-0 tw-bg-top">
            <img src="https://www.musora.com/musora-cdn/image/width=1000,quality=95/https://d3fzm1tzeyr5n3.cloudfront.net/headers/unified_header.jpg"
                class="tw-h-full tw-w-full tw-object-cover tw-object-top tw-transition-opacity tw-opacity-0"
                onload="this.classList.remove('tw-opacity-0')"
            >
        </div>
        {{-- Background Gradient --}}
        <div class="header-gradient-overlay absolute-fill"></div>
        <div
            class="tw-container tw-flex tw-items-center tw-flex-row tw-mx-auto tw-px-4 md:tw-px-8 dark:tw-text-white tw-relative tw-z-10 ">
            <h1 class="tw-text-white">
                <i class="fas fa-phone fa-flip-horizontal tw-text-3xl"></i>
                <span class="tw-text-4xl tw-font-bold"> Contact </span>
            </h1>
        </div>
    </div>

    <div class="tw-flex tw-flex-col tw-max-w-3xl tw-mx-auto tw-px-4">
        <section class="tw-flex tw-flex-row tw-flex-wrap mv-3 tw-w-full">
            <div class="tw-flex tw-flex-col tw-w-full">
                <contact-email-form
                    brand="{{ $brand }}"
                    captchakey="6LfwMZ4dAAAAALEGLsEUwAqrJLLnec_sSbl72Oqx"
                    email-subject="Support Request From {{ $brandSenderName }}"
                    email-type="support-contact"
                    email-endpoint="/mailora/public/send"
                    email-logo="{{ $logoLink  }}"
                    input-label="Report your issue here.."
                    recipient="{{ $emailRecipient }}"
                    success-message="Your email has been sent!"
                />
            </div>
        </section>
    </div>

@endsection
