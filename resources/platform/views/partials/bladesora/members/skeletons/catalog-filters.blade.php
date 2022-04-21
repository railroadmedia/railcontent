<div class="tw-flex tw-flex-row tw-flex-wrap tw-mb-1">
    @for($i = 0; $i < $length; $i++)
        <div class="tw-flex tw-flex-col xs-12 sm-3 ph-1 tw-mb-2 m-xs-only">
            <div
                class="skeleton-loader corners-10"
                style="height:50px;width:100%;"
            ></div>
        </div>
    @endfor
</div>
