<div class="py-7 sm:flex">
    @if(isset($warning) && $warning)
        <div class="red-warning text-center"><p class="text-sm text-white mb-4 inline-block rounded py-1 px-2" style="background: #F71B26;">{{ $warning }}</p></div>
    @endif
    @foreach ($benefits as $benefit)
        <div class="p-3 text-center sm:w-1/3">
            <i class="fas {{ $benefit['icon']  }} text-white rounded-full text-3xl leading-7 w-16 h-16 items-center justify-center mx-auto bg-{{ $brand }}" style="display:flex;"></i>
            <div class="text-sm leading-6 mb-4 sm:mb-0">
                <strong class="block py-2 text-base ">{{ $benefit['heading']  }}</strong>
                {{ $benefit['desc']  }}
            </div>
        </div>
    @endforeach
        <div class="p-3 text-center sm:w-1/3">
            <i class="fas fa-smile text-white rounded-full text-3xl leading-7 w-16 h-16 items-center justify-center mx-auto bg-{{ $brand }}" style="display:flex;"></i>
            <div class="text-sm leading-6 mb-4 sm:mb-0">
                <strong class="block py-2 text-base ">100% Happiness Guaranteed</strong>
                We think you’ll love these lessons, and that’s why you can try them risk-free with our 90-day guarantee!
            </div>
        </div>
</div>
