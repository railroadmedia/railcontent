<div id="breadCrumbs" class="tw-fluid tw-w-full tw-bg-[#F9F9F9] tw-text-[#3F3F46] dark:tw-bg-black dark:tw-text-[#A1A1A9] collapsed hide-xs-only" dusk="breadcrumbs">
    <div class="tw-container tw-mx-auto tw-px-4 pa-1 tw-uppercase tw-text-center">
        {{--<div class="flex flex-row">--}}
            @foreach($pages as $index => $page)
                @if($index !== 0)
                    <span class="mh-1 tiny">/</span>
                @endif

                @if(!empty($page['url']))
                    <a class="tiny text-grey-3 tw-no-underline" href="{{ $page['url'] }}">
                        {{ ucwords($page['title']) }}
                    </a>
                @else
                    <span class="tiny tw-font-bold">{{ ucwords($page['title']) }}</span>
                @endif
            @endforeach
        {{--</div>--}}
    </div>
</div>