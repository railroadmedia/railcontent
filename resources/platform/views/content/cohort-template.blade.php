@extends('partials.layout')

@section('meta')
    <title>Cohort Enrollment | Musora</title>
@endsection

@section('styles')
    <script defer src="https://cdnjs.cloudflare.com/ajax/libs/alpinejs/3.12.0/cdn.min.js"></script>
@endsection

@section('body-data')
    x-data="{
        ...timer(),
        trailer: false,
        trailerFirstDay: false,
        trailerLastDay: false,
        trailerDemo: false,
    }"

    x-init="countdown()"
@endsection

@section('content')
        <header class="tw-bg-[#F1F7FE] tw-py-4 md:tw-py-7 tw-px-4">
            <div class="tw-max-w-5xl tw-mx-auto">
                <div class="md:tw-flex tw-items-center tw-gap-6 tw-mb-12 tw-text-center md:tw-text-left">
                    <div class="md:tw-flex-1">
                        {{--  Header logo  --}}
                        <img class="tw-h-14 sm:tw-h-18 lg:tw-h-20 tw-mb-2 tw-inline-block " alt="header logo" src="https://www.musora.com/musora-cdn/image/width=440,quality=85/{{ $cohort['light_mode_logo']??'' }}" />
                        {{--  Headline  --}}
                        <h1 class="tw-font-extrabold tw-text-3xl lg:tw-text-4xl">{{ $cohort['headline'] }}</h1>
                        {{--  Subheadline  --}}
                        <h2 class="tw-font-normal tw-text-2xl lg:tw-text-3xl">{{ $cohort['subheadline'] }}</h2>
                        {{--  Header description  --}}
                        <p class="tw-font-bold tw-mt-4 lg:tw-mt-6 tw-mb-7 lg:tw-mb-9">{{ $cohort['header_description'] }}</p>
                        {{--  Mobile Header Image --}}
                        <div class="tw-relative md:tw-hidden">
                            <img
                                class="tw-rounded-xl tw-mb-6 tw-transition-opacity tw-opacity-0"
                                src="https://www.musora.com/musora-cdn/image/width=850,quality=85/{{ $cohort['header_image_url'] }}"
                                alt="header thumb"
                                loading="lazy"
                                onload="this.classList.remove('tw-opacity-0')"
                            />
                            <div class="tw-absolute tw-bottom-4 tw-left-4 tw-bg-white tw-rounded-full tw-uppercase tw-font-bebas-neue tw-px-5 tw-py-1 tw-flex tw-items-center tw-cursor-pointer" x-on:click="trailer = true"><i class="fas fa-play tw-mr-2" aria-hidden="true"></i> <div class="tw-mt-1">Watch Trailer</div></div>
                        </div>
                        <div class="md:tw-flex @if($hasProduct) md:tw-items-start @else md:tw-items-center @endif">
                            {{--  Buttons  --}}
                            @if($hasProduct)
                                <div class="tw-w-full md:tw-w-1/2 md:tw-mr-2 tw-text-center">
                                    <span class="tw-btn-primary tw-bg-[#65656B] tw-w-full tw-text-white tw-cursor-default">YOU'RE ENROLLED!</span>
                                    <a href="{{$cohort['course_url']}}" class="tw-text-[#65656B] tw-underline tw-italic tw-text-sm tw-inline-block tw-mb-2 md:tw-mb-0">View the course now!</a>
                                </div>
                            @else
                                <span x-cloak x-show="timeLeft < 0" class="tw-btn-primary tw-bg-[#65656B] tw-w-full md:tw-w-1/2 md:tw-mr-2 tw-text-white tw-cursor-default">Enrollment Closed</span>
                                <button x-cloak x-show="timeLeft > 0" onclick="enroll('{{ $registerButtonUrl }}');" class="tw-btn-primary tw-bg-{{ $brand }} tw-w-full md:tw-w-1/2 md:tw-mr-2 tw-max-w-[415px] tw-mb-5 md:tw-mb-0 hover:tw-bg-{{ $brand }}-600">Enroll Now</button>
                            @endif
                            <div class="md:tw-w-1/2 tw-flex tw-items-center tw-justify-center md:tw-justify-start @if($hasProduct) md:tw-mt-2 @endif">
                                <img
                                    class="tw-h-8 md:tw-h-6 tw-mr-1 tw-transition-opacity tw-opacity-0"
                                    src="https://www.musora.com/musora-cdn/image/width=100,quality=85/https://d2vyvo0tyx8ig5.cloudfront.net/products/new-piano-players/joined_profiles.png"
                                    alt="joined student profiles"
                                    loading="lazy"
                                    onload="this.classList.remove('tw-opacity-0')"
                                />
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
                    {{--  Tablet/Desktop Header Image  --}}
                    <div class="md:tw-flex-1 tw-hidden md:tw-block tw-relative">
                        <img
                            class="tw-rounded-xl tw-transition-opacity tw-opacity-0"
                            src="https://www.musora.com/musora-cdn/image/width=850,quality=85/{{ $cohort['header_image_url'] }}"
                            alt="header thumb"
                            loading="lazy"
                            onload="this.classList.remove('tw-opacity-0')"
                        />
                        <div class="tw-absolute tw-bottom-4 tw-left-4 tw-bg-white tw-rounded-full tw-uppercase tw-font-bebas-neue tw-px-5 tw-py-1 tw-flex tw-items-center tw-cursor-pointer" x-on:click="trailer = true"><i class="fas fa-play tw-mr-2" aria-hidden="true"></i> <div class="tw-mt-1">Watch Trailer</div></div>
                    </div>
                </div>
                <div class="tw-flex tw-flex-wrap sm:tw-flex-nowrap tw-text-center tw-border tw-rounded-lg tw-border-gray-300 tw-mb-2 lg:tw-mb-4">
                    <div class="tw-w-full sm:tw-w-auto tw-border-b sm:tw-border-b-0 sm:tw-border-r tw-border-gray-300 tw-py-4 sm:tw-py-3 lg:tw-py-4">
                        <p class="tw-tracking-wide tw-opacity-70 tw-text-sm">STARTS ON</p>
                        <h4 class="tw-px-3 lg:tw-px-5"><strong>{{date('F jS', strtotime('+1 hour',strtotime($cohort['cohort_start_date'])))}}</strong></h4>
                        <hr class="tw-border-gray-300 tw-my-4 sm:tw-my-2 lg:tw-my-4">
                        <p class="tw-text-sm tw-px-3 lg:tw-px-5">
                            {{--  Countdown  --}}
                             <span x-cloak>
                                 <span x-cloak x-show="timeLeft > 0">Enrollment closes in </span>
                                 <span class="tw-text-pianote">
                                     <span x-cloak x-show="timeLeft > 0 && day > 0"><span x-text="day"></span><span x-text="dayText"></span></span> <span x-cloak x-show="timeLeft > 0 && hour > 0"><span x-text="hour"></span><span x-text="hourText"></span></span> <span x-cloak x-show="timeLeft > 0"><span x-text="minute"></span><span x-text="minuteText"></span></span> <span x-cloak x-show="timeLeft > 0"><span x-text="second"></span><span x-text="secondText"></span></span>
                                     <span x-cloak x-show="timeLeft < 0">Enrollment closed</span>
                                 </span>.
                             </span>
                        </p>
                    </div>
                    {{--  Icons/Title/Copies  --}}
                    <div class="tw-flex tw-items-center sm:tw-justify-center sm:tw-flex-grow">
                        <div class="tw-flex tw-flex-wrap tw-justify-evenly tw-w-full sm:tw-w-auto tw-py-4 sm:tw-py-3 lg:tw-py-4 tw-text-left sm:tw-text-center">
                            <div class="tw-flex sm:tw-flex-col sm:tw-flex-1 tw-w-full sm:tw-w-1/3 tw-px-4 sm:tw-px-3 tw-mb-4 sm:tw-mb-0">
                                <div class="tw-text-center">
                                    <i class="far fa-fw fa-calendar-day tw-mr-3 sm:tw-mr-0 tw-text-{{ $brand }} tw-text-3xl sm:tw-mb-1" aria-hidden="true"></i>
                                </div>
    {{--                            <img--}}
    {{--                                class="tw-mr-3 tw-h-[30px] sm:tw-mb-1 sm:tw-mx-auto"--}}
    {{--                                alt="icon 1"--}}
    {{--                                src="https://www.musora.com/musora-cdn/image/width=60,quality=85/{{ $cohort['icon1_url'] }}"--}}
    {{--                                loading="lazy"--}}
    {{--                                onload="this.classList.remove('tw-opacity-0')"--}}
    {{--                            />--}}
                                <p class="tw-leading-tight tw-mx-0"><strong class="tw-font-black">{{ $cohort['icon1_title'] }}</strong><br>
                                    <span class="tw-text-sm">{!!$cohort['icon1_copy']!!}</span></p>
                            </div>
                            <div class="tw-flex sm:tw-flex-col sm:tw-flex-1 tw-w-full sm:tw-w-1/3 tw-px-4 sm:tw-px-3 tw-mb-4 sm:tw-mb-0">
                                <div class="tw-text-center">
                                    <i class="far fa-fw fa-clock tw-mr-3 sm:tw-mr-0 tw-text-{{ $brand }} tw-text-3xl sm:tw-mb-1" aria-hidden="true"></i>
                                </div>
    {{--                            <img--}}
    {{--                                class="tw-mr-3 tw-h-[30px] sm:tw-mb-1 sm:tw-mx-auto"--}}
    {{--                                alt="icon 2"--}}
    {{--                                src="https://www.musora.com/musora-cdn/image/width=60,quality=85/{{ $cohort['icon2_url'] }}"--}}
    {{--                                loading="lazy"--}}
    {{--                                onload="this.classList.remove('tw-opacity-0')"--}}
    {{--                            />--}}
                                <p class="tw-leading-tight tw-mx-0"><strong class="tw-font-black">{{ $cohort['icon2_title'] }}</strong><br>
                                    <span class="tw-text-sm">{{ $cohort['icon2_copy'] }}</span></p>
                            </div>
                            <div class="tw-flex sm:tw-flex-col sm:tw-flex-1 tw-w-full sm:tw-w-1/3 tw-px-4 sm:tw-px-3">
                                <div class="tw-text-center">
                                    <i class="far fa-fw fa-trophy tw-mr-3 sm:tw-mr-0 tw-text-{{ $brand }} tw-text-3xl sm:tw-mb-1" aria-hidden="true"></i>
                                </div>
    {{--                            <img--}}
    {{--                                class="tw-mr-3 tw-h-[30px] sm:tw-mb-1 sm:tw-mx-auto"--}}
    {{--                                alt="icon 3"--}}
    {{--                                src="https://www.musora.com/musora-cdn/image/width=60,quality=85/{{ $cohort['icon3_url'] }}"--}}
    {{--                                loading="lazy"--}}
    {{--                                onload="this.classList.remove('tw-opacity-0')"--}}
    {{--                            />--}}
                                <p class="tw-leading-tight tw-mx-0"><strong class="tw-font-black">{!! $cohort['icon3_title'] !!}</strong><br>
                                    <span class="tw-text-sm">{!! $cohort['icon3_copy'] !!}</span></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </header>

        <section class="tw-bg-white tw-py-12">
            <div class="tw-max-w-5xl tw-mx-auto tw-px-4 md:tw-px-10">
                {{--  Body title  --}}
                <h3 class="tw-font-extrabold tw-text-center tw-mb-7">{{ $cohort['body_title'] }}</h3>
                {{--  Body top description  --}}
                <p class="md:tw-px-10 tw-mb-7">{!! $cohort['body_top_description'] !!}</p>
                <img class="sm:tw-h-7 tw-mx-auto" src="https://www.musora.com/musora-cdn/image/width=690,quality=85/https://d2vyvo0tyx8ig5.cloudfront.net/products/easy-chords/timeline.png" alt="timeline">
                <div class="tw-flex tw-flex-wrap tw-text-left tw-max-w-3xl tw-mx-auto tw-mt-5 sm:tw-mt-7 tw-mb-10 sm:tw-mb-14 lg:tw-mb-20">
                    <div class="tw-w-1/2 tw-pr-2 sm:tw-px-4">
                        <div class="tw-rounded-xl tw-overflow-hidden tw-shadow-md tw-cursor-pointer autoplay-video" data-open="dayOne" aria-controls="dayOne" aria-haspopup="true" tabindex="0">
                            <img src="https://www.musora.com/musora-cdn/image/width=850,quality=85/{{ $cohort['description_trailer_1_thumb_url'] }}" alt="day1 thumb" loading="lazy" onload="this.classList.remove('opacity-0')" x-on:click="trailerFirstDay = true">
                            <p class="tw-p-2 sm:tw-p-5 tw-text-sm">We’ll start slow. Here’s what you’ll be playing in your first lesson.</p>
                        </div>
                    </div>
                    <div class="tw-w-1/2 sm:tw-px-4">
                        <div class="tw-rounded-xl tw-overflow-hidden tw-shadow-md tw-cursor-pointer autoplay-video" data-open="dayThirty" aria-controls="dayThirty" aria-haspopup="true" tabindex="0">
                            <img src="https://www.musora.com/musora-cdn/image/width=850,quality=85/{{ $cohort['description_trailer_2_thumb_url'] }}" alt="day 30 thumb" loading="lazy" onload="this.classList.remove('opacity-0')" x-on:click="trailerLastDay = true">
                            <p class="tw-p-2 sm:tw-p-5 tw-text-sm">After 30 days, you’ll be playing this beautiful song. All you have to do is follow along.</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="tw-text-center tw-text-white  tw-bg-cover tw-bg-center" style="background-color:#2a2f34;">
            <div class="tw-max-w-[1600px] tw-mx-auto tw-relative tw-pt-10 sm:tw-pt-14 lg:tw-pt-20">
                <img class="tw-absolute tw-w-full tw-h-full tw-left-0 tw-top-0 tw-object-cover" src="https://www.musora.com/musora-cdn/image/width=1500,quality=85/{{ $cohort['demo_background_image_url'] }}" alt="bg" />
                <h3 class="tw-leading-tight tw-relative"><strong>{!! $cohort['demo_title_text'] !!}</strong></h3>
                <p class="tw-leading-normal tw-mt-2 sm:tw-mt-3 tw-mb-5 sm:tw-mb-7 tw-relative tw-px-4 sm:tw-px-0">{!! $cohort['demo_description_text'] !!}</p>
                <div class="tw-relative">
                    <img class="tw-inline-block sm:tw-hidden tw-w-full tw-transition-all tw-cursor-pointer" src="https://www.musora.com/musora-cdn/image/width=1500,quality=85/{{ $cohort['demo_mobile_center_image_url'] }}" alt="tablet piano" loading="lazy" onload="this.classList.remove('opacity-0')" x-on:click=" trailerDemo = true;">
                    <img class="tw-hidden sm:tw-inline-block tw-w-full tw-transition-all tw-cursor-pointer" src="https://www.musora.com/musora-cdn/image/width=1500,quality=85/{{ $cohort['demo_desktop_center_image_url'] }}" alt="tablet piano" loading="lazy" onload="this.classList.remove('opacity-0')" x-on:click=" trailerDemo = true;">
                    <div class="tw-absolute tw-w-full tw-top-2/3 tw-flex tw-justify-center tw-px-4 sm:tw-px-0">
                        <p class="tw-px-3 tw-py-1 tw-z-10 tw-rounded-xl tw-text-white tw-text-sm tw-bg-[#C20000]"><i class="fas fa-play-circle tw-mr-1 tw-text-xl sm:tw-text-3xl tw-align-middle" aria-hidden="true"></i> {!! $cohort['demo_label_text'] !!}</p>
                    </div>
                </div>
            </div>
        </section>

        {{--  Dropdown  --}}
        <section class="tw-bg-white tw-py-12">
            <div class="tw-max-w-5xl tw-mx-auto tw-pl-6 tw-pr-4">
                <div class="tw-text-center tw-mb-3">
                    <img class="tw-h-20 md:tw-h-24 lg:tw-h-28 tw-transition-all tw-mx-auto" src="https://www.musora.com/musora-cdn/image/width=380,quality=85/{{ $cohort['body_logo'] }}" alt="logo" loading="lazy" onload="this.classList.remove('opacity-0')">
                    <h4 class="tw-leading-tight tw-mt-2 tw-mb-4 sm:tw-my-4 lg:tw-my-5"><strong>{!! $cohort['body_bottom_description'] !!}</strong></h4>
                    <div class="tw-w-full tw-mx-auto sm:tw-mx-0">
                        @foreach($cohort->lists as $item)
                            <p class="tw-leading-tight tw-mb-2 sm:tw-mb-3"><i class="fas fa-check tw-text-pianote tw-mr-1" aria-hidden="true"></i> {{$item['description']}}</p>
                        @endforeach

                    </div>
                </div>
                <div class="tw-max-w-[415px] md:tw-max-w-xl tw-mx-auto tw-flex tw-flex-col md:tw-flex-row md:tw-gap-2 tw-mb-4 tw-justify-center">
                    {{--  Buttons  --}}
                    @if($hasProduct)
                        <span class="tw-btn-primary tw-bg-[#65656B] tw-w-full md:tw-w-1/2 tw-mb-2 md:tw-mb-0 tw-cursor-default">YOU'RE ENROLLED!</span>
                    @else
                        <span x-cloak x-show="timeLeft < 0" class="tw-btn-primary tw-bg-[#65656B] tw-w-full tw-text-white tw-cursor-default">Enrollment Closed</span>
                        <button x-cloak x-show="timeLeft > 0" onclick="enroll('{{ $registerButtonUrl }}');" class="tw-btn-primary tw-bg-{{ $brand }} tw-w-full md:tw-w-1/2 tw-text-white tw-mb-2 md:tw-mb-0 hover:tw-bg-{{ $brand }}-600">Enroll Now</button>
                        @if(!empty($cohort['conversation_url']))
                            <a href="{{$cohort['conversation_url']}}" class="tw-btn-secondary tw-border-black tw-w-full md:tw-w-1/2 tw-text-black hover:tw-bg-black hover:tw-text-white">Join the conversation</a>
                        @endif
                    @endif
                </div>
                <div class="tw-max-w-[250px] tw-mx-auto tw-flex tw-justify-center tw-items-center tw-mb-12">
                    <img
                        class="tw-h-7 sm:tw-mb-1 lg:tw-mb-0 tw-mr-1 tw-transition-opacity tw-opacity-0"
                        src="https://www.musora.com/musora-cdn/image/width=100,quality=85/https://d2vyvo0tyx8ig5.cloudfront.net/products/new-piano-players/joined_profiles.png"
                        alt="joined student profiles"
                        loading="lazy"
                        onload="this.classList.remove('tw-opacity-0')"
                    />
                    <p class="tw-text-xs tw-align-middle">
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
                <h3 class="tw-font-extrabold tw-text-center tw-mb-7">{{ $cohort['dropdown_title'] }}</h3>
                @foreach($cohort->dropdowns as $dropdown)
                    @include('partials._question-dropdown', [
                        'num' => '?',
                        "title" => $dropdown['title'],
                        "desc" => $dropdown['description'],
                    ])
                @endforeach
            </div>
        </section>

        {{--  Signup modal  --}}
        <div id="signupModal" class="modal">
            <div class="tw-flex tw-justify-center tw-items-center">
                <div class="tw-max-w-xl tw-bg-white dark:tw-bg-[#081825] tw-text-center dark:tw-text-white tw-rounded-xl tw-px-8 tw-py-10 dark:tw-border-[#445F74] dark:tw-border">
                    <img class="tw-h-20 tw-mx-auto tw-mb-5 dark:tw-hidden" src="https://www.musora.com/musora-cdn/image/width=440,quality=85/{{ $cohort['light_mode_logo']??'' }}" alt="modal logo" />
                    <img class="tw-h-20 tw-mx-auto tw-mb-5 tw-hidden dark:tw-inline-block" src="https://www.musora.com/musora-cdn/image/width=440,quality=85/{{ $cohort['dark_mode_logo']??'' }}" alt="modal logo" />
                    <div class="tw-text-2xl tw-font-bold tw-mb-1">Success, You’re Enrolled!</div>
                    <p class="tw-mb-5">
                        The course runs from {{ date('F jS', strtotime('+1 hour', strtotime($cohort['cohort_start_date']))) }} - {{ date('F jS', strtotime('+1 hour', strtotime($cohort['cohort_end_date']))) }}. We’ll notify you before the course begins.
                    </p>
                    <div>
                        <a href="{{$homeUrl}}" class="tw-btn-primary tw-border-[#000C17] tw-text-[#000C17] hover:tw-bg-[#00101D] hover:tw-text-white dark:tw-bg-[#000C17] dark:tw-border-white dark:tw-text-white tw-mr-2 dark:hover:tw-bg-white dark:hover:tw-text-[#000C17]">Go home</a>
                        <a href="{{$cohort['course_url']}}" class="tw-btn-primary tw-bg-[#00101D] tw-text-white hover:tw-bg-[#3F3F46] dark:tw-bg-white dark:tw-text-[#00101D] dark:hover:tw-bg-[#627F97] dark:hover:tw-text-white">Go to course</a>
                    </div>
                </div>
            </div>
        </div>

        @include('partials.modals._video-modal',[
            'name' => "trailer",
            "video" => $cohort['cohort_trailer'],
        ])

        @include('partials.modals._video-modal',[
            'name' => "trailerFirstDay",
            "video" => $cohort['description_trailer_1'],
        ])

        @include('partials.modals._video-modal',[
            'name' => "trailerLastDay",
            "video" => $cohort['description_trailer_2'],
        ])

        @include('partials.modals._video-modal',[
            'name' => "trailerDemo",
            "video" => $cohort['demo_trailer'],
        ])

        @include('partials._railanalytics-brand-tracking-iframe')
@endsection

@section('inject-components')
    @include('partials._countdown',[
            'countdownDate' => $cohort['enrollment_end_date'],
            'promoVersion' => false
        ])

    <script>
        @if(!empty($purchased) && $purchased)
            document.addEventListener('DOMContentLoaded', function () {
                window.openModal('signupModal');
            })
        @endif

        function enroll(URL){
            fetch(URL, {
                method: 'GET',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                referrerPolicy: 'no-referrer',
            })
            .then((response) => {
                window.openModal('signupModal');
            })
            .catch((e) => {
                window.shownotification({
                    isError: true
                });
            });
        }

        function openTrailer(URL){
            console.log(URL)
            //window.openModal('trailer');
        }
    </script>
@endsection
