<div class="h-5 sm:h-10 -mt-5 sm:-mt-10" style="background: linear-gradient(to bottom right, transparent calc(50% - 1px), transparent, #f4f8fb calc(50% + 1px));"></div>
<div id="method" class="anchor"></div>
<section class="text-center px-5 sm:px-6 py-10 sm:py-14 lg:py-20">
    <div class="container max-w-6xl mx-auto">
        <h2><strong>{!! $header !!}</strong></h2>
        <p class="mt-2 sm:mt-3 mb-8 sm:mb-10">{!! $desc !!}</p>
        <div class="flex flex-wrap items-start justify-center text-left mb-2 sm:mb-6">
            @foreach ($gridItems as $key => $gridItem)
                <div class="flex flex-wrap items-start w-full sm:w-1/2 lg:w-1/3 pb-4 sm:pb-0 sm:px-3 mb-4 sm:mb-8 border-b sm:border-b-0">
                    <picture class="w-1/3 sm:w-full">
                        <source media="(min-width:640px)" srcset="https://www.musora.com/musora-cdn/image/width=640,quality=85/{{ $gridItem['image'] }}">
                        <img
                            class=" rounded-xl mb-3 transition-opacity opacity-0"
                            src="https://www.musora.com/musora-cdn/image/width=200,quality=85/{{ $gridItem['image'] }}"
                            alt="grid{{$key+1}}"
                            loading="lazy"
                            onload="this.classList.remove('opacity-0')"
                        >
                    </picture>
                    <p class="w-2/3 sm:w-full pl-3 sm:pl-0 leading-normal">
                        <strong class="font-black inline-block mb-0.5">{{ $gridItem['title'] }}</strong><br> {{ $gridItem['desc'] }}
                    </p>
                </div>
            @endforeach
        </div>
        @if(empty($promoVersion))
            <a href="/method" class="sm:mx-1 mb-2 sm:mb-0 w-full sm:w-64 join outline text-{{ $theme }} border-{{ $theme }} smaller">EXPLORE THE METHOD <i class="fas fa-info-circle"></i> </a>
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
