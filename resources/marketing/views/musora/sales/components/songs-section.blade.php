<div id="songs" class="anchor"></div>
<section class="text-center text-white px-5 sm:px-6 py-10 sm:py-14 lg:py-20" style="background-color:#0c1524;">
    <div class="container max-w-4xl mx-auto">
        <h2><strong>Play your favorite songs.</strong></h2>
        <p class="leading-tight mt-2 sm:mt-3">You’ll have all the tools you need to make sure you never miss a beat.
            @if($theme != 'musora')
                <strong class="font-black text-{{ $theme }} cursor-pointer" x-on:click="soundslice = true;"><u>Try the demo <i class="fal fa-play-circle"></i></u></strong>
            @else
                <br class="lg:hidden"><strong class="font-black mr-0.5">Try the demo <i class="fas fa-arrow-right"></i></strong>
                <span class="inline-block rounded-full border px-1.5 py-0.5 cursor-pointer mr-0.5 border-drumeo text-drumeo" x-on:click="drumeoSoundslice = true;"><i class="fal fa-drum"></i></span>
                <span class="inline-block rounded-full border px-1.5 py-0.5 cursor-pointer mr-0.5 border-pianote text-pianote" x-on:click="pianoteSoundslice = true;"><i class="fal fa-piano"></i></span>
                <span class="inline-block rounded-full border px-1.5 py-0.5 cursor-pointer mr-0.5 border-guitareo text-guitareo" x-on:click="guitareoSoundslice = true;"><i class="fal fa-guitar"></i></span>
                <span class="inline-block rounded-full border px-1.5 py-0.5 cursor-pointer border-singeo text-singeo" x-on:click="singeoSoundslice = true;"><i class="fal fa-microphone-stand"></i></span>
            @endif

        </p>

        <div class="flex flex-wrap sm:flex-nowrap items-center justify-center my-10 sm:my-14 timed-toggle">
            <div class="sm:order-1 rounded-l-xl overflow-hidden py-10 pl-10 max-w-xs sm:max-w-full" style="background-color:#1B2434;">
                @foreach ($songItems as $key => $songItem)
                    @if(!empty($songItem['mediaVid']))
                    <video
                    class="w-full hidden media-toggle rounded-l-xl overflow-hidden @if($key == 0) active @endif"
                    src="{{ $songItem['media'] }}"
                    muted
                    autoplay
                    loop
                    playsinline
                    preload="none"
                    x-ref="videoSongsSection"
                    x-effect="if (videoLoaded) { $refs.videoSongsSection.play(); }"
                    x-intersect.once="videoLoaded = true"
                    ></video>
                        {{-- <video class="h-64 sm:h-72 lg:h-96 hidden media-toggle rounded-l-xl overflow-hidden @if($key == 0) active @endif" src="{{ $songItem['media'] }}" muted autoplay loop playsinline></video> --}}
                    @else
                        <img class="w-full hidden media-toggle rounded-l-xl overflow-hidden opacity-0 transition-opacity" loading="lazy" onload="this.classList.remove('opacity-0')" src="{{ $songItem['media'] }}" >
                    @endif
                @endforeach
            </div>
            <div class="w-full sm:w-auto text-left mt-6 sm:mt-0 sm:pr-5 lg:pr-8 flex-shrink-0">
                @foreach ($songItems as $key => $songItem)
                    <div class="flex px-4 py-4 mb-1 rounded-xl w-full cursor-pointer active-toggle transition-colors duration-500 border bg-[#0c1524] border-[#0c1524] @if($key == 0) active @endif">
                        <div class="w-9 sm:w-12 lg:w-16 flex-grow-0"><img alt="point icon" src="https://www.musora.com/musora-cdn/image/{{ $songItem['icon'] }}" class="h-6 sm:h-7 lg:h-8 @if($theme == 'musora') filter invert @endif opacity-0 transition-opacity" loading="lazy" onload="this.classList.remove('opacity-0')"></div>
                        <div class="flex-grow pl-2 lg:pl-4">
                            <h5><strong>{!!$songItem['title']!!}</strong></h5>
                            <p class="mx-0 mt-1 sm:mt-2 text-sm description overflow-hidden max-h-0" style="max-width: 270px;">{!! $songItem['desc'] !!}</p>
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
