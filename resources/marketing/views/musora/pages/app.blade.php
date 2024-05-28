@extends('musora._partials.layout', [
    'whiteNav' => true,
    'fullSubscriptionVersion' => true,
])

@section('head-includes')
    <title>Musora App | Musora</title>
    <meta property="og:title" content="Musora App | Musora">

    <meta name="description" content="Unlimited music lessons. The world’s best teachers. Thousands of popular songs.">
    <meta property="og:description" content="Unlimited music lessons. The world’s best teachers. Thousands of popular songs.">

    <meta property="og:url" content="https://www.musora.com/{{ Request::path() }}">
    <meta property="og:image" content="https://d21q7xesnoiieh.cloudfront.net/fit-in/1200x0/filters:quality(95)/marketing/musora/membership/app-page/share-image-musora-app.jpg">
@endsection

@section('body-class')
bg-gradient-to-b from-white to-gray-200
@endsection

@section('layout-body')
    <section class="w-full">
        <div class="container max-w-6xl mx-auto">
            <div class="flex flex-wrap lg:flex-nowrap items-center px-4 sm:px-6 py-10 lg:py-20">
                <div class="flex justify-center max-w-md lg:max-w-full mx-auto w-full lg:w-auto flex-grow-1 lg:order-1 lg:pl-5">
                    <picture>
                        <source media="(min-width:1200px)" type="image/webp" srcset="https://d21q7xesnoiieh.cloudfront.net/fit-in/1290x0/filters:quality(95)/marketing/musora/membership/app-page/devices.webp">
                        <source media="(min-width:1024px)" type="image/webp" srcset="https://d21q7xesnoiieh.cloudfront.net/fit-in/1040x0/filters:quality(95)/marketing/musora/membership/app-page/devices.webp">
                        <source media="(min-width:640px)" type="image/webp" srcset="https://d21q7xesnoiieh.cloudfront.net/fit-in/900x0/filters:quality(95)/marketing/musora/membership/app-page/devices.webp">
                        <img class="transition-opacity opacity-0 w-full" alt="Screenshot of Musora app on tablet and mobile screens" loading="lazy" onload="this.classList.remove('opacity-0')" src="https://d21q7xesnoiieh.cloudfront.net/fit-in/640x0/filters:quality(95)/marketing/musora/membership/app-page/devices.webp">
                    </picture>
                </div>
                <div class="text-center lg:text-left w-full lg:w-auto flex-shrink-0 lg:pt-5">
                    <img class="h-7 mb-4 invert" src="https://d21q7xesnoiieh.cloudfront.net/fit-in/230x0/filters:quality(95)/marketing/musora/membership/homepage/webp-format/musora_logo.webp" alt="Musora logo">
                    <p class="uppercase text-musora mb-2">
                        <strong>
                        YOUR FIRST 7 DAYS ARE FREE.
                        </strong>
                    </p>
                    <h3 class="leading-normal">
                        <strong>
                        Unlimited music lessons.<br> The world’s best teachers.<br> Thousands of popular songs.
                        </strong>
                    </h3>
                    <ul class="text-center lg:text-left pt-5">
                        <li class="leading-tight mb-3">
                            <i class="fas fa-check text-musora mr-2"></i>
                            Trusted by <?= number_format(Prices::$students) ?> students.
                        </li>
                        <li class="leading-tight mb-3">
                        <i class="fas fa-check text-musora mr-2"></i>
                            Personalized feedback from real teachers.
                        </li>
                        <li class="leading-tight mb-3">
                            <i class="fas fa-check text-musora mr-2"></i>
                            All-access for piano, guitar, drums, and singing.
                        </li>
                    </ul>
                    <div class="pt-5">
                    <a class="inline-block" href="https://apps.apple.com/us/app/musora-the-music-lessons-app/id1460388277" target="_blank" aria-label="Download from Apple Store">
                        <img class="h-8 md:h-10 m-1 transition-opacity opacity-0" loading="lazy" onload="this.classList.remove('opacity-0')" src="https://d21q7xesnoiieh.cloudfront.net/fit-in/270x0/filters:quality(95)/marketing/musora/membership/app-page/apple-store.svg" alt="Download our app from the Apple Store">
                    </a>
                    <a class="inline-block" href="https://play.google.com/store/apps/details?id=com.drumeo" target="_blank" aria-label="Download from Google Play">
                        <img class="h-8 md:h-10 m-1 transition-opacity opacity-0" loading="lazy" onload="this.classList.remove('opacity-0')" src="https://d21q7xesnoiieh.cloudfront.net/fit-in/270x0/filters:quality(95)/marketing/musora/membership/app-page/google-play.svg" alt="Download our app from Google Play">
                    </a>
                    </div>

                </div>
            </div>
        </div>
    </section>
@stop
