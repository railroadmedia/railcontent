<div
    class="dropdown tw-text-center tw-rounded-xl tw-mb-3 select-none tw-text-black tw-border-2 tw-border-[#EFF3F5] tw-bg-white"
    x-data="{ open: @if(!empty($open) && $open) true @else false @endif }"
>
    <div class="tw-flex">
        <div class="tw-text-left tw-flex-grow tw-relative">
            <div
                class="tw-pt-4 sm:tw-pt-6 tw-pr-4 sm:tw-pr-5 tw-pl-8 sm:tw-pl-12 tw-cursor-pointer"
                x-on:click="open = !open;"
            >
                <h5
                    class="tw-leading-tight sm:tw-leading-loose tw-font-black tw-relative"
                    x-bind:class="open && 'mb-2'"
                >
                    @if(!empty($num))<span class="tw-text-white tw-rounded-full tw-py-1 tw-px-2 md:tw-px-2.5 tw-text-xs md:tw-text-sm tw-absolute -tw-left-11 md:-tw-left-16 -tw-top-0.5 md:tw-top-0.5 tw-min-w-0" x-bind:class="open ? 'tw-bg-{{$brand}}' : 'tw-bg-[#838C98]'">{{$num}}</span>@endif
                    {!! $title !!}
                </h5>
            </div>
            <div class="tw-pb-4 sm:tw-pb-6 tw-pr-4 sm:tw-pr-5 tw-pl-8 sm:tw-pl-12">
                <p
                    x-cloak
                    class="tw-transition-all tw-duration-100 tw-leading-relaxed sm:tw-leading-relaxed tw-overflow-hidden"
                    x-bind:class="{ 'tw-max-h-0': !open, 'tw-max-h-[2000px]': open  }"
                >
                    {!! nl2br( $desc) !!}
                    @if(!empty($detail))<br><span class="tw-block tw-mt-4 tw-text-[#838C98]">{{$detail}}</span>@endif
                </p>
            </div>
        </div>
        <div
            class="tw-ml-auto tw-text-{{$brand}} tw-pt-3 sm:tw-pt-6 tw-pr-4 sm:tw-pr-5 tw-cursor-pointer @if(!empty($customArrow)) {{ $customArrow }} @endif"
            x-on:click="open = !open"
        >
            <i class="fas fa-plus tw-transform tw-transition-all tw-duration-300 tw-text-lg md:tw-text-2xl lg:tw-text-3xl" x-bind:class="{ 'tw-rotate-45': open }"></i>
        </div>
    </div>
    @if(!empty($lessonInfo))
        <div
            x-cloak
            class="tw-transition-all tw-duration-200 tw-text-xs sm:tw-text-sm tw-text-left tw-bg-[#F5F8FC] tw-overflow-hidden"
            x-bind:class="open ? 'tw-max-h-[2000px]' : 'tw-max-h-0'">
            <div class="tw-py-4 sm:tw-py-6 tw-pl-4 sm:tw-pl-5 tw-pr-8 sm:tw-pr-12">
            @foreach($lessonInfo as $key => $info)
                <div class="tw-bg-white tw-p-4 tw-rounded-xl tw-flex tw-flex-col md:tw-flex-row tw-mb-2 @if(empty($info['desc'])) md:tw-items-center @endif">
                    <img
                        class="tw-rounded-xl @if(empty($info['desc'])) md:tw-h-24 @else md:tw-h-32 @endif tw-mb-6 md:tw-mb-0 tw-transition-opacity tw-opacity-0"
                        src="https://www.musora.com/musora-cdn/image/width=650,quality=85/{{$info['thumb']}}"
                        alt="lesson{{$key+1}} thumb"
                        loading="lazy"
                        onload="this.classList.remove('opacity-0')"
                    />
                    <div class="md:tw-pl-6">
                        <h5 class="tw-font-black">{{$info['title']}}</h5>
                        @if(!empty($info['desc']))<p class="tw-my-2">{{$info['desc']}}</p>@endif
                        @if(!empty($info['lessonNum']))<p class="tw-text-[#838C98]">{{ $info['lessonNum'] }} lessons</p>@endif
                    </div>
                </div>
            @endforeach
            </div>
        </div>
    @endif
</div>

