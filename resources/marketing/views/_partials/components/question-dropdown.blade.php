<div
    class="dropdown text-center rounded-xl mb-3 select-none text-black @if(empty($variant)) border-2 border-[#EFF3F5] bg-white @endif "
    @if(!empty($variant))
        style="background:linear-gradient(to bottom, #F6F8FC, #fff);"
    @endif
    x-data="{ open: @if(!empty($open) && $open) true @else false @endif }"
>
    <div class="flex">
        <div class="text-left flex-grow relative">
            <div
                class="pt-4 sm:pt-6
                @if(!empty($variant))
                px-4 sm:px-5
                @else
                pr-4 sm:pr-5 pl-8 sm:pl-12
                @endif
                cursor-pointer"
                x-on:click="open = !open;"
            >
                <h5
                    class="leading-tight sm:leading-loose font-black relative"
                    x-bind:class="open && 'mb-2'"
                >
                    @if(!empty($num))<span class="rounded-full px-2 md:px-2.5 min-w-0
                    @if(!empty($variant))
                        py-0.5 bg-white border-2 border-{{ $theme }}
                    @else
                        py-1 text-xs md:text-sm text-white absolute -left-11 sm:-left-14 md:-left-16 -top-0.5 sm:top-0.5
                     @endif
                    " :class="open ? 'bg-{{$theme}}' : ' @if(empty($variant)) bg-[#838C98] @endif '">{{$num}}</span>@endif
                    {!! $title !!}
                </h5>
            </div>
            <div class="pb-4 sm:pb-6 pr-4 sm:pr-5 pl-8 sm:pl-12">
                <p
                    x-cloak
                    class="transition-all duration-100 leading-relaxed sm:leading-relaxed overflow-hidden"
                    x-bind:class="{ 'max-h-0': !open, 'max-h-[2000px]': open  }"
                >
                    {!! nl2br( $desc) !!}
                    @if(!empty($detail))<br><span class="block mt-4 text-[#838C98]">{{$detail}}</span>@endif
                </p>
            </div>
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
            class="transition-all duration-200 text-xs sm:text-sm text-left bg-[#F5F8FC] overflow-hidden"
            x-bind:class="open ? 'max-h-[2000px]' : 'max-h-0'">
            <div class="py-4 sm:py-6 pl-4 sm:pl-5 pr-8 sm:pr-12">
            @foreach($lessonInfo as $key => $info)
                <div class="bg-white @if(!empty($info['desc'])) p-4 @endif rounded-xl flex flex-col md:flex-row mb-2 @if(empty($info['desc'])) md:items-center @endif">
                    <img
                        class="rounded-xl @if(empty($info['desc'])) md:h-24 @else mb-6 md:mb-0 md:h-32 @endif transition-opacity opacity-0"
                        src="https://www.musora.com/musora-cdn/image/width=650,quality=95/{{$info['thumb']}}"
                        alt="lesson{{$key+1}} thumb"
                        loading="lazy"
                        onload="this.classList.remove('opacity-0')"
                    />
                    @if(!empty($info['desc']))
                        <div class="md:pl-6">
                            <h5 class="font-black">{{$info['title']}}</h5>
                            @if(!empty($info['desc']))<p class="my-2">{{$info['desc']}}</p>@endif
                            @if(!empty($info['lessonNum']))<p class="text-[#838C98]">{{ $info['lessonNum'] }} lessons</p>@endif
                        </div>
                    @endif
                </div>
            @endforeach
            </div>
        </div>
    @endif
</div>

