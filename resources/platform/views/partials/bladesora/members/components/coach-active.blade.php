@if ($hasActiveCoaches)
    <div class="tw-container tw-mx-auto tw-px-4 md:tw-px-8">
        <div class="tw-flex tw-items-center tw-mb-6">
            <h2 class="heading sans dark:tw-text-white">
                Active Coaches
            </h2>
        </div>

        <!-- Active Coaches -->
        <div class="tw-my-3">
            <div class="tw-grid tw-grid-cols-2 sm:tw-grid-cols-3 md:tw-grid-cols-4 xl:tw-grid-cols-5 tw-gap-3">
                @foreach ($activeCoaches as $coach)
                    <a href="{{ $coach->fetch('url') }}"
                        class="tw-rounded-3xl tw-overflow-hidden tw-relative tw-flex tw-mb-3">

                        <!-- Coach Image -->
                        <img src="{{ cf_img($coach->fetch('data.coach_card_image'), ['width' => 300]) }}"
                            class="tw-w-full tw-flex tw-object-cover" alt="{{ $coach->fetch('fields.name') }} Card">

                        <div class="tw-absolute tw-w-full tw-left-0 tw-bottom-0 tw-text-white tw-flex tw-flex-col tw-text-center tw-uppercase tw-h-3/4"
                            style="background: linear-gradient(180deg, rgba(1, 5, 15, 0) 0%, #01050F 100%);">
                            <!-- Coach Name -->
                            <p class="tw-text-2xl xl:tw-text-3xl tw-font-bold tw-font-bebas-neue tw-break-words tw-flex tw-flex-col tw-mt-auto tw-mb-4"
                                style="line-height:1.1 !important; hyphens: auto;">
                                @php
                                    $fullName = $coach->fetch('fields.name');
                                    $exploded = explode(' ', $fullName);
                                    $firstName = array_shift($exploded);
                                @endphp
                                <span class="tw-block">{{ $firstName }}</span>
                                {{ implode(' ', $exploded) }}
                            </p>

                            <!-- Coach Title -->
                            <p class="tw-text-sm tw-font-primary tw-text-yellow-400 tw-h-10 tw-mb-10 tw-leading-snug tw-px-3">
                                {{ $coach->fetch('data.focus_text.value') }}
                            </p>

                            @if ($coach->fetch('is_house_coach'))
                                <div class="tw-text-white tw-text-xs tw-font-bebas-neue tw-font-bold tw-absolute tw-bottom-0 tw-w-full tw-flex tw-mb-4 tw-justify-center tw-items-center">
                                    <svg width="11" height="11" fill="#ffffff" class="tw-mr-1" aria-hidden="true" focusable="false"><use xlink:href="#whistle"></use></svg>
                                    HOUSE
                                </div>
                            @endif
                        </div>

                        <!-- Overlay -->
                        <div
                            class="tw-flex tw-items-center tw-content-center tw-p-6 tw-absolute tw-top-0 tw-left-0 tw-right-0 tw-bottom-0 tw-bg-black tw-opacity-0 tw-transition tw-bg-opacity-60 tw-duration-500 tw-ease-in-out hover:tw-opacity-100">
                        </div>
                    </a>
                @endforeach
            </div>
        </div>
    </div>
@endif
