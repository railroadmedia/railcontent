<div class="h-5 sm:h-10 -mt-5 sm:-mt-10 relative z-10" style="background: linear-gradient(to bottom right, transparent calc(50% - 1px), transparent, #f4f8fb calc(50% + 1px));"></div>

<section class="relative text-center px-6 pb-10 md:pb-0" style="background-color:#f6f8fc;" x-data="{lazyLoad:false}">
    <div class="container mx-auto max-w-5xl relative z-20">
        <div class="text-center md:text-left md:flex justify-center items-center"
                :class="{'opacity-0': !lazyLoad, 'opacity-100': lazyLoad}"
                x-intersect.once="lazyLoad = true; $refs.image.src = $refs.image.dataset.src;">

            <picture class="max-w-md lg:max-w-2xl order-1 w-full">
                <source media="(min-width:1024px)" srcset="https://d21q7xesnoiieh.cloudfront.net/fit-in/1350x0/filters:quality(95)/{!! $image !!}">
                <source media="(min-width:640px)" srcset="https://d21q7xesnoiieh.cloudfront.net/fit-in/900x0/filters:quality(95)/{!! $image !!}">

                <img x-ref="image"
                    class="w-full transition-opacity opacity-0 mb-6 md:mb-0 lg:-mt-11 lg:-mb-4"
                    loading="lazy"
                    onload="this.classList.remove('opacity-0')"
                    src="https://d21q7xesnoiieh.cloudfront.net/fit-in/50x0/filters:quality(95)/filters:blur(15)/{!! $image !!}"
                    data-src="https://d21q7xesnoiieh.cloudfront.net/fit-in/760x0/filters:quality(95)/{!! $image !!}"
                    alt="Device Image">
            </picture>

            <div class="pr-4 lg:pr-6">
                <h4 class="leading-tight"><strong>{{ ucfirst($theme) }} is only available on
                        Musora: The Music Lessons App.</strong></h4>
                <p class="text-sm leading-normal mt-1 lg:mt-2 mb-3 lg:mb-5">
                    @if($theme == 'drumeo')
                        Get drum lessons across web, tablet, and mobile — plus access to piano, guitar, and singing lessons.
                    @elseif($theme == 'pianote')
                        Get piano lessons across web, tablet, and mobile — plus access to singing, guitar, and drum lessons.
                    @elseif($theme == 'guitareo')
                        Get guitar lessons across web, tablet, and mobile — plus access to singing, piano, and drum lessons.
                    @elseif($theme == 'singeo')
                        Get singing lessons across web, tablet, and mobile — plus access to piano, guitar, and drum lessons.
                    @elseif($theme == 'musora')
                        All-access for piano, guitar, drums and singing across web, tablet, and mobile.
                    @endif
                </p>
                <a class="inline-block" href="{!! $appleUrl !!}" target="_blank" aria-label="Download from Apple Store">
                    <img
                        class="h-8 md:h-10 m-1 transition-opacity opacity-0"
                        loading="lazy"
                        onload="this.classList.remove('opacity-0')"
                        src="https://d21q7xesnoiieh.cloudfront.net/fit-in/270x0/filters:quality(95)/marketing/drumeo/membership/homepage/webp-format/download-on-app-store-button.webp"
                        alt="Download our app from the Apple Store"
                    ></a>
                <a class="inline-block" href="{!! $googleUrl !!}" target="_blank" aria-label="Download from Google Play">
                    <img
                        class="h-8 md:h-10 m-1 transition-opacity opacity-0"
                        loading="lazy"
                        onload="this.classList.remove('opacity-0')"
                        src="https://d21q7xesnoiieh.cloudfront.net/fit-in/270x0/filters:quality(95)/marketing/drumeo/membership/homepage/webp-format/google-play-button.webp"
                        alt="Download our app from Google Play"
                    >
                </a>
            </div>
        </div>
    </div>
</section>
