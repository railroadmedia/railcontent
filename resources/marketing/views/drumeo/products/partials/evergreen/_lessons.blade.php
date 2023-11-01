<section class="m-0 text-white" style="background: #00101D; border: 1px solid #00101D">
    <h2 class="text-center leading-tight pt-12 md:pt-20 px-4 mb-6">
        <strong>{{ $title }}</strong>
    </h2>

    <div class="container max-w-5xl mx-auto px-4 md:px-6 pb-12 md:flex leading-normal" x-data="{ posterImage: '{{ $features[0]['posterImage'] }}'}">
    {{-- <div class="container max-w-5xl mx-auto px-4 md:px-6 md:flex leading-normal" x-data="{ posterImage: '{{ $features[0]['posterImage'] }}', dataOpen: 'kick-off' }"> --}}

        <div class="md:w-2/3 lg:w-8/12 md:pr-4 flex-shrink-0">
            <div class="aspect-16:9 cursor-pointer rounded-xl autoplay-video overflow-hidden w-full relative" data-open={{$features[0]['dataOpen']}}>
            {{-- <div class="aspect-16:9 cursor-pointer rounded-xl autoplay-video overflow-hidden w-full relative" :data-open='dataOpen'> --}}

                <img :src="posterImage" class="rounded-xl object-cover w-full h-full absolute z-0" alt="Video Poster" />
                <i class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 fas fa-play play-button z-10"></i>
            </div>

            <div class="mt-4 md:py-4 hidden md:block">
                <p>{{ $descriptionDesktop }} @if(isset($descriptionBold)) <strong>{{ $descriptionBold }}</strong> @endif</p>
                <p class="pt-10">Instructor: <strong> {{ $instructor }}</strong></p>
                <p class="pt-2">Lesson Length: <strong> {{ $course }}</strong></p>
            </div>
        </div>

        <div class="text-black md:w-1/3">
            @foreach ($features as $feature)
                <button class="rounded-lg mb-2 px-4 py-3 bg-blue-50 w-full" 
                        {{-- x-on:click="posterImage = '{{ $feature['posterImage'] }}'; dataOpen = '{{ $feature['dataOpen'] }}'"> --}}
                        x-on:click="posterImage = '{{ $feature['posterImage'] }}'">
                    <p class="flex items-center">
                        <i class="fas fa-play-circle text-xl text-{{ $brand }} mr-2"></i> {{ $feature['title'] }}
                    </p>
                </button>
            @endforeach

            <p class="text-white pt-3"><strong>{{ $lessonTitle }}</strong></p>
            <div x-data="{ isOpen: [] }" class="h-72 overflow-y-scroll rounded-lg">
                @foreach ($lessons as $i => $lesson)
                    <div x-data="{ open: false }" class="rounded-lg bg-white shadow mb-1.5">
                        <button class="rounded-lg flex w-full items-center justify-between px-4 py-3.5" style="background: #eff7ff;" x-on:click="open = !open;">
                            <p class="mx-0 truncate">{{ $lesson }}</p>
                            <div class="ml-auto text-{{ $brand }} cursor-pointer">
                                <i class="fas fa-angle-down transform transition-all duration-300" x-bind:class="{ 'rotate-180': open }"></i>
                            </div>
                        </button>
                        <div x-cloak class="transition-all duration-200 overflow-hidden" x-bind:class="open ? 'max-h-[2000px]' : 'max-h-0'">
                            <div class="px-4 pb-4 bg-blue-50 rounded-lg">
                                {{ $lessons[$i] }}
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        <p class="mt-4 p-4 md:hidden">
            {{ $descriptionMobile }}
            <span class="block pt-10">Instructor: <strong> {{ $instructor }}</strong></span>
            <span class="block pt-2">Lesson Length: <strong> {{ $course }}</strong></span>
        </p>
    </div>
</section>
