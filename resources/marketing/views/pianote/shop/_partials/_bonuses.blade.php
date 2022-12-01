@foreach ($bonuses as $bonus)
    <div class="bonus-pic tw-mb-7 md:tw-flex md:tw-items-start md:tw-pb-10">
        <div class="image-wrap tw-mb-4 tw-mx-auto md:tw-mb-0 md:tw-mr-5 @if($bonus['freeShipping']) shipping @endif">
            <img class="tw-w-full tw-h-full tw-rounded-xl" src="{{ $bonus['img'] }}">
        </div>
        <div>
            <strong>{{ $bonus['name'] }} -
                @if (!empty($bonus['discountedPrice']))
                    <s>${{ $bonus['fullPrice'] }}</s>
                @endif

                <span @if($bonus['priceColor'] == 'red') style="color:#E69500;" @endif>{!!  $bonus['price']  !!}</span>

                <br @if(!$bonus['lineBreak']) class="tw-hidden" @endif>

                @if (!empty($bonus['discountedPrice']))
                    <span class="text-pianote">*SAVE {{ round(100 - (100 * ($bonus['discountedPrice'] / $bonus['fullPrice']))) }}%*</span>
                @endif

                @if($bonus['freeBonus'])
                    <span class="text-pianote">*FREE BONUS*</span>
                @endif

                @if($bonus['lifetimeAccess'])
                    <span style="color:#E69500;">LIFETIME ACCESS</span>
                @endif

                @if($bonus['freeShipping'])
                    <span style="color:#E69500;">FREE SHIPPING</span>
                @endif
                @if(!empty($bonus['included']) && $bonus['included'])
                    <span class="text-pianote">*INCLUDED*</span>
                @endif
            </strong><br>
            {!! $bonus['desc'] !!}
        </div>
    </div>
@endforeach