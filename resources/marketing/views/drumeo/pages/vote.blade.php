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

    <main class="text-white py-8 sm:py-24 lg:py-36 px-4 bg-cover bg-top min-h-screen" 
        style="background-color: #000; background-image: url(https://d21q7xesnoiieh.cloudfront.net/fit-in/2000x0/marketing/drumeo/promos/november/countdown-bg.webp); min-height: calc(100vh - 214px);">
        <div class="container mx-auto max-w-4xl rounded-xl px-6 py-16" 
            style="background: linear-gradient(180deg, #102B46 0%, #0D182A 100%); border: 2px solid #37597F; box-shadow: 0 0 60px 0px #26344B;">
            <div class="flex flex-col items-center">
                <div class="text-white rounded-lg shadow-lg text-center">
                    <div class="mb-6">
                        <img src="https://www.musora.com/musora-cdn/image/width=420,quality=95/https://dpwjbsxqtam5n.cloudfront.net/beat/awards/drumeo-awards-logo.png" 
                            alt="Drumeo Awards" class="mx-auto h-24 md:h-28">
                    </div>

                    <h1 class="text-2xl md:text-4xl font-extrabold mb-2 leading-tight">The Countdown to <br class="md:hidden">Voting is On!</h1>
                    <p class="text-sm md:text-2xl font-medium mb-8">Voting opens @ 12:00 AM Dec 16th.</p>

                   <div class="flex flex-row justify-center gap-2 sm:gap-4 sm:gap-6" x-data="timer()" x-init="countdown()" x-cloak>
                        <div class="text-center" x-cloak x-show="timeLeft > 0">
                            <div class="border border-white rounded-lg p-4 sm:p-6 min-w-[64px] sm:min-w-[80px]">
                                <div class="text-xl sm:text-3xl md:text-5xl font-black" x-text="String(day).padStart(2, '0')">00</div>
                            </div>
                            <div class="text-xs sm:text-sm mt-2">Days</div>
                        </div>
                        <div class="text-center" x-cloak x-show="timeLeft > 0">
                            <div class="border border-white rounded-lg p-4 sm:p-6 min-w-[64px] sm:min-w-[80px]">
                                <div class="text-xl sm:text-3xl md:text-5xl font-black" x-text="String(hour).padStart(2, '0')">00</div>
                            </div>
                            <div class="text-xs sm:text-sm mt-2">Hours</div>
                        </div>
                        <div class="text-center" x-cloak x-show="timeLeft > 0">
                            <div class="border border-white rounded-lg p-4 sm:p-6 min-w-[64px] sm:min-w-[80px]">
                                <div class="text-xl sm:text-3xl md:text-5xl font-black" x-text="String(minute).padStart(2, '0')">00</div>
                            </div>
                            <div class="text-xs sm:text-sm mt-2">Minutes</div>
                        </div>
                        <div class="text-center" x-cloak x-show="timeLeft > 0">
                            <div class="border border-white rounded-lg p-4 sm:p-6 min-w-[64px] sm:min-w-[80px]">
                                <div class="text-xl sm:text-3xl md:text-5xl font-black" x-text="String(second).padStart(2, '0')">00</div>
                            </div>
                            <p class="text-xs sm:text-sm mt-2">Seconds</p>
                        </div>
                         <div class="mt-6 text-sm text-white font-black" x-cloak x-show="timeLeft < 0">
                            Voting is now open!
                        </div>
                    </div>
                   
                </div>
            </div>
        </div>
    </main>

    @include('drumeo.sales.partials._footer', [
        'minimal' => true,
    ])
@endsection
