<div id="songs" class="anchor"></div>
<section class="text-center text-white px-5 sm:px-6 py-10 sm:py-14 lg:py-20" style="background-color:#0c1524;">
    <div class="container max-w-4xl mx-auto">
        <h2><strong>{!! $header !!}</strong></h2>
        <p class="leading-tight mt-2 sm:mt-3">{!! $desc !!} <strong class="cursor-pointer" x-on:click="soundslice = true;"><u>Try the demo &raquo;</u></strong></p>

        <div class="max-w-xs sm:max-w-xl lg:max-w-4xl xl:max-w-full mx-auto">
            <div style="padding-bottom:62.4%" class="mt-4 sm:mt-6 lg:mt-8 lg:mb-6 bg-cover bg-center lazyload" x-on:click="soundslice = true;" data-bg="https://www.musora.com/musora-cdn/image/width=1500,quality=85/{{ $video }}"></div>
        </div>
        <div class="text-center w-full sm:w-auto mt-6 lg:mt-0 mx-auto mb-5">
            <div class="flex flex-wrap">
                @foreach ($songItems as $songItem)
                    <div class="w-full sm:w-1/3 sm:px-2 lg:px-6 mb-6 lg:my-6">
                        <div class="flex sm:inline-block">
                            <div class="w-14 sm:w-full flex-shrink-0">
                                <img alt="point icon" src="https://www.musora.com/musora-cdn/image/{{ $songItem['icon'] }}" class="h-6 sm:h-10">
                            </div>
                            <div class="text-left sm:text-center">
                                <p class="mb-1 sm:my-2"><strong>{!!$songItem['title']!!}</strong></p>
                                <p class="text-sm">{!! $songItem['desc'] !!}</p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        @if(empty($promoVersion))
            <a href="/songs" class="sm:mx-1 mb-2 sm:mb-0 w-full sm:w-64 join outline text-{{ $theme }} border-{{ $theme }} smaller">SEE SONGS LIST</a>
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
            <p class="text-light-navy text-sm mt-5"><em>Songs included with {{ $brandName }}+</em></p>
        @endif
    </div>
</section>
