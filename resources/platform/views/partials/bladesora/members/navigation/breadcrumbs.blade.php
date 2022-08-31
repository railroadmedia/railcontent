<div id="breadCrumbs" class="tw-fluid tw-w-full tw-bg-[#F9F9F9] tw-text-[#3F3F46] dark:tw-bg-black dark:tw-text-[#A1A1A9] collapsed hide-xs-only" dusk="breadcrumbs">
    <div class="tw-container tw-mx-auto tw-px-4 pa-1 tw-uppercase tw-text-center">
        {{--<div class="flex flex-row">--}}
            @foreach($pages as $index => $page)
                @if($index !== 0)
                    <span class="mh-1 tw-text-sm">/</span>
                @endif

                @if(!empty($page['url']))
                    <a class="tw-text-sm tw-text-[#3F3F46] dark:tw-text-[#A1A1A9] tw-no-underline" href="{{ $page['url'] }}">
                        {{ ucwords($page['title']) }}
                    </a>
                @else
                    <span class="tw-text-sm tw-font-bold">{{ ucwords($page['title']) }}</span>
                @endif
            @endforeach
        {{--</div>--}}
    </div>
</div>