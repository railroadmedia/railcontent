<section class="tw-flex tw-flex-row tw-mb-[30px]">
    <div class="tw-flex tw-flex-col tw-w-full">
        <!-- Section Title -->
        <div class="tw-flex tw-items-center tw-mb-4 tw-w-full tw-justify-between tw-px-4 lg:tw-px-0">
            <a href="{{ $continueUrl }}" class="tw-text-[#00101D] dark:tw-text-white tw-pb-1 tw-border-b tw-border-transparent tw-transition-all hover:tw-border-current">
                <h2 class="tw-font-bold tw-text-2xl tw-leading-none lg:tw-leading-none lg:tw-text-3xl">Continue</h2>
            </a>
            <a href="{{ $seeAllUrl }}"
                aria-label="See All Lessons In Progress"
                class="tw-text-base xl:tw-text-lg xl:tw-leading-none tw-uppercase tw-leading-none tw-font-bebas-neue tw-text-[#00101D] dark:tw-text-white tw-border-b tw-border-transparent tw-transition-all hover:tw-border-current"
            >
                See All
            </a>
        </div>

        <div>
            <transition appear name="fade">
                <catalogue-card-container
                        :is-mini-view="{{ json_encode(true) }}"
                        theme-color="{{ $brand }}"
                        :use-theme-color="{{ json_encode(true) }}"
                        content-endpoint="{{ $contentEndpoint ? $contentEndpoint : '/railcontent/content' }}"
                        catalogue-type="grid"
                        limit="16"
                        :lock-unowned="{{ json_encode(true) }}"
                        :pre-loaded-content="{{ $startedContentJson }}"
                        :show-dropdown="{{ json_encode(true) }}"
                >
                </catalogue-card-container>
            </transition>
        </div>
    </div>
</section>
