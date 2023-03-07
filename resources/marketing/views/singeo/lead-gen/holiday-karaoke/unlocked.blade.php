@extends('singeo.lead-gen.lead-gen-layout')

@section('styles')
    <meta name="robots" content="noindex">
    <title>Singeo Holiday Karaoke | Singeo</title>
    <meta property="og:title" content="Singeo Holiday Karaoke | Singeo">
    <meta name="description" content="Simply enter your email to unlock your holiday karaoke library!">
    <meta property="og:description" content="Simply enter your email to unlock your holiday karaoke library!">
    <meta property="og:image" content="https://d21xeg6s76swyd.cloudfront.net/lead-gen/holiday-karaoke/og-image.jpg" style="display: none;">
    <meta property="og:url" content="https://www.singeo.com/holiday-karaoke/">

    <link href="{{ asset('/marketing/parcel/singeo/lead-gen.css') }}" rel="stylesheet">
    <style>
        .edge-pitch {top:40px;}
        @media (min-width: 768px) {  .edge-pitch {top:56px;}  }
    </style>
@stop

@section('scripts')
    <script>
        $(document).ready(function () {
            $('.autoplay-video').on('click', function () {
                var idOfOpenDiv = $(this).data('open');

                $('#' + idOfOpenDiv).find('[data-lazy-load-url]').each(function () {
                    var lazyLoadIframeElement = $(this);
                    $(this).attr('src', lazyLoadIframeElement.data('lazy-load-url'));
                });
            });
            $(document).keyup(function(e) {
                if (e.which === 27) {
                    $('.reset-on-close').attr('src', 'about:blank');
                }
            });
            $('.reveal-overlay').on('click', function (e) {
                if (e.target !== this) {
                    return;
                }

                $('.reset-on-close').attr('src', 'about:blank');
            });
            $('.swap-range').on('click', function () {
                var lazyLoadIframeElement = $(this).data('iframe-src');
                $(this).parent().parent().find('.reset-on-close').each(function () {
                    $(this).attr('src', lazyLoadIframeElement);
                });
            });
        });
    </script>
@stop

@section('body')
    <div class="shim w-full block h-11 sm:h-9" style="background-color:#010a2b;"></div>
    <a href="/choose-plan" class="edge-pitch block text-center w-full whitespace-nowrap z-10 py-2 sm:py-1 fixed mx-auto bg-black text-white">
        <div class="container mx-auto">
            <div class="text-center sm:text-left inline-block align-middle hover:opacity-90 transition-opacity duration-300">
                <img class="align-middle w-auto mr-2 h-6 hidden sm:inline-block" src="https://www.musora.com/musora-cdn/image/width=200,quality=85/https://d21xeg6s76swyd.cloudfront.net/sales/2021/singeo-logo.png">
                <p class="inline-block align-middle mx-auto text-xs leading-tight">Get {{ Prices::$singeoSongs - 30 }}+ more songs + world-class vocal lessons <br>
                    inside Singeo. Click for a FREE trial.</p>
            </div>
        </div>
    </a>

    <section class="text-center text-white relative py-12 md:py-14 lg:py-20 px-2 md:px-4" style="background-color:#010a2b;">
        <div class="container mx-auto">
            <h2 class="mb-4 md:mb-5"><strong>30 Holiday Anthems<br> Every. Single. Lyric.</strong></h2>
            <h6 class="leading-normal mb-6 md:mb-12 lg:mb-16 max-w-3xl">Say hello to your free songs! Click below to get started singing your favorite songs.</h6>
            <div class="album-grid flex flex-wrap justify-center">
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
                        <div class="relative autoplay-video cursor-pointer overflow-hidden group" data-open="{{ str_replace(".","",(str_replace("/","",(str_replace(" ","",$bonus['original']))))) }}">
                            <i class="absolute top-1/2 left-1/2 fas fa-play play-button smaller opacity-0 group-hover:opacity-100 -m-10 lg:-m-12"></i>
                            <div class="aspect-1:1 w-full bg-contain bg-center lazyload" data-bg="https://www.musora.com/musora-cdn/image/width=470,quality=85/{{ $bonus['image'] }}"></div>
                        </div>
                        <h6 class="mt-3 mb-0.5 leading-tight"><strong>{{ $bonus['song'] }}</strong></h6>
                        <p class="text-navy leading-tight">{{ $bonus['artist'] }}</p>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
    <section class="text-center py-14 md:py-24 lg:py-32 text-white lazyload" style="background: #6d7894 center center/cover;" data-bg="https://www.musora.com/musora-cdn/image/width=2000,quality=85/https://d21xeg6s76swyd.cloudfront.net/lead-gen/holiday-karaoke/final.jpg">
        <div class="container mx-auto">
            <div class="w-full px-2 md:px-3 text-center">
                <h1><strong>Keep the party going.</strong></h1>
                <h4 class="mt-5 lg:mt-6 mb-6 lg:mb-9 leading-normal px-3">
                    Get {{ Prices::$singeoSongs }}+ songs & world-class vocal lessons inside <br class="hidden md:inline">
                    Singeo. Click below to try a free trial.</h4>
                <a class="join" href="/choose-plan">Free Trial &raquo;</a>
            </div>
        </div>
    </section>

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
        <div class="reveal text-center max-w-6xl" style="background: #404951;" id="{{ str_replace(".","",(str_replace("/","",(str_replace(" ","",$bonus['original']))))) }}" data-reveal>
            <div class="w-full relative overflow-hidden aspect-16:9">
                <iframe class="fixed inset-0 h-full w-full absolute reset-on-close" frameborder="0" allowfullscreen allow="autoplay" src="" data-lazy-load-url="https://www.youtube.com/embed/{{ $bonus['original'] }}?autoplay=1&rel=0&showinfo=0"></iframe>
            </div>
            <div class="flex flex-wrap items-center justify-center py-4">
                <div data-iframe-src="https://www.youtube.com/embed/{{ $bonus['low'] }}?rel=0&showinfo=0" class="swap-range w-1/2 md:w-1/3 px-2 order-2 md:order-1"><div class="w-full lg:w-3/4 join smaller"><i class="fas fa-arrow-down"></i> Low Range</div></div>
                <div data-iframe-src="https://www.youtube.com/embed/{{ $bonus['original'] }}?rel=0&showinfo=0" class="swap-range w-full md:w-1/3 px-2 mb-3 md:mb-0 order-1 md:order-2"><div class="w-3/4 md:w-full lg:w-3/4 join smaller">Original Range</div></div>
                <div data-iframe-src="https://www.youtube.com/embed/{{ $bonus['high'] }}?rel=0&showinfo=0" class="swap-range w-1/2 md:w-1/3 px-2 order-3"><div class="w-full lg:w-3/4 join smaller"><i class="fas fa-arrow-up"></i> High Range</div></div>
            </div>
        </div>
    @endforeach
@stop
