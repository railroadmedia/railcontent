@extends('partials.layout')

@section('meta')
    <title>Page Not Found | Musora</title>
@endsection

@section('content')
    <div class="tw-relative tw-flex tw-flex-col tw-h-[calc(100%+1.75rem)] tw--mb-7 tw-justify-center tw-items-center">
        <img src="https://musora-web-platform.s3.amazonaws.com/Rehearsal+Studio_deSaturated.png" 
             alt="Image of Musical instrument on a stage" 
             class="tw-absolute tw-h-full tw-w-full tw-object-cover tw-object-top tw-transition-opacity tw-opacity-0"
             onload="this.classList.remove('tw-opacity-0')"
        >
        <div class="tw-absolute tw-h-full tw-w-full tw-top-0 tw-left-0 tw-bg-[#E5E5E5]/90 dark:tw-bg-[#00101D]/90"></div>

        {{-- Content --}}
        <div class="tw-container tw-mx-auto tw-px-4 md:tw-px-8 tw-my-3 tw-z-50 tw-items-center tw-justify-center">
            <div class="tw-text-[#0D0D0D] dark:tw-text-white tw-text-center">
                <h1 class="tw-text-5xl lg:tw-text-6xl tw-font-bold tw-mb-4 lg:tw-mb-6">Page not found</h1>
                <h2 class="tw-text-[#3F3F46] dark:tw-text-[#9EC0DC] tw-text-2xl lg:tw-text-3xl tw-font-bold tw-mb-4">404 ERROR</h1>
                <p class="tw-mb-8">The Page you're looking for doesn't exist.</p>

                <a href="/" class="tw-btn-primary tw-bg-[#081825] tw-text-white dark:tw-bg-white dark:tw-text-[#00101D] tw-mb-4">Go Back</a>
                <p class="tw-mb-4">Go back or <a href="/support" class="tw-text-[#081825] dark:tw-text-white tw-underline tw-font-bold">contact support</a></p>
            </div>
        </div>
    </div>
@endsection