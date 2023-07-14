<section class="py-14 sm:py-24 lg:py-32 relative overflow-hidden text-white text-center customize px-4 lg:px-6 relative overflow-hidden"
    @if(!empty($bgColor))
        style="background: {{ $bgColor }};"
    @else
        style="background: linear-gradient(45deg, #07233e, #0c1524);"
  @endif >
    <div class="container mx-auto max-w-6xl sm:mb-16">
        <div class="flex flex-wrap items-center">
            <div class="flex w-full justify-center sm:justify-start sm:w-1/2 sm:order-1 sm:pl-5 lg:pl-10 mb-7 sm:mb-0">
                <picture>
                    <source media="(min-width:640px)" srcset="https://www.musora.com/musora-cdn/image/width=1500,quality=95/{!! $image !!}">
                    <img class="max-w-xl sm:max-w-2xl lg:max-w-4xl transition-opacity opacity-0"
                         loading="lazy"
                         onload="this.classList.remove('opacity-0')"
                         src="https://www.musora.com/musora-cdn/image/width=1000,quality=95/{!! $image !!}"
                         alt="{{$theme}} collage image"
                    >
                </picture>
            </div>
            <div class="text-center sm:text-left w-full sm:w-1/2 sm:pl-5">
                @if(!empty($logo))
                    <img class="h-6 mb-3 sm:my-6" src="{{ $logo }}">
                @endif
                <h6 class="uppercase text-musora mb-2"><strong>YOUR FIRST @if(!empty($month)) 30 Days @else 7 Days @endif ARE FREE.</strong></h6>
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
                    <p class="text-xs"><em> Pay nothing for
                            @if(!empty($month)) 30 @else 7 @endif
                            days, then $20/month billed annually.</em></p>
                </div>
            </div>
        </div>
    </div>
</section>
