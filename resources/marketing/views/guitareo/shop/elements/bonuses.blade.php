@foreach ($bonuses as $bonus)
    <div class="bonus-pic mb-7 md:flex md:items-start md:pb-10 lg:items-center">
        <div class="image-wrap overflow-hidden mb-4 mx-auto md:mb-0 md:mr-5">
            <img class="w-full h-full rounded-xl" src="{{ $bonus['img'] }}">
        </div>
        <div>
            <strong>{{ $bonus['name'] }} - 
                @if (!empty($bonus['discountedPrice']))
                    <s>${{ $bonus['fullPrice'] }}</s> 
                @endif
                
                <span @if($bonus['priceColor'] == 'orange') style="color:#E69500;" @endif>{{ $bonus['price'] }}</span>
                
                <br @if(!$bonus['lineBreak']) class="hidden" @endif>

                @if (!empty($bonus['discountedPrice']))
                    <span class="text-guitareo">*SAVE {{ round(100 * ($bonus['discountedPrice'] / $bonus['fullPrice'])) }}%*</span>
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
            </strong><br>
            {!! $bonus['desc'] !!}
        </div>
    </div>
@endforeach