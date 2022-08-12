{{-- Guitar Quest: Lesson Complete Modal --}}
<!-- 
    modalOpen === 'lessonComplete' 
    $nextChild->fetch('thumbnail_url')
    $totalCompletedLessons
    $totalCompletedLevels
-->
<div x-show.transition.opacity="modalOpen === 'lessonComplete'" 
     x-cloak
     class="tw-overflow-scroll tw-fixed tw-inset-0 tw-z-250 soft-block tw-bg-fixed"
     style="background-image: url( https://musora.com/cdn-cgi/image/width=1500,quality=90/https://d122ay5chh2hr5.cloudfront.net/guitarquest/assets/star-pattern.svg); background-color: #000718;"
>
    <button class="tw-text-white tw-text-7xl tw-fixed tw-cursor-pointer tw-z-250 tw-bg-transparent tw-border-0 tw-top-0 tw-right-1 lg:tw-top-2 lg:tw-right-2 tw-p-0"
            x-on:click.prevent="modalOpen = false;">
            <i class="fas fa-times"></i>
    </button>

    <div class="tw-w-full tw-flex tw-flex-col tw-min-h-screen">
        <div class="tw-w-full md:tw-w-5/6 xl:tw-w-7/12 tw-m-auto tw-flex-1">
            <div class="tw-flex tw-flex-col tw-relative tw-items-center">
                <img id="packLogo"
                    src="https://musora.com/cdn-cgi/image/width=1000,quality=90/https://d122ay5chh2hr5.cloudfront.net/guitarquest/assets/guitar-quest-logo.png"
                    class="tw-mt-24 tw-w-3/5 md:tw-w-2/5 lg:tw-w-1/2 tw-block"
                >
                <h1 class="heading tw-text-white tw-m-4 tw-uppercase tw-font-normal tw-text-center tw-items-center tw-flex tw-tracking-widest">
                    <img class="tw-w-10 tw-inline-flex tw-mr-3" src="https://musora.com/cdn-cgi/image/width=185,quality=90/https://d122ay5chh2hr5.cloudfront.net/guitarquest/assets/coin-lessons-crushed.png">
                    Lesson Completed!
                </h1>

                <p class="tw-text-white"></p>

                <div class="tw-flex tw-w-full tw-pb-16 tw-flex-wrap tw-flex-col sm:tw-w-1/2">
                    <div class="tw-flex tw-flex-col tw-p-4 tw-relative tw-w-full tw-text-center">
                        <p class="tw-text-white tw-my-3">Here's your next lesson:</p>
                        <!-- Level Image -->
                        <a  href="{{ !empty($nextChild) ? $nextChild->fetch('url') : null }}"
                            title="Go to Next Lesson"
                            class="tw-relative tw-rounded-xl tw-border-solid tw-border-4 tw-border-gray-500 tw-overflow-hidden tw-block tw-mb-4"
                        >
                            <img class="tw-block tw-w-full"
                                src="{{ !empty($nextChild) ? $nextChild->fetch('data.thumbnail_url') : null }}"
                            >
                        </a>
                        <p class="tw-uppercase text-goldenrod tw-text-center">
                            <span>Level {{ $packBundle->fetch('position') }}</span> - 
                            <span>Lesson {{ !empty($nextChild) ? $nextChild->fetch('position') : null }}</span>
                        </p>
                        <p class="tw-text-white tw-text-xl tw-font-bold font-primary tw-text-center tw-my-2">
                            {{ !empty($nextChild) ? $nextChild->fetch('fields.title') : null }}
                        </p>
                    </div>
                </div>

            </div>
        </div>

        <div class="tw-bg-black tw-py-12">
            <div class="tw-w-full md:tw-w-3/4 lg:tw-w-7/12 tw-m-auto tw-flex-1">
                <h1 class="tw-text-white tw-font-extrabold tw-text-2xl tw-text-center font-primary md:tw--mb-2">
                    YOUR GUITAR QUEST PROGRESS
                </h1>

                <div class="container fluid collapsed tw-w-screen tw-bg-black" id="gq-progress">
                    @include('members.partials._content-progress', [
                        "contentType" => $pack->fetch('type'),
                        "progress" => $pack->fetch('progress_percent'),
                        "nextLessonUrl" => '',
                        "xpAmount" => $pack->fetch('xp'),
                        "showCompleteButton" => false,
                        "contentId" => $pack->fetch('id'),
                        "brand" => 'guitareo',
                        "isCompleted" => $pack->fetch('completed', false),
                        "isStarted" => $pack->fetch('started', false),
                        "hideActionButton" => true,
                    ])
                </div>

                <section class="tw-relative">
                    <div class="tw-w-full lg:tw-w-2/3 tw-mx-auto">
                        <div class="tw-w-full md:tw-w-3/4 tw-mx-auto tw-flex tw-justify-around">
                            <!-- Lessons Crushed -->
                            <div class="tw-flex tw-flex-col tw-items-center">
                                <img class="tw-w-24 sm:tw-w-32 md:tw-w-36 tw-block" src="https://musora.com/cdn-cgi/image/width=185,quality=90/https://d122ay5chh2hr5.cloudfront.net/guitarquest/assets/coin-lessons-crushed.png">
                                <h4 class="tw-uppercase tw-text-white mt-2 tw-text-sm font-roboto-condensed-bold">Lessons Crushed</h4>
                                <h3 class="tw-text-7xl tw-text-white tw-font-bold font-roboto-condensed-bold">{{ ($totalCompletedLessons ?? 0) + 1 }}</h3>
                            </div>
                            <!-- Challenges Completed -->
                            <div class="tw-flex tw-flex-col tw-items-center">
                                <img class="tw-w-24 sm:tw-w-32 md:tw-w-36 tw-block" src="https://musora.com/cdn-cgi/image/width=185,quality=90/https://d122ay5chh2hr5.cloudfront.net/guitarquest/assets/coin-challenges-completed.png">
                                <h4 class="tw-uppercase tw-text-white mt-2 tw-text-sm font-roboto-condensed-bold">Challenges Completed</h4>
                                <h3 class="tw-text-7xl tw-text-white tw-font-bold font-roboto-condensed-bold">{{ $totalCompletedLevels ?? 0 }}</h3>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>
</div>