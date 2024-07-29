@foreach ($product->bundles as $key => $bundle)

    <div class="flex flex-col sm:flex-row mb-5 sm:mb-8 sm:items-start lg:items-center">
        <div class="relative overflow-hidden w-52 mb-4 sm:mb-0 mr-5 mx-0 flex-shrink-0">
            <div class="w-full overflow-hidden rounded-lg relative bg-cover bg-top border border-gray-300"
                style="padding-bottom: 100%;
                @if(!empty($bundle['thumbnail']))
                    background-image:url('https://www.musora.com/musora-cdn/image/width=520,quality=95/{{ $bundle['thumbnail'] }}');
                @endif
                ">
                @if(!empty($bundle['thumbnail_logo']))
                    <div class="z-20 absolute bottom-0 left-0 right-0 px-4 py-3 text-center">
                        <img class="w-auto h-auto" style="max-height:55px;" src="https://www.musora.com/musora-cdn/image/width=500,quality=95/{{ $bundle['thumbnail_logo'] }}"
                            alt="logo" >
                    </div>
                    <div class="inset-0 absolute z-10" style="background:linear-gradient(to bottom, transparent 66%, rgba(0,0,0,0.75));"></div>
                @endif
            </div>
        </div>
        <p class="leading-normal">
            <strong class="font-black">{{ $bundle['name'] }}</strong>
            <br>
            @if($bundle['free_bonus'])
                <span class="opacity-60 line-through">${{ floatVal($bundle['price'])}}</span>

                <span class="ml-1 text-xs bottom-0 font-black text-white rounded-md px-1.5 leading-none py-1 inline-block bg-{{$theme}} align-bottom">
                    FREE BONUS
                </span>
            @else
                Normally ${{ floatVal($bundle['price'])}}
            @endif

            @if($bundle['lifetime_access'])
                <span class="ml-1 text-xs bottom-0 font-black text-black rounded-md px-1.5 leading-none py-1 inline-block bg-musora align-bottom">
                    LIFETIME ACCESS
                </span>
            @endif

            @if($bundle['bundle_free_shipping'])
                <span class="ml-1 text-xs bottom-0 font-black text-black rounded-md px-1.5 leading-none py-1 inline-block bg-musora align-bottom">
                    FREE BONUS
                </span>
            @endif

            <br>
            <span class="mt-2 inline-block">{{ $bundle['bundle_desc'] }}</span>
        </p>
    </div>
@endforeach
