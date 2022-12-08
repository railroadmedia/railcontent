@foreach ($bonuses as $bonus)
    <div class="bonus-pic tw-mb-7 md:tw-flex md:tw-items-start md:tw-mb-10 lg:tw-items-center">
        <div class="image-wrap tw-relative tw-overflow-hidden tw-mb-4 md:tw-mb-0 md:tw-mr-5 tw-mx-auto @if(!empty($bonus['freeShipping'])) shipping @endif">
            <img class="tw-w-full tw-rounded-lg" src="{{ $bonus['img'] }}">
        </div>
        <div>
            <strong>{{ $bonus['name'] }} - <span>{!! $bonus['price'] !!}</span>
                <br @if(empty($bonus['lineBreak'])) class="tw-hidden" @endif>

                @if(!empty($bonus['freeBonus']))
                    <span style="color:#0B76DB;">*FREE BONUS*</span>
                @endif

                @if(!empty($bonus['lifetimeAccess']))
                    <span style="color:#E69500;">LIFETIME ACCESS</span>
                @endif

                @if(!empty($bonus['freeShipping']))
                    <span style="color:#E69500;">FREE SHIPPING</span>
                @endif
            </strong><br>
            {!! $bonus['desc'] !!}
            <br>
        </div>
    </div>
@endforeach
