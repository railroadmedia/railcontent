<div class="drumshop-accordion">
    <div class="spec-wrap">
        @if(!empty($specsList))
            <h4 class="font-bold text-lg uppercase mb-6 md:text-xl lg:text-2xl">Technical Specs</h4>
            <table class="text-sm w-full md:text-base">
                @foreach ($specsList as $specsListItem)
                    <tr>
                        <td class="font-bold uppercase even:pb-4 md:even:pb-3 pb-2 block md:tb1 md:table-cell">
                            <i class="text-center w-6 inline-block md:text-lg md:w-7 fas {{ $specsListItem->specIcon  }}"></i> {{ $specsListItem->specType  }}
                        </td>
                        <td class="item-info pb-4 block md:mb-1 md:table-cell">{!! trans(nl2br($specsListItem->specValue)) !!}</td>
                    </tr>
                @endforeach
            </table>
        @endif
        @if(!empty($featuresList))
            <h4 class="font-bold text-lg uppercase mb-6 md:text-xl lg:text-2xl">Key Features</h4>
            <ul class="list-disc leading-5 pl-5">
                @foreach($featuresList as $featuresListItem)
                    <li class="mb-4">{{ $featuresListItem }}</li>
                @endforeach
            </ul>
        @endif
    </div>
</div>
