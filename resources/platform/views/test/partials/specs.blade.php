<div class="drumshop-accordion">
    <div class="spec-wrap">
        @if(!empty($specList))
            <h4 class="tw-font-bold tw-text-lg tw-uppercase tw-mb-6 md:tw-text-xl lg:tw-text-2xl">Technical Specs</h4>
            <table class="tw-text-sm tw-w-full md:tw-text-base">
                @foreach ($specList as $specsListItem)
                    <tr>
                        <td class="tw-font-bold tw-uppercase even:tw-pb-4 md:even:tw-pb-3 tw-pb-2 tw-block md:tw-tb1 md:tw-table-cell">
{{--                            <i class="tw-text-center tw-w-6 tw-inline-block md:tw-text-lg md:tw-w-7 fas {{ $specsListItem->specIcon  }}"></i> --}}
                            {{ $specsListItem->title  }}:
                        </td>
                        <td class="item-info tw-pb-4 tw-block md:tw-mb-1 md:tw-table-cell ">{!! trans(nl2br($specsListItem->desc)) !!}</td>
                    </tr>
                @endforeach
            </table>
        @endif
        @if(!empty($featureList))
            <h4 class="tw-font-bold tw-text-lg tw-uppercase tw-mb-6 md:tw-text-xl lg:tw-text-2xl">Key Features</h4>
            <ul class="list-disc tw-leading-5 tw-pl-5">
                @foreach($featureList as $featuresListItem)
                    <li class="tw-mb-4">{{ $featuresListItem->desc }}</li>
                @endforeach
            </ul>
        @endif
    </div>
</div>
