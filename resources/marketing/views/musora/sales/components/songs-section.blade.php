<div class="h-5 sm:h-10 -mt-5 sm:-mt-10" style="background: linear-gradient(to bottom right, transparent calc(50% - 1px), transparent, #0c1524 calc(50% + 1px));"></div>
<section class="text-center text-white px-5 sm:px-6 py-10 sm:py-14 lg:py-20" style="background-color:#0c1524;">
    <div class="container max-w-6xl mx-auto">
        <h2><strong>{!! $header !!}</strong></h2>
        <p class="leading-tight mt-3">{!! $desc !!}</p>

        <div class="flex flex-wrap sm:flex-nowrap items-center justify-center my-6 sm:my-12">
            <video class="sm:order-1 h-64 lg:h-96 rounded-xl cursor-pointer lazyload" x-on:click="soundslice = true;" data-src="{{ $video }}" type="video/mp4" autoplay="" loop="" playsinline="" muted></video>
            <div class="text-left mt-6 sm:mt-0 sm:pr-8">
                @foreach ($songItems as $songItem)
                    <div class="flex mb-4">
                        <div class="w-10 sm:w-14 flex-grow-0"><img alt="point icon" src="{{ $songItem['icon'] }}" class="h-6 sm:h-10"></div>
                        <div class="flex-grow pl-4">
                            <h5><strong>{!!$songItem['title']!!}</strong></h5>
                            <p class="mt-2 text-sm">{!! $songItem['desc'] !!}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
        @if(empty($promoVersion))
            <a href="/songs" class="mx-1 mb-2 sm:mb-0 join outline {{ $theme }}-blue smaller">SEE SONGS LIST <i class="fas fa-list-music"></i> </a>
        @endif
        <a href="/pricing" class="mx-1 join {{ $theme }}-blue smaller">
            @if(!empty($promoVersion))
                Get Started &raquo;
            @else
                START FOR FREE <i class="fas fa-arrow-right"></i>
            @endif
        </a>
        <p class="text-light-navy text-sm mt-5"><em>Songs included with {{ $brandName }}+</em></p>
    </div>
</section>
<section class="text-center text-white px-5 sm:px-6 py-7 sm:py-8" style="    background: linear-gradient(40deg,#03c8ac, #0976db, #9a01ee, #f61a30);">
    <div class="container max-w-6xl mx-auto">
        <div class="flex flex-wrap sm:flex-nowrap items-center justify-center">
            <img class="h-12 sm:h-14" src="https://drumeo-assets.s3.amazonaws.com/sales/2023/musora-instruments.svg">
            <p class="w-full sm:w-auto sm:text-left max-w-md mt-2 sm:mt-0 mx-0 sm:pl-8 leading-normal sm:leading-tight"><strong>Any instrument, any time.</strong><br>
                Powered by Musora, {{ $brandName }} includes full access to our communities for piano, guitar, and voice.
            </p>
        </div>
    </div>
</section>
