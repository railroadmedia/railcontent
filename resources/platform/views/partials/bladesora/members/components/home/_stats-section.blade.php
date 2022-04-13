<section class="tw-flex tw-flex-row tw-mb-6 md:tw-mb-8">
    <div class="tw-flex tw-flex-col tw-grow">

        <!-- Section Title -->
        <div class="tw-flex tw-items-center tw-mb-5 tw-w-full tw-justify-between">
            <a href="{{ $userDashboardUrl }}" class="tw-text-[#00101D] dark:tw-text-white tw-pb-1 tw-border-b tw-border-transparent tw-transition-all hover:tw-border-current">
                <h2 class="tw-font-bold tw-text-2xl tw-leading-none lg:tw-leading-none lg:tw-text-3xl">My Stats</h2>
            </a>
            <a href="{{ $userDashboardUrl }}"  
                aria-label="See My Dashboard"
                class="tw-tracking-wider tw-text-base tw-uppercase tw-leading-none tw-font-bebas-neue tw-text-[#00101D] dark:tw-text-white tw-border-b tw-border-transparent tw-transition-all hover:tw-border-current"
            >
                Dashboard
            </a>
        </div> 

        @component('partials.bladesora.members.components.home._method-progress', [
            "brand" => $brand,
            "progress" => $nextLearningPathProgressPercent,
            "level" => explode('.', $nextLearningPathLevel)[0] ?? "1",
            "lesson" => explode('.', $nextLearningPathLevel)[1] ?? "0",
            "methodLogo" => $methodLogo,
        ])
        @endcomponent

        <div class="tw-flex tw-flex-wrap xl:tw-flex-nowrap tw-mt-4">
            @foreach($userMetrics as $userMetric)
                <a href="{{ $userDashboardUrl }}"
                   class="tw-flex tw-flex-col tw-no-underline tw-w-1/2 md:tw-w-1/3 lg:tw-w-1/4 xl:tw-w-full">
                    @include('partials.bladesora.members.components.user-metric', [
                        "brand" => $brand,
                        "icon" => $userMetric['icon'],
                        "value" => $userMetric['value'],
                        "label" => $userMetric['label'],
                    ])
                </a>
            @endforeach
        </div>
    </div>
</section>