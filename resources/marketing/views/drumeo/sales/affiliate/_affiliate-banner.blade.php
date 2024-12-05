<div class="px-4 sm:px-6 py-6 sm:py-8 relative z-10 bg-cover bg-center @isset($lightBackground) text-black @else text-white @endif "
    @isset($background)
        style="background: {{ $background }};"
    @else
        style="background-color:#000318;"
    @endif
>
    <div class="container max-w-4xl mx-auto">
        <div class="flex flex-wrap sm:flex-nowrap mx-auto items-start lg:items-center text-center justify-center">
            @isset($video)
                <div class="w-36 sm:w-56 lg:w-72 mx-0 mb-3 sm:mb-0 flex-shrink-0">
                    <div class="aspect-1:1 w-full relative rounded-xl overflow-hidden">
                        <iframe class="absolute w-full h-full" src="//player.vimeo.com/video/{{ $video }}" frameborder="0" allowfullscreen allow="autoplay" title="Lifetime Video"></iframe>
                    </div>
                </div>
            @else
                @isset($img2)
                    <img class="rounded-xl mx-auto mb-3 sm:mb-0 w-36 sm:w-56 lg:w-72" src="{{ $img2 }}">
                @else
                    <img class="rounded-full bg-{{ $theme }} border-{{ $theme }} border-4 sm:border-8 mx-auto mb-3 sm:mb-0 w-36 sm:w-56 lg:w-72" src="https://www.musora.com/musora-cdn/image/width=540,quality=95/https://{{ $slug }}.cloudfront.net/sales/trials/@yield('url').jpg">
                @endif
            @endif
            <div class="sm:text-left px-2 sm:pr-0 sm:pl-7 lg:pl-10">
                @isset($headline)
                    <h2 class=""><strong>{!!  $headline  !!}</strong></h2>
                @else
                    <h2 class="uppercase"><strong>@yield('name') FANS</strong></h2>
                    <h3 class="text-{{ $theme }}">YOUR FIRST MONTH IS FREE!</h3>
                @endif
                <h6 class="leading-normal my-3 sm:my-5">
                    @yield('text')
                </h6>
                <a class="join {{ $theme }} smaller" href="/choose-your-trial-month/">30 Days For Free <i class="fas fa-arrow-right" style="line-height: 0;" aria-hidden="true"></i></a>
            </div>
        </div>
    </div>
</div>
