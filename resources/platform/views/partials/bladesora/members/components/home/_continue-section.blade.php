@if ($hasStartedContent)
    <section class="tw-flex tw-flex-row tw-mb-6 md:tw-mb-8">
        <div class="tw-flex tw-flex-col tw-grow">

            <!-- Section Title -->
            <div class="tw-flex tw-items-center tw-mb-4 tw-w-full tw-justify-between">
                <a href="{{ $continueUrl }}" class="tw-text-[#00101D] dark:tw-text-white tw-pb-1 tw-border-b tw-border-transparent tw-transition-all hover:tw-border-current">
                    <h2 class="tw-font-bold tw-text-2xl tw-leading-none lg:tw-leading-none lg:tw-text-3xl">Continue</h2>
                </a>
                <a href="{{ $seeAllUrl }}"
                    aria-label="See All Lessons In Progress"
                    class="tw-text-lg tw-uppercase tw-leading-none lg:tw-leading-none tw-font-bebas-neue tw-text-[#00101D] dark:tw-text-white tw-border-b tw-border-transparent tw-transition-all hover:tw-border-current"
                >
                    See All
                </a>
            </div>

            <div class="tw-flex tw-flex-row six-cards-row">
                <transition appear name="fade">
                    <content-catalogue
                            theme-color="{{ $brand }}"
                            :use-theme-color="true"
                            content-endpoint="{{ $contentEndpoint ? $contentEndpoint : '/railcontent/content' }}"
                            catalogue-type="grid"
                            no-results-icon="happy"
                            no-results-message="You haven't started any lessons yet, once you start a lesson it will show up here for you to access later."
                            limit="16"
                            :lock-unowned="true"
                            :six-wide="true"
                            :force-wide-thumbs="true"
                            :pre-loaded-content="{{ $startedContentJson }}"
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
@endif
