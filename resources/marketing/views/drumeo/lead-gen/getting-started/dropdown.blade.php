<div
    class="dropdown text-center rounded-xl mb-3 select-none text-black"
    x-data="{ open: @if($key === 2) true @else false @endif }"
    style="background:linear-gradient(180deg, #F1F7FE 0%, rgba(241, 247, 254, 0.00) 100%);"
>
    <div class="flex">
        <div class="text-left flex-grow relative">
            <div
                class="py-4 sm:py-6 md:pr-5 pl-6 md:pl-12 cursor-pointer"
                x-on:click="open = !open;"
            >
                <h4
                    class="leading-tight sm:leading-loose relative flex items-center flex-1"
                >
                    <div>
                        <span class="text-lg">LEVEL</span>
                        <div class="md:inline-block">
                            <div class="ml-2 mr-6 rounded-full w-8 h-8 flex items-center justify-center font-black text-lg text-white" style="background:{{ $bgHex }}">{{ $key+1 }}
                            </div>
                        </div>
                    </div>
                    <div class="md:flex items-center justify-between flex-1">
                        <span class="font-black">{!! $title !!}</span>
                        <div class="text-xl sm:font-black">
                            {{ $lessonNum }} Lessons
                        </div>
                    </div>

                </h4>
            </div>
        </div>
        <div
            class="ml-auto text-black pt-4 md:pt-7 lg:pt-8 pr-4 sm:pr-5 cursor-pointer"
            x-on:click="open = !open"
        >
            <i class="fas fa-plus transform transition-all duration-300 text-lg md:text-2xl lg:text-3xl" x-bind:class="{ 'rotate-45': open }"></i>
        </div>
    </div>
    <div
        x-cloak
        class="transition-all duration-200 text-xs sm:text-sm text-left bg-[#F5F8FC] overflow-hidden rounded-b-xl"
        x-bind:class="open ? 'max-h-[2000px] mb-6' : 'max-h-0'">
        <div class="px-2 md:pl-5 md:pr-12">
            @foreach($lessonInfo as $key => $info)
                <div class="@if(!empty($info['desc'])) p-4 @endif rounded-xl flex flex-col md:flex-row mb-2 md:items-center">
                    <img
                        class="rounded-xl @if(empty($info['desc'])) md:h-24 @else mb-6 md:mb-0 md:h-36 lg:h-48 @endif transition-opacity opacity-0"
                        src="https://www.musora.com/musora-cdn/image/width=650,quality=95/{{$info['thumb']}}"
                        alt="lesson{{$key+1}} thumb"
                        loading="lazy"
                        onload="this.classList.remove('opacity-0')"
                    />
                    @if(!empty($info['desc']))
                        <div class="md:pl-8 lg:pl-16 lg:pr-10">
                            <h5 class="font-black">{{$info['title']}}</h5>
                            @if(!empty($info['desc']))<p class="my-2">{{$info['desc']}}</p>@endif
                        </div>
                    @endif
                </div>
            @endforeach
        </div>
    </div>
</div>
