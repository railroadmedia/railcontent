
<div id="method" class="anchor"></div>
<section class="text-center px-5 sm:px-6 py-10 sm:py-14 lg:py-20">
    <div class="container max-w-5xl mx-auto">
        <h2 class="leading-tight"><strong><span class="border-2 border-{{ $theme }} rounded-full px-3 sm:px-4 py-1 inline-block">@if(!empty($seven)) 7 @else 6 @endif</span> reasons why you’ll <br class="inline sm:hidden">love learning here.</strong></h2>
        <p class="mt-2 sm:mt-3 mb-6 sm:mb-10">Level up your skills with the lessons, teachers, and<br class="hidden sm:inline lg:hidden">  practice tools <strong class="font-black">trusted by <span class="text-{{ $theme }}">{{ number_format(Prices::$students) }}</span> active students</strong>. </p>
        <div class="flex flex-wrap text-left">
            @if(!empty($seven))
                @foreach ($gridItems as $key => $gridItem)
                    @if($key == 6)
                        <div class="flex flex-wrap items-start w-full sm:px-3 mb-5 sm:mb-8" x-data="{ open: false }">
                            <div class="pb-[70%] sm:pb-96 overflow-hidden text-white relative w-full rounded-xl"
                                 :class="{'opacity-0': !lazyLoad, 'opacity-100': lazyLoad}"
                                 x-intersect.once="lazyLoad = true"
                            >
                                <picture>
                                    <source media="(min-width: 1024px)" srcset="https://d21q7xesnoiieh.cloudfront.net/fit-in/2000x0/filters:quality(95)/{{ $gridItem['image'] }}">
                                    <source media="(min-width: 640px)" srcset="https://d21q7xesnoiieh.cloudfront.net/fit-in/0x770/filters:quality(95)/{{ $gridItem['image'] }}">
                                    <img src="https://d21q7xesnoiieh.cloudfront.net/fit-in/0x470/filters:quality(95)/{{ $gridItem['image'] }}"
                                         alt="{{ $gridItem['title'] }}"
                                        class="absolute inset-0 w-full h-full object-cover bg-center rounded-xl opacity-0 transition-opacity"
                                        style="object-position: 60% 0;" loading="lazy" onload="this.classList.remove('opacity-0')">
                                </picture>

                                <div class="absolute bottom-0 left-0 right-0 px-4 sm:px-5 pb-5 sm:pb-7 pt-10 flex items-start" style="background:linear-gradient(to bottom, transparent, #000);">
                                    <h5 class="rounded-full border-2 border-{{ $theme }} inline-block w-9 h-9 leading-8 mx-0 text-center flex-grow-0 flex-shrink-0"><strong>1</strong></h5>
                                    <div class="pl-3">
                                        <h5 class="leading-tight"><strong>{{ $gridItem['title'] }}</strong></h5>
                                        <p class="leading-normal text-sm transition-all duration-300 overflow-hidden max-w-sm mx-0">{{ $gridItem['desc'] }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                @endforeach
            @endif
            <div class="flex flex-wrap items-start justify-center text-left sm:mb-6 w-full sm:w-1/2">
                @foreach ($gridItems as $key => $gridItem)
                    @if($key < 3)
                    <div class="flex flex-wrap items-start w-full sm:px-3 mb-5 sm:mb-8" x-data="{ open: false }">
                        <div class="pb-[70%] @if(empty($gridItem['big'])) sm:pb-[60%] @else sm:pb-[80%]  @endif overflow-hidden text-white relative w-full rounded-xl"
                             :class="{'opacity-0': !lazyLoad, 'opacity-100': lazyLoad}"
                             x-intersect.once="lazyLoad = true; $refs.image.src = $refs.image.dataset.src;"
                        >
                            <picture class="absolute inset-0 w-full h-full object-cover bg-center rounded-xl" style="background: linear-gradient(180deg, transparent, rgba(246, 248, 252, 0.9));">
                                <source srcset="https://d21q7xesnoiieh.cloudfront.net/fit-in/980x0/filters:quality(95)/{{ $gridItem['image'] }}"
                                        media="(min-width: 640px)">
                                <img x-ref="image"
                                    src="https://d21q7xesnoiieh.cloudfront.net/fit-in/5x0/filters:quality(10)/filters:blur(5)/{{ $gridItem['image'] }}"
                                    data-src="https://d21q7xesnoiieh.cloudfront.net/fit-in/980x0/filters:quality(95)/{{ $gridItem['image'] }}"
                                     alt="{{ $gridItem['title'] }}"
                                     class="w-full h-full object-cover rounded-xl opacity-0 transition-opacity"
                                     onload="this.classList.remove('opacity-0')">
                            </picture>

                            <div class="absolute bottom-0 left-0 right-0 px-4 sm:px-3 lg:px-5 pb-4 lg:pb-7 pt-10 flex items-start" style="background:linear-gradient(to bottom, transparent, #000);">
                                <h5 class="rounded-full border-2 border-{{ $theme }} inline-block w-9 h-9 leading-8 mx-0 text-center flex-grow-0 flex-shrink-0"><strong>@if($theme == 'musora'){{ $key + 2 }}@else{{ $key + 1 }}@endif</strong></h5>
                                <div class="pl-3">
                                    <h5 class="leading-tight"><strong>{{ $gridItem['title'] }}</strong></h5>
                                    <p class="leading-normal text-sm transition-all duration-300 overflow-hidden max-w-sm mx-0">{{ $gridItem['desc'] }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endif
                @endforeach
            </div>
            <div class="flex flex-wrap items-start justify-center text-left mb-2 sm:mb-6 w-full sm:w-1/2">
                @foreach ($gridItems as $key => $gridItem)
                    @if($key > 2 && $key < 6)
                        <div class="flex flex-wrap items-start w-full sm:px-3 mb-5 sm:mb-8" x-data="{ open: false }">
                            <div class="pb-[70%] @if(empty($gridItem['big'])) sm:pb-[60%] @else sm:pb-[80%]  @endif overflow-hidden text-white relative w-full rounded-xl"
                                :class="{'opacity-0': !lazyLoad, 'opacity-100': lazyLoad}"
                                x-intersect.once="lazyLoad = true; $refs.image.src = $refs.image.dataset.src;"
                            >
                            <picture class="absolute inset-0 w-full h-full object-cover bg-center rounded-xl" style="background: linear-gradient(180deg, transparent, rgba(246, 248, 252, 0.9));">
                                <source srcset="https://d21q7xesnoiieh.cloudfront.net/fit-in/980x0/filters:quality(95)/{{ $gridItem['image'] }}"
                                        media="(min-width: 640px)">
                                <img x-ref="image"
                                    src="https://d21q7xesnoiieh.cloudfront.net/fit-in/5x0/filters:quality(10)/filters:blur(5)/{{ $gridItem['image'] }}"
                                    data-src="https://d21q7xesnoiieh.cloudfront.net/fit-in/980x0/filters:quality(95)/{{ $gridItem['image'] }}"
                                    alt="{{ $gridItem['title'] }}"
                                    class="w-full h-full object-cover rounded-xl opacity-0 transition-opacity"
                                    loading="lazy"
                                    onload="this.classList.remove('opacity-0')">
                            </picture>

                                <div class="absolute bottom-0 left-0 right-0 px-4 sm:px-3 lg:px-5 pb-4 lg:pb-7 pt-10 flex items-start" style="background:linear-gradient(to bottom, transparent, #000);">
                                    <h5 class="rounded-full border-2 border-{{ $theme }} inline-block w-9 h-9 leading-8 mx-0 text-center flex-grow-0 flex-shrink-0"><strong>@if($theme == 'musora'){{ $key + 2 }}@else{{ $key + 1 }}@endif</strong></h5>
                                    <div class="pl-3">
                                        <h5 class="leading-tight"><strong>{{ $gridItem['title'] }}</strong></h5>
                                        <p class="leading-normal text-sm transition-all duration-300 overflow-hidden max-w-sm mx-0">{{ $gridItem['desc'] }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                @endforeach
            </div>
        </div>
       @if(empty($shortVersion))
        @if(empty($promoVersion))
            <a href="/method" class="sm:mx-1 mb-2 sm:mb-0 w-full sm:w-64 join outline black smaller">{{ $theme }} METHOD</a>
        @endif
        <a role="link" aria-label="See your deal" class="sm:mx-1 w-full sm:w-64 join {{ $theme }} smaller @if(!empty($promoVersion)) anchor-slide @endif"
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
       @endif
    </div>
</section>
