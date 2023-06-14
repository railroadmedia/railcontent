@extends('musora._partials.layout')

@section('head-includes')
    <title>Musora | Drumeo, Pianote, Singeo, Guitareo</title>
    <meta property="og:title" content="Musora | Drumeo, Pianote, Singeo, Guitareo">

    <meta name="description" content="Learn the songs you love; now on drums, piano, guitar, or vocals.">
    <meta property="og:description" content="Learn the songs you love; now on drums, piano, guitar, or vocals.">

    <meta property="og:url" content="https://www.musora.com/{{ Request::path() }}">
    <meta property="og:image" content="https://dmmior4id2ysr.cloudfront.net/homepage/2023/share-image.jpg">
    <style>
        .reveal-overlay{position:fixed;top:0;right:0;bottom:0;left:0;z-index:2147483002;display:none;overflow-y:auto;background-color:rgba(0,0,0,0.8)}.reveal-overlay:after{-moz-osx-font-smoothing:grayscale;-webkit-font-smoothing:antialiased;font-family:"Font Awesome 5 Pro";font-weight:900;font-style:normal;font-variant:normal;text-rendering:auto;content:"\f00d";color:#fff;z-index:1;opacity:0.8;position:absolute;margin:0;line-height:1em;text-align:center;display:inline-block;outline:none;top:0;right:0;font-size:35px;width:35px}@media (min-width: 768px){.reveal-overlay:after{top:7px;right:7px;font-size:50px;width:50px}}.reveal-overlay .reveal{z-index:1006;-webkit-backface-visibility:hidden;backface-visibility:hidden;display:none;background-color:#fefefe;position:relative;top:100px;margin-right:auto;margin-left:auto;overflow-y:auto;width:90%;height:inherit;min-height:0;outline:none;padding:0;border:none;border-radius:7px}@media (min-width: 768px){.reveal-overlay .reveal{right:auto;left:auto;margin:0 auto}}

        .header-pic {
            background-image:url(https://www.musora.com/musora-cdn/image/width=1200,quality=85/https://dmmior4id2ysr.cloudfront.net/sales/playlist-launch/header-5.png);
        }
        .dot {
            left:-16px;
        }

        .full-line {
            left:0;
            bottom:31%;
        }

        @media (min-width:640px) {
            .dot,
            .full-line {
                left:50%;
            }

            .full-line {
                bottom:0;
            }
        }
    </style>
    <style>
        .join {
            display:inline-block;
            font:500 22px/1em 'Bebas Neue', sans-serif;
            letter-spacing:0.1em;
            text-transform:uppercase;
            background:#0c1524;
            border-radius:50px;
            color:#fff;
            padding:17px 7%;
            outline:none;
            cursor:pointer;
            text-align:center;
            user-select:none;
            text-decoration:none;
            transition:background-color 0.3s, color 0.3s, opacity 0.3s;
            box-shadow:0 0 0 rgba(0, 0, 0, 0.35);
        }

        @media (min-width:768px) {
            .join {
                font-size:30px;
            }
        }

        .join:hover, .join:focus {
            color:#fff;
            background:#14233d;
            box-shadow:0 0 7px rgba(0, 0, 0, 0.35);
        }

        .join.smaller {
            padding:10px 30px 6px;
            font-size:16px;
        }

        @media (min-width:768px) {
            .join.smaller {
                font-size:18px;
                padding:12px 30px 10px;
            }
        }

        .join.smaller.outline {
            padding:8px 28px 6px;
            font-size:16px;
        }

        @media (min-width:768px) {
            .join.smaller.outline {
                font-size:18px;
                padding:10px 28px 8px;
            }
        }

        .join.musora-gold {
            background:#FFAE00;
            color:#000;
        }

        .join.musora-gold:hover, .join.musora-gold:focus {
            background:#FFAE00;
            color:#000;
        }

        .join.outline {
            background:transparent;
            outline-style:none !important;
            border:1px solid #fff;
            color:#fff;
            padding:6px 12px;
        }

        @media (min-width:768px) {
            .join.outline {
                border-width:2px;
                padding:11px 30px;
            }
        }

        .join.outline:hover, .join.outline:focus {
            background:#fff;
            color:#000;
        }

        .text-musora-gold {
            color:#FFAE00;
        }

    </style>
@endsection

@section('body-data')
    @if(strpos(url()->full(), '?watch')))
        x-data = '{
        trailer: true,
        }'
    @else
        x-data = '{
        trailer: false,
        }'
    @endif
@endsection
<!-- Main -->
@section('layout-body')

    <header class="px-5 sm:px-6 py-12 sm:py-16 lg:py-24" style="background:linear-gradient(to bottom, #fff, #F1EFED);">
        <div class="container max-w-4xl mx-auto">
            <div class="flex flex-wrap items-center">
                <div class="header-pic sm:order-1 pb-72 sm:pb-96 mb-7 sm:mb-0 w-full sm:w-auto rounded-xl flex-grow relative bg-top bg-cover cursor-pointer autoplay-video" x-on:click="trailer = true;">
                    <div class="join musora-gold smaller absolute bottom-0 left-0 mx-5 my-5"><i class="fas fa-play"></i>&nbsp; PLAY TRAILER</div>
                </div>
                <div class="w-full sm:w-1/2 lg:w-7/12 sm:pr-6 text-center sm:text-left">
                    <img class="h-10 sm:h-20" src="https://www.musora.com/musora-cdn/image/width=480,quality=85/https://dmmior4id2ysr.cloudfront.net/sales/playlist-launch/logos.png">
                    <h3 class="leading-tight my-3 sm:my-5"><strong>Introducing Playlists.</strong><br> Learning music just got easier.</h3>
                    <p>Playlists give you ultimate control over how you learn the music you love. Organize videos, songs, and lessons YOUR way – and share your journey with students worldwide.</p>
                </div>
            </div>
        </div>
    </header>

    <section class="text-center px-5 sm:px-6 py-10 sm:py-14 lg:py-20" style="background-color:#f9f9fb;">
        <div class="container max-w-3xl mx-auto">
            <h3 class=""><strong>What are Playlists? </strong></h3>
            <p class="leading-normal mt-3 mb-10 sm:mb-14 max-w-2xl mx-auto">Playlists are great for curating personalized lists of videos and content that matter most to you. With Playlists, you can create customized collections of music lessons from world-class instructors, practice routines to elevate your skills, and even songs from your favorite genres. The possibilities are endless!</p>

            <div class="text-center w-full sm:w-auto mx-auto">
                <div class="flex flex-wrap">
                    @php
                        $songItems = [
                            [
                                'fa-icon' => 'fa-heart',
                                'title' => 'My Favorite<br class="hidden sm:inline"> Lessons',
                                'desc' => 'Add your favorite lessons to a custom playlist for easy access.',
                            ],
                            [
                                'fa-icon' => 'fa-music',
                                'title' => 'Play-Along<br class="hidden sm:inline"> Songs',
                                'desc' => 'Spend hours jamming along to a playlist of your favorite songs.',
                            ],
                            [
                                'fa-icon' => 'fa-user',
                                'title' => 'Personal<br class="hidden sm:inline"> Practice Routines',
                                'desc' => 'Create a practice playlist – and rehearse daily to grow your skills.',
                            ],
                            [
                                'fa-icon' => 'fa-bookmark',
                                'title' => 'Watch<br class="hidden sm:inline"> Later',
                                'desc' => 'Busy now? Save lessons to a playlist and watch when you’re free.',
                            ],

                        ];
                    @endphp
                    @foreach ($songItems as $songItem)
                        <div class="w-full sm:w-1/4 sm:px-2 lg:px-3 mb-4 sm:mb-0">
                            <div class="flex sm:inline-block">
                                <div class="w-14 sm:w-full flex-shrink-0">
                                    <i class="fal {!! $songItem['fa-icon'] !!} text-4xl text-musora-gold"></i>
                                    {{--                                    <img alt="point icon" src="https://www.musora.com/musora-cdn/image/{{ $songItem['icon'] }}" class="h-6 sm:h-10">--}}
                                </div>
                                <div class="pl-3 sm:pl-0 text-left sm:text-center">
                                    <p class="mb-1 sm:mt-2 leading-tight"><strong class="font-black">{!!$songItem['title']!!}</strong></p>
                                    <p class="text-sm">{!! $songItem['desc'] !!}</p>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>
    <section class="text-center px-5 sm:px-6 py-10 sm:py-14 lg:py-20 text-white" style="background:#0c1524;">
        <div class="container max-w-4xl mx-auto">
            <h3 class=""><strong>How do I create my own playlists?</strong></h3>
            <p class="leading-normal mt-3 mb-10 sm:mb-14 max-w-2xl mx-auto">Creating playlists is easy. You can do it in three simple steps:</p>

            @php
                $gettings = [

                    [
                    'position' => 'left',
                    'img' => 'https://dmmior4id2ysr.cloudfront.net/sales/playlist-launch/step-1.png',
                    'title' => 'Step 1 ',
                    'desc' => 'Go to “Playlists” in Musora’s Main Menu. Click on the “+” button to create a playlist. ',
                    ],
                    [
                    'position' => 'left',
                    'img' => 'https://dmmior4id2ysr.cloudfront.net/sales/playlist-launch/step-2.png',
                    'title' => 'Step 2',
                    'desc' => 'Give your playlist a name, choose a category, and add a description. You can even upload an image if you want. ',
                    ],
                    [
                    'position' => 'left',
                    'img' => 'https://dmmior4id2ysr.cloudfront.net/sales/playlist-launch/step-3.png',
                    'title' => 'Step 3',
                    'desc' => 'Find your favorite videos and add them to your playlists. Click on the “+” button then hit “Save”. ',
                    ],
                ];
//            @endphp
            <div class="max-w-3xl lg:max-w-4xl mx-auto relative sm:px-4 mt-7 pb-10 sm:pb-20">
                @foreach ($gettings as $key => $getting)
                    @if($getting['position'] === 'right')
                        <div class="relative flex flex-col-reverse md:grid md:grid-cols-2 gap-4 md:gap-14 lg:gap-20 mb-16 md:mb-28">
                            <div class="content relative text-left sm:pl-10 md:pl-0">
                                <h5 class="mb-2 md:mb-4 mt-1 md:mt-0"><strong>{{ $getting['title'] }}</strong></h5>
                                <p>{{ $getting['desc'] }}</p>
                            </div>
                            <div class="-mt-7 rounded-lg bg-cover bg-center relative aspect-16:9">
                                <img class="absolute inset-0 transition-all opacity-0" src="https://www.musora.com/musora-cdn/image/width=800,quality=85/{{ $getting['img'] }}" alt="workout {{ $key+1 }}" loading="lazy" onload="this.classList.remove('opacity-0')" />
                            </div>
                            <div class="dot hidden sm:block absolute bg-musora top-0 rounded-full z-10 transform -translate-x-1/2 -translate-y-1/2" style="width: 20px;height:20px"></div>
                        </div>
                    @else
                        <div class="relative flex flex-col md:grid md:grid-cols-2 gap-4 md:gap-14 lg:gap-20 @if($key !== 2) mb-16 md:mb-28 @endif">
                            <div class="-mt-7 rounded-lg bg-cover bg-center relative aspect-16:9">
                                <img class="absolute inset-0 transition-all opacity-0" src="https://www.musora.com/musora-cdn/image/width=800,quality=85/{{ $getting['img'] }}" alt="workout {{ $key+1 }}" loading="lazy" onload="this.classList.remove('opacity-0')" />
                            </div>
                            <div class="content relative text-left sm:pl-10 md:pl-0">
                                <h5 class="mb-2 md:mb-4 mt-1 md:mt-0"><strong>{{ $getting['title'] }}</strong></h5>
                                <p>{{ $getting['desc'] }}</p>
                            </div>
                            <div class="dot hidden sm:block absolute bg-musora top-0 rounded-full z-10 transform -translate-x-1/2 -translate-y-1/2" style="width: 20px;height:20px"></div>
                        </div>
                    @endif
                @endforeach
                <div class="full-line hidden sm:block absolute bg-musora top-0 z-0 transform -translate-x-1/2" style="width: 2px;"></div>
            </div>
            <div class="text-center sm:text-left sm:text-center">
                <img class="h-12 mt-4 mb-2 transition-opacity opacity-0"
                    loading="lazy"
                    onload="this.classList.remove('opacity-0')" src="https://www.musora.com/musora-cdn/image/width=190,quality=85/https://dmmior4id2ysr.cloudfront.net/sales/playlist-launch/party.png" alt="bonus icon">
                <h5><strong>That’s it!</strong></h5>
                <p class="max-w-sm mx-auto leading-normal mt-3">Use your playlists to learn what you like, jam along to songs, and so much more. Or share them elsewhere in Musora using your playlist’s link.</p>
            </div>
        </div>
    </section>
    <div id="playlists" class="anchor"></div>
    <section class="text-center px-5 sm:px-6 py-10 sm:py-14 lg:py-20">
        <div class="container max-w-3xl mx-auto">
            <h3 class=""><strong>Musora Playlists </strong></h3>
            <p class="leading-normal mt-3 mb-10 sm:mb-14 mx-auto">Our talented team created some fantastic playlists to get Musora <br class="hidden sm:inline">
                members started. Click one of the playlists below to check it out!</p>

            <div class="text-center w-full sm:w-auto mt-6 lg:mt-10 mx-auto">
                @php
                    $DplaylistItems = [
                        [
                        'title' => 'Krad’s Favorite Fills',
                        'url' => '/drumeo/playlist/300236',
                        'thumb' => 'https://musora-center.s3.amazonaws.com/sales/playlist-launch/2-KrRadsFaveFills.jpg',
                        ],
                        [
                        'title' => '5 lessons to develop the Moeller Stroke',
                        'url' => '/drumeo/playlist/300244',
                        'thumb' => 'https://musora-center.s3.amazonaws.com/sales/playlist-launch/3-MoellerStroke.jpg',
                        ],
                        [
                        'title' => 'Brandon’s Top 10 Songs Of 2023',
                        'url' => '/drumeo/playlist/300238',
                        'thumb' => 'https://musora-center.s3.amazonaws.com/sales/playlist-launch/4-Top10Songs.jpg',
                        ],
                    ];
                    $PplaylistItems = [
                        [
                        'title' => 'Lisa’s Beautiful Arpeggios',
                        'url' => '/pianote/playlist/300247',
                        'thumb' => 'https://musora-center.s3.amazonaws.com/sales/playlist-launch/1-BeautifulArpeggios.jpg',
                        ],
                        [
                        'title' => 'Easy Song Tutorials For Beginners',
                        'url' => '/pianote/playlist/300252',
                        'thumb' => 'https://musora-center.s3.amazonaws.com/sales/playlist-launch/3-EasySongs.jpg',
                        ],
                        [
                        'title' => 'Songs For Sight Reading',
                        'url' => '/pianote/playlist/300253',
                        'thumb' => 'https://musora-center.s3.amazonaws.com/sales/playlist-launch/5-Sightreading.jpg',
                        ],
                    ];
                    $GplaylistItems = [
                        [
                        'title' => 'Guitareo Method Practice Challenges',
                        'url' => '/guitareo/playlist/300275',
                        'thumb' => 'https://musora-center.s3.amazonaws.com/sales/playlist-launch/2-GuitareoMethodChallenges.jpg',
                        ],
                        [
                        'title' => 'Jimi Hendrix Lessons',
                        'url' => '/guitareo/playlist/300276',
                        'thumb' => 'https://musora-center.s3.amazonaws.com/sales/playlist-launch/3-JimiHendrix.jpg',
                        ],
                        [
                        'title' => '10 Songs For Beginner Guitarists',
                        'url' => '/guitareo/playlist/300278',
                        'thumb' => 'https://musora-center.s3.amazonaws.com/sales/playlist-launch/4-10SongsForBeginners.jpg',
                        ],
                    ];
                    $SplaylistItems = [
                        [
                        'title' => 'Lisa’s Favorite Sing-Alongs',
                        'url' => '/singeo/playlist/300267',
                        'thumb' => 'https://musora-center.s3.amazonaws.com/sales/playlist-launch/1-LisasFavouriteSingAlongs.jpg',
                        ],
                        [
                        'title' => '10 Easy Songs for Beginners',
                        'url' => '/singeo/playlist/300265',
                        'thumb' => 'https://musora-center.s3.amazonaws.com/sales/playlist-launch/3-10Songs.jpg',
                        ],
                        [
                        'title' => 'Pitch Perfect Lessons and Exercises',
                        'url' => '/singeo/playlist/300266',
                        'thumb' => 'https://musora-center.s3.amazonaws.com/sales/playlist-launch/5-PitchPerfect.jpg',
                        ],
                    ];
                @endphp
                <div class="rounded-xl py-3 sm:py-5 px-3 sm:px-2 w-full flex flex-wrap mb-4" style="background-color:#f2f8fd;">
                    @foreach ($DplaylistItems as $playlistItem)
                        <div class="w-full sm:w-1/3 sm:px-2 lg:px-3 mb-3 sm:mb-0">
                            <a href="{{ $playlistItem['url'] }}" class="flex sm:inline-block items-center">
                                <div class="w-24 sm:w-full flex-shrink-0">
                                    <img alt="point icon" src="https://www.musora.com/musora-cdn/image/{{ $playlistItem['thumb'] }}" class="w-full rounded-xl">
                                </div>
                                <div class="pl-4 sm:pl-0 text-left sm:text-center">
                                    <p class="mb-1 sm:mb-0 sm:mt-2 leading-normal sm:leading-tight text-sm"><strong class="font-black">{!!$playlistItem['title']!!}</strong></p>
                                </div>
                            </a>
                        </div>
                    @endforeach
                </div>
                <div class="rounded-xl py-3 sm:py-5 px-3 sm:px-2 w-full flex flex-wrap mb-4" style="background-color:#fef3f4;">
                    @foreach ($PplaylistItems as $playlistItem)
                        <div class="w-full sm:w-1/3 sm:px-2 lg:px-3 mb-3 sm:mb-0">
                            <a href="{{ $playlistItem['url'] }}" class="flex sm:inline-block items-center">
                                <div class="w-24 sm:w-full flex-shrink-0">
                                    <img alt="point icon" src="https://www.musora.com/musora-cdn/image/{{ $playlistItem['thumb'] }}" class="w-full rounded-xl">
                                </div>
                                <div class="pl-4 sm:pl-0 text-left sm:text-center">
                                    <p class="mb-1 sm:mb-0 sm:mt-2 leading-normal sm:leading-tight text-sm"><strong class="font-black">{!!$playlistItem['title']!!}</strong></p>
                                </div>
                            </a>
                        </div>
                    @endforeach
                </div>
                <div class="rounded-xl py-3 sm:py-5 px-3 sm:px-2 w-full flex flex-wrap mb-4" style="background-color:#f2fcfb;">
                    @foreach ($GplaylistItems as $playlistItem)
                        <div class="w-full sm:w-1/3 sm:px-2 lg:px-3 mb-3 sm:mb-0">
                            <a href="{{ $playlistItem['url'] }}" class="flex sm:inline-block items-center">
                                <div class="w-24 sm:w-full flex-shrink-0">
                                    <img alt="point icon" src="https://www.musora.com/musora-cdn/image/{{ $playlistItem['thumb'] }}" class="w-full rounded-xl">
                                </div>
                                <div class="pl-4 sm:pl-0 text-left sm:text-center">
                                    <p class="mb-1 sm:mb-0 sm:mt-2 leading-normal sm:leading-tight text-sm"><strong class="font-black">{!!$playlistItem['title']!!}</strong></p>
                                </div>
                            </a>
                        </div>
                    @endforeach
                </div>
                <div class="rounded-xl py-3 sm:py-5 px-3 sm:px-2 w-full flex flex-wrap" style="background-color:#f9f2fe;">
                    @foreach ($SplaylistItems as $playlistItem)
                        <div class="w-full sm:w-1/3 sm:px-2 lg:px-3 mb-3 sm:mb-0">
                            <a href="{{ $playlistItem['url'] }}" class="flex sm:inline-block items-center">
                                <div class="w-24 sm:w-full flex-shrink-0">
                                    <img alt="point icon" src="https://www.musora.com/musora-cdn/image/{{ $playlistItem['thumb'] }}" class="w-full rounded-xl">
                                </div>
                                <div class="pl-4 sm:pl-0 text-left sm:text-center">
                                    <p class="mb-1 sm:mb-0 sm:mt-2 leading-normal sm:leading-tight text-sm"><strong class="font-black">{!!$playlistItem['title']!!}</strong></p>
                                </div>
                            </a>
                        </div>
                    @endforeach
                </div>
            </div>

            <h3 class="mt-24 mb-4 sm:mb-10"><strong>Still have questions?</strong></h3>
            @include('_partials.components.question-dropdown', [
            'num' => '?',
            "title" => "How many items can I save into a playlist?",
            "desc" => "You can save up to 300 items per playlist.",
            ])
            @include('_partials.components.question-dropdown', [
            'num' => '?',
            "title" => "Can I share my playlist with other students? How do I do this?",
            "desc" => "Yes, you can! You can do this by sharing your playlist’s link with other Musora students.<br><br>Once you’re on the Musora website or app, make sure the playlist’s privacy is set to “Public.” Doing this lets you see the “Share” button for your playlist. Click on that button to copy the playlist’s link.",
            ])
            @include('_partials.components.question-dropdown', [
            'num' => '?',
            "title" => "Can I see who I’ve shared a playlist with? Can I unshare it?",
            "desc" => "You can’t see who you’ve shared a playlist with. To unshare a playlist, change the playlist’s privacy from \"public\" to \"private\" so it's only visible to you.",
            ])
            @include('_partials.components.question-dropdown', [
            'num' => '?',
            "title" => "Can another member update my playlist with recommendations?",
            "desc" => "No, a playlist can only be modified by the user who made it.",
            ])
            @include('_partials.components.question-dropdown', [
            'num' => '?',
            "title" => "Are playlists just for songs, or can I create playlists for lessons?",
            "desc" => "You can add any content type to your playlists, including songs, lessons, assignments – and even entire training packs or Method levels.",
            ])
            @include('_partials.components.question-dropdown', [
            'num' => '?',
            "title" => "How do I save a section of a video into my playlist?",
            "desc" => "You can set a video’s start and end time once added to a playlist. To do this, go into the playlist containing the video and click on the “...” button under “Actions”. Click “Start/End Time” from there.",
            ])
            @include('_partials.components.question-dropdown', [
            'num' => '?',
            "title" => "I have a section of a video saved in my playlist. Can I rename that video to something else?",
            "desc" => "Unfortunately, you can’t rename the video right now. It will show up with its original title in your playlist.",
            ])
            @include('_partials.components.question-dropdown', [
            'num' => '?',
            "title" => "Can students add PDF resources and MP3s to playlists?",
            "desc" => "No, because they are downloadable resources, not items you can view directly on Musora. However, you can add the lessons containing these PDFs/MP3s to a playlist.",
            ])
        </div>
    </section>

@include('_partials.components.video-modal',[
'name' => 'trailer',
'video' => '835472946',
'vimeo' => true,
])
@stop
