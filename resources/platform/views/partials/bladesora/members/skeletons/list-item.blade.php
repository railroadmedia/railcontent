<div class="{{ $overview ? 'content-overview' : 'content-table-row' }} tw-flex tw-flex-row bb-grey-1-1
     pa-1 tw-cursor-pointer tw-relative text-grey-3 hover-bg-grey-7 hover-text-black"
>
    @if($showNumbers)
        <div class="tw-flex tw-flex-col align-left number-col title tw-text-black hide-xs-only">
            <div class="skeleton-loader corners-10" style="height:12px;width:8px;"></div>
        </div>
    @endif

    <div class="{{ $overview ? 'large-thumbnail' : 'thumbnail-col' }}
            tw-flex tw-flex-col tw-justify-center">
        <div class="thumb-wrap corners-10">
            <div class="thumb-img corners-10 {{ $thumbnailType ?? 'widescreen' }} skeleton-loader">
            </div>
        </div>
    </div>

    <div class="tw-flex tw-flex-col tw-justify-center ph-1 title-column overflow">
        <div
            class="skeleton-loader corners-10"
            style="height:8px;width:135px;margin-bottom:4px;"
        ></div>

        <div
            class="skeleton-loader corners-10"
            style="margin-bottom:4px;
                    {{ $overview ? 'height:16px;width:225px;' : 'height:8px;width:75px;' }}"
        ></div>

        @if($overview)
            <div
                class="skeleton-loader corners-10"
                style="height:6px;width:90%;margin-bottom:2px;"
            ></div>
            <div
                class="skeleton-loader corners-10"
                style="height:6px;width:90%;margin-bottom:2px;"
            ></div>
            <div
                class="skeleton-loader corners-10"
                style="height:6px;width:100px;margin-bottom:4px;"
            ></div>
        @endif
    </div>

    <div class="tw-flex tw-flex-col tw-uppercase align-center basic-col tw-text-center hide-sm-down">
        <div
            class="skeleton-loader corners-10"
            style="height:8px;width:75px;"
        ></div>
    </div>

    <div class="tw-flex tw-flex-col tw-uppercase align-center basic-col tw-text-center hide-sm-down">
        <div
            class="skeleton-loader corners-10"
            style="height:8px;width:75px;"
        ></div>
    </div>

    <div class="tw-flex tw-flex-col icon-col tw-justify-center pa hide-xs-only">
        <div class="skeleton-loader square corners-10"></div>
    </div>

    <div class="tw-flex tw-flex-col icon-col tw-justify-center pa {{ $overview ? 'hide-xs-only' : '' }}">
        <div class="skeleton-loader square corners-10"></div>
    </div>
</div>