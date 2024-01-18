@extends('singeo._partials.global-layout')

@section('global-head')
    <title>New Student Welcome Party | Singeo</title>
    <meta property="og:title" content="New Student Welcome Party">

    <meta name="description" content="Lisa is SO excited to welcome you to the Singeo community and this event is going to be so much fun!">
    <meta property="og:description" content="Lisa is SO excited to welcome you to the Singeo community and this event is going to be so much fun!">

    <meta property="og:url" content="https://www.singeo.com/welcome-party/">
    <meta property="og:image" content="https://d21xeg6s76swyd.cloudfront.net/sales/2022/og-image.jpg"/>

    @include('_partials.layout._tailwindcdn')
    <link href="{{ asset('/marketing/parcel/drumeo/nav-footer-singeo.css') }}" rel="stylesheet">
    <style>
        .title-wrap h1 {
            font-size:27px;
            font-family:"Bebas Neue", sans-serif;
        }
        .title-wrap p, .title-wrap li {
            font:400 14px/1.5em "Open Sans", sans-serif;
        }

        @media only screen and (min-width:40em) {
            .title-wrap h1 {
                font-size:36px;
            }

            .title-wrap p, .title-wrap li {
                font-size:15px;
            }
        }

        @media only screen and (min-width:64em) {

            .title-wrap h1 {
                font-size:45px;
            }

            .title-wrap p, .title-wrap li {
                font-size:17px;
            }
        }
    </style>
@stop

@section('global-body')
    @include("singeo.sales.partials._nav")

    <div class="title-wrap text-white py-5 md:py-12 lg:py-16 px-5 md:px-7 lg:px-3" style="background: linear-gradient(00deg, #011a33, #000c17);">
        <div class="container mx-auto max-w-3xl">
            <img style="width: 100%;border-radius:10px;" src="https://www.musora.com/musora-cdn/image/width=2000,quality=95/https://d21xeg6s76swyd.cloudfront.net/sales/2021/background-teachers-2.jpg">
            <h1 class="uppercase my-3 text-center leading-normal"><strong>Thanks for confirming!</strong></h1>
            <p class="mt-2 md:mt-4 lg:mt-2 mb-6 md:mb-4 lg:mb-7">Your spot is confirmed! Thanks for RSVPing for our Singeo New Student Welcome Party! We are all so excited to welcome you into the Singeo community. Lisa and Darcy (your singing coaches) are really looking forward to meeting you and easter to chat about the incredible things you will learn to do with your voice!
                <br><br>
                You’ll receive an email confirmation in the next 24 hours.
                <br><br>
                If you can’t make the event, don’t worry, we’ll send out a recording of the session afterward. But attending the event live is the MOST fun because you get to engage with us in real-time!
                <br><br>
                Don’t wait, start singing!
                <br><br>
                You can (and should) start using your membership right away. Because singing is fun! Here are a few tips on where to get started:
            </p>
            <ul>
                <li class="mt-2 md:mt-4 lg:mt-2 mb-6 md:mb-4 lg:mb-7"><a class="text-white" href="{{ get_musora_brand_base_url() }}/singeo/method/singeo-method/308514"><u>Singeo Method:</u></a> This is your step-by-step singing curriculum that allows you to progress at your own, comfortable pace as you work through each level towards confident singing.</li>
                <li class="mt-2 md:mt-4 lg:mt-2 mb-6 md:mb-4 lg:mb-7"><a class="text-white" href="{{ get_musora_brand_base_url() }}/singeo/routines"><u>Routines:</u></a> Start your day with our bite-sized routines — ranging from 5 to 20 minutes — perfect for the busy days or when you just want to shake things up a bit.</li>
                <li class="mt-2 md:mt-4 lg:mt-2 mb-6 md:mb-4 lg:mb-7"><a class="text-white" href="{{ get_musora_brand_base_url() }}/singeo/quick-tips"><u>Quick Tips:</u></a> Looking for some singing tips on a certain topic? Check out our ever-expanding Quick Tips library filled with a wide variety of useful singing topics.</li>
                <li class="mt-2 md:mt-4 lg:mt-2 mb-6 md:mb-4 lg:mb-7"><a class="text-white" href="{{ get_musora_brand_base_url() }}/singeo/student-focus"><u>Student Focus:</u></a> Want feedback on your singing? Submit a video for student review. We will watch your submission and then provide helpful encouragement and feedback.</li>
            </ul>
            <p>See you at the New Member Welcome Party!</p>
        </div>
    </div>

    @include("singeo.sales.partials._footer", [
            "minimal" => true
        ])

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="{{ asset('/marketing/parcel/drumeo/navigation-sales.js') }}"></script>
@stop
