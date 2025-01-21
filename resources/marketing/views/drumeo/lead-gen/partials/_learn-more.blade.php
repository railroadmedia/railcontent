<section class="bg-cover bg-center no-repeat text-white" style="background-image: url('{{ !empty($bg) ? $bg : '' }}');">
    <div class="container max-w-3xl m-auto text-center px-6 flex flex-col justify-center items-center py-10 md:py-20">
        @if(!empty($logo))
            <img src="{{ $logo }}" alt="Logo" class="@if(!empty($logoStyle)) {{ $logoStyle }} @endif">
        @endif
        @if(!empty($header))
            <h3 class="text-2xl my-2">{!! $header !!}</h3>
        @endif
        @if(!empty($subheader))
            <p class="mb-4">{!! $subheader !!}</p>
        @endif
        @if(!empty($btnLink))
            <a class="w-10/12 sm:w-1/2 smaller join bg-{{ $theme }} mt-3 block mx-auto text-center" href="{{ $btnLink }}">
                {{ !empty($btnText) ? $btnText : 'Learn More' }}
            </a>
        @endif
    </div>
</section>