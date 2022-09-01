{{-- Featured Pack --}}
<div class="flex flex-row ">
    <div class="relative gq-container corners-10 overflow bg-grey-2 dark:tw-bg-[#081825]">
        <a href="{{ $lessonsUrl }}">
            {{-- Desktop Image --}}
            <img src="https://guitareo.s3.amazonaws.com/shop/card-thumbs/guitar-quest-background.jpg"
                alt="Guitar Quest Lesson Promotional Image"
                class="gq-large-thumb tw-transition-opacity tw-opacity-0" 
                loading="lazy"
                onload="this.classList.remove('tw-opacity-0')"
            >
            {{-- Mobile Image --}}
            <img src="https://guitareo.s3.amazonaws.com/shop/card-thumbs/guitar-quest-background-mobile.jpg"
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
                    <h1 class="display tw-font-bison-bold text-white text-center uppercase tw-font-normal" style="line-height: 0.9em;">Your guitar journey</h1>
                    <h1 class="display tw-font-bison-bold text-white text-center uppercase tw-font-normal" style="line-height: 0.9em;">starts here.</h1>
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
