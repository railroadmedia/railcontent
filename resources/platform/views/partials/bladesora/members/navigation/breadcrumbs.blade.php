<div id="breadCrumbs" class="tw-fluid tw-w-full tw-bg-[#E6E7E9] tw-text-[#3F3F46] dark:tw-bg-black dark:tw-text-[#A1A1A9] collapsed" dusk="breadcrumbs">
    <div class="tw-container tw-mx-auto tw-px-4 pa-1 tw-uppercase tw-text-center tw-flex tw-justify-center">
        {{--<div class="flex flex-row">--}}
            @foreach($pages as $index => $page)
                @if($index !== 0)
                    <span class="mh-1 tw-text-sm tw-hidden sm:tw-inline-block">/</span>
                @endif

                @if(!empty($page['url']))
                    <a class="tw-text-sm tw-text-[#3F3F46] dark:tw-text-[#A1A1A9] tw-no-underline tw-hidden sm:tw-block last-of-type:tw-inline-block" href="{{ $page['url'] }}">
                        <i class="fas fa-arrow-left tw-text-xs tw-inline-block sm:tw-hidden"></i>
                        <span class="tw-font-bold sm:tw-font-normal">{{ ucwords($page['title']) }}</span>
                    </a>
                @else
                    <span class="tw-text-sm tw-font-bold tw-hidden sm:tw-inline-block">{{ ucwords($page['title']) }}</span>
                @endif
            @endforeach
        {{--</div>--}}
    </div>
</div>