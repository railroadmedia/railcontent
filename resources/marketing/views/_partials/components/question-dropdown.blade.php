<div
    class="dropdown text-center rounded-xl mb-3 select-none text-black border-2 border-[#EFF3F5]"
    x-data="{ open: @if(!empty($open) && $open) true @else false @endif }"
>
    <div class="flex">
        <div
            class="py-4 sm:py-6 pr-4 sm:pr-5 pl-8 sm:pl-12 text-left flex-grow relative cursor-pointer"
            x-on:click="open = !open;"
        >
            <h5 class="leading-tight sm:leading-loose font-black relative" :class="open && 'mb-2'">
                @if(!empty($num))<span class="text-white rounded-full py-1 px-2 md:px-2.5 text-xs md:text-sm absolute -left-11 md:-left-16 -top-0.5 md:top-0.5" :class="open ? 'bg-{{$theme}}' : 'bg-[#838C98]'">{{$num}}</span>@endif
                {!! $title !!}
            </h5>
            <p
                x-cloak
                class="transition-all duration-300 text-xs sm:text-sm leading-relaxed sm:leading-relaxed overflow-hidden"
                x-bind:class="{ 'max-h-0': !open, 'max-h-[2000px]': open  }"
            >
                {!! nl2br( $desc) !!}
                @if(!empty($detail))<br><span class="block mt-4 text-[#838C98]">{{$detail}}</span>@endif
            </p>
        </div>
        <div
            class="ml-auto text-{{$theme}} pt-3 sm:pt-6 pr-4 sm:pr-5 cursor-pointer @if(!empty($customArrow)) {{ $customArrow }} @endif"
            x-on:click="open = !open"
        >
            <i class="fas fa-plus transform transition-all duration-300 text-lg md:text-2xl lg:text-3xl" x-bind:class="{ 'rotate-45': open }"></i>
        </div>
    </div>
    @if(!empty($lessonInfo))
        <div
            x-cloak
            class="transition-all duration-300 text-xs sm:text-sm text-left bg-[#F5F8FC] overflow-hidden"
            x-bind:class="open ? 'max-h-[2000px]' : 'max-h-0'">
            <div class="py-4 sm:py-6 pl-4 sm:pl-5 pr-8 sm:pr-12">
            @foreach($lessonInfo as $key => $info)
                <div class="bg-white p-4 rounded-xl flex flex-col md:flex-row mb-2 @if(empty($info['desc'])) md:items-center @endif">
                    <img
                        class="rounded-xl @if(empty($info['desc'])) md:h-24 @else md:h-32 @endif mb-6 md:mb-0 transition-opacity opacity-0"
                        src="https://cdn.musora.com/image/fetch/w_650,q_auto:best/{{$info['thumb']}}"
                        alt="lesson{{$key+1}} thumb"
                        loading="lazy"
                        onload="this.classList.remove('opacity-0')"
                    />
                    <div class="md:pl-6">
                        <h6 class="font-black">{{$info['title']}}</h6>
                        @if(!empty($info['desc']))<p class="my-2">{{$info['desc']}}</p>@endif
                        @if(!empty($info['lessonNum']))<p class="text-[#838C98]">{{ $info['lessonNum'] }} lessons</p>@endif
                    </div>
                </div>
            @endforeach
            </div>
        </div>
    @endif
</div>

