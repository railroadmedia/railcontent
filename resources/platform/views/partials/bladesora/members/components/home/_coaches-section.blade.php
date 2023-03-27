@if($hasSubscribedCoaches)
    <section class="tw-flex tw-flex-row tw-mb-6 md:tw-mb-8">
        <div class="tw-flex tw-flex-col tw-grow">

            <!-- Section Title -->
            <div class="tw-flex tw-items-center tw-mb-4 tw-w-full tw-justify-between">
                <a href="{{ $subscribedCoachesUrl }}" class="tw-text-[#00101D] dark:tw-text-white tw-pb-1 tw-border-b tw-border-transparent tw-transition-all hover:tw-border-current">
                    <h2 class="tw-font-bold tw-text-2xl tw-leading-none lg:tw-leading-none lg:tw-text-3xl">Subscribed Coaches</h2>
                </a>
                <a href="{{ $subscribedCoachesUrl }}"
                    aria-label="See All Coaches"
                    class="tw-text-base xl:tw-text-lg xl:tw-leading-none tw-uppercase tw-leading-none tw-font-bebas-neue tw-text-[#00101D] dark:tw-text-white tw-border-b tw-border-transparent tw-transition-all hover:tw-border-current"
                >
                    See All
                </a>
            </div>
            <div class="tw-grid tw-gap-3 tw-grid-cols-2 sm:tw-grid-cols-3 md:tw-grid-cols-4 lg:tw-grid-cols-5 xl:tw-grid-cols-6 3xl:tw-grid-cols-7">
                @foreach($subscribedCoaches->results() as $coach)
                    <a href="{{ $coach->fetch('url','') }}"
                        class="tw-no-underline ">
                        <div class="tw-flex tw-bg-cover tw-bg-top tw-relative tw-bg-gray-200 tw-overflow-hidden tw-rounded-lg lg:tw-rounded-xl tw-no-underline tw-text-white">
                            <img src="https://www.musora.com/musora-cdn/image/width=660,height=960,quality=90/{{ $coach->fetch('data.coach_card_image') }}"
                                 alt="{{ $coach->fetch('fields.name') }}"
                                 class="tw-w-full"
                            >
                            <div class="tw-flex tw-flex-col tw-mt-auto tw-w-full tw-items-center tw-justify-center tw-h-3/4 tw-text-center tw-absolute tw-bottom-0 tw-left-0 tw-w-full"
                                style="background: linear-gradient(180deg, rgba(1, 5, 15, 0) 0%, #01050F 100%);"
                            >
                                <!-- Coach Name -->
                                <h4 class="tw-uppercase tw-mt-auto tw-font-bebas-neue tw-text-lg md:tw-text-xl lg:tw-text-2xl xl:tw-text-3xl tw-break-all tw-leading-tight md:tw-leading-none tw-mb-3 tw-text-center"
                                    style="hyphens: auto">
                                    @php
                                        $fullName = $coach->fetch('fields.name');
                                        $exploded = explode(' ', $fullName);
                                        $firstName = array_shift( $exploded );
                                    @endphp
                                    <span class="">{{ $firstName }}</span><br>
                                    {{ implode(' ', $exploded) }}
                                </h4>
                                <!-- Coach Title -->
                                <p class="tw-text-yellow-400 tw-px-2 tw-text-xs tw-mb-8 tw-uppercase tw-h-8 tw-leading-tight">
                                    {{ $coach->fetch('data.focus_text.value') }}
                                </p>

                                @if ($coach->fetch('is_house_coach'))
                                    <div class="tw-text-white tw-items-center tw-leading-none tw-text-xs tw-font-bebas-neue tw-absolute tw-bottom-0 tw-w-full tw-flex tw-mb-2 tw-justify-center tw-items-center">
                                        <musora-icon
                                            icon-name="whistle-filled"
                                            height="12px"
                                            class="tw-text-white tw-mr-0.5 tw-w-[16px] tw-leading-none"
                                        ></musora-icon>
                                        <span class="tw-mt-1">HOUSE</span>
                                    </div>
                                @endif
                            </div>
                            <!-- Hover State -->
                            <div class="tw-absolute tw-w-full tw-h-full tw-top-0 tw-left-0 tw-z-10 tw-bg-opacity-0 tw-transition tw-bg-black hover:tw-bg-opacity-25"></div>
                        </div>
                    </a>
                @endforeach
            </div>

        </div>
    </section>
@endif
