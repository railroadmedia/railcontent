<div class="flex flex-wrap items-start justify-center mx-auto mt-2 sm:mt-6">
    @foreach ($socialIcons as $icon)
        <div class="w-full sm:w-1/3 sm:px-2 mb-4 py-1 sm:py-4 lg:py-5" style="color: white;">
            <a href="{{ $icon['url'] }}" target="_blank" aria-label="{{ $icon['label'] }}">
                <i class="{{ $icon['iconClass'] }}"></i>
            </a>
            <h2 class="my-1 sm:my-2 text-white text-4xl md:text-5xl font-extrabold">{{ $icon['count'] }}</h2>
            <p class="uppercase text-base md:text-lg">{{ $icon['countLabel'] }}</p>
        </div>
    @endforeach
</div>
