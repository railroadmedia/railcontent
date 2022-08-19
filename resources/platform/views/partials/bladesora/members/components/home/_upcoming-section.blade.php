<section class="tw-flex tw-flex-row tw-mb-6 md:tw-mb-8">
    <div class="tw-flex tw-flex-col tw-grow">

        <!-- Section Title -->
        <div class="tw-flex tw-items-center tw-mb-4 tw-w-full tw-justify-between">
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

        <div class="tw-flex tw-flex-row six-cards-row">
            <transition appear name="fade">
                <content-catalogue
                        theme-color="{{$brand}}"
                        :use-theme-color="true"
                        content-endpoint="{{ $contentEndpoint ? $contentEndpoint : '/railcontent/content' }}"
                        no-results-icon="happy"
                        no-results-message="You haven't added any lessons yet, once you add a lesson of this type it will show up here for you to access later."
                        catalogue-type="grid"
                        limit="16"
                        :six-wide="true"
                        :lock-unowned="true"
                        :force-wide-thumbs="true"
                        :pre-loaded-content="{{ $upcomingEvents }}"
                >
                    <div class="tw-flex tw-flex-row nmh-1">
                        @for($i = 0; $i < 6; $i++)
                            @include('partials.bladesora.members.skeletons.card-item', [
                                "cardClass" => 'six-wide',
                            ])
                        @endfor
                    </div>
                </content-catalogue>
            </transition>
        </div>
        
    </div>
</section>