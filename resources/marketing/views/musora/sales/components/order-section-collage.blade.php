<section class="py-14 sm:py-24 lg:py-32 relative overflow-hidden text-white text-center customize px-4 lg:px-6 relative overflow-hidden" style="background: linear-gradient(45deg, #07233e, #0c1524);">
    <div class="container mx-auto max-w-6xl sm:mb-16">
        <div class="flex flex-wrap items-center">
            <div class="flex w-full justify-center sm:justify-start sm:w-1/2 sm:order-1 sm:pl-5 lg:pl-10 mb-7 sm:mb-0">
                <picture>
                    <source media="(min-width:640px)" srcset="https://www.musora.com/musora-cdn/image/width=1500,quality=85/{!! $image !!}">
                    <img class="max-w-xl sm:max-w-2xl lg:max-w-4xl transition-opacity opacity-0"
                         loading="lazy"
                         onload="this.classList.remove('opacity-0')"
                         src="https://www.musora.com/musora-cdn/image/width=500,quality=85/{!! $image !!}"
                         alt="{{$theme}} collage image"
                    >
                </picture>
            </div>
            <div class="text-center sm:text-left w-full sm:w-1/2 sm:pl-5">
                <h6 class="uppercase text-{{ $theme }}"><strong>YOUR FIRST @if(!empty($month)) 30 Days @else 7 Days @endif ARE FREE.</strong></h6>
                <h3 class="leading-normal"><strong>{!! $header !!}</strong></h3>
                <ul class="fa-ul text-left pl-6 my-4 sm:my-5 mx-auto inline-block">
                    {!! $list !!}
                </ul>
                <div class="w-72 lg:w-96 mx-auto sm:mx-0">
                    <a class=" w-full sm:w-64 join smaller bg-{{$theme}} w-full my-3"
                    @if(!empty($month))
                        href="/choose-your-trial-month"
                    @else
                        href="/choose-plan"
                    @endif
                    >
                        @if(!empty($month))
                            30 Days For Free <i class="fas fa-arrow-right" style="line-height: 0;"></i>
                        @else
                            7 Days For Free <i class="fas fa-arrow-right" style="line-height: 0;"></i>
                        @endif
                    </a>
                    @if(!empty($variant))
                        <br><a class="text-sm text-pianote mb-5 sm:mb-7 w-full inline-block" href="{{ $variant }}"><em><u>Or start a monthly trial (no prize entry).</u></em></a>
                        <p class="text-xs leading-normal"><em>
                        You’ll be billed $240 on
                                @if(empty($month))
                                    {{ Carbon\Carbon::now()->addDays(7)->format('F jS') }}
                                @else
                                    {{ Carbon\Carbon::now()->addDays(30)->format('F jS') }}
                                @endif
                        &nbsp;(after your free trial).<br>
                        Don’t worry, you can cancel anytime!<br>
                        <strong>Normally 7 days. 30 days free access only valid for June 2023.</strong></em></p>


                    @endif
                </div>
            </div>
        </div>
    </div>
</section>
