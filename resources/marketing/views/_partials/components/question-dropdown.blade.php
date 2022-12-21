<div
    class="dropdown text-center rounded-xl mb-3 select-none text-black border-2 border-[#EFF3F5]"
    x-data="{ open: false }"
>
    <div class="flex">
        <div
            class="py-4 sm:py-6 pr-4 sm:pr-5 pl-8 sm:pl-12 text-left flex-grow relative cursor-pointer"
            x-on:click="
                open = !open;
                if(open){
                    $refs.dropdown1.classList.remove('hidden', 'h-0', 'max-h-0');
                    $refs.dropdown1.classList.add('h-auto', 'max-h-full');
                    @if(!empty($lessons))
                    $refs.dropdown2.classList.remove('hidden', 'h-0', 'max-h-0');
                    $refs.dropdown2.classList.add('h-auto', 'max-h-full');
                    @endif
                } else {
                    $refs.dropdown1.classList.add( 'h-0', 'max-h-0');
                    $refs.dropdown1.classList.remove('h-auto', 'max-h-full');
                    @if(!empty($lessons))
                    $refs.dropdown2.classList.add( 'h-0', 'max-h-0');
                    $refs.dropdown2.classList.remove('h-auto', 'max-h-full');
                    @endif
                }
            "
        >
            <h6 class="leading-tight sm:leading-loose font-bold relative" :class="open && 'mb-2'">
                @if(!empty($num))<span class="text-white rounded-full py-1 px-2 md:px-2.5 text-xs md:text-sm absolute -left-11 md:-left-16 -top-0.5 md:top-0.5" :class="open ? 'bg-{{$theme}}' : 'bg-[#838C98]'">{{$num}}</span>@endif
                {!! $title !!}
            </h6>
            <p
                x-ref="dropdown1"
                class="transition-all duration-300 text-xs sm:text-sm h-0 leading-relaxed sm:leading-relaxed overflow-hidden"
                :class="open ? '' : ''"
            >
                {!! nl2br( $desc) !!}
                @if(!empty($detail))<br><span class="block mt-4 text-[#838C98]">{{$detail}}</span>@endif
            </p>
        </div>
        <div
            class="ml-auto text-{{$theme}} pt-3 sm:pt-6 pr-4 sm:pr-5 cursor-pointer @if(!empty($customArrow)) {{ $customArrow }} @endif"
            x-on:click="
                open = !open;
                if(open){
                    $refs.dropdown1.classList.remove('hidden', 'h-0', 'max-h-0');
                    $refs.dropdown1.classList.add('h-auto', 'max-h-full');
                    @if(!empty($lessons))
                    $refs.dropdown2.classList.remove('hidden', 'h-0', 'max-h-0');
                    $refs.dropdown2.classList.add('h-auto', 'max-h-full');
                    @endif
                    $refs.icon.classList.add('rotate-45');
                } else {
                    $refs.dropdown1.classList.add( 'h-0', 'max-h-0');
                    $refs.dropdown1.classList.remove('h-auto', 'max-h-full');
                    @if(!empty($lessons))
                    $refs.dropdown2.classList.add( 'h-0', 'max-h-0');
                    $refs.dropdown2.classList.remove('h-auto', 'max-h-full');
                    @endif
                    $refs.icon.classList.remove('rotate-45');
                }
            "
        >
            <i x-ref="icon" class="fas fa-plus transform transition-all duration-300 text-lg md:text-2xl lg:text-3xl"></i>
        </div>
    </div>
    @if(!empty($lessons))
        <div x-ref="dropdown2" class="transition-all duration-300 text-xs sm:text-sm text-left bg-[#F5F8FC] h-0 overflow-hidden" :class="open ? 'py-4 sm:py-6 pl-4 sm:pl-5 pr-8 sm:pr-12' : ''">
            @foreach($lessons as $key => $lesson)
                <div class="bg-white p-4 rounded-xl flex flex-col md:flex-row mb-2">
                    <img
                        class="rounded-xl md:h-32 mb-6 md:mb-0 transition-opacity opacity-0"
                        src="https://cdn.musora.com/image/fetch/w_650,q_auto:best/{{$lesson['thumb']}}"
                        alt="lesson{{$key+1}} thumb"
                        loading="lazy"
                        onload="this.classList.remove('opacity-0')"
                    />
                    <div class="md:pl-6">
                        <h5 class="font-extrabold">{{$lesson['title']}}</h5>
                        <p class="my-2">{{$lesson['desc']}}</p>
                        <p class="text-[#838C98]">{{ $lesson['lessonNum'] }} lessons</p>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>
