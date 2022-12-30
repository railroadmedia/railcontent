<section class="py-14 sm:py-24 lg:py-32 relative overflow-hidden text-white text-center customize px-4 lg:px-6 relative overflow-hidden" style="background: linear-gradient(45deg, #07233e, #0c1524);">
    <div class="container mx-auto max-w-6xl sm:mb-16">
        <div class="flex flex-wrap items-center">
            <div class="flex w-full justify-center sm:justify-start sm:w-1/2 sm:order-1 sm:pl-5 lg:pl-10 mb-7 sm:mb-0">
                <img class="max-w-xl sm:max-w-2xl lg:max-w-4xl transition-opacity opacity-0"
                    loading="lazy"
                    onload="this.classList.remove('opacity-0')"
                    src="https://cdn.musora.com/image/fetch/w_1500,q_auto:best/{!! $image !!}">
            </div>
            <div class="text-center sm:text-left w-full sm:w-1/2 sm:pl-5">
                <h3 class="leading-normal"><strong>{!! $header !!}</strong></h3>
                <ul class="fa-ul text-left pl-6 my-4 sm:my-5 mx-auto inline-block">
                    {!! $list !!}
                </ul>
                <div class="w-72 lg:w-96 mx-auto sm:mx-0">
                    <a class=" w-full sm:w-64 join smaller bg-{{$theme}} w-full my-3" href="/choose-plan">START FOR FREE <i class="fas fa-arrow-right" style="line-height: 0;"></i></a>
                    <p class="text-center text-sm"><em>Pay nothing for 7 days, then ${{ Prices::$drumeoEdgeRegular }}/month billed annually.</em></p>
                </div>
            </div>
        </div>
    </div>
</section>
