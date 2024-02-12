<div class="h-5 sm:h-10 -mt-10 relative" style="background: linear-gradient(to bottom right, transparent calc(50% - 1px), transparent, #FFF calc(50% + 1px));" aria-hidden="true"></div>
<div id="guarantee" class="anchor"></div>
<section class="pb-10 sm:pb-14 lg:pb-20 relative text-center px-6" style="background-color:#fff;">
    <div class="container mx-auto max-w-6xl" 
        :class="{'opacity-0': !lazyLoad, 'opacity-100': lazyLoad}"
        x-intersect.once="lazyLoad = true; $refs.guaranteeBadge.src = $refs.guaranteeBadge.dataset.src;">
        <picture>
            <source media="(min-width:640px)" data-srcset="https://d21q7xesnoiieh.cloudfront.net/fit-in/250x0/filters:quality(95)/{!! $badge !!}">
            <img x-ref="guaranteeBadge"
                class="h-28 md:h-32 -mt-16 md:-mt-20 mb-5 sm:mb-8 transition-opacity opacity-0 duration-300" 
                src="https://d21q7xesnoiieh.cloudfront.net/fit-in/35x0/filters:quality(1)/{!! $badge !!}"
                data-src="https://d21q7xesnoiieh.cloudfront.net/fit-in/250x0/filters:quality(95)/{!! $badge !!}"
                onload="this.classList.remove('opacity-0')"
                loading="lazy"
                alt="guarantee-badge">
        </picture>
        <h3 class="leading-tight">{!! $header !!}</h3>
        <p class="leading-normal md:leading-loose my-4 sm:my-7 max-w-4xl mx-auto">{!! $desc !!}</p>
        <div class="flex flex-wrap items-start justify-center">
            <div class="w-full sm:w-1/3 px-2 mb-3 sm:mb-0">
                <h5 class="@if($theme === 'musora') text-black border-black @else text-{{ $theme }} border-{{ $theme }} @endif border-2 rounded-full inline-block @if($theme === 'musora') py-1 @else py-2 @endif px-3 mb-1">1</h5>
                <h6 class="leading-normal">Start your<br> lessons today.</h6>
            </div>
            <div class="w-full sm:w-1/3 px-2 mb-3 sm:mb-0">
                <h5 class="@if($theme === 'musora') text-black border-black @else text-{{ $theme }} border-{{ $theme }} @endif border-2 rounded-full inline-block @if($theme === 'musora') py-1 @else py-2 @endif px-3 mb-1">2</h5>
                <h6 class="leading-normal">Enjoy them for <br>90-days, risk-free.</h6>
            </div>
            <div class="w-full sm:w-1/3 px-2">
                <h5 class="@if($theme === 'musora') text-black border-black @else text-{{ $theme }} border-{{ $theme }} @endif border-2 rounded-full inline-block @if($theme === 'musora') py-1 @else py-2 @endif px-3 mb-1">3</h5>
                <h6 class="leading-normal">Change your mind?<br> Get a refund. <div class="ml-2 tool absolute inline-block cursor-pointer" tip="If it’s not for you, simply cancel your membership within 90 days and contact us for a full refund. (If your membership includes any bonuses, your refund will deduct the value of hard goods that were shipped to you.)"><i class="fas fa-info-circle"></i></div></h6>
            </div>
        </div>
    </div>
</section>
