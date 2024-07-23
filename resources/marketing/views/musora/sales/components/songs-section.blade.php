<div id="songs" class="anchor"></div>
<section class="text-center text-white px-5 sm:px-6 py-10 sm:py-14 lg:py-20" style="background-color:#0c1524;">
    <div class="container max-w-5xl mx-auto">
        <h2 class="leading-tight"><strong>Play your favorite songs.</strong></h2>
        <p class="leading-tight mt-3 sm:mt-4">You’ll have all the tools you need to make sure you never miss a beat.</p>

        <div class="flex flex-wrap sm:flex-nowrap items-center justify-center mt-8 sm:my-10">
            <div class="max-w-sm sm:max-w-full"
                :class="{'opacity-0': !lazyLoad, 'opacity-100': lazyLoad}"
                x-intersect.once="lazyLoad = true; $refs.image.src = $refs.image.dataset.src;">
                <picture>
                    <source media="(min-width:1024px)" srcset="https://d21q7xesnoiieh.cloudfront.net/fit-in/1280x0/filters:quality(95)/marketing/{!! $media !!}">
                    <source media="(min-width:640px)" srcset="https://d21q7xesnoiieh.cloudfront.net/fit-in/760x0/filters:quality(95)/marketing/{!! $media !!}">

                    <img x-ref="image"
                        class="w-full transition-opacity opacity-0"
                        loading="lazy"
                        onload="this.classList.remove('opacity-0')"
                        src="https://d21q7xesnoiieh.cloudfront.net/fit-in/50x0/filters:quality(95)/filters:blur(15)/marketing/{!! $media !!}"
                        data-src="https://d21q7xesnoiieh.cloudfront.net/fit-in/670x0/filters:quality(95)/marketing/{!! $media !!}"
                        alt="Device Image">
                </picture>
            </div>
            <div class="w-full sm:w-auto text-left -mt-8 sm:mt-0 sm:pl-5 lg:pl-8 flex-shrink-0">
                @foreach ($songItems as $key => $songItem)
                    <div class="flex my-10 lg:my-14 w-full">
                        <div class="w-9 sm:w-12 lg:w-16 flex-grow-0"><img alt="point icon" src="https://www.musora.com/musora-cdn/image/{{ $songItem['icon'] }}" class="h-6 sm:h-7 lg:h-8 @if($theme == 'musora') filter invert @endif opacity-0 transition-opacity" loading="lazy" onload="this.classList.remove('opacity-0')"></div>
                        <div class="flex-grow pl-1 lg:pl-2">
                            <h5><strong>{!!$songItem['title']!!}</strong></h5>
                            <p class="mx-0 mt-1 sm:mt-2 text-sm" style="max-width: 270px;">{!! $songItem['desc'] !!}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
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
    </div>
</section>
