<div id="songs" class="anchor"></div>
<section class="text-center text-white px-5 sm:px-6 py-10 sm:py-14 lg:py-20" style="background-color:#0c1524;">
    <div class="container max-w-5xl mx-auto">
        <h2><strong>Play your favorite songs.</strong></h2>
        <p class="leading-tight mt-2 sm:mt-3">You’ll have all the tools you need to make sure you never miss a beat. <strong class="font-black text-{{ $theme }} cursor-pointer" x-on:click="soundslice = true;"><u>Try the demo <i class="fal fa-play-circle"></i></u></strong></p>

        <div class="flex flex-wrap sm:flex-nowrap items-center justify-center sm:justify-between my-10 sm:my-14 timed-toggle">
            <div class="sm:order-1 rounded-l-xl overflow-hidden py-7 pl-10" style="background-color:#1B2434;">
                @foreach ($songItems as $key => $songItem)
                    @if(!empty($songItem['mediaVid']))
                        <video class="h-64 sm:h-72 lg:h-96 hidden media-toggle rounded-l-xl overflow-hidden @if($key == 0) active @endif" src="{{ $songItem['media'] }}" muted autoplay loop playsinline></video>
                    @else
                        <img class="h-64 sm:h-72 lg:h-96 hidden media-toggle rounded-l-xl overflow-hidden" src="{{ $songItem['media'] }}" >
                    @endif
                @endforeach
            </div>
            <div class="w-full sm:w-1/2 text-left mt-6 sm:mt-0 sm:pr-8">
                @foreach ($songItems as $key => $songItem)
                    <div class="flex px-4 py-4 mb-1 rounded-xl w-full cursor-pointer active-toggle transition-colors duration-500 border bg-[#0c1524] border-[#0c1524] @if($key == 0) active @endif">
                        <div class="w-12 sm:w-16 flex-grow-0"><img alt="point icon" src="https://www.musora.com/musora-cdn/image/{{ $songItem['icon'] }}" class="h-6 sm:h-8 @if($theme == 'musora') filter invert @endif"></div>
                        <div class="flex-grow pl-4">
                            <h5><strong>{!!$songItem['title']!!}</strong></h5>
                            <p class="mt-1 sm:mt-2 text-sm description overflow-hidden max-h-0">{!! $songItem['desc'] !!}</p>
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
