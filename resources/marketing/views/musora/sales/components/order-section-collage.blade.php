<section class="py-10 sm:py-20 lg:py-24 relative overflow-hidden text-white text-center customize px-4 lg:px-8 relative overflow-hidden"
    @if(!empty($bgColor))
        style="background: {{ $bgColor }};"
    @else
        style="background: linear-gradient(45deg, #07233e, #0c1524);"
  @endif
  x-data="{lazyLoad:false}">
    <div class="container mx-auto max-w-6xl mb-5 sm:mb-10">
        <div class="flex flex-wrap sm:flex-nowrap items-center">
            <div class="flex w-full justify-center sm:justify-start sm:w-1/2 lg:w-auto sm:order-1 lg:pl-5 mb-4 sm:mb-0"
            :class="{'opacity-0': !lazyLoad, 'opacity-100': lazyLoad}"
            x-intersect.once="lazyLoad = true; $refs.collage.src = $refs.collage.dataset.src;">
                <picture>
                    <source type="image/webp" media="(min-width:1280px)" srcset="https://d21q7xesnoiieh.cloudfront.net/fit-in/1300x0/filters:quality(95)/{!! $image !!}">
                    <source type="image/webp" media="(min-width:1024px)" srcset="https://d21q7xesnoiieh.cloudfront.net/fit-in/1130x0/filters:quality(95)/{!! $image !!}">
                    <source type="image/webp" media="(min-width:640px)" srcset="https://d21q7xesnoiieh.cloudfront.net/fit-in/1020x0/filters:quality(95)/{!! $image !!}">
                    <img x-ref="collage"
                         class="object-contain h-64 sm:h-auto max-w-full sm:max-w-md md:max-w-lg lg:max-w-full transition-opacity opacity-0"
                         loading="lazy"
                         onload="this.classList.remove('opacity-0')"
                         src="https://d21q7xesnoiieh.cloudfront.net/fit-in/30x0/filters:quality(10)/filters:blur(6)/{!! $image !!}"
                         data-src="https://d21q7xesnoiieh.cloudfront.net/fit-in/580x0/filters:quality(95)/{!! $image !!}"
                         alt="{{$theme}} collage image"
                    >
                </picture>
            </div>
            <div class="text-center sm:text-left w-full sm:w-auto flex-shrink-0">
                @if(!empty($logo))
                    <img class="h-7 mb-4 sm:mb-7" src="https://d21q7xesnoiieh.cloudfront.net/fit-in/230x0/filters:quality(95)/{{ $logo }}" alt="logo">
                @endif
                <p class="uppercase text-musora mb-2"><strong class="font-black">
                    @if(!empty($subHeader))
                        {!!  $subHeader !!}
                    @else
                        YOUR FIRST @if(!empty($month)) 30 Days @else 7 Days @endif ARE FREE.
                    @endif
                    </strong></p>
                <h3 class="leading-normal"> @if(!empty($headerLight)) {!! $header !!} @else <strong>{!! $header !!}</strong> @endif </h3>
                <ul class="fa-ul text-left pl-6 my-4 sm:my-5 mx-auto inline-block">
                    {!! $list !!}
                </ul>
                @if(!empty($emailSignup))
                    <div class="max-w-xs sm:max-w-sm mx-auto sm:mx-0">
                        <form id="ajaxForm" accept-charset="UTF-8" action="{{ url()->route('claim-spotify') }}" class="ajax-form clearfix facebook-track-lead w-full mx-auto" method="POST">
                            <input class="w-full mb-2 text-left rounded-full py-1.5 px-5 text-gray-400 text-base md:text-lg" name="email" type="email" placeholder="Email Address..." required/>
                            <button type="submit" class="submit join musora smaller w-full">
                                <span class="pre-add">Get Started <i class="fad fa-paper-plane"></i></span>
                                <span class="pending hidden">Sending <i class="fad fa-spinner-third fa-spin"></i></span>
                                <span class="success hidden">Sent <i class="fad fa-thumbs-up"></i></span>
                                <span class="fail hidden">Try Again <i class="fad fa-exclamation-triangle"></i></span>
                            </button>
                        </form>
                        <div class="disclaimer block opacity-70 mx-auto mt-3 w-full">
                            <p class="mx-auto text-center leading-tight text-xs w-full"><em>Check your email for your access code after submitting!</em></p>
                        </div>
                        <div class="thank-you-box w-full rounded-lg mx-auto bg-white text-center text-black max-w-2xl transition-all duration-700 block overflow-hidden invisible max-h-0 opacity-0">
                            <h5 class="mx-auto"><strong><i class="fas fa-check"></i> Success!</strong></h5>
                            <h2 class="leading-none text-musora my-3 md:my-4 font-bebas">CHECK YOUR EMAIL</h2>
                            <p class="leading-normal mx-auto max-w-xl"><em>You should receive an email from team@musora.com within 10 minutes.
                                    If you don’t, then check your spam folder or re-enter your email address again.</em></p>
                        </div>
                    </div>
                @else
                    <div class="w-72 lg:w-96 mx-auto sm:mx-0">
                        <a role="link" aria-label="Start your membership" class=" w-full sm:w-82 join smaller my-3 @if($theme == 'musora') musora-gold @else bg-{{$theme}} @endif"
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
                @endif
            </div>
        </div>
    </div>
</section>
