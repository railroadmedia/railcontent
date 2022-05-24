@if ($hasFeaturedCoaches)
    <div class=" tw-container tw-mx-auto tw-px-4 md:tw-px-8 tw-mt-[30px] tw-mb-[24px]">
        <div class="tw-flex tw-flex-row tw-mb-3">
            <div class="tw-flex tw-flex-col tw-flex-grow">
                <div class="tw-text-[#00101D] dark:tw-text-white tw-pb-1">
                    <h2 class="tw-font-bold tw-text-2xl tw-leading-none lg:tw-leading-none lg:tw-text-3xl tw-mb-[15px]">
                        Featured Coach
                    </h2>
                </div>
                {{-- There will be multiple featured coaches --}}
                @foreach ($featuredCoaches->results() as $featured)
                    @php
                        $singleFeaturedCoach = count($featuredCoaches->results()) === 1; //Not sure if this is still needed
                        $fullName = $featured->fetch('fields.name');
                        $exploded = explode(' ', $fullName);
                        $firstName = array_shift($exploded);
                        $description = $featured->fetch('data.short_bio.value');
                    @endphp
                    <static-header
                        topSubtitle="{{ $featured->fetch('data.focus_text.value') }}"
                        titleclasses="tw-text-[#FAA300]"
                        title="{{ $featured->fetch('fields.name') }}"
                        ctaText="Visit {{ $firstName }}'s Coach Page"
                        description="{{ $description }}"
                        ctaUrl="{{ $featured->fetch('url') }}"
                        img="{{ cf_img($featured->fetch('data.coach_featured_image'), ['width' => 720]) }}"
                    />
                @endforeach
            </div>
        </div>
    </div>
@endif
