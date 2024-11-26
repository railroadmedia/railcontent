{{-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Refresh" content="0; url='https://www.drumeo.com/beat/drumeo-awards-2023/'" />
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, height=device-height, initial-scale=1, maximum-scale=5">
</head>
<body>
</body>
</html> --}}

@extends('drumeo._partials.global-layout')
@section('global-head')
    <title>Vote | Drumeo</title>
    <meta property="og:title" content="Vote | Drumeo">
    <meta name="description" content="The Countdown to Voting is On!">
    <meta property="og:description" content="The Countdown to Voting is On!">
    <meta property="og:image" content="https://dpwjbsxqtam5n.cloudfront.net/beat/awards/drumeo-awards-logo.png" style="display: none;">
    <meta property="og:url" content="https://www.drumeo.com/{{ Request::path() }}">

    @include('_partials.layout._fonts')
    @include('_partials.layout._tailwindcdn')
    <link href="{{ asset('/marketing/css/tailwind-helpers.css') }}" rel="stylesheet">
    <link href="{{ asset('/marketing/parcel/drumeo/sales-2020.css') }}" rel="stylesheet">
    <link href="{{ asset('/marketing/parcel/drumeo/navigation-sales.css') }}" rel="stylesheet">
@endsection

@section('global-body')
    @include('drumeo.sales.partials._nav', [
        "cartVersion" => true
    ])

    <main class="text-white py-8 sm:py-24 lg:py-28 px-4 bg-cover bg-top" style="background-color:#000; background-image:url(https://d21q7xesnoiieh.cloudfront.net/fit-in/2000x0/marketing/drumeo/promos/november/countdown-bg.webp);">
        <div class="container mx-auto max-w-3xl rounded-xl py-10" style="background: linear-gradient(180deg, rgba(16, 43, 70, 0.75) 0%, rgba(13, 24, 42, 0.75) 100%); border: 1px solid #37597F; box-shadow: 0px 4px 4px 0px rgba(0, 0, 0, 0.25);">
            <div class="flex flex-wrap items-center">
                <div class="text-white rounded-lg shadow-lg mx-auto text-center">
                    <div class="mb-6">
                        <img src="https://www.musora.com/musora-cdn/image/width=420,quality=95/https://dpwjbsxqtam5n.cloudfront.net/beat/awards/drumeo-awards-logo.png" alt="Drumeo Awards" class="mx-auto h-24">
                    </div>

                    <h1 class="text-2xl md:text-4xl font-extrabold mb-2">The Countdown to Voting is On!</h1>
                    <p class="text-sm md:text-lg font-medium mb-8">Voting opens @ 12:00 AM Dec 16th.</p>

                   <div class="grid grid-cols-4 gap-2 sm:gap-4 justify-center items-center mx-auto" x-data="timer()" x-init="countdown()">
                        <div class="text-center">
                            <div class="border md:border-2 border-white rounded-lg p-2 md:p-4">
                                <div class="text-base md:text-6xl font-bold" x-text="day">00</div>
                            </div>
                            <div class="text-xs md:text-sm mt-2">Days</div>
                        </div>
                        <div class="text-center">
                            <div class="border md:border-2 border-white rounded-lg p-2 md:p-4">
                                <div class="text-base sm:text-2xl md:text-6xl font-bold" x-text="hour">00</div>
                            </div>
                            <div class="text-xs md:text-sm mt-2">Hours</div>
                        </div>
                        <div class="text-center">
                            <div class="border md:border-2 border-white rounded-lg p-2 md:p-4">
                                <div class="text-base sm:text-2xl md:text-6xl font-bold" x-text="minute">00</div>
                            </div>
                            <div class="text-xs md:text-sm mt-2">Minutes</div>
                        </div>
                        <div class="text-center">
                            <div class="border md:border-2 border-white rounded-lg p-2 md:p-4">
                                <div class="text-base sm:text-2xl md:text-6xl font-bold" x-text="second">00</div>
                            </div>
                            <div class="text-xs md:text-sm mt-2">Seconds</div>
                        </div>
                        <div class="mt-4 text-sm text-white font-medium" x-cloak x-show="timeLeft < 0">Voting is now open!</div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    @include('_partials.components.countdown',[
        'countdownDate' => '2024-12-12 12:00:00',
        'promoVersion' => true
    ])

    @include('drumeo.sales.partials._footer', [
        'minimal' => true,
    ])
@endsection