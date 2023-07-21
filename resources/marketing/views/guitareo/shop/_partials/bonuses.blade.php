<hr class="my-5">
<h4 class="text-lg md:text-xl font-bold mt-0 mb-0">Say hello to your free bonuses</h4>
<p class="mb-10 italic mt-0" style="color:#8D9299;">All digital lessons are added to your account instantly.</p>

@foreach ($bonuses as $bonus)
    <div class="bonus-pic mb-7 md:flex md:items-center">
        <div class="image-wrap overflow-hidden mb-4 md:mb-0 mx-auto md:mr-5">
            <img class="w-full h-full rounded-xl" src="https://www.musora.com/musora-cdn/image/width=220,quality=95/{{ $bonus['img'] }}" alt="{{ $bonus['name'] }} thumb">
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
                    <span class="text-guitareo">*FREE BONUS*</span>
                @endif

                @if($bonus['lifetimeAccess'])
                    <span style="color:#E69500;">LIFETIME ACCESS</span>
                @endif

                @if($bonus['freeShipping'])
                    <span style="color:#E69500;">FREE SHIPPING</span>
                @endif

                @if(!empty($bonus['included']) && $bonus['included'])
                    <span class="text-guitareo">*INCLUDED*</span>
                @endif
            </strong><br>
            {!! $bonus['desc'] !!}
        </div>
    </div>
@endforeach
