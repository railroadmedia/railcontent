@extends('partials.layout')

@section('meta')
    <title>Cohort Enrollment | Musora</title>
@endsection

@section('styles')
    <script defer src="https://cdnjs.cloudflare.com/ajax/libs/alpinejs/3.12.0/cdn.min.js"></script>
@endsection

@section('body-data')
    x-data="cohort"
    x-init="countdown()"
@endsection

@section('content')
    <header class="tw-bg-[#F1F7FE] tw-py-4 md:tw-py-7 tw-px-4">
        <div class="tw-max-w-5xl tw-mx-auto tw-relative">
            <div class="2xl:tw-absolute 2xl:tw-top-0 2xl:-tw-left-28 tw-mb-3 md:tw-mb-6 2xl:tw-mb-0">
                <button class="tw-bg-[rgba(0,12,23,0.40)] hover:tw-bg-[rgba(0,12,23,0.80)] tw-py-1 tw-px-2.5 tw-text-white tw-rounded-full" onclick="history.back()">
                    <i class="fa-solid fa-chevron-left"></i>
                </button>
            </div>
            <div class="md:tw-flex tw-items-center tw-gap-6 tw-mb-12 tw-text-center md:tw-text-left">
                <div class="md:tw-flex-1">
                    {{--  Header logo  --}}
                    <img class="tw-h-20 sm:tw-h-20 lg:tw-h-28 tw-mb-2 tw-inline-block " alt="header logo" src="https://www.musora.com/musora-cdn/image/width=440,quality=95/{{ $cohort['light_mode_logo']??'' }}" />
                    {{--  Headline  --}}
                    <h1 class="tw-font-extrabold tw-text-3xl lg:tw-text-4xl">{{ $cohort['headline'] }}</h1>
                    {{--  Subheadline  --}}
                    <h2 class="tw-font-normal tw-text-2xl lg:tw-text-3xl">{{ $cohort['subheadline'] }}</h2>
                    {{--  Header description  --}}
                    <p class="tw-font-bold tw-mt-4 lg:tw-mt-6 tw-mb-2">{{ $cohort['header_description'] }}</p>
                    <div class="tw-mb-7 lg:tw-mb-9 tw-flex tw-justify-between sm:tw-justify-center md:tw-justify-start tw-max-w-md sm:tw-max-w-none tw-mx-auto">
                        <div class="md:tw-flex sm:tw-mr-4 md:tw-mr-2"><i class="fas fa-check tw-text-{{ $brand }} tw-mt-1 tw-mr-1" aria-hidden="true"></i><br class="md:tw-hidden"> <span class="tw-text-sm">{{ $cohort['benefit_1'] }}</span></div>
                        <div class="md:tw-flex sm:tw-mr-4 md:tw-mr-2 tw-px-2 sm:tw-px-0"><i class="fas fa-check tw-text-{{ $brand }} tw-mt-1 tw-mr-1" aria-hidden="true"></i><br class="md:tw-hidden"> <span class="tw-text-sm">{{ $cohort['benefit_2'] }}</span></div>
                        <div class="md:tw-flex"><i class="fas fa-check tw-text-{{ $brand }} tw-mt-1 tw-mr-1" aria-hidden="true"></i><br class="md:tw-hidden"> <span class="tw-text-sm">{{ $cohort['benefit_3'] }}</span></div>
                    </div>
                    {{--  Mobile Header Image --}}
                    <div class="tw-relative md:tw-hidden">
                        <img
                            class="tw-rounded-xl tw-mb-6 tw-transition-opacity tw-opacity-0"
                            src="https://www.musora.com/musora-cdn/image/width=850,quality=95/{{ $cohort['header_image_url'] }}"
                            alt="header thumb"
                            loading="lazy"
                            onload="this.classList.remove('tw-opacity-0')"
                        />
                        <div class="tw-absolute tw-bottom-4 tw-left-4 tw-bg-white tw-rounded-full tw-uppercase tw-font-bebas-neue tw-px-5 tw-py-1 tw-flex tw-items-center tw-cursor-pointer" x-on:click="trailer = true"><i class="fas fa-play tw-mr-2" aria-hidden="true"></i> <div class="tw-mt-1">Watch Trailer</div></div>
                    </div>
                    <div class="md:tw-flex @if($hasProduct) md:tw-items-start @else md:tw-items-center @endif">
                        {{--  Enrolled Buttons  --}}
                        <div x-cloak x-show="isEnrolled" class="tw-w-full md:tw-w-1/2 md:tw-mr-2 tw-text-center">
                            <span class="tw-btn-primary tw-bg-[#65656B] tw-w-full tw-text-white tw-cursor-default">YOU'RE ENROLLED!</span>
                            <a href="{{$cohort['course_url']}}" class="tw-text-[#65656B] tw-underline tw-italic tw-text-sm tw-inline-block tw-mb-2 md:tw-mb-0">View the course now!</a>
                        </div>

                        {{--  Closed Button  --}}
                        <span x-cloak x-show="!isEnrolled && timeLeft < 0" class="tw-btn-primary tw-bg-[#65656B] tw-w-full md:tw-w-1/2 md:tw-mr-2 tw-text-white">Enrollment Closed</span>
                        {{--  Enroll now Button  --}}
                        <button x-cloak x-show="!isEnrolled && timeLeft > 0" x-on:click="enroll('{{ $registerButtonUrl }}');" class="tw-btn-primary tw-bg-{{ $brand }} tw-w-full md:tw-w-1/2 md:tw-mr-2 tw-max-w-[415px] tw-mb-5 md:tw-mb-0 hover:tw-bg-{{ $brand }}-600">Enroll Now</button>

                        <div class="md:tw-w-1/2 tw-flex tw-items-center tw-justify-center md:tw-justify-start @if($hasProduct) md:tw-mt-2 @endif">
                            <img
                                class="tw-h-8 md:tw-h-6 tw-mr-1 tw-transition-opacity tw-opacity-0"
                                src="https://www.musora.com/musora-cdn/image/width=100,quality=95/https://d2vyvo0tyx8ig5.cloudfront.net/products/new-piano-players/joined_profiles.png"
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
                        src="https://www.musora.com/musora-cdn/image/width=850,quality=95/{{ $cohort['header_image_url'] }}"
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
                            {{--                                src="https://www.musora.com/musora-cdn/image/width=60,quality=95/{{ $cohort['icon1_url'] }}"--}}
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
                            {{--                                src="https://www.musora.com/musora-cdn/image/width=60,quality=95/{{ $cohort['icon2_url'] }}"--}}
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
                            {{--                                src="https://www.musora.com/musora-cdn/image/width=60,quality=95/{{ $cohort['icon3_url'] }}"--}}
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

    <section class="tw-bg-white tw-py-7">
        <div class="tw-max-w-5xl tw-mx-auto tw-px-4 md:tw-px-10">
            {{--  Body title  --}}
            <h3 class="tw-font-extrabold tw-text-center tw-mb-7">{{ $cohort['body_title'] }}</h3>
            {{--  Body top description  --}}
            <p class="md:tw-px-10">{!! $cohort['body_top_description'] !!}</p>
        </div>
    </section>

    <section class="tw-bg-[#F1F7FE] tw-py-7 ">
        <div class="tw-max-w-5xl tw-mx-auto tw-px-4 md:tw-px-10">
            <div class="tw-relative tw-cursor-pointer tw-mb-10" x-on:click="trailer = true">
                {{--  Body Image  --}}
                <img
                    class="tw-rounded-xl tw-transition-opacity tw-opacity-0"
                    src="https://www.musora.com/musora-cdn/image/width=1200,quality=95/{{ $cohort['body_image_url'] }}"
                    alt="video thumb"
                    loading="lazy"
                    onload="this.classList.remove('tw-opacity-0')"
                />
            </div>
            {{--  Body logo  --}}
            <img
                class="tw-h-10 sm:tw-h-16 tw-mb-8 tw-mx-auto tw-transition-opacity tw-opacity-0"
                alt="just play logo"
                src="https://www.musora.com/musora-cdn/image/width=1220,quality=95/{{ $cohort['body_logo'] }}"
                loading="lazy"
                onload="this.classList.remove('tw-opacity-0')"
            />
            {{--  Body bottom description  --}}
            <p class="tw-text-center tw-px-6">{!! $cohort['body_bottom_description'] !!}</p>
        </div>
    </section>


    @if($cohort['is_product'])
        <section class="tw-bg-{{ $brand }} tw-py-20 lg:tw-py-32">
            <div class="tw-max-w-6xl tw-mx-auto lg:tw-px-10 tw-flex tw-flex-col lg:tw-flex-row tw-items-center tw-px-4 lg:tw-px-0">
                <div class="tw-w-full lg:tw-w-1/2 lg:tw-order-1 tw-mb-4 lg:tw-mb-0">
                    <div class="tw-w-full tw-aspect-video tw-bg-black tw-rounded-xl tw-overflow-hidden tw-relative">
                        <img src="https://www.musora.com/musora-cdn/image/width=600,quality=95/{{ $cohort['product_image'] }}" class="tw-transition-opacity tw-opacity-0 tw-absolute tw-w-full tw-h-full tw-left-0 tw-top-0 tw-object-cover" onload="this.classList.remove('tw-opacity-0')" />
                    </div>
                </div>
                <div class="lg:tw-w-1/2 lg:tw-pr-4 tw-text-white tw-text-center md:tw-text-left">
                    <h1 class="tw-text-2xl tw-font-extrabold tw-leading-tight tw-mb-5">{{ $cohort['product_description_header'] }}</h1>
                    <p class="tw-text-base tw-mb-6">{{ $cohort['product_description_body'] }}</p>
                    <div class="tw-mb-5 tw-text-4xl">
                        <s class="tw-text-[rgba(255,255,255,0.7)]">${{ floatVal($cohort['product_original_price']) }}</s> <span class="tw-font-extrabold">${{ floatVal($cohort['product_sale_price']) }}</span> Save {{ round(100 - (100 * ($cohort['product_sale_price'] / $cohort['product_original_price']))) }}%
                    </div>
                    <button
                        x-cloak
                        class="tw-btn-primary tw-bg-white tw-text-{{ $brand }}"
                        x-bind:class="isEnrolled && 'tw-cursor-default'"
                        x-on:click="enroll('{{ $registerButtonUrl }}', true)"
                    >
                        <span x-cloak x-show="isEnrolled">You're enrolled</span>
                        <span x-cloak x-show="!isEnrolled">Enroll + Get the deal</span>
                    </button>
                    <span x-cloak x-show="!isEnrolled && timeLeft < 0" class="tw-btn-primary tw-bg-[#65656B] tw-text-white tw-cursor-default">Enrollment Closed</span>
                </div>
            </div>
        </section>

        <section x-show="!isEnrolled && timeLeft > 0" class="tw-py-10 tw-bg-white">
            <div class="md:tw-flex md:tw-justify-center md:tw-gap-6 tw-px-4 md:tw-px-0">
                <div class="tw-w-full tw-max-w-[340px] tw-rounded-xl tw-px-4 md:tw-px-12 tw-py-8 tw-bg-white tw-border-2 tw-border-{{ $brand }} tw-text-center tw-mb-4 md:tw-mb-0 tw-mx-auto md:tw-mx-0">
                    <h1 class="lg:tw-text-[34px] tw-font-extrabold">Course Only</h1>
                    <h2 class="lg:tw-text-[26px] tw-font-extrabold">Free</h2>
                    <i>Included in your membership</i>
                    <button class="tw-btn-primary tw-bg-{{ $brand }} tw-my-5" x-on:click="enroll('{{ $registerButtonUrl }}');">Enroll Now</button>
                    <p class="tw-text-xs tw-leading-relaxed">{{ $cohort['course_description'] }}</p>
                </div>
                <div class="tw-w-full tw-max-w-[340px] tw-rounded-xl tw-px-4 md:tw-px-12 tw-py-8 tw-bg-white tw-border-2 tw-border-[#FFAE00] tw-text-center tw-relative tw-mx-auto md:tw-mx-0">
                    <div class="tw-flex tw-justify-center tw-absolute tw-left-0 -tw-top-2 tw-w-full">
                        <div class="tw-uppercase tw-bg-[#FFAE00] tw-px-5 tw-py-0.5 tw-rounded-full tw-text-[10px] tw-font-semibold">{{ $cohort['get_product_badge'] }}</div>
                    </div>
                    <h1 class="lg:tw-text-[34px] tw-font-extrabold tw-leading-tight">Course + <br /> {{ $cohort['product_name'] }}</h1>
                    <h2 class="lg:tw-text-[26px]"><s class="tw-text-[rgba(0,0,0,0.6)]">${{ floatVal($cohort['product_original_price']) }}</s> <span class="tw-font-extrabold">${{ floatVal($cohort['product_sale_price']) }}</span></h2>
                    <i>Included in your membership</i>
                    <button
                        class="tw-btn-primary tw-bg-{{ $brand }} tw-my-5 tw-px-8 md:tw-px-16"
                        x-bind:class="isEnrolled && 'tw-cursor-default'"
                        x-on:click="enroll('{{ $registerButtonUrl }}', true);"
                    >
                        <span x-show="isEnrolled">You are enrolled</span> <span x-show="!isEnrolled">Enroll + Get the deal</span>
                    </button>
                    <p class="tw-text-xs tw-leading-relaxed">{{ $cohort['course_product_description'] }}</p>
                </div>
            </div>
        </section>
    @endif

    {{--  Dropdown  --}}
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
            {{--  Bottom title  --}}
            <h3 class="tw-font-extrabold tw-text-center tw-mt-10">{{ $cohort['bottom_title'] }}</h3>
            {{--  Bottom description  --}}
            <p class="tw-font-bold tw-text-center tw-mt-4 tw-mb-6">{{ $cohort['bottom_description'] }}</p>
            <div class="tw-max-w-[415px] md:tw-max-w-xl tw-mx-auto tw-flex tw-flex-col md:tw-flex-row md:tw-gap-2 tw-mb-4 tw-justify-center">
                {{--  Buttons  --}}
                <span x-cloak x-show="isEnrolled" class="tw-btn-primary tw-bg-[#65656B] tw-w-full md:tw-w-1/2 tw-mb-2 md:tw-mb-0 tw-cursor-default">YOU'RE ENROLLED!</span>
                <span x-cloak x-show="!isEnrolled && timeLeft < 0" class="tw-btn-primary tw-bg-[#65656B] tw-w-full tw-text-white tw-cursor-default">Enrollment Closed</span>
                <button x-cloak x-show="!isEnrolled && timeLeft > 0" x-on:click="enroll('{{ $registerButtonUrl }}')" class="tw-btn-primary tw-bg-{{ $brand }} tw-w-full md:tw-w-1/2 tw-text-white tw-mb-2 md:tw-mb-0 hover:tw-bg-{{ $brand }}-600">Enroll Now</button>
                @if(!empty($cohort['conversation_url']))
                    <a href="{{$cohort['conversation_url']}}" class="tw-btn-secondary tw-border-black tw-w-full md:tw-w-1/2 tw-text-black hover:tw-bg-black hover:tw-text-white">Join the conversation</a>
                @endif
            </div>

            <div x-cloak x-show="isEnrolled" class="tw-text-center tw-mb-3"><a href="{{ $cohort['product_cart_link'] }}" class="tw-text-[#2563EB]">{{ $cohort['product_cart_link_description'] }}</a></div>

            <div class="tw-max-w-[250px] tw-mx-auto tw-flex tw-justify-center tw-items-center">
                <img
                    class="tw-h-7 sm:tw-mb-1 lg:tw-mb-0 tw-mr-1 tw-transition-opacity tw-opacity-0"
                    src="https://www.musora.com/musora-cdn/image/width=100,quality=95/https://d2vyvo0tyx8ig5.cloudfront.net/products/new-piano-players/joined_profiles.png"
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
        </div>
    </section>

    {{--  Signup modal  --}}
    <div id="signupModal" class="modal">
        <div class="tw-max-w-xl tw-bg-white dark:tw-bg-[#081825] tw-text-center dark:tw-text-white tw-rounded-xl tw-px-8 tw-py-10 dark:tw-border-[#445F74] dark:tw-border">
            <img class="tw-h-20 tw-mx-auto tw-mb-5 dark:tw-hidden" src="https://www.musora.com/musora-cdn/image/width=440,quality=95/{{ $cohort['light_mode_logo']??'' }}" alt="modal logo" />
            <img class="tw-h-20 tw-mx-auto tw-mb-5 tw-hidden dark:tw-inline-block" src="https://www.musora.com/musora-cdn/image/width=440,quality=95/{{ $cohort['dark_mode_logo']??'' }}" alt="modal logo" />
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

    {{--  Purchase modal  --}}
    <div id="purchaseModal" class="modal">
        <div class="tw-max-w-xl tw-bg-white dark:tw-bg-[#081825] tw-text-center dark:tw-text-white tw-rounded-xl tw-px-8 tw-py-10 dark:tw-border-[#445F74] dark:tw-border">
            <img class="tw-h-20 tw-mx-auto tw-mb-5 dark:tw-hidden" src="https://www.musora.com/musora-cdn/image/width=440,quality=95/{{ $cohort['light_mode_logo']??'' }}" alt="modal logo" />
            <img class="tw-h-20 tw-mx-auto tw-mb-5 tw-hidden dark:tw-inline-block" src="https://www.musora.com/musora-cdn/image/width=440,quality=95/{{ $cohort['dark_mode_logo']??'' }}" alt="modal logo" />
            <div class="tw-text-2xl tw-font-bold tw-mb-1">Success, You’re Enrolled!</div>
            <p class="tw-mb-5">
                The course runs from {{ date('F jS', strtotime('+1 hour', strtotime($cohort['cohort_start_date']))) }} - {{ date('F jS', strtotime('+1 hour', strtotime($cohort['cohort_end_date']))) }}. We’ll notify you before the course begins.
            </p>
            <div class="tw-mb-4">
                <a href="{{ $cohort['product_cart_link'] }}" class="tw-btn-primary tw-bg-[#00101D] tw-text-white hover:tw-bg-[#3F3F46] dark:tw-bg-white dark:tw-text-[#00101D] dark:hover:tw-bg-[#627F97] dark:hover:tw-text-white tw-w-full">Click here to complete your purchase</a>
            </div>
            <div>
                <a href="{{$cohort['course_url']}}" class="tw-text-sm tw-text-[#2563EB]">Change your mind? Click here to to go the course instead.</a>
            </div>
        </div>
    </div>

    @include('partials.modals._video-modal',[
        'name' => "trailer",
        "video" => $cohort['cohort_trailer'],
    ])

    @include('partials._railanalytics-brand-tracking-iframe')
@endsection

@section('inject-components')
    @include('partials._countdown',[
            'countdownDate' => '2024/10/23',
            'promoVersion' => false
        ])

    <script>
        {{--        @if(!empty($purchased) && $purchased)--}}
        {{--            document.addEventListener('DOMContentLoaded', function () {--}}
        {{--                window.openModal('signupModal');--}}
        {{--            })--}}
        {{--        @endif--}}

        document.addEventListener('alpine:init', () => {
            Alpine.data('cohort', () => ({
                ...timer(),
                trailer: false,
                isEnrolled: {{ $hasProduct ? 'true' : 'false' }},

                enroll(URL, purchase = false){
                    if(!this.isEnrolled){
                        fetch(URL, {
                            method: 'GET',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': '{{ csrf_token() }}'
                            },
                            referrerPolicy: 'no-referrer',
                        })
                            .then((response) => {
                                this.isEnrolled = true;

                                if(purchase){
                                    window.openModal('purchaseModal');
                                    return;
                                }

                                window.openModal('signupModal');
                            })
                            .catch((e) => {
                                window.shownotification({
                                    isError: true
                                });
                            });
                    }
                }
            }))
        })
    </script>
@endsection
