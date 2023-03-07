@extends('musora._partials.layout')

@section('head-includes')
    <meta name="robots" content="noindex">
    <style>
        p {
            color: #44444F;
            padding-bottom: 60px;
        }

        .header {
            font-weight: 900;
            font-size: 20px;
            padding-bottom: 10px;
        }
    </style>
@endsection

<!-- Main -->
@section('layout-body')
    <div class="max-w-3xl mx-auto py-10">
        <h1 class="font-extrabold">Employee Handbook</h1>
        <div class="inline-block w-20 border-[3px] border-black my-6"></div>
        <p class="text-[#44444F]">
            This Employee Handbook outlines some basic guidelines for all staff working at Musora Media Inc. Keep in mind, these are simply guidelines and not meant to be a strict set of rules. Occasionally, you may operate outside of these guidelines, but it’s important to use these as a baseline set of standards.
        </p>
        <div class="header">Our mission (Why does this company exist?)</div>
        <p>
            Empowering music students around the world to achieve musical freedom through our inspiring social learning communities. We do this by partnering with the best teachers, filming entertaining and educational content, hiring an amazing staff, and utilizing cutting edge web and mobile technology.
        </p>
        <div class="header">Our vision (What are we going to do?) </div>
        <p>
            To Be The #1 Music Education Company In The World!<br><br>
            We will do this by publishing online courses, books, apps, and membership websites. Our full-time staff will grow to more than 100 people and we will establish a presence in the piano, guitar, voice, bass, drum, and recording markets.

        </p>
    </div>
@stop
