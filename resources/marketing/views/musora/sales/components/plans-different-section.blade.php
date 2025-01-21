<section class="text-center px-5 sm:px-6 py-10 sm:py-14 lg:py-20">
    <div class="container @if(!empty($hideBase)) max-w-3xl @else max-w-5xl @endif mx-auto">
        <h2 class="text-center mb-4 sm:mb-10 @if(!empty($hideBase)) hidden @endif"><strong>How are the plans different?</strong></h2>
        @if(!empty($hideBase))
            <style>
            .hide-base {display:none;}
            .flex.px-3 div.w-1\/4 {width: 50%!important;}
        </style>
        @endif
        <div class="flex items-center rounded-xl py-3 px-3 sm:px-6">
            <div class="w-1/2 text-left"></div>
            <div class="w-1/4 hide-base">
                <img class="h-4 sm:h-6 lg:h-8" src="{{ $logo }}">
            </div>
            <div class="w-1/4">
                <img class="h-4 sm:h-6 lg:h-8" src="{{ $plusLogo }}">
            </div>
        </div>
        <div class="flex items-center rounded-xl py-4 px-3 sm:px-6" style="background-color:#f5f8fc;">
            <div class="w-1/2 text-left">
                <h5 class="mb-1 sm:mb-2 leading-tight"><strong>Method</strong></h5>
                <p class="leading-tight text-xs sm:text-sm">10-level step-by-step curriculum</p>
            </div>
            <div class="w-1/4 hide-base">
                <i class="fas fa-check text-2xl sm:text-3xl text-{{ $theme }}"></i>
            </div>
            <div class="w-1/4">
                <i class="fas fa-check text-2xl sm:text-3xl text-{{ $theme }}"></i>
            </div>
        </div>
        <div class="flex items-center rounded-xl py-4 px-3 sm:px-6">
            <div class="w-1/2 text-left">
                <h5 class="mb-1 sm:mb-2 leading-tight"><strong>Coaches</strong></h5>
                <p class="leading-tight text-xs sm:text-sm">{{ $secondPoint }}</p>
            </div>
            <div class="w-1/4 hide-base">
                <i class="fas fa-check text-2xl sm:text-3xl text-{{ $theme }}"></i>
            </div>
            <div class="w-1/4">
                <i class="fas fa-check text-2xl sm:text-3xl text-{{ $theme }}"></i>
            </div>
        </div>
        <div class="flex items-center rounded-xl py-4 px-3 sm:px-6">
            <div class="w-1/2 text-left">
                <h5 class="mb-1 sm:mb-2 leading-tight"><strong>Workouts</strong></h5>
                <p class="leading-tight text-xs sm:text-sm">Practice along with your favorite musicians and teachers.</p>
            </div>
            <div class="w-1/4 hide-base">
                <i class="fas fa-check text-2xl sm:text-3xl text-{{ $theme }}"></i>
            </div>
            <div class="w-1/4">
                <i class="fas fa-check text-2xl sm:text-3xl text-{{ $theme }}"></i>
            </div>
        </div>
        <div class="flex items-center rounded-xl py-4 px-3 sm:px-6" style="background-color:#f5f8fc;">
            <div class="w-1/2 text-left">
                <h5 class="mb-1 sm:mb-2 leading-tight"><strong>Instruments</strong></h5>
                <p class="leading-tight text-xs sm:text-sm">{{ $thirdPoint }}</p>
            </div>
            <div class="w-1/4 hide-base">
                <i class="fas fa-check text-2xl sm:text-3xl text-{{ $theme }}"></i>
            </div>
            <div class="w-1/4">
                <i class="fas fa-check text-2xl sm:text-3xl text-{{ $theme }}"></i>
            </div>
        </div>
        <div class="flex items-center rounded-xl py-4 px-3 sm:px-6">
            <div class="w-1/2 text-left">
                <h5 class="mb-1 sm:mb-2 leading-tight"><strong>Mentors</strong></h5>
                <p class="leading-tight text-xs sm:text-sm">Student plans, weekly live Q&As, and unlimited personal support</p>
            </div>
            <div class="w-1/4 hide-base">
                <i class="fas fa-check text-2xl sm:text-3xl text-{{ $theme }}"></i>
            </div>
            <div class="w-1/4">
                <i class="fas fa-check text-2xl sm:text-3xl text-{{ $theme }}"></i>
            </div>
        </div>
        <div class="flex items-center rounded-xl py-4 px-3 sm:px-6" style="background-color:#f5f8fc;">
            <div class="w-1/2 text-left">
                <h5 class="mb-1 sm:mb-2 leading-tight"><strong>Songs</strong></h5>
                <p class="leading-tight text-xs sm:text-sm">{{ $fifthPoint }}</p>
            </div>
            <div class="w-1/4 hide-base"></div>
            <div class="w-1/4">
                <i class="fas fa-check text-2xl sm:text-3xl text-{{ $theme }}"></i>
            </div>
        </div>
    </div>
</section>
