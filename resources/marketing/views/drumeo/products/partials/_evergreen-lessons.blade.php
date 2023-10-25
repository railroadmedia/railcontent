<section class="m-0 text-white" style="background: #00101D;">

<h2 class="text-center font-black leading-tight pt-12 md:pt-20">
    {{ $title }}
</h2>

<div class="container max-w-6xl mx-auto p-4 md:p-6 lg:flex">
    <div class="lg:w-4/6 py-2 md:p-4">
        <div class="w-full">
            <img class="rounded-xl" src="{{ $image }}" />
        </div>

        <div class="mt-4 md:py-4 leading-tight hidden md:block">
          <p>{{ $descriptionDesktop }}  <strong>{{ $descriptionBold }} </strong></p>
        <p class="pt-10">Instructor: <strong> {{$instructor}}</strong></p>
        <p class="pt-2">Lesson Length: <strong> {{$course}}</strong></p>
        </div>
    </div>

    <div class="lg:w-2/6 py-2 md:p-4">
        @foreach ($features as $feature)
            <div class="h-14 flex flex-row rounded-lg mb-2 px-6 py-4 text-black" style="background: #eff7ff;">
                <p class="leading-tight mx-0"><i class="fas fa-play-circle text-2xl leading-none text-{{ $brand }} mr-2 align-middle"></i> {{ $feature }}</p>
            </div>
        @endforeach

        <p class="font-black leading-tight">{{ $lessonTitle }}</p>

        <div x-data="{ isOpen: [] }" class="h-80 overflow-y-scroll rounded-lg text-black">
            @foreach ($lessons as $i => $lesson)
                <div x-data="{ open: false }"
                    class="rounded-lg bg-white shadow my-1">
                    <button
                        class="rounded-lg flex w-full items-center justify-between px-6 py-4"
                        style="background: #eff7ff;"
                            x-on:click="open = !open;"
                    >
                        <p class="leading-tight mx-0">Day {{ $i + 1 }}</p>
                        <div
                                class="ml-auto text-{{ $brand }} cursor-pointer"
                        >
                            <i class="fas fa-plus transform transition-all duration-300 text-2xl" x-bind:class="{ 'rotate-45': open }"></i>
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

    <p class="mt-4 p-4 leading-tight md:hidden">
        {{ $descriptionMobile }}
        <span class="pt-10">Instructor: <strong> {{$instructor}}</strong></span>
        <span class="pt-2">Lesson Length: <strong> {{$course}}</strong></span>
    </p>

</div>
</section>
