{{-- Featured Pack --}}
<div class="flex flex-row tw-w-full tw-mt-4">
    <div class="relative gq-container corners-10 bg-grey-2 dark:tw-bg-[#081825] tw-overflow-hidden md:tw-h-[276px] tw-w-full">
        <a href="{{ $lessonsUrl }}" class="tw-w-full tw-h-full">
            {{-- Desktop Image --}}
            <img src="https://www.musora.com/musora-cdn/image/width=1600,q_auto:best/https://d122ay5chh2hr5.cloudfront.net/shop/card-thumbs/guitar-quest-background.jpg"
                alt="Guitar Quest Lesson Promotional Image"
                class="tw-w-full tw-hidden md:tw-block tw-transition-opacity tw-opacity-0 tw-h-full tw-object-cover"
                loading="lazy"
                onload="this.classList.remove('tw-opacity-0')"
            >
            {{-- Mobile Image --}}
            <img src="https://www.musora.com/musora-cdn/image/width=600,q_auto:best/https://d122ay5chh2hr5.cloudfront.net/shop/card-thumbs/guitar-quest-background-mobile.jpg"
                alt="Guitar Quest Lesson Promotional Image"
                class="gq-small-thumb tw-transition-opacity tw-opacity-0"
                loading="lazy"
                onload="this.classList.remove('tw-opacity-0')"
            >
            <div class="bg-guitareoGuitarQuest text-white tw-font-normal dense uppercase title tw-px-3 tw-py-2 tw-leading-none tw-absolute tw-top-0 tw-left-0"
                 style="border-radius:10px 0 10px 0">
                Beginner Guitarist? Start Here!
            </div>
        </a>
        <div class="gq-cta">
            <div class="flex flex-row align-v-center" style="height: 100%;">
                <div class="flex flex-column align-h-center">
                    <div class="mb-1" style="max-width: 190px">
                        <img src="{{ $logoImage }}"
                             alt="Guitar Quest Logo"
                             class="tw-transition-opacity tw-opacity-0"
                             loading="lazy"
                             onload="this.classList.remove('tw-opacity-0')"
                        >
                    </div>
                    <h1 class="display tw-font-bison-bold text-white text-center uppercase tw-font-normal tw-text-2xl lg:tw-text-3xl xl:tw-text-4xl" style="line-height: 0.9em;">Your guitar journey<br>starts here.</h1>
                    <a
                        href="{{ $nextItemUrl }}"
                        class="btn text-black bg-guitareoGuitarQuest tw-text-lg collapse-250 go-to-button mt-1"
                    >
                        @if($itemProgress === 'started')
                            Continue Next Lesson &raquo;
                        @elseif($itemProgress === 'completed')
                            <i class="fas fa-check-circle mr-1"></i>
                            Completed
                        @else
                            Start First Lesson &raquo;
                        @endif
                    </a>
                    <a
                        href="{{ $lessonsUrl }}"
                        class="mt-1 text-white dense uppercase tw-text-sm no-decoration hide-xs-only" style="opacity:0.8"
                    >
                        See All Lessons &raquo;
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
