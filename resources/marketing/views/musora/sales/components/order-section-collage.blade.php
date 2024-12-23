<section class="px-4 lg:px-8 py-10 sm:py-16 lg:py-24 relative overflow-hidden text-white text-center customize relative overflow-hidden"
    @if(!empty($bgColor))
        style="background: {{ $bgColor }};"
    @else
        style="background: linear-gradient(to bottom, #1D4689, #0C1524);"
  @endif
  x-data="{lazyLoad:false}">
    <div class="container mx-auto max-w-6xl mb-5 lg:mb-14 h-full">
        <div class="flex flex-wrap lg:flex-nowrap items-center h-full">
            <div class="flex w-full justify-center lg:justify-start lg:w-1/2 lg:w-auto lg:order-1 lg:pl-10 mb-7 lg:mb-0"
                :class="{'opacity-0': !lazyLoad, 'opacity-100': lazyLoad}"
                x-intersect.once="lazyLoad = true; $refs.collage.src = $refs.collage.dataset.src;">
                <picture>
                    <source type="image/webp" media="(min-width:1024px)" srcset="https://d21q7xesnoiieh.cloudfront.net/fit-in/1800x0/filters:quality(95)/{!! $image !!}">
                    <source type="image/webp" media="(min-width:640px)" srcset="https://d21q7xesnoiieh.cloudfront.net/fit-in/1350x0/filters:quality(95)/{!! $image !!}">
                    <img x-ref="collage"
                        class="object-contain h-auto max-w-lg sm:max-w-2xl lg:max-w-4xl transition-opacity opacity-0"
                        loading="lazy"
                        onload="this.classList.remove('opacity-0')"
                        src="https://d21q7xesnoiieh.cloudfront.net/fit-in/30x0/filters:quality(10)/filters:blur(6)/{!! $image !!}"
                        data-src="https://d21q7xesnoiieh.cloudfront.net/fit-in/1030x0/filters:quality(95)/{!! $image !!}"
                        alt="{{$theme}} collage image"
                    >
                </picture>
            </div>
            <div class="text-center lg:text-left w-full lg:w-auto flex-shrink-0">
                @if(!empty($logo))
                    <img class="h-11 sm:h-12 mb-2 sm:mb-3" src="https://d21q7xesnoiieh.cloudfront.net/fit-in/230x0/filters:quality(95)/{{ $logo }}" alt="logo">
                @endif
                <p class="uppercase text-musora mb-2"><strong class="font-black">
                    @if(!empty($subHeader))
                        {!!  $subHeader !!}
                    @else
                        YOUR FIRST @if(!empty($month)) 30 Days ARE @else Week Is @endif  FREE.
                    @endif
                    </strong></p>
                <h3 class="leading-normal"> @if(!empty($headerLight)) {!! $header !!} @else <strong>{!! $header !!}</strong> @endif </h3>
                    @if(!empty($headerLight))
                        <ul class="fa-ul text-left pl-6 my-4 sm:my-5 mx-auto inline-block">
                            {!! $list !!}
                        </ul>
                    @else
                        <p class="text-left mt-4 sm:mt-5 mb-3 font-black">Free access for 7 days, then $240 per year.</p>
                        <ul class="fa-ul text-left pl-6 mb-4 sm:mb-5 mx-auto inline-block">
                            <li class="leading-tight mb-3"><i class="fa-li fas fa-check text-{{ $theme }}"></i> Cancel anytime.</li>
                            <li class="leading-tight mb-3"><i class="fa-li fas fa-check text-{{ $theme }}"></i> 90-Day Money Back Guarantee beyond your trial.</li>
                            <li class="leading-tight text-musora max-w-xs mx-0"><i class="fa-li fas fa-check"></i>
                                @if($theme == 'drumeo')
                                    <strong>PLUS</strong> piano, guitar, and singing lessons with full access to all Musora communities.
                                @elseif($theme == 'pianote')
                                    <strong>PLUS</strong> singing, guitar, and drum lessons with full access to all Musora communities.
                                @elseif($theme == 'guitareo')
                                    <strong>PLUS</strong> singing, piano, and drum lessons with full access to all Musora communities.
                                @elseif($theme == 'singeo')
                                    <strong>PLUS</strong> piano, guitar, and drum lessons with full access to all Musora communities.
                                @elseif($theme == 'musora')
                                    All-access for piano, guitar, drums and singing.
                                @endif
                            </li>
                        </ul>
                    @endif
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
                    <div class="w-72 lg:w-96 mx-auto lg:mx-0">
                        <a role="link" aria-label="Start your membership" class=" w-full sm:w-82 join smaller my-3 @if($theme == 'musora') musora-gold @else bg-{{$theme}} @endif"
                        @if(!empty($orderUrl))
                            href="{{ $orderUrl }}"
                        @elseif(!empty($month))
                            href="/choose-your-trial-month"
                        @else
                            href="/choose-plan"
                        @endif
                        >
                            @if(!empty($cta))
                                {!! $cta !!}
                            @else
                                START FOR FREE <i class="fas fa-arrow-right" style="line-height: 0;"></i>
                            @endif
                        </a>
                        @if(!empty($theme) && $theme == 'drumeo')
                            <p class="text-sm">Need drums? <a class="underline" href="/drumshop/kit">Get the E-Kit Bundle</a></p>
                        @elseif(!empty($theme) && $theme == 'pianote')
                            <p class="text-sm">Need a piano? <a class="underline" href="/shop/prima">Get the Keyboard Bundle</a></p>
                        @endif
{{--                        <p class="text-xs"><em> Pay nothing for @if(!empty($month)) 30 @else 7 @endif days, <br class="lg:hidden">then $20/month billed annually.</em></p>--}}
                        @if(!empty($theme) && $theme == 'musora')
                            <div class="flex justify-center sm:justify-start">
                                <img style="padding-bottom:2px;" class="h-5 sm:h-6 inline-block mr-2 sm:mr-4" src="https://www.musora.com/cdn-cgi/image/quality=95,width=250,metadata=none/https://dpwjbsxqtam5n.cloudfront.net/logos/logo-blue.png" alt="logo">
                                <img style="padding-top:2px;" class="h-5 sm:h-6 inline-block mr-2 sm:mr-4" src="https://d21q7xesnoiieh.cloudfront.net/fit-in/250x0/filters:quality(95)/marketing/pianote/membership/homepage/2023/pianote-logo-red.png" alt="logo">
                                <img style="padding-top:2px;" class="h-5 sm:h-6 inline-block mr-2 sm:mr-4" src="https://www.musora.com/cdn-cgi/image/width=200,quality=95/https://d122ay5chh2hr5.cloudfront.net/sales/guitareo-logo-green.png" alt="logo">
                                <img style="padding-top:2px;" class="h-5 sm:h-6 inline-block" src="https://www.musora.com/cdn-cgi/image/width=200,quality=95/https://d21xeg6s76swyd.cloudfront.net/sales/2021/singeo-logo.png" alt="logo">
                            </div>
                        @endif
                    </div>
                @endif
            </div>
        </div>
    </div>
</section>
