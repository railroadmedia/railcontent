<section class="text-center px-5 sm:px-6 py-10 sm:py-14 lg:py-20">
    <div class="container max-w-5xl mx-auto">
        <img class="h-56 inline sm:hidden transition-opacity opacity-0"
            loading="lazy"
            onload="this.classList.remove('opacity-0')"
            src="https://cdn.musora.com/image/fetch/w_520,q_auto:best/{{ $imgMobile }}">
        <h2 class="text-center my-5 sm:mt-0 sm:mb-10"><strong>{!! $header !!}</strong></h2>
        <div class="text-left flex flex-wrap sm:flex-nowrap mb-32 sm:mb-56 lg:mb-72">
            <p class="leading-normal max-w-lg pr-7">{!! $desc !!}</p>
            <img class="h-96 hidden sm:inline transition-opacity opacity-0"
                loading="lazy"
                onload="this.classList.remove('opacity-0')"
                src="https://cdn.musora.com/image/fetch/w_690,q_auto:best/{{ $img }}">
        </div>
    </div>
</section>
