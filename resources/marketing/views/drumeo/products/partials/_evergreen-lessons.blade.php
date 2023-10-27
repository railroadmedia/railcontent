<section class="m-0 text-white" style="background: #00101D; border: 1px solid #00101D">

<h2 class="text-center font-black leading-tight pt-12 md:pt-20">
    {{ $title }}
</h2>

<div class="container max-w-5xl mx-auto p-4 md:p-6 md:flex leading-normal">
    <div class="md:w-2/3 lg:w-4/6 py-2 md:p-4">
        <div class="w-full">
            <img class="rounded-xl" src="{{ $image }}" />
        </div>

        <div class="mt-4 md:py-4 hidden md:block">
        <p>{{ $descriptionDesktop }}  <strong>{{ $descriptionBold }} </strong></p>
        <p class="pt-10">Instructor: <strong> {{$instructor}}</strong></p>
        <p class="pt-2">Lesson Length: <strong> {{$course}}</strong></p>
        </div>
    </div>

    <div class="py-2 md:p-4 text-black text-base">
        @foreach ($features as $feature)
            <div class="rounded-lg mb-2 px-6 py-3 bg-blue-50">
                <p class="flex items-center"><i class="fas fa-play-circle text-xl text-{{ $brand }} mr-2"></i> {{ $feature }}</p>
            </div>
        @endforeach

            <p class="text-white pt-3"><strong>{{ $lessonTitle }}</strong></p>

        <div x-data="{ isOpen: [] }" class="h-72 overflow-y-scroll rounded-lg text-black">
            @foreach ($lessons as $i => $lesson)
                <div x-data="{ open: false }"
                    class="rounded-lg bg-white shadow my-1 mb-1.5">
                    <button
                        class="rounded-lg flex w-full items-center justify-between px-6 py-3.5"
                        style="background: #eff7ff;"
                            x-on:click="open = !open;"
                    >
                        <p class="mx-0">Day {{ $i + 1 }}</p>
                        <div
                                class="ml-auto text-{{ $brand }} cursor-pointer"
                        >
                            <i class="fas fa-angle-down transform transition-all duration-300" x-bind:class="{ 'rotate-180': open }"></i>
                        </div>
                    </button>
                    <div x-cloak
                            class="transition-all duration-200 overflow-hidden"
                            x-bind:class="open ? 'max-h-[2000px]' : 'max-h-0'">
                        <div class="px-6 pb-4 bg-blue-50 rounded-lg">
                            {{ $lessons[$i] }}
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <p class="mt-4 p-4 md:hidden">
        {{ $descriptionMobile }}
        <span class="block pt-10">Instructor: <strong> {{$instructor}}</strong></span>
        <span class="block pt-2">Lesson Length: <strong> {{$course}}</strong></span>
    </p>

</div>
</section>