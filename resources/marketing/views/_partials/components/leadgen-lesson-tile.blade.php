<a class="flex flex-row relative text-[#3F3F46] border-b border-[#E4E4E7] no-underline hover:bg-[#E7EFF6] group py-2 px-3" href="/{{ $lessonURL }}">
    <div class="flex flex-col text-[#00101D] align-left justify-center hide-xs-only font-black text-lg xl:text-xl flex-shrink-0 w-7 sm:w-9">{{ $lessonNumber }}</div>
    <div class="flex flex-col justify-center flex-shrink-0 w-20 sm:w-36">
        <div class="relative aspect-16:9 overflow-hidden rounded-xl">
            <img src="https://www.musora.com/musora-cdn/image/width=500,quality=85/@php
                if(str_contains($lessonImg, 'i.vimeocdn.com')){
                      $lessonImg = preg_replace('/[?]mw[=][0-9]+[&]mh[=][0-9]+/', '.jpg', $lessonImg);
                      if(preg_match('/[.]png|[.]jpg|[.]jpeg|[.]svg/', $lessonImg) !== 1){
                          $lessonImg = $lessonImg.'.jpg';
                      }
                  }
                  echo $lessonImg;
            @endphp" alt="Lesson Thumbnail {{ $lessonNumber }}" class="transition-opacity duration-500 opacity-1 absolute object-cover h-full w-full" loading="lazy">
            <div class="flex absolute inset-0 bg-black opacity-0 group-hover:opacity-40 z-20 flex justify-center items-center transition-opacity"></div>
            <div class="flex justify-center items-center absolute inset-0 z-30 transition-opacity opacity-0 group-hover:opacity-100">
                <i class="fas fa-play text-xl text-white" aria-hidden="true"></i>
            </div>
        </div>
    </div>
    <div class="flex flex-col justify-center mr-auto overflow px-3">
        <p class="text-[#00101D] font-black text-sm lg:text-base">
            {{ $lessonTitle }}
        </p>
        <p class="text-xs text-[#3F3F46] uppercase xl:hidden flex flex-wrap sm:flex-nowrap">
            <span>{{ $duration }} @if($duration > 1) Mins @else Min @endif</span>
        </p>
    </div>
    <div class="hidden xl:flex uppercase items-center justify-center text-xs" data-test="3 mins" style="flex: 0 0 80px;">{{ $duration }} @if($duration > 1) Mins @else Min @endif</div>
    <div class="flex flex-col justify-center">
        <i class="fas fa-play-circle text-[#D4D4D8] group-hover:text-[#00101D] text-[28px]" aria-hidden="true"></i>
    </div>
</a>
