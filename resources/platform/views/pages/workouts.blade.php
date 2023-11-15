@extends('partials.layout')

@section('meta')
    <title>{{ ucfirst($brand) }} Workouts | Musora</title>
@endsection

@section('content')

    <!-- BREADCRUMBS -->
    <breadcrumb
        brand="{{ $brand }}"
        first-level-url="/{{ $brand }}/workouts" 
        first-level-title="Workouts"
    >
    </breadcrumb>

    <div class="lg:tw-container tw-mx-auto lg:tw-px-8 dark:tw-text-white">

        <section>
            <h1>Featured Challenges</h1>
            <header-carousel :preloaded-carousel="{{ $carousel }}"></header-carousel>
            <?php if($hasFeaturedChallenges) {
                //var_dump($featuredChallenges->results());
            }?>
        <section>
        <br>
        <section>
            <h2>Workouts</h2>
            
            @if($hasStartedLessons )

                <section class="tw-container tw-mx-auto dark:tw-text-white lg:tw-px-4">
                    <h3>Continue Section</h3>
                    <!-- Section Title -->
                    <div class="tw-flex tw-items-center tw-mt-5 tw-mb-4 tw-w-full tw-justify-between tw-px-4 lg:tw-px-0">
                        <a href="/{{ $brand }}/lesson-history/in-progress" class="tw-text-[#00101D] dark:tw-text-white tw-pb-1 tw-border-b tw-border-transparent tw-transition-all hover:tw-border-current">
                            <h2 class="tw-font-bold tw-text-2xl tw-leading-none lg:tw-leading-none lg:tw-text-3xl">Continue</h2>
                        </a>
                        <a href="/{{ $brand }}/lesson-history/in-progress"
                        aria-label="See All Subscribed Lessons"
                        class="tw-text-base xl:tw-text-lg xl:tw-leading-none tw-uppercase tw-leading-none tw-font-bebas-neue tw-text-[#00101D] dark:tw-text-white tw-border-b tw-border-transparent tw-transition-all hover:tw-border-current"
                        >
                            See All
                        </a>
                    </div>
                    <div>
                        <transition appear name="fade">
                            <catalogue-card-container
                                theme-color="{{ $brand }}"
                                catalogue-type="grid"
                                no-results-message="Looks like you haven't started any lessons.
                Once you watch a video, it will show up here for you to access later."
                                :six-wide="true"
                                :show-filter="false"
                                :pre-loaded-content="{{ $startedLessons }}"
                            >
                            </catalogue-card-container>
                        </transition>
                    </div>
                </section>
            @endif
        </section>
        <br>
        <section>
            <h3>Catalog Component</h3>
            <collection-wrapper
                :brand="{{ json_encode($brand) }}"
                :collection-type="{{ json_encode($lessonType) }}"
                :filterable-values="{{ json_encode($catalogueMeta['allowableFilters']) }}"
                :include-future-scheduled-content-only = "{{ json_encode(boolval($futureScheduledContentOnly ?? true)) }}"
                :included-types="{{ json_encode([$lessonType]) }}"
                :pre-loaded-content="{{ $listLessons }}"
                :statuses="{{ json_encode($statuses ?? ['published']) }}"
                :title="{{ json_encode($catalogueMeta['shortname'] ?? $catalogueMeta['name']) }}"
            />

        </section>
    </div>
@endsection
