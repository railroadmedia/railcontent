@extends('musora._partials.layout')

@section('head-includes')
    <title>Access Pass Redeem | Drumeo</title>
    <meta name="description" content="To redeem your access pass enter your code below!">
    <link href="{{ asset('/marketing/css/tailwind-helpers.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ mix('marketing/css/app.css') }}">
    <style>
        html {
            scroll-behavior: smooth;
        }
        [placeholder]:focus::-webkit-input-placeholder {
            color:transparent;
        }

        input::-webkit-input-placeholder,
        textarea::-webkit-input-placeholder {
            color:#AAA;
        }

        input::-moz-placeholder,
        textarea::-moz-placeholder {
            color:#AAA;
        }

        input:-ms-input-placeholder,
        textarea:-ms-input-placeholder {
            color:#AAA;
        }

        input::placeholder,
        textarea::placeholder {
            color:#AAA;
        }

        .error {
            color:red;
            font:500 16px "Open Sans", sans-serif;
        }

        input.jq-couponcode-part {
            width:69px;
        }

        input.jq-couponcode-good {
            background-color:#77ff77;
        }

        input.jq-couponcode-good-nohighlight {
            text-align:center;
            padding:2px 10px;
        }

        input.jq-couponcode-bad {
            background-color:#ff7777;
        }

        .jq-couponcode-sep {
            width:6px;
        }

        .apply {
            background: #00060B;
            border-radius: 70px;
            color: #FFF;
            font: 400 20px/1em "Bebas Neue", sans-serif;
            text-transform: uppercase;
            width: 100%;
            margin: 20px auto 0;
            border: none;
            cursor: pointer;
            padding: 16px 0;
        }

        input[type="text"],
        input[type="password"] {
            background:#333d45;
            color:#ccced1;
            border:1px solid #ccced1;
            font:400 12px/23px "Open Sans", sans-serif;
            margin:0;
            padding:10px;
            box-sizing:border-box;
            box-shadow:none !important;
            height:45px;
            border-radius:70px;
        }

        .default-form-field {
            width:100%;
        }

        .help-message {
            color:#666;
            font:400 14px "Open Sans", sans-serif;
            padding:0 0.9375rem;
            margin-bottom:10px;
        }

        .validation-error {
            color: red;
            font: 600 16px/1em "Open Sans", sans-serif;
        }

        #commentform .code-input {
            text-align:center;
            display:inline-block;
            margin:0;
            font-size:10px;
        }

        .redeem-switcher {
            font:400 16px "Open Sans", sans-serif;
            text-align:center;
            display:block;
            margin:0 auto 5px;
        }

        .input-describer {
            font:700 14px "Open Sans", sans-serif;
            margin:15px auto 10px;
        }

        @media only screen and (min-width:40em) {
            .redeem-switcher {
                margin:0 auto 15px;
            }

            input[type="text"],
            input[type="password"] {
                font-size:16px;
                width:99%;
                padding:10px 15px;
            }

            #commentform .code-input {
                font-size:16px;
                width:95%;
            }
        }
    </style>
    @if(!empty($thomann))
        <style>
            .apply {
                background:#0b76db;
            }

            .apply:hover {
                background:#258ff4;
            }
        </style>
    @else
        <style>
            .apply {
                background:#000C17;
            }

            .apply:hover {
                background:#001930;
            }
        </style>
    @endif
@endsection

@section('body-data')
    x-data ='{
        trailer : false,
    }'
@endsection

@section('layout-body')

    @php
        if (empty($accessCodeArray)) {
           $accessCodeArray = null;
       }

       $features = [
           [
               'image' => 'https://dmmior4id2ysr.cloudfront.net/redeem/music-lessons-icon.svg',
               'title' => 'Music Lessons',
               'desc' => 'Step-by-step video<br class="hidden sm:inline"> lessons on every topic.',
           ],
           [
               'image' => 'https://dmmior4id2ysr.cloudfront.net/redeem/artist-courses-icon.svg',
               'title' => 'Artist Courses',
               'desc' => 'Courses and live events<br class="hidden sm:inline"> with inspiring musicians ',
           ],
           [
               'image' => 'https://dmmior4id2ysr.cloudfront.net/redeem/songs-icon.svg',
               'title' => '1000+ Songs',
               'desc' => 'Play your favorite songs<br class="hidden sm:inline"> from every style & era.',
           ],
           [
               'image' => 'https://dmmior4id2ysr.cloudfront.net/redeem/24-7-support-icon.svg',
               'title' => '24/7 Support',
               'desc' => 'The largest community<br class="hidden sm:inline"> of students & teachers.',
           ],
       ];
    @endphp

    @foreach ($errors->all() as $error)
        <p class="bg-pianote text-white py-4 w-full text-center">{{ $error }}</p>
    @endforeach

    <header class="sm:px-6 pb-10 sm:py-14 lg:py-20 bg-[#f6f8fc]">
        <div class="container max-w-5xl mx-auto">
            <div class="flex flex-wrap sm:flex-nowrap items-center">
                <div class="w-full sm:w-7/12 sm:pr-8 text-center lg:text-left">
                    <div x-on:click="trailer = true;" class="mb-5 overflow-hidden relative block sm:hidden bg-cover bg-top
{{--                    cursor-pointer autoplay-video--}}
                    " style="padding-bottom: 65%;">
                        <img
                            class="absolute inset-0 object-cover w-full"
                            src="https://www.musora.com/musora-cdn/image/width=600,quality=95/https://dmmior4id2ysr.cloudfront.net/redeem/header-image-m-2.png"
                            alt="Header thumbnail"
                            fetchpriority="high"
                        />
{{--                        <div class="join white smaller absolute bottom-[38px] left-1 bg-white text-black text-sm py-2 px-4 font-normal font-bebas tracking-widest"><i class="fas fa-play"></i> Watch Trailer</div>--}}
                    </div>
                    <div class="px-5 sm:px-0">
                        <h1 class="text-3xl sm:text-4xl lg:text-5xl">
                            <strong>Free music lessons</strong><br>
                            for 30 days.
                        </h1>
                        <h6 class="leading-snug mt-4 mb-4 sm:mb-2">
                            Learn a musical instrument faster with step-by-step lessons, thousands of songs, and unlimited personal support — for all skill levels. <b>Unlock drums, piano, singing, and guitar lessons today with your Musora 30-Day Access Pass.</b>
                        </h6>

                        <div class="flex flex-wrap items-center justify-center sm:justify-center mt-6 sm:mt-5 lg:mt-10 sm:max-w-xs mx-auto lg:mx-0">
                            <a class="w-full join bg-black smaller mb-2 text-[22px] font-bebas text-center font-normal tracking-widest py-4 anchor-slide" href="#redeem">
                                Redeem your pass
                            </a>
                            <p class="text-xs"><i>Try it for free. No credit card is required.</i></p>
                        </div>
                    </div>
                </div>
                <div class="w-full sm:w-5/12 hidden sm:block">
                    <div x-on:click="trailer = true;"
                         class="bg-no-repeat bg-contain rounded-xl aspect-1:1 overflow-auto relative bg-top
{{--                         cursor-pointer autoplay-video--}}
                         " style="background-image:url('https://www.musora.com/musora-cdn/image/width=850,quality=95/https://dmmior4id2ysr.cloudfront.net/redeem/header-image-2.png');"
                    >
{{--                        <div class="join white smaller absolute bottom-1 md:bottom-2 left-[24px] md:left-2 lg:left-3 bg-white text-black text-sm py-2 px-4 font-normal font-bebas tracking-widest"><i class="fas fa-play"></i> &nbsp; Watch Trailer</div>--}}
                    </div>
                </div>
            </div>
            <div class="px-5 sm:px-0">
                <h5 class="uppercase mt-8 lg:mt-12 text-center mb-4 tracking-widest">What’s Inside Musora?</h5>
                <div class="flex flex-wrap sm:flex-nowrap text-center border-2 rounded-xl border-black lg:mb-4 relative overflow-hidden">
                    <div class="z-10 flex flex-wrap sm:flex-nowrap items-start justify-evenly w-full sm:w-auto sm:flex-grow py-4 sm:py-3 lg:py-4 lg:px-5 text-left sm:text-center bg-[#F6F8FC]">
                        @foreach ($features as $key => $feature)
                            <div class="flex sm:block w-full sm:w-auto px-4 sm:px-3 my-2 sm:mb-0">
                                <img
                                    src="https://www.musora.com/musora-cdn/image/width=500,quality=95/{{ $feature['image'] }}"
                                    class="h-5 sm:h-7 mb-2 mr-4 sm:mr-0"
                                    alt="feature image{{$key+1}}"
                                    fetchpriority="high"
                                >
                                <p class="leading-tight mx-0"><strong class="font-black">{{ $feature['title'] }}</strong><br>
                                    <span class="text-sm">{!!  $feature['desc']  !!}</span></p>
                            </div>
                        @endforeach
                    </div>
                    <div class="absolute inset-0 z-0 bg-black" style="opacity: 0.07;"></div>
                </div>
                <p class="mt-3 lg:mt-5 text-center"><em>Join <strong>{{ number_format(Prices::$students) }} active students</strong> worldwide in learning music.</em></p>

            </div>
        </div>
    </header>

    @if(!isset($omit))
        <section class="py-10 sm:py-14 lg:py-20 px-4 sm:px-6">
            <div class="container max-w-5xl mx-auto">
                <h2 class="max-w-4xl mx-auto text-center mb-3"><strong>
                        Unlock drums, piano, singing and guitar lessons today with your Musora 30-Day Access Pass.</strong></h2>
                <div class="flex flex-wrap sm:items-start sm:justify-center text-left">
                    @php
                        $gridItems = [
                            [
                                'image' => 'https://dmmior4id2ysr.cloudfront.net/redeem/step-by-step.jpg',
                                'desc' => '<b>Step-by-step curriculum</b> to advance your core skills, technique, and musicality.',
                            ],
                            [
                                'image' => 'https://dmmior4id2ysr.cloudfront.net/redeem/interactivce-songs.jpg',
                                'desc' => '<b>Interactive songs</b> to solidify your learning with your favorite tunes.',
                            ],
                            [
                                'image' => 'https://dmmior4id2ysr.cloudfront.net/redeem/exclusive-live.jpg',
                                'desc' => '<b>Exclusive live events and courses</b> from world-class instructors.',
                            ],
                            [
                                'image' => 'https://dmmior4id2ysr.cloudfront.net/redeem/lessons-anywhere.jpg',
                                'desc' => '<b>Lessons anywhere, anytime,</b> with any mobile device and downloadable content.',
                            ],
                            [
                                'image' => 'https://dmmior4id2ysr.cloudfront.net/redeem/on-screen-assignments.jpg',
                                'desc' => '<b>On-screen assignments and practice tools</b> to help you see results faster.',
                            ],
                            [
                                'image' => 'https://dmmior4id2ysr.cloudfront.net/redeem/access-community.jpg',
                                'desc' => '<b>PLUS access to our vibrant community of musicians,</b> who share tips and support each other’s progress.',
                            ],
                        ];
                    @endphp

                    @foreach ($gridItems as $key => $gridItem)
                        <div class="sm:flex sm:flex-wrap sm:items-start w-full sm:w-1/2 lg:w-1/3 pb-4 sm:pb-0 px-2 lg:px-4 mb-4 sm:mb-8 border-b sm:border-b-0">
                            <picture>
                                <source media="(min-width:640px)" srcset="https://www.musora.com/musora-cdn/image/width=640,quality=95/{{ $gridItem['image'] }}">
                                <img
                                    class="h-40 sm:h-auto sm:w-full rounded-xl mb-3 transition-opacity opacity-0"
                                    src="https://www.musora.com/musora-cdn/image/width=600,quality=95/{{ $gridItem['image'] }}"
                                    alt="grid{{$key+1}}"
                                    loading="lazy"
                                    onload="this.classList.remove('opacity-0')"
                                >
                            </picture>
                            <p class="leading-normal">
                                {!! $gridItem['desc'] !!}
                            </p>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    <section class="py-10 sm:py-14 lg:py-20 px-4 sm:px-6 @if(!isset($omit)) bg-[#f6f8fc] @endif">
        <div class="container max-w-5xl mx-auto">
            <h2 class="text-center mb-3"><strong>Start achieving <br class="inline sm:hidden"> your musical dreams.</strong></h2>
            <p class="max-w-2xl mx-auto text-center mb-7">
                Musora meets your skill level in your musical journey – from starting a new musical hobby to mastering your technique on an instrument. Access all the resources and teacher support you need to achieve your musical goals.
            </p>
            <h4 class="text-center mb-11"><strong>See what our students have to say…</strong></h4>

            @php
                $testimonials = [
                    [
                        'image' => 'https://dmmior4id2ysr.cloudfront.net/redeem/drumeo-student1.png',
                        'title' => "I’m loving music more than I ever did before!",
                        'name' => 'Ed Koop',
                        'video' => '342059271',
                        'brand' => 'drumeo',
                    ],
                    [
                        'image' => 'https://dmmior4id2ysr.cloudfront.net/redeem/pianote-student1.png',
                        'title' => "I’ve had to give up a lot of my dreams. Then I discovered Pianote.",
                        'description' => "I decided to sign up with Pianote not only to re-learn how to play the piano, but also because my mental health was really suffering and I needed something positive to focus on that was just for ME. I knew almost immediately that this was the answer I had been looking for. It felt like the heaviness on my shoulders got a bit lighter after every piano session.  And even though the lessons are virtual, it was like Lisa was right there beside me cheering me on.<br><br>I was blown away by how quickly I progressed with a few tutorials from Lisa. My overall confidence improved, especially with improvisation. Now I know all these little tricks (fills & riffs) and how to play inversions and practice chords in ways that sound so lovely.  If I had been taught this way as a child, I probably never would have quit.",
                        'name' => 'Serena Dorward',
                        'location' => 'Ontario, Canada',
                        'brand' => 'pianote',
                    ],
                    [
                        'image' => 'https://dmmior4id2ysr.cloudfront.net/redeem/guitareo-student1.png',
                        'title' => "I’ve never felt so much joy playing the guitar.",
                        'description' => "I’ve come so far in such a short period of time. I’ve gone from not even knowing what palm muting was to noodling with the E & A string pentatonic shapes and creating melodies with it – and using it to work on my vibrato, slides, and bends. And I’ve gained priceless info like knowing where to place chords, start power chords, and scale shapes.<br><br>Having the breakthroughs I’ve had so far has brought me confidence and kept me sane while the world is seemingly not – and made me believe there is still a bright future ahead. As I progress, I feel supported towards achieving my goals of jamming with others and using my love for writing to start telling stories through music. All in due time.<br><br>I’m lightyears ahead of where I was at. And no matter where I go, or however tough things get, I’ll always have one of my guitars in the passenger seat and we’ll always be there for each other. The life long journey has begun!",
                        'name' => 'Ërlik Sörensen',
                        'location' => 'British Columbia, Canada',
                        'brand' => 'guitareo',
                    ],
                    [
                        'image' => 'https://dmmior4id2ysr.cloudfront.net/redeem/singeo-student1.png',
                        'title' => "It felt like the chains finally fell off my voice.",
                        'description' => "I was concerned that my singing style was too different to truly learn what I needed – and I wanted to strengthen my voice and stretch my range in a healthy manner.<br><br>With Singeo, I started practicing my songs more meticulously and it paid off – stronger high notes were available and it felt like the chains finally fell off my voice!",
                        'name' => 'Orianna Sells',
                        'location' => 'South Carolina, USA',
                        'brand' => 'singeo',
                    ],
                ]
            @endphp

            <div class="flex flex-wrap text-center" x-data="{
        @foreach($testimonials as $testimonial)
            {{ str_replace(' ', '', $testimonial['name']) }} : false,
        @endforeach
                }">
                @foreach($testimonials as $key => $testimonial)
                    <div class="w-full sm:w-1/2 md:w-1/4 px-4 sm:px-2">
                        <div class="relative mb-2 overflow-hidden cursor-pointer"
                             x-on:click="{{str_replace(' ', '', $testimonial['name'])}} = true;"
                        >
                            <picture>
                                <source media="(min-width:640px)" srcset="https://www.musora.com/musora-cdn/image/width=500,quality=95/{{$testimonial['image']}}">
                                <img
                                    class="h-52 sm:h-auto sm:w-full rounded-xl transition-opacity opacity-0"
                                    src="https://www.musora.com/musora-cdn/image/width=350,quality=95/{{$testimonial['image']}}"
                                    alt="{{$testimonial['name']}} testimonial"
                                    loading="lazy"
                                    onload="this.classList.remove('opacity-0')"
                                >
                            </picture>
                            <div class="absolute inset-0 flex justify-center align-center">
                                <i class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 fas @if(!empty($testimonial['video'])) fa-play @else fa-align-left @endif text-lg text-white border-2 border-white px-3 py-1 rounded-full bg-[#0009] hover:opacity-80"></i>
                            </div>
                        </div>
                        <div class="w-full text-center">
                            <div class="font-bold text-sm leading-snug mb-2">{!! $testimonial['title'] !!}</div>
                            <p class="text-sm">{{ ucfirst($testimonial['brand']) }} Student</p>
                            <p class="mt-1 text-xs text-{{ $testimonial['brand'] }} cursor-pointer" x-on:click="{{str_replace(' ', '', $testimonial['name'])}} = true;">
                                @if(!empty($testimonial['video']))
                                    Watch video
                                @else
                                    Read more
                                @endif
                            </p>
                        </div>
                    </div>

                    @if(!empty($testimonial['video']))
                        @include('_partials.components.video-modal',[
                            'name' => str_replace(' ', '', $testimonial['name']),
                            'video' => $testimonial['video'],
                            'vimeo' => true
                        ])
                    @else
                        @component('_partials.components.modal', ['name' => str_replace(' ', '', $testimonial['name'])])
                            @slot('content')
                                <div class="overflow-hidden max-w-sm mx-auto bg-white">
                                    <img class="w-full h-full" src="{{$testimonial['image']}}" alt="{{$testimonial['name']}}" />
                                    <div class="bg-white p-4">
                                        <h2 class="leading-none font-bebas">{{$testimonial['name']}}</h2>
                                        <p class="text-[#fe9f13] uppercase mx-auto mb-3 md:mb-2">{!!  $testimonial['location'] !!}</p>
                                        <p class="mx-auto mt-2 mb-3 md:mb-2 leading-tight"><strong>{!!  $testimonial['title'] !!}</strong></p>
                                        <p class="mx-auto text-left leading-normal md:leading-normal">{!! $testimonial['description'] !!}</p>
                                    </div>
                                </div>
                            @endslot
                        @endcomponent
                    @endif
                @endforeach
            </div>
        </div>
    </section>

    <div id="redeem" class="anchor block relative invisible"></div>
    <section class="py-10 sm:py-14 lg:py-20 px-4 sm:px-6 text-white bg-[#000C17]" x-data="redeemForm">
        <div class="max-w-5xl mx-auto">
            <div class="flex flex-wrap">
                <div class="w-full sm:w-5/12 lg:w-1/2 sm:pr-4 lg:pr-10 text-center sm:text-left">
                    <h2 class="leading-tight mb-4"><strong>Redeem 30 days of free music lessons with Musora.</strong></h2>
                    <p class="mb-5 sm:mb-10 lg:mb-14">Enter the unique code on your pass to create your Musora account and get started. Once you press submit, you'll have instant access to our vast library of lessons and track your progress as you learn.
                    </p>
                    <img src="https://dmmior4id2ysr.cloudfront.net/redeem/musora-card-new.png" alt="musora card" />
                </div>
                <div class="w-full sm:w-7/12 lg:w-1/2">
                    <h5 class="mt-5 sm:mt-0 font-black text-left md:text-center lg:text-left">Begin your musical journey today <i class="fas fa-arrow-down"></i> </h5>
                    <form
                        id="commentform" name="drumeo" method="post"
                        @submit.prevent="submitRedeem($event)"
                    >
                        <input type="hidden" name="credentials_type" value="new">
                        <div class="flex flex-wrap">
                            <p class="w-full input-describer">Code</p>
                            <input class="default-form-field uppercase" x-bind:class="{ 'border border-[#EF4444] bg-[#FECACA] text-black mb-1.5': errors.access_code }" type="text" name="access_code" maxlength="29" placeholder="XXXX - XXXX - XXXX - XXXX - XXXX - XXXX" x-mask="**** **** **** **** **** ****" value="" x-bind:disabled="loading" />
                            <span class="text-xs text-[#EF4444]" x-show="errors.access_code" x-text="errors.access_code"></span>
                        </div>
                        <p class="input-describer">Email Address</p>
                        <input class="default-form-field" x-bind:class="{ 'border border-[#EF4444] bg-[#FECACA] text-black': errors.email }" type="text" id="email" name="email" placeholder="Email Address" value="{{-- Input::old('email') --}}">
                        <span class="text-xs text-[#EF4444]" x-show="errors.email" x-text="errors.email"></span>
                        <p class="input-describer">Password (min. 8 characters)</p>
                        <input class="default-form-field" x-bind:class="{ 'border border-[#EF4444] bg-[#FECACA] text-black': errors.password }" type="password" id="password" name="password" placeholder="Password (min. 8 characters)" value="">
                        <span class="text-xs text-[#EF4444]" x-show="errors.password" x-text="errors.password"></span>
                        <p class="input-describer">Confirm Password</p>
                        <input class="default-form-field" x-bind:class="{ 'border border-[#EF4444] bg-[#FECACA] text-black': errors.passwordCheck }" type="password" id="password_confirmation" name="password_confirmation" placeholder="Confirm Password" value="">
                        <span class="text-xs text-[#EF4444]" x-show="errors.passwordCheck" x-text="errors.passwordCheck"></span>
                        <div class="text-center">
                            <button
                                class="apply hover:opacity-80 transition-opacity lg:w-2/3"
                                :class="loading ? 'bg-[#B2D4F4] text-black' : !isValid ? 'bg-[#B91C1C] ttext-white' : submitted ? 'bg-[#15803D] text-white' : 'bg-white text-black'"
                                type="submit"
                            >
                                <span x-show="!loading && isValid && !submitted">Redeem your pass</span>
                                <span x-show="loading"><i class="fa-solid fa-spinner mr-1"></i> Loading</span>
                                <span x-show="!isValid"><i class="fa-solid fa-rotate-left mr-1"></i> Retry submission</span>
                                <span x-show="submitted"><i class="fa-solid fa-check mr-1"></i>Successfully Submitted</span>
                            </button>
                            <p class="text-xs mt-3 mb-5">
                                <em>No purchase is required. Try it for free.</em>
                            </p>
                            <p class="leading-tight opacity-60"><em>
                                    <b>** 30-Day Access Passes are for new students only. **</b><br>
                                    Cannot be redeemed for renewals, upgrades, or extensions.</em></p>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>

    @include('_partials.components.forms.redeem-form-script', ['api' => get_musora_brand_base_url().'/ecommerce/access-codes/redeem'])
@endsection
