{{-- HERO SECTION COMPONENT --}}
<section class="relative py-40 md:py-64 lg:py-72 bg-top bg-cover" 
    @if( isset($backgroundImage) ) 
        style="background-image:url( {{ $backgroundImage }} );"
    @endif
>
    {{-- Gradient --}}
    <div class="top-0 left-0 absolute w-full h-full hidden md:block bg-gradient-to-r via-transparent @if( isset($gradientClasses) ) {{ $gradientClasses }} @endif"></div>       
    {{-- Content --}}
    <div class="container mx-auto relative z-10">
        {{ $content }}
    </div>
</section>