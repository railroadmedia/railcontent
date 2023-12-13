<div id="method" class="anchor"></div>
<section class="text-center px-5 sm:px-6 py-10 sm:py-14 lg:py-20">
    <div class="container max-w-4xl mx-auto">
        <h2 class="leading-tight"><strong><span class="border-2 border-{{ $theme }} rounded-full px-3 sm:px-4 py-1 inline-block">6</span> reasons why you’ll <br class="inline sm:hidden">love learning here.</strong></h2>
        <p class="mt-2 sm:mt-3 mb-8 sm:mb-10">Level up your skills with the lessons, teachers, and<br class="hidden sm:inline lg:hidden">  practice tools <strong class="font-black">trusted by <span class="text-{{ $theme }}">{{ number_format(Prices::$students) }}</span> active students</strong>. </p>
        <div class="flex flex-wrap items-start justify-center text-left mb-2 sm:mb-6">
            @foreach ($gridItems as $key => $gridItem)
                <div class="flex flex-wrap items-start w-full sm:w-1/2 pb-4 sm:pb-0 sm:px-3 mb-4 sm:mb-8">
                    <div class="aspect-16:9 overflow-hidden text-white relative w-full bg-cover bg-center rounded-xl"
                        style="background-image:url('https://d21q7xesnoiieh.cloudfront.net/fit-in/640x0/filters:quality(95)/{{ $gridItem['image'] }}');"
                        x-data="{ descriptionSelected: false }"
                    >
                        <div class="absolute bottom-0 left-0 right-0 px-5 pb-5 pt-10" style="background:linear-gradient(to bottom, transparent, #000);"
                            x-on:click="descriptionSelected = true"

                        >
                            <h5 class="leading-tight"><strong class="font-black"><span class="border-2 border-white rounded-full px-2 mr-2 inline-block">+</span> {{ $gridItem['title'] }}</strong></h5>
                            <p class="leading-normal text-sm mt-0.5"
                                x-cloak
                                x-bind:class="{ 'hidden': !descriptionSelected }"
                            >{{ $gridItem['desc'] }}</p>
                        </div>
                    </div>
                </div>
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
