@extends('singeo.lead-gen.lead-gen-layout')

@section('styles')
    <title>Singeo Holiday Karaoke | Singeo</title>
    <meta property="og:title" content="Singeo Holiday Karaoke | Singeo">
    <meta name="description" content="Simply enter your email to unlock your holiday karaoke library!">
    <meta property="og:description" content="Simply enter your email to unlock your holiday karaoke library!">
    <meta property="og:image" content="https://d21xeg6s76swyd.cloudfront.net/lead-gen/holiday-karaoke/og-image.jpg" style="display: none;">
    <meta property="og:url" content="https://www.singeo.com/holiday-karaoke/">

    <link href="{{ asset('/marketing/parcel/drumeo/lead-gen-singeo.css') }}" rel="stylesheet">
    <style>
        .snow,.snow:before,.snow:after{content:"";background-image:radial-gradient(4px 4px at 339px 246px,#ffffffe6 50%,#0000),radial-gradient(3px 3px at 98px 140px,#fff 50%,#0000),radial-gradient(5px 5px at 484px 483px,#ffffffb3 50%,#0000),radial-gradient(3px 3px at 248px 336px,#fff 50%,#0000),radial-gradient(4px 4px at 44px 595px,#fff 50%,#0000),radial-gradient(4px 4px at 172px 323px,#fff9 50%,#0000),radial-gradient(3px 3px at 214px 54px,#fff9 50%,#0000),radial-gradient(4px 4px at 458px 532px,#ffffffb3 50%,#0000),radial-gradient(6px 6px at 15px 164px,#fff 50%,#0000),radial-gradient(5px 5px at 52px 508px,#fff9 50%,#0000),radial-gradient(4px 4px at 372px 524px,#fff 50%,#0000),radial-gradient(3px 3px at 243px 293px,#fff9 50%,#0000),radial-gradient(5px 5px at 216px 199px,#fffc 50%,#0000),radial-gradient(6px 6px at 341px 354px,#ffffffb3 50%,#0000),radial-gradient(3px 3px at 218px 165px,#fff 50%,#0000),radial-gradient(6px 6px at 403px 476px,#ffffffb3 50%,#0000),radial-gradient(3px 3px at 552px 311px,#fffc 50%,#0000),radial-gradient(6px 6px at 99px 413px,#fff 50%,#0000),radial-gradient(5px 5px at 14px 11px,#ffffffb3 50%,#0000),radial-gradient(3px 3px at 308px 490px,#fffc 50%,#0000),radial-gradient(3px 3px at 17px 320px,#ffffffb3 50%,#0000),radial-gradient(6px 6px at 85px 177px,#ffffffe6 50%,#0000),radial-gradient(5px 5px at 69px 109px,#fffc 50%,#0000),radial-gradient(3px 3px at 307px 163px,#fffc 50%,#0000),radial-gradient(3px 3px at 558px 302px,#ffffffb3 50%,#0000);background-size:600px 600px;animation:25s linear infinite snow;position:absolute;inset:-600px 0 0}.snow:after{opacity:.4;filter:blur(3px);margin-left:-200px;animation-duration:50s;animation-direction:reverse}.snow:before{opacity:.65;filter:blur(1.5px);margin-left:-300px;animation-duration:75s;animation-direction:reverse}@keyframes snow{to{transform:translateY(600px)}}
    </style>
@stop

@section('body')
    <header class="relative overflow-hidden text-white text-center py-14 md:py-24 lg:py-36 px-4 md:px-6" style="background: #2b3857 url(https://www.musora.com/musora-cdn/image/width=2000,quality=95/https://d21xeg6s76swyd.cloudfront.net/lead-gen/holiday-karaoke/header_no_snow.jpg) center center/cover;">
        <div class="container mx-auto max-w-5xl relative z-50">
            <img class="py-1 md:py-0 h-28 md:h-48 lg:h-60" src="https://www.musora.com/musora-cdn/image/width=1300,quality=95/https://d21xeg6s76swyd.cloudfront.net/lead-gen/holiday-karaoke/logo.png">
            <h6 class="mt-3 md:mt-4 lg:mt-6 mb-5 md:mb-6 leading-tight">Simply enter your email to unlock<br class="inline md:hidden"> your holiday karaoke library!</h6>
            <div class="mx-auto text-center max-w-2xl">
                @include("singeo._partials.sign-up-form", [
                    "recaptchaKey" => $recaptchaKey,
                "formName" => 'Holiday Karaoke',
                "formId" => "Singeo - Engagement - Trigger - Holiday Karaoke - Web Form",
                "buttonText" => "Send My Songs ",
                "oneLine" => true,
                "noTy" => true
                ])

                <div class="thank-you-box w-full rounded-lg mx-auto bg-white text-center text-black max-w-2xl transition-all duration-700 block overflow-hidden invisible max-h-0 opacity-0">
                    <img class="h-9 md:h-11" src="https://d21xeg6s76swyd.cloudfront.net/lead-gen/holiday-karaoke/mic.svg">
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
                        'image' => 'https://d21xeg6s76swyd.cloudfront.net/lead-gen/holiday-karaoke/songs/album-01.jpg',
                        'song' => "All I Want For Christmas Is You",
                        'artist' => 'Mariah Carey ',
                        'original' => '7NFBZlOBGwU',
                        'high' => '4jZKabBPfU0',
                        'low' => 'B2RqxEJJXq0',
                        ],
                        [
                        'image' => 'https://d21xeg6s76swyd.cloudfront.net/lead-gen/holiday-karaoke/songs/album-02.jpg',
                        'song' => "Auld Lang Syne",
                        'artist' => 'Susan Boyle',
                        'original' => '8pIbuQsYwjQ',
                        'high' => 'gKJaCckmyWQ',
                        'low' => 'RoLryeQXMQg',
                        ],
                        [
                        'image' => 'https://d21xeg6s76swyd.cloudfront.net/lead-gen/holiday-karaoke/songs/album-03.jpg',
                        'song' => "Blue Christmas",
                        'artist' => 'Elvis Presley',
                        'original' => 'tan2k57DDtQ',
                        'high' => 'tNEuNQ2yl9U',
                        'low' => 'OlOIMSyYvSg',
                        ],
                        [
                        'image' => 'https://d21xeg6s76swyd.cloudfront.net/lead-gen/holiday-karaoke/songs/album-04.jpg',
                        'song' => "Christmas (Baby Please Come Home) ",
                        'artist' => 'Michael Bublé',
                        'original' => 'mDvyr4cn3t0',
                        'high' => 'z46gsrmc_bk',
                        'low' => 'oIT5rsBZHnc',
                        ],
                        [
                        'image' => 'https://d21xeg6s76swyd.cloudfront.net/lead-gen/holiday-karaoke/songs/album-05.jpg',
                        'song' => "Christmas Time is Here",
                        'artist' => 'Devin Dawson',
                        'original' => 'Urs7WT1t18g',
                        'high' => 'FDltgWb6j-U',
                        'low' => 'mA9Hlu59N7Y',
                        ],
                        [
                        'image' => 'https://d21xeg6s76swyd.cloudfront.net/lead-gen/holiday-karaoke/songs/album-06.jpg',
                        'song' => "Cool Yule",
                        'artist' => 'Bette Midler',
                        'original' => 'ROyOgxGQZiM',
                        'high' => '4j4Us5mofns',
                        'low' => 'ZrvZdorK3R4',
                        ],
                        [
                        'image' => 'https://d21xeg6s76swyd.cloudfront.net/lead-gen/holiday-karaoke/songs/album-07.jpg',
                        'song' => "Deck The Halls",
                        'artist' => 'Nat "King" Cole',
                        'original' => 'KveUR7j0kR4',
                        'high' => 'zd2k1lysBDw',
                        'low' => 'FF2Fb6XG230',
                        ],
                        [
                        'image' => 'https://d21xeg6s76swyd.cloudfront.net/lead-gen/holiday-karaoke/songs/album-08.jpg',
                        'song' => "Feliz Navidad",
                        'artist' => 'José Feliciano',
                        'original' => 'ftdlDcuxC-0',
                        'high' => 'yCQqnj0oRGE',
                        'low' => 'TrvZJX51ZXw',
                        ],
                        [
                        'image' => 'https://d21xeg6s76swyd.cloudfront.net/lead-gen/holiday-karaoke/songs/album-09.jpg',
                        'song' => "Have Yourself a Merry Little Christmas ",
                        'artist' => 'Dan + Shay',
                        'original' => '_v7R0EWRwLM',
                        'high' => 'LIOSqHB4Qlg',
                        'low' => 'tcRfOWz2WsA',
                        ],
                        [
                        'image' => 'https://d21xeg6s76swyd.cloudfront.net/lead-gen/holiday-karaoke/songs/album-10.jpg',
                        'song' => "Here Comes Santa Clause",
                        'artist' => 'Doris Day',
                        'original' => 'E_rbYkIUMW0',
                        'high' => 'h0uXzxhB_RU',
                        'low' => 'B3M6-448QVI',
                        ],
                        [
                        'image' => 'https://d21xeg6s76swyd.cloudfront.net/lead-gen/holiday-karaoke/songs/album-11.jpg',
                        'song' => "It's Beginning To Look A Lot Like Christmas",
                        'artist' => 'Michael Bublé',
                        'original' => 'nDAnNU913fw',
                        'high' => 'NvQ5iNaF6to',
                        'low' => 'Yyh13A8pXCk',
                        ],
                        [
                        'image' => 'https://d21xeg6s76swyd.cloudfront.net/lead-gen/holiday-karaoke/songs/album-12.jpg',
                        'song' => "It's the Most Wonderful Time Of The Year",
                        'artist' => 'Andy Williams',
                        'original' => 'rlYJoBw0ggQ',
                        'high' => 'FJLzquoHatE',
                        'low' => 'wSBHSTLeZ4I',
                        ],
                        [
                        'image' => 'https://d21xeg6s76swyd.cloudfront.net/lead-gen/holiday-karaoke/songs/album-13.jpg',
                        'song' => "Jingle Bell Rock ",
                        'artist' => 'Brenda Lee',
                        'original' => '_ChLheYjInk',
                        'high' => 'sssl3oUG00k',
                        'low' => '8XjmuUhg5wE',
                        ],
                        [
                        'image' => 'https://d21xeg6s76swyd.cloudfront.net/lead-gen/holiday-karaoke/songs/album-14.jpg',
                        'song' => "Last Christmas",
                        'artist' => 'Wham',
                        'original' => '6VVcuhh7QUg',
                        'high' => 'q1rMlq7qMk8',
                        'low' => '5TMxNz2T8Hc',
                        ],
                        [
                        'image' => 'https://d21xeg6s76swyd.cloudfront.net/lead-gen/holiday-karaoke/songs/album-15.jpg',
                        'song' => "Mary's Boy Child",
                        'artist' => 'Boney M',
                        'original' => 'fXp5GpW6VfA',
                        'high' => 'QX0Xia0RrXo',
                        'low' => '8C7Ft1T8AYg',
                        ],
                        [
                        'image' => 'https://d21xeg6s76swyd.cloudfront.net/lead-gen/holiday-karaoke/songs/album-16.jpg',
                        'song' => "Merry Christmas Baby",
                        'artist' => 'Otis Redding',
                        'original' => 'vzsucOmmvXQ',
                        'high' => 'TsIbIfkPhZk',
                        'low' => 'bS5YStkq7mg',
                        ],
                        [
                        'image' => 'https://d21xeg6s76swyd.cloudfront.net/lead-gen/holiday-karaoke/songs/album-17.jpg',
                        'song' => "My Favorite Things",
                        'artist' => 'Martina McBride',
                        'original' => 'GKptQOmAle8',
                        'high' => '_FQEMnaA47M',
                        'low' => 'l9hgIAfXl-Q',
                        ],
                        [
                        'image' => 'https://d21xeg6s76swyd.cloudfront.net/lead-gen/holiday-karaoke/songs/album-18.jpg',
                        'song' => "Please Come Home For Christmas (Bells Will Be Ringing)",
                        'artist' => 'Kelly Clarkson',
                        'original' => 'tgmVh6obp6g',
                        'high' => 'XHZHOP26X4Q',
                        'low' => 'UsLOReAiIVo',
                        ],
                        [
                        'image' => 'https://d21xeg6s76swyd.cloudfront.net/lead-gen/holiday-karaoke/songs/album-19.jpg',
                        'song' => "Rockin' Around The Christmas Tree",
                        'artist' => 'Brenda Lee',
                        'original' => 'Itdh5bhBoIc',
                        'high' => 'FHSkH5C4xBM',
                        'low' => 'UI6sNyC932s',
                        ],
                        [
                        'image' => 'https://d21xeg6s76swyd.cloudfront.net/lead-gen/holiday-karaoke/songs/album-20.jpg',
                        'song' => "Rudolph The Red Nosed Reindeer",
                        'artist' => 'John Denver',
                        'original' => 'ea7RUrJJiaQ',
                        'high' => 'q_HV8vpbwXo',
                        'low' => 'Q8-MbvQasAs',
                        ],
                        [
                        'image' => 'https://d21xeg6s76swyd.cloudfront.net/lead-gen/holiday-karaoke/songs/album-21.jpg',
                        'song' => "Run Rudolph Run",
                        'artist' => 'Chuck Berry',
                        'original' => 'n2mGo8qzQWE',
                        'high' => 'Jbw4sswxdJA',
                        'low' => 'j4YrvKOu1gg',
                        ],
                        [
                        'image' => 'https://d21xeg6s76swyd.cloudfront.net/lead-gen/holiday-karaoke/songs/album-22.jpg',
                        'song' => "Santa Baby",
                        'artist' => 'Eartha Kitt',
                        'original' => 'RwfWQD2KsUA',
                        'high' => 'PbZkVZ-Srdc',
                        'low' => 'fbB0zF48uI4',
                        ],
                        [
                        'image' => 'https://d21xeg6s76swyd.cloudfront.net/lead-gen/holiday-karaoke/songs/album-23.jpg',
                        'song' => "Santa Tell Me ",
                        'artist' => 'Ariana Grandé',
                        'original' => 'FJdKEykHEOo',
                        'high' => 'vbwuFKWtgLM',
                        'low' => '56G0aqhipz0',
                        ],
                        [
                        'image' => 'https://d21xeg6s76swyd.cloudfront.net/lead-gen/holiday-karaoke/songs/album-24.jpg',
                        'song' => "Sleigh Ride",
                        'artist' => 'The Ronettes',
                        'original' => 'nslCk0VTp48',
                        'high' => 'AMgf1hvPPzk',
                        'low' => '5WrTAqD1nhI',
                        ],
                        [
                        'image' => 'https://d21xeg6s76swyd.cloudfront.net/lead-gen/holiday-karaoke/songs/album-25.jpg',
                        'song' => "Step Into Christmas ",
                        'artist' => 'Elton John',
                        'original' => 'x3DpA3WP2TM',
                        'high' => 'kecv3bIyFMQ',
                        'low' => 'eD0DfkoAIN4',
                        ],
                        [
                        'image' => 'https://d21xeg6s76swyd.cloudfront.net/lead-gen/holiday-karaoke/songs/album-26.jpg',
                        'song' => "This Christmas",
                        'artist' => 'Donny Hathaway',
                        'original' => 'SKBOpBCnhBg',
                        'high' => 'xw-P82snmPw',
                        'low' => 'HHOdNhARdik',
                        ],
                        [
                        'image' => 'https://d21xeg6s76swyd.cloudfront.net/lead-gen/holiday-karaoke/songs/album-27.jpg',
                        'song' => "What Christmas Means To Me",
                        'artist' => 'Stevie Wonder',
                        'original' => 'ozzoT-qQzK8',
                        'high' => 'BiIMsp4Maz4',
                        'low' => '_O1uZGbO9co',
                        ],
                        [
                        'image' => 'https://d21xeg6s76swyd.cloudfront.net/lead-gen/holiday-karaoke/songs/album-28.jpg',
                        'song' => "What Christmas Means To Me",
                        'artist' => 'Cee Lo Green',
                        'original' => '0Ppqyxkb2IQ',
                        'high' => 'WFA1lzSgoX8',
                        'low' => 'MNOD0Lgk-xA',
                        ],
                        [
                        'image' => 'https://d21xeg6s76swyd.cloudfront.net/lead-gen/holiday-karaoke/songs/album-29.jpg',
                        'song' => "White Christmas ",
                        'artist' => 'Bing Crosby',
                        'original' => 'RtOM29c2kbI',
                        'high' => 'Jb1rdoHdUxE',
                        'low' => '-tpZrbi3GJ8',
                        ],
                        [
                        'image' => 'https://d21xeg6s76swyd.cloudfront.net/lead-gen/holiday-karaoke/songs/album-30.jpg',
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
                        <div class="relative overflow-hidden group">
                            <div class="aspect-1:1 w-full bg-contain bg-center lazyload" data-bg="https://www.musora.com/musora-cdn/image/width=470,quality=95/{{ $bonus['image'] }}"></div>
                        </div>
                        <h6 class="mt-3 mb-0.5 leading-tight"><strong>{{ $bonus['song'] }}</strong></h6>
                        <p class="text-navy leading-tight">{{ $bonus['artist'] }}</p>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
    <section class="relative overflow-hidden text-white text-center py-7 md:py-12 px-6 lazyload" style="background: #6d7894 center center/cover;" data-bg="https://www.musora.com/musora-cdn/image/width=2000,quality=95/https://d21xeg6s76swyd.cloudfront.net/lead-gen/holiday-karaoke/final.jpg">
        <div class="container mx-auto max-w-5xl relative z-50">
            <img class="py-1 md:py-0 h-28 md:h-48 lg:h-60" src="https://www.musora.com/musora-cdn/image/width=1300,quality=95/https://d21xeg6s76swyd.cloudfront.net/lead-gen/holiday-karaoke/logo.png">
            <h6 class="mt-2 md:mt-4 lg:mt-6 mb-4 md:mb-6 leading-tight">Simply enter your email to unlock<br class="inline md:hidden"> your holiday karaoke library!</h6>
            <div class="mx-auto text-center max-w-2xl">
                @include("singeo._partials.sign-up-form", [
                    "recaptchaKey" => $recaptchaKey,
                "formName" => 'Holiday Karaoke',
                "formId" => "Singeo - Engagement - Trigger - Holiday Karaoke - Web Form2",
                "buttonText" => "Send My Songs ",
                "oneLine" => true,
                "noTy" => true
                ])

                <div class="thank-you-box w-full rounded-lg mx-auto bg-white text-center text-black max-w-2xl transition-all duration-700 block overflow-hidden invisible max-h-0 opacity-0">
                    <img class="h-9 md:h-11" src="https://d21xeg6s76swyd.cloudfront.net/lead-gen/holiday-karaoke/mic.svg">
                    <h2 class="leading-none text-singeo mt-3 md:mt-4 mb-5 md:mb-7 lg:mb-10"><strong>GET READY TO SING!</strong></h2>
                    <h6 class="leading-normal mx-auto max-w-xl mb-2 md:mb-3"><strong>YOUR HOLIDAY KARAOKE SONGS ARE <br class="hidden md:inline"> ON THEIR WAY TO YOUR INBOX!</strong></h6>
                    <p class="leading-normal mx-auto max-w-xl"><em>You should receive an email in just a few minutes. If you don’t <br class="hidden md:inline"> see it, check your spam folder in case it got lost along the way.</em></p>
                </div>
            </div>
        </div>
        <div class="snow"></div>
    </section>
@stop
