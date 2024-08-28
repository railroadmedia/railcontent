<section class="bg-cover bg-center no-repeat text-black" style="background-image: url('{{ !empty($bg) ? $bg : '' }}');">
    <div class="container max-w-3xl m-auto text-center px-6 flex flex-col justify-center items-center py-10 md:py-16">
        @if(!empty($logo))
            <img src="{{ $logo }}" alt="Logo" class="@if(!empty($logoStyle)) {{ $logoStyle }} @endif">
        @endif
        @if(!empty($header))
            <h1 class="mb-4 mt-2 leading-none"><strong>{!! $header !!}</strong></h1>
        @endif
        @if(!empty($subheader))
            <h4 class="mb-4 text-pianote italic font-bold tracking-wide">{!! $subheader !!}</h4>
        @endif
        @if(!empty($text))
            <p class="mb-4">{!! $text !!}</p>
        @endif
        @if(!empty($btnLink))
            <a class="w-10/12 sm:w-1/2 smaller join bg-{{ $theme }} mt-3 block mx-auto text-center" href="{{ $btnLink }}">
                {{ !empty($btnText) ? $btnText : 'Learn More' }}
            </a>
        @endif
    </div>
</section>