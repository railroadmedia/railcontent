<div id="method" class="anchor"></div>
<section class="text-center px-5 sm:px-6 py-10 sm:py-14 lg:py-20">
    <div class="container max-w-5xl mx-auto">
        <h2 class="leading-tight"><strong><span class="border-2 border-{{ $theme }} rounded-full px-3 sm:px-4 py-1 inline-block">6</span> reasons why you’ll <br class="inline sm:hidden">love learning here.</strong></h2>
        <p class="mt-2 sm:mt-3 mb-8 sm:mb-10">Level up your skills with the lessons, teachers, and<br class="hidden sm:inline lg:hidden">  practice tools <strong class="font-black">trusted by <span class="text-{{ $theme }}">{{ number_format(Prices::$students) }}</span> active students</strong>. </p>
        <div class="flex flex-wrap items-start justify-center text-left mb-2 sm:mb-6 hidden sm:flex">
            @foreach ($gridItems as $key => $gridItem)
                <div class="flex flex-wrap items-start w-full sm:w-1/2 lg:w-1/3 pb-4 sm:pb-0 sm:px-3 mb-4 sm:mb-8 border-b sm:border-b-0 max-w-xs sm:max-w-full">
                    <picture class="w-1/3 sm:w-full">
                        <source media="(min-width:640px)" srcset="https://www.musora.com/musora-cdn/image/width=640,quality=95/{{ $gridItem['image'] }}">
                        <img
                            class=" rounded-xl mb-3 transition-opacity opacity-0"
                            src="https://www.musora.com/musora-cdn/image/width=220,quality=95/{{ $gridItem['image'] }}"
                            alt="grid{{$key+1}}"
                            loading="lazy"
                            onload="this.classList.remove('opacity-0')"
                        >
                    </picture>
                    <div class="w-2/3 sm:w-full pl-3 sm:pl-0">
                        <p class="leading-tight mb-0.5"><strong class="font-black"><span class="border border-{{ $theme }} rounded-full px-2 py-0.5 inline-block">{{$key+1}}</span> {{ $gridItem['title'] }}</strong></p>
                        <p class="leading-normal text-sm">{{ $gridItem['desc'] }}</p>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="flex flex-wrap items-start justify-center text-left mb-2 sm:mb-6 flex sm:hidden">
            @foreach ($gridItems as $key => $gridItem)
                @include('_partials.components.question-dropdown', [
                    'variant' => true,
                    'num' => $key+1,
                    "title" => $gridItem['title'],
                    "desc" => $gridItem['desc'],
                    'lessonInfo' => $gridItem['lessonInfo'],
                    'open' => $key === 0 ? true : false
                ])
            @endforeach
        </div>
        @if(empty($promoVersion))
            <a href="/method" class="sm:mx-1 mb-2 sm:mb-0 w-full sm:w-64 join outline black smaller">{{ $theme }} METHOD</a>
        @endif
        <a class="sm:mx-1 w-full sm:w-64 join {{ $theme }} smaller @if(!empty($promoVersion)) anchor-slide @endif"
            @if(!empty($promoVersion))
                href="#customize-anchor"
            @elseif(!empty($month))
                href="/choose-your-trial-month"
            @else
                href="/choose-plan"
            @endif
        >
            @if(!empty($promoVersion) && empty($trialVersion))
                SEE YOUR DEAL &raquo;
            @else
                START FOR FREE <i class="fas fa-arrow-right" style="line-height: 0;"></i>
            @endif
        </a>
    </div>
</section>
