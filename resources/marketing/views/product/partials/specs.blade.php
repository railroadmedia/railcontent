<?php
    $icons = [
        "publisher" => "fa-bullhorn",
        "video" => "fa-video",
        "online" => "fa-wifi",
        "skill" => "fa-user",
        "sizing" => "fa-expand-arrows-alt",
        "shirt" => "fa-tshirt",
        "fabric" => "fa-blanket",
        "color" => "fa-palette",
        "volume" => "fa-list-ol",
        "height" => "fa-arrows-v",
        "diameter" => "fa-undo",
        "materials" => "fa-cube",
        "finish" => "fa-eye",
        "washing" => "fa-tint",
        "microwave" => "fa-bolt",
        "style" => "fa-cut",
        "manufacturer" => "fa-tshirt",
        "size" => "fa-arrows",
    ];
?>

<div class="drumshop-accordion mt-10">
    <div class="spec-wrap">
        @if(!empty($specList))
            <h4 class="font-bold text-lg uppercase mb-6 md:text-xl lg:text-2xl">Technical Specs</h4>
            <table class="text-sm w-full md:text-base">
                @foreach ($specList as $specsListItem)
                    <tr>
                        <td class="font-bold uppercase even:pb-4 md:even:pb-3 pb-2 block md:tb1 md:table-cell">
                            <i class="text-center w-6 inline-block md:text-lg md:w-7 fas @if(!empty($icons[strtolower($specsListItem->title)])){{ $icons[strtolower($specsListItem->title)] }}@endif"></i>
                            {{ $specsListItem->title  }}:
                        </td>
                        <td class="item-info pb-4 block md:mb-1 md:table-cell ">{!! trans(nl2br($specsListItem->desc)) !!}</td>
                    </tr>
                @endforeach
            </table>
        @endif
        @if(!empty($featureList))
            <h4 class="font-bold text-lg uppercase mb-6 md:text-xl lg:text-2xl mt-10">Key Features</h4>
            <ul class="list-disc leading-5 pl-5">
                @foreach($featureList as $featuresListItem)
                    <li class="mb-4">{{ $featuresListItem->desc }}</li>
                @endforeach
            </ul>
        @endif
    </div>
</div>
