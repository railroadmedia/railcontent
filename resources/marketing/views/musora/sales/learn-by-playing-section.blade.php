<section class="text-center px-5 sm:px-6 py-10 sm:py-14 lg:py-20">
    <div class="container max-w-6xl mx-auto">
        <img class="h-64 inline sm:hidden transition-opacity opacity-0"
            loading="lazy"
            onload="this.classList.remove('opacity-0')"
            src="https://cdn.musora.com/image/fetch/w_690,q_auto:best/{{ $img }}">
        <h2 class="text-center my-5 sm:mt-0 sm:mb-10"><strong>{!! $header !!}</strong></h2>
        <div class="text-left flex flex-wrap sm:flex-nowrap justify-center mb-32 sm:mb-44 lg:mb-72">
            <p class="leading-normal max-w-xl pr-7 mx-0">{!! $desc !!}</p>
            <img class="h-72 lg:h-96 hidden sm:inline transition-opacity opacity-0"
                loading="lazy"
                onload="this.classList.remove('opacity-0')"
                src="https://cdn.musora.com/image/fetch/w_690,q_auto:best/{{ $img }}">
        </div>
    </div>
</section>
