@extends('singeo.lead-gen.lead-gen-layout')

@section('styles')
    @parent

    <title>Singeo Holiday Karaoke | Singeo</title>
    <meta property="og:title" content="Singeo Holiday Karaoke | Singeo">
    <meta name="description" content="Simply enter your email to unlock your holiday karaoke library!">
    <meta property="og:description" content="Simply enter your email to unlock your holiday karaoke library!">
    <meta property="og:image" content="https://singeo.s3.amazonaws.com/lead-gen/holiday-karaoke/og-image.jpg" style="display: none;">
    <meta property="og:url" content="https://www.singeo.com/holiday-karaoke/">

    <link href="{{ asset('/assets/marketing/lead-gen.css') }}" rel="stylesheet">
@stop

@section('body')
    <header class="relative overflow-hidden text-white text-center py-14 md:py-24 lg:py-36 px-4 md:px-6" style="background: #2b3857 url(https://cdn.musora.com/image/fetch/w_2000,q_auto:best/https://singeo.s3.amazonaws.com/lead-gen/holiday-karaoke/header_no_snow.jpg) center center/cover;">
        <div class="container mx-auto max-w-5xl relative z-50">
            <img class="py-1 md:py-0 h-28 md:h-48 lg:h-60" src="https://cdn.musora.com/image/fetch/w_1300,q_auto:best/https://singeo.s3.amazonaws.com/lead-gen/holiday-karaoke/logo.png">
            <h6 class="mt-3 md:mt-4 lg:mt-6 mb-5 md:mb-6 leading-tight">Simply enter your email to unlock<br class="inline md:hidden"> your holiday karaoke library!</h6>
            <div class="mx-auto text-center max-w-2xl">
                @include("singeo.lead-gen.partials._sign-up-form-cio", [
                "formName" => 'Holiday Karaoke',
                "formId" => "Singeo - Engagement - Trigger - Holiday Karaoke - Web Form",
                "buttonText" => "Send My Songs ",
                "oneLine" => true,
                "noTy" => true
                ])

                <div class="thank-you-box w-full rounded-lg mx-auto bg-white text-center text-black max-w-2xl transition-all duration-700 block overflow-hidden invisible max-h-0 opacity-0">
                    <img class="h-9 md:h-11" src="https://singeo.s3.amazonaws.com/lead-gen/holiday-karaoke/mic.svg">
                    <h2 class="leading-none text-singeo mt-3 md:mt-4 mb-5 md:mb-7 lg:mb-10"><strong>GET READY TO SING!</strong></h2>
                    <h6 class="leading-normal mx-auto max-w-xl mb-2 md:mb-3"><strong>YOUR HOLIDAY KARAOKE SONGS ARE <br class="hidden md:inline"> ON THEIR WAY TO YOUR INBOX!</strong></h6>
                    <p class="leading-normal mx-auto max-w-xl"><em>You should receive an email in just a few minutes. If you don’t <br class="hidden md:inline"> see it, check your spam folder in case it got lost along the way.</em></p>
                </div>
            </div>
        </div>
        <div class="snow"></div>
    </header>

    <section class="text-center text-white relative py-12 md:py-14 lg:py-20 px-2 md:px-4" style="background-color:#000318;">
        <div class="container mx-auto">
            <div class="album-grid flex flex-wrap justify-center max-w-6xl mx-auto">
                @php
                    $bonuses = [
                        [
                        'image' => 'https://singeo.s3.amazonaws.com/lead-gen/holiday-karaoke/songs/album-01.jpg',
                        'song' => "All I Want For Christmas Is You",
                        'artist' => 'Mariah Carey ',
                        'original' => '7NFBZlOBGwU',
                        'high' => '4jZKabBPfU0',
                        'low' => 'B2RqxEJJXq0',
                        ],
                        [
                        'image' => 'https://singeo.s3.amazonaws.com/lead-gen/holiday-karaoke/songs/album-02.jpg',
                        'song' => "Auld Lang Syne",
                        'artist' => 'Susan Boyle',
                        'original' => '8pIbuQsYwjQ',
                        'high' => 'gKJaCckmyWQ',
                        'low' => 'RoLryeQXMQg',
                        ],
                        [
                        'image' => 'https://singeo.s3.amazonaws.com/lead-gen/holiday-karaoke/songs/album-03.jpg',
                        'song' => "Blue Christmas",
                        'artist' => 'Elvis Presley',
                        'original' => 'tan2k57DDtQ',
                        'high' => 'tNEuNQ2yl9U',
                        'low' => 'OlOIMSyYvSg',
                        ],
                        [
                        'image' => 'https://singeo.s3.amazonaws.com/lead-gen/holiday-karaoke/songs/album-04.jpg',
                        'song' => "Christmas (Baby Please Come Home) ",
                        'artist' => 'Michael Bublé',
                        'original' => 'mDvyr4cn3t0',
                        'high' => 'z46gsrmc_bk',
                        'low' => 'oIT5rsBZHnc',
                        ],
                        [
                        'image' => 'https://singeo.s3.amazonaws.com/lead-gen/holiday-karaoke/songs/album-05.jpg',
                        'song' => "Christmas Time is Here",
                        'artist' => 'Devin Dawson',
                        'original' => 'Urs7WT1t18g',
                        'high' => 'FDltgWb6j-U',
                        'low' => 'mA9Hlu59N7Y',
                        ],
                        [
                        'image' => 'https://singeo.s3.amazonaws.com/lead-gen/holiday-karaoke/songs/album-06.jpg',
                        'song' => "Cool Yule",
                        'artist' => 'Bette Midler',
                        'original' => 'ROyOgxGQZiM',
                        'high' => '4j4Us5mofns',
                        'low' => 'ZrvZdorK3R4',
                        ],
                        [
                        'image' => 'https://singeo.s3.amazonaws.com/lead-gen/holiday-karaoke/songs/album-07.jpg',
                        'song' => "Deck The Halls",
                        'artist' => 'Nat "King" Cole',
                        'original' => 'KveUR7j0kR4',
                        'high' => 'zd2k1lysBDw',
                        'low' => 'FF2Fb6XG230',
                        ],
                        [
                        'image' => 'https://singeo.s3.amazonaws.com/lead-gen/holiday-karaoke/songs/album-08.jpg',
                        'song' => "Feliz Navidad",
                        'artist' => 'José Feliciano',
                        'original' => 'ftdlDcuxC-0',
                        'high' => 'yCQqnj0oRGE',
                        'low' => 'TrvZJX51ZXw',
                        ],
                        [
                        'image' => 'https://singeo.s3.amazonaws.com/lead-gen/holiday-karaoke/songs/album-09.jpg',
                        'song' => "Have Yourself a Merry Little Christmas ",
                        'artist' => 'Dan + Shay',
                        'original' => '_v7R0EWRwLM',
                        'high' => 'LIOSqHB4Qlg',
                        'low' => 'tcRfOWz2WsA',
                        ],
                        [
                        'image' => 'https://singeo.s3.amazonaws.com/lead-gen/holiday-karaoke/songs/album-10.jpg',
                        'song' => "Here Comes Santa Clause",
                        'artist' => 'Doris Day',
                        'original' => 'E_rbYkIUMW0',
                        'high' => 'h0uXzxhB_RU',
                        'low' => 'B3M6-448QVI',
                        ],
                        [
                        'image' => 'https://singeo.s3.amazonaws.com/lead-gen/holiday-karaoke/songs/album-11.jpg',
                        'song' => "It's Beginning To Look A Lot Like Christmas",
                        'artist' => 'Michael Bublé',
                        'original' => 'nDAnNU913fw',
                        'high' => 'NvQ5iNaF6to',
                        'low' => 'Yyh13A8pXCk',
                        ],
                        [
                        'image' => 'https://singeo.s3.amazonaws.com/lead-gen/holiday-karaoke/songs/album-12.jpg',
                        'song' => "It's the Most Wonderful Time Of The Year",
                        'artist' => 'Andy Williams',
                        'original' => 'rlYJoBw0ggQ',
                        'high' => 'FJLzquoHatE',
                        'low' => 'wSBHSTLeZ4I',
                        ],
                        [
                        'image' => 'https://singeo.s3.amazonaws.com/lead-gen/holiday-karaoke/songs/album-13.jpg',
                        'song' => "Jingle Bell Rock ",
                        'artist' => 'Brenda Lee',
                        'original' => '_ChLheYjInk',
                        'high' => 'sssl3oUG00k',
                        'low' => '8XjmuUhg5wE',
                        ],
                        [
                        'image' => 'https://singeo.s3.amazonaws.com/lead-gen/holiday-karaoke/songs/album-14.jpg',
                        'song' => "Last Christmas",
                        'artist' => 'Wham',
                        'original' => '6VVcuhh7QUg',
                        'high' => 'q1rMlq7qMk8',
                        'low' => '5TMxNz2T8Hc',
                        ],
                        [
                        'image' => 'https://singeo.s3.amazonaws.com/lead-gen/holiday-karaoke/songs/album-15.jpg',
                        'song' => "Mary's Boy Child",
                        'artist' => 'Boney M',
                        'original' => 'fXp5GpW6VfA',
                        'high' => 'QX0Xia0RrXo',
                        'low' => '8C7Ft1T8AYg',
                        ],
                        [
                        'image' => 'https://singeo.s3.amazonaws.com/lead-gen/holiday-karaoke/songs/album-16.jpg',
                        'song' => "Merry Christmas Baby",
                        'artist' => 'Otis Redding',
                        'original' => 'vzsucOmmvXQ',
                        'high' => 'TsIbIfkPhZk',
                        'low' => 'bS5YStkq7mg',
                        ],
                        [
                        'image' => 'https://singeo.s3.amazonaws.com/lead-gen/holiday-karaoke/songs/album-17.jpg',
                        'song' => "My Favorite Things",
                        'artist' => 'Martina McBride',
                        'original' => 'GKptQOmAle8',
                        'high' => '_FQEMnaA47M',
                        'low' => 'l9hgIAfXl-Q',
                        ],
                        [
                        'image' => 'https://singeo.s3.amazonaws.com/lead-gen/holiday-karaoke/songs/album-18.jpg',
                        'song' => "Please Come Home For Christmas (Bells Will Be Ringing)",
                        'artist' => 'Kelly Clarkson',
                        'original' => 'tgmVh6obp6g',
                        'high' => 'XHZHOP26X4Q',
                        'low' => 'UsLOReAiIVo',
                        ],
                        [
                        'image' => 'https://singeo.s3.amazonaws.com/lead-gen/holiday-karaoke/songs/album-19.jpg',
                        'song' => "Rockin' Around The Christmas Tree",
                        'artist' => 'Brenda Lee',
                        'original' => 'Itdh5bhBoIc',
                        'high' => 'FHSkH5C4xBM',
                        'low' => 'UI6sNyC932s',
                        ],
                        [
                        'image' => 'https://singeo.s3.amazonaws.com/lead-gen/holiday-karaoke/songs/album-20.jpg',
                        'song' => "Rudolph The Red Nosed Reindeer",
                        'artist' => 'John Denver',
                        'original' => 'ea7RUrJJiaQ',
                        'high' => 'q_HV8vpbwXo',
                        'low' => 'Q8-MbvQasAs',
                        ],
                        [
                        'image' => 'https://singeo.s3.amazonaws.com/lead-gen/holiday-karaoke/songs/album-21.jpg',
                        'song' => "Run Rudolph Run",
                        'artist' => 'Chuck Berry',
                        'original' => 'n2mGo8qzQWE',
                        'high' => 'Jbw4sswxdJA',
                        'low' => 'j4YrvKOu1gg',
                        ],
                        [
                        'image' => 'https://singeo.s3.amazonaws.com/lead-gen/holiday-karaoke/songs/album-22.jpg',
                        'song' => "Santa Baby",
                        'artist' => 'Eartha Kitt',
                        'original' => 'RwfWQD2KsUA',
                        'high' => 'PbZkVZ-Srdc',
                        'low' => 'fbB0zF48uI4',
                        ],
                        [
                        'image' => 'https://singeo.s3.amazonaws.com/lead-gen/holiday-karaoke/songs/album-23.jpg',
                        'song' => "Santa Tell Me ",
                        'artist' => 'Ariana Grandé',
                        'original' => 'FJdKEykHEOo',
                        'high' => 'vbwuFKWtgLM',
                        'low' => '56G0aqhipz0',
                        ],
                        [
                        'image' => 'https://singeo.s3.amazonaws.com/lead-gen/holiday-karaoke/songs/album-24.jpg',
                        'song' => "Sleigh Ride",
                        'artist' => 'The Ronettes',
                        'original' => 'nslCk0VTp48',
                        'high' => 'AMgf1hvPPzk',
                        'low' => '5WrTAqD1nhI',
                        ],
                        [
                        'image' => 'https://singeo.s3.amazonaws.com/lead-gen/holiday-karaoke/songs/album-25.jpg',
                        'song' => "Step Into Christmas ",
                        'artist' => 'Elton John',
                        'original' => 'x3DpA3WP2TM',
                        'high' => 'kecv3bIyFMQ',
                        'low' => 'eD0DfkoAIN4',
                        ],
                        [
                        'image' => 'https://singeo.s3.amazonaws.com/lead-gen/holiday-karaoke/songs/album-26.jpg',
                        'song' => "This Christmas",
                        'artist' => 'Donny Hathaway',
                        'original' => 'SKBOpBCnhBg',
                        'high' => 'xw-P82snmPw',
                        'low' => 'HHOdNhARdik',
                        ],
                        [
                        'image' => 'https://singeo.s3.amazonaws.com/lead-gen/holiday-karaoke/songs/album-27.jpg',
                        'song' => "What Christmas Means To Me",
                        'artist' => 'Stevie Wonder',
                        'original' => 'ozzoT-qQzK8',
                        'high' => 'BiIMsp4Maz4',
                        'low' => '_O1uZGbO9co',
                        ],
                        [
                        'image' => 'https://singeo.s3.amazonaws.com/lead-gen/holiday-karaoke/songs/album-28.jpg',
                        'song' => "What Christmas Means To Me",
                        'artist' => 'Cee Lo Green',
                        'original' => '0Ppqyxkb2IQ',
                        'high' => 'WFA1lzSgoX8',
                        'low' => 'MNOD0Lgk-xA',
                        ],
                        [
                        'image' => 'https://singeo.s3.amazonaws.com/lead-gen/holiday-karaoke/songs/album-29.jpg',
                        'song' => "White Christmas ",
                        'artist' => 'Bing Crosby',
                        'original' => 'RtOM29c2kbI',
                        'high' => 'Jb1rdoHdUxE',
                        'low' => '-tpZrbi3GJ8',
                        ],
                        [
                        'image' => 'https://singeo.s3.amazonaws.com/lead-gen/holiday-karaoke/songs/album-30.jpg',
                        'song' => "Winter Wonderland",
                        'artist' => 'Tony Bennett',
                        'original' => 'EE5XRveTYFY',
                        'high' => 'ioWufUdPVf4',
                        'low' => 'cPAOu1U6vnU',
                        ]
                    ]
                @endphp
                @foreach($bonuses as $bonus)
                    <div class="w-1/2 sm:w-1/3 md:w-1/4 lg:w-1/5 px-2 md:px-3 mb-5 md:mb-6 lg:mb-8">
                        <div class="relative autoplay-video cursor-pointer overflow-hidden group" data-open="signUpModal">
                            <i class="absolute top-1/2 left-1/2 fas fa-play play-button smaller opacity-0 group-hover:opacity-100 -m-10 lg:-m-12"></i>
                            <div class="aspect-1:1 w-full bg-contain bg-center lazyload" data-bg="https://cdn.musora.com/image/fetch/w_470,q_auto:best/{{ $bonus['image'] }}"></div>
                        </div>
                        <h6 class="mt-3 mb-0.5 leading-tight"><strong>{{ $bonus['song'] }}</strong></h6>
                        <p class="text-navy leading-tight">{{ $bonus['artist'] }}</p>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
    <section class="relative overflow-hidden text-white text-center py-7 md:py-12 px-6 lazyload" style="background: #6d7894 center center/cover;" data-bg="https://cdn.musora.com/image/fetch/w_2000,q_auto:best/https://singeo.s3.amazonaws.com/lead-gen/holiday-karaoke/final.jpg">
        <div class="container mx-auto max-w-5xl relative z-50">
            <img class="py-1 md:py-0 h-28 md:h-48 lg:h-60" src="https://cdn.musora.com/image/fetch/w_1300,q_auto:best/https://singeo.s3.amazonaws.com/lead-gen/holiday-karaoke/logo.png">
            <h6 class="mt-2 md:mt-4 lg:mt-6 mb-4 md:mb-6 leading-tight">Simply enter your email to unlock<br class="inline md:hidden"> your holiday karaoke library!</h6>
            <div class="mx-auto text-center max-w-2xl">
                @include("singeo.lead-gen.partials._sign-up-form-cio", [
                "formName" => 'Holiday Karaoke',
                "formId" => "Singeo - Engagement - Trigger - Holiday Karaoke - Web Form",
                "buttonText" => "Send My Songs ",
                "oneLine" => true,
                "noTy" => true
                ])

                <div class="thank-you-box w-full rounded-lg mx-auto bg-white text-center text-black max-w-2xl transition-all duration-700 block overflow-hidden invisible max-h-0 opacity-0">
                    <img class="h-9 md:h-11" src="https://singeo.s3.amazonaws.com/lead-gen/holiday-karaoke/mic.svg">
                    <h2 class="leading-none text-singeo mt-3 md:mt-4 mb-5 md:mb-7 lg:mb-10"><strong>GET READY TO SING!</strong></h2>
                    <h6 class="leading-normal mx-auto max-w-xl mb-2 md:mb-3"><strong>YOUR HOLIDAY KARAOKE SONGS ARE <br class="hidden md:inline"> ON THEIR WAY TO YOUR INBOX!</strong></h6>
                    <p class="leading-normal mx-auto max-w-xl"><em>You should receive an email in just a few minutes. If you don’t <br class="hidden md:inline"> see it, check your spam folder in case it got lost along the way.</em></p>
                </div>
            </div>
        </div>
        <div class="snow"></div>
    </section>

    <div class="reveal text-center max-w-xl text-white lazyload" id="signUpModal" data-reveal style="background: #6d7894 right center/cover;" data-bg="https://cdn.musora.com/image/fetch/w_2000,q_auto:best/https://singeo.s3.amazonaws.com/lead-gen/holiday-karaoke/final.jpg">
        <div class="py-5 px-3 md:px-9 md:py-9">
            <h4 class="leading-normal mb-4"><strong>Simply enter your email to unlock<br class="inline lg:hidden"> your holiday karaoke library!</strong></h4>
            @include("singeo.lead-gen.partials._sign-up-form-cio", [
            "formId" => "Singeo - Engagement - Trigger - Holiday Karaoke - Web Form",
            "formName" => 'Holiday Karaoke',
            "oneLine" => true,
            "noTy" => true
            ])

            <div class="thank-you-box w-full rounded-lg mx-auto bg-white text-center text-black max-w-2xl transition-all duration-700 block overflow-hidden invisible max-h-0 opacity-0">
                <img class="h-9 md:h-11" src="https://singeo.s3.amazonaws.com/lead-gen/holiday-karaoke/mic.svg">
                <h2 class="leading-none text-singeo mt-3 md:mt-4 mb-5 md:mb-7 lg:mb-10"><strong>GET READY TO SING!</strong></h2>
                <h6 class="leading-normal mx-auto max-w-xl mb-2 md:mb-3"><strong>YOUR HOLIDAY KARAOKE SONGS ARE <br class="hidden md:inline"> ON THEIR WAY TO YOUR INBOX!</strong></h6>
                <p class="leading-normal mx-auto max-w-xl"><em>You should receive an email in just a few minutes. If you don’t <br class="hidden md:inline"> see it, check your spam folder in case it got lost along the way.</em></p>
            </div>
        </div>
    </div>
@stop
