<section class="bg-cover bg-center no-repeat text-black" style="background-image: url('{{ !empty($bg) ? $bg : '' }}');">
    <div class="container max-w-4xl mx-auto text-center px-6 flex flex-col justify-center items-center py-10 md:py-16">
        @if(!empty($logo))
            <img src="{{ $logo }}" alt="Logo" class="@if(!empty($logoStyle)) {{ $logoStyle }} @endif">
        @endif
        @if(!empty($header))
            <h3 class="mb-4 mt-2 leading-none"><strong>{!! $header !!}</strong></h3>
        @endif
        @if(!empty($subheader))
            <h1 class="mb-4 leading-none"><strong>{!! $subheader !!}</strong></h1>
        @endif
        @if(!empty($text))
            <p class="my-4">{!! $text !!}</p>
        @endif
        @if(!empty($btnLink))
            <a class="w-10/12 max-w-[350px] smaller join bg-{{ $theme }} mt-3 block mx-auto text-center" href="{{ $btnLink }}">
                {{ !empty($btnText) ? $btnText : 'Learn More' }}
            </a>
        @endif
    </div>
</section>