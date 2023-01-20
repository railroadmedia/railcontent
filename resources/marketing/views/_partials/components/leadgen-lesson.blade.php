<a class="flex flex-row relative text-[#3F3F46] border-b border-[#E4E4E7] no-underline hover:bg-[#E7EFF6] content-table-row hover-bg-grey-7 hover-text-black group py-2" href="/{{ $lessonURL }}">
    <div class="flex flex-col text-[#00101D] align-left justify-center hide-xs-only font-semibold text-lg xl:text-xl" style="flex: 0 0 35px;">{{ $lessonNumber }}</div>
    <div class="flex flex-col justify-center" style="flex: 0 0 142px;">
        <div class="corners-10">
            <div class="corners-10 corners-10 bg-grey-2 widescreen relative aspect-16:9 overflow-hidden rounded-xl">
                <img src="https://musora.com/cdn-cgi/image/width=500/{{ $lessonImg }}" alt="Lesson Thumbnail {{ $lessonNumber }}" class="transition-opacity duration-500 opacity-1 absolute object-cover h-full w-full" loading="lazy">
                <!---->
                <div class="flex absolute inset-0 bg-black opacity-0 group-hover:opacity-40 z-20 flex justify-center items-center transition-opacity"></div>
                <div class="flex justify-center items-center absolute inset-0 z-30 transition-opacity opacity-0 group-hover:opacity-100">
                    <i class="fas fa-play text-base text-white font-bold" aria-hidden="true"></i>
                </div>
            </div>
        </div>
    </div>
    <!---->
    <div class="flex flex-col justify-center mr-auto overflow px-2">
        <!---->
        <p class="text-base font-compressed uppercase text-truncate text-[#3F3F46] font-compressed"></p>
        <p class="text-[#00101D] font-bold item-title text-sm lg:text-base">
            {{ $lessonTitle }}
        </p>
        <!----><!---->
        <p class="text-xs font-compressed text-[#3F3F46] text-truncate uppercase xl:hidden flex flex-wrap sm:flex-nowrap">
            <span>{{ $duration }} @if($duration > 1) Mis @else Min @endif</span>
        </p>
    </div>
    <!---->
    <div class="hidden xl:flex uppercase items-center justify-center basic-col text-center text-xs font-compressed" data-test="3 mins" style="flex: 0 0 110px;">{{ $duration }} @if($duration > 1) Mins @else Min @endif</div>
    <!---->
    <div class="flex flex-col icon-col justify-center" style="flex:0 0 50px;">
        <div class="body">
            <i class="fas flex-center rounded fa-play-circle text-[#D4D4D8] hover:text-[#00101D] text-[28px]" aria-hidden="true"></i>
        </div>
    </div>
</a>
