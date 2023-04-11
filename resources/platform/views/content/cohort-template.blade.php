@extends('partials.layout')

@section('meta')
    <title>Cohort Template | Musora</title>
@endsection

@section('styles')
    <script defer src="https://cdnjs.cloudflare.com/ajax/libs/alpinejs/3.12.0/cdn.min.js"></script>
@endsection

@section('content')
    <div x-data="{ trailer: false }">
        <header class="tw-bg-[#F1F7FE] tw-py-4 md:tw-py-7 tw-px-4">
            <div class="tw-max-w-5xl tw-mx-auto">
                <div class="md:tw-flex tw-items-center tw-gap-6 tw-mb-12 tw-text-center md:tw-text-left">
                    <div class="md:tw-flex-1">
                        <img class="tw-h-14 sm:tw-h-18 lg:tw-h-20 tw-mb-2 tw-inline-block" alt="header logo" src="https://www.musora.com/musora-cdn/image/width=440,quality=85/{{ $cohort['header_logo']??'' }}">
                        <h1 class="tw-font-extrabold tw-text-3xl lg:tw-text-4xl">{{ $cohort['headline'] }}</h1>
                        <h2 class="tw-font-normal tw-text-2xl lg:tw-text-3xl">{{ $cohort['subheadline'] }}</h2>
                        <p class="tw-font-bold tw-mt-4 lg:tw-mt-6 tw-mb-7 lg:tw-mb-9">{{ $cohort['header_description'] }}</p>
                        <div class="tw-relative md:tw-hidden">
                            <img class="tw-rounded-xl tw-mb-6" src="https://www.musora.com/musora-cdn/image/width=850,quality=85/{{ $cohort['header_image_url'] }}" alt="header thumb" />
                            <div class="tw-absolute tw-bottom-4 tw-left-4 tw-bg-white tw-rounded-full tw-uppercase tw-font-bebas-neue tw-px-5 tw-py-1 tw-flex tw-items-center tw-cursor-pointer" x-on:click="trailer = true"><i class="fas fa-play tw-mr-2" aria-hidden="true"></i> <div class="tw-mt-1">Watch Trailer</div></div>
                        </div>
                        <div class="md:tw-flex md:tw-items-center">
                            @if($hasProduct)
                                <a class="join sold-out medium w-full">YOU'RE ENROLLED!</a>
                            @else
                                <a href="{{ $registerButtonUrl }}" class="tw-uppercase tw-bg-{{ $brand }} tw-rounded-full tw-py-2 tw-w-full md:tw-w-1/2 tw-text-white tw-text-center tw-font-bebas-neue tw-mr-2 tw-max-w-[415px] tw-inline-block tw-mb-5 md:tw-mb-0">Enroll Now</a>
                            @endif

                            <div class="md:tw-w-1/2 tw-flex tw-items-center tw-justify-center md:tw-justify-start">
                                <img class="tw-h-8 md:tw-h-6 tw-mr-1" src="https://www.musora.com/musora-cdn/image/width=100,quality=85/https://d2vyvo0tyx8ig5.cloudfront.net/products/new-piano-players/joined_profiles.png" alt="joined student profiles">
                                <p class="tw-text-xs tw-align-middle tw-max-w-[180px] md:tw-max-w-full tw-text-left">
                                    Join {{ number_format($nPackOwners ?? 0) }}
                                    @php
                                        if($brand === 'drumeo'){
                                            echo 'drummers';
                                        } else if($brand === 'pianote'){
                                            echo 'piano players';
                                        }
                                    @endphp
                                    who have already registered.
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="md:tw-flex-1 tw-hidden md:tw-block tw-relative">
                        <img class="tw-rounded-xl" src="https://www.musora.com/musora-cdn/image/width=850,quality=85/{{ $cohort['header_image_url'] }}" alt="header thumb" />
                        <div class="tw-absolute tw-bottom-4 tw-left-4 tw-bg-white tw-rounded-full tw-uppercase tw-font-bebas-neue tw-px-5 tw-py-1 tw-flex tw-items-center tw-cursor-pointer" x-on:click="trailer = true"><i class="fas fa-play tw-mr-2" aria-hidden="true"></i> <div class="tw-mt-1">Watch Trailer</div></div>
                    </div>
                </div>
                <div class="tw-flex tw-flex-wrap sm:tw-flex-nowrap tw-text-center tw-border tw-rounded-lg tw-border-gray-300 tw-mb-2 lg:tw-mb-4">
                    <div class="tw-w-full sm:tw-w-auto tw-border-b sm:tw-border-b-0 sm:tw-border-r tw-border-gray-300 tw-py-4 sm:tw-py-3 lg:tw-py-4">
                        <p class="tw-tracking-wide tw-opacity-70 tw-text-sm">STARTS ON</p>
                        <h4 class="tw-px-3 lg:tw-px-5"><strong>{{date('F dS', strtotime($cohort['start_date']))}}</strong></h4>
                        <hr class="tw-border-gray-300 tw-my-4 sm:tw-my-2 lg:tw-my-4">
                        <p class="tw-text-sm tw-px-3 lg:tw-px-5">
                            @if($enrollmentClosed)
                                Enrollment closed
                            @else
                            @php
                                $startDate = strtotime(now());
                                $endDate = strtotime($cohort['end_date']);
                                $diff = abs($endDate - $startDate);
                                $my_t=getdate($diff);

                            @endphp
                                Enrollment closes in <strong>{{$my_t['mday']}} days {{$my_t['hours']}} hours {{$my_t['minutes']}} minutes</strong>.
                            @endif
                        </p>
                    </div>
                    <div class="tw-flex tw-flex-wrap sm:tw-flex-nowrap tw-items-center tw-justify-evenly tw-w-full sm:tw-w-auto sm:tw-flex-grow tw-py-4 sm:tw-py-3 lg:tw-py-4 tw-text-left sm:tw-text-center">
                        <div class="tw-flex sm:tw-block tw-w-full sm:tw-w-auto tw-px-4 sm:tw-px-3 tw-mb-4 sm:tw-mb-0">
                            <i class="far fa-fw {{ $cohort['icon1'] }} tw-mr-3 sm:tw-mr-0 tw-text-{{ $brand }} tw-text-2xl" aria-hidden="true"></i>
                            <p class="tw-leading-tight tw-mx-0"><strong class="tw-font-black">{{ $cohort['icon1_title'] }}</strong><br>
                                <span class="tw-text-sm"> February 27th to<br class="tw-hidden sm:tw-inline">{!!$cohort['icon1_copy']!!}</span></p>
                        </div>
                        <div class="tw-flex sm:tw-block tw-w-full sm:tw-w-auto tw-px-4 sm:tw-px-3 tw-mb-4 sm:tw-mb-0">
                            <i class="far fa-fw {{ $cohort['icon2'] }} tw-mr-3 sm:tw-mr-0 tw-text-{{ $brand }} tw-text-2xl" aria-hidden="true"></i>
                            <p class="tw-leading-tight tw-mx-0"><strong class="tw-font-black">{{ $cohort['icon2_title'] }}</strong><br>
                                <span class="tw-text-sm">10 minutes/day<br class="tw-hidden sm:tw-inline">{{ $cohort['icon2_copy'] }}</span></p>
                        </div>
                        <div class="tw-flex sm:tw-block tw-w-full sm:tw-w-auto tw-px-4 sm:tw-px-3">
                            <i class="far fa-fw {{ $cohort['icon3'] }} tw-mr-3 sm:tw-mr-0 tw-text-{{ $brand }} tw-text-2xl" aria-hidden="true"></i>
                            <p class="tw-leading-tight tw-mx-0"><strong class="tw-font-black">{!! $cohort['icon3_title'] !!}</strong><br>
                                <span class="tw-text-sm">{!! $cohort['icon3_copy'] !!}</span></p>
                        </div>
                    </div>
                </div>
            </div>
        </header>

        <section class="tw-bg-white tw-pt-7">
            <div class="tw-max-w-5xl tw-mx-auto tw-px-4 md:tw-px-10">
                <h3 class="tw-font-extrabold tw-text-center tw-mb-7">{{ $cohort['body_title'] }}</h3>
                <p class="md:tw-px-10 tw-mb-52">{!! $cohort['body_top_description'] !!}</p>
            </div>
        </section>
        <section class="tw-bg-[#F1F7FE] tw-pb-7">
            <div class="tw-max-w-5xl tw-mx-auto tw-px-4 md:tw-px-10 -tw-mt-40">
                <div class="tw-relative tw-cursor-pointer tw-mb-10" x-on:click="trailer = true">
                    <img class="tw-rounded-xl" src="{{ $cohort['body_image_url'] }}" alt="video thumb" />
                    <div class="tw-absolute tw-inset-0 tw-flex tw-justify-center tw-items-center">
                        <i class="fa-regular fa-play tw-z-10 tw-border-white tw-border-4 tw-text-white tw-py-3 md:tw-py-6 tw-pl-5 md:tw-pl-8 tw-pr-4 md:tw-pr-6 tw-rounded-full tw-text-3xl md:tw-text-5xl tw-bg-[rgba(0,0,0,0.2)]"></i>
                    </div>
                </div>
                <img class="tw-h-10 sm:tw-h-16 tw-mb-8 tw-mx-auto" alt="just play logo" src="https://www.musora.com/musora-cdn/image/width=1220,quality=85/{{ $cohort['body_logo'] }}">
                <p class="tw-text-center tw-px-6">{!! $cohort['body_bottom_description'] !!}</p>
            </div>
        </section>

        @php
            $faqs = [
                [
                    "title" => "What is Pianote?",
                    "desc" => 'Pianote is an online platform that offers an organized piano lesson curriculum, artist courses on popular topics, 1000+ songs transcribed note-for-note, and a supportive global community of students and teachers.',
                ],
                [
                    "title" => "Is Pianote good for beginners?",
                    "desc" => 'Yes! You’ll always know what to practice with step-by-step video lessons – plus have fun applying your new skills to your favorite songs, sorted by skill level. And if you ever need help, you’ll have unlimited personal support through live Q&A sessions, student reviews, and a helpful community. ',
                ],
                [
                    "title" => "Does Pianote have anything for advanced pianists?",
                    "desc" => 'Pianote is the perfect companion for advanced pianists, giving you access to artist courses so you can gain insights and inspiration from professionals. Plus, you’ll get note-for-note sheet music for thousands of songs and practical playback tools, so you can take on any new challenge with confidence.',
                ],
                [
                    "title" => "Am I too old to learn piano?",
                    "desc" => 'You’re never too old to learn piano. Pianote has a community of students of all ages, from all around the world. Whether you’re 40, 50, 60, 70, or beyond – you’ll connect with aspiring pianists just like you who are learning and applying their skills to music.',
                ],
                [
                    "title" => "Do I need to be tech-savvy to learn through your app?",
                    "desc" => 'Not at all! Technology is here to make your life easier, and Pianote is designed to help you find lessons and songs easily. And if you ever get stuck, you can contact our Student Experience team by phone or email for prompt and helpful support.',
                ],
            ]
        @endphp

        <section class="tw-bg-white tw-py-7">
            <div class="tw-max-w-4xl tw-mx-auto tw-pl-6 tw-pr-4">
                <h3 class="tw-font-extrabold tw-text-center tw-mb-7">{{ $cohort['dropdown_title'] }}</h3>
                @foreach($cohort->dropdowns as $dropdown)
                    @include('partials._question-dropdown', [
                        'num' => '?',
                        "title" => $dropdown['title'],
                        "desc" => $dropdown['description'],
                    ])
                @endforeach
                <h3 class="tw-font-extrabold tw-text-center tw-mt-10">{{ $cohort['bottom_title'] }}</h3>
                <p class="tw-font-bold tw-text-center tw-mt-4 tw-mb-6">{{ $cohort['bottom_description'] }}</p>
                <div class="tw-max-w-[415px] md:tw-max-w-xl tw-mx-auto tw-flex tw-flex-col md:tw-flex-row md:tw-gap-2 tw-mb-4">
                    @if($hasProduct)
                        <a class="join sold-out medium w-full">YOU'RE ENROLLED!</a>
                    @else
                    <a class="tw-uppercase tw-bg-{{ $brand }} tw-rounded-full tw-py-2 tw-w-full md:tw-w-1/2 tw-text-white tw-text-center tw-font-bebas-neue tw-mb-2 md:tw-mb-0">Enroll Now</a>
                    @endif
                    <a class="tw-uppercase tw-border-2 tw-border-black tw-rounded-full tw-py-2 tw-w-full md:tw-w-1/2 tw-text-center tw-font-bebas-neue tw-text-black">Join the conversation</a>
                </div>
                <div class="tw-max-w-[250px] tw-mx-auto tw-flex tw-justify-center tw-items-center">
                    <img class="tw-h-7 sm:tw-mb-1 lg:tw-mb-0 tw-mr-1" src="https://www.musora.com/musora-cdn/image/width=100,quality=85/https://d2vyvo0tyx8ig5.cloudfront.net/products/new-piano-players/joined_profiles.png" alt="joined student profiles">
                    <p class="tw-text-xs tw-align-middle">Join {{ number_format($nPackOwners ?? 0) }} piano players who have already registered.</p>
                </div>
            </div>
        </section>

        @include('partials.modals._video-modal',[
            'name' => "trailer",
            "video" => $cohort['cohort_trailer'],
        ])
    </div>
@endsection
