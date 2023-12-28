@if ($hasFeaturedCoaches)
    <div class=" tw-container tw-mx-auto tw-px-4 md:tw-px-8 tw-mt-[30px] tw-mb-[24px]">
        <div class="tw-flex tw-flex-row tw-mb-3">
            <div class="tw-flex tw-flex-col tw-flex-grow">
                <div class="tw-text-[#00101D] dark:tw-text-white tw-pb-1">
                    <h2 class="tw-font-bold tw-text-xl md:tw-text-2xl tw-mb-[15px]">
                        Featured Coach
                    </h2>
                </div>
                {{-- There will be multiple featured coaches --}}
                @php
                $formattedResults = [];
                @endphp
                @foreach ($featuredCoaches->results() as $featured)
                    @php
                        $fullName = $featured->fetch('fields.name');
                        $exploded = explode(' ', $fullName);
                        $firstName = array_shift($exploded);

                        $currentCoach = new stdClass();
                        $currentCoach->ctaText = "Visit $firstName's Coach Page";
                        $currentCoach->description = $featured->fetch('data.short_bio.value');
                        $currentCoach->titleClasses = "tw-text-[#FAA300]";
                        $currentCoach->title = $fullName;
                        $currentCoach->topSubtitle = $featured->fetch('data.focus_text.value');
                        $currentCoach->ctaUrl = $featured->fetch('url');
                        $currentCoach->img = "https://www.musora.com/musora-cdn/image/width=720/".$featured->fetch('data.coach_featured_image');

                        array_push($formattedResults, $currentCoach);
                    @endphp
                @endforeach
                @if(count($formattedResults) === 1)
                    <static-header
                        top-subtitle="{{ $formattedResults[0]->topSubtitle }}"
                        title-classes="{{ $formattedResults[0]->titleClasses }}"
                        title="{{ $formattedResults[0]->title }}"
                        cta-text="{{ $formattedResults[0]->ctaText }}"
                        description="{{ $formattedResults[0]->description }}"
                        cta-url="{{ $formattedResults[0]->ctaUrl }}"
                        img="{{ $formattedResults[0]->img }}"
                    />
                @elseif(count($formattedResults) > 1)
                    @php
                        $slidesOnBrand = new stdClass();
                        $slidesOnBrand->brand = $brand;
                        $slidesOnBrand->slides = $formattedResults;
                    @endphp
                    {{-- Carousel --}}
                    <header-carousel
                        :preloaded-carousel="{{ json_encode([$slidesOnBrand]) }}"
                        brand="{{ $brand }}">
                    </header-carousel>
                @else
                <span></span>
                @endif
            </div>
        </div>
    </div>
@endif
