<!-- Forum Header Banner -->
<div class="tw-container tw-mx-auto fluid collapsed-h pv-5 tw-relative tw-bg-black">
    <div class="header-background-container absolute-fill bg-top"
         style="background-image: url({{ cf_img(
                $backgroundImage,
                ["quality" => 80, "blur" => 40, "width" => 640]
            ) }});" data-ix-bg="{{ $backgroundImage }}"
    ></div>
    <div class="header-background-container absolute-fill bg-top hide-lg-down" style="background: linear-gradient(to left, #000 0%, transparent 10%, transparent 90%, #000 100%)"></div>
    <div class="header-gradient-overlay absolute-fill {{ $brand }}"></div>
    <div class="tw-container tw-mx-auto tw-relative">
        <div class="tw-flex tw-flex-row tw-items-center">
            {{ $content }}
        </div>
    </div>
</div>
