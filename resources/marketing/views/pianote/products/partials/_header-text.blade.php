@isset($topText)  
    <div class="relative z-40 uppercase text-gray-500 tracking-wider mb-1 text-xs lg:text-base @isset($topStyles) {{$topStyles}} @endisset">
        {!!  $topText  !!}
    </div>
@endisset
@isset($headerText)
    <div class="relative z-40 mb-4 font-knewave text-theme text-3xl lg:text-5xl @isset($headerStyles) {{$headerStyles}} @endisset">
        {!! $headerText !!}
    </div>
@endisset