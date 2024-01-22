<a data-open="{{ str_replace(" ","",$artist) }}" class="no-underline flex flex-col cursor-pointer px-2 w-1/2 md:w-1/4 lg:w-1/5">
    <div class="flex flex-col">
        <div class="bg-grey-2 active corners-10 widescreen mb-2 relative">
            <img class="rounded-lg" src="{{ $thumbURL }}" alt="{{ $title }} - {{ $artist }}">
            <i class="add-to-list fas fa-info-circle text-white absolute top-0 right-0 h-9 w-9 z-10 flex justify-center items-center"></i>
            <h3 class="font-bebas tiny font-compressed uppercase dense font-bold text-white absolute bottom-0 left-0 w-full z-10 text-xs pb-2 px-2">{{ $artist }}</h3>
            <span class="absolute w-full h-full z-20 opacity-0 hover:opacity-100 top-0 left-0 rounded-lg flex justify-center items-center" style="background:rgba(0, 0, 0, .4);">
                <i class="fas fa-arrow-right text-white text-3xl"></i>
            </span>
        </div>
    </div>
    <div class="flex flex-col mb-4">
        <h5 class="x-tiny text-gray-500 uppercase w-full" style="font-size:10px;">
            <i class="fas fa-graduation-cap" style="margin-right:5px;"></i> course</h5>
        <h4 class="tiny w-full text-xs text-black mb-1 font-compressed font-bold capitalize" style="word-wrap: break-word;">{{ $title }}</h4>
    </div>
</a>


<div class="reveal large show-modal mx-auto max-w-md text-center" id="{{ str_replace(" ","",$artist) }}" data-reveal data-reset-on-close="false">
    <div class="show-details p-5 md:p-7">
        <img class="rounded-lg mb-4" src="{{ $thumbURL }}" alt="{{ $title }} - {{ $artist }}">
        <h5><strong>{{ $title }}</strong></h5>
        <p class="mt-4">
            <strong class="text-drumeo">{{ $artist }}</strong><br>
            {{ $description }}
        </p>
        <a href="/" class="join blue smaller mt-4">JOIN DRUMEO</a>
    </div>
</div>
