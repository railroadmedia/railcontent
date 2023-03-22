<section class="text-center px-5 sm:px-6 py-10 sm:py-14 lg:py-20">
    <div class="container max-w-6xl mx-auto">
        <h2 class="text-center sm:mb-10"><strong>{!! $header !!}</strong></h2>
        <img class="my-5 h-64 inline sm:hidden transition-opacity opacity-0"
            loading="lazy"
            onload="this.classList.remove('opacity-0')"
            src="https://www.musora.com/musora-cdn/image/width=690,quality=85/{{ $img }}"
             alt="learn playing image"
        >
        <div class="text-left flex flex-wrap sm:flex-nowrap justify-center mb-24 sm:mb-44 lg:mb-72">
            <p class="leading-normal max-w-xl pr-7 mx-0">{!! $desc !!}</p>
            <img class="h-72 lg:h-96 hidden sm:inline transition-opacity opacity-0"
                loading="lazy"
                onload="this.classList.remove('opacity-0')"
                src="https://www.musora.com/musora-cdn/image/width=690,quality=85/{{ $img }}"
                alt="learn playing image"
            >
        </div>
    </div>
</section>
