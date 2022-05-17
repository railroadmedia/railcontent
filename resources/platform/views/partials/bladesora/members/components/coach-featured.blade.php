@if ($hasFeaturedCoaches)
    <div class="tw-container tw-mx-auto tw-px-4 md:tw-px-8 tw-mt-5 tw-mb-3">
        <div class="tw-text-[#00101D] dark:tw-text-white tw-pb-1">
            <h2 class="tw-font-bold tw-text-2xl tw-leading-none lg:tw-leading-none lg:tw-text-3xl  tw-mb-4">
                Featured Coaches
            </h2>
        </div>
        <?php $singleFeaturedCoach = count($featuredCoaches->results()) === 1; ?>
        <div class="tw-grid tw-grid-cols-1 tw-gap-6 {{ $singleFeaturedCoach ? '' : 'md:tw-grid-cols-2' }}">
            @foreach ($featuredCoaches->results() as $featured)
                <?php //dd($featured->dot()); ?>
                <div class="tw-flex {{ $singleFeaturedCoach ? 'tw-flex-col md:tw-flex-row' : 'tw-flex-col' }}">
                    <!-- Card Thumbnail -->
                    <div class="{{ $singleFeaturedCoach ? 'md:tw-mr-6 md:tw-w-1/2' : 'md:tw-mr-0' }}">
                        <a href="{{ $featured->fetch('url') }}" class="tw-w-full tw-flex tw-rounded-xl tw-mb-4 tw-bg-cover tw-bg-top tw-h-80 tw-bg-gray-200"
                            style="background-image: url( {{ cf_img($featured->fetch('data.coach_featured_image'), ['width' => 720]) }} );">
                            <span class="sr-only">Image of {{ $featured->fetch('fields.name') }}</span>
                        </a>
                    </div>
                    <div
                        class="tw-inline-flex tw-flex-col tw-justify-center {{ $singleFeaturedCoach ? 'md:tw-w-1/2' : '' }}">
                        <!-- Card Header -->
                        <div class="tw-flex tw-items-center tw-mb-4">
                            <!-- Coach Headshot -->
                            <a href="{{ $featured->fetch('url') }}"
                                class="tw-mr-4 tw-rounded-full tw-relative tw-w-16 tw-h-16 tw-overflow-hidden tw-flex-shrink-0">
                                
                                <img class="tw-w-16 tw-h-16 tw-rounded-full tw-border-2 tw-border-solid tw-border-yellow-500"
                                    src="{{ cf_img($featured->fetch('coach_profile_image'), ['width' => 300]) }} ">
                                <!-- Badge -->
                                <div
                                    class="tw-bg-yellow-500 tw-absolute tw-w-full tw-h-3 tw-left-0 tw-bottom-0 tw-z-10 tw-flex tw-items-center tw-justify-center">
                                    <musora-icon 
                                        icon-name="whistle-filled"
                                        height="16" 
                                        class="tw-text-white tw-w-[16px] tw-leading-none"
                                    ></musora-icon>
                                </div>
                            </a>
                            <!-- Header -->
                            <a class="tw-text-2xl tw-text-black dark:tw-text-white tw-no-underline tw-font-bold tw-uppercase tw-mr-4"
                               href="{{ $featured->fetch('url') }}"
                            >
                                @php
                                    $fullName = $featured->fetch('fields.name');
                                    $exploded = explode(' ', $fullName);
                                    $firstName = array_shift($exploded);
                                @endphp
                                <span class="tw-font-normal">{{ $firstName }}</span>
                                {{ implode(' ', $exploded) }}
                            </a>
                            <!-- Buttons -->
                            <a href="{{ $featured->fetch('url') }}"
                                class="tw-btn tw-btn-primary tw-bg-{{ $brand }} tw-ml-auto tw-hidden hover:tw-bg-{{ $brand }}-600 {{ $singleFeaturedCoach ? '' : 'xl:tw-inline-flex' }}">
                                SEE COACH
                            </a>
                        </div>
                        <!-- Card Body -->
                        <div class="tw-flex tw-flex-col tw-mb-6">
                            <h3 class="tw-text-xl tw-font-bold dark:tw-text-white tw-uppercase tw-mb-4">
                                {{ $featured->fetch('data.focus_text.value') }}
                            </h3>
                            <div class="tw-text-sm dark:tw-text-white">
                                {!! $featured->fetch('data.short_bio.value') !!}
                            </div>
                        </div>
                        <!-- Buttons -->
                        <a href="{{ $featured->fetch('url') }}"
                            class="tw-btn tw-btn-primary tw-bg-{{ $brand }} tw-mr-auto hover:tw-bg-{{ $brand }}-600 {{ $singleFeaturedCoach ? '' : 'xl:tw-hidden' }}">SEE COACH</a>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endif
