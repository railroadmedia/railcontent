{{-- Guitar Quest: Quest Complete Modal --}}
<!-- 
    modalOpen === 'questComplete' 
    $totalCompletedLessons
    $totalCompletedLevels
-->
<div x-show.transition.opacity="modalOpen === 'questComplete'" 
     x-cloak
     class="tw-overflow-scroll tw-fixed tw-inset-0 tw-z-250 soft-block tw-bg-fixed"
     style="background-image: url( https://musora.com/cdn-cgi/image/width=1500,quality=90/https://d122ay5chh2hr5.cloudfront.net/guitarquest/assets/star-pattern.svg ); background-color: #000718;"
>
    <button class="tw-text-white tw-text-7xl tw-fixed tw-cursor-pointer tw-z-250 tw-bg-transparent tw-border-0 tw-top-0 tw-right-1 lg:tw-top-2 lg:tw-right-2 tw-p-0"
            x-on:click.prevent="modalOpen = false;">
            <i class="fas fa-times"></i>
    </button>

    <div class="tw-w-full tw-flex tw-flex-col tw-min-h-full">

        <div class="tw-w-full tw-overflow-hidden tw-flex tw-flex-1">
            <div class="tw-w-full tw-flex md:tw-w-5/6 xl:tw-w-7/12 tw-m-auto">
                <div class="tw-hidden md:tw-flex tw-flex-col tw-items-center tw-w-1/2 tw-relative">
                    <img width="730px" 
                         class="tw-absolute tw-max-w-none" 
                         style="top: -360px; right: -90px;"
                         src="https://musora.com/cdn-cgi/image/width=730,quality=90/https://d122ay5chh2hr5.cloudfront.net/guitarquest/assets/rob-scallon-header.png">
                </div>
                <div class="tw-flex tw-flex-col tw-items-center tw-w-3/4 md:tw-w-1/2 tw-mx-auto tw-z-250">
                    <img id="packLogo"
                        src="https://musora.com/cdn-cgi/image/width=1000,quality=90/https://d122ay5chh2hr5.cloudfront.net/guitarquest/assets/guitar-quest-logo.png"
                        class="tw-mt-24 tw-w-full tw-block"
                    >
                    <h1 class="heading tw-text-white tw-mt-4 tw-mb-8 tw-uppercase tw-font-normal tw-text-center tw-items-center tw-flex tw-tracking-widest">
                    Completed!
                    </h1>
                    <a  href="/members/packs/guitar-quest" 
                        class="btn bg-guitareoGuitarQuest inverted text-guitareoGuitarQuest tw-w-2/3">
                        <span class="mr-1">Return To Map</span> 
                    </a>
                </div>
            </div>
        </div>

        <div class="tw-bg-black tw-py-12 tw-z-200 tw-relative">
            <div class="tw-w-full md:tw-w-3/4 lg:tw-w-7/12 tw-m-auto tw-flex-1">
                <h1 class="tw-text-white tw-font-extrabold tw-text-2xl tw-text-center font-primary md:tw--mb-2">
                    YOUR GUITAR QUEST PROGRESS
                </h1>

                <div class="container fluid collapsed tw-w-screen bg-gq-blue" id="gq-progress">
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
                                <h3 class="tw-text-7xl tw-font-bold tw-text-white font-roboto-condensed-bold">{{ $totalCompletedLessons ?? 0 }}</h3>
                            </div>
                            <!-- Challenges Completed -->
                            <div class="tw-flex tw-flex-col tw-items-center">
                                <img class="tw-w-24 sm:tw-w-32 md:tw-w-36 tw-block" src="https://musora.com/cdn-cgi/image/width=185,quality=90/https://d122ay5chh2hr5.cloudfront.net/guitarquest/assets/coin-challenges-completed.png">
                                <h4 class="tw-uppercase tw-text-white mt-2 tw-text-sm font-roboto-condensed-bold">Challenges Completed</h4>
                                <h3 class="tw-text-7xl tw-font-bold tw-text-white font-roboto-condensed-bold">{{ ($totalCompletedLevels ?? 0) + 1 }}</h3>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>
</div>