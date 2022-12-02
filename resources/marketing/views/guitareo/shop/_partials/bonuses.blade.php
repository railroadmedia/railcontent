<hr class="tw-my-5">
<h4 class="tw-text-lg md:tw-text-xl tw-font-bold tw-mt-0 tw-mb-0">Say hello to your free bonuses</h4>
<p class="tw-mb-10 italic tw-mt-0" style="color:#8D9299;">All digital lessons are added to your account instantly.</p>

@foreach ($bonuses as $bonus)
    <div class="bonus-pic tw-mb-7 md:tw-flex md:tw-items-center">
        <div class="image-wrap tw-overflow-hidden tw-mb-4 md:tw-mb-0 tw-mx-auto md:tw-mr-5">
            <img class="tw-w-full tw-h-full tw-rounded-xl" src="https://cdn.musora.com/image/fetch/w_220,q_auto:best/{{ $bonus['img'] }}" alt="{{ $bonus['name'] }} thumb">
        </div>
        <div>
            <strong>{{ $bonus['name'] }} -
                @if (!empty($bonus['discountedPrice']))
                    <s>${{ $bonus['fullPrice'] }}</s>
                @endif

                <span @if($bonus['priceColor'] == 'orange') style="color:#E69500;" @endif>{!! $bonus['price'] !!}</span>
                <br @if(!$bonus['lineBreak']) class="tw-hidden" @endif>

                @if (!empty($bonus['discountedPrice']))
                    <span class="text-pianote">*SAVE {{ round(100 - (100 * ($bonus['discountedPrice'] / $bonus['fullPrice']))) }}%*</span>
                @endif

                @if($bonus['freeBonus'])
                    <span class="tw-text-guitareo">*FREE BONUS*</span>
                @endif

                @if($bonus['lifetimeAccess'])
                    <span style="color:#E69500;">LIFETIME ACCESS</span>
                @endif


                @if($bonus['freeShipping'])
                    <span style="color:#E69500;">FREE SHIPPING</span>
                @endif

                @if(!empty($bonus['included']) && $bonus['included'])
                    <span class="tw-text-guitareo">*INCLUDED*</span>
                @endif
            </strong><br>
            {!! $bonus['desc'] !!}
        </div>
    </div>
@endforeach

