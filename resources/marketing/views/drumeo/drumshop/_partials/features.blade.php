<div class="tw-py-7 sm:tw-flex">
    @if(isset($warning) && $warning)
        <div class="red-warning tw-text-center"><p class="tw-text-sm tw-text-white tw-mb-4 tw-inline-block tw-rounded tw-py-1 tw-px-2" style="background: #F71B26;">{{ $warning }}</p></div>
    @endif
    @foreach ($features as $feature)
        <div class="tw-p-3 tw-text-center sm:tw-w-1/3 ">
            <i class="fas {{ $feature['icon']  }} tw-text-white tw-rounded-full tw-text-3xl tw-leading-7 tw-w-16 tw-h-16 tw-flex tw-items-center tw-justify-center tw-mx-auto bg-drumeo"></i>
            <div class="tw-text-sm tw-leading-6 tw-mb-4 sm:tw-mb-0">
                <strong class="tw-block tw-py-2 tw-text-base ">{{ $feature['heading']  }}</strong>
                {{ $feature['text']  }}
            </div>
        </div>
    @endforeach
</div>