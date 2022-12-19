
<div id="customize-anchor" class="anchor"></div>
<section class="py-14 sm:py-24 lg:py-32 relative overflow-hidden text-white text-center customize px-4 lg:px-6 relative overflow-hidden" style="background: linear-gradient(45deg, #07233e, #0c1524);">
    <div class="container mx-auto max-w-6xl mb-16">
        <div class="flex flex-wrap items-center">
            <div class="text-center sm:text-left w-full sm:w-1/2 lg:w-1/2 sm:pl-5">
                <h3 class="leading-normal"><strong>{!! $header !!}</strong></h3>
                <ul class="fa-ul text-left  my-4 sm:my-5 mx-auto">
                    {!! $list !!}
                </ul>
                <div class="w-72 lg:w-96 mx-auto sm:mx-0">
                    <a class="join smaller blue w-full my-3" href="{!! $buttonLink !!}">
                        @if(!empty($promoVersion))
                            Get Started &raquo;
                        @else
                            START FOR FREE <i class="fas fa-arrow-right"></i>
                        @endif
                    </a>
                    <p class="text-center text-sm"><em>Pay nothing for 7 days, then ${!! $price !!}/month billed annually.</em></p>
                </div>
            </div>
            <div class="flex w-full justify-center sm:justify-start sm:w-1/2 lg:w-1/2 sm:order-1 sm:pl-5 lg:pl-10 mt-7 sm:mt-0">
                <img class="max-w-xl sm:max-w-2xl lg:max-w-4xl transition-opacity opacity-0"
                    loading="lazy"
                    onload="this.classList.remove('opacity-0')"
                    src="https://cdn.musora.com/image/fetch/w_1500,q_auto:best/{!! $image !!}">
            </div>
        </div>
    </div>
</section>
