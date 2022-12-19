<div class="py-7 sm:flex">
    @if(isset($warning) && $warning)
        <div class="red-warning text-center"><p class="text-sm text-white mb-4 inline-block rounded py-1 px-2" style="background: #F71B26;">{{ $warning }}</p></div>
    @endif
    @foreach ($features as $feature)
        <div class="p-3 text-center sm:w-1/3 ">
            <i class="fas {{ $feature['icon']  }} text-white rounded-full text-3xl leading-7 w-16 h-16 flex items-center justify-center mx-auto bg-drumeo"></i>
            <div class="text-sm leading-6 mb-4 sm:mb-0">
                <strong class="block py-2 text-base ">{{ $feature['heading']  }}</strong>
                {{ $feature['text']  }}
            </div>
        </div>
    @endforeach
</div>
