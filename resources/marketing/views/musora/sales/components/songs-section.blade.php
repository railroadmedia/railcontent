<div id="songs" class="anchor"></div>
<section class="text-center text-white px-5 sm:px-6 py-10 sm:py-14 lg:py-20" style="background-color:#0c1524;">
    <div class="container max-w-4xl mx-auto">
        <h2><strong>Play your favorite songs.</strong></h2>
        <p class="leading-tight mt-2 sm:mt-3">You’ll have all the tools you need to make sure you never miss a beat. <strong class="font-black text-{{ $theme }} cursor-pointer" x-on:click="soundslice = true;"><u>Try the demo <i class="fal fa-play-circle"></i></u></strong></p>

        <div class="flex items-center justify-center mt-4 sm:mt-6 lg:my-6">
            <div class="w-full sm:w-1/2 h-64 sm:h-96 mx-auto sm:order-1">
                <div style="padding-bottom:62.4%" class="w-full bg-cover bg-center lazyload" x-on:click="soundslice = true;" data-bg={{ $video }}></div>
            </div>
            <div class="w-full sm:w-1/2 flex-grow-0 text-left mt-6 sm:mt-0 sm:pr-8">
                @foreach ($songItems as $key => $songItem)
                    <div class="flex px-4 py-4 rounded-xl w-full"
                        @if($key == 0)
                            x-data="{ dropdown_{{ $key }}: true }"
                        @else
                            x-data="{ dropdown_{{ $key }}: false }"
                        @endif
                        x-bind:class="{ 'border border-{{ $theme }} bg-[#151f31]': dropdown_{{ $key }}  }"
                    >
                        <div class="w-12 sm:w-16 flex-grow-0"><img alt="point icon" src="https://www.musora.com/musora-cdn/image/{{ $songItem['icon'] }}" class="h-6 sm:h-8"></div>
                        <div class="flex-grow pl-4"
                            x-on:click.prevent="dropdown_{{ $key }} = !dropdown_{{ $key }}"
                        >
                            <h5><strong>{!!$songItem['title']!!}</strong></h5>
                            <p class="mt-1 sm:mt-2 text-sm overflow-hidden"
                                x-cloak
                                x-bind:class="{ 'max-h-0': !dropdown_{{ $key }}, 'max-h-[2000px]': dropdown_{{ $key }}  }"
                            >{!! $songItem['desc'] !!}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        @if(empty($promoVersion))
            <a href="/songs" class="sm:mx-1 mb-2 sm:mb-0 w-full sm:w-64 join outline white smaller">SEE SONGS LIST</a>
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
        @if(empty($promoVersion))
            <p class="text-light-navy text-sm mt-5"><em>Songs included with {{ ucfirst($theme) }}+</em></p>
        @endif
    </div>
</section>
