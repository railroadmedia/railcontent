<a class="relative no-underline group" href="/{{ $lessonURL }}">
{{--    <div class="flex flex-col text-[#00101D] align-left justify-center hide-xs-only font-black text-lg xl:text-xl flex-shrink-0 w-7 sm:w-9">{{ $lessonNumber }}</div>--}}
    <div class="flex flex-col justify-center flex-shrink-0">
        <div class="relative aspect-16:9 overflow-hidden rounded-xl border border-[#F0F0F0]">
            <img src="https://www.musora.com/musora-cdn/image/width=500,quality=95/@php
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
                <i class="fas fa-play text-3xl text-white" aria-hidden="true"></i>
            </div>
        </div>
    </div>
    <div class="flex mr-auto overflow mt-2">
        <div class="mr-1 md:mr-2">
            <p class="inline-block font-black rounded-full border border-black px-2 ">{{ $lessonNumber }}</p>
        </div>
        <div>
            <p class="font-black text-sm lg:text-base mt-1 lg:mt-0.5 leading-tight lg:leading-tight">
                {{ $lessonTitle }}
            </p>
            <p class="text-xs text-[#848484] uppercase mt-1 mb-4 md:mb-0">
                <span>{{ $duration }} @if($duration > 1) Mins @else Min @endif</span>
            </p>
        </div>
    </div>
</a>
