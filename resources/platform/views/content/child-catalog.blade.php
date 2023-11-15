@extends('partials.layout')

@section('meta')
    <title>{{ ucfirst($brand) }} {{ ucfirst($catalogueMeta['name']) }} | Musora</title>
@endsection

@section('layout-styles')
    <style>
        .search-button-col {
            -webkit-box-tw-flex: 0;
            -ms-tw-flex: 0 0 50px;
            tw-flex: 0 0 50px;
            max-width: 50px;
            min-width: 50px;
        }

        button.btn.page-button {
            margin: 0 3px;
        }

        button.btn.page-button > span {
            border-width: 1px;
            font-weight: 500;
        }
    </style>
@endsection

@section('layout-scripts')
    @if($lessonType === 'student-review')
        {{-- todo: script --}}
        {{--        <script src="{{ mix('assets/members/js/student-review-form.js') }}"></script>--}}
    @endif
@endsection

@section('review-modal-section')
    @if($lessonType === 'student-review' || $lessonType === 'student-focus')
        @include('partials._review-modal', ['brand' => $brand])
    @endif
@endsection

@section('content')
    <!-- BREADCRUMBS -->
    <breadcrumb
        brand="{{ $brand }}"
        first-level-url="/{{ $brand }}/workouts" 
        first-level-title="Workouts"
        second-level-url="/{{ $brand }}/workouts/challenges"
        second-level-title="All {{ ucfirst($catalogueMeta['name']) }}"
    >
    </breadcrumb>
    <br>
    <br>


    @if(session()->has('success-message'))
        <div class="form-success-message container mt-3">
            <div class="flex flex-column bg-success shadow corners-10 pa">
                <p class="body text-white">{{ session()->get('success-message') }}</p>
            </div>
        </div>
    @endif

    @if($hasStartedLessons && $lessonType !== 'routine')
        <section class="tw-container tw-mx-auto dark:tw-text-white lg:tw-px-4">
            <!-- Section Title -->
            <div class="tw-flex tw-items-center tw-mt-5 tw-mb-4 tw-w-full tw-justify-between tw-px-4 lg:tw-px-0">
                <a href="/{{ $brand }}/lesson-history/in-progress" class="tw-text-[#00101D] dark:tw-text-white tw-pb-1 tw-border-b tw-border-transparent tw-transition-all hover:tw-border-current">
                    <h2 class="tw-font-bold tw-text-2xl tw-leading-none lg:tw-leading-none lg:tw-text-3xl">In Progress</h2>
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


    <div class="tw-container tw-mx-auto tw-px-4 md:tw-px-8 tw-mt-[10px] dark:tw-text-white">

    </div>

@endsection
