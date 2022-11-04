<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, height=device-height, initial-scale=1, maximum-scale=1">

        <title>Page Not Found | Musora</title>

        {{-- Fonts --}}
        @include('partials._fonts')

        {{-- Favicons --}}
        @include('partials._favicons')

        {{-- Styles --}}
        <link rel="stylesheet" href="{{ mix('platform/css/app.css') }}">
    </head>
    <body class="tw-bg-[#000C17] tw-text-white tw-flex">
        <div class="tw-flex-1 tw-flex tw-flex-col tw-items-center tw-justify-center">
            <div class="tw-text-center tw-max-w-md tw-px-6 md:tw-px-0 md:tw-max-w-full">
                <img class="md:tw-h-60 lg:tw-h-72 tw-mb-4" src="https://musora-center.s3.amazonaws.com/logos/404_musora_logo.png" alt="404 logo" />
                <div class="tw-mb-2 tw-text-xl md:tw-text-2xl lg:tw-text-3xl">Oops, this link is lost in your <br class="md:tw-hidden">stack of notes.</div>
                <div class="tw-font-normal tw-mb-3 md:tw-mb-6 tw-text-sm md:tw-text- tw-text-[#E4E4E7]">The page you're looking for doesn't exist.</div>
                <button onclick="history.back()" class="tw-btn-primary tw-bg-white tw-text-black tw-mb-3 md:tw-mb-4">Go Back</button>
                <p class="tw-text-sm md:tw-text-base tw-text-[#E4E4E7]">
                    Go back or contact <u class="tw-text-sm md:tw-text-base">support@musora.com</u>
                </p>
            </div>
        </div>
    </body>
</html>
