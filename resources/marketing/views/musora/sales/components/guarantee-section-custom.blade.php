<div class="h-5 sm:h-10 -mt-10 relative" 
    aria-hidden="true" 
    style="background: linear-gradient(to bottom right, transparent calc(50% - 1px), transparent, {{ $hasGradient ? $gradientEndColor : $backgroundColor }} calc(50% + 1px));">
</div>

<div id="guarantee" class="anchor"></div>
<section class="pb-10 sm:pb-14 lg:pb-20 relative text-center px-6"
    style="{{ $hasGradient 
        ? 'color:' . $textColor . '!important;background: linear-gradient(0deg, ' . $gradientStartColor . ' 0%, ' . $gradientEndColor . ' 100%);'
        : 'background-color:' . $backgroundColor . ';' }}">
    
    <div class="container mx-auto max-w-6xl"
        :class="{'opacity-0': !lazyLoad, 'opacity-100': lazyLoad}"
        x-intersect.once="lazyLoad = true; $refs.guaranteeBadge.src = $refs.guaranteeBadge.dataset.src;">
        
        <picture>
            <source media="(min-width:640px)" srcset="https://d21q7xesnoiieh.cloudfront.net/fit-in/250x0/filters:quality(95)/{{ $badge }}">
            <img x-ref="guaranteeBadge"
                class="h-28 md:h-32 -mt-16 md:-mt-20 mb-5 sm:mb-8 transition-opacity opacity-0 duration-300"
                src="https://d21q7xesnoiieh.cloudfront.net/fit-in/35x0/filters:quality(1)/{{ $badge }}"
                data-src="https://d21q7xesnoiieh.cloudfront.net/fit-in/250x0/filters:quality(95)/{{ $badge }}"
                onload="this.classList.remove('opacity-0')"
                loading="lazy"
                alt="guarantee-badge">
        </picture>

        <h3 class="leading-tight">{!! $header !!}</h3>
        <p class="leading-normal md:leading-loose my-4 sm:my-7 max-w-4xl mx-auto">{!! $desc !!}</p>

        <div class="flex flex-wrap items-start justify-center">
            @foreach([
                'Start your<br> lessons today.',
                'Enjoy them for <br>90-days, risk-free.',
                'Change your mind?<br> Get a refund.'
            ] as $index => $text)
                <div class="w-full sm:w-1/3 px-2 {{ $index < 2 ? 'mb-3 sm:mb-0' : '' }}">
                    <h5 class="{{ $theme === 'musora' ? 'text-black border-black py-1' : 'text-'.$theme.' border-'.$theme.' py-2' }} border-2 rounded-full inline-block px-3 mb-1">
                        {{ $index + 1 }}
                    </h5>
                    <h6 class="leading-normal">
                        {!! $text !!}
                        @if($index === 2)
                            <div class="ml-2 tool absolute inline-block cursor-pointer" 
                                tip="If it's not for you, simply cancel your membership within 90 days and contact us for a full refund. (If your membership includes any bonuses, your refund will deduct the value of hard goods that were shipped to you.)" 
                                aria-label="Refund Information">
                                <i class="fas fa-info-circle"></i>
                            </div>
                        @endif
                    </h6>
                </div>
            @endforeach
        </div>
    </div>
</section>