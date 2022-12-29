<div class="h-5 sm:h-10 -mt-5 sm:-mt-10" style="background: linear-gradient(to bottom right, transparent calc(50% - 1px), transparent, #0c1524 calc(50% + 1px));"></div>
<section class="text-center text-white px-5 sm:px-6 py-10 sm:py-14 lg:py-20" style="background-color:#0c1524;">
    <div class="container max-w-6xl mx-auto">
        <h2><strong>{!! $header !!}</strong></h2>
        <p class="leading-tight mt-2 sm:mt-3">{!! $desc !!}</p>

        <div class="flex flex-wrap lg:flex-nowrap items-center justify-center mt-4 sm:mt-6 lg:my-6">
            <video class="lg:order-1 h-64 sm:h-96 rounded-xl cursor-pointer" x-on:click="soundslice = true;" src="{{ $video }}" type="video/mp4" autoplay="" loop="" playsinline="" muted></video>
            <div class="text-left w-full sm:w-auto mt-6 lg:mt-0 lg:pr-8">
                @foreach ($songItems as $songItem)
                    <div class="flex mb-6 lg:my-6">
                        <div class="w-10 sm:w-14 flex-grow-0"><img alt="point icon" src="{{ $songItem['icon'] }}" class="h-6 sm:h-10"></div>
                        <div class="flex-grow pl-4">
                            <h5><strong>{!!$songItem['title']!!}</strong></h5>
                            <p class="mt-1 sm:mt-2 text-sm">{!! $songItem['desc'] !!}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
        @if(empty($promoVersion))
            <a href="/songs" class="sm:mx-1 mb-2 sm:mb-0 w-full sm:w-64 join outline {{ $theme }}-blue smaller">SEE SONGS LIST <i class="fas fa-list-music"></i> </a>
        @endif
        <a class="sm:mx-1 w-full sm:w-64 join {{ $theme }}-blue smaller @if(!empty($promoVersion)) anchor-slide @endif"
            @if(!empty($promoVersion))
                href="#customize-anchor"
            @else
                href="/choose-your-trial"
            @endif
        >
            @if(!empty($promoVersion))
                Get Started &raquo;
            @else
                START FOR FREE <i class="fas fa-arrow-right" style="line-height: 0;"></i>
            @endif
        </a>
        @if(empty($promoVersion))
            <p class="text-light-navy text-sm mt-5"><em>Songs included with {{ $brandName }}+</em></p>
        @endif
    </div>
</section>
<section class="text-center text-white px-5 sm:px-6 py-7 sm:py-8" style="    background: linear-gradient(40deg,#03c8ac, #0976db, #9a01ee, #f61a30);">
    <div class="container max-w-6xl mx-auto">
        <div class="flex flex-wrap sm:flex-nowrap items-center justify-center">
            <img class="h-12 sm:h-14" src="https://drumeo-assets.s3.amazonaws.com/sales/2023/musora-instruments.svg">
            <p class="w-full sm:w-auto sm:text-left max-w-md mt-2 sm:mt-0 mx-0 sm:pl-8 leading-normal sm:leading-tight"><strong>Any instrument, any time.</strong><br>
                {{ $bannerDesc }}
            </p>
        </div>
    </div>
</section>
