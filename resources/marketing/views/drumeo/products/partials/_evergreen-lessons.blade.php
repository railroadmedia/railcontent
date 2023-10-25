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
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                    <path
                        d="M12 2C10.0222 2 8.08879 2.58649 6.4443 3.6853C4.79981 4.78412 3.51809 6.3459 2.76121 8.17317C2.00433 10.0004 1.8063 12.0111 2.19215 13.9509C2.578 15.8907 3.53041 17.6725 4.92894 19.0711C6.32746 20.4696 8.10929 21.422 10.0491 21.8079C11.9889 22.1937 13.9996 21.9957 15.8268 21.2388C17.6541 20.4819 19.2159 19.2002 20.3147 17.5557C21.4135 15.9112 22 13.9778 22 12C22 10.6868 21.7413 9.38642 21.2388 8.17317C20.7363 6.95991 19.9997 5.85752 19.0711 4.92893C18.1425 4.00035 17.0401 3.26375 15.8268 2.7612C14.6136 2.25866 13.3132 2 12 2ZM10 16.5V7.5L16 12L10 16.5Z"
                        fill={{ $fill }} />
                </svg>
                <p class="leading-tight mx-0 px-2">{{ $feature }}</p>
            </div>
        @endforeach

        <p class="font-black leading-tight">{{ $lessonTitle }}</p>

        <div x-data="{ isOpen: [] }" class="h-80 overflow-y-scroll rounded-lg text-black">
            @foreach ($lessons as $i => $lesson)
                <div x-data="{ open: false }"
                    class="rounded-lg bg-white shadow my-1">
                    <button @click="open = !open"
                        class="rounded-lg flex w-full items-center justify-between px-6 py-4"
                        style="background: #eff7ff;">
                        <p class="leading-tight mx-0">Day {{ $i + 1 }}</p>
                        <svg xmlns="http://www.w3.org/2000/svg" width="12" height="8" viewBox="0 0 12 8"
                            fill="none" x-show="!open" x-bind:class="{'rotate-90': open}">
                            <path d="M10.59 0.59L6 5.17L1.41 0.590001L-5.24537e-07 2L6 8L12 2L10.59 0.59Z"
                                fill={{ $fill }} />
                        </svg>
                    </button>
                    <div x-show="open" x-cloak>
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
