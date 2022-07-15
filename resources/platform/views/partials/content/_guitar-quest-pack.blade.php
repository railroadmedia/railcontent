<div class="flex flex-row bg-white ph-1">
    <div class="relative gq-container corners-10 overflow">
        <a href="{{ $lessonsUrl }}">
            <img class="gq-large-thumb bg-grey-2" src="https://guitareo.s3.amazonaws.com/shop/card-thumbs/guitar-quest-background.jpg">
            <img class="gq-small-thumb bg-grey-2" src="https://guitareo.s3.amazonaws.com/shop/card-thumbs/guitar-quest-background-mobile.jpg">
            <div class="bg-guitareoGuitarQuest text-white font-bison-bold font-bold dense uppercase title tw-px-3 tw-py-2 tw-leading-none" style="position:absolute;top:0;left:0;border-radius:10px 0 10px 0">
                Beginner Guitarist? Start Here!
            </div>
        </a>
        <div class="gq-cta">
            <div class="flex flex-row align-v-center" style="height: 100%;">
                <div class="flex flex-column align-h-center">
                    <div class="mb-1" style="max-width: 190px">
                        <img src="{{ $logoImage }}" alt="Guitar Quest Logo">
                    </div>
                    <h1 class="display font-bison-bold text-white text-center uppercase" style="line-height: 0.9em;">Your guitar journey</h1>
                    <h1 class="display font-bison-bold text-white text-center uppercase" style="line-height: 0.9em;">starts here.</h1>
                    <a
                        href="{{ $nextItemUrl }}"
                        class="btn text-black bg-guitareoGuitarQuest collapse-250 go-to-button mt-1"
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
                        class="mt-1 text-white font-bold dense uppercase tiny no-decoration hide-xs-only" style="opacity:0.8"
                    >
                        See All Lessons &raquo;
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
