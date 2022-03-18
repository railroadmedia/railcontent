<div class="shop-accordion mb-7">
    <div class="spec-wrap">
        @if(!empty($specsList))
            <h4 class="text-lg uppercase mt-0 mb-6 md:text-xl lg:text-2xl">Technical Specs</h4>
            <table class="text-sm leading-tight md:leading-normal md:text-base">
                @foreach ($specsList as $specsListItem)
                    <tr>
                        <td class="uppercase font-bold pb-2 block md:pb-2 md:table-cell">
                            <i class="text-center w-6 inline-block md:text-lg w-7 fas {{ $specsListItem->specIcon  }}"></i> {{ $specsListItem->specType  }}
                        </td>
                        <td class="pb-3 block md:pb-2 md:table-cell">{!! trans(nl2br($specsListItem->specValue)) !!}</td>
                    </tr>
                @endforeach
            </table>
        @endif
        @if(!empty($featuresList))
            <br>
            <h4 class="text-lg uppercase mt-0 mb-6 md:text-xl lg:text-2xl">Key Features</h4>
            <ul class="list-square pl-5">
                @foreach($featuresList as $featuresListItem)
                    <li class="mb-4">{{ $featuresListItem }}</li>
                @endforeach
            </ul>
        @endif
    </div>
</div>