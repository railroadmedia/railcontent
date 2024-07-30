@php
    if (empty($soundslice)) {
        $soundslice = '';
    }
@endphp

<div @if(!empty($soundslice)) id="{{ $soundslice }}" @endif
class="assignment-row border-gray-100 border-t-2 py-4 sm:px-3 @if(!empty($defaultOpen)) active @endif" x-data="{ open: {{ $num == 1 ? 'true' : 'false' }}, completed: false }">
    <div class="w-full flex flex-col sm:flex-row sm:justify-between">
        <div class="flex flex-row w-full items-center md:w-1/2"> 
            @if(!empty($soundslice))
            <!-- Dropdown button -->
            <div  class="border-2 rounded-full border-gray-600 cursor-pointer flex justify-center items-center w-10 p-0.5"  @click="open = !open">
                <i :class="{'fa-angle-down': !open, 'fa-angle-up': open}" class="fa-light fa-fw transition-all duration-300 text-2xl text-gray-600"></i>
            </div>
            
            @elseif(!empty($pdfURL))
                <a href="{{ $pdfURL }}" target="_blank"><i class="fa-light fa-fw fa-file-music text-3xl flex-shrink-0"></i></a>
            @elseif(!empty($imgURL))
                <a href="{{ $imgURL }}" target="_blank"><i class="fa-light fa-fw fa-file-music text-3xl flex-shrink-0"></i></a>
            @elseif(!empty($mp3URL))
                <a href="{{ $mp3URL }}" target="_blank"><i class="fa-light fa-fw fa-music text-3xl"></i></a>
            @elseif(!empty($zipURL))
                <a href="{{ $zipURL }}" target="_blank"><i class="fa-light fa-fw fa-cloud-download text-3xl"></i></a>
            @endif

            <div class="pl-3 sm:pl-4 max-w-2xl max-w-2xl mr-auto">
                <p class="flex-grow"><strong>{!! $title !!}</strong></p>
            </div>
        </div>
       
        <div class="w-full pt-4 md:pt-0 sm:w-1/2 md:w-5/12 flex flex-col md:flex-row">
        @if(!empty($pdfURL) || !empty($mp3URL) || !empty($imgURL))
            @if(!empty($vimeo))
            <button class="w-full smaller join border-black border mt-3 block mx-auto text-center bg-white text-black" data-open="{{ $vimeo }}Modal">
                PRACTICE
            </button>
                <i class="fas fa-fw fa-play pl-2 mr-2 sm:mr-6 ml-auto text-xl outline-none cursor-pointer text-yellow relative z-10 autoplay-video flex-shrink-0" data-open="{{ $vimeo }}Modal"></i>
            @endif
            @if(!empty($soundslice))
            <button class="smaller join border-black border mt-3 block mx-auto text-center bg-white text-black" x-on:click="soundsliceModal{{$num}} = true">
                PRACTICE
            </button>
            @endif
            <i class="fa-light fa-fw fa-angle-down transition-all duration-300 @if(empty($soundslice) && empty($vimeo)) ml-auto  @endif @if(!empty($pdfURL) || !empty($mp3URL)) cursor-pointer @endif text-4xl flex-shrink-0 w-9"></i>
        @else
            @if(!empty($soundslice))
            <button class="w-full smaller join border-black border-2 mt-3 block text-center bg-white text-black mx-2" x-on:click="soundsliceModal{{$num}} = true">
                PRACTICE
            </button>
          <button 
                class="w-full smaller join border-{{$theme}} border-2 mt-3 block text-center cursor-none bg-white text-{{$theme}} mx-2" 
                x-data="{ completed: false }" 
                :class="{ 'bg-{{$theme}} text-white': completed, 'bg-white text-{{$theme}}': !completed }" 
                @click="completed = !completed">
                COMPLETE
            </button>
            @endif
        @endif 
        </div>  
    </div>

    <!-- Dropdown soundslice -->
<div x-show="open" @click="open = false" class="mt-2 text-center">
    <iframe 
        class="w-full md:w-1/2" 
        src="{{ 'https://www.soundslice.com/slices/' . $soundslice . '/embed/?api=1&scroll_type=2&branding=0&top_controls=1&show_chords=0&layout=3&recording_idx=1&enable_metronome=0' }}"
        frameborder="0" 
        allowfullscreen 
        allow="autoplay" 
        title="{{ $soundslice }}">
    </iframe>
</div>
  

    @if(!empty($pdfURL) || !empty($mp3URL) || !empty($imgURL))
        <div class="w-full dropdown px-2 invisible opacity-0 h-auto max-h-0 overflow-hidden transition-all duration-300">
            @if(!empty($mp3URL))
                <audio class="outline-none min-w-full mt-4" controls src="{{ $mp3URL }}"></audio>

            @elseif(!empty($pdfURL))
                <object
                    data="{{ $pdfURL }}"
                    type="application/pdf"
                    width="100%"
                    height="700px"
                >
                    <p>
                        Your browser does not support PDFs.
                        <a href="{{ $pdfURL }}" class="underline text-{{$theme}}" target="_blank">Download the PDF</a>
                        .
                    </p>
                </object>

            @elseif(!empty($imgURL))
                <img class="mt-4" src="{{ $imgURL }}" alt="lesson chart/sheet">
            @endif
        </div>
    @endif
</div>

@if(!empty($vimeo))
    <div class="reveal-overlay">
        <div class="reveal mt-3 sm:mt-6" id="{{ $vimeo }}Modal" data-reveal data-reset-on-close="true">
            <div class="aspect-16:9 w-full relative overflow-hidden">
                <iframe class="absolute w-full h-full reset-on-close" src="" data-lazy-load-url="//player.vimeo.com/video/{{ $vimeo }}?autoplay=1" frameborder="0" allowfullscreen allow="autoplay"></iframe>
            </div>
        </div>
    </div>
@endif

@if(!empty($soundslice))
    @include('_partials.components.video-modal',[
        'name' => 'soundsliceModal'.$num,
        'video' => str_contains($soundslice, 'https') ? $soundslice : 'https://www.soundslice.com/slices/'.$soundslice.'/embed/',
        'styles' => 'pb-[66vh] bg-white',
        'soundslice' => null
    ])
@endif

