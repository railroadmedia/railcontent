<div class="sm:flex items-start justify-center mb-10 sm:mb-16">
    <img class="rounded-full border-4 bg-pianote border-pianote w-24 sm:w-32 md:w-40 mb-3 sm:mb-0" src="{{ $image }}">
    <div class="text-left sm:pl-4 md:pl-6">
        <h3 class="text-sm sm:text-lg md:text-xl font-extrabold">"{{ $heading }}"</h3>
        <p class="text-xs sm:text-sm mt-3 mb-5 max-w-2xl">{!! $testimonial !!}</p>
        <p class="text-xs sm:text-sm font-extrabold text-pianote">{{ $name }}</p>
        <p class="text-xs sm:text-sm">{{ $location }}</p>
    </div>
</div>
