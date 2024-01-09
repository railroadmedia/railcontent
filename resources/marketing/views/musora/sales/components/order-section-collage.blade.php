<section class="py-10 sm:py-20 lg:py-24 relative overflow-hidden text-white text-center customize px-4 lg:px-8 relative overflow-hidden"
    @if(!empty($bgColor))
        style="background: {{ $bgColor }};"
    @else
        style="background: linear-gradient(45deg, #07233e, #0c1524);"
  @endif >
    <div class="container mx-auto max-w-5xl mb-5 sm:mb-10">
        <div class="flex flex-wrap sm:flex-nowrap items-center">
            <div class="flex w-full justify-center sm:justify-start sm:w-1/2 lg:w-auto sm:order-1 lg:pl-5 mb-4 sm:mb-0">
                <picture>
                    <source media="(min-width:1024px)" srcset="https://d21q7xesnoiieh.cloudfront.net/fit-in/1130x0/filters:quality(95)/{!! $image !!}">
                    <source media="(min-width:640px)" srcset="https://d21q7xesnoiieh.cloudfront.net/fit-in/1020x0/filters:quality(95)/{!! $image !!}">
                    <img class="object-contain h-64 sm:h-auto max-w-full sm:max-w-md md:max-w-lg lg:max-w-full transition-opacity opacity-0"
                         loading="lazy"
                         onload="this.classList.remove('opacity-0')"
                         src="https://d21q7xesnoiieh.cloudfront.net/fit-in/580x0/filters:quality(95)/{!! $image !!}"
                         alt="{{$theme}} collage image"
                    >
                </picture>
            </div>
            <div class="text-center sm:text-left w-full sm:w-auto flex-shrink-0">
                @if(!empty($logo))
                    <img class="h-7 mb-4 sm:mb-7" src="{{ $logo }}" alt="logo">
                @endif
                <p class="uppercase text-musora mb-2"><strong class="font-black">YOUR FIRST @if(!empty($month)) 30 Days @else 7 Days @endif ARE FREE.</strong></p>
                <h3 class="leading-normal"><strong>{!! $header !!}</strong></h3>
                <ul class="fa-ul text-left pl-6 my-4 sm:my-5 mx-auto inline-block">
                    {!! $list !!}
                </ul>
                <div class="w-72 lg:w-96 mx-auto sm:mx-0">
                    <a class=" w-full sm:w-82 join smaller my-3 @if($theme == 'musora') musora-gold @else bg-{{$theme}} @endif"
                    @if(!empty($orderUrl))
                        href="{{ $orderUrl }}"
                    @elseif(!empty($month))
                        href="/choose-your-trial-month"
                    @else
                        href="/choose-plan"
                    @endif
                    >
                        START FOR FREE <i class="fas fa-arrow-right" style="line-height: 0;"></i>

                    </a>
                    <p class="text-xs"><em> Pay nothing for @if(!empty($month)) 30 @else 7 @endif days, <br class="lg:hidden">then $20/month billed annually.</em></p>
                </div>
            </div>
        </div>
    </div>
</section>
