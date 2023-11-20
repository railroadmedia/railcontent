<section class="tw-flex tw-flex-row tw-mb-[30px]">
    <div class="tw-flex tw-flex-col tw-w-full">

        <!-- Section Title -->
        <div class="tw-flex tw-items-center tw-mb-4 tw-w-full tw-justify-between tw-px-4 lg:tw-px-0">
            <a href="{{ $upcomingUrl }}" class="tw-text-[#00101D] dark:tw-text-white tw-pb-1 tw-border-b tw-border-transparent tw-transition-all hover:tw-border-current">
                <h2 class="tw-font-bold tw-text-2xl tw-leading-none lg:tw-leading-none lg:tw-text-3xl">Upcoming Events</h2>
            </a>
            <a href="{{ $upcomingUrl }}"  
                aria-label="See All Upcoming Events"
                class="tw-text-base xl:tw-text-lg xl:tw-leading-none tw-uppercase tw-leading-none tw-font-bebas-neue tw-text-[#00101D] dark:tw-text-white tw-border-b tw-border-transparent tw-transition-all hover:tw-border-current"
            >
                See All
            </a>
        </div> 

        <div>
            <transition appear name="fade">
                <catalogue-card-container
                            theme-color="{{ $brand }}"
                            :use-theme-color="true"
                            content-endpoint="{{ $contentEndpoint ? $contentEndpoint : '/railcontent/content' }}"
                            catalogue-type="grid"
                            no-results-icon="happy"
                            no-results-message="You haven't added any lessons yet, once you add a lesson of this type it will show up here for you to access later."
                            limit="16"
                            :lock-unowned="true"
                            :six-wide="true"
                            :force-wide-thumbs="true"
                            :pre-loaded-content="{{ $upcomingEvents }}"
                    >
                    </catalogue-card-container>
            </transition>
        </div>
        
    </div>
</section>