<section class="{{ $bgClass }}" aria-label="Items">
    <div class="container max-w-5xl mx-auto px-4 text-white py-4 sm:py-10">
        <div class="flex flex-wrap items-top">
            @foreach ($songItems as $i => $songItem)
                <div class="dropdown-box w-full sm:w-1/3 h-34 flex sm:items-start p-6 rounded-xl lg:my-6 leading-loose">
                    <div class="flex sm:inline-block w-full">
                        <div class="pr-3 sm:w-full text-left sm:text-center">
                            <i class="{{ $songItem['icon'] }} h-6 sm:h-10 text-{{$brand}} text-xl sm:text-4xl" aria-label="icon"></i>
                        </div>
                        <div class="w-4/5 sm:w-full text-left sm:text-center">
                            <p class="mb-1 sm:my-2">
                                <strong>{!! $songItem['title'] !!}</strong>
                            </p>
                            <p class="hidden sm:block text-sm">
                                {!! $songItem['desc'] !!}
                            </p>
                            <div class="text-sm sm:hidden text-lg md:bg-none">
                                {!! $songItem['desc'] !!}
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>
