@php
  require_once(resource_path('marketing/views/pianote/lead-gen/chord-hacks/lessons.php'))
@endphp

@extends('pianote.lead-gen.partials._lesson-page-layout')

@section('meta')
    <meta name="robots" content="noindex">

    @parent
@endsection

@section('title', 'Chord Hacks')

@section('meta-description', 'The easier way to learn piano chords so you can play popular songs!')

@section('meta-img', 'https://pianote.s3.amazonaws.com/chord-hacks/og-image.jpg')

@section('meta-url', 'https://www.pianote.com/chord-hacks')

@section('lesson-logo', 'https://d2vyvo0tyx8ig5.cloudfront.net/chord-hacks/logo.png')

@section('lesson-index-url', '/chord-hacks/lessons')

@section('lesson-total-number', 6)

@section('series')
    @include('pianote.lead-gen.partials._lesson-tiles',[
        'width' => 'w-1/2 sm:w-1/3',
    ])
@endsection

@section('offers')
    @if(!empty($offer))
        <section class="px-4 sm:px-6 py-10 sm:py-16 relative" style="background: linear-gradient(to bottom, #F61A30, #910000);">
            <div class="max-w-3xl mx-auto">
                <div class="flex flex-wrap items-center">
                    <div class="w-full sm:w-5/12 relative mx-auto text-center sm:pl-5 lg:pl-10 relative mx-auto sm:order-1 mb-4 md:mb-0">
                        <img class="h-64 md:h-80 scales-book lazyload"
                                data-src="https://cdn.musora.com/image/fetch/w_600,q_auto:best/https://pianote.s3.amazonaws.com/lead-gen/chord-hacks/book.png"
                                alt="scales book">
                    </div>
                    <div class="w-full sm:w-7/12 text-white mx-auto text-center md:text-left">
                        <h2 class="font-extrabold">
                            Master every chord & <br>scale with this guide.
                        </h2>
                        <p class="my-5">
                            <span class="font-extrabold">Every Chord. Every Scale. Every Key.</span>
                            <br><br> This essential resource will help you learn the most important chord shapes, chord variations, and scales in EVERY key.
                        </p>
                        <a class="join smaller white" href="/shop/chords-scales-book" style="color:#910000">CLICK HERE TO GET YOUR COPY</a>
                    </div>
                </div>
            </div>
        </section>
    @else
        @include('pianote.lead-gen.partials._7-day-trial-offer')
    @endif
@endsection
