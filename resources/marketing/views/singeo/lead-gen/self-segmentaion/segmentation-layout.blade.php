@extends('singeo.lead-gen.lead-gen-layout')

@section('styles')
    @parent

    <title>Got it! | Singeo</title>
    <meta property="og:title" content="Got it! | Singeo">
    <meta name="description" content="Online singing lessons for any voice & vocal coaches to support you every step of the way. 90-Day Guarantee." />
    <meta property="og:description" content="Online singing lessons for any voice & vocal coaches to support you every step of the way. 90-Day Guarantee."/>
    <meta property="og:url" content="https://www.singeo.com"/>
    <meta property="og:image" content="https://singeo.s3.amazonaws.com/sales/2022/og-image.jpg"/>
@stop

@section('body')
    <div class="text-white px-3 py-10 sm:py-32" style="background: linear-gradient(to bottom, #01050f 60%, #021225);">
        <div class="container mx-auto px-4 max-w-5xl">
            <div class="px-2 text-center md:px-3">
                <img class="mx-auto h-10 sm:h-16" src="https://www.musora.com/musora-cdn/image/width=200,quality=85/https://singeo.s3.amazonaws.com/sales/2021/singeo-logo.png" alt="singeo-logo" />

                <div class="text-xl sm:text-3xl lg:text-4xl my-5 sm:my-7">
                    <strong>Got it! Thank you so much for<br class="hidden sm:inline"> sharing that information with me.</strong>
                </div>
            </div>

            <div class="lesson-text text-sm max-w-xl mx-auto md:text-base">
                <p>@yield('text')</p>
            </div>

            <div class="grid md:grid-cols-3 md:gap-5 mt-6 md:mt-14 md:mb-10">
                @foreach ($thumbs as $thumb)
                    <a class="mb-6 w-full text-center md:mb-0" href="{{ $thumb['link'] }}">
                        <img class="mb-2 rounded-xl border-2 border-singeo hover:opacity-80 transition-opacity duration-300" src="{{ $thumb['img'] }}" alt="{{ $thumb['title'] }}" />
                        <strong class="text-lg lg:text-xl leading-tight lg:leading-tight">{!! $thumb['title'] !!}</strong>
                    </a>
                @endforeach
            </div>

            <div class="text-center">
                <a target="_blank" class="transition-opacity duration-300 py-3 w-14 h-14 text-3xl leading-none rounded-full inline-block text-center m-3 hover:opacity-70 social-bubble youtube text-white" aria-label="youtube" href="https://www.youtube.com/c/singeoofficial" style="background: #cd201f;"><i class="fab fa-youtube"></i></a>
                <a target="_blank" class="transition-opacity duration-300 py-3 w-14 h-14 text-3xl leading-none rounded-full inline-block text-center m-3 hover:opacity-70 social-bubble facebook text-white" aria-label="facebook" href="https://www.facebook.com/singeoofficial/" style="background: #3b5998;"><i class="fab fa-facebook-f"></i></a>
                <a target="_blank" class="transition-opacity duration-300 py-3 w-14 h-14 text-3xl leading-none rounded-full inline-block text-center m-3 hover:opacity-70 social-bubble instagram text-white" aria-label="instagram" href="https://www.instagram.com/singeoofficial/" style="background: linear-gradient(30deg, #FFD521 17%, #F20008 50%, #B900B4 83%);"><i class="fab fa-instagram"></i></a>
            </div>
        </div>
    </div>
@stop
